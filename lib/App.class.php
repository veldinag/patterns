<?php

    class App {

        public static function Init() {
            date_default_timezone_set('Europe/Moscow');
            DB::getInstance();
            if (php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)) {
                self::web(isset($_GET['path']) ? $_GET['path'] : '');
            }
        }
	
        protected static function web($url) {
            $url = explode("/", $url);
            if (!empty($url[0])) {
                $_GET['page'] = $url[0];
                if (isset($url[1])) {
                    if (is_numeric($url[1])) {
                        $_GET['id'] = $url[1];
                    } else {
                        $_GET['action'] = $url[1];
                    }
                    if (isset($url[2])) {
                        $_GET['id'] = $url[2];
                    }
                }
            } else {
                $_GET['page'] = 'catalog';
            }
            $_GET['asAjax'] = false;
            foreach($url as $i) {
                if ($i === 'ajax') {
                    $_GET['asAjax'] = true;
                    break;
                }
            }          
            $controllerName = ucfirst($_GET['page']) . 'Controller';
            $methodName = isset($_GET['action']) ? $_GET['action'] : 'show';
            $controller = new $controllerName();
            if (!$_GET['asAjax']) {
                $controller -> Request($methodName, $_GET);
            } else {
                echo json_encode($controller -> $methodName($_GET));
            }
        }
    }