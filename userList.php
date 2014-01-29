<?php
/**
 * Created by PhpStorm.
 * User: Darija
 * Date: 22.01.14.
 * Time: 15:52
 */
?>

<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="Tim4" />
    <title>eGovernment :: Korisnici</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css" />
    <link href="style/userList.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">


</head>

<?php
include('connect.php');
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

            //includes login popup form
            else {
                include_once("loginPopup.php");
                echo'<a title="registracija" href="registration.php">Registracija</a>';
            }
            ?>

        </div><!--reg-prijava-->
    </div><!--header-up-->

    <div id="header-down">

        <div id="horizontal-menu">
            <ul>
                <li><a href="index.php">Home</a> </li>
                <li><a href="newsList.php">Vijesti</a> </li>
                <?php

                if(isset ($_SESSION['SESS_MEMBER_ID'])){
                    echo'<li><a href="suggestionList.php" id="category" >Prijedlozi</a>
                        <ul id="ulCategory" class="hide">';

                    $sqlCat = "SELECT idcategory, name FROM category WHERE idcategory != '1'";
                    $resultCat=mysql_query($sqlCat, $conn);
                    while($rowCat = mysql_fetch_assoc($resultCat))
                    {
                        echo '<li>';
                        echo '<a href="suggestionList.php?id='.$rowCat['idcategory'].'"  id="liCategory" class="hide">'.$rowCat["name"].'</a>';
                        echo '<ul id="ulSubcategory" class="hide">';
                        $idCat = $rowCat['idcategory'];
                        $sqlSub = "SELECT idsubcategory, name FROM subcategory WHERE name != 'Vijest' AND subcategory.idcategory = $idCat";
                        $resultSub=mysql_query($sqlSub, $conn);
                        while($rowSub = mysql_fetch_assoc($resultSub))
                        {
                            echo '<li >';
                            echo '<a href="suggestionList.php?id='.$rowSub['idsubcategory'].'" id="liSubcategory" class="hide">'.$rowSub["name"].'</a>>';
                            echo '</li>';
                        }
                        echo '</ul>';
                        echo '</li>';
                    }

                    echo '</ul>
                        </li>';
                    echo '<li><a href="decisionList.php">Odluke</a> </li>';
                    echo '<li><a href="userList.php" class="currentTab">Korisnici</a> </li>';
                }

                ?>


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
<div class="post">

    <div class="right-title"><h2>Popis registriranih korisnika</h2></div>
    <?php

    // find out how many rows are in the table
    $sql = "SELECT name FROM user inner join user_group on user.iduser=user_group.iduser WHERE user_group.idgroup='3'";
    $result = mysql_query($sql);
    $r = mysql_num_rows($result);

    // number of rows to show per page
    $rowsperpage = 17;
    // find out total pages
    $totalpages = ceil($r / $rowsperpage);


    // get the current page or set a default
    if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
        // cast var as int
        $currentpage = (int) $_GET['currentpage'];
    } else {
        // default page num
        $currentpage = 1;
    } // end if

    // if current page is greater than total pages...
    if ($currentpage > $totalpages) {
        // set current page to last page
        $currentpage = $totalpages;
    } // end if
    // if current page is less than first page...
    if ($currentpage < 1) {
        // set current page to first page
        $currentpage = 1;
    } // end if

    // the offset of the list, based on current page
    $offset = ($currentpage - 1) * $rowsperpage;

    // get the info from the db
    $sql = "SELECT * FROM user inner join user_group on user.iduser=user_group.iduser WHERE user_group.idgroup='3' ORDER BY name LIMIT $offset, $rowsperpage";
    $result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);

    // while there are rows to be fetched...
    while ($row = mysql_fetch_assoc($result)) {
        $iduser=$row['iduser'];

//      getting name and surname of the registered users and linking them to the proper profile views
        echo "<h3><a class='user_link' href='profileView.php?id= " . $iduser . "'>" . $row['name'] ." " . $row ['lastname'] . "</a></h3>";
    } // end while

    echo"<br>";

    /******  build the pagination links ******/
    // range of num links to show
    $range = 3;

    // if not on page 1, don't show back links
    if ($currentpage > 1) {
        // show << link to go back to page 1
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
        // get previous page num
        $prevpage = $currentpage - 1;
        // show < link to go back to 1 page
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
    } // end if

    // loop to show links to range of pages around current page
    for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
        // if it's a valid page number...
        if (($x > 0) && ($x <= $totalpages)) {
            // if we're on current page...
            if ($x == $currentpage) {
                // 'highlight' it but don't make a link
                echo " [<b>$x</b>] ";
                // if not current page...
            } else {
                // make it a link
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
            } // end else
        } // end if
    } // end for

    // if not on last page, show forward and last page links
    if ($currentpage != $totalpages) {
        // get next page
        $nextpage = $currentpage + 1;
        // echo forward link for next page
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
        // echo forward link for lastpage
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
    } // end if
    /****** end build pagination links ******/
    /******  build the pagination links ******/
    // if not on page 1, don't show back links
    if ($currentpage > 1) {
        // show << link to go back to page 1
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
        // get previous page num
        $prevpage = $currentpage - 1;
        // show < link to go back to 1 page
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
    } // end if
    ?>

</div>

</div><!--container-->

</br>


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
        <p class="text">All design and content Copyright &copy; 2013<span id="year"></span>. All rights reserved.</p>
    </div><!--footer-down-->


</div><!---footer-->



</div><!--wrapper-->


<script src="dropDownMenu.js" type="text/javascript"></script>
</body>

</html>