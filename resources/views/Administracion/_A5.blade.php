<table cellpadding="0" cellspacing="0" style="min-width: 190mm; max-width: 190mm">
  <!-- header -->
  <tr style="height: 21mm; width: 190mm">
    <td style="width: 12mm"></td>
    <td style="width: 5mm"></td>
    <td style="width: 47mm"></td>
    <td style="width: 45mm"></td>
    <td style="width: 27mm"></td>
    <td style="width: 10mm"></td>
    <td style="width: 22mm"></td>
    <td style="width: 22mm"></td>
  </tr>
  <!-- fecha -->
  <tr class="pto9" style="height: 5mm">
    <td class="leftpad" colspan="2"></td>
    <td class="leftpad" colspan="2">{{ $factura->emision }}</td>
    <td colspan="4"></td>
  </tr>
  <!-- cleinte y ruc -->
  <tr class="pto9" style="height: 5mm">
    <td class="leftpad" colspan="2"></td>
    <td class="leftpad" colspan="2">{{ $factura->cliente->full_name }}</td>
    <td class="leftpad"></td>
    <td class="leftpad" colspan="3">{{ $factura->cliente->empresa->ruc }}</td>
  </tr>
  <!-- dirrc y telf -->
  <tr class="pto9" style="height: 8mm; vertical-align: text-top;">
    <td class="leftpad" colspan="2" style="padding-top: 3px"></td>
    <td class="leftpad" colspan="2" style="padding-top: 3px">{{ $factura->cliente->contacto->direccion }}</td>
    <td class="leftpad" style="padding-top: 3px"></td>
    <td class="leftpad" colspan="3" style="padding-top: 3px">{{ $factura->cliente->contacto->telefono }}</td>
  </tr>
  <!-- content header -->
  <tr style="height: 6mm">
    <td colspan="8"></td>
  </tr>

  <tbody class="colorblack" style="min-height: 64mm; max-height: 64mm">
    @foreach ($factura->productos as $item)
      <tr style="height: 6mm">
        <td class="leftpad pto8" style="border-bottom:none; border-top: none">{{ $item->cantidad }}</td>
        <td class="leftpad pto8" style="border-bottom:none; border-top: none" colspan="5">
          {{ $item->detalle }}</td>
        <td class="rightpad pto8" style="border-bottom:none; border-top: none">{{ $item->valorunitario }}
        </td>
        <td class="rightpad pto8" style="border-bottom:none; border-top: none">{{ $item->subtotal }}</td>
      </tr>
    @endforeach
  </tbody>

  <!-- forma de pago -->
  <tr class="pto8" style="height: 9mm">
    <td colspan="8"></td>
  </tr>
  <!-- subtotal -->
  <tr class="pto8" style="height: 5mm">
    <td colspan="7"></td>
    <td class="rightpad">{{ $factura->subtotal }}</td>
  </tr>
  <!-- firma e iva0 -->
  <tr class="pto8" style="height: 5mm">
    <td colspan="7"></td>
    <td class="rightpad">{{ $factura->iva_0 }}</td>
  </tr>
  <!-- iva12 -->
  <tr class="pto8" style="height: 5mm">
    <td colspan="7"></td>
    <td class="rightpad">{{ $factura->iva }}</td>
  </tr>
  <!-- total -->
  <tr class="pto8" style="height: 5mm">
    <td class="leftpad" colspan="3">{{ $factura->usuario->nomina->full_name }}</td>
    <td colspan="4"></td>
    <td class="rightpad">{{ $factura->total }}</td>
  </tr>
</table>
