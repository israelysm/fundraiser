<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\UserController;
use DB;
use Schema;
use Artisan;

class SetupController extends Controller
{
    private $migrateCount=0;
    private $activeStep=0;
    private $steps=['step1'=>0,'step2'=>0,'step3'=>0];

    protected $OrganizationController;
    protected $UserController;

    public function __construct(OrganizationController $OrganizationController,UserController $UserController)
    {
        $this->OrganizationController = $OrganizationController;
        $this->UserController = $UserController;
    }

    public function setup(){
        //1. check db connection
        //2. check migration completed
        $apiUrl = env('API_URL');
        $data = $this->checkStatus(0);
        return view('setup', ['dbstatus' => $data,'apiUrl'=>$apiUrl]);
    }
    public function checkStatus($isApiCall = 1){
        if($this->checkDbConnection()){
            $this->migrateCount = 0;
            $this->activeStep++;
            $this->steps['step1'] = 1; 
            if($this->checkMigrationCompleted()){
                $data = ['status_code'=>1,'activeStep'=>$this->activeStep,'steps'=>$this->steps,'message'=>'successfully migrated'];
            } else {
                $data=['status_code'=>0,'activeStep'=>$this->activeStep, 'steps'=>$this->steps,'message'=>'migration not completed'];
            }
        } else {
            $data=['status_code'=>0,'activeStep'=>$this->activeStep, 'steps'=>$this->steps,'message'=>'Unable Connect the Database'];
        }

        // Check whether organization is created or not.
        $isOrganizationCreated = $this->OrganizationController->checkOrganizationStatus();
        if($isOrganizationCreated){
            $this->activeStep++;
            $this->steps['step2'] = 1;
            $data = ['status_code'=>1,'activeStep'=>$this->activeStep, 'steps'=>$this->steps,'message'=>'Organization created successfully'];
        } else {
            $data = ['status_code'=>0,'activeStep'=>$this->activeStep, 'steps'=>$this->steps,'message'=>'Organization is not created'];
        }

        //Check the Admin account is created
        $isSuperAdminCreated = $this->UserController->checkAdminAccountStatus();
        if($isSuperAdminCreated){
            $this->steps['step2'] = 1;
            $this->activeStep++;
            $data = ['status_code'=>1,'activeStep'=>$this->activeStep, 'steps'=>$this->steps,'message'=>'SuperAdmin created successfully'];
        } else {
            $data = ['status_code'=>0,'activeStep'=>$this->activeStep, 'steps'=>$this->steps,'message'=>'SuperAdmin is not created'];
        }


        // response 
        if($isApiCall == 1){
            return response()->json($data);
        } else {
            return $data;
        }
        
    }

    public function checkDbConnection(){
        try{
            $hasDb = DB::connection()->getPdo();
            
            if($hasDb)
            {
                //echo "conncted sucessfully to database ".DB::connection()->getDatabaseName();
                return true;
            }
        } catch(\Exception $ex){ 
            $errorMessage = $ex->getMessage(); 
            $errorCode = $ex->getCode();
            // Note any method of class PDOException can be called on $ex.
            return false;
        }
        
        return false;
    }

    public function checkMigrationCompleted(){
        try{
            $hastable = Schema::hasTable('migrations');
            if($hastable){
                try{
                    $hasExists = DB::table('migrations')->where('migration', '2020_12_24_043312_create_transactions_table')->exists();
                } catch(\Illuminate\Database\QueryException $ex){ 
                    $errorMessage = $ex->getMessage(); 
                    // Note any method of class PDOException can be called on $ex.
                    return false;
                }
                if($hasExists){
                    return true;
                } else {
                    $this->makeMigration();
                    return true;
                }
            } else {
                $this->makeMigration();
                return true;
            }
        } catch(\Illuminate\Database\QueryException $ex){ 
            $errorMessage = $ex->getMessage(); 
            // Note any method of class PDOException can be called on $ex.
            return false;
        }
        
        return false;
    }
    public function makeMigration(){
        $hastable = Schema::hasTable('migrations');
        if(!$hastable){
            Artisan::call("migrate");
            $this->migrateCount++;
        }
    }

    public function saveDbSetting(Request $request){
        $dbconnection = $request->input('dbconnection');
        $dbname = $request->input('dbname');
        $host = $request->input('host');
        $port = $request->input('port');
        $username = $request->input('username');
        $password = $request->input('password');
       // putenv("DB_CONNECTION=mysql");
        $this->setEnvironmentValue('DB_CONNECTION', $dbconnection);
        $this->setEnvironmentValue('DB_HOST', $host);
        $this->setEnvironmentValue('DB_PORT', $port);
        $this->setEnvironmentValue('DB_DATABASE', $dbname);
        $this->setEnvironmentValue('DB_USERNAME', $username);
        $this->setEnvironmentValue('DB_PASSWORD', $password);
        //print_r($dbconnection);
    }

    public function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        //$oldValue = strtok($str, "{$envKey}=");
        $oldValue = env($envKey);
        
        if(empty($oldValue)){
            //echo "empty old value";
            $str = str_replace("{$envKey}=", "{$envKey}={$envValue}", $str);
        } else {
            //echo "non empty old value";
            $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);
        }
        

        $fp = fopen($envFile, 'w');
        $res = fwrite($fp, $str);
        fclose($fp);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
