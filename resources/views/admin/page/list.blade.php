@extends('admin.layout.adminMasterLayout')
@section('title','Pages')

@section('content')

<div class="container-fluid">
 

 {{--<a href="{{ route('page.create') }}" class="btn btn-success mb-25"> + Create New Banner Image</a>--}}

   <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
           
            <div class="body table-responsive special">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Terms and Conditions</th>
                            <th>Privacy policy</th>
                            <th>Return Policy</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pages as $page)
                        <tr>
                            <td>
                                
                                   <p>{{ Str::limit($page->terms, 100) }}</p>
                            </td>

                            <td>
                               <p>{{ Str::limit($page->privacy, 200) }}</p>
                            </td>

                            <td>
                               <p>{{ Str::limit($page->return_policy,100) }}</p>
                            </td>
                           

                            <td>
                                <a href="{{ route('page.edit',$page->id) }}"
                                    class="btn btn-success btn-sm ml-3 btn btn-primary btn-sm ml-3">
                                    <i class='bx bx-edit-alt' ></i> 
                                </a>
                            
                                
                            </td>
                            
                        </tr>
                        @empty
                        <td colspan="6">No record found</td>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
   
  
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@include('admin.common.deleteConfirm')

<script>
  $(document).ready(function() {
    $('.dropdown-toggle').dropdown();
});

  </script>

@endsection

