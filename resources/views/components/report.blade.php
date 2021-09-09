<div class="col-12 col-md-3">
  <h5 class="text-center">{{ $title }}</h5>
  <h5 class="text-center font-weight-bold">$ {{ number_format($items->sum('totalData'), 2) }}</h5>
  <table class="table table-responsive table-striped table-sm" style="font-size: 12px;">
    <tbody class="tableitems">
      @foreach ($items as $item)
      <tr class="tableitems">
        <td class="text-left">{{ $item->nombre }}</td>
        <td class="text-right">{{ $item->totalData }}</td>
      </tr>
      @endforeach
    </tbody>

    <tfoot class="text-right font-weight-bold">
      <tr>
        <td>Total $</td>
        <td>{{ number_format($items->sum('totalData'), 2) }}</td>
      </tr>
    </tfoot>
  </table>
</div>
