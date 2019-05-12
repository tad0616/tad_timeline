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
 * @param mixed $module
 *
 * @return bool
 */
function xoops_module_uninstall_tad_timeline($module)
{
    global $xoopsDB;
    $date = date('Ymd');

    rename(XOOPS_ROOT_PATH . '/uploads/tad_timeline', XOOPS_ROOT_PATH . "/uploads/tad_timeline_bak_{$date}");

    return true;
}
