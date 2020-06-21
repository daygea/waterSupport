@extends('layouts.app')

@section('title', $ticket->title)

@section('content')
	<div class="row" id='printReceipt'>
		<div class="col-md-5 col-md-offset-1">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	        		<center>Lacra Water</center>
	        	</div>

	        	<div class="panel-body">
	        			        		
	        		<div class="ticket-info">
	        			<center>
	        			<p>#{{ $ticket->ticket_id }}</p>
	        			<h4>{{ $ticket->qty }} {{ $ticket->title }}</h4>	        			
	        			<p>{{ $ticket->customer_name }} ({{ $ticket->phone }})</p>
	        			<p>{{ $ticket->message }}, {{ $category->name }}</p>		        		
		        		<p>
		        		Amount: N{{number_format($ticket->price)}}        			
		        		</p>
		        		<p>Date: {{ date('d-m-Y')}}</p><br>

		        		<hr/>
		        		Signature
		        		</center>
	        		</div>	        		
	        	</div>

	    	</div>
		</div>
		<div class="col-md-5">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
	        		<center>Lacra Water</center>
	        	</div>

	        	<div class="panel-body">
	        			        		
	        		<div class="ticket-info">
	        			<center>
	        			<p>#{{ $ticket->ticket_id }}</p>
	        			<h4>{{ $ticket->qty }} {{ $ticket->title }}</h4>	        			
	        			<p>{{ $ticket->customer_name }} ({{ $ticket->phone }})</p>
	        			<p>{{ $ticket->message }}, {{ $category->name }}</p>		        		
		        		<p>
		        		Amount: N{{number_format($ticket->price)}}        			
		        		</p>
		        		<p>Date: {{ date('d-m-Y')}}</p><br>

		        		<hr/>
		        		Signature
		        		</center>
	        		</div>	        		
	        	</div>

	    	</div>
		</div>
		<a onclick="PrintElem('printReceipt')" class="no-printme btn btn-default">Print</a>
	</div>

	<script type="text/javascript">
		function PrintElem(divName)
			{
			    var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
			}
	</script>
@endsection