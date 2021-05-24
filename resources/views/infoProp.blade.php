<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <title> House | UniRent</title>
    <link rel="shortcut icon" type="image/jpg" href="img/logo/UniRent-V2.png" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="/JS/scripts.js"></script>
    <script src="/JS/mapsAPI.js"></script>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
        <div class="container">
        <a class="navbar-brand" href="/senhorio/home">
        <img src="/img/logo/UniRent-V2.png" alt="" width="100">
      </a>
      <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="mx-auto"></div>
        <ul class="navbar-nav">
        <li class="nav-item">
                        <a class="nav-link text-black text-end" href="/senhorio/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black text-end" href="/senhorio/wallet">Wallet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black text-end" href="#">Sign Out</a>
                    </li>
        </ul>
            </div>
        </div>
    </nav>
    

    <!-- END Nav bar -->
    
    <div class="banner-image d-flex justify-content-center align-items-center pt-5">
        <div class="container profile-container m-5">
            <div class="row p-3 profile-container" id="parteCima">
                <div class="col align-middle" id="dataCasa">
                    <div class="row d-flex justify-content-center" id="dataCasa__imagens">
                        <img class="img-fluid mt-2" id="imgCasa" src="/img/room1.jpg"
                            style="max-width: 700px; width:100%;  border-radius: 50px !important;">
                            
                        @foreach($property as $propInfo) 

                        <div class=" px-3 pt-3 profile-container text-center">
                            <h2>Morada</h2>
                            <h3 id="morada">
                                Morada
                            </h3>
                                <br>
                            <h2>Preço</h2>
                            {{$propInfo['Preco']}}€/Mês                      
                            <h3>
                            </h3>
                        </div>
  
                            <div class="star-icon d-flex justify-content-center">
                                <label >Rating: </label> <h3 id="totalAVGrating"><b id="valorRate">{{$avgStar}}</b> </h3><i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i>
                            </div>
                    </div>
                </div>
                
                <div class="col" id="infoCasa">
                    <div class="row infoCasa__Border m-3">
                        <h1 class="infoCasa__Preco text-center p-3">
                            {{$propInfo['TipoPropriedade']}}&nbsp;&nbsp;&nbsp;&nbsp;
                            <button id="botaoDelete" type="button" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
</svg></button>

