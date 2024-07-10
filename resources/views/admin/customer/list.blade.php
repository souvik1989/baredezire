@extends('admin.layout.adminMasterLayout')

@section('title', 'Customer List')

@section('content')

<div class="content-wrapper">



    <!-- <div>
        <a href="{{ route('inventory.create') }}" class="btn btn-primary font-weight-bold mb-3">+ Add New Entry</a>
    </div> -->

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Customer List</h3>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped FAQ_LIST <?php echo count($users)?'dataTable':'';?>">
                            <thead>
                                <tr>

                                    <th>Action</th>
                                    <th> Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                   
                                   
                                    <th>Email Verified or Not</th>
                                    <!-- <th>Status</th> -->
                                    <th>Created On</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($users as $user)
                               

                                <tr data-index="{{ $user->id }}">
  <td>
                                        <a href="{{ route('customer.edit', $user) }}" class="btn btn-info btn-sm">
                                            <i class='bx bx-show'></i>
                                        </a>

                                        <div class="d-inline-block">
                                            <form action="{{route('customer.destroy', $user->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm Delete"
                                                    style="cursor: pointer;">

                                                    <i class='bx bxs-trash'></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                   
                                    <td>
                                        {{  $user->name }}
                                    </td>
                                    <td>
                                        {{  $user->email }}
                                    </td>
                                    <td>{{$user->phone}}
                                      
                                    </td>
                                    <td>{{$user->is_email_verified==0 ?'No':'Yes'}}
                                      
                                    </td>
                                   




                                    <td>
                                        {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')}}
                                    </td>
                                  
                                </tr>
                                @empty
                                <td colspan="10" class="text-center">Nothing is Listed Yet</td>
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
function increment() {
    document.getElementById('demoInput').stepUp();
}

function decrement() {
    document.getElementById('demoInput').stepDown();
}
</script>

@endsection