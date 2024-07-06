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
$currentPath = basename($_SERVER['PHP_SELF']);

?>

<body>
    <?php clientNavbar() ?>
    <div class="card-media-container">
        <?php clientTechShow()?>
    </div>
    <?php clientFooter() ?>
</body>

<script>
    const form = document.getElementById('searchForm');
    const input = document.getElementById('dropdown_search_modal');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const searchValue = input.value;
        form.action = `Media.php?search=${encodeURIComponent(searchValue)}`;
        form.submit();
    });
</script>

<?php
$FooterFilePath = "../layout/footer.php";

if (file_exists($FooterFilePath)) {
    include($FooterFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$FooterFilePath</strong> - File does not exist.</p>";
    return;
}
?>