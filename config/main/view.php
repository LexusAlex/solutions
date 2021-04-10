<?php

use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;

return [
    PhpRenderer::class => static function (ContainerInterface $container) {
        $view = new PhpRenderer($container->get('configurations')['view']['TemplatePath']);
        $view->setLayout($container->get('configurations')['view']['Layout']);
        $view->addAttribute('css', ['bootstrap.min.css', 'style.css']);
        $view->addAttribute('js', ['jquery-3.6.0.slim.min.js', 'bootstrap.bundle.min.js', 'scripts.js']);

        return $view;
    },

    'configurations' => [
        'view' => [
            'TemplatePath' => __DIR__ . '/../../templates',
            'Layout' => '/layouts/html.php',
        ]
    ]
];