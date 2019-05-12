<?php
use XoopsModules\Tadtools\FancyBox;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\TadUpFiles;
use XoopsModules\Tadtools\Utility;
/*-----------引入檔案區--------------*/
require __DIR__ . '/header.php';
$xoopsOption['template_main'] = 'tad_timeline_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------功能函數區--------------*/

function get_start_at_slide($def_timeline_sn = '')
{
    global $xoopsDB, $xoopsTpl;

    //判斷目前使用者是否有：發布權限
    $edit_event = Utility::power_chk('tad_timeline', 1);
    $xoopsTpl->assign('edit_event', $edit_event);
    if ($edit_event) {
        tad_timeline_form();

        $SweetAlert = new SweetAlert();
        $SweetAlert->render(
            'delete_tad_timeline_func',
            "{$_SERVER['PHP_SELF']}?op=delete_tad_timeline&timeline_sn=",
            'timeline_sn'
        );
    }

    $sql = 'SELECT timeline_sn FROM `' . $xoopsDB->prefix('tad_timeline') . '` ORDER BY  `year` , `month` , `day`';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $i = 1;
    $order = [];
    $have_content = false;
    while (list($timeline_sn) = $xoopsDB->fetchRow($result)) {
        $order[$timeline_sn] = $i;
        $have_content = true;
        $i++;
    }
    $xoopsTpl->assign('have_content', $have_content);

    $FancyBox = new FancyBox('.media_image', '100%');
    $FancyBox->render(false);
    if (empty($def_timeline_sn)) {
        $xoopsTpl->assign('start_at_slide', 1);

        return;
    }
    $xoopsTpl->assign('start_at_slide', $order[$def_timeline_sn]);
}

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
        header("location: {$_SERVER['PHP_SELF']}?timeline_sn={$timeline_sn}");
        exit;
        break;
    //更新資料
    case 'update_tad_timeline':
        update_tad_timeline($timeline_sn);
        header("location: {$_SERVER['PHP_SELF']}?timeline_sn={$timeline_sn}");
        exit;

    case 'delete_tad_timeline':
        delete_tad_timeline($timeline_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    //下載檔案
    case 'tufdl':
        $TadUpFiles = new TadUpFiles('tad_timeline');
        $TadUpFiles->add_file_counter($files_sn, false);
        exit;

    case 'list_tad_timeline':
        list_tad_timeline();
        break;
    case 'tad_timeline_form':
        tad_timeline_form($timeline_sn);
        break;
    case 'timeline_mode':
        get_start_at_slide($timeline_sn);
        break;
    default:
        if ('list' === $xoopsModuleConfig['default_display_mode'] && empty($timeline_sn)) {
            header("location: {$_SERVER['PHP_SELF']}?op=list_tad_timeline");
            exit;
        }
            get_start_at_slide($timeline_sn);

        break;
        /*---判斷動作請貼在上方---*/
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('isAdmin', $isAdmin);
$xoopsTpl->assign('now_op', $op);
require_once XOOPS_ROOT_PATH . '/footer.php';
