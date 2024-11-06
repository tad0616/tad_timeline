<{if $block.have_content|default:false}>
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
            <{$data.year}><{if $data.month|default:false}>-<{$data.month}><{if $data.day|default:false}>-<{$data.day}><{/if}><{/if}>
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
    <div id="my-timeline-block" style="width: 100%; height: 600px"></div>
    <script type="text/javascript">
        var additionalOptions = {
          start_at_end: false,
          default_bg_color: {r:255, g:255, b:255},
          start_at_slide: <{$block.start_at_slide|default:0}>,
          language: 'zh-tw'
        }

        window.timeline = new TL.Timeline('my-timeline-block','<{$xoops_url}>/uploads/tad_timeline/tad_timeline.json',
        additionalOptions);
    </script>
    <!-- END TimelineJS -->

    <div class="row">
      <div class="col-md-12">
        <div id="my-timeline-block"></div>
      </div>
    </div>
  <{/if}>
<{/if}>