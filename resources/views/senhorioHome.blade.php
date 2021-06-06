<?php
    session_start();
?>

<head>
  <!DOCTYPE html>
  <html lang="en">
  <meta charset="UTF-8">
  <meta name="author" content="UniRent">
  <title>Home | UniRent</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="/CSS/style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>  

  <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 256px;
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
    <div class="container">
      <a class="navbar-brand" href="/senhorio/home">
        <img src="/img/logo/UniRent-V2.png" alt="" width="100">
      </a>
      <div class="breaddiv" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"></li>
        <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </div>
      <button class="navbar-toggler bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
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
  <div class="w-100 vh-100 d-flex justify-content-center align-items-center pt-5">
    <div class="container profile-container"> 
      <div class="row">
        <!--<div class="col-4 profile-container__icon">
          <img class="m-3" src="img/logo/UniRent-V2.png" alt="" width="100">
        </div>-->

        <!-- Cartão do gajo-->
        
        <div class="col-3 pt-2">
            <div class="single_advisor_profile m-0 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
              <!-- Team Thumb-->
              <!-- <div class="advisor_thumb"><img src="/img/blankProfileImg.png" alt="img profile"> -->
              <div class="advisor_thumb p-0"><img src="/img/{{$user['imagem']}}" alt="img profile" width="100%" height="400">
                <!-- Social Info-->
                <div class="social-info"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-linkedin"></i></a></div>
              </div>
              <!-- Team Details-->
            
              <div class="single_advisor_details_info">
                <h6>{{ $user['PrimeiroNome'] }} {{ $user['UltimoNome'] }}</h6>
                <p class="designation">{{ $user['TipoConta'] }}</p>
              </div>
              <form class="p-2" action="/utilizador/edit/profilePic/{{ $user['IdUser'] }}" method="POST" enctype="multipart/form-data" id="formFotoPerfil">
                            <label for="formFileLg" class="form-label pt-5 px-1"><h2>Change Avatar</h2></label>
                            <input class="form-control" id="formFileLg" type="file" name="imgProfile">
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
              </form>
              </div>
          </div>
          <script>
            var data = new FormData();
            jQuery.each(jQuery('#file')[0].files, function(i, file) {
                data.append('file-'+i, file);
            });    
            $('#formFotoPerfil').submit(function(e) {
            alert("ola");
            e.preventDefault();
            req = $.ajax({
              url: $(this).attr('action'),
              data: data,
              cache: false,
              contentType: false,
              processData: false,
              type: 'POST', // For jQuery < 1.9
              success: function(data){
                  alert(data);
              }
            });
            req.done(function(response){
              console.log(response)
              $('.advisor_thumb').fadeOut(1000).fadeIn(1000);
              setTimeout(function(){
                  $('.designation').text("biralas");
              }, 1000);
              //alert("feito");
            });
            });
            </script>
        <div class="col-9 pt-2">
          <div class="row">
            <div class="col">
            </div>
          </div>
          <div class="row">
          <div class="col profile-container__information">


              <form action="/utilizador/edit/{{ $user['IdUser'] }}" method="POST" id="formPerfil">
                  
                  <input type="hidden" name="username" value="{{$user['Username']}}">

                  <div class="form-group row">
                    <div class="form-group col">
                      <h2 class="p-2" >Username: </h2>
                      <div class="col-sm-8 ">
                        <input type="text" minlength="3" maxlength="20" class="form-control mt-2" id="inputPassword" name="nomeUser" value="{{ $user['Username'] }}">
                      </div>
                      
                    </div>

                    <div class="form-group col">
                      <h2 class="p-2">First Name: </h2>
                      <div class="col-sm-8">
                        <input type="text" minlength="3" maxlength="30" class="form-control mt-2" id="inputPassword" name="primeiroNome" value="{{ $user['PrimeiroNome'] }}">
                      </div>
                    </div>
                    <div class="form-group col">
                        <h2 class="p-2">Last Name: </h2>
                        <div class="col-sm-8">
                          <input type="text" minlength="3" maxlength="30" class="form-control mt-2" id="inputPassword" name="ultimoNome" value="{{ $user['UltimoNome'] }}">
                        </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="form-group col">
                      <h2 class="p-2">Email:</h2>
                      <div class="col-sm-8">
                        <input type="email" class="form-control mt-2" id="inputPassword" name="mail" placeholder="CHANGE ME!" value="{{ $user['Email'] }}"> 
                      </div>
                    </div>


                    <div class="form-group col">
                      <h2 class="p-2">Address:</h2>
                      <div class="col-sm-8">
                        <input type="text" minlength="3" maxlength="100" class="form-control mt-2" id="inputPassword" name="morada" value="{{ $user['Morada'] }}">
                      </div>
                    </div>
                    <div class="form-group col">
                      <h2 class="p-2">Birth Date:</h2>
                      <div class="col-sm-8">
                        <input type="date" max="{{ $dataHoje->format('Y-m-d') }}" class="form-control mt-2" id="inputPassword" name="dateNascimento" value="{{ $user['Nascimento'] }}">
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="form-group col">
                      <h2 class="p-2">NIF:</h2>
                      <div class="col-sm-8">
                        <input type="number" class="form-control mt-2" id="inputPassword" name="NIF" placeholder="CHANGE ME!" value="{{ $user['NIF'] }}"> 
                      </div>
                    </div>


                    <div class="form-group col">
                      <h2 class="p-2">Nacionality:</h2>
                      <div class="col-sm-8">
                        <select id="country" name="Nacionalidade" class="form-control mt-2">
                          <option value="Afganistan">Afghanistan</option>
                          <option value="Albania">Albania</option>
                          <option value="Algeria">Algeria</option>
                          <option value="American Samoa">American Samoa</option>
                          <option value="Andorra">Andorra</option>
                          <option value="Angola">Angola</option>
                          <option value="Anguilla">Anguilla</option>
                          <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                          <option value="Argentina">Argentina</option>
                          <option value="Armenia">Armenia</option>
                          <option value="Aruba">Aruba</option>
                          <option value="Australia">Australia</option>
                          <option value="Austria">Austria</option>
                          <option value="Azerbaijan">Azerbaijan</option>
                          <option value="Bahamas">Bahamas</option>
                          <option value="Bahrain">Bahrain</option>
                          <option value="Bangladesh">Bangladesh</option>
                          <option value="Barbados">Barbados</option>
                          <option value="Belarus">Belarus</option>
                          <option value="Belgium">Belgium</option>
                          <option value="Belize">Belize</option>
                          <option value="Benin">Benin</option>
                          <option value="Bermuda">Bermuda</option>
                          <option value="Bhutan">Bhutan</option>
                          <option value="Bolivia">Bolivia</option>
                          <option value="Bonaire">Bonaire</option>
                          <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                          <option value="Botswana">Botswana</option>
                          <option value="Brazil">Brazil</option>
                          <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                          <option value="Brunei">Brunei</option>
                          <option value="Bulgaria">Bulgaria</option>
                          <option value="Burkina Faso">Burkina Faso</option>
                          <option value="Burundi">Burundi</option>
                          <option value="Cambodia">Cambodia</option>
                          <option value="Cameroon">Cameroon</option>
                          <option value="Canada">Canada</option>
                          <option value="Canary Islands">Canary Islands</option>
                          <option value="Cape Verde">Cape Verde</option>
                          <option value="Cayman Islands">Cayman Islands</option>
                          <option value="Central African Republic">Central African Republic</option>
                          <option value="Chad">Chad</option>
                          <option value="Channel Islands">Channel Islands</option>
                          <option value="Chile">Chile</option>
                          <option value="China">China</option>
                          <option value="Christmas Island">Christmas Island</option>
                          <option value="Cocos Island">Cocos Island</option>
                          <option value="Colombia">Colombia</option>
                          <option value="Comoros">Comoros</option>
                          <option value="Congo">Congo</option>
                          <option value="Cook Islands">Cook Islands</option>
                          <option value="Costa Rica">Costa Rica</option>
                          <option value="Cote DIvoire">Cote DIvoire</option>
                          <option value="Croatia">Croatia</option>
                          <option value="Cuba">Cuba</option>
                          <option value="Curaco">Curacao</option>
                          <option value="Cyprus">Cyprus</option>
                          <option value="Czech Republic">Czech Republic</option>
                          <option value="Denmark">Denmark</option>
                          <option value="Djibouti">Djibouti</option>
                          <option value="Dominica">Dominica</option>
                          <option value="Dominican Republic">Dominican Republic</option>
                          <option value="East Timor">East Timor</option>
                          <option value="Ecuador">Ecuador</option>
                          <option value="Egypt">Egypt</option>
                          <option value="El Salvador">El Salvador</option>
                          <option value="Equatorial Guinea">Equatorial Guinea</option>
                          <option value="Eritrea">Eritrea</option>
                          <option value="Estonia">Estonia</option>
                          <option value="Ethiopia">Ethiopia</option>
                          <option value="Falkland Islands">Falkland Islands</option>
                          <option value="Faroe Islands">Faroe Islands</option>
                          <option value="Fiji">Fiji</option>
                          <option value="Finland">Finland</option>
                          <option value="France">France</option>
                          <option value="French Guiana">French Guiana</option>
                          <option value="French Polynesia">French Polynesia</option>
                          <option value="French Southern Ter">French Southern Ter</option>
                          <option value="Gabon">Gabon</option>
                          <option value="Gambia">Gambia</option>
                          <option value="Georgia">Georgia</option>
                          <option value="Germany">Germany</option>
                          <option value="Ghana">Ghana</option>
                          <option value="Gibraltar">Gibraltar</option>
                          <option value="Great Britain">Great Britain</option>
                          <option value="Greece">Greece</option>
                          <option value="Greenland">Greenland</option>
                          <option value="Grenada">Grenada</option>
                          <option value="Guadeloupe">Guadeloupe</option>
                          <option value="Guam">Guam</option>
                          <option value="Guatemala">Guatemala</option>
                          <option value="Guinea">Guinea</option>
                          <option value="Guyana">Guyana</option>
                          <option value="Haiti">Haiti</option>
                          <option value="Hawaii">Hawaii</option>
                          <option value="Honduras">Honduras</option>
                          <option value="Hong Kong">Hong Kong</option>
                          <option value="Hungary">Hungary</option>
                          <option value="Iceland">Iceland</option>
                          <option value="Indonesia">Indonesia</option>
                          <option value="India">India</option>
                          <option value="Iran">Iran</option>
                          <option value="Iraq">Iraq</option>
                          <option value="Ireland">Ireland</option>
                          <option value="Isle of Man">Isle of Man</option>
                          <option value="Israel">Israel</option>
                          <option value="Italy">Italy</option>
                          <option value="Jamaica">Jamaica</option>
                          <option value="Japan">Japan</option>
                          <option value="Jordan">Jordan</option>
                          <option value="Kazakhstan">Kazakhstan</option>
                          <option value="Kenya">Kenya</option>
                          <option value="Kiribati">Kiribati</option>
                          <option value="Korea North">Korea North</option>
                          <option value="Korea Sout">Korea South</option>
                          <option value="Kuwait">Kuwait</option>
                          <option value="Kyrgyzstan">Kyrgyzstan</option>
                          <option value="Laos">Laos</option>
                          <option value="Latvia">Latvia</option>
                          <option value="Lebanon">Lebanon</option>
                          <option value="Lesotho">Lesotho</option>
                          <option value="Liberia">Liberia</option>
                          <option value="Libya">Libya</option>
                          <option value="Liechtenstein">Liechtenstein</option>
                          <option value="Lithuania">Lithuania</option>
                          <option value="Luxembourg">Luxembourg</option>
                          <option value="Macau">Macau</option>
                          <option value="Macedonia">Macedonia</option>
                          <option value="Madagascar">Madagascar</option>
                          <option value="Malaysia">Malaysia</option>
                          <option value="Malawi">Malawi</option>
                          <option value="Maldives">Maldives</option>
                          <option value="Mali">Mali</option>
                          <option value="Malta">Malta</option>
                          <option value="Marshall Islands">Marshall Islands</option>
                          <option value="Martinique">Martinique</option>
                          <option value="Mauritania">Mauritania</option>
                          <option value="Mauritius">Mauritius</option>
                          <option value="Mayotte">Mayotte</option>
                          <option value="Mexico">Mexico</option>
                          <option value="Midway Islands">Midway Islands</option>
                          <option value="Moldova">Moldova</option>
                          <option value="Monaco">Monaco</option>
                          <option value="Mongolia">Mongolia</option>
                          <option value="Montserrat">Montserrat</option>
                          <option value="Morocco">Morocco</option>
                          <option value="Mozambique">Mozambique</option>
                          <option value="Myanmar">Myanmar</option>
                          <option value="Nambia">Nambia</option>
                          <option value="Nauru">Nauru</option>
                          <option value="Nepal">Nepal</option>
                          <option value="Netherland Antilles">Netherland Antilles</option>
                          <option value="Netherlands">Netherlands (Holland, Europe)</option>
                          <option value="Nevis">Nevis</option>
                          <option value="New Caledonia">New Caledonia</option>
                          <option value="New Zealand">New Zealand</option>
                          <option value="Nicaragua">Nicaragua</option>
                          <option value="Niger">Niger</option>
                          <option value="Nigeria">Nigeria</option>
                          <option value="Niue">Niue</option>
                          <option value="Norfolk Island">Norfolk Island</option>
                          <option value="Norway">Norway</option>
                          <option value="Oman">Oman</option>
                          <option value="Pakistan">Pakistan</option>
                          <option value="Palau Island">Palau Island</option>
                          <option value="Palestine">Palestine</option>
                          <option value="Panama">Panama</option>
                          <option value="Papua New Guinea">Papua New Guinea</option>
                          <option value="Paraguay">Paraguay</option>
                          <option value="Peru">Peru</option>
                          <option value="Phillipines">Philippines</option>
                          <option value="Pitcairn Island">Pitcairn Island</option>
                          <option value="Poland">Poland</option>
                          <option value="Portugal">Portugal</option>
                          <option value="Puerto Rico">Puerto Rico</option>
                          <option value="Qatar">Qatar</option>
                          <option value="Republic of Montenegro">Republic of Montenegro</option>
                          <option value="Republic of Serbia">Republic of Serbia</option>
                          <option value="Reunion">Reunion</option>
                          <option value="Romania">Romania</option>
                          <option value="Russia">Russia</option>
                          <option value="Rwanda">Rwanda</option>
                          <option value="St Barthelemy">St Barthelemy</option>
                          <option value="St Eustatius">St Eustatius</option>
                          <option value="St Helena">St Helena</option>
                          <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                          <option value="St Lucia">St Lucia</option>
                          <option value="St Maarten">St Maarten</option>
                          <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                          <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                          <option value="Saipan">Saipan</option>
                          <option value="Samoa">Samoa</option>
                          <option value="Samoa American">Samoa American</option>
                          <option value="San Marino">San Marino</option>
                          <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                          <option value="Saudi Arabia">Saudi Arabia</option>
                          <option value="Senegal">Senegal</option>
                          <option value="Seychelles">Seychelles</option>
                          <option value="Sierra Leone">Sierra Leone</option>
                          <option value="Singapore">Singapore</option>
                          <option value="Slovakia">Slovakia</option>
                          <option value="Slovenia">Slovenia</option>
                          <option value="Solomon Islands">Solomon Islands</option>
                          <option value="Somalia">Somalia</option>
                          <option value="South Africa">South Africa</option>
                          <option value="Spain">Spain</option>
                          <option value="Sri Lanka">Sri Lanka</option>
                          <option value="Sudan">Sudan</option>
                          <option value="Suriname">Suriname</option>
                          <option value="Swaziland">Swaziland</option>
                          <option value="Sweden">Sweden</option>
                          <option value="Switzerland">Switzerland</option>
                          <option value="Syria">Syria</option>
                          <option value="Tahiti">Tahiti</option>
                          <option value="Taiwan">Taiwan</option>
                          <option value="Tajikistan">Tajikistan</option>
                          <option value="Tanzania">Tanzania</option>
                          <option value="Thailand">Thailand</option>
                          <option value="Togo">Togo</option>
                          <option value="Tokelau">Tokelau</option>
                          <option value="Tonga">Tonga</option>
                          <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                          <option value="Tunisia">Tunisia</option>
                          <option value="Turkey">Turkey</option>
                          <option value="Turkmenistan">Turkmenistan</option>
                          <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                          <option value="Tuvalu">Tuvalu</option>
                          <option value="Uganda">Uganda</option>
                          <option value="United Kingdom">United Kingdom</option>
                          <option value="Ukraine">Ukraine</option>
                          <option value="United Arab Erimates">United Arab Emirates</option>
                          <option value="United States of America">United States of America</option>
                          <option value="Uraguay">Uruguay</option>
                          <option value="Uzbekistan">Uzbekistan</option>
                          <option value="Vanuatu">Vanuatu</option>
                          <option value="Vatican City State">Vatican City State</option>
                          <option value="Venezuela">Venezuela</option>
                          <option value="Vietnam">Vietnam</option>
                          <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                          <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                          <option value="Wake Island">Wake Island</option>
                          <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                          <option value="Yemen">Yemen</option>
                          <option value="Zaire">Zaire</option>
                          <option value="Zambia">Zambia</option>
                          <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                        <script>
                        escolha = (document.getElementById('country').value = "{{$user['Nacionalidade']}}");
                        //console.log(escolha);
                        escolha.selected = true;
                        </script>
                      </div>
                    </div>
                    <div class="form-group col">
                      <h2 class="p-2">Phone Number:</h2>
                      <div class="col-sm-8">
                        <input type="number" class="form-control mt-2" id="inputPassword" name="Telefone" value="{{ $user['Telefone'] }}">
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="mt-3 btn btn-primary">Update Profile</button>
                  <!-- <a class="mt-3 btn btn-success" href="/propriedade/add" role="button">Add Property</a> -->
                </form>

            <script>
                    $('#formPerfil').submit(function(e) {
                    //alert("ola");
                    e.preventDefault();
                    req = $.ajax({
                        type: 'POST',
                        cache: false,
                        dataType: 'JSON',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(data) {
                            console.log(data);
                        }
                    });
                    
                    req.done(function(data){
                        //$('#totalAVGrating').fadeOut(500).fadeIn(500);
                        
                        $('.form-group').fadeOut(1000).fadeIn(1000);
                        // setTimeout(function(){
                        //     $('.amount').text(data.res+" €");
                        // }, 1000);
                        
                        //alert("feito");
                    });
                    
                    });
                    
            </script>
                <div class="card text-center">
                  <div class="card-header">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                       <a class="nav-link active" data-bs-toggle="tab" href="#lista">List</a>
                      </li>
                      <li class="nav-item">
                       <a class="nav-link" data-bs-toggle="tab" href="#mapa">Map</a>
                      </li>
                      <li class="nav-item">
                       <a class="nav-link" data-bs-toggle="tab" href="#porpagar">Late Payments</a>
                      </li>       
                    </ul>  
                    <div align="right" hidden>
                      @if($disp==1)                                                        
                        <input type="checkbox" onclick="checkFluency()"  id="fluency" checked />
                      @else
                        <input type="checkbox" onclick="checkFluency()"  id="fluency" />
                      @endif
                      <label for="fluency" >Disponiveis</label>
                    </div>   
                  </div>

                  <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane active pt-4" id="lista" >
                        <div class="row pb-3">                        
                        @foreach ($propriedadesPag as $propriedade)
                          <div class="col-sm-3">
                            <a href="/propriedade/{{ $propriedade['IdPropriedade'] }}">
                              <h3>{{ $propriedade['TipoPropriedade'] }} em {{ $propriedade['Localizacao'] }}</h3>
                            </a>
                            <img class="img-thumbnail" src="/img/room1.jpg" alt="img profile" width="150" height="100">
                            <p>{{ $propriedade['Descricao'] }}</p>
                          </div>                 
                        @endforeach 
                        </div>
                        {{ $propriedadesPag->links('pagination::bootstrap-4') }}
                      </div>
                      <div class="tab-pane fade" id="mapa" >
                        <div id="map"></div>
                      </div>
                      <div class="tab-pane fade" id="porpagar" >
                      <div class="col">
                        <div class="w3-container" >
                          <table class="w3-table-all w3" id="pagamentosatraso">
                            <thead>
                              <tr class="w3-light-grey">
                                <th>Propriety ID</th>
                                <th>Date of Rental</th>
                                <th>Total Paid</th>
                                <th>Total Missing</th>
                                <th>Tenant ID</th>
                                <th>Contact Tenant</th>
                              </tr>
                            </thead>      
                        </div>
                        @foreach ($arrendamentos as $arrendamento)
                          @php
                          $totalPago = 0;
                          @endphp
                          @foreach ($pagamentos as $pagamento)
                                  @if ($pagamento['IdArrendamento'] == $arrendamento['IdArrendamento'])
                                  @php
                                  $totalPago = $pagamento['Valor'] + $totalPago;
                                  @endphp                                    
                                  @endif
                          @endforeach

                          @foreach ($propriedades as $propriedade)
                          @if ($propriedade['IdPropriedade']==$arrendamento['IdPropriedade'])
                            @if ($totalPago!=$propriedade['Preco'])
                            <script>
                            document.getElementById("pagamentosatraso").innerHTML +=
                            "<tr><td><a href='/propriedade/{{ $arrendamento['IdPropriedade'] }}'>{{ $arrendamento['IdPropriedade'] }}</a></td>" +
                            "<td>{{ $arrendamento['MesContrato']}}</td>" +
                            "<td>{{ $totalPago }}€</td>" +
                            "<td>{{ $propriedade['Preco'] - $totalPago }}€</td>" +
                            "<td>{{ $arrendamento['IdInquilino']}}</td>" +
                            "<td><a href='/chat?idChat={{ $arrendamento['IdInquilino']}}'>Contactar</a></td></tr></table>"                        
                            </script>
                            @endif
                          @endif
                          @endforeach
                        @endforeach
                        </div>
                      </div>
                  </div>
                </div>              
            </div> 
          </div>
        </div>
      </div> 
    </div>
  </div>
  <!-- END Banner -->
