
<?php ?>
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
<div class="login-popup" id="login-box">
    <div id="btn" style="float:right">
        <a class="close" href="#"><img alt="Close" title="Close Window" class="btn_close" src="img/close_pop.png"></a>
    </div>
    <!--            <a href="#" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>-->
    <form action=login-check.php class="signin" method="post" form="myform">
        <fieldset class="textbox">
            <label class="username">
                <span>Username or email</span>
                <input type="text" placeholder="Username" autocomplete="on" value="" name="username" id="username">
            </label>

            <label class="password">
                <span>Password</span>
                <input type="password" placeholder="Password" value="" name="password" id="password">
            </label>

            <button type="submit" class="submit button">Sign in</button>

            <!--                    <p>-->
            <!--                        <a href="#" class="forgot">Forgot your password?</a>-->
            <!--                    </p>-->

        </fieldset>
    </form>
</div>
<a class="login-window" href="#login-box">Prijava</a>