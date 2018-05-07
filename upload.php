<?php
    include_once ('inc/session_check.inc.php');
    include_once ('classes/Post.class.php');

if (!empty($_POST)){
    $title = $_POST['title'];
    $image = $_FILES['upload_file']['name'];

    $temp = explode(".", $_FILES['upload_file']['name']);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $image = $newfilename;

    $description = $_POST['description'];
    $time = "";
    //$_POST['time'];
    $user_id = $_SESSION['username'];

    if (!empty($image) && !empty($description) && !empty($title)) {

        $post = new Post();
        $post->setImage($image);
        $post->setDescription($description);
        $post->setUserId($user_id);
        $post->setTitle($title);
        $post->setTime($time);

        define ('SITE_ROOT', realpath(dirname(__FILE__)));

        if ($post->SavePost()) {

            $filetmp = $_FILES["upload_file"]["tmp_name"];
            $filename = $image;
            
            $destFile = __DIR__ . '/images/uploads/' . $filename;
            move_uploaded_file($_FILES['upload_file']['tmp_name'], $destFile);
            chmod($destFile, 0666);
            
            header('location: index.php');

        } else {
            $error = "Something went wrong";
        }
    } else {
        $error = "Leave no empty fields!";
    }
}

?><!doctype html>
<html lang="en">
<head>
    <?php include_once ('inc/head.inc.php'); ?>
    <title>Upload Post - Inspiration Hunter</title>
</head>
<body>

<?php include_once ('inc/nav.inc.php'); ?>

<section class="content">
    <h1>Upload Post</h1>
    <form action="" method="post" enctype="multipart/form-data" id="upload-form">
        <?php if (isset($error)): ?>
            <div><?php echo $error; ?></div>
        <?php endif; ?>
        
        <label for="upload-title">Title</label>
        <br>
        <input type="text" name="title" placeholder="Title" id="upload-title">
        <br>


        <label for="upload-file">Image</label>
        <br>
        <div id="prev-div">
            <img id="img-prev" src="#" alt="uploaded image" />
            <br>
        </div>
        <input type="file" name="upload_file"  accept="image/*" id="upload-file" onchange="readURL(this);">
        <br>
        <label for="upload-desc">Description</label>
        <br>
        <input type="text" name="description" placeholder="Description" id="upload-desc">
        <br>
        <input type="text" hidden id="lng" name="lng"><input type="text" hidden id="lat" name="lat">

        <input type="submit" name="submit" value="Upload">
    </form>
    <input type="text" id="error">
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/geolocation.js"></script>
<script>
    $('#prev-div').hide();
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {
                $('#prev-div').show();
                $('#img-prev').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    getLocationName();
</script>


</body>
</html>