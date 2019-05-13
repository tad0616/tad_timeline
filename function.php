<?php
use XoopsModules\Tadtools\FormValidator;
use XoopsModules\Tadtools\SweetAlert;
use XoopsModules\Tadtools\TadUpFiles;
use XoopsModules\Tadtools\Utility;

/********************* 自訂函數 ********************
 * @param string $timeline_sn
 */

//tad_timeline編輯表單
function tad_timeline_form($timeline_sn = '')
{
    global $xoopsDB, $xoopsTpl, $isAdmin, $xoopsUser;
    $edit_event = Utility::power_chk('tad_timeline', 1);
    if (!$edit_event) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //抓取預設值
    if (!empty($timeline_sn)) {
        $DBV = get_tad_timeline($timeline_sn);
    } else {
        $DBV = [];
    }

    //預設值設定

    //設定 timeline_sn 欄位的預設值
    $timeline_sn = !isset($DBV['timeline_sn']) ? $timeline_sn : $DBV['timeline_sn'];
    $xoopsTpl->assign('timeline_sn', $timeline_sn);
    //設定 year 欄位的預設值
    $year = !isset($DBV['year']) ? '' : $DBV['year'];
    $xoopsTpl->assign('year', $year);
    //設定 month 欄位的預設值
    $month = !isset($DBV['month']) ? '' : $DBV['month'];
    $xoopsTpl->assign('month', $month);
    //設定 day 欄位的預設值
    $day = !isset($DBV['day']) ? '' : $DBV['day'];
    $xoopsTpl->assign('day', $day);
    //設定 text_headline 欄位的預設值
    $text_headline = !isset($DBV['text_headline']) ? '' : $DBV['text_headline'];
    $xoopsTpl->assign('text_headline', $text_headline);
    //設定 text_text 欄位的預設值
    $text_text = !isset($DBV['text_text']) ? '' : $DBV['text_text'];
    $xoopsTpl->assign('text_text', $text_text);
    //設定 timeline_uid 欄位的預設值
    $user_uid = $xoopsUser ? $xoopsUser->uid() : '';
    $timeline_uid = !isset($DBV['timeline_uid']) ? $user_uid : $DBV['timeline_uid'];
    $xoopsTpl->assign('timeline_uid', $timeline_uid);

    $op = empty($timeline_sn) ? 'insert_tad_timeline' : 'update_tad_timeline';
    //$op = "replace_tad_timeline";

    $FormValidator = new FormValidator('#myForm', true);
    $FormValidator->render();

    $TadUpFiles = new TadUpFiles('tad_timeline');
    $TadUpFiles->set_col('timeline_sn', $timeline_sn, 1);
    $up_timeline_sn_form = $TadUpFiles->upform(true, 'up_timeline_sn', '1');
    $xoopsTpl->assign('up_timeline_sn_form', $up_timeline_sn_form);

    //加入Token安全機制
    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
    $token = new \XoopsFormHiddenToken();
    $token_form = $token->render();
    $xoopsTpl->assign('token_form', $token_form);
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('next_op', $op);
}

