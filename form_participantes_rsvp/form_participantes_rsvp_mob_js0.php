<form name="F2" method=post 
               action="form_participantes_rsvp_mob.php" 
               target="_self"> 
<input type="hidden" name="participante_id" value="<?php echo $this->form_encode_input($this->nmgp_dados_form['participante_id']); ?>">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="master_nav" value="off">
<input type="hidden" name="sc_ifr_height" value="">
<input type="hidden" name="nmgp_parms" value=""/>
<input type="hidden" name="nmgp_ordem" value=""/>
<input type="hidden" name="nmgp_clone" value=""/>
<input type="hidden" name="nmgp_fast_search" value=""/>
<input type="hidden" name="nmgp_cond_fast_search" value=""/>
<input type="hidden" name="nmgp_arg_fast_search" value=""/>
<input type="hidden" name="nmgp_arg_dyn_search" value=""/>
<input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
</form> 
<form name="F3" method="post" 
                  target="_self"> 
  <input type="hidden" name="nmgp_chave" value=""/>
  <input type="hidden" name="nmgp_opcao" value=""/>
  <input type="hidden" name="nmgp_ordem" value=""/>
  <input type="hidden" name="nmgp_chave_det" value=""/>
  <input type="hidden" name="nmgp_quant_linhas" value=""/>
  <input type="hidden" name="nmgp_url_saida" value=""/>
  <input type="hidden" name="nmgp_parms" value=""/>
  <input type="hidden" name="nmgp_outra_jan" value=""/>
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="F5" method="post" 
                  action="form_participantes_rsvp_mob.php" 
                  target="_self"> 
  <input type="hidden" name="nmgp_opcao" value="<?php if ($this->nm_Start_new) {echo "ini";} elseif ($this->sc_insert_on) {echo "final";} else {echo "igual";}?>"/>
  <input type="hidden" name="nmgp_parms" value="<?php if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_mob']['parms'])) {echo $this->form_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_mob']['parms']);} ?>"/>
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="F6" method="post" 
                  action="form_participantes_rsvp_mob.php" 
                  target="_self"> 
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"/> 
</form> 
<form name="FCAP" action="" method="post" target="_blank"> 
  <input type="hidden" name="SC_lig_apl_orig" value="form_participantes_rsvp_mob"/>
  <input type="hidden" name="nmgp_parms" value=""> 
  <input type="hidden" name="nmgp_outra_jan" value="true"> 
  <input type="hidden" name="script_case_init" value="<?php echo $this->form_encode_input($this->Ini->sc_page); ?>"> 
</form> 
<div id="id_div_process" style="display: none;z-index:1; margin: 10px; whitespace: nowrap" class="scFormProcessFixed"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</span></div>
<div id="id_div_process_block" style="display: none; margin: 10px; whitespace: nowrap"><span class="scFormProcess"><img border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" />&nbsp;<?php echo $this->Ini->Nm_lang['lang_othr_prcs']; ?>...</span></div>
<div id="id_fatal_error" class="scFormLabelOdd" style="display: none; position: absolute"></div>
<script type="text/javascript"> 
<?php
  $JsonVarLiga = new Services_JSON();
