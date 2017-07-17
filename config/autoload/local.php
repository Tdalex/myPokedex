<?php

return array (
    'db' =>array(
		'driver'   => 'Pdo',
        'dsn' => 'mysql:dbname=mypokedex;hostname=localhost', 
        'username' => 'root',
        'password' => 'root',
		'driver_options' => array( 
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'' 
        ), 
    )
);