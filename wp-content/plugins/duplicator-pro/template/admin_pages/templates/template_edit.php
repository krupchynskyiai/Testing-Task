<?php

/**
 * @package Duplicator
 */

defined("ABSPATH") or die("");

use Duplicator\Controllers\ToolsPageController;
use Duplicator\Core\Controllers\ControllersManager;
use Duplicator\Addons\ProBase\License\License;
use Duplicator\Controllers\SettingsPageController;

use Duplicator\Core\Views\TplMng;
use Duplicator\Libs\Snap\SnapJson;
use Duplicator\Libs\Snap\SnapUtil;
use Duplicator\Models\BrandEntity;

/**
 * Variables
 *
 * @var Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var Duplicator\Core\Views\TplMng $tplMng
 * @var array<string, mixed> $tplData
 * @var bool $blur
 */
$blur = $tplData['blur'];
/** @var DUP_PRO_Package_Template_Entity */
$template = $tplData['template'];

$templates_tab_url = ControllersManager::getMenuLink(
    ControllersManager::TOOLS_SUBMENU_SLUG,
    ToolsPageController::L2_SLUG_TEMPLATE
);
$edit_template_url =  ControllersManager::getMenuLink(
    ControllersManager::TOOLS_SUBMENU_SLUG,
    ToolsPageController::L2_SLUG_TEMPLATE,
    null,
    array('inner_page' => 'edit')
);

$bandListUrl = ControllersManager::getMenuLink(
    ControllersManager::SETTINGS_SUBMENU_SLUG,
    SettingsPageController::L2_SLUG_PACKAGE_BRAND
);

$brandDefaultEditUrl = ControllersManager::getMenuLink(
    ControllersManager::SETTINGS_SUBMENU_SLUG,
    SettingsPageController::L2_SLUG_PACKAGE_BRAND,
    null,
    [
        ControllersManager::QUERY_STRING_INNER_PAGE => SettingsPageController::BRAND_INNER_PAGE_EDIT,
        'action'                                    => 'default',
    ]
);

$brandBaseEditUrl = ControllersManager::getMenuLink(
    ControllersManager::SETTINGS_SUBMENU_SLUG,
    SettingsPageController::L2_SLUG_PACKAGE_BRAND,
    null,
    [
        ControllersManager::QUERY_STRING_INNER_PAGE => SettingsPageController::BRAND_INNER_PAGE_EDIT,
        'action'                                    => 'edit',
    ]
);

$global = DUP_PRO_Global_Entity::getInstance();

$nonce_action = 'duppro-template-edit';

$was_updated = false;
if (($package_templates = DUP_PRO_Package_Template_Entity::getAll()) === false) {
    $package_templates = [];
}
$package_template_count = count($package_templates);

// For now not including in filters since don't want to encourage use
// with schedules since filtering creates incomplete multisite
$displayMultisiteTab = (is_multisite() && License::can(License::CAPABILITY_MULTISITE_PLUS));

$view_state     = DUP_PRO_UI_ViewState::getArray();
$ui_css_archive = (DUP_PRO_UI_ViewState::getValue('dup-template-archive-panel') ? 'display:block' : 'display:none');
$ui_css_install = (DUP_PRO_UI_ViewState::getValue('dup-template-install-panel') ? 'display:block' : 'display:none');


if (!empty($_REQUEST['action'])) {
    DUP_PRO_U::verifyNonce($_REQUEST['_wpnonce'], $nonce_action);
    if ($_REQUEST['action'] == 'save') {
        DUP_PRO_Log::traceObject('request', $_REQUEST);

        // Checkboxes don't set post values when off so have to manually set these
        $template->setFromInput(SnapUtil::INPUT_REQUEST);
        $template->save();
        $was_updated = true;
    } elseif ($_REQUEST['action'] == 'copy-template') {
        $source_template_id = SnapUtil::sanitizeIntInput(SnapUtil::INPUT_REQUEST, 'duppro-source-template-id', -1);

        if ($source_template_id > 0) {
            $template->copy_from_source_id($source_template_id);
            $template->save();
        }
    }
}

$installer_cpnldbaction = $template->installer_opts_cpnl_db_action;
$upload_dir             = DUP_PRO_Archive::getArchiveListPaths('uploads');
$content_path           = DUP_PRO_Archive::getArchiveListPaths('wpcontent');
$archive_format         = ($global->getBuildMode() == DUP_PRO_Archive_Build_Mode::DupArchive ? 'daf' : 'zip');
?>

<form
    id="dpro-template-form"
    class="dup-monitored-form <?php echo ($blur ? 'dup-mock-blur' : ''); ?>"
    data-parsley-validate data-parsley-ui-enabled="true"
    action="<?php echo esc_url($edit_template_url); ?>"
    method="post"