?> 
<?php
  if (isset($this->nm_mens_alert) && !empty($this->nm_mens_alert))
  {
      foreach ($this->nm_mens_alert as $i_alert => $mensagem)
      {
          $alertParams = isset($this->nm_params_alert[$i_alert]) ? $this->sc_ajax_alert_params($this->nm_params_alert[$i_alert]) : array();
          $jsonParams  = json_encode($alertParams);
          echo "scJs_alert('" . html_entity_decode($mensagem, ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "', null, $jsonParams);";
          echo "sc_userSweetAlertDisplayed = true;";
      }
  }
?> 
var var_btn_Pessoas_vg_cpf = "<?php echo $this->form_encode_input($this->nmgp_dados_form['part_cpf']); ?>";
function sc_btn_Pessoas()
{
    if (scEventControl_active("")) {
      setTimeout(function() { sc_btn_Pessoas(); }, 500);
      return;
    }
    sc_btn_Pessoas_ok();
}
function sc_btn_Pessoas_cancel()
{
}
function sc_btn_Pessoas_ok()
{
<?php
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_mob']['where_detal'])) {
?>  
  parent.tb_show('', '<?php echo $this->Ini->link_form_pessoas_rsvp_edit; ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo "vg_cpf*scin' + var_btn_Pessoas_vg_cpf + '*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutsc_redir_atualiz*scinok*scoutsc_redir_insert*scinok*scout"; ?>&nmgp_outra_jan=true&TB_iframe=true&height=800&width=900&modal=true', '');
<?php
  }
  else
  {
?>  
  tb_show('', '<?php echo $this->Ini->link_form_pessoas_rsvp_edit; ?>?script_case_init=<?php echo $this->Ini->sc_page; ?>&nmgp_url_saida=modal&nmgp_parms=<?php echo "vg_cpf*scin' + var_btn_Pessoas_vg_cpf + '*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutsc_redir_atualiz*scinok*scoutsc_redir_insert*scinok*scout"; ?>&nmgp_outra_jan=true&TB_iframe=true&height=800&width=900&modal=true', '');
<?php
  }
?>  
}
var var_btn_LOG_vg_campo_id = "<?php echo $this->form_encode_input($this->nmgp_dados_form['participante_id']); ?>";
var var_btn_LOG_vg_campo_evt = "<?php echo $this->form_encode_input($this->nmgp_dados_form['part_id_evento']); ?>";
function sc_btn_LOG()
{
    if (scEventControl_active("")) {
      setTimeout(function() { sc_btn_LOG(); }, 500);
      return;
    }
    sc_btn_LOG_ok();
}
function sc_btn_LOG_cancel()
{
}
function sc_btn_LOG_ok()
{
  nm_gp_submit('<?php echo $this->Ini->link_grid_rsvp_log_id_cons; ?>', '<?php echo $this->nm_location; ?>', '<?php echo "vg_campo_id*scin' + var_btn_LOG_vg_campo_id + '*scoutvg_campo_evt*scin' + var_btn_LOG_vg_campo_evt + '*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout"; ?>', 'inicio', '_self', '0', '0', 'grid_rsvp_log_id');
}
 NM_tp_critica(1);
function nm_gp_submit(apl_lig, apl_saida, parms, opc, target, modal_h, modal_w, apl_name) 
{ 
   if (target == 'modal') 
   {
       par_modal = '?script_case_init=<?php echo $this->form_encode_input($this->Ini->sc_page) ?>&nmgp_outra_jan=true&nmgp_url_saida=modal';
       if (opc != null && opc != '') 
       {
           par_modal += '&nmgp_opcao=grid';
       }
       if (parms != null && parms != '') 
       {
           par_modal += '&nmgp_parms=' + parms;
       }
<?php
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_mob']['where_detal']))
  {
?>  
       parent.tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');
<?php
  }
  else
  {
?>  
       tb_show('', apl_lig + par_modal + '&TB_iframe=true&modal=true&height=' + modal_h + '&width=' + modal_w, '');
<?php
  }
?>  
       return;
   }
   document.F3.target               = "_self"; 
   document.F3.action               = apl_lig  ;
   document.F3.nmgp_outra_jan.value = "";
   if (opc != null && opc != "") 
   {
       document.F3.nmgp_opcao.value = "grid" ;
   }
   else
   {
       document.F3.nmgp_opcao.value = "" ;
   }
   if (target != null && target == '_blank') 
   {
       document.F3.nmgp_outra_jan.value = "true" ;
       window.open('','jan_sc','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');
       document.F3.target = "jan_sc";
   }
   if (target != null && target == 'new_tab') 
   {
       document.F3.nmgp_outra_jan.value = "true";
       window.open('','jan_sc','');
       document.F3.target = "jan_sc";
   }
   document.F3.nmgp_url_saida.value = apl_saida ;
   document.F3.nmgp_parms.value     = parms ;
   document.F3.submit() ;
} 

function scInlineFormSend()
{
  return false;
}

