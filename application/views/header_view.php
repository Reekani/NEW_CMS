<!DOCTYPE html>
<html lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title><?php echo (isset($title)) ? $title : "NEW CMS" ?> </title>
</head>
<body>
    
    <h4><?php 
    if (isset($priv_count)) {
        $prywatne_info = 'Wiadomości ('.$priv_count.')';
    }
    else {
        $prywatne_info = 'Wiadomości';
    }
    
    echo anchor('user/private_messages', $prywatne_info); ?></h4>