@if(isset($display))
<div class="tab-pane {{($display == 'list') ? 'active' : null }}" id="list-container">
@else
<div class="tab-pane " id="list-container">
@endif
    <div class="category-product">
        @foreach($products as $product)
        @php
        if($product->type == 'self'){
        $thumb = asset('images/product') .'/' . json_decode($product->images)[0]->image ;
        }else{
        $thumb = json_decode($product->images)[0]->image ;
        }
        $alt = json_decode($product->images)[0]->alt ;
        @endphp
        <div class="category-product-inner wow fadeInUp">
            <div class="products">
                <div class="product-list product">
                    <div class="row product-list-row">
                        <div class="col col-sm-4 col-lg-4">
                            <div class="product-image">
                                <div class="image"> <img src="{{ $thumb }}" alt="{{ $alt }}"> </div>
                            </div>
                            <!-- /.product-image -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-8 col-lg-8">
                            <div class="product-info">
                                <h3 class="name"><a href="{{route('product.show',['slug'=>Str::slug($product->name) , 'id'=>$product->id])}}">{{ Str::limit(html_entity_decode($product->name),100) }}</a></h3>
                                <!-- <div class="rating rateit-small"></div> -->
                                <div class="product-price"> <span class="price">{{ str_replace(',','.',number_format($product->price)) }} đ</span> <span class="price-before-discount">{{ str_replace(',','.',number_format($product->list_price)) }} đ</span> </div>
                                <!-- /.product-price -->
                                <div class="description m-t-10">{{ html_entity_decode($product->short_description) }}</div>
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                 
                                            <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                            <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                        </ul>
                                    </div>
                                    <!-- /.action -->
                                </div>
                                <!-- /.cart -->

                            </div>
                            <!-- /.product-info -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.product-list-row -->
                    <!-- <div class="tag new"><span>new</span></div> -->
                </div>
                <!-- /.product-list -->
            </div>
            <!-- /.products -->
        </div>
        <!-- /.category-product-inner -->
        @endforeach
    </div>
    <!-- /.category-product -->
</div>