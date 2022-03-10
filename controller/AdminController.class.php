<?php

class AdminController extends BaseController {

    protected function before() {
        $this -> heading = "Admin Panel";
        $this -> title .= " | " . $this -> heading;
        $this -> view = "admin";
        $this -> bc = array(
            "visible" => "dont_show",
            "first" => "",
            "second" => "",
            "last" => ""
        );
        $this -> showAdmin = false;
        $this -> menu = array(
            'find' => false,
            'right' => false
        );
    }

    public function show($params) {
        $part = isset($params['id']) ? (int)$params['id'] : 1;
        if (!empty($this -> authInfo) && $this -> authInfo['user_type'] === 'admin') {
            $admin = new Admin;
            return array(
                'isAdmin' => true,
                'users' => $admin -> getCount('users'),
                'goods' => $admin -> getCount('goods'),
                'total_orders' => $admin -> getCount('orders'),
                'compl_orders' => $admin -> getCount('orders', 3),
                'new_orders' => $admin -> getCount('orders', 2),
                'orders_amount' => $admin -> getOrdersAmount(),
                'compl_orders_amount' => $admin -> getOrdersAmount(3),
                'new_orders_amount' => $admin -> getOrdersAmount(2),
            );
        } else {
            return array(
                'isAdmin' => false,
                'users' => 0,
                'goods' => 0,
                'total_orders' => 0,
                'compl_orders' => 0,
                'new_orders' => 0,
                'orders_amount' => 0,
                'compl_orders_amount' => 0,
                'new_orders_amount' => 0
            );
        }
    }

    public function goods($params) {
        $this -> heading .= " | Products";
        $part = isset($params['id']) ? (int)$params['id'] : 1;
        if (!empty($this -> authInfo) && $this -> authInfo['user_type'] === 'admin') {
            $admin = new Admin();
            $countOfGoods = (int)($admin -> getCountOfGoods());
            $parts = ($countOfGoods % GOODS_IN_PART_ADMIN == 0) ? intdiv($countOfGoods, GOODS_IN_PART_ADMIN) : intdiv($countOfGoods, GOODS_IN_PART_ADMIN) + 1;
            if ($part > $parts) {
                $part = $parts;
            }
            return array(
                'isAdmin' => true,
                'status' => null,
                'part' => $part,
                'parts' => $parts,
                'goods' => $admin -> getGoodsPage($part, GOODS_IN_PART_ADMIN)
            );
        } else {
            return array(
                'isAdmin' => false,
                'part' => 0,
                'parts' => 0,
                'status' => 1,
                'goods' => []
            );
        }
    }

    // метод editgoot, как мне кажется, явный пример спагетти-кода
    // множество ветвлений, условий, сложные проверки

    public function editgood($params) {
        $this -> heading .= " | Edit product";
        $good_id = isset($params['id']) ? (int)$params['id'] : 1;
        if ($this -> authInfo['user_type'] == 'admin') {
            $admin = new Admin;
            if (!empty($_POST)) {
                $operation = isset($_POST['operation']) ? trim(strip_tags($_POST['operation'])) : "";
                switch ($operation) {
                    case 'cancel':
                        return array(
                            'isAdmin' => true,
                            'status' => 2,
                            'good' => $admin -> getGood($good_id)
                        );
                    case 'change':
                        $filename = $_FILES['img']['name'];
                        $path = "data/img/catalog".$filename;
                        $_POST['title'] = strip_tags($_POST['title']);
                        $_POST['short_desc'] = strip_tags($_POST['short_desc']);
                        $_POST['long_desc'] = strip_tags($_POST['long_desc']);
                        $_POST['price'] = (float)$_POST['price'];
                        if(move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
                            $_POST['img'] = $filename;
                            if ($admin -> updateGoodWithImg($good_id, $_POST) == 1) {
                                return array(
                                    'isAdmin' => true,
                                    'status' => 1,
                                    'good' => $admin -> getGood($good_id)
                                );
                            } else {
                                return array(
                                    'isAdmin' => true,
                                    'status' => 3,
                                    'good' => $admin -> getGood($good_id)
                                );
                            }        
                        } else {
                            if ($admin -> updateGoodNoImg($good_id, $_POST) == 1) {
                                return array(
                                    'isAdmin' => true,
                                    'status' => 1,
                                    'good' => $admin -> getGood($good_id)
                                );
                            } else {
                                return array(
                                    'isAdmin' => true,
                                    'status' => 3,
                                    'good' => $admin -> getGood($good_id)
                                );
                            }    
                        }
                    case 'delete':
                        if ($admin -> deleteGood($good_id) == 1) {
                            return array(
                                'isAdmin' => true,
                                'status' => 4,
                                'good' => null
                            );
                        } else {
                            return array(
                                'isAdmin' => true,
                                'status' => 3,
                                'good' => $admin -> getGood($good_id)
                            );
                        }
                }
            } else {
                return array(
                    'isAdmin' => true,
                    'status' => "",
                    'good' => $admin -> getGood($good_id)
                );
            }  
        } else {
            return array(
                'isAdmin' => false,
                'status' => 5,
                'good' => []
            );
        }
    }

