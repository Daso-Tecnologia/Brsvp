
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
     if (sField == 'fornec_pais') {
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
  scEventControl_data["fornec_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_cnpj" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_razsoc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_fantasia" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_tipo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_tipo_estrangeiro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_cep" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_pais" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_uf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_municipio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_bairro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_tipo_logradouro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_logradouro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_numero" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_complemento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_website" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_celular" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_tel" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_contato" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_codfor_estrangeiro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["fornec_ativo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["fornec_id" + iSeqRow] && scEventControl_data["fornec_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_id" + iSeqRow] && scEventControl_data["fornec_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_cnpj" + iSeqRow] && scEventControl_data["fornec_cnpj" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_cnpj" + iSeqRow] && scEventControl_data["fornec_cnpj" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_razsoc" + iSeqRow] && scEventControl_data["fornec_razsoc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_razsoc" + iSeqRow] && scEventControl_data["fornec_razsoc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_fantasia" + iSeqRow] && scEventControl_data["fornec_fantasia" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_fantasia" + iSeqRow] && scEventControl_data["fornec_fantasia" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_tipo" + iSeqRow] && scEventControl_data["fornec_tipo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_tipo" + iSeqRow] && scEventControl_data["fornec_tipo" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_tipo_estrangeiro" + iSeqRow] && scEventControl_data["fornec_tipo_estrangeiro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_tipo_estrangeiro" + iSeqRow] && scEventControl_data["fornec_tipo_estrangeiro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_cep" + iSeqRow] && scEventControl_data["fornec_cep" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_cep" + iSeqRow] && scEventControl_data["fornec_cep" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_pais" + iSeqRow] && scEventControl_data["fornec_pais" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_pais" + iSeqRow] && scEventControl_data["fornec_pais" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_uf" + iSeqRow] && scEventControl_data["fornec_uf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_uf" + iSeqRow] && scEventControl_data["fornec_uf" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_municipio" + iSeqRow] && scEventControl_data["fornec_municipio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_municipio" + iSeqRow] && scEventControl_data["fornec_municipio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_bairro" + iSeqRow] && scEventControl_data["fornec_bairro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_bairro" + iSeqRow] && scEventControl_data["fornec_bairro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_tipo_logradouro" + iSeqRow] && scEventControl_data["fornec_tipo_logradouro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_tipo_logradouro" + iSeqRow] && scEventControl_data["fornec_tipo_logradouro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_logradouro" + iSeqRow] && scEventControl_data["fornec_logradouro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_logradouro" + iSeqRow] && scEventControl_data["fornec_logradouro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_numero" + iSeqRow] && scEventControl_data["fornec_numero" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_numero" + iSeqRow] && scEventControl_data["fornec_numero" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_complemento" + iSeqRow] && scEventControl_data["fornec_complemento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_complemento" + iSeqRow] && scEventControl_data["fornec_complemento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_email" + iSeqRow] && scEventControl_data["fornec_email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_email" + iSeqRow] && scEventControl_data["fornec_email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_website" + iSeqRow] && scEventControl_data["fornec_website" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_website" + iSeqRow] && scEventControl_data["fornec_website" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_celular" + iSeqRow] && scEventControl_data["fornec_celular" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_celular" + iSeqRow] && scEventControl_data["fornec_celular" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_tel" + iSeqRow] && scEventControl_data["fornec_tel" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_tel" + iSeqRow] && scEventControl_data["fornec_tel" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_contato" + iSeqRow] && scEventControl_data["fornec_contato" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_contato" + iSeqRow] && scEventControl_data["fornec_contato" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_codfor_estrangeiro" + iSeqRow] && scEventControl_data["fornec_codfor_estrangeiro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_codfor_estrangeiro" + iSeqRow] && scEventControl_data["fornec_codfor_estrangeiro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["fornec_ativo" + iSeqRow] && scEventControl_data["fornec_ativo" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["fornec_ativo" + iSeqRow] && scEventControl_data["fornec_ativo" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("fornec_tipo" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("fornec_pais" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("fornec_cnpj" + iSeq == fieldName) {
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
  $('#id_sc_field_fornec_id' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_id_onblur('#id_sc_field_fornec_id' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_tbl_fornecedores_fornec_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_cnpj' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_tbl_fornecedores_fornec_cnpj_onblur('#id_sc_field_fornec_cnpj' + iSeqRow, iSeqRow, event);}, 300) })
                                         .bind('change', function() { sc_form_tbl_fornecedores_fornec_cnpj_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_tbl_fornecedores_fornec_cnpj_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_razsoc' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_tbl_fornecedores_fornec_razsoc_onblur('#id_sc_field_fornec_razsoc' + iSeqRow, iSeqRow, event);}, 300) })
                                           .bind('focus', function() { sc_form_tbl_fornecedores_fornec_razsoc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_fantasia' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_tbl_fornecedores_fornec_fantasia_onblur('#id_sc_field_fornec_fantasia' + iSeqRow, iSeqRow, event);}, 300) })
                                             .bind('focus', function() { sc_form_tbl_fornecedores_fornec_fantasia_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_tipo' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_tipo_onblur('#id_sc_field_fornec_tipo' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_tbl_fornecedores_fornec_tipo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_tipo_estrangeiro' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_tipo_estrangeiro_onblur('#id_sc_field_fornec_tipo_estrangeiro' + iSeqRow, iSeqRow, event) })
                                                     .bind('focus', function() { sc_form_tbl_fornecedores_fornec_tipo_estrangeiro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_cep' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_cep_onblur('#id_sc_field_fornec_cep' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_tbl_fornecedores_fornec_cep_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_tbl_fornecedores_fornec_cep_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_pais' + iSeqRow).bind('select2:close', function() { sc_form_tbl_fornecedores_fornec_pais_onblur('#id_sc_field_fornec_pais' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_tbl_fornecedores_fornec_pais_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_uf' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_uf_onblur('#id_sc_field_fornec_uf' + iSeqRow, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_tbl_fornecedores_fornec_uf_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_municipio' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_municipio_onblur('#id_sc_field_fornec_municipio' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_tbl_fornecedores_fornec_municipio_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_bairro' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_bairro_onblur('#id_sc_field_fornec_bairro' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_tbl_fornecedores_fornec_bairro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_logradouro' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_logradouro_onblur('#id_sc_field_fornec_logradouro' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_tbl_fornecedores_fornec_logradouro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_tipo_logradouro' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_tipo_logradouro_onblur('#id_sc_field_fornec_tipo_logradouro' + iSeqRow, iSeqRow, event) })
                                                    .bind('focus', function() { sc_form_tbl_fornecedores_fornec_tipo_logradouro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_numero' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_numero_onblur('#id_sc_field_fornec_numero' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_tbl_fornecedores_fornec_numero_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_complemento' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_complemento_onblur('#id_sc_field_fornec_complemento' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_tbl_fornecedores_fornec_complemento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_email' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_email_onblur('#id_sc_field_fornec_email' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_tbl_fornecedores_fornec_email_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_website' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_website_onblur('#id_sc_field_fornec_website' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_tbl_fornecedores_fornec_website_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_tel' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_tel_onblur('#id_sc_field_fornec_tel' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_tbl_fornecedores_fornec_tel_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_celular' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_celular_onblur('#id_sc_field_fornec_celular' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_tbl_fornecedores_fornec_celular_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_contato' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_contato_onblur('#id_sc_field_fornec_contato' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_tbl_fornecedores_fornec_contato_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_codfor_estrangeiro' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_codfor_estrangeiro_onblur('#id_sc_field_fornec_codfor_estrangeiro' + iSeqRow, iSeqRow, event) })
                                                       .bind('focus', function() { sc_form_tbl_fornecedores_fornec_codfor_estrangeiro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_fornec_ativo' + iSeqRow).bind('blur', function() { sc_form_tbl_fornecedores_fornec_ativo_onblur('#id_sc_field_fornec_ativo' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_tbl_fornecedores_fornec_ativo_onfocus(this, iSeqRow, event) });
  $('.sc-ui-radio-fornec_ativo' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_tbl_fornecedores_fornec_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_id();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_cnpj_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_cnpj();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_cnpj_onchange(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_event_fornec_cnpj_onchange();
}

function sc_form_tbl_fornecedores_fornec_cnpj_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_razsoc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_razsoc();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_razsoc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_fantasia_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_fantasia();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_fantasia_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_tipo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_tipo();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_tipo_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_tipo_estrangeiro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_tipo_estrangeiro();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_tipo_estrangeiro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_cep_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_cep();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_cep_onchange(oThis, iSeqRow, event) {
  cep_fornec_cep(oThis.value, 'F1;CEP,fornec_cep;UF,fornec_uf;CIDADE,fornec_municipio;BAIRRO,fornec_bairro;RUA,fornec_logradouro;TIPOEXT,fornec_tipo_logradouro;LOGRAD,fornec_logradouro');
}

function sc_form_tbl_fornecedores_fornec_cep_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_pais_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_pais();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_pais_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_uf_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_uf();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_uf_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_municipio_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_municipio();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_municipio_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_bairro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_bairro();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_bairro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_logradouro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_logradouro();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_logradouro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_tipo_logradouro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_tipo_logradouro();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_tipo_logradouro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_numero_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_numero();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_numero_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_complemento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_complemento();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_complemento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_email_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_email();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_email_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_website_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_website();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_website_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_tel_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_tel();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_tel_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_celular_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_celular();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_celular_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_contato_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_contato();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_contato_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_codfor_estrangeiro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_codfor_estrangeiro();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_codfor_estrangeiro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_fornecedores_fornec_ativo_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_fornecedores_mob_validate_fornec_ativo();
  scCssBlur(oThis);
}

function sc_form_tbl_fornecedores_fornec_ativo_onfocus(oThis, iSeqRow, event) {
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
        displayChange_field("fornec_id", "", status);
        displayChange_field("fornec_cnpj", "", status);
        displayChange_field("fornec_razsoc", "", status);
        displayChange_field("fornec_fantasia", "", status);
        displayChange_field("fornec_tipo", "", status);
        displayChange_field("fornec_tipo_estrangeiro", "", status);
        displayChange_field("fornec_cep", "", status);
        displayChange_field("fornec_pais", "", status);
        displayChange_field("fornec_uf", "", status);
        displayChange_field("fornec_municipio", "", status);
        displayChange_field("fornec_bairro", "", status);
        displayChange_field("fornec_tipo_logradouro", "", status);
        displayChange_field("fornec_logradouro", "", status);
        displayChange_field("fornec_numero", "", status);
        displayChange_field("fornec_complemento", "", status);
        displayChange_field("fornec_email", "", status);
        displayChange_field("fornec_website", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("fornec_celular", "", status);
        displayChange_field("fornec_tel", "", status);
        displayChange_field("fornec_contato", "", status);
        displayChange_field("fornec_codfor_estrangeiro", "", status);
        displayChange_field("fornec_ativo", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_fornec_id(row, status);
        displayChange_field_fornec_cnpj(row, status);
        displayChange_field_fornec_razsoc(row, status);
        displayChange_field_fornec_fantasia(row, status);
        displayChange_field_fornec_tipo(row, status);
        displayChange_field_fornec_tipo_estrangeiro(row, status);
        displayChange_field_fornec_cep(row, status);
        displayChange_field_fornec_pais(row, status);
        displayChange_field_fornec_uf(row, status);
        displayChange_field_fornec_municipio(row, status);
        displayChange_field_fornec_bairro(row, status);
        displayChange_field_fornec_tipo_logradouro(row, status);
        displayChange_field_fornec_logradouro(row, status);
        displayChange_field_fornec_numero(row, status);
        displayChange_field_fornec_complemento(row, status);
        displayChange_field_fornec_email(row, status);
        displayChange_field_fornec_website(row, status);
        displayChange_field_fornec_celular(row, status);
        displayChange_field_fornec_tel(row, status);
        displayChange_field_fornec_contato(row, status);
        displayChange_field_fornec_codfor_estrangeiro(row, status);
        displayChange_field_fornec_ativo(row, status);
}

function displayChange_field(field, row, status) {
        if ("fornec_id" == field) {
                displayChange_field_fornec_id(row, status);
        }
        if ("fornec_cnpj" == field) {
                displayChange_field_fornec_cnpj(row, status);
        }
        if ("fornec_razsoc" == field) {
                displayChange_field_fornec_razsoc(row, status);
        }
        if ("fornec_fantasia" == field) {
                displayChange_field_fornec_fantasia(row, status);
        }
        if ("fornec_tipo" == field) {
                displayChange_field_fornec_tipo(row, status);
        }
        if ("fornec_tipo_estrangeiro" == field) {
                displayChange_field_fornec_tipo_estrangeiro(row, status);
        }
        if ("fornec_cep" == field) {
                displayChange_field_fornec_cep(row, status);
        }
        if ("fornec_pais" == field) {
                displayChange_field_fornec_pais(row, status);
        }
        if ("fornec_uf" == field) {
                displayChange_field_fornec_uf(row, status);
        }
        if ("fornec_municipio" == field) {
                displayChange_field_fornec_municipio(row, status);
        }
        if ("fornec_bairro" == field) {
                displayChange_field_fornec_bairro(row, status);
        }
        if ("fornec_tipo_logradouro" == field) {
                displayChange_field_fornec_tipo_logradouro(row, status);
        }
        if ("fornec_logradouro" == field) {
                displayChange_field_fornec_logradouro(row, status);
        }
        if ("fornec_numero" == field) {
                displayChange_field_fornec_numero(row, status);
        }
        if ("fornec_complemento" == field) {
                displayChange_field_fornec_complemento(row, status);
        }
        if ("fornec_email" == field) {
                displayChange_field_fornec_email(row, status);
        }
        if ("fornec_website" == field) {
                displayChange_field_fornec_website(row, status);
        }
        if ("fornec_celular" == field) {
                displayChange_field_fornec_celular(row, status);
        }
        if ("fornec_tel" == field) {
                displayChange_field_fornec_tel(row, status);
        }
        if ("fornec_contato" == field) {
                displayChange_field_fornec_contato(row, status);
        }
        if ("fornec_codfor_estrangeiro" == field) {
                displayChange_field_fornec_codfor_estrangeiro(row, status);
        }
        if ("fornec_ativo" == field) {
                displayChange_field_fornec_ativo(row, status);
        }
}

function displayChange_field_fornec_id(row, status) {
    var fieldId;
}

function displayChange_field_fornec_cnpj(row, status) {
    var fieldId;
}

function displayChange_field_fornec_razsoc(row, status) {
    var fieldId;
}

function displayChange_field_fornec_fantasia(row, status) {
    var fieldId;
}

function displayChange_field_fornec_tipo(row, status) {
    var fieldId;
}

function displayChange_field_fornec_tipo_estrangeiro(row, status) {
    var fieldId;
}

function displayChange_field_fornec_cep(row, status) {
    var fieldId;
}

function displayChange_field_fornec_pais(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_fornec_pais__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_fornec_pais' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_fornec_pais" + row).select2("destroy");
                }
                scJQSelect2Add(row, "fornec_pais");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_fornec_pais' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_fornec_uf(row, status) {
    var fieldId;
}

function displayChange_field_fornec_municipio(row, status) {
    var fieldId;
}

function displayChange_field_fornec_bairro(row, status) {
    var fieldId;
}

function displayChange_field_fornec_tipo_logradouro(row, status) {
    var fieldId;
}

function displayChange_field_fornec_logradouro(row, status) {
    var fieldId;
}

function displayChange_field_fornec_numero(row, status) {
    var fieldId;
}

function displayChange_field_fornec_complemento(row, status) {
    var fieldId;
}

function displayChange_field_fornec_email(row, status) {
    var fieldId;
}

function displayChange_field_fornec_website(row, status) {
    var fieldId;
}

function displayChange_field_fornec_celular(row, status) {
    var fieldId;
}

function displayChange_field_fornec_tel(row, status) {
    var fieldId;
}

function displayChange_field_fornec_contato(row, status) {
    var fieldId;
}

function displayChange_field_fornec_codfor_estrangeiro(row, status) {
    var fieldId;
}

function displayChange_field_fornec_ativo(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
        displayChange_field_fornec_pais("all", "on");
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_tbl_fornecedores_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(36);
                }
        }
}
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_tbl_fornecedores_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_tbl_fornecedores_mob');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_tbl_fornecedores_mob');
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
  if (null == specificField || "fornec_pais" == specificField) {
    scJQSelect2Add_fornec_pais(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_fornec_pais(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_fornec_pais_obj" : "#id_sc_field_fornec_pais" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_fornec_pais_obj',
      dropdownCssClass: 'css_fornec_pais_obj',
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
  $('#select2-id_sc_field_fornec_pais' + seqRow + '-container').addClass('css_fornec_pais_obj');
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_fornec_pais) { displayChange_field_fornec_pais(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
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

