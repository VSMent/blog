<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="/Src/Css/main.css">
	<title><?=$pageTitle?></title>
</head>
<body>
<?php require_once "./Src/Templates/header.php"; ?>
<section>
<?php if ($_GET['url'] == 'page' || $_GET['url'] == 'post') {?>
	<aside class="arrow" id="left">&lt;Newer</aside>
<?php } ?>
	<main>