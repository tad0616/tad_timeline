<?php
use XoopsModules\Tadtools\TadUpFiles;
/*-----------引入檔案區--------------*/
$isAdmin = true;
$xoopsOption['template_main'] = 'tad_timeline_adm_main.tpl';
require_once __DIR__ . '/header.php';
require_once dirname(__DIR__) . '/function.php';

/*-----------功能函數區--------------*/

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op = system_CleanVars($_REQUEST, 'op', '', 'string');
$timeline_sn = system_CleanVars($_REQUEST, 'timeline_sn', '', 'int');
$files_sn = system_CleanVars($_REQUEST, 'files_sn', '', 'int');

switch ($op) {
    /*---判斷動作請貼在下方---*/

    //新增資料
    case 'insert_tad_timeline':
        $timeline_sn = insert_tad_timeline();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //更新資料
    case 'update_tad_timeline':
        update_tad_timeline($timeline_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    case 'tad_timeline_form':
        tad_timeline_form($timeline_sn);
        break;
    case 'delete_tad_timeline':
        delete_tad_timeline($timeline_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //下載檔案
    case 'tufdl':
        $TadUpFiles = new TadUpFiles('tad_timeline');
        $TadUpFiles->add_file_counter($files_sn, false);
        exit;

    default:
        list_tad_timeline();
        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('isAdmin', true);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/xoops_adm.css');
require_once __DIR__ . '/footer.php';
