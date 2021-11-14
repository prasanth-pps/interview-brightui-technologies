@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($message = Session::get('success'))
                        <div class="alert alert-success ">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                @if ($message = Session::get('deleted'))
                        <div class="alert alert-danger ">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                @if ($message = Session::get('updated'))
                        <div class="alert alert-info ">
                            <p>{{ $message }}</p>
                        </div>
                @endif
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form method="POST" id="submit_form"  action="{{ route('product.store') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name ') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="product_name" value="{{ old('name') }}" required  autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Product Category ') }}</label>
                            <div class="col-md-6">
                            <select  name="product_category" placeholder="" class="form-control">
                                <option value="" selected="selected" disabled="disabled" class=" font-sans">{{__('Select Product Category')}}</option>
                                  @foreach($productCategory as $val)
                                          <option value="{{$val->id}}">{{ucwords($val->name)}}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Product Model ') }}</label>
                            <div class="col-md-6">
                            <select  name="product_model" placeholder="" class="form-control">
                                <option value="" selected="selected" disabled="disabled" class=" font-sans">{{__('Select Product Model')}}</option>
                                  @foreach($productModel as $val)
                                          <option value="{{$val->id}}">{{ucwords($val->name)}}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product selling price  ') }}</label>

                            <div class="col-md-6">
                                <input  type="number" class="form-control" name="selling_price" value="{{ old('selling_price') }}" required  >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product cost price ') }}</label>

                            <div class="col-md-6">
                                <input  type="number" class="form-control" name="cost_price" value="{{ old('cost_price') }}" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('GST  ') }}</label>

                            <div class="col-md-6">
                                <input  type="number" class="form-control" name="gst" value="{{ old('gst') }}" required  >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('CGST ') }}</label>

                            <div class="col-md-6">
                                <input  type="number" class="form-control" name="cgst" value="{{ old('cgst') }}" required >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('SGST  ') }}</label>
                            <div class="col-md-6">
                                <input  type="number" class="form-control" name="sgst" value="{{ old('sgst') }}" required  >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('SGST  ') }}</label>
                            <div class="col-md-6">
                                <input  type="file" multiple class="form-control" id="file" name="file[]" required  >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Description  ') }}</label>
                            <div class="col-md-6">
                                <textarea  class="form-control" name="product_description" > {{ old('product_description') }}</textarea>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
