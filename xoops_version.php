<?php
$modversion = [];

//---模組基本資訊---//
$modversion['name'] = _MI_TAD_TIMELINE_NAME;
$modversion['version'] = '1.7';
$modversion['description'] = _MI_TAD_TIMELINE_DESC;
$modversion['author'] = _MI_TAD_TIMELINE_AUTHOR;
$modversion['credits'] = _MI_TAD_TIMELINE_CREDITS;
$modversion['help'] = 'page=help';
$modversion['license'] = 'GPL see LICENSE';
$modversion['image'] = 'images/logo.png';
$modversion['dirname'] = basename(__DIR__);

//---模組狀態資訊---//
$modversion['status_version'] = '1.7';
$modversion['release_date'] = '2020-04-20';
$modversion['module_website_url'] = 'http://www.tad0616.net';
$modversion['module_website_name'] = _MI_TAD_TIMELINE_AUTHOR_WEB;
$modversion['module_status'] = 'release';
$modversion['author_website_url'] = 'http://www.tad0616.net';
$modversion['author_website_name'] = _MI_TAD_TIMELINE_AUTHOR_WEB;
$modversion['min_php'] = '5.4';
$modversion['min_xoops'] = '2.5';

//---paypal資訊---//
$modversion['paypal'] = [];
$modversion['paypal']['business'] = 'tad0616@gmail.com';
$modversion['paypal']['item_name'] = 'Donation :' . _MI_TAD_TIMELINE_AUTHOR;
$modversion['paypal']['amount'] = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---安裝設定---//
$modversion['onInstall'] = 'include/onInstall.php';
$modversion['onUpdate'] = 'include/onUpdate.php';
$modversion['onUninstall'] = 'include/onUninstall.php';

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][1] = 'tad_timeline';
$modversion['tables'][2] = 'tad_timeline_files_center';

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
$i = 0;

//---樣板設定---//
$i = 0;
$modversion['templates'][$i]['file'] = 'tad_timeline_adm_main.tpl';
$modversion['templates'][$i]['description'] = 'tad_timeline_adm_main.tpl for bootstrap3';

$i++;
$modversion['templates'][$i]['file'] = 'tad_timeline_index.tpl';
$modversion['templates'][$i]['description'] = 'tad_timeline_index.tpl for bootstrap3';

$i++;
$modversion['templates'][$i]['file'] = 'tad_timeline_adm_groupperm.tpl';
$modversion['templates'][$i]['description'] = 'tad_timeline_adm_groupperm.tpl';

//---區塊設定---//
$i = 0;
$i++;
$modversion['blocks'][$i]['file'] = 'tad_timeline_list.php';
$modversion['blocks'][$i]['name'] = _MI_TAD_TIMELINE_LIST_BLOCK_NAME;
$modversion['blocks'][$i]['description'] = _MI_TAD_TIMELINE_LIST_BLOCK_DESC;
$modversion['blocks'][$i]['show_func'] = 'tad_timeline_list';
$modversion['blocks'][$i]['template'] = 'tad_timeline_list.tpl';
$modversion['blocks'][$i]['edit_func'] = 'tad_timeline_list_edit';
$modversion['blocks'][$i]['options'] = 'timeline|1';

$i = 0;
$i++;
$modversion['config'][$i]['name'] = 'default_display_mode';
$modversion['config'][$i]['title'] = '_MI_TADTIMELI_DEFAULT_DISPLAY_MODE';
$modversion['config'][$i]['description'] = '_MI_TADTIMELI_DEFAULT_DISPLAY_MODE_DESC';
$modversion['config'][$i]['formtype'] = 'select';
$modversion['config'][$i]['valuetype'] = 'text';
$modversion['config'][$i]['default'] = 'timeline';
$modversion['config'][$i]['options'] = [_MI_TADTIMELI_DEFAULT_DISPLAY_MODE_KEY1 => 'timeline', _MI_TADTIMELI_DEFAULT_DISPLAY_MODE_KEY2 => 'list'];
