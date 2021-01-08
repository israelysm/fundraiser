<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./buefy/buefy.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.js" integrity="sha512-otOZr2EcknK9a5aa3BbMR9XOjYKtxxscwyRHN6zmdXuRfJ5uApkHB7cz1laWk2g8RKLzV9qv/fl3RPwfCuoxHQ==" crossorigin="anonymous"></script>
    @yield('style')
    @include('sidemenustyle')
  </head>

  <body>
    <div id="app">
      <div class="columns">
        <div class="column is-3">
        @yield('side-menu')
        </div>
        <div class="column is-8">
        @yield('content')
        </div>
      </div>
      
      
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <!-- Full bundle -->
    <script src="./buefy/buefy.min.js"></script>
    <script>
    
    Vue.use(Buefy);
    Vue.filter('formatDate', function(value){
            if (value) {
              var mydate = new Date(value);
              return mydate.toDateString();
            }
    });
        @yield('template-component')

        var app = new Vue({
            el: '#app',
            components: {
              Buefy,
              @yield('registar-template-component')
            },
            data:{
                apiUrl:'',
                menudata:[{"name":"Dashboard","link":"#"},{"name":"Campaign","link":"#","submenu":[{"name":"Department","link":"departments.php"},{"name":"Center","link":"#"},{"name":"Reasearch","link":"#"},{"name":"Affiliation","link":"#"}]},{"name":"Events","link":"#","submenu":[{"name":"Sport","link":"#"},{"name":"NAAC","link":"#"},{"name":"IQAC","link":"#"},{"name":"Alumni","link":"#"}]},{"name":"Members","link":"#","submenu":[{"name":"University Department","link":"http:\/\/acoe.annauniv.edu"},{"name":"Affiliated Institution","link":"https:\/\/aucoe.annauniv.edu\/index.html"}]},{"name":"Me","link":"#","submenu":[{"name":"Department","link":"#"},{"name":"Center","link":"#"},{"name":"Reasearch","link":"#"},{"name":"Affiliation","link":"#"}]}],
                sidemenudata:[{"name":"Dashboard","link":"#"},{"name":"Campaign","link":"#","submenu":[{"name":"Department","link":"departments.php"},{"name":"Center","link":"#"},{"name":"Reasearch","link":"#"},{"name":"Affiliation","link":"#"}]},{"name":"Events","link":"#","submenu":[{"name":"Sport","link":"#"},{"name":"NAAC","link":"#"},{"name":"IQAC","link":"#"},{"name":"Alumni","link":"#"}]},{"name":"Members","link":"#","submenu":[{"name":"University Department","link":"http:\/\/acoe.annauniv.edu"},{"name":"Affiliated Institution","link":"https:\/\/aucoe.annauniv.edu\/index.html"}]},{"name":"Me","link":"#","submenu":[{"name":"Department","link":"#"},{"name":"Center","link":"#"},{"name":"Reasearch","link":"#"},{"name":"Affiliation","link":"#"}]}],
                menuvisible:false,

                expandOnHover: false,
                mobile: "reduce",
                fullheight:true,
                reduce: false,
                csrf:'',

                @yield('script-data')

            },
            created(){
                @yield('script-created-content')
            },
            methods:{
                @yield('script-method')
            },
        });
        
    </script>
  </body>

</html>