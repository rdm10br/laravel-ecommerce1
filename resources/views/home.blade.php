@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                                Bem vindo {{auth::user()->name}}.
                    @if(auth::user()->role > 0)
                    <div class="form-group">
                        <a href="/product/create">Novo produto</a>
                    </div>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
