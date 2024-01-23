<?php
session_start();

require_once("config.php");

$sql = "DELETE FROM users WHERE ";
