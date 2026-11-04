
function scJQGeneralAdd() {
  scLoadScInput('input:text.sc-js-input');
  scLoadScInput('input:password.sc-js-input');
  scLoadScInput('input:checkbox.sc-js-input');
  scLoadScInput('input:radio.sc-js-input');
  scLoadScInput('select.sc-js-input');
  scLoadScInput('textarea.sc-js-input');

} // scJQGeneralAdd

function scFocusField(sField) {
  var $oField = $('#id_sc_field_' + sField);

  if (0 == $oField.length) {
    $oField = $('input[name=' + sField + ']');
  }

  if (0 == $oField.length && document.F1.elements[sField]) {
    $oField = $(document.F1.elements[sField]);
  }

  if ($("#id_ac_" + sField).length > 0) {
    if ($oField.hasClass("select2-hidden-accessible")) {
      if (false == scSetFocusOnField($oField, sField)) {
        setTimeout(function() { scSetFocusOnField($oField, sField); }, 500);
      }
    }
    else {
      if (false == scSetFocusOnField($oField, sField)) {
        if (false == scSetFocusOnField($("#id_ac_" + sField, sField))) {
          setTimeout(function() { scSetFocusOnField($("#id_ac_" + sField, sField)); }, 500);
        }
      }
      else {
        setTimeout(function() { scSetFocusOnField($oField, sField); }, 500);
      }
    }
  }
  else {
    setTimeout(function() { scSetFocusOnField($oField, sField); }, 500);
  }
} // scFocusField

