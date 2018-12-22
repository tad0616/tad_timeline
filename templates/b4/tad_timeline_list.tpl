<{if $all_content}>
  <{if $edit_event}>
    <{$delete_tad_timeline_func}>
  <{/if}>

  <div id="tad_timeline_save_msg"></div>

  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr class="info">
        <th>
          <{$smarty.const._MD_TAD_TIMELINE_EVENT_DATE}>
        </th>
        <th>
          <!--事件標題-->
          <{$smarty.const._MD_TAD_TIMELINE_TEXT_HEADLINE}>
        </th>
        <{if $edit_event}>
          <th><{$smarty.const._TAD_FUNCTION}></th>
        <{/if}>
      </tr>
    </thead>

    <tbody id="tad_timeline_sort">
      <{foreach from=$all_content item=data}>
        <tr id="tr_<{$data.timeline_sn}>">

          <td>
            <{$data.year}><{if $data.month}>-<{$data.month}><{if $data.day}>-<{$data.day}><{/if}><{/if}>
          </td>

          <td>
            <!--事件標題-->
            <a href="<{$xoops_url}>/modules/tad_timeline/index.php?timeline_sn=<{$data.timeline_sn}>"><{$data.text_headline}></a>
            <{$data.list_file}>
          </td>

          <{if $edit_event}>
            <td nowrap="nowrap">
              <a href="javascript:delete_tad_timeline_func(<{$data.timeline_sn}>);" class="btn btn-sm btn-danger"><{$smarty.const._TAD_DEL}></a>
              <a href="<{$xoops_url}>/modules/tad_timeline/index.php?op=tad_timeline_form&timeline_sn=<{$data.timeline_sn}>" class="btn btn-sm btn-warning"><{$smarty.const._TAD_EDIT}></a>
            </td>
          <{/if}>
        </tr>
      <{/foreach}>
    </tbody>
  </table>
  <{$bar}>
<{else}>
  <div class="jumbotron text-center">
    <h1><{$smarty.const._MD_TAD_TIMELINE_EMPTY}></h1>
  </div>
<{/if}>