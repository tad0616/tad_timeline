<?php
//重要紀事搜尋程式
function tad_timeline_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;
    if (get_magic_quotes_gpc()) {
        foreach ($queryarray as $k => $v) {
            $arr[$k] = addslashes($v);
        }
        $queryarray = $arr;
    }
    $sql = 'SELECT `timeline_sn`, `text_headline`, `year`, `month`, `day`, `timeline_uid` FROM ' . $xoopsDB->prefix('tad_timeline') . ' WHERE 1';
    if (0 != $userid) {
        $sql .= ' AND uid=' . $userid . ' ';
    }
    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " AND ((`text_headline` LIKE '%{$queryarray[0]}%'  OR `text_text` LIKE '%{$queryarray[0]}%' )";
        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";
            $sql .= "(`text_headline` LIKE '%{$queryarray[$i]}%' OR  `text_text` LIKE '%{$queryarray[$i]}%' )";
        }
        $sql .= ') ';
    }
    $sql .= 'ORDER BY  `year` DESC , `month` DESC , `day` DESC';
    $result = $xoopsDB->query($sql, $limit, $offset);
    $ret = [];
    $i = 0;

    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $ret[$i]['image'] = 'images/application_form.png';
        $ret[$i]['link'] = 'index.php?timeline_sn=' . $myrow['timeline_sn'];
        $ret[$i]['title'] = $myrow['text_headline'];
        $ret[$i]['time'] = strtotime("{$myrow['year']}-{$myrow['month']}--{$myrow['day']}");
        $ret[$i]['uid'] = $myrow['timeline_uid'];
        $i++;
    }

    return $ret;
}
