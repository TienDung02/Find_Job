<!-- Login -->
<div class="tab-content" id="tab1" style="display: block;">

    <h3 class="margin-bottom-10 margin-top-10">Login</h3>

    <form method="post" class="login" action="login_process.php">


        <p class="form-row form-row-wide">
            <label for="username">Username or Email Address:</label>
            <input type="text" class="input-text" name="user_name" id="username" value="" />
        </p>

        <p class="form-row form-row-wide">
            <label for="password">Password:</label>
            <input class="input-text" type="password" name="password" id="password" />
        </p>

        <p class="form-row">
            <input type="submit" class="button" name="login" value="Login" />

            <label for="rememberme" class="rememberme">
                <input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label>
        </p>

        <p class="lost_password">
            <a href="#" >Lost Your Password?</a>
        </p>


    </form>
</div>
