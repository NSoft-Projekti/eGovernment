<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="style/login-popup.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('a.login-window').click(function() {

    // Getting the variable's value from a link
    var loginBox = $(this).attr('href');

    //Fade in the Popup and add close button
                $(loginBox).fadeIn(300);

    //Set the center alignment padding + border
      var popMargTop = ($(loginBox).height() + 24) / 2;
    var popMargLeft = ($(loginBox).width() + 24) / 2;

    $(loginBox).css({
    'margin-top' : -popMargTop,
    'margin-left' : -popMargLeft
    });

    // Add the mask to body
                $('body').append('<div id="mask"></div>');
    $('#mask').fadeIn(300);

    return false;
        });

    // When clicking on the button close or the mask layer the popup closed
            $('a.close, #mask').live('click', function() {
    $('#mask , .login-popup').fadeOut(300 , function() {
        $('#mask').remove();
        });
    return false;
        });
        });
    </script>

</head>'
<body>
<div id="login-box" class="login-popup" style="display: block; margin-top: -111.9px; margin-left: -129.9px;>
    <a href="#" class="close"><img src="img/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
    <form method="post" class="signin"  action="login-check.php">
        <fieldset class="textbox">
            <label class="username">
                <span>Username or email</span>
                <input id="username" name="username" value="" type="text" autocomplete="on" placeholder="Username">
            </label>

            <label class="password">
                <span>Password</span>
                <input id="password" name="password" value="" type="password" placeholder="Password">
            </label>

            <button class="submit button" type="submit" name="submit">Sign in</button>

            <p>
<!--                <a class="forgot" href="#">Forgot your password?</a>-->
            </p>

        </fieldset>
    </form>
</div>
<div id="mask" style="display: block;"></div>
</body>
</html>