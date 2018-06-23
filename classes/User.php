<?php

class User{

    private $db;
    private $session;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->session = new Session();
    }


    public function regUser()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        $email_verified = 0;

        $query = "SELECT * FROM users WHERE email = '{$email}'";
        $row = $this->db->select($query);

        if($row){
            return false;
        }else{
            $query = "INSERT INTO users (username,email, password, email_verified) 
                      VALUES('{$username}','{$email}', '{$pass}','{$email_verified}')";
            $insert = $this->db->insert($query);

            if($insert){
                // SEND EMAIL
                $this->sendMail($email);
                return true;
            }
        }

    }

    public function activateAccount($email)
    {
        $query = "UPDATE users set email_verified = 1 WHERE email = '{$email}'";
        $update = $this->db->update($query);
        if($update){
            return true;
        }else{
            return false;
        }
    }


    public function sendMail($email)
    {
        require_once "./phpmejl/PHPMailerAutoload.php";

        $activationLink = 'http://YOUR_ROOT_PATH/activate.php?email='.$email;

        $mail = new PHPMailer;

        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = '';          // SMTP username
        $mail->Password = ''; // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                          // TCP port to connect to

        $mail->setFrom('info@example.com', 'Srdjan');
        $mail->addReplyTo('info@example.com', 'Srdjan');
        $mail->addAddress($email);   // Add a recipient
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        $mail->isHTML(true);  // Set email format to HTML

        $message = '<head>
                            <style>
                                .main {
                                    text-align: center;
                                    width: 650px;
                                    margin: 0 auto;
                                    padding: 10px;
                                }
                                
                                .main-text {
                                    padding: 20px 0;
                                    background-color: #039EEC;
                                    color: #fff;
                                    margin-bottom: 30px;
                                }
                                
                                .btn {
                                    width: 50%;
                                    background-color: #00BFA5;
                                    padding: 10px;
                                    color: #fff;
                                    font-size: 16px;
                                }
                                
                                p.text {
                                    font-size: 16px;
                                }
                                
                                .footer-heading {git 
                                    color: #039EEC;
                                }
                                
                            </style>
                        </head>';

        $message .= '<div class="main">
                            <div class="main-text">
                                <h1>Welcome to our Application</h1>
                                <p class="text">You are just one click away from using Our App. We just need you to activate your account by clicking the button below.</p>
                                <a class="btn" href="'. $activationLink .'">Activate account</a>
                            </div>
                            <div class="main-footer">
                                <h1 class="footer-heading">We\'re happy to help!</h1>
                                <p class="text">If you have any problems please call our tech support, 555-333 or send us an email at <b>support@ouremail.net</b></p>
                            </div>
                        </div>';

        $mail->Subject = 'Account activation';
        $mail->Body = $message;

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            // echo 'Message has been sent';
        }
    }

    public function loginUser(){

       $email = $_POST['username'];
       $password = md5($_POST['password']);
       $query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' AND email_verified = 1";
       $row = $this->db->select($query);

       if($row !== FALSE){
           $this->session->start();
           $this->session->set("userLogin",true);
           $this->session->set("userEmail", $email);
           echo "<script>window.location = 'http://YOUR_ROOT_PATH/dashboard.php';</script>";

       }else{
           return false;
       }

  }


  public function generateHash($lenght = 10)
  {
      $hashChars = 'qwertyuioasdfghjkl12234567890AQWSEDRFTGYHUJIKOLPZ';
      $charLenght = strlen($hashChars);
      $randHash = '';
      for($i = 0; $i < $lenght; $i++){
          $randHash.= $hashChars[rand(0, $charLenght -1)];
      }
      return $randHash;
  }


  public function forgot()
  {
      require_once "./phpmejl/PHPMailerAutoload.php";

      $email = $_POST['email'];

      $newHash = $this->generateHash(7);
      $newPass = md5($newHash);

      $query = "UPDATE users set password = '{$newPass}' WHERE email = '{$email}'";
      $update = $this->db->update($query);

      if($update){

          $mail = new PHPMailer;

          $mail->isSMTP();                            // Set mailer to use SMTP
          $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                     // Enable SMTP authentication
          $mail->Username = '';          // SMTP username
          $mail->Password = ''; // SMTP password
          $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 587;                          // TCP port to connect to

          $mail->setFrom('info@example.com', 'Srdjan');
          $mail->addReplyTo('info@example.com', 'Srdjan');
          $mail->addAddress($email);   // Add a recipient
          $mail->addCC('cc@example.com');
          $mail->addBCC('bcc@example.com');

          $mail->isHTML(true);  // Set email format to HTML

          $message = '<head>
                            <style>
                                .main {
                                    text-align: center;
                                    width: 650px;
                                    margin: 0 auto;
                                    padding: 10px;
                                }
                                
                                .main-text {
                                    padding: 20px 0;
                                    background-color: #039EEC;
                                    color: #fff;
                                    margin-bottom: 30px;
                                }
                                
                                .btn {
                                    width: 50%;
                                    background-color: #00BFA5;
                                    padding: 10px;
                                    color: #fff;
                                    font-size: 16px;
                                }
                                
                                p.text {
                                    font-size: 16px;
                                }
                                
                                .footer-heading {git 
                                    color: #039EEC;
                                }
                                
                            </style>
                        </head>';

          $message .= '<div class="main">
                            <div class="main-text">
                                <h1>We change your password for you!</h1>
                                <p class="text">Your new password:</p>
                                <p style="color:#000;"><b>'.$newHash.'</b></p>
                            </div>
                            <div class="main-footer">
                                <h1 class="footer-heading">We\'re happy to help!</h1>
                                <p class="text">If you have any problems please call our tech support, 555-333 or send us an email at <b>support@ouremail.net</b></p>
                            </div>
                        </div>';

          $mail->Subject = 'Forgot password';
          $mail->Body = $message;

          if(!$mail->send()) {
              echo 'Message could not be sent.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
              // echo 'Message has been sent';
          }
      }
  }


  public function changePassword(){

        $newPass = md5($_POST['newPass']);
        $email = $this->session->get("userEmail");
        $update = "UPDATE users set password = '{$newPass}' WHERE email = '{$email}'";
        if($this->db->update($update)){
            return true;
        }else{
            return false;
        }
  }






}


