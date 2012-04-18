<?php

Router::connect('/image/:id', array(
        'plugin' => 'MysqlImageStorage',
        'controller' => 'Images',
        'action' => 'view',
    ), array(
        'id' => '[0-9]+'
));

Router::connect('/images/:id', array(
        'plugin' => 'MysqlImageStorage',
        'controller' => 'Images',
        'action' => 'view',
    ), array(
        'id' => '[0-9]+'
));

Router::connect('/admin/images', array(
        'plugin' => 'MysqlImageStorage',
        'controller' => 'Images',
        'action' => 'index',
        'prefix' => 'admin',
    )
);

Router::connect('/admin/images/:action', array(
        'plugin' => 'MysqlImageStorage',
        'controller' => 'Images',
        'prefix' => 'admin',
    )
);

Router::connect('/admin/images/:action/:id', array(
    'plugin' => 'MysqlImageStorage',
    'controller' => 'Images',
    'prefix' => 'admin',
), array(
    'pass' => array('id'),
    'id' => '[0-9]+'
));

Router::connect('/admin/images/manage/:model/:id', array(
    'plugin' => 'MysqlImageStorage',
    'controller' => 'Images',
    'action' => 'manage',
    'prefix' => 'admin',
), array(
    'pass' => array('model','id'),
    'id' => '[0-9]+'
));

Router::connect('/admin/images/upload/:model/:id', array(
    'plugin' => 'MysqlImageStorage',
    'controller' => 'Images',
    'action' => 'upload',
    'prefix' => 'admin',
), array(
    'pass' => array('model','id'),
    'id' => '[0-9]+'
));
