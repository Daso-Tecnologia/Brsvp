
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
        if ("geral_form_transfer_rsvp" == sTestField)
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
        sc_hide_form_transfer_rsvp_form();
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

  // ---------- Validate tra_id_evento
  function do_ajax_form_transfer_rsvp_validate_tra_id_evento()
  {
    var nomeCampo_tra_id_evento = "tra_id_evento";
    var var_tra_id_evento = scAjaxGetFieldHidden(nomeCampo_tra_id_evento);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_id_evento(var_tra_id_evento, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_id_evento_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_id_evento

  function do_ajax_form_transfer_rsvp_validate_tra_id_evento_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_id_evento";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_id_evento_cb

  // ---------- Validate evento_dsc
  function do_ajax_form_transfer_rsvp_validate_evento_dsc()
  {
    var nomeCampo_evento_dsc = "evento_dsc";
    var var_evento_dsc = scAjaxGetFieldHidden(nomeCampo_evento_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_evento_dsc(var_evento_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_evento_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_evento_dsc

  function do_ajax_form_transfer_rsvp_validate_evento_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_evento_dsc_cb

  // ---------- Validate tra_cpf_particip
  function do_ajax_form_transfer_rsvp_validate_tra_cpf_particip()
  {
    var nomeCampo_tra_cpf_particip = "tra_cpf_particip";
    var var_tra_cpf_particip = scAjaxGetFieldHidden(nomeCampo_tra_cpf_particip);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_cpf_particip(var_tra_cpf_particip, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_cpf_particip_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_cpf_particip

  function do_ajax_form_transfer_rsvp_validate_tra_cpf_particip_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_cpf_particip";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_cpf_particip_cb

  // ---------- Validate tipo_dsc
  function do_ajax_form_transfer_rsvp_validate_tipo_dsc()
  {
    var nomeCampo_tipo_dsc = "tipo_dsc";
    var var_tipo_dsc = scAjaxGetFieldHidden(nomeCampo_tipo_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tipo_dsc(var_tipo_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tipo_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_tipo_dsc

  function do_ajax_form_transfer_rsvp_validate_tipo_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tipo_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_tipo_dsc_cb

  // ---------- Validate tra_id_usuario
  function do_ajax_form_transfer_rsvp_validate_tra_id_usuario()
  {
    var nomeCampo_tra_id_usuario = "tra_id_usuario";
    var var_tra_id_usuario = scAjaxGetFieldHidden(nomeCampo_tra_id_usuario);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_id_usuario(var_tra_id_usuario, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_id_usuario_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_id_usuario

  function do_ajax_form_transfer_rsvp_validate_tra_id_usuario_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_id_usuario";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_id_usuario_cb

  // ---------- Validate atendente_dsc
  function do_ajax_form_transfer_rsvp_validate_atendente_dsc()
  {
    var nomeCampo_atendente_dsc = "atendente_dsc";
    var var_atendente_dsc = scAjaxGetFieldHidden(nomeCampo_atendente_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_atendente_dsc(var_atendente_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_atendente_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_atendente_dsc

  function do_ajax_form_transfer_rsvp_validate_atendente_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "atendente_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_atendente_dsc_cb

  // ---------- Validate tra_tipo
  function do_ajax_form_transfer_rsvp_validate_tra_tipo()
  {
    var nomeCampo_tra_tipo = "tra_tipo";
    var var_tra_tipo = scAjaxGetFieldSelect(nomeCampo_tra_tipo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_tipo(var_tra_tipo, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_tipo_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_tipo

  function do_ajax_form_transfer_rsvp_validate_tra_tipo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_tipo";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_tipo_cb

  // ---------- Validate tra_id_hotel
  function do_ajax_form_transfer_rsvp_validate_tra_id_hotel()
  {
    var nomeCampo_tra_id_hotel = "tra_id_hotel";
    var var_tra_id_hotel = scAjaxGetFieldSelect(nomeCampo_tra_id_hotel);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_id_hotel(var_tra_id_hotel, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_id_hotel_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_id_hotel

  function do_ajax_form_transfer_rsvp_validate_tra_id_hotel_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_id_hotel";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_id_hotel_cb

  // ---------- Validate hotel_dsc
  function do_ajax_form_transfer_rsvp_validate_hotel_dsc()
  {
    var nomeCampo_hotel_dsc = "hotel_dsc";
    var var_hotel_dsc = scAjaxGetFieldHidden(nomeCampo_hotel_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_hotel_dsc(var_hotel_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_hotel_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_hotel_dsc

  function do_ajax_form_transfer_rsvp_validate_hotel_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_hotel_dsc_cb

  // ---------- Validate tra_id_hotel_out
  function do_ajax_form_transfer_rsvp_validate_tra_id_hotel_out()
  {
    var nomeCampo_tra_id_hotel_out = "tra_id_hotel_out";
    var var_tra_id_hotel_out = scAjaxGetFieldSelect(nomeCampo_tra_id_hotel_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_id_hotel_out(var_tra_id_hotel_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_id_hotel_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_id_hotel_out

  function do_ajax_form_transfer_rsvp_validate_tra_id_hotel_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_id_hotel_out";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_id_hotel_out_cb

  // ---------- Validate hotel_dsc_out
  function do_ajax_form_transfer_rsvp_validate_hotel_dsc_out()
  {
    var nomeCampo_hotel_dsc_out = "hotel_dsc_out";
    var var_hotel_dsc_out = scAjaxGetFieldHidden(nomeCampo_hotel_dsc_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_hotel_dsc_out(var_hotel_dsc_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_hotel_dsc_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_hotel_dsc_out

  function do_ajax_form_transfer_rsvp_validate_hotel_dsc_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hotel_dsc_out";
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
  } // do_ajax_form_transfer_rsvp_validate_hotel_dsc_out_cb

  // ---------- Validate enviar_app
  function do_ajax_form_transfer_rsvp_validate_enviar_app()
  {
    var nomeCampo_enviar_app = "enviar_app";
    var var_enviar_app = scAjaxGetFieldRadio(nomeCampo_enviar_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_enviar_app(var_enviar_app, var_script_case_init, do_ajax_form_transfer_rsvp_validate_enviar_app_cb);
  } // do_ajax_form_transfer_rsvp_validate_enviar_app

  function do_ajax_form_transfer_rsvp_validate_enviar_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "enviar_app";
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
  } // do_ajax_form_transfer_rsvp_validate_enviar_app_cb

  // ---------- Validate tra_status
  function do_ajax_form_transfer_rsvp_validate_tra_status()
  {
    var nomeCampo_tra_status = "tra_status";
    var var_tra_status = scAjaxGetFieldSelect(nomeCampo_tra_status);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_status(var_tra_status, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_status_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_status

  function do_ajax_form_transfer_rsvp_validate_tra_status_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_status";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_status_cb

  // ---------- Validate ult_trecho
  function do_ajax_form_transfer_rsvp_validate_ult_trecho()
  {
    var nomeCampo_ult_trecho = "ult_trecho";
    var var_ult_trecho = scAjaxGetFieldHidden(nomeCampo_ult_trecho);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_ult_trecho(var_ult_trecho, var_script_case_init, do_ajax_form_transfer_rsvp_validate_ult_trecho_cb);
  } // do_ajax_form_transfer_rsvp_validate_ult_trecho

  function do_ajax_form_transfer_rsvp_validate_ult_trecho_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "ult_trecho";
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
  } // do_ajax_form_transfer_rsvp_validate_ult_trecho_cb

  // ---------- Validate tra_cia_ida
  function do_ajax_form_transfer_rsvp_validate_tra_cia_ida()
  {
    var nomeCampo_tra_cia_ida = "tra_cia_ida";
    var var_tra_cia_ida = scAjaxGetFieldHidden(nomeCampo_tra_cia_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_cia_ida(var_tra_cia_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_cia_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_cia_ida

  function do_ajax_form_transfer_rsvp_validate_tra_cia_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_cia_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_cia_ida_cb

  // ---------- Validate cia_ida_dsc
  function do_ajax_form_transfer_rsvp_validate_cia_ida_dsc()
  {
    var nomeCampo_cia_ida_dsc = "cia_ida_dsc";
    var var_cia_ida_dsc = scAjaxGetFieldHidden(nomeCampo_cia_ida_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_cia_ida_dsc(var_cia_ida_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_cia_ida_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_cia_ida_dsc

  function do_ajax_form_transfer_rsvp_validate_cia_ida_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cia_ida_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_cia_ida_dsc_cb

  // ---------- Validate tra_numvoo_ida
  function do_ajax_form_transfer_rsvp_validate_tra_numvoo_ida()
  {
    var nomeCampo_tra_numvoo_ida = "tra_numvoo_ida";
    var var_tra_numvoo_ida = scAjaxGetFieldHidden(nomeCampo_tra_numvoo_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_numvoo_ida(var_tra_numvoo_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_numvoo_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_numvoo_ida

  function do_ajax_form_transfer_rsvp_validate_tra_numvoo_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_numvoo_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_numvoo_ida_cb

  // ---------- Validate tra_origem_ida
  function do_ajax_form_transfer_rsvp_validate_tra_origem_ida()
  {
    var nomeCampo_tra_origem_ida = "tra_origem_ida";
    var var_tra_origem_ida = scAjaxGetFieldHidden(nomeCampo_tra_origem_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_origem_ida(var_tra_origem_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_origem_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_origem_ida

  function do_ajax_form_transfer_rsvp_validate_tra_origem_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_origem_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_origem_ida_cb

  // ---------- Validate origem_ida_dsc
  function do_ajax_form_transfer_rsvp_validate_origem_ida_dsc()
  {
    var nomeCampo_origem_ida_dsc = "origem_ida_dsc";
    var var_origem_ida_dsc = scAjaxGetFieldHidden(nomeCampo_origem_ida_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_origem_ida_dsc(var_origem_ida_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_origem_ida_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_origem_ida_dsc

  function do_ajax_form_transfer_rsvp_validate_origem_ida_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "origem_ida_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_origem_ida_dsc_cb

  // ---------- Validate tra_destino_ida
  function do_ajax_form_transfer_rsvp_validate_tra_destino_ida()
  {
    var nomeCampo_tra_destino_ida = "tra_destino_ida";
    var var_tra_destino_ida = scAjaxGetFieldHidden(nomeCampo_tra_destino_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_destino_ida(var_tra_destino_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_destino_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_destino_ida

  function do_ajax_form_transfer_rsvp_validate_tra_destino_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_destino_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_destino_ida_cb

  // ---------- Validate destino_ida_dsc
  function do_ajax_form_transfer_rsvp_validate_destino_ida_dsc()
  {
    var nomeCampo_destino_ida_dsc = "destino_ida_dsc";
    var var_destino_ida_dsc = scAjaxGetFieldHidden(nomeCampo_destino_ida_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_destino_ida_dsc(var_destino_ida_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_destino_ida_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_destino_ida_dsc

  function do_ajax_form_transfer_rsvp_validate_destino_ida_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "destino_ida_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_destino_ida_dsc_cb

  // ---------- Validate tra_dt_saida_ida
  function do_ajax_form_transfer_rsvp_validate_tra_dt_saida_ida()
  {
    var nomeCampo_tra_dt_saida_ida = "tra_dt_saida_ida";
    var var_tra_dt_saida_ida = scAjaxGetFieldHidden(nomeCampo_tra_dt_saida_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_dt_saida_ida(var_tra_dt_saida_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_dt_saida_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_saida_ida

  function do_ajax_form_transfer_rsvp_validate_tra_dt_saida_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_dt_saida_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_saida_ida_cb

  // ---------- Validate tra_hr_saida_ida
  function do_ajax_form_transfer_rsvp_validate_tra_hr_saida_ida()
  {
    var nomeCampo_tra_hr_saida_ida = "tra_hr_saida_ida";
    var var_tra_hr_saida_ida = scAjaxGetFieldHidden(nomeCampo_tra_hr_saida_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_hr_saida_ida(var_tra_hr_saida_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_hr_saida_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_saida_ida

  function do_ajax_form_transfer_rsvp_validate_tra_hr_saida_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_hr_saida_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_saida_ida_cb

  // ---------- Validate tra_dt_chegada_ida
  function do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida()
  {
    var nomeCampo_tra_dt_chegada_ida = "tra_dt_chegada_ida";
    var var_tra_dt_chegada_ida = scAjaxGetFieldHidden(nomeCampo_tra_dt_chegada_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida(var_tra_dt_chegada_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida

  function do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_dt_chegada_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida_cb

  // ---------- Validate tra_hr_chegada_ida
  function do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida()
  {
    var nomeCampo_tra_hr_chegada_ida = "tra_hr_chegada_ida";
    var var_tra_hr_chegada_ida = scAjaxGetFieldHidden(nomeCampo_tra_hr_chegada_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida(var_tra_hr_chegada_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida

  function do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_hr_chegada_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida_cb

  // ---------- Validate tra_localizador_ida
  function do_ajax_form_transfer_rsvp_validate_tra_localizador_ida()
  {
    var nomeCampo_tra_localizador_ida = "tra_localizador_ida";
    var var_tra_localizador_ida = scAjaxGetFieldHidden(nomeCampo_tra_localizador_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_localizador_ida(var_tra_localizador_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_localizador_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_localizador_ida

  function do_ajax_form_transfer_rsvp_validate_tra_localizador_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_localizador_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_localizador_ida_cb

  // ---------- Validate tra_eticket_ida
  function do_ajax_form_transfer_rsvp_validate_tra_eticket_ida()
  {
    var nomeCampo_tra_eticket_ida = "tra_eticket_ida";
    var var_tra_eticket_ida = scAjaxGetFieldHidden(nomeCampo_tra_eticket_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_eticket_ida(var_tra_eticket_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_eticket_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_eticket_ida

  function do_ajax_form_transfer_rsvp_validate_tra_eticket_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_eticket_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_eticket_ida_cb

  // ---------- Validate tra_flag_ida
  function do_ajax_form_transfer_rsvp_validate_tra_flag_ida()
  {
    var nomeCampo_tra_flag_ida = "tra_flag_ida";
    var var_tra_flag_ida = scAjaxGetFieldSelect(nomeCampo_tra_flag_ida);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_flag_ida(var_tra_flag_ida, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_flag_ida_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_ida

  function do_ajax_form_transfer_rsvp_validate_tra_flag_ida_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_flag_ida";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_ida_cb

  // ---------- Validate tra_cia_volta
  function do_ajax_form_transfer_rsvp_validate_tra_cia_volta()
  {
    var nomeCampo_tra_cia_volta = "tra_cia_volta";
    var var_tra_cia_volta = scAjaxGetFieldHidden(nomeCampo_tra_cia_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_cia_volta(var_tra_cia_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_cia_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_cia_volta

  function do_ajax_form_transfer_rsvp_validate_tra_cia_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_cia_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_cia_volta_cb

  // ---------- Validate cia_volta_dsc
  function do_ajax_form_transfer_rsvp_validate_cia_volta_dsc()
  {
    var nomeCampo_cia_volta_dsc = "cia_volta_dsc";
    var var_cia_volta_dsc = scAjaxGetFieldHidden(nomeCampo_cia_volta_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_cia_volta_dsc(var_cia_volta_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_cia_volta_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_cia_volta_dsc

  function do_ajax_form_transfer_rsvp_validate_cia_volta_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cia_volta_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_cia_volta_dsc_cb

  // ---------- Validate tra_numvoo_volta
  function do_ajax_form_transfer_rsvp_validate_tra_numvoo_volta()
  {
    var nomeCampo_tra_numvoo_volta = "tra_numvoo_volta";
    var var_tra_numvoo_volta = scAjaxGetFieldHidden(nomeCampo_tra_numvoo_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_numvoo_volta(var_tra_numvoo_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_numvoo_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_numvoo_volta

  function do_ajax_form_transfer_rsvp_validate_tra_numvoo_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_numvoo_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_numvoo_volta_cb

  // ---------- Validate tra_origem_volta
  function do_ajax_form_transfer_rsvp_validate_tra_origem_volta()
  {
    var nomeCampo_tra_origem_volta = "tra_origem_volta";
    var var_tra_origem_volta = scAjaxGetFieldHidden(nomeCampo_tra_origem_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_origem_volta(var_tra_origem_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_origem_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_origem_volta

  function do_ajax_form_transfer_rsvp_validate_tra_origem_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_origem_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_origem_volta_cb

  // ---------- Validate origem_volta_dsc
  function do_ajax_form_transfer_rsvp_validate_origem_volta_dsc()
  {
    var nomeCampo_origem_volta_dsc = "origem_volta_dsc";
    var var_origem_volta_dsc = scAjaxGetFieldHidden(nomeCampo_origem_volta_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_origem_volta_dsc(var_origem_volta_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_origem_volta_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_origem_volta_dsc

  function do_ajax_form_transfer_rsvp_validate_origem_volta_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "origem_volta_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_origem_volta_dsc_cb

  // ---------- Validate tra_destino_volta
  function do_ajax_form_transfer_rsvp_validate_tra_destino_volta()
  {
    var nomeCampo_tra_destino_volta = "tra_destino_volta";
    var var_tra_destino_volta = scAjaxGetFieldHidden(nomeCampo_tra_destino_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_destino_volta(var_tra_destino_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_destino_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_destino_volta

  function do_ajax_form_transfer_rsvp_validate_tra_destino_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_destino_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_destino_volta_cb

  // ---------- Validate destino_volta_dsc
  function do_ajax_form_transfer_rsvp_validate_destino_volta_dsc()
  {
    var nomeCampo_destino_volta_dsc = "destino_volta_dsc";
    var var_destino_volta_dsc = scAjaxGetFieldHidden(nomeCampo_destino_volta_dsc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_destino_volta_dsc(var_destino_volta_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_validate_destino_volta_dsc_cb);
  } // do_ajax_form_transfer_rsvp_validate_destino_volta_dsc

  function do_ajax_form_transfer_rsvp_validate_destino_volta_dsc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "destino_volta_dsc";
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
  } // do_ajax_form_transfer_rsvp_validate_destino_volta_dsc_cb

  // ---------- Validate tra_dt_saida_volta
  function do_ajax_form_transfer_rsvp_validate_tra_dt_saida_volta()
  {
    var nomeCampo_tra_dt_saida_volta = "tra_dt_saida_volta";
    var var_tra_dt_saida_volta = scAjaxGetFieldHidden(nomeCampo_tra_dt_saida_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_dt_saida_volta(var_tra_dt_saida_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_dt_saida_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_saida_volta

  function do_ajax_form_transfer_rsvp_validate_tra_dt_saida_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_dt_saida_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_saida_volta_cb

  // ---------- Validate tra_hr_saida_volta
  function do_ajax_form_transfer_rsvp_validate_tra_hr_saida_volta()
  {
    var nomeCampo_tra_hr_saida_volta = "tra_hr_saida_volta";
    var var_tra_hr_saida_volta = scAjaxGetFieldHidden(nomeCampo_tra_hr_saida_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_hr_saida_volta(var_tra_hr_saida_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_hr_saida_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_saida_volta

  function do_ajax_form_transfer_rsvp_validate_tra_hr_saida_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_hr_saida_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_saida_volta_cb

  // ---------- Validate tra_dt_chegada_volta
  function do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta()
  {
    var nomeCampo_tra_dt_chegada_volta = "tra_dt_chegada_volta";
    var var_tra_dt_chegada_volta = scAjaxGetFieldHidden(nomeCampo_tra_dt_chegada_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta(var_tra_dt_chegada_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta

  function do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_dt_chegada_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta_cb

  // ---------- Validate tra_hr_chegada_volta
  function do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta()
  {
    var nomeCampo_tra_hr_chegada_volta = "tra_hr_chegada_volta";
    var var_tra_hr_chegada_volta = scAjaxGetFieldHidden(nomeCampo_tra_hr_chegada_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta(var_tra_hr_chegada_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta

  function do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_hr_chegada_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta_cb

  // ---------- Validate tra_localizador_volta
  function do_ajax_form_transfer_rsvp_validate_tra_localizador_volta()
  {
    var nomeCampo_tra_localizador_volta = "tra_localizador_volta";
    var var_tra_localizador_volta = scAjaxGetFieldHidden(nomeCampo_tra_localizador_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_localizador_volta(var_tra_localizador_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_localizador_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_localizador_volta

  function do_ajax_form_transfer_rsvp_validate_tra_localizador_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_localizador_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_localizador_volta_cb

  // ---------- Validate tra_eticket_volta
  function do_ajax_form_transfer_rsvp_validate_tra_eticket_volta()
  {
    var nomeCampo_tra_eticket_volta = "tra_eticket_volta";
    var var_tra_eticket_volta = scAjaxGetFieldHidden(nomeCampo_tra_eticket_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_eticket_volta(var_tra_eticket_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_eticket_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_eticket_volta

  function do_ajax_form_transfer_rsvp_validate_tra_eticket_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_eticket_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_eticket_volta_cb

  // ---------- Validate tra_intervalo
  function do_ajax_form_transfer_rsvp_validate_tra_intervalo()
  {
    var nomeCampo_tra_intervalo = "tra_intervalo";
    var var_tra_intervalo = scAjaxGetFieldSelect(nomeCampo_tra_intervalo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_intervalo(var_tra_intervalo, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_intervalo_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_intervalo

  function do_ajax_form_transfer_rsvp_validate_tra_intervalo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_intervalo";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_intervalo_cb

  // ---------- Validate tra_hrtransout
  function do_ajax_form_transfer_rsvp_validate_tra_hrtransout()
  {
    var nomeCampo_tra_hrtransout = "tra_hrtransout";
    var var_tra_hrtransout = scAjaxGetFieldText(nomeCampo_tra_hrtransout);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_hrtransout(var_tra_hrtransout, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_hrtransout_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_hrtransout

  function do_ajax_form_transfer_rsvp_validate_tra_hrtransout_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_hrtransout";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_hrtransout_cb

  // ---------- Validate tra_flag_volta
  function do_ajax_form_transfer_rsvp_validate_tra_flag_volta()
  {
    var nomeCampo_tra_flag_volta = "tra_flag_volta";
    var var_tra_flag_volta = scAjaxGetFieldSelect(nomeCampo_tra_flag_volta);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_flag_volta(var_tra_flag_volta, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_flag_volta_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_volta

  function do_ajax_form_transfer_rsvp_validate_tra_flag_volta_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_flag_volta";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_volta_cb

  // ---------- Validate tra_dt_chegada_proprio
  function do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio()
  {
    var nomeCampo_tra_dt_chegada_proprio = "tra_dt_chegada_proprio";
    var var_tra_dt_chegada_proprio = scAjaxGetFieldText(nomeCampo_tra_dt_chegada_proprio);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio(var_tra_dt_chegada_proprio, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio

  function do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_dt_chegada_proprio";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio_cb

  // ---------- Validate tra_hr_chegada_proprio
  function do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio()
  {
    var nomeCampo_tra_hr_chegada_proprio = "tra_hr_chegada_proprio";
    var var_tra_hr_chegada_proprio = scAjaxGetFieldText(nomeCampo_tra_hr_chegada_proprio);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio(var_tra_hr_chegada_proprio, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio

  function do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_hr_chegada_proprio";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio_cb

  // ---------- Validate tra_flag_proprio
  function do_ajax_form_transfer_rsvp_validate_tra_flag_proprio()
  {
    var nomeCampo_tra_flag_proprio = "tra_flag_proprio";
    var var_tra_flag_proprio = scAjaxGetFieldSelect(nomeCampo_tra_flag_proprio);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_flag_proprio(var_tra_flag_proprio, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_flag_proprio_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_proprio

  function do_ajax_form_transfer_rsvp_validate_tra_flag_proprio_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_flag_proprio";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_proprio_cb

  // ---------- Validate tra_dt_ida_local
  function do_ajax_form_transfer_rsvp_validate_tra_dt_ida_local()
  {
    var nomeCampo_tra_dt_ida_local = "tra_dt_ida_local";
    var var_tra_dt_ida_local = scAjaxGetFieldText(nomeCampo_tra_dt_ida_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_dt_ida_local(var_tra_dt_ida_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_dt_ida_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_ida_local

  function do_ajax_form_transfer_rsvp_validate_tra_dt_ida_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_dt_ida_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_ida_local_cb

  // ---------- Validate tra_hr_ida_local
  function do_ajax_form_transfer_rsvp_validate_tra_hr_ida_local()
  {
    var nomeCampo_tra_hr_ida_local = "tra_hr_ida_local";
    var var_tra_hr_ida_local = scAjaxGetFieldText(nomeCampo_tra_hr_ida_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_hr_ida_local(var_tra_hr_ida_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_hr_ida_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_ida_local

  function do_ajax_form_transfer_rsvp_validate_tra_hr_ida_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_hr_ida_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_ida_local_cb

  // ---------- Validate tra_origem_ida_local
  function do_ajax_form_transfer_rsvp_validate_tra_origem_ida_local()
  {
    var nomeCampo_tra_origem_ida_local = "tra_origem_ida_local";
    var var_tra_origem_ida_local = scAjaxGetFieldText(nomeCampo_tra_origem_ida_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_origem_ida_local(var_tra_origem_ida_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_origem_ida_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_origem_ida_local

  function do_ajax_form_transfer_rsvp_validate_tra_origem_ida_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_origem_ida_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_origem_ida_local_cb

  // ---------- Validate tra_destino_ida_local
  function do_ajax_form_transfer_rsvp_validate_tra_destino_ida_local()
  {
    var nomeCampo_tra_destino_ida_local = "tra_destino_ida_local";
    var var_tra_destino_ida_local = scAjaxGetFieldText(nomeCampo_tra_destino_ida_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_destino_ida_local(var_tra_destino_ida_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_destino_ida_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_destino_ida_local

  function do_ajax_form_transfer_rsvp_validate_tra_destino_ida_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_destino_ida_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_destino_ida_local_cb

  // ---------- Validate tra_flag_ida_local
  function do_ajax_form_transfer_rsvp_validate_tra_flag_ida_local()
  {
    var nomeCampo_tra_flag_ida_local = "tra_flag_ida_local";
    var var_tra_flag_ida_local = scAjaxGetFieldSelect(nomeCampo_tra_flag_ida_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_flag_ida_local(var_tra_flag_ida_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_flag_ida_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_ida_local

  function do_ajax_form_transfer_rsvp_validate_tra_flag_ida_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_flag_ida_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_ida_local_cb

  // ---------- Validate tra_dt_volta_local
  function do_ajax_form_transfer_rsvp_validate_tra_dt_volta_local()
  {
    var nomeCampo_tra_dt_volta_local = "tra_dt_volta_local";
    var var_tra_dt_volta_local = scAjaxGetFieldText(nomeCampo_tra_dt_volta_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_dt_volta_local(var_tra_dt_volta_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_dt_volta_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_volta_local

  function do_ajax_form_transfer_rsvp_validate_tra_dt_volta_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_dt_volta_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_volta_local_cb

  // ---------- Validate tra_hr_volta_local
  function do_ajax_form_transfer_rsvp_validate_tra_hr_volta_local()
  {
    var nomeCampo_tra_hr_volta_local = "tra_hr_volta_local";
    var var_tra_hr_volta_local = scAjaxGetFieldText(nomeCampo_tra_hr_volta_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_hr_volta_local(var_tra_hr_volta_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_hr_volta_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_volta_local

  function do_ajax_form_transfer_rsvp_validate_tra_hr_volta_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_hr_volta_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_hr_volta_local_cb

  // ---------- Validate tra_origem_volta_local
  function do_ajax_form_transfer_rsvp_validate_tra_origem_volta_local()
  {
    var nomeCampo_tra_origem_volta_local = "tra_origem_volta_local";
    var var_tra_origem_volta_local = scAjaxGetFieldText(nomeCampo_tra_origem_volta_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_origem_volta_local(var_tra_origem_volta_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_origem_volta_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_origem_volta_local

  function do_ajax_form_transfer_rsvp_validate_tra_origem_volta_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_origem_volta_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_origem_volta_local_cb

  // ---------- Validate tra_destino_volta_local
  function do_ajax_form_transfer_rsvp_validate_tra_destino_volta_local()
  {
    var nomeCampo_tra_destino_volta_local = "tra_destino_volta_local";
    var var_tra_destino_volta_local = scAjaxGetFieldText(nomeCampo_tra_destino_volta_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_destino_volta_local(var_tra_destino_volta_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_destino_volta_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_destino_volta_local

  function do_ajax_form_transfer_rsvp_validate_tra_destino_volta_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_destino_volta_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_destino_volta_local_cb

  // ---------- Validate tra_flag_volta_local
  function do_ajax_form_transfer_rsvp_validate_tra_flag_volta_local()
  {
    var nomeCampo_tra_flag_volta_local = "tra_flag_volta_local";
    var var_tra_flag_volta_local = scAjaxGetFieldSelect(nomeCampo_tra_flag_volta_local);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_flag_volta_local(var_tra_flag_volta_local, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_flag_volta_local_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_volta_local

  function do_ajax_form_transfer_rsvp_validate_tra_flag_volta_local_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_flag_volta_local";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_flag_volta_local_cb

  // ---------- Validate tra_observacao
  function do_ajax_form_transfer_rsvp_validate_tra_observacao()
  {
    var nomeCampo_tra_observacao = "tra_observacao";
    var var_tra_observacao = scAjaxGetFieldText(nomeCampo_tra_observacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_observacao(var_tra_observacao, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_observacao_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_observacao

  function do_ajax_form_transfer_rsvp_validate_tra_observacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_observacao";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_observacao_cb

  // ---------- Validate tra_ativo
  function do_ajax_form_transfer_rsvp_validate_tra_ativo()
  {
    var nomeCampo_tra_ativo = "tra_ativo";
    var var_tra_ativo = scAjaxGetFieldSelect(nomeCampo_tra_ativo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_ativo(var_tra_ativo, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_ativo_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_ativo

  function do_ajax_form_transfer_rsvp_validate_tra_ativo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_ativo";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_ativo_cb

  // ---------- Validate tra_dt_alteracao
  function do_ajax_form_transfer_rsvp_validate_tra_dt_alteracao()
  {
    var nomeCampo_tra_dt_alteracao = "tra_dt_alteracao";
    var var_tra_dt_alteracao = scAjaxGetFieldHidden(nomeCampo_tra_dt_alteracao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tra_dt_alteracao(var_tra_dt_alteracao, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tra_dt_alteracao_cb);
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_alteracao

  function do_ajax_form_transfer_rsvp_validate_tra_dt_alteracao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tra_dt_alteracao";
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
  } // do_ajax_form_transfer_rsvp_validate_tra_dt_alteracao_cb

  // ---------- Validate cpf_del
  function do_ajax_form_transfer_rsvp_validate_cpf_del()
  {
    var nomeCampo_cpf_del = "cpf_del";
    var var_cpf_del = scAjaxGetFieldHidden(nomeCampo_cpf_del);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_cpf_del(var_cpf_del, var_script_case_init, do_ajax_form_transfer_rsvp_validate_cpf_del_cb);
  } // do_ajax_form_transfer_rsvp_validate_cpf_del

  function do_ajax_form_transfer_rsvp_validate_cpf_del_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cpf_del";
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
  } // do_ajax_form_transfer_rsvp_validate_cpf_del_cb

  // ---------- Validate sql_log
  function do_ajax_form_transfer_rsvp_validate_sql_log()
  {
    var nomeCampo_sql_log = "sql_log";
    var var_sql_log = scAjaxGetFieldHidden(nomeCampo_sql_log);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_sql_log(var_sql_log, var_script_case_init, do_ajax_form_transfer_rsvp_validate_sql_log_cb);
  } // do_ajax_form_transfer_rsvp_validate_sql_log

  function do_ajax_form_transfer_rsvp_validate_sql_log_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "sql_log";
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
  } // do_ajax_form_transfer_rsvp_validate_sql_log_cb

  // ---------- Validate titulo_api
  function do_ajax_form_transfer_rsvp_validate_titulo_api()
  {
    var nomeCampo_titulo_api = "titulo_api";
    var var_titulo_api = scAjaxGetFieldText(nomeCampo_titulo_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_titulo_api(var_titulo_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_titulo_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_titulo_api

  function do_ajax_form_transfer_rsvp_validate_titulo_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "titulo_api";
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
  } // do_ajax_form_transfer_rsvp_validate_titulo_api_cb

  // ---------- Validate descricao_api
  function do_ajax_form_transfer_rsvp_validate_descricao_api()
  {
    var nomeCampo_descricao_api = "descricao_api";
    var var_descricao_api = scAjaxGetFieldText(nomeCampo_descricao_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_descricao_api(var_descricao_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_descricao_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_descricao_api

  function do_ajax_form_transfer_rsvp_validate_descricao_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "descricao_api";
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
  } // do_ajax_form_transfer_rsvp_validate_descricao_api_cb

  // ---------- Validate codigo_api
  function do_ajax_form_transfer_rsvp_validate_codigo_api()
  {
    var nomeCampo_codigo_api = "codigo_api";
    var var_codigo_api = scAjaxGetFieldText(nomeCampo_codigo_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_codigo_api(var_codigo_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_codigo_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_codigo_api

  function do_ajax_form_transfer_rsvp_validate_codigo_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "codigo_api";
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
  } // do_ajax_form_transfer_rsvp_validate_codigo_api_cb

  // ---------- Validate tipo_api
  function do_ajax_form_transfer_rsvp_validate_tipo_api()
  {
    var nomeCampo_tipo_api = "tipo_api";
    var var_tipo_api = scAjaxGetFieldHidden(nomeCampo_tipo_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tipo_api(var_tipo_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tipo_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_tipo_api

  function do_ajax_form_transfer_rsvp_validate_tipo_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tipo_api";
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
  } // do_ajax_form_transfer_rsvp_validate_tipo_api_cb

  // ---------- Validate status_api
  function do_ajax_form_transfer_rsvp_validate_status_api()
  {
    var nomeCampo_status_api = "status_api";
    var var_status_api = scAjaxGetFieldHidden(nomeCampo_status_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_status_api(var_status_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_status_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_status_api

  function do_ajax_form_transfer_rsvp_validate_status_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "status_api";
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
  } // do_ajax_form_transfer_rsvp_validate_status_api_cb

  // ---------- Validate valido_de_api
  function do_ajax_form_transfer_rsvp_validate_valido_de_api()
  {
    var nomeCampo_valido_de_api = "valido_de_api";
    var var_valido_de_api = scAjaxGetFieldText(nomeCampo_valido_de_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_valido_de_api(var_valido_de_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_valido_de_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_valido_de_api

  function do_ajax_form_transfer_rsvp_validate_valido_de_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "valido_de_api";
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
  } // do_ajax_form_transfer_rsvp_validate_valido_de_api_cb

  // ---------- Validate valido_ate_api
  function do_ajax_form_transfer_rsvp_validate_valido_ate_api()
  {
    var nomeCampo_valido_ate_api = "valido_ate_api";
    var var_valido_ate_api = scAjaxGetFieldText(nomeCampo_valido_ate_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_valido_ate_api(var_valido_ate_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_valido_ate_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_valido_ate_api

  function do_ajax_form_transfer_rsvp_validate_valido_ate_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "valido_ate_api";
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
  } // do_ajax_form_transfer_rsvp_validate_valido_ate_api_cb

  // ---------- Validate local_de_origem_api
  function do_ajax_form_transfer_rsvp_validate_local_de_origem_api()
  {
    var nomeCampo_local_de_origem_api = "local_de_origem_api";
    var var_local_de_origem_api = scAjaxGetFieldText(nomeCampo_local_de_origem_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_local_de_origem_api(var_local_de_origem_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_local_de_origem_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_local_de_origem_api

  function do_ajax_form_transfer_rsvp_validate_local_de_origem_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "local_de_origem_api";
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
  } // do_ajax_form_transfer_rsvp_validate_local_de_origem_api_cb

  // ---------- Validate latitude_origem_api
  function do_ajax_form_transfer_rsvp_validate_latitude_origem_api()
  {
    var nomeCampo_latitude_origem_api = "latitude_origem_api";
    var var_latitude_origem_api = scAjaxGetFieldText(nomeCampo_latitude_origem_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_latitude_origem_api(var_latitude_origem_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_latitude_origem_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_latitude_origem_api

  function do_ajax_form_transfer_rsvp_validate_latitude_origem_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "latitude_origem_api";
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
  } // do_ajax_form_transfer_rsvp_validate_latitude_origem_api_cb

  // ---------- Validate longitude_origem_api
  function do_ajax_form_transfer_rsvp_validate_longitude_origem_api()
  {
    var nomeCampo_longitude_origem_api = "longitude_origem_api";
    var var_longitude_origem_api = scAjaxGetFieldText(nomeCampo_longitude_origem_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_longitude_origem_api(var_longitude_origem_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_longitude_origem_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_longitude_origem_api

  function do_ajax_form_transfer_rsvp_validate_longitude_origem_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "longitude_origem_api";
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
  } // do_ajax_form_transfer_rsvp_validate_longitude_origem_api_cb

  // ---------- Validate hr_saida_origem_api
  function do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api()
  {
    var nomeCampo_hr_saida_origem_api = "hr_saida_origem_api";
    var var_hr_saida_origem_api = scAjaxGetFieldText(nomeCampo_hr_saida_origem_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_hr_saida_origem_api(var_hr_saida_origem_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api

  function do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hr_saida_origem_api";
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
  } // do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_cb

  // ---------- Validate local_destino_api
  function do_ajax_form_transfer_rsvp_validate_local_destino_api()
  {
    var nomeCampo_local_destino_api = "local_destino_api";
    var var_local_destino_api = scAjaxGetFieldText(nomeCampo_local_destino_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_local_destino_api(var_local_destino_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_local_destino_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_local_destino_api

  function do_ajax_form_transfer_rsvp_validate_local_destino_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "local_destino_api";
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
  } // do_ajax_form_transfer_rsvp_validate_local_destino_api_cb

  // ---------- Validate latitude_destino_api
  function do_ajax_form_transfer_rsvp_validate_latitude_destino_api()
  {
    var nomeCampo_latitude_destino_api = "latitude_destino_api";
    var var_latitude_destino_api = scAjaxGetFieldText(nomeCampo_latitude_destino_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_latitude_destino_api(var_latitude_destino_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_latitude_destino_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_latitude_destino_api

  function do_ajax_form_transfer_rsvp_validate_latitude_destino_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "latitude_destino_api";
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
  } // do_ajax_form_transfer_rsvp_validate_latitude_destino_api_cb

  // ---------- Validate longitude_destino_api
  function do_ajax_form_transfer_rsvp_validate_longitude_destino_api()
  {
    var nomeCampo_longitude_destino_api = "longitude_destino_api";
    var var_longitude_destino_api = scAjaxGetFieldText(nomeCampo_longitude_destino_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_longitude_destino_api(var_longitude_destino_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_longitude_destino_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_longitude_destino_api

  function do_ajax_form_transfer_rsvp_validate_longitude_destino_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "longitude_destino_api";
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
  } // do_ajax_form_transfer_rsvp_validate_longitude_destino_api_cb

  // ---------- Validate veiculo_api
  function do_ajax_form_transfer_rsvp_validate_veiculo_api()
  {
    var nomeCampo_veiculo_api = "veiculo_api";
    var var_veiculo_api = scAjaxGetFieldText(nomeCampo_veiculo_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_veiculo_api(var_veiculo_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_veiculo_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_veiculo_api

  function do_ajax_form_transfer_rsvp_validate_veiculo_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "veiculo_api";
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
  } // do_ajax_form_transfer_rsvp_validate_veiculo_api_cb

  // ---------- Validate companhia_api
  function do_ajax_form_transfer_rsvp_validate_companhia_api()
  {
    var nomeCampo_companhia_api = "companhia_api";
    var var_companhia_api = scAjaxGetFieldText(nomeCampo_companhia_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_companhia_api(var_companhia_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_companhia_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_companhia_api

  function do_ajax_form_transfer_rsvp_validate_companhia_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "companhia_api";
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
  } // do_ajax_form_transfer_rsvp_validate_companhia_api_cb

  // ---------- Validate nome_motorista_api
  function do_ajax_form_transfer_rsvp_validate_nome_motorista_api()
  {
    var nomeCampo_nome_motorista_api = "nome_motorista_api";
    var var_nome_motorista_api = scAjaxGetFieldText(nomeCampo_nome_motorista_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_nome_motorista_api(var_nome_motorista_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_nome_motorista_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_nome_motorista_api

  function do_ajax_form_transfer_rsvp_validate_nome_motorista_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "nome_motorista_api";
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
  } // do_ajax_form_transfer_rsvp_validate_nome_motorista_api_cb

  // ---------- Validate contato_motorista_api
  function do_ajax_form_transfer_rsvp_validate_contato_motorista_api()
  {
    var nomeCampo_contato_motorista_api = "contato_motorista_api";
    var var_contato_motorista_api = scAjaxGetFieldText(nomeCampo_contato_motorista_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_contato_motorista_api(var_contato_motorista_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_contato_motorista_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_contato_motorista_api

  function do_ajax_form_transfer_rsvp_validate_contato_motorista_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "contato_motorista_api";
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
  } // do_ajax_form_transfer_rsvp_validate_contato_motorista_api_cb

  // ---------- Validate matricula_api
  function do_ajax_form_transfer_rsvp_validate_matricula_api()
  {
    var nomeCampo_matricula_api = "matricula_api";
    var var_matricula_api = scAjaxGetFieldText(nomeCampo_matricula_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_matricula_api(var_matricula_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_matricula_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_matricula_api

  function do_ajax_form_transfer_rsvp_validate_matricula_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "matricula_api";
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
  } // do_ajax_form_transfer_rsvp_validate_matricula_api_cb

  // ---------- Validate duracao_percurso_api
  function do_ajax_form_transfer_rsvp_validate_duracao_percurso_api()
  {
    var nomeCampo_duracao_percurso_api = "duracao_percurso_api";
    var var_duracao_percurso_api = scAjaxGetFieldText(nomeCampo_duracao_percurso_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_duracao_percurso_api(var_duracao_percurso_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_duracao_percurso_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_duracao_percurso_api

  function do_ajax_form_transfer_rsvp_validate_duracao_percurso_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "duracao_percurso_api";
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
  } // do_ajax_form_transfer_rsvp_validate_duracao_percurso_api_cb

  // ---------- Validate comodidades_api
  function do_ajax_form_transfer_rsvp_validate_comodidades_api()
  {
    var nomeCampo_comodidades_api = "comodidades_api";
    var var_comodidades_api = scAjaxGetFieldText(nomeCampo_comodidades_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_comodidades_api(var_comodidades_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_comodidades_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_comodidades_api

  function do_ajax_form_transfer_rsvp_validate_comodidades_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "comodidades_api";
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
  } // do_ajax_form_transfer_rsvp_validate_comodidades_api_cb

  // ---------- Validate observacao_api
  function do_ajax_form_transfer_rsvp_validate_observacao_api()
  {
    var nomeCampo_observacao_api = "observacao_api";
    var var_observacao_api = scAjaxGetFieldText(nomeCampo_observacao_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_observacao_api(var_observacao_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_observacao_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_observacao_api

  function do_ajax_form_transfer_rsvp_validate_observacao_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "observacao_api";
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
  } // do_ajax_form_transfer_rsvp_validate_observacao_api_cb

  // ---------- Validate placa_veiculo_api
  function do_ajax_form_transfer_rsvp_validate_placa_veiculo_api()
  {
    var nomeCampo_placa_veiculo_api = "placa_veiculo_api";
    var var_placa_veiculo_api = scAjaxGetFieldText(nomeCampo_placa_veiculo_api);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_placa_veiculo_api(var_placa_veiculo_api, var_script_case_init, do_ajax_form_transfer_rsvp_validate_placa_veiculo_api_cb);
  } // do_ajax_form_transfer_rsvp_validate_placa_veiculo_api

  function do_ajax_form_transfer_rsvp_validate_placa_veiculo_api_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "placa_veiculo_api";
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
  } // do_ajax_form_transfer_rsvp_validate_placa_veiculo_api_cb

  // ---------- Validate id_evento_app
  function do_ajax_form_transfer_rsvp_validate_id_evento_app()
  {
    var nomeCampo_id_evento_app = "id_evento_app";
    var var_id_evento_app = scAjaxGetFieldText(nomeCampo_id_evento_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_id_evento_app(var_id_evento_app, var_script_case_init, do_ajax_form_transfer_rsvp_validate_id_evento_app_cb);
  } // do_ajax_form_transfer_rsvp_validate_id_evento_app

  function do_ajax_form_transfer_rsvp_validate_id_evento_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "id_evento_app";
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
  } // do_ajax_form_transfer_rsvp_validate_id_evento_app_cb

  // ---------- Validate id_participante_app
  function do_ajax_form_transfer_rsvp_validate_id_participante_app()
  {
    var nomeCampo_id_participante_app = "id_participante_app";
    var var_id_participante_app = scAjaxGetFieldText(nomeCampo_id_participante_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_id_participante_app(var_id_participante_app, var_script_case_init, do_ajax_form_transfer_rsvp_validate_id_participante_app_cb);
  } // do_ajax_form_transfer_rsvp_validate_id_participante_app

  function do_ajax_form_transfer_rsvp_validate_id_participante_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "id_participante_app";
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
  } // do_ajax_form_transfer_rsvp_validate_id_participante_app_cb

  // ---------- Validate id_voucher_app
  function do_ajax_form_transfer_rsvp_validate_id_voucher_app()
  {
    var nomeCampo_id_voucher_app = "id_voucher_app";
    var var_id_voucher_app = scAjaxGetFieldText(nomeCampo_id_voucher_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_id_voucher_app(var_id_voucher_app, var_script_case_init, do_ajax_form_transfer_rsvp_validate_id_voucher_app_cb);
  } // do_ajax_form_transfer_rsvp_validate_id_voucher_app

  function do_ajax_form_transfer_rsvp_validate_id_voucher_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "id_voucher_app";
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
  } // do_ajax_form_transfer_rsvp_validate_id_voucher_app_cb

  // ---------- Validate titulo_api_out
  function do_ajax_form_transfer_rsvp_validate_titulo_api_out()
  {
    var nomeCampo_titulo_api_out = "titulo_api_out";
    var var_titulo_api_out = scAjaxGetFieldText(nomeCampo_titulo_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_titulo_api_out(var_titulo_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_titulo_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_titulo_api_out

  function do_ajax_form_transfer_rsvp_validate_titulo_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "titulo_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_titulo_api_out_cb

  // ---------- Validate descricao_api_out
  function do_ajax_form_transfer_rsvp_validate_descricao_api_out()
  {
    var nomeCampo_descricao_api_out = "descricao_api_out";
    var var_descricao_api_out = scAjaxGetFieldText(nomeCampo_descricao_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_descricao_api_out(var_descricao_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_descricao_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_descricao_api_out

  function do_ajax_form_transfer_rsvp_validate_descricao_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "descricao_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_descricao_api_out_cb

  // ---------- Validate codigo_api_out
  function do_ajax_form_transfer_rsvp_validate_codigo_api_out()
  {
    var nomeCampo_codigo_api_out = "codigo_api_out";
    var var_codigo_api_out = scAjaxGetFieldText(nomeCampo_codigo_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_codigo_api_out(var_codigo_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_codigo_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_codigo_api_out

  function do_ajax_form_transfer_rsvp_validate_codigo_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "codigo_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_codigo_api_out_cb

  // ---------- Validate tipo_api_out
  function do_ajax_form_transfer_rsvp_validate_tipo_api_out()
  {
    var nomeCampo_tipo_api_out = "tipo_api_out";
    var var_tipo_api_out = scAjaxGetFieldHidden(nomeCampo_tipo_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_tipo_api_out(var_tipo_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_tipo_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_tipo_api_out

  function do_ajax_form_transfer_rsvp_validate_tipo_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tipo_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_tipo_api_out_cb

  // ---------- Validate status_api_out
  function do_ajax_form_transfer_rsvp_validate_status_api_out()
  {
    var nomeCampo_status_api_out = "status_api_out";
    var var_status_api_out = scAjaxGetFieldHidden(nomeCampo_status_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_status_api_out(var_status_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_status_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_status_api_out

  function do_ajax_form_transfer_rsvp_validate_status_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "status_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_status_api_out_cb

  // ---------- Validate valido_de_api_out
  function do_ajax_form_transfer_rsvp_validate_valido_de_api_out()
  {
    var nomeCampo_valido_de_api_out = "valido_de_api_out";
    var var_valido_de_api_out = scAjaxGetFieldText(nomeCampo_valido_de_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_valido_de_api_out(var_valido_de_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_valido_de_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_valido_de_api_out

  function do_ajax_form_transfer_rsvp_validate_valido_de_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "valido_de_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_valido_de_api_out_cb

  // ---------- Validate valido_ate_api_out
  function do_ajax_form_transfer_rsvp_validate_valido_ate_api_out()
  {
    var nomeCampo_valido_ate_api_out = "valido_ate_api_out";
    var var_valido_ate_api_out = scAjaxGetFieldText(nomeCampo_valido_ate_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_valido_ate_api_out(var_valido_ate_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_valido_ate_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_valido_ate_api_out

  function do_ajax_form_transfer_rsvp_validate_valido_ate_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "valido_ate_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_valido_ate_api_out_cb

  // ---------- Validate local_de_origem_api_out
  function do_ajax_form_transfer_rsvp_validate_local_de_origem_api_out()
  {
    var nomeCampo_local_de_origem_api_out = "local_de_origem_api_out";
    var var_local_de_origem_api_out = scAjaxGetFieldText(nomeCampo_local_de_origem_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_local_de_origem_api_out(var_local_de_origem_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_local_de_origem_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_local_de_origem_api_out

  function do_ajax_form_transfer_rsvp_validate_local_de_origem_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "local_de_origem_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_local_de_origem_api_out_cb

  // ---------- Validate latitude_origem_api_out
  function do_ajax_form_transfer_rsvp_validate_latitude_origem_api_out()
  {
    var nomeCampo_latitude_origem_api_out = "latitude_origem_api_out";
    var var_latitude_origem_api_out = scAjaxGetFieldText(nomeCampo_latitude_origem_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_latitude_origem_api_out(var_latitude_origem_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_latitude_origem_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_latitude_origem_api_out

  function do_ajax_form_transfer_rsvp_validate_latitude_origem_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "latitude_origem_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_latitude_origem_api_out_cb

  // ---------- Validate longitude_origem_api_out
  function do_ajax_form_transfer_rsvp_validate_longitude_origem_api_out()
  {
    var nomeCampo_longitude_origem_api_out = "longitude_origem_api_out";
    var var_longitude_origem_api_out = scAjaxGetFieldText(nomeCampo_longitude_origem_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_longitude_origem_api_out(var_longitude_origem_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_longitude_origem_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_longitude_origem_api_out

  function do_ajax_form_transfer_rsvp_validate_longitude_origem_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "longitude_origem_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_longitude_origem_api_out_cb

  // ---------- Validate hr_saida_origem_api_out
  function do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out()
  {
    var nomeCampo_hr_saida_origem_api_out = "hr_saida_origem_api_out";
    var var_hr_saida_origem_api_out = scAjaxGetFieldText(nomeCampo_hr_saida_origem_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out(var_hr_saida_origem_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out

  function do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hr_saida_origem_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out_cb

  // ---------- Validate local_de_destino_api_out
  function do_ajax_form_transfer_rsvp_validate_local_de_destino_api_out()
  {
    var nomeCampo_local_de_destino_api_out = "local_de_destino_api_out";
    var var_local_de_destino_api_out = scAjaxGetFieldText(nomeCampo_local_de_destino_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_local_de_destino_api_out(var_local_de_destino_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_local_de_destino_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_local_de_destino_api_out

  function do_ajax_form_transfer_rsvp_validate_local_de_destino_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "local_de_destino_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_local_de_destino_api_out_cb

  // ---------- Validate latitude_destino_api_out
  function do_ajax_form_transfer_rsvp_validate_latitude_destino_api_out()
  {
    var nomeCampo_latitude_destino_api_out = "latitude_destino_api_out";
    var var_latitude_destino_api_out = scAjaxGetFieldText(nomeCampo_latitude_destino_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_latitude_destino_api_out(var_latitude_destino_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_latitude_destino_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_latitude_destino_api_out

  function do_ajax_form_transfer_rsvp_validate_latitude_destino_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "latitude_destino_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_latitude_destino_api_out_cb

  // ---------- Validate longitude_destino_api_out
  function do_ajax_form_transfer_rsvp_validate_longitude_destino_api_out()
  {
    var nomeCampo_longitude_destino_api_out = "longitude_destino_api_out";
    var var_longitude_destino_api_out = scAjaxGetFieldText(nomeCampo_longitude_destino_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_longitude_destino_api_out(var_longitude_destino_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_longitude_destino_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_longitude_destino_api_out

  function do_ajax_form_transfer_rsvp_validate_longitude_destino_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "longitude_destino_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_longitude_destino_api_out_cb

  // ---------- Validate veiculo_api_out
  function do_ajax_form_transfer_rsvp_validate_veiculo_api_out()
  {
    var nomeCampo_veiculo_api_out = "veiculo_api_out";
    var var_veiculo_api_out = scAjaxGetFieldText(nomeCampo_veiculo_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_veiculo_api_out(var_veiculo_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_veiculo_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_veiculo_api_out

  function do_ajax_form_transfer_rsvp_validate_veiculo_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "veiculo_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_veiculo_api_out_cb

  // ---------- Validate companhia_api_out
  function do_ajax_form_transfer_rsvp_validate_companhia_api_out()
  {
    var nomeCampo_companhia_api_out = "companhia_api_out";
    var var_companhia_api_out = scAjaxGetFieldText(nomeCampo_companhia_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_companhia_api_out(var_companhia_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_companhia_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_companhia_api_out

  function do_ajax_form_transfer_rsvp_validate_companhia_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "companhia_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_companhia_api_out_cb

  // ---------- Validate nome_motorista_api_out
  function do_ajax_form_transfer_rsvp_validate_nome_motorista_api_out()
  {
    var nomeCampo_nome_motorista_api_out = "nome_motorista_api_out";
    var var_nome_motorista_api_out = scAjaxGetFieldText(nomeCampo_nome_motorista_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_nome_motorista_api_out(var_nome_motorista_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_nome_motorista_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_nome_motorista_api_out

  function do_ajax_form_transfer_rsvp_validate_nome_motorista_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "nome_motorista_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_nome_motorista_api_out_cb

  // ---------- Validate contato_motorista_api_out
  function do_ajax_form_transfer_rsvp_validate_contato_motorista_api_out()
  {
    var nomeCampo_contato_motorista_api_out = "contato_motorista_api_out";
    var var_contato_motorista_api_out = scAjaxGetFieldText(nomeCampo_contato_motorista_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_contato_motorista_api_out(var_contato_motorista_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_contato_motorista_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_contato_motorista_api_out

  function do_ajax_form_transfer_rsvp_validate_contato_motorista_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "contato_motorista_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_contato_motorista_api_out_cb

  // ---------- Validate matricula_api_out
  function do_ajax_form_transfer_rsvp_validate_matricula_api_out()
  {
    var nomeCampo_matricula_api_out = "matricula_api_out";
    var var_matricula_api_out = scAjaxGetFieldText(nomeCampo_matricula_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_matricula_api_out(var_matricula_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_matricula_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_matricula_api_out

  function do_ajax_form_transfer_rsvp_validate_matricula_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "matricula_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_matricula_api_out_cb

  // ---------- Validate duracao_percurso_api_out
  function do_ajax_form_transfer_rsvp_validate_duracao_percurso_api_out()
  {
    var nomeCampo_duracao_percurso_api_out = "duracao_percurso_api_out";
    var var_duracao_percurso_api_out = scAjaxGetFieldText(nomeCampo_duracao_percurso_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_duracao_percurso_api_out(var_duracao_percurso_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_duracao_percurso_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_duracao_percurso_api_out

  function do_ajax_form_transfer_rsvp_validate_duracao_percurso_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "duracao_percurso_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_duracao_percurso_api_out_cb

  // ---------- Validate comodidades_api_out
  function do_ajax_form_transfer_rsvp_validate_comodidades_api_out()
  {
    var nomeCampo_comodidades_api_out = "comodidades_api_out";
    var var_comodidades_api_out = scAjaxGetFieldText(nomeCampo_comodidades_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_comodidades_api_out(var_comodidades_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_comodidades_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_comodidades_api_out

  function do_ajax_form_transfer_rsvp_validate_comodidades_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "comodidades_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_comodidades_api_out_cb

  // ---------- Validate observacao_api_out
  function do_ajax_form_transfer_rsvp_validate_observacao_api_out()
  {
    var nomeCampo_observacao_api_out = "observacao_api_out";
    var var_observacao_api_out = scAjaxGetFieldText(nomeCampo_observacao_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_observacao_api_out(var_observacao_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_observacao_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_observacao_api_out

  function do_ajax_form_transfer_rsvp_validate_observacao_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "observacao_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_observacao_api_out_cb

  // ---------- Validate placa_veiculo_api_out
  function do_ajax_form_transfer_rsvp_validate_placa_veiculo_api_out()
  {
    var nomeCampo_placa_veiculo_api_out = "placa_veiculo_api_out";
    var var_placa_veiculo_api_out = scAjaxGetFieldText(nomeCampo_placa_veiculo_api_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_placa_veiculo_api_out(var_placa_veiculo_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_placa_veiculo_api_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_placa_veiculo_api_out

  function do_ajax_form_transfer_rsvp_validate_placa_veiculo_api_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "placa_veiculo_api_out";
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
  } // do_ajax_form_transfer_rsvp_validate_placa_veiculo_api_out_cb

  // ---------- Validate id_evento_app_out
  function do_ajax_form_transfer_rsvp_validate_id_evento_app_out()
  {
    var nomeCampo_id_evento_app_out = "id_evento_app_out";
    var var_id_evento_app_out = scAjaxGetFieldText(nomeCampo_id_evento_app_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_id_evento_app_out(var_id_evento_app_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_id_evento_app_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_id_evento_app_out

  function do_ajax_form_transfer_rsvp_validate_id_evento_app_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "id_evento_app_out";
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
  } // do_ajax_form_transfer_rsvp_validate_id_evento_app_out_cb

  // ---------- Validate id_participante_app_out
  function do_ajax_form_transfer_rsvp_validate_id_participante_app_out()
  {
    var nomeCampo_id_participante_app_out = "id_participante_app_out";
    var var_id_participante_app_out = scAjaxGetFieldText(nomeCampo_id_participante_app_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_id_participante_app_out(var_id_participante_app_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_id_participante_app_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_id_participante_app_out

  function do_ajax_form_transfer_rsvp_validate_id_participante_app_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "id_participante_app_out";
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
  } // do_ajax_form_transfer_rsvp_validate_id_participante_app_out_cb

  // ---------- Validate id_voucher_app_out
  function do_ajax_form_transfer_rsvp_validate_id_voucher_app_out()
  {
    var nomeCampo_id_voucher_app_out = "id_voucher_app_out";
    var var_id_voucher_app_out = scAjaxGetFieldText(nomeCampo_id_voucher_app_out);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_transfer_rsvp_validate_id_voucher_app_out(var_id_voucher_app_out, var_script_case_init, do_ajax_form_transfer_rsvp_validate_id_voucher_app_out_cb);
  } // do_ajax_form_transfer_rsvp_validate_id_voucher_app_out

  function do_ajax_form_transfer_rsvp_validate_id_voucher_app_out_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "id_voucher_app_out";
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
  } // do_ajax_form_transfer_rsvp_validate_id_voucher_app_out_cb

  // ---------- Event onclick enviar_app
  function do_ajax_form_transfer_rsvp_event_enviar_app_onclick()
  {
    var var_enviar_app = scAjaxGetFieldRadio("enviar_app");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_enviar_app_onclick(var_enviar_app, var_script_case_init, do_ajax_form_transfer_rsvp_event_enviar_app_onclick_cb);
  } // do_ajax_form_transfer_rsvp_event_enviar_app_onclick

  function do_ajax_form_transfer_rsvp_event_enviar_app_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "enviar_app";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_enviar_app_onclick_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_enviar_app_onclick_cb
  function do_ajax_form_transfer_rsvp_event_enviar_app_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_enviar_app_onclick_cb_after_alert

  // ---------- Event onclick local_de_destino_api_out
  function do_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick()
  {
    var var_local_de_destino_api_out = scAjaxGetFieldText("local_de_destino_api_out");
    var var_latitude_destino_api_out = scAjaxGetFieldText("latitude_destino_api_out");
    var var_longitude_destino_api_out = scAjaxGetFieldText("longitude_destino_api_out");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick(var_local_de_destino_api_out, var_latitude_destino_api_out, var_longitude_destino_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick_cb);
  } // do_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick

  function do_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "local_de_destino_api_out";
    scAjaxUpdateFieldErrors(sFieldValid, "onclick");
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick_cb
  function do_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick_cb_after_alert

  // ---------- Event onchange local_de_origem_api
  function do_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange()
  {
    var var_local_de_origem_api = scAjaxGetFieldText("local_de_origem_api");
    var var_latitude_origem_api = scAjaxGetFieldText("latitude_origem_api");
    var var_longitude_origem_api = scAjaxGetFieldText("longitude_origem_api");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange(var_local_de_origem_api, var_latitude_origem_api, var_longitude_origem_api, var_script_case_init, do_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange

  function do_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "local_de_origem_api";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange_cb
  function do_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange_cb_after_alert

  // ---------- Event onchange local_de_origem_api_out
  function do_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange()
  {
    var var_local_de_origem_api_out = scAjaxGetFieldText("local_de_origem_api_out");
    var var_latitude_origem_api_out = scAjaxGetFieldText("latitude_origem_api_out");
    var var_longitude_origem_api_out = scAjaxGetFieldText("longitude_origem_api_out");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange(var_local_de_origem_api_out, var_latitude_origem_api_out, var_longitude_origem_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange

  function do_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "local_de_origem_api_out";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange_cb
  function do_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange_cb_after_alert

  // ---------- Event onchange local_destino_api
  function do_ajax_form_transfer_rsvp_event_local_destino_api_onchange()
  {
    var var_local_destino_api = scAjaxGetFieldText("local_destino_api");
    var var_latitude_destino_api = scAjaxGetFieldText("latitude_destino_api");
    var var_longitude_destino_api = scAjaxGetFieldText("longitude_destino_api");
    var var_longitude_origem_api = scAjaxGetFieldText("longitude_origem_api");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_local_destino_api_onchange(var_local_destino_api, var_latitude_destino_api, var_longitude_destino_api, var_longitude_origem_api, var_script_case_init, do_ajax_form_transfer_rsvp_event_local_destino_api_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_local_destino_api_onchange

  function do_ajax_form_transfer_rsvp_event_local_destino_api_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "local_destino_api";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_local_destino_api_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_local_destino_api_onchange_cb
  function do_ajax_form_transfer_rsvp_event_local_destino_api_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_local_destino_api_onchange_cb_after_alert

  // ---------- Event onchange tra_flag_ida_local
  function do_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange()
  {
    var var_tra_flag_ida_local = scAjaxGetFieldSelect("tra_flag_ida_local");
    var var_tra_flag_volta = scAjaxGetFieldSelect("tra_flag_volta");
    var var_tra_flag_ida = scAjaxGetFieldSelect("tra_flag_ida");
    var var_tra_flag_proprio = scAjaxGetFieldSelect("tra_flag_proprio");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange(var_tra_flag_ida_local, var_tra_flag_volta, var_tra_flag_ida, var_tra_flag_proprio, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange

  function do_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_flag_ida_local";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange_cb_after_alert

  // ---------- Event onchange tra_flag_ida
  function do_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange()
  {
    var var_tra_flag_ida = scAjaxGetFieldSelect("tra_flag_ida");
    var var_tra_flag_volta = scAjaxGetFieldSelect("tra_flag_volta");
    var var_tra_flag_proprio = scAjaxGetFieldSelect("tra_flag_proprio");
    var var_tra_flag_ida_local = scAjaxGetFieldSelect("tra_flag_ida_local");
    var var_tra_flag_volta_local = scAjaxGetFieldSelect("tra_flag_volta_local");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange(var_tra_flag_ida, var_tra_flag_volta, var_tra_flag_proprio, var_tra_flag_ida_local, var_tra_flag_volta_local, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange

  function do_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_flag_ida";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange_cb_after_alert

  // ---------- Event onchange tra_flag_proprio
  function do_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange()
  {
    var var_tra_flag_proprio = scAjaxGetFieldSelect("tra_flag_proprio");
    var var_tra_flag_volta = scAjaxGetFieldSelect("tra_flag_volta");
    var var_tra_flag_ida = scAjaxGetFieldSelect("tra_flag_ida");
    var var_tra_flag_ida_local = scAjaxGetFieldSelect("tra_flag_ida_local");
    var var_tra_flag_volta_local = scAjaxGetFieldSelect("tra_flag_volta_local");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange(var_tra_flag_proprio, var_tra_flag_volta, var_tra_flag_ida, var_tra_flag_ida_local, var_tra_flag_volta_local, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange

  function do_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_flag_proprio";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange_cb_after_alert

  // ---------- Event onchange tra_flag_volta_local
  function do_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange()
  {
    var var_tra_flag_volta = scAjaxGetFieldSelect("tra_flag_volta");
    var var_tra_flag_ida = scAjaxGetFieldSelect("tra_flag_ida");
    var var_tra_flag_proprio = scAjaxGetFieldSelect("tra_flag_proprio");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange(var_tra_flag_volta, var_tra_flag_ida, var_tra_flag_proprio, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange

  function do_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_flag_volta_local";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange_cb_after_alert

  // ---------- Event onchange tra_flag_volta
  function do_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange()
  {
    var var_tra_flag_volta = scAjaxGetFieldSelect("tra_flag_volta");
    var var_tra_flag_ida = scAjaxGetFieldSelect("tra_flag_ida");
    var var_tra_flag_proprio = scAjaxGetFieldSelect("tra_flag_proprio");
    var var_tra_flag_ida_local = scAjaxGetFieldSelect("tra_flag_ida_local");
    var var_tra_flag_volta_local = scAjaxGetFieldSelect("tra_flag_volta_local");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange(var_tra_flag_volta, var_tra_flag_ida, var_tra_flag_proprio, var_tra_flag_ida_local, var_tra_flag_volta_local, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange

  function do_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_flag_volta";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange_cb_after_alert

  // ---------- Event onchange tra_id_hotel
  function do_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange()
  {
    var var_tra_id_hotel = scAjaxGetFieldSelect("tra_id_hotel");
    var var_hotel_dsc = scAjaxGetFieldHidden("hotel_dsc");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange(var_tra_id_hotel, var_hotel_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange

  function do_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_id_hotel";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange_cb_after_alert

  // ---------- Event onchange tra_id_hotel_out
  function do_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange()
  {
    var var_tra_id_hotel_out = scAjaxGetFieldSelect("tra_id_hotel_out");
    var var_hotel_dsc_out = scAjaxGetFieldHidden("hotel_dsc_out");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange(var_tra_id_hotel_out, var_hotel_dsc_out, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange

  function do_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_id_hotel_out";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange_cb_after_alert

  // ---------- Event onchange tra_intervalo
  function do_ajax_form_transfer_rsvp_event_tra_intervalo_onchange()
  {
    var var_tra_hr_saida_volta = scAjaxGetFieldHidden("tra_hr_saida_volta");
    var var_tra_intervalo = scAjaxGetFieldSelect("tra_intervalo");
    var var_tra_hrtransout = scAjaxGetFieldText("tra_hrtransout");
    var var_hr_saida_origem_api_out = scAjaxGetFieldText("hr_saida_origem_api_out");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_intervalo_onchange(var_tra_hr_saida_volta, var_tra_intervalo, var_tra_hrtransout, var_hr_saida_origem_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_intervalo_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_intervalo_onchange

  function do_ajax_form_transfer_rsvp_event_tra_intervalo_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_intervalo";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_intervalo_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_intervalo_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_intervalo_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_intervalo_onchange_cb_after_alert

  // ---------- Event onfocus tra_status
  function do_ajax_form_transfer_rsvp_event_tra_status_onfocus()
  {
    var var_tra_tipo = scAjaxGetFieldSelect("tra_tipo");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn();
    x_ajax_form_transfer_rsvp_event_tra_status_onfocus(var_tra_tipo, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_status_onfocus_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_status_onfocus

  function do_ajax_form_transfer_rsvp_event_tra_status_onfocus_cb(sResp)
  {
    scAjaxProcOff();
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_status";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_status_onfocus_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_status_onfocus_cb
  function do_ajax_form_transfer_rsvp_event_tra_status_onfocus_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_status_onfocus_cb_after_alert

  // ---------- Event onchange tra_tipo
  function do_ajax_form_transfer_rsvp_event_tra_tipo_onchange()
  {
    var var_tra_tipo = scAjaxGetFieldSelect("tra_tipo");
    var var_tra_dt_chegada_proprio = scAjaxGetFieldText("tra_dt_chegada_proprio");
    var var_tra_hr_chegada_proprio = scAjaxGetFieldText("tra_hr_chegada_proprio");
    var var_tra_dt_ida_local = scAjaxGetFieldText("tra_dt_ida_local");
    var var_tra_hr_ida_local = scAjaxGetFieldText("tra_hr_ida_local");
    var var_tra_dt_volta_local = scAjaxGetFieldText("tra_dt_volta_local");
    var var_tra_hr_volta_local = scAjaxGetFieldText("tra_hr_volta_local");
    var var_tra_origem_ida_local = scAjaxGetFieldText("tra_origem_ida_local");
    var var_tra_destino_ida_local = scAjaxGetFieldText("tra_destino_ida_local");
    var var_tra_origem_volta_local = scAjaxGetFieldText("tra_origem_volta_local");
    var var_tra_destino_volta_local = scAjaxGetFieldText("tra_destino_volta_local");
    var var_tra_flag_proprio = scAjaxGetFieldSelect("tra_flag_proprio");
    var var_tra_flag_volta_local = scAjaxGetFieldSelect("tra_flag_volta_local");
    var var_enviar_app = scAjaxGetFieldRadio("enviar_app");
    var var_titulo_api = scAjaxGetFieldText("titulo_api");
    var var_descricao_api = scAjaxGetFieldText("descricao_api");
    var var_codigo_api = scAjaxGetFieldText("codigo_api");
    var var_tipo_api = scAjaxGetFieldHidden("tipo_api");
    var var_status_api = scAjaxGetFieldHidden("status_api");
    var var_valido_de_api = scAjaxGetFieldText("valido_de_api");
    var var_valido_ate_api = scAjaxGetFieldText("valido_ate_api");
    var var_local_de_origem_api = scAjaxGetFieldText("local_de_origem_api");
    var var_latitude_origem_api = scAjaxGetFieldText("latitude_origem_api");
    var var_longitude_origem_api = scAjaxGetFieldText("longitude_origem_api");
    var var_hr_saida_origem_api = scAjaxGetFieldText("hr_saida_origem_api");
    var var_veiculo_api = scAjaxGetFieldText("veiculo_api");
    var var_companhia_api = scAjaxGetFieldText("companhia_api");
    var var_nome_motorista_api = scAjaxGetFieldText("nome_motorista_api");
    var var_matricula_api = scAjaxGetFieldText("matricula_api");
    var var_duracao_percurso_api = scAjaxGetFieldText("duracao_percurso_api");
    var var_comodidades_api = scAjaxGetFieldText("comodidades_api");
    var var_observacao_api = scAjaxGetFieldText("observacao_api");
    var var_placa_veiculo_api = scAjaxGetFieldText("placa_veiculo_api");
    var var_titulo_api_out = scAjaxGetFieldText("titulo_api_out");
    var var_descricao_api_out = scAjaxGetFieldText("descricao_api_out");
    var var_codigo_api_out = scAjaxGetFieldText("codigo_api_out");
    var var_tipo_api_out = scAjaxGetFieldHidden("tipo_api_out");
    var var_status_api_out = scAjaxGetFieldHidden("status_api_out");
    var var_valido_de_api_out = scAjaxGetFieldText("valido_de_api_out");
    var var_valido_ate_api_out = scAjaxGetFieldText("valido_ate_api_out");
    var var_local_de_origem_api_out = scAjaxGetFieldText("local_de_origem_api_out");
    var var_latitude_origem_api_out = scAjaxGetFieldText("latitude_origem_api_out");
    var var_longitude_origem_api_out = scAjaxGetFieldText("longitude_origem_api_out");
    var var_hr_saida_origem_api_out = scAjaxGetFieldText("hr_saida_origem_api_out");
    var var_veiculo_api_out = scAjaxGetFieldText("veiculo_api_out");
    var var_companhia_api_out = scAjaxGetFieldText("companhia_api_out");
    var var_nome_motorista_api_out = scAjaxGetFieldText("nome_motorista_api_out");
    var var_matricula_api_out = scAjaxGetFieldText("matricula_api_out");
    var var_duracao_percurso_api_out = scAjaxGetFieldText("duracao_percurso_api_out");
    var var_comodidades_api_out = scAjaxGetFieldText("comodidades_api_out");
    var var_observacao_api_out = scAjaxGetFieldText("observacao_api_out");
    var var_placa_veiculo_api_out = scAjaxGetFieldText("placa_veiculo_api_out");
    var var_tra_cia_ida = scAjaxGetFieldHidden("tra_cia_ida");
    var var_tra_numvoo_ida = scAjaxGetFieldHidden("tra_numvoo_ida");
    var var_tra_origem_ida = scAjaxGetFieldHidden("tra_origem_ida");
    var var_tra_destino_ida = scAjaxGetFieldHidden("tra_destino_ida");
    var var_tra_dt_saida_ida = scAjaxGetFieldHidden("tra_dt_saida_ida");
    var var_tra_hr_saida_ida = scAjaxGetFieldHidden("tra_hr_saida_ida");
    var var_tra_dt_chegada_ida = scAjaxGetFieldHidden("tra_dt_chegada_ida");
    var var_tra_hr_chegada_ida = scAjaxGetFieldHidden("tra_hr_chegada_ida");
    var var_tra_localizador_ida = scAjaxGetFieldHidden("tra_localizador_ida");
    var var_cia_ida_dsc = scAjaxGetFieldHidden("cia_ida_dsc");
    var var_destino_ida_dsc = scAjaxGetFieldHidden("destino_ida_dsc");
    var var_origem_ida_dsc = scAjaxGetFieldHidden("origem_ida_dsc");
    var var_tra_flag_ida = scAjaxGetFieldSelect("tra_flag_ida");
    var var_tra_eticket_ida = scAjaxGetFieldHidden("tra_eticket_ida");
    var var_tra_cia_volta = scAjaxGetFieldHidden("tra_cia_volta");
    var var_tra_numvoo_volta = scAjaxGetFieldHidden("tra_numvoo_volta");
    var var_tra_origem_volta = scAjaxGetFieldHidden("tra_origem_volta");
    var var_tra_destino_volta = scAjaxGetFieldHidden("tra_destino_volta");
    var var_tra_dt_saida_volta = scAjaxGetFieldHidden("tra_dt_saida_volta");
    var var_tra_hr_saida_volta = scAjaxGetFieldHidden("tra_hr_saida_volta");
    var var_tra_dt_chegada_volta = scAjaxGetFieldHidden("tra_dt_chegada_volta");
    var var_tra_hr_chegada_volta = scAjaxGetFieldHidden("tra_hr_chegada_volta");
    var var_tra_localizador_volta = scAjaxGetFieldHidden("tra_localizador_volta");
    var var_tra_eticket_volta = scAjaxGetFieldHidden("tra_eticket_volta");
    var var_cia_volta_dsc = scAjaxGetFieldHidden("cia_volta_dsc");
    var var_destino_volta_dsc = scAjaxGetFieldHidden("destino_volta_dsc");
    var var_origem_volta_dsc = scAjaxGetFieldHidden("origem_volta_dsc");
    var var_tra_flag_volta = scAjaxGetFieldSelect("tra_flag_volta");
    var var_tra_id_hotel = scAjaxGetFieldSelect("tra_id_hotel");
    var var_hotel_dsc = scAjaxGetFieldHidden("hotel_dsc");
    var var_tra_id_hotel_out = scAjaxGetFieldSelect("tra_id_hotel_out");
    var var_hotel_dsc_out = scAjaxGetFieldHidden("hotel_dsc_out");
    var var_local_destino_api = scAjaxGetFieldText("local_destino_api");
    var var_latitude_destino_api = scAjaxGetFieldText("latitude_destino_api");
    var var_longitude_destino_api = scAjaxGetFieldText("longitude_destino_api");
    var var_tra_hrtransout = scAjaxGetFieldText("tra_hrtransout");
    var var_local_de_destino_api_out = scAjaxGetFieldText("local_de_destino_api_out");
    var var_latitude_destino_api_out = scAjaxGetFieldText("latitude_destino_api_out");
    var var_longitude_destino_api_out = scAjaxGetFieldText("longitude_destino_api_out");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_tipo_onchange(var_tra_tipo, var_tra_dt_chegada_proprio, var_tra_hr_chegada_proprio, var_tra_dt_ida_local, var_tra_hr_ida_local, var_tra_dt_volta_local, var_tra_hr_volta_local, var_tra_origem_ida_local, var_tra_destino_ida_local, var_tra_origem_volta_local, var_tra_destino_volta_local, var_tra_flag_proprio, var_tra_flag_volta_local, var_enviar_app, var_titulo_api, var_descricao_api, var_codigo_api, var_tipo_api, var_status_api, var_valido_de_api, var_valido_ate_api, var_local_de_origem_api, var_latitude_origem_api, var_longitude_origem_api, var_hr_saida_origem_api, var_veiculo_api, var_companhia_api, var_nome_motorista_api, var_matricula_api, var_duracao_percurso_api, var_comodidades_api, var_observacao_api, var_placa_veiculo_api, var_titulo_api_out, var_descricao_api_out, var_codigo_api_out, var_tipo_api_out, var_status_api_out, var_valido_de_api_out, var_valido_ate_api_out, var_local_de_origem_api_out, var_latitude_origem_api_out, var_longitude_origem_api_out, var_hr_saida_origem_api_out, var_veiculo_api_out, var_companhia_api_out, var_nome_motorista_api_out, var_matricula_api_out, var_duracao_percurso_api_out, var_comodidades_api_out, var_observacao_api_out, var_placa_veiculo_api_out, var_tra_cia_ida, var_tra_numvoo_ida, var_tra_origem_ida, var_tra_destino_ida, var_tra_dt_saida_ida, var_tra_hr_saida_ida, var_tra_dt_chegada_ida, var_tra_hr_chegada_ida, var_tra_localizador_ida, var_cia_ida_dsc, var_destino_ida_dsc, var_origem_ida_dsc, var_tra_flag_ida, var_tra_eticket_ida, var_tra_cia_volta, var_tra_numvoo_volta, var_tra_origem_volta, var_tra_destino_volta, var_tra_dt_saida_volta, var_tra_hr_saida_volta, var_tra_dt_chegada_volta, var_tra_hr_chegada_volta, var_tra_localizador_volta, var_tra_eticket_volta, var_cia_volta_dsc, var_destino_volta_dsc, var_origem_volta_dsc, var_tra_flag_volta, var_tra_id_hotel, var_hotel_dsc, var_tra_id_hotel_out, var_hotel_dsc_out, var_local_destino_api, var_latitude_destino_api, var_longitude_destino_api, var_tra_hrtransout, var_local_de_destino_api_out, var_latitude_destino_api_out, var_longitude_destino_api_out, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_tipo_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_tipo_onchange

  function do_ajax_form_transfer_rsvp_event_tra_tipo_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_tipo";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_tipo_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_tipo_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_tipo_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_tipo_onchange_cb_after_alert

  // ---------- Event onchange tra_ult_trecho_volta
  function do_ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange()
  {
    var var_tra_tipo = scAjaxGetFieldSelect("tra_tipo");
    var var_tra_cia_ida = scAjaxGetFieldHidden("tra_cia_ida");
    var var_tra_numvoo_ida = scAjaxGetFieldHidden("tra_numvoo_ida");
    var var_tra_origem_ida = scAjaxGetFieldHidden("tra_origem_ida");
    var var_tra_destino_ida = scAjaxGetFieldHidden("tra_destino_ida");
    var var_tra_dt_saida_ida = scAjaxGetFieldHidden("tra_dt_saida_ida");
    var var_tra_hr_saida_ida = scAjaxGetFieldHidden("tra_hr_saida_ida");
    var var_tra_dt_chegada_ida = scAjaxGetFieldHidden("tra_dt_chegada_ida");
    var var_tra_hr_chegada_ida = scAjaxGetFieldHidden("tra_hr_chegada_ida");
    var var_tra_localizador_ida = scAjaxGetFieldHidden("tra_localizador_ida");
    var var_tra_eticket_ida = scAjaxGetFieldHidden("tra_eticket_ida");
    var var_cia_ida_dsc = scAjaxGetFieldHidden("cia_ida_dsc");
    var var_origem_ida_dsc = scAjaxGetFieldHidden("origem_ida_dsc");
    var var_destino_ida_dsc = scAjaxGetFieldHidden("destino_ida_dsc");
    var var_tra_cia_volta = scAjaxGetFieldHidden("tra_cia_volta");
    var var_tra_numvoo_volta = scAjaxGetFieldHidden("tra_numvoo_volta");
    var var_tra_origem_volta = scAjaxGetFieldHidden("tra_origem_volta");
    var var_tra_destino_volta = scAjaxGetFieldHidden("tra_destino_volta");
    var var_tra_dt_saida_volta = scAjaxGetFieldHidden("tra_dt_saida_volta");
    var var_tra_hr_saida_volta = scAjaxGetFieldHidden("tra_hr_saida_volta");
    var var_tra_dt_chegada_volta = scAjaxGetFieldHidden("tra_dt_chegada_volta");
    var var_tra_hr_chegada_volta = scAjaxGetFieldHidden("tra_hr_chegada_volta");
    var var_tra_localizador_volta = scAjaxGetFieldHidden("tra_localizador_volta");
    var var_tra_eticket_volta = scAjaxGetFieldHidden("tra_eticket_volta");
    var var_cia_volta_dsc = scAjaxGetFieldHidden("cia_volta_dsc");
    var var_origem_volta_dsc = scAjaxGetFieldHidden("origem_volta_dsc");
    var var_destino_volta_dsc = scAjaxGetFieldHidden("destino_volta_dsc");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange(var_tra_tipo, var_tra_cia_ida, var_tra_numvoo_ida, var_tra_origem_ida, var_tra_destino_ida, var_tra_dt_saida_ida, var_tra_hr_saida_ida, var_tra_dt_chegada_ida, var_tra_hr_chegada_ida, var_tra_localizador_ida, var_tra_eticket_ida, var_cia_ida_dsc, var_origem_ida_dsc, var_destino_ida_dsc, var_tra_cia_volta, var_tra_numvoo_volta, var_tra_origem_volta, var_tra_destino_volta, var_tra_dt_saida_volta, var_tra_hr_saida_volta, var_tra_dt_chegada_volta, var_tra_hr_chegada_volta, var_tra_localizador_volta, var_tra_eticket_volta, var_cia_volta_dsc, var_origem_volta_dsc, var_destino_volta_dsc, var_script_case_init, do_ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange_cb);
  } // do_ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange

  function do_ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "tra_ult_trecho_volta";
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
    scAjaxAlert(do_ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange_cb
  function do_ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_transfer_rsvp_event_tra_ult_trecho_volta_onchange_cb_after_alert
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
  function do_ajax_form_transfer_rsvp_submit_form()
  {
    if (scEventControl_active("")) {
      setTimeout(function() { do_ajax_form_transfer_rsvp_submit_form(); }, 500);
      return;
    }
    scAjaxHideMessage();
    var var_tra_id_evento = scAjaxGetFieldHidden("tra_id_evento");
    var var_evento_dsc = scAjaxGetFieldHidden("evento_dsc");
    var var_tra_cpf_particip = scAjaxGetFieldHidden("tra_cpf_particip");
    var var_tipo_dsc = scAjaxGetFieldHidden("tipo_dsc");
    var var_tra_id_usuario = scAjaxGetFieldHidden("tra_id_usuario");
    var var_atendente_dsc = scAjaxGetFieldHidden("atendente_dsc");
    var var_tra_tipo = scAjaxGetFieldSelect("tra_tipo");
    var var_tra_id_hotel = scAjaxGetFieldSelect("tra_id_hotel");
    var var_hotel_dsc = scAjaxGetFieldHidden("hotel_dsc");
    var var_tra_id_hotel_out = scAjaxGetFieldSelect("tra_id_hotel_out");
    var var_hotel_dsc_out = scAjaxGetFieldHidden("hotel_dsc_out");
    var var_enviar_app = scAjaxGetFieldRadio("enviar_app");
    var var_tra_status = scAjaxGetFieldSelect("tra_status");
    var var_ult_trecho = scAjaxGetFieldHidden("ult_trecho");
    var var_tra_cia_ida = scAjaxGetFieldHidden("tra_cia_ida");
    var var_cia_ida_dsc = scAjaxGetFieldHidden("cia_ida_dsc");
    var var_tra_numvoo_ida = scAjaxGetFieldHidden("tra_numvoo_ida");
    var var_tra_origem_ida = scAjaxGetFieldHidden("tra_origem_ida");
    var var_origem_ida_dsc = scAjaxGetFieldHidden("origem_ida_dsc");
    var var_tra_destino_ida = scAjaxGetFieldHidden("tra_destino_ida");
    var var_destino_ida_dsc = scAjaxGetFieldHidden("destino_ida_dsc");
    var var_tra_dt_saida_ida = scAjaxGetFieldHidden("tra_dt_saida_ida");
    var var_tra_hr_saida_ida = scAjaxGetFieldHidden("tra_hr_saida_ida");
    var var_tra_dt_chegada_ida = scAjaxGetFieldHidden("tra_dt_chegada_ida");
    var var_tra_hr_chegada_ida = scAjaxGetFieldHidden("tra_hr_chegada_ida");
    var var_tra_localizador_ida = scAjaxGetFieldHidden("tra_localizador_ida");
    var var_tra_eticket_ida = scAjaxGetFieldHidden("tra_eticket_ida");
    var var_tra_flag_ida = scAjaxGetFieldSelect("tra_flag_ida");
    var var_tra_cia_volta = scAjaxGetFieldHidden("tra_cia_volta");
    var var_cia_volta_dsc = scAjaxGetFieldHidden("cia_volta_dsc");
    var var_tra_numvoo_volta = scAjaxGetFieldHidden("tra_numvoo_volta");
    var var_tra_origem_volta = scAjaxGetFieldHidden("tra_origem_volta");
    var var_origem_volta_dsc = scAjaxGetFieldHidden("origem_volta_dsc");
    var var_tra_destino_volta = scAjaxGetFieldHidden("tra_destino_volta");
    var var_destino_volta_dsc = scAjaxGetFieldHidden("destino_volta_dsc");
    var var_tra_dt_saida_volta = scAjaxGetFieldHidden("tra_dt_saida_volta");
    var var_tra_hr_saida_volta = scAjaxGetFieldHidden("tra_hr_saida_volta");
    var var_tra_dt_chegada_volta = scAjaxGetFieldHidden("tra_dt_chegada_volta");
    var var_tra_hr_chegada_volta = scAjaxGetFieldHidden("tra_hr_chegada_volta");
    var var_tra_localizador_volta = scAjaxGetFieldHidden("tra_localizador_volta");
    var var_tra_eticket_volta = scAjaxGetFieldHidden("tra_eticket_volta");
    var var_tra_intervalo = scAjaxGetFieldSelect("tra_intervalo");
    var var_tra_hrtransout = scAjaxGetFieldText("tra_hrtransout");
    var var_tra_flag_volta = scAjaxGetFieldSelect("tra_flag_volta");
    var var_tra_dt_chegada_proprio = scAjaxGetFieldText("tra_dt_chegada_proprio");
    var var_tra_hr_chegada_proprio = scAjaxGetFieldText("tra_hr_chegada_proprio");
    var var_tra_flag_proprio = scAjaxGetFieldSelect("tra_flag_proprio");
    var var_tra_dt_ida_local = scAjaxGetFieldText("tra_dt_ida_local");
    var var_tra_hr_ida_local = scAjaxGetFieldText("tra_hr_ida_local");
    var var_tra_origem_ida_local = scAjaxGetFieldText("tra_origem_ida_local");
    var var_tra_destino_ida_local = scAjaxGetFieldText("tra_destino_ida_local");
    var var_tra_flag_ida_local = scAjaxGetFieldSelect("tra_flag_ida_local");
    var var_tra_dt_volta_local = scAjaxGetFieldText("tra_dt_volta_local");
    var var_tra_hr_volta_local = scAjaxGetFieldText("tra_hr_volta_local");
    var var_tra_origem_volta_local = scAjaxGetFieldText("tra_origem_volta_local");
    var var_tra_destino_volta_local = scAjaxGetFieldText("tra_destino_volta_local");
    var var_tra_flag_volta_local = scAjaxGetFieldSelect("tra_flag_volta_local");
    var var_tra_observacao = scAjaxGetFieldText("tra_observacao");
    var var_tra_ativo = scAjaxGetFieldSelect("tra_ativo");
    var var_tra_dt_alteracao = scAjaxGetFieldHidden("tra_dt_alteracao");
    var var_cpf_del = scAjaxGetFieldHidden("cpf_del");
    var var_sql_log = scAjaxGetFieldHidden("sql_log");
    var var_titulo_api = scAjaxGetFieldText("titulo_api");
    var var_descricao_api = scAjaxGetFieldText("descricao_api");
    var var_codigo_api = scAjaxGetFieldText("codigo_api");
    var var_tipo_api = scAjaxGetFieldHidden("tipo_api");
    var var_status_api = scAjaxGetFieldHidden("status_api");
    var var_valido_de_api = scAjaxGetFieldText("valido_de_api");
    var var_valido_ate_api = scAjaxGetFieldText("valido_ate_api");
    var var_local_de_origem_api = scAjaxGetFieldText("local_de_origem_api");
    var var_latitude_origem_api = scAjaxGetFieldText("latitude_origem_api");
    var var_longitude_origem_api = scAjaxGetFieldText("longitude_origem_api");
    var var_hr_saida_origem_api = scAjaxGetFieldText("hr_saida_origem_api");
    var var_local_destino_api = scAjaxGetFieldText("local_destino_api");
    var var_latitude_destino_api = scAjaxGetFieldText("latitude_destino_api");
    var var_longitude_destino_api = scAjaxGetFieldText("longitude_destino_api");
    var var_veiculo_api = scAjaxGetFieldText("veiculo_api");
    var var_companhia_api = scAjaxGetFieldText("companhia_api");
    var var_nome_motorista_api = scAjaxGetFieldText("nome_motorista_api");
    var var_contato_motorista_api = scAjaxGetFieldText("contato_motorista_api");
    var var_matricula_api = scAjaxGetFieldText("matricula_api");
    var var_duracao_percurso_api = scAjaxGetFieldText("duracao_percurso_api");
    var var_comodidades_api = scAjaxGetFieldText("comodidades_api");
    var var_observacao_api = scAjaxGetFieldText("observacao_api");
    var var_placa_veiculo_api = scAjaxGetFieldText("placa_veiculo_api");
    var var_id_evento_app = scAjaxGetFieldText("id_evento_app");
    var var_id_participante_app = scAjaxGetFieldText("id_participante_app");
    var var_id_voucher_app = scAjaxGetFieldText("id_voucher_app");
    var var_titulo_api_out = scAjaxGetFieldText("titulo_api_out");
    var var_descricao_api_out = scAjaxGetFieldText("descricao_api_out");
    var var_codigo_api_out = scAjaxGetFieldText("codigo_api_out");
    var var_tipo_api_out = scAjaxGetFieldHidden("tipo_api_out");
    var var_status_api_out = scAjaxGetFieldHidden("status_api_out");
    var var_valido_de_api_out = scAjaxGetFieldText("valido_de_api_out");
    var var_valido_ate_api_out = scAjaxGetFieldText("valido_ate_api_out");
    var var_local_de_origem_api_out = scAjaxGetFieldText("local_de_origem_api_out");
    var var_latitude_origem_api_out = scAjaxGetFieldText("latitude_origem_api_out");
    var var_longitude_origem_api_out = scAjaxGetFieldText("longitude_origem_api_out");
    var var_hr_saida_origem_api_out = scAjaxGetFieldText("hr_saida_origem_api_out");
    var var_local_de_destino_api_out = scAjaxGetFieldText("local_de_destino_api_out");
    var var_latitude_destino_api_out = scAjaxGetFieldText("latitude_destino_api_out");
    var var_longitude_destino_api_out = scAjaxGetFieldText("longitude_destino_api_out");
    var var_veiculo_api_out = scAjaxGetFieldText("veiculo_api_out");
    var var_companhia_api_out = scAjaxGetFieldText("companhia_api_out");
    var var_nome_motorista_api_out = scAjaxGetFieldText("nome_motorista_api_out");
    var var_contato_motorista_api_out = scAjaxGetFieldText("contato_motorista_api_out");
    var var_matricula_api_out = scAjaxGetFieldText("matricula_api_out");
    var var_duracao_percurso_api_out = scAjaxGetFieldText("duracao_percurso_api_out");
    var var_comodidades_api_out = scAjaxGetFieldText("comodidades_api_out");
    var var_observacao_api_out = scAjaxGetFieldText("observacao_api_out");
    var var_placa_veiculo_api_out = scAjaxGetFieldText("placa_veiculo_api_out");
    var var_id_evento_app_out = scAjaxGetFieldText("id_evento_app_out");
    var var_id_participante_app_out = scAjaxGetFieldText("id_participante_app_out");
    var var_id_voucher_app_out = scAjaxGetFieldText("id_voucher_app_out");
    var var_nm_form_submit = document.F1.nm_form_submit.value;
    var var_nmgp_url_saida = document.F1.nmgp_url_saida.value;
    var var_nmgp_opcao = document.F1.nmgp_opcao.value;
    var var_nmgp_ancora = document.F1.nmgp_ancora.value;
    var var_nmgp_num_form = document.F1.nmgp_num_form.value;
    var var_nmgp_parms = document.F1.nmgp_parms.value;
    var var_script_case_init = document.F1.script_case_init.value;
    var var_csrf_token = scAjaxGetFieldText("csrf_token");
    scAjaxProcOn();
    x_ajax_form_transfer_rsvp_submit_form(var_tra_id_evento, var_evento_dsc, var_tra_cpf_particip, var_tipo_dsc, var_tra_id_usuario, var_atendente_dsc, var_tra_tipo, var_tra_id_hotel, var_hotel_dsc, var_tra_id_hotel_out, var_hotel_dsc_out, var_enviar_app, var_tra_status, var_ult_trecho, var_tra_cia_ida, var_cia_ida_dsc, var_tra_numvoo_ida, var_tra_origem_ida, var_origem_ida_dsc, var_tra_destino_ida, var_destino_ida_dsc, var_tra_dt_saida_ida, var_tra_hr_saida_ida, var_tra_dt_chegada_ida, var_tra_hr_chegada_ida, var_tra_localizador_ida, var_tra_eticket_ida, var_tra_flag_ida, var_tra_cia_volta, var_cia_volta_dsc, var_tra_numvoo_volta, var_tra_origem_volta, var_origem_volta_dsc, var_tra_destino_volta, var_destino_volta_dsc, var_tra_dt_saida_volta, var_tra_hr_saida_volta, var_tra_dt_chegada_volta, var_tra_hr_chegada_volta, var_tra_localizador_volta, var_tra_eticket_volta, var_tra_intervalo, var_tra_hrtransout, var_tra_flag_volta, var_tra_dt_chegada_proprio, var_tra_hr_chegada_proprio, var_tra_flag_proprio, var_tra_dt_ida_local, var_tra_hr_ida_local, var_tra_origem_ida_local, var_tra_destino_ida_local, var_tra_flag_ida_local, var_tra_dt_volta_local, var_tra_hr_volta_local, var_tra_origem_volta_local, var_tra_destino_volta_local, var_tra_flag_volta_local, var_tra_observacao, var_tra_ativo, var_tra_dt_alteracao, var_cpf_del, var_sql_log, var_titulo_api, var_descricao_api, var_codigo_api, var_tipo_api, var_status_api, var_valido_de_api, var_valido_ate_api, var_local_de_origem_api, var_latitude_origem_api, var_longitude_origem_api, var_hr_saida_origem_api, var_local_destino_api, var_latitude_destino_api, var_longitude_destino_api, var_veiculo_api, var_companhia_api, var_nome_motorista_api, var_contato_motorista_api, var_matricula_api, var_duracao_percurso_api, var_comodidades_api, var_observacao_api, var_placa_veiculo_api, var_id_evento_app, var_id_participante_app, var_id_voucher_app, var_titulo_api_out, var_descricao_api_out, var_codigo_api_out, var_tipo_api_out, var_status_api_out, var_valido_de_api_out, var_valido_ate_api_out, var_local_de_origem_api_out, var_latitude_origem_api_out, var_longitude_origem_api_out, var_hr_saida_origem_api_out, var_local_de_destino_api_out, var_latitude_destino_api_out, var_longitude_destino_api_out, var_veiculo_api_out, var_companhia_api_out, var_nome_motorista_api_out, var_contato_motorista_api_out, var_matricula_api_out, var_duracao_percurso_api_out, var_comodidades_api_out, var_observacao_api_out, var_placa_veiculo_api_out, var_id_evento_app_out, var_id_participante_app_out, var_id_voucher_app_out, var_nm_form_submit, var_nmgp_url_saida, var_nmgp_opcao, var_nmgp_ancora, var_nmgp_num_form, var_nmgp_parms, var_script_case_init, var_csrf_token, do_ajax_form_transfer_rsvp_submit_form_cb);
  } // do_ajax_form_transfer_rsvp_submit_form

  function do_ajax_form_transfer_rsvp_submit_form_cb(sResp)
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
      scAjaxHideErrorDisplay("tra_id_evento");
      scAjaxHideErrorDisplay("evento_dsc");
      scAjaxHideErrorDisplay("tra_cpf_particip");
      scAjaxHideErrorDisplay("tipo_dsc");
      scAjaxHideErrorDisplay("tra_id_usuario");
      scAjaxHideErrorDisplay("atendente_dsc");
      scAjaxHideErrorDisplay("tra_tipo");
      scAjaxHideErrorDisplay("tra_id_hotel");
      scAjaxHideErrorDisplay("hotel_dsc");
      scAjaxHideErrorDisplay("tra_id_hotel_out");
      scAjaxHideErrorDisplay("hotel_dsc_out");
      scAjaxHideErrorDisplay("enviar_app");
      scAjaxHideErrorDisplay("tra_status");
      scAjaxHideErrorDisplay("ult_trecho");
      scAjaxHideErrorDisplay("tra_cia_ida");
      scAjaxHideErrorDisplay("cia_ida_dsc");
      scAjaxHideErrorDisplay("tra_numvoo_ida");
      scAjaxHideErrorDisplay("tra_origem_ida");
      scAjaxHideErrorDisplay("origem_ida_dsc");
      scAjaxHideErrorDisplay("tra_destino_ida");
      scAjaxHideErrorDisplay("destino_ida_dsc");
      scAjaxHideErrorDisplay("tra_dt_saida_ida");
      scAjaxHideErrorDisplay("tra_hr_saida_ida");
      scAjaxHideErrorDisplay("tra_dt_chegada_ida");
      scAjaxHideErrorDisplay("tra_hr_chegada_ida");
      scAjaxHideErrorDisplay("tra_localizador_ida");
      scAjaxHideErrorDisplay("tra_eticket_ida");
      scAjaxHideErrorDisplay("tra_flag_ida");
      scAjaxHideErrorDisplay("tra_cia_volta");
      scAjaxHideErrorDisplay("cia_volta_dsc");
      scAjaxHideErrorDisplay("tra_numvoo_volta");
      scAjaxHideErrorDisplay("tra_origem_volta");
      scAjaxHideErrorDisplay("origem_volta_dsc");
      scAjaxHideErrorDisplay("tra_destino_volta");
      scAjaxHideErrorDisplay("destino_volta_dsc");
      scAjaxHideErrorDisplay("tra_dt_saida_volta");
      scAjaxHideErrorDisplay("tra_hr_saida_volta");
      scAjaxHideErrorDisplay("tra_dt_chegada_volta");
      scAjaxHideErrorDisplay("tra_hr_chegada_volta");
      scAjaxHideErrorDisplay("tra_localizador_volta");
      scAjaxHideErrorDisplay("tra_eticket_volta");
      scAjaxHideErrorDisplay("tra_intervalo");
      scAjaxHideErrorDisplay("tra_hrtransout");
      scAjaxHideErrorDisplay("tra_flag_volta");
      scAjaxHideErrorDisplay("tra_dt_chegada_proprio");
      scAjaxHideErrorDisplay("tra_hr_chegada_proprio");
      scAjaxHideErrorDisplay("tra_flag_proprio");
      scAjaxHideErrorDisplay("tra_dt_ida_local");
      scAjaxHideErrorDisplay("tra_hr_ida_local");
      scAjaxHideErrorDisplay("tra_origem_ida_local");
      scAjaxHideErrorDisplay("tra_destino_ida_local");
      scAjaxHideErrorDisplay("tra_flag_ida_local");
      scAjaxHideErrorDisplay("tra_dt_volta_local");
      scAjaxHideErrorDisplay("tra_hr_volta_local");
      scAjaxHideErrorDisplay("tra_origem_volta_local");
      scAjaxHideErrorDisplay("tra_destino_volta_local");
      scAjaxHideErrorDisplay("tra_flag_volta_local");
      scAjaxHideErrorDisplay("tra_observacao");
      scAjaxHideErrorDisplay("tra_ativo");
      scAjaxHideErrorDisplay("tra_dt_alteracao");
      scAjaxHideErrorDisplay("cpf_del");
      scAjaxHideErrorDisplay("sql_log");
      scAjaxHideErrorDisplay("titulo_api");
      scAjaxHideErrorDisplay("descricao_api");
      scAjaxHideErrorDisplay("codigo_api");
      scAjaxHideErrorDisplay("tipo_api");
      scAjaxHideErrorDisplay("status_api");
      scAjaxHideErrorDisplay("valido_de_api");
      scAjaxHideErrorDisplay("valido_ate_api");
      scAjaxHideErrorDisplay("local_de_origem_api");
      scAjaxHideErrorDisplay("latitude_origem_api");
      scAjaxHideErrorDisplay("longitude_origem_api");
      scAjaxHideErrorDisplay("hr_saida_origem_api");
      scAjaxHideErrorDisplay("local_destino_api");
      scAjaxHideErrorDisplay("latitude_destino_api");
      scAjaxHideErrorDisplay("longitude_destino_api");
      scAjaxHideErrorDisplay("veiculo_api");
      scAjaxHideErrorDisplay("companhia_api");
      scAjaxHideErrorDisplay("nome_motorista_api");
      scAjaxHideErrorDisplay("contato_motorista_api");
      scAjaxHideErrorDisplay("matricula_api");
      scAjaxHideErrorDisplay("duracao_percurso_api");
      scAjaxHideErrorDisplay("comodidades_api");
      scAjaxHideErrorDisplay("observacao_api");
      scAjaxHideErrorDisplay("placa_veiculo_api");
      scAjaxHideErrorDisplay("id_evento_app");
      scAjaxHideErrorDisplay("id_participante_app");
      scAjaxHideErrorDisplay("id_voucher_app");
      scAjaxHideErrorDisplay("titulo_api_out");
      scAjaxHideErrorDisplay("descricao_api_out");
      scAjaxHideErrorDisplay("codigo_api_out");
      scAjaxHideErrorDisplay("tipo_api_out");
      scAjaxHideErrorDisplay("status_api_out");
      scAjaxHideErrorDisplay("valido_de_api_out");
      scAjaxHideErrorDisplay("valido_ate_api_out");
      scAjaxHideErrorDisplay("local_de_origem_api_out");
      scAjaxHideErrorDisplay("latitude_origem_api_out");
      scAjaxHideErrorDisplay("longitude_origem_api_out");
      scAjaxHideErrorDisplay("hr_saida_origem_api_out");
      scAjaxHideErrorDisplay("local_de_destino_api_out");
      scAjaxHideErrorDisplay("latitude_destino_api_out");
      scAjaxHideErrorDisplay("longitude_destino_api_out");
      scAjaxHideErrorDisplay("veiculo_api_out");
      scAjaxHideErrorDisplay("companhia_api_out");
      scAjaxHideErrorDisplay("nome_motorista_api_out");
      scAjaxHideErrorDisplay("contato_motorista_api_out");
      scAjaxHideErrorDisplay("matricula_api_out");
      scAjaxHideErrorDisplay("duracao_percurso_api_out");
      scAjaxHideErrorDisplay("comodidades_api_out");
      scAjaxHideErrorDisplay("observacao_api_out");
      scAjaxHideErrorDisplay("placa_veiculo_api_out");
      scAjaxHideErrorDisplay("id_evento_app_out");
      scAjaxHideErrorDisplay("id_participante_app_out");
      scAjaxHideErrorDisplay("id_voucher_app_out");
      scLigEditLookupCall();
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp']['dashboard_info']['under_dashboard']) {
?>
      var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp']['dashboard_info']['parent_widget']; ?>']");
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
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxAlert(do_ajax_form_transfer_rsvp_submit_form_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_submit_form_cb
  function do_ajax_form_transfer_rsvp_submit_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_transfer_rsvp_submit_form_cb_after_alert

  var scStatusDetail = {};

  function do_ajax_form_transfer_rsvp_navigate_form()
  {
    if (scFormHasChanged) {
      scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', perform_ajax_form_transfer_rsvp_navigate_form, function() {});
    } else {
      perform_ajax_form_transfer_rsvp_navigate_form();
    }
  }

  function perform_ajax_form_transfer_rsvp_navigate_form()
  {
    if (scRefreshTable())
    {
      return;
    }
    scAjaxHideMessage();
    scAjaxHideErrorDisplay("table");
    scAjaxHideErrorDisplay("tra_id_evento");
    scAjaxHideErrorDisplay("evento_dsc");
    scAjaxHideErrorDisplay("tra_cpf_particip");
    scAjaxHideErrorDisplay("tipo_dsc");
    scAjaxHideErrorDisplay("tra_id_usuario");
    scAjaxHideErrorDisplay("atendente_dsc");
    scAjaxHideErrorDisplay("tra_tipo");
    scAjaxHideErrorDisplay("tra_id_hotel");
    scAjaxHideErrorDisplay("hotel_dsc");
    scAjaxHideErrorDisplay("tra_id_hotel_out");
    scAjaxHideErrorDisplay("hotel_dsc_out");
    scAjaxHideErrorDisplay("enviar_app");
    scAjaxHideErrorDisplay("tra_status");
    scAjaxHideErrorDisplay("ult_trecho");
    scAjaxHideErrorDisplay("tra_cia_ida");
    scAjaxHideErrorDisplay("cia_ida_dsc");
    scAjaxHideErrorDisplay("tra_numvoo_ida");
    scAjaxHideErrorDisplay("tra_origem_ida");
    scAjaxHideErrorDisplay("origem_ida_dsc");
    scAjaxHideErrorDisplay("tra_destino_ida");
    scAjaxHideErrorDisplay("destino_ida_dsc");
    scAjaxHideErrorDisplay("tra_dt_saida_ida");
    scAjaxHideErrorDisplay("tra_hr_saida_ida");
    scAjaxHideErrorDisplay("tra_dt_chegada_ida");
    scAjaxHideErrorDisplay("tra_hr_chegada_ida");
    scAjaxHideErrorDisplay("tra_localizador_ida");
    scAjaxHideErrorDisplay("tra_eticket_ida");
    scAjaxHideErrorDisplay("tra_flag_ida");
    scAjaxHideErrorDisplay("tra_cia_volta");
    scAjaxHideErrorDisplay("cia_volta_dsc");
    scAjaxHideErrorDisplay("tra_numvoo_volta");
    scAjaxHideErrorDisplay("tra_origem_volta");
    scAjaxHideErrorDisplay("origem_volta_dsc");
    scAjaxHideErrorDisplay("tra_destino_volta");
    scAjaxHideErrorDisplay("destino_volta_dsc");
    scAjaxHideErrorDisplay("tra_dt_saida_volta");
    scAjaxHideErrorDisplay("tra_hr_saida_volta");
    scAjaxHideErrorDisplay("tra_dt_chegada_volta");
    scAjaxHideErrorDisplay("tra_hr_chegada_volta");
    scAjaxHideErrorDisplay("tra_localizador_volta");
    scAjaxHideErrorDisplay("tra_eticket_volta");
    scAjaxHideErrorDisplay("tra_intervalo");
    scAjaxHideErrorDisplay("tra_hrtransout");
    scAjaxHideErrorDisplay("tra_flag_volta");
    scAjaxHideErrorDisplay("tra_dt_chegada_proprio");
    scAjaxHideErrorDisplay("tra_hr_chegada_proprio");
    scAjaxHideErrorDisplay("tra_flag_proprio");
    scAjaxHideErrorDisplay("tra_dt_ida_local");
    scAjaxHideErrorDisplay("tra_hr_ida_local");
    scAjaxHideErrorDisplay("tra_origem_ida_local");
    scAjaxHideErrorDisplay("tra_destino_ida_local");
    scAjaxHideErrorDisplay("tra_flag_ida_local");
    scAjaxHideErrorDisplay("tra_dt_volta_local");
    scAjaxHideErrorDisplay("tra_hr_volta_local");
    scAjaxHideErrorDisplay("tra_origem_volta_local");
    scAjaxHideErrorDisplay("tra_destino_volta_local");
    scAjaxHideErrorDisplay("tra_flag_volta_local");
    scAjaxHideErrorDisplay("tra_observacao");
    scAjaxHideErrorDisplay("tra_ativo");
    scAjaxHideErrorDisplay("tra_dt_alteracao");
    scAjaxHideErrorDisplay("cpf_del");
    scAjaxHideErrorDisplay("sql_log");
    scAjaxHideErrorDisplay("titulo_api");
    scAjaxHideErrorDisplay("descricao_api");
    scAjaxHideErrorDisplay("codigo_api");
    scAjaxHideErrorDisplay("tipo_api");
    scAjaxHideErrorDisplay("status_api");
    scAjaxHideErrorDisplay("valido_de_api");
    scAjaxHideErrorDisplay("valido_ate_api");
    scAjaxHideErrorDisplay("local_de_origem_api");
    scAjaxHideErrorDisplay("latitude_origem_api");
    scAjaxHideErrorDisplay("longitude_origem_api");
    scAjaxHideErrorDisplay("hr_saida_origem_api");
    scAjaxHideErrorDisplay("local_destino_api");
    scAjaxHideErrorDisplay("latitude_destino_api");
    scAjaxHideErrorDisplay("longitude_destino_api");
    scAjaxHideErrorDisplay("veiculo_api");
    scAjaxHideErrorDisplay("companhia_api");
    scAjaxHideErrorDisplay("nome_motorista_api");
    scAjaxHideErrorDisplay("contato_motorista_api");
    scAjaxHideErrorDisplay("matricula_api");
    scAjaxHideErrorDisplay("duracao_percurso_api");
    scAjaxHideErrorDisplay("comodidades_api");
    scAjaxHideErrorDisplay("observacao_api");
    scAjaxHideErrorDisplay("placa_veiculo_api");
    scAjaxHideErrorDisplay("id_evento_app");
    scAjaxHideErrorDisplay("id_participante_app");
    scAjaxHideErrorDisplay("id_voucher_app");
    scAjaxHideErrorDisplay("titulo_api_out");
    scAjaxHideErrorDisplay("descricao_api_out");
    scAjaxHideErrorDisplay("codigo_api_out");
    scAjaxHideErrorDisplay("tipo_api_out");
    scAjaxHideErrorDisplay("status_api_out");
    scAjaxHideErrorDisplay("valido_de_api_out");
    scAjaxHideErrorDisplay("valido_ate_api_out");
    scAjaxHideErrorDisplay("local_de_origem_api_out");
    scAjaxHideErrorDisplay("latitude_origem_api_out");
    scAjaxHideErrorDisplay("longitude_origem_api_out");
    scAjaxHideErrorDisplay("hr_saida_origem_api_out");
    scAjaxHideErrorDisplay("local_de_destino_api_out");
    scAjaxHideErrorDisplay("latitude_destino_api_out");
    scAjaxHideErrorDisplay("longitude_destino_api_out");
    scAjaxHideErrorDisplay("veiculo_api_out");
    scAjaxHideErrorDisplay("companhia_api_out");
    scAjaxHideErrorDisplay("nome_motorista_api_out");
    scAjaxHideErrorDisplay("contato_motorista_api_out");
    scAjaxHideErrorDisplay("matricula_api_out");
    scAjaxHideErrorDisplay("duracao_percurso_api_out");
    scAjaxHideErrorDisplay("comodidades_api_out");
    scAjaxHideErrorDisplay("observacao_api_out");
    scAjaxHideErrorDisplay("placa_veiculo_api_out");
    scAjaxHideErrorDisplay("id_evento_app_out");
    scAjaxHideErrorDisplay("id_participante_app_out");
    scAjaxHideErrorDisplay("id_voucher_app_out");
    var var_id_transfer = document.F2.id_transfer.value;
    var var_nm_form_submit = document.F2.nm_form_submit.value;
    var var_nmgp_opcao = document.F2.nmgp_opcao.value;
    var var_nmgp_ordem = document.F2.nmgp_ordem.value;
    var var_nmgp_fast_search = document.F2.nmgp_fast_search.value;
    var var_nmgp_cond_fast_search = document.F2.nmgp_cond_fast_search.value;
    var var_nmgp_arg_fast_search = document.F2.nmgp_arg_fast_search.value;
    var var_nmgp_arg_dyn_search = document.F2.nmgp_arg_dyn_search.value;
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn();
    x_ajax_form_transfer_rsvp_navigate_form(var_id_transfer, var_nm_form_submit, var_nmgp_opcao, var_nmgp_ordem, var_nmgp_fast_search,  var_nmgp_cond_fast_search,  var_nmgp_arg_fast_search, var_nmgp_arg_dyn_search, var_script_case_init, do_ajax_form_transfer_rsvp_navigate_form_cb);
  } // do_ajax_form_transfer_rsvp_navigate_form

  var scMasterDetailParentIframe = "<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp']['dashboard_info']['parent_widget'] ?>";
  var scMasterDetailIframe = {};
<?php
foreach ($this->Ini->sc_lig_iframe as $tmp_i => $tmp_v)
{
?>
  scMasterDetailIframe["<?php echo $tmp_i; ?>"] = "<?php echo $tmp_v; ?>";
<?php
}
?>
  function do_ajax_form_transfer_rsvp_navigate_form_cb(sResp)
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
    document.F2.id_transfer.value = scAjaxGetKeyValue("id_transfer");
    scAjaxSetSummary();
    scAjaxSetNavpage();
    scAjaxShowDebug();
    scAjaxSetLabel(true);
    scAjaxSetReadonly(true);
    scAjaxSetMaster();
    scAjaxSetNavStatus("t");
    scAjaxSetNavStatus("b");
    scAjaxSetDisplay(true);
    scAjaxSetBtnVars();
    sc_change_tabs(true, 'hidden_bloco_0', 'id_tabs_0_0');
    sc_change_tabs(false, 'hidden_bloco_1', 'id_tabs_0_1');
    sc_change_tabs(false, 'hidden_bloco_2', 'id_tabs_0_2');
    sc_change_tabs(false, 'hidden_bloco_3', 'id_tabs_0_3');
    sc_change_tabs(false, 'hidden_bloco_4', 'id_tabs_0_4');
    sc_change_tabs(false, 'hidden_bloco_5', 'id_tabs_0_5');
    sc_change_tabs(false, 'hidden_bloco_6', 'id_tabs_0_6');
    sc_change_tabs(false, 'hidden_bloco_7', 'id_tabs_0_7');
    $('.sc-js-ui-statusimg').css('display', 'none');
    scAjaxAlert(do_ajax_form_transfer_rsvp_navigate_form_cb_after_alert);
  } // do_ajax_form_transfer_rsvp_navigate_form_cb
  function do_ajax_form_transfer_rsvp_navigate_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scQuickSearchKeyUp('t', null);
    $('#SC_fast_search_t').blur();
    scAjaxSetFocus();
<?php
if ($this->Embutida_form)
{
?>
    do_ajax_form_transfer_rsvp_restore_buttons();
<?php
}
?>
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_transfer_rsvp_navigate_form_cb_after_alert

  function sc_hide_form_transfer_rsvp_form()
  {
    for (var block_id in ajax_block_id) {
      $("#div_" + ajax_block_id[block_id]).hide();
    }
  } // sc_hide_form_transfer_rsvp_form


  function scAjaxDetailProc()
  {
    return true;
  } // scAjaxDetailProc


  var ajax_error_geral = "";

  var ajax_error_type = new Array("valid", "onblur", "onchange", "onclick", "onfocus");

  var ajax_field_list = new Array();
  var ajax_field_Dt_Hr = new Array();
  ajax_field_list[0] = "tra_id_evento";
  ajax_field_list[1] = "evento_dsc";
  ajax_field_list[2] = "tra_cpf_particip";
  ajax_field_list[3] = "tipo_dsc";
  ajax_field_list[4] = "tra_id_usuario";
  ajax_field_list[5] = "atendente_dsc";
  ajax_field_list[6] = "tra_tipo";
  ajax_field_list[7] = "tra_id_hotel";
  ajax_field_list[8] = "hotel_dsc";
  ajax_field_list[9] = "tra_id_hotel_out";
  ajax_field_list[10] = "hotel_dsc_out";
  ajax_field_list[11] = "enviar_app";
  ajax_field_list[12] = "tra_status";
  ajax_field_list[13] = "ult_trecho";
  ajax_field_list[14] = "tra_cia_ida";
  ajax_field_list[15] = "cia_ida_dsc";
  ajax_field_list[16] = "tra_numvoo_ida";
  ajax_field_list[17] = "tra_origem_ida";
  ajax_field_list[18] = "origem_ida_dsc";
  ajax_field_list[19] = "tra_destino_ida";
  ajax_field_list[20] = "destino_ida_dsc";
  ajax_field_list[21] = "tra_dt_saida_ida";
  ajax_field_list[22] = "tra_hr_saida_ida";
  ajax_field_list[23] = "tra_dt_chegada_ida";
  ajax_field_list[24] = "tra_hr_chegada_ida";
  ajax_field_list[25] = "tra_localizador_ida";
  ajax_field_list[26] = "tra_eticket_ida";
  ajax_field_list[27] = "tra_flag_ida";
  ajax_field_list[28] = "tra_cia_volta";
  ajax_field_list[29] = "cia_volta_dsc";
  ajax_field_list[30] = "tra_numvoo_volta";
  ajax_field_list[31] = "tra_origem_volta";
  ajax_field_list[32] = "origem_volta_dsc";
  ajax_field_list[33] = "tra_destino_volta";
  ajax_field_list[34] = "destino_volta_dsc";
  ajax_field_list[35] = "tra_dt_saida_volta";
  ajax_field_list[36] = "tra_hr_saida_volta";
  ajax_field_list[37] = "tra_dt_chegada_volta";
  ajax_field_list[38] = "tra_hr_chegada_volta";
  ajax_field_list[39] = "tra_localizador_volta";
  ajax_field_list[40] = "tra_eticket_volta";
  ajax_field_list[41] = "tra_intervalo";
  ajax_field_list[42] = "tra_hrtransout";
  ajax_field_list[43] = "tra_flag_volta";
  ajax_field_list[44] = "tra_dt_chegada_proprio";
  ajax_field_list[45] = "tra_hr_chegada_proprio";
  ajax_field_list[46] = "tra_flag_proprio";
  ajax_field_list[47] = "tra_dt_ida_local";
  ajax_field_list[48] = "tra_hr_ida_local";
  ajax_field_list[49] = "tra_origem_ida_local";
  ajax_field_list[50] = "tra_destino_ida_local";
  ajax_field_list[51] = "tra_flag_ida_local";
  ajax_field_list[52] = "tra_dt_volta_local";
  ajax_field_list[53] = "tra_hr_volta_local";
  ajax_field_list[54] = "tra_origem_volta_local";
  ajax_field_list[55] = "tra_destino_volta_local";
  ajax_field_list[56] = "tra_flag_volta_local";
  ajax_field_list[57] = "tra_observacao";
  ajax_field_list[58] = "tra_ativo";
  ajax_field_list[59] = "tra_dt_alteracao";
  ajax_field_list[60] = "cpf_del";
  ajax_field_list[61] = "sql_log";
  ajax_field_list[62] = "titulo_api";
  ajax_field_list[63] = "descricao_api";
  ajax_field_list[64] = "codigo_api";
  ajax_field_list[65] = "tipo_api";
  ajax_field_list[66] = "status_api";
  ajax_field_list[67] = "valido_de_api";
  ajax_field_list[68] = "valido_ate_api";
  ajax_field_list[69] = "local_de_origem_api";
  ajax_field_list[70] = "latitude_origem_api";
  ajax_field_list[71] = "longitude_origem_api";
  ajax_field_list[72] = "hr_saida_origem_api";
  ajax_field_list[73] = "local_destino_api";
  ajax_field_list[74] = "latitude_destino_api";
  ajax_field_list[75] = "longitude_destino_api";
  ajax_field_list[76] = "veiculo_api";
  ajax_field_list[77] = "companhia_api";
  ajax_field_list[78] = "nome_motorista_api";
  ajax_field_list[79] = "contato_motorista_api";
  ajax_field_list[80] = "matricula_api";
  ajax_field_list[81] = "duracao_percurso_api";
  ajax_field_list[82] = "comodidades_api";
  ajax_field_list[83] = "observacao_api";
  ajax_field_list[84] = "placa_veiculo_api";
  ajax_field_list[85] = "id_evento_app";
  ajax_field_list[86] = "id_participante_app";
  ajax_field_list[87] = "id_voucher_app";
  ajax_field_list[88] = "titulo_api_out";
  ajax_field_list[89] = "descricao_api_out";
  ajax_field_list[90] = "codigo_api_out";
  ajax_field_list[91] = "tipo_api_out";
  ajax_field_list[92] = "status_api_out";
  ajax_field_list[93] = "valido_de_api_out";
  ajax_field_list[94] = "valido_ate_api_out";
  ajax_field_list[95] = "local_de_origem_api_out";
  ajax_field_list[96] = "latitude_origem_api_out";
  ajax_field_list[97] = "longitude_origem_api_out";
  ajax_field_list[98] = "hr_saida_origem_api_out";
  ajax_field_list[99] = "local_de_destino_api_out";
  ajax_field_list[100] = "latitude_destino_api_out";
  ajax_field_list[101] = "longitude_destino_api_out";
  ajax_field_list[102] = "veiculo_api_out";
  ajax_field_list[103] = "companhia_api_out";
  ajax_field_list[104] = "nome_motorista_api_out";
  ajax_field_list[105] = "contato_motorista_api_out";
  ajax_field_list[106] = "matricula_api_out";
  ajax_field_list[107] = "duracao_percurso_api_out";
  ajax_field_list[108] = "comodidades_api_out";
  ajax_field_list[109] = "observacao_api_out";
  ajax_field_list[110] = "placa_veiculo_api_out";
  ajax_field_list[111] = "id_evento_app_out";
  ajax_field_list[112] = "id_participante_app_out";
  ajax_field_list[113] = "id_voucher_app_out";

  var ajax_block_list = new Array();
  ajax_block_list[0] = "0";
  ajax_block_list[1] = "1";
  ajax_block_list[2] = "2";
  ajax_block_list[3] = "3";
  ajax_block_list[4] = "4";
  ajax_block_list[5] = "5";
  ajax_block_list[6] = "6";
  ajax_block_list[7] = "7";

  var ajax_error_list = {
    "tra_id_evento": {"label": "Cód. Evento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_dsc": {"label": "Evento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_cpf_particip": {"label": "ID Participante:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tipo_dsc": {"label": "Tipo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_id_usuario": {"label": "Cód. Atendente:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "atendente_dsc": {"label": "Atendente:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_tipo": {"label": "Tipo Transfer:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_id_hotel": {"label": "Cód. Hotel In:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_dsc": {"label": "Hotel In:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_id_hotel_out": {"label": "Cód. Hotel Out:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hotel_dsc_out": {"label": "Hotel Out:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "enviar_app": {"label": "Gravar no APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_status": {"label": "Status Transfer:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "ult_trecho": {"label": "Nùm. Ult. Trecho Aéreo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_cia_ida": {"label": "Cód. Cia Aérea:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cia_ida_dsc": {"label": "Cia. Aérea:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_numvoo_ida": {"label": "Num. Voo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_origem_ida": {"label": "Cód. Origerm:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "origem_ida_dsc": {"label": "Origem:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_destino_ida": {"label": "Cód. Destino:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "destino_ida_dsc": {"label": "Destino:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_dt_saida_ida": {"label": "Data Saída:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_hr_saida_ida": {"label": "Hora Saída:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_dt_chegada_ida": {"label": "Data Chegada:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_hr_chegada_ida": {"label": "Hora Chegada:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_localizador_ida": {"label": "Localizador: ", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_eticket_ida": {"label": "E-Ticket:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_flag_ida": {"label": "IDA:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_cia_volta": {"label": "Cód. Cia Aérea:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cia_volta_dsc": {"label": "Cia Aérea:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_numvoo_volta": {"label": "Cód. Voo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_origem_volta": {"label": "Cód. Origem:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "origem_volta_dsc": {"label": "Origem:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_destino_volta": {"label": "Cód. Destino:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "destino_volta_dsc": {"label": "Destino:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_dt_saida_volta": {"label": "Data Saída:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_hr_saida_volta": {"label": "Hora Saída:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_dt_chegada_volta": {"label": "Data Chegada:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_hr_chegada_volta": {"label": "Hora Chegada:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_localizador_volta": {"label": "Localizador:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_eticket_volta": {"label": "E-Ticket:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_intervalo": {"label": "Intervalo Tr. Out:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_hrtransout": {"label": "Hr. Transfer Out:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_flag_volta": {"label": "VOLTA:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_dt_chegada_proprio": {"label": "Data Chegada:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_hr_chegada_proprio": {"label": "Hora Chegada:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_flag_proprio": {"label": "Próprio", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_dt_ida_local": {"label": "Data Ida:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_hr_ida_local": {"label": "Hora Ida:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_origem_ida_local": {"label": "Origem Ida: ", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_destino_ida_local": {"label": "Destino Ida:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_flag_ida_local": {"label": "IDA:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_dt_volta_local": {"label": "Data Volta:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_hr_volta_local": {"label": "Hora Volta:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_origem_volta_local": {"label": "Origem Volta:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_destino_volta_local": {"label": "Destino Volta: ", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_flag_volta_local": {"label": "VOLTA:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_observacao": {"label": "Observações:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_ativo": {"label": "Registro Ativo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tra_dt_alteracao": {"label": "Alterado em:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cpf_del": {"label": "cpf_del", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "sql_log": {"label": "sql_log", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "titulo_api": {"label": "Título API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "descricao_api": {"label": "Descrição API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "codigo_api": {"label": "Código API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tipo_api": {"label": "Tipo API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "status_api": {"label": "Status API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "valido_de_api": {"label": "Válido de API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "valido_ate_api": {"label": "Válido até API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "local_de_origem_api": {"label": "Local De Origem API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "latitude_origem_api": {"label": "Latitude Origem API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "longitude_origem_api": {"label": "Longitude Origem API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hr_saida_origem_api": {"label": "Hr. Saída Origem API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "local_destino_api": {"label": "Local Destino API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "latitude_destino_api": {"label": "Latitude Destino API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "longitude_destino_api": {"label": "Longitude Destino API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "veiculo_api": {"label": "Veículo API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "companhia_api": {"label": "Companhia API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "nome_motorista_api": {"label": "Nome Motorista API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "contato_motorista_api": {"label": "Contato Motorista APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "matricula_api": {"label": "Matrícula API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "duracao_percurso_api": {"label": "Duração do Percurso API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "comodidades_api": {"label": "Comodidades API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "observacao_api": {"label": "Observação API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "placa_veiculo_api": {"label": "Placa Veículo API:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_evento_app": {"label": "Id Evento App:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_participante_app": {"label": "Id Participante App:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_voucher_app": {"label": "Id Voucher App:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "titulo_api_out": {"label": "Título API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "descricao_api_out": {"label": "Descrição API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "codigo_api_out": {"label": "Código API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tipo_api_out": {"label": "Tipo API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "status_api_out": {"label": "Status API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "valido_de_api_out": {"label": "Válido de API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "valido_ate_api_out": {"label": "Válido Até API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "local_de_origem_api_out": {"label": "Local De Origem API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "latitude_origem_api_out": {"label": "Latitude Origem API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "longitude_origem_api_out": {"label": "Longitude Origem API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hr_saida_origem_api_out": {"label": "Hr Saída Origem API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "local_de_destino_api_out": {"label": "Local Destino API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "latitude_destino_api_out": {"label": "Latitude Destino API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "longitude_destino_api_out": {"label": "Longitude Destino API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "veiculo_api_out": {"label": "Veículo API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "companhia_api_out": {"label": "Companhia API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "nome_motorista_api_out": {"label": "Nome Motorista API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "contato_motorista_api_out": {"label": "Contato Motorista API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "matricula_api_out": {"label": "Matricula API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "duracao_percurso_api_out": {"label": "Duração Percurso API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "comodidades_api_out": {"label": "Comodidades API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "observacao_api_out": {"label": "Observação API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "placa_veiculo_api_out": {"label": "Placa Veículo API OUT:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_evento_app_out": {"label": "Id Evento App Out:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_participante_app_out": {"label": "Id Participante App Out:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_voucher_app_out": {"label": "Id Voucher App Out:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0}
  };
  var ajax_error_timeout = 0;

  var ajax_block_id = {
    "0": "hidden_bloco_0",
    "1": "hidden_bloco_1",
    "2": "hidden_bloco_2",
    "3": "hidden_bloco_3",
    "4": "hidden_bloco_4",
    "5": "hidden_bloco_5",
    "6": "hidden_bloco_6",
    "7": "hidden_bloco_7"
  };

  var ajax_block_tab = {
    "hidden_bloco_0": "id_tabs_0_0",
    "hidden_bloco_1": "id_tabs_0_1",
    "hidden_bloco_2": "id_tabs_0_2",
    "hidden_bloco_3": "id_tabs_0_3",
    "hidden_bloco_4": "id_tabs_0_4",
    "hidden_bloco_5": "id_tabs_0_5",
    "hidden_bloco_6": "id_tabs_0_6",
    "hidden_bloco_7": "id_tabs_0_7"
  };

  var ajax_field_mult = {
    "tra_id_evento": new Array(),
    "evento_dsc": new Array(),
    "tra_cpf_particip": new Array(),
    "tipo_dsc": new Array(),
    "tra_id_usuario": new Array(),
    "atendente_dsc": new Array(),
    "tra_tipo": new Array(),
    "tra_id_hotel": new Array(),
    "hotel_dsc": new Array(),
    "tra_id_hotel_out": new Array(),
    "hotel_dsc_out": new Array(),
    "enviar_app": new Array(),
    "tra_status": new Array(),
    "ult_trecho": new Array(),
    "tra_cia_ida": new Array(),
    "cia_ida_dsc": new Array(),
    "tra_numvoo_ida": new Array(),
    "tra_origem_ida": new Array(),
    "origem_ida_dsc": new Array(),
    "tra_destino_ida": new Array(),
    "destino_ida_dsc": new Array(),
    "tra_dt_saida_ida": new Array(),
    "tra_hr_saida_ida": new Array(),
    "tra_dt_chegada_ida": new Array(),
    "tra_hr_chegada_ida": new Array(),
    "tra_localizador_ida": new Array(),
    "tra_eticket_ida": new Array(),
    "tra_flag_ida": new Array(),
    "tra_cia_volta": new Array(),
    "cia_volta_dsc": new Array(),
    "tra_numvoo_volta": new Array(),
    "tra_origem_volta": new Array(),
    "origem_volta_dsc": new Array(),
    "tra_destino_volta": new Array(),
    "destino_volta_dsc": new Array(),
    "tra_dt_saida_volta": new Array(),
    "tra_hr_saida_volta": new Array(),
    "tra_dt_chegada_volta": new Array(),
    "tra_hr_chegada_volta": new Array(),
    "tra_localizador_volta": new Array(),
    "tra_eticket_volta": new Array(),
    "tra_intervalo": new Array(),
    "tra_hrtransout": new Array(),
    "tra_flag_volta": new Array(),
    "tra_dt_chegada_proprio": new Array(),
    "tra_hr_chegada_proprio": new Array(),
    "tra_flag_proprio": new Array(),
    "tra_dt_ida_local": new Array(),
    "tra_hr_ida_local": new Array(),
    "tra_origem_ida_local": new Array(),
    "tra_destino_ida_local": new Array(),
    "tra_flag_ida_local": new Array(),
    "tra_dt_volta_local": new Array(),
    "tra_hr_volta_local": new Array(),
    "tra_origem_volta_local": new Array(),
    "tra_destino_volta_local": new Array(),
    "tra_flag_volta_local": new Array(),
    "tra_observacao": new Array(),
    "tra_ativo": new Array(),
    "tra_dt_alteracao": new Array(),
    "cpf_del": new Array(),
    "sql_log": new Array(),
    "titulo_api": new Array(),
    "descricao_api": new Array(),
    "codigo_api": new Array(),
    "tipo_api": new Array(),
    "status_api": new Array(),
    "valido_de_api": new Array(),
    "valido_ate_api": new Array(),
    "local_de_origem_api": new Array(),
    "latitude_origem_api": new Array(),
    "longitude_origem_api": new Array(),
    "hr_saida_origem_api": new Array(),
    "local_destino_api": new Array(),
    "latitude_destino_api": new Array(),
    "longitude_destino_api": new Array(),
    "veiculo_api": new Array(),
    "companhia_api": new Array(),
    "nome_motorista_api": new Array(),
    "contato_motorista_api": new Array(),
    "matricula_api": new Array(),
    "duracao_percurso_api": new Array(),
    "comodidades_api": new Array(),
    "observacao_api": new Array(),
    "placa_veiculo_api": new Array(),
    "id_evento_app": new Array(),
    "id_participante_app": new Array(),
    "id_voucher_app": new Array(),
    "titulo_api_out": new Array(),
    "descricao_api_out": new Array(),
    "codigo_api_out": new Array(),
    "tipo_api_out": new Array(),
    "status_api_out": new Array(),
    "valido_de_api_out": new Array(),
    "valido_ate_api_out": new Array(),
    "local_de_origem_api_out": new Array(),
    "latitude_origem_api_out": new Array(),
    "longitude_origem_api_out": new Array(),
    "hr_saida_origem_api_out": new Array(),
    "local_de_destino_api_out": new Array(),
    "latitude_destino_api_out": new Array(),
    "longitude_destino_api_out": new Array(),
    "veiculo_api_out": new Array(),
    "companhia_api_out": new Array(),
    "nome_motorista_api_out": new Array(),
    "contato_motorista_api_out": new Array(),
    "matricula_api_out": new Array(),
    "duracao_percurso_api_out": new Array(),
    "comodidades_api_out": new Array(),
    "observacao_api_out": new Array(),
    "placa_veiculo_api_out": new Array(),
    "id_evento_app_out": new Array(),
    "id_participante_app_out": new Array(),
    "id_voucher_app_out": new Array()
  };
  ajax_field_mult["tra_id_evento"][1] = "tra_id_evento";
  ajax_field_mult["evento_dsc"][1] = "evento_dsc";
  ajax_field_mult["tra_cpf_particip"][1] = "tra_cpf_particip";
  ajax_field_mult["tipo_dsc"][1] = "tipo_dsc";
  ajax_field_mult["tra_id_usuario"][1] = "tra_id_usuario";
  ajax_field_mult["atendente_dsc"][1] = "atendente_dsc";
  ajax_field_mult["tra_tipo"][1] = "tra_tipo";
  ajax_field_mult["tra_id_hotel"][1] = "tra_id_hotel";
  ajax_field_mult["hotel_dsc"][1] = "hotel_dsc";
  ajax_field_mult["tra_id_hotel_out"][1] = "tra_id_hotel_out";
  ajax_field_mult["hotel_dsc_out"][1] = "hotel_dsc_out";
  ajax_field_mult["enviar_app"][1] = "enviar_app";
  ajax_field_mult["tra_status"][1] = "tra_status";
  ajax_field_mult["ult_trecho"][1] = "ult_trecho";
  ajax_field_mult["tra_cia_ida"][1] = "tra_cia_ida";
  ajax_field_mult["cia_ida_dsc"][1] = "cia_ida_dsc";
  ajax_field_mult["tra_numvoo_ida"][1] = "tra_numvoo_ida";
  ajax_field_mult["tra_origem_ida"][1] = "tra_origem_ida";
  ajax_field_mult["origem_ida_dsc"][1] = "origem_ida_dsc";
  ajax_field_mult["tra_destino_ida"][1] = "tra_destino_ida";
  ajax_field_mult["destino_ida_dsc"][1] = "destino_ida_dsc";
  ajax_field_mult["tra_dt_saida_ida"][1] = "tra_dt_saida_ida";
  ajax_field_mult["tra_hr_saida_ida"][1] = "tra_hr_saida_ida";
  ajax_field_mult["tra_dt_chegada_ida"][1] = "tra_dt_chegada_ida";
  ajax_field_mult["tra_hr_chegada_ida"][1] = "tra_hr_chegada_ida";
  ajax_field_mult["tra_localizador_ida"][1] = "tra_localizador_ida";
  ajax_field_mult["tra_eticket_ida"][1] = "tra_eticket_ida";
  ajax_field_mult["tra_flag_ida"][1] = "tra_flag_ida";
  ajax_field_mult["tra_cia_volta"][1] = "tra_cia_volta";
  ajax_field_mult["cia_volta_dsc"][1] = "cia_volta_dsc";
  ajax_field_mult["tra_numvoo_volta"][1] = "tra_numvoo_volta";
  ajax_field_mult["tra_origem_volta"][1] = "tra_origem_volta";
  ajax_field_mult["origem_volta_dsc"][1] = "origem_volta_dsc";
  ajax_field_mult["tra_destino_volta"][1] = "tra_destino_volta";
  ajax_field_mult["destino_volta_dsc"][1] = "destino_volta_dsc";
  ajax_field_mult["tra_dt_saida_volta"][1] = "tra_dt_saida_volta";
  ajax_field_mult["tra_hr_saida_volta"][1] = "tra_hr_saida_volta";
  ajax_field_mult["tra_dt_chegada_volta"][1] = "tra_dt_chegada_volta";
  ajax_field_mult["tra_hr_chegada_volta"][1] = "tra_hr_chegada_volta";
  ajax_field_mult["tra_localizador_volta"][1] = "tra_localizador_volta";
  ajax_field_mult["tra_eticket_volta"][1] = "tra_eticket_volta";
  ajax_field_mult["tra_intervalo"][1] = "tra_intervalo";
  ajax_field_mult["tra_hrtransout"][1] = "tra_hrtransout";
  ajax_field_mult["tra_flag_volta"][1] = "tra_flag_volta";
  ajax_field_mult["tra_dt_chegada_proprio"][1] = "tra_dt_chegada_proprio";
  ajax_field_mult["tra_hr_chegada_proprio"][1] = "tra_hr_chegada_proprio";
  ajax_field_mult["tra_flag_proprio"][1] = "tra_flag_proprio";
  ajax_field_mult["tra_dt_ida_local"][1] = "tra_dt_ida_local";
  ajax_field_mult["tra_hr_ida_local"][1] = "tra_hr_ida_local";
  ajax_field_mult["tra_origem_ida_local"][1] = "tra_origem_ida_local";
  ajax_field_mult["tra_destino_ida_local"][1] = "tra_destino_ida_local";
  ajax_field_mult["tra_flag_ida_local"][1] = "tra_flag_ida_local";
  ajax_field_mult["tra_dt_volta_local"][1] = "tra_dt_volta_local";
  ajax_field_mult["tra_hr_volta_local"][1] = "tra_hr_volta_local";
  ajax_field_mult["tra_origem_volta_local"][1] = "tra_origem_volta_local";
  ajax_field_mult["tra_destino_volta_local"][1] = "tra_destino_volta_local";
  ajax_field_mult["tra_flag_volta_local"][1] = "tra_flag_volta_local";
  ajax_field_mult["tra_observacao"][1] = "tra_observacao";
  ajax_field_mult["tra_ativo"][1] = "tra_ativo";
  ajax_field_mult["tra_dt_alteracao"][1] = "tra_dt_alteracao";
  ajax_field_mult["cpf_del"][1] = "cpf_del";
  ajax_field_mult["sql_log"][1] = "sql_log";
  ajax_field_mult["titulo_api"][1] = "titulo_api";
  ajax_field_mult["descricao_api"][1] = "descricao_api";
  ajax_field_mult["codigo_api"][1] = "codigo_api";
  ajax_field_mult["tipo_api"][1] = "tipo_api";
  ajax_field_mult["status_api"][1] = "status_api";
  ajax_field_mult["valido_de_api"][1] = "valido_de_api";
  ajax_field_mult["valido_ate_api"][1] = "valido_ate_api";
  ajax_field_mult["local_de_origem_api"][1] = "local_de_origem_api";
  ajax_field_mult["latitude_origem_api"][1] = "latitude_origem_api";
  ajax_field_mult["longitude_origem_api"][1] = "longitude_origem_api";
  ajax_field_mult["hr_saida_origem_api"][1] = "hr_saida_origem_api";
  ajax_field_mult["local_destino_api"][1] = "local_destino_api";
  ajax_field_mult["latitude_destino_api"][1] = "latitude_destino_api";
  ajax_field_mult["longitude_destino_api"][1] = "longitude_destino_api";
  ajax_field_mult["veiculo_api"][1] = "veiculo_api";
  ajax_field_mult["companhia_api"][1] = "companhia_api";
  ajax_field_mult["nome_motorista_api"][1] = "nome_motorista_api";
  ajax_field_mult["contato_motorista_api"][1] = "contato_motorista_api";
  ajax_field_mult["matricula_api"][1] = "matricula_api";
  ajax_field_mult["duracao_percurso_api"][1] = "duracao_percurso_api";
  ajax_field_mult["comodidades_api"][1] = "comodidades_api";
  ajax_field_mult["observacao_api"][1] = "observacao_api";
  ajax_field_mult["placa_veiculo_api"][1] = "placa_veiculo_api";
  ajax_field_mult["id_evento_app"][1] = "id_evento_app";
  ajax_field_mult["id_participante_app"][1] = "id_participante_app";
  ajax_field_mult["id_voucher_app"][1] = "id_voucher_app";
  ajax_field_mult["titulo_api_out"][1] = "titulo_api_out";
  ajax_field_mult["descricao_api_out"][1] = "descricao_api_out";
  ajax_field_mult["codigo_api_out"][1] = "codigo_api_out";
  ajax_field_mult["tipo_api_out"][1] = "tipo_api_out";
  ajax_field_mult["status_api_out"][1] = "status_api_out";
  ajax_field_mult["valido_de_api_out"][1] = "valido_de_api_out";
  ajax_field_mult["valido_ate_api_out"][1] = "valido_ate_api_out";
  ajax_field_mult["local_de_origem_api_out"][1] = "local_de_origem_api_out";
  ajax_field_mult["latitude_origem_api_out"][1] = "latitude_origem_api_out";
  ajax_field_mult["longitude_origem_api_out"][1] = "longitude_origem_api_out";
  ajax_field_mult["hr_saida_origem_api_out"][1] = "hr_saida_origem_api_out";
  ajax_field_mult["local_de_destino_api_out"][1] = "local_de_destino_api_out";
  ajax_field_mult["latitude_destino_api_out"][1] = "latitude_destino_api_out";
  ajax_field_mult["longitude_destino_api_out"][1] = "longitude_destino_api_out";
  ajax_field_mult["veiculo_api_out"][1] = "veiculo_api_out";
  ajax_field_mult["companhia_api_out"][1] = "companhia_api_out";
  ajax_field_mult["nome_motorista_api_out"][1] = "nome_motorista_api_out";
  ajax_field_mult["contato_motorista_api_out"][1] = "contato_motorista_api_out";
  ajax_field_mult["matricula_api_out"][1] = "matricula_api_out";
  ajax_field_mult["duracao_percurso_api_out"][1] = "duracao_percurso_api_out";
  ajax_field_mult["comodidades_api_out"][1] = "comodidades_api_out";
  ajax_field_mult["observacao_api_out"][1] = "observacao_api_out";
  ajax_field_mult["placa_veiculo_api_out"][1] = "placa_veiculo_api_out";
  ajax_field_mult["id_evento_app_out"][1] = "id_evento_app_out";
  ajax_field_mult["id_participante_app_out"][1] = "id_participante_app_out";
  ajax_field_mult["id_voucher_app_out"][1] = "id_voucher_app_out";

  var ajax_field_id = {
    "tra_id_evento": new Array("hidden_field_label_tra_id_evento", "hidden_field_data_tra_id_evento"),
    "evento_dsc": new Array("hidden_field_label_evento_dsc", "hidden_field_data_evento_dsc"),
    "tra_cpf_particip": new Array("hidden_field_label_tra_cpf_particip", "hidden_field_data_tra_cpf_particip"),
    "tipo_dsc": new Array("hidden_field_label_tipo_dsc", "hidden_field_data_tipo_dsc"),
    "tra_id_usuario": new Array("hidden_field_label_tra_id_usuario", "hidden_field_data_tra_id_usuario"),
    "atendente_dsc": new Array("hidden_field_label_atendente_dsc", "hidden_field_data_atendente_dsc"),
    "tra_tipo": new Array("hidden_field_label_tra_tipo", "hidden_field_data_tra_tipo"),
    "tra_id_hotel": new Array("hidden_field_label_tra_id_hotel", "hidden_field_data_tra_id_hotel"),
    "hotel_dsc": new Array("hidden_field_label_hotel_dsc", "hidden_field_data_hotel_dsc"),
    "tra_id_hotel_out": new Array("hidden_field_label_tra_id_hotel_out", "hidden_field_data_tra_id_hotel_out"),
    "hotel_dsc_out": new Array("hidden_field_label_hotel_dsc_out", "hidden_field_data_hotel_dsc_out"),
    "enviar_app": new Array("hidden_field_label_enviar_app", "hidden_field_data_enviar_app"),
    "tra_status": new Array("hidden_field_label_tra_status", "hidden_field_data_tra_status"),
    "ult_trecho": new Array("hidden_field_label_ult_trecho", "hidden_field_data_ult_trecho"),
    "tra_cia_ida": new Array("hidden_field_label_tra_cia_ida", "hidden_field_data_tra_cia_ida"),
    "cia_ida_dsc": new Array("hidden_field_label_cia_ida_dsc", "hidden_field_data_cia_ida_dsc"),
    "tra_numvoo_ida": new Array("hidden_field_label_tra_numvoo_ida", "hidden_field_data_tra_numvoo_ida"),
    "tra_origem_ida": new Array("hidden_field_label_tra_origem_ida", "hidden_field_data_tra_origem_ida"),
    "origem_ida_dsc": new Array("hidden_field_label_origem_ida_dsc", "hidden_field_data_origem_ida_dsc"),
    "tra_destino_ida": new Array("hidden_field_label_tra_destino_ida", "hidden_field_data_tra_destino_ida"),
    "destino_ida_dsc": new Array("hidden_field_label_destino_ida_dsc", "hidden_field_data_destino_ida_dsc"),
    "tra_dt_saida_ida": new Array("hidden_field_label_tra_dt_saida_ida", "hidden_field_data_tra_dt_saida_ida"),
    "tra_hr_saida_ida": new Array("hidden_field_label_tra_hr_saida_ida", "hidden_field_data_tra_hr_saida_ida"),
    "tra_dt_chegada_ida": new Array("hidden_field_label_tra_dt_chegada_ida", "hidden_field_data_tra_dt_chegada_ida"),
    "tra_hr_chegada_ida": new Array("hidden_field_label_tra_hr_chegada_ida", "hidden_field_data_tra_hr_chegada_ida"),
    "tra_localizador_ida": new Array("hidden_field_label_tra_localizador_ida", "hidden_field_data_tra_localizador_ida"),
    "tra_eticket_ida": new Array("hidden_field_label_tra_eticket_ida", "hidden_field_data_tra_eticket_ida"),
    "tra_flag_ida": new Array("hidden_field_label_tra_flag_ida", "hidden_field_data_tra_flag_ida"),
    "tra_cia_volta": new Array("hidden_field_label_tra_cia_volta", "hidden_field_data_tra_cia_volta"),
    "cia_volta_dsc": new Array("hidden_field_label_cia_volta_dsc", "hidden_field_data_cia_volta_dsc"),
    "tra_numvoo_volta": new Array("hidden_field_label_tra_numvoo_volta", "hidden_field_data_tra_numvoo_volta"),
    "tra_origem_volta": new Array("hidden_field_label_tra_origem_volta", "hidden_field_data_tra_origem_volta"),
    "origem_volta_dsc": new Array("hidden_field_label_origem_volta_dsc", "hidden_field_data_origem_volta_dsc"),
    "tra_destino_volta": new Array("hidden_field_label_tra_destino_volta", "hidden_field_data_tra_destino_volta"),
    "destino_volta_dsc": new Array("hidden_field_label_destino_volta_dsc", "hidden_field_data_destino_volta_dsc"),
    "tra_dt_saida_volta": new Array("hidden_field_label_tra_dt_saida_volta", "hidden_field_data_tra_dt_saida_volta"),
    "tra_hr_saida_volta": new Array("hidden_field_label_tra_hr_saida_volta", "hidden_field_data_tra_hr_saida_volta"),
    "tra_dt_chegada_volta": new Array("hidden_field_label_tra_dt_chegada_volta", "hidden_field_data_tra_dt_chegada_volta"),
    "tra_hr_chegada_volta": new Array("hidden_field_label_tra_hr_chegada_volta", "hidden_field_data_tra_hr_chegada_volta"),
    "tra_localizador_volta": new Array("hidden_field_label_tra_localizador_volta", "hidden_field_data_tra_localizador_volta"),
    "tra_eticket_volta": new Array("hidden_field_label_tra_eticket_volta", "hidden_field_data_tra_eticket_volta"),
    "tra_intervalo": new Array("hidden_field_label_tra_intervalo", "hidden_field_data_tra_intervalo"),
    "tra_hrtransout": new Array("hidden_field_label_tra_hrtransout", "hidden_field_data_tra_hrtransout"),
    "tra_flag_volta": new Array("hidden_field_label_tra_flag_volta", "hidden_field_data_tra_flag_volta"),
    "tra_dt_chegada_proprio": new Array("hidden_field_label_tra_dt_chegada_proprio", "hidden_field_data_tra_dt_chegada_proprio"),
    "tra_hr_chegada_proprio": new Array("hidden_field_label_tra_hr_chegada_proprio", "hidden_field_data_tra_hr_chegada_proprio"),
    "tra_flag_proprio": new Array("hidden_field_label_tra_flag_proprio", "hidden_field_data_tra_flag_proprio"),
    "tra_dt_ida_local": new Array("hidden_field_label_tra_dt_ida_local", "hidden_field_data_tra_dt_ida_local"),
    "tra_hr_ida_local": new Array("hidden_field_label_tra_hr_ida_local", "hidden_field_data_tra_hr_ida_local"),
    "tra_origem_ida_local": new Array("hidden_field_label_tra_origem_ida_local", "hidden_field_data_tra_origem_ida_local"),
    "tra_destino_ida_local": new Array("hidden_field_label_tra_destino_ida_local", "hidden_field_data_tra_destino_ida_local"),
    "tra_flag_ida_local": new Array("hidden_field_label_tra_flag_ida_local", "hidden_field_data_tra_flag_ida_local"),
    "tra_dt_volta_local": new Array("hidden_field_label_tra_dt_volta_local", "hidden_field_data_tra_dt_volta_local"),
    "tra_hr_volta_local": new Array("hidden_field_label_tra_hr_volta_local", "hidden_field_data_tra_hr_volta_local"),
    "tra_origem_volta_local": new Array("hidden_field_label_tra_origem_volta_local", "hidden_field_data_tra_origem_volta_local"),
    "tra_destino_volta_local": new Array("hidden_field_label_tra_destino_volta_local", "hidden_field_data_tra_destino_volta_local"),
    "tra_flag_volta_local": new Array("hidden_field_label_tra_flag_volta_local", "hidden_field_data_tra_flag_volta_local"),
    "tra_observacao": new Array("hidden_field_label_tra_observacao", "hidden_field_data_tra_observacao"),
    "tra_ativo": new Array("hidden_field_label_tra_ativo", "hidden_field_data_tra_ativo"),
    "tra_dt_alteracao": new Array("hidden_field_label_tra_dt_alteracao", "hidden_field_data_tra_dt_alteracao"),
    "titulo_api": new Array("hidden_field_label_titulo_api", "hidden_field_data_titulo_api"),
    "descricao_api": new Array("hidden_field_label_descricao_api", "hidden_field_data_descricao_api"),
    "codigo_api": new Array("hidden_field_label_codigo_api", "hidden_field_data_codigo_api"),
    "tipo_api": new Array("hidden_field_label_tipo_api", "hidden_field_data_tipo_api"),
    "status_api": new Array("hidden_field_label_status_api", "hidden_field_data_status_api"),
    "valido_de_api": new Array("hidden_field_label_valido_de_api", "hidden_field_data_valido_de_api"),
    "valido_ate_api": new Array("hidden_field_label_valido_ate_api", "hidden_field_data_valido_ate_api"),
    "local_de_origem_api": new Array("hidden_field_label_local_de_origem_api", "hidden_field_data_local_de_origem_api"),
    "latitude_origem_api": new Array("hidden_field_label_latitude_origem_api", "hidden_field_data_latitude_origem_api"),
    "longitude_origem_api": new Array("hidden_field_label_longitude_origem_api", "hidden_field_data_longitude_origem_api"),
    "hr_saida_origem_api": new Array("hidden_field_label_hr_saida_origem_api", "hidden_field_data_hr_saida_origem_api"),
    "local_destino_api": new Array("hidden_field_label_local_destino_api", "hidden_field_data_local_destino_api"),
    "latitude_destino_api": new Array("hidden_field_label_latitude_destino_api", "hidden_field_data_latitude_destino_api"),
    "longitude_destino_api": new Array("hidden_field_label_longitude_destino_api", "hidden_field_data_longitude_destino_api"),
    "veiculo_api": new Array("hidden_field_label_veiculo_api", "hidden_field_data_veiculo_api"),
    "companhia_api": new Array("hidden_field_label_companhia_api", "hidden_field_data_companhia_api"),
    "nome_motorista_api": new Array("hidden_field_label_nome_motorista_api", "hidden_field_data_nome_motorista_api"),
    "contato_motorista_api": new Array("hidden_field_label_contato_motorista_api", "hidden_field_data_contato_motorista_api"),
    "matricula_api": new Array("hidden_field_label_matricula_api", "hidden_field_data_matricula_api"),
    "duracao_percurso_api": new Array("hidden_field_label_duracao_percurso_api", "hidden_field_data_duracao_percurso_api"),
    "comodidades_api": new Array("hidden_field_label_comodidades_api", "hidden_field_data_comodidades_api"),
    "observacao_api": new Array("hidden_field_label_observacao_api", "hidden_field_data_observacao_api"),
    "placa_veiculo_api": new Array("hidden_field_label_placa_veiculo_api", "hidden_field_data_placa_veiculo_api"),
    "id_evento_app": new Array("hidden_field_label_id_evento_app", "hidden_field_data_id_evento_app"),
    "id_participante_app": new Array("hidden_field_label_id_participante_app", "hidden_field_data_id_participante_app"),
    "id_voucher_app": new Array("hidden_field_label_id_voucher_app", "hidden_field_data_id_voucher_app"),
    "titulo_api_out": new Array("hidden_field_label_titulo_api_out", "hidden_field_data_titulo_api_out"),
    "descricao_api_out": new Array("hidden_field_label_descricao_api_out", "hidden_field_data_descricao_api_out"),
    "codigo_api_out": new Array("hidden_field_label_codigo_api_out", "hidden_field_data_codigo_api_out"),
    "tipo_api_out": new Array("hidden_field_label_tipo_api_out", "hidden_field_data_tipo_api_out"),
    "status_api_out": new Array("hidden_field_label_status_api_out", "hidden_field_data_status_api_out"),
    "valido_de_api_out": new Array("hidden_field_label_valido_de_api_out", "hidden_field_data_valido_de_api_out"),
    "valido_ate_api_out": new Array("hidden_field_label_valido_ate_api_out", "hidden_field_data_valido_ate_api_out"),
    "local_de_origem_api_out": new Array("hidden_field_label_local_de_origem_api_out", "hidden_field_data_local_de_origem_api_out"),
    "latitude_origem_api_out": new Array("hidden_field_label_latitude_origem_api_out", "hidden_field_data_latitude_origem_api_out"),
    "longitude_origem_api_out": new Array("hidden_field_label_longitude_origem_api_out", "hidden_field_data_longitude_origem_api_out"),
    "hr_saida_origem_api_out": new Array("hidden_field_label_hr_saida_origem_api_out", "hidden_field_data_hr_saida_origem_api_out"),
    "local_de_destino_api_out": new Array("hidden_field_label_local_de_destino_api_out", "hidden_field_data_local_de_destino_api_out"),
    "latitude_destino_api_out": new Array("hidden_field_label_latitude_destino_api_out", "hidden_field_data_latitude_destino_api_out"),
    "longitude_destino_api_out": new Array("hidden_field_label_longitude_destino_api_out", "hidden_field_data_longitude_destino_api_out"),
    "veiculo_api_out": new Array("hidden_field_label_veiculo_api_out", "hidden_field_data_veiculo_api_out"),
    "companhia_api_out": new Array("hidden_field_label_companhia_api_out", "hidden_field_data_companhia_api_out"),
    "nome_motorista_api_out": new Array("hidden_field_label_nome_motorista_api_out", "hidden_field_data_nome_motorista_api_out"),
    "contato_motorista_api_out": new Array("hidden_field_label_contato_motorista_api_out", "hidden_field_data_contato_motorista_api_out"),
    "matricula_api_out": new Array("hidden_field_label_matricula_api_out", "hidden_field_data_matricula_api_out"),
    "duracao_percurso_api_out": new Array("hidden_field_label_duracao_percurso_api_out", "hidden_field_data_duracao_percurso_api_out"),
    "comodidades_api_out": new Array("hidden_field_label_comodidades_api_out", "hidden_field_data_comodidades_api_out"),
    "observacao_api_out": new Array("hidden_field_label_observacao_api_out", "hidden_field_data_observacao_api_out"),
    "placa_veiculo_api_out": new Array("hidden_field_label_placa_veiculo_api_out", "hidden_field_data_placa_veiculo_api_out"),
    "id_evento_app_out": new Array("hidden_field_label_id_evento_app_out", "hidden_field_data_id_evento_app_out"),
    "id_participante_app_out": new Array("hidden_field_label_id_participante_app_out", "hidden_field_data_id_participante_app_out"),
    "id_voucher_app_out": new Array("hidden_field_label_id_voucher_app_out", "hidden_field_data_id_voucher_app_out")
  };

  var ajax_read_only = {
    "tra_id_evento": "off",
    "evento_dsc": "off",
    "tra_cpf_particip": "off",
    "tipo_dsc": "off",
    "tra_id_usuario": "off",
    "atendente_dsc": "off",
    "tra_tipo": "off",
    "tra_id_hotel": "off",
    "hotel_dsc": "off",
    "tra_id_hotel_out": "off",
    "hotel_dsc_out": "off",
    "enviar_app": "off",
    "tra_status": "off",
    "ult_trecho": "off",
    "tra_cia_ida": "off",
    "cia_ida_dsc": "off",
    "tra_numvoo_ida": "off",
    "tra_origem_ida": "off",
    "origem_ida_dsc": "off",
    "tra_destino_ida": "off",
    "destino_ida_dsc": "off",
    "tra_dt_saida_ida": "off",
    "tra_hr_saida_ida": "off",
    "tra_dt_chegada_ida": "off",
    "tra_hr_chegada_ida": "off",
    "tra_localizador_ida": "off",
    "tra_eticket_ida": "off",
    "tra_flag_ida": "off",
    "tra_cia_volta": "off",
    "cia_volta_dsc": "off",
    "tra_numvoo_volta": "off",
    "tra_origem_volta": "off",
    "origem_volta_dsc": "off",
    "tra_destino_volta": "off",
    "destino_volta_dsc": "off",
    "tra_dt_saida_volta": "off",
    "tra_hr_saida_volta": "off",
    "tra_dt_chegada_volta": "off",
    "tra_hr_chegada_volta": "off",
    "tra_localizador_volta": "off",
    "tra_eticket_volta": "off",
    "tra_intervalo": "off",
    "tra_hrtransout": "off",
    "tra_flag_volta": "off",
    "tra_dt_chegada_proprio": "off",
    "tra_hr_chegada_proprio": "off",
    "tra_flag_proprio": "off",
    "tra_dt_ida_local": "off",
    "tra_hr_ida_local": "off",
    "tra_origem_ida_local": "off",
    "tra_destino_ida_local": "off",
    "tra_flag_ida_local": "off",
    "tra_dt_volta_local": "off",
    "tra_hr_volta_local": "off",
    "tra_origem_volta_local": "off",
    "tra_destino_volta_local": "off",
    "tra_flag_volta_local": "off",
    "tra_observacao": "off",
    "tra_ativo": "off",
    "tra_dt_alteracao": "off",
    "cpf_del": "off",
    "sql_log": "off",
    "titulo_api": "off",
    "descricao_api": "off",
    "codigo_api": "off",
    "tipo_api": "off",
    "status_api": "off",
    "valido_de_api": "off",
    "valido_ate_api": "off",
    "local_de_origem_api": "off",
    "latitude_origem_api": "off",
    "longitude_origem_api": "off",
    "hr_saida_origem_api": "off",
    "local_destino_api": "off",
    "latitude_destino_api": "off",
    "longitude_destino_api": "off",
    "veiculo_api": "off",
    "companhia_api": "off",
    "nome_motorista_api": "off",
    "contato_motorista_api": "off",
    "matricula_api": "off",
    "duracao_percurso_api": "off",
    "comodidades_api": "off",
    "observacao_api": "off",
    "placa_veiculo_api": "off",
    "id_evento_app": "off",
    "id_participante_app": "off",
    "id_voucher_app": "off",
    "titulo_api_out": "off",
    "descricao_api_out": "off",
    "codigo_api_out": "off",
    "tipo_api_out": "off",
    "status_api_out": "off",
    "valido_de_api_out": "off",
    "valido_ate_api_out": "off",
    "local_de_origem_api_out": "off",
    "latitude_origem_api_out": "off",
    "longitude_origem_api_out": "off",
    "hr_saida_origem_api_out": "off",
    "local_de_destino_api_out": "off",
    "latitude_destino_api_out": "off",
    "longitude_destino_api_out": "off",
    "veiculo_api_out": "off",
    "companhia_api_out": "off",
    "nome_motorista_api_out": "off",
    "contato_motorista_api_out": "off",
    "matricula_api_out": "off",
    "duracao_percurso_api_out": "off",
    "comodidades_api_out": "off",
    "observacao_api_out": "off",
    "placa_veiculo_api_out": "off",
    "id_evento_app_out": "off",
    "id_participante_app_out": "off",
    "id_voucher_app_out": "off"
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
    if ("tra_id_evento" == sIndex)
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
    if ("evento_dsc" == sIndex)
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
    if ("tra_cpf_particip" == sIndex)
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
    if ("tipo_dsc" == sIndex)
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
    if ("tra_id_usuario" == sIndex)
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
    if ("atendente_dsc" == sIndex)
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
    if ("tra_tipo" == sIndex)
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
    if ("tra_id_hotel" == sIndex)
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
    if ("hotel_dsc" == sIndex)
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
    if ("tra_id_hotel_out" == sIndex)
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
    if ("hotel_dsc_out" == sIndex)
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
    if ("enviar_app" == sIndex)
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
    if ("tra_status" == sIndex)
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
    if ("ult_trecho" == sIndex)
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
    if ("tra_cia_ida" == sIndex)
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
    if ("cia_ida_dsc" == sIndex)
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
    if ("tra_numvoo_ida" == sIndex)
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
    if ("tra_origem_ida" == sIndex)
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
    if ("origem_ida_dsc" == sIndex)
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
    if ("tra_destino_ida" == sIndex)
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
    if ("destino_ida_dsc" == sIndex)
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
    if ("tra_dt_saida_ida" == sIndex)
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
    if ("tra_hr_saida_ida" == sIndex)
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
    if ("tra_dt_chegada_ida" == sIndex)
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
    if ("tra_hr_chegada_ida" == sIndex)
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
    if ("tra_localizador_ida" == sIndex)
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
    if ("tra_eticket_ida" == sIndex)
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
    if ("tra_flag_ida" == sIndex)
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
    if ("tra_cia_volta" == sIndex)
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
    if ("cia_volta_dsc" == sIndex)
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
    if ("tra_numvoo_volta" == sIndex)
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
    if ("tra_origem_volta" == sIndex)
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
    if ("origem_volta_dsc" == sIndex)
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
    if ("tra_destino_volta" == sIndex)
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
    if ("destino_volta_dsc" == sIndex)
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
    if ("tra_dt_saida_volta" == sIndex)
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
    if ("tra_hr_saida_volta" == sIndex)
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
    if ("tra_dt_chegada_volta" == sIndex)
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
    if ("tra_hr_chegada_volta" == sIndex)
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
    if ("tra_localizador_volta" == sIndex)
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
    if ("tra_eticket_volta" == sIndex)
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
    if ("tra_intervalo" == sIndex)
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
    if ("tra_hrtransout" == sIndex)
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
    if ("tra_flag_volta" == sIndex)
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
    if ("tra_dt_chegada_proprio" == sIndex)
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
    if ("tra_hr_chegada_proprio" == sIndex)
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
    if ("tra_flag_proprio" == sIndex)
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
    if ("tra_dt_ida_local" == sIndex)
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
    if ("tra_hr_ida_local" == sIndex)
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
    if ("tra_origem_ida_local" == sIndex)
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
    if ("tra_destino_ida_local" == sIndex)
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
    if ("tra_flag_ida_local" == sIndex)
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
    if ("tra_dt_volta_local" == sIndex)
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
    if ("tra_hr_volta_local" == sIndex)
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
    if ("tra_origem_volta_local" == sIndex)
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
    if ("tra_destino_volta_local" == sIndex)
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
    if ("tra_flag_volta_local" == sIndex)
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
    if ("tra_observacao" == sIndex)
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
    if ("tra_ativo" == sIndex)
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
    if ("tra_dt_alteracao" == sIndex)
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
    if ("cpf_del" == sIndex)
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
    if ("sql_log" == sIndex)
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
    if ("titulo_api" == sIndex)
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
    if ("descricao_api" == sIndex)
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
    if ("codigo_api" == sIndex)
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
    if ("tipo_api" == sIndex)
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
    if ("status_api" == sIndex)
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
    if ("valido_de_api" == sIndex)
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
    if ("valido_ate_api" == sIndex)
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
    if ("local_de_origem_api" == sIndex)
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
    if ("latitude_origem_api" == sIndex)
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
    if ("longitude_origem_api" == sIndex)
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
    if ("hr_saida_origem_api" == sIndex)
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
    if ("local_destino_api" == sIndex)
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
    if ("latitude_destino_api" == sIndex)
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
    if ("longitude_destino_api" == sIndex)
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
    if ("veiculo_api" == sIndex)
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
    if ("companhia_api" == sIndex)
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
    if ("nome_motorista_api" == sIndex)
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
    if ("contato_motorista_api" == sIndex)
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
    if ("matricula_api" == sIndex)
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
    if ("duracao_percurso_api" == sIndex)
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
    if ("comodidades_api" == sIndex)
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
    if ("observacao_api" == sIndex)
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
    if ("placa_veiculo_api" == sIndex)
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
    if ("id_evento_app" == sIndex)
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
    if ("id_participante_app" == sIndex)
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
    if ("id_voucher_app" == sIndex)
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
    if ("titulo_api_out" == sIndex)
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
    if ("descricao_api_out" == sIndex)
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
    if ("codigo_api_out" == sIndex)
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
    if ("tipo_api_out" == sIndex)
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
    if ("status_api_out" == sIndex)
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
    if ("valido_de_api_out" == sIndex)
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
    if ("valido_ate_api_out" == sIndex)
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
    if ("local_de_origem_api_out" == sIndex)
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
    if ("latitude_origem_api_out" == sIndex)
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
    if ("longitude_origem_api_out" == sIndex)
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
    if ("hr_saida_origem_api_out" == sIndex)
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
    if ("local_de_destino_api_out" == sIndex)
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
    if ("latitude_destino_api_out" == sIndex)
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
    if ("longitude_destino_api_out" == sIndex)
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
    if ("veiculo_api_out" == sIndex)
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
    if ("companhia_api_out" == sIndex)
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
    if ("nome_motorista_api_out" == sIndex)
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
    if ("contato_motorista_api_out" == sIndex)
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
    if ("matricula_api_out" == sIndex)
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
    if ("duracao_percurso_api_out" == sIndex)
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
    if ("comodidades_api_out" == sIndex)
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
    if ("observacao_api_out" == sIndex)
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
    if ("placa_veiculo_api_out" == sIndex)
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
    if ("id_evento_app_out" == sIndex)
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
    if ("id_participante_app_out" == sIndex)
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
    if ("id_voucher_app_out" == sIndex)
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
    scAjaxSetFieldInnerHtml(sIndex, aValue);
  }
 </SCRIPT>
