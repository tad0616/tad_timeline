<script>
  $(document).ready(function() {
    $('#add_event').click(function(){
      $('#edit_timeline').toggle();
    });
  });
</script>
<h2 class="sr-only visually-hidden">List Event</h2>

  <{if $have_content|default:false}>
    <!-- BEGIN TimelineJS -->
    <div id="my-timeline" style="width: 100%; height: 600px"></div>
    <script type="text/javascript">
        var additionalOptions = {
          start_at_end: false,
          default_bg_color: {r:255, g:255, b:255},
          start_at_slide: <{$start_at_slide|default:0}>,
          language: 'zh-tw'
        }

        window.timeline = new TL.Timeline('my-timeline','<{$xoops_url}>/uploads/tad_timeline/tad_timeline.json',
        additionalOptions);
    </script>
    <!-- END TimelineJS -->
  <{else}>
    <div class="jumbotron bg-light p-5 rounded-lg m-3 text-center">
      <h1><{$smarty.const._MD_TAD_TIMELINE_EMPTY}></h1>
    </div>
  <{/if}>


<div class="text-right text-end" style="margin:30px 0px;">
  <{if $edit_event|default:false}>
    <{if $timeline_sn|default:false}>
      <a href="javascript:delete_tad_timeline_func(<{$timeline_sn|default:''}>);" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> <{$smarty.const._TAD_DEL}></a>
      <a href="<{$action|default:''}>?op=tad_timeline_form&timeline_sn=<{$timeline_sn|default:''}>" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i>  <{$smarty.const._TAD_EDIT}></a>
    <{/if}>
    <button class="btn btn-primary" id="add_event"><i class="fa fa-square-plus" aria-hidden="true"></i>  <{$smarty.const._TAD_ADD}></button>
  <{/if}>

  <{if $now_op=="list_tad_timeline"}>
    <a href="index.php?op=timeline_mode" class="btn btn-success" ><{$smarty.const._MD_TAD_TIMELINE_TIMELINE_MODE}></a>
  <{else}>
    <a href="index.php?op=list_tad_timeline" class="btn btn-success" ><{$smarty.const._MD_TAD_TIMELINE_LIST_MODE}></a>
  <{/if}>
</div>

<!-- 判斷目前使用者是否有：發布權限 -->
<{if $edit_event|default:false}>
  <!--顯示表單-->
  <div class="well card card-body bg-light m-1" style="display: none;" id="edit_timeline">
    <{include file="$xoops_rootpath/modules/tad_timeline/templates/op_tad_timeline_form.tpl"}>
  </div>
<{/if}>