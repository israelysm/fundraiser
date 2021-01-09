
<p align="center">
# Fundraiser
</p>
The fundraiser is an open-source project. It helps the charity to raise funds and organize campaigns with your official website. And It provides a full-fledged admin panel with a plug and playable front-end.
<p align="center">
<img src="https://nanotricks.in/fundraiser/fundraiserlogo.png" width="400">
</p>

## Installation
There are two ways to Install Fundraiser. First one is quick setup using Digital Ocean One Click deploy Button. Another Way is install the application manually.   
### Digital Ocean Deploy Button
#### Step 1: 
Just Click The one click deploy button. 
#### Manual Setup:
#### Step 1:
Download And Install Following Application:

 - [Composer](https://getcomposer.org/)
 - [Git](https://git-scm.com/)
 - [Apache](https://httpd.apache.org/download.cgi) and [Mysql](https://www.mysql.com/downloads/) OR [XAMPP](https://www.apachefriends.org/download.html)
 - CodeEditor

#### Step 2:
Clone the following git repository.

    git clone https://github.com/israelysm/fundraiser.git
#### Step 3:
Then create new environment file copy of .env.example To .env
Linux:

    cp .env.example .env
 Windows:

    copy .env.example .env

#### Step 4:
Update the database configuration in .env file. then check your env file is have SETUP=true or Just add **SETUP=true**
and Check Your Env file Has **API_URL=http://localhost:8000/api** api url otherwise Don't Forget to Add.

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=fundraiser(Your Database Name)
    DB_USERNAME=root(Your Database username)
    DB_PASSWORD=(Your Database password)

#### Step 5:
Then open the command prompt or terminal. Then locate your fundraiser project directory. Then execute the following commands one by one.

    composer install

#### Step 6:
Generate the key using following command

    php artisan key:generate
    php artisan migrate

#### Step 7:
Yeah you all most done. Now open your browser and access fundraiser using your domain name or localhost.

    http://localhost/
    http://example.com
### In-App Setup:
Enter Your Organization and Super Admin detail on following screens
![Organization Detail](https://nanotricks.in/fundraiser/setup2.JPG)
#### Admin account creation
![Admin Account Image](https://nanotricks.in/fundraiser/setup3.JPG)
### Setup Completed
Now You can the application. Just access Your App domain. 

    http://localhost/
    http://example.com
### Login
Enter Your Admin user Login Credentials:
![Login Image](https://nanotricks.in/fundraiser/login.JPG)
#### Dashboard
![dashboard image](https://nanotricks.in/fundraiser/campaign.JPG)
![New Campaign](https://nanotricks.in/fundraiser/newcampaign.JPG)
![donation](https://nanotricks.in/fundraiser/donation.JPG)
![payment image](https://nanotricks.in/fundraiser/payment.JPG)

## How To Integrate With Your Website
Suppose your existing is developed using HTML,WIX,Wordpress,Laravel,Python don’t worry we can you Integrate our component with your website Very easily.

#### Step 1:
Just Copy Paste Following Code inside Your page ** 'head' **

    <link rel="stylesheet" href="./buefy/buefy.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.js" integrity="sha512-otOZr2EcknK9a5aa3BbMR9XOjYKtxxscwyRHN6zmdXuRfJ5uApkHB7cz1laWk2g8RKLzV9qv/fl3RPwfCuoxHQ==" crossorigin="anonymous"></script>

#### Step 2:

And again Copy and Paste the Following line before of Closing Body tag ** 'body' **

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <!-- Full bundle -->
    <script src="./buefy/buefy.min.js"></script>
    <script src="./js/fundraiser.js"></script>

#### Step 3:
And The Final thing just paste the widget code to which section you want to display the Components.

     <div v-if="campaignshow" class="columns is-flex-wrap-wrap">
            <campaigncard v-for="(campaign,index) in campaignlist"
                v-bind="campaign"
                :index="index"
                v-on:donate="openPaymentModal($event)"
                :key="index">
            </campaigncard>
      </div>
      <!-- campaign end -->
      <b-modal 
        v-model="isComponentModalActive"
        has-modal-card
        :can-cancel="false">
        <pay-form v-bind="payForm"></pay-form>
      </b-modal>



### Contributing

Thank you for considering contributing to the Fundraiser! [Israel Ysm](mailto:israelysm@gmail.com.com?subject=fundraiser)


### Security Vulnerabilities

If you discover a security vulnerability within Fundraiser, please send an e-mail to Israel via [israelysm@gmail.com](mailto:israelysm@gmail.com.com). All security vulnerabilities will be promptly addressed.

### License

The Fundraiser is open-sourced software licensed under the [Apache-2.0 License](https://github.com/israelysm/fundraiser/blob/main/LICENSE).
