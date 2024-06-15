<?php
$IndexFilePath = "../../php/_index.php";

if (file_exists($IndexFilePath)) {
    include($IndexFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$IndexFilePath</strong> - File does not exist.</p>";
    return;
}
adminRegister();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="../../styles/index.css?v=<?php echo time(); ?>">
</head>

<body class="admin_register_body">
    <div class="admin_register_container">
        <form action="Register.php" method="post">
            <div class="admin_register_main_dev">
                <div class="admin_register_sub_dev">
                    <img src="../../images/register_cover.png" alt="">
                </div>
                <div class="admin_register_sub_dev_form">
                    <div>
                        <div class="admin_register_title_main_dev">
                            <p class="h3 special_elite_regular">Input Your Information</p>
                            <p class="h6 special_elite_regular">We need you to help us with some basic information for your account creation. Here are our terms and conditions. Please read them carefully</p>
                        </div>
                        <div>
                            <hr class="dotted">
                        </div>
                    </div>
                    <div class="admin_register_form_main_dev">
                        <div class="admin_register_form_sub_dev">
                            <div class="admin_register_form-group">
                                <div class="form_label_with_icon">
                                    <label for="firstname" class="special_elite_regular">FirstName</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="firstname" name="firstname" required>
                            </div>
                            <div class="admin_register_form-group">
                                <div class="form_label_with_icon">
                                    <label for="surname" class="special_elite_regular">SurName</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="surname" name="surname" required>
                            </div>
                            <div class="admin_register_form-group">
                                <div class="form_label_with_icon">
                                    <label for="email" class="special_elite_regular">Email</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="admin_register_form-group">
                                <div class="form_label_with_icon">
                                    <label for="password" class="special_elite_regular">Password</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="password" id="password" name="password" required>
                            </div>
                        </div>

                        <div class="admin_register_form_sub_dev">
                            <div class="admin_register_form-group">
                                <div class="form_label_with_icon">
                                    <label for="pin" class="special_elite_regular">PIN</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" id="pin" name="pin" required>
                            </div>
                            <div class="admin_register_form-group">
                                <div class="form_label_with_icon">
                                    <label for="phone" class="special_elite_regular">Phone</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="question-icon">
                                        <path fill="#000000" fill-rule="evenodd" d="M21.6 12.5a9.6 9.6 0 11-19.199 0 9.6 9.6 0 0119.2 0zm-8.4 4.8a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0zM12 6.5a1.2 1.2 0 00-1.2 1.2v4.8a1.2 1.2 0 102.4 0V7.7A1.2 1.2 0 0012 6.5z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="tel" id="phone" name="phone" required>
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
                            <div class="admin_register_form-group">
                                <button type="submit" class="special_elite_regular">Register</button>
                            </div>
                            <div class="admin_register_login-link">
                                <p class="special_elite_regular">Already have an account?&nbsp;<a href="AdminLogin.php" class="special_elite_regular">Login here</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

<script>
function closeModal() {
  document.getElementById('modal-toggle').checked = false;
}
</script>

</html>