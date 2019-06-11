<?php 

    class Products extends Controller {
        private $productModel;
        private $categoryModel;
        private $manufactureModel;
        public function __construct(){
            new Session;
            $this->productModel = $this->model('Product');
            $this->categoryModel = $this->model('Category');
            $this->manufactureModel = $this->model('Manufacture');
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function index(){
            Auth::adminAuth();
            $data['title1'] = 'All Products';
            $data['products'] = $this->productModel->getAllPro();
            $this->view('products.all', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function show($id){
            Auth::adminAuth();
            $data['product'] = $this->productModel->show($id);
            $data['title1'] = $data['product']->name;
            $data['gallary'] = $this->productModel->getGallary($id);
            if($data['product'] && is_numeric($id)){
                $this->view('products.show', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('products');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->    add     <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function add(){
        
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Add Product';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addProduct']){
                $name = $_POST['name'];
                $man = $_POST['man'];
                $cat = $_POST['cat'];
                $price = $_POST['price'];
                $color = $_POST['color'];
                $size = $_POST['size'];
                $user = Session::name('admin_id');
                $description = $_POST['description'];
                $pro_img = $_FILES['image']['name'];
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
                
                
                if (strlen($name) < 3) {
                    $data['errName'] = 'product name must not be less than 3 characters';
                }elseif($this->productModel->findProName($name) > 0) {
                    $data['errName'] = 'This name already exist choose anthor one';
                }
                if (strlen($description) < 5) {
                    $data['errDes'] = 'product description must not be less than 5 characters';
                }
                if ($man == "Choose...") {
                    $data['errMan'] = 'You must choose brand for this product';
                }
                if ($cat== "Choose...") {
                    $data['errCat'] = 'You must choose category for this product';
                }
                

                if(empty($data['errCat']) && empty($data['errDes']) 
                && empty($data['errMan']) && empty($data['errPrice'])
                && empty($data['errName'])&& empty($data['errImg'])){

                    
                    move_uploaded_file($pro_tmp, $uploaddir.$pro_img);

                    $this->productModel->add($name,$description,$user,$cat,$man,$pro_img,$price,$size,$color);
                    Session::set('success', 'New product added successfully');
                    Redirect::to('products');
                }else {
                    $data['cat'] = $this->categoryModel->getAllCat();
                    $data['man'] = $this->manufactureModel->getAllMan();
                    $this->view('products.add', $data);
                }
             }else {
                 $data['cat'] = $this->categoryModel->getAllCat();
                 $data['man'] = $this->manufactureModel->getAllMan();
                 $this->view('products.add',$data);
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   edit    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function edit($id){
            Auth::adminAuth();
            $data['title1'] = 'Edit Product';
            $data['product'] = $this->productModel->show($id);
            $data['man'] = $this->manufactureModel->getAllMan();
            $data['cat'] = $this->categoryModel->getAllCat();
            if($data['product'] && is_numeric($id)){
                $this->view('products.edit', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('products');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   update   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function update($id){
        
            Auth::adminAuth();
            Csrf::CsrfToken();
            $data['title1'] = 'Edit Product';
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editProduct']){
                $name = $_POST['name'];
                $man = $_POST['man'];
                $cat = $_POST['cat'];
                $price = $_POST['price'];
                $color = $_POST['color'];
                $size = $_POST['size'];
                $id  = $_POST['product_id'];
                $user = Session::name('admin_id');
                $description = $_POST['description'];
                $oldImg = $_POST['oldImg'];

                $pro_img = $_FILES['image']['name'];
                $pro_tmp = $_FILES['image']['tmp_name'];
                $pro_type = $_FILES['image']['type'];
                if(!empty($pro_img)){
                    
                    $uploaddir = dirname(ROOT).'\public\uploads\\' ;
                    unlink($uploaddir.$oldImg);
                    $pro_img = explode('.',$pro_img);
                    $pro_img_ext = $pro_img[1];
                    $pro_img = $pro_img[0].time().'.'.$pro_img[1];

                    if($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg"
                        && $pro_img_ext != "gif" ) {
                            $data['errImg']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        }
                }else {
                    $pro_img = $oldImg;
                }
                
                if (strlen($name) < 3) {
                    $data['errName'] = 'product name must not be less than 3 characters';
                }elseif($this->productModel->findProName($name,$id) > 0) {
                    $data['errName'] = 'This name already exist choose anthor one';
                }
                if (strlen($description) < 5) {
                    $data['errDes'] = 'product description must not be less than 5 characters';
                }
                if ($man == "Choose...") {
                    $data['errMan'] = 'You must choose brand for this product';
                }
                if ($cat== "Choose...") {
                    $data['errCat'] = 'You must choose category for this product';
                }

                if (empty($price)) {
                    $data['errPrice'] = 'Price must has number';
                }

                

                if(empty($data['errCat']) && empty($data['errDes']) 
                && empty($data['errMan']) && empty($data['errPrice'])
                && empty($data['errName'])){

                    move_uploaded_file($pro_tmp, $uploaddir.$pro_img);

                    $this->productModel->update($id,$name,$description,$user,$pro_img,$cat,$man,$price,$size,$color);
                    Session::set('success', 'Product edited successfully');
                    Redirect::to('products');
                }else {
                    $data['product'] = $this->productModel->show($id);
                    $data['cat'] = $this->categoryModel->getAllCat();
                    $data['man'] = $this->manufactureModel->getAllMan();
                    $this->view('products.edit', $data);
                }
            }else {
                $data['product'] = $this->productModel->show($id);
                $data['cat'] = $this->categoryModel->getAllCat();
                $data['man'] = $this->manufactureModel->getAllMan();
                $this->view('products.edit',$data);
            }
        }



        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  activate  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->productModel->activate($id);
            Session::set('success', 'Item has been activated');
            if($activate){
                Redirect::to('products');
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> inactivate <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->productModel->inActivate($id);
            if($inActivate){
                Session::set('success', 'Item has been inActivated');
                Redirect::to('products');
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function delete($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Item has been deleted');
            $delete =  $this->productModel->delete($id);
            if($delete){
                Redirect::to('products');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->upload images<--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function upload_images($id){
            Auth::adminAuth();
            $pro_img = $_FILES['file']['name'];
            $pro_tmp= $_FILES['file']['tmp_name'];
            if(!empty($pro_img)){
                $data['product'] = $this->productModel->show($id);
                $uploaddir = dirname(ROOT).'\public\uploads\\'.$data['product']->product_id.'\\';
                if(!file_exists($uploaddir)){
                    mkdir($uploaddir);
                }
                $pro_img = explode('.',$pro_img);
                $pro_img_ext = $pro_img[1];
                $pro_img = $pro_img[0].time().'.'.$pro_img[1];

                if($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg"
                    && $pro_img_ext != "gif" ) {
                        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }else {
                        move_uploaded_file($pro_tmp,$uploaddir.$pro_img);
                        // echo $pro_img;
                        $this->productModel->addGallary($id,$pro_img);
                    }
            }else {
                echo 'You must choose an image';
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->delete image<--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function deleteGallaryImage($image_id,$pro_id,$name){
            Auth::adminAuth();
            $image= dirname(ROOT).'\public\uploads\\'.$pro_id.'\\'.$name;
            Session::set('success', 'Image has been deleted');
            $delete =  $this->productModel->deleteGallaryImage($image_id);
            unlink($image);
            if($delete){
                Redirect::back();
            
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>>>*/
        #<--->delete gallary<--->#
        /*<<<<<<<<<<<<<<<<<<<<<<*/
        public function deleteGallary($id){
            Auth::adminAuth();
            Session::set('success', 'Gallary has been deleted');
            $delete =  $this->productModel->deleteGallary($id);
            $img_dir= dirname(ROOT).'\public\uploads\\'.$id;
            $images = scandir($img_dir);
            foreach ($images as $image) {
                if(is_file($img_dir . '\\'. $image)){
                    unlink($img_dir . '\\'. $image);
                    rmdir($img_dir);
                }
            }
            
            if($delete){
                Redirect::back();
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> search <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function search(){
            Auth::adminAuth();
            $data['title1'] = 'All Products';
            $searched = $_POST['search'];
            $results = $this->productModel->search($searched);
            $data['products'] = $results;
            $this->view('products.search', $data);
            
        }
    }