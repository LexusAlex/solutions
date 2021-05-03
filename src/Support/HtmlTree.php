<?php

declare(strict_types=1);

namespace Solutions\Support;

use TreeBuilder\TreeBuilder;
use TreeBuilder\TreeBuilderInterface;

class HtmlTree extends TreeBuilder implements TreeBuilderInterface
{

    public function rootNode($nodes, $firstStart, $userParams)
    {
        $options = $firstStart ? 'class="tree-root"' : 'class="tree-child"';

        return ('<ul " ' . $options . '>' . $nodes . '</ul>');
    }

    public function childNode($item, $childNodes, $aliases, $nestingLevel, $userParams)
    {
        $id = $item[$aliases['id']];
        $parent = $item[$aliases['parent']];
        $title = $item[$aliases['title']];

        // html
        $html = '';
        $html .= '<li class="tree-item">';
        $html .= ('<a href="/category/view/'.$id.'">' . $title . '</a> 
                   <a title="Редактировать" class="" href="/category/update/'.$id.'"> <img src="/assets/svg/pencil.svg" alt=""></a>
                   <a title="Удалить" class="" href="/category/delete/'.$id.'"> <img src="/assets/svg/trashcan.svg" alt=""></a>
                   ');
        $html .= $childNodes;
        $html .= '</li>';

        return $html;
    }

}

