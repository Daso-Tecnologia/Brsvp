
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
  scEventControl_data["tra_id_evento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_cpf_particip" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_id_usuario" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["atendente_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_tipo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_id_hotel" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_id_hotel_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_dsc_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enviar_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_status" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["ult_trecho" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_cia_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cia_ida_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_numvoo_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_origem_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["origem_ida_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_destino_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["destino_ida_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_dt_saida_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_hr_saida_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_dt_chegada_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_hr_chegada_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_localizador_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_eticket_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_flag_ida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_cia_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cia_volta_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_numvoo_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_origem_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["origem_volta_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_destino_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["destino_volta_dsc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_dt_saida_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_hr_saida_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_dt_chegada_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_hr_chegada_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_localizador_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_eticket_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_intervalo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_hrtransout" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_flag_volta" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_dt_chegada_proprio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_hr_chegada_proprio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_flag_proprio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_dt_ida_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_hr_ida_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_origem_ida_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_destino_ida_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_flag_ida_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_dt_volta_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_hr_volta_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_origem_volta_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_destino_volta_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_flag_volta_local" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_observacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_ativo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tra_dt_alteracao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cpf_del" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sql_log" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["titulo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["descricao_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["codigo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["status_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valido_de_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valido_ate_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["local_de_origem_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["latitude_origem_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["longitude_origem_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hr_saida_origem_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["local_destino_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["latitude_destino_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["longitude_destino_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["veiculo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["companhia_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nome_motorista_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["contato_motorista_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["matricula_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["duracao_percurso_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["comodidades_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["observacao_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["placa_veiculo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_evento_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_participante_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_voucher_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["titulo_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["descricao_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["codigo_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["status_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valido_de_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valido_ate_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["local_de_origem_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["latitude_origem_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["longitude_origem_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hr_saida_origem_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["local_de_destino_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["latitude_destino_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["longitude_destino_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["veiculo_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["companhia_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nome_motorista_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["contato_motorista_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["matricula_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["duracao_percurso_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["comodidades_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["observacao_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["placa_veiculo_api_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_evento_app_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_participante_app_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_voucher_app_out" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["tra_id_evento" + iSeqRow] && scEventControl_data["tra_id_evento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_id_evento" + iSeqRow] && scEventControl_data["tra_id_evento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_dsc" + iSeqRow] && scEventControl_data["evento_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_dsc" + iSeqRow] && scEventControl_data["evento_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_cpf_particip" + iSeqRow] && scEventControl_data["tra_cpf_particip" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_cpf_particip" + iSeqRow] && scEventControl_data["tra_cpf_particip" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_dsc" + iSeqRow] && scEventControl_data["tipo_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_dsc" + iSeqRow] && scEventControl_data["tipo_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_id_usuario" + iSeqRow] && scEventControl_data["tra_id_usuario" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_id_usuario" + iSeqRow] && scEventControl_data["tra_id_usuario" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["atendente_dsc" + iSeqRow] && scEventControl_data["atendente_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["atendente_dsc" + iSeqRow] && scEventControl_data["atendente_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_tipo" + iSeqRow] && scEventControl_data["tra_tipo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_tipo" + iSeqRow] && scEventControl_data["tra_tipo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_id_hotel" + iSeqRow] && scEventControl_data["tra_id_hotel" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_id_hotel" + iSeqRow] && scEventControl_data["tra_id_hotel" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_dsc" + iSeqRow] && scEventControl_data["hotel_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_dsc" + iSeqRow] && scEventControl_data["hotel_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_id_hotel_out" + iSeqRow] && scEventControl_data["tra_id_hotel_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_id_hotel_out" + iSeqRow] && scEventControl_data["tra_id_hotel_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_dsc_out" + iSeqRow] && scEventControl_data["hotel_dsc_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_dsc_out" + iSeqRow] && scEventControl_data["hotel_dsc_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enviar_app" + iSeqRow] && scEventControl_data["enviar_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enviar_app" + iSeqRow] && scEventControl_data["enviar_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_status" + iSeqRow] && scEventControl_data["tra_status" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_status" + iSeqRow] && scEventControl_data["tra_status" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["ult_trecho" + iSeqRow] && scEventControl_data["ult_trecho" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["ult_trecho" + iSeqRow] && scEventControl_data["ult_trecho" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_cia_ida" + iSeqRow] && scEventControl_data["tra_cia_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_cia_ida" + iSeqRow] && scEventControl_data["tra_cia_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cia_ida_dsc" + iSeqRow] && scEventControl_data["cia_ida_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cia_ida_dsc" + iSeqRow] && scEventControl_data["cia_ida_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_numvoo_ida" + iSeqRow] && scEventControl_data["tra_numvoo_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_numvoo_ida" + iSeqRow] && scEventControl_data["tra_numvoo_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_origem_ida" + iSeqRow] && scEventControl_data["tra_origem_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_origem_ida" + iSeqRow] && scEventControl_data["tra_origem_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["origem_ida_dsc" + iSeqRow] && scEventControl_data["origem_ida_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["origem_ida_dsc" + iSeqRow] && scEventControl_data["origem_ida_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_destino_ida" + iSeqRow] && scEventControl_data["tra_destino_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_destino_ida" + iSeqRow] && scEventControl_data["tra_destino_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["destino_ida_dsc" + iSeqRow] && scEventControl_data["destino_ida_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["destino_ida_dsc" + iSeqRow] && scEventControl_data["destino_ida_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_saida_ida" + iSeqRow] && scEventControl_data["tra_dt_saida_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_saida_ida" + iSeqRow] && scEventControl_data["tra_dt_saida_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_saida_ida" + iSeqRow] && scEventControl_data["tra_hr_saida_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_saida_ida" + iSeqRow] && scEventControl_data["tra_hr_saida_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_chegada_ida" + iSeqRow] && scEventControl_data["tra_dt_chegada_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_chegada_ida" + iSeqRow] && scEventControl_data["tra_dt_chegada_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_chegada_ida" + iSeqRow] && scEventControl_data["tra_hr_chegada_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_chegada_ida" + iSeqRow] && scEventControl_data["tra_hr_chegada_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_localizador_ida" + iSeqRow] && scEventControl_data["tra_localizador_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_localizador_ida" + iSeqRow] && scEventControl_data["tra_localizador_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_eticket_ida" + iSeqRow] && scEventControl_data["tra_eticket_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_eticket_ida" + iSeqRow] && scEventControl_data["tra_eticket_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_ida" + iSeqRow] && scEventControl_data["tra_flag_ida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_ida" + iSeqRow] && scEventControl_data["tra_flag_ida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_cia_volta" + iSeqRow] && scEventControl_data["tra_cia_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_cia_volta" + iSeqRow] && scEventControl_data["tra_cia_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cia_volta_dsc" + iSeqRow] && scEventControl_data["cia_volta_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cia_volta_dsc" + iSeqRow] && scEventControl_data["cia_volta_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_numvoo_volta" + iSeqRow] && scEventControl_data["tra_numvoo_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_numvoo_volta" + iSeqRow] && scEventControl_data["tra_numvoo_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_origem_volta" + iSeqRow] && scEventControl_data["tra_origem_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_origem_volta" + iSeqRow] && scEventControl_data["tra_origem_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["origem_volta_dsc" + iSeqRow] && scEventControl_data["origem_volta_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["origem_volta_dsc" + iSeqRow] && scEventControl_data["origem_volta_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_destino_volta" + iSeqRow] && scEventControl_data["tra_destino_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_destino_volta" + iSeqRow] && scEventControl_data["tra_destino_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["destino_volta_dsc" + iSeqRow] && scEventControl_data["destino_volta_dsc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["destino_volta_dsc" + iSeqRow] && scEventControl_data["destino_volta_dsc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_saida_volta" + iSeqRow] && scEventControl_data["tra_dt_saida_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_saida_volta" + iSeqRow] && scEventControl_data["tra_dt_saida_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_saida_volta" + iSeqRow] && scEventControl_data["tra_hr_saida_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_saida_volta" + iSeqRow] && scEventControl_data["tra_hr_saida_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_chegada_volta" + iSeqRow] && scEventControl_data["tra_dt_chegada_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_chegada_volta" + iSeqRow] && scEventControl_data["tra_dt_chegada_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_chegada_volta" + iSeqRow] && scEventControl_data["tra_hr_chegada_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_chegada_volta" + iSeqRow] && scEventControl_data["tra_hr_chegada_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_localizador_volta" + iSeqRow] && scEventControl_data["tra_localizador_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_localizador_volta" + iSeqRow] && scEventControl_data["tra_localizador_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_eticket_volta" + iSeqRow] && scEventControl_data["tra_eticket_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_eticket_volta" + iSeqRow] && scEventControl_data["tra_eticket_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_intervalo" + iSeqRow] && scEventControl_data["tra_intervalo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_intervalo" + iSeqRow] && scEventControl_data["tra_intervalo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_hrtransout" + iSeqRow] && scEventControl_data["tra_hrtransout" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_hrtransout" + iSeqRow] && scEventControl_data["tra_hrtransout" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_volta" + iSeqRow] && scEventControl_data["tra_flag_volta" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_volta" + iSeqRow] && scEventControl_data["tra_flag_volta" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_chegada_proprio" + iSeqRow] && scEventControl_data["tra_dt_chegada_proprio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_chegada_proprio" + iSeqRow] && scEventControl_data["tra_dt_chegada_proprio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_chegada_proprio" + iSeqRow] && scEventControl_data["tra_hr_chegada_proprio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_chegada_proprio" + iSeqRow] && scEventControl_data["tra_hr_chegada_proprio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_proprio" + iSeqRow] && scEventControl_data["tra_flag_proprio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_proprio" + iSeqRow] && scEventControl_data["tra_flag_proprio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_ida_local" + iSeqRow] && scEventControl_data["tra_dt_ida_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_ida_local" + iSeqRow] && scEventControl_data["tra_dt_ida_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_ida_local" + iSeqRow] && scEventControl_data["tra_hr_ida_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_ida_local" + iSeqRow] && scEventControl_data["tra_hr_ida_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_origem_ida_local" + iSeqRow] && scEventControl_data["tra_origem_ida_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_origem_ida_local" + iSeqRow] && scEventControl_data["tra_origem_ida_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_destino_ida_local" + iSeqRow] && scEventControl_data["tra_destino_ida_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_destino_ida_local" + iSeqRow] && scEventControl_data["tra_destino_ida_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_ida_local" + iSeqRow] && scEventControl_data["tra_flag_ida_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_ida_local" + iSeqRow] && scEventControl_data["tra_flag_ida_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_volta_local" + iSeqRow] && scEventControl_data["tra_dt_volta_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_volta_local" + iSeqRow] && scEventControl_data["tra_dt_volta_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_volta_local" + iSeqRow] && scEventControl_data["tra_hr_volta_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_hr_volta_local" + iSeqRow] && scEventControl_data["tra_hr_volta_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_origem_volta_local" + iSeqRow] && scEventControl_data["tra_origem_volta_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_origem_volta_local" + iSeqRow] && scEventControl_data["tra_origem_volta_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_destino_volta_local" + iSeqRow] && scEventControl_data["tra_destino_volta_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_destino_volta_local" + iSeqRow] && scEventControl_data["tra_destino_volta_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_volta_local" + iSeqRow] && scEventControl_data["tra_flag_volta_local" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_flag_volta_local" + iSeqRow] && scEventControl_data["tra_flag_volta_local" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_observacao" + iSeqRow] && scEventControl_data["tra_observacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_observacao" + iSeqRow] && scEventControl_data["tra_observacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_ativo" + iSeqRow] && scEventControl_data["tra_ativo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_ativo" + iSeqRow] && scEventControl_data["tra_ativo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_alteracao" + iSeqRow] && scEventControl_data["tra_dt_alteracao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tra_dt_alteracao" + iSeqRow] && scEventControl_data["tra_dt_alteracao" + iSeqRow]["change"]) {
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
  if (scEventControl_data["titulo_api" + iSeqRow] && scEventControl_data["titulo_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["titulo_api" + iSeqRow] && scEventControl_data["titulo_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["descricao_api" + iSeqRow] && scEventControl_data["descricao_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["descricao_api" + iSeqRow] && scEventControl_data["descricao_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["codigo_api" + iSeqRow] && scEventControl_data["codigo_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["codigo_api" + iSeqRow] && scEventControl_data["codigo_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_api" + iSeqRow] && scEventControl_data["tipo_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_api" + iSeqRow] && scEventControl_data["tipo_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["status_api" + iSeqRow] && scEventControl_data["status_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["status_api" + iSeqRow] && scEventControl_data["status_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["valido_de_api" + iSeqRow] && scEventControl_data["valido_de_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["valido_de_api" + iSeqRow] && scEventControl_data["valido_de_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["valido_ate_api" + iSeqRow] && scEventControl_data["valido_ate_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["valido_ate_api" + iSeqRow] && scEventControl_data["valido_ate_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["local_de_origem_api" + iSeqRow] && scEventControl_data["local_de_origem_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["local_de_origem_api" + iSeqRow] && scEventControl_data["local_de_origem_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["latitude_origem_api" + iSeqRow] && scEventControl_data["latitude_origem_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["latitude_origem_api" + iSeqRow] && scEventControl_data["latitude_origem_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["longitude_origem_api" + iSeqRow] && scEventControl_data["longitude_origem_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["longitude_origem_api" + iSeqRow] && scEventControl_data["longitude_origem_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hr_saida_origem_api" + iSeqRow] && scEventControl_data["hr_saida_origem_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hr_saida_origem_api" + iSeqRow] && scEventControl_data["hr_saida_origem_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["local_destino_api" + iSeqRow] && scEventControl_data["local_destino_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["local_destino_api" + iSeqRow] && scEventControl_data["local_destino_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["latitude_destino_api" + iSeqRow] && scEventControl_data["latitude_destino_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["latitude_destino_api" + iSeqRow] && scEventControl_data["latitude_destino_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["longitude_destino_api" + iSeqRow] && scEventControl_data["longitude_destino_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["longitude_destino_api" + iSeqRow] && scEventControl_data["longitude_destino_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["veiculo_api" + iSeqRow] && scEventControl_data["veiculo_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["veiculo_api" + iSeqRow] && scEventControl_data["veiculo_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["companhia_api" + iSeqRow] && scEventControl_data["companhia_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["companhia_api" + iSeqRow] && scEventControl_data["companhia_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nome_motorista_api" + iSeqRow] && scEventControl_data["nome_motorista_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome_motorista_api" + iSeqRow] && scEventControl_data["nome_motorista_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["contato_motorista_api" + iSeqRow] && scEventControl_data["contato_motorista_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["contato_motorista_api" + iSeqRow] && scEventControl_data["contato_motorista_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["matricula_api" + iSeqRow] && scEventControl_data["matricula_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["matricula_api" + iSeqRow] && scEventControl_data["matricula_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["duracao_percurso_api" + iSeqRow] && scEventControl_data["duracao_percurso_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["duracao_percurso_api" + iSeqRow] && scEventControl_data["duracao_percurso_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["comodidades_api" + iSeqRow] && scEventControl_data["comodidades_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["comodidades_api" + iSeqRow] && scEventControl_data["comodidades_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["observacao_api" + iSeqRow] && scEventControl_data["observacao_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["observacao_api" + iSeqRow] && scEventControl_data["observacao_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["placa_veiculo_api" + iSeqRow] && scEventControl_data["placa_veiculo_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["placa_veiculo_api" + iSeqRow] && scEventControl_data["placa_veiculo_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_evento_app" + iSeqRow] && scEventControl_data["id_evento_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_evento_app" + iSeqRow] && scEventControl_data["id_evento_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_participante_app" + iSeqRow] && scEventControl_data["id_participante_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_participante_app" + iSeqRow] && scEventControl_data["id_participante_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_voucher_app" + iSeqRow] && scEventControl_data["id_voucher_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_voucher_app" + iSeqRow] && scEventControl_data["id_voucher_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["titulo_api_out" + iSeqRow] && scEventControl_data["titulo_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["titulo_api_out" + iSeqRow] && scEventControl_data["titulo_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["descricao_api_out" + iSeqRow] && scEventControl_data["descricao_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["descricao_api_out" + iSeqRow] && scEventControl_data["descricao_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["codigo_api_out" + iSeqRow] && scEventControl_data["codigo_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["codigo_api_out" + iSeqRow] && scEventControl_data["codigo_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_api_out" + iSeqRow] && scEventControl_data["tipo_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_api_out" + iSeqRow] && scEventControl_data["tipo_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["status_api_out" + iSeqRow] && scEventControl_data["status_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["status_api_out" + iSeqRow] && scEventControl_data["status_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["valido_de_api_out" + iSeqRow] && scEventControl_data["valido_de_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["valido_de_api_out" + iSeqRow] && scEventControl_data["valido_de_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["valido_ate_api_out" + iSeqRow] && scEventControl_data["valido_ate_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["valido_ate_api_out" + iSeqRow] && scEventControl_data["valido_ate_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["local_de_origem_api_out" + iSeqRow] && scEventControl_data["local_de_origem_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["local_de_origem_api_out" + iSeqRow] && scEventControl_data["local_de_origem_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["latitude_origem_api_out" + iSeqRow] && scEventControl_data["latitude_origem_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["latitude_origem_api_out" + iSeqRow] && scEventControl_data["latitude_origem_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["longitude_origem_api_out" + iSeqRow] && scEventControl_data["longitude_origem_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["longitude_origem_api_out" + iSeqRow] && scEventControl_data["longitude_origem_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hr_saida_origem_api_out" + iSeqRow] && scEventControl_data["hr_saida_origem_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hr_saida_origem_api_out" + iSeqRow] && scEventControl_data["hr_saida_origem_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["local_de_destino_api_out" + iSeqRow] && scEventControl_data["local_de_destino_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["local_de_destino_api_out" + iSeqRow] && scEventControl_data["local_de_destino_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["latitude_destino_api_out" + iSeqRow] && scEventControl_data["latitude_destino_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["latitude_destino_api_out" + iSeqRow] && scEventControl_data["latitude_destino_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["longitude_destino_api_out" + iSeqRow] && scEventControl_data["longitude_destino_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["longitude_destino_api_out" + iSeqRow] && scEventControl_data["longitude_destino_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["veiculo_api_out" + iSeqRow] && scEventControl_data["veiculo_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["veiculo_api_out" + iSeqRow] && scEventControl_data["veiculo_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["companhia_api_out" + iSeqRow] && scEventControl_data["companhia_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["companhia_api_out" + iSeqRow] && scEventControl_data["companhia_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nome_motorista_api_out" + iSeqRow] && scEventControl_data["nome_motorista_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome_motorista_api_out" + iSeqRow] && scEventControl_data["nome_motorista_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["contato_motorista_api_out" + iSeqRow] && scEventControl_data["contato_motorista_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["contato_motorista_api_out" + iSeqRow] && scEventControl_data["contato_motorista_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["matricula_api_out" + iSeqRow] && scEventControl_data["matricula_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["matricula_api_out" + iSeqRow] && scEventControl_data["matricula_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["duracao_percurso_api_out" + iSeqRow] && scEventControl_data["duracao_percurso_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["duracao_percurso_api_out" + iSeqRow] && scEventControl_data["duracao_percurso_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["comodidades_api_out" + iSeqRow] && scEventControl_data["comodidades_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["comodidades_api_out" + iSeqRow] && scEventControl_data["comodidades_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["observacao_api_out" + iSeqRow] && scEventControl_data["observacao_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["observacao_api_out" + iSeqRow] && scEventControl_data["observacao_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["placa_veiculo_api_out" + iSeqRow] && scEventControl_data["placa_veiculo_api_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["placa_veiculo_api_out" + iSeqRow] && scEventControl_data["placa_veiculo_api_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_evento_app_out" + iSeqRow] && scEventControl_data["id_evento_app_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_evento_app_out" + iSeqRow] && scEventControl_data["id_evento_app_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_participante_app_out" + iSeqRow] && scEventControl_data["id_participante_app_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_participante_app_out" + iSeqRow] && scEventControl_data["id_participante_app_out" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_voucher_app_out" + iSeqRow] && scEventControl_data["id_voucher_app_out" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_voucher_app_out" + iSeqRow] && scEventControl_data["id_voucher_app_out" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("tra_tipo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_id_hotel" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_id_hotel_out" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_status" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_flag_ida" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_intervalo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_flag_volta" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_flag_proprio" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_flag_ida_local" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_flag_volta_local" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("tra_ativo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("local_de_origem_api" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("local_de_origem_api_out" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("local_destino_api" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_flag_ida_local" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_flag_ida" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_flag_proprio" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_flag_volta_local" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_flag_volta" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_id_hotel" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_id_hotel_out" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_intervalo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_tipo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("tra_ult_trecho_volta" + iSeq == fieldName) {
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
  $('#id_sc_field_id_transfer' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_id_transfer_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_id_evento' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_id_evento_onblur('#id_sc_field_tra_id_evento' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_tra_id_evento_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_tra_id_evento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_id_aereo' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_id_aereo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_id_aereo_volta' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_id_aereo_volta_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_id_bloqueio' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_id_bloqueio_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_id_usuario' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_id_usuario_onblur('#id_sc_field_tra_id_usuario' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_tra_id_usuario_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_tra_id_usuario_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_id_hotel' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_id_hotel_onblur('#id_sc_field_tra_id_hotel' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_form_transfer_rsvp_tra_id_hotel_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_transfer_rsvp_tra_id_hotel_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_cpf_particip' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_cpf_particip_onblur('#id_sc_field_tra_cpf_particip' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_cpf_particip_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_cpf_particip_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_tipo_pessoa' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_tipo_pessoa_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_tipo' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_transfer_rsvp_tra_tipo_onblur('#id_sc_field_tra_tipo' + iSeqRow, iSeqRow, event);}, 300) })
                                      .bind('change', function() { sc_form_transfer_rsvp_tra_tipo_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_transfer_rsvp_tra_tipo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_status' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_status_onblur('#id_sc_field_tra_status' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_transfer_rsvp_tra_status_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_transfer_rsvp_tra_status_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_direcao' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_direcao_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_aereo_tipo' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_aereo_tipo_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_tipo_dsc' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_tipo_dsc_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_cia_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_cia_ida_onblur('#id_sc_field_tra_cia_ida' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_transfer_rsvp_tra_cia_ida_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_transfer_rsvp_tra_cia_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_numvoo_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_numvoo_ida_onblur('#id_sc_field_tra_numvoo_ida' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_tra_numvoo_ida_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_tra_numvoo_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_origem_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_origem_ida_onblur('#id_sc_field_tra_origem_ida' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_tra_origem_ida_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_tra_origem_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_destino_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_destino_ida_onblur('#id_sc_field_tra_destino_ida' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_transfer_rsvp_tra_destino_ida_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_transfer_rsvp_tra_destino_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_dt_saida_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_dt_saida_ida_onblur('#id_sc_field_tra_dt_saida_ida' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_dt_saida_ida_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_dt_saida_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_hr_saida_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_hr_saida_ida_onblur('#id_sc_field_tra_hr_saida_ida' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_hr_saida_ida_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_hr_saida_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_dt_chegada_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_dt_chegada_ida_onblur('#id_sc_field_tra_dt_chegada_ida' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_tra_dt_chegada_ida_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_tra_dt_chegada_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_hr_chegada_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_hr_chegada_ida_onblur('#id_sc_field_tra_hr_chegada_ida' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_tra_hr_chegada_ida_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_tra_hr_chegada_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_localizador_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_localizador_ida_onblur('#id_sc_field_tra_localizador_ida' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_transfer_rsvp_tra_localizador_ida_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_transfer_rsvp_tra_localizador_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_eticket_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_eticket_ida_onblur('#id_sc_field_tra_eticket_ida' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_transfer_rsvp_tra_eticket_ida_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_transfer_rsvp_tra_eticket_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_bloqueio_ida' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_bloqueio_ida_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_cia_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_cia_volta_onblur('#id_sc_field_tra_cia_volta' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_tra_cia_volta_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_tra_cia_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_numvoo_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_numvoo_volta_onblur('#id_sc_field_tra_numvoo_volta' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_numvoo_volta_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_numvoo_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_origem_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_origem_volta_onblur('#id_sc_field_tra_origem_volta' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_origem_volta_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_origem_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_destino_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_destino_volta_onblur('#id_sc_field_tra_destino_volta' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_tra_destino_volta_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_tra_destino_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_dt_saida_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_dt_saida_volta_onblur('#id_sc_field_tra_dt_saida_volta' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_tra_dt_saida_volta_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_tra_dt_saida_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_hr_saida_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_hr_saida_volta_onblur('#id_sc_field_tra_hr_saida_volta' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_tra_hr_saida_volta_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_tra_hr_saida_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_dt_chegada_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_dt_chegada_volta_onblur('#id_sc_field_tra_dt_chegada_volta' + iSeqRow, iSeqRow, event) })
                                                  .bind('change', function() { sc_form_transfer_rsvp_tra_dt_chegada_volta_onchange(this, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_transfer_rsvp_tra_dt_chegada_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_hr_chegada_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_hr_chegada_volta_onblur('#id_sc_field_tra_hr_chegada_volta' + iSeqRow, iSeqRow, event) })
                                                  .bind('change', function() { sc_form_transfer_rsvp_tra_hr_chegada_volta_onchange(this, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_transfer_rsvp_tra_hr_chegada_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_localizador_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_localizador_volta_onblur('#id_sc_field_tra_localizador_volta' + iSeqRow, iSeqRow, event) })
                                                   .bind('change', function() { sc_form_transfer_rsvp_tra_localizador_volta_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_transfer_rsvp_tra_localizador_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_eticket_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_eticket_volta_onblur('#id_sc_field_tra_eticket_volta' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_tra_eticket_volta_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_tra_eticket_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_bloqueio_volta' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_bloqueio_volta_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_ult_trecho_volta' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_ult_trecho_volta_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_flag_ida' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_flag_ida_onblur('#id_sc_field_tra_flag_ida' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_form_transfer_rsvp_tra_flag_ida_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_transfer_rsvp_tra_flag_ida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_flag_volta' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_flag_volta_onblur('#id_sc_field_tra_flag_volta' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_tra_flag_volta_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_tra_flag_volta_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_dt_chegada_proprio' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_dt_chegada_proprio_onblur('#id_sc_field_tra_dt_chegada_proprio' + iSeqRow, iSeqRow, event) })
                                                    .bind('change', function() { sc_form_transfer_rsvp_tra_dt_chegada_proprio_onchange(this, iSeqRow, event) })
                                                    .bind('focus', function() { sc_form_transfer_rsvp_tra_dt_chegada_proprio_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_hr_chegada_proprio' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_hr_chegada_proprio_onblur('#id_sc_field_tra_hr_chegada_proprio' + iSeqRow, iSeqRow, event) })
                                                    .bind('change', function() { sc_form_transfer_rsvp_tra_hr_chegada_proprio_onchange(this, iSeqRow, event) })
                                                    .bind('focus', function() { sc_form_transfer_rsvp_tra_hr_chegada_proprio_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_dt_ida_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_dt_ida_local_onblur('#id_sc_field_tra_dt_ida_local' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_dt_ida_local_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_dt_ida_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_hr_ida_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_hr_ida_local_onblur('#id_sc_field_tra_hr_ida_local' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_hr_ida_local_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_hr_ida_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_dt_volta_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_dt_volta_local_onblur('#id_sc_field_tra_dt_volta_local' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_tra_dt_volta_local_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_tra_dt_volta_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_hr_volta_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_hr_volta_local_onblur('#id_sc_field_tra_hr_volta_local' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_tra_hr_volta_local_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_tra_hr_volta_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_origem_ida_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_origem_ida_local_onblur('#id_sc_field_tra_origem_ida_local' + iSeqRow, iSeqRow, event) })
                                                  .bind('change', function() { sc_form_transfer_rsvp_tra_origem_ida_local_onchange(this, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_transfer_rsvp_tra_origem_ida_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_destino_ida_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_destino_ida_local_onblur('#id_sc_field_tra_destino_ida_local' + iSeqRow, iSeqRow, event) })
                                                   .bind('change', function() { sc_form_transfer_rsvp_tra_destino_ida_local_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_transfer_rsvp_tra_destino_ida_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_origem_volta_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_origem_volta_local_onblur('#id_sc_field_tra_origem_volta_local' + iSeqRow, iSeqRow, event) })
                                                    .bind('change', function() { sc_form_transfer_rsvp_tra_origem_volta_local_onchange(this, iSeqRow, event) })
                                                    .bind('focus', function() { sc_form_transfer_rsvp_tra_origem_volta_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_destino_volta_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_destino_volta_local_onblur('#id_sc_field_tra_destino_volta_local' + iSeqRow, iSeqRow, event) })
                                                     .bind('change', function() { sc_form_transfer_rsvp_tra_destino_volta_local_onchange(this, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_transfer_rsvp_tra_destino_volta_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_observacao' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_observacao_onblur('#id_sc_field_tra_observacao' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_tra_observacao_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_tra_observacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_flag_proprio' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_flag_proprio_onblur('#id_sc_field_tra_flag_proprio' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_flag_proprio_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_flag_proprio_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_flag_ida_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_flag_ida_local_onblur('#id_sc_field_tra_flag_ida_local' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_tra_flag_ida_local_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_tra_flag_ida_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_flag_volta_local' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_flag_volta_local_onblur('#id_sc_field_tra_flag_volta_local' + iSeqRow, iSeqRow, event) })
                                                  .bind('change', function() { sc_form_transfer_rsvp_tra_flag_volta_local_onchange(this, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_transfer_rsvp_tra_flag_volta_local_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_dt_alteracao' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_dt_alteracao_onblur('#id_sc_field_tra_dt_alteracao' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_dt_alteracao_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_dt_alteracao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_dt_alteracao_hora' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_dt_alteracao_hora_onblur('#id_sc_field_tra_dt_alteracao' + iSeqRow, iSeqRow, event) })
                                                   .bind('change', function() { sc_form_transfer_rsvp_tra_dt_alteracao_hora_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_transfer_rsvp_tra_dt_alteracao_hora_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_intervalo' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_intervalo_onblur('#id_sc_field_tra_intervalo' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_tra_intervalo_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_tra_intervalo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_hrtransout' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_hrtransout_onblur('#id_sc_field_tra_hrtransout' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_tra_hrtransout_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_tra_hrtransout_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_ativo' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_ativo_onblur('#id_sc_field_tra_ativo' + iSeqRow, iSeqRow, event) })
                                       .bind('change', function() { sc_form_transfer_rsvp_tra_ativo_onchange(this, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_transfer_rsvp_tra_ativo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tra_transfer_trecho' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_tra_transfer_trecho_onchange(this, iSeqRow, event) });
  $('#id_sc_field_tra_id_hotel_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tra_id_hotel_out_onblur('#id_sc_field_tra_id_hotel_out' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_tra_id_hotel_out_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_tra_id_hotel_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_titulo_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_titulo_api_onblur('#id_sc_field_titulo_api' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_transfer_rsvp_titulo_api_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_transfer_rsvp_titulo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_descricao_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_descricao_api_onblur('#id_sc_field_descricao_api' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_descricao_api_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_descricao_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_codigo_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_codigo_api_onblur('#id_sc_field_codigo_api' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_transfer_rsvp_codigo_api_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_transfer_rsvp_codigo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tipo_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tipo_api_onblur('#id_sc_field_tipo_api' + iSeqRow, iSeqRow, event) })
                                      .bind('change', function() { sc_form_transfer_rsvp_tipo_api_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_transfer_rsvp_tipo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_status_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_status_api_onblur('#id_sc_field_status_api' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_transfer_rsvp_status_api_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_transfer_rsvp_status_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_valido_de_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_valido_de_api_onblur('#id_sc_field_valido_de_api' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_valido_de_api_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_valido_de_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_valido_ate_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_valido_ate_api_onblur('#id_sc_field_valido_ate_api' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_valido_ate_api_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_valido_ate_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_local_de_origem_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_local_de_origem_api_onblur('#id_sc_field_local_de_origem_api' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_transfer_rsvp_local_de_origem_api_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_transfer_rsvp_local_de_origem_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_latitude_origem_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_latitude_origem_api_onblur('#id_sc_field_latitude_origem_api' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_transfer_rsvp_latitude_origem_api_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_transfer_rsvp_latitude_origem_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_longitude_origem_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_longitude_origem_api_onblur('#id_sc_field_longitude_origem_api' + iSeqRow, iSeqRow, event) })
                                                  .bind('change', function() { sc_form_transfer_rsvp_longitude_origem_api_onchange(this, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_transfer_rsvp_longitude_origem_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hr_saida_origem_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_hr_saida_origem_api_onblur('#id_sc_field_hr_saida_origem_api' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_transfer_rsvp_hr_saida_origem_api_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_transfer_rsvp_hr_saida_origem_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_veiculo_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_veiculo_api_onblur('#id_sc_field_veiculo_api' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_transfer_rsvp_veiculo_api_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_transfer_rsvp_veiculo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_local_destino_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_local_destino_api_onblur('#id_sc_field_local_destino_api' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_local_destino_api_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_local_destino_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_latitude_destino_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_latitude_destino_api_onblur('#id_sc_field_latitude_destino_api' + iSeqRow, iSeqRow, event) })
                                                  .bind('change', function() { sc_form_transfer_rsvp_latitude_destino_api_onchange(this, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_transfer_rsvp_latitude_destino_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_longitude_destino_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_longitude_destino_api_onblur('#id_sc_field_longitude_destino_api' + iSeqRow, iSeqRow, event) })
                                                   .bind('change', function() { sc_form_transfer_rsvp_longitude_destino_api_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_transfer_rsvp_longitude_destino_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_companhia_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_companhia_api_onblur('#id_sc_field_companhia_api' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_companhia_api_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_companhia_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome_motorista_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_nome_motorista_api_onblur('#id_sc_field_nome_motorista_api' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_nome_motorista_api_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_nome_motorista_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_contato_motorista_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_contato_motorista_api_onblur('#id_sc_field_contato_motorista_api' + iSeqRow, iSeqRow, event) })
                                                   .bind('change', function() { sc_form_transfer_rsvp_contato_motorista_api_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_transfer_rsvp_contato_motorista_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_duracao_percurso_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_duracao_percurso_api_onblur('#id_sc_field_duracao_percurso_api' + iSeqRow, iSeqRow, event) })
                                                  .bind('change', function() { sc_form_transfer_rsvp_duracao_percurso_api_onchange(this, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_transfer_rsvp_duracao_percurso_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_comodidades_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_comodidades_api_onblur('#id_sc_field_comodidades_api' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_transfer_rsvp_comodidades_api_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_transfer_rsvp_comodidades_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_observacao_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_observacao_api_onblur('#id_sc_field_observacao_api' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_observacao_api_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_observacao_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_placa_veiculo_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_placa_veiculo_api_onblur('#id_sc_field_placa_veiculo_api' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_placa_veiculo_api_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_placa_veiculo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_matricula_api' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_matricula_api_onblur('#id_sc_field_matricula_api' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_matricula_api_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_matricula_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_titulo_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_titulo_api_out_onblur('#id_sc_field_titulo_api_out' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_titulo_api_out_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_titulo_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_descricao_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_descricao_api_out_onblur('#id_sc_field_descricao_api_out' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_descricao_api_out_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_descricao_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_codigo_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_codigo_api_out_onblur('#id_sc_field_codigo_api_out' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_codigo_api_out_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_codigo_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tipo_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tipo_api_out_onblur('#id_sc_field_tipo_api_out' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_form_transfer_rsvp_tipo_api_out_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_transfer_rsvp_tipo_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_status_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_status_api_out_onblur('#id_sc_field_status_api_out' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_status_api_out_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_status_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_valido_de_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_valido_de_api_out_onblur('#id_sc_field_valido_de_api_out' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_valido_de_api_out_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_valido_de_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_valido_ate_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_valido_ate_api_out_onblur('#id_sc_field_valido_ate_api_out' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_valido_ate_api_out_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_valido_ate_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_local_de_origem_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_local_de_origem_api_out_onblur('#id_sc_field_local_de_origem_api_out' + iSeqRow, iSeqRow, event) })
                                                     .bind('change', function() { sc_form_transfer_rsvp_local_de_origem_api_out_onchange(this, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_transfer_rsvp_local_de_origem_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_latitude_origem_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_latitude_origem_api_out_onblur('#id_sc_field_latitude_origem_api_out' + iSeqRow, iSeqRow, event) })
                                                     .bind('change', function() { sc_form_transfer_rsvp_latitude_origem_api_out_onchange(this, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_transfer_rsvp_latitude_origem_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_longitude_origem_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_longitude_origem_api_out_onblur('#id_sc_field_longitude_origem_api_out' + iSeqRow, iSeqRow, event) })
                                                      .bind('change', function() { sc_form_transfer_rsvp_longitude_origem_api_out_onchange(this, iSeqRow, event) })
                                                      .bind('focus', function() { sc_form_transfer_rsvp_longitude_origem_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hr_saida_origem_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_hr_saida_origem_api_out_onblur('#id_sc_field_hr_saida_origem_api_out' + iSeqRow, iSeqRow, event) })
                                                     .bind('change', function() { sc_form_transfer_rsvp_hr_saida_origem_api_out_onchange(this, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_transfer_rsvp_hr_saida_origem_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_local_de_destino_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_local_de_destino_api_out_onblur('#id_sc_field_local_de_destino_api_out' + iSeqRow, iSeqRow, event) })
                                                      .bind('change', function() { sc_form_transfer_rsvp_local_de_destino_api_out_onchange(this, iSeqRow, event) })
                                                      .bind('click', function() { sc_form_transfer_rsvp_local_de_destino_api_out_onclick(this, iSeqRow, event) })
                                                      .bind('focus', function() { sc_form_transfer_rsvp_local_de_destino_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_latitude_destino_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_latitude_destino_api_out_onblur('#id_sc_field_latitude_destino_api_out' + iSeqRow, iSeqRow, event) })
                                                      .bind('change', function() { sc_form_transfer_rsvp_latitude_destino_api_out_onchange(this, iSeqRow, event) })
                                                      .bind('focus', function() { sc_form_transfer_rsvp_latitude_destino_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_longitude_destino_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_longitude_destino_api_out_onblur('#id_sc_field_longitude_destino_api_out' + iSeqRow, iSeqRow, event) })
                                                       .bind('change', function() { sc_form_transfer_rsvp_longitude_destino_api_out_onchange(this, iSeqRow, event) })
                                                       .bind('focus', function() { sc_form_transfer_rsvp_longitude_destino_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_veiculo_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_veiculo_api_out_onblur('#id_sc_field_veiculo_api_out' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_transfer_rsvp_veiculo_api_out_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_transfer_rsvp_veiculo_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_companhia_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_companhia_api_out_onblur('#id_sc_field_companhia_api_out' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_companhia_api_out_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_companhia_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome_motorista_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_nome_motorista_api_out_onblur('#id_sc_field_nome_motorista_api_out' + iSeqRow, iSeqRow, event) })
                                                    .bind('change', function() { sc_form_transfer_rsvp_nome_motorista_api_out_onchange(this, iSeqRow, event) })
                                                    .bind('focus', function() { sc_form_transfer_rsvp_nome_motorista_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_contato_motorista_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_contato_motorista_api_out_onblur('#id_sc_field_contato_motorista_api_out' + iSeqRow, iSeqRow, event) })
                                                       .bind('change', function() { sc_form_transfer_rsvp_contato_motorista_api_out_onchange(this, iSeqRow, event) })
                                                       .bind('focus', function() { sc_form_transfer_rsvp_contato_motorista_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_duracao_percurso_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_duracao_percurso_api_out_onblur('#id_sc_field_duracao_percurso_api_out' + iSeqRow, iSeqRow, event) })
                                                      .bind('change', function() { sc_form_transfer_rsvp_duracao_percurso_api_out_onchange(this, iSeqRow, event) })
                                                      .bind('focus', function() { sc_form_transfer_rsvp_duracao_percurso_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_comodidades_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_comodidades_api_out_onblur('#id_sc_field_comodidades_api_out' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_transfer_rsvp_comodidades_api_out_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_transfer_rsvp_comodidades_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_observacao_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_observacao_api_out_onblur('#id_sc_field_observacao_api_out' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_observacao_api_out_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_observacao_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_placa_veiculo_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_placa_veiculo_api_out_onblur('#id_sc_field_placa_veiculo_api_out' + iSeqRow, iSeqRow, event) })
                                                   .bind('change', function() { sc_form_transfer_rsvp_placa_veiculo_api_out_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_transfer_rsvp_placa_veiculo_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_matricula_api_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_matricula_api_out_onblur('#id_sc_field_matricula_api_out' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_matricula_api_out_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_matricula_api_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_evento_app' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_id_evento_app_onblur('#id_sc_field_id_evento_app' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_id_evento_app_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_id_evento_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_participante_app' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_id_participante_app_onblur('#id_sc_field_id_participante_app' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_transfer_rsvp_id_participante_app_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_transfer_rsvp_id_participante_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_voucher_app' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_id_voucher_app_onblur('#id_sc_field_id_voucher_app' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_id_voucher_app_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_id_voucher_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_enviar_app' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_enviar_app_onblur('#id_sc_field_enviar_app' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_transfer_rsvp_enviar_app_onchange(this, iSeqRow, event) })
                                        .bind('click', function() { sc_form_transfer_rsvp_enviar_app_onclick(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_transfer_rsvp_enviar_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_evento_app_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_id_evento_app_out_onblur('#id_sc_field_id_evento_app_out' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_id_evento_app_out_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_id_evento_app_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_participante_app_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_id_participante_app_out_onblur('#id_sc_field_id_participante_app_out' + iSeqRow, iSeqRow, event) })
                                                     .bind('change', function() { sc_form_transfer_rsvp_id_participante_app_out_onchange(this, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_transfer_rsvp_id_participante_app_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_voucher_app_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_id_voucher_app_out_onblur('#id_sc_field_id_voucher_app_out' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_transfer_rsvp_id_voucher_app_out_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_transfer_rsvp_id_voucher_app_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_atendente_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_atendente_dsc_onblur('#id_sc_field_atendente_dsc' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_atendente_dsc_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_atendente_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cia_ida_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_cia_ida_dsc_onblur('#id_sc_field_cia_ida_dsc' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_transfer_rsvp_cia_ida_dsc_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_transfer_rsvp_cia_ida_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cia_volta_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_cia_volta_dsc_onblur('#id_sc_field_cia_volta_dsc' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_cia_volta_dsc_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_cia_volta_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cpf_del' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_cpf_del_onblur('#id_sc_field_cpf_del' + iSeqRow, iSeqRow, event) })
                                     .bind('change', function() { sc_form_transfer_rsvp_cpf_del_onchange(this, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_transfer_rsvp_cpf_del_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_destino_ida_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_destino_ida_dsc_onblur('#id_sc_field_destino_ida_dsc' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_transfer_rsvp_destino_ida_dsc_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_transfer_rsvp_destino_ida_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_destino_volta_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_destino_volta_dsc_onblur('#id_sc_field_destino_volta_dsc' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_transfer_rsvp_destino_volta_dsc_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_transfer_rsvp_destino_volta_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_evento_dsc_onblur('#id_sc_field_evento_dsc' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_transfer_rsvp_evento_dsc_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_transfer_rsvp_evento_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_hotel_dsc_onblur('#id_sc_field_hotel_dsc' + iSeqRow, iSeqRow, event) })
                                       .bind('change', function() { sc_form_transfer_rsvp_hotel_dsc_onchange(this, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_transfer_rsvp_hotel_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_dsc_out' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_hotel_dsc_out_onblur('#id_sc_field_hotel_dsc_out' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_transfer_rsvp_hotel_dsc_out_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_transfer_rsvp_hotel_dsc_out_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_origem_ida_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_origem_ida_dsc_onblur('#id_sc_field_origem_ida_dsc' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_transfer_rsvp_origem_ida_dsc_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_transfer_rsvp_origem_ida_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_origem_volta_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_origem_volta_dsc_onblur('#id_sc_field_origem_volta_dsc' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_transfer_rsvp_origem_volta_dsc_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_transfer_rsvp_origem_volta_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_rodape' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_rodape_onchange(this, iSeqRow, event) });
  $('#id_sc_field_sql_log' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_sql_log_onblur('#id_sc_field_sql_log' + iSeqRow, iSeqRow, event) })
                                     .bind('change', function() { sc_form_transfer_rsvp_sql_log_onchange(this, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_transfer_rsvp_sql_log_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tipo_dsc' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_tipo_dsc_onblur('#id_sc_field_tipo_dsc' + iSeqRow, iSeqRow, event) })
                                      .bind('change', function() { sc_form_transfer_rsvp_tipo_dsc_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_transfer_rsvp_tipo_dsc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_ult_trecho' + iSeqRow).bind('blur', function() { sc_form_transfer_rsvp_ult_trecho_onblur('#id_sc_field_ult_trecho' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_transfer_rsvp_ult_trecho_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_transfer_rsvp_ult_trecho_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_nivel' + iSeqRow).bind('change', function() { sc_form_transfer_rsvp_usuario_nivel_onchange(this, iSeqRow, event) });
  $('.sc-ui-radio-enviar_app' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_transfer_rsvp_id_transfer_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_id_evento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_id_evento();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_id_evento_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_id_evento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_id_aereo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_id_aereo_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_id_bloqueio_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_id_usuario_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_id_usuario();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_id_usuario_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_id_usuario_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_id_hotel_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_id_hotel();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_id_hotel_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_tra_id_hotel_onchange();
}

function sc_form_transfer_rsvp_tra_id_hotel_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_cpf_particip_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_cpf_particip();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_cpf_particip_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  lookup_tra_cpf_particip();
}

function sc_form_transfer_rsvp_tra_cpf_particip_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_tipo_pessoa_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_tipo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_tipo();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_tipo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_tra_tipo_onchange();
}

function sc_form_transfer_rsvp_tra_tipo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_status_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_status();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_status_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_status_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
  do_ajax_form_transfer_rsvp_event_tra_status_onfocus();
}

function sc_form_transfer_rsvp_tra_direcao_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_aereo_tipo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_tipo_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_cia_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_cia_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_cia_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_cia_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_numvoo_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_numvoo_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_numvoo_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_numvoo_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_origem_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_origem_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_origem_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_origem_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_destino_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_destino_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_destino_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_destino_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_dt_saida_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_dt_saida_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_dt_saida_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_dt_saida_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_hr_saida_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_hr_saida_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_hr_saida_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_hr_saida_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_dt_chegada_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_dt_chegada_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_dt_chegada_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_hr_chegada_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_hr_chegada_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_hr_chegada_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_localizador_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_localizador_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_localizador_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_localizador_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_eticket_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_eticket_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_eticket_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_eticket_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_bloqueio_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_cia_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_cia_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_cia_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_cia_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_numvoo_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_numvoo_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_numvoo_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_numvoo_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_origem_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_origem_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_origem_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_origem_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_destino_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_destino_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_destino_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_destino_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_dt_saida_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_dt_saida_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_dt_saida_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_dt_saida_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_hr_saida_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_hr_saida_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_hr_saida_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_hr_saida_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_dt_chegada_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_dt_chegada_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_dt_chegada_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_hr_chegada_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_hr_chegada_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_hr_chegada_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_localizador_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_localizador_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_localizador_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_localizador_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_eticket_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_eticket_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_eticket_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_eticket_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_bloqueio_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_ult_trecho_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_flag_ida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_flag_ida();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_flag_ida_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_tra_flag_ida_onchange();
}

function sc_form_transfer_rsvp_tra_flag_ida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_flag_volta_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_flag_volta();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_flag_volta_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_tra_flag_volta_onchange();
}

function sc_form_transfer_rsvp_tra_flag_volta_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_dt_chegada_proprio_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_dt_chegada_proprio_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_dt_chegada_proprio_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_hr_chegada_proprio_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_hr_chegada_proprio();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_hr_chegada_proprio_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_hr_chegada_proprio_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_dt_ida_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_dt_ida_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_dt_ida_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_dt_ida_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_hr_ida_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_hr_ida_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_hr_ida_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_hr_ida_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_dt_volta_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_dt_volta_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_dt_volta_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_dt_volta_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_hr_volta_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_hr_volta_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_hr_volta_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_hr_volta_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_origem_ida_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_origem_ida_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_origem_ida_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_origem_ida_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_destino_ida_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_destino_ida_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_destino_ida_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_destino_ida_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_origem_volta_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_origem_volta_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_origem_volta_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_origem_volta_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_destino_volta_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_destino_volta_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_destino_volta_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_destino_volta_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_observacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_observacao();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_observacao_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_observacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_flag_proprio_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_flag_proprio();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_flag_proprio_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_tra_flag_proprio_onchange();
}

function sc_form_transfer_rsvp_tra_flag_proprio_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_flag_ida_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_flag_ida_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_flag_ida_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_tra_flag_ida_local_onchange();
}

function sc_form_transfer_rsvp_tra_flag_ida_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_flag_volta_local_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_flag_volta_local();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_flag_volta_local_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_tra_flag_volta_local_onchange();
}

function sc_form_transfer_rsvp_tra_flag_volta_local_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_dt_alteracao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_dt_alteracao();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_dt_alteracao_hora_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_dt_alteracao();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_dt_alteracao_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_dt_alteracao_hora_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_dt_alteracao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_dt_alteracao_hora_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_intervalo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_intervalo();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_intervalo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_tra_intervalo_onchange();
}

function sc_form_transfer_rsvp_tra_intervalo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_hrtransout_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_hrtransout();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_hrtransout_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_hrtransout_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_ativo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_ativo();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_ativo_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_ativo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tra_transfer_trecho_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tra_id_hotel_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tra_id_hotel_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tra_id_hotel_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_tra_id_hotel_out_onchange();
}

function sc_form_transfer_rsvp_tra_id_hotel_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_titulo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_titulo_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_titulo_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_titulo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_descricao_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_descricao_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_descricao_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_descricao_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_codigo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_codigo_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_codigo_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_codigo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tipo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tipo_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tipo_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tipo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_status_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_status_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_status_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_status_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_valido_de_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_valido_de_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_valido_de_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_valido_de_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_valido_ate_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_valido_ate_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_valido_ate_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_valido_ate_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_local_de_origem_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_local_de_origem_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_local_de_origem_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_local_de_origem_api_onchange();
}

function sc_form_transfer_rsvp_local_de_origem_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_latitude_origem_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_latitude_origem_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_latitude_origem_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_latitude_origem_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_longitude_origem_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_longitude_origem_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_longitude_origem_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_longitude_origem_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_hr_saida_origem_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_hr_saida_origem_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_hr_saida_origem_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_veiculo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_veiculo_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_veiculo_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_veiculo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_local_destino_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_local_destino_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_local_destino_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_local_destino_api_onchange();
}

function sc_form_transfer_rsvp_local_destino_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_latitude_destino_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_latitude_destino_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_latitude_destino_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_latitude_destino_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_longitude_destino_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_longitude_destino_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_longitude_destino_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_longitude_destino_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_companhia_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_companhia_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_companhia_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_companhia_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_nome_motorista_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_nome_motorista_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_nome_motorista_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_nome_motorista_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_contato_motorista_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_contato_motorista_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_contato_motorista_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_contato_motorista_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_duracao_percurso_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_duracao_percurso_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_duracao_percurso_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_duracao_percurso_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_comodidades_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_comodidades_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_comodidades_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_comodidades_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_observacao_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_observacao_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_observacao_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_observacao_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_placa_veiculo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_placa_veiculo_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_placa_veiculo_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_placa_veiculo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_matricula_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_matricula_api();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_matricula_api_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_matricula_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_titulo_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_titulo_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_titulo_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_titulo_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_descricao_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_descricao_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_descricao_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_descricao_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_codigo_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_codigo_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_codigo_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_codigo_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tipo_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tipo_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tipo_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tipo_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_status_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_status_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_status_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_status_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_valido_de_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_valido_de_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_valido_de_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_valido_de_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_valido_ate_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_valido_ate_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_valido_ate_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_valido_ate_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_local_de_origem_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_local_de_origem_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_local_de_origem_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_transfer_rsvp_event_local_de_origem_api_out_onchange();
}

function sc_form_transfer_rsvp_local_de_origem_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_latitude_origem_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_latitude_origem_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_latitude_origem_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_latitude_origem_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_longitude_origem_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_longitude_origem_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_longitude_origem_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_longitude_origem_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_hr_saida_origem_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_hr_saida_origem_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_hr_saida_origem_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_hr_saida_origem_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_local_de_destino_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_local_de_destino_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_local_de_destino_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_local_de_destino_api_out_onclick(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_event_local_de_destino_api_out_onclick();
}

function sc_form_transfer_rsvp_local_de_destino_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_latitude_destino_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_latitude_destino_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_latitude_destino_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_latitude_destino_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_longitude_destino_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_longitude_destino_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_longitude_destino_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_longitude_destino_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_veiculo_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_veiculo_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_veiculo_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_veiculo_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_companhia_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_companhia_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_companhia_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_companhia_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_nome_motorista_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_nome_motorista_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_nome_motorista_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_nome_motorista_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_contato_motorista_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_contato_motorista_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_contato_motorista_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_contato_motorista_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_duracao_percurso_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_duracao_percurso_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_duracao_percurso_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_duracao_percurso_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_comodidades_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_comodidades_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_comodidades_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_comodidades_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_observacao_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_observacao_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_observacao_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_observacao_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_placa_veiculo_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_placa_veiculo_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_placa_veiculo_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_placa_veiculo_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_matricula_api_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_matricula_api_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_matricula_api_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_matricula_api_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_id_evento_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_id_evento_app();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_id_evento_app_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_id_evento_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_id_participante_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_id_participante_app();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_id_participante_app_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_id_participante_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_id_voucher_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_id_voucher_app();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_id_voucher_app_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_id_voucher_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_enviar_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_enviar_app();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_enviar_app_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_enviar_app_onclick(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_event_enviar_app_onclick();
}

function sc_form_transfer_rsvp_enviar_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_id_evento_app_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_id_evento_app_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_id_evento_app_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_id_evento_app_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_id_participante_app_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_id_participante_app_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_id_participante_app_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_id_participante_app_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_id_voucher_app_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_id_voucher_app_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_id_voucher_app_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_id_voucher_app_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_atendente_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_atendente_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_atendente_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_atendente_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_cia_ida_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_cia_ida_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_cia_ida_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_cia_ida_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_cia_volta_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_cia_volta_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_cia_volta_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_cia_volta_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_cpf_del_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_cpf_del();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_cpf_del_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_cpf_del_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_destino_ida_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_destino_ida_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_destino_ida_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_destino_ida_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_destino_volta_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_destino_volta_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_destino_volta_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_destino_volta_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_evento_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_evento_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_evento_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_evento_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_hotel_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_hotel_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_hotel_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_hotel_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_hotel_dsc_out_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_hotel_dsc_out();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_hotel_dsc_out_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_hotel_dsc_out_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_origem_ida_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_origem_ida_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_origem_ida_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_origem_ida_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_origem_volta_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_origem_volta_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_origem_volta_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_origem_volta_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_rodape_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_sql_log_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_sql_log();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_sql_log_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_sql_log_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_tipo_dsc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_tipo_dsc();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_tipo_dsc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_tipo_dsc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_ult_trecho_onblur(oThis, iSeqRow, event) {
  do_ajax_form_transfer_rsvp_validate_ult_trecho();
  scCssBlur(oThis);
}

function sc_form_transfer_rsvp_ult_trecho_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_transfer_rsvp_ult_trecho_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_transfer_rsvp_usuario_nivel_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
        if ("1" == block) {
                displayChange_block_1(status);
        }
        if ("2" == block) {
                displayChange_block_2(status);
        }
        if ("3" == block) {
                displayChange_block_3(status);
        }
        if ("4" == block) {
                displayChange_block_4(status);
        }
        if ("5" == block) {
                displayChange_block_5(status);
        }
        if ("6" == block) {
                displayChange_block_6(status);
        }
        if ("7" == block) {
                displayChange_block_7(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("tra_id_evento", "", status);
        displayChange_field("evento_dsc", "", status);
        displayChange_field("tra_cpf_particip", "", status);
        displayChange_field("tipo_dsc", "", status);
        displayChange_field("tra_id_usuario", "", status);
        displayChange_field("atendente_dsc", "", status);
        displayChange_field("tra_tipo", "", status);
        displayChange_field("tra_id_hotel", "", status);
        displayChange_field("hotel_dsc", "", status);
        displayChange_field("tra_id_hotel_out", "", status);
        displayChange_field("hotel_dsc_out", "", status);
        displayChange_field("enviar_app", "", status);
        displayChange_field("tra_status", "", status);
        displayChange_field("ult_trecho", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("tra_cia_ida", "", status);
        displayChange_field("cia_ida_dsc", "", status);
        displayChange_field("tra_numvoo_ida", "", status);
        displayChange_field("tra_origem_ida", "", status);
        displayChange_field("origem_ida_dsc", "", status);
        displayChange_field("tra_destino_ida", "", status);
        displayChange_field("destino_ida_dsc", "", status);
        displayChange_field("tra_dt_saida_ida", "", status);
        displayChange_field("tra_hr_saida_ida", "", status);
        displayChange_field("tra_dt_chegada_ida", "", status);
        displayChange_field("tra_hr_chegada_ida", "", status);
        displayChange_field("tra_localizador_ida", "", status);
        displayChange_field("tra_eticket_ida", "", status);
        displayChange_field("tra_flag_ida", "", status);
}

function displayChange_block_2(status) {
        displayChange_field("tra_cia_volta", "", status);
        displayChange_field("cia_volta_dsc", "", status);
        displayChange_field("tra_numvoo_volta", "", status);
        displayChange_field("tra_origem_volta", "", status);
        displayChange_field("origem_volta_dsc", "", status);
        displayChange_field("tra_destino_volta", "", status);
        displayChange_field("destino_volta_dsc", "", status);
        displayChange_field("tra_dt_saida_volta", "", status);
        displayChange_field("tra_hr_saida_volta", "", status);
        displayChange_field("tra_dt_chegada_volta", "", status);
        displayChange_field("tra_hr_chegada_volta", "", status);
        displayChange_field("tra_localizador_volta", "", status);
        displayChange_field("tra_eticket_volta", "", status);
        displayChange_field("tra_intervalo", "", status);
        displayChange_field("tra_hrtransout", "", status);
        displayChange_field("tra_flag_volta", "", status);
}

function displayChange_block_3(status) {
        displayChange_field("tra_dt_chegada_proprio", "", status);
        displayChange_field("tra_hr_chegada_proprio", "", status);
        displayChange_field("tra_flag_proprio", "", status);
}

function displayChange_block_4(status) {
        displayChange_field("tra_dt_ida_local", "", status);
        displayChange_field("tra_hr_ida_local", "", status);
        displayChange_field("tra_origem_ida_local", "", status);
        displayChange_field("tra_destino_ida_local", "", status);
        displayChange_field("tra_flag_ida_local", "", status);
        displayChange_field("tra_dt_volta_local", "", status);
        displayChange_field("tra_hr_volta_local", "", status);
        displayChange_field("tra_origem_volta_local", "", status);
        displayChange_field("tra_destino_volta_local", "", status);
        displayChange_field("tra_flag_volta_local", "", status);
}

function displayChange_block_5(status) {
        displayChange_field("tra_observacao", "", status);
        displayChange_field("tra_ativo", "", status);
        displayChange_field("tra_dt_alteracao", "", status);
        displayChange_field("cpf_del", "", status);
        displayChange_field("sql_log", "", status);
}

function displayChange_block_6(status) {
        displayChange_field("titulo_api", "", status);
        displayChange_field("descricao_api", "", status);
        displayChange_field("codigo_api", "", status);
        displayChange_field("tipo_api", "", status);
        displayChange_field("status_api", "", status);
        displayChange_field("valido_de_api", "", status);
        displayChange_field("valido_ate_api", "", status);
        displayChange_field("local_de_origem_api", "", status);
        displayChange_field("latitude_origem_api", "", status);
        displayChange_field("longitude_origem_api", "", status);
        displayChange_field("hr_saida_origem_api", "", status);
        displayChange_field("local_destino_api", "", status);
        displayChange_field("latitude_destino_api", "", status);
        displayChange_field("longitude_destino_api", "", status);
        displayChange_field("veiculo_api", "", status);
        displayChange_field("companhia_api", "", status);
        displayChange_field("nome_motorista_api", "", status);
        displayChange_field("contato_motorista_api", "", status);
        displayChange_field("matricula_api", "", status);
        displayChange_field("duracao_percurso_api", "", status);
        displayChange_field("comodidades_api", "", status);
        displayChange_field("observacao_api", "", status);
        displayChange_field("placa_veiculo_api", "", status);
        displayChange_field("id_evento_app", "", status);
        displayChange_field("id_participante_app", "", status);
        displayChange_field("id_voucher_app", "", status);
}

function displayChange_block_7(status) {
        displayChange_field("titulo_api_out", "", status);
        displayChange_field("descricao_api_out", "", status);
        displayChange_field("codigo_api_out", "", status);
        displayChange_field("tipo_api_out", "", status);
        displayChange_field("status_api_out", "", status);
        displayChange_field("valido_de_api_out", "", status);
        displayChange_field("valido_ate_api_out", "", status);
        displayChange_field("local_de_origem_api_out", "", status);
        displayChange_field("latitude_origem_api_out", "", status);
        displayChange_field("longitude_origem_api_out", "", status);
        displayChange_field("hr_saida_origem_api_out", "", status);
        displayChange_field("local_de_destino_api_out", "", status);
        displayChange_field("latitude_destino_api_out", "", status);
        displayChange_field("longitude_destino_api_out", "", status);
        displayChange_field("veiculo_api_out", "", status);
        displayChange_field("companhia_api_out", "", status);
        displayChange_field("nome_motorista_api_out", "", status);
        displayChange_field("contato_motorista_api_out", "", status);
        displayChange_field("matricula_api_out", "", status);
        displayChange_field("duracao_percurso_api_out", "", status);
        displayChange_field("comodidades_api_out", "", status);
        displayChange_field("observacao_api_out", "", status);
        displayChange_field("placa_veiculo_api_out", "", status);
        displayChange_field("id_evento_app_out", "", status);
        displayChange_field("id_participante_app_out", "", status);
        displayChange_field("id_voucher_app_out", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_tra_id_evento(row, status);
        displayChange_field_evento_dsc(row, status);
        displayChange_field_tra_cpf_particip(row, status);
        displayChange_field_tipo_dsc(row, status);
        displayChange_field_tra_id_usuario(row, status);
        displayChange_field_atendente_dsc(row, status);
        displayChange_field_tra_tipo(row, status);
        displayChange_field_tra_id_hotel(row, status);
        displayChange_field_hotel_dsc(row, status);
        displayChange_field_tra_id_hotel_out(row, status);
        displayChange_field_hotel_dsc_out(row, status);
        displayChange_field_enviar_app(row, status);
        displayChange_field_tra_status(row, status);
        displayChange_field_ult_trecho(row, status);
        displayChange_field_tra_cia_ida(row, status);
        displayChange_field_cia_ida_dsc(row, status);
        displayChange_field_tra_numvoo_ida(row, status);
        displayChange_field_tra_origem_ida(row, status);
        displayChange_field_origem_ida_dsc(row, status);
        displayChange_field_tra_destino_ida(row, status);
        displayChange_field_destino_ida_dsc(row, status);
        displayChange_field_tra_dt_saida_ida(row, status);
        displayChange_field_tra_hr_saida_ida(row, status);
        displayChange_field_tra_dt_chegada_ida(row, status);
        displayChange_field_tra_hr_chegada_ida(row, status);
        displayChange_field_tra_localizador_ida(row, status);
        displayChange_field_tra_eticket_ida(row, status);
        displayChange_field_tra_flag_ida(row, status);
        displayChange_field_tra_cia_volta(row, status);
        displayChange_field_cia_volta_dsc(row, status);
        displayChange_field_tra_numvoo_volta(row, status);
        displayChange_field_tra_origem_volta(row, status);
        displayChange_field_origem_volta_dsc(row, status);
        displayChange_field_tra_destino_volta(row, status);
        displayChange_field_destino_volta_dsc(row, status);
        displayChange_field_tra_dt_saida_volta(row, status);
        displayChange_field_tra_hr_saida_volta(row, status);
        displayChange_field_tra_dt_chegada_volta(row, status);
        displayChange_field_tra_hr_chegada_volta(row, status);
        displayChange_field_tra_localizador_volta(row, status);
        displayChange_field_tra_eticket_volta(row, status);
        displayChange_field_tra_intervalo(row, status);
        displayChange_field_tra_hrtransout(row, status);
        displayChange_field_tra_flag_volta(row, status);
        displayChange_field_tra_dt_chegada_proprio(row, status);
        displayChange_field_tra_hr_chegada_proprio(row, status);
        displayChange_field_tra_flag_proprio(row, status);
        displayChange_field_tra_dt_ida_local(row, status);
        displayChange_field_tra_hr_ida_local(row, status);
        displayChange_field_tra_origem_ida_local(row, status);
        displayChange_field_tra_destino_ida_local(row, status);
        displayChange_field_tra_flag_ida_local(row, status);
        displayChange_field_tra_dt_volta_local(row, status);
        displayChange_field_tra_hr_volta_local(row, status);
        displayChange_field_tra_origem_volta_local(row, status);
        displayChange_field_tra_destino_volta_local(row, status);
        displayChange_field_tra_flag_volta_local(row, status);
        displayChange_field_tra_observacao(row, status);
        displayChange_field_tra_ativo(row, status);
        displayChange_field_tra_dt_alteracao(row, status);
        displayChange_field_cpf_del(row, status);
        displayChange_field_sql_log(row, status);
        displayChange_field_titulo_api(row, status);
        displayChange_field_descricao_api(row, status);
        displayChange_field_codigo_api(row, status);
        displayChange_field_tipo_api(row, status);
        displayChange_field_status_api(row, status);
        displayChange_field_valido_de_api(row, status);
        displayChange_field_valido_ate_api(row, status);
        displayChange_field_local_de_origem_api(row, status);
        displayChange_field_latitude_origem_api(row, status);
        displayChange_field_longitude_origem_api(row, status);
        displayChange_field_hr_saida_origem_api(row, status);
        displayChange_field_local_destino_api(row, status);
        displayChange_field_latitude_destino_api(row, status);
        displayChange_field_longitude_destino_api(row, status);
        displayChange_field_veiculo_api(row, status);
        displayChange_field_companhia_api(row, status);
        displayChange_field_nome_motorista_api(row, status);
        displayChange_field_contato_motorista_api(row, status);
        displayChange_field_matricula_api(row, status);
        displayChange_field_duracao_percurso_api(row, status);
        displayChange_field_comodidades_api(row, status);
        displayChange_field_observacao_api(row, status);
        displayChange_field_placa_veiculo_api(row, status);
        displayChange_field_id_evento_app(row, status);
        displayChange_field_id_participante_app(row, status);
        displayChange_field_id_voucher_app(row, status);
        displayChange_field_titulo_api_out(row, status);
        displayChange_field_descricao_api_out(row, status);
        displayChange_field_codigo_api_out(row, status);
        displayChange_field_tipo_api_out(row, status);
        displayChange_field_status_api_out(row, status);
        displayChange_field_valido_de_api_out(row, status);
        displayChange_field_valido_ate_api_out(row, status);
        displayChange_field_local_de_origem_api_out(row, status);
        displayChange_field_latitude_origem_api_out(row, status);
        displayChange_field_longitude_origem_api_out(row, status);
        displayChange_field_hr_saida_origem_api_out(row, status);
        displayChange_field_local_de_destino_api_out(row, status);
        displayChange_field_latitude_destino_api_out(row, status);
        displayChange_field_longitude_destino_api_out(row, status);
        displayChange_field_veiculo_api_out(row, status);
        displayChange_field_companhia_api_out(row, status);
        displayChange_field_nome_motorista_api_out(row, status);
        displayChange_field_contato_motorista_api_out(row, status);
        displayChange_field_matricula_api_out(row, status);
        displayChange_field_duracao_percurso_api_out(row, status);
        displayChange_field_comodidades_api_out(row, status);
        displayChange_field_observacao_api_out(row, status);
        displayChange_field_placa_veiculo_api_out(row, status);
        displayChange_field_id_evento_app_out(row, status);
        displayChange_field_id_participante_app_out(row, status);
        displayChange_field_id_voucher_app_out(row, status);
}

function displayChange_field(field, row, status) {
        if ("tra_id_evento" == field) {
                displayChange_field_tra_id_evento(row, status);
        }
        if ("evento_dsc" == field) {
                displayChange_field_evento_dsc(row, status);
        }
        if ("tra_cpf_particip" == field) {
                displayChange_field_tra_cpf_particip(row, status);
        }
        if ("tipo_dsc" == field) {
                displayChange_field_tipo_dsc(row, status);
        }
        if ("tra_id_usuario" == field) {
                displayChange_field_tra_id_usuario(row, status);
        }
        if ("atendente_dsc" == field) {
                displayChange_field_atendente_dsc(row, status);
        }
        if ("tra_tipo" == field) {
                displayChange_field_tra_tipo(row, status);
        }
        if ("tra_id_hotel" == field) {
                displayChange_field_tra_id_hotel(row, status);
        }
        if ("hotel_dsc" == field) {
                displayChange_field_hotel_dsc(row, status);
        }
        if ("tra_id_hotel_out" == field) {
                displayChange_field_tra_id_hotel_out(row, status);
        }
        if ("hotel_dsc_out" == field) {
                displayChange_field_hotel_dsc_out(row, status);
        }
        if ("enviar_app" == field) {
                displayChange_field_enviar_app(row, status);
        }
        if ("tra_status" == field) {
                displayChange_field_tra_status(row, status);
        }
        if ("ult_trecho" == field) {
                displayChange_field_ult_trecho(row, status);
        }
        if ("tra_cia_ida" == field) {
                displayChange_field_tra_cia_ida(row, status);
        }
        if ("cia_ida_dsc" == field) {
                displayChange_field_cia_ida_dsc(row, status);
        }
        if ("tra_numvoo_ida" == field) {
                displayChange_field_tra_numvoo_ida(row, status);
        }
        if ("tra_origem_ida" == field) {
                displayChange_field_tra_origem_ida(row, status);
        }
        if ("origem_ida_dsc" == field) {
                displayChange_field_origem_ida_dsc(row, status);
        }
        if ("tra_destino_ida" == field) {
                displayChange_field_tra_destino_ida(row, status);
        }
        if ("destino_ida_dsc" == field) {
                displayChange_field_destino_ida_dsc(row, status);
        }
        if ("tra_dt_saida_ida" == field) {
                displayChange_field_tra_dt_saida_ida(row, status);
        }
        if ("tra_hr_saida_ida" == field) {
                displayChange_field_tra_hr_saida_ida(row, status);
        }
        if ("tra_dt_chegada_ida" == field) {
                displayChange_field_tra_dt_chegada_ida(row, status);
        }
        if ("tra_hr_chegada_ida" == field) {
                displayChange_field_tra_hr_chegada_ida(row, status);
        }
        if ("tra_localizador_ida" == field) {
                displayChange_field_tra_localizador_ida(row, status);
        }
        if ("tra_eticket_ida" == field) {
                displayChange_field_tra_eticket_ida(row, status);
        }
        if ("tra_flag_ida" == field) {
                displayChange_field_tra_flag_ida(row, status);
        }
        if ("tra_cia_volta" == field) {
                displayChange_field_tra_cia_volta(row, status);
        }
        if ("cia_volta_dsc" == field) {
                displayChange_field_cia_volta_dsc(row, status);
        }
        if ("tra_numvoo_volta" == field) {
                displayChange_field_tra_numvoo_volta(row, status);
        }
        if ("tra_origem_volta" == field) {
                displayChange_field_tra_origem_volta(row, status);
        }
        if ("origem_volta_dsc" == field) {
                displayChange_field_origem_volta_dsc(row, status);
        }
        if ("tra_destino_volta" == field) {
                displayChange_field_tra_destino_volta(row, status);
        }
        if ("destino_volta_dsc" == field) {
                displayChange_field_destino_volta_dsc(row, status);
        }
        if ("tra_dt_saida_volta" == field) {
                displayChange_field_tra_dt_saida_volta(row, status);
        }
        if ("tra_hr_saida_volta" == field) {
                displayChange_field_tra_hr_saida_volta(row, status);
        }
        if ("tra_dt_chegada_volta" == field) {
                displayChange_field_tra_dt_chegada_volta(row, status);
        }
        if ("tra_hr_chegada_volta" == field) {
                displayChange_field_tra_hr_chegada_volta(row, status);
        }
        if ("tra_localizador_volta" == field) {
                displayChange_field_tra_localizador_volta(row, status);
        }
        if ("tra_eticket_volta" == field) {
                displayChange_field_tra_eticket_volta(row, status);
        }
        if ("tra_intervalo" == field) {
                displayChange_field_tra_intervalo(row, status);
        }
        if ("tra_hrtransout" == field) {
                displayChange_field_tra_hrtransout(row, status);
        }
        if ("tra_flag_volta" == field) {
                displayChange_field_tra_flag_volta(row, status);
        }
        if ("tra_dt_chegada_proprio" == field) {
                displayChange_field_tra_dt_chegada_proprio(row, status);
        }
        if ("tra_hr_chegada_proprio" == field) {
                displayChange_field_tra_hr_chegada_proprio(row, status);
        }
        if ("tra_flag_proprio" == field) {
                displayChange_field_tra_flag_proprio(row, status);
        }
        if ("tra_dt_ida_local" == field) {
                displayChange_field_tra_dt_ida_local(row, status);
        }
        if ("tra_hr_ida_local" == field) {
                displayChange_field_tra_hr_ida_local(row, status);
        }
        if ("tra_origem_ida_local" == field) {
                displayChange_field_tra_origem_ida_local(row, status);
        }
        if ("tra_destino_ida_local" == field) {
                displayChange_field_tra_destino_ida_local(row, status);
        }
        if ("tra_flag_ida_local" == field) {
                displayChange_field_tra_flag_ida_local(row, status);
        }
        if ("tra_dt_volta_local" == field) {
                displayChange_field_tra_dt_volta_local(row, status);
        }
        if ("tra_hr_volta_local" == field) {
                displayChange_field_tra_hr_volta_local(row, status);
        }
        if ("tra_origem_volta_local" == field) {
                displayChange_field_tra_origem_volta_local(row, status);
        }
        if ("tra_destino_volta_local" == field) {
                displayChange_field_tra_destino_volta_local(row, status);
        }
        if ("tra_flag_volta_local" == field) {
                displayChange_field_tra_flag_volta_local(row, status);
        }
        if ("tra_observacao" == field) {
                displayChange_field_tra_observacao(row, status);
        }
        if ("tra_ativo" == field) {
                displayChange_field_tra_ativo(row, status);
        }
        if ("tra_dt_alteracao" == field) {
                displayChange_field_tra_dt_alteracao(row, status);
        }
        if ("cpf_del" == field) {
                displayChange_field_cpf_del(row, status);
        }
        if ("sql_log" == field) {
                displayChange_field_sql_log(row, status);
        }
        if ("titulo_api" == field) {
                displayChange_field_titulo_api(row, status);
        }
        if ("descricao_api" == field) {
                displayChange_field_descricao_api(row, status);
        }
        if ("codigo_api" == field) {
                displayChange_field_codigo_api(row, status);
        }
        if ("tipo_api" == field) {
                displayChange_field_tipo_api(row, status);
        }
        if ("status_api" == field) {
                displayChange_field_status_api(row, status);
        }
        if ("valido_de_api" == field) {
                displayChange_field_valido_de_api(row, status);
        }
        if ("valido_ate_api" == field) {
                displayChange_field_valido_ate_api(row, status);
        }
        if ("local_de_origem_api" == field) {
                displayChange_field_local_de_origem_api(row, status);
        }
        if ("latitude_origem_api" == field) {
                displayChange_field_latitude_origem_api(row, status);
        }
        if ("longitude_origem_api" == field) {
                displayChange_field_longitude_origem_api(row, status);
        }
        if ("hr_saida_origem_api" == field) {
                displayChange_field_hr_saida_origem_api(row, status);
        }
        if ("local_destino_api" == field) {
                displayChange_field_local_destino_api(row, status);
        }
        if ("latitude_destino_api" == field) {
                displayChange_field_latitude_destino_api(row, status);
        }
        if ("longitude_destino_api" == field) {
                displayChange_field_longitude_destino_api(row, status);
        }
        if ("veiculo_api" == field) {
                displayChange_field_veiculo_api(row, status);
        }
        if ("companhia_api" == field) {
                displayChange_field_companhia_api(row, status);
        }
        if ("nome_motorista_api" == field) {
                displayChange_field_nome_motorista_api(row, status);
        }
        if ("contato_motorista_api" == field) {
                displayChange_field_contato_motorista_api(row, status);
        }
        if ("matricula_api" == field) {
                displayChange_field_matricula_api(row, status);
        }
        if ("duracao_percurso_api" == field) {
                displayChange_field_duracao_percurso_api(row, status);
        }
        if ("comodidades_api" == field) {
                displayChange_field_comodidades_api(row, status);
        }
        if ("observacao_api" == field) {
                displayChange_field_observacao_api(row, status);
        }
        if ("placa_veiculo_api" == field) {
                displayChange_field_placa_veiculo_api(row, status);
        }
        if ("id_evento_app" == field) {
                displayChange_field_id_evento_app(row, status);
        }
        if ("id_participante_app" == field) {
                displayChange_field_id_participante_app(row, status);
        }
        if ("id_voucher_app" == field) {
                displayChange_field_id_voucher_app(row, status);
        }
        if ("titulo_api_out" == field) {
                displayChange_field_titulo_api_out(row, status);
        }
        if ("descricao_api_out" == field) {
                displayChange_field_descricao_api_out(row, status);
        }
        if ("codigo_api_out" == field) {
                displayChange_field_codigo_api_out(row, status);
        }
        if ("tipo_api_out" == field) {
                displayChange_field_tipo_api_out(row, status);
        }
        if ("status_api_out" == field) {
                displayChange_field_status_api_out(row, status);
        }
        if ("valido_de_api_out" == field) {
                displayChange_field_valido_de_api_out(row, status);
        }
        if ("valido_ate_api_out" == field) {
                displayChange_field_valido_ate_api_out(row, status);
        }
        if ("local_de_origem_api_out" == field) {
                displayChange_field_local_de_origem_api_out(row, status);
        }
        if ("latitude_origem_api_out" == field) {
                displayChange_field_latitude_origem_api_out(row, status);
        }
        if ("longitude_origem_api_out" == field) {
                displayChange_field_longitude_origem_api_out(row, status);
        }
        if ("hr_saida_origem_api_out" == field) {
                displayChange_field_hr_saida_origem_api_out(row, status);
        }
        if ("local_de_destino_api_out" == field) {
                displayChange_field_local_de_destino_api_out(row, status);
        }
        if ("latitude_destino_api_out" == field) {
                displayChange_field_latitude_destino_api_out(row, status);
        }
        if ("longitude_destino_api_out" == field) {
                displayChange_field_longitude_destino_api_out(row, status);
        }
        if ("veiculo_api_out" == field) {
                displayChange_field_veiculo_api_out(row, status);
        }
        if ("companhia_api_out" == field) {
                displayChange_field_companhia_api_out(row, status);
        }
        if ("nome_motorista_api_out" == field) {
                displayChange_field_nome_motorista_api_out(row, status);
        }
        if ("contato_motorista_api_out" == field) {
                displayChange_field_contato_motorista_api_out(row, status);
        }
        if ("matricula_api_out" == field) {
                displayChange_field_matricula_api_out(row, status);
        }
        if ("duracao_percurso_api_out" == field) {
                displayChange_field_duracao_percurso_api_out(row, status);
        }
        if ("comodidades_api_out" == field) {
                displayChange_field_comodidades_api_out(row, status);
        }
        if ("observacao_api_out" == field) {
                displayChange_field_observacao_api_out(row, status);
        }
        if ("placa_veiculo_api_out" == field) {
                displayChange_field_placa_veiculo_api_out(row, status);
        }
        if ("id_evento_app_out" == field) {
                displayChange_field_id_evento_app_out(row, status);
        }
        if ("id_participante_app_out" == field) {
                displayChange_field_id_participante_app_out(row, status);
        }
        if ("id_voucher_app_out" == field) {
                displayChange_field_id_voucher_app_out(row, status);
        }
}

function displayChange_field_tra_id_evento(row, status) {
    var fieldId;
}

function displayChange_field_evento_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_cpf_particip(row, status) {
    var fieldId;
}

function displayChange_field_tipo_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_id_usuario(row, status) {
    var fieldId;
}

function displayChange_field_atendente_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_tipo(row, status) {
    var fieldId;
}

function displayChange_field_tra_id_hotel(row, status) {
    var fieldId;
}

function displayChange_field_hotel_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_id_hotel_out(row, status) {
    var fieldId;
}

function displayChange_field_hotel_dsc_out(row, status) {
    var fieldId;
}

function displayChange_field_enviar_app(row, status) {
    var fieldId;
}

function displayChange_field_tra_status(row, status) {
    var fieldId;
}

function displayChange_field_ult_trecho(row, status) {
    var fieldId;
}

function displayChange_field_tra_cia_ida(row, status) {
    var fieldId;
}

function displayChange_field_cia_ida_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_numvoo_ida(row, status) {
    var fieldId;
}

function displayChange_field_tra_origem_ida(row, status) {
    var fieldId;
}

function displayChange_field_origem_ida_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_destino_ida(row, status) {
    var fieldId;
}

function displayChange_field_destino_ida_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_dt_saida_ida(row, status) {
    var fieldId;
}

function displayChange_field_tra_hr_saida_ida(row, status) {
    var fieldId;
}

function displayChange_field_tra_dt_chegada_ida(row, status) {
    var fieldId;
}

function displayChange_field_tra_hr_chegada_ida(row, status) {
    var fieldId;
}

function displayChange_field_tra_localizador_ida(row, status) {
    var fieldId;
}

function displayChange_field_tra_eticket_ida(row, status) {
    var fieldId;
}

function displayChange_field_tra_flag_ida(row, status) {
    var fieldId;
}

function displayChange_field_tra_cia_volta(row, status) {
    var fieldId;
}

function displayChange_field_cia_volta_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_numvoo_volta(row, status) {
    var fieldId;
}

function displayChange_field_tra_origem_volta(row, status) {
    var fieldId;
}

function displayChange_field_origem_volta_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_destino_volta(row, status) {
    var fieldId;
}

function displayChange_field_destino_volta_dsc(row, status) {
    var fieldId;
}

function displayChange_field_tra_dt_saida_volta(row, status) {
    var fieldId;
}

function displayChange_field_tra_hr_saida_volta(row, status) {
    var fieldId;
}

function displayChange_field_tra_dt_chegada_volta(row, status) {
    var fieldId;
}

function displayChange_field_tra_hr_chegada_volta(row, status) {
    var fieldId;
}

function displayChange_field_tra_localizador_volta(row, status) {
    var fieldId;
}

function displayChange_field_tra_eticket_volta(row, status) {
    var fieldId;
}

function displayChange_field_tra_intervalo(row, status) {
    var fieldId;
}

function displayChange_field_tra_hrtransout(row, status) {
    var fieldId;
}

function displayChange_field_tra_flag_volta(row, status) {
    var fieldId;
}

function displayChange_field_tra_dt_chegada_proprio(row, status) {
    var fieldId;
}

function displayChange_field_tra_hr_chegada_proprio(row, status) {
    var fieldId;
}

function displayChange_field_tra_flag_proprio(row, status) {
    var fieldId;
}

function displayChange_field_tra_dt_ida_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_hr_ida_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_origem_ida_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_destino_ida_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_flag_ida_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_dt_volta_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_hr_volta_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_origem_volta_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_destino_volta_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_flag_volta_local(row, status) {
    var fieldId;
}

function displayChange_field_tra_observacao(row, status) {
    var fieldId;
}

function displayChange_field_tra_ativo(row, status) {
    var fieldId;
}

function displayChange_field_tra_dt_alteracao(row, status) {
    var fieldId;
}

function displayChange_field_cpf_del(row, status) {
    var fieldId;
}

function displayChange_field_sql_log(row, status) {
    var fieldId;
}

function displayChange_field_titulo_api(row, status) {
    var fieldId;
}

function displayChange_field_descricao_api(row, status) {
    var fieldId;
}

function displayChange_field_codigo_api(row, status) {
    var fieldId;
}

function displayChange_field_tipo_api(row, status) {
    var fieldId;
}

function displayChange_field_status_api(row, status) {
    var fieldId;
}

function displayChange_field_valido_de_api(row, status) {
    var fieldId;
}

function displayChange_field_valido_ate_api(row, status) {
    var fieldId;
}

function displayChange_field_local_de_origem_api(row, status) {
    var fieldId;
}

function displayChange_field_latitude_origem_api(row, status) {
    var fieldId;
}

function displayChange_field_longitude_origem_api(row, status) {
    var fieldId;
}

function displayChange_field_hr_saida_origem_api(row, status) {
    var fieldId;
}

function displayChange_field_local_destino_api(row, status) {
    var fieldId;
}

function displayChange_field_latitude_destino_api(row, status) {
    var fieldId;
}

function displayChange_field_longitude_destino_api(row, status) {
    var fieldId;
}

function displayChange_field_veiculo_api(row, status) {
    var fieldId;
}

function displayChange_field_companhia_api(row, status) {
    var fieldId;
}

function displayChange_field_nome_motorista_api(row, status) {
    var fieldId;
}

function displayChange_field_contato_motorista_api(row, status) {
    var fieldId;
}

function displayChange_field_matricula_api(row, status) {
    var fieldId;
}

function displayChange_field_duracao_percurso_api(row, status) {
    var fieldId;
}

function displayChange_field_comodidades_api(row, status) {
    var fieldId;
}

function displayChange_field_observacao_api(row, status) {
    var fieldId;
}

function displayChange_field_placa_veiculo_api(row, status) {
    var fieldId;
}

function displayChange_field_id_evento_app(row, status) {
    var fieldId;
}

function displayChange_field_id_participante_app(row, status) {
    var fieldId;
}

function displayChange_field_id_voucher_app(row, status) {
    var fieldId;
}

function displayChange_field_titulo_api_out(row, status) {
    var fieldId;
}

function displayChange_field_descricao_api_out(row, status) {
    var fieldId;
}

function displayChange_field_codigo_api_out(row, status) {
    var fieldId;
}

function displayChange_field_tipo_api_out(row, status) {
    var fieldId;
}

function displayChange_field_status_api_out(row, status) {
    var fieldId;
}

function displayChange_field_valido_de_api_out(row, status) {
    var fieldId;
}

function displayChange_field_valido_ate_api_out(row, status) {
    var fieldId;
}

function displayChange_field_local_de_origem_api_out(row, status) {
    var fieldId;
}

function displayChange_field_latitude_origem_api_out(row, status) {
    var fieldId;
}

function displayChange_field_longitude_origem_api_out(row, status) {
    var fieldId;
}

function displayChange_field_hr_saida_origem_api_out(row, status) {
    var fieldId;
}

function displayChange_field_local_de_destino_api_out(row, status) {
    var fieldId;
}

function displayChange_field_latitude_destino_api_out(row, status) {
    var fieldId;
}

function displayChange_field_longitude_destino_api_out(row, status) {
    var fieldId;
}

function displayChange_field_veiculo_api_out(row, status) {
    var fieldId;
}

function displayChange_field_companhia_api_out(row, status) {
    var fieldId;
}

function displayChange_field_nome_motorista_api_out(row, status) {
    var fieldId;
}

function displayChange_field_contato_motorista_api_out(row, status) {
    var fieldId;
}

function displayChange_field_matricula_api_out(row, status) {
    var fieldId;
}

function displayChange_field_duracao_percurso_api_out(row, status) {
    var fieldId;
}

function displayChange_field_comodidades_api_out(row, status) {
    var fieldId;
}

function displayChange_field_observacao_api_out(row, status) {
    var fieldId;
}

function displayChange_field_placa_veiculo_api_out(row, status) {
    var fieldId;
}

function displayChange_field_id_evento_app_out(row, status) {
    var fieldId;
}

function displayChange_field_id_participante_app_out(row, status) {
    var fieldId;
}

function displayChange_field_id_voucher_app_out(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_transfer_rsvp_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(29);
                }
        }
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_tra_dt_chegada_proprio" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_tra_dt_chegada_proprio" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_tra_dt_chegada_proprio" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_transfer_rsvp_validate_tra_dt_chegada_proprio(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['tra_dt_chegada_proprio']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_tra_dt_ida_local" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_tra_dt_ida_local" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_tra_dt_ida_local" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_transfer_rsvp_validate_tra_dt_ida_local(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['tra_dt_ida_local']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_tra_dt_volta_local" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_tra_dt_volta_local" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_tra_dt_volta_local" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_transfer_rsvp_validate_tra_dt_volta_local(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['tra_dt_volta_local']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_transfer_rsvp')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_transfer_rsvp');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_transfer_rsvp');
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

