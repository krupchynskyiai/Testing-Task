<?php
function acf_blocks_init() {
  acf_register_block_type(
      array(
          'name' => 'hero',
          'title' => __('Hero'),
          'description' => __('Hero banner'),
          'render_template' => 'template-parts/blocks/hero/block.php',
          'icon' => 'cover-image',
          'keywords' => array('top banner', 'hero', 'block'),
          'mode' => 'edit',
          'supports' => array('mode' => false),
      )
  );

  acf_register_block_type(
      array(
          'name' => 'filters',
          'title' => __('Filters'),
          'description' => __('Filters'),
          'render_template' => 'template-parts/blocks/filters/block.php',
          'icon' => 'cover-image',
          'keywords' => array('filters', 'block'),
          'mode' => 'edit',
          'supports' => array('mode' => false),
      )
  );

  acf_register_block_type(
      array(
          'name' => 'list',
          'title' => __('List'),
          'description' => __('List'),
          'render_template' => 'template-parts/blocks/list/block.php',
          'icon' => 'cover-image',
          'keywords' => array('list', 'block'),
          'mode' => 'edit',
          'supports' => array('mode' => false),
      )
  );
}