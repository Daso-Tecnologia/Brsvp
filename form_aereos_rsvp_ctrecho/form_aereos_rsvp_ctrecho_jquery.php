
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
  scEventControl_data["id_aereo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_id_evento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_copy" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["acomp_copy" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cpf_del" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sql_log" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_aereo" + iSeqRow] && scEventControl_data["id_aereo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_aereo" + iSeqRow] && scEventControl_data["id_aereo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_id_evento" + iSeqRow] && scEventControl_data["aereo_id_evento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_id_evento" + iSeqRow] && scEventControl_data["aereo_id_evento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_copy" + iSeqRow] && scEventControl_data["part_copy" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_copy" + iSeqRow] && scEventControl_data["part_copy" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["acomp_copy" + iSeqRow] && scEventControl_data["acomp_copy" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["acomp_copy" + iSeqRow] && scEventControl_data["acomp_copy" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cpf_del" + iSeqRow] && scEventControl_data["cpf_del" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cpf_del" + iSeqRow] && scEventControl_data["cpf_del" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["sql_log" + iSeqRow] && scEventControl_data["sql_log" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["sql_log" + iSeqRow] && scEventControl_data["sql_log" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("part_copy" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("acomp_copy" + iSeq == fieldName) {
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
  $('#id_sc_field_id_aereo' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_ctrecho_id_aereo_onblur('#id_sc_field_id_aereo' + iSeqRow, iSeqRow, event) })
                                      .bind('change', function() { sc_form_aereos_rsvp_ctrecho_id_aereo_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_aereos_rsvp_ctrecho_id_aereo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_id_evento' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_ctrecho_aereo_id_evento_onblur('#id_sc_field_aereo_id_evento' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_id_evento_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_aereos_rsvp_ctrecho_aereo_id_evento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_id_usuario' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_id_usuario_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_cpf_particip' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_cpf_particip_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_tipo_pessoa' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_tipo_pessoa_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_status' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_status_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_direcao' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_direcao_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_cia_aerea' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_cia_aerea_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_num_voo' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_num_voo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_origem' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_origem_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_destino' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_destino_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dt_saida' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_dt_saida_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_hr_saida' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_hr_saida_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dthr_saida' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_dthr_saida_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dthr_saida_hora' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_dthr_saida_hora_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dt_chegada' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_dt_chegada_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_hr_chegada' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_hr_chegada_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dthr_chegada' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_dthr_chegada_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dthr_chegada_hora' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_dthr_chegada_hora_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_localizador' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_localizador_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_eticket' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_eticket_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_emitida_bvt' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_emitida_bvt_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_valor' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_valor_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_bloqueio_id' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_bloqueio_id_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_modificado_em' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_modificado_em_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_modificado_em_hora' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_modificado_em_hora_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_flag_subtraido' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_flag_subtraido_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_trecho' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_trecho_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_ativo' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_ativo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_id_origem_gate' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_id_origem_gate_onchange(this, iSeqRow, event) });
  $('#id_sc_field_nome_pax_gate' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_nome_pax_gate_onchange(this, iSeqRow, event) });
  $('#id_sc_field_nota_gate' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_nota_gate_onchange(this, iSeqRow, event) });
  $('#id_sc_field_data_nota_gate' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_data_nota_gate_onchange(this, iSeqRow, event) });
  $('#id_sc_field_fil_agt_gate' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_fil_agt_gate_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_cia_aerea_gate' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_cia_aerea_gate_onchange(this, iSeqRow, event) });
  $('#id_sc_field_aereo_transfer_tipo' + iSeqRow).bind('change', function() { sc_form_aereos_rsvp_ctrecho_aereo_transfer_tipo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_cpf_del' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_ctrecho_cpf_del_onblur('#id_sc_field_cpf_del' + iSeqRow, iSeqRow, event) })
                                     .bind('change', function() { sc_form_aereos_rsvp_ctrecho_cpf_del_onchange(this, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_aereos_rsvp_ctrecho_cpf_del_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_sql_log' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_ctrecho_sql_log_onblur('#id_sc_field_sql_log' + iSeqRow, iSeqRow, event) })
                                     .bind('change', function() { sc_form_aereos_rsvp_ctrecho_sql_log_onchange(this, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_aereos_rsvp_ctrecho_sql_log_onfocus(this, iSeqRow, event) });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_aereos_rsvp_ctrecho_id_aereo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_ctrecho_validate_id_aereo();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_ctrecho_id_aereo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_id_aereo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_ctrecho_aereo_id_evento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_ctrecho_validate_aereo_id_evento();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_ctrecho_aereo_id_evento_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_id_evento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_ctrecho_aereo_id_usuario_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_cpf_particip_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_tipo_pessoa_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_status_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_direcao_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_cia_aerea_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_num_voo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_origem_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_destino_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_dt_saida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_hr_saida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_dthr_saida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_dthr_saida_hora_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_dt_chegada_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_hr_chegada_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_dthr_chegada_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_dthr_chegada_hora_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_localizador_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_eticket_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_emitida_bvt_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_valor_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_bloqueio_id_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_modificado_em_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_modificado_em_hora_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_flag_subtraido_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_trecho_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_ativo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_id_origem_gate_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_nome_pax_gate_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_nota_gate_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_data_nota_gate_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_fil_agt_gate_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_cia_aerea_gate_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_aereo_transfer_tipo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_part_copy_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_ctrecho_validate_part_copy();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_ctrecho_part_copy_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_aereos_rsvp_ctrecho_event_part_copy_onchange();
}

function sc_form_aereos_rsvp_ctrecho_part_copy_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_ctrecho_acomp_copy_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_ctrecho_validate_acomp_copy();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_ctrecho_acomp_copy_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_aereos_rsvp_ctrecho_event_acomp_copy_onchange();
}

function sc_form_aereos_rsvp_ctrecho_acomp_copy_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_ctrecho_cpf_del_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_ctrecho_validate_cpf_del();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_ctrecho_cpf_del_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_cpf_del_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_ctrecho_sql_log_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_ctrecho_validate_sql_log();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_ctrecho_sql_log_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_aereos_rsvp_ctrecho_sql_log_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("id_aereo", "", status);
        displayChange_field("aereo_id_evento", "", status);
        displayChange_field("part_copy", "", status);
        displayChange_field("acomp_copy", "", status);
        displayChange_field("cpf_del", "", status);
        displayChange_field("sql_log", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_id_aereo(row, status);
        displayChange_field_aereo_id_evento(row, status);
        displayChange_field_part_copy(row, status);
        displayChange_field_acomp_copy(row, status);
        displayChange_field_cpf_del(row, status);
        displayChange_field_sql_log(row, status);
}

function displayChange_field(field, row, status) {
        if ("id_aereo" == field) {
                displayChange_field_id_aereo(row, status);
        }
        if ("aereo_id_evento" == field) {
                displayChange_field_aereo_id_evento(row, status);
        }
        if ("part_copy" == field) {
                displayChange_field_part_copy(row, status);
        }
        if ("acomp_copy" == field) {
                displayChange_field_acomp_copy(row, status);
        }
        if ("cpf_del" == field) {
                displayChange_field_cpf_del(row, status);
        }
        if ("sql_log" == field) {
                displayChange_field_sql_log(row, status);
        }
}

function displayChange_field_id_aereo(row, status) {
    var fieldId;
}

function displayChange_field_aereo_id_evento(row, status) {
    var fieldId;
}

function displayChange_field_part_copy(row, status) {
    var fieldId;
}

function displayChange_field_acomp_copy(row, status) {
    var fieldId;
}

function displayChange_field_cpf_del(row, status) {
    var fieldId;
}

function displayChange_field_sql_log(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_aereos_rsvp_ctrecho_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(35);
                }
        }
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_aereo_dt_saida" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_aereo_dt_saida" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_aereo_dt_saida" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_aereos_rsvp_ctrecho_validate_aereo_dt_saida(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['aereo_dt_saida']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_aereo_dthr_saida" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_aereo_dthr_saida" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_aereo_dthr_saida" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['aereo_dthr_saida']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['aereo_dthr_saida']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
    },
    onClose: function(dateText, inst) {
      do_ajax_form_aereos_rsvp_ctrecho_validate_aereo_dthr_saida(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['aereo_dthr_saida']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_aereo_dt_chegada" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_aereo_dt_chegada" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_aereo_dt_chegada" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_aereos_rsvp_ctrecho_validate_aereo_dt_chegada(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['aereo_dt_chegada']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_aereo_dthr_chegada" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_aereo_dthr_chegada" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_aereo_dthr_chegada" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['aereo_dthr_chegada']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['aereo_dthr_chegada']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
    },
    onClose: function(dateText, inst) {
      do_ajax_form_aereos_rsvp_ctrecho_validate_aereo_dthr_chegada(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['aereo_dthr_chegada']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_aereo_modificado_em" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_aereo_modificado_em" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_aereo_modificado_em" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['aereo_modificado_em']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['aereo_modificado_em']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
    },
    onClose: function(dateText, inst) {
      do_ajax_form_aereos_rsvp_ctrecho_validate_aereo_modificado_em(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['aereo_modificado_em']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_data_nota_gate" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_data_nota_gate" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_data_nota_gate" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_aereos_rsvp_ctrecho_validate_data_nota_gate(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['data_nota_gate']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_aereos_rsvp_ctrecho')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_aereos_rsvp_ctrecho');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_aereos_rsvp_ctrecho');
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
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
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

