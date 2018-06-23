<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/tuts/register_workflow/config.php");
$user = new User();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP ZA POCETNIKE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div id="pageContainer">
    <div id="formContainer">
        <div id="logo"><img src="https://media.phpnuke.org/000/984/101/810_574_580_580-1.jpg"/></div>
        <div id="forms">
            <form id="whyReg">
                <div class="fadeUp">
                    <div class="formHead">
                        <h1>WHY REGISTER?</h1>
                    </div>
                    <div class="formDiv">
                        <ul>
                            <li>Access to member only pages.</li>
                            <li>Able to comment on any post to share your opinion.</li>
                            <li>Able to download source code files.</li>
                        </ul>
                    </div>
                    <div class="formOther"><a class="regBtn" href="#">Close</a></div>
                </div>
            </form>
            <form id="forgot" method="post" action="">
                <div class="fadeUp">
                    <div class="formHead">
                        <h1>FORGOT PASSWORD?</h1>
                        <p>Looks like you forgot your password</p>
                    </div>
                    <div class="formDiv">
                        <input type="email" name="email" placeholder="Type your email"/>
                    </div>
                    <div class="formDiv">
                        <input type="submit" name="forgot" value="SEND EMAIL"/>
                    </div>
                    <div class="formOther"><a class="backLoginF" href="#">BACK TO LOGIN</a><a href="#">CONTACT STAFF</a></div>
                </div>
            </form>

            <form id="login" method="post" action="">
                <div class="formHead">
                    <?php
                    if(isset($_POST['register'])){
                        if($user->regUser()){
                            echo "<p>Successfully registered.Please visit your email to verified email address</p>";
                        }else{
                            echo "<p style='color:#fff;'><b>Email already exist! Please login to your account.</b></p>";
                        }
                    }

                    if(isset($_POST['login'])){
                        if(!$user->loginUser()){
                            echo "<p style='color:#fff;'><b>Something went wrong! Please check your credentials or verify your email!</b></p>";
                        }
                    }

                    ?>
                    <h1>WELCOME BACK</h1>
                    <p>Login to continue</p>
                </div>

                <div class="formDiv">
                    <input type="text" placeholder="Username" name="username"/>
                </div>
                <div class="formDiv">
                    <input type="password" name="password" placeholder="Password" name="password"/>
                </div>
                <div class="formDiv">
                    <input type="submit" name="login" value="LOGIN"/>
                </div>
                <div class="formOther"><a class="forgotBtn" href="#">FORGOT PASSWORD?</a><a class="needAccount" href="#">NEED AN ACCOUNT?</a></div>
            </form>

            <form id="register" method="post" action="">
                <div class="formHead">
                    <h1>BECOME A PRO</h1>

                    <p>Register to gain full access</p>
                </div>
                <div class="formDiv">
                    <input type="text" placeholder="Username" name="username"/>
                </div>
                <div class="formDiv">
                    <input type="email" placeholder="Email" name="email"/>
                </div>
                <div class="formDiv">
                    <input type="password" placeholder="Password" name="password"/>
                </div>
                <div class="formDiv">
                    <input type="submit" name="register" value="REGISTER"/>
                </div>
                <div class="formOther"><a class="backLogin" href="#">BACK TO LOGIN</a><a class="regBtn" href="#">WHY REGISTER?</a></div>
            </form>

        </div>
    </div>
</div>

<?php

if(isset($_POST['forgot'])){
    $user->forgot();
}
?>







<script>
    $(function() {

        // Switch to Register
        $('.needAccount, .backLogin').click(function() {
            $('#login, #register, #formContainer').toggleClass('switch');
        });

        // Open Forgot Password
        $('.forgotBtn, .backLoginF').click(function() {
            $('#forgot').toggleClass('forgot');
        });

        // Open Why Register
        $('.regBtn').click(function() {
            $('#whyReg').toggleClass('whyRegister');
        });


    });
</script>

<!-- https://codepen.io/Gibbu/pen/mxGKjP -->
<!-- https://bootsnipp.com/snippets/featured/login-and-register-tabbed-form -->