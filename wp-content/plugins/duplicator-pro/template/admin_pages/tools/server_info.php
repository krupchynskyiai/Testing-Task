<?php

/**
 * @package Duplicator
 */

use Duplicator\Libs\Snap\SnapUtil;

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var Duplicator\Core\Views\TplMng $tplMng
 * @var array<string, mixed> $tplData
 */

ob_start();
SnapUtil::phpinfo();
$serverinfo = preg_replace('/.*<body>(.*?)<\/body>.*/s', '$1', ob_get_clean());

?>
<div class="dup-tool-server-info">
    <h2>
        <?php esc_html_e('Server Settings', 'duplicator-pro'); ?>
    </h2>
    <hr>
    <?php
    $tplMng->render(
        'parts/tools/server_settings_table',
        [
            'serverSettings' => DUP_PRO_Server::getServerSettingsData(),
        ]
    );
    ?>
    <hr>
    <div id='dpro-phpinfo'>
        <?php echo $serverinfo; ?>
    </div>
</div>
