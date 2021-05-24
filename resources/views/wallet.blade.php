<head>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="author" content="UniRent">
    <title>Wallet | UniRent</title>
    <link rel="shortcut icon" type="image/jpg" href="img/logo/UniRent-V2.png" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="/JS/scripts.js"></script>
</head>
<?php
//echo $_SESSION['id'];
?>
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

    <!-- Profile -->
    <div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center pt-5 ">
        <div>
            <div class="wallet-container text-center">
            <p class="page-title"><h2 class="font-effect__blue">MyUniRent Wallet</h2><i class="fa fa-user"></i></p>
            @foreach ($data as $info)
            
            <div class="amount-box text-center pt-2">
                <img src="https://lh3.googleusercontent.com/ohLHGNvMvQjOcmRpL4rjS3YQlcpO0D_80jJpJ-QA7-fQln9p3n7BAnqu3mxQ6kI4Sw" alt="wallet">
                <p class="font-effect__blue p-2">Total Balance</p>
                <p class="amount">{{ $info['Saldo'] }} €</p>
               
            </div>
            
            <div class="btn-group text-center">
                <button type="button" class="btn btn-outline-primary" onclick="div_show()">Add Money</button>
            </div>

            <div class="txn-history">
                <h2 class="font-effect__blue pb-3">History</h2>
                @foreach($data2 as $info)
                    <p class="txn-list">{{ $info['Descricao'] }}<span class="{{ $info->Valor >= 0 ? 'credit-amount' : 'debit-amount' }}">{{ $info['Valor'] }} €</span></p>

                @endforeach
            </div>

            
                
                <div id="abc">
                    <!-- Popup Div Starts Here -->
                    <div id="popupContact">
                        <!-- Contact Us Form -->
                            <img id="close" src="/img/closeButton.png" onclick ="div_hide()">
                            <div id="smart-button-container">
                    <div style="text-align: center"><label for="description">Descrição: </label><input type="text" name="descriptionInput" id="description" maxlength="127" value=""></div>
                    <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
                    <div style="text-align: center"><label for="amount">Montante: </label><input name="amountInput" type="number" id="amount" value="" ><span> EUR</span></div>
                    <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
                    <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
                    <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
                    <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
                </div>
                <script src="https://www.paypal.com/sdk/js?client-id=AYJGD5inw4UzvP97ZAF5D7I0z_oQXv5QXAfwQSGk_UogddNFuZsEZw6NkCD5Kaxz2vfJGZlrCyn4q4JD&currency=EUR" data-sdk-integration-source="button-factory"></script>
                <script>
                function initPayPalButton() {
                    var description = document.querySelector('#smart-button-container #description');
                    var amount = document.querySelector('#smart-button-container #amount');
                    var descriptionError = document.querySelector('#smart-button-container #descriptionError');
                    var priceError = document.querySelector('#smart-button-container #priceLabelError');
                    var invoiceid = document.querySelector('#smart-button-container #invoiceid');
                    var invoiceidError = document.querySelector('#smart-button-container #invoiceidError');
                    var invoiceidDiv = document.querySelector('#smart-button-container #invoiceidDiv');

                    var elArr = [description, amount];

                    if (invoiceidDiv.firstChild.innerHTML.length > 1) {
                    invoiceidDiv.style.display = "block";
                    }

                    var purchase_units = [];
                    purchase_units[0] = {};
                    purchase_units[0].amount = {};

                    function validate(event) {
                    return event.value.length > 0;
                    }

                    paypal.Buttons({
                    style: {
                        color: 'gold',
                        shape: 'rect',
                        label: 'paypal',
                        layout: 'vertical',
                        
                    },

                    onInit: function (data, actions) {
                        actions.disable();

                        if(invoiceidDiv.style.display === "block") {
                        elArr.push(invoiceid);
                        }

                        elArr.forEach(function (item) {
                        item.addEventListener('keyup', function (event) {
                            var result = elArr.every(validate);
                            if (result) {
                            actions.enable();
                            } else {
                            actions.disable();
                            }
                        });
                        });
                    },

                    onClick: function () {
                        if (description.value.length < 1) {
                        descriptionError.style.visibility = "visible";
                        } else {
                        descriptionError.style.visibility = "hidden";
                        }

                        if (amount.value.length < 1) {
                        priceError.style.visibility = "visible";
                        } else {
                        priceError.style.visibility = "hidden";
                        }

                        if (invoiceid.value.length < 1 && invoiceidDiv.style.display === "block") {
                        invoiceidError.style.visibility = "visible";
                        } else {
                        invoiceidError.style.visibility = "hidden";
                        }

                        purchase_units[0].description = description.value;
                        purchase_units[0].amount.value = amount.value;

                        if(invoiceid.value !== '') {
                        purchase_units[0].invoice_id = invoiceid.value;
                        }
                    },

                    createOrder: function (data, actions) {
                        return actions.order.create({
                        purchase_units: purchase_units,
                        });
                    },

                    onApprove: function (data, actions) {
                        return actions.order.capture().then(function (details) {
                            alert('Transaction completed by ' + details.payer.name.given_name + '!');
                            let jsonInfos = {"Descricao":details.purchase_units[0].description,"amountToAdd":details.purchase_units[0].amount.value};
                            console.log(jsonInfos);
                            var data = new FormData();
                            data.append( "json", JSON.stringify( jsonInfos ) );
                            //$.post( '/senhorio/wallet/add', data ); 
                            return fetch('/senhorio/wallet/add', {
                                method: 'POST',
                                headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                                },                                
                                body: JSON.stringify( jsonInfos)                                
                            }).then(function(res) {
                                if (!res.ok) {
                                alert('Something went wrong');
                                }
                            });
                        });
                    },

                    onError: function (err) {
                        console.log(err);
                    }
                    }).render('#paypal-button-container');
                }
                initPayPalButton();
                </script>

                    </div>
                        <!-- Popup Div Ends Here -->
                </div>
            </div>
                <script>
                    
                    $('#formAddSaldo').submit(function(e) {
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
                        div_hide();
                        $('.amount-box').fadeOut(1000).fadeIn(1000);
                        setTimeout(function(){
                            $('.amount').text(data.res+" €");
                        }, 1000);
                        
                        //alert("feito");
                    });
                    
                    });
                </script>
        </div>
    </div>

    <!-- END Profile -->
    @endforeach
</body>