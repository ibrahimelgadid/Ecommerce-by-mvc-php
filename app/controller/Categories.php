<?php 

    class Categories extends Controller {
        private $categoryModel;
        public function __construct(){
            new Session;
            $this->categoryModel = $this->model('Category');
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function index(){
            Auth::adminAuth();
            $data['title1'] = 'All Categories';
            $data['categories'] = $this->categoryModel->getAllCat();
            $this->view('categories.all', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function show($id){
            Auth::adminAuth();
            $data['category'] = $this->categoryModel->show($id);
            $data['title1'] = $data['category']->cat_name;


            if($data['category'] && is_numeric($id)){
                $this->view('categories.show', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('categories');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->    add     <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function add(){
        
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Add Catrgory';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addCategory']){
                $cat_name = $_POST['category'];
                $cat_user = Session::name('admin_id');
                $description = $_POST['description'];

                if (strlen($cat_name) < 3) {
                    $data['errCat'] = 'Category name must not be less than 3 characters';
                }elseif($this->categoryModel->findCatName($cat_name) > 0) {
                    $data['errCat'] = 'This name already exist choose anthor one';
                }
                if (strlen($description) < 5) {
                    $data['errDes'] = 'Category description must not be less than 5 characters';
                }

                if(empty($data['errCat']) && empty($data['errDes'])){
                    $this->categoryModel->add($cat_name,$cat_user,$description);
                    Session::set('success', 'New category added successfully');
                    Redirect::to('categories');
                }else {
                    $this->view('categories.add', $data);
                }
            }else {
                $this->view('categories.add', $data);
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   edit    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function edit($id){
            Auth::adminAuth();
            $data['title1'] = 'Edit Category';
            $data['category'] = $this->categoryModel->show($id);
            if($data['category'] && is_numeric($id)){
                $this->view('categories.edit', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('categories');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   update   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function update($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Edit Category';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editCategory']){
                $cat_name = $_POST['category'];
                $cat_id = $_POST['cat_id'];
                $description = $_POST['description'];
                $cat_user = Session::name('admin_id');

                if (strlen($cat_name) < 3) {
                    $data['errCat'] = 'Category name must not be less than 3 characters';
                }elseif($this->categoryModel->findCatName($cat_name,$cat_id) > 0) {
                    $data['errCat'] = 'This name already exist choose anthor one';
                }

                if (strlen($description) < 5) {
                    $data['errDes'] = 'Category description must not be less than 5 characters';
                }

                if(empty($data['errCat']) && empty($data['errDes'])){
                    $this->categoryModel->update($id, $cat_name,$description);
                    Session::set('success', 'Category has been edited successfully');
                    Redirect::to('categories');
                }else {
                    $data['category'] = $this->categoryModel->show($id);
                    $this->view('categories.edit', $data);
                }

            }else {
                Redirect::to('categories');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  activate  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->categoryModel->activate($id);
            Session::set('success', 'Item has been activated');
            if($activate){
                Redirect::to('categories');
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> inactivate <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->categoryModel->inActivate($id);
            if($inActivate){
                Session::set('success', 'Item has been inActivated');
                Redirect::to('categories');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> search <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function search(){
            Auth::adminAuth();
            $data['title1'] = 'All Categories';
            $searched = $_POST['search'];
            $results = $this->categoryModel->search($searched);
            $data['categories'] = $results;
            $this->view('categories.search', $data);
            
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function delete($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Item has been deleted');
            $delete =  $this->categoryModel->delete($id);
            if($delete){
                Redirect::to('categories');
            }
        }

    }