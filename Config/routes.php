<?php
Router::connect('/image/:id', array(
        'controller' => 'Images',
        'action' => 'view',
        'plugin' => 'MysqlImageStorage'
    ), array(
        'id' => '[0-9]+'
));
