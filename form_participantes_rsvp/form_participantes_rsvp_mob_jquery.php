
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
     if (sField == 'part_id_evento' || sField == 'part_id_evento_publico' || sField == 'part_id_evento_regional' || sField == 'part_tam_camisa' || sField == 'part_idioma' || sField == 'part_pais') {
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
  scEventControl_data["participante_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["importacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nacionalidade" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_cpf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nome" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_ativo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_tipo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_sexo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enviar_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_nome_cracha" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_id_evento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_id_evento_publico" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_id_evento_regional" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_tipo_pessoa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_dt_nasc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_filiacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["estrangeiro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_substituido" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_cod_substituto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_nome_substituto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_sexo_substituto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["guarda_cod_substituto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_empresa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_departamento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_cargo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_grupo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_clube" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dsc_empresa_rsvp" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cod_empresa_rsvp" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_cep" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_logradouro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_numero" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_complemento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_bairro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_cidade" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_uf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_ddd_01" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_fone_01" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_ddd_celular_01" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_celeular_01" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["codigo_telefone_internacional" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_fone_internacional" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_rg" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_passaporte" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_validade_pass" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["emissao_passaporte" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_passaporte_estrangeiro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_cpf_informado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_nacionalidade" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_vacina_fa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["numero_visto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["validade_visto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_visto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_tam_camisa" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_tam_calcado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_idioma" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["idioma_preferido" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_pais" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["pais" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_destaque_negrito" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_fumante" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_restricao_alimentar" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["restricao_mobilidade" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_acompanhado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_cv_obs" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["uid_pulseira_nfc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["roles_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_evento_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["external_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["id_participante_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["external_status" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_nome_secretaria" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_email_secretaria" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_cod_substituido" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["part_nome_substituido" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cpf_del" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sql_log" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["participante_id" + iSeqRow] && scEventControl_data["participante_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["participante_id" + iSeqRow] && scEventControl_data["participante_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["importacao" + iSeqRow] && scEventControl_data["importacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["importacao" + iSeqRow] && scEventControl_data["importacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nacionalidade" + iSeqRow] && scEventControl_data["nacionalidade" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nacionalidade" + iSeqRow] && scEventControl_data["nacionalidade" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_cpf" + iSeqRow] && scEventControl_data["part_cpf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_cpf" + iSeqRow] && scEventControl_data["part_cpf" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nome" + iSeqRow] && scEventControl_data["nome" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome" + iSeqRow] && scEventControl_data["nome" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_ativo" + iSeqRow] && scEventControl_data["part_ativo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_ativo" + iSeqRow] && scEventControl_data["part_ativo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_tipo" + iSeqRow] && scEventControl_data["part_tipo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_tipo" + iSeqRow] && scEventControl_data["part_tipo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_sexo" + iSeqRow] && scEventControl_data["part_sexo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_sexo" + iSeqRow] && scEventControl_data["part_sexo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enviar_app" + iSeqRow] && scEventControl_data["enviar_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enviar_app" + iSeqRow] && scEventControl_data["enviar_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_nome_cracha" + iSeqRow] && scEventControl_data["part_nome_cracha" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_nome_cracha" + iSeqRow] && scEventControl_data["part_nome_cracha" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_id_evento" + iSeqRow] && scEventControl_data["part_id_evento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_id_evento" + iSeqRow] && scEventControl_data["part_id_evento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_id_evento_publico" + iSeqRow] && scEventControl_data["part_id_evento_publico" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_id_evento_publico" + iSeqRow] && scEventControl_data["part_id_evento_publico" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_id_evento_regional" + iSeqRow] && scEventControl_data["part_id_evento_regional" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_id_evento_regional" + iSeqRow] && scEventControl_data["part_id_evento_regional" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_tipo_pessoa" + iSeqRow] && scEventControl_data["part_tipo_pessoa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_tipo_pessoa" + iSeqRow] && scEventControl_data["part_tipo_pessoa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_dt_nasc" + iSeqRow] && scEventControl_data["part_dt_nasc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_dt_nasc" + iSeqRow] && scEventControl_data["part_dt_nasc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_filiacao" + iSeqRow] && scEventControl_data["part_filiacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_filiacao" + iSeqRow] && scEventControl_data["part_filiacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["estrangeiro" + iSeqRow] && scEventControl_data["estrangeiro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["estrangeiro" + iSeqRow] && scEventControl_data["estrangeiro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_substituido" + iSeqRow] && scEventControl_data["part_substituido" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_substituido" + iSeqRow] && scEventControl_data["part_substituido" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_cod_substituto" + iSeqRow] && scEventControl_data["part_cod_substituto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_cod_substituto" + iSeqRow] && scEventControl_data["part_cod_substituto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_nome_substituto" + iSeqRow] && scEventControl_data["part_nome_substituto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_nome_substituto" + iSeqRow] && scEventControl_data["part_nome_substituto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_sexo_substituto" + iSeqRow] && scEventControl_data["part_sexo_substituto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_sexo_substituto" + iSeqRow] && scEventControl_data["part_sexo_substituto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["guarda_cod_substituto" + iSeqRow] && scEventControl_data["guarda_cod_substituto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["guarda_cod_substituto" + iSeqRow] && scEventControl_data["guarda_cod_substituto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_empresa" + iSeqRow] && scEventControl_data["part_empresa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_empresa" + iSeqRow] && scEventControl_data["part_empresa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_departamento" + iSeqRow] && scEventControl_data["part_departamento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_departamento" + iSeqRow] && scEventControl_data["part_departamento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_cargo" + iSeqRow] && scEventControl_data["part_cargo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_cargo" + iSeqRow] && scEventControl_data["part_cargo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_grupo" + iSeqRow] && scEventControl_data["part_grupo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_grupo" + iSeqRow] && scEventControl_data["part_grupo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_clube" + iSeqRow] && scEventControl_data["part_clube" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_clube" + iSeqRow] && scEventControl_data["part_clube" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dsc_empresa_rsvp" + iSeqRow] && scEventControl_data["dsc_empresa_rsvp" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dsc_empresa_rsvp" + iSeqRow] && scEventControl_data["dsc_empresa_rsvp" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cod_empresa_rsvp" + iSeqRow] && scEventControl_data["cod_empresa_rsvp" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cod_empresa_rsvp" + iSeqRow] && scEventControl_data["cod_empresa_rsvp" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_cep" + iSeqRow] && scEventControl_data["part_cep" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_cep" + iSeqRow] && scEventControl_data["part_cep" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_logradouro" + iSeqRow] && scEventControl_data["part_logradouro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_logradouro" + iSeqRow] && scEventControl_data["part_logradouro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_numero" + iSeqRow] && scEventControl_data["part_numero" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_numero" + iSeqRow] && scEventControl_data["part_numero" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_complemento" + iSeqRow] && scEventControl_data["part_complemento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_complemento" + iSeqRow] && scEventControl_data["part_complemento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_bairro" + iSeqRow] && scEventControl_data["part_bairro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_bairro" + iSeqRow] && scEventControl_data["part_bairro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_cidade" + iSeqRow] && scEventControl_data["part_cidade" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_cidade" + iSeqRow] && scEventControl_data["part_cidade" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_uf" + iSeqRow] && scEventControl_data["part_uf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_uf" + iSeqRow] && scEventControl_data["part_uf" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_ddd_01" + iSeqRow] && scEventControl_data["part_ddd_01" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_ddd_01" + iSeqRow] && scEventControl_data["part_ddd_01" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_fone_01" + iSeqRow] && scEventControl_data["part_fone_01" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_fone_01" + iSeqRow] && scEventControl_data["part_fone_01" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_ddd_celular_01" + iSeqRow] && scEventControl_data["part_ddd_celular_01" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_ddd_celular_01" + iSeqRow] && scEventControl_data["part_ddd_celular_01" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_celeular_01" + iSeqRow] && scEventControl_data["part_celeular_01" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_celeular_01" + iSeqRow] && scEventControl_data["part_celeular_01" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["codigo_telefone_internacional" + iSeqRow] && scEventControl_data["codigo_telefone_internacional" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["codigo_telefone_internacional" + iSeqRow] && scEventControl_data["codigo_telefone_internacional" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_fone_internacional" + iSeqRow] && scEventControl_data["part_fone_internacional" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_fone_internacional" + iSeqRow] && scEventControl_data["part_fone_internacional" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_rg" + iSeqRow] && scEventControl_data["part_rg" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_rg" + iSeqRow] && scEventControl_data["part_rg" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_passaporte" + iSeqRow] && scEventControl_data["part_passaporte" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_passaporte" + iSeqRow] && scEventControl_data["part_passaporte" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_validade_pass" + iSeqRow] && scEventControl_data["part_validade_pass" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_validade_pass" + iSeqRow] && scEventControl_data["part_validade_pass" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["emissao_passaporte" + iSeqRow] && scEventControl_data["emissao_passaporte" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["emissao_passaporte" + iSeqRow] && scEventControl_data["emissao_passaporte" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_passaporte_estrangeiro" + iSeqRow] && scEventControl_data["part_passaporte_estrangeiro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_passaporte_estrangeiro" + iSeqRow] && scEventControl_data["part_passaporte_estrangeiro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_cpf_informado" + iSeqRow] && scEventControl_data["part_cpf_informado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_cpf_informado" + iSeqRow] && scEventControl_data["part_cpf_informado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_nacionalidade" + iSeqRow] && scEventControl_data["part_nacionalidade" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_nacionalidade" + iSeqRow] && scEventControl_data["part_nacionalidade" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_vacina_fa" + iSeqRow] && scEventControl_data["part_vacina_fa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_vacina_fa" + iSeqRow] && scEventControl_data["part_vacina_fa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["numero_visto" + iSeqRow] && scEventControl_data["numero_visto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["numero_visto" + iSeqRow] && scEventControl_data["numero_visto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["validade_visto" + iSeqRow] && scEventControl_data["validade_visto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["validade_visto" + iSeqRow] && scEventControl_data["validade_visto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_visto" + iSeqRow] && scEventControl_data["part_visto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_visto" + iSeqRow] && scEventControl_data["part_visto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_tam_camisa" + iSeqRow] && scEventControl_data["part_tam_camisa" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_tam_camisa" + iSeqRow] && scEventControl_data["part_tam_camisa" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_tam_calcado" + iSeqRow] && scEventControl_data["part_tam_calcado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_tam_calcado" + iSeqRow] && scEventControl_data["part_tam_calcado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_idioma" + iSeqRow] && scEventControl_data["part_idioma" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_idioma" + iSeqRow] && scEventControl_data["part_idioma" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["idioma_preferido" + iSeqRow] && scEventControl_data["idioma_preferido" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["idioma_preferido" + iSeqRow] && scEventControl_data["idioma_preferido" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_pais" + iSeqRow] && scEventControl_data["part_pais" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_pais" + iSeqRow] && scEventControl_data["part_pais" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pais" + iSeqRow] && scEventControl_data["pais" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pais" + iSeqRow] && scEventControl_data["pais" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_destaque_negrito" + iSeqRow] && scEventControl_data["part_destaque_negrito" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_destaque_negrito" + iSeqRow] && scEventControl_data["part_destaque_negrito" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_fumante" + iSeqRow] && scEventControl_data["part_fumante" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_fumante" + iSeqRow] && scEventControl_data["part_fumante" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_restricao_alimentar" + iSeqRow] && scEventControl_data["part_restricao_alimentar" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_restricao_alimentar" + iSeqRow] && scEventControl_data["part_restricao_alimentar" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["restricao_mobilidade" + iSeqRow] && scEventControl_data["restricao_mobilidade" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["restricao_mobilidade" + iSeqRow] && scEventControl_data["restricao_mobilidade" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_acompanhado" + iSeqRow] && scEventControl_data["part_acompanhado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_acompanhado" + iSeqRow] && scEventControl_data["part_acompanhado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_cv_obs" + iSeqRow] && scEventControl_data["part_cv_obs" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_cv_obs" + iSeqRow] && scEventControl_data["part_cv_obs" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["uid_pulseira_nfc" + iSeqRow] && scEventControl_data["uid_pulseira_nfc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["uid_pulseira_nfc" + iSeqRow] && scEventControl_data["uid_pulseira_nfc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["roles_app" + iSeqRow] && scEventControl_data["roles_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["roles_app" + iSeqRow] && scEventControl_data["roles_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_evento_app" + iSeqRow] && scEventControl_data["id_evento_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_evento_app" + iSeqRow] && scEventControl_data["id_evento_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["external_id" + iSeqRow] && scEventControl_data["external_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["external_id" + iSeqRow] && scEventControl_data["external_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["id_participante_app" + iSeqRow] && scEventControl_data["id_participante_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["id_participante_app" + iSeqRow] && scEventControl_data["id_participante_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["external_status" + iSeqRow] && scEventControl_data["external_status" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["external_status" + iSeqRow] && scEventControl_data["external_status" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_email" + iSeqRow] && scEventControl_data["part_email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_email" + iSeqRow] && scEventControl_data["part_email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_nome_secretaria" + iSeqRow] && scEventControl_data["part_nome_secretaria" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_nome_secretaria" + iSeqRow] && scEventControl_data["part_nome_secretaria" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_email_secretaria" + iSeqRow] && scEventControl_data["part_email_secretaria" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_email_secretaria" + iSeqRow] && scEventControl_data["part_email_secretaria" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_cod_substituido" + iSeqRow] && scEventControl_data["part_cod_substituido" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_cod_substituido" + iSeqRow] && scEventControl_data["part_cod_substituido" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["part_nome_substituido" + iSeqRow] && scEventControl_data["part_nome_substituido" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["part_nome_substituido" + iSeqRow] && scEventControl_data["part_nome_substituido" + iSeqRow]["change"]) {
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
  if ("nacionalidade" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("part_id_evento" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("part_id_evento_publico" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("part_id_evento_regional" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("dsc_empresa_rsvp" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("part_tam_camisa" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("part_idioma" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("part_pais" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("roles_app" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("dsc_empresa_rsvp" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("nacionalidade" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("part_cod_substituido" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("part_cod_substituto" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("part_cpf_informado" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("part_cpf" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("part_email" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("part_id_evento_publico" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("part_id_evento_regional" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("uid_pulseira_nfc" + iSeq == fieldName) {
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
  $('#id_sc_field_participante_id' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_participante_id_onblur('#id_sc_field_participante_id' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_participantes_rsvp_participante_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_ativo' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_ativo_onblur('#id_sc_field_part_ativo' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_participantes_rsvp_part_ativo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_sexo' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_sexo_onblur('#id_sc_field_part_sexo' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_participantes_rsvp_part_sexo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_cpf' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_participantes_rsvp_part_cpf_onblur('#id_sc_field_part_cpf' + iSeqRow, iSeqRow, event);}, 300) })
                                      .bind('change', function() { sc_form_participantes_rsvp_part_cpf_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_participantes_rsvp_part_cpf_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_tipo' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_tipo_onblur('#id_sc_field_part_tipo' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_participantes_rsvp_part_tipo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_nome_cracha' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_nome_cracha_onblur('#id_sc_field_part_nome_cracha' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_part_nome_cracha_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_id_evento' + iSeqRow).bind('select2:close', function() { sc_form_participantes_rsvp_part_id_evento_onblur('#id_sc_field_part_id_evento' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_participantes_rsvp_part_id_evento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_id_evento_publico' + iSeqRow).bind('select2:close', function() { sc_form_participantes_rsvp_part_id_evento_publico_onblur('#id_sc_field_part_id_evento_publico' + iSeqRow, iSeqRow, event) })
                                                    .bind('change', function() { sc_form_participantes_rsvp_part_id_evento_publico_onchange(this, iSeqRow, event) })
                                                    .bind('focus', function() { sc_form_participantes_rsvp_part_id_evento_publico_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_id_evento_regional' + iSeqRow).bind('select2:close', function() { sc_form_participantes_rsvp_part_id_evento_regional_onblur('#id_sc_field_part_id_evento_regional' + iSeqRow, iSeqRow, event) })
                                                     .bind('change', function() { sc_form_participantes_rsvp_part_id_evento_regional_onchange(this, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_participantes_rsvp_part_id_evento_regional_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_tipo_pessoa' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_tipo_pessoa_onblur('#id_sc_field_part_tipo_pessoa' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_part_tipo_pessoa_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_substituido' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_substituido_onblur('#id_sc_field_part_substituido' + iSeqRow, iSeqRow, event) })
                                              .bind('click', function() { sc_form_participantes_rsvp_part_substituido_onclick(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_part_substituido_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_cod_substituto' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_cod_substituto_onblur('#id_sc_field_part_cod_substituto' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_participantes_rsvp_part_cod_substituto_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_participantes_rsvp_part_cod_substituto_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_nome_substituto' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_nome_substituto_onblur('#id_sc_field_part_nome_substituto' + iSeqRow, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_participantes_rsvp_part_nome_substituto_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_sexo_substituto' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_sexo_substituto_onblur('#id_sc_field_part_sexo_substituto' + iSeqRow, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_participantes_rsvp_part_sexo_substituto_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_cod_substituido' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_cod_substituido_onblur('#id_sc_field_part_cod_substituido' + iSeqRow, iSeqRow, event) })
                                                  .bind('change', function() { sc_form_participantes_rsvp_part_cod_substituido_onchange(this, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_participantes_rsvp_part_cod_substituido_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_nome_substituido' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_nome_substituido_onblur('#id_sc_field_part_nome_substituido' + iSeqRow, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_participantes_rsvp_part_nome_substituido_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_grupo' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_grupo_onblur('#id_sc_field_part_grupo' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_participantes_rsvp_part_grupo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_clube' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_clube_onblur('#id_sc_field_part_clube' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_participantes_rsvp_part_clube_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_empresa' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_empresa_onblur('#id_sc_field_part_empresa' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_participantes_rsvp_part_empresa_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_cep' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_cep_onblur('#id_sc_field_part_cep' + iSeqRow, iSeqRow, event) })
                                      .bind('change', function() { sc_form_participantes_rsvp_part_cep_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_participantes_rsvp_part_cep_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_departamento' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_departamento_onblur('#id_sc_field_part_departamento' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_participantes_rsvp_part_departamento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_cargo' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_cargo_onblur('#id_sc_field_part_cargo' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_participantes_rsvp_part_cargo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_logradouro' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_logradouro_onblur('#id_sc_field_part_logradouro' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_participantes_rsvp_part_logradouro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_numero' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_numero_onblur('#id_sc_field_part_numero' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_participantes_rsvp_part_numero_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_complemento' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_complemento_onblur('#id_sc_field_part_complemento' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_part_complemento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_bairro' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_bairro_onblur('#id_sc_field_part_bairro' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_participantes_rsvp_part_bairro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_cidade' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_cidade_onblur('#id_sc_field_part_cidade' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_participantes_rsvp_part_cidade_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_uf' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_uf_onblur('#id_sc_field_part_uf' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_participantes_rsvp_part_uf_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_ddd_01' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_ddd_01_onblur('#id_sc_field_part_ddd_01' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_participantes_rsvp_part_ddd_01_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_fone_01' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_fone_01_onblur('#id_sc_field_part_fone_01' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_participantes_rsvp_part_fone_01_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_ddd_celular_01' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_ddd_celular_01_onblur('#id_sc_field_part_ddd_celular_01' + iSeqRow, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_participantes_rsvp_part_ddd_celular_01_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_celeular_01' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_celeular_01_onblur('#id_sc_field_part_celeular_01' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_part_celeular_01_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_fone_internacional' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_fone_internacional_onblur('#id_sc_field_part_fone_internacional' + iSeqRow, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_participantes_rsvp_part_fone_internacional_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_email' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_email_onblur('#id_sc_field_part_email' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_participantes_rsvp_part_email_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_participantes_rsvp_part_email_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_dt_nasc' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_dt_nasc_onblur('#id_sc_field_part_dt_nasc' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_participantes_rsvp_part_dt_nasc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_rg' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_rg_onblur('#id_sc_field_part_rg' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_participantes_rsvp_part_rg_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_passaporte' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_passaporte_onblur('#id_sc_field_part_passaporte' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_participantes_rsvp_part_passaporte_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_validade_pass' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_validade_pass_onblur('#id_sc_field_part_validade_pass' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_participantes_rsvp_part_validade_pass_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_passaporte_estrangeiro' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_passaporte_estrangeiro_onblur('#id_sc_field_part_passaporte_estrangeiro' + iSeqRow, iSeqRow, event) })
                                                         .bind('focus', function() { sc_form_participantes_rsvp_part_passaporte_estrangeiro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_tam_camisa' + iSeqRow).bind('select2:close', function() { sc_form_participantes_rsvp_part_tam_camisa_onblur('#id_sc_field_part_tam_camisa' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_participantes_rsvp_part_tam_camisa_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_tam_calcado' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_tam_calcado_onblur('#id_sc_field_part_tam_calcado' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_part_tam_calcado_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_idioma' + iSeqRow).bind('select2:close', function() { sc_form_participantes_rsvp_part_idioma_onblur('#id_sc_field_part_idioma' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_participantes_rsvp_part_idioma_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_filiacao' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_filiacao_onblur('#id_sc_field_part_filiacao' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_participantes_rsvp_part_filiacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_pais' + iSeqRow).bind('select2:close', function() { sc_form_participantes_rsvp_part_pais_onblur('#id_sc_field_part_pais' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_participantes_rsvp_part_pais_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_nome_secretaria' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_nome_secretaria_onblur('#id_sc_field_part_nome_secretaria' + iSeqRow, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_participantes_rsvp_part_nome_secretaria_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_email_secretaria' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_email_secretaria_onblur('#id_sc_field_part_email_secretaria' + iSeqRow, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_participantes_rsvp_part_email_secretaria_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_destaque_negrito' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_destaque_negrito_onblur('#id_sc_field_part_destaque_negrito' + iSeqRow, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_participantes_rsvp_part_destaque_negrito_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_fumante' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_fumante_onblur('#id_sc_field_part_fumante' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_participantes_rsvp_part_fumante_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_restricao_alimentar' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_restricao_alimentar_onblur('#id_sc_field_part_restricao_alimentar' + iSeqRow, iSeqRow, event) })
                                                      .bind('focus', function() { sc_form_participantes_rsvp_part_restricao_alimentar_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_acompanhado' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_acompanhado_onblur('#id_sc_field_part_acompanhado' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_part_acompanhado_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_guarda_cod_substituto' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_guarda_cod_substituto_onblur('#id_sc_field_guarda_cod_substituto' + iSeqRow, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_participantes_rsvp_guarda_cod_substituto_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_cpf_informado' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_cpf_informado_onblur('#id_sc_field_part_cpf_informado' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_participantes_rsvp_part_cpf_informado_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_participantes_rsvp_part_cpf_informado_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_cv_obs' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_cv_obs_onblur('#id_sc_field_part_cv_obs' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_participantes_rsvp_part_cv_obs_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cod_empresa_rsvp' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_cod_empresa_rsvp_onblur('#id_sc_field_cod_empresa_rsvp' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_cod_empresa_rsvp_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_dsc_empresa_rsvp' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_dsc_empresa_rsvp_onblur('#id_sc_field_dsc_empresa_rsvp' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_participantes_rsvp_dsc_empresa_rsvp_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_dsc_empresa_rsvp_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_visto' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_visto_onblur('#id_sc_field_part_visto' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_participantes_rsvp_part_visto_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_vacina_fa' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_vacina_fa_onblur('#id_sc_field_part_vacina_fa' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_participantes_rsvp_part_vacina_fa_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_part_nacionalidade' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_part_nacionalidade_onblur('#id_sc_field_part_nacionalidade' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_participantes_rsvp_part_nacionalidade_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_evento_app' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_id_evento_app_onblur('#id_sc_field_id_evento_app' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_participantes_rsvp_id_evento_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_id_participante_app' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_id_participante_app_onblur('#id_sc_field_id_participante_app' + iSeqRow, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_participantes_rsvp_id_participante_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_roles_app' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_roles_app_onblur('#id_sc_field_roles_app' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_participantes_rsvp_roles_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_external_id' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_external_id_onblur('#id_sc_field_external_id' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_participantes_rsvp_external_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_external_status' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_external_status_onblur('#id_sc_field_external_status' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_participantes_rsvp_external_status_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_restricao_mobilidade' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_restricao_mobilidade_onblur('#id_sc_field_restricao_mobilidade' + iSeqRow, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_participantes_rsvp_restricao_mobilidade_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_enviar_app' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_enviar_app_onblur('#id_sc_field_enviar_app' + iSeqRow, iSeqRow, event) })
                                        .bind('click', function() { sc_form_participantes_rsvp_enviar_app_onclick(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_participantes_rsvp_enviar_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_uid_pulseira_nfc' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_uid_pulseira_nfc_onblur('#id_sc_field_uid_pulseira_nfc' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_participantes_rsvp_uid_pulseira_nfc_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_uid_pulseira_nfc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_emissao_passaporte' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_emissao_passaporte_onblur('#id_sc_field_emissao_passaporte' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_participantes_rsvp_emissao_passaporte_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_numero_visto' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_numero_visto_onblur('#id_sc_field_numero_visto' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_participantes_rsvp_numero_visto_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_validade_visto' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_validade_visto_onblur('#id_sc_field_validade_visto' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_participantes_rsvp_validade_visto_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_estrangeiro' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_estrangeiro_onblur('#id_sc_field_estrangeiro' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_participantes_rsvp_estrangeiro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_codigo_telefone_internacional' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_codigo_telefone_internacional_onblur('#id_sc_field_codigo_telefone_internacional' + iSeqRow, iSeqRow, event) })
                                                           .bind('focus', function() { sc_form_participantes_rsvp_codigo_telefone_internacional_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_idioma_preferido' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_idioma_preferido_onblur('#id_sc_field_idioma_preferido' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_participantes_rsvp_idioma_preferido_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_pais' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_pais_onblur('#id_sc_field_pais' + iSeqRow, iSeqRow, event) })
                                  .bind('focus', function() { sc_form_participantes_rsvp_pais_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cpf_del' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_cpf_del_onblur('#id_sc_field_cpf_del' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_participantes_rsvp_cpf_del_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_importacao' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_importacao_onblur('#id_sc_field_importacao' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_participantes_rsvp_importacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nacionalidade' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_participantes_rsvp_nacionalidade_onblur('#id_sc_field_nacionalidade' + iSeqRow, iSeqRow, event);}, 300) })
                                           .bind('change', function() { sc_form_participantes_rsvp_nacionalidade_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_participantes_rsvp_nacionalidade_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_nome_onblur('#id_sc_field_nome' + iSeqRow, iSeqRow, event) })
                                  .bind('focus', function() { sc_form_participantes_rsvp_nome_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_sql_log' + iSeqRow).bind('blur', function() { sc_form_participantes_rsvp_sql_log_onblur('#id_sc_field_sql_log' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_participantes_rsvp_sql_log_onfocus(this, iSeqRow, event) });
  $('.sc-ui-radio-importacao' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-part_ativo' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-part_sexo' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-enviar_app' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-part_tipo_pessoa' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-estrangeiro' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-part_substituido' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-part_sexo_substituto' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-part_passaporte_estrangeiro' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-part_destaque_negrito' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-part_fumante' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-part_acompanhado' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_participantes_rsvp_participante_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_participante_id();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_participante_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_ativo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_ativo();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_ativo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_sexo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_sexo();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_sexo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_cpf_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_cpf();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_cpf_onchange(oThis, iSeqRow, event) {
  lookup_part_cpf();
  do_ajax_form_participantes_rsvp_mob_event_part_cpf_onchange();
}

function sc_form_participantes_rsvp_part_cpf_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_tipo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_tipo();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_tipo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_nome_cracha_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_nome_cracha();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_nome_cracha_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_id_evento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_id_evento();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_id_evento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_id_evento_publico_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_publico();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_id_evento_publico_onchange(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_part_id_evento_publico_onchange();
}

function sc_form_participantes_rsvp_part_id_evento_publico_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_id_evento_regional_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_id_evento_regional();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_id_evento_regional_onchange(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_part_id_evento_regional_onchange();
}

function sc_form_participantes_rsvp_part_id_evento_regional_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_tipo_pessoa_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_tipo_pessoa();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_tipo_pessoa_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_substituido_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_substituido();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_substituido_onclick(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_part_substituido_onclick();
}

function sc_form_participantes_rsvp_part_substituido_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_cod_substituto_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituto();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_cod_substituto_onchange(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_part_cod_substituto_onchange();
}

function sc_form_participantes_rsvp_part_cod_substituto_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_nome_substituto_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituto();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_nome_substituto_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_sexo_substituto_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_sexo_substituto();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_sexo_substituto_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_cod_substituido_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_cod_substituido();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_cod_substituido_onchange(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_part_cod_substituido_onchange();
}

function sc_form_participantes_rsvp_part_cod_substituido_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_nome_substituido_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_nome_substituido();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_nome_substituido_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_grupo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_grupo();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_grupo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_clube_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_clube();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_clube_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_empresa_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_empresa();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_empresa_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_cep_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_cep();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_cep_onchange(oThis, iSeqRow, event) {
  cep_part_cep(oThis.value, 'F1;CEP,part_cep');
}

function sc_form_participantes_rsvp_part_cep_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_departamento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_departamento();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_departamento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_cargo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_cargo();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_cargo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_logradouro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_logradouro();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_logradouro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_numero_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_numero();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_numero_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_complemento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_complemento();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_complemento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_bairro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_bairro();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_bairro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_cidade_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_cidade();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_cidade_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_uf_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_uf();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_uf_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_ddd_01_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_ddd_01();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_ddd_01_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_fone_01_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_fone_01();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_fone_01_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_ddd_celular_01_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_ddd_celular_01();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_ddd_celular_01_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_celeular_01_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_celeular_01();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_celeular_01_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_fone_internacional_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_fone_internacional();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_fone_internacional_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_email_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_email();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_email_onchange(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_part_email_onchange();
}

function sc_form_participantes_rsvp_part_email_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_dt_nasc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_dt_nasc();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_dt_nasc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_rg_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_rg();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_rg_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_passaporte_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_passaporte();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_passaporte_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_validade_pass_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_validade_pass();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_validade_pass_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_passaporte_estrangeiro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_passaporte_estrangeiro();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_passaporte_estrangeiro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_tam_camisa_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_tam_camisa();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_tam_camisa_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_tam_calcado_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_tam_calcado();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_tam_calcado_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_idioma_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_idioma();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_idioma_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_filiacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_filiacao();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_filiacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_pais_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_pais();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_pais_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_nome_secretaria_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_nome_secretaria();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_nome_secretaria_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_email_secretaria_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_email_secretaria();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_email_secretaria_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_destaque_negrito_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_destaque_negrito();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_destaque_negrito_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_fumante_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_fumante();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_fumante_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_restricao_alimentar_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_restricao_alimentar();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_restricao_alimentar_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_acompanhado_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_acompanhado();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_acompanhado_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_guarda_cod_substituto_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_guarda_cod_substituto();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_guarda_cod_substituto_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_cpf_informado_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_cpf_informado();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_cpf_informado_onchange(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_part_cpf_informado_onchange();
}

function sc_form_participantes_rsvp_part_cpf_informado_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_cv_obs_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_cv_obs();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_cv_obs_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_cod_empresa_rsvp_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_cod_empresa_rsvp();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_cod_empresa_rsvp_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_dsc_empresa_rsvp_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_dsc_empresa_rsvp();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_dsc_empresa_rsvp_onchange(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_dsc_empresa_rsvp_onchange();
}

function sc_form_participantes_rsvp_dsc_empresa_rsvp_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_visto_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_visto();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_visto_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_vacina_fa_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_vacina_fa();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_vacina_fa_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_part_nacionalidade_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_part_nacionalidade();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_part_nacionalidade_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_id_evento_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_id_evento_app();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_id_evento_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_id_participante_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_id_participante_app();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_id_participante_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_roles_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_roles_app();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_roles_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_external_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_external_id();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_external_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_external_status_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_external_status();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_external_status_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_restricao_mobilidade_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_restricao_mobilidade();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_restricao_mobilidade_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_enviar_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_enviar_app();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_enviar_app_onclick(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_enviar_app_onclick();
}

function sc_form_participantes_rsvp_enviar_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_uid_pulseira_nfc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_uid_pulseira_nfc();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_uid_pulseira_nfc_onchange(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_uid_pulseira_nfc_onchange();
}

function sc_form_participantes_rsvp_uid_pulseira_nfc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_emissao_passaporte_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_emissao_passaporte();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_emissao_passaporte_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_numero_visto_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_numero_visto();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_numero_visto_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_validade_visto_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_validade_visto();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_validade_visto_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_estrangeiro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_estrangeiro();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_estrangeiro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_codigo_telefone_internacional_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_codigo_telefone_internacional();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_codigo_telefone_internacional_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_idioma_preferido_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_idioma_preferido();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_idioma_preferido_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_pais_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_pais();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_pais_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_cpf_del_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_cpf_del();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_cpf_del_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_importacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_importacao();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_importacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_nacionalidade_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_nacionalidade();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_nacionalidade_onchange(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_event_nacionalidade_onchange();
}

function sc_form_participantes_rsvp_nacionalidade_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_nome_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_nome();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_nome_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_participantes_rsvp_sql_log_onblur(oThis, iSeqRow, event) {
  do_ajax_form_participantes_rsvp_mob_validate_sql_log();
  scCssBlur(oThis);
}

function sc_form_participantes_rsvp_sql_log_onfocus(oThis, iSeqRow, event) {
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
        if ("5" == block) {
                displayChange_block_5(status);
        }
        if ("6" == block) {
                displayChange_block_6(status);
        }
        if ("7" == block) {
                displayChange_block_7(status);
        }
        if ("8" == block) {
                displayChange_block_8(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("participante_id", "", status);
        displayChange_field("importacao", "", status);
        displayChange_field("nacionalidade", "", status);
        displayChange_field("part_cpf", "", status);
        displayChange_field("nome", "", status);
        displayChange_field("part_ativo", "", status);
        displayChange_field("part_tipo", "", status);
        displayChange_field("part_sexo", "", status);
        displayChange_field("enviar_app", "", status);
        displayChange_field("part_nome_cracha", "", status);
        displayChange_field("part_id_evento", "", status);
        displayChange_field("part_id_evento_publico", "", status);
        displayChange_field("part_id_evento_regional", "", status);
        displayChange_field("part_tipo_pessoa", "", status);
        displayChange_field("part_dt_nasc", "", status);
        displayChange_field("part_filiacao", "", status);
        displayChange_field("estrangeiro", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("part_substituido", "", status);
        displayChange_field("part_cod_substituto", "", status);
        displayChange_field("part_nome_substituto", "", status);
        displayChange_field("part_sexo_substituto", "", status);
        displayChange_field("guarda_cod_substituto", "", status);
}

function displayChange_block_2(status) {
        displayChange_field("part_empresa", "", status);
        displayChange_field("part_departamento", "", status);
        displayChange_field("part_cargo", "", status);
        displayChange_field("part_grupo", "", status);
        displayChange_field("part_clube", "", status);
        displayChange_field("dsc_empresa_rsvp", "", status);
        displayChange_field("cod_empresa_rsvp", "", status);
}

function displayChange_block_3(status) {
        displayChange_field("part_cep", "", status);
        displayChange_field("part_logradouro", "", status);
        displayChange_field("part_numero", "", status);
        displayChange_field("part_complemento", "", status);
        displayChange_field("part_bairro", "", status);
        displayChange_field("part_cidade", "", status);
        displayChange_field("part_uf", "", status);
}

function displayChange_block_4(status) {
        displayChange_field("part_ddd_01", "", status);
        displayChange_field("part_fone_01", "", status);
        displayChange_field("part_ddd_celular_01", "", status);
        displayChange_field("part_celeular_01", "", status);
        displayChange_field("codigo_telefone_internacional", "", status);
        displayChange_field("part_fone_internacional", "", status);
}

function displayChange_block_5(status) {
        displayChange_field("part_rg", "", status);
        displayChange_field("part_passaporte", "", status);
        displayChange_field("part_validade_pass", "", status);
        displayChange_field("emissao_passaporte", "", status);
        displayChange_field("part_passaporte_estrangeiro", "", status);
        displayChange_field("part_cpf_informado", "", status);
        displayChange_field("part_nacionalidade", "", status);
        displayChange_field("part_vacina_fa", "", status);
        displayChange_field("numero_visto", "", status);
        displayChange_field("validade_visto", "", status);
        displayChange_field("part_visto", "", status);
}

function displayChange_block_6(status) {
        displayChange_field("part_tam_camisa", "", status);
        displayChange_field("part_tam_calcado", "", status);
        displayChange_field("part_idioma", "", status);
        displayChange_field("idioma_preferido", "", status);
        displayChange_field("part_pais", "", status);
        displayChange_field("pais", "", status);
        displayChange_field("part_destaque_negrito", "", status);
        displayChange_field("part_fumante", "", status);
        displayChange_field("part_restricao_alimentar", "", status);
        displayChange_field("restricao_mobilidade", "", status);
        displayChange_field("part_acompanhado", "", status);
        displayChange_field("part_cv_obs", "", status);
        displayChange_field("uid_pulseira_nfc", "", status);
        displayChange_field("roles_app", "", status);
        displayChange_field("id_evento_app", "", status);
        displayChange_field("external_id", "", status);
        displayChange_field("id_participante_app", "", status);
        displayChange_field("external_status", "", status);
}

function displayChange_block_7(status) {
        displayChange_field("part_email", "", status);
        displayChange_field("part_nome_secretaria", "", status);
        displayChange_field("part_email_secretaria", "", status);
}

function displayChange_block_8(status) {
        displayChange_field("part_cod_substituido", "", status);
        displayChange_field("part_nome_substituido", "", status);
        displayChange_field("cpf_del", "", status);
        displayChange_field("sql_log", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_participante_id(row, status);
        displayChange_field_importacao(row, status);
        displayChange_field_nacionalidade(row, status);
        displayChange_field_part_cpf(row, status);
        displayChange_field_nome(row, status);
        displayChange_field_part_ativo(row, status);
        displayChange_field_part_tipo(row, status);
        displayChange_field_part_sexo(row, status);
        displayChange_field_enviar_app(row, status);
        displayChange_field_part_nome_cracha(row, status);
        displayChange_field_part_id_evento(row, status);
        displayChange_field_part_id_evento_publico(row, status);
        displayChange_field_part_id_evento_regional(row, status);
        displayChange_field_part_tipo_pessoa(row, status);
        displayChange_field_part_dt_nasc(row, status);
        displayChange_field_part_filiacao(row, status);
        displayChange_field_estrangeiro(row, status);
        displayChange_field_part_substituido(row, status);
        displayChange_field_part_cod_substituto(row, status);
        displayChange_field_part_nome_substituto(row, status);
        displayChange_field_part_sexo_substituto(row, status);
        displayChange_field_guarda_cod_substituto(row, status);
        displayChange_field_part_empresa(row, status);
        displayChange_field_part_departamento(row, status);
        displayChange_field_part_cargo(row, status);
        displayChange_field_part_grupo(row, status);
        displayChange_field_part_clube(row, status);
        displayChange_field_dsc_empresa_rsvp(row, status);
        displayChange_field_cod_empresa_rsvp(row, status);
        displayChange_field_part_cep(row, status);
        displayChange_field_part_logradouro(row, status);
        displayChange_field_part_numero(row, status);
        displayChange_field_part_complemento(row, status);
        displayChange_field_part_bairro(row, status);
        displayChange_field_part_cidade(row, status);
        displayChange_field_part_uf(row, status);
        displayChange_field_part_ddd_01(row, status);
        displayChange_field_part_fone_01(row, status);
        displayChange_field_part_ddd_celular_01(row, status);
        displayChange_field_part_celeular_01(row, status);
        displayChange_field_codigo_telefone_internacional(row, status);
        displayChange_field_part_fone_internacional(row, status);
        displayChange_field_part_rg(row, status);
        displayChange_field_part_passaporte(row, status);
        displayChange_field_part_validade_pass(row, status);
        displayChange_field_emissao_passaporte(row, status);
        displayChange_field_part_passaporte_estrangeiro(row, status);
        displayChange_field_part_cpf_informado(row, status);
        displayChange_field_part_nacionalidade(row, status);
        displayChange_field_part_vacina_fa(row, status);
        displayChange_field_numero_visto(row, status);
        displayChange_field_validade_visto(row, status);
        displayChange_field_part_visto(row, status);
        displayChange_field_part_tam_camisa(row, status);
        displayChange_field_part_tam_calcado(row, status);
        displayChange_field_part_idioma(row, status);
        displayChange_field_idioma_preferido(row, status);
        displayChange_field_part_pais(row, status);
        displayChange_field_pais(row, status);
        displayChange_field_part_destaque_negrito(row, status);
        displayChange_field_part_fumante(row, status);
        displayChange_field_part_restricao_alimentar(row, status);
        displayChange_field_restricao_mobilidade(row, status);
        displayChange_field_part_acompanhado(row, status);
        displayChange_field_part_cv_obs(row, status);
        displayChange_field_uid_pulseira_nfc(row, status);
        displayChange_field_roles_app(row, status);
        displayChange_field_id_evento_app(row, status);
        displayChange_field_external_id(row, status);
        displayChange_field_id_participante_app(row, status);
        displayChange_field_external_status(row, status);
        displayChange_field_part_email(row, status);
        displayChange_field_part_nome_secretaria(row, status);
        displayChange_field_part_email_secretaria(row, status);
        displayChange_field_part_cod_substituido(row, status);
        displayChange_field_part_nome_substituido(row, status);
        displayChange_field_cpf_del(row, status);
        displayChange_field_sql_log(row, status);
}

function displayChange_field(field, row, status) {
        if ("participante_id" == field) {
                displayChange_field_participante_id(row, status);
        }
        if ("importacao" == field) {
                displayChange_field_importacao(row, status);
        }
        if ("nacionalidade" == field) {
                displayChange_field_nacionalidade(row, status);
        }
        if ("part_cpf" == field) {
                displayChange_field_part_cpf(row, status);
        }
        if ("nome" == field) {
                displayChange_field_nome(row, status);
        }
        if ("part_ativo" == field) {
                displayChange_field_part_ativo(row, status);
        }
        if ("part_tipo" == field) {
                displayChange_field_part_tipo(row, status);
        }
        if ("part_sexo" == field) {
                displayChange_field_part_sexo(row, status);
        }
        if ("enviar_app" == field) {
                displayChange_field_enviar_app(row, status);
        }
        if ("part_nome_cracha" == field) {
                displayChange_field_part_nome_cracha(row, status);
        }
        if ("part_id_evento" == field) {
                displayChange_field_part_id_evento(row, status);
        }
        if ("part_id_evento_publico" == field) {
                displayChange_field_part_id_evento_publico(row, status);
        }
        if ("part_id_evento_regional" == field) {
                displayChange_field_part_id_evento_regional(row, status);
        }
        if ("part_tipo_pessoa" == field) {
                displayChange_field_part_tipo_pessoa(row, status);
        }
        if ("part_dt_nasc" == field) {
                displayChange_field_part_dt_nasc(row, status);
        }
        if ("part_filiacao" == field) {
                displayChange_field_part_filiacao(row, status);
        }
        if ("estrangeiro" == field) {
                displayChange_field_estrangeiro(row, status);
        }
        if ("part_substituido" == field) {
                displayChange_field_part_substituido(row, status);
        }
        if ("part_cod_substituto" == field) {
                displayChange_field_part_cod_substituto(row, status);
        }
        if ("part_nome_substituto" == field) {
                displayChange_field_part_nome_substituto(row, status);
        }
        if ("part_sexo_substituto" == field) {
                displayChange_field_part_sexo_substituto(row, status);
        }
        if ("guarda_cod_substituto" == field) {
                displayChange_field_guarda_cod_substituto(row, status);
        }
        if ("part_empresa" == field) {
                displayChange_field_part_empresa(row, status);
        }
        if ("part_departamento" == field) {
                displayChange_field_part_departamento(row, status);
        }
        if ("part_cargo" == field) {
                displayChange_field_part_cargo(row, status);
        }
        if ("part_grupo" == field) {
                displayChange_field_part_grupo(row, status);
        }
        if ("part_clube" == field) {
                displayChange_field_part_clube(row, status);
        }
        if ("dsc_empresa_rsvp" == field) {
                displayChange_field_dsc_empresa_rsvp(row, status);
        }
        if ("cod_empresa_rsvp" == field) {
                displayChange_field_cod_empresa_rsvp(row, status);
        }
        if ("part_cep" == field) {
                displayChange_field_part_cep(row, status);
        }
        if ("part_logradouro" == field) {
                displayChange_field_part_logradouro(row, status);
        }
        if ("part_numero" == field) {
                displayChange_field_part_numero(row, status);
        }
        if ("part_complemento" == field) {
                displayChange_field_part_complemento(row, status);
        }
        if ("part_bairro" == field) {
                displayChange_field_part_bairro(row, status);
        }
        if ("part_cidade" == field) {
                displayChange_field_part_cidade(row, status);
        }
        if ("part_uf" == field) {
                displayChange_field_part_uf(row, status);
        }
        if ("part_ddd_01" == field) {
                displayChange_field_part_ddd_01(row, status);
        }
        if ("part_fone_01" == field) {
                displayChange_field_part_fone_01(row, status);
        }
        if ("part_ddd_celular_01" == field) {
                displayChange_field_part_ddd_celular_01(row, status);
        }
        if ("part_celeular_01" == field) {
                displayChange_field_part_celeular_01(row, status);
        }
        if ("codigo_telefone_internacional" == field) {
                displayChange_field_codigo_telefone_internacional(row, status);
        }
        if ("part_fone_internacional" == field) {
                displayChange_field_part_fone_internacional(row, status);
        }
        if ("part_rg" == field) {
                displayChange_field_part_rg(row, status);
        }
        if ("part_passaporte" == field) {
                displayChange_field_part_passaporte(row, status);
        }
        if ("part_validade_pass" == field) {
                displayChange_field_part_validade_pass(row, status);
        }
        if ("emissao_passaporte" == field) {
                displayChange_field_emissao_passaporte(row, status);
        }
        if ("part_passaporte_estrangeiro" == field) {
                displayChange_field_part_passaporte_estrangeiro(row, status);
        }
        if ("part_cpf_informado" == field) {
                displayChange_field_part_cpf_informado(row, status);
        }
        if ("part_nacionalidade" == field) {
                displayChange_field_part_nacionalidade(row, status);
        }
        if ("part_vacina_fa" == field) {
                displayChange_field_part_vacina_fa(row, status);
        }
        if ("numero_visto" == field) {
                displayChange_field_numero_visto(row, status);
        }
        if ("validade_visto" == field) {
                displayChange_field_validade_visto(row, status);
        }
        if ("part_visto" == field) {
                displayChange_field_part_visto(row, status);
        }
        if ("part_tam_camisa" == field) {
                displayChange_field_part_tam_camisa(row, status);
        }
        if ("part_tam_calcado" == field) {
                displayChange_field_part_tam_calcado(row, status);
        }
        if ("part_idioma" == field) {
                displayChange_field_part_idioma(row, status);
        }
        if ("idioma_preferido" == field) {
                displayChange_field_idioma_preferido(row, status);
        }
        if ("part_pais" == field) {
                displayChange_field_part_pais(row, status);
        }
        if ("pais" == field) {
                displayChange_field_pais(row, status);
        }
        if ("part_destaque_negrito" == field) {
                displayChange_field_part_destaque_negrito(row, status);
        }
        if ("part_fumante" == field) {
                displayChange_field_part_fumante(row, status);
        }
        if ("part_restricao_alimentar" == field) {
                displayChange_field_part_restricao_alimentar(row, status);
        }
        if ("restricao_mobilidade" == field) {
                displayChange_field_restricao_mobilidade(row, status);
        }
        if ("part_acompanhado" == field) {
                displayChange_field_part_acompanhado(row, status);
        }
        if ("part_cv_obs" == field) {
                displayChange_field_part_cv_obs(row, status);
        }
        if ("uid_pulseira_nfc" == field) {
                displayChange_field_uid_pulseira_nfc(row, status);
        }
        if ("roles_app" == field) {
                displayChange_field_roles_app(row, status);
        }
        if ("id_evento_app" == field) {
                displayChange_field_id_evento_app(row, status);
        }
        if ("external_id" == field) {
                displayChange_field_external_id(row, status);
        }
        if ("id_participante_app" == field) {
                displayChange_field_id_participante_app(row, status);
        }
        if ("external_status" == field) {
                displayChange_field_external_status(row, status);
        }
        if ("part_email" == field) {
                displayChange_field_part_email(row, status);
        }
        if ("part_nome_secretaria" == field) {
                displayChange_field_part_nome_secretaria(row, status);
        }
        if ("part_email_secretaria" == field) {
                displayChange_field_part_email_secretaria(row, status);
        }
        if ("part_cod_substituido" == field) {
                displayChange_field_part_cod_substituido(row, status);
        }
        if ("part_nome_substituido" == field) {
                displayChange_field_part_nome_substituido(row, status);
        }
        if ("cpf_del" == field) {
                displayChange_field_cpf_del(row, status);
        }
        if ("sql_log" == field) {
                displayChange_field_sql_log(row, status);
        }
}

function displayChange_field_participante_id(row, status) {
    var fieldId;
}

function displayChange_field_importacao(row, status) {
    var fieldId;
}

function displayChange_field_nacionalidade(row, status) {
    var fieldId;
}

function displayChange_field_part_cpf(row, status) {
    var fieldId;
}

function displayChange_field_nome(row, status) {
    var fieldId;
}

function displayChange_field_part_ativo(row, status) {
    var fieldId;
}

function displayChange_field_part_tipo(row, status) {
    var fieldId;
}

function displayChange_field_part_sexo(row, status) {
    var fieldId;
}

function displayChange_field_enviar_app(row, status) {
    var fieldId;
}

function displayChange_field_part_nome_cracha(row, status) {
    var fieldId;
}

function displayChange_field_part_id_evento(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_part_id_evento__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_part_id_evento' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_part_id_evento" + row).select2("destroy");
                }
                scJQSelect2Add(row, "part_id_evento");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_part_id_evento' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_part_id_evento_publico(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_part_id_evento_publico__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_part_id_evento_publico' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_part_id_evento_publico" + row).select2("destroy");
                }
                scJQSelect2Add(row, "part_id_evento_publico");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_part_id_evento_publico' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_part_id_evento_regional(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_part_id_evento_regional__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_part_id_evento_regional' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_part_id_evento_regional" + row).select2("destroy");
                }
                scJQSelect2Add(row, "part_id_evento_regional");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_part_id_evento_regional' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_part_tipo_pessoa(row, status) {
    var fieldId;
}

function displayChange_field_part_dt_nasc(row, status) {
    var fieldId;
}

function displayChange_field_part_filiacao(row, status) {
    var fieldId;
}

function displayChange_field_estrangeiro(row, status) {
    var fieldId;
}

function displayChange_field_part_substituido(row, status) {
    var fieldId;
}

function displayChange_field_part_cod_substituto(row, status) {
    var fieldId;
}

function displayChange_field_part_nome_substituto(row, status) {
    var fieldId;
}

function displayChange_field_part_sexo_substituto(row, status) {
    var fieldId;
}

function displayChange_field_guarda_cod_substituto(row, status) {
    var fieldId;
}

function displayChange_field_part_empresa(row, status) {
    var fieldId;
}

function displayChange_field_part_departamento(row, status) {
    var fieldId;
}

function displayChange_field_part_cargo(row, status) {
    var fieldId;
}

function displayChange_field_part_grupo(row, status) {
    var fieldId;
}

function displayChange_field_part_clube(row, status) {
    var fieldId;
}

function displayChange_field_dsc_empresa_rsvp(row, status) {
    var fieldId;
}

function displayChange_field_cod_empresa_rsvp(row, status) {
    var fieldId;
}

function displayChange_field_part_cep(row, status) {
    var fieldId;
}

function displayChange_field_part_logradouro(row, status) {
    var fieldId;
}

function displayChange_field_part_numero(row, status) {
    var fieldId;
}

function displayChange_field_part_complemento(row, status) {
    var fieldId;
}

function displayChange_field_part_bairro(row, status) {
    var fieldId;
}

function displayChange_field_part_cidade(row, status) {
    var fieldId;
}

function displayChange_field_part_uf(row, status) {
    var fieldId;
}

function displayChange_field_part_ddd_01(row, status) {
    var fieldId;
}

function displayChange_field_part_fone_01(row, status) {
    var fieldId;
}

function displayChange_field_part_ddd_celular_01(row, status) {
    var fieldId;
}

function displayChange_field_part_celeular_01(row, status) {
    var fieldId;
}

function displayChange_field_codigo_telefone_internacional(row, status) {
    var fieldId;
}

function displayChange_field_part_fone_internacional(row, status) {
    var fieldId;
}

function displayChange_field_part_rg(row, status) {
    var fieldId;
}

function displayChange_field_part_passaporte(row, status) {
    var fieldId;
}

function displayChange_field_part_validade_pass(row, status) {
    var fieldId;
}

function displayChange_field_emissao_passaporte(row, status) {
    var fieldId;
}

function displayChange_field_part_passaporte_estrangeiro(row, status) {
    var fieldId;
}

function displayChange_field_part_cpf_informado(row, status) {
    var fieldId;
}

function displayChange_field_part_nacionalidade(row, status) {
    var fieldId;
}

function displayChange_field_part_vacina_fa(row, status) {
    var fieldId;
}

function displayChange_field_numero_visto(row, status) {
    var fieldId;
}

function displayChange_field_validade_visto(row, status) {
    var fieldId;
}

function displayChange_field_part_visto(row, status) {
    var fieldId;
}

function displayChange_field_part_tam_camisa(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_part_tam_camisa__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_part_tam_camisa' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_part_tam_camisa" + row).select2("destroy");
                }
                scJQSelect2Add(row, "part_tam_camisa");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_part_tam_camisa' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_part_tam_calcado(row, status) {
    var fieldId;
}

function displayChange_field_part_idioma(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_part_idioma__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_part_idioma' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_part_idioma" + row).select2("destroy");
                }
                scJQSelect2Add(row, "part_idioma");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_part_idioma' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_idioma_preferido(row, status) {
    var fieldId;
}

function displayChange_field_part_pais(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_part_pais__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_part_pais' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_part_pais" + row).select2("destroy");
                }
                scJQSelect2Add(row, "part_pais");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_part_pais' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_pais(row, status) {
    var fieldId;
}

function displayChange_field_part_destaque_negrito(row, status) {
    var fieldId;
}

function displayChange_field_part_fumante(row, status) {
    var fieldId;
}

function displayChange_field_part_restricao_alimentar(row, status) {
    var fieldId;
}

function displayChange_field_restricao_mobilidade(row, status) {
    var fieldId;
}

function displayChange_field_part_acompanhado(row, status) {
    var fieldId;
}

function displayChange_field_part_cv_obs(row, status) {
    var fieldId;
}

function displayChange_field_uid_pulseira_nfc(row, status) {
    var fieldId;
}

function displayChange_field_roles_app(row, status) {
    var fieldId;
}

function displayChange_field_id_evento_app(row, status) {
    var fieldId;
}

function displayChange_field_external_id(row, status) {
    var fieldId;
}

function displayChange_field_id_participante_app(row, status) {
    var fieldId;
}

function displayChange_field_external_status(row, status) {
    var fieldId;
}

function displayChange_field_part_email(row, status) {
    var fieldId;
}

function displayChange_field_part_nome_secretaria(row, status) {
    var fieldId;
}

function displayChange_field_part_email_secretaria(row, status) {
    var fieldId;
}

function displayChange_field_part_cod_substituido(row, status) {
    var fieldId;
}

function displayChange_field_part_nome_substituido(row, status) {
    var fieldId;
}

function displayChange_field_cpf_del(row, status) {
    var fieldId;
}

function displayChange_field_sql_log(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
        displayChange_field_part_id_evento("all", "on");
        displayChange_field_part_id_evento_publico("all", "on");
        displayChange_field_part_id_evento_regional("all", "on");
        displayChange_field_part_tam_camisa("all", "on");
        displayChange_field_part_idioma("all", "on");
        displayChange_field_part_pais("all", "on");
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_participantes_rsvp_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(38);
                }
        }
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_part_dt_nasc" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_nasc" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_nasc" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_nasc(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['part_dt_nasc']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_validade_pass" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_validade_pass" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_validade_pass" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_participantes_rsvp_mob_validate_part_validade_pass(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['part_validade_pass']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_emissao_passaporte" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_emissao_passaporte" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_emissao_passaporte" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_participantes_rsvp_mob_validate_emissao_passaporte(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['emissao_passaporte']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_validade_visto" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_validade_visto" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_validade_visto" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_participantes_rsvp_mob_validate_validade_visto(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['validade_visto']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_dt_cadastro" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_cadastro" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_cadastro" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['part_dt_cadastro']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_cadastro']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_cadastro(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_cadastro']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_dt_alteracao" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_alteracao" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_alteracao" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['part_dt_alteracao']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_alteracao']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_alteracao(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_alteracao']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_dt_alt_contato_rsvp" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_alt_contato_rsvp" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_alt_contato_rsvp" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['part_dt_alt_contato_rsvp']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_alt_contato_rsvp']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_alt_contato_rsvp(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_alt_contato_rsvp']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_dt_alt_presenca" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_alt_presenca" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_alt_presenca" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['part_dt_alt_presenca']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_alt_presenca']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_alt_presenca(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_alt_presenca']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_dt_solicit_especial" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_solicit_especial" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_solicit_especial" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['part_dt_solicit_especial']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_solicit_especial']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_solicit_especial(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_solicit_especial']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_dt_programacao" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_programacao" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_programacao" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['part_dt_programacao']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_programacao']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_programacao(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_programacao']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_dt_aereo" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_aereo" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_aereo" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['part_dt_aereo']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_aereo']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_aereo(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_aereo']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_par_dt_hospedagem" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_par_dt_hospedagem" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_par_dt_hospedagem" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['par_dt_hospedagem']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['par_dt_hospedagem']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_par_dt_hospedagem(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['par_dt_hospedagem']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_dt_transfer" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_transfer" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_transfer" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['part_dt_transfer']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_transfer']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_transfer(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_transfer']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_dt_opcionais" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_dt_opcionais" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_dt_opcionais" + iSeqRow] = $oField.val();
      if (2 == aParts.length) {
        sTime = " " + aParts[1];
      }
      if ('' == sTime || ' ' == sTime) {
        sTime = ' <?php echo $this->jqueryCalendarTimeStart($this->field_config['part_dt_opcionais']['date_format'], 'start'); ?>';
      }
      $oField.datepicker("option", "dateFormat", "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_opcionais']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>" + sTime)
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
      do_ajax_form_participantes_rsvp_mob_validate_part_dt_opcionais(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', 'hh', 'ii', 'ss', ':', ';', $_SESSION['scriptcase']['reg_conf']['date_sep'], $_SESSION['scriptcase']['reg_conf']['time_sep']), array('', 'yyyy', '','','', '', '', '', ''), $this->field_config['part_dt_opcionais']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_part_save_the_date" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_part_save_the_date" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_part_save_the_date" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_participantes_rsvp_mob_validate_part_save_the_date(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['part_save_the_date']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_participantes_rsvp_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_participantes_rsvp_mob');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_participantes_rsvp_mob');
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
  if (null == specificField || "part_id_evento" == specificField) {
    scJQSelect2Add_part_id_evento(seqRow);
  }
  if (null == specificField || "part_id_evento_publico" == specificField) {
    scJQSelect2Add_part_id_evento_publico(seqRow);
  }
  if (null == specificField || "part_id_evento_regional" == specificField) {
    scJQSelect2Add_part_id_evento_regional(seqRow);
  }
  if (null == specificField || "part_tam_camisa" == specificField) {
    scJQSelect2Add_part_tam_camisa(seqRow);
  }
  if (null == specificField || "part_idioma" == specificField) {
    scJQSelect2Add_part_idioma(seqRow);
  }
  if (null == specificField || "part_pais" == specificField) {
    scJQSelect2Add_part_pais(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_part_id_evento(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_part_id_evento_obj" : "#id_sc_field_part_id_evento" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_part_id_evento_obj',
      dropdownCssClass: 'css_part_id_evento_obj',
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
  $('#select2-id_sc_field_part_id_evento' + seqRow + '-container').addClass('css_part_id_evento_obj');
} // scJQSelect2Add

function scJQSelect2Add_part_id_evento_publico(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_part_id_evento_publico_obj" : "#id_sc_field_part_id_evento_publico" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_part_id_evento_publico_obj',
      dropdownCssClass: 'css_part_id_evento_publico_obj',
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
  $('#select2-id_sc_field_part_id_evento_publico' + seqRow + '-container').addClass('css_part_id_evento_publico_obj');
} // scJQSelect2Add

function scJQSelect2Add_part_id_evento_regional(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_part_id_evento_regional_obj" : "#id_sc_field_part_id_evento_regional" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_part_id_evento_regional_obj',
      dropdownCssClass: 'css_part_id_evento_regional_obj',
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
  $('#select2-id_sc_field_part_id_evento_regional' + seqRow + '-container').addClass('css_part_id_evento_regional_obj');
} // scJQSelect2Add

function scJQSelect2Add_part_tam_camisa(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_part_tam_camisa_obj" : "#id_sc_field_part_tam_camisa" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_part_tam_camisa_obj',
      dropdownCssClass: 'css_part_tam_camisa_obj',
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
  $('#select2-id_sc_field_part_tam_camisa' + seqRow + '-container').addClass('css_part_tam_camisa_obj');
} // scJQSelect2Add

function scJQSelect2Add_part_idioma(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_part_idioma_obj" : "#id_sc_field_part_idioma" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_part_idioma_obj',
      dropdownCssClass: 'css_part_idioma_obj',
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
  $('#select2-id_sc_field_part_idioma' + seqRow + '-container').addClass('css_part_idioma_obj');
} // scJQSelect2Add

function scJQSelect2Add_part_pais(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_part_pais_obj" : "#id_sc_field_part_pais" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_part_pais_obj',
      dropdownCssClass: 'css_part_pais_obj',
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
  $('#select2-id_sc_field_part_pais' + seqRow + '-container').addClass('css_part_pais_obj');
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_part_id_evento) { displayChange_field_part_id_evento(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_part_id_evento_publico) { displayChange_field_part_id_evento_publico(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_part_id_evento_regional) { displayChange_field_part_id_evento_regional(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_part_tam_camisa) { displayChange_field_part_tam_camisa(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_part_idioma) { displayChange_field_part_idioma(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_part_pais) { displayChange_field_part_pais(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
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

