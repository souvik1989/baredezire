@extends('admin.layout.adminMasterLayout')

@section('title', 'Home Section New 4')

@section('content')



<div class="content-wrapper">
  <div>
    <a href="{{ route('homeSectionNew4.create') }}" class="btn btn-primary font-weight-bold mb-3">+ Add New Content</a>
  </div>

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Home Section New 4 Contents</h4>
          <hr>
        
          <div class="table-responsive  text-nowrap special">
            <table class="table table-striped">
              <thead>
                <tr>
                  <!--<th>Image</th>-->
                  <th>Title</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @if($sections->count() > 0 )
                  @foreach($sections as $sec)
                    <tr>
                      <!--<td class="py-1">
                        <img src="{{  isset($sec->image) ? config("app.url").Storage::url($sec->image) : asset('adminAssets/img/default-image.png') }}" alt="banner_image" class="w-px-50 h-px-50 rounded-circle"/>
                      </td>-->
                      <td>
                         Home Section Content 4
                      </td>
                     
                      

                      <td>
                         <a href="{{ route('homeSectionNew4.edit', $sec) }}" class="btn btn-info btn-sm">
                           <i class='bx bx-edit-alt' ></i> Edit
                         </a>


                          <div class="d-inline-block">
                            <form action="{{route('homeSectionNew4.destroy', $sec->id)}}" 
                              method="POST" 
                              >
                              @csrf
                              @method('DELETE')
                               <button type="submit" 
                                    class="btn btn-danger btn-sm Delete" 
                                    style="cursor: pointer;">
                                
                                <i class='bx bxs-trash' ></i> Delete
                              </button>
                            </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @else
                  <td colspan="3" class="text-center">No Banner Added Yet</td>
                @endif
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@include('admin.common.deleteConfirm')

@endsection