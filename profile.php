
<html>
<head>
    <meta name="description" content="Design Android applications" />
    <meta name="keywords" content="android, design, technics" />
    <meta name="author" content="Jelena" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/profile.css" rel="stylesheet" type="text/css" />
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
                <h1>LOGO STRANICE</h1>
            </div><!--header-logo-->


            <div id="reg-prijava">

                <?php


                    echo '<a title="prijava" href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                    echo '<img class="logo" src="img/login-icon.png">';
                echo '</br>';
                echo'<a title="odjava" href="logout.php">Odjava</a>';

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
                    <li><a href="#footer">Korisnici</a> </li>

                </ul>

            </div><!--horizontal-menu-->

            <div id="search">
                <div id="search-down">
                    <a href="#"><div id="img-search">
                    </div></a><!--img-search-->

                    <input type="text" name="search" >


                </div>

            </div><!--search-->

        </div><!--header-down-->


    </div><!--header--->

    <div id="container">
        <?php

        $iduser=$_SESSION['SESS_MEMBER_ID'];



        $result=mysql_query( "SELECT * FROM user WHERE iduser=$iduser ");
        $row=mysql_fetch_array($result);

        $firstname=$row['name'];
        $lastname=$row['lastname'];
        $username=$row['username'];
        $email=$row['email'];
        $bday=$row['date_of_birth'];
        $address=$row['address'];
        $telephone=$row['telephone'];
        $convert_date=date("d.m.Y",strtotime($bday));

        if(isset($_POST['submit']))
        {

            $usr_name=$_POST['usr_name'];
            $usr_lname=$_POST['usr_lname'];
            $usr_usern=$_POST['usr_usern'];
            $usr_email=$_POST['usr_email'];
            $usr_bday=$_POST['usr_bday'];
            $usr_add=$_POST['usr_add'];
            $usr_tel=$_POST['usr_tel'];

            $updatesql =mysql_query( "UPDATE user".
                "SET name =  $usr_name ,lastname=$usr_lname,username=$usr_usern,email=$usr_email,date_of_birth=$usr_bday,address=$usr_add,telephone=$usr_tel".
                "WHERE iduser= $iduser") ;

            $retval = mysql_query( $updatesql, $conn );
            if(! $retval )
            {
                die('Could not update data: ' . mysql_error());
            }
            echo "Updated data successfully\n";



            if($updatesql){

            echo "<script type='text/javascript'>alert('Uspjeh');</script>";
            }
            else{
                echo "error";
            }

        }



        ?>

    <div id="column-left">
        <div id="cleft-picture">

        </div> <!--cleft-picture-->

        <div id="cleft-data">


            <form action="" method="post">

           <table>
               <tr> <td>Ime:</td>       <td> <input  type="text" name="usr_name"  value=" <?php echo $firstname;?>">  </td> </tr>
               <tr> <td>Prezime:</td>   <td> <input type="text" name="usr_lname" value=" <?php echo $lastname;?>">      </td> </tr>
               <tr> <td>Username:</td>   <td> <input type="text" name="usr_usern" value=" <?php echo $username;?>">  </td> </tr>
               <tr> <td>E-mail:</td>     <td> <input type="text" name="usr_email" value=" <?php echo $email;?>">  </td> </tr>
               <tr> <td>Datum rođenja:</td> <td> <input type="text" name="usr_bday" value=" <?php echo $convert_date;?>">    </td> </tr>
               <tr> <td>Adresa:</td>     <td> <input type="text" name="usr_add" value=" <?php echo $address;?>">   </td> </tr>
               <tr> <td>Telefon:</td>    <td> <input type="tel" name="usr_tel" value=" <?php echo $telephone;?>">   </td> </tr>

            </table>

            <input type="submit" name="submit" value="Izmjena podataka">

            </form>






        </div> <!--cleft-data-->

    </div> <!--column-left-->

        <div id="column-right">
            <ul>
                <li> <a href="">Moje vijesti</a> </li>
                <li> <a href="">Moji prijedlozi</a> </li>
                <li> <a href="">Moji komentari</a> </li>

            </ul>


        </div> <!--column-right-->



    </div><!--container-->

    <div id="footer">

        <div id="footer-up">

            <div id="footer-logo">
                <h1>LOGO</h1>
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