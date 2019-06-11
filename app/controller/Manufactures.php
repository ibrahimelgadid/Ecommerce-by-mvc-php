<?php 

    class Manufactures extends Controller {
        private $manufactureModel;
        public function __construct(){
            new Session;
            $this->manufactureModel = $this->model('Manufacture');
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function index(){
            Auth::adminAuth();
            $data['title1'] = 'All Brands';
            $data['manufactures'] = $this->manufactureModel->getAllMan();
            $this->view('manufactures.all', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> search <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function search(){
            Auth::adminAuth();
            $data['title1'] = 'All Brands';
            $searched = $_POST['search'];
            $results = $this->manufactureModel->search($searched);
            $data['manufactures'] = $results;
            $this->view('manufactures.search', $data);
            
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function show($id){
            Auth::adminAuth();
            $data['manufacture'] = $this->manufactureModel->show($id);
            $data['title1'] = $data['manufacture']->man_name;
            if($data['manufacture'] && is_numeric($id)){
                $this->view('manufactures.show', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('manufactures');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->    add    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function add(){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Add Brand';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addManufacture']){
                $man_name = $_POST['manufacture'];
                $man_user = Session::name('admin_id');
                $description = $_POST['description'];

                if (strlen($man_name) < 3) {
                    $data['errMan'] = 'manufacture name must not be less than 3 characters';
                }elseif($this->manufactureModel->findManName($man_name) > 0) {
                    $data['errMan'] = 'This name already exist choose anthor one';
                }
                if (strlen($description) < 5) {
                    $data['errDes'] = 'manufacture description must not be less than 5 characters';
                }

                if(empty($data['errMan']) && empty($data['errDes'])){
                    $this->manufactureModel->add($man_name,$man_user,$description);
                    Session::set('success', 'New manufacture added successfully');
                    Redirect::to('manufactures');
                }else {
                    $this->view('manufactures.add', $data);
                }
            }else {
                $this->view('manufactures.add',$data);
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   edit     <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function edit($id){
            Auth::adminAuth();
            $data['title1'] = 'Edit Brand';
            $data['manufacture'] = $this->manufactureModel->show($id);
            if($data['manufacture'] && is_numeric($id)){
                $this->view('manufactures.edit', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('manufactures');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   update   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function update($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Edit Brand';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editManufacture']){
                $man_name = $_POST['manufacture'];
                $man_id = $_POST['man_id'];
                $description = $_POST['description'];
                $man_user = Session::name('admin_id');

                if (strlen($man_name) < 3) {
                    $data['errMan'] = 'manufacture name must not be less than 3 characters';
                }elseif($this->manufactureModel->findManName($man_name,$man_id) > 0) {
                    $data['errMan'] = 'This name already exist choose anthor one';
                }

                if (strlen($description) < 5) {
                    $data['errDes'] = 'manufacture description must not be less than 5 characters';
                }

                if(empty($data['errMan']) && empty($data['errDes'])){
                    $this->manufactureModel->update($id, $man_name,$description);
                    Session::set('success', 'manufacture has been edited successfully');
                    Redirect::to('manufactures');
                }else {
                    $data['manufacture'] = $this->manufactureModel->show($id);
                    $this->view('manufactures.edit', $data);
                }

            }else {
                Redirect::to('manufactures');
            }
        }



        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  activate  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->manufactureModel->activate($id);
            Session::set('success', 'Item has been activated');
            if($activate){
                Redirect::to('manufactures');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> inactivate <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->manufactureModel->inActivate($id);
            if($inActivate){
                Session::set('success', 'Item has been inActivated');
                Redirect::to('manufactures');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function delete($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Item has been deleted');
            $delete =  $this->manufactureModel->delete($id);
            if($delete){
                Redirect::to('manufactures');
            }
        }

    }