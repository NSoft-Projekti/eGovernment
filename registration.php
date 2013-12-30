<html>
<head>
    <meta name="description" content="Design Android applications" />
    <meta name="keywords" content="android, design, technics" />
    <meta name="author" content="Jelena" />
    <title>E-government</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href="style/registration.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">




</head>


<body>
<div id="wrapper" >

    <div id="header">

        <div id="header-up">

            <div id="header-logo">
                <img src="Images/logo.png" alt="Logo" title="Logo">
            </div><!--header-logo-->

            <div id="reg-prijava">

                <a title="prijava" href="#">Prijava</a>

                <a title="registracija" href="#">Registracija</a>


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
                <a href="#"><div id="img-search">
                </div></a><!--img-search-->

                <input type="text" name="search" >


            </div><!--search-->

        </div><!--header-down-->


    </div><!--header--->

    <div id="container">

        <div id="main-title">
            <label>Dobrodošli! Jeste li spremni za registraciju na e-Government?</label>
            <span>Molim Vas unesite točne informacije za uspješnu registraciju - polja sa (*) su obavezna</span>
        </div>

        <div id="main">



            <div id="registration">

                <form name="registration" method="post" onsubmit="validateForm()" action="register_proces.php">

                    <table>
                        <tr> <td>Ime: *</td>              <td><input type="text" name="name" ></td>  </tr>
                        <tr> <td>Prezime: *</td>          <td><input type="text" name="lastname"  ></td>  </tr>
                        <tr> <td>Username: *</td>         <td><input type="text" name="username" ></td>  </tr>
                        <tr> <td>Password: *</td>         <td><input type="password" name="password" ></td>  </tr>
                        <tr> <td>Repeat password: *</td>  <td><input type="password" name="rpass" ></td>  </tr>
                        <tr> <td>E-mail: *</td>           <td><input type="email" name="email" id="nmail"></td>  </li>
                        <tr> <td>Spol:</td>             <td><input type="radio" name="gender" value="M" >Musko   <input type="radio" name="gender" value="Z">Zensko</td> 	</tr>
                        <tr> <td>Datum rođenja:</td>    <td><input type="date" name="bday" ></td>  </tr>
                        <tr> <td>Adresa:</td>           <td><input type="text" name="address" ></td>  </tr>
                        <tr> <td>Telefon: *</td>          <td><input type="tel" name="usrtel" placeholder="+38763123456"></td>  </tr>
                    </table>

                    <input type="submit" value="Registriraj se" name="registr" class="buttom" >

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

                <a href="http://www.flickr.com/" target="_blank" > <img title="Flick" src="Images/icon-fl.png"></a>
                <a href="https://twitter.com/" target="_blank">  <img src="Images/icon-tw.png"></a>
                <a href="https://www.facebook.com/" target="_blank"> <img src="Images/icon-fb.png"></a>
                <a href="http://www.google.ba" target="_blank"> <img src="Images/icon-gp.png"></a>
                <a href="http://dribbble.com/" target="_blank"> <img src="Images/icon-db.png"></a>
            </div><!--icons-->

        </div><!--footer-up-->

        <div id="footer-down">
            <p class="text">All design and content Copyright &copy; <span id="year"></span>. All rights reserved.</p>
        </div><!--footer-down-->


    </div><!---footer-->



</div><!--wrapper-->




<script src="java.js" type="text/javascript"></script>
</body>
</html>
