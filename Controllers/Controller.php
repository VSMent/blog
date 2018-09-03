<?php 

class Controller extends Database
{

    public static function createView($param)
    {
        static::loadPage($param);
    }
}
