@extends('layouts.factura')

@section('content')

  @php

  @endphp

  <div class="absolute" style="left: 159mm; top: 28mm; font-size: 14pt;">{{ $factura->numero }}</div>

  {{-- Descripcion del Cliente (izq) --}}
  <div class="absolute font-weight-bold" style="left: 34mm; top: 45mm">{{ $factura->cliente->empresa->nombre }}</div>
  <div class="absolute" style="left: 34mm; top: 50mm"><small>{{ $factura->cliente->full_name }}</small></div>
  <div class="absolute" style="left: 34mm; top: 55mm">{{ $factura->cliente->empresa->ruc }}</div>
  <div class="absolute" style="left: 34mm; top: 60mm"><small>{{ $factura->cliente->contacto->movil }}</small></div>
  <div class="absolute" style="left: 34mm; top: 65mm"><small>{{ $factura->cliente->contacto->direccion }}</small>
  </div>

  {{-- Descripcion del Cliente (der) --}}
  <div class="absolute" style="left: 142mm; top: 45mm">{{ $factura->emision }}</div>
  <div class="absolute" style="left: 142mm; top: 55mm">{{ $factura->emision }}</div>
  <div class="absolute" style="left: 142mm; top: 60mm">{{ config('factura.tipo_pago')[$factura->tipo_pago] }}</div>
  <div class="absolute" style="left: 142mm; top: 65mm">{{ $factura->pedidos->count() ? $factura->pedidos : '' }}
  </div>


  {{-- Productos --}}
  <table class="absolute productos">
    <tbody class="colorblack">
      @foreach ($factura->productos as $item)
        <tr>
          <td class="leftpad" style="border-bottom:none; border-top: none; width: 14mm">
            {{ $item->cantidad }}
          </td>
          <td class="leftpad" style="border-bottom:none; border-top: none; width: 114mm">
            {{ $item->detalle }}
          </td>
          <td class="rightpad" style="border-bottom:none; border-top: none; width: 29mm">
            {{ $item->valorunitario }}</td>
          <td class="rightpad" style="border-bottom:none; border-top: none; width: 29mm">
            {{ $item->subtotal }}
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{-- Totales --}}
  <div class="absolute total" style="left: 163mm; top: 198mm">{{ $factura->iva_p }}</div>
  <div class="absolute total" style="top: 188mm">{{ $factura->subtotal }}</div>
  <div class="absolute total" style="top: 193mm">{{ $factura->descuento }}</div>
  <div class="absolute total" style="top: 198mm">{{ $factura->iva }}</div>
  <div class="absolute total" style="top: 203mm">{{ $factura->iva0 }}</div>
  <div class="absolute total" style="top: 208mm">{{ $factura->total }}</div>

  <div class="absolute son">{{ $total }}</div>

  <!-- DEBO Y PAGARE -->
  <div class="absolute debo">{{ $total }}</div>

  <!-- FIRMA -->
  <div class="absolute firma">{{ $factura->usuario->nomina->full_name }}</div>
@endsection
