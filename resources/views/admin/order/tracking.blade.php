@extends('admin.layout.adminMasterLayout')

@section('title', "Update Tracking No")

@section('content')



<div class="row">
  <div class="col-xl-12">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tracking No for Order No.-{{ $order->order_number  }}</h5>
      </div>
      <div id="output"></div>
      <div class="card-body">
         <form class="forms-sample"
               action="{{route('order.track', $order)}}"
               method="POST"
               autocomplete="off"
               enctype="multipart/form-data">
            @csrf
            @method('PATCH')

           <div class="mb-3">
  <label class="form-label" for="FaqQuestion">Enter Tracking No. for this Order<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

   <input type="text"
           name="tracking_number"
           class="form-control @error('tracking_number') is-invalid @enderror"
           id="ProductCatName"
           placeholder="Enter Tracking No."
           value="{{old('name', isset($order->tracking_number) ? $order->tracking_number:'')}}"
           required />
  </div>
</div>





<button type="submit" class="btn btn-primary">Submit</button>
<a class="btn btn-dark" href="{{ route('order.index') }}">Cancel</a>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection






<script>
    $(document).ready(function () {
   
  
  $("#menu1").on("change", function(){ 
    var status = $(this).val(); 
     if (status==0)
       $("#Menu2Container").slideUp();
     else
      $("#Menu2Container").slideDown();
  });
});
</script>



@include('admin.common.scripts')




