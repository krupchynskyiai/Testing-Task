<?php

/**
 * Duplicator Backup row in table Backups list
 *
 * @package   Duplicator
 * @copyright (c) 2022, Snap Creek LLC
 */

use Duplicator\Controllers\SchedulePageController;
use Duplicator\Core\CapMng;

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var \Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var \Duplicator\Core\Views\TplMng  $tplMng
 * @var array<string, mixed> $tplData
 */



if (CapMng::can(CapMng::CAP_SCHEDULE, false)) {
    $scheduleEditBaseURL = SchedulePageController::getInstance()->getEditBaseUrl();
    $tipContent          = __(
        'Create a new Schedule Backup.',
        'duplicator-pro'
    );
    ?>  
    <span
        class="dup-new-package-wrapper"
        data-tooltip="<?php echo esc_attr($tipContent); ?>"
    >
        <a  
            href="<?php echo esc_url($scheduleEditBaseURL); ?>"
            id="dup-pro-create-new" 
            class="button primary tiny font-bold margin-bottom-0"
        >
           <?php esc_html_e('Add New', 'duplicator-pro'); ?>
        </a>
    </span>
     <?php
}