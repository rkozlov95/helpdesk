<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['subject' => 'required', 'message' => 'required']);
        $request->file('file')->store('uploads', 'public');
        $path = $request->file('file')->hashName();
        $user_id = Auth::user()->id;
        $ticket = new Ticket([
            'subject'   => $request->input('subject'),
            'user_id'   => $user_id,
            'message'   => $request->input('message'),
            'status'    => "Open",
            'path' => $path,
        ]);

        $prevTicket = Ticket::whereDate('created_at', Carbon::today())->where('user_id', $user_id)->get()->toArray();

    	if ($prevTicket) {
		    return redirect('/tickets')->with('warning', 'Ticket can be created only once a day');
		}

        $ticket->save();

        return redirect('/tickets')->with('success', 'Ticket has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::where('id', $id)->firstOrFail();
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
