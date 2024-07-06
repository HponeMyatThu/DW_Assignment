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

$campaigns = [
    [
        'image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQMAAADCCAMAAAB6zFdcAAAA4VBMVEX///8AvP8AoPr/1CUAt/8Avf8Auv8Atv8ApPv///0wyv+74v4qy///wgCU4P//0gsAqvz/0BrF6v//7bP/8tMAnPoAmfouwv/r+P5Dxv/z+/7/xwCk3/9EyP9Uyv+q4f6VzsDX8f5nzv960///6qj/+usAsP2N2f+C1v+45v//773/55v/5Y7/10D+/PX/3mj/997/2Xj/78f/4Xqu2v3/1GD/0EoAkuqPzPz/2Uz/12uU2OOU2u/J5v3g9P6X0fx2w/xRtvsAh98AftyAuekAg9lnvPtrxv3W6v6ExvyVz/weeoO/AAAKQklEQVR4nO2cC1vayhZACZ1MGJGCafMkkpukFaJ9qMe2noeo7b0e2///g+6ePCAQSIKBicW9vs8eTjsgs7L3nkcGWi0EQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRBkr2Hnp+/OPpy9O33Lmn4rzfD2w8f+nI8f3jb9hkTz6exVv/8qC/zv2aem35ZA2IclAamGDy8mJ05XGogtnDb95oTAPq8zEFn4/AJC4f2rRQVHR0eLEl69b/ot7przfrb7w17MMCuif970m9wtGQUgYHjx5vL8/PzyzQU8PnohEt7PFBz1ehfZrp5f9HozC/19ToePaS+HvYvlycCni94w/eePjby7Gtzc3lSs5X/00yAYrgr382EaCv0/qr0gUx218vvcHexO1/T2VZWmlzMFX1dLY19nEi6rvGAoE0qC5gfTgdYG9Hu7vOmsFHxZ2+TLrCiUvhprjYgEUKPVqAXGOpECzrSs8bskDHpfCxp97SWB8K7s5aYSlaVEQqMMEgXfIBQeS9omCobDosvGhklh7Je82pRIsiLFEqwmA+FhFgUgQStOhzf9JBOKF8lvk2zovylsZlOJnsRxABL8jd/51rjV2+25BO26sPGfSSb8VfKifyXZ8GdhqzGdK5Ak4mz4zrfGY0YBSNALB4f3aRiUzX/ep4FQ2DBUBrIk06QkSMRrJh1sLRsF8NPpFrROKuKwLAwgEIblVVGVTyRZVgh4SNLBbEICGyxEQTRCFjT/fBSHQfnAfxkHwtHngjYU+i6fgAKJJulgNOCA3WkLQQD1QL8vaJ/OkSu8dDpHKPjlPoSAwguCMquLwaY9qE9XXwyC79+6RTOET0kqrJ8ezfmSJEPR9qKpnnSg+9m6GG7Yg9rY+lImDIpHxrexg95Zhdc+i0eGfuEgymxDkgdzBSDB3KQDW+C+vcA3/ba4fbxWOOpV2S88jZOhbM3gkKggzBmJLQmZYfE7/+PHf0uecNqvWhJnRbF0f/W6DYUxEwvEq/jut8Ov+bj4v+9QDUsXC2/6VSaJMclUsWSmCJgwWR506KwsjoUGwmxQ0O6///hxX7ZU2JGDlvdvW+uM0uGRil1Gp+VAv4PyWOUJu3HQ4r+dTUgiQezaqZNEwV3VtfvOHABsnESCLNRBkgoly6QMu3TQSh3Qqk/YBuns4Jk4cBIHpFJabonpM3VQOjxtkW6aC7+qPkOIAypyunz9vOrBzMG46jPqw9Kh8Zk4SGuidCxwYJjNkO6qPmOnDiazWZI4B95stVC0Y7DATh34DawYbmerhU7Vp+zUgZE6oOL2VucLZ73qiLxTB+lcGWbLVZ9Sm/nCufTGSgTjW6oRFR3Ejd+1qs3EvbkDYbOkm7kDrWTrhGOHr1+//vs/Mf+8LuefpO3f8Di0yzW4dOaAiroN/TOzqf5Q2jo8OKzDQfm8x884mGyjgxVY2FQva6xyBQdPhT+39NJmN9QE3X9d2E4t20Fih4eGVAfj8LAkG0ySaS6oIGR31dtayekL76CWAc5ByaAf0kxjQQXhWsvmQklBUOW1fauKXNKtINtY0JJhaVu9uLFK13WtMiWXli1aFrKfxhburrT14khVyZqeVYcUO5gu/gYiwsF00UHxDOHx39oKJOoX3lh3FiNNyD7K1UI5KFw2XQ30Qf16AP0yCiYJoyVjIvZRrpccrLvhzh4HEDFbccDPXa2LBbZUcITMkpZK4tolw3WUM+UOaLWqSdbcRPKWC85oh31P6Sw5WNhTNG+urq5uTFjrPMRlo9yB71uUVPBAfMaYrYZuqMLrz4Q4y0+Vd6+ALaVCpiDc3LV1XdM0Xe/8/JlUzgIHxOAzSAN6xkzHKB8/6GQsE0IBIgWzscJfdkB272Dx4EFmhnDV0ed6tPThWgfUUFk8w5OtQGVMrWJh/ojIyXZJ7vUFHEPwcg50+KXsqp2Lj0IHxGF2wC8poMBPYDNns6kElVy2tFiIX3n3+2mPOQdat+UN8tFR6IB60GVC/NDkmaD68Nhh3oZzSgKDRX4e2oiD9sP1OgPrHFCTjQhUemaG48mYixgTYjFz04k1Gfv5v2vEwZo0WO+AeMwghslCg0QoRshM+Bs23XRmvUKaAAfm+mte1QF1mAVX3QYDxjhUwzF/YLJj+Dt3C8sLAUezCi56RQcWRD5cc8rzmZlTyATPIpTHxphZ9R3sXkFunrixA+KZhNgmJRNmBlQhCg1MXg9MmxJz42zIIWLxfLtRIKxwYDEfBgF+0V2oBZZvwZ9uFBouzAWPayoQcptlulFByDugoU0ojIzHfHR0+CwxfjCCH4nYYc1NFzFnEE7qOSC2CyEApWuqQA1wLdlyYWagQIJIEAxOq6YDMeeyljcQNnRgQCp4njKCccDlswTgmIUwJviKOiUjVm8bmroiFGw2MuQd+EwmcMEhI2ReBDw25aXBUMwQ/gOxENQKBBGjAuduAwk5BxQ6KkMoTFXoMoXxYQzjAeVSplARDTI7aPckhJ3gXzVVrO7AaSkG5IHtKq4JGWDBeDAipqs4NuSEpdi5DYGNHAg7gFAnFxYd8PSPHITcgVXbgSRKwcJN12flQNgtV/5prsoShDqgVNwhTWY+dHQ92jcrk1HBgQw1oZYDmuzFyL7oD7fZ05vu1fXdia4XeajgABbAT3cAnbeCsat6U7vJj37f/LqP91KjTsd7qoO1+4krHEgVHVDLoHxPNb32lEij8XP4/oMY+7F7+/PhHrj7FX2+rbtuX/npDgifApqqE4wAf+KEnsgj2k/Bi78VoIoDo4oDKjf0cd4aMHbNC8UqB4Q7CAMSO6ByhXGB8s3Hprv0FOyfWv6eK8yVIQ5GPKFhriwx1VJhEckcJYyMKGyFA0onzz3sC+jm770HvMvRCWPDlim/gebDQsFSYAExYbBymOQc+M+n7j2J/BkMCxIB+svvtRJ+iS0o7y0P8iMgarSAWH5CyRmM50/eAcQ9cRih43gPmSrEb7VkJYTE8P0oP16AA7jaBptA4PtUoiqzGfNkyIYoB6II2X8HUAIsojIKPz6RjLE7tggoiBtaLHcfeR8dwGTAIzJTFZCgytFemhyCgigMPHtF+z10IPnRSOASEjA2Dd1wyiA1SCDzEMnfP9xPBxAAMpQDFSb/gWraphrAI5VnAcudrNlXB5LE7zL5rBXw+61KdPygBQqo2VrVeE8dGMyUiKyyVhgcG8dB2OKVQTJX76vvqQP+PW8jhRiuGd1nMl2DKKPM55JeggPA4yeQCKHWMUwUiWKozFt1mmCvHfATSN7EiDbBjInHi8O6lnvrAJbDgcdPHJowUWResP6I4h474L2TRmPHdcYjqbDVXjuQkn3B4ia/vYO6xwkkgZ/X2xXdLTgo+jq+34HuSd3D+/LJTdOdqImnUbmOBVmmmtivv9oBg84JWHgy9KQzaLoLtfG0Tj1+/zAACYPNTnUuog32QAEw7T4dkd/2gyAIgiAIgiAIgiAIgiAIgiAIgiAIgiAIgiAIgiAIgmyP/wOnGvhmoGPKsgAAAABJRU5ErkJggg==',
        'header' => 'Strong PSW',
        'description' => 'Enhance the security of your Reddit account by using strong, unique passwords. Create passwords that combine uppercase and lowercase letters, numbers, and special characters to make them difficult to guess or crack. Consider using a reputable password manager to generate and store complex passwords securely.'
    ],
    [
        'image' => 'data:image/jpeg;base64,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',
        'header' => 'Two FA',
        'description' => 'Protect your Facebook account by enabling two-factor authentication (2FA). Two-factor authentication adds an extra layer of security to your account by requiring not only your password but also a second form of verification, such as a code sent to your phone or generated by an authentication app.'
    ],
    [
        'image' => 'data:image/jpeg;base64,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',
        'header' => 'Privacy',
        'description' => ' Safeguard your personal space on Tumblr by familiarizing yourself with the platform\'s privacy controls and settings. Customize who can view your posts, send you messages, and interact with your content to align with your privacy preferences. Take advantage of privacy features that allow you to block or report users who engage in unwanted behavior or violate community guidelines.'
    ]
];

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
    <div class="content-width">
        <div class="slideshow">
            <!-- Slideshow Items -->
            <div class="slideshow-items">
                <?php foreach ($campaigns as $campaign) : ?>
                    <div class="item">
                        <div class="item-image-container">
                            <img class="item-image" src="<?php echo $campaign['image']; ?>" />
                        </div>
                        <div class="item-header">
                            <!-- Staggered Header Elements -->
                            <?php foreach (str_split($campaign['header']) as $char) : ?>
                                <span class="vertical-part"><b class="special_elite_regular"><?php echo $char; ?></b></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="item-description">
                            <!-- Staggered Description Elements -->
                            <?php foreach (explode(' ', $campaign['description']) as $word) : ?>
                                <span class="vertical-part"><b class="special_elite_regular"><?php echo $word; ?></b></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="controls">
                <ul>
                    <li class="control" data-index="0"></li>
                    <li class="control" data-index="1"></li>
                    <li class="control" data-index="2"></li>
                </ul>
            </div>
        </div>
    </div>

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
    <div class="card-media-detail-container">
        <div class="card-media-detail">
            <div class="card-content">
                <iframe width="100%" height="600" src="https://www.youtube.com/embed/W5bh1JFo43U?si=cPjcuYI0-DryOEDY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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

    // Master DOManipulator v2 ------------------------------------------------------------
    const items = document.querySelectorAll('.item'),
        controls = document.querySelectorAll('.control'),
        headerItems = document.querySelectorAll('.item-header'),
        descriptionItems = document.querySelectorAll('.item-description'),
        activeDelay = .76,
        interval = 5000;

    let current = 0;

    const slider = {
        init: () => {
            controls.forEach(control => control.addEventListener('click', (e) => {
                slider.clickedControl(e)
            }));
            controls[current].classList.add('active');
            items[current].classList.add('active');
        },
        nextSlide: () => {
            slider.reset();
            if (current === items.length - 1) current = -1;
            current++;
            controls[current].classList.add('active');
            items[current].classList.add('active');
            slider.transitionDelay(headerItems);
            slider.transitionDelay(descriptionItems);
        },
        clickedControl: (e) => {
            slider.reset();
            clearInterval(intervalF);

            const control = e.target,
                dataIndex = Number(control.dataset.index);

            control.classList.add('active');
            items.forEach((item, index) => {
                if (index === dataIndex) {
                    item.classList.add('active');
                }
            })
            current = dataIndex;
            slider.transitionDelay(headerItems);
            slider.transitionDelay(descriptionItems);
            intervalF = setInterval(slider.nextSlide, interval);
        },
        reset: () => {
            items.forEach(item => item.classList.remove('active'));
            controls.forEach(control => control.classList.remove('active'));
        },
        transitionDelay: (items) => {
            let seconds;

            items.forEach(item => {
                const children = item.childNodes;
                let count = 1,
                    delay;

                item.classList.value === 'item-header' ? seconds = .015 : seconds = .007;

                children.forEach(child => {
                    if (child.classList) {
                        item.parentNode.classList.contains('active') ? delay = count * seconds + activeDelay : delay = count * seconds;
                        child.firstElementChild.style.transitionDelay = `${delay}s`;
                        count++;
                    }
                })
            })
        },
    }

    let intervalF = setInterval(slider.nextSlide, interval);
    slider.init();
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="./js/index.js"></script>

</html>