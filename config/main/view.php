<?php

use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;
use Solutions\Modules\Solutions\Query\GetCategories\GetCategories;
use Solutions\Support\BreadcrumbsTree;
use Solutions\Support\HtmlTree;

return [
    PhpRenderer::class => static function (ContainerInterface $container, GetCategories $getCategories) {
        $view = new PhpRenderer($container->get('configurations')['view']['TemplatePath']);
        $view->setLayout($container->get('configurations')['view']['Layout']);
        $view->addAttribute('css', ['bootstrap.min.css', 'style.css']);
        $view->addAttribute('js', ['jquery-3.6.0.slim.min.js', 'bootstrap.bundle.min.js', 'scripts.js']);

        $treeCategories = HtmlTree::create($getCategories->handle(), ['parent' => 'parent_id'],[],false);

        $view->addAttribute('categories', $treeCategories->showTree());

        //$breadcrumbs = BreadcrumbsTree::create($getCategories->handle(), ['parent' => 'parent_id'],[],false);

        //print_r($breadcrumbs->getParents(['parent_id' => 'a01e5501-df80-4ab8-a85c-23430dd57622']));
        return $view;
    },

    'configurations' => [
        'view' => [
            'TemplatePath' => __DIR__ . '/../../templates',
            'Layout' => '/layouts/html.php',
        ]
    ]
];