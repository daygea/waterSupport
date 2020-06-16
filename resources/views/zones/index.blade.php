@extends('layouts.app')

@section('title', 'All Zones')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	        		<i class="fa fa-map"> Zones</i>
	        		<a class="btn btn-default pull-right" href="{{ url('new_zone') }}"> Create Zone</a>
	        	</div>

	        	<div class="panel-body">
	        		@if ($zones->isEmpty())
						<p>There are currently no zones.</p>
	        		@else
		        		<table class="table table-bordered">
		        			<thead>
		        				<tr>
		        					<th>S/N</th>		        					
		        					<th>Name</th>		        						        					
		        					<th style="text-align:center">Actions</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        			@foreach ($zones as $index => $zone)
								<tr>
									<td>{{$zones->firstItem() + $index}}</td>
		        					
		        					<td>{{ $zone->name }}</td>

		        					<td><a href="/edit_zone/{{$zone->id}}" class="btn btn-primary">Edit</a></td>		        					
		        					
		        				</tr>
		        			@endforeach
		        			</tbody>
		        		</table>

		        		{{ $zones->render() }}
		        	@endif
	        	</div>
	        </div>
	    </div>
	</div>
@endsection