function scSetFocusOnField($oField, sField) {
  if ($oField.length > 0 && $oField[0].offsetHeight > 0 && $oField[0].offsetWidth > 0 && !$oField[0].disabled) {
    $oField[0].focus();
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["cod_evento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cod_hotel" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cod_acomodacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cod_categoria" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cmsg" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dt_chkin" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hr_checkin" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["early_chkin" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dt_chkout" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hr_chkout" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["early_chkout" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["cod_evento" + iSeqRow] && scEventControl_data["cod_evento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cod_evento" + iSeqRow] && scEventControl_data["cod_evento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cod_hotel" + iSeqRow] && scEventControl_data["cod_hotel" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cod_hotel" + iSeqRow] && scEventControl_data["cod_hotel" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cod_acomodacao" + iSeqRow] && scEventControl_data["cod_acomodacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cod_acomodacao" + iSeqRow] && scEventControl_data["cod_acomodacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cod_categoria" + iSeqRow] && scEventControl_data["cod_categoria" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cod_categoria" + iSeqRow] && scEventControl_data["cod_categoria" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cmsg" + iSeqRow] && scEventControl_data["cmsg" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cmsg" + iSeqRow] && scEventControl_data["cmsg" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dt_chkin" + iSeqRow] && scEventControl_data["dt_chkin" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dt_chkin" + iSeqRow] && scEventControl_data["dt_chkin" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hr_checkin" + iSeqRow] && scEventControl_data["hr_checkin" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hr_checkin" + iSeqRow] && scEventControl_data["hr_checkin" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["early_chkin" + iSeqRow] && scEventControl_data["early_chkin" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["early_chkin" + iSeqRow] && scEventControl_data["early_chkin" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dt_chkout" + iSeqRow] && scEventControl_data["dt_chkout" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dt_chkout" + iSeqRow] && scEventControl_data["dt_chkout" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hr_chkout" + iSeqRow] && scEventControl_data["hr_chkout" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hr_chkout" + iSeqRow] && scEventControl_data["hr_chkout" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["early_chkout" + iSeqRow] && scEventControl_data["early_chkout" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["early_chkout" + iSeqRow] && scEventControl_data["early_chkout" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("cod_hotel" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  scEventControl_data[fieldName]["change"] = false;
} // scEventControl_onFocus

function scEventControl_onBlur(sFieldName) {
  scEventControl_data[sFieldName]["blur"] = false;
  if (scEventControl_data[sFieldName]["change"]) {
        if (scEventControl_data[sFieldName]["original"] == $("#id_sc_field_" + sFieldName).val() || scEventControl_data[sFieldName]["calculated"] == $("#id_sc_field_" + sFieldName).val()) {
          scEventControl_data[sFieldName]["change"] = false;
        }
  }
} // scEventControl_onBlur

function scEventControl_onChange(sFieldName) {
  scEventControl_data[sFieldName]["change"] = false;
} // scEventControl_onChange

function scEventControl_onAutocomp(sFieldName) {
  scEventControl_data[sFieldName]["autocomp"] = false;
} // scEventControl_onChange

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_cod_evento' + iSeqRow).bind('blur', function() { sc_cv_chkinout_cod_evento_onblur('#id_sc_field_cod_evento' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_cv_chkinout_cod_evento_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_cv_chkinout_cod_evento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cod_hotel' + iSeqRow).bind('blur', function() { sc_cv_chkinout_cod_hotel_onblur('#id_sc_field_cod_hotel' + iSeqRow, iSeqRow, event) })
                                       .bind('change', function() { sc_cv_chkinout_cod_hotel_onchange(this, iSeqRow, event) })
                                       .bind('focus', function() { sc_cv_chkinout_cod_hotel_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cmsg' + iSeqRow).bind('blur', function() { sc_cv_chkinout_cmsg_onblur('#id_sc_field_cmsg' + iSeqRow, iSeqRow, event) })
                                  .bind('change', function() { sc_cv_chkinout_cmsg_onchange(this, iSeqRow, event) })
                                  .bind('focus', function() { sc_cv_chkinout_cmsg_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_dt_chkin' + iSeqRow).bind('blur', function() { sc_cv_chkinout_dt_chkin_onblur('#id_sc_field_dt_chkin' + iSeqRow, iSeqRow, event) })
                                      .bind('change', function() { sc_cv_chkinout_dt_chkin_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_cv_chkinout_dt_chkin_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hr_checkin' + iSeqRow).bind('blur', function() { sc_cv_chkinout_hr_checkin_onblur('#id_sc_field_hr_checkin' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_cv_chkinout_hr_checkin_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_cv_chkinout_hr_checkin_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_early_chkin' + iSeqRow).bind('blur', function() { sc_cv_chkinout_early_chkin_onblur('#id_sc_field_early_chkin' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_cv_chkinout_early_chkin_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_cv_chkinout_early_chkin_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_dt_chkout' + iSeqRow).bind('blur', function() { sc_cv_chkinout_dt_chkout_onblur('#id_sc_field_dt_chkout' + iSeqRow, iSeqRow, event) })
                                       .bind('change', function() { sc_cv_chkinout_dt_chkout_onchange(this, iSeqRow, event) })
                                       .bind('focus', function() { sc_cv_chkinout_dt_chkout_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hr_chkout' + iSeqRow).bind('blur', function() { sc_cv_chkinout_hr_chkout_onblur('#id_sc_field_hr_chkout' + iSeqRow, iSeqRow, event) })
                                       .bind('change', function() { sc_cv_chkinout_hr_chkout_onchange(this, iSeqRow, event) })
                                       .bind('focus', function() { sc_cv_chkinout_hr_chkout_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_early_chkout' + iSeqRow).bind('blur', function() { sc_cv_chkinout_early_chkout_onblur('#id_sc_field_early_chkout' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_cv_chkinout_early_chkout_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_cv_chkinout_early_chkout_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cod_acomodacao' + iSeqRow).bind('blur', function() { sc_cv_chkinout_cod_acomodacao_onblur('#id_sc_field_cod_acomodacao' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_cv_chkinout_cod_acomodacao_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_cv_chkinout_cod_acomodacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cod_categoria' + iSeqRow).bind('blur', function() { sc_cv_chkinout_cod_categoria_onblur('#id_sc_field_cod_categoria' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_cv_chkinout_cod_categoria_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_cv_chkinout_cod_categoria_onfocus(this, iSeqRow, event) });
  $('.sc-ui-radio-early_chkin' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-early_chkout' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_cv_chkinout_cod_evento_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_cod_evento();
  scCssBlur(oThis);
}

function sc_cv_chkinout_cod_evento_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  lookup_cod_evento();
}

function sc_cv_chkinout_cod_evento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_cod_hotel_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_cod_hotel();
  scCssBlur(oThis);
}

function sc_cv_chkinout_cod_hotel_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  lookup_cod_hotel();
  do_ajax_cv_chkinout_event_cod_hotel_onchange();
}

function sc_cv_chkinout_cod_hotel_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_cmsg_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_cmsg();
  scCssBlur(oThis);
}

function sc_cv_chkinout_cmsg_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_cv_chkinout_cmsg_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_dt_chkin_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_dt_chkin();
  scCssBlur(oThis);
}

function sc_cv_chkinout_dt_chkin_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_cv_chkinout_dt_chkin_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_hr_checkin_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_hr_checkin();
  scCssBlur(oThis);
}

function sc_cv_chkinout_hr_checkin_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_cv_chkinout_hr_checkin_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_early_chkin_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_early_chkin();
  scCssBlur(oThis);
}

function sc_cv_chkinout_early_chkin_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_cv_chkinout_early_chkin_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_dt_chkout_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_dt_chkout();
  scCssBlur(oThis);
}

function sc_cv_chkinout_dt_chkout_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_cv_chkinout_dt_chkout_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_hr_chkout_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_hr_chkout();
  scCssBlur(oThis);
}

function sc_cv_chkinout_hr_chkout_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_cv_chkinout_hr_chkout_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_early_chkout_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_early_chkout();
  scCssBlur(oThis);
}

function sc_cv_chkinout_early_chkout_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_cv_chkinout_early_chkout_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_cod_acomodacao_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_cod_acomodacao();
  scCssBlur(oThis);
}

function sc_cv_chkinout_cod_acomodacao_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  lookup_cod_acomodacao();
}

function sc_cv_chkinout_cod_acomodacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_cv_chkinout_cod_categoria_onblur(oThis, iSeqRow, event) {
  do_ajax_cv_chkinout_validate_cod_categoria();
  scCssBlur(oThis);
}

function sc_cv_chkinout_cod_categoria_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  lookup_cod_categoria();
}

function sc_cv_chkinout_cod_categoria_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("cod_evento", "", status);
        displayChange_field("cod_hotel", "", status);
        displayChange_field("cod_acomodacao", "", status);
        displayChange_field("cod_categoria", "", status);
        displayChange_field("cmsg", "", status);
        displayChange_field("dt_chkin", "", status);
        displayChange_field("hr_checkin", "", status);
        displayChange_field("early_chkin", "", status);
        displayChange_field("dt_chkout", "", status);
        displayChange_field("hr_chkout", "", status);
        displayChange_field("early_chkout", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_cod_evento(row, status);
        displayChange_field_cod_hotel(row, status);
        displayChange_field_cod_acomodacao(row, status);
        displayChange_field_cod_categoria(row, status);
        displayChange_field_cmsg(row, status);
        displayChange_field_dt_chkin(row, status);
        displayChange_field_hr_checkin(row, status);
        displayChange_field_early_chkin(row, status);
        displayChange_field_dt_chkout(row, status);
        displayChange_field_hr_chkout(row, status);
        displayChange_field_early_chkout(row, status);
}

function displayChange_field(field, row, status) {
        if ("cod_evento" == field) {
                displayChange_field_cod_evento(row, status);
        }
        if ("cod_hotel" == field) {
                displayChange_field_cod_hotel(row, status);
        }
        if ("cod_acomodacao" == field) {
                displayChange_field_cod_acomodacao(row, status);
        }
        if ("cod_categoria" == field) {
                displayChange_field_cod_categoria(row, status);
        }
        if ("cmsg" == field) {
                displayChange_field_cmsg(row, status);
        }
        if ("dt_chkin" == field) {
                displayChange_field_dt_chkin(row, status);
        }
        if ("hr_checkin" == field) {
                displayChange_field_hr_checkin(row, status);
        }
        if ("early_chkin" == field) {
                displayChange_field_early_chkin(row, status);
        }
        if ("dt_chkout" == field) {
                displayChange_field_dt_chkout(row, status);
        }
        if ("hr_chkout" == field) {
                displayChange_field_hr_chkout(row, status);
        }
        if ("early_chkout" == field) {
                displayChange_field_early_chkout(row, status);
        }
}

function displayChange_field_cod_evento(row, status) {
    var fieldId;
}

function displayChange_field_cod_hotel(row, status) {
    var fieldId;
}

function displayChange_field_cod_acomodacao(row, status) {
    var fieldId;
}

function displayChange_field_cod_categoria(row, status) {
    var fieldId;
}

function displayChange_field_cmsg(row, status) {
    var fieldId;
}

function displayChange_field_dt_chkin(row, status) {
    var fieldId;
}

function displayChange_field_hr_checkin(row, status) {
    var fieldId;
}

function displayChange_field_early_chkin(row, status) {
    var fieldId;
}

function displayChange_field_dt_chkout(row, status) {
    var fieldId;
}

function displayChange_field_hr_chkout(row, status) {
    var fieldId;
}

function displayChange_field_early_chkout(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_cv_chkinout_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(22);
                }
        }
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_dt_chkin" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_dt_chkin" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_dt_chkin" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_cv_chkinout_validate_dt_chkin(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['dt_chkin']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  })
<?php
if ('' != $miniCalendarFA) {
?>
    .next('button').append("<?php echo $miniCalendarFA; ?>")
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    .next('button').append("<?php echo $miniCalendarButton[0]; ?>")
<?php
}
?>
  $("#id_sc_field_dt_chkout" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_dt_chkout" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_dt_chkout" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_cv_chkinout_validate_dt_chkout(iSeqRow);
    },
    showWeek: true,
    numberOfMonths: 1,
    changeMonth: true,
    changeYear: true,
    yearRange: 'c-5:c+5',
    dayNames: ["<?php        echo html_entity_decode($this->Ini->Nm_lang['lang_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);        ?>"],
    dayNamesMin: ["<?php     echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_sund'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_mond'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_tued'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_wend'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_thud'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_frid'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_substr_days_satd'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    monthNames: ["<?php      echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_janu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_febr"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_marc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_apri"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_mayy"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_june"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_july"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_augu"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_sept"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_octo"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_nove"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>","<?php echo html_entity_decode($this->Ini->Nm_lang["lang_mnth_dece"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);      ?>"],
    monthNamesShort: ["<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_janu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_febr'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_marc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_apri'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_mayy'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_june'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_july'], ENT_COMPAT, $_SESSION['scriptcase']['charset']);   ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_augu'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_sept'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_octo'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_nove'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>","<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_mnth_dece'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"],
    weekHeader: "<?php echo html_entity_decode($this->Ini->Nm_lang['lang_shrt_days_sem'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>",
    firstDay: <?php echo $this->jqueryCalendarWeekInit("" . $_SESSION['scriptcase']['reg_conf']['date_week_ini'] . ""); ?>,
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['dt_chkout']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
    showOtherMonths: true,
    showOn: "button",
<?php
$miniCalendarIcon   = $this->jqueryIconFile('calendar');
$miniCalendarFA     = $this->jqueryFAFile('calendar');
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('' != $miniCalendarIcon) {
?>
    buttonImage: "<?php echo $miniCalendarIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalendarFA) {
?>
    buttonText: "",
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    buttonText: "",
<?php
}
?>
    currentText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_per_today"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
    closeText: "<?php  echo html_entity_decode($this->Ini->Nm_lang["lang_btns_mess_clse"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]);       ?>",
  })
