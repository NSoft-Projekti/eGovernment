<?php
/**
 * Created by PhpStorm.
 * User: Darija
 * Date: 15.12.13.
 * Time: 15:12
 */
?>


<script type="text/javascript">

    $(document).ready(function(){
        $('.login-window').click(function(){
            $('#mask').fadeIn(300);
        });
        $('.close').click(function(e){
            $('#mask').fadeOut(300);
        });
        $('#mask').click(function(e){
            console.log(e.target.id)
            if(e.target.id == 'mask'){
                $('#mask').fadeOut(300);
            }
        });
    })
</script>

<div id="mask">
    <div class="login-popup" id="login-box">
        <div id="btn" style="float:right">
            <a class="close" href="#"><img alt="Close" title="Close Window" class="btn_close" src="img/close_pop.png"></a>
        </div>
        <!--            <a href="#" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>-->
        <form action=loginCheck.php class="signin" method="post" form="myform">
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
</div>
