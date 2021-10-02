@extends('layouts.factura')

@section('content')
  <button onClick="imprimir()" style="width: 5%; position: fixed; top 0; left: 0;" id="printer"><em
      class="fa fa-print"></em></button>

  <div class="check">{{ $factura->numero }}</div>

  {{-- Datos del cliente --}}
  <div class="cliizq pto9">
    <table id="cliizq">
      <tr>
        <td class="adjust php colorblack colorblack">{{ $factura->cliente->full_name }}</td>
      </tr>
      <tr>
        <td class="adjust php colorblack">{{ $factura->atencion }}</td>
      </tr>
      <tr>
        <td class="adjust php colorblack">{{ $factura->ruc }}</td>
      </tr>
      <tr>
        <td class="adjust php colorblack">{{ $factura->telefono }}</td>
      </tr>
      <tr>
        <td class="adjust php colorblack">{{ $factura->direccion }}</td>
      </tr>
    </table>
  </div>

  <div class="check pto9 bold">{{ $factura->check }}</div>

  <div class="clider pto9">
    <table id="clider">
      <tr>
        <td class="adjust php colorblack">{{ $factura->fecha }}</td>
      </tr>
      <tr>
        <td class="adjust php colorblack">{{ $factura->pago }}</td>
      </tr>
      <tr>
        <td class="adjust php colorblack">{{ $factura->ots }}</td>
      </tr>
    </table>
  </div>


  {{-- Productos --}}
  <div class="productos">
    <table id="prodtab">
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
  </div>

  <div class="totales">
    <table style="text-align: right" id="totales">
      <tr class="pto8">
        <td style="width: 7mm"></td>
        <td style="width: 33mm" class="bold rightpad colorblack" style="border-bottom: none">{{ $factura->subtotal }}
        </td>
      </tr>
      <tr class="pto8 bold">
        <td></td>
        <td class="rightpad colorblack" style="border-bottom: none; border-top: none">{{ $factura->descuento }}</td>
      </tr>
      <tr class="pto8 bold">
        <td style="border-left: none; border-bottom: none; border-top: none; text-align: center">{{ $factura->ivap }}
        </td>
        <td class="rightpad colorblack" style="border-bottom: none; border-top: none">{{ $factura->iva }}</td>
      </tr>
      <tr class="pto8 bold">
        <td></td>
        <td class="rightpad colorblack" style="border-bottom: none; border-top: none">{{ $factura->iva0 }}</td>
      </tr>
      <tr class="pto8 bold">
        <td></td>
        <td class="rightpad colorblack" style="border-top: none">{{ $factura->total }}</td>
      </tr>
    </table>
  </div>

  <div class="son">{{ numtowords($total) }}</div>

  <!-- DEBO Y PAGARE -->
  <div class="debo pto8">
    {{ numtowords($total) }}
  </div>

  <!-- FIRMA -->
  <div style="text-align: center" class="firma colorblack pto9">{{ $factura->por }}</div>

  <script>
    // funcion de impresion
    function imprimir() {
      var reiniciarpagina = document.body.innerHTML;
      var printer = document.getElementById('printer');
      printer.style.display = 'none';
      window.print();
      document.body.innerHTML = reiniciarpagina;
    }
  </script>
@endsection
