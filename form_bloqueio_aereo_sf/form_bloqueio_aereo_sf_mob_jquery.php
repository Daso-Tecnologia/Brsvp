
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
     if (sField == 'bloq_evento_id' || sField == 'bloq_cia_aerea' || sField == 'bloq_origem' || sField == 'bloq_destino') {
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
  scEventControl_data["bloqueio_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_evento_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_descricao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_direcao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_cia_aerea" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_origem" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_destino" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_dt_saida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_hr_saida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_dt_chegada" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_hr_chegada" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_num_voo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_num_pass_etkt" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_localizador" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["obs_voucher" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_qtd_lugares" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_saldo_lugares" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_nota_gate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bloq_dt_nota_gate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["exibir" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["bloqueio_id" + iSeqRow] && scEventControl_data["bloqueio_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloqueio_id" + iSeqRow] && scEventControl_data["bloqueio_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_evento_id" + iSeqRow] && scEventControl_data["bloq_evento_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_evento_id" + iSeqRow] && scEventControl_data["bloq_evento_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_descricao" + iSeqRow] && scEventControl_data["bloq_descricao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_descricao" + iSeqRow] && scEventControl_data["bloq_descricao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_direcao" + iSeqRow] && scEventControl_data["bloq_direcao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_direcao" + iSeqRow] && scEventControl_data["bloq_direcao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_cia_aerea" + iSeqRow] && scEventControl_data["bloq_cia_aerea" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_cia_aerea" + iSeqRow] && scEventControl_data["bloq_cia_aerea" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_origem" + iSeqRow] && scEventControl_data["bloq_origem" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_origem" + iSeqRow] && scEventControl_data["bloq_origem" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_destino" + iSeqRow] && scEventControl_data["bloq_destino" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_destino" + iSeqRow] && scEventControl_data["bloq_destino" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_dt_saida" + iSeqRow] && scEventControl_data["bloq_dt_saida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_dt_saida" + iSeqRow] && scEventControl_data["bloq_dt_saida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_hr_saida" + iSeqRow] && scEventControl_data["bloq_hr_saida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_hr_saida" + iSeqRow] && scEventControl_data["bloq_hr_saida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_dt_chegada" + iSeqRow] && scEventControl_data["bloq_dt_chegada" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_dt_chegada" + iSeqRow] && scEventControl_data["bloq_dt_chegada" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_hr_chegada" + iSeqRow] && scEventControl_data["bloq_hr_chegada" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_hr_chegada" + iSeqRow] && scEventControl_data["bloq_hr_chegada" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_num_voo" + iSeqRow] && scEventControl_data["bloq_num_voo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_num_voo" + iSeqRow] && scEventControl_data["bloq_num_voo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_num_pass_etkt" + iSeqRow] && scEventControl_data["bloq_num_pass_etkt" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_num_pass_etkt" + iSeqRow] && scEventControl_data["bloq_num_pass_etkt" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_localizador" + iSeqRow] && scEventControl_data["bloq_localizador" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_localizador" + iSeqRow] && scEventControl_data["bloq_localizador" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["obs_voucher" + iSeqRow] && scEventControl_data["obs_voucher" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["obs_voucher" + iSeqRow] && scEventControl_data["obs_voucher" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_qtd_lugares" + iSeqRow] && scEventControl_data["bloq_qtd_lugares" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_qtd_lugares" + iSeqRow] && scEventControl_data["bloq_qtd_lugares" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_saldo_lugares" + iSeqRow] && scEventControl_data["bloq_saldo_lugares" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_saldo_lugares" + iSeqRow] && scEventControl_data["bloq_saldo_lugares" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_nota_gate" + iSeqRow] && scEventControl_data["bloq_nota_gate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_nota_gate" + iSeqRow] && scEventControl_data["bloq_nota_gate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bloq_dt_nota_gate" + iSeqRow] && scEventControl_data["bloq_dt_nota_gate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bloq_dt_nota_gate" + iSeqRow] && scEventControl_data["bloq_dt_nota_gate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["exibir" + iSeqRow] && scEventControl_data["exibir" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["exibir" + iSeqRow] && scEventControl_data["exibir" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("bloq_evento_id" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("bloq_cia_aerea" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("bloq_origem" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("bloq_destino" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("exibir" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("bloq_cia_aerea" + iSeq == fieldName) {
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
  $('#id_sc_field_bloqueio_id' + iSeqRow).bind('blur', function() { sc_form_bloqueio_aereo_sf_bloqueio_id_onblur('#id_sc_field_bloqueio_id' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloqueio_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_evento_id' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_evento_id_onblur('#id_sc_field_bloq_evento_id' + iSeqRow, iSeqRow, event);}, 300) })
                                            .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_evento_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_descricao' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_descricao_onblur('#id_sc_field_bloq_descricao' + iSeqRow, iSeqRow, event);}, 300) })
                                            .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_descricao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_cia_aerea' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_cia_aerea_onblur('#id_sc_field_bloq_cia_aerea' + iSeqRow, iSeqRow, event);}, 300) })
                                            .bind('change', function() { sc_form_bloqueio_aereo_sf_bloq_cia_aerea_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_cia_aerea_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_direcao' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_direcao_onblur('#id_sc_field_bloq_direcao' + iSeqRow, iSeqRow, event);}, 300) })
                                          .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_direcao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_origem' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_origem_onblur('#id_sc_field_bloq_origem' + iSeqRow, iSeqRow, event);}, 300) })
                                         .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_origem_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_destino' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_destino_onblur('#id_sc_field_bloq_destino' + iSeqRow, iSeqRow, event);}, 300) })
                                          .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_destino_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_dt_saida' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_dt_saida_onblur('#id_sc_field_bloq_dt_saida' + iSeqRow, iSeqRow, event);}, 300) })
                                           .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_dt_saida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_dt_chegada' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_dt_chegada_onblur('#id_sc_field_bloq_dt_chegada' + iSeqRow, iSeqRow, event);}, 300) })
                                             .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_dt_chegada_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_hr_saida' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_hr_saida_onblur('#id_sc_field_bloq_hr_saida' + iSeqRow, iSeqRow, event);}, 300) })
                                           .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_hr_saida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_hr_chegada' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_hr_chegada_onblur('#id_sc_field_bloq_hr_chegada' + iSeqRow, iSeqRow, event);}, 300) })
                                             .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_hr_chegada_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_num_voo' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_bloqueio_aereo_sf_bloq_num_voo_onblur('#id_sc_field_bloq_num_voo' + iSeqRow, iSeqRow, event);}, 300) })
                                          .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_num_voo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_num_pass_etkt' + iSeqRow).bind('blur', function() { sc_form_bloqueio_aereo_sf_bloq_num_pass_etkt_onblur('#id_sc_field_bloq_num_pass_etkt' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_num_pass_etkt_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_localizador' + iSeqRow).bind('blur', function() { sc_form_bloqueio_aereo_sf_bloq_localizador_onblur('#id_sc_field_bloq_localizador' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_localizador_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_qtd_lugares' + iSeqRow).bind('blur', function() { sc_form_bloqueio_aereo_sf_bloq_qtd_lugares_onblur('#id_sc_field_bloq_qtd_lugares' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_qtd_lugares_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_saldo_lugares' + iSeqRow).bind('blur', function() { sc_form_bloqueio_aereo_sf_bloq_saldo_lugares_onblur('#id_sc_field_bloq_saldo_lugares' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_saldo_lugares_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_nota_gate' + iSeqRow).bind('blur', function() { sc_form_bloqueio_aereo_sf_bloq_nota_gate_onblur('#id_sc_field_bloq_nota_gate' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_nota_gate_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bloq_dt_nota_gate' + iSeqRow).bind('blur', function() { sc_form_bloqueio_aereo_sf_bloq_dt_nota_gate_onblur('#id_sc_field_bloq_dt_nota_gate' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_bloqueio_aereo_sf_bloq_dt_nota_gate_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_exibir' + iSeqRow).bind('blur', function() { sc_form_bloqueio_aereo_sf_exibir_onblur('#id_sc_field_exibir' + iSeqRow, iSeqRow, event) })
                                    .bind('focus', function() { sc_form_bloqueio_aereo_sf_exibir_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_obs_voucher' + iSeqRow).bind('blur', function() { sc_form_bloqueio_aereo_sf_obs_voucher_onblur('#id_sc_field_obs_voucher' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_bloqueio_aereo_sf_obs_voucher_onfocus(this, iSeqRow, event) });
  $('.sc-ui-radio-bloq_direcao' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_bloqueio_aereo_sf_bloqueio_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloqueio_id();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloqueio_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_evento_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_evento_id();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_evento_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_descricao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_descricao();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_descricao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_cia_aerea_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_cia_aerea();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_cia_aerea_onchange(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_event_bloq_cia_aerea_onchange();
}

function sc_form_bloqueio_aereo_sf_bloq_cia_aerea_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_direcao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_direcao();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_direcao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_origem_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_origem();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_origem_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_destino_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_destino();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_destino_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_dt_saida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_dt_saida();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_dt_saida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_dt_chegada_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_dt_chegada();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_dt_chegada_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_hr_saida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_hr_saida();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_hr_saida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_hr_chegada_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_hr_chegada();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_hr_chegada_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_num_voo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_num_voo();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_num_voo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_num_pass_etkt_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_num_pass_etkt();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_num_pass_etkt_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_localizador_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_localizador();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_localizador_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_qtd_lugares_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_qtd_lugares();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_qtd_lugares_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_saldo_lugares_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_saldo_lugares();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_saldo_lugares_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_nota_gate_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_nota_gate();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_nota_gate_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_dt_nota_gate_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_dt_nota_gate();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_bloq_dt_nota_gate_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_exibir_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_exibir();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_exibir_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_bloqueio_aereo_sf_obs_voucher_onblur(oThis, iSeqRow, event) {
  do_ajax_form_bloqueio_aereo_sf_mob_validate_obs_voucher();
  scCssBlur(oThis);
}

function sc_form_bloqueio_aereo_sf_obs_voucher_onfocus(oThis, iSeqRow, event) {
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
        displayChange_field("bloqueio_id", "", status);
        displayChange_field("bloq_evento_id", "", status);
        displayChange_field("bloq_descricao", "", status);
        displayChange_field("bloq_direcao", "", status);
        displayChange_field("bloq_cia_aerea", "", status);
        displayChange_field("bloq_origem", "", status);
        displayChange_field("bloq_destino", "", status);
        displayChange_field("bloq_dt_saida", "", status);
        displayChange_field("bloq_hr_saida", "", status);
        displayChange_field("bloq_dt_chegada", "", status);
        displayChange_field("bloq_hr_chegada", "", status);
        displayChange_field("bloq_num_voo", "", status);
        displayChange_field("bloq_num_pass_etkt", "", status);
        displayChange_field("bloq_localizador", "", status);
        displayChange_field("obs_voucher", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("bloq_qtd_lugares", "", status);
        displayChange_field("bloq_saldo_lugares", "", status);
        displayChange_field("bloq_nota_gate", "", status);
        displayChange_field("bloq_dt_nota_gate", "", status);
        displayChange_field("exibir", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_bloqueio_id(row, status);
        displayChange_field_bloq_evento_id(row, status);
        displayChange_field_bloq_descricao(row, status);
        displayChange_field_bloq_direcao(row, status);
        displayChange_field_bloq_cia_aerea(row, status);
        displayChange_field_bloq_origem(row, status);
        displayChange_field_bloq_destino(row, status);
        displayChange_field_bloq_dt_saida(row, status);
        displayChange_field_bloq_hr_saida(row, status);
        displayChange_field_bloq_dt_chegada(row, status);
        displayChange_field_bloq_hr_chegada(row, status);
        displayChange_field_bloq_num_voo(row, status);
        displayChange_field_bloq_num_pass_etkt(row, status);
        displayChange_field_bloq_localizador(row, status);
        displayChange_field_obs_voucher(row, status);
        displayChange_field_bloq_qtd_lugares(row, status);
        displayChange_field_bloq_saldo_lugares(row, status);
        displayChange_field_bloq_nota_gate(row, status);
        displayChange_field_bloq_dt_nota_gate(row, status);
        displayChange_field_exibir(row, status);
}

function displayChange_field(field, row, status) {
        if ("bloqueio_id" == field) {
                displayChange_field_bloqueio_id(row, status);
        }
        if ("bloq_evento_id" == field) {
                displayChange_field_bloq_evento_id(row, status);
        }
        if ("bloq_descricao" == field) {
                displayChange_field_bloq_descricao(row, status);
        }
        if ("bloq_direcao" == field) {
                displayChange_field_bloq_direcao(row, status);
        }
        if ("bloq_cia_aerea" == field) {
                displayChange_field_bloq_cia_aerea(row, status);
        }
        if ("bloq_origem" == field) {
                displayChange_field_bloq_origem(row, status);
        }
        if ("bloq_destino" == field) {
                displayChange_field_bloq_destino(row, status);
        }
        if ("bloq_dt_saida" == field) {
                displayChange_field_bloq_dt_saida(row, status);
        }
        if ("bloq_hr_saida" == field) {
                displayChange_field_bloq_hr_saida(row, status);
        }
        if ("bloq_dt_chegada" == field) {
                displayChange_field_bloq_dt_chegada(row, status);
        }
        if ("bloq_hr_chegada" == field) {
                displayChange_field_bloq_hr_chegada(row, status);
        }
        if ("bloq_num_voo" == field) {
                displayChange_field_bloq_num_voo(row, status);
        }
        if ("bloq_num_pass_etkt" == field) {
                displayChange_field_bloq_num_pass_etkt(row, status);
        }
        if ("bloq_localizador" == field) {
                displayChange_field_bloq_localizador(row, status);
        }
        if ("obs_voucher" == field) {
                displayChange_field_obs_voucher(row, status);
        }
        if ("bloq_qtd_lugares" == field) {
                displayChange_field_bloq_qtd_lugares(row, status);
        }
        if ("bloq_saldo_lugares" == field) {
                displayChange_field_bloq_saldo_lugares(row, status);
        }
        if ("bloq_nota_gate" == field) {
                displayChange_field_bloq_nota_gate(row, status);
        }
        if ("bloq_dt_nota_gate" == field) {
                displayChange_field_bloq_dt_nota_gate(row, status);
        }
        if ("exibir" == field) {
                displayChange_field_exibir(row, status);
        }
}

function displayChange_field_bloqueio_id(row, status) {
    var fieldId;
}

function displayChange_field_bloq_evento_id(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_bloq_evento_id__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_bloq_evento_id' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_bloq_evento_id" + row).select2("destroy");
                }
                scJQSelect2Add(row, "bloq_evento_id");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_bloq_evento_id' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_bloq_descricao(row, status) {
    var fieldId;
}

function displayChange_field_bloq_direcao(row, status) {
    var fieldId;
}

function displayChange_field_bloq_cia_aerea(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_bloq_cia_aerea__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_bloq_cia_aerea' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_bloq_cia_aerea" + row).select2("destroy");
                }
                scJQSelect2Add(row, "bloq_cia_aerea");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_bloq_cia_aerea' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_bloq_origem(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_bloq_origem__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_bloq_origem' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_bloq_origem" + row).select2("destroy");
                }
                scJQSelect2Add(row, "bloq_origem");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_bloq_origem' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_bloq_destino(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_bloq_destino__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_bloq_destino' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_bloq_destino" + row).select2("destroy");
                }
                scJQSelect2Add(row, "bloq_destino");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_bloq_destino' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_bloq_dt_saida(row, status) {
    var fieldId;
}

function displayChange_field_bloq_hr_saida(row, status) {
    var fieldId;
}

function displayChange_field_bloq_dt_chegada(row, status) {
    var fieldId;
}

function displayChange_field_bloq_hr_chegada(row, status) {
    var fieldId;
}

function displayChange_field_bloq_num_voo(row, status) {
    var fieldId;
}

function displayChange_field_bloq_num_pass_etkt(row, status) {
    var fieldId;
}

function displayChange_field_bloq_localizador(row, status) {
    var fieldId;
}

function displayChange_field_obs_voucher(row, status) {
    var fieldId;
}

function displayChange_field_bloq_qtd_lugares(row, status) {
    var fieldId;
}

function displayChange_field_bloq_saldo_lugares(row, status) {
    var fieldId;
}

function displayChange_field_bloq_nota_gate(row, status) {
    var fieldId;
}

function displayChange_field_bloq_dt_nota_gate(row, status) {
    var fieldId;
}

function displayChange_field_exibir(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
        displayChange_field_bloq_evento_id("all", "on");
        displayChange_field_bloq_cia_aerea("all", "on");
        displayChange_field_bloq_origem("all", "on");
        displayChange_field_bloq_destino("all", "on");
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_bloqueio_aereo_sf_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(37);
                }
        }
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_bloq_dt_saida" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_bloq_dt_saida" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_bloq_dt_saida" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_dt_saida(iSeqRow); }, 200);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['bloq_dt_saida']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_bloq_dt_chegada" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_bloq_dt_chegada" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_bloq_dt_chegada" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_form_bloqueio_aereo_sf_mob_validate_bloq_dt_chegada(iSeqRow); }, 200);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['bloq_dt_chegada']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
function scApiDisableStorageLink(t) {
    var $links = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a');
    $links.each(function() {
        var $el = $(this);
        var currentHref = $el.attr('href') || '';
        if (typeof $el.data('scApiHref') === 'undefined' && currentHref.indexOf('void(0)') === -1) {
            $el.data('scApiHref', currentHref);
        }
        $el.addClass('sc-api-loading').css('pointer-events', 'none').attr('href', 'javascript:void(0);');
    });
}
function scApiEnableStorageLink(t) {
    var $links = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a');
    $links.each(function() {
        var $el = $(this);
        var href = $el.data('scApiHref');
        if (href && String($el.attr('href') || '').indexOf('void(0)') !== -1) {
            $el.attr('href', href);
        }
        $el.removeClass('sc-api-loading').css('pointer-events', '');
    });
}
function scApiGetStorageHref($el) {
    var href = $el.data('scApiHref');
    if (typeof href === 'undefined' || href === null || href === '') {
        href = $el.attr('href');
    }
    return href;
}
function scApiSetStorageHref($el, href) {
    $el.attr('href', href).data('scApiHref', href);
}
function scApiSetStorageDocHref($el, rs2, appName) {
    var href = scApiGetStorageHref($el);
    var docType = '0';
    if ($el.data('scApiDocType')) {
        docType = $el.data('scApiDocType');
    }
    if (href && href.indexOf('nm_mostra_doc') !== -1) {
        var parts = href.split(',');
        if (parts.length > 2) {
            parts[1] = "'"+rs2+"'";
            scApiSetStorageHref($el, parts.join(','));
            return;
        }
        var match = href.match(/nm_mostra_doc\s*\(\s*'([^']*)'/);
        if (match && match[1]) {
            docType = match[1];
        }
    }
    scApiSetStorageHref($el, "javascript:nm_mostra_doc('"+docType+"', '"+rs2+"', '"+appName+"')");
}
function scApiToggleDocLoading(field, iSeqRow, show) {
    iSeqRow = (iSeqRow !== undefined && iSeqRow !== null) ? iSeqRow : '';
    var $img = $('#' + field + iSeqRow + '_img_uploading');
    if ($img.length) {
        $img.css('display', show ? '' : 'none');
    }
}
function scApiToggleMuDocLoading(t, show) {
    var $link = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
    if (!$link.length) {
        return;
    }
    var $loading = $link.siblings('img.sc-api-mu-loading').first();
    if (show) {
        if (!$loading.length) {
            $loading = $('<img class="sc-api-mu-loading" align="absmiddle" />').attr('src', '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif');
            $link.before($loading);
        }
        $loading.show();
    } else if ($loading.length) {
        $loading.remove();
    }
}
function scApiIsStorageMiss(rs) {
    return rs === 0 || rs === '0';
}
function scApiHasPendingUpload(field, iSeqRow, fileName) {
    iSeqRow = (iSeqRow !== undefined && iSeqRow !== null) ? iSeqRow : '';
    fileName = (fileName !== undefined && fileName !== null) ? $.trim(String(fileName)) : '';
    var $ul = $('#id_sc_field_' + field + '_ul_name' + iSeqRow);
    if (!$ul.length) {
        $ul = $('[name=' + field + '_ul_name' + iSeqRow + ']');
    }
    if (!$ul.length) {
        $ul = $('#id_sc_field_' + field + '_ul_name');
    }
    if (!$ul.length) {
        $ul = $('[name=' + field + '_ul_name]');
    }
    if ($ul.length && $.trim($ul.val() || '') !== '') {
        return true;
    }
    if (fileName !== '') {
        var queue = window['scUploadQueue_' + field];
        if (queue && $.isArray(queue)) {
            for (var i = 0; i < queue.length; i++) {
                var parts = String(queue[i]).split('@sci@');
                if (parts.length > 1 && parts[1] === fileName) {
                    return true;
                }
            }
        }
        var $done = $('#id_sc_upload_done_' + field + iSeqRow);
        if (!$done.length) {
            $done = $('#id_sc_upload_done_' + field);
        }
        if ($done.length && $done.text().indexOf(fileName) !== -1) {
            return true;
        }
    }
    return false;
}
function scApiApplyStorageMiss(t, field, iSeqRow, img_before) {
    iSeqRow = (iSeqRow !== undefined && iSeqRow !== null) ? iSeqRow : '';
    if ($(t).data('scApiMissApplied')) {
        return;
    }
    var scApiLoadIcon = '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif';
    if ($(t).is('img')) {
        if (img_before && img_before.indexOf(scApiLoadIcon) === -1 && img_before.indexOf('ajax_load') === -1) {
            $(t).attr('src', img_before).css('display', '');
        } else {
            $(t).hide();
        }
    } else {
        $(t).data('scApiMissApplied', true);
        var $docContainer = $('#id_ajax_doc_' + field + iSeqRow);
        if ($docContainer.length) {
            $docContainer.data('scApiMiss', true);
        }
        scApiToggleDocLoading(field, iSeqRow, false);
        scApiToggleMuDocLoading(t, false);
        scApiEnableStorageLink(t);
        var $muItem = $(t).closest('[class*="id_mu_item_"]');
        if ($muItem.length) {
            $muItem.find('img.sc-api-loading').removeClass('sc-api-loading').hide();
        }
    }
}
function scApiBindImageFieldObserver(field, apiPath, apiPathCache) {
    var scApiRunImageCheck = function(target) {
        var iSeqRow = '';
        var fileName = '';
        var $img = null;
        if (target.id.indexOf('txt_ajax_img_' + field) === 0) {
            iSeqRow = target.id.split('txt_ajax_img_' + field).join('');
            fileName = $.trim($(target).text());
            $img = $('#id_ajax_img_' + field + iSeqRow);
        } else if (target.id.indexOf('id_ajax_img_' + field) === 0) {
            iSeqRow = target.id.split('id_ajax_img_' + field).join('');
            $img = $(target);
            fileName = $.trim($('[name=' + field + iSeqRow + ']').val() || $('[name=' + field + ']').val() || '');
        }
        if (fileName === '' || !$img || !$img.length) {
            return;
        }
        if (scApiHasPendingUpload(field, iSeqRow, fileName)) {
            return;
        }
        $.each(api_cache_requests, function(scApiCacheKey, scApiCacheVal) {
            if (!scApiIsStorageMiss(scApiCacheVal)) {
                delete api_cache_requests[scApiCacheKey];
            }
        });
        $img.removeData('scApiMissApplied');
        ajax_check_file(fileName, field, $img, apiPath, apiPathCache, iSeqRow);
    };
    var scApiObserveTarget = function(target) {
        if (!target || target._scApiImageObserver) {
            return;
        }
        target._scApiImageObserver = true;
        var timeout;
        new MutationObserver(function() {
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                scApiRunImageCheck(target);
            }, 200);
        }).observe(target, {
            childList: true,
            subtree: true,
            characterData: true,
            attributes: true,
            attributeFilter: ['src']
        });
    };
    $('[id^=txt_ajax_img_' + field + '],[id^=id_ajax_img_' + field + ']').each(function() {
        scApiObserveTarget(this);
    });
    window['scApiRefreshImage_' + field] = function() {
        $('[id^=txt_ajax_img_' + field + '],[id^=id_ajax_img_' + field + ']').each(function() {
            scApiRunImageCheck(this);
        });
    };
}
function ajax_check_file(img_name, field  ,t, p, p_cache, iSeqRow, hasRun, img_before){
    setTimeout(function(){
        if(img_name == '') return;
        iSeqRow= iSeqRow !== undefined && iSeqRow !== null ? iSeqRow : '';
        if (scApiHasPendingUpload(field, iSeqRow, img_name)) {
            return;
        }
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

        var str_key_cache = '<?php echo $this->Ini->sc_page; ?>' + img_name+field+p+p_cache;
        if(api_cache_requests[ str_key_cache ] !== undefined && api_cache_requests[ str_key_cache ] !== null){
            if(api_cache_requests[ str_key_cache ] === false){
                return;
            }
            if(scApiIsStorageMiss(api_cache_requests[ str_key_cache ])){
                return;
            }
            if ($(t).is('img')) {
                img_before = img_before !== undefined ? img_before : $(t).attr('src');
            }
                        do_ajax_check_file(api_cache_requests[ str_key_cache ], field  ,t, iSeqRow, img_name);
            return;
        }
        if ($(t).data('scApiMissApplied')) {
            return;
        }
        if ($(t).is('img')) {
            img_before = img_before !== undefined ? img_before : $(t).attr('src');
            $(t).attr('src', '<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif');
        } else {
            scApiDisableStorageLink(t);
            scApiToggleDocLoading(field, iSeqRow, true);
            if ($(t).closest('[class*="id_mu_item_"]').length) {
                scApiToggleMuDocLoading(t, true);
            }
        }
        api_cache_requests[ str_key_cache ] = false;
        var rs =$.ajax({
                    type: "POST",
                    url: 'index.php?script_case_init=<?php echo $this->Ini->sc_page; ?>',
                    async: true,
                    data:'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + encodeURI(img_name) +'&rsargs='+ field + '&p=' + p + '&p_cache=' + p_cache,
                    success: function (rs) {
                        if (scApiHasPendingUpload(field, iSeqRow, img_name)) {
                            return;
                        }
                        if(rs.indexOf('</span>') != -1){
                            rs = rs.substr(rs.indexOf('</span>') + 7);
                        }
                        if(rs.indexOf('/') != -1 && rs.indexOf('/') != 0){
                            rs = rs.substr(rs.indexOf('/'));
                        }
                        rs = sc_trim(rs);

                        if(scApiIsStorageMiss(rs)){
                            window.api_cache_requests[ str_key_cache ] = '0';
                            scApiApplyStorageMiss(t, field, iSeqRow, img_before);
                            return;
                        }
                        window.api_cache_requests[ str_key_cache ] = rs;
                        do_ajax_check_file(rs, field  ,t, iSeqRow, img_name);
                    }
        });
    },100);
}

function do_ajax_check_file(rs, field  ,t, iSeqRow, fileName){
    if (scApiHasPendingUpload(field, iSeqRow, fileName)) {
        return;
    }
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_bloqueio_aereo_sf_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_bloqueio_aereo_sf_mob');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_bloqueio_aereo_sf_mob');
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
        scApiEnableStorageLink(t);
        scApiToggleDocLoading(field, iSeqRow, false);
        scApiToggleMuDocLoading(t, false);
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
if (typeof scAjaxSetFieldMultiUpload_scApiOrig === 'undefined') {
    scAjaxSetFieldMultiUpload_scApiOrig = scAjaxSetFieldMultiUpload;
    scAjaxSetFieldMultiUpload = function(sFieldName, sMULHtml) {
        scAjaxSetFieldMultiUpload_scApiOrig(sFieldName, sMULHtml);
        if (typeof window['scApiRefreshMultiUpload_' + sFieldName] === 'function') {
            window['scApiRefreshMultiUpload_' + sFieldName]();
        }
    };
}
if (typeof scAjaxSetFieldImage_scApiOrig === 'undefined') {
    scAjaxSetFieldImage_scApiOrig = scAjaxSetFieldImage;
    scAjaxSetFieldImage = function(sFieldName, oFieldValues, sImgFile, sImgOrig, sKeepImg, sHideName, sImgLink) {
        scAjaxSetFieldImage_scApiOrig.apply(this, arguments);
        if (typeof window['scApiRefreshImage_' + sFieldName] === 'function') {
            setTimeout(function() {
                window['scApiRefreshImage_' + sFieldName]();
            }, 0);
        }
    };
}

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
  if (null == specificField || "bloq_evento_id" == specificField) {
    scJQSelect2Add_bloq_evento_id(seqRow);
  }
  if (null == specificField || "bloq_cia_aerea" == specificField) {
    scJQSelect2Add_bloq_cia_aerea(seqRow);
  }
  if (null == specificField || "bloq_origem" == specificField) {
    scJQSelect2Add_bloq_origem(seqRow);
  }
  if (null == specificField || "bloq_destino" == specificField) {
    scJQSelect2Add_bloq_destino(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_bloq_evento_id(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_bloq_evento_id_obj" : "#id_sc_field_bloq_evento_id" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_bloq_evento_id_obj',
      dropdownCssClass: 'css_bloq_evento_id_obj',
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
  $('#select2-id_sc_field_bloq_evento_id' + seqRow + '-container').addClass('css_bloq_evento_id_obj');
} // scJQSelect2Add

function scJQSelect2Add_bloq_cia_aerea(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_bloq_cia_aerea_obj" : "#id_sc_field_bloq_cia_aerea" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_bloq_cia_aerea_obj',
      dropdownCssClass: 'css_bloq_cia_aerea_obj',
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
  $('#select2-id_sc_field_bloq_cia_aerea' + seqRow + '-container').addClass('css_bloq_cia_aerea_obj');
} // scJQSelect2Add

function scJQSelect2Add_bloq_origem(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_bloq_origem_obj" : "#id_sc_field_bloq_origem" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_bloq_origem_obj',
      dropdownCssClass: 'css_bloq_origem_obj',
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
  $('#select2-id_sc_field_bloq_origem' + seqRow + '-container').addClass('css_bloq_origem_obj');
} // scJQSelect2Add

function scJQSelect2Add_bloq_destino(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_bloq_destino_obj" : "#id_sc_field_bloq_destino" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_bloq_destino_obj',
      dropdownCssClass: 'css_bloq_destino_obj',
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
  $('#select2-id_sc_field_bloq_destino' + seqRow + '-container').addClass('css_bloq_destino_obj');
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_bloq_evento_id) { displayChange_field_bloq_evento_id(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_bloq_cia_aerea) { displayChange_field_bloq_cia_aerea(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_bloq_origem) { displayChange_field_bloq_origem(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_bloq_destino) { displayChange_field_bloq_destino(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
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

