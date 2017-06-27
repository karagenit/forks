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
                Query Settings
              </div>        
              <div class="panel-body">
                <input type="range" class="form-control"> Recursion Depth
                <input type="range" class="form-control"> Forks per Query
                <input type="range" class="form-control"> Fork Value Threshold
                <input type="range" class="form-control"> Commit History to Compare
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

