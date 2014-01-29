<?php
/**
 * Created by PhpStorm.
 * User: Darija
 * Date: 24.01.14.
 * Time: 12:02
 */
?>

<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="Tim4" />
    <title>eGovernment :: Profil</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/profile.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css"/>
</head>
<?php
include 'connect.php';
session_start();
?>
<body>
<div id="wrapper" >

<div id="header">

    <div id="header-up">

        <div id="header-logo">
            <a href="index.php"><img src="img/logo.png"></a>
        </div><!--header-logo-->


        <div id="reg-prijava">

            <?php


            if(isset ($_SESSION['SESS_MEMBER_ID'])){
                $sesija=$_SESSION['SESS_MEMBER_ID'];
                $result=mysql_query("SELECT * FROM user WHERE user.iduser='$sesija' ");
                $row=mysql_fetch_assoc($result);
                $gender=$row["gender"];

                //checking gender and displaying matching picture
                if($gender=='M'){
                    echo '<a title="prijava" href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                    echo '<img class="logo" src="img/men.png">';
                    echo '</br>';
                    echo'<a title="odjava" href="logout.php">Odjava</a>';
                }

                //if it's not male gender, it displays female image
                else {
                    echo '<a title="prijava" href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                    echo '<img class="logo" src="img/girl.png">';
                    echo '</br>';
                    echo'<a title="odjava" href="logout.php">Odjava</a>';
                }
            }

            ?>


        </div><!--reg-prijava-->



    </div><!--header-up-->

    <div id="header-down">

        <div id="horizontal-menu">
            <ul>
                <li><a href="index.php">Home</a> </li>
                <li><a href="newsList.php">Vijesti</a> </li>
                <li><a href="suggestionList.php">Prijedlozi</a> </li>
                <li><a href="decisionList.php">Odluke</a> </li>
                <li><a href="userList.php" class="currentTab">Korisnici</a> </li>

            </ul>

        </div><!--horizontal-menu-->

        <div id="search">
            <div id="search-down">
                <a href="search.php"><div id="img-search">
                    </div></a><!--img-search-->

                <input type="text" name="search" >


            </div>

        </div><!--search-->

    </div><!--header-down-->


</div><!--header--->

<div id="container">
    <?php

    $iduser=$_GET ['id'];



    $result=mysql_query( "SELECT * FROM user WHERE iduser=$iduser ");
    $row=mysql_fetch_array($result);

    $firstname=$row['name'];
    $lastname=$row['lastname'];
    $username=$row['username'];
    $email=$row['email'];
    $gender=$row['gender'];


    ?>

    <div id="column-left">
        <div id="cleft-picture">
            <?php
            if($gender=='M'){
                echo "<img src='img/male.png'>";
            }
            else{
                echo"<img src='img/female.png'>";

            }
            ?>

        </div> <!--cleft-picture-->

        <div id="cleft-data">

            <form action="" method="get">

                <table>
                    <tr> <td>Ime:</td>       <td> <?php echo $firstname;?> </td> </tr>
                    <tr> <td>Prezime:</td>   <td> <?php echo $lastname;?> </td> </tr>
                    <tr> <td>Username:</td>   <td> <?php echo $username;?> </td> </tr>
                    <tr> <td>E-mail:</td>     <td> <?php echo $email;?>  </td> </tr>

                </table>

            </form>


        </div> <!--cleft-data-->

    </div> <!--column-left-->

    <div id="column-right">
        <ul>
            <li> <a href="myNews.php?id=<?php echo $iduser;?>">Korisničke vijesti</a> </li>
         <li> <a href="mySuggestion.php?id=<?php echo $iduser;?>">Korisnikčke prijedlozi</a> </li>
          <li> <a href="myComment.php?id=<?php echo $iduser;?>">Korisničke komentari</a> </li>

     </ul>


    </div>
    <!--column-right-->



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
        <p class="text">All design and content Copyright &copy; 2013.<span id="year"></span>. All rights reserved.</p>
    </div><!--footer-down-->


</div><!---footer-->

</div><!--wrapper-->




</body>
</html>