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