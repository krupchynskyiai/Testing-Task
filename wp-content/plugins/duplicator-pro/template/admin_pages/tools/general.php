<?php

/**
 * @package Duplicator
 */

use Duplicator\Controllers\ToolsPageController;
use Duplicator\Core\CapMng;
use Duplicator\Core\Controllers\ControllersManager;
use Duplicator\Core\MigrationMng;
use Duplicator\Utils\Support\SupportToolkit;

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var Duplicator\Core\Views\TplMng $tplMng
 * @var array<string, mixed> $tplData
 */

$orphaned_filepaths = DUP_PRO_Server::getOrphanedPackageFiles();
$tplMng->render('admin_pages/diagnostics/purge_orphans_message');
$tplMng->render('admin_pages/diagnostics/clean_tmp_cache_message');
$tplMng->render('parts/migration/migration-message');

?>
<form id="dup-tools-form" action="<?php echo ControllersManager::getCurrentLink(); ?>" method="post">
    <h2>
        <?php esc_html_e('General Tools', 'duplicator-pro'); ?>
    </h2>
    <hr>
    
    <div class="dup-settings-wrapper">
        <label class="lbl-larger">
            <?php esc_html_e('Diagnostic Data', 'duplicator-pro'); ?>
        </label>
        <div class="margin-bottom-1" >
            <button 
                type="button" 
                id="download-diagnostic-data-btn" 
                class="dpro-store-fixed-btn button secondary hollow tiny width-small margin-bottom-0" 
                data-url="<?php echo esc_attr(SupportToolkit::getSupportToolkitDownloadUrl()); ?>"
                <?php disabled(!SupportToolkit::isAvailable()); ?>
            >
                <?php esc_html_e('Get Diagnostic Data', 'duplicator-pro'); ?>
            </button>&nbsp;
            <?php if (SupportToolkit::isAvailable()) : ?>
                <?php esc_html_e('Downloads a ZIP archive with all relevant diagnostic information.', 'duplicator-pro'); ?>
            <?php else : ?>
                <i class="fa fa-question-circle data-size-help" data-tooltip-title="Diagnostic Data" data-tooltip="
                <?php esc_attr_e(
                    'It is currently not possible to download the diagnostic data from your system,
                    as the ZipArchive extensions is required to create it.',
                    'duplicator-pro'
                ); ?>" aria-expanded="false">
                </i>
                <?php printf(
                    esc_html__(
                        'If you were asked to include the diagnostic data to a support ticket, 
                        please instead provide available %1$sBackup%2$s, %3$strace%4$s and debug logs.',
                        'duplicator-pro'
                    ),
                    '<a href="' . esc_url(DUPLICATOR_PRO_DUPLICATOR_DOCS_URL . 'how-do-i-read-the-package-build-log/') . '" target="_blank">',
                    '</a>',
                    '<a href="' . esc_url(DUPLICATOR_PRO_DUPLICATOR_DOCS_URL . 'how-do-i-read-the-package-trace-log/') . '" target="_blank">',
                    '</a>'
                ); ?>
            <?php endif; ?>
        </div>
        <label class="lbl-larger">
            <?php esc_html_e('Data Cleanup', 'duplicator-pro'); ?>
        </label>
        <div class="margin-bottom-1" >
            <table class="dpro-reset-opts">
                <tr valign="top">
                    <td>
                        <button 
                            type="button" 
                            class="dpro-store-fixed-btn button secondary hollow tiny width-small margin-bottom-0" 
                            id="dpro-remove-installer-files-btn" 
                            onclick="DupPro.Tools.removeInstallerFiles()"
                        >
                            <?php esc_html_e("Delete Installation Files", 'duplicator-pro'); ?>
                        </button>&nbsp;
                    </td>
                    <td>
                        <?php esc_html_e("Removes all reserved installation files.", 'duplicator-pro'); ?>&nbsp;
                        <i 
                            class="fa-solid fa-question-circle fa-sm dark-gray-color"
                            data-tooltip-title="<?php esc_attr_e("Delete Installation Files", 'duplicator-pro'); ?>"
                            data-tooltip="<?php echo esc_attr($tplMng->render('admin_pages/tools/parts/delete_install_file_tooltip', [], false)); ?>"
                            data-tooltip-width="400"
                        ></i>
                        <div class="maring-bottom-1">&nbsp;</div>
                    </td>
                </tr>
                <?php if (CapMng::can(CapMng::CAP_CREATE, false)) { ?>
                    <tr valign="top">
                        <td>
                            <a 
                                type="button" 
                                class="dpro-store-fixed-btn button secondary hollow tiny width-small margin-bottom-0" 
                                href="<?php echo esc_url(ToolsPageController::getInstance()->getPurgeOrphanActionUrl()); ?>"
                            >
                                <?php esc_html_e("Delete Backup Orphans", 'duplicator-pro'); ?>
                            </a>
                        </td>
                        <td>
                            <?php esc_html_e("Removes all Backup files NOT found in the Backups screen.", 'duplicator-pro'); ?>
                            <i 
                                class="fa-solid fa-question-circle fa-sm dark-gray-color"
                                data-tooltip-title="<?php esc_attr_e("Delete Backup Orphans", 'duplicator-pro'); ?>"
                                data-tooltip="<?php echo esc_attr($tplMng->render('admin_pages/tools/parts/delete_backups_orphans_tooltip', [], false)); ?>"
                                data-tooltip-width="400"
                            ></i>
                            <div class="maring-bottom-1">&nbsp;</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button 
                                type="button" 
                                class="dpro-store-fixed-btn button secondary hollow tiny width-small margin-bottom-0" 
                                onclick="DupPro.Tools.ClearBuildCache()"
                            >
                                <?php esc_html_e("Clear Build Cache", 'duplicator-pro'); ?>
                            </button>&nbsp;
                        </td>
                        <td>
                            <?php esc_html_e('Removes all build data from:', 'duplicator-pro'); ?>&nbsp;
                            <b><?php echo esc_html(DUPLICATOR_PRO_SSDIR_PATH_TMP); ?></b>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php $tplMng->render('admin_pages/tools/general_validator'); ?>
    </div>
</form>
<?php
$deleteOptConfirm               = new DUP_PRO_UI_Dialog();
$deleteOptConfirm->title        = __('Are you sure you want to delete?', 'duplicator-pro');
$deleteOptConfirm->message      = __('Delete this option value.', 'duplicator-pro');
$deleteOptConfirm->progressText = __('Removing, Please Wait...', 'duplicator-pro');
$deleteOptConfirm->jsCallback   = 'DupPro.Settings.DeleteThisOption(this)';
$deleteOptConfirm->initConfirm();

$removeCacheConfirm               = new DUP_PRO_UI_Dialog();
$removeCacheConfirm->title        = __('This process will remove all build cache files.', 'duplicator-pro');
$removeCacheConfirm->message      = __('Be sure no Backups are currently building or else they will be cancelled.', 'duplicator-pro');
$removeCacheConfirm->progressText = $deleteOptConfirm->progressText;
$removeCacheConfirm->jsCallback   = 'DupPro.Tools.ClearBuildCacheRun()';
$removeCacheConfirm->initConfirm();
?>
<script>
    jQuery(document).ready(function($) {
        DupPro.Tools.removeInstallerFiles = function() {
            window.location = <?php echo json_encode(ToolsPageController::getInstance()->getCleanFilesAcrtionUrl()); ?>;
            return false;
        };

        DupPro.Tools.ClearBuildCache = function() {
            <?php $removeCacheConfirm->showConfirm(); ?>
        };

        DupPro.Tools.ClearBuildCacheRun = function() {
            window.location = <?php echo json_encode(ToolsPageController::getInstance()->getRemoveCacheActionUrl()); ?>;
        };

        $('#download-diagnostic-data-btn').click(function() {
            window.location = $(this).data('url');
        });
    });
</script>