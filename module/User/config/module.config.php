<?php

namespace User;

return [
  'router' => [
    'routes' => [
      'add_user' => [
        'type' => 'Literal',
        'options' => [
          'route' => '/user/add',
          'defaults' => [
            'controller' => 'User\Controller\Index',
            'action'  => 'add'
          ]
        ]
      ],
      'login' => [
          'type' => 'Literal',
          'options' => [
            'route' => '/user/login',
            'defaults'=> [
              'controller' => 'User\Controller\Index',
              'action'     => 'login'
            ]
          ]
      ],
      'logout' => [
        'type' => 'Literal',
        'options' => [
          'route' => '/user/logout',
          'defaults'=> [
            'controller' => 'User\Controller\Index',
            'action'     => 'logout'
          ]
        ]
      ]
    ]
  ],
  'controllers' => [
    'factories' => [
      'User\Controller\Index' => 'User\Controller\IndexControllerFactory'
    ]
  ],
  'view_manager' => [
    'template_path_stack' => [
      __DIR__ . '/../view'
    ]
  ]
];
