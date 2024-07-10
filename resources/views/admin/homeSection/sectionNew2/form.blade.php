



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




<button type="submit" class="btn btn-primary">{{isset($section) ? 'Update' : 'Create'}}</button>
<a class="btn btn-dark" href="{{ route('homeSectionNew2.index') }}">Cancel</a>




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




