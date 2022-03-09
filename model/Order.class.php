<?php

    class Order {

        protected $user_id;

        public function __construct($user_id) {
            $this -> user_id = $user_id;
        }

        public function setStatusToNew() {
            return DB::update(
                "UPDATE orders SET status_id=:new_status_id, `date`=:date WHERE user_id=:user_id AND status_id=:old_status_id",
                ['user_id' => $this -> user_id, 'old_status_id' => 1, 'new_status_id' => 2, 'date' => date('d.m.Y H:i:s')]);
        }
    }