<?php
$userpassword='suseweb123456';
$hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);
echo $hashedPassword;