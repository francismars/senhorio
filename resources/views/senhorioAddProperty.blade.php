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

    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>

</head>

<body>
    
    <!-- END Nav bar -->

    <!-- Banner -->
    <!-- <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center"> --> 

        <div class="container">
            <form method="post" action="/propriedade/" enctype="multipart/form-data">
            <div class="row">
                    <div class="form-group col-md-2">
                        <label for="idSenhorio">Id Senhorio:</label>
                        <input type="text" class="form-control" id="idSenhorio" name="idSenhorio" value="1" readonly>
                    </div>
                    </div>
                <div class="row">
                    <div class="col-2">
                        <label for="inputtipo">Tipo de Propriedade:</label>
                        <select id="inputtipo" name="inputtipo" class="form-control">
                        <option selected>Quarto</option>
                        <option>Casa</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="inputEndereco">Endereço:</label>
                        <input type="text" class="form-control" id="inputEndereco" placeholder="Rua da Prata, 1100 Lisboa, Portugal">
                    </div>
                    <button type="button" id="geocodeSubmit">Geocode</button>
                    <div id="map"></div>
                    <div class="row">
                    <div class="form-group col-md-2">
                        <label for="inputLatitude">Latitude:</label>
                        <input type="text" class="form-control" id="inputLatitude" name="inputLatitude" value="" readonly>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="inputLongitude">Longitude:</label>
                        <input type="text" class="form-control" id="inputLongitude" name="inputLongitude" value="" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputLocalizacao">Localizacao:</label>
                        <input type="text" class="form-control" id="inputLocalizacao" name="inputLocalizacao" value="" readonly>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputDescricao">Descrição:</label>
                        <input type="Descrição" class="form-control" id="inputDescricao" name="inputDescricao" placeholder="Descrição">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="inputQuartos">Numero de Quartos:</label>
                        <input type="text" class="form-control" id="inputQuartos" name="inputQuartos" placeholder="#">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputBanho">Casas de Banho:</label>
                        <input type="text" class="form-control" id="inputBanho" name="inputBanho" placeholder="#">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputLotacao">Lotação:</label>
                        <input type="text" class="form-control" id="inputLotacao" name="inputLotacao" placeholder="# pessoas">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputOrientacao">Orientação Solar:</label>
                        <select id="inputOrientacao" name="inputOrientacao" class="form-control">
                        <option selected>Norte</option>
                        <option>Sul</option>
                        <option>Este</option>
                        <option>Oeste</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="inputDuracao">Duração do Aluguer:</label>
                        <input type="text" class="form-control" id="inputDuracao" name="inputDuracao" placeholder="Meses">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputDiponibilidade">Diponibilidade:</label>
                        <select id="inputDiponibilidade" name="inputDiponibilidade" class="form-control">
                        <option selected>Disponível</option>
                        <option>Indisponível</option>
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
                        <label for="inputArea">Área:</label>
                        <input type="text" class="form-control" id="inputArea" name="inputArea" placeholder="m2">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="inputPreco">Preço:</label>
                        <input type="text" class="form-control" id="inputPreco" name="inputPreco" placeholder="€">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="inputFotos">Inserir Fotos:</label>
                            <input type="file" class="form-control-file" id="inputFotos" name="inputFotos[]" multiple>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">Criar</button>
                    </div>
                </div>
            </form>
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
  
    
    <!-- END Banner -->

</body>