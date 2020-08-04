<?php

/**require_once('dbcon.php');

$fname=isset($_POST['fname'])?$_POST['fname']:"";
$lname=isset($_POST['lname'])?$_POST['lname']:"";
$roll=isset($_POST['fname'])?$_POST['fname']:"";
$reg=isset($_POST['reg'])?$_POST['reg']:"";
$email=isset($_POST['email'])?$_POST['email']:"";
$username=isset($_POST['username'])?$_POST['username']:"";
$password=isset($_POST['password'])?$_POST['password']:"";
$phone=isset($_POST['phone'])?$_POST['phone']:"";

$requete="insert into student (fname,lname,roll,reg,email,username, password, phone) values (?,?,?,?,?)";
$params=array($fname, $lname, $roll,$reg, $email, $username, $password, $phone);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);

//header('location:stagiaires.php')

**/

// Connexion à MySQL
$connection=mysqli_connect("localhost", "root", "", "paysystem");


if (!$connection){ // Contrôler la connexion
    $MessageConnexion = die ("connection impossible");
}
else {
if(isset($_POST['student_register'])){ // Autre contrôle pour vérifier si la variable $_POST['Bouton'] est bien définie
    
    
    
    session_start();

if (isset($_SESSION['student_login'])){
    header('location: index.php');
    
}
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $roll = $_POST['roll'];
    $reg = $_POST['reg'];
    $phone = $_POST['phone'];
    
    $input_errors = array();
    
    
    if(empty($fname)){
        $input_errors['fname'] = "Fist name field is required!";
        
    }
    
      if(empty($lname)){
        $input_errors['lname'] = "Last name field is required!";
        
    }
    
      if(empty($email)){
        $input_errors['email'] = "Email field is required!";
        
    }
      if(empty($username)){
        $input_errors['username'] = "Username field is required!";
        
    }
      if(empty($password)){
        $input_errors['password'] = "Password  field is required!";
        
    }
      if(empty($roll)){
        $input_errors['roll'] = "Roll field is required!";
        
    }
      if(empty($reg)){
        $input_errors['reg'] = "Reg field is required!";
        
    }
      if(empty($phone)){
        $input_errors['phone'] = "Phonefield is required!";
        
    }

    
    if (count($input_errors) == 0){
        
        $email_check = mysqli_query($connection, "SELECT * FROM student WHERE email = '$_POST[email]'");
       //print_r($email_check);
        $email_check_row = mysqli_num_rows($email_check);
        
        if ($email_check_row == 0){
            
        $username_check = mysqli_query($connection, "SELECT * FROM student WHERE username = '$_POST[username]'");
        $username_check_row = mysqli_num_rows($username_check);
            
             if ($username_check_row == 0){
                   
                  if (strlen($username) >7){
                      
                      if (strlen($password) >= 6){
                          
                          
               $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Requête d'insertion
   
                            $AjouterDisque="INSERT INTO student3 (fname,lname, roll, reg, email, username, password, statuts, phone) VALUES                          ('$fname','$lname','$roll','$reg','$email','$username','$password_hash','0','$phone')";
             // Exécution de la reqête
                mysqli_query($connection, $AjouterDisque) or die('Erreur SQL !'.$AjouterDisque.'<br>'.mysqli_error($connection));
 

                        if($AjouterDisque){
                        $success="Registration sucessfully !";
        
    }else{
        $error = "something Wrong!";
    }
                          
                           }else{
                     $password_error = "Password more than 8 characters";
            
                       }
                      }else{
                     $username_exists = "username more than 8 characters";
            
                       }
         
        } else{
                 
            $username_exists = "This username already exists";
            
        }
            
        } else{
            $email_exists = "This email already exists";
            
        }
  
        
      
 }
}
}
?>

              

<!DOCTYPE html>

