
var payPayLink = document.createElement('script');  
payPayLink.setAttribute('src','https://www.paypal.com/sdk/js?client-id=AaPvXXmEkj1JJonhvdKRSt_nfO5BDid8N1QMlBAb5VOimtFi9DxHRwRrhzmc5N7Vq62fsscSl4rNzUDM&currency=USD');
document.head.appendChild(payPayLink);

// var payPayCheckoutLink = document.createElement('script');  
// payPayCheckoutLink.setAttribute('src','https://www.paypalobjects.com/api/checkout.js');
// document.head.appendChild(payPayCheckoutLink);


Vue.component('campaigncard', {
    props: ['id','title','ending_date','story','feature_image','amount','target_amount','index'],
    data: function () {
      return {
        
      }
    },
    template: `<div class="column is-4 p-1">
          <div class="card p-0">
              <div class="card-image">
                  <figure class="image is-2by1">
                      <img :src="feature_image" alt="Placeholder image">
                  </figure>
              </div>
              <div class="card-content" style="padding: 3px;">
                  <b-progress :value="75" size="is-small" type="is-success" style="height: 5px; margin-bottom: 0.5rem;"></b-progress>
                  <div class="is-flex is-justify-content-space-between">
                      <div class="is-size-6">{{amount}}INR</div>
                      <div class="is-size-6">{{target_amount}}INR</div>
                  </div>
                  <div class="media m-1">
                      <div class="media-content">
                          <p class="title is-6">{{title}}</p>
                          <p class="subtitle is-6">Ending Date: {{ending_date | formatDate }}</p>
                      </div>
                  </div>
                  <div class="content m-1 is-size-7" style="padding: 3px;">
                      {{story}}
                  </div>
                  <footer class="card-footer">
                      <a href="#" class="card-footer-item is-size-6 has-text-weight-bold cardbtnpadding">Share</a>
                      <a @click="$emit('donate',index)" class="card-footer-item is-size-6 is-primary has-text-weight-bold cardbtnpadding">Donate</a>
                  </footer>
              </div>
          </div>
      </div>`
  });

  
