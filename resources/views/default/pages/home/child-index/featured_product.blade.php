@php
use Illuminate\Support\Str;
@endphp
<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">Featured products</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        @if(!empty($feature))
        @foreach($feature as $item)
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

                        <div class="tag hot"><span>hot</span></div>
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
                    </div>
                </div>
                <!-- /.product -->

            </div>
            <!-- /.products -->
        </div>
        @endforeach
        @endif
    </div>
    <!-- /.home-owl-carousel -->
</section>