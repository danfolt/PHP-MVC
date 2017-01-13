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
     <div class="col-md-2">        
        <div class="sidebar">  
           <div class="sidebar-fields">
              <a href="index.php"><img src="img/logo/logoBig.png" alt="inightclub" /></a>
          <form action="index.php?route=search" class="navbar-form navbar-right" role="search" method="post">     
         <input placeholder="Keyword" type="text" name="text-search">           
         </div>
         <div class="sidebar-scrollbars">
                <h6>Location</h6>
                <input placeholder="Location" type="text">
           <h6>(km/mi):</h6>
              <div class="slider-range-container">
                <div class="slider-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-min="1" data-max="60" data-step="2" data-default-min="10" data-default-max="50" data-currency="&nbsp;" aria-disabled="false"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 16.9492%; width: 67.7966%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 16.9492%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 84.7458%;"></a></div>
                <div class="clearfix">
                  <input class="range-from" value="1" type="text">
                  <input class="range-to" value="60" type="text">
                </div>
              </div>
            </div>
            <div class="sidebar-categories">
              <h6>Categories</h6>
              <ul>
                <li>
                  <input type="checkbox">
                  <span class="title">Nightclubs</span>
                  <span class="count">2345</span>
                </li>
                <li>
                  <input type="checkbox">
                  <span class="title">Artists</span>
                  <span class="count">567</span>
                </li>
                <li>
                  <input type="checkbox">
                  <span class="title">Jobboard</span>
                  <span class="count">3678</span>
                </li>
                <li>
                  <input type="checkbox">
                  <span class="title">Agencies</span>
                  <span class="count">378</span>
                </li>
               </ul>
            </div>           
            <div class="sidebar-scrollbars">
              
              <h6 class="margin-top-50">Salary:</h6>
              <div class="slider-range-container">
                <div class="slider-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-min="1" data-max="10000" data-step="2" data-default-min="500" data-default-max="8000" data-currency="$" aria-disabled="false"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 5.0005%; width: 75.0075%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 5.0005%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 80.008%;"></a></div>
                <div class="clearfix">
                  <input class="range-from" value="1" type="text">
                  <input class="range-to" value="60" type="text">
                </div>
              </div>
            </div>
            <div class="sidebar-button">
              <button type="submit" name="button-search" class="btn-medium btn-primary full-width">Filter Results</button>
            </div>
           '.$this->get_categories().'
          </div>
          </div>
          <div class="col-md-7">
     <img src="img/google/goo_ad730x100.png" alt="ad730x100" />
    <div class="page-content">
     
      '.$this->get_content().'
    </div>
    </div>
    <div class="col-md-3">
          <div class="sidebar-listing">
           <img src="img/google/Ad300x250.jpg" alt="ad300x250" />
            <h5 class="sidebar-listing-title">Similar Clubs</h5>
            <div class="listing-offer">
              <h6 class="title"><a href="#">Urban Escape Spa</a></h6>
              <div class="listing-offer-thumbnail">
                <img src="img/listing-offer-thumbnail1.png" alt="">
              </div>
              <div class="listing-offer-content">
                <span class="location"><i class="fa fa-map-marker"></i> Manila, Philippines</span>
                <ul class="rate">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span class="count">208 reviews</span>
              </div>
            </div>
            <div class="listing-offer">
              <h6 class="title"><a href="#">Shear Studio</a></h6>
              <div class="listing-offer-thumbnail">
                <img src="img/listing-offer-thumbnail2.png" alt="">
              </div>
              <div class="listing-offer-content">
                <span class="location"><i class="fa fa-map-marker"></i> Dhaka, Bangladesh</span>
                <ul class="rate">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span class="count">208 reviews</span>
              </div>
            </div>
            <div class="listing-offer">
              <h6 class="title"><a href="#">Derma Spa</a></h6>
              <div class="listing-offer-thumbnail">
                <img src="img/listing-offer-thumbnail3.png" alt="">
              </div>
              <div class="listing-offer-content">
                <span class="location"><i class="fa fa-map-marker"></i> Manila, Philippines</span>
                <ul class="rate">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span class="count">208 reviews</span>
              </div>
            </div>
            <div class="listing-offer">
              <h6 class="title"><a href="#">Kelly Spa</a></h6>
              <div class="listing-offer-thumbnail">
                <img src="img/listing-offer-thumbnail4.png" alt="">
              </div>
              <div class="listing-offer-content">
                <span class="location"><i class="fa fa-map-marker"></i> Manila, Philippines</span>
                <ul class="rate">
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                  <li><i class="fa fa-star"></i></li>
                </ul>
                <span class="count">208 reviews</span>
              </div>
            </div>
            <img src="img/google/Ad2300x250.jpg" alt="ad300x250" />
          </div>
        </div>
    </div>    
    </div>
    <div class="page-footer">
      '.$this->get_footer().'
    </div>
    </div>
<!-- Scripts -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/plugins/superfish.min.js"></script>
<script src="js/jquery.ui.min.js"></script>
<script src="js/plugins/rangeslider.min.js"></script>

<script src="js/plugins/jquery.flexslider-min.js"></script>

<script src="js/uou-accordions.js"></script>

<script src="js/uou-tabs.js"></script>
<script src="js/plugins/select2.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/gmap3.min.js"></script>

<script src="js/scripts.js"></script>
<script src="js/prettify.js"></script>
    <script>
      !function ($) {
        $(function(){
          window.prettyPrint && prettyPrint()
        })
      }(window.jQuery)
    </script>
	
  </body>
  
</html>

';

?>

