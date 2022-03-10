<?php

    class Admin extends Catalog {

        // методы данного объекта насыщены антипаттерном "слепая вера"
        // нигде нет проверки на возвращаемый результат
        // отсутствует обработка возможных ошибок
        
        public function getGood($good_id) {
            return DB::getRow(
                "SELECT * FROM goods WHERE id=:good_id",
                ['good_id' => $good_id]
            );
        }

        public function updateGoodWithImg ($good_id, $values) {
            return DB::update(
                "UPDATE goods
                 SET title=:title,
                     img=:img,
                     price=:price,
                     short_desc=:short_desc,
                     long_desc=:long_desc
                 WHERE id=:good_id",
                ['title' => $values['title'],
                 'img' => $values['img'],
                 'price' => $values['price'],
                 'short_desc' => $values['short_desc'],
                 'long_desc' => $values['long_desc'],
                 'good_id' => $good_id]
            );
        }

        public function updateGoodNoImg ($good_id, $values) {
            return DB::update(
                "UPDATE goods
                 SET title=:title,
                     price=:price,
                     short_desc=:short_desc,
                     long_desc=:long_desc
                 WHERE id=:good_id",
                ['title' => $values['title'],
                 'price' => $values['price'],
                 'short_desc' => $values['short_desc'],
                 'long_desc' => $values['long_desc'],
                 'good_id' => $good_id]
            );
        }

        public function deleteGood ($good_id) {
            return DB::delete(
                "DELETE FROM goods WHERE id=:good_id",
                ['good_id' => $good_id]
            );
        }

        public function addGood ($values) {
            return DB::insert(
                "INSERT INTO goods (title, short_desc, long_desc, price, img)
                VALUES (:title, :short_desc, :long_desc, :price, :img)",
                ['title' => $values['title'],
                 'short_desc' => $values['short_desc'],
                 'long_desc' => $values['long_desc'],
                 'price' => $values['price'],
                 'img' => $values['img'],]
            );
        }

        public function getCountOfOrders()
        {
            $result = DB::getRow(
                "SELECT COUNT(*) AS countOfOrders FROM orders WHERE status_id IN (2, 3)"
            );
            return $result['countOfOrders'];
        }

        public function getOrdersPage ($page, $limit) {
            $max_id_res = DB::getRow("SELECT MAX(id) as max_id FROM orders WHERE status_id IN (2, 3)");
            $max_id = $max_id_res['max_id'];
            if ($page == 1) {
                $result = DB::select(
                    "SELECT orders.id as id, CONCAT(first_name, ' ', last_name, ' (', email, ')') as name, date, statuses.name as status
                        FROM orders
                        JOIN users ON users.id=orders.user_id
                        JOIN statuses ON statuses.id=orders.status_id
                        WHERE orders.id <= :start_id AND orders.status_id IN (2, 3) ORDER BY orders.id DESC LIMIT " . $limit,
                    ['start_id' => $max_id]
                );
            } else {
                $b_limit = $limit * ($page - 1);
                $res = DB::select(
                    "SELECT id FROM orders WHERE id <= :start_id ORDER BY id DESC LIMIT " . $b_limit,
                    ['start_id' => $max_id]
                );
                $start_id = $res[count($res) - 1]['id'];
                $result = DB::select(
                    "SELECT orders.id as id, CONCAT(first_name, ' ', last_name, ' (', email, ')') as name, date, statuses.name as status
                FROM orders
                JOIN users ON users.id=orders.user_id
                JOIN statuses ON statuses.id=orders.status_id
                WHERE orders.id < :start_id AND orders.status_id IN (2, 3) ORDER BY orders.id DESC LIMIT " . $limit,
                    ['start_id' => $start_id]
                );
            }
            return $result;
        }

        public function getOrderDetails($order_id) {
            return DB::select(
                "SELECT goods.id AS id, title, price, qty, ROUND((price * qty), 2) AS good_total
                FROM orders
                JOIN cart ON orders.id = cart.order_id
                JOIN goods ON cart.good_id = goods.id WHERE orders.id = :order_id",
                ['order_id' => $order_id]
            );
        }

        public function setOrderCompleted($order_id) {
            return DB::update(
                "UPDATE orders
                SET status_id = (SELECT id FROM statuses WHERE name=:status_name)
                WHERE id=:order_id",
                ['status_name' => 'completed', 'order_id' => $order_id]
            );
        }

        public function getCount($table, $param = "") {
            $condition = "";
            if ($param != "") {
                $condition = " WHERE status_id=:status_id";
            }
            $data = DB::getRow(
                "SELECT COUNT(*) as data FROM " . $table . $condition,
                ['status_id' => $param]
            );
            return $data['data'];
        }

        public function getOrdersAmount($status_id = "") {
            $condition = "";
            if ($status_id != "") {
                $condition = " WHERE status_id=:status_id";
            }
            $data = DB::getRow(
                "SELECT ROUND(SUM(goods.price * cart.qty), 0) AS data
                 FROM `orders` JOIN `cart` ON orders.id=cart.order_id
                 JOIN `goods` ON goods.id = cart.good_id" . $condition,
                ['status_id' => $status_id]
            );
            return $data['data'] ? $data['data'] : 0;
        }

        public function getNewOrders($last_id) {
            $data = DB::select(
                "SELECT orders.id as id, CONCAT(first_name, ' ', last_name, ' (', email, ')') as name, date, statuses.name as status
                FROM orders
                JOIN users ON users.id=orders.user_id
                JOIN statuses ON statuses.id=orders.status_id
                WHERE orders.id > :last_id AND orders.status_id=:status_id ORDER BY orders.id DESC",
                ['last_id' => $last_id, 'status_id' => 2]
            );
            if (!empty($data)) {
                return $data;
            } else {
                return null;
            }
        }
    }