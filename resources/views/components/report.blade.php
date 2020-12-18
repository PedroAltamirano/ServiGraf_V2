<div class="col-12 col-md-3">
  <h5 class="text-center">{{ $title }}</h5>
  <h5 class="text-center font-weight-bold">$ {{ $items->sum('totalData') }}</h5>
  <table class="table table-striped table-sm" style="font-size: 12px;">
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
        <td>{{ $items->sum('totalData') }}</td>
      </tr>
    </tfoot>
  </table>
</div>
