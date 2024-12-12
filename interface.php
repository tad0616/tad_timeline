<?php
//判斷是否對該模組有管理權限
if (!isset($_SESSION['tad_timeline_adm'])) {
    $_SESSION['tad_timeline_adm'] = isset($xoopsUser) && \is_object($xoopsUser) ? $xoopsUser->isAdmin() : false;
}

$interface_menu[_MD_TAD_TIMELINE_SMNAME1] = 'index.php';
$interface_icon[_MD_TAD_TIMELINE_SMNAME1] = 'fa-calendar';
