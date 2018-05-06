<?php foreach($result as $r): ?>
    <a href="details.php?watch=<?php echo $r['title']; ?>">
        <?php echo $r["title"]; ?>
    </a>
<?php endforeach; ?>