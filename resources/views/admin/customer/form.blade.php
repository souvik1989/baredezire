

<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Customer Name</label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="name"
             class="form-control @error('name') is-invalid @enderror"
             id="ProductName"
             
             value="{{old('name', isset($user->name) ? $user->name:'')}}"
             required />
    </div>
  </div>
  
  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Email</label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="email"
             class="form-control @error('email') is-invalid @enderror"
             id="email"
             
             value="{{old('email', isset($user->email) ? $user->email:'')}}"
             required />
    </div>
  </div>
  
    <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Phone</label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="phone"
             class="form-control @error('phone') is-invalid @enderror"
             id="email"
             
             value="{{old('phone', isset($user->phone) ? $user->phone:'')}}"
             required />
    </div>
  </div>
  
     <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Address Line 1</label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="billing_address_line1"
             class="form-control @error('billing_address_line1') is-invalid @enderror"
             id="billing_address_line1"
             
             value="{{old('billing_address_line1', isset($user->ship_address->billing_address_line1) ? $user->ship_address->billing_address_line1:'')}}"
             required />
    </div>
  </div>
  
     <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Address Line 2</label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="billing_address_line2"
             class="form-control @error('billing_address_line2') is-invalid @enderror"
             id="billing_address_line1"
             
             value="{{old('billing_address_line1', isset($user->ship_address->billing_address_line2) ? $user->ship_address->billing_address_line2:'')}}"
             required />
    </div>
  </div>
  
     <div class="mb-3">
    <label class="form-label" for="FaqQuestion">City</label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="billing_city"
             class="form-control @error('billing_city') is-invalid @enderror"
             id="billing_city"
             
             value="{{old('billing_city', isset($user->ship_address->billing_city) ? $user->ship_address->billing_city:'')}}"
             required />
    </div>
  </div>
  
  
     <div class="mb-3">
    <label class="form-label" for="FaqQuestion">State</label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="billing_state"
             class="form-control @error('billing_state') is-invalid @enderror"
             id="email"
             
             value="{{old('billing_state', isset($user->ship_address->billing_state) ? $user->ship_address->billing_state:'')}}"
             required />
    </div>
  </div>
  
  
     <div class="mb-3">
    <label class="form-label" for="FaqQuestion">ZIP</label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="billing_zip"
             class="form-control @error('billing_zip') is-invalid @enderror"
             id="email"
             
             value="{{old('billing_zip', isset($user->ship_address->billing_zip) ? $user->ship_address->billing_zip:'')}}"
             required />
    </div>
  </div>
  
  
     <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Country</label>
    <div class="input-group input-group-merge">

     <input type="text"
             name="billing_country"
             class="form-control @error('billing_country') is-invalid @enderror"
             id="billing_country"
             
             value="{{old('billing_country', isset($user->ship_address->billing_country) ? $user->ship_address->billing_country:'')}}"
             required />
    </div>
  </div>



  <!--<button type="submit" class="btn btn-primary">{{isset($product) ? 'Update' : 'Create'}}</button>-->
  <a class="btn btn-dark" href="{{ route('customer.index') }}">Cancel</a>




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