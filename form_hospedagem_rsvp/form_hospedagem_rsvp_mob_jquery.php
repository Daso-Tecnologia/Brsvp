
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
     if (sField == 'hosp_id_hotel') {
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
  scEventControl_data["hosp_dt_checkin" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_dt_checkout" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_hr_checkin" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_hr_checkout" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_early_chkin" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_late_chkout" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hospedagem_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_id_evento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_cpf_participante" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_pessoa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enviar_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_id_hotel" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_acomodacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_categoria" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_status" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_part_acomp" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_qtd_acompanhante" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_acompanhante" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_reserva_bvt" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["conta_roomlist" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["titulo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["descricao_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["codigo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valido_de_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valido_ate_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nome_hotel_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["checkin_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["checkout_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["acomodacao_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["endereco_hotel_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["qtd_hospedes_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["qtd_noites_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cafe_manha_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["comodidades_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["codigo_reserva_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["telefone_hotel_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["andar_hotel_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["late_checkout_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["minibar_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["estacionamento_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["chackin_online_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["senha_wifi_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_evento_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_participante_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_voucher_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_pagamentos" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_diarias" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_taxas" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_total" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_dsc_pacote" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_id_usuario" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_alteracao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_observacoes" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hosp_ativo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["acmq_01" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["acmq_02" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["acmq_03" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["acmq_04" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["pamq_01" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["pamq_02" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["pamq_03" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["pamq_04" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cpf_del" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sql_log" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["hosp_dt_checkin" + iSeqRow] && scEventControl_data["hosp_dt_checkin" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_dt_checkin" + iSeqRow] && scEventControl_data["hosp_dt_checkin" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_dt_checkout" + iSeqRow] && scEventControl_data["hosp_dt_checkout" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_dt_checkout" + iSeqRow] && scEventControl_data["hosp_dt_checkout" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_hr_checkin" + iSeqRow] && scEventControl_data["hosp_hr_checkin" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_hr_checkin" + iSeqRow] && scEventControl_data["hosp_hr_checkin" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_hr_checkout" + iSeqRow] && scEventControl_data["hosp_hr_checkout" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_hr_checkout" + iSeqRow] && scEventControl_data["hosp_hr_checkout" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_early_chkin" + iSeqRow] && scEventControl_data["hosp_early_chkin" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_early_chkin" + iSeqRow] && scEventControl_data["hosp_early_chkin" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_late_chkout" + iSeqRow] && scEventControl_data["hosp_late_chkout" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_late_chkout" + iSeqRow] && scEventControl_data["hosp_late_chkout" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hospedagem_id" + iSeqRow] && scEventControl_data["hospedagem_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hospedagem_id" + iSeqRow] && scEventControl_data["hospedagem_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_id_evento" + iSeqRow] && scEventControl_data["hosp_id_evento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_id_evento" + iSeqRow] && scEventControl_data["hosp_id_evento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_cpf_participante" + iSeqRow] && scEventControl_data["hosp_cpf_participante" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_cpf_participante" + iSeqRow] && scEventControl_data["hosp_cpf_participante" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_pessoa" + iSeqRow] && scEventControl_data["tipo_pessoa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_pessoa" + iSeqRow] && scEventControl_data["tipo_pessoa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enviar_app" + iSeqRow] && scEventControl_data["enviar_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enviar_app" + iSeqRow] && scEventControl_data["enviar_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_id_hotel" + iSeqRow] && scEventControl_data["hosp_id_hotel" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_id_hotel" + iSeqRow] && scEventControl_data["hosp_id_hotel" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_acomodacao" + iSeqRow] && scEventControl_data["hosp_acomodacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_acomodacao" + iSeqRow] && scEventControl_data["hosp_acomodacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_categoria" + iSeqRow] && scEventControl_data["hosp_categoria" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_categoria" + iSeqRow] && scEventControl_data["hosp_categoria" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_status" + iSeqRow] && scEventControl_data["hosp_status" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_status" + iSeqRow] && scEventControl_data["hosp_status" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_part_acomp" + iSeqRow] && scEventControl_data["hosp_part_acomp" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_part_acomp" + iSeqRow] && scEventControl_data["hosp_part_acomp" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_qtd_acompanhante" + iSeqRow] && scEventControl_data["hosp_qtd_acompanhante" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_qtd_acompanhante" + iSeqRow] && scEventControl_data["hosp_qtd_acompanhante" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_acompanhante" + iSeqRow] && scEventControl_data["hosp_acompanhante" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_acompanhante" + iSeqRow] && scEventControl_data["hosp_acompanhante" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_reserva_bvt" + iSeqRow] && scEventControl_data["hosp_reserva_bvt" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_reserva_bvt" + iSeqRow] && scEventControl_data["hosp_reserva_bvt" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["conta_roomlist" + iSeqRow] && scEventControl_data["conta_roomlist" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["conta_roomlist" + iSeqRow] && scEventControl_data["conta_roomlist" + iSeqRow]["change"]) {
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
  if (scEventControl_data["nome_hotel_api" + iSeqRow] && scEventControl_data["nome_hotel_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome_hotel_api" + iSeqRow] && scEventControl_data["nome_hotel_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["checkin_api" + iSeqRow] && scEventControl_data["checkin_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["checkin_api" + iSeqRow] && scEventControl_data["checkin_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["checkout_api" + iSeqRow] && scEventControl_data["checkout_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["checkout_api" + iSeqRow] && scEventControl_data["checkout_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["acomodacao_api" + iSeqRow] && scEventControl_data["acomodacao_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["acomodacao_api" + iSeqRow] && scEventControl_data["acomodacao_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["endereco_hotel_api" + iSeqRow] && scEventControl_data["endereco_hotel_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["endereco_hotel_api" + iSeqRow] && scEventControl_data["endereco_hotel_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["qtd_hospedes_api" + iSeqRow] && scEventControl_data["qtd_hospedes_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["qtd_hospedes_api" + iSeqRow] && scEventControl_data["qtd_hospedes_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["qtd_noites_api" + iSeqRow] && scEventControl_data["qtd_noites_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["qtd_noites_api" + iSeqRow] && scEventControl_data["qtd_noites_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cafe_manha_api" + iSeqRow] && scEventControl_data["cafe_manha_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cafe_manha_api" + iSeqRow] && scEventControl_data["cafe_manha_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["comodidades_api" + iSeqRow] && scEventControl_data["comodidades_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["comodidades_api" + iSeqRow] && scEventControl_data["comodidades_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["codigo_reserva_api" + iSeqRow] && scEventControl_data["codigo_reserva_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["codigo_reserva_api" + iSeqRow] && scEventControl_data["codigo_reserva_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["telefone_hotel_api" + iSeqRow] && scEventControl_data["telefone_hotel_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["telefone_hotel_api" + iSeqRow] && scEventControl_data["telefone_hotel_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["andar_hotel_api" + iSeqRow] && scEventControl_data["andar_hotel_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["andar_hotel_api" + iSeqRow] && scEventControl_data["andar_hotel_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["late_checkout_api" + iSeqRow] && scEventControl_data["late_checkout_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["late_checkout_api" + iSeqRow] && scEventControl_data["late_checkout_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["minibar_api" + iSeqRow] && scEventControl_data["minibar_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["minibar_api" + iSeqRow] && scEventControl_data["minibar_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["estacionamento_api" + iSeqRow] && scEventControl_data["estacionamento_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["estacionamento_api" + iSeqRow] && scEventControl_data["estacionamento_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["chackin_online_api" + iSeqRow] && scEventControl_data["chackin_online_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["chackin_online_api" + iSeqRow] && scEventControl_data["chackin_online_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["senha_wifi_api" + iSeqRow] && scEventControl_data["senha_wifi_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["senha_wifi_api" + iSeqRow] && scEventControl_data["senha_wifi_api" + iSeqRow]["change"]) {
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
  if (scEventControl_data["hosp_pagamentos" + iSeqRow] && scEventControl_data["hosp_pagamentos" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_pagamentos" + iSeqRow] && scEventControl_data["hosp_pagamentos" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_diarias" + iSeqRow] && scEventControl_data["hosp_diarias" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_diarias" + iSeqRow] && scEventControl_data["hosp_diarias" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_taxas" + iSeqRow] && scEventControl_data["hosp_taxas" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_taxas" + iSeqRow] && scEventControl_data["hosp_taxas" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_total" + iSeqRow] && scEventControl_data["hosp_total" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_total" + iSeqRow] && scEventControl_data["hosp_total" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_dsc_pacote" + iSeqRow] && scEventControl_data["hosp_dsc_pacote" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_dsc_pacote" + iSeqRow] && scEventControl_data["hosp_dsc_pacote" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_id_usuario" + iSeqRow] && scEventControl_data["hosp_id_usuario" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_id_usuario" + iSeqRow] && scEventControl_data["hosp_id_usuario" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_alteracao" + iSeqRow] && scEventControl_data["hosp_alteracao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_alteracao" + iSeqRow] && scEventControl_data["hosp_alteracao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_observacoes" + iSeqRow] && scEventControl_data["hosp_observacoes" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_observacoes" + iSeqRow] && scEventControl_data["hosp_observacoes" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hosp_ativo" + iSeqRow] && scEventControl_data["hosp_ativo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hosp_ativo" + iSeqRow] && scEventControl_data["hosp_ativo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["acmq_01" + iSeqRow] && scEventControl_data["acmq_01" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["acmq_01" + iSeqRow] && scEventControl_data["acmq_01" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["acmq_02" + iSeqRow] && scEventControl_data["acmq_02" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["acmq_02" + iSeqRow] && scEventControl_data["acmq_02" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["acmq_03" + iSeqRow] && scEventControl_data["acmq_03" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["acmq_03" + iSeqRow] && scEventControl_data["acmq_03" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["acmq_04" + iSeqRow] && scEventControl_data["acmq_04" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["acmq_04" + iSeqRow] && scEventControl_data["acmq_04" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pamq_01" + iSeqRow] && scEventControl_data["pamq_01" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pamq_01" + iSeqRow] && scEventControl_data["pamq_01" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pamq_02" + iSeqRow] && scEventControl_data["pamq_02" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pamq_02" + iSeqRow] && scEventControl_data["pamq_02" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pamq_03" + iSeqRow] && scEventControl_data["pamq_03" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pamq_03" + iSeqRow] && scEventControl_data["pamq_03" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pamq_04" + iSeqRow] && scEventControl_data["pamq_04" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pamq_04" + iSeqRow] && scEventControl_data["pamq_04" + iSeqRow]["change"]) {
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
  if ("hosp_total" + iSeq == fieldName) {
    _scCalculatorBlurOk[fieldId] = false;
  }
  scEventControl_data[fieldName]["blur"] = true;
  if ("hosp_id_hotel" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hosp_acomodacao" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hosp_categoria" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hosp_status" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hosp_qtd_acompanhante" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hosp_reserva_bvt" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("conta_roomlist" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hosp_pagamentos" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hosp_ativo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("conta_roomlist" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_acomodacao" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_acompanhante" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_categoria" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_diarias" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_dt_checkout" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_id_hotel" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_part_acomp" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_qtd_acompanhante" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_status" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hosp_taxas" + iSeq == fieldName) {
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

function scEventControl_onCalculator_hosp_total() {
  if (!_scCalculatorControl["id_sc_field_hosp_total"]) {
    _scCalculatorBlurOk["id_sc_field_hosp_total"] = true;
    do_ajax_form_hospedagem_rsvp_mob_event_hosp_total_onblur();
  }
} // scEventControl_onCalculator_hosp_total

var scEventControl_data = {};

function scJQEventsAdd(iSeqRow) {
  $('#id_sc_field_hospedagem_id' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hospedagem_id_onblur('#id_sc_field_hospedagem_id' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_hospedagem_rsvp_hospedagem_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_id_evento' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_id_evento_onblur('#id_sc_field_hosp_id_evento' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_hospedagem_rsvp_hosp_id_evento_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_id_evento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_id_usuario' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_id_usuario_onblur('#id_sc_field_hosp_id_usuario' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_hospedagem_rsvp_hosp_id_usuario_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_id_usuario_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_cpf_participante' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_cpf_participante_onblur('#id_sc_field_hosp_cpf_participante' + iSeqRow, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_cpf_participante_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_id_hotel' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_hospedagem_rsvp_hosp_id_hotel_onblur('#id_sc_field_hosp_id_hotel' + iSeqRow, iSeqRow, event);}, 300) })
                                           .bind('change', function() { sc_form_hospedagem_rsvp_hosp_id_hotel_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_id_hotel_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_acomodacao' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_hospedagem_rsvp_hosp_acomodacao_onblur('#id_sc_field_hosp_acomodacao' + iSeqRow, iSeqRow, event);}, 300) })
                                             .bind('change', function() { sc_form_hospedagem_rsvp_hosp_acomodacao_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_acomodacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_categoria' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_hospedagem_rsvp_hosp_categoria_onblur('#id_sc_field_hosp_categoria' + iSeqRow, iSeqRow, event);}, 300) })
                                            .bind('change', function() { sc_form_hospedagem_rsvp_hosp_categoria_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_categoria_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_pagamentos' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_pagamentos_onblur('#id_sc_field_hosp_pagamentos' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_pagamentos_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_status' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_status_onblur('#id_sc_field_hosp_status' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_hospedagem_rsvp_hosp_status_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_status_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_qtd_acompanhante' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_hospedagem_rsvp_hosp_qtd_acompanhante_onblur('#id_sc_field_hosp_qtd_acompanhante' + iSeqRow, iSeqRow, event);}, 300) })
                                                   .bind('change', function() { sc_form_hospedagem_rsvp_hosp_qtd_acompanhante_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_qtd_acompanhante_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_dt_checkin' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_dt_checkin_onblur('#id_sc_field_hosp_dt_checkin' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_dt_checkin_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_dt_checkout' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_dt_checkout_onblur('#id_sc_field_hosp_dt_checkout' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_hospedagem_rsvp_hosp_dt_checkout_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_dt_checkout_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_checkin' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_hr_checkin_onblur('#id_sc_field_hosp_hr_checkin' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_hr_checkin_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_hr_checkout' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_hr_checkout_onblur('#id_sc_field_hosp_hr_checkout' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_hr_checkout_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_early_chkin' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_early_chkin_onblur('#id_sc_field_hosp_early_chkin' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_early_chkin_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_late_chkout' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_late_chkout_onblur('#id_sc_field_hosp_late_chkout' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_late_chkout_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_diarias' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_diarias_onblur('#id_sc_field_hosp_diarias' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_form_hospedagem_rsvp_hosp_diarias_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_diarias_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_taxas' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_taxas_onblur('#id_sc_field_hosp_taxas' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_hospedagem_rsvp_hosp_taxas_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_taxas_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_total' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_total_onblur('#id_sc_field_hosp_total' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_total_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_observacoes' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_observacoes_onblur('#id_sc_field_hosp_observacoes' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_observacoes_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_dsc_pacote' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_dsc_pacote_onblur('#id_sc_field_hosp_dsc_pacote' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_dsc_pacote_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_alteracao' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_alteracao_onblur('#id_sc_field_hosp_alteracao' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_alteracao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_alteracao_hora' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_alteracao_onblur('#id_sc_field_hosp_alteracao' + iSeqRow, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_alteracao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_ativo' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_ativo_onblur('#id_sc_field_hosp_ativo' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_ativo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hosp_reserva_bvt' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_hosp_reserva_bvt_onblur('#id_sc_field_hosp_reserva_bvt' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_hospedagem_rsvp_hosp_reserva_bvt_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_conta_roomlist' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_conta_roomlist_onblur('#id_sc_field_conta_roomlist' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_hospedagem_rsvp_conta_roomlist_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_conta_roomlist_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_acmq_01' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_acmq_01_onblur('#id_sc_field_acmq_01' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_acmq_01_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_acmq_02' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_acmq_02_onblur('#id_sc_field_acmq_02' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_acmq_02_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_acmq_03' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_acmq_03_onblur('#id_sc_field_acmq_03' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_acmq_03_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_acmq_04' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_acmq_04_onblur('#id_sc_field_acmq_04' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_acmq_04_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_pamq_01' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_pamq_01_onblur('#id_sc_field_pamq_01' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_pamq_01_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_pamq_02' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_pamq_02_onblur('#id_sc_field_pamq_02' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_pamq_02_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_pamq_03' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_pamq_03_onblur('#id_sc_field_pamq_03' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_pamq_03_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_pamq_04' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_pamq_04_onblur('#id_sc_field_pamq_04' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_pamq_04_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_titulo_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_titulo_api_onblur('#id_sc_field_titulo_api' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_hospedagem_rsvp_titulo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_descricao_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_descricao_api_onblur('#id_sc_field_descricao_api' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_hospedagem_rsvp_descricao_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_codigo_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_codigo_api_onblur('#id_sc_field_codigo_api' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_hospedagem_rsvp_codigo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_valido_de_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_valido_de_api_onblur('#id_sc_field_valido_de_api' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_hospedagem_rsvp_valido_de_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_valido_ate_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_valido_ate_api_onblur('#id_sc_field_valido_ate_api' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_valido_ate_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome_hotel_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_nome_hotel_api_onblur('#id_sc_field_nome_hotel_api' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_nome_hotel_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_endereco_hotel_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_endereco_hotel_api_onblur('#id_sc_field_endereco_hotel_api' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_hospedagem_rsvp_endereco_hotel_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_checkin_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_checkin_api_onblur('#id_sc_field_checkin_api' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_hospedagem_rsvp_checkin_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_checkout_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_checkout_api_onblur('#id_sc_field_checkout_api' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_hospedagem_rsvp_checkout_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_acomodacao_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_acomodacao_api_onblur('#id_sc_field_acomodacao_api' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_acomodacao_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_qtd_hospedes_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_qtd_hospedes_api_onblur('#id_sc_field_qtd_hospedes_api' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_hospedagem_rsvp_qtd_hospedes_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_qtd_noites_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_qtd_noites_api_onblur('#id_sc_field_qtd_noites_api' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_qtd_noites_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cafe_manha_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_cafe_manha_api_onblur('#id_sc_field_cafe_manha_api' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_cafe_manha_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_comodidades_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_comodidades_api_onblur('#id_sc_field_comodidades_api' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_hospedagem_rsvp_comodidades_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_codigo_reserva_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_codigo_reserva_api_onblur('#id_sc_field_codigo_reserva_api' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_hospedagem_rsvp_codigo_reserva_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_telefone_hotel_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_telefone_hotel_api_onblur('#id_sc_field_telefone_hotel_api' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_hospedagem_rsvp_telefone_hotel_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_andar_hotel_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_andar_hotel_api_onblur('#id_sc_field_andar_hotel_api' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_hospedagem_rsvp_andar_hotel_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_late_checkout_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_late_checkout_api_onblur('#id_sc_field_late_checkout_api' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_hospedagem_rsvp_late_checkout_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_minibar_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_minibar_api_onblur('#id_sc_field_minibar_api' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_hospedagem_rsvp_minibar_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_estacionamento_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_estacionamento_api_onblur('#id_sc_field_estacionamento_api' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_hospedagem_rsvp_estacionamento_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_senha_wifi_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_senha_wifi_api_onblur('#id_sc_field_senha_wifi_api' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_senha_wifi_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_chackin_online_api' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_chackin_online_api_onblur('#id_sc_field_chackin_online_api' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_hospedagem_rsvp_chackin_online_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_evento_app' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_id_evento_app_onblur('#id_sc_field_id_evento_app' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_hospedagem_rsvp_id_evento_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_participante_app' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_id_participante_app_onblur('#id_sc_field_id_participante_app' + iSeqRow, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_hospedagem_rsvp_id_participante_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_voucher_app' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_id_voucher_app_onblur('#id_sc_field_id_voucher_app' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_hospedagem_rsvp_id_voucher_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_enviar_app' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_enviar_app_onblur('#id_sc_field_enviar_app' + iSeqRow, iSeqRow, event) })
                                        .bind('click', function() { sc_form_hospedagem_rsvp_enviar_app_onclick(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_hospedagem_rsvp_enviar_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cpf_del' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_cpf_del_onblur('#id_sc_field_cpf_del' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_cpf_del_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_sql_log' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_sql_log_onblur('#id_sc_field_sql_log' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_hospedagem_rsvp_sql_log_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tipo_pessoa' + iSeqRow).bind('blur', function() { sc_form_hospedagem_rsvp_tipo_pessoa_onblur('#id_sc_field_tipo_pessoa' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_hospedagem_rsvp_tipo_pessoa_onfocus(this, iSeqRow, event) });
  $('.sc-ui-radio-hosp_early_chkin' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hosp_late_chkout' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-enviar_app' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_hospedagem_rsvp_hospedagem_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hospedagem_id();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hospedagem_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_id_evento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_id_evento();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_id_evento_onchange(oThis, iSeqRow, event) {
  lookup_hosp_id_evento();
}

function sc_form_hospedagem_rsvp_hosp_id_evento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_id_usuario_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_id_usuario();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_id_usuario_onchange(oThis, iSeqRow, event) {
  lookup_hosp_id_usuario();
}

function sc_form_hospedagem_rsvp_hosp_id_usuario_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_cpf_participante_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_cpf_participante();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_cpf_participante_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_id_hotel_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_id_hotel();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_id_hotel_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_id_hotel_onchange();
}

function sc_form_hospedagem_rsvp_hosp_id_hotel_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_acomodacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_acomodacao();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_acomodacao_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_acomodacao_onchange();
}

function sc_form_hospedagem_rsvp_hosp_acomodacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_categoria_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_categoria();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_categoria_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_categoria_onchange();
}

function sc_form_hospedagem_rsvp_hosp_categoria_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_pagamentos_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_pagamentos();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_pagamentos_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_status_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_status();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_status_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_status_onchange();
}

function sc_form_hospedagem_rsvp_hosp_status_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_acompanhante_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_acompanhante();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_acompanhante_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_acompanhante_onchange();
}

function sc_form_hospedagem_rsvp_hosp_acompanhante_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_qtd_acompanhante_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_qtd_acompanhante();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_qtd_acompanhante_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_qtd_acompanhante_onchange();
}

function sc_form_hospedagem_rsvp_hosp_qtd_acompanhante_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_dt_checkin_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_dt_checkin();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_dt_checkin_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_dt_checkout_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_dt_checkout();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_dt_checkout_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_dt_checkout_onchange();
}

function sc_form_hospedagem_rsvp_hosp_dt_checkout_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_hr_checkin_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_hr_checkin();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_hr_checkin_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_hr_checkout_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_hr_checkout();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_hr_checkout_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_early_chkin_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_early_chkin();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_early_chkin_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_late_chkout_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_late_chkout();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_late_chkout_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_diarias_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_diarias();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_diarias_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_diarias_onchange();
}

function sc_form_hospedagem_rsvp_hosp_diarias_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_taxas_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_taxas();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_taxas_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_taxas_onchange();
}

function sc_form_hospedagem_rsvp_hosp_taxas_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_total_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_total();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_total_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_observacoes_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_observacoes();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_observacoes_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_dsc_pacote_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_dsc_pacote();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_dsc_pacote_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_alteracao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_alteracao();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_alteracao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_alteracao();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_alteracao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_alteracao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_ativo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_ativo();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_ativo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_part_acomp_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_part_acomp();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_part_acomp_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_hosp_part_acomp_onchange();
}

function sc_form_hospedagem_rsvp_hosp_part_acomp_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_hosp_reserva_bvt_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_hosp_reserva_bvt();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_hosp_reserva_bvt_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_conta_roomlist_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_conta_roomlist();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_conta_roomlist_onchange(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_conta_roomlist_onchange();
}

function sc_form_hospedagem_rsvp_conta_roomlist_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_acmq_01_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_acmq_01();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_acmq_01_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_acmq_02_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_acmq_02();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_acmq_02_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_acmq_03_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_acmq_03();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_acmq_03_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_acmq_04_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_acmq_04();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_acmq_04_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_pamq_01_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_pamq_01();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_pamq_01_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_pamq_02_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_pamq_02();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_pamq_02_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_pamq_03_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_pamq_03();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_pamq_03_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_pamq_04_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_pamq_04();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_pamq_04_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_titulo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_titulo_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_titulo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_descricao_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_descricao_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_descricao_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_codigo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_codigo_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_codigo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_valido_de_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_valido_de_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_valido_de_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_valido_ate_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_valido_ate_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_valido_ate_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_nome_hotel_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_nome_hotel_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_nome_hotel_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_endereco_hotel_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_endereco_hotel_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_endereco_hotel_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_checkin_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_checkin_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_checkin_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_checkout_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_checkout_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_checkout_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_acomodacao_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_acomodacao_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_acomodacao_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_qtd_hospedes_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_qtd_hospedes_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_qtd_hospedes_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_qtd_noites_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_qtd_noites_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_qtd_noites_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_cafe_manha_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_cafe_manha_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_cafe_manha_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_comodidades_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_comodidades_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_comodidades_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_codigo_reserva_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_codigo_reserva_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_codigo_reserva_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_telefone_hotel_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_telefone_hotel_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_telefone_hotel_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_andar_hotel_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_andar_hotel_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_andar_hotel_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_late_checkout_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_late_checkout_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_late_checkout_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_minibar_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_minibar_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_minibar_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_estacionamento_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_estacionamento_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_estacionamento_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_senha_wifi_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_senha_wifi_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_senha_wifi_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_chackin_online_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_chackin_online_api();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_chackin_online_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_id_evento_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_id_evento_app();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_id_evento_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_id_participante_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_id_participante_app();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_id_participante_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_id_voucher_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_id_voucher_app();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_id_voucher_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_enviar_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_enviar_app();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_enviar_app_onclick(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_event_enviar_app_onclick();
}

function sc_form_hospedagem_rsvp_enviar_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_cpf_del_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_cpf_del();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_cpf_del_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_sql_log_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_sql_log();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_sql_log_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_hospedagem_rsvp_tipo_pessoa_onblur(oThis, iSeqRow, event) {
  do_ajax_form_hospedagem_rsvp_mob_validate_tipo_pessoa();
  scCssBlur(oThis);
}

function sc_form_hospedagem_rsvp_tipo_pessoa_onfocus(oThis, iSeqRow, event) {
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
        if ("2" == block) {
                displayChange_block_2(status);
        }
        if ("3" == block) {
                displayChange_block_3(status);
        }
        if ("4" == block) {
                displayChange_block_4(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("hosp_dt_checkin", "", status);
        displayChange_field("hosp_dt_checkout", "", status);
        displayChange_field("hosp_hr_checkin", "", status);
        displayChange_field("hosp_hr_checkout", "", status);
        displayChange_field("hosp_early_chkin", "", status);
        displayChange_field("hosp_late_chkout", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("hospedagem_id", "", status);
        displayChange_field("hosp_id_evento", "", status);
        displayChange_field("hosp_cpf_participante", "", status);
        displayChange_field("tipo_pessoa", "", status);
        displayChange_field("enviar_app", "", status);
        displayChange_field("hosp_id_hotel", "", status);
        displayChange_field("hosp_acomodacao", "", status);
        displayChange_field("hosp_categoria", "", status);
        displayChange_field("hosp_status", "", status);
        displayChange_field("hosp_part_acomp", "", status);
        displayChange_field("hosp_qtd_acompanhante", "", status);
        displayChange_field("hosp_acompanhante", "", status);
        displayChange_field("hosp_reserva_bvt", "", status);
        displayChange_field("conta_roomlist", "", status);
}

function displayChange_block_2(status) {
        displayChange_field("titulo_api", "", status);
        displayChange_field("descricao_api", "", status);
        displayChange_field("codigo_api", "", status);
        displayChange_field("valido_de_api", "", status);
        displayChange_field("valido_ate_api", "", status);
        displayChange_field("nome_hotel_api", "", status);
        displayChange_field("checkin_api", "", status);
        displayChange_field("checkout_api", "", status);
        displayChange_field("acomodacao_api", "", status);
        displayChange_field("endereco_hotel_api", "", status);
        displayChange_field("qtd_hospedes_api", "", status);
        displayChange_field("qtd_noites_api", "", status);
        displayChange_field("cafe_manha_api", "", status);
        displayChange_field("comodidades_api", "", status);
        displayChange_field("codigo_reserva_api", "", status);
        displayChange_field("telefone_hotel_api", "", status);
        displayChange_field("andar_hotel_api", "", status);
        displayChange_field("late_checkout_api", "", status);
        displayChange_field("minibar_api", "", status);
        displayChange_field("estacionamento_api", "", status);
        displayChange_field("chackin_online_api", "", status);
        displayChange_field("senha_wifi_api", "", status);
        displayChange_field("id_evento_app", "", status);
        displayChange_field("id_participante_app", "", status);
        displayChange_field("id_voucher_app", "", status);
}

function displayChange_block_3(status) {
        displayChange_field("hosp_pagamentos", "", status);
        displayChange_field("hosp_diarias", "", status);
        displayChange_field("hosp_taxas", "", status);
        displayChange_field("hosp_total", "", status);
}

function displayChange_block_4(status) {
        displayChange_field("hosp_dsc_pacote", "", status);
        displayChange_field("hosp_id_usuario", "", status);
        displayChange_field("hosp_alteracao", "", status);
        displayChange_field("hosp_observacoes", "", status);
        displayChange_field("hosp_ativo", "", status);
        displayChange_field("acmq_01", "", status);
        displayChange_field("acmq_02", "", status);
        displayChange_field("acmq_03", "", status);
        displayChange_field("acmq_04", "", status);
        displayChange_field("pamq_01", "", status);
        displayChange_field("pamq_02", "", status);
        displayChange_field("pamq_03", "", status);
        displayChange_field("pamq_04", "", status);
        displayChange_field("cpf_del", "", status);
        displayChange_field("sql_log", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_hosp_dt_checkin(row, status);
        displayChange_field_hosp_dt_checkout(row, status);
        displayChange_field_hosp_hr_checkin(row, status);
        displayChange_field_hosp_hr_checkout(row, status);
        displayChange_field_hosp_early_chkin(row, status);
        displayChange_field_hosp_late_chkout(row, status);
        displayChange_field_hospedagem_id(row, status);
        displayChange_field_hosp_id_evento(row, status);
        displayChange_field_hosp_cpf_participante(row, status);
        displayChange_field_tipo_pessoa(row, status);
        displayChange_field_enviar_app(row, status);
        displayChange_field_hosp_id_hotel(row, status);
        displayChange_field_hosp_acomodacao(row, status);
        displayChange_field_hosp_categoria(row, status);
        displayChange_field_hosp_status(row, status);
        displayChange_field_hosp_part_acomp(row, status);
        displayChange_field_hosp_qtd_acompanhante(row, status);
        displayChange_field_hosp_acompanhante(row, status);
        displayChange_field_hosp_reserva_bvt(row, status);
        displayChange_field_conta_roomlist(row, status);
        displayChange_field_titulo_api(row, status);
        displayChange_field_descricao_api(row, status);
        displayChange_field_codigo_api(row, status);
        displayChange_field_valido_de_api(row, status);
        displayChange_field_valido_ate_api(row, status);
        displayChange_field_nome_hotel_api(row, status);
        displayChange_field_checkin_api(row, status);
        displayChange_field_checkout_api(row, status);
        displayChange_field_acomodacao_api(row, status);
        displayChange_field_endereco_hotel_api(row, status);
        displayChange_field_qtd_hospedes_api(row, status);
        displayChange_field_qtd_noites_api(row, status);
        displayChange_field_cafe_manha_api(row, status);
        displayChange_field_comodidades_api(row, status);
        displayChange_field_codigo_reserva_api(row, status);
        displayChange_field_telefone_hotel_api(row, status);
        displayChange_field_andar_hotel_api(row, status);
        displayChange_field_late_checkout_api(row, status);
        displayChange_field_minibar_api(row, status);
        displayChange_field_estacionamento_api(row, status);
        displayChange_field_chackin_online_api(row, status);
        displayChange_field_senha_wifi_api(row, status);
        displayChange_field_id_evento_app(row, status);
        displayChange_field_id_participante_app(row, status);
        displayChange_field_id_voucher_app(row, status);
        displayChange_field_hosp_pagamentos(row, status);
        displayChange_field_hosp_diarias(row, status);
        displayChange_field_hosp_taxas(row, status);
        displayChange_field_hosp_total(row, status);
        displayChange_field_hosp_dsc_pacote(row, status);
        displayChange_field_hosp_id_usuario(row, status);
        displayChange_field_hosp_alteracao(row, status);
        displayChange_field_hosp_observacoes(row, status);
        displayChange_field_hosp_ativo(row, status);
        displayChange_field_acmq_01(row, status);
        displayChange_field_acmq_02(row, status);
        displayChange_field_acmq_03(row, status);
        displayChange_field_acmq_04(row, status);
        displayChange_field_pamq_01(row, status);
        displayChange_field_pamq_02(row, status);
        displayChange_field_pamq_03(row, status);
        displayChange_field_pamq_04(row, status);
        displayChange_field_cpf_del(row, status);
        displayChange_field_sql_log(row, status);
}

function displayChange_field(field, row, status) {
        if ("hosp_dt_checkin" == field) {
                displayChange_field_hosp_dt_checkin(row, status);
        }
        if ("hosp_dt_checkout" == field) {
                displayChange_field_hosp_dt_checkout(row, status);
        }
        if ("hosp_hr_checkin" == field) {
                displayChange_field_hosp_hr_checkin(row, status);
        }
        if ("hosp_hr_checkout" == field) {
                displayChange_field_hosp_hr_checkout(row, status);
        }
        if ("hosp_early_chkin" == field) {
                displayChange_field_hosp_early_chkin(row, status);
        }
        if ("hosp_late_chkout" == field) {
                displayChange_field_hosp_late_chkout(row, status);
        }
        if ("hospedagem_id" == field) {
                displayChange_field_hospedagem_id(row, status);
        }
        if ("hosp_id_evento" == field) {
                displayChange_field_hosp_id_evento(row, status);
        }
        if ("hosp_cpf_participante" == field) {
                displayChange_field_hosp_cpf_participante(row, status);
        }
        if ("tipo_pessoa" == field) {
                displayChange_field_tipo_pessoa(row, status);
        }
        if ("enviar_app" == field) {
                displayChange_field_enviar_app(row, status);
        }
        if ("hosp_id_hotel" == field) {
                displayChange_field_hosp_id_hotel(row, status);
        }
        if ("hosp_acomodacao" == field) {
                displayChange_field_hosp_acomodacao(row, status);
        }
        if ("hosp_categoria" == field) {
                displayChange_field_hosp_categoria(row, status);
        }
        if ("hosp_status" == field) {
                displayChange_field_hosp_status(row, status);
        }
        if ("hosp_part_acomp" == field) {
                displayChange_field_hosp_part_acomp(row, status);
        }
        if ("hosp_qtd_acompanhante" == field) {
                displayChange_field_hosp_qtd_acompanhante(row, status);
        }
        if ("hosp_acompanhante" == field) {
                displayChange_field_hosp_acompanhante(row, status);
        }
        if ("hosp_reserva_bvt" == field) {
                displayChange_field_hosp_reserva_bvt(row, status);
        }
        if ("conta_roomlist" == field) {
                displayChange_field_conta_roomlist(row, status);
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
        if ("valido_de_api" == field) {
                displayChange_field_valido_de_api(row, status);
        }
        if ("valido_ate_api" == field) {
                displayChange_field_valido_ate_api(row, status);
        }
        if ("nome_hotel_api" == field) {
                displayChange_field_nome_hotel_api(row, status);
        }
        if ("checkin_api" == field) {
                displayChange_field_checkin_api(row, status);
        }
        if ("checkout_api" == field) {
                displayChange_field_checkout_api(row, status);
        }
        if ("acomodacao_api" == field) {
                displayChange_field_acomodacao_api(row, status);
        }
        if ("endereco_hotel_api" == field) {
                displayChange_field_endereco_hotel_api(row, status);
        }
        if ("qtd_hospedes_api" == field) {
                displayChange_field_qtd_hospedes_api(row, status);
        }
        if ("qtd_noites_api" == field) {
                displayChange_field_qtd_noites_api(row, status);
        }
        if ("cafe_manha_api" == field) {
                displayChange_field_cafe_manha_api(row, status);
        }
        if ("comodidades_api" == field) {
                displayChange_field_comodidades_api(row, status);
        }
        if ("codigo_reserva_api" == field) {
                displayChange_field_codigo_reserva_api(row, status);
        }
        if ("telefone_hotel_api" == field) {
                displayChange_field_telefone_hotel_api(row, status);
        }
        if ("andar_hotel_api" == field) {
                displayChange_field_andar_hotel_api(row, status);
        }
        if ("late_checkout_api" == field) {
                displayChange_field_late_checkout_api(row, status);
        }
        if ("minibar_api" == field) {
                displayChange_field_minibar_api(row, status);
        }
        if ("estacionamento_api" == field) {
                displayChange_field_estacionamento_api(row, status);
        }
        if ("chackin_online_api" == field) {
                displayChange_field_chackin_online_api(row, status);
        }
        if ("senha_wifi_api" == field) {
                displayChange_field_senha_wifi_api(row, status);
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
        if ("hosp_pagamentos" == field) {
                displayChange_field_hosp_pagamentos(row, status);
        }
        if ("hosp_diarias" == field) {
                displayChange_field_hosp_diarias(row, status);
        }
        if ("hosp_taxas" == field) {
                displayChange_field_hosp_taxas(row, status);
        }
        if ("hosp_total" == field) {
                displayChange_field_hosp_total(row, status);
        }
        if ("hosp_dsc_pacote" == field) {
                displayChange_field_hosp_dsc_pacote(row, status);
        }
        if ("hosp_id_usuario" == field) {
                displayChange_field_hosp_id_usuario(row, status);
        }
        if ("hosp_alteracao" == field) {
                displayChange_field_hosp_alteracao(row, status);
        }
        if ("hosp_observacoes" == field) {
                displayChange_field_hosp_observacoes(row, status);
        }
        if ("hosp_ativo" == field) {
                displayChange_field_hosp_ativo(row, status);
        }
        if ("acmq_01" == field) {
                displayChange_field_acmq_01(row, status);
        }
        if ("acmq_02" == field) {
                displayChange_field_acmq_02(row, status);
        }
        if ("acmq_03" == field) {
                displayChange_field_acmq_03(row, status);
        }
        if ("acmq_04" == field) {
                displayChange_field_acmq_04(row, status);
        }
        if ("pamq_01" == field) {
                displayChange_field_pamq_01(row, status);
        }
        if ("pamq_02" == field) {
                displayChange_field_pamq_02(row, status);
        }
        if ("pamq_03" == field) {
                displayChange_field_pamq_03(row, status);
        }
        if ("pamq_04" == field) {
                displayChange_field_pamq_04(row, status);
        }
        if ("cpf_del" == field) {
                displayChange_field_cpf_del(row, status);
        }
        if ("sql_log" == field) {
                displayChange_field_sql_log(row, status);
        }
}

function displayChange_field_hosp_dt_checkin(row, status) {
    var fieldId;
}

function displayChange_field_hosp_dt_checkout(row, status) {
    var fieldId;
}

function displayChange_field_hosp_hr_checkin(row, status) {
    var fieldId;
}

function displayChange_field_hosp_hr_checkout(row, status) {
    var fieldId;
}

function displayChange_field_hosp_early_chkin(row, status) {
    var fieldId;
}

function displayChange_field_hosp_late_chkout(row, status) {
    var fieldId;
}

function displayChange_field_hospedagem_id(row, status) {
    var fieldId;
}

function displayChange_field_hosp_id_evento(row, status) {
    var fieldId;
}

function displayChange_field_hosp_cpf_participante(row, status) {
    var fieldId;
}

function displayChange_field_tipo_pessoa(row, status) {
    var fieldId;
}

function displayChange_field_enviar_app(row, status) {
    var fieldId;
}

function displayChange_field_hosp_id_hotel(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_hosp_id_hotel__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_hosp_id_hotel' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_hosp_id_hotel" + row).select2("destroy");
                }
                scJQSelect2Add(row, "hosp_id_hotel");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_hosp_id_hotel' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_hosp_acomodacao(row, status) {
    var fieldId;
}

function displayChange_field_hosp_categoria(row, status) {
    var fieldId;
}

function displayChange_field_hosp_status(row, status) {
    var fieldId;
}

function displayChange_field_hosp_part_acomp(row, status) {
    var fieldId;
}

function displayChange_field_hosp_qtd_acompanhante(row, status) {
    var fieldId;
}

function displayChange_field_hosp_acompanhante(row, status) {
    var fieldId;
}

function displayChange_field_hosp_reserva_bvt(row, status) {
    var fieldId;
}

function displayChange_field_conta_roomlist(row, status) {
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

function displayChange_field_valido_de_api(row, status) {
    var fieldId;
}

function displayChange_field_valido_ate_api(row, status) {
    var fieldId;
}

function displayChange_field_nome_hotel_api(row, status) {
    var fieldId;
}

function displayChange_field_checkin_api(row, status) {
    var fieldId;
}

function displayChange_field_checkout_api(row, status) {
    var fieldId;
}

function displayChange_field_acomodacao_api(row, status) {
    var fieldId;
}

function displayChange_field_endereco_hotel_api(row, status) {
    var fieldId;
}

function displayChange_field_qtd_hospedes_api(row, status) {
    var fieldId;
}

function displayChange_field_qtd_noites_api(row, status) {
    var fieldId;
}

function displayChange_field_cafe_manha_api(row, status) {
    var fieldId;
}

function displayChange_field_comodidades_api(row, status) {
    var fieldId;
}

function displayChange_field_codigo_reserva_api(row, status) {
    var fieldId;
}

function displayChange_field_telefone_hotel_api(row, status) {
    var fieldId;
}

function displayChange_field_andar_hotel_api(row, status) {
    var fieldId;
}

function displayChange_field_late_checkout_api(row, status) {
    var fieldId;
}

function displayChange_field_minibar_api(row, status) {
    var fieldId;
}

function displayChange_field_estacionamento_api(row, status) {
    var fieldId;
}

function displayChange_field_chackin_online_api(row, status) {
    var fieldId;
}

function displayChange_field_senha_wifi_api(row, status) {
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

function displayChange_field_hosp_pagamentos(row, status) {
    var fieldId;
}

function displayChange_field_hosp_diarias(row, status) {
    var fieldId;
}

function displayChange_field_hosp_taxas(row, status) {
    var fieldId;
}

function displayChange_field_hosp_total(row, status) {
    var fieldId;
}

function displayChange_field_hosp_dsc_pacote(row, status) {
    var fieldId;
}

function displayChange_field_hosp_id_usuario(row, status) {
    var fieldId;
}

function displayChange_field_hosp_alteracao(row, status) {
    var fieldId;
}

function displayChange_field_hosp_observacoes(row, status) {
    var fieldId;
}

function displayChange_field_hosp_ativo(row, status) {
    var fieldId;
}

function displayChange_field_acmq_01(row, status) {
    var fieldId;
}

function displayChange_field_acmq_02(row, status) {
    var fieldId;
}

function displayChange_field_acmq_03(row, status) {
    var fieldId;
}

function displayChange_field_acmq_04(row, status) {
    var fieldId;
}

function displayChange_field_pamq_01(row, status) {
    var fieldId;
}

function displayChange_field_pamq_02(row, status) {
    var fieldId;
}

function displayChange_field_pamq_03(row, status) {
    var fieldId;
}

function displayChange_field_pamq_04(row, status) {
    var fieldId;
}

function displayChange_field_cpf_del(row, status) {
    var fieldId;
}

function displayChange_field_sql_log(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
        displayChange_field_hosp_id_hotel("all", "on");
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_hospedagem_rsvp_mob_form" + pageNo).hide();
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
  $("#id_sc_field_hosp_dt_checkin" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_hosp_dt_checkin" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_hosp_dt_checkin" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_hospedagem_rsvp_mob_validate_hosp_dt_checkin(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['hosp_dt_checkin']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_hosp_dt_checkout" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_hosp_dt_checkout" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_hosp_dt_checkout" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_hospedagem_rsvp_mob_validate_hosp_dt_checkout(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['hosp_dt_checkout']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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

var jqCalcMonetPos = {};
var _scCalculatorBlurOk = {};

function scJQCalculatorAdd(iSeqRow) {
  _scCalculatorBlurOk["id_sc_field_saldo_bloq_hotel" + iSeqRow] = true;
  $("#id_sc_field_hosp_total" + iSeqRow).calculator({
    onOpen: function(value, inst) {
      if (typeof _scCalculatorControl !== "undefined") {
        if (!_scCalculatorControl["id_sc_field_hosp_total" + iSeqRow]) {
          _scCalculatorControl["id_sc_field_hosp_total" + iSeqRow] = true;
        }
      }
      value = scJQCalculatorUnformat(value, "#id_sc_field_hosp_total" + iSeqRow, '<?php echo str_replace("'", "\'", $this->field_config['hosp_total']['symbol_grp']); ?>', <?php echo $this->field_config['hosp_total']['symbol_fmt']; ?>, '<?php echo str_replace("'", "\'", $this->field_config['hosp_total']['symbol_dec']); ?>', '<?php echo str_replace("'", "\'", $this->field_config['hosp_total']['symbol_mon']); ?>');
      $(this).val(value);
      $(".calculator-popup").css("min-width", "200px");
    },
    onClose: function(value, inst) {
      var oldValue = $(this.val);
      if (typeof _scCalculatorControl !== "undefined") {
        if (_scCalculatorControl["id_sc_field_hosp_total" + iSeqRow]) {
          _scCalculatorControl["id_sc_field_hosp_total" + iSeqRow] = null;
        }
      }
      value = scJQCalculatorFormat(value, "#id_sc_field_hosp_total" + iSeqRow, '<?php echo str_replace("'", "\'", $this->field_config['hosp_total']['symbol_grp']); ?>', <?php echo $this->field_config['hosp_total']['symbol_fmt']; ?>, '<?php echo str_replace("'", "\'", $this->field_config['hosp_total']['symbol_dec']); ?>', 2, '<?php echo str_replace("'", "\'", $this->field_config['hosp_total']['symbol_mon']); ?>');
      $(this).val(value);
      if (oldValue != value) {
        $(this).trigger('change');
      }
    },
    precision: 2,
    showOn: "button",
<?php
$miniCalculatorIcon = $this->jqueryIconFile('calculator');
$miniCalculatorFA   = $this->jqueryFAFile('calculator');
if ('' != $miniCalculatorIcon) {
?>
    buttonImage: "<?php echo $miniCalculatorIcon; ?>",
    buttonImageOnly: true,
<?php
}
elseif ('' != $miniCalculatorFA) {
?>
    buttonText: "",
<?php
}
?>
  })
<?php
if ('' != $miniCalculatorFA) {
?>
    .next('button').append("<?php echo $miniCalculatorFA; ?>")
<?php
}
?>
;

} // scJQCalculatorAdd

function scJQCalculatorUnformat(fValue, sField, sThousands, sFormat, sDecimals, sMonetary) {
  fValue = scJQCalculatorCurrency(fValue, sField, sMonetary);
  if ("" != sThousands) {
    if ("." == sThousands) {
      sThousands = "\\.";
    }
    sRegEx = eval("/" + sThousands + "/g");
    fValue = fValue.replace(sRegEx, "");
  }
  if ("." != sDecimals) {
    sRegEx = eval("/" + sDecimals + "/g");
    fValue = fValue.replace(sRegEx, ".");
  }
  if ("." == fValue.substr(0, 1) || "," == fValue.substr(0, 1)) {
    fValue = "0" + fValue;
  }
  return fValue;
} // scJQCalculatorUnformat

function scJQCalculatorFormat(fValue, sField, sThousands, sFormat, sDecimals, iPrecision, sMonetary) {
  fValue = scJQCalculatorCurrency(fValue.toString(), sField, sMonetary);
  if (-1 < fValue.indexOf('.')) {
    var parts = fValue.split('.'),
        pref = parts[0],
        suf = parts[1];
  }
  else {
    var pref = fValue,
        suf = '';
  }
  if ('' != sThousands) {
    if (3 == sFormat) {
      if (4 <= pref.length) {
        pref_rest = pref.substr(0, pref.length - 3);
        pref = sThousands + pref.substr(pref.length - 3);
        while (2 < pref_rest.length) {
          pref = sThousands + pref_rest.substr(pref_rest.length - 2) + pref;
          pref_rest = pref_rest.substr(0, pref_rest.length - 2);
        }
        if ('' != pref_rest) {
          pref = pref_rest + pref;
        }
      }
    }
    else if (2 == sFormat) {
      if (4 <= pref.length) {
        pref = pref.substr(0, pref.length - 3) + sThousands + pref.substr(pref.length - 3);
      }
    }
    else {
      pref_rest = pref;
      pref = '';
      while (3 < pref_rest.length) {
        pref = sThousands + pref_rest.substr(pref_rest.length - 3) + pref;
        pref_rest = pref_rest.substr(0, pref_rest.length - 3);
      }
      if ('' != pref_rest) {
        pref = pref_rest + pref;
      }
    }
  }
  if ('' != iPrecision) {
    if (suf.length > iPrecision) {
      suf = '1' + suf.substr(0, iPrecision) + '.' + suf.substr(iPrecision);
      suf = Math.round(parseFloat(suf)).toString().substr(1);
    }
    else {
      while (suf.length < iPrecision) {
        suf += '0';
      }
    }
  }
  if ('' != sDecimals && '' != suf) {
    fValue = pref + sDecimals + suf;
  }
  else {
    fValue = pref;
  }
  if ('' != sMonetary) {
    fValue = 'left' == jqCalcMonetPos[sField] ? sMonetary + ' ' + fValue : fValue + ' ' + sMonetary;
  }
  return fValue;
} // scJQCalculatorFormat

function scJQCalculatorCurrency(fValue, sField, sMonetary) {
  if ("" != sMonetary) {
    if (sMonetary + ' ' == fValue.substr(0, sMonetary.length + 1)) {
        fValue = fValue.substr(sMonetary.length + 1);
        jqCalcMonetPos[sField] = 'left';
    }
    else if (sMonetary == fValue.substr(0, sMonetary.length)) {
        fValue = fValue.substr(sMonetary.length + 1);
        jqCalcMonetPos[sField] = 'left';
    }
    else if (' ' + sMonetary == fValue.substr(fValue.length - sMonetary.length - 1)) {
        fValue = fValue.substr(0, fValue.length - sMonetary.length - 1);
        jqCalcMonetPos[sField] = 'right';
    }
    else if (sMonetary == fValue.substr(fValue.length - sMonetary.length)) {
        fValue = fValue.substr(0, fValue.length - sMonetary.length);
        jqCalcMonetPos[sField] = 'right';
    }
  }
  if ("" == fValue) {
    fValue = "0";
  }
  return fValue;
} // scJQCalculatorCurrency

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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_hospedagem_rsvp_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_hospedagem_rsvp_mob');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_hospedagem_rsvp_mob');
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
  if (null == specificField || "hosp_id_hotel" == specificField) {
    scJQSelect2Add_hosp_id_hotel(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_hosp_id_hotel(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_hosp_id_hotel_obj" : "#id_sc_field_hosp_id_hotel" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_hosp_id_hotel_obj',
      dropdownCssClass: 'css_hosp_id_hotel_obj',
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
  $('#select2-id_sc_field_hosp_id_hotel' + seqRow + '-container').addClass('css_hosp_id_hotel_obj');
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQCalculatorAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_hosp_id_hotel) { displayChange_field_hosp_id_hotel(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
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

