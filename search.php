<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="Tim4" />
    <title>eGovernment :: Pretraga</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css" />
    <link href="style/search.css" rel="stylesheet" type="text/css">
    <link href="style/login-popup.css" rel="stylesheet" type="text/css" />    <!--css style from a login-popup form-->
    <script src="jq.js" type="text/javascript"></script> <!--script from a login-popup form-->

    <meta charset="utf-8">

</head>

<?php
include('connect.php');
session_start();
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
                    $sesija=$_SESSION['SESS_MEMBER_ID'];
                    $result=mysql_query("SELECT iduser, gender FROM user WHERE user.iduser='$sesija' ");
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
                    <li class="currentTab"><a href="index.php">Home</a></li>
                    <li><a href="newsList.php">Vijesti</a></li>
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
                        <li><a href="userList.php">Korisnici</a></li>
                    <?php }
                    ?>


                </ul>
            </nav><!--horizontal menu-->

            <div id="search">
                <div id="search-down">
                    <form method="post" action="search.php">
                        <input type="submit" id="img-search" value="">
                        <input type="text" name="searchquery" >

                    </form>


                </div>

            </div><!--search-->

        </div><!--header-down-->


    </div><!--header--->


    <div id="container">
        <div id="searching">

            <?php

            error_reporting(E_ALL);
            ini_set('display_errors', '1');
            $search_output = "";
            if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
                $searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']);

                $searchquery=$_POST['searchquery'];
                $sqlCommand=("SELECT * FROM post WHERE (`title` LIKE '%$searchquery%' ) OR (`content` LIKE '%$searchquery%' )");
                $query = mysql_query($sqlCommand) or die(mysql_error());
                $count = mysql_num_rows($query);
                if($count > 1){
                    $search_output .= "<hr />$count results for <strong>$searchquery</strong><hr /><hr />";
                    while($row = mysql_fetch_array($query)){

                        $idpost = $row["idpost"];
                        $title = $row["title"];
                        $search_output .= "<a href='newsDetails.php?id=$idpost'>$title</a><br />";

                    } // close while
                } else {
                    $search_output = "<hr />0 results for <strong> $searchquery</strong><hr />";
                }
            }



            ?>

            <div>
                <?php echo $search_output; ?>
            </div>


        </div>


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
