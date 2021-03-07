<?php
echo include_template('layout.php', ['page_name'=>$page_name, 'user_name'=>$user_name, 'is_auth'=>$is_auth, 'cats'=>$cats, 'two_cats'=>$two_cats]);
