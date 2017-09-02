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

include_once "../../tadtools/language/{$xoopsConfig['language']}/admin_common.php";
define('_TAD_NEED_TADTOOLS', 'This module needs TadTools module. You can download TadTools from <a href="http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50" target="_blank">Tad Textbook </a>. ');

//tad_timeline-list
define('_MA_TAD_TIMELINE_EVENT_SN', 'event number');
define('_MA_TAD_TIMELINE_YEAR', 'event year');
define('_MA_TAD_TIMELINE_MONTH', 'event month');
define('_MA_TAD_TIMELINE_DAY', 'event day');
define('_MA_TAD_TIMELINE_Y', 'year');
define('_MA_TAD_TIMELINE_M', 'month');
define('_MA_TAD_TIMELINE_D', 'day');
define('_MA_TAD_TIMELINE_TEXT_HEADLINE', 'event title');
define('_MA_TAD_TIMELINE_TEXT_TEXT', 'event description');
define('_MA_TAD_TIMELINE_EVENT_UID', 'Publisher');
define('_MA_TAD_TIMELINE_UP_EVENT_SN', 'upload');
define('_MA_TAD_TIMELINE_SHOW_EVENT_SN_FILES', 'Upload');
define('_MA_TAD_TIMELINE_JOSN_TITLE', 'Important Chronicle');
define('_MA_TAD_TIMELINE_JOSN_TEXT', 'Important Chronicle');

define('_MA_TADTIMELI_PERM_TITLE', 'Important Chronicle Details');
define('_MA_TADTIMELI_PERM_DESC', 'check the permissions you want to open to the group:');
define('_MA_TADTIMELI_EDIT_EVENT', 'Add, edit, manage important Chronicle');
