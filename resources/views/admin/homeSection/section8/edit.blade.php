@extends('admin.layout.adminMasterLayout')

@section('title', "Edit Home Section8")

@section('content')



<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Home Section8</h5>
      </div>
      <div class="card-body">
         <form class="forms-sample" 
               action="{{route('homeSection8.update', $section)}}"
               method="POST" 
               autocomplete="off" 
               enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            @include('admin.homeSection.section8.form')

        </form>
      </div>
    </div>
  </div>
</div>


@endsection