<?php
session_start(); if(!isset($_SESSION['user'])) { header('Location: ../login.php'); exit; }
include("../db.php");
$id = intval($_GET['id'] ?? 0);
if($id){ $conn->query("DELETE FROM servicos WHERE id=$id"); }
header('Location: index.php'); exit;
