@php
use Illuminate\Support\Str;
use App\Models\ProductCategory as Category;
$categories = Category::descendantsOf(1)->toTree();
@endphp
<div class='col-md-3 sidebar'>
  @include('default.pages.category.child-index.sidebar.side_menu' )
  <div class="sidebar-module-container">
    <div class="sidebar-filter">
      @include('default.pages.category.child-index.sidebar.shop_by_sidebar' )
      @include('default.pages.category.child-index.sidebar.price_slider' )
      {{-- @include('default.pages.category.child-index.sidebar.brand_sidebar' ) --}}
      @include('default.pages.category.child-index.sidebar.attribute_sidebar' )
      <!-- ============================================== COMPARE============================================== -->
      <div class="sidebar-widget wow fadeInUp outer-top-vs">
        <h3 class="section-title">Compare products</h3>
        <div class="sidebar-widget-body">
          <div class="compare-report">
            <p>You have no <span>item(s)</span> to compare</p>
          </div>
          <!-- /.compare-report -->
        </div>
        <!-- /.sidebar-widget-body -->
      </div>
      <!-- /.sidebar-widget -->
      <!-- ============================================== COMPARE: END ============================================== -->
      <!-- ============================================== PRODUCT TAGS ============================================== -->
      <div class="sidebar-widget product-tag wow fadeInUp outer-top-vs">
        <h3 class="section-title">Product tags</h3>
        <div class="sidebar-widget-body outer-top-xs">
          <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a> <a class="item active" title="Vest" href="category.html">Vest</a> <a class="item" title="Smartphone" href="category.html">Smartphone</a> <a class="item" title="Furniture" href="category.html">Furniture</a> <a class="item" title="T-shirt" href="category.html">T-shirt</a> <a class="item" title="Sweatpants" href="category.html">Sweatpants</a> <a class="item" title="Sneaker" href="category.html">Sneaker</a> <a class="item" title="Toys" href="category.html">Toys</a> <a class="item" title="Rose" href="category.html">Rose</a> </div>
          <!-- /.tag-list -->
        </div>
        <!-- /.sidebar-widget-body -->
      </div>
      <!-- /.sidebar-widget -->
      <!----------- Testimonials------------->
      <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
        <div id="advertisement" class="advertisement">
          <div class="item">
            <div class="avatar"><img src="assets/images/testimonials/member1.png" alt="Image"></div>
            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
            <div class="clients_author">John Doe <span>Abc Company</span> </div>
            <!-- /.container-fluid -->
          </div>
          <!-- /.item -->

          <div class="item">
            <div class="avatar"><img src="assets/images/testimonials/member3.png" alt="Image"></div>
            <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
            <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
          </div>
          <!-- /.item -->

          <div class="item">
            <div class="avatar"><img src="assets/images/testimonials/member2.png" alt="Image"></div>
            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
            <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
            <!-- /.container-fluid -->
          </div>
          <!-- /.item -->

        </div>
        <!-- /.owl-carousel -->
      </div>

      <!-- ============================================== Testimonials: END ============================================== -->

      <div class="home-banner"> <img src="assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
    </div>
    <!-- /.sidebar-filter -->
  </div>
  <!-- /.sidebar-module-container -->
</div>