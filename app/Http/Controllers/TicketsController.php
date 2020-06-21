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

class TicketsController extends Controller
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
    	$tickets = Ticket::orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();

        return view('tickets.index', compact('tickets', 'categories'));
    }

    /**
     * Display all tickets by a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function userTickets()
    {
        $tickets = Ticket::paginate(10);
        $categories = Category::all();

        return view('tickets.user_tickets', compact('tickets', 'categories'));
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

        return view('tickets.create', compact('categories','products'));
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
            'title'     => 'required',
            'category'  => 'required',
            'phone'  => 'required',
            'qty'  => 'required',
            'type'  => 'required',
            // 'priority'  => 'required',
            'message'   => 'required'
        ]);

        $productInfo = \DB::table('products')->where('id','=',$request->title)->first();
        $productQty = $productInfo->product_qty;
        $remainder = ($productQty - $request->input('qty'));
            
        // Decrement the product quantity in the products table by how many a user bought of a certain product.
        if($remainder < 0){                

            // flash()->error('danger', 'We are out of stock with the product ' .$productInfo->product_qty .' ' .$productInfo->product_name .' you specified.');

            return redirect()->back()->with("error", "We are out of stock with the product " .$request->input('qty') ." " .$productInfo->product_name ." you specified.");

            // return redirect()->route('/admin/tickets');
        }

        if ($request->type == 'retail'){
            $price = $productInfo->price;
        } else {
            $price = $productInfo->reduced_price;
        }

        $ticket = new Ticket([
            'customer_name'  => $request->name,
            'title'     => $productInfo->product_name,
            'user_id'   => Auth::user()->id,
            'ticket_id' => strtoupper(str_random(10)),
            'category_id'  => $request->input('category'),
            'qty'  => $request->input('qty'),
            'price' => $request->input('qty') * $price,
            'phone'  => $request->input('phone'),
            // 'priority'  => $request->input('priority'),
            'message'   => $request->input('message'),
            'status'    => "Open",
        ]);

        $ticket->save();

        \DB::table('products')->where('id','=',$request->title)->update(['product_qty' => $remainder]);

        $customer = \DB::table('customer')->where('name','=',$request->name)->where('phone','=', $request->phone)->first();
        if(count($customer) > 0){
            return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
        }

        \DB::table('customer')->insert([
                                            'name' => $request->name,
                                            'phone' => $request->phone,
                                            'zone' => $request->category,
                                            'address' => $request->message

                                            ]);

        // $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
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

    public function print($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();        

        $category = $ticket->category;        

        return view('tickets.print', compact('ticket', 'category'));
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
