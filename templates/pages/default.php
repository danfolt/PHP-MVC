<?php

$main_layout_content = '

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="'.$this->get_metadata('main_keywords').'" />
    <meta name="description" content="'.$this->get_metadata('main_description').'" />
    <meta name="author" content="'.$this->get_metadata('main_author').'" />
    <meta name="robots" content="index, follow, all" />
    <meta name="googlebot" content="index, follow, all" />
    <meta name="distribution" content="global" />
    <title>'.$this->get_metadata('main_title').'</title>
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/grid.css" rel="stylesheet">
    <link href="css/prettify.css" rel="stylesheet">
    <link href="css/default.css" rel="stylesheet">
    <link href="css/'.$this->get_layout().'.css" rel="stylesheet">
    <link href="gallery/logo/favicon.ico" rel="icon">
    <link href="gallery/logo/favicon.ico" rel="shortcut icon"> 
    <base href="'.$this->get_metadata('base_domain').'" target="_self" />
    <script src="js/chart/Chart.js"></script>
    <script src="js/chart/Chart.HorizontalBar.js"></script>
    <script src="js/chart/Ajax.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/'.$this->get_layout().'.js"></script>
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
          </head>

  <body>  
    <div class="toolbar">        
<a href="index.php"><img src="img/logo/logo.png" class="img-logo" alt="logo" /></a>               
        '.$this->get_links().'
      </div>
     </div>
 <div id="main-wrapper" class="business">
 <div class="container">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container">
        '.$this->get_navbar().'
      </div>
    </nav>

<div class="main-content content-business">
  <div class="container">
    <div class="row">
     <div class="col-md-12">
    <div class="page-content">
      '.$this->get_options().
        $this->get_content().'
    </div>
 </div>
</div>
    <div class="page-footer">
      '.$this->get_footer().'
    </div>

  </body>
  
</html>

';

?>

