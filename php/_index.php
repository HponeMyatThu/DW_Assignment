<?php
session_start();

function DBConnection($parameter)
{
    if ($parameter === "client") {
        $DBConnectionFilePath = "../../db/DBConnection.php";
    } else if ($parameter === "admin") {
        $DBConnectionFilePath = "../../db/DBConnection.php";
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

function toaster($message, $failOrSuccess)
{
    echo "<div class='toaster' id='toaster'>";
    echo "<div class='toaster-content'>";
    echo "<p class='special_elite_regular $failOrSuccess'>$message</p>";
    echo "</div>";
    echo "</div>";
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

                toaster("User login successful", "success");

                header("Location: Dashboard.php");
                exit();
            } else {
                toaster("Invalid email or password", "error");
            }
        } else {
            toaster("Invalid email or password", "error");
        }

        $stmt->close();
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

                toaster("User login successful", "success");

                header("Location: ../../index.php");
                exit();
            } else {
                toaster("Invalid email or password", "error");
            }
        } else {
            toaster("Invalid email or password", "error");
        }

        $stmt->close();
    }
}

function DebugLog($rawString, $value)
{
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
    echo
    "
    <header>
        <div class=\"navbar\">
            <div class=\"logo\">
                <a href=\"../../index.php\" class=\"special_elite_regular\">CAMPIGN</a>
            </div>
            <ul class=\"links\">
                <li><a href=\"Information.php\" class=\"special_elite_regular\">Infromation</a></li>
                <li><a href=\"Media.php\" class=\"special_elite_regular\">Media</a></li>
                <li class=\"about_nav\"><a class=\"special_elite_regular\">About</a></li>
            </ul>
            <div class=\"icons\">
                <input type=\"text\" class=\"special_elite_regular\" placeholder=\"Search\" id=\"search-input\">
                <div class=\"toggle_search\">
                    <i class=\"fa fa-search\" aria-hidden=\"true\"></i>
                </div>
                <div class=\"toggle_btn\">
                    <i class=\"fa fa-bars\" aria-hidden=\"true\"></i>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class=\"dropdown_about_menu\">
            <ul>
                <li><a href=\"Parent.php\" class=\"special_elite_regular\">Parent</a></li>
                <li><a href=\"Livestream.php\" class=\"special_elite_regular\">Livestream</a></li>
                <li><a href=\"Contact.php\" class=\"special_elite_regular\">Contact</a></li>
                <li><a href=\"Guide.php\" class=\"special_elite_regular\">Guide</a></li>
            </ul>
        </div>
        <div class=\"dropdown_menu\">
            <ul>
                <li><a href=\"../../index.php\" class=\"special_elite_regular\">Home</a></li>
                <li><a href=\"Information.php\" class=\"special_elite_regular\">Infromation</a></li>
                <li><a href=\"Media.php\" class=\"special_elite_regular\">Media</a></li>
                <li><a href=\"Parent.php\" class=\"special_elite_regular\">Parent</a></li>
                <li><a href=\"Livestream.php\" class=\"special_elite_regular\">Livestream</a></li>
                <li><a href=\"Contact.php\" class=\"special_elite_regular\">Contact</a></li>
                <li><a href=\"Guide.php\" class=\"special_elite_regular\">Guide</a></li>
            </ul>
        </div>
        <div class=\"dropdown_search\">
            <input placeholder=\"Search\" id=\"dropdown_search_modal\" class=\"special_elite_regular\">
        </div>
    </main>
    ";
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
if (isset($_POST['profile-button'])) {
    header("Location: Profile.php");
    exit();
}
