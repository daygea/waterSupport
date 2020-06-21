@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	            <div class="panel-heading">Open New Ticket</div>

	            <div class="panel-body">
                    @include('includes.flash')

	                <form class="form-horizontal" role="form" method="POST" action="{{ url('/new_ticket') }}">
                        {!! csrf_field() !!}                      


                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Product</label>

                            <div class="col-md-6">
                                <select id="title" type="category" class="form-control" name="title" value="{{ old('title') }}">>
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                            <label for="qty" class="col-md-4 control-label">Quantity</label>

                            <div class="col-md-6">
                                <input id="qty" type="number" class="form-control" name="qty" value="{{ old('qty') }}">

                                @if ($errors->has('qty'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qty') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">

                            <div class="col-md-6 col-md-offset-4">
                            
                                Retail <input type="radio" name="type" value="retail" checked>
                                &nbsp &nbsp &nbsp
                                Wholesale <input type="radio" name="type" value="wholesale">
                            </div>

                        </div>


                         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Customer</label>

                            <div class="col-md-6">
                                <input autocomplete="off" id="name" type="text" class="form-control typeahead" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input autocomplete="off" id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Zone</label>

                            <div class="col-md-6">
                                <select id="category" type="category" class="form-control" name="category" value="{{ old('category') }}">
                                	<option value="">Select Zone</option>
                                	@foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
                                	@endforeach
                                </select>

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                         

                       <!--  <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                            <label for="priority" class="col-md-4 control-label">Priority</label>

                            <div class="col-md-6">
                                <select id="priority" type="" class="form-control" name="priority" value="{{ old('priority') }}">
                                	<option value="">Select Priority</option>
                                	<option value="Low">Low</option>
                                	<option value="Medium">Medium</option>
                                	<option value="High">High</option>
                                </select>

                                @if ($errors->has('priority'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('priority') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <textarea rows="5" id="message" class="form-control" name="message"></textarea>

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-ticket"></i> Open Ticket
                                </button>
                            </div>
                        </div>
                    </form>
	            </div>
	        </div>
	    </div>
	</div>

    <script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
    </script>
@endsection