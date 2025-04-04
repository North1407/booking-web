<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $ticketsData = $this->firebase->getReference('tickets')->getValue();
        $tickets = is_array($ticketsData) ? array_filter($ticketsData, function ($ticket) {
            return $ticket !== null;
        }) : [];
        return view('tickets.table', compact('tickets'));
    }

    public function detailTicket($id)
    {
        $ticketData = $this->firebase->getReference('tickets/' . $id)->getValue();
        $ticket = is_array($ticketData) ? array_filter($ticketData, function ($ticket) {
            return $ticket !== null;
        }) : [];
        return view('tickets.detail', compact('ticket'));
    }

    public function addTicket(Request $request)
    {
        $ticketData = $request->all();
        $this->firebase->getReference('tickets')->push($ticketData);
        return redirect()->back()->with('success', 'Ticket added successfully!');
    }

    public function deleteTicket($id)
    {
        $this->firebase->getReference('tickets/' . $id)->remove();
        return redirect()->back()->with('success', 'Ticket deleted successfully!');
    }

    public function updateStatus($id)
    {
        $this->firebase->getReference('tickets/' . $id)->update(['status' => 'Đã thanh toán']);
        return redirect()->back()->with('success', 'Ticket status updated successfully!');
    }
}
