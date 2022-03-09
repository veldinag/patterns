<?php

    abstract class Controller {

        protected $title;
        protected $heading;
        protected $bc;
        protected $content;
        protected $view;
        protected $cartIcon;
        protected $authInfo;
        protected $showAdmin;
        protected $menu;

        protected function getAuthInfo() {
            if(isset($_SESSION['auth'])) {
                $this -> authInfo = $_SESSION;
            } else {
                $this -> authInfo = null;
            }
        }

        protected function isAdmin() {
            $this -> showAdmin = false;
            if ($this -> authInfo != null) {
                if ($this -> authInfo['user_type'] == 'admin') {
                    $this -> showAdmin = true;
                }
            }
        }

        protected function setCartIcon() {
            if ($this -> authInfo !== null) {
                $cart = new Cart($this -> authInfo['user_id']);
                $row_items = $cart -> getRowsInCart();
                $this -> cartIcon = array (
                    'incart' => ($row_items == 0) ? 'dont_show' : '',
                    'row_items' => $row_items
                );
            } else {
                $this -> cartIcon = array(
                    'incart' => 'dont_show',
                    'row_items' => ''
                );
            }
        }

        protected abstract function before();

        protected abstract function render();

        public function Request($method, $params) {
            $this -> before();
            $this -> getAuthInfo();
            $this -> setCartIcon();
            $this -> isAdmin();
            $this -> content = $this -> Template("views/" . $this -> view . "/" . $method . ".php", $this -> $method($params));
            $this -> render();
        }

        protected function IsGet() {
            return $_SERVER['REQUEST_METHOD'] == 'GET';
        }

        protected function IsPost() {
            return $_SERVER['REQUEST_METHOD'] == 'POST';
        }

        protected function Template($fileName, $vars = array()) {
            if ($vars != null) {
                foreach ($vars as $key => $value) {
                    $$key = $value;
                }
            }
            ob_start();
            include "$fileName";
            return ob_get_clean();
        }

        public function __call($name, $params) {
            die('Wrong url!');
        }
    }
