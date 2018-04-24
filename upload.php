<?php
    include_once ('inc/session_check.inc.php');
    include_once ('classes/Post.class.php');

if (!empty($_POST)){
    $title = $_POST['title'];
    $image = $_POST['upload_file'];
    $description = $_POST['description'];
    $user_id = $_SESSION['username'];

    if (!empty($image) && !empty($description) && !empty($title)) {
        $post = new Post();
        $post->setImage($image);
        $post->setDescription($description);
        $post->setUserId($user_id);
        $post->setTitle($title);
        if ($post->SavePost()) {
            header('location: index.php');
        } else {
            echo "Something went wrong";
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
    <form action="" method="post">
        <h1>Upload Post</h1>

        <?php if (isset($error)): ?>
            <div><?php echo $error; ?></div>
        <?php endif; ?>

        <input type="text" name="title" placeholder="Title">
        <input type="file" name="upload_file"  accept="image/*">
        <input type="text" name="description" placeholder="Description">
        <input type="submit">
    </form>
</section>


</body>
</html>