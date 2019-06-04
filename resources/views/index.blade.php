@extends('layouts.default')
@section('body')


    @if(isset($products) && count($products) > 0)

    @if(isset($search) && $search) 
    <h3>Olha só o que encontramos...</h3>
    @endif
<div class="row">

    @foreach ($products as $p)

    <div class="col-md-3" style="padding:10px;">
        
            <div class="card">
                    <a href="/product/{{$p->id}}">
                <img src="{{asset('img/product_images/'.$p->image)}}" class="card-img-top"
                    style="height:200px;width:100%;" alt="{{$p->name}}">
                    </a>

                <div class="card-body">
                    <h5 class="card-title"><a href="/product/{{$p->id}}">{{$p->name}}</a></h5>

                    <p class="card-text">{{$p->description}}</p>

                    <span class="card-link">R$ {{ number_format($p->cost, 2, ',', '.') }}</span>

                </div>
            </div>

        </a>
    </div>

    @endforeach

    @else
    <center>
        <h3>Nenhum produto =(</h3>
    </center>
    @endif
</div>

@endsection
