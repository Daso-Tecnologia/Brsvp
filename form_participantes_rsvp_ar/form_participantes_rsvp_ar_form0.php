<?php
class form_participantes_rsvp_ar_form extends form_participantes_rsvp_ar_apl
{
function Form_Init()
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
?>
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

header("X-XSS-Protection: 1; mode=block");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Referrer-Policy: origin-when-cross-origin");
header("Content-Security-Policy: frame-ancestors 'self' ; form-action 'self' ; connect-src 'self' ; base-uri 'self' ; child-src 'self' ; object-src 'none'");

?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("Ações Rápidas Participantes"); } else { echo strip_tags("Ações Rápidas Participantes"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
 <SCRIPT type="text/javascript">
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
  var sc_css_status_pwd_box = '<?php echo $this->Ini->Css_status_pwd_box; ?>';
  var sc_css_status_pwd_text = '<?php echo $this->Ini->Css_status_pwd_text; ?>';
<?php
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_redir_atualiz'] == 'ok')
{
?>
  var sc_closeChange = true;
<?php
}
else
{
?>
  var sc_closeChange = false;
<?php
}
?>
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
<style type="text/css">
.ui-datepicker { z-index: 6 !important }
</style>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/viewerjs/viewer.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/viewerjs/viewer.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <link rel='stylesheet' href='<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/multiple-select/multiple-select.css' type='text/css'/>
 <script type='text/javascript' src='<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/multiple-select/jquery.multiple.select.js'></script>
 <style type="text/css">
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_desc ?>'], 
   .scFormLabelOddMult a img[src$='<?php echo $this->Ini->Label_sort_asc ?>']{opacity:1!important;} 
   .scFormLabelOddMult a img{opacity:0;transition:all .2s;} 
   .scFormLabelOddMult:HOVER a img{opacity:1;transition:all .2s;} 
 </style>
<style type="text/css">
.sc-button-image.disabled {
        opacity: 0.25
}
.sc-button-image.disabled img {
        cursor: default !important
}
</style>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
<?php
$miniCalendarFA = $this->jqueryFAFile('calendar');
if ('' != $miniCalendarFA) {
?>
<style type="text/css">
.css_read_off_part_dt_nasc_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_validade_pass_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_cadastro_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_alteracao_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_alt_contato_rsvp_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_alt_presenca_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_solicit_especial_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_programacao_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_aereo_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_par_dt_hospedagem_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_transfer_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_opcionais_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_save_the_date_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['margin_top'] ?>;
}
</style>
<?php
}

?>

<link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/css/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2/js/select2.full.min.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_filter.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_filter<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_btngrp.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_btngrp<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_participantes_rsvp_ar/form_participantes_rsvp_ar_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_participantes_rsvp_ar_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
var scFormCtrlChanged = true;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['last'] : 'off'); ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       if ("off" == Nav_binicio_macro_disabled) { $("#sc_b_ini_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       if ("off" == Nav_bretorna_macro_disabled) { $("#sc_b_ret_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       if ("off" == Nav_bfinal_macro_disabled) { $("#sc_b_fim_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       if ("off" == Nav_bavanca_macro_disabled) { $("#sc_b_avc_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}
function summary_atualiza(reg_ini, reg_qtd, reg_tot)
{
    nm_sumario = "[<?php echo $this->Ini->Nm_lang['lang_othr_smry_info']?>]";
    nm_sumario = nm_sumario.replace("?start?", reg_ini);
    nm_sumario = nm_sumario.replace("?final?", reg_qtd);
    nm_sumario = nm_sumario.replace("?total?", reg_tot);
    if (reg_qtd < 1) {
        nm_sumario = "";
    }
    if (document.getElementById("sc_b_summary_b")) document.getElementById("sc_b_summary_b").innerHTML = nm_sumario;
}
function navpage_atualiza(str_navpage)
{
    if (document.getElementById("sc_b_navpage_b")) document.getElementById("sc_b_navpage_b").innerHTML = str_navpage;
}
<?php

include_once('form_participantes_rsvp_ar_jquery.php');

?>
var applicationKeys = "";
applicationKeys += "ctrl+shift+right";
applicationKeys += ",";
applicationKeys += "ctrl+shift+left";
applicationKeys += ",";
applicationKeys += "ctrl+right";
applicationKeys += ",";
applicationKeys += "ctrl+left";
applicationKeys += ",";
applicationKeys += "alt+q";
applicationKeys += ",";
applicationKeys += "escape";
applicationKeys += ",";
applicationKeys += "ctrl+enter";
applicationKeys += ",";
applicationKeys += "ctrl+s";
applicationKeys += ",";
applicationKeys += "ctrl+delete";
applicationKeys += ",";
applicationKeys += "f1";
applicationKeys += ",";
applicationKeys += "ctrl+shift+c";

var hotkeyList = "";

function execHotKey(e, h) {
    var hotkey_fired = false;
  switch (true) {
    case (["ctrl+shift+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_fim");
      break;
    case (["ctrl+shift+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ini");
      break;
    case (["ctrl+right"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ava");
      break;
    case (["ctrl+left"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_ret");
      break;
    case (["alt+q"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_sai");
      break;
    case (["escape"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_cnl");
      break;
    case (["ctrl+enter"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_inc");
      break;
    case (["ctrl+s"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_alt");
      break;
    case (["ctrl+delete"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_exc");
      break;
    case (["f1"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_webh");
      break;
    case (["ctrl+shift+c"].indexOf(h.key) > -1):
      hotkey_fired = process_hotkeys("sys_format_copy");
      break;
    default:
      return true;
  }
  if (hotkey_fired) {
        e.preventDefault();
        return false;
    } else {
        return true;
    }
}
</script>

<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys.inc.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>hotkeys_setup.js"></script>
<script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
<script type="text/javascript">

function process_hotkeys(hotkey)
{
  if (hotkey == "sys_format_fim") {
    if (typeof scBtnFn_sys_format_fim !== "undefined" && typeof scBtnFn_sys_format_fim === "function") {
      scBtnFn_sys_format_fim();
        return true;
    }
  }
  if (hotkey == "sys_format_ini") {
    if (typeof scBtnFn_sys_format_ini !== "undefined" && typeof scBtnFn_sys_format_ini === "function") {
      scBtnFn_sys_format_ini();
        return true;
    }
  }
  if (hotkey == "sys_format_ava") {
    if (typeof scBtnFn_sys_format_ava !== "undefined" && typeof scBtnFn_sys_format_ava === "function") {
      scBtnFn_sys_format_ava();
        return true;
    }
  }
  if (hotkey == "sys_format_ret") {
    if (typeof scBtnFn_sys_format_ret !== "undefined" && typeof scBtnFn_sys_format_ret === "function") {
      scBtnFn_sys_format_ret();
        return true;
    }
  }
  if (hotkey == "sys_format_sai") {
    if (typeof scBtnFn_sys_format_sai !== "undefined" && typeof scBtnFn_sys_format_sai === "function") {
      scBtnFn_sys_format_sai();
        return true;
    }
  }
  if (hotkey == "sys_format_cnl") {
    if (typeof scBtnFn_sys_format_cnl !== "undefined" && typeof scBtnFn_sys_format_cnl === "function") {
      scBtnFn_sys_format_cnl();
        return true;
    }
  }
  if (hotkey == "sys_format_inc") {
    if (typeof scBtnFn_sys_format_inc !== "undefined" && typeof scBtnFn_sys_format_inc === "function") {
      scBtnFn_sys_format_inc();
        return true;
    }
  }
  if (hotkey == "sys_format_alt") {
    if (typeof scBtnFn_sys_format_alt !== "undefined" && typeof scBtnFn_sys_format_alt === "function") {
      scBtnFn_sys_format_alt();
        return true;
    }
  }
  if (hotkey == "sys_format_exc") {
    if (typeof scBtnFn_sys_format_exc !== "undefined" && typeof scBtnFn_sys_format_exc === "function") {
      scBtnFn_sys_format_exc();
        return true;
    }
  }
  if (hotkey == "sys_format_webh") {
    if (typeof scBtnFn_sys_format_webh !== "undefined" && typeof scBtnFn_sys_format_webh === "function") {
      scBtnFn_sys_format_webh();
        return true;
    }
  }
  if (hotkey == "sys_format_copy") {
    if (typeof scBtnFn_sys_format_copy !== "undefined" && typeof scBtnFn_sys_format_copy === "function") {
      scBtnFn_sys_format_copy();
        return true;
    }
  }
    return false;
}

 var Dyn_Ini  = true;
<?php
  if (is_file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js"))
  {
      $Tb_err_js = file($this->Ini->root . $this->Ini->path_link . "_lib/js/tab_erro_" . $this->Ini->str_lang . ".js");
      foreach ($Tb_err_js as $Lines)
      {
          if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Lines = sc_convert_encoding($Lines, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          echo " " . $Lines;
      }
  }
  if (NM_is_utf8($Lines) && $_SESSION['scriptcase']['charset'] != "UTF-8")
  {
      $Msg_Inval = sc_convert_encoding("Invalido", $_SESSION['scriptcase']['charset'], "UTF-8");
  }
  echo " var SC_crit_inv = \"" . $Msg_Inval . "\";\r\n";
?>
 $(function() {

  $(".scBtnGrpText").mouseover(function() { $(this).addClass("scBtnGrpTextOver"); }).mouseout(function() { $(this).removeClass("scBtnGrpTextOver"); });
     $(".scBtnGrpClick").mouseup(function(){
          event.preventDefault();
          if(event.target !== event.currentTarget) return;
          if($(this).find("a").prop('href') != '')
          {
              $(this).find("a").click();
          }
          else
          {
              eval($(this).find("a").prop('onclick'));
          }
  });
  if (Dyn_Ini)
  {
      Dyn_Ini = false;
      if (typeof SC_carga_evt_jquery == 'function') { 
          SC_carga_evt_jquery('all');
      }
  }
  scLoadScInput('input:text.sc-js-input-dyn');
  Cmp_select2_ok = false;
  SC_select2_dyn();

  scJQGeneralAdd();

<?php
if (!empty($this->Mens_return_ok)) {
?>
  oResp = new Array();
  oResp = {"msgDisplay": {"msgText" : "<?php echo $this->Mens_return_ok ?>"}};
  scAjaxShowMessage("success");
<?php
}
$this->Mens_return_ok = "";
?>

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).on('load', function() {
     if ($('#t').length>0) {
         scQuickSearchKeyUp('t', null);
     }
     $("#fast_search_f0_t").select2({
        containerCssClass: 'scGridQuickSearchDivResult',
        dropdownCssClass: 'scGridQuickSearchDivDropdown',
        placeholder: '<?php echo $this->Ini->Nm_lang['lang_srch_all_fields'] ?>',
    });
     $("#cond_fast_search_f0_t").select2({
        containerCssClass: 'scGridQuickSearchDivResult',
        dropdownCssClass: 'scGridQuickSearchDivDropdown',
        minimumResultsForSearch: -1
    });
   });
   function SC_btn_grp_text() {
      $(".scBtnGrpText").mouseover(function() { $(this).addClass("scBtnGrpTextOver"); }).mouseout(function() { $(this).removeClass("scBtnGrpTextOver"); });
   };
   function scQuickSearchSubmit_t() {
     nm_move('fast_search', 't');
   }

   function scQuickSearchKeyUp(sPos, e) {
     if (null != e) {
       var keyPressed = e.charCode || e.keyCode || e.which;
       if (13 == keyPressed) {
         if ('t' == sPos) scQuickSearchSubmit_t();
       }
       else
       {
           $('#SC_fast_search_submit_'+sPos).show();
       }
     }
   }
   function nm_gp_submit_qsearch(pos)
   {
        nm_move('fast_search', pos);
   }
   function nm_gp_open_qsearch_div(pos)
   {
        if (typeof nm_gp_open_qsearch_div_mobile == 'function') {
            return nm_gp_open_qsearch_div_mobile(pos);
        }
        if($('#SC_fast_search_dropdown_' + pos).hasClass('fa-caret-down'))
        {
            if(($('#quicksearchph_' + pos).offset().top+$('#id_qs_div_' + pos).height()+10) >= $(document).height())
            {
                $('#id_qs_div_' + pos).offset({top:($('#quicksearchph_' + pos).offset().top-($('#quicksearchph_' + pos).height()/2)-$('#id_qs_div_' + pos).height()-4)});
            }

            nm_gp_open_qsearch_div_store_temp(pos);
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-down').addClass('fa-caret-up');
        }
        else
        {
            $('#SC_fast_search_dropdown_' + pos).removeClass('fa-caret-up').addClass('fa-caret-down');
        }
        $('#id_qs_div_' + pos).toggle();
   }

   var tmp_qs_arr_fields = [], tmp_qs_arr_cond = "";
   function nm_gp_open_qsearch_div_store_temp(pos)
   {
        tmp_qs_arr_fields = [], tmp_qs_str_cond = "";

        if($('#fast_search_f0_' + pos).prop('type') == 'select-multiple')
        {
            tmp_qs_arr_fields = $('#fast_search_f0_' + pos).val();
        }
        else
        {
            tmp_qs_arr_fields.push($('#fast_search_f0_' + pos).val());
        }

        tmp_qs_str_cond = $('#cond_fast_search_f0_' + pos).val();
   }

   function nm_gp_cancel_qsearch_div_store_temp(pos)
   {
        $('#fast_search_f0_' + pos).val('');
        $("#fast_search_f0_" + pos + " option").prop('selected', false);
        for(it=0; it<tmp_qs_arr_fields.length; it++)
        {
            $("#fast_search_f0_" + pos + " option[value='"+ tmp_qs_arr_fields[it] +"']").prop('selected', true);
        }
        $("#fast_search_f0_" + pos).change();
        tmp_qs_arr_fields = [];

        $('#cond_fast_search_f0_' + pos).val(tmp_qs_str_cond);
        $('#cond_fast_search_f0_' + pos).change();
        tmp_qs_str_cond = "";

        nm_gp_open_qsearch_div(pos);
   } if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['recarga'];
}
if ('novo' == $opcao_botoes && $this->Embutida_form)
{
    $opcao_botoes = 'inicio';
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['link_info']['remove_border']) {
        $remove_border = 'border-width: 0; ';
    }
    if ('' != $remove_background) {
?>
<style>
.scFormBorder { <?php echo $remove_background ?> }
.scFormToolbar { <?php echo $remove_background ?> }
</style>
<?php
    }
    $vertical_center = '';
?>
<body class="scFormPage sc-app-form" style="<?php echo $width_100 . $remove_margin . $remove_background . $str_iframe_body . $vertical_center; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<script type="text/javascript" src="<?php  echo $this->Ini->path_js . "/jsrsClient.js" ?>"> 
</script> 
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_participantes_rsvp_ar_js0.php");
?>
<script type="text/javascript" src="<?php  echo $this->Ini->path_js . "/jsrsClient.js" ?>"> 
</script> 
<script type="text/javascript"> 
nmdg_enter_tab = true;
  sc_quant_excl = <?php if (!isset($sc_check_excl)) {$sc_check_excl = array();} echo count($sc_check_excl); ?>; 
  <?php if (!isset($sc_check_incl)) {$sc_check_incl = array();}?>; 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
var scInsertFieldWithErrors = new Array();
<?php
foreach ($this->NM_ajax_info['fieldsWithErrors'] as $insertFieldName) {
?>
scInsertFieldWithErrors.push("<?php echo $insertFieldName; ?>");
<?php
}
?>
$(function() {
        scAjaxError_markFieldList(scInsertFieldWithErrors);
});
 </script>
<form  id= "id_Fdyn_search" name="F1" method="post" 
               action="./" 
               onsubmit="return false;" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_participantes_rsvp_ar'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_participantes_rsvp_ar'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable scFormToastTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle scFormToastTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage scFormToastMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<?php
$msgDefClose = isset($this->arr_buttons['bmessageclose']) ? $this->arr_buttons['bmessageclose']['value'] : 'Ok';
?>
<script type="text/javascript">
var scMsgDefTitle = "<?php if (isset($this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'])) {echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'];} ?>";
var scMsgDefButton = "Ok";
var scMsgDefClose = "<?php echo $msgDefClose; ?>";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->sc_page; ?>";
</script>
<?php
if ($this->record_insert_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmi']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
if ($this->record_delete_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmd']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
?>
<?php 
  $this->Tab_align = "center";
  $this->Tab_width = "  width=\"60%\"";
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sub_cons_iframe_align'];
      $this->Tab_width = " width=\"100%\"";
   } 
?>
<table id="main_table_form" align="<?php echo $this->Tab_align . '"' . $this->Tab_width ?> cellpadding=0 cellspacing=0 style="<?php echo (isset($width_100) ? $width_100 : ''); ?>">
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
$this->displayAppHeader();
?>
<tr><td>
<?php
$this->displayTopToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['fast_search'][2] : "";
          $stateSearchIconClose  = 'none';
          $stateSearchIconSearch = '';
          if(!empty($OPC_dat))
          {
              $stateSearchIconClose  = '';
              $stateSearchIconSearch = 'none';
          }
?> 
           <script type="text/javascript">var change_fast_t = "";</script>
          <span id="quicksearchph_t" class="scFormToolbarInput" style='display: inline-block; vertical-align: inherit'>
              <span>
                  <input type="text" id="SC_fast_search_t" class="scFormToolbarInputText" style="border-width: 0px;;" name="nmgp_arg_fast_search_t" value="<?php echo $this->form_encode_input($OPC_dat) ?>" size="10" onChange="change_fast_t = 'CH';" alt="{maxLength: 255}" placeholder="<?php echo $this->Ini->Nm_lang['lang_othr_qk_watermark'] ?>">&nbsp;
                  <i id='SC_fast_search_dropdown_t' style='cursor: pointer;' class='fas fa-caret-down' onclick="nm_gp_open_qsearch_div('t');"></i>
                  <img id="SC_fast_search_submit_t" class='css_toolbar_obj_qs_search_img' src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_search ?>" onclick="nm_gp_submit_qsearch('t');">
                  <img style="display: <?php echo $stateSearchIconClose ?>" class='css_toolbar_obj_qs_search_img' id="SC_fast_search_close_t" src="<?php echo $this->Ini->path_botoes ?>/<?php echo $this->Ini->Img_qs_clean ?>" onclick="document.getElementById('SC_fast_search_t').value = '__Clear_Fast__'; nm_move('fast_search', 't');">
              </span>
                  <div id='id_qs_div_t' class='scGridQuickSearchDivMoldura' style='display:none; position:absolute;'>
                                  <div>
                                      <span >
                                        <p class='scGridQuickSearchDivLabel'><?php echo $this->Ini->Nm_lang['lang_btns_clmn'] ?></span></p>
          <select id='fast_search_f0_t' multiple=multiple  class="scFormToolbarInput" style="vertical-align: middle;" name="nmgp_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $SC_Label_atu['SC_all_Cmp'] = $this->Ini->Nm_lang['lang_srch_all_fields']; 
          $SC_Label_atu['part_id_evento_'] = (isset($this->nm_new_label['part_id_evento_'])) ? $this->nm_new_label['part_id_evento_'] : 'Cod. Evento'; 
          $SC_Label_atu['part_cpf_'] = (isset($this->nm_new_label['part_cpf_'])) ? $this->nm_new_label['part_cpf_'] : 'CPF'; 
          $SC_Label_atu['nome_pessoa_'] = (isset($this->nm_new_label['nome_pessoa_'])) ? $this->nm_new_label['nome_pessoa_'] : 'Nome'; 
          $SC_Label_atu['part_sexo_'] = (isset($this->nm_new_label['part_sexo_'])) ? $this->nm_new_label['part_sexo_'] : 'Sexo'; 
          $SC_Label_atu['part_id_evento_publico_'] = (isset($this->nm_new_label['part_id_evento_publico_'])) ? $this->nm_new_label['part_id_evento_publico_'] : 'Público'; 
          $SC_Label_atu['part_id_evento_regional_'] = (isset($this->nm_new_label['part_id_evento_regional_'])) ? $this->nm_new_label['part_id_evento_regional_'] : 'Regional'; 
          $SC_Label_atu['part_grupo_'] = (isset($this->nm_new_label['part_grupo_'])) ? $this->nm_new_label['part_grupo_'] : 'Gupo'; 
          $SC_Label_atu['part_clube_'] = (isset($this->nm_new_label['part_clube_'])) ? $this->nm_new_label['part_clube_'] : 'Clube'; 
          $SC_Label_atu['part_empresa_'] = (isset($this->nm_new_label['part_empresa_'])) ? $this->nm_new_label['part_empresa_'] : 'Empresa'; 
          $SC_Label_atu['part_uf_'] = (isset($this->nm_new_label['part_uf_'])) ? $this->nm_new_label['part_uf_'] : 'UF'; 
          $SC_Label_atu['part_ddd_celular_01_'] = (isset($this->nm_new_label['part_ddd_celular_01_'])) ? $this->nm_new_label['part_ddd_celular_01_'] : 'DDD Celular'; 
          $SC_Label_atu['part_celeular_01_'] = (isset($this->nm_new_label['part_celeular_01_'])) ? $this->nm_new_label['part_celeular_01_'] : 'Celular'; 
          $SC_Label_atu['part_dt_nasc_'] = (isset($this->nm_new_label['part_dt_nasc_'])) ? $this->nm_new_label['part_dt_nasc_'] : 'Dt. Nascimento'; 
          $SC_Label_atu['part_tam_camisa_'] = (isset($this->nm_new_label['part_tam_camisa_'])) ? $this->nm_new_label['part_tam_camisa_'] : 'Tam. Camisa'; 
          $SC_Label_atu['part_tam_calcado_'] = (isset($this->nm_new_label['part_tam_calcado_'])) ? $this->nm_new_label['part_tam_calcado_'] : 'Tam. Calçado'; 
          foreach ($SC_Label_atu as $CMP => $LABEL)
          {
              if($CMP == 'SC_all_Cmp')
                  continue;
              $OPC_sel = ($CMP == $OPC_cmp) ? " selected" : "";
              echo "           <option value='" . $CMP . "'" . $OPC_sel . ">" . $LABEL . "</option>";
          }
?> 
          </select>
                                      </span>
                                      <span >
                                        <p class='scGridQuickSearchDivLabel'><?php echo $this->Ini->Nm_lang['lang_quck_srchcond'] ?></span></p>
          <select id='cond_fast_search_f0_t' class="scFormToolbarInput" style="vertical-align: middle;display:;" name="nmgp_cond_fast_search_t" onChange="change_fast_t = 'CH';">
<?php 
          $OPC_sel = ("qp" == $OPC_arg) ? " selected" : "";
           echo "           <option value='qp'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_like'] . "</option>";
          $OPC_sel = ("ii" == $OPC_arg) ? " selected" : "";
           echo "           <option value='ii'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_stts_with'] . "</option>";
          $OPC_sel = ("eq" == $OPC_arg) ? " selected" : "";
           echo "           <option value='eq'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_exac'] . "</option>";
          $OPC_sel = ("np" == $OPC_arg) ? " selected" : "";
           echo "           <option value='np'" . $OPC_sel . ">" . $this->Ini->Nm_lang['lang_srch_not_like'] . "</option>";
?> 
          </select>
                                      </span>
                                  </div>
                                  <div class='scGridQuickSearchDivToolbar'>
       <?php echo nmButtonOutput($this->arr_buttons, "bcancelar_appdiv", "nm_gp_cancel_qsearch_div_store_temp('t')", "nm_gp_cancel_qsearch_div_store_temp('t')", "qs_cancel", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
       <?php echo nmButtonOutput($this->arr_buttons, "bapply_appdiv", "nm_gp_submit_qsearch('t');", "nm_gp_submit_qsearch('t');", "qs_search", "", "", "", "absmiddle", "", "0", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
                                  </div>
                               </div>          </span>  </div>
  <?php
      }
        $sCondStyle = ($opcao_botoes != "novo" &&  $this->nmgp_botoes['dynsearch'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['dynsearch']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['dynsearch']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['dynsearch']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['dynsearch']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['dynsearch'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bdynamicsearch", "scBtnFn_sys_format_dynamicsearch()", "scBtnFn_sys_format_dynamicsearch()", "dynamic_search_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Enter)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Enter)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Enter)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Escape)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['balterarsel']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['balterarsel']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['balterarsel']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['balterarsel']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['balterarsel'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterarsel", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + S)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dyn_refresh'] = array();
$this->html_dynamic_search();
?>
<tr><td>
<?php
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['empty_filter'] = true;
       }
       echo "<tr><td>";
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
     <div id="SC_tab_mult_reg">
<?php
}

function Form_Table($Table_refresh = false)
{
   global $sc_seq_vert, $nm_apl_dependente, $opcao_botoes, $nm_url_saida; 
   if ($Table_refresh) 
   { 
       ob_start();
   }
?>
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
$labelRowCount = 0;
?>
   <tr class="sc-ui-header-row" id="sc-id-fixed-headers-row-<?php echo $labelRowCount++ ?>">
<?php
$orderColName = '';
$orderColOrient = '';
$orderColRule = '';
?>
    <script type="text/javascript">
     var orderImgAsc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_asc ?>";
     var orderImgDesc = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort_desc ?>";
     var orderImgNone = "<?php echo $this->Ini->path_img_global . "/" . $this->Ini->Label_sort ?>";
     var orderColName = "";
     function scSetOrderColumn(clickedColumn) {
      $(".sc-ui-img-order-column").attr("src", orderImgNone);
      if (clickedColumn != orderColName) {
       orderColName = clickedColumn;
       orderColOrient = orderImgAsc;
      }
      else if ("" != orderColName) {
       orderColOrient = orderColOrient == orderImgAsc ? orderImgDesc : orderImgAsc;
      }
      else {
       orderColName = "";
       orderColOrient = "";
      }
      $("#sc-id-img-order-" + orderColName).attr("src", orderColOrient);
     }
    </script>
<?php
     $Col_span = "";


       if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && ($this->nmgp_botoes['delete'] == "on" || $this->nmgp_botoes['update'] == "on")) { $Col_span = " colspan=2"; }
    if (!$this->Embutida_form && $this->nmgp_opcao == "novo") { $Col_span = " colspan=2"; }
 ?>

    <TD class="scFormLabelOddMult sc-col-title" <?php echo $Col_span ?>> &nbsp; </TD>
   
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title"  width="10"> &nbsp; </TD>
   <?php }?>
   <?php
    $sStyleHidden_part_id_evento_ = '';
    if (isset($this->nmgp_cmp_hidden['part_id_evento_']) && $this->nmgp_cmp_hidden['part_id_evento_'] == 'off') {
        $sStyleHidden_part_id_evento_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_id_evento_']) || $this->nmgp_cmp_hidden['part_id_evento_'] == 'on') {
        if (!isset($this->nm_new_label['part_id_evento_'])) {
            $this->nm_new_label['part_id_evento_'] = "Cod. Evento";
        }
        $SC_Label = "" . $this->nm_new_label['part_id_evento_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("part_id_evento", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("part_id_evento", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_part_id_evento__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_part_id_evento__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_part_id_evento__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_part_id_evento__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_part_id_evento__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_part_id_evento__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'part_id_evento')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_id_evento__label sc-col-title" id="hidden_field_label_part_id_evento_" style="<?php echo $sStyleHidden_part_id_evento_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_cpf_ = '';
    if (isset($this->nmgp_cmp_hidden['part_cpf_']) && $this->nmgp_cmp_hidden['part_cpf_'] == 'off') {
        $sStyleHidden_part_cpf_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_cpf_']) || $this->nmgp_cmp_hidden['part_cpf_'] == 'on') {
        if (!isset($this->nm_new_label['part_cpf_'])) {
            $this->nm_new_label['part_cpf_'] = "CPF";
        }
        $SC_Label = "" . $this->nm_new_label['part_cpf_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_cpf__label sc-col-title" id="hidden_field_label_part_cpf_" style="<?php echo $sStyleHidden_part_cpf_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_nome_pessoa_ = '';
    if (isset($this->nmgp_cmp_hidden['nome_pessoa_']) && $this->nmgp_cmp_hidden['nome_pessoa_'] == 'off') {
        $sStyleHidden_nome_pessoa_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['nome_pessoa_']) || $this->nmgp_cmp_hidden['nome_pessoa_'] == 'on') {
        if (!isset($this->nm_new_label['nome_pessoa_'])) {
            $this->nm_new_label['nome_pessoa_'] = "Nome";
        }
        $SC_Label = "" . $this->nm_new_label['nome_pessoa_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("nome_pessoa", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("nome_pessoa", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_nome_pessoa__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_nome_pessoa__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_nome_pessoa__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_nome_pessoa__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_nome_pessoa__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_nome_pessoa__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'nome_pessoa')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_nome_pessoa__label sc-col-title" id="hidden_field_label_nome_pessoa_" style="<?php echo $sStyleHidden_nome_pessoa_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_sexo_ = '';
    if (isset($this->nmgp_cmp_hidden['part_sexo_']) && $this->nmgp_cmp_hidden['part_sexo_'] == 'off') {
        $sStyleHidden_part_sexo_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_sexo_']) || $this->nmgp_cmp_hidden['part_sexo_'] == 'on') {
        if (!isset($this->nm_new_label['part_sexo_'])) {
            $this->nm_new_label['part_sexo_'] = "Sexo";
        }
        $SC_Label = "" . $this->nm_new_label['part_sexo_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("part_sexo", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("part_sexo", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_part_sexo__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_part_sexo__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_part_sexo__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_part_sexo__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_part_sexo__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_part_sexo__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'part_sexo')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_sexo__label sc-col-title" id="hidden_field_label_part_sexo_" style="<?php echo $sStyleHidden_part_sexo_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_id_evento_publico_ = '';
    if (isset($this->nmgp_cmp_hidden['part_id_evento_publico_']) && $this->nmgp_cmp_hidden['part_id_evento_publico_'] == 'off') {
        $sStyleHidden_part_id_evento_publico_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_id_evento_publico_']) || $this->nmgp_cmp_hidden['part_id_evento_publico_'] == 'on') {
        if (!isset($this->nm_new_label['part_id_evento_publico_'])) {
            $this->nm_new_label['part_id_evento_publico_'] = "Público";
        }
        $SC_Label = "" . $this->nm_new_label['part_id_evento_publico_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_id_evento_publico__label sc-col-title" id="hidden_field_label_part_id_evento_publico_" style="<?php echo $sStyleHidden_part_id_evento_publico_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_id_evento_regional_ = '';
    if (isset($this->nmgp_cmp_hidden['part_id_evento_regional_']) && $this->nmgp_cmp_hidden['part_id_evento_regional_'] == 'off') {
        $sStyleHidden_part_id_evento_regional_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_id_evento_regional_']) || $this->nmgp_cmp_hidden['part_id_evento_regional_'] == 'on') {
        if (!isset($this->nm_new_label['part_id_evento_regional_'])) {
            $this->nm_new_label['part_id_evento_regional_'] = "Regional";
        }
        $SC_Label = "" . $this->nm_new_label['part_id_evento_regional_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_id_evento_regional__label sc-col-title" id="hidden_field_label_part_id_evento_regional_" style="<?php echo $sStyleHidden_part_id_evento_regional_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_grupo_ = '';
    if (isset($this->nmgp_cmp_hidden['part_grupo_']) && $this->nmgp_cmp_hidden['part_grupo_'] == 'off') {
        $sStyleHidden_part_grupo_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_grupo_']) || $this->nmgp_cmp_hidden['part_grupo_'] == 'on') {
        if (!isset($this->nm_new_label['part_grupo_'])) {
            $this->nm_new_label['part_grupo_'] = "Gupo";
        }
        $SC_Label = "" . $this->nm_new_label['part_grupo_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_grupo__label sc-col-title" id="hidden_field_label_part_grupo_" style="<?php echo $sStyleHidden_part_grupo_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_clube_ = '';
    if (isset($this->nmgp_cmp_hidden['part_clube_']) && $this->nmgp_cmp_hidden['part_clube_'] == 'off') {
        $sStyleHidden_part_clube_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_clube_']) || $this->nmgp_cmp_hidden['part_clube_'] == 'on') {
        if (!isset($this->nm_new_label['part_clube_'])) {
            $this->nm_new_label['part_clube_'] = "Clube";
        }
        $SC_Label = "" . $this->nm_new_label['part_clube_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_clube__label sc-col-title" id="hidden_field_label_part_clube_" style="<?php echo $sStyleHidden_part_clube_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_empresa_ = '';
    if (isset($this->nmgp_cmp_hidden['part_empresa_']) && $this->nmgp_cmp_hidden['part_empresa_'] == 'off') {
        $sStyleHidden_part_empresa_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_empresa_']) || $this->nmgp_cmp_hidden['part_empresa_'] == 'on') {
        if (!isset($this->nm_new_label['part_empresa_'])) {
            $this->nm_new_label['part_empresa_'] = "Empresa";
        }
        $SC_Label = "" . $this->nm_new_label['part_empresa_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_empresa__label sc-col-title" id="hidden_field_label_part_empresa_" style="<?php echo $sStyleHidden_part_empresa_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_uf_ = '';
    if (isset($this->nmgp_cmp_hidden['part_uf_']) && $this->nmgp_cmp_hidden['part_uf_'] == 'off') {
        $sStyleHidden_part_uf_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_uf_']) || $this->nmgp_cmp_hidden['part_uf_'] == 'on') {
        if (!isset($this->nm_new_label['part_uf_'])) {
            $this->nm_new_label['part_uf_'] = "UF";
        }
        $SC_Label = "" . $this->nm_new_label['part_uf_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_uf__label sc-col-title" id="hidden_field_label_part_uf_" style="<?php echo $sStyleHidden_part_uf_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_ddd_celular_01_ = '';
    if (isset($this->nmgp_cmp_hidden['part_ddd_celular_01_']) && $this->nmgp_cmp_hidden['part_ddd_celular_01_'] == 'off') {
        $sStyleHidden_part_ddd_celular_01_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_ddd_celular_01_']) || $this->nmgp_cmp_hidden['part_ddd_celular_01_'] == 'on') {
        if (!isset($this->nm_new_label['part_ddd_celular_01_'])) {
            $this->nm_new_label['part_ddd_celular_01_'] = "DDD Celular";
        }
        $SC_Label = "" . $this->nm_new_label['part_ddd_celular_01_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_ddd_celular_01__label sc-col-title" id="hidden_field_label_part_ddd_celular_01_" style="<?php echo $sStyleHidden_part_ddd_celular_01_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_celeular_01_ = '';
    if (isset($this->nmgp_cmp_hidden['part_celeular_01_']) && $this->nmgp_cmp_hidden['part_celeular_01_'] == 'off') {
        $sStyleHidden_part_celeular_01_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_celeular_01_']) || $this->nmgp_cmp_hidden['part_celeular_01_'] == 'on') {
        if (!isset($this->nm_new_label['part_celeular_01_'])) {
            $this->nm_new_label['part_celeular_01_'] = "Celular";
        }
        $SC_Label = "" . $this->nm_new_label['part_celeular_01_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_celeular_01__label sc-col-title" id="hidden_field_label_part_celeular_01_" style="<?php echo $sStyleHidden_part_celeular_01_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_dt_nasc_ = '';
    if (isset($this->nmgp_cmp_hidden['part_dt_nasc_']) && $this->nmgp_cmp_hidden['part_dt_nasc_'] == 'off') {
        $sStyleHidden_part_dt_nasc_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_dt_nasc_']) || $this->nmgp_cmp_hidden['part_dt_nasc_'] == 'on') {
        if (!isset($this->nm_new_label['part_dt_nasc_'])) {
            $this->nm_new_label['part_dt_nasc_'] = "Dt. Nascimento";
        }
        $SC_Label = "" . $this->nm_new_label['part_dt_nasc_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_dt_nasc__label sc-col-title" id="hidden_field_label_part_dt_nasc_" style="<?php echo $sStyleHidden_part_dt_nasc_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_tam_camisa_ = '';
    if (isset($this->nmgp_cmp_hidden['part_tam_camisa_']) && $this->nmgp_cmp_hidden['part_tam_camisa_'] == 'off') {
        $sStyleHidden_part_tam_camisa_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_tam_camisa_']) || $this->nmgp_cmp_hidden['part_tam_camisa_'] == 'on') {
        if (!isset($this->nm_new_label['part_tam_camisa_'])) {
            $this->nm_new_label['part_tam_camisa_'] = "Tam. Camisa";
        }
        $SC_Label = "" . $this->nm_new_label['part_tam_camisa_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_tam_camisa__label sc-col-title" id="hidden_field_label_part_tam_camisa_" style="<?php echo $sStyleHidden_part_tam_camisa_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_part_tam_calcado_ = '';
    if (isset($this->nmgp_cmp_hidden['part_tam_calcado_']) && $this->nmgp_cmp_hidden['part_tam_calcado_'] == 'off') {
        $sStyleHidden_part_tam_calcado_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['part_tam_calcado_']) || $this->nmgp_cmp_hidden['part_tam_calcado_'] == 'on') {
        if (!isset($this->nm_new_label['part_tam_calcado_'])) {
            $this->nm_new_label['part_tam_calcado_'] = "Tam. Calçado";
        }
        $SC_Label = "" . $this->nm_new_label['part_tam_calcado_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = '';
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_part_tam_calcado__label sc-col-title" id="hidden_field_label_part_tam_calcado_" style="<?php echo $sStyleHidden_part_tam_calcado_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>





    <script type="text/javascript">
     var orderColOrient = "<?php echo $orderColOrient ?>";
     orderColRule = "<?php echo $orderColRule ?>";
     scSetOrderColumn("<?php echo $orderColName ?>");
    </script>
   </tr>
<?php   
} 
function Form_Corpo($Line_Add = false, $Table_refresh = false) 
{ 
   global $sc_seq_vert, $sc_check_incl, $sc_check_excl; 
   $sc_hidden_no = 1; $sc_hidden_yes = 0;
   if ($Line_Add) 
   { 
       ob_start();
       $iStart = sizeof($this->form_vert_form_participantes_rsvp_ar);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_participantes_rsvp_ar = $this->form_vert_form_participantes_rsvp_ar;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_participantes_rsvp_ar))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['part_id_evento_']))
           {
               $this->nmgp_cmp_readonly['part_id_evento_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['part_cpf_']))
           {
               $this->nmgp_cmp_readonly['part_cpf_'] = 'on';
           }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['nome_pessoa_']))
           {
               $this->nmgp_cmp_readonly['nome_pessoa_'] = 'on';
           }
   foreach ($this->form_vert_form_participantes_rsvp_ar as $sc_seq_vert => $sc_lixo)
   {
       $this->form_fixed_column_no = 0;
       $this->loadRecordState($sc_seq_vert);
       $this->participante_id_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['participante_id_'];
       $this->part_ativo_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ativo_'];
       $this->part_cpf_substituto_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_substituto_'];
       $this->part_crnm_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_crnm_'];
       $this->part_tipo_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tipo_'];
       $this->part_nome_cracha_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_cracha_'];
       $this->part_tipo_pessoa_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tipo_pessoa_'];
       $this->part_substituido_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_substituido_'];
       $this->part_substituto_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_substituto_'];
       $this->part_cod_substituto_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_substituto_'];
       $this->part_nome_substituto_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_substituto_'];
       $this->part_sexo_substituto_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_sexo_substituto_'];
       $this->part_cod_substituido_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_substituido_'];
       $this->part_nome_substituido_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_substituido_'];
       $this->part_cep_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cep_'];
       $this->part_departamento_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_departamento_'];
       $this->part_cargo_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cargo_'];
       $this->part_logradouro_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_logradouro_'];
       $this->part_numero_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_numero_'];
       $this->part_complemento_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_complemento_'];
       $this->part_bairro_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_bairro_'];
       $this->part_cidade_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cidade_'];
       $this->part_ddd_01_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_01_'];
       $this->part_fone_01_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_01_'];
       $this->part_ddd_02_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_02_'];
       $this->part_fone_02_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_02_'];
       $this->part_ddd_03_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_03_'];
       $this->part_fone_03_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_03_'];
       $this->part_ddd_fax_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_fax_'];
       $this->part_fax_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fax_'];
       $this->part_ddd_celular_02_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_celular_02_'];
       $this->part_celular_02_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_celular_02_'];
       $this->part_fone_internacional_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fone_internacional_'];
       $this->part_email_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_email_'];
       $this->part_rg_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_rg_'];
       $this->part_passaporte_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_passaporte_'];
       $this->part_validade_pass_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_validade_pass_'];
       $this->part_passaporte_estrangeiro_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_passaporte_estrangeiro_'];
       $this->part_ind_voucher_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ind_voucher_'];
       $this->part_num_voucher_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_num_voucher_'];
       $this->part_idioma_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_idioma_'];
       $this->part_filiacao_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_filiacao_'];
       $this->part_pais_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_pais_'];
       $this->part_nome_secretaria_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_nome_secretaria_'];
       $this->part_email_secretaria_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_email_secretaria_'];
       $this->part_cod_usuario_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cod_usuario_'];
       $this->part_dt_cadastro_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_cadastro_'];
       $this->part_dt_alteracao_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alteracao_'];
       $this->part_contato_rsvp_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_contato_rsvp_'];
       $this->part_dt_alt_contato_rsvp_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_contato_rsvp_'];
       $this->part_presenca_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_presenca_'];
       $this->part_dt_alt_presenca_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_alt_presenca_'];
       $this->part_solicit_especial_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_solicit_especial_'];
       $this->part_dt_solicit_especial_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_solicit_especial_'];
       $this->part_programacao_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_programacao_'];
       $this->part_dt_programacao_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_programacao_'];
       $this->part_aereo_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_aereo_'];
       $this->part_dt_aereo_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_aereo_'];
       $this->part_hospedagem_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_hospedagem_'];
       $this->par_dt_hospedagem_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['par_dt_hospedagem_'];
       $this->part_dt_transfer_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_transfer_'];
       $this->part_opcionais_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_opcionais_'];
       $this->part_dt_opcionais_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_opcionais_'];
       $this->part_notas_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_notas_'];
       $this->part_confirm_viagem_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_confirm_viagem_'];
       $this->part_convite_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_convite_'];
       $this->part_concluido_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_concluido_'];
       $this->part_transfer_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_transfer_'];
       $this->part_convite_enviado_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_convite_enviado_'];
       $this->part_destaque_negrito_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_destaque_negrito_'];
       $this->part_atendimento_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_atendimento_'];
       $this->part_save_the_date_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_save_the_date_'];
       $this->part_arq_save_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_arq_save_'];
       $this->part_arq_convite_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_arq_convite_'];
       $this->part_fumante_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_fumante_'];
       $this->part_restricao_alimentar_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_restricao_alimentar_'];
       $this->part_acompanhado_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acompanhado_'];
       $this->part_acompanhado_hotel_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acompanhado_hotel_'];
       $this->part_acom_completo_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acom_completo_'];
       $this->part_acom_incompleto_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_acom_incompleto_'];
       $this->part_incompleto_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_incompleto_'];
       $this->part_aereo_ok_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_aereo_ok_'];
       $this->part_bloqueio_id_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_bloqueio_id_'];
       $this->part_hotel_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_hotel_'];
       $this->part_anotacoes_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_anotacoes_'];
       $this->guarda_cod_substituto_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['guarda_cod_substituto_'];
       $this->part_cpf_informado_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_informado_'];
       $this->part_cv_obs_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cv_obs_'];
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['part_id_evento_'] = true;
           $this->nmgp_cmp_readonly['part_cpf_'] = true;
           $this->nmgp_cmp_readonly['nome_pessoa_'] = true;
           $this->nmgp_cmp_readonly['part_sexo_'] = true;
           $this->nmgp_cmp_readonly['part_id_evento_publico_'] = true;
           $this->nmgp_cmp_readonly['part_id_evento_regional_'] = true;
           $this->nmgp_cmp_readonly['part_grupo_'] = true;
           $this->nmgp_cmp_readonly['part_clube_'] = true;
           $this->nmgp_cmp_readonly['part_empresa_'] = true;
           $this->nmgp_cmp_readonly['part_uf_'] = true;
           $this->nmgp_cmp_readonly['part_ddd_celular_01_'] = true;
           $this->nmgp_cmp_readonly['part_celeular_01_'] = true;
           $this->nmgp_cmp_readonly['part_dt_nasc_'] = true;
           $this->nmgp_cmp_readonly['part_tam_camisa_'] = true;
           $this->nmgp_cmp_readonly['part_tam_calcado_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['part_id_evento_']) || $this->nmgp_cmp_readonly['part_id_evento_'] != "on") {$this->nmgp_cmp_readonly['part_id_evento_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_cpf_']) || $this->nmgp_cmp_readonly['part_cpf_'] != "on") {$this->nmgp_cmp_readonly['part_cpf_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['nome_pessoa_']) || $this->nmgp_cmp_readonly['nome_pessoa_'] != "on") {$this->nmgp_cmp_readonly['nome_pessoa_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_sexo_']) || $this->nmgp_cmp_readonly['part_sexo_'] != "on") {$this->nmgp_cmp_readonly['part_sexo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_id_evento_publico_']) || $this->nmgp_cmp_readonly['part_id_evento_publico_'] != "on") {$this->nmgp_cmp_readonly['part_id_evento_publico_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_id_evento_regional_']) || $this->nmgp_cmp_readonly['part_id_evento_regional_'] != "on") {$this->nmgp_cmp_readonly['part_id_evento_regional_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_grupo_']) || $this->nmgp_cmp_readonly['part_grupo_'] != "on") {$this->nmgp_cmp_readonly['part_grupo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_clube_']) || $this->nmgp_cmp_readonly['part_clube_'] != "on") {$this->nmgp_cmp_readonly['part_clube_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_empresa_']) || $this->nmgp_cmp_readonly['part_empresa_'] != "on") {$this->nmgp_cmp_readonly['part_empresa_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_uf_']) || $this->nmgp_cmp_readonly['part_uf_'] != "on") {$this->nmgp_cmp_readonly['part_uf_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_ddd_celular_01_']) || $this->nmgp_cmp_readonly['part_ddd_celular_01_'] != "on") {$this->nmgp_cmp_readonly['part_ddd_celular_01_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_celeular_01_']) || $this->nmgp_cmp_readonly['part_celeular_01_'] != "on") {$this->nmgp_cmp_readonly['part_celeular_01_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_dt_nasc_']) || $this->nmgp_cmp_readonly['part_dt_nasc_'] != "on") {$this->nmgp_cmp_readonly['part_dt_nasc_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_tam_camisa_']) || $this->nmgp_cmp_readonly['part_tam_camisa_'] != "on") {$this->nmgp_cmp_readonly['part_tam_camisa_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['part_tam_calcado_']) || $this->nmgp_cmp_readonly['part_tam_calcado_'] != "on") {$this->nmgp_cmp_readonly['part_tam_calcado_'] = false;}
       }
            if (isset($this->form_vert_form_preenchimento[$sc_seq_vert])) {
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
            }
        $this->part_id_evento_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_']; 
       $part_id_evento_ = $this->part_id_evento_; 
       $sStyleHidden_part_id_evento_ = '';
       if (isset($sCheckRead_part_id_evento_))
       {
           unset($sCheckRead_part_id_evento_);
       }
       if (isset($this->nmgp_cmp_readonly['part_id_evento_']))
       {
           $sCheckRead_part_id_evento_ = $this->nmgp_cmp_readonly['part_id_evento_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_id_evento_']) && $this->nmgp_cmp_hidden['part_id_evento_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_id_evento_']);
           $sStyleHidden_part_id_evento_ = 'display: none;';
       }
       $bTestReadOnly_part_id_evento_ = true;
       $sStyleReadLab_part_id_evento_ = 'display: none;';
       $sStyleReadInp_part_id_evento_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["part_id_evento_"]) &&  $this->nmgp_cmp_readonly["part_id_evento_"] == "on"))
       {
           $bTestReadOnly_part_id_evento_ = false;
           unset($this->nmgp_cmp_readonly['part_id_evento_']);
           $sStyleReadLab_part_id_evento_ = '';
           $sStyleReadInp_part_id_evento_ = 'display: none;';
       }
       $this->part_cpf_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_cpf_']; 
       $part_cpf_ = $this->part_cpf_; 
       $sStyleHidden_part_cpf_ = '';
       if (isset($sCheckRead_part_cpf_))
       {
           unset($sCheckRead_part_cpf_);
       }
       if (isset($this->nmgp_cmp_readonly['part_cpf_']))
       {
           $sCheckRead_part_cpf_ = $this->nmgp_cmp_readonly['part_cpf_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_cpf_']) && $this->nmgp_cmp_hidden['part_cpf_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_cpf_']);
           $sStyleHidden_part_cpf_ = 'display: none;';
       }
       $bTestReadOnly_part_cpf_ = true;
       $sStyleReadLab_part_cpf_ = 'display: none;';
       $sStyleReadInp_part_cpf_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["part_cpf_"]) &&  $this->nmgp_cmp_readonly["part_cpf_"] == "on"))
       {
           $bTestReadOnly_part_cpf_ = false;
           unset($this->nmgp_cmp_readonly['part_cpf_']);
           $sStyleReadLab_part_cpf_ = '';
           $sStyleReadInp_part_cpf_ = 'display: none;';
       }
       $this->nome_pessoa_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['nome_pessoa_']; 
       $nome_pessoa_ = $this->nome_pessoa_; 
       $sStyleHidden_nome_pessoa_ = '';
       if (isset($sCheckRead_nome_pessoa_))
       {
           unset($sCheckRead_nome_pessoa_);
       }
       if (isset($this->nmgp_cmp_readonly['nome_pessoa_']))
       {
           $sCheckRead_nome_pessoa_ = $this->nmgp_cmp_readonly['nome_pessoa_'];
       }
       if (isset($this->nmgp_cmp_hidden['nome_pessoa_']) && $this->nmgp_cmp_hidden['nome_pessoa_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['nome_pessoa_']);
           $sStyleHidden_nome_pessoa_ = 'display: none;';
       }
       $bTestReadOnly_nome_pessoa_ = true;
       $sStyleReadLab_nome_pessoa_ = 'display: none;';
       $sStyleReadInp_nome_pessoa_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["nome_pessoa_"]) &&  $this->nmgp_cmp_readonly["nome_pessoa_"] == "on"))
       {
           $bTestReadOnly_nome_pessoa_ = false;
           unset($this->nmgp_cmp_readonly['nome_pessoa_']);
           $sStyleReadLab_nome_pessoa_ = '';
           $sStyleReadInp_nome_pessoa_ = 'display: none;';
       }
       $this->part_sexo_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_sexo_']; 
       $part_sexo_ = $this->part_sexo_; 
       $sStyleHidden_part_sexo_ = '';
       if (isset($sCheckRead_part_sexo_))
       {
           unset($sCheckRead_part_sexo_);
       }
       if (isset($this->nmgp_cmp_readonly['part_sexo_']))
       {
           $sCheckRead_part_sexo_ = $this->nmgp_cmp_readonly['part_sexo_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_sexo_']) && $this->nmgp_cmp_hidden['part_sexo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_sexo_']);
           $sStyleHidden_part_sexo_ = 'display: none;';
       }
       $bTestReadOnly_part_sexo_ = true;
       $sStyleReadLab_part_sexo_ = 'display: none;';
       $sStyleReadInp_part_sexo_ = '';
       if (isset($this->nmgp_cmp_readonly['part_sexo_']) && $this->nmgp_cmp_readonly['part_sexo_'] == 'on')
       {
           $bTestReadOnly_part_sexo_ = false;
           unset($this->nmgp_cmp_readonly['part_sexo_']);
           $sStyleReadLab_part_sexo_ = '';
           $sStyleReadInp_part_sexo_ = 'display: none;';
       }
       $this->part_id_evento_publico_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_publico_']; 
       $part_id_evento_publico_ = $this->part_id_evento_publico_; 
       $sStyleHidden_part_id_evento_publico_ = '';
       if (isset($sCheckRead_part_id_evento_publico_))
       {
           unset($sCheckRead_part_id_evento_publico_);
       }
       if (isset($this->nmgp_cmp_readonly['part_id_evento_publico_']))
       {
           $sCheckRead_part_id_evento_publico_ = $this->nmgp_cmp_readonly['part_id_evento_publico_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_id_evento_publico_']) && $this->nmgp_cmp_hidden['part_id_evento_publico_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_id_evento_publico_']);
           $sStyleHidden_part_id_evento_publico_ = 'display: none;';
       }
       $bTestReadOnly_part_id_evento_publico_ = true;
       $sStyleReadLab_part_id_evento_publico_ = 'display: none;';
       $sStyleReadInp_part_id_evento_publico_ = '';
       if (isset($this->nmgp_cmp_readonly['part_id_evento_publico_']) && $this->nmgp_cmp_readonly['part_id_evento_publico_'] == 'on')
       {
           $bTestReadOnly_part_id_evento_publico_ = false;
           unset($this->nmgp_cmp_readonly['part_id_evento_publico_']);
           $sStyleReadLab_part_id_evento_publico_ = '';
           $sStyleReadInp_part_id_evento_publico_ = 'display: none;';
       }
       $this->part_id_evento_regional_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_id_evento_regional_']; 
       $part_id_evento_regional_ = $this->part_id_evento_regional_; 
       $sStyleHidden_part_id_evento_regional_ = '';
       if (isset($sCheckRead_part_id_evento_regional_))
       {
           unset($sCheckRead_part_id_evento_regional_);
       }
       if (isset($this->nmgp_cmp_readonly['part_id_evento_regional_']))
       {
           $sCheckRead_part_id_evento_regional_ = $this->nmgp_cmp_readonly['part_id_evento_regional_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_id_evento_regional_']) && $this->nmgp_cmp_hidden['part_id_evento_regional_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_id_evento_regional_']);
           $sStyleHidden_part_id_evento_regional_ = 'display: none;';
       }
       $bTestReadOnly_part_id_evento_regional_ = true;
       $sStyleReadLab_part_id_evento_regional_ = 'display: none;';
       $sStyleReadInp_part_id_evento_regional_ = '';
       if (isset($this->nmgp_cmp_readonly['part_id_evento_regional_']) && $this->nmgp_cmp_readonly['part_id_evento_regional_'] == 'on')
       {
           $bTestReadOnly_part_id_evento_regional_ = false;
           unset($this->nmgp_cmp_readonly['part_id_evento_regional_']);
           $sStyleReadLab_part_id_evento_regional_ = '';
           $sStyleReadInp_part_id_evento_regional_ = 'display: none;';
       }
       $this->part_grupo_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_grupo_']; 
       $part_grupo_ = $this->part_grupo_; 
       $sStyleHidden_part_grupo_ = '';
       if (isset($sCheckRead_part_grupo_))
       {
           unset($sCheckRead_part_grupo_);
       }
       if (isset($this->nmgp_cmp_readonly['part_grupo_']))
       {
           $sCheckRead_part_grupo_ = $this->nmgp_cmp_readonly['part_grupo_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_grupo_']) && $this->nmgp_cmp_hidden['part_grupo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_grupo_']);
           $sStyleHidden_part_grupo_ = 'display: none;';
       }
       $bTestReadOnly_part_grupo_ = true;
       $sStyleReadLab_part_grupo_ = 'display: none;';
       $sStyleReadInp_part_grupo_ = '';
       if (isset($this->nmgp_cmp_readonly['part_grupo_']) && $this->nmgp_cmp_readonly['part_grupo_'] == 'on')
       {
           $bTestReadOnly_part_grupo_ = false;
           unset($this->nmgp_cmp_readonly['part_grupo_']);
           $sStyleReadLab_part_grupo_ = '';
           $sStyleReadInp_part_grupo_ = 'display: none;';
       }
       $this->part_clube_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_clube_']; 
       $part_clube_ = $this->part_clube_; 
       $sStyleHidden_part_clube_ = '';
       if (isset($sCheckRead_part_clube_))
       {
           unset($sCheckRead_part_clube_);
       }
       if (isset($this->nmgp_cmp_readonly['part_clube_']))
       {
           $sCheckRead_part_clube_ = $this->nmgp_cmp_readonly['part_clube_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_clube_']) && $this->nmgp_cmp_hidden['part_clube_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_clube_']);
           $sStyleHidden_part_clube_ = 'display: none;';
       }
       $bTestReadOnly_part_clube_ = true;
       $sStyleReadLab_part_clube_ = 'display: none;';
       $sStyleReadInp_part_clube_ = '';
       if (isset($this->nmgp_cmp_readonly['part_clube_']) && $this->nmgp_cmp_readonly['part_clube_'] == 'on')
       {
           $bTestReadOnly_part_clube_ = false;
           unset($this->nmgp_cmp_readonly['part_clube_']);
           $sStyleReadLab_part_clube_ = '';
           $sStyleReadInp_part_clube_ = 'display: none;';
       }
       $this->part_empresa_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_empresa_']; 
       $part_empresa_ = $this->part_empresa_; 
       $sStyleHidden_part_empresa_ = '';
       if (isset($sCheckRead_part_empresa_))
       {
           unset($sCheckRead_part_empresa_);
       }
       if (isset($this->nmgp_cmp_readonly['part_empresa_']))
       {
           $sCheckRead_part_empresa_ = $this->nmgp_cmp_readonly['part_empresa_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_empresa_']) && $this->nmgp_cmp_hidden['part_empresa_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_empresa_']);
           $sStyleHidden_part_empresa_ = 'display: none;';
       }
       $bTestReadOnly_part_empresa_ = true;
       $sStyleReadLab_part_empresa_ = 'display: none;';
       $sStyleReadInp_part_empresa_ = '';
       if (isset($this->nmgp_cmp_readonly['part_empresa_']) && $this->nmgp_cmp_readonly['part_empresa_'] == 'on')
       {
           $bTestReadOnly_part_empresa_ = false;
           unset($this->nmgp_cmp_readonly['part_empresa_']);
           $sStyleReadLab_part_empresa_ = '';
           $sStyleReadInp_part_empresa_ = 'display: none;';
       }
       $this->part_uf_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_uf_']; 
       $part_uf_ = $this->part_uf_; 
       $sStyleHidden_part_uf_ = '';
       if (isset($sCheckRead_part_uf_))
       {
           unset($sCheckRead_part_uf_);
       }
       if (isset($this->nmgp_cmp_readonly['part_uf_']))
       {
           $sCheckRead_part_uf_ = $this->nmgp_cmp_readonly['part_uf_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_uf_']) && $this->nmgp_cmp_hidden['part_uf_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_uf_']);
           $sStyleHidden_part_uf_ = 'display: none;';
       }
       $bTestReadOnly_part_uf_ = true;
       $sStyleReadLab_part_uf_ = 'display: none;';
       $sStyleReadInp_part_uf_ = '';
       if (isset($this->nmgp_cmp_readonly['part_uf_']) && $this->nmgp_cmp_readonly['part_uf_'] == 'on')
       {
           $bTestReadOnly_part_uf_ = false;
           unset($this->nmgp_cmp_readonly['part_uf_']);
           $sStyleReadLab_part_uf_ = '';
           $sStyleReadInp_part_uf_ = 'display: none;';
       }
       $this->part_ddd_celular_01_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_ddd_celular_01_']; 
       $part_ddd_celular_01_ = $this->part_ddd_celular_01_; 
       $sStyleHidden_part_ddd_celular_01_ = '';
       if (isset($sCheckRead_part_ddd_celular_01_))
       {
           unset($sCheckRead_part_ddd_celular_01_);
       }
       if (isset($this->nmgp_cmp_readonly['part_ddd_celular_01_']))
       {
           $sCheckRead_part_ddd_celular_01_ = $this->nmgp_cmp_readonly['part_ddd_celular_01_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_ddd_celular_01_']) && $this->nmgp_cmp_hidden['part_ddd_celular_01_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_ddd_celular_01_']);
           $sStyleHidden_part_ddd_celular_01_ = 'display: none;';
       }
       $bTestReadOnly_part_ddd_celular_01_ = true;
       $sStyleReadLab_part_ddd_celular_01_ = 'display: none;';
       $sStyleReadInp_part_ddd_celular_01_ = '';
       if (isset($this->nmgp_cmp_readonly['part_ddd_celular_01_']) && $this->nmgp_cmp_readonly['part_ddd_celular_01_'] == 'on')
       {
           $bTestReadOnly_part_ddd_celular_01_ = false;
           unset($this->nmgp_cmp_readonly['part_ddd_celular_01_']);
           $sStyleReadLab_part_ddd_celular_01_ = '';
           $sStyleReadInp_part_ddd_celular_01_ = 'display: none;';
       }
       $this->part_celeular_01_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_celeular_01_']; 
       $part_celeular_01_ = $this->part_celeular_01_; 
       $sStyleHidden_part_celeular_01_ = '';
       if (isset($sCheckRead_part_celeular_01_))
       {
           unset($sCheckRead_part_celeular_01_);
       }
       if (isset($this->nmgp_cmp_readonly['part_celeular_01_']))
       {
           $sCheckRead_part_celeular_01_ = $this->nmgp_cmp_readonly['part_celeular_01_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_celeular_01_']) && $this->nmgp_cmp_hidden['part_celeular_01_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_celeular_01_']);
           $sStyleHidden_part_celeular_01_ = 'display: none;';
       }
       $bTestReadOnly_part_celeular_01_ = true;
       $sStyleReadLab_part_celeular_01_ = 'display: none;';
       $sStyleReadInp_part_celeular_01_ = '';
       if (isset($this->nmgp_cmp_readonly['part_celeular_01_']) && $this->nmgp_cmp_readonly['part_celeular_01_'] == 'on')
       {
           $bTestReadOnly_part_celeular_01_ = false;
           unset($this->nmgp_cmp_readonly['part_celeular_01_']);
           $sStyleReadLab_part_celeular_01_ = '';
           $sStyleReadInp_part_celeular_01_ = 'display: none;';
       }
       $this->part_dt_nasc_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_dt_nasc_']; 
       $part_dt_nasc_ = $this->part_dt_nasc_; 
       $sStyleHidden_part_dt_nasc_ = '';
       if (isset($sCheckRead_part_dt_nasc_))
       {
           unset($sCheckRead_part_dt_nasc_);
       }
       if (isset($this->nmgp_cmp_readonly['part_dt_nasc_']))
       {
           $sCheckRead_part_dt_nasc_ = $this->nmgp_cmp_readonly['part_dt_nasc_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_dt_nasc_']) && $this->nmgp_cmp_hidden['part_dt_nasc_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_dt_nasc_']);
           $sStyleHidden_part_dt_nasc_ = 'display: none;';
       }
       $bTestReadOnly_part_dt_nasc_ = true;
       $sStyleReadLab_part_dt_nasc_ = 'display: none;';
       $sStyleReadInp_part_dt_nasc_ = '';
       if (isset($this->nmgp_cmp_readonly['part_dt_nasc_']) && $this->nmgp_cmp_readonly['part_dt_nasc_'] == 'on')
       {
           $bTestReadOnly_part_dt_nasc_ = false;
           unset($this->nmgp_cmp_readonly['part_dt_nasc_']);
           $sStyleReadLab_part_dt_nasc_ = '';
           $sStyleReadInp_part_dt_nasc_ = 'display: none;';
       }
       $this->part_tam_camisa_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tam_camisa_']; 
       $part_tam_camisa_ = $this->part_tam_camisa_; 
       $sStyleHidden_part_tam_camisa_ = '';
       if (isset($sCheckRead_part_tam_camisa_))
       {
           unset($sCheckRead_part_tam_camisa_);
       }
       if (isset($this->nmgp_cmp_readonly['part_tam_camisa_']))
       {
           $sCheckRead_part_tam_camisa_ = $this->nmgp_cmp_readonly['part_tam_camisa_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_tam_camisa_']) && $this->nmgp_cmp_hidden['part_tam_camisa_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_tam_camisa_']);
           $sStyleHidden_part_tam_camisa_ = 'display: none;';
       }
       $bTestReadOnly_part_tam_camisa_ = true;
       $sStyleReadLab_part_tam_camisa_ = 'display: none;';
       $sStyleReadInp_part_tam_camisa_ = '';
       if (isset($this->nmgp_cmp_readonly['part_tam_camisa_']) && $this->nmgp_cmp_readonly['part_tam_camisa_'] == 'on')
       {
           $bTestReadOnly_part_tam_camisa_ = false;
           unset($this->nmgp_cmp_readonly['part_tam_camisa_']);
           $sStyleReadLab_part_tam_camisa_ = '';
           $sStyleReadInp_part_tam_camisa_ = 'display: none;';
       }
       $this->part_tam_calcado_ = $this->form_vert_form_participantes_rsvp_ar[$sc_seq_vert]['part_tam_calcado_']; 
       $part_tam_calcado_ = $this->part_tam_calcado_; 
       $sStyleHidden_part_tam_calcado_ = '';
       if (isset($sCheckRead_part_tam_calcado_))
       {
           unset($sCheckRead_part_tam_calcado_);
       }
       if (isset($this->nmgp_cmp_readonly['part_tam_calcado_']))
       {
           $sCheckRead_part_tam_calcado_ = $this->nmgp_cmp_readonly['part_tam_calcado_'];
       }
       if (isset($this->nmgp_cmp_hidden['part_tam_calcado_']) && $this->nmgp_cmp_hidden['part_tam_calcado_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['part_tam_calcado_']);
           $sStyleHidden_part_tam_calcado_ = 'display: none;';
       }
       $bTestReadOnly_part_tam_calcado_ = true;
       $sStyleReadLab_part_tam_calcado_ = 'display: none;';
       $sStyleReadInp_part_tam_calcado_ = '';
       if (isset($this->nmgp_cmp_readonly['part_tam_calcado_']) && $this->nmgp_cmp_readonly['part_tam_calcado_'] == 'on')
       {
           $bTestReadOnly_part_tam_calcado_ = false;
           unset($this->nmgp_cmp_readonly['part_tam_calcado_']);
           $sStyleReadLab_part_tam_calcado_ = '';
           $sStyleReadInp_part_tam_calcado_ = 'display: none;';
       }

       $this->lookup_part_id_evento_($look_rpc_part_id_evento_);
       $nm_cor_fun_vert = (isset($nm_cor_fun_vert) && $nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = (isset($nm_img_fun_cel)  && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?> class="sc-row" data-sc-row-number="<?php echo $sc_seq_vert; ?>">


   
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>" > <?php echo $sc_seq_vert; ?> </TD>
   
   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && ($this->nmgp_botoes['delete'] == "on" || $this->nmgp_botoes['update'] == "on")) {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\""; if (in_array($sc_seq_vert, $sc_check_excl)) { echo " checked";} ?> onclick="if (this.checked) {sc_quant_excl++; } else {sc_quant_excl--; }" class="sc-js-input" alt="{type: 'checkbox', enterTab: true}"> </TD>
   <?php }?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") {?>
    <TD class="scFormDataOddMult" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\"" ; if (in_array($sc_seq_vert, $sc_check_incl) || !empty($this->nm_todas_criticas)) { echo " checked ";} ?> class="sc-js-input" alt="{type: 'checkbox', enterTab: true}"> </TD>
   <?php }?>
   <?php if ($this->Embutida_form) {?>
    <TD class="scFormDataOddMult"  id="hidden_field_data_sc_actions<?php echo $sc_seq_vert; ?>" NOWRAP> <?php if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['delete'] == "off") {
        $sDisplayDelete = 'display: none';
    }
    else {
        $sDisplayDelete = '';
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayDelete. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>

<?php
if ($this->nmgp_opcao != "novo") {
    if ($this->nmgp_botoes['update'] == "off") {
        $sDisplayUpdate = 'display: none';
    }
    else {
        $sDisplayUpdate = '';
    }
    if ($this->Embutida_ronly) {
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "" . $sDisplayUpdate. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php
        $sButDisp = 'display: none';
    }
    else
    {
        $sButDisp = $sDisplayUpdate;
    }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "" . $sButDisp. "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php
}
?>

<?php if ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_opcao == "novo") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_incluir", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('incluir', " . $sc_seq_vert . ")", "sc_ins_line_" . $sc_seq_vert . "", "", "", "display: ''", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php if ($this->nmgp_botoes['delete'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_excluir", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "nm_atualiza_line('excluir', " . $sc_seq_vert . ")", "sc_exc_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>

<?php if ($Line_Add && $this->Embutida_ronly) {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_edit", "mdOpenLine(" . $sc_seq_vert . ")", "mdOpenLine(" . $sc_seq_vert . ")", "sc_open_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>

<?php if ($this->nmgp_botoes['update'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_alterar", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "findPos(this); nm_atualiza_line('alterar', " . $sc_seq_vert . ")", "sc_upd_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>
<?php }?>
<?php if ($this->nmgp_botoes['insert'] == "on") {?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_participantes_rsvp_ar_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_participantes_rsvp_ar_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_participantes_rsvp_ar_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_participantes_rsvp_ar_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_participantes_rsvp_ar_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_participantes_rsvp_ar_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
 </TD>
   <?php }?>
   <?php if (isset($this->nmgp_cmp_hidden['part_id_evento_']) && $this->nmgp_cmp_hidden['part_id_evento_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_id_evento_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_id_evento_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_id_evento__line" id="hidden_field_data_part_id_evento_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_id_evento_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_id_evento__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_id_evento_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["part_id_evento_"]) &&  $this->nmgp_cmp_readonly["part_id_evento_"] == "on")) { 

 ?>
<input type="hidden" name="part_id_evento_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_id_evento_) . "\"><span id=\"id_ajax_label_part_id_evento_" . $sc_seq_vert . "\">" . $part_id_evento_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_part_id_evento_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_id_evento_<?php echo $sc_seq_vert ?> css_part_id_evento__line" style="<?php echo $sStyleReadLab_part_id_evento_; ?>"><?php echo $this->form_format_readonly("part_id_evento_", $this->form_encode_input($this->part_id_evento_)); ?></span><span id="id_read_off_part_id_evento_<?php echo $sc_seq_vert ?>" class="css_read_off_part_id_evento_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_id_evento_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_id_evento__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_id_evento_<?php echo $sc_seq_vert ?>" type=text name="part_id_evento_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_id_evento_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['part_id_evento_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['part_id_evento_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['part_id_evento_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 <SPAN id="id_lookup_part_id_evento_<?php echo $sc_seq_vert ?>"><?php echo $look_rpc_part_id_evento_; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_id_evento_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_id_evento_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_cpf_']) && $this->nmgp_cmp_hidden['part_cpf_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_cpf_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_cpf_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_cpf__line" id="hidden_field_data_part_cpf_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_cpf_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_cpf__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_cpf_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["part_cpf_"]) &&  $this->nmgp_cmp_readonly["part_cpf_"] == "on")) { 

 ?>
<input type="hidden" name="part_cpf_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_cpf_) . "\"><span id=\"id_ajax_label_part_cpf_" . $sc_seq_vert . "\">" . $part_cpf_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_part_cpf_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_cpf_<?php echo $sc_seq_vert ?> css_part_cpf__line" style="<?php echo $sStyleReadLab_part_cpf_; ?>"><?php echo $this->form_format_readonly("part_cpf_", $this->form_encode_input($this->part_cpf_)); ?></span><span id="id_read_off_part_cpf_<?php echo $sc_seq_vert ?>" class="css_read_off_part_cpf_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_cpf_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_cpf__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_cpf_<?php echo $sc_seq_vert ?>" type=text name="part_cpf_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_cpf_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> maxlength=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_cpf_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_cpf_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['nome_pessoa_']) && $this->nmgp_cmp_hidden['nome_pessoa_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nome_pessoa_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($nome_pessoa_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_nome_pessoa__line" id="hidden_field_data_nome_pessoa_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_nome_pessoa_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_nome_pessoa__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_nome_pessoa_ && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["nome_pessoa_"]) &&  $this->nmgp_cmp_readonly["nome_pessoa_"] == "on")) { 

 ?>
<input type="hidden" name="nome_pessoa_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($nome_pessoa_) . "\"><span id=\"id_ajax_label_nome_pessoa_" . $sc_seq_vert . "\">" . $nome_pessoa_ . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_nome_pessoa_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-nome_pessoa_<?php echo $sc_seq_vert ?> css_nome_pessoa__line" style="<?php echo $sStyleReadLab_nome_pessoa_; ?>"><?php echo $this->form_format_readonly("nome_pessoa_", $this->form_encode_input($this->nome_pessoa_)); ?></span><span id="id_read_off_nome_pessoa_<?php echo $sc_seq_vert ?>" class="css_read_off_nome_pessoa_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nome_pessoa_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_nome_pessoa__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nome_pessoa_<?php echo $sc_seq_vert ?>" type=text name="nome_pessoa_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($nome_pessoa_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_pessoa_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_pessoa_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_sexo_']) && $this->nmgp_cmp_hidden['part_sexo_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_sexo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_sexo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_sexo__line" id="hidden_field_data_part_sexo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_sexo_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_sexo__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_sexo_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_sexo_"]) &&  $this->nmgp_cmp_readonly["part_sexo_"] == "on") { 

 ?>
<input type="hidden" name="part_sexo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_sexo_) . "\">" . $part_sexo_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_sexo_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_sexo_<?php echo $sc_seq_vert ?> css_part_sexo__line" style="<?php echo $sStyleReadLab_part_sexo_; ?>"><?php echo $this->form_format_readonly("part_sexo_", $this->form_encode_input($this->part_sexo_)); ?></span><span id="id_read_off_part_sexo_<?php echo $sc_seq_vert ?>" class="css_read_off_part_sexo_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_sexo_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_sexo__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_sexo_<?php echo $sc_seq_vert ?>" type=text name="part_sexo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_sexo_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=1 alt="{datatype: 'text', maxLength: 1, allowedChars: '<?php echo $this->allowedCharsCharset("abcdefghijklmnopqrstuvwxyz") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_sexo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_sexo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_id_evento_publico_']) && $this->nmgp_cmp_hidden['part_id_evento_publico_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_id_evento_publico_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_id_evento_publico_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_id_evento_publico__line" id="hidden_field_data_part_id_evento_publico_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_id_evento_publico_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_id_evento_publico__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_id_evento_publico_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_id_evento_publico_"]) &&  $this->nmgp_cmp_readonly["part_id_evento_publico_"] == "on") { 

 ?>
<input type="hidden" name="part_id_evento_publico_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_id_evento_publico_) . "\">" . $part_id_evento_publico_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_id_evento_publico_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_id_evento_publico_<?php echo $sc_seq_vert ?> css_part_id_evento_publico__line" style="<?php echo $sStyleReadLab_part_id_evento_publico_; ?>"><?php echo $this->form_format_readonly("part_id_evento_publico_", $this->form_encode_input($this->part_id_evento_publico_)); ?></span><span id="id_read_off_part_id_evento_publico_<?php echo $sc_seq_vert ?>" class="css_read_off_part_id_evento_publico_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_id_evento_publico_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_id_evento_publico__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_id_evento_publico_<?php echo $sc_seq_vert ?>" type=text name="part_id_evento_publico_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_id_evento_publico_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> alt="{datatype: 'integer', maxLength: 11, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['part_id_evento_publico_']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['part_id_evento_publico_']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['part_id_evento_publico_']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_id_evento_publico_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_id_evento_publico_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_id_evento_regional_']) && $this->nmgp_cmp_hidden['part_id_evento_regional_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_id_evento_regional_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_id_evento_regional_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_id_evento_regional__line" id="hidden_field_data_part_id_evento_regional_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_id_evento_regional_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_id_evento_regional__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_id_evento_regional_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_id_evento_regional_"]) &&  $this->nmgp_cmp_readonly["part_id_evento_regional_"] == "on") { 

 ?>
<input type="hidden" name="part_id_evento_regional_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_id_evento_regional_) . "\">" . $part_id_evento_regional_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_id_evento_regional_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_id_evento_regional_<?php echo $sc_seq_vert ?> css_part_id_evento_regional__line" style="<?php echo $sStyleReadLab_part_id_evento_regional_; ?>"><?php echo $this->form_format_readonly("part_id_evento_regional_", $this->form_encode_input($this->part_id_evento_regional_)); ?></span><span id="id_read_off_part_id_evento_regional_<?php echo $sc_seq_vert ?>" class="css_read_off_part_id_evento_regional_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_id_evento_regional_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_id_evento_regional__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_id_evento_regional_<?php echo $sc_seq_vert ?>" type=text name="part_id_evento_regional_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_id_evento_regional_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=11"; } ?> maxlength=3 alt="{datatype: 'text', maxLength: 3, allowedChars: '<?php echo $this->allowedCharsCharset("0123456789") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_id_evento_regional_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_id_evento_regional_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_grupo_']) && $this->nmgp_cmp_hidden['part_grupo_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_grupo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_grupo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_grupo__line" id="hidden_field_data_part_grupo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_grupo_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_grupo__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_grupo_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_grupo_"]) &&  $this->nmgp_cmp_readonly["part_grupo_"] == "on") { 

 ?>
<input type="hidden" name="part_grupo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_grupo_) . "\">" . $part_grupo_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_grupo_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_grupo_<?php echo $sc_seq_vert ?> css_part_grupo__line" style="<?php echo $sStyleReadLab_part_grupo_; ?>"><?php echo $this->form_format_readonly("part_grupo_", $this->form_encode_input($this->part_grupo_)); ?></span><span id="id_read_off_part_grupo_<?php echo $sc_seq_vert ?>" class="css_read_off_part_grupo_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_grupo_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_grupo__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_grupo_<?php echo $sc_seq_vert ?>" type=text name="part_grupo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_grupo_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_grupo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_grupo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_clube_']) && $this->nmgp_cmp_hidden['part_clube_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_clube_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_clube_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_clube__line" id="hidden_field_data_part_clube_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_clube_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_clube__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_clube_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_clube_"]) &&  $this->nmgp_cmp_readonly["part_clube_"] == "on") { 

 ?>
<input type="hidden" name="part_clube_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_clube_) . "\">" . $part_clube_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_clube_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_clube_<?php echo $sc_seq_vert ?> css_part_clube__line" style="<?php echo $sStyleReadLab_part_clube_; ?>"><?php echo $this->form_format_readonly("part_clube_", $this->form_encode_input($this->part_clube_)); ?></span><span id="id_read_off_part_clube_<?php echo $sc_seq_vert ?>" class="css_read_off_part_clube_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_clube_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_clube__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_clube_<?php echo $sc_seq_vert ?>" type=text name="part_clube_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_clube_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_clube_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_clube_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_empresa_']) && $this->nmgp_cmp_hidden['part_empresa_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_empresa_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_empresa_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_empresa__line" id="hidden_field_data_part_empresa_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_empresa_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_empresa__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_empresa_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_empresa_"]) &&  $this->nmgp_cmp_readonly["part_empresa_"] == "on") { 

 ?>
<input type="hidden" name="part_empresa_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_empresa_) . "\">" . $part_empresa_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_empresa_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_empresa_<?php echo $sc_seq_vert ?> css_part_empresa__line" style="<?php echo $sStyleReadLab_part_empresa_; ?>"><?php echo $this->form_format_readonly("part_empresa_", $this->form_encode_input($this->part_empresa_)); ?></span><span id="id_read_off_part_empresa_<?php echo $sc_seq_vert ?>" class="css_read_off_part_empresa_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_empresa_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_empresa__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_empresa_<?php echo $sc_seq_vert ?>" type=text name="part_empresa_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_empresa_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_empresa_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_empresa_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_uf_']) && $this->nmgp_cmp_hidden['part_uf_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_uf_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_uf_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_uf__line" id="hidden_field_data_part_uf_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_uf_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_uf__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_uf_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_uf_"]) &&  $this->nmgp_cmp_readonly["part_uf_"] == "on") { 

 ?>
<input type="hidden" name="part_uf_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_uf_) . "\">" . $part_uf_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_uf_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_uf_<?php echo $sc_seq_vert ?> css_part_uf__line" style="<?php echo $sStyleReadLab_part_uf_; ?>"><?php echo $this->form_format_readonly("part_uf_", $this->form_encode_input($this->part_uf_)); ?></span><span id="id_read_off_part_uf_<?php echo $sc_seq_vert ?>" class="css_read_off_part_uf_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_uf_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_uf__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_uf_<?php echo $sc_seq_vert ?>" type=text name="part_uf_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_uf_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_uf_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_uf_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_ddd_celular_01_']) && $this->nmgp_cmp_hidden['part_ddd_celular_01_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_ddd_celular_01_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_ddd_celular_01_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_ddd_celular_01__line" id="hidden_field_data_part_ddd_celular_01_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_ddd_celular_01_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_ddd_celular_01__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_ddd_celular_01_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_ddd_celular_01_"]) &&  $this->nmgp_cmp_readonly["part_ddd_celular_01_"] == "on") { 

 ?>
<input type="hidden" name="part_ddd_celular_01_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_ddd_celular_01_) . "\">" . $part_ddd_celular_01_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_ddd_celular_01_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_ddd_celular_01_<?php echo $sc_seq_vert ?> css_part_ddd_celular_01__line" style="<?php echo $sStyleReadLab_part_ddd_celular_01_; ?>"><?php echo $this->form_format_readonly("part_ddd_celular_01_", $this->form_encode_input($this->part_ddd_celular_01_)); ?></span><span id="id_read_off_part_ddd_celular_01_<?php echo $sc_seq_vert ?>" class="css_read_off_part_ddd_celular_01_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_ddd_celular_01_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_ddd_celular_01__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_ddd_celular_01_<?php echo $sc_seq_vert ?>" type=text name="part_ddd_celular_01_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_ddd_celular_01_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=3"; } ?> maxlength=2 alt="{datatype: 'text', maxLength: 2, allowedChars: '<?php echo $this->allowedCharsCharset("0123456789") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_ddd_celular_01_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_ddd_celular_01_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_celeular_01_']) && $this->nmgp_cmp_hidden['part_celeular_01_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_celeular_01_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_celeular_01_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_celeular_01__line" id="hidden_field_data_part_celeular_01_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_celeular_01_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_celeular_01__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_celeular_01_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_celeular_01_"]) &&  $this->nmgp_cmp_readonly["part_celeular_01_"] == "on") { 

 ?>
<input type="hidden" name="part_celeular_01_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_celeular_01_) . "\">" . $part_celeular_01_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_celeular_01_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_celeular_01_<?php echo $sc_seq_vert ?> css_part_celeular_01__line" style="<?php echo $sStyleReadLab_part_celeular_01_; ?>"><?php echo $this->form_format_readonly("part_celeular_01_", $this->form_encode_input($this->part_celeular_01_)); ?></span><span id="id_read_off_part_celeular_01_<?php echo $sc_seq_vert ?>" class="css_read_off_part_celeular_01_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_celeular_01_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_celeular_01__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_celeular_01_<?php echo $sc_seq_vert ?>" type=text name="part_celeular_01_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_celeular_01_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("0123456789") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_celeular_01_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_celeular_01_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_dt_nasc_']) && $this->nmgp_cmp_hidden['part_dt_nasc_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_dt_nasc_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_dt_nasc_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_dt_nasc__line" id="hidden_field_data_part_dt_nasc_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_dt_nasc_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_dt_nasc__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_dt_nasc_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_dt_nasc_"]) &&  $this->nmgp_cmp_readonly["part_dt_nasc_"] == "on") { 

 ?>
<input type="hidden" name="part_dt_nasc_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_dt_nasc_) . "\">" . $part_dt_nasc_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_dt_nasc_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_dt_nasc_<?php echo $sc_seq_vert ?> css_part_dt_nasc__line" style="<?php echo $sStyleReadLab_part_dt_nasc_; ?>"><?php echo $this->form_format_readonly("part_dt_nasc_", $this->form_encode_input($part_dt_nasc_)); ?></span><span id="id_read_off_part_dt_nasc_<?php echo $sc_seq_vert ?>" class="css_read_off_part_dt_nasc_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_dt_nasc_; ?>"><?php
$tmp_form_data = $this->field_config['part_dt_nasc_']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOddMult css_part_dt_nasc__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_dt_nasc_<?php echo $sc_seq_vert ?>" type=text name="part_dt_nasc_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_dt_nasc_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['part_dt_nasc_']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['part_dt_nasc_']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_dt_nasc_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_dt_nasc_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_tam_camisa_']) && $this->nmgp_cmp_hidden['part_tam_camisa_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_tam_camisa_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_tam_camisa_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_tam_camisa__line" id="hidden_field_data_part_tam_camisa_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_tam_camisa_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_tam_camisa__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_tam_camisa_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_tam_camisa_"]) &&  $this->nmgp_cmp_readonly["part_tam_camisa_"] == "on") { 

 ?>
<input type="hidden" name="part_tam_camisa_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_tam_camisa_) . "\">" . $part_tam_camisa_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_tam_camisa_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_tam_camisa_<?php echo $sc_seq_vert ?> css_part_tam_camisa__line" style="<?php echo $sStyleReadLab_part_tam_camisa_; ?>"><?php echo $this->form_format_readonly("part_tam_camisa_", $this->form_encode_input($this->part_tam_camisa_)); ?></span><span id="id_read_off_part_tam_camisa_<?php echo $sc_seq_vert ?>" class="css_read_off_part_tam_camisa_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_tam_camisa_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_tam_camisa__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_tam_camisa_<?php echo $sc_seq_vert ?>" type=text name="part_tam_camisa_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_tam_camisa_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("abcdefghijklmnopqrstuvwxyz") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_tam_camisa_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_tam_camisa_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['part_tam_calcado_']) && $this->nmgp_cmp_hidden['part_tam_calcado_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_tam_calcado_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_tam_calcado_) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOddMult css_part_tam_calcado__line" id="hidden_field_data_part_tam_calcado_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_part_tam_calcado_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_part_tam_calcado__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_part_tam_calcado_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_tam_calcado_"]) &&  $this->nmgp_cmp_readonly["part_tam_calcado_"] == "on") { 

 ?>
<input type="hidden" name="part_tam_calcado_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_tam_calcado_) . "\">" . $part_tam_calcado_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_tam_calcado_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-part_tam_calcado_<?php echo $sc_seq_vert ?> css_part_tam_calcado__line" style="<?php echo $sStyleReadLab_part_tam_calcado_; ?>"><?php echo $this->form_format_readonly("part_tam_calcado_", $this->form_encode_input($this->part_tam_calcado_)); ?></span><span id="id_read_off_part_tam_calcado_<?php echo $sc_seq_vert ?>" class="css_read_off_part_tam_calcado_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_tam_calcado_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_part_tam_calcado__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_tam_calcado_<?php echo $sc_seq_vert ?>" type=text name="part_tam_calcado_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($part_tam_calcado_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_tam_calcado_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_tam_calcado_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_part_id_evento_))
       {
           $this->nmgp_cmp_readonly['part_id_evento_'] = $sCheckRead_part_id_evento_;
       }
       if ('display: none;' == $sStyleHidden_part_id_evento_)
       {
           $this->nmgp_cmp_hidden['part_id_evento_'] = 'off';
       }
       if (isset($sCheckRead_part_cpf_))
       {
           $this->nmgp_cmp_readonly['part_cpf_'] = $sCheckRead_part_cpf_;
       }
       if ('display: none;' == $sStyleHidden_part_cpf_)
       {
           $this->nmgp_cmp_hidden['part_cpf_'] = 'off';
       }
       if (isset($sCheckRead_nome_pessoa_))
       {
           $this->nmgp_cmp_readonly['nome_pessoa_'] = $sCheckRead_nome_pessoa_;
       }
       if ('display: none;' == $sStyleHidden_nome_pessoa_)
       {
           $this->nmgp_cmp_hidden['nome_pessoa_'] = 'off';
       }
       if (isset($sCheckRead_part_sexo_))
       {
           $this->nmgp_cmp_readonly['part_sexo_'] = $sCheckRead_part_sexo_;
       }
       if ('display: none;' == $sStyleHidden_part_sexo_)
       {
           $this->nmgp_cmp_hidden['part_sexo_'] = 'off';
       }
       if (isset($sCheckRead_part_id_evento_publico_))
       {
           $this->nmgp_cmp_readonly['part_id_evento_publico_'] = $sCheckRead_part_id_evento_publico_;
       }
       if ('display: none;' == $sStyleHidden_part_id_evento_publico_)
       {
           $this->nmgp_cmp_hidden['part_id_evento_publico_'] = 'off';
       }
       if (isset($sCheckRead_part_id_evento_regional_))
       {
           $this->nmgp_cmp_readonly['part_id_evento_regional_'] = $sCheckRead_part_id_evento_regional_;
       }
       if ('display: none;' == $sStyleHidden_part_id_evento_regional_)
       {
           $this->nmgp_cmp_hidden['part_id_evento_regional_'] = 'off';
       }
       if (isset($sCheckRead_part_grupo_))
       {
           $this->nmgp_cmp_readonly['part_grupo_'] = $sCheckRead_part_grupo_;
       }
       if ('display: none;' == $sStyleHidden_part_grupo_)
       {
           $this->nmgp_cmp_hidden['part_grupo_'] = 'off';
       }
       if (isset($sCheckRead_part_clube_))
       {
           $this->nmgp_cmp_readonly['part_clube_'] = $sCheckRead_part_clube_;
       }
       if ('display: none;' == $sStyleHidden_part_clube_)
       {
           $this->nmgp_cmp_hidden['part_clube_'] = 'off';
       }
       if (isset($sCheckRead_part_empresa_))
       {
           $this->nmgp_cmp_readonly['part_empresa_'] = $sCheckRead_part_empresa_;
       }
       if ('display: none;' == $sStyleHidden_part_empresa_)
       {
           $this->nmgp_cmp_hidden['part_empresa_'] = 'off';
       }
       if (isset($sCheckRead_part_uf_))
       {
           $this->nmgp_cmp_readonly['part_uf_'] = $sCheckRead_part_uf_;
       }
       if ('display: none;' == $sStyleHidden_part_uf_)
       {
           $this->nmgp_cmp_hidden['part_uf_'] = 'off';
       }
       if (isset($sCheckRead_part_ddd_celular_01_))
       {
           $this->nmgp_cmp_readonly['part_ddd_celular_01_'] = $sCheckRead_part_ddd_celular_01_;
       }
       if ('display: none;' == $sStyleHidden_part_ddd_celular_01_)
       {
           $this->nmgp_cmp_hidden['part_ddd_celular_01_'] = 'off';
       }
       if (isset($sCheckRead_part_celeular_01_))
       {
           $this->nmgp_cmp_readonly['part_celeular_01_'] = $sCheckRead_part_celeular_01_;
       }
       if ('display: none;' == $sStyleHidden_part_celeular_01_)
       {
           $this->nmgp_cmp_hidden['part_celeular_01_'] = 'off';
       }
       if (isset($sCheckRead_part_dt_nasc_))
       {
           $this->nmgp_cmp_readonly['part_dt_nasc_'] = $sCheckRead_part_dt_nasc_;
       }
       if ('display: none;' == $sStyleHidden_part_dt_nasc_)
       {
           $this->nmgp_cmp_hidden['part_dt_nasc_'] = 'off';
       }
       if (isset($sCheckRead_part_tam_camisa_))
       {
           $this->nmgp_cmp_readonly['part_tam_camisa_'] = $sCheckRead_part_tam_camisa_;
       }
       if ('display: none;' == $sStyleHidden_part_tam_camisa_)
       {
           $this->nmgp_cmp_hidden['part_tam_camisa_'] = 'off';
       }
       if (isset($sCheckRead_part_tam_calcado_))
       {
           $this->nmgp_cmp_readonly['part_tam_calcado_'] = $sCheckRead_part_tam_calcado_;
       }
       if ('display: none;' == $sStyleHidden_part_tam_calcado_)
       {
           $this->nmgp_cmp_hidden['part_tam_calcado_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_participantes_rsvp_ar = $guarda_form_vert_form_participantes_rsvp_ar;
   } 
   if ($Table_refresh) 
   { 
       $this->Table_refresh = ob_get_contents();
       ob_end_clean();
   } 
}

function Form_Fim() 
{
   global $sc_seq_vert, $opcao_botoes, $nm_url_saida; 
?>   
</TABLE></div><!-- bloco_f -->
 </div>
 <div id="sc-id-fixedheaders-placeholder" style="display: none; position: fixed; top: 0; z-index: 500"></div>
<?php
$iContrVert = $this->Embutida_form ? $sc_seq_vert + 1 : $sc_seq_vert + 1;
if ($sc_seq_vert < $this->sc_max_reg)
{
    echo " <script type=\"text/javascript\">";
    echo "    bRefreshTable = true;";
    echo "</script>";
}
?>
<input type="hidden" name="sc_contr_vert" value="<?php echo $this->form_encode_input($iContrVert); ?>">
<?php
    $sEmptyStyle = 0 == $sc_seq_vert ? '' : 'display: none;';
?>
</td></tr>
<tr id="sc-ui-empty-form" style="<?php echo $sEmptyStyle; ?>"><td class="scFormPageText" style="padding: 10px; font-weight: bold">
<?php echo $this->Ini->Nm_lang['lang_errm_empt'];
?>
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq('b')", "scBtnFn_sys_GridPermiteSeq('b')", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['qtline'] == "on")
      {
?> 
          <span class="<?php echo $this->css_css_toolbar_obj ?>" style="border: 0px;"><?php echo $this->Ini->Nm_lang['lang_btns_rows'] ?></span>
          <select class="scFormToolbarInput" name="nmgp_quant_linhas_b" onchange="document.F7.nmgp_max_line.value = this.value; document.F7.submit();"> 
<?php 
              $obj_sel = ($this->sc_max_reg == '10') ? " selected" : "";
?> 
           <option value="10" <?php echo $obj_sel ?>>10</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '20') ? " selected" : "";
?> 
           <option value="20" <?php echo $obj_sel ?>>20</option>
<?php 
              $obj_sel = ($this->sc_max_reg == '50') ? " selected" : "";
?> 
           <option value="50" <?php echo $obj_sel ?>>50</option>
          </select>
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8592;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['back'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bretorna", "scBtnFn_sys_format_ret()", "scBtnFn_sys_format_ret()", "sc_b_ret_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8592;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
if ($opcao_botoes != "novo" && $this->nmgp_botoes['navpage'] == "on")
{
?> 
     <span nowrap id="sc_b_navpage_b"></span> 
<?php 
}
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-15';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['btn_label']['last'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bfinal", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8594;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
if ($opcao_botoes != "novo" && $this->nmgp_botoes['summary'] == "on")
{
?> 
     <span nowrap id="sc_b_summary_b"></span> 
<?php 
}
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>
<script>
 var iAjaxNewLine = <?php echo $sc_seq_vert; ?>;
<?php
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['run_modal'])
{
?>
 for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) {
  scJQElementsAdd(iLine);
 }
<?php
}
else
{
?>
 $(function() {
  setTimeout(function() { for (var iLine = 1; iLine <= iAjaxNewLine; iLine++) { scJQElementsAdd(iLine); } }, 250);
 });
<?php
}
?>
</script>
<div id="new_line_dummy" style="display: none">
</div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
   </td></tr></table>
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['masterValue']);
?>
}
<?php
    }
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_participantes_rsvp_ar");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_participantes_rsvp_ar");
 parent.scAjaxDetailHeight("form_participantes_rsvp_ar", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_participantes_rsvp_ar", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_participantes_rsvp_ar", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
    }
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
    $isToast   = isset($this->NM_ajax_info['displayMsgToast']) && $this->NM_ajax_info['displayMsgToast'] ? 'true' : 'false';
    $toastType = $isToast && isset($this->NM_ajax_info['displayMsgToastType']) ? $this->NM_ajax_info['displayMsgToastType'] : '';
?>
<script type="text/javascript">
_scAjaxShowMessage({title: scMsgDefTitle, message: "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: <?php echo $isToast ?>, toastPos: "", type: "<?php echo $toastType ?>"});
</script>
<?php
}
?>
<?php
if (isset($this->scFormFocusErrorName) && '' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<?php
if ($this->nmgp_form_empty) {
?>
<script type="text/javascript">
scAjax_displayEmptyForm();
</script>
<?php
}
?>
<script type="text/javascript">
        function scBtnFn_sys_format_dynamicsearch() {
                if ($("#dynamic_search_t.sc-unique-btn-1").length && $("#dynamic_search_t.sc-unique-btn-1").is(":visible")) {
                    if ($("#dynamic_search_t.sc-unique-btn-1").hasClass("disabled")) {
                        return;
                    }
                        if($('#id_dyn_search_cmd_str').html() != ''){ $('#id_dyn_search_cmd_string').toggle(); } $('#div_dyn_search').toggle(); if($( '#div_dyn_search' ).css( 'display')=='none'){ buttonunselectedDS(); }else{ buttonSelectedDS(); }
                         return;
                }
        }
        function scBtnFn_sys_format_inc() {
                if ($("#sc_b_new_t.sc-unique-btn-2").length && $("#sc_b_new_t.sc-unique-btn-2").is(":visible")) {
                    if ($("#sc_b_new_t.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        do_ajax_form_participantes_rsvp_ar_add_new_line(); return false;
                         return;
                }
                if ($("#sc_b_new_t.sc-unique-btn-3").length && $("#sc_b_new_t.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_new_t.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('novo');
                         return;
                }
                if ($("#sc_b_ins_t.sc-unique-btn-4").length && $("#sc_b_ins_t.sc-unique-btn-4").is(":visible")) {
                    if ($("#sc_b_ins_t.sc-unique-btn-4").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('incluir');
                         return;
                }
        }
        function scBtnFn_sys_format_cnl() {
                if ($("#sc_b_sai_t.sc-unique-btn-5").length && $("#sc_b_sai_t.sc-unique-btn-5").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-5").hasClass("disabled")) {
                        return;
                    }
                        <?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
                         return;
                }
        }
        function scBtnFn_sys_format_alt() {
                if ($("#sc_b_upd_t.sc-unique-btn-6").length && $("#sc_b_upd_t.sc-unique-btn-6").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-6").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                         return;
                }
        }
        function scBtnFn_sys_format_hlp() {
                if ($("#sc_b_hlp_t").length && $("#sc_b_hlp_t").is(":visible")) {
                    if ($("#sc_b_hlp_t").hasClass("disabled")) {
                        return;
                    }
                        window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
                         return;
                }
        }
        function scBtnFn_sys_format_sai() {
                if ($("#sc_b_sai_t.sc-unique-btn-7").length && $("#sc_b_sai_t.sc-unique-btn-7").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-7").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-8").length && $("#sc_b_sai_t.sc-unique-btn-8").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-8").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-9").length && $("#sc_b_sai_t.sc-unique-btn-9").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-9").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-10").length && $("#sc_b_sai_t.sc-unique-btn-10").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-10").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-11").length && $("#sc_b_sai_t.sc-unique-btn-11").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-11").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
        }
        function scBtnFn_sys_GridPermiteSeq(btnPos) {
                if ($("#brec_b").length && $("#brec_b").is(":visible")) {
                    if ($("#brec_b").hasClass("disabled")) {
                        return;
                    }
                        if (document.F1['nmgp_rec_' + btnPos].value != '') {nm_navpage(document.F1['nmgp_rec_' + btnPos].value, 'P');} document.F1['nmgp_rec_' + btnPos].value = '';
                         return;
                }
        }
        function scBtnFn_sys_format_ini() {
                if ($("#sc_b_ini_b.sc-unique-btn-12").length && $("#sc_b_ini_b.sc-unique-btn-12").is(":visible")) {
                    if ($("#sc_b_ini_b.sc-unique-btn-12").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('inicio');
                         return;
                }
        }
        function scBtnFn_sys_format_ret() {
                if ($("#sc_b_ret_b.sc-unique-btn-13").length && $("#sc_b_ret_b.sc-unique-btn-13").is(":visible")) {
                    if ($("#sc_b_ret_b.sc-unique-btn-13").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('retorna');
                         return;
                }
        }
        function scBtnFn_sys_format_ava() {
                if ($("#sc_b_avc_b.sc-unique-btn-14").length && $("#sc_b_avc_b.sc-unique-btn-14").is(":visible")) {
                    if ($("#sc_b_avc_b.sc-unique-btn-14").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('avanca');
                         return;
                }
        }
        function scBtnFn_sys_format_fim() {
                if ($("#sc_b_fim_b.sc-unique-btn-15").length && $("#sc_b_fim_b.sc-unique-btn-15").is(":visible")) {
                    if ($("#sc_b_fim_b.sc-unique-btn-15").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('final');
                         return;
                }
        }
</script>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_participantes_rsvp_ar']['inside_nested_iframe']) {
?>
<script>
    function resizeFormIframe(resizeAttempt)
    {
        if (6 == resizeAttempt) {
            return;
        }

        let thisBody = document.body;
        let thisHtml = document.documentElement;
        let thisStyles = window.getComputedStyle(thisBody);
        let marginTop = parseFloat(thisStyles.marginTop) || 0;
        let marginBottom = parseFloat(thisStyles.marginBottom) || 0;
        let formHeight = Math.max(
            thisBody.scrollHeight, thisBody.offsetHeight,
            thisHtml.clientHeight, thisHtml.scrollHeight, thisHtml.offsetHeight
        ) + marginTop + marginBottom;

        if ("" == formHeight || 0 == formHeight || "0" == formHeight) {
            setTimeout(function() { resizeFormIframe(resizeAttempt + 1); }, 50);
            return;
        }

        if (window.frameElement) {
            let tbWindow = $(window.frameElement).parent();
            if (tbWindow.length && "TB_window" == tbWindow.attr("id")) {
                tbWindow.css("height", formHeight + 'px');
                window.frameElement.style.height = "100%";
            } else {
                window.frameElement.style.height = formHeight + "px";
            }
        }

        if ("function" == typeof window.parent.resizeNestedGridIframeHeight) {
            window.parent.resizeNestedGridIframeHeight(formHeight, 80);
        }
    }
    $(function() {
        resizeFormIframe(1);
    });
</script>
<?php
}
?>
<script type="text/javascript">
   function sc_session_redir(url_redir)
   {
       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
       {
           window.parent.sc_session_redir(url_redir);
       }
       else
       {
           if (window.opener && typeof window.opener.sc_session_redir === 'function')
           {
               window.close();
               window.opener.sc_session_redir(url_redir);
           }
           else
           {
               window.location = url_redir;
           }
       }
   }
</script>
</body> 
</html> 
<?php 
 } 
} 
?> 
