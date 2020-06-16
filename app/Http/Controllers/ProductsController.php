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

class ProductsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display all products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = DB::table('products')->get();

        return view('products.index', compact('products'));
    }

    /**
     * Display all products.
     *
     * @return \Illuminate\Http\Response
     */
    public function userTickets()
    {
        // $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        // $categories = Category::all();

        // return view('tickets.user_tickets', compact('tickets', 'categories'));
    }

    /**
     * Show the form for opening a new ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('products.create', compact(''));
    }

    /**
     * Store a newly created product in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AppMailer $mailer)
    {

        $this->validate($request, [
            'title'     => 'required',
            'qty'  => 'required',
            'unit_price'  => 'required',
            'message'   => 'required'
        ]);        

        \DB::table('products')->insert([
            'product_name' => $request->title, 
            'product_qty' => $request->qty, 
            'price' => $request->unit_price, 
            // 'reduced_price' =>$request->reduced_price, 
            'description' => $request->message ]);

        // $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("status", "Product created successfully!");
    }


      /**
     * Update product in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppMailer $mailer)
    {

        $this->validate($request, [
            'title'     => 'required',
            'qty'  => 'required',
            'unit_price'  => 'required',
            'message'   => 'required'
        ]);        

        \DB::table('products')->where('id','=',$request->id)->update([
            'product_name' => $request->title, 
            'product_qty' => $request->qty, 
            'price' => $request->unit_price, 
            // 'reduced_price' =>$request->reduced_price, 
            'description' => $request->message, 
            'updated_at' => DB::raw('NOW()') ]);

        // $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("status", "Product updated successfully!");
    }

    /**
     * Show the form for updating a product.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $product = DB::table('products')->where('id', $product_id)->first();
        return view('products.edit', compact('product'));
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
