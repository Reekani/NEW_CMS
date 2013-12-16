</div>
</div>
</div>
<div id="friends">
    <div id="friends-list">
        <?php if ($this->session->userdata('user_name')) {
            ?>
            <div id="friends-search">
                <form method="POST" id="search-user" action="<?php echo base_url(); ?>autocomplete/user_result">
                    <input type="text" id="autocomplete-user" name="user" class="login" placeholder="Wyszukaj użytkownika" />
                </form>
            </div>

            <?php
            if (isset($friends)) {
                foreach ($friends as $friend) {
                    $html = '<a href="javascript:void(0)" class="friend" onclick="javascript:chatWith(\'' . $friend[0] . '\')">' . $friend[0] . ' ';
                    if ((time() - $friend[1]) < 82800) {
                        if ((time() - $friend[1]) > 600) {
                            $html .= '<span class="chat"><span class="icon icon-comment-alt">&nbsp;' . date("H:i", $friend[1]) . '</span></span>';
                        } else {
                            $html .= '<span class="chat"><span class="icon icon-comment">&nbsp;' . date("H:i", $friend[1]) . '</span></span>';
                        }
                    } else {
                        $html .= '<span class="chat"><span class="icon icon-comment-alt"></span></span>';
                    }

                    $html .= '</a>';

                    echo $html;
                }
            }
        } else {
            ?>
            <form action="<?php base_url() ?>/user/login" method="POST">
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
