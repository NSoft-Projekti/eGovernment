<html>
<head>
    <meta name="description" content="eGovernment" />
    <meta name="author" content="Ajda" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="../style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="../style/addNews.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
</head>

<?php
include("../connect.php");
session_start();
?>
<body>
<div id="wrapper" >

    <div id="header">

        <div id="header-up">

            <div id="header-logo">
                <a href="../index.php"><img src="../img/logo.png"></a>
            </div><!--header-logo-->


            <div id="reg-prijava">

                <a title="prijava" href="../profiles/profile.php"><?php echo $_SESSION["SESS_FIRST_NAME"] ?> <img class="logo" src="img/login-icon.png"></a>




            </div><!--reg-prijava-->



        </div><!--header-up-->

        <div id="header-down">

            <div id="horizontal-menu">
                <ul>
                    <li><a href="../index.php">Home</a> </li>
                    <li><a href="newsList.php" class="currentTab">Vijesti</a> </li>
                    <li><a href="../suggestions/suggestionList.php">Prijedlozi</a> </li>
                    <li><a href="../decisions/decisionList.php">Odluke</a> </li>
                    <li><a href="../profiles/userList.php">Korisnici</a> </li>

                </ul>

            </div><!--horizontal-menu-->

            <div id="search">
                <div id="search-down">
                    <a href="../search.php"><div id="img-search">
                        </div></a><!--img-search-->

                    <input type="text" name="search" >


                </div>

            </div><!--search-->

        </div><!--header-down-->


    </div><!--header--->
<?php
?>
    <div id="container">
<?php
$idpost = $_GET['id'];
$sql = mysql_query("SELECT * FROM post WHERE idpost =  $idpost");
$result = mysql_fetch_array($sql);
while($row = mysql_fetch_array($sql)){
            echo '<div class="news_container">';
            echo '<div id="title">';
                echo '<form name="editNews" action="editNewsStore.php?id='.$idpost.'" method="post">';
                    echo '<label >Unesite naslov vijesti: </label><br>';
    $title = $row ['title'];
    echo '<input type="submit" name="title" id="inputTitle" value=".$row.">';
                    echo '<input type="text" name="title" id="inputTitle" value="$title"/>';
            echo '</div>';
            echo '<div id="content">';
             echo '<label>Unesite sadržaj vijesti: </label>';
    $content = $row ['content'];
                echo '<textarea name="content" id="inputContent">'.$content.'</textarea>';
            echo '</div>';
            echo '<div id="summary">';
              echo '<label>Unesite kratki opis vijesti: </label>';
    $summary = $row ['summary'];
                echo '<textarea name="summary" id="inputSummary">'.$summary.'</textarea>';
            echo '</div>';
            echo '<div id="attachment">';
                echo '<label>Attachment</label>';
                echo '<input type="file" name="file" id="file">';
            echo '</div>';
            echo '<hr>';
           echo '<input type="submit" name="button" value="submit" class="button" />';
            echo '</form>';
       echo '</div>
        <!--news_container-->';

}
?>
    </div><!--container-->

    <div id="footer">

        <div id="footer-up">

            <div id="footer-logo">
                <a href="../index.php"><img src="../img/logo.png"></a>
            </div><!--footer-logo-->

            <div id="icons">

                <a href="http://www.flickr.com/" target="_blank" > <img title="Flick" src="../img/icon-fl.png"></a>
                <a href="https://twitter.com/" target="_blank">  <img src="../img/icon-tw.png"></a>
                <a href="https://www.facebook.com/" target="_blank"> <img src="../img/icon-fb.png"></a>
                <a href="http://www.google.ba" target="_blank"> <img src="../img/icon-gp.png"></a>
                <a href="http://dribbble.com/" target="_blank"> <img src="../img/icon-db.png"></a>
            </div><!--icons-->

        </div><!--footer-up-->

        <div id="footer-down">
            <p class="text">All design and content Copyright &copy; 2013.<span id="year"></span>. All rights reserved.</p>
        </div><!--footer-down-->


    </div><!---footer-->

</div><!--wrapper-->





</body>
</html>