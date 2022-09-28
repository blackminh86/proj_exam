<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="/">Home</a></li>
                @foreach($breadcumb as $key => $item)

                @if($key != 1)
                <li class="{{ ($key == $id) ? 'active' : '' ; }}">
                    <a href="{{ route('productCategory.show' ,['slug' => Str::slug($item) , 'id' =>$key ]) }}">
                        / {{$item}}
                    </a>
                </li>
                @endif
                @endforeach
                @if($controllerName == 'productCategory')
                @php
                $info = Session::get('info');
                $title = (isset($info['title'])) ? $info['title'] : '' ;
                @endphp
                @section('title')
                {{ Str::limit(html_entity_decode($item),25) }} | {{ $title }}
                @endsection
                @endif
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>