<?php

namespace Pokedex;

return [
  // routes
  'router' => [
    'routes' => [
      'pokedex_home' => [
        'type' => 'Literal',
        'options' => [
          'route' => '/pokedex',
          'defaults' => [
            'controller'  => 'Pokedex\Controller\Index',
            'action'      => 'index'
          ],
        ],
        'may_terminate' => true,
        'child_routes' => [
            'paged' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/page/:page' ,   // /pokedex/page/:page
                    'constraints' => [ 'page' => '[0-9]+' ],
                    'defaults' => [
                        'controller' => 'Pokedex\Controller\Index',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
      ],
      'pokedex_add' => [
        'type' => 'Literal',
        'options' => [
          'route' => '/pokedex/pokemon/add',
          'defaults' => [
            'controller'  => 'Pokedex\Controller\Index',
            'action'      => 'add'
          ]
        ]
      ],
      'edit_pokemon' => [
        'type' => 'Segment',
        'options' => [
          'route' => '/pokedex/pokemon/edit/:pokemonId',
          'constraints' => [
            'pokemonId' => '[0-9]+'
          ],
          'defaults' => [
            'controller'  => 'Pokedex\Controller\Index',
            'action'      => 'edit'
          ]
        ]
      ],
      'delete_pokemon' => [
        'type' => 'Segment',
        'options' => [
          'route' => '/pokedex/pokemon/delete/:pokemonId',
          'constraints' => [
            'pokemonId' => '[0-9]+'
          ],
          'defaults' => [
            'controller'  => 'Pokedex\Controller\Index',
            'action'      => 'delete'
          ]
        ]
      ],
      'display_pokemon' => [
        'type' => 'Segment',
        'options' => [
          'route' => '/pokedex/pokemons/:categorySlug/:pokemonSlug',
          'contraints' => [
            'categorySlug'  => '[a-zA-Z0-9-]+',
            'pokemonSlug'      => '[a-zA-Z0-9-]+',
          ],
          'defaults' => [
            'controller'  => 'Pokedex\Controller\Index',
            'action'      => 'viewPokemon'
          ]
        ]
      ],
      'api_pokedex_pokemons' => [
        'type'  => 'Segment',
        'options' => [
          'route' => '/api/pokedex/pokemon[/:id]',
          'defaults' => [
            'controller'  => 'Pokedex\Controller\PokedexPokemon'
          ]
        ]
      ],
    ]
  ],

  // controllers
  'controllers' => [
    'factories' => [
      'Pokedex\Controller\Index' => 'Pokedex\Controller\IndexControllerFactory',
      'Pokedex\Controller\PokedexPokemon' => 'Pokedex\Controller\PokedexPokemonControllerFactory'
    ]
  ],

  // view manager
  'view_manager' => [
    'template_path_stack'   => [
      __DIR__ . '/../view'
    ]
  ]
];
