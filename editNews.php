<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="author" content="Ajda" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/addNews.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css">

    <meta charset="utf-8">

    <link href="style/login-popup.css" rel="stylesheet" type="text/css" />    <!--css style from a login-popup form-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script> <!--script from a login-popup form-->

</head>

<?php
include "connect.php";
session_start();
if(!isset ($_SESSION['SESS_MEMBER_ID']))
{
    header("location: index.php");
}
$idpost = $_GET['id'];
?>
<body>

<?php require_once('loginPopup.php'); ?>


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
                    $iduser=$_SESSION['SESS_MEMBER_ID'];
                    $result=mysql_query("SELECT gender, iduser FROM user WHERE user.iduser='$iduser' ");
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
                //includes login popup form
                else {
                    echo '<a class="login-window" href="#loginPopup.php">Prijava</a>';
                    echo'<a title="registracija" href="registration.php">Registracija</a>';
                }
                ?>

            </div><!--reg-prijava-->



        </div><!--header-up-->

        <div id="header-down">

            <nav>
                <ul>
                    <li><a href="index.php">Home</a> </li>
                    <li  class="currentTab"><a href="newsList.php"">Vijesti</a> </li>
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
                                echo '<a href="suggestionListBySub.php?id='.$rowSub['idsubcatagory'].'">'.$rowSub["name"].'</a>';
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
                        <li><a href="userList.php">Korisnici</a></li>
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

        <div class="news_container">
            <div id="title">
                <form name="editNews" action="editNewsStore.php" method="post">
                    <?php
                    $sql = mysql_query("SELECT * FROM post WHERE post.idpost = $idpost");
                    while($row = mysql_fetch_assoc($sql))
                    {
                        $title = $row['title'];
                        $content = $row['content'];
                        $summary = $row['summary'];

                        echo '<label >Unesite naslov vijesti: </label><br>';
                        echo '<input type="text" name="title" id="inputTitle" value="'.$title.'"/>';
                        echo '</div>';
                        echo '<div id="content">';
                        echo '<label>Unesite sadržaj vijesti: </label>';
                        echo '<textarea name="content" id="inputContent">'.$content.'</textarea>';
                        echo '</div>';
                        echo '<div id="summary">';
                        echo '<label>Unesite kratki opis vijesti: </label>';
                        echo '<textarea name="summary" id="inputSummary">'.$summary.'</textarea>';
                        echo '</div>';
                        echo '<div id="attachment">';
                        echo '<label>Attachment</label>';
                        echo '<input type="file" name="file" id="file">';
                        echo '</div>';
                        echo '<hr>';
                        echo '<input type="hidden" name="idpost" value="'.$idpost.'">';
                        echo '<input type="submit" name="button" value="Spasi" class="button" />';
            }
            ?>
            </form>



        </div><!--news_container-->



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
