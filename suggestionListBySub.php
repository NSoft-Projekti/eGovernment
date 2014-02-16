<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="Tim4" />
    <title>eGovernment :: Prijedlozi</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
</head>

<?php
include('connect.php');
session_start();
if(!isset ($_SESSION['SESS_MEMBER_ID']))
{
    header("location: index.php");
}
$idsubcategory = $_GET['id'];
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
                $result=mysql_query("SELECT gender, iduser FROM user WHERE user.iduser='$sesija' ");
                $row=mysql_fetch_assoc($result);
                $gender=$row["gender"];

                //checking gender and displaying matching picture
                if($gender=='M'){
                    echo '<a title="prijava" href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                    echo '<img class="logo" src="img/men.png">';
                    echo '</br>';
                    echo '<a title="odjava" href="logout.php">Odjava</a>';
                }

                //if it's not male gender, it displays female image
                else {
                    echo '<a title="prijava" href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                    echo '<img class="logo" src="img/girl.png">';
                    echo '</br>';
                    echo '<a title="odjava" href="logout.php">Odjava</a>';
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
                <?php

                if(isset ($_SESSION['SESS_MEMBER_ID'])){
                echo'<li><a href="suggestionList.php" id="category" >Prijedlozi</a>
                        <ul id="ulCategoryIzgradnja" class="hide">';

                $sqlCat = "SELECT idcategory, name FROM category WHERE idcategory != '1'";
                $resultCat=mysql_query($sqlCat, $conn);
                while($rowCat = mysql_fetch_assoc($resultCat)){

                    echo '<li id="liCategoryIzgradnja">';
                    echo '<a href="suggestionList.php?id='.$rowCat['idcategory'].'"  id="aCategoryIzgradnja" class="show">'.$rowCat["name"].'</a>';
                    $sqlSub = "SELECT idsubcategory, name, idcategory, startDate FROM subcategory WHERE name != 'Vijest' and idcategory = 2 ORDER BY startDate DESC";
                    $resultSub=mysql_query($sqlSub, $conn);
                    echo '<ul id="ulSubcategoryIzgradnja" class="hide">';
                    while($rowSub = mysql_fetch_assoc($resultSub)){

                        echo '<li id="liSubcategoryIzgradnja">';
                        echo '<a href="suggestionListBySub.php?id='.$rowSub['idsubcategory'].'" id="aSubcategoryIzgradnja">'.$rowSub["name"].'</a>';
                        echo '</li></br>';
                    }
                    echo '<li id="liSubcategoryIzgradnja">';
                    echo '<a href="addSuggestion.php" id="aSubcategoryIzgradnja">Dodaj prijedlog</a>';
                    echo '</li></br>';
                    echo '<li id="liSubcategoryIzgradnja">';
                    echo '<a href="addSubcategory.php" id="aSubcategoryIzgradnja">Dodaj temu</a>';
                    echo '</li></br>';
                    echo '</ul>';
                    echo '</li></br>';

                }
                echo '</ul></li>';

                echo '<li><a href="decisionList.php">Odluke</a></li>';
                echo '<li><a href="userList.php">Korisnici</a> </li>';
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
        <?php
        $sql2 = mysql_query("SELECT name FROM subcategory WHERE idsubcategory=$idsubcategory");
        $row2=mysql_fetch_array($sql2);
        ?>
        <div class="right-title">
            <label>Prijedlozi za kategoriju</label>
            <h2> <?php echo $row2['name'] ?></h2>
        </div>

        <?php

        // find out how many rows are in the table
        $sql = "SELECT * FROM post inner join user on post.iduser = user.iduser
             WHERE POST.idpost_type='3'";
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
        $decision = false;
        // get the info from the db
        $sql = "SELECT *, subcategory.name, subcategory.endDate as endDate, subcategory.decision as decision, subcategory.startDate FROM post inner join user on post.iduser = user.iduser
                                       inner join subcategory on post.idsubcategory = subcategory.idsubcategory
             WHERE POST.idpost_type='3' and post.idsubcategory = $idsubcategory ORDER BY date_time DESC LIMIT $offset, $rowsperpage";
        $result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
        // while there are rows to be fetched...
        while ($row = mysql_fetch_assoc($result)) {
            $idpost=$row['idpost'];
            $iduser=$row['iduser'];
            echo '<p class="meta"><span class="date">'.$row["name"].'</span></p>';
            echo '<p><span class="posted">postavio/la <a class="user_link" href="profileView.php?id='.$iduser.'">'.$row["username"].'</a></span> <span class="date">'.$row["date_time"].'</span></p>';


            echo ' <div class="entry"><p>'.$row["content"].'</p></div>';
            echo '<p class="links"><a href="suggestionDetails.php?id='.$idpost.'" class="right">Pročitaj više</a></p></br></br></br>';

            $sql2 = mysql_query("SELECT *, subcategory.decision as decision FROM vote inner join post on vote.idpost = post.idpost inner join subcategory on post.idsubcategory = subcategory.idsubcategory WHERE vote.idpost = $idpost");
            $a = false;

            while($row2 = mysql_fetch_assoc($sql2))
            {
                if($row2['iduser'] == $_SESSION['SESS_MEMBER_ID']){
                    $a = true;
                }
                if($row2['decision']==1)
                {
                    $decision = true;
                }
            }
            $sql3 = "SELECT *, subcategory.name, subcategory.endDate as endDate, subcategory.decision as decision, subcategory.startDate FROM post inner join user on post.iduser = user.iduser
                                       inner join subcategory on post.idsubcategory = subcategory.idsubcategory
             WHERE POST.idpost_type='3' and post.idsubcategory = $idsubcategory ORDER BY date_time DESC LIMIT $offset, $rowsperpage";
            $result3 = mysql_query($sql3, $conn) or trigger_error("SQL", E_USER_ERROR);
            $currentDate2 = date("Y-m-d");
            $row3 = mysql_fetch_array($result3);
            $endDate2 = $row3["endDate"];
            if($decision==false and $endDate2 > $currentDate2){
            echo '<form name="addVote" action="addVoteStore.php?id='.$idpost.'" method="post">';
            if($a == true){
                echo '<label>Tema zaključana.</label>';
                echo '<button id="voteButtonFalse" name="submit" value="submit"  disabled>Glasaj</button> </br>';
            }
            else
                echo '<button id="voteButton" name="submit" value="submit">Glasaj</button> </br>';
            echo '</form>';
            }
        }// end while
        // get the info from the db
        $sql2 = "SELECT *, subcategory.name, subcategory.endDate as endDate, subcategory.decision as decision, subcategory.startDate FROM post inner join user on post.iduser = user.iduser
                                       inner join subcategory on post.idsubcategory = subcategory.idsubcategory
             WHERE POST.idpost_type='3' and post.idsubcategory = $idsubcategory ORDER BY date_time DESC LIMIT $offset, $rowsperpage";
        $result2 = mysql_query($sql2, $conn) or trigger_error("SQL", E_USER_ERROR);
        $currentDate = date("Y-m-d");
        $row2 = mysql_fetch_array($result2);
        $endDate = $row2["endDate"];

       if($endDate > $currentDate){

                echo '<input type="submit" name="racunaj" value="Donesi odluku" class="button_vijest_false" float="right" disabled></br></br></br></br>';
            }
       else if($decision==false){
           echo '<form name="formOdluka" method="post" action="addDecision.php?id='.$idsubcategory.'">';
            echo 'Datum isteka teme: <strong>'.date("d.m.Y.", strtotime($row2["endDate"])). '</strong>';
            echo '<input type="submit" name="racunaj2" value="Donesi odluku" class="button_vijest" float="right"></br></br></br></br>';
           echo '</form>';
            }

        if($decision==true)
        {
            echo 'Datum isteka teme: <strong>'.date("d.m.Y.", strtotime($row2["endDate"])). '</br>Tema zaključana.</strong>';
            echo '<form name="formPogledaj" method="post" action="decisionDetails.php?id='.$idsubcategory.'">';
            echo '<input type="submit" name="pogledajOdluku" value="Pogledaj odluku" class="button_vijest" float="right"></br></br></br></br>';
            echo '</form>';
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
        /*
            if ($currentpage > 1) {
                // show << link to go back to page 1
               echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><img src='img/ff-p-button.png'></a> ";
                // get previous page num
                $prevpage = $currentpage - 1;
                // show < link to go back to 1 page
               echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><img src='img/prev-button.png'></a> ";
            } // end if
        */
        echo "</div><!--pagination-->";
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

<script src="dropDownMenu.js" type="text/javascript"></script>


</body>
</html>