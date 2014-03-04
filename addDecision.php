<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="author" content="Ajda" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/addNews.css" rel="stylesheet" type="text/css" />
    <link href="style/profile.css" rel="stylesheet" type="text/css" />

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
                    $result=mysql_query("SELECT * FROM user WHERE user.iduser='$sesija' ");
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
                            $sqlSub = "SELECT idcategory, name FROM subcategory WHERE idcategory = $idcategory";
                            $resSub=mysql_query($sqlSub, $conn);
                            while($rowSub =mysql_fetch_assoc ($resSub)){
                                echo '<li>';
                                echo '<a href="suggestionList.php?id='.$rowSub['idcategory'].'">'.$rowSub["name"].'</a>';
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
        <?php
        if (isset($_POST['racunaj2']))
        {
            $sql1= mysql_query("select * from post inner join subcategory on post.idsubcategory=$idsubcategory
        where post.idpost_type='3' ");
            $maxidpost=0;
            $maxvotecount= 0;
            $countSum = 0;
            while($row=mysql_fetch_assoc($sql1)){
                $sql2=mysql_query("select * from post where idsubcategory=$idsubcategory");

                while ($row2=mysql_fetch_assoc($sql2)){
                    $idpost=$row2['idpost'];

                    $sql3=mysql_query("select count(votevalue) as votecount ,vote.idpost,post.content from vote inner join post on vote.idpost=post.idpost where vote.idpost=$idpost ");
                    while($row3=mysql_fetch_assoc($sql3)){
                        $votecount=$row3['votecount'];
                        if($votecount>$maxvotecount){
                            $maxvotecount=$votecount;
                            $maxidpost=$row3['idpost'];
                        }
                    }
                }
            }
            echo $countSum;
            if($maxidpost>0){
                $sql4=mysql_query("select *, user.username as username, subcategory.name as subName from post inner join user on post.iduser = user.iduser inner join subcategory on post.idsubcategory = subcategory.idsubcategory where idpost=$maxidpost");
                $row4=mysql_fetch_assoc($sql4);
                $idpost=$row4['idpost'];
                echo '<h4>Kategorija: '.$row4['subName'].'</h4>';
                echo '<h3 style="color: #528BC5">Prijedlog koji je imao najviše glasova:</h3>';
                echo '<h4>Ukupno glasova: '.$maxvotecount.'</h4>';
                echo ' <div class="entry"><p>'.$row4["content"].'</p></div>';
                echo '<p >postavio/la <a href="userProfile.php?id='.$row4['iduser'].'" class="user_link">'.$row4['username'].'</a></p></br>';
                echo '<p class="links"><a href="suggestionDetails.php?id='.$idpost.'" class="right">Pročitaj više</a></p></br>';
            }
            else
                echo 'Nema nista izglasano!';
        }
        ?>
        <div class="news_container">
            <div id="title">
                <form name="addNews" action="addDecisionStore.php?id=<?php echo $idsubcategory ?>" method="post">
                    <label >Naslov odluke: </label><br>
                    <input type="text" name="title" id="inputTitle"/>
            </div>
            <div id="content">
                <label>Sadržaj odluke: </label>
                <textarea name="content" id="inputContent"></textarea>
            </div>
            <div id="summary">
                <label>Kratki opis odluke: </label>
                <textarea name="summary" id="inputSummary"></textarea>
            </div>

            <hr>
            <input class="button" type="submit" name="button" value="Donesi odluku" />
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
            <p class="text">All design and content Copyright &copy; 2014.<span id="year"></span>. All rights reserved.</p>
        </div><!--footer-down-->


    </div><!---footer-->

</div><!--wrapper-->




</body>
</html>
