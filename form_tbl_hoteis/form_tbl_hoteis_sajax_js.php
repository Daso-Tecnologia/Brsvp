
 <form name="form_ajax_redir_1" method="post" style="display: none">
  <input type="hidden" name="nmgp_parms">
  <input type="hidden" name="nmgp_outra_jan">

 </form>
 <form name="form_ajax_redir_2" method="post" style="display: none">
  <input type="hidden" name="nmgp_parms">
  <input type="hidden" name="nmgp_url_saida">
  <input type="hidden" name="script_case_init">

 </form>

 <SCRIPT>
<?php
sajax_show_javascript();
?>

  function scCenterElement(oElem)
  {
    var $oElem    = $(oElem),
        $oWindow  = $(this),
        iElemTop  = Math.round(($oWindow.height() - $oElem.height()) / 2),
        iElemLeft = Math.round(($oWindow.width()  - $oElem.width())  / 2);

    $oElem.offset({top: iElemTop, left: iElemLeft});
  } // scCenterElement

  function scAjaxHideAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId))
    {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "none";
    }
  } // scAjaxHideAutocomp

  function scAjaxShowAutocomp(sFrameId)
  {
    if (document.getElementById("id_ac_frame_" + sFrameId))
    {
      document.getElementById("id_ac_frame_" + sFrameId).style.display = "";
      document.getElementById("id_ac_" + sFrameId).focus();
    }
  } // scAjaxShowAutocomp

  function scAjaxHideDebug()
  {
    if (document.getElementById("id_debug_window"))
    {
      document.getElementById("id_debug_window").style.display = "none";
      document.getElementById("id_debug_text").innerHTML = "";
    }
  } // scAjaxHideDebug

  function scAjaxShowDebug(oTemp)
  {
    if (!document.getElementById("id_debug_window"))
    {
      return;
    }
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (oResp["htmOutput"] && "" != oResp["htmOutput"])
    {
      document.getElementById("id_debug_window").style.display = "";
      document.getElementById("id_debug_text").innerHTML = scAjaxFormatDebug(oResp["htmOutput"]) + document.getElementById("id_debug_text").innerHTML;
      //scCenterElement(document.getElementById("id_debug_window"));
    }
  } // scAjaxShowDebug

  function scAjaxFormatDebug(sDebugMsg)
  {
    return "<table class=\"scFormMessageTable\" style=\"margin: 1px; width: 100%\"><tr><td class=\"scFormMessageMessage\">" + scAjaxSpecCharParser(sDebugMsg) + "</td></tr></table>";
  } // scAjaxFormatDebug

  function scAjaxHideErrorDisplay_default(sErrorId, bForce)
  {
    if (document.getElementById("id_error_display_" + sErrorId + "_frame"))
    {
        document.getElementById("id_error_display_" + sErrorId + "_frame").style.display = "none";
        document.getElementById("id_error_display_" + sErrorId + "_text").innerHTML = "";
        if (null == bForce)
        {
            bForce = true;
        }
        if (bForce)
        {
            var $oField = $('#id_sc_field_' + sErrorId);
            if (0 < $oField.length)
            {
                scAjax_removeFieldErrorStyle($oField);
            }
        }
    }
    if (document.getElementById("id_error_display_fixed"))
    {
        document.getElementById("id_error_display_fixed").style.display = "none";
    }
  } // scAjaxHideErrorDisplay_default

  function scAjaxShowErrorDisplay_default(sErrorId, sErrorMsg)
  {
    if (oResp && oResp['redirExitInfo'])
    {
      sErrorMsg += "<br /><input type=\"button\" onClick=\"window.location='" + oResp['redirExitInfo']['action'] + "'\" value=\"Ok\">";
    }
    sErrorMsg = scAjaxErrorSql(sErrorMsg);
    if (document.getElementById("id_error_display_" + sErrorId + "_frame"))
    {
      document.getElementById("id_error_display_" + sErrorId + "_frame").style.display = "";
      document.getElementById("id_error_display_" + sErrorId + "_text").innerHTML = sErrorMsg;
      if ("table" == sErrorId)
      {
        scCenterElement(document.getElementById("id_error_display_" + sErrorId + "_frame"));
      }
      var $oField = $('#id_sc_field_' + sErrorId);
      if (0 < $oField.length)
      {
        scAjax_applyFieldErrorStyle($oField);
      }
    }
    if (ajax_error_list && ajax_error_list[sErrorId] && ajax_error_list[sErrorId]["timeout"] && 0 < ajax_error_list[sErrorId]["timeout"])
    {
      setTimeout("scAjaxHideErrorDisplay('" + sErrorId + "', false)", ajax_error_list[sErrorId]["timeout"] * 1000);
    }
  } // scAjaxShowErrorDisplay_default

  var iErrorSqlId = 1;

  function scAjaxErrorSql(sErrorMsg)
  {
    var iTmpPos = sErrorMsg.indexOf("{SC_DB_ERROR_INI}"),
        sTmpId;
    while (-1 < iTmpPos)
    {
      sTmpId    = "sc_id_error_sql_" + iErrorSqlId;
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "<br /><span style=\"text-decoration: underline\" onClick=\"$('#" + sTmpId + "').show(); scCenterElement(document.getElementById('" + sTmpId + "'))\">" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_MID}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "</span><table class=\"scFormErrorTable\" id=\"" + sTmpId + "\" style=\"display: none; position: absolute\"><tr><td>" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_CLS}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "<br /><br /><span onClick=\"$('#" + sTmpId + "').hide()\">" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_END}");
      sErrorMsg = sErrorMsg.substr(0, iTmpPos) + "</span></td></tr></table>" + sErrorMsg.substr(iTmpPos + 17);
      iTmpPos   = sErrorMsg.indexOf("{SC_DB_ERROR_INI}");
      iErrorSqlId++;
    }
    return sErrorMsg;
  } // scAjaxErrorSql

  function scAjaxHideMessage_default()
  {
    if (document.getElementById("id_message_display_frame"))
    {
      document.getElementById("id_message_display_frame").style.display = "none";
      document.getElementById("id_message_display_text").innerHTML = "";
    }
  } // scAjaxHideMessage

  function scAjaxShowMessage_default()
  {
    if (!oResp["msgDisplay"] || !oResp["msgDisplay"]["msgText"])
    {
      return;
    }
    _scAjaxShowMessage_default({title: scMsgDefTitle, message: oResp["msgDisplay"]["msgText"], isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: false, toastPos: ""});
  } // scAjaxShowMessage

  var scMsgDefClose = "";

  function _scAjaxShowMessage_default(params) {
        var sTitle = params["title"],
                sMessage = params["message"],
                bModal = params["isModal"],
                iTimeout = params["timeout"],
                bButton = params["showButton"],
                sButton = params["buttonLabel"],
                iTop = params["topPos"],
                iLeft = params["leftPos"],
                iWidth = params["width"],
                iHeight = params["height"],
                sRedir = params["redirUrl"],
                sTarget = params["redirTarget"],
                sParam = params["redirParam"],
                bClose = params["showClose"],
                bBodyIcon = params["showBodyIcon"],
                bToast = params["isToast"],
                sToastPos = params["toastPos"];
    if ("" == sMessage) {
      if (bModal) {
        scMsgDefClick = "close_modal";
      }
      else {
        scMsgDefClick = "close";
      }
      _scAjaxMessageBtnClick();
      document.getElementById("id_message_display_title").innerHTML = scMsgDefTitle;
      document.getElementById("id_message_display_text").innerHTML = "";
      document.getElementById("id_message_display_buttone").value = scMsgDefButton;
      document.getElementById("id_message_display_buttond").style.display = "none";
    }
    else {
      document.getElementById("id_message_display_title").innerHTML = scAjaxSpecCharParser(sTitle);
      document.getElementById("id_message_display_text").innerHTML = scAjaxSpecCharParser(sMessage);
      document.getElementById("id_message_display_buttone").value = sButton;
      document.getElementById("id_message_display_buttond").style.display = bButton ? "" : "none";
      document.getElementById("id_message_display_buttond").style.display = bButton ? "" : "none";
      document.getElementById("id_message_display_title_line").style.display = (bClose || "" != sTitle) ? "" : "none";
      document.getElementById("id_message_display_close_icon").style.display = bClose ? "" : "none";
      if (document.getElementById("id_message_display_body_icon")) {
        document.getElementById("id_message_display_body_icon").style.display = bBodyIcon ? "" : "none";
      }
      $("#id_message_display_content").css('width', (0 < iWidth ? iWidth + 'px' : ''));
      $("#id_message_display_content").css('height', (0 < iHeight ? iHeight + 'px' : ''));
      if (bModal) {
        iWidth = iWidth || 250;
        iHeight = iHeight || 200;
        scMsgDefClose = "close_modal";
        tb_show('', '#TB_inline?height=' + (iHeight + 6) + '&width=' + (iWidth + 4) + '&inlineId=id_message_display_frame&modal=true', '');
        if (bButton) {
          if ("" != sRedir && "" != sTarget) {
            scMsgDefClick = "redir2_modal";
            document.form_ajax_redir_2.action = sRedir;
            document.form_ajax_redir_2.target = sTarget;
            document.form_ajax_redir_2.nmgp_parms.value = sParam;
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
          }
          else if ("" != sRedir && "" == sTarget) {
            scMsgDefClick = "redir1";
            document.form_ajax_redir_1.action = sRedir;
            document.form_ajax_redir_1.nmgp_parms.value = sParam;
          }
          else {
            scMsgDefClick = "close_modal";
          }
        }
        else if (null != iTimeout && 0 < iTimeout) {
          scMsgDefClick = "close_modal";
          setTimeout("_scAjaxMessageBtnClick()", iTimeout * 1000);
        }
      }
      else
      {
        scMsgDefClose = "close";
        $("#id_message_display_frame").css('top', (0 < iTop ? iTop + 'px' : ''));
        $("#id_message_display_frame").css('left', (0 < iLeft ? iLeft + 'px' : ''));
        document.getElementById("id_message_display_frame").style.display = "";
        if (0 == iTop && 0 == iLeft) {
          scCenterElement(document.getElementById("id_message_display_frame"));
        }
        if (bButton) {
          if ("" != sRedir && "" != sTarget) {
            scMsgDefClick = "redir2";
            document.form_ajax_redir_2.action = sRedir;
            document.form_ajax_redir_2.target = sTarget;
            document.form_ajax_redir_2.nmgp_parms.value = sParam;
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
          }
          else if ("" != sRedir && "" == sTarget) {
            scMsgDefClick = "redir1";
            document.form_ajax_redir_1.action = sRedir;
            document.form_ajax_redir_1.nmgp_parms.value = sParam;
          }
          else {
            scMsgDefClick = "close";
          }
        }
        else if (null != iTimeout && 0 < iTimeout) {
          scMsgDefClick = "close";
          setTimeout("_scAjaxMessageBtnClick()", iTimeout * 1000);
        }
      }
    }
  } // _scAjaxShowMessage_default

  function _scAjaxMessageBtnClose() {
    switch (scMsgDefClose) {
      case "close":
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "close_modal":
        tb_remove();
        break;
    }
  } // _scAjaxMessageBtnClick

  function _scAjaxMessageBtnClick() {
    switch (scMsgDefClick) {
      case "close":
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "close_modal":
        tb_remove();
        break;
      case "dismiss":
        scAjaxHideMessage();
        break;
      case "redir1":
        document.form_ajax_redir_1.submit();
        break;
      case "redir2":
        document.form_ajax_redir_2.submit();
        document.getElementById("id_message_display_frame").style.display = "none";
        break;
      case "redir2_modal":
        document.form_ajax_redir_2.submit();
        tb_remove();
        break;
    }
  } // _scAjaxMessageBtnClick

  function scAjaxHasError()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "ERROR" == oResp["result"];
  } // scAjaxHasError

  function scAjaxIsOk()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "OK" == oResp["result"] || "SET" == oResp["result"];
  } // scAjaxIsOk

  function scAjaxIsSet()
  {
    if (!oResp["result"])
    {
      return false;
    }
    return "SET" == oResp["result"];
  } // scAjaxIsSet

  function scAjaxCalendarReload()
  {
    if (oResp["calendarReload"] && "OK" == oResp["calendarReload"] && typeof self.parent.calendar_reload == "function")
    {
<?php
if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && isset($_SESSION['scriptcase']['display_mobile']) && $_SESSION['scriptcase']['display_mobile']) {
?>
      self.parent.calendar_reload();
      self.parent.tb_remove();
<?php
} else {
?>
      self.parent.calendar_reload();
      self.parent.tb_remove();
<?php
}
?>
      return true;
    }
    return false;
  } // scCalendarReload

  function scAjaxUpdateErrors(sType)
  {
    ajax_error_geral = "";
    oFieldErrors     = {};
    if (oResp["errList"])
    {
      for (iFieldErrors = 0; iFieldErrors < oResp["errList"].length; iFieldErrors++)
      {
        sTestField = oResp["errList"][iFieldErrors]["fldName"];
        if ("geral_form_tbl_hoteis" == sTestField)
        {
          if (ajax_error_geral != '') { ajax_error_geral += '<br>';}
          ajax_error_geral += scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
        }
        else
        {
          if (scFocusFirstErrorField && '' == scFocusFirstErrorName)
          {
            scFocusFirstErrorName = sTestField;
          }
          if (oResp["errList"][iFieldErrors]["numLinha"])
          {
            sTestField += oResp["errList"][iFieldErrors]["numLinha"];
          }
          if (!oFieldErrors[sTestField])
          {
            oFieldErrors[sTestField] = new Array();
          }
          oFieldErrors[sTestField][oFieldErrors[sTestField].length] = scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
        }
      }
    }
    for (iUpdateErrors = 0; iUpdateErrors < ajax_field_list.length; iUpdateErrors++)
    {
      sTestField = ajax_field_list[iUpdateErrors];
      if (oFieldErrors[sTestField])
      {
        ajax_error_list[sTestField][sType] = oFieldErrors[sTestField];
      }
    }
  } // scAjaxUpdateErrors

  function scAjaxUpdateFieldErrors(sField, sType)
  {
    aFieldErrors = new Array();
    if (oResp["errList"])
    {
      iErrorPos  = 0;
      for (iFieldErrors = 0; iFieldErrors < oResp["errList"].length; iFieldErrors++)
      {
        sTestField = oResp["errList"][iFieldErrors]["fldName"];
        if (oResp["errList"][iFieldErrors]["numLinha"])
        {
          sTestField += oResp["errList"][iFieldErrors]["numLinha"];
        }
        if (sField == sTestField)
        {
          aFieldErrors[iErrorPos] = scAjaxSpecCharParser(oResp["errList"][iFieldErrors]["msgText"]);
          iErrorPos++;
        }
      }
    }
        if (ajax_error_list[sField])
        {
        ajax_error_list[sField][sType] = aFieldErrors;
        }
  } // scAjaxUpdateFieldErrors

  function scAjaxListErrors(bLabel)
  {
    bFirst        = false;
    sAppErrorText = "";
    if ("" != ajax_error_geral)
    {
      bFirst         = true;
      sAppErrorText += ajax_error_geral;
    }
    for (iFieldList = 0; iFieldList < ajax_field_list.length; iFieldList++)
    {
      sFieldError = scAjaxListFieldErrors(ajax_field_list[iFieldList], bLabel);
      if ("" != sFieldError)
      {
        if (bFirst)
        {
          bFirst         = false
          sAppErrorText += "<hr size=\"1\" width=\"80%\" />";
        }
        sAppErrorText += sFieldError;
      }
    }
    return sAppErrorText;
  } // scAjaxListErrors

  function scAjaxListFieldErrors(sField, bLabel)
  {
    sErrorText = "";
    for (iErrorType = 0; iErrorType < ajax_error_type.length; iErrorType++)
    {
      if (ajax_error_list[sField])
      {
        for (iListErrors = 0; iListErrors < ajax_error_list[sField][ajax_error_type[iErrorType]].length; iListErrors++)
        {
          if (bLabel)
          {
            sErrorText += ajax_error_list[sField]["label"] + ": ";
          }
          sErrorText += ajax_error_list[sField][ajax_error_type[iErrorType]][iListErrors] + "<br />";
        }
      }
    }
    return sErrorText;
  } // scAjaxListFieldErrors

  function scAjaxClearErrors() {
    var fieldName;
    for (fieldName in ajax_error_list) {
         if (null != ajax_error_list[fieldName]) {
             ajax_error_list[fieldName]["valid"] = new Array();
             ajax_error_list[fieldName]["onblur"] = new Array();
             ajax_error_list[fieldName]["onchange"] = new Array();
             ajax_error_list[fieldName]["onclick"] = new Array();
             ajax_error_list[fieldName]["onfocus"] = new Array();
         }
    }
    ajax_error_geral = "";
  } // scAjaxClearErrors

  function scAjaxSetVariables()
  {
    if (!oResp["varList"])
    {
      return true;
    }
    for (var iVarFields = 0; iVarFields < oResp["varList"].length; iVarFields++)
    {
          if(typeof oResp["varList"][iVarFields] === 'object' && oResp["varList"][iVarFields] !== null)
          {
              var sVarName  = oResp["varList"][iVarFields].index;
              var sVarValue = oResp["varList"][iVarFields].value;
          }
          else
          {
              var sVarName  = oResp["varList"][iVarFields]["index"];
              var sVarValue = oResp["varList"][iVarFields]["value"];
          }

          if (sVarValue == 'new Array()') {
            eval(sVarName + " = new Array();");
          } else {
            eval(sVarName + " = \"" + sVarValue + "\";");
          }
    }
  } // scAjaxSetVariables
