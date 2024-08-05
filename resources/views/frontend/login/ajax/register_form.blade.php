<!-- Register -->
<div class="tab-content" id="tab2" style="display: none;">

    <h3 class="margin-bottom-10 margin-top-10">Register</h3>

    <form method="post" class="register" action="reg_process.php">

        <p class="form-row d-flex form-row-wide">
            <input type="button" value="Candidate" class="type_reg candidate_reg active">
            <input type="button" value="Employer" class="type_reg employer_reg">
            <input type="hidden"  name="type_register" id="reg_type" value="1" />
        </p>

        <p class="form-row form-row-wide">
            <label for="reg_email">User name:</label>
            <input type="text" class="input-text" name="user_name" id="reg_email" value="" />
        </p>


        <p class="form-row form-row-wide">
            <label for="reg_password">Email:</label>
            <input type="email" class="input-text" name="email" id="reg_password" />
        </p>

        <p class="form-row">
            <input type="submit" class="button" name="register" value="Register" />
        </p>

    </form>
</div>
