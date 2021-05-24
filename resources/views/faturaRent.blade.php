<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <title>User | UniRent</title>
    <link rel="shortcut icon" type="image/jpg" href="img/logo/UniRent-V2.png" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="/JS/sidebar.js"></script>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>

    <style type="text/css">
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }
    </style>
    <title>jQuery UI Slider - Range slider</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


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

    <!-- Banner -->
    <div class="banner-image d-flex justify-content-center align-items-center pt-5">
        <div class="container profile-container m-5">
            <div class="content text-center">
                <h1>Fatura de Arrendamento</h1>
                <br>

                <h2>Mes de Aluguer:</h2>
                <p>{{$arrendamento['MesContrato']}}</p>
                <h2>Propriedade:</h2>
                <p>Morada: <a id="morada"></a></p>
                <h2>Senhorio:</h2>
                <p>Nome: {{$senhorio['PrimeiroNome']}} {{$senhorio['UltimoNome']}}</p>
                <p>Morada: {{$senhorio['Morada']}}</p>
                <p>NIF: {{$senhorio['NIF']}}</p>
                <h2>Inquilino:</h2>
                <p>Nome: {{$inquilino['PrimeiroNome']}} {{$inquilino['UltimoNome']}}</p>
                <p>Morada: {{$inquilino['Morada']}}</p>
                <p>NIF: {{$inquilino['NIF']}}</p>
                <br>
                <h2>Valor Total: {{ $property['Preco'] }}€</h2>
                <p>Pagamentos:</p>
                @php
                $totalPago = 0;
                @endphp
                @foreach($pagamentos as $pagamento)
                @php
                $totalPago = $pagamento['Valor'] + $totalPago;
                @endphp
                <p>Pago <b>{{$pagamento['Valor']}}€</b> em <b>{{$pagamento['Data']}}</b></p>
                @endforeach
                <p>Total: <b>{{$totalPago}}€</b></p>
                <h3>Valor em Falta: <b>{{$property['Preco'] - $totalPago}}€</b></h3>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/JS/mapsAPI.js"></script>

    <script>
        function initMap() {
            const geocoder = new google.maps.Geocoder();
            const latlng = {
                lat: {{ $property['Latitude'] }},
                lng: {{ $property['Longitude'] }},
            };
            geocoder.geocode({
                location: latlng
            }, (results, status) => {
                if (status === "OK") {
                    if (results[0]) {
                        document.getElementById("morada").innerHTML = results[0].formatted_address;
                    } else {
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
    <!-- END Banner -->
</body>