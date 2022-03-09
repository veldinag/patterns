<?php

    class User {

        public function getUserInfo ($email, $pass) {
            $md5_pass = strrev(md5($email)).md5($pass);
            $result = DB::getRow(
                "SELECT * FROM users WHERE email=:email AND pass=:md5_pass",
                ['email' => $email, 'md5_pass' => $md5_pass]
            );
            if (!empty($result)) {
                return $result;
            } else {
                return null;
            }
        }

        public function checkUser ($email) {
            $result = DB::getRow(
                "SELECT * FROM users WHERE email=:email",
                ['email' => $email]
            );
            if (!empty($result)) {
                return $result;
            } else {
                return null;
            }
        }

        public function regUser ($data) {
            $md5_pass = strrev(md5($data['email'])).md5($data['pass']);
            $result = DB::insert(
                "INSERT INTO users (first_name, last_name, gender, email, pass)
                    VALUES (:first_name, :last_name, :gender, :email, :md5_pass)",
                [
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'gender' => $data['gender'],
                    'email' => $data['email'],
                    'md5_pass' => $md5_pass
                ]
            );
            if (isset($result)) {
                return true;
            } else {
                return false;
            }
        }
    }
