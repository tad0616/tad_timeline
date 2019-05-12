<?php
use XoopsModules\Tadtools\TadUpFiles;
use XoopsModules\Tadtools\Utility;
if (!class_exists('XoopsModules\Tadtools\Utility')) {
    require XOOPS_ROOT_PATH . '/modules/tadtools/preloads/autoloader.php';
}

//區塊主函式 (tad_timeline_list)
function tad_timeline_list($options)
{
    global $xoopsDB;

    $have_content = false;
    $block['mode'] = $options[0];
    if ('list' === $options[0]) {
        $myts = \MyTextSanitizer::getInstance();
        $TadUpFiles = new TadUpFiles('tad_timeline');
        $sql = 'SELECT * FROM `' . $xoopsDB->prefix('tad_timeline') . '` ORDER BY `year`, `month`, `day`';
        $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        $all_content = [];

        $i = 0;
        while (false !== ($all = $xoopsDB->fetchArray($result))) {
            //以下會產生這些變數： $timeline_sn, $year, $month, $day, $text_headline, $text_text, $timeline_uid
            foreach ($all as $k => $v) {
                $$k = $v;
            }
            $have_content = true;

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
            $all_content[$i]['timeline_uid'] = $uid_name;
            $TadUpFiles->set_col('timeline_sn', $timeline_sn, 1);
            $show_files = $TadUpFiles->show_files('up_timeline_sn', true, 'small', true, false, null, null, false);
            $all_content[$i]['list_file'] = $show_files;
            $i++;
        }

        $block['all_content'] = $all_content;
    } else {
        $sql = 'SELECT timeline_sn FROM `' . $xoopsDB->prefix('tad_timeline') . '` ORDER BY  `year` , `month` , `day`';
        $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);

        $i = 1;
        $order = [];
        while (list($timeline_sn) = $xoopsDB->fetchRow($result)) {
            $order[$timeline_sn] = $i;
            $have_content = true;
            $i++;
        }
        $block['start_at_slide'] = $options[1];
        if (empty($options[1])) {
            $block['start_at_slide'] = 1;
        } else {
            $block['start_at_slide'] = $order[$options[1]];
        }

    }
    $block['have_content'] = $have_content;

    return $block;
}

//區塊編輯函式 (tad_timeline_list_edit)
function tad_timeline_list_edit($options)
{
    global $xoopsDB;

    $sql = 'SELECT timeline_sn,year,month,day,text_headline FROM `' . $xoopsDB->prefix('tad_timeline') . '` ORDER BY year, month, day';
    $result = $xoopsDB->query($sql) or Utility::web_error($sql, __FILE__, __LINE__);
    $opt = '';
    while (list($timeline_sn, $year, $month, $day, $text_headline) = $xoopsDB->fetchRow($result)) {
        $selected = $options[1] == $timeline_sn ? 'selected' : '';
        $opt .= "<option value='{$timeline_sn}' $selected>{$year} {$text_headline}</option>";
    }

    //"顯示模式"預設值
    $checked_0_0 = ('timeline' === $options[0]) ? 'checked' : '';
    $checked_0_1 = ('list' === $options[0]) ? 'checked' : '';

    $form = "
    <ol class='my-form'>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_TIMELINE_LIST_OPT0 . "</lable>
            <div class='my-content'>
                <input type='radio' name='options[0]' value='timeline' $checked_0_0> " . _MB_TAD_TIMELINE_LIST_OPT0_VAL0 . "
                <input type='radio' name='options[0]' value='list' $checked_0_1> " . _MB_TAD_TIMELINE_LIST_OPT0_VAL1 . "
            </div>
        </li>
        <li class='my-row'>
            <lable class='my-label'>" . _MB_TAD_TIMELINE_LIST_OPT1 . "</lable>
            <div class='my-content'>
                <select name='options[1]' class='my-input'>
                {$opt}
                </select>
            </div>
        </li>
    </ol>";

    return $form;
}
