@extends('layouts.app')

@section('title', 'All Tickets')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	        		<i class="fa fa-ticket"> Tickets</i>
	        		<a class="btn btn-default pull-right" href="{{ url('new_ticket') }}"> Create Ticket</a>
	        	</div>

	        	<div class="panel-body">
	        		@if ($tickets->isEmpty())
						<p>There are currently no tickets.</p>
	        		@else
		        		<table class="table table-bordered">
		        			<thead>
		        				<tr>
		        					<th>S/N</th>
		        					<th>Title</th>	
		        					<th>Quantity</th>	        					
		        					<th>Name</th>
		        					<th>Phone</th>
		        					<th>Zone</th>		        					
		        					<!-- <th>Priority</th> -->
		        					<th>Status</th>
		        					<th>Updated</th>
		        					<th style="text-align:center" colspan="3">Actions</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        			@foreach ($tickets as $index => $ticket)
								<tr>
									<td>{{$tickets->firstItem() + $index}}</td>
									<td>
		        						<a href="{{ url('tickets/'. $ticket->ticket_id) }}">
		        							{{ $ticket->title }}
		        						</a>
		        					</td>
		        					<td>        						
		        							{{ $ticket->qty }}		        						
		        					</td>
		        					
		        					<td>{{ $ticket->customer_name }}</td>
		        					<td>{{ $ticket->phone }}</td>
		        					<td>
		        					@foreach ($categories as $category)
		        						@if ($category->id === $ticket->category_id)
											{{ $category->name }}
		        						@endif
		        					@endforeach
		        					</td>		        							        			
		        					<!-- <td>{{ $ticket->priority }}</td> -->
		        					<td>
		        					@if ($ticket->status === 'Open')
		        						<span class="label label-success">{{ $ticket->status }}</span>
		        					@else
		        						<span class="label label-danger">{{ $ticket->status }}</span>
		        					@endif
		        					</td>
		        					
		        					<td>{{ $ticket->updated_at->diffForHumans() }}</td>
		        					<td>
		        						<a href="{{ url('tickets/' . $ticket->ticket_id) }}" class="btn btn-primary">Comment</a>
		        					</td>
		        					<td>
		        						<form action="{{ url('admin/close_ticket/' . $ticket->ticket_id) }}" method="POST">
		        							{!! csrf_field() !!}
		        							<button type="submit" class="btn btn-danger">Close</button>
		        						</form>
		        					</td>
		        					<td>
		        						<a href="{{ url('tickets/print/' . $ticket->ticket_id) }}" class="btn btn-default">Print</a>
		        					</td>
		        				</tr>
		        			@endforeach
		        			</tbody>
		        		</table>

		        		{{ $tickets->render() }}
		        	@endif
	        	</div>
	        </div>
	    </div>
	</div>
@endsection