@extends('frontend.layouts.master')
@section('content')

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                {{-- <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">
                                {{count($productSearch) > 0 ? count($productSearch) : 0}}
                            </span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">$200 - $300</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">$300 - $400</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">$400 - $500</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div> --}}
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                {{-- <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                            <span class="input-group-text bg-transparent text-primary">
                                                <i class="fa fa-search"></i>
                                            </span>
                                    </div>
                                </div> --}}
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    @dd($productCat->paginate(1))--}}
                    @if(count($productSearch) > 0)
                        @foreach($productSearch as $prod)
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
{{--                                        <img class="img-fluid w-100" src="{{asset('frontend')}}/img/product-1.jpg" alt="">--}}
                                        <img class="img-fluid w-100" src="{{$prod->image}}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{$prod->title}}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>{{number_format($prod->price,0,',','.').'đ'}}</h6>
                                            <h6 class="text-muted ml-2">
                                                <del>$123.00</del>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{route('product-detail',$prod->slug)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 pb-1">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center mb-3">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        {{$productSearch->links()}}
{{--                                        <li class="page-item active">{{$productCat->links()}}</li>--}}
{{--                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                                        <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                                        <li class="page-item">--}}
{{--                                            <a class="page-link" href="#" aria-label="Next">--}}
{{--                                                <span aria-hidden="true">&raquo;</span>--}}
{{--                                                <span class="sr-only">Next</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
                                    </ul>
                                </nav>
                            </div>
                    @else
                        <div class="card product-item border-0 mb-4">
                            <h6 class="text-truncate mb-3">No Product Found</h6>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection
