</div>
</div>
            </div>
            <div id="friends">
                <div id="friends-list">
                <?php if($this->session->userdata('user_name'))
                        { if (isset($friends)) {
                            foreach ($friends as $value) {
                                echo '<a href="javascript:void(0)" class="friend" onclick="javascript:chatWith(\''.$value.'\')">'.$value.'<span class="icon icon-comment-alt"></span></a>';
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
