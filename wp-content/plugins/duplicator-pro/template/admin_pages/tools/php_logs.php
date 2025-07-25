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

if (isset($_POST['clear_log']) && $_POST['clear_log'] == 'true') {
    DUP_PRO_PHP_Log::clear_log();
}

$refresh = (isset($_POST['refresh']) && $_POST['refresh'] == 1) ? 1 : 0;
$auto    = (isset($_POST['auto']) && $_POST['auto'] == 1) ? 1 : 0;
$filter  = (isset($_POST['filter'])) ? $_POST['filter'] : '';

$error = false;

$lines = 200;

$log_path  = DUP_PRO_PHP_Log::get_path(null, true);
$error_log = DUP_PRO_PHP_Log::get_log($lines, "M d, H:i:s");

$log_path_size = 0;
if ($log_path !== false) {
    $log_path_size = @filesize($log_path);

    if (!is_readable($log_path)) {
        $error = sprintf(
            __(
                "PHP error log is available on location %s but is not readable. Try setting the permissions to 755.",
                'duplicator-pro'
            ),
            '<b>' . esc_html($log_path) . '</b>'
        );
    } elseif ($error_log === false) {
        if ($log_path > (PHP_INT_MAX / 2)) {
            $error = sprintf(
                __(
                    "PHP error log is available on location %1\$s but can't be read because file size is over %2\$s. You must open this file manualy.",
                    'duplicator-pro'
                ),
                '<b>' . esc_html($log_path) . '</b>',
                '<b>' . DUP_PRO_U::byteSize($log_path_size) . '</b>'
            );
        } else {
            $error = sprintf(
                __(
                    "PHP error log is available on location %s but can't be read because some unexpected error. 
                    Try to open file manually and investigate all problems what can cause this error.",
                    'duplicator-pro'
                ),
                '<b>' . esc_html($log_path) . '</b>'
            );
        }
    } else {
    }
} else {
    $error = __('This can be good for you because there is no errors.', 'duplicator-pro') . '<br><br>';

    $error .= sprintf(
        _x(
            'But if you in any case experience some errors and not see log here, 
            that mean your error log file is placed on some unusual location or can\'t be created because some %1$s setup. 
            In that case you must open %2$s file and define %3$s or call your system administrator to setup it properly.',
            '1 and 2 stand for the word "php.ini", 3 stands for the word "error_log"',
            'duplicator-pro'
        ),
        "<b><i>php.ini</i></b>",
        "<b><i>php.ini</i></b>",
        "<code>error_log</code>"
    ) .
             '<br><br>';

    $error .= sprintf(
        __(
            'It would be great if you define new error log path to be inside root of your WordPress 
            installation ( %1$s ) and name of file to be %2$s. That will solve this problem.',
            'duplicator-pro'
        ),
        '<i><b>' . duplicator_pro_get_home_path() . '</b></i>',
        '<b>error.log</b>'
    );
}
?>
<div id="dup-tool-php-logs-wrapper">
    <?php if ($error) : ?>
        <h2><?php
        if ($log_path !== false) {
            esc_html_e("Log file is found but have error or is unreadable", 'duplicator-pro');
        } else {
            esc_html_e("PHP error log not found", 'duplicator-pro');
        }
        ?></h2>
        <?php echo $error; ?>
    <?php else : ?>
    <table id="dpro-log-pnls">
        <tr>
            <td id="dpro-log-pnl-left">
                <div class="name"><i class="fas fa-file-contract fa-fw"></i> <?php echo esc_html($log_path); ?></div>
                <div class="opts">
                    <a href="javascript:void(0)" id="dup-options">
                        <?php esc_html_e('Options', 'duplicator-pro'); ?> <i class="fa fa-angle-double-right"></i>
                    </a> &nbsp;</div>
                <div id="tableContainer" class="tableContainer">
                    <table class="wp-list-table fixed striped" id="error-log">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%; text-align: center"><?php esc_html_e('Date', 'duplicator-pro'); ?></th>
                                <th scope="col" style="width: 8%; text-align: center"><?php esc_html_e('Type', 'duplicator-pro'); ?></th>
                                <th scope="col" style="width: 34%;"><?php esc_html_e('Error', 'duplicator-pro'); ?></th>
                                <th scope="col" style="width: 30%;"><?php esc_html_e('File', 'duplicator-pro'); ?></th>
                                <th scope="col" style="width: 6%;"><?php esc_html_e('Line', 'duplicator-pro'); ?></th>
                            </tr>
                        </thead>
                        <tbody id="the-list"<?php echo (count($error_log) === 0) ? ' style="overflow: hidden;"' : ''; ?>>
                            <?php if (count($error_log) === 0) : ?>
                                <tr>
                                    <td colspan="5">
                                        <h3><?php esc_html_e('PHP Error Log is empty.', 'duplicator-pro'); ?></h3>
                                    </td>
                                </tr>
                            <?php else : ?>
                                <?php foreach ($error_log as $line => $log) : ?>
                                <tr>
                                    <td scope="col" >
                                        <b class="info" title="<?php echo date("Y-m-d H:i:s T (P)", strtotime($log['dateTime'])); ?>">
                                            <?php echo esc_html($log['dateTime']); ?>
                                        </b>
                                    </td>
                                    <td scope="col" ><?php echo esc_html($log['type']); ?></td>
                                    <td scope="col" >
                                        <?php echo esc_html($log['message']); ?>
                                        <?php if (count($log['stackTrace']) > 0) : ?>
                                        <ul>
                                            <li class="title"><?php esc_html_e('Stack trace:', 'duplicator-pro'); ?></li>
                                            <?php foreach ($log['stackTrace'] as $i => $trace) : ?>
                                            <li><b>#<?php echo esc_html($i); ?></b> <?php echo esc_html($trace); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                    </td>
                                    <td scope="col" ><?php echo esc_html($log['file']); ?></td>
                                    <td scope="col" ><?php echo esc_html($log['line']); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </td>
            <td id="dpro-log-pnl-right">
                <h2><?php esc_html_e("Options", 'duplicator-pro') ?></h2>
                <form id="dup-form-logs" method="post" action="">

                    <div class="dpro-opts-items">
                        <strong><?php esc_html_e('PHP Error Filter:', 'duplicator-pro'); ?></strong>
                        <select type="text" id="filter" name="filter" style="width:100%;">
                            <option value="">--- <?php esc_html_e('None', 'duplicator-pro'); ?> ---</option>
                            <?php
                            foreach (
                                array(
                                    'WARNING'   => __('Warnings', 'duplicator-pro'),
                                    'NOTICE'    => __('Notices', 'duplicator-pro'),
                                    'FATAL'     => __('Fatal Error', 'duplicator-pro'),
                                    'SYNTAX'    => __('Syntax Error', 'duplicator-pro'),
                                    'EXCEPTION' => __('Exceptions', 'duplicator-pro'),
                                ) as $option => $name
                            ) :
                                ?>
                            <option value="<?php echo esc_attr($option); ?>"<?php echo ($filter == $option ? ' selected' : ''); ?>>
                                <?php echo esc_html($name); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <hr>
                        <div class="horizontal-input-row">
                            <input
                                type="button"
                                class="button secondary hollow small" id="dup-refresh" value="<?php esc_attr_e("Refresh", 'duplicator-pro') ?>"
                            >
                            <input type="hidden" name="auto" id="auto" value="<?php echo $auto ? 1 : 0 ?>">
                            <input type='checkbox' id="dup-auto-refresh"/>
                            <label id="dup-auto-refresh-lbl" for="dup-auto-refresh">
                                <?php esc_html_e("Auto Refresh", 'duplicator-pro') ?>  [<span id="dup-refresh-count"></span>]
                            </label>
                        </div>
                    </div>
                    <?php if (isset($line) && $line + 30 > $lines) : ?>
                    <br>
                    <div style="color:#cc0000">
                        <i class="fa fa-info-circle"></i>
                        <?php
                        printf(
                            _x(
                                'You see only last %1$s logs inside %2$s file.',
                                '1 stands for the number of lines, 2 stands for the log file name',
                                'duplicator-pro'
                            ),
                            $line,
                            esc_html(DUP_PRO_PHP_Log::get_filename($log_path))
                        );
                        ?>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($line)) : ?>
                    <br>
                        <button class="button secondary hollow small" type="button" onclick="return DupPro.Tools.ClearLog();">
                            <?php esc_html_e('Clear Log', 'duplicator-pro'); ?>
                        </button>
                    <?php endif; ?>
                </form>
                </td>
            </tr>
    </table>
    <form id="dup-form-clear-log" method="post" action="">
        <input type="hidden" id="clear_log" name="clear_log" value="true" />
    </form>
