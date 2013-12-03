<h2>Witamy ponownie, <?php echo $this->session->userdata('user_name'); ?>!</h2>
<p>Obszar tylko dla zalogowanych.</p>
<h4><?php echo anchor('user/logout', 'Logout'); ?></h4>
<<<<<<< HEAD
<h4><?php echo anchor('user/edit_profile', 'Edytuj profil'); ?></h4>
<a href="<?=base_url()?>index.php/user/chat/Robert/Bob">Chat(Robert with You)</a>
=======
<h4><?php echo anchor('user/edit_profile', 'Edytuj profil'); ?></h4>
>>>>>>> 40e29ddf51bd3e0dfd3e564cbe7e5216c97dd2c4
