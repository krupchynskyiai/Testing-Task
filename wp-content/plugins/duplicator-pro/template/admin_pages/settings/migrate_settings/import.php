<?php

/**
 * @package Duplicator
 */

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var Duplicator\Core\Views\TplMng $tplMng
 * @var array<string, mixed> $tplData
 */

$view_state          = DUP_PRO_UI_ViewState::getArray();
$ui_css_export_panel = (isset($view_state['dpro-tools-export-panel']) && $view_state['dpro-tools-export-panel']) ? 'display:block' : 'display:block';
?>
<form 
    enctype="multipart/form-data" 
    id="dup-tools-form-import" 
    action="<?php echo esc_url($ctrlMng->getCurrentLink()); ?>" 
    method="post" data-parsley-validate data-parsley-ui-enabled="true" 
>
    <?php wp_nonce_field('dpro_tools_data_import'); ?>
    <input type="hidden"  name="action" value="dpro-import">
    <div class="dup-settings-wrapper margin-bottom-1" >
        <h3 class="title">
            <?php esc_html_e("Import Settings", 'duplicator-pro') ?>
        </h3>
        <hr size="1" />
        <p class="width-xxlarge" >
            <?php
            esc_html_e(
                'Import settings from another Duplicator Pro plugin into this instance of Duplicator Pro. 
                Schedule, storage and template data will be appended to current data, while existing settings will be replaced. 
                For security reasons, capabilities, license data and license visibility will not be imported. 
                Schedules depend on storage and templates so importing schedules will require that storage and templates be checked.',
                'duplicator-pro'
            );
            ?>
        </p>
        <label class="lbl-larger">
            <?php esc_html_e("Import Settings File", 'duplicator-pro'); ?>
        </label>
        <div class="margin-bottom-1" >
            <input type="file" accept=".dup" name="import-file" id="import-file" required="true" class="margin-0" >
        </div>
        <label class="lbl-larger">
            <?php esc_html_e("Include in Import", 'duplicator-pro'); ?>
        </label>
        <div class="margin-bottom-1" >
            <table class="dpro-check-tbl margin-bottom-1">
                <tr>
                    <td>
                        <input 
                            onclick="DupPro.Tools.ChangeImportButtonState();DupPro.Tools.SchedulesClicked();" 
                            type="checkbox" 
                            name="import-opts[]" 
                            id="import-schedules" value="schedules" 
                            class="margin-0"
                        >
                        <label for="import-schedules">
                            <?php esc_html_e("Schedules", 'duplicator-pro'); ?>
                        </label>
                    </td>
                    <td>
                        <input 
                            onclick="DupPro.Tools.ChangeImportButtonState();" 
                            type="checkbox" 
                            name="import-opts[]" 
                            id="import-storages" value="storages" 
                            class="margin-0"
                        >
                        <label for="import-storages">
                            <?php esc_html_e("Storage", 'duplicator-pro'); ?>
                        </label>
                    </td>
                    <td>
                        <input 
                            onclick="DupPro.Tools.ChangeImportButtonState();"
                            type="checkbox"
                            name="import-opts[]"
                            id="import-templates" value="templates" 
                            class="margin-0"
                        >
                        <label for="import-templates">
                            <?php esc_html_e("Templates", 'duplicator-pro'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input 
                            onclick="DupPro.Tools.ChangeImportButtonState();" 
                            type="checkbox" 
                            name="import-opts[]" 
                            id="import-settings"
                            value="settings" 
                            class="margin-0"
                        >
                        <label for="import-settings">
                            <?php esc_html_e("Settings", 'duplicator-pro'); ?>
                        </label>
                    </td>
                </tr>
            </table>
            <input
                id="import-button" 
                type="button" 
                class="button primary small" 
                value="<?php esc_attr_e("Import Data", 'duplicator-pro'); ?>" 
                onclick="return DupPro.Tools.ImportDialog();" disabled
            >
        </div>
    </div>
</form>

<div id="modal-window-import" style="display:none;">
    <p>
        <?php esc_html_e("This process will:", 'duplicator-pro') ?><br/>
        <i class="far fa-check-circle"></i>
        <?php esc_html_e("Append schedules, storage and templates if those options are checked.", 'duplicator-pro'); ?> <br/>      
        <i class="far fa-check-circle"></i> 
        <?php esc_html_e("Overwrite current settings data if the settings option is checked.", 'duplicator-pro'); ?> <br/>
        <span style="color:#BB1506">
            <i class="fas fa-exclamation-triangle fa-sm"></i> 
            <?php esc_html_e("Review templates and local storages after import to ensure correct path values.", 'duplicator-pro'); ?>
        </span>
    </p>
    <div class="float-right" >
        <input 
            type="button" 
            class="button secondary hollow small" 
            value="<?php esc_attr_e("Cancel", 'duplicator-pro') ?>" 
            onclick="tb_remove();" 
        >&nbsp;
        <input 
            type="button" 
            class="button primary small" 
            value="<?php esc_attr_e("Run Import", 'duplicator-pro') ?>" 
            onclick="DupPro.Tools.ImportProcess();" 
            title="<?php esc_attr_e("Process the Import File.", 'duplicator-pro') ?>"
        >
    </div>
</div>

<script>
DupPro.Tools.ImportProcess = function () 
{
    jQuery('#dup-tools-form-import').submit();
}

DupPro.Tools.ImportDialog = function () 
{
    var url = "#TB_inline?width=610&height=300&inlineId=modal-window-import";
    tb_show("<?php esc_html_e("Import Duplicator Pro Data?", 'duplicator-pro') ?>", url);
    jQuery('#TB_window').addClass(<?php echo json_encode(DUP_PRO_UI_Dialog::TB_WINDOW_CLASS); ?>);
    return false;
}   

//PAGE INIT
jQuery(document).ready(function ($) 
{
    DupPro.Tools.ChangeImportButtonState = function()
    {
        var filename = $('#import-file').val();
        var disabled = (filename == '');

        disabled = disabled || 
            (
                !document.getElementById('import-templates').checked && 
                !document.getElementById('import-storages').checked && 
                !document.getElementById('import-schedules').checked && 
                !document.getElementById('import-settings').checked
            );

        $('#import-button').prop('disabled', disabled);
    }

    DupPro.Tools.SchedulesClicked = function()
    {
        if(document.getElementById('import-schedules').checked)
        {
            document.getElementById('import-templates').checked = true;
            document.getElementById('import-storages').checked = true;
            document.getElementById('import-templates').disabled = true;
            document.getElementById('import-storages').disabled = true;
        }
        else {
            document.getElementById('import-templates').disabled = false;
            document.getElementById('import-storages').disabled = false;
        }
    }

    $("#dpro-tools-import-panel").on("change", "#import-file", function() { DupPro.Tools.ChangeImportButtonState(); });
});
</script>
