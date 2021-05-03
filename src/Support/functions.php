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
    int $parent_id_start = 0
): array {

    $children = [];

    foreach ($items as &$item)
    {
        $children[$item[$pidKey]][] = &$item;
        unset($item);
    }

    foreach ($items as &$item) {
        if (isset($children[$item[$idKey]])){
            $item[$childrenKey] = $children[$item[$idKey]];
        }
    }

    return $children[$parent_id_start];
}

function generate_data($max = 100): array
{
    $array = [];
    $test = [];
    $parent = 0;

    for ($i = 1, $e = 0; $i <= $max; $i ++, $e ++) {

        // random parent
        switch (mt_rand(1, 4)) {
            default:
            case 1:
                $parent = 0;
                break;
            case 2:
                $parent = ceil($e / 2);
                break;
            case 3:
                $parent = ceil($e / 3);
                break;
            case 4:
                $parent = mt_rand(1, $max);
                break;
        }

        $test['id'] = $i;
        $test['title'] = 'tree_test_'.$i;
        $test['parent'] = $parent;

        $array[] = $test;
        unset($test);
    }

    return $array;
}