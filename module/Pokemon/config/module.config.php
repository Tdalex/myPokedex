<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pokemon;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'pokemon' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/pokemon[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'pokemon_add' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/pokemon[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'add',
                    ],
                ],
            ],
            'pokemon_edit' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => 'pokemon[/:action][/:id]',
                    'constraints' => [
                        'id' => '[0-9]+'
                    ],
                    'defaults'    => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'edit',
                    ],
                ],
            ],
            'pokemon_view' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => 'pokemon[/:action][/:id]',
                    'constraints' => [
                        'id' => '[0-9]+'
                    ],
                    'defaults'    => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'view',
                    ],
                ],
            ],
            'pokemon_delete' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => 'pokemon/[/:action][/:id]',
                    'constraints' => [
                        'id' => '[0-9]+'
                    ],
                    'defaults'    => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'delete',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'pokemon/index/index' => __DIR__ . '/../view/pokemon/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
