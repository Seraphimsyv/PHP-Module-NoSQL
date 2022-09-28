<?php

    spl_autoload_register(
        function($class) : void
        {
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
            require strtolower($path) . '.php';
        }
    );

    /**
     * 
     */

    $sql = new \No_SQL\Classes\SQL_Manager("test.json");
    $sql->create_collection("test_collection");
    #$sql->collections["test_collection"]->create_document(["name" => "Kirill"]);

    $test = $sql->collections("test_collection")->getOne();
    var_dump($test);
    #var_dump($test);
    #$test->pass = "pass";
    #var_dump($test);

    #$result = $sql->collections["test_collection"]->getOne([["name", "=", "Kirill"]]);
    #$result->set("login", "log");
    #$result->set("password", "pass");
    #var_dump($result);
    #var_dump((array) $result);
    #$sql->collections["test_collection"]->create_document(["name" => "еуые"]);
    #var_dump($sql->collections);
    #print_r($sql->collections);
    #var_dump($sql->collections);
    $sql->save();