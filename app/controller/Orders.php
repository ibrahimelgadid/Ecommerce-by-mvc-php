<?php 

    class Orders extends Controller {
        private $orderModel;
        public function __construct(){
            new Session;
            $this->orderModel = $this->model('order');
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function index(){
            Auth::adminAuth();
            $data['title1'] = 'All Orders';
            $data['orders'] = $this->orderModel->getAllOrder();
            $this->view('orders.all', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function show($id){
            Auth::adminAuth();
            $data['order'] = $this->orderModel->show($id);
            $data['shipping'] = $this->orderModel->showShipping($data['order']->shipping_id);
            $data['orderDetails'] = $this->orderModel->getAllOrderDetalails($data['order']->order_id);
            $data['title1'] = 'Order '.$data['order']->order_id;
            $this->view('orders.show', $data);
        }



        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  activate  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->orderModel->activate($id);
            Session::set('success', 'Item has been activated');
            if($activate){
                Redirect::to('orders');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> inactivate <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->orderModel->inActivate($id);
            if($inActivate){
                Session::set('success', 'Item has been inActivated');
                Redirect::to('orders');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function delete($id){
            Auth::adminAuth();
            $delete =  $this->orderModel->delete($id);
            Session::set('success', 'Item has been deleted');
            Redirect::to('orders');
            
        }

    }