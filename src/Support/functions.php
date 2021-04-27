<?php

use JetBrains\PhpStorm\Pure;

/**
 * Convert all applicable characters to HTML entities.
 *
 * @param string|null $text The string
 *
 * @return string The html encoded string
 */
#[Pure] function html(string $text = null): string
{
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function buildTree(
    array $flat,
    string $pidKey = 'parent_id',
    string $idKey = 'id',
    string $sibKey = 'children',
    $parent_id_start = 0
): array
{
    // Группируем по родительским элементам
    // при необходимости в качестве ключей можно выставить id элемента в качестве ключа $sub['id']
    $grouped = [];
    foreach ($flat as $value) {
        $grouped[$value[$pidKey]][] = $value;
    }

    // Воспользуемся функцией высшего порядка вызывая ее на каждом элементе, которая будет рекурсивной
    $fnBuilder = function ($siblings) use (&$fnBuilder, $grouped, $idKey, $sibKey) {
        foreach ($siblings as $k => $sibling) {
            $id = $sibling[$idKey];
            if (isset($grouped[$id])) {
                $sibling[$sibKey] = $fnBuilder($grouped[$id]);
            } else {
                //if ($sibling[$typeKey] == 0) {
                    $sibling[$sibKey] = [];
                //}
            }
            $siblings[$k] = $sibling;
        }
        return $siblings;
    };
    // Вызываем функцию с нужного ключа
    return $fnBuilder($grouped[$parent_id_start]);
}

function buildTreeFromArray(
    array $items,
    string $pidKey = 'parent_id',
    string $idKey = 'id',
    string $childrenKey = 'children',
    string $parent_id_start = '0'
): array {

    $children = [];

    foreach ($items as &$item)
    {
        $children[$item[$pidKey]][] = &$item;
        unset($item);
    }

    foreach ($items as &$item) {
        if (isset($children[$item[$idKey]]))
            $item[$childrenKey] = $children[$item[$idKey]];
    }

    return $children[$parent_id_start];
}

function buildTreeFromArray2($items)
{
    $childs = [];

    foreach ($items as &$item) {
        $childs[$item['parent_id'] ?? 0][] = &$item;
    }

    unset($item);

    foreach ($items as &$item) {
        if (isset($childs[$item['id']])) {
            $item['children'] = $childs[$item['id']];
        }
    }

    return $childs[0] ?? [];
}

function output($arrayTree)
{
    $result = '';
    $function = function ($tree) use (&$function, $result) {
        foreach ($tree as $item => $value) {
            $result .= $value['title'];
            if (isset($value['children'])) {
                $result .= '<ul>' . $function($value['children']) . '</ul>';
            }
            $result .= '</li>';
        }
        return $result;
    };

    return '<ul>' . $function($arrayTree) . '</ul>';
}