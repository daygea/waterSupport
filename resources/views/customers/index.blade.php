@extends('layouts.app')

@section('title', 'All Customers')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	        		<i class="fa fa-users"> Customers</i>
	        		<a class="btn btn-default pull-right" href="{{ url('new_customer') }}"> Create Customer</a>
	        	</div>

	        	<div class="panel-body">
	        		@if ($customers->isEmpty())
						<p>There are currently no tickets.</p>
	        		@else
		        		<table class="table table-bordered">
		        			<thead>
		        				<tr>
		        					<th>S/N</th>		        					
		        					<th>Customer Name</th>
		        					<th>Phone</th>
		        					<th>Address</th>
		        					<th>Zone</th>		        					
		        					<th style="text-align:center">Actions</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        			@foreach ($customers as $index => $customer)
								<tr>
									<td>{{$customers->firstItem() + $index}}</td>
		        					
		        					<td>{{ $customer->name }}</td>
		        					
		        					<td>{{ $customer->phone }}</td>

		        					<td>{{ $customer->address }}</td>

		        					<?php $zone = \DB::table('categories')->where('id',$customer->zone)->first(); ?>
		        					<td>{{ $zone->name }}</td>	

		        					<td><a href="/edit_customer/{{$customer->id}}" class="btn btn-primary">Edit</a></td>		        					
		        					
		        				</tr>
		        			@endforeach
		        			</tbody>
		        		</table>

		        		{{ $customers->render() }}
		        	@endif
	        	</div>
	        </div>
	    </div>
	</div>
@endsection