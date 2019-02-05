<?php
$config = include('config.php');
$sql = new mysqli('localhost', $config['username'], $config['password'], $config['db']);

if($sql->connect_errno)
  die($sql->error);
?>