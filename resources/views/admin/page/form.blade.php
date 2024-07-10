  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Terms And Conditions<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor" name="terms" placeholder="Terms and Conditions">{{old('terms') ?? ($page->terms ?? '') }}</textarea>
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Privacy Policy<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control form-control
      
      
      
      no-resize Editor" name="privacy" placeholder="Privacy Policy">{{old('privacy') ?? ($page->privacy ?? '') }}</textarea>
    </div>
  </div>


  <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Return Policy<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor" name="return_policy" placeholder="Return Policy">{{old('return_policy') ?? ($page->return_policy ?? '') }}</textarea>
    </div>
  </div>

 <div class="mb-3">
    <label class="form-label" for="FaqQuestion">Shipping Policy<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor" name="shipping" placeholder="Shipping Policy">{{old('shipping') ?? ($page->shipping ?? '') }}</textarea>
    </div>
  </div>

 <div class="mb-3">
    <label class="form-label" for="FaqQuestion">About Us<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

      <textarea rows="12" class="form-control no-resize Editor" name="about" placeholder="About Us">{{old('about') ?? ($page->about ?? '') }}</textarea>
    </div>
  </div>

<button type="submit" class="btn btn-primary mr-2">Submit</button>
<a class="btn btn-dark" href="{{ route('page.index') }}">Cancel</a>

