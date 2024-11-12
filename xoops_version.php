<?php
$modversion = [];
global $xoopsConfig;

//---模組基本資訊---//
$modversion['name'] = _MI_TAD_TIMELINE_NAME;
// $modversion['version'] = '2.0';
$modversion['version'] = $_SESSION['xoops_version'] >= 20511 ? '3.0.0-Stable' : '3.0';
$modversion['description'] = _MI_TAD_TIMELINE_DESC;
$modversion['author'] = _MI_TAD_TIMELINE_AUTHOR;
$modversion['credits'] = _MI_TAD_TIMELINE_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['release_date'] = '2024-11-18';
$modversion['module_website_url'] = 'http://www.tad0616.net';
$modversion['module_website_name'] = _MI_TAD_TIMELINE_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'http://www.tad0616.net';
$modversion['author_website_name'] = _MI_TAD_TIMELINE_AUTHOR_WEB;
$modversion['min_php'] = '5.4';
$modversion['min_xoops'] = '2.5.10';

//---paypal資訊---//
$modversion['paypal'] = [
    'business' => 'tad0616@gmail.com',
    'item_name' => 'Donation : ' . _MI_TAD_WEB,
    'amount' => 0,
    'currency_code' => 'USD',
];

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = ['tad_timeline', 'tad_timeline_files_center'];

//---搜尋設定---//
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/tad_timeline_search.php';
$modversion['search']['func'] = 'tad_timeline_search';

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/main.php';
$modversion['adminmenu'] = 'admin/menu.php';

//---使用者主選單設定---//
$modversion['hasMain'] = 1;

//---樣板設定---//
$modversion['templates'] = [
    ['file' => 'tad_timeline_admin.tpl', 'description' => 'tad_timeline_admin.tpl'],
    ['file' => 'tad_timeline_index.tpl', 'description' => 'tad_timeline_index.tpl'],
];

//---區塊設定---//
$modversion['blocks'][] = [
    'file' => 'tad_timeline_list.php',
    'name' => _MI_TAD_TIMELINE_LIST_BLOCK_NAME,
    'description' => _MI_TAD_TIMELINE_LIST_BLOCK_DESC,
    'show_func' => 'tad_timeline_list',
    'template' => 'tad_timeline_list.tpl',
    'edit_func' => 'tad_timeline_list_edit',
    'options' => 'timeline|1',
];

//---偏好設定---//
$modversion['config'][] = [
    'name' => 'default_display_mode',
    'title' => '_MI_TADTIMELI_DEFAULT_DISPLAY_MODE',
    'description' => '_MI_TADTIMELI_DEFAULT_DISPLAY_MODE_DESC',
    'formtype' => 'select',
    'valuetype' => 'text',
    'default' => 'timeline',
    'options' => [_MI_TADTIMELI_DEFAULT_DISPLAY_MODE_KEY1 => 'timeline', _MI_TADTIMELI_DEFAULT_DISPLAY_MODE_KEY2 => 'list'],
];
