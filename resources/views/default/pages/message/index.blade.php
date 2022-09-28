@php
$info = Session::get('info');
@endphp
@extends('default.main')
@section('content')
<div class="contact-page">
    <div class="row">

        <div class="col-md-12 contact-map outer-bottom-vs">
            <iframe src="{{ $info['url_map'] }}" width="600" height="450" style="border:0"></iframe>
        </div>
        @include('default.pages.message.form')
        <div class="col-md-3 contact-info">
            <div class="contact-title">
                <h4>Information</h4>
            </div>
            <div class="clearfix address">
                <span class="contact-i"><i class="fa fa-map-marker"></i></span>
                <span class="contact-span">{{ $info['address'] }}</span>
            </div>
            <div class="clearfix phone-no">
                <span class="contact-i"><i class="fa fa-mobile"></i></span>
                <span class="contact-span">
                    @foreach($info['hotline'] as $phone)
                    {{ $phone->value }}</br>
                    @endforeach
                </span>
            </div>
            <div class="clearfix email">
                <span class="contact-i"><i class="fa fa-envelope"></i></span>
                <span class="contact-span">
                    @foreach($info['email'] as $address)
                    <a href="#">{{ $address->value }}</a></br>
                    @endforeach
                </span>
            </div>
        </div>
    </div><!-- /.contact-page -->
</div><!-- /.row -->
@endsection