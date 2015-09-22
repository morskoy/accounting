<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Гость',
        'bizRule' => null,
        'data' => null
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Пользователь',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'chief' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Начальник',
        'children' => array(
            'user',          // позволим начальнику всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),

    'skd' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Оператор СКД',
        'children' => array(
            'chief',          // позволим СКД всё, что позволено начальнику
        ),
        'bizRule' => null,
        'data' => null
    ),

    'security' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Безопасность',
        'children' => array(
            'skd',          // позволим безопасности всё, что позволено СКД
        ),
        'bizRule' => null,
        'data' => null
    ),
    
	 'director' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Директор',
        'children' => array(
            'security',         // позволим директору всё, что позволено безопасности
        ),
        'bizRule' => null,
        'data' => null
    ),

    'editor' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Редактор',
        'children' => array(
            'director',         // позволим редактору всё, что позволено директору
        ),
        'bizRule' => null,
        'data' => null
    ),

    'administrator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Администратор',
        'children' => array(
            'editor',         // позволим админу всё, что позволено редактору
        ),
        'bizRule' => null,
        'data' => null
    ),
);