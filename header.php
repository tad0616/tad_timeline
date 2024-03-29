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
require_once dirname(dirname(__DIR__)) . '/mainfile.php';
require_once __DIR__ . '/function.php';

//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_timeline_adm'])) {
    $_SESSION['tad_timeline_adm'] = ($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

//$interface_menu[_TAD_TO_MOD]="index.php";
$interface_menu[_MD_TAD_TIMELINE_SMNAME1] = 'index.php';
$interface_icon[_MD_TAD_TIMELINE_SMNAME1] = 'fa-chevron-right';

if ($_SESSION['tad_timeline_adm']) {
    $interface_menu[_TAD_TO_ADMIN] = 'admin/main.php';
    $interface_icon[_TAD_TO_ADMIN] = 'fa-sign-in';
}
