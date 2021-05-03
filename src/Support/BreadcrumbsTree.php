<?php

declare(strict_types=1);

namespace Solutions\Support;

use TreeBuilder\TreeBuilder;
use TreeBuilder\TreeBuilderInterface;

class BreadcrumbsTree extends TreeBuilder implements TreeBuilderInterface
{

    public function rootNode($nodes, $firstStart, $userParams)
    {
        return $nodes;
    }

    public function childNode($item, $childNodes, $aliases, $nestingLevel, $userParams)
    {
        $id = $item[$aliases['id']];
        $parent = $item[$aliases['parent']];
        $title = $item[$aliases['title']];

        // html
        $html = '';
        $html .= '<li class="breadcrumb-item">';
        $html .= ('<a href="/category/view/'.$id.'">' . $title . '</a>');
        $html .= $childNodes;
        $html .= '</li>';

        return $html;
    }
}

