<?php
    class Product {

       public function getProduct ($good_id) {
           return DB::getRow(
               "SELECT * FROM goods WHERE id = :good_id",
                ['good_id' => $good_id]
           );
       }
    }