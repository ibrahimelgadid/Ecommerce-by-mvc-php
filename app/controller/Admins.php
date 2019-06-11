<?php 

    class Admins extends Controller {
        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> construct  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        private $adminModel;
        private $vkey ;
        public function __construct(){
            
            
            $this->adminModel = $this->model('Admin');
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   login    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function login(){
            $data['title1'] = 'Admin Login';
            Auth::adminGuest();
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['login']){
                Csrf::CsrfToken();
                   $email = $_POST['email'];
                   $password = $_POST['password'];
                  
                   if (empty($email)) {
                        $data['errEmail'] = 'Email Must Has Value.';
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $data['errEmail'] = 'Enter Valid Email';
                    }elseif($this->adminModel->findUserByEmail($email) == false){
                        $data['errEmail'] = 'This Email Is Not Exist';
                    }

                    if (empty($password)) {
                        $data['errPassword'] = "Password Must Has Value.";
                    }

                    if(empty($data['errEmail']) && empty($data['errPassword'])){
                        $admin = $this->adminModel->login($email,$password);
                        if($admin){
                    
                            Session::set('admin_name',$admin->full_name);
                            Session::set('admin_id',$admin->user_id);
                            Redirect::to('admins/dashboard');                           
                        }else {
                            $data['errPassword'] = "Password Not Valid OR not admin";
                            $this->view('admins.login', $data);
                        }
                    }else{
                        $this->view('admins.login', $data);

                    }

            }else {
                $this->view('admins.login',$data);
            }
        }


        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   logout   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function logout(){
            Auth::adminAuth();
            Session::clear('admin_name');
            Session::destroy();
            Redirect::to('admins/login');
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> dashboard  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function dashboard(){
            Auth::adminAuth();
            $data['title1'] = 'Dashboard';
            $arrayName = explode(' ', Session::name('admin_name'));
            $data['admin_name'] = $arrayName[0];
            $this->view('admins.dashboard', $data);
        }


    }
    