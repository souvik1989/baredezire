@extends('admin.layout.adminMasterLayout')

@section('title', 'Blog Category List')

@section('content')

<div class="content-wrapper">

  {{-- @include('admin.homepageManager.faq.text.edit') --}}

  <div>
    <a href="{{ route('blog-category.create') }}" class="btn btn-primary font-weight-bold mb-3">+ Add New Category</a>
  </div>

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Blog Categories</h3>
          <hr>
  
             
          <div class="table-responsive">
            <table class="table table-striped FAQ_LIST <?php echo count($categories)?'dataTable':'';?>">
              <thead>
                <tr>
                   
                    <th>Action</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Status</th>
                  <th>Created On</th>
                  
                </tr>
              </thead>

              <tbody>
                  @forelse($categories as $category)

                    <tr data-index="{{ $category->id }}" >
                      
                       
  <td>
                        <a href="{{ route('blog-category.edit', $category) }}" class="btn btn-info btn-sm">
                          <i class='bx bx-edit-alt' ></i> 
                        </a>

                        <div class="d-inline-block">
                           <form action="{{route('blog-category.destroy', $category->id)}}"
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
                        {{  $category->name }}
                      </td>
                      <td> {{  $category->slug??'--' }}</td>
                     
                      
                 

                 


                                <td>
                         <div class="dropdown action-label">
                          <a class="btn @if(isset($category->status) && ($category->status=='1')) btn-primary @else btn-danger @endif  dropdown-toggle btn-sm text-white" data-bs-toggle="dropdown" aria-expanded="false">

                            <?=(isset($category->status) && $category->status=='1')?'<i class="fa fa-dot-circle-o text-success"></i> Active':'<i class="fa fa-dot-circle-o text-danger"></i> Inactive';?>

                            <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                              <form action="{{route('blogcategory.status', $category->id)}}"
                                  method="POST"
                                  >
                                  @csrf
                                  @method('PUT')
                                   <button type="submit"
                                        class="dropdown-item status-btn btn-sm"
                                        style="cursor: pointer;">

                                    {!! ($category->status=='1')? "<i class='fa fa-dot-circle-o text-danger'></i> Inactive":"<i class='fa fa-dot-circle-o text-success'></i> Active" !!}
                                  </button>
                              </form>
                            </div>
                        </div>
                      </td>

                                <td>
                                      {{ \Carbon\Carbon::parse($category->created_at)->format('d/m/Y')}}
                                  </td>


                    
                    </tr>
                 @empty
                  <td colspan="5" class="text-center">Nothing is Listed Yet</td>
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