>
    <?php wp_nonce_field($nonce_action); ?>
    <input type="hidden" id="dpro-template-form-action" name="action" value="save">
    <input type="hidden" name="package_template_id" value="<?php echo intval($template->getId()); ?>">

    <!-- ====================
    SUB-TABS -->
    <?php if ($was_updated) : ?>
        <div class="notice notice-success is-dismissible dpro-admin-notice">
            <p>
                <?php esc_html_e('Template Updated', 'duplicator-pro'); ?>
            </p>
        </div>
    <?php endif; ?>

    <?php $tplMng->render('admin_pages/templates/parts/template_edit_toolbar'); ?>

    <div class="dpro-template-general">

        <div>
            <label class="inline-display" >
                <?php esc_html_e("Recovery Status", 'duplicator-pro'); ?>:
            </label>&nbsp;
            <?php $template->recoveableHtmlInfo(); ?> <br/><br/>
        </div>

        <label class="lbl-larger" for="template-name">
            <?php esc_html_e("Template Name", 'duplicator-pro'); ?>:
        </label>
        <input type="text" id="template-name" name="name" data-parsley-errors-container="#template_name_error_container"
            data-parsley-required="true" value="<?php echo esc_attr($template->name); ?>" autocomplete="off" maxlength="125">
        <div id="template_name_error_container" class="duplicator-error-container"></div>

        <?php
        TplMng::getInstance()->render(
            'admin_pages/packages/setup/name-format-controls',
            [
                'nameFormat' => $template->package_name_format,
                'notes'      => $template->notes,
            ]
        );
        ?>
    </div>

    <?php
    $tplMng->render(
        'parts/filters/section_filters',
        [
            'isTemplateEdit' => true,
            'template'       => $template,
        ]
    );

    $tplMng->render(
        'parts/filters/section_installer',
        [
            'activeBrandId' => $template->installer_opts_brand,
            'dbHost'        => $template->installer_opts_db_host,
            'dbName'        => $template->installer_opts_db_name,
            'dbUser'        => $template->installer_opts_db_user,
            'cpnlEnable'    => $template->installer_opts_cpnl_enable,
            'cpnlHost'      => $template->installer_opts_cpnl_host,
            'cpnlUser'      => $template->installer_opts_cpnl_user,
            'cpnlDbAction'  => $template->installer_opts_cpnl_db_action,
            'cpnlDbHost'    => $template->installer_opts_cpnl_db_host,
            'cpnlDbName'    => $template->installer_opts_cpnl_db_name,
            'cpnlDbUser'    => $template->installer_opts_cpnl_db_user,
        ]
    );

    ?>



    <button
        class="button primary small dup-save-template-btn"
        type="submit"
    >
        <?php esc_html_e('Save Template', 'duplicator-pro'); ?>
    </button>
</form>




<?php
$alert1          = new DUP_PRO_UI_Dialog();
$alert1->title   = __('Transfer Error', 'duplicator-pro');
$alert1->message = __('You can\'t exclude all sites!', 'duplicator-pro');
$alert1->initAlert();
?>

<script>
    jQuery(document).ready(function ($) {

        var usedPackageFormats = {};

        /* When installer brand changes preview button is updated */
        DupPro.Template.BrandChange = function ()
        {
            var $brand = $("#installer_opts_brand");
            var $id = $brand.val();
            var $url = new Array();

            $url = [
                <?php echo wp_json_encode($brandDefaultEditUrl); ?>,
                <?php echo wp_json_encode($brandBaseEditUrl); ?> + '&id=' + $id
            ];

            $("#brand-preview").attr('href', $url[ $id > 0 ? 1 : 0 ]);
        };

        /* Enables strike through on excluded DB table */
        DupPro.Template.ExcludeTable = function (check)
        {
            var $cb = $(check);
            if ($cb.is(":checked")) {
                $cb.closest("label").css('textDecoration', 'line-through');
            } else {
                $cb.closest("label").css('textDecoration', 'none');
            }
        }

        /* Used to duplicate a template */
        DupPro.Template.Copy = function ()
        {
            $("#dpro-template-form-action").val('copy-template');
            $("#dpro-template-form").parsley().destroy();
            $("#dpro-template-form").submit();
        };

        //INIT
        $('#template-name').focus().select();
        // $('#_archive_filter_files').val($('#_archive_filter_files').val().trim());
        //Default to cPanel tab if used
        $('#cpnl-enable').is(":checked") ? $('#dpro-cpnl-tab-lbl').trigger("click") : null;
        DupPro.EnableInstallerPassword();
        DupPro.Template.BrandChange();

        //MU-Transfer buttons
        $('#mu-include-btn').click(function () {
            return !$('#mu-exclude option:selected').remove().appendTo('#mu-include');
        });

        $('#mu-exclude-btn').click(function () {
            var include_all_count = $('#mu-include option').length;
            var include_selected_count = $('#mu-include option:selected').length;

            if (include_all_count > include_selected_count) {
                return !$('#mu-include option:selected').remove().appendTo('#mu-exclude');
            } else {
                <?php $alert1->showAlert(); ?>
            }
        });

        $('#dpro-template-form').submit(function () {
            DupPro.Pack.FillExcludeTablesList();
        });

        //Defaults to Installer cPanel tab if 'Auto Select cPanel' is checked
        $('#installer_opts_cpnl_enable').is(":checked") ? $('#dpro-cpnl-tab-lbl').trigger("click") : null;
    });
</script>
