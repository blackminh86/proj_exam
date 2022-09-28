@php
use Illuminate\Support\Str;
$best_seller = collect($best_seller)->chunk(2) ;
@endphp
<div class="best-deal wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Best seller</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
            @if(!empty($best_seller))
            @foreach($best_seller as $items)
            <div class="item">
                <div class="products best-product">
                    @foreach($items as $item)
                    @php
                    $image=json_decode($item->images)[0]->image ;
                    $thumb = ($item -> type == 'scrape') ? $image : asset('images/product/' . $image);
                    $name = html_entity_decode($item->name) ;
                    $slug = Str::slug($name ) ;
                    $url = route('product.show' , ['slug'=> $slug , 'id' => $item->id]) ;
                    $price = number_format($item->price) ;

                    @endphp
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ $url }}"> <img src="{{ $thumb }}" alt="{{ $slug }}"> </a> </div>
                                        <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col2 col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name"><a href="{{ $url }}">{{ Str::limit($name , 30) }}</a></h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="product-price"> <span class="price"> {{ $price }} </span> 
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.product-micro-row -->
                        </div>
                        <!-- /.product-micro -->

                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    <!-- /.sidebar-widget-body -->
</div>