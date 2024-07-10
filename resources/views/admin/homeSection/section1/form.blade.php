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
</div>
<div class="mb-3">
  <label class="form-label" for="Name">Sub Heading <span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="sub_heading" 
           class="form-control @error('sub_heading') is-invalid @enderror"
           id="sub_heading" 
           placeholder="Enter Sub Heading" 
           value="{{old('sub_heading', isset($section->sub_heading) ? $section->sub_heading:'')}}" 
            />
  </div>
</div>
<div class="mb-3">
  <label class="form-label" for="Name">Description <span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

    <input type="text" 
           name="description" 
           class="form-control @error('description') is-invalid @enderror"
           id="description" 
           placeholder="Enter Sub Heading" 
           value="{{old('description', isset($section->description) ? $section->description:'')}}" 
            />
  </div>
</div>--}}

<div class="mb-3">
  <label class="form-label" for="Name">Banners <span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">
 <select class="form-control show-tick" name="banner_id[]" multiple="">
   
             @if ($banners->count() > 0)
                   @foreach ($banners as $banner)
                   @if (!empty($page_content) && in_array($banner->id, $page_content) || (collect(old('banner_id'))->contains($banner->id)))
                   <option value="{{ $banner->id }}" selected=""> {{ $banner->title }} </option>
@else
<option value="{{ $banner->id }}"> {{ $banner->title }} </option>
@endif
@endforeach
@endif
</select>
      </div>
</div>

{{--
<div class="mb-3">
  <div class="row">
    <div class="col-md-7">
      <label for="ProfileImage" class="form-label">
       Banner Image 1
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
  <div class="row">
    <div class="col-md-7">
      <label for="ProfileImage" class="form-label">
       Banner Image 2
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
  <div class="row">
    <div class="col-md-7">
      <label for="ProfileImage" class="form-label">
       Banner Image 3
      </label>
      <input type="file" name="image3" accept="image/*" id="ProfileImage" onchange="showSelectedImagess(this)" class="form-control @error('image3') is-invalid @enderror" />
    </div>

    <div class="col-md-5">
        <img src="{{  isset($section->image3) ? config("app.url").Storage::url($section->image3) : asset('adminAssets/img/default-image.png') }}"
         id="SelectedImgss"
         class="w-px-100 h-px-100 rounded-circle"
         title="section Image"
         alt="section_image">
    </div>
  </div>
</div>




<div class="mb-3">
  <label class="form-label" for="Name">Button 1 Text </label>
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
  <label class="form-label" for="Name">Button 1 URL </label>
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
</div>--}}





<button type="submit" class="btn btn-primary">{{isset($section) ? 'Update' : 'Create'}}</button>
<a class="btn btn-dark" href="{{ route('homeSection1.index') }}">Cancel</a>




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




