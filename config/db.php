<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=calc_db',
    'username' => 'calcc_user',
    'password' => 'root',
    'charset' => 'utf8',
];
// CREATE USER 'calc_user'@'localhost' IDENTIFIED BY 'root';
// GRANT ALL PRIVILEGES ON calc_db.* TO 'calc_user'@'localhost';
// REVOKE GRANT OPTION ON calc_db.* FROM 'calc_user'@'localhost';
// FLUSH PRIVILEGES;
