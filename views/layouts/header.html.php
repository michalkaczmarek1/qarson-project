<?php  
//include file with constants
require_once($_SERVER['DOCUMENT_ROOT'] . "/qarson/config/constants.php");
// header template
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Qarson - project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo APP_PATH; ?>assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo APP_PATH; ?>">QarsonProject</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav" >
      <li class="nav-item">
        <a class="nav-link" href="<?php echo APP_PATH; ?>index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo APP_VIEW; ?>form.html.php">Zaimportuj dane</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo APP_VIEW; ?>read.html.php">Lista samochodów</a>
      </li>
    </ul>
</nav>

<div class="container" style="margin-top: 40px; min-height: 770px">
    <div class="row">
        <div class="col" id="content">
<div class="infos">

</div>
