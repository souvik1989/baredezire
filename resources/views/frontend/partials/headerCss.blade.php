<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="yUi8FF6ga5OsaoG70Bi5ZFc9yapvKGszri1jLJqTAjE">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/fav.png') }}">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap-grid.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/settings.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/camera.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/prettyPhoto.css')}}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Imprima&family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Istok+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('assets/css_new/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css_new/responsive.css')}}">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-959LTK94XY"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-959LTK94XY');
</script>

  <title>{{env('APP_NAME')}} - @yield('title')</title>
   <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}" />
  
  <script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1309420909940306');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1309420909940306&ev=PageView&noscript=1"
/></noscript>
  
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NLFF5KJJ');</script>
<!-- End Google Tag Manager -->
  
    <script>
fbq('track', 'ViewContent', {
  content_ids: ['123'], // 'REQUIRED': array of product IDs
  content_type: 'product', // RECOMMENDED: Either product or product_group based on the content_ids or contents being passed.
});
</script>
  
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11481155109"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-11481155109');
</script>

  <!-- Event snippet for Purchase LP conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-11481155109/rKfnCPuQ4JMZEKWM0uIq',
      'value': 1.0,
      'currency': 'INR',
      'transaction_id': ''
  });
</script>

    
</head>
<body>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NLFF5KJJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
  

 <script type="application/ld+json">

  {
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Bare Dezire",
  "url": "https://www.baredezire.com/",
  "logo": "https://www.baredezire.com/public/storage/siteSetting/8PC4u7wq8cOjcUP4FHPZeLmuW8yB1d6hXfAi3iHD.png",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "",
    "contactType": "customer service",
    "areaServed": "IN",
    "availableLanguage": "en"
  },
  "sameAs": [
    "https://www.facebook.com/baredezireindia",
    "https://www.instagram.com/baredezireindia/",
    "https://in.pinterest.com/baredezire/",
    "https://www.tumblr.com/bare-dezire"
  ]
}
  </script>
