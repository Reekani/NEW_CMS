<?php
if (isset($priv)) {
    
            if($priv == "null") {
            echo "Nie masz żadnych wiadomości";
    } else {
 
    foreach ($priv as $value) {
        echo anchor("chatHistory/view_history/$value", $value); 
        echo "<br>";
        

    }
    }
    
}



if (isset($messages)) {
    
    
     foreach ($messages as $value1) {
        echo  '<b>'.$value1['from'].'</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value1['date'].'<br>'; //."<P align=right>"."</P>"
        echo $value1['message'].'<br>';
//        echo ;
        

    }
    
    
}

?>

<h4><?php echo anchor('user/index', 'Home'); ?></h4>

