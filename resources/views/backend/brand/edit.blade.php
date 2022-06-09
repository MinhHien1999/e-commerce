@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><a href="{{route('brand.index')}}" style="text-decoration: none; color: white;">{{ucfirst(request()->segment(2))}}</a></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit {{ucfirst(request()->segment(2))}}</li>
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
                                <h3 class="card-title">Edit</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{route('brand.update',$dataBrand->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputTitle">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Title" value="{{$dataBrand->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" value="{{$dataBrand->image}}">
                                                <label class="custom-file-label" for="exampleInputFile">{{$dataBrand->image}}</label>
                                            </div>
                                            {{-- <div class="input-group-append">
                                              <span class="input-group-text">Upload</span>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image Old</label>
                                        <div class="input-group">
                                            <img src="{{URL('upload/'.request()->segment(2).'/'.$dataBrand->image)}}" alt="" width="200px" height="100px">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputstatus">Status</label>
                                        <select name="status" class="form-control">
                                            @if($dataBrand->status == 'active')
                                                <option selected value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            @else
                                                <option value="active">Active</option>
                                                <option selected value="inactive">Inactive</option>
                                            @endif
                                        </select>
                                    </div>
                                    {{-- <div class="form-check">
                                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div> --}}
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
@endpush
