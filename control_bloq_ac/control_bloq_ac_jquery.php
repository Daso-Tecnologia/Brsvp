
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
     if (sField == 'bloq_dsc' || sField == 'bloq_dsc_subs') {
        $oField.select2('open');
     }
     else {
        $oField[0].focus();
     }
    return true;
  }
  return false;
} // scSetFocusOnField

function scEventControl_init(iSeqRow) {
  scEventControl_data["bloq_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_hotel_atual" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["acomodacao_atual" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["categoria_atual" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_atual" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["quartos_atual" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["saldo_quartos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_dsc_subs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_hotel_subs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["acomodacao_subs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["categoria_subs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_subs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["quartos_subs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["saldo_quartos_subs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["bloq_dsc" + iSeqRow] && scEventControl_data["bloq_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_dsc" + iSeqRow] && scEventControl_data["bloq_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_hotel_atual" + iSeqRow] && scEventControl_data["id_hotel_atual" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_hotel_atual" + iSeqRow] && scEventControl_data["id_hotel_atual" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["acomodacao_atual" + iSeqRow] && scEventControl_data["acomodacao_atual" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["acomodacao_atual" + iSeqRow] && scEventControl_data["acomodacao_atual" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["categoria_atual" + iSeqRow] && scEventControl_data["categoria_atual" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["categoria_atual" + iSeqRow] && scEventControl_data["categoria_atual" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_atual" + iSeqRow] && scEventControl_data["evento_atual" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_atual" + iSeqRow] && scEventControl_data["evento_atual" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["quartos_atual" + iSeqRow] && scEventControl_data["quartos_atual" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["quartos_atual" + iSeqRow] && scEventControl_data["quartos_atual" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["saldo_quartos" + iSeqRow] && scEventControl_data["saldo_quartos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["saldo_quartos" + iSeqRow] && scEventControl_data["saldo_quartos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_dsc_subs" + iSeqRow] && scEventControl_data["bloq_dsc_subs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_dsc_subs" + iSeqRow] && scEventControl_data["bloq_dsc_subs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_hotel_subs" + iSeqRow] && scEventControl_data["id_hotel_subs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_hotel_subs" + iSeqRow] && scEventControl_data["id_hotel_subs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["acomodacao_subs" + iSeqRow] && scEventControl_data["acomodacao_subs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["acomodacao_subs" + iSeqRow] && scEventControl_data["acomodacao_subs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["categoria_subs" + iSeqRow] && scEventControl_data["categoria_subs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["categoria_subs" + iSeqRow] && scEventControl_data["categoria_subs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_subs" + iSeqRow] && scEventControl_data["evento_subs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_subs" + iSeqRow] && scEventControl_data["evento_subs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["quartos_subs" + iSeqRow] && scEventControl_data["quartos_subs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["quartos_subs" + iSeqRow] && scEventControl_data["quartos_subs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["saldo_quartos_subs" + iSeqRow] && scEventControl_data["saldo_quartos_subs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["saldo_quartos_subs" + iSeqRow] && scEventControl_data["saldo_quartos_subs" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("bloq_dsc" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("bloq_dsc_subs" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("bloq_dsc" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("bloq_dsc_subs" + iSeq == fieldName) {
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
  $('#id_sc_field_bloq_dsc' + iSeqRow).bind('select2:close', function() { sc_control_bloq_ac_bloq_dsc_onblur('#id_sc_field_bloq_dsc' + iSeqRow, iSeqRow, event) })
                                      .bind('change', function() { sc_control_bloq_ac_bloq_dsc_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_control_bloq_ac_bloq_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_hotel_atual' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_id_hotel_atual_onblur('#id_sc_field_id_hotel_atual' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_control_bloq_ac_id_hotel_atual_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_control_bloq_ac_id_hotel_atual_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_acomodacao_atual' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_acomodacao_atual_onblur('#id_sc_field_acomodacao_atual' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_control_bloq_ac_acomodacao_atual_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_control_bloq_ac_acomodacao_atual_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_categoria_atual' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_categoria_atual_onblur('#id_sc_field_categoria_atual' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_control_bloq_ac_categoria_atual_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_control_bloq_ac_categoria_atual_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_atual' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_evento_atual_onblur('#id_sc_field_evento_atual' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_control_bloq_ac_evento_atual_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_control_bloq_ac_evento_atual_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_quartos_atual' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_quartos_atual_onblur('#id_sc_field_quartos_atual' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_control_bloq_ac_quartos_atual_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_control_bloq_ac_quartos_atual_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_saldo_quartos' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_saldo_quartos_onblur('#id_sc_field_saldo_quartos' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_control_bloq_ac_saldo_quartos_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_control_bloq_ac_saldo_quartos_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_dsc_subs' + iSeqRow).bind('select2:close', function() { sc_control_bloq_ac_bloq_dsc_subs_onblur('#id_sc_field_bloq_dsc_subs' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_control_bloq_ac_bloq_dsc_subs_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_control_bloq_ac_bloq_dsc_subs_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_hotel_subs' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_id_hotel_subs_onblur('#id_sc_field_id_hotel_subs' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_control_bloq_ac_id_hotel_subs_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_control_bloq_ac_id_hotel_subs_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_acomodacao_subs' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_acomodacao_subs_onblur('#id_sc_field_acomodacao_subs' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_control_bloq_ac_acomodacao_subs_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_control_bloq_ac_acomodacao_subs_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_categoria_subs' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_categoria_subs_onblur('#id_sc_field_categoria_subs' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_control_bloq_ac_categoria_subs_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_control_bloq_ac_categoria_subs_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_subs' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_evento_subs_onblur('#id_sc_field_evento_subs' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_control_bloq_ac_evento_subs_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_control_bloq_ac_evento_subs_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_quartos_subs' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_quartos_subs_onblur('#id_sc_field_quartos_subs' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_control_bloq_ac_quartos_subs_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_control_bloq_ac_quartos_subs_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_saldo_quartos_subs' + iSeqRow).bind('blur', function() { sc_control_bloq_ac_saldo_quartos_subs_onblur('#id_sc_field_saldo_quartos_subs' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_control_bloq_ac_saldo_quartos_subs_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_control_bloq_ac_saldo_quartos_subs_onfocus(this, iSeqRow, event) });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_control_bloq_ac_bloq_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_bloq_dsc();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_bloq_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_control_bloq_ac_event_bloq_dsc_onchange();
}

function sc_control_bloq_ac_bloq_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_id_hotel_atual_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_id_hotel_atual();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_id_hotel_atual_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_id_hotel_atual_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_acomodacao_atual_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_acomodacao_atual();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_acomodacao_atual_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_acomodacao_atual_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_categoria_atual_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_categoria_atual();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_categoria_atual_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_categoria_atual_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_evento_atual_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_evento_atual();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_evento_atual_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_evento_atual_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_quartos_atual_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_quartos_atual();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_quartos_atual_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_quartos_atual_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_saldo_quartos_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_saldo_quartos();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_saldo_quartos_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_saldo_quartos_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_bloq_dsc_subs_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_bloq_dsc_subs();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_bloq_dsc_subs_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_control_bloq_ac_event_bloq_dsc_subs_onchange();
}

function sc_control_bloq_ac_bloq_dsc_subs_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_id_hotel_subs_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_id_hotel_subs();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_id_hotel_subs_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_id_hotel_subs_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_acomodacao_subs_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_acomodacao_subs();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_acomodacao_subs_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_acomodacao_subs_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_categoria_subs_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_categoria_subs();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_categoria_subs_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_categoria_subs_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_evento_subs_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_evento_subs();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_evento_subs_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_evento_subs_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_quartos_subs_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_quartos_subs();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_quartos_subs_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_quartos_subs_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_control_bloq_ac_saldo_quartos_subs_onblur(oThis, iSeqRow, event) {
  do_ajax_control_bloq_ac_validate_saldo_quartos_subs();
  scCssBlur(oThis);
}

function sc_control_bloq_ac_saldo_quartos_subs_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_control_bloq_ac_saldo_quartos_subs_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
        if ("1" == block) {
                displayChange_block_1(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("bloq_dsc", "", status);
        displayChange_field("id_hotel_atual", "", status);
        displayChange_field("acomodacao_atual", "", status);
        displayChange_field("categoria_atual", "", status);
        displayChange_field("evento_atual", "", status);
        displayChange_field("quartos_atual", "", status);
        displayChange_field("saldo_quartos", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("bloq_dsc_subs", "", status);
        displayChange_field("id_hotel_subs", "", status);
        displayChange_field("acomodacao_subs", "", status);
        displayChange_field("categoria_subs", "", status);
        displayChange_field("evento_subs", "", status);
        displayChange_field("quartos_subs", "", status);
        displayChange_field("saldo_quartos_subs", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_bloq_dsc(row, status);
        displayChange_field_id_hotel_atual(row, status);
        displayChange_field_acomodacao_atual(row, status);
        displayChange_field_categoria_atual(row, status);
        displayChange_field_evento_atual(row, status);
        displayChange_field_quartos_atual(row, status);
        displayChange_field_saldo_quartos(row, status);
        displayChange_field_bloq_dsc_subs(row, status);
        displayChange_field_id_hotel_subs(row, status);
        displayChange_field_acomodacao_subs(row, status);
        displayChange_field_categoria_subs(row, status);
        displayChange_field_evento_subs(row, status);
        displayChange_field_quartos_subs(row, status);
        displayChange_field_saldo_quartos_subs(row, status);
}

function displayChange_field(field, row, status) {
        if ("bloq_dsc" == field) {
                displayChange_field_bloq_dsc(row, status);
        }
        if ("id_hotel_atual" == field) {
                displayChange_field_id_hotel_atual(row, status);
        }
        if ("acomodacao_atual" == field) {
                displayChange_field_acomodacao_atual(row, status);
        }
        if ("categoria_atual" == field) {
                displayChange_field_categoria_atual(row, status);
        }
        if ("evento_atual" == field) {
                displayChange_field_evento_atual(row, status);
        }
        if ("quartos_atual" == field) {
                displayChange_field_quartos_atual(row, status);
        }
        if ("saldo_quartos" == field) {
                displayChange_field_saldo_quartos(row, status);
        }
        if ("bloq_dsc_subs" == field) {
                displayChange_field_bloq_dsc_subs(row, status);
        }
        if ("id_hotel_subs" == field) {
                displayChange_field_id_hotel_subs(row, status);
        }
        if ("acomodacao_subs" == field) {
                displayChange_field_acomodacao_subs(row, status);
        }
        if ("categoria_subs" == field) {
                displayChange_field_categoria_subs(row, status);
        }
        if ("evento_subs" == field) {
                displayChange_field_evento_subs(row, status);
        }
        if ("quartos_subs" == field) {
                displayChange_field_quartos_subs(row, status);
        }
        if ("saldo_quartos_subs" == field) {
                displayChange_field_saldo_quartos_subs(row, status);
        }
}

function displayChange_field_bloq_dsc(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_bloq_dsc__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_bloq_dsc' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_bloq_dsc" + row).select2("destroy");
                }
                scJQSelect2Add(row, "bloq_dsc");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_bloq_dsc' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_id_hotel_atual(row, status) {
    var fieldId;
}

function displayChange_field_acomodacao_atual(row, status) {
    var fieldId;
}

function displayChange_field_categoria_atual(row, status) {
    var fieldId;
}

function displayChange_field_evento_atual(row, status) {
    var fieldId;
}

function displayChange_field_quartos_atual(row, status) {
    var fieldId;
}

function displayChange_field_saldo_quartos(row, status) {
    var fieldId;
}

function displayChange_field_bloq_dsc_subs(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_bloq_dsc_subs__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_bloq_dsc_subs' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_bloq_dsc_subs" + row).select2("destroy");
                }
                scJQSelect2Add(row, "bloq_dsc_subs");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_bloq_dsc_subs' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_id_hotel_subs(row, status) {
    var fieldId;
}

function displayChange_field_acomodacao_subs(row, status) {
    var fieldId;
}

function displayChange_field_categoria_subs(row, status) {
    var fieldId;
}

function displayChange_field_evento_subs(row, status) {
    var fieldId;
}

function displayChange_field_quartos_subs(row, status) {
    var fieldId;
}

function displayChange_field_saldo_quartos_subs(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
        displayChange_field_bloq_dsc("all", "on");
        displayChange_field_bloq_dsc_subs("all", "on");
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_control_bloq_ac_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(26);
                }
        }
}
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'control_bloq_ac')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
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

function scJQSelect2Add(seqRow, specificField) {
  if (null == specificField || "bloq_dsc" == specificField) {
    scJQSelect2Add_bloq_dsc(seqRow);
  }
  if (null == specificField || "bloq_dsc_subs" == specificField) {
    scJQSelect2Add_bloq_dsc_subs(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_bloq_dsc(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_bloq_dsc_obj" : "#id_sc_field_bloq_dsc" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_bloq_dsc_obj',
      dropdownCssClass: 'css_bloq_dsc_obj',
      language: {
        noResults: function() {
          return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
        },
        searching: function() {
          return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
        }
      }
    }
  );
  $('#select2-id_sc_field_bloq_dsc' + seqRow + '-container').addClass('css_bloq_dsc_obj');
} // scJQSelect2Add

function scJQSelect2Add_bloq_dsc_subs(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_bloq_dsc_subs_obj" : "#id_sc_field_bloq_dsc_subs" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_bloq_dsc_subs_obj',
      dropdownCssClass: 'css_bloq_dsc_subs_obj',
      language: {
        noResults: function() {
          return "<?php echo $this->Ini->Nm_lang['lang_autocomp_notfound'] ?>";
        },
        searching: function() {
          return "<?php echo $this->Ini->Nm_lang['lang_autocomp_searching'] ?>";
        }
      }
    }
  );
  $('#select2-id_sc_field_bloq_dsc_subs' + seqRow + '-container').addClass('css_bloq_dsc_subs_obj');
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_bloq_dsc) { displayChange_field_bloq_dsc(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_bloq_dsc_subs) { displayChange_field_bloq_dsc_subs(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
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

