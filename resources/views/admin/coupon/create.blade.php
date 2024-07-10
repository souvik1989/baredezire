@extends('admin.layout.adminMasterLayout')

@section('title', 'Add New Coupon')

@section('content')



<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Add a new Coupon</h5>
      </div>
      <div class="card-body">
         <form class="forms-sample"
               action="{{route('coupon.store')}}"
               method="POST"
               autocomplete="off"
               enctype="multipart/form-data">

          @csrf
          @include('admin.coupon.form')
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
