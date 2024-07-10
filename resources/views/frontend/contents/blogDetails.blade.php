@extends('frontend.master')
@section('title',$blog->name ?? 'Blog Details')
@section('content')
<!-- event -->
<section class="featured-service">
       <div class="container">
       <div class="row">
       		<div class="col-lg-9 col-xl-9 col-md-8 col-sm-12 special">
       			<div class="section-head text-left">
        <h2>{{$blog->name}}</h2>
      </div>
       			<div class="service-detail-image">
       				<img src="{{ isset($blog->image) ? config("app.url").Storage::url($blog->image) : asset('adminAssets/img/default-image.png') }}" alt="">
       			</div>
       			<div class="service-detail-content">

       				<p><span>{{ \Carbon\Carbon::parse($blog->created_at)->format('M, jS') }}</span>{!!$blog->description!!}</p>
       			</div>
       		</div>
       		<div class="col-lg-3 col-xl-3 col-md-4 col-sm-12 special2">
       			 <div class="section-head text-left">
        <h3>Trending Blogs</h3>
      </div>
         <div class="row justify-content-center">
                       @foreach($featured_blogs as $blog)

             <div class="col-md-12">
             <a href="{{route('blog-details',$blog->slug)}}">
              <div class="service-box inner-blog">
              <div class="service-box-img">
               <img src="{{ isset($blog->image) ? config("app.url").Storage::url($blog->image) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
              <div class="service-box-content text-left">
                <h3>{{$blog->name}}</h3>
                <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('M, jS') }}</p>
              </div>
             </div>
             </a>
           
           </div>
             @endforeach
             
             
         </div>
         <div class="section-head text-left">
        <h3>Latest Blogs</h3>
      </div>
         <div class="row justify-content-center">
              @foreach($latest_blogs as $blog)
             <div class="col-md-12">
             <a href="{{route('blog-details',$blog->slug)}}">
              <div class="service-box inner-blog">
              <div class="service-box-img">
                <img src="{{ isset($blog->image) ? config("app.url").Storage::url($blog->image) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
              <div class="service-box-content text-left">
                <h3>{{$blog->name}}</h3>
                <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('M, jS') }}</p>
              </div>
             </div>
             </a>
             
           </div>
           @endforeach
             
             
         </div>
         <div class="section-head text-left">
        <h3>Most Popular Blog</h3>
      </div>
         <div class="row justify-content-center">
            @foreach($popular_blogs as $blog)
             <div class="col-md-12">
             <a href="{{route('blog-details',$blog->slug)}}">
              <div class="service-box inner-blog">
              <div class="service-box-img">
              <img src="{{ isset($blog->image) ? config("app.url").Storage::url($blog->image) : asset('adminAssets/img/default-image.png') }}" alt="">
              </div>
              <div class="service-box-content text-left">
                 <h3>{{$blog->name}}</h3>
                <p>{{ \Carbon\Carbon::parse($blog->created_at)->format('M, jS') }}</p>
              </div>
             </div>
             </a>
             
           </div>
           @endforeach
             
             
         </div>
         <div class="section-head text-left">
        <h3>Categories</h3>
      </div>
         <ul class="blog-cate">
           @foreach($b_categories as $category)
         	<li><a href="{{route('blogcat-details',$category->slug)}}">{{$category->name}}</a></li>
           @endforeach
         	
         </ul>
       		</div>
       </div>
       </div>
     </section>
<!-- eb=vent-end -->
@endsection