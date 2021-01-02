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
                                            icon="link-variant">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Host Address">
                                        <b-input placeholder="database.com or 127.0.0.1"
                                            v-model="database.host"
                                            type="text"
                                            required
                                            icon="web">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Port Number">
                                        <b-input placeholder="Port Number"
                                            v-model="database.port"
                                            type="text"
                                            required
                                            icon="passport">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Database Name">
                                        <b-input placeholder="Database Name"
                                            v-model="database.dbname"
                                            type="text"
                                            required
                                            icon="database">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Username">
                                        <b-input placeholder="Username"
                                            v-model="database.username"
                                            type="text"
                                            required
                                            icon="account">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Password">
                                        <b-input type="password"
                                            placeholder="Password"
                                            v-model="database.password"
                                            icon="form-textbox-password"
                                            password-reveal>
                                        </b-input>
                                    </b-field>
                                    <div class=" has-text-centered">
                                        <b-button @click="submitDb" type="is-primary ">Submit</b-button>
                                    </div>
                                </div>
                            </div>
                        </b-step-item>

                        <b-step-item step="2" label="Organization Info" :clickable="isStepsClickable">
                            <div class="columns is-centered">
                                <div v-show="dbstatus.steps.step2 ? true:false" class="column is-4">
                                    <img src="images/animation_done.gif">
                                    <p class="subtitle has-text-centered">Done</p>
                                </div>
                                <div v-show="dbstatus.steps.step2 ? false:true" class="column is-4 ">
                                    <h3 class="subtitle">Organization Details</h3>
                                    <b-field label="Organization Name">
                                        <b-input placeholder="Organization Name"
                                            v-model="organization.name"
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
                                            required
                                            icon="phone"
                                            icon-right="close-circle"
                                            icon-right-clickable
                                            @icon-right-click="clearIconClick('phonenumber')">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Logo">
                                        <b-upload change="imageUpload()" v-model="file" expanded>
                                            <a class="button is-primary is-fullwidth">
                                            <b-icon icon="upload"></b-icon>
                                            <span>@{{ file.name || "Click to upload"}}</span>
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
                                        <b-button @click="submitOrgInfo" type="is-primary ">Submit</b-button>
                                    </div>
                                </div>
                            </div>
                        </b-step-item>

                        <b-step-item step="3" label="Account" :clickable="isStepsClickable" :type="{'is-success': isProfileSuccess}">
                            <div class="columns is-centered">
                                <div v-show="dbstatus.steps.step3 ? true:false" class="column is-4">
                                    <img src="images/animation_done.gif">
                                    <p class="subtitle has-text-centered">Done</p>
                                </div>
                                <div v-show="dbstatus.steps.step3 ? false:true" class="column is-4 ">
                                    <h3 class="subtitle">Admin Account</h3>
                                    <b-field label="Username">
                                        <b-input placeholder="Username"
                                            v-model="adminaccount.username"
                                            type="text"
                                            required
                                            icon="account">
                                        </b-input>
                                    </b-field>

                                    <b-field label="Email">
                                        <b-input placeholder="Email"
                                            v-model="adminaccount.email"
                                            type="email"
                                            required
                                            icon="email"
                                            icon-right="close-circle"
                                            icon-right-clickable
                                            @icon-right-click="clearIconClick('email')">
                                        </b-input>
                                    </b-field>
                                    <b-field label="Password">
                                        <b-input type="password"
                                            placeholder="Password"
                                            v-model="adminaccount.password"
                                            required
                                            icon="form-textbox-password"
                                            password-reveal>
                                        </b-input>
                                    </b-field>
                                    <div class=" has-text-centered">
                                        <b-button @click="submitAdminAccount" type="is-primary ">Submit</b-button>
                                    </div>
                                </div>
                            </div>
                        </b-step-item>

                        <b-step-item step="4" label="Finished" :clickable="isStepsClickable" disabled>
                            <h2 class="title has-text-centered">Finished</h2>
                            <div class="columns is-centered">
                                <div v-show="dbstatus.steps.step3 ? true:false" class="column is-4">
                                    <img src="images/animation_done.gif">
                                    <p class="has-text-centered">That's all setup completed. Amazing things waiting for you</p>
                                    <div class=" has-text-centered mt-2">
                                        <a href="admin"><b-button type="is-primary ">Open My Portal</b-button></a>
                                    </div>
                                </div>
                                <div class="columns is-centered">
                                <div v-show="dbstatus.steps.step3 ? false:true" class="column is-4">
                                    <p class="subtitle has-text-centered">You Should Complete Previous Steps</p>
                                </div>
                            </div>
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
                apiUrl:'',
                dbstatus:@json($dbstatus),
                activeStep: 0,
                isLoading: false,
                isFullPage: true,
                file:{},

                isAnimated: true,
                isRounded: false,
                isStepsClickable: true,

                hasNavigation: false,
                customNavigation: false,
                isProfileSuccess: false,

                mobileMode: 'compact',

                organization:{'name':'','email':'','phonenumber':'','logo':'','address':''},
                database:{'dbconnection':'','host':'','port':'','dbname':'','username':'','password':''},
                adminaccount:{'username':'','email':'','password':''}
            },
            watch: {
                file: function (val) {
                    this.imageUpload();
                }
            },
            created(){
                let status;
                this.apiUrl = <?php echo "'".$apiUrl."'" ?>;
                //if(this.dbstatus.status_code == 1){ status = true; this.activeStep = 1; } else { status = false; }
                this.activeStep= this.dbstatus.activeStep;
                this.updateStepperStatus('db',status);
            },
            methods: {
                clickMe() {
                    this.$buefy.notification.open('Clicked!!');
                },
                updateStepperStatus(stepname,status){
                    console.log('update status');
                },
                clearIconClick(dataName){
                    app.organization[dataName] = '';
                },
                submitDb(){
                    url='/saveDb';
                    data = this.database;
                    this.openLoading();
                    res = this.postRequest(url,data);
                    console.log(res);
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
                },
                checkStatus(url){
                    
                    url = this.apiUrl+url;
                    console.log(url);
                    axios.get(url)
                        .then(response =>{ this.updatestatus(response.data);  this.isLoading = false; console.log(response) } );
                },
                openLoading() {
                    this.isLoading = true
                    setTimeout(() => {
                        this.isLoading = false
                    }, 10 * 1000)
                },
                imageUpload(){
                    //$image = file.name;
                    url = '/imageupload';
                    url = this.apiUrl+url;
                    console.log(this.file);
                    const headers = { headers: {
                        'Content-Type': 'multipart/form-data'
                    }};
                    let formData = new FormData();
                    formData.append('file', this.file);
                    axios.post( url,
                        formData,headers
                        ).then(response => {
                            console.log(response);
                            this.organization.logo = response.data.path;
                            console.log('SUCCESS!!');
                        })
                        .catch(function(){
                            console.log('FAILURE!!');
                    });
                },
                submitOrgInfo(){
                    url='/saveOrg';
                    data = this.organization;
                    this.openLoading();
                    res = this.postRequest(url,data);
                    console.log(res);
                },
                submitAdminAccount(){
                    console.log('submit admin account');
                    url='/adminAccount';
                    data = this.adminaccount;
                    this.openLoading();
                    res = this.postRequest(url,data);
                    console.log(res);
                }
            }
        })
    </script>
</body>
</html>