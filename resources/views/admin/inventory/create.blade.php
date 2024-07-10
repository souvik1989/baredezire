@extends('admin.layout.adminMasterLayout')

@section('title', 'Add New Inventory')

@section('content')



<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Add a new Item</h5>
      </div>
      <div class="card-body">
      <div id="output"></div>
         <form class="forms-sample"
               action="{{route('inventory.store')}}"
               method="POST"
               autocomplete="off"
               enctype="multipart/form-data">

          @csrf
          @include('admin.inventory.form')
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