function nm_navpage(x, op) 
{ 
    nm_move('navpage', x);
} 
function nm_move(x, y, z) 
{ 
    if (x == "modal_igual")
    {
        x = "igual";
    }
    else
    if (Nm_Proc_Atualiz)
    {
        return;
    }
    if (("inicio" == x || "retorna" == x) && "S" != Nav_permite_ret)
    {
        return;
    }
    if (("avanca" == x || "final" == x) && "S" != Nav_permite_ava)
    {
        return;
    }
    document.F2.nmgp_opcao.value = x; 
    document.F2.nmgp_ordem.value = y; 
    document.F2.nmgp_clone.value = "";
    if ("apl_detalhe" == x)
    {
        document.F2.nmgp_opcao.value = 'igual'; 
        document.F2.master_nav.value = 'on'; 
        if (z)
        {
            document.F2.sc_ifr_height.value = z;
        }
        document.F2.submit();
        return;
    }
    if ("clone" == x)
    {
        x = "novo";
        document.F2.nmgp_clone.value = "S";
        document.F2.nmgp_opcao.value = x; 
    }
    if ("fast_search" == x)
    {
        document.F2.nmgp_ordem.value = ''; 
        document.F2.nmgp_fast_search.value = scAjaxGetFieldSelectMult("nmgp_fast_search_" + y, ";"); 
        if(document.F2.nmgp_fast_search.value == '') 
        { 
           document.F2.nmgp_fast_search.value = 'SC_all_Cmp'; 
        } 
        document.F2.nmgp_arg_fast_search.value = scAjaxGetFieldText("nmgp_arg_fast_search_" + y); 
        var ver_ch = eval('change_fast_' + y);
        if (document.F2.nmgp_arg_fast_search.value == '' && ver_ch == '')
        { 
            scJs_alert("<?php echo $this->Ini->Nm_lang['lang_srch_req_field'] ?>");
            document.F1.elements["nmgp_arg_fast_search_" + y].focus();
            return false;
        } 
        if (document.F2.nmgp_arg_fast_search.value == '__Clear_Fast__')
        { 
            document.F2.nmgp_arg_fast_search.value = '';
            document.F1.elements["nmgp_arg_fast_search_" + y].value = '';
        } 
        if(document.F2.nmgp_arg_fast_search.value == '') 
        { 
            $('#SC_fast_search_close_' + y).hide();
            $('#SC_fast_search_submit_' + y).show();
        } 
        else 
        { 
            $('#SC_fast_search_close_' + y).show();
            $('#SC_fast_search_submit_' + y).hide();
        } 
        document.F2.nmgp_cond_fast_search.value = scAjaxGetFieldSelect("nmgp_cond_fast_search_" + y); 
    }
    if ("novo" == x || "edit_novo" == x || "reload_novo" == x)
    {
<?php
       $NM_parm_ifr = (isset($NM_run_iframe) && $NM_run_iframe == 1) ? "NM_run_iframe?#?1?@?" : "";
?>
        document.F2.nmgp_parms.value = "<?php echo $NM_parm_ifr ?>";
        if (scFormHasChanged) {
          scJs_confirm('<?php echo html_entity_decode($this->Ini->Nm_lang['lang_reload_confirm']) ?>', function() { document.F2.submit(); }, function() {});
        } else {
          document.F2.submit();
        }
    }
    else
    {
        do_ajax_form_participantes_rsvp_mob_navigate_form();
    }
} 
var sc_mupload_ok = true;
var Nm_submit_ok = true; 
function nm_atualiza(x, y) 
{ 
    if ("incluir" == x) {
        scForm_insert(x, y);
        return;
    }
    if ("alterar" == x) {
        scForm_update(x, y);
        return;
    }
    if ("excluir" == x) {
        scForm_delete(x, y);
        return;
    }
    if ("recarga_mobile" == x) {
        scForm_refreshMobile(x, y);
        return;
    }
    if ("muda_form" == x) {
        scForm_changeForm(x, y);
        return;
    }
<?php 
    if (isset($this->Refresh_aba_menu)) 
    {
?>
        var aba_refresh_name = '<?php echo $this->Refresh_aba_menu ?>';
        parent.Tab_refresh[aba_refresh_name] = "S";
        if (typeof parent.tabLinkRefresh === 'function') {
            parent.tabLinkRefresh(aba_refresh_name);
        }<?php 
    }
?>
    if (!sc_mupload_ok)
    {
        if (!confirm("<?php echo $this->Ini->Nm_lang['lang_errm_muok'] ?>"))
        {
            return;
        }
        sc_mupload_ok = true;
    }
    Nm_submit_ok = true; 
    if (Nm_Proc_Atualiz)
    {
        return;
    }
    if (!scAjaxDetailProc())
    {
        return;
    }
<?php
    $NM_parm_ifr = (isset($NM_run_iframe) && $NM_run_iframe == 1) ? "NM_run_iframe?#?1?@?" : "";
?>
    document.F1.nmgp_parms.value = "<?php echo $NM_parm_ifr ?>";
    document.F1.target = "_self";
    if (x == "muda_form") 
    { 
       document.F1.nmgp_num_form.value = y; 
    } 
    if (x == "excluir") 
    { 
       if (confirm ("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_errm_remv'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>"))  
       { 
           scAjaxProcOn();
           document.F1.nmgp_opcao.value = x; 
           document.F1.submit(); 
       } 
       else 
       { 
          return; 
       } 
    } 
    else 
    { 
       document.F1.nmgp_opcao.value = x; 
       if ("incluir" == x || "muda_form" == x || "recarga" == x || "recarga_mobile" == x)
       {
           scAjaxProcOn();
           Nm_Proc_Atualiz = true;
           document.F1.submit();
       }
       else
       {
           Nm_Proc_Atualiz = true;
           do_ajax_form_participantes_rsvp_mob_submit_form();
       }
    } 
    if (Nm_submit_ok)
    { 
        Nm_Proc_Atualiz = true;
    } 
} 

