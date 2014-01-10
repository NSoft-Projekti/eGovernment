<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="keywords" content="design, egovernment" />
    <meta name="author" content="Tim4" />
    <title>eGovernment :: Novi prijedlog</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/addSuggestion.css" rel="stylesheet" type="text/css" />
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
                <a href="home.php"><img src="img/logo.png"></a>
            </div><!--header-logo-->


            <div id="reg-prijava">

                <a title="prijava" href="profile.php">Korisnik</a>
                <img class="logo" src="img/login-icon.png">


            </div><!--reg-prijava-->



        </div><!--header-up-->

        <div id="header-down">

            <div id="horizontal-menu">
                <ul>
                    <li><a href="home.php">Home</a> </li>
                    <li><a href="newsList.php">Vijesti</a> </li>
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
        </br>
            <label class="title">Naziv  prijedloga: </label> </br></br>
        <input class="input" type="text" name="titlePrijedlog" id="titlePrijedlog"/>
        </br></br>
        <label class="title">Kategorija: </label> </br></br>
        <?php


        $sql = "SELECT * FROM category";
        $result = mysql_query($sql);

        echo "<select id='categoryDropdownList' name='categoryDropdownList'>";
        echo "<option value='0'></option>";
        while ($row = mysql_fetch_array($result)) {
            echo "<option value='" . $row['idcategory'] . "'>" . $row['name'] . "</option>";
        }
        echo "</select>";

        ?>
        </br></br>
        <label class="title">Unesite sadržaj prijedloga: </label> </br></br>
        <textarea name="contentPrijedlog" id="contentPrijedlog"></textarea>

        </br> </br>
        <label class="title">Unesite kratki opis prijedloga: </label> </br></br>
        <textarea name="contentPrijedlog" id="contentSummary"></textarea>
        </br> </br>
        <hr>
        <button id="button" name="submit" value="submit" formaction="addSuggestionStore.php" formmethod="post">Pošalji</button>

    </div><!--container-->

    <div id="footer">

        <div id="footer-up">

            <div id="footer-logo">
                <a href="home.php"><img src="img/logo.png"></a>
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