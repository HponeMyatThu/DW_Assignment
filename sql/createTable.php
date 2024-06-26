<?php
$DBConnectionFilePath = "../db/DBConnection.php";
$CreateTableQueryFilePath = "./createTableQuery.php";

$isEmptyFilePath = file_exists($DBConnectionFilePath)
    || file_exists($CreateTableQueryFilePath);

if ($isEmptyFilePath) {
    include($DBConnectionFilePath);
    include($CreateTableQueryFilePath);
} else {
    echo "<p class='error'>Error: Unable to include files <strong>$DBConnectionFilePath</strong> " .
        "and <strong>$CreateTableQueryFilePath</strong>. Files do not exist.</p>";
    return;
}

$isEmpty = empty($create_admin_table)
    || empty($create_contact_us_table)
    || empty($create_user_table);

if ($isEmpty) {
    echo "<p><strong>Path: /SQL/createTable</strong>: SQL queries are empty.</p>";
} else {
    echo "<p><strong>Path: /SQL/createTable</strong>: SQL queries are not empty.</p>";
}

function executeQuery($connection, $query, $tableName)
{
    $result = $connection->query($query);
    if ($result === false) {
        echo "<p class='error'><strong>CREATE $tableName TABLE FAILED!!</strong> Error: " . $connection->error . "</p>";
        return false;
    }
    return true;
}

executeQuery($connection, $create_admin_table, "ADMIN");
executeQuery($connection, $create_user_table, "USER");
executeQuery($connection, $create_contact_us_table, "CONTACT_US");

// executeQuery($connection, $create_pitch_type_table, "PITCH TYPE");
// executeQuery($connection, $create_admin_table, "ADMIN");
// executeQuery($connection, $create_user_table, "USER");
// executeQuery($connection, $create_pitch_table, "PITCH");
// executeQuery($connection, $create_review_table, "REVIEW");
// executeQuery($connection, $create_booking_table, "BOOKING");

echo "<script>console.log(\"Path: /SQL/createTable</strong>: Successfully create tables.\")</script>";
