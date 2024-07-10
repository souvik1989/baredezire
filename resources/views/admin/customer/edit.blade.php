@extends('admin.layout.adminMasterLayout')

@section('title', "View Customer")

@section('content')



<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">View-{{ $user->name }}</h5>
      </div>
      <div id="output"></div>
      <div class="card-body">
         <form class="forms-sample"
               action="{{route('customer.update', $user)}}"
               method="POST"
               autocomplete="off"
               enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            @include('admin.customer.form')

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
