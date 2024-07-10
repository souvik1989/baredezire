 <meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Product Name<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="name"
             class="form-control @error('name') is-invalid @enderror"
             id="ProductName"
             placeholder="Enter Name"
             value="{{old('name', isset($product->name) ? $product->name:'')}}"
             required />
    </div>
  </div>
  
  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">SKU<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="sku"
             class="form-control @error('sku') is-invalid @enderror"
             id="sku"
             placeholder="Enter SKU for product"
             value="{{old('sku', isset($product->sku) ? $product->sku:'')}}"
             required />
    </div>
  </div>

<!--<div class="mb-3">-->
<!--  <div class="row">-->
<!--    <div class="col-md-7">-->
<!--      <label for="HomeBannerImage" class="form-label">-->
<!--        Main Image <span class="text-danger">*</span> -->
<!--      </label>-->
<!--      <input type="file" -->
<!--             name="product_image_main" -->
<!--             accept="image/*" -->
<!--             id="HomeBannerImage" -->
<!--             onchange="showSelectedImage(this)" -->
<!--             class="form-control @error('image') is-invalid @enderror" -->
<!--             {{isset($banner) ? '' : 'required'}} />-->
<!--    </div>-->

<!--    <div class="col-md-5">-->
<!--        <img src="{{ isset($product->product_images) && $product->product_images->count() > 0 ? config("app.url").Storage::url($product->product_images->first->image->image) : asset('adminAssets/img/default-image.png') }}"-->
<!--     id="SelectedImg"-->
<!--     class="w-px-100 h-px-100 rounded-circle"-->
<!--     title="Product Image"-->
<!--     alt="product_image">-->

<!--    </div>-->
<!--  </div>-->
<!--</div>-->

  <div class="mb-3">
    <div class="row">
        <div class="col-md-7">
            <label for="ProfileImage" class="form-label">
                Image
            </label>
            <input type="file" name="product_image[]" accept="image/*" multiple="" id="ProductImage" onchange="showSelectedImage(this)" class="form-control @error('icon') is-invalid @enderror" />
        </div>

        <div class="col-md-5">
            @if (isset($product->product_images))
                @foreach ($product->product_images as $image)
                    
                       
                        <img src="{{  isset($image->image) ? config("app.url").Storage::url($image->image) :asset('adminAssets/img/default-image.png')}}" width="100" height="100" class="round__custom rounded-circle" title="Product Image" alt="Product Image" style="margin-top: 20px;">
                       
                    
                @endforeach
            @endif
        </div>
    </div>
</div>

    <div class="mb-3" id="Menu2Container">
  <label class="form-label" for="level">Product Category<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick country" name="product_category_id[]" multiple>
                  <option value="" Disabled> Please Select Option </option>
                  @if ($categories->count() > 0)
                  @foreach ($categories as $category)
                  @if ((!empty($product->product_categories) && $product->product_categories->contains($category->id))|| collect(old('product_category_id'))->contains($category->id))
                  <option value="{{ $category->id }}" selected=""> {{ $category->name }}-({{$category->parent->parent->name}}) </option>
                  @else
                  <option value="{{ $category->id }}"> {{ $category->name }}-({{$category->parent->parent->name}}) </option>
                  @endif
                  @endforeach
                  @endif
               </select>
  </div>
</div>



<div class="mb-3">
  <label class="form-label" for="level">Product Size (For Bra only)<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick country" name="bra_size_id[]" multiple>>
                  <option value="" Disabled> Please Select Option </option>
                  @if ($bra_sizes->count() > 0)
                  @foreach ($bra_sizes as $size)
                  @if ((!empty($product->product_sizes) && $product->product_sizes->contains($size->id))|| collect(old('product_size_id'))->contains($size->id))
                  <option value="{{ $size->id }}" selected> {{ $size->size }} </option>
                  @else
                  <option value="{{ $size->id }}"> {{ $size->size }} </option>
                  @endif
                  @endforeach
                  @endif
               </select>
  </div>
</div>

