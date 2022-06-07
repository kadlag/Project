<?php

//Include constants.php  for SITRURL
include("../config/constants.php");

//Destroy the session

session_destroy();//unset $_session['user']

//2.Redirect to login page

header("location:".SITEURL.'admin/login.php');
?>