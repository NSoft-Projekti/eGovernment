//
<html>
<head>
    <meta name="description" content="Design Android applications" />
    <meta name="keywords" content="android, design, technics" />
    <meta charset="UTF-8">
    <meta name="author" content="Jelena" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/search.css" rel="stylesheet" type="text/css">

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
                    <li><a href="home.php">Home</a> </li>
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
        <div id="searching">

            <?php

            error_reporting(E_ALL);
            ini_set('display_errors', '1');
            $search_output = "";
            if(isset($_POST['searchquery']) && $_POST['searchquery'] != ""){
            $searchquery = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchquery']);

                $searchquery=$_POST['searchquery'];
                $sqlCommand=("SELECT * FROM post WHERE (`title` LIKE '%$searchquery%' ) OR (`content` LIKE '%$searchquery%' )");
                $query = mysql_query($sqlCommand) or die(mysql_error());
                $count = mysql_num_rows($query);
                if($count > 1){
                    $search_output .= "<hr />$count results for <strong>$searchquery</strong><hr />$sqlCommand<hr />";
                    while($row = mysql_fetch_array($query)){

                        $idpost = $row["idpost"];
                        $title = $row["title"];
                        $search_output .= "$idpost - <a href='newsDetails.php?id=$idpost'>$title</a><br />";

                    } // close while
                } else {
                    $search_output = "<hr />0 results for <strong> $searchquery</strong><hr />$sqlCommand";
                }
            }



            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                Search For:
                <input name="searchquery" type="text" size="44" maxlength="88">
                Within:
                <select name="filter1">
                    <option value="title">Naslov</option>
                    <option value="content">Sadrzaj</option>

                </select>
                <input name="myBtn" type="submit">
                <br />
            </form>
            <div>
                <?php echo $search_output; ?>
            </div>


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

