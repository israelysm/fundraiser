<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sample Front Page</title>
    <link rel="stylesheet" href="./buefy/buefy.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.js" integrity="sha512-otOZr2EcknK9a5aa3BbMR9XOjYKtxxscwyRHN6zmdXuRfJ5uApkHB7cz1laWk2g8RKLzV9qv/fl3RPwfCuoxHQ==" crossorigin="anonymous"></script>
  </head>

  <body>
    <div id="app" apiurl='http://localhost:8000/'>
      <!-- campaign start -->
      <h1 class="title has-text-centered">Campaigns</h1>
      <div class="column is-6 pl-0"><button @click="isComponentModalActive = true" class="button is-link is-outlined">New Campaign</button></div>
      <div v-if="campaignshow" class="columns is-flex-wrap-wrap">
            <campaigncard v-for="(campaign,index) in campaignlist"
                v-bind="campaign"
                :index="index"
                v-on:donate="openPaymentModal($event)"
                :key="index"></campaigncard>
      </div>
      <!-- campaign end -->
      <b-modal 
        v-model="isComponentModalActive"
        has-modal-card
        :can-cancel="false">
        <pay-form v-bind="payForm"></pay-form>
    </b-modal>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <!-- Full bundle -->
    <script src="./buefy/buefy.min.js"></script>
    <script src="./js/fundraiser.js"></script>

  </body>

</html>