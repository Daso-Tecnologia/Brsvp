
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
     if (sField == 'aereo_cia_aerea' || sField == 'aereo_origem' || sField == 'aereo_destino') {
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
  scEventControl_data["aereo_cpf_particip" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_pessoa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enviar_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_status" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_direcao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_bloqueio_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_cia_aerea" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_origem" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_destino" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_dt_saida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_hr_saida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_dt_chegada" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_hr_chegada" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_num_voo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_localizador" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_eticket" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_assento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_emitida_bvt" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_valor" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_transfer_tipo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["titulo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["descricao_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cod_rota_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tipo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valido_de_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["valido_ate_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["duracao_voo_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aeronave_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["terminal_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["gate_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["refeicao_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["milhagem_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["web_ckeckin_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["duracao_escala" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aeroporto_escala" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["numero_voo_escala" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hora_saida_escala" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hora_chegada_escala" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["classe_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["passageiro_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["bagagem_api" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_evento_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_participante_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_voucher_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["atendente" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_id_usuario" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_ativo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_dthr_saida" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_dthr_chegada" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_origem_gate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_trecho" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_modificado_em" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nome_pax_gate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nota_gate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["data_nota_gate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fil_agt_gate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["aereo_cia_aerea_gate" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cpf_del" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sql_log" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["aereo_cpf_particip" + iSeqRow] && scEventControl_data["aereo_cpf_particip" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_cpf_particip" + iSeqRow] && scEventControl_data["aereo_cpf_particip" + iSeqRow]["change"]) {
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
  if (scEventControl_data["aereo_status" + iSeqRow] && scEventControl_data["aereo_status" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_status" + iSeqRow] && scEventControl_data["aereo_status" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_direcao" + iSeqRow] && scEventControl_data["aereo_direcao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_direcao" + iSeqRow] && scEventControl_data["aereo_direcao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_bloqueio_id" + iSeqRow] && scEventControl_data["aereo_bloqueio_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_bloqueio_id" + iSeqRow] && scEventControl_data["aereo_bloqueio_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_cia_aerea" + iSeqRow] && scEventControl_data["aereo_cia_aerea" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_cia_aerea" + iSeqRow] && scEventControl_data["aereo_cia_aerea" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_origem" + iSeqRow] && scEventControl_data["aereo_origem" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_origem" + iSeqRow] && scEventControl_data["aereo_origem" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_destino" + iSeqRow] && scEventControl_data["aereo_destino" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_destino" + iSeqRow] && scEventControl_data["aereo_destino" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_dt_saida" + iSeqRow] && scEventControl_data["aereo_dt_saida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_dt_saida" + iSeqRow] && scEventControl_data["aereo_dt_saida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_hr_saida" + iSeqRow] && scEventControl_data["aereo_hr_saida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_hr_saida" + iSeqRow] && scEventControl_data["aereo_hr_saida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_dt_chegada" + iSeqRow] && scEventControl_data["aereo_dt_chegada" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_dt_chegada" + iSeqRow] && scEventControl_data["aereo_dt_chegada" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_hr_chegada" + iSeqRow] && scEventControl_data["aereo_hr_chegada" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_hr_chegada" + iSeqRow] && scEventControl_data["aereo_hr_chegada" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_num_voo" + iSeqRow] && scEventControl_data["aereo_num_voo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_num_voo" + iSeqRow] && scEventControl_data["aereo_num_voo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_localizador" + iSeqRow] && scEventControl_data["aereo_localizador" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_localizador" + iSeqRow] && scEventControl_data["aereo_localizador" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_eticket" + iSeqRow] && scEventControl_data["aereo_eticket" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_eticket" + iSeqRow] && scEventControl_data["aereo_eticket" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_assento" + iSeqRow] && scEventControl_data["aereo_assento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_assento" + iSeqRow] && scEventControl_data["aereo_assento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_emitida_bvt" + iSeqRow] && scEventControl_data["aereo_emitida_bvt" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_emitida_bvt" + iSeqRow] && scEventControl_data["aereo_emitida_bvt" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_valor" + iSeqRow] && scEventControl_data["aereo_valor" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_valor" + iSeqRow] && scEventControl_data["aereo_valor" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_transfer_tipo" + iSeqRow] && scEventControl_data["aereo_transfer_tipo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_transfer_tipo" + iSeqRow] && scEventControl_data["aereo_transfer_tipo" + iSeqRow]["change"]) {
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
  if (scEventControl_data["cod_rota_api" + iSeqRow] && scEventControl_data["cod_rota_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cod_rota_api" + iSeqRow] && scEventControl_data["cod_rota_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tipo_api" + iSeqRow] && scEventControl_data["tipo_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tipo_api" + iSeqRow] && scEventControl_data["tipo_api" + iSeqRow]["change"]) {
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
  if (scEventControl_data["duracao_voo_api" + iSeqRow] && scEventControl_data["duracao_voo_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["duracao_voo_api" + iSeqRow] && scEventControl_data["duracao_voo_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aeronave_api" + iSeqRow] && scEventControl_data["aeronave_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aeronave_api" + iSeqRow] && scEventControl_data["aeronave_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["terminal_api" + iSeqRow] && scEventControl_data["terminal_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["terminal_api" + iSeqRow] && scEventControl_data["terminal_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["gate_api" + iSeqRow] && scEventControl_data["gate_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["gate_api" + iSeqRow] && scEventControl_data["gate_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["refeicao_api" + iSeqRow] && scEventControl_data["refeicao_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["refeicao_api" + iSeqRow] && scEventControl_data["refeicao_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["milhagem_api" + iSeqRow] && scEventControl_data["milhagem_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["milhagem_api" + iSeqRow] && scEventControl_data["milhagem_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["web_ckeckin_api" + iSeqRow] && scEventControl_data["web_ckeckin_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["web_ckeckin_api" + iSeqRow] && scEventControl_data["web_ckeckin_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["duracao_escala" + iSeqRow] && scEventControl_data["duracao_escala" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["duracao_escala" + iSeqRow] && scEventControl_data["duracao_escala" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aeroporto_escala" + iSeqRow] && scEventControl_data["aeroporto_escala" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aeroporto_escala" + iSeqRow] && scEventControl_data["aeroporto_escala" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["numero_voo_escala" + iSeqRow] && scEventControl_data["numero_voo_escala" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["numero_voo_escala" + iSeqRow] && scEventControl_data["numero_voo_escala" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hora_saida_escala" + iSeqRow] && scEventControl_data["hora_saida_escala" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hora_saida_escala" + iSeqRow] && scEventControl_data["hora_saida_escala" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hora_chegada_escala" + iSeqRow] && scEventControl_data["hora_chegada_escala" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hora_chegada_escala" + iSeqRow] && scEventControl_data["hora_chegada_escala" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["classe_api" + iSeqRow] && scEventControl_data["classe_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["classe_api" + iSeqRow] && scEventControl_data["classe_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["passageiro_api" + iSeqRow] && scEventControl_data["passageiro_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["passageiro_api" + iSeqRow] && scEventControl_data["passageiro_api" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["bagagem_api" + iSeqRow] && scEventControl_data["bagagem_api" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["bagagem_api" + iSeqRow] && scEventControl_data["bagagem_api" + iSeqRow]["change"]) {
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
  if (scEventControl_data["atendente" + iSeqRow] && scEventControl_data["atendente" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["atendente" + iSeqRow] && scEventControl_data["atendente" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_id_usuario" + iSeqRow] && scEventControl_data["aereo_id_usuario" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_id_usuario" + iSeqRow] && scEventControl_data["aereo_id_usuario" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_ativo" + iSeqRow] && scEventControl_data["aereo_ativo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_ativo" + iSeqRow] && scEventControl_data["aereo_ativo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_dthr_saida" + iSeqRow] && scEventControl_data["aereo_dthr_saida" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_dthr_saida" + iSeqRow] && scEventControl_data["aereo_dthr_saida" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_dthr_chegada" + iSeqRow] && scEventControl_data["aereo_dthr_chegada" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_dthr_chegada" + iSeqRow] && scEventControl_data["aereo_dthr_chegada" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_origem_gate" + iSeqRow] && scEventControl_data["id_origem_gate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_origem_gate" + iSeqRow] && scEventControl_data["id_origem_gate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_trecho" + iSeqRow] && scEventControl_data["aereo_trecho" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_trecho" + iSeqRow] && scEventControl_data["aereo_trecho" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_modificado_em" + iSeqRow] && scEventControl_data["aereo_modificado_em" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_modificado_em" + iSeqRow] && scEventControl_data["aereo_modificado_em" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nome_pax_gate" + iSeqRow] && scEventControl_data["nome_pax_gate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome_pax_gate" + iSeqRow] && scEventControl_data["nome_pax_gate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nota_gate" + iSeqRow] && scEventControl_data["nota_gate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nota_gate" + iSeqRow] && scEventControl_data["nota_gate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data_nota_gate" + iSeqRow] && scEventControl_data["data_nota_gate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data_nota_gate" + iSeqRow] && scEventControl_data["data_nota_gate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fil_agt_gate" + iSeqRow] && scEventControl_data["fil_agt_gate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fil_agt_gate" + iSeqRow] && scEventControl_data["fil_agt_gate" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["aereo_cia_aerea_gate" + iSeqRow] && scEventControl_data["aereo_cia_aerea_gate" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["aereo_cia_aerea_gate" + iSeqRow] && scEventControl_data["aereo_cia_aerea_gate" + iSeqRow]["change"]) {
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
  if ("aereo_status" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aereo_direcao" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aereo_bloqueio_id" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aereo_cia_aerea" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aereo_origem" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aereo_destino" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aereo_emitida_bvt" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aereo_transfer_tipo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aereo_ativo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("aereo_bloqueio_id" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("aereo_destino" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("aereo_direcao" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("aereo_dt_chegada" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("aereo_dt_saida" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("aereo_hr_chegada" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("aereo_hr_saida" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("aereo_status" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("aereo_transfer_tipo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("duracao_escala" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("duracao_voo_api" + iSeq == fieldName) {
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
  $('#id_sc_field_aereo_id_usuario' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_id_usuario_onblur('#id_sc_field_aereo_id_usuario' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_id_usuario_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_cpf_particip' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_cpf_particip_onblur('#id_sc_field_aereo_cpf_particip' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_cpf_particip_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_status' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_status_onblur('#id_sc_field_aereo_status' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_form_aereos_rsvp_1_aereo_status_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_status_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_direcao' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_aereos_rsvp_1_aereo_direcao_onblur('#id_sc_field_aereo_direcao' + iSeqRow, iSeqRow, event);}, 300) })
                                           .bind('change', function() { sc_form_aereos_rsvp_1_aereo_direcao_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_direcao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_cia_aerea' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_aereos_rsvp_1_aereo_cia_aerea_onblur('#id_sc_field_aereo_cia_aerea' + iSeqRow, iSeqRow, event);}, 300) })
                                             .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_cia_aerea_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_num_voo' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_aereos_rsvp_1_aereo_num_voo_onblur('#id_sc_field_aereo_num_voo' + iSeqRow, iSeqRow, event);}, 300) })
                                           .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_num_voo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_origem' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_aereos_rsvp_1_aereo_origem_onblur('#id_sc_field_aereo_origem' + iSeqRow, iSeqRow, event);}, 300) })
                                          .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_origem_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_destino' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_aereos_rsvp_1_aereo_destino_onblur('#id_sc_field_aereo_destino' + iSeqRow, iSeqRow, event);}, 300) })
                                           .bind('change', function() { sc_form_aereos_rsvp_1_aereo_destino_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_destino_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dt_saida' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_aereos_rsvp_1_aereo_dt_saida_onblur('#id_sc_field_aereo_dt_saida' + iSeqRow, iSeqRow, event);}, 300) })
                                            .bind('change', function() { sc_form_aereos_rsvp_1_aereo_dt_saida_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_dt_saida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_hr_saida' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_aereos_rsvp_1_aereo_hr_saida_onblur('#id_sc_field_aereo_hr_saida' + iSeqRow, iSeqRow, event);}, 300) })
                                            .bind('change', function() { sc_form_aereos_rsvp_1_aereo_hr_saida_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_hr_saida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dthr_saida' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_dthr_saida_onblur('#id_sc_field_aereo_dthr_saida' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_dthr_saida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dthr_saida_hora' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_dthr_saida_onblur('#id_sc_field_aereo_dthr_saida' + iSeqRow, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_dthr_saida_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dt_chegada' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_aereos_rsvp_1_aereo_dt_chegada_onblur('#id_sc_field_aereo_dt_chegada' + iSeqRow, iSeqRow, event);}, 300) })
                                              .bind('change', function() { sc_form_aereos_rsvp_1_aereo_dt_chegada_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_dt_chegada_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_hr_chegada' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_aereos_rsvp_1_aereo_hr_chegada_onblur('#id_sc_field_aereo_hr_chegada' + iSeqRow, iSeqRow, event);}, 300) })
                                              .bind('change', function() { sc_form_aereos_rsvp_1_aereo_hr_chegada_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_hr_chegada_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dthr_chegada' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_dthr_chegada_onblur('#id_sc_field_aereo_dthr_chegada' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_dthr_chegada_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_dthr_chegada_hora' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_dthr_chegada_onblur('#id_sc_field_aereo_dthr_chegada' + iSeqRow, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_dthr_chegada_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_localizador' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_localizador_onblur('#id_sc_field_aereo_localizador' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_localizador_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_eticket' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_eticket_onblur('#id_sc_field_aereo_eticket' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_eticket_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_emitida_bvt' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_emitida_bvt_onblur('#id_sc_field_aereo_emitida_bvt' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_emitida_bvt_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_valor' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_valor_onblur('#id_sc_field_aereo_valor' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_valor_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_bloqueio_id' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_bloqueio_id_onblur('#id_sc_field_aereo_bloqueio_id' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_aereos_rsvp_1_aereo_bloqueio_id_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_bloqueio_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_modificado_em' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_modificado_em_onblur('#id_sc_field_aereo_modificado_em' + iSeqRow, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_modificado_em_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_modificado_em_hora' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_modificado_em_onblur('#id_sc_field_aereo_modificado_em' + iSeqRow, iSeqRow, event) })
                                                      .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_modificado_em_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_trecho' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_trecho_onblur('#id_sc_field_aereo_trecho' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_trecho_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_ativo' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_ativo_onblur('#id_sc_field_aereo_ativo' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_ativo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_origem_gate' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_id_origem_gate_onblur('#id_sc_field_id_origem_gate' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_aereos_rsvp_1_id_origem_gate_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome_pax_gate' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_nome_pax_gate_onblur('#id_sc_field_nome_pax_gate' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_aereos_rsvp_1_nome_pax_gate_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nota_gate' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_nota_gate_onblur('#id_sc_field_nota_gate' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_aereos_rsvp_1_nota_gate_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_data_nota_gate' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_data_nota_gate_onblur('#id_sc_field_data_nota_gate' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_aereos_rsvp_1_data_nota_gate_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fil_agt_gate' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_fil_agt_gate_onblur('#id_sc_field_fil_agt_gate' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_aereos_rsvp_1_fil_agt_gate_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_cia_aerea_gate' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_cia_aerea_gate_onblur('#id_sc_field_aereo_cia_aerea_gate' + iSeqRow, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_cia_aerea_gate_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_transfer_tipo' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_transfer_tipo_onblur('#id_sc_field_aereo_transfer_tipo' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_aereos_rsvp_1_aereo_transfer_tipo_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_transfer_tipo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aereo_assento' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aereo_assento_onblur('#id_sc_field_aereo_assento' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_aereos_rsvp_1_aereo_assento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_titulo_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_titulo_api_onblur('#id_sc_field_titulo_api' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_aereos_rsvp_1_titulo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_descricao_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_descricao_api_onblur('#id_sc_field_descricao_api' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_aereos_rsvp_1_descricao_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cod_rota_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_cod_rota_api_onblur('#id_sc_field_cod_rota_api' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_aereos_rsvp_1_cod_rota_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tipo_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_tipo_api_onblur('#id_sc_field_tipo_api' + iSeqRow, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_aereos_rsvp_1_tipo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_valido_de_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_valido_de_api_onblur('#id_sc_field_valido_de_api' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_aereos_rsvp_1_valido_de_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_valido_ate_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_valido_ate_api_onblur('#id_sc_field_valido_ate_api' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_aereos_rsvp_1_valido_ate_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_duracao_voo_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_duracao_voo_api_onblur('#id_sc_field_duracao_voo_api' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_aereos_rsvp_1_duracao_voo_api_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_aereos_rsvp_1_duracao_voo_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aeronave_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aeronave_api_onblur('#id_sc_field_aeronave_api' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_aereos_rsvp_1_aeronave_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_terminal_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_terminal_api_onblur('#id_sc_field_terminal_api' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_aereos_rsvp_1_terminal_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_gate_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_gate_api_onblur('#id_sc_field_gate_api' + iSeqRow, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_aereos_rsvp_1_gate_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_refeicao_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_refeicao_api_onblur('#id_sc_field_refeicao_api' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_aereos_rsvp_1_refeicao_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_milhagem_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_milhagem_api_onblur('#id_sc_field_milhagem_api' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_aereos_rsvp_1_milhagem_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_web_ckeckin_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_web_ckeckin_api_onblur('#id_sc_field_web_ckeckin_api' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_aereos_rsvp_1_web_ckeckin_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_duracao_escala' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_duracao_escala_onblur('#id_sc_field_duracao_escala' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_aereos_rsvp_1_duracao_escala_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_aereos_rsvp_1_duracao_escala_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_aeroporto_escala' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_aeroporto_escala_onblur('#id_sc_field_aeroporto_escala' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_aereos_rsvp_1_aeroporto_escala_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_numero_voo_escala' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_numero_voo_escala_onblur('#id_sc_field_numero_voo_escala' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_aereos_rsvp_1_numero_voo_escala_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hora_saida_escala' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_hora_saida_escala_onblur('#id_sc_field_hora_saida_escala' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_aereos_rsvp_1_hora_saida_escala_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hora_chegada_escala' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_hora_chegada_escala_onblur('#id_sc_field_hora_chegada_escala' + iSeqRow, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_aereos_rsvp_1_hora_chegada_escala_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_enviar_app' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_enviar_app_onblur('#id_sc_field_enviar_app' + iSeqRow, iSeqRow, event) })
                                        .bind('click', function() { sc_form_aereos_rsvp_1_enviar_app_onclick(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_aereos_rsvp_1_enviar_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_classe_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_classe_api_onblur('#id_sc_field_classe_api' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_aereos_rsvp_1_classe_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_passageiro_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_passageiro_api_onblur('#id_sc_field_passageiro_api' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_aereos_rsvp_1_passageiro_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_bagagem_api' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_bagagem_api_onblur('#id_sc_field_bagagem_api' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_aereos_rsvp_1_bagagem_api_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_evento_app' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_id_evento_app_onblur('#id_sc_field_id_evento_app' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_aereos_rsvp_1_id_evento_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_participante_app' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_id_participante_app_onblur('#id_sc_field_id_participante_app' + iSeqRow, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_aereos_rsvp_1_id_participante_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_voucher_app' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_id_voucher_app_onblur('#id_sc_field_id_voucher_app' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_aereos_rsvp_1_id_voucher_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_atendente' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_atendente_onblur('#id_sc_field_atendente' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_aereos_rsvp_1_atendente_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cpf_del' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_cpf_del_onblur('#id_sc_field_cpf_del' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_aereos_rsvp_1_cpf_del_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_sql_log' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_sql_log_onblur('#id_sc_field_sql_log' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_aereos_rsvp_1_sql_log_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tipo_pessoa' + iSeqRow).bind('blur', function() { sc_form_aereos_rsvp_1_tipo_pessoa_onblur('#id_sc_field_tipo_pessoa' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_aereos_rsvp_1_tipo_pessoa_onfocus(this, iSeqRow, event) });
  $('.sc-ui-radio-enviar_app' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-checkbox-desab_inout' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_aereos_rsvp_1_aereo_id_usuario_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_id_usuario();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_id_usuario_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_cpf_particip_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_cpf_particip();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_cpf_particip_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_status_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_status();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_status_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_aereo_status_onchange();
}

function sc_form_aereos_rsvp_1_aereo_status_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_direcao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_direcao();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_direcao_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_aereo_direcao_onchange();
}

function sc_form_aereos_rsvp_1_aereo_direcao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_cia_aerea_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_cia_aerea();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_cia_aerea_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_num_voo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_num_voo();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_num_voo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_origem_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_origem();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_origem_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_destino_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_destino();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_destino_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_aereo_destino_onchange();
}

function sc_form_aereos_rsvp_1_aereo_destino_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dt_saida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dt_saida();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dt_saida_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_aereo_dt_saida_onchange();
}

function sc_form_aereos_rsvp_1_aereo_dt_saida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_hr_saida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_hr_saida();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_hr_saida_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_aereo_hr_saida_onchange();
}

function sc_form_aereos_rsvp_1_aereo_hr_saida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dthr_saida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dthr_saida();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dthr_saida_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dthr_saida();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dthr_saida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dthr_saida_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dt_chegada_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dt_chegada();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dt_chegada_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_aereo_dt_chegada_onchange();
}

function sc_form_aereos_rsvp_1_aereo_dt_chegada_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_hr_chegada_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_hr_chegada();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_hr_chegada_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_aereo_hr_chegada_onchange();
}

function sc_form_aereos_rsvp_1_aereo_hr_chegada_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dthr_chegada_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dthr_chegada();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dthr_chegada_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dthr_chegada();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dthr_chegada_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_dthr_chegada_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_localizador_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_localizador();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_localizador_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_eticket_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_eticket();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_eticket_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_emitida_bvt_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_emitida_bvt();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_emitida_bvt_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_valor_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_valor();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_valor_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_bloqueio_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_bloqueio_id();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_bloqueio_id_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_aereo_bloqueio_id_onchange();
}

function sc_form_aereos_rsvp_1_aereo_bloqueio_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_modificado_em_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_modificado_em();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_modificado_em_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_modificado_em();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_modificado_em_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_modificado_em_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_trecho_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_trecho();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_trecho_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_ativo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_ativo();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_ativo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_id_origem_gate_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_id_origem_gate();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_id_origem_gate_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_nome_pax_gate_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_nome_pax_gate();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_nome_pax_gate_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_nota_gate_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_nota_gate();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_nota_gate_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_data_nota_gate_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_data_nota_gate();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_data_nota_gate_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_fil_agt_gate_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_fil_agt_gate();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_fil_agt_gate_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_cia_aerea_gate_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_cia_aerea_gate();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_cia_aerea_gate_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_transfer_tipo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_transfer_tipo();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_transfer_tipo_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_aereo_transfer_tipo_onchange();
}

function sc_form_aereos_rsvp_1_aereo_transfer_tipo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aereo_assento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aereo_assento();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aereo_assento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_titulo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_titulo_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_titulo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_descricao_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_descricao_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_descricao_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_cod_rota_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_cod_rota_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_cod_rota_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_tipo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_tipo_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_tipo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_valido_de_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_valido_de_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_valido_de_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_valido_ate_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_valido_ate_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_valido_ate_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_duracao_voo_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_duracao_voo_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_duracao_voo_api_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_duracao_voo_api_onchange();
}

function sc_form_aereos_rsvp_1_duracao_voo_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aeronave_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aeronave_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aeronave_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_terminal_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_terminal_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_terminal_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_gate_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_gate_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_gate_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_refeicao_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_refeicao_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_refeicao_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_milhagem_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_milhagem_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_milhagem_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_web_ckeckin_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_web_ckeckin_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_web_ckeckin_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_duracao_escala_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_duracao_escala();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_duracao_escala_onchange(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_duracao_escala_onchange();
}

function sc_form_aereos_rsvp_1_duracao_escala_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_aeroporto_escala_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_aeroporto_escala();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_aeroporto_escala_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_numero_voo_escala_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_numero_voo_escala();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_numero_voo_escala_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_hora_saida_escala_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_hora_saida_escala();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_hora_saida_escala_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_hora_chegada_escala_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_hora_chegada_escala();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_hora_chegada_escala_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_enviar_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_enviar_app();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_enviar_app_onclick(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_event_enviar_app_onclick();
}

function sc_form_aereos_rsvp_1_enviar_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_classe_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_classe_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_classe_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_passageiro_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_passageiro_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_passageiro_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_bagagem_api_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_bagagem_api();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_bagagem_api_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_id_evento_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_id_evento_app();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_id_evento_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_id_participante_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_id_participante_app();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_id_participante_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_id_voucher_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_id_voucher_app();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_id_voucher_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_atendente_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_atendente();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_atendente_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_cpf_del_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_cpf_del();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_cpf_del_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_sql_log_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_sql_log();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_sql_log_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_aereos_rsvp_1_tipo_pessoa_onblur(oThis, iSeqRow, event) {
  do_ajax_form_aereos_rsvp_1_mob_validate_tipo_pessoa();
  scCssBlur(oThis);
}

function sc_form_aereos_rsvp_1_tipo_pessoa_onfocus(oThis, iSeqRow, event) {
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
}

function displayChange_block_0(status) {
        displayChange_field("aereo_cpf_particip", "", status);
        displayChange_field("tipo_pessoa", "", status);
        displayChange_field("enviar_app", "", status);
        displayChange_field("aereo_status", "", status);
        displayChange_field("aereo_direcao", "", status);
        displayChange_field("aereo_bloqueio_id", "", status);
        displayChange_field("aereo_cia_aerea", "", status);
        displayChange_field("aereo_origem", "", status);
        displayChange_field("aereo_destino", "", status);
        displayChange_field("aereo_dt_saida", "", status);
        displayChange_field("aereo_hr_saida", "", status);
        displayChange_field("aereo_dt_chegada", "", status);
        displayChange_field("aereo_hr_chegada", "", status);
        displayChange_field("aereo_num_voo", "", status);
        displayChange_field("aereo_localizador", "", status);
        displayChange_field("aereo_eticket", "", status);
        displayChange_field("aereo_assento", "", status);
        displayChange_field("aereo_emitida_bvt", "", status);
        displayChange_field("aereo_valor", "", status);
        displayChange_field("aereo_transfer_tipo", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("titulo_api", "", status);
        displayChange_field("descricao_api", "", status);
        displayChange_field("cod_rota_api", "", status);
        displayChange_field("tipo_api", "", status);
        displayChange_field("valido_de_api", "", status);
        displayChange_field("valido_ate_api", "", status);
        displayChange_field("duracao_voo_api", "", status);
        displayChange_field("aeronave_api", "", status);
        displayChange_field("terminal_api", "", status);
        displayChange_field("gate_api", "", status);
        displayChange_field("refeicao_api", "", status);
        displayChange_field("milhagem_api", "", status);
        displayChange_field("web_ckeckin_api", "", status);
        displayChange_field("duracao_escala", "", status);
        displayChange_field("aeroporto_escala", "", status);
        displayChange_field("numero_voo_escala", "", status);
        displayChange_field("hora_saida_escala", "", status);
        displayChange_field("hora_chegada_escala", "", status);
        displayChange_field("classe_api", "", status);
        displayChange_field("passageiro_api", "", status);
        displayChange_field("bagagem_api", "", status);
        displayChange_field("id_evento_app", "", status);
        displayChange_field("id_participante_app", "", status);
        displayChange_field("id_voucher_app", "", status);
}

function displayChange_block_2(status) {
        displayChange_field("atendente", "", status);
        displayChange_field("aereo_id_usuario", "", status);
        displayChange_field("aereo_ativo", "", status);
        displayChange_field("aereo_dthr_saida", "", status);
        displayChange_field("aereo_dthr_chegada", "", status);
        displayChange_field("id_origem_gate", "", status);
        displayChange_field("aereo_trecho", "", status);
        displayChange_field("aereo_modificado_em", "", status);
        displayChange_field("nome_pax_gate", "", status);
        displayChange_field("nota_gate", "", status);
        displayChange_field("data_nota_gate", "", status);
        displayChange_field("fil_agt_gate", "", status);
        displayChange_field("aereo_cia_aerea_gate", "", status);
        displayChange_field("cpf_del", "", status);
        displayChange_field("sql_log", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_aereo_cpf_particip(row, status);
        displayChange_field_tipo_pessoa(row, status);
        displayChange_field_enviar_app(row, status);
        displayChange_field_aereo_status(row, status);
        displayChange_field_aereo_direcao(row, status);
        displayChange_field_aereo_bloqueio_id(row, status);
        displayChange_field_aereo_cia_aerea(row, status);
        displayChange_field_aereo_origem(row, status);
        displayChange_field_aereo_destino(row, status);
        displayChange_field_aereo_dt_saida(row, status);
        displayChange_field_aereo_hr_saida(row, status);
        displayChange_field_aereo_dt_chegada(row, status);
        displayChange_field_aereo_hr_chegada(row, status);
        displayChange_field_aereo_num_voo(row, status);
        displayChange_field_aereo_localizador(row, status);
        displayChange_field_aereo_eticket(row, status);
        displayChange_field_aereo_assento(row, status);
        displayChange_field_aereo_emitida_bvt(row, status);
        displayChange_field_aereo_valor(row, status);
        displayChange_field_aereo_transfer_tipo(row, status);
        displayChange_field_titulo_api(row, status);
        displayChange_field_descricao_api(row, status);
        displayChange_field_cod_rota_api(row, status);
        displayChange_field_tipo_api(row, status);
        displayChange_field_valido_de_api(row, status);
        displayChange_field_valido_ate_api(row, status);
        displayChange_field_duracao_voo_api(row, status);
        displayChange_field_aeronave_api(row, status);
        displayChange_field_terminal_api(row, status);
        displayChange_field_gate_api(row, status);
        displayChange_field_refeicao_api(row, status);
        displayChange_field_milhagem_api(row, status);
        displayChange_field_web_ckeckin_api(row, status);
        displayChange_field_duracao_escala(row, status);
        displayChange_field_aeroporto_escala(row, status);
        displayChange_field_numero_voo_escala(row, status);
        displayChange_field_hora_saida_escala(row, status);
        displayChange_field_hora_chegada_escala(row, status);
        displayChange_field_classe_api(row, status);
        displayChange_field_passageiro_api(row, status);
        displayChange_field_bagagem_api(row, status);
        displayChange_field_id_evento_app(row, status);
        displayChange_field_id_participante_app(row, status);
        displayChange_field_id_voucher_app(row, status);
        displayChange_field_atendente(row, status);
        displayChange_field_aereo_id_usuario(row, status);
        displayChange_field_aereo_ativo(row, status);
        displayChange_field_aereo_dthr_saida(row, status);
        displayChange_field_aereo_dthr_chegada(row, status);
        displayChange_field_id_origem_gate(row, status);
        displayChange_field_aereo_trecho(row, status);
        displayChange_field_aereo_modificado_em(row, status);
        displayChange_field_nome_pax_gate(row, status);
        displayChange_field_nota_gate(row, status);
        displayChange_field_data_nota_gate(row, status);
        displayChange_field_fil_agt_gate(row, status);
        displayChange_field_aereo_cia_aerea_gate(row, status);
        displayChange_field_cpf_del(row, status);
        displayChange_field_sql_log(row, status);
}

function displayChange_field(field, row, status) {
        if ("aereo_cpf_particip" == field) {
                displayChange_field_aereo_cpf_particip(row, status);
        }
        if ("tipo_pessoa" == field) {
                displayChange_field_tipo_pessoa(row, status);
        }
        if ("enviar_app" == field) {
                displayChange_field_enviar_app(row, status);
        }
        if ("aereo_status" == field) {
                displayChange_field_aereo_status(row, status);
        }
        if ("aereo_direcao" == field) {
                displayChange_field_aereo_direcao(row, status);
        }
        if ("aereo_bloqueio_id" == field) {
                displayChange_field_aereo_bloqueio_id(row, status);
        }
        if ("aereo_cia_aerea" == field) {
                displayChange_field_aereo_cia_aerea(row, status);
        }
        if ("aereo_origem" == field) {
                displayChange_field_aereo_origem(row, status);
        }
        if ("aereo_destino" == field) {
                displayChange_field_aereo_destino(row, status);
        }
        if ("aereo_dt_saida" == field) {
                displayChange_field_aereo_dt_saida(row, status);
        }
        if ("aereo_hr_saida" == field) {
                displayChange_field_aereo_hr_saida(row, status);
        }
        if ("aereo_dt_chegada" == field) {
                displayChange_field_aereo_dt_chegada(row, status);
        }
        if ("aereo_hr_chegada" == field) {
                displayChange_field_aereo_hr_chegada(row, status);
        }
        if ("aereo_num_voo" == field) {
                displayChange_field_aereo_num_voo(row, status);
        }
        if ("aereo_localizador" == field) {
                displayChange_field_aereo_localizador(row, status);
        }
        if ("aereo_eticket" == field) {
                displayChange_field_aereo_eticket(row, status);
        }
        if ("aereo_assento" == field) {
                displayChange_field_aereo_assento(row, status);
        }
        if ("aereo_emitida_bvt" == field) {
                displayChange_field_aereo_emitida_bvt(row, status);
        }
        if ("aereo_valor" == field) {
                displayChange_field_aereo_valor(row, status);
        }
        if ("aereo_transfer_tipo" == field) {
                displayChange_field_aereo_transfer_tipo(row, status);
        }
        if ("titulo_api" == field) {
                displayChange_field_titulo_api(row, status);
        }
        if ("descricao_api" == field) {
                displayChange_field_descricao_api(row, status);
        }
        if ("cod_rota_api" == field) {
                displayChange_field_cod_rota_api(row, status);
        }
        if ("tipo_api" == field) {
                displayChange_field_tipo_api(row, status);
        }
        if ("valido_de_api" == field) {
                displayChange_field_valido_de_api(row, status);
        }
        if ("valido_ate_api" == field) {
                displayChange_field_valido_ate_api(row, status);
        }
        if ("duracao_voo_api" == field) {
                displayChange_field_duracao_voo_api(row, status);
        }
        if ("aeronave_api" == field) {
                displayChange_field_aeronave_api(row, status);
        }
        if ("terminal_api" == field) {
                displayChange_field_terminal_api(row, status);
        }
        if ("gate_api" == field) {
                displayChange_field_gate_api(row, status);
        }
        if ("refeicao_api" == field) {
                displayChange_field_refeicao_api(row, status);
        }
        if ("milhagem_api" == field) {
                displayChange_field_milhagem_api(row, status);
        }
        if ("web_ckeckin_api" == field) {
                displayChange_field_web_ckeckin_api(row, status);
        }
        if ("duracao_escala" == field) {
                displayChange_field_duracao_escala(row, status);
        }
        if ("aeroporto_escala" == field) {
                displayChange_field_aeroporto_escala(row, status);
        }
        if ("numero_voo_escala" == field) {
                displayChange_field_numero_voo_escala(row, status);
        }
        if ("hora_saida_escala" == field) {
                displayChange_field_hora_saida_escala(row, status);
        }
        if ("hora_chegada_escala" == field) {
                displayChange_field_hora_chegada_escala(row, status);
        }
        if ("classe_api" == field) {
                displayChange_field_classe_api(row, status);
        }
        if ("passageiro_api" == field) {
                displayChange_field_passageiro_api(row, status);
        }
        if ("bagagem_api" == field) {
                displayChange_field_bagagem_api(row, status);
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
        if ("atendente" == field) {
                displayChange_field_atendente(row, status);
        }
        if ("aereo_id_usuario" == field) {
                displayChange_field_aereo_id_usuario(row, status);
        }
        if ("aereo_ativo" == field) {
                displayChange_field_aereo_ativo(row, status);
        }
        if ("aereo_dthr_saida" == field) {
                displayChange_field_aereo_dthr_saida(row, status);
        }
        if ("aereo_dthr_chegada" == field) {
                displayChange_field_aereo_dthr_chegada(row, status);
        }
        if ("id_origem_gate" == field) {
                displayChange_field_id_origem_gate(row, status);
        }
        if ("aereo_trecho" == field) {
                displayChange_field_aereo_trecho(row, status);
        }
        if ("aereo_modificado_em" == field) {
                displayChange_field_aereo_modificado_em(row, status);
        }
        if ("nome_pax_gate" == field) {
                displayChange_field_nome_pax_gate(row, status);
        }
        if ("nota_gate" == field) {
                displayChange_field_nota_gate(row, status);
        }
        if ("data_nota_gate" == field) {
                displayChange_field_data_nota_gate(row, status);
        }
        if ("fil_agt_gate" == field) {
                displayChange_field_fil_agt_gate(row, status);
        }
        if ("aereo_cia_aerea_gate" == field) {
                displayChange_field_aereo_cia_aerea_gate(row, status);
        }
        if ("cpf_del" == field) {
                displayChange_field_cpf_del(row, status);
        }
        if ("sql_log" == field) {
                displayChange_field_sql_log(row, status);
        }
}

function displayChange_field_aereo_cpf_particip(row, status) {
    var fieldId;
}

function displayChange_field_tipo_pessoa(row, status) {
    var fieldId;
}

function displayChange_field_enviar_app(row, status) {
    var fieldId;
}

function displayChange_field_aereo_status(row, status) {
    var fieldId;
}

function displayChange_field_aereo_direcao(row, status) {
    var fieldId;
}

function displayChange_field_aereo_bloqueio_id(row, status) {
    var fieldId;
}

function displayChange_field_aereo_cia_aerea(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_aereo_cia_aerea__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_aereo_cia_aerea' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_aereo_cia_aerea" + row).select2("destroy");
                }
                scJQSelect2Add(row, "aereo_cia_aerea");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_aereo_cia_aerea' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_aereo_origem(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_aereo_origem__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_aereo_origem' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_aereo_origem" + row).select2("destroy");
                }
                scJQSelect2Add(row, "aereo_origem");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_aereo_origem' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_aereo_destino(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_aereo_destino__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_aereo_destino' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_aereo_destino" + row).select2("destroy");
                }
                scJQSelect2Add(row, "aereo_destino");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_aereo_destino' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_aereo_dt_saida(row, status) {
    var fieldId;
}

function displayChange_field_aereo_hr_saida(row, status) {
    var fieldId;
}

function displayChange_field_aereo_dt_chegada(row, status) {
    var fieldId;
}

function displayChange_field_aereo_hr_chegada(row, status) {
    var fieldId;
}

function displayChange_field_aereo_num_voo(row, status) {
    var fieldId;
}

function displayChange_field_aereo_localizador(row, status) {
    var fieldId;
}

function displayChange_field_aereo_eticket(row, status) {
    var fieldId;
}

function displayChange_field_aereo_assento(row, status) {
    var fieldId;
}

function displayChange_field_aereo_emitida_bvt(row, status) {
    var fieldId;
}

function displayChange_field_aereo_valor(row, status) {
    var fieldId;
}

function displayChange_field_aereo_transfer_tipo(row, status) {
    var fieldId;
}

function displayChange_field_titulo_api(row, status) {
    var fieldId;
}

function displayChange_field_descricao_api(row, status) {
    var fieldId;
}

function displayChange_field_cod_rota_api(row, status) {
    var fieldId;
}

function displayChange_field_tipo_api(row, status) {
    var fieldId;
}

function displayChange_field_valido_de_api(row, status) {
    var fieldId;
}

function displayChange_field_valido_ate_api(row, status) {
    var fieldId;
}

function displayChange_field_duracao_voo_api(row, status) {
    var fieldId;
}

function displayChange_field_aeronave_api(row, status) {
    var fieldId;
}

function displayChange_field_terminal_api(row, status) {
    var fieldId;
}

function displayChange_field_gate_api(row, status) {
    var fieldId;
}

function displayChange_field_refeicao_api(row, status) {
    var fieldId;
}

function displayChange_field_milhagem_api(row, status) {
    var fieldId;
}

function displayChange_field_web_ckeckin_api(row, status) {
    var fieldId;
}

function displayChange_field_duracao_escala(row, status) {
    var fieldId;
}

function displayChange_field_aeroporto_escala(row, status) {
    var fieldId;
}

function displayChange_field_numero_voo_escala(row, status) {
    var fieldId;
}

function displayChange_field_hora_saida_escala(row, status) {
    var fieldId;
}

function displayChange_field_hora_chegada_escala(row, status) {
    var fieldId;
}

function displayChange_field_classe_api(row, status) {
    var fieldId;
}

function displayChange_field_passageiro_api(row, status) {
    var fieldId;
}

function displayChange_field_bagagem_api(row, status) {
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

function displayChange_field_atendente(row, status) {
    var fieldId;
}

function displayChange_field_aereo_id_usuario(row, status) {
    var fieldId;
}

function displayChange_field_aereo_ativo(row, status) {
    var fieldId;
}

function displayChange_field_aereo_dthr_saida(row, status) {
    var fieldId;
}

function displayChange_field_aereo_dthr_chegada(row, status) {
    var fieldId;
}

function displayChange_field_id_origem_gate(row, status) {
    var fieldId;
}

function displayChange_field_aereo_trecho(row, status) {
    var fieldId;
}

function displayChange_field_aereo_modificado_em(row, status) {
    var fieldId;
}

function displayChange_field_nome_pax_gate(row, status) {
    var fieldId;
}

function displayChange_field_nota_gate(row, status) {
    var fieldId;
}

function displayChange_field_data_nota_gate(row, status) {
    var fieldId;
}

function displayChange_field_fil_agt_gate(row, status) {
    var fieldId;
}

function displayChange_field_aereo_cia_aerea_gate(row, status) {
    var fieldId;
}

function displayChange_field_cpf_del(row, status) {
    var fieldId;
}

function displayChange_field_sql_log(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
        displayChange_field_aereo_cia_aerea("all", "on");
        displayChange_field_aereo_origem("all", "on");
        displayChange_field_aereo_destino("all", "on");
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_aereos_rsvp_1_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(33);
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
      setTimeout(function() { do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dt_saida(iSeqRow); }, 200);
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
  $("#id_sc_field_aereo_dt_chegada" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_aereo_dt_chegada" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_aereo_dt_chegada" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dt_chegada(iSeqRow); }, 200);
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
      do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dthr_saida(iSeqRow);
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
      do_ajax_form_aereos_rsvp_1_mob_validate_aereo_dthr_chegada(iSeqRow);
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_aereos_rsvp_1_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_aereos_rsvp_1_mob');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_aereos_rsvp_1_mob');
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
  if (null == specificField || "aereo_cia_aerea" == specificField) {
    scJQSelect2Add_aereo_cia_aerea(seqRow);
  }
  if (null == specificField || "aereo_origem" == specificField) {
    scJQSelect2Add_aereo_origem(seqRow);
  }
  if (null == specificField || "aereo_destino" == specificField) {
    scJQSelect2Add_aereo_destino(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_aereo_cia_aerea(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_aereo_cia_aerea_obj" : "#id_sc_field_aereo_cia_aerea" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_aereo_cia_aerea_obj',
      dropdownCssClass: 'css_aereo_cia_aerea_obj',
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
  $('#select2-id_sc_field_aereo_cia_aerea' + seqRow + '-container').addClass('css_aereo_cia_aerea_obj');
} // scJQSelect2Add

function scJQSelect2Add_aereo_origem(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_aereo_origem_obj" : "#id_sc_field_aereo_origem" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_aereo_origem_obj',
      dropdownCssClass: 'css_aereo_origem_obj',
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
  $('#select2-id_sc_field_aereo_origem' + seqRow + '-container').addClass('css_aereo_origem_obj');
} // scJQSelect2Add

function scJQSelect2Add_aereo_destino(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_aereo_destino_obj" : "#id_sc_field_aereo_destino" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_aereo_destino_obj',
      dropdownCssClass: 'css_aereo_destino_obj',
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
  $('#select2-id_sc_field_aereo_destino' + seqRow + '-container').addClass('css_aereo_destino_obj');
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_aereo_cia_aerea) { displayChange_field_aereo_cia_aerea(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_aereo_origem) { displayChange_field_aereo_origem(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_aereo_destino) { displayChange_field_aereo_destino(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
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

