@extends('admin.layout.adminMasterLayout')

@section('title', "Edit Product Size")

@section('content')



<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Product Size</h5>
      </div>
      <div class="card-body">
         <form class="forms-sample" 
               action="{{route('product-size.update', $size)}}"
               method="POST" 
               autocomplete="off" 
               enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            @include('admin.product-size.form')

        </form>
      </div>
    </div>
  </div>
</div>


@endsection