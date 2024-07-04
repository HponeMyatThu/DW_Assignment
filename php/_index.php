<?php
session_start();
const MAX_LOGIN_ATTEMPTS = 3;
const LOCKOUT_TIME = 600;

function DBConnection($parameter)
{
    if ($parameter === "client") {
        $DBConnectionFilePath = "../../db/DBConnection.php";
    } else if ($parameter === "admin") {
        $DBConnectionFilePath = "../../db/DBConnection.php";
    } else if ($parameter === "index") {
        $DBConnectionFilePath = "./db/DBConnection.php";
    }

    if (file_exists($DBConnectionFilePath)) {
        $connection = include($DBConnectionFilePath);
        return $connection;
    } else {
        echo "
        <script>
            console.log('Error: Unable to include file $DBConnectionFilePath - File does not exist.');
        </script>
        ";
        return null;
    }
}

function clientFooter()
{
    $currentPath = basename($_SERVER['PHP_SELF']);
    $title = explode(".", $currentPath);

    echo "
    <footer class=\"footer\">
    <p class=\"special_elite_regular\">Your are At <b> <strong class=\"special_elite_regular bold\">" . $title[0] . "</strong> </b> page.</p>
    <div class=\"social-icons\">
        <a href=\"https://www.facebook.com\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"special_elite_regular\"><i class=\"fab fa-facebook-f\"></i></a>
        <a href=\"https://www.twitter.com\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"special_elite_regular\"><i class=\"fab fa-twitter\"></i></a>
        <a href=\"https://www.instagram.com\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"special_elite_regular\"><i class=\"fab fa-instagram\"></i></a>
        <a href=\"https://www.linkedin.com\" target=\"_blank\" rel=\"noopener noreferrer\" class=\"special_elite_regular\"><i class=\"fab fa-linkedin-in\"></i></a>
    </div>
    <div class=\"footer_copy_right_div\">
    <div>&copy;</div><p class=\"special_elite_regular\">2024 Your Company. All rights reserved.</p>
    </div>
</footer>";
}

if (isset($_POST['update_camp_btn'])) {
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $fees = $_POST['fees'];
        $maps = $_POST['maps'];
        $aims = $_POST['aims'];
        $visions = $_POST['visions'];
        $camp_type_id = $_POST['campType'];
        $media_id = $_POST['mediaType'];
        $tech_id = $_POST['TechType'];

        // Handle file uploads
        $uploadDir = "../../uploads/camp/";
        $image1_upload = uploadFile("image1", $uploadDir);
        $image2_upload = uploadFile("image2", $uploadDir);
        $image3_upload = uploadFile("image3", $uploadDir);
        $image4_upload = uploadFile("image4", $uploadDir);

        $status1 = $image1_upload['status'];
        $status2 = $image2_upload['status'];
        $status3 = $image3_upload['status'];
        $status4 = $image4_upload['status'];

        $image1_path = isset($image1_upload['path']) ? $image1_upload['path'] : '';
        $image2_path = isset($image2_upload['path']) ? $image2_upload['path'] : '';
        $image3_path = isset($image3_upload['path']) ? $image3_upload['path'] : '';
        $image4_path = isset($image4_upload['path']) ? $image4_upload['path'] : '';

        $sql = "
            UPDATE campign
            SET 
                name = '" . $connection->real_escape_string($name) . "',
                description = '" . $connection->real_escape_string($description) . "',
                start_date = '" . $connection->real_escape_string($startDate) . "',
                end_date = '" . $connection->real_escape_string($endDate) . "',
                fees = '" . $connection->real_escape_string($fees) . "',
                aims = '" . $connection->real_escape_string($aims) . "',
                vision = '" . $connection->real_escape_string($visions) . "',
                map = '" . $connection->real_escape_string($maps) . "',
                media_id = '" . $connection->real_escape_string($media_id) . "',
                camp_type_id = '" . $connection->real_escape_string($camp_type_id) . "',
                tech_id = '" . $connection->real_escape_string($tech_id) . "',
                image1 = '" . $connection->real_escape_string($image1_path) . "',
                image2 = '" . $connection->real_escape_string($image2_path) . "',
                image3 = '" . $connection->real_escape_string($image3_path) . "',
                image4 = '" . $connection->real_escape_string($image4_path) . "'
            WHERE id = '" . $connection->real_escape_string($id) . "'
        ";

        $result = $connection->query($sql);

        if ($result === true) {
            toaster("Campaign updated successfully", "success");
        } else {
            toaster("Error updating campaign: " . $connection->error, "error");
        }
    }
}


if (isset($_POST['insert_camp_btn'])) {
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $fees = $_POST['fees'];
        $maps = $_POST['maps'];
        $aims = $_POST['aims'];
        $visions = $_POST['visions'];
        $camp_type_id = $_POST['campType'];
        $media_id = $_POST['mediaType'];
        $tech_id = $_POST['TechType'];

        $uploadDir = "../../uploads/camp/";
        $image1_upload = uploadFile("image1", $uploadDir);
        $image2_upload = uploadFile("image2", $uploadDir);
        $image3_upload = uploadFile("image3", $uploadDir);
        $image4_upload = uploadFile("image4", $uploadDir);

        $status1 = $image1_upload['status'];
        $status2 = $image2_upload['status'];
        $status3 = $image3_upload['status'];
        $status4 = $image4_upload['status'];

        $path1 = isset($image1_upload['path']) ? $image1_upload['path'] : "No path";
        $path2 = isset($image2_upload['path']) ? $image2_upload['path'] : "No path";
        $path3 = isset($image3_upload['path']) ? $image3_upload['path'] : "No path";
        $path4 = isset($image4_upload['path']) ? $image4_upload['path'] : "No path";

        if ($status1 && $status2 && $status3 && $status4) {
            $image1_path = $image1_upload['path'];
            $image2_path = $image2_upload['path'];
            $image3_path = $image3_upload['path'];
            $image4_path = $image4_upload['path'];

            $sql = "INSERT INTO campign (name, description, image1, image2, image3, image4, start_date, end_date, fees, aims, vision, map, status, media_id, camp_type_id, tech_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'DRAFT', ?, ?, ?)";

            $stmt = $connection->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sssssssssssssss", $name, $description, $image1_path, $image2_path, $image3_path, $image4_path, $startDate, $endDate, $fees, $aims, $visions, $maps, $media_id, $camp_type_id, $tech_id);

                if ($stmt->execute()) {
                    toaster("Campaign created successfully!", "success");
                } else {
                    toaster("Error: " . $stmt->error, "error");
                }
                $stmt->close();
            } else {
                toaster("Error: Could not prepare the SQL statement", "error");
            }
        } else {
            toaster("Error: Image upload failed. Please try again.", "error");
        }
    }
}

