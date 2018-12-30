<?php

//區塊主函式 (tad_timeline_list)
function tad_timeline_list($options)
{
    global $xoopsDB;

    $have_content  = false;
    $block['mode'] = $options[0];
    if ($options[0] == "list") {

        $myts = MyTextSanitizer::getInstance();
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/TadUpFiles.php";
        $TadUpFiles = new TadUpFiles("tad_timeline");
        $sql        = "SELECT * FROM `" . $xoopsDB->prefix("tad_timeline") . "` ORDER BY `year`, `month`, `day`";
        $result     = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);

        $all_content = '';
        $i           = 0;
        while ($all = $xoopsDB->fetchArray($result)) {
            //以下會產生這些變數： $timeline_sn, $year, $month, $day, $text_headline, $text_text, $timeline_uid
            foreach ($all as $k => $v) {
                $$k = $v;
            }
            $have_content = true;

            //過濾讀出的變數值
            $year          = $myts->htmlSpecialChars($year);
            $month         = $myts->htmlSpecialChars($month);
            $day           = $myts->htmlSpecialChars($day);
            $text_headline = $myts->htmlSpecialChars($text_headline);
            $text_text     = $myts->displayTarea($text_text, 1, 1, 0, 1, 0);

            $all_content[$i]['timeline_sn']   = $timeline_sn;
            $all_content[$i]['year']          = $year;
            $all_content[$i]['month']         = $month;
            $all_content[$i]['day']           = $day;
            $all_content[$i]['text_headline'] = $text_headline;
            $all_content[$i]['text_text']     = $text_text;
            $all_content[$i]['timeline_uid']  = $uid_name;
            $TadUpFiles->set_col("timeline_sn", $timeline_sn, 1);
            $show_files                   = $TadUpFiles->show_files('up_timeline_sn', true, 'small', true, false, null, null, false);
            $all_content[$i]['list_file'] = $show_files;
            $i++;
        }

        $block['all_content'] = $all_content;
    } else {
        $sql    = "SELECT timeline_sn FROM `" . $xoopsDB->prefix("tad_timeline") . "` ORDER BY  `year` , `month` , `day`";
        $result = $xoopsDB->query($sql) or web_error($sql, __FILE__, __LINE__);

        $i     = 1;
        $order = array();
        while (list($timeline_sn) = $xoopsDB->fetchRow($result)) {
            $order[$timeline_sn] = $i;
            $have_content        = true;
            $i++;
        }
        $block['start_at_slide'] = $options[1];
        if (empty($options[1])) {
            $block['start_at_slide'] = 1;
        } else {
            $block['start_at_slide'] = $order[$options[1]];
        }

        // if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php")) {
        //     redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
        // }
        // include_once XOOPS_ROOT_PATH . "/modules/tadtools/fancybox.php";
        // $fancybox               = new fancybox('.media-image', '100%');
        // $block['fancybox_code'] = $fancybox->render(false, true);

    }
    $block['have_content'] = $have_content;
    return $block;
}

//區塊編輯函式 (tad_timeline_list_edit)
function tad_timeline_list_edit($options)
{
    global $xoopsDB;

    $sql    = "SELECT timeline_sn,year,month,day,text_headline FROM `" . $xoopsDB->prefix("tad_timeline") . "` ORDER BY year, month, day";
    $result = $xoopsDB->query($sql)
    or web_error($sql, __FILE__, __LINE__);
    $opt = '';
    while (list($timeline_sn, $year, $month, $day, $text_headline) = $xoopsDB->fetchRow($result)) {
        $selected = $options[1] == $timeline_sn ? 'selected' : '';
        $opt .= "<option value='{$timeline_sn}' $selected>{$year} {$text_headline}</option>";
    }

    //"顯示模式"預設值
    $checked_0_0 = ($options[0] == 'timeline') ? 'checked' : '';
    $checked_0_1 = ($options[0] == 'list') ? 'checked' : '';

    $form = "
    <table>
      <tr>
        <th style='width: 100px;'>
          <!--顯示模式-->
          " . _MB_TAD_TIMELINE_LIST_OPT0 . "
        </th>
        <td>
            <input type='radio' name='options[0]' value='timeline' $checked_0_0> " . _MB_TAD_TIMELINE_LIST_OPT0_VAL0 . "
            <input type='radio' name='options[0]' value='list' $checked_0_1> " . _MB_TAD_TIMELINE_LIST_OPT0_VAL1 . "
        </td>
      </tr>
      <tr>
        <th style='width: 100px;'>
          <!--預設事件-->
          " . _MB_TAD_TIMELINE_LIST_OPT1 . "
        </th>
        <td>
            <select name='options[1]' >
              {$opt}
            </select>
        </td>
      </tr>
    </table>
    ";
    return $form;
}
