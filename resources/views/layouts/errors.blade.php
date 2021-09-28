<div class="errorDiv" id="errorDiv">
  @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show errorAlert" role="alert">
      {{ $error }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endforeach
</div>

@if ($errors->any())
  @push('component-script')
    <script>
      $(".alert").fadeTo(10000, 0.5).slideUp(8000);
    </script>
  @endpush
@endif