function toaster($message, $failOrSuccess)
{
    echo "<div class='toaster' id='toaster'>";
    echo "<div class='toaster-content'>";
    echo "<p class='special_elite_regular $failOrSuccess'>$message</p>";
    echo "</div>";
    echo "</div>";
}

function adminContactUs()
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    $query = "SELECT * FROM contact_us";
    $queryUser = "SELECT * FROM user";

    // Prepare statements
    $stmt = $connection->prepare($query);
    $stmtUser = $connection->prepare($queryUser);

    if ($stmt === false || $stmtUser === false) {
        toaster("Error preparing statement: " . $connection->error, "error");
        return;
    }

    $result = $stmt->execute();

    if ($result === false) {
        toaster("Error executing statement: " . $stmt->error, "error");
        return;
    }

    $result = $stmt->get_result();
    $resultUser = $stmtUser->execute();

    if ($resultUser === false) {
        toaster("Error executing statement: " . $stmtUser->error, "error");
        return;
    }

    $resultUser = $stmtUser->get_result();

    if ($result->num_rows > 0 && $resultUser->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Initialize a flag to track if matching user_id is found
            $userFound = false;

            // Loop through user results to find matching user_id
            while ($rowUser = $resultUser->fetch_assoc()) {
                if ($row['user_id'] === $rowUser['id']) {
                    if ($row['status'] === "DONE") {
                        break;
                    }
                    echo "
                        <li class=\"table-row\">
                            <div class=\"col col-1 special_elite_regular\" data-label=\"Id : \">" . $row['id'] . "</div>" .
                        "<div class=\"col col-3 special_elite_regular\" data-label=\"UserName : \">" . $rowUser['firstname'] . $rowUser['surname'] . "</div>" .
                        "<div class=\"col col-2 special_elite_regular\" data-label=\"Email\">" . $row['email'] . "</div>" .
                        "<div class=\"col col-3 special_elite_regular\" data-label=\"Phone : \">" . $row['phone'] . "</div>" .
                        "<div class=\"col col-1 special_elite_regular\" data-label=\"Status : \"><a class=\"special_elite_regular\">" . $row['status'] . "</a></div>" .
                        "</li>
                    ";
                    $userFound = true;
                    break;
                }
            }
            if (!$userFound) {
                echo "
                    <li class=\"table-row\">
                        <div class=\"col col-12 special_elite_regular\" data-label=\"NOTE:\">" . "contact id: " .  $row['id'] . "<br/>Already contact to user: " . "(" . $rowUser['firstname'] . $rowUser['surname'] . ")" . "</div>
                    </li>
                ";
            }
            $resultUser->data_seek(0);
        }
    } else {
        echo "
            <li class=\"table-row\">
                <div class=\"col col-12 special_elite_regular\" data-label=\"Id\">No user submitted contact us form.</div>
            </li>
        ";
    }
    $stmt->close();
    $stmtUser->close();
}


function adminRegister()
{
    $connection = DBConnection("admin");

    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pin = $_POST['pin'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $status = 'PENDING';

        $query = "INSERT INTO admin (firstname, surname, email, password, pin, phone, address, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        if ($stmt === false) {
            toaster("Error preparing statement: $connection->error", "error");
        } else {
            $stmt->bind_param('ssssssss', $firstname, $surname, $email, $hashedPassword, $pin, $phone, $address, $status);
            $result = $stmt->execute();
            if ($result === false) {
                toaster("Error executing statement: $stmt->error ", "error");
            } else {
                toaster("Admin Register successfully", "success");
            }
            $stmt->close();
        }
    }
}

function adminLogin()
{
    $connection = DBConnection("admin");

    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the user is locked out
        if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= MAX_LOGIN_ATTEMPTS) {
            $last_attempt_time = $_SESSION['last_attempt_time'];
            if (time() - $last_attempt_time < LOCKOUT_TIME) {
                toaster("Too many login attempts. Please try again in 10 minutes", "error");
                return;
            } else {
                // Reset attempts after lockout period
                $_SESSION['failed_attempts'] = 0;
                unset($_SESSION['last_attempt_time']);
            }
        }

        $query = "SELECT id, password FROM admin WHERE email = ?";
        $stmt = $connection->prepare($query);
        if ($stmt === false) {
            toaster("Error preparing statement:" . $connection->error, "error");
            return;
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            toaster("Error executing statement:" . $stmt->error, "error");
            return;
        }

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                setcookie('token', '', time() - 3600, '/');

                $token = array(
                    'role' => 'admin',
                    'id' => $user['id'],
                    'email' => $email,
                );

                $token_json = json_encode($token);

                setcookie('token', $token_json, time() + (86400 * 30), '/');
                session_start();

                // Reset failed attempts on successful login
                $_SESSION['failed_attempts'] = 0;
                unset($_SESSION['last_attempt_time']);

                toaster("User login successful", "success");

                header("Location: Dashboard.php");
                exit();
            } else {
                handleFailedLoginAttempt();
            }
        } else {
            handleFailedLoginAttempt();
        }

        $stmt->close();
    }
}

function handleFailedLoginAttempt()
{
    if (!isset($_SESSION['failed_attempts'])) {
        $_SESSION['failed_attempts'] = 0;
    }
    $_SESSION['failed_attempts']++;
    $_SESSION['last_attempt_time'] = time();

    if ($_SESSION['failed_attempts'] >= MAX_LOGIN_ATTEMPTS) {
        toaster("Too many login attempts. Please try again in 10 minutes.", "error");
    } else {
        toaster("Invalid email or password", "error");
    }
}

