@extends('frontend.layouts.master')
@section('content')
{{-- @dd(request()->query()); --}}
    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">
                                {{count($productCat) > 0 ? count($productCat) : 0}}
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
                </div>
                <!-- Price End -->

                <!-- Color Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                            <span class="input-group-text bg-transparent text-primary">
                                                <i class="fa fa-search"></i>
                                            </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <select id="sortBy" class="btn border">
                                    <option value="latest" {{request()->query('sort') == 'latest' ? 'selected' : ''}}>Latest</option>
                                    <option value="titleASC" {{request()->query('sort')== 'titleASC' ? 'selected' : ''}}>A-Z</option>
                                    <option value="titleDESC" {{request()->query('sort')== 'titleDESC' ? 'selected' : ''}}>Z-A</option>
                                    <option value="priceDESC" {{request()->query('sort')== 'priceDESC' ? 'selected' : ''}}>Price - High to Low</option>
                                    <option value="priceASC" {{request()->query('sort')== 'priceASC' ? 'selected' : ''}}>Price - Low to High</option>
                                </select>                          
                                {{-- {{!empty(session('cart')) ? dd(session('cart')) :''}} --}}
                                {{-- <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-3" id="loadData">
{{--                    @dd($productCat->paginate(1))--}}
                    @if(count($productCat) > 0)
                        @foreach($productCat as $prod)
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1" value="{{$prod->id}}" price="{{$prod->price - ($prod->price * $prod->discount/100)}}">
                                <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        @if(!empty($prod->discount) || $prod->discount > 0)
                                        <div class="new-product-percent" style="background: url({{asset('frontend')}}/img/icon-saleoff.png) no-repeat scroll center center transparent; position: absolute;width: 48px;height: 51px;padding-top: 12px;color: #180733;font-size: 17px;text-align: center;">
                                            {{ $prod->discount.'%'}}
                                        </div>
                                        @endif
                                       {{-- <img class="img-fluid w-100" src="{{asset('frontend')}}/img/product-1.jpg" alt=""> --}}
                                        <img class="img-fluid w-100" src="{{$prod->image}}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{$prod->title}}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>{{number_format($prod->price - ($prod->price * $prod->discount/100),0,',','.').'đ'}}</h6>
                                            @if(!empty($prod->discount) || $prod->discount > 0 )
                                            <h6 class="text-muted ml-2">
                                                <del>{{number_format($prod->price,0,',','.').'đ'}}</del>
                                            </h6>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{route('product-detail',$prod->slug)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        @if($prod->stock == 0)
                                            <p style="color:red; font-weight: 600; text-align: center">Out of Stock</p>
                                        @else
                                            <button class="btn btn-sm text-dark p-0 addCart"><i class="fas fa-shopping-cart text-primary mr-1" ></i>Add To Cart</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div id="loadData"> --}}
                        {{-- <div class="col-lg-4 col-md-6 col-sm-12 pb-1" id="loadData">

                        </div> --}}
                        <div class="col-12 pb-1">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-3">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    {{$productCat->appends(request()->query())->links()}}
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

@push('scripts')

<script>
    $('#sortBy').change(function (){
        let option = $(this).val();
        window.location = "{{url($route)}}/{{$category->slug}}?sort="+option;
        // console.log("{{$route}}");
    })
</script>
<script>
    let page = 1;
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
            page++;
                loadMoreData(page);
            }
    });
    function loadMoreData(page){
        if(page <= {{$lastPage}}){
            $.ajax({
                url:  '?page='+page+'&sort='+"{{$sort}}",
                success: function(data) {
                    $("#loadData").append(data.html);
                        // console.log(data);
                }
            })
        }else{
            console.log("no data");
        }
    }
</script>
@endpush