<?php
$NM_parm_ifr = (isset($NM_run_iframe) && $NM_run_iframe == 1) ? "NM_run_iframe?#?1?@?" : "";
?>
function scForm_cancel() {
        return;
}
function scForm_insert(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_insert_prepare(x, y); }, scForm_cancel);
} // scForm_insert

function scForm_update(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_update_prepare(x, y); }, scForm_cancel);
} // scForm_update

function scForm_delete(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_delete_prepare(x, y); }, scForm_cancel);
} // scForm_delete

function scForm_refreshMobile(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_refreshMobile_prepare(x, y); }, scForm_cancel);
} // scForm_refreshMobile

function scForm_changeForm(x, y) {
        if (!scForm_initSubmit(x, y)) { return; }
        scForm_checkMultiUpload(function() { scForm_changeForm_prepare(x, y); }, scForm_cancel);
} // scForm_changeForm

function scForm_insert_prepare(x, y) {
        scForm_general_prepare(x, y);
        scForm_confirmInsert_single(function() { scForm_submit_single(x); }, scForm_cancel);
} // scForm_insert_prepare

function scForm_update_prepare(x, y) {
        scForm_general_prepare(x, y);
        scForm_confirmUpdate_single(function() { scForm_submit_single(x); }, scForm_cancel);
} // scForm_update_prepare

function scForm_delete_prepare(x, y) {
        scForm_general_prepare(x, y);
        scForm_confirmDelete(function() { scForm_delete_submit(x); }, scForm_cancel);
} // scForm_delete_prepare

function scForm_refreshMobile_prepare(x, y) {
        scForm_general_prepare(x, y);
        scForm_submit_single(x);
} // scForm_refreshMobile_prepare

function scForm_changeForm_prepare(x, y) {
        scForm_general_prepare(x, y);
        scForm_submit_single(x);
} // scForm_changeForm_prepare

function scForm_delete_submit(x) {
    scAjaxProcOn();
        document.F1.nmgp_opcao.value = x;
        document.F1.submit();
}

