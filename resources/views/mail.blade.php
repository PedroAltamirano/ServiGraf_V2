@extends('layouts.app')

@section('desktop-content')
<div class="m-2 m-md-3 w-auto h-100">
  <iframe src="{{ session('userInfo.mail') }}" width="100%" height="100%" frameborder="0"></iframe>
</div>
@endsection

@section('scripts')
@endsection
