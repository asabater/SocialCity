<?php
session_start(); 
$id = $_GET["id"];

if(isset($_SESSION['id']))
  unset($_SESSION['id']);
$_SESSION["id"] = $id;

//var_dump($_SESSION["id"]);
?>