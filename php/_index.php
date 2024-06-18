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

function toaster($message, $failOrSuccess) {
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
