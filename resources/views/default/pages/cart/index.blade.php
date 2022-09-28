@php
$cart = Session::get('cart') ;
@endphp
@extends('default.main')
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>/ Shopping Cart</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <input type="hidden" name="update_cart_url" value="{{ route($controllerName . '.update-cart') }}">
                    <div class="table-responsive">
                    @include('.default.elements.error')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="cart-romove item">Remove</th>
                                    <th class="cart-description item">Image</th>
                                    <th class="cart-product-name item">Product Name</th>
                                    <th class="cart-qty item">Quantity</th>
                                    <th class="cart-sub-total item">Subtotal</th>
                                    <th class="cart-total last-item">Grandtotal</th>
                                </tr>
                            </thead><!-- /thead -->
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="shopping-cart-btn">
                                            <span class="">
                                                <a href="{{ route('home') }}" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
                                                <!-- <a href="javascript:updateShopingCart()" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a> -->
                                            </span>
                                        </div><!-- /.shopping-cart-btn -->
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if($cart != null)
                                @include('default.pages.cart.child-index.list' , ['subTotal'=>0 , 'cart'=>$cart])
                                @endif
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div>
                </div>
                <form id="info-form" name="info-form" method="get" action="{{ route($controllerName . '.form-info') }} " accept-charset="UTF-8" enctype="multipart/form-data">
                    <div class="col-md-8 col-sm-12">
                        @include('default.pages.cart.child-index.form_info')
                    </div>
                    <div class="col-md-4 col-sm-12 cart-shopping-total">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="cart-grand-total">
                                            Grand Total<span class="inner-left-md" id="sub-total" data-sub="0">$600.00</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            {{--<input type="hidden" name="checkout-url" value="{{ route('order.checkout') }}">--}}
                                            {{--<button type="submit" class="btn btn-primary checkout-btn" onclick="clickCheckOut()">PROCCED TO CHEKOUT</button>--}}
                                            <a href="#info-form"><button type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</button></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div><!-- /.cart-shopping-total -->
                </form>

            </div><!-- /.shopping-cart -->
        </div>
    </div>
</div>
@endsection