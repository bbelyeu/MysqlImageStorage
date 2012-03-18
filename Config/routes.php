<?php
Router::connect('/image/:id', array(
        'controller' => 'images',
        'action' => 'view',
        'plugin' => 'MysqlImageStorage'
    ), array(
        'id' => '[0-9]+'
));
