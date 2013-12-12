<?php $this->load->view('template/header_view'); ?>


<h1>Edycja profilu użytkownika</h1>

<?php echo validation_errors('<p class="error">'); ?>
<h2>Zmiana adresu email</h2>
<?php echo form_open("user/change_mail"); ?>
<p>
    <label for="email_address">Email:</label>
    <input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" />
</p>
<p>
    <input type="submit" value="Zmień adres" />
</p>
<p>
    <?php echo (isset($mail_change_succ)) ? "Na nowy adres email został wysłany link aktywacyjny!" : "" ?>
    <?php echo (isset($mail_change_err)) ? "Ten adres email jest już w użyciu!" : "" ?>
    <?php echo (isset($same_mail)) ? "To Twój aktualny adres email, no need to change!" : "" ?>
    <?php echo form_close(); ?>
</p>

<h2>Zmiana hasła użytkownika</h2>
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
</p>
<p>
    <input type="submit" value="Zmień hasło" />
</p>
<p>
    <?php echo (isset($change_password_succ)) ? "Hasło zostało zmienione!" : "" ?>
</p>
<?php echo form_close(); ?>

<?php $this->load->view('template/footer_view'); ?>