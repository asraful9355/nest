@php
  $seo = App\Models\Seo::find(1);
@endphp
<meta charset="utf-8" />
<title>Easy Shop Online Store</title>
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<meta name="title" content="{{ $seo->meta_title }}" />
<meta name="author" content="{{ $seo->meta_author }}" />
<meta name="keywords" content="{{ $seo->meta_keyword }}" />
<meta name="description" content="{{ $seo->meta_description }}" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:type" content="" />
<meta property="og:url" content="" />
<meta property="og:image" content="" />
<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg')}}" />
<!-- Template CSS -->
<link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css')}}" />
<link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3')}}" />
{{-- font awesome cdn link --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>