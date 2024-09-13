<div class="container-fluid">

  <!--顯示表單-->
  <{if $now_op=="tad_timeline_form"}>
    <{include file="$xoops_rootpath/modules/tad_timeline/templates/tad_timeline_form.tpl"}>
  <{/if}>


  <!--列出所有資料-->
  <{if $now_op=="list_tad_timeline"}>
    <{include file="$xoops_rootpath/modules/tad_timeline/templates/tad_timeline_list.tpl"}>
  <{/if}>

</div>