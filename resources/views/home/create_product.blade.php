@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novo produto!</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="form-product">
                        <form action="{{route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label for="imageProduct">Image:</label>
                                <input type="file" name="image" id="imageProduct" class="form-control">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlInput1">Nome:</label>
                                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Camisa de futebol">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleFormControlInput1">Quantidade:</label>
                                    <input type="number" name="quantity" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Camisa de futebol">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Preço:</label>
                                <input type="text" name="cost" class="cost form-control" id="exampleFormControlInput1"
                                    placeholder="Camisa de futebol">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Descrição:</label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Publicar</button>


                        </form>

                        <script>
                            $(document).ready(function(){
                             $('.cost').mask("#.##0,00", {reverse: true});
                            })
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
