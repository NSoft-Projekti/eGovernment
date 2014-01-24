
<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="Tim4" />
    <title>eGovernment :: Profile</title>
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
                <a href="index.php"><img src="img/logo.png"></a>
            </div><!--header-logo-->


            <div id="reg-prijava">

                <?php


                    echo '<a title="prijava" href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                   // echo '<img class="logo" src="img/login-icon.png">';
                //echo '</br>';
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
                    <a href="search.php"><div id="img-search">
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
        $gender=$row['gender'];
        $image_path=$row['path'];
        $convert_date=date("d.m.Y",strtotime($bday));

        ?>

    <div id="column-left">

        <div id="cleft-picture">

            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="image"> <input type="submit" name="upload" value="Upload"><br>


            </form>

            <?php

            if(isset($_POST['upload'])){
                $image_name=$_FILES['image']['name'];
                $image_type=$_FILES['image']['type'];
                $image_size=$_FILES['image']['size'];
                $image_tmp_name=$_FILES['image']['tmp_name'];
                $path="upload_img/";

                $path=$path . $_FILES['image']['name'];


                if($image_name==''){

                    echo "Please select an Image";
                    exit();
                }
                else{
                    move_uploaded_file($image_tmp_name,$path);
                    echo "<script type='javascript'>alert('Uspjeh')</script>";
                   // echo"<img src='upload_img/$image_name'>";

                    mysql_query("UPDATE user SET path='$path' WHERE iduser='$iduser'");
                    //echo "<img src='".$row['path']."' />";

                }

            }

            ?>
            <img src="<?php echo"'".$row['path']."'"; ?>">


        </div> <!--cleft-picture-->

        <div id="cleft-data">

            <form action="" method="get">

           <table>
               <tr> <td>Ime:</td>       <td> <input  type="text" name="usr_name"  value=" <?php echo $firstname;?>">  </td>   </tr>
               <tr> <td>Prezime:</td>   <td> <input type="text" name="usr_lname" value=" <?php echo $lastname;?>">    </td>  </tr>
               <tr> <td>Username:</td>   <td> <input type="text" name="usr_usern" value=" <?php echo $username;?>">  </td> </tr>
               <tr> <td>E-mail:</td>     <td> <input type="text" name="usr_email" value=" <?php echo $email;?>">  </td>  </tr>
               <tr> <td>Datum rođenja:</td> <td> <input type="text" name="usr_bday" value=" <?php echo  $convert_date;?>">    </td> </tr>
               <tr> <td>Adresa:</td>     <td> <input type="text" name="usr_add" value=" <?php echo $address;?>">   </td> </tr>
               <tr> <td>Telefon:</td>    <td> <input type="tel" name="usr_tel" value=" <?php echo $telephone;?>">   </td></tr>

            </table>

            <input type="submit" name="submit" value="Izmjena podataka">

            </form>


<?php
if(isset($_GET['submit']))
{


    function test_input($data)
    {
        $data = trim($data);
        return $data;
    }


    $usr_name=test_input( $_GET['usr_name']);
    $usr_lname=test_input( $_GET['usr_lname']);
    $usr_usern=test_input( $_GET['usr_usern']);
    $usr_email=test_input( $_GET['usr_email']);
    $usr_bday=test_input( $_GET['usr_bday']);
    $usr_add=test_input( $_GET['usr_add']);
    $usr_tel=test_input($_GET['usr_tel']);
    $convert_bday=date("Y.m.d",strtotime($usr_bday));

            $query2 = "UPDATE user SET name='$usr_name',lastname='$usr_lname',username='$usr_usern',email='$usr_email',date_of_birth='$convert_bday',address='$usr_add',telephone='$usr_tel'
    WHERE iduser='$iduser'";

            $result2 = mysql_query ( $query2 ) or die ( "Query Failed : " . mysql_error () );

            if($query2){
                echo "<script type='text/javascript'>alert('Uspješna promjena');</script>";

            }
            else{
                echo "<script type='text/javascript'>alert('Greska');</script>";

            }

            echo "<script type='text/javascript'>window.location.href='profile.php'</script>";

}

?>


        </div> <!--cleft-data-->

    </div> <!--column-left-->

        <div id="column-right">
            <ul>
                <li> <a href="myNews.php">Moje vijesti</a> </li>
                <li> <a href="mySuggestion.php">Moji prijedlozi</a> </li>
                <li> <a href="myComment.php">Moji komentari</a> </li>

            </ul>


        </div> <!--column-right-->



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