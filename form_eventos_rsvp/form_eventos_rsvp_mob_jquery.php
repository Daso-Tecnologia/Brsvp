
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
     if (sField == 'evento_id_responsavel' || sField == 'timezone') {
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
  scEventControl_data["particip_link" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_link" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuarios_link" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["publicos_link" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hoteis_link" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cias_link" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["tours_lnk" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["regionais_link" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["programacao_link" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["mailling_link" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["observacoes" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sql_log" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_id_interno" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_id_complementar" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_nome" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_idioma" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_dt_realizacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_dt_conclusao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_status" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_logo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_website" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cover_image" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_tipo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["enviar_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_cep" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_pais" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_uf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_municipio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_bairro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_logradouro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_numero" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_complemento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_observacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["localizacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["latitude_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["longitude_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_id_responsavel" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_telefone" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["evento_celular" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["dsc_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["data_conclusao_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["localizacao_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["status_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["status_da_publicidade" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["timezone" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["caminho_logo_cli" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["caminho_cover_image" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cor_principal_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cor_secundaria_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cor_fundo_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nome_organizador_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["email_organizador_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["nome_comprador_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["wz_suporte_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["gamificacao_ativada_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["galeria_fotos_ativada_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["galeria_fotos_publicas_ativada_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["chat_evento_ativado_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cidade_destino_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["pais_destino_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["data_chegada_destino_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["data_partida_destino_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["texto_email_convite_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["texto_whatsapp_convite_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["termos_condicoes_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["canal_preferencial_convite_app" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["particip_link" + iSeqRow] && scEventControl_data["particip_link" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["particip_link" + iSeqRow] && scEventControl_data["particip_link" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_link" + iSeqRow] && scEventControl_data["empresa_link" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_link" + iSeqRow] && scEventControl_data["empresa_link" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuarios_link" + iSeqRow] && scEventControl_data["usuarios_link" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuarios_link" + iSeqRow] && scEventControl_data["usuarios_link" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["publicos_link" + iSeqRow] && scEventControl_data["publicos_link" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["publicos_link" + iSeqRow] && scEventControl_data["publicos_link" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hoteis_link" + iSeqRow] && scEventControl_data["hoteis_link" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hoteis_link" + iSeqRow] && scEventControl_data["hoteis_link" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cias_link" + iSeqRow] && scEventControl_data["cias_link" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cias_link" + iSeqRow] && scEventControl_data["cias_link" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["tours_lnk" + iSeqRow] && scEventControl_data["tours_lnk" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["tours_lnk" + iSeqRow] && scEventControl_data["tours_lnk" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["regionais_link" + iSeqRow] && scEventControl_data["regionais_link" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["regionais_link" + iSeqRow] && scEventControl_data["regionais_link" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["programacao_link" + iSeqRow] && scEventControl_data["programacao_link" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["programacao_link" + iSeqRow] && scEventControl_data["programacao_link" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["mailling_link" + iSeqRow] && scEventControl_data["mailling_link" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["mailling_link" + iSeqRow] && scEventControl_data["mailling_link" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["observacoes" + iSeqRow] && scEventControl_data["observacoes" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["observacoes" + iSeqRow] && scEventControl_data["observacoes" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["sql_log" + iSeqRow] && scEventControl_data["sql_log" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["sql_log" + iSeqRow] && scEventControl_data["sql_log" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_id" + iSeqRow] && scEventControl_data["evento_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_id" + iSeqRow] && scEventControl_data["evento_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_id_interno" + iSeqRow] && scEventControl_data["evento_id_interno" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_id_interno" + iSeqRow] && scEventControl_data["evento_id_interno" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_id_complementar" + iSeqRow] && scEventControl_data["evento_id_complementar" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_id_complementar" + iSeqRow] && scEventControl_data["evento_id_complementar" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_nome" + iSeqRow] && scEventControl_data["evento_nome" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_nome" + iSeqRow] && scEventControl_data["evento_nome" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_idioma" + iSeqRow] && scEventControl_data["evento_idioma" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_idioma" + iSeqRow] && scEventControl_data["evento_idioma" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_dt_realizacao" + iSeqRow] && scEventControl_data["evento_dt_realizacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_dt_realizacao" + iSeqRow] && scEventControl_data["evento_dt_realizacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_dt_conclusao" + iSeqRow] && scEventControl_data["evento_dt_conclusao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_dt_conclusao" + iSeqRow] && scEventControl_data["evento_dt_conclusao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_status" + iSeqRow] && scEventControl_data["evento_status" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_status" + iSeqRow] && scEventControl_data["evento_status" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_website" + iSeqRow] && scEventControl_data["evento_website" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_website" + iSeqRow] && scEventControl_data["evento_website" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_email" + iSeqRow] && scEventControl_data["evento_email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_email" + iSeqRow] && scEventControl_data["evento_email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_tipo" + iSeqRow] && scEventControl_data["evento_tipo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_tipo" + iSeqRow] && scEventControl_data["evento_tipo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["enviar_app" + iSeqRow] && scEventControl_data["enviar_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["enviar_app" + iSeqRow] && scEventControl_data["enviar_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_cep" + iSeqRow] && scEventControl_data["evento_cep" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_cep" + iSeqRow] && scEventControl_data["evento_cep" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_pais" + iSeqRow] && scEventControl_data["evento_pais" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_pais" + iSeqRow] && scEventControl_data["evento_pais" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_uf" + iSeqRow] && scEventControl_data["evento_uf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_uf" + iSeqRow] && scEventControl_data["evento_uf" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_municipio" + iSeqRow] && scEventControl_data["evento_municipio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_municipio" + iSeqRow] && scEventControl_data["evento_municipio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_bairro" + iSeqRow] && scEventControl_data["evento_bairro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_bairro" + iSeqRow] && scEventControl_data["evento_bairro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_logradouro" + iSeqRow] && scEventControl_data["evento_logradouro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_logradouro" + iSeqRow] && scEventControl_data["evento_logradouro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_numero" + iSeqRow] && scEventControl_data["evento_numero" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_numero" + iSeqRow] && scEventControl_data["evento_numero" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_complemento" + iSeqRow] && scEventControl_data["evento_complemento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_complemento" + iSeqRow] && scEventControl_data["evento_complemento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_observacao" + iSeqRow] && scEventControl_data["evento_observacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_observacao" + iSeqRow] && scEventControl_data["evento_observacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["localizacao" + iSeqRow] && scEventControl_data["localizacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["localizacao" + iSeqRow] && scEventControl_data["localizacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["latitude_app" + iSeqRow] && scEventControl_data["latitude_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["latitude_app" + iSeqRow] && scEventControl_data["latitude_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["longitude_app" + iSeqRow] && scEventControl_data["longitude_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["longitude_app" + iSeqRow] && scEventControl_data["longitude_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_id_responsavel" + iSeqRow] && scEventControl_data["evento_id_responsavel" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_id_responsavel" + iSeqRow] && scEventControl_data["evento_id_responsavel" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_telefone" + iSeqRow] && scEventControl_data["evento_telefone" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_telefone" + iSeqRow] && scEventControl_data["evento_telefone" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["evento_celular" + iSeqRow] && scEventControl_data["evento_celular" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_celular" + iSeqRow] && scEventControl_data["evento_celular" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["dsc_app" + iSeqRow] && scEventControl_data["dsc_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["dsc_app" + iSeqRow] && scEventControl_data["dsc_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data_conclusao_app" + iSeqRow] && scEventControl_data["data_conclusao_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data_conclusao_app" + iSeqRow] && scEventControl_data["data_conclusao_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["localizacao_app" + iSeqRow] && scEventControl_data["localizacao_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["localizacao_app" + iSeqRow] && scEventControl_data["localizacao_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["status_app" + iSeqRow] && scEventControl_data["status_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["status_app" + iSeqRow] && scEventControl_data["status_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["status_da_publicidade" + iSeqRow] && scEventControl_data["status_da_publicidade" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["status_da_publicidade" + iSeqRow] && scEventControl_data["status_da_publicidade" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["timezone" + iSeqRow] && scEventControl_data["timezone" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["timezone" + iSeqRow] && scEventControl_data["timezone" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["caminho_logo_cli" + iSeqRow] && scEventControl_data["caminho_logo_cli" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["caminho_logo_cli" + iSeqRow] && scEventControl_data["caminho_logo_cli" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["caminho_cover_image" + iSeqRow] && scEventControl_data["caminho_cover_image" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["caminho_cover_image" + iSeqRow] && scEventControl_data["caminho_cover_image" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cor_principal_app" + iSeqRow] && scEventControl_data["cor_principal_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cor_principal_app" + iSeqRow] && scEventControl_data["cor_principal_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cor_secundaria_app" + iSeqRow] && scEventControl_data["cor_secundaria_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cor_secundaria_app" + iSeqRow] && scEventControl_data["cor_secundaria_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cor_fundo_app" + iSeqRow] && scEventControl_data["cor_fundo_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cor_fundo_app" + iSeqRow] && scEventControl_data["cor_fundo_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nome_organizador_app" + iSeqRow] && scEventControl_data["nome_organizador_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome_organizador_app" + iSeqRow] && scEventControl_data["nome_organizador_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["email_organizador_app" + iSeqRow] && scEventControl_data["email_organizador_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["email_organizador_app" + iSeqRow] && scEventControl_data["email_organizador_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["nome_comprador_app" + iSeqRow] && scEventControl_data["nome_comprador_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["nome_comprador_app" + iSeqRow] && scEventControl_data["nome_comprador_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["wz_suporte_app" + iSeqRow] && scEventControl_data["wz_suporte_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["wz_suporte_app" + iSeqRow] && scEventControl_data["wz_suporte_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["gamificacao_ativada_app" + iSeqRow] && scEventControl_data["gamificacao_ativada_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["gamificacao_ativada_app" + iSeqRow] && scEventControl_data["gamificacao_ativada_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["galeria_fotos_ativada_app" + iSeqRow] && scEventControl_data["galeria_fotos_ativada_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["galeria_fotos_ativada_app" + iSeqRow] && scEventControl_data["galeria_fotos_ativada_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["galeria_fotos_publicas_ativada_app" + iSeqRow] && scEventControl_data["galeria_fotos_publicas_ativada_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["galeria_fotos_publicas_ativada_app" + iSeqRow] && scEventControl_data["galeria_fotos_publicas_ativada_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["chat_evento_ativado_app" + iSeqRow] && scEventControl_data["chat_evento_ativado_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["chat_evento_ativado_app" + iSeqRow] && scEventControl_data["chat_evento_ativado_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["cidade_destino_app" + iSeqRow] && scEventControl_data["cidade_destino_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["cidade_destino_app" + iSeqRow] && scEventControl_data["cidade_destino_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["pais_destino_app" + iSeqRow] && scEventControl_data["pais_destino_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["pais_destino_app" + iSeqRow] && scEventControl_data["pais_destino_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data_chegada_destino_app" + iSeqRow] && scEventControl_data["data_chegada_destino_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data_chegada_destino_app" + iSeqRow] && scEventControl_data["data_chegada_destino_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["data_partida_destino_app" + iSeqRow] && scEventControl_data["data_partida_destino_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["data_partida_destino_app" + iSeqRow] && scEventControl_data["data_partida_destino_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["texto_email_convite_app" + iSeqRow] && scEventControl_data["texto_email_convite_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["texto_email_convite_app" + iSeqRow] && scEventControl_data["texto_email_convite_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["texto_whatsapp_convite_app" + iSeqRow] && scEventControl_data["texto_whatsapp_convite_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["texto_whatsapp_convite_app" + iSeqRow] && scEventControl_data["texto_whatsapp_convite_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["termos_condicoes_app" + iSeqRow] && scEventControl_data["termos_condicoes_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["termos_condicoes_app" + iSeqRow] && scEventControl_data["termos_condicoes_app" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["canal_preferencial_convite_app" + iSeqRow] && scEventControl_data["canal_preferencial_convite_app" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["canal_preferencial_convite_app" + iSeqRow] && scEventControl_data["canal_preferencial_convite_app" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("evento_id_complementar" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("evento_pais" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("evento_id_responsavel" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("status_app" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("status_da_publicidade" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("timezone" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("gamificacao_ativada_app" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("galeria_fotos_ativada_app" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("galeria_fotos_publicas_ativada_app" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("chat_evento_ativado_app" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("pais_destino_app" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("canal_preferencial_convite_app" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("data_conclusao_app" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("evento_numero" + iSeq == fieldName) {
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
  $('#id_sc_field_evento_id' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_id_onblur('#id_sc_field_evento_id' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_eventos_rsvp_evento_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_id_interno' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_id_interno_onblur('#id_sc_field_evento_id_interno' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_eventos_rsvp_evento_id_interno_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_id_complementar' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_id_complementar_onblur('#id_sc_field_evento_id_complementar' + iSeqRow, iSeqRow, event) })
                                                    .bind('focus', function() { sc_form_eventos_rsvp_evento_id_complementar_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_nome' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_eventos_rsvp_evento_nome_onblur('#id_sc_field_evento_nome' + iSeqRow, iSeqRow, event);}, 300) })
                                         .bind('focus', function() { sc_form_eventos_rsvp_evento_nome_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_idioma' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_idioma_onblur('#id_sc_field_evento_idioma' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_evento_idioma_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_dt_realizacao' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_eventos_rsvp_evento_dt_realizacao_onblur('#id_sc_field_evento_dt_realizacao' + iSeqRow, iSeqRow, event);}, 300) })
                                                  .bind('focus', function() { sc_form_eventos_rsvp_evento_dt_realizacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_dt_conclusao' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_dt_conclusao_onblur('#id_sc_field_evento_dt_conclusao' + iSeqRow, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_eventos_rsvp_evento_dt_conclusao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_status' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_status_onblur('#id_sc_field_evento_status' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_evento_status_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_website' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_website_onblur('#id_sc_field_evento_website' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_eventos_rsvp_evento_website_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_email' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_email_onblur('#id_sc_field_evento_email' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_eventos_rsvp_evento_email_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_cep' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_cep_onblur('#id_sc_field_evento_cep' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_eventos_rsvp_evento_cep_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_eventos_rsvp_evento_cep_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_pais' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_pais_onblur('#id_sc_field_evento_pais' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_eventos_rsvp_evento_pais_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_uf' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_uf_onblur('#id_sc_field_evento_uf' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_eventos_rsvp_evento_uf_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_municipio' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_municipio_onblur('#id_sc_field_evento_municipio' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_eventos_rsvp_evento_municipio_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_bairro' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_bairro_onblur('#id_sc_field_evento_bairro' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_evento_bairro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_logradouro' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_logradouro_onblur('#id_sc_field_evento_logradouro' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_eventos_rsvp_evento_logradouro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_numero' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_numero_onblur('#id_sc_field_evento_numero' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_eventos_rsvp_evento_numero_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_evento_numero_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_complemento' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_complemento_onblur('#id_sc_field_evento_complemento' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_eventos_rsvp_evento_complemento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_observacao' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_observacao_onblur('#id_sc_field_evento_observacao' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_eventos_rsvp_evento_observacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_logo' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_logo_onblur('#id_sc_field_evento_logo' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_eventos_rsvp_evento_logo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_tipo' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_tipo_onblur('#id_sc_field_evento_tipo' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_eventos_rsvp_evento_tipo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_id_responsavel' + iSeqRow).bind('select2:close', function() { sc_form_eventos_rsvp_evento_id_responsavel_onblur('#id_sc_field_evento_id_responsavel' + iSeqRow, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_eventos_rsvp_evento_id_responsavel_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_telefone' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_telefone_onblur('#id_sc_field_evento_telefone' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_eventos_rsvp_evento_telefone_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_celular' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_evento_celular_onblur('#id_sc_field_evento_celular' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_eventos_rsvp_evento_celular_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_dsc_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_dsc_app_onblur('#id_sc_field_dsc_app' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_eventos_rsvp_dsc_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_status_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_status_app_onblur('#id_sc_field_status_app' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_eventos_rsvp_status_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_data_conclusao_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_data_conclusao_app_onblur('#id_sc_field_data_conclusao_app' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_eventos_rsvp_data_conclusao_app_onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_eventos_rsvp_data_conclusao_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_localizacao_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_localizacao_app_onblur('#id_sc_field_localizacao_app' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_eventos_rsvp_localizacao_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_enviar_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_enviar_app_onblur('#id_sc_field_enviar_app' + iSeqRow, iSeqRow, event) })
                                        .bind('click', function() { sc_form_eventos_rsvp_enviar_app_onclick(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_eventos_rsvp_enviar_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_latitude_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_latitude_app_onblur('#id_sc_field_latitude_app' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_eventos_rsvp_latitude_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_longitude_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_longitude_app_onblur('#id_sc_field_longitude_app' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_longitude_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_caminho_logo_cli' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_caminho_logo_cli_onblur('#id_sc_field_caminho_logo_cli' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_eventos_rsvp_caminho_logo_cli_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cor_principal_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_cor_principal_app_onblur('#id_sc_field_cor_principal_app' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_eventos_rsvp_cor_principal_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cor_secundaria_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_cor_secundaria_app_onblur('#id_sc_field_cor_secundaria_app' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_eventos_rsvp_cor_secundaria_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cor_fundo_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_cor_fundo_app_onblur('#id_sc_field_cor_fundo_app' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_cor_fundo_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome_organizador_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_nome_organizador_app_onblur('#id_sc_field_nome_organizador_app' + iSeqRow, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_eventos_rsvp_nome_organizador_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_email_organizador_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_email_organizador_app_onblur('#id_sc_field_email_organizador_app' + iSeqRow, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_eventos_rsvp_email_organizador_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome_comprador_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_nome_comprador_app_onblur('#id_sc_field_nome_comprador_app' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_eventos_rsvp_nome_comprador_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_wz_suporte_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_wz_suporte_app_onblur('#id_sc_field_wz_suporte_app' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_eventos_rsvp_wz_suporte_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_gamificacao_ativada_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_gamificacao_ativada_app_onblur('#id_sc_field_gamificacao_ativada_app' + iSeqRow, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_eventos_rsvp_gamificacao_ativada_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_galeria_fotos_ativada_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_galeria_fotos_ativada_app_onblur('#id_sc_field_galeria_fotos_ativada_app' + iSeqRow, iSeqRow, event) })
                                                       .bind('focus', function() { sc_form_eventos_rsvp_galeria_fotos_ativada_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_galeria_fotos_publicas_ativada_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_galeria_fotos_publicas_ativada_app_onblur('#id_sc_field_galeria_fotos_publicas_ativada_app' + iSeqRow, iSeqRow, event) })
                                                                .bind('click', function() { sc_form_eventos_rsvp_galeria_fotos_publicas_ativada_app_onclick(this, iSeqRow, event) })
                                                                .bind('focus', function() { sc_form_eventos_rsvp_galeria_fotos_publicas_ativada_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_chat_evento_ativado_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_chat_evento_ativado_app_onblur('#id_sc_field_chat_evento_ativado_app' + iSeqRow, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_eventos_rsvp_chat_evento_ativado_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cidade_destino_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_cidade_destino_app_onblur('#id_sc_field_cidade_destino_app' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_eventos_rsvp_cidade_destino_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_pais_destino_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_pais_destino_app_onblur('#id_sc_field_pais_destino_app' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_eventos_rsvp_pais_destino_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_data_chegada_destino_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_data_chegada_destino_app_onblur('#id_sc_field_data_chegada_destino_app' + iSeqRow, iSeqRow, event) })
                                                      .bind('focus', function() { sc_form_eventos_rsvp_data_chegada_destino_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_data_partida_destino_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_data_partida_destino_app_onblur('#id_sc_field_data_partida_destino_app' + iSeqRow, iSeqRow, event) })
                                                      .bind('focus', function() { sc_form_eventos_rsvp_data_partida_destino_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_texto_email_convite_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_texto_email_convite_app_onblur('#id_sc_field_texto_email_convite_app' + iSeqRow, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_eventos_rsvp_texto_email_convite_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_texto_whatsapp_convite_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_texto_whatsapp_convite_app_onblur('#id_sc_field_texto_whatsapp_convite_app' + iSeqRow, iSeqRow, event) })
                                                        .bind('focus', function() { sc_form_eventos_rsvp_texto_whatsapp_convite_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_termos_condicoes_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_termos_condicoes_app_onblur('#id_sc_field_termos_condicoes_app' + iSeqRow, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_eventos_rsvp_termos_condicoes_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_canal_preferencial_convite_app' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_canal_preferencial_convite_app_onblur('#id_sc_field_canal_preferencial_convite_app' + iSeqRow, iSeqRow, event) })
                                                            .bind('focus', function() { sc_form_eventos_rsvp_canal_preferencial_convite_app_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_caminho_cover_image' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_caminho_cover_image_onblur('#id_sc_field_caminho_cover_image' + iSeqRow, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_eventos_rsvp_caminho_cover_image_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cover_image' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_cover_image_onblur('#id_sc_field_cover_image' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_eventos_rsvp_cover_image_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_status_da_publicidade' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_status_da_publicidade_onblur('#id_sc_field_status_da_publicidade' + iSeqRow, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_eventos_rsvp_status_da_publicidade_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_timezone' + iSeqRow).bind('select2:close', function() { sc_form_eventos_rsvp_timezone_onblur('#id_sc_field_timezone' + iSeqRow, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_eventos_rsvp_timezone_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cias_link' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_cias_link_onblur('#id_sc_field_cias_link' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_eventos_rsvp_cias_link_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_link' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_empresa_link_onblur('#id_sc_field_empresa_link' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_eventos_rsvp_empresa_link_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hoteis_link' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_hoteis_link_onblur('#id_sc_field_hoteis_link' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_eventos_rsvp_hoteis_link_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_localizacao' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_localizacao_onblur('#id_sc_field_localizacao' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_eventos_rsvp_localizacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_mailling_link' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_mailling_link_onblur('#id_sc_field_mailling_link' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_mailling_link_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_observacoes' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_observacoes_onblur('#id_sc_field_observacoes' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_eventos_rsvp_observacoes_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_particip_link' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_particip_link_onblur('#id_sc_field_particip_link' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_particip_link_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_programacao_link' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_programacao_link_onblur('#id_sc_field_programacao_link' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_eventos_rsvp_programacao_link_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_publicos_link' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_publicos_link_onblur('#id_sc_field_publicos_link' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_publicos_link_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_regionais_link' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_regionais_link_onblur('#id_sc_field_regionais_link' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_eventos_rsvp_regionais_link_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_sql_log' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_sql_log_onblur('#id_sc_field_sql_log' + iSeqRow, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_eventos_rsvp_sql_log_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_tours_lnk' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_tours_lnk_onblur('#id_sc_field_tours_lnk' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_eventos_rsvp_tours_lnk_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuarios_link' + iSeqRow).bind('blur', function() { sc_form_eventos_rsvp_usuarios_link_onblur('#id_sc_field_usuarios_link' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_eventos_rsvp_usuarios_link_onfocus(this, iSeqRow, event) });
  $('.sc-ui-radio-evento_idioma' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-evento_status' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-enviar_app' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_eventos_rsvp_evento_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_id();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_id_interno_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_id_interno();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_id_interno_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_id_complementar_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_id_complementar();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_id_complementar_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_nome_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_nome();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_nome_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_idioma_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_idioma();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_idioma_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_dt_realizacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_dt_realizacao();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_dt_realizacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_dt_conclusao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_dt_conclusao();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_dt_conclusao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_status_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_status();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_status_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_website_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_website();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_website_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_email_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_email();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_email_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_cep_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_cep();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_cep_onchange(oThis, iSeqRow, event) {
  cep_evento_cep(oThis.value, 'F1;CEP,evento_cep;UF,evento_uf;CIDADE,evento_municipio;BAIRRO,evento_bairro;RUA,evento_logradouro');
}

function sc_form_eventos_rsvp_evento_cep_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_pais_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_pais();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_pais_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_uf_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_uf();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_uf_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_municipio_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_municipio();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_municipio_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_bairro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_bairro();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_bairro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_logradouro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_logradouro();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_logradouro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_numero_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_numero();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_numero_onchange(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_event_evento_numero_onchange();
}

function sc_form_eventos_rsvp_evento_numero_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_complemento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_complemento();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_complemento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_observacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_observacao();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_observacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_logo_onblur(oThis, iSeqRow, event) {
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_logo_onfocus(oThis, iSeqRow, event) {
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_tipo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_tipo();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_tipo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_id_responsavel_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_id_responsavel();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_id_responsavel_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_telefone_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_telefone();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_telefone_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_evento_celular_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_evento_celular();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_evento_celular_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_dsc_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_dsc_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_dsc_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_status_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_status_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_status_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_data_conclusao_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_data_conclusao_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_data_conclusao_app_onchange(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_event_data_conclusao_app_onchange();
}

function sc_form_eventos_rsvp_data_conclusao_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_localizacao_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_localizacao_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_localizacao_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_enviar_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_enviar_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_enviar_app_onclick(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_event_enviar_app_onclick();
}

function sc_form_eventos_rsvp_enviar_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_latitude_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_latitude_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_latitude_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_longitude_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_longitude_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_longitude_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_caminho_logo_cli_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_caminho_logo_cli();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_caminho_logo_cli_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_cor_principal_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_cor_principal_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_cor_principal_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_cor_secundaria_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_cor_secundaria_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_cor_secundaria_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_cor_fundo_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_cor_fundo_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_cor_fundo_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_nome_organizador_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_nome_organizador_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_nome_organizador_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_email_organizador_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_email_organizador_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_email_organizador_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_nome_comprador_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_nome_comprador_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_nome_comprador_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_wz_suporte_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_wz_suporte_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_wz_suporte_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_gamificacao_ativada_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_gamificacao_ativada_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_gamificacao_ativada_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_galeria_fotos_ativada_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_galeria_fotos_ativada_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_galeria_fotos_ativada_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_galeria_fotos_publicas_ativada_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_galeria_fotos_publicas_ativada_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_galeria_fotos_publicas_ativada_app_onclick(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_event_galeria_fotos_publicas_ativada_app_onclick();
}

function sc_form_eventos_rsvp_galeria_fotos_publicas_ativada_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_chat_evento_ativado_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_chat_evento_ativado_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_chat_evento_ativado_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_cidade_destino_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_cidade_destino_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_cidade_destino_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_pais_destino_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_pais_destino_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_pais_destino_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_data_chegada_destino_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_data_chegada_destino_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_data_chegada_destino_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_data_partida_destino_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_data_partida_destino_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_data_partida_destino_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_texto_email_convite_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_texto_email_convite_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_texto_email_convite_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_texto_whatsapp_convite_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_texto_whatsapp_convite_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_texto_whatsapp_convite_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_termos_condicoes_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_termos_condicoes_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_termos_condicoes_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_canal_preferencial_convite_app_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_canal_preferencial_convite_app();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_canal_preferencial_convite_app_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_caminho_cover_image_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_caminho_cover_image();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_caminho_cover_image_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_cover_image_onblur(oThis, iSeqRow, event) {
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_cover_image_onfocus(oThis, iSeqRow, event) {
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_status_da_publicidade_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_status_da_publicidade();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_status_da_publicidade_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_timezone_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_timezone();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_timezone_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_cias_link_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_cias_link();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_cias_link_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_empresa_link_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_empresa_link();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_empresa_link_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_hoteis_link_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_hoteis_link();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_hoteis_link_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_localizacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_localizacao();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_localizacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_mailling_link_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_mailling_link();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_mailling_link_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_observacoes_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_observacoes();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_observacoes_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_particip_link_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_particip_link();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_particip_link_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_programacao_link_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_programacao_link();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_programacao_link_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_publicos_link_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_publicos_link();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_publicos_link_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_regionais_link_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_regionais_link();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_regionais_link_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_sql_log_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_sql_log();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_sql_log_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_tours_lnk_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_tours_lnk();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_tours_lnk_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_eventos_rsvp_usuarios_link_onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_rsvp_mob_validate_usuarios_link();
  scCssBlur(oThis);
}

function sc_form_eventos_rsvp_usuarios_link_onfocus(oThis, iSeqRow, event) {
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
}

function displayChange_block_0(status) {
        displayChange_field("particip_link", "", status);
        displayChange_field("empresa_link", "", status);
        displayChange_field("usuarios_link", "", status);
        displayChange_field("publicos_link", "", status);
        displayChange_field("hoteis_link", "", status);
        displayChange_field("cias_link", "", status);
        displayChange_field("tours_lnk", "", status);
        displayChange_field("regionais_link", "", status);
        displayChange_field("programacao_link", "", status);
        displayChange_field("mailling_link", "", status);
        displayChange_field("observacoes", "", status);
        displayChange_field("sql_log", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("evento_id", "", status);
        displayChange_field("evento_id_interno", "", status);
        displayChange_field("evento_id_complementar", "", status);
        displayChange_field("evento_nome", "", status);
        displayChange_field("evento_idioma", "", status);
        displayChange_field("evento_dt_realizacao", "", status);
        displayChange_field("evento_dt_conclusao", "", status);
        displayChange_field("evento_status", "", status);
        displayChange_field("evento_logo", "", status);
        displayChange_field("evento_website", "", status);
        displayChange_field("cover_image", "", status);
        displayChange_field("evento_email", "", status);
        displayChange_field("evento_tipo", "", status);
        displayChange_field("enviar_app", "", status);
}

function displayChange_block_2(status) {
        displayChange_field("evento_cep", "", status);
        displayChange_field("evento_pais", "", status);
        displayChange_field("evento_uf", "", status);
        displayChange_field("evento_municipio", "", status);
        displayChange_field("evento_bairro", "", status);
        displayChange_field("evento_logradouro", "", status);
        displayChange_field("evento_numero", "", status);
        displayChange_field("evento_complemento", "", status);
        displayChange_field("evento_observacao", "", status);
        displayChange_field("localizacao", "", status);
        displayChange_field("latitude_app", "", status);
        displayChange_field("longitude_app", "", status);
        displayChange_field("evento_id_responsavel", "", status);
        displayChange_field("evento_telefone", "", status);
        displayChange_field("evento_celular", "", status);
}

function displayChange_block_3(status) {
        displayChange_field("dsc_app", "", status);
        displayChange_field("data_conclusao_app", "", status);
        displayChange_field("localizacao_app", "", status);
        displayChange_field("status_app", "", status);
        displayChange_field("status_da_publicidade", "", status);
        displayChange_field("timezone", "", status);
        displayChange_field("caminho_logo_cli", "", status);
        displayChange_field("caminho_cover_image", "", status);
        displayChange_field("cor_principal_app", "", status);
        displayChange_field("cor_secundaria_app", "", status);
        displayChange_field("cor_fundo_app", "", status);
        displayChange_field("nome_organizador_app", "", status);
        displayChange_field("email_organizador_app", "", status);
        displayChange_field("nome_comprador_app", "", status);
        displayChange_field("wz_suporte_app", "", status);
        displayChange_field("gamificacao_ativada_app", "", status);
        displayChange_field("galeria_fotos_ativada_app", "", status);
        displayChange_field("galeria_fotos_publicas_ativada_app", "", status);
        displayChange_field("chat_evento_ativado_app", "", status);
        displayChange_field("cidade_destino_app", "", status);
        displayChange_field("pais_destino_app", "", status);
        displayChange_field("data_chegada_destino_app", "", status);
        displayChange_field("data_partida_destino_app", "", status);
        displayChange_field("texto_email_convite_app", "", status);
        displayChange_field("texto_whatsapp_convite_app", "", status);
        displayChange_field("termos_condicoes_app", "", status);
        displayChange_field("canal_preferencial_convite_app", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_particip_link(row, status);
        displayChange_field_empresa_link(row, status);
        displayChange_field_usuarios_link(row, status);
        displayChange_field_publicos_link(row, status);
        displayChange_field_hoteis_link(row, status);
        displayChange_field_cias_link(row, status);
        displayChange_field_tours_lnk(row, status);
        displayChange_field_regionais_link(row, status);
        displayChange_field_programacao_link(row, status);
        displayChange_field_mailling_link(row, status);
        displayChange_field_observacoes(row, status);
        displayChange_field_sql_log(row, status);
        displayChange_field_evento_id(row, status);
        displayChange_field_evento_id_interno(row, status);
        displayChange_field_evento_id_complementar(row, status);
        displayChange_field_evento_nome(row, status);
        displayChange_field_evento_idioma(row, status);
        displayChange_field_evento_dt_realizacao(row, status);
        displayChange_field_evento_dt_conclusao(row, status);
        displayChange_field_evento_status(row, status);
        displayChange_field_evento_logo(row, status);
        displayChange_field_evento_website(row, status);
        displayChange_field_cover_image(row, status);
        displayChange_field_evento_email(row, status);
        displayChange_field_evento_tipo(row, status);
        displayChange_field_enviar_app(row, status);
        displayChange_field_evento_cep(row, status);
        displayChange_field_evento_pais(row, status);
        displayChange_field_evento_uf(row, status);
        displayChange_field_evento_municipio(row, status);
        displayChange_field_evento_bairro(row, status);
        displayChange_field_evento_logradouro(row, status);
        displayChange_field_evento_numero(row, status);
        displayChange_field_evento_complemento(row, status);
        displayChange_field_evento_observacao(row, status);
        displayChange_field_localizacao(row, status);
        displayChange_field_latitude_app(row, status);
        displayChange_field_longitude_app(row, status);
        displayChange_field_evento_id_responsavel(row, status);
        displayChange_field_evento_telefone(row, status);
        displayChange_field_evento_celular(row, status);
        displayChange_field_dsc_app(row, status);
        displayChange_field_data_conclusao_app(row, status);
        displayChange_field_localizacao_app(row, status);
        displayChange_field_status_app(row, status);
        displayChange_field_status_da_publicidade(row, status);
        displayChange_field_timezone(row, status);
        displayChange_field_caminho_logo_cli(row, status);
        displayChange_field_caminho_cover_image(row, status);
        displayChange_field_cor_principal_app(row, status);
        displayChange_field_cor_secundaria_app(row, status);
        displayChange_field_cor_fundo_app(row, status);
        displayChange_field_nome_organizador_app(row, status);
        displayChange_field_email_organizador_app(row, status);
        displayChange_field_nome_comprador_app(row, status);
        displayChange_field_wz_suporte_app(row, status);
        displayChange_field_gamificacao_ativada_app(row, status);
        displayChange_field_galeria_fotos_ativada_app(row, status);
        displayChange_field_galeria_fotos_publicas_ativada_app(row, status);
        displayChange_field_chat_evento_ativado_app(row, status);
        displayChange_field_cidade_destino_app(row, status);
        displayChange_field_pais_destino_app(row, status);
        displayChange_field_data_chegada_destino_app(row, status);
        displayChange_field_data_partida_destino_app(row, status);
        displayChange_field_texto_email_convite_app(row, status);
        displayChange_field_texto_whatsapp_convite_app(row, status);
        displayChange_field_termos_condicoes_app(row, status);
        displayChange_field_canal_preferencial_convite_app(row, status);
}

function displayChange_field(field, row, status) {
        if ("particip_link" == field) {
                displayChange_field_particip_link(row, status);
        }
        if ("empresa_link" == field) {
                displayChange_field_empresa_link(row, status);
        }
        if ("usuarios_link" == field) {
                displayChange_field_usuarios_link(row, status);
        }
        if ("publicos_link" == field) {
                displayChange_field_publicos_link(row, status);
        }
        if ("hoteis_link" == field) {
                displayChange_field_hoteis_link(row, status);
        }
        if ("cias_link" == field) {
                displayChange_field_cias_link(row, status);
        }
        if ("tours_lnk" == field) {
                displayChange_field_tours_lnk(row, status);
        }
        if ("regionais_link" == field) {
                displayChange_field_regionais_link(row, status);
        }
        if ("programacao_link" == field) {
                displayChange_field_programacao_link(row, status);
        }
        if ("mailling_link" == field) {
                displayChange_field_mailling_link(row, status);
        }
        if ("observacoes" == field) {
                displayChange_field_observacoes(row, status);
        }
        if ("sql_log" == field) {
                displayChange_field_sql_log(row, status);
        }
        if ("evento_id" == field) {
                displayChange_field_evento_id(row, status);
        }
        if ("evento_id_interno" == field) {
                displayChange_field_evento_id_interno(row, status);
        }
        if ("evento_id_complementar" == field) {
                displayChange_field_evento_id_complementar(row, status);
        }
        if ("evento_nome" == field) {
                displayChange_field_evento_nome(row, status);
        }
        if ("evento_idioma" == field) {
                displayChange_field_evento_idioma(row, status);
        }
        if ("evento_dt_realizacao" == field) {
                displayChange_field_evento_dt_realizacao(row, status);
        }
        if ("evento_dt_conclusao" == field) {
                displayChange_field_evento_dt_conclusao(row, status);
        }
        if ("evento_status" == field) {
                displayChange_field_evento_status(row, status);
        }
        if ("evento_logo" == field) {
                displayChange_field_evento_logo(row, status);
        }
        if ("evento_website" == field) {
                displayChange_field_evento_website(row, status);
        }
        if ("cover_image" == field) {
                displayChange_field_cover_image(row, status);
        }
        if ("evento_email" == field) {
                displayChange_field_evento_email(row, status);
        }
        if ("evento_tipo" == field) {
                displayChange_field_evento_tipo(row, status);
        }
        if ("enviar_app" == field) {
                displayChange_field_enviar_app(row, status);
        }
        if ("evento_cep" == field) {
                displayChange_field_evento_cep(row, status);
        }
        if ("evento_pais" == field) {
                displayChange_field_evento_pais(row, status);
        }
        if ("evento_uf" == field) {
                displayChange_field_evento_uf(row, status);
        }
        if ("evento_municipio" == field) {
                displayChange_field_evento_municipio(row, status);
        }
        if ("evento_bairro" == field) {
                displayChange_field_evento_bairro(row, status);
        }
        if ("evento_logradouro" == field) {
                displayChange_field_evento_logradouro(row, status);
        }
        if ("evento_numero" == field) {
                displayChange_field_evento_numero(row, status);
        }
        if ("evento_complemento" == field) {
                displayChange_field_evento_complemento(row, status);
        }
        if ("evento_observacao" == field) {
                displayChange_field_evento_observacao(row, status);
        }
        if ("localizacao" == field) {
                displayChange_field_localizacao(row, status);
        }
        if ("latitude_app" == field) {
                displayChange_field_latitude_app(row, status);
        }
        if ("longitude_app" == field) {
                displayChange_field_longitude_app(row, status);
        }
        if ("evento_id_responsavel" == field) {
                displayChange_field_evento_id_responsavel(row, status);
        }
        if ("evento_telefone" == field) {
                displayChange_field_evento_telefone(row, status);
        }
        if ("evento_celular" == field) {
                displayChange_field_evento_celular(row, status);
        }
        if ("dsc_app" == field) {
                displayChange_field_dsc_app(row, status);
        }
        if ("data_conclusao_app" == field) {
                displayChange_field_data_conclusao_app(row, status);
        }
        if ("localizacao_app" == field) {
                displayChange_field_localizacao_app(row, status);
        }
        if ("status_app" == field) {
                displayChange_field_status_app(row, status);
        }
        if ("status_da_publicidade" == field) {
                displayChange_field_status_da_publicidade(row, status);
        }
        if ("timezone" == field) {
                displayChange_field_timezone(row, status);
        }
        if ("caminho_logo_cli" == field) {
                displayChange_field_caminho_logo_cli(row, status);
        }
        if ("caminho_cover_image" == field) {
                displayChange_field_caminho_cover_image(row, status);
        }
        if ("cor_principal_app" == field) {
                displayChange_field_cor_principal_app(row, status);
        }
        if ("cor_secundaria_app" == field) {
                displayChange_field_cor_secundaria_app(row, status);
        }
        if ("cor_fundo_app" == field) {
                displayChange_field_cor_fundo_app(row, status);
        }
        if ("nome_organizador_app" == field) {
                displayChange_field_nome_organizador_app(row, status);
        }
        if ("email_organizador_app" == field) {
                displayChange_field_email_organizador_app(row, status);
        }
        if ("nome_comprador_app" == field) {
                displayChange_field_nome_comprador_app(row, status);
        }
        if ("wz_suporte_app" == field) {
                displayChange_field_wz_suporte_app(row, status);
        }
        if ("gamificacao_ativada_app" == field) {
                displayChange_field_gamificacao_ativada_app(row, status);
        }
        if ("galeria_fotos_ativada_app" == field) {
                displayChange_field_galeria_fotos_ativada_app(row, status);
        }
        if ("galeria_fotos_publicas_ativada_app" == field) {
                displayChange_field_galeria_fotos_publicas_ativada_app(row, status);
        }
        if ("chat_evento_ativado_app" == field) {
                displayChange_field_chat_evento_ativado_app(row, status);
        }
        if ("cidade_destino_app" == field) {
                displayChange_field_cidade_destino_app(row, status);
        }
        if ("pais_destino_app" == field) {
                displayChange_field_pais_destino_app(row, status);
        }
        if ("data_chegada_destino_app" == field) {
                displayChange_field_data_chegada_destino_app(row, status);
        }
        if ("data_partida_destino_app" == field) {
                displayChange_field_data_partida_destino_app(row, status);
        }
        if ("texto_email_convite_app" == field) {
                displayChange_field_texto_email_convite_app(row, status);
        }
        if ("texto_whatsapp_convite_app" == field) {
                displayChange_field_texto_whatsapp_convite_app(row, status);
        }
        if ("termos_condicoes_app" == field) {
                displayChange_field_termos_condicoes_app(row, status);
        }
        if ("canal_preferencial_convite_app" == field) {
                displayChange_field_canal_preferencial_convite_app(row, status);
        }
}

function displayChange_field_particip_link(row, status) {
    var fieldId;
}

function displayChange_field_empresa_link(row, status) {
    var fieldId;
}

function displayChange_field_usuarios_link(row, status) {
    var fieldId;
}

function displayChange_field_publicos_link(row, status) {
    var fieldId;
}

function displayChange_field_hoteis_link(row, status) {
    var fieldId;
}

function displayChange_field_cias_link(row, status) {
    var fieldId;
}

function displayChange_field_tours_lnk(row, status) {
    var fieldId;
}

function displayChange_field_regionais_link(row, status) {
    var fieldId;
}

function displayChange_field_programacao_link(row, status) {
    var fieldId;
}

function displayChange_field_mailling_link(row, status) {
    var fieldId;
}

function displayChange_field_observacoes(row, status) {
    var fieldId;
}

function displayChange_field_sql_log(row, status) {
    var fieldId;
}

function displayChange_field_evento_id(row, status) {
    var fieldId;
}

function displayChange_field_evento_id_interno(row, status) {
    var fieldId;
}

function displayChange_field_evento_id_complementar(row, status) {
    var fieldId;
}

function displayChange_field_evento_nome(row, status) {
    var fieldId;
}

function displayChange_field_evento_idioma(row, status) {
    var fieldId;
}

function displayChange_field_evento_dt_realizacao(row, status) {
    var fieldId;
}

function displayChange_field_evento_dt_conclusao(row, status) {
    var fieldId;
}

function displayChange_field_evento_status(row, status) {
    var fieldId;
}

function displayChange_field_evento_logo(row, status) {
    var fieldId;
}

function displayChange_field_evento_website(row, status) {
    var fieldId;
}

function displayChange_field_cover_image(row, status) {
    var fieldId;
}

function displayChange_field_evento_email(row, status) {
    var fieldId;
}

function displayChange_field_evento_tipo(row, status) {
    var fieldId;
}

function displayChange_field_enviar_app(row, status) {
    var fieldId;
}

function displayChange_field_evento_cep(row, status) {
    var fieldId;
}

function displayChange_field_evento_pais(row, status) {
    var fieldId;
}

function displayChange_field_evento_uf(row, status) {
    var fieldId;
}

function displayChange_field_evento_municipio(row, status) {
    var fieldId;
}

function displayChange_field_evento_bairro(row, status) {
    var fieldId;
}

function displayChange_field_evento_logradouro(row, status) {
    var fieldId;
}

function displayChange_field_evento_numero(row, status) {
    var fieldId;
}

function displayChange_field_evento_complemento(row, status) {
    var fieldId;
}

function displayChange_field_evento_observacao(row, status) {
    var fieldId;
}

function displayChange_field_localizacao(row, status) {
    var fieldId;
}

function displayChange_field_latitude_app(row, status) {
    var fieldId;
}

function displayChange_field_longitude_app(row, status) {
    var fieldId;
}

function displayChange_field_evento_id_responsavel(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_evento_id_responsavel__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_evento_id_responsavel' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_evento_id_responsavel" + row).select2("destroy");
                }
                scJQSelect2Add(row, "evento_id_responsavel");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_evento_id_responsavel' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_evento_telefone(row, status) {
    var fieldId;
}

function displayChange_field_evento_celular(row, status) {
    var fieldId;
}

function displayChange_field_dsc_app(row, status) {
    var fieldId;
}

function displayChange_field_data_conclusao_app(row, status) {
    var fieldId;
}

function displayChange_field_localizacao_app(row, status) {
    var fieldId;
}

function displayChange_field_status_app(row, status) {
    var fieldId;
}

function displayChange_field_status_da_publicidade(row, status) {
    var fieldId;
}

function displayChange_field_timezone(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_timezone__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_timezone' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_timezone" + row).select2("destroy");
                }
                scJQSelect2Add(row, "timezone");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_timezone' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_caminho_logo_cli(row, status) {
    var fieldId;
}

function displayChange_field_caminho_cover_image(row, status) {
    var fieldId;
}

function displayChange_field_cor_principal_app(row, status) {
    var fieldId;
}

function displayChange_field_cor_secundaria_app(row, status) {
    var fieldId;
}

function displayChange_field_cor_fundo_app(row, status) {
    var fieldId;
}

function displayChange_field_nome_organizador_app(row, status) {
    var fieldId;
}

function displayChange_field_email_organizador_app(row, status) {
    var fieldId;
}

function displayChange_field_nome_comprador_app(row, status) {
    var fieldId;
}

function displayChange_field_wz_suporte_app(row, status) {
    var fieldId;
}

function displayChange_field_gamificacao_ativada_app(row, status) {
    var fieldId;
}

function displayChange_field_galeria_fotos_ativada_app(row, status) {
    var fieldId;
}

function displayChange_field_galeria_fotos_publicas_ativada_app(row, status) {
    var fieldId;
}

function displayChange_field_chat_evento_ativado_app(row, status) {
    var fieldId;
}

function displayChange_field_cidade_destino_app(row, status) {
    var fieldId;
}

function displayChange_field_pais_destino_app(row, status) {
    var fieldId;
}

function displayChange_field_data_chegada_destino_app(row, status) {
    var fieldId;
}

function displayChange_field_data_partida_destino_app(row, status) {
    var fieldId;
}

function displayChange_field_texto_email_convite_app(row, status) {
    var fieldId;
}

function displayChange_field_texto_whatsapp_convite_app(row, status) {
    var fieldId;
}

function displayChange_field_termos_condicoes_app(row, status) {
    var fieldId;
}

function displayChange_field_canal_preferencial_convite_app(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
        displayChange_field_evento_id_responsavel("all", "on");
        displayChange_field_timezone("all", "on");
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_eventos_rsvp_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(32);
                }
        }
}
var sc_jq_calendar_value = {};

function scJQCalendarAdd(iSeqRow) {
  $("#id_sc_field_evento_dt_realizacao" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_evento_dt_realizacao" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_evento_dt_realizacao" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      setTimeout(function() { do_ajax_form_eventos_rsvp_mob_validate_evento_dt_realizacao(iSeqRow); }, 200);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['evento_dt_realizacao']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_evento_dt_conclusao" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_evento_dt_conclusao" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_evento_dt_conclusao" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_eventos_rsvp_mob_validate_evento_dt_conclusao(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['evento_dt_conclusao']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_data_conclusao_app" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_data_conclusao_app" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_data_conclusao_app" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_eventos_rsvp_mob_validate_data_conclusao_app(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['data_conclusao_app']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_data_chegada_destino_app" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_data_chegada_destino_app" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_data_chegada_destino_app" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_eventos_rsvp_mob_validate_data_chegada_destino_app(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['data_chegada_destino_app']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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
  $("#id_sc_field_data_partida_destino_app" + iSeqRow).datepicker('destroy');
  $("#id_sc_field_data_partida_destino_app" + iSeqRow).datepicker({
    beforeShow: function(input, inst) {
      var $oField = $(this),
          aParts  = $oField.val().split(" "),
          sTime   = "";
      sc_jq_calendar_value["#id_sc_field_data_partida_destino_app" + iSeqRow] = $oField.val();
    },
    onClose: function(dateText, inst) {
      do_ajax_form_eventos_rsvp_mob_validate_data_partida_destino_app(iSeqRow);
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
    dateFormat: "<?php echo $this->jqueryCalendarDtFormat("" . str_replace(array('/', 'aaaa', $_SESSION['scriptcase']['reg_conf']['date_sep']), array('', 'yyyy', ''), $this->field_config['data_partida_destino_app']['date_format']) . "", "" . $_SESSION['scriptcase']['reg_conf']['date_sep'] . ""); ?>",
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

function scJQColorPickerAdd(iSeqRow) {
  $("#cor_principal_app" + iSeqRow + "_cor").ColorPicker({
    onShow: function(colpkr) {
      $(colpkr).fadeIn(500);
      $(colpkr).css('z-index', 999999);
      return false;
    },
    onHide: function(colpkr) {
      $(colpkr).fadeOut(500);
      return false;
    },
    onChange: function(hsb, hex, rgb) {
      $("#id_sc_field_cor_principal_app" + iSeqRow).val("#" + hex);
      $("#id_sc_field_cor_principal_app" + iSeqRow).trigger("change");
    },
    onSubmit: function(hsb, hex, rgb, el) {
      $("#id_sc_field_cor_principal_app" + iSeqRow).val("#" + hex);
      $(el).ColorPickerHide();
    },
    onBeforeShow: function() {
      var origVal = $("#id_sc_field_cor_principal_app" + iSeqRow).val();
      if ("#" == origVal.substr(0, 1)) {
        origVal = origVal.substr(1);
      }
      $(this).ColorPickerSetColor(origVal);
    }
  });
  $("#cor_secundaria_app" + iSeqRow + "_cor").ColorPicker({
    onShow: function(colpkr) {
      $(colpkr).fadeIn(500);
      $(colpkr).css('z-index', 999999);
      return false;
    },
    onHide: function(colpkr) {
      $(colpkr).fadeOut(500);
      return false;
    },
    onChange: function(hsb, hex, rgb) {
      $("#id_sc_field_cor_secundaria_app" + iSeqRow).val("#" + hex);
      $("#id_sc_field_cor_secundaria_app" + iSeqRow).trigger("change");
    },
    onSubmit: function(hsb, hex, rgb, el) {
      $("#id_sc_field_cor_secundaria_app" + iSeqRow).val("#" + hex);
      $(el).ColorPickerHide();
    },
    onBeforeShow: function() {
      var origVal = $("#id_sc_field_cor_secundaria_app" + iSeqRow).val();
      if ("#" == origVal.substr(0, 1)) {
        origVal = origVal.substr(1);
      }
      $(this).ColorPickerSetColor(origVal);
    }
  });
  $("#cor_fundo_app" + iSeqRow + "_cor").ColorPicker({
    onShow: function(colpkr) {
      $(colpkr).fadeIn(500);
      $(colpkr).css('z-index', 999999);
      return false;
    },
    onHide: function(colpkr) {
      $(colpkr).fadeOut(500);
      return false;
    },
    onChange: function(hsb, hex, rgb) {
      $("#id_sc_field_cor_fundo_app" + iSeqRow).val("#" + hex);
      $("#id_sc_field_cor_fundo_app" + iSeqRow).trigger("change");
    },
    onSubmit: function(hsb, hex, rgb, el) {
      $("#id_sc_field_cor_fundo_app" + iSeqRow).val("#" + hex);
      $(el).ColorPickerHide();
    },
    onBeforeShow: function() {
      var origVal = $("#id_sc_field_cor_fundo_app" + iSeqRow).val();
      if ("#" == origVal.substr(0, 1)) {
        origVal = origVal.substr(1);
      }
      $(this).ColorPickerSetColor(origVal);
    }
  });
} // scJQColorPickerAdd

function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_evento_logo" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_eventos_rsvp_mob_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'evento_logo'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_evento_logo" + iSeqRow);
        loaderContent = $("#id_img_loader_evento_logo" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_evento_logo" + iSeqRow);
        loader.show();
      }
    },
    change: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_evento_logo(data);
      if ('ok' != checkUploadSize) {
        e.preventDefault();
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    drop: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_evento_logo(data);
      if ('ok' != checkUploadSize) {
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
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
        $("#id_img_loader_evento_logo" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_evento_logo" + iSeqRow).hide();
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
      $("#id_sc_field_evento_logo" + iSeqRow).val("");
      $("#id_sc_field_evento_logo_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_evento_logo_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_evento_logo = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_image_source;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_evento_logo) ? "none" : "";
      $("#id_ajax_img_evento_logo" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_evento_logo" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_evento_logo) {
        document.F1.temp_out_evento_logo.value = var_ajax_img_thumb;
        document.F1.temp_out1_evento_logo.value = var_ajax_img_evento_logo;
      }
      else if (document.F1.temp_out_evento_logo) {
        document.F1.temp_out_evento_logo.value = var_ajax_img_evento_logo;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_evento_logo" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_evento_logo" + iSeqRow).html(fileData[0].name);
      $("#txt_ajax_img_evento_logo" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_evento_logo" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
      scMarkFormAsChanged();
    }
  });

  $("#id_sc_field_cover_image" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_eventos_rsvp_mob_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'cover_image'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_cover_image" + iSeqRow);
        loaderContent = $("#id_img_loader_cover_image" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_cover_image" + iSeqRow);
        loader.show();
      }
    },
    change: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_cover_image(data);
      if ('ok' != checkUploadSize) {
        e.preventDefault();
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
      }
    },
    drop: function(e, data) {
      var checkUploadSize = scCheckUploadExtensionSize_cover_image(data);
      if ('ok' != checkUploadSize) {
        scJs_alert(scFormatExtensionSizeErrorMsg(checkUploadSize), function() {}, {'type': 'error'});
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
        $("#id_img_loader_cover_image" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_cover_image" + iSeqRow).hide();
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
      $("#id_sc_field_cover_image" + iSeqRow).val("");
      $("#id_sc_field_cover_image_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_cover_image_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_cover_image = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_image_source;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_cover_image) ? "none" : "";
      $("#id_ajax_img_cover_image" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_cover_image" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_cover_image) {
        document.F1.temp_out_cover_image.value = var_ajax_img_thumb;
        document.F1.temp_out1_cover_image.value = var_ajax_img_cover_image;
      }
      else if (document.F1.temp_out_cover_image) {
        document.F1.temp_out_cover_image.value = var_ajax_img_cover_image;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_cover_image" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_cover_image" + iSeqRow).html(fileData[0].name);
      $("#txt_ajax_img_cover_image" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_cover_image" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_eventos_rsvp_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_eventos_rsvp_mob');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_eventos_rsvp_mob');
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
  if (null == specificField || "evento_id_responsavel" == specificField) {
    scJQSelect2Add_evento_id_responsavel(seqRow);
  }
  if (null == specificField || "timezone" == specificField) {
    scJQSelect2Add_timezone(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_evento_id_responsavel(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_evento_id_responsavel_obj" : "#id_sc_field_evento_id_responsavel" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_evento_id_responsavel_obj',
      dropdownCssClass: 'css_evento_id_responsavel_obj',
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
  $('#select2-id_sc_field_evento_id_responsavel' + seqRow + '-container').addClass('css_evento_id_responsavel_obj');
} // scJQSelect2Add

function scJQSelect2Add_timezone(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_timezone_obj" : "#id_sc_field_timezone" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_timezone_obj',
      dropdownCssClass: 'css_timezone_obj',
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
  $('#select2-id_sc_field_timezone' + seqRow + '-container').addClass('css_timezone_obj');
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQCalendarAdd(iLine);
  scJQColorPickerAdd(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_evento_id_responsavel) { displayChange_field_evento_id_responsavel(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
  setTimeout(function () { if ('function' == typeof displayChange_field_timezone) { displayChange_field_timezone(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
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

function scCheckUploadExtensionSize_evento_logo(thisField)
{
    if ("files" in thisField && thisField.files.length > 0) {
        thisFileExtension = scGetFileExtension(thisField.files[0].name);

        if ("png" == thisFileExtension && 1048576 < thisField.files[0].size) {
            return 'err_size||PNG||1 MB';
        }
        if ("jpg" == thisFileExtension && 1048576 < thisField.files[0].size) {
            return 'err_size||JPG||1 MB';
        }
        if ("jpeg" == thisFileExtension && 1048576 < thisField.files[0].size) {
            return 'err_size||JPEG||1 MB';
        }

        if (!["png", "jpg", "jpeg"].includes(thisFileExtension)) {
            return 'err_extension||' + thisFileExtension.toUpperCase();
        }
    }

    return 'ok';
}

function scCheckUploadExtensionSize_cover_image(thisField)
{
    if ("files" in thisField && thisField.files.length > 0) {
        thisFileExtension = scGetFileExtension(thisField.files[0].name);

        if ("png" == thisFileExtension && 1048576 < thisField.files[0].size) {
            return 'err_size||PNG||1 MB';
        }
        if ("jpg" == thisFileExtension && 1048576 < thisField.files[0].size) {
            return 'err_size||JPG||1 MB';
        }
        if ("jpeg" == thisFileExtension && 1048576 < thisField.files[0].size) {
            return 'err_size||JPEG||1 MB';
        }

        if (!["png", "jpg", "jpeg"].includes(thisFileExtension)) {
            return 'err_extension||' + thisFileExtension.toUpperCase();
        }
    }

    return 'ok';
}

