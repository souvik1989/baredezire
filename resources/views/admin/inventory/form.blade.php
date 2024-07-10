<div class="mb-3" id="Menu2Container">
    <label class="form-label" for="level">Choose Product<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

        <select class="form-control show-tick" name="product_id">
            <option value="" Disabled selected> Please Select Option </option>
            @if ($products->count() > 0)
            @foreach ($products as $product)
            @if (!empty($inventory->product_id) && $inventory->product_id== $product->id ||
            collect(old('product_id'))->contains($product->id))
            <option value="{{ $product->id }}" selected=""> {{ $product->name }} {{$product->sku}}</option>
            @else
            <option value="{{ $product->id }}"> {{ $product->name }} {{$product->sku}}</option>
            @endif
            @endforeach
            @endif
        </select>
    </div>
</div>
<div class="mb-3">
    <label class="form-label" for="level">Product Size (For Bra only)<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

        <select class="form-control show-tick country" name="bra_size_id">
            <option value="" Disabled selected> Please Select Option </option>
            @if ($bra_sizes->count() > 0)
                @foreach ($bra_sizes as $size)
                    @if (!empty($inventory->product_size_id) && $inventory->product_size_id == $size->id || collect(old('bra_size_id'))->contains($size->id))
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

        <select class="form-control show-tick country" name="product_size_id">
            <option value="" disabled selected> Please Select Option </option>
            @if ($sizes->count() > 0)
                @foreach ($sizes as $size)
                    @if ((!empty($inventory->product_size_id) && $inventory->product_size_id == $size->id) || collect(old('product_size_id'))->contains($size->id))
                        <option value="{{ $size->id }}" selected> {{ $size->size }} </option>
                    @else
                        <option value="{{ $size->id }}"> {{ $size->size }} </option>
                    @endif
                @endforeach
            @endif
        </select>

    </div>
</div>


{{--@if(empty($inventory))
<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Quantity of purchase<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

    <input type="number" name="quantity" min="1" max="100" class="form-control @error('quantity') is-invalid @enderror"
            id="VideoCatName" placeholder="Enter Purchase Quantity"
            value="{{old('quantity', isset($inventory->quantity) ? $inventory->quantity:'')}}" required />
    </div>
</div>
@endif--}}


<div class="mb-3">
    <label class="form-label" for="FaqQuestion">Purchase Order Unit Price<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

        <input type="text" name="po_price" class="form-control @error('po_price') is-invalid @enderror"
            id="VideoCatName" placeholder="Enter purchase order unit price"
            value="{{old('po_price', isset($inventory->po_price) ? $inventory->po_price:'')}}" required />
    </div>
</div>


<div class="d-flex" style="grid-gap:20px">
<div class="mb-3" style="width:50%">
    <label class="form-label" for="FaqQuestion">Purchase Order Date<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

        <input type="date" name="po_date" class="form-control @error('po_date') is-invalid @enderror"
            id="VideoCatName" placeholder="Enter purchase order date"
            value="{{old('po_date', isset($inventory->po_date) ? $inventory->po_date:'')}}" required />
    </div>
</div>
<div class="mb-3" style="width:50%">
    <label class="form-label" for="FaqQuestion">Currnet Stock<span class="text-danger">*</span></label>
    <div class="input-group input-group-merge">

    <input type="number" name="stock" min="0" max="100" class="form-control @error('stock') is-invalid @enderror"
            id="VideoCatName" placeholder="Enter Current Stock"
            value="{{old('stock', isset($inventory->stock) ? $inventory->stock:'')}}" required />
    </div>
</div>
</div>






<button type="submit" class="btn btn-primary">{{isset($inventory) ? 'Update' : 'Create'}}</button>
<a class="btn btn-dark" href="{{ route('inventory.index') }}">Cancel</a>




@include('admin.common.scripts')




<script>
$(document).ready(function() {
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