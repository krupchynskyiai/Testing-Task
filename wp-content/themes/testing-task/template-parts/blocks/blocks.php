<?php
function testing_task_register_blocks() {
    error_log('=== РЕЄСТРАЦІЯ БЛОКІВ ==='); // перевір у wp-content/debug.log

    $blocks = [
        'catalog',
    ];

    foreach ($blocks as $block_name) {
        $block_path = __DIR__ . '/' . $block_name;
        error_log('Реєструємо блок за шляхом: ' . $block_path);
        register_block_type($block_path);
    }
}