<?php
if ('' != $miniCalendarFA) {
?>
    .next('button').append("<?php echo $miniCalendarFA; ?>")
<?php
}
elseif ('' != $miniCalendarButton[0]) {
?>
    .next('button').append("<?php echo $miniCalendarButton[0]; ?>")
<?php
}
?>
} // scJQCalendarAdd

function scJQUploadAdd(iSeqRow) {
} // scJQUploadAdd

var api_cache_requests = [];
function ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, hasRun, img_before){
    setTimeout(function(){
        if(img_name == '') return;
        iSeqRow= iSeqRow !== undefined && iSeqRow !== null ? iSeqRow : '';
        var hasVar = p.indexOf('_@NM@_') > -1 || p_cache.indexOf('_@NM@_') > -1 ? true : false;

        p = p.split('_@NM@_');
        $.each(p, function(i,v){
            try{
                p[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p[i] = v;
            }
        });
        p = p.join('');

        p_cache = p_cache.split('_@NM@_');
        $.each(p_cache, function(i,v){
            try{
                p_cache[i] = $('[name='+v+iSeqRow+']').val();
            }
            catch(err){
                p_cache[i] = v;
            }
        });
        p_cache = p_cache.join('');

        img_before = img_before !== undefined ? img_before : $(t).attr('src');
        var str_key_cache = '<?php echo $this->Ini->sc_page; ?>' + img_name+field+p+p_cache;
        if(api_cache_requests[ str_key_cache ] !== undefined && api_cache_requests[ str_key_cache ] !== null){
            if(api_cache_requests[ str_key_cache ] != false){
                do_ajax_check_file(api_cache_requests[ str_key_cache ], field  ,t, iSeqRow);
            }
            return;
        }
        //scAjaxProcOn();
        $(t).attr('src', '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif');
        api_cache_requests[ str_key_cache ] = false;
        var rs =$.ajax({
                    type: "POST",
                    url: 'index.php?script_case_init=<?php echo $this->Ini->sc_page; ?>',
                    async: true,
                    data:'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + encodeURI(img_name) +'&rsargs='+ field + '&p=' + p + '&p_cache=' + p_cache,
                    success: function (rs) {
                        if(rs.indexOf('</span>') != -1){
                            rs = rs.substr(rs.indexOf('</span>') + 7);
                        }
                        if(rs.indexOf('/') != -1 && rs.indexOf('/') != 0){
                            rs = rs.substr(rs.indexOf('/'));
                        }
                        rs = sc_trim(rs);

                        // if(rs == 0 && hasVar && hasRun === undefined){
                        //     delete window.api_cache_requests[ str_key_cache ];
                        //     ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, 1, img_before);
                        //     return;
                        // }
                        window.api_cache_requests[ str_key_cache ] = rs;
                        do_ajax_check_file(rs, field  ,t, iSeqRow)
                        if(rs == 0){
                            delete window.api_cache_requests[ str_key_cache ];

                           // $(t).attr('src',img_before);
                            do_ajax_check_file(img_before+'_@@NM@@_' + img_before, field  ,t, iSeqRow)

                        }


                    }
        });
    },100);
}

function do_ajax_check_file(rs, field  ,t, iSeqRow){
    if (rs != 0) {
        rs_split = rs.split('_@@NM@@_');
        rs_orig = rs_split[0];
        rs2 = rs_split[1];
        try{
            if(!$(t).is('img')){

                if($('#id_read_on_'+field+iSeqRow).length > 0 ){
                                    var usa_read_only = false;

                switch(field){

                }
                     if(usa_read_only && $('a',$('#id_read_on_'+field+iSeqRow)).length == 0){
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'cv_chkinout')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href', target.join(','));
                }else{
                    var target = $(t).attr('href').split(',');
                     target[1] = "'"+rs2+"'";
                     $(t).attr('href', target.join(','));
                }
            }else{
                $(t).attr('src', rs2);
                $(t).css('display', '');
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    var target = $('#id_ajax_doc_'+field+iSeqRow+' a').attr('href').split(',');
                    target[1] = "'"+rs2+"'";
                    $(t).attr('href', target.join(','));
                }else{
                     var t_link = $(t).parent('a');
                     var target = $(t_link).attr('href').split(',');
                     target[0] = "javascript:nm_mostra_img('"+rs_orig+"'";
                     $(t_link).attr('href', target.join(','));
                }

            }
            eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        } catch(err){
                        eval("window.var_ajax_img_"+field+iSeqRow+" = '"+rs_orig+"';");

        }
    }
   /* hasFalseCacheRequest = false;
    $.each(api_cache_requests, function(i,v){
        if(v == false){
            hasFalseCacheRequest = true;
        }
    });
    if(hasFalseCacheRequest == false){
        scAjaxProcOff();
    }*/
}

