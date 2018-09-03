<?php 

class View
{
    public static function showPage($title, $activeButton, $mainParam)
    {
        $pageTitle = $title;
        $active = $activeButton;
        require_once "./Src/Templates/pageTop.php";
        static::loadMain($mainParam);
        require_once "./Src/Templates/pageBottom.php";
    }

}
