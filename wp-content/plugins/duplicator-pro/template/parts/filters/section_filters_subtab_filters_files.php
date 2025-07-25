<?php

/**
 * @package Duplicator
 */

use Duplicator\Libs\Snap\SnapIO;

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var \Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var \Duplicator\Core\Views\TplMng  $tplMng
 * @var array<string, mixed> $tplData
 * @var bool $isTemplateEdit
 */
$isTemplateEdit = $tplData['isTemplateEdit'];
/** @var ?DUP_PRO_Package_Template_Entity */
$template = (isset($tplData['template']) ? $tplData['template'] : null);

if ($isTemplateEdit && $template != null) {
    $componentsParams = [
        'archiveFilterOn'         => $template->archive_filter_on,
        'archiveFilterDirs'       => $template->archive_filter_dirs,
        'archiveFilterFiles'      => $template->archive_filter_files,
        'archiveFilterExtensions' => $template->archive_filter_exts,
        'components'              => $template->components,
    ];
} else {
    $componentsParams = [
        'archiveFilterOn'         => 0,
        'archiveFilterDirs'       => '',
        'archiveFilterFiles'      => '',
        'archiveFilterExtensions' => '',
        'components'              => [],
    ];
}
?>
<div class="filter-files-tab-content">
    <?php $tplMng->render('parts/filters/package_components', $componentsParams); ?>
    <hr>
    <?php $tplMng->render('parts/filters/section_filters_subtab_filters_db'); ?>
</div>
