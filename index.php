<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Navigation Bar</title>
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <a href="index.php" class="special_elite_regular">CAMPIGN</a>
            </div>
            <ul class="links">
                <li><a href="./views/client/Information.php" class="special_elite_regular">Infromation</a></li>
                <li><a href="./views/client/Media.php" class="special_elite_regular">Media</a></li>
                <li class="about_nav"><a class="special_elite_regular">About</a></li>
            </ul>
            <div class="icons">
                <input type="text" class="special_elite_regular" placeholder="Search" id="search-input">
                <div class="toggle_search">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
                <div class="toggle_btn">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="dropdown_about_menu">
            <ul>
                <li><a href="./views/client/Parent.php" class="special_elite_regular">Parent</a></li>
                <li><a href="./views/client/Livestream.php" class="special_elite_regular">Livestream</a></li>
                <li><a href="./views/client/Contact.php" class="special_elite_regular">Contact</a></li>
                <li><a href="./views/client/Guide.php" class="special_elite_regular">Guide</a></li>
            </ul>
        </div>
        <div class="dropdown_menu">
            <ul>
                <li><a href="index.php" class="special_elite_regular">Home</a></li>
                <li><a href="./views/client/Information.php" class="special_elite_regular">Infromation</a></li>
                <li><a href="./views/client/Media.php" class="special_elite_regular">Media</a></li>
                <li><a href="./views/client/Parent.php" class="special_elite_regular">Parent</a></li>
                <li><a href="./views/client/Livestream.php" class="special_elite_regular">Livestream</a></li>
                <li><a href="./views/client/Contact.php" class="special_elite_regular">Contact</a></li>
                <li><a href="./views/client/Guide.php" class="special_elite_regular">Guide</a></li>
            </ul>
        </div>
        <div class="dropdown_search">
            <input placeholder="Search" id="dropdown_search_modal" class="special_elite_regular">
        </div>
    </main>


</body>

<script src="./js/index.js"></script>

</html>