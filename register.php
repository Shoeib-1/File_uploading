<?php

if (isset($_POST['firstname'])) {
    $firstname = $_POST['firstname'];
} else {
    $firstname = '';
}

if (isset($_POST['lastname'])) {
    $lastname = $_POST['lastname'];
} else {
    $lastname = '';
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    $email = '';
}

if (isset($_FILES['file']['name'])) {
    $file = $_FILES['file']['name'];
} else {
    $file = '';
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
<div class="container">

    <?php
    function password_strength($password)
    {
        $returnVal = True;
        $password_length = 8;

        if (strlen($password) < $password_length) {
            $returnVal = False;
        }

        if (!preg_match("#[0-9]+#", $password)) {
            $returnVal = False;
        }

        if (!preg_match("#[a-z]+#", $password)) {
            $returnVal = False;
        }

        if (!preg_match("#[A-Z]+#", $password)) {
            $returnVal = False;
        }

        if (!preg_match("/[\'^.£$%&*()}{@#~?><>,|=_+!-]/", $password)) {
            $returnVal = False;
        }

        return $returnVal;

    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $errors = array();

        if (empty($_POST['firstname'])) {
            $errors['firstname'] = "<div class='error error1'>Please enter your first name <span><i class='icon1 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
        } elseif (!empty($_POST['firstname']) && strlen($_POST['firstname']) < 5) {
            $errors['firstname'] = "<div class='error error1' error1>First name should be more than 5 digits<span><i class='icon1 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
        }

        if (empty($_POST['lastname'])) {
            $errors['lastname'] = "<div class='error error2' >Please enter your last name<span><i class='icon2 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
        } elseif (!empty($_POST['lastname']) && strlen($_POST['lastname']) < 5) {
            $errors['lastname'] = "<div class='error error2'>Last name should be more than 5 digits<span><i class='icon2 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
        }

        if (empty($_POST['email'])) {
            $errors['email'] = "<div class='error error3'>Please enter your email address<span><i class='icon3 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
        } elseif (!empty($_POST['email'])) {
            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
            if (!preg_match($pattern, $_POST['email'])) {
                $errors['email'] = "<div class='error error3'>Please enter valid email address<span><i class='icon3 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
            }
        }
        if (empty($_FILES['file']['name'])) {
            $errors['file'] = "<div class='error error1'>Please enter your file <span><i class='icon3 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
        }

        if (!password_strength($_POST['password'])) {
            $errors['password'] = "<div class='error error4'>Please enter valid password<span><i class='icon4 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
        } else {
            if (empty($_POST['confirm'])) {
                $errors['confirm'] = "<div class='error error5'>Please enter your confirmation password<span><i class='icon5 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
            } elseif (!empty($_POST['confirm']) && $_POST['password'] != $_POST['confirm']) {
                $errors['password'] = "<div class='error error5'>No match between passwords<span><i class='icon5 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
            }
            if (empty($_POST['firstname'])) {
            $errors['firstname'] = "<div class='error error1'>Please enter your first name <span><i class='icon1 fa-sharp fa-solid fa-circle-xmark'></i></span></div>";
        }
        }if(empty($errors)){
            session_start();
            $_SESSION['firstname'] = $_POST['firstname'];
            $_SESSION['lastname'] = $_POST['lastname'];
            $_SESSION['file'] = $_FILES['file']['name'];
            header("location: index.php");
        }
        /*if (!empty($errors)){
            foreach ($errors as $error){
                echo $error;
            }
        }else{

        }*/


    }

    ?>

    <form action="" method="post" enctype="multipart/form-data" autocomplete="on" accept-charset="UTF-8">
        <input type="text" name="firstname" placeholder="First Name .." value="<?php echo $firstname; ?>">
        <?php
        if (isset($errors['firstname'])) {
            echo $errors['firstname'];
        }
        ?>

        <input type="text" name="lastname" placeholder="Last Name .." value="<?= $lastname ?>">
        <?php
        if (isset($errors['lastname'])) {
            echo $errors['lastname'];
        }
        ?>
        <input type="email" name="email" placeholder="Email Address .." value="<?= $email ?>">
        <?php
        if (isset($errors['email'])) {
            echo $errors['email'];
        }
        ?>
        <input type="password" name="password" placeholder="Password">
        <?php
        if (isset($errors['password'])) {
            echo $errors['password'];
        }
        ?>
        <input type="password" name="confirm" placeholder="Confirm">
        <?php
        if (isset($errors['confirm'])) {
            echo $errors['confirm'];
        }
        ?>
        <input type="file" name="file" accept="image/*">
        <?php
        if (isset($errors['file'])) {
            echo $errors['file'];
        }
        ?>
        <button type="submit" name="register">Register now</button>
    </form>
</div>

<script src="js/jquery-3.6.2.js"></script>
<script src="js/main.js"></script>
</body>
</html>