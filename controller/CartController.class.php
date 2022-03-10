<?php

    class CartController extends BaseController {

        protected function before() {
            $this -> getAuthInfo();
            $this -> heading = "Shopping cart";
            $this -> title .= " | " . $this -> heading;
            $this -> view = "cart";
            $this -> bc = array(
                "visible" => "dont_show",
                "first" => "",
                "second" => "",
                "last" => ""
            );
            $this -> menu = array(
                'find' => true,
                'right' => true
            );
        }

        // метод show также признаки спагетти-кода

        public function show($params) {
            $this -> getAuthInfo();
            $id = isset($params['id']) ? (int)$params['id'] : 1;

            if (!isset($this -> authInfo['auth'])) {
                $status_str = "To shopping you should to <a href='index.php?path=user/login'>log in.</a>";
                return array(
                    'total' => 0,
                    'status_str' => $status_str,
                    'cart' => null
                );
            } else {
                if ($this -> cartIcon['incart'] === 'dont_show') {
                    $status_str = "Shoping cart is empty. <a href='index.php?path=catalog/show'>Go shopping!</a>";
                    return array(
                        'total' => 0,
                        'status_str' => $status_str,
                        'cart' => null
                    );
                } else {
                    $cart = new Cart($this -> authInfo['user_id']);
                    return array(
                        'total' => $cart -> getAmount(),
                        'status_str' => "",
                        'cart' => $cart -> getCart()
                    );
                }
            }
        }

        public function clear($params) {
            $this -> getAuthInfo();
            $asAjax = ($params['asAjax'] == true) ? $params['asAjax'] : false;
            if (isset($this -> authInfo['auth']) && $asAjax) {
                $cart = new Cart($this -> authInfo['user_id']);
                return array(
                    'total' => 0,
                    'status' => ($cart -> clearCart()) ? 1 : 5,
                    'row_items' => 0,
                    'quantity' => 0
                );
            } else {
                return null;
            }
        }

        // метод del - слегка спагетти!!!

        public function del($params) {
            $this -> getAuthInfo();
            $good_id = isset($params['id']) ? (int)$params['id'] : 0;
            $asAjax = ($params['asAjax'] == true) ? $params['asAjax'] : false;
            if (isset($this -> authInfo) && $asAjax) {
                $cart = new Cart($this -> authInfo['user_id']);
                if ($cart -> getRowsInCart() == 1){
                    return array(
                        'status' => ($cart -> clearCart()) ? 1 : 5,
                        'row_items' => 0,
                        'quantity' => 0,
                        'total' => 0
                    );
                } else {
                    $row_items = $cart -> getRowsInCart();
                    $total = $cart -> getAmount();
                    return array(
                        'status' => ($cart -> deleteProduct($good_id)) ? 2 : 5,
                        'row_items' => $row_items,
                        'quantity' => 0,
                        'total' => $total
                    );
                }
            } else {
                return null;
            }
        }

        // метод add - также сложные проверки, вложенные условия
        // спагетти-код

        public function add($params) {
            $this -> getAuthInfo();
            $good_id = isset($params['id']) ? (int)$params['id'] : 0;
            $asAjax = ($params['asAjax'] == true) ? $params['asAjax'] : false;
            if (isset($this -> authInfo) && $asAjax) {
                $cart = new Cart($this -> authInfo['user_id']);
                if ($cart -> getRowsInCart() == 0) {
                    $qty = 1;
                    $status = ($cart -> addProductNewOrder($good_id)) ? 4 : 5;
                    $row_items = $cart -> getRowsInCart();
                    $total = $cart -> getAmount();
                    return array(
                        'status' => $status,
                        'row_items' => $row_items,
                        'quantity' => $qty,
                        'total' => $total
                    );
                } else {
                    $qty = $cart -> getQuantity($good_id);
                    if ($qty == 0) {
                        return array(
                            'status' => ($cart -> addProduct($good_id)) ? 4 : 5,
                            'row_items' => ($cart -> getRowsInCart()),
                            'quantity' => 1,
                            'total' => $cart -> getAmount()
                        );
                    } else {
                        return array(
                            'status' => ($cart -> addQuantity($good_id)) ? 3 : 5,
                            'row_items' => ($cart -> getRowsInCart()),
                            'quantity' => $qty + 1,
                            'total' => $cart -> getAmount()
                        );
                    }
                }
            } else {
                return array(
                    'status' => 6,
                    'row_items' => 0,
                    'quantity' => 0,
                    'total' => 0
                );
            }
        }

        public function sub($params) {
            $this -> getAuthInfo();
            $good_id = isset($params['id']) ? (int)$params['id'] : 0;
            $asAjax = ($params['asAjax'] == true) ? $params['asAjax'] : false;
            if (isset($this -> authInfo['auth']) && $asAjax) {
                $cart = new Cart($this -> authInfo['user_id']);
                $quantity = $cart -> getQuantity($good_id);
                if ($quantity <= 1) {
                    $quantity = 0;
                    $status = ($cart -> deleteProduct($good_id)) ? 2 : 5;
                    $row_items = $cart -> getRowsInCart();
                    $total = ($row_items > 0) ? $cart -> getAmount() : 0;
                    $result = array(
                        'status' => $status,
                        'row_items' => $row_items,
                        'quantity' => $quantity,
                        'total' => $total
                    );
                } else {
                    $quantity--;
                    $status = ($cart -> subQuantity($good_id)) ? 3 : 5;
                    $row_items = $cart -> getRowsInCart();
                    $total = ($row_items > 0) ? $cart -> getAmount() : 0;
                    $result = array(
                        'status' => $status,
                        'row_items' => $row_items,
                        'quantity' => $quantity,
                        'total' => $total
                    );
                }
                return $result;
            } else {
                return null;
            }
        }
    }
