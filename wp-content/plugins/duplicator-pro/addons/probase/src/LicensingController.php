<?php

/**
 * Version Pro Base functionalities
 *
 * Name: Duplicator PRO base
 * Version: 1
 * Author: Snap Creek
 * Author URI: http://snapcreek.com
 *
 * @package   Duplicator
 * @copyright (c) 2022, Snap Creek LLC
 */

namespace Duplicator\Addons\ProBase;

use DUP_PRO_Log;
use Duplicator\Core\Controllers\ControllersManager;
use Duplicator\Addons\ProBase\License\License;
use Duplicator\Addons\ProBase\Models\LicenseData;
use Duplicator\Controllers\SettingsPageController;
use Duplicator\Core\CapMng;
use Duplicator\Core\Controllers\PageAction;
use Duplicator\Core\Views\TplMng;
use Duplicator\Libs\Snap\SnapUtil;
use Duplicator\Libs\Snap\SnapWP;
use Duplicator\Views\AdminNotices;
use Exception;

class LicensingController
{
    //License actions
    const ACTION_ACTIVATE_LICENSE   = 'activate_license';
    const ACTION_DEACTIVATE_LICENSE = 'deactivate_license';
    const ACTION_CHANGE_VISIBILITY  = 'change_visibility';
    const ACTION_CLEAR_KEY          = 'clear_key';
    const ACTION_FORCE_REFRESH      = 'force_refresh';

    const LICENSE_KEY_OPTION_AUTO_ACTIVE = 'duplicator_pro_license_auto_active';

    /**
     * License controller init
     *
     * @return void
     */
    public static function init()
    {
        add_action('admin_init', array(__CLASS__, 'licenseAutoActive'));
        add_action('admin_init', array(__CLASS__, 'forceUpgradeCheckAction'));
        //add_action('duplicator_render_page_content_' . ControllersManager::SETTINGS_SUBMENU_SLUG, array(__CLASS__, 'renderLicenseContent'), 10, 2);
        add_action('duplicator_settings_general_before', array(__CLASS__, 'renderLicenseContent'));
        add_filter('duplicator_page_actions_' . ControllersManager::SETTINGS_SUBMENU_SLUG, array(__CLASS__, 'pageActions'));
        add_filter('duplicator_template_file', array(__CLASS__, 'getTemplateFile'), 10, 2);
    }

    /**
     * Method call on admin_init hook
     *
     * @return void
     */
    public static function licenseAutoActive()
    {
        if (($lKey = get_option(self::LICENSE_KEY_OPTION_AUTO_ACTIVE, false)) === false) {
            return;
        }
        if (!CapMng::getInstance()->can(CapMng::CAP_LICENSE)) {
            return;
        }
        if (($action = SettingsPageController::getInstance()->getActionByKey(self::ACTION_ACTIVATE_LICENSE)) == false) {
            return;
        }
        delete_option(self::LICENSE_KEY_OPTION_AUTO_ACTIVE);
        $redirect = $action->getUrl(['_license_key' => $lKey]);
        if (wp_safe_redirect($redirect)) {
            exit;
        } else {
            throw new Exception(__('Error redirecting to license activation page', 'duplicator-pro'));
        }
    }

    /**
     * Return force upgrade check URL
     *
     * @return string
     */
    public static function getForceUpgradeCheckURL()
    {
        return SnapWP::adminUrl('update-core.php', ['force-check' => 1]);
    }


    /**
     * Force upgrade check action
     *
     * @return void
     */
    public static function forceUpgradeCheckAction()
    {
        global $pagenow;

        if ($pagenow !== 'update-core.php') {
            return;
        }

        if (!SnapUtil::sanitizeBoolInput(SnapUtil::INPUT_REQUEST, 'force-check')) {
            return;
        }

        License::forceUpgradeCheck();
    }

    /**
     * Define actions related to the license
     *
     * @param PageAction[] $actions Page actions array from filter
     *
     * @return PageAction[] Updated page actions array
     */
    public static function pageActions($actions)
    {
        $actions[] = new PageAction(
            self::ACTION_ACTIVATE_LICENSE,
            array(
                __CLASS__,
                'activateLicense',
            ),
            array(ControllersManager::SETTINGS_SUBMENU_SLUG)
        );
        $actions[] = new PageAction(
            self::ACTION_DEACTIVATE_LICENSE,
            array(
                __CLASS__,
                'deactivateLicense',
            ),
            array(ControllersManager::SETTINGS_SUBMENU_SLUG)
        );
        $actions[] = new PageAction(
            self::ACTION_CLEAR_KEY,
            array(
                __CLASS__,
                'clearLicenseKeyAction',
            ),
            array(ControllersManager::SETTINGS_SUBMENU_SLUG)
        );
        $actions[] = new PageAction(
            self::ACTION_CHANGE_VISIBILITY,
            array(
                __CLASS__,
                'changeLicenseVisibility',
            ),
            array(ControllersManager::SETTINGS_SUBMENU_SLUG)
        );
        $actions[] = new PageAction(
            self::ACTION_FORCE_REFRESH,
            array(
                __CLASS__,
                'forceRefresh',
            ),
            array(ControllersManager::SETTINGS_SUBMENU_SLUG)
        );

        return $actions;
    }

