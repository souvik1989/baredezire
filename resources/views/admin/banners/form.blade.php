<div class="form-group">
  <label for="Name">Title to Banner <span class="text-danger">*</span></label>
  <div class="form-line">
    <input type="text"
    name="title"
    class="form-control @error('title') is-invalid @enderror"
    id="title"
    placeholder="Title to the banner"
    value="{{old('title', isset($bannerlists->title) ? $bannerlists->title:'')}}"
    required />
  </div>
</div>





<div class="form-group">
  <label for="Image"> Insert Banner Image</label>
  
  <div class="row">
    <div class="col-md-6">
      <input type="file"
      name="banner_image"
      accept="banner_image/*"
      id="banner_image"
      onchange="showSelectedImage(this)"
      class="form-control mb-4 @error('banner_image') is-invalid @enderror" />
    </div>
    
    
    <div class="col-xl-6 col-lg-6 col-md-6">
     

      <img src="{{  isset($bannerlists->banner_image) ? config("app.url").Storage::url($bannerlists->banner_image) : asset('adminAssets/img/default-image.png') }}"
                id="SelectedImg" class="w-px-100 h-px-100 rounded-circle" title="Banner Image"
                alt="Banner Image" style="
    height: 100px;
">
      
    </div>
  </div>
</div>


<div class="form-group">
  <label for="Name">Description</label>
  
  <div class="row clearfix">
    <div class="col-sm-12">
      <div class="form-group">
        <div class="form-line">
          <textarea rows="4" name="description" class="form-control no-resize nicEdit" placeholder="Description">{{old('description') ?? ($bannerlists->description ?? '') }}</textarea>
        </div>
      </div>
    </div>
  </div>
</div>



<button type="submit" class="btn btn-primary mr-2">Submit</button>
<a class="btn btn-dark" href="{{ route('banner.index') }}">Cancel</a>



@include('admin.common.scripts')
    