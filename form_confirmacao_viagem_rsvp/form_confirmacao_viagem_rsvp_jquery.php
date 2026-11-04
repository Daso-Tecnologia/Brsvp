
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
  scEventControl_data["id_voucher" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["criado_em" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enviado_em" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cod_evento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nome_evento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cod_participante" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nome_participante" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_participante" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["email_destinatario" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["status" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cpf_del" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sql_log" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["id_voucher" + iSeqRow] && scEventControl_data["id_voucher" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_voucher" + iSeqRow] && scEventControl_data["id_voucher" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["criado_em" + iSeqRow] && scEventControl_data["criado_em" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["criado_em" + iSeqRow] && scEventControl_data["criado_em" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enviado_em" + iSeqRow] && scEventControl_data["enviado_em" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enviado_em" + iSeqRow] && scEventControl_data["enviado_em" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cod_evento" + iSeqRow] && scEventControl_data["cod_evento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cod_evento" + iSeqRow] && scEventControl_data["cod_evento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nome_evento" + iSeqRow] && scEventControl_data["nome_evento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome_evento" + iSeqRow] && scEventControl_data["nome_evento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cod_participante" + iSeqRow] && scEventControl_data["cod_participante" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cod_participante" + iSeqRow] && scEventControl_data["cod_participante" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nome_participante" + iSeqRow] && scEventControl_data["nome_participante" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome_participante" + iSeqRow] && scEventControl_data["nome_participante" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_participante" + iSeqRow] && scEventControl_data["tipo_participante" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_participante" + iSeqRow] && scEventControl_data["tipo_participante" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["email_destinatario" + iSeqRow] && scEventControl_data["email_destinatario" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["email_destinatario" + iSeqRow] && scEventControl_data["email_destinatario" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["status" + iSeqRow] && scEventControl_data["status" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["status" + iSeqRow] && scEventControl_data["status" + iSeqRow]["change"]) {
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
  $('#id_sc_field_id_voucher' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_id_voucher_onblur('#id_sc_field_id_voucher' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_confirmacao_viagem_rsvp_id_voucher_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_id_voucher_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_enviar' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_enviar_onchange(this, iSeqRow, event) });
  $('#id_sc_field_criado_em' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_criado_em_onblur('#id_sc_field_criado_em' + iSeqRow, iSeqRow, event) })
                                       .bind('change', function() { sc_form_confirmacao_viagem_rsvp_criado_em_onchange(this, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_criado_em_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_criado_em_hora' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_criado_em_hora_onblur('#id_sc_field_criado_em' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_confirmacao_viagem_rsvp_criado_em_hora_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_criado_em_hora_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_enviado_em' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_enviado_em_onblur('#id_sc_field_enviado_em' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_confirmacao_viagem_rsvp_enviado_em_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_enviado_em_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_enviado_em_hora' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_enviado_em_hora_onblur('#id_sc_field_enviado_em' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_confirmacao_viagem_rsvp_enviado_em_hora_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_enviado_em_hora_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cod_evento' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_cod_evento_onblur('#id_sc_field_cod_evento' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_confirmacao_viagem_rsvp_cod_evento_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_cod_evento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome_evento' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_nome_evento_onblur('#id_sc_field_nome_evento' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_confirmacao_viagem_rsvp_nome_evento_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_nome_evento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cod_usuario' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_cod_usuario_onchange(this, iSeqRow, event) });
  $('#id_sc_field_nome_usuario' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_nome_usuario_onchange(this, iSeqRow, event) });
  $('#id_sc_field_cod_participante' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_cod_participante_onblur('#id_sc_field_cod_participante' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_confirmacao_viagem_rsvp_cod_participante_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_cod_participante_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome_participante' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_nome_participante_onblur('#id_sc_field_nome_participante' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_confirmacao_viagem_rsvp_nome_participante_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_nome_participante_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tipo_participante' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_tipo_participante_onblur('#id_sc_field_tipo_participante' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_confirmacao_viagem_rsvp_tipo_participante_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_tipo_participante_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_email_remetente' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_email_remetente_onchange(this, iSeqRow, event) });
  $('#id_sc_field_email_smtp' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_email_smtp_onchange(this, iSeqRow, event) });
  $('#id_sc_field_email_usuario' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_email_usuario_onchange(this, iSeqRow, event) });
  $('#id_sc_field_email_senha' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_email_senha_onchange(this, iSeqRow, event) });
  $('#id_sc_field_email_destinatario' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_email_destinatario_onblur('#id_sc_field_email_destinatario' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_confirmacao_viagem_rsvp_email_destinatario_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_email_destinatario_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_email_mensagem' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_email_mensagem_onchange(this, iSeqRow, event) });
  $('#id_sc_field_simples_mensagem' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_simples_mensagem_onchange(this, iSeqRow, event) });
  $('#id_sc_field_email_assunto' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_email_assunto_onchange(this, iSeqRow, event) });
  $('#id_sc_field_email_comcopia' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_email_comcopia_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_obs' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_obs_onchange(this, iSeqRow, event) });
  $('#id_sc_field_logo_bvt' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_logo_bvt_onchange(this, iSeqRow, event) });
  $('#id_sc_field_logo_cliente' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_logo_cliente_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_origem_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_origem_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chega_destino_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chega_destino_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_numvoo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_numvoo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_comprado_bvt_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_assento_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_assento_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_conexao_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_conexao_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_titulo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_titulo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_tiulo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chegada_titulo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_titulo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_titulo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_titulo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_com_bvt_titulo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_logo_ida_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_ida_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_origem_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_origem_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chega_destino_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chega_destino_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_numvoo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_numvoo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_comprado_bvt_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_assento_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_assento_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_conexao_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_conexao_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_titulo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_titulo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_tiulo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chegada_titulo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_titulo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_titulo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_titulo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_com_bvt_titulo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_logo_ida_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_ida_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_origem_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_origem_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chega_destino_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chega_destino_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_numvoo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_numvoo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_comprado_bvt_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_assento_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_assento_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_conexao_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_conexao_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_titulo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_titulo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_tiulo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chegada_titulo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_titulo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_titulo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_titulo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_com_bvt_titulo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_logo_ida_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_ida_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_origem_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_origem_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chega_destino_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chega_destino_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_numvoo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_numvoo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_comprado_bvt_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_assento_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_assento_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_conexao_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_conexao_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_titulo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_titulo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_tiulo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chegada_titulo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_titulo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_titulo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_titulo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_com_bvt_titulo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_logo_ida_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_ida_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_origem_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_origem_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chega_destino_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chega_destino_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_numvoo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_numvoo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_comprado_bvt_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_assento_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_assento_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_conexao_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_conexao_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_titulo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_titulo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_tiulo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chegada_titulo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_titulo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_titulo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_titulo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_com_bvt_titulo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_logo_volta_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_volta_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_origem_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_origem_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chega_destino_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chega_destino_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_numvoo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_numvoo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_comprado_bvt_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_assento_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_assento_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_conexao_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_conexao_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_titulo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_titulo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_tiulo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chegada_titulo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_titulo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_titulo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_titulo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_com_bvt_titulo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_logo_volta_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_volta_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_origem_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_origem_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chega_destino_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chega_destino_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_numvoo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_numvoo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_comprado_bvt_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_assento_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_assento_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_conexao_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_conexao_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_titulo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_titulo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_tiulo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chegada_titulo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_titulo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_titulo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_titulo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_com_bvt_titulo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_logo_volta_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_volta_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_origem_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_origem_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chega_destino_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chega_destino_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_numvoo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_numvoo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_comprado_bvt_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_assento_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_assento_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_conexao_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_conexao_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_origem_titulo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_saida_titulo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_destino_tiulo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_chegada_titulo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_cia_titulo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_localizador_titulo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_etkt_titulo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_com_bvt_titulo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_titulo_logo_volta_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_volta_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_observacoes_ida' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_observacoes_ida_onchange(this, iSeqRow, event) });
  $('#id_sc_field_voo_observacoes_volta' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_voo_observacoes_volta_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_titulo' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_titulo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_fantasia_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_fantasia_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_logradouro_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_logradouro_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_numero_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_numero_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_complemento_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_complemento_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_municipio_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_municipio_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_uf_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_uf_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_cep_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_cep_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_pais_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_pais_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_acomodacao_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_categoria_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_categoria_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkin_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkin_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_ckeckin_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckin_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkout_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkout_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_ckeckout_hotel_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckout_hotel_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_acomodacao_titulo_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_titulo_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_categoria_titulo_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_categoria_titulo_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkin_tiulo_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkin_tiulo_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkout_titulo_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkout_titulo_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_fantasia_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_fantasia_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_logradouro_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_logradouro_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_numero_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_numero_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_complemento_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_complemento_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_municipio_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_municipio_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_uf_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_uf_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_cep_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_cep_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_pais_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_pais_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_acomodacao_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_categoria_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_categoria_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkin_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkin_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_ckeckin_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckin_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkout_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkout_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_ckeckout_hotel_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckout_hotel_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_acomodacao_titulo_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_titulo_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_categoria_titulo_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_categoria_titulo_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkin_tiulo_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkin_tiulo_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkout_titulo_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkout_titulo_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_fantasia_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_fantasia_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_logradouro_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_logradouro_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_numero_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_numero_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_complemento_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_complemento_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_municipio_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_municipio_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_uf_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_uf_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_cep_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_cep_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_pais_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_pais_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_acomodacao_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_categoria_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_categoria_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkin_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkin_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_ckeckin_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckin_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkout_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkout_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_ckeckout_hotel_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckout_hotel_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_acomodacao_titulo_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_titulo_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_categoria_titulo_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_categoria_titulo_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkin_tiulo_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkin_tiulo_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkout_titulo_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkout_titulo_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_fantasia_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_fantasia_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_logradouro_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_logradouro_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_numero_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_numero_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_complemento_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_complemento_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_municipio_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_municipio_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_uf_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_uf_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_cep_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_cep_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_pais_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_pais_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_acomodacao_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_categoria_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_categoria_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkin_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkin_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_ckeckin_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckin_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkout_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkout_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_ckeckout_hotel_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckout_hotel_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_acomodacao_titulo_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_titulo_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_categoria_titulo_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_categoria_titulo_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkin_tiulo_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkin_tiulo_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_checkout_titulo_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_checkout_titulo_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_hosp_observacoes' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_hosp_observacoes_onchange(this, iSeqRow, event) });
  $('#id_sc_field_transfer_titulo' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_transfer_titulo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_transfer_in_observacoes' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_transfer_in_observacoes_onchange(this, iSeqRow, event) });
  $('#id_sc_field_transfer_out_observacoes' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_transfer_out_observacoes_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhantes_titulo' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhantes_titulo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_011' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_011_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_021' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_021_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_031' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_031_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_041' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_041_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_011' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_011_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_021' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_021_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_031' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_031_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_041' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_041_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_012' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_012_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_022' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_022_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_032' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_032_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_042' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_042_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_012' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_012_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_022' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_022_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_032' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_032_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_042' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_042_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_013' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_013_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_023' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_023_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_033' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_033_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_043' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_043_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_013' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_013_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_023' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_023_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_033' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_033_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_043' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_043_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_014' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_014_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_024' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_024_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_034' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_034_onchange(this, iSeqRow, event) });
  $('#id_sc_field_acompanhante_044' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_acompanhante_044_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_014' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_014_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_024' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_024_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_034' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_034_onchange(this, iSeqRow, event) });
  $('#id_sc_field_participante_acomp_044' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_participante_acomp_044_onchange(this, iSeqRow, event) });
  $('#id_sc_field_opcionais_titulo' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_opcionais_titulo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_opcional_01' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_opcional_01_onchange(this, iSeqRow, event) });
  $('#id_sc_field_opcional_02' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_opcional_02_onchange(this, iSeqRow, event) });
  $('#id_sc_field_opcional_03' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_opcional_03_onchange(this, iSeqRow, event) });
  $('#id_sc_field_opcional_04' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_opcional_04_onchange(this, iSeqRow, event) });
  $('#id_sc_field_opcional_05' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_opcional_05_onchange(this, iSeqRow, event) });
  $('#id_sc_field_opcional_06' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_opcional_06_onchange(this, iSeqRow, event) });
  $('#id_sc_field_observacoes_finais_titulo' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_observacoes_finais_titulo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_observacao_final' + iSeqRow).bind('change', function() { sc_form_confirmacao_viagem_rsvp_observacao_final_onchange(this, iSeqRow, event) });
  $('#id_sc_field_status' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_status_onblur('#id_sc_field_status' + iSeqRow, iSeqRow, event) })
                                    .bind('change', function() { sc_form_confirmacao_viagem_rsvp_status_onchange(this, iSeqRow, event) })
                                    .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_status_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cpf_del' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_cpf_del_onblur('#id_sc_field_cpf_del' + iSeqRow, iSeqRow, event) })
                                     .bind('change', function() { sc_form_confirmacao_viagem_rsvp_cpf_del_onchange(this, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_cpf_del_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_sql_log' + iSeqRow).bind('blur', function() { sc_form_confirmacao_viagem_rsvp_sql_log_onblur('#id_sc_field_sql_log' + iSeqRow, iSeqRow, event) })
                                     .bind('change', function() { sc_form_confirmacao_viagem_rsvp_sql_log_onchange(this, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_confirmacao_viagem_rsvp_sql_log_onfocus(this, iSeqRow, event) });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_confirmacao_viagem_rsvp_id_voucher_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_id_voucher();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_id_voucher_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_id_voucher_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_enviar_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_criado_em_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_criado_em();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_criado_em_hora_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_criado_em();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_criado_em_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_criado_em_hora_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_criado_em_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_criado_em_hora_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_enviado_em_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_enviado_em();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_enviado_em_hora_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_enviado_em();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_enviado_em_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_enviado_em_hora_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_enviado_em_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_enviado_em_hora_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_cod_evento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_cod_evento();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_cod_evento_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_cod_evento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_nome_evento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_nome_evento();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_nome_evento_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_nome_evento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_cod_usuario_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_nome_usuario_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_cod_participante_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_cod_participante();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_cod_participante_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_cod_participante_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_nome_participante_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_nome_participante();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_nome_participante_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_nome_participante_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_tipo_participante_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_tipo_participante();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_tipo_participante_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_tipo_participante_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_email_remetente_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_email_smtp_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_email_usuario_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_email_senha_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_email_destinatario_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_email_destinatario();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_email_destinatario_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_email_destinatario_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_email_mensagem_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_simples_mensagem_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_email_assunto_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_email_comcopia_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_obs_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_logo_bvt_onchange(oThis, iSeqRow, event) {
  File_Event = event.target;
  File_Arr   = File_Event.files;
  if (File_Arr.length > 0) {
      File_Name = File_Arr[0].name;
      if (File_Name.indexOf('*') != -1) {
          scJs_alert (File_Name + ' <?php echo $this->Ini->Nm_lang['lang_errm_ivch'] ?>', function() {}, {type: "error"});
          document.getElementById('id_sc_field_logo_bvt' + iSeqRow).value = '';
          Upload_Cancel = true;
          return;
      }
  }
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_logo_cliente_onchange(oThis, iSeqRow, event) {
  File_Event = event.target;
  File_Arr   = File_Event.files;
  if (File_Arr.length > 0) {
      File_Name = File_Arr[0].name;
      if (File_Name.indexOf('*') != -1) {
          scJs_alert (File_Name + ' <?php echo $this->Ini->Nm_lang['lang_errm_ivch'] ?>', function() {}, {type: "error"});
          document.getElementById('id_sc_field_logo_cliente' + iSeqRow).value = '';
          Upload_Cancel = true;
          return;
      }
  }
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_origem_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chega_destino_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_numvoo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_assento_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_conexao_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_ida_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_origem_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chega_destino_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_numvoo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_assento_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_conexao_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_ida_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_origem_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chega_destino_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_numvoo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_assento_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_conexao_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_ida_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_origem_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chega_destino_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_numvoo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_assento_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_conexao_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_ida_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_origem_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chega_destino_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_numvoo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_assento_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_conexao_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_volta_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_origem_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chega_destino_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_numvoo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_assento_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_conexao_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_volta_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_origem_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chega_destino_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_numvoo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_assento_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_conexao_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_volta_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_origem_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chega_destino_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_numvoo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_comprado_bvt_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_assento_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_conexao_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_origem_titulo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_saida_titulo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_destino_tiulo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_chegada_titulo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_cia_titulo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_localizador_titulo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_etkt_titulo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_com_bvt_titulo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_titulo_logo_volta_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_observacoes_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_voo_observacoes_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_titulo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_fantasia_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_logradouro_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_numero_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_complemento_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_municipio_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_uf_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_cep_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_pais_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_categoria_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkin_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckin_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkout_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckout_hotel_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_titulo_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_categoria_titulo_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkin_tiulo_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkout_titulo_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_fantasia_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_logradouro_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_numero_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_complemento_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_municipio_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_uf_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_cep_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_pais_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_categoria_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkin_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckin_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkout_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckout_hotel_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_titulo_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_categoria_titulo_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkin_tiulo_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkout_titulo_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_fantasia_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_logradouro_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_numero_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_complemento_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_municipio_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_uf_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_cep_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_pais_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_categoria_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkin_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckin_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkout_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckout_hotel_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_titulo_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_categoria_titulo_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkin_tiulo_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkout_titulo_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_fantasia_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_logradouro_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_numero_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_complemento_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_municipio_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_uf_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_cep_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_pais_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_categoria_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkin_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckin_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkout_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_hr_ckeckout_hotel_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_acomodacao_titulo_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_categoria_titulo_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkin_tiulo_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_checkout_titulo_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_hosp_observacoes_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_transfer_titulo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_transfer_in_observacoes_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_transfer_out_observacoes_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhantes_titulo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_011_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_021_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_031_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_041_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_011_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_021_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_031_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_041_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_012_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_022_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_032_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_042_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_012_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_022_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_032_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_042_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_013_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_023_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_033_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_043_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_013_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_023_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_033_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_043_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_014_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_024_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_034_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_acompanhante_044_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_014_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_024_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_034_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_participante_acomp_044_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_opcionais_titulo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_opcional_01_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_opcional_02_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_opcional_03_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_opcional_04_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_opcional_05_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_opcional_06_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_observacoes_finais_titulo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_observacao_final_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_status_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_status();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_status_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_status_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_cpf_del_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_cpf_del();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_cpf_del_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_cpf_del_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_confirmacao_viagem_rsvp_sql_log_onblur(oThis, iSeqRow, event) {
  do_ajax_form_confirmacao_viagem_rsvp_validate_sql_log();
  scCssBlur(oThis);
}

function sc_form_confirmacao_viagem_rsvp_sql_log_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_confirmacao_viagem_rsvp_sql_log_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("id_voucher", "", status);
        displayChange_field("criado_em", "", status);
        displayChange_field("enviado_em", "", status);
        displayChange_field("cod_evento", "", status);
        displayChange_field("nome_evento", "", status);
        displayChange_field("cod_participante", "", status);
        displayChange_field("nome_participante", "", status);
        displayChange_field("tipo_participante", "", status);
        displayChange_field("email_destinatario", "", status);
        displayChange_field("status", "", status);
        displayChange_field("cpf_del", "", status);
        displayChange_field("sql_log", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_id_voucher(row, status);
        displayChange_field_criado_em(row, status);
        displayChange_field_enviado_em(row, status);
        displayChange_field_cod_evento(row, status);
        displayChange_field_nome_evento(row, status);
        displayChange_field_cod_participante(row, status);
        displayChange_field_nome_participante(row, status);
        displayChange_field_tipo_participante(row, status);
        displayChange_field_email_destinatario(row, status);
        displayChange_field_status(row, status);
        displayChange_field_cpf_del(row, status);
        displayChange_field_sql_log(row, status);
}

function displayChange_field(field, row, status) {
        if ("id_voucher" == field) {
                displayChange_field_id_voucher(row, status);
        }
        if ("criado_em" == field) {
                displayChange_field_criado_em(row, status);
        }
        if ("enviado_em" == field) {
                displayChange_field_enviado_em(row, status);
        }
        if ("cod_evento" == field) {
                displayChange_field_cod_evento(row, status);
        }
        if ("nome_evento" == field) {
                displayChange_field_nome_evento(row, status);
        }
        if ("cod_participante" == field) {
                displayChange_field_cod_participante(row, status);
        }
        if ("nome_participante" == field) {
                displayChange_field_nome_participante(row, status);
        }
        if ("tipo_participante" == field) {
                displayChange_field_tipo_participante(row, status);
        }
        if ("email_destinatario" == field) {
                displayChange_field_email_destinatario(row, status);
        }
        if ("status" == field) {
                displayChange_field_status(row, status);
        }
        if ("cpf_del" == field) {
                displayChange_field_cpf_del(row, status);
        }
        if ("sql_log" == field) {
                displayChange_field_sql_log(row, status);
        }
}

function displayChange_field_id_voucher(row, status) {
    var fieldId;
}

function displayChange_field_criado_em(row, status) {
    var fieldId;
}

function displayChange_field_enviado_em(row, status) {
    var fieldId;
}

function displayChange_field_cod_evento(row, status) {
    var fieldId;
}

function displayChange_field_nome_evento(row, status) {
    var fieldId;
}

function displayChange_field_cod_participante(row, status) {
    var fieldId;
}

function displayChange_field_nome_participante(row, status) {
    var fieldId;
}

function displayChange_field_tipo_participante(row, status) {
    var fieldId;
}

function displayChange_field_email_destinatario(row, status) {
    var fieldId;
}

function displayChange_field_status(row, status) {
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
        $("#id_form_confirmacao_viagem_rsvp_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(39);
                }
        }
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_criado_em" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_criado_em" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_criado_em" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['criado_em']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['criado_em']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_confirmacao_viagem_rsvp_validate_criado_em(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['criado_em']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_enviado_em" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_enviado_em" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_enviado_em" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['enviado_em']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['enviado_em']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_confirmacao_viagem_rsvp_validate_enviado_em(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['enviado_em']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_logo_bvt" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_confirmacao_viagem_rsvp_ul_save.php",
    dropZone: $("#hidden_field_data_logo_bvt" + iSeqRow),
    formData: function() {
      return [
        {name: 'param_field', value: 'logo_bvt'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_logo_bvt" + iSeqRow);
        loaderContent = $("#id_img_loader_logo_bvt" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_logo_bvt" + iSeqRow);
        loader.show();
      }
    },
    done: function(e, data) {
      var fileData, respData, respPos, respMsg, thumbDisplay, checkDisplay, var_ajax_img_thumb, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_logo_bvt" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_logo_bvt" + iSeqRow).hide();
      }
      if (Upload_Cancel) {
          Upload_Cancel = false;
          return;
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = "";
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("minFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      if (fileData[0].name.indexOf('*') != -1) {
          scJs_alert (fileData[0].name + ' <?php echo $this->Ini->Nm_lang['lang_errm_ivch'] ?>', function() {}, {type: "error"});
          return;
      }
      $("#id_sc_field_logo_bvt" + iSeqRow).val("");
      $("#id_sc_field_logo_bvt_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_logo_bvt_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_logo_bvt = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_image_source;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_logo_bvt) ? "none" : "";
      $("#id_ajax_img_logo_bvt" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_logo_bvt" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_logo_bvt) {
        document.F1.temp_out_logo_bvt.value = var_ajax_img_thumb;
        document.F1.temp_out1_logo_bvt.value = var_ajax_img_logo_bvt;
      }
      else if (document.F1.temp_out_logo_bvt) {
        document.F1.temp_out_logo_bvt.value = var_ajax_img_logo_bvt;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_logo_bvt" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_logo_bvt" + iSeqRow).html(fileData[0].name);
      $("#txt_ajax_img_logo_bvt" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_logo_bvt" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
      scMarkFormAsChanged();
    }
  });

  $("#id_sc_field_logo_cliente" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_confirmacao_viagem_rsvp_ul_save.php",
    dropZone: $("#hidden_field_data_logo_cliente" + iSeqRow),
    formData: function() {
      return [
        {name: 'param_field', value: 'logo_cliente'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_logo_cliente" + iSeqRow);
        loaderContent = $("#id_img_loader_logo_cliente" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_logo_cliente" + iSeqRow);
        loader.show();
      }
    },
    done: function(e, data) {
      var fileData, respData, respPos, respMsg, thumbDisplay, checkDisplay, var_ajax_img_thumb, oTemp;
      fileData = null;
      respMsg = "";
      if (data && data.result && data.result[0] && data.result[0].body) {
        respData = data.result[0].body.innerText;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = $.parseJSON(respData);
        }
        else {
          respMsg = respData;
        }
      }
      else {
        respData = data.result;
        respPos = respData.indexOf("[{");
        if (-1 !== respPos) {
          respMsg = respData.substr(0, respPos);
          respData = respData.substr(respPos);
          fileData = eval(respData);
        }
        else {
          respMsg = respData;
        }
      }
      if (window.FormData !== undefined)
      {
        $("#id_img_loader_logo_cliente" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_logo_cliente" + iSeqRow).hide();
      }
      if (Upload_Cancel) {
          Upload_Cancel = false;
          return;
      }
      if (null == fileData) {
        if ("" != respMsg) {
          oTemp = {"htmOutput" : "<?php echo $this->Ini->Nm_lang['lang_errm_upld_admn']; ?>"};
          scAjaxShowDebug(oTemp);
        }
        return;
      }
      if (fileData[0].error && "" != fileData[0].error) {
        var uploadErrorMessage = "";
        oResp = {};
        if ("acceptFileTypes" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_invl']) ?>";
        }
        else if ("maxFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("minFileSize" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_size']) ?>";
        }
        else if ("emptyFile" == fileData[0].error) {
          uploadErrorMessage = "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_errm_file_empty']) ?>";
        }
        scAjaxShowErrorDisplay("table", uploadErrorMessage);
        return;
      }
      if (fileData[0].name.indexOf('*') != -1) {
          scJs_alert (fileData[0].name + ' <?php echo $this->Ini->Nm_lang['lang_errm_ivch'] ?>', function() {}, {type: "error"});
          return;
      }
      $("#id_sc_field_logo_cliente" + iSeqRow).val("");
      $("#id_sc_field_logo_cliente_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_logo_cliente_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_logo_cliente = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_image_source;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_logo_cliente) ? "none" : "";
      $("#id_ajax_img_logo_cliente" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_logo_cliente" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_logo_cliente) {
        document.F1.temp_out_logo_cliente.value = var_ajax_img_thumb;
        document.F1.temp_out1_logo_cliente.value = var_ajax_img_logo_cliente;
      }
      else if (document.F1.temp_out_logo_cliente) {
        document.F1.temp_out_logo_cliente.value = var_ajax_img_logo_cliente;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_logo_cliente" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_logo_cliente" + iSeqRow).html(fileData[0].name);
      $("#txt_ajax_img_logo_cliente" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_logo_cliente" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
      scMarkFormAsChanged();
    }
  });

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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_confirmacao_viagem_rsvp')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_confirmacao_viagem_rsvp');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_confirmacao_viagem_rsvp');
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

