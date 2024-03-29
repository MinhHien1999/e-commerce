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
              <li class="breadcrumb-item active">{{ucfirst(request()->segment(2))}} Detail</li>
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
                    <a href="{{route('order.index')}}">
                      <button type="button" class="btn btn-block bg-gradient-primary">Back
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
                            <th style="text-align: center;">name</th>
                            <th style="text-align: center;">quantity</th>
                            <th style="text-align: center;">price</th>
                            <th style="text-align: center;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartData as $cart)
                            <tr id="item-{{$cart->id}}">
                                <td style="text-align: center;">
                                    <p style="color:white">
                                    {{$cart->product->title}}
                                    </p>
                                </td>
                                <td style="text-align: center;">
                                <p style="color:white">
                                    {{$cart->quantity}}
                                </p>
                                </td>
                                <td style="text-align: center;">
                                <p style="color:white">
                                    {{number_format($cart->price, 0, '', '.') . ' đ'}}
                                </p>
                                </td>
                                <td style="text-align: center;">
                                    <p style="color:white">
                                    {{number_format($cart->amount, 0, '', '.') . ' đ'}}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"><h5 style="text-align: center;color:white">Subtotal</h5></td>
                            <td colspan="1"><h5 style="text-align: center; color: yellow">{{number_format($orderData->sub_total, 0, '', '.') . ' đ'}}</h5></td>
                        </tr>
                        <tr>
                            <td colspan="3"><h5 style="text-align: center;color:white">Discount</h5></td>
                            <td colspan="1"><h5 style="text-align: center; color: red">{{empty($orderData->discount) ? 0 : '- '.number_format($orderData->discount, 0, '', '.') . ' đ'}}</h5></td>
                        </tr>
                        <tr>
                            <td colspan="3"><h5 style="text-align: center;color:white">Total</h5></td>
                            <td colspan="1"><h5 style="text-align: center; color: yellow">{{number_format($orderData->total_amount, 0, '', '.') . ' đ'}}</h5></td>
                        </tr>
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
          url: "{{route('banner.status')}}",
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

      $('a[name=deleteBanner]').click(function() {
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
            swal("Poof! Your imaginary Banner has been deleted!", {
              icon: "success",
            });
          } else {
            swal("Your imaginary Banner is safe!");
          }
        });
      });

    </script>
@endpush