    // метод addgoot также пример спагетти-кода
    // аналогично множество ветвлений, условий, сложные проверки

    public function addgood($params) {
        $this -> heading .= " | Add product";
        $id = isset($params['id']) ? (int)$params['id'] : 1;
        if ($this -> authInfo['user_type'] == 'admin') {
            $admin = new Admin;
            if (!empty($_POST)) {
                $operation = isset($_POST['operation']) ? trim(strip_tags($_POST['operation'])) : "";              
                switch ($operation) {
                    case 'cancel':
                            $_POST['title'] = "";
                            $_POST['short_desc'] = "";
                            $_POST['long_desc'] = "";
                            $_POST['price'] = "";
                            setcookie('title', $_POST['title'], time() - 600);
                            setcookie('short_desc', $_POST['short_desc'], time() - 600);
                            setcookie('long_desc', $_POST['long_desc'], time() - 600);
                            setcookie('price', $_POST['price'], time() - 600);
                        return array(
                            'isAdmin' => true,
                            'status' => 2,
                            'good' => $_POST
                        );
                        break;
                    case 'add':
                        $_POST['title'] = isset($_POST['title']) ? strtoupper(strip_tags($_POST['title'])) : $_COOKIE['title'];
                        $_POST['short_desc'] = isset($_POST['short_desc']) ? strip_tags($_POST['short_desc']) : $_COOKIE['short_desc'];
                        $_POST['long_desc'] = isset($_POST['long_desc']) ? strip_tags($_POST['long_desc']) : $_COOKIE['long_desc'];
                        $_POST['price'] = isset($_POST['price']) ? strip_tags($_POST['price']) : $_COOKIE['price'];
                        $filetype = explode('/', $_FILES['img']['type']);
                        $_POST['img'] = uniqid('img').".".$filetype[1];
                        $path = "data/img/catalog/".$_POST['img'];
           
                        if (empty($_POST['title']) || empty($_POST['short_desc']) || empty($_POST['long_desc']) || empty($_POST['price']) || empty($filetype)) {
                            setcookie('title', $_POST['title'], time() + 600);
                            setcookie('short_desc', $_POST['short_desc'], time() + 600);
                            setcookie('long_desc', $_POST['long_desc'], time() + 600);
                            setcookie('price', $_POST['price'], time() + 600);
                            return array(
                                'isAdmin' => true,
                                'status' => 4,
                                'good' => $_POST
                            );
                        } else {
                            if(move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
    
                                if ($admin -> addGood($_POST) != 0) {
                                   return array(
                                        'isAdmin' => true,
                                        'status' => 1,
                                        'good' => null
                                   );
                                } else {
                                    return array(
                                        'isAdmin' => true,
                                        'status' => 3,
                                        'good' => $_POST
                                    );
                                }
                            } else {
                                return array(
                                    'isAdmin' => true,
                                    'status' => 5,
                                    'good' => $_POST
                                );
                            }
                        }
                        break;
                }
            } else {
                return array(
                    'isAdmin' => true,
                    'status' => "",
                    'good' => []
                );
            }  
        } else {
            return array(
                'isAdmin' => false,
                'status' => 6,
                'good' => []
            );
        }
    }

    public function orders($params) {
        $this -> heading .= " | Orders";
        $part = isset($params['id']) ? (int)$params['id'] : 1;
        if (!empty($this -> authInfo) && $this -> authInfo['user_type'] === 'admin') {
            $admin = new Admin();
            $countOfOrders = (int)($admin -> getCountOfOrders());
            $parts = ($countOfOrders % ORDERS_IN_PART_ADMIN == 0) ? intdiv($countOfOrders, ORDERS_IN_PART_ADMIN) : intdiv($countOfOrders, ORDERS_IN_PART_ADMIN) + 1;
            if ($part > $parts) {
                $part = $parts;
            }
            return array(
                'isAdmin' => true,
                'status' => null,
                'part' => $part,
                'parts' => $parts,
                'orders' => $admin -> getOrdersPage($part, ORDERS_IN_PART_ADMIN)
            );
        } else {
            return array(
                'isAdmin' => false,
                'part' => 0,
                'parts' => 0,
                'status' => 1,
                'orders' => []
            );
        }
    }

    public function orderdetails($params) {
        if ($params['asAjax']) {
            $order_id = isset($params['id']) ? (int)$params['id'] : 0;
            $admin = new Admin;
            return $admin -> getOrderDetails($order_id);
        } else {
            return null;
        }
    }

    public function setcompleted($params) {
        if ($params['asAjax']) {
            $order_id = isset($params['id']) ? (int)$params['id'] : 0;
            $admin = new Admin;
            $result = $admin -> setOrderCompleted($order_id);
            if ($result == 1) {
                return array(
                    'status' => 1
                );
            } else {
                return array(
                    'status' => 0
                );
            }
        } else {
            return null;
        }
    }

    public function getneworders($params) {
        if ($params['asAjax']) {
            $last_id = isset($params['id']) ? (int)$params['id'] : 0;
            $admin = new Admin;
            return array(
                'orders' => $admin -> getNewOrders($last_id)
            );
        } else {
            return null;
        }
    }
}
