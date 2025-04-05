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
        if ($request->isMethod('post')) {
            $vehicle = $this->firebase->getReference('vehicles/' . $request->input('car_details'))->getValue();
            $pickup = $this->firebase->getReference('locations/' . $request->input('pickup'))->getValue();
            $destination = $this->firebase->getReference('locations/' . $request->input('destination'))->getValue();
            if ($pickup['id'] == $destination['id']) {
                return redirect()->back()->with('error', 'Pickup and destination cannot be the same!');
            }
            if (!$vehicle || !$pickup || !$destination) {
                return redirect()->back()->with('error', 'Invalid vehicle or location selected!');
            }
            $pickupPoints = array_filter($this->firebase->getReference('locations')->getValue(), function ($location) use ($request) {
                return isset($location['parentId']) && $location['parentId'] == $request->input('pickup');
            });
            $dropoffPoints = array_filter($this->firebase->getReference('locations')->getValue(), function ($location) use ($request) {
                return isset($location['parentId']) && $location['parentId'] == $request->input('destination');
            });
            if (empty($pickupPoints) || empty($dropoffPoints)) {
                return redirect()->back()->with('error', 'No pickup or dropoff points found!');
            }

            $tmpLocation = [
                "Điểm dừng 1",
                "Điểm dừng 2",
                "Điểm dừng 3",
            ];

            $rideData = [
                'id' => uniqid(),
                'car_details' => $vehicle['name'],
                'company' => $request->input('company'),
                'date' => $request->input('date'),
                'destination' => $destination['name'],
                'pickup' => $pickup['name'],
                'price' => (int) $request->input('price'),
                'status' => 'upcoming',
                'time' => $request->input('time'),
                'availableSeats' => $vehicle['seats'],
                'totalSeats' => $vehicle['seats'],
                'pickupPoints' => $pickupPoints,
                'dropoffPoints' => $dropoffPoints,
                'tmpLocation' => $tmpLocation,
            ];

            $this->firebase->getReference('rides/' . $rideData['id'])->set($rideData);

            return redirect()->route('rides.index')->with('success', 'Ride added successfully!');
        }

        $vehicles = $this->firebase->getReference('vehicles')->getValue();
        $drivers = $this->firebase->getReference('drivers')->getValue();
        $locationsData = $this->firebase->getReference('locations')->getValue();
        $locations = is_array($locationsData) ? array_filter($locationsData, function ($location) {
            return isset($location['id']) && $location['id'] < 100;
        }) : [];
        return view('rides.add', compact('vehicles', 'drivers', 'locations'));
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
        $rideData = $this->firebase->getReference('rides/' . $id)->getValue();
        if ($rideData) {
            if ($rideData['status'] == 'upcoming') {
                $this->firebase->getReference('rides/' . $id)->remove();
            } else {
                return redirect()->back()->with('error', 'Cannot delete ongoing or completed rides!');
            }
        } else {
            return redirect()->back()->with('error', 'Ride not found!');
        }
        return redirect()->back()->with('success', 'Ride deleted successfully!');
    }
}
