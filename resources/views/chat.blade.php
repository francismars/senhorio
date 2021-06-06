<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <title>Chat | UniRent</title>
    <link rel="shortcut icon" type="image/jpg" href="img/logo/UniRent-V2.png" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="/JS/navbutton.js"></script>
   

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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


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
                        
                        <button onclick="myFunction()" id="dropbtn" class="dropbtn"></button>
                        <script>document.getElementById("dropbtn").style.backgroundImage = `url("/img/{{$user['imagem']}}")`</script>
                        <div id="myDropdown" class="dropdown-content">
                          <p class="outro">Hi, {{$user['PrimeiroNome']}}!</p>
                          <a href="/senhorio/home">Home</a>
                          <a href="/propriedade/add">Add Property</a>
                          <a href="">Messages</a>
                          <a href="/senhorio/wallet">Wallet</a>
                          <a href="#">Sign Out</a>
                        </div>
                      </div>     
        </ul>
      </div>
    </div>
  </nav>
  <!-- END Nav bar -->

    <!-- Banner -->
    <div class="d-flex justify-content-center align-items-center pt-5">
      <div class="container profile-container mt-5  ">
        <div class="content text-center">
          <div id="chat-geral" class="border row" style="height: 400px">
            <div id="leftArea" class="border col">
              <div id="searchbar" class="border d-flex justify-content-center align-items-center">
              <label for="name">Search for User:</label>
              <input type="text" id="nameSearch" name="nameSearch" required
                    minlength="3" maxlength="20" size="10" oninput="searchFunction({{$user['IdUser']}})">
              <button id="seachUser" onclick="clearSearch({{$user['IdUser']}})">Clear</button>
              </div>
              <div id="userList" class="border" style="height: 370px">
                <div class="border p-1 d-flex justify-content-center align-items-center" id="userListheader">
                  Previous Messages:
                </div>
                <div id="userListbody">
                  
                </div>
              </div>
            </div>
            <div id="rightArea" class="border col-8">
              <div id="chatText" class="border" style="height: 370px">
              <div id="chatTextHeader" class="border">
                talking to:
              </div>
              <div id="chatTextBody" class="border" style="height: 340px">
                chat
              </div>
              </div>
              <div id="sendText" class="border">

              </div>
              </div>
              </div>
          </div>
                
        </div>
      </div>
    </div>
    <!-- END Banner -->
</body>

<script type="text/javascript" src="/JS/chat.js"></script>
<script>
  getPastMessages({{$user['IdUser']}})

  @if (isset($_GET['idChat']))
    loadChat({{$user['IdUser']}},{{$_GET['idChat']}})
  @endif
</script>