const payForm = {
    props: ['title','apiurl','id','feature_image'],
    data: function(){
        return {
            selected: new Date(),
            showWeekNumber: false,
            locale: undefined,
            file:[],
            campaign:{'id':'','title':'','feature_image':''},
            payment:{'name':'','amount':'','receiptno':'','mobile':'','email':'','campaign_id':''},
            checkout:false,
            moneyFormat: {
              decimal  : '.',
              thousands: ',',
              prefix   : '£ ',
              suffix   : '',
              precision: 2,
              masked   : false 
          },
        }
    },
    mounted(){
        this.campaign.title = this.title;
        this.campaign.feature_image = this.feature_image;
        this.campaign.id = this.id;
        this.payment.campaign_id = this.id;

        console.log('mounted');

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
        actions.enable();

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

    },
    watch: {
        
    },
    methods:{
            submit(){
                //$image = file.name;
                url = 'checkout';
                url = this.apiurl+url;
                console.log(this.file);
                const headers = { headers: {
                    'Content-Type': 'multipart/form-data'
                }};
                let formData = new FormData();
                formData.append('name', this.payment.name);
                formData.append('amount', this.payment.amount);
                formData.append('mobile', this.payment.mobile);
                formData.append('email', this.payment.email);
                formData.append('campaignid', this.payment.campaign_id);
                axios.post( url,
                    formData,headers
                    ).then(response => {
                        console.log(response);
                        this.checkoutResult = response.data;
                        this.payment.receiptno = response.data.receiptno;
                        this.checkout=true;
                        console.log('SUCCESS!!'); 
                    })
                    .catch(function(){
                        console.log('FAILURE!!');
                });
            },

    },
    template: `
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Donation</p>
            </header>
            <section class="modal-card-body">
                <div v-show="!checkout">
                <b-field label="Name">
                    <b-input
                        type="text"
                        v-model="payment.name"
                        placeholder="Enter Your Name"
                        required>
                    </b-input>
                </b-field>
                
                <b-field label="Amount">
                    <b-input
                        type="number"
                        v-model="payment.amount"
                        v-bind="moneyFormat"
                        placeholder="Enter The Amount in USD"
                        required>
                    </b-input>
                </b-field>
                <b-field label="Email">
                    <b-input
                        type="text"
                        v-model="payment.email"
                        placeholder="Enter Your Email ID"
                        required>
                    </b-input>
                </b-field>
                <b-field label="Mobile">
                    <b-input
                        type="text"
                        v-model="payment.mobile"
                        placeholder="Enter the Mobile Number"
                        required>
                    </b-input>
                </b-field>
                <div class="has-text-centered">
                <button @click="submit" class="button is-primary">Submit</button>
                </div>
                </div>
                <div v-show="checkout" id="smart-button-container">
                    <div style="text-align: center visibility: hidden"><label for="description">Receipt No: {{payment.receiptno}}</label><input type="hidden" name="descriptionInput" id="description" maxlength="127" :value="payment.email"></div>
                    <p id="descriptionError" style="visibility: hidden; color:red; text-align: center;">Please enter a description</p>
                    <div style="text-align: center visibility: hidden"><label for="amount" >Donation Amount </label><input  name="amountInput" type="hidden" id="amount" :value="payment.amount" ><span>{{payment.amount}} USD</span></div>
                    <p id="priceLabelError" style="visibility: hidden; color:red; text-align: center;">Please enter a price</p>
                    <div id="invoiceidDiv" style="text-align: center; display: none;"><label for="invoiceid"> </label><input name="invoiceid" maxlength="127" type="text" id="invoiceid" :value="payment.receiptno" ></div>
                    <p id="invoiceidError" style="visibility: hidden; color:red; text-align: center;">Please enter an Invoice ID</p>
                    <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
            </footer>
        </div>
    `
}

  
  Vue.use(Buefy);
  Vue.filter('formatDate', function(value){
          if (value) {
            var mydate = new Date(value);
            return mydate.toDateString();
          }
  });

      var app = new Vue({
          el: '#app',
          components: {
            Buefy,
            payForm,
          },
          data:{
              apiUrl:'',
              campaignshow:false,
              campaignlist:[],
              isComponentModalActive:false,
              payForm:{'title':'','apiurl':'','id':'','feature_image':''}
          },
          mounted(){
              this.apiUrl = this.$el.getAttribute('apiurl');
              if (typeof this.campaignlist !== 'undefined' && this.campaignlist.length > 0) {
                    // the array is defined and has at least one element
                    return this.campaignlist;
                } else {
                    result = this.getCampaign();
                    return result;
                }
          },
          watch: {
              campaignlist: function(){
                  this.campaignlist;
                  console.log('compute:'+JSON.stringify(this.campaignlist));
              }
          },
          methods:{
              getCampaign(){
                    //console.log('Hi'+data);
                    url = 'getcampaign';
                    url = this.apiUrl+url;
                    const headers = { headers: {
                        'Content-Type': 'application/json'
                    }};
                                
                    axios.get( url,
                    headers
                    ).then(response => {
                        // console.log(response);
                        //this.campaign.feature_image = response.data;
                        console.log('SUCCESS!!');
                        if(typeof response.data !== 'undefined' && response.data.length > 0){
                            // console.log(response);
                            this.campaignlist= response.data;
                            this.campaignshow = true;
                        } else {
                            this.$buefy.toast.open({
                                message: 'Data is not Available. Add Data in Your Admin Panel',
                                type: 'is-danger'
                            })
                        }
                        // this.$buefy.toast.open({
                        //         message: 'Campaign Successfully Created!',
                        //         type: 'is-success'
                        //     })
                    })
                    .catch(function(){
                        //code 422 is Vaildation error.
                        this.$buefy.toast.open({
                                message: 'Unable to get data from server!',
                                type: 'is-danger'
                            })
                        console.log('FAILURE!!');
                    });
                },
                openPaymentModal(index){
                    this.payForm.title=this.campaignlist[index].title;
                    this.payForm.feature_image=this.campaignlist[index].feature_image;
                    this.payForm.id=this.campaignlist[index].id;
                    this.payForm.apiurl=this.apiUrl;
                    this.isComponentModalActive=true;
                }
          },
      });
