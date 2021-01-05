<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./buefy/buefy.min.css">
    <style>
        * {
            font-family: 'Nunito Sans', sans-serif;
        }

        :root {
        --shadowDark: #D9DDE6;
        --background: #ffff;
        --shadowLight: #EFF5FE;
        }

        body {
            background: var(--background);
        }

        .hero-body {
            justify-content: center;
        }

        .login {
            border-radius: 25px;
            padding: 1.5rem;
            box-shadow: 8px 8px 15px var(--shadowDark), -8px -8px 15px var(--shadowLight);
        }

        a {
            font-weight: 600;
        }
    </style>
  </head>

  <body>
    <section class="hero is-fullheight" id="app">
      <div class="hero-body has-text-centered">
        <div class="login">
          <h1 class="title">Login</h1>
          <form method="POST" action="login">
            @csrf
            <b-field class="has-text-left" label="Email">
                <b-input placeholder="email"
                    name="email"
                    type="email"
                    required
                    icon="email">
                </b-input>
            </b-field>
            <b-field class="has-text-left" label="Password">
                <b-input type="password"
                    name="password"
                    placeholder="Password"
                    icon="form-textbox-password"
                    password-reveal>
                </b-input>
            </b-field>
            <br />
            <button class="button is-block is-fullwidth is-primary is-medium" type="submit">
              Login
            </button>
          </form>
          <br>
          <nav class="level">
            <div class="level-item has-text-centered">
              <div>
                <a href="#">Forgot Password?</a>
              </div>
            </div>
            <div class="level-item has-text-centered">
              <div>
                <a href="#">Create an Account</a>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <!-- Full bundle -->
    <script src="./buefy/buefy.min.js"></script>
    <script>
    var app = new Vue({
        el: '#app',
        data:{}
    });
    </script>
  </body>

</html>