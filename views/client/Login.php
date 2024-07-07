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
clientLogin();
?>

<body class="admin_register_body">
    <div class="admin_login_container">
        <form action="Login.php" method="post" onsubmit="return validateForm()">
            <div class="admin_login_main_dev">
                <div class="admin_login_sub_dev">
                    <img src="../../images/register_cover.png" alt="">
                </div>
                <div class="admin_login_sub_dev_form">
                    <div>
                        <div class="admin_register_title_main_dev">
                            <p class="h3_login special_elite_regular">User Login Here</p>
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
                                    <label for="password" class="special_elite_regular">Password</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <div class="admin_login_form-group">
                                <div class="g-recaptcha" data-sitekey="6LfAowQqAAAAABqOVpAXR10qnWsqNC4k1O5zZF7E">
                                </div>
                            </div>
                            <br>
                            <div class="admin_register_form-group">
                                <button type="submit" class="special_elite_regular">Login</button>
                            </div>
                            <div class="admin_register_login-link">
                                <p class="special_elite_regular">Don't have an account?<br><a href="Register.php" class="special_elite_regular">Sign Up Here</a></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</body>

<script>
    function validateForm() {
        var response = grecaptcha.getResponse();
        if (response.length === 0) {
            alert('Please complete the reCAPTCHA validation.');
            return false
        }
        return true;
    }
</script>

<script src="https://www.google.com/recaptcha/api.js"></script>

<?php
$FooterFilePath = "../layout/footer.php";

if (file_exists($FooterFilePath)) {
    include($FooterFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$FooterFilePath</strong> - File does not exist.</p>";
    return;
}
?>