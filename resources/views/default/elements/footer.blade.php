@php
$info = Session::get('info') ;
@endphp
<footer id="footer" class="footer color-bg">
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Contact Us</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class="toggle-footer" style="">
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p>{{ $info['address'] }}</p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  @foreach( $info['hotline'] as $phone )
                  <p>+{{$phone->value}}<br>
                    @endforeach
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  @foreach( $info['email'] as $email )
                  <p><a href="mailto:{{ $email->value }}">{{ $email->value }}</a></p>
                  @endforeach
                </div>
              </li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->

        <div class="col-xs-12 col-sm-6 col-md-3">
          <div class="module-heading">
            <h4 class="module-title">Customer Service</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              <!-- <li class="first"><a href="#" title="Contact us">My Account</a></li> -->
              <!-- <li><a href="#" title="About us">Order History</a></li> -->
              <!-- <li><a href="#" title="faq">FAQ</a></li> -->
              <!-- <li><a href="#" title="Popular Searches">Specials</a></li> -->
              <!-- <li class="last"><a href="#" title="Where is my order?">Help Center</a></li> -->
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
        <!-- /.col -->


        <div class="col-xs-12 col-sm-12 col-md-6">
          <div class="module-heading">
            <h4 class="module-title">About Us</h4>
          </div>
          <!-- /.module-heading -->

          <div class="module-body">
            <ul class='list-unstyled'>
              <li style="color: #666666"> {!! $info['content'] !!} </li>
            </ul>
          </div>
          <!-- /.module-body -->
        </div>
      </div>
    </div>
  </div>
  <div class="copyright-bar">
    <div class="container">
      <div class="col-xs-12 col-sm-6 no-padding social">
        <ul class="link">
          <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a></li>
          <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a></li>
          <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#" title="GooglePlus"></a></li>
          <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
          <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#" title="PInterest"></a></li>
          <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#" title="Linkedin"></a></li>
          <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#" title="Youtube"></a></li>
        </ul>
      </div>

    </div>
  </div>
</footer>