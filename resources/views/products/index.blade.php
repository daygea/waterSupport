@extends('layouts.app')

@section('title', 'All Products')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	        		<i class="fa fa-ticket"> Products</i>
	        		<a class="btn btn-default pull-right" href="{{ url('new_product') }}"> Create Product</a>
	        	</div>

	        	<div class="panel-body">
	        		@if (count($products) == 0)
						<p>There are currently no quota.</p>
	        		@else
		        		<table class="table table-bordered">
		        			<thead>
		        				<tr>
		        					<th>S/N</th>		        					
		        					<th>Title</th>
		        					<th>Quantity</th>
		        					<th>Unit Price</th>	
		        					<th>Wholesale Price</th>			
		        					<th>Last Updated</th>
		        					<th style="text-align:center" colspan="3">Actions</th>
		        				</tr>
		        			</thead>
		        			<tbody>
		        			@foreach ($products as $index => $product)
								<tr>
									<td>{{$index +1}}</td>
		        					
		        					<td>		        						
		        						{{ $product->product_name }}		        						
		        					</td>
		        					<td>		        						
		        						{{ number_format($product->product_qty) }}		        						
		        					</td>        					
		        					<td>		        						
		        						N{{ number_format($product->price) }}		        						
		        					</td>   
		        					<td>		        						
		        						N{{ number_format($product->reduced_price) }}		        						
		        					</td>  
		        					<td>{{ $product->updated_at }}</td>
		        					<td>
		        						<a href="{{ url('admin/products/' . $product->id) }}" class="btn btn-primary">Edit</a>
		        					</td>
		        					@if (Auth::user()->is_admin)
		        					<!-- <td>
		        						<a href="{{ url('admin/products/' . $product->id) }}" class="btn btn-danger">Delete</a>
		        					</td> -->
		        					@endif
		        				</tr>
		        			@endforeach
		        			</tbody>
		        		</table>

		        		
		        	@endif
	        	</div>
	        </div>
	    </div>
	</div>
@endsection