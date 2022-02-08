<?php
  require_once "controllerUserData.php";
	/*if(!isset($_SESSION['unique_id'])) {
		header("location: login.php");
	}*/

  $sql = mysqli_query($conn, "SELECT * FROM users ");

  if(mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="theme-color" content="#2b2b2b">
    <meta name="msapplication-navbutton-color" content="#2b2b2b">
    <meta name="apple-mobile-web-app-status-bar-style" content="#2b2b2b">
    <meta name="description" content="Web-Pigeon is a website where you can send and receive messages without knowing sender name.">
    <meta name="keywords" content="web-pigeon, Ahmed Saber, Full Stack Web Developer">
    <meta name="author" content="Ahmed Saber, ahmed0saber33@gmail.com">
    <meta name="og:title" content="Web Pigeon">
    <meta name="og:description" content="Web-Pigeon is a website where you can send and receive messages without knowing sender name.">
    
    <meta property="og:image" content="https://drive.google.com/u/0/uc?id=1cW0Xb57DLj7OZbntxsesjZrr4Gh9LLll&export=download">
    <link rel="icon" href="https://drive.google.com/u/0/uc?id=1cW0Xb57DLj7OZbntxsesjZrr4Gh9LLll&export=download" type="image/x-icon">

    <meta name="og:type" content="web-pigeon">
    <meta name="og:email" content="ahmed0saber33@gmail.com">
    <meta name="og:phone_number" content="+201208611892">
    <meta name="og:country-name" content="Egypt">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | Web Pigeon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Bree Serif' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a><span>W</span>eb <span>P</span>igeon</a>
            </div>
            <div class="links">
                <div>
                    <a class="link" href="index.php"><i class="fa fa-home"></i> Home</a>
                    <a class="link active" href="search.php"><i class="fa fa-search"></i> Search</a>
                    <a class="link" href="profile.php"><i class="fa fa-user"></i> Profile</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container search">

        <section>
            <form action="#" method="">
                <i class='fa fa-search icon'></i>
                <input type="text" name="search" placeholder="username" id="searchBar" onkeyup="filterFunction()">
            </form>
        </section>

        <section class="search-results" id="myMenu">
            <div id="myMenu">
                <?php
                    $result = mysqli_query($conn, "SELECT * FROM users ORDER BY id ");
                    while($row = $result->fetch_assoc() ) {//while look to fetch the result and store in a array $row.      
                        // output data of each row
                        if($row['img'] == 1) {
                            $image = "default.png";
                        }else{
                            $image = $row['img'];
                        }
                        
                        echo '
                        <div class="user-card">
                            <img src="images/'. $image .'">
                            <h3>'. $row['username'].'</h3>
                            <p>'. $row['bio'] .'</p>
                            <a href="send.php?id='. $row['unique_id'] .'"><i class="fa fa-link"></i></a>
                        </div>
                        ';
                    }
                ?>
            </div>
        </section>
    </main>

    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="by">
                <span>© 2022 Copyright : Ahmed Saber & Hassan El-Deghedy</span>
            </div>
            <div>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>
            </div>
        </div>
    </footer>

    <div class="bottom-nav hide-on-large-only">
        <a class="active" href="search.php"><i class="fa fa-search"></i></a>
        <a class="" href="index.php"><i class="fa fa-home"></i></a>
        <a class="" href="profile.php"><i class="fa fa-user"></i></a>
    </div>

    <button onclick="changeTheme()" class="btn-floating"><i class="fa fa-magic"></i></button>
</body>
<script src="./js/theme.js"></script>
<script src="js/search.js"></script>
</html>