//產生json檔
function mk_json()
{
    global $xoopsDB;
    $myts = \MyTextSanitizer::getInstance();
    $json['timeline']['headline'] = _MD_TAD_TIMELINE_JOSN_TITLE;
    $json['timeline']['type'] = 'default';
    $json['timeline']['text'] = _MD_TAD_TIMELINE_JOSN_TEXT;
    $json['timeline']['startDate'] = date('Y,m,d');

    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_timeline') . '` ORDER BY year, month, day';
    $result = $xoopsDB->query($sql)
    or Utility::web_error($sql, __FILE__, __LINE__);
    $i = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $timeline_sn, $year, $month, $day, $text_headline, $text_text, $timeline_uid
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        //過濾讀出的變數值
        $year = (int) $year;
        $month = (int) $month;
        $day = (int) $day;
        $text_headline = strip_tags($text_headline);
        $text_text = strip_tags($text_text);

        $TadUpFiles = new TadUpFiles('tad_timeline');
        $TadUpFiles->set_col('timeline_sn', $timeline_sn, 1);
        $media_url = $TadUpFiles->get_pic_file('images');
        $media_thumb = $TadUpFiles->get_pic_file('thumb'); //thumb 小圖, images 大圖（default）, file 檔案

        $m = empty($month) ? '' : $month;
        $d = empty($day) ? '' : $day;

        $json['timeline']['date'][$i]['startDate'] = "{$year},{$m},{$d}";
        $json['timeline']['date'][$i]['endDate'] = '';
        $json['timeline']['date'][$i]['headline'] = $text_headline;
        $json['timeline']['date'][$i]['text'] = $text_text;
        $json['timeline']['date'][$i]['asset']['media'] = $media_url;
        $json['timeline']['date'][$i]['asset']['credit'] = '';
        $json['timeline']['date'][$i]['asset']['caption'] = $text_headline;
        $i++;
    }
    $json_code = json_encode($json);

    $file = XOOPS_ROOT_PATH . '/uploads/tad_timeline/tad_timeline.json';
    if (!file_put_contents($file, $json_code)) {
        redirect_header('index.php', 3, _MD_TAD_TIMELINE_JSON_ERROR);
    }
}

//以流水號取得某筆tad_timeline資料
function get_tad_timeline($timeline_sn = '')
{
    global $xoopsDB;

    if (empty($timeline_sn)) {
        return;
    }

    $sql = 'select * from `' . $xoopsDB->prefix('tad_timeline') . "`
    where `timeline_sn` = '{$timeline_sn}'";
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $data = $xoopsDB->fetchArray($result);

    return $data;
}

//新增資料到tad_timeline中
function insert_tad_timeline()
{
    global $xoopsDB, $xoopsUser, $isAdmin;
    $edit_event = Utility::power_chk('tad_timeline', 1);
    if (!$edit_event) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->uid() : '';
    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = \MyTextSanitizer::getInstance();

    $timeline_sn = (int) $_POST['timeline_sn'];
    $year = $myts->addSlashes($_POST['year']);
    $month = $myts->addSlashes($_POST['month']);
    $day = $myts->addSlashes($_POST['day']);
    $text_headline = $myts->addSlashes($_POST['text_headline']);
    $text_text = $myts->addSlashes($_POST['text_text']);
    $timeline_uid = (int) $_POST['timeline_uid'];

    $sql = 'insert into `' . $xoopsDB->prefix('tad_timeline') . "` (
        `year`,
        `month`,
        `day`,
        `text_headline`,
        `text_text`,
        `timeline_uid`
    ) values(
        '{$year}',
        '{$month}',
        '{$day}',
        '{$text_headline}',
        '{$text_text}',
        '{$uid}'
    )";
    $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    //取得最後新增資料的流水編號
    $timeline_sn = $xoopsDB->getInsertId();

    require_once XOOPS_ROOT_PATH . '/modules/tadtools/TadUpFiles.php';
    $TadUpFiles = new TadUpFiles('tad_timeline');
    $TadUpFiles->set_col('timeline_sn', $timeline_sn, 1);
    $TadUpFiles->upload_file('up_timeline_sn', '1280', '320', '', '', true, false);

    mk_json();

    return $timeline_sn;
}

//更新tad_timeline某一筆資料
function update_tad_timeline($timeline_sn = '')
{
    global $xoopsDB, $isAdmin;
    $edit_event = Utility::power_chk('tad_timeline', 1);
    if (!$edit_event) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //取得使用者編號
    $uid = ($xoopsUser) ? $xoopsUser->uid() : '';
    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = \MyTextSanitizer::getInstance();

    $timeline_sn = (int) $_POST['timeline_sn'];
    $year = $myts->addSlashes($_POST['year']);
    $month = $myts->addSlashes($_POST['month']);
    $day = $myts->addSlashes($_POST['day']);
    $text_headline = $myts->addSlashes($_POST['text_headline']);
    $text_text = $myts->addSlashes($_POST['text_text']);
    $timeline_uid = (int) $_POST['timeline_uid'];

    $sql = 'update `' . $xoopsDB->prefix('tad_timeline') . "` set
       `year` = '{$year}',
       `month` = '{$month}',
       `day` = '{$day}',
       `text_headline` = '{$text_headline}',
       `text_text` = '{$text_text}',
       `timeline_uid` = '{$uid}'
    where `timeline_sn` = '$timeline_sn'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $TadUpFiles = new TadUpFiles('tad_timeline');
    $TadUpFiles->set_col('timeline_sn', $timeline_sn, 1);
    $TadUpFiles->upload_file('up_timeline_sn', '1280', '320', '', '', true, false);

    mk_json();

    return $timeline_sn;
}