function scForm_general_prepare(x, y) {
        sc_mupload_ok = true;
        if (false === scForm_onSubmit(x)) {
                return;
        }
        scForm_setFormValues(x, y);
        scForm_packMultiSelect_single();
} // scForm_general_prepare

function scForm_initSubmit(x, y) {
<?php
if (isset($this->Refresh_aba_menu)) {
?>
        var aba_refresh_name = '<?php echo $this->Refresh_aba_menu ?>';
        parent.Tab_refresh[aba_refresh_name] = "S";
        if (typeof parent.tabLinkRefresh === 'function') {
            parent.tabLinkRefresh(aba_refresh_name);
        }
<?php
}
?>

        Nm_submit_ok = true;
        if (Nm_Proc_Atualiz) {
                return false;
        }
        if (!scAjaxDetailProc()) {
                return false;
        }

        return true;
} // scForm_initSubmit


function scForm_checkMultiUpload(callbackOk, callbackCancel) {
        if (!sc_mupload_ok) {
                scJs_confirm("<?php echo $this->Ini->Nm_lang['lang_errm_muok'] ?>", callbackOk, callbackCancel);
        }
        else {
                callbackOk();
        }
} // scForm_checkMultiUpload

function scForm_onSubmit(x) {
        return true;
} // scForm_onSubmit

function scForm_setFormValues(x, y) {
        document.F1.nmgp_parms.value = "<?php echo $NM_parm_ifr ?>";
        document.F1.target = "_self";
        if (x == "muda_form") {
                document.F1.nmgp_num_form.value = y;
        }
} // scForm_setFormValues

function scForm_packMultiSelect_single() {
} //scForm_packMultiSelect_single

function scForm_packMultiSelect_multi() {
        NM_count_mult = document.F1.sc_contr_vert.value;
} // scForm_packMultiSelect_multi

function scForm_packSignature_single() {
} // scForm_packSignature_single

function scForm_packSignature_multi() {
        NM_count_mult = document.F1.sc_contr_vert.value;
} // scForm_packSignature_multi

function scForm_confirmDelete(callbackOk, callbackCancel) {
        scJs_confirm("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_errm_remv'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>", callbackOk, callbackCancel);
} // scForm_confirmDelete

function scForm_confirmInsert_single(callbackOk, callbackCancel) {
        callbackOk();
} // scForm_confirmInsert_single

function scForm_confirmUpdate_single(callbackOk, callbackCancel) {
        callbackOk();
} // scForm_confirmUpdate_single

function scForm_submit_control(x) {
        document.F1.nmgp_opcao.value = x;
        document.F1.submit();
        if (Nm_submit_ok) {
                Nm_Proc_Atualiz = true;
        }
} // scForm_submit_control

function scForm_submit_single(x) {
        if (x != "excluir")
        {
                document.F1.nmgp_opcao.value = x;
                if ("incluir" == x || "muda_form" == x || "recarga" == x || "recarga_mobile" == x) {
            scAjaxProcOn();
                        Nm_Proc_Atualiz = true;
                        document.F1.submit();
                }
                else {
                        Nm_Proc_Atualiz = true;
                        do_ajax_form_participantes_rsvp_mob_submit_form();
                }
        }
        if (Nm_submit_ok) {
                Nm_Proc_Atualiz = true;
        }
} // scForm_submit_single

