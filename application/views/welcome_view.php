<h2>Witamy ponownie, <?php echo $this->session->userdata('user_name'); ?>!</h2>
<p>Obszar tylko dla zalogowanych.</p>
 <h4><?php 
    if (isset($priv_count)) {
        $prywatne_info = 'Wiadomości ('.$priv_count.')';
    }
    else {
        $prywatne_info = 'Wiadomości';
    }
    
    echo anchor('user/private_messages', $prywatne_info); ?></h4>
<h4><?php echo anchor('user/logout', 'Logout'); ?></h4>

<h4><?php echo anchor('user/edit_profile', 'Edytuj profil'); ?></h4>
