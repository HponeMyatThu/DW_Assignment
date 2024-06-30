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
        return $token_json;
        if (isset($token['role']) || $token['role'] !== 'user') {
            header("Location: Login.php");
            exit();
        }
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

    echo "<div class=\"tech_select\">" .
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
                <div class=\"col col-2 special_elite_regular\" data-label=\"Image : \">
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
        echo "<p>No records found.</p>";
    }
    $result->close();
    $connection->close();
}


if (isset($_POST['tech_update_bth'])) {
    $id = $_POST['id'];
    header("location: MediaType.php?id=" . $id);
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
            echo "<script>toaster('Successfully Delete', 'success');</script>";
            exit();
        } else {
            header("location: MediaType.php");
            echo "<script>toaster('Error: Could not delete pitch type.', 'error');</script>";
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
if (isset($_POST['profile-button'])) {
    header("Location: Profile.php");
    exit();
}
