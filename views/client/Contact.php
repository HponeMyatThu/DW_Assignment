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

verifyClientSession();

contactUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($currentPath); ?></title>
    <link rel="stylesheet" href="../../styles/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php clientNavbar(); ?>
    <br><br><br><br>
    <div class="admin_contact_container">
        <form action="Contact.php" method="post">
            <div class="admin_contact_main_dev">
                <div class="admin_login_sub_dev">
                    <img src="../../images/register_cover.png" alt="Register Cover">
                </div>
                <div class="admin_contact_sub_dev_form">
                    <div>
                        <div class="admin_register_title_main_dev">
                            <p class="h3_login special_elite_regular">Contact Us Here</p>
                        </div>
                        <div>
                            <hr class="dotted_login">
                        </div>
                    </div>
                    <div class="admin_register_form_main_dev">
                        <div class="admin_register_form_sub_dev">
                            <div class="admin_login_form-group">
                                <div class="form_label_with_icon">
                                    <label for="email" class="special_elite_regular">Email</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="admin_login_form-group">
                                <div class="form_label_with_icon">
                                    <label for="phone" class="special_elite_regular">Phone</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="phone" name="phone" required>
                            </div>
                            <div class="admin_register_form-group">
                                <div class="form_label_with_icon">
                                    <label for="address" class="special_elite_regular">Address</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <textarea id="address" name="address" required></textarea>
                            </div>
                            <div class="privacy-policy">
                                <p class="special_elite_regular">By submitting this form, you agree to our <a href="Policy.php" class="special_elite_regular">Privacy Policy</a>.</p>
                            </div>
                            <br>
                            <div class="admin_register_form-group">
                                <button type="submit" class="special_elite_regular">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<br>
<br>
<br>
<?php clientFooter(); ?>

<?php
$FooterFilePath = "../layout/footer.php";

if (file_exists($FooterFilePath)) {
    include($FooterFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$FooterFilePath</strong> - File does not exist.</p>";
}
?>