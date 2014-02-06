 <html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="Tim4" />
    <title>eGovernment :: Vijesti</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <link href="style/login-popup.css" rel="stylesheet" type="text/css" />    <!--css style from a login-popup form-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script> <!--script from a login-popup form-->
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
                    $iduser=$_SESSION['SESS_MEMBER_ID'];
                    $result=mysql_query("SELECT gender, iduser FROM user WHERE user.iduser='$iduser' ");
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
                    <li><a href="newsList.php" class="currentTab">Vijesti</a> </li>
                    <?php

                    if(isset ($_SESSION['SESS_MEMBER_ID'])){
                        echo'<li><a href="suggestionList.php">Prijedlozi</a> </li>';
                        echo '<li><a href="decisionList.php">Odluke</a> </li>';
                        echo '<li><a href="userList.php">Korisnici</a> </li>';
                    }

                    ?>

                </ul>

            </div><!--horizontal-menu-->

            <div id="search">
                <div id="search-down">

                    <a href="search.php?id=<?php $string ?>"><div id="img-search">
                    </div></a><!--img-search-->

                    <input type="text">


                </div>

            </div><!--search-->

        </div><!--header-down-->


    </div><!--header--->


    <div id="container">
        <div class="post">

            <div class="right-title">
                <h2>Vijesti
                    <?php
                    if(isset ($_SESSION['SESS_MEMBER_ID'])){
                        $iduserLog = $_SESSION['SESS_MEMBER_ID'];
                        $query1 = mysql_query("SELECT iduser, idgroup FROM user where iduser like $iduserLog");
                        while($rowLog = mysql_fetch_array($query1)){
                            if($rowLog['idgroup'] == '1'){
                                echo ' <a href="addNews.php"><input type="submit" name="button" value="Dodaj" class="button_vijest"></a>';
                            }
                        }
                    }
                    ?>
                </h2>
            </div>

            <?php

            // find out how many rows are in the table
            $sql = "SELECT * FROM post inner join user on post.iduser = user.iduser
             WHERE POST.idpost_type='1'";
            $result = mysql_query($sql);
            $r = mysql_num_rows($result);

            // number of rows to show per page
            $rowsperpage = 3;
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
            $sql = "SELECT * FROM post inner join user on post.iduser = user.iduser
             WHERE POST.idpost_type='1' ORDER BY post.date_time DESC LIMIT $offset, $rowsperpage";
            $result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);

            // while there are rows to be fetched...

            while ($row = mysql_fetch_assoc($result)) {
                $idpost=$row['idpost'];
                $iduser = $row['iduser'];
                echo '<h2 id="title"><a href="newsDetails.php?id='.$idpost.'">'.$row["title"].'</a></h2>';
                echo '<p class="meta"><span class="date">'.$row["date_time"].'</span></p>';
                echo '<p><span class="posted">postavio/la <a class="user_link" href="profileView.php?id='.$iduser.' ">'.$row["username"].'</a></span></p>';
                echo ' <div class="entry"><p>'.$row["summary"].'</p></div>';
                echo '<p class="links"><a href="newsDetails.php?id='.$idpost.'" class="right">Pročitaj više</a></p></br>';
                if(isset ($_SESSION['SESS_MEMBER_ID'])){
                    $iduserLog = $_SESSION['SESS_MEMBER_ID'];
                    $query1 = mysql_query("SELECT iduser, idgroup FROM user where iduser like $iduserLog");
                    while($rowLog = mysql_fetch_array($query1)){
                        if($rowLog['idgroup'] == '1'){
                            echo '<a href="editNews.php?id='.$idpost.'"<input type="submit" name="button" value="Izmijeni" class="button_vijest" style="float:none">Izmijeni<a/>';
                        }
                    }
                }
            } // end while
echo '<br>';
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
