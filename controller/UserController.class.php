<?php

    class UserController extends BaseController {

        protected function before() {
            $this -> view = "user";
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

        public function login($params) {
            $status = isset($params['id']) ? (int)$params['id'] : 0;
            $this -> heading = "Log in";
            $this -> title .= " | " . $this -> heading;
            if (!empty($this -> authInfo['auth'])) { // already logged in
                if ($status !== 1) {
                    $status_str = "You are already logged in with email {$this -> authInfo['email']}.
                    You can <a href='index.php'>continue shopping</a> or <a href='index.php?path=user/logout'>log out.</a>";
                    $showLoginForm = false;
                } else {
                    $status_str = "You have successfully logged in. <a href='index.php'>Go shopping!</a>";
                    $showLoginForm = false;
                }
                $result = array(
                    'status_str' => $status_str,
                    'showLoginForm' => $showLoginForm
                );
                return $result;
            } else {
                if (empty($_POST)) {
                    if ($status === 2) {
                        $status_str = "To login, you must fill in all the fields of the web form.";
                        $showLoginForm = true;
                    } elseif ($status === 3) {
                        $status_str = "The user with such data is not registered. Try again or <a href='index.php?path=user/reg'>register.</a>";
                        $showLoginForm = true;
                    } elseif ($status === 4) {
                        $status_str = "To shopping you should to <a href='index.php?path=user/login'>log in.</a>";
                        $showLoginForm = true;
                    } else {
                        $status_str = "";
                        $showLoginForm = true;
                    }
                    $result = array(
                        'status_str' => $status_str,
                        'showLoginForm' => $showLoginForm
                    );
                    return $result;
                } else {
                    $email = trim(strip_tags($_POST['email']));
                    $pass = trim(strip_tags($_POST['pass']));
                    if ($email === "" || $pass === "") {
                        header ("Location: index.php?path=user/login/2");
                        return;
                    }
                    $usermodel = new User;
                    $data = $usermodel -> getUserInfo($email, $pass);
                    if (!empty($data)) {
                        $_SESSION['auth'] = true;
                        $_SESSION['user_id'] = $data['id'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['name'] = $data['first_name']." ".$data['last_name'];
                        $_SESSION['user_type'] = $data['type'];
                        header ("Location: index.php?path=user/login/1");
                        return;
                    } else {
                        header ("Location: index.php?path=user/login/3");
                        return;
                    }
                }
            }
        }

        public function reg($params) {
            $status = isset($params['id']) ? (int)$params['id'] : 0;
            $this -> heading = "Registration";
            $this -> title .= " | " . $this -> heading;

            if (!empty($this -> authInfo['auth'])) { // already logged in
                $status_str = "You are logged in with email {$this -> authInfo['email']}.
                                To register another user you should <a href='index.php?path=user/logout'>log out.</a>";
                return array(
                    'status_str' => $status_str,
                    'showRegForm' => false
                );
            } else {
                if (empty($_POST)) {
                    if ($status === 1) {
                        $status_str = "You have successfully registered. To start shopping, please <a href='index.php?path=user/login'>log in</a>.";
                        $showRegForm = false;
                    } elseif ($status === 2) {
                        $status_str = "To register, you must fill in all the fields of the web form.";
                        $showRegForm = true;
                    } elseif ($status === 3) {
                        $status_str = "The user with this email is already registered. Try again with another email.";
                        $showRegForm = true;
                    } elseif ($status === 4) {
                        $status_str = "An unexpected database interaction error has occurred. Try again later.";
                        $showRegForm = true;
                    } else {
                        $status_str = "";
                        $showRegForm = true;
                    }
                    $result = array(
                        'status_str' => $status_str,
                        'showRegForm' => $showRegForm
                    );
                    return $result;
                } else {
                    $firstname = trim(strip_tags($_POST['firstname']));
                    $lastname = trim(strip_tags($_POST['lastname']));
                    $gender = $_POST['gender'];
                    $email = trim(strip_tags($_POST['email']));
                    $pass = trim(strip_tags($_POST['pass']));

                    if ($firstname === "" || $lastname === "" || $email === "" || $pass === "") {
                        header ("Location: index.php?path=user/reg/2");
                        return;
                    }
                    $usermodel = new User;
                    if (empty($usermodel -> checkUser($email))) {
                        $data = [
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'gender' => $gender,
                            'email' => $email,
                            'pass' => $pass
                        ];
                        if ($usermodel -> regUser($data)) {
                            header ("Location: index.php?path=user/reg/1");
                            return;
                        } else {
                            header ("Location: index.php?path=user/reg/4");
                            return;
                        }
                    } else {
                        header ("Location: index.php?path=user/reg/3");
                        return;
                    }
                }
            }
        }

        public function logout($params) {
            $status = isset($params['id']) ? (int)$params['id'] : 0;
            if (!empty($this -> authInfo)) {
                session_unset();
            }
            header ("Location: index.php?path=user/login");
            return;
        }
    }
