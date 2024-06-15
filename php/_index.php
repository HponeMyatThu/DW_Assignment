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

function adminRegister()
{
    $connection = DBConnection("admin");

    if ($connection === null) {
        echo "<p class='error'>Error: Database connection could not be established.</p>";
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
            echo "<p class='error'>Error preparing statement: " . $connection->error . "</p>";
        } else {
            $stmt->bind_param('ssssssss', $firstname, $surname, $email, $hashedPassword, $pin, $phone, $address, $status);
            $result = $stmt->execute();
            if ($result === false) {
                echo "<p class='error'>Error executing statement: " . $stmt->error . "</p>";
            } else {
                echo "<div class='modal'>";
                echo "<div class='modal-content'>";
                echo "<span class='close' onclick='document.getElementById(\"modal-toggle\").checked = false;'>&times;</span>";
                echo "<p class='success'>User added successfully.</p>";
                echo "<a href='../../views/Login.php'>Go to Login Page</a>";
                echo "</div>";
                echo "</div>";
            }
            $stmt->close();
        }
    }
}
