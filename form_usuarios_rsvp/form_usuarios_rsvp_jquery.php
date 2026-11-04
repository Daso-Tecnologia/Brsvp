
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
  scEventControl_data["usuario_id" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_cpf" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_lembrete" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_email" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_senha" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_pwd" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_nome" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_status" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_colaborador" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_nivel" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_foto" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["qrcode" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["cpf_del" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["sql_log" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["usuario_id" + iSeqRow] && scEventControl_data["usuario_id" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_id" + iSeqRow] && scEventControl_data["usuario_id" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_cpf" + iSeqRow] && scEventControl_data["usuario_cpf" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_cpf" + iSeqRow] && scEventControl_data["usuario_cpf" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_lembrete" + iSeqRow] && scEventControl_data["usuario_lembrete" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_lembrete" + iSeqRow] && scEventControl_data["usuario_lembrete" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_email" + iSeqRow] && scEventControl_data["usuario_email" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_email" + iSeqRow] && scEventControl_data["usuario_email" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_senha" + iSeqRow] && scEventControl_data["usuario_senha" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_senha" + iSeqRow] && scEventControl_data["usuario_senha" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_pwd" + iSeqRow] && scEventControl_data["usuario_pwd" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_pwd" + iSeqRow] && scEventControl_data["usuario_pwd" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_nome" + iSeqRow] && scEventControl_data["usuario_nome" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_nome" + iSeqRow] && scEventControl_data["usuario_nome" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_status" + iSeqRow] && scEventControl_data["usuario_status" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_status" + iSeqRow] && scEventControl_data["usuario_status" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_colaborador" + iSeqRow] && scEventControl_data["usuario_colaborador" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_colaborador" + iSeqRow] && scEventControl_data["usuario_colaborador" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_nivel" + iSeqRow] && scEventControl_data["usuario_nivel" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_nivel" + iSeqRow] && scEventControl_data["usuario_nivel" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["qrcode" + iSeqRow] && scEventControl_data["qrcode" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["qrcode" + iSeqRow] && scEventControl_data["qrcode" + iSeqRow]["change"]) {
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
  if ("usuario_pwd" + iSeq == fieldName) {
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
  $('#id_sc_field_usuario_id' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_usuario_id_onblur('#id_sc_field_usuario_id' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_usuarios_rsvp_usuario_id_onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_usuarios_rsvp_usuario_id_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_cpf' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_usuarios_rsvp_usuario_cpf_onblur('#id_sc_field_usuario_cpf' + iSeqRow, iSeqRow, event);}, 300) })
                                         .bind('change', function() { sc_form_usuarios_rsvp_usuario_cpf_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_usuarios_rsvp_usuario_cpf_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_lembrete' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_usuario_lembrete_onblur('#id_sc_field_usuario_lembrete' + iSeqRow, iSeqRow, event) })
                                              .bind('change', function() { sc_form_usuarios_rsvp_usuario_lembrete_onchange(this, iSeqRow, event) })
                                              .bind('focus', function() { sc_form_usuarios_rsvp_usuario_lembrete_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_email' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_usuario_email_onblur('#id_sc_field_usuario_email' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_usuarios_rsvp_usuario_email_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_usuarios_rsvp_usuario_email_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_senha' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_usuarios_rsvp_usuario_senha_onblur('#id_sc_field_usuario_senha' + iSeqRow, iSeqRow, event);}, 300) })
                                           .bind('change', function() { sc_form_usuarios_rsvp_usuario_senha_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_usuarios_rsvp_usuario_senha_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_nome' + iSeqRow).bind('blur', function() { setTimeout(function() {sc_form_usuarios_rsvp_usuario_nome_onblur('#id_sc_field_usuario_nome' + iSeqRow, iSeqRow, event);}, 300) })
                                          .bind('change', function() { sc_form_usuarios_rsvp_usuario_nome_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_usuarios_rsvp_usuario_nome_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_status' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_usuario_status_onblur('#id_sc_field_usuario_status' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_usuarios_rsvp_usuario_status_onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_usuarios_rsvp_usuario_status_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_pwd' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_usuario_pwd_onblur('#id_sc_field_usuario_pwd' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_usuarios_rsvp_usuario_pwd_onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_usuarios_rsvp_usuario_pwd_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_foto' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_usuario_foto_onblur('#id_sc_field_usuario_foto' + iSeqRow, iSeqRow, event) })
                                          .bind('change', function() { sc_form_usuarios_rsvp_usuario_foto_onchange(this, iSeqRow, event) })
                                          .bind('focus', function() { sc_form_usuarios_rsvp_usuario_foto_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_nivel' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_usuario_nivel_onblur('#id_sc_field_usuario_nivel' + iSeqRow, iSeqRow, event) })
                                           .bind('change', function() { sc_form_usuarios_rsvp_usuario_nivel_onchange(this, iSeqRow, event) })
                                           .bind('focus', function() { sc_form_usuarios_rsvp_usuario_nivel_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_colaborador' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_usuario_colaborador_onblur('#id_sc_field_usuario_colaborador' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_usuarios_rsvp_usuario_colaborador_onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_usuarios_rsvp_usuario_colaborador_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_googlecode' + iSeqRow).bind('change', function() { sc_form_usuarios_rsvp_googlecode_onchange(this, iSeqRow, event) });
  $('#id_sc_field_rodape' + iSeqRow).bind('change', function() { sc_form_usuarios_rsvp_rodape_onchange(this, iSeqRow, event) });
  $('#id_sc_field_qrcode' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_qrcode_onblur('#id_sc_field_qrcode' + iSeqRow, iSeqRow, event) })
                                    .bind('change', function() { sc_form_usuarios_rsvp_qrcode_onchange(this, iSeqRow, event) })
                                    .bind('focus', function() { sc_form_usuarios_rsvp_qrcode_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_cpf_del' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_cpf_del_onblur('#id_sc_field_cpf_del' + iSeqRow, iSeqRow, event) })
                                     .bind('change', function() { sc_form_usuarios_rsvp_cpf_del_onchange(this, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_usuarios_rsvp_cpf_del_onfocus(this, iSeqRow, event) });
  $('#id_sc_field_sql_log' + iSeqRow).bind('blur', function() { sc_form_usuarios_rsvp_sql_log_onblur('#id_sc_field_sql_log' + iSeqRow, iSeqRow, event) })
                                     .bind('change', function() { sc_form_usuarios_rsvp_sql_log_onchange(this, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_usuarios_rsvp_sql_log_onfocus(this, iSeqRow, event) });
  $('.sc-ui-radio-usuario_status' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-usuario_colaborador' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
  $('.sc-ui-radio-usuario_nivel' + iSeqRow).on('click', function() { scMarkFormAsChanged(); });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_usuarios_rsvp_usuario_id_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_id();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_id_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_id_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_cpf_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_cpf();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_cpf_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_cpf_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_lembrete_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_lembrete();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_lembrete_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_lembrete_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_email_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_email();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_email_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_email_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_senha_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_senha();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_senha_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_senha_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_nome_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_nome();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_nome_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_nome_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_status_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_status();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_status_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_status_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_pwd_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_pwd();
  scCssBlur(oThis);
  do_ajax_form_usuarios_rsvp_event_usuario_pwd_onblur();
}

function sc_form_usuarios_rsvp_usuario_pwd_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_usuarios_rsvp_event_usuario_pwd_onchange();
}

function sc_form_usuarios_rsvp_usuario_pwd_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_foto_onblur(oThis, iSeqRow, event) {
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_foto_onchange(oThis, iSeqRow, event) {
  File_Event = event.target;
  File_Arr   = File_Event.files;
  if (File_Arr.length > 0) {
      File_Name = File_Arr[0].name;
      if (File_Name.indexOf('*') != -1) {
          scJs_alert (File_Name + ' <?php echo $this->Ini->Nm_lang['lang_errm_ivch'] ?>', function() {}, {type: "error"});
          document.getElementById('id_sc_field_usuario_foto' + iSeqRow).value = '';
          Upload_Cancel = true;
          return;
      }
  }
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_foto_onfocus(oThis, iSeqRow, event) {
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_nivel_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_nivel();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_nivel_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_nivel_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_usuario_colaborador_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_usuario_colaborador();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_usuario_colaborador_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_usuario_colaborador_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_googlecode_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_rodape_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_qrcode_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_qrcode();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_qrcode_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_qrcode_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_cpf_del_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_cpf_del();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_cpf_del_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_cpf_del_onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis);
}

function sc_form_usuarios_rsvp_sql_log_onblur(oThis, iSeqRow, event) {
  do_ajax_form_usuarios_rsvp_validate_sql_log();
  scCssBlur(oThis);
}

function sc_form_usuarios_rsvp_sql_log_onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_usuarios_rsvp_sql_log_onfocus(oThis, iSeqRow, event) {
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
        displayChange_field("usuario_id", "", status);
        displayChange_field("usuario_cpf", "", status);
        displayChange_field("usuario_lembrete", "", status);
        displayChange_field("usuario_email", "", status);
        displayChange_field("usuario_senha", "", status);
        displayChange_field("usuario_pwd", "", status);
        displayChange_field("usuario_nome", "", status);
        displayChange_field("usuario_status", "", status);
        displayChange_field("usuario_colaborador", "", status);
        displayChange_field("usuario_nivel", "", status);
        displayChange_field("usuario_foto", "", status);
}

function displayChange_block_1(status) {
        displayChange_field("qrcode", "", status);
        displayChange_field("cpf_del", "", status);
        displayChange_field("sql_log", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_usuario_id(row, status);
        displayChange_field_usuario_cpf(row, status);
        displayChange_field_usuario_lembrete(row, status);
        displayChange_field_usuario_email(row, status);
        displayChange_field_usuario_senha(row, status);
        displayChange_field_usuario_pwd(row, status);
        displayChange_field_usuario_nome(row, status);
        displayChange_field_usuario_status(row, status);
        displayChange_field_usuario_colaborador(row, status);
        displayChange_field_usuario_nivel(row, status);
        displayChange_field_usuario_foto(row, status);
        displayChange_field_qrcode(row, status);
        displayChange_field_cpf_del(row, status);
        displayChange_field_sql_log(row, status);
}

function displayChange_field(field, row, status) {
        if ("usuario_id" == field) {
                displayChange_field_usuario_id(row, status);
        }
        if ("usuario_cpf" == field) {
                displayChange_field_usuario_cpf(row, status);
        }
        if ("usuario_lembrete" == field) {
                displayChange_field_usuario_lembrete(row, status);
        }
        if ("usuario_email" == field) {
                displayChange_field_usuario_email(row, status);
        }
        if ("usuario_senha" == field) {
                displayChange_field_usuario_senha(row, status);
        }
        if ("usuario_pwd" == field) {
                displayChange_field_usuario_pwd(row, status);
        }
        if ("usuario_nome" == field) {
                displayChange_field_usuario_nome(row, status);
        }
        if ("usuario_status" == field) {
                displayChange_field_usuario_status(row, status);
        }
        if ("usuario_colaborador" == field) {
                displayChange_field_usuario_colaborador(row, status);
        }
        if ("usuario_nivel" == field) {
                displayChange_field_usuario_nivel(row, status);
        }
        if ("usuario_foto" == field) {
                displayChange_field_usuario_foto(row, status);
        }
        if ("qrcode" == field) {
                displayChange_field_qrcode(row, status);
        }
        if ("cpf_del" == field) {
                displayChange_field_cpf_del(row, status);
        }
        if ("sql_log" == field) {
                displayChange_field_sql_log(row, status);
        }
}

function displayChange_field_usuario_id(row, status) {
    var fieldId;
}

function displayChange_field_usuario_cpf(row, status) {
    var fieldId;
}

function displayChange_field_usuario_lembrete(row, status) {
    var fieldId;
}

function displayChange_field_usuario_email(row, status) {
    var fieldId;
}

function displayChange_field_usuario_senha(row, status) {
    var fieldId;
}

function displayChange_field_usuario_pwd(row, status) {
    var fieldId;
}

function displayChange_field_usuario_nome(row, status) {
    var fieldId;
}

function displayChange_field_usuario_status(row, status) {
    var fieldId;
}

function displayChange_field_usuario_colaborador(row, status) {
    var fieldId;
}

function displayChange_field_usuario_nivel(row, status) {
    var fieldId;
}

function displayChange_field_usuario_foto(row, status) {
    var fieldId;
}

function displayChange_field_qrcode(row, status) {
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
        $("#id_form_usuarios_rsvp_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(29);
                }
        }
}
function scJQUploadAdd(iSeqRow) {
  $("#id_sc_field_usuario_foto" + iSeqRow).fileupload({
    datatype: "json",
    url: "form_usuarios_rsvp_ul_save.php",
    dropZone: $("#hidden_field_data_usuario_foto" + iSeqRow),
    formData: function() {
      return [
        {name: 'param_field', value: 'usuario_foto'},
        {name: 'param_seq', value: '<?php echo $this->Ini->sc_page; ?>'},
        {name: 'upload_file_row', value: iSeqRow}
      ];
    },
    progress: function(e, data) {
      var loader, progress;
      if (data.lengthComputable && window.FormData !== undefined) {
        loader = $("#id_img_loader_usuario_foto" + iSeqRow);
        loaderContent = $("#id_img_loader_usuario_foto" + iSeqRow + " .scProgressBarLoading");
        loaderContent.html("&nbsp;");
        progress = parseInt(data.loaded / data.total * 100, 10);
        loader.show().find("div").css("width", progress + "%");
      }
      else {
        loader = $("#id_ajax_loader_usuario_foto" + iSeqRow);
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
        $("#id_img_loader_usuario_foto" + iSeqRow).hide();
      }
      else
      {
        $("#id_ajax_loader_usuario_foto" + iSeqRow).hide();
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
      $("#id_sc_field_usuario_foto" + iSeqRow).val("");
      $("#id_sc_field_usuario_foto_ul_name" + iSeqRow).val(fileData[0].sc_ul_name);
      $("#id_sc_field_usuario_foto_ul_type" + iSeqRow).val(fileData[0].type);
      var_ajax_img_usuario_foto = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_image_source;
      var_ajax_img_thumb = '<?php echo $this->Ini->path_imag_temp; ?>/' + fileData[0].sc_thumb_prot;
      thumbDisplay = ("" == var_ajax_img_usuario_foto) ? "none" : "";
      $("#id_ajax_img_usuario_foto" + iSeqRow).attr("src", var_ajax_img_thumb);
      $("#id_ajax_img_usuario_foto" + iSeqRow).css("display", thumbDisplay);
      if (document.F1.temp_out1_usuario_foto) {
        document.F1.temp_out_usuario_foto.value = var_ajax_img_thumb;
        document.F1.temp_out1_usuario_foto.value = var_ajax_img_usuario_foto;
      }
      else if (document.F1.temp_out_usuario_foto) {
        document.F1.temp_out_usuario_foto.value = var_ajax_img_usuario_foto;
      }
      checkDisplay = ("" == fileData[0].sc_random_prot.substr(12)) ? "none" : "";
      $("#chk_ajax_img_usuario_foto" + iSeqRow).css("display", checkDisplay);
      $("#txt_ajax_img_usuario_foto" + iSeqRow).html(fileData[0].name);
      $("#txt_ajax_img_usuario_foto" + iSeqRow).css("display", checkDisplay);
      $("#id_ajax_link_usuario_foto" + iSeqRow).html(fileData[0].sc_random_prot.substr(12));
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_usuarios_rsvp')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_usuarios_rsvp');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_usuarios_rsvp');
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

