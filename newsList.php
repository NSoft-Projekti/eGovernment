<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/news.css">
    <meta name="keywords" content="egovernment, gradjani" />
    <meta name="author" content="Ajda" />
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>eGovernment </title>
</head>
<body>
<div id="wrapper" >
    <div id="header">
        <div id="header-up">
            <div id="header-logo">
                <h1 id="header-title">eGovernment</h1>
            </div><!--header-logo-->
            <div id="reg-prijava">
                <a title="prijava" href="#">Ime i prezime</a>
                <img id="login" src="img/login-icon.png" >
            </div><!--reg-prijava-->
        </div><!--header-up-->
        <div id="header-down">
            <div id="horizontal-menu">
                <ul>
                    <li><a href="Home.php">Home</a> </li>
                    <li><a href="newsList.php" id="vijesti">Vijesti</a> </li>
                    <li><a href="suggestionsList.php">Prijedlozi</a> </li>
                    <li><a href="decisionsList.php">Odluke</a> </li>
                    <li><a href="usersList.php">Korisnici</a> </li>
                </ul>
            </div><!--horizontal-menu-->
            <div id="search">
                <a href="search.php"><div id="img-search">
                    </div></a><!--img-search-->
                <input type="text" name="search" >
            </div><!--search-->
        </div><!--header-down-->
    </div><!--header--->
    <div id="container">
        <div id="main">            <!--
            <div="main-title">
            <span>Dobrodosli!Jeste li spremni za registraciju na e-Goverment</span>
            </div><!--main-title-->
            <div id="registration">
                <form>
                    <!-- end #header -->
                        <div id="page">
                            <div id="page-bgtop">
                                <div id="page-bgbtm">
                                    <div id="content">
                                        <div class="post">
                                            <?php
                                            $res = mysql_query('call select_news()');
                                            if ($res === FALSE) {
                                            die(mysql_error());}

                                            ?>
                                            <h2 id="title"><a href="newsDetails.php"><!--NASLOV IZ VIJESTI--></a></h2>
                                            <p class="meta"><span class="date"><!--DATUM IZ VIJESTI--></span></br>
                                                <span class="posted">postavio/la<a href="#"><!--AUTOR IZ VIJESTI--></a></span></p>
                                            <div class="entry">
                                                <p>Nalazite se na stranicama <strong>eGovernmenta </strong>, besplatne web platforme za upravljanje udrugom građana.</p>
                                                <p class="links"><a href="newsDetails.php" class="button">Pročitaj više</a></p>
                                            </div>
                                        </div>
                                        <div class="post post-alt">
                                            <h2 id="title"><a href="newsDetails.php"><!--NASLOV IZ VIJESTI--></a></h2>
                                            <p class="meta"><span class="date"><!--DATUM IZ VIJESTI--></span></br>
                                                <span class="posted">postavio/la<a href="#"><!--AUTOR IZ VIJESTI--></a></span></p>
                                            <div class="entry">
                                                <p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. </p>
                                                <p class="links"><a href="newsDetails.php" class="button">Pročitaj više</a></p>
                                            </div>
                                        </div>

                        <!-- end #page -->
                </form>
            </div><!--registration-->
        </div><!--main-->
    </div><!--container-->
    <div id="footer">
        <div id="footer-up">
            <div id="footer-logo">
                <img src="Images/logo.png" alt="Logo" title="Logo">
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
            <p class="text">Copyright &copy; Tim 4 2013 - <span id="year"></span> Sva prava pridrzana.</p>
        </div><!--footer-down-->
    </div><!---footer-->
</div><!--wrapper-->

</body>
</html>
