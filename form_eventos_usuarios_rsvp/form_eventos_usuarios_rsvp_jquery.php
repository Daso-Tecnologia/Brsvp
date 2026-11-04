
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
     if (sField == 'usuario_id_') {
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
  scEventControl_data["evento_id_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_id_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_nivel_evt_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["usuario_ativo_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["status_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
  scEventControl_data["eventos_usuario_id_" + iSeqRow] = {"blur": false, "change": false, "autocomp": false, "original": "", "calculated": ""};
}

function scEventControl_active(iSeqRow) {
  if (scEventControl_data["evento_id_" + iSeqRow] && scEventControl_data["evento_id_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["evento_id_" + iSeqRow] && scEventControl_data["evento_id_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_id_" + iSeqRow] && scEventControl_data["usuario_id_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_id_" + iSeqRow] && scEventControl_data["usuario_id_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_nivel_evt_" + iSeqRow] && scEventControl_data["usuario_nivel_evt_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_nivel_evt_" + iSeqRow] && scEventControl_data["usuario_nivel_evt_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["usuario_ativo_" + iSeqRow] && scEventControl_data["usuario_ativo_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["usuario_ativo_" + iSeqRow] && scEventControl_data["usuario_ativo_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["status_" + iSeqRow] && scEventControl_data["status_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["status_" + iSeqRow] && scEventControl_data["status_" + iSeqRow]["change"]) {
    return true;
  }
  if (scEventControl_data["eventos_usuario_id_" + iSeqRow] && scEventControl_data["eventos_usuario_id_" + iSeqRow]["blur"]) {
    return true;
  }
  if (scEventControl_data["eventos_usuario_id_" + iSeqRow] && scEventControl_data["eventos_usuario_id_" + iSeqRow]["change"]) {
    return true;
  }
  return false;
} // scEventControl_active

function scEventControl_active_all() {
  for (var i = 1; i < iAjaxNewLine; i++) {
    if (scEventControl_active(i)) {
      return true;
    }
  }
  return false;
} // scEventControl_active

function scEventControl_onFocus(oField, iSeq) {
  var fieldId, fieldName;
  fieldId = $(oField).attr("id");
  fieldName = fieldId.substr(12);
  scEventControl_data[fieldName]["blur"] = true;
  if ("evento_id_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("usuario_id_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("usuario_ativo_" + iSeq == fieldName) {
    scEventControl_data[fieldName]["blur"] = false;
  }
  if ("usuario_id_" + iSeq == fieldName) {
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
  $('#id_sc_field_eventos_usuario_id_' + iSeqRow).bind('blur', function() { sc_form_eventos_usuarios_rsvp_eventos_usuario_id__onblur('#id_sc_field_eventos_usuario_id_' + iSeqRow, iSeqRow, event) })
                                                 .bind('change', function() { sc_form_eventos_usuarios_rsvp_eventos_usuario_id__onchange(this, iSeqRow, event) })
                                                 .bind('focus', function() { sc_form_eventos_usuarios_rsvp_eventos_usuario_id__onfocus(this, iSeqRow, event) });
  $('#id_sc_field_evento_id_' + iSeqRow).bind('blur', function() { sc_form_eventos_usuarios_rsvp_evento_id__onblur('#id_sc_field_evento_id_' + iSeqRow, iSeqRow, event) })
                                        .bind('change', function() { sc_form_eventos_usuarios_rsvp_evento_id__onchange(this, iSeqRow, event) })
                                        .bind('focus', function() { sc_form_eventos_usuarios_rsvp_evento_id__onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_id_' + iSeqRow).bind('select2:close', function() { sc_form_eventos_usuarios_rsvp_usuario_id__onblur('#id_sc_field_usuario_id_' + iSeqRow, iSeqRow, event) })
                                         .bind('change', function() { sc_form_eventos_usuarios_rsvp_usuario_id__onchange(this, iSeqRow, event) })
                                         .bind('focus', function() { sc_form_eventos_usuarios_rsvp_usuario_id__onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_nivel_evt_' + iSeqRow).bind('blur', function() { sc_form_eventos_usuarios_rsvp_usuario_nivel_evt__onblur('#id_sc_field_usuario_nivel_evt_' + iSeqRow, iSeqRow, event) })
                                                .bind('change', function() { sc_form_eventos_usuarios_rsvp_usuario_nivel_evt__onchange(this, iSeqRow, event) })
                                                .bind('focus', function() { sc_form_eventos_usuarios_rsvp_usuario_nivel_evt__onfocus(this, iSeqRow, event) });
  $('#id_sc_field_usuario_ativo_' + iSeqRow).bind('blur', function() { sc_form_eventos_usuarios_rsvp_usuario_ativo__onblur('#id_sc_field_usuario_ativo_' + iSeqRow, iSeqRow, event) })
                                            .bind('change', function() { sc_form_eventos_usuarios_rsvp_usuario_ativo__onchange(this, iSeqRow, event) })
                                            .bind('focus', function() { sc_form_eventos_usuarios_rsvp_usuario_ativo__onfocus(this, iSeqRow, event) });
  $('#id_sc_field_nome_evento_' + iSeqRow).bind('change', function() { sc_form_eventos_usuarios_rsvp_nome_evento__onchange(this, iSeqRow, event) });
  $('#id_sc_field_nome_usuario_' + iSeqRow).bind('change', function() { sc_form_eventos_usuarios_rsvp_nome_usuario__onchange(this, iSeqRow, event) });
  $('#id_sc_field_status_evento_' + iSeqRow).bind('change', function() { sc_form_eventos_usuarios_rsvp_status_evento__onchange(this, iSeqRow, event) });
  $('#id_sc_field_nome_empresa_' + iSeqRow).bind('change', function() { sc_form_eventos_usuarios_rsvp_nome_empresa__onchange(this, iSeqRow, event) });
  $('#id_sc_field_rodape_' + iSeqRow).bind('change', function() { sc_form_eventos_usuarios_rsvp_rodape__onchange(this, iSeqRow, event) });
  $('#id_sc_field_status_' + iSeqRow).bind('blur', function() { sc_form_eventos_usuarios_rsvp_status__onblur('#id_sc_field_status_' + iSeqRow, iSeqRow, event) })
                                     .bind('change', function() { sc_form_eventos_usuarios_rsvp_status__onchange(this, iSeqRow, event) })
                                     .bind('focus', function() { sc_form_eventos_usuarios_rsvp_status__onfocus(this, iSeqRow, event) });
} // scJQEventsAdd

Upload_Cancel = false;
function sc_form_eventos_usuarios_rsvp_eventos_usuario_id__onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_usuarios_rsvp_validate_eventos_usuario_id_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_eventos_usuario_id__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_eventos_usuario_id__onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_evento_id__onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_usuarios_rsvp_validate_evento_id_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_evento_id__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_evento_id__onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_usuario_id__onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_usuarios_rsvp_validate_usuario_id_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_usuario_id__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  do_ajax_form_eventos_usuarios_rsvp_event_usuario_id__onchange(iSeqRow);
  nm_check_insert(iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_usuario_id__onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_usuario_nivel_evt__onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_usuarios_rsvp_validate_usuario_nivel_evt_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_usuario_nivel_evt__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_usuario_nivel_evt__onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_usuario_ativo__onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_usuarios_rsvp_validate_usuario_ativo_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_usuario_ativo__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_usuario_ativo__onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_nome_evento__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_eventos_usuarios_rsvp_nome_usuario__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_eventos_usuarios_rsvp_status_evento__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_eventos_usuarios_rsvp_nome_empresa__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_eventos_usuarios_rsvp_rodape__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
}

function sc_form_eventos_usuarios_rsvp_status__onblur(oThis, iSeqRow, event) {
  do_ajax_form_eventos_usuarios_rsvp_validate_status_(iSeqRow);
  scCssBlur(oThis, iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_status__onchange(oThis, iSeqRow, event) {
  scMarkFormAsChanged();
  nm_check_insert(iSeqRow);
}

function sc_form_eventos_usuarios_rsvp_status__onfocus(oThis, iSeqRow, event) {
  scEventControl_onFocus(oThis, iSeqRow);
  scCssFocus(oThis, iSeqRow);
}

function displayChange_block(block, status) {
        if ("0" == block) {
                displayChange_block_0(status);
        }
}

function displayChange_block_0(status) {
        displayChange_field("evento_id_", "", status);
        displayChange_field("usuario_id_", "", status);
        displayChange_field("usuario_nivel_evt_", "", status);
        displayChange_field("usuario_ativo_", "", status);
        displayChange_field("status_", "", status);
}

function displayChange_row(row, status) {
        displayChange_field_evento_id_(row, status);
        displayChange_field_usuario_id_(row, status);
        displayChange_field_usuario_nivel_evt_(row, status);
        displayChange_field_usuario_ativo_(row, status);
        displayChange_field_status_(row, status);
        displayChange_field_eventos_usuario_id_(row, status);
}

function displayChange_field(field, row, status) {
        if ("evento_id_" == field) {
                displayChange_field_evento_id_(row, status);
        }
        if ("usuario_id_" == field) {
                displayChange_field_usuario_id_(row, status);
        }
        if ("usuario_nivel_evt_" == field) {
                displayChange_field_usuario_nivel_evt_(row, status);
        }
        if ("usuario_ativo_" == field) {
                displayChange_field_usuario_ativo_(row, status);
        }
        if ("status_" == field) {
                displayChange_field_status_(row, status);
        }
        if ("eventos_usuario_id_" == field) {
                displayChange_field_eventos_usuario_id_(row, status);
        }
}

function displayChange_field_evento_id_(row, status) {
    var fieldId;
}

function displayChange_field_usuario_id_(row, status) {
    var fieldId;
        if ("on" == status) {
                Ctrl_Disabled = false;
                if ("all" == row) {
                        var fieldList = $(".css_usuario_id___obj");
                        for (var i = 0; i < fieldList.length; i++) {
                                $($(fieldList[i]).attr("id")).select2("destroy");
                        }
                }
                else {
                        if ($('#select2-id_sc_field_usuario_id_' + row + '-container').hasClass('scFormInputDisabledMult')) {
                            Ctrl_Disabled = true;
                        }

                        $("#id_sc_field_usuario_id_" + row).select2("destroy");
                }
                scJQSelect2Add(row, "usuario_id_");
                if (Ctrl_Disabled) {
                   $('#select2-id_sc_field_usuario_id_' + row + '-container').addClass('scFormInputDisabledMult')
                }
        }
}

function displayChange_field_usuario_nivel_evt_(row, status) {
    var fieldId;
}

function displayChange_field_usuario_ativo_(row, status) {
    var fieldId;
}

function displayChange_field_status_(row, status) {
    var fieldId;
}

function displayChange_field_eventos_usuario_id_(row, status) {
    var fieldId;
}

function scRecreateSelect2() {
        displayChange_field_usuario_id_("all", "on");
}
function scResetPagesDisplay() {
        $(".sc-form-page").show();
}

function scHidePage(pageNo) {
        $("#id_form_eventos_usuarios_rsvp_form" + pageNo).hide();
}

function scCheckNoPageSelected() {
        if (!$(".sc-form-page").filter(".scTabActive").filter(":visible").length) {
                var inactiveTabs = $(".sc-form-page").filter(".scTabInactive").filter(":visible");
                if (inactiveTabs.length) {
                        var tabNo = $(inactiveTabs[0]).attr("id").substr(37);
                }
        }
}
<?php
if (!$this->Embutida_form) {
    if($this->nmgp_opcao == 'novo' || ($this->nmgp_botoes['delete'] == "on" || $this->nmgp_botoes['update'] == "on")){
        $selectedFieldsDefault = '"0", "1"';
        $setControlStateLoop = '2';
    }else{
        $selectedFieldsDefault = '"0"';
        $setControlStateLoop = '1';
    }
} else {
    $selectedFieldsDefault = '"0"';
    $setControlStateLoop = '1';
}
$initialDirection = $_SESSION['scriptcase']['reg_conf']['css_dir'] == 'RTL' ? 'right' : 'left';
?>
var scFixCol_left = 0, scFixCol_list = [], scFixCol_selectedFields = [];

function scFixCol()
{
    var i;

    scFixCol_left = 0;
    scFixCol_list = [];

    scFixCol_addFieldColumns();

    for (i = 0; i < scFixCol_list.length; i++) {
        scFixCol_fix(scFixCol_list[i].type, scFixCol_list[i].name);
    }
}

function scFixCol_clear()
{
    let colList;

    scFixCol_selectedFields = [<?php echo $selectedFieldsDefault ?>];

    colList = $(".sc-col-op,.sc-col-fld");

    colList.css({
        "position": "static",
        "left": "auto"
    }).removeClass("sc-col-is-fixed");

    colList.filter(".sc-header-fixed").css({
        "position": "sticky"
    });
}

function scFixCol_addFieldColumns()
{
    var i;

    for (i = 0; i < scFixCol_selectedFields.length; i++) {
        scFixCol_list.push({"type": "fld", "name": scFixCol_selectedFields[i]});
    }
}

function scFixCol_fix(type, columnName)
{
    var columnCells = $(".sc-col-" + type + "-" + columnName), thisWidth = 0;

    if (columnCells.length) {
        thisWidth = columnCells[0].offsetWidth;

        columnCells.css({
            'position': 'sticky',
            '<?php echo $initialDirection; ?>': scFixCol_left,
            'z-index': 3
        }).addClass("sc-col-is-fixed");
    }

    scFixCol_left += thisWidth;
}

function scFixCol_fixTop()
{
    var columnCells = $(".sc-col-title");

    columnCells.css({
        'position': 'sticky',
        'top': 0,
        'z-index': 4
    });

    columnCells.filter(".sc-col-is-fixed").css("z-index", 5);
    columnCells.filter(".sc-col-is-fixed").filter(".sc-col-actions").css("z-index", 6);
}

function scFixCol_clickColumn(columnId)
{
    var action;

    action = scFixCol_fixColumns(columnId, "click");

    scFixCol_saveConfig(columnId, action);
}

function scFixCol_fixColumns(columnId, fixAction)
{
    var action = "";

    if ("click" == fixAction) {
        action = scFixCol_setControlState(columnId);
    } else {
        scFixCol_resetControlState(columnId);
    }

    scFixCol_clear();
    scFixCol_addFixedCells();
    scFixCol();
    scFixCol_fixTop();

    return action;
}

function scFixCol_setControlState(columnId)
{
    let i, fixColLength, action;

    if ($("#sc-fld-fix-col-" + columnId).hasClass("sc-op-fix-col-notfixed")) {
        action = "on";

        for (i = <?php echo $setControlStateLoop ?>; i <= columnId; i++) {
            $(".sc-op-fix-col-" + i).removeClass("sc-op-fix-col-notfixed").addClass("sc-op-fix-col-fixed");
        }
    } else {
        action = "off";

        fixColLength = $(".sc-op-fix-col").length;

        for (i = columnId; i < fixColLength; i++) {
            $(".sc-op-fix-col-" + i).removeClass("sc-op-fix-col-fixed").addClass("sc-op-fix-col-notfixed");
        }
    }

    return action;
}

function scFixCol_resetControlState(columnId)
{
    let i;

    $(".sc-op-fix-col").addClass("sc-op-fix-col-notfixed").removeClass("sc-op-fix-col-fixed");

    if ("" == columnId) {
        return;
    }

    for (i = <?php echo $setControlStateLoop ?>; i <= columnId; i++) {
        $(".sc-op-fix-col-" + i).removeClass("sc-op-fix-col-notfixed").addClass("sc-op-fix-col-fixed");
    }
}

function scFixCol_addFixedCells()
{
    selectedFields = $(".sc-ui-header-row .sc-op-fix-col.sc-op-fix-col-fixed");

    for (i = 0; i < selectedFields.length; i++) {
        scFixCol_selectedFields.push($(selectedFields[i]).attr("id").substr(15));
    }
}

function scFixCol_saveConfig(index, action)
{
    $.ajax({
        url: "form_eventos_usuarios_rsvp.php",
        dataType: "json",
        method: "POST",
        data: {
            script_case_init: "<?php echo $this->Ini->sc_page ?>",
            nmgp_opcao: "ajax_fixed_columns_form_save",
            fixed_index: index,
            fixed_action: action
        }
    }).done(function(data, textStatus, jqXHR) {
    });
}

function scFixCol_loadState()
{
    $.ajax({
        url: "form_eventos_usuarios_rsvp.php",
        dataType: "json",
        method: "POST",
        data: {
            script_case_init: "<?php echo $this->Ini->sc_page ?>",
            nmgp_opcao: "ajax_fixed_columns_form_load"
        }
    }).done(function(data, textStatus, jqXHR) {
        if (typeof data.status !== undefined && "ok" == data.status) {
            scFixCol_fixColumns(data.last_index, "load");
        }
    });
}

function scFixCol_addClickControl()
{
    $(".sc-op-fix-col").on("click", function() {
        scFixCol_clickColumn($(this).attr("data-fixcolid"));
    });
}

$(function()
{
    scFixCol();
    scFixCol_addClickControl();
    scFixCol_loadState();
    $(window).on('resize', function() {
        scFixCol_loadState();
    });
});

<?php

$formWidthCorrection = '';
if (false !== strpos($this->Ini->form_table_width, 'calc')) {
        $formWidthCalc = substr($this->Ini->form_table_width, strpos($this->Ini->form_table_width, '(') + 1);
        $formWidthCalc = substr($formWidthCalc, 0, strpos($formWidthCalc, ')'));
        $formWidthParts = explode(' ', $formWidthCalc);
        if (3 == count($formWidthParts) && 'px' == substr($formWidthParts[2], -2)) {
                $formWidthParts[2] = substr($formWidthParts[2], 0, -2) / 2;
                $formWidthCorrection = $formWidthParts[1] . ' ' . $formWidthParts[2];
        }
}

?>

function scSetFixedHeadersCss(baseTop)
{
    let rows, cols, i, j, thisTop;

    rows = $(".sc-ui-header-row");
    thisTop = baseTop;

    for (i = 0; i < rows.length; i++) {
        cols = $(rows[i]).find("td").filter(".sc-col-title");
        for (j = 0; j < cols.length; j++) {
            $(cols[j]).css({
                "position": "sticky",
                "top": thisTop + "px",
                "z-index": 4
            }).addClass("sc-header-fixed");
        }
        thisTop += $(rows[i]).height();
    }

    rows = $(".sc-ui-header-row");

    rows.filter(".sc-col-is-fixed").css("z-index", 5);
    rows.filter(".sc-col-is-fixed").filter(".sc-col-actions").css("z-index", 6);
}

$(function() {
    scSetFixedHeadersCss(0);
});

$(window).scroll(function() {
        scSetFixedHeaders();
});

var rerunHeaderDisplay = 1;

function scSetFixedHeaders(forceDisplay) {
    return;
        if (null == forceDisplay) {
                forceDisplay = false;
        }
        var divScroll, formHeaders, headerPlaceholder;
        formHeaders = scGetHeaderRow();
        headerPlaceholder = $("#sc-id-fixedheaders-placeholder");
        if (!formHeaders) {
                headerPlaceholder.hide();
        }
        else {
                if (scIsHeaderVisible(formHeaders)) {
                        headerPlaceholder.hide();
                }
                else {
                        if (!headerPlaceholder.filter(":visible").length || forceDisplay) {
                                scSetFixedHeadersContents(formHeaders, headerPlaceholder);
                                scSetFixedHeadersSize(formHeaders);
                                headerPlaceholder.show();
                        }
                        scSetFixedHeadersPosition(formHeaders, headerPlaceholder);
                        if (0 < rerunHeaderDisplay) {
                                rerunHeaderDisplay--;
                                setTimeout(function() {
                                        scSetFixedHeadersContents(formHeaders, headerPlaceholder);
                                        scSetFixedHeadersSize(formHeaders);
                                        headerPlaceholder.show();
                                        scSetFixedHeadersPosition(formHeaders, headerPlaceholder);
                                }, 5);
                        }
                }
        }
}

function scSetFixedHeadersPosition(formHeaders, headerPlaceholder) {
        if (formHeaders) {
                headerPlaceholder.css({"top": 0<?php echo $formWidthCorrection ?>, "left": (Math.floor(formHeaders.offset().left) - $(document).scrollLeft()<?php echo $formWidthCorrection ?>) + "px"});
        }
}

function scIsHeaderVisible(formHeaders) {
        if (typeof(scIsHeaderVisibleMobile) === typeof(function(){})) { return scIsHeaderVisibleMobile(formHeaders); }
        return formHeaders.offset().top > $(document).scrollTop();
}

function scGetHeaderRow() {
        var formHeaders = $(".sc-ui-header-row").filter(":visible");
        if (!formHeaders.length) {
                formHeaders = false;
        }
        return formHeaders;
}

function scSetFixedHeadersContents(formHeaders, headerPlaceholder) {
        var i, htmlContent;
        htmlContent = "<table id=\"sc-id-fixed-headers\" class=\"scFormTable\">";
        for (i = 0; i < formHeaders.length; i++) {
                htmlContent += "<tr class=\"scFormLabelOddMult\" id=\"sc-id-headers-row-" + i + "\">" + $(formHeaders[i]).html() + "</tr>";
        }
        htmlContent += "</table>";
        headerPlaceholder.html(htmlContent);
}

function scSetFixedHeadersSize(formHeaders) {
        var i, j, headerColumns, formColumns, cellHeight, cellWidth, tableOriginal, tableHeaders;
        tableOriginal = $("#hidden_bloco_0");
        tableHeaders = document.getElementById("sc-id-fixed-headers");
        $(tableHeaders).css("width", $(tableOriginal).outerWidth());
        for (i = 0; i < formHeaders.length; i++) {
                headerColumns = $("#sc-id-fixed-headers-row-" + i).find("td");
                formColumns = $(formHeaders[i]).find("td");
                for (j = 0; j < formColumns.length; j++) {
                        if (window.getComputedStyle(formColumns[j])) {
                                cellWidth = window.getComputedStyle(formColumns[j]).width;
                                cellHeight = window.getComputedStyle(formColumns[j]).height;
                        }
                        else {
                                cellWidth = $(formColumns[j]).width() + "px";
                                cellHeight = $(formColumns[j]).height() + "px";
                        }
                        $(headerColumns[j]).css({
                                "width": cellWidth,
                                "height": cellHeight
                        });
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
                         $(t).html("<a href=\"javascript:nm_mostra_doc('0', '"+rs2+"', 'form_eventos_usuarios_rsvp')\">"+$('#id_read_on_'+field+iSeqRow).text()+"</a>");
                     }
                }
                if($('#id_ajax_doc_'+field+iSeqRow+' a').length > 0){
                    scApiSetStorageDocHref($('#id_ajax_doc_'+field+iSeqRow+' a'), rs2, 'form_eventos_usuarios_rsvp');
                }else{
                    var $docLink = $(t).is('a') ? $(t) : $(t).find('a').addBack().filter('a').first();
                    if ($docLink.length === 0) {
                        $docLink = $(t);
                    }
                    scApiSetStorageDocHref($docLink, rs2, 'form_eventos_usuarios_rsvp');
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
  if (null == specificField || "usuario_id_" == specificField) {
    scJQSelect2Add_usuario_id_(seqRow);
  }
} // scJQSelect2Add

function scJQSelect2Add_usuario_id_(seqRow) {
  var elemSelector = "all" == seqRow ? ".css_usuario_id__obj" : "#id_sc_field_usuario_id_" + seqRow;
  $(elemSelector).select2(
    {
      containerCssClass: 'css_usuario_id__obj',
      dropdownCssClass: 'css_usuario_id__obj',
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
  $('#select2-id_sc_field_usuario_id_' + seqRow + '-container').addClass('css_usuario_id__obj');
  let Opc = (ctrl_new_line && seqRow != ctrl_last_line) ? 'novo' : 'upd';
} // scJQSelect2Add


function scJQElementsAdd(iLine) {
  scJQEventsAdd(iLine);
  scEventControl_init(iLine);
  scJQUploadAdd(iLine);
  scJQPasswordToggleAdd(iLine);
  scJQSelect2Add(iLine);
  setTimeout(function () { if ('function' == typeof displayChange_field_usuario_id_) { displayChange_field_usuario_id_(iLine, "on"); scAjaxError_markFieldList(scInsertFieldWithErrors); } }, 150);
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

