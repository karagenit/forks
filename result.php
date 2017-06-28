<?php
    require 'fork-finder.php';
    $finder = new ForkFinder();
    $sorted_forks = $finder->forks;
    $errors = $finder->errors;

    function PrintForks($sorted_forks) {
        foreach($sorted_forks as $name=>$fork) {
            echo "<tr>";
            echo "<th><a href=\"https://github.com/$name\">$name</a></th>";
            //echo "<th>$fork->points</th>";
            echo "<th>".$fork->data->stargazers->totalCount."</th>";
            echo "<th>".$fork->data->watchers->totalCount."</th>";
            echo "<th>".$fork->data->issues->totalCount."</th>";
            echo "<th>".$fork->data->forks->totalCount."</th>";
            echo "</tr>";
        }
    }

    function PrintErrors($errors) {
        foreach($errors as $error) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">";
            echo $error->message." <a href=\"https://github.com/karagenit/forks/issues/new\">[report]</a>";
            echo "</div>";  
        }
    }

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
        <h1 class="text-center">Lookup Results</h1>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Repo</th>
              <th><span class="glyphicon glyphicon-star"></span></th>
              <th><span class="glyphicon glyphicon-eye-open"></span></th>
              <th><span class="glyphicon glyphicon-remove"></span></th>
              <th><span class="glyphicon glyphicon-transfer"></span></th>
            </tr>
          </thead>
          <tbody>
            <?php PrintForks($sorted_forks); ?>
          </tbody>
        </table>
        <?php PrintErrors($errors); ?>
      </div>

      <!-- Footer -->
      <div style="position:absolute;bottom:0;height:65px;width:100%;">
        <div class="text-center">
          <p>
            &copy; Caleb Smith, 2017 <br>
            <a href="https://github.com/karagenit/forks">About</a> &middot;
            <a href="http://caleb.techhounds.com/forks/settings.php">Settings</a>
          </p>
        </div>
      </div>

    </div>
  </body>
</html>

