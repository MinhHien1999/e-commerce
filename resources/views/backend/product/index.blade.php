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
                                        <a href="{{route('product.create')}}">
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
                                        <th style="text-align: center;">title</th>
                                        <th style="text-align: center;">price</th>
                                        <th style="text-align: center;">brand</th>
{{--                                        <th>cat_id</th>--}}
{{--                                        <th>child_cat_id</th>--}}
                                        <th style="text-align: center;">discount</th>
{{--                                        <th>description</th>--}}
                                        <th style="text-align: center;">image</th>
                                        <th style="text-align: center;">status</th>
                                        <th style="text-align: center;">action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($dataProduct as $product)
                                        @php
                                            $productDetail = \App\Models\Product::where('id',$product->id)->first();
                                            $BrandDetail = \App\Models\Brand::where('id',$product->brand_id)->first();
                                            $CategoryDetail = \App\Models\Category::where(['id' => $product->cat_id, 'is_parent' => 1])->first();
                                            $CategoryChildDetail = \App\Models\Category::where(['parent_id' => $product->cat_id, 'is_parent' => 0])->first();
                                        @endphp
                                        <tr id="item-{{$product->id}}">
                                            <td style="text-align: center;">
                                                <p style="color:white;">
                                                    {{$product->id}}
                                                </p>
                                            </td>
                                            <td style="text-align: center;">
                                                <p style="color:white;">
                                                    {{$product->title}}
                                                </p>
                                            </td>
                                            <td style="text-align: center;">
                                                <p style="color:white;">
                                                    {{number_format($product->price,0,'.',' ').'đ'}}
                                                </p>
                                            </td>
                                            <td style="text-align: center;">
                                                <p style="color:white;">
                                                    {{$BrandDetail->title}}
                                                </p>
                                            </td>
{{--                                            <td>--}}
{{--                                                <p style="color:white">--}}
{{--                                                    {{$product->cat_id}}--}}
{{--                                                </p>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <p style="color:white">--}}
{{--                                                    {{$product->child_cat_id}}--}}
{{--                                                </p>--}}
{{--                                            </td>--}}
                                            <td style="text-align: center;">
                                                <p style="color:white;">
                                                    {{$product->discount.'%'}}
                                                </p>
                                            </td>
{{--                                            <td>--}}
{{--                                                <p style="color:white">--}}
{{--                                                    {!! $product->description !!}--}}
{{--                                                </p>--}}
{{--                                            </td>--}}
                                            <td style="text-align: center;"><img src="{{URL($product->image)}}" alt=""></td>
{{--                                            <td><img src="{{URL('upload/'.request()->segment(2).'/'.$product->image)}}" alt="" width="15%" height="20%"></td>--}}
                                            <td style="text-align: center;">
                                                @if($product->status == 'active')
                                                    <input type="checkbox" checked name="status" data-toggle="toggle" data-on="Active" data-off="inactive" data-onstyle="success" data-offstyle="danger" value="{{$product->id}}">
                                                @else
                                                    <input type="checkbox" name="status" data-toggle="toggle" data-on="Active" data-off="inactive" data-onstyle="success" data-offstyle="danger" value="{{$product->id}}">
                                                @endif
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="{{route('product.edit',$product->id)}}">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                </a>
                                                <a href="javascript:void(0)" name="deleteProduct" value="{{$product->id}}">
                                                    <i class="fas fa-trash-alt">
                                                    </i>
                                                </a>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-default-{{$product->id}}" id="prodID-{{$product->id}}" value="{{$product->id}}">
                                                    <i class="fas fa-eye">
                                                    </i>
                                                </a>
                                                <form method="post" action="{{route('product.destroy',$product->id)}}" enctype="multipart/form-data" name="deleteProduct" id="delete-{{$product->id}}">
                                                    @method('delete')
                                                    @csrf
                                                    {{-- <button type="submit" class="fas fa-trash-alt">
                                                    </button> --}}
                                                </form>
                                                <div class="modal fade" id="modal-default-{{$product->id}}">
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
                                                                        <p style="color: white">{{$productDetail->id}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong style="color: white">Title:</strong>
                                                                        <p style="color: white">{{$product->title}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <strong style="color: white">Price:</strong>
                                                                        <p style="color: white">{{number_format($product->price,0,',','.').'đ'}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong style="color: white">Stock:</strong>
                                                                        <p style="color: {{$product->stock == 0 ? 'red': 'white'}}; font-weight:700">{{$product->stock == 0 ? 'Out of Stock': $product->stock}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <strong style="color: white">Brand:</strong>
                                                                        <p style="color: white">{{$BrandDetail->title}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong style="color: white">Category:</strong>
                                                                        <p style="color: white">{{$CategoryDetail['title']}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <strong style="color: white">Category Child:</strong>
                                                                        <p style="color: white">{{$CategoryChildDetail['title']}}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <strong style="color: white">Discount:</strong>
                                                                        <p style="color: white">{{$product->discount.'%'}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <strong style="color: white">Status:</strong>
                                                                        <p style="{{$product->status == 'active' ? 'color: #00bc8c': 'color: #e74c3c'}};font-weight:700">{{$product->status}}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <strong style="color: white">Discription:</strong>
                                                                        <p style="color: white">{!! $product->description !!}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <strong style="color: white">Image:</strong>
                                                                        <img src="{{URL($product->image)}}" alt="" width="400px" height="200px">
{{--                                                                        <img src="{{URL('upload/'.request()->segment(2).'/'.$product->image)}}" alt="" width="400px" height="200px">--}}
                                                                    </div>
                                                                </div>
                                                            </div>
{{--                                                            <div class="modal-footer justify-content-between">--}}
{{--                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
{{--                                                                <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                                                            </div>--}}
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
                url: "{{route('product.status')}}",
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    check: check,
                    id: id
                },
                success: function(response) {
                    if(response.message){
                        swal(response.message);
                    }
                }
            })
        })

        $('a[name=deleteProduct]').click(function() {
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
