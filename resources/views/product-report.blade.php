@extends('layouts.master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                    <div class="card-header">Product Report</div>

                    <div class="card-body">
                        <div class="content-body">
                            <!-- Basic form layout section start -->
                            <section id="configuration">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-content collapse show">
                                                <div class="card-body card-dashboard">
                                                    <div class="table-responsive">
                                                        <form class="form-inline" method="GET">
                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Product Model ') }}</label>
                                                                <div class="col-md-6">
                                                                <select id="product_model"  name="product_model" placeholder="" class="form-control">
                                                                    <option value="0"  class=" font-sans">{{__('Select Product Model')}}</option>
                                                                    @foreach($productModel as $val)
                                                                            <option value="{{$val->id}}">{{ucwords($val->name)}}</option>
                                                                    @endforeach
                                                                </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Product Category ') }}</label>
                                                                <div class="col-md-6">
                                                                <select  id="product_category" name="product_category" placeholder="" class="form-control">
                                                                    <option value="0" class=" font-sans">{{__('Select Product Category')}}</option>
                                                                    @foreach($productCategory as $val)
                                                                            <option value="{{$val->id}}">{{ucwords($val->name)}}</option>
                                                                    @endforeach
                                                                </select>
                                                                </div>
                                                            </div>
                                                            <button type="button" onclick="paginationProduct()" class="btn btn-info">Search</button>
                                                          </form>
                                
                                                        <table id="data_table_list" class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Name</th>
                                                                    <th>Category</th>
                                                                    <th>Model</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- // Basic form layout section end -->
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script src = "https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js" defer ></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" defer ></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer ></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" defer ></script>
    <script src = "https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js" defer ></script>
    <script src = "https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js" defer ></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">  
    <Script src="{{asset('js/report.js')}}"></Script>
@endsection
