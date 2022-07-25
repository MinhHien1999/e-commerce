@extends('frontend.layouts.master')
@section('content')

<!-- Cart Start -->
{{-- @dd(Cart::content()) --}}
<div class="container-fluid pt-5" id="cartdata">
    @if(count(Cart::content()) > 0)
        <form method="post" action="{{route('update-cart')}}" class="row px-xl-5 cartdata">
            @csrf
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach(Cart::content() as $item)
                            <tr item="{{$item->rowId}}">
                                <td class="align-middle">
                                    <img src="{{$item->options->image}}" alt="" style="width: 50px;"> {{$item->name}}
                                    <input type="hidden" name="itemId" value="{{$item->rowId}}">
                                </td>
                                <td class="align-middle">{{number_format($item->price,0,',','.').' đ'}}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center" name="qty[{{$item->rowId}}]" value="{{$item->qty}}" min="1">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">{{number_format($item->price * $item->qty,0,',','.').' đ'}}</td>
                                <td class="align-middle"><a class="btn btn-sm btn-primary deleteCart" data="{{$item->rowId}}"><i class="fa fa-times"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                {{-- <form class="mb-5" action=""> --}}
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                {{-- </form> --}}
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium" id="cartSubTotal">{{Cart::count() > 0 ? Cart::subtotal(0,'.',',').' đ' : 0}}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold" id="cartTotal">{{Cart::subtotal(0,'.',',').' đ'}}</h5>
                        </div>
                        <button type="update" class="btn btn-block btn-primary my-3 py-3" name="update" value="update">Update</button>
                        <button type="submit" class="btn btn-block btn-primary my-3 py-3" name="submit" value="submit">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <h1 style="text-align: center;">Your Cart is Empty</h1>
    @endif
</div>
<!-- Cart End -->

@endsection

@push('scripts')
<script>
    $(".deleteCart").click(function (){
        let item = $(this).parent().parent();
        let data = item.attr('item');
        let ajaxDelete = $.ajax({
            url: "{{route('delete-cart')}}",
            type: "DELETE",
            data: {
                id:item.attr('item')
            },
            dataType: "json",
        })
        ajaxDelete.done(function(response){
            item.remove();
            $("span#badge").text(response.data.count)
            $("h6#cartSubTotal").text(response.data.subtotal);
            $("h5#cartTotal").text(response.data.subtotal);
            if(response.data.count === 0){
                $("form.cartdata").remove();
                $("div#cartdata").append("<h1 style='text-align: center;'>Your Cart is Empty</h1>");
            }
            // console.log(response.count);
        })
    })
    $("button[name=update]").click(function (){
        console.log($(this).parent().parent());
    })
</script>
@endpush