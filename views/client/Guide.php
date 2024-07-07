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
    <div class="guide_container">
        <div class="content">
            <h1 class="special_elite_regular">Legislation and Guidance</h1>
            <p class="special_elite_regular">
                This page provides the details of relevant legislation and best practice guidance relating to online social media use. Understanding the legal landscape and following recommended guidelines are crucial for safe and responsible social media engagement.
            </p>
            <p class="special_elite_regular">
                Whether you're a social media manager, content creator, or casual user, staying informed about the rules and regulations governing online interactions helps protect your rights and ensures compliance with the law. Explore the sections below for comprehensive information on various aspects of social media legislation and best practices.
            </p>
            <p class="special_elite_regular">
                Key areas covered include data privacy laws, intellectual property rights, anti-cyberbullying measures, and guidelines for ethical social media marketing. By adhering to these principles, you can contribute to a safer and more respectful online community.
            </p>
        </div>
    </div>
    <br><br><br><br><br><br>
    <br><br>
    <?php clientFooter() ?>
</body>

<?php
$FooterFilePath = "../layout/footer.php";

if (file_exists($FooterFilePath)) {
    include($FooterFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$FooterFilePath</strong> - File does not exist.</p>";
    return;
}
?>