<?php
    session_start();
    include_once "config.php";


    if(isset($_POST['signup'])){
        $username        = mysqli_real_escape_string($conn, $_POST['username']);
        $email           = mysqli_real_escape_string($conn, $_POST['email']);
        $password        = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword       = mysqli_real_escape_string($conn, $_POST['cpassword']);
        $bio             = 'Hello, Im using Web Pigeon';
        $img             = '1';
        $avatars         = "1";



        if(!empty($username)&& !empty($email) && !empty($password) && !empty($cpassword)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                if(mysqli_num_rows($sql) > 0){
                    echo "<script>alert('$email - This email already exist!')</script>";
                }else{
                    $sql7 = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}'");
                    if (!ctype_alnum($_POST['username'])) {
                        echo "<script>alert('Input data should be alpha numeric characters only.')</script>";
                    }else{
                        if(mysqli_num_rows($sql7) > 0){
                            echo "<script>alert('$username - This username already exist!')</script>";
                        }else{
                            if($password !== $cpassword){
                                echo "<script>alert('Confirm password not matched!')</script>";
                            }else{
                                $ran_id = rand(500000000, 599999999);
                                $status = "Online Now";
                                $encrypt_pass = md5($password);
        
                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, username, email, password, bio, avatars, img, status)
                                VALUES ({$ran_id}, '{$username}', '{$email}', '{$encrypt_pass}', '{$bio}', '{$avatars}', '{$img}', '{$status}' )");
                                    
                                if($insert_query){
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        echo "success";
                                        header('location: profile.php');
                                    }else{
                                        echo "This email address not Exist!";
                                    }
                                }else{
                                    echo "Something went wrong. Please try again!";
                                }
                            }
                        }
                    }
                }
            }else{
                echo "$email is not a valid email!";
            }
        }else{
            echo "All input fields are required!";
        }    
    }








    //if user click login button
    if(isset($_POST['login'])){
        $user     = mysqli_real_escape_string($conn, $_POST['user']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if(!empty($user) && !empty($password)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE (username = '{$user}' OR email = '{$user}') ");

            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                $user_pass = md5($password);
                $enc_pass = $row['password'];
                if($user_pass === $enc_pass){
                    $status = "Online Now";

                    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                    if($sql2){
                        $_SESSION['unique_id'] = $row['unique_id'];
                        echo "success";
                        header('location: profile.php');
                    }else{
                        $errors['user'] = "Something went wrong. Please try again!";
                    }
                }else{
                    $errors['user'] = "user or Password is Incorrect!";
                }
            }else{
                $errors['user'] = "$user - This user not Exist!";
            }
        }else{
            $errors['user'] = "All input fields are required!";
        }
    }




    //if user upload image
    if(isset($_POST['upload'])) {

        $img_name = $_FILES['image']['name'];
        $img_type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        
        $img_explode = explode('.',$img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];
        if(in_array($img_ext, $extensions) === true){
            $types = ["image/jpeg", "image/jpg", "image/png"];
            if(in_array($img_type, $types) === true){
                $time = time();
                $new_img_name = $time.$img_name;
                if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                    $insert_query = mysqli_query($conn, "UPDATE  users SET img = '{$new_img_name}' WHERE unique_id = {$_SESSION['unique_id']}");
                }
            }else{
                echo "Please upload an image file - jpeg, png, jpg";
            }
        }else{
            echo "Please upload an image file - jpeg, png, jpg";
        }
                
    }


    //if user click admin update button
    if(isset($_POST['profile_edit'])){
        $unique_id         = $_SESSION['unique_id'];
        $username          = $_POST['username'];
        $bio               = $_POST['bio'];
        $email             = $_POST['email'];
        $query             = "UPDATE users SET username = '$_POST[username]', email = '$_POST[email]', bio = '$_POST[bio]' WHERE unique_id = {$_SESSION['unique_id']}";
        $res               = mysqli_query($conn, $query) or die(mysqli_error($conn));

    }

    //if user click admin update button
    if(isset($_POST['send_message'])){
        if(isset($_SESSION['unique_id'])) {
            $outgoing_id = $_SESSION['unique_id'];
        }else {
            $outgoing_id = "1";
        }
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        $date = date("d/m/Y \t h:i:s a");

        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, date)
                                        VALUES ({$incoming_id}, '{$outgoing_id}', '{$message}', '{$date}')") or die();
        }
        else{
            header("location: profile.php");
        }

    }



?>