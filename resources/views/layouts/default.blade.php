<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Arkham Shop</title>
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="{{asset('js/jquery.mask.min.js')}}"></script>
</head>

<body id="corpo">

        @if(session('error') || session('success'))
        <script>
          $(function(){
            $('#warningToast').toast({delay:5000});
            $('#warningToast').toast('show');
          });
        </script>
        <div aria-live="polite" aria-atomic="true" style="z-index:9999999;position: fixed; top: 5em; right: 20px;min-height:200px;" >
          <div class="toast" id="warningToast">
          <div class="toast-header {{session('error') ? 'bg-warning' : 'bg-success'}}">
                <i class="{{session('error') ? 'fa fa-exclamation-circle' : 'fa fa-check-double'}}"></i>
              <strong class="mr-auto">&nbsp;&nbsp;{{session('error') ? 'Ops!' : 'Sucesso!'}}</strong>        
              <small>Agora</small>
              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="toast-body" style="color:#212529;">
              {{session('error') ? session('error') : session('success')}}
            </div>
          </div>
        </div>
        @endif

        <nav class="navbar navbar-expand-md navbar-dark navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="/">Arkham Shop</a>
                <div class="collapse navbar-collapse" id="navbarResponsivo">
                  <ul class="navbar-nav ml-auto">
                    
                    <li class="nav-item">

                        @if(!auth::check())

                      <div class="dropdown show">
                        <a class="btn btn-custom nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Login / Registro</a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <form class="py-3 px-2" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <label for="email"> Email </label>
                              <input type="email" class="form-control" id="username" name="email" placeholder="email@emeplo.com">
                            </div>
                        <div class="form-group">
                          <label for="password"> Password </label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dropdownCheck">
                            <label class="form-check-label" for="dropdownCheck">
                              Lembrar de mim
                            </label>
                          </div>

                        <div class="botao" >
                        <button id='submit01' type="submit" class="btn btn-custom">Logar</button>
                        </div>
                    </form>
                    
                       
                        <div class="dropdown-divider"></div>
                        <div class="itens">
                        <a class="dropdown-item" href="/register">Não é cadastrado? Cadastre-se aqui!</a>
                        <a class="dropdown-item" href="#">Esqueceu sua senha?</a>
                        </div>
                      </div>
                      </form>
                      </div>

                      @else

                      <a class="nav-link" href="/home">Minha conta</a>


                      @endif
                    </li>


                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">{{ Session::has('cart') ? '['.count(Session::get('cart')).']' : '[0]' }} Carrinho</a>
                        
                    <div class="dropdown-menu" style="padding:10px;" aria-labelledby="dropdownMenuLink">
                           
                        <table class="table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Custo</th>
                                    <th><a href="/cleanAllCart">Limpar</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Session::has('cart'))
                              @php
                                  $costTotal = 0;
                              @endphp
                                @foreach (Session::get('cart') as $c)     

                                <tr>
                                    <td>{{getProductNameById($c['id'])}}</td>
                                    <td>{{$c['quantity']}}</td>
                                    <td>R$ {{ number_format($c['totalCost'], 2, ',', '.')}}</td>
                                <td>
                                  <a href="/removeToCart/{{$c['id']}}"><i class="fa fa-minus"></i></a>&nbsp;&nbsp;
                                <a href="/removeProductToCart/{{$c['id']}}"><i class="fa fa-trash"></i></a>
                              </td>
                                </tr>
                                @php
                                    $costTotal += $c['totalCost'];
                                @endphp
                                @endforeach
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td>Total: R$ {{ number_format($costTotal, 2, ',', '.') }}</td>
                                  <td></td>

                                </tr>
                                @else
                                <tr>

                                    <td colspan="4" style="text-align: center;">Nenhum produto =(</td>
                                </tr>
                                @endif

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><button type="button" class="btn btn-success">Checkout</button></td>
                                </tr>
                            </tfoot>

                        </table>
                          </div>

                </li>


                    <li class="nav-item"> 
                        <a class="nav-link btn btn-custom" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> Cadastrar </a>
                    </li>
                  </ul>
                </div>
            </div>
        </nav>

        <!--header-->
        <section class="header">
            <div class="container-fluid">
              <div class="row ml-5 pt-5">
                <div class="logo col-4">
                  <a href="/"><img class="image-logo" src="{{asset('img/logo.png')}}" alt="logo_do_site"> Arkham Shop</a>
        
                </div>
                <div class="col-4 mt-5">
                  <form class="form-inline" action="{{route('search')}}">
                  <input class="form-control" name="s" value="{{ isset($_GET['s']) ? $_GET['s'] : '' }}" id="buscaprinc"  type="search">
                    <button class="btn btn-outline-success text-light my-2 my-sm-0" type="submit">Buscar</button>
                  </form>
                </div>
                <div class="col-3">
                  <a href="carrinho.html"><img src="{{ asset('img/carrinho.png') }}" alt="carrinhocompras" class="carrinho"></a>
                </div>
              </div>
            </div>
          </section>

        <!-- Linha de produtos -->
        <div class="container">
          <div class="row justify-content-center row-custom" id="linhaItens">
            <div class="dropdown show col-1.5 text-light" id="hardware">
              <a class="btn btn-custom nav-link text-light" role="button" id="dropdownMenuHardware" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hardware </a>
              <div class="dropdown-menu dropdown-menu-left" id="bg-custom">
                <form class="py-2 px-2">
                  <div class="form-group">
                    <a class="dropdown-item text-light" href="#"> Coolers </a>
                    <a class="dropdown-item text-light" href="#"> SSD </a>
                    <a class="dropdown-item text-light" href="#"> Placa Mãe </a>
                    <a class="dropdown-item text-light" href="#"> Memórias </a>
                    <a class="dropdown-item text-light" href="#"> Placa de Vídeo </a>
                    <a class="dropdown-item text-light" href="#"> Gabinete </a>
                    <a class="dropdown-item text-light" href="#"> Fonte </a>
                  </div>
                </form>
                </div>
              </div>
            <div class="col-1.5" id="smartphones">
              <a class="btn btn-custom nav-link text-light" role="button" id="dropdownMenuSmartphones" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Smartphones </a>
              <div class="dropdown-menu dropdown-menu-left" id="bg-custom">
                <form class="py-2 px-2">
                  <div class="form-group">
                    <a class="dropdown-item text-light" href="#"> Samsung </a>
                    <a class="dropdown-item text-light" href="#"> Xiaomi </a>
                    <a class="dropdown-item text-light" href="#"> Apple </a>
                    <a class="dropdown-item text-light" href="#"> Motorola </a>
                    <a class="dropdown-item text-light" href="#"> Sony </a>
                    <a class="dropdown-item text-light" href="#"> Alcatel </a>
                    <a class="dropdown-item text-light" href="#"> Lenovo </a>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-1.5" id="perifericos">
              <a class="btn btn-custom nav-link text-light" role="button" id="dropdownMenuPerifericos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Periféricos </a>
              <div class="dropdown-menu dropdown-menu-left" id="bg-custom">
                <form class="py-2 px-2">
                  <div class="form-group">
                    <a class="dropdown-item text-light" href="#"> Acessórios </a>
                    <a class="dropdown-item text-light" href="#"> Pen Drive </a>
                    <a class="dropdown-item text-light" href="#"> Gabinetes </a>
                    <a class="dropdown-item text-light" href="#"> Pen Drive </a>
                    <a class="dropdown-item text-light" href="#"> Mesa Digitalizadora </a>
                    <a class="dropdown-item text-light" href="#"> Som e Acessórios </a>
                    <a class="dropdown-item text-light" href="#"> Cabos </a>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-1.5" id="computadores">
              <a class="btn btn-custom nav-link text-light" role="button" id="dropdownMenuComputadores" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Computadores </a>
              <div class="dropdown-menu dropdown-menu-left" id="bg-custom">
                <form class="py-2 px-2">
                  <div class="form-group">
                    <a class="dropdown-item text-light" href="#"> Computadores </a>
                    <a class="dropdown-item text-light" href="#"> Notebooks/Ultrabooks </a>
                    <a class="dropdown-item text-light" href="#"> Monitores </a>
                    <a class="dropdown-item text-light" href="#"> Tablet's </a>
                    <a class="dropdown-item text-light" href="#"> Impressoras </a>
                    <a class="dropdown-item text-light" href="#"> Scanners </a>
                    <a class="dropdown-item text-light" href="#"> Softwares </a>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-1.5" id="placaDeVideo">
              <a class="btn btn-custom nav-link text-light" role="button" id="dropdownMenuPDVideo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Placa de Vídeo </a>
              <div class="dropdown-menu dropdown-menu-left" id="bg-custom">
                  <form class="py-2 px-2">
                    <div class="form-group">
                      <a class="dropdown-item text-light" href="#"> NVIDIA </a>
                      <a class="dropdown-item text-light" href="#"> AMD/ATI </a>
                      <a class="dropdown-item text-light" href="#"> Acessórios </a>
                    </div>
                  </form>
                </div>
            </div>
            <div class="col-1.5" id="monitores">
              <a class="btn btn-custom nav-link text-light" role="button" id="dropdownMenuMonitores" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Monitores </a>
              <div class="dropdown-menu dropdown-menu-left" id="bg-custom">
                  <form class="py-2 px-2">
                    <div class="form-group">
                      <a class="dropdown-item text-light" href="#"> LCD </a>
                      <a class="dropdown-item text-light" href="#"> LED </a>
                      <a class="dropdown-item text-light" href="#"> LFD (Profissional) </a>
                    </div>
                  </form>
                </div>
            </div>
            <div class="col-1.5" id="tecladoMouse">
              <a class="btn btn-custom nav-link text-light" role="button" id="dropdownMenuTecladoMouse" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Teclado e Mouse </a>
              <div class="dropdown-menu dropdown-menu-left" id="bg-custom">
              <form class="py-2 px-2">
                  <div class="form-group">
                    <a class="dropdown-item text-light" href="#"> Mouse Gamer </a>
                    <a class="dropdown-item text-light" href="#"> Teclado Gamer </a>
                    <a class="dropdown-item text-light" href="#"> Mousepad </a>
                    <a class="dropdown-item text-light" href="#"> Mouse sem Fio </a>
                    <a class="dropdown-item text-light" href="#"> Teclado sem Fio </a>
                    <a class="dropdown-item text-light" href="#"> Teclado com Mouse Gamer </a>
                    <a class="dropdown-item text-light" href="#"> Mouse com Mousepad </a>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-1.5" id="armazenamento">
              <a class="btn btn-custom nav-link text-light" role="button" id="dropdownMenuArmazenamento" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Armazenamento </a>
              <div class="dropdown-menu dropdown-menu-left" id="bg-custom">
              <form class="py-2 px-2">
                  <div class="form-group">
                    <a class="dropdown-item text-light" href="#"> SSD </a>
                    <a class="dropdown-item text-light" href="#"> MICRO SD </a>
                    <a class="dropdown-item text-light" href="#"> HD </a>
                    <a class="dropdown-item text-light" href="#"> Pen Drive </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
 

        <div class="container" style="margin-top:2em;">
            @yield('body')

        </div>


  <footer class="rodape py-3">
    <div class="container">
      <p class="m-0 text-center text-white">&copy; Arkham Shop 2019</p>
        </div>
          <!-- /.container -->
  </footer>
</body>
</html>