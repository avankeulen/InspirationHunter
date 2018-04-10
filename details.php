<?php 
  
  include_once ('db.inc.php');
  $watch = $_GET['watch'];

$query = "SELECT * FROM posts WHERE id LIKE '{$watch}'";
$conn = new PDO("mysql:host=localhost;dbname=inspiration", "root", "root");
$stmt = $conn->prepare($query);

$stmt->execute();

$result = $stmt->fetchAll();

 ?><!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once ('inc/head.inc.php'); ?>
</head>
<body>
  
<?php foreach( $result as $result ): ?>
    <?php echo $result["user_id"];
    echo "<br>";
    echo $result["title"];
    echo "<br>";
    echo $result["description"];
    echo "<br>";
    echo $result["post_img"]; ?>
    
<?php endforeach ?>
  
</div>

</body>
</html>