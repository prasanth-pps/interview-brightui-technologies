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
                    <div class="card-header">Product List</div>

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
                                                        <table class="table table-bordered table-hover">
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Name</th>
                                                                <th>Category</th>
                                                                <th>Model</th>
                                                                <th>Image</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i = ($product->currentpage() - 1) * $product->perpage(); ?>
                                                                @foreach ($product as $key)
                                                                    <tr>
                                                                        <td>{{ ++$i }}</td>
                                                                        <td>{{ $key->product_name }}</td>
                                                                        <td>{{ $key->productcategory->name }}</td>
                                                                        <td>{{ $key->productmodel->name }}</td>
                                                                        <td><img src="uploads/{{ $key->productfile->name  ?? '#' }}" width="100px" alt=""></td>
                                                                        <td>
                                                                            <button type="button" attributeid="{{$key->id}}" class="btn btn-danger delete">Remove</button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        {!! $product->appends(Request::except('page'))->render() !!}
                                                        <p> Showing <?php echo ($product->currentpage() - 1) * $product->perpage() + 1; ?> to {{ $i }} of {{ $product->total() }} entries.</p>
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
    <script>
        $(document).on('click','.delete',function(){
            var product_id = $(this).attr("attributeid");
            var confirm_msg = confirm("Are You Sure ?");
            if(confirm_msg){
                $.ajax({
                    type:"get",
                    url:"product-delete",
                    data:{'product_id': product_id},
                    success:function(res){
                        if(res == 0){
                            window.location.reload();
                        }else{
                            alert("Please Check the Details");
                        }
                    }
                });
            }
        });
    </script>
@endsection
