<div class="mb-3">
  <label class="form-label" for="FaqQuestion">Filter Category Name<span class="text-danger">*</span></label>
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
  <label class="form-label" for="level">Filter Category Level<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick" name="level" id="menu1">
               <option value="" Disabled selected> Select Type </option>
            
               <option value="0" {{(!empty($category->level) && $category->level == 0) || old('level')==0 ? 'selected':'' }}> Parent Category </option>
               <option value="1" {{ (!empty($category->level) && $category->level == 1)|| old('level')==1 ? 'selected':'' }}> Filter Category</option>
            
            </select>
  </div>
</div>

<div class="mb-3" id="Menu2Container" style="@if((isset($category->level) && ($category->level == 0 )) ){{ 'display:none;'}} @else {{'display:block;'}} @endif">
  <label class="form-label" for="level">Filter Category Parent<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick" name="parent_id" id="menu2">
               <option value="" Disabled selected> Select Type </option>
               @if ($p_categories->count() > 0)
                  @foreach ($p_categories as $categorys)
                  @if (!empty($category->parent_id) && $category->parent_id== $categorys->id || collect(old('parent_id'))->contains($categorys->id))
                  <option value="{{ $categorys->id }}" selected=""> {{$categorys->name.'-Parent Category'}}</option>
                  @else
                  <option value="{{ $categorys->id }}"> {{$categorys->name.'-Parent Category'}} </option>
                  @endif
                  @endforeach
                  @endif
            </select>
  </div>
</div>



<button type="submit" class="btn btn-primary">{{isset($category) ? 'Update' : 'Create'}}</button>
<a class="btn btn-dark" href="{{ route('filter-category.index') }}">Cancel</a>

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




