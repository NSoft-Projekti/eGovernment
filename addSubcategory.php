<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="author" content="Ajda" />
    <title>eGovernment :: Potkategorija</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/addNews.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css" />
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
                            echo '<a href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                            echo '<img class="logo" src="img/men.png">';
                            echo '</br>';
                            echo '<a href="logout.php">Odjava</a>';
                        }

                        //if it's not male gender, it displays female image
                        else {
                            echo '<a href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                            echo '<img class="logo" src="img/girl.png">';
                            echo '</br>';
                            echo '<a href="logout.php">Odjava</a>';
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
                        echo'<li class="currentTab"><a href="suggestionList.php">Prijedlozi</a>';
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
                <form name="addSubcategory" action="addSubcategoryStore.php" method="post">
                    <label >Unesite naslov potkategorije: </label><br>
                    <input type="text" name="name" id="inputName"/>
            </div>
            <div id="datumPocetka">
                <label>Datum početka:</label></br>
                <input type="date" name="datumP" id="datumP">
            </div>
            <div id="datumZavrsetka">
                <label>Datum završetka:</label></br>
                <input type="date" name="datumK" id="datumK">
            </div>
            <hr>
            <input type="submit" name="button" value="Spremi" class="button" />
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
