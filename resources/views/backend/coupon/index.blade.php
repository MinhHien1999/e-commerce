@extends('backend.layouts.master')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ucfirst(request()->segment(2))}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">{{ucfirst(request()->segment(2))}} List</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-1">
                    <a href="{{route('coupon.create')}}">
                      <button type="button" class="btn btn-block bg-gradient-primary">Add
                      </button>
                    </a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align: center;">id</th>
                    <th style="text-align: center;">Code</th>
                    <th style="text-align: center;">Type</th>
                    <th style="text-align: center;">Value</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($dataCoupon as $coupon)
                  <tr id="item-{{$coupon->id}}">
                    <td style="text-align: center;">
                        <p style="color:white">
                          {{$coupon->id}}
                      </p>
                    </td>
                    <td style="text-align: center;">
                      <p style="color:white">
                        {{$coupon->code}}
                      </p>
                    </td>
                    <td style="text-align: center;">
                      <p style="color:white">
                        {{$coupon->type}}
                      </p>
                    </td>
                    <td style="text-align: center;">
                      <p style="color:white">
                        {{$coupon->type == "percent" ? number_format($coupon->value,0,',','.').'%' : number_format($coupon->value,0,',','.').'đ'}}
                      </p>
                    </td>
                    <td style="text-align: center;">
                      @if($coupon->status == 'active')
                        <input type="checkbox" checked name="status" data-toggle="toggle" data-on="Active" data-off="inactive" data-onstyle="success" data-offstyle="danger" value="{{$coupon->id}}">
                      @else
                        <input type="checkbox" name="status" data-toggle="toggle" data-on="Active" data-off="inactive" data-onstyle="success" data-offstyle="danger" value="{{$coupon->id}}">
                      @endif
                    </td>
                    <td style="text-align: center;">
                      <a href="{{route('coupon.edit',$coupon->id)}}">
                        <i class="fas fa-edit">
                        </i>
                      </a>
                      <a href="javascript:void(0)" name="deleteCoupon" value="{{$coupon->id}}">
                        <i class="fas fa-trash-alt">
                        </i>
                      </a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default-{{$coupon->id}}" id="couponID-{{$coupon->id}}" value="{{$coupon->id}}">
                            <i class="fas fa-eye">
                            </i>
                        </a>
                        <form method="post" action="{{route('coupon.destroy',$coupon->id)}}" enctype="multipart/form-data" name="deleteCoupon" id="delete-{{$coupon->id}}">
                          @method('delete')
                          @csrf
                            {{-- <button type="submit" class="fas fa-trash-alt">
                            </button> --}}
                        </form>
                        <div class="modal fade" id="modal-default-{{$coupon->id}}">
                            <div class="modal-dialog">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" style="color: white">Detail</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <strong style="color: white">Id:</strong>
                                                <p style="color: white">{{$coupon->id}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <strong style="color: white">Coupon:</strong>
                                                <p style="color: white">{{$coupon->code}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-6">
                                            <strong style="color: white">Type:</strong>
                                            <p style="{{$coupon->type == 'percent' ? 'color: #00bc8c': 'color: #e74c3c'}};font-weight:700">{{$coupon->type}}</p>
                                          </div>
                                          <div class="col-md-6">
                                              <strong style="color: white">Status:</strong>
                                              <p style="{{$coupon->status == 'active' ? 'color: #00bc8c': 'color: #e74c3c'}};font-weight:700">{{$coupon->status}}</p>
                                          </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong style="color: white">Value:</strong>
                                                <p style="color: white">
                                                  {{$coupon->type == "percent" ? number_format($coupon->value,0,',','.').'%' : number_format($coupon->value,0,',','.').'đ'}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </td>
                  </tr>
                  @endforeach
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@push('styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <style>
      button.fas.fa-trash-alt{
        -webkit-text-size-adjust: 100%;
        -webkit-tap-highlight-color: transparent;
        --blue: #007bff;
        --indigo: #6610f2;
        --purple: #6f42c1;
        --pink: #e83e8c;
        --red: #dc3545;
        --orange: #fd7e14;
        --yellow: #ffc107;
        --green: #28a745;
        --teal: #20c997;
        --cyan: #17a2b8;
        --white: #fff;
        --gray: #6c757d;
        --gray-dark: #343a40;
        --primary: #007bff;
        --secondary: #6c757d;
        --success: #28a745;
        --info: #17a2b8;
        --warning: #ffc107;
        --danger: #dc3545;
        --light: #f8f9fa;
        --dark: #343a40;
        --breakpoint-xs: 0;
        --breakpoint-sm: 576px;
        --breakpoint-md: 768px;
        --breakpoint-lg: 992px;
        --breakpoint-xl: 1200px;
        --font-family-sans-serif: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
        --font-family-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
        font-size: 1rem;
        text-align: left;
        word-wrap: break-word;
        border-collapse: separate !important;
        border-spacing: 0;
        color: #007bff;
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        line-height: 1;
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
      }
    </style>
@endpush

@push('scripts')
<!-- DataTables  & Plugins -->
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
    <!-- SweetAlert -->
    <script src="{{asset('backend/plugins/sweetalert.min.js')}}"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
    </script>
    <script>
      $('input[name=status]').change(function () {
        var id = $(this).val();
        var check = $(this).prop('checked');
        // console.log(id);
        $.ajax({
          url: "{{route('coupon.status')}}",
          type: 'POST',
          data: {
            _token: '{{csrf_token()}}',
            check: check,
            id: id
          },
          success: function(response) {
            if(response.message){
              swal(response.message);
              // alert(response.message);
            }
          }
        })
      })

      $('a[name=deleteCoupon]').click(function() {
        var id = $(this).attr('value');
        var form = document.getElementById(`delete-${id}`);
        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
            swal("Poof! Your imaginary Coupon has been deleted!", {
              icon: "success",
            });
          } else {
            swal("Your imaginary Coupon is safe!");
          }
        });
      });

    </script>
@endpush
