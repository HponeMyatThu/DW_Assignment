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

$aims = $camp_type_id = $end_date = $fees = $id = $image1 = $image2 = $image3 = $image4 = $map = $media_id = $name = $start_date = $tech_id = "";

$currentPath = basename($_SERVER['PHP_SELF']);

if (!empty($_GET['id'])) {
    $media = fetchCampignById($_GET['id']);
    if (!empty($media)) {
        foreach ($media as $item) {
            echo "<script>console.log(" . json_encode($item) . ");</script>";
            $aims = $item['aims'];
            $camp_type_id = $item['camp_type_id'];
            $end_date = $item['end_date'];
            $fees = $item['fees'];
            $id = $item['id'];
            $image1 = $item['image1'];
            $image2 = $item['image2'];
            $image3 = $item['image3'];
            $image4 = $item['image4'];
            $map = $item['map'];
            $media_id = $item['media_id'];
            $name = $item['name'];
            $start_date = $item['start_date'];
            $tech_id = $item['tech_id'];
            $description = $item['description'];
            $vision = $item['vision'];
        }
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
                <p class="card-detail-description special_elite_regular"><small class="special_elite_regular">Description :</small> <?php echo empty($description) ? 'No description available.' : htmlspecialchars($description); ?></p>
            </div>
            <div class="card-image-main-dev">
                <img class="card-detail-image" src="<?php echo htmlspecialchars($image3); ?>" alt="Photo 1">
                <img class="card-detail-image" src="<?php echo htmlspecialchars($image4); ?>" alt="Photo 2">
            </div>
            <div class="card-content">
                <div class="main_dev">
                    <div class="sub_dev">
                        <p class="card-detail-description special_elite_regular"><small class="special_elite_regular">Vision :</small> <?php echo empty($vision) ? 'No description available.' : htmlspecialchars($vision); ?></p>
                        <p class="card-detail-description special_elite_regular"><small class="special_elite_regular">Aims :</small> <?php echo empty($vision) ? 'No vision available.' : htmlspecialchars($vision); ?></p>
                        <p class="card-detail-description special_elite_regular"><small class="special_elite_regular">Due-Date :</small> <?php echo empty($start_date) ? 'No start_date available.' : htmlspecialchars($start_date); ?> - <?php echo empty($end_date) ? 'No end_date available.' : htmlspecialchars($end_date); ?></p>
                    </div>
                    <div class="sub_dev">
                        <form action="">
                            <button class="card-btn special_elite_regular">Joined</button>
                        </form>
                    </div>
                </div>
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