<?php
    require 'session.php';

    if($_GET['recursion'] != NULL) {
        $_SESSION['recursion'] = intval($_GET['recursion']);
    }

    if($_GET['forks'] != NULL) {
        $_SESSION['forks'] = intval($_GET['forks']);
    }

    if($_GET['threshold'] != NULL) {
        $_SESSION['threshold'] = intval($_GET['threshold']);
    }

    //hack to make sure slider positions are updated after save
    $recursion = $_SESSION['recursion'];
    $forks = $_SESSION['forks'];
    $threshold = $_SESSION['threshold'];
?>

<!DOCTYPE html>
<html lang="en" style="margin:0;padding:0;height:100%;">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Find the most popular forks of a repository!">
    <meta name="author" content="Caleb Smith">

    <title>Github Fork Finder</title>

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
  </head>

  <body style="margin:0;padding:0;height:100%">

    <div style="min-height:100%;position:relative;">

      <!-- Header -->
      <div class="navbar navbar-default navbar-static-top navbar-inverse" style="margin-bottom:0px;">
        <div class="container-fluid" style="max-width:500px;">
          <div class="navbar-header">
            <a class="navbar-brand" href="http://caleb.techhounds.com/forks">Github Fork Finder</a>
          </div>   
        </div>    
      </div>

      <!-- Body Content -->
      <div class="container" style="max-width:500px;padding-bottom:50px;">
        <!-- PAGE CONTENT GOES HERE -->       
        <div class="text-center">
          <h1>Settings</h1>
          <form action="settings.php">
            
            <div class="panel panel-default">
              <div class="panel-heading">
                Recursion Depth
              </div>        
              <div class="panel-body">
                <input type="range" value=<?php echo $recursion ?> min=0 max=3 class="form-control" name="recursion">
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">
                Forks per Query
              </div>
              <div class="panel-body">
                <input type="range" value=<?php echo $forks ?> min=1 max=100 class="form-control" name="forks">
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">
                Fork value Threshold
              </div>
              <div class="panel-body">
                <input type="range" value=<?php echo $threshold ?> min=0 max=20 class="form-control" name="threshold">
              </div>
            </div>
            
            <div class="panel panel-default">
              <div class="panel-heading">
                Commit History to Compare
              </div>
              <div class="panel-body">
                <input type="range" class="form-control">
              </div>
            </div>
            
            <input type="submit" class="btn btn-success" value="Save" style="width:100px">
          </form>
        </div>
      </div>

      <!-- Footer -->
      <div style="position:absolute;bottom:0;height:50px;width:100%;">
        <div class="text-center">
          <p>
            &copy; Caleb Smith, 2017 
            &middot; <a href="https://github.com/karagenit/forks">View Source</a>
            &middot; <a href="http://caleb.techhounds.com/forks/settings.php">Change Settings</a>
          </p>
        </div>
      </div>

    </div>
  </body>
</html>

