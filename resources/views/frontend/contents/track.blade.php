  @extends('frontend.master')
@section('title', "Track your order")
@section('content')

@php
//dd($shipments);
@endphp

@if($shipments['Success'] !== false)
 @foreach ($shipments as $shipmentData) 

@php

//dd($shipmentData[0]['Shipment']['Status']['Status']);
@endphp
            
         <div class="del-body">
           <div class="d-status">
           @if(isset($shipmentData[0]['Shipment']['Status']['Status']))
    Tracking Status: {{ $shipmentData[0]['Shipment']['Status']['Status'] }}
@endif
</div>	
            Tracking Summary: In Transit!
     @if ( $shipmentData[0]['Shipment']['Status']['Status'] !== 'Delivered')
 @if(isset($shipmentData[0]['Shipment']['Status']['Instructions']))
    Tracking Summary: {{ $shipmentData[0]['Shipment']['Status']['Instructions'] }}
@endif
       @if(isset($shipmentData[0]['Shipment']['PromisedDeliveryDate']))
@php

            $expectedDeliveryDate = \Carbon\Carbon::parse($shipmentData[0]['Shipment']['PromisedDeliveryDate'])->format('jS F, Y');
@endphp
<p class="d-date">Expected Delivery Date: {{$expectedDeliveryDate}} </p>
        @endif
@else
 @if($shipmentData[0]['Shipment']['Status']['StatusDateTime'])
@php

            $deliveryDate = \Carbon\Carbon::parse($shipmentData[0]['Shipment']['Status']['StatusDateTime'])->format('jS F, Y');
@endphp
<p class="d-date">Delivered On: {{$deliveryDate}} </p>
        @endif

@endif
           
</div>
@endforeach

@else
 <div class="empty-cart">
                <p>{{$shipments['Error'] }}</p>
            </div>
@endif

@endsection