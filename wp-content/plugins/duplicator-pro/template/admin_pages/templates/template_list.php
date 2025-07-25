<?php

/**
 * @package Duplicator
 */

defined("ABSPATH") or die("");

use Duplicator\Controllers\ToolsPageController;
use Duplicator\Core\Controllers\ControllersManager;

/**
 * Variables
 *
 * @var Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var Duplicator\Core\Views\TplMng $tplMng
 * @var array<string, mixed> $tplData
 * @var bool $blur
 */

$blur = $tplData['blur'];

$nonce_action = 'duppro-template-list';
$display_edit = false;

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

require(DUPLICATOR____PATH . '/template/admin_pages/templates/deprecate_template_list_action.php');

if (($package_templates = DUP_PRO_Package_Template_Entity::getAllWithoutManualMode()) === false) {
    $package_templates = array();
}
$package_template_count = count($package_templates);
?>
<form 
    id="dup-package-form" 
    class="<?php echo ($blur ? 'dup-mock-blur' : ''); ?>"
    action="<?php echo esc_url($templates_tab_url); ?>" 
    method="post"
>
    <?php wp_nonce_field($nonce_action); ?>
    <input type="hidden" id="dup-package-form-action" name="action" value=""/>
    <input type="hidden" id="dup-package-selected-package-template" name="package_template_id" value="-1"/> 

    <h2><?php esc_html_e('Templates', 'duplicator-pro'); ?></h2>
    <p>
        <?php esc_html_e('Create Backup Templates with Preset Configurations.', 'duplicator-pro'); ?>
    </p>
    <hr>

    <div class="dup-toolbar <?php echo ($blur ? 'dup-mock-blur' : ''); ?>">
        <label for="bulk_action" class="screen-reader-text">Select bulk action</label>
        <select id="bulk_action" class="small" >
            <option value="-1" selected>
                <?php esc_html_e("Bulk Actions", 'duplicator-pro') ?>
            </option>
            <option value="delete" title="Delete selected Backup(s)">
                    <?php esc_html_e("Delete", 'duplicator-pro'); ?>
            </option>
        </select>
        <input 
            type="button"
            id="dup-pack-bulk-apply" 
            class="button hollow secondary small"
            value="<?php esc_attr_e("Apply", 'duplicator-pro') ?>"
            onclick="DupPro.Template.BulkAction()" 
        >
        <span class="separator"></span>
        <?php $tplMng->render('admin_pages/templates/template_create_button'); ?>
    </div>


    <table class="widefat dup-template-list-tbl dup-table-list valign-top">
        <thead>
            <tr>
                <th class="col-check"><input type="checkbox" id="dpro-chk-all" title="Select all Templates" onclick="DupPro.Template.SetDeleteAll(this)"></th>
                <th class="col-name"><?php esc_html_e('Name', 'duplicator-pro'); ?></th>
                <th class="col-recover"><?php esc_html_e('Recovery', 'duplicator-pro'); ?></th>
                <th class="col-empty"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($package_templates as $package_template) :
                $i++;

                $schedules      = DUP_PRO_Schedule_Entity::get_by_template_id($package_template->getId());
                $schedule_count = count($schedules);
                ?>
                <tr class="package-row <?php echo ($i % 2) ? 'alternate' : ''; ?>">
                    <td class="col-check">
                        <?php if ($package_template->is_default == false) : ?>
                            <input name="selected_id[]" type="checkbox" value="<?php echo intval($package_template->getId()); ?>" class="item-chk" />
                        <?php else : ?>
                            <input type="checkbox" disabled />
                        <?php endif; ?>
                    </td>
                    <td class="col-name" >
                        <a 
                            href="javascript:void(0);" 
                            onclick="DupPro.Template.Edit(<?php echo intval($package_template->getId()); ?>);" 
                            class="name" 
                            data-template-id="<?php echo intval($package_template->getId()); ?>"
                        >
                            <?php echo esc_html($package_template->name); ?>
                        </a>
                        <div class="sub-menu">
                            <a 
                                class="dup-edit-template-btn" 
                                href="javascript:void(0);"
                                onclick="DupPro.Template.Edit(<?php echo (int) $package_template->getId(); ?>);" 
                            >
                                <?php esc_html_e('Edit', 'duplicator-pro'); ?>
                            </a> |
                            <a 
                                class="dup-copy-template-btn" 
                                href="javascript:void(0);"
                                onclick="DupPro.Template.Copy(<?php echo (int) $package_template->getId(); ?>);" 
                            >
                                <?php esc_html_e('Copy', 'duplicator-pro'); ?>
                            </a>
                            <?php if ($package_template->is_default == false) : ?>
                                | <a 
                                    class="dup-delete-template-btn" 
                                    href="javascript:void(0);" 
                                    onclick="DupPro.Template.Delete(<?php echo (int) $package_template->getId() ?>, <?php echo (int) $schedule_count; ?>);"
                                    >
                                    <?php esc_html_e('Delete', 'duplicator-pro'); ?>
                                </a>
                            <?php endif; ?>
                        </div>                        
                    </td>
                    <td class="col-recover" >
                        <?php $package_template->recoveableHtmlInfo(true); ?>
                    </td>
                    <td>&nbsp;</td>
                </tr>

            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8" style="text-align:right; font-size:12px">                       
                    <?php echo esc_html__('Total', 'duplicator-pro') . ': ' . (int) $package_template_count; ?>
                </th>
            </tr>
        </tfoot>
    </table>
