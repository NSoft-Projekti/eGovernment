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
                <form name="addSubcategory" action="addSubcategoryStore.php" method="post">
                    <label >Unesite naslov podkategorije: </label><br>
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