function nm_mostra_img(imagem, altura, largura)
{
    var image = new Image();
    image.src = imagem;
    var viewer = new Viewer(image, {
        navbar: false,
        hidden: function () {
            viewer.destroy();
        },
    });
    viewer.show();
}
function nm_recarga_form(nm_ult_ancora, nm_ult_page) 
{ 
    document.F1.target = "_self";
    document.F1.nmgp_parms.value = "";
    document.F1.nmgp_ancora.value= nm_ult_page; 
    document.F1.nmgp_ancora.value= nm_ult_page; 
    document.F1.nmgp_opcao.value= "recarga"; 
    document.F1.action += "#" +  nm_ult_ancora;
    document.F1.submit(); 
} 
function nm_link_url(Sc_url)
{
    if (Sc_url.substr(0, 7) != 'http://' && Sc_url.substr(0, 8) != 'https://')
    {
        Sc_url = 'http://' + Sc_url;
    }
    return Sc_url;
}
function sc_trim(str, chars) {
        return sc_ltrim(sc_rtrim(str, chars), chars);
}
function sc_ltrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
function sc_rtrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}
function lookup_part_cpf(campo)
{
   dados  = document.F1.part_cpf.value;
   jsrsExecute("<?php  echo $this->Ini->path_link . SC_dir_app_name('form_participantes_rsvp_mob')?>/form_participantes_rsvp_mob.php?script_case_init=<?php echo $this->form_encode_input($this->Ini->sc_page); ?>&nmgp_opcao=lookup", recebe_part_cpf, "part_cpf", dados, false);
}
function recebe_part_cpf(string)
{
   document.getElementById('id_lookup_part_cpf').innerHTML = string;
}
<?php 
   if ($this->nmgp_opcao == "novo")
   {
   }
