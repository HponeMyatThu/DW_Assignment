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
        <h2 class="special_elite_regular">Parents Participation</h2>
        <div class="card-detail livestream-card">
            <div class="livestream-content">
                <img src="../../images/pp-1.jpg" alt="Livestream Image" class="livestream-img">
                <div class="livestream-text special_elite_regular">
                    <p class="special_elite_regular">Active parental participation in live streaming sessions can significantly enhance the overall experience for both children and parents. When parents engage by commenting, asking questions, and providing feedback during the live stream, it creates a more interactive and dynamic environment. This involvement not only shows children that their parents are interested and supportive but also encourages them to be more attentive and engaged. Additionally, it allows parents to monitor the content and ensure that it aligns with their values and expectations, promoting a safe and positive online experience for their children. By actively participating, parents can also gain insights into their children's interests and activities, fostering stronger communication and understanding within the family.</p>
                </div>
            </div>
            <div class="livestream-interactions">
                <div class="comments">
                    <button class="show-comments-button special_elite_regular">Participate</button>
                </div>
            </div>
        </div>
        <br>
        <div class="card-detail livestream-card">
            <div class="livestream-content">
                <img src="../../images/pp-2.jpg" alt="Livestream Image" class="livestream-img">
                <div class="livestream-text ">
                    <p class="special_elite_regular">Encouraging parents to participate in live streaming sessions offers numerous advantages that extend beyond the virtual world. For one, it provides an opportunity for parents to connect with their children on a deeper level, as they share in the excitement and learning that occurs during the stream. This shared experience can lead to meaningful conversations and bonding moments long after the session has ended. Moreover, parental involvement can act as a form of digital mentorship, where parents can model appropriate online behavior and guide their children in navigating the digital landscape responsibly. It also allows parents to provide immediate support and encouragement, which can boost their children's confidence and motivation to engage and learn.</p>
                </div>
            </div>
            <div class="livestream-interactions">
                <div class="comments">
                    <button class="show-comments-button special_elite_regular">Participate</button>
                </div>
            </div>
        </div>
        <br>
        <div class="card-detail livestream-card">
            <div class="livestream-content">
                <img src="../../images/pp-3.jpg" alt="Livestream Image" class="livestream-img">
                <div class="livestream-text special_elite_regular">
                    <p class="special_elite_regular">Parental participation in live streaming sessions is an invaluable component that can transform the digital learning experience into a collaborative and enriching journey. When parents join in, they can help bridge the gap between the virtual and real-world learning environments. Their presence can provide a sense of security and reassurance to children, making them feel more comfortable and confident in expressing themselves and interacting with others during the live stream. Additionally, parents can offer real-time support and clarification on complex topics, enhancing their children's comprehension and retention of the material. This active involvement not only enhances the educational value of the live stream but also reinforces the importance of family engagement in all aspects of their children's lives, leading to well-rounded and supported learners.</p>
                </div>
            </div>
            <div class="livestream-interactions">
                <div class="comments">
                    <button class="show-comments-button special_elite_regular">Participate</button>
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