function clientRegister()
{
    $connection = DBConnection("admin");

    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $firstname = $_POST['firstname'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $pin = $_POST['pin'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $status = 'PENDING';

        $query = "INSERT INTO user (firstname, surname, email, password, pin, phone, address, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        if ($stmt === false) {
            toaster("Error preparing statement: $connection->error", "error");
        } else {
            $stmt->bind_param('ssssssss', $firstname, $surname, $email, $hashedPassword, $pin, $phone, $address, $status);
            $result = $stmt->execute();
            if ($result === false) {
                toaster("Error executing statement: $stmt->error ", "error");
            } else {
                toaster("User Register successfully", "success");
            }
            $stmt->close();
        }
    }
}

function clientLogin()
{
    $connection = DBConnection("client");

    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the user is locked out
        if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= MAX_LOGIN_ATTEMPTS) {
            $last_attempt_time = $_SESSION['last_attempt_time'];
            if (time() - $last_attempt_time < LOCKOUT_TIME) {
                toaster("Too many login attempts. Please try again in 10 minutes", "error");
                return;
            } else {
                // Reset attempts after lockout period
                $_SESSION['failed_attempts'] = 0;
                unset($_SESSION['last_attempt_time']);
            }
        }

        $query = "SELECT id, password FROM user WHERE email = ?";
        $stmt = $connection->prepare($query);
        if ($stmt === false) {
            toaster("Error preparing statement:" . $connection->error, "error");
            return;
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result === false) {
            toaster("Error executing statement:" . $stmt->error, "error");
            return;
        }

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                setcookie('token', '', time() - 3600, '/');

                $token = array(
                    'role' => 'user',
                    'id' => $user['id'],
                    'email' => $email,
                );

                $token_json = json_encode($token);

                setcookie('token', $token_json, time() + (86400 * 30), '/');
                session_start();

                // Reset failed attempts on successful login
                $_SESSION['failed_attempts'] = 0;
                unset($_SESSION['last_attempt_time']);

                toaster("User login successful", "success");

                header("Location:  ../../index.php");
                exit();
            } else {
                handleFailedLoginAttempt();
            }
        } else {
            handleFailedLoginAttempt();
        }

        $stmt->close();
    }
}

function DebugLog($rawString, $value)
{
    if (is_array($value)) {
        $value = json_encode($value);
    }

    echo "<script>" .
        "console.log('$rawString : $value')" .
        "</script>";
}

function verifyAdminSession()
{
    if (isset($_COOKIE['token'])) {
        $token_json = $_COOKIE['token'];
        $token = json_decode($token_json, true);

        DebugLog("_index.php => verifyAdminSession", json_encode($token));

        if (!isset($token['role']) || $token['role'] !== 'admin') {
            header("Location: Login.php");
            exit();
        }

        return $token;
    } else {
        header("Location: Login.php");
        exit();
    }
}

function verifyClientSession()
{
    if (isset($_COOKIE['token'])) {
        $token_json = $_COOKIE['token'];
        $token = json_decode($token_json, true);

        DebugLog("_index.php => verifyClientSession", json_encode($token));

        if (!isset($token['role']) || $token['role'] !== 'user') {
            header("Location: Login.php");
            exit();
        }

        return $token_json;
    } else {
        header("Location: Login.php");
        exit();
    }
}


function adminLogout()
{
    session_start();
    session_destroy();

    setcookie('token', '', time() - 3600, '/');
    header("Location: Login.php");
    exit();
}

function clientNavbar()
{
    $currentPath = basename($_SERVER['PHP_SELF'], ".php");

    echo "
    <header>
        <div class=\"navbar\">
            <div class=\"logo\">
                <a href=\"../../index.php\" class=\"special_elite_regular\">CAMPAIGN</a>
            </div>
            <ul class=\"links\">
                <li><a href=\"Information.php\" class=\"special_elite_regular " . ($currentPath == 'Information' ? 'active' : '') . "\">Information</a></li>
                <li><a href=\"Media.php\" class=\"special_elite_regular " . ($currentPath == 'Media' ? 'active' : '') . "\">Media</a></li>
                <li class=\"about_nav\"><a class=\"special_elite_regular\" " . ($currentPath != 'Media' || $currentPath != 'Information' ? 'active' : '') . "\">About</a></li>
            </ul>
            <div class=\"icons\">
                <form action=\"\" method=\"GET\" class=\"search-form\">
                    <input type=\"text\" name=\"search\" class=\"special_elite_regular\" placeholder=\"Search\" id=\"search-input\">
                </form>
                <div class=\"toggle_btn\">
                    <i class=\"fa fa-bars\" aria-hidden=\"true\"></i>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class=\"dropdown_about_menu\">
            <ul>
                <li><a href=\"Parent.php\" class=\"special_elite_regular " . ($currentPath == 'Parent' ? 'active' : '') . "\">Parent</a></li>
                <li><a href=\"Livestream.php\" class=\"special_elite_regular " . ($currentPath == 'Livestream' ? 'active' : '') . "\">Livestream</a></li>
                <li><a href=\"Contact.php\" class=\"special_elite_regular " . ($currentPath == 'Contact' ? 'active' : '') . "\">Contact</a></li>
                <li><a href=\"Guide.php\" class=\"special_elite_regular " . ($currentPath == 'Guide' ? 'active' : '') . "\">Guide</a></li>
            </ul>
        </div>
        <div class=\"dropdown_menu\">
            <ul>
                <li><a href=\"../../index.php\" class=\"special_elite_regular " . ($currentPath == 'index' ? 'active' : '') . "\">Home</a></li>
                <li><a href=\"Information.php\" class=\"special_elite_regular " . ($currentPath == 'Information' ? 'active' : '') . "\">Information</a></li>
                <li><a href=\"Media.php\" class=\"special_elite_regular " . ($currentPath == 'Media' ? 'active' : '') . "\">Media</a></li>
                <li><a href=\"Parent.php\" class=\"special_elite_regular " . ($currentPath == 'Parent' ? 'active' : '') . "\">Parent</a></li>
                <li><a href=\"Livestream.php\" class=\"special_elite_regular " . ($currentPath == 'Livestream' ? 'active' : '') . "\">Livestream</a></li>
                <li><a href=\"Contact.php\" class=\"special_elite_regular " . ($currentPath == 'Contact' ? 'active' : '') . "\">Contact</a></li>
                <li><a href=\"Guide.php\" class=\"special_elite_regular " . ($currentPath == 'Guide' ? 'active' : '') . "\">Guide</a></li>
            </ul>
        </div>
        <div class=\"dropdown_search\">
            <input placeholder=\"Search\" id=\"dropdown_search_modal\" class=\"special_elite_regular\">
        </div>
    </main>
    ";
}


