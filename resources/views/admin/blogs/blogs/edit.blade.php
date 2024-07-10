@extends('admin.layout.adminMasterLayout')

@section('title', "Edit Blog")

@section('content')



<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Blog-{{ $blog->name }}</h5>
      </div>
      <div class="card-body">
         <form class="forms-sample"
               action="{{route('blog.update', $blog)}}"
               method="POST"
               autocomplete="off"
               enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            @include('admin.blogs.blogs.form')

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
