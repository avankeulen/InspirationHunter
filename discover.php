<?php
include_once ('inc/session_check.inc.php');
include_once ('classes/Post.class.php');
include_once ('classes/User.class.php');
include_once ('classes/Comment.class.php');

?><!doctype html>
<html lang="en">
<head>
    <?php include_once ('inc/head.inc.php'); ?>
    <title>Discover - Inspiration Hunter</title>
</head>
<body>

<?php include_once ('inc/nav.inc.php'); ?>


<section class="content">
    <h1 id="welcome">Let's find some people to follow, <strong class="username"><?php echo $_SESSION['username']; ?></strong></h1>

<style>
 #map {
   width: 100%;
   height: 400px;
   background-color: grey;
 }
</style>
      <div id="map"></div>
 


    <?php if (isset($result)): ?>
        <?php include_once ('inc/search.inc.php'); ?>
    <?php endif; ?>

  
        <h3 style="font-weight:700; font-size:1.3em; margin-top: 1.3em;">You might like this posts</h3>
        <?php // include_once ('inc/posts.inc.php');?>
  
    
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>
<script>
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVvQeila2uW_EHtmzE3Ol34HH5XWyXc7A&callback=initMap">
    </script>

</body>
</html>