</form>
<?php
$alert1          = new DUP_PRO_UI_Dialog();
$alert1->title   = __('Bulk Action Required', 'duplicator-pro');
$alert1->message = __('Please select an action from the "Bulk Actions" drop down menu!', 'duplicator-pro');
$alert1->initAlert();

$alert2          = new DUP_PRO_UI_Dialog();
$alert2->title   = __('Selection Required', 'duplicator-pro');
$alert2->message = __('Please select at least one template to delete!', 'duplicator-pro');
$alert2->initAlert();

$confirm1                      = new DUP_PRO_UI_Dialog();
$confirm1->wrapperClassButtons = 'dup-delete-template-dialog-bulk';
$confirm1->title               = __('Delete the selected templates?', 'duplicator-pro');
$confirm1->message             = __('All schedules using this template will be reassigned to the "Default" Template.', 'duplicator-pro');
$confirm1->message            .= '<br/><br/>';
$confirm1->message            .= '<small><i>' . __('Note: This action removes all selected custom templates.', 'duplicator-pro') . '</i></small>';
$confirm1->progressText        = __('Removing Templates, Please Wait...', 'duplicator-pro');
$confirm1->jsCallback          = 'DupPro.Storage.BulkDelete()';
$confirm1->initConfirm();

$confirm2                      = new DUP_PRO_UI_Dialog();
$confirm2->wrapperClassButtons = 'dup-delete-template-dialog-single';
$confirm2->title               = __('Are you sure you want to delete this template?', 'duplicator-pro');
$confirm2->message             = __('All schedules using this template will be reassigned to the "Default" Template.', 'duplicator-pro');
$confirm2->progressText        = $confirm1->progressText;
$confirm2->jsCallback          = 'DupPro.Template.DeleteThis(this)';
$confirm2->initConfirm();
?>
<script>
    jQuery(document).ready(function ($) {

        //Shows detail view
        DupPro.Template.View = function (id) {
            $('#' + id).toggle();
        }

        // Edit template
        DupPro.Template.Edit = function (id) {
            document.location.href = <?php echo wp_json_encode("$edit_template_url&package_template_id="); ?> + id;
        };

        // Copy template
        DupPro.Template.Copy = function (id) {
            <?php
            $params             = array(
                'action=copy-template',
                '_wpnonce=' . wp_create_nonce('duppro-template-edit'),
                'package_template_id=-1',
                'duppro-source-template-id=', // last params get id from js param function
            );
            $edit_template_url .= '&' . implode('&', $params);
            ?>
            document.location.href = <?php echo wp_json_encode($edit_template_url); ?> + id;
        };

        //Delets a single record
        DupPro.Template.Delete = function (id, schedule_count) {
            var message = "";
<?php $confirm2->showConfirm(); ?>
            if (schedule_count > 0)
            {
                message += "<?php esc_html_e('There currently are', 'duplicator-pro') ?>" + " ";
                message += schedule_count + " " + "<?php esc_html_e('schedule(s) using this template.', 'duplicator-pro'); ?>" + "  ";
                message += "<?php esc_html_e('All schedules using this template will be reassigned to the \"Default\" template.', 'duplicator-pro') ?>" + " ";
                $("#<?php echo esc_js($confirm2->getID()); ?>_message").html(message);
            }
            $("#<?php echo esc_js($confirm2->getID()); ?>-confirm").attr('data-id', id);
        }

        DupPro.Template.DeleteThis = function (e) {
            var id = $(e).attr('data-id');
            jQuery("#dup-package-form-action").val('delete');
            jQuery("#dup-package-selected-package-template").val(id);
            jQuery("#dup-package-form").submit();
        }

        //  Creats a comma seperate list of all selected Backup ids
        DupPro.Template.DeleteList = function ()
        {
            var arr = [];

            $("input[name^='selected_id[]']").each(function (i, index) {
                var $this = $(index);

                if ($this.is(':checked') == true) {
                    arr[i] = $this.val();
                }
            });

            return arr.join(',');
        }

        // Bulk Action
        DupPro.Template.BulkAction = function () {
            var list = DupPro.Template.DeleteList();

            if (list.length == 0) {
<?php $alert2->showAlert(); ?>
                return;
            }

            var action = $('#bulk_action').val(),
                    checked = ($('.item-chk:checked').length > 0);

            if (action != "delete") {
<?php $alert1->showAlert(); ?>
                return;
            }

            if (checked)
            {
                switch (action) {
                    default:
<?php $alert2->showAlert(); ?>
                        break;
                    case 'delete':
<?php $confirm1->showConfirm(); ?>
                        break;
                }
            }
        }

        DupPro.Storage.BulkDelete = function ()
        {
            jQuery("#dup-package-form-action").val('bulk-delete');
            jQuery("#dup-package-form").submit();
        }

        //Sets all for deletion
        DupPro.Template.SetDeleteAll = function (chkbox) {
            $('.item-chk').each(function () {
                this.checked = chkbox.checked;
            });
        }
    });
</script>
