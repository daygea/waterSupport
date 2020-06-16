<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Category;
use App\Http\Requests;
use App\Mailers\AppMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CustomersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display all tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$customers = DB::table('customer')->paginate(10);
        

        return view('customers.index', compact('customers'));
    }


    /**
     * Show the form for opening a new ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = DB::table('products')->get();

    	$categories = Category::all();

        return view('customers.create', compact('categories','products'));
    }

    /**
     * Store a newly created ticket in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AppMailer $mailer)
    {


        $this->validate($request, [
            'name'     => 'required',
            'phone'     => 'required',
            'category'  => 'required'
        ]);

        $customer = DB::table('customer')->insert([
                                            'name' => $request->name,
                                            'phone' => $request->phone,
                                            'zone' => $request->category,
                                            'address' => $request->message

                                            ]);

        return redirect()->back()->with("status", "Customer ".$request->name ." created successfully!!!");
    }

    /**
     * Display a specified ticket.
     *
     * @param  int  $ticket_id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $comments = $ticket->comments;

        $category = $ticket->category;

        return view('tickets.show', compact('ticket', 'category', 'comments'));
    }


    public function edit($customer_id)
    {
        $customer = DB::table('customer')->where('id', $customer_id)->first();
        $categories = DB::table('categories')->get();
        return view('customers.edit', compact('customer','categories'));
    }


    public function update(Request $request, AppMailer $mailer)
    {

        $this->validate($request, [
            'name'     => 'required',
            'phone'     => 'required',
            'category'  => 'required'
        ]);        

         DB::table('customer')->where('id','=',$request->id)->update([
                                            'name' => $request->name,
                                            'phone' => $request->phone,
                                            'zone' => $request->category,
                                            'address' => $request->message

                                            ]);

        return redirect()->back()->with("status", "Customer ".$request->name ." updated successfully!!!");

    }

    /**
     * Close the specified ticket.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $ticket->status = 'Closed';

        $ticket->save();

        $ticketOwner = $ticket->user;

        // $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}
