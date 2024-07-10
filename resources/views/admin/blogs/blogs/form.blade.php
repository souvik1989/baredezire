<div class="mb-3">
  <label class="form-label" for="FaqQuestion">Blog Name<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

   <input type="text"
           name="name"
           class="form-control @error('name') is-invalid @enderror"
           id="ProductCatName"
           placeholder="Enter Name"
           value="{{old('name', isset($blog->name) ? $blog->name:'')}}"
           required />
  </div>
</div>



<div class="mb-3">
    <div class="row">
      <div class="col-md-7">
        <label for="ProfileImage" class="form-label">
          Blog Image
        </label>
        <input type="file" name="image" accept="image/*" id="ProfileImage" onchange="showSelectedImage(this)" class="form-control @error('image') is-invalid @enderror" />
      </div>

      <div class="col-md-5">
          <img src="{{ isset($blog->image) ? config("app.url").Storage::url($blog->image) : asset('adminAssets/img/default-image.png') }}"
           id="SelectedImg"
           class="w-px-100 h-px-100 rounded-circle"
           title="Blog Image"
           alt="Blog_image">
      </div>
    </div>
  </div>

  <div class="mb-3">
  <label class="form-label" for="level">Blog Category<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick country" name="blog_category_id[]" multiple>
                  <option value="" Disabled> Please Select Option </option>
                  @if ($b_categories->count() > 0)
                  @foreach ($b_categories as $category)
                  @if ((!empty($blog->blog_categories) && $blog->blog_categories->contains($category->id))|| collect(old('blog_category_id'))->contains($category->id))
                  <option value="{{ $category->id }}" selected=""> {{ $category->name }} </option>
                  @else
                  <option value="{{ $category->id }}"> {{ $category->name }} </option>
                  @endif
                  @endforeach
                  @endif
               </select>
  </div>
</div>


<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Blog Description</label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor" name="description" placeholder="Description">{{old('description') ?? ($blog->description ?? '') }}</textarea>
    </div>
  </div>
<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Short Description<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor " name="short_description" placeholder="Short Description">{{old('short_description') ?? ($blog->short_description ?? '') }}</textarea>
    </div>
  </div>

  


<button type="submit" class="btn btn-primary">{{isset($blog) ? 'Update' : 'Create'}}</button>
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
  <script>
   $(function() {
         $('.deleteImage').on('click', function(e){
           e.preventDefault()
           let imageObj = $(this),
               image_id = imageObj.data('id'),
               url = '{{ route('product.removeImage') }}'
           if(confirm('Are you sure you want to delete this ?')) {
             $.ajax({
               headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               url: url,
               type: "DELETE",
               data: {'image_id':image_id},
               success: function(data) {
                   if (data.status == 200) {
                       imageObj.prev().remove()
                       imageObj.remove()
                       iziToast.success({
                           title: 'Success',
                           message: data.message,
                           position:'topCenter'
                       })
                   }
   
                   else{
                       iziToast.error({
                           title: 'Error',
                           message: data.message,
                           position:'topCenter'
                       });
                   }
               }
             });
           }
        });
   });
   
</script>






<script>
            $(document).ready(function () {
                //Select2
                $(".country").select2({
                    maximumSelectionLength: 9,
                });
                //Chosen
                $(".country1").chosen({
                    max_selected_options: 9,
                });
            });
        </script>




