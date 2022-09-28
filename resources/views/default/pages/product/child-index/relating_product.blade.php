@php
$relating_items = $item::select('id','name','images','price','list_price','type')->where('product_category_id' , $item->product_category_id)->take(6)->get();

@endphp
<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">upsell products</h3>
    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
        @foreach($relating_items as $relating_item)
        @php
        $thumb = json_decode($relating_item->images)[0]->image ;
        
        if($relating_item->type == "self"){
        $thumb = asset('images/product').'/'.$thumb ;
        }

        @endphp
        <div class="item item-carousel">
            <div class="products">

                <div class="product">
                    <div class="product-image">
                        <div class="image">
                            <a href="detail.html"><img src="{{ $thumb }}" alt=""></a>
                        </div><!-- /.image -->

                        <div class="tag sale"><span>sale</span></div>
                    </div><!-- /.product-image -->


                    <div class="product-info text-left">
                        <h3 class="name"><a href="{{route($controllerName . '.show' ,['slug'=>Str::slug($relating_item->name) , 'id'=>$relating_item->id])}}">{{ Str::limit(html_entity_decode($relating_item->name),37) }}</a></h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>

                        <div class="product-price">
                            <span class="price">{{ str_replace(',','.',number_format($relating_item->price)) }} </span>
                            <span class="price-before-discount">{{ str_replace(',','.',number_format($relating_item->list_price)) }}</span>

                        </div><!-- /.product-price -->

                    </div><!-- /.product-info -->
                    <div class="cart clearfix animate-effect">
                        <div class="action">
                            <ul class="list-unstyled">
                                <li class="add-cart-button btn-group">
                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                        cart</button>

                                </li>

                                <li class="lnk wishlist">
                                    <a class="add-to-cart" href="detail.html" title="Wishlist">
                                        <i class="icon fa fa-heart"></i>
                                    </a>
                                </li>

                                <li class="lnk">
                                    <a class="add-to-cart" href="detail.html" title="Compare">
                                        <i class="fa fa-signal"></i>
                                    </a>
                                </li>
                            </ul>
                        </div><!-- /.action -->
                    </div><!-- /.cart -->
                </div><!-- /.product -->

            </div><!-- /.products -->
        </div><!-- /.item -->
        @endforeach
    </div><!-- /.home-owl-carousel -->
</section><!-- /.section -->