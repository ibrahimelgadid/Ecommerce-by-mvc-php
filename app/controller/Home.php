<?php 

    class Home extends Controller {


        private $categoryModel;
        private $manufactureModel;
        private $productModel;

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  construct <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function __construct(){
            new Session;
            $this->categoryModel = $this->model('Category');
            $this->manufactureModel = $this->model('Manufacture');
            $this->productModel = $this->model('Product');
        }
       
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function index(){
            $data['title1'] = 'Home';
            $data['categories'] = $this->categoryModel->getAllCat(1);
            $data['manufactures'] = $this->manufactureModel->getAllMan(1);
            $data['products'] = $this->productModel->getAllPro(1);
            $this->view('front.index', $data);
        }



        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> search <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function search(){
            $data['title1'] = 'Products';
            $searched = $_POST['search'];
            $data['categories'] = $this->categoryModel->getAllCat(1);
            $data['manufactures'] = $this->manufactureModel->getAllMan(1);
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $results = $this->productModel->search($searched);
                $data['products'] = $results;
                $this->view('front.index', $data);
            }else {
                Redirect::to('home');
            }
            
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  By Categ  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function getProByCat($cat_id){
            $data['categories'] = $this->categoryModel->getAllCat(1);
            $data['manufactures'] = $this->manufactureModel->getAllMan(1);
            $data['category'] = $this->categoryModel->show($cat_id);
            $data['products'] = $this->productModel->getProByCat($cat_id);
            
            $data['title1'] = $data['category']->cat_name;

            if($data['category'] && is_numeric($cat_id)){
                $this->view('front.ProCategory', $data);
            }else {
                Session::set('danger', 'this item not exist');
                Redirect::to('home');
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  By Categ  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function getProByMan($man_id){
            $data['categories'] = $this->categoryModel->getAllCat(1);
            $data['manufactures'] = $this->manufactureModel->getAllMan(1);
            $data['manufacture'] = $this->manufactureModel->show($man_id);
            $data['products'] = $this->productModel->getProByMan($man_id);
            
            $data['title1'] = $data['manufacture']->man_name;

            if($data['manufacture'] && is_numeric($man_id)){
                $this->view('front.ProManufacture', $data);
            }else {
                Session::set('danger', 'this item not exist');
                Redirect::to('home');
            }
            $this->view('front.ProManufacture', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function show($id){
            $data['product'] = $this->productModel->show($id);
            $data['title1'] = $data['product']->name;
            $data['gallary'] = $this->productModel->getGallary($id);
            if($data['product'] && is_numeric($id)){
                $this->view('front.details', $data);
            }else {
                Session::set('danger', 'this item not exist');
                Redirect::to('home');
            }
            
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   about    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function about(){
            $this->view('front.about', ['title'=> 'About Page']);
        }

    }