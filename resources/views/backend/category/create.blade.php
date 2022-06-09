@extends('backend.layouts.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><a href="{{route('category.index')}}" style="text-decoration: none; color: white;">{{ucfirst(request()->segment(2))}}</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('category.index')}}">Home</a></li>
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
              <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputTitle">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" checked id="is_parent" value="1" name="is_parent">
                    <label class="form-check-label" for="exampleCheck1">is parent</label>
                  </div>
                  <div class="form-group d-none" id="parent">
                    {{-- <label>Custom Select</label> --}}
                    <select class="custom-select" name="parent_id">
                      <option value="" selected>-- Choose Parent Category --</option>
                      @foreach($parent_cats as $parent)
                      <option value="{{$parent->id}}">{{$parent->title}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputstatus">Status</label>
                    <select name="status" class="form-control">
                      <option selected value="active">Active</option>
                      <option value="inactive">Inactive</option>
                    </select>
                  </div>
                  {{-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> --}}
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
    $('#is_parent').change(function(e){
      e.preventDefault();
      var check = $(this).prop('checked');
      if(check){
        $('#parent').addClass('d-none');
        $('#parent').val('');
      }else{
        $('#parent').removeClass('d-none');
      }
    })
  </script>
@endpush
