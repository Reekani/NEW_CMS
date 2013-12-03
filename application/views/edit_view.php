<?php echo validation_errors('<p class="error">'); ?>
<?php echo form_open("user/change_login"); ?>
<p>
    <label for="user_name">Login:</label>
    <input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" />
    <input type="submit" value="Zmień login" />
    <?php echo (isset($login_change_succ)) ? "Twój login został zmieniony!" : "" ?>
    <?php echo (isset($login_change_err)) ? "Ten login jest już zajęty!" : "" ?>
    <?php echo form_close(); ?>
</p>
<?php echo form_open("user/change_mail"); ?>
<p>
    <label for="email_address">Email:</label>
    <input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" />
    <input type="submit" value="Zmień e-mail" />
    <?php echo (isset($mail_change_succ)) ? "Na nowy adres email został wysłany link aktywacyjny!" : "" ?>
    <?php echo (isset($mail_change_err)) ? "Ten adres email jest już w użyciu!" : "" ?>
    <?php echo (isset($same_mail)) ? "To Twój aktualny adres email, no need to change!" : "" ?>
    <?php echo form_close(); ?>
</p>
<p>
    <?php echo form_open("user/change_password"); ?>
    <label for="password">Obecne hasło:</label>
    <input type="password" id="current_password" name="current_password" value="<?php echo set_value('current_password'); ?>" />
    <?php echo (isset($change_password_err)) ? "Błędne hasło!" : "" ?>
</p>
<p>
    <label for="password">Nowe hasło:</label>
    <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
</p>
<p>
    <label for="con_password">Potwierdź nowe hasło:</label>
    <input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
    <input type="submit" value="Zmień hasło" />
    <?php echo (isset($change_password_succ)) ? "Hasło zostało zmienione!" : "" ?>
</p>
<?php echo form_close(); ?>
<h4><?php echo anchor('user/index', 'Home'); ?></h4>