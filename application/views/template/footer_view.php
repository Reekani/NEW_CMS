</div>
</div>
            </div>
            <div id="friends">
                <div id="friends-list">
                <?php if($this->session->userdata('user_name'))
                        { ?>
                
                    <body>

<form onsubmit="return false;" action="">
<input type="text" style="width: 300px;" value="" id="auto" class="ac_input"/>

</form>

<script type="text/javascript">

$("#auto").autocomplete(
"<?php base_url(); ?>user/search/",
{
delay:10,
minChars:1,
matchSubset:1,
matchContains:1,
cacheLength:10,
autoFill:false,
matchCase: false,
selectFirst: false,
max:10,
scrollHeight: 180,
mustMatch: false

}
);

</script>
                    <?php
                    if (isset($friends)) {
                            foreach ($friends as $friend) {
                                $html = '<a href="javascript:void(0)" class="friend" onclick="javascript:chatWith(\''.$friend[0].'\')">'.$friend[0].' ';
                                if((time()-$friend[1])<82800) {
                                    if((time()-$friend[1])>600) {
                                        $html .= '<span class="chat"><span class="icon icon-comment-alt">&nbsp;'.date("H:i",$friend[1]).'</span></span>';
                                    } else {
                                        $html .= '<span class="chat"><span class="icon icon-comment">&nbsp;'.date("H:i",$friend[1]).'</span></span>';
                                    }
                                } else {
                                        $html .= '<span class="chat"><span class="icon icon-comment-alt"></span></span>';
                                }
                                
                                $html .= '</a>';
                                
                                echo $html;
                            }
                        }
                    } else { ?>
                    <form action="<?php base_url()?>/user/login" method="POST">
                        <input type="text" name="login" id="login" class="login" placeholder="Login">
                        <input type="password" name="pass" id="pass" class="login" placeholder="Password">
                        <input type="submit" value="Zaloguj" class="login">
                    </form>
                    <div id="register-link">
                        <a href="<?php echo base_url(); ?>user/registration">Rejestracja użytkownika</a>
                    </div>
                   <?php } ?>
                </div>
            </div>            
        </div>
    </body>
</html>