</div>
        <?php
        $confirm1               = new DUP_PRO_UI_Dialog();
        $confirm1->title        = __('Clear PHP Log?', 'duplicator-pro');
        $confirm1->message      = __('Are you sure you want to clear PHP log??', 'duplicator-pro');
        $confirm1->message     .= '<br/>';
        $confirm1->message     .= '<small><i>' . __('Note: This action will delete all data and can\'t be stopped.', 'duplicator-pro') . '</i></small>';
        $confirm1->progressText = __('Clear PHP log, Please Wait...', 'duplicator-pro');
        $confirm1->jsCallback   = 'DupPro.Tools.ClearLogSubmit()';
        $confirm1->initConfirm();
        ?>
<script>
jQuery(document).ready(function ($)
{
    var duration = 9,
        count = duration,
        timerInterval;

    DupPro.Tools.errorFilter = function() {
        // Declare variables
        var input, filter, table, tr, td, i;
            input = $("#filter");
            filter = input.val().toUpperCase();
            table = $("#error-log");
            tr = table.find("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "table-row";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }


    $("#dup-refresh-count").html(duration);

    function timer() {
        count = count - 1;
        $("#dup-refresh-count").html(count.toString());
        if (!$("#dup-auto-refresh").is(":checked")) {
            clearInterval(timerInterval);
            $("#dup-refresh-count").text(count.toString().trim());
            return;
        }

        if (count <= 0) {
            count = duration + 1;
            DupPro.Tools.Refresh();
        }
    }

    function startTimer() {
        timerInterval = setInterval(timer, 1000);
    }

    DupPro.Tools.ClearLogSubmit = function() {
        $('#dup-form-clear-log').submit();
    }

    DupPro.Tools.ClearLog = function() {
        <?php $confirm1->showConfirm(); ?>
    }

    DupPro.Tools.Refresh = function () {
        $('#refresh').val(1);
        $('#dup-form-logs').submit();
    }

    DupPro.Tools.RefreshAuto = function () {
        if ($("#dup-auto-refresh").is(":checked")) {
            $('#auto').val(1);
            startTimer();
        } else {
            $('#auto').val(0);
        }
    }

    DupPro.Tools.FullLog = function () {
        var $panelL = $('#dpro-log-pnl-left');
        var $panelR = $('#dpro-log-pnl-right');

        if ($panelR.is(":visible")) {
            $panelR.hide(400);
            $panelL.css({width: '100%'});
        } else {
            $panelR.show(200);
            $panelL.css({width: '75%'});
        }
    }

    /* TABLE SIZE */
    DupPro.Tools.TableSize = function() {
        var size = [],
            offset = ($('#tableContainer').width() - $($('#error-log tbody tr').get(0)).width()) / ($('#error-log th').length);

        $('#error-log th').each(function(i,$this) {
            size[i] = $($this).width();
        });

        $('#error-log tr').each(function(x,$tr) {
            $($tr).find('td').each(function(i,$this) {
                $($this).width(size[i]+offset);
            });
        });
    };

    DupPro.Tools.BoxHeight = function() {
        var position = $('#tableContainer').position(),
            winHeight = $(window).height(),
            height = (winHeight - position.top - $("#wpfooter").height()) - 55;
        if(height >= 500) {
            $('#error-log tbody, div.tableContainer').height(height);
        }
    };

        <?php if (count($error_log) > 0) : ?>
    DupPro.Tools.TableSize();
    DupPro.Tools.BoxHeight();
        <?php endif; ?>

    $(window).resize(function() {
        <?php if (count($error_log) > 0) : ?>
        DupPro.Tools.TableSize();
        DupPro.Tools.BoxHeight();
        <?php endif; ?>
    });

    $('#dup-options').click(function() {
            DupPro.Tools.FullLog();
            DupPro.Tools.TableSize();
    });
    $("#dup-refresh").click(DupPro.Tools.Refresh);
    $("#dup-auto-refresh").click(DupPro.Tools.RefreshAuto);

    $("#filter").on('input change select', function(){
        DupPro.Tools.errorFilter();
    });

    DupPro.Tools.errorFilter();
        <?php if ($auto) : ?>
        $("#dup-auto-refresh").prop('checked', true);
        DupPro.Tools.RefreshAuto();
        <?php endif; ?>
});
</script>
    <?php endif;
