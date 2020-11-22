@extends('layouts.app')

@section('desktop-content')
<div class="container">
    <x-path 
        :items="[
            [
                'text' => 'Pedidos',
                'current' => true,
                'href' => '#',
                ]
            ]"
    />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Desktop</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Haz entrado!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection