<?php

/**
 * @package Duplicator
 */

use Duplicator\Utils\Help\Help;
use Duplicator\Libs\Snap\SnapJson;

defined("ABSPATH") || exit;

/**
 * Variables
 *
 * @var \Duplicator\Core\Views\TplMng  $tplMng
 * @var array<string, mixed> $tplData
 */

$helpPageUrl = SnapJson::jsonEncode(Help::getHelpPageUrl());
?>
<div id="dup-meta-screen" class="dup-styles"></div>
<div class="dup-header dup-styles">
    <img src="<?php echo esc_url(DUPLICATOR_PRO_PLUGIN_URL . 'assets/img/duplicator-header-logo.svg'); ?>" alt="Duplicator Logo" >
    <a class="dup-global-help" >
        <i class="fa fa-question-circle  fa-sm"></i> <?php esc_html_e('Help', 'duplicator-pro'); ?>
    </a>
</div>
<script>
    jQuery(document).ready(function ($) {
        $('.dup-global-help').click(function () { 
            if (Duplicator.Help.isDataLoaded()) {
                Duplicator.Help.Display();
            } else {
                Duplicator.Help.Load('<?php echo esc_url_raw($helpPageUrl); ?>');
            }
        });
    });
</script>
