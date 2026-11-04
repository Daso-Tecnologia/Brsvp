
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
  scEventControl_data["empresa_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_cnpj" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_fantasia" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_razsoc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_inscestad" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_facebook" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_google" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_twitter" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_skype" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_website" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_status" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_logo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_cep" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_pais" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_uf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_municipio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_bairro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_logradouro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_numero" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_complem" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["localizacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_telefone" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_fax" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["empresa_celular" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["empresa_id" + iSeqRow] && scEventControl_data["empresa_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_id" + iSeqRow] && scEventControl_data["empresa_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_cnpj" + iSeqRow] && scEventControl_data["empresa_cnpj" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_cnpj" + iSeqRow] && scEventControl_data["empresa_cnpj" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_fantasia" + iSeqRow] && scEventControl_data["empresa_fantasia" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_fantasia" + iSeqRow] && scEventControl_data["empresa_fantasia" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_razsoc" + iSeqRow] && scEventControl_data["empresa_razsoc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_razsoc" + iSeqRow] && scEventControl_data["empresa_razsoc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_inscestad" + iSeqRow] && scEventControl_data["empresa_inscestad" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_inscestad" + iSeqRow] && scEventControl_data["empresa_inscestad" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_facebook" + iSeqRow] && scEventControl_data["empresa_facebook" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_facebook" + iSeqRow] && scEventControl_data["empresa_facebook" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_google" + iSeqRow] && scEventControl_data["empresa_google" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_google" + iSeqRow] && scEventControl_data["empresa_google" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_twitter" + iSeqRow] && scEventControl_data["empresa_twitter" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_twitter" + iSeqRow] && scEventControl_data["empresa_twitter" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_skype" + iSeqRow] && scEventControl_data["empresa_skype" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_skype" + iSeqRow] && scEventControl_data["empresa_skype" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_website" + iSeqRow] && scEventControl_data["empresa_website" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_website" + iSeqRow] && scEventControl_data["empresa_website" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_status" + iSeqRow] && scEventControl_data["empresa_status" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_status" + iSeqRow] && scEventControl_data["empresa_status" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_cep" + iSeqRow] && scEventControl_data["empresa_cep" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_cep" + iSeqRow] && scEventControl_data["empresa_cep" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_pais" + iSeqRow] && scEventControl_data["empresa_pais" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_pais" + iSeqRow] && scEventControl_data["empresa_pais" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_uf" + iSeqRow] && scEventControl_data["empresa_uf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_uf" + iSeqRow] && scEventControl_data["empresa_uf" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_municipio" + iSeqRow] && scEventControl_data["empresa_municipio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_municipio" + iSeqRow] && scEventControl_data["empresa_municipio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_bairro" + iSeqRow] && scEventControl_data["empresa_bairro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_bairro" + iSeqRow] && scEventControl_data["empresa_bairro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_logradouro" + iSeqRow] && scEventControl_data["empresa_logradouro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_logradouro" + iSeqRow] && scEventControl_data["empresa_logradouro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_numero" + iSeqRow] && scEventControl_data["empresa_numero" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_numero" + iSeqRow] && scEventControl_data["empresa_numero" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_complem" + iSeqRow] && scEventControl_data["empresa_complem" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_complem" + iSeqRow] && scEventControl_data["empresa_complem" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["localizacao" + iSeqRow] && scEventControl_data["localizacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["localizacao" + iSeqRow] && scEventControl_data["localizacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_email" + iSeqRow] && scEventControl_data["empresa_email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_email" + iSeqRow] && scEventControl_data["empresa_email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_telefone" + iSeqRow] && scEventControl_data["empresa_telefone" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_telefone" + iSeqRow] && scEventControl_data["empresa_telefone" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_fax" + iSeqRow] && scEventControl_data["empresa_fax" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_fax" + iSeqRow] && scEventControl_data["empresa_fax" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["empresa_celular" + iSeqRow] && scEventControl_data["empresa_celular" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["empresa_celular" + iSeqRow] && scEventControl_data["empresa_celular" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("empresa_pais" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("empresa_cnpj" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("empresa_numero" + iSeq == fieldName) {
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
  $('#id_sc_field_empresa_id' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_id_onblur('#id_sc_field_empresa_id' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_empresas_rsvp_empresa_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_cnpj' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_empresas_rsvp_empresa_cnpj_onblur('#id_sc_field_empresa_cnpj' + iSeqRow, iSeqRow, event);}, 300) })
                                          .bind('change', function() { sc_form_empresas_rsvp_empresa_cnpj_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_empresas_rsvp_empresa_cnpj_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_fantasia' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_empresas_rsvp_empresa_fantasia_onblur('#id_sc_field_empresa_fantasia' + iSeqRow, iSeqRow, event);}, 300) })
                                              .bind('focus', function() { sc_form_empresas_rsvp_empresa_fantasia_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_razsoc' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_razsoc_onblur('#id_sc_field_empresa_razsoc' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_empresas_rsvp_empresa_razsoc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_inscestad' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_inscestad_onblur('#id_sc_field_empresa_inscestad' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_empresas_rsvp_empresa_inscestad_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_municipio' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_municipio_onblur('#id_sc_field_empresa_municipio' + iSeqRow, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_empresas_rsvp_empresa_municipio_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_uf' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_uf_onblur('#id_sc_field_empresa_uf' + iSeqRow, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_empresas_rsvp_empresa_uf_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_pais' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_pais_onblur('#id_sc_field_empresa_pais' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_empresas_rsvp_empresa_pais_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_logradouro' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_logradouro_onblur('#id_sc_field_empresa_logradouro' + iSeqRow, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_empresas_rsvp_empresa_logradouro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_numero' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_numero_onblur('#id_sc_field_empresa_numero' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_empresas_rsvp_empresa_numero_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_empresas_rsvp_empresa_numero_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_complem' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_complem_onblur('#id_sc_field_empresa_complem' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_empresas_rsvp_empresa_complem_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_cep' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_cep_onblur('#id_sc_field_empresa_cep' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_empresas_rsvp_empresa_cep_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_empresas_rsvp_empresa_cep_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_bairro' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_bairro_onblur('#id_sc_field_empresa_bairro' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_empresas_rsvp_empresa_bairro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_email' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_email_onblur('#id_sc_field_empresa_email' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_empresas_rsvp_empresa_email_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_telefone' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_telefone_onblur('#id_sc_field_empresa_telefone' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_empresas_rsvp_empresa_telefone_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_fax' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_fax_onblur('#id_sc_field_empresa_fax' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_empresas_rsvp_empresa_fax_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_celular' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_celular_onblur('#id_sc_field_empresa_celular' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_empresas_rsvp_empresa_celular_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_facebook' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_facebook_onblur('#id_sc_field_empresa_facebook' + iSeqRow, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_empresas_rsvp_empresa_facebook_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_google' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_google_onblur('#id_sc_field_empresa_google' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_empresas_rsvp_empresa_google_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_twitter' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_twitter_onblur('#id_sc_field_empresa_twitter' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_empresas_rsvp_empresa_twitter_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_skype' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_skype_onblur('#id_sc_field_empresa_skype' + iSeqRow, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_empresas_rsvp_empresa_skype_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_website' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_website_onblur('#id_sc_field_empresa_website' + iSeqRow, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_empresas_rsvp_empresa_website_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_status' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_status_onblur('#id_sc_field_empresa_status' + iSeqRow, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_empresas_rsvp_empresa_status_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_empresa_logo' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_empresa_logo_onblur('#id_sc_field_empresa_logo' + iSeqRow, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_empresas_rsvp_empresa_logo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_localizacao' + iSeqRow).bind('blur', function() { sc_form_empresas_rsvp_localizacao_onblur('#id_sc_field_localizacao' + iSeqRow, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_empresas_rsvp_localizacao_onfocus(this, iSeqRow, event) });
  $('.sc-ui-radio-empresa_status' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_empresas_rsvp_empresa_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_id();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_cnpj_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_cnpj();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_cnpj_onchange(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_event_empresa_cnpj_onchange();
}

function sc_form_empresas_rsvp_empresa_cnpj_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_fantasia_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_fantasia();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_fantasia_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_razsoc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_razsoc();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_razsoc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_inscestad_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_inscestad();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_inscestad_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_municipio_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_municipio();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_municipio_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_uf_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_uf();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_uf_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_pais_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_pais();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_pais_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_logradouro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_logradouro();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_logradouro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_numero_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_numero();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_numero_onchange(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_event_empresa_numero_onchange();
}

function sc_form_empresas_rsvp_empresa_numero_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_complem_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_complem();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_complem_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_cep_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_cep();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_cep_onchange(oThis, iSeqRow, event) {
  cep_empresa_cep(oThis.value, 'F1;CEP,empresa_cep;UF,empresa_uf;CIDADE,empresa_municipio;BAIRRO,empresa_bairro;RUA,empresa_logradouro');
}

function sc_form_empresas_rsvp_empresa_cep_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_bairro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_bairro();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_bairro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_email_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_email();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_email_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_telefone_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_telefone();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_telefone_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_fax_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_fax();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_fax_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_celular_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_celular();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_celular_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_facebook_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_facebook();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_facebook_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_google_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_google();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_google_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_twitter_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_twitter();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_twitter_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_skype_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_skype();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_skype_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_website_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_website();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_website_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_status_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_empresa_status();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_status_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_empresa_logo_onblur(oThis, iSeqRow, event) {
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_empresa_logo_onfocus(oThis, iSeqRow, event) {
  scCssFocus(oThis);
}

function sc_form_empresas_rsvp_localizacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_empresas_rsvp_mob_validate_localizacao();
  scCssBlur(oThis);
}

function sc_form_empresas_rsvp_localizacao_onfocus(oThis, iSeqRow, event) {
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
        displayChange_field("empresa_id", "", status);
        displayChange_field("empresa_cnpj", "", status);
        displayChange_field("empresa_fantasia", "", status);
        displayChange_field("empresa_razsoc", "", status);
        displayChange_field("empresa_inscestad", "", status);
        displayChange_field("empresa_facebook", "", status);
        displayChange_field("empresa_google", "", status);
        displayChange_field("empresa_twitter", "", status);
        displayChange_field("empresa_skype", "", status);
        displayChange_field("empresa_website", "", status);
        displayChange_field("empresa_status", "", status);
        displayChange_field("empresa_logo", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("empresa_cep", "", status);
        displayChange_field("empresa_pais", "", status);
        displayChange_field("empresa_uf", "", status);
        displayChange_field("empresa_municipio", "", status);
        displayChange_field("empresa_bairro", "", status);
        displayChange_field("empresa_logradouro", "", status);
        displayChange_field("empresa_numero", "", status);
        displayChange_field("empresa_complem", "", status);
        displayChange_field("localizacao", "", status);
}

function displayChange_block_2(status) {
        displayChange_field("empresa_email", "", status);
        displayChange_field("empresa_telefone", "", status);
        displayChange_field("empresa_fax", "", status);
        displayChange_field("empresa_celular", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_empresa_id(row, status);
        displayChange_field_empresa_cnpj(row, status);
        displayChange_field_empresa_fantasia(row, status);
        displayChange_field_empresa_razsoc(row, status);
        displayChange_field_empresa_inscestad(row, status);
        displayChange_field_empresa_facebook(row, status);
        displayChange_field_empresa_google(row, status);
        displayChange_field_empresa_twitter(row, status);
        displayChange_field_empresa_skype(row, status);
        displayChange_field_empresa_website(row, status);
        displayChange_field_empresa_status(row, status);
        displayChange_field_empresa_logo(row, status);
        displayChange_field_empresa_cep(row, status);
        displayChange_field_empresa_pais(row, status);
        displayChange_field_empresa_uf(row, status);
        displayChange_field_empresa_municipio(row, status);
        displayChange_field_empresa_bairro(row, status);
        displayChange_field_empresa_logradouro(row, status);
        displayChange_field_empresa_numero(row, status);
        displayChange_field_empresa_complem(row, status);
        displayChange_field_localizacao(row, status);
        displayChange_field_empresa_email(row, status);
        displayChange_field_empresa_telefone(row, status);
        displayChange_field_empresa_fax(row, status);
        displayChange_field_empresa_celular(row, status);
}

function displayChange_field(field, row, status) {
        if ("empresa_id" == field) {
                displayChange_field_empresa_id(row, status);
        }
        if ("empresa_cnpj" == field) {
                displayChange_field_empresa_cnpj(row, status);
        }
        if ("empresa_fantasia" == field) {
                displayChange_field_empresa_fantasia(row, status);
        }
        if ("empresa_razsoc" == field) {
                displayChange_field_empresa_razsoc(row, status);
        }
        if ("empresa_inscestad" == field) {
                displayChange_field_empresa_inscestad(row, status);
        }
        if ("empresa_facebook" == field) {
                displayChange_field_empresa_facebook(row, status);
        }
        if ("empresa_google" == field) {
                displayChange_field_empresa_google(row, status);
        }
        if ("empresa_twitter" == field) {
                displayChange_field_empresa_twitter(row, status);
        }
        if ("empresa_skype" == field) {
                displayChange_field_empresa_skype(row, status);
        }
        if ("empresa_website" == field) {
                displayChange_field_empresa_website(row, status);
        }
        if ("empresa_status" == field) {
                displayChange_field_empresa_status(row, status);
        }
        if ("empresa_logo" == field) {
                displayChange_field_empresa_logo(row, status);
        }
        if ("empresa_cep" == field) {
                displayChange_field_empresa_cep(row, status);
        }
        if ("empresa_pais" == field) {
                displayChange_field_empresa_pais(row, status);
        }
        if ("empresa_uf" == field) {
                displayChange_field_empresa_uf(row, status);
        }
        if ("empresa_municipio" == field) {
                displayChange_field_empresa_municipio(row, status);
        }
        if ("empresa_bairro" == field) {
                displayChange_field_empresa_bairro(row, status);
        }
        if ("empresa_logradouro" == field) {
                displayChange_field_empresa_logradouro(row, status);
        }
        if ("empresa_numero" == field) {
                displayChange_field_empresa_numero(row, status);
        }
        if ("empresa_complem" == field) {
                displayChange_field_empresa_complem(row, status);
        }
        if ("localizacao" == field) {
                displayChange_field_localizacao(row, status);
        }
        if ("empresa_email" == field) {
                displayChange_field_empresa_email(row, status);
        }
        if ("empresa_telefone" == field) {
                displayChange_field_empresa_telefone(row, status);
        }
        if ("empresa_fax" == field) {
                displayChange_field_empresa_fax(row, status);
        }
        if ("empresa_celular" == field) {
                displayChange_field_empresa_celular(row, status);
        }
}

function displayChange_field_empresa_id(row, status) {
    var fieldId;
}

function displayChange_field_empresa_cnpj(row, status) {
    var fieldId;
}

function displayChange_field_empresa_fantasia(row, status) {
    var fieldId;
}

function displayChange_field_empresa_razsoc(row, status) {
    var fieldId;
}

function displayChange_field_empresa_inscestad(row, status) {
    var fieldId;
}

function displayChange_field_empresa_facebook(row, status) {
    var fieldId;
}

function displayChange_field_empresa_google(row, status) {
    var fieldId;
}

function displayChange_field_empresa_twitter(row, status) {
    var fieldId;
}

function displayChange_field_empresa_skype(row, status) {
    var fieldId;
}

function displayChange_field_empresa_website(row, status) {
    var fieldId;
}

function displayChange_field_empresa_status(row, status) {
    var fieldId;
}

function displayChange_field_empresa_logo(row, status) {
    var fieldId;
}

function displayChange_field_empresa_cep(row, status) {
    var fieldId;
}

function displayChange_field_empresa_pais(row, status) {
    var fieldId;
}

function displayChange_field_empresa_uf(row, status) {
    var fieldId;
}

function displayChange_field_empresa_municipio(row, status) {
    var fieldId;
}

function displayChange_field_empresa_bairro(row, status) {
    var fieldId;
}

function displayChange_field_empresa_logradouro(row, status) {
    var fieldId;
}

function displayChange_field_empresa_numero(row, status) {
    var fieldId;
}

function displayChange_field_empresa_complem(row, status) {
    var fieldId;
}

function displayChange_field_localizacao(row, status) {
    var fieldId;
}

function displayChange_field_empresa_email(row, status) {
    var fieldId;
}

function displayChange_field_empresa_telefone(row, status) {
    var fieldId;
}

function displayChange_field_empresa_fax(row, status) {
    var fieldId;
}

function displayChange_field_empresa_celular(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_empresas_rsvp_mob_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(33);
                }
        }
}
function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_empresa_logo" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_empresas_rsvp_mob_ul_save.php",
    dropZone: "",
    formData: function() {
      return [
        {name: 'param_field', value: 'empresa_logo'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_empresa_logo" + iSeqRow);
        loaderContent = $("#id_img_loader_empresa_logo" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_empresa_logo" + iSeqRow);
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
        $("#id_img_loader_empresa_logo" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_empresa_logo" + iSeqRow).hide();
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
      $("#id_sc_field_empresa_logo" + iSeqRow).val("");
      $("#id_sc_field_empresa_logo_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_empresa_logo_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_empresa_logo = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_image_source;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_empresa_logo) ? "none" : "";
      $("#id_ajax_img_empresa_logo" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_empresa_logo" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_empresa_logo) {
        document.F1.temp_out_empresa_logo.value = var_ajax_img_thumb;
        document.F1.temp_out1_empresa_logo.value = var_ajax_img_empresa_logo;
      }
      else if (document.F1.temp_out_empresa_logo) {
        document.F1.temp_out_empresa_logo.value = var_ajax_img_empresa_logo;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_empresa_logo" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_empresa_logo" + iSeqRow).html(fileData[0].name);
      $("#txt_ajax_img_empresa_logo" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_empresa_logo" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_empresas_rsvp_mob')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_empresas_rsvp_mob');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_empresas_rsvp_mob');
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

