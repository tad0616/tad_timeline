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
 * @copyright  The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package    Events
 * @since      2.5
 * @author     tad
 * @version    $Id $
 **/

/*-----------引入檔案區--------------*/
$isAdmin                      = true;
$xoopsOption['template_main'] = 'tad_timeline_adm_main.tpl';
include_once "header.php";
include_once "../function.php";

/*-----------功能函數區--------------*/

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
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //更新資料
    case "update_tad_timeline":
        update_tad_timeline($timeline_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    case "tad_timeline_form":
        tad_timeline_form($timeline_sn);
        break;

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

    default:
        list_tad_timeline();
        break;

        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign("isAdmin", true);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/xoops_adm.css');
include_once 'footer.php';
