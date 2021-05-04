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
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <script type="text/javascript" src="/JS/sidebar.js"></script>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css" />
    <!--jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--Plugin JavaScript file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="/img/logo/UniRent-V2.png" alt="" width="100">
            </a>
            <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="mx-auto"></div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-black text-end" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black text-end" href="login.html">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black text-end" href="register.html">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END Nav bar -->

    <!-- Banner -->
    <!-- <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center"> --> 

        <div class="container">
            <div class="row">
                <!--good-->
                <div class="col profile-container">
                    <div class="row m-1">
                        <!-- main -->
                        
                        <div class="col-9">
                        <br>
                            <h1 class="px-2 py-4 font-effect__blue">Todas as Propriedades:</h1>

                            @if(isset($propriedades))

                            <div class="container profile-container__searchOptions text-center p-2">
                                @if(count($propriedades)>0)

                                @foreach($propriedades as $propInfo)
                                <div class="row">
                                    <div class="col">
                                        <img class="rounded float-start img-fluid" src="/img/room1.jpg" alt="">
                                    </div> 
                                    <div class="col">
                                        <div class="row">
                                            <br>
                                        </div>
                                        <div class="row p-2" id="row1">
                                            <h3>ID PROPRIEDADE: {{$propInfo['IdPropriedade']}}</h3>
                                        </div>
                                        <div class="row p-2" id="row2">
                                            <h3>TIPO PROPRIEDADE: {{$propInfo['TipoPropriedade']}}</h3>
                                        </div>
                                        <div class="row p-2" id="row3">
                                            <h3>LOCALIZAÇÃO: {{$propInfo['Localizacao']}}</h3>
                                        </div>
                                        <div class="row p-2" id="row4">
                                            <h3>Metros quadrados: {{$propInfo['AreaMetros']}}</h3>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @else
                                <div class="row">
                                    <h1>No results found</h1>
                                </div>
                                
                                @endif
                            </div>

                            @endif
                                                   

                            <div>
                                
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END Banner -->

</body>