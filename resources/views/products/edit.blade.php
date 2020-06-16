@extends('layouts.app')

@section('title', 'Open Ticket')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	            <div class="panel-heading">Update Product</div>

	            <div class="panel-body">
                    @include('includes.flash')

	                <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/products') }}">
                        {!! csrf_field() !!}

                       
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" autocomplete="off" type="text" class="form-control" name="title" value="{{ $product->product_name}}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       <input type="hidden" name="id" value="{{$product->id}}">

                        <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
                            <label for="qty" class="col-md-4 control-label">Quantity</label>

                            <div class="col-md-6">
                                <input id="qty" autocomplete="off" type="number" class="form-control" name="qty" value="{{ $product->product_qty }}">

                                @if ($errors->has('qty'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qty') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('unit_price') ? ' has-error' : '' }}">
                            <label for="qty" autocomplete="off" class="col-md-4 control-label">Unit Price</label>

                            <div class="col-md-6">
                                <input id="unit_price" type="number" class="form-control" name="unit_price" value="{{ $product->price }}">

                                @if ($errors->has('unit_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('unit_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- <div class="form-group{{ $errors->has('reduced_price') ? ' has-error' : '' }}">
                            <label for="qty" autocomplete="off" class="col-md-4 control-label">Wholesale Price</label>

                            <div class="col-md-6">
                                <input id="reduced_price" type="number" class="form-control" name="reduced_price" value="{{ $product->reduced_price }}">

                                @if ($errors->has('reduced_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reduced_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         -->

                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <textarea rows="5" id="message" class="form-control" name="message">{{$product->description}}</textarea>

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
                                    <i class="fa fa-btn fa-ticket"></i> Update Product
                                </button>
                            </div>
                        </div>
                    </form>
	            </div>
	        </div>
	    </div>
	</div>
@endsection