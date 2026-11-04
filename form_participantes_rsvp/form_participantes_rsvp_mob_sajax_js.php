
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
        if ("geral_form_participantes_rsvp_mob" == sTestField)
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
        sc_hide_form_participantes_rsvp_mob_form();
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

  // ---------- Validate participante_id
  function do_ajax_form_participantes_rsvp_mob_validate_participante_id()
  {
    var nomeCampo_participante_id = "participante_id";
    var var_participante_id = scAjaxGetFieldHidden(nomeCampo_participante_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_participante_id(var_participante_id, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_participante_id_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_participante_id

  function do_ajax_form_participantes_rsvp_mob_validate_participante_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "participante_id";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_participante_id_cb

  // ---------- Validate importacao
  function do_ajax_form_participantes_rsvp_mob_validate_importacao()
  {
    var nomeCampo_importacao = "importacao";
    var var_importacao = scAjaxGetFieldRadio(nomeCampo_importacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_importacao(var_importacao, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_importacao_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_importacao

  function do_ajax_form_participantes_rsvp_mob_validate_importacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "importacao";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_importacao_cb

  // ---------- Validate nacionalidade
  function do_ajax_form_participantes_rsvp_mob_validate_nacionalidade()
  {
    var nomeCampo_nacionalidade = "nacionalidade";
    var var_nacionalidade = scAjaxGetFieldSelect(nomeCampo_nacionalidade);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_nacionalidade(var_nacionalidade, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_nacionalidade_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_nacionalidade

  function do_ajax_form_participantes_rsvp_mob_validate_nacionalidade_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "nacionalidade";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_nacionalidade_cb

  // ---------- Validate part_cpf
  function do_ajax_form_participantes_rsvp_mob_validate_part_cpf()
  {
    var nomeCampo_part_cpf = "part_cpf";
    var var_part_cpf = scAjaxGetFieldText(nomeCampo_part_cpf);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_cpf(var_part_cpf, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_cpf_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cpf

  function do_ajax_form_participantes_rsvp_mob_validate_part_cpf_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_cpf";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cpf_cb

  // ---------- Validate nome
  function do_ajax_form_participantes_rsvp_mob_validate_nome()
  {
    var nomeCampo_nome = "nome";
    var var_nome = scAjaxGetFieldText(nomeCampo_nome);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_nome(var_nome, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_nome_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_nome

  function do_ajax_form_participantes_rsvp_mob_validate_nome_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "nome";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_nome_cb

  // ---------- Validate part_ativo
  function do_ajax_form_participantes_rsvp_mob_validate_part_ativo()
  {
    var nomeCampo_part_ativo = "part_ativo";
    var var_part_ativo = scAjaxGetFieldRadio(nomeCampo_part_ativo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_ativo(var_part_ativo, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_ativo_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_ativo

  function do_ajax_form_participantes_rsvp_mob_validate_part_ativo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_ativo";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_ativo_cb

  // ---------- Validate part_tipo
  function do_ajax_form_participantes_rsvp_mob_validate_part_tipo()
  {
    var nomeCampo_part_tipo = "part_tipo";
    var var_part_tipo = scAjaxGetFieldText(nomeCampo_part_tipo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_tipo(var_part_tipo, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_tipo_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_tipo

  function do_ajax_form_participantes_rsvp_mob_validate_part_tipo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_tipo";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_tipo_cb

  // ---------- Validate part_sexo
  function do_ajax_form_participantes_rsvp_mob_validate_part_sexo()
  {
    var nomeCampo_part_sexo = "part_sexo";
    var var_part_sexo = scAjaxGetFieldRadio(nomeCampo_part_sexo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_sexo(var_part_sexo, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_sexo_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_sexo

  function do_ajax_form_participantes_rsvp_mob_validate_part_sexo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_sexo";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_sexo_cb

  // ---------- Validate enviar_app
  function do_ajax_form_participantes_rsvp_mob_validate_enviar_app()
  {
    var nomeCampo_enviar_app = "enviar_app";
    var var_enviar_app = scAjaxGetFieldRadio(nomeCampo_enviar_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_enviar_app(var_enviar_app, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_enviar_app_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_enviar_app

  function do_ajax_form_participantes_rsvp_mob_validate_enviar_app_cb(sResp)
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
  } // do_ajax_form_participantes_rsvp_mob_validate_enviar_app_cb

  // ---------- Validate part_nome_cracha
  function do_ajax_form_participantes_rsvp_mob_validate_part_nome_cracha()
  {
    var nomeCampo_part_nome_cracha = "part_nome_cracha";
    var var_part_nome_cracha = scAjaxGetFieldText(nomeCampo_part_nome_cracha);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_nome_cracha(var_part_nome_cracha, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_nome_cracha_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nome_cracha

  function do_ajax_form_participantes_rsvp_mob_validate_part_nome_cracha_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_nome_cracha";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nome_cracha_cb

  // ---------- Validate part_id_evento
  function do_ajax_form_participantes_rsvp_mob_validate_part_id_evento()
  {
    var nomeCampo_part_id_evento = "part_id_evento";
    var var_part_id_evento = scAjaxGetFieldSelect(nomeCampo_part_id_evento);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_id_evento(var_part_id_evento, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_id_evento

  function do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_id_evento";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_cb

  // ---------- Validate part_id_evento_publico
  function do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_publico()
  {
    var nomeCampo_part_id_evento_publico = "part_id_evento_publico";
    var var_part_id_evento_publico = scAjaxGetFieldSelect(nomeCampo_part_id_evento_publico);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_id_evento_publico(var_part_id_evento_publico, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_publico_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_publico

  function do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_publico_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_id_evento_publico";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_publico_cb

  // ---------- Validate part_id_evento_regional
  function do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_regional()
  {
    var nomeCampo_part_id_evento_regional = "part_id_evento_regional";
    var var_part_id_evento_regional = scAjaxGetFieldSelect(nomeCampo_part_id_evento_regional);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_id_evento_regional(var_part_id_evento_regional, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_regional_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_regional

  function do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_regional_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_id_evento_regional";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_regional_cb

  // ---------- Validate part_tipo_pessoa
  function do_ajax_form_participantes_rsvp_mob_validate_part_tipo_pessoa()
  {
    var nomeCampo_part_tipo_pessoa = "part_tipo_pessoa";
    var var_part_tipo_pessoa = scAjaxGetFieldRadio(nomeCampo_part_tipo_pessoa);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_tipo_pessoa(var_part_tipo_pessoa, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_tipo_pessoa_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_tipo_pessoa

  function do_ajax_form_participantes_rsvp_mob_validate_part_tipo_pessoa_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_tipo_pessoa";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_tipo_pessoa_cb

  // ---------- Validate part_dt_nasc
  function do_ajax_form_participantes_rsvp_mob_validate_part_dt_nasc()
  {
    var nomeCampo_part_dt_nasc = "part_dt_nasc";
    var var_part_dt_nasc = scAjaxGetFieldText(nomeCampo_part_dt_nasc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_dt_nasc(var_part_dt_nasc, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_dt_nasc_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_dt_nasc

  function do_ajax_form_participantes_rsvp_mob_validate_part_dt_nasc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_dt_nasc";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_dt_nasc_cb

  // ---------- Validate part_filiacao
  function do_ajax_form_participantes_rsvp_mob_validate_part_filiacao()
  {
    var nomeCampo_part_filiacao = "part_filiacao";
    var var_part_filiacao = scAjaxGetFieldText(nomeCampo_part_filiacao);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_filiacao(var_part_filiacao, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_filiacao_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_filiacao

  function do_ajax_form_participantes_rsvp_mob_validate_part_filiacao_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_filiacao";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_filiacao_cb

  // ---------- Validate estrangeiro
  function do_ajax_form_participantes_rsvp_mob_validate_estrangeiro()
  {
    var nomeCampo_estrangeiro = "estrangeiro";
    var var_estrangeiro = scAjaxGetFieldRadio(nomeCampo_estrangeiro);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_estrangeiro(var_estrangeiro, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_estrangeiro_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_estrangeiro

  function do_ajax_form_participantes_rsvp_mob_validate_estrangeiro_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "estrangeiro";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_estrangeiro_cb

  // ---------- Validate part_substituido
  function do_ajax_form_participantes_rsvp_mob_validate_part_substituido()
  {
    var nomeCampo_part_substituido = "part_substituido";
    var var_part_substituido = scAjaxGetFieldRadio(nomeCampo_part_substituido);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_substituido(var_part_substituido, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_substituido_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_substituido

  function do_ajax_form_participantes_rsvp_mob_validate_part_substituido_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_substituido";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_substituido_cb

  // ---------- Validate part_cod_substituto
  function do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituto()
  {
    var nomeCampo_part_cod_substituto = "part_cod_substituto";
    var var_part_cod_substituto = scAjaxGetFieldText(nomeCampo_part_cod_substituto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_cod_substituto(var_part_cod_substituto, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituto_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituto

  function do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_cod_substituto";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituto_cb

  // ---------- Validate part_nome_substituto
  function do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituto()
  {
    var nomeCampo_part_nome_substituto = "part_nome_substituto";
    var var_part_nome_substituto = scAjaxGetFieldText(nomeCampo_part_nome_substituto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_nome_substituto(var_part_nome_substituto, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituto_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituto

  function do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_nome_substituto";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituto_cb

  // ---------- Validate part_sexo_substituto
  function do_ajax_form_participantes_rsvp_mob_validate_part_sexo_substituto()
  {
    var nomeCampo_part_sexo_substituto = "part_sexo_substituto";
    var var_part_sexo_substituto = scAjaxGetFieldRadio(nomeCampo_part_sexo_substituto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_sexo_substituto(var_part_sexo_substituto, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_sexo_substituto_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_sexo_substituto

  function do_ajax_form_participantes_rsvp_mob_validate_part_sexo_substituto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_sexo_substituto";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_sexo_substituto_cb

  // ---------- Validate guarda_cod_substituto
  function do_ajax_form_participantes_rsvp_mob_validate_guarda_cod_substituto()
  {
    var nomeCampo_guarda_cod_substituto = "guarda_cod_substituto";
    var var_guarda_cod_substituto = scAjaxGetFieldHidden(nomeCampo_guarda_cod_substituto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_guarda_cod_substituto(var_guarda_cod_substituto, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_guarda_cod_substituto_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_guarda_cod_substituto

  function do_ajax_form_participantes_rsvp_mob_validate_guarda_cod_substituto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "guarda_cod_substituto";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_guarda_cod_substituto_cb

  // ---------- Validate part_empresa
  function do_ajax_form_participantes_rsvp_mob_validate_part_empresa()
  {
    var nomeCampo_part_empresa = "part_empresa";
    var var_part_empresa = scAjaxGetFieldText(nomeCampo_part_empresa);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_empresa(var_part_empresa, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_empresa_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_empresa

  function do_ajax_form_participantes_rsvp_mob_validate_part_empresa_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_empresa";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_empresa_cb

  // ---------- Validate part_departamento
  function do_ajax_form_participantes_rsvp_mob_validate_part_departamento()
  {
    var nomeCampo_part_departamento = "part_departamento";
    var var_part_departamento = scAjaxGetFieldText(nomeCampo_part_departamento);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_departamento(var_part_departamento, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_departamento_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_departamento

  function do_ajax_form_participantes_rsvp_mob_validate_part_departamento_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_departamento";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_departamento_cb

  // ---------- Validate part_cargo
  function do_ajax_form_participantes_rsvp_mob_validate_part_cargo()
  {
    var nomeCampo_part_cargo = "part_cargo";
    var var_part_cargo = scAjaxGetFieldText(nomeCampo_part_cargo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_cargo(var_part_cargo, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_cargo_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cargo

  function do_ajax_form_participantes_rsvp_mob_validate_part_cargo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_cargo";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cargo_cb

  // ---------- Validate part_grupo
  function do_ajax_form_participantes_rsvp_mob_validate_part_grupo()
  {
    var nomeCampo_part_grupo = "part_grupo";
    var var_part_grupo = scAjaxGetFieldText(nomeCampo_part_grupo);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_grupo(var_part_grupo, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_grupo_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_grupo

  function do_ajax_form_participantes_rsvp_mob_validate_part_grupo_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_grupo";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_grupo_cb

  // ---------- Validate part_clube
  function do_ajax_form_participantes_rsvp_mob_validate_part_clube()
  {
    var nomeCampo_part_clube = "part_clube";
    var var_part_clube = scAjaxGetFieldText(nomeCampo_part_clube);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_clube(var_part_clube, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_clube_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_clube

  function do_ajax_form_participantes_rsvp_mob_validate_part_clube_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_clube";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_clube_cb

  // ---------- Validate dsc_empresa_rsvp
  function do_ajax_form_participantes_rsvp_mob_validate_dsc_empresa_rsvp()
  {
    var nomeCampo_dsc_empresa_rsvp = "dsc_empresa_rsvp";
    var var_dsc_empresa_rsvp = scAjaxGetFieldSelect(nomeCampo_dsc_empresa_rsvp);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_dsc_empresa_rsvp(var_dsc_empresa_rsvp, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_dsc_empresa_rsvp_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_dsc_empresa_rsvp

  function do_ajax_form_participantes_rsvp_mob_validate_dsc_empresa_rsvp_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "dsc_empresa_rsvp";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_dsc_empresa_rsvp_cb

  // ---------- Validate cod_empresa_rsvp
  function do_ajax_form_participantes_rsvp_mob_validate_cod_empresa_rsvp()
  {
    var nomeCampo_cod_empresa_rsvp = "cod_empresa_rsvp";
    var var_cod_empresa_rsvp = scAjaxGetFieldHidden(nomeCampo_cod_empresa_rsvp);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_cod_empresa_rsvp(var_cod_empresa_rsvp, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_cod_empresa_rsvp_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_cod_empresa_rsvp

  function do_ajax_form_participantes_rsvp_mob_validate_cod_empresa_rsvp_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "cod_empresa_rsvp";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_cod_empresa_rsvp_cb

  // ---------- Validate part_cep
  function do_ajax_form_participantes_rsvp_mob_validate_part_cep()
  {
    var nomeCampo_part_cep = "part_cep";
    var var_part_cep = scAjaxGetFieldText(nomeCampo_part_cep);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_cep(var_part_cep, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_cep_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cep

  function do_ajax_form_participantes_rsvp_mob_validate_part_cep_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_cep";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cep_cb

  // ---------- Validate part_logradouro
  function do_ajax_form_participantes_rsvp_mob_validate_part_logradouro()
  {
    var nomeCampo_part_logradouro = "part_logradouro";
    var var_part_logradouro = scAjaxGetFieldText(nomeCampo_part_logradouro);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_logradouro(var_part_logradouro, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_logradouro_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_logradouro

  function do_ajax_form_participantes_rsvp_mob_validate_part_logradouro_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_logradouro";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_logradouro_cb

  // ---------- Validate part_numero
  function do_ajax_form_participantes_rsvp_mob_validate_part_numero()
  {
    var nomeCampo_part_numero = "part_numero";
    var var_part_numero = scAjaxGetFieldText(nomeCampo_part_numero);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_numero(var_part_numero, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_numero_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_numero

  function do_ajax_form_participantes_rsvp_mob_validate_part_numero_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_numero";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_numero_cb

  // ---------- Validate part_complemento
  function do_ajax_form_participantes_rsvp_mob_validate_part_complemento()
  {
    var nomeCampo_part_complemento = "part_complemento";
    var var_part_complemento = scAjaxGetFieldText(nomeCampo_part_complemento);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_complemento(var_part_complemento, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_complemento_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_complemento

  function do_ajax_form_participantes_rsvp_mob_validate_part_complemento_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_complemento";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_complemento_cb

  // ---------- Validate part_bairro
  function do_ajax_form_participantes_rsvp_mob_validate_part_bairro()
  {
    var nomeCampo_part_bairro = "part_bairro";
    var var_part_bairro = scAjaxGetFieldText(nomeCampo_part_bairro);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_bairro(var_part_bairro, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_bairro_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_bairro

  function do_ajax_form_participantes_rsvp_mob_validate_part_bairro_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_bairro";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_bairro_cb

  // ---------- Validate part_cidade
  function do_ajax_form_participantes_rsvp_mob_validate_part_cidade()
  {
    var nomeCampo_part_cidade = "part_cidade";
    var var_part_cidade = scAjaxGetFieldText(nomeCampo_part_cidade);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_cidade(var_part_cidade, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_cidade_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cidade

  function do_ajax_form_participantes_rsvp_mob_validate_part_cidade_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_cidade";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cidade_cb

  // ---------- Validate part_uf
  function do_ajax_form_participantes_rsvp_mob_validate_part_uf()
  {
    var nomeCampo_part_uf = "part_uf";
    var var_part_uf = scAjaxGetFieldText(nomeCampo_part_uf);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_uf(var_part_uf, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_uf_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_uf

  function do_ajax_form_participantes_rsvp_mob_validate_part_uf_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_uf";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_uf_cb

  // ---------- Validate part_ddd_01
  function do_ajax_form_participantes_rsvp_mob_validate_part_ddd_01()
  {
    var nomeCampo_part_ddd_01 = "part_ddd_01";
    var var_part_ddd_01 = scAjaxGetFieldText(nomeCampo_part_ddd_01);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_ddd_01(var_part_ddd_01, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_ddd_01_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_ddd_01

  function do_ajax_form_participantes_rsvp_mob_validate_part_ddd_01_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_ddd_01";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_ddd_01_cb

  // ---------- Validate part_fone_01
  function do_ajax_form_participantes_rsvp_mob_validate_part_fone_01()
  {
    var nomeCampo_part_fone_01 = "part_fone_01";
    var var_part_fone_01 = scAjaxGetFieldText(nomeCampo_part_fone_01);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_fone_01(var_part_fone_01, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_fone_01_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_fone_01

  function do_ajax_form_participantes_rsvp_mob_validate_part_fone_01_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_fone_01";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_fone_01_cb

  // ---------- Validate part_ddd_celular_01
  function do_ajax_form_participantes_rsvp_mob_validate_part_ddd_celular_01()
  {
    var nomeCampo_part_ddd_celular_01 = "part_ddd_celular_01";
    var var_part_ddd_celular_01 = scAjaxGetFieldText(nomeCampo_part_ddd_celular_01);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_ddd_celular_01(var_part_ddd_celular_01, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_ddd_celular_01_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_ddd_celular_01

  function do_ajax_form_participantes_rsvp_mob_validate_part_ddd_celular_01_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_ddd_celular_01";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_ddd_celular_01_cb

  // ---------- Validate part_celeular_01
  function do_ajax_form_participantes_rsvp_mob_validate_part_celeular_01()
  {
    var nomeCampo_part_celeular_01 = "part_celeular_01";
    var var_part_celeular_01 = scAjaxGetFieldText(nomeCampo_part_celeular_01);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_celeular_01(var_part_celeular_01, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_celeular_01_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_celeular_01

  function do_ajax_form_participantes_rsvp_mob_validate_part_celeular_01_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_celeular_01";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_celeular_01_cb

  // ---------- Validate codigo_telefone_internacional
  function do_ajax_form_participantes_rsvp_mob_validate_codigo_telefone_internacional()
  {
    var nomeCampo_codigo_telefone_internacional = "codigo_telefone_internacional";
    var var_codigo_telefone_internacional = scAjaxGetFieldText(nomeCampo_codigo_telefone_internacional);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_codigo_telefone_internacional(var_codigo_telefone_internacional, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_codigo_telefone_internacional_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_codigo_telefone_internacional

  function do_ajax_form_participantes_rsvp_mob_validate_codigo_telefone_internacional_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "codigo_telefone_internacional";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_codigo_telefone_internacional_cb

  // ---------- Validate part_fone_internacional
  function do_ajax_form_participantes_rsvp_mob_validate_part_fone_internacional()
  {
    var nomeCampo_part_fone_internacional = "part_fone_internacional";
    var var_part_fone_internacional = scAjaxGetFieldText(nomeCampo_part_fone_internacional);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_fone_internacional(var_part_fone_internacional, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_fone_internacional_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_fone_internacional

  function do_ajax_form_participantes_rsvp_mob_validate_part_fone_internacional_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_fone_internacional";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_fone_internacional_cb

  // ---------- Validate part_rg
  function do_ajax_form_participantes_rsvp_mob_validate_part_rg()
  {
    var nomeCampo_part_rg = "part_rg";
    var var_part_rg = scAjaxGetFieldText(nomeCampo_part_rg);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_rg(var_part_rg, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_rg_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_rg

  function do_ajax_form_participantes_rsvp_mob_validate_part_rg_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_rg";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_rg_cb

  // ---------- Validate part_passaporte
  function do_ajax_form_participantes_rsvp_mob_validate_part_passaporte()
  {
    var nomeCampo_part_passaporte = "part_passaporte";
    var var_part_passaporte = scAjaxGetFieldText(nomeCampo_part_passaporte);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_passaporte(var_part_passaporte, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_passaporte_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_passaporte

  function do_ajax_form_participantes_rsvp_mob_validate_part_passaporte_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_passaporte";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_passaporte_cb

  // ---------- Validate part_validade_pass
  function do_ajax_form_participantes_rsvp_mob_validate_part_validade_pass()
  {
    var nomeCampo_part_validade_pass = "part_validade_pass";
    var var_part_validade_pass = scAjaxGetFieldText(nomeCampo_part_validade_pass);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_validade_pass(var_part_validade_pass, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_validade_pass_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_validade_pass

  function do_ajax_form_participantes_rsvp_mob_validate_part_validade_pass_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_validade_pass";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_validade_pass_cb

  // ---------- Validate emissao_passaporte
  function do_ajax_form_participantes_rsvp_mob_validate_emissao_passaporte()
  {
    var nomeCampo_emissao_passaporte = "emissao_passaporte";
    var var_emissao_passaporte = scAjaxGetFieldText(nomeCampo_emissao_passaporte);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_emissao_passaporte(var_emissao_passaporte, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_emissao_passaporte_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_emissao_passaporte

  function do_ajax_form_participantes_rsvp_mob_validate_emissao_passaporte_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "emissao_passaporte";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_emissao_passaporte_cb

  // ---------- Validate part_passaporte_estrangeiro
  function do_ajax_form_participantes_rsvp_mob_validate_part_passaporte_estrangeiro()
  {
    var nomeCampo_part_passaporte_estrangeiro = "part_passaporte_estrangeiro";
    var var_part_passaporte_estrangeiro = scAjaxGetFieldRadio(nomeCampo_part_passaporte_estrangeiro);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_passaporte_estrangeiro(var_part_passaporte_estrangeiro, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_passaporte_estrangeiro_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_passaporte_estrangeiro

  function do_ajax_form_participantes_rsvp_mob_validate_part_passaporte_estrangeiro_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_passaporte_estrangeiro";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_passaporte_estrangeiro_cb

  // ---------- Validate part_cpf_informado
  function do_ajax_form_participantes_rsvp_mob_validate_part_cpf_informado()
  {
    var nomeCampo_part_cpf_informado = "part_cpf_informado";
    var var_part_cpf_informado = scAjaxGetFieldText(nomeCampo_part_cpf_informado);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_cpf_informado(var_part_cpf_informado, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_cpf_informado_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cpf_informado

  function do_ajax_form_participantes_rsvp_mob_validate_part_cpf_informado_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_cpf_informado";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cpf_informado_cb

  // ---------- Validate part_nacionalidade
  function do_ajax_form_participantes_rsvp_mob_validate_part_nacionalidade()
  {
    var nomeCampo_part_nacionalidade = "part_nacionalidade";
    var var_part_nacionalidade = scAjaxGetFieldText(nomeCampo_part_nacionalidade);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_nacionalidade(var_part_nacionalidade, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_nacionalidade_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nacionalidade

  function do_ajax_form_participantes_rsvp_mob_validate_part_nacionalidade_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_nacionalidade";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nacionalidade_cb

  // ---------- Validate part_vacina_fa
  function do_ajax_form_participantes_rsvp_mob_validate_part_vacina_fa()
  {
    var nomeCampo_part_vacina_fa = "part_vacina_fa";
    var var_part_vacina_fa = scAjaxGetFieldText(nomeCampo_part_vacina_fa);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_vacina_fa(var_part_vacina_fa, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_vacina_fa_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_vacina_fa

  function do_ajax_form_participantes_rsvp_mob_validate_part_vacina_fa_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_vacina_fa";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_vacina_fa_cb

  // ---------- Validate numero_visto
  function do_ajax_form_participantes_rsvp_mob_validate_numero_visto()
  {
    var nomeCampo_numero_visto = "numero_visto";
    var var_numero_visto = scAjaxGetFieldText(nomeCampo_numero_visto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_numero_visto(var_numero_visto, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_numero_visto_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_numero_visto

  function do_ajax_form_participantes_rsvp_mob_validate_numero_visto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "numero_visto";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_numero_visto_cb

  // ---------- Validate validade_visto
  function do_ajax_form_participantes_rsvp_mob_validate_validade_visto()
  {
    var nomeCampo_validade_visto = "validade_visto";
    var var_validade_visto = scAjaxGetFieldText(nomeCampo_validade_visto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_validade_visto(var_validade_visto, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_validade_visto_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_validade_visto

  function do_ajax_form_participantes_rsvp_mob_validate_validade_visto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "validade_visto";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_validade_visto_cb

  // ---------- Validate part_visto
  function do_ajax_form_participantes_rsvp_mob_validate_part_visto()
  {
    var nomeCampo_part_visto = "part_visto";
    var var_part_visto = scAjaxGetFieldHidden(nomeCampo_part_visto);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_visto(var_part_visto, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_visto_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_visto

  function do_ajax_form_participantes_rsvp_mob_validate_part_visto_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_visto";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_visto_cb

  // ---------- Validate part_tam_camisa
  function do_ajax_form_participantes_rsvp_mob_validate_part_tam_camisa()
  {
    var nomeCampo_part_tam_camisa = "part_tam_camisa";
    var var_part_tam_camisa = scAjaxGetFieldSelect(nomeCampo_part_tam_camisa);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_tam_camisa(var_part_tam_camisa, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_tam_camisa_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_tam_camisa

  function do_ajax_form_participantes_rsvp_mob_validate_part_tam_camisa_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_tam_camisa";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_tam_camisa_cb

  // ---------- Validate part_tam_calcado
  function do_ajax_form_participantes_rsvp_mob_validate_part_tam_calcado()
  {
    var nomeCampo_part_tam_calcado = "part_tam_calcado";
    var var_part_tam_calcado = scAjaxGetFieldText(nomeCampo_part_tam_calcado);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_tam_calcado(var_part_tam_calcado, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_tam_calcado_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_tam_calcado

  function do_ajax_form_participantes_rsvp_mob_validate_part_tam_calcado_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_tam_calcado";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_tam_calcado_cb

  // ---------- Validate part_idioma
  function do_ajax_form_participantes_rsvp_mob_validate_part_idioma()
  {
    var nomeCampo_part_idioma = "part_idioma";
    var var_part_idioma = scAjaxGetFieldSelect(nomeCampo_part_idioma);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_idioma(var_part_idioma, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_idioma_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_idioma

  function do_ajax_form_participantes_rsvp_mob_validate_part_idioma_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_idioma";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_idioma_cb

  // ---------- Validate idioma_preferido
  function do_ajax_form_participantes_rsvp_mob_validate_idioma_preferido()
  {
    var nomeCampo_idioma_preferido = "idioma_preferido";
    var var_idioma_preferido = scAjaxGetFieldText(nomeCampo_idioma_preferido);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_idioma_preferido(var_idioma_preferido, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_idioma_preferido_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_idioma_preferido

  function do_ajax_form_participantes_rsvp_mob_validate_idioma_preferido_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "idioma_preferido";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_idioma_preferido_cb

  // ---------- Validate part_pais
  function do_ajax_form_participantes_rsvp_mob_validate_part_pais()
  {
    var nomeCampo_part_pais = "part_pais";
    var var_part_pais = scAjaxGetFieldSelect(nomeCampo_part_pais);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_pais(var_part_pais, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_pais_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_pais

  function do_ajax_form_participantes_rsvp_mob_validate_part_pais_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_pais";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_pais_cb

  // ---------- Validate pais
  function do_ajax_form_participantes_rsvp_mob_validate_pais()
  {
    var nomeCampo_pais = "pais";
    var var_pais = scAjaxGetFieldText(nomeCampo_pais);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_pais(var_pais, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_pais_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_pais

  function do_ajax_form_participantes_rsvp_mob_validate_pais_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "pais";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_pais_cb

  // ---------- Validate part_destaque_negrito
  function do_ajax_form_participantes_rsvp_mob_validate_part_destaque_negrito()
  {
    var nomeCampo_part_destaque_negrito = "part_destaque_negrito";
    var var_part_destaque_negrito = scAjaxGetFieldRadio(nomeCampo_part_destaque_negrito);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_destaque_negrito(var_part_destaque_negrito, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_destaque_negrito_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_destaque_negrito

  function do_ajax_form_participantes_rsvp_mob_validate_part_destaque_negrito_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_destaque_negrito";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_destaque_negrito_cb

  // ---------- Validate part_fumante
  function do_ajax_form_participantes_rsvp_mob_validate_part_fumante()
  {
    var nomeCampo_part_fumante = "part_fumante";
    var var_part_fumante = scAjaxGetFieldRadio(nomeCampo_part_fumante);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_fumante(var_part_fumante, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_fumante_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_fumante

  function do_ajax_form_participantes_rsvp_mob_validate_part_fumante_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_fumante";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_fumante_cb

  // ---------- Validate part_restricao_alimentar
  function do_ajax_form_participantes_rsvp_mob_validate_part_restricao_alimentar()
  {
    var nomeCampo_part_restricao_alimentar = "part_restricao_alimentar";
    var var_part_restricao_alimentar = scAjaxGetFieldText(nomeCampo_part_restricao_alimentar);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_restricao_alimentar(var_part_restricao_alimentar, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_restricao_alimentar_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_restricao_alimentar

  function do_ajax_form_participantes_rsvp_mob_validate_part_restricao_alimentar_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_restricao_alimentar";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_restricao_alimentar_cb

  // ---------- Validate restricao_mobilidade
  function do_ajax_form_participantes_rsvp_mob_validate_restricao_mobilidade()
  {
    var nomeCampo_restricao_mobilidade = "restricao_mobilidade";
    var var_restricao_mobilidade = scAjaxGetFieldText(nomeCampo_restricao_mobilidade);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_restricao_mobilidade(var_restricao_mobilidade, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_restricao_mobilidade_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_restricao_mobilidade

  function do_ajax_form_participantes_rsvp_mob_validate_restricao_mobilidade_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "restricao_mobilidade";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_restricao_mobilidade_cb

  // ---------- Validate part_acompanhado
  function do_ajax_form_participantes_rsvp_mob_validate_part_acompanhado()
  {
    var nomeCampo_part_acompanhado = "part_acompanhado";
    var var_part_acompanhado = scAjaxGetFieldRadio(nomeCampo_part_acompanhado);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_acompanhado(var_part_acompanhado, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_acompanhado_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_acompanhado

  function do_ajax_form_participantes_rsvp_mob_validate_part_acompanhado_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_acompanhado";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_acompanhado_cb

  // ---------- Validate part_cv_obs
  function do_ajax_form_participantes_rsvp_mob_validate_part_cv_obs()
  {
    var nomeCampo_part_cv_obs = "part_cv_obs";
    var var_part_cv_obs = scAjaxGetFieldText(nomeCampo_part_cv_obs);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_cv_obs(var_part_cv_obs, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_cv_obs_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cv_obs

  function do_ajax_form_participantes_rsvp_mob_validate_part_cv_obs_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_cv_obs";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cv_obs_cb

  // ---------- Validate uid_pulseira_nfc
  function do_ajax_form_participantes_rsvp_mob_validate_uid_pulseira_nfc()
  {
    var nomeCampo_uid_pulseira_nfc = "uid_pulseira_nfc";
    var var_uid_pulseira_nfc = scAjaxGetFieldText(nomeCampo_uid_pulseira_nfc);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_uid_pulseira_nfc(var_uid_pulseira_nfc, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_uid_pulseira_nfc_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_uid_pulseira_nfc

  function do_ajax_form_participantes_rsvp_mob_validate_uid_pulseira_nfc_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "uid_pulseira_nfc";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_uid_pulseira_nfc_cb

  // ---------- Validate roles_app
  function do_ajax_form_participantes_rsvp_mob_validate_roles_app()
  {
    var nomeCampo_roles_app = "roles_app";
    var var_roles_app = scAjaxGetFieldSelect(nomeCampo_roles_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_roles_app(var_roles_app, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_roles_app_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_roles_app

  function do_ajax_form_participantes_rsvp_mob_validate_roles_app_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "roles_app";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_roles_app_cb

  // ---------- Validate id_evento_app
  function do_ajax_form_participantes_rsvp_mob_validate_id_evento_app()
  {
    var nomeCampo_id_evento_app = "id_evento_app";
    var var_id_evento_app = scAjaxGetFieldHidden(nomeCampo_id_evento_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_id_evento_app(var_id_evento_app, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_id_evento_app_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_id_evento_app

  function do_ajax_form_participantes_rsvp_mob_validate_id_evento_app_cb(sResp)
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
  } // do_ajax_form_participantes_rsvp_mob_validate_id_evento_app_cb

  // ---------- Validate external_id
  function do_ajax_form_participantes_rsvp_mob_validate_external_id()
  {
    var nomeCampo_external_id = "external_id";
    var var_external_id = scAjaxGetFieldHidden(nomeCampo_external_id);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_external_id(var_external_id, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_external_id_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_external_id

  function do_ajax_form_participantes_rsvp_mob_validate_external_id_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "external_id";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_external_id_cb

  // ---------- Validate id_participante_app
  function do_ajax_form_participantes_rsvp_mob_validate_id_participante_app()
  {
    var nomeCampo_id_participante_app = "id_participante_app";
    var var_id_participante_app = scAjaxGetFieldHidden(nomeCampo_id_participante_app);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_id_participante_app(var_id_participante_app, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_id_participante_app_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_id_participante_app

  function do_ajax_form_participantes_rsvp_mob_validate_id_participante_app_cb(sResp)
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
  } // do_ajax_form_participantes_rsvp_mob_validate_id_participante_app_cb

  // ---------- Validate external_status
  function do_ajax_form_participantes_rsvp_mob_validate_external_status()
  {
    var nomeCampo_external_status = "external_status";
    var var_external_status = scAjaxGetFieldHidden(nomeCampo_external_status);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_external_status(var_external_status, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_external_status_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_external_status

  function do_ajax_form_participantes_rsvp_mob_validate_external_status_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "external_status";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_external_status_cb

  // ---------- Validate part_email
  function do_ajax_form_participantes_rsvp_mob_validate_part_email()
  {
    var nomeCampo_part_email = "part_email";
    var var_part_email = scAjaxGetFieldText(nomeCampo_part_email);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_email(var_part_email, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_email_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_email

  function do_ajax_form_participantes_rsvp_mob_validate_part_email_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_email";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_email_cb

  // ---------- Validate part_nome_secretaria
  function do_ajax_form_participantes_rsvp_mob_validate_part_nome_secretaria()
  {
    var nomeCampo_part_nome_secretaria = "part_nome_secretaria";
    var var_part_nome_secretaria = scAjaxGetFieldText(nomeCampo_part_nome_secretaria);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_nome_secretaria(var_part_nome_secretaria, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_nome_secretaria_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nome_secretaria

  function do_ajax_form_participantes_rsvp_mob_validate_part_nome_secretaria_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_nome_secretaria";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nome_secretaria_cb

  // ---------- Validate part_email_secretaria
  function do_ajax_form_participantes_rsvp_mob_validate_part_email_secretaria()
  {
    var nomeCampo_part_email_secretaria = "part_email_secretaria";
    var var_part_email_secretaria = scAjaxGetFieldText(nomeCampo_part_email_secretaria);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_email_secretaria(var_part_email_secretaria, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_email_secretaria_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_email_secretaria

  function do_ajax_form_participantes_rsvp_mob_validate_part_email_secretaria_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_email_secretaria";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_email_secretaria_cb

  // ---------- Validate part_cod_substituido
  function do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituido()
  {
    var nomeCampo_part_cod_substituido = "part_cod_substituido";
    var var_part_cod_substituido = scAjaxGetFieldText(nomeCampo_part_cod_substituido);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_cod_substituido(var_part_cod_substituido, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituido_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituido

  function do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituido_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_cod_substituido";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituido_cb

  // ---------- Validate part_nome_substituido
  function do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituido()
  {
    var nomeCampo_part_nome_substituido = "part_nome_substituido";
    var var_part_nome_substituido = scAjaxGetFieldText(nomeCampo_part_nome_substituido);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_part_nome_substituido(var_part_nome_substituido, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituido_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituido

  function do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituido_cb(sResp)
  {
    oResp = scAjaxResponse(sResp);
    scAjaxClearErrors();
    scAjaxRedir();
    sFieldValid = "part_nome_substituido";
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
  } // do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituido_cb

  // ---------- Validate cpf_del
  function do_ajax_form_participantes_rsvp_mob_validate_cpf_del()
  {
    var nomeCampo_cpf_del = "cpf_del";
    var var_cpf_del = scAjaxGetFieldHidden(nomeCampo_cpf_del);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_cpf_del(var_cpf_del, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_cpf_del_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_cpf_del

  function do_ajax_form_participantes_rsvp_mob_validate_cpf_del_cb(sResp)
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
  } // do_ajax_form_participantes_rsvp_mob_validate_cpf_del_cb

  // ---------- Validate sql_log
  function do_ajax_form_participantes_rsvp_mob_validate_sql_log()
  {
    var nomeCampo_sql_log = "sql_log";
    var var_sql_log = scAjaxGetFieldHidden(nomeCampo_sql_log);
    var var_script_case_init = document.F1.script_case_init.value;
    x_ajax_form_participantes_rsvp_mob_validate_sql_log(var_sql_log, var_script_case_init, do_ajax_form_participantes_rsvp_mob_validate_sql_log_cb);
  } // do_ajax_form_participantes_rsvp_mob_validate_sql_log

  function do_ajax_form_participantes_rsvp_mob_validate_sql_log_cb(sResp)
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
  } // do_ajax_form_participantes_rsvp_mob_validate_sql_log_cb

  // ---------- Event onchange dsc_empresa_rsvp
  function do_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange()
  {
    var var_dsc_empresa_rsvp = scAjaxGetFieldSelect("dsc_empresa_rsvp");
    var var_cod_empresa_rsvp = scAjaxGetFieldHidden("cod_empresa_rsvp");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange(var_dsc_empresa_rsvp, var_cod_empresa_rsvp, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange

  function do_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "dsc_empresa_rsvp";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange_cb_after_alert

  // ---------- Event onclick enviar_app
  function do_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick()
  {
    var var_enviar_app = scAjaxGetFieldRadio("enviar_app");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick(var_enviar_app, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick

  function do_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick_cb(sResp)
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick_cb
  function do_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick_cb_after_alert

  // ---------- Event onchange nacionalidade
  function do_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange()
  {
    var var_part_cpf = scAjaxGetFieldText("part_cpf");
    var var_nome = scAjaxGetFieldText("nome");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange(var_part_cpf, var_nome, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange

  function do_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "nacionalidade";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange_cb_after_alert

  // ---------- Event onchange part_cod_substituido
  function do_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange()
  {
    var var_part_cod_substituido = scAjaxGetFieldText("part_cod_substituido");
    var var_part_cpf = scAjaxGetFieldText("part_cpf");
    var var_part_nome_substituido = scAjaxGetFieldText("part_nome_substituido");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange(var_part_cod_substituido, var_part_cpf, var_part_nome_substituido, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange

  function do_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "part_cod_substituido";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange_cb_after_alert

  // ---------- Event onchange part_cod_substituto
  function do_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange()
  {
    var var_part_cod_substituto = scAjaxGetFieldText("part_cod_substituto");
    var var_part_cpf = scAjaxGetFieldText("part_cpf");
    var var_part_empresa = scAjaxGetFieldText("part_empresa");
    var var_part_id_evento_publico = scAjaxGetFieldSelect("part_id_evento_publico");
    var var_guarda_cod_substituto = scAjaxGetFieldHidden("guarda_cod_substituto");
    var var_part_id_evento = scAjaxGetFieldSelect("part_id_evento");
    var var_part_substituido = scAjaxGetFieldRadio("part_substituido");
    var var_part_nome_substituto = scAjaxGetFieldText("part_nome_substituto");
    var var_external_status = scAjaxGetFieldHidden("external_status");
    var var_external_id = scAjaxGetFieldHidden("external_id");
    var var_id_participante_app = scAjaxGetFieldHidden("id_participante_app");
    var var_part_cod_substituido = scAjaxGetFieldText("part_cod_substituido");
    var var_part_nome_substituido = scAjaxGetFieldText("part_nome_substituido");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange(var_part_cod_substituto, var_part_cpf, var_part_empresa, var_part_id_evento_publico, var_guarda_cod_substituto, var_part_id_evento, var_part_substituido, var_part_nome_substituto, var_external_status, var_external_id, var_id_participante_app, var_part_cod_substituido, var_part_nome_substituido, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange

  function do_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "part_cod_substituto";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange_cb_after_alert

  // ---------- Event onchange part_cpf_informado
  function do_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange()
  {
    var var_part_cpf_informado = scAjaxGetFieldText("part_cpf_informado");
    var var_part_cpf = scAjaxGetFieldText("part_cpf");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange(var_part_cpf_informado, var_part_cpf, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange

  function do_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "part_cpf_informado";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange_cb_after_alert

  // ---------- Event onchange part_cpf
  function do_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange()
  {
    var var_part_cpf = scAjaxGetFieldText("part_cpf");
    var var_importacao = scAjaxGetFieldRadio("importacao");
    var var_nacionalidade = scAjaxGetFieldSelect("nacionalidade");
    var var_nome = scAjaxGetFieldText("nome");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange(var_part_cpf, var_importacao, var_nacionalidade, var_nome, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange

  function do_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "part_cpf";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange_cb_after_alert

  // ---------- Event onchange part_email
  function do_ajax_form_participantes_rsvp_mob_event_part_email_onchange()
  {
    var var_part_email = scAjaxGetFieldText("part_email");
    var var_part_cpf = scAjaxGetFieldText("part_cpf");
    var var_part_id_evento = scAjaxGetFieldSelect("part_id_evento");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_part_email_onchange(var_part_email, var_part_cpf, var_part_id_evento, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_part_email_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_part_email_onchange

  function do_ajax_form_participantes_rsvp_mob_event_part_email_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "part_email";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_part_email_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_part_email_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_part_email_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_part_email_onchange_cb_after_alert

  // ---------- Event onchange part_id_evento_publico
  function do_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange()
  {
    var var_part_id_evento_publico = scAjaxGetFieldSelect("part_id_evento_publico");
    var var_part_id_evento = scAjaxGetFieldSelect("part_id_evento");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange(var_part_id_evento_publico, var_part_id_evento, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange

  function do_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "part_id_evento_publico";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange_cb_after_alert

  // ---------- Event onchange part_id_evento_regional
  function do_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange()
  {
    var var_part_id_evento_regional = scAjaxGetFieldSelect("part_id_evento_regional");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange(var_part_id_evento_regional, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange

  function do_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "part_id_evento_regional";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange_cb_after_alert

  // ---------- Event onclick part_substituido
  function do_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick()
  {
    var var_part_nome_substituto = scAjaxGetFieldText("part_nome_substituto");
    var var_part_substituido = scAjaxGetFieldRadio("part_substituido");
    var var_part_cod_substituto = scAjaxGetFieldText("part_cod_substituto");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick(var_part_nome_substituto, var_part_substituido, var_part_cod_substituto, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick

  function do_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "part_substituido";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick_cb
  function do_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick_cb_after_alert

  // ---------- Event onchange uid_pulseira_nfc
  function do_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange()
  {
    var var_uid_pulseira_nfc = scAjaxGetFieldText("uid_pulseira_nfc");
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn(true);
    x_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange(var_uid_pulseira_nfc, var_script_case_init, do_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange_cb);
  } // do_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange

  function do_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange_cb(sResp)
  {
    scAjaxProcOff(true);
    oResp = scAjaxResponse(sResp);
    sFieldValid = "uid_pulseira_nfc";
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange_cb
  function do_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
  } // do_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange_cb_after_alert

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
  function do_ajax_form_participantes_rsvp_mob_submit_form()
  {
    if (scEventControl_active("")) {
      setTimeout(function() { do_ajax_form_participantes_rsvp_mob_submit_form(); }, 500);
      return;
    }
    scAjaxHideMessage();
    var var_participante_id = scAjaxGetFieldHidden("participante_id");
    var var_importacao = scAjaxGetFieldRadio("importacao");
    var var_nacionalidade = scAjaxGetFieldSelect("nacionalidade");
    var var_part_cpf = scAjaxGetFieldText("part_cpf");
    var var_nome = scAjaxGetFieldText("nome");
    var var_part_ativo = scAjaxGetFieldRadio("part_ativo");
    var var_part_tipo = scAjaxGetFieldText("part_tipo");
    var var_part_sexo = scAjaxGetFieldRadio("part_sexo");
    var var_enviar_app = scAjaxGetFieldRadio("enviar_app");
    var var_part_nome_cracha = scAjaxGetFieldText("part_nome_cracha");
    var var_part_id_evento = scAjaxGetFieldSelect("part_id_evento");
    var var_part_id_evento_publico = scAjaxGetFieldSelect("part_id_evento_publico");
    var var_part_id_evento_regional = scAjaxGetFieldSelect("part_id_evento_regional");
    var var_part_tipo_pessoa = scAjaxGetFieldRadio("part_tipo_pessoa");
    var var_part_dt_nasc = scAjaxGetFieldText("part_dt_nasc");
    var var_part_filiacao = scAjaxGetFieldText("part_filiacao");
    var var_estrangeiro = scAjaxGetFieldRadio("estrangeiro");
    var var_part_substituido = scAjaxGetFieldRadio("part_substituido");
    var var_part_cod_substituto = scAjaxGetFieldText("part_cod_substituto");
    var var_part_nome_substituto = scAjaxGetFieldText("part_nome_substituto");
    var var_part_sexo_substituto = scAjaxGetFieldRadio("part_sexo_substituto");
    var var_guarda_cod_substituto = scAjaxGetFieldHidden("guarda_cod_substituto");
    var var_part_empresa = scAjaxGetFieldText("part_empresa");
    var var_part_departamento = scAjaxGetFieldText("part_departamento");
    var var_part_cargo = scAjaxGetFieldText("part_cargo");
    var var_part_grupo = scAjaxGetFieldText("part_grupo");
    var var_part_clube = scAjaxGetFieldText("part_clube");
    var var_dsc_empresa_rsvp = scAjaxGetFieldSelect("dsc_empresa_rsvp");
    var var_cod_empresa_rsvp = scAjaxGetFieldHidden("cod_empresa_rsvp");
    var var_part_cep = scAjaxGetFieldText("part_cep");
    var var_part_logradouro = scAjaxGetFieldText("part_logradouro");
    var var_part_numero = scAjaxGetFieldText("part_numero");
    var var_part_complemento = scAjaxGetFieldText("part_complemento");
    var var_part_bairro = scAjaxGetFieldText("part_bairro");
    var var_part_cidade = scAjaxGetFieldText("part_cidade");
    var var_part_uf = scAjaxGetFieldText("part_uf");
    var var_part_ddd_01 = scAjaxGetFieldText("part_ddd_01");
    var var_part_fone_01 = scAjaxGetFieldText("part_fone_01");
    var var_part_ddd_celular_01 = scAjaxGetFieldText("part_ddd_celular_01");
    var var_part_celeular_01 = scAjaxGetFieldText("part_celeular_01");
    var var_codigo_telefone_internacional = scAjaxGetFieldText("codigo_telefone_internacional");
    var var_part_fone_internacional = scAjaxGetFieldText("part_fone_internacional");
    var var_part_rg = scAjaxGetFieldText("part_rg");
    var var_part_passaporte = scAjaxGetFieldText("part_passaporte");
    var var_part_validade_pass = scAjaxGetFieldText("part_validade_pass");
    var var_emissao_passaporte = scAjaxGetFieldText("emissao_passaporte");
    var var_part_passaporte_estrangeiro = scAjaxGetFieldRadio("part_passaporte_estrangeiro");
    var var_part_cpf_informado = scAjaxGetFieldText("part_cpf_informado");
    var var_part_nacionalidade = scAjaxGetFieldText("part_nacionalidade");
    var var_part_vacina_fa = scAjaxGetFieldText("part_vacina_fa");
    var var_numero_visto = scAjaxGetFieldText("numero_visto");
    var var_validade_visto = scAjaxGetFieldText("validade_visto");
    var var_part_visto = scAjaxGetFieldHidden("part_visto");
    var var_part_tam_camisa = scAjaxGetFieldSelect("part_tam_camisa");
    var var_part_tam_calcado = scAjaxGetFieldText("part_tam_calcado");
    var var_part_idioma = scAjaxGetFieldSelect("part_idioma");
    var var_idioma_preferido = scAjaxGetFieldText("idioma_preferido");
    var var_part_pais = scAjaxGetFieldSelect("part_pais");
    var var_pais = scAjaxGetFieldText("pais");
    var var_part_destaque_negrito = scAjaxGetFieldRadio("part_destaque_negrito");
    var var_part_fumante = scAjaxGetFieldRadio("part_fumante");
    var var_part_restricao_alimentar = scAjaxGetFieldText("part_restricao_alimentar");
    var var_restricao_mobilidade = scAjaxGetFieldText("restricao_mobilidade");
    var var_part_acompanhado = scAjaxGetFieldRadio("part_acompanhado");
    var var_part_cv_obs = scAjaxGetFieldText("part_cv_obs");
    var var_uid_pulseira_nfc = scAjaxGetFieldText("uid_pulseira_nfc");
    var var_roles_app = scAjaxGetFieldSelect("roles_app");
    var var_id_evento_app = scAjaxGetFieldHidden("id_evento_app");
    var var_external_id = scAjaxGetFieldHidden("external_id");
    var var_id_participante_app = scAjaxGetFieldHidden("id_participante_app");
    var var_external_status = scAjaxGetFieldHidden("external_status");
    var var_part_email = scAjaxGetFieldText("part_email");
    var var_part_nome_secretaria = scAjaxGetFieldText("part_nome_secretaria");
    var var_part_email_secretaria = scAjaxGetFieldText("part_email_secretaria");
    var var_part_cod_substituido = scAjaxGetFieldText("part_cod_substituido");
    var var_part_nome_substituido = scAjaxGetFieldText("part_nome_substituido");
    var var_cpf_del = scAjaxGetFieldHidden("cpf_del");
    var var_sql_log = scAjaxGetFieldHidden("sql_log");
    var var_nm_form_submit = document.F1.nm_form_submit.value;
    var var_nmgp_url_saida = document.F1.nmgp_url_saida.value;
    var var_nmgp_opcao = document.F1.nmgp_opcao.value;
    var var_nmgp_ancora = document.F1.nmgp_ancora.value;
    var var_nmgp_num_form = document.F1.nmgp_num_form.value;
    var var_nmgp_parms = document.F1.nmgp_parms.value;
    var var_script_case_init = document.F1.script_case_init.value;
    var var_csrf_token = scAjaxGetFieldText("csrf_token");
    scAjaxProcOn();
    x_ajax_form_participantes_rsvp_mob_submit_form(var_participante_id, var_importacao, var_nacionalidade, var_part_cpf, var_nome, var_part_ativo, var_part_tipo, var_part_sexo, var_enviar_app, var_part_nome_cracha, var_part_id_evento, var_part_id_evento_publico, var_part_id_evento_regional, var_part_tipo_pessoa, var_part_dt_nasc, var_part_filiacao, var_estrangeiro, var_part_substituido, var_part_cod_substituto, var_part_nome_substituto, var_part_sexo_substituto, var_guarda_cod_substituto, var_part_empresa, var_part_departamento, var_part_cargo, var_part_grupo, var_part_clube, var_dsc_empresa_rsvp, var_cod_empresa_rsvp, var_part_cep, var_part_logradouro, var_part_numero, var_part_complemento, var_part_bairro, var_part_cidade, var_part_uf, var_part_ddd_01, var_part_fone_01, var_part_ddd_celular_01, var_part_celeular_01, var_codigo_telefone_internacional, var_part_fone_internacional, var_part_rg, var_part_passaporte, var_part_validade_pass, var_emissao_passaporte, var_part_passaporte_estrangeiro, var_part_cpf_informado, var_part_nacionalidade, var_part_vacina_fa, var_numero_visto, var_validade_visto, var_part_visto, var_part_tam_camisa, var_part_tam_calcado, var_part_idioma, var_idioma_preferido, var_part_pais, var_pais, var_part_destaque_negrito, var_part_fumante, var_part_restricao_alimentar, var_restricao_mobilidade, var_part_acompanhado, var_part_cv_obs, var_uid_pulseira_nfc, var_roles_app, var_id_evento_app, var_external_id, var_id_participante_app, var_external_status, var_part_email, var_part_nome_secretaria, var_part_email_secretaria, var_part_cod_substituido, var_part_nome_substituido, var_cpf_del, var_sql_log, var_nm_form_submit, var_nmgp_url_saida, var_nmgp_opcao, var_nmgp_ancora, var_nmgp_num_form, var_nmgp_parms, var_script_case_init, var_csrf_token, do_ajax_form_participantes_rsvp_mob_submit_form_cb);
  } // do_ajax_form_participantes_rsvp_mob_submit_form

  function do_ajax_form_participantes_rsvp_mob_submit_form_cb(sResp)
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
      scAjaxHideErrorDisplay("participante_id");
      scAjaxHideErrorDisplay("importacao");
      scAjaxHideErrorDisplay("nacionalidade");
      scAjaxHideErrorDisplay("part_cpf");
      scAjaxHideErrorDisplay("nome");
      scAjaxHideErrorDisplay("part_ativo");
      scAjaxHideErrorDisplay("part_tipo");
      scAjaxHideErrorDisplay("part_sexo");
      scAjaxHideErrorDisplay("enviar_app");
      scAjaxHideErrorDisplay("part_nome_cracha");
      scAjaxHideErrorDisplay("part_id_evento");
      scAjaxHideErrorDisplay("part_id_evento_publico");
      scAjaxHideErrorDisplay("part_id_evento_regional");
      scAjaxHideErrorDisplay("part_tipo_pessoa");
      scAjaxHideErrorDisplay("part_dt_nasc");
      scAjaxHideErrorDisplay("part_filiacao");
      scAjaxHideErrorDisplay("estrangeiro");
      scAjaxHideErrorDisplay("part_substituido");
      scAjaxHideErrorDisplay("part_cod_substituto");
      scAjaxHideErrorDisplay("part_nome_substituto");
      scAjaxHideErrorDisplay("part_sexo_substituto");
      scAjaxHideErrorDisplay("guarda_cod_substituto");
      scAjaxHideErrorDisplay("part_empresa");
      scAjaxHideErrorDisplay("part_departamento");
      scAjaxHideErrorDisplay("part_cargo");
      scAjaxHideErrorDisplay("part_grupo");
      scAjaxHideErrorDisplay("part_clube");
      scAjaxHideErrorDisplay("dsc_empresa_rsvp");
      scAjaxHideErrorDisplay("cod_empresa_rsvp");
      scAjaxHideErrorDisplay("part_cep");
      scAjaxHideErrorDisplay("part_logradouro");
      scAjaxHideErrorDisplay("part_numero");
      scAjaxHideErrorDisplay("part_complemento");
      scAjaxHideErrorDisplay("part_bairro");
      scAjaxHideErrorDisplay("part_cidade");
      scAjaxHideErrorDisplay("part_uf");
      scAjaxHideErrorDisplay("part_ddd_01");
      scAjaxHideErrorDisplay("part_fone_01");
      scAjaxHideErrorDisplay("part_ddd_celular_01");
      scAjaxHideErrorDisplay("part_celeular_01");
      scAjaxHideErrorDisplay("codigo_telefone_internacional");
      scAjaxHideErrorDisplay("part_fone_internacional");
      scAjaxHideErrorDisplay("part_rg");
      scAjaxHideErrorDisplay("part_passaporte");
      scAjaxHideErrorDisplay("part_validade_pass");
      scAjaxHideErrorDisplay("emissao_passaporte");
      scAjaxHideErrorDisplay("part_passaporte_estrangeiro");
      scAjaxHideErrorDisplay("part_cpf_informado");
      scAjaxHideErrorDisplay("part_nacionalidade");
      scAjaxHideErrorDisplay("part_vacina_fa");
      scAjaxHideErrorDisplay("numero_visto");
      scAjaxHideErrorDisplay("validade_visto");
      scAjaxHideErrorDisplay("part_visto");
      scAjaxHideErrorDisplay("part_tam_camisa");
      scAjaxHideErrorDisplay("part_tam_calcado");
      scAjaxHideErrorDisplay("part_idioma");
      scAjaxHideErrorDisplay("idioma_preferido");
      scAjaxHideErrorDisplay("part_pais");
      scAjaxHideErrorDisplay("pais");
      scAjaxHideErrorDisplay("part_destaque_negrito");
      scAjaxHideErrorDisplay("part_fumante");
      scAjaxHideErrorDisplay("part_restricao_alimentar");
      scAjaxHideErrorDisplay("restricao_mobilidade");
      scAjaxHideErrorDisplay("part_acompanhado");
      scAjaxHideErrorDisplay("part_cv_obs");
      scAjaxHideErrorDisplay("uid_pulseira_nfc");
      scAjaxHideErrorDisplay("roles_app");
      scAjaxHideErrorDisplay("id_evento_app");
      scAjaxHideErrorDisplay("external_id");
      scAjaxHideErrorDisplay("id_participante_app");
      scAjaxHideErrorDisplay("external_status");
      scAjaxHideErrorDisplay("part_email");
      scAjaxHideErrorDisplay("part_nome_secretaria");
      scAjaxHideErrorDisplay("part_email_secretaria");
      scAjaxHideErrorDisplay("part_cod_substituido");
      scAjaxHideErrorDisplay("part_nome_substituido");
      scAjaxHideErrorDisplay("cpf_del");
      scAjaxHideErrorDisplay("sql_log");
      scLigEditLookupCall();
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_mob']['dashboard_info']['under_dashboard']) {
?>
      var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_mob']['dashboard_info']['parent_widget']; ?>']");
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
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_submit_form_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_submit_form_cb
  function do_ajax_form_participantes_rsvp_mob_submit_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scAjaxSetFocus();
    scAjaxRedir();
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_participantes_rsvp_mob_submit_form_cb_after_alert

  var scStatusDetail = {};

  function do_ajax_form_participantes_rsvp_mob_navigate_form()
  {
    if (scFormHasChanged) {
      scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', perform_ajax_form_participantes_rsvp_mob_navigate_form, function() {});
    } else {
      perform_ajax_form_participantes_rsvp_mob_navigate_form();
    }
  }

  function perform_ajax_form_participantes_rsvp_mob_navigate_form()
  {
    if (scRefreshTable())
    {
      return;
    }
    scAjaxHideMessage();
    scAjaxHideErrorDisplay("table");
    scAjaxHideErrorDisplay("participante_id");
    scAjaxHideErrorDisplay("importacao");
    scAjaxHideErrorDisplay("nacionalidade");
    scAjaxHideErrorDisplay("part_cpf");
    scAjaxHideErrorDisplay("nome");
    scAjaxHideErrorDisplay("part_ativo");
    scAjaxHideErrorDisplay("part_tipo");
    scAjaxHideErrorDisplay("part_sexo");
    scAjaxHideErrorDisplay("enviar_app");
    scAjaxHideErrorDisplay("part_nome_cracha");
    scAjaxHideErrorDisplay("part_id_evento");
    scAjaxHideErrorDisplay("part_id_evento_publico");
    scAjaxHideErrorDisplay("part_id_evento_regional");
    scAjaxHideErrorDisplay("part_tipo_pessoa");
    scAjaxHideErrorDisplay("part_dt_nasc");
    scAjaxHideErrorDisplay("part_filiacao");
    scAjaxHideErrorDisplay("estrangeiro");
    scAjaxHideErrorDisplay("part_substituido");
    scAjaxHideErrorDisplay("part_cod_substituto");
    scAjaxHideErrorDisplay("part_nome_substituto");
    scAjaxHideErrorDisplay("part_sexo_substituto");
    scAjaxHideErrorDisplay("guarda_cod_substituto");
    scAjaxHideErrorDisplay("part_empresa");
    scAjaxHideErrorDisplay("part_departamento");
    scAjaxHideErrorDisplay("part_cargo");
    scAjaxHideErrorDisplay("part_grupo");
    scAjaxHideErrorDisplay("part_clube");
    scAjaxHideErrorDisplay("dsc_empresa_rsvp");
    scAjaxHideErrorDisplay("cod_empresa_rsvp");
    scAjaxHideErrorDisplay("part_cep");
    scAjaxHideErrorDisplay("part_logradouro");
    scAjaxHideErrorDisplay("part_numero");
    scAjaxHideErrorDisplay("part_complemento");
    scAjaxHideErrorDisplay("part_bairro");
    scAjaxHideErrorDisplay("part_cidade");
    scAjaxHideErrorDisplay("part_uf");
    scAjaxHideErrorDisplay("part_ddd_01");
    scAjaxHideErrorDisplay("part_fone_01");
    scAjaxHideErrorDisplay("part_ddd_celular_01");
    scAjaxHideErrorDisplay("part_celeular_01");
    scAjaxHideErrorDisplay("codigo_telefone_internacional");
    scAjaxHideErrorDisplay("part_fone_internacional");
    scAjaxHideErrorDisplay("part_rg");
    scAjaxHideErrorDisplay("part_passaporte");
    scAjaxHideErrorDisplay("part_validade_pass");
    scAjaxHideErrorDisplay("emissao_passaporte");
    scAjaxHideErrorDisplay("part_passaporte_estrangeiro");
    scAjaxHideErrorDisplay("part_cpf_informado");
    scAjaxHideErrorDisplay("part_nacionalidade");
    scAjaxHideErrorDisplay("part_vacina_fa");
    scAjaxHideErrorDisplay("numero_visto");
    scAjaxHideErrorDisplay("validade_visto");
    scAjaxHideErrorDisplay("part_visto");
    scAjaxHideErrorDisplay("part_tam_camisa");
    scAjaxHideErrorDisplay("part_tam_calcado");
    scAjaxHideErrorDisplay("part_idioma");
    scAjaxHideErrorDisplay("idioma_preferido");
    scAjaxHideErrorDisplay("part_pais");
    scAjaxHideErrorDisplay("pais");
    scAjaxHideErrorDisplay("part_destaque_negrito");
    scAjaxHideErrorDisplay("part_fumante");
    scAjaxHideErrorDisplay("part_restricao_alimentar");
    scAjaxHideErrorDisplay("restricao_mobilidade");
    scAjaxHideErrorDisplay("part_acompanhado");
    scAjaxHideErrorDisplay("part_cv_obs");
    scAjaxHideErrorDisplay("uid_pulseira_nfc");
    scAjaxHideErrorDisplay("roles_app");
    scAjaxHideErrorDisplay("id_evento_app");
    scAjaxHideErrorDisplay("external_id");
    scAjaxHideErrorDisplay("id_participante_app");
    scAjaxHideErrorDisplay("external_status");
    scAjaxHideErrorDisplay("part_email");
    scAjaxHideErrorDisplay("part_nome_secretaria");
    scAjaxHideErrorDisplay("part_email_secretaria");
    scAjaxHideErrorDisplay("part_cod_substituido");
    scAjaxHideErrorDisplay("part_nome_substituido");
    scAjaxHideErrorDisplay("cpf_del");
    scAjaxHideErrorDisplay("sql_log");
    var var_participante_id = document.F2.participante_id.value;
    var var_nm_form_submit = document.F2.nm_form_submit.value;
    var var_nmgp_opcao = document.F2.nmgp_opcao.value;
    var var_nmgp_ordem = document.F2.nmgp_ordem.value;
    var var_nmgp_fast_search = document.F2.nmgp_fast_search.value;
    var var_nmgp_cond_fast_search = document.F2.nmgp_cond_fast_search.value;
    var var_nmgp_arg_fast_search = document.F2.nmgp_arg_fast_search.value;
    var var_nmgp_arg_dyn_search = document.F2.nmgp_arg_dyn_search.value;
    var var_script_case_init = document.F2.script_case_init.value;
    scAjaxProcOn();
    x_ajax_form_participantes_rsvp_mob_navigate_form(var_participante_id, var_nm_form_submit, var_nmgp_opcao, var_nmgp_ordem, var_nmgp_fast_search,  var_nmgp_cond_fast_search,  var_nmgp_arg_fast_search, var_nmgp_arg_dyn_search, var_script_case_init, do_ajax_form_participantes_rsvp_mob_navigate_form_cb);
  } // do_ajax_form_participantes_rsvp_mob_navigate_form

  var scMasterDetailParentIframe = "<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_mob']['dashboard_info']['parent_widget'] ?>";
  var scMasterDetailIframe = {};
<?php
foreach ($this->Ini->sc_lig_iframe as $tmp_i => $tmp_v)
{
?>
  scMasterDetailIframe["<?php echo $tmp_i; ?>"] = "<?php echo $tmp_v; ?>";
<?php
}
?>
  function do_ajax_form_participantes_rsvp_mob_navigate_form_cb(sResp)
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
    document.F2.participante_id.value = scAjaxGetKeyValue("participante_id");
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
    $('.sc-js-ui-statusimg').css('display', 'none');
    scAjaxAlert(do_ajax_form_participantes_rsvp_mob_navigate_form_cb_after_alert);
  } // do_ajax_form_participantes_rsvp_mob_navigate_form_cb
  function do_ajax_form_participantes_rsvp_mob_navigate_form_cb_after_alert() {
    scAjaxMessage();
    scAjaxJavascript();
    scQuickSearchKeyUp('t', null);
    $('#SC_fast_search_t').blur();
    scFocusField('part_cpf');

    scAjaxSetFocus();
<?php
if ($this->Embutida_form)
{
?>
    do_ajax_form_participantes_rsvp_mob_restore_buttons();
<?php
}
?>
    if (hasJsFormOnload)
    {
      sc_form_onload();
    }
  } // do_ajax_form_participantes_rsvp_mob_navigate_form_cb_after_alert

  function sc_hide_form_participantes_rsvp_mob_form()
  {
    for (var block_id in ajax_block_id) {
      $("#div_" + ajax_block_id[block_id]).hide();
    }
  } // sc_hide_form_participantes_rsvp_mob_form


  function scAjaxDetailProc()
  {
    return true;
  } // scAjaxDetailProc


  var ajax_error_geral = "";

  var ajax_error_type = new Array("valid", "onblur", "onchange", "onclick", "onfocus");

  var ajax_field_list = new Array();
  var ajax_field_Dt_Hr = new Array();
  ajax_field_list[0] = "participante_id";
  ajax_field_list[1] = "importacao";
  ajax_field_list[2] = "nacionalidade";
  ajax_field_list[3] = "part_cpf";
  ajax_field_list[4] = "nome";
  ajax_field_list[5] = "part_ativo";
  ajax_field_list[6] = "part_tipo";
  ajax_field_list[7] = "part_sexo";
  ajax_field_list[8] = "enviar_app";
  ajax_field_list[9] = "part_nome_cracha";
  ajax_field_list[10] = "part_id_evento";
  ajax_field_list[11] = "part_id_evento_publico";
  ajax_field_list[12] = "part_id_evento_regional";
  ajax_field_list[13] = "part_tipo_pessoa";
  ajax_field_list[14] = "part_dt_nasc";
  ajax_field_list[15] = "part_filiacao";
  ajax_field_list[16] = "estrangeiro";
  ajax_field_list[17] = "part_substituido";
  ajax_field_list[18] = "part_cod_substituto";
  ajax_field_list[19] = "part_nome_substituto";
  ajax_field_list[20] = "part_sexo_substituto";
  ajax_field_list[21] = "guarda_cod_substituto";
  ajax_field_list[22] = "part_empresa";
  ajax_field_list[23] = "part_departamento";
  ajax_field_list[24] = "part_cargo";
  ajax_field_list[25] = "part_grupo";
  ajax_field_list[26] = "part_clube";
  ajax_field_list[27] = "dsc_empresa_rsvp";
  ajax_field_list[28] = "cod_empresa_rsvp";
  ajax_field_list[29] = "part_cep";
  ajax_field_list[30] = "part_logradouro";
  ajax_field_list[31] = "part_numero";
  ajax_field_list[32] = "part_complemento";
  ajax_field_list[33] = "part_bairro";
  ajax_field_list[34] = "part_cidade";
  ajax_field_list[35] = "part_uf";
  ajax_field_list[36] = "part_ddd_01";
  ajax_field_list[37] = "part_fone_01";
  ajax_field_list[38] = "part_ddd_celular_01";
  ajax_field_list[39] = "part_celeular_01";
  ajax_field_list[40] = "codigo_telefone_internacional";
  ajax_field_list[41] = "part_fone_internacional";
  ajax_field_list[42] = "part_rg";
  ajax_field_list[43] = "part_passaporte";
  ajax_field_list[44] = "part_validade_pass";
  ajax_field_list[45] = "emissao_passaporte";
  ajax_field_list[46] = "part_passaporte_estrangeiro";
  ajax_field_list[47] = "part_cpf_informado";
  ajax_field_list[48] = "part_nacionalidade";
  ajax_field_list[49] = "part_vacina_fa";
  ajax_field_list[50] = "numero_visto";
  ajax_field_list[51] = "validade_visto";
  ajax_field_list[52] = "part_visto";
  ajax_field_list[53] = "part_tam_camisa";
  ajax_field_list[54] = "part_tam_calcado";
  ajax_field_list[55] = "part_idioma";
  ajax_field_list[56] = "idioma_preferido";
  ajax_field_list[57] = "part_pais";
  ajax_field_list[58] = "pais";
  ajax_field_list[59] = "part_destaque_negrito";
  ajax_field_list[60] = "part_fumante";
  ajax_field_list[61] = "part_restricao_alimentar";
  ajax_field_list[62] = "restricao_mobilidade";
  ajax_field_list[63] = "part_acompanhado";
  ajax_field_list[64] = "part_cv_obs";
  ajax_field_list[65] = "uid_pulseira_nfc";
  ajax_field_list[66] = "roles_app";
  ajax_field_list[67] = "id_evento_app";
  ajax_field_list[68] = "external_id";
  ajax_field_list[69] = "id_participante_app";
  ajax_field_list[70] = "external_status";
  ajax_field_list[71] = "part_email";
  ajax_field_list[72] = "part_nome_secretaria";
  ajax_field_list[73] = "part_email_secretaria";
  ajax_field_list[74] = "part_cod_substituido";
  ajax_field_list[75] = "part_nome_substituido";
  ajax_field_list[76] = "cpf_del";
  ajax_field_list[77] = "sql_log";

  var ajax_block_list = new Array();
  ajax_block_list[0] = "0";
  ajax_block_list[1] = "1";
  ajax_block_list[2] = "2";
  ajax_block_list[3] = "3";
  ajax_block_list[4] = "4";
  ajax_block_list[5] = "5";
  ajax_block_list[6] = "6";
  ajax_block_list[7] = "7";
  ajax_block_list[8] = "8";

  var ajax_error_list = {
    "participante_id": {"label": "Participante Id", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "importacao": {"label": "IMPORTAR DE:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "nacionalidade": {"label": "Nacionalidade:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_cpf": {"label": "ID Usuário:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "nome": {"label": "Nome:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_ativo": {"label": "Ativo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_tipo": {"label": "Tipo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_sexo": {"label": "Sexo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "enviar_app": {"label": "Gravar no APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_nome_cracha": {"label": "Nome Crachá:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_id_evento": {"label": "Evento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_id_evento_publico": {"label": "Público:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_id_evento_regional": {"label": "Regional:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_tipo_pessoa": {"label": "Tipo Pessoa:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_dt_nasc": {"label": "Data Nascimento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_filiacao": {"label": "Filiação:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "estrangeiro": {"label": "Estrangeiro", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_substituido": {"label": "Substituido:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_cod_substituto": {"label": "Doc. do Substituto:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_nome_substituto": {"label": "Nome do Substituto:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_sexo_substituto": {"label": "Sexo do Substituto:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "guarda_cod_substituto": {"label": "ID Guardado:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_empresa": {"label": "Empresa:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_departamento": {"label": "Departamento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_cargo": {"label": "Cargo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_grupo": {"label": "Grupo:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_clube": {"label": "Clube:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "dsc_empresa_rsvp": {"label": "Empresa do Evento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cod_empresa_rsvp": {"label": "Cód. Empresa:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_cep": {"label": "CEP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_logradouro": {"label": "Logradouro:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_numero": {"label": "Número:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_complemento": {"label": "Complemento:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_bairro": {"label": "Bairro:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_cidade": {"label": "Cidade:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_uf": {"label": "UF:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_ddd_01": {"label": "DDD fone 01:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_fone_01": {"label": "Fone 01:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_ddd_celular_01": {"label": "DDD Celular 01:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_celeular_01": {"label": "Celular 01:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "codigo_telefone_internacional": {"label": "Código Telefone Internacional:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_fone_internacional": {"label": " Fone Internacional:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_rg": {"label": "RG:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_passaporte": {"label": "Passaporte:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_validade_pass": {"label": "Validade Passaporte:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "emissao_passaporte": {"label": "Emissão Passaporte:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_passaporte_estrangeiro": {"label": "Passaporte Estrangeiro:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_cpf_informado": {"label": "CPF:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_nacionalidade": {"label": "Nacionalidade (APP):", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_vacina_fa": {"label": "Vacina Febre Amarela (APP):", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "numero_visto": {"label": "Número(s) Visto(s) (APP):", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "validade_visto": {"label": "Validade Visto (APP):", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_visto": {"label": "Número(s) Visto(s) (APP):", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_tam_camisa": {"label": "Tamanho Camisa:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_tam_calcado": {"label": "Tamanho Calçado:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_idioma": {"label": "Idioma:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "idioma_preferido": {"label": "Idioma Preferido(APP):", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_pais": {"label": "Pais:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "pais": {"label": "Pais (APP):", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_destaque_negrito": {"label": "Destaque Negrito:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_fumante": {"label": "Fumante:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_restricao_alimentar": {"label": "Restrição Alimentar:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "restricao_mobilidade": {"label": "Restrição Mobilidade:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_acompanhado": {"label": "Part Acompanhado:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_cv_obs": {"label": "Observações Voucher:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "uid_pulseira_nfc": {"label": "Cód. Pulseira NFC:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "roles_app": {"label": "Status no APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_evento_app": {"label": "Id Evento APP:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "external_id": {"label": "External Id:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "id_participante_app": {"label": "Id Participante App:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "external_status": {"label": "External Status:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_email": {"label": "Email:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_nome_secretaria": {"label": "Nome Secretaria:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_email_secretaria": {"label": "Email Secretaria:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_cod_substituido": {"label": "ID Substituido:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "part_nome_substituido": {"label": "Nome Substituido:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "cpf_del": {"label": "cpf_del:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0},
    "sql_log": {"label": "sql_log:", "valid": new Array(), "onblur": new Array(), "onchange": new Array(), "onclick": new Array(), "onfocus": new Array(), "timeout": 0}
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
    "7": "hidden_bloco_7",
    "8": "hidden_bloco_8"
  };

  var ajax_block_tab = {
    "hidden_bloco_0": "",
    "hidden_bloco_1": "",
    "hidden_bloco_2": "",
    "hidden_bloco_3": "",
    "hidden_bloco_4": "",
    "hidden_bloco_5": "",
    "hidden_bloco_6": "",
    "hidden_bloco_7": "",
    "hidden_bloco_8": ""
  };

  var ajax_field_mult = {
    "participante_id": new Array(),
    "importacao": new Array(),
    "nacionalidade": new Array(),
    "part_cpf": new Array(),
    "nome": new Array(),
    "part_ativo": new Array(),
    "part_tipo": new Array(),
    "part_sexo": new Array(),
    "enviar_app": new Array(),
    "part_nome_cracha": new Array(),
    "part_id_evento": new Array(),
    "part_id_evento_publico": new Array(),
    "part_id_evento_regional": new Array(),
    "part_tipo_pessoa": new Array(),
    "part_dt_nasc": new Array(),
    "part_filiacao": new Array(),
    "estrangeiro": new Array(),
    "part_substituido": new Array(),
    "part_cod_substituto": new Array(),
    "part_nome_substituto": new Array(),
    "part_sexo_substituto": new Array(),
    "guarda_cod_substituto": new Array(),
    "part_empresa": new Array(),
    "part_departamento": new Array(),
    "part_cargo": new Array(),
    "part_grupo": new Array(),
    "part_clube": new Array(),
    "dsc_empresa_rsvp": new Array(),
    "cod_empresa_rsvp": new Array(),
    "part_cep": new Array(),
    "part_logradouro": new Array(),
    "part_numero": new Array(),
    "part_complemento": new Array(),
    "part_bairro": new Array(),
    "part_cidade": new Array(),
    "part_uf": new Array(),
    "part_ddd_01": new Array(),
    "part_fone_01": new Array(),
    "part_ddd_celular_01": new Array(),
    "part_celeular_01": new Array(),
    "codigo_telefone_internacional": new Array(),
    "part_fone_internacional": new Array(),
    "part_rg": new Array(),
    "part_passaporte": new Array(),
    "part_validade_pass": new Array(),
    "emissao_passaporte": new Array(),
    "part_passaporte_estrangeiro": new Array(),
    "part_cpf_informado": new Array(),
    "part_nacionalidade": new Array(),
    "part_vacina_fa": new Array(),
    "numero_visto": new Array(),
    "validade_visto": new Array(),
    "part_visto": new Array(),
    "part_tam_camisa": new Array(),
    "part_tam_calcado": new Array(),
    "part_idioma": new Array(),
    "idioma_preferido": new Array(),
    "part_pais": new Array(),
    "pais": new Array(),
    "part_destaque_negrito": new Array(),
    "part_fumante": new Array(),
    "part_restricao_alimentar": new Array(),
    "restricao_mobilidade": new Array(),
    "part_acompanhado": new Array(),
    "part_cv_obs": new Array(),
    "uid_pulseira_nfc": new Array(),
    "roles_app": new Array(),
    "id_evento_app": new Array(),
    "external_id": new Array(),
    "id_participante_app": new Array(),
    "external_status": new Array(),
    "part_email": new Array(),
    "part_nome_secretaria": new Array(),
    "part_email_secretaria": new Array(),
    "part_cod_substituido": new Array(),
    "part_nome_substituido": new Array(),
    "cpf_del": new Array(),
    "sql_log": new Array()
  };
  ajax_field_mult["participante_id"][1] = "participante_id";
  ajax_field_mult["importacao"][1] = "importacao";
  ajax_field_mult["nacionalidade"][1] = "nacionalidade";
  ajax_field_mult["part_cpf"][1] = "part_cpf";
  ajax_field_mult["nome"][1] = "nome";
  ajax_field_mult["part_ativo"][1] = "part_ativo";
  ajax_field_mult["part_tipo"][1] = "part_tipo";
  ajax_field_mult["part_sexo"][1] = "part_sexo";
  ajax_field_mult["enviar_app"][1] = "enviar_app";
  ajax_field_mult["part_nome_cracha"][1] = "part_nome_cracha";
  ajax_field_mult["part_id_evento"][1] = "part_id_evento";
  ajax_field_mult["part_id_evento_publico"][1] = "part_id_evento_publico";
  ajax_field_mult["part_id_evento_regional"][1] = "part_id_evento_regional";
  ajax_field_mult["part_tipo_pessoa"][1] = "part_tipo_pessoa";
  ajax_field_mult["part_dt_nasc"][1] = "part_dt_nasc";
  ajax_field_mult["part_filiacao"][1] = "part_filiacao";
  ajax_field_mult["estrangeiro"][1] = "estrangeiro";
  ajax_field_mult["part_substituido"][1] = "part_substituido";
  ajax_field_mult["part_cod_substituto"][1] = "part_cod_substituto";
  ajax_field_mult["part_nome_substituto"][1] = "part_nome_substituto";
  ajax_field_mult["part_sexo_substituto"][1] = "part_sexo_substituto";
  ajax_field_mult["guarda_cod_substituto"][1] = "guarda_cod_substituto";
  ajax_field_mult["part_empresa"][1] = "part_empresa";
  ajax_field_mult["part_departamento"][1] = "part_departamento";
  ajax_field_mult["part_cargo"][1] = "part_cargo";
  ajax_field_mult["part_grupo"][1] = "part_grupo";
  ajax_field_mult["part_clube"][1] = "part_clube";
  ajax_field_mult["dsc_empresa_rsvp"][1] = "dsc_empresa_rsvp";
  ajax_field_mult["cod_empresa_rsvp"][1] = "cod_empresa_rsvp";
  ajax_field_mult["part_cep"][1] = "part_cep";
  ajax_field_mult["part_logradouro"][1] = "part_logradouro";
  ajax_field_mult["part_numero"][1] = "part_numero";
  ajax_field_mult["part_complemento"][1] = "part_complemento";
  ajax_field_mult["part_bairro"][1] = "part_bairro";
  ajax_field_mult["part_cidade"][1] = "part_cidade";
  ajax_field_mult["part_uf"][1] = "part_uf";
  ajax_field_mult["part_ddd_01"][1] = "part_ddd_01";
  ajax_field_mult["part_fone_01"][1] = "part_fone_01";
  ajax_field_mult["part_ddd_celular_01"][1] = "part_ddd_celular_01";
  ajax_field_mult["part_celeular_01"][1] = "part_celeular_01";
  ajax_field_mult["codigo_telefone_internacional"][1] = "codigo_telefone_internacional";
  ajax_field_mult["part_fone_internacional"][1] = "part_fone_internacional";
  ajax_field_mult["part_rg"][1] = "part_rg";
  ajax_field_mult["part_passaporte"][1] = "part_passaporte";
  ajax_field_mult["part_validade_pass"][1] = "part_validade_pass";
  ajax_field_mult["emissao_passaporte"][1] = "emissao_passaporte";
  ajax_field_mult["part_passaporte_estrangeiro"][1] = "part_passaporte_estrangeiro";
  ajax_field_mult["part_cpf_informado"][1] = "part_cpf_informado";
  ajax_field_mult["part_nacionalidade"][1] = "part_nacionalidade";
  ajax_field_mult["part_vacina_fa"][1] = "part_vacina_fa";
  ajax_field_mult["numero_visto"][1] = "numero_visto";
  ajax_field_mult["validade_visto"][1] = "validade_visto";
  ajax_field_mult["part_visto"][1] = "part_visto";
  ajax_field_mult["part_tam_camisa"][1] = "part_tam_camisa";
  ajax_field_mult["part_tam_calcado"][1] = "part_tam_calcado";
  ajax_field_mult["part_idioma"][1] = "part_idioma";
  ajax_field_mult["idioma_preferido"][1] = "idioma_preferido";
  ajax_field_mult["part_pais"][1] = "part_pais";
  ajax_field_mult["pais"][1] = "pais";
  ajax_field_mult["part_destaque_negrito"][1] = "part_destaque_negrito";
  ajax_field_mult["part_fumante"][1] = "part_fumante";
  ajax_field_mult["part_restricao_alimentar"][1] = "part_restricao_alimentar";
  ajax_field_mult["restricao_mobilidade"][1] = "restricao_mobilidade";
  ajax_field_mult["part_acompanhado"][1] = "part_acompanhado";
  ajax_field_mult["part_cv_obs"][1] = "part_cv_obs";
  ajax_field_mult["uid_pulseira_nfc"][1] = "uid_pulseira_nfc";
  ajax_field_mult["roles_app"][1] = "roles_app";
  ajax_field_mult["id_evento_app"][1] = "id_evento_app";
  ajax_field_mult["external_id"][1] = "external_id";
  ajax_field_mult["id_participante_app"][1] = "id_participante_app";
  ajax_field_mult["external_status"][1] = "external_status";
  ajax_field_mult["part_email"][1] = "part_email";
  ajax_field_mult["part_nome_secretaria"][1] = "part_nome_secretaria";
  ajax_field_mult["part_email_secretaria"][1] = "part_email_secretaria";
  ajax_field_mult["part_cod_substituido"][1] = "part_cod_substituido";
  ajax_field_mult["part_nome_substituido"][1] = "part_nome_substituido";
  ajax_field_mult["cpf_del"][1] = "cpf_del";
  ajax_field_mult["sql_log"][1] = "sql_log";

  var ajax_field_id = {
    "importacao": new Array("hidden_field_label_importacao", "hidden_field_data_importacao"),
    "nacionalidade": new Array("hidden_field_label_nacionalidade", "hidden_field_data_nacionalidade"),
    "part_cpf": new Array("hidden_field_label_part_cpf", "hidden_field_data_part_cpf"),
    "part_ativo": new Array("hidden_field_label_part_ativo", "hidden_field_data_part_ativo"),
    "part_tipo": new Array("hidden_field_label_part_tipo", "hidden_field_data_part_tipo"),
    "part_sexo": new Array("hidden_field_label_part_sexo", "hidden_field_data_part_sexo"),
    "enviar_app": new Array("hidden_field_label_enviar_app", "hidden_field_data_enviar_app"),
    "part_nome_cracha": new Array("hidden_field_label_part_nome_cracha", "hidden_field_data_part_nome_cracha"),
    "part_id_evento": new Array("hidden_field_label_part_id_evento", "hidden_field_data_part_id_evento"),
    "part_id_evento_publico": new Array("hidden_field_label_part_id_evento_publico", "hidden_field_data_part_id_evento_publico"),
    "part_id_evento_regional": new Array("hidden_field_label_part_id_evento_regional", "hidden_field_data_part_id_evento_regional"),
    "part_tipo_pessoa": new Array("hidden_field_label_part_tipo_pessoa", "hidden_field_data_part_tipo_pessoa"),
    "part_dt_nasc": new Array("hidden_field_label_part_dt_nasc", "hidden_field_data_part_dt_nasc"),
    "part_filiacao": new Array("hidden_field_label_part_filiacao", "hidden_field_data_part_filiacao"),
    "estrangeiro": new Array("hidden_field_label_estrangeiro", "hidden_field_data_estrangeiro"),
    "part_substituido": new Array("hidden_field_label_part_substituido", "hidden_field_data_part_substituido"),
    "part_cod_substituto": new Array("hidden_field_label_part_cod_substituto", "hidden_field_data_part_cod_substituto"),
    "part_nome_substituto": new Array("hidden_field_label_part_nome_substituto", "hidden_field_data_part_nome_substituto"),
    "part_sexo_substituto": new Array("hidden_field_label_part_sexo_substituto", "hidden_field_data_part_sexo_substituto"),
    "guarda_cod_substituto": new Array("hidden_field_label_guarda_cod_substituto", "hidden_field_data_guarda_cod_substituto"),
    "part_empresa": new Array("hidden_field_label_part_empresa", "hidden_field_data_part_empresa"),
    "part_departamento": new Array("hidden_field_label_part_departamento", "hidden_field_data_part_departamento"),
    "part_cargo": new Array("hidden_field_label_part_cargo", "hidden_field_data_part_cargo"),
    "part_grupo": new Array("hidden_field_label_part_grupo", "hidden_field_data_part_grupo"),
    "part_clube": new Array("hidden_field_label_part_clube", "hidden_field_data_part_clube"),
    "dsc_empresa_rsvp": new Array("hidden_field_label_dsc_empresa_rsvp", "hidden_field_data_dsc_empresa_rsvp"),
    "cod_empresa_rsvp": new Array("hidden_field_label_cod_empresa_rsvp", "hidden_field_data_cod_empresa_rsvp"),
    "part_cep": new Array("hidden_field_label_part_cep", "hidden_field_data_part_cep"),
    "part_logradouro": new Array("hidden_field_label_part_logradouro", "hidden_field_data_part_logradouro"),
    "part_numero": new Array("hidden_field_label_part_numero", "hidden_field_data_part_numero"),
    "part_complemento": new Array("hidden_field_label_part_complemento", "hidden_field_data_part_complemento"),
    "part_bairro": new Array("hidden_field_label_part_bairro", "hidden_field_data_part_bairro"),
    "part_cidade": new Array("hidden_field_label_part_cidade", "hidden_field_data_part_cidade"),
    "part_uf": new Array("hidden_field_label_part_uf", "hidden_field_data_part_uf"),
    "part_ddd_01": new Array("hidden_field_label_part_ddd_01", "hidden_field_data_part_ddd_01"),
    "part_fone_01": new Array("hidden_field_label_part_fone_01", "hidden_field_data_part_fone_01"),
    "part_ddd_celular_01": new Array("hidden_field_label_part_ddd_celular_01", "hidden_field_data_part_ddd_celular_01"),
    "part_celeular_01": new Array("hidden_field_label_part_celeular_01", "hidden_field_data_part_celeular_01"),
    "codigo_telefone_internacional": new Array("hidden_field_label_codigo_telefone_internacional", "hidden_field_data_codigo_telefone_internacional"),
    "part_fone_internacional": new Array("hidden_field_label_part_fone_internacional", "hidden_field_data_part_fone_internacional"),
    "part_rg": new Array("hidden_field_label_part_rg", "hidden_field_data_part_rg"),
    "part_passaporte": new Array("hidden_field_label_part_passaporte", "hidden_field_data_part_passaporte"),
    "part_validade_pass": new Array("hidden_field_label_part_validade_pass", "hidden_field_data_part_validade_pass"),
    "emissao_passaporte": new Array("hidden_field_label_emissao_passaporte", "hidden_field_data_emissao_passaporte"),
    "part_passaporte_estrangeiro": new Array("hidden_field_label_part_passaporte_estrangeiro", "hidden_field_data_part_passaporte_estrangeiro"),
    "part_cpf_informado": new Array("hidden_field_label_part_cpf_informado", "hidden_field_data_part_cpf_informado"),
    "part_nacionalidade": new Array("hidden_field_label_part_nacionalidade", "hidden_field_data_part_nacionalidade"),
    "part_vacina_fa": new Array("hidden_field_label_part_vacina_fa", "hidden_field_data_part_vacina_fa"),
    "numero_visto": new Array("hidden_field_label_numero_visto", "hidden_field_data_numero_visto"),
    "validade_visto": new Array("hidden_field_label_validade_visto", "hidden_field_data_validade_visto"),
    "part_tam_camisa": new Array("hidden_field_label_part_tam_camisa", "hidden_field_data_part_tam_camisa"),
    "part_tam_calcado": new Array("hidden_field_label_part_tam_calcado", "hidden_field_data_part_tam_calcado"),
    "part_idioma": new Array("hidden_field_label_part_idioma", "hidden_field_data_part_idioma"),
    "idioma_preferido": new Array("hidden_field_label_idioma_preferido", "hidden_field_data_idioma_preferido"),
    "part_pais": new Array("hidden_field_label_part_pais", "hidden_field_data_part_pais"),
    "pais": new Array("hidden_field_label_pais", "hidden_field_data_pais"),
    "part_destaque_negrito": new Array("hidden_field_label_part_destaque_negrito", "hidden_field_data_part_destaque_negrito"),
    "part_fumante": new Array("hidden_field_label_part_fumante", "hidden_field_data_part_fumante"),
    "part_restricao_alimentar": new Array("hidden_field_label_part_restricao_alimentar", "hidden_field_data_part_restricao_alimentar"),
    "restricao_mobilidade": new Array("hidden_field_label_restricao_mobilidade", "hidden_field_data_restricao_mobilidade"),
    "part_acompanhado": new Array("hidden_field_label_part_acompanhado", "hidden_field_data_part_acompanhado"),
    "part_cv_obs": new Array("hidden_field_label_part_cv_obs", "hidden_field_data_part_cv_obs"),
    "uid_pulseira_nfc": new Array("hidden_field_label_uid_pulseira_nfc", "hidden_field_data_uid_pulseira_nfc"),
    "roles_app": new Array("hidden_field_label_roles_app", "hidden_field_data_roles_app"),
    "id_evento_app": new Array("hidden_field_label_id_evento_app", "hidden_field_data_id_evento_app"),
    "external_id": new Array("hidden_field_label_external_id", "hidden_field_data_external_id"),
    "id_participante_app": new Array("hidden_field_label_id_participante_app", "hidden_field_data_id_participante_app"),
    "external_status": new Array("hidden_field_label_external_status", "hidden_field_data_external_status"),
    "part_email": new Array("hidden_field_label_part_email", "hidden_field_data_part_email"),
    "part_nome_secretaria": new Array("hidden_field_label_part_nome_secretaria", "hidden_field_data_part_nome_secretaria"),
    "part_email_secretaria": new Array("hidden_field_label_part_email_secretaria", "hidden_field_data_part_email_secretaria"),
    "part_cod_substituido": new Array("hidden_field_label_part_cod_substituido", "hidden_field_data_part_cod_substituido"),
    "part_nome_substituido": new Array("hidden_field_label_part_nome_substituido", "hidden_field_data_part_nome_substituido")
  };

  var ajax_read_only = {
    "participante_id": "on",
    "importacao": "off",
    "nacionalidade": "off",
    "part_cpf": "off",
    "nome": "off",
    "part_ativo": "off",
    "part_tipo": "on",
    "part_sexo": "off",
    "enviar_app": "off",
    "part_nome_cracha": "off",
    "part_id_evento": "off",
    "part_id_evento_publico": "off",
    "part_id_evento_regional": "off",
    "part_tipo_pessoa": "off",
    "part_dt_nasc": "off",
    "part_filiacao": "off",
    "estrangeiro": "off",
    "part_substituido": "off",
    "part_cod_substituto": "off",
    "part_nome_substituto": "off",
    "part_sexo_substituto": "off",
    "guarda_cod_substituto": "off",
    "part_empresa": "off",
    "part_departamento": "off",
    "part_cargo": "off",
    "part_grupo": "off",
    "part_clube": "off",
    "dsc_empresa_rsvp": "off",
    "cod_empresa_rsvp": "off",
    "part_cep": "off",
    "part_logradouro": "off",
    "part_numero": "off",
    "part_complemento": "off",
    "part_bairro": "off",
    "part_cidade": "off",
    "part_uf": "off",
    "part_ddd_01": "off",
    "part_fone_01": "off",
    "part_ddd_celular_01": "off",
    "part_celeular_01": "off",
    "codigo_telefone_internacional": "off",
    "part_fone_internacional": "off",
    "part_rg": "off",
    "part_passaporte": "off",
    "part_validade_pass": "off",
    "emissao_passaporte": "off",
    "part_passaporte_estrangeiro": "off",
    "part_cpf_informado": "off",
    "part_nacionalidade": "off",
    "part_vacina_fa": "off",
    "numero_visto": "off",
    "validade_visto": "off",
    "part_visto": "off",
    "part_tam_camisa": "off",
    "part_tam_calcado": "off",
    "part_idioma": "off",
    "idioma_preferido": "off",
    "part_pais": "off",
    "pais": "off",
    "part_destaque_negrito": "off",
    "part_fumante": "off",
    "part_restricao_alimentar": "off",
    "restricao_mobilidade": "off",
    "part_acompanhado": "off",
    "part_cv_obs": "off",
    "uid_pulseira_nfc": "off",
    "roles_app": "off",
    "id_evento_app": "off",
    "external_id": "off",
    "id_participante_app": "off",
    "external_status": "off",
    "part_email": "off",
    "part_nome_secretaria": "off",
    "part_email_secretaria": "off",
    "part_cod_substituido": "off",
    "part_nome_substituido": "off",
    "cpf_del": "off",
    "sql_log": "off"
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
    if ("participante_id" == sIndex)
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
    if ("importacao" == sIndex)
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
    if ("nacionalidade" == sIndex)
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
    if ("part_cpf" == sIndex)
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
    if ("nome" == sIndex)
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
    if ("part_ativo" == sIndex)
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
    if ("part_tipo" == sIndex)
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
    if ("part_sexo" == sIndex)
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
    if ("part_nome_cracha" == sIndex)
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
    if ("part_id_evento" == sIndex)
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
    if ("part_id_evento_publico" == sIndex)
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
    if ("part_id_evento_regional" == sIndex)
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
    if ("part_tipo_pessoa" == sIndex)
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
    if ("part_dt_nasc" == sIndex)
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
    if ("part_filiacao" == sIndex)
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
    if ("estrangeiro" == sIndex)
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
    if ("part_substituido" == sIndex)
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
    if ("part_cod_substituto" == sIndex)
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
    if ("part_nome_substituto" == sIndex)
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
    if ("part_sexo_substituto" == sIndex)
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
    if ("guarda_cod_substituto" == sIndex)
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
    if ("part_empresa" == sIndex)
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
    if ("part_departamento" == sIndex)
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
    if ("part_cargo" == sIndex)
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
    if ("part_grupo" == sIndex)
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
    if ("part_clube" == sIndex)
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
    if ("dsc_empresa_rsvp" == sIndex)
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
    if ("cod_empresa_rsvp" == sIndex)
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
    if ("part_cep" == sIndex)
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
    if ("part_logradouro" == sIndex)
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
    if ("part_numero" == sIndex)
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
    if ("part_complemento" == sIndex)
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
    if ("part_bairro" == sIndex)
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
    if ("part_cidade" == sIndex)
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
    if ("part_uf" == sIndex)
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
    if ("part_ddd_01" == sIndex)
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
    if ("part_fone_01" == sIndex)
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
    if ("part_ddd_celular_01" == sIndex)
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
    if ("part_celeular_01" == sIndex)
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
    if ("codigo_telefone_internacional" == sIndex)
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
    if ("part_fone_internacional" == sIndex)
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
    if ("part_rg" == sIndex)
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
    if ("part_passaporte" == sIndex)
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
    if ("part_validade_pass" == sIndex)
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
    if ("emissao_passaporte" == sIndex)
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
    if ("part_passaporte_estrangeiro" == sIndex)
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
    if ("part_cpf_informado" == sIndex)
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
    if ("part_nacionalidade" == sIndex)
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
    if ("part_vacina_fa" == sIndex)
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
    if ("numero_visto" == sIndex)
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
    if ("validade_visto" == sIndex)
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
    if ("part_visto" == sIndex)
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
    if ("part_tam_camisa" == sIndex)
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
    if ("part_tam_calcado" == sIndex)
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
    if ("part_idioma" == sIndex)
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
    if ("idioma_preferido" == sIndex)
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
    if ("part_pais" == sIndex)
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
    if ("pais" == sIndex)
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
    if ("part_destaque_negrito" == sIndex)
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
    if ("part_fumante" == sIndex)
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
    if ("part_restricao_alimentar" == sIndex)
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
    if ("restricao_mobilidade" == sIndex)
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
    if ("part_acompanhado" == sIndex)
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
    if ("part_cv_obs" == sIndex)
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
    if ("uid_pulseira_nfc" == sIndex)
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
    if ("roles_app" == sIndex)
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
    if ("id_evento_app" == sIndex)
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
    if ("external_id" == sIndex)
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
    if ("id_participante_app" == sIndex)
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
    if ("external_status" == sIndex)
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
    if ("part_email" == sIndex)
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
    if ("part_nome_secretaria" == sIndex)
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
    if ("part_email_secretaria" == sIndex)
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
    if ("part_cod_substituido" == sIndex)
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
    if ("part_nome_substituido" == sIndex)
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
    scAjaxSetFieldInnerHtml(sIndex, aValue);
  }
 </SCRIPT>
