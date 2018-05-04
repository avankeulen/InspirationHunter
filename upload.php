<?php
    include_once ('inc/session_check.inc.php');
    include_once ('classes/Post.class.php');

if (!empty($_POST)){
    $title = $_POST['title'];
    $image = $_FILES['upload_file']['name'];
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
            $filepath = "/images/uploads/".$filename;

            move_uploaded_file($im2,SITE_ROOT.$filepath);

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
        <input type="text" name="title" placeholder="Title" id="upload-title">
        <br>
        
        <label for="upload-file">Image</label>
        <input type="file" name="upload_file"  accept="image/*" id="upload-file">
        <br>
        
        <label for="upload-desc">Description</label>
        <input type="text" name="description" placeholder="Description" id="upload-desc">
        <br>

        <input type="submit" name="submit" value="Upload">
    </form>
</section>


</body>
</html>