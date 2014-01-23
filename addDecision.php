<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="author" content="Ajda" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/addNews.css" rel="stylesheet" type="text/css" />
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

                <a title="prijava" href="profile.php"><?php echo $_SESSION["SESS_FIRST_NAME"] ?> <img class="logo" src="img/login-icon.png"></a>




            </div><!--reg-prijava-->



        </div><!--header-up-->

        <div id="header-down">

            <div id="horizontal-menu">
                <ul>
                    <li><a href="index.php">Home</a> </li>
                    <li><a href="newsList.php" class="currentTab">Vijesti</a> </li>
                    <li><a href="suggestionList.php">Prijedlozi</a> </li>
                    <li><a href="decisionList.php">Odluke</a> </li>
                    <li><a href="#footer">Korisnici</a> </li>

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

        <div class="news_container">
            <div id="title">
                <form name="addNews" action="addDecisionStore.php" method="post">
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

            <div id="selectsubcategory">
                <label>Subkategorija</label>
                <select name="subcategory">

                    <?php
                    $getAllSubcategory = mysql_query("SELECT idsubcategory,name,endDate FROM subcategory where subcategory.idcategory!='1'and subcategory.decision= false ;");
                    $curentDate=date("Y-m-d");


                    while($viewAllSubcategory=mysql_fetch_assoc($getAllSubcategory)){

                       $endDate=$viewAllSubcategory['endDate'];

                        if(strtotime($curentdate) < strtotime($endDate)){
                        echo '<option value='.$viewAllSubcategory['idsubcategory'].'>'.$viewAllSubcategory['name']. '</option>';
                        }
                        else{
                        echo '';
                    }
                    }
                    ?>
                </select>

            </div><!--selectsubcategory-->
            <hr>
            <input type="submit" name="button" value="submit" class="button" />
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
            <p class="text">All design and content Copyright &copy; 2013.<span id="year"></span>. All rights reserved.</p>
        </div><!--footer-down-->


    </div><!---footer-->

</div><!--wrapper-->




</body>
</html>