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
$id = $name = $image1 = $image2 = $description = $media_id = "";

$sessionInfo = verifyAdminSession();
$LoginUserEmail = $sessionInfo['email'];

$currentPath = basename($_SERVER['PHP_SELF']);

if (!empty($_GET['id'])) {
    $media = fetchTechById($_GET['id']);
    if (!empty($media)) {
        foreach ($media as $item) {
            $id = $item['id'];
            $name = $item['name'];
            $image1 = $item['image1'];
            $image2 = $item['image2'];
            $description = $item['description'];
            $media_id = $item['media_id'];
        }
    } else {
        echo "<script>console.log(\"Media not found\");</script>";
    }
}

?>

<body>
    <div class="admin_container_with_navbar">
    <nav class="sidebar_main_dev">
            <div class="sidebar_sub_dev">
                <div class="navbar_logo_desktop">
                    <img src="../../images/nav_bar_logo_photo.jpg" alt="navbar logo" class="profile_avatar_desktop">
                </div>
                <ul>
                    <li><a href="Dashboard.php" class="<?php echo ($currentPath == 'Dashboard.php') ? 'active' : ''; ?> special_elite_regular">Dashboard</a>
                        <form method="POST">
                            <button type="submit" name="dashboard_route_button" id="dashboard_route_button" class="<?php echo ($currentPath == 'Dashboard.php') ? 'active' : ''; ?> dashboard_route_button">
                                <div class="nav_icons">
                                    <svg width="64px" height="64px" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M55.64 22.751H35.09C34.5596 22.751 34.0509 22.9617 33.6758 23.3368C33.3007 23.7118 33.09 24.2205 33.09 24.751V55.571C33.0916 56.1009 33.3028 56.6087 33.6775 56.9834C34.0523 57.3582 34.5601 57.5694 35.09 57.571H55.64C56.1699 57.5694 56.6777 57.3582 57.0525 56.9834C57.4272 56.6087 57.6384 56.1009 57.64 55.571V24.751C57.64 24.2205 57.4293 23.7118 57.0542 23.3368C56.6791 22.9617 56.1704 22.751 55.64 22.751Z" fill="#999999" />
                                            <path d="M55.64 5.62695H35.09C34.5596 5.62695 34.0509 5.83767 33.6758 6.21274C33.3007 6.58781 33.09 7.09652 33.09 7.62695V17.8969C33.0916 18.4269 33.3028 18.9347 33.6775 19.3094C34.0523 19.6841 34.5601 19.8954 35.09 19.8969H55.64C56.1699 19.8954 56.6777 19.6841 57.0525 19.3094C57.4272 18.9347 57.6384 18.4269 57.64 17.8969V7.62695C57.64 7.09652 57.4293 6.58781 57.0542 6.21274C56.6791 5.83767 56.1704 5.62695 55.64 5.62695Z" fill="#000000" />
                                            <path d="M28.24 36.451H7.7C6.59543 36.451 5.7 37.3465 5.7 38.451V55.5711C5.7 56.6756 6.59543 57.5711 7.7 57.5711H28.24C29.3446 57.5711 30.24 56.6756 30.24 55.5711V38.451C30.24 37.3465 29.3446 36.451 28.24 36.451Z" fill="#000000" />
                                            <path d="M28.24 5.62697H7.70002C7.43712 5.62604 7.17661 5.67714 6.93355 5.77733C6.69048 5.87751 6.46964 6.02477 6.28373 6.21068C6.09783 6.39658 5.95054 6.61742 5.85035 6.86049C5.75017 7.10355 5.6991 7.36406 5.70002 7.62697V31.557C5.70002 32.0874 5.91074 32.5961 6.28581 32.9712C6.66088 33.3462 7.16959 33.557 7.70002 33.557H28.24C28.7704 33.557 29.2791 33.3462 29.6542 32.9712C30.0293 32.5961 30.24 32.0874 30.24 31.557V7.62697C30.2409 7.36406 30.1898 7.10355 30.0896 6.86049C29.9895 6.61742 29.8422 6.39658 29.6563 6.21068C29.4704 6.02477 29.2495 5.87751 29.0065 5.77733C28.7634 5.67714 28.5029 5.62604 28.24 5.62697Z" fill="#999999" />
                                        </g>
                                    </svg>
                                </div>
                            </button>
                        </form>
                    </li>
                    <li><a href="Media.php" class="<?php echo ($currentPath == 'Media.php') ? 'active' : ''; ?> special_elite_regular">Media</a>
                        <form method="POST">
                            <button type="submit" name="media_route_button" id="media_route_button" class="<?php echo ($currentPath == 'Media.php') ? 'active' : ''; ?> media_route_button">
                                <div class="nav_icons">
                                    <svg width="64px" height="64px" viewBox="-4.8 -4.8 57.60 57.60" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000" transform="matrix(1, 0, 0, 1, 0, 0)">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(9.84,9.84), scale(0.59)">
                                            <rect x="-4.8" y="-4.8" width="57.60" height="57.60" rx="28.8" fill="#7ed0ec" strokewidth="0" />
                                        </g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.384" />
                                        <g id="SVGRepo_iconCarrier">
                                            <defs>
                                                <style>
                                                    .a {
                                                        fill: none;
                                                        stroke: #000000;
                                                        stroke-linecap: round;
                                                        stroke-linejoin: round;
                                                    }
                                                </style>
                                            </defs>
                                            <path class="a" d="M43.5,23.9538a1.749,1.749,0,0,0-.51-1.1991L29.131,8.8854a1.7588,1.7588,0,0,0-1.249-.51H6.4985A1.9986,1.9986,0,0,0,4.5,10.3243v27.279a1.9985,1.9985,0,0,0,1.9985,1.9985H27.6222a1.82,1.82,0,0,0,.57,0h13.36A1.9986,1.9986,0,0,0,43.5,37.6033Z" />
                                            <line class="a" x1="38.244" y1="22.5249" x2="34.0173" y2="22.5249" />
                                            <line class="a" x1="41.1318" y1="27.0415" x2="34.0173" y2="27.0415" />
                                            <line class="a" x1="41.1318" y1="31.568" x2="34.0173" y2="31.568" />
                                            <line class="a" x1="41.1318" y1="36.0945" x2="34.0173" y2="36.0945" />
                                            <path class="a" d="M26.7061,22.6524A7.0435,7.0435,0,0,0,24.75,18.9652a7.1365,7.1365,0,0,0-10.07,0" />
                                            <path class="a" d="M12.7238,25.3616A7.1233,7.1233,0,0,0,24.75,29.0356" />
                                            <polygon class="a" points="14.045 18.331 15.459 19.745 17.349 21.635 12.155 21.635 12.155 16.428 14.045 18.331" />
                                            <polygon class="a" points="23.984 28.269 22.081 26.366 27.288 26.366 27.288 31.573 25.398 29.683 23.984 28.269" />
                                        </g>
                                    </svg>
                                </div>
                            </button>
                        </form>
                    </li>

                    <li><a href="MediaType.php" class="<?php echo ($currentPath == 'MediaType.php') ? 'active' : ''; ?> special_elite_regular">Technique</a>
                        <form method="POST">
                            <button type="submit" name="media_type_route_button" id="media_type_route_button" class="<?php echo ($currentPath == 'MediaType.php') ? 'active' : ''; ?> media_type_route_button">
                                <div class="nav_icons">
                                    <svg width="64px" height="64px" viewBox="-4.8 -4.8 57.60 57.60" xmlns="http://www.w3.org/2000/svg" fill="#000000" stroke="#000000" transform="matrix(1, 0, 0, 1, 0, 0)">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(9.84,9.84), scale(0.59)">
                                            <rect x="-4.8" y="-4.8" width="57.60" height="57.60" rx="28.8" fill="#7ed0ec" strokewidth="0" />
                                        </g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.384" />
                                        <g id="SVGRepo_iconCarrier">
                                            <defs>
                                                <style>
                                                    .a {
                                                        fill: none;
                                                        stroke: #000000;
                                                        stroke-linecap: round;
                                                        stroke-linejoin: round;
                                                    }
                                                </style>
                                            </defs>
                                            <path class="a" d="M43.5,23.9538a1.749,1.749,0,0,0-.51-1.1991L29.131,8.8854a1.7588,1.7588,0,0,0-1.249-.51H6.4985A1.9986,1.9986,0,0,0,4.5,10.3243v27.279a1.9985,1.9985,0,0,0,1.9985,1.9985H27.6222a1.82,1.82,0,0,0,.57,0h13.36A1.9986,1.9986,0,0,0,43.5,37.6033Z" />
                                            <line class="a" x1="38.244" y1="22.5249" x2="34.0173" y2="22.5249" />
                                            <line class="a" x1="41.1318" y1="27.0415" x2="34.0173" y2="27.0415" />
                                            <line class="a" x1="41.1318" y1="31.568" x2="34.0173" y2="31.568" />
                                            <line class="a" x1="41.1318" y1="36.0945" x2="34.0173" y2="36.0945" />
                                            <path class="a" d="M26.7061,22.6524A7.0435,7.0435,0,0,0,24.75,18.9652a7.1365,7.1365,0,0,0-10.07,0" />
                                            <path class="a" d="M12.7238,25.3616A7.1233,7.1233,0,0,0,24.75,29.0356" />
                                            <polygon class="a" points="14.045 18.331 15.459 19.745 17.349 21.635 12.155 21.635 12.155 16.428 14.045 18.331" />
                                            <polygon class="a" points="23.984 28.269 22.081 26.366 27.288 26.366 27.288 31.573 25.398 29.683 23.984 28.269" />
                                        </g>
                                    </svg>
                                </div>
                                <p class="special_elite_regular icons_text">Type</p>
                            </button>
                        </form>
                    </li>
                    <li><a href="Campaign.php" class="<?php echo ($currentPath == 'Campaign.php') ? 'active' : ''; ?> special_elite_regular">Campaign</a>
                        <form method="POST">
                            <button type="submit" name="campign_route_button" id="campign_route_button" class="<?php echo ($currentPath == 'Campaign.php') ? 'active' : ''; ?> campign_route_button">
                                <div class="nav_icons">
                                    <svg fill="#000000" width="64px" height="64px" viewBox="-24.58 -24.58 172.04 172.04" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 110.26 122.88" xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(26.419200000000004,26.419200000000004), scale(0.57)">
                                            <rect x="-24.58" y="-24.58" width="172.04" height="172.04" rx="86.02" fill="#7ed0ec" strokewidth="0" />

                                        </g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                        <g id="SVGRepo_iconCarrier">
                                            <style type="text/css">
                                                .st0 {
                                                    fill-rule: evenodd;
                                                    clip-rule: evenodd;
                                                }
                                            </style>
                                            <g>
                                                <path class="st0" d="M10.69,55.55C5.74,57,3.64,62.09,3.71,67.87c0.03,2.61,0.5,5.35,1.35,8c0.85,2.64,2.07,5.15,3.62,7.31 c3.52,4.93,8.76,7.94,14.9,5.83c0.46-0.16,0.95-0.12,1.36,0.07c0.1-0.04,0.2-0.07,0.31-0.11c1.53-0.5,2.95-0.93,4.24-1.32 c1.44-0.43,2.8-0.82,4.08-1.16c0.99-0.27,2.01,0.32,2.28,1.31c0.02,0.07,0.03,0.14,0.04,0.21c0.18,0.81,0.37,1.62,0.55,2.43 c1.41,6.28,2.77,12.34,4.59,17.26c0.03,0.09,0.27,0.76,0.52,1.43c1.12,3.1,2.33,6.41,3.88,8.36c1.37,1.71,3.26,2.22,6.2-0.08 c0.55-0.52,1.11-1,1.68-1.49c1.75-1.51,3.51-3.01,4.15-5.27c-0.4-0.55-1.17-0.88-1.94-1.21c-2.57-1.09-5.14-2.19-4.45-7.59 c0.03-0.28,0.07-0.53,0.1-0.78c0.2-1.58,0.31-2.39,0.21-2.74c-0.05-0.19-0.44-0.54-1.21-1.25l-0.28-0.26 c-1.52-1.39-2.06-3.38-2.04-5.53c0.02-2.53,0.85-5.31,1.68-7.31c0.26-0.63,0.83-1.04,1.46-1.13l0,0 c19.22-2.66,30.94,0.68,40.26,3.34c0.4,0.11,0.8,0.23,1.19,0.34c-8.32-8.58-15.14-21.58-19.81-34.9 c-4.93-14.07-7.46-28.61-6.8-38.79c-7.62,11.26-20.99,29.14-52.86,40.86c-0.03,0.01-0.06,0.02-0.09,0.03l-0.25,0.09 c-0.33,0.12-0.38,0.09-0.43,0.13c-0.07,0.06,0,0.06-0.13,0.27c-0.02,0.03,0.04-0.07-0.34,0.53C11.49,55.15,11.11,55.42,10.69,55.55 L10.69,55.55L10.69,55.55z M90.07,52.82c0,4.61-4.52,12.9-7.35,13.06c4.82,9.44,10.74,17.61,17.41,22.49 c0.39,0.05,0.75,0.08,1.09,0.06c0.65-0.02,1.29-0.2,1.99-0.64c1.52-1.53,2.48-3.93,2.97-6.96c1.5-9.34-1.56-23.97-6.69-38.05 C94.35,28.67,87.17,15.22,80.46,8.26C78,5.71,75.68,4.11,73.67,3.78c-0.51-0.08-0.8-0.1-0.94-0.05c-0.17,0.06-0.43,0.3-0.84,0.71 c-0.2,0.2-0.4,0.42-0.61,0.66c-0.02,0.06-0.05,0.12-0.07,0.17c-3.14,6.48-2.12,20.47,1.95,35.47l0,0 C76.23,39.3,90.07,40.94,90.07,52.82L90.07,52.82z M99.94,92.08c-0.4,0.08-0.83,0.02-1.21-0.18c-0.35-0.06-0.7-0.14-1.07-0.21 c-2.42-0.5-4.83-1.19-7.43-1.93c-8.81-2.51-19.86-5.66-37.66-3.38c-0.55,1.52-1.01,3.33-1.02,4.94c-0.01,1.16,0.21,2.18,0.83,2.75 l0.28,0.26c1.32,1.2,1.97,1.79,2.3,3.04c0.28,1.04,0.14,2.09-0.13,4.17c-0.03,0.24-0.06,0.5-0.1,0.78 c-0.33,2.62,0.95,3.17,2.23,3.71c1.66,0.71,3.33,1.42,4.15,3.69c0.14,0.33,0.19,0.71,0.12,1.09c-0.75,3.84-3.13,5.89-5.52,7.94 c-0.53,0.46-1.06,0.91-1.56,1.38l0,0c-0.04,0.04-0.08,0.07-0.12,0.11c-5.2,4.16-8.77,2.99-11.5-0.42 c-1.95-2.44-3.26-6.04-4.48-9.41c-0.1-0.29-0.21-0.57-0.52-1.42c-1.89-5.1-3.28-11.31-4.72-17.73l-0.15-0.65 c-0.72,0.2-1.43,0.41-2.13,0.62c-1.45,0.43-2.84,0.86-4.17,1.29c-0.17,0.05-0.28,0.1-0.37,0.14c-0.87,0.35-1.26,0.5-2.04,0.14 c-7.65,2.23-14.04-1.46-18.32-7.45C3.89,82.86,2.49,79.99,1.53,77C0.57,74.01,0.04,70.89,0,67.9c-0.08-7.1,2.62-13.44,8.94-15.68 c0.31-0.51,0.49-0.79,0.88-1.12c0.44-0.37,0.8-0.5,1.55-0.77l0.24-0.09c0.03-0.01,0.06-0.02,0.09-0.03 C44.41,38.17,56.97,19.42,64.11,8.75c2-2.98,3.59-5.36,5.16-6.93c0.77-0.77,1.36-1.26,2.16-1.56c0.83-0.31,1.64-0.33,2.82-0.14 c2.86,0.46,5.87,2.45,8.88,5.57c7.06,7.32,14.55,21.28,19.85,35.84c5.31,14.6,8.47,29.91,6.86,39.89 c-0.62,3.88-1.96,7.03-4.16,9.15l0,0c-0.07,0.07-0.16,0.14-0.25,0.2c-1.4,0.95-2.72,1.32-4.08,1.38 C100.88,92.16,100.41,92.13,99.94,92.08L99.94,92.08z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </button>
                        </form>
                    </li>
                    <li><a href="CampaignType.php" class="<?php echo ($currentPath == 'CampaignType.php') ? 'active' : ''; ?> special_elite_regular">Campaign Type</a>
                        <form method="POST">
                            <button type="submit" name="campign_type_route_button" id="campign_type_route_button" class="<?php echo ($currentPath == 'CampaignType.php') ? 'active' : ''; ?> campign_type_route_button">
                                <div class="nav_icons">
                                    <svg fill="#000000" width="64px" height="64px" viewBox="-24.58 -24.58 172.04 172.04" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 110.26 122.88" xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(26.419200000000004,26.419200000000004), scale(0.57)">
                                            <rect x="-24.58" y="-24.58" width="172.04" height="172.04" rx="86.02" fill="#7ed0ec" strokewidth="0" />

                                        </g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                        <g id="SVGRepo_iconCarrier">
                                            <style type="text/css">
                                                .st0 {
                                                    fill-rule: evenodd;
                                                    clip-rule: evenodd;
                                                }
                                            </style>
                                            <g>
                                                <path class="st0" d="M10.69,55.55C5.74,57,3.64,62.09,3.71,67.87c0.03,2.61,0.5,5.35,1.35,8c0.85,2.64,2.07,5.15,3.62,7.31 c3.52,4.93,8.76,7.94,14.9,5.83c0.46-0.16,0.95-0.12,1.36,0.07c0.1-0.04,0.2-0.07,0.31-0.11c1.53-0.5,2.95-0.93,4.24-1.32 c1.44-0.43,2.8-0.82,4.08-1.16c0.99-0.27,2.01,0.32,2.28,1.31c0.02,0.07,0.03,0.14,0.04,0.21c0.18,0.81,0.37,1.62,0.55,2.43 c1.41,6.28,2.77,12.34,4.59,17.26c0.03,0.09,0.27,0.76,0.52,1.43c1.12,3.1,2.33,6.41,3.88,8.36c1.37,1.71,3.26,2.22,6.2-0.08 c0.55-0.52,1.11-1,1.68-1.49c1.75-1.51,3.51-3.01,4.15-5.27c-0.4-0.55-1.17-0.88-1.94-1.21c-2.57-1.09-5.14-2.19-4.45-7.59 c0.03-0.28,0.07-0.53,0.1-0.78c0.2-1.58,0.31-2.39,0.21-2.74c-0.05-0.19-0.44-0.54-1.21-1.25l-0.28-0.26 c-1.52-1.39-2.06-3.38-2.04-5.53c0.02-2.53,0.85-5.31,1.68-7.31c0.26-0.63,0.83-1.04,1.46-1.13l0,0 c19.22-2.66,30.94,0.68,40.26,3.34c0.4,0.11,0.8,0.23,1.19,0.34c-8.32-8.58-15.14-21.58-19.81-34.9 c-4.93-14.07-7.46-28.61-6.8-38.79c-7.62,11.26-20.99,29.14-52.86,40.86c-0.03,0.01-0.06,0.02-0.09,0.03l-0.25,0.09 c-0.33,0.12-0.38,0.09-0.43,0.13c-0.07,0.06,0,0.06-0.13,0.27c-0.02,0.03,0.04-0.07-0.34,0.53C11.49,55.15,11.11,55.42,10.69,55.55 L10.69,55.55L10.69,55.55z M90.07,52.82c0,4.61-4.52,12.9-7.35,13.06c4.82,9.44,10.74,17.61,17.41,22.49 c0.39,0.05,0.75,0.08,1.09,0.06c0.65-0.02,1.29-0.2,1.99-0.64c1.52-1.53,2.48-3.93,2.97-6.96c1.5-9.34-1.56-23.97-6.69-38.05 C94.35,28.67,87.17,15.22,80.46,8.26C78,5.71,75.68,4.11,73.67,3.78c-0.51-0.08-0.8-0.1-0.94-0.05c-0.17,0.06-0.43,0.3-0.84,0.71 c-0.2,0.2-0.4,0.42-0.61,0.66c-0.02,0.06-0.05,0.12-0.07,0.17c-3.14,6.48-2.12,20.47,1.95,35.47l0,0 C76.23,39.3,90.07,40.94,90.07,52.82L90.07,52.82z M99.94,92.08c-0.4,0.08-0.83,0.02-1.21-0.18c-0.35-0.06-0.7-0.14-1.07-0.21 c-2.42-0.5-4.83-1.19-7.43-1.93c-8.81-2.51-19.86-5.66-37.66-3.38c-0.55,1.52-1.01,3.33-1.02,4.94c-0.01,1.16,0.21,2.18,0.83,2.75 l0.28,0.26c1.32,1.2,1.97,1.79,2.3,3.04c0.28,1.04,0.14,2.09-0.13,4.17c-0.03,0.24-0.06,0.5-0.1,0.78 c-0.33,2.62,0.95,3.17,2.23,3.71c1.66,0.71,3.33,1.42,4.15,3.69c0.14,0.33,0.19,0.71,0.12,1.09c-0.75,3.84-3.13,5.89-5.52,7.94 c-0.53,0.46-1.06,0.91-1.56,1.38l0,0c-0.04,0.04-0.08,0.07-0.12,0.11c-5.2,4.16-8.77,2.99-11.5-0.42 c-1.95-2.44-3.26-6.04-4.48-9.41c-0.1-0.29-0.21-0.57-0.52-1.42c-1.89-5.1-3.28-11.31-4.72-17.73l-0.15-0.65 c-0.72,0.2-1.43,0.41-2.13,0.62c-1.45,0.43-2.84,0.86-4.17,1.29c-0.17,0.05-0.28,0.1-0.37,0.14c-0.87,0.35-1.26,0.5-2.04,0.14 c-7.65,2.23-14.04-1.46-18.32-7.45C3.89,82.86,2.49,79.99,1.53,77C0.57,74.01,0.04,70.89,0,67.9c-0.08-7.1,2.62-13.44,8.94-15.68 c0.31-0.51,0.49-0.79,0.88-1.12c0.44-0.37,0.8-0.5,1.55-0.77l0.24-0.09c0.03-0.01,0.06-0.02,0.09-0.03 C44.41,38.17,56.97,19.42,64.11,8.75c2-2.98,3.59-5.36,5.16-6.93c0.77-0.77,1.36-1.26,2.16-1.56c0.83-0.31,1.64-0.33,2.82-0.14 c2.86,0.46,5.87,2.45,8.88,5.57c7.06,7.32,14.55,21.28,19.85,35.84c5.31,14.6,8.47,29.91,6.86,39.89 c-0.62,3.88-1.96,7.03-4.16,9.15l0,0c-0.07,0.07-0.16,0.14-0.25,0.2c-1.4,0.95-2.72,1.32-4.08,1.38 C100.88,92.16,100.41,92.13,99.94,92.08L99.94,92.08z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <p class="special_elite_regular icons_text">Type</p>
                            </button>
                        </form>
                    </li>
                    <li><a href="CampaignTable.php" class="<?php echo ($currentPath == 'CampaignTable.php') ? 'active' : ''; ?> special_elite_regular">Campaign Table</a>
                        <form method="POST">
                            <button type="submit" name="campign_table_route_button" id="campign_table_route_button" class="<?php echo ($currentPath == 'CampaignTable.php') ? 'active' : ''; ?> campign_type_route_button">
                                <div class="nav_icons">
                                    <svg fill="#000000" width="64px" height="64px" viewBox="-24.58 -24.58 172.04 172.04" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 110.26 122.88" xml:space="preserve">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(26.419200000000004,26.419200000000004), scale(0.57)">
                                            <rect x="-24.58" y="-24.58" width="172.04" height="172.04" rx="86.02" fill="#7ed0ec" strokewidth="0" />

                                        </g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                        <g id="SVGRepo_iconCarrier">
                                            <style type="text/css">
                                                .st0 {
                                                    fill-rule: evenodd;
                                                    clip-rule: evenodd;
                                                }
                                            </style>
                                            <g>
                                                <path class="st0" d="M10.69,55.55C5.74,57,3.64,62.09,3.71,67.87c0.03,2.61,0.5,5.35,1.35,8c0.85,2.64,2.07,5.15,3.62,7.31 c3.52,4.93,8.76,7.94,14.9,5.83c0.46-0.16,0.95-0.12,1.36,0.07c0.1-0.04,0.2-0.07,0.31-0.11c1.53-0.5,2.95-0.93,4.24-1.32 c1.44-0.43,2.8-0.82,4.08-1.16c0.99-0.27,2.01,0.32,2.28,1.31c0.02,0.07,0.03,0.14,0.04,0.21c0.18,0.81,0.37,1.62,0.55,2.43 c1.41,6.28,2.77,12.34,4.59,17.26c0.03,0.09,0.27,0.76,0.52,1.43c1.12,3.1,2.33,6.41,3.88,8.36c1.37,1.71,3.26,2.22,6.2-0.08 c0.55-0.52,1.11-1,1.68-1.49c1.75-1.51,3.51-3.01,4.15-5.27c-0.4-0.55-1.17-0.88-1.94-1.21c-2.57-1.09-5.14-2.19-4.45-7.59 c0.03-0.28,0.07-0.53,0.1-0.78c0.2-1.58,0.31-2.39,0.21-2.74c-0.05-0.19-0.44-0.54-1.21-1.25l-0.28-0.26 c-1.52-1.39-2.06-3.38-2.04-5.53c0.02-2.53,0.85-5.31,1.68-7.31c0.26-0.63,0.83-1.04,1.46-1.13l0,0 c19.22-2.66,30.94,0.68,40.26,3.34c0.4,0.11,0.8,0.23,1.19,0.34c-8.32-8.58-15.14-21.58-19.81-34.9 c-4.93-14.07-7.46-28.61-6.8-38.79c-7.62,11.26-20.99,29.14-52.86,40.86c-0.03,0.01-0.06,0.02-0.09,0.03l-0.25,0.09 c-0.33,0.12-0.38,0.09-0.43,0.13c-0.07,0.06,0,0.06-0.13,0.27c-0.02,0.03,0.04-0.07-0.34,0.53C11.49,55.15,11.11,55.42,10.69,55.55 L10.69,55.55L10.69,55.55z M90.07,52.82c0,4.61-4.52,12.9-7.35,13.06c4.82,9.44,10.74,17.61,17.41,22.49 c0.39,0.05,0.75,0.08,1.09,0.06c0.65-0.02,1.29-0.2,1.99-0.64c1.52-1.53,2.48-3.93,2.97-6.96c1.5-9.34-1.56-23.97-6.69-38.05 C94.35,28.67,87.17,15.22,80.46,8.26C78,5.71,75.68,4.11,73.67,3.78c-0.51-0.08-0.8-0.1-0.94-0.05c-0.17,0.06-0.43,0.3-0.84,0.71 c-0.2,0.2-0.4,0.42-0.61,0.66c-0.02,0.06-0.05,0.12-0.07,0.17c-3.14,6.48-2.12,20.47,1.95,35.47l0,0 C76.23,39.3,90.07,40.94,90.07,52.82L90.07,52.82z M99.94,92.08c-0.4,0.08-0.83,0.02-1.21-0.18c-0.35-0.06-0.7-0.14-1.07-0.21 c-2.42-0.5-4.83-1.19-7.43-1.93c-8.81-2.51-19.86-5.66-37.66-3.38c-0.55,1.52-1.01,3.33-1.02,4.94c-0.01,1.16,0.21,2.18,0.83,2.75 l0.28,0.26c1.32,1.2,1.97,1.79,2.3,3.04c0.28,1.04,0.14,2.09-0.13,4.17c-0.03,0.24-0.06,0.5-0.1,0.78 c-0.33,2.62,0.95,3.17,2.23,3.71c1.66,0.71,3.33,1.42,4.15,3.69c0.14,0.33,0.19,0.71,0.12,1.09c-0.75,3.84-3.13,5.89-5.52,7.94 c-0.53,0.46-1.06,0.91-1.56,1.38l0,0c-0.04,0.04-0.08,0.07-0.12,0.11c-5.2,4.16-8.77,2.99-11.5-0.42 c-1.95-2.44-3.26-6.04-4.48-9.41c-0.1-0.29-0.21-0.57-0.52-1.42c-1.89-5.1-3.28-11.31-4.72-17.73l-0.15-0.65 c-0.72,0.2-1.43,0.41-2.13,0.62c-1.45,0.43-2.84,0.86-4.17,1.29c-0.17,0.05-0.28,0.1-0.37,0.14c-0.87,0.35-1.26,0.5-2.04,0.14 c-7.65,2.23-14.04-1.46-18.32-7.45C3.89,82.86,2.49,79.99,1.53,77C0.57,74.01,0.04,70.89,0,67.9c-0.08-7.1,2.62-13.44,8.94-15.68 c0.31-0.51,0.49-0.79,0.88-1.12c0.44-0.37,0.8-0.5,1.55-0.77l0.24-0.09c0.03-0.01,0.06-0.02,0.09-0.03 C44.41,38.17,56.97,19.42,64.11,8.75c2-2.98,3.59-5.36,5.16-6.93c0.77-0.77,1.36-1.26,2.16-1.56c0.83-0.31,1.64-0.33,2.82-0.14 c2.86,0.46,5.87,2.45,8.88,5.57c7.06,7.32,14.55,21.28,19.85,35.84c5.31,14.6,8.47,29.91,6.86,39.89 c-0.62,3.88-1.96,7.03-4.16,9.15l0,0c-0.07,0.07-0.16,0.14-0.25,0.2c-1.4,0.95-2.72,1.32-4.08,1.38 C100.88,92.16,100.41,92.13,99.94,92.08L99.94,92.08z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <p class="special_elite_regular icons_text">Table</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

            <div class="sidebar_sub_dev">
                <hr>
                <form method="POST">
                    <button type="submit" name="profile-button" id="profile-button" class="<?php echo ($currentPath == 'Profile.php') ? 'active' : ''; ?> profile-button">
                        <img src="../../images/admin_pf_icon.png" alt="admin logo" class="profile_avatar">
                        <span class="profile_name special_elite_regular"><?php echo $LoginUserEmail ?></span>
                    </button>
                </form>
            </div>
        </nav>
        <div class="media_register_main_dev">
            <h1 class="special_elite_regular show_center_text">Campaign Data Table</h1>
        </div>
    </div>
    <br>
    <div class="media_container">
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1 special_elite_regular">Id</div>
                <div class="col col-3 special_elite_regular">Name</div>
                <div class="col col-3 special_elite_regular">Media</div>
                <div class="col col-3 special_elite_regular">Tech</div>
                <div class="col col-3 special_elite_regular">Camp_Type</div>
                <div class="col col-1 special_elite_regular">Action</div>
            </li>
            <?php showCamp()?>
           
         
        </ul>
    </div>
    </div>
</body>

<script>
    function previewImage(input, previewElementId) {
        const previewElement = document.getElementById(previewElementId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewElement.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewElement.src = "";
        }
    }
</script>

<?php
$FooterFilePath = "../layout/footer.php";

if (file_exists($FooterFilePath)) {
    include($FooterFilePath);
} else {
    echo "<p class='error'>Error: Unable to include file <strong>$FooterFilePath</strong> - File does not exist.</p>";
    return;
}
?>