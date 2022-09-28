<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="img/favicon.ico" type="image/ico" />
<title>@yield('title')</title>
<!-- Bootstrap -->
<link href="{{ asset('admin/asset/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ asset('admin/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- NProgress -->
<link href="{{ asset('admin/asset/nprogress/nprogress.css') }}" rel="stylesheet">
<!-- iCheck -->
<link href="{{ asset('admin/asset/iCheck/skins/flat/green.css') }}" rel="stylesheet">
<!-- bootstrap-progressbar -->
<link href="{{ asset('admin/asset/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{ asset('admin/css/custom.min.css') }}" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{ asset('admin/css/mycss.css') }}" rel="stylesheet">
<!-- Laravel File Manger -->
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
<!-- Nestable2 -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.5.0/jquery.nestable.min.css">
<link href="{{ asset('admin/css/nestedset.css') }}" rel="stylesheet">
<!-- Ck editor -->
<script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
<!-- Tagify --->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
<!--- Select2 --->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
  .tagify+input {
    display: block !important;
    position: static !important;
    transform: none !important;
    width: 90%;
    margin-top: 1em;
    padding: .5em;
  }
</style>