</body>
<script type="text/javascript" src="/JS/mapsAPI.js"></script>
<script>
      function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 10,
          center: { lat: 38.7108275, lng: -9.136863 },
        });
        let i = 0;
        infowindow = new google.maps.InfoWindow({
          maxWidth: 150,
        });
        @foreach ($propriedades as $propriedade)
          contentString =
          '<div id="content" class="card border-dark">' +
          '<div id="siteNotice"  class="card-header" >' +
          
          '<a href="/propriedade/{{ $propriedade['IdPropriedade'] }}">' +
          '<h3>{{ $propriedade['TipoPropriedade'] }}</h3>' +
          "</a>" +
          "</div>" +
          '<div id="bodyContent" class="card-body text-dark">' +
          "<p>{{ $propriedade['Descricao'] }}</p>" +
          "<p><b>Preço:</b> {{ $propriedade['Preco'] }}€</p>" +
          "</div>" +
          "</div>";
          var prop = 
          {lat : parseFloat("{{ $propriedade['Latitude'] }}"),
          lng : parseFloat("{{ $propriedade['Longitude'] }}"),
          des : "{{ $propriedade['Descricao'] }}",
          tipo : "{{ $propriedade['TipoPropriedade'] }}" };
          placeMarker(prop,map,contentString)
        
      @endforeach  
    }

    function placeMarker( prop,map,contentString ) {
    const marker = new google.maps.Marker({
      position: { lat: prop.lat, lng: prop.lng},
          map,
          label: (prop.tipo=='Casa' ? "C" : "Q") ,
          title: prop.des,
    });
    google.maps.event.addListener(marker, 'click', function(){
        infowindow.close(); // Close previously opened infowindow
        infowindow.setContent(contentString);
        infowindow.open(map, marker);
    });
  }

  function checkFluency()
{
  var checkbox = document.getElementById('fluency');
  if (checkbox.checked == true)
  {
    window.location.replace("/senhorio/homeDisp");
  }
  if (checkbox.checked != true)
  {
  window.location.replace("/senhorio/home");
  }
}
</script>