function contactUser()
{
    $connection = DBConnection("client");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $token = verifyClientSession();
        $tokenArray = json_decode($token, true);

        $user_id = isset($tokenArray['id']) ? $tokenArray['id'] : null;

        $query = "INSERT INTO contact_us (email, phone, address, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        if (!$stmt) {
            toaster("Prepare failed: (" . $connection->errno . ") " . $connection->error, "error");
            return;
        }

        $stmt->bind_param("sssi", $email, $phone, $address, $user_id);
        if (!$stmt->execute()) {
            toaster("Execute failed: (" . $stmt->errno . ") " . $stmt->error, "error");
            return;
        }

        $stmt->close();
        $connection->close();

        toaster("Contact information submitted successfully!", "success");
    }
}

if (isset($_POST['insert_media_btn'])) {
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $media_name = $_POST['media_name'];
        $link = $_POST['link'];
        $uploadDir = "../../uploads/media/";
        $image_upload = uploadFile("image", $uploadDir);

        $status = $image_upload['status'];
        $path = isset($image_upload['path']) ? $image_upload['path'] : "No path";

        if ($image_upload['status']) {
            $image_path = $image_upload['path'];
            $sql = "INSERT INTO media (name, image, media_link) VALUES (?,?,?);";
            $stmt = $connection->prepare($sql);
            if ($stmt === false) {
                toaster("ERROR IN STMT", "error");
            } else {
                $stmt->bind_param("sss", $media_name, $image_path, $link);
                $result = $stmt->execute();
                if ($result === false) {
                    toaster("ERROR IN RESULT", "error");
                } else {
                    toaster("SUCCESS", "success");
                    header("Location: Media.php");
                }
                $stmt->close();
            }
            toaster("SUCCESS", "success");
        }
    }
}

if (isset($_POST['update_media_btn'])) {
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $media_name = $_POST['media_name'];
        $link = $_POST['link'];
        $uploadDir = "../../uploads/media/";
        $image_upload = uploadFile("image", $uploadDir);

        $status = $image_upload['status'];
        $path = isset($image_upload['path']) ? $image_upload['path'] : "No path";

        if ($image_upload) {
            $image_path = $image_upload['path'];
            $sql = "UPDATE media SET name = ?, image = ?, media_link = ? WHERE id = ?";
            $stmt = $connection->prepare($sql);
            if ($stmt === false) {
                toaster("ERROR IN STMT", "error");
            } else {
                $stmt->bind_param("sssi", $media_name, $image_path, $link, $id);
                $result = $stmt->execute();
                if ($result === false) {
                    toaster("ERROR IN RESULT", "error");
                } else {
                    toaster("SUCCESS", "success");
                    header("Location: Media.php");
                }
                $stmt->close();
            }
            toaster("SUCCESS", "success");
        }
    }
}

if (isset($_POST['update_camp_type_btn'])) {
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $media_name = $_POST['media_name'];

        $sql = "UPDATE campign_type SET name = ? WHERE id = ?";
        $stmt = $connection->prepare($sql);
        if ($stmt === false) {
            toaster("ERROR IN STMT", "error");
        } else {
            $stmt->bind_param("si", $media_name, $id);
            $result = $stmt->execute();
            if ($result === false) {
                toaster("ERROR IN RESULT", "error");
            } else {
                toaster("SUCCESS", "success");
                header("Location: CampaignType.php");
                exit();
            }
            $stmt->close();
        }
    }
}

function displayCampTypeInCampRegister($camp_id = null)
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        echo "<script>toaster('Error: Database connection could not be established', 'error');</script>";
        return;
    }
    $query = "SELECT * FROM campign_type;";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        echo "<script>toaster('Prepare failed: (" . $connection->errno . ") " . $connection->error . "', 'error');</script>";
        return;
    }
    $stmt->execute();
    $resultSet = $stmt->get_result();
    $camp_types = [];
    if ($resultSet->num_rows > 0) {
        $camp_types = $resultSet->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
    $connection->close();
    echo "<div class=\"camp_lbl_text\">" .
        "<label for=\"link\" class=\"special_elite_regular lbl_center\">C_id:</label>" .
        "<select name=\"campType\" id=\"campType\" class=\"special_elite_regular\">" .
        "<option value=\"campType\">Select Campaign Type</option>";
    foreach ($camp_types as $campTypeItem) {
        $selected = ($campTypeItem['id'] == $camp_id) ? "selected" : "";
        echo "<option value=\"" . $campTypeItem['id'] . "\" $selected>" . htmlspecialchars($campTypeItem['name']) . "</option>";
    }
    echo "</select></div>";
}

function displayTechInCampRegister($tech_id = null)
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        echo "<script>toaster('Error: Database connection could not be established', 'error');</script>";
        return;
    }
    $query = "SELECT * FROM technique;";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        echo "<script>toaster('Prepare failed: (" . $connection->errno . ") " . $connection->error . "', 'error');</script>";
        return;
    }

    $stmt->execute();
    $resultSet = $stmt->get_result();
    $media = [];
    if ($resultSet->num_rows > 0) {
        $media = $resultSet->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
    $connection->close();

    echo "<div class=\"camp_lbl_text\">" .
        "<label for=\"link\" class=\"special_elite_regular lbl_center\">T_id:</label>" .
        "<select name=\"TechType\" id=\"TechType\" class=\"special_elite_regular\">" .
        "<option value=\"TechType\">Select Media</option>";

    foreach ($media as $mediaItem) {
        $selected = ($mediaItem['id'] == $tech_id) ? "selected" : "";
        echo "<option value=\"" . $mediaItem['id'] . "\" $selected>" . htmlspecialchars($mediaItem['name']) . "</option>";
    }

    echo "</select></div>";
}

