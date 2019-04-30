<?php
use XoopsModules\Tad_timeline\Update;

function xoops_module_update_tad_timeline($module, $old_version)
{
    global $xoopsDB;

    if (Update::chk_chk1()) {
        Update::go_update1();
    }

    if (Update::chk_chk2()) {
        Update::go_update2();
    }

    if (Update::chk_fc_tag()) {
        Update::go_fc_tag();
    }

    return true;
}
