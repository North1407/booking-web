<?php

namespace App\Http\Controllers;

use Google\Rpc\Status;
use Illuminate\Http\Request;
use App\Models\Ride;

class RideController extends Controller
{
    public function index()
    {
        $ridesData = $this->firebase->getReference('rides')->getValue();
        $rides = is_array($ridesData) ? array_filter($ridesData, function ($ride) {
            return $ride !== null;
        }) : [];
        return view('rides.table', compact('rides'));
    }

    public function detailRide($id)
    {
        $rideData = $this->firebase->getReference('rides/' . $id)->getValue();
        $ride = is_array($rideData) ? array_filter($rideData, function ($ride) {
            return $ride !== null;
        }) : [];

        $ticketsData = $this->firebase->getReference('tickets')->getValue();
        $tickets = is_array($ticketsData) ? array_filter($ticketsData, function ($ticket) use ($id) {
            return isset($ticket['trip_id']) && $ticket['trip_id'] == $id;
        }) : [];


        return view('rides.detail', compact('ride', 'tickets'));
    }

    public function addRide(Request $request)
    {
        $ride = new Ride($request->all());
        $ride->save();
        return redirect()->back()->with('success', 'Ride added successfully!');
    }

    public function editRide($id)
    {
        $rideData = $this->firebase->getReference('rides/' . $id)->getValue();
        if ($rideData) {
            if ($rideData['status'] == 'upcoming') {
                $rideData['status'] = 'ongoing';
            } else {
                $rideData['status'] = 'completed';
            }
            $this->firebase->getReference('rides/' . $id)->update($rideData);
            $ticketsData = $this->firebase->getReference('tickets')->getValue();
            $tickets = is_array($ticketsData) ? array_filter($ticketsData, function ($ticket) use ($id) {
                return isset($ticket['trip_id']) && $ticket['trip_id'] == $id;
            }) : [];
            foreach ($tickets as $ticketId => $ticket) {
                $ticket['trip_status'] = $rideData['status'];
                $this->firebase->getReference('tickets/' . $ticketId)->update($ticket);
            }
        }
        return redirect()->back()->with('success', 'Ride updated successfully!');
    }

    public function deleteRide($id)
    {
        $ride = Ride::findOrFail($id);
        $ride->delete();
        return redirect()->back()->with('success', 'Ride deleted successfully!');
    }
}
