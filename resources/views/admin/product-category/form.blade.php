<div class="mb-3">
  <label class="form-label" for="FaqQuestion">Product Category Name<span class="text-danger">*</span></label>
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
        <input type="file" name="banner_image" accept="image/*" id="ProfileImage" onchange="showSelectedImage(this)" class="form-control @error('banner_image') is-invalid @enderror" />
      </div>

      <div class="col-md-5">
          <img src="{{ isset($category->banner_image) ? config("app.url").Storage::url($category->banner_image) : asset('adminAssets/img/default-image.png') }}"
           id="SelectedImg"
           class="w-px-100 h-px-100 rounded-circle"
           title="Banner Image"
           alt="Banner_image">
      </div>
    </div>
  </div>

  <div class="mb-3">
  <label class="form-label" for="level">Product Category Level<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick" name="level" id="menu1">
               <option value="" Disabled selected> Select Type </option>
            
               <option value="0" {{(!empty($category->level) && $category->level == 0) || old('level')==0 ? 'selected':'' }}> Main Category </option>
               <option value="1" {{ (!empty($category->level) && $category->level == 1)|| old('level')==1 ? 'selected':'' }}> Filter Category</option>
               <option value="2" {{ (!empty($category->level) && $category->level == 2) || old('level')==2 ? 'selected':'' }}> Sub-Category </option>
            </select>
  </div>
</div>

<div class="mb-3" id="Menu2Container" style="@if((isset($category->level) && ($category->level == 0 )) ){{ 'display:none;'}} @else {{'display:block;'}} @endif">
  <label class="form-label" for="level">Product Category Parent<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick" name="parent_id" id="menu2">
               <option value="" Disabled selected> Select Type </option>
               @if ($p_categories->count() > 0)
                  @foreach ($p_categories as $categorys)
                  @if (!empty($category->parent_id) && $category->parent_id== $categorys->id || collect(old('parent_id'))->contains($categorys->id))
                  <option value="{{ $categorys->id }}" selected=""> @if($categorys->level=='0'){{$categorys->name.'-Main Category'}} @elseif($categorys->level=='1') {{$categorys->name.'-'.$categorys->parent->name}} @else {{$categorys->name.'-'.$categorys->parent->parent->name}} @endif </option>
                  @else
                  <option value="{{ $categorys->id }}">  @if($categorys->level=='0'){{$categorys->name.'-Main Category'}} @elseif($categorys->level=='1') {{$categorys->name.'-'.$categorys->parent->name}} @else {{$categorys->name.'-'.$categorys->parent->parent->name}} @endif  </option>
                  @endif
                  @endforeach
                  @endif
            </select>
  </div>
</div>
<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Category Description</label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor" name="description" placeholder="Description">{{old('description') ?? ($category->description ?? '') }}</textarea>
    </div>
  </div>
<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Meta Description<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize " name="meta_description" placeholder="Meta Description">{{old('meta_description') ?? ($category->meta_description ?? '') }}</textarea>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Meta Title<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control form-control no-resize " name="meta_title" placeholder="Meta Title">{{old('meta_title') ?? ($category->meta_title ?? '') }}</textarea>
    </div>
  </div>


  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Meta Keywords<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize " name="meta_tags" placeholder="Meta Keywords">{{old('meta_tags') ?? ($category->meta_tags ?? '') }}</textarea>
    </div>
  </div>

@foreach($f_categories->where('level', 0) as $catt)

    <div class="mb-3" id="Menu2Container">
  <label class="form-label" for="level">Filter Category-{{$catt->name}}<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">
 
  <select class="form-control show-tick country" name="{{$catt->name}}_id[]" multiple>
                  <option value="" Disabled> Please Select Option </option>
                  @if ($catt->children->count() > 0)
                 
                  @foreach ($catt->children as $caty)
                  
                  @if ((!empty($category->filter_categories) && $category->filter_categories->contains($caty->id))|| collect(old('{{$catt->name}}_id[]'))->contains($caty->id))
                  <option value="{{ $caty->id }}" selected=""> {{ $caty->name }} </option>
                  @else
                  <option value="{{ $caty->id }}"> {{ $caty->name }} </option>
                  @endif
                  @endforeach
                  @endif
               </select>
  </div>
</div>

@endforeach
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

<script>
            $(document).ready(function () {
                //Select2
                $(".country").select2({
                    maximumSelectionLength: 50,
                });
                //Chosen
                $(".country1").chosen({
                    max_selected_options: 50,
                });
            });
        </script>

@include('admin.common.scripts')




