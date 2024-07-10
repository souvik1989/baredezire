@extends('admin.layout.adminMasterLayout')

@section('title', 'Product List')

@section('content')

<div class="content-wrapper">



  <div>
    <a href="{{ route('product.create') }}" class="btn btn-primary font-weight-bold mb-3">+ Add New Product</a>
  </div>

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Product List</h3>
          <hr>
<button type="button" id="deleteSelectedRows" class="btn btn-danger">Delete Selected</button>
          <div class="table-responsive">
            <table class="table table-striped FAQ_LIST <?php echo count($products)?'dataTable':'';?>">
              <thead>
                <tr>
                   <th></th>
                     <th>Action</th>
                  <th>ID</th>
                 <th>SKU</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Price</th>
                  <th>Categories</th>
                  <th>Status</th>
                  <th>Is Featured</th>
                   <th>Offer Status</th>
                  <th>Created On</th>
                 
                </tr>
              </thead>

              <tbody>
                  @forelse($products as $product)

                    <tr data-index="{{ $product->id }}" >
                          <td>
        <input type="checkbox" name="selectedCategories[]" value="{{ $product->id }}">
    </td>
                      
                         <td>
                        <a href="{{ route('product.edit', $product) }}" class="btn btn-info btn-sm">
                          <i class='bx bx-edit-alt' ></i>
                        </a>

                        <div class="d-inline-block">
                           <form action="{{route('product.destroy', $product->id)}}"
                              method="POST"
                              >
                              @csrf
                              @method('DELETE')
                               <button type="submit"
                                    class="btn btn-danger btn-sm Delete"
                                    style="cursor: pointer;">

                                <i class='bx bxs-trash'></i>
                              </button>
                          </form>
                          </div>
                      </td>
                        <td>
                        {{  $product->id ?? "" }}
                      </td>
  <td>
                        {{  $product->sku ?? "" }}
                      </td>
                      <td>
                        {{  $product->name }}
                      </td>
                       <td>
                        {{  $product->slug??'--' }}
                      </td>
                      <td>
                        {{  $product->original_price }}
                      </td>
                      <td>
                              @foreach ($product->product_categories as $product_category)
                              {{ $product_category->name }}
                              @if(!$loop->last)
                              ,
                              @endif
                              @endforeach
                           </td>
                      <td>
                         <div class="dropdown action-label">
                          <a class="btn @if(isset($product->status) && ($product->status=='1')) btn-primary @else btn-danger @endif  dropdown-toggle btn-sm text-white" data-bs-toggle="dropdown" aria-expanded="false">

                            <?=(isset($product->status) && $product->status=='1')?'<i class="fa fa-dot-circle-o text-success"></i> Active':'<i class="fa fa-dot-circle-o text-danger"></i> Inactive';?>

                            <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                              <form action="{{route('product.status', $product->id)}}"
                                  method="POST"
                                  >
                                  @csrf
                                  @method('PUT')
                                   <button type="submit"
                                        class="dropdown-item status-btn btn-sm"
                                        style="cursor: pointer;">

                                    {!! ($product->status=='1')? "<i class='fa fa-dot-circle-o text-danger'></i> Inactive":"<i class='fa fa-dot-circle-o text-success'></i> Active" !!}
                                  </button>
                              </form>
                            </div>
                        </div>
                      </td>


                      <td>
                         <div class="dropdown action-label">
                          <a class="btn @if(isset($product->is_featured) && ($product->is_featured=='1')) btn-warning @else btn-success  @endif  dropdown-toggle btn-sm text-white" data-bs-toggle="dropdown" aria-expanded="false">

                            <?=(isset($product->is_featured) && $product->is_featured=='1')?'<i class="fa fa-dot-circle-o text-danger"></i> Not Featured':'<i class="fa fa-dot-circle-o text-success"></i> Featured';?>

                            <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                              <form action="{{route('product.is_featured', $product->id)}}"
                                  method="POST"
                                  >
                                  @csrf
                                  @method('PUT')
                                   <button type="submit"
                                        class="dropdown-item is_featured-btn btn-sm"
                                        style="cursor: pointer;">

                                    {!! ($product->is_featured=='1')? "<i class='fa fa-dot-circle-o text-success'></i> Featured":"<i class='fa fa-dot-circle-o text-danger'></i> Not Featured" !!}
                                  </button>
                              </form>
                            </div>
                        </div>
                      </td>
 <td>
                         <div class="dropdown action-label">
                          <a class="btn @if(isset($product->is_offer) && ($product->is_offer=='1')) btn-warning @else btn-success  @endif  dropdown-toggle btn-sm text-white" data-bs-toggle="dropdown" aria-expanded="false">

                            <?=(isset($product->is_offer) && $product->is_offer=='1')?'<i class="fa fa-dot-circle-o text-danger"></i> Not in Offer':'<i class="fa fa-dot-circle-o text-success"></i> Offer';?>

                            <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                              <form action="{{route('product.is_offer', $product->id)}}"
                                  method="POST"
                                  >
                                  @csrf
                                  @method('PUT')
                                   <button type="submit"
                                        class="dropdown-item is_featured-btn btn-sm"
                                        style="cursor: pointer;">

                                    {!! ($product->is_offer=='1')? "<i class='fa fa-dot-circle-o text-success'></i>Offer":"<i class='fa fa-dot-circle-o text-danger'></i>Not in Offer" !!}
                                  </button>
                              </form>
                            </div>
                        </div>
                      </td>
                      <td>
                                      {{ \Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}
                                  </td>
                     
                    </tr>
                 @empty
                  <td colspan="6" class="text-center">Nothing is Listed Yet</td>
                @endforelse

              </tbody>
            </table>

           
          </div>
        </div>
      </div>
    </div>
  </div>


</div>



@include('admin.common.deleteConfirm')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  // Handle the "Delete Selected" button click
  $('#deleteSelectedRows').click(function () {
    alert(0)
    var selectedRows = [];

    $('input[name="selectedCategories[]"]:checked').each(function () {
      selectedRows.push($(this).val());
    });
    
    if (selectedRows.length > 0) {
      if (confirm('Are you sure you want to delete the selected rows?')) {
        var selectedRowsString = selectedRows.join(',');
        var formData = new FormData();
        formData.append('selectedRowsString', selectedRowsString);

        // Make an AJAX request to delete the selected rows
        $.ajax({
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '{{ route('delete-selected-rows-product') }}',
          data: formData,
          processData: false, // Important to prevent automatic data processing
          contentType: false,
          success: function (response) {
            // Handle success response
            console.log(response);

            if (response.status == 200) {
              iziToast.success({
                title: 'Success',
                message: response.message,
                position: 'topCenter'
              });
              window.location.reload();
            } else {
              iziToast.error({
                title: 'Error',
                message: response.message,
                position: 'topCenter'
              });
            }
          },
          error: function (error) {
            // Handle error response
            console.error(error);
          }
        });
      }
    } else {
      alert('No rows selected. Please select rows to delete.');
    }
  });
});
</script>

@endsection
