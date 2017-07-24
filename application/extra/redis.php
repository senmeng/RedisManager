<?php
return [
    'servers' => array(
        array(
        'name'   => 'mf server', // Optional name.
        'host'   => '127.0.0.1',
        'port'   => 6379,

        // Optional Redis authentication.
        'auth' => '' // Warning: The password is sent in plain-text to the Redis server.
        )
    ),
    'type'=> ['','str','set','lists','zset','hash']
];