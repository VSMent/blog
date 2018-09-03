<?php 

Route::set('', function() {
    header("Location: ".Globals::$host."/page/1");
    exit();
});

Route::set('page', function() {
    CAllPosts::createView($_GET['param']);
});

Route::set('newPost', function() {
    CNewPost::createView('');
});

Route::set('post', function() {
    CFullPost::createView($_GET['param']);
});

Route::set('__returnPost', function() {
    CFullPost::returnPost();
});

Route::set('__returnCSV', function() {
    CFullPost::returnCSV();
});

Route::set('__returnPage', function() {
    CAllPosts::returnPage();
});

