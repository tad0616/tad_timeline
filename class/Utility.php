<?php

namespace XoopsModules\Tad_timeline;

/*
 Utility Class Definition

 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       Mamba <mambax7@gmail.com>
 */

/**
 * Class Utility
 */
class Utility
{
    //建立目錄
    public static function mk_dir($dir = '')
    {
        //若無目錄名稱秀出警告訊息
        if (empty($dir)) {
            return;
        }

        //若目錄不存在的話建立目錄
        if (!is_dir($dir)) {
            umask(000);
            //若建立失敗秀出警告訊息
            if (!mkdir($dir, 0777) && !is_dir($dir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir));
            }
        }
    }

    //刪除目錄
    public static function delete_directory($dirname)
    {
        if (is_dir($dirname)) {
            $dir_handle = opendir($dirname);
        }

        if (!$dir_handle) {
            return false;
        }

        while ($file = readdir($dir_handle)) {
            if ('.' != $file && '..' != $file) {
                if (!is_dir($dirname . '/' . $file)) {
                    unlink($dirname . '/' . $file);
                } else {
                    self::delete_directory($dirname . '/' . $file);
                }
            }
        }
        closedir($dir_handle);
        rmdir($dirname);

        return true;
    }

    //拷貝目錄
    public static function full_copy($source = '', $target = '')
    {
        if (is_dir($source)) {
            if (!mkdir($target) && !is_dir($target)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $target));
            }
            $d = dir($source);
            while (false !== ($entry = $d->read())) {
                if ('.' == $entry || '..' == $entry) {
                    continue;
                }

                $Entry = $source . '/' . $entry;
                if (is_dir($Entry)) {
                    self::full_copy($Entry, $target . '/' . $entry);
                    continue;
                }
                copy($Entry, $target . '/' . $entry);
            }
            $d->close();
        } else {
            copy($source, $target);
        }
    }

    public static function rename_win($oldfile, $newfile)
    {
        if (!rename($oldfile, $newfile)) {
            if (copy($oldfile, $newfile)) {
                unlink($oldfile);

                return true;
            }

            return false;
        }

        return true;
    }

    //新增檔案欄位
    public static function chk_fc_tag()
    {
        global $xoopsDB;
        $sql = 'SELECT count(`tag`) FROM ' . $xoopsDB->prefix('tad_timeline_files_center');
        $result = $xoopsDB->query($sql);
        if (empty($result)) {
            return true;
        }

        return false;
    }

    public static function go_fc_tag()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE ' . $xoopsDB->prefix('tad_timeline_files_center') . "
    ADD `upload_date` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '上傳時間',
    ADD `uid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上傳者',
    ADD `tag` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '註記'
    ";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL . '/modules/system/admin.php?fct=modulesadmin', 30, $xoopsDB->error());
    }

    //檢查選單檔是否存在
    public static function chk_chk1()
    {
        return file_exists(XOOPS_ROOT_PATH . '/modules/tad_timeline/interface_menu.php');
    }

    //執行更新
    public static function go_update1()
    {
        unlink(XOOPS_ROOT_PATH . '/modules/tad_timeline/interface_menu.php');

        return true;
    }

    //檢查year欄位是否為year類型
    public static function chk_chk2()
    {
        global $xoopsDB;
        $sql = "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '" . $xoopsDB->prefix('tad_timeline') . "' AND COLUMN_NAME = 'year'";
        $result = $xoopsDB->query($sql);
        list($type) = $xoopsDB->fetchRow($result);
        if ('year' == $type) {
            return true;
        }

        return false;
    }

    //執行更新
    public static function go_update2()
    {
        global $xoopsDB;
        $sql = 'ALTER TABLE `' . $xoopsDB->prefix('tad_timeline') . "` CHANGE `year` `year` char(4) COLLATE 'utf8_general_ci' NOT NULL DEFAULT '0000' AFTER `timeline_sn`;";
        $xoopsDB->queryF($sql) or redirect_header(XOOPS_URL, 3, $xoopsDB->error());

        return true;
    }
}
