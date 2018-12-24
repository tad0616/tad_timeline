CREATE TABLE `tad_timeline` (
  `timeline_sn` smallint(6) unsigned NOT NULL auto_increment COMMENT '事件編號',
  `year` year NOT NULL default '0000' COMMENT '事件年',
  `month` tinyint(3) unsigned NOT NULL default '0' COMMENT '事件月',
  `day` tinyint(3) unsigned NOT NULL default '0' COMMENT '事件日',
  `text_headline` varchar(255) NOT NULL default '' COMMENT '事件標題',
  `text_text` text NOT NULL COMMENT '事件說明',
  `timeline_uid` mediumint(9) unsigned NOT NULL default '0' COMMENT '發布者',
PRIMARY KEY  (`timeline_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `tad_timeline_files_center` (
  `files_sn` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '檔案流水號',
  `col_name` varchar(255) NOT NULL default '' COMMENT '欄位名稱',
  `col_sn` smallint(5) unsigned NOT NULL default 0 COMMENT '欄位編號',
  `sort` smallint(5) unsigned NOT NULL default 0 COMMENT '排序',
  `kind` enum('img','file') NOT NULL default 'img' COMMENT '檔案種類',
  `file_name` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
  `file_type` varchar(255) NOT NULL default '' COMMENT '檔案類型',
  `file_size` int(10) unsigned NOT NULL default 0 COMMENT '檔案大小',
  `description` text NOT NULL COMMENT '檔案說明',
  `counter` mediumint(8) unsigned NOT NULL default 0 COMMENT '下載人次',
  `original_filename` varchar(255) NOT NULL default '' COMMENT '檔案名稱',
  `hash_filename` varchar(255) NOT NULL default '' COMMENT '加密檔案名稱',
  `sub_dir` varchar(255) NOT NULL default '' COMMENT '檔案子路徑',
  `upload_date` datetime NOT NULL COMMENT '上傳時間',
  `uid` mediumint(8) unsigned NOT NULL default 0 COMMENT '上傳者',
  `tag` varchar(255) NOT NULL default '' COMMENT '註記',
  PRIMARY KEY (`files_sn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

