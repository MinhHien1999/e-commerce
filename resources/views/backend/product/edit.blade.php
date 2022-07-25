@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><a href="{{route('product.index')}}" style="text-decoration: none; color: white;">{{ucfirst(request()->segment(2))}}</a></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                            <li class="breadcrumb-item active">Add {{ucfirst(request()->segment(2))}}</li>
                        </ol>
                    </div>
                    @include('backend.layouts.notification')
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{route('product.update',$dataProduct->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputTitle">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{$dataProduct->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTitle">Price</label>
                                        <div class="input-group">
                                            <input type="number" name="price" class="form-control" placeholder="Price" value="{{$dataProduct->price}}" min="0">
                                            <span class="input-group-text">$</span>
                                            {{--                                            <span class="input-group-text">0.00</span>--}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTitle">Stocks</label>
                                        <div class="input-group">
                                            <input type="number" name="stock" class="form-control" placeholder="stock" value="{{$dataProduct->stock}}" min="0">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputTitle">Discount</label>
                                        <div class="input-group">
                                            <input type="number" name="discount" class="form-control" placeholder="Discount (Max:100)" value="{{$dataProduct->discount}}" min="0" aria-label="Dollar amount (with dot and two decimal places)">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="parent">
                                        <label>Category</label>
                                        <select class="custom-select" name="cat_id" id="cat_id">
                                            <option value="">-- Choose Category --</option>
                                            @foreach(\App\Models\Category::orderBy('id', 'DESC')->where('is_parent',1)->get() as $category)
                                                <option value="{{$category->id}}" {{$dataProduct->cat_id == $category->id ? 'selected': ''}}>{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
{{--                                    {{ dd($dataProduct->child_cat_id) }}--}}
                                    <div class="form-group {{$dataProduct->child_cat_id == null ? 'd-none': ''}}" id="cat_child">
                                        <label>Category Child</label>
                                        <select class="custom-select" name="child_cat_id" id="cat_child_select">
                                            @foreach(\App\Models\Category::orderBy('id', 'DESC')->where(['is_parent' => 0,'parent_id' => $dataProduct->cat_id])->get() as $category)
                                                <option value="{{$category->id}}" {{$dataProduct->child_cat_id == $category->id ? 'selected': ''}}>{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" id="parent">
                                        <label>Brand</label>
                                        <select class="custom-select" name="brand_id">
                                            <option value="" selected>-- Choose Brand --</option>
                                            @foreach(\App\Models\Brand::getAllBrand() as $parent)
                                                <option value="{{$parent->id}}" {{$dataProduct->brand_id == $parent->id ? 'selected':''}}>{{$parent->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputDescription">Description</label>
                                        <textarea name="description" id="summernote">
                                            {{$dataProduct->description}}
                                        </textarea>
                                    </div>
                                    <img id="holder" style="margin-top:15px;max-height:100px;">
                                    <div class="form-group">
                                        <label for="exampleInputstatus">Status</label>
                                        <select name="status" class="form-control">
                                            <option {{$dataProduct->status == 'active' ? 'selected':''}} value="active">Active</option>
                                            <option {{$dataProduct->status == 'inactive' ? 'selected':''}} value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
    <!-- bs-custom-file-input -->
    <script src="{{asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>

    <script>
        $('#cat_id').change(function (){
            let cat_id = $(this).val();

            if (cat_id != ''){
                $.ajax({
                    url:"{{route('category.getChild')}}",
                    type: "POST",
                    data: {
                        _token: '{{csrf_token()}}',
                        cat_id: cat_id,
                    },
                    success:function (response) {
                        // console.log(response.status);
                        let optionHtml = "<option value='' selected>-- Choose Cat Child --</option>";
                        if( response.status == undefined ){
                            $('#cat_child').removeClass('d-none');
                            // console.log(response.data);
                            $.each(response.data, function (title,id){
                                optionHtml += "<option value='"+id+"'>"+title+"</option>";
                                $('#cat_child_select').html(optionHtml);
                                // console.log(optionHtml);
                            })
                        }else{
                            // console.log('null');
                            $('#cat_child').addClass('d-none');
                        }
                    }
                })
            }
        })
    </script>
@endpush
