<?php
$currentPath = basename($_SERVER['PHP_SELF']);
$title = explode(".", $currentPath);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title[0] ?></title>
    <link rel="stylesheet" href="../../styles/index.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../../images/tag_1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>