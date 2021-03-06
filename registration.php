<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="Tim4" />
    <title>eGovernment :: Registracija</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/login-popup.css" rel="stylesheet" type="text/css" />    <!--css style from a login-popup form-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script> <!--script from a login-popup form-->


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/registration.css" rel="stylesheet" type="text/css" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">



</head>
<?php
session_start();
?>

<body onload="document.registration.reset();">

<div id="wrapper" >

<div id="header">

    <div id="header-up">

        <div id="header-logo">
            <a href="index.php"><img src="img/logo.png"></a>
        </div><!--header-logo-->

    </div><!--header-up-->

    <div id="header-down">

        <nav>
            <ul>
                <li><a href="index.php">Home</a> </li>
                <li><a href="newsList.php">Vijesti</a> </li>
            </ul>

        </nav><!--horizontal-menu-->

        <div id="search">
            <div id="search-down">
                <a href="search.php?id=<?php $string ?>"><div id="img-search" title="Pretraga">
                    </div></a><!--img-search-->

                <input type="text" name="search">


            </div>

        </div><!--search-->

    </div><!--header-down-->


</div><!--header--->

<div id="container">

    <div id="main-title">
        <label>Dobrodošli! Jeste li spremni za registraciju na e-Government?</label>
        <span>Molim Vas unesite točne informacije za uspješnu registraciju - polja sa (*) su obavezna</span>
    </div>

    <div id="main">

        <?php

        $nameErr = $emailErr = $lastnameErr = $usernameErr = $telephonErr= $passwordErr = $rpasswordErr =$genderErr= "";
        $name = $email = $lastname = $username = $telephon = $password = $rpassword = $gender=$address=$birthday="";


        if (isset($_POST['submit']))
        {
            if (empty($_POST["name"]))
            {$nameErr = "Molim Vas unesite Vaše Ime";}
            else
            {
                $name = test_input($_POST["name"]);

                if (!preg_match("/^[a-zA-ZČĆŠĐŽčćšđž ]*$/",$name))
                {
                    $nameErr = "Dozvoljena su samo slova i razmak";
                }
            }

            if (empty($_POST["lastname"]))
            {$lastnameErr = "Molim Vas unesite Vaše Prezime";}
            else
            {
                $lastname = test_input($_POST["lastname"]);

                if (!preg_match("/^[a-zA-ZČĆŠĐŽčćšđž ]*$/",$lastname))
                {
                    $lastnameErr = "Dozvoljena su samo slova i razmak";
                }
            }


            if (empty($_POST["username"]))
            {$usernameErr = "Molim Vas unesite Username";}
            else
            {
                $username = test_input($_POST["username"]);

            }


            if (empty($_POST["password"]))
            {$passwordErr = "Molim Vas unesite Lozinku";}
            else
            {
                $password = test_input($_POST["password"]);

            }


            if (empty($_POST["rpass"]))
            {
                $rpasswordErr = "Molim Vas unesite Potvrdu lozinke";
            }
            else if(test_input($_POST["rpass"]))
            {
                $password=$_POST["password"];
                $rpassword=$_POST["rpass"];
                if($rpassword!=$password){
                    $rpasswordErr = "Lozinke se ne podudaraju";
                }


            }



            if (empty($_POST["telephone"]))
            {$telephonErr = "Molim Vas unesite Telefon";}
            else
            {
                $telephon = test_input($_POST["telephone"]);

                if (!is_numeric($telephon))
                {
                    $telephonErr = "Dozvoljen je samo unos brojeva";
                }


            }


            if (empty($_POST["email"]))
            {$emailErr = "Molim Vas unesite E-mail adresu";}
            else
            {
                $email = test_input($_POST["email"]);

                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
                {
                    $emailErr = "Molim Vas unesite pravilno E-mail adresu";
                }

            }

            if(empty($_POST["gender"])){
                $genderErr="Odaberite spol";
            }
            else{
                $gender=test_input($_POST["gender"]);
            }
            $address=test_input($_POST["address"]);
            $birthday=test_input($_POST["bday"]);


        }



        if(isset($_POST['submit'])){
            if($nameErr=="" && $lastnameErr=="" && $usernameErr=="" && $passwordErr=="" &&  $rpasswordErr=="" && $emailErr=="" &&  $telephonErr=="" && $genderErr=="")
            include('register_proces.php');

        }


        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }



        ?>

        <div id="registration">


            <form name="registration" id="regform" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  >

                <table>
                    <tr> <td>Ime: *</td>              <td><input type="text" required name="name" value="<?php echo "$name"; ?>"></td>  <td>  <span class="error"> <?php echo $nameErr;?> </span> </td>  </tr>
                    <tr> <td>Prezime: *</td>          <td><input type="text" name="lastname" value="<?php echo $lastname; ?>" ></td>  <td> <span class="error"> <?php echo $lastnameErr;?> </span> </td> </tr>
                    <tr> <td>Username: *</td>         <td><input type="text" name="username" value="<?php echo "$username"; ?>" ></td> <td> <span class="error"> <?php echo $usernameErr;?> </span> </td> </tr>
                    <tr> <td>Lozinka: *</td>         <td><input type="password" name="password" value="<?php echo "$password"; ?>" ></td> <td> <span class="error"> <?php echo $passwordErr;?> </span> </td> </tr>
                    <tr> <td>Potrvda lozinke: *</td>  <td><input type="password" name="rpass" value="<?php echo "$rpassword"; ?>"></td>  <td> <span class="error"> <?php echo $rpasswordErr;?></span> </td></tr>
                    <tr> <td>E-mail: *</td>           <td><input type="text" name="email" value="<?php echo "$email"; ?>"></td> <td> <span class="error"> <?php echo $emailErr;?> </span> </td> </tr>
                    <tr> <td>Spol: *</td>             <td><input type="radio" name="gender" <?php if (isset($gender) && $gender=="M") echo "checked";?> value="M" >Muško   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Z") echo "checked";?> value="Z">Žensko</td> <td> <span class="error"> <?php echo $genderErr;?> </span> </td>  </tr>
                    <tr> <td>Datum rođenja:</td>    <td><input type="date" name="bday" value="<?php echo $birthday;?>"></td> </tr>
                    <tr> <td>Adresa:</td>           <td><input type="text" name="address" value="<?php echo $address;?>" ></td> <td></td> </tr>
                    <tr> <td>Telefon: *</td>          <td><input type="tel" name="telephone" value="<?php echo "$telephon"; ?>" placeholder="+38763123456"></td> <td > <span class="error">  <?php echo $telephonErr;?> </span></td> </tr>
                </table>

                <input type="submit" value="Registriraj se" name="submit" class="buttom" >


            </form>


        </div><!--registration-->

    </div><!--main-->



</div><!--container-->

<div id="footer">

    <div id="footer-up">

        <div id="footer-logo">
            <a href="index.php"><img src="img/logo.png"></a>
        </div><!--footer-logo-->

        <div id="icons">

            <a href="http://www.flickr.com/" target="_blank" > <img title="Flick" src="img/icon-fl.png"></a>
            <a href="https://twitter.com/" target="_blank">  <img src="img/icon-tw.png"></a>
            <a href="https://www.facebook.com/" target="_blank"> <img src="img/icon-fb.png"></a>
            <a href="http://www.google.ba" target="_blank"> <img src="img/icon-gp.png"></a>
            <a href="http://dribbble.com/" target="_blank"> <img src="img/icon-db.png"></a>
        </div><!--icons-->

    </div><!--footer-up-->

    <div id="footer-down">
        <p class="text">All design and content Copyright &copy; <span><?php echo date('Y');?></span>. All rights reserved.</p>
    </div><!--footer-down-->


</div><!---footer-->

</div><!--wrapper-->





</body>
</html>
