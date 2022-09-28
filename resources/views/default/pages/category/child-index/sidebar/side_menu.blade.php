<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
      <ul class="nav">
        @foreach($categories as $key => $category)
          @if(count($category->children) >> 0)
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>{{ $category->name }}</a>
          <ul class="dropdown-menu mega-menu">
            <li class="yamm-content">
              <div class="row">
                <div class="col-sm-12 col-md-3">
                  <ul class="links list-unstyled">
                    @foreach($category->children as $child)
                    <li><a href="{{ route($controllerName.'.show' , ['slug' => Str::slug($child->name) , 'id' => $child->id]) }}">{{ $child->name }}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
              <!-- /.row -->
            </li>
            <!-- /.yamm-content -->
          </ul>
          <!-- /.dropdown-menu -->
        </li>
        @else
        <li class="menu-item"> <a href="{{ route('category' , ['slug' => Str::slug($category->name) , 'productCategory' => $category->id]) }}" ><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>{{ $category->name }}</a>
        @endif
        @endforeach
      </ul>
      <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
  </div>