<html lang="en" class="fixed accounts sign-in"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Student Register</title>
    <script src="css/apace.min.js"></script>
    <link href="css/apace-theme-minimal.css" rel="stylesheet">

    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/animate.css">
    <!-- ========================================================= -->
    <!--Notification msj-->
    <link rel="stylesheet" href="css/toastr.min.css">
    <!--Magnific popup-->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="css/style.css">
        
    

    
       <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
	


    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	
	 <script src="js/jquery-1.10.2.js"></script>
</head>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
           <h1 class="text-center">LMS</h1>
            <?php

           if (isset($success)){
               ?>
            
              <div class="alert alert-success" role="alert">
                   <?=$success ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
            
            <?php
    
            }

            ?>
            
            
            <?php

           if (isset($error)){
               ?>
            
              <div class="alert alert-danger" role="alert">
                   <?=$error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
            
            <?php
    
            }

            ?>
            
            
             <?php

           if (isset($email_exists)){
               ?>
            
              <div class="alert alert-danger" role="alert">
                   <?=$email_exists ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
            
            <?php
    
            }

            ?>
            
            
             <?php

           if (isset($username_exists)){
               ?>
            
              <div class="alert alert-danger" role="alert">
                   <?=$username_exists ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
            
            <?php
    
            }

            ?>
            
              <?php

           if (isset($password_error)){
               ?>
            
              <div class="alert alert-danger" role="alert">
                   <?=$password_error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
            
            <?php
    
            }

            ?>
        
        
            </div> 
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">  
                <div class="panel-content bg-scale-0">
                    <form method="post" action="register.php">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="First Name" name="fname" value="<?=isset ($fname) ? $fname:'' ?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php
                            if(isset($input_errors['fname'])){
                                echo '<span class="input-error">'.$input_errors['fname'].'</span>';
                            }

                           ?>
                        </div>
                        
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="Last Name" name="lname" value="<?=isset ($lname) ? $lname:'' ?>">
                                <i class="fa fa-user"></i>
                            </span>
                              <?php
                            if(isset($input_errors['lname'])){
                                echo '<span class="input-error">'.$input_errors['lname'].'</span>';
                            }

                           ?>
                        </div>
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="<?=isset ($email) ? $email:'' ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            
                              <?php
                            if(isset($input_errors['email'])){
                                echo '<span class="input-error">'.$input_errors['email'].'</span>';
                            }

                           ?>
                        </div>
                        
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="<?=isset ($username) ? $username:'' ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            
                              <?php
                            if(isset($input_errors['username'])){
                                echo '<span class="input-error">'.$input_errors['username'].'</span>';
                            }

                           ?>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control"  placeholder="Password" name="password" value="<?=isset ($password) ? $password:'' ?>">
                                <i class="fa fa-key"></i>
                            </span>
                            
                              <?php
                            if(isset($input_errors['password'])){
                                echo '<span class="input-error">'.$input_errors['password'].'</span>';
                            }

                           ?>
                        </div>
                        
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Roll" name="roll" pattern="[0-9]{6}" value="<?=isset ($roll) ? $roll:'' ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            
                              <?php
                            if(isset($input_errors['roll'])){
                                echo '<span class="input-error">'.$input_errors['roll'].'</span>';
                            }

                           ?>
                        </div>
                        
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="Reg. No" name="reg" pattern="[0-9]{6}"value="<?=isset ($reg) ? $reg:'' ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            
                              <?php
                            if(isset($input_errors['reg'])){
                                echo '<span class="input-error">'.$input_errors['reg'].'</span>';
                            }

                           ?>
                        </div>
                        
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" placeholder="01*******" name="phone" pattern="01[1|5|6|7|8|9][0-9]{8}"value="<?=isset ($phone) ? $phone:'' ?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            
                              <?php
                            if(isset($input_errors['phone'])){
                                echo '<span class="input-error">'.$input_errors['phone'].'</span>';
                            }

                           ?>
                        </div>
                        <div class="form-group">
                          <input class="btnt btn-primary btn-block" type="submit" name="student_register" value="Register">
                        </div>
                        <div class="form-group text-center">
                            Have an account?, <a href="sign-in.php">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<
<?php 
require_once'footer.php';
?>


</body></html>