<?php
/**
 * Created by PhpStorm.
 * User: Darija
 * Date: 28.01.14.
 * Time: 22:15
 */
?>
<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="tim4" />
    <title>eGovernment :: Komentari</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/profile.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css" />


</head>
<?php
include 'connect.php';
session_start();
if(!isset ($_SESSION['SESS_MEMBER_ID']))
{
    header("location: index.php");
}
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
                <li><a href="index.php">Home</a></li>
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
        </nav><!--horizontal-menu--><!--horizontal-menu-->

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

    <div id="column-left">
        <div class="user_post">

            <?php
            $iduser=$_GET['id'];
            // find out how many rows are in the table
            $sql = "SELECT comment.content , comment.date_time, post.content
             FROM comment inner join post on comment.idpost = post.idpost WHERE comment.iduser=$iduser";
            $result = mysql_query($sql);
            $r = mysql_num_rows($result);

            // number of rows to show per page
            $rowsperpage = 7;
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

            $sql = mysql_query("SELECT comment.content , comment.date_time,comment.idpost ,post.title FROM comment inner join post on comment.idpost = post.idpost
            WHERE comment.iduser=$iduser");
            if(mysql_num_rows($sql) > 0){

                while($row2 = mysql_fetch_array($sql)){
                    $idpost=$row2["idpost"];

                    echo '<span class="posttitle"><a href="newsDetails.php?id='.$idpost.'">'.$row2["title"].'</span></a></br>';

                    echo '<span class="usercomment">'.$row2["content"].'</span></br>';
                    echo '<span>'.$row2["date_time"].'</span></br></br>';
                }}
            else{
                echo 'Još nista niste komentirali';
            }

            /******  build the pagination links ******/
            // range of num links to show
            echo"<div id='pagination'>";
            $range = 3;

            // if not on page 1, don't show back links
            if ($currentpage > 1) {
                // show << link to go back to page 1
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1' id='ff-prev'></a> ";
                // get previous page num
                $prevpage = $currentpage - 1;
                // show < link to go back to 1 page
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'  id='previous'></a> ";
            } // end if

            // loop to show links to range of pages around current page
            for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                // if it's a valid page number...
                if (($x > 0) && ($x <= $totalpages)) {
                    // if we're on current page...
                    if ($x == $currentpage) {
                        // 'highlight' it but don't make a link
                        echo "<a href='#' class='blue'>$x</a> ";
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
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage' id='next'></a> ";
                // echo forward link for lastpage
                echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages' id='ff-next' ></a> ";
            } // end if
            /****** end build pagination links ******/
            /******  build the pagination links ******/
            // if not on page 1, don't show back links

            echo "</div><!--pagination-->";
            ?>




        </div> <!--cleft-data-->

    </div> <!--column-left-->

    <div id="column-right">
        <ul>
            <li> <a href="userNews.php?id=<?php echo $iduser;?>">Korisničke vijesti</a> </li>
            <li> <a href="userSuggestion.php?id=<?php echo $iduser;?>">Korisnički prijedlozi</a> </li>
            <li> <a href="userComment.php?id=<?php echo $iduser;?>">Korisnički komentari</a> </li>

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
        <p class="text">All design and content Copyright &copy; <span><?php echo date('Y');?></span>. All rights reserved.</p>
    </div><!--footer-down-->


</div><!---footer-->

</div><!--wrapper-->





</body>
</html>
