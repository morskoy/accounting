<?php
/**
 * Created by JetBrains PhpStorm.
 * User: cony
 * Date: 12.04.13
 * Time: 8:10
 * To change this template use File | Settings | File Templates.
 */
'nn'=> array(
    'name' => 'nn',
    'value' => function($data, $row, $column) {
        /** @var $grid CGridView */
        $grid = $column->grid;
        /** @var $pages CPagination */
        $pages = $grid->dataProvider->getPagination();

        $start = ($grid->enablePagination === false)
            ? 0
            : $pages->getCurrentPage(false) * $pages->getPageSize();

        return $start + $row + 1;
    },
),
