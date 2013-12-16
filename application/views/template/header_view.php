<?php
if ($this->session->userdata('user_name')) {
    session_start();
    $_SESSION['username'] = $this->session->userdata('user_name');
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title><?php echo (isset($title)) ? $title : "Encrypted.pl CMS" ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">        
        <link rel="stylesheet" href="<?=base_url()?>css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Ubuntu&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>css/chat.css" />

        <link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>css/autocomplete.css" />  

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<!--        <script type="text/javascript" src="<?=base_url()?>chat/js/jquery.chat.js"></script>-->
        <script type="text/javascript" src="<?=base_url()?>chat/js/chat.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $(function() {
                    $("#autocomplete-user").autocomplete({
                        source: function(request, response) {
                            $.ajax({url: "<?php echo site_url('autocomplete/users'); ?>",
                                data: {term: $("#autocomplete-user").val()},
                                dataType: "json",
                                type: "POST",
                                success: function(data) {
                                    response(data);
                                }
                            });
                        },
                        minLength: 2,
                        select: function(event, ui) {
                            if (ui.item) {
                                $('#autocomplete-user').val(ui.item.value);
                            }
                            $('#search-user').submit();
                        }
                    });
                });
            });
        </script>

        <?php if ($this->session->userdata('user_name')) {
            ?>



        <?php }
        ?>
        <!--[if lte IE 7]>
        <link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>css/screen_ie.css" />
        <![endif]-->
    </head>
    <body>

        <div id="header">
            <div id="header-logo">
                <a href="<?php echo base_url(); ?>" class="logo"><span class="icon icon-cloud-upload">Social Cloud</a>
            </div>
            <div id="header-login">
                <?php
                if ($this->session->userdata('user_name')) {
                    echo '<ul><li><a href="#">' . $this->session->userdata('user_name') . '</a><ul>';

                    echo '<li><a href="' . base_url() . 'user/profile/' . $this->session->userdata('user_name') . '">Mój profil</a></li>';
                    echo '<li><a href="' . base_url() . 'user/edit">Edytuj profil</a></li>';
                    echo '<li><a href="' . base_url() . 'user">Historia wiadomości</a></li>';
                    if ($this->session->userdata('admin')) {
                        echo '<li><a href="' . base_url() . 'admin">Administracja</a></li>';
                    }
                    echo '<li><a href="' . base_url() . 'user/logout">Wyloguj</a></li>';

                    echo '</ul></li></ul>';
                }
                ?>
            </div>
        </div>

        <div id="main">
            <div id="menu">
                <div id="nav">
                    <ul> 
                        <?php
                        foreach ($this->global_model->get_menu() as $link) {
                            $active = "";
                            if ($link[2] == current_url())
                                $active = 'active';
                            echo '<li><a href="' . $link[2] . '" class="' . $active . '"><span class="icon ' . $link[0] . '">' . $link[1] . '</span></a></li>';
                        }
                        ?>
                    </ul>      
                </div>
            </div>
            <div id="page">
                <div id="container">
                    <div id="mid-container">
                        <?php
                        if (isset($message)) {
                            echo $message;
                        }
                        ?>
   