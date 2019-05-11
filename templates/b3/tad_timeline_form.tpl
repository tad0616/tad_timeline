<form action="<{$action}>" method="post" id="myForm" enctype="multipart/form-data" class="form-horizontal" role="form">

  <!--事件年-->
  <div class="form-group">
    <label class="col-sm-2 control-label">
      <{$smarty.const._MD_TAD_TIMELINE_YEAR}>
    </label>
    <div class="col-sm-4">

      <div class="input-group">
        <span class="input-group-addon"><{$smarty.const._MD_TAD_TIMELINE_AD}></span>
        <input type="text" name="year" id="year" class="form-control validate[required, custom[integer], minSize[4], maxSize[4]]" value="<{$year}>" placeholder="<{$smarty.const._MD_TAD_TIMELINE_YEAR}>">
        <span class="input-group-addon"><{$smarty.const._MD_TAD_TIMELINE_Y}></span>
      </div>
    </div>

    <!--事件月-->
    <div class="col-sm-2">
      <div class="input-group">
        <input type="text" name="month" id="month" class="form-control validate[custom[integer], min[1], max[12]]" value="<{$month}>" placeholder="<{$smarty.const._MD_TAD_TIMELINE_MONTH}>">
        <span class="input-group-addon"><{$smarty.const._MD_TAD_TIMELINE_M}></span>
      </div>
    </div>

    <!--事件日-->
    <div class="col-sm-2">
      <div class="input-group">
        <input type="text" name="day" id="day" class="form-control validate[custom[integer], min[1], max[31]]" value="<{$day}>" placeholder="<{$smarty.const._MD_TAD_TIMELINE_DAY}>">
        <span class="input-group-addon"><{$smarty.const._MD_TAD_TIMELINE_D}></span>
      </div>
    </div>
  </div>

  <!--事件標題-->
  <div class="form-group">
    <label class="col-sm-2 control-label">
      <{$smarty.const._MD_TAD_TIMELINE_TEXT_HEADLINE}>
    </label>
    <div class="col-sm-10">
      <input type="text" name="text_headline" id="text_headline" class="form-control validate[required]" value="<{$text_headline}>" placeholder="<{$smarty.const._MD_TAD_TIMELINE_TEXT_HEADLINE}>">
    </div>
  </div>

  <!--事件說明-->
  <div class="form-group">
    <label class="col-sm-2 control-label">
      <{$smarty.const._MD_TAD_TIMELINE_TEXT_TEXT}>
    </label>
    <div class="col-sm-10">
      <textarea name="text_text" id="text_text" class="form-control" cols="30" rows="4"><{$text_text}></textarea>
    </div>
  </div>

  <!--上傳-->
  <div class="form-group">
    <label class="col-sm-2 control-label">
      <{$smarty.const._MD_TAD_TIMELINE_UP_EVENT_SN}>
    </label>
    <div class="col-sm-10">
      <{$up_timeline_sn_form}>
    </div>
  </div>

  <div class="text-center">

  <!--事件編號-->
  <input type='hidden' name="timeline_sn" value="<{$timeline_sn}>">

    <{$token_form}>

    <input type="hidden" name="op" value="<{$next_op}>">
    <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
  </div>
</form>