<a href="/propriedade/edit/{{$propInfo['IdPropriedade']}}" type="button" class="btn btn-info btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
</svg></a>
</h1>
                        
                    </div>

                    <div class="row infoCasa__Border m-3 profile-container">
                        <div class="form-group col-md-5">
                            <h2>Localização:</h2>
                            <p>{{$propInfo['Localizacao']}}</p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Descrição: </h2>
                            <p>{{$propInfo['Descricao']}}</p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Área: </h2>
                            <p>{{$propInfo['AreaMetros']}} m2</p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Orientação Solar</h2>
                            <p>
                            @if(($propInfo['OrientacaoSolar']) == "N" || ($propInfo['OrientacaoSolar']) == "Norte")
                                Norte
                            @elseif(($propInfo['OrientacaoSolar']) == "S" || ($propInfo['OrientacaoSolar']) == "Sul")
                                Sul
                            @elseif(($propInfo['OrientacaoSolar']) == "E" || ($propInfo['OrientacaoSolar']) == "Este")
                                Este
                            @elseif(($propInfo['OrientacaoSolar']) == "O" || ($propInfo['OrientacaoSolar']) == "Oeste")
                                Oeste
                            @endif                          
                            </p>

                        </div>
                        <div class="form-group col-md-5">
                            <h2>Número de quartos: </h2>
                            <p>{{$propInfo['NumeroQuartos']}}
                            @if(($propInfo['NumeroQuartos']) == 1)
                                quarto
                            @else
                                quartos
                            @endif
                            </p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Casas de banho: </h2>
                            <p>{{$propInfo['CasasBanho']}}</p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Estado do alojamento: </h2>
                            <p>{{$propInfo['EstadoConservacao']}}</p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Lotação: </h2>
                            <p>{{$propInfo['Lotacao']}}</p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Acesso à internet: </h2>
                            <p>
                            @if ($propInfo['internetAcess']==1)
                                Sim
                            @else
                                Não 
                            @endif    
                            </p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Limpeza Incluida: </h2>
                            <p>
                            @if ($propInfo['limpeza']==1)
                                Sim
                            @else
                                Não 
                            @endif       
                            </p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Idades Permitidas: </h2>
                            <p>{{$propInfo['faixaEtariaMin']}} - {{$propInfo['faixaEtariaMax']}} </p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Sexos Aceites: </h2>
                            <p>
                            @if (($propInfo['generoMasc']==1) && ($propInfo['generoFemin']==1))
                            Todos
                            @elseif (($propInfo['generoMasc']==0) && ($propInfo['generoFemin']==0))
                            Nenhum
                            @elseif ($propInfo['generoMasc']==1)
                            Apenas Homens
                            @else
                            Apenas Mulheres
                            @endif
                            </p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Permitido Fumar: </h2>
                            <p>
                            @if ($propInfo['aceitaFumadores']==1)
                                Sim
                            @else
                                Não 
                            @endif
                        </p>
                        </div>
                        <div class="form-group col-md-5">
                            <h2>Aceita Animais: </h2>                           
                            <p>
                                @if ($propInfo['aceitaAnimais']==1)
                                Sim
                            @else
                                Não 
                            @endif</p>
                        </div>


                    </div>
                </div>

            <div class="d-flex flex-row justify-content-start">

            </div>

            </div>


            <div class="row p-3 profile-container" id="parteBaixo">
                <div class="col">
                    <div class="p-3">
                        <h1>Localização</h1>
                    </div>
                    <div class="p-3 d-flex justify-content-center">
                        <div id="map"></div>

                        
                    </div>

                    <h1>Disponibilidade<h1>
                    <div class="container">
    <div class="row">
    @for ($i = 0; $i < 12; $i++)
        <div class="col-lg-2 col-md-3 col-xs-6 ">        
            <div class="box">
                <h2 align="center">{{ $data->format('F,Y') }}</h2>
                <div id="boxInfo{{$i}}" align="center">
                <script>
                document.getElementById("boxInfo{{$i}}").innerHTML = 
                "<h3><br>Disponivel<h3>" +
                "<form action='/disponiveis/add/{{ $property[0]['IdPropriedade'] }}' name='_method' method='POST'>" +
                "<input type='text' name='Mes' value={{ $data->format('m-y') }} hidden>" +
                "<button type='submit' class='btn btn-primary btn-sm'>Tornar Indisponivel</button></form>"
                </script>
                    @foreach ($arrendamentos as $arrendamento)
                        @if ($arrendamento['MesContrato']==$data->format('m-y'))
                        <script>
                        document.getElementById("boxInfo{{$i}}").innerHTML =
                        "<br><h3>Alugado</h3><h3>InquilinoId: {{ $arrendamento['IdInquilino']}}</h3>" +
                        "<h3><a href='/propriedade/fatura/{{$arrendamento['IdArrendamento']}}'>Recibo</a></h3>"
                        </script>        
                            @php
                            $totalPago = 0;
                            @endphp
                            @foreach ($pagamentos as $pagamentos1)
                                @foreach ($pagamentos1 as $pagamento)
                                    @if ($pagamento['IdArrendamento'] == $arrendamento['IdArrendamento'])
                                    @php
                                    $totalPago = $pagamento['Valor'] + $totalPago;
                                    @endphp                                    
                                    @endif
                                @endforeach
                            @endforeach
    
                            @if ($totalPago==$propInfo['Preco'])
                            <script>
                            document.getElementById("boxInfo{{$i}}").innerHTML += 
                            "<h3>Pago</h3>"
                            </script>
                            @else
                            <script>
                            document.getElementById("boxInfo{{$i}}").innerHTML += 
                            "<h3>Pago: {{ $totalPago }}€</h3>" +
                            "<h3>Falta: {{ $propInfo['Preco'] - $totalPago }}€</h3>"
                            </script>
                            @endif
                        @endif 
                    @endforeach
                    @foreach ($indisponiveis as $indisponivel)
                        @if ($indisponivel['Mes']==$data->format('m-y'))
                        <script>
                        document.getElementById("boxInfo{{$i}}").innerHTML =
                        "<br><h3>Indisponivel</h3>" +
                        "<form action='/disponiveis/delete/{{$indisponivel['Id']}}' name='_method' method='POST'>" +
                        "<input type='hidden' name='_method' value='DELETE'>" +
                        "<button type='submit' class='btn btn-danger btn-sm'>Tornar Disponivel</button></form>"
                        </script>
                        @endif
                    @endforeach        
                </div>
            </div>
        </div>
        <p hidden>{{ $data->addMonths(1) }}</p>
    @endfor
        </div></div>
                    <script>
                        function initMap() {
                        const map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 14,
                            center: { lat: {{ $propInfo['Latitude'] }}, lng: {{ $propInfo['Longitude'] }} },
                        });
                        new google.maps.Marker({
                        position: map['center'],
                        map,
                        title: "Hello World!",
                        });
                        const geocoder = new google.maps.Geocoder();
                        const latlng = {
                            lat: {{ $propInfo['Latitude'] }},
                            lng: {{ $propInfo['Longitude'] }},
                        };
                        geocoder.geocode({ location: latlng }, (results, status) => {
                            if (status === "OK") {
                            if (results[0]) {
                                document.getElementById("morada").innerHTML = results[0].formatted_address;
                                }
                             else {
                                window.alert("No results found");
                            }
                            } else {
                            window.alert("Geocoder failed due to: " + status);
                            }
                        });
                        }
                        
                    </script>
                </div>
            </div>
        </div>
    </div>
    
    </div>
    </div>
    @endforeach
</body>