?>
var CEP     = 0;
var RUA     = 1;
var TIPOEXT = 2;
var LOGRAD  = 3;
var BAIRRO  = 4;
var CIDADE  = 5;
var UF      = 6;
var LAT     = 7;
var LONG    = 8;
function cep_updateSelect(campo, valor) {
        var oFormField = $("#id_sc_field_" + campo);
        oFormField.val(valor);
        if (oFormField.hasClass("select2-hidden-accessible")) {
            $("#id_sc_field_" + campo).select2("destroy");
            setTimeout(function() {
               var select2Field = campo;
               scJQSelect2Add("", select2Field);
            }, 2000);
        }
}
function cep_array(string)
{
   return string.split("#;#");
}
function cep_part_cep(num_cep, campos_cep)
{
   retorno_cep  = campos_cep;
   jsrsExecute("form_participantes_rsvp_mob_cep.php?cep=" + num_cep + "&onchange=s", recebe_part_cep, "part_cep", num_cep, false);
}
function recebe_part_cep(string)
{
   if (string.substr(0, 3) == "nao")
   {
       alert ("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_othr_cepn'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>");
       return;
   }
   if (string.substr(0, 4) == "scep")
   {
       alert (string.substr(4));
       return;
   }
   arr_dados  = cep_array(string);
   retorno_cep += ";";
   arr_campos = retorno_cep.split(";");
   ix = 1;
   var returnValues = {};
   while (arr_campos[ix] != "")
   {
       arr_cada_cmp = arr_campos[ix].split(",");
       if (arr_cada_cmp[0] == "CEP")    { ind = 0;}
       if (arr_cada_cmp[0] == "RUA")    { ind = 1;}
       if (arr_cada_cmp[0] == "TIPOEXT"){ ind = 2;}
       if (arr_cada_cmp[0] == "LOGRAD") { ind = 3;}
       if (arr_cada_cmp[0] == "BAIRRO") { ind = 4;}
       if (arr_cada_cmp[0] == "CIDADE") { ind = 5;}
       if (arr_cada_cmp[0] == "UF")     { ind = 6;}
       if (arr_cada_cmp[0] == "LAT")    { ind = 7;}
       if (arr_cada_cmp[0] == "LONG")   { ind = 8;}
       dado_saida = arr_dados[ind];
       xxx = eval("document.F1." + arr_cada_cmp[1] + ".value = " + 'dado_saida');
       returnValues[ arr_cada_cmp[1] ] = {"type": arr_cada_cmp[0], "value": dado_saida};
       Obj_Ret_Cep = 'id_read_on_' + arr_cada_cmp[1];
       if (document.getElementById(Obj_Ret_Cep))
       {
           document.getElementById(Obj_Ret_Cep).innerHTML = dado_saida;
       }
       Obj_Ret_Cep = 'id_ajax_label_' + arr_cada_cmp[1];
       if (document.getElementById(Obj_Ret_Cep))
       {
           document.getElementById(Obj_Ret_Cep).innerHTML = dado_saida;
       }
       Obj_Ret_Cep = 'id_ac_' + arr_cada_cmp[1];
       if (document.getElementById(Obj_Ret_Cep))
       {
           document.getElementById(Obj_Ret_Cep).value = dado_saida;
       }
       var fieldObj = $("#id_sc_field_" + arr_cada_cmp[1]);
       if (fieldObj.length && ("select" == fieldObj[0].type || "select-one" == fieldObj[0].type || "select-multiple" == fieldObj[0].type)) {
           cep_updateSelect(arr_cada_cmp[1], dado_saida);
       }
       ix++;
   }
   cepReturnValues(returnValues);
}
function cep_part_cep(num_cep, campos_cep)
{
   retorno_cep  = campos_cep;
   jsrsExecute("form_participantes_rsvp_mob_cep.php?cep=" + num_cep + "&onchange=s", recebe_part_cep, "part_cep", num_cep, false);
}
function recebe_part_cep(string)
{
   if (string.substr(0, 3) == "nao")
   {
       alert ("<?php echo html_entity_decode($this->Ini->Nm_lang['lang_othr_cepn'], ENT_COMPAT, $_SESSION['scriptcase']['charset']); ?>");
       return;
   }
   if (string.substr(0, 4) == "scep")
   {
       alert (string.substr(4));
       return;
   }
   arr_dados  = cep_array(string);
   retorno_cep += ";";
   arr_campos = retorno_cep.split(";");
   ix = 1;
   var returnValues = {};
   while (arr_campos[ix] != "")
   {
       arr_cada_cmp = arr_campos[ix].split(",");
       if (arr_cada_cmp[0] == "CEP")    { ind = 0;}
       if (arr_cada_cmp[0] == "RUA")    { ind = 1;}
       if (arr_cada_cmp[0] == "TIPOEXT"){ ind = 2;}
       if (arr_cada_cmp[0] == "LOGRAD") { ind = 3;}
       if (arr_cada_cmp[0] == "BAIRRO") { ind = 4;}
       if (arr_cada_cmp[0] == "CIDADE") { ind = 5;}
       if (arr_cada_cmp[0] == "UF")     { ind = 6;}
       if (arr_cada_cmp[0] == "LAT")    { ind = 7;}
       if (arr_cada_cmp[0] == "LONG")   { ind = 8;}
       dado_saida = arr_dados[ind];
       xxx = eval("document.F1." + arr_cada_cmp[1] + ".value = " + 'dado_saida');
       returnValues[ arr_cada_cmp[1] ] = {"type": arr_cada_cmp[0], "value": dado_saida};
       Obj_Ret_Cep = 'id_read_on_' + arr_cada_cmp[1];
       if (document.getElementById(Obj_Ret_Cep))
       {
           document.getElementById(Obj_Ret_Cep).innerHTML = dado_saida;
       }
       Obj_Ret_Cep = 'id_ajax_label_' + arr_cada_cmp[1];
       if (document.getElementById(Obj_Ret_Cep))
       {
           document.getElementById(Obj_Ret_Cep).innerHTML = dado_saida;
       }
       Obj_Ret_Cep = 'id_ac_' + arr_cada_cmp[1];
       if (document.getElementById(Obj_Ret_Cep))
       {
           document.getElementById(Obj_Ret_Cep).value = dado_saida;
       }
       var fieldObj = $("#id_sc_field_" + arr_cada_cmp[1]);
       if (fieldObj.length && ("select" == fieldObj[0].type || "select-one" == fieldObj[0].type || "select-multiple" == fieldObj[0].type)) {
           cep_updateSelect(arr_cada_cmp[1], dado_saida);
       }
       ix++;
   }
   cepReturnValues(returnValues);
}
var hasJsFormOnload = true;
function sc_form_onload()
{
   nm_field_disabled("nome=disabled;part_tipo=disabled", "");
   nm_field_disabled("part_cod_substituto=disabled;part_nome_substituto=disabled", "I");
   
}

