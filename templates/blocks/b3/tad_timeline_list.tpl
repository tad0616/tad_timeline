<{if $block.have_content}>
  <{if $block.mode!="timeline"}>
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="info">
        <th>
          <{$smarty.const._MB_TAD_TIMELINE_EVENT_DATE}>
        </th>
        <th>
          <!--事件標題-->
          <{$smarty.const._MB_TAD_TIMELINE_TEXT_HEADLINE}>
        </th>
      </tr>
    </thead>

    <tbody id="tad_timeline_sort">
      <{foreach from=$block.all_content item=data}>
        <tr id="tr_<{$data.timeline_sn}>">
          <td>
            <{$data.year}><{if $data.month}>-<{$data.month}><{if $data.day}>-<{$data.day}><{/if}><{/if}>
          </td>

          <td>
            <!--事件標題-->
            <a href="<{$xoops_url}>/modules/tad_timeline/index.php?timeline_sn=<{$data.timeline_sn}>"><{$data.text_headline}></a>
            <{$data.list_file}>
          </td>
        </tr>
      <{/foreach}>
    </tbody>
  </table>
  <{else}>

    <!-- BEGIN TimelineJS -->
    <script type="text/javascript" src="<{$xoops_url}>/modules/tad_timeline/class/timeline/js/storyjs-embed.js"></script>
    <script>
      $(document).ready(function() {
        createStoryJS({
          type:             'timeline',
          width:            '100%',
          height:           '500',
          start_at_end:     false,
          start_at_slide:   <{$block.start_at_slide}>,
          start_zoom_adjust:2,
          lang:             'zh-tw',
          source:           '<{$xoops_url}>/uploads/tad_timeline/tad_timeline.json',
          embed_id:         'my-timeline-block',
          debug:            true
        });
      });
    </script>
    <!-- END TimelineJS -->

    <div class="row">
      <div class="col-sm-12">
        <div id="my-timeline-block"></div>
      </div>
    </div>
  <{/if}>
<{/if}>