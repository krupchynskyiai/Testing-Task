<?php

/**
 * @package   Duplicator
 * @copyright (c) 2022, Snap Creek LLC
 */

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var \Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var \Duplicator\Core\Views\TplMng  $tplMng
 * @var array<string, mixed> $tplData
 */
?> 

<div class="dup-pro-tab-content-wrapper" >
    <div id="dup-pro-import-phase-one" >
        <?php $tplMng->render('admin_pages/import/step1/import-step1'); ?>
    </div>
    <div id="dup-pro-import-phase-two" class="no-display" >
        <?php $tplMng->render('admin_pages/import/import-step2'); ?>
    </div>
</div>
<?php
require_once DUPLICATOR____PATH . '/views/tools/recovery/widget/recovery-widget-scripts.php';

$tplMng->render('admin_pages/import/import-scripts');
