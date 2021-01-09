<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fundraiser Setup</title>
    <link rel="stylesheet" href="./buefy/buefy.min.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.js" integrity="sha512-otOZr2EcknK9a5aa3BbMR9XOjYKtxxscwyRHN6zmdXuRfJ5uApkHB7cz1laWk2g8RKLzV9qv/fl3RPwfCuoxHQ==" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <!-- Buefy components goes here -->
        <div class="container">
            <b-loading :is-full-page="isFullPage" v-model="isLoading" :can-cancel="true"></b-loading>
            <template>
                <div>
                <div class="field">
                    <p class="control has-icons-left has-icons-right">
                        <input class="input" type="email" placeholder="Email">
                        <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                        </span>
                        <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                        </span>
                    </p>
                </div>
                </div>
            <div id="smart-button-container">
                <div style="text-align: center"><label for="description">Fundraiser By Israel </label><input type="text" name="descriptionInput" id="description" maxlength="127" value=""></div>
                <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
                <div style="text-align: center"><label for="amount">Donation Amount </label><input name="amountInput" type="number" id="amount" value="" ><span> USD</span></div>
                <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
                <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" value="" ></div>
                <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
                <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
            </div>
            </template>


        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <!-- Full bundle -->
    <script src="./buefy/buefy.min.js"></script>


    <script>
    var app = new Vue({
            el: '#app',
            
            data:{
                apiUrl:'',
                isLoading: false,
                isFullPage: true,
                
            },
            watch: {
                
            },
            created(){
                let status;
                this.apiUrl = <?php echo "'".$apiUrl."'" ?>;
            },
            methods: {
                clickMe() {
                    this.$buefy.notification.open('Clicked!!');
                },
                clearIconClick(dataName){
                    app.organization[dataName] = '';
                },
                updatestatus(data){
                    this.dbstatus=data;
                    this.activeStep = data.activeStep;
                },
                postRequest(url, data){
                    const headers = { 
                        "Content-Type": "application/json"
                    };
                    url = this.apiUrl+url;
                    console.log(url);
                    axios.post(url, data, { headers })
                        .then(response =>{ this.checkStatus('/checkstatus'); } );
                }
                openLoading() {
                    this.isLoading = true
                    setTimeout(() => {
                        this.isLoading = false
                    }, 10 * 1000)
                },
            }
        })
    </script>
</body>
</html>

  <script src="https://www.paypal.com/sdk/js?client-id=AaPvXXmEkj1JJonhvdKRSt_nfO5BDid8N1QMlBAb5VOimtFi9DxHRwRrhzmc5N7Vq62fsscSl4rNzUDM&currency=USD" data-sdk-integration-source="button-factory"></script>
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
        color: 'white',
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
            console.log(details);
          alert('Transaction completed by ' + details.payer.name.given_name + '!');
        });
      },

      onError: function (err) {
        console.log(err);
      }
    }).render('#paypal-button-container');
  }
  initPayPalButton();
  </script>