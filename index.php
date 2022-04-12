<?php

    $cnx = mysqli_connect('localhost','root','root','root','indexation');
    $firstName =  $_POST['firstName']  ?? '';
    $lastName =  $_POST['lastName']  ?? '';
    $email =  $_POST['email']  ?? '';
    $errors = [
        'firstNameError' => '',
        'lastNameError' => '',
        'emailError' => '',
     ];
    
      
    if(isset($_POST['submit'])){
        
        if(empty($firstName)){
            $errors['firstNameError'] = 'First Name Empty !';
        }
        if(empty($lastName)){
            $errors['lastNameError'] = 'Last Name Empty !';
        } 
        if(empty($email)){
            $errors['emailError'] = 'E-mail Empty !';
        }
        if(!filter_var($email ,FILTER_VALIDATE_EMAIL)){
            $errors['emailError'] = 'Please enter a correct email !';
        } 
        
        if(!array_filter($errors)){
            $firstName =  mysqli_real_escape_string($cnx ,$_POST['firstName']) ;
            $lastName = mysqli_real_escape_string($cnx ,$_POST['lastName']) ; 
            $email= mysqli_real_escape_string($cnx ,$_POST['email']);
            
            
            $sql ="INSERT INTO indexation(first_name,last_name,email) VALUES ('$firstName','$lastName','$email')";
    
            if(mysqli_query($cnx , $sql))
            {
              header('Location: '.$_SERVER['PHP_SELF'] );
            }else{
              echo 'Error :' . mysqli_error($cnx);
            }        
        }          
    }

    /*if (isset($_POST['submit'])){
       
        

        mysqli_query($cnx, $sql);
    }*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Formulaire</title>
</head>
<body>
   

    <br>
    <br>
    <br>
    <br>
    <div class="text-end">
    <form action="recherche.php">
     <input class="btn btn-primary" type="submit" name="submit" value="chercher" />
   </form>
    </div>
   
    <div class="container text-center">
    <form  method="POST" action="<?php $_SERVER['PHP_SELF']?>">
    <?php if(!isset($_POST['submit']) ){
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        Envoyé avec succée
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" ></button>
         </div>
     <?php    
    }?>
        <label for="firstName">First Name: </label>
        <input class="form-control" type="text" name="firstName"id="firstName" value="<?php echo $firstName ?>" name="firstName" placeholder="First Name" />
        <div class="form-text error"><?php echo $errors['firstNameError'] ?></div>
        <label for="email">Last Name: </label>
        <input class="form-control" type="text" id="lastName"  value="<?php echo $lastName ?>" name="lastName" placeholder="Last Name" />
        <div class="form-text error"><?php echo $errors['lastNameError'] ?></div>
        <label for="email">Adresse mail: </label>
        <input class="form-control" type="email" id="email" value="<?php echo $email ?>" name="email" placeholder="Email" />
        <div class="form-text error"><?php echo $errors['emailError'] ?></div>
        <br>
        <input class="btn btn-primary" type="submit" name="submit" value="Envoyer" />
   </form>
   <br>
    </div>
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
</body>
</html>
