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
                <li class='active'>/ Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
        @if(!empty($cart))
        @include('default.pages.order.child-index.info')
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
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
                                                <a href="{{ route('home') }}" class="btn btn-upper btn-primary outer-left-xs">Back to home</a>
                                                <a href="{{ route('cart.show') }}" class="btn btn-upper btn-primary pull-right outer-right-xs">Back to cart</a>
                                            </span>
                                        </div><!-- /.shopping-cart-btn -->
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if($cart != null)
                                @include('default.pages.order.child-index.list' , ['subTotal'=>0 , 'cart'=>$cart])
                                @endif
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div>
                </div><!-- /.shopping-cart-table -->
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
                                        <a href="{{ route($controllerName . '.store') }}"><button type="submit" class="btn btn-primary checkout-btn">ORDER NOW</button></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->
            </div><!-- /.shopping-cart -->
        </div>
        @else
        @include('default.pages.order.child-index.finish')
        @endif
    </div>
</div>
@endsection