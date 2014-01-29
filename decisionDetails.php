<html>
<head>
    <meta name="description" content="Design Android applications" />
    <meta name="keywords" content="android, design, technics" />
    <meta name="author" content="Jelena" />
    <title>eGovernment :: Home</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/DefaultStyle.css" rel="stylesheet" type="text/css" />
    <link href="style/postList.css" rel="stylesheet" type="text/css" />
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
                <?php

                echo '<a title="prijava" href="profile.php">'.$_SESSION["SESS_FIRST_NAME"].'</a>';
                echo '<img class="logo" src="img/login-icon.png">';
                echo '</br>';
                echo'<a title="odjava" href="logout.php">Odjava</a>';
                ?>

            </div><!--reg-prijava-->



        </div><!--header-up-->

        <div id="header-down">

            <div id="horizontal-menu">
                <ul>
                    <li><a href="index.php">Home</a> </li>
                    <li><a href="newsList.php" >Vijesti</a> </li>
                    <li><a href="suggestionList.php">Prijedlozi</a> </li>
                    <li><a href="decisionList.php" class="currentTab">Odluke</a> </li>
                    <li><a href="userList.php">Korisnici</a> </li>

                </ul>

            </div><!--horizontal-menu-->

            <div id="search">
                <div id="search-down">
                    <a href="search.php"><div id="img-search">
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
        <div class="existingComments_container">
            <h2>Komentari</h2>
            <?php
            $sql = mysql_query("SELECT content, username, date_time FROM comment inner join user on comment.iduser = user.iduser
            WHERE comment.idpost=$idpost");
            while($row2 = mysql_fetch_array($sql)){
                $iduser = $row2['iduser'];
                echo '<p><span class="posted"><a class="user_link" href="profileView.php?id='.$iduser.'">'.$row2["username"].' </a></span>'.$row2["content"].'</p>';
                echo '<span class="date">'.date("d.\tm.\tY. \tH:\ti", strtotime($row2["date_time"])).'</span>';
                echo '<hr>';
            }

            ?>
            <?php

            $idpost = $_GET['id'];
            $result = mysql_query("select title,content,date_time from post where post.idpost = $idpost");
            $_SESSION['SESS_IDPOST']=$idpost;
            if($result == FALSE) {
                die(mysql_error());
            }
            ?>
        </div><!--existingComments_container-->

        <?php
        if(isset ($_SESSION['SESS_MEMBER_ID']))
        {
        ?>

            <div class="comment_container">

                <div  id="comment">

                    <form action="addcomment.php?id=<?php echo $idpost ?>" method="post"><br />

                        <textarea name="comment_text" id="comment_text" cols="50" rows="7" placeholder="Unesite komentar"></textarea>

                        <input type="submit" value="Submit" />

                    </form>

                </div><!-- exit comment -->

            </div>
        <?php
        }
        ?>







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
