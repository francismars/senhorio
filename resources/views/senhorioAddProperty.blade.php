<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <title>Add Property | UniRent</title>
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

    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 14,
      max: 88,
      values: [ 18, 23 ],
      slide: function( event, ui ) {
        $( "#idades" ).val( ui.values[ 0 ] +" - "+ ui.values[ 1 ] );
        $( "#faixaEtariaMin" ).val( ui.values[ 0 ] );
        $( "#faixaEtariaMax" ).val( ui.values[ 1 ] );
      }
      
    });
    $( "#idades" ).val( "" + $( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  </script>

</head>
<body>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
    <div class="container">
      <a class="navbar-brand" href="/senhorio/home">
        <img src="/img/logo/UniRent-V2.png" alt="" width="100">
      </a>
      <div class="navbar" id="navbarNav">
        <div class="mx-auto"></div>
        <ul class="navbar-nav">
                      <div class="dropdown">
                        <button class="notificationsButton notificationsEvent notificationMouseOver" onclick="notificationFunction()" id="dropNotifButton">
                          <span><i class="bell fa fa-bell-o notificationsEvent"></i></span>
                          <span class="badge notificationsEvent notificationMouseOver" id="countNoti"></span>
                        </button>                        
                        <div id="notificationDropdown" class="notificationDropdown">
                          <p class="outro">Notifications</p>
                          <div id="notificationsBody">                         
                          </div>                         
                        </div>
                      </div>
                      <div class="dropdown">
                        <button onclick="myFunction()" id="dropbtn" class="dropbtn mx-2">{{substr($user['PrimeiroNome'], 0,1) . substr($user['UltimoNome'], 0,1)}}</button>
                        <script>document.getElementById("dropbtn").style.backgroundImage = `url("/img/{{$user['imagem']}}")`</script>
                        <div id="myDropdown" class="dropdown-content">
                          <p class="outro">Hi, {{$user['Username']}}!</p>
                          <a href="/senhorio/home">Home</a>
                          <a href="/propriedade/add" >Add Property</a>
                          <a href="/chat">Messages</a>
                          <a href="/senhorio/wallet">Wallet</a>
                          <a href="#">Sign Out</a>
                        </div>
                      </div>

                      <script>
                      /* When the user clicks on the button, 
                      toggle between hiding and showing the dropdown content */
                      function myFunction() {
                        document.getElementById("myDropdown").classList.toggle("show");
                      }
                      function notificationFunction() {
                        document.getElementById("notificationDropdown").classList.toggle("show");
                      }

                      function markAsRead(id){
                        $.post("/notifications/"+id, function(data, status){
                          //console.log("Data: " + data + "\nStatus: " + status);
                          if (status=="success"){
                            console.log("Marcou")
                          }
                          else{
                            console.log("Something went wrong")
                          }
                        });
                      }
                      
                      setInterval(function(){
                        $.get("/notifications/"+{{$user['IdUser']}}, function(data, status){
                                if (status=="success"){
                                  document.getElementById("notificationsBody").innerHTML = ""
                                      let counter = 0;
                                      for(i in data[0]){
                                        if (data[0][i]['seen']=="0"){
                                          counter +=1;
                     
                                          if (data[0][i]['type']=='message'){
                                            document.getElementById("notificationsBody").innerHTML +=
                                            "<div class=notification>" +
                                            "<div class=notificationTitle>" +
                                              "<p>New "+data[0][i]['type']+"</p>" +
                                              "<button class=notificationButton onclick=markAsRead("+data[0][i]['id']+")> "+
                                              "<i class='fa fa-check' aria-hidden=true></i></button>" +
                                            "</div>" +
                                            "<div class=notificationBody>" +
                                            "<p>You got a "+data[0][i]['type'] +
                                            " from <a href=/chat?idChat="+data[0][i]['sentBy']+">user "+data[0][i]['sentBy']+"</a></p>"+
                                            "<div class='notificationTime'>"+data[0][i]['date'].split(" ")[1].substring(0, 5);+"</div>" +
                                            "</div></div>"
                                          }
                                          if (data[0][i]['type']=='booking' || data[0][i]['type']=='payment'){
                                            document.getElementById("notificationsBody").innerHTML +=
                                            "<div class=notification>" +
                                            "<div class=notificationTitle>" +
                                              "<p>New "+data[0][i]['type']+"</p>" +
                                              "<button class=notificationButton onclick=markAsRead("+data[0][i]['id']+")> "+
                                              "<i class='fa fa-check' aria-hidden=true></i></button>" +
                                            "</div>" +
                                            "<div class=notificationBody>" +
                                            "<p>You got a "+data[0][i]['type'] +
                                            " in <a href=/propriedade/"+data[0][i]['sentBy']+">property "+data[0][i]['sentBy']+"</a></p>"+
                                            "<div class='notificationTime'>"+data[0][i]['date'].split(" ")[1].substring(0, 5);+"</div>" +
                                            "</div></div>"
                                          }                                                
                                            
                                        }
                                      }
                                      document.getElementById("countNoti").innerHTML = counter==0 ? "": counter;
                                      document.getElementById("notificationsBody").innerHTML += counter==0 ? 
                                      "<div class=notification><div class='notificationTitle pt-1'>No notifications</div></div>": "";
                                    }
                                else{
                                    console.log("Something Went Wrong")
                                }                            
                              });                     
                            }, 1000);

                      // Close the dropdown if the user clicks outside of it
                      window.onclick = function(event) {
                        console.log(event.target)
                        if (!event.target.matches('.dropbtn')) {
                          var dropdowns = document.getElementsByClassName("dropdown-content");
                          var i;
                          for (i = 0; i < dropdowns.length; i++) {
                            var openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains('show')) {
                              openDropdown.classList.remove('show');
                            }
                          }
                        }
                        if (!event.target.matches('.notificationsEvent') && (!event.target.matches('.notificationDropdown'))){
                          var dropdown = document.getElementById("notificationDropdown");                          
                          if (dropdown.classList.contains('show')) {
                            dropdown.classList.toggle("show");
                            }
                          
                        }
                     }
                      </script>        
        </ul>
      </div>
    </div>
  </nav>
  <!-- END Nav bar -->

<!-- Banner -->
<div class="main">
    <div class="container profile-container py-3">
      <div class="breaddiv" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"></li>
        <li class="breadcrumb-item" aria-current="page"><a href="/senhorio/home">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Property</li>
        </ol>
      </div>
        <div class="content text-center">
        <h1>Adicionar Propriedade</h1>
        </div>
        
        <br>
        <div class="content text-left">
	        <form method="post" action="/propriedade/" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-2">
                    </div>
                    <div class="form-group col-md-2">
                        <input type="hidden" class="form-control" id="idSenhorio" name="idSenhorio" value="1" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                    </div>
                    <div class="col-3">
                        <label for="inputtipo">Tipo de Propriedade:</label>
                        <select id="inputtipo" name="inputtipo" class="form-control">
                        <option selected>Quarto</option>
                        <option>Casa</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row mt-1">
                    <div class="form-group col-md-2">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEndereco">Endere??o:</label>
                        <input type="text" class="form-control" id="inputEndereco" placeholder="Rua da Prata, 1100 Lisboa, Portugal">
                    </div>
                    <div class="form-group col-md-4">
                        <br>
                        <button type="button" class="btn btn-primary" id="geocodeSubmit">Confirmar</button>
                    </div> 
                    
                </div>       
                <div class="row mt-1">
                    <div class="form-group col-md-2">
                        
                    </div>
                    <div class="form-group col-md-2">
                        <input type="hidden" class="form-control" id="inputLatitude" name="inputLatitude" value="" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="hidden" class="form-control" id="inputLongitude" name="inputLongitude" value="" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <input type="hidden" class="form-control" id="inputLocalizacao" name="inputLocalizacao" value="" readonly>               
                    </div>
                </div><br>
                <div class="row">
                    <div class="form-group col-md-2">
                    </div>
                    <div class="form-group col-md-8">
                        <br>
                        <label for="inputDescricao">Descri????o:</label>
                        <input type="Descri????o" class="form-control" id="inputDescricao" name="inputDescricao" placeholder="Descri????o" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-2">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPreco">Pre??o:</label>
                        <input type="number"  min="0" class="form-control" id="inputPreco" name="inputPreco" placeholder="???" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputQuartos">N??mero de Quartos:</label>
                        <input type="number" min="0" class="form-control" id="inputQuartos" name="inputQuartos" placeholder="#" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputBanho">Casas de Banho:</label>
                        <input type="number"  min="0" class="form-control" id="inputBanho" name="inputBanho" placeholder="#" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputLotacao">Lota????o:</label>
                        <input type="number"  min="0" class="form-control" id="inputLotacao" name="inputLotacao" placeholder="# pessoas" required>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputOrientacao">Orienta????o Solar:</label>
                        <select id="inputOrientacao" name="inputOrientacao" class="form-control">
                        <option selected>Norte</option>
                        <option>Sul</option>
                        <option>Este</option>
                        <option>Oeste</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputEstado">Estado:</label>
                        <select id="inputEstado" name="inputEstado" class="form-control">
                        <option selected>Novo</option>
                        <option>Usado</option>
                        <option>Remodelado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputArea">??rea:</label>
                        <input type="number"  min="0" class="form-control" id="inputArea" name="inputArea" placeholder="m2" required>
                    </div>

                

                <div class="form-group col-md-2">                   
                <label for="idades">Age Range:</label>
                <input type="text" id="idades" class="form-control" readonly>  
                <div id="slider-range"></div>
                </div>
                <div class="form-group col-md-2"> 
               
                <input type="text" id="faixaEtariaMin" name="faixaEtariaMin" class="form-control" value="18" readonly hidden> 
                </div>
                <div class="form-group col-md-2"> 
                
                <input type="text" id="faixaEtariaMax" name="faixaEtariaMax" class="form-control" value="23" readonly hidden> 
                </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-2">
                    </div>
                    <div class="form-group col-md-2">
                    <input type="checkbox" id="internetAcess" name="internetAcess"
                        checked>
                    <label for="internetAcess">Internet Access</label>
                    </div>
                    <div class="form-group col-md-2">
                    <input type="checkbox" id="limpeza" name="limpeza"
                        checked>
                    <label for="limpeza">Limpeza</label>
                    </div>
                    <div class="form-group col-md-2">
                    <input type="checkbox" id="generoMasc" name="generoMasc"
                        checked>
                    <label for="generoMasc">Aceita Homens</label>
                    </div>
                    <div class="form-group col-md-2">
                    <input type="checkbox" id="generoFemin" name="generoFemin"
                        checked>
                    <label for="generoFemin">Aceita Mulheres</label>
                    </div>
                    </div>
                <div class="row">
                <div class="form-group col-md-2">
                    </div>
                    <div class="form-group col-md-2">
                    <input type="checkbox" id="aceitaFumadores" name="aceitaFumadores"
                        checked>
                    <label for="aceitaFumadores">Aceita Fumadores</label>
                    </div>
                    <div class="form-group col-md-2">
                    <input type="checkbox" id="aceitaAnimais" name="aceitaAnimais"
                        checked>
                    <label for="aceitaAnimais">Aceita Animais</label>
                    </div></div>

                <br>
                <div class="row">
                    <div class="form-group col-md-2">
                    </div>
                    <div class="form-group col-md-2">
                        <div class="form-group">
                            <label for="inputFotos"><h2>Inserir Fotos:</h2></label>
                            <input type="file" class="form-control-file" id="inputFotos" name="inputFotos[]" multiple>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-2">
                    </div>
                    <div class="form-group col-md-8">
                        <div class="profile-container" id="map"></div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-5">
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn-lg btn-primary">Criar Propriedade</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
        <script type="text/javascript" src="/JS/mapsAPI.js"></script>
        
        <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 17,
            center: { lat: 38.7108275, lng: -9.136863 },
            });
            const geocoder = new google.maps.Geocoder();
            document.getElementById("geocodeSubmit").addEventListener("click", () => {
            geocodeAddress(geocoder, map);
            });
        }
        function geocodeAddress(geocoder, resultsMap) {
            const address = document.getElementById("inputEndereco").value;
            geocoder.geocode({ address: address }, (results, status) => {
            if (status === "OK") {
                document.getElementById("inputEndereco").value = results[0].formatted_address;
                document.getElementById("inputLatitude").value = results[0].geometry.location.lat();
                document.getElementById("inputLongitude").value = results[0].geometry.location.lng();
                document.getElementById("inputLocalizacao").value = results[0].address_components[2].long_name;
                resultsMap.setCenter(results[0].geometry.location);
                new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location,
                });
            } else {
                alert(
                "Geocode was not successful for the following reason: " + status
                );
            }
            });
        }
        
    </script>
    
    </div>
</div>
<!-- END Banner -->
</body>