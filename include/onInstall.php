<?php
use XoopsModules\Tadtools\Utility;
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}


function xoops_module_install_tad_timeline(&$module)
{
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline/image/.thumbs');

    return true;
}
