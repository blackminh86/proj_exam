

@if(isset($display))
<div class="tab-pane {{ ($display == 'grid') ? 'active' : null }} " id="grid-container">
@else
<div class="tab-pane active" id="grid-container">
@endif
  <div class="category-product">
    <div class="row">
      @foreach($products as $product)
      @php
      if($product->type == 'self'){
      $thumb = asset('images/product') .'/' . json_decode($product->images)[0]->image ;
      }else{
      $thumb = json_decode($product->images)[0]->image ;
      }
      $alt = json_decode($product->images)[0]->alt ;
      @endphp
      <div class="col-sm-6 col-md-4 wow fadeInUp">
      <a href="{{route('product.show',['slug'=>Str::slug($product->name) , 'id'=>$product->id])}}">
        <div class="products">
          <div class="product">
            <div class="product-image">
              <div class="image"><img src="{{ $thumb }}" alt="{{$alt}}"></div>
              <!-- /.image -->

              <!-- <div class="tag hot"><span>new</span></div> -->
            </div>
            <!-- /.product-image -->

            <div class="product-info text-left">
              <h3 class="name" style="height:30px">{{ Str::limit(html_entity_decode($product->name),55) }}</h3>
              <!-- <div class="rating rateit-small"></div> -->
      
              <div class="description"></div>
              <div class="product-price"> <span class="price">{{ str_replace(',','.',number_format($product->price)) }} đ</span> <span class="price-before-discount">{{ str_replace(',','.',number_format($product->list_price)) }} đ</span> </div>
              <!-- /.product-price -->

            </div>
            <!-- /.product-info -->
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
          <!-- /.product -->
        </div>
        </a>
        <!-- /.products -->
      </div>
      <!-- /.item -->
      @endforeach
    </div>
    <!-- /.row -->
  </div>
  <!-- /.category-product -->

</div>
<!-- /.tab-pane -->