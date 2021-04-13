@extends('backend.layouts.master')

@section('title','Detalle de Pedidos')

@section('main-content')
<div class="card">
<h5 class="card-header">Pedidos       <a href="{{route('order.pdf',$order->id)}}" class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i> Generate PDF</a>
  </h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      @php
          $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
      @endphp
      <thead>
        <tr>
            <th>S.N.</th>
              <th>N° Pedidos</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Cantidad</th>
              <th>Cargo</th>
              <th>Total Monto</th>
              <th>Estatus</th>
              <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->quantity}}</td>
            <td>@foreach($shipping_charge as $data) $ {{number_format($data,2)}} @endforeach</td>
            <td>${{number_format($order->total_amount,2)}}</td>
            <td>
                @if($order->status=='new')
                  <span class="badge badge-primary">Nuevo</span>
                @elseif($order->status=='process')
                  <span class="badge badge-warning">En Proceso</span>
                @elseif($order->status=='delivered')
                  <span class="badge badge-success">Delivery</span>
                @else
                  <span class="badge badge-danger">Cancelado</span>
                @endif
            </td>
            <td>
                <a href="{{route('order.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Editar" data-placement="bottom"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>

        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">INFORMACIÓN DEL PEDIDO</h4>
              <table class="table">
                    <tr class="">
                        <td>Numero de Pedido</td>
                        <td> : {{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td>Fecha de Pedido</td>
                        <td> : {{$order->created_at->format('D d M, Y')}} at {{$order->created_at->format('g : i a')}} </td>
                    </tr>
                    <tr>
                        <td>Cantidad de Pedido</td>
                        <td> : {{$order->quantity}}</td>
                    </tr>
                    <tr>
                        <td>Estatus del Pedido</td>
                        <td> : {{$order->status}}</td>
                    </tr>
                    <tr>
                      @php
                          $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                      @endphp
                        <td>Costo de envío</td>
                        <td> : $ {{number_format($shipping_charge[0],2)}}</td>
                    </tr>
                    <tr>
                      <td>Cupón</td>
                      <td> : $ {{number_format($order->coupon,2)}}</td>
                    </tr>
                    <tr>
                        <td>Total Monto</td>
                        <td> : $ {{number_format($order->total_amount,2)}}</td>
                    </tr>
                    <tr>
                        <td>Payment Method</td>
                        <td> : @if($order->payment_method=='cod') Cash on Delivery @else Paypal @endif</td>
                    </tr>
                    <tr>
                        <td>Payment Status</td>
                        <td> : {{$order->payment_status}}</td>
                    </tr>
              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
            <div class="shipping-info">
              <h4 class="text-center pb-4">INFORMACIÓN DE ENVÍO</h4>
              <table class="table">
                    <tr class="">
                        <td>Nombres y Apellidos</td>
                        <td> : {{$order->first_name}} {{$order->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Correo</td>
                        <td> : {{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>N° Telefono </td>
                        <td> : {{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>Dirección</td>
                        <td> : {{$order->address1}}, {{$order->address2}}</td>
                    </tr>
                    <tr>
                        <td>Pais</td>
                        <td> : {{$order->country}}</td>
                    </tr>
                    <tr>
                        <td>Código Postal</td>
                        <td> : {{$order->post_code}}</td>
                    </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif

  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush