<?php
$IndexFilePath = "../../php/_index.php";
$HeaderFilePath = "../layout/header.php";

if (file_exists($IndexFilePath) && file_exists($HeaderFilePath)) {
    include($IndexFilePath);
    include($HeaderFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$IndexFilePath, $HeaderFilePath</strong> - File does not exist.</p>";
    return;
}
$currentPath = basename($_SERVER['PHP_SELF']);
?>

<body>
    <?php clientNavbar(); ?>
    <div class="live_container">
        <br><br>
        <h2 class="special_elite_regular">Livestreaming</h2>
        <div class="card-detail livestream-card">
            <div class="livestream-content">
                <img src="../../images/stream-1.jpg" alt="Livestream Image" class="livestream-img">
                <div class="livestream-text special_elite_regular">
                    <p class="special_elite_regular">Familiarize yourself with the privacy settings of the platform you're using for live streaming. Set your account to private if you want to limit the audience to only your approved followers.</p>
                </div>
            </div>
            <div class="livestream-interactions">
                <div class="reactions">
                    <button class="like-button">👍</button>
                    <span class="special_elite_regular">1 reacted</span>
                </div>
                <div class="comments">
                    <input type="text" placeholder="Write a comment..." class="comment-input special_elite_regular">
                    <button class="send-button special_elite_regular">Send</button>
                    <button class="show-comments-button special_elite_regular">Show Comments</button>
                </div>
            </div>
        </div>
        <br>
        <div class="card-detail livestream-card">
            <div class="livestream-content">
                <img src="../../images/stream-2.jpg" alt="Livestream Image" class="livestream-img">
                <div class="livestream-text ">
                    <p class="special_elite_regular">Ensure your internet connection is stable and fast enough for live streaming. A wired connection is often more reliable than Wi-Fi.</p>
                </div>
            </div>
            <div class="livestream-interactions">
                <div class="reactions">
                    <button class="like-button">👍</button>
                    <span class="special_elite_regular">3 reacted</span>
                </div>
                <div class="comments">
                    <input type="text" placeholder="Write a comment..." class="comment-input special_elite_regular">
                    <button class="send-button special_elite_regular">Send</button>
                    <button class="show-comments-button special_elite_regular">Show Comments</button>
                </div>
            </div>
        </div>
        <br>
        <div class="card-detail livestream-card">
            <div class="livestream-content">
                <img src="../../images/stream-3.jpg" alt="Livestream Image" class="livestream-img">
                <div class="livestream-text special_elite_regular">
                    <p class="special_elite_regular">Engage with your audience by responding to their comments and questions during the live stream. This makes your session more interactive and enjoyable.</p>
                </div>
            </div>
            <div class="livestream-interactions">
                <div class="reactions">
                    <button class="like-button">👍</button>
                    <span class="special_elite_regular">5 reacted</span>
                </div>
                <div class="comments">
                    <input type="text" placeholder="Write a comment..." class="comment-input special_elite_regular">
                    <button class="send-button special_elite_regular">Send</button>
                    <button class="show-comments-button special_elite_regular">Show Comments</button>
                </div>
            </div>
        </div>

    </div>
    <?php clientFooter(); ?>
</body>

</html>

<?php
$FooterFilePath = "../layout/footer.php";

if (file_exists($FooterFilePath)) {
    include($FooterFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$FooterFilePath</strong> - File does not exist.</p>";
    return;
}
?>