$(document).ready(function(){
});

function scJQPasswordToggleAdd(seqRow) {
  $(".sc-ui-pwd-toggle-icon" + seqRow).on("click", function() {
    var fieldName = $(this).attr("id").substr(17), fieldObj = $("#id_sc_field_" + fieldName), fieldFA = $("#id_pwd_fa_" + fieldName);
    if ("text" == fieldObj.attr("type")) {
      fieldObj.attr("type", "password");
      fieldFA.attr("class", "fa fa-eye sc-ui-pwd-eye");
    } else {
      fieldObj.attr("type", "text");
      fieldFA.attr("class", "fa fa-eye-slash sc-ui-pwd-eye");
    }
  });
} // scJQPasswordToggleAdd


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
} // scJQElementsAdd

function scGetFileExtension(fileName)
{
    fileNameParts = fileName.split(".");

    if (1 === fileNameParts.length || (2 === fileNameParts.length && "" == fileNameParts[0])) {
        return "";
    }

    return fileNameParts.pop().toLowerCase();
}

function scFormatExtensionSizeErrorMsg(errorMsg)
{
    var msgInfo = errorMsg.split("||"), returnMsg = "";

    if ("err_size" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_size'] ?>. <?php echo $this->Ini->Nm_lang['lang_errm_file_size_extension'] ?>".replace("{SC_EXTENSION}", msgInfo[1]).replace("{SC_LIMIT}", msgInfo[2]);
    } else if ("err_extension" == msgInfo[0]) {
        returnMsg = "<?php echo $this->Ini->Nm_lang['lang_errm_file_invl'] ?>";
    }

    return returnMsg;
}

