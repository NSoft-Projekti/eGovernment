<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="Tim4" />
    <title>eGovernment :: Profile</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css" />
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

            //checks if user is logged in
            if(isset ($_SESSION['SESS_MEMBER_ID'])){
                $sesija=$_SESSION['SESS_MEMBER_ID'];
                $result=mysql_query("SELECT iduser, gender FROM user WHERE user.iduser='$sesija' ");
                $row=mysql_fetch_assoc($result);
                $gender=$row["gender"];

                //checking gender and displaying matching picture
                if($gender=='M'){
                    echo '<a href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                    echo '<img class="logo" src="img/men.png">';
                    echo '</br>';
                    echo'<a href="logout.php">Odjava</a>';
                }

                //if it's not male gender, it displays female image
                else {
                    echo '<a href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                    echo '<img class="logo" src="img/girl.png">';
                    echo '</br>';
                    echo'<a href="logout.php">Odjava</a>';
                }
            }

            ?>


        </div><!--reg-prijava-->



    </div><!--header-up-->

    <div id="header-down">

        <nav>
            <ul>
                <li><a href="index.php">Home</a> </li>
                <li><a href="newsList.php">Vijesti</a> </li>
                <?php

                if(isset ($_SESSION['SESS_MEMBER_ID'])){
                    echo'<li><a href="suggestionList.php">Prijedlozi</a>';
                    echo'<ul>';

                    $sqlCat = "SELECT idcategory, name FROM category WHERE idcategory != '1'";
                    $resultCat=mysql_query($sqlCat, $conn);
                    while($rowCat = mysql_fetch_assoc($resultCat)){
                        echo '<li>';
                        echo '<a href="suggestionList.php?id='.$rowCat['idcategory'].'">'.$rowCat["name"].'</a>';
                        echo '<ul>';

                        $idcategory = $rowCat['idcategory'];
                        $sqlSub = "SELECT idcategory,idsubcategory, name FROM subcategory WHERE idcategory = $idcategory";
                        $resSub=mysql_query($sqlSub, $conn);
                        while($rowSub =mysql_fetch_assoc ($resSub)){
                            echo '<li>';
                            echo '<a href="suggestionListBySub.php?id='.$rowSub['idsubcategory'].'">'.$rowSub["name"].'</a>';
                            echo '</li>';
                        }
                        echo '<li>';
                        echo '<a href="addSubcategory.php">+ Nova potkategorija</a>';
                        echo '</li>';
                        echo '<li>';
                        echo '<a href="addSuggestion.php">+ Novi prijedlog</a>';
                        echo '</li>';

                        echo '</ul>';

                        echo '</li>';}
                    ?>

                    <?php echo'</ul>';?>
                    <?php echo'</li>';?>

                    <li><a href="decisionList.php">Odluke</a></li>
                    <li class="currentTab"><a href="userList.php">Korisnici</a></li>
                <?php }
                ?>

            </ul>

        </nav><!--horizontal-menu-->

        <div id="search">
            <div id="search-down">
                <a href="search.php?id=<?php $string ?>"><div id="img-search">
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
    $convert_date=date("d.m.Y",strtotime($bday));

    ?>

    <div id="column-left">

        <div id="cleft-picture">

            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="image" accept="image/*">
                <input type="submit" name="upload" value="Upload"><br>


            </form>

            <?php


            if(isset($_POST['upload'])){
                $image_name=$_FILES['image']['name'];
                $image_type=$_FILES['image']['type'];
                $image_size=$_FILES['image']['size'];
                $image_tmp_name=$_FILES['image']['tmp_name'];
                $path="img/";

                $path=$path . $_FILES['image']['name'];

                $allowedExts = array("gif", "jpeg", "jpg", "png");
                $temp = explode(".", $_FILES["image"]["name"]);
                $extension = end($temp);


                if ((($_FILES["image"]["type"] == "image/gif")
                        || ($_FILES["image"]["type"] == "image/jpeg")
                        || ($_FILES["image"]["type"] == "image/jpg")
                        || ($_FILES["image"]["type"] == "image/pjpeg")
                        || ($_FILES["image"]["type"] == "image/x-png")
                        || ($_FILES["image"]["type"] == "image/png"))
                    && ($_FILES["image"]["size"] < 20000)
                    && in_array($extension, $allowedExts)){

                    if($image_name==''){

                        echo "Please select an Image";
                        exit();
                    }
                    else{
                        move_uploaded_file($image_tmp_name,$path);

                        mysql_query("update user set path='$path' where iduser='$iduser'");

                    }
                    echo "<script type='text/javascript'>window.location.href='profile.php'</script>";

                }

            }


            ?>

            <img src="<?php echo $row['path']; ?>">


        </div> <!--cleft-picture-->

        <div id="cleft-data">

            <form action="" method="get">

                <table>
                    <tr> <td>Ime:</td> <td> <input type="text" name="usr_name" value=" <?php echo $firstname;?>"> </td> </tr>
                    <tr> <td>Prezime:</td> <td> <input type="text" name="usr_lname" value=" <?php echo $lastname;?>"> </td> </tr>
                    <tr> <td>Username:</td> <td> <input type="text" name="usr_usern" value=" <?php echo $username;?>"> </td> </tr>
                    <tr> <td>E-mail:</td> <td> <input type="text" name="usr_email" value=" <?php echo $email;?>"> </td> </tr>
                    <tr> <td>Datum rođenja:</td> <td> <input type="text" name="usr_bday" value=" <?php echo $convert_date;?>"> </td> </tr>
                    <tr> <td>Adresa:</td> <td> <input type="text" name="usr_add" value=" <?php echo $address;?>"> </td> </tr>
                    <tr> <td>Telefon:</td> <td> <input type="tel" name="usr_tel" value=" <?php echo $telephone;?>"> </td></tr>

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
            <li> <a href="myNews.php?id=<?php echo $iduser;?>">Moje vijesti</a> </li>
            <li> <a href="mySuggestion.php?id=<?php echo $iduser;?>">Moji prijedlozi</a> </li>
            <li> <a href="myComment.php?id=<?php echo $iduser;?>">Moji komentari</a> </li>

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
            <a href="https://twitter.com/" target="_blank"> <img src="img/icon-tw.png"></a>
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
