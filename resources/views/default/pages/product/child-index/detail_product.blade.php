@php 
$ratting = (isset($itemAPI['rating_average'])) ? $itemAPI['rating_average'] : 0 ;
$review_count = (isset($itemAPI['review_count'])) ? $itemAPI['review_count'] : 0 ;
@endphp
<div class="detail-block">
    <div class="row  wow fadeInUp">
        @include('default.pages.product.child-index.gallery')
        <div class='col-sm-6 col-md-7 product-info-block'>
            <div class="product-info">
                <h1 class="name">{!! html_entity_decode($item->name) !!}</h1>
                @if($item -> type != 'self')
                <div class="rating-reviews m-t-20">
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- <div class="rating rateit-small"></div> -->
                            <div class="rateit-small">
                                <button id="rateit-reset-2" data-role="none" class="rateit-reset" aria-label="reset rating" aria-controls="rateit-range-5" style="display: none;"></button>
                                <div id="rateit-range-2" class="rateit-range" tabindex="0" role="slider" aria-label="rating" aria-owns="rateit-reset-5" aria-valuemin="0" aria-valuemax="5" aria-valuenow="4" aria-readonly="true" style="width: 70px; height: 14px;">
                                    <div class="rateit-selected" style="height: 14px; width: {{ 14 * $ratting.'px' }};"></div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-8">
                            <div class="reviews">
                                <a href="#" class="lnk">({{ $review_count }} Reviews)</a>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.rating-reviews -->
                @endif
                <div class="stock-container info-container m-t-10">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="stock-box">
                                <span class="label">Availability :</span>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="stock-box">
                                <span class="value" id="stock">{{ ($item->status == 'active') ? 'Còn hàng' : 'Hết hàng' }}</span>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.stock-container -->

                <div class="description-container m-t-20">
                    {!! html_entity_decode($item->short_description) !!}
                </div><!-- /.description-container -->
                @include ('default.pages.product.child-index.variable_option')
                <div class="price-container info-container m-t-20">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="price-box">
                                <span class="price" id="price">{{ str_replace(',','.',number_format($item->price)) }} đ</span>
                                @if($item->list_price >> $item->price)
                                <span class="price-strike">{{ str_replace(',','.',number_format($item->list_price)) }} đ</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="favorite-button m-t-10">
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                    <i class="fa fa-heart"></i>
                                </a>
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                    <i class="fa fa-signal"></i>
                                </a>
                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </div>
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.price-container -->

                <div class="quantity-container info-container" style="display:none"> 
                    <div class="row">

                        <div class="col-sm-2">
                            <span class="label">Qty :</span>
                        </div>

                        <div class="col-sm-2">
                            <div class="cart-quantity">
                                <div class="quant-input">
                                    <div class="arrows">
                                        <div class="arrow plus gradient" data-id="{{ $item->id }}"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                        <div class="arrow minus gradient" data-id="{{ $item->id }}"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                    </div>
                                    <input type="text" value="1" id="quant-{{ $item->id }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <a href="javascript:clickCart( {{ $item -> id}} )" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="{{ route('cart.show') }}" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> GO TO CART</a>
                        </div>
                        
                    </div><!-- /.row -->
                </div><!-- /.quantity-container -->
            </div><!-- /.product-info -->
        </div><!-- /.col-sm-7 -->
    </div><!-- /.row -->
</div>