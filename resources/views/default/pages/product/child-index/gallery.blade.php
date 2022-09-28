@php
if($item -> type == 'scrape'){
    $images = $itemAPI['images'] ;
}else{
    $images = json_decode($item->images) ;
}

@endphp
<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">
        <div id="owl-single-product">
            @foreach($images as $key => $value)
            @php
            if($item -> type == 'scrape'){
                $image = $value['medium_url'] ;
            }else{
                $image = $value->image ;
                $image = asset('images/product/'. $image) ;
            }

            @endphp
            <div class="single-product-gallery-item" id="slide{{ $key }}">
                <a data-lightbox="image-{{ $key }}" data-title="Gallery" href="{{ $image }}">
                    <img class="img-responsive" alt="" src="assets/images/blank.gif" data-echo="{{ $image }}" />
                </a>
            </div><!-- /.single-product-gallery-item -->
            @endforeach
        </div><!-- /.single-product-slider -->
        <div class="single-product-gallery-thumbs gallery-thumbs">
            <div id="owl-single-product-thumbnails">
                @foreach($images as $key => $value)
                @php
                if($item -> type == 'scrape'){
                    $image = $value['thumbnail_url'] ;
                }else{
                    $image = $value->image ;
                    $image = asset('images/product/'. $image) ;
                }

                @endphp
                <div class="item">
                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="{{ $key }}" href="#slide{{ $key }}">
                        <img class="img-responsive" width="85" alt="" src="assets/images/blank.gif" data-echo="{{ $image }}" />
                    </a>
                </div>
                @endforeach
            </div><!-- /#owl-single-product-thumbnails -->
        </div><!-- /.gallery-thumbs -->
    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->