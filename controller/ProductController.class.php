<?php

    class ProductController extends BaseController
    {

        protected function before() {
            $this->heading = "Product";
            $this->title .= " | " . $this -> heading;
            $this->view = "product";
            $this->bc = array(
                "visible" => "",
                "first" => "Products",
                "second" => "Men",
                "last" => "Product name"
            );
            $this -> menu = array(
                'find' => true,
                'right' => true
            );
        }

        public function show($params) {
            $this -> getAuthInfo();
            $good_id = isset($params['id']) ? (int)$params['id'] : 0;
            $product = new Product;
            return $product -> getProduct($good_id);
        }
    }