function displayMediaTypeInTechRegister($media_id = null)
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        echo "<script>toaster('Error: Database connection could not be established', 'error');</script>";
        return;
    }

    $query = "SELECT * FROM media;";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        echo "<script>toaster('Prepare failed: (" . $connection->errno . ") " . $connection->error . "', 'error');</script>";
        return;
    }

    $stmt->execute();
    $resultSet = $stmt->get_result();
    $media = [];
    if ($resultSet->num_rows > 0) {
        $media = $resultSet->fetch_all(MYSQLI_ASSOC);
    }
    $stmt->close();
    $connection->close();

    echo "<div class=\"camp_lbl_text\">" .
        "<label for=\"link\" class=\"special_elite_regular lbl_center\">M_id:</label>" .
        "<select name=\"mediaType\" id=\"mediaType\" class=\"special_elite_regular\">" .
        "<option value=\"mediaType\">Select Media</option>";

    foreach ($media as $mediaItem) {
        $selected = ($mediaItem['id'] == $media_id) ? "selected" : "";
        echo "<option value=\"" . $mediaItem['id'] . "\" $selected>" . htmlspecialchars($mediaItem['name']) . "</option>";
    }

    echo "</select></div>";
}


if (isset($_POST['insert_tech_btn'])) {
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $media_name = $_POST['media_name'];
        $description = $_POST['description'];
        $media_type_id = $_POST['mediaType'];
        $uploadDir = "../../uploads/technique/";
        $image1_upload = uploadFile("image1", $uploadDir);
        $image2_upload = uploadFile("image2", $uploadDir);

        $status1 = $image1_upload['status'];
        $status2 = $image2_upload['status'];
        $path1 = isset($image1_upload['path']) ? $image1_upload['path'] : "No path";
        $path2 = isset($image2_upload['path']) ? $image2_upload['path'] : "No path";

        if ($image1_upload['status'] && $image2_upload['status']) {
            $image1_path = $image1_upload['path'];
            $image2_path = $image2_upload['path'];
            $sql = "INSERT INTO technique (name, description, image1, image2, media_id) VALUES (?,?,?,?,?);";
            $stmt = $connection->prepare($sql);
            if ($stmt === false) {
                toaster("ERROR IN STMT", "error");
            } else {
                $stmt->bind_param("ssssi", $media_name, $description, $image1_path, $image2_path, $media_type_id);
                $result = $stmt->execute();
                if ($result === false) {
                    toaster("Error: Execution failed", "error");
                } else {
                    toaster("Success: Technique inserted successfully", "success");
                    header("location: MediaType.php");
                    exit();
                }
                $stmt->close();
            }
            toaster("SUCCESS", "success");
        }
    }
}

if (isset($_POST['update_tech_btn'])) {
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $media_name = $_POST['media_name'];
        $description = $_POST['description'];
        $media_type_id = $_POST['mediaType'];
        $uploadDir = "../../uploads/technique/";
        $image1_upload = uploadFile("image1", $uploadDir);
        $image2_upload = uploadFile("image2", $uploadDir);

        $status1 = $image1_upload['status'];
        $status2 = $image2_upload['status'];
        $path1 = isset($image1_upload['path']) ? $image1_upload['path'] : "No path";
        $path2 = isset($image2_upload['path']) ? $image2_upload['path'] : "No path";

        if ($image1_upload['status'] && $image2_upload['status']) {
            $image1_path = $image1_upload['path'];
            $image2_path = $image2_upload['path'];
            $sql = "UPDATE technique SET name=?, description=?, image1=?, image2=?, media_id=? WHERE id=?";
            $stmt = $connection->prepare($sql);
            if ($stmt === false) {
                toaster("ERROR IN STMT", "error");
            } else {
                $stmt->bind_param("ssssii", $media_name, $description, $image1_path, $image2_path, $media_type_id, $id);
                $result = $stmt->execute();
                if ($result === false) {
                    toaster("Error: Execution failed", "error");
                } else {
                    toaster("Success: Technique updated successfully", "success");
                    header("location: MediaType.php");
                    exit();
                }
                $stmt->close();
            }
        } else {
            toaster("Error: Image upload failed", "error");
        }
    }
}

function fetchMediaById($id)
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return [];
    }

    $query = "SELECT * FROM media WHERE id = ?;";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        toaster("Prepare failed: (" . $connection->errno . ") " . $connection->error, "error");
        return [];
    }

    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    if (!$result) {
        toaster("Execute failed: (" . $stmt->errno . ") " . $stmt->error, "error");
        return [];
    }

    $resultSet = $stmt->get_result();
    if ($resultSet->num_rows > 0) {
        $media = $resultSet->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $connection->close();
        return $media;
    } else {
        $stmt->close();
        $connection->close();
        return [];
    }
}

function fetchCampignById($id)
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return [];
    }
    $query = "SELECT * FROM campign WHERE id = ?;";
    $stmte = $connection->prepare($query);
    if (!$stmte) {
        toaster("Prepare failed: (" . $connection->errno . ") " . $connection->error, "error");
        return [];
    }
    $stmte->bind_param("i", $id);
    $result = $stmte->execute();
    if (!$result) {
        toaster("Execute failed: (" . $stmte->errno . ") " . $stmte->error, "error");
        return [];
    }

    $resultSet = $stmte->get_result();
    if ($resultSet->num_rows > 0) {
        $campign = $resultSet->fetch_all(MYSQLI_ASSOC);
        $stmte->close();
        $connection->close();
        return $campign;
    } else {
        $stmte->close();
        $connection->close();
        return [];
    }
}

