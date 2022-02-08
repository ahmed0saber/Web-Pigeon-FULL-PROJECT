<?php
  require_once "controllerUserData.php";
	if(!isset($_SESSION['unique_id'])) {
		header("location: login.php");
	}

  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");

  
  if(mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
  }

  $unique_id = $row['unique_id'];

  $sql2 = mysqli_query($conn, "SELECT * FROM messages WHERE incoming_msg_id = $unique_id ");

  $sql3 = mysqli_query($conn, "SELECT * FROM messages WHERE incoming_msg_id = $unique_id ORDER BY msg_id ");

  if(mysqli_num_rows($sql2) > 0) {
    $row2 = mysqli_fetch_assoc($sql2);
  }

  if(mysqli_num_rows($sql2) > 0) {
    $row2 = mysqli_fetch_assoc($sql2);
  }

    if($row['img'] == 1) {
        $image = "default.png";
    }else {
        $image = $row['img'];
    }

    $incoming_msg_id = $unique_id

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
    <title>Profile | Web Pigeon</title>
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
                    <a class="link" href="search.php"><i class="fa fa-search"></i> Search</a>
                    <a class="link active" href="profile.php"><i class="fa fa-user"></i> Profile</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container profile">
        <section class="user-data">
            <div class="img-container">
                <div class="cover"></div>
                <img src="images/<?php echo $image?>">
            </div>
            <div class="text-container">
                <div>
                    <h1><?php echo $row['username']?></h1>
                    <p><?php echo $row['bio']?></p>
                </div>
                <div class="profile-btns">
                    <a href="edit.php">Edit Profile</a>
                    <a href="logout.php?logout_id=<?php echo $row['unique_id']; ?>">Log out</a>
                    <a class="copylink" onclick="navigator.clipboard.writeText(`
                    <?php
                        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        $url = explode('/', $actual_link);
                        array_pop($url);
                        $url2=implode("/",$url) ;
                        $url3 = '/send.php?id='.$row['unique_id'];

                        echo $url2 . $url3;

                     ?>
                    `)">Copy Link</a>
                </div>
            </div>
        </section>

        <section class="messages">
            <h2>
                <?php
                    $result = mysqli_query($conn, "SELECT * FROM messages WHERE incoming_msg_id = '{$incoming_msg_id}'");
                    $i = 0;
                    while($row = $result->fetch_assoc() ) {//while look to fetch the result and store in a array $row.      
                        $i++;
                    }
                    echo $i;
                ?>

                 Messages Recieved</h2>

            <section>
                <form action="#" method="">
                    <i class='fa fa-search icon'></i>
                    <input type="text" name="search" placeholder="some letters you remmember from the message" id="searchBar2" onkeyup="filterFunction2()">
                </form>
            </section>
            <section class="messages-container" id="myMenu2">
                <?php
                    $result = mysqli_query($conn, "SELECT * FROM messages WHERE incoming_msg_id = '{$incoming_msg_id}' ORDER BY msg_id DESC ");
                    //$i = 1;
                    while($row = $result->fetch_assoc() ) {//while look to fetch the result and store in a array $row.      
                        // output data of each row
                            echo '
                            <div class="msg">
                                <span class="msg-num">'.$i.'</span>
                                <i class="fa fa-star" onclick="add_to_fav(this)"></i>
                                <p>'. $row['msg'].'</p>
                                <p class="msg-date">'.$row['date'].'</p>
                            </div>
                            ';
                            $i--;
                    }
                ?>
            </section>

            <section class="fav-messages-container">

            </section>
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
        <a class="" href="search.php"><i class="fa fa-search"></i></a>
        <a class="" href="index.php"><i class="fa fa-home"></i></a>
        <a class="active" href="profile.php"><i class="fa fa-user"></i></a>
    </div>

    <button onclick="changeTheme()" class="btn-floating"><i class="fa fa-magic"></i></button>
</body>

<script src="./js/theme.js"></script>
<script src="js/search.js"></script>
<script src="js/fav.js"></script>
</html>