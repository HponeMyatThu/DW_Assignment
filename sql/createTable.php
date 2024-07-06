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
    || empty($create_user_table)
    || empty($create_media_table)
    || empty($create_campign_type_table)
    || empty($create_technique_table)
    || empty($create_join_table)
    || empty($create_campign_table);

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
executeQuery($connection, $create_media_table, "MEDIA");
executeQuery($connection, $create_campign_type_table, "CAMPIGN_TYPE");
executeQuery($connection, $create_technique_table, "TECHNIQUE");
executeQuery($connection, $create_campign_table, "CAMPIGN");
executeQuery($connection, $create_join_table, "JOIN");

echo "<script>console.log(\"Path: /SQL/createTable</strong>: Successfully create tables.\")</script>";
