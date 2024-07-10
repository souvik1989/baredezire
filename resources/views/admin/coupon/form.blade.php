<div class="mb-3">
  <label class="form-label" for="FaqQuestion">Coupon Code<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

   <input type="text"
           name="code"
           class="form-control @error('code') is-invalid @enderror"
           id="ProductCatName"
           placeholder="Enter Code"
           value="{{old('code', isset($coupon->code) ? $coupon->code:'')}}"
           required />
  </div>
</div>



<div class="mb-3">
    <div class="row">
      <div class="col-md-7">
        <label for="ProfileImage" class="form-label">
          Coupon Image
        </label>
        <input type="file" name="image" accept="image/*" id="ProfileImage" onchange="showSelectedImage(this)" class="form-control @error('image') is-invalid @enderror" />
      </div>

      <div class="col-md-5">
          <img src="{{ isset($coupon->image) ? config("app.url").Storage::url($coupon->image) : asset('adminAssets/img/default-image.png') }}"
           id="SelectedImg"
           class="w-px-100 h-px-100 rounded-circle"
           title="Image"
           alt="image">
      </div>
    </div>
  </div>
 <div class="mb-3">
  <label class="form-label" for="level">Coupon Category<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick" name="category" id="menu1">
               <option value="" Disabled selected> Select Type </option>
            
               <option value="amount" {{(!empty($coupon->category) && $coupon->category == 'amount') || old('category')=='amount' ? 'selected':'' }}> Amount Based </option>
               <option value="welcome" {{ (!empty($coupon->category) && $coupon->category == 'welcome')|| old('category')=='welcome' ? 'selected':'' }}> Welcome </option>
               
            </select>
  </div>
</div>
 <div class="mb-3">
  <label class="form-label" for="level">Coupon Type<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">
    <select class="form-control show-tick" name="type" id="couponType">
      <option value="" disabled selected>Select Type</option>
      <option value="amount" {{ (!empty($coupon->type) && $coupon->type == 'amount') || old('type')=='amount' ? 'selected':'' }}>Amount</option>
      <option value="percentage" {{ (!empty($coupon->type) && $coupon->type == 'percentage') || old('type')=='percentage' ? 'selected':'' }}>Percentage</option>
    </select>
  </div>
</div>

<div id="valueContainer" style="{{ isset($coupon->value) ? 'display:block;' : 'display:none;' }}">
  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Coupon Value<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">
      <input type="text"
             name="value"
             class="form-control @error('value') is-invalid @enderror"
             id="ProductCatName"
             placeholder="Enter Coupon Value"
             value="{{old('value', isset($coupon->value) ? $coupon->value:'')}}"
              />
    </div>
  </div>
</div>

<div id="percentContainer" style="{{ isset($coupon->percent) ? 'display:block;' : 'display:none;' }}">
  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Coupon Percent<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">
      <input type="text"
             name="percent"
             class="form-control @error('percent') is-invalid @enderror"
             id="ProductCatName"
             placeholder="Enter Coupon Percentage"
             value="{{old('percent', isset($coupon->percent) ? $coupon->percent:'')}}"
              />
    </div>
  </div>
</div>

 <div class="mb-3">
  <label class="form-label" for="FaqQuestion">Minimum Amount(If Any)<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

   <input type="text"
           name="min_amount"
           class="form-control @error('min_amount') is-invalid @enderror"
           id="ProductCatName"
           placeholder="Enter Amount"
           value="{{old('min_amount', isset($coupon->min_amount) ? $coupon->min_amount:'')}}"
            />
  </div>
</div>
<button type="submit" class="btn btn-primary">{{isset($coupon) ? 'Update' : 'Create'}}</button>
<a class="btn btn-dark" href="{{ route('coupon.index') }}">Cancel</a>

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
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var couponTypeSelect = document.getElementById("couponType");
    var valueContainer = document.getElementById("valueContainer");
    var percentContainer = document.getElementById("percentContainer");

    couponTypeSelect.addEventListener("change", function() {
      if (this.value === "amount") {
        valueContainer.style.display = "block";
        percentContainer.style.display = "none";
      } else if (this.value === "percentage") {
        valueContainer.style.display = "none";
        percentContainer.style.display = "block";
      } else {
        valueContainer.style.display = "none";
        percentContainer.style.display = "none";
      }
    });
  });
</script>

@include('admin.common.scripts')




