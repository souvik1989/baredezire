<div class="mb-3">
  <label class="form-label" for="FaqQuestion">Banner Name<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

   <input type="text"
           name="name"
           class="form-control @error('name') is-invalid @enderror"
           id="ProductCatName"
           placeholder="Enter Name"
           value="{{old('name', isset($category->name) ? $category->name:'')}}"
           required />
  </div>
</div>



<div class="mb-3">
    <div class="row">
      <div class="col-md-7">
        <label for="ProfileImage" class="form-label">
          Banner Image
        </label>
        <input type="file" name="image" accept="image/*" id="ProfileImage" onchange="showSelectedImage(this)" class="form-control @error('image') is-invalid @enderror" />
      </div>

      <div class="col-md-5">
          <img src="{{ isset($category->image) ? config("app.url").Storage::url($category->image) : asset('adminAssets/img/default-image.png') }}"
           id="SelectedImg"
           class="w-px-100 h-px-100 rounded-circle"
           title="Banner Image"
           alt="Banner_image">
      </div>
    </div>
  </div>

  
<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Banner Description</label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor" name="description" placeholder="Description">{{old('description') ?? ($category->description ?? '') }}</textarea>
    </div>
  </div>



<button type="submit" class="btn btn-primary">{{isset($category) ? 'Update' : 'Create'}}</button>
<a class="btn btn-dark" href="{{ route('product-category.index') }}">Cancel</a>

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




