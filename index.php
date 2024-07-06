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
$searchValue = '';
$currentPath = basename($_SERVER['PHP_SELF']);

?>
<link rel="stylesheet" href="./styles/index.css?v=<?php echo time(); ?>">

<body>
    <div class="cursor-dot" data-cursor-dot></div>
    <div class="cursor-outline" data-cursor-outline></div>
    <header>
        <div class="navbar">
            <div id="google_translate_element"></div>
            <div class="logo">
                <a href="index.php" class="special_elite_regular active">CAMPAIGN</a>
            </div>
            <ul class="links">
                <li><a href="./views/client/Information.php" class="special_elite_regular">Information</a></li>
                <li><a href="./views/client/Media.php" class="special_elite_regular">Media</a></li>
                <li class="about_nav"><a class="special_elite_regular">About</a></li>
            </ul>
            <div class="icons">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
                    <input type="text" name="search" class="special_elite_regular" placeholder="Search" id="search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </form>
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
            <form action="index.php" method="GET" class="search-form" id="searchForm">
                <input type="text" placeholder="Search" id="dropdown_search_modal" class="special_elite_regular" name="search">
            </form>
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
        <?php clientSafetyMediaShowIndex() ?>
    </div>
    <div class="card-media-detail-container">
        <div class="card-media-detail">
            <div class="card-content">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15281.235374842701!2d96.16330505!3d16.761303200000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ec62ec7e69c7%3A0x7ee4bcf6bddbba4b!2z4YCY4YCt4YCv4YCA4YCc4YCx4YC44YCF4YC74YCx4YC4!5e0!3m2!1sen!2smm!4v1720202653848!5m2!1sen!2smm" width="100%" height="1000" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <br><br>
    <?php clientFooter() ?>
</body>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');
    }

    const form = document.getElementById('searchForm');
    const input = document.getElementById('dropdown_search_modal');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const searchValue = input.value;
        form.action = `index.php?search=${encodeURIComponent(searchValue)}`;
        form.submit();
    });
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="./js/index.js"></script>

</html>