function fetchTechById($id)
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return [];
    }

    $query = "SELECT * FROM technique WHERE id = ?;";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        toaster("Prepare failed: (" . $connection->errno . ") " . $connection->error, "error");
        return [];
    }

    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    if (!$result) {
        toaster("Execute failed: (" . $stmt->errno . ") " . $stmt->error, "error");
        return [];
    }

    $resultSet = $stmt->get_result();
    if ($resultSet->num_rows > 0) {
        $media = $resultSet->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $connection->close();
        return $media;
    } else {
        $stmt->close();
        $connection->close();
        return [];
    }
}

function fetchCampignTypeById($id)
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return [];
    }
    $query = "SELECT * FROM campign_type WHERE id = ?;";
    $stmt = $connection->prepare($query);
    if (!$stmt) {
        toaster("Prepare failed: (" . $connection->errno . ") " . $connection->error, "error");
        return [];
    }
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    if (!$result) {
        toaster("Execute failed: (" . $stmt->errno . ") " . $stmt->error, "error");
        return [];
    }
    $resultSet = $stmt->get_result();
    if ($resultSet->num_rows > 0) {
        $media = $resultSet->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $connection->close();
        return $media;
    } else {
        $stmt->close();
        $connection->close();
        return [];
    }
}

function showMedia()
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    $query = "SELECT * FROM media;";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo
            "
            <li class=\"table-row\">
                <div class=\"col col-1 special_elite_regular\" data-label=\"Id : \"> " . $row['id'] . "</div> " .
                "<div class=\"col col-2 special_elite_regular\" data-label=\"Name : \">" . $row['name'] . " </div>" .
                "<div class=\"col col-3 special_elite_regular\" data-label=\"Image : \">
                    <div class=\"sub_dev\">
                        <div class=\"image-preview\">
                            <img src=\"" . $row['image'] . "\" alt=\"\">
                        </div>
                    </div>
                </div>
                <div class=\"col col-2 special_elite_regular\" data-label=\"Link : \"><a class=\"special_elite_regular\">" . $row['media_link'] . "</a></div>
                <div class=\"col col-1 special_elite_regular\" data-label=\"Action : \">
                <div class=\"\">
                    <form action=\"Media.php\" method=\"POST\">
                        <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                        <button class=\"special_elite_regular btn_update\" href=\"Media.php\" id=\"media_update_bth\" name=\"media_update_bth\">Update</button>
                    </form>
                    <br/>
                    <form action=\"Media.php\" method=\"POST\">
                        <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                        <button class=\"special_elite_regular btn_delete\" href=\"Media.php\" id=\"media_delete_bth\" name=\"media_delete_bth\">Delete</button>
                    </form> 
                </div>
                </div>
            </li>
            ";
        }
    } else {
        echo "
        <li class=\"table-row\">
            <div class=\"col col-12 special_elite_regular\" data-label=\"Id\">No Media found.</div>
        </li>
        ";
    }
}

function clientMediaShowIndex()
{
    $connection = DBConnection("index");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    $searchQuery = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';

    if (!empty($searchQuery)) {
        $query = "SELECT * FROM technique WHERE name LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%';";
    } else {
        $query = "SELECT * FROM technique;";
    }

    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = $row['image1'];
            $updatedImagePath = str_replace('../../uploads', './uploads', $imagePath);
            echo
            "
           <div class=\"card_hor\">
            <img src=\"" .  $updatedImagePath . "\" alt=\"Card image\" class=\"card-img\">
            <div class=\"card-content\">
                <h2 class=\"card-title special_elite_regular\">" . $row['name'] . "</h2>
                <p class=\"card-description special_elite_regular\">". (strlen($row['description']) > 100 ? substr(htmlspecialchars($row['description']), 0, 100) . '...' : htmlspecialchars($row['description'])) ."</p>
                <a href=\"MediaDetail.php?id=" . htmlspecialchars($row['id']) . "\" class=\"card-btn special_elite_regular\">Read More</a>
            </div>
        </div>
            ";
        }
    } else {
        echo "<p>No results found for '$searchQuery'</p>";
    }
}

function clientShowMediaIndex()
{
    $connection = DBConnection("index");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }

    $query = "SELECT * FROM media;";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = $row['image'];
            $updatedImagePath = str_replace('../../uploads', './uploads', $imagePath);
            echo
            "
           <div class=\"card_hor\">
            <img src=\"" .  $updatedImagePath . "\" alt=\"Card image\" class=\"card-img\">
            <div class=\"card-content\">
                <h2 class=\"card-title special_elite_regular\">" . $row['name'] . "</h2>
                <p class=\"card-description special_elite_regular\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis libero eu elit sagittis feugiat.</p>
            </div>
        </div>
            ";
        }
    }
}

function clientTechShow()
{
    $connection = DBConnection("client");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }
    $searchQuery = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';

    if (!empty($searchQuery)) {
        $query = "SELECT * FROM technique WHERE name LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%';";
    } else {
        $query = "SELECT * FROM technique;";
    }

    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class=\"card\">
                <img src=\"" . htmlspecialchars($row['image1']) . "\" alt=\"Card image\" class=\"card-img\">
                <div class=\"card-content\">
                    <h2 class=\"card-title special_elite_regular\">" . htmlspecialchars($row['name']) . "</h2>
                    <p class=\"card-description special_elite_regular\">" . (strlen($row['description']) > 100 ? substr(htmlspecialchars($row['description']), 0, 100) . '...' : htmlspecialchars($row['description'])) . "</p>
                    <a href=\"MediaDetail.php?id=" . htmlspecialchars($row['id']) . "\" class=\"card-btn special_elite_regular\">Read More</a>
                </div>
            </div>
            ";
        }
    } else {
        echo "<p>No results found for '$searchQuery'</p>";
    }
}

