<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="<?php echo site_url('assets/bootstrap/css/signin.css');?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url() . 'assets/jquery/jquery-1.12.0.min.js';?>"></script>
    <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js';?>"></script>
  </head>

<?php $this->load->view($main_content); ?>