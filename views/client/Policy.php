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

<style>

</style>

<body>
    <?php clientNavbar() ?>
    <div class="policy_container">
        <div class="content">
            <h1 class="special_elite_regular">Privacy Policy</h1>
            <p class="special_elite_regular">Your privacy is important to us. It is Your Company's policy to respect your privacy regarding any information we may collect from you across our website,<a class="special_elite_regular"> https://yourwebsite.com</a>, and other sites we own and operate.</p>
            <p class="special_elite_regular">We only ask for personal information when we truly need it to provide a service to you. We collect it by fair and lawful means, with your knowledge and consent. We also let you know why we’re collecting it and how it will be used.</p>
            <p class="special_elite_regular">We only retain collected information for as long as necessary to provide you with your requested service. What data we store, we’ll protect within commercially acceptable means to prevent loss and theft, as well as unauthorized access, disclosure, copying, use, or modification.</p>
            <p class="special_elite_regular">We don’t share any personally identifying information publicly or with third parties, except when required to by law.</p>
            <p class="special_elite_regular">Our website may link to external sites that are not operated by us. Please be aware that we have no control over the content and practices of these sites, and cannot accept responsibility or liability for their respective privacy policies.</p>
            <p class="special_elite_regular">You are free to refuse our request for your personal information, with the understanding that we may be unable to provide you with some of your desired services.</p>
            <p class="special_elite_regular">Your continued use of our website will be regarded as acceptance of our practices around privacy and personal information. If you have any questions about how we handle user data and personal information, feel free to contact us.</p>
            <p class="special_elite_regular">This policy is effective as of 5 july 2024.</p>
        </div>
    </div>
    <?php clientFooter() ?>
</body>

</html>

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