@extends('admin.layout.adminMasterLayout')

@section('title', 'Create New')

@section('content')



<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Create New Home Section New 3</h5>
      </div>
      <div class="card-body">
         <form class="forms-sample" 
               action="{{route('homeSectionNew3.store')}}"
               method="POST" 
               autocomplete="off"
               enctype="multipart/form-data">

          @csrf
          @include('admin.homeSection.sectionNew3.form')
        </form>
      </div>
    </div>
  </div>
</div>


@endsection