    /**
     * Action that changes the license visibility
     *
     * @return array<string, mixed>
     */
    public static function changeLicenseVisibility()
    {
        $result  = array(
            'license_success' => false,
            'license_message' => '',
        );
        $global  = \DUP_PRO_Global_Entity::getInstance();
        $sglobal = \DUP_PRO_Secure_Global_Entity::getInstance();

        $oldVisibility = $global->license_key_visible;
        $newVisibility = filter_input(INPUT_POST, 'license_key_visible', FILTER_VALIDATE_INT);
        $newPassword   = SnapUtil::sanitizeInput(INPUT_POST, '_key_password', '');

        if ($oldVisibility === $newVisibility) {
            return $result;
        }

        switch ($newVisibility) {
            case License::VISIBILITY_ALL:
                if ($sglobal->lkp !== $newPassword) {
                    $result['license_message'] = __("Wrong password entered. Please enter the correct password.", 'duplicator-pro');
                    return $result;
                }
                $newPassword = ''; // reset password
                break;
            case License::VISIBILITY_NONE:
            case License::VISIBILITY_INFO:
                if ($oldVisibility == License::VISIBILITY_ALL) {
                    $password_confirmation = SnapUtil::sanitizeInput(INPUT_POST, '_key_password_confirmation', '');

                    if (strlen($newPassword) === 0) {
                        $result['license_message'] = __('Password cannot be empty.', 'duplicator-pro');
                        return $result;
                    }

                    if ($newPassword !== $password_confirmation) {
                        $result['license_message'] = __("Passwords don't match.", 'duplicator-pro');
                        return $result;
                    }
                } else {
                    if ($sglobal->lkp !== $newPassword) {
                        $result['license_message'] = __("Wrong password entered. Please enter the correct password.", 'duplicator-pro');
                        return $result;
                    }
                }
                break;
            default:
                throw new Exception(__('Invalid license visibility value.', 'duplicator-pro'));
        }

        $global->license_key_visible = $newVisibility;
        $sglobal->lkp                = $newPassword;

        if ($global->save() && $sglobal->save()) {
            return array(
                'license_success' => true,
                'license_message' => __("License visibility changed", 'duplicator-pro'),
            );
        } else {
            return array(
                'license_success' => false,
                'license_message' => __("Couldn't change licnse vilisiblity.", 'duplicator-pro'),
            );
        }
    }

    /**
     * Action that clears the license key
     *
     * @return array<string, mixed>
     */
    public static function clearLicenseKeyAction()
    {
        LicenseData::resetLastRequestFailure();
        $result = self::clearLicenseKey();
        LicenseData::resetLastRequestFailure();
        return $result;
    }


    /**
     * Action that clears the license key
     *
     * @return array<string, mixed>
     */
    protected static function clearLicenseKey()
    {
        $global  = \DUP_PRO_Global_Entity::getInstance();
        $sglobal = \DUP_PRO_Secure_Global_Entity::getInstance();

        LicenseData::getInstance()->setKey('');
        License::clearVersionCache();

        $global->license_key_visible = License::VISIBILITY_ALL;
        $sglobal->lkp                = '';

        if ($global->save() && $sglobal->save()) {
            return array(
                'license_success' => true,
                'license_message' => __("License key cleared", 'duplicator-pro'),
            );
        } else {
            return array(
                'license_success' => false,
                'license_message' => __("Couldn't save changes", 'duplicator-pro'),
            );
        }
    }

    /**
     * Action that deactivates the license
     *
     * @return array<string, mixed>
     */
    public static function deactivateLicense()
    {
        $result = array(
            'license_success' => true,
            'license_message' => __("License Deactivated", 'duplicator-pro'),
        );

        try {
            $lData = LicenseData::getInstance();

            if ($lData->getStatus() !== LicenseData::STATUS_VALID) {
                $result = array(
                    'license_success' => true,
                    'license_message' => __('License already deactivated.', 'duplicator-pro'),
                );
                return $result;
            }

            switch ($lData->deactivate()) {
                case LicenseData::ACTIVATION_RESPONSE_OK:
                    break;
                case LicenseData::ACTIVATION_RESPONSE_INVALID:
                    throw new Exception(__('Invalid license key.', 'duplicator-pro'));
                case LicenseData::ACTIVATION_REQUEST_ERROR:
                    $result['license_request_error'] = $lData->getLastRequestError();
                    throw new Exception(self::getRequestErrorMessage());
                default:
                    throw new Exception(__('Error activating license.', 'duplicator-pro'));
            }
        } catch (Exception $e) {
            $result['license_success'] = false;
            $result['license_message'] = $e->getMessage();
        }

        return $result;
    }

