@extends('frontend.master')
@section('title', "Blogs")
@section('content')
<section class="inner-banner">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="inner-header-menu">
                <ul>
                    <li><a href="https://baredezire.com">Home</a></li>
                    <li><a href="https://baredezire.com/blogs">Blogs</a></li>
                   
                </ul>
            </div>
            
        </div>
        <div class="breadcrumb-2">
            <img src="{{  isset($category->image) ? config("app.url").Storage::url($category->image) : asset('assets/images/Bare-Desire-Banner-Design.png') }}" alt="">
        </div>
    </div>
</section>
<section class="featured-service">
       <div class="container">
        <div class="section-head text-left">
        <h2>Trending Blogs</h2>
      </div>
        
         <div class="row justify-content-center">
            @foreach($featured_blogs as $blog)
             <div class="col-md-6 col-sm-12 col-lg-3 col-xl-3">
             <a href="{{route('blog-details',$blog->slug)}}">
              <div class="service-box">
              <div class="service-box-img">
                <img src="{{ isset($blog->image) ? config("app.url").Storage::url($blog->image) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
              <div class="service-box-content text-left">
                <h3>{{$blog->name}}</h3>
                <p>{!!$blog->short_description!!}</p>
              </div>
              <div class="date-time">
               <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('M, jS') }}</p>
             </div>
             </div>
             </a>
             
           </div>
           @endforeach

         </div>

         <div class="section-head text-left">
        <h2>Latest Blogs</h2>
      </div>
         <div class="row justify-content-center">
           @foreach($latest_blogs as $blog)
              <div class="col-md-6 col-sm-12 col-lg-3 col-xl-3">
             <a href="{{route('blog-details',$blog->slug)}}">
              <div class="service-box">
              <div class="service-box-img">
                <img src="{{ isset($blog->image) ? config("app.url").Storage::url($blog->image) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
              <div class="service-box-content text-left">
                <h3>{{$blog->name}}</h3>
                <p>{!!$blog->short_description!!}</p>
              </div>
              <div class="date-time">
               <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('M, jS') }}</p>
             </div>
             </div>
             </a>
             
           </div>
           @endforeach
            
         </div>
         <div class="section-head text-left">
        <h2>Most Popular Blogs</h2>
      </div>
         <div class="row justify-content-center">
           @foreach($popular_blogs as $blog)
            <div class="col-md-6 col-sm-12 col-lg-3 col-xl-3">
             <a href="{{route('blog-details',$blog->slug)}}">
              <div class="service-box">
              <div class="service-box-img">
                <img src="{{ isset($blog->image) ? config("app.url").Storage::url($blog->image) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
              <div class="service-box-content text-left">
                <h3>{{$blog->name}}</h3>
                <p>{!!$blog->short_description!!}</p>
              </div>
              <div class="date-time">
               <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('M, jS') }}</p>
             </div>
             </div>
             </a>
             
           </div>
           @endforeach
            
         </div>
       </div>
     </section>



@endsection