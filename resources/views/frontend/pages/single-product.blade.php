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
                    <button class="btn btn-sm text-dark p-0 addCart" onclick="addCard()"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                @endif
            </div>
        </div>
    </div>
@endforeach

