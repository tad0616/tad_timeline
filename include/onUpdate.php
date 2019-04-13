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
use XoopsModules\Tad_timeline\Utility;

function xoops_module_update_tad_timeline($module, $old_version)
{
    global $xoopsDB;

    if (Utility::chk_chk1()) {
        Utility::go_update1();
    }

    if (Utility::chk_chk2()) {
        Utility::go_update2();
    }

    //新增檔案欄位
    if (Utility::chk_fc_tag()) {
        Utility::go_fc_tag();
    }

    return true;
}
