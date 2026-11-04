
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
        if ("geral_form_eventos_rsvp" == sTestField)
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
        sc_hide_form_eventos_rsvp_form();
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

  // ---------- Validate particip_link
  function do_ajax_form_eventos_rsvp_validate_particip_link()
  {
    var nomeCampo_particip_link = "particip_link";
    var var_particip_link = scAjaxGetFieldText(nomeCampo_particip_link);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_particip_link(var_particip_link, var_script_case_init, do_ajax_form_eventos_rsvp_validate_particip_link_cb);
  } // do_ajax_form_eventos_rsvp_validate_particip_link

  function do_ajax_form_eventos_rsvp_validate_particip_link_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "particip_link";
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
  } // do_ajax_form_eventos_rsvp_validate_particip_link_cb

  // ---------- Validate empresa_link
  function do_ajax_form_eventos_rsvp_validate_empresa_link()
  {
    var nomeCampo_empresa_link = "empresa_link";
    var var_empresa_link = scAjaxGetFieldText(nomeCampo_empresa_link);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_empresa_link(var_empresa_link, var_script_case_init, do_ajax_form_eventos_rsvp_validate_empresa_link_cb);
  } // do_ajax_form_eventos_rsvp_validate_empresa_link

  function do_ajax_form_eventos_rsvp_validate_empresa_link_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "empresa_link";
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
  } // do_ajax_form_eventos_rsvp_validate_empresa_link_cb

  // ---------- Validate usuarios_link
  function do_ajax_form_eventos_rsvp_validate_usuarios_link()
  {
    var nomeCampo_usuarios_link = "usuarios_link";
    var var_usuarios_link = scAjaxGetFieldText(nomeCampo_usuarios_link);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_usuarios_link(var_usuarios_link, var_script_case_init, do_ajax_form_eventos_rsvp_validate_usuarios_link_cb);
  } // do_ajax_form_eventos_rsvp_validate_usuarios_link

  function do_ajax_form_eventos_rsvp_validate_usuarios_link_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "usuarios_link";
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
  } // do_ajax_form_eventos_rsvp_validate_usuarios_link_cb

  // ---------- Validate publicos_link
  function do_ajax_form_eventos_rsvp_validate_publicos_link()
  {
    var nomeCampo_publicos_link = "publicos_link";
    var var_publicos_link = scAjaxGetFieldText(nomeCampo_publicos_link);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_publicos_link(var_publicos_link, var_script_case_init, do_ajax_form_eventos_rsvp_validate_publicos_link_cb);
  } // do_ajax_form_eventos_rsvp_validate_publicos_link

  function do_ajax_form_eventos_rsvp_validate_publicos_link_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "publicos_link";
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
  } // do_ajax_form_eventos_rsvp_validate_publicos_link_cb

  // ---------- Validate hoteis_link
  function do_ajax_form_eventos_rsvp_validate_hoteis_link()
  {
    var nomeCampo_hoteis_link = "hoteis_link";
    var var_hoteis_link = scAjaxGetFieldText(nomeCampo_hoteis_link);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_hoteis_link(var_hoteis_link, var_script_case_init, do_ajax_form_eventos_rsvp_validate_hoteis_link_cb);
  } // do_ajax_form_eventos_rsvp_validate_hoteis_link

  function do_ajax_form_eventos_rsvp_validate_hoteis_link_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "hoteis_link";
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
  } // do_ajax_form_eventos_rsvp_validate_hoteis_link_cb

  // ---------- Validate cias_link
  function do_ajax_form_eventos_rsvp_validate_cias_link()
  {
    var nomeCampo_cias_link = "cias_link";
    var var_cias_link = scAjaxGetFieldText(nomeCampo_cias_link);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_cias_link(var_cias_link, var_script_case_init, do_ajax_form_eventos_rsvp_validate_cias_link_cb);
  } // do_ajax_form_eventos_rsvp_validate_cias_link

  function do_ajax_form_eventos_rsvp_validate_cias_link_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cias_link";
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
  } // do_ajax_form_eventos_rsvp_validate_cias_link_cb

  // ---------- Validate tours_lnk
  function do_ajax_form_eventos_rsvp_validate_tours_lnk()
  {
    var nomeCampo_tours_lnk = "tours_lnk";
    var var_tours_lnk = scAjaxGetFieldText(nomeCampo_tours_lnk);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_tours_lnk(var_tours_lnk, var_script_case_init, do_ajax_form_eventos_rsvp_validate_tours_lnk_cb);
  } // do_ajax_form_eventos_rsvp_validate_tours_lnk

  function do_ajax_form_eventos_rsvp_validate_tours_lnk_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "tours_lnk";
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
  } // do_ajax_form_eventos_rsvp_validate_tours_lnk_cb

  // ---------- Validate regionais_link
  function do_ajax_form_eventos_rsvp_validate_regionais_link()
  {
    var nomeCampo_regionais_link = "regionais_link";
    var var_regionais_link = scAjaxGetFieldText(nomeCampo_regionais_link);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_regionais_link(var_regionais_link, var_script_case_init, do_ajax_form_eventos_rsvp_validate_regionais_link_cb);
  } // do_ajax_form_eventos_rsvp_validate_regionais_link

  function do_ajax_form_eventos_rsvp_validate_regionais_link_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "regionais_link";
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
  } // do_ajax_form_eventos_rsvp_validate_regionais_link_cb

  // ---------- Validate programacao_link
  function do_ajax_form_eventos_rsvp_validate_programacao_link()
  {
    var nomeCampo_programacao_link = "programacao_link";
    var var_programacao_link = scAjaxGetFieldText(nomeCampo_programacao_link);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_programacao_link(var_programacao_link, var_script_case_init, do_ajax_form_eventos_rsvp_validate_programacao_link_cb);
  } // do_ajax_form_eventos_rsvp_validate_programacao_link

  function do_ajax_form_eventos_rsvp_validate_programacao_link_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "programacao_link";
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
  } // do_ajax_form_eventos_rsvp_validate_programacao_link_cb

  // ---------- Validate mailling_link
  function do_ajax_form_eventos_rsvp_validate_mailling_link()
  {
    var nomeCampo_mailling_link = "mailling_link";
    var var_mailling_link = scAjaxGetFieldText(nomeCampo_mailling_link);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_mailling_link(var_mailling_link, var_script_case_init, do_ajax_form_eventos_rsvp_validate_mailling_link_cb);
  } // do_ajax_form_eventos_rsvp_validate_mailling_link

  function do_ajax_form_eventos_rsvp_validate_mailling_link_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "mailling_link";
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
  } // do_ajax_form_eventos_rsvp_validate_mailling_link_cb

  // ---------- Validate observacoes
  function do_ajax_form_eventos_rsvp_validate_observacoes()
  {
    var nomeCampo_observacoes = "observacoes";
    var var_observacoes = scAjaxGetFieldText(nomeCampo_observacoes);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_observacoes(var_observacoes, var_script_case_init, do_ajax_form_eventos_rsvp_validate_observacoes_cb);
  } // do_ajax_form_eventos_rsvp_validate_observacoes

  function do_ajax_form_eventos_rsvp_validate_observacoes_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "observacoes";
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
  } // do_ajax_form_eventos_rsvp_validate_observacoes_cb

  // ---------- Validate sql_log
  function do_ajax_form_eventos_rsvp_validate_sql_log()
  {
    var nomeCampo_sql_log = "sql_log";
    var var_sql_log = scAjaxGetFieldHidden(nomeCampo_sql_log);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_sql_log(var_sql_log, var_script_case_init, do_ajax_form_eventos_rsvp_validate_sql_log_cb);
  } // do_ajax_form_eventos_rsvp_validate_sql_log

  function do_ajax_form_eventos_rsvp_validate_sql_log_cb(sResp)
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
  } // do_ajax_form_eventos_rsvp_validate_sql_log_cb

  // ---------- Validate evento_id
  function do_ajax_form_eventos_rsvp_validate_evento_id()
  {
    var nomeCampo_evento_id = "evento_id";
    var var_evento_id = scAjaxGetFieldHidden(nomeCampo_evento_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_id(var_evento_id, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_id_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_id

  function do_ajax_form_eventos_rsvp_validate_evento_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_id";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_id_cb

  // ---------- Validate evento_id_interno
  function do_ajax_form_eventos_rsvp_validate_evento_id_interno()
  {
    var nomeCampo_evento_id_interno = "evento_id_interno";
    var var_evento_id_interno = scAjaxGetFieldText(nomeCampo_evento_id_interno);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_id_interno(var_evento_id_interno, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_id_interno_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_id_interno

  function do_ajax_form_eventos_rsvp_validate_evento_id_interno_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_id_interno";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_id_interno_cb

  // ---------- Validate evento_id_complementar
  function do_ajax_form_eventos_rsvp_validate_evento_id_complementar()
  {
    var nomeCampo_evento_id_complementar = "evento_id_complementar";
    var var_evento_id_complementar = scAjaxGetFieldSelect(nomeCampo_evento_id_complementar);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_id_complementar(var_evento_id_complementar, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_id_complementar_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_id_complementar

  function do_ajax_form_eventos_rsvp_validate_evento_id_complementar_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_id_complementar";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_id_complementar_cb

  // ---------- Validate evento_nome
  function do_ajax_form_eventos_rsvp_validate_evento_nome()
  {
    var nomeCampo_evento_nome = "evento_nome";
    var var_evento_nome = scAjaxGetFieldText(nomeCampo_evento_nome);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_nome(var_evento_nome, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_nome_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_nome

  function do_ajax_form_eventos_rsvp_validate_evento_nome_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_nome";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_nome_cb

  // ---------- Validate evento_idioma
  function do_ajax_form_eventos_rsvp_validate_evento_idioma()
  {
    var nomeCampo_evento_idioma = "evento_idioma";
    var var_evento_idioma = scAjaxGetFieldRadio(nomeCampo_evento_idioma);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_idioma(var_evento_idioma, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_idioma_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_idioma

  function do_ajax_form_eventos_rsvp_validate_evento_idioma_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_idioma";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_idioma_cb

  // ---------- Validate evento_dt_realizacao
  function do_ajax_form_eventos_rsvp_validate_evento_dt_realizacao()
  {
    var nomeCampo_evento_dt_realizacao = "evento_dt_realizacao";
    var var_evento_dt_realizacao = scAjaxGetFieldText(nomeCampo_evento_dt_realizacao);
    var var_script_case_init = document.F1.script_case_init.value;
    setTimeout(function() {
      var var_evento_dt_realizacao = scAjaxGetFieldText(nomeCampo_evento_dt_realizacao);
      x_ajax_form_eventos_rsvp_validate_evento_dt_realizacao(var_evento_dt_realizacao, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_dt_realizacao_cb);
    }, 200);
  } // do_ajax_form_eventos_rsvp_validate_evento_dt_realizacao

  function do_ajax_form_eventos_rsvp_validate_evento_dt_realizacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_dt_realizacao";
    scEventControl_onBlur(sFieldValid);
    scAjaxUpdateFieldErrors(sFieldValid, "valid");
    sFieldErrors = scAjaxListFieldErrors(sFieldValid, false);
    if ("" == sFieldErrors || ($("#ui-datepicker-div").length && $("#ui-datepicker-div").filter(":visible").length))
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
  } // do_ajax_form_eventos_rsvp_validate_evento_dt_realizacao_cb

  // ---------- Validate evento_dt_conclusao
  function do_ajax_form_eventos_rsvp_validate_evento_dt_conclusao()
  {
    var nomeCampo_evento_dt_conclusao = "evento_dt_conclusao";
    var var_evento_dt_conclusao = scAjaxGetFieldText(nomeCampo_evento_dt_conclusao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_dt_conclusao(var_evento_dt_conclusao, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_dt_conclusao_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_dt_conclusao

  function do_ajax_form_eventos_rsvp_validate_evento_dt_conclusao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_dt_conclusao";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_dt_conclusao_cb

  // ---------- Validate evento_status
  function do_ajax_form_eventos_rsvp_validate_evento_status()
  {
    var nomeCampo_evento_status = "evento_status";
    var var_evento_status = scAjaxGetFieldRadio(nomeCampo_evento_status);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_status(var_evento_status, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_status_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_status

  function do_ajax_form_eventos_rsvp_validate_evento_status_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_status";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_status_cb

  // ---------- Validate evento_logo
  function do_ajax_form_eventos_rsvp_validate_evento_logo()
  {
    var nomeCampo_evento_logo = "evento_logo";
    var var_evento_logo = scAjaxGetFieldText(nomeCampo_evento_logo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_logo(var_evento_logo, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_logo_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_logo

  function do_ajax_form_eventos_rsvp_validate_evento_logo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_logo";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_logo_cb

  // ---------- Validate evento_website
  function do_ajax_form_eventos_rsvp_validate_evento_website()
  {
    var nomeCampo_evento_website = "evento_website";
    var var_evento_website = scAjaxGetFieldText(nomeCampo_evento_website);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_website(var_evento_website, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_website_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_website

  function do_ajax_form_eventos_rsvp_validate_evento_website_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_website";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_website_cb

  // ---------- Validate cover_image
  function do_ajax_form_eventos_rsvp_validate_cover_image()
  {
    var nomeCampo_cover_image = "cover_image";
    var var_cover_image = scAjaxGetFieldText(nomeCampo_cover_image);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_cover_image(var_cover_image, var_script_case_init, do_ajax_form_eventos_rsvp_validate_cover_image_cb);
  } // do_ajax_form_eventos_rsvp_validate_cover_image

  function do_ajax_form_eventos_rsvp_validate_cover_image_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cover_image";
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
  } // do_ajax_form_eventos_rsvp_validate_cover_image_cb

  // ---------- Validate evento_email
  function do_ajax_form_eventos_rsvp_validate_evento_email()
  {
    var nomeCampo_evento_email = "evento_email";
    var var_evento_email = scAjaxGetFieldText(nomeCampo_evento_email);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_email(var_evento_email, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_email_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_email

  function do_ajax_form_eventos_rsvp_validate_evento_email_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_email";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_email_cb

  // ---------- Validate evento_tipo
  function do_ajax_form_eventos_rsvp_validate_evento_tipo()
  {
    var nomeCampo_evento_tipo = "evento_tipo";
    var var_evento_tipo = scAjaxGetFieldText(nomeCampo_evento_tipo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_tipo(var_evento_tipo, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_tipo_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_tipo

  function do_ajax_form_eventos_rsvp_validate_evento_tipo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_tipo";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_tipo_cb

  // ---------- Validate enviar_app
  function do_ajax_form_eventos_rsvp_validate_enviar_app()
  {
    var nomeCampo_enviar_app = "enviar_app";
    var var_enviar_app = scAjaxGetFieldRadio(nomeCampo_enviar_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_enviar_app(var_enviar_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_enviar_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_enviar_app

  function do_ajax_form_eventos_rsvp_validate_enviar_app_cb(sResp)
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
  } // do_ajax_form_eventos_rsvp_validate_enviar_app_cb

  // ---------- Validate evento_cep
  function do_ajax_form_eventos_rsvp_validate_evento_cep()
  {
    var nomeCampo_evento_cep = "evento_cep";
    var var_evento_cep = scAjaxGetFieldText(nomeCampo_evento_cep);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_cep(var_evento_cep, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_cep_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_cep

  function do_ajax_form_eventos_rsvp_validate_evento_cep_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_cep";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_cep_cb

  // ---------- Validate evento_pais
  function do_ajax_form_eventos_rsvp_validate_evento_pais()
  {
    var nomeCampo_evento_pais = "evento_pais";
    var var_evento_pais = scAjaxGetFieldSelect(nomeCampo_evento_pais);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_pais(var_evento_pais, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_pais_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_pais

  function do_ajax_form_eventos_rsvp_validate_evento_pais_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_pais";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_pais_cb

  // ---------- Validate evento_uf
  function do_ajax_form_eventos_rsvp_validate_evento_uf()
  {
    var nomeCampo_evento_uf = "evento_uf";
    var var_evento_uf = scAjaxGetFieldText(nomeCampo_evento_uf);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_uf(var_evento_uf, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_uf_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_uf

  function do_ajax_form_eventos_rsvp_validate_evento_uf_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_uf";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_uf_cb

  // ---------- Validate evento_municipio
  function do_ajax_form_eventos_rsvp_validate_evento_municipio()
  {
    var nomeCampo_evento_municipio = "evento_municipio";
    var var_evento_municipio = scAjaxGetFieldText(nomeCampo_evento_municipio);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_municipio(var_evento_municipio, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_municipio_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_municipio

  function do_ajax_form_eventos_rsvp_validate_evento_municipio_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_municipio";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_municipio_cb

  // ---------- Validate evento_bairro
  function do_ajax_form_eventos_rsvp_validate_evento_bairro()
  {
    var nomeCampo_evento_bairro = "evento_bairro";
    var var_evento_bairro = scAjaxGetFieldText(nomeCampo_evento_bairro);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_bairro(var_evento_bairro, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_bairro_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_bairro

  function do_ajax_form_eventos_rsvp_validate_evento_bairro_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_bairro";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_bairro_cb

  // ---------- Validate evento_logradouro
  function do_ajax_form_eventos_rsvp_validate_evento_logradouro()
  {
    var nomeCampo_evento_logradouro = "evento_logradouro";
    var var_evento_logradouro = scAjaxGetFieldText(nomeCampo_evento_logradouro);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_logradouro(var_evento_logradouro, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_logradouro_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_logradouro

  function do_ajax_form_eventos_rsvp_validate_evento_logradouro_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_logradouro";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_logradouro_cb

  // ---------- Validate evento_numero
  function do_ajax_form_eventos_rsvp_validate_evento_numero()
  {
    var nomeCampo_evento_numero = "evento_numero";
    var var_evento_numero = scAjaxGetFieldText(nomeCampo_evento_numero);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_numero(var_evento_numero, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_numero_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_numero

  function do_ajax_form_eventos_rsvp_validate_evento_numero_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_numero";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_numero_cb

  // ---------- Validate evento_complemento
  function do_ajax_form_eventos_rsvp_validate_evento_complemento()
  {
    var nomeCampo_evento_complemento = "evento_complemento";
    var var_evento_complemento = scAjaxGetFieldText(nomeCampo_evento_complemento);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_complemento(var_evento_complemento, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_complemento_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_complemento

  function do_ajax_form_eventos_rsvp_validate_evento_complemento_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_complemento";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_complemento_cb

  // ---------- Validate evento_observacao
  function do_ajax_form_eventos_rsvp_validate_evento_observacao()
  {
    var nomeCampo_evento_observacao = "evento_observacao";
    var var_evento_observacao = scAjaxGetFieldText(nomeCampo_evento_observacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_observacao(var_evento_observacao, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_observacao_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_observacao

  function do_ajax_form_eventos_rsvp_validate_evento_observacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_observacao";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_observacao_cb

  // ---------- Validate localizacao
  function do_ajax_form_eventos_rsvp_validate_localizacao()
  {
    var nomeCampo_localizacao = "localizacao";
    var var_localizacao = scAjaxGetFieldHidden(nomeCampo_localizacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_localizacao(var_localizacao, var_script_case_init, do_ajax_form_eventos_rsvp_validate_localizacao_cb);
  } // do_ajax_form_eventos_rsvp_validate_localizacao

  function do_ajax_form_eventos_rsvp_validate_localizacao_cb(sResp)
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
  } // do_ajax_form_eventos_rsvp_validate_localizacao_cb

  // ---------- Validate latitude_app
  function do_ajax_form_eventos_rsvp_validate_latitude_app()
  {
    var nomeCampo_latitude_app = "latitude_app";
    var var_latitude_app = scAjaxGetFieldText(nomeCampo_latitude_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_latitude_app(var_latitude_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_latitude_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_latitude_app

  function do_ajax_form_eventos_rsvp_validate_latitude_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "latitude_app";
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
  } // do_ajax_form_eventos_rsvp_validate_latitude_app_cb

  // ---------- Validate longitude_app
  function do_ajax_form_eventos_rsvp_validate_longitude_app()
  {
    var nomeCampo_longitude_app = "longitude_app";
    var var_longitude_app = scAjaxGetFieldText(nomeCampo_longitude_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_longitude_app(var_longitude_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_longitude_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_longitude_app

  function do_ajax_form_eventos_rsvp_validate_longitude_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "longitude_app";
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
  } // do_ajax_form_eventos_rsvp_validate_longitude_app_cb

  // ---------- Validate evento_id_responsavel
  function do_ajax_form_eventos_rsvp_validate_evento_id_responsavel()
  {
    var nomeCampo_evento_id_responsavel = "evento_id_responsavel";
    var var_evento_id_responsavel = scAjaxGetFieldSelect(nomeCampo_evento_id_responsavel);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_id_responsavel(var_evento_id_responsavel, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_id_responsavel_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_id_responsavel

  function do_ajax_form_eventos_rsvp_validate_evento_id_responsavel_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_id_responsavel";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_id_responsavel_cb

  // ---------- Validate evento_telefone
  function do_ajax_form_eventos_rsvp_validate_evento_telefone()
  {
    var nomeCampo_evento_telefone = "evento_telefone";
    var var_evento_telefone = scAjaxGetFieldText(nomeCampo_evento_telefone);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_telefone(var_evento_telefone, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_telefone_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_telefone

  function do_ajax_form_eventos_rsvp_validate_evento_telefone_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_telefone";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_telefone_cb

  // ---------- Validate evento_celular
  function do_ajax_form_eventos_rsvp_validate_evento_celular()
  {
    var nomeCampo_evento_celular = "evento_celular";
    var var_evento_celular = scAjaxGetFieldText(nomeCampo_evento_celular);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_evento_celular(var_evento_celular, var_script_case_init, do_ajax_form_eventos_rsvp_validate_evento_celular_cb);
  } // do_ajax_form_eventos_rsvp_validate_evento_celular

  function do_ajax_form_eventos_rsvp_validate_evento_celular_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "evento_celular";
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
  } // do_ajax_form_eventos_rsvp_validate_evento_celular_cb

  // ---------- Validate dsc_app
  function do_ajax_form_eventos_rsvp_validate_dsc_app()
  {
    var nomeCampo_dsc_app = "dsc_app";
    var var_dsc_app = scAjaxGetFieldText(nomeCampo_dsc_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_dsc_app(var_dsc_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_dsc_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_dsc_app

  function do_ajax_form_eventos_rsvp_validate_dsc_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dsc_app";
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
  } // do_ajax_form_eventos_rsvp_validate_dsc_app_cb

  // ---------- Validate data_conclusao_app
  function do_ajax_form_eventos_rsvp_validate_data_conclusao_app()
  {
    var nomeCampo_data_conclusao_app = "data_conclusao_app";
    var var_data_conclusao_app = scAjaxGetFieldText(nomeCampo_data_conclusao_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_data_conclusao_app(var_data_conclusao_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_data_conclusao_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_data_conclusao_app

  function do_ajax_form_eventos_rsvp_validate_data_conclusao_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "data_conclusao_app";
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
  } // do_ajax_form_eventos_rsvp_validate_data_conclusao_app_cb

  // ---------- Validate localizacao_app
  function do_ajax_form_eventos_rsvp_validate_localizacao_app()
  {
    var nomeCampo_localizacao_app = "localizacao_app";
    var var_localizacao_app = scAjaxGetFieldText(nomeCampo_localizacao_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_localizacao_app(var_localizacao_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_localizacao_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_localizacao_app

  function do_ajax_form_eventos_rsvp_validate_localizacao_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "localizacao_app";
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
  } // do_ajax_form_eventos_rsvp_validate_localizacao_app_cb

  // ---------- Validate status_app
  function do_ajax_form_eventos_rsvp_validate_status_app()
  {
    var nomeCampo_status_app = "status_app";
    var var_status_app = scAjaxGetFieldSelect(nomeCampo_status_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_status_app(var_status_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_status_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_status_app

  function do_ajax_form_eventos_rsvp_validate_status_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "status_app";
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
  } // do_ajax_form_eventos_rsvp_validate_status_app_cb

  // ---------- Validate status_da_publicidade
  function do_ajax_form_eventos_rsvp_validate_status_da_publicidade()
  {
    var nomeCampo_status_da_publicidade = "status_da_publicidade";
    var var_status_da_publicidade = scAjaxGetFieldSelect(nomeCampo_status_da_publicidade);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_status_da_publicidade(var_status_da_publicidade, var_script_case_init, do_ajax_form_eventos_rsvp_validate_status_da_publicidade_cb);
  } // do_ajax_form_eventos_rsvp_validate_status_da_publicidade

  function do_ajax_form_eventos_rsvp_validate_status_da_publicidade_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "status_da_publicidade";
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
  } // do_ajax_form_eventos_rsvp_validate_status_da_publicidade_cb

  // ---------- Validate timezone
  function do_ajax_form_eventos_rsvp_validate_timezone()
  {
    var nomeCampo_timezone = "timezone";
    var var_timezone = scAjaxGetFieldSelect(nomeCampo_timezone);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_timezone(var_timezone, var_script_case_init, do_ajax_form_eventos_rsvp_validate_timezone_cb);
  } // do_ajax_form_eventos_rsvp_validate_timezone

  function do_ajax_form_eventos_rsvp_validate_timezone_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "timezone";
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
  } // do_ajax_form_eventos_rsvp_validate_timezone_cb

  // ---------- Validate caminho_logo_cli
  function do_ajax_form_eventos_rsvp_validate_caminho_logo_cli()
  {
    var nomeCampo_caminho_logo_cli = "caminho_logo_cli";
    var var_caminho_logo_cli = scAjaxGetFieldText(nomeCampo_caminho_logo_cli);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_caminho_logo_cli(var_caminho_logo_cli, var_script_case_init, do_ajax_form_eventos_rsvp_validate_caminho_logo_cli_cb);
  } // do_ajax_form_eventos_rsvp_validate_caminho_logo_cli

  function do_ajax_form_eventos_rsvp_validate_caminho_logo_cli_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "caminho_logo_cli";
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
  } // do_ajax_form_eventos_rsvp_validate_caminho_logo_cli_cb

  // ---------- Validate caminho_cover_image
  function do_ajax_form_eventos_rsvp_validate_caminho_cover_image()
  {
    var nomeCampo_caminho_cover_image = "caminho_cover_image";
    var var_caminho_cover_image = scAjaxGetFieldText(nomeCampo_caminho_cover_image);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_caminho_cover_image(var_caminho_cover_image, var_script_case_init, do_ajax_form_eventos_rsvp_validate_caminho_cover_image_cb);
  } // do_ajax_form_eventos_rsvp_validate_caminho_cover_image

  function do_ajax_form_eventos_rsvp_validate_caminho_cover_image_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "caminho_cover_image";
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
  } // do_ajax_form_eventos_rsvp_validate_caminho_cover_image_cb

  // ---------- Validate cor_principal_app
  function do_ajax_form_eventos_rsvp_validate_cor_principal_app()
  {
    var nomeCampo_cor_principal_app = "cor_principal_app";
    var var_cor_principal_app = scAjaxGetFieldText(nomeCampo_cor_principal_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_cor_principal_app(var_cor_principal_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_cor_principal_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_cor_principal_app

  function do_ajax_form_eventos_rsvp_validate_cor_principal_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cor_principal_app";
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
  } // do_ajax_form_eventos_rsvp_validate_cor_principal_app_cb

  // ---------- Validate cor_secundaria_app
  function do_ajax_form_eventos_rsvp_validate_cor_secundaria_app()
  {
    var nomeCampo_cor_secundaria_app = "cor_secundaria_app";
    var var_cor_secundaria_app = scAjaxGetFieldText(nomeCampo_cor_secundaria_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_cor_secundaria_app(var_cor_secundaria_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_cor_secundaria_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_cor_secundaria_app

  function do_ajax_form_eventos_rsvp_validate_cor_secundaria_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cor_secundaria_app";
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
  } // do_ajax_form_eventos_rsvp_validate_cor_secundaria_app_cb

  // ---------- Validate cor_fundo_app
  function do_ajax_form_eventos_rsvp_validate_cor_fundo_app()
  {
    var nomeCampo_cor_fundo_app = "cor_fundo_app";
    var var_cor_fundo_app = scAjaxGetFieldText(nomeCampo_cor_fundo_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_cor_fundo_app(var_cor_fundo_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_cor_fundo_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_cor_fundo_app

  function do_ajax_form_eventos_rsvp_validate_cor_fundo_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cor_fundo_app";
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
  } // do_ajax_form_eventos_rsvp_validate_cor_fundo_app_cb

  // ---------- Validate nome_organizador_app
  function do_ajax_form_eventos_rsvp_validate_nome_organizador_app()
  {
    var nomeCampo_nome_organizador_app = "nome_organizador_app";
    var var_nome_organizador_app = scAjaxGetFieldText(nomeCampo_nome_organizador_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_nome_organizador_app(var_nome_organizador_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_nome_organizador_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_nome_organizador_app

  function do_ajax_form_eventos_rsvp_validate_nome_organizador_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "nome_organizador_app";
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
  } // do_ajax_form_eventos_rsvp_validate_nome_organizador_app_cb

  // ---------- Validate email_organizador_app
  function do_ajax_form_eventos_rsvp_validate_email_organizador_app()
  {
    var nomeCampo_email_organizador_app = "email_organizador_app";
    var var_email_organizador_app = scAjaxGetFieldText(nomeCampo_email_organizador_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_email_organizador_app(var_email_organizador_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_email_organizador_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_email_organizador_app

  function do_ajax_form_eventos_rsvp_validate_email_organizador_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "email_organizador_app";
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
  } // do_ajax_form_eventos_rsvp_validate_email_organizador_app_cb

  // ---------- Validate nome_comprador_app
  function do_ajax_form_eventos_rsvp_validate_nome_comprador_app()
  {
    var nomeCampo_nome_comprador_app = "nome_comprador_app";
    var var_nome_comprador_app = scAjaxGetFieldText(nomeCampo_nome_comprador_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_nome_comprador_app(var_nome_comprador_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_nome_comprador_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_nome_comprador_app

  function do_ajax_form_eventos_rsvp_validate_nome_comprador_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "nome_comprador_app";
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
  } // do_ajax_form_eventos_rsvp_validate_nome_comprador_app_cb

  // ---------- Validate wz_suporte_app
  function do_ajax_form_eventos_rsvp_validate_wz_suporte_app()
  {
    var nomeCampo_wz_suporte_app = "wz_suporte_app";
    var var_wz_suporte_app = scAjaxGetFieldText(nomeCampo_wz_suporte_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_wz_suporte_app(var_wz_suporte_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_wz_suporte_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_wz_suporte_app

  function do_ajax_form_eventos_rsvp_validate_wz_suporte_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "wz_suporte_app";
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
  } // do_ajax_form_eventos_rsvp_validate_wz_suporte_app_cb

  // ---------- Validate gamificacao_ativada_app
  function do_ajax_form_eventos_rsvp_validate_gamificacao_ativada_app()
  {
    var nomeCampo_gamificacao_ativada_app = "gamificacao_ativada_app";
    var var_gamificacao_ativada_app = scAjaxGetFieldSelect(nomeCampo_gamificacao_ativada_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_gamificacao_ativada_app(var_gamificacao_ativada_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_gamificacao_ativada_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_gamificacao_ativada_app

  function do_ajax_form_eventos_rsvp_validate_gamificacao_ativada_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "gamificacao_ativada_app";
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
  } // do_ajax_form_eventos_rsvp_validate_gamificacao_ativada_app_cb

  // ---------- Validate galeria_fotos_ativada_app
  function do_ajax_form_eventos_rsvp_validate_galeria_fotos_ativada_app()
  {
    var nomeCampo_galeria_fotos_ativada_app = "galeria_fotos_ativada_app";
    var var_galeria_fotos_ativada_app = scAjaxGetFieldSelect(nomeCampo_galeria_fotos_ativada_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_galeria_fotos_ativada_app(var_galeria_fotos_ativada_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_galeria_fotos_ativada_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_galeria_fotos_ativada_app

  function do_ajax_form_eventos_rsvp_validate_galeria_fotos_ativada_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "galeria_fotos_ativada_app";
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
  } // do_ajax_form_eventos_rsvp_validate_galeria_fotos_ativada_app_cb

  // ---------- Validate galeria_fotos_publicas_ativada_app
  function do_ajax_form_eventos_rsvp_validate_galeria_fotos_publicas_ativada_app()
  {
    var nomeCampo_galeria_fotos_publicas_ativada_app = "galeria_fotos_publicas_ativada_app";
    var var_galeria_fotos_publicas_ativada_app = scAjaxGetFieldSelect(nomeCampo_galeria_fotos_publicas_ativada_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_galeria_fotos_publicas_ativada_app(var_galeria_fotos_publicas_ativada_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_galeria_fotos_publicas_ativada_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_galeria_fotos_publicas_ativada_app

  function do_ajax_form_eventos_rsvp_validate_galeria_fotos_publicas_ativada_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "galeria_fotos_publicas_ativada_app";
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
  } // do_ajax_form_eventos_rsvp_validate_galeria_fotos_publicas_ativada_app_cb

  // ---------- Validate chat_evento_ativado_app
  function do_ajax_form_eventos_rsvp_validate_chat_evento_ativado_app()
  {
    var nomeCampo_chat_evento_ativado_app = "chat_evento_ativado_app";
    var var_chat_evento_ativado_app = scAjaxGetFieldSelect(nomeCampo_chat_evento_ativado_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_chat_evento_ativado_app(var_chat_evento_ativado_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_chat_evento_ativado_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_chat_evento_ativado_app

  function do_ajax_form_eventos_rsvp_validate_chat_evento_ativado_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "chat_evento_ativado_app";
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
  } // do_ajax_form_eventos_rsvp_validate_chat_evento_ativado_app_cb

  // ---------- Validate cidade_destino_app
  function do_ajax_form_eventos_rsvp_validate_cidade_destino_app()
  {
    var nomeCampo_cidade_destino_app = "cidade_destino_app";
    var var_cidade_destino_app = scAjaxGetFieldText(nomeCampo_cidade_destino_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_cidade_destino_app(var_cidade_destino_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_cidade_destino_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_cidade_destino_app

  function do_ajax_form_eventos_rsvp_validate_cidade_destino_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cidade_destino_app";
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
  } // do_ajax_form_eventos_rsvp_validate_cidade_destino_app_cb

  // ---------- Validate pais_destino_app
  function do_ajax_form_eventos_rsvp_validate_pais_destino_app()
  {
    var nomeCampo_pais_destino_app = "pais_destino_app";
    var var_pais_destino_app = scAjaxGetFieldSelect(nomeCampo_pais_destino_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_pais_destino_app(var_pais_destino_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_pais_destino_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_pais_destino_app

  function do_ajax_form_eventos_rsvp_validate_pais_destino_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "pais_destino_app";
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
  } // do_ajax_form_eventos_rsvp_validate_pais_destino_app_cb

  // ---------- Validate data_chegada_destino_app
  function do_ajax_form_eventos_rsvp_validate_data_chegada_destino_app()
  {
    var nomeCampo_data_chegada_destino_app = "data_chegada_destino_app";
    var var_data_chegada_destino_app = scAjaxGetFieldText(nomeCampo_data_chegada_destino_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_data_chegada_destino_app(var_data_chegada_destino_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_data_chegada_destino_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_data_chegada_destino_app

  function do_ajax_form_eventos_rsvp_validate_data_chegada_destino_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "data_chegada_destino_app";
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
  } // do_ajax_form_eventos_rsvp_validate_data_chegada_destino_app_cb

  // ---------- Validate data_partida_destino_app
  function do_ajax_form_eventos_rsvp_validate_data_partida_destino_app()
  {
    var nomeCampo_data_partida_destino_app = "data_partida_destino_app";
    var var_data_partida_destino_app = scAjaxGetFieldText(nomeCampo_data_partida_destino_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_data_partida_destino_app(var_data_partida_destino_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_data_partida_destino_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_data_partida_destino_app

  function do_ajax_form_eventos_rsvp_validate_data_partida_destino_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "data_partida_destino_app";
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
  } // do_ajax_form_eventos_rsvp_validate_data_partida_destino_app_cb

  // ---------- Validate texto_email_convite_app
  function do_ajax_form_eventos_rsvp_validate_texto_email_convite_app()
  {
    var nomeCampo_texto_email_convite_app = "texto_email_convite_app";
    var var_texto_email_convite_app = scAjaxGetFieldText(nomeCampo_texto_email_convite_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_texto_email_convite_app(var_texto_email_convite_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_texto_email_convite_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_texto_email_convite_app

  function do_ajax_form_eventos_rsvp_validate_texto_email_convite_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "texto_email_convite_app";
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
  } // do_ajax_form_eventos_rsvp_validate_texto_email_convite_app_cb

  // ---------- Validate texto_whatsapp_convite_app
  function do_ajax_form_eventos_rsvp_validate_texto_whatsapp_convite_app()
  {
    var nomeCampo_texto_whatsapp_convite_app = "texto_whatsapp_convite_app";
    var var_texto_whatsapp_convite_app = scAjaxGetFieldText(nomeCampo_texto_whatsapp_convite_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_texto_whatsapp_convite_app(var_texto_whatsapp_convite_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_texto_whatsapp_convite_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_texto_whatsapp_convite_app

  function do_ajax_form_eventos_rsvp_validate_texto_whatsapp_convite_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "texto_whatsapp_convite_app";
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
  } // do_ajax_form_eventos_rsvp_validate_texto_whatsapp_convite_app_cb

  // ---------- Validate termos_condicoes_app
  function do_ajax_form_eventos_rsvp_validate_termos_condicoes_app()
  {
    var nomeCampo_termos_condicoes_app = "termos_condicoes_app";
    var var_termos_condicoes_app = scAjaxGetFieldText(nomeCampo_termos_condicoes_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_termos_condicoes_app(var_termos_condicoes_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_termos_condicoes_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_termos_condicoes_app

  function do_ajax_form_eventos_rsvp_validate_termos_condicoes_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "termos_condicoes_app";
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
  } // do_ajax_form_eventos_rsvp_validate_termos_condicoes_app_cb

  // ---------- Validate canal_preferencial_convite_app
  function do_ajax_form_eventos_rsvp_validate_canal_preferencial_convite_app()
  {
    var nomeCampo_canal_preferencial_convite_app = "canal_preferencial_convite_app";
    var var_canal_preferencial_convite_app = scAjaxGetFieldSelect(nomeCampo_canal_preferencial_convite_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_eventos_rsvp_validate_canal_preferencial_convite_app(var_canal_preferencial_convite_app, var_script_case_init, do_ajax_form_eventos_rsvp_validate_canal_preferencial_convite_app_cb);
  } // do_ajax_form_eventos_rsvp_validate_canal_preferencial_convite_app

  function do_ajax_form_eventos_rsvp_validate_canal_preferencial_convite_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "canal_preferencial_convite_app";
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
  } // do_ajax_form_eventos_rsvp_validate_canal_preferencial_convite_app_cb

  // ---------- Event onchange data_conclusao_app
  function do_ajax_form_eventos_rsvp_event_data_conclusao_app_onchange()
  {
    var var_data_conclusao_app = scAjaxGetFieldText("data_conclusao_app");
    var var_evento_dt_realizacao = scAjaxGetFieldText("evento_dt_realizacao");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_eventos_rsvp_event_data_conclusao_app_onchange(var_data_conclusao_app, var_evento_dt_realizacao, var_script_case_init, do_ajax_form_eventos_rsvp_event_data_conclusao_app_onchange_cb);
  } // do_ajax_form_eventos_rsvp_event_data_conclusao_app_onchange

  function do_ajax_form_eventos_rsvp_event_data_conclusao_app_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "data_conclusao_app";
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
    scAjaxAlert(do_ajax_form_eventos_rsvp_event_data_conclusao_app_onchange_cb_after_alert);
  } // do_ajax_form_eventos_rsvp_event_data_conclusao_app_onchange_cb
  function do_ajax_form_eventos_rsvp_event_data_conclusao_app_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_eventos_rsvp_event_data_conclusao_app_onchange_cb_after_alert

  // ---------- Event onclick enviar_app
  function do_ajax_form_eventos_rsvp_event_enviar_app_onclick()
  {
    var var_enviar_app = scAjaxGetFieldRadio("enviar_app");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_eventos_rsvp_event_enviar_app_onclick(var_enviar_app, var_script_case_init, do_ajax_form_eventos_rsvp_event_enviar_app_onclick_cb);
  } // do_ajax_form_eventos_rsvp_event_enviar_app_onclick

  function do_ajax_form_eventos_rsvp_event_enviar_app_onclick_cb(sResp)
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
    scAjaxAlert(do_ajax_form_eventos_rsvp_event_enviar_app_onclick_cb_after_alert);
  } // do_ajax_form_eventos_rsvp_event_enviar_app_onclick_cb
  function do_ajax_form_eventos_rsvp_event_enviar_app_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_eventos_rsvp_event_enviar_app_onclick_cb_after_alert

  // ---------- Event onchange evento_numero
  function do_ajax_form_eventos_rsvp_event_evento_numero_onchange()
  {
    var var_localizacao = scAjaxGetFieldHidden("localizacao");
    var var_evento_logradouro = scAjaxGetFieldText("evento_logradouro");
    var var_evento_numero = scAjaxGetFieldText("evento_numero");
    var var_evento_bairro = scAjaxGetFieldText("evento_bairro");
    var var_evento_municipio = scAjaxGetFieldText("evento_municipio");
    var var_evento_uf = scAjaxGetFieldText("evento_uf");
    var var_evento_cep = scAjaxGetFieldText("evento_cep");
    var var_latitude_app = scAjaxGetFieldText("latitude_app");
    var var_longitude_app = scAjaxGetFieldText("longitude_app");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_eventos_rsvp_event_evento_numero_onchange(var_localizacao, var_evento_logradouro, var_evento_numero, var_evento_bairro, var_evento_municipio, var_evento_uf, var_evento_cep, var_latitude_app, var_longitude_app, var_script_case_init, do_ajax_form_eventos_rsvp_event_evento_numero_onchange_cb);
  } // do_ajax_form_eventos_rsvp_event_evento_numero_onchange

  function do_ajax_form_eventos_rsvp_event_evento_numero_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "evento_numero";
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
    scAjaxAlert(do_ajax_form_eventos_rsvp_event_evento_numero_onchange_cb_after_alert);
  } // do_ajax_form_eventos_rsvp_event_evento_numero_onchange_cb
  function do_ajax_form_eventos_rsvp_event_evento_numero_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_eventos_rsvp_event_evento_numero_onchange_cb_after_alert

  // ---------- Event onclick galeria_fotos_publicas_ativada_app
  function do_ajax_form_eventos_rsvp_event_galeria_fotos_publicas_ativada_app_onclick()
  {
    var var_galeria_fotos_ativada_app = scAjaxGetFieldSelect("galeria_fotos_ativada_app");
    var var_galeria_fotos_publicas_ativada_app = scAjaxGetFieldSelect("galeria_fotos_publicas_ativada_app");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_eventos_rsvp_event_galeria_fotos_publicas_ativada_app_onclick(var_galeria_fotos_ativada_app, var_galeria_fotos_publicas_ativada_app, var_script_case_init, do_ajax_form_eventos_rsvp_event_galeria_fotos_publicas_ativada_app_onclick_cb);
  } // do_ajax_form_eventos_rsvp_event_galeria_fotos_publicas_ativada_app_onclick

  function do_ajax_form_eventos_rsvp_event_galeria_fotos_publicas_ativada_app_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "galeria_fotos_publicas_ativada_app";
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
    scAjaxAlert(do_ajax_form_eventos_rsvp_event_galeria_fotos_publicas_ativada_app_onclick_cb_after_alert);
  } // do_ajax_form_eventos_rsvp_event_galeria_fotos_publicas_ativada_app_onclick_cb
  function do_ajax_form_eventos_rsvp_event_galeria_fotos_publicas_ativada_app_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_eventos_rsvp_event_galeria_fotos_publicas_ativada_app_onclick_cb_after_alert

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
  function do_ajax_form_eventos_rsvp_submit_form()
  {
    if (scEventControl_active("")) {
      setTimeout(function() { do_ajax_form_eventos_rsvp_submit_form(); }, 500);
      return;
    }
    scAjaxHideMessage();
    var var_particip_link = "";
    var var_empresa_link = "";
    var var_usuarios_link = "";
    var var_publicos_link = "";
    var var_hoteis_link = "";
    var var_cias_link = "";
    var var_tours_lnk = "";
    var var_regionais_link = "";
    var var_programacao_link = "";
    var var_mailling_link = "";
    var var_observacoes = "";
    var var_sql_log = scAjaxGetFieldHidden("sql_log");
    var var_evento_id = scAjaxGetFieldHidden("evento_id");
    var var_evento_id_interno = scAjaxGetFieldText("evento_id_interno");
    var var_evento_id_complementar = scAjaxGetFieldSelect("evento_id_complementar");
    var var_evento_nome = scAjaxGetFieldText("evento_nome");
    var var_evento_idioma = scAjaxGetFieldRadio("evento_idioma");
    var var_evento_dt_realizacao = scAjaxGetFieldText("evento_dt_realizacao");
    var var_evento_dt_conclusao = scAjaxGetFieldText("evento_dt_conclusao");
    var var_evento_status = scAjaxGetFieldRadio("evento_status");
    var var_evento_logo = scAjaxGetFieldText("evento_logo");
    var var_evento_website = scAjaxGetFieldText("evento_website");
    var var_cover_image = scAjaxGetFieldText("cover_image");
    var var_evento_email = scAjaxGetFieldText("evento_email");
    var var_evento_tipo = scAjaxGetFieldText("evento_tipo");
    var var_enviar_app = scAjaxGetFieldRadio("enviar_app");
    var var_evento_cep = scAjaxGetFieldText("evento_cep");
    var var_evento_pais = scAjaxGetFieldSelect("evento_pais");
    var var_evento_uf = scAjaxGetFieldText("evento_uf");
    var var_evento_municipio = scAjaxGetFieldText("evento_municipio");
    var var_evento_bairro = scAjaxGetFieldText("evento_bairro");
    var var_evento_logradouro = scAjaxGetFieldText("evento_logradouro");
    var var_evento_numero = scAjaxGetFieldText("evento_numero");
    var var_evento_complemento = scAjaxGetFieldText("evento_complemento");
    var var_evento_observacao = scAjaxGetFieldText("evento_observacao");
    var var_localizacao = scAjaxGetFieldHidden("localizacao");
    var var_latitude_app = scAjaxGetFieldText("latitude_app");
    var var_longitude_app = scAjaxGetFieldText("longitude_app");
    var var_evento_id_responsavel = scAjaxGetFieldSelect("evento_id_responsavel");
    var var_evento_telefone = scAjaxGetFieldText("evento_telefone");
    var var_evento_celular = scAjaxGetFieldText("evento_celular");
    var var_dsc_app = scAjaxGetFieldText("dsc_app");
    var var_data_conclusao_app = scAjaxGetFieldText("data_conclusao_app");
    var var_localizacao_app = scAjaxGetFieldText("localizacao_app");
    var var_status_app = scAjaxGetFieldSelect("status_app");
    var var_status_da_publicidade = scAjaxGetFieldSelect("status_da_publicidade");
    var var_timezone = scAjaxGetFieldSelect("timezone");
    var var_caminho_logo_cli = scAjaxGetFieldText("caminho_logo_cli");
    var var_caminho_cover_image = scAjaxGetFieldText("caminho_cover_image");
    var var_cor_principal_app = scAjaxGetFieldText("cor_principal_app");
    var var_cor_secundaria_app = scAjaxGetFieldText("cor_secundaria_app");
    var var_cor_fundo_app = scAjaxGetFieldText("cor_fundo_app");
    var var_nome_organizador_app = scAjaxGetFieldText("nome_organizador_app");
    var var_email_organizador_app = scAjaxGetFieldText("email_organizador_app");
    var var_nome_comprador_app = scAjaxGetFieldText("nome_comprador_app");
    var var_wz_suporte_app = scAjaxGetFieldText("wz_suporte_app");
    var var_gamificacao_ativada_app = scAjaxGetFieldSelect("gamificacao_ativada_app");
    var var_galeria_fotos_ativada_app = scAjaxGetFieldSelect("galeria_fotos_ativada_app");
    var var_galeria_fotos_publicas_ativada_app = scAjaxGetFieldSelect("galeria_fotos_publicas_ativada_app");
    var var_chat_evento_ativado_app = scAjaxGetFieldSelect("chat_evento_ativado_app");
    var var_cidade_destino_app = scAjaxGetFieldText("cidade_destino_app");
    var var_pais_destino_app = scAjaxGetFieldSelect("pais_destino_app");
    var var_data_chegada_destino_app = scAjaxGetFieldText("data_chegada_destino_app");
    var var_data_partida_destino_app = scAjaxGetFieldText("data_partida_destino_app");
    var var_texto_email_convite_app = scAjaxGetFieldText("texto_email_convite_app");
    var var_texto_whatsapp_convite_app = scAjaxGetFieldText("texto_whatsapp_convite_app");
    var var_termos_condicoes_app = scAjaxGetFieldText("termos_condicoes_app");
    var var_canal_preferencial_convite_app = scAjaxGetFieldSelect("canal_preferencial_convite_app");
    var var_evento_logo_ul_name = scAjaxSpecCharProtect(document.F1.evento_logo_ul_name.value);//.replace(/[+]/g, "__NM_PLUS__");
    var var_evento_logo_ul_type = document.F1.evento_logo_ul_type.value;
    var var_cover_image_ul_name = scAjaxSpecCharProtect(document.F1.cover_image_ul_name.value);//.replace(/[+]/g, "__NM_PLUS__");
    var var_cover_image_ul_type = document.F1.cover_image_ul_type.value;
    var var_evento_logo_limpa = document.F1.evento_logo_limpa.checked ? "S" : "N";
    var var_cover_image_limpa = document.F1.cover_image_limpa.checked ? "S" : "N";
    var var_nm_form_submit = document.F1.nm_form_submit.value;
    var var_nmgp_url_saida = document.F1.nmgp_url_saida.value;
    var var_nmgp_opcao = document.F1.nmgp_opcao.value;
    var var_nmgp_ancora = document.F1.nmgp_ancora.value;
    var var_nmgp_num_form = document.F1.nmgp_num_form.value;
    var var_nmgp_parms = document.F1.nmgp_parms.value;
    var var_script_case_init = document.F1.script_case_init.value;
    var var_csrf_token = scAjaxGetFieldText("csrf_token");
    scAjaxProcOn();
    x_ajax_form_eventos_rsvp_submit_form(var_particip_link, var_empresa_link, var_usuarios_link, var_publicos_link, var_hoteis_link, var_cias_link, var_tours_lnk, var_regionais_link, var_programacao_link, var_mailling_link, var_observacoes, var_sql_log, var_evento_id, var_evento_id_interno, var_evento_id_complementar, var_evento_nome, var_evento_idioma, var_evento_dt_realizacao, var_evento_dt_conclusao, var_evento_status, var_evento_logo, var_evento_website, var_cover_image, var_evento_email, var_evento_tipo, var_enviar_app, var_evento_cep, var_evento_pais, var_evento_uf, var_evento_municipio, var_evento_bairro, var_evento_logradouro, var_evento_numero, var_evento_complemento, var_evento_observacao, var_localizacao, var_latitude_app, var_longitude_app, var_evento_id_responsavel, var_evento_telefone, var_evento_celular, var_dsc_app, var_data_conclusao_app, var_localizacao_app, var_status_app, var_status_da_publicidade, var_timezone, var_caminho_logo_cli, var_caminho_cover_image, var_cor_principal_app, var_cor_secundaria_app, var_cor_fundo_app, var_nome_organizador_app, var_email_organizador_app, var_nome_comprador_app, var_wz_suporte_app, var_gamificacao_ativada_app, var_galeria_fotos_ativada_app, var_galeria_fotos_publicas_ativada_app, var_chat_evento_ativado_app, var_cidade_destino_app, var_pais_destino_app, var_data_chegada_destino_app, var_data_partida_destino_app, var_texto_email_convite_app, var_texto_whatsapp_convite_app, var_termos_condicoes_app, var_canal_preferencial_convite_app, var_evento_logo_ul_name, var_evento_logo_ul_type, var_cover_image_ul_name, var_cover_image_ul_type, var_evento_logo_limpa, var_cover_image_limpa, var_nm_form_submit, var_nmgp_url_saida, var_nmgp_opcao, var_nmgp_ancora, var_nmgp_num_form, var_nmgp_parms, var_script_case_init, var_csrf_token, do_ajax_form_eventos_rsvp_submit_form_cb);
  } // do_ajax_form_eventos_rsvp_submit_form

  function do_ajax_form_eventos_rsvp_submit_form_cb(sResp)
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
      scAjaxHideErrorDisplay("particip_link");
      scAjaxHideErrorDisplay("empresa_link");
      scAjaxHideErrorDisplay("usuarios_link");
      scAjaxHideErrorDisplay("publicos_link");
      scAjaxHideErrorDisplay("hoteis_link");
      scAjaxHideErrorDisplay("cias_link");
      scAjaxHideErrorDisplay("tours_lnk");
      scAjaxHideErrorDisplay("regionais_link");
      scAjaxHideErrorDisplay("programacao_link");
      scAjaxHideErrorDisplay("mailling_link");
      scAjaxHideErrorDisplay("observacoes");
      scAjaxHideErrorDisplay("sql_log");
      scAjaxHideErrorDisplay("evento_id");
      scAjaxHideErrorDisplay("evento_id_interno");
      scAjaxHideErrorDisplay("evento_id_complementar");
      scAjaxHideErrorDisplay("evento_nome");
      scAjaxHideErrorDisplay("evento_idioma");
      scAjaxHideErrorDisplay("evento_dt_realizacao");
      scAjaxHideErrorDisplay("evento_dt_conclusao");
      scAjaxHideErrorDisplay("evento_status");
      scAjaxHideErrorDisplay("evento_logo");
      scAjaxHideErrorDisplay("evento_website");
      scAjaxHideErrorDisplay("cover_image");
      scAjaxHideErrorDisplay("evento_email");
      scAjaxHideErrorDisplay("evento_tipo");
      scAjaxHideErrorDisplay("enviar_app");
      scAjaxHideErrorDisplay("evento_cep");
      scAjaxHideErrorDisplay("evento_pais");
      scAjaxHideErrorDisplay("evento_uf");
      scAjaxHideErrorDisplay("evento_municipio");
      scAjaxHideErrorDisplay("evento_bairro");
      scAjaxHideErrorDisplay("evento_logradouro");
      scAjaxHideErrorDisplay("evento_numero");
      scAjaxHideErrorDisplay("evento_complemento");
      scAjaxHideErrorDisplay("evento_observacao");
      scAjaxHideErrorDisplay("localizacao");
      scAjaxHideErrorDisplay("latitude_app");
      scAjaxHideErrorDisplay("longitude_app");
      scAjaxHideErrorDisplay("evento_id_responsavel");
      scAjaxHideErrorDisplay("evento_telefone");
      scAjaxHideErrorDisplay("evento_celular");
      scAjaxHideErrorDisplay("dsc_app");
      scAjaxHideErrorDisplay("data_conclusao_app");
      scAjaxHideErrorDisplay("localizacao_app");
      scAjaxHideErrorDisplay("status_app");
      scAjaxHideErrorDisplay("status_da_publicidade");
      scAjaxHideErrorDisplay("timezone");
      scAjaxHideErrorDisplay("caminho_logo_cli");
      scAjaxHideErrorDisplay("caminho_cover_image");
      scAjaxHideErrorDisplay("cor_principal_app");
      scAjaxHideErrorDisplay("cor_secundaria_app");
      scAjaxHideErrorDisplay("cor_fundo_app");
      scAjaxHideErrorDisplay("nome_organizador_app");
      scAjaxHideErrorDisplay("email_organizador_app");
      scAjaxHideErrorDisplay("nome_comprador_app");
      scAjaxHideErrorDisplay("wz_suporte_app");
      scAjaxHideErrorDisplay("gamificacao_ativada_app");
      scAjaxHideErrorDisplay("galeria_fotos_ativada_app");
      scAjaxHideErrorDisplay("galeria_fotos_publicas_ativada_app");
      scAjaxHideErrorDisplay("chat_evento_ativado_app");
      scAjaxHideErrorDisplay("cidade_destino_app");
      scAjaxHideErrorDisplay("pais_destino_app");
      scAjaxHideErrorDisplay("data_chegada_destino_app");
      scAjaxHideErrorDisplay("data_partida_destino_app");
      scAjaxHideErrorDisplay("texto_email_convite_app");
      scAjaxHideErrorDisplay("texto_whatsapp_convite_app");
      scAjaxHideErrorDisplay("termos_condicoes_app");
      scAjaxHideErrorDisplay("canal_preferencial_convite_app");
      scLigEditLookupCall();
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp']['dashboard_info']['under_dashboard']) {
?>
      var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp']['dashboard_info']['parent_widget']; ?>']");
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
      if (document.F1.evento_logo_limpa && document.F1.evento_logo_limpa.checked)
      {
        var oImgTemp = {0: {"value" : ""}};
        scAjaxSetFieldImage("evento_logo", oImgTemp, "", "", "", "N");
      }
      if (document.F1.cover_image_limpa && document.F1.cover_image_limpa.checked)
      {
        var oImgTemp = {0: {"value" : ""}};
        scAjaxSetFieldImage("cover_image", oImgTemp, "", "", "", "N");
      }
    document.F1.evento_logo_ul_name.value = '';
    document.F1.evento_logo_ul_type.value = '';
    document.F1.cover_image_ul_name.value = '';
    document.F1.cover_image_ul_type.value = '';
    }
    scAjaxShowDebug();
    scAjaxSetDisplay();
    scBtnDisabled();
    scBtnLabel();
    scAjaxSetLabel();
    scAjaxSetReadonly();
    scAjaxAlert(do_ajax_form_eventos_rsvp_submit_form_cb_after_alert);
  } // do_ajax_form_eventos_rsvp_submit_form_cb
  function do_ajax_form_eventos_rsvp_submit_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_eventos_rsvp_submit_form_cb_after_alert

  var scStatusDetail = {};

  function do_ajax_form_eventos_rsvp_navigate_form()
  {
    if (scFormHasChanged) {
      scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', perform_ajax_form_eventos_rsvp_navigate_form, function() {});
    } else {
      perform_ajax_form_eventos_rsvp_navigate_form();
    }
  }

  function perform_ajax_form_eventos_rsvp_navigate_form()
  {
    if (scRefreshTable())
    {
      return;
    }
    scAjaxHideMessage();
    scAjaxHideErrorDisplay("table");
    scAjaxHideErrorDisplay("particip_link");
    scAjaxHideErrorDisplay("empresa_link");
    scAjaxHideErrorDisplay("usuarios_link");
    scAjaxHideErrorDisplay("publicos_link");
    scAjaxHideErrorDisplay("hoteis_link");
    scAjaxHideErrorDisplay("cias_link");
    scAjaxHideErrorDisplay("tours_lnk");
    scAjaxHideErrorDisplay("regionais_link");
    scAjaxHideErrorDisplay("programacao_link");
    scAjaxHideErrorDisplay("mailling_link");
    scAjaxHideErrorDisplay("observacoes");
    scAjaxHideErrorDisplay("sql_log");
    scAjaxHideErrorDisplay("evento_id");
    scAjaxHideErrorDisplay("evento_id_interno");
    scAjaxHideErrorDisplay("evento_id_complementar");
    scAjaxHideErrorDisplay("evento_nome");
    scAjaxHideErrorDisplay("evento_idioma");
    scAjaxHideErrorDisplay("evento_dt_realizacao");
    scAjaxHideErrorDisplay("evento_dt_conclusao");
    scAjaxHideErrorDisplay("evento_status");
    scAjaxHideErrorDisplay("evento_logo");
    scAjaxHideErrorDisplay("evento_website");
    scAjaxHideErrorDisplay("cover_image");
    scAjaxHideErrorDisplay("evento_email");
    scAjaxHideErrorDisplay("evento_tipo");
    scAjaxHideErrorDisplay("enviar_app");
    scAjaxHideErrorDisplay("evento_cep");
    scAjaxHideErrorDisplay("evento_pais");
    scAjaxHideErrorDisplay("evento_uf");
    scAjaxHideErrorDisplay("evento_municipio");
    scAjaxHideErrorDisplay("evento_bairro");
    scAjaxHideErrorDisplay("evento_logradouro");
    scAjaxHideErrorDisplay("evento_numero");
    scAjaxHideErrorDisplay("evento_complemento");
    scAjaxHideErrorDisplay("evento_observacao");
    scAjaxHideErrorDisplay("localizacao");
    scAjaxHideErrorDisplay("latitude_app");
    scAjaxHideErrorDisplay("longitude_app");
    scAjaxHideErrorDisplay("evento_id_responsavel");
    scAjaxHideErrorDisplay("evento_telefone");
    scAjaxHideErrorDisplay("evento_celular");
    scAjaxHideErrorDisplay("dsc_app");
    scAjaxHideErrorDisplay("data_conclusao_app");
    scAjaxHideErrorDisplay("localizacao_app");
    scAjaxHideErrorDisplay("status_app");
    scAjaxHideErrorDisplay("status_da_publicidade");
    scAjaxHideErrorDisplay("timezone");
    scAjaxHideErrorDisplay("caminho_logo_cli");
    scAjaxHideErrorDisplay("caminho_cover_image");
    scAjaxHideErrorDisplay("cor_principal_app");
    scAjaxHideErrorDisplay("cor_secundaria_app");
    scAjaxHideErrorDisplay("cor_fundo_app");
    scAjaxHideErrorDisplay("nome_organizador_app");
    scAjaxHideErrorDisplay("email_organizador_app");
    scAjaxHideErrorDisplay("nome_comprador_app");
    scAjaxHideErrorDisplay("wz_suporte_app");
    scAjaxHideErrorDisplay("gamificacao_ativada_app");
    scAjaxHideErrorDisplay("galeria_fotos_ativada_app");
    scAjaxHideErrorDisplay("galeria_fotos_publicas_ativada_app");
    scAjaxHideErrorDisplay("chat_evento_ativado_app");
    scAjaxHideErrorDisplay("cidade_destino_app");
    scAjaxHideErrorDisplay("pais_destino_app");
    scAjaxHideErrorDisplay("data_chegada_destino_app");
    scAjaxHideErrorDisplay("data_partida_destino_app");
    scAjaxHideErrorDisplay("texto_email_convite_app");
    scAjaxHideErrorDisplay("texto_whatsapp_convite_app");
    scAjaxHideErrorDisplay("termos_condicoes_app");
    scAjaxHideErrorDisplay("canal_preferencial_convite_app");
    var var_evento_id = document.F2.evento_id.value;
    var var_nm_form_submit = document.F2.nm_form_submit.value;
    var var_nmgp_opcao = document.F2.nmgp_opcao.value;
    var var_nmgp_ordem = document.F2.nmgp_ordem.value;
    var var_nmgp_fast_search = document.F2.nmgp_fast_search.value;
    var var_nmgp_cond_fast_search = document.F2.nmgp_cond_fast_search.value;
    var var_nmgp_arg_fast_search = document.F2.nmgp_arg_fast_search.value;
    var var_nmgp_arg_dyn_search = document.F2.nmgp_arg_dyn_search.value;
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn();
    x_ajax_form_eventos_rsvp_navigate_form(var_evento_id, var_nm_form_submit, var_nmgp_opcao, var_nmgp_ordem, var_nmgp_fast_search,  var_nmgp_cond_fast_search,  var_nmgp_arg_fast_search, var_nmgp_arg_dyn_search, var_script_case_init, do_ajax_form_eventos_rsvp_navigate_form_cb);
  } // do_ajax_form_eventos_rsvp_navigate_form

  var scMasterDetailParentIframe = "<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp']['dashboard_info']['parent_widget'] ?>";
  var scMasterDetailIframe = {};
<?php
foreach ($this->Ini->sc_lig_iframe as $tmp_i => $tmp_v)
{
?>
  scMasterDetailIframe["<?php echo $tmp_i; ?>"] = "<?php echo $tmp_v; ?>";
<?php
}
?>
  function do_ajax_form_eventos_rsvp_navigate_form_cb(sResp)
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
    document.F2.evento_id.value = scAjaxGetKeyValue("evento_id");
    scAjaxSetSummary();
    scAjaxSetNavpage();
    scAjaxShowDebug();
    scAjaxSetLabel(true);
    scAjaxSetReadonly(true);
    scAjaxSetMaster();
    scAjaxSetNavStatus("t");
    scAjaxSetNavStatus("b");
    scAjaxSetDisplay(true);
    document.F1.evento_logo_ul_name.value = '';
    document.F1.evento_logo_ul_type.value = '';
    document.F1.cover_image_ul_name.value = '';
    document.F1.cover_image_ul_type.value = '';
    scAjaxSetBtnVars();
    $('.sc-js-ui-statusimg').css('display', 'none');
    scAjaxAlert(do_ajax_form_eventos_rsvp_navigate_form_cb_after_alert);
  } // do_ajax_form_eventos_rsvp_navigate_form_cb
  function do_ajax_form_eventos_rsvp_navigate_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scQuickSearchKeyUp('t', null);
    $('#SC_fast_search_t').blur();
    scAjaxSetFocus();
<?php
if ($this->Embutida_form)
{
?>
    do_ajax_form_eventos_rsvp_restore_buttons();
<?php
}
?>
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_eventos_rsvp_navigate_form_cb_after_alert

  function sc_hide_form_eventos_rsvp_form()
  {
    for (var block_id in ajax_block_id) {
      $("#div_" + ajax_block_id[block_id]).hide();
    }
  } // sc_hide_form_eventos_rsvp_form


  function scAjaxDetailProc()
  {
    return true;
  } // scAjaxDetailProc


  var ajax_error_geral = "";

  var ajax_error_type = new Array("valid", "onblur", "onchange", "onclick", "onfocus");

  var ajax_field_list = new Array();
  var ajax_field_Dt_Hr = new Array();
  ajax_field_list[0] = "particip_link";
  ajax_field_list[1] = "empresa_link";
  ajax_field_list[2] = "usuarios_link";
  ajax_field_list[3] = "publicos_link";
  ajax_field_list[4] = "hoteis_link";
  ajax_field_list[5] = "cias_link";
  ajax_field_list[6] = "tours_lnk";
  ajax_field_list[7] = "regionais_link";
  ajax_field_list[8] = "programacao_link";
  ajax_field_list[9] = "mailling_link";
  ajax_field_list[10] = "observacoes";
  ajax_field_list[11] = "sql_log";
  ajax_field_list[12] = "evento_id";
  ajax_field_list[13] = "evento_id_interno";
  ajax_field_list[14] = "evento_id_complementar";
  ajax_field_list[15] = "evento_nome";
  ajax_field_list[16] = "evento_idioma";
  ajax_field_list[17] = "evento_dt_realizacao";
  ajax_field_list[18] = "evento_dt_conclusao";
  ajax_field_list[19] = "evento_status";
  ajax_field_list[20] = "evento_logo";
  ajax_field_list[21] = "evento_website";
  ajax_field_list[22] = "cover_image";
  ajax_field_list[23] = "evento_email";
  ajax_field_list[24] = "evento_tipo";
  ajax_field_list[25] = "enviar_app";
  ajax_field_list[26] = "evento_cep";
  ajax_field_list[27] = "evento_pais";
  ajax_field_list[28] = "evento_uf";
  ajax_field_list[29] = "evento_municipio";
  ajax_field_list[30] = "evento_bairro";
  ajax_field_list[31] = "evento_logradouro";
  ajax_field_list[32] = "evento_numero";
  ajax_field_list[33] = "evento_complemento";
  ajax_field_list[34] = "evento_observacao";
  ajax_field_list[35] = "localizacao";
  ajax_field_list[36] = "latitude_app";
  ajax_field_list[37] = "longitude_app";
  ajax_field_list[38] = "evento_id_responsavel";
  ajax_field_list[39] = "evento_telefone";
  ajax_field_list[40] = "evento_celular";
  ajax_field_list[41] = "dsc_app";
  ajax_field_list[42] = "data_conclusao_app";
  ajax_field_list[43] = "localizacao_app";
  ajax_field_list[44] = "status_app";
  ajax_field_list[45] = "status_da_publicidade";
  ajax_field_list[46] = "timezone";
  ajax_field_list[47] = "caminho_logo_cli";
  ajax_field_list[48] = "caminho_cover_image";
  ajax_field_list[49] = "cor_principal_app";
  ajax_field_list[50] = "cor_secundaria_app";
  ajax_field_list[51] = "cor_fundo_app";
  ajax_field_list[52] = "nome_organizador_app";
  ajax_field_list[53] = "email_organizador_app";
  ajax_field_list[54] = "nome_comprador_app";
  ajax_field_list[55] = "wz_suporte_app";
  ajax_field_list[56] = "gamificacao_ativada_app";
  ajax_field_list[57] = "galeria_fotos_ativada_app";
  ajax_field_list[58] = "galeria_fotos_publicas_ativada_app";
  ajax_field_list[59] = "chat_evento_ativado_app";
  ajax_field_list[60] = "cidade_destino_app";
  ajax_field_list[61] = "pais_destino_app";
  ajax_field_list[62] = "data_chegada_destino_app";
  ajax_field_list[63] = "data_partida_destino_app";
  ajax_field_list[64] = "texto_email_convite_app";
  ajax_field_list[65] = "texto_whatsapp_convite_app";
  ajax_field_list[66] = "termos_condicoes_app";
  ajax_field_list[67] = "canal_preferencial_convite_app";

  var ajax_block_list = new Array();
  ajax_block_list[0] = "0";
  ajax_block_list[1] = "1";
  ajax_block_list[2] = "2";
  ajax_block_list[3] = "3";

  var ajax_error_list = {
    "particip_link": {"label": "Participantes", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "empresa_link": {"label": "Empresas", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "usuarios_link": {"label": "Usuários", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "publicos_link": {"label": "Públicos", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "hoteis_link": {"label": "Hotéis", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cias_link": {"label": "Bloqueio Aéreo", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "tours_lnk": {"label": "Tours", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "regionais_link": {"label": "Regionais", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "programacao_link": {"label": "Programações", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "mailling_link": {"label": "Mailling", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "observacoes": {"label": "Obs. Confirmação", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "sql_log": {"label": "sql_log", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_id": {"label": "Cód. Evento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_id_interno": {"label": "Código Interno:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_id_complementar": {"label": "Código Complementar:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_nome": {"label": "Nome:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_idioma": {"label": "Idioma:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_dt_realizacao": {"label": "Data da Realização:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_dt_conclusao": {"label": "Data da Conclusão:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_status": {"label": "Status:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_logo": {"label": " Logo do Evento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_website": {"label": "Website:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cover_image": {"label": "Logo do Cliente", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_email": {"label": "E-Mail:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_tipo": {"label": "Tipo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "enviar_app": {"label": "Gravar no APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_cep": {"label": "CEP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_pais": {"label": "País:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_uf": {"label": "UF:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_municipio": {"label": "Município:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_bairro": {"label": "Bairro:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_logradouro": {"label": "Logradouro:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_numero": {"label": "Numero:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_complemento": {"label": "Complemento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_observacao": {"label": "Observação:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "localizacao": {"label": "Google Maps:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "latitude_app": {"label": "Latitude APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "longitude_app": {"label": "Longitude APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_id_responsavel": {"label": "Responsável", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_telefone": {"label": " Telefone:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "evento_celular": {"label": "Celular:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "dsc_app": {"label": "Descrição APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "data_conclusao_app": {"label": "Data Conclusão APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "localizacao_app": {"label": "Localização APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "status_app": {"label": "Status APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "status_da_publicidade": {"label": "Status da Publicidade:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "timezone": {"label": "Timezone:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "caminho_logo_cli": {"label": "Logo Evento APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "caminho_cover_image": {"label": "Logo Cliente APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cor_principal_app": {"label": "Cor Principal APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cor_secundaria_app": {"label": "Cor Secundária APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cor_fundo_app": {"label": "Cor Fundo APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "nome_organizador_app": {"label": "Nome Organizador APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "email_organizador_app": {"label": "Email Organizador APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "nome_comprador_app": {"label": "Nome Comprador APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "wz_suporte_app": {"label": "Suporte Watsapp APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "gamificacao_ativada_app": {"label": "Gamificacao Ativada APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "galeria_fotos_ativada_app": {"label": "Galeria Fotos Ativada APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "galeria_fotos_publicas_ativada_app": {"label": "Galeria Fotos Públicas Ativada APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "chat_evento_ativado_app": {"label": "Chat Evento Ativado APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cidade_destino_app": {"label": "Cidade Destino APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "pais_destino_app": {"label": "Pais Destino APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "data_chegada_destino_app": {"label": "Data Chegada Destino APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "data_partida_destino_app": {"label": "Data Partida Destino APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "texto_email_convite_app": {"label": "Texto Email Convite APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "texto_whatsapp_convite_app": {"label": "Texto Whatsapp Convite APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "termos_condicoes_app": {"label": "Termos e Condições APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "canal_preferencial_convite_app": {"label": "Canal Preferencial Convite APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0}
  };
  var ajax_error_timeout = 0;

  var ajax_block_id = {
    "0": "hidden_bloco_0",
    "1": "hidden_bloco_1",
    "2": "hidden_bloco_2",
    "3": "hidden_bloco_3"
  };

  var ajax_block_tab = {
    "hidden_bloco_0": "",
    "hidden_bloco_1": "",
    "hidden_bloco_2": "",
    "hidden_bloco_3": ""
  };

  var ajax_field_mult = {
    "particip_link": new Array(),
    "empresa_link": new Array(),
    "usuarios_link": new Array(),
    "publicos_link": new Array(),
    "hoteis_link": new Array(),
    "cias_link": new Array(),
    "tours_lnk": new Array(),
    "regionais_link": new Array(),
    "programacao_link": new Array(),
    "mailling_link": new Array(),
    "observacoes": new Array(),
    "sql_log": new Array(),
    "evento_id": new Array(),
    "evento_id_interno": new Array(),
    "evento_id_complementar": new Array(),
    "evento_nome": new Array(),
    "evento_idioma": new Array(),
    "evento_dt_realizacao": new Array(),
    "evento_dt_conclusao": new Array(),
    "evento_status": new Array(),
    "evento_logo": new Array(),
    "evento_website": new Array(),
    "cover_image": new Array(),
    "evento_email": new Array(),
    "evento_tipo": new Array(),
    "enviar_app": new Array(),
    "evento_cep": new Array(),
    "evento_pais": new Array(),
    "evento_uf": new Array(),
    "evento_municipio": new Array(),
    "evento_bairro": new Array(),
    "evento_logradouro": new Array(),
    "evento_numero": new Array(),
    "evento_complemento": new Array(),
    "evento_observacao": new Array(),
    "localizacao": new Array(),
    "latitude_app": new Array(),
    "longitude_app": new Array(),
    "evento_id_responsavel": new Array(),
    "evento_telefone": new Array(),
    "evento_celular": new Array(),
    "dsc_app": new Array(),
    "data_conclusao_app": new Array(),
    "localizacao_app": new Array(),
    "status_app": new Array(),
    "status_da_publicidade": new Array(),
    "timezone": new Array(),
    "caminho_logo_cli": new Array(),
    "caminho_cover_image": new Array(),
    "cor_principal_app": new Array(),
    "cor_secundaria_app": new Array(),
    "cor_fundo_app": new Array(),
    "nome_organizador_app": new Array(),
    "email_organizador_app": new Array(),
    "nome_comprador_app": new Array(),
    "wz_suporte_app": new Array(),
    "gamificacao_ativada_app": new Array(),
    "galeria_fotos_ativada_app": new Array(),
    "galeria_fotos_publicas_ativada_app": new Array(),
    "chat_evento_ativado_app": new Array(),
    "cidade_destino_app": new Array(),
    "pais_destino_app": new Array(),
    "data_chegada_destino_app": new Array(),
    "data_partida_destino_app": new Array(),
    "texto_email_convite_app": new Array(),
    "texto_whatsapp_convite_app": new Array(),
    "termos_condicoes_app": new Array(),
    "canal_preferencial_convite_app": new Array()
  };
  ajax_field_mult["particip_link"][1] = "particip_link";
  ajax_field_mult["empresa_link"][1] = "empresa_link";
  ajax_field_mult["usuarios_link"][1] = "usuarios_link";
  ajax_field_mult["publicos_link"][1] = "publicos_link";
  ajax_field_mult["hoteis_link"][1] = "hoteis_link";
  ajax_field_mult["cias_link"][1] = "cias_link";
  ajax_field_mult["tours_lnk"][1] = "tours_lnk";
  ajax_field_mult["regionais_link"][1] = "regionais_link";
  ajax_field_mult["programacao_link"][1] = "programacao_link";
  ajax_field_mult["mailling_link"][1] = "mailling_link";
  ajax_field_mult["observacoes"][1] = "observacoes";
  ajax_field_mult["sql_log"][1] = "sql_log";
  ajax_field_mult["evento_id"][1] = "evento_id";
  ajax_field_mult["evento_id_interno"][1] = "evento_id_interno";
  ajax_field_mult["evento_id_complementar"][1] = "evento_id_complementar";
  ajax_field_mult["evento_nome"][1] = "evento_nome";
  ajax_field_mult["evento_idioma"][1] = "evento_idioma";
  ajax_field_mult["evento_dt_realizacao"][1] = "evento_dt_realizacao";
  ajax_field_mult["evento_dt_conclusao"][1] = "evento_dt_conclusao";
  ajax_field_mult["evento_status"][1] = "evento_status";
  ajax_field_mult["evento_logo"][1] = "evento_logo";
  ajax_field_mult["evento_website"][1] = "evento_website";
  ajax_field_mult["cover_image"][1] = "cover_image";
  ajax_field_mult["evento_email"][1] = "evento_email";
  ajax_field_mult["evento_tipo"][1] = "evento_tipo";
  ajax_field_mult["enviar_app"][1] = "enviar_app";
  ajax_field_mult["evento_cep"][1] = "evento_cep";
  ajax_field_mult["evento_pais"][1] = "evento_pais";
  ajax_field_mult["evento_uf"][1] = "evento_uf";
  ajax_field_mult["evento_municipio"][1] = "evento_municipio";
  ajax_field_mult["evento_bairro"][1] = "evento_bairro";
  ajax_field_mult["evento_logradouro"][1] = "evento_logradouro";
  ajax_field_mult["evento_numero"][1] = "evento_numero";
  ajax_field_mult["evento_complemento"][1] = "evento_complemento";
  ajax_field_mult["evento_observacao"][1] = "evento_observacao";
  ajax_field_mult["localizacao"][1] = "localizacao";
  ajax_field_mult["latitude_app"][1] = "latitude_app";
  ajax_field_mult["longitude_app"][1] = "longitude_app";
  ajax_field_mult["evento_id_responsavel"][1] = "evento_id_responsavel";
  ajax_field_mult["evento_telefone"][1] = "evento_telefone";
  ajax_field_mult["evento_celular"][1] = "evento_celular";
  ajax_field_mult["dsc_app"][1] = "dsc_app";
  ajax_field_mult["data_conclusao_app"][1] = "data_conclusao_app";
  ajax_field_mult["localizacao_app"][1] = "localizacao_app";
  ajax_field_mult["status_app"][1] = "status_app";
  ajax_field_mult["status_da_publicidade"][1] = "status_da_publicidade";
  ajax_field_mult["timezone"][1] = "timezone";
  ajax_field_mult["caminho_logo_cli"][1] = "caminho_logo_cli";
  ajax_field_mult["caminho_cover_image"][1] = "caminho_cover_image";
  ajax_field_mult["cor_principal_app"][1] = "cor_principal_app";
  ajax_field_mult["cor_secundaria_app"][1] = "cor_secundaria_app";
  ajax_field_mult["cor_fundo_app"][1] = "cor_fundo_app";
  ajax_field_mult["nome_organizador_app"][1] = "nome_organizador_app";
  ajax_field_mult["email_organizador_app"][1] = "email_organizador_app";
  ajax_field_mult["nome_comprador_app"][1] = "nome_comprador_app";
  ajax_field_mult["wz_suporte_app"][1] = "wz_suporte_app";
  ajax_field_mult["gamificacao_ativada_app"][1] = "gamificacao_ativada_app";
  ajax_field_mult["galeria_fotos_ativada_app"][1] = "galeria_fotos_ativada_app";
  ajax_field_mult["galeria_fotos_publicas_ativada_app"][1] = "galeria_fotos_publicas_ativada_app";
  ajax_field_mult["chat_evento_ativado_app"][1] = "chat_evento_ativado_app";
  ajax_field_mult["cidade_destino_app"][1] = "cidade_destino_app";
  ajax_field_mult["pais_destino_app"][1] = "pais_destino_app";
  ajax_field_mult["data_chegada_destino_app"][1] = "data_chegada_destino_app";
  ajax_field_mult["data_partida_destino_app"][1] = "data_partida_destino_app";
  ajax_field_mult["texto_email_convite_app"][1] = "texto_email_convite_app";
  ajax_field_mult["texto_whatsapp_convite_app"][1] = "texto_whatsapp_convite_app";
  ajax_field_mult["termos_condicoes_app"][1] = "termos_condicoes_app";
  ajax_field_mult["canal_preferencial_convite_app"][1] = "canal_preferencial_convite_app";

  var ajax_field_id = {
    "particip_link": new Array("hidden_field_label_particip_link", "hidden_field_data_particip_link"),
    "empresa_link": new Array("hidden_field_label_empresa_link", "hidden_field_data_empresa_link"),
    "usuarios_link": new Array("hidden_field_label_usuarios_link", "hidden_field_data_usuarios_link"),
    "publicos_link": new Array("hidden_field_label_publicos_link", "hidden_field_data_publicos_link"),
    "hoteis_link": new Array("hidden_field_label_hoteis_link", "hidden_field_data_hoteis_link"),
    "cias_link": new Array("hidden_field_label_cias_link", "hidden_field_data_cias_link"),
    "tours_lnk": new Array("hidden_field_label_tours_lnk", "hidden_field_data_tours_lnk"),
    "regionais_link": new Array("hidden_field_label_regionais_link", "hidden_field_data_regionais_link"),
    "programacao_link": new Array("hidden_field_label_programacao_link", "hidden_field_data_programacao_link"),
    "mailling_link": new Array("hidden_field_label_mailling_link", "hidden_field_data_mailling_link"),
    "observacoes": new Array("hidden_field_label_observacoes", "hidden_field_data_observacoes"),
    "evento_id": new Array("hidden_field_label_evento_id", "hidden_field_data_evento_id"),
    "evento_nome": new Array("hidden_field_label_evento_nome", "hidden_field_data_evento_nome"),
    "evento_idioma": new Array("hidden_field_label_evento_idioma", "hidden_field_data_evento_idioma"),
    "evento_dt_realizacao": new Array("hidden_field_label_evento_dt_realizacao", "hidden_field_data_evento_dt_realizacao"),
    "evento_dt_conclusao": new Array("hidden_field_label_evento_dt_conclusao", "hidden_field_data_evento_dt_conclusao"),
    "evento_status": new Array("hidden_field_label_evento_status", "hidden_field_data_evento_status"),
    "evento_logo": new Array("hidden_field_label_evento_logo", "hidden_field_data_evento_logo"),
    "evento_website": new Array("hidden_field_label_evento_website", "hidden_field_data_evento_website"),
    "cover_image": new Array("hidden_field_label_cover_image", "hidden_field_data_cover_image"),
    "evento_email": new Array("hidden_field_label_evento_email", "hidden_field_data_evento_email"),
    "enviar_app": new Array("hidden_field_label_enviar_app", "hidden_field_data_enviar_app"),
    "evento_cep": new Array("hidden_field_label_evento_cep", "hidden_field_data_evento_cep"),
    "evento_pais": new Array("hidden_field_label_evento_pais", "hidden_field_data_evento_pais"),
    "evento_uf": new Array("hidden_field_label_evento_uf", "hidden_field_data_evento_uf"),
    "evento_municipio": new Array("hidden_field_label_evento_municipio", "hidden_field_data_evento_municipio"),
    "evento_bairro": new Array("hidden_field_label_evento_bairro", "hidden_field_data_evento_bairro"),
    "evento_logradouro": new Array("hidden_field_label_evento_logradouro", "hidden_field_data_evento_logradouro"),
    "evento_numero": new Array("hidden_field_label_evento_numero", "hidden_field_data_evento_numero"),
    "evento_complemento": new Array("hidden_field_label_evento_complemento", "hidden_field_data_evento_complemento"),
    "evento_observacao": new Array("hidden_field_label_evento_observacao", "hidden_field_data_evento_observacao"),
    "localizacao": new Array("hidden_field_label_localizacao", "hidden_field_data_localizacao"),
    "latitude_app": new Array("hidden_field_label_latitude_app", "hidden_field_data_latitude_app"),
    "longitude_app": new Array("hidden_field_label_longitude_app", "hidden_field_data_longitude_app"),
    "evento_id_responsavel": new Array("hidden_field_label_evento_id_responsavel", "hidden_field_data_evento_id_responsavel"),
    "evento_telefone": new Array("hidden_field_label_evento_telefone", "hidden_field_data_evento_telefone"),
    "evento_celular": new Array("hidden_field_label_evento_celular", "hidden_field_data_evento_celular"),
    "dsc_app": new Array("hidden_field_label_dsc_app", "hidden_field_data_dsc_app"),
    "data_conclusao_app": new Array("hidden_field_label_data_conclusao_app", "hidden_field_data_data_conclusao_app"),
    "localizacao_app": new Array("hidden_field_label_localizacao_app", "hidden_field_data_localizacao_app"),
    "status_app": new Array("hidden_field_label_status_app", "hidden_field_data_status_app"),
    "status_da_publicidade": new Array("hidden_field_label_status_da_publicidade", "hidden_field_data_status_da_publicidade"),
    "timezone": new Array("hidden_field_label_timezone", "hidden_field_data_timezone"),
    "caminho_logo_cli": new Array("hidden_field_label_caminho_logo_cli", "hidden_field_data_caminho_logo_cli"),
    "caminho_cover_image": new Array("hidden_field_label_caminho_cover_image", "hidden_field_data_caminho_cover_image"),
    "cor_principal_app": new Array("hidden_field_label_cor_principal_app", "hidden_field_data_cor_principal_app"),
    "cor_secundaria_app": new Array("hidden_field_label_cor_secundaria_app", "hidden_field_data_cor_secundaria_app"),
    "cor_fundo_app": new Array("hidden_field_label_cor_fundo_app", "hidden_field_data_cor_fundo_app"),
    "nome_organizador_app": new Array("hidden_field_label_nome_organizador_app", "hidden_field_data_nome_organizador_app"),
    "email_organizador_app": new Array("hidden_field_label_email_organizador_app", "hidden_field_data_email_organizador_app"),
    "nome_comprador_app": new Array("hidden_field_label_nome_comprador_app", "hidden_field_data_nome_comprador_app"),
    "wz_suporte_app": new Array("hidden_field_label_wz_suporte_app", "hidden_field_data_wz_suporte_app"),
    "gamificacao_ativada_app": new Array("hidden_field_label_gamificacao_ativada_app", "hidden_field_data_gamificacao_ativada_app"),
    "galeria_fotos_ativada_app": new Array("hidden_field_label_galeria_fotos_ativada_app", "hidden_field_data_galeria_fotos_ativada_app"),
    "galeria_fotos_publicas_ativada_app": new Array("hidden_field_label_galeria_fotos_publicas_ativada_app", "hidden_field_data_galeria_fotos_publicas_ativada_app"),
    "chat_evento_ativado_app": new Array("hidden_field_label_chat_evento_ativado_app", "hidden_field_data_chat_evento_ativado_app"),
    "cidade_destino_app": new Array("hidden_field_label_cidade_destino_app", "hidden_field_data_cidade_destino_app"),
    "pais_destino_app": new Array("hidden_field_label_pais_destino_app", "hidden_field_data_pais_destino_app"),
    "data_chegada_destino_app": new Array("hidden_field_label_data_chegada_destino_app", "hidden_field_data_data_chegada_destino_app"),
    "data_partida_destino_app": new Array("hidden_field_label_data_partida_destino_app", "hidden_field_data_data_partida_destino_app"),
    "texto_email_convite_app": new Array("hidden_field_label_texto_email_convite_app", "hidden_field_data_texto_email_convite_app"),
    "texto_whatsapp_convite_app": new Array("hidden_field_label_texto_whatsapp_convite_app", "hidden_field_data_texto_whatsapp_convite_app"),
    "termos_condicoes_app": new Array("hidden_field_label_termos_condicoes_app", "hidden_field_data_termos_condicoes_app"),
    "canal_preferencial_convite_app": new Array("hidden_field_label_canal_preferencial_convite_app", "hidden_field_data_canal_preferencial_convite_app")
  };

  var ajax_read_only = {
    "particip_link": "off",
    "empresa_link": "off",
    "usuarios_link": "off",
    "publicos_link": "off",
    "hoteis_link": "off",
    "cias_link": "off",
    "tours_lnk": "off",
    "regionais_link": "off",
    "programacao_link": "off",
    "mailling_link": "off",
    "observacoes": "off",
    "sql_log": "off",
    "evento_id": "on",
    "evento_id_interno": "off",
    "evento_id_complementar": "on",
    "evento_nome": "off",
    "evento_idioma": "off",
    "evento_dt_realizacao": "off",
    "evento_dt_conclusao": "off",
    "evento_status": "off",
    "evento_logo": "off",
    "evento_website": "off",
    "cover_image": "off",
    "evento_email": "off",
    "evento_tipo": "off",
    "enviar_app": "off",
    "evento_cep": "off",
    "evento_pais": "off",
    "evento_uf": "off",
    "evento_municipio": "off",
    "evento_bairro": "off",
    "evento_logradouro": "off",
    "evento_numero": "off",
    "evento_complemento": "off",
    "evento_observacao": "off",
    "localizacao": "off",
    "latitude_app": "off",
    "longitude_app": "off",
    "evento_id_responsavel": "off",
    "evento_telefone": "off",
    "evento_celular": "off",
    "dsc_app": "off",
    "data_conclusao_app": "off",
    "localizacao_app": "off",
    "status_app": "off",
    "status_da_publicidade": "off",
    "timezone": "off",
    "caminho_logo_cli": "off",
    "caminho_cover_image": "off",
    "cor_principal_app": "off",
    "cor_secundaria_app": "off",
    "cor_fundo_app": "off",
    "nome_organizador_app": "off",
    "email_organizador_app": "off",
    "nome_comprador_app": "off",
    "wz_suporte_app": "off",
    "gamificacao_ativada_app": "off",
    "galeria_fotos_ativada_app": "off",
    "galeria_fotos_publicas_ativada_app": "off",
    "chat_evento_ativado_app": "off",
    "cidade_destino_app": "off",
    "pais_destino_app": "off",
    "data_chegada_destino_app": "off",
    "data_partida_destino_app": "off",
    "texto_email_convite_app": "off",
    "texto_whatsapp_convite_app": "off",
    "termos_condicoes_app": "off",
    "canal_preferencial_convite_app": "off"
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
    if ("particip_link" == sIndex)
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
    if ("empresa_link" == sIndex)
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
    if ("usuarios_link" == sIndex)
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
    if ("publicos_link" == sIndex)
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
    if ("hoteis_link" == sIndex)
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
    if ("cias_link" == sIndex)
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
    if ("tours_lnk" == sIndex)
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
    if ("regionais_link" == sIndex)
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
    if ("programacao_link" == sIndex)
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
    if ("mailling_link" == sIndex)
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
    if ("observacoes" == sIndex)
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
    if ("evento_id" == sIndex)
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
    if ("evento_id_interno" == sIndex)
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
    if ("evento_id_complementar" == sIndex)
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
    if ("evento_nome" == sIndex)
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
    if ("evento_idioma" == sIndex)
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
    if ("evento_dt_realizacao" == sIndex)
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
    if ("evento_dt_conclusao" == sIndex)
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
    if ("evento_status" == sIndex)
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
    if ("evento_logo" == sIndex)
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
    if ("evento_website" == sIndex)
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
    if ("cover_image" == sIndex)
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
    if ("evento_email" == sIndex)
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
    if ("evento_tipo" == sIndex)
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
    if ("evento_cep" == sIndex)
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
    if ("evento_pais" == sIndex)
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
    if ("evento_uf" == sIndex)
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
    if ("evento_municipio" == sIndex)
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
    if ("evento_bairro" == sIndex)
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
    if ("evento_logradouro" == sIndex)
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
    if ("evento_numero" == sIndex)
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
    if ("evento_complemento" == sIndex)
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
    if ("evento_observacao" == sIndex)
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
    if ("latitude_app" == sIndex)
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
    if ("longitude_app" == sIndex)
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
    if ("evento_id_responsavel" == sIndex)
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
    if ("evento_telefone" == sIndex)
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
    if ("evento_celular" == sIndex)
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
    if ("dsc_app" == sIndex)
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
    if ("data_conclusao_app" == sIndex)
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
    if ("localizacao_app" == sIndex)
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
    if ("status_app" == sIndex)
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
    if ("status_da_publicidade" == sIndex)
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
    if ("timezone" == sIndex)
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
    if ("caminho_logo_cli" == sIndex)
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
    if ("caminho_cover_image" == sIndex)
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
    if ("cor_principal_app" == sIndex)
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
    if ("cor_secundaria_app" == sIndex)
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
    if ("cor_fundo_app" == sIndex)
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
    if ("nome_organizador_app" == sIndex)
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
    if ("email_organizador_app" == sIndex)
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
    if ("nome_comprador_app" == sIndex)
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
    if ("wz_suporte_app" == sIndex)
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
    if ("gamificacao_ativada_app" == sIndex)
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
    if ("galeria_fotos_ativada_app" == sIndex)
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
    if ("galeria_fotos_publicas_ativada_app" == sIndex)
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
    if ("chat_evento_ativado_app" == sIndex)
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
    if ("cidade_destino_app" == sIndex)
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
    if ("pais_destino_app" == sIndex)
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
    if ("data_chegada_destino_app" == sIndex)
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
    if ("data_partida_destino_app" == sIndex)
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
    if ("texto_email_convite_app" == sIndex)
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
    if ("texto_whatsapp_convite_app" == sIndex)
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
    if ("termos_condicoes_app" == sIndex)
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
    if ("canal_preferencial_convite_app" == sIndex)
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
    scAjaxSetFieldInnerHtml(sIndex, aValue);
  }
 </SCRIPT>
