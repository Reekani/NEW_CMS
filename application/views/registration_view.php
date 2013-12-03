<?php echo form_open("user/login"); ?>
<label for="login">Login:</label>
<input type="text" id="login" name="login" value="" />
<label for="password">Password:</label>
<input type="password" id="pass" name="pass" value="" />
<input type="submit" class="" value="Zaloguj" />
<?php echo (isset($wrong_login)) ? "Nieprawidłowe dane logowania!" : "" ?>
<?php echo form_close(); ?>
<?php echo validation_errors('<p class="error">'); ?>
<?php echo form_open("user/registration"); ?>
<p>
    <label for="user_name">Login:</label>
    <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" />
    <?php echo (isset($login_error)) ? "Podany login jest już zajęty!" : "" ?>
</p>
<p>
    <label for="email_address">Email:</label>
    <input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" />
    <?php echo (isset($mail_error)) ? "Podany adres email jest już zajęty!" : "" ?>
</p>
<p>
    <label for="password">Hasło:</label>
    <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
</p>
<p>
    <label for="con_password">Potwierdź hasło:</label>
    <input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
</p>
<p>
    <input type="submit" value="Zarejestruj się" />
</p>
<?php echo form_close(); ?>