//刪除tad_timeline某筆資料資料
function delete_tad_timeline($timeline_sn = '')
{
    global $xoopsDB, $isAdmin;
    $edit_event = Utility::power_chk('tad_timeline', 1);
    if (!$edit_event) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    if (empty($timeline_sn)) {
        return;
    }

    $sql = 'delete from `' . $xoopsDB->prefix('tad_timeline') . "`
    where `timeline_sn` = '{$timeline_sn}'";
    $xoopsDB->queryF($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $TadUpFiles = new TadUpFiles('tad_timeline');
    $TadUpFiles->set_col('timeline_sn', $timeline_sn, 1);
    $TadUpFiles->del_files();

    mk_json();
}

//列出所有tad_timeline資料
function list_tad_timeline()
{
    global $xoopsDB, $xoopsTpl, $isAdmin;
    //判斷目前使用者是否有：發布權限
    $edit_event = Utility::power_chk('tad_timeline', 1);
    $xoopsTpl->assign('edit_event', $edit_event);
    if ($edit_event) {
        tad_timeline_form();

        $SweetAlert = new SweetAlert();
        $SweetAlert->render(
            'delete_tad_timeline_func',
            "{$_SERVER['PHP_SELF']}?op=delete_tad_timeline&timeline_sn=",
            'timeline_sn'
        );
    }
    $myts = \MyTextSanitizer::getInstance();

    $TadUpFiles = new TadUpFiles('tad_timeline');
    $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_timeline') . '` ORDER BY `year`, `month`, `day`';

    //Utility::getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = Utility::getPageBar($sql, 20, 10);
    $bar = $PageBar['bar'];
    $sql = $PageBar['sql'];
    $total = $PageBar['total'];

    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

    $all_content = [];
    $i = 0;
    while (false !== ($all = $xoopsDB->fetchArray($result))) {
        //以下會產生這些變數： $timeline_sn, $year, $month, $day, $text_headline, $text_text, $timeline_uid
        foreach ($all as $k => $v) {
            $$k = $v;
        }

        //過濾讀出的變數值
        $year = $myts->htmlSpecialChars($year);
        $month = $myts->htmlSpecialChars($month);
        $day = $myts->htmlSpecialChars($day);
        $text_headline = $myts->htmlSpecialChars($text_headline);
        $text_text = $myts->displayTarea($text_text, 1, 1, 0, 1, 0);

        $all_content[$i]['timeline_sn'] = $timeline_sn;
        $all_content[$i]['year'] = $year;
        $all_content[$i]['month'] = $month;
        $all_content[$i]['day'] = $day;
        $all_content[$i]['text_headline'] = $text_headline;
        $all_content[$i]['text_text'] = $text_text;
        $all_content[$i]['timeline_uid'] = isset($uid_name) ? $uid_name : '';
        $TadUpFiles->set_col('timeline_sn', $timeline_sn, 1);
        $show_files = $TadUpFiles->show_files('up_timeline_sn', true, 'small', true, false, null, null, false);
        $all_content[$i]['list_file'] = $show_files;
        $i++;
    }

    $edit_event = Utility::power_chk('tad_timeline', 1);
    if ($edit_event) {

        $SweetAlert = new SweetAlert();
        $SweetAlert->render(
            'delete_tad_timeline_func',
            "{$_SERVER['PHP_SELF']}?op=delete_tad_timeline&timeline_sn=",
            'timeline_sn'
        );
    }

    $xoopsTpl->assign('bar', $bar);
//    $xoopsTpl->assign('delete_tad_timeline_func', $delete_tad_timeline_func);
//    $xoopsTpl->assign('delete_tad_timeline_func', "{$_SERVER['PHP_SELF']}?op=delete_tad_timeline&timeline_sn=");
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('edit_event', $edit_event);
    $xoopsTpl->assign('all_content', $all_content);
    $xoopsTpl->assign('now_op', 'list_tad_timeline');
}
