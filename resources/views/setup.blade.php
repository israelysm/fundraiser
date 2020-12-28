<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fundraiser Setup</title>
    <link rel="stylesheet" href="./buefy/buefy.min.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css">
</head>

<body>
    <div id="app">
        <!-- Buefy components goes here -->
        <div class="container">
            <template>
                <section class="m-4">
                <h1 class="is-size-1 m-4 has-text-centered">Setup</h1>
                    <b-steps
                        v-model="activeStep"
                        :animated="isAnimated"
                        :rounded="isRounded"
                        :has-navigation="hasNavigation"
                        :mobile-mode="mobileMode">
                        <b-step-item step="1" label="Database" :clickable="isStepsClickable" :type="{'is-success': isProfileSuccess}">
                            <div class="columns is-centered">
                                <div v-show="dbstatus.steps.step1 ? true:false" class="column is-4">
                                    <img src="images/animation_done.gif">
                                    <p class="subtitle has-text-centered">Done</p>
                                </div>
                                <div v-show="dbstatus.steps.step1 ? false:true" class="column is-4 ">
                                    <h2 class="title has-text-centered">Database</h2>
                                    <b-field label="Database Connection">
                                        <b-input placeholder="mysql,pgsql"
                                            v-model="database.dbconnection"
                                            type="text"
                                            required
                                            icon="store">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Host Address">
                                        <b-input placeholder="database.com or 127.0.0.1"
                                            v-model="database.host"
                                            type="text"
                                            required
                                            icon="store">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Port Number">
                                        <b-input placeholder="Port Number"
                                            v-model="database.port"
                                            type="text"
                                            required
                                            icon="store">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Database Name">
                                        <b-input placeholder="Database Name"
                                            v-model="database.dbname"
                                            type="text"
                                            required
                                            icon="store">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Username">
                                        <b-input placeholder="Username"
                                            v-model="database.username"
                                            type="text"
                                            required
                                            icon="store">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Password">
                                        <b-input type="password"
                                            v-model="database.password"
                                            password-reveal>
                                        </b-input>
                                    </b-field>
                                    <div class=" has-text-centered">
                                        <b-button type="is-primary ">Submit</b-button>
                                    </div>
                                </div>
                            </div>
                        </b-step-item>

                        <b-step-item step="2" label="Organization Info" :clickable="isStepsClickable">
                            <div class="columns is-centered">
                                <div class="column is-4 ">
                                    <h3 class="subtitle">Organization Details</h3>
                                    <b-field label="Organization Name">
                                        <b-input placeholder="Organization Name"
                                            v-model="organization.orgname"
                                            type="text"
                                            required
                                            icon="store">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Contact Email">
                                        <b-input placeholder="Email"
                                            v-model="organization.email"
                                            type="email"
                                            required
                                            icon="email"
                                            icon-right="close-circle"
                                            icon-right-clickable
                                            @icon-right-click="clearIconClick('email')">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Contact Phone Number">
                                        <b-input placeholder="Phone Number"
                                            v-model="organization.phonenumber"
                                            type="number"
                                            min="7"
                                            max="18"
                                            required
                                            icon="phone"
                                            icon-right="close-circle"
                                            icon-right-clickable
                                            @icon-right-click="clearIconClick('phonenumber')">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Logo">
                                        <b-upload v-model="organization.file" expanded>
                                            <a class="button is-primary is-fullwidth">
                                            <b-icon icon="upload"></b-icon>
                                            <span>@{{ organization.file.name || "Click to upload"}}</span>
                                            </a>
                                        </b-upload>
                                    </b-field>
                                    <b-field label="Address">
                                        <b-input placeholder="Address"
                                            v-model="organization.address"
                                            type="textarea"
                                            required
                                            icon="location">
                                        </b-input>
                                    </b-field>
                                    <div class=" has-text-centered">
                                        <b-button type="is-primary ">Submit</b-button>
                                    </div>
                                </div>
                            </div>
                        </b-step-item>

                        <b-step-item step="3" label="Account" :clickable="isStepsClickable" :type="{'is-success': isProfileSuccess}">
                            <h2 class="title has-text-centered">Admin Account</h2>
                            Lorem ipsum dolor sit amet.
                        </b-step-item>

                        <b-step-item step="4" label="Email" :clickable="isStepsClickable" disabled>
                            <h2 class="title has-text-centered">Eamil Setup</h2>
                            Lorem ipsum dolor sit amet.
                        </b-step-item>
                    </b-steps>
                </section>
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
                dbstatus:@json($dbstatus),
                activeStep: 0,

                isAnimated: true,
                isRounded: false,
                isStepsClickable: true,

                hasNavigation: false,
                customNavigation: false,
                isProfileSuccess: false,

                mobileMode: 'compact',

                organization:{'orgname':'','email':'','phonenumber':'','file':{},'address':''},
                database:{'dbconnection':'','host':'','port':'','dbname':'','username':'','password':''}
            },
            created(){
                let status;
                //if(this.dbstatus.status_code == 1){ status = true; this.activeStep = 1; } else { status = false; }
                this.activeStep= this.dbstatus.activeStep;
                this.updateStepperStatus('db',status);
            },
            methods: {
                clickMe() {
                    this.$buefy.notification.open('Clicked!!')
                },
                updateStepperStatus(stepname,status){
                    console.log('update status');
                },
                clearIconClick(dataName){
                    app.organization[dataName] = '';
                },
                postRequest(url, data){
                    const headers = { 
                        "Content-Type": "application/json"
                    };
                    axios.post("https://reqres.in/api/articles", article, { headers })
                        .then(response =>{ return response } );
                }
            }
        })
    </script>
</body>
</html>