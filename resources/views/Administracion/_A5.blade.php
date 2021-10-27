{{-- Descripcion del Cliente (izq) --}}
<div class="absolute" style="left: 26mm; top: 25mm;">{{ $factura->emision }}</div>
<div class="absolute" style="left: 26mm; top: 30mm;">{{ $factura->cliente->full_name }}</div>
<div class="absolute" style="left: 26mm; top: 35mm;">{{ $factura->cliente->contacto->direccion }}</div>

{{-- Descripcion del Cliente (der) --}}
<div class="absolute" style="left: 143mm; top: 30mm;">{{ $factura->cliente->empresa->ruc }}</div>
<div class="absolute" style="left: 143mm; top: 35mm;">{{ $factura->cliente->contacto->telefono ?? '' }}</div>

{{-- Productos --}}
<table class="absolute productos_a5">
  <tbody class="table table-borderless ">
    @foreach ($factura->productos as $item)
      <tr>
        <td class="p-0" style="width: 12mm; text-align: center;">
          {{ $item->cantidad }}
        </td>
        <td class="p-0" style="width: 133mm">
          {{ $item->detalle }}
        </td>
        <td class="p-0" style="width: 24mm; text-align: right;">
          {{ $item->valor_unitario }}</td>
        <td class="p-0" style="width: 21mm; text-align: right;">
          {{ $item->subtotal }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{-- Totales --}}
<div class="absolute total_a5" style="top: 120mm">{{ $factura->subtotal }}</div>
<div class="absolute total_a5" style="top: 125mm">{{ $factura->iva0 }}</div>
<div class="absolute total_a5" style="top: 130mm">{{ $factura->iva }}</div>
<div class="absolute total_a5" style="top: 135mm">{{ $factura->total }}</div>

{{-- FIRMA --}}
<div class="absolute firma_a5">{{ $factura->usuario->nomina->full_name }}</div>
