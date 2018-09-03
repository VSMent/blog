<?php

    require_once 'Routes.php';

    function __autoload($class_name)
    {
        if (file_exists('./Src/Classes/'.$class_name.'.php')) {
            require_once './Src/Classes/'.$class_name.'.php';
        } else if(file_exists('./Controllers/'.$class_name.'.php')) {
            require_once './Controllers/'.$class_name.'.php';
        } else if(file_exists('./Models/'.$class_name.'.php')) {
            require_once './Models/'.$class_name.'.php';
        } else if(file_exists('./Views/'.$class_name.'.php')) {
            require_once './Views/'.$class_name.'.php';
        }
    }
