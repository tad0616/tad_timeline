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

include dirname(__DIR__) . '/preloads/autoloader.php';

function xoops_module_install_tad_timeline(&$module)
{
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline/image/.thumbs');

    return true;
}
