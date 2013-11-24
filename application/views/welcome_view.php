<h2>Witamy ponownie, <?php echo $this->session->userdata('user_name'); ?>!</h2>
  <p>Obszar tylko dla zalogowanych.</p>
  <h4><?php echo anchor('user/logout', 'Logout'); ?></h4>