/*
  function scAjaxSetVariables()
  {
    if (!oResp["varList"])
    {
      return true;
    }
    for (var iVarFields = 0; iVarFields < oResp["varList"].length; iVarFields++)
    {
      var sVarName  = oResp["varList"][iVarFields]["index"];
      var sVarValue = oResp["varList"][iVarFields]["value"];
              if (sVarValue.indexOf('new Array') > -1) {
                        eval(sVarName + " = sVarValue;");
                  } else {
                        eval(sVarName + " = \"" + sVarValue + "\";");
                  }
        }
  } // scAjaxSetVariables
*/
  function scAjaxSetSummaryLine()
  {
    if (!oResp["navSummary"] || !oResp["navSummary"]["summary_line"])
    {
      return true;
    }
    $("#sc-summary-line").html(oResp["navSummary"]["summary_line"]);
  } // scAjaxSetSummaryLine

  function scAjaxSetFields()
  {
    if (!oResp["fldList"])
    {
      return true;
    }
    for (iSetFields = 0; iSetFields < oResp["fldList"].length; iSetFields++)
    {
      var sFieldName = oResp["fldList"][iSetFields]["fldName"];
      var sFieldType = oResp["fldList"][iSetFields]["fldType"];

      if ("selectdd" == sFieldType)
      {
        var bSelectDD = true;
        sFieldType = "select";
      }
      else
      {
        var bSelectDD = false;
      }
      if ("select2_ac" == sFieldType)
      {
        var bSelect2AC = true;
        sFieldType = "select";
      }
      else
      {
        var bSelect2AC = false;
      }
      if (oResp["fldList"][iSetFields]["valList"])
      {
        var oFieldValues = oResp["fldList"][iSetFields]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (oResp["fldList"][iSetFields]["optList"])
      {
        var oFieldOptions = oResp["fldList"][iSetFields]["optList"];
      }
      else
      {
        var oFieldOptions = null;
      }
/*
      if ("_autocomp" == sFieldName.substr(sFieldName.length - 9) &&
          iSetFields > 0 &&
          sFieldName.substr(0, sFieldName.length - 9) == oResp["fldList"][iSetFields - 1]["fldName"] &&
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)) &&
          oFieldValues[0]['value'])
      {
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)).innerHTML = oFieldValues[0]['value'];
      }
*/

      if ("corhtml" == sFieldType)
      {
        sFieldType = 'text';

        /*sCor = (oFieldValues[0]['value']) ? oFieldValues[0]['value'] : "";
        setaCorPaleta(sFieldName, sCor);*/
      }

      if ("_autocomp" == sFieldName.substr(sFieldName.length - 9) &&
          iSetFields > 0 &&
          sFieldName.substr(0, sFieldName.length - 9) == oResp["fldList"][iSetFields - 1]["fldName"] &&
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)))
      {
          sLabel_auto_Comp = (oFieldValues[0]['value']) ? oFieldValues[0]['value'] : "";
          document.getElementById("div_ac_lab_" + sFieldName.substr(0, sFieldName.length - 9)).innerHTML = sLabel_auto_Comp;
      }


      if (oResp["fldList"][iSetFields]["colNum"])
      {
        var iColNum = oResp["fldList"][iSetFields]["colNum"];
      }
      else
      {
        var iColNum = 1;
      }
      if (oResp["fldList"][iSetFields]["row"])
      {
        var iRow = oResp["fldList"][iSetFields]["row"];
                var thisRow = oResp["fldList"][iSetFields]["row"];
      }
      else
      {
        var iRow = 1;
                var thisRow = "";
      }
      if (oResp["fldList"][iSetFields]["htmComp"])
      {
        var sHtmComp = oResp["fldList"][iSetFields]["htmComp"];
        sHtmComp     = sHtmComp.replace(/__AD__/gi, '"');
        sHtmComp     = sHtmComp.replace(/__AS__/gi, "'");
      }
      else
      {
        var sHtmComp = null;
      }
      if (oResp["fldList"][iSetFields]["imgFile"])
      {
        var sImgFile = oResp["fldList"][iSetFields]["imgFile"];
      }
      else
      {
        var sImgFile = "";
      }
      if (oResp["fldList"][iSetFields]["imgOrig"])
      {
        var sImgOrig = oResp["fldList"][iSetFields]["imgOrig"];
      }
      else
      {
        var sImgOrig = "";
      }
      if (oResp["fldList"][iSetFields]["keepImg"])
      {
        var sKeepImg = oResp["fldList"][iSetFields]["keepImg"];
      }
      else
      {
        var sKeepImg = "N";
      }
      if (oResp["fldList"][iSetFields]["hideName"])
      {
        var sHideName = oResp["fldList"][iSetFields]["hideName"];
      }
      else
      {
        var sHideName = "N";
      }
      if (oResp["fldList"][iSetFields]["imgLink"])
      {
        var sImgLink = oResp["fldList"][iSetFields]["imgLink"];
      }
      else
      {
        var sImgLink = null;
      }
      if (oResp["fldList"][iSetFields]["docLink"])
      {
        var sDocLink = oResp["fldList"][iSetFields]["docLink"];
      }
      else
      {
        var sDocLink = "";
      }
      if (oResp["fldList"][iSetFields]["docIcon"])
      {
        var sDocIcon = oResp["fldList"][iSetFields]["docIcon"];
      }
      else
      {
        var sDocIcon = "";
      }

      if (oResp["fldList"][iSetFields]["docReadonly"])
      {
        var sDocReadonly = oResp["fldList"][iSetFields]["docReadonly"];
      }
      else
      {
        var sDocReadonly = "";
      }

      if (oResp["fldList"][iSetFields]["optComp"])
      {
        var sOptComp = oResp["fldList"][iSetFields]["optComp"];
      }
      else
      {
        var sOptComp = "";
      }
      if (oResp["fldList"][iSetFields]["optClass"])
      {
        var sOptClass = oResp["fldList"][iSetFields]["optClass"];
      }
      else
      {
        var sOptClass = "";
      }
      if (oResp["fldList"][iSetFields]["optMulti"])
      {
        var sOptMulti = oResp["fldList"][iSetFields]["optMulti"];
      }
      else
      {
        var sOptMulti = "";
      }
      if (oResp["fldList"][iSetFields]["imgHtml"])
      {
        var sImgHtml = oResp["fldList"][iSetFields]["imgHtml"];
      }
      else
      {
        var sImgHtml = "";
      }
      if (oResp["fldList"][iSetFields]["mulHtml"])
      {
        var sMULHtml = oResp["fldList"][iSetFields]["mulHtml"];
      }
      else
      {
        var sMULHtml = "";
      }
      if (oResp["fldList"][iSetFields]["updInnerHtml"])
      {
        var sInnerHtml = scAjaxSpecCharParser(oResp["fldList"][iSetFields]["updInnerHtml"]);
      }
      else
      {
        var sInnerHtml = null;
      }
      if (oResp["fldList"][iSetFields]["lookupCons"])
      {
        var sLookupCons = scAjaxSpecCharParser(oResp["fldList"][iSetFields]["lookupCons"]);
      }
      else
      {
        var sLookupCons = "";
      }
      if (oResp["clearUpload"])
      {
        var sClearUpload = scAjaxSpecCharParser(oResp["clearUpload"]);
      }
      else
      {
        var sClearUpload = "N";
      }
      if (oResp["eventField"])
      {
        var sEventField = scAjaxSpecCharParser(oResp["eventField"]);
      }
      else
      {
        var sEventField = "__SC_NO_FIELD";
      }
      if (oResp["fldList"][iSetFields]["switch"])
      {
        var bSwitch = true == oResp["fldList"][iSetFields]["switch"];
      }
      else
      {
        var bSwitch = false;
      }
      if ("checkbox" == sFieldType)
      {
        scAjaxSetFieldCheckbox(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sInnerHtml, sOptComp, sOptClass, sOptMulti, bSwitch, sEventField);
      }
      else if ("duplosel" == sFieldType)
      {
        scAjaxSetFieldDuplosel(sFieldName, oFieldValues, oFieldOptions);
      }
      else if ("imagem" == sFieldType)
      {
        scAjaxSetFieldImage(sFieldName, oFieldValues, sImgFile, sImgOrig, sImgLink, sKeepImg, sHideName);
      }
      else if ("documento" == sFieldType)
      {
        scAjaxSetFieldDocument(sFieldName, oFieldValues, sDocLink, sDocIcon, sClearUpload, sDocReadonly);
      }
      else if ("label" == sFieldType)
      {
        scAjaxSetFieldLabel(sFieldName, oFieldValues, oFieldOptions, sLookupCons);
      }
      else if ("radio" == sFieldType)
      {
        scAjaxSetFieldRadio(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, bSwitch, sEventField);
      }
      else if ("select" == sFieldType)
      {
        scAjaxSetFieldSelect(sFieldName, oFieldValues, oFieldOptions, bSelectDD, bSelect2AC, iRow, sEventField, thisRow);
      }
      else if ("text" == sFieldType)
      {
        scAjaxSetFieldText(sFieldName, oFieldValues, sLookupCons, thisRow, sEventField);
      }
      else if ("color_palette" == sFieldType)
      {
        scAjaxSetFieldColorPalette(sFieldName, oFieldValues);
      }
      else if ("editor_html" == sFieldType)
      {
        scAjaxSetFieldEditorHtml(sFieldName, oFieldValues);
      }
      else if ("imagehtml" == sFieldType)
      {
        scAjaxSetFieldImageHtml(sFieldName, oFieldValues, sImgHtml);
      }
      else if ("innerhtml" == sFieldType)
      {
        scAjaxSetFieldInnerHtml(sFieldName, oFieldValues);
      }
      else if ("multi_upload" == sFieldType)
      {
        scAjaxSetFieldMultiUpload(sFieldName, sMULHtml);
      }
      else if ("recur_info" == sFieldType)
      {
        scAjaxSetFieldRecurInfo(sFieldName, sMULHtml);
      }
      else if ("signature" == sFieldType)
      {
        scAjaxSetFieldSignature(sFieldName, oFieldValues);
      }
      else if ("rating" == sFieldType)
      {
        scAjaxSetFieldRating(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingstar" == sFieldType)
      {
        scAjaxSetFieldRatingStar(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingsmile" == sFieldType)
      {
        scAjaxSetFieldRatingSmile(sFieldName, oFieldValues, thisRow);
      }
      else if ("ratingthumb" == sFieldType)
      {
        scAjaxSetFieldRatingThumb(sFieldName, oFieldValues, thisRow);
      }
      scAjaxUpdateHeaderFooter(sFieldName, oFieldValues);
    }
  } // scAjaxSetFields

  function scAjaxUpdateHeaderFooter(sFieldName, oFieldValues)
  {
    if (self.updateHeaderFooter)
    {
      if (null == oFieldValues)
      {
        sNewValue = '';
      }
      else if (oFieldValues[0]["label"])
      {
        sNewValue = oFieldValues[0]["label"];
      }
      else
      {
        sNewValue = oFieldValues[0]["value"];
      }
      updateHeaderFooter(sFieldName, scAjaxSpecCharParser(sNewValue));
    }
  } // scAjaxUpdateHeaderFooter

  function scAjaxSetFieldText(sFieldName, oFieldValues, sLookupCons, thisRow, sEventField)
  {
    if (document.F1.elements[sFieldName])
    {
      var jqField = $("#id_sc_field_" + sFieldName),
          Temp_text = scAjaxReturnBreakLine(scAjaxSpecCharParser(scAjaxProtectBreakLine(oFieldValues[0]['value'])));
      if (jqField.length)
      {
        jqField.val(Temp_text);
        if (sEventField != sFieldName && sEventField != "__SC_NO_FIELD" && sEventField != "")
        {
          //jqField.trigger("change");
        }
      }
      else
      {
        eval("document.F1." + sFieldName + ".value = Temp_text");
      }
      if (scEventControl_data[sFieldName]) {
        scEventControl_data[sFieldName]["calculated"] = Temp_text;
      }
    }
    if (document.getElementById("id_lookup_" + sFieldName))
    {
      document.getElementById("id_lookup_" + sFieldName).innerHTML = sLookupCons;
    }
    if (oFieldValues[0]['label'])
    {
      scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues);
    }
    else
    {
      oFieldValues[0]['value'] = scAjaxBreakLine(oFieldValues[0]['value']);
      scAjaxSetReadonlyValue(sFieldName, oFieldValues[0]['value']);
    }
        scAjaxSetSliderValue(sFieldName, thisRow);
  } // scAjaxSetFieldText

  function scAjaxSetSliderValue(fieldName, thisRow)
  {
          var sliderObject = $("#sc-ui-slide-" + fieldName);
          if (!sliderObject.length) {
                  return;
          }
          scJQSlideValue(fieldName, thisRow);
  } // scAjaxSetSliderValue

  function scAjaxSetFieldColorPalette(sFieldName, oFieldValues)
  {
    if (document.F1.elements[sFieldName])
    {
        var Temp_text = scAjaxReturnBreakLine(scAjaxSpecCharParser(scAjaxProtectBreakLine(oFieldValues[0]['value'])));
        eval ("document.F1." + sFieldName + ".value = Temp_text");
    }
    if (oFieldValues[0]['label'])
    {
      scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues);
    }
    else
    {
      oFieldValues[0]['value'] = scAjaxBreakLine(oFieldValues[0]['value']);
          setaCorPaleta(sFieldName, oFieldValues[0]['value']);
      scAjaxSetReadonlyValue(sFieldName, oFieldValues[0]['value']);
    }
  } // scAjaxSetFieldColorPalette

  function scAjaxSetFieldSelect(sFieldName, oFieldValues, oFieldOptions, bSelectDD, bSelect2AC, iRow, sEventField, thisRow)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    if (bSelectDD)
    {
        $("#id_sc_field_" + sFieldName).dropdownchecklist("destroy");
    }
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      scAjaxSetFieldText(sFieldNameHtml, oFieldValues, "", "", sEventField);
      return;
    }

    if (null != oFieldOptions)
    {
      $("#id_sc_field_" + sFieldName).children().remove()
      if ("<select" != oFieldOptions.substr(0, 7))
      {
        var $oField = $("#id_sc_field_" + sFieldName);
        if (0 < $oField.length)
        {
          $oField.html(oFieldOptions);
        }
        else
        {
          document.getElementById("idAjaxSelect_" + sFieldName).innerHTML = oFieldOptions;
        }
      }
      else
      {
        document.getElementById("idAjaxSelect_" + sFieldName).innerHTML = oFieldOptions;
      }
    }
    var aValues = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    var oFormField = $("#id_sc_field_" + sFieldName);
    for (iFieldSelect = 0; iFieldSelect < oFormField[0].length; iFieldSelect++)
    {
      if (scAjaxInArray(oFormField[0].options[iFieldSelect].value, aValues))
      {
        oFormField[0].options[iFieldSelect].selected = true;
      }
      else
      {
        oFormField[0].options[iFieldSelect].selected = false;
      }
    }
        scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
    if (bSelectDD)
    {
        scJQDDCheckBoxAdd(thisRow, true);
    }
        if (bSelect2AC)
        {
                var newOption = new Option(oFieldValues[0]["label"], oFieldValues[0]["value"], true, true);
                $("#id_ac_" + sFieldName).append(newOption);
                $("#id_sc_field_" + sFieldName).val(oFieldValues[0]["value"]);
        }
        else if (oFormField.hasClass("select2-hidden-accessible"))
        {
        $("#id_sc_field_" + sFieldName).select2("destroy");
                var select2Field = sFieldName;
                if ("" != thisRow) {
                        select2Field = select2Field.substr(0, select2Field.length - thisRow.toString().length);
                }
        scJQSelect2Add(thisRow, select2Field);
        }
  } // scAjaxSetFieldSelect

  function scAjaxSetFieldDuplosel(sFieldName, oFieldValues, oFieldOptions)
  {
    var sFieldNameOrig = sFieldName + "_orig";
    var sFieldNameDest = sFieldName + "_dest";
    var oFormFieldOrig = document.F1.elements[sFieldNameOrig];
    var oFormFieldDest = document.F1.elements[sFieldNameDest];

    if (null != oFieldOptions)
    {
      scAjaxClearSelect(sFieldNameOrig);
      for (iFieldSelect = 0; iFieldSelect < oFieldOptions.length; iFieldSelect++)
      {
        oFormFieldOrig.options[iFieldSelect] = new Option(scAjaxSpecCharParser(oFieldOptions[iFieldSelect]["label"]), scAjaxSpecCharParser(oFieldOptions[iFieldSelect]["value"]));
      }
    }
    while (oFormFieldDest.length > 0)
    {
      oFormFieldDest.options[0] = null;
    }
    var aValues = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        sNewOptionLabel = oFieldValues[iFieldSelect]["label"] ? scAjaxSpecCharParser(oFieldValues[iFieldSelect]["label"]) : scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
        sNewOptionValue = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
        if (sNewOptionValue.substr(0, 8) == "@NMorder")
        {
           sNewOptionValue                      = sNewOptionValue.substr(8);
           oFormFieldDest.options[iFieldSelect] = new Option(scAjaxSpecCharParser(sNewOptionLabel), sNewOptionValue);
           sNewOptionValue                      = sNewOptionValue.substr(1);
           aValues[iFieldSelect]                = sNewOptionValue;
        }
        else
        {
           aValues[iFieldSelect]                = sNewOptionValue;
           oFormFieldDest.options[iFieldSelect] = new Option(scAjaxSpecCharParser(sNewOptionLabel), sNewOptionValue);
        }
      }
    }
    for (iFieldSelect = 0; iFieldSelect < oFormFieldOrig.length; iFieldSelect++)
    {
      oFormFieldOrig.options[iFieldSelect].selected = false;
      if (scAjaxInArray(oFormFieldOrig.options[iFieldSelect].value, aValues))
      {
        oFormFieldOrig.options[iFieldSelect].disabled    = true;
        oFormFieldOrig.options[iFieldSelect].style.color = "#A0A0A0";
      }
      else
      {
        oFormFieldOrig.options[iFieldSelect].disabled = false;
      }
    }
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldDuplosel

  function scAjaxSetFieldCheckbox(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sInnerHtml, sOptComp, sOptClass, sOptMulti, bSwitch, sEventField)
  {
        if (null == bSwitch)
        {
          bSwitch = false;
        }
    if (document.getElementById("idAjaxCheckbox_" + sFieldName) && null != sInnerHtml)
    {
      document.getElementById("idAjaxCheckbox_" + sFieldName).innerHTML = sInnerHtml;
      return;
    }
    if (null != oFieldOptions)
    {
        scAjaxClearCheckbox(sFieldName);
    }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      scAjaxSetFieldText(sFieldName, oFieldValues, "", "", sEventField);
      return;
    }
    if (null != oFieldOptions && "" != oFieldOptions)
    {
/*      scAjaxClearCheckbox(sFieldName); */
      scAjaxRecreateOptions("Checkbox", "checkbox", sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, sOptClass, sOptMulti, bSwitch);
    }
    else
    {
      scAjaxSetCheckboxOptions(sFieldName, oFieldValues);
    }
        scAjaxSetSwitchOptions(sFieldName, "checkbox");
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldCheckbox

  function scAjaxSetFieldRadio(sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, bSwitch, sEventField)
  {
        if (null == bSwitch)
        {
          bSwitch = false;
        }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      scAjaxSetFieldText(sFieldName, oFieldValues, "", "", sEventField);
      return;
    }
    if (null != oFieldOptions)
    {
        scAjaxClearRadio(sFieldName);
    }
    if (null != oFieldOptions && "" != oFieldOptions)
    {
/*      scAjaxClearRadio(sFieldName); */
      scAjaxRecreateOptions("Radio", "radio", sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, "", "", bSwitch);
    }
    else
    {
      scAjaxSetRadioOptions(sFieldName, oFieldValues);
    }
        scAjaxSetSwitchOptions(sFieldName, "radio");
    scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, "<br />");
  } // scAjaxSetFieldRadio

  function scAjaxSetSwitchOptions(fieldName, fieldType)
  {
        var fieldOptions = $(".sc-ui-" + fieldType + "-" + fieldName + ".lc-switch");
        if (!fieldOptions.length) {
                return;
        }
        for (var i = 0; i < fieldOptions.length; i++) {
                if ($(fieldOptions[i]).prop("checked")) {
                        $(fieldOptions[i]).lcs_on();
                }
                else {
                        $(fieldOptions[i]).lcs_off();
                }
        }
  }

  function scAjaxSetFieldLabel(sFieldName, oFieldValues, oFieldOptions, sLookupCons)
  {
    sFieldValue = oFieldValues[0]["value"];
    if ("undefined" == typeof oFieldValues[0]["label"]) {
      sFieldLabel = oFieldValues[0]["value"];
    } else {
      sFieldLabel = oFieldValues[0]["label"];
    }
    sFieldLabel = scAjaxBreakLine(sFieldLabel);
    if (null != oFieldOptions)
    {
      for (iRecreate = 0; iRecreate < oFieldOptions.length; iRecreate++)
      {
        sOptText  = scAjaxSpecCharParser(oFieldOptions[iRecreate]["value"]);
        sOptValue = scAjaxSpecCharParser(oFieldOptions[iRecreate]["label"]);
        if (sFieldValue == sOptText)
        {
          sFieldLabel = sOptValue;
        }
      }
    }
    if (document.getElementById("id_ajax_label_" + sFieldName))
    {
      document.getElementById("id_ajax_label_" + sFieldName).innerHTML = scAjaxSpecCharParser(sFieldLabel);
    }
    if (document.F1.elements[sFieldName])
    {
//      document.F1.elements[sFieldName].value = scAjaxSpecCharParser(sFieldValue);
        Temp_text = scAjaxProtectBreakLine(sFieldValue);
        Temp_text = scAjaxSpecCharParser(Temp_text);
        document.F1.elements[sFieldName].value = scAjaxReturnBreakLine(Temp_text);

    }
    if (document.getElementById("id_lookup_" + sFieldName))
    {
      document.getElementById("id_lookup_" + sFieldName).innerHTML = sLookupCons;
    }
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(sFieldLabel));
  } // scAjaxSetFieldLabel

  function scAjaxSetFieldImage(sFieldName, oFieldValues, sImgFile, sImgOrig, sImgLink, sKeepImg, sHideName)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    if ("N" == sKeepImg && document.getElementById("id_ajax_img_"  + sFieldName))
    {
      document.getElementById("id_ajax_img_"  + sFieldName).src           = scAjaxSpecCharParser(sImgFile);
      document.getElementById("id_ajax_img_"  + sFieldName).style.display = ("" == sImgFile) ? "none" : "";
    }
    if (document.getElementById("id_ajax_link_" + sFieldName) && null != sImgLink)
    {
      document.getElementById("id_ajax_link_" + sFieldName).innerHTML = oFieldValues[0]["value"];
      document.getElementById("id_ajax_link_" + sFieldName).href      = scAjaxSpecCharParser(sImgLink);
    }
    if (document.getElementById("chk_ajax_img_" + sFieldName))
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = ("" == oFieldValues[0]["value"]) ? "none" : "";
    }
    if ("" == oFieldValues[0]["value"] && document.F1.elements[sFieldName + "_limpa"])
    {
      document.F1.elements[sFieldName + "_limpa"].checked = false;
    }
    if ("N" == sKeepImg && document.getElementById("txt_ajax_img_" + sFieldName))
    {
      document.getElementById("txt_ajax_img_" + sFieldName).innerHTML     = oFieldValues[0]["value"];
      document.getElementById("txt_ajax_img_" + sFieldName).style.display = ("" == oFieldValues[0]["value"] || "S" == sHideName) ? "none" : "";
    }
    if ("" != sImgOrig)
    {
      eval("if (var_ajax_img_" + sFieldName + ") var_ajax_img_" + sFieldName + " = '" + sImgOrig + "';");
      if (document.F1.elements["temp_out1_" + sFieldName])
      {
        document.F1.elements["temp_out_" + sFieldName].value = sImgFile;
        document.F1.elements["temp_out1_" + sFieldName].value = sImgOrig;
      }
      else if (document.F1.elements["temp_out_" + sFieldName])
      {
        document.F1.elements["temp_out_" + sFieldName].value = sImgOrig;
      }
    }
    if ("" != oFieldValues[0]["value"])
    {
      if (document.F1.elements[sFieldName + "_salva"]) document.F1.elements[sFieldName + "_salva"].value = oFieldValues[0]["value"];
    }
    else if (oResp && oResp["ajaxRequest"] && "navigate_form" == oResp["ajaxRequest"])
    {
      if (document.F1.elements[sFieldName + "_salva"]) document.F1.elements[sFieldName + "_salva"].value = "";
    }
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldImage

  function scAjaxSetFieldDocument(sFieldName, oFieldValues, sDocLink, sDocIcon, sClearUpload, sDocReadonly)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    document.getElementById("id_ajax_doc_"  + sFieldName).innerHTML = scAjaxSpecCharParser(sDocLink);
    if (document.getElementById("id_ajax_doc_icon_"  + sFieldName))
    {
      document.getElementById("id_ajax_doc_icon_"  + sFieldName).src = scAjaxSpecCharParser(sDocIcon);
    }
    if ("" == oFieldValues[0]["value"])
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = "none";
      document.getElementById("id_ajax_doc_" + sFieldName).style.display = "none";
    }
    else
    {
      document.getElementById("chk_ajax_img_" + sFieldName).style.display = "";
      document.getElementById("id_ajax_doc_" + sFieldName).style.display = "";
    }
    if ("" == oFieldValues[0]["value"] && document.F1.elements[sFieldName + "_limpa"])
    {
      document.F1.elements[sFieldName + "_limpa"].checked = false;
    }
    if ("S" == sClearUpload && document.F1.elements[sFieldName + "_ul_name"])
    {
      document.F1.elements[sFieldName + "_ul_name"].value = "";
    }
    if ("" != sDocLink && sDocReadonly == "S")
    {
      scAjaxSetReadonlyValue(sFieldName, sDocLink);
    }
    else
    {
      scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
    }
  } // scAjaxSetFieldDocument

  function scAjaxSetFieldInnerHtml(sFieldName, oFieldValues)
  {
    if (document.getElementById(sFieldName))
    {
      document.getElementById(sFieldName).innerHTML = scAjaxSpecCharParser(oFieldValues[0]["value"]);
    }
  } // scAjaxSetFieldInnerHtml

  function scAjaxSetFieldMultiUpload(sFieldName, sMULHtml)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return;
    }
    $("#id_sc_loaded_" + sFieldName).html(scAjaxSpecCharParser(sMULHtml));
  } // scAjaxSetFieldMultiUpload

  function scAjaxExecFieldEditorHtml(strOption, bolUI, oField)
  {
                  if(tinymce.majorVersion > 3)
                {
                        if(strOption == 'mceAddControl')
                        {
                                if (typeof(scJQHtmlEditorData) === 'function') {
                                    var data = scJQHtmlEditorData('#' + oField);
                                    if (data && typeof(data) === 'object') {
                                        data.selector = '#' + oField;
                                        tinymce.init(data);
                                    } else {
                                        tinymce.execCommand('mceAddEditor', bolUI, oField);
                                    }
                                } else {
                                    tinymce.execCommand('mceAddEditor', bolUI, oField);
                                }
                        }else
                        if(strOption == 'mceRemoveControl')
                        {
                                tinymce.execCommand('mceRemoveEditor', bolUI, oField);
                        }
                }
                else
                {
                        tinyMCE.execCommand(strOption, bolUI, oField);
                }
  }

  function scAjaxSetFieldEditorHtml(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName])
    {
      return;
    }
        if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    oFormField.setContent(scAjaxSpecCharParser(oFieldValues[0]["value"]));
    scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldEditorHtml

  function scAjaxSetFieldImageHtml(sFieldName, oFieldValues, sImgHtml)
  {
    if (document.getElementById("id_imghtml_" + sFieldName))
    {
      document.getElementById("id_imghtml_" + sFieldName).innerHTML = scAjaxSpecCharParser(sImgHtml);
    }
  } // scAjaxSetFieldEditorHtml

  function scAjaxSetFieldRecurInfo(sFieldName, oFieldValues)
  {
          var jsonData = "" != oFieldValues[0]["value"]
                       ? JSON.parse(oFieldValues[0]["value"])
                                   : { repeat: "1", endon: "E", endafter: "", endin: ""};
          $("#id_rinf_repeat_" + sFieldName).val(jsonData.repeat);
          $(".cl_rinf_endon_" + sFieldName).filter(function(index) {return $(this).val() == jsonData.endon}).prop("checked", true),
          $("#id_rinf_endafter_" + sFieldName).val(jsonData.endafter);
          $("#id_rinf_endin_" + sFieldName).val(jsonData.endin);
          scAjaxSetReadonlyValue(sFieldName, scAjaxSpecCharParser(oFieldValues[0]["value"]));
  } // scAjaxSetFieldRecurInfo

  function scAjaxSetFieldSignature(sFieldName, oFieldValues)
  {
        var fieldValue = scAjaxSpecCharParser(oFieldValues[0]['value']);
        if ("data:image/png;base64," != fieldValue.substr(0, 22) && "data:image/jsignature;base30," != fieldValue.substr(0, 29))
        {
                scJQSignatureClear(sFieldName);
                return;
        }
        $("#id_sc_field_" + sFieldName).val(fieldValue);
        scJQSignatureRedraw(sFieldName);
         scFormHasChanged = false; // mantis 0020638
  } // scAjaxSetFieldSignature

  function scAjaxSetFieldRating(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingStar(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingStarRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingSmile(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingSmileRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetFieldRatingThumb(sFieldName, oFieldValues, thisRow)
  {
        $("#id_sc_field_" + sFieldName).val(oFieldValues[0]['value']);
        if ("" != thisRow) {
      sFieldName = sFieldName.substr(0, sFieldName.lastIndexOf("_") + 1);
        }
        scJQRatingThumbRedraw(sFieldName, thisRow);
  } // scAjaxSetFieldRating

  function scAjaxSetCheckboxOptions(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"] && !document.F1.elements[sFieldName + "[0]"])
    {
      return;
    }
    var aValues    = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    if (document.F1.elements[sFieldName + "[]"])
    {
      var oFormField = document.F1.elements[sFieldName + "[]"];
      if (oFormField.length)
      {
        for (iFieldCheckbox = 0; iFieldCheckbox < oFormField.length; iFieldCheckbox++)
        {
          if (scAjaxInArray(oFormField[iFieldCheckbox].value, aValues))
          {
            oFormField[iFieldCheckbox].checked = true;
          }
          else
          {
            oFormField[iFieldCheckbox].checked = false;
          }
        }
      }
      else
      {
        if (scAjaxInArray(oFormField.value, aValues))
        {
          oFormField.checked = true;
        }
        else
        {
          oFormField.checked = false;
        }
      }
    }
    else if (document.F1.elements[sFieldName + "[0]"])
    {
      for (iFieldCheckbox = 0; iFieldCheckbox < document.F1.elements.length; iFieldCheckbox++)
      {
        oFormElement = document.F1.elements[iFieldCheckbox];
        if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1) && scAjaxInArray(oFormElement.value, aValues))
        {
          oFormElement.checked = true;
        }
        else if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1))
        {
          oFormElement.checked = false;
        }
      }
    }
    else
    {
      oFormElement = document.F1.elements[sFieldName];
      if (scAjaxInArray(oFormElement.value, aValues))
      {
        oFormElement.checked = true;
      }
      else
      {
        oFormElement.checked = false;
      }
    }
  } // scAjaxSetCheckboxOptions

  function scAjaxSetRadioOptions(sFieldName, oFieldValues)
  {
    if (!document.F1.elements[sFieldName])
    {
      return;
    }
    var oFormField = document.F1.elements[sFieldName];
    var aValues    = new Array();
    if (null != oFieldValues)
    {
      for (iFieldSelect = 0; iFieldSelect < oFieldValues.length; iFieldSelect++)
      {
        aValues[iFieldSelect] = scAjaxSpecCharParser(oFieldValues[iFieldSelect]["value"]);
      }
    }
    for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
    {
      oFormField[iFieldRadio].checked = false;
    }
    for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
    {
      if (scAjaxInArray(oFormField[iFieldRadio].value, aValues))
      {
        oFormField[iFieldRadio].checked = true;
      }
    }
  } // scAjaxSetRadioOptions

  function scAjaxSetReadonlyValue(sFieldName, sFieldValue)
  {
    if (document.getElementById("id_read_on_" + sFieldName))
    {
      document.getElementById("id_read_on_" + sFieldName).innerHTML = sFieldValue;
    }
  } // scAjaxSetReadonlyValue

  function scAjaxSetReadonlyArrayValue(sFieldName, oFieldValues, sDelim)
  {
    if (null == oFieldValues)
    {
      return;
    }
    if (null == sDelim)
    {
      sDelim = " ";
    }
    sReadLabel = "";
    for (iReadArray = 0; iReadArray < oFieldValues.length; iReadArray++)
    {
      if (oFieldValues[iReadArray]["label"])
      {
        if ("" != sReadLabel)
        {
          sReadLabel += sDelim;
        }
        sReadLabel += oFieldValues[iReadArray]["label"];
      }
      else if (oFieldValues[iReadArray]["value"])
      {
        if ("" != sReadLabel)
        {
          sReadLabel += sDelim;
        }
        sReadLabel += oFieldValues[iReadArray]["value"];
      }
    }
    scAjaxSetReadonlyValue(sFieldName, sReadLabel);
  } // scAjaxSetReadonlyArrayValue

  function scAjaxGetFieldValue(sFieldGet)
  {
    sValue = "";
    if (!oResp["fldList"])
    {
      return sValue;
    }
    for (iFieldValue = 0; iFieldValue < oResp["fldList"].length; iFieldValue++)
    {
      var sFieldName  = oResp["fldList"][iFieldValue]["fldName"];
      if (oResp["fldList"][iFieldValue]["valList"])
      {
        var oFieldValues = oResp["fldList"][iFieldValue]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (sFieldGet == sFieldName && null != oFieldValues)
      {
        if (1 == oFieldValues.length)
        {
          sValue = scAjaxSpecCharParser(oFieldValues[0]["value"]);
        }
        else
        {
          sValue = new Array();
          for (jFieldValue = 0; jFieldValue < oFieldValues.length; jFieldValue++)
          {
            sValue[jFieldValue] = scAjaxSpecCharParser(oFieldValues[jFieldValue]["value"]);
          }
        }
      }
    }
    return sValue;
  } // scAjaxGetFieldValue

  function scAjaxGetKeyValue(sFieldGet)
  {
    sValue = "";
    if (!oResp["fldList"])
    {
      return sValue;
    }
    for (iKeyValue = 0; iKeyValue < oResp["fldList"].length; iKeyValue++)
    {
      var sFieldName = oResp["fldList"][iKeyValue]["fldName"];
      if (sFieldGet == sFieldName)
      {
        if (oResp["fldList"][iKeyValue]["keyVal"])
        {
          return scAjaxSpecCharParser(oResp["fldList"][iKeyValue]["keyVal"]);
        }
        else
        {
          return scAjaxGetFieldValue(sFieldGet);
        }
      }
    }
    return sValue;
  } // scAjaxGetKeyValue

  function scAjaxGetLineNumber()
  {
    sLineNumber = "";
    if (oResp["errList"])
    {
      for (iLineNumber = 0; iLineNumber < oResp["errList"].length; iLineNumber++)
      {
        if (oResp["errList"][iLineNumber]["numLinha"])
        {
          sLineNumber = oResp["errList"][iLineNumber]["numLinha"];
        }
      }
      return sLineNumber;
    }
    if (oResp["fldList"])
    {
      return oResp["fldList"][0]["numLinha"];
    }
    if (oResp["msgDisplay"])
    {
      return oResp["msgDisplay"]["numLinha"];
    }
    return sLineNumber;
  } // scAjaxGetLineNumber

  function scAjaxFieldExists(sFieldGet)
  {
    bExists = false;
    if (!oResp["fldList"])
    {
      return bExists;
    }
    for (iFieldValue = 0; iFieldValue < oResp["fldList"].length; iFieldValue++)
    {
      var sFieldName  = oResp["fldList"][iFieldValue]["fldName"];
      if (oResp["fldList"][iFieldValue]["valList"])
      {
        var oFieldValues = oResp["fldList"][iFieldValue]["valList"];
        if (0 == oFieldValues.length)
        {
          oFieldValues = null;
        }
      }
      else
      {
        var oFieldValues = null;
      }
      if (sFieldGet == sFieldName && null != oFieldValues)
      {
        bExists = true;
      }
    }
    return bExists;
  } // scAjaxFieldExists

  function scAjaxGetFieldText(sFieldName)
  {
    $oHidden = $("input[name='" + sFieldName + "']");
    if (!$oHidden.length)
    {
      $oHidden = $("input[name='" + sFieldName + "_']");
    }
    if ($oHidden.length)
    {
      for (var i = 0; i < $oHidden.length; i++)
      {
        if ("hidden" == $oHidden[i].type && $oHidden[i].form && $oHidden[i].form.name && "F1" == $oHidden[i].form.name)
        {
          return scAjaxSpecCharProtect($oHidden[i].value);//.replace(/[+]/g, "__NM_PLUS__");
        }
      }
    }
    $oField = $("#id_sc_field_" + sFieldName);
    if(!$oField.length)
    {
      $oField = $("#id_sc_field_" + sFieldName + "_");
    }
    if ($oField.length && "select" != $oField[0].type.substr(0, 6))
    {
      return scAjaxSpecCharProtect($oField.val());//.replace(/[+]/g, "__NM_PLUS__");
    }
    else if (document.F1.elements[sFieldName])
    {
      return scAjaxSpecCharProtect(document.F1.elements[sFieldName].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else if (document.F1.elements[sFieldName + '_'])
    {
      return scAjaxSpecCharProtect(document.F1.elements[sFieldName + '_'].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else
    {
      return '';
    }
  } // scAjaxGetFieldText

  function scAjaxGetFieldHidden(sFieldName)
  {
    for( i= 0; i < document.F1.elements.length; i++)
    {
       if (document.F1.elements[i].name == sFieldName)
       {
          return scAjaxSpecCharProtect(document.F1.elements[i].value);//.replace(/[+]/g, "__NM_PLUS__");
       }
    }
//    return document.F1.elements[sFieldName].value.replace(/[+]/g, "__NM_PLUS__");
  } // scAjaxGetFieldHidden

  function scAjaxGetFieldSelect(sFieldName)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"])
    {
      return "";
    }
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      return scAjaxGetFieldHidden(sFieldNameHtml);
    }
    var oFormField = document.F1.elements[sFieldNameHtml];
    var iSelected  = oFormField.selectedIndex;
    if (-1 < iSelected)
    {
      return scAjaxSpecCharProtect(oFormField.options[iSelected].value);//.replace(/[+]/g, "__NM_PLUS__");
    }
    else
    {
      return "";
    }
  } // scAjaxGetFieldSelect

  function scAjaxGetFieldSelectMult(sFieldName, sFieldDelim)
  {
    sFieldNameHtml = sFieldName;
    if (!document.F1.elements[sFieldName] && document.F1.elements[sFieldName + "[]"])
    {
      sFieldNameHtml += "[]";
    }
    if ("hidden" == document.F1.elements[sFieldNameHtml].type)
    {
      return scAjaxGetFieldHidden(sFieldNameHtml);
    }
    var oFormField = document.F1.elements[sFieldNameHtml];
    var sFieldVals = "";
    for (iFieldSelect = 0; iFieldSelect < oFormField.length; iFieldSelect++)
    {
      if (oFormField[iFieldSelect].selected)
      {
        if ("" != sFieldVals)
        {
          sFieldVals += sFieldDelim;
        }
        sFieldVals += scAjaxSpecCharProtect(oFormField[iFieldSelect].value);//.replace(/[+]/g, "__NM_PLUS__");
      }
    }
    return sFieldVals;
  } // scAjaxGetFieldSelectMult

  function scAjaxGetFieldCheckbox(sFieldName, sDelim)
  {
    var aValues = new Array();
    var sValue  = "";
    if (!document.F1.elements[sFieldName] && !document.F1.elements[sFieldName + "[]"] && !document.F1.elements[sFieldName + "[0]"])
    {
      return sValue;
    }
    if (document.F1.elements[sFieldName + "[]"] && "hidden" == document.F1.elements[sFieldName + "[]"].type)
    {
      return scAjaxGetFieldHidden(sFieldName + "[]");
    }
    if (document.F1.elements[sFieldName] && "hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    if (document.F1.elements[sFieldName + "[]"])
    {
      var oFormField = document.F1.elements[sFieldName + "[]"];
      if (oFormField.length)
      {
        for (iFieldCheck = 0; iFieldCheck < oFormField.length; iFieldCheck++)
        {
          if (oFormField[iFieldCheck].checked)
          {
            aValues[aValues.length] = oFormField[iFieldCheck].value;
          }
        }
      }
      else
      {
        if (oFormField.checked)
        {
          aValues[aValues.length] = oFormField.value;
        }
      }
    }
    else
    {
      for (iFieldCheck = 0; iFieldCheck < document.F1.elements.length; iFieldCheck++)
      {
        oFormElement = document.F1.elements[iFieldCheck];
        if (sFieldName + "[" == oFormElement.name.substr(0, sFieldName.length + 1) && oFormElement.checked)
        {
          aValues[aValues.length] = oFormElement.value;
        }
        else if (sFieldName == oFormElement.name && oFormElement.checked)
        {
          aValues[aValues.length] = oFormElement.value;
        }
      }
    }
    for (iFieldCheck = 0; iFieldCheck < aValues.length; iFieldCheck++)
    {
      sValue += scAjaxSpecCharProtect(aValues[iFieldCheck]);//.replace(/[+]/g, "__NM_PLUS__");
      if (iFieldCheck + 1 != aValues.length)
      {
        sValue += sDelim;
      }
    }
    return sValue;
  } // scAjaxGetFieldCheckbox

  function scAjaxGetFieldRadio(sFieldName)
  {
    if ("hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    var sValue = "";
    if (!document.F1.elements[sFieldName])
    {
      return sValue;
    }
    var oFormField = document.F1.elements[sFieldName];
    if (!oFormField.length)
    {
        var sc_cmp_radio = eval("document.F1." + sFieldName);
        if (sc_cmp_radio.checked)
        {
           sValue = scAjaxSpecCharProtect(sc_cmp_radio.value);//.replace(/[+]/g, "__NM_PLUS__");
        }
    }
    else
    {
      for (iFieldRadio = 0; iFieldRadio < oFormField.length; iFieldRadio++)
      {
        if (oFormField[iFieldRadio].checked)
        {
          sValue = scAjaxSpecCharProtect(oFormField[iFieldRadio].value);//.replace(/[+]/g, "__NM_PLUS__");
        }
      }
    }
    return sValue;
  } // scAjaxGetFieldRadio

  function scAjaxGetFieldEditorHtml(sFieldName)
  {
    if ("hidden" == document.F1.elements[sFieldName].type)
    {
      return scAjaxGetFieldHidden(sFieldName);
    }
    var sValue = "";
    if (!document.F1.elements[sFieldName])
    {
      return sValue;
    }

        if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    return scAjaxSpecCharParser(scAjaxSpecCharProtect(oFormField.getContent()));//.replace(/[+]/g, "__NM_PLUS__"));
  } // scAjaxGetFieldEditorHtml

  function scAjaxGetFieldSignature(sFieldName)
  {
    var signatureData = $("#sc-id-sign-" + sFieldName).jSignature("getData", "base30");
        $("#id_sc_field_" + sFieldName).val("data:" + signatureData[0] + "," + signatureData[1]);
        return $("#id_sc_field_" + sFieldName).val();
  } // scAjaxGetFieldEditorHtml

  function scAjaxGetFieldRecurInfo(sFieldName)
  {
          var repeatInList = $(".cl_rinf_repeatin_" + sFieldName).filter(":checked"), repeatInValues = [], jsonData, i;
          for (i = 0; i < repeatInList.length; i++) {
                  repeatInValues.push($(repeatInList[i]).val());
          }
          jsonData = {
                  repeat: $("#id_rinf_repeat_" + sFieldName).val(),
                  repeatin: repeatInValues.join(";"),
                  endon: $(".cl_rinf_endon_" + sFieldName).filter(":checked").val(),
                  endafter: $("#id_rinf_endafter_" + sFieldName).val(),
                  endin: $("#id_rinf_endin_" + sFieldName).val()
          };
          return JSON.stringify(jsonData);
  } // scAjaxGetFieldRecurInfo

  function scAjaxDoNothing(e)
  {
  } // scAjaxDoNothing

  function scAjaxInArray(mVal, aList)
  {
    for (iInArray = 0; iInArray < aList.length; iInArray++)
    {
      if (aList[iInArray] == mVal)
      {
        return true;
      }
    }
    return false;
  } // scAjaxInArray

  function scAjaxSpecCharParser(sParseString)
  {
    if (null == sParseString) {
      return "";
    }
    var ta = document.createElement("textarea");
    ta.innerHTML = sParseString.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    return ta.value;
  } // scAjaxSpecCharParser

  function scAjaxSpecCharProtect(sOriginal)
  {
        var sProtected;
        sProtected = sOriginal.replace(/[+]/g, "__NM_PLUS__");
        sProtected = sProtected.replace(/[%]/g, "__NM_PERC__");
        return sProtected;
  } // scAjaxSpecCharProtect

  function scAjaxRecreateOptions(sFieldType, sHtmlType, sFieldName, oFieldValues, oFieldOptions, iColNum, sHtmComp, sOptComp, sOptClass, sOptMulti, bSwitch)
  {
    var sSuffix  = ("checkbox" == sHtmlType) ? "[]" : "";
    var sDivName = "idAjax" + sFieldType + "_" + sFieldName;
    var sDivText = "";
    var iCntLine = 0;
    var aValues  = new Array();
    var sClass;
    var markChangedClass;
    if (null != oFieldValues)
    {
      for (iRecreate = 0; iRecreate < oFieldValues.length; iRecreate++)
      {
        aValues[iRecreate] = scAjaxSpecCharParser(oFieldValues[iRecreate]["value"]);
      }
    }
    sDivText += "<table border=0>";
    if ("checkbox" == sHtmlType)
    {
        markChangedClass = "sc-ui-checkbox-" + sFieldName;
    }
    if ("radio" == sHtmlType)
    {
        markChangedClass = "sc-ui-radio-" + sFieldName;
    }
    for (iRecreate = 0; iRecreate < oFieldOptions.length; iRecreate++)
    {
        sOptText  = scAjaxSpecCharParser(oFieldOptions[iRecreate]["label"]);
        sOptValue = scAjaxSpecCharParser(oFieldOptions[iRecreate]["value"]);
        if (0 == iCntLine)
        {
            sDivText += "<tr>";
        }
        iCntLine++;
        if ("" != sOptClass)
        {
            sClass = " class=\"" + sOptClass;
            if ("" != sOptMulti)
            {
                sClass += " " + sOptClass + sOptMulti;
            }
            if ("" != markChangedClass)
            {
                sClass += " " + markChangedClass;
            }
            sClass += "\"";
        }
        else
        {
            sClass = " class=\"";
            if ("" != markChangedClass)
            {
                sClass += " " + markChangedClass;
            }
            sClass += "\"";
        }
        if (sHtmComp == null)
        {
            sHtmComp = "";
        }
        sChecked  = (scAjaxInArray(sOptValue, aValues)) ? " checked" : "";
        sDivText += "<td class=\"scFormDataFontOdd css_" + sFieldName + "_line\">";
                if (bSwitch)
                {
                        sDivText += "<div class=\"sc ";
                        if ("Checkbox" == sFieldType)
                        {
                                sDivText += "switch";
                        }
                        else
                        {
                                sDivText += "radio";
                        }
                        sDivText += "\">";
                }
        sDivText += "<input id=\"id-opt-" + sFieldName + "-"  + iRecreate + "\" type=\"" + sHtmlType + "\" name=\"" + sFieldName + sSuffix + "\" value=\"" + sOptValue + "\"" + sChecked + " " + sHtmComp + " " + sOptComp + sClass + ">";
                if (bSwitch)
                {
                        sDivText += "<span></span>";
                }
        sDivText += "<label for=\"id-opt-" + sFieldName + "-"  + iRecreate + "\">" + sOptText + "</label>";
                if (bSwitch)
                {
                        sDivText += "</div>";
                }
        sDivText += "</td>";
        if (iColNum == iCntLine)
        {
            sDivText += "</tr>";
            iCntLine  = 0;
        }
    }
    sDivText += "</table>";
    document.getElementById(sDivName).innerHTML = sDivText;
    if ("" != markChangedClass)
    {
      $("." + markChangedClass).on("click", function() { scMarkFormAsChanged(); });
    }
  } // scAjaxRecreateOptions

  function scAjaxProcOn(bForce)
  {
    if (null == bForce)
    {
      bForce = false;
    }
    if (document.getElementById("id_div_process"))
    {
      if ($ && $.blockUI && !bForce)
      {
        $.blockUI({
          message: $("#id_div_process_block"),
          overlayCSS: { backgroundColor: sc_ajaxBg },
          css: {
            borderColor: sc_ajaxBordC,
            borderStyle: sc_ajaxBordS,
            borderWidth: sc_ajaxBordW
          }
        });
      }
      else
      {
        document.getElementById("id_div_process").style.display = "";
        document.getElementById("id_fatal_error").style.display = "none";
        if (null != scCenterElement)
        {
          scCenterElement(document.getElementById("id_div_process"));
        }
      }
    }
  } // scAjaxProcOn

  function scAjaxProcOff(bForce)
  {
    if (null == bForce)
    {
      bForce = false;
    }
    if (document.getElementById("id_div_process"))
    {
      if ($ && $.unblockUI && !bForce)
      {
        $.unblockUI();
      }
      else
      {
        document.getElementById("id_div_process").style.display = "none";
      }
    }
  } // scAjaxProcOff

  function scAjaxSetMaster()
  {
    if (!oResp["masterValue"])
    {
      return;
    }
        if (scMasterDetailParentIframe && "" != scMasterDetailParentIframe)
        {
      var dbParentFrame = $(parent.document).find("[name='" + scMasterDetailParentIframe + "']");
          if (!dbParentFrame || !dbParentFrame[0] || !dbParentFrame[0].contentWindow.scAjaxDetailValue)
          {
                return;
          }
      for (iMaster = 0; iMaster < oResp["masterValue"].length; iMaster++)
      {
        dbParentFrame[0].contentWindow.scAjaxDetailValue(oResp["masterValue"][iMaster]["index"], oResp["masterValue"][iMaster]["value"]);
      }
        }
    if (!parent || !parent.scAjaxDetailValue)
    {
      return;
    }
    for (iMaster = 0; iMaster < oResp["masterValue"].length; iMaster++)
    {
      parent.scAjaxDetailValue(oResp["masterValue"][iMaster]["index"], oResp["masterValue"][iMaster]["value"]);
    }
  } // scAjaxSetMaster

  function scAjaxSetFocus()
  {
    if (!oResp["setFocus"] && '' == scFocusFirstErrorName)
    {
      return;
    }
    sFieldName = oResp["setFocus"];
    if (document.F1.elements[sFieldName])
    {
        scFocusField(sFieldName);
    }
    scAjaxFocusError();
  } // scAjaxSetFocus

  function scAjaxFocusError()
  {
    if ('' != scFocusFirstErrorName)
    {
      scFocusField(scFocusFirstErrorName);
      scFocusFirstErrorName = '';
    }
  } // scAjaxFocusError

  function scAjaxSetNavStatus(sBarPos)
  {
    if (!oResp["navStatus"])
    {
      return;
    }
    sNavRet = "S";
    sNavAva = "S";
    if (oResp["navStatus"]["ret"])
    {
      sNavRet = oResp["navStatus"]["ret"];
    }
    if (oResp["navStatus"]["ava"])
    {
      sNavAva = oResp["navStatus"]["ava"];
    }
    if ("S" != sNavRet && "N" != sNavRet)
    {
      sNavRet = "S";
    }
    if ("S" != sNavAva && "N" != sNavAva)
    {
      sNavAva = "S";
    }
    Nav_permite_ret = sNavRet;
    Nav_permite_ava = sNavAva;
    nav_atualiza(Nav_permite_ret, Nav_permite_ava, sBarPos);
  } // scAjaxSetNavStatus

  function scAjaxSetSummary()
  {
    if (!oResp["navSummary"])
    {
      return;
    }
    sreg_ini = oResp["navSummary"].reg_ini;
    sreg_qtd = oResp["navSummary"].reg_qtd;
    sreg_tot = oResp["navSummary"].reg_tot;
    summary_atualiza(sreg_ini, sreg_qtd, sreg_tot);
  } // scAjaxSetSummary

  function scAjaxSetNavpage()
  {
    navpage_atualiza(oResp["navPage"]);
  } // scAjaxSetNavpage


  function scAjaxRedir(oTemp)
  {
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (!oResp["redirInfo"])
    {
      return;
    }
    sMetodo = oResp["redirInfo"]["metodo"];
    sAction = oResp["redirInfo"]["action"];
    if ("location" == sMetodo)
    {
      if ("parent.parent" == oResp["redirInfo"]["target"])
      {
        parent.parent.location = sAction;
      }
      else if ("parent" == oResp["redirInfo"]["target"])
      {
        parent.location = sAction;
      }
      else if ("_blank" == oResp["redirInfo"]["target"])
      {
        window.open(sAction, "_blank");
      }
      else
      {
        document.location = sAction;
      }
    }
    else if ("html" == sMetodo)
    {
        document.write(scAjaxSpecCharParser(oResp["redirInfo"]["action"]));
    }
    else
    {
      if (oResp["redirInfo"]["target"] == "modal")
      {

          tb_show('', sAction + '?script_case_init=' +  oResp["redirInfo"]["script_case_init"] + '&nmgp_parms=' + oResp["redirInfo"]["nmgp_parms"] + '&nmgp_outra_jan=true&nmgp_url_saida=modal&NMSC_modal=ok&TB_iframe=true&modal=true&height=' +  oResp["redirInfo"]["h_modal"] + '&width=' + oResp["redirInfo"]["w_modal"], '');

          return;
      }
      sFormRedir = (oResp["redirInfo"]["nmgp_outra_jan"]) ? "form_ajax_redir_1" : "form_ajax_redir_2";
      document.forms[sFormRedir].action           = sAction;
      document.forms[sFormRedir].target           = oResp["redirInfo"]["target"];
      document.forms[sFormRedir].nmgp_parms.value = oResp["redirInfo"]["nmgp_parms"];
      if ("form_ajax_redir_1" == sFormRedir)
      {
        document.forms[sFormRedir].nmgp_outra_jan.value = oResp["redirInfo"]["nmgp_outra_jan"];
      }
      else
      {
        document.forms[sFormRedir].nmgp_url_saida.value   = oResp["redirInfo"]["nmgp_url_saida"];
        document.forms[sFormRedir].script_case_init.value = oResp["redirInfo"]["script_case_init"];
      }
      document.forms[sFormRedir].submit();
    }
  } // scAjaxRedir

  function scAjaxSetDisplay(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    var aDispData = new Array();
    var aDispCont = {};
    var vertButton;
    if (bReset)
    {
      for (iDisplay = 0; iDisplay < ajax_block_list.length; iDisplay++)
      {
        aDispCont[ajax_block_list[iDisplay]] = aDispData.length;
        aDispData[aDispData.length] = new Array(ajax_block_id[ajax_block_list[iDisplay]], "on");
      }
      for (iDisplay = 0; iDisplay < ajax_field_list.length; iDisplay++)
      {
        if (ajax_field_id[ajax_field_list[iDisplay]])
        {
          aFieldIds = ajax_field_id[ajax_field_list[iDisplay]];
          for (iDisplay2 = 0; iDisplay2 < aFieldIds.length; iDisplay2++)
          {
            aDispCont[aFieldIds[iDisplay2]] = aDispData.length;
            aDispData[aDispData.length] = new Array(aFieldIds[iDisplay2], "on");
          }
        }
      }
    }
        var blockDisplay = {};
    if (oResp["blockDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["blockDisplay"].length; iDisplay++)
      {
        if (bReset)
        {
          aDispData[ aDispCont[ oResp["blockDisplay"][iDisplay][0] ] ][1] = oResp["blockDisplay"][iDisplay][1];
        }
        else
        {
          aDispData[aDispData.length] = new Array(ajax_block_id[ oResp["blockDisplay"][iDisplay][0] ], oResp["blockDisplay"][iDisplay][1]);
        }
                blockDisplay[ oResp["blockDisplay"][iDisplay][0] ] = oResp["blockDisplay"][iDisplay][1];
      }
          //scCheckPagesWithoutBlock();
    }
        var fieldDisplay = {}, controlHtmlHideField = [], controlHtmlShowField = [];
    if (oResp["fieldDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["fieldDisplay"].length; iDisplay++)
      {
        if (typeof scHideUserField === "function" && "off" == oResp["fieldDisplay"][iDisplay][1]) {
          controlHtmlHideField.push(oResp["fieldDisplay"][iDisplay][0]);
        }
        if (typeof scShowUserField === "function" && "on" == oResp["fieldDisplay"][iDisplay][1]) {
          controlHtmlShowField.push(oResp["fieldDisplay"][iDisplay][0]);
        }
        for (iDisplay2 = 1; iDisplay2 < ajax_field_mult[ oResp["fieldDisplay"][iDisplay][0] ].length; iDisplay2++)
        {
          aFieldIds = ajax_field_id[ ajax_field_mult[ oResp["fieldDisplay"][iDisplay][0] ][iDisplay2] ];
          for (iDisplay3 = 0; iDisplay3 < aFieldIds.length; iDisplay3++)
          {
            if (bReset)
            {
              aDispData[ aDispCont[ aFieldIds[iDisplay3] ] ][1] = oResp["fieldDisplay"][iDisplay][1];
            }
            else
            {
              aDispData[aDispData.length] = new Array(aFieldIds[iDisplay3], oResp["fieldDisplay"][iDisplay][1]);
            }
                        if ("hidden_field_data_" == aFieldIds[iDisplay3].substr(0, 18)) {
                          fieldDisplay[ aFieldIds[iDisplay3].substr(18) ] = oResp["fieldDisplay"][iDisplay][1];
                        }
          }
        }
      }
    }
    if (oResp["buttonDisplay"])
    {
      for (iDisplay = 0; iDisplay < oResp["buttonDisplay"].length; iDisplay++)
      {
        var sBtnName2 = "";
        var sBtnName3 = "";
        switch (oResp["buttonDisplay"][iDisplay][0])
        {
          case "first": var sBtnName = "sc_b_ini"; break;
          case "back": var sBtnName = "sc_b_ret"; break;
          case "forward": var sBtnName = "sc_b_avc"; break;
          case "last": var sBtnName = "sc_b_fim"; break;
          case "insert": var sBtnName = "sc_b_ins"; break;
          case "update": var sBtnName = "sc_b_upd"; break;
          case "delete": var sBtnName = "sc_b_del"; break;
          default: var sBtnName = "sc_b_" + oResp["buttonDisplay"][iDisplay][0]; sBtnName2 = "sc_" + oResp["buttonDisplay"][iDisplay][0]; sBtnName3 = "gbl_sc_" + oResp["buttonDisplay"][iDisplay][0]; break;
        }
        aDispData[aDispData.length] = new Array(sBtnName, oResp["buttonDisplay"][iDisplay][1]);
        aDispData[aDispData.length] = new Array(sBtnName + "_t", oResp["buttonDisplay"][iDisplay][1]);
        aDispData[aDispData.length] = new Array(sBtnName + "_b", oResp["buttonDisplay"][iDisplay][1]);
        if ("" != sBtnName2)
        {
          aDispData[aDispData.length] = new Array(sBtnName2, oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName2 + "_top", oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName2 + "_bot", oResp["buttonDisplay"][iDisplay][1]);
        }
        if ("" != sBtnName3)
        {
          aDispData[aDispData.length] = new Array(sBtnName3, oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName3 + "_top", oResp["buttonDisplay"][iDisplay][1]);
          aDispData[aDispData.length] = new Array(sBtnName3 + "_bot", oResp["buttonDisplay"][iDisplay][1]);
        }
      }
    }
    if (oResp["buttonDisplayVert"])
    {
      for (iDisplay = 0; iDisplay < oResp["buttonDisplayVert"].length; iDisplay++)
      {
        vertButton = oResp["buttonDisplayVert"][iDisplay];
        aDispData[aDispData.length] = new Array("sc_exc_line_" + vertButton.seq, vertButton.delete);
        if (vertButton.gridView)
        {
          aDispData[aDispData.length] = new Array("sc_open_line_" + vertButton.seq, vertButton.update);
        }
        else
        {
          aDispData[aDispData.length] = new Array("sc_upd_line_" + vertButton.seq, vertButton.update);
        }
      }
    }
    for (iDisplay = 0; iDisplay < aDispData.length; iDisplay++)
    {
      scAjaxElementDisplay(aDispData[iDisplay][0], aDispData[iDisplay][1]);
    }
        for (var blockId in blockDisplay) {
                displayChange_block(blockId, blockDisplay[blockId]);
        }
        for (var fieldId in fieldDisplay) {
                displayChange_field(fieldId, "", fieldDisplay[fieldId]);
        }
        if (controlHtmlHideField.length) {
          for (iDisplay = 0; iDisplay < controlHtmlHideField.length; iDisplay++) {
            scHideUserField(controlHtmlHideField[iDisplay]);
          }
        }
        if (controlHtmlShowField.length) {
          for (iDisplay = 0; iDisplay < controlHtmlShowField.length; iDisplay++) {
            scShowUserField(controlHtmlShowField[iDisplay]);
          }
        }
  } // scAjaxSetDisplay

  function scAjaxNavigateButtonDisplay(sButton, sStatus)
  {
    sButton2 = sButton + "_off";

    if ("off" == sStatus)
    {
      sStatus2 = "off";
    }
    else
    {
      if ("sc_b_ini" == sButton || "sc_b_ret" == sButton)
      {
        if ("S" == Nav_permite_ret)
        {
          sStatus  = "on";
          sStatus2 = "off";
        }
        else
        {
          sStatus  = "off";
          sStatus2 = "on";
        }
      }
      else
      {
        if ("S" == Nav_permite_ava)
        {
          sStatus  = "on";
          sStatus2 = "off";
        }
        else
        {
          sStatus  = "off";
          sStatus2 = "on";
        }
      }
    }

    scAjaxElementDisplay(sButton        , sStatus);
    scAjaxElementDisplay(sButton + "_t" , sStatus);
    scAjaxElementDisplay(sButton + "_b" , sStatus);
    scAjaxElementDisplay(sButton2       , sStatus2);
    scAjaxElementDisplay(sButton2 + "_t", sStatus2);
    scAjaxElementDisplay(sButton2 + "_b", sStatus2);
  } // scAjaxNavigateButtonDisplay

  function scAjaxElementDisplay(sElement, sAction)
  {
    if (ajax_block_tab && ajax_block_tab[sElement] && "" != ajax_block_tab[sElement])
    {
      scAjaxElementDisplay(ajax_block_tab[sElement], sAction);
    }
    if (document.getElementById(sElement))
    {

      if("off" == sAction)
      {
        $('#' + sElement).hide();
      }
      else
      {
        $('#' + sElement).show();
        if (typeof $('#' + sElement).data('elementDisplay') != undefined) {
          $('#' + sElement).css('display', $('#' + sElement).data('elementDisplay'));
        }
      }
      if (document.getElementById(sElement + "_dumb"))
      {
        if("off" == sAction)
        {
          $('#' + sElement + "_dumb").show();
          if (typeof $('#' + sElement).data('elementDisplay') != undefined) {
            $('#' + sElement).css('display', $('#' + sElement).data('elementDisplay'));
          }
        }
        else
        {
          $('#' + sElement + "_dumb").hide();
        }
      }
    }
  } // scAjaxElementDisplay

  function scAjaxSetLabel(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    if (bReset)
    {
      for (iLabel = 0; iLabel < ajax_field_list.length; iLabel++)
      {
        if (ajax_field_list[iLabel] && ajax_error_list[ajax_field_list[iLabel]])
        {
          scAjaxFieldLabel(ajax_field_list[iLabel], ajax_error_list[ajax_field_list[iLabel]]["label"]);
        }
      }
    }
    if (oResp["fieldLabel"])
    {
      for (iLabel = 0; iLabel < oResp["fieldLabel"].length; iLabel++)
      {
        scAjaxFieldLabel(oResp["fieldLabel"][iLabel][0], scAjaxSpecCharParser(oResp["fieldLabel"][iLabel][1]));
      }
    }
  } // scAjaxSetLabel

  function scAjaxFieldLabel(sField, sLabel)
  {
    if (document.getElementById("id_label_" + sField))
    {
      if (document.getElementById("id_label_" + sField).innerHTML != sLabel)
      {
        document.getElementById("id_label_" + sField).innerHTML = sLabel;
      }
    }
    else if (document.getElementById("hidden_field_label_" + sField) && document.getElementById("hidden_field_label_" + sField).innerHTML != sLabel)
    {
      document.getElementById("hidden_field_label_" + sField).innerHTML = sLabel;
    }
  } // scAjaxFieldLabel

  function scAjaxSetReadonly(bReset)
  {
    if (null == bReset)
    {
      bReset = false;
    }
    if (bReset)
    {
      for (iRead = 0; iRead < ajax_field_list.length; iRead++)
      {
        scAjaxFieldRead(ajax_field_list[iRead], ajax_read_only[ajax_field_list[iRead]]);
      }
      for (iRead = 0; iRead < ajax_field_Dt_Hr.length; iRead++)
      {
        scAjaxFieldRead(ajax_field_Dt_Hr[iRead], ajax_read_only[ajax_field_Dt_Hr[iRead]]);
      }
    }
    if (oResp["readOnly"])
    {
      for (iRead = 0; iRead < oResp["readOnly"].length; iRead++)
      {
        if (ajax_read_only[ oResp["readOnly"][iRead][0] ])
        {
          scAjaxFieldRead(oResp["readOnly"][iRead][0], oResp["readOnly"][iRead][1]);
        }
        else if (oResp["rsSize"])
        {
          for (var i = 0; i <= oResp["rsSize"]; i++)
          {
            if (ajax_read_only[ oResp["readOnly"][iRead][0] + i ])
            {
              scAjaxFieldRead(oResp["readOnly"][iRead][0] + i, oResp["readOnly"][iRead][1]);
            }
          }
        }
      }
    }
  } // scAjaxSetReadonly

  function scAjaxFieldRead(sField, sStatus)
  {
    if ("on" == sStatus)
    {
      var sDisplayOff = "none";
      var sDisplayOn  = "";
    }
    else
    {
      var sDisplayOff = "";
      var sDisplayOn  = "none";
    }
    if (document.getElementById("id_read_off_" + sField))
    {
      document.getElementById("id_read_off_" + sField).style.display = sDisplayOff;
    }
    if (document.getElementById("id_sc_dragdrop_" + sField))
    {
      document.getElementById("id_sc_dragdrop_" + sField).style.display = sDisplayOff;
    }
    if (document.getElementById("id_read_on_" + sField))
    {
      document.getElementById("id_read_on_" + sField).style.display = sDisplayOn;
    }
  } // scAjaxFieldRead

  function scAjaxSetBtnVars()
  {
    if (oResp["btnVars"])
    {
      for (iBtn = 0; iBtn < oResp["btnVars"].length; iBtn++)
      {
        eval(oResp["btnVars"][iBtn][0] + " = scAjaxSpecCharParser('" + oResp["btnVars"][iBtn][1] + "');");
      }
    }
  } // scAjaxSetBtnVars

  function scAjaxClearText(sFormField)
  {
    document.F1.elements[sFormField].value = "";
  } // scAjaxClearText

  function scAjaxClearLabel(sFormField)
  {
    document.getElementById("id_ajax_label_" + sFormField).innerHTML = "";
  } // scAjaxClearLabel

  function scAjaxClearSelect(sFormField)
  {
    document.F1.elements[sFormField].length = 0;
  } // scAjaxClearSelect

  function scAjaxClearCheckbox(sFormField)
  {
    document.getElementById("idAjaxCheckbox_" + sFormField).innerHTML = "";
  } // scAjaxClearCheckbox

  function scAjaxClearRadio(sFormField)
  {
    document.getElementById("idAjaxRadio_" + sFormField).innerHTML = "";
  } // scAjaxClearRadio

  function scAjaxClearEditorHtml(sFormField)
  {
    if(tinymce.majorVersion > 3)
        {
                var oFormField = tinyMCE.get(sFieldName);
        }
        else
        {
                var oFormField = tinyMCE.getInstanceById(sFieldName);
        }
    oFormField.setContent("");
  } // scAjaxClearEditorHtml

  function scCheckPagesWithoutBlock()
  {
        var page_id, block_id, has_block_shown;
    for (page_id in ajax_page_blocks) {
          has_block_shown = false;
      for (block_id in ajax_page_blocks[page_id]) {
                console.log(page_id + ' ' + ajax_page_blocks[page_id][block_id]);
                console.log($("#div_" + ajax_block_id[ajax_page_blocks[page_id][block_id]]).css('display'));
        //$("#div_" + ajax_block_id[block_id]);
      }
    }
  }

  function scAjaxJavascript()
  {
    if (oResp["ajaxJavascript"])
    {
      var sJsFunc = "";
      for (var i = 0; i < oResp["ajaxJavascript"].length; i++)
      {
        sJsFunc = scAjaxSpecCharParser(oResp["ajaxJavascript"][i][0]);
        if ("" != sJsFunc)
        {
          var aParam = new Array();
          if (oResp["ajaxJavascript"][i][1] && 0 < oResp["ajaxJavascript"][i][1].length)
          {
            for (var j = 0; j < oResp["ajaxJavascript"][i][1].length; j++)
            {
              aParam.push("'" + oResp["ajaxJavascript"][i][1][j] + "'");
            }
          }
          eval("if (" + sJsFunc + ") { " + sJsFunc + "(" + aParam.join(", ") + ") }");
        }
      }
    }
  } // scAjaxJavascript

  function scAjaxAlert(callbackOk)
  {
    if (oResp["ajaxAlert"] && oResp["ajaxAlert"]["message"] && "" != oResp["ajaxAlert"]["message"])
    {
      scJs_alert(oResp["ajaxAlert"]["message"], callbackOk, oResp["ajaxAlert"]["params"]);
    }
    else
    {
      callbackOk();
    }
  } // scAjaxAlert

        function scJs_alert_default(message, callbackOk) {
                alert(message);
                if (typeof callbackOk == "function") {
                        callbackOk();
                }
        } // scJs_alert_default

        function scJs_confirm_default(message, callbackOk, callbackCancel) {
                if (confirm(message)) {
                        callbackOk();
                }
                else {
                        callbackCancel();
                }
        } // scJs_confirm_default

  function scAjaxMessage(oTemp)
  {
    if (oTemp && oTemp != null)
    {
        oResp = oTemp;
    }
    if (oResp["ajaxMessage"] && oResp["ajaxMessage"]["message"] && "" != oResp["ajaxMessage"]["message"])
    {
      var sTitle    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["title"])        ? oResp["ajaxMessage"]["title"]               : scMsgDefTitle,
          bModal    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["modal"])        ? ("Y" == oResp["ajaxMessage"]["modal"])      : false,
          iTimeout  = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["timeout"])      ? parseInt(oResp["ajaxMessage"]["timeout"])   : 0,
          bButton   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["button"])       ? ("Y" == oResp["ajaxMessage"]["button"])     : false,
          sButton   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["button_label"]) ? oResp["ajaxMessage"]["button_label"]        : "Ok",
          iTop      = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["top"])          ? parseInt(oResp["ajaxMessage"]["top"])       : 0,
          iLeft     = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["left"])         ? parseInt(oResp["ajaxMessage"]["left"])      : 0,
          iWidth    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["width"])        ? parseInt(oResp["ajaxMessage"]["width"])     : 0,
          iHeight   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["height"])       ? parseInt(oResp["ajaxMessage"]["height"])    : 0,
          bClose    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["show_close"])   ? ("Y" == oResp["ajaxMessage"]["show_close"]) : true,
          bBodyIcon = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["body_icon"])    ? ("Y" == oResp["ajaxMessage"]["body_icon"])  : true,
          sRedir    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir"])        ? oResp["ajaxMessage"]["redir"]               : "",
          sTarget   = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir_target"]) ? oResp["ajaxMessage"]["redir_target"]        : "",
          sParam    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["redir_par"])    ? oResp["ajaxMessage"]["redir_par"]           : "",
          bToast    = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["toast"])        ? ("Y" == oResp["ajaxMessage"]["toast"])      : false,
          sToastPos = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["toast_pos"])    ? oResp["ajaxMessage"]["toast_pos"]           : "",
          sType     = (oResp["ajaxMessage"] && oResp["ajaxMessage"]["type"])         ? oResp["ajaxMessage"]["type"]                : "";
      if (typeof scDisplayUserMessage == "function") {
        scDisplayUserMessage(oResp["ajaxMessage"]["message"]);
      }
      else {
                  var params = {
                          title: sTitle,
                          message: oResp["ajaxMessage"]["message"],
                          isModal: bModal,
                          timeout: iTimeout,
                          showButton: bButton,
                          buttonLabel: sButton,
                          topPos: iTop,
                          leftPos: iLeft,
                          width: iWidth,
                          height: iHeight,
                          redirUrl: sRedir,
                          redirTarget: sTarget,
                          redirParams: sParam,
                          showClose: bClose,
                          showBodyIcon: bBodyIcon,
                          isToast: bToast,
                          toastPos: sToastPos,
                          type: sType
                  };
        _scAjaxShowMessage(params);
      }
    }
  } // scAjaxMessage

  function scAjaxResponse(sResp)
  {
    eval("var oResp = " + sResp);
    return oResp;
  } // scAjaxResponse

  function scAjaxBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      input += "";
      if(!/<[^>]+>/.test(input)){
        while (input.lastIndexOf(String.fromCharCode(10)) > -1)
        {
          input = input.replace(String.fromCharCode(10), '<br>');
        }
      }
      return input;
  } // scAjaxBreakLine

  function scAjaxProtectBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      var input1 = input + "";
      while (input1.lastIndexOf(String.fromCharCode(10)) > -1)
      {
         input1 = input1.replace(String.fromCharCode(10), '#@NM#@');
      }
      return input1;
  } // scAjaxProtectBreakLine

  function scAjaxReturnBreakLine(input)
  {
      if (null == input)
      {
          return "";
      }
      while (input.lastIndexOf('#@NM#@') > -1)
      {
         input = input.replace('#@NM#@', String.fromCharCode(10));
      }
      return input;
  } // scAjaxReturnBreakLine

  function scOpenMasterDetail(widget, url)
  {
          var iframe = $(parent.document).find("[name='" +  widget+ "']");
          iframe.attr("src", url);
  } // scOpenMasterDetail

  function scMoveMasterDetail(widget)
  {
          var iframe = $(parent.document).find("[name='" +  widget+ "']");
          iframe[0].contentWindow.nm_move("apl_detalhe", true);
  } // scMoveMasterDetail

        function scAjaxError_markList() {
            if ('undefined' == typeof oResp.errList) {
                return;
            }
                var i, fieldName, fieldList = new Array();
                for (i = 0; i < oResp.errList.length; i++) {
                        fieldName = oResp.errList[i]["fldName"];
                        if (oResp.errList[i]["numLinha"]) {
                                fieldName += oResp.errList[i]["numLinha"];
                        }
            fieldList.push(fieldName);
                }
                scAjaxError_markFieldList(fieldList);
        } // scAjaxError_markList

        function scAjaxError_markFieldList(fieldList) {
                var i;
                for (i = 0; i < fieldList.length; i++) {
            scAjaxError_markField(fieldList[i]);
                }
        } // scAjaxError_markFieldList

        function scAjaxError_unmarkList() {
                var i;
                for (i = 0; i < ajax_field_list.length; i++) {
            scAjaxError_unmarkField(ajax_field_list[i]);
                }
        } // scAjaxError_unmarkList

        function scAjaxError_markField(fieldName) {
                var $oField  = $("#id_sc_field_" + fieldName);
                var $S2Field = $("#select2-id_sc_field_" + fieldName + '-container');
                if (0 < $oField.length) {
                        scAjax_applyFieldErrorStyle($oField);
                        if ($S2Field) {
                            scAjax_applyFieldErrorStyle($S2Field);
                        }
                }
        } // scAjaxError_markField

        function scAjaxError_unmarkField(fieldName) {
                var $oField = $("#id_sc_field_" + fieldName);
                var $S2Field = $("#select2-id_sc_field_" + fieldName + '-container');
                if (0 < $oField.length) {
                        scAjax_removeFieldErrorStyle($oField);
                        if ($S2Field) {
                            scAjax_removeFieldErrorStyle($S2Field);
                        }
                }
        } // scAjaxError_unmarkField

        function scAjax_displayEmptyForm() {
        $("#sc-ui-empty-form").show();
        $(".sc-ui-page-tab-line").hide();
        $("#sc-id-required-row").hide();
        sc_hide_form_tbl_hoteis_form();
        }

  function scAjax_applyFieldErrorStyle(fieldObj) {
    if (fieldObj.hasClass("sc-ui-pwd-toggle")) {
        fieldObj.addClass(sc_css_status_pwd_text);
        fieldObj.parent().addClass(sc_css_status_pwd_box);
      } else {
        fieldObj.addClass(sc_css_status);
        
        if(fieldObj.attr('data-select2-id') && fieldObj.attr('data-select2-id').length && $('#select2-'+ fieldObj.attr('data-select2-id') +'-container').length)
        {
            $('#select2-'+ fieldObj.attr('data-select2-id') +'-container').addClass(sc_css_status);
        }
      }
  }

  function scAjax_removeFieldErrorStyle(fieldObj) {
    if (fieldObj.hasClass("sc-ui-pwd-toggle")) {
        fieldObj.removeClass(sc_css_status_pwd_text);
        fieldObj.parent().removeClass(sc_css_status_pwd_box);
      } else {
        fieldObj.removeClass(sc_css_status);
        
        if(fieldObj.attr('data-select2-id') && fieldObj.attr('data-select2-id').length && $('#select2-'+ fieldObj.attr('data-select2-id') +'-container').length)
        {
            $('#select2-'+ fieldObj.attr('data-select2-id') +'-container').removeClass(sc_css_status);
        }
      }
  }

  function scAjax_formReload() {
<?php
    if ($this->nmgp_opcao == 'novo') {
        echo "      nm_move('reload_novo');";
    } else {
        echo "      nm_move('igual');";
    }
?>
  }

  function scBtnDisabled()
  {
    var btnNameNav, hasNavButton = false;

    if (typeof oResp.btnDisabled != undefined) {
      for (var btnName in oResp.btnDisabled) {
        btnNameNav = btnName.substring(0, 9);

        if ("on" == oResp.btnDisabled[btnName]) {
          $("#" + btnName).addClass("disabled");

          if ("sc_b_ini_" == btnNameNav) {
            Nav_binicio_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_ret_" == btnNameNav) {
            Nav_bretorna_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_avc_" == btnNameNav) {
            Nav_bavanca_macro_disabled = "on";
            hasNavButton = true;
          } else if ("sc_b_fim_" == btnNameNav) {
            Nav_bfinal_macro_disabled = "on";
            hasNavButton = true;
          }
        } else {
          $("#" + btnName).removeClass("disabled");

          if ("sc_b_ini_" == btnNameNav) {
            Nav_binicio_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_ret_" == btnNameNav) {
            Nav_bretorna_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_avc_" == btnNameNav) {
            Nav_bavanca_macro_disabled = "off";
            hasNavButton = true;
          } else if ("sc_b_fim_" == btnNameNav) {
            Nav_bfinal_macro_disabled = "off";
            hasNavButton = true;
          }
        }
      }
    }

    if (hasNavButton) {
      nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');
      nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');
    }
  }

  function scBtnLabel()
  {
    if (typeof oResp.btnLabel != undefined) {
      for (var btnName in oResp.btnLabel) {
        $("#" + btnName).find(".btn-label").html(oResp.btnLabel[btnName]);
      }
    }
  }

  var scFormHasChanged = false;

  function scMarkFormAsChanged() {
    scFormHasChanged = true;
  }

  function scResetFormChanges() {
    scFormHasChanged = false;
  }

  var isRunning_scFormClose_F5 = false;
  function scFormClose_F5(exitUrl) {
    if (isRunning_scFormClose_F5) {
      return;
    }
    isRunning_scFormClose_F5 = true;
    setTimeout(function() { isRunning_scFormClose_F5 = false; }, 3000);

    if (scFormHasChanged) {
      scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', function() { document.F5.action = exitUrl; document.F5.submit(); }, function() {});
    } else {
      document.F5.action = exitUrl;
      document.F5.submit();
    }

  }

  var isRunning_scFormClose_F6 = false;
  function scFormClose_F6(exitUrl) {
    if (isRunning_scFormClose_F6) {
      return;
    }
    isRunning_scFormClose_F6 = true;
    setTimeout(function() { isRunning_scFormClose_F6 = false; }, 3000);

    if (scFormHasChanged) {
      scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', function() { document.F6.action = exitUrl; document.F6.submit(); }, function() {});
    } else {
      document.F6.action = exitUrl;
      document.F6.submit();
    }

  }

  // ---------- Validate hotel_id
  function do_ajax_form_tbl_hoteis_validate_hotel_id()
  {
    var nomeCampo_hotel_id = "hotel_id";
    var var_hotel_id = scAjaxGetFieldHidden(nomeCampo_hotel_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_id(var_hotel_id, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_id_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_id

  function do_ajax_form_tbl_hoteis_validate_hotel_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_id";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_id_cb

  // ---------- Validate hotel_cnpj
  function do_ajax_form_tbl_hoteis_validate_hotel_cnpj()
  {
    var nomeCampo_hotel_cnpj = "hotel_cnpj";
    var var_hotel_cnpj = scAjaxGetFieldText(nomeCampo_hotel_cnpj);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_cnpj(var_hotel_cnpj, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_cnpj_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_cnpj

  function do_ajax_form_tbl_hoteis_validate_hotel_cnpj_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_cnpj";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_cnpj_cb

  // ---------- Validate hotel_fantasia
  function do_ajax_form_tbl_hoteis_validate_hotel_fantasia()
  {
    var nomeCampo_hotel_fantasia = "hotel_fantasia";
    var var_hotel_fantasia = scAjaxGetFieldText(nomeCampo_hotel_fantasia);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_fantasia(var_hotel_fantasia, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_fantasia_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_fantasia

  function do_ajax_form_tbl_hoteis_validate_hotel_fantasia_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_fantasia";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_fantasia_cb

  // ---------- Validate hotel_razsoc
  function do_ajax_form_tbl_hoteis_validate_hotel_razsoc()
  {
    var nomeCampo_hotel_razsoc = "hotel_razsoc";
    var var_hotel_razsoc = scAjaxGetFieldText(nomeCampo_hotel_razsoc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_razsoc(var_hotel_razsoc, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_razsoc_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_razsoc

  function do_ajax_form_tbl_hoteis_validate_hotel_razsoc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_razsoc";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_razsoc_cb

  // ---------- Validate hotel_descricao
  function do_ajax_form_tbl_hoteis_validate_hotel_descricao()
  {
    var nomeCampo_hotel_descricao = "hotel_descricao";
    var var_hotel_descricao = scAjaxGetFieldText(nomeCampo_hotel_descricao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_descricao(var_hotel_descricao, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_descricao_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_descricao

  function do_ajax_form_tbl_hoteis_validate_hotel_descricao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_descricao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_descricao_cb

  // ---------- Validate hotel_rede
  function do_ajax_form_tbl_hoteis_validate_hotel_rede()
  {
    var nomeCampo_hotel_rede = "hotel_rede";
    var var_hotel_rede = scAjaxGetFieldSelect(nomeCampo_hotel_rede);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_rede(var_hotel_rede, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_rede_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_rede

  function do_ajax_form_tbl_hoteis_validate_hotel_rede_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_rede";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_rede_cb

  // ---------- Validate hotel_classificacao
  function do_ajax_form_tbl_hoteis_validate_hotel_classificacao()
  {
    var nomeCampo_hotel_classificacao = "hotel_classificacao";
    var var_hotel_classificacao = scAjaxGetFieldSelect(nomeCampo_hotel_classificacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_classificacao(var_hotel_classificacao, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_classificacao_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_classificacao

  function do_ajax_form_tbl_hoteis_validate_hotel_classificacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_classificacao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_classificacao_cb

  // ---------- Validate hotel_categoria
  function do_ajax_form_tbl_hoteis_validate_hotel_categoria()
  {
    var nomeCampo_hotel_categoria = "hotel_categoria";
    var var_hotel_categoria = scAjaxGetFieldSelect(nomeCampo_hotel_categoria);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_categoria(var_hotel_categoria, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_categoria_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_categoria

  function do_ajax_form_tbl_hoteis_validate_hotel_categoria_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_categoria";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_categoria_cb

  // ---------- Validate hotel_logo
  function do_ajax_form_tbl_hoteis_validate_hotel_logo()
  {
    var nomeCampo_hotel_logo = "hotel_logo";
    var var_hotel_logo = scAjaxGetFieldText(nomeCampo_hotel_logo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_logo(var_hotel_logo, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_logo_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_logo

  function do_ajax_form_tbl_hoteis_validate_hotel_logo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_logo";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_logo_cb

  // ---------- Validate hotel_cep
  function do_ajax_form_tbl_hoteis_validate_hotel_cep()
  {
    var nomeCampo_hotel_cep = "hotel_cep";
    var var_hotel_cep = scAjaxGetFieldText(nomeCampo_hotel_cep);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_cep(var_hotel_cep, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_cep_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_cep

  function do_ajax_form_tbl_hoteis_validate_hotel_cep_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_cep";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_cep_cb

  // ---------- Validate hotel_pais
  function do_ajax_form_tbl_hoteis_validate_hotel_pais()
  {
    var nomeCampo_hotel_pais = "hotel_pais";
    var var_hotel_pais = scAjaxGetFieldSelect(nomeCampo_hotel_pais);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_pais(var_hotel_pais, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_pais_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_pais

  function do_ajax_form_tbl_hoteis_validate_hotel_pais_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_pais";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_pais_cb

  // ---------- Validate hotel_uf
  function do_ajax_form_tbl_hoteis_validate_hotel_uf()
  {
    var nomeCampo_hotel_uf = "hotel_uf";
    var var_hotel_uf = scAjaxGetFieldText(nomeCampo_hotel_uf);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_uf(var_hotel_uf, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_uf_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_uf

  function do_ajax_form_tbl_hoteis_validate_hotel_uf_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_uf";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_uf_cb

  // ---------- Validate hotel_municipio
  function do_ajax_form_tbl_hoteis_validate_hotel_municipio()
  {
    var nomeCampo_hotel_municipio = "hotel_municipio";
    var var_hotel_municipio = scAjaxGetFieldText(nomeCampo_hotel_municipio);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_municipio(var_hotel_municipio, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_municipio_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_municipio

  function do_ajax_form_tbl_hoteis_validate_hotel_municipio_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_municipio";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_municipio_cb

  // ---------- Validate hotel_bairro
  function do_ajax_form_tbl_hoteis_validate_hotel_bairro()
  {
    var nomeCampo_hotel_bairro = "hotel_bairro";
    var var_hotel_bairro = scAjaxGetFieldText(nomeCampo_hotel_bairro);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_bairro(var_hotel_bairro, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_bairro_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_bairro

  function do_ajax_form_tbl_hoteis_validate_hotel_bairro_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_bairro";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_bairro_cb

  // ---------- Validate hotel_logradouro
  function do_ajax_form_tbl_hoteis_validate_hotel_logradouro()
  {
    var nomeCampo_hotel_logradouro = "hotel_logradouro";
    var var_hotel_logradouro = scAjaxGetFieldText(nomeCampo_hotel_logradouro);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_logradouro(var_hotel_logradouro, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_logradouro_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_logradouro

  function do_ajax_form_tbl_hoteis_validate_hotel_logradouro_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_logradouro";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_logradouro_cb

  // ---------- Validate hotel_numero
  function do_ajax_form_tbl_hoteis_validate_hotel_numero()
  {
    var nomeCampo_hotel_numero = "hotel_numero";
    var var_hotel_numero = scAjaxGetFieldText(nomeCampo_hotel_numero);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_numero(var_hotel_numero, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_numero_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_numero

  function do_ajax_form_tbl_hoteis_validate_hotel_numero_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_numero";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_numero_cb

  // ---------- Validate hotel_complemento
  function do_ajax_form_tbl_hoteis_validate_hotel_complemento()
  {
    var nomeCampo_hotel_complemento = "hotel_complemento";
    var var_hotel_complemento = scAjaxGetFieldText(nomeCampo_hotel_complemento);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_complemento(var_hotel_complemento, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_complemento_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_complemento

  function do_ajax_form_tbl_hoteis_validate_hotel_complemento_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_complemento";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_complemento_cb

  // ---------- Validate localizacao
  function do_ajax_form_tbl_hoteis_validate_localizacao()
  {
    var nomeCampo_localizacao = "localizacao";
    var var_localizacao = scAjaxGetFieldHidden(nomeCampo_localizacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_localizacao(var_localizacao, var_script_case_init, do_ajax_form_tbl_hoteis_validate_localizacao_cb);
  } // do_ajax_form_tbl_hoteis_validate_localizacao

  function do_ajax_form_tbl_hoteis_validate_localizacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "localizacao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_localizacao_cb

  // ---------- Validate hotel_observacoes
  function do_ajax_form_tbl_hoteis_validate_hotel_observacoes()
  {
    var nomeCampo_hotel_observacoes = "hotel_observacoes";
    var var_hotel_observacoes = scAjaxGetFieldText(nomeCampo_hotel_observacoes);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_observacoes(var_hotel_observacoes, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_observacoes_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_observacoes

  function do_ajax_form_tbl_hoteis_validate_hotel_observacoes_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_observacoes";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_observacoes_cb

  // ---------- Validate hotel_email
  function do_ajax_form_tbl_hoteis_validate_hotel_email()
  {
    var nomeCampo_hotel_email = "hotel_email";
    var var_hotel_email = scAjaxGetFieldText(nomeCampo_hotel_email);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_email(var_hotel_email, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_email_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_email

  function do_ajax_form_tbl_hoteis_validate_hotel_email_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_email";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_email_cb

  // ---------- Validate hotel_website
  function do_ajax_form_tbl_hoteis_validate_hotel_website()
  {
    var nomeCampo_hotel_website = "hotel_website";
    var var_hotel_website = scAjaxGetFieldText(nomeCampo_hotel_website);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_website(var_hotel_website, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_website_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_website

  function do_ajax_form_tbl_hoteis_validate_hotel_website_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_website";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_website_cb

  // ---------- Validate hotel_telefone
  function do_ajax_form_tbl_hoteis_validate_hotel_telefone()
  {
    var nomeCampo_hotel_telefone = "hotel_telefone";
    var var_hotel_telefone = scAjaxGetFieldText(nomeCampo_hotel_telefone);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_telefone(var_hotel_telefone, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_telefone_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_telefone

  function do_ajax_form_tbl_hoteis_validate_hotel_telefone_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_telefone";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_telefone_cb

  // ---------- Validate hotel_fax
  function do_ajax_form_tbl_hoteis_validate_hotel_fax()
  {
    var nomeCampo_hotel_fax = "hotel_fax";
    var var_hotel_fax = scAjaxGetFieldText(nomeCampo_hotel_fax);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_fax(var_hotel_fax, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_fax_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_fax

  function do_ajax_form_tbl_hoteis_validate_hotel_fax_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_fax";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_fax_cb

  // ---------- Validate hotel_celular
  function do_ajax_form_tbl_hoteis_validate_hotel_celular()
  {
    var nomeCampo_hotel_celular = "hotel_celular";
    var var_hotel_celular = scAjaxGetFieldText(nomeCampo_hotel_celular);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_celular(var_hotel_celular, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_celular_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_celular

  function do_ajax_form_tbl_hoteis_validate_hotel_celular_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_celular";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_celular_cb

  // ---------- Validate hotel_status
  function do_ajax_form_tbl_hoteis_validate_hotel_status()
  {
    var nomeCampo_hotel_status = "hotel_status";
    var var_hotel_status = scAjaxGetFieldRadio(nomeCampo_hotel_status);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_status(var_hotel_status, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_status_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_status

  function do_ajax_form_tbl_hoteis_validate_hotel_status_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_status";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_status_cb

  // ---------- Validate hotel_facebook
  function do_ajax_form_tbl_hoteis_validate_hotel_facebook()
  {
    var nomeCampo_hotel_facebook = "hotel_facebook";
    var var_hotel_facebook = scAjaxGetFieldText(nomeCampo_hotel_facebook);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_facebook(var_hotel_facebook, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_facebook_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_facebook

  function do_ajax_form_tbl_hoteis_validate_hotel_facebook_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_facebook";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_facebook_cb

  // ---------- Validate hotel_twitter
  function do_ajax_form_tbl_hoteis_validate_hotel_twitter()
  {
    var nomeCampo_hotel_twitter = "hotel_twitter";
    var var_hotel_twitter = scAjaxGetFieldText(nomeCampo_hotel_twitter);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_twitter(var_hotel_twitter, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_twitter_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_twitter

  function do_ajax_form_tbl_hoteis_validate_hotel_twitter_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_twitter";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_twitter_cb

  // ---------- Validate hotel_skype
  function do_ajax_form_tbl_hoteis_validate_hotel_skype()
  {
    var nomeCampo_hotel_skype = "hotel_skype";
    var var_hotel_skype = scAjaxGetFieldText(nomeCampo_hotel_skype);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_skype(var_hotel_skype, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_skype_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_skype

  function do_ajax_form_tbl_hoteis_validate_hotel_skype_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_skype";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_skype_cb

  // ---------- Validate hotel_ar_condicionado
  function do_ajax_form_tbl_hoteis_validate_hotel_ar_condicionado()
  {
    var nomeCampo_hotel_ar_condicionado = "hotel_ar_condicionado";
    var var_hotel_ar_condicionado = scAjaxGetFieldRadio(nomeCampo_hotel_ar_condicionado);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_ar_condicionado(var_hotel_ar_condicionado, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_ar_condicionado_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_ar_condicionado

  function do_ajax_form_tbl_hoteis_validate_hotel_ar_condicionado_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_ar_condicionado";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_ar_condicionado_cb

  // ---------- Validate hotel_frigobar
  function do_ajax_form_tbl_hoteis_validate_hotel_frigobar()
  {
    var nomeCampo_hotel_frigobar = "hotel_frigobar";
    var var_hotel_frigobar = scAjaxGetFieldRadio(nomeCampo_hotel_frigobar);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_frigobar(var_hotel_frigobar, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_frigobar_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_frigobar

  function do_ajax_form_tbl_hoteis_validate_hotel_frigobar_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_frigobar";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_frigobar_cb

  // ---------- Validate hotel_lavanderia
  function do_ajax_form_tbl_hoteis_validate_hotel_lavanderia()
  {
    var nomeCampo_hotel_lavanderia = "hotel_lavanderia";
    var var_hotel_lavanderia = scAjaxGetFieldRadio(nomeCampo_hotel_lavanderia);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_lavanderia(var_hotel_lavanderia, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_lavanderia_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_lavanderia

  function do_ajax_form_tbl_hoteis_validate_hotel_lavanderia_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_lavanderia";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_lavanderia_cb

  // ---------- Validate hotel_telefone_quarto
  function do_ajax_form_tbl_hoteis_validate_hotel_telefone_quarto()
  {
    var nomeCampo_hotel_telefone_quarto = "hotel_telefone_quarto";
    var var_hotel_telefone_quarto = scAjaxGetFieldRadio(nomeCampo_hotel_telefone_quarto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_telefone_quarto(var_hotel_telefone_quarto, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_telefone_quarto_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_telefone_quarto

  function do_ajax_form_tbl_hoteis_validate_hotel_telefone_quarto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_telefone_quarto";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_telefone_quarto_cb

  // ---------- Validate hotel_tv
  function do_ajax_form_tbl_hoteis_validate_hotel_tv()
  {
    var nomeCampo_hotel_tv = "hotel_tv";
    var var_hotel_tv = scAjaxGetFieldRadio(nomeCampo_hotel_tv);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_tv(var_hotel_tv, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_tv_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_tv

  function do_ajax_form_tbl_hoteis_validate_hotel_tv_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_tv";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_tv_cb

  // ---------- Validate hotel_ginastica
  function do_ajax_form_tbl_hoteis_validate_hotel_ginastica()
  {
    var nomeCampo_hotel_ginastica = "hotel_ginastica";
    var var_hotel_ginastica = scAjaxGetFieldRadio(nomeCampo_hotel_ginastica);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_ginastica(var_hotel_ginastica, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_ginastica_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_ginastica

  function do_ajax_form_tbl_hoteis_validate_hotel_ginastica_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_ginastica";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_ginastica_cb

  // ---------- Validate hotel_restaurante
  function do_ajax_form_tbl_hoteis_validate_hotel_restaurante()
  {
    var nomeCampo_hotel_restaurante = "hotel_restaurante";
    var var_hotel_restaurante = scAjaxGetFieldRadio(nomeCampo_hotel_restaurante);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_restaurante(var_hotel_restaurante, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_restaurante_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_restaurante

  function do_ajax_form_tbl_hoteis_validate_hotel_restaurante_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_restaurante";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_restaurante_cb

  // ---------- Validate hotel_bar
  function do_ajax_form_tbl_hoteis_validate_hotel_bar()
  {
    var nomeCampo_hotel_bar = "hotel_bar";
    var var_hotel_bar = scAjaxGetFieldRadio(nomeCampo_hotel_bar);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_bar(var_hotel_bar, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_bar_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_bar

  function do_ajax_form_tbl_hoteis_validate_hotel_bar_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_bar";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_bar_cb

  // ---------- Validate hotel_estacionamento
  function do_ajax_form_tbl_hoteis_validate_hotel_estacionamento()
  {
    var nomeCampo_hotel_estacionamento = "hotel_estacionamento";
    var var_hotel_estacionamento = scAjaxGetFieldRadio(nomeCampo_hotel_estacionamento);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_estacionamento(var_hotel_estacionamento, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_estacionamento_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_estacionamento

  function do_ajax_form_tbl_hoteis_validate_hotel_estacionamento_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_estacionamento";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_estacionamento_cb

  // ---------- Validate hotel_sauna
  function do_ajax_form_tbl_hoteis_validate_hotel_sauna()
  {
    var nomeCampo_hotel_sauna = "hotel_sauna";
    var var_hotel_sauna = scAjaxGetFieldRadio(nomeCampo_hotel_sauna);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_sauna(var_hotel_sauna, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_sauna_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_sauna

  function do_ajax_form_tbl_hoteis_validate_hotel_sauna_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_sauna";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_sauna_cb

  // ---------- Validate hotel_piscina
  function do_ajax_form_tbl_hoteis_validate_hotel_piscina()
  {
    var nomeCampo_hotel_piscina = "hotel_piscina";
    var var_hotel_piscina = scAjaxGetFieldRadio(nomeCampo_hotel_piscina);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_piscina(var_hotel_piscina, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_piscina_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_piscina

  function do_ajax_form_tbl_hoteis_validate_hotel_piscina_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_piscina";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_piscina_cb

  // ---------- Validate hotel_wifi
  function do_ajax_form_tbl_hoteis_validate_hotel_wifi()
  {
    var nomeCampo_hotel_wifi = "hotel_wifi";
    var var_hotel_wifi = scAjaxGetFieldRadio(nomeCampo_hotel_wifi);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_wifi(var_hotel_wifi, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_wifi_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_wifi

  function do_ajax_form_tbl_hoteis_validate_hotel_wifi_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_wifi";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_wifi_cb

  // ---------- Validate hotel_computador
  function do_ajax_form_tbl_hoteis_validate_hotel_computador()
  {
    var nomeCampo_hotel_computador = "hotel_computador";
    var var_hotel_computador = scAjaxGetFieldRadio(nomeCampo_hotel_computador);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_computador(var_hotel_computador, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_computador_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_computador

  function do_ajax_form_tbl_hoteis_validate_hotel_computador_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_computador";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_computador_cb

  // ---------- Validate hotel_convencoes
  function do_ajax_form_tbl_hoteis_validate_hotel_convencoes()
  {
    var nomeCampo_hotel_convencoes = "hotel_convencoes";
    var var_hotel_convencoes = scAjaxGetFieldRadio(nomeCampo_hotel_convencoes);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_convencoes(var_hotel_convencoes, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_convencoes_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_convencoes

  function do_ajax_form_tbl_hoteis_validate_hotel_convencoes_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_convencoes";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_convencoes_cb

  // ---------- Validate hotel_cod_estrangeiro
  function do_ajax_form_tbl_hoteis_validate_hotel_cod_estrangeiro()
  {
    var nomeCampo_hotel_cod_estrangeiro = "hotel_cod_estrangeiro";
    var var_hotel_cod_estrangeiro = scAjaxGetFieldHidden(nomeCampo_hotel_cod_estrangeiro);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_tbl_hoteis_validate_hotel_cod_estrangeiro(var_hotel_cod_estrangeiro, var_script_case_init, do_ajax_form_tbl_hoteis_validate_hotel_cod_estrangeiro_cb);
  } // do_ajax_form_tbl_hoteis_validate_hotel_cod_estrangeiro

  function do_ajax_form_tbl_hoteis_validate_hotel_cod_estrangeiro_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_cod_estrangeiro";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      var sImgStatus = sc_img_status_ok;
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      var sImgStatus = sc_img_status_err;
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    var $oImg = $('#id_sc_status_' + sFieldValid);
    if (0 < $oImg.length)
    {
      $oImg.attr('src', sImgStatus).css('display', '');
    }
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_validate_hotel_cod_estrangeiro_cb

  // ---------- Refresh hotel_uf
  function do_ajax_form_tbl_hoteis_refresh_hotel_uf()
  {
    var var_hotel_uf = scAjaxGetFieldText("hotel_uf");
    var var_nmgp_refresh_fields = "hotel_pais";
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_tbl_hoteis_refresh_hotel_uf(var_hotel_uf, var_nmgp_refresh_fields, var_script_case_init, do_ajax_form_tbl_hoteis_refresh_hotel_uf_cb);
  } // do_ajax_form_tbl_hoteis_refresh_hotel_uf

  function do_ajax_form_tbl_hoteis_refresh_hotel_uf_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    scAjaxRedir();
    scAjaxSetFields(false);
    scAjaxSetVariables();
    scAjaxShowDebug();
    scAjaxSetMaster();
    scAjaxSetFocus();
  } // do_ajax_form_tbl_hoteis_refresh_hotel_uf_cb

  // ---------- Event onchange hotel_cnpj
  function do_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange()
  {
    var var_hotel_cnpj = scAjaxGetFieldText("hotel_cnpj");
    var var_hotel_rede = scAjaxGetFieldSelect("hotel_rede");
    var var_hotel_razsoc = scAjaxGetFieldText("hotel_razsoc");
    var var_hotel_fantasia = scAjaxGetFieldText("hotel_fantasia");
    var var_hotel_cod_estrangeiro = scAjaxGetFieldHidden("hotel_cod_estrangeiro");
    var var_hotel_cep = scAjaxGetFieldText("hotel_cep");
    var var_hotel_pais = scAjaxGetFieldSelect("hotel_pais");
    var var_hotel_email = scAjaxGetFieldText("hotel_email");
    var var_hotel_website = scAjaxGetFieldText("hotel_website");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange(var_hotel_cnpj, var_hotel_rede, var_hotel_razsoc, var_hotel_fantasia, var_hotel_cod_estrangeiro, var_hotel_cep, var_hotel_pais, var_hotel_email, var_hotel_website, var_script_case_init, do_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange_cb);
  } // do_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange

  function do_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "hotel_cnpj";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange_cb_after_alert);
  } // do_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange_cb
  function do_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange_cb_after_alert

  // ---------- Event onfocus hotel_descricao
  function do_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus()
  {
    var var_hotel_descricao = scAjaxGetFieldText("hotel_descricao");
    var var_hotel_fantasia = scAjaxGetFieldText("hotel_fantasia");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn();
    x_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus(var_hotel_descricao, var_hotel_fantasia, var_script_case_init, do_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus_cb);
  } // do_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus

  function do_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus_cb(sResp)
  {
    scAjaxProcOff();
    oResp = scAjaxResponse(sResp);
    sFieldValid = "hotel_descricao";
    scAjaxUpdateFieldErrors(sFieldValid, "onfocus");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus_cb_after_alert);
  } // do_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus_cb
  function do_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus_cb_after_alert

  // ---------- Event onchange hotel_numero
  function do_ajax_form_tbl_hoteis_event_hotel_numero_onchange()
  {
    var var_localizacao = scAjaxGetFieldHidden("localizacao");
    var var_hotel_logradouro = scAjaxGetFieldText("hotel_logradouro");
    var var_hotel_numero = scAjaxGetFieldText("hotel_numero");
    var var_hotel_bairro = scAjaxGetFieldText("hotel_bairro");
    var var_hotel_municipio = scAjaxGetFieldText("hotel_municipio");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_tbl_hoteis_event_hotel_numero_onchange(var_localizacao, var_hotel_logradouro, var_hotel_numero, var_hotel_bairro, var_hotel_municipio, var_script_case_init, do_ajax_form_tbl_hoteis_event_hotel_numero_onchange_cb);
  } // do_ajax_form_tbl_hoteis_event_hotel_numero_onchange

  function do_ajax_form_tbl_hoteis_event_hotel_numero_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "hotel_numero";
    scEventControl_onChange(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "onchange");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors)
    {
      scAjaxHideErrorDisplay(sFieldValid);
    }
    else
    {
      scAjaxShowErrorDisplay(sFieldValid, sFieldErrors);
    }
    if (!scAjaxHasError())
    {
      scAjaxSetFields();
      scAjaxSetVariables();
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxSetMaster();
    scAjaxAlert(do_ajax_form_tbl_hoteis_event_hotel_numero_onchange_cb_after_alert);
  } // do_ajax_form_tbl_hoteis_event_hotel_numero_onchange_cb
  function do_ajax_form_tbl_hoteis_event_hotel_numero_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_tbl_hoteis_event_hotel_numero_onchange_cb_after_alert

  var cepReturnFieldData;

  function cepReturnValues(fieldConf)
  {
    cepReturnFieldData = fieldConf;
  } // cepReturnValues

  function cepForceValue(fieldName, fieldValue)
  {
    var i, fieldOptions, fieldOption;
    fieldOptions = $("#id_sc_field_" + fieldName).find("option");
    for (i = 0; i < fieldOptions.length; i++) {
      fieldOption = $(fieldOptions[i]);
      if (fieldValue == fieldOption.val() || fieldValue == fieldOption.text()) {
        $("#id_sc_field_" + fieldName).prop("selectedIndex", fieldOption.index());
        cepReturnFieldData[fieldName] = null;
        return;
      }
    }
  } // cepForceValue

function scAjaxShowErrorDisplay(sErrorId, sErrorMsg) {
        if ("table" != sErrorId && !$("id_error_display_" + sErrorId + "_frame").hasClass('scFormToastDivFixed')) {
                scAjaxShowErrorDisplay_default(sErrorId, sErrorMsg);
        }
        else {
                scAjaxShowErrorDisplay_toast(sErrorId, sErrorMsg);
        }
} // scAjaxShowErrorDisplay

function scAjaxHideErrorDisplay(sErrorId, sErrorMsg) {
        if ("table" != sErrorId && !$("id_error_display_" + sErrorId + "_frame").hasClass('scFormToastDivFixed')) {
                scAjaxHideErrorDisplay_default(sErrorId, sErrorMsg);
        }
        else {
                scAjaxHideErrorDisplay_toast(sErrorId, sErrorMsg);
        }
} // scAjaxHideErrorDisplay

function scAjaxShowErrorDisplay_toast(sErrorId, sErrorMsg) {
        params = {type: 'error'};
        params['title'] = '';
        scJs_alert_sweetalert(sErrorMsg, function() { scAjaxHideErrorDisplay(sErrorId, sErrorMsg); }, scJs_sweetalert_params(params));
} // scAjaxShowErrorDisplay_toast

function scAjaxHideErrorDisplay_toast(sErrorId, bForce) {
        if (document.getElementById("id_error_display_" + sErrorId + "_frame")) {
                if (null == bForce) {
                        bForce = true;
                }
                if (bForce) {
                        var $oField = $('#id_sc_field_' + sErrorId);
                        if (0 < $oField.length) {
                                $oField.removeClass(sc_css_status);
                        }
                }
        }
} // scAjaxHideErrorDisplay_toast

function scAjaxShowMessage(messageType) {
        scAjaxShowMessage_toast(true, messageType);
} // scAjaxShowMessage_toast

function scAjaxHideMessage() {
} // scAjaxHideMessage_toast

function scAjaxShowMessage_toast(isToast, messageType) {
        if (!oResp["msgDisplay"] || !oResp["msgDisplay"]["msgText"]) {
                return;
        }

        if (oResp["msgDisplay"]["toast"] || isToast) {
                _scAjaxShowMessageToast({title: scMsgDefTitle, message: oResp["msgDisplay"]["msgText"], isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, toastPos: "", type: messageType});
        }
        else {
                scJs_alert(oResp["msgDisplay"]["msgText"], scForm_cancel, {});
        }
} // scAjaxShowMessage_toast

function _scAjaxShowMessageToast(params) {
        var sweetAlertParams = {toast: true, showConfirmButton: false};

        if ("" != params["type"]) {
                sweetAlertParams["type"] = params["type"];
        }

        if ("" != params["title"]) {
                sweetAlertParams["title"] = scAjaxSpecCharParser(params["title"]);
        }

        if ("" != params["toastPos"]) {
                sweetAlertParams["position"] = params["toastPos"];
        }

        if (null == sweetAlertParams["position"]) {
                sweetAlertParams["position"] = "top-end";
        }

        if (null == sweetAlertParams["timer"]) {
                sweetAlertParams["timer"] = 3000;
        }

        scJs_alert_sweetalert(scAjaxSpecCharParser(params["message"]), scForm_cancel, scJs_sweetalert_params(sweetAlertParams));
} // _scAjaxShowMessageToast

function _scAjaxShowMessage(params) {
        if (params["isToast"]) {
                _scAjaxShowMessageToast(params);
        }
        else {
                if ("" != params["redirUrl"] && "" != params["redirTarget"]) {
            document.form_ajax_redir_2.action = params["redirUrl"];
            document.form_ajax_redir_2.target = params["redirTarget"];
            document.form_ajax_redir_2.nmgp_parms.value = params["redirParams"];
            document.form_ajax_redir_2.script_case_init.value = scMsgDefScInit;
                        callbackOk = function() { document.form_ajax_redir_2.submit(); };
                }
                else if ("" != params["redirUrl"] && "" == params["redirTarget"]) {
            document.form_ajax_redir_1.action = params["redirUrl"];
            document.form_ajax_redir_1.nmgp_parms.value = params["redirParams"];
                        callbackOk = function() { document.form_ajax_redir_1.submit(); };
                }
                else {
                        callbackOk = scForm_cancel;
                }

                var alertParams = {title: params["title"]};
                if (0 < params["width"]) {
                        alertParams["width"] = params["width"];
                }
                if (0 < params["timeout"]) {
                        alertParams["timer"] = params["timeout"] * 1000;
                }
                if (!params["showButton"]) {
                        alertParams["showConfirmButton"] = false;
                }
                if ("" != params["buttonLabel"]) {
                        alertParams["confirmButtonText"] = params["buttonLabel"];
                }
                if ("" != params["type"]) {
                        alertParams["type"] = params["type"];
                }

                scJs_alert_sweetalert(params["message"], callbackOk, scJs_sweetalert_params(alertParams));
        }
} // _scAjaxShowMessage

<?php
$confirmButtonClass = '';
$cancelButtonClass  = '';
$confirmButtonFA    = '';
$cancelButtonFA     = '';
$confirmButtonFAPos = '';
$cancelButtonFAPos  = '';
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['style']) && '' != $this->arr_buttons['bsweetalert_ok']['style']) {
        $confirmButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_ok']['style'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['style']) && '' != $this->arr_buttons['bsweetalert_cancel']['style']) {
        $cancelButtonClass = 'scButton_' . $this->arr_buttons['bsweetalert_cancel']['style'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_ok']['fontawesomeicon']) {
        $confirmButtonFA = $this->arr_buttons['bsweetalert_ok']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) && '' != $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon']) {
        $cancelButtonFA = $this->arr_buttons['bsweetalert_cancel']['fontawesomeicon'];
}
if (isset($this->arr_buttons['bsweetalert_ok']) && isset($this->arr_buttons['bsweetalert_ok']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_ok']['display_position']) {
        $confirmButtonFAPos = 'text_right';
}
if (isset($this->arr_buttons['bsweetalert_cancel']) && isset($this->arr_buttons['bsweetalert_cancel']['display_position']) && 'img_right' != $this->arr_buttons['bsweetalert_cancel']['display_position']) {
        $cancelButtonFAPos = 'text_right';
}
?>
function scJs_alert(message, callbackOk, params) {
    message = message.replace(/<!--SC_NL-->/gi, "<br />");
        scJs_alert_sweetalert(message, callbackOk, scJs_sweetalert_params(params));
} // scJs_alert

function scJs_confirm(message, callbackOk, callbackCancel) {
        scJs_confirm_sweetalert(message, callbackOk, callbackCancel);
} // scJs_confirm

function scJs_alert_sweetalert(message, callbackOk, params) {
    var sweetAlertConfig;

    if (Swal.isVisible()) {
        return;
    }

    if (null == params) {
        params = {};
    }

    params['html'] = message;

    sweetAlertConfig = params;

    Swal.fire(sweetAlertConfig).then(function (result) {
        if (result.value) {
            if (typeof callbackOk == "function") {
                callbackOk();
            }
        } else if (result.dismiss == Swal.DismissReason.timer || result.dismiss == Swal.DismissReason.close) {
            Swal.close();
            $(".swal2-container.swal2-shown").remove();
        } else {
            console.log(result.dismiss);
        }
    });
} // scJs_alert_sweetalert

function scJs_confirm_sweetalert(message, callbackOk, callbackCancel) {
        var sweetAlertConfig, params = {};

        params['html'] = message;
        params['type'] = 'question';
        params['showCancelButton'] = true;

        sweetAlertConfig = scJs_sweetalert_params(params);

        Swal.fire(sweetAlertConfig).then(function (result) {
                if (result.value) {
                        callbackOk();
                }
                else if (result.dismiss === Swal.DismissReason.backdrop || result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.esc) {
                        callbackCancel();
                }
        });
} // scJs_confirm_sweetalert

function scJs_sweetalert_params(params) {
        var parName, confirmText, confirmFA, confirmPos, cancelText, cancelFA, cancelPos, sweetAlertConfig;

        sweetAlertConfig = {
                customClass: {
                        popup: 'scSweetAlertPopup',
                        header: 'scSweetAlertHeader',
                        content: 'scSweetAlertMessage',
                        confirmButton: '<?php echo $confirmButtonClass; ?>',
                        cancelButton: '<?php echo $cancelButtonClass; ?>'
                }
        };

        confirmText = '<?php echo isset($this->arr_buttons['bsweetalert_ok']['value']) ? $this->arr_buttons['bsweetalert_ok']['value'] : $this->Ini->Nm_lang['lang_btns_cfrm'] ?>';
        confirmFA = '<?php echo $confirmButtonFA ?>';
        confirmPos = '<?php echo $confirmButtonFAPos ?>';
        cancelText = '<?php echo isset($this->arr_buttons['bsweetalert_cancel']['value']) ? $this->arr_buttons['bsweetalert_cancel']['value'] : $this->Ini->Nm_lang['lang_btns_cncl'] ?>';
        cancelFA = '<?php echo $cancelButtonFA ?>';
        cancelPos = '<?php echo $cancelButtonFAPos ?>';

        for (parName in params) {
                if ('confirmButtonText' == parName) {
                        confirmText = params[parName];
                }
                else if ('confirmButtonFA' == parName) {
                        confirmFA = params[parName];
                }
                else if ('confirmButtonFAPos' == parName) {
                        confirmPos = params[parName];
                }
                else if ('cancelButtonText' == parName) {
                        cancelText = params[parName];
                }
                else if ('cancelButtonFA' == parName) {
                        cancelFA = params[parName];
                }
                else if ('cancelButtonFAPos' == parName) {
                        cancelPos = params[parName];
                }
                else {
                        sweetAlertConfig[parName] = params[parName];
                }
        }

        if ('' != confirmFA) {
                if ('text_right' == confirmPos) {
                        confirmText = '<i class="fas ' + confirmFA + '"></i> ' + confirmText;
                }
                else {
                        confirmText += ' <i class="fas ' + confirmFA + '"></i>';
                }
        }
        if ('' != cancelFA) {
                if ('text_right' == cancelPos) {
                        cancelText = '<i class="fas ' + cancelFA + '"></i> ' + cancelText;
                }
                else {
                        cancelText += ' <i class="fas ' + cancelFA + '"></i>';
                }
        }

        sweetAlertConfig['confirmButtonText'] = confirmText;
        sweetAlertConfig['cancelButtonText'] = cancelText;

        if (sweetAlertConfig['toast']) {
                sweetAlertConfig['showConfirmButton'] = false;
                sweetAlertConfig['showCancelButton'] = false;
                sweetAlertConfig['customClass']['popup'] = 'scToastPopup';
                sweetAlertConfig['customClass']['header'] = 'scToastHeader';
                sweetAlertConfig['customClass']['content'] = 'scToastMessage';
                if (null == sweetAlertConfig['timer']) {
                        sweetAlertConfig['timer'] = 3000;
                }
                if (null == sweetAlertConfig["position"]) {
                        sweetAlertConfig["position"] = "top-end";
                }
        }

        return sweetAlertConfig;
} // scJs_sweetalert_params

  // ---------- Form
  function do_ajax_form_tbl_hoteis_submit_form()
  {
    if (scEventControl_active("")) {
      setTimeout(function() { do_ajax_form_tbl_hoteis_submit_form(); }, 500);
      return;
    }
    scAjaxHideMessage();
    var var_hotel_id = scAjaxGetFieldHidden("hotel_id");
    var var_hotel_cnpj = scAjaxGetFieldText("hotel_cnpj");
    var var_hotel_fantasia = scAjaxGetFieldText("hotel_fantasia");
    var var_hotel_razsoc = scAjaxGetFieldText("hotel_razsoc");
    var var_hotel_descricao = scAjaxGetFieldText("hotel_descricao");
    var var_hotel_rede = scAjaxGetFieldSelect("hotel_rede");
    var var_hotel_classificacao = scAjaxGetFieldSelect("hotel_classificacao");
    var var_hotel_categoria = scAjaxGetFieldSelect("hotel_categoria");
    var var_hotel_logo = scAjaxGetFieldText("hotel_logo");
    var var_hotel_cep = scAjaxGetFieldText("hotel_cep");
    var var_hotel_pais = scAjaxGetFieldSelect("hotel_pais");
    var var_hotel_uf = scAjaxGetFieldText("hotel_uf");
    var var_hotel_municipio = scAjaxGetFieldText("hotel_municipio");
    var var_hotel_bairro = scAjaxGetFieldText("hotel_bairro");
    var var_hotel_logradouro = scAjaxGetFieldText("hotel_logradouro");
    var var_hotel_numero = scAjaxGetFieldText("hotel_numero");
    var var_hotel_complemento = scAjaxGetFieldText("hotel_complemento");
    var var_localizacao = scAjaxGetFieldHidden("localizacao");
    var var_hotel_observacoes = scAjaxGetFieldText("hotel_observacoes");
    var var_hotel_email = scAjaxGetFieldText("hotel_email");
    var var_hotel_website = scAjaxGetFieldText("hotel_website");
    var var_hotel_telefone = scAjaxGetFieldText("hotel_telefone");
    var var_hotel_fax = scAjaxGetFieldText("hotel_fax");
    var var_hotel_celular = scAjaxGetFieldText("hotel_celular");
    var var_hotel_status = scAjaxGetFieldRadio("hotel_status");
    var var_hotel_facebook = scAjaxGetFieldText("hotel_facebook");
    var var_hotel_twitter = scAjaxGetFieldText("hotel_twitter");
    var var_hotel_skype = scAjaxGetFieldText("hotel_skype");
    var var_hotel_ar_condicionado = scAjaxGetFieldRadio("hotel_ar_condicionado");
    var var_hotel_frigobar = scAjaxGetFieldRadio("hotel_frigobar");
    var var_hotel_lavanderia = scAjaxGetFieldRadio("hotel_lavanderia");
    var var_hotel_telefone_quarto = scAjaxGetFieldRadio("hotel_telefone_quarto");
    var var_hotel_tv = scAjaxGetFieldRadio("hotel_tv");
    var var_hotel_ginastica = scAjaxGetFieldRadio("hotel_ginastica");
    var var_hotel_restaurante = scAjaxGetFieldRadio("hotel_restaurante");
    var var_hotel_bar = scAjaxGetFieldRadio("hotel_bar");
    var var_hotel_estacionamento = scAjaxGetFieldRadio("hotel_estacionamento");
    var var_hotel_sauna = scAjaxGetFieldRadio("hotel_sauna");
    var var_hotel_piscina = scAjaxGetFieldRadio("hotel_piscina");
    var var_hotel_wifi = scAjaxGetFieldRadio("hotel_wifi");
    var var_hotel_computador = scAjaxGetFieldRadio("hotel_computador");
    var var_hotel_convencoes = scAjaxGetFieldRadio("hotel_convencoes");
    var var_hotel_cod_estrangeiro = scAjaxGetFieldHidden("hotel_cod_estrangeiro");
    var var_hotel_logo_ul_name = scAjaxSpecCharProtect(document.F1.hotel_logo_ul_name.value);//.replace(/[+]/g, "__NM_PLUS__");
    var var_hotel_logo_ul_type = document.F1.hotel_logo_ul_type.value;
    var var_hotel_logo_limpa = document.F1.hotel_logo_limpa.checked ? "S" : "N";
    var var_nm_form_submit = document.F1.nm_form_submit.value;
    var var_nmgp_url_saida = document.F1.nmgp_url_saida.value;
    var var_nmgp_opcao = document.F1.nmgp_opcao.value;
    var var_nmgp_ancora = document.F1.nmgp_ancora.value;
    var var_nmgp_num_form = document.F1.nmgp_num_form.value;
    var var_nmgp_parms = document.F1.nmgp_parms.value;
    var var_script_case_init = document.F1.script_case_init.value;
    var var_csrf_token = scAjaxGetFieldText("csrf_token");
    scAjaxProcOn();
    x_ajax_form_tbl_hoteis_submit_form(var_hotel_id, var_hotel_cnpj, var_hotel_fantasia, var_hotel_razsoc, var_hotel_descricao, var_hotel_rede, var_hotel_classificacao, var_hotel_categoria, var_hotel_logo, var_hotel_cep, var_hotel_pais, var_hotel_uf, var_hotel_municipio, var_hotel_bairro, var_hotel_logradouro, var_hotel_numero, var_hotel_complemento, var_localizacao, var_hotel_observacoes, var_hotel_email, var_hotel_website, var_hotel_telefone, var_hotel_fax, var_hotel_celular, var_hotel_status, var_hotel_facebook, var_hotel_twitter, var_hotel_skype, var_hotel_ar_condicionado, var_hotel_frigobar, var_hotel_lavanderia, var_hotel_telefone_quarto, var_hotel_tv, var_hotel_ginastica, var_hotel_restaurante, var_hotel_bar, var_hotel_estacionamento, var_hotel_sauna, var_hotel_piscina, var_hotel_wifi, var_hotel_computador, var_hotel_convencoes, var_hotel_cod_estrangeiro, var_hotel_logo_ul_name, var_hotel_logo_ul_type, var_hotel_logo_limpa, var_nm_form_submit, var_nmgp_url_saida, var_nmgp_opcao, var_nmgp_ancora, var_nmgp_num_form, var_nmgp_parms, var_script_case_init, var_csrf_token, do_ajax_form_tbl_hoteis_submit_form_cb);
  } // do_ajax_form_tbl_hoteis_submit_form

  function do_ajax_form_tbl_hoteis_submit_form_cb(sResp)
  {
    scAjaxProcOff();
    oResp = scAjaxResponse(sResp);
    scAjaxUpdateErrors("valid");
    sAppErrors = scAjaxListErrors(true);
    if ("" == sAppErrors || "menu_link" == document.F1.nmgp_opcao.value)
    {
      $('.sc-js-ui-statusimg').css('display', 'none');
      scAjaxHideErrorDisplay("table");
    }
    else
    {
      scAjaxError_markList();
      scAjaxShowErrorDisplay("table", sAppErrors);
    }
    if (scAjaxIsOk())
    {
      scResetFormChanges();
      scAjaxShowMessage("success");
      scAjaxHideErrorDisplay("table");
      scAjaxHideErrorDisplay("hotel_id");
      scAjaxHideErrorDisplay("hotel_cnpj");
      scAjaxHideErrorDisplay("hotel_fantasia");
      scAjaxHideErrorDisplay("hotel_razsoc");
      scAjaxHideErrorDisplay("hotel_descricao");
      scAjaxHideErrorDisplay("hotel_rede");
      scAjaxHideErrorDisplay("hotel_classificacao");
      scAjaxHideErrorDisplay("hotel_categoria");
      scAjaxHideErrorDisplay("hotel_logo");
      scAjaxHideErrorDisplay("hotel_cep");
      scAjaxHideErrorDisplay("hotel_pais");
      scAjaxHideErrorDisplay("hotel_uf");
      scAjaxHideErrorDisplay("hotel_municipio");
      scAjaxHideErrorDisplay("hotel_bairro");
      scAjaxHideErrorDisplay("hotel_logradouro");
      scAjaxHideErrorDisplay("hotel_numero");
      scAjaxHideErrorDisplay("hotel_complemento");
      scAjaxHideErrorDisplay("localizacao");
      scAjaxHideErrorDisplay("hotel_observacoes");
      scAjaxHideErrorDisplay("hotel_email");
      scAjaxHideErrorDisplay("hotel_website");
      scAjaxHideErrorDisplay("hotel_telefone");
      scAjaxHideErrorDisplay("hotel_fax");
      scAjaxHideErrorDisplay("hotel_celular");
      scAjaxHideErrorDisplay("hotel_status");
      scAjaxHideErrorDisplay("hotel_facebook");
      scAjaxHideErrorDisplay("hotel_twitter");
      scAjaxHideErrorDisplay("hotel_skype");
      scAjaxHideErrorDisplay("hotel_ar_condicionado");
      scAjaxHideErrorDisplay("hotel_frigobar");
      scAjaxHideErrorDisplay("hotel_lavanderia");
      scAjaxHideErrorDisplay("hotel_telefone_quarto");
      scAjaxHideErrorDisplay("hotel_tv");
      scAjaxHideErrorDisplay("hotel_ginastica");
      scAjaxHideErrorDisplay("hotel_restaurante");
      scAjaxHideErrorDisplay("hotel_bar");
      scAjaxHideErrorDisplay("hotel_estacionamento");
      scAjaxHideErrorDisplay("hotel_sauna");
      scAjaxHideErrorDisplay("hotel_piscina");
      scAjaxHideErrorDisplay("hotel_wifi");
      scAjaxHideErrorDisplay("hotel_computador");
      scAjaxHideErrorDisplay("hotel_convencoes");
      scAjaxHideErrorDisplay("hotel_cod_estrangeiro");
      scLigEditLookupCall();
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) {
?>
      var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['parent_widget']; ?>']");
      if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.nm_gp_move) {
        dbParentFrame[0].contentWindow.nm_gp_move("igual");
      }
<?php
}
?>
    }
    Nm_Proc_Atualiz = false;
    if (!scAjaxHasError())
    {
      scAjaxSetFields(false);
      scAjaxSetVariables();
      scAjaxSetMaster();
      if (scInlineFormSend())
      {
        self.parent.tb_remove();
        return;
      }
      if (document.F1.hotel_logo_limpa && document.F1.hotel_logo_limpa.checked)
      {
        var oImgTemp = {0: {"value" : ""}};
        scAjaxSetFieldImage("hotel_logo", oImgTemp, "", "", "", "N");
      }
    document.F1.hotel_logo_ul_name.value = '';
    document.F1.hotel_logo_ul_type.value = '';
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxAlert(do_ajax_form_tbl_hoteis_submit_form_cb_after_alert);
  } // do_ajax_form_tbl_hoteis_submit_form_cb
  function do_ajax_form_tbl_hoteis_submit_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_tbl_hoteis_submit_form_cb_after_alert

  var scStatusDetail = {};

  function do_ajax_form_tbl_hoteis_navigate_form()
  {
    if (scFormHasChanged) {
      scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', perform_ajax_form_tbl_hoteis_navigate_form, function() {});
    } else {
      perform_ajax_form_tbl_hoteis_navigate_form();
    }
  }

  function perform_ajax_form_tbl_hoteis_navigate_form()
  {
    if (scRefreshTable())
    {
      return;
    }
    scAjaxHideMessage();
    scAjaxHideErrorDisplay("table");
    scAjaxHideErrorDisplay("hotel_id");
    scAjaxHideErrorDisplay("hotel_cnpj");
    scAjaxHideErrorDisplay("hotel_fantasia");
    scAjaxHideErrorDisplay("hotel_razsoc");
    scAjaxHideErrorDisplay("hotel_descricao");
    scAjaxHideErrorDisplay("hotel_rede");
    scAjaxHideErrorDisplay("hotel_classificacao");
    scAjaxHideErrorDisplay("hotel_categoria");
    scAjaxHideErrorDisplay("hotel_logo");
    scAjaxHideErrorDisplay("hotel_cep");
    scAjaxHideErrorDisplay("hotel_pais");
    scAjaxHideErrorDisplay("hotel_uf");
    scAjaxHideErrorDisplay("hotel_municipio");
    scAjaxHideErrorDisplay("hotel_bairro");
    scAjaxHideErrorDisplay("hotel_logradouro");
    scAjaxHideErrorDisplay("hotel_numero");
    scAjaxHideErrorDisplay("hotel_complemento");
    scAjaxHideErrorDisplay("localizacao");
    scAjaxHideErrorDisplay("hotel_observacoes");
    scAjaxHideErrorDisplay("hotel_email");
    scAjaxHideErrorDisplay("hotel_website");
    scAjaxHideErrorDisplay("hotel_telefone");
    scAjaxHideErrorDisplay("hotel_fax");
    scAjaxHideErrorDisplay("hotel_celular");
    scAjaxHideErrorDisplay("hotel_status");
    scAjaxHideErrorDisplay("hotel_facebook");
    scAjaxHideErrorDisplay("hotel_twitter");
    scAjaxHideErrorDisplay("hotel_skype");
    scAjaxHideErrorDisplay("hotel_ar_condicionado");
    scAjaxHideErrorDisplay("hotel_frigobar");
    scAjaxHideErrorDisplay("hotel_lavanderia");
    scAjaxHideErrorDisplay("hotel_telefone_quarto");
    scAjaxHideErrorDisplay("hotel_tv");
    scAjaxHideErrorDisplay("hotel_ginastica");
    scAjaxHideErrorDisplay("hotel_restaurante");
    scAjaxHideErrorDisplay("hotel_bar");
    scAjaxHideErrorDisplay("hotel_estacionamento");
    scAjaxHideErrorDisplay("hotel_sauna");
    scAjaxHideErrorDisplay("hotel_piscina");
    scAjaxHideErrorDisplay("hotel_wifi");
    scAjaxHideErrorDisplay("hotel_computador");
    scAjaxHideErrorDisplay("hotel_convencoes");
    scAjaxHideErrorDisplay("hotel_cod_estrangeiro");
    var var_hotel_id = document.F2.hotel_id.value;
    var var_nm_form_submit = document.F2.nm_form_submit.value;
    var var_nmgp_opcao = document.F2.nmgp_opcao.value;
    var var_nmgp_ordem = document.F2.nmgp_ordem.value;
    var var_nmgp_fast_search = document.F2.nmgp_fast_search.value;
    var var_nmgp_cond_fast_search = document.F2.nmgp_cond_fast_search.value;
    var var_nmgp_arg_fast_search = document.F2.nmgp_arg_fast_search.value;
    var var_nmgp_arg_dyn_search = document.F2.nmgp_arg_dyn_search.value;
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn();
    x_ajax_form_tbl_hoteis_navigate_form(var_hotel_id, var_nm_form_submit, var_nmgp_opcao, var_nmgp_ordem, var_nmgp_fast_search,  var_nmgp_cond_fast_search,  var_nmgp_arg_fast_search, var_nmgp_arg_dyn_search, var_script_case_init, do_ajax_form_tbl_hoteis_navigate_form_cb);
  } // do_ajax_form_tbl_hoteis_navigate_form

  var scMasterDetailParentIframe = "<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['parent_widget'] ?>";
  var scMasterDetailIframe = {};
<?php
foreach ($this->Ini->sc_lig_iframe as $tmp_i => $tmp_v)
{
?>
  scMasterDetailIframe["<?php echo $tmp_i; ?>"] = "<?php echo $tmp_v; ?>";
<?php
}
?>
  function do_ajax_form_tbl_hoteis_navigate_form_cb(sResp)
  {
    scAjaxProcOff();
    oResp = scAjaxResponse(sResp);
    var var_nmgp_opcao = document.F2.nmgp_opcao.value;
    scAjaxRedir();
    if (oResp['empty_filter'] && oResp['empty_filter'] == "ok")
    {
        document.F5.nmgp_opcao.value = "inicio";
        document.F5.nmgp_parms.value = "";
        document.F5.submit();
    }
    if ("ERROR" == oResp.result)
    {
        scAjaxShowErrorDisplay("table", oResp.errList[0].msgText);
        scAjaxProcOff();
        return;
    }
    else if (oResp["navSummary"] && oResp["navSummary"].reg_tot == 0)
    {
       scAjax_displayEmptyForm();
    }
    scAjaxClearErrors();
    scResetFormChanges();
    sc_mupload_ok = true;
    scAjaxSetFields(false);
    scAjaxSetVariables();
    scAjaxSetSummaryLine();
    document.F2.hotel_id.value = scAjaxGetKeyValue("hotel_id");
    scAjaxSetSummary();
    scAjaxSetNavpage();
    scAjaxShowDebug();
    scAjaxSetLabel(true);
    scAjaxSetReadonly(true);
    scAjaxSetMaster();
    scAjaxSetNavStatus("t");
    scAjaxSetNavStatus("b");
    scAjaxSetDisplay(true);
    document.F1.hotel_logo_ul_name.value = '';
    document.F1.hotel_logo_ul_type.value = '';
    scAjaxSetBtnVars();
    sc_change_tabs(true, 'hidden_bloco_0', 'id_tabs_0_0');
    sc_change_tabs(false, 'hidden_bloco_1', 'id_tabs_0_1');
    sc_change_tabs(false, 'hidden_bloco_2', 'id_tabs_0_2');
    sc_change_tabs(false, 'hidden_bloco_3', 'id_tabs_0_3');
    sc_change_tabs(false, 'hidden_bloco_4', 'id_tabs_0_4');
    $('.sc-js-ui-statusimg').css('display', 'none');
    scAjaxAlert(do_ajax_form_tbl_hoteis_navigate_form_cb_after_alert);
  } // do_ajax_form_tbl_hoteis_navigate_form_cb
  function do_ajax_form_tbl_hoteis_navigate_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scQuickSearchKeyUp('t', null);
    $('#SC_fast_search_t').blur();
    scAjaxSetFocus();
<?php
if ($this->Embutida_form)
{
?>
    do_ajax_form_tbl_hoteis_restore_buttons();
<?php
}
?>
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_tbl_hoteis_navigate_form_cb_after_alert

  function sc_hide_form_tbl_hoteis_form()
  {
    for (var block_id in ajax_block_id) {
      $("#div_" + ajax_block_id[block_id]).hide();
    }
  } // sc_hide_form_tbl_hoteis_form


  function scAjaxDetailProc()
  {
    return true;
  } // scAjaxDetailProc


  var ajax_error_geral = "";

  var ajax_error_type = new Array("valid", "onblur", "onchange", "onclick", "onfocus");

  var ajax_field_list = new Array();
  var ajax_field_Dt_Hr = new Array();
  ajax_field_list[0] = "hotel_id";
  ajax_field_list[1] = "hotel_cnpj";
  ajax_field_list[2] = "hotel_fantasia";
  ajax_field_list[3] = "hotel_razsoc";
  ajax_field_list[4] = "hotel_descricao";
  ajax_field_list[5] = "hotel_rede";
  ajax_field_list[6] = "hotel_classificacao";
  ajax_field_list[7] = "hotel_categoria";
  ajax_field_list[8] = "hotel_logo";
  ajax_field_list[9] = "hotel_cep";
  ajax_field_list[10] = "hotel_pais";
  ajax_field_list[11] = "hotel_uf";
  ajax_field_list[12] = "hotel_municipio";
  ajax_field_list[13] = "hotel_bairro";
  ajax_field_list[14] = "hotel_logradouro";
  ajax_field_list[15] = "hotel_numero";
  ajax_field_list[16] = "hotel_complemento";
  ajax_field_list[17] = "localizacao";
  ajax_field_list[18] = "hotel_observacoes";
  ajax_field_list[19] = "hotel_email";
  ajax_field_list[20] = "hotel_website";
  ajax_field_list[21] = "hotel_telefone";
  ajax_field_list[22] = "hotel_fax";
  ajax_field_list[23] = "hotel_celular";
  ajax_field_list[24] = "hotel_status";
  ajax_field_list[25] = "hotel_facebook";
  ajax_field_list[26] = "hotel_twitter";
  ajax_field_list[27] = "hotel_skype";
  ajax_field_list[28] = "hotel_ar_condicionado";
  ajax_field_list[29] = "hotel_frigobar";
  ajax_field_list[30] = "hotel_lavanderia";
  ajax_field_list[31] = "hotel_telefone_quarto";
  ajax_field_list[32] = "hotel_tv";
  ajax_field_list[33] = "hotel_ginastica";
  ajax_field_list[34] = "hotel_restaurante";
  ajax_field_list[35] = "hotel_bar";
  ajax_field_list[36] = "hotel_estacionamento";
  ajax_field_list[37] = "hotel_sauna";
  ajax_field_list[38] = "hotel_piscina";
  ajax_field_list[39] = "hotel_wifi";
  ajax_field_list[40] = "hotel_computador";
  ajax_field_list[41] = "hotel_convencoes";
  ajax_field_list[42] = "hotel_cod_estrangeiro";

  var ajax_block_list = new Array();
  ajax_block_list[0] = "0";
  ajax_block_list[1] = "1";
  ajax_block_list[2] = "2";
  ajax_block_list[3] = "3";
  ajax_block_list[4] = "4";

  var ajax_error_list = {
    "hotel_id": {"label": "Hotel Id:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_cnpj": {"label": "CNPJ:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_fantasia": {"label": "Fantasia", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_razsoc": {"label": "Razão Social:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_descricao": {"label": "Descrição:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_rede": {"label": "Rede:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_classificacao": {"label": "Classificação (tipo):", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_categoria": {"label": "Categoria:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_logo": {"label": "Logo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_cep": {"label": "CEP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_pais": {"label": "País:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_uf": {"label": "UF:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_municipio": {"label": "Município:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_bairro": {"label": "Bairro:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_logradouro": {"label": "Logradouro:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_numero": {"label": "Número:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_complemento": {"label": "Complemento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "localizacao": {"label": "Google Maps:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_observacoes": {"label": "Observações:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_email": {"label": "Email:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_website": {"label": "Website:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_telefone": {"label": "Telefone", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_fax": {"label": "Fax:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_celular": {"label": "Celular:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_status": {"label": "Status:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_facebook": {"label": "Hotel Facebook:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_twitter": {"label": "Hotel Twitter:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_skype": {"label": "Hotel Skype:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_ar_condicionado": {"label": "Ar Condicionado:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_frigobar": {"label": "Frigobar:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_lavanderia": {"label": "Lavanderia:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_telefone_quarto": {"label": "Telefone Quarto:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_tv": {"label": "TV:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_ginastica": {"label": "Sala Ginática:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_restaurante": {"label": "Restaurante:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_bar": {"label": "Bar:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_estacionamento": {"label": "Estacionamento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_sauna": {"label": "Sauna:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_piscina": {"label": "Piscina:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_wifi": {"label": "Wifi:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_computador": {"label": "Computadores:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_convencoes": {"label": "Sala Convenções:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_cod_estrangeiro": {"label": "Cód. Estrangeiro:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0}
  };
  var ajax_error_timeout = 0;

  var ajax_block_id = {
    "0": "hidden_bloco_0",
    "1": "hidden_bloco_1",
    "2": "hidden_bloco_2",
    "3": "hidden_bloco_3",
    "4": "hidden_bloco_4"
  };

  var ajax_block_tab = {
    "hidden_bloco_0": "id_tabs_0_0",
    "hidden_bloco_1": "id_tabs_0_1",
    "hidden_bloco_2": "id_tabs_0_2",
    "hidden_bloco_3": "id_tabs_0_3",
    "hidden_bloco_4": "id_tabs_0_4"
  };

  var ajax_field_mult = {
    "hotel_id": new Array(),
    "hotel_cnpj": new Array(),
    "hotel_fantasia": new Array(),
    "hotel_razsoc": new Array(),
    "hotel_descricao": new Array(),
    "hotel_rede": new Array(),
    "hotel_classificacao": new Array(),
    "hotel_categoria": new Array(),
    "hotel_logo": new Array(),
    "hotel_cep": new Array(),
    "hotel_pais": new Array(),
    "hotel_uf": new Array(),
    "hotel_municipio": new Array(),
    "hotel_bairro": new Array(),
    "hotel_logradouro": new Array(),
    "hotel_numero": new Array(),
    "hotel_complemento": new Array(),
    "localizacao": new Array(),
    "hotel_observacoes": new Array(),
    "hotel_email": new Array(),
    "hotel_website": new Array(),
    "hotel_telefone": new Array(),
    "hotel_fax": new Array(),
    "hotel_celular": new Array(),
    "hotel_status": new Array(),
    "hotel_facebook": new Array(),
    "hotel_twitter": new Array(),
    "hotel_skype": new Array(),
    "hotel_ar_condicionado": new Array(),
    "hotel_frigobar": new Array(),
    "hotel_lavanderia": new Array(),
    "hotel_telefone_quarto": new Array(),
    "hotel_tv": new Array(),
    "hotel_ginastica": new Array(),
    "hotel_restaurante": new Array(),
    "hotel_bar": new Array(),
    "hotel_estacionamento": new Array(),
    "hotel_sauna": new Array(),
    "hotel_piscina": new Array(),
    "hotel_wifi": new Array(),
    "hotel_computador": new Array(),
    "hotel_convencoes": new Array(),
    "hotel_cod_estrangeiro": new Array()
  };
  ajax_field_mult["hotel_id"][1] = "hotel_id";
  ajax_field_mult["hotel_cnpj"][1] = "hotel_cnpj";
  ajax_field_mult["hotel_fantasia"][1] = "hotel_fantasia";
  ajax_field_mult["hotel_razsoc"][1] = "hotel_razsoc";
  ajax_field_mult["hotel_descricao"][1] = "hotel_descricao";
  ajax_field_mult["hotel_rede"][1] = "hotel_rede";
  ajax_field_mult["hotel_classificacao"][1] = "hotel_classificacao";
  ajax_field_mult["hotel_categoria"][1] = "hotel_categoria";
  ajax_field_mult["hotel_logo"][1] = "hotel_logo";
  ajax_field_mult["hotel_cep"][1] = "hotel_cep";
  ajax_field_mult["hotel_pais"][1] = "hotel_pais";
  ajax_field_mult["hotel_uf"][1] = "hotel_uf";
  ajax_field_mult["hotel_municipio"][1] = "hotel_municipio";
  ajax_field_mult["hotel_bairro"][1] = "hotel_bairro";
  ajax_field_mult["hotel_logradouro"][1] = "hotel_logradouro";
  ajax_field_mult["hotel_numero"][1] = "hotel_numero";
  ajax_field_mult["hotel_complemento"][1] = "hotel_complemento";
  ajax_field_mult["localizacao"][1] = "localizacao";
  ajax_field_mult["hotel_observacoes"][1] = "hotel_observacoes";
  ajax_field_mult["hotel_email"][1] = "hotel_email";
  ajax_field_mult["hotel_website"][1] = "hotel_website";
  ajax_field_mult["hotel_telefone"][1] = "hotel_telefone";
  ajax_field_mult["hotel_fax"][1] = "hotel_fax";
  ajax_field_mult["hotel_celular"][1] = "hotel_celular";
  ajax_field_mult["hotel_status"][1] = "hotel_status";
  ajax_field_mult["hotel_facebook"][1] = "hotel_facebook";
  ajax_field_mult["hotel_twitter"][1] = "hotel_twitter";
  ajax_field_mult["hotel_skype"][1] = "hotel_skype";
  ajax_field_mult["hotel_ar_condicionado"][1] = "hotel_ar_condicionado";
  ajax_field_mult["hotel_frigobar"][1] = "hotel_frigobar";
  ajax_field_mult["hotel_lavanderia"][1] = "hotel_lavanderia";
  ajax_field_mult["hotel_telefone_quarto"][1] = "hotel_telefone_quarto";
  ajax_field_mult["hotel_tv"][1] = "hotel_tv";
  ajax_field_mult["hotel_ginastica"][1] = "hotel_ginastica";
  ajax_field_mult["hotel_restaurante"][1] = "hotel_restaurante";
  ajax_field_mult["hotel_bar"][1] = "hotel_bar";
  ajax_field_mult["hotel_estacionamento"][1] = "hotel_estacionamento";
  ajax_field_mult["hotel_sauna"][1] = "hotel_sauna";
  ajax_field_mult["hotel_piscina"][1] = "hotel_piscina";
  ajax_field_mult["hotel_wifi"][1] = "hotel_wifi";
  ajax_field_mult["hotel_computador"][1] = "hotel_computador";
  ajax_field_mult["hotel_convencoes"][1] = "hotel_convencoes";
  ajax_field_mult["hotel_cod_estrangeiro"][1] = "hotel_cod_estrangeiro";

  var ajax_field_id = {
    "hotel_cnpj": new Array("hidden_field_label_hotel_cnpj", "hidden_field_data_hotel_cnpj"),
    "hotel_fantasia": new Array("hidden_field_label_hotel_fantasia", "hidden_field_data_hotel_fantasia"),
    "hotel_razsoc": new Array("hidden_field_label_hotel_razsoc", "hidden_field_data_hotel_razsoc"),
    "hotel_descricao": new Array("hidden_field_label_hotel_descricao", "hidden_field_data_hotel_descricao"),
    "hotel_rede": new Array("hidden_field_label_hotel_rede", "hidden_field_data_hotel_rede"),
    "hotel_classificacao": new Array("hidden_field_label_hotel_classificacao", "hidden_field_data_hotel_classificacao"),
    "hotel_categoria": new Array("hidden_field_label_hotel_categoria", "hidden_field_data_hotel_categoria"),
    "hotel_logo": new Array("hidden_field_label_hotel_logo", "hidden_field_data_hotel_logo"),
    "hotel_cep": new Array("hidden_field_label_hotel_cep", "hidden_field_data_hotel_cep"),
    "hotel_pais": new Array("hidden_field_label_hotel_pais", "hidden_field_data_hotel_pais"),
    "hotel_uf": new Array("hidden_field_label_hotel_uf", "hidden_field_data_hotel_uf"),
    "hotel_municipio": new Array("hidden_field_label_hotel_municipio", "hidden_field_data_hotel_municipio"),
    "hotel_bairro": new Array("hidden_field_label_hotel_bairro", "hidden_field_data_hotel_bairro"),
    "hotel_logradouro": new Array("hidden_field_label_hotel_logradouro", "hidden_field_data_hotel_logradouro"),
    "hotel_numero": new Array("hidden_field_label_hotel_numero", "hidden_field_data_hotel_numero"),
    "hotel_complemento": new Array("hidden_field_label_hotel_complemento", "hidden_field_data_hotel_complemento"),
    "localizacao": new Array("hidden_field_label_localizacao", "hidden_field_data_localizacao"),
    "hotel_observacoes": new Array("hidden_field_label_hotel_observacoes", "hidden_field_data_hotel_observacoes"),
    "hotel_email": new Array("hidden_field_label_hotel_email", "hidden_field_data_hotel_email"),
    "hotel_website": new Array("hidden_field_label_hotel_website", "hidden_field_data_hotel_website"),
    "hotel_telefone": new Array("hidden_field_label_hotel_telefone", "hidden_field_data_hotel_telefone"),
    "hotel_fax": new Array("hidden_field_label_hotel_fax", "hidden_field_data_hotel_fax"),
    "hotel_celular": new Array("hidden_field_label_hotel_celular", "hidden_field_data_hotel_celular"),
    "hotel_status": new Array("hidden_field_label_hotel_status", "hidden_field_data_hotel_status"),
    "hotel_ar_condicionado": new Array("hidden_field_label_hotel_ar_condicionado", "hidden_field_data_hotel_ar_condicionado"),
    "hotel_frigobar": new Array("hidden_field_label_hotel_frigobar", "hidden_field_data_hotel_frigobar"),
    "hotel_lavanderia": new Array("hidden_field_label_hotel_lavanderia", "hidden_field_data_hotel_lavanderia"),
    "hotel_telefone_quarto": new Array("hidden_field_label_hotel_telefone_quarto", "hidden_field_data_hotel_telefone_quarto"),
    "hotel_tv": new Array("hidden_field_label_hotel_tv", "hidden_field_data_hotel_tv"),
    "hotel_ginastica": new Array("hidden_field_label_hotel_ginastica", "hidden_field_data_hotel_ginastica"),
    "hotel_restaurante": new Array("hidden_field_label_hotel_restaurante", "hidden_field_data_hotel_restaurante"),
    "hotel_bar": new Array("hidden_field_label_hotel_bar", "hidden_field_data_hotel_bar"),
    "hotel_estacionamento": new Array("hidden_field_label_hotel_estacionamento", "hidden_field_data_hotel_estacionamento"),
    "hotel_sauna": new Array("hidden_field_label_hotel_sauna", "hidden_field_data_hotel_sauna"),
    "hotel_piscina": new Array("hidden_field_label_hotel_piscina", "hidden_field_data_hotel_piscina"),
    "hotel_wifi": new Array("hidden_field_label_hotel_wifi", "hidden_field_data_hotel_wifi"),
    "hotel_computador": new Array("hidden_field_label_hotel_computador", "hidden_field_data_hotel_computador"),
    "hotel_convencoes": new Array("hidden_field_label_hotel_convencoes", "hidden_field_data_hotel_convencoes"),
    "hotel_cod_estrangeiro": new Array("hidden_field_label_hotel_cod_estrangeiro", "hidden_field_data_hotel_cod_estrangeiro")
  };

  var ajax_read_only = {
    "hotel_id": "on",
    "hotel_cnpj": "off",
    "hotel_fantasia": "off",
    "hotel_razsoc": "off",
    "hotel_descricao": "off",
    "hotel_rede": "off",
    "hotel_classificacao": "off",
    "hotel_categoria": "off",
    "hotel_logo": "off",
    "hotel_cep": "off",
    "hotel_pais": "off",
    "hotel_uf": "off",
    "hotel_municipio": "off",
    "hotel_bairro": "off",
    "hotel_logradouro": "off",
    "hotel_numero": "off",
    "hotel_complemento": "off",
    "localizacao": "off",
    "hotel_observacoes": "off",
    "hotel_email": "off",
    "hotel_website": "off",
    "hotel_telefone": "off",
    "hotel_fax": "off",
    "hotel_celular": "off",
    "hotel_status": "off",
    "hotel_facebook": "off",
    "hotel_twitter": "off",
    "hotel_skype": "off",
    "hotel_ar_condicionado": "off",
    "hotel_frigobar": "off",
    "hotel_lavanderia": "off",
    "hotel_telefone_quarto": "off",
    "hotel_tv": "off",
    "hotel_ginastica": "off",
    "hotel_restaurante": "off",
    "hotel_bar": "off",
    "hotel_estacionamento": "off",
    "hotel_sauna": "off",
    "hotel_piscina": "off",
    "hotel_wifi": "off",
    "hotel_computador": "off",
    "hotel_convencoes": "off",
    "hotel_cod_estrangeiro": "off"
  };
  var bRefreshTable = false;
  function scRefreshTable()
  {
    return false;
  }

  function scAjaxDetailValue(sIndex, sValue)
  {
    var aValue = new Array();
    aValue[0] = {"value" : sValue};
    if ("hotel_id" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_cnpj" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_fantasia" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_razsoc" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_descricao" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_rede" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_classificacao" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_categoria" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_logo" == sIndex)
    {
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_cep" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_pais" == sIndex)
    {
      scAjaxSetFieldSelect(sIndex, aValue, null);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_uf" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_municipio" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_bairro" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_logradouro" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_numero" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_complemento" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("localizacao" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_observacoes" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_email" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_website" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_telefone" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_fax" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_celular" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_status" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_facebook" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_twitter" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_skype" == sIndex)
    {
      scAjaxSetFieldText(sIndex, aValue, "", "", true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_ar_condicionado" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_frigobar" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_lavanderia" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_telefone_quarto" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_tv" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_ginastica" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_restaurante" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_bar" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_estacionamento" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_sauna" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_piscina" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_wifi" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_computador" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_convencoes" == sIndex)
    {
      scAjaxSetFieldRadio(sIndex, aValue, null, 1, null, "", false, true);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    if ("hotel_cod_estrangeiro" == sIndex)
    {
      scAjaxSetFieldLabel(sIndex, aValue);
      updateHeaderFooter(sIndex, aValue);

      if ($("#id_sc_field_" + sIndex).length) {
          $("#id_sc_field_" + sIndex).change();
      }
      else if (document.F1.elements[sIndex]) {
          $(document.F1.elements[sIndex]).change();
      }
      else if (document.F1.elements[sFieldName + "[]"]) {
          $(document.F1.elements[sFieldName + "[]"]).change();
      }

      return;
    }
    scAjaxSetFieldInnerHtml(sIndex, aValue);
  }
 </SCRIPT>
