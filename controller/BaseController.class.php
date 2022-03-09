<?php

    abstract class BaseController extends Controller {

        protected $title = "Shop";

        protected function before()
        {
            $this -> bc = array();
        }

        public function render() {
            $vars = array (
                'title' => $this -> title,
                'heading' => $this -> heading,
                'content' => $this -> content,
                'bc' => $this -> bc,
                'cartIcon' => $this -> cartIcon,
                'showAdmin' => $this -> showAdmin,
                'menu' => $this -> menu
            );
            $page = $this -> Template("views/main.php", $vars);
            echo $page;
        }
    }
