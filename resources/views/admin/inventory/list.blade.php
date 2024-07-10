@extends('admin.layout.adminMasterLayout')

@section('title', 'Inventory List')

@section('content')

<div class="content-wrapper">



    <div>
        <a href="{{ route('inventory.create') }}" class="btn btn-primary font-weight-bold mb-3">+ Add New Entry</a>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Inventory List</h3>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-striped FAQ_LIST <?php echo count($inventories)?'dataTable':'';?>">
                            <thead>
                                <tr>
<th>Action</th>
                                    <th>SKU</th>
                                  <th>Product Name</th>
                                       <th>Product Size</th>
                                    {{--<th>Quantity</th>--}}
                                    <th>Current Stock</th>
                                    <th>Purchase Date</th>
                                    <th>Purchase Unit Price</th>
                                    <th>Total Purchase Price</th>
                                    <th>Total Stock in Inventory</th>
                                    <th>Status</th>
                                    <th>Created On</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($inventories as $inventory)
                                @php
                                $qty=0;
                                $prods= App\Models\Inventory::where('product_id',$inventory->product_id)->get();
                                foreach( $prods as $prod){

                                $qty+=$prod->stock;


                                }
                                @endphp

                                <tr data-index="{{ $inventory->id }}">
                                      <td>
                                        <a href="{{ route('inventory.edit', $inventory) }}" class="btn btn-info btn-sm">
                                            <i class='bx bx-edit-alt'></i>
                                        </a>

                                        <div class="d-inline-block">
                                            <form action="{{route('inventory.destroy', $inventory->id)}}" method="POST">
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
                                        {{  $inventory->product->sku ?? ''}}
                                    </td>
                                    <td>
                                        {{  $inventory->product->name  ??''}}
                                    </td>
                                   <td>
                                        {{  $inventory->product_size->size ??'' }}
                                    </td>
                                   {{-- <td>
                                        {{  $inventory->quantity ??''}}
                                    </td>--}}
                                    <td>{{$inventory->stock ??''}}
                                        <!-- <p style="display:grid; grid-template-columns:25% 50% 25%; grid-gap:5px">

                                            <button class="decrease{{$inventory->id}}" id="d-{{$inventory->id}}"
                                                onclick="decrement()" data-id="{{$inventory->id}}"
                                                data-product="{{ $inventory->id }}"
                                                style="background:#696cff; border:none; border-radius:2px; color:#fff">-</button>

                                            <input class="quantity" id="demoInput" type="number"
                                                value="{{$inventory->stock}}" min=1 max=1000>

                                            <button class="increase{{$inventory->id}}" id="i-{{$inventory->id}}"
                                                onclick="increment()" data-product="{{ $inventory->id }}"
                                                data-id="{{$inventory->id}}"
                                                style="background:#696cff; border:none; border-radius:2px;color:#fff">+</button>


                                        </p> -->
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($inventory->po_date)->format('d/m/Y')}}
                                    </td>

                                    <td>
                                        &#x20B9; {{$inventory->po_price ?? ''}}
                                    </td>

                                    <td>
                                        &#x20B9; {{$inventory->po_price * $inventory->quantity ?? ''}}
                                    </td>
                                    <td>
                                        {{$qty ?? ""}}
                                    </td>
                                    <td>
                                        <div class="dropdown action-label">
                                            <a class="btn @if(isset($inventory->status) && ($inventory->status=='1')) btn-primary @else btn-danger @endif  dropdown-toggle btn-sm text-white"
                                                data-bs-toggle="dropdown" aria-expanded="false">

                                                <?=(isset($inventory->status) && $inventory->status=='1')?'<i class="fa fa-dot-circle-o text-success"></i> Active':'<i class="fa fa-dot-circle-o text-danger"></i> Inactive';?>

                                                <span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <form action="{{route('inventory.status', $inventory->id)}}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item status-btn btn-sm"
                                                        style="cursor: pointer;">

                                                        {!! ($inventory->status=='1')? "<i
                                                            class='fa fa-dot-circle-o text-danger'></i> Inactive":"<i
                                                            class='fa fa-dot-circle-o text-success'></i> Active" !!}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>




                                    <td>
                                        {{ \Carbon\Carbon::parse($inventory->created_at)->format('d/m/Y')}}
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