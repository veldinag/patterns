<?php

   class Cart {

       protected $user_id;

       public function __construct($user_id) {
           $this -> user_id = $user_id;
       }

        public function getRowsInCart() {
            $result = DB::getRow(
                "SELECT COUNT(*) AS row_items
                      FROM cart
                      JOIN orders
                      ON cart.order_id = orders.id
                      WHERE user_id=:user_id AND status_id=:status_id",
                ['user_id' => $this -> user_id, 'status_id' => 1]
            );
            return $result['row_items'];
        }

        public function getCart() {
            return DB::select(
                "SELECT good_id, title, img, price, qty, order_id
                FROM goods
                JOIN cart ON goods.id = cart.good_id
                JOIN orders ON cart.order_id = orders.id
                WHERE orders.status_id = :status_id AND user_id=:user_id",
                ['user_id' => $this -> user_id, 'status_id' => 1]
            );
        }

        public function getCartIdOfProduct($good_id) {
           $data = DB::getRow(
               "SELECT id FROM cart WHERE good_id = :good_id 
                    AND order_id = (SELECT id FROM orders WHERE user_id=:user_id AND status_id=:status_id)",
               ['good_id' => $good_id, 'user_id' => $this -> user_id, 'status_id' => 1]
           );
           if ($data) {
               return $data['id'];
           } else {
               return 0;
           }
        }

        public function getAmount() {
            $data = $this ->getCart();
            $total = 0;
            foreach ($data as $item) {
                $total += round($item['price'] * $item['qty'], 2);
            }
            return $total;
        }

        public function clearCart() {
            return DB::delete(
                "DELETE FROM orders WHERE user_id=:user_id AND status_id=:status_id",
                ['user_id' => $this -> user_id, 'status_id' => 1]);
        }

       public function deleteProduct($good_id) {
           return DB::delete(
               "DELETE FROM cart WHERE good_id=:good_id AND order_id
                    IN (SELECT id FROM orders WHERE user_id=:user_id AND status_id=:status_id)",
               ['user_id' => $this -> user_id, 'good_id' => $good_id, 'status_id' => 1]
           );
       }

       public function addProduct($good_id) {
           return DB::insert(
               "INSERT INTO cart (good_id, qty, order_id)
                    VALUES (:good_id, :qty, (SELECT id FROM orders WHERE user_id=:user_id AND status_id=:status_id))",
                    ['user_id' => $this -> user_id, 'qty' => 1, 'good_id' => $good_id, 'status_id' => 1]
           );
       }

       public function addProductNewOrder($good_id) {
           $order_id = (int)DB::insert(
               "INSERT INTO orders (user_id, status_id, date)
                    VALUES (:user_id, :status_id, :date)",
                    ['user_id' => $this -> user_id, 'status_id' => 1, 'date' => '']
           );
           if ($order_id > 0) {
               return DB::insert(
                   "INSERT INTO cart (good_id, qty, order_id)
                    VALUES (:good_id, :qty, :order_id)",
                   ['good_id' => $good_id, 'qty' => 1, 'order_id' => $order_id]
               );
           } else {
               return 0;
           }
       }

       public function getQuantity ($good_id) {
           $result = DB::getRow(
               "SELECT * FROM cart WHERE good_id=:good_id AND order_id = 
                    (SELECT id FROM orders WHERE user_id=:user_id AND status_id=:status_id)",
                    ['user_id' => $this -> user_id, 'good_id' => $good_id, 'status_id' => 1]
           );
           if (!$result) {
               return 0;
           } else {
               return $result['qty'];
           }
       }

       public function addQuantity ($good_id) {
           return DB::update(
               "UPDATE cart SET qty = qty + 1 WHERE good_id=:good_id AND order_id = 
                    (SELECT id FROM orders WHERE user_id=:user_id AND status_id=:status_id)",
                ['user_id' => $this -> user_id, 'good_id' => $good_id, 'status_id' => 1]
           );
       }

       public function subQuantity ($good_id) {
           return DB::update(
               "UPDATE cart SET qty = qty - 1 WHERE good_id=:good_id AND order_id = 
                    (SELECT id FROM orders WHERE user_id=:user_id AND status_id=:status_id)",
               ['user_id' => $this -> user_id, 'good_id' => $good_id, 'status_id' => 1]
           );
       }
   }