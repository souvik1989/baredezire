<div class="mb-3">
  <div class="row">
    <div class="col-md-7">
      <label for="ProfileImage" class="form-label">
      Image
      </label>
      <input type="file" name="image" accept="image/*" id="ProfileImage" onchange="showSelectedImagesss(this)" class="form-control @error('image') is-invalid @enderror" />
    </div>

    <div class="col-md-5">
        <img src="{{  isset($section->image) ? config("app.url").Storage::url($section->image) : asset('adminAssets/img/default-image.png') }}"
         id="SelectedImgsss"
         class="w-px-100 h-px-100 rounded-circle"
         title="section Image"
         alt="section_image">
    </div>
  </div>
</div>

<div class="mb-3">
  <label class="form-label" for="Name">Title</label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="title" 
           class="form-control @error('title') is-invalid @enderror"
           id="btn1_text" 
           placeholder="Enter Title" 
           value="{{old('title', isset($section->title) ? $section->title:'')}}" 
            />
  </div>
</div>



<div class="mb-3">
  <label class="form-label" for="Name"> URL </label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="url" 
           class="form-control @error('url') is-invalid @enderror"
           id="btn1_url" 
           placeholder="Enter URL" 
           value="{{old('url', isset($section->url) ? $section->url:'')}}" 
            />
  </div>
</div>
<div class="mb-3">
  <div class="row">
    <div class="col-md-7">
      <label for="ProfileImage" class="form-label">
      Image2
      </label>
      <input type="file" name="image1" accept="image/*" id="ProfileImage" onchange="showSelectedImagess(this)" class="form-control @error('image1') is-invalid @enderror" />
    </div>

    <div class="col-md-5">
        <img src="{{  isset($section->image1) ? config("app.url").Storage::url($section->image1) : asset('adminAssets/img/default-image.png') }}"
         id="SelectedImgss"
         class="w-px-100 h-px-100 rounded-circle"
         title="section Image"
         alt="section_image">
    </div>
  </div>
</div>

<div class="mb-3">
  <label class="form-label" for="Name">Title2</label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="title1" 
           class="form-control @error('title1') is-invalid @enderror"
           id="btn1_text" 
           placeholder="Enter Title 2" 
           value="{{old('title1', isset($section->title1) ? $section->title1:'')}}" 
            />
  </div>
</div>



<div class="mb-3">
  <label class="form-label" for="Name"> URL </label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="url1" 
           class="form-control @error('url1') is-invalid @enderror"
           id="btn1_url" 
           placeholder="Enter URL 2" 
           value="{{old('url1', isset($section->url1) ? $section->url1:'')}}" 
            />
  </div>
</div>
<div class="mb-3">
  <div class="row">
    <div class="col-md-7">
      <label for="ProfileImage" class="form-label">
      Image3
      </label>
      <input type="file" name="image2" accept="image/*" id="ProfileImage" onchange="showSelectedImages(this)" class="form-control @error('image2') is-invalid @enderror" />
    </div>

    <div class="col-md-5">
        <img src="{{  isset($section->image2) ? config("app.url").Storage::url($section->image2) : asset('adminAssets/img/default-image.png') }}"
         id="SelectedImgs"
         class="w-px-100 h-px-100 rounded-circle"
         title="section Image"
         alt="section_image">
    </div>
  </div>
</div>

<div class="mb-3">
  <label class="form-label" for="Name">Title3</label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="title2" 
           class="form-control @error('title2') is-invalid @enderror"
           id="btn1_text" 
           placeholder="Enter Title 3" 
           value="{{old('title2', isset($section->title2) ? $section->title2:'')}}" 
            />
  </div>
</div>



<div class="mb-3">
  <label class="form-label" for="Name"> URL3 </label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="url2" 
           class="form-control @error('url2') is-invalid @enderror"
           id="btn1_url" 
           placeholder="Enter URL 3" 
           value="{{old('url2', isset($section->url2) ? $section->url2:'')}}" 
            />
  </div>
</div>


<button type="submit" class="btn btn-primary">{{isset($section) ? 'Update' : 'Create'}}</button>
<a class="btn btn-dark" href="{{ route('homeSectionNew4.index') }}">Cancel</a>




<script>
  function showSelectedImages(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#SelectedImgs').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

function showSelectedImagesss(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#SelectedImgsss').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}
function showSelectedImagesssss(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#SelectedImgsssss').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}
function showSelectedImagess(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#SelectedImgss').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}

function showSelectedImagessss(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#SelectedImgssss').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}


</script>

@include('admin.common.scripts')




