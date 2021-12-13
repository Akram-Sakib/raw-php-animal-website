<?php
require 'config/connect/database.php';
session_destroy();
header('Location:index.php');
?>