function scCssFocus(oHtmlObj)
{
  if (navigator.userAgent && 0 < navigator.userAgent.indexOf("MSIE") && "select" == oHtmlObj.type.substr(0, 6))
    return;
  if ($(oHtmlObj).hasClass('sc-ui-pwd-toggle')) {
    $(oHtmlObj).addClass('scFormObjectFocusOddPwdInput')
               .addClass('scFormObjectFocusOddPwdText')
               .removeClass('scFormObjectOddPwdInput')
               .removeClass('scFormObjectOddPwdText');
    $(oHtmlObj).parent().addClass('scFormObjectFocusOddPwdBox')
                        .removeClass('scFormObjectOddPwdBox');
  } else {
    $(oHtmlObj).addClass('scFormObjectFocusOdd')
               .removeClass('scFormObjectOdd');
  }
}

function scCssBlur(oHtmlObj)
{
  if (navigator.userAgent && 0 < navigator.userAgent.indexOf("MSIE") && "select" == oHtmlObj.type.substr(0, 6))
    return;
  if ($(oHtmlObj).hasClass('sc-ui-pwd-toggle')) {
    $(oHtmlObj).addClass('scFormObjectOddPwdInput')
               .addClass('scFormObjectOddPwdText')
               .removeClass('scFormObjectFocusOddPwdInput')
               .removeClass('scFormObjectFocusOddPwdText');
    $(oHtmlObj).parent().addClass('scFormObjectOddPwdBox')
                        .removeClass('scFormObjectFocusOddPwdBox');
  } else {
    $(oHtmlObj).addClass('scFormObjectOdd')
               .removeClass('scFormObjectFocusOdd');
  }
}

 function nm_submit_cap(apl_dest, parms)
 {
    document.FCAP.action = apl_dest;
    document.FCAP.nmgp_parms.value = parms;
    window.open('','jan_cap','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');
    document.FCAP.target = "jan_cap"; 
    document.FCAP.submit();
 }

 function nm_field_disabled(Fields, Opt) {
  opcao = "<?php if ($GLOBALS["erro_incl"] == 1) {echo "novo";} else {echo $this->nmgp_opcao;} ?>";
  if (opcao == "novo" && Opt == "U") {
      return;
  }
  if (opcao != "novo" && Opt == "I") {
      return;
  }
  Field = Fields.split(";");
  for (i=0; i < Field.length; i++)
  {
     F_temp = Field[i].split("=");
     F_name = F_temp[0];
     F_opc  = (F_temp[1] && ("disabled" == F_temp[1] || "true" == F_temp[1])) ? true : false;
     if (F_name == "part_ativo")
     {
        $('input[name="part_ativo"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="part_ativo"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="part_ativo"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "part_cpf")
     {
        $('input[name="part_cpf"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="part_cpf"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="part_cpf"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "nome")
     {
        $('input[name="nome"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="nome"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="nome"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "part_cod_substituido")
     {
        $('input[name="part_cod_substituido"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="part_cod_substituido"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="part_cod_substituido"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "part_nome_substituido")
     {
        $('input[name="part_nome_substituido"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="part_nome_substituido"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="part_nome_substituido"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "part_cod_substituto")
     {
        $('input[name="part_cod_substituto"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="part_cod_substituto"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="part_cod_substituto"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "part_nome_substituto")
     {
        $('input[name="part_nome_substituto"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="part_nome_substituto"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="part_nome_substituto"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "part_sexo_substituto")
     {
        $('input[name="part_sexo_substituto"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="part_sexo_substituto"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="part_sexo_substituto"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "enviar_app")
     {
        $('input[name="enviar_app"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="enviar_app"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="enviar_app"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "part_tipo")
     {
        $('input[name="part_tipo"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="part_tipo"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="part_tipo"]').removeClass("scFormInputDisabled");
        }
     }
  }
 } // nm_field_disabled
 function Protect_Disabled_Select2(id)
 {
  let $Field = $(id);
  $Field.on('select2:opening', function(e) {
    if ($Field.prop('disabled')) {
        e.preventDefault();
    }
  });
  $Field.on('keydown', function(e) {
    if ($Field.prop('disabled')) { 
        e.preventDefault();
        e.stopPropagation();
    }
  });
 } // Protect_Disabled_Select2
</script> 
