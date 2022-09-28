@foreach($value_attributes as $key => $values)
<div class="sidebar-widget wow fadeInUp">  
    <div class="widget-header">
        <h4 class="widget-title">{{ $key }}</h4>
    </div>
    <div class="sidebar-widget-body">
        <ul class="list"> 
            @foreach($values as $value)
            <li><a href="#">{{ $value }}</a></li>
            @endforeach
        </ul>
    </div>
    <!-- /.sidebar-widget-body -->
</div>
@endforeach