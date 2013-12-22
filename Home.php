<html>
<head>
    <meta name="description" content="Design Android applications" />
    <meta name="keywords" content="android, design, technics" />
    <meta name="author" content="Jelena" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="css/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="css/HomeStyle.css" rel="stylesheet" type="text/css" />
    <link href="css/postList.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
</head>

<?php
$username = "root";
$password = "mojapraksa";
$hostname = "pip.intera.ba:13306";

//connection to the database
$conn = mysql_connect($hostname, $username, $password)
or die("Unable to connect to MySQL");
?>
<?php
//select a database to work with
$db = mysql_select_db("tim4",$conn)
or die("Could not select tim4");
?>

<body>
<div id="wrapper" >

    <div id="header">

        <div id="header-up">

            <div id="header-logo">
                <h1>LOGO STRANICE</h1>
            </div><!--header-logo-->


            <div id="reg-prijava">

                <a title="prijava" href="login-popup.php">Prijava</a>

                <a title="registracija" href="Registration.php">Registracija</a>


            </div><!--reg-prijava-->



        </div><!--header-up-->

        <div id="header-down">

            <div id="horizontal-menu">
                <ul>
                    <li><a href="#footer" class="currentTab">Home</a> </li>
                    <li><a href="#footer">Vijesti</a> </li>


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
        <div class="post">

            <?php

            // find out how many rows are in the table
            $sql = "SELECT * FROM post inner join user on post.user_iduser = user.iduser
             WHERE POST.post_type_idpost_type='1'";
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
            $sql = "SELECT * FROM post inner join user on post.user_iduser = user.iduser
             WHERE POST.post_type_idpost_type='1' LIMIT $offset, $rowsperpage";
            $result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);

            // while there are rows to be fetched...
            while ($row = mysql_fetch_assoc($result)) {
                echo '<h2 id="title"><a href="newsDetails.php">'.$row["title"].'</a></h2>';
                echo '<p class="meta"><span class="date">'.$row["date_time"].'</span></p>';
                echo '<p><span class="posted">postavio/la <a href="#">'.$row["username"].'</a></span></p>';
                echo ' <div class="entry"><p>'.$row["summary"].'</p></div>';
                echo '<p class="links"><a href="newsDetails.php" class="right">Pročitaj više</a></p></br>';
            } // end while

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
            <p class="text">All design and content Copyright &copy; 2013<span id="year"></span>. All rights reserved.</p>
        </div><!--footer-down-->


    </div><!---footer-->



</div><!--wrapper-->



</body>
</html>