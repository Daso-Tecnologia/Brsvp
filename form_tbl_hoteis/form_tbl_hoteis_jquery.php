
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
     if (sField == 'hotel_pais') {
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
  scEventControl_data["hotel_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_cnpj" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_fantasia" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_razsoc" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_descricao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_rede" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_classificacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_categoria" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_logo" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_cep" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_pais" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_uf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_municipio" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_bairro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_logradouro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_numero" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_complemento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["localizacao" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_observacoes" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_website" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_telefone" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_fax" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_celular" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_status" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_facebook" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_twitter" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_skype" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_ar_condicionado" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_frigobar" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_lavanderia" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_telefone_quarto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_tv" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_ginastica" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_restaurante" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_bar" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_estacionamento" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_sauna" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_piscina" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_wifi" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_computador" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_convencoes" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["hotel_cod_estrangeiro" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["hotel_id" + iSeqRow] && scEventControl_data["hotel_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_id" + iSeqRow] && scEventControl_data["hotel_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_cnpj" + iSeqRow] && scEventControl_data["hotel_cnpj" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_cnpj" + iSeqRow] && scEventControl_data["hotel_cnpj" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_fantasia" + iSeqRow] && scEventControl_data["hotel_fantasia" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_fantasia" + iSeqRow] && scEventControl_data["hotel_fantasia" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_razsoc" + iSeqRow] && scEventControl_data["hotel_razsoc" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_razsoc" + iSeqRow] && scEventControl_data["hotel_razsoc" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_descricao" + iSeqRow] && scEventControl_data["hotel_descricao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_descricao" + iSeqRow] && scEventControl_data["hotel_descricao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_rede" + iSeqRow] && scEventControl_data["hotel_rede" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_rede" + iSeqRow] && scEventControl_data["hotel_rede" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_classificacao" + iSeqRow] && scEventControl_data["hotel_classificacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_classificacao" + iSeqRow] && scEventControl_data["hotel_classificacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_categoria" + iSeqRow] && scEventControl_data["hotel_categoria" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_categoria" + iSeqRow] && scEventControl_data["hotel_categoria" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_cep" + iSeqRow] && scEventControl_data["hotel_cep" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_cep" + iSeqRow] && scEventControl_data["hotel_cep" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_pais" + iSeqRow] && scEventControl_data["hotel_pais" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_pais" + iSeqRow] && scEventControl_data["hotel_pais" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_uf" + iSeqRow] && scEventControl_data["hotel_uf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_uf" + iSeqRow] && scEventControl_data["hotel_uf" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_municipio" + iSeqRow] && scEventControl_data["hotel_municipio" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_municipio" + iSeqRow] && scEventControl_data["hotel_municipio" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_bairro" + iSeqRow] && scEventControl_data["hotel_bairro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_bairro" + iSeqRow] && scEventControl_data["hotel_bairro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_logradouro" + iSeqRow] && scEventControl_data["hotel_logradouro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_logradouro" + iSeqRow] && scEventControl_data["hotel_logradouro" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_numero" + iSeqRow] && scEventControl_data["hotel_numero" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_numero" + iSeqRow] && scEventControl_data["hotel_numero" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_complemento" + iSeqRow] && scEventControl_data["hotel_complemento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_complemento" + iSeqRow] && scEventControl_data["hotel_complemento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["localizacao" + iSeqRow] && scEventControl_data["localizacao" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["localizacao" + iSeqRow] && scEventControl_data["localizacao" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_observacoes" + iSeqRow] && scEventControl_data["hotel_observacoes" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_observacoes" + iSeqRow] && scEventControl_data["hotel_observacoes" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_email" + iSeqRow] && scEventControl_data["hotel_email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_email" + iSeqRow] && scEventControl_data["hotel_email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_website" + iSeqRow] && scEventControl_data["hotel_website" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_website" + iSeqRow] && scEventControl_data["hotel_website" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_telefone" + iSeqRow] && scEventControl_data["hotel_telefone" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_telefone" + iSeqRow] && scEventControl_data["hotel_telefone" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_fax" + iSeqRow] && scEventControl_data["hotel_fax" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_fax" + iSeqRow] && scEventControl_data["hotel_fax" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_celular" + iSeqRow] && scEventControl_data["hotel_celular" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_celular" + iSeqRow] && scEventControl_data["hotel_celular" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_status" + iSeqRow] && scEventControl_data["hotel_status" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_status" + iSeqRow] && scEventControl_data["hotel_status" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_facebook" + iSeqRow] && scEventControl_data["hotel_facebook" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_facebook" + iSeqRow] && scEventControl_data["hotel_facebook" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_twitter" + iSeqRow] && scEventControl_data["hotel_twitter" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_twitter" + iSeqRow] && scEventControl_data["hotel_twitter" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_skype" + iSeqRow] && scEventControl_data["hotel_skype" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_skype" + iSeqRow] && scEventControl_data["hotel_skype" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_ar_condicionado" + iSeqRow] && scEventControl_data["hotel_ar_condicionado" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_ar_condicionado" + iSeqRow] && scEventControl_data["hotel_ar_condicionado" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_frigobar" + iSeqRow] && scEventControl_data["hotel_frigobar" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_frigobar" + iSeqRow] && scEventControl_data["hotel_frigobar" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_lavanderia" + iSeqRow] && scEventControl_data["hotel_lavanderia" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_lavanderia" + iSeqRow] && scEventControl_data["hotel_lavanderia" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_telefone_quarto" + iSeqRow] && scEventControl_data["hotel_telefone_quarto" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_telefone_quarto" + iSeqRow] && scEventControl_data["hotel_telefone_quarto" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_tv" + iSeqRow] && scEventControl_data["hotel_tv" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_tv" + iSeqRow] && scEventControl_data["hotel_tv" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_ginastica" + iSeqRow] && scEventControl_data["hotel_ginastica" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_ginastica" + iSeqRow] && scEventControl_data["hotel_ginastica" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_restaurante" + iSeqRow] && scEventControl_data["hotel_restaurante" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_restaurante" + iSeqRow] && scEventControl_data["hotel_restaurante" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_bar" + iSeqRow] && scEventControl_data["hotel_bar" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_bar" + iSeqRow] && scEventControl_data["hotel_bar" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_estacionamento" + iSeqRow] && scEventControl_data["hotel_estacionamento" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_estacionamento" + iSeqRow] && scEventControl_data["hotel_estacionamento" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_sauna" + iSeqRow] && scEventControl_data["hotel_sauna" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_sauna" + iSeqRow] && scEventControl_data["hotel_sauna" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_piscina" + iSeqRow] && scEventControl_data["hotel_piscina" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_piscina" + iSeqRow] && scEventControl_data["hotel_piscina" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_wifi" + iSeqRow] && scEventControl_data["hotel_wifi" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_wifi" + iSeqRow] && scEventControl_data["hotel_wifi" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_computador" + iSeqRow] && scEventControl_data["hotel_computador" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_computador" + iSeqRow] && scEventControl_data["hotel_computador" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_convencoes" + iSeqRow] && scEventControl_data["hotel_convencoes" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_convencoes" + iSeqRow] && scEventControl_data["hotel_convencoes" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["hotel_cod_estrangeiro" + iSeqRow] && scEventControl_data["hotel_cod_estrangeiro" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["hotel_cod_estrangeiro" + iSeqRow] && scEventControl_data["hotel_cod_estrangeiro" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("hotel_rede" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hotel_classificacao" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hotel_categoria" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hotel_pais" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("hotel_cnpj" + iSeq == fieldName) {
    scEventControl_data[fieldName]["change"]   = true;
    scEventControl_data[fieldName]["original"] = $(oField).val();
    scEventControl_data[fieldName]["calculated"] = $(oField).val();
    return;
  }
  if ("hotel_numero" + iSeq == fieldName) {
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
  $('#id_sc_field_hotel_id' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_id_onblur('#id_sc_field_hotel_id' + iSeqRow, iSeqRow, event) })
                                      .bind('change', function() { sc_form_tbl_hoteis_hotel_id_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_tbl_hoteis_hotel_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_cnpj' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_cnpj_onblur('#id_sc_field_hotel_cnpj' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_tbl_hoteis_hotel_cnpj_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_tbl_hoteis_hotel_cnpj_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_fantasia' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_fantasia_onblur('#id_sc_field_hotel_fantasia' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_tbl_hoteis_hotel_fantasia_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_tbl_hoteis_hotel_fantasia_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_razsoc' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_tbl_hoteis_hotel_razsoc_onblur('#id_sc_field_hotel_razsoc' + iSeqRow, iSeqRow, event);}, 300) })
                                          .bind('change', function() { sc_form_tbl_hoteis_hotel_razsoc_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_tbl_hoteis_hotel_razsoc_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_descricao' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_descricao_onblur('#id_sc_field_hotel_descricao' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_tbl_hoteis_hotel_descricao_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_tbl_hoteis_hotel_descricao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_rede' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_tbl_hoteis_hotel_rede_onblur('#id_sc_field_hotel_rede' + iSeqRow, iSeqRow, event);}, 300) })
                                        .bind('change', function() { sc_form_tbl_hoteis_hotel_rede_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_tbl_hoteis_hotel_rede_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_cep' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_cep_onblur('#id_sc_field_hotel_cep' + iSeqRow, iSeqRow, event) })
                                       .bind('change', function() { sc_form_tbl_hoteis_hotel_cep_onchange(this, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_tbl_hoteis_hotel_cep_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_pais' + iSeqRow).bind('select2:close', function() { sc_form_tbl_hoteis_hotel_pais_onblur('#id_sc_field_hotel_pais' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_tbl_hoteis_hotel_pais_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_tbl_hoteis_hotel_pais_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_uf' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_uf_onblur('#id_sc_field_hotel_uf' + iSeqRow, iSeqRow, event) })
                                      .bind('change', function() { sc_form_tbl_hoteis_hotel_uf_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_tbl_hoteis_hotel_uf_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_municipio' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_municipio_onblur('#id_sc_field_hotel_municipio' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_tbl_hoteis_hotel_municipio_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_tbl_hoteis_hotel_municipio_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_bairro' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_bairro_onblur('#id_sc_field_hotel_bairro' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_form_tbl_hoteis_hotel_bairro_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_tbl_hoteis_hotel_bairro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_logradouro' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_logradouro_onblur('#id_sc_field_hotel_logradouro' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_tbl_hoteis_hotel_logradouro_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_tbl_hoteis_hotel_logradouro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_numero' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_numero_onblur('#id_sc_field_hotel_numero' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_form_tbl_hoteis_hotel_numero_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_tbl_hoteis_hotel_numero_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_complemento' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_complemento_onblur('#id_sc_field_hotel_complemento' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_tbl_hoteis_hotel_complemento_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_tbl_hoteis_hotel_complemento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_email' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_email_onblur('#id_sc_field_hotel_email' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_tbl_hoteis_hotel_email_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_tbl_hoteis_hotel_email_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_telefone' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_telefone_onblur('#id_sc_field_hotel_telefone' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_tbl_hoteis_hotel_telefone_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_tbl_hoteis_hotel_telefone_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_fax' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_fax_onblur('#id_sc_field_hotel_fax' + iSeqRow, iSeqRow, event) })
                                       .bind('change', function() { sc_form_tbl_hoteis_hotel_fax_onchange(this, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_tbl_hoteis_hotel_fax_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_celular' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_celular_onblur('#id_sc_field_hotel_celular' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_tbl_hoteis_hotel_celular_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_tbl_hoteis_hotel_celular_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_website' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_website_onblur('#id_sc_field_hotel_website' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_tbl_hoteis_hotel_website_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_tbl_hoteis_hotel_website_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_status' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_status_onblur('#id_sc_field_hotel_status' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_form_tbl_hoteis_hotel_status_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_tbl_hoteis_hotel_status_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_facebook' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_facebook_onblur('#id_sc_field_hotel_facebook' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_tbl_hoteis_hotel_facebook_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_tbl_hoteis_hotel_facebook_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_twitter' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_twitter_onblur('#id_sc_field_hotel_twitter' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_tbl_hoteis_hotel_twitter_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_tbl_hoteis_hotel_twitter_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_skype' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_skype_onblur('#id_sc_field_hotel_skype' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_tbl_hoteis_hotel_skype_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_tbl_hoteis_hotel_skype_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_ar_condicionado' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_ar_condicionado_onblur('#id_sc_field_hotel_ar_condicionado' + iSeqRow, iSeqRow, event) })
                                                   .bind('change', function() { sc_form_tbl_hoteis_hotel_ar_condicionado_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_tbl_hoteis_hotel_ar_condicionado_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_frigobar' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_frigobar_onblur('#id_sc_field_hotel_frigobar' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_tbl_hoteis_hotel_frigobar_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_tbl_hoteis_hotel_frigobar_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_lavanderia' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_lavanderia_onblur('#id_sc_field_hotel_lavanderia' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_tbl_hoteis_hotel_lavanderia_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_tbl_hoteis_hotel_lavanderia_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_telefone_quarto' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_telefone_quarto_onblur('#id_sc_field_hotel_telefone_quarto' + iSeqRow, iSeqRow, event) })
                                                   .bind('change', function() { sc_form_tbl_hoteis_hotel_telefone_quarto_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_tbl_hoteis_hotel_telefone_quarto_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_tv' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_tv_onblur('#id_sc_field_hotel_tv' + iSeqRow, iSeqRow, event) })
                                      .bind('change', function() { sc_form_tbl_hoteis_hotel_tv_onchange(this, iSeqRow, event) })
                                      .bind('focus', function() { sc_form_tbl_hoteis_hotel_tv_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_ginastica' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_ginastica_onblur('#id_sc_field_hotel_ginastica' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_tbl_hoteis_hotel_ginastica_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_tbl_hoteis_hotel_ginastica_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_restaurante' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_restaurante_onblur('#id_sc_field_hotel_restaurante' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_tbl_hoteis_hotel_restaurante_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_tbl_hoteis_hotel_restaurante_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_bar' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_bar_onblur('#id_sc_field_hotel_bar' + iSeqRow, iSeqRow, event) })
                                       .bind('change', function() { sc_form_tbl_hoteis_hotel_bar_onchange(this, iSeqRow, event) })
                                       .bind('focus', function() { sc_form_tbl_hoteis_hotel_bar_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_estacionamento' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_estacionamento_onblur('#id_sc_field_hotel_estacionamento' + iSeqRow, iSeqRow, event) })
                                                  .bind('change', function() { sc_form_tbl_hoteis_hotel_estacionamento_onchange(this, iSeqRow, event) })
                                                  .bind('focus', function() { sc_form_tbl_hoteis_hotel_estacionamento_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_sauna' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_sauna_onblur('#id_sc_field_hotel_sauna' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_tbl_hoteis_hotel_sauna_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_tbl_hoteis_hotel_sauna_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_piscina' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_piscina_onblur('#id_sc_field_hotel_piscina' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_tbl_hoteis_hotel_piscina_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_tbl_hoteis_hotel_piscina_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_wifi' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_wifi_onblur('#id_sc_field_hotel_wifi' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_tbl_hoteis_hotel_wifi_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_tbl_hoteis_hotel_wifi_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_computador' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_computador_onblur('#id_sc_field_hotel_computador' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_tbl_hoteis_hotel_computador_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_tbl_hoteis_hotel_computador_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_convencoes' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_convencoes_onblur('#id_sc_field_hotel_convencoes' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_tbl_hoteis_hotel_convencoes_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_tbl_hoteis_hotel_convencoes_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_observacoes' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_observacoes_onblur('#id_sc_field_hotel_observacoes' + iSeqRow, iSeqRow, event) })
                                               .bind('change', function() { sc_form_tbl_hoteis_hotel_observacoes_onchange(this, iSeqRow, event) })
                                               .bind('focus', function() { sc_form_tbl_hoteis_hotel_observacoes_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_classificacao' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_tbl_hoteis_hotel_classificacao_onblur('#id_sc_field_hotel_classificacao' + iSeqRow, iSeqRow, event);}, 300) })
                                                 .bind('change', function() { sc_form_tbl_hoteis_hotel_classificacao_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_tbl_hoteis_hotel_classificacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_categoria' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_categoria_onblur('#id_sc_field_hotel_categoria' + iSeqRow, iSeqRow, event) })
                                             .bind('change', function() { sc_form_tbl_hoteis_hotel_categoria_onchange(this, iSeqRow, event) })
                                             .bind('focus', function() { sc_form_tbl_hoteis_hotel_categoria_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_logo' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_logo_onblur('#id_sc_field_hotel_logo' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_tbl_hoteis_hotel_logo_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_tbl_hoteis_hotel_logo_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_hotel_cod_estrangeiro' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_hotel_cod_estrangeiro_onblur('#id_sc_field_hotel_cod_estrangeiro' + iSeqRow, iSeqRow, event) })
                                                   .bind('change', function() { sc_form_tbl_hoteis_hotel_cod_estrangeiro_onchange(this, iSeqRow, event) })
                                                   .bind('focus', function() { sc_form_tbl_hoteis_hotel_cod_estrangeiro_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_localizacao' + iSeqRow).bind('blur', function() { sc_form_tbl_hoteis_localizacao_onblur('#id_sc_field_localizacao' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_tbl_hoteis_localizacao_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_tbl_hoteis_localizacao_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_rodape' + iSeqRow).bind('change', function() { sc_form_tbl_hoteis_rodape_onchange(this, iSeqRow, event) });
  $('.sc-ui-radio-hotel_status' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_ar_condicionado' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_frigobar' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_lavanderia' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_telefone_quarto' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_tv' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_ginastica' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_restaurante' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_bar' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_estacionamento' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_sauna' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_piscina' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_wifi' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_computador' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-hotel_convencoes' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_tbl_hoteis_hotel_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_id();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_id_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_cnpj_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_cnpj();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_cnpj_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_tbl_hoteis_event_hotel_cnpj_onchange();
}

function sc_form_tbl_hoteis_hotel_cnpj_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_fantasia_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_fantasia();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_fantasia_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_fantasia_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_razsoc_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_razsoc();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_razsoc_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_razsoc_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_descricao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_descricao();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_descricao_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_descricao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
  do_ajax_form_tbl_hoteis_event_hotel_descricao_onfocus();
}

function sc_form_tbl_hoteis_hotel_rede_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_rede();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_rede_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_rede_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_cep_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_cep();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_cep_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  cep_hotel_cep(oThis.value, 'F1;CEP,hotel_cep;UF,hotel_uf;CIDADE,hotel_municipio;BAIRRO,hotel_bairro;RUA,hotel_logradouro');
}

function sc_form_tbl_hoteis_hotel_cep_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_pais_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_pais();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_pais_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_pais_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_uf_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_uf();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_uf_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_tbl_hoteis_refresh_hotel_uf();
}

function sc_form_tbl_hoteis_hotel_uf_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_municipio_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_municipio();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_municipio_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_municipio_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_bairro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_bairro();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_bairro_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_bairro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_logradouro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_logradouro();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_logradouro_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_logradouro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_numero_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_numero();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_numero_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_tbl_hoteis_event_hotel_numero_onchange();
}

function sc_form_tbl_hoteis_hotel_numero_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_complemento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_complemento();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_complemento_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_complemento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_email_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_email();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_email_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_email_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_telefone_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_telefone();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_telefone_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_telefone_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_fax_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_fax();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_fax_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_fax_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_celular_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_celular();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_celular_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_celular_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_website_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_website();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_website_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_website_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_status_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_status();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_status_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_status_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_facebook_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_facebook();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_facebook_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_facebook_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_twitter_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_twitter();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_twitter_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_twitter_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_skype_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_skype();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_skype_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_skype_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_ar_condicionado_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_ar_condicionado();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_ar_condicionado_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_ar_condicionado_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_frigobar_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_frigobar();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_frigobar_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_frigobar_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_lavanderia_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_lavanderia();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_lavanderia_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_lavanderia_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_telefone_quarto_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_telefone_quarto();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_telefone_quarto_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_telefone_quarto_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_tv_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_tv();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_tv_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_tv_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_ginastica_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_ginastica();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_ginastica_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_ginastica_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_restaurante_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_restaurante();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_restaurante_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_restaurante_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_bar_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_bar();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_bar_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_bar_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_estacionamento_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_estacionamento();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_estacionamento_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_estacionamento_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_sauna_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_sauna();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_sauna_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_sauna_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_piscina_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_piscina();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_piscina_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_piscina_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_wifi_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_wifi();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_wifi_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_wifi_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_computador_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_computador();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_computador_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_computador_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_convencoes_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_convencoes();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_convencoes_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_convencoes_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_observacoes_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_observacoes();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_observacoes_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_observacoes_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_classificacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_classificacao();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_classificacao_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_classificacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_categoria_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_categoria();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_categoria_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_categoria_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_logo_onblur(oThis, iSeqRow, event) {
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_logo_onchange(oThis, iSeqRow, event) {
  File_Event = event.target;
  File_Arr   = File_Event.files;
  if (File_Arr.length > 0) {
      File_Name = File_Arr[0].name;
      if (File_Name.indexOf('*') != -1) {
          scJs_alert (File_Name + ' <?php echo $this->Ini->Nm_lang['lang_errm_ivch'] ?>', function() {}, {type: "error"});
          document.getElementById('id_sc_field_hotel_logo' + iSeqRow).value = '';
          Upload_Cancel = true;
          return;
      }
  }
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_logo_onfocus(oThis, iSeqRow, event) {
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_hotel_cod_estrangeiro_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_hotel_cod_estrangeiro();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_hotel_cod_estrangeiro_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_hotel_cod_estrangeiro_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_localizacao_onblur(oThis, iSeqRow, event) {
  do_ajax_form_tbl_hoteis_validate_localizacao();
  scCssBlur(oThis);
}

function sc_form_tbl_hoteis_localizacao_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_tbl_hoteis_localizacao_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_tbl_hoteis_rodape_onchange(oThis, iSeqRow, event) {
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
}

function displayChange_block_0(status) {
        displayChange_field("hotel_id", "", status);
        displayChange_field("hotel_cnpj", "", status);
        displayChange_field("hotel_fantasia", "", status);
        displayChange_field("hotel_razsoc", "", status);
        displayChange_field("hotel_descricao", "", status);
        displayChange_field("hotel_rede", "", status);
        displayChange_field("hotel_classificacao", "", status);
        displayChange_field("hotel_categoria", "", status);
        displayChange_field("hotel_logo", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("hotel_cep", "", status);
        displayChange_field("hotel_pais", "", status);
        displayChange_field("hotel_uf", "", status);
        displayChange_field("hotel_municipio", "", status);
        displayChange_field("hotel_bairro", "", status);
        displayChange_field("hotel_logradouro", "", status);
        displayChange_field("hotel_numero", "", status);
        displayChange_field("hotel_complemento", "", status);
        displayChange_field("localizacao", "", status);
        displayChange_field("hotel_observacoes", "", status);
}

function displayChange_block_2(status) {
        displayChange_field("hotel_email", "", status);
        displayChange_field("hotel_website", "", status);
        displayChange_field("hotel_telefone", "", status);
        displayChange_field("hotel_fax", "", status);
        displayChange_field("hotel_celular", "", status);
        displayChange_field("hotel_status", "", status);
        displayChange_field("hotel_facebook", "", status);
        displayChange_field("hotel_twitter", "", status);
        displayChange_field("hotel_skype", "", status);
}

function displayChange_block_3(status) {
        displayChange_field("hotel_ar_condicionado", "", status);
        displayChange_field("hotel_frigobar", "", status);
        displayChange_field("hotel_lavanderia", "", status);
        displayChange_field("hotel_telefone_quarto", "", status);
        displayChange_field("hotel_tv", "", status);
        displayChange_field("hotel_ginastica", "", status);
        displayChange_field("hotel_restaurante", "", status);
        displayChange_field("hotel_bar", "", status);
        displayChange_field("hotel_estacionamento", "", status);
        displayChange_field("hotel_sauna", "", status);
        displayChange_field("hotel_piscina", "", status);
        displayChange_field("hotel_wifi", "", status);
        displayChange_field("hotel_computador", "", status);
        displayChange_field("hotel_convencoes", "", status);
}

function displayChange_block_4(status) {
        displayChange_field("hotel_cod_estrangeiro", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_hotel_id(row, status);
        displayChange_field_hotel_cnpj(row, status);
        displayChange_field_hotel_fantasia(row, status);
        displayChange_field_hotel_razsoc(row, status);
        displayChange_field_hotel_descricao(row, status);
        displayChange_field_hotel_rede(row, status);
        displayChange_field_hotel_classificacao(row, status);
        displayChange_field_hotel_categoria(row, status);
        displayChange_field_hotel_logo(row, status);
        displayChange_field_hotel_cep(row, status);
        displayChange_field_hotel_pais(row, status);
        displayChange_field_hotel_uf(row, status);
        displayChange_field_hotel_municipio(row, status);
        displayChange_field_hotel_bairro(row, status);
        displayChange_field_hotel_logradouro(row, status);
        displayChange_field_hotel_numero(row, status);
        displayChange_field_hotel_complemento(row, status);
        displayChange_field_localizacao(row, status);
        displayChange_field_hotel_observacoes(row, status);
        displayChange_field_hotel_email(row, status);
        displayChange_field_hotel_website(row, status);
        displayChange_field_hotel_telefone(row, status);
        displayChange_field_hotel_fax(row, status);
        displayChange_field_hotel_celular(row, status);
        displayChange_field_hotel_status(row, status);
        displayChange_field_hotel_facebook(row, status);
        displayChange_field_hotel_twitter(row, status);
        displayChange_field_hotel_skype(row, status);
        displayChange_field_hotel_ar_condicionado(row, status);
        displayChange_field_hotel_frigobar(row, status);
        displayChange_field_hotel_lavanderia(row, status);
        displayChange_field_hotel_telefone_quarto(row, status);
        displayChange_field_hotel_tv(row, status);
        displayChange_field_hotel_ginastica(row, status);
        displayChange_field_hotel_restaurante(row, status);
        displayChange_field_hotel_bar(row, status);
        displayChange_field_hotel_estacionamento(row, status);
        displayChange_field_hotel_sauna(row, status);
        displayChange_field_hotel_piscina(row, status);
        displayChange_field_hotel_wifi(row, status);
        displayChange_field_hotel_computador(row, status);
        displayChange_field_hotel_convencoes(row, status);
        displayChange_field_hotel_cod_estrangeiro(row, status);
}

function displayChange_field(field, row, status) {
        if ("hotel_id" == field) {
                displayChange_field_hotel_id(row, status);
        }
        if ("hotel_cnpj" == field) {
                displayChange_field_hotel_cnpj(row, status);
        }
        if ("hotel_fantasia" == field) {
                displayChange_field_hotel_fantasia(row, status);
        }
        if ("hotel_razsoc" == field) {
                displayChange_field_hotel_razsoc(row, status);
        }
        if ("hotel_descricao" == field) {
                displayChange_field_hotel_descricao(row, status);
        }
        if ("hotel_rede" == field) {
                displayChange_field_hotel_rede(row, status);
        }
        if ("hotel_classificacao" == field) {
                displayChange_field_hotel_classificacao(row, status);
        }
        if ("hotel_categoria" == field) {
                displayChange_field_hotel_categoria(row, status);
        }
        if ("hotel_logo" == field) {
                displayChange_field_hotel_logo(row, status);
        }
        if ("hotel_cep" == field) {
                displayChange_field_hotel_cep(row, status);
        }
        if ("hotel_pais" == field) {
                displayChange_field_hotel_pais(row, status);
        }
        if ("hotel_uf" == field) {
                displayChange_field_hotel_uf(row, status);
        }
        if ("hotel_municipio" == field) {
                displayChange_field_hotel_municipio(row, status);
        }
        if ("hotel_bairro" == field) {
                displayChange_field_hotel_bairro(row, status);
        }
        if ("hotel_logradouro" == field) {
                displayChange_field_hotel_logradouro(row, status);
        }
        if ("hotel_numero" == field) {
                displayChange_field_hotel_numero(row, status);
        }
        if ("hotel_complemento" == field) {
                displayChange_field_hotel_complemento(row, status);
        }
        if ("localizacao" == field) {
                displayChange_field_localizacao(row, status);
        }
        if ("hotel_observacoes" == field) {
                displayChange_field_hotel_observacoes(row, status);
        }
        if ("hotel_email" == field) {
                displayChange_field_hotel_email(row, status);
        }
        if ("hotel_website" == field) {
                displayChange_field_hotel_website(row, status);
        }
        if ("hotel_telefone" == field) {
                displayChange_field_hotel_telefone(row, status);
        }
        if ("hotel_fax" == field) {
                displayChange_field_hotel_fax(row, status);
        }
        if ("hotel_celular" == field) {
                displayChange_field_hotel_celular(row, status);
        }
        if ("hotel_status" == field) {
                displayChange_field_hotel_status(row, status);
        }
        if ("hotel_facebook" == field) {
                displayChange_field_hotel_facebook(row, status);
        }
        if ("hotel_twitter" == field) {
                displayChange_field_hotel_twitter(row, status);
        }
        if ("hotel_skype" == field) {
                displayChange_field_hotel_skype(row, status);
        }
        if ("hotel_ar_condicionado" == field) {
                displayChange_field_hotel_ar_condicionado(row, status);
        }
        if ("hotel_frigobar" == field) {
                displayChange_field_hotel_frigobar(row, status);
        }
        if ("hotel_lavanderia" == field) {
                displayChange_field_hotel_lavanderia(row, status);
        }
        if ("hotel_telefone_quarto" == field) {
                displayChange_field_hotel_telefone_quarto(row, status);
        }
        if ("hotel_tv" == field) {
                displayChange_field_hotel_tv(row, status);
        }
        if ("hotel_ginastica" == field) {
                displayChange_field_hotel_ginastica(row, status);
        }
        if ("hotel_restaurante" == field) {
                displayChange_field_hotel_restaurante(row, status);
        }
        if ("hotel_bar" == field) {
                displayChange_field_hotel_bar(row, status);
        }
        if ("hotel_estacionamento" == field) {
                displayChange_field_hotel_estacionamento(row, status);
        }
        if ("hotel_sauna" == field) {
                displayChange_field_hotel_sauna(row, status);
        }
        if ("hotel_piscina" == field) {
                displayChange_field_hotel_piscina(row, status);
        }
        if ("hotel_wifi" == field) {
                displayChange_field_hotel_wifi(row, status);
        }
        if ("hotel_computador" == field) {
                displayChange_field_hotel_computador(row, status);
        }
        if ("hotel_convencoes" == field) {
                displayChange_field_hotel_convencoes(row, status);
        }
        if ("hotel_cod_estrangeiro" == field) {
                displayChange_field_hotel_cod_estrangeiro(row, status);
        }
}

function displayChange_field_hotel_id(row, status) {
    var fieldId;
}

function displayChange_field_hotel_cnpj(row, status) {
    var fieldId;
}

function displayChange_field_hotel_fantasia(row, status) {
    var fieldId;
}

function displayChange_field_hotel_razsoc(row, status) {
    var fieldId;
}

function displayChange_field_hotel_descricao(row, status) {
    var fieldId;
}

function displayChange_field_hotel_rede(row, status) {
    var fieldId;
}

function displayChange_field_hotel_classificacao(row, status) {
    var fieldId;
}

function displayChange_field_hotel_categoria(row, status) {
    var fieldId;
}

function displayChange_field_hotel_logo(row, status) {
    var fieldId;
}

function displayChange_field_hotel_cep(row, status) {
    var fieldId;
}

function displayChange_field_hotel_pais(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_hotel_pais__obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_hotel_pais' + row + '-container').hasClass('scFormInputDisabled')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_hotel_pais" + row).select2("destroy");
                }
                scJQSelect2Add(row, "hotel_pais");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_hotel_pais' + row + '-container').addClass('scFormInputDisabled')
                }
        }
}

function displayChange_field_hotel_uf(row, status) {
    var fieldId;
}

function displayChange_field_hotel_municipio(row, status) {
    var fieldId;
}

function displayChange_field_hotel_bairro(row, status) {
    var fieldId;
}

function displayChange_field_hotel_logradouro(row, status) {
    var fieldId;
}

function displayChange_field_hotel_numero(row, status) {
    var fieldId;
}

function displayChange_field_hotel_complemento(row, status) {
    var fieldId;
}

function displayChange_field_localizacao(row, status) {
    var fieldId;
}

function displayChange_field_hotel_observacoes(row, status) {
    var fieldId;
}

function displayChange_field_hotel_email(row, status) {
    var fieldId;
}

function displayChange_field_hotel_website(row, status) {
    var fieldId;
}

function displayChange_field_hotel_telefone(row, status) {
    var fieldId;
}

function displayChange_field_hotel_fax(row, status) {
    var fieldId;
}

function displayChange_field_hotel_celular(row, status) {
    var fieldId;
}

function displayChange_field_hotel_status(row, status) {
    var fieldId;
}

function displayChange_field_hotel_facebook(row, status) {
    var fieldId;
}

function displayChange_field_hotel_twitter(row, status) {
    var fieldId;
}

function displayChange_field_hotel_skype(row, status) {
    var fieldId;
}

function displayChange_field_hotel_ar_condicionado(row, status) {
    var fieldId;
}

function displayChange_field_hotel_frigobar(row, status) {
    var fieldId;
}

function displayChange_field_hotel_lavanderia(row, status) {
    var fieldId;
}

function displayChange_field_hotel_telefone_quarto(row, status) {
    var fieldId;
}

function displayChange_field_hotel_tv(row, status) {
    var fieldId;
}

function displayChange_field_hotel_ginastica(row, status) {
    var fieldId;
}

function displayChange_field_hotel_restaurante(row, status) {
    var fieldId;
}

function displayChange_field_hotel_bar(row, status) {
    var fieldId;
}

function displayChange_field_hotel_estacionamento(row, status) {
    var fieldId;
}

function displayChange_field_hotel_sauna(row, status) {
    var fieldId;
}

function displayChange_field_hotel_piscina(row, status) {
    var fieldId;
}

function displayChange_field_hotel_wifi(row, status) {
    var fieldId;
}

function displayChange_field_hotel_computador(row, status) {
    var fieldId;
}

function displayChange_field_hotel_convencoes(row, status) {
    var fieldId;
}

function displayChange_field_hotel_cod_estrangeiro(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
        displayChange_field_hotel_pais("all", "on");
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_tbl_hoteis_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(26);
                }
        }
}
function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_hotel_logo" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_tbl_hoteis_ul_save.php",
    dropZone: $("#hidden_field_data_hotel_logo" + iSeqRow),
    formData: function() {
      return [
        {name: 'param_field', value: 'hotel_logo'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_hotel_logo" + iSeqRow);
        loaderContent = $("#id_img_loader_hotel_logo" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_hotel_logo" + iSeqRow);
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
        $("#id_img_loader_hotel_logo" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_hotel_logo" + iSeqRow).hide();
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
      $("#id_sc_field_hotel_logo" + iSeqRow).val("");
      $("#id_sc_field_hotel_logo_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_hotel_logo_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_hotel_logo = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_image_source;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_hotel_logo) ? "none" : "";
      $("#id_ajax_img_hotel_logo" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_hotel_logo" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_hotel_logo) {
        document.F1.temp_out_hotel_logo.value = var_ajax_img_thumb;
        document.F1.temp_out1_hotel_logo.value = var_ajax_img_hotel_logo;
      }
      else if (document.F1.temp_out_hotel_logo) {
        document.F1.temp_out_hotel_logo.value = var_ajax_img_hotel_logo;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_hotel_logo" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_hotel_logo" + iSeqRow).html(fileData[0].name);
      $("#txt_ajax_img_hotel_logo" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_hotel_logo" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_tbl_hoteis')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_tbl_hoteis');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_tbl_hoteis');
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
  if (null == specificField || "hotel_pais" == specificField) {
    scJQSelect2Add_hotel_pais(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_hotel_pais(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_hotel_pais_obj" : "#id_sc_field_hotel_pais" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_hotel_pais_obj',
      dropdownCssClass: 'css_hotel_pais_obj',
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
  $('#select2-id_sc_field_hotel_pais' + seqRow + '-container').addClass('css_hotel_pais_obj');
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_hotel_pais) { displayChange_field_hotel_pais(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
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

