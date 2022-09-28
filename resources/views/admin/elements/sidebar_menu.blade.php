<!-- menu profile quick info -->
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{{ asset('admin/img/img.jpg') }}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>luutruonghailan</h2>
    </div>
</div>
<!-- /menu profile quick info -->
<br/>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Menu</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('user') }}"><i class="fa fa-user"></i> User</a></li>
            <li><a href="{{ route('articleCategory') }}"><i class="fa fa fa-building-o"></i> Article Category</a></li>
            <li><a href="{{ route('article') }}"><i class="fa fa-newspaper-o"></i> Article</a></li>
            <li><a href="{{ route('productCategory') }}"><i class="fa fa fa-building-o"></i>Product Category</a></li>
            <li><a href="{{ route('product') }}"><i class="fa fa-newspaper-o"></i>Product</a></li>
            <li><a href="{{ route('attribute') }}"><i class="fa fa-newspaper-o"></i>Attribute</a></li>
            <li><a href="{{ route('menu') }}"><i class="fa fa-newspaper-o"></i> Menu</a></li>
            <li><a href="{{ route('banner') }}"><i class="fa fa-sliders"></i> Banner</a></li>
            <li><a href="{{ route('message') }}"><i class="fa fa-building-o"></i>Messages</a></li>
            <li><a href="{{ route('order') }}"><i class="fa fa-building-o"></i>Order</a></li>
            <!-- <li><a href="{{ route('rss') }}"><i class="fa fa-newspaper-o"></i> Rss</a></li> -->
            <li><a href="{{ route('file') }}"><i class="fa fa-building-o"></i>File Manager</a></li>
            <li><a href="{{ route('setting') }}"><i class="fa fa-cog"></i>Setting</a></li>
            <li><a href="{{ route('changepass') }}"><i class="fa fa-pencil-square-o"></i>Change Password</a></li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->
