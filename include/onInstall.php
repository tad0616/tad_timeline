<?php
use XoopsModules\Tadtools\Utility;

include dirname(__DIR__) . '/preloads/autoloader.php';

function xoops_module_install_tad_timeline(&$module)
{
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline/file');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline/image');
    Utility::mk_dir(XOOPS_ROOT_PATH . '/uploads/tad_timeline/image/.thumbs');

    return true;
}
