<?php

    class DB {

        protected static $instance = null;

        private function __construct() { }

        private function __clone() { }

        public static function getInstance() {
            if (self::$instance === null) {
                $opt = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => TRUE,
                );
                $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
                self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt);
            }
            return self::$instance;
        }

        private static function sql($sql, $args = []) {
            $stmt = self::getInstance()->prepare($sql);
            $stmt->execute($args);
            return $stmt;
        }

        public static function select($sql, $args = []) {
            return self::sql($sql, $args)->fetchAll();
        }

        public static function getRow($sql, $args = []) {
            return self::sql($sql, $args)->fetch();
        }

        public static function insert($sql, $args = []) {
            $stmt = self::sql($sql, $args);
            return self::getInstance() -> lastInsertId();
        }

        public static function update($sql, $args = []) {
            $stmt = self::sql($sql, $args);
            return $stmt->rowCount();
        }

        public static function delete($sql, $args = []) {
            $stmt = self::sql($sql, $args);
            return $stmt->rowCount();
        }
    }

/*
db::getInstance()->Select(
                'SELECT * FROM goods WHERE category_id = :category AND good_id=:good AND good_is_active=:status',
                ['status' => Status::Active, 'category' => $categoryId, 'good'=>$goodId]);
*/