function clientInformationShow()
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }
    $searchQuery = isset($_GET['search']) ? $connection->real_escape_string($_GET['search']) : '';

    if (!empty($searchQuery)) {
        $query = "SELECT * FROM campign WHERE name LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%';";
    } else {
        $query = "SELECT * FROM campign;";
    }

    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class=\"card\">
                <img src=\"" . htmlspecialchars($row['image1']) . "\" alt=\"Card image\" class=\"card-img\">
                <div class=\"card-content\">
                    <h2 class=\"card-title special_elite_regular\">" . htmlspecialchars($row['name']) . "</h2>
                    <p class=\"card-description special_elite_regular\">" . (strlen($row['description']) > 100 ? substr(htmlspecialchars($row['description']), 0, 100) . '...' : htmlspecialchars($row['description'])) . "</p>
                    <a href=\"InformationDetail.php?id=" . htmlspecialchars($row['id']) . "\" class=\"card-btn special_elite_regular\">Detail</a>
                </div>
            </div>
            ";
        }
    } else {
        echo "<p>No results found for '$searchQuery'</p>";
    }
}


function showCamp()
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        echo "<script>toaster('Error: Database connection could not be established', 'error');</script>";
        return;
    }

    $query = "
        SELECT 
            c.id, 
            c.name, 
            m.name AS media_name, 
            t.name AS technique_name, 
            ct.name AS camp_type_name 
        FROM 
            campign c
        JOIN 
            media m ON c.media_id = m.id
        JOIN 
            technique t ON c.tech_id = t.id
        JOIN 
            campign_type ct ON c.camp_type_id = ct.id
    ";

    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo
            "
            <li class=\"table-row\">
                <div class=\"col col-1 special_elite_regular\">" . htmlspecialchars($row['id']) . "</div>
                <div class=\"col col-3 special_elite_regular\">" . htmlspecialchars($row['name']) . "</div>
                <div class=\"col col-3 special_elite_regular\">" . htmlspecialchars($row['media_name']) . "</div>
                <div class=\"col col-3 special_elite_regular\">" . htmlspecialchars($row['technique_name']) . "</div>
                <div class=\"col col-3 special_elite_regular\">" . htmlspecialchars($row['camp_type_name']) . "</div>
                <div class=\"col col-1 special_elite_regular\" data-label=\"Action : \">
                    <div class=\"\">
                        <form action=\"Campaign.php\" method=\"POST\">
                            <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                            <button class=\"special_elite_regular btn_update\" type=\"submit\" id=\"camp_update_bth\" name=\"camp_update_bth\">Detail</button>
                        </form>
                        <br />
                        <form action=\"Campaign.php\" method=\"POST\">
                            <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                            <button class=\"special_elite_regular btn_delete\" type=\"submit\" id=\"camp_delete_bth\" name=\"camp_delete_bth\">Delete</button>
                        </form>
                    </div>
                </div>
            </li>
            ";
        }
    } else {
        echo "
        <li class=\"table-row\">
            <div class=\"col col-12 special_elite_regular\" data-label=\"Id\">No campaigns found.</div>
        </li>
        ";
    }
}


function showTech()
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        echo "<script>toaster('Error: Database connection could not be established', 'error');</script>";
        return;
    }

    $query = "SELECT * FROM technique";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <li class=\"table-row\">
                <div class=\"col col-1 special_elite_regular\" data-label=\"Id : \">" . htmlspecialchars($row['id']) . "</div>
                <div class=\"col col-2 special_elite_regular\" data-label=\"Name : \">" . htmlspecialchars($row['name']) . "</div>
                <div class=\"col col-2 special_elite_regular\" data-label=\"Image \">
                    <div class=\"tech_image_preview_show\">
                        <div class=\"sub_dev\">
                            <div class=\"image-preview\">
                                <img src=\"" . htmlspecialchars($row['image1']) . "\" alt=\"\">
                            </div>
                        </div>
                        <div class=\"sub_dev\">
                            <div class=\"image-preview\">
                                <img src=\"" . htmlspecialchars($row['image2']) . "\" alt=\"\">
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"col col-1 special_elite_regular\" data-label=\"Action : \">
                    <div class=\"\">
                        <form action=\"MediaType.php\" method=\"POST\">
                            <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                            <button class=\"special_elite_regular btn_update\" type=\"submit\" id=\"tech_update_bth\" name=\"tech_update_bth\">Update</button>
                        </form>
                        <br />
                        <form action=\"MediaType.php\" method=\"POST\">
                            <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                            <button class=\"special_elite_regular btn_delete\" type=\"submit\" id=\"tech_delete_bth\" name=\"tech_delete_bth\">Delete</button>
                        </form>
                    </div>
                </div>
            </li>";
        }
    } else {
        echo "
        <li class=\"table-row\">
            <div class=\"col col-12 special_elite_regular\" data-label=\"Id\">No Techniques found.</div>
        </li>
        ";
    }
    $result->close();
    $connection->close();
}


if (isset($_POST['tech_update_bth'])) {
    $id = $_POST['id'];
    header("location: MediaType.php?id=" . $id);
}

if (isset($_POST['camp_update_bth'])) {
    $id = $_POST['id'];
    header("location: Campaign.php?id=" . $id);
}

function showCampType()
{
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }
    $query = "SELECT * FROM campign_type;";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo
            "
            <li class=\"table-row\">
                <div class=\"col col-3 special_elite_regular\" data-label=\"Id : \">" . $row['id'] . "</div>" .
                "<div class=\"col col-2 special_elite_regular\" data-label=\"Name : \">" . $row['name'] . "</div> " .
                "<div class=\"col col-2 special_elite_regular\" data-label=\"Action : \">
                    <div class=\"camp_type_action_btns\">
                        <form action=\"CampaignType.php\" method=\"POST\">
                            <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                            <button class=\"special_elite_regular btn_update\" href=\"Media.php\" id=\"camp_type_update_bth\" name=\"camp_type_update_bth\">Update</button>
                        </form>
                        <form action=\"CampaignType.php\" method=\"POST\">
                            <input type=\"hidden\" name=\"id\" value=\"" . htmlspecialchars($row['id']) . "\">
                            <button class=\"special_elite_regular btn_delete\" href=\"Media.php\" id=\"camp_type_delete_bth\" name=\"camp_type_delete_bth\">Delete</button>
                        </form>
                    </div>
                </div>
            </li>
            ";
        }
    }
}

