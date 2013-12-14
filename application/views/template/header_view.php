<?php if($this->session->userdata('user_name')){
    session_start();
    $_SESSION['username'] = $this->session->userdata('user_name');
}?>
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
        <link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>css/screen.css" />  
        
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>


        <script type="text/javascript" src="<?=base_url()?>chat/js/jquery.chat.js"></script>
        <script type="text/javascript" src="<?=base_url()?>chat/js/chat.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$(function() {
		$( "#autocomplete" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('autocomplete/suggestions'); ?>",
				data: { term: $("#autocomplete").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);
				}
			});
		},
		minLength: 2
		});
	});
});
</script>
        
        
        <?php if($this->session->userdata('user_name'))
                    {?>
        
            
        
                    <?php 
                    
                    } ?>
        <!--[if lte IE 7]>
        <link type="text/css" rel="stylesheet" media="all" href="<?=base_url()?>css/screen_ie.css" />
        <![endif]-->
    </head>
    <body>
        
        <div id="header">
            <a href="<?php echo base_url(); ?>" class="logo"><span class="icon icon-cloud-upload">Social Cloud</a>
            <?php if($this->session->userdata('user_name'))
                    {
                        echo $this->session->userdata('user_name');
                        
                        echo '<a href="'.base_url().'user/edit">Edytuj profil</a>';
                        echo '<a href="'.base_url().'user/logout">Wyloguj</a>';
                
                    }?>
        </div>
                
        <div id="main">
            <div id="menu">
                <div id="nav">
                    <ul>
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-home">Home</span></a></li> 
                        <li><a href="#" id="home" class="skel-panels-ignoreHref active"><span class="icon icon-cloud-download">Aktywne</span></a></li> 
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-retweet">Nieaktywne</span></a></li> 
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-mail-reply">Wiadomości</span></a></li> 
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-user-md">Grupka</span></a></li> 
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-warning-sign">Uwagi i ostrzeżenia</span></a></li> 
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-female">Uwagi i ostrzeżenia</span></a></li>
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-male">Facet</span></a></li>
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-female">Laska</span></a></li>
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-comment">MSG unread</span></a></li>
                        <li><a href="#" id="home" class="skel-panels-ignoreHref"><span class="icon icon-comment-alt">MSG read</span></a></li>
                    </ul>      
                </div>
            </div>
            <div id="page">
                <div id="container">
                    <div id="mid-container">
                        <?php if(isset($message)){ echo $message;} ?>
   