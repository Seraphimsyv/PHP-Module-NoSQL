<?php

    spl_autoload_register(
        function($class) : void
        {
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            require strtolower($path) . '.php';
        }
    );