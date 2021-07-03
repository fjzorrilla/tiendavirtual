@extends('backend.layouts.master')

@section('title','Detalle de Pedidos') 

@section('main-content')

    <div class="container">
        <!-- Full Calendar -->
        <div id="app-calendar">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="padding: 35px;">
                        <div class="card-content">
                            <h4 class="card-title mb-5">
                                Días Para envios
                            </h4>
                            <div class="row">
                                <div class="col-md-2">
                                    <div id='external-events'>
                                        <h5>Bloquear Día</h5>
                                        <p style="color: #ff4081;">Arrastre <strong style="color: red;">Bloquear</strong> la tarjeta al día que desea bloquear.</p>
                                        <div class="fc-events-container mb-5">
                                            <div class='fc-event' data-color='#ff4081' style="text-align: center;margin-top: 25px;cursor: pointer;">Bloquear</div>
                                            <div class='fc-event' data-color='#5bff95' style="text-align: center;margin-top: 25px;cursor: pointer;">Liberar Domingo</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id='fc-external-drag'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- START RIGHT SIDEBAR NAV -->
    </div>
@endsection