<div class="mb-3">
  <label class="form-label" for="level">Product Size (For Other Products)<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick country" name="product_size_id[]" multiple>
                  <option value="" Disabled> Please Select Option </option>
                  @if ($sizes->count() > 0)
                  @foreach ($sizes as $size)
                  @if ((!empty($product->product_sizes) && $product->product_sizes->contains($size->id))|| collect(old('product_size_id'))->contains($size->id))
                  <option value="{{ $size->id }}" selected> {{ $size->size }} </option>
                  @else
                  <option value="{{ $size->id }}"> {{ $size->size }} </option>
                  @endif
                  @endforeach
                  @endif
               </select>
  </div>
</div>

<!--<div class="mb-3" id="Menu2Container">-->
<!--  <label class="form-label" for="level">Product Color<span class="text-danger">*</span></label>-->
<!--  <div class="input-group input-group-merge">-->

<!--  <select class="form-control show-tick" name="color_id">-->
<!--                  <option value="" Disabled selected> Please Select Option </option>-->
<!--                  @if ($colors->count() > 0)-->
<!--                  @foreach ($colors as $color)-->
<!--                  @if (!empty($product->color_id) && $product->color_id== $color->id || collect(old('color_id'))->contains($color->id))-->
<!--                  <option value="{{ $color->id }}" selected=""> {{ $color->name }} </option>-->
<!--                  @else-->
<!--                  <option value="{{ $color->id }}"> {{ $color->name }} </option>-->
<!--                  @endif-->
<!--                  @endforeach-->
<!--                  @endif-->
<!--               </select>-->
<!--  </div>-->
<!--</div>-->

<div class="mb-3" id="Menu2Container">
  <label class="form-label" for="level">Product Variations<span class="text-danger">*</span></label>
  <div class="input-group input-group-merge">

  <select class="form-control show-tick country" name="variation_id[]"
                    multiple="true" >
                  <option value="" Disabled> Please Select Option </option>
                  @if ($prods->count() > 0)
                  @foreach ($prods as $prod)
                  @if ((!empty($product->variations) && $product->variations->contains($prod->id))|| collect(old('variation_id'))->contains($prod->id))
                  <option value="{{ $prod->id }}" selected> {{ $prod->name }} </option>
                  @else
                  <option value="{{ $prod->id }}"> {{ $prod->name }} </option>
                  @endif
                  @endforeach
                  @endif
               </select>
  </div>
</div>
<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Product Original price<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="original_price"
             class="form-control @error('original_price') is-invalid @enderror"
             id="VideoCatName"
             placeholder="Enter Original Price"
             value="{{old('original_price', isset($product->original_price) ? $product->original_price:'')}}"
             required />
    </div>
  </div>


  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Product Selling price<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="selling_price"
             class="form-control @error('selling_price') is-invalid @enderror"
             id="VideoCatName"
             placeholder="Enter Selling Price"
             value="{{old('selling_price', isset($product->selling_price) ? $product->selling_price:'')}}"
             required />
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Product Description<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor" name="description" placeholder="Description">{{old('description') ?? ($product->description ?? '') }}</textarea>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Product Wash Care<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control form-control
      
      
      
      no-resize Editor" name="wash" placeholder="Wash Care">{{old('wash') ?? ($product->wash ?? '') }}</textarea>
    </div>
  </div>


  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Product Additional Info<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor" name="additional" placeholder="Additional Info">{{old('additional') ?? ($product->additional ?? '') }}</textarea>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Meta Description<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize " name="meta_description" placeholder="Meta Description">{{old('meta_description') ?? ($product->meta_description ?? '') }}</textarea>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Meta Title<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control form-control no-resize " name="meta_title" placeholder="Meta Title">{{old('meta_title') ?? ($product->meta_title ?? '') }}</textarea>
    </div>
  </div>


  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Meta Keywords<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize " name="meta_tags" placeholder="Meta Keywords">{{old('meta_tags') ?? ($product->meta_tags ?? '') }}</textarea>
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
                  
                  @if ((!empty($product->filter_categories) && $product->filter_categories->contains($caty->id))|| collect(old('{{$catt->name}}_id[]'))->contains($caty->id))
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

  <button type="submit" class="btn btn-primary">{{isset($product) ? 'Update' : 'Create'}}</button>
  <a class="btn btn-dark" href="{{ route('product.index') }}">Cancel</a>




  @include('admin.common.scripts')
  {{--<script>
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
   
</script>--}}


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.deleteImage');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-image-form');
                if (confirm('Are you sure you want to delete this image?')) {
                    form.submit();
                }
            });
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