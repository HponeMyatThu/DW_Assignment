<?php
$IndexFilePath = "./php/_index.php";
$HeaderFilePath = "./views/layout/header.php";

if (
    file_exists($IndexFilePath)
    && file_exists($HeaderFilePath)
) {
    include($IndexFilePath);
    include($HeaderFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$IndexFilePath, $HeaderFilePath</strong> - File does not exist.</p>";
    return;
}
$currentPath = basename($_SERVER['PHP_SELF']);

?>
<link rel="stylesheet" href="./styles/index.css?v=<?php echo time(); ?>">

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <a href="index.php" class="special_elite_regular active">CAMPAIGN</a>
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
    <br><br><br>
    <h1 class="index_title special_elite_regular">&nbsp;Most popular Social Media App</h1>
    <div class="card_hor_container">
        <?php clientShowMediaIndex() ?>
    </div>

    <div class="card-media-detail-container">
        <div class="card-media-detail">
            <div class="card-content">
                <h2 class="card-detail-title special_elite_regular">Using social media adivce</h2>
                <p class="card-detail-description special_elite_regular">In today's digital age, social media has become an integral part of our daily lives, connecting people across the globe. However, with its widespread use, the importance of online safety cannot be overstated, especially for teenagers who are among the most active users. Our campaign aims to educate and protect this vulnerable group by providing essential safety techniques for popular platforms such as Facebook, Instagram, Twitter, LinkedIn, Snapchat, TikTok, Pinterest, WhatsApp, Reddit, and Tumblr. The campaign's home page is designed to be engaging and informative, featuring a search bar for easy navigation, interactive web services, and visually appealing elements. We emphasize minimal text to maintain user interest while maximizing the impact of visuals. An interactive navigation bar with drop-down menus, tips for staying safe online, custom cursors, and 3D illustrations enhance the user experience. Additionally, the footer includes a "You are here" page indicator, copyright information, and social media buttons, ensuring users can easily access relevant information and stay connected. Our goal is to create a safe online environment where teenagers can enjoy social media while being aware of potential risks and how to mitigate them.</p>
            </div>
        </div>
    </div>

    <h1 class="index_title special_elite_regular">&nbsp;Stay safety using socail media</h1>
    <div class="card_hor_container">
        <?php clientMediaShowIndex() ?>
    </div>
<br><br>
    <?php clientFooter()?>
</body>

<script src="./js/index.js"></script>

</html>