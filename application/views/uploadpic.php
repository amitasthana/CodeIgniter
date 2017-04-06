<?php


$site_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'/';

//echo "<pre>"; print_r($site_url);


//$site_url = "http://asthana.me/index.php/" ;


?>

<link href="<?php echo $site_url; ?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $site_url; ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $site_url; ?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $site_url; ?>assets/plugins/swiper/css/swiper.css" rel="stylesheet" type="text/css" media="screen"/>
<link class="main-stylesheet" href="<?php echo $site_url; ?>pages/css/pages.css" rel="stylesheet" type="text/css"/>
<link class="main-stylesheet" href="<?php echo $site_url; ?>pages/css/pages-icons.css" rel="stylesheet" type="text/css"/>
<link class="main-stylesheet" href="<?php echo $site_url; ?>pages/css/responsive.css" rel="stylesheet" type="text/css"/>
<link class="main-stylesheet" href="<?php echo $site_url; ?>pages/css/build.css" rel="stylesheet" type="text/css"/>
<!-- END PAGES CSS -->


<script type="<?php echo $site_url; ?>text/javascript" src="<?php echo $site_url; ?>assets/js/js.js"></script>


<script type="text/javascript" src="<?php echo $site_url; ?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo $site_url; ?>pages/js/scrolltopcontrol.js"></script>

<body>
<section class="jumbotron full-height bg-home demo-height-2 " data-pages="parallax">
  <nav class="header bottom" data-pages="header" data-pages-autofixed="true" style="background:none">




  </nav>
  </section>




  <section class="jumbotron  full-height2 demo-height-2 " data-pages="parallax" id="bottom" >
    <div class="container">
      <div class="row">

        <div align="center">

          <div> <h4>



          </h4>  </div>

         </div>

        <form enctype="multipart/form-data" method="post"  action="<?php echo $site_url; echo 'equityvc/doupload' ; ?>">


      </div>
    </div>
  </section>

  <section class="footer-map">
    <div class="input-div">

      <input type="file" name="picture"  class="enter-inp" id="text" required>


  <input name="submit" type="submit" value="Upload " class="enterbg" >




    </div>
  </section>

  <script type="text/javascript" src="<?php echo $site_url; ?>assets/plugins/jquery/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="<?php echo $site_url; ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo $site_url; ?>assets/plugins/vide/jquery.vide.min.js"></script>
  <script type="text/javascript" src="<?php echo $site_url; ?>assets/plugins/velocity/velocity.min.js"></script>
  <script type="text/javascript" src="<?php echo $site_url; ?>assets/plugins/velocity/velocity.ui.js"></script>
  <script src="<?php echo $site_url; ?>assets/plugins/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?php echo $site_url; ?>assets/plugins/jquery-isotope/isotope.pkgd.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo $site_url; ?>pages/js/pages.frontend.js"></script>
  <script type="text/javascript" src="<?php echo $site_url; ?>assets/js/gallery.js"></script>
  <script type="text/javascript">
      function changeState(el) {











          if (el.readOnly) el.checked=el.readOnly=false;
          else if (!el.checked) el.readOnly=el.indeterminate=true;
      }
  </script>
  <script type="text/javascript">
      $(document).ready(function() {
          $('#btnfrontend').on('click', function(e) {
                  $("#frontend").velocity("scroll", {
                      duration: 800,
                      delay: 0,
                      offset: -100
                  });
              })
              // $('#btnbackend').on('click',function(e){
              //      e.preventDefault();
              //     $('#frontend').fadeOut();
              //     $('#dashboard').fadeIn();
              // })
      })
      </script>
  </body>
