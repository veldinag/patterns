<?php

    class Catalog {

        public function getCountOfGoods() {
            $result = DB::getRow("SELECT COUNT(*) AS countOfGoods FROM goods");
            return $result['countOfGoods'];
        }

        public function getGoodsPage ($page, $limit) {
            if ($page == 1) {
                $result = DB::select(
                    "SELECT * FROM goods WHERE id > :start_id LIMIT ".$limit,
                    ['start_id' => 0]
                );
            } else {
                $b_limit = $limit * ($page - 1);
                $res = DB::select(
                    "SELECT id FROM goods WHERE id > :start_id LIMIT " . $b_limit,
                    ['start_id' => 0]
                );
                $start_id = $res[count($res) - 1]['id'];
                $result = DB::select(
                    "SELECT * FROM goods WHERE id > :start_id LIMIT " . $limit,
                    ['start_id' => $start_id]
                );
            }
            return $result;
        }
    }