    /**
     * Return template file path
     *
     * @param string $path    path to the template file
     * @param string $slugTpl slug of the template
     *
     * @return string
     */
    public static function getTemplateFile($path, $slugTpl)
    {
        if (strpos($slugTpl, 'licensing/') === 0) {
            return ProBase::getAddonPath() . '/template/' . $slugTpl . '.php';
        }
        return $path;
    }

    /**
     * Action that activates the license
     *
     * @return array<string, mixed>
     */
    public static function activateLicense()
    {
        $result = array(
            'license_success' => true,
            'license_message' => __("License Activated", 'duplicator-pro'),
        );

        try {
            if (($licenseKey = SnapUtil::sanitizeDefaultInput(SnapUtil::INPUT_REQUEST, '_license_key')) === false) {
                throw new Exception(__('Please enter a valid key. Key should be 32 characters long.', 'duplicator-pro'));
            }

            if (!preg_match('/^[a-f0-9]{32}$/i', $licenseKey)) {
                throw new Exception(__('Please enter a valid key. Key should be 32 characters long.', 'duplicator-pro'));
            }
            $lData = LicenseData::getInstance();
            // make sure reset old license key if exists
            self::clearLicenseKey();
            $lData->setKey($licenseKey);

            switch ($lData->activate()) {
                case LicenseData::ACTIVATION_RESPONSE_OK:
                    break;
                case LicenseData::ACTIVATION_RESPONSE_INVALID:
                    throw new Exception(__('Invalid license key.', 'duplicator-pro'));
                case LicenseData::ACTIVATION_REQUEST_ERROR:
                    $result['license_request_error'] = $lData->getLastRequestError();
                    DUP_PRO_Log::traceObject('License request error', $result['license_request_error']);
                    throw new Exception(self::getRequestErrorMessage());
                default:
                    throw new Exception(__('Error activating license.', 'duplicator-pro'));
            }
        } catch (Exception $e) {
            $result['license_success'] = false;
            $result['license_message'] = $e->getMessage();
        }

        return $result;
    }

    /**
     * Force a refresh of the license data action
     *
     * @return array<string,mixed>
     */
    public static function forceRefresh()
    {
        $result = array(
            'license_success' => true,
            'license_message' => __("License data reloaded.", 'duplicator-pro'),
        );

        try {
            $lData = LicenseData::getInstance();
            $lData->clearCache();
            $lData->resetLastRequestFailure();
            $lData->getLicenseData();
        } catch (Exception $e) {
            $result['license_success'] = false;
            $result['license_message'] = $e->getMessage();
        }

        return $result;
    }

    /**
     * Render page content
     *
     * @return void
     */
    public static function renderLicenseContent()
    {
        if (!CapMng::getInstance()->can(CapMng::CAP_LICENSE, false)) {
            return;
        }
        self::renderLicenseMessage();
        TplMng::getInstance()->render('licensing/main');
    }

    /**
     * Render activation/deactivation license message
     *
     * @return void
     */
    protected static function renderLicenseMessage()
    {
        if (!CapMng::getInstance()->can(CapMng::CAP_LICENSE, false)) {
            return;
        }

        $tplData = TplMng::getInstance()->getGlobalData();
        if (empty($tplData['license_message'])) {
            return;
        }

        $success = (isset($tplData['license_success']) && $tplData['license_success'] === true);
        AdminNotices::displayGeneralAdminNotice(
            TplMng::getInstance()->render('licensing/notices/activation_message', [], false),
            ($success ? AdminNotices::GEN_SUCCESS_NOTICE : AdminNotices::GEN_ERROR_NOTICE),
            false,
            [],
            [],
            true
        );
    }

    /**
     * Returns the communication error message
     *
     * @return string
     */
    private static function getRequestErrorMessage()
    {
        $result  = '<b>' . __('License data request failed.', 'duplicator-pro') . '</b>';
        $result .= '<br>';
        $result .= sprintf(
            _x(
                'Please see %1$sthis FAQ entry%2$s for possible causes and resolutions.',
                '%1$s and %2$s represents the opening and closing HTML tags for an anchor or link',
                'duplicator-pro'
            ),
            '<a href="' . DUPLICATOR_PRO_DUPLICATOR_DOCS_URL . 'how-to-resolve-license-activation-issues/" target="_blank">',
            '</a>'
        );
        return $result;
    }
}