if (isset($_POST['insert_camp_type_btn'])) {
    $connection = DBConnection("admin");
    if ($connection === null) {
        toaster("Error: Database connection could not be established", "error");
        return;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['media_name'];
        $sql = "INSERT INTO campign_type (name) VALUES (?)";
        $stmt = $connection->prepare($sql);
        if ($stmt === false) {
            toaster("ERROR IN STMT", "error");
        } else {
            $stmt->bind_param("s", $name);
            $result = $stmt->execute();
            if ($result === false) {
                toaster("ERROR IN RESULT", "error");
            } else {
                toaster("SUCCESS", "success");
                header("Location: CampaignType.php");
            }
            $stmt->close();
        }
    }
}


function uploadFile($fileInput, $uploadDirectory)
{
    if (!is_dir($uploadDirectory)) {
        if (!mkdir($uploadDirectory, 0777, true)) {
            return ["status" => false, "message" => "Failed to create upload directory."];
        }
    }

    $imageFileType = strtolower(pathinfo($_FILES[$fileInput]["name"], PATHINFO_EXTENSION));
    $targetFile = generateUniqueFileName($uploadDirectory, $imageFileType);

    $check = getimagesize($_FILES[$fileInput]["tmp_name"]);
    if ($check === false) {
        return ["status" => false, "message" => "File is not an image."];
    }

    if ($_FILES[$fileInput]["size"] > 5000000) {
        return ["status" => false, "message" => "Sorry, your file is too large."];
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return ["status" => false, "message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."];
    }

    if (move_uploaded_file($_FILES[$fileInput]["tmp_name"], $targetFile)) {
        return ["status" => true, "path" => $targetFile];
    } else {
        return ["status" => false, "message" => "Sorry, there was an error uploading your file."];
    }
}

function generateUniqueFileName($uploadDirectory, $extension)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    do {
        $uniqueName = uniqid(rand(), true) . $randomString . '.' . $extension;
        $targetFile = $uploadDirectory . $uniqueName;
    } while (file_exists($targetFile));

    return $targetFile;
}

if (isset($_POST['media_update_bth'])) {
    $id = $_POST['id'];
    header("location: Media.php?id=" . $id);
    exit();
}

if (isset($_POST['camp_type_update_bth'])) {
    $id = $_POST['id'];
    header("location: CampaignType.php?id=" . $id);
    exit();
}

if (isset($_POST['media_delete_bth'])) {
    $id = $_POST['id'];
    if ($id > 0) {
        $connection = DBConnection("admin");
        if ($connection === null) {
            echo "<p class='error'>Error: Database connection could not be established.</p>";
            return;
        }

        $stmt = $connection->prepare("DELETE FROM media WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            header("location: Media.php");
            toaster("Successfully Delete", "success");
            exit();
        } else {
            header("location: Media.php");
            toaster("Error: Could not delete pitch type.", "error");
            exit();
        }
        $stmt->close();
        $connection->close();
    }
}

if (isset($_POST['camp_delete_bth'])) {
    $id = $_POST['id'];
    if ($id > 0) {
        $connection = DBConnection("admin");
        if ($connection === null) {
            echo "<p class='error'>Error: Database connection could not be established.</p>";
            return;
        }
        $stmt = $connection->prepare("DELETE FROM campign WHERE id = ?");
        if ($stmt === false) {
            echo "<p class='error'>Error: Failed to prepare statement.</p>";
            error_log("Prepare failed: " . $connection->error);
            return;
        }
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            header("location: CampaignTable.php");
            toaster('Successfully Delete', 'success');
            exit();
        } else {
            header("location: CampaignTable.php");
            toaster('Error: Could not delete campaign.', 'error');
            error_log("Execute failed: " . $stmt->error);
            exit();
            $stmt->close();
            $connection->close();
        }
    } else {
        echo "<p class='error'>Invalid ID.</p>";
        error_log("Invalid ID: " . $id);
    }
}

if (isset($_POST['tech_delete_bth'])) {
    $id = $_POST['id'];
    if ($id > 0) {
        $connection = DBConnection("admin");
        if ($connection === null) {
            echo "<p class='error'>Error: Database connection could not be established.</p>";
            return;
        }

        $stmt = $connection->prepare("DELETE FROM technique WHERE id = ?");
        if ($stmt === false) {
            echo "<p class='error'>Error: Failed to prepare statement.</p>";
            error_log("Prepare failed: " . $connection->error);
            return;
        }

        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            header("location: MediaType.php");
            toaster('Successfully Delete', 'success');
            exit();
        } else {
            header("location: MediaType.php");
            toaster('Error: Could not delete pitch type.', 'error');
            error_log("Execute failed: " . $stmt->error);
            exit();
        }
        $stmt->close();
        $connection->close();
    } else {
        echo "<p class='error'>Invalid ID.</p>";
        error_log("Invalid ID: " . $id);
    }
}


if (isset($_POST['camp_type_delete_bth'])) {
    $id = $_POST['id'];
    if ($id > 0) {
        $connection = DBConnection("admin");
        if ($connection === null) {
            echo "<p class='error'>Error: Database connection could not be established.</p>";
            return;
        }

        $stmt = $connection->prepare("DELETE FROM campign_type WHERE id = ?");
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            header("location: CampaignType.php");
            toaster("Successfully Delete", "success");
            exit();
        } else {
            header("location: CampaignType.php");
            toaster("Error: Could not delete pitch type.", "error");
            exit();
        }
        $stmt->close();
        $connection->close();
    }
}

if (isset($_POST['dashboard_route_button'])) {
    header("Location: Dashboard.php");
    exit();
}
if (isset($_POST['media_route_button'])) {
    header("Location: Media.php");
    exit();
}
if (isset($_POST['media_type_route_button'])) {
    header("Location: MediaType.php");
    exit();
}
if (isset($_POST['campign_route_button'])) {
    header("Location: Campaign.php");
    exit();
}
if (isset($_POST['campign_type_route_button'])) {
    header("Location: CampaignType.php");
    exit();
}
if (isset($_POST['campign_table_route_button'])) {
    header("Location: CampaignTable.php");
    exit();
}
if (isset($_POST['profile-button'])) {
    adminLogout();
    exit();
}
