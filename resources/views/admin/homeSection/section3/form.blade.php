{{--<div class="mb-3">
  <label class="form-label" for="Name">Heading <span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="heading" 
           class="form-control @error('heading') is-invalid @enderror"
           id="heading" 
           placeholder="Enter Heading" 
           value="{{old('heading', isset($section->heading) ? $section->heading:'')}}" 
            />
  </div>
</div>--}}






<div class="mb-3">
  <div class="row">
    <div class="col-md-7">
      <label for="ProfileImage" class="form-label">
        Image 
      </label>
      <input type="file" name="image1" accept="image/*" id="ProfileImage" onchange="showSelectedImagesss(this)" class="form-control @error('image1') is-invalid @enderror" />
    </div>

    <div class="col-md-5">
        <img src="{{  isset($section->image1) ? config("app.url").Storage::url($section->image1) : asset('adminAssets/img/default-image.png') }}"
         id="SelectedImgsss"
         class="w-px-100 h-px-100 rounded-circle"
         title="section Image"
         alt="section_image">
    </div>
  </div>
</div>

<div class="mb-3">
  <label class="form-label" for="Name">Text Line 1<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="image1_text" 
           class="form-control @error('image1_text') is-invalid @enderror"
           id="image1_text" 
           placeholder="Enter Image1 Text" 
           value="{{old('image1_text', isset($section->image1_text) ? $section->image1_text:'')}}" 
            />
  </div>
</div>
<div class="mb-3">
  <label class="form-label" for="Name"> Text Line 2</label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="btn1_text" 
           class="form-control @error('btn1_text') is-invalid @enderror"
           id="btn1_text" 
           placeholder="Enter Button 1 Text" 
           value="{{old('btn1_text', isset($section->btn1_text) ? $section->btn1_text:'')}}" 
            />
  </div>
</div>

<div class="mb-3">
  <label class="form-label" for="Name">Text Line 3 </label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="btn1_url" 
           class="form-control @error('btn1_url') is-invalid @enderror"
           id="btn1_url" 
           placeholder="Enter Button 1 URL" 
           value="{{old('btn1_url', isset($section->btn1_url) ? $section->btn1_url:'')}}" 
            />
  </div>
</div>

<div class="mb-3">
  <div class="row">
    <div class="col-md-7">
      <label for="ProfileImage" class="form-label">
       Video
      </label>
      <input type="file" name="image2" accept="video/*" id="ProfileVideo" onchange="showSelectedVideo(this)" class="form-control @error('video') is-invalid @enderror" />
    </div>

    <div class="col-md-5">
      <video controls
        id="SelectedVideo"
        class="w-px-100 h-px-100"
        title="section Video"
        alt="section_video">
        <source src="{{  isset($section->image2) ? config("app.url").Storage::url($section->image2) : asset('adminAssets/img/default-image.png') }}" type="video/mp4">
        Your browser does not support the video tag.
      </video>
       
    </div>
  </div>
</div>

<script>
function showSelectedVideo(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      var video = document.getElementById('SelectedVideo');
      video.src = e.target.result;
      video.load();
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}
</script>



{{--<div class="mb-3">
  <label class="form-label" for="Name">Image 2 Text <span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="image2_text" 
           class="form-control @error('image2_text') is-invalid @enderror"
           id="image2_text" 
           placeholder="Enter Image2 Text" 
           value="{{old('image2_text', isset($section->image2_text) ? $section->image2_text:'')}}" 
            />
  </div>
</div>







<div class="mb-3">
  <label class="form-label" for="Name">Button 2 Text </label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="btn2_text" 
           class="form-control @error('btn2_text') is-invalid @enderror"
           id="btn2_text" 
           placeholder="Enter Button 2 Text" 
           value="{{old('btn2_text', isset($section->btn2_text) ? $section->btn2_text:'')}}" 
            />
  </div>
</div>

<div class="mb-3">
  <label class="form-label" for="Name">Button 2 URL </label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="btn2_url" 
           class="form-control @error('btn2_url') is-invalid @enderror"
           id="btn2_url" 
           placeholder="Enter Button 1 URL" 
           value="{{old('btn2_url', isset($section->btn2_url) ? $section->btn2_url:'')}}" 
            />
  </div>
</div>
--}}




<button type="submit" class="btn btn-primary">{{isset($section) ? 'Update' : 'Create'}}</button>
<a class="btn btn-dark" href="{{ route('homeSection3.index') }}">Cancel</a>




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

function showSelectedImagess(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#SelectedImgss').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
  }
}
</script>

@include('admin.common.scripts')




