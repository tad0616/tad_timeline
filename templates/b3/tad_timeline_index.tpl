<{$toolbar}>

<{if $now_op=="tad_timeline_form"}>
  <{includeq file="$xoops_rootpath/modules/tad_timeline/templates/tad_timeline_form.tpl"}>
<{else}>

  <script>
    $(document).ready(function() {
      $('#add_event').click(function(){
        $('#edit_timeline').toggle();
      });
    });
  </script>

  <{if $now_op=="list_tad_timeline"}>
    <{includeq file="$xoops_rootpath/modules/tad_timeline/templates/tad_timeline_list.tpl"}>
  <{else}>
    <{if $have_content}>

      <{$fancybox_code}>

      <!-- BEGIN TimelineJS -->
<{*      <link rel="stylesheet" type="text/css" href="<{$xoops_url}>/modules/tad_timeline/class/timeline/css/timeline.css">*}>
<{*      <script type="text/javascript" src="<{$xoops_url}>/modules/tad_timeline/class/timeline/js/storyjs-embed.js"></script>*}>

        <link title="timeline-styles" rel="stylesheet" href="https://cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">
        <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>

<{*      <script>*}>
        <{*$(document).ready(function() {*}>
        <{*  createStoryJS({*}>
        <{*    type:             'timeline',*}>
        <{*    width:            '100%',*}>
        <{*    height:           '500',*}>
        <{*    start_at_end:     false,*}>
        <{*    start_at_slide:   <{$start_at_slide}>,*}>
        <{*    start_zoom_adjust:2,*}>
        <{*    lang:             'zh-tw',*}>
        <{*    source:           '<{$xoops_url}>/uploads/tad_timeline/tad_timeline.json',*}>
        <{*    embed_id:         'my-timeline',*}>
        <{*    debug:            true*}>
        <{*  });*}>
        <{*});*}>

<{*         timeline = new TL.Timeline('timeline-embed', 'https://docs.google.com/spreadsheets/d/1cWqQBZCkX9GpzFtxCWHoqFXCHg-ylTVUWlnrdYMzKUI/pubhtml');*}>


        <div id="timeline"></div>
            <!-- JavaScript-->
            <script src="class/timesline/js/timeline.js"></script>
<script>
    var timeline = new TL.Timeline('timeline', '<{$xoops_url}>/modules/tad_timeline/class/timeline/examples/welcome.json', {
        theme_color: "#288EC3",
        ga_property_id: "UA-27829802-4"
    });
</script>

      </script>
      <!-- END TimelineJS -->

      <div class="row">
        <div class="col-sm-12">
          <div id="my-timeline"></div>
        </div>
      </div>
    <{else}>
      <div class="jumbotron text-center">
        <h1><{$smarty.const._MD_TAD_TIMELINE_EMPTY}></h1>
      </div>
    <{/if}>
  <{/if}>


  <div class="text-right" style="margin:30px 0px;">
    <{if $edit_event}>
      <{if $timeline_sn}>
        <a href="javascript:delete_tad_timeline_func(<{$timeline_sn}>);" class="btn btn-danger"><{$smarty.const._TAD_DEL}></a>
        <a href="<{$action}>?op=tad_timeline_form&timeline_sn=<{$timeline_sn}>" class="btn btn-warning"><{$smarty.const._TAD_EDIT}></a>
      <{/if}>
      <button class="btn btn-primary" id="add_event"><{$smarty.const._TAD_ADD}></button>
    <{/if}>

    <{if $now_op=="list_tad_timeline"}>
      <a href="index.php?op=timeline_mode" class="btn btn-success" ><{$smarty.const._MD_TAD_TIMELINE_TIMELINE_MODE}></a>
    <{else}>
      <a href="index.php?op=list_tad_timeline" class="btn btn-success" ><{$smarty.const._MD_TAD_TIMELINE_LIST_MODE}></a>
    <{/if}>
  </div>

  <!-- 判斷目前使用者是否有：發布權限 -->
  <{if $edit_event}>
    <!--顯示表單-->
    <div class="well" style="display: none;" id="edit_timeline">
      <{includeq file="$xoops_rootpath/modules/tad_timeline/templates/tad_timeline_form.tpl"}>
    </div>
  <{/if}>
<{/if}>
