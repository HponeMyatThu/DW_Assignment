<?php
$IndexFilePath = "../../php/_index.php";
$HeaderFilePath = "../layout/header.php";

if (file_exists($IndexFilePath) && file_exists($HeaderFilePath)) {
    include($IndexFilePath);
    include($HeaderFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$IndexFilePath, $HeaderFilePath</strong> - File does not exist.</p>";
    return;
}

$id = $name = $image1 = $image2 = $description = $media_id = "";

$currentPath = basename($_SERVER['PHP_SELF']);

if (!empty($_GET['id'])) {
    $media = fetchTechById($_GET['id']);
    if (!empty($media)) {
        $item = $media[0];
        echo "<script>console.log(" . json_encode($item) . ");</script>";
        $id = $item['id'];
        $name = $item['name'];
        $image1 = $item['image1'];
        $image2 = $item['image2'];
        $description = $item['description'];
        $media_id = $item['media_id'];
    } else {
        echo "<script>console.log(\"Media not found\");</script>";
    }
}
?>

<body>
    <?php clientNavbar(); ?>
    <div class="card-media-detail-container">
        <div class="card-media-detail">
            <a href="Media.php" class="back-form-detail special_elite_regular">
                &larr;
            </a>
            <div class="card-image-main-dev">
                <img class="card-detail-image" src="<?php echo htmlspecialchars($image1); ?>" alt="Photo 1">
                <img class="card-detail-image" src="<?php echo htmlspecialchars($image2); ?>" alt="Photo 2">
            </div>
            <div class="card-content">
                <h2 class="card-detail-title special_elite_regular"><?php echo empty($name) ? 'Unnamed Technique' : htmlspecialchars($name); ?></h2>
                <p class="card-detail-description special_elite_regular"><?php echo empty($description) ? 'No description available.' : htmlspecialchars($description); ?></p>
            </div>
        </div>
    </div>
    <?php clientFooter(); ?>
</body>

</html>

<?php
$FooterFilePath = "../layout/footer.php";

if (file_exists($FooterFilePath)) {
    include($FooterFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$FooterFilePath</strong> - File does not exist.</p>";
}
?>