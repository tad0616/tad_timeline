<?php
/**
 * Events module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright  XOOPS Project (https://xoops.org)
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package    Events
 * @since      2.5
 * @author     tad
 * @version    $Id $
 **/

/*-----------引入檔案區--------------*/
include "header.php";
$xoopsOption['template_main'] = 'tad_timeline_index.tpl';
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------功能函數區--------------*/

//
function get_start_at_slide($def_timeline_sn = "")
{
    global $xoopsDB, $xoopsTpl;

    //判斷目前使用者是否有：發布權限
    $edit_event = power_chk("tad_timeline", 1);
    $xoopsTpl->assign('edit_event', $edit_event);
    if ($edit_event) {
        tad_timeline_form();
        //刪除確認的JS
        if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
            redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
        }
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
        $sweet_alert_obj = new sweet_alert();
        $sweet_alert_obj->render('delete_tad_timeline_func',
            "{$_SERVER['PHP_SELF']}?op=delete_tad_timeline&timeline_sn=", "timeline_sn");
    }

    $sql    = "SELECT timeline_sn FROM `" . $xoopsDB->prefix("tad_timeline") . "` ORDER BY  `year` , `month` , `day`";
    $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);

    $i            = 1;
    $order        = array();
    $have_content = false;
    while (list($timeline_sn) = $xoopsDB->fetchRow($result)) {
        $order[$timeline_sn] = $i;
        $have_content        = true;
        $i++;
    }
    $xoopsTpl->assign('have_content', $have_content);

    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php")) {
        redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php";
    $fancybox      = new fancybox('.media_image', '100%');
    $fancybox_code = $fancybox->render(false);
    $xoopsTpl->assign('fancybox_code', $fancybox_code);

    if (empty($def_timeline_sn)) {
        $xoopsTpl->assign('start_at_slide', 1);
        return;
    } else {
        $xoopsTpl->assign('start_at_slide', $order[$def_timeline_sn]);
    }

}

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op          = system_CleanVars($_REQUEST, 'op', '', 'string');
$timeline_sn = system_CleanVars($_REQUEST, 'timeline_sn', '', 'int');
$files_sn    = system_CleanVars($_REQUEST, 'files_sn', '', 'int');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    //新增資料
    case "insert_tad_timeline":
        $timeline_sn = insert_tad_timeline();
        header("location: {$_SERVER['PHP_SELF']}?timeline_sn={$timeline_sn}");
        exit;
        break;

    //更新資料
    case "update_tad_timeline":
        update_tad_timeline($timeline_sn);
        header("location: {$_SERVER['PHP_SELF']}?timeline_sn={$timeline_sn}");
        exit;

    case "delete_tad_timeline":
        delete_tad_timeline($timeline_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //下載檔案
    case "tufdl":
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/TadUpFiles.php";
        $TadUpFiles = new TadUpFiles("tad_timeline");
        $TadUpFiles->add_file_counter($files_sn, false);
        exit;

    case "list_tad_timeline":
        list_tad_timeline();
        break;

    case "tad_timeline_form":
        tad_timeline_form($timeline_sn);
        break;

    case "timeline_mode":
        get_start_at_slide($timeline_sn);
        break;

    default:
        if ($xoopsModuleConfig['default_display_mode'] == "list" and empty($timeline_sn)) {
            header("location: {$_SERVER['PHP_SELF']}?op=list_tad_timeline");
            exit;
        } else {
            get_start_at_slide($timeline_sn);
        }
        break;

        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoopsTpl->assign("isAdmin", $isAdmin);
$xoopsTpl->assign("now_op", $op);
include_once XOOPS_ROOT_PATH . '/footer.php';
