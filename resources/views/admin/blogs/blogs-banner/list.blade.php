@extends('admin.layout.adminMasterLayout')

@section('title', 'Blog Banner')

@section('content')

<div class="content-wrapper">

  {{-- @include('admin.homepageManager.faq.text.edit') --}}

  {{--<div>
    <a href="{{ route('blog-banner.create') }}" class="btn btn-primary font-weight-bold mb-3">+ Add New Category</a>
  </div>--}}

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Blog Banner</h3>
          <hr>
  
          <div class="table-responsive">
            <table class="table table-striped FAQ_LIST <?php echo count($categories)?'dataTable':'';?>">
              <thead>
                <tr>
                  
                    <th>Action</th>
                  <th>Image</th>
                  <th>Name</th>
                
                  <th>Created On</th>
                  
                </tr>
              </thead>

              <tbody>
                  @forelse($categories as $category)

                    <tr data-index="{{ $category->id }}" >
                     
                       
  <td>
                        <a href="{{ route('blog-banner.edit', $category) }}" class="btn btn-info btn-sm">
                          <i class='bx bx-edit-alt' ></i> 
                        </a>

                       {{-- <div class="d-inline-block">
                           <form action="{{route('blog-banner.destroy', $category->id)}}"
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
                          </div>--}}
                      </td>
                        <td>
                                <img src="{{ !empty($category->image) ?  config("app.url").Storage::url($category->image) : asset('adminAssets/img/default-image.png') }}" width="50" height="50" alt="Story Image"
                                class="round__custom rounded-circle"
                               >
                            </td>
                      <td>
                        {{  $category->name }}
                      </td>
                     
                    


                               
                                <td>
                                      {{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y')}}
                                  </td>


                    
                    </tr>
                 @empty
                  <td colspan="4" class="text-center">Nothing is Listed Yet</td>
                @endforelse

              </tbody>
            </table>

         
          </div>
         
        </div>
      </div>
    </div>
  </div>


</div>


<script>
  $(document).ready(function () {
    // Handle the "Delete Selected" button click
    $('#deleteSelectedRows').click(function () {
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
            url: '{{ route('delete-selected-rows') }}',
            data: formData,
              processData: false, // Important to prevent automatic data processing
            contentType: false, 
            success: function (response) {
              // Handle success response
            
              console.log(response);
             iziToast.success({
                           title: 'Success',
                           message: data.message,
                           position:'topCenter'
             window.location.reload();
            if (data.status == 200) {
                        
                      
                       })
                   }
   
                   else{
                       iziToast.error({
                           title: 'Error',
                           message: data.message,
                           position:'topCenter'
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



@include('admin.common.deleteConfirm')


@endsection
