<?php 

    class Users extends Controller {

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  construct <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        private $userModel;
        private $cartModel;

        private $vkey ;
        public function __construct(){
            new Session();
            $this->userModel = $this->model('User');
            $this->cartModel = $this->model('Cart');
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  register  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function register(){
            Auth::userGuest();
            $data['title1'] = 'Register';
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($_POST['register']){
                   $fullname = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
                   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                   $password = $_POST['password'];
                   $hashedPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);
                   $password2 = $_POST['password2'];

                   $vkey = time();
                   $vkey = md5($vkey);
                   $vkey = str_shuffle($vkey);

                   if (empty($fullname)) {
                       $data['errName'] = 'Name Must Has Value.';
                   }
                //    elseif (strlen($fullname) < 4) {
                //         $data['errName'] = 'Name Must Not Less Than 4 Characters';
                //    }

                   if (empty($email)) {
                        $data['errEmail'] = 'Email Must Has Value.';
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $data['errEmail'] = 'Enter Valid Email';
                    }
                    elseif($this->userModel->findUserByEmail($email)){
                        $data['errEmail'] = 'This Email is Already Exists';
                    }


                    if (strlen($password) < 1) {
                        $data['errPassword'] = "Your Password Must Contain At Least 8 Characters!";
                    }
                    // elseif(!preg_match("#[0-9]+#",$password)) {
                    //      $data['errPassword'] = "Your Password Must Contain At Least 1 Number!";
                    // }
                    // elseif(!preg_match("#[A-Z]+#",$password)) {
                    //      $data['errPassword'] = "Your Password Must Contain At Least 1 Capital Letter!";
                    // }
                    // elseif(!preg_match("#[a-z]+#",$password)) {
                    //      $data['errPassword'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
                    // } 
                        


                    if ($password != $password2) {
                        $data['errPassword2'] = 'Password not match';
                    }
                    if(empty($data['errEmail']) && empty($data['errName']) && empty($data['errPassword'])&& empty($data['errPassword2'])){
                        $img = 'noimage.png';
                        $this->userModel->register($fullname,$email,$img,$hashedPassword,$vkey);
                        Session::set('success','You can confirm now');
                        Session::set('email',$email);
                        sendCode($vkey, $email);
                        Redirect::to('users/confirm');
                       exit();
                    }else{
                        $this->view('users.register', $data);
                    }
                }
            }else{
                
                $this->view('users.register',$data);
            }

        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->    update  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function update($id){
            Auth::userAuth();
            $data['title1'] = 'Edit Profile';
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($_POST['editProfile']){
                    $fullname = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $password = $_POST['password'];
                    $oldPass = $_POST['oldPass'];
                    $hashedPassword = password_hash($_POST['password'],PASSWORD_DEFAULT);
                  
                   if (empty($fullname)) {
                       $data['errName'] = 'Name Must Has Value.';
                   }
                //    elseif (strlen($fullname) < 4) {
                //         $data['errName'] = 'Name Must Not Less Than 4 Characters';
                //    }

                if(empty($password)){
                    $hashedPassword = $oldPass;
                }

                   if (empty($email)) {
                        $data['errEmail'] = 'Email Must Has Value.';
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $data['errEmail'] = 'Enter Valid Email';
                    }
                    elseif($this->userModel->findUserByEmail($email,$id)){
                        $data['errEmail'] = 'This Email is Already Exists';
                    }


                    if(empty($data['errEmail']) && empty($data['errName']) && empty($data['errPassword'])){
                        $this->userModel->update($id,$fullname,$email,$hashedPassword);
                        Session::set('user_name',$fullname);
                        Session::set('success','Your Profile has been edited');
                        Redirect::to('users/profile');
                       
                    }else{
                        $data['user'] = $this->userModel->show($id);
                        $this->view('users.edit', $data);
                    }
                }
            }else{
                $data['user'] = $this->userModel->show($id);
                $this->view('users.edit', $data);
            }

        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   login    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function login(){
            Auth::userGuest();
            $data['title1'] = 'Login';
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($_POST['login']){
                   $email = $_POST['email'];
                   $password = $_POST['password'];
                  
                   if (empty($email)) {
                        $data['errEmail'] = 'Email Must Has Value.';
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $data['errEmail'] = 'Enter Valid Email';
                    }elseif($this->userModel->findUserByEmail($email) == false){
                        $data['errEmail'] = 'This Email Is Not Exist';
                    }

                    if (empty($password)) {
                        $data['errPassword'] = "Password Must Has Value.";
                    }

                    if(empty($data['errEmail']) && empty($data['errPassword'])){
                        $user = $this->userModel->login($email,$password);
                        if($user){
                           if($this->userModel->notVerified($email)){
                               Session::set('email', $email);
                               Session::set('danger', "Verify Your account firstly <a href='".URL."/users/confirm'>Confirm Now</a>");
                                $this->view('users.login', $data);
                           }else {
                               Session::set('user_id',$user->user_id);
                                $cartItems = 0;
                                $carts = $this->cartModel->getAllCart();
                                if($carts){
                                    foreach ($carts as $cart) {
                                       $cartItems = $cartItems +  $cart->qty;
                                    }
                                }else {
                                    $cartItems = 0;
                                }
                                Session::set('user_img',$user->image);
                                Session::set('user_cart', $cartItems );                                Session::set('user_name',$user->full_name);
                                Redirect::to('users/profile');
                           };
                        }else {
                            $data['errPassword'] = "Password Not Valid";
                            $this->view('users.login', $data);
                        }
                    }else{
                        
                        $this->view('users.login', $data);
                    }
                }
            }else {
                $this->view('users.login',$data);
            }
        }


        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   logout    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function logout(){
            Auth::userAuth();
            Session::clear('user_name');
            Session::clear('user_id');
            Session::destroy();
            Redirect::to('users/login');
        }




        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> add avatar <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function avatar($id){
        
            Auth::userAuth();
            $data['title1'] = 'Edit Avatar';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addAvatar']){

                echo $pro_img = $_FILES['image']['name'];
                $pro_tmp = $_FILES['image']['tmp_name'];
                $pro_type = $_FILES['image']['type'];
                if(!empty($pro_img)){
                    $uploaddir = dirname(ROOT).'\public\uploads\\' ;
                    $pro_img = explode('.',$pro_img);
                    $pro_img_ext = $pro_img[1];
                    $pro_img = $pro_img[0].time().'.'.$pro_img[1];

                    if($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg"
                        && $pro_img_ext != "gif" ) {
                            $data['errImg']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        }
                }else {
                    $data['errImg'] = 'You must choose an image';
                }
                

                if(empty($data['errImg'])){
                    move_uploaded_file($pro_tmp, $uploaddir.$pro_img);
                    unlink($uploaddir.Session::name('user_img'));
                    $this->userModel->avatar($id,$pro_img);
                    Session::set('user_img',$pro_img );
                    Session::set('success', 'Your avatar has been uploaded successfully');
                    Redirect::to('users/profile');
                }else {
                    $this->view('users.avatar', $data);
                }
             }else {
                 $this->view('users.avatar',$data);
            }
        }



        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   confirm  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function confirm($v=null){
            Auth::userGuest();
            $data['title1'] = 'Confirm';
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($_POST['confirm']){
                   $vkey = $_POST['vkey'];
                   $email = Session::name('email');

                   if (empty($vkey)) {
                        $data['errVkey'] = 'This Input Must Has Value.';
                    }

                    if(empty($data['errVkey'])){
                        $confirm =$this->userModel->selectVkey($email, $vkey);
                       if($confirm){
                        
                            Session::set('success','Your account has been confirmed');
                            Session::clear('email');
                            Redirect::to('users/login');
                            
                        }else {
                            $data = [
                                'err'=>'<div class="alert alert-danger">This code not correct</div>'
                            ];
                            $this->view('users.confirm', $data);
                        }
                    }else{
                        $this->view('users.confirm', $data);
                    }
                }
            }elseif($v != null && !empty($v)) {
                $vkey = $v;
                $email = Session::name('email');
                $confirm =$this->userModel->selectVkey($email, $vkey);
                if($confirm){
                    Session::set('success','Your account has been confirmed');
                    Session::set('user_id',$confirm->user_id);
                    Session::set('user_name',$confirm->full_name);
                    Session::set('user_img',$confirm->image);
                    Session::clear('email');
                    Redirect::to('users/profile');
                }
            }else {
                if(Session::name('email') != null && Session::name('email') != '' ){
                    $this->view('users.confirm',$data);
                }else{
                    Redirect::to('users/login');
                }
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>>>>>*/
        #<---> forgotPassword <--->#
        /*<<<<<<<<<<<<<<<<<<<<<<<<*/
        public function forgotPassword($g=null){
            Auth::userGuest();
            $data['title1'] = 'Forgot Password';
            $this->vkey = time();
            $this->vkey = md5($this->vkey);
            $vkey = $this->vkey = str_shuffle($this->vkey);
            if($_SERVER['REQUEST_METHOD']=="POST"){
                if(isset($_POST['forgotPassword'])){
                    $email = $_POST['email'];
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    
                    if($this->userModel->forgotP($email,$vkey)){
                        // echo $vkey;
                        sendpass($email,$vkey);
                        Session::set('success', 'please Check Your Email Inbox');
                        Redirect::to('users/forgotPassword');
                    }else{
                        $data['err'] = '<div class="alert alert-danger">please Check Your Inputs</div>';
                        $this->view('users.forgotPassword', $data);
                    };
                }
            }else {
                    $this->view('users/forgotPassword',$data);
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>>>>*/
        #<---> resetPassword <--->#
        /*<<<<<<<<<<<<<<<<<<<<<<<*/
        public function resetPassword($vkey){
            Auth::userGuest();
            $data['title1'] = 'Reset Password';
            if($_SERVER['REQUEST_METHOD']=="POST"){
                if(isset($_POST['newPassword'])){
                    $password = $_POST['password'];
                    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
                    if (strlen($password) == 0) {
                        $data['errPassword'] = "Your Password Must Contain At Least 8 Characters!";
                    }
                    // elseif(!preg_match("#[0-9]+#",$password)) {
                    //      $data['errPassword'] = "Your Password Must Contain At Least 1 Number!";
                    // }
                    // elseif(!preg_match("#[A-Z]+#",$password)) {
                    //      $data['errPassword'] = "Your Password Must Contain At Least 1 Capital Letter!";
                    // }
                    // elseif(!preg_match("#[a-z]+#",$password)) {
                    //      $data['errPassword'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
                    // } 

                    if(empty($data['errPassword'])){
                        if($this->userModel->resetP($vkey,$hashedPassword)){
                            sendpass($email,$vkey);
                            Session::set('danger', 'Please login with new password');
                            Redirect::to('users/login');
                        }else{
                            $data['err'] = '<div class="alert alert-danger">please Check Your Inputs</div>';
                            $this->view('users.resetPassword', $data);
                        };
                    }else {
                        $this->view('users.resetPassword', $data);
                    }
                }
            }else {
                $data = ['vkey'=>$vkey];
                    $this->view('users.resetPassword',$data);
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  profile   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function profile(){
            Auth::userAuth();
            $data['title1'] = 'Profile';
            $name = Session::name('user_name');
            $user_id = Session::name('user_id');
            $user = $this->userModel->userData($name,$user_id);
            
            $data['user'] = $user;
            if(Session::existed('email')){
                Session::clear('email');
            }
            $this->view('users.profile', $data);
            
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   edit     <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function edit($id){
            Auth::userAuth();
            $data['title1'] = 'Edit Profile';
            $data['user'] = $this->userModel->show($id);
            if($data['user'] && is_numeric($id)){
                $this->view('users.edit', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('users');
            }
        }

    }