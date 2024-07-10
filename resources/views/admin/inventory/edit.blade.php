@extends('admin.layout.adminMasterLayout')

@section('title', "Edit Inventory")

@section('content')



<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit-{{ $inventory->name }}</h5>
      </div>
      <div id="output"></div>
      <div class="card-body">
         <form class="forms-sample"
               action="{{route('inventory.update', $inventory)}}"
               method="POST"
               autocomplete="off"
               enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            @include('admin.inventory.form')

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
