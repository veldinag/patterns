<?php

    spl_autoload_register("gbStandardAutoload");

    function gbStandardAutoload($className) {
        $dirs = [
            'controller',
            'model',
            'lib'
        ];
        $found = false;
        foreach ($dirs as $dir) {
            $fileName = $dir . '/' . $className . '.class.php';
            if (is_file($fileName)) {
                require_once($fileName);
                $found = true;
            }
        }

        if (!$found) {
            die('Unable to load ' . $className);
        }
        return true;
    }
