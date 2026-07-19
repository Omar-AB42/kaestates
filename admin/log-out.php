<?php
require 'config/constants.php';
session_destroy();
header('location: ' . ROOT_URL . 'admin/sign-in.php');
die();