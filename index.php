<?php

  return [
    'name' => 'svksf-wahlen',

    'type' => 'extension',

    'autoload' => [
      'Ebinf\\SVKSFWahlen\\' => 'src'
    ],

    'routes' => [
      '/svksf/wahlen' => [
        'name' => '@svksf-wahlen',
        'controller' => [
          'Ebinf\\SVKSFWahlen\\Controller\\SVKSFWahlenController'
        ]
      ],
      '/api/svksf/wahlen' => [
        'name' => '@svksf-wahlen/api',
        'controller' => [
          'Ebinf\\SVKSFWahlen\\Controller\\SVKSFWahlenApiController'
        ]
      ]
    ],

    'resources' => [
      'wahlen:' => ''
    ],

    'permissions' => [
      'svksf-wahlen: settings' => [
        'title' => 'Einstellungen verwalten'
      ],

      'svksf-wahlen: view candidatures' => [
        'title' => 'Kandidaturen ansehen und drucken'
      ],

      'svksf-wahlen: sign candidatures' => [
        'title' => 'Kandidaturen als unterschrieben markieren'
      ],

      'svksf-wahlen: edit candidatures' => [
        'title' => 'Kandidaturen bearbeiten'
      ],

      'svksf-wahlen: delete candidatures' => [
        'title' => 'Kandidaturen löschen'
      ],

      'svksf-wahlen: send mails' => [
        'title' => 'E-Mails an Kandidat*innen versenden'
      ],
    ],

    'menu' => [
      'svksf-wahlen' => [
        'label' => 'Wahlen',
        'icon' => 'packages/ebinf/svksf-wahlen/icon.svg',
        'url' => '@svksf-wahlen',
        'active' => '@svksf-wahlen(/*)'
      ],
      'svksf-wahlen: candidatures' => [
        'label' => 'Kandidaturen',
        'parent' => 'svksf-wahlen',
        'url' => '@svksf-wahlen/candidatures',
        'access' => 'svksf-wahlen: view candidatures',
        'active' => '@svksf-wahlen/candidatures((/add)|(/edit))?'
      ],
      'svksf-wahlen: mails' => [
        'label' => 'E-Mails',
        'parent' => 'svksf-wahlen',
        'url' => '@svksf-wahlen/mails',
        'access' => 'svksf-wahlen: send mails',
        'active' => '@svksf-wahlen/mails'
      ],
      'svksf-wahlen: settings' => [
        'label' => 'Einstellungen',
        'parent' => 'svksf-wahlen',
        'url' => '@svksf-wahlen/settings',
        'access' => 'svksf-wahlen: settings',
        'active' => '@svksf-wahlen/settings'
      ]
    ],

    // 'settings' => 'svksf-wahlen-settings',

    'config' => [
      'test' => ''
    ]
  ];
