<?php

    class OrderController extends BaseController {

        protected function before() {
            $this -> getAuthInfo();
            $this -> heading = "Order";
            $this -> title .= " | " . $this -> heading;
            $this -> view = "order";
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

        public function show($params) {
            $this -> getAuthInfo();
            $this -> setCartIcon();
            $id = isset($params['id']) ? (int)$params['id'] : 1;
            if (isset($this -> authInfo)) {
                $cart = new Cart($this -> authInfo['user_id']);
                $ordered_goods = $cart -> getCart();
                for ($i=0; $i < count($ordered_goods); $i++) {
                    $ordered_goods[$i]['total'] = round($ordered_goods[$i]['qty'] * $ordered_goods[$i]['price'], 2);
                }
                $order_id = $ordered_goods[0]['order_id'];
                $order = new Order($this -> authInfo['user_id']);
                if ($order -> setStatusToNew() == 1) {
                    return array(
                        'order_id' => $order_id,
                        'ordered_goods' => $ordered_goods
                    );
                }
            }
        }
}
