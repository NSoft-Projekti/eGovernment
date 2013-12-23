<?php
<html>
<head>
    <meta name="description" content="Design Android applications" />
    <meta name="keywords" content="android, design, technics" />
    <meta name="author" content="Jelena" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="css/DefaultStyle.css" rel="stylesheet" type="text/css" />
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

                <a title="prijava" href="#">Prijava</a>

                <a title="registracija" href="registracija.html">Registracija</a>


            </div><!--reg-prijava-->



        </div><!--header-up-->

        <div id="header-down">

            <div id="horizontal-menu">
                <ul>
                    <li><a href="#footer">Home</a> </li>
                    <li><a href="#footer">Vijesti</a> </li>
                    <li><a href="#footer">Prijedlozi</a> </li>
                    <li><a href="#footer">Odluke</a> </li>
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

            $idpost=$_post["idpost"];
            $sgl="select * from post where post.post_type_idpost_type='1' and $idpost==post.idpost";


            $result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
            // while there are rows to be fetched...
            while ($row = mysql_fetch_assoc($result)) {
                echo '<h2 id="title">'.$row["title"].'</a></h2>';
                echo '<p class="meta"><span class="date">'.$row["date_time"].'</span></p>';
                echo '<p><span class="posted">'.$row["content"].'</a></span></p>';

            } // end while
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