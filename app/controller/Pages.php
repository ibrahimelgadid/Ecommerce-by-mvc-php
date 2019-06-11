<?php 

    class Pages extends Controller {
       
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function index(){
            $data = [
                "title1"=>'Home Page',
            ];
            $this->view('pages.index', $data);
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   about    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function about(){
            $this->view('pages.about', ['title'=> 'About Page']);
        }

    }