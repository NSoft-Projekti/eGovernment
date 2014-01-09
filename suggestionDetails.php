
<html>
<head>
    <meta name="description" content="Design Android applications" />
    <meta name="keywords" content="android, design, technics" />
    <meta name="author" content="Jelena" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
</head>
<?php
include('connect.php');
?>

<body>
<div id="wrapper" >

    <div id="header">

        <div id="header-up">

            <div id="header-logo">
                <h1>LOGO STRANICE</h1>
            </div><!--header-logo-->


            <div id="reg-prijava">



                <a title="prijava" href="#">Korisnik</a>
                <img class="logo" src="img/login-icon.png">


            </div><!--reg-prijava-->



        </div><!--header-up-->

        <div id="header-down">

            <div id="horizontal-menu">
                <ul>
                    <li><a href="home.php">Home</a> </li>
                    <li><a href="newsList.php" >Vijesti</a> </li>
                    <li><a href="suggestionList.php"class="currentTab">Prijedlozi</a> </li>
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
            <?php
            $idpost = $_GET['id'];
            $result = mysql_query("select title,content,date_time from post where post.idpost = $idpost");

            if($result == FALSE) {
                die(mysql_error());
            }

            while($row = mysql_fetch_array($result))
            {
                echo '<h2 id="title">'.$row["title"].'</h2>';
                echo '<p class="meta"><span class="date">'.$row["date_time"].'</span></p>';
                echo ' <div class="entry"><p>'.$row["content"].'</p></div>';
            }
            ?>


        </div>






    </div><!--container-->

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
            <p class="text">All design and content Copyright &copy; 2013.<span id="year"></span>. All rights reserved.</p>
        </div><!--footer-down-->


    </div><!---footer-->

</div><!--wrapper-->





</body>
</html>