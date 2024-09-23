<{if $all_content|default:false}>
  <{if $edit_event|default:false}>
    <{$delete_tad_timeline_func|default:''}>
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
        <{if $edit_event|default:false}>
          <th><{$smarty.const._TAD_FUNCTION}></th>
        <{/if}>
      </tr>
    </thead>

    <tbody id="tad_timeline_sort">
      <{foreach from=$all_content item=data}>
        <tr id="tr_<{$data.timeline_sn}>">

          <td>
            <{$data.year}><{if $data.month|default:false}>-<{$data.month}><{if $data.day|default:false}>-<{$data.day}><{/if}><{/if}>
          </td>

          <td>
            <!--事件標題-->
            <a href="<{$xoops_url}>/modules/tad_timeline/index.php?timeline_sn=<{$data.timeline_sn}>"><{$data.text_headline}></a>
            <{$data.list_file}>
          </td>

          <{if $edit_event|default:false}>
            <td nowrap="nowrap">
              <a href="javascript:delete_tad_timeline_func(<{$data.timeline_sn}>);" class="btn btn-sm btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
              <a href="<{$xoops_url}>/modules/tad_timeline/index.php?op=tad_timeline_form&timeline_sn=<{$data.timeline_sn}>" class="btn btn-sm btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
            </td>
          <{/if}>
        </tr>
      <{/foreach}>
    </tbody>
  </table>
  <{$bar|default:''}>
<{else}>
  <div class="jumbotron bg-light p-5 rounded-lg m-3 text-center">
    <h1><{$smarty.const._MD_TAD_TIMELINE_EMPTY}></h1>
  </div>
<{/if}>