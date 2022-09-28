@php
use Illuminate\Support\Str;
@endphp
<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
    <div class="more-info-tab clearfix ">
        <h3 class="new-product-title pull-left">New Products</h3>
        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
        </ul>
        <!-- /.nav-tabs -->
    </div>
    <div class="tab-content outer-top-xs">
        <div class="tab-pane in active" id="all">
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    @if(!empty($new_product))
                    @foreach($new_product as $item)
                    @php
                    $image=json_decode($item->images)[0]->image ;
                    $thumb = ($item -> type == 'scrape') ? $image : asset('images/product/' . $image);
                    $name = html_entity_decode($item->name) ;
                    $slug = Str::slug($name ) ;
                    $url = route('product.show' , ['slug'=> $slug , 'id' => $item->id]) ;
                    $price = number_format($item->price) ;
                    $list_price = ($item->list_price > $item->price ) ? number_format($item->list_price) : '' ;
                    @endphp
                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image"> <a href="{{ $url }}"><img src="{{ $thumb }}" alt="{{ $slug }}"></a> </div>
                                    <!-- /.image -->

                                    <div class="tag new"><span>new</span></div>
                                </div>
                                <!-- /.product-image -->

                                <div class="product-info text-left">
                                    <h3 class="name"><a href="{{ $url }}">{{ Str::limit($name , 30) }}</a></h3>
                                    <div class="rating rateit-small"></div>
                                    <div class="description"></div>
                                    <div class="product-price"> <span class="price"> {{ $price }} đ</span> 
                                    @if(!empty($list_price))
                                    <span class="price-before-discount"> {{ $list_price }} đ </span> 
                                    @endif
                                </div>
                                    <!-- /.product-price -->

                                </div>
                                <!-- /.product-info -->
                            </div>
                            <!-- /.product -->

                        </div>
                        <!-- /.products -->
                    </div>
                    <!-- /.item -->
                    @endforeach
                    @endif
                </div>
                <!-- /.home-owl-carousel -->
            </div>
            <!-- /.product-slider -->
        </div>
    </div>
    <!-- /.tab-content -->
</div>