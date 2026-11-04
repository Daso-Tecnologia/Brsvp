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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("BRSVP - Acompanhantes Inclusão"); } else { echo strip_tags("BRSVP - Acompanhantes Modificação"); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
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
<?php
foreach ($this->Ini->tippy_themes as $tippyTheme => $tippyThemeInfo) {
?>
 <link rel="stylesheet" href="<?php echo $tippyThemeInfo['file'] ?>" />
<?php
}
?>
 <script src="<?php echo $this->Ini->path_prod; ?>/third/tippyjs/popper.min.js"></script>
 <script src="<?php echo $this->Ini->path_prod; ?>/third/tippyjs/tippy-bundle.umd.min.js"></script>
 <script>
  $(function() {
  });
 </script>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/viewerjs/viewer.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/viewerjs/viewer.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
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
.css_read_off_part_dt_nasc button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_emissao_passaporte button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_validade_pass button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_validade_visto button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_cadastro button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_alteracao button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_alt_contato_rsvp button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_alt_presenca button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_solicit_especial button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_programacao button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_aereo button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_par_dt_hospedagem button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_transfer button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_dt_opcionais button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_part_save_the_date button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_acompanhantes_rsvp/form_acompanhantes_rsvp_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_acompanhantes_rsvp_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['last'] : 'off'); ?>";
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
    nm_sumario = "[<?php echo substr($this->Ini->Nm_lang['lang_othr_smry_info'], strpos($this->Ini->Nm_lang['lang_othr_smry_info'], "?final?")) ?>]";
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

include_once('form_acompanhantes_rsvp_jquery.php');

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
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

<?php
if (!isset($this->scFormFocusErrorName) || '' == $this->scFormFocusErrorName)
{
?>
  scFocusField('part_cpf');

<?php
}
?>
  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  sc_form_onload();

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['recarga'];
}
if ('' != $this->part_cpf)
{
    $this->lookup_part_cpf($look_rpc_part_cpf);
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['link_info']['remove_border']) {
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
    $vertical_center = 'display: flex; flex-direction: column; justify-content: center; margin: 0px; min-height: 100vh;';
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
 include_once("form_acompanhantes_rsvp_js0.php");
?>
<script type="text/javascript" src="<?php  echo $this->Ini->path_js . "/jsrsClient.js" ?>"> 
</script> 
<script type="text/javascript"> 
nmdg_enter_tab = true;
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
<form  name="F1" method="post" 
               action="./" 
               onsubmit="return false;" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['insert_validation']; ?>">
<?php
}
?>
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
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_acompanhantes_rsvp'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_acompanhantes_rsvp'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['fast_search'][2] : "";
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
          $SC_Label_atu['participante_id'] = (isset($this->nm_new_label['participante_id'])) ? $this->nm_new_label['participante_id'] : 'Participante Id'; 
          $SC_Label_atu['part_cpf_mestre'] = (isset($this->nm_new_label['part_cpf_mestre'])) ? $this->nm_new_label['part_cpf_mestre'] : 'ID: Participante:'; 
          $SC_Label_atu['part_cpf'] = (isset($this->nm_new_label['part_cpf'])) ? $this->nm_new_label['part_cpf'] : 'ID:'; 
          $SC_Label_atu['part_ativo'] = (isset($this->nm_new_label['part_ativo'])) ? $this->nm_new_label['part_ativo'] : 'Ativo:'; 
          $SC_Label_atu['part_tipo'] = (isset($this->nm_new_label['part_tipo'])) ? $this->nm_new_label['part_tipo'] : 'Tipo:'; 
          $SC_Label_atu['part_sexo'] = (isset($this->nm_new_label['part_sexo'])) ? $this->nm_new_label['part_sexo'] : 'Sexo:'; 
          $SC_Label_atu['enviar_app'] = (isset($this->nm_new_label['enviar_app'])) ? $this->nm_new_label['enviar_app'] : 'Gravar no APP:'; 
          $SC_Label_atu['part_nome_cracha'] = (isset($this->nm_new_label['part_nome_cracha'])) ? $this->nm_new_label['part_nome_cracha'] : 'Nome Crachá:'; 
          $SC_Label_atu['part_id_evento'] = (isset($this->nm_new_label['part_id_evento'])) ? $this->nm_new_label['part_id_evento'] : 'Evento:'; 
          $SC_Label_atu['part_id_evento_publico'] = (isset($this->nm_new_label['part_id_evento_publico'])) ? $this->nm_new_label['part_id_evento_publico'] : 'Público:'; 
          $SC_Label_atu['part_id_evento_regional'] = (isset($this->nm_new_label['part_id_evento_regional'])) ? $this->nm_new_label['part_id_evento_regional'] : 'Regional:'; 
          $SC_Label_atu['part_tipo_pessoa'] = (isset($this->nm_new_label['part_tipo_pessoa'])) ? $this->nm_new_label['part_tipo_pessoa'] : 'Tipo Pessoa:'; 
          $SC_Label_atu['part_dt_nasc'] = (isset($this->nm_new_label['part_dt_nasc'])) ? $this->nm_new_label['part_dt_nasc'] : 'Data Nascimento:'; 
          $SC_Label_atu['part_filiacao'] = (isset($this->nm_new_label['part_filiacao'])) ? $this->nm_new_label['part_filiacao'] : 'Filiação:'; 
          $SC_Label_atu['estrangeiro'] = (isset($this->nm_new_label['estrangeiro'])) ? $this->nm_new_label['estrangeiro'] : 'Estrangeiro:'; 
          $SC_Label_atu['part_substituido'] = (isset($this->nm_new_label['part_substituido'])) ? $this->nm_new_label['part_substituido'] : 'Substituido:'; 
          $SC_Label_atu['part_empresa'] = (isset($this->nm_new_label['part_empresa'])) ? $this->nm_new_label['part_empresa'] : 'Empresa:'; 
          $SC_Label_atu['part_departamento'] = (isset($this->nm_new_label['part_departamento'])) ? $this->nm_new_label['part_departamento'] : 'Departamento:'; 
          $SC_Label_atu['part_cargo'] = (isset($this->nm_new_label['part_cargo'])) ? $this->nm_new_label['part_cargo'] : 'Cargo:'; 
          $SC_Label_atu['part_grupo'] = (isset($this->nm_new_label['part_grupo'])) ? $this->nm_new_label['part_grupo'] : 'Grupo:'; 
          $SC_Label_atu['part_clube'] = (isset($this->nm_new_label['part_clube'])) ? $this->nm_new_label['part_clube'] : 'Clube:'; 
          $SC_Label_atu['dsc_empresa_rsvp'] = (isset($this->nm_new_label['dsc_empresa_rsvp'])) ? $this->nm_new_label['dsc_empresa_rsvp'] : 'Empresa do Evento:'; 
          $SC_Label_atu['cod_empresa_rsvp'] = (isset($this->nm_new_label['cod_empresa_rsvp'])) ? $this->nm_new_label['cod_empresa_rsvp'] : 'Cód. Empresa:'; 
          $SC_Label_atu['part_cep'] = (isset($this->nm_new_label['part_cep'])) ? $this->nm_new_label['part_cep'] : 'CEP:'; 
          $SC_Label_atu['part_logradouro'] = (isset($this->nm_new_label['part_logradouro'])) ? $this->nm_new_label['part_logradouro'] : 'Logradouro:'; 
          $SC_Label_atu['part_numero'] = (isset($this->nm_new_label['part_numero'])) ? $this->nm_new_label['part_numero'] : 'Número:'; 
          $SC_Label_atu['part_complemento'] = (isset($this->nm_new_label['part_complemento'])) ? $this->nm_new_label['part_complemento'] : 'Complemento:'; 
          $SC_Label_atu['part_bairro'] = (isset($this->nm_new_label['part_bairro'])) ? $this->nm_new_label['part_bairro'] : 'Bairro:'; 
          $SC_Label_atu['part_cidade'] = (isset($this->nm_new_label['part_cidade'])) ? $this->nm_new_label['part_cidade'] : 'Cidade:'; 
          $SC_Label_atu['part_uf'] = (isset($this->nm_new_label['part_uf'])) ? $this->nm_new_label['part_uf'] : 'UF:'; 
          $SC_Label_atu['part_ddd_01'] = (isset($this->nm_new_label['part_ddd_01'])) ? $this->nm_new_label['part_ddd_01'] : 'DDD fone 01:'; 
          $SC_Label_atu['part_fone_01'] = (isset($this->nm_new_label['part_fone_01'])) ? $this->nm_new_label['part_fone_01'] : 'Fone 01:'; 
          $SC_Label_atu['part_ddd_celular_01'] = (isset($this->nm_new_label['part_ddd_celular_01'])) ? $this->nm_new_label['part_ddd_celular_01'] : 'DDD Celular 01:'; 
          $SC_Label_atu['part_celeular_01'] = (isset($this->nm_new_label['part_celeular_01'])) ? $this->nm_new_label['part_celeular_01'] : 'Celular 01:'; 
          $SC_Label_atu['codigo_telefone_internacional'] = (isset($this->nm_new_label['codigo_telefone_internacional'])) ? $this->nm_new_label['codigo_telefone_internacional'] : 'Código Telefone Internacional:'; 
          $SC_Label_atu['part_fone_internacional'] = (isset($this->nm_new_label['part_fone_internacional'])) ? $this->nm_new_label['part_fone_internacional'] : ' Fone Internacional:'; 
          $SC_Label_atu['part_rg'] = (isset($this->nm_new_label['part_rg'])) ? $this->nm_new_label['part_rg'] : 'RG:'; 
          $SC_Label_atu['part_passaporte'] = (isset($this->nm_new_label['part_passaporte'])) ? $this->nm_new_label['part_passaporte'] : 'Passaporte:'; 
          $SC_Label_atu['emissao_passaporte'] = (isset($this->nm_new_label['emissao_passaporte'])) ? $this->nm_new_label['emissao_passaporte'] : 'Emissão Passaporte:'; 
          $SC_Label_atu['part_validade_pass'] = (isset($this->nm_new_label['part_validade_pass'])) ? $this->nm_new_label['part_validade_pass'] : 'Validade Passaporte:'; 
          $SC_Label_atu['part_passaporte_estrangeiro'] = (isset($this->nm_new_label['part_passaporte_estrangeiro'])) ? $this->nm_new_label['part_passaporte_estrangeiro'] : 'Passaporte Estrangeiro:'; 
          $SC_Label_atu['part_cpf_informado'] = (isset($this->nm_new_label['part_cpf_informado'])) ? $this->nm_new_label['part_cpf_informado'] : 'CPF'; 
          $SC_Label_atu['part_nacionalidade'] = (isset($this->nm_new_label['part_nacionalidade'])) ? $this->nm_new_label['part_nacionalidade'] : 'Nacionalidade (APP):'; 
          $SC_Label_atu['part_vacina_fa'] = (isset($this->nm_new_label['part_vacina_fa'])) ? $this->nm_new_label['part_vacina_fa'] : 'Vacina Febre Amarela (APP):'; 
          $SC_Label_atu['validade_visto'] = (isset($this->nm_new_label['validade_visto'])) ? $this->nm_new_label['validade_visto'] : 'Validade Visto (APP):'; 
          $SC_Label_atu['numero_visto'] = (isset($this->nm_new_label['numero_visto'])) ? $this->nm_new_label['numero_visto'] : 'Número(s) Visto(s) (APP):'; 
          $SC_Label_atu['part_visto'] = (isset($this->nm_new_label['part_visto'])) ? $this->nm_new_label['part_visto'] : 'Número(s) Visto(s) (APP):'; 
          $SC_Label_atu['part_tam_camisa'] = (isset($this->nm_new_label['part_tam_camisa'])) ? $this->nm_new_label['part_tam_camisa'] : 'Tamanho Camisa:'; 
          $SC_Label_atu['part_tam_calcado'] = (isset($this->nm_new_label['part_tam_calcado'])) ? $this->nm_new_label['part_tam_calcado'] : 'Tamanho Calçado:'; 
          $SC_Label_atu['part_idioma'] = (isset($this->nm_new_label['part_idioma'])) ? $this->nm_new_label['part_idioma'] : 'Idioma:'; 
          $SC_Label_atu['idioma_preferido'] = (isset($this->nm_new_label['idioma_preferido'])) ? $this->nm_new_label['idioma_preferido'] : 'Idioma Preferido(APP):'; 
          $SC_Label_atu['part_pais'] = (isset($this->nm_new_label['part_pais'])) ? $this->nm_new_label['part_pais'] : 'Pais:'; 
          $SC_Label_atu['pais'] = (isset($this->nm_new_label['pais'])) ? $this->nm_new_label['pais'] : 'Pais (APP):'; 
          $SC_Label_atu['part_destaque_negrito'] = (isset($this->nm_new_label['part_destaque_negrito'])) ? $this->nm_new_label['part_destaque_negrito'] : 'Destaque Negrito:'; 
          $SC_Label_atu['part_fumante'] = (isset($this->nm_new_label['part_fumante'])) ? $this->nm_new_label['part_fumante'] : 'Fumante:'; 
          $SC_Label_atu['part_restricao_alimentar'] = (isset($this->nm_new_label['part_restricao_alimentar'])) ? $this->nm_new_label['part_restricao_alimentar'] : 'Restrição Alimentar:'; 
          $SC_Label_atu['restricao_mobilidade'] = (isset($this->nm_new_label['restricao_mobilidade'])) ? $this->nm_new_label['restricao_mobilidade'] : 'Restrição Mobilidade:'; 
          $SC_Label_atu['part_cv_obs'] = (isset($this->nm_new_label['part_cv_obs'])) ? $this->nm_new_label['part_cv_obs'] : 'Observações Voucher:'; 
          $SC_Label_atu['uid_pulseira_nfc'] = (isset($this->nm_new_label['uid_pulseira_nfc'])) ? $this->nm_new_label['uid_pulseira_nfc'] : 'Cód. Pulseira NFC:'; 
          $SC_Label_atu['roles_app'] = (isset($this->nm_new_label['roles_app'])) ? $this->nm_new_label['roles_app'] : 'Status no APP:'; 
          $SC_Label_atu['id_evento_app'] = (isset($this->nm_new_label['id_evento_app'])) ? $this->nm_new_label['id_evento_app'] : 'Id Evento APP:'; 
          $SC_Label_atu['external_id'] = (isset($this->nm_new_label['external_id'])) ? $this->nm_new_label['external_id'] : 'External Id:'; 
          $SC_Label_atu['id_participante_app'] = (isset($this->nm_new_label['id_participante_app'])) ? $this->nm_new_label['id_participante_app'] : 'Id Participante App'; 
          $SC_Label_atu['external_status'] = (isset($this->nm_new_label['external_status'])) ? $this->nm_new_label['external_status'] : 'External Status:'; 
          $SC_Label_atu['part_email'] = (isset($this->nm_new_label['part_email'])) ? $this->nm_new_label['part_email'] : 'Email:'; 
          $SC_Label_atu['part_nome_secretaria'] = (isset($this->nm_new_label['part_nome_secretaria'])) ? $this->nm_new_label['part_nome_secretaria'] : 'Nome Secretaria:'; 
          $SC_Label_atu['part_email_secretaria'] = (isset($this->nm_new_label['part_email_secretaria'])) ? $this->nm_new_label['part_email_secretaria'] : 'Email Secretaria:'; 
          $SC_Label_atu['part_cod_substituido'] = (isset($this->nm_new_label['part_cod_substituido'])) ? $this->nm_new_label['part_cod_substituido'] : 'Part Cod Substituido'; 
          $SC_Label_atu['part_nome_substituido'] = (isset($this->nm_new_label['part_nome_substituido'])) ? $this->nm_new_label['part_nome_substituido'] : 'Part Nome Substituido'; 
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
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Enter)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['insert'];
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
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Escape)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + S)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Delete)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ($opcao_botoes == "novo")) {
        $sCondStyle = ($this->nmgp_botoes['Pessoas'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['pessoas']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['pessoas']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['pessoas']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['pessoas']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['pessoas'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "pessoas", "scBtnFn_Pessoas()", "scBtnFn_Pessoas()", "sc_Pessoas_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && ($opcao_botoes == "novo")) {
        $sCondStyle = ($this->nmgp_botoes['Pessoas'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['pessoas']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['pessoas']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['pessoas']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['pessoas']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['pessoas'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "pessoas", "scBtnFn_Pessoas()", "scBtnFn_Pessoas()", "sc_Pessoas_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R")
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
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
   if (!isset($this->nmgp_cmp_hidden['part_cod_substituido']))
   {
       $this->nmgp_cmp_hidden['part_cod_substituido'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['part_nome_substituido']))
   {
       $this->nmgp_cmp_hidden['part_nome_substituido'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['part_visto']))
   {
       $this->nmgp_cmp_hidden['part_visto'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['cpf_del']))
   {
       $this->nmgp_cmp_hidden['cpf_del'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['nome']))
   {
       $this->nmgp_cmp_hidden['nome'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['sql_log']))
   {
       $this->nmgp_cmp_hidden['sql_log'] = 'off';
   }
?>
<script type="text/javascript">
function sc_change_tabs(bTabDisp, sTabId, sTabParts)
{
  if (document.getElementById(sTabId)) {
    if (bTabDisp) {
      document.getElementById("div_" + sTabId).style.width = "";
      document.getElementById("div_" + sTabId).style.height = "";
      document.getElementById("div_" + sTabId).style.display = "";
      document.getElementById("div_" + sTabId).style.overflow = "visible";
      document.getElementById(sTabParts).className = "scTabActive";
    }
    else {
      document.getElementById("div_" + sTabId).style.width = "1px";
      document.getElementById("div_" + sTabId).style.height = "0px";
      document.getElementById("div_" + sTabId).style.display = "none";
      document.getElementById("div_" + sTabId).style.overflow = "scroll";
      document.getElementById(sTabParts).className = "scTabInactive";
    }
    nm_field_disabled("nome=disabled;part_tipo=disabled", "");
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
  }
}
</script>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['participante_id']))
           {
               $this->nmgp_cmp_readonly['participante_id'] = 'on';
           }
?>
<script type="text/javascript">
function sc_control_tabs_0(iTabIndex)
{
  sc_change_tabs(iTabIndex == 0, 'hidden_bloco_0', 'id_tabs_0_0');
  if (iTabIndex == 0) {
    displayChange_block("0", "on");
  }
  sc_change_tabs(iTabIndex == 1, 'hidden_bloco_1', 'id_tabs_0_1');
  if (iTabIndex == 1) {
    displayChange_block("1", "on");
  }
  sc_change_tabs(iTabIndex == 2, 'hidden_bloco_2', 'id_tabs_0_2');
  if (iTabIndex == 2) {
    displayChange_block("2", "on");
  }
  sc_change_tabs(iTabIndex == 3, 'hidden_bloco_3', 'id_tabs_0_3');
  if (iTabIndex == 3) {
    displayChange_block("3", "on");
  }
  sc_change_tabs(iTabIndex == 4, 'hidden_bloco_4', 'id_tabs_0_4');
  if (iTabIndex == 4) {
    displayChange_block("4", "on");
  }
  sc_change_tabs(iTabIndex == 5, 'hidden_bloco_5', 'id_tabs_0_5');
  if (iTabIndex == 5) {
    displayChange_block("5", "on");
  }
  sc_change_tabs(iTabIndex == 6, 'hidden_bloco_6', 'id_tabs_0_6');
  if (iTabIndex == 6) {
    displayChange_block("6", "on");
  }
  sc_change_tabs(iTabIndex == 7, 'hidden_bloco_7', 'id_tabs_0_7');
  if (iTabIndex == 7) {
    displayChange_block("7", "on");
  }
}
</script>
<ul class="scTabLine">
<li id="id_tabs_0_0" class="scTabActive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(0)">Informações Básicas</a></li>
<li id="id_tabs_0_1" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(1)">Substituição</a></li>
<li id="id_tabs_0_2" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(2)">Informações da Empresa</a></li>
<li id="id_tabs_0_3" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(3)">Endereço</a></li>
<li id="id_tabs_0_4" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(4)">Contato</a></li>
<li id="id_tabs_0_5" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(5)">Documentação</a></li>
<li id="id_tabs_0_6" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(6)">Informações Extras</a></li>
<li id="id_tabs_0_7" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(7)">Email´s</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['participante_id']))
    {
        $this->nm_new_label['participante_id'] = "Participante Id";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $participante_id = $this->participante_id;
   $sStyleHidden_participante_id = '';
   if (isset($this->nmgp_cmp_hidden['participante_id']) && $this->nmgp_cmp_hidden['participante_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['participante_id']);
       $sStyleHidden_participante_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_participante_id = 'display: none;';
   $sStyleReadInp_participante_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["participante_id"]) &&  $this->nmgp_cmp_readonly["participante_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['participante_id']);
       $sStyleReadLab_participante_id = '';
       $sStyleReadInp_participante_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['participante_id']) && $this->nmgp_cmp_hidden['participante_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="participante_id" value="<?php echo $this->form_encode_input($participante_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_participante_id_label" id="hidden_field_label_participante_id" style="<?php echo $sStyleHidden_participante_id; ?>"><span id="id_label_participante_id"><?php echo $this->nm_new_label['participante_id']; ?></span></TD>
    <TD class="scFormDataOdd css_participante_id_line" id="hidden_field_data_participante_id" style="<?php echo $sStyleHidden_participante_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_participante_id_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_participante_id" class="css_participante_id_line" style="<?php echo $sStyleReadLab_participante_id; ?>"><?php echo $this->form_format_readonly("participante_id", $this->form_encode_input($this->participante_id)); ?></span><span id="id_read_off_participante_id" class="css_read_off_participante_id" style="<?php echo $sStyleReadInp_participante_id; ?>"><input type="hidden" name="participante_id" value="<?php echo $this->form_encode_input($participante_id) . "\">"?><span id="id_ajax_label_participante_id"><?php echo nl2br($participante_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_participante_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_participante_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_cpf_mestre']))
    {
        $this->nm_new_label['part_cpf_mestre'] = "ID: Participante:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_cpf_mestre = $this->part_cpf_mestre;
   $sStyleHidden_part_cpf_mestre = '';
   if (isset($this->nmgp_cmp_hidden['part_cpf_mestre']) && $this->nmgp_cmp_hidden['part_cpf_mestre'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_cpf_mestre']);
       $sStyleHidden_part_cpf_mestre = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_cpf_mestre = 'display: none;';
   $sStyleReadInp_part_cpf_mestre = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_cpf_mestre']) && $this->nmgp_cmp_readonly['part_cpf_mestre'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_cpf_mestre']);
       $sStyleReadLab_part_cpf_mestre = '';
       $sStyleReadInp_part_cpf_mestre = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_cpf_mestre']) && $this->nmgp_cmp_hidden['part_cpf_mestre'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_cpf_mestre" value="<?php echo $this->form_encode_input($part_cpf_mestre) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_cpf_mestre_label" id="hidden_field_label_part_cpf_mestre" style="<?php echo $sStyleHidden_part_cpf_mestre; ?>"><span id="id_label_part_cpf_mestre"><?php echo $this->nm_new_label['part_cpf_mestre']; ?></span></TD>
    <TD class="scFormDataOdd css_part_cpf_mestre_line" id="hidden_field_data_part_cpf_mestre" style="<?php echo $sStyleHidden_part_cpf_mestre; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_cpf_mestre_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="part_cpf_mestre" value="<?php echo $this->form_encode_input($part_cpf_mestre); ?>"><span id="id_ajax_label_part_cpf_mestre"><?php echo nl2br($part_cpf_mestre); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_cpf_mestre_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_cpf_mestre_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nome_part_mestre']))
    {
        $this->nm_new_label['nome_part_mestre'] = "Nome do Participante:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nome_part_mestre = $this->nome_part_mestre;
   $sStyleHidden_nome_part_mestre = '';
   if (isset($this->nmgp_cmp_hidden['nome_part_mestre']) && $this->nmgp_cmp_hidden['nome_part_mestre'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nome_part_mestre']);
       $sStyleHidden_nome_part_mestre = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nome_part_mestre = 'display: none;';
   $sStyleReadInp_nome_part_mestre = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nome_part_mestre']) && $this->nmgp_cmp_readonly['nome_part_mestre'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nome_part_mestre']);
       $sStyleReadLab_nome_part_mestre = '';
       $sStyleReadInp_nome_part_mestre = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nome_part_mestre']) && $this->nmgp_cmp_hidden['nome_part_mestre'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nome_part_mestre" value="<?php echo $this->form_encode_input($nome_part_mestre) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_nome_part_mestre_label" id="hidden_field_label_nome_part_mestre" style="<?php echo $sStyleHidden_nome_part_mestre; ?>"><span id="id_label_nome_part_mestre"><?php echo $this->nm_new_label['nome_part_mestre']; ?></span></TD>
    <TD class="scFormDataOdd css_nome_part_mestre_line" id="hidden_field_data_nome_part_mestre" style="<?php echo $sStyleHidden_nome_part_mestre; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nome_part_mestre_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="nome_part_mestre" value="<?php echo $this->form_encode_input($nome_part_mestre); ?>"><span id="id_ajax_label_nome_part_mestre"><?php echo nl2br($nome_part_mestre); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_part_mestre_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_part_mestre_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['importacao']))
    {
        $this->nm_new_label['importacao'] = "IMPORTAR DE:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $importacao = $this->importacao;
   $sStyleHidden_importacao = '';
   if (isset($this->nmgp_cmp_hidden['importacao']) && $this->nmgp_cmp_hidden['importacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['importacao']);
       $sStyleHidden_importacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_importacao = 'display: none;';
   $sStyleReadInp_importacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['importacao']) && $this->nmgp_cmp_readonly['importacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['importacao']);
       $sStyleReadLab_importacao = '';
       $sStyleReadInp_importacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['importacao']) && $this->nmgp_cmp_hidden['importacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="importacao" value="<?php echo $this->form_encode_input($importacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_importacao_label" id="hidden_field_label_importacao" style="<?php echo $sStyleHidden_importacao; ?>"><span id="id_label_importacao"><?php echo $this->nm_new_label['importacao']; ?></span></TD>
    <TD class="scFormDataOdd css_importacao_line" id="hidden_field_data_importacao" style="<?php echo $sStyleHidden_importacao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_importacao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["importacao"]) &&  $this->nmgp_cmp_readonly["importacao"] == "on") { 

 if ("P" == $this->importacao) { $importacao_look = "Pessoas";} 
 if ("E" == $this->importacao) { $importacao_look = "Eventos (Outras Participações)";} 
?>
<input type="hidden" name="importacao" value="<?php echo $this->form_encode_input($importacao) . "\">" . $importacao_look . ""; ?>
<?php } else { ?>

<?php

 if ("P" == $this->importacao) { $importacao_look = "Pessoas";} 
 if ("E" == $this->importacao) { $importacao_look = "Eventos (Outras Participações)";} 
?>
<span id="id_read_on_importacao"  class="css_importacao_line" style="<?php echo $sStyleReadLab_importacao; ?>"><?php echo $this->form_format_readonly("importacao", $this->form_encode_input($importacao_look)); ?></span><span id="id_read_off_importacao" class="css_read_off_importacao css_importacao_line" style="<?php echo $sStyleReadInp_importacao; ?>"><div id="idAjaxRadio_importacao" style="display: inline-block"  class="css_importacao_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_importacao_line"><?php $tempOptionId = "id-opt-importacao" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-importacao sc-ui-radio-importacao sc-js-input" type=radio name="importacao" value="P"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_importacao'][] = 'P'; ?>
<?php  if ("P" == $this->importacao)  { echo " checked" ;} ?><?php  if (empty($this->importacao)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Pessoas</label></TD>
  <TD class="scFormDataFontOdd css_importacao_line"><?php $tempOptionId = "id-opt-importacao" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-importacao sc-ui-radio-importacao sc-js-input" type=radio name="importacao" value="E"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_importacao'][] = 'E'; ?>
<?php  if ("E" == $this->importacao)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Eventos (Outras Participações)</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_importacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_importacao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['nacionalidade']))
   {
       $this->nm_new_label['nacionalidade'] = "Nacionalidade:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nacionalidade = $this->nacionalidade;
   $sStyleHidden_nacionalidade = '';
   if (isset($this->nmgp_cmp_hidden['nacionalidade']) && $this->nmgp_cmp_hidden['nacionalidade'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nacionalidade']);
       $sStyleHidden_nacionalidade = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nacionalidade = 'display: none;';
   $sStyleReadInp_nacionalidade = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nacionalidade']) && $this->nmgp_cmp_readonly['nacionalidade'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nacionalidade']);
       $sStyleReadLab_nacionalidade = '';
       $sStyleReadInp_nacionalidade = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nacionalidade']) && $this->nmgp_cmp_hidden['nacionalidade'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="nacionalidade" value="<?php echo $this->form_encode_input($this->nacionalidade) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_nacionalidade_label" id="hidden_field_label_nacionalidade" style="<?php echo $sStyleHidden_nacionalidade; ?>"><span id="id_label_nacionalidade"><?php echo $this->nm_new_label['nacionalidade']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['php_cmp_required']['nacionalidade']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['php_cmp_required']['nacionalidade'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_nacionalidade_line" id="hidden_field_data_nacionalidade" style="<?php echo $sStyleHidden_nacionalidade; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nacionalidade_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nacionalidade"]) &&  $this->nmgp_cmp_readonly["nacionalidade"] == "on") { 

$nacionalidade_look = "";
 if ($this->nacionalidade == "B") { $nacionalidade_look .= "Brasileira" ;} 
 if ($this->nacionalidade == "E") { $nacionalidade_look .= "Estrangeira" ;} 
 if (empty($nacionalidade_look)) { $nacionalidade_look = $this->nacionalidade; }
?>
<input type="hidden" name="nacionalidade" value="<?php echo $this->form_encode_input($nacionalidade) . "\">" . $nacionalidade_look . ""; ?>
<?php } else { ?>
<?php

$nacionalidade_look = "";
 if ($this->nacionalidade == "B") { $nacionalidade_look .= "Brasileira" ;} 
 if ($this->nacionalidade == "E") { $nacionalidade_look .= "Estrangeira" ;} 
 if (empty($nacionalidade_look)) { $nacionalidade_look = $this->nacionalidade; }
?>
<span id="id_read_on_nacionalidade" class="css_nacionalidade_line"  style="<?php echo $sStyleReadLab_nacionalidade; ?>"><?php echo $this->form_format_readonly("nacionalidade", $this->form_encode_input($nacionalidade_look)); ?></span><span id="id_read_off_nacionalidade" class="css_read_off_nacionalidade<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_nacionalidade; ?>">
 <span id="idAjaxSelect_nacionalidade" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_nacionalidade_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nacionalidade" name="nacionalidade" size="1" alt="{type: 'select', enterTab: true}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_nacionalidade'][] = ''; ?>
 <option value="">.:selecione:.</option>
 <option  value="B" <?php  if ($this->nacionalidade == "B") { echo " selected" ;} ?>>Brasileira</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_nacionalidade'][] = 'B'; ?>
 <option  value="E" <?php  if ($this->nacionalidade == "E") { echo " selected" ;} ?>>Estrangeira</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_nacionalidade'][] = 'E'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nacionalidade_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nacionalidade_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_cpf']))
    {
        $this->nm_new_label['part_cpf'] = "ID:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_cpf = $this->part_cpf;
   $sStyleHidden_part_cpf = '';
   if (isset($this->nmgp_cmp_hidden['part_cpf']) && $this->nmgp_cmp_hidden['part_cpf'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_cpf']);
       $sStyleHidden_part_cpf = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_cpf = 'display: none;';
   $sStyleReadInp_part_cpf = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_cpf']) && $this->nmgp_cmp_readonly['part_cpf'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_cpf']);
       $sStyleReadLab_part_cpf = '';
       $sStyleReadInp_part_cpf = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_cpf']) && $this->nmgp_cmp_hidden['part_cpf'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_cpf" value="<?php echo $this->form_encode_input($part_cpf) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_cpf_label" id="hidden_field_label_part_cpf" style="<?php echo $sStyleHidden_part_cpf; ?>"><span id="id_label_part_cpf"><?php echo $this->nm_new_label['part_cpf']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['php_cmp_required']['part_cpf']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['php_cmp_required']['part_cpf'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_part_cpf_line" id="hidden_field_data_part_cpf" style="<?php echo $sStyleHidden_part_cpf; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_cpf_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_cpf"]) &&  $this->nmgp_cmp_readonly["part_cpf"] == "on") { 

 ?>
<input type="hidden" name="part_cpf" value="<?php echo $this->form_encode_input($part_cpf) . "\">" . $part_cpf . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_cpf" class="sc-ui-readonly-part_cpf css_part_cpf_line" style="<?php echo $sStyleReadLab_part_cpf; ?>"><?php echo $this->form_format_readonly("part_cpf", $this->form_encode_input($this->part_cpf)); ?></span><span id="id_read_off_part_cpf" class="css_read_off_part_cpf<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_cpf; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_cpf_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_cpf" type=text name="part_cpf" value="<?php echo $this->form_encode_input($part_cpf) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=12"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
 <SPAN id="id_lookup_part_cpf" style="color: #0000FF"><?php echo $look_rpc_part_cpf; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_cpf_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_cpf_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nome']))
    {
        $this->nm_new_label['nome'] = "Nome:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nome = $this->nome;
   if (!isset($this->nmgp_cmp_hidden['nome']))
   {
       $this->nmgp_cmp_hidden['nome'] = 'off';
   }
   $sStyleHidden_nome = '';
   if (isset($this->nmgp_cmp_hidden['nome']) && $this->nmgp_cmp_hidden['nome'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nome']);
       $sStyleHidden_nome = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nome = 'display: none;';
   $sStyleReadInp_nome = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nome']) && $this->nmgp_cmp_readonly['nome'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nome']);
       $sStyleReadLab_nome = '';
       $sStyleReadInp_nome = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nome']) && $this->nmgp_cmp_hidden['nome'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nome" value="<?php echo $this->form_encode_input($nome) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_nome_label" id="hidden_field_label_nome" style="<?php echo $sStyleHidden_nome; ?>"><span id="id_label_nome"><?php echo $this->nm_new_label['nome']; ?></span></TD>
    <TD class="scFormDataOdd css_nome_line" id="hidden_field_data_nome" style="<?php echo $sStyleHidden_nome; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nome_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nome"]) &&  $this->nmgp_cmp_readonly["nome"] == "on") { 

 ?>
<input type="hidden" name="nome" value="<?php echo $this->form_encode_input($nome) . "\">" . $nome . ""; ?>
<?php } else { ?>
<span id="id_read_on_nome" class="sc-ui-readonly-nome css_nome_line" style="<?php echo $sStyleReadLab_nome; ?>"><?php echo $this->form_format_readonly("nome", $this->form_encode_input($this->nome)); ?></span><span id="id_read_off_nome" class="css_read_off_nome<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nome; ?>">
 <input class="sc-js-input scFormObjectOdd css_nome_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nome" type=text name="nome" value="<?php echo $this->form_encode_input($nome) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=60"; } ?> maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['part_tipo']))
           {
               $this->nmgp_cmp_readonly['part_tipo'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['part_ativo']))
    {
        $this->nm_new_label['part_ativo'] = "Ativo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_ativo = $this->part_ativo;
   $sStyleHidden_part_ativo = '';
   if (isset($this->nmgp_cmp_hidden['part_ativo']) && $this->nmgp_cmp_hidden['part_ativo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_ativo']);
       $sStyleHidden_part_ativo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_ativo = 'display: none;';
   $sStyleReadInp_part_ativo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_ativo']) && $this->nmgp_cmp_readonly['part_ativo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_ativo']);
       $sStyleReadLab_part_ativo = '';
       $sStyleReadInp_part_ativo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_ativo']) && $this->nmgp_cmp_hidden['part_ativo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_ativo" value="<?php echo $this->form_encode_input($part_ativo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_ativo_label" id="hidden_field_label_part_ativo" style="<?php echo $sStyleHidden_part_ativo; ?>"><span id="id_label_part_ativo"><?php echo $this->nm_new_label['part_ativo']; ?></span></TD>
    <TD class="scFormDataOdd css_part_ativo_line" id="hidden_field_data_part_ativo" style="<?php echo $sStyleHidden_part_ativo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_ativo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_ativo"]) &&  $this->nmgp_cmp_readonly["part_ativo"] == "on") { 

 if ("Y" == $this->part_ativo) { $part_ativo_look = "Sim";} 
 if ("N" == $this->part_ativo) { $part_ativo_look = "Não";} 
?>
<input type="hidden" name="part_ativo" value="<?php echo $this->form_encode_input($part_ativo) . "\">" . $part_ativo_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->part_ativo) { $part_ativo_look = "Sim";} 
 if ("N" == $this->part_ativo) { $part_ativo_look = "Não";} 
?>
<span id="id_read_on_part_ativo"  class="css_part_ativo_line" style="<?php echo $sStyleReadLab_part_ativo; ?>"><?php echo $this->form_format_readonly("part_ativo", $this->form_encode_input($part_ativo_look)); ?></span><span id="id_read_off_part_ativo" class="css_read_off_part_ativo css_part_ativo_line" style="<?php echo $sStyleReadInp_part_ativo; ?>"><div id="idAjaxRadio_part_ativo" style="display: inline-block"  class="css_part_ativo_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_part_ativo_line"><?php $tempOptionId = "id-opt-part_ativo" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_ativo sc-ui-radio-part_ativo sc-js-input" type=radio name="part_ativo" value="Y"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_ativo'][] = 'Y'; ?>
<?php  if ("Y" == $this->part_ativo)  { echo " checked" ;} ?><?php  if (empty($this->part_ativo)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_part_ativo_line"><?php $tempOptionId = "id-opt-part_ativo" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_ativo sc-ui-radio-part_ativo sc-js-input" type=radio name="part_ativo" value="N"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_ativo'][] = 'N'; ?>
<?php  if ("N" == $this->part_ativo)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_ativo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_ativo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_tipo']))
    {
        $this->nm_new_label['part_tipo'] = "Tipo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_tipo = $this->part_tipo;
   $sStyleHidden_part_tipo = '';
   if (isset($this->nmgp_cmp_hidden['part_tipo']) && $this->nmgp_cmp_hidden['part_tipo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_tipo']);
       $sStyleHidden_part_tipo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_tipo = 'display: none;';
   $sStyleReadInp_part_tipo = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["part_tipo"]) &&  $this->nmgp_cmp_readonly["part_tipo"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_tipo']);
       $sStyleReadLab_part_tipo = '';
       $sStyleReadInp_part_tipo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_tipo']) && $this->nmgp_cmp_hidden['part_tipo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_tipo" value="<?php echo $this->form_encode_input($part_tipo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_tipo_label" id="hidden_field_label_part_tipo" style="<?php echo $sStyleHidden_part_tipo; ?>"><span id="id_label_part_tipo"><?php echo $this->nm_new_label['part_tipo']; ?></span></TD>
    <TD class="scFormDataOdd css_part_tipo_line" id="hidden_field_data_part_tipo" style="<?php echo $sStyleHidden_part_tipo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_tipo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["part_tipo"]) &&  $this->nmgp_cmp_readonly["part_tipo"] == "on")) { 

 ?>
<input type="hidden" name="part_tipo" value="<?php echo $this->form_encode_input($part_tipo) . "\"><span id=\"id_ajax_label_part_tipo\">" . $part_tipo . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_part_tipo" class="sc-ui-readonly-part_tipo css_part_tipo_line" style="<?php echo $sStyleReadLab_part_tipo; ?>"><?php echo $this->form_format_readonly("part_tipo", $this->form_encode_input($this->part_tipo)); ?></span><span id="id_read_off_part_tipo" class="css_read_off_part_tipo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_tipo; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_tipo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_tipo" type=text name="part_tipo" value="<?php echo $this->form_encode_input($part_tipo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_tipo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_tipo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_sexo']))
    {
        $this->nm_new_label['part_sexo'] = "Sexo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_sexo = $this->part_sexo;
   $sStyleHidden_part_sexo = '';
   if (isset($this->nmgp_cmp_hidden['part_sexo']) && $this->nmgp_cmp_hidden['part_sexo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_sexo']);
       $sStyleHidden_part_sexo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_sexo = 'display: none;';
   $sStyleReadInp_part_sexo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_sexo']) && $this->nmgp_cmp_readonly['part_sexo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_sexo']);
       $sStyleReadLab_part_sexo = '';
       $sStyleReadInp_part_sexo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_sexo']) && $this->nmgp_cmp_hidden['part_sexo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_sexo" value="<?php echo $this->form_encode_input($part_sexo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_sexo_label" id="hidden_field_label_part_sexo" style="<?php echo $sStyleHidden_part_sexo; ?>"><span id="id_label_part_sexo"><?php echo $this->nm_new_label['part_sexo']; ?></span></TD>
    <TD class="scFormDataOdd css_part_sexo_line" id="hidden_field_data_part_sexo" style="<?php echo $sStyleHidden_part_sexo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_sexo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_sexo"]) &&  $this->nmgp_cmp_readonly["part_sexo"] == "on") { 

 if ("F" == $this->part_sexo) { $part_sexo_look = "Feminino";} 
 if ("M" == $this->part_sexo) { $part_sexo_look = "Masculino";} 
?>
<input type="hidden" name="part_sexo" value="<?php echo $this->form_encode_input($part_sexo) . "\">" . $part_sexo_look . ""; ?>
<?php } else { ?>

<?php

 if ("F" == $this->part_sexo) { $part_sexo_look = "Feminino";} 
 if ("M" == $this->part_sexo) { $part_sexo_look = "Masculino";} 
?>
<span id="id_read_on_part_sexo"  class="css_part_sexo_line" style="<?php echo $sStyleReadLab_part_sexo; ?>"><?php echo $this->form_format_readonly("part_sexo", $this->form_encode_input($part_sexo_look)); ?></span><span id="id_read_off_part_sexo" class="css_read_off_part_sexo css_part_sexo_line" style="<?php echo $sStyleReadInp_part_sexo; ?>"><div id="idAjaxRadio_part_sexo" style="display: inline-block"  class="css_part_sexo_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_part_sexo_line"><?php $tempOptionId = "id-opt-part_sexo" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_sexo sc-ui-radio-part_sexo sc-js-input" type=radio name="part_sexo" value="F"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_sexo'][] = 'F'; ?>
<?php  if ("F" == $this->part_sexo)  { echo " checked" ;} ?><?php  if (empty($this->part_sexo)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Feminino</label></TD>
  <TD class="scFormDataFontOdd css_part_sexo_line"><?php $tempOptionId = "id-opt-part_sexo" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_sexo sc-ui-radio-part_sexo sc-js-input" type=radio name="part_sexo" value="M"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_sexo'][] = 'M'; ?>
<?php  if ("M" == $this->part_sexo)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Masculino</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_sexo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_sexo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['enviar_app']))
    {
        $this->nm_new_label['enviar_app'] = "Gravar no APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $enviar_app = $this->enviar_app;
   $sStyleHidden_enviar_app = '';
   if (isset($this->nmgp_cmp_hidden['enviar_app']) && $this->nmgp_cmp_hidden['enviar_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['enviar_app']);
       $sStyleHidden_enviar_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_enviar_app = 'display: none;';
   $sStyleReadInp_enviar_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['enviar_app']) && $this->nmgp_cmp_readonly['enviar_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['enviar_app']);
       $sStyleReadLab_enviar_app = '';
       $sStyleReadInp_enviar_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['enviar_app']) && $this->nmgp_cmp_hidden['enviar_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="enviar_app" value="<?php echo $this->form_encode_input($enviar_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_enviar_app_label" id="hidden_field_label_enviar_app" style="<?php echo $sStyleHidden_enviar_app; ?>"><span id="id_label_enviar_app"><?php echo $this->nm_new_label['enviar_app']; ?></span></TD>
    <TD class="scFormDataOdd css_enviar_app_line" id="hidden_field_data_enviar_app" style="<?php echo $sStyleHidden_enviar_app; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_enviar_app_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["enviar_app"]) &&  $this->nmgp_cmp_readonly["enviar_app"] == "on") { 

 if ("Y" == $this->enviar_app) { $enviar_app_look = "Sim";} 
 if ("N" == $this->enviar_app) { $enviar_app_look = "Não";} 
?>
<input type="hidden" name="enviar_app" value="<?php echo $this->form_encode_input($enviar_app) . "\">" . $enviar_app_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->enviar_app) { $enviar_app_look = "Sim";} 
 if ("N" == $this->enviar_app) { $enviar_app_look = "Não";} 
?>
<span id="id_read_on_enviar_app"  class="css_enviar_app_line" style="<?php echo $sStyleReadLab_enviar_app; ?>"><?php echo $this->form_format_readonly("enviar_app", $this->form_encode_input($enviar_app_look)); ?></span><span id="id_read_off_enviar_app" class="css_read_off_enviar_app css_enviar_app_line" style="<?php echo $sStyleReadInp_enviar_app; ?>"><div id="idAjaxRadio_enviar_app" style="display: inline-block"  class="css_enviar_app_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_enviar_app_line"><?php $tempOptionId = "id-opt-enviar_app" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enviar_app sc-ui-radio-enviar_app sc-js-input" type=radio name="enviar_app" value="Y"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_enviar_app'][] = 'Y'; ?>
<?php  if ("Y" == $this->enviar_app)  { echo " checked" ;} ?><?php  if (empty($this->enviar_app)) { echo " checked" ;} ?>  onClick="do_ajax_form_acompanhantes_rsvp_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_enviar_app_line"><?php $tempOptionId = "id-opt-enviar_app" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enviar_app sc-ui-radio-enviar_app sc-js-input" type=radio name="enviar_app" value="N"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_enviar_app'][] = 'N'; ?>
<?php  if ("N" == $this->enviar_app)  { echo " checked" ;} ?>  onClick="do_ajax_form_acompanhantes_rsvp_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_enviar_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_enviar_app_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_nome_cracha']))
    {
        $this->nm_new_label['part_nome_cracha'] = "Nome Crachá:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_nome_cracha = $this->part_nome_cracha;
   $sStyleHidden_part_nome_cracha = '';
   if (isset($this->nmgp_cmp_hidden['part_nome_cracha']) && $this->nmgp_cmp_hidden['part_nome_cracha'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_nome_cracha']);
       $sStyleHidden_part_nome_cracha = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_nome_cracha = 'display: none;';
   $sStyleReadInp_part_nome_cracha = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_nome_cracha']) && $this->nmgp_cmp_readonly['part_nome_cracha'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_nome_cracha']);
       $sStyleReadLab_part_nome_cracha = '';
       $sStyleReadInp_part_nome_cracha = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_nome_cracha']) && $this->nmgp_cmp_hidden['part_nome_cracha'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_nome_cracha" value="<?php echo $this->form_encode_input($part_nome_cracha) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_nome_cracha_label" id="hidden_field_label_part_nome_cracha" style="<?php echo $sStyleHidden_part_nome_cracha; ?>"><span id="id_label_part_nome_cracha"><?php echo $this->nm_new_label['part_nome_cracha']; ?></span></TD>
    <TD class="scFormDataOdd css_part_nome_cracha_line" id="hidden_field_data_part_nome_cracha" style="<?php echo $sStyleHidden_part_nome_cracha; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_nome_cracha_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_nome_cracha"]) &&  $this->nmgp_cmp_readonly["part_nome_cracha"] == "on") { 

 ?>
<input type="hidden" name="part_nome_cracha" value="<?php echo $this->form_encode_input($part_nome_cracha) . "\">" . $part_nome_cracha . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_nome_cracha" class="sc-ui-readonly-part_nome_cracha css_part_nome_cracha_line" style="<?php echo $sStyleReadLab_part_nome_cracha; ?>"><?php echo $this->form_format_readonly("part_nome_cracha", $this->form_encode_input($this->part_nome_cracha)); ?></span><span id="id_read_off_part_nome_cracha" class="css_read_off_part_nome_cracha<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_nome_cracha; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_nome_cracha_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_nome_cracha" type=text name="part_nome_cracha" value="<?php echo $this->form_encode_input($part_nome_cracha) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_nome_cracha_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_nome_cracha_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['part_id_evento']))
   {
       $this->nm_new_label['part_id_evento'] = "Evento:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_id_evento = $this->part_id_evento;
   $sStyleHidden_part_id_evento = '';
   if (isset($this->nmgp_cmp_hidden['part_id_evento']) && $this->nmgp_cmp_hidden['part_id_evento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_id_evento']);
       $sStyleHidden_part_id_evento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_id_evento = 'display: none;';
   $sStyleReadInp_part_id_evento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_id_evento']) && $this->nmgp_cmp_readonly['part_id_evento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_id_evento']);
       $sStyleReadLab_part_id_evento = '';
       $sStyleReadInp_part_id_evento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_id_evento']) && $this->nmgp_cmp_hidden['part_id_evento'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="part_id_evento" value="<?php echo $this->form_encode_input($this->part_id_evento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_id_evento_label" id="hidden_field_label_part_id_evento" style="<?php echo $sStyleHidden_part_id_evento; ?>"><span id="id_label_part_id_evento"><?php echo $this->nm_new_label['part_id_evento']; ?></span></TD>
    <TD class="scFormDataOdd css_part_id_evento_line" id="hidden_field_data_part_id_evento" style="<?php echo $sStyleHidden_part_id_evento; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_id_evento_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_id_evento"]) &&  $this->nmgp_cmp_readonly["part_id_evento"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento'] = array(); 
    }

   $old_value_participante_id = $this->participante_id;
   $old_value_part_dt_nasc = $this->part_dt_nasc;
   $old_value_part_cep = $this->part_cep;
   $old_value_part_fone_01 = $this->part_fone_01;
   $old_value_part_celeular_01 = $this->part_celeular_01;
   $old_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $old_value_emissao_passaporte = $this->emissao_passaporte;
   $old_value_part_validade_pass = $this->part_validade_pass;
   $old_value_part_cpf_informado = $this->part_cpf_informado;
   $old_value_part_vacina_fa = $this->part_vacina_fa;
   $old_value_validade_visto = $this->validade_visto;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_participante_id = $this->participante_id;
   $unformatted_value_part_dt_nasc = $this->part_dt_nasc;
   $unformatted_value_part_cep = $this->part_cep;
   $unformatted_value_part_fone_01 = $this->part_fone_01;
   $unformatted_value_part_celeular_01 = $this->part_celeular_01;
   $unformatted_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $unformatted_value_emissao_passaporte = $this->emissao_passaporte;
   $unformatted_value_part_validade_pass = $this->part_validade_pass;
   $unformatted_value_part_cpf_informado = $this->part_cpf_informado;
   $unformatted_value_part_vacina_fa = $this->part_vacina_fa;
   $unformatted_value_validade_visto = $this->validade_visto;

   $nm_comando = "SELECT evento_id, evento_nome  FROM eventos_rsvp  WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome";

   $this->participante_id = $old_value_participante_id;
   $this->part_dt_nasc = $old_value_part_dt_nasc;
   $this->part_cep = $old_value_part_cep;
   $this->part_fone_01 = $old_value_part_fone_01;
   $this->part_celeular_01 = $old_value_part_celeular_01;
   $this->codigo_telefone_internacional = $old_value_codigo_telefone_internacional;
   $this->emissao_passaporte = $old_value_emissao_passaporte;
   $this->part_validade_pass = $old_value_part_validade_pass;
   $this->part_cpf_informado = $old_value_part_cpf_informado;
   $this->part_vacina_fa = $old_value_part_vacina_fa;
   $this->validade_visto = $old_value_validade_visto;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $part_id_evento_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->part_id_evento_1))
          {
              foreach ($this->part_id_evento_1 as $tmp_part_id_evento)
              {
                  if (trim($tmp_part_id_evento) === trim($cadaselect[1])) {$part_id_evento_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->part_id_evento) && trim($this->part_id_evento) === trim($cadaselect[1])) {$part_id_evento_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="part_id_evento" value="<?php echo $this->form_encode_input($part_id_evento) . "\">" . $part_id_evento_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_part_id_evento();
   $x = 0 ; 
   $part_id_evento_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->part_id_evento_1))
          {
              foreach ($this->part_id_evento_1 as $tmp_part_id_evento)
              {
                  if (trim($tmp_part_id_evento) === trim($cadaselect[1])) {$part_id_evento_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->part_id_evento)) {
                 if (trim($this->part_id_evento) == trim($cadaselect[1])) { $part_id_evento_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->part_id_evento == $cadaselect[1]) { $part_id_evento_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($part_id_evento_look))
          {
              $part_id_evento_look = $this->part_id_evento;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_part_id_evento\" class=\"css_part_id_evento_line\" style=\"" .  $sStyleReadLab_part_id_evento . "\">" . $this->form_format_readonly("part_id_evento", $this->form_encode_input($part_id_evento_look)) . "</span><span id=\"id_read_off_part_id_evento\" class=\"css_read_off_part_id_evento" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_part_id_evento . "\">";
   echo " <span id=\"idAjaxSelect_part_id_evento\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_part_id_evento_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_part_id_evento\" name=\"part_id_evento\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->part_id_evento) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->part_id_evento)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_id_evento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_id_evento_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['part_id_evento_publico']))
   {
       $this->nm_new_label['part_id_evento_publico'] = "Público:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_id_evento_publico = $this->part_id_evento_publico;
   $sStyleHidden_part_id_evento_publico = '';
   if (isset($this->nmgp_cmp_hidden['part_id_evento_publico']) && $this->nmgp_cmp_hidden['part_id_evento_publico'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_id_evento_publico']);
       $sStyleHidden_part_id_evento_publico = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_id_evento_publico = 'display: none;';
   $sStyleReadInp_part_id_evento_publico = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_id_evento_publico']) && $this->nmgp_cmp_readonly['part_id_evento_publico'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_id_evento_publico']);
       $sStyleReadLab_part_id_evento_publico = '';
       $sStyleReadInp_part_id_evento_publico = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_id_evento_publico']) && $this->nmgp_cmp_hidden['part_id_evento_publico'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="part_id_evento_publico" value="<?php echo $this->form_encode_input($this->part_id_evento_publico) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_id_evento_publico_label" id="hidden_field_label_part_id_evento_publico" style="<?php echo $sStyleHidden_part_id_evento_publico; ?>"><span id="id_label_part_id_evento_publico"><?php echo $this->nm_new_label['part_id_evento_publico']; ?></span></TD>
    <TD class="scFormDataOdd css_part_id_evento_publico_line" id="hidden_field_data_part_id_evento_publico" style="<?php echo $sStyleHidden_part_id_evento_publico; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_id_evento_publico_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_id_evento_publico"]) &&  $this->nmgp_cmp_readonly["part_id_evento_publico"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico'] = array(); 
    }

   $old_value_participante_id = $this->participante_id;
   $old_value_part_dt_nasc = $this->part_dt_nasc;
   $old_value_part_cep = $this->part_cep;
   $old_value_part_fone_01 = $this->part_fone_01;
   $old_value_part_celeular_01 = $this->part_celeular_01;
   $old_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $old_value_emissao_passaporte = $this->emissao_passaporte;
   $old_value_part_validade_pass = $this->part_validade_pass;
   $old_value_part_cpf_informado = $this->part_cpf_informado;
   $old_value_part_vacina_fa = $this->part_vacina_fa;
   $old_value_validade_visto = $this->validade_visto;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_participante_id = $this->participante_id;
   $unformatted_value_part_dt_nasc = $this->part_dt_nasc;
   $unformatted_value_part_cep = $this->part_cep;
   $unformatted_value_part_fone_01 = $this->part_fone_01;
   $unformatted_value_part_celeular_01 = $this->part_celeular_01;
   $unformatted_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $unformatted_value_emissao_passaporte = $this->emissao_passaporte;
   $unformatted_value_part_validade_pass = $this->part_validade_pass;
   $unformatted_value_part_cpf_informado = $this->part_cpf_informado;
   $unformatted_value_part_vacina_fa = $this->part_vacina_fa;
   $unformatted_value_validade_visto = $this->validade_visto;

   $nm_comando = "SELECT publico_id, publico_nome  FROM publico_rsvp  ORDER BY publico_nome";

   $this->participante_id = $old_value_participante_id;
   $this->part_dt_nasc = $old_value_part_dt_nasc;
   $this->part_cep = $old_value_part_cep;
   $this->part_fone_01 = $old_value_part_fone_01;
   $this->part_celeular_01 = $old_value_part_celeular_01;
   $this->codigo_telefone_internacional = $old_value_codigo_telefone_internacional;
   $this->emissao_passaporte = $old_value_emissao_passaporte;
   $this->part_validade_pass = $old_value_part_validade_pass;
   $this->part_cpf_informado = $old_value_part_cpf_informado;
   $this->part_vacina_fa = $old_value_part_vacina_fa;
   $this->validade_visto = $old_value_validade_visto;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $part_id_evento_publico_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->part_id_evento_publico_1))
          {
              foreach ($this->part_id_evento_publico_1 as $tmp_part_id_evento_publico)
              {
                  if (trim($tmp_part_id_evento_publico) === trim($cadaselect[1])) {$part_id_evento_publico_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->part_id_evento_publico) && trim($this->part_id_evento_publico) === trim($cadaselect[1])) {$part_id_evento_publico_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="part_id_evento_publico" value="<?php echo $this->form_encode_input($part_id_evento_publico) . "\">" . $part_id_evento_publico_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_part_id_evento_publico();
   $x = 0 ; 
   $part_id_evento_publico_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->part_id_evento_publico_1))
          {
              foreach ($this->part_id_evento_publico_1 as $tmp_part_id_evento_publico)
              {
                  if (trim($tmp_part_id_evento_publico) === trim($cadaselect[1])) {$part_id_evento_publico_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->part_id_evento_publico)) {
                 if (trim($this->part_id_evento_publico) == trim($cadaselect[1])) { $part_id_evento_publico_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->part_id_evento_publico == $cadaselect[1]) { $part_id_evento_publico_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($part_id_evento_publico_look))
          {
              $part_id_evento_publico_look = $this->part_id_evento_publico;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_part_id_evento_publico\" class=\"css_part_id_evento_publico_line\" style=\"" .  $sStyleReadLab_part_id_evento_publico . "\">" . $this->form_format_readonly("part_id_evento_publico", $this->form_encode_input($part_id_evento_publico_look)) . "</span><span id=\"id_read_off_part_id_evento_publico\" class=\"css_read_off_part_id_evento_publico" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_part_id_evento_publico . "\">";
   echo " <span id=\"idAjaxSelect_part_id_evento_publico\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_part_id_evento_publico_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_part_id_evento_publico\" name=\"part_id_evento_publico\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_publico'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;","SEM PUBLICO") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->part_id_evento_publico) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->part_id_evento_publico)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_id_evento_publico_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_id_evento_publico_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['part_id_evento_regional']))
   {
       $this->nm_new_label['part_id_evento_regional'] = "Regional:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_id_evento_regional = $this->part_id_evento_regional;
   $sStyleHidden_part_id_evento_regional = '';
   if (isset($this->nmgp_cmp_hidden['part_id_evento_regional']) && $this->nmgp_cmp_hidden['part_id_evento_regional'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_id_evento_regional']);
       $sStyleHidden_part_id_evento_regional = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_id_evento_regional = 'display: none;';
   $sStyleReadInp_part_id_evento_regional = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_id_evento_regional']) && $this->nmgp_cmp_readonly['part_id_evento_regional'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_id_evento_regional']);
       $sStyleReadLab_part_id_evento_regional = '';
       $sStyleReadInp_part_id_evento_regional = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_id_evento_regional']) && $this->nmgp_cmp_hidden['part_id_evento_regional'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="part_id_evento_regional" value="<?php echo $this->form_encode_input($this->part_id_evento_regional) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_id_evento_regional_label" id="hidden_field_label_part_id_evento_regional" style="<?php echo $sStyleHidden_part_id_evento_regional; ?>"><span id="id_label_part_id_evento_regional"><?php echo $this->nm_new_label['part_id_evento_regional']; ?></span></TD>
    <TD class="scFormDataOdd css_part_id_evento_regional_line" id="hidden_field_data_part_id_evento_regional" style="<?php echo $sStyleHidden_part_id_evento_regional; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_id_evento_regional_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_id_evento_regional"]) &&  $this->nmgp_cmp_readonly["part_id_evento_regional"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional'] = array(); 
    }

   $old_value_participante_id = $this->participante_id;
   $old_value_part_dt_nasc = $this->part_dt_nasc;
   $old_value_part_cep = $this->part_cep;
   $old_value_part_fone_01 = $this->part_fone_01;
   $old_value_part_celeular_01 = $this->part_celeular_01;
   $old_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $old_value_emissao_passaporte = $this->emissao_passaporte;
   $old_value_part_validade_pass = $this->part_validade_pass;
   $old_value_part_cpf_informado = $this->part_cpf_informado;
   $old_value_part_vacina_fa = $this->part_vacina_fa;
   $old_value_validade_visto = $this->validade_visto;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_participante_id = $this->participante_id;
   $unformatted_value_part_dt_nasc = $this->part_dt_nasc;
   $unformatted_value_part_cep = $this->part_cep;
   $unformatted_value_part_fone_01 = $this->part_fone_01;
   $unformatted_value_part_celeular_01 = $this->part_celeular_01;
   $unformatted_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $unformatted_value_emissao_passaporte = $this->emissao_passaporte;
   $unformatted_value_part_validade_pass = $this->part_validade_pass;
   $unformatted_value_part_cpf_informado = $this->part_cpf_informado;
   $unformatted_value_part_vacina_fa = $this->part_vacina_fa;
   $unformatted_value_validade_visto = $this->validade_visto;

   $nm_comando = "SELECT regional_id, regional_dsc  FROM tbl_regionais  ORDER BY regional_dsc";

   $this->participante_id = $old_value_participante_id;
   $this->part_dt_nasc = $old_value_part_dt_nasc;
   $this->part_cep = $old_value_part_cep;
   $this->part_fone_01 = $old_value_part_fone_01;
   $this->part_celeular_01 = $old_value_part_celeular_01;
   $this->codigo_telefone_internacional = $old_value_codigo_telefone_internacional;
   $this->emissao_passaporte = $old_value_emissao_passaporte;
   $this->part_validade_pass = $old_value_part_validade_pass;
   $this->part_cpf_informado = $old_value_part_cpf_informado;
   $this->part_vacina_fa = $old_value_part_vacina_fa;
   $this->validade_visto = $old_value_validade_visto;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $part_id_evento_regional_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->part_id_evento_regional_1))
          {
              foreach ($this->part_id_evento_regional_1 as $tmp_part_id_evento_regional)
              {
                  if (trim($tmp_part_id_evento_regional) === trim($cadaselect[1])) {$part_id_evento_regional_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->part_id_evento_regional) && trim($this->part_id_evento_regional) === trim($cadaselect[1])) {$part_id_evento_regional_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="part_id_evento_regional" value="<?php echo $this->form_encode_input($part_id_evento_regional) . "\">" . $part_id_evento_regional_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_part_id_evento_regional();
   $x = 0 ; 
   $part_id_evento_regional_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->part_id_evento_regional_1))
          {
              foreach ($this->part_id_evento_regional_1 as $tmp_part_id_evento_regional)
              {
                  if (trim($tmp_part_id_evento_regional) === trim($cadaselect[1])) {$part_id_evento_regional_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->part_id_evento_regional)) {
                 if (trim($this->part_id_evento_regional) == trim($cadaselect[1])) { $part_id_evento_regional_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->part_id_evento_regional == $cadaselect[1]) { $part_id_evento_regional_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($part_id_evento_regional_look))
          {
              $part_id_evento_regional_look = $this->part_id_evento_regional;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_part_id_evento_regional\" class=\"css_part_id_evento_regional_line\" style=\"" .  $sStyleReadLab_part_id_evento_regional . "\">" . $this->form_format_readonly("part_id_evento_regional", $this->form_encode_input($part_id_evento_regional_look)) . "</span><span id=\"id_read_off_part_id_evento_regional\" class=\"css_read_off_part_id_evento_regional" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_part_id_evento_regional . "\">";
   echo " <span id=\"idAjaxSelect_part_id_evento_regional\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_part_id_evento_regional_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_part_id_evento_regional\" name=\"part_id_evento_regional\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_id_evento_regional'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;","SEM REGIONAL") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->part_id_evento_regional) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->part_id_evento_regional)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_id_evento_regional_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_id_evento_regional_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_tipo_pessoa']))
    {
        $this->nm_new_label['part_tipo_pessoa'] = "Tipo Pessoa:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_tipo_pessoa = $this->part_tipo_pessoa;
   $sStyleHidden_part_tipo_pessoa = '';
   if (isset($this->nmgp_cmp_hidden['part_tipo_pessoa']) && $this->nmgp_cmp_hidden['part_tipo_pessoa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_tipo_pessoa']);
       $sStyleHidden_part_tipo_pessoa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_tipo_pessoa = 'display: none;';
   $sStyleReadInp_part_tipo_pessoa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_tipo_pessoa']) && $this->nmgp_cmp_readonly['part_tipo_pessoa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_tipo_pessoa']);
       $sStyleReadLab_part_tipo_pessoa = '';
       $sStyleReadInp_part_tipo_pessoa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_tipo_pessoa']) && $this->nmgp_cmp_hidden['part_tipo_pessoa'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_tipo_pessoa" value="<?php echo $this->form_encode_input($part_tipo_pessoa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_tipo_pessoa_label" id="hidden_field_label_part_tipo_pessoa" style="<?php echo $sStyleHidden_part_tipo_pessoa; ?>"><span id="id_label_part_tipo_pessoa"><?php echo $this->nm_new_label['part_tipo_pessoa']; ?></span></TD>
    <TD class="scFormDataOdd css_part_tipo_pessoa_line" id="hidden_field_data_part_tipo_pessoa" style="<?php echo $sStyleHidden_part_tipo_pessoa; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_tipo_pessoa_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_tipo_pessoa"]) &&  $this->nmgp_cmp_readonly["part_tipo_pessoa"] == "on") { 

 if ("ADT" == $this->part_tipo_pessoa) { $part_tipo_pessoa_look = "ADT";} 
 if ("CHD" == $this->part_tipo_pessoa) { $part_tipo_pessoa_look = "CHD";} 
?>
<input type="hidden" name="part_tipo_pessoa" value="<?php echo $this->form_encode_input($part_tipo_pessoa) . "\">" . $part_tipo_pessoa_look . ""; ?>
<?php } else { ?>

<?php

 if ("ADT" == $this->part_tipo_pessoa) { $part_tipo_pessoa_look = "ADT";} 
 if ("CHD" == $this->part_tipo_pessoa) { $part_tipo_pessoa_look = "CHD";} 
?>
<span id="id_read_on_part_tipo_pessoa"  class="css_part_tipo_pessoa_line" style="<?php echo $sStyleReadLab_part_tipo_pessoa; ?>"><?php echo $this->form_format_readonly("part_tipo_pessoa", $this->form_encode_input($part_tipo_pessoa_look)); ?></span><span id="id_read_off_part_tipo_pessoa" class="css_read_off_part_tipo_pessoa css_part_tipo_pessoa_line" style="<?php echo $sStyleReadInp_part_tipo_pessoa; ?>"><div id="idAjaxRadio_part_tipo_pessoa" style="display: inline-block"  class="css_part_tipo_pessoa_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_part_tipo_pessoa_line"><?php $tempOptionId = "id-opt-part_tipo_pessoa" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_tipo_pessoa sc-ui-radio-part_tipo_pessoa sc-js-input" type=radio name="part_tipo_pessoa" value="ADT"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tipo_pessoa'][] = 'ADT'; ?>
<?php  if ("ADT" == $this->part_tipo_pessoa)  { echo " checked" ;} ?><?php  if (empty($this->part_tipo_pessoa)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">ADT</label></TD>
  <TD class="scFormDataFontOdd css_part_tipo_pessoa_line"><?php $tempOptionId = "id-opt-part_tipo_pessoa" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_tipo_pessoa sc-ui-radio-part_tipo_pessoa sc-js-input" type=radio name="part_tipo_pessoa" value="CHD"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tipo_pessoa'][] = 'CHD'; ?>
<?php  if ("CHD" == $this->part_tipo_pessoa)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">CHD</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_tipo_pessoa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_tipo_pessoa_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_dt_nasc']))
    {
        $this->nm_new_label['part_dt_nasc'] = "Data Nascimento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_dt_nasc = $this->part_dt_nasc;
   $sStyleHidden_part_dt_nasc = '';
   if (isset($this->nmgp_cmp_hidden['part_dt_nasc']) && $this->nmgp_cmp_hidden['part_dt_nasc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_dt_nasc']);
       $sStyleHidden_part_dt_nasc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_dt_nasc = 'display: none;';
   $sStyleReadInp_part_dt_nasc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_dt_nasc']) && $this->nmgp_cmp_readonly['part_dt_nasc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_dt_nasc']);
       $sStyleReadLab_part_dt_nasc = '';
       $sStyleReadInp_part_dt_nasc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_dt_nasc']) && $this->nmgp_cmp_hidden['part_dt_nasc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_dt_nasc" value="<?php echo $this->form_encode_input($part_dt_nasc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_dt_nasc_label" id="hidden_field_label_part_dt_nasc" style="<?php echo $sStyleHidden_part_dt_nasc; ?>"><span id="id_label_part_dt_nasc"><?php echo $this->nm_new_label['part_dt_nasc']; ?></span></TD>
    <TD class="scFormDataOdd css_part_dt_nasc_line" id="hidden_field_data_part_dt_nasc" style="<?php echo $sStyleHidden_part_dt_nasc; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_dt_nasc_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_dt_nasc"]) &&  $this->nmgp_cmp_readonly["part_dt_nasc"] == "on") { 

 ?>
<input type="hidden" name="part_dt_nasc" value="<?php echo $this->form_encode_input($part_dt_nasc) . "\">" . $part_dt_nasc . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_dt_nasc" class="sc-ui-readonly-part_dt_nasc css_part_dt_nasc_line" style="<?php echo $sStyleReadLab_part_dt_nasc; ?>"><?php echo $this->form_format_readonly("part_dt_nasc", $this->form_encode_input($part_dt_nasc)); ?></span><span id="id_read_off_part_dt_nasc" class="css_read_off_part_dt_nasc<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_dt_nasc; ?>"><?php
$tmp_form_data = $this->field_config['part_dt_nasc']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_part_dt_nasc_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_dt_nasc" type=text name="part_dt_nasc" value="<?php echo $this->form_encode_input($part_dt_nasc) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['part_dt_nasc']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['part_dt_nasc']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_dt_nasc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_dt_nasc_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_filiacao']))
    {
        $this->nm_new_label['part_filiacao'] = "Filiação:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_filiacao = $this->part_filiacao;
   $sStyleHidden_part_filiacao = '';
   if (isset($this->nmgp_cmp_hidden['part_filiacao']) && $this->nmgp_cmp_hidden['part_filiacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_filiacao']);
       $sStyleHidden_part_filiacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_filiacao = 'display: none;';
   $sStyleReadInp_part_filiacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_filiacao']) && $this->nmgp_cmp_readonly['part_filiacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_filiacao']);
       $sStyleReadLab_part_filiacao = '';
       $sStyleReadInp_part_filiacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_filiacao']) && $this->nmgp_cmp_hidden['part_filiacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_filiacao" value="<?php echo $this->form_encode_input($part_filiacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_filiacao_label" id="hidden_field_label_part_filiacao" style="<?php echo $sStyleHidden_part_filiacao; ?>"><span id="id_label_part_filiacao"><?php echo $this->nm_new_label['part_filiacao']; ?></span></TD>
    <TD class="scFormDataOdd css_part_filiacao_line" id="hidden_field_data_part_filiacao" style="<?php echo $sStyleHidden_part_filiacao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_filiacao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_filiacao"]) &&  $this->nmgp_cmp_readonly["part_filiacao"] == "on") { 

 ?>
<input type="hidden" name="part_filiacao" value="<?php echo $this->form_encode_input($part_filiacao) . "\">" . $part_filiacao . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_filiacao" class="sc-ui-readonly-part_filiacao css_part_filiacao_line" style="<?php echo $sStyleReadLab_part_filiacao; ?>"><?php echo $this->form_format_readonly("part_filiacao", $this->form_encode_input($this->part_filiacao)); ?></span><span id="id_read_off_part_filiacao" class="css_read_off_part_filiacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_filiacao; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_filiacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_filiacao" type=text name="part_filiacao" value="<?php echo $this->form_encode_input($part_filiacao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_filiacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_filiacao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['estrangeiro']))
    {
        $this->nm_new_label['estrangeiro'] = "Estrangeiro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $estrangeiro = $this->estrangeiro;
   $sStyleHidden_estrangeiro = '';
   if (isset($this->nmgp_cmp_hidden['estrangeiro']) && $this->nmgp_cmp_hidden['estrangeiro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['estrangeiro']);
       $sStyleHidden_estrangeiro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_estrangeiro = 'display: none;';
   $sStyleReadInp_estrangeiro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['estrangeiro']) && $this->nmgp_cmp_readonly['estrangeiro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['estrangeiro']);
       $sStyleReadLab_estrangeiro = '';
       $sStyleReadInp_estrangeiro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['estrangeiro']) && $this->nmgp_cmp_hidden['estrangeiro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="estrangeiro" value="<?php echo $this->form_encode_input($estrangeiro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_estrangeiro_label" id="hidden_field_label_estrangeiro" style="<?php echo $sStyleHidden_estrangeiro; ?>"><span id="id_label_estrangeiro"><?php echo $this->nm_new_label['estrangeiro']; ?></span></TD>
    <TD class="scFormDataOdd css_estrangeiro_line" id="hidden_field_data_estrangeiro" style="<?php echo $sStyleHidden_estrangeiro; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_estrangeiro_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["estrangeiro"]) &&  $this->nmgp_cmp_readonly["estrangeiro"] == "on") { 

 if ("N" == $this->estrangeiro) { $estrangeiro_look = "Não";} 
 if ("Y" == $this->estrangeiro) { $estrangeiro_look = "Sim";} 
?>
<input type="hidden" name="estrangeiro" value="<?php echo $this->form_encode_input($estrangeiro) . "\">" . $estrangeiro_look . ""; ?>
<?php } else { ?>

<?php

 if ("N" == $this->estrangeiro) { $estrangeiro_look = "Não";} 
 if ("Y" == $this->estrangeiro) { $estrangeiro_look = "Sim";} 
?>
<span id="id_read_on_estrangeiro"  class="css_estrangeiro_line" style="<?php echo $sStyleReadLab_estrangeiro; ?>"><?php echo $this->form_format_readonly("estrangeiro", $this->form_encode_input($estrangeiro_look)); ?></span><span id="id_read_off_estrangeiro" class="css_read_off_estrangeiro css_estrangeiro_line" style="<?php echo $sStyleReadInp_estrangeiro; ?>"><div id="idAjaxRadio_estrangeiro" style="display: inline-block"  class="css_estrangeiro_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_estrangeiro_line"><?php $tempOptionId = "id-opt-estrangeiro" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-estrangeiro sc-ui-radio-estrangeiro sc-js-input" type=radio name="estrangeiro" value="N"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_estrangeiro'][] = 'N'; ?>
<?php  if ("N" == $this->estrangeiro)  { echo " checked" ;} ?><?php  if (empty($this->estrangeiro)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_estrangeiro_line"><?php $tempOptionId = "id-opt-estrangeiro" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-estrangeiro sc-ui-radio-estrangeiro sc-js-input" type=radio name="estrangeiro" value="Y"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_estrangeiro'][] = 'Y'; ?>
<?php  if ("Y" == $this->estrangeiro)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_estrangeiro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_estrangeiro_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_1"></a>
<div id="div_hidden_bloco_1" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_substituido']))
    {
        $this->nm_new_label['part_substituido'] = "Substituido:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_substituido = $this->part_substituido;
   $sStyleHidden_part_substituido = '';
   if (isset($this->nmgp_cmp_hidden['part_substituido']) && $this->nmgp_cmp_hidden['part_substituido'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_substituido']);
       $sStyleHidden_part_substituido = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_substituido = 'display: none;';
   $sStyleReadInp_part_substituido = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_substituido']) && $this->nmgp_cmp_readonly['part_substituido'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_substituido']);
       $sStyleReadLab_part_substituido = '';
       $sStyleReadInp_part_substituido = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_substituido']) && $this->nmgp_cmp_hidden['part_substituido'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_substituido" value="<?php echo $this->form_encode_input($part_substituido) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_part_substituido_line" id="hidden_field_data_part_substituido" style="<?php echo $sStyleHidden_part_substituido; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_substituido_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_substituido"]) &&  $this->nmgp_cmp_readonly["part_substituido"] == "on") { 

 if ("N" == $this->part_substituido) { $part_substituido_look = "Não";} 
 if ("Y" == $this->part_substituido) { $part_substituido_look = "Sim";} 
?>
<input type="hidden" name="part_substituido" value="<?php echo $this->form_encode_input($part_substituido) . "\">" . $part_substituido_look . ""; ?>
<?php } else { ?>

<?php

 if ("N" == $this->part_substituido) { $part_substituido_look = "Não";} 
 if ("Y" == $this->part_substituido) { $part_substituido_look = "Sim";} 
?>
<span id="id_read_on_part_substituido"  class="css_part_substituido_line" style="<?php echo $sStyleReadLab_part_substituido; ?>"><?php echo $this->form_format_readonly("part_substituido", $this->form_encode_input($part_substituido_look)); ?></span><span id="id_read_off_part_substituido" class="css_read_off_part_substituido css_part_substituido_line" style="<?php echo $sStyleReadInp_part_substituido; ?>"><div id="idAjaxRadio_part_substituido" style="display: inline-block"  class="css_part_substituido_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_part_substituido_line"><?php $tempOptionId = "id-opt-part_substituido" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_substituido sc-ui-radio-part_substituido sc-js-input" type=radio name="part_substituido" value="N"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_substituido'][] = 'N'; ?>
<?php  if ("N" == $this->part_substituido)  { echo " checked" ;} ?><?php  if (empty($this->part_substituido)) { echo " checked" ;} ?>  onClick="do_ajax_form_acompanhantes_rsvp_event_part_substituido_onclick();" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
  <TD class="scFormDataFontOdd css_part_substituido_line"><?php $tempOptionId = "id-opt-part_substituido" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_substituido sc-ui-radio-part_substituido sc-js-input" type=radio name="part_substituido" value="Y"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_substituido'][] = 'Y'; ?>
<?php  if ("Y" == $this->part_substituido)  { echo " checked" ;} ?>  onClick="do_ajax_form_acompanhantes_rsvp_event_part_substituido_onclick();" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_substituido_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_substituido_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_2"></a>
<div id="div_hidden_bloco_2" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_empresa']))
    {
        $this->nm_new_label['part_empresa'] = "Empresa:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_empresa = $this->part_empresa;
   $sStyleHidden_part_empresa = '';
   if (isset($this->nmgp_cmp_hidden['part_empresa']) && $this->nmgp_cmp_hidden['part_empresa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_empresa']);
       $sStyleHidden_part_empresa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_empresa = 'display: none;';
   $sStyleReadInp_part_empresa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_empresa']) && $this->nmgp_cmp_readonly['part_empresa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_empresa']);
       $sStyleReadLab_part_empresa = '';
       $sStyleReadInp_part_empresa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_empresa']) && $this->nmgp_cmp_hidden['part_empresa'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_empresa" value="<?php echo $this->form_encode_input($part_empresa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_empresa_label" id="hidden_field_label_part_empresa" style="<?php echo $sStyleHidden_part_empresa; ?>"><span id="id_label_part_empresa"><?php echo $this->nm_new_label['part_empresa']; ?></span></TD>
    <TD class="scFormDataOdd css_part_empresa_line" id="hidden_field_data_part_empresa" style="<?php echo $sStyleHidden_part_empresa; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_empresa_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_empresa"]) &&  $this->nmgp_cmp_readonly["part_empresa"] == "on") { 

 ?>
<input type="hidden" name="part_empresa" value="<?php echo $this->form_encode_input($part_empresa) . "\">" . $part_empresa . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_empresa" class="sc-ui-readonly-part_empresa css_part_empresa_line" style="<?php echo $sStyleReadLab_part_empresa; ?>"><?php echo $this->form_format_readonly("part_empresa", $this->form_encode_input($this->part_empresa)); ?></span><span id="id_read_off_part_empresa" class="css_read_off_part_empresa<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_empresa; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_empresa_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_empresa" type=text name="part_empresa" value="<?php echo $this->form_encode_input($part_empresa) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_empresa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_empresa_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_departamento']))
    {
        $this->nm_new_label['part_departamento'] = "Departamento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_departamento = $this->part_departamento;
   $sStyleHidden_part_departamento = '';
   if (isset($this->nmgp_cmp_hidden['part_departamento']) && $this->nmgp_cmp_hidden['part_departamento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_departamento']);
       $sStyleHidden_part_departamento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_departamento = 'display: none;';
   $sStyleReadInp_part_departamento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_departamento']) && $this->nmgp_cmp_readonly['part_departamento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_departamento']);
       $sStyleReadLab_part_departamento = '';
       $sStyleReadInp_part_departamento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_departamento']) && $this->nmgp_cmp_hidden['part_departamento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_departamento" value="<?php echo $this->form_encode_input($part_departamento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_departamento_label" id="hidden_field_label_part_departamento" style="<?php echo $sStyleHidden_part_departamento; ?>"><span id="id_label_part_departamento"><?php echo $this->nm_new_label['part_departamento']; ?></span></TD>
    <TD class="scFormDataOdd css_part_departamento_line" id="hidden_field_data_part_departamento" style="<?php echo $sStyleHidden_part_departamento; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_departamento_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_departamento"]) &&  $this->nmgp_cmp_readonly["part_departamento"] == "on") { 

 ?>
<input type="hidden" name="part_departamento" value="<?php echo $this->form_encode_input($part_departamento) . "\">" . $part_departamento . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_departamento" class="sc-ui-readonly-part_departamento css_part_departamento_line" style="<?php echo $sStyleReadLab_part_departamento; ?>"><?php echo $this->form_format_readonly("part_departamento", $this->form_encode_input($this->part_departamento)); ?></span><span id="id_read_off_part_departamento" class="css_read_off_part_departamento<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_departamento; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_departamento_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_departamento" type=text name="part_departamento" value="<?php echo $this->form_encode_input($part_departamento) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_departamento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_departamento_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_cargo']))
    {
        $this->nm_new_label['part_cargo'] = "Cargo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_cargo = $this->part_cargo;
   $sStyleHidden_part_cargo = '';
   if (isset($this->nmgp_cmp_hidden['part_cargo']) && $this->nmgp_cmp_hidden['part_cargo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_cargo']);
       $sStyleHidden_part_cargo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_cargo = 'display: none;';
   $sStyleReadInp_part_cargo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_cargo']) && $this->nmgp_cmp_readonly['part_cargo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_cargo']);
       $sStyleReadLab_part_cargo = '';
       $sStyleReadInp_part_cargo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_cargo']) && $this->nmgp_cmp_hidden['part_cargo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_cargo" value="<?php echo $this->form_encode_input($part_cargo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_cargo_label" id="hidden_field_label_part_cargo" style="<?php echo $sStyleHidden_part_cargo; ?>"><span id="id_label_part_cargo"><?php echo $this->nm_new_label['part_cargo']; ?></span></TD>
    <TD class="scFormDataOdd css_part_cargo_line" id="hidden_field_data_part_cargo" style="<?php echo $sStyleHidden_part_cargo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_cargo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_cargo"]) &&  $this->nmgp_cmp_readonly["part_cargo"] == "on") { 

 ?>
<input type="hidden" name="part_cargo" value="<?php echo $this->form_encode_input($part_cargo) . "\">" . $part_cargo . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_cargo" class="sc-ui-readonly-part_cargo css_part_cargo_line" style="<?php echo $sStyleReadLab_part_cargo; ?>"><?php echo $this->form_format_readonly("part_cargo", $this->form_encode_input($this->part_cargo)); ?></span><span id="id_read_off_part_cargo" class="css_read_off_part_cargo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_cargo; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_cargo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_cargo" type=text name="part_cargo" value="<?php echo $this->form_encode_input($part_cargo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_cargo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_cargo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_grupo']))
    {
        $this->nm_new_label['part_grupo'] = "Grupo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_grupo = $this->part_grupo;
   $sStyleHidden_part_grupo = '';
   if (isset($this->nmgp_cmp_hidden['part_grupo']) && $this->nmgp_cmp_hidden['part_grupo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_grupo']);
       $sStyleHidden_part_grupo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_grupo = 'display: none;';
   $sStyleReadInp_part_grupo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_grupo']) && $this->nmgp_cmp_readonly['part_grupo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_grupo']);
       $sStyleReadLab_part_grupo = '';
       $sStyleReadInp_part_grupo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_grupo']) && $this->nmgp_cmp_hidden['part_grupo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_grupo" value="<?php echo $this->form_encode_input($part_grupo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_grupo_label" id="hidden_field_label_part_grupo" style="<?php echo $sStyleHidden_part_grupo; ?>"><span id="id_label_part_grupo"><?php echo $this->nm_new_label['part_grupo']; ?></span></TD>
    <TD class="scFormDataOdd css_part_grupo_line" id="hidden_field_data_part_grupo" style="<?php echo $sStyleHidden_part_grupo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_grupo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_grupo"]) &&  $this->nmgp_cmp_readonly["part_grupo"] == "on") { 

 ?>
<input type="hidden" name="part_grupo" value="<?php echo $this->form_encode_input($part_grupo) . "\">" . $part_grupo . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_grupo" class="sc-ui-readonly-part_grupo css_part_grupo_line" style="<?php echo $sStyleReadLab_part_grupo; ?>"><?php echo $this->form_format_readonly("part_grupo", $this->form_encode_input($this->part_grupo)); ?></span><span id="id_read_off_part_grupo" class="css_read_off_part_grupo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_grupo; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_grupo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_grupo" type=text name="part_grupo" value="<?php echo $this->form_encode_input($part_grupo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_grupo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_grupo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_clube']))
    {
        $this->nm_new_label['part_clube'] = "Clube:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_clube = $this->part_clube;
   $sStyleHidden_part_clube = '';
   if (isset($this->nmgp_cmp_hidden['part_clube']) && $this->nmgp_cmp_hidden['part_clube'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_clube']);
       $sStyleHidden_part_clube = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_clube = 'display: none;';
   $sStyleReadInp_part_clube = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_clube']) && $this->nmgp_cmp_readonly['part_clube'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_clube']);
       $sStyleReadLab_part_clube = '';
       $sStyleReadInp_part_clube = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_clube']) && $this->nmgp_cmp_hidden['part_clube'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_clube" value="<?php echo $this->form_encode_input($part_clube) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_clube_label" id="hidden_field_label_part_clube" style="<?php echo $sStyleHidden_part_clube; ?>"><span id="id_label_part_clube"><?php echo $this->nm_new_label['part_clube']; ?></span></TD>
    <TD class="scFormDataOdd css_part_clube_line" id="hidden_field_data_part_clube" style="<?php echo $sStyleHidden_part_clube; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_clube_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_clube"]) &&  $this->nmgp_cmp_readonly["part_clube"] == "on") { 

 ?>
<input type="hidden" name="part_clube" value="<?php echo $this->form_encode_input($part_clube) . "\">" . $part_clube . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_clube" class="sc-ui-readonly-part_clube css_part_clube_line" style="<?php echo $sStyleReadLab_part_clube; ?>"><?php echo $this->form_format_readonly("part_clube", $this->form_encode_input($this->part_clube)); ?></span><span id="id_read_off_part_clube" class="css_read_off_part_clube<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_clube; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_clube_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_clube" type=text name="part_clube" value="<?php echo $this->form_encode_input($part_clube) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_clube_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_clube_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['dsc_empresa_rsvp']))
   {
       $this->nm_new_label['dsc_empresa_rsvp'] = "Empresa do Evento:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dsc_empresa_rsvp = $this->dsc_empresa_rsvp;
   $sStyleHidden_dsc_empresa_rsvp = '';
   if (isset($this->nmgp_cmp_hidden['dsc_empresa_rsvp']) && $this->nmgp_cmp_hidden['dsc_empresa_rsvp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dsc_empresa_rsvp']);
       $sStyleHidden_dsc_empresa_rsvp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dsc_empresa_rsvp = 'display: none;';
   $sStyleReadInp_dsc_empresa_rsvp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dsc_empresa_rsvp']) && $this->nmgp_cmp_readonly['dsc_empresa_rsvp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dsc_empresa_rsvp']);
       $sStyleReadLab_dsc_empresa_rsvp = '';
       $sStyleReadInp_dsc_empresa_rsvp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dsc_empresa_rsvp']) && $this->nmgp_cmp_hidden['dsc_empresa_rsvp'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="dsc_empresa_rsvp" value="<?php echo $this->form_encode_input($this->dsc_empresa_rsvp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_dsc_empresa_rsvp_label" id="hidden_field_label_dsc_empresa_rsvp" style="<?php echo $sStyleHidden_dsc_empresa_rsvp; ?>"><span id="id_label_dsc_empresa_rsvp"><?php echo $this->nm_new_label['dsc_empresa_rsvp']; ?></span></TD>
    <TD class="scFormDataOdd css_dsc_empresa_rsvp_line" id="hidden_field_data_dsc_empresa_rsvp" style="<?php echo $sStyleHidden_dsc_empresa_rsvp; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dsc_empresa_rsvp_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dsc_empresa_rsvp"]) &&  $this->nmgp_cmp_readonly["dsc_empresa_rsvp"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp'] = array(); 
    }

   $old_value_participante_id = $this->participante_id;
   $old_value_part_dt_nasc = $this->part_dt_nasc;
   $old_value_part_cep = $this->part_cep;
   $old_value_part_fone_01 = $this->part_fone_01;
   $old_value_part_celeular_01 = $this->part_celeular_01;
   $old_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $old_value_emissao_passaporte = $this->emissao_passaporte;
   $old_value_part_validade_pass = $this->part_validade_pass;
   $old_value_part_cpf_informado = $this->part_cpf_informado;
   $old_value_part_vacina_fa = $this->part_vacina_fa;
   $old_value_validade_visto = $this->validade_visto;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_participante_id = $this->participante_id;
   $unformatted_value_part_dt_nasc = $this->part_dt_nasc;
   $unformatted_value_part_cep = $this->part_cep;
   $unformatted_value_part_fone_01 = $this->part_fone_01;
   $unformatted_value_part_celeular_01 = $this->part_celeular_01;
   $unformatted_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $unformatted_value_emissao_passaporte = $this->emissao_passaporte;
   $unformatted_value_part_validade_pass = $this->part_validade_pass;
   $unformatted_value_part_cpf_informado = $this->part_cpf_informado;
   $unformatted_value_part_vacina_fa = $this->part_vacina_fa;
   $unformatted_value_validade_visto = $this->validade_visto;

   $nm_comando = "SELECT nome_empresa FROM eventos_usuarios_rsvp  WHERE  usuario_id = '" . $_SESSION['vg_usuario_id'] . "' AND evento_id = '" . $_SESSION['vg_evento_id'] . "' ORDER BY nome_empresa";

   $this->participante_id = $old_value_participante_id;
   $this->part_dt_nasc = $old_value_part_dt_nasc;
   $this->part_cep = $old_value_part_cep;
   $this->part_fone_01 = $old_value_part_fone_01;
   $this->part_celeular_01 = $old_value_part_celeular_01;
   $this->codigo_telefone_internacional = $old_value_codigo_telefone_internacional;
   $this->emissao_passaporte = $old_value_emissao_passaporte;
   $this->part_validade_pass = $old_value_part_validade_pass;
   $this->part_cpf_informado = $old_value_part_cpf_informado;
   $this->part_vacina_fa = $old_value_part_vacina_fa;
   $this->validade_visto = $old_value_validade_visto;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp'][] = $rs->fields[0];
              $nmgp_def_dados .= $rs->fields[0] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $dsc_empresa_rsvp_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->dsc_empresa_rsvp_1))
          {
              foreach ($this->dsc_empresa_rsvp_1 as $tmp_dsc_empresa_rsvp)
              {
                  if (trim($tmp_dsc_empresa_rsvp) === trim($cadaselect[1])) {$dsc_empresa_rsvp_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->dsc_empresa_rsvp) && trim($this->dsc_empresa_rsvp) === trim($cadaselect[1])) {$dsc_empresa_rsvp_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="dsc_empresa_rsvp" value="<?php echo $this->form_encode_input($dsc_empresa_rsvp) . "\">" . $dsc_empresa_rsvp_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_dsc_empresa_rsvp();
   $x = 0 ; 
   $dsc_empresa_rsvp_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->dsc_empresa_rsvp_1))
          {
              foreach ($this->dsc_empresa_rsvp_1 as $tmp_dsc_empresa_rsvp)
              {
                  if (trim($tmp_dsc_empresa_rsvp) === trim($cadaselect[1])) {$dsc_empresa_rsvp_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->dsc_empresa_rsvp)) {
                 if (trim($this->dsc_empresa_rsvp) == trim($cadaselect[1])) { $dsc_empresa_rsvp_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->dsc_empresa_rsvp == $cadaselect[1]) { $dsc_empresa_rsvp_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($dsc_empresa_rsvp_look))
          {
              $dsc_empresa_rsvp_look = $this->dsc_empresa_rsvp;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_dsc_empresa_rsvp\" class=\"css_dsc_empresa_rsvp_line\" style=\"" .  $sStyleReadLab_dsc_empresa_rsvp . "\">" . $this->form_format_readonly("dsc_empresa_rsvp", $this->form_encode_input($dsc_empresa_rsvp_look)) . "</span><span id=\"id_read_off_dsc_empresa_rsvp\" class=\"css_read_off_dsc_empresa_rsvp" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_dsc_empresa_rsvp . "\">";
   echo " <span id=\"idAjaxSelect_dsc_empresa_rsvp\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_dsc_empresa_rsvp_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_dsc_empresa_rsvp\" name=\"dsc_empresa_rsvp\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_dsc_empresa_rsvp'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->dsc_empresa_rsvp) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->dsc_empresa_rsvp)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dsc_empresa_rsvp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dsc_empresa_rsvp_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_empresa_rsvp']))
    {
        $this->nm_new_label['cod_empresa_rsvp'] = "Cód. Empresa:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_empresa_rsvp = $this->cod_empresa_rsvp;
   $sStyleHidden_cod_empresa_rsvp = '';
   if (isset($this->nmgp_cmp_hidden['cod_empresa_rsvp']) && $this->nmgp_cmp_hidden['cod_empresa_rsvp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_empresa_rsvp']);
       $sStyleHidden_cod_empresa_rsvp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_empresa_rsvp = 'display: none;';
   $sStyleReadInp_cod_empresa_rsvp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_empresa_rsvp']) && $this->nmgp_cmp_readonly['cod_empresa_rsvp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_empresa_rsvp']);
       $sStyleReadLab_cod_empresa_rsvp = '';
       $sStyleReadInp_cod_empresa_rsvp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_empresa_rsvp']) && $this->nmgp_cmp_hidden['cod_empresa_rsvp'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_empresa_rsvp" value="<?php echo $this->form_encode_input($cod_empresa_rsvp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cod_empresa_rsvp_label" id="hidden_field_label_cod_empresa_rsvp" style="<?php echo $sStyleHidden_cod_empresa_rsvp; ?>"><span id="id_label_cod_empresa_rsvp"><?php echo $this->nm_new_label['cod_empresa_rsvp']; ?></span></TD>
    <TD class="scFormDataOdd css_cod_empresa_rsvp_line" id="hidden_field_data_cod_empresa_rsvp" style="<?php echo $sStyleHidden_cod_empresa_rsvp; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_empresa_rsvp_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="cod_empresa_rsvp" value="<?php echo $this->form_encode_input($cod_empresa_rsvp); ?>"><span id="id_ajax_label_cod_empresa_rsvp"><?php echo nl2br($cod_empresa_rsvp); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_empresa_rsvp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_empresa_rsvp_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_3"></a>
<div id="div_hidden_bloco_3" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_cep']))
    {
        $this->nm_new_label['part_cep'] = "CEP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_cep = $this->part_cep;
   $sStyleHidden_part_cep = '';
   if (isset($this->nmgp_cmp_hidden['part_cep']) && $this->nmgp_cmp_hidden['part_cep'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_cep']);
       $sStyleHidden_part_cep = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_cep = 'display: none;';
   $sStyleReadInp_part_cep = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_cep']) && $this->nmgp_cmp_readonly['part_cep'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_cep']);
       $sStyleReadLab_part_cep = '';
       $sStyleReadInp_part_cep = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_cep']) && $this->nmgp_cmp_hidden['part_cep'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_cep" value="<?php echo $this->form_encode_input($part_cep) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_cep_label" id="hidden_field_label_part_cep" style="<?php echo $sStyleHidden_part_cep; ?>"><span id="id_label_part_cep"><?php echo $this->nm_new_label['part_cep']; ?></span></TD>
    <TD class="scFormDataOdd css_part_cep_line" id="hidden_field_data_part_cep" style="<?php echo $sStyleHidden_part_cep; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_cep_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_cep"]) &&  $this->nmgp_cmp_readonly["part_cep"] == "on") { 

 ?>
<input type="hidden" name="part_cep" value="<?php echo $this->form_encode_input($part_cep) . "\">" . $part_cep . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_cep" class="sc-ui-readonly-part_cep css_part_cep_line" style="<?php echo $sStyleReadLab_part_cep; ?>"><?php echo $this->form_format_readonly("part_cep", $this->form_encode_input($this->part_cep)); ?></span><span id="id_read_off_part_cep" class="css_read_off_part_cep<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_cep; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_cep_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_cep" type=text name="part_cep" value="<?php echo $this->form_encode_input($part_cep) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'cep', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "bzipcode", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_acompanhantes_rsvp'). "/form_acompanhantes_rsvp_cep.php?cep=&form_origem=F1;CEP,part_cep;UF,part_uf;CIDADE,part_cidade;BAIRRO,part_bairro;RUA,part_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_acompanhantes_rsvp'). "/form_acompanhantes_rsvp_cep.php?cep=&form_origem=F1;CEP,part_cep;UF,part_uf;CIDADE,part_cidade;BAIRRO,part_bairro;RUA,part_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "part_cep_cep", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_cep_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_cep_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_logradouro']))
    {
        $this->nm_new_label['part_logradouro'] = "Logradouro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_logradouro = $this->part_logradouro;
   $sStyleHidden_part_logradouro = '';
   if (isset($this->nmgp_cmp_hidden['part_logradouro']) && $this->nmgp_cmp_hidden['part_logradouro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_logradouro']);
       $sStyleHidden_part_logradouro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_logradouro = 'display: none;';
   $sStyleReadInp_part_logradouro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_logradouro']) && $this->nmgp_cmp_readonly['part_logradouro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_logradouro']);
       $sStyleReadLab_part_logradouro = '';
       $sStyleReadInp_part_logradouro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_logradouro']) && $this->nmgp_cmp_hidden['part_logradouro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_logradouro" value="<?php echo $this->form_encode_input($part_logradouro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_logradouro_label" id="hidden_field_label_part_logradouro" style="<?php echo $sStyleHidden_part_logradouro; ?>"><span id="id_label_part_logradouro"><?php echo $this->nm_new_label['part_logradouro']; ?></span></TD>
    <TD class="scFormDataOdd css_part_logradouro_line" id="hidden_field_data_part_logradouro" style="<?php echo $sStyleHidden_part_logradouro; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_logradouro_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_logradouro"]) &&  $this->nmgp_cmp_readonly["part_logradouro"] == "on") { 

 ?>
<input type="hidden" name="part_logradouro" value="<?php echo $this->form_encode_input($part_logradouro) . "\">" . $part_logradouro . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_logradouro" class="sc-ui-readonly-part_logradouro css_part_logradouro_line" style="<?php echo $sStyleReadLab_part_logradouro; ?>"><?php echo $this->form_format_readonly("part_logradouro", $this->form_encode_input($this->part_logradouro)); ?></span><span id="id_read_off_part_logradouro" class="css_read_off_part_logradouro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_logradouro; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_logradouro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_logradouro" type=text name="part_logradouro" value="<?php echo $this->form_encode_input($part_logradouro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_logradouro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_logradouro_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_numero']))
    {
        $this->nm_new_label['part_numero'] = "Número:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_numero = $this->part_numero;
   $sStyleHidden_part_numero = '';
   if (isset($this->nmgp_cmp_hidden['part_numero']) && $this->nmgp_cmp_hidden['part_numero'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_numero']);
       $sStyleHidden_part_numero = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_numero = 'display: none;';
   $sStyleReadInp_part_numero = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_numero']) && $this->nmgp_cmp_readonly['part_numero'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_numero']);
       $sStyleReadLab_part_numero = '';
       $sStyleReadInp_part_numero = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_numero']) && $this->nmgp_cmp_hidden['part_numero'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_numero" value="<?php echo $this->form_encode_input($part_numero) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_numero_label" id="hidden_field_label_part_numero" style="<?php echo $sStyleHidden_part_numero; ?>"><span id="id_label_part_numero"><?php echo $this->nm_new_label['part_numero']; ?></span></TD>
    <TD class="scFormDataOdd css_part_numero_line" id="hidden_field_data_part_numero" style="<?php echo $sStyleHidden_part_numero; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_numero_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_numero"]) &&  $this->nmgp_cmp_readonly["part_numero"] == "on") { 

 ?>
<input type="hidden" name="part_numero" value="<?php echo $this->form_encode_input($part_numero) . "\">" . $part_numero . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_numero" class="sc-ui-readonly-part_numero css_part_numero_line" style="<?php echo $sStyleReadLab_part_numero; ?>"><?php echo $this->form_format_readonly("part_numero", $this->form_encode_input($this->part_numero)); ?></span><span id="id_read_off_part_numero" class="css_read_off_part_numero<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_numero; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_numero_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_numero" type=text name="part_numero" value="<?php echo $this->form_encode_input($part_numero) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_numero_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_numero_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_complemento']))
    {
        $this->nm_new_label['part_complemento'] = "Complemento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_complemento = $this->part_complemento;
   $sStyleHidden_part_complemento = '';
   if (isset($this->nmgp_cmp_hidden['part_complemento']) && $this->nmgp_cmp_hidden['part_complemento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_complemento']);
       $sStyleHidden_part_complemento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_complemento = 'display: none;';
   $sStyleReadInp_part_complemento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_complemento']) && $this->nmgp_cmp_readonly['part_complemento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_complemento']);
       $sStyleReadLab_part_complemento = '';
       $sStyleReadInp_part_complemento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_complemento']) && $this->nmgp_cmp_hidden['part_complemento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_complemento" value="<?php echo $this->form_encode_input($part_complemento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_complemento_label" id="hidden_field_label_part_complemento" style="<?php echo $sStyleHidden_part_complemento; ?>"><span id="id_label_part_complemento"><?php echo $this->nm_new_label['part_complemento']; ?></span></TD>
    <TD class="scFormDataOdd css_part_complemento_line" id="hidden_field_data_part_complemento" style="<?php echo $sStyleHidden_part_complemento; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_complemento_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_complemento"]) &&  $this->nmgp_cmp_readonly["part_complemento"] == "on") { 

 ?>
<input type="hidden" name="part_complemento" value="<?php echo $this->form_encode_input($part_complemento) . "\">" . $part_complemento . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_complemento" class="sc-ui-readonly-part_complemento css_part_complemento_line" style="<?php echo $sStyleReadLab_part_complemento; ?>"><?php echo $this->form_format_readonly("part_complemento", $this->form_encode_input($this->part_complemento)); ?></span><span id="id_read_off_part_complemento" class="css_read_off_part_complemento<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_complemento; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_complemento_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_complemento" type=text name="part_complemento" value="<?php echo $this->form_encode_input($part_complemento) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_complemento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_complemento_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_bairro']))
    {
        $this->nm_new_label['part_bairro'] = "Bairro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_bairro = $this->part_bairro;
   $sStyleHidden_part_bairro = '';
   if (isset($this->nmgp_cmp_hidden['part_bairro']) && $this->nmgp_cmp_hidden['part_bairro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_bairro']);
       $sStyleHidden_part_bairro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_bairro = 'display: none;';
   $sStyleReadInp_part_bairro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_bairro']) && $this->nmgp_cmp_readonly['part_bairro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_bairro']);
       $sStyleReadLab_part_bairro = '';
       $sStyleReadInp_part_bairro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_bairro']) && $this->nmgp_cmp_hidden['part_bairro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_bairro" value="<?php echo $this->form_encode_input($part_bairro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_bairro_label" id="hidden_field_label_part_bairro" style="<?php echo $sStyleHidden_part_bairro; ?>"><span id="id_label_part_bairro"><?php echo $this->nm_new_label['part_bairro']; ?></span></TD>
    <TD class="scFormDataOdd css_part_bairro_line" id="hidden_field_data_part_bairro" style="<?php echo $sStyleHidden_part_bairro; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_bairro_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_bairro"]) &&  $this->nmgp_cmp_readonly["part_bairro"] == "on") { 

 ?>
<input type="hidden" name="part_bairro" value="<?php echo $this->form_encode_input($part_bairro) . "\">" . $part_bairro . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_bairro" class="sc-ui-readonly-part_bairro css_part_bairro_line" style="<?php echo $sStyleReadLab_part_bairro; ?>"><?php echo $this->form_format_readonly("part_bairro", $this->form_encode_input($this->part_bairro)); ?></span><span id="id_read_off_part_bairro" class="css_read_off_part_bairro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_bairro; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_bairro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_bairro" type=text name="part_bairro" value="<?php echo $this->form_encode_input($part_bairro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_bairro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_bairro_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_cidade']))
    {
        $this->nm_new_label['part_cidade'] = "Cidade:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_cidade = $this->part_cidade;
   $sStyleHidden_part_cidade = '';
   if (isset($this->nmgp_cmp_hidden['part_cidade']) && $this->nmgp_cmp_hidden['part_cidade'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_cidade']);
       $sStyleHidden_part_cidade = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_cidade = 'display: none;';
   $sStyleReadInp_part_cidade = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_cidade']) && $this->nmgp_cmp_readonly['part_cidade'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_cidade']);
       $sStyleReadLab_part_cidade = '';
       $sStyleReadInp_part_cidade = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_cidade']) && $this->nmgp_cmp_hidden['part_cidade'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_cidade" value="<?php echo $this->form_encode_input($part_cidade) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_cidade_label" id="hidden_field_label_part_cidade" style="<?php echo $sStyleHidden_part_cidade; ?>"><span id="id_label_part_cidade"><?php echo $this->nm_new_label['part_cidade']; ?></span></TD>
    <TD class="scFormDataOdd css_part_cidade_line" id="hidden_field_data_part_cidade" style="<?php echo $sStyleHidden_part_cidade; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_cidade_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_cidade"]) &&  $this->nmgp_cmp_readonly["part_cidade"] == "on") { 

 ?>
<input type="hidden" name="part_cidade" value="<?php echo $this->form_encode_input($part_cidade) . "\">" . $part_cidade . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_cidade" class="sc-ui-readonly-part_cidade css_part_cidade_line" style="<?php echo $sStyleReadLab_part_cidade; ?>"><?php echo $this->form_format_readonly("part_cidade", $this->form_encode_input($this->part_cidade)); ?></span><span id="id_read_off_part_cidade" class="css_read_off_part_cidade<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_cidade; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_cidade_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_cidade" type=text name="part_cidade" value="<?php echo $this->form_encode_input($part_cidade) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_cidade_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_cidade_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_uf']))
    {
        $this->nm_new_label['part_uf'] = "UF:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_uf = $this->part_uf;
   $sStyleHidden_part_uf = '';
   if (isset($this->nmgp_cmp_hidden['part_uf']) && $this->nmgp_cmp_hidden['part_uf'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_uf']);
       $sStyleHidden_part_uf = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_uf = 'display: none;';
   $sStyleReadInp_part_uf = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_uf']) && $this->nmgp_cmp_readonly['part_uf'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_uf']);
       $sStyleReadLab_part_uf = '';
       $sStyleReadInp_part_uf = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_uf']) && $this->nmgp_cmp_hidden['part_uf'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_uf" value="<?php echo $this->form_encode_input($part_uf) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_uf_label" id="hidden_field_label_part_uf" style="<?php echo $sStyleHidden_part_uf; ?>"><span id="id_label_part_uf"><?php echo $this->nm_new_label['part_uf']; ?></span></TD>
    <TD class="scFormDataOdd css_part_uf_line" id="hidden_field_data_part_uf" style="<?php echo $sStyleHidden_part_uf; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_uf_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_uf"]) &&  $this->nmgp_cmp_readonly["part_uf"] == "on") { 

 ?>
<input type="hidden" name="part_uf" value="<?php echo $this->form_encode_input($part_uf) . "\">" . $part_uf . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_uf" class="sc-ui-readonly-part_uf css_part_uf_line" style="<?php echo $sStyleReadLab_part_uf; ?>"><?php echo $this->form_format_readonly("part_uf", $this->form_encode_input($this->part_uf)); ?></span><span id="id_read_off_part_uf" class="css_read_off_part_uf<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_uf; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_uf_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_uf" type=text name="part_uf" value="<?php echo $this->form_encode_input($part_uf) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_uf_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_uf_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_4"></a>
<div id="div_hidden_bloco_4" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_4" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_ddd_01']))
    {
        $this->nm_new_label['part_ddd_01'] = "DDD fone 01:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_ddd_01 = $this->part_ddd_01;
   $sStyleHidden_part_ddd_01 = '';
   if (isset($this->nmgp_cmp_hidden['part_ddd_01']) && $this->nmgp_cmp_hidden['part_ddd_01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_ddd_01']);
       $sStyleHidden_part_ddd_01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_ddd_01 = 'display: none;';
   $sStyleReadInp_part_ddd_01 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_ddd_01']) && $this->nmgp_cmp_readonly['part_ddd_01'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_ddd_01']);
       $sStyleReadLab_part_ddd_01 = '';
       $sStyleReadInp_part_ddd_01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_ddd_01']) && $this->nmgp_cmp_hidden['part_ddd_01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_ddd_01" value="<?php echo $this->form_encode_input($part_ddd_01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_ddd_01_label" id="hidden_field_label_part_ddd_01" style="<?php echo $sStyleHidden_part_ddd_01; ?>"><span id="id_label_part_ddd_01"><?php echo $this->nm_new_label['part_ddd_01']; ?></span></TD>
    <TD class="scFormDataOdd css_part_ddd_01_line" id="hidden_field_data_part_ddd_01" style="<?php echo $sStyleHidden_part_ddd_01; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_ddd_01_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_ddd_01"]) &&  $this->nmgp_cmp_readonly["part_ddd_01"] == "on") { 

 ?>
<input type="hidden" name="part_ddd_01" value="<?php echo $this->form_encode_input($part_ddd_01) . "\">" . $part_ddd_01 . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_ddd_01" class="sc-ui-readonly-part_ddd_01 css_part_ddd_01_line" style="<?php echo $sStyleReadLab_part_ddd_01; ?>"><?php echo $this->form_format_readonly("part_ddd_01", $this->form_encode_input($this->part_ddd_01)); ?></span><span id="id_read_off_part_ddd_01" class="css_read_off_part_ddd_01<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_ddd_01; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_ddd_01_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_ddd_01" type=text name="part_ddd_01" value="<?php echo $this->form_encode_input($part_ddd_01) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=3"; } ?> maxlength=3 alt="{datatype: 'text', maxLength: 3, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_ddd_01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_ddd_01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['part_fone_01']))
    {
        $this->nm_new_label['part_fone_01'] = "Fone 01:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_fone_01 = $this->part_fone_01;
   $sStyleHidden_part_fone_01 = '';
   if (isset($this->nmgp_cmp_hidden['part_fone_01']) && $this->nmgp_cmp_hidden['part_fone_01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_fone_01']);
       $sStyleHidden_part_fone_01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_fone_01 = 'display: none;';
   $sStyleReadInp_part_fone_01 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_fone_01']) && $this->nmgp_cmp_readonly['part_fone_01'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_fone_01']);
       $sStyleReadLab_part_fone_01 = '';
       $sStyleReadInp_part_fone_01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_fone_01']) && $this->nmgp_cmp_hidden['part_fone_01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_fone_01" value="<?php echo $this->form_encode_input($part_fone_01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_fone_01_label" id="hidden_field_label_part_fone_01" style="<?php echo $sStyleHidden_part_fone_01; ?>"><span id="id_label_part_fone_01"><?php echo $this->nm_new_label['part_fone_01']; ?></span></TD>
    <TD class="scFormDataOdd css_part_fone_01_line" id="hidden_field_data_part_fone_01" style="<?php echo $sStyleHidden_part_fone_01; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_fone_01_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_fone_01"]) &&  $this->nmgp_cmp_readonly["part_fone_01"] == "on") { 

 ?>
<input type="hidden" name="part_fone_01" value="<?php echo $this->form_encode_input($part_fone_01) . "\">" . $part_fone_01 . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_fone_01" class="sc-ui-readonly-part_fone_01 css_part_fone_01_line" style="<?php echo $sStyleReadLab_part_fone_01; ?>"><?php echo $this->form_format_readonly("part_fone_01", $this->form_encode_input($this->part_fone_01)); ?></span><span id="id_read_off_part_fone_01" class="css_read_off_part_fone_01<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_fone_01; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_fone_01_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_fone_01" type=text name="part_fone_01" value="<?php echo $this->form_encode_input($part_fone_01) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=29 alt="{datatype: 'mask', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '9999-9999', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_fone_01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_fone_01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_ddd_celular_01']))
    {
        $this->nm_new_label['part_ddd_celular_01'] = "DDD Celular 01:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_ddd_celular_01 = $this->part_ddd_celular_01;
   $sStyleHidden_part_ddd_celular_01 = '';
   if (isset($this->nmgp_cmp_hidden['part_ddd_celular_01']) && $this->nmgp_cmp_hidden['part_ddd_celular_01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_ddd_celular_01']);
       $sStyleHidden_part_ddd_celular_01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_ddd_celular_01 = 'display: none;';
   $sStyleReadInp_part_ddd_celular_01 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_ddd_celular_01']) && $this->nmgp_cmp_readonly['part_ddd_celular_01'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_ddd_celular_01']);
       $sStyleReadLab_part_ddd_celular_01 = '';
       $sStyleReadInp_part_ddd_celular_01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_ddd_celular_01']) && $this->nmgp_cmp_hidden['part_ddd_celular_01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_ddd_celular_01" value="<?php echo $this->form_encode_input($part_ddd_celular_01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_ddd_celular_01_label" id="hidden_field_label_part_ddd_celular_01" style="<?php echo $sStyleHidden_part_ddd_celular_01; ?>"><span id="id_label_part_ddd_celular_01"><?php echo $this->nm_new_label['part_ddd_celular_01']; ?></span></TD>
    <TD class="scFormDataOdd css_part_ddd_celular_01_line" id="hidden_field_data_part_ddd_celular_01" style="<?php echo $sStyleHidden_part_ddd_celular_01; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_ddd_celular_01_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_ddd_celular_01"]) &&  $this->nmgp_cmp_readonly["part_ddd_celular_01"] == "on") { 

 ?>
<input type="hidden" name="part_ddd_celular_01" value="<?php echo $this->form_encode_input($part_ddd_celular_01) . "\">" . $part_ddd_celular_01 . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_ddd_celular_01" class="sc-ui-readonly-part_ddd_celular_01 css_part_ddd_celular_01_line" style="<?php echo $sStyleReadLab_part_ddd_celular_01; ?>"><?php echo $this->form_format_readonly("part_ddd_celular_01", $this->form_encode_input($this->part_ddd_celular_01)); ?></span><span id="id_read_off_part_ddd_celular_01" class="css_read_off_part_ddd_celular_01<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_ddd_celular_01; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_ddd_celular_01_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_ddd_celular_01" type=text name="part_ddd_celular_01" value="<?php echo $this->form_encode_input($part_ddd_celular_01) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=3"; } ?> maxlength=3 alt="{datatype: 'text', maxLength: 3, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_ddd_celular_01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_ddd_celular_01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['part_celeular_01']))
    {
        $this->nm_new_label['part_celeular_01'] = "Celular 01:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_celeular_01 = $this->part_celeular_01;
   $sStyleHidden_part_celeular_01 = '';
   if (isset($this->nmgp_cmp_hidden['part_celeular_01']) && $this->nmgp_cmp_hidden['part_celeular_01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_celeular_01']);
       $sStyleHidden_part_celeular_01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_celeular_01 = 'display: none;';
   $sStyleReadInp_part_celeular_01 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_celeular_01']) && $this->nmgp_cmp_readonly['part_celeular_01'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_celeular_01']);
       $sStyleReadLab_part_celeular_01 = '';
       $sStyleReadInp_part_celeular_01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_celeular_01']) && $this->nmgp_cmp_hidden['part_celeular_01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_celeular_01" value="<?php echo $this->form_encode_input($part_celeular_01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_celeular_01_label" id="hidden_field_label_part_celeular_01" style="<?php echo $sStyleHidden_part_celeular_01; ?>"><span id="id_label_part_celeular_01"><?php echo $this->nm_new_label['part_celeular_01']; ?></span></TD>
    <TD class="scFormDataOdd css_part_celeular_01_line" id="hidden_field_data_part_celeular_01" style="<?php echo $sStyleHidden_part_celeular_01; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_celeular_01_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_celeular_01"]) &&  $this->nmgp_cmp_readonly["part_celeular_01"] == "on") { 

 ?>
<input type="hidden" name="part_celeular_01" value="<?php echo $this->form_encode_input($part_celeular_01) . "\">" . $part_celeular_01 . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_celeular_01" class="sc-ui-readonly-part_celeular_01 css_part_celeular_01_line" style="<?php echo $sStyleReadLab_part_celeular_01; ?>"><?php echo $this->form_format_readonly("part_celeular_01", $this->form_encode_input($this->part_celeular_01)); ?></span><span id="id_read_off_part_celeular_01" class="css_read_off_part_celeular_01<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_celeular_01; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_celeular_01_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_celeular_01" type=text name="part_celeular_01" value="<?php echo $this->form_encode_input($part_celeular_01) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=30 alt="{datatype: 'mask', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '99999-9999', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_celeular_01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_celeular_01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['codigo_telefone_internacional']))
    {
        $this->nm_new_label['codigo_telefone_internacional'] = "Código Telefone Internacional:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $sStyleHidden_codigo_telefone_internacional = '';
   if (isset($this->nmgp_cmp_hidden['codigo_telefone_internacional']) && $this->nmgp_cmp_hidden['codigo_telefone_internacional'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['codigo_telefone_internacional']);
       $sStyleHidden_codigo_telefone_internacional = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_codigo_telefone_internacional = 'display: none;';
   $sStyleReadInp_codigo_telefone_internacional = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['codigo_telefone_internacional']) && $this->nmgp_cmp_readonly['codigo_telefone_internacional'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['codigo_telefone_internacional']);
       $sStyleReadLab_codigo_telefone_internacional = '';
       $sStyleReadInp_codigo_telefone_internacional = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['codigo_telefone_internacional']) && $this->nmgp_cmp_hidden['codigo_telefone_internacional'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="codigo_telefone_internacional" value="<?php echo $this->form_encode_input($codigo_telefone_internacional) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_codigo_telefone_internacional_label" id="hidden_field_label_codigo_telefone_internacional" style="<?php echo $sStyleHidden_codigo_telefone_internacional; ?>"><span id="id_label_codigo_telefone_internacional"><?php echo $this->nm_new_label['codigo_telefone_internacional']; ?></span></TD>
    <TD class="scFormDataOdd css_codigo_telefone_internacional_line" id="hidden_field_data_codigo_telefone_internacional" style="<?php echo $sStyleHidden_codigo_telefone_internacional; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_codigo_telefone_internacional_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["codigo_telefone_internacional"]) &&  $this->nmgp_cmp_readonly["codigo_telefone_internacional"] == "on") { 

 ?>
<input type="hidden" name="codigo_telefone_internacional" value="<?php echo $this->form_encode_input($codigo_telefone_internacional) . "\">" . $codigo_telefone_internacional . ""; ?>
<?php } else { ?>
<span id="id_read_on_codigo_telefone_internacional" class="sc-ui-readonly-codigo_telefone_internacional css_codigo_telefone_internacional_line" style="<?php echo $sStyleReadLab_codigo_telefone_internacional; ?>"><?php echo $this->form_format_readonly("codigo_telefone_internacional", $this->form_encode_input($this->codigo_telefone_internacional)); ?></span><span id="id_read_off_codigo_telefone_internacional" class="css_read_off_codigo_telefone_internacional<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_codigo_telefone_internacional; ?>">
 <input class="sc-js-input scFormObjectOdd css_codigo_telefone_internacional_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_codigo_telefone_internacional" type=text name="codigo_telefone_internacional" value="<?php echo $this->form_encode_input($codigo_telefone_internacional) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> maxlength=9 alt="{datatype: 'mask', maxLength: 5, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '+999', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codigo_telefone_internacional_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codigo_telefone_internacional_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['part_fone_internacional']))
    {
        $this->nm_new_label['part_fone_internacional'] = " Fone Internacional:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_fone_internacional = $this->part_fone_internacional;
   $sStyleHidden_part_fone_internacional = '';
   if (isset($this->nmgp_cmp_hidden['part_fone_internacional']) && $this->nmgp_cmp_hidden['part_fone_internacional'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_fone_internacional']);
       $sStyleHidden_part_fone_internacional = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_fone_internacional = 'display: none;';
   $sStyleReadInp_part_fone_internacional = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_fone_internacional']) && $this->nmgp_cmp_readonly['part_fone_internacional'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_fone_internacional']);
       $sStyleReadLab_part_fone_internacional = '';
       $sStyleReadInp_part_fone_internacional = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_fone_internacional']) && $this->nmgp_cmp_hidden['part_fone_internacional'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_fone_internacional" value="<?php echo $this->form_encode_input($part_fone_internacional) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_fone_internacional_label" id="hidden_field_label_part_fone_internacional" style="<?php echo $sStyleHidden_part_fone_internacional; ?>"><span id="id_label_part_fone_internacional"><?php echo $this->nm_new_label['part_fone_internacional']; ?></span></TD>
    <TD class="scFormDataOdd css_part_fone_internacional_line" id="hidden_field_data_part_fone_internacional" style="<?php echo $sStyleHidden_part_fone_internacional; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_fone_internacional_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_fone_internacional"]) &&  $this->nmgp_cmp_readonly["part_fone_internacional"] == "on") { 

 ?>
<input type="hidden" name="part_fone_internacional" value="<?php echo $this->form_encode_input($part_fone_internacional) . "\">" . $part_fone_internacional . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_fone_internacional" class="sc-ui-readonly-part_fone_internacional css_part_fone_internacional_line" style="<?php echo $sStyleReadLab_part_fone_internacional; ?>"><?php echo $this->form_format_readonly("part_fone_internacional", $this->form_encode_input($this->part_fone_internacional)); ?></span><span id="id_read_off_part_fone_internacional" class="css_read_off_part_fone_internacional<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_fone_internacional; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_fone_internacional_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_fone_internacional" type=text name="part_fone_internacional" value="<?php echo $this->form_encode_input($part_fone_internacional) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_fone_internacional_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_fone_internacional_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_5"></a>
<div id="div_hidden_bloco_5" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_5" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_rg']))
    {
        $this->nm_new_label['part_rg'] = "RG:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_rg = $this->part_rg;
   $sStyleHidden_part_rg = '';
   if (isset($this->nmgp_cmp_hidden['part_rg']) && $this->nmgp_cmp_hidden['part_rg'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_rg']);
       $sStyleHidden_part_rg = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_rg = 'display: none;';
   $sStyleReadInp_part_rg = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_rg']) && $this->nmgp_cmp_readonly['part_rg'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_rg']);
       $sStyleReadLab_part_rg = '';
       $sStyleReadInp_part_rg = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_rg']) && $this->nmgp_cmp_hidden['part_rg'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_rg" value="<?php echo $this->form_encode_input($part_rg) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_rg_label" id="hidden_field_label_part_rg" style="<?php echo $sStyleHidden_part_rg; ?>"><span id="id_label_part_rg"><?php echo $this->nm_new_label['part_rg']; ?></span></TD>
    <TD class="scFormDataOdd css_part_rg_line" id="hidden_field_data_part_rg" style="<?php echo $sStyleHidden_part_rg; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_rg_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_rg"]) &&  $this->nmgp_cmp_readonly["part_rg"] == "on") { 

 ?>
<input type="hidden" name="part_rg" value="<?php echo $this->form_encode_input($part_rg) . "\">" . $part_rg . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_rg" class="sc-ui-readonly-part_rg css_part_rg_line" style="<?php echo $sStyleReadLab_part_rg; ?>"><?php echo $this->form_format_readonly("part_rg", $this->form_encode_input($this->part_rg)); ?></span><span id="id_read_off_part_rg" class="css_read_off_part_rg<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_rg; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_rg_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_rg" type=text name="part_rg" value="<?php echo $this->form_encode_input($part_rg) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_rg_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_rg_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_passaporte']))
    {
        $this->nm_new_label['part_passaporte'] = "Passaporte:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_passaporte = $this->part_passaporte;
   $sStyleHidden_part_passaporte = '';
   if (isset($this->nmgp_cmp_hidden['part_passaporte']) && $this->nmgp_cmp_hidden['part_passaporte'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_passaporte']);
       $sStyleHidden_part_passaporte = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_passaporte = 'display: none;';
   $sStyleReadInp_part_passaporte = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_passaporte']) && $this->nmgp_cmp_readonly['part_passaporte'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_passaporte']);
       $sStyleReadLab_part_passaporte = '';
       $sStyleReadInp_part_passaporte = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_passaporte']) && $this->nmgp_cmp_hidden['part_passaporte'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_passaporte" value="<?php echo $this->form_encode_input($part_passaporte) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_passaporte_label" id="hidden_field_label_part_passaporte" style="<?php echo $sStyleHidden_part_passaporte; ?>"><span id="id_label_part_passaporte"><?php echo $this->nm_new_label['part_passaporte']; ?></span></TD>
    <TD class="scFormDataOdd css_part_passaporte_line" id="hidden_field_data_part_passaporte" style="<?php echo $sStyleHidden_part_passaporte; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_passaporte_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_passaporte"]) &&  $this->nmgp_cmp_readonly["part_passaporte"] == "on") { 

 ?>
<input type="hidden" name="part_passaporte" value="<?php echo $this->form_encode_input($part_passaporte) . "\">" . $part_passaporte . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_passaporte" class="sc-ui-readonly-part_passaporte css_part_passaporte_line" style="<?php echo $sStyleReadLab_part_passaporte; ?>"><?php echo $this->form_format_readonly("part_passaporte", $this->form_encode_input($this->part_passaporte)); ?></span><span id="id_read_off_part_passaporte" class="css_read_off_part_passaporte<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_passaporte; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_passaporte_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_passaporte" type=text name="part_passaporte" value="<?php echo $this->form_encode_input($part_passaporte) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_passaporte_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_passaporte_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['emissao_passaporte']))
    {
        $this->nm_new_label['emissao_passaporte'] = "Emissão Passaporte:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $emissao_passaporte = $this->emissao_passaporte;
   $sStyleHidden_emissao_passaporte = '';
   if (isset($this->nmgp_cmp_hidden['emissao_passaporte']) && $this->nmgp_cmp_hidden['emissao_passaporte'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['emissao_passaporte']);
       $sStyleHidden_emissao_passaporte = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_emissao_passaporte = 'display: none;';
   $sStyleReadInp_emissao_passaporte = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['emissao_passaporte']) && $this->nmgp_cmp_readonly['emissao_passaporte'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['emissao_passaporte']);
       $sStyleReadLab_emissao_passaporte = '';
       $sStyleReadInp_emissao_passaporte = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['emissao_passaporte']) && $this->nmgp_cmp_hidden['emissao_passaporte'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="emissao_passaporte" value="<?php echo $this->form_encode_input($emissao_passaporte) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_emissao_passaporte_label" id="hidden_field_label_emissao_passaporte" style="<?php echo $sStyleHidden_emissao_passaporte; ?>"><span id="id_label_emissao_passaporte"><?php echo $this->nm_new_label['emissao_passaporte']; ?></span></TD>
    <TD class="scFormDataOdd css_emissao_passaporte_line" id="hidden_field_data_emissao_passaporte" style="<?php echo $sStyleHidden_emissao_passaporte; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_emissao_passaporte_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["emissao_passaporte"]) &&  $this->nmgp_cmp_readonly["emissao_passaporte"] == "on") { 

 ?>
<input type="hidden" name="emissao_passaporte" value="<?php echo $this->form_encode_input($emissao_passaporte) . "\">" . $emissao_passaporte . ""; ?>
<?php } else { ?>
<span id="id_read_on_emissao_passaporte" class="sc-ui-readonly-emissao_passaporte css_emissao_passaporte_line" style="<?php echo $sStyleReadLab_emissao_passaporte; ?>"><?php echo $this->form_format_readonly("emissao_passaporte", $this->form_encode_input($emissao_passaporte)); ?></span><span id="id_read_off_emissao_passaporte" class="css_read_off_emissao_passaporte<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_emissao_passaporte; ?>"><?php
$tmp_form_data = $this->field_config['emissao_passaporte']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_emissao_passaporte_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_emissao_passaporte" type=text name="emissao_passaporte" value="<?php echo $this->form_encode_input($emissao_passaporte) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['emissao_passaporte']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['emissao_passaporte']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_emissao_passaporte_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_emissao_passaporte_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_validade_pass']))
    {
        $this->nm_new_label['part_validade_pass'] = "Validade Passaporte:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_validade_pass = $this->part_validade_pass;
   $sStyleHidden_part_validade_pass = '';
   if (isset($this->nmgp_cmp_hidden['part_validade_pass']) && $this->nmgp_cmp_hidden['part_validade_pass'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_validade_pass']);
       $sStyleHidden_part_validade_pass = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_validade_pass = 'display: none;';
   $sStyleReadInp_part_validade_pass = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_validade_pass']) && $this->nmgp_cmp_readonly['part_validade_pass'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_validade_pass']);
       $sStyleReadLab_part_validade_pass = '';
       $sStyleReadInp_part_validade_pass = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_validade_pass']) && $this->nmgp_cmp_hidden['part_validade_pass'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_validade_pass" value="<?php echo $this->form_encode_input($part_validade_pass) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_validade_pass_label" id="hidden_field_label_part_validade_pass" style="<?php echo $sStyleHidden_part_validade_pass; ?>"><span id="id_label_part_validade_pass"><?php echo $this->nm_new_label['part_validade_pass']; ?></span></TD>
    <TD class="scFormDataOdd css_part_validade_pass_line" id="hidden_field_data_part_validade_pass" style="<?php echo $sStyleHidden_part_validade_pass; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_validade_pass_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_validade_pass"]) &&  $this->nmgp_cmp_readonly["part_validade_pass"] == "on") { 

 ?>
<input type="hidden" name="part_validade_pass" value="<?php echo $this->form_encode_input($part_validade_pass) . "\">" . $part_validade_pass . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_validade_pass" class="sc-ui-readonly-part_validade_pass css_part_validade_pass_line" style="<?php echo $sStyleReadLab_part_validade_pass; ?>"><?php echo $this->form_format_readonly("part_validade_pass", $this->form_encode_input($part_validade_pass)); ?></span><span id="id_read_off_part_validade_pass" class="css_read_off_part_validade_pass<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_validade_pass; ?>"><?php
$tmp_form_data = $this->field_config['part_validade_pass']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_part_validade_pass_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_validade_pass" type=text name="part_validade_pass" value="<?php echo $this->form_encode_input($part_validade_pass) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['part_validade_pass']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['part_validade_pass']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_validade_pass_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_validade_pass_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_passaporte_estrangeiro']))
    {
        $this->nm_new_label['part_passaporte_estrangeiro'] = "Passaporte Estrangeiro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_passaporte_estrangeiro = $this->part_passaporte_estrangeiro;
   $sStyleHidden_part_passaporte_estrangeiro = '';
   if (isset($this->nmgp_cmp_hidden['part_passaporte_estrangeiro']) && $this->nmgp_cmp_hidden['part_passaporte_estrangeiro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_passaporte_estrangeiro']);
       $sStyleHidden_part_passaporte_estrangeiro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_passaporte_estrangeiro = 'display: none;';
   $sStyleReadInp_part_passaporte_estrangeiro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_passaporte_estrangeiro']) && $this->nmgp_cmp_readonly['part_passaporte_estrangeiro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_passaporte_estrangeiro']);
       $sStyleReadLab_part_passaporte_estrangeiro = '';
       $sStyleReadInp_part_passaporte_estrangeiro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_passaporte_estrangeiro']) && $this->nmgp_cmp_hidden['part_passaporte_estrangeiro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_passaporte_estrangeiro" value="<?php echo $this->form_encode_input($part_passaporte_estrangeiro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_passaporte_estrangeiro_label" id="hidden_field_label_part_passaporte_estrangeiro" style="<?php echo $sStyleHidden_part_passaporte_estrangeiro; ?>"><span id="id_label_part_passaporte_estrangeiro"><?php echo $this->nm_new_label['part_passaporte_estrangeiro']; ?></span></TD>
    <TD class="scFormDataOdd css_part_passaporte_estrangeiro_line" id="hidden_field_data_part_passaporte_estrangeiro" style="<?php echo $sStyleHidden_part_passaporte_estrangeiro; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_passaporte_estrangeiro_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_passaporte_estrangeiro"]) &&  $this->nmgp_cmp_readonly["part_passaporte_estrangeiro"] == "on") { 

 if ("N" == $this->part_passaporte_estrangeiro) { $part_passaporte_estrangeiro_look = "Não";} 
 if ("Y" == $this->part_passaporte_estrangeiro) { $part_passaporte_estrangeiro_look = "Sim";} 
?>
<input type="hidden" name="part_passaporte_estrangeiro" value="<?php echo $this->form_encode_input($part_passaporte_estrangeiro) . "\">" . $part_passaporte_estrangeiro_look . ""; ?>
<?php } else { ?>

<?php

 if ("N" == $this->part_passaporte_estrangeiro) { $part_passaporte_estrangeiro_look = "Não";} 
 if ("Y" == $this->part_passaporte_estrangeiro) { $part_passaporte_estrangeiro_look = "Sim";} 
?>
<span id="id_read_on_part_passaporte_estrangeiro"  class="css_part_passaporte_estrangeiro_line" style="<?php echo $sStyleReadLab_part_passaporte_estrangeiro; ?>"><?php echo $this->form_format_readonly("part_passaporte_estrangeiro", $this->form_encode_input($part_passaporte_estrangeiro_look)); ?></span><span id="id_read_off_part_passaporte_estrangeiro" class="css_read_off_part_passaporte_estrangeiro css_part_passaporte_estrangeiro_line" style="<?php echo $sStyleReadInp_part_passaporte_estrangeiro; ?>"><div id="idAjaxRadio_part_passaporte_estrangeiro" style="display: inline-block"  class="css_part_passaporte_estrangeiro_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_part_passaporte_estrangeiro_line"><?php $tempOptionId = "id-opt-part_passaporte_estrangeiro" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_passaporte_estrangeiro sc-ui-radio-part_passaporte_estrangeiro sc-js-input" type=radio name="part_passaporte_estrangeiro" value="N"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_passaporte_estrangeiro'][] = 'N'; ?>
<?php  if ("N" == $this->part_passaporte_estrangeiro)  { echo " checked" ;} ?><?php  if (empty($this->part_passaporte_estrangeiro)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_part_passaporte_estrangeiro_line"><?php $tempOptionId = "id-opt-part_passaporte_estrangeiro" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_passaporte_estrangeiro sc-ui-radio-part_passaporte_estrangeiro sc-js-input" type=radio name="part_passaporte_estrangeiro" value="Y"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_passaporte_estrangeiro'][] = 'Y'; ?>
<?php  if ("Y" == $this->part_passaporte_estrangeiro)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_passaporte_estrangeiro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_passaporte_estrangeiro_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_cpf_informado']))
    {
        $this->nm_new_label['part_cpf_informado'] = "CPF";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_cpf_informado = $this->part_cpf_informado;
   $sStyleHidden_part_cpf_informado = '';
   if (isset($this->nmgp_cmp_hidden['part_cpf_informado']) && $this->nmgp_cmp_hidden['part_cpf_informado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_cpf_informado']);
       $sStyleHidden_part_cpf_informado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_cpf_informado = 'display: none;';
   $sStyleReadInp_part_cpf_informado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_cpf_informado']) && $this->nmgp_cmp_readonly['part_cpf_informado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_cpf_informado']);
       $sStyleReadLab_part_cpf_informado = '';
       $sStyleReadInp_part_cpf_informado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_cpf_informado']) && $this->nmgp_cmp_hidden['part_cpf_informado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_cpf_informado" value="<?php echo $this->form_encode_input($part_cpf_informado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_cpf_informado_label" id="hidden_field_label_part_cpf_informado" style="<?php echo $sStyleHidden_part_cpf_informado; ?>"><span id="id_label_part_cpf_informado"><?php echo $this->nm_new_label['part_cpf_informado']; ?></span></TD>
    <TD class="scFormDataOdd css_part_cpf_informado_line" id="hidden_field_data_part_cpf_informado" style="<?php echo $sStyleHidden_part_cpf_informado; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_cpf_informado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_cpf_informado"]) &&  $this->nmgp_cmp_readonly["part_cpf_informado"] == "on") { 

 ?>
<input type="hidden" name="part_cpf_informado" value="<?php echo $this->form_encode_input($part_cpf_informado) . "\">" . $part_cpf_informado . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_cpf_informado" class="sc-ui-readonly-part_cpf_informado css_part_cpf_informado_line" style="<?php echo $sStyleReadLab_part_cpf_informado; ?>"><?php echo $this->form_format_readonly("part_cpf_informado", $this->form_encode_input($this->part_cpf_informado)); ?></span><span id="id_read_off_part_cpf_informado" class="css_read_off_part_cpf_informado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_cpf_informado; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_cpf_informado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_cpf_informado" type=text name="part_cpf_informado" value="<?php echo $this->form_encode_input($part_cpf_informado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=17"; } ?> alt="{datatype: 'cpf', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_cpf_informado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_cpf_informado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_nacionalidade']))
    {
        $this->nm_new_label['part_nacionalidade'] = "Nacionalidade (APP):";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_nacionalidade = $this->part_nacionalidade;
   $sStyleHidden_part_nacionalidade = '';
   if (isset($this->nmgp_cmp_hidden['part_nacionalidade']) && $this->nmgp_cmp_hidden['part_nacionalidade'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_nacionalidade']);
       $sStyleHidden_part_nacionalidade = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_nacionalidade = 'display: none;';
   $sStyleReadInp_part_nacionalidade = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_nacionalidade']) && $this->nmgp_cmp_readonly['part_nacionalidade'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_nacionalidade']);
       $sStyleReadLab_part_nacionalidade = '';
       $sStyleReadInp_part_nacionalidade = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_nacionalidade']) && $this->nmgp_cmp_hidden['part_nacionalidade'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_nacionalidade" value="<?php echo $this->form_encode_input($part_nacionalidade) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_nacionalidade_label" id="hidden_field_label_part_nacionalidade" style="<?php echo $sStyleHidden_part_nacionalidade; ?>"><span id="id_label_part_nacionalidade"><?php echo $this->nm_new_label['part_nacionalidade']; ?></span></TD>
    <TD class="scFormDataOdd css_part_nacionalidade_line" id="hidden_field_data_part_nacionalidade" style="<?php echo $sStyleHidden_part_nacionalidade; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_nacionalidade_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_nacionalidade"]) &&  $this->nmgp_cmp_readonly["part_nacionalidade"] == "on") { 

 ?>
<input type="hidden" name="part_nacionalidade" value="<?php echo $this->form_encode_input($part_nacionalidade) . "\">" . $part_nacionalidade . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_nacionalidade" class="sc-ui-readonly-part_nacionalidade css_part_nacionalidade_line" style="<?php echo $sStyleReadLab_part_nacionalidade; ?>"><?php echo $this->form_format_readonly("part_nacionalidade", $this->form_encode_input($this->part_nacionalidade)); ?></span><span id="id_read_off_part_nacionalidade" class="css_read_off_part_nacionalidade<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_nacionalidade; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_nacionalidade_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_nacionalidade" type=text name="part_nacionalidade" value="<?php echo $this->form_encode_input($part_nacionalidade) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_nacionalidade_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_nacionalidade_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_vacina_fa']))
    {
        $this->nm_new_label['part_vacina_fa'] = "Vacina Febre Amarela (APP):";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_vacina_fa = $this->part_vacina_fa;
   $sStyleHidden_part_vacina_fa = '';
   if (isset($this->nmgp_cmp_hidden['part_vacina_fa']) && $this->nmgp_cmp_hidden['part_vacina_fa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_vacina_fa']);
       $sStyleHidden_part_vacina_fa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_vacina_fa = 'display: none;';
   $sStyleReadInp_part_vacina_fa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_vacina_fa']) && $this->nmgp_cmp_readonly['part_vacina_fa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_vacina_fa']);
       $sStyleReadLab_part_vacina_fa = '';
       $sStyleReadInp_part_vacina_fa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_vacina_fa']) && $this->nmgp_cmp_hidden['part_vacina_fa'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_vacina_fa" value="<?php echo $this->form_encode_input($part_vacina_fa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_vacina_fa_label" id="hidden_field_label_part_vacina_fa" style="<?php echo $sStyleHidden_part_vacina_fa; ?>"><span id="id_label_part_vacina_fa"><?php echo $this->nm_new_label['part_vacina_fa']; ?></span></TD>
    <TD class="scFormDataOdd css_part_vacina_fa_line" id="hidden_field_data_part_vacina_fa" style="<?php echo $sStyleHidden_part_vacina_fa; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_vacina_fa_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_vacina_fa"]) &&  $this->nmgp_cmp_readonly["part_vacina_fa"] == "on") { 

 ?>
<input type="hidden" name="part_vacina_fa" value="<?php echo $this->form_encode_input($part_vacina_fa) . "\">" . $part_vacina_fa . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_vacina_fa" class="sc-ui-readonly-part_vacina_fa css_part_vacina_fa_line" style="<?php echo $sStyleReadLab_part_vacina_fa; ?>"><?php echo $this->form_format_readonly("part_vacina_fa", $this->form_encode_input($part_vacina_fa)); ?></span><span id="id_read_off_part_vacina_fa" class="css_read_off_part_vacina_fa<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_vacina_fa; ?>"><?php
$tmp_form_data = $this->field_config['part_vacina_fa']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_part_vacina_fa_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_vacina_fa" type=text name="part_vacina_fa" value="<?php echo $this->form_encode_input($part_vacina_fa) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['part_vacina_fa']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['part_vacina_fa']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_vacina_fa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_vacina_fa_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['validade_visto']))
    {
        $this->nm_new_label['validade_visto'] = "Validade Visto (APP):";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $validade_visto = $this->validade_visto;
   $sStyleHidden_validade_visto = '';
   if (isset($this->nmgp_cmp_hidden['validade_visto']) && $this->nmgp_cmp_hidden['validade_visto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['validade_visto']);
       $sStyleHidden_validade_visto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_validade_visto = 'display: none;';
   $sStyleReadInp_validade_visto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['validade_visto']) && $this->nmgp_cmp_readonly['validade_visto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['validade_visto']);
       $sStyleReadLab_validade_visto = '';
       $sStyleReadInp_validade_visto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['validade_visto']) && $this->nmgp_cmp_hidden['validade_visto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="validade_visto" value="<?php echo $this->form_encode_input($validade_visto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_validade_visto_label" id="hidden_field_label_validade_visto" style="<?php echo $sStyleHidden_validade_visto; ?>"><span id="id_label_validade_visto"><?php echo $this->nm_new_label['validade_visto']; ?></span></TD>
    <TD class="scFormDataOdd css_validade_visto_line" id="hidden_field_data_validade_visto" style="<?php echo $sStyleHidden_validade_visto; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_validade_visto_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["validade_visto"]) &&  $this->nmgp_cmp_readonly["validade_visto"] == "on") { 

 ?>
<input type="hidden" name="validade_visto" value="<?php echo $this->form_encode_input($validade_visto) . "\">" . $validade_visto . ""; ?>
<?php } else { ?>
<span id="id_read_on_validade_visto" class="sc-ui-readonly-validade_visto css_validade_visto_line" style="<?php echo $sStyleReadLab_validade_visto; ?>"><?php echo $this->form_format_readonly("validade_visto", $this->form_encode_input($validade_visto)); ?></span><span id="id_read_off_validade_visto" class="css_read_off_validade_visto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_validade_visto; ?>"><?php
$tmp_form_data = $this->field_config['validade_visto']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_validade_visto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_validade_visto" type=text name="validade_visto" value="<?php echo $this->form_encode_input($validade_visto) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['validade_visto']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['validade_visto']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_validade_visto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_validade_visto_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['numero_visto']))
    {
        $this->nm_new_label['numero_visto'] = "Número(s) Visto(s) (APP):";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $numero_visto = $this->numero_visto;
   $sStyleHidden_numero_visto = '';
   if (isset($this->nmgp_cmp_hidden['numero_visto']) && $this->nmgp_cmp_hidden['numero_visto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['numero_visto']);
       $sStyleHidden_numero_visto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_numero_visto = 'display: none;';
   $sStyleReadInp_numero_visto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['numero_visto']) && $this->nmgp_cmp_readonly['numero_visto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['numero_visto']);
       $sStyleReadLab_numero_visto = '';
       $sStyleReadInp_numero_visto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['numero_visto']) && $this->nmgp_cmp_hidden['numero_visto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="numero_visto" value="<?php echo $this->form_encode_input($numero_visto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_numero_visto_label" id="hidden_field_label_numero_visto" style="<?php echo $sStyleHidden_numero_visto; ?>"><span id="id_label_numero_visto"><?php echo $this->nm_new_label['numero_visto']; ?></span></TD>
    <TD class="scFormDataOdd css_numero_visto_line" id="hidden_field_data_numero_visto" style="<?php echo $sStyleHidden_numero_visto; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_numero_visto_line" style="vertical-align: top;padding: 0px">
<?php
$numero_visto_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($numero_visto));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["numero_visto"]) &&  $this->nmgp_cmp_readonly["numero_visto"] == "on") { 

 ?>
<input type="hidden" name="numero_visto" value="<?php echo $this->form_encode_input($numero_visto) . "\">" . $numero_visto_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_numero_visto" class="sc-ui-readonly-numero_visto css_numero_visto_line" style="<?php echo $sStyleReadLab_numero_visto; ?>"><?php echo $this->form_format_readonly("numero_visto", $this->form_encode_input($numero_visto_val)); ?></span><span id="id_read_off_numero_visto" class="css_read_off_numero_visto<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_numero_visto; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_numero_visto_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="numero_visto" id="id_sc_field_numero_visto" rows="2" cols="20"
 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $numero_visto; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_numero_visto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_numero_visto_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_visto']))
    {
        $this->nm_new_label['part_visto'] = "Número(s) Visto(s) (APP):";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_visto = $this->part_visto;
   if (!isset($this->nmgp_cmp_hidden['part_visto']))
   {
       $this->nmgp_cmp_hidden['part_visto'] = 'off';
   }
   $sStyleHidden_part_visto = '';
   if (isset($this->nmgp_cmp_hidden['part_visto']) && $this->nmgp_cmp_hidden['part_visto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_visto']);
       $sStyleHidden_part_visto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_visto = 'display: none;';
   $sStyleReadInp_part_visto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_visto']) && $this->nmgp_cmp_readonly['part_visto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_visto']);
       $sStyleReadLab_part_visto = '';
       $sStyleReadInp_part_visto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_visto']) && $this->nmgp_cmp_hidden['part_visto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_visto" value="<?php echo $this->form_encode_input($part_visto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_visto_label" id="hidden_field_label_part_visto" style="<?php echo $sStyleHidden_part_visto; ?>"><span id="id_label_part_visto"><?php echo $this->nm_new_label['part_visto']; ?></span></TD>
    <TD class="scFormDataOdd css_part_visto_line" id="hidden_field_data_part_visto" style="<?php echo $sStyleHidden_part_visto; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_visto_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="part_visto" value="<?php echo $this->form_encode_input($part_visto); ?>"><span id="id_ajax_label_part_visto"><?php echo nl2br($part_visto); ?></span>

<?php
$part_visto_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($part_visto));

?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_visto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_visto_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_6"></a>
<div id="div_hidden_bloco_6" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_6" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['part_tam_camisa']))
   {
       $this->nm_new_label['part_tam_camisa'] = "Tamanho Camisa:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_tam_camisa = $this->part_tam_camisa;
   $sStyleHidden_part_tam_camisa = '';
   if (isset($this->nmgp_cmp_hidden['part_tam_camisa']) && $this->nmgp_cmp_hidden['part_tam_camisa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_tam_camisa']);
       $sStyleHidden_part_tam_camisa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_tam_camisa = 'display: none;';
   $sStyleReadInp_part_tam_camisa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_tam_camisa']) && $this->nmgp_cmp_readonly['part_tam_camisa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_tam_camisa']);
       $sStyleReadLab_part_tam_camisa = '';
       $sStyleReadInp_part_tam_camisa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_tam_camisa']) && $this->nmgp_cmp_hidden['part_tam_camisa'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="part_tam_camisa" value="<?php echo $this->form_encode_input($this->part_tam_camisa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_tam_camisa_label" id="hidden_field_label_part_tam_camisa" style="<?php echo $sStyleHidden_part_tam_camisa; ?>"><span id="id_label_part_tam_camisa"><?php echo $this->nm_new_label['part_tam_camisa']; ?></span></TD>
    <TD class="scFormDataOdd css_part_tam_camisa_line" id="hidden_field_data_part_tam_camisa" style="<?php echo $sStyleHidden_part_tam_camisa; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_tam_camisa_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_tam_camisa"]) &&  $this->nmgp_cmp_readonly["part_tam_camisa"] == "on") { 

$part_tam_camisa_look = "";
 if ($this->part_tam_camisa == "P") { $part_tam_camisa_look .= "P" ;} 
 if ($this->part_tam_camisa == "M") { $part_tam_camisa_look .= "M" ;} 
 if ($this->part_tam_camisa == "G") { $part_tam_camisa_look .= "G" ;} 
 if ($this->part_tam_camisa == "PP") { $part_tam_camisa_look .= "PP" ;} 
 if ($this->part_tam_camisa == "GG") { $part_tam_camisa_look .= "GG" ;} 
 if ($this->part_tam_camisa == "EG") { $part_tam_camisa_look .= "EG" ;} 
 if ($this->part_tam_camisa == "EGG") { $part_tam_camisa_look .= "EGG" ;} 
 if ($this->part_tam_camisa == "EX") { $part_tam_camisa_look .= "EX" ;} 
 if ($this->part_tam_camisa == "BLP BABY LOOK P") { $part_tam_camisa_look .= "BLP BABY LOOK P" ;} 
 if ($this->part_tam_camisa == "BLM BABY LOOK M") { $part_tam_camisa_look .= "BLM BABY LOOK M" ;} 
 if ($this->part_tam_camisa == "BLG BABY LOOK G") { $part_tam_camisa_look .= "BLG BABY LOOK G" ;} 
 if ($this->part_tam_camisa == "BLGG BABY LOOK GG") { $part_tam_camisa_look .= "BLGG BABY LOOK GG" ;} 
 if (empty($part_tam_camisa_look)) { $part_tam_camisa_look = $this->part_tam_camisa; }
?>
<input type="hidden" name="part_tam_camisa" value="<?php echo $this->form_encode_input($part_tam_camisa) . "\">" . $part_tam_camisa_look . ""; ?>
<?php } else { ?>
<?php

$part_tam_camisa_look = "";
 if ($this->part_tam_camisa == "P") { $part_tam_camisa_look .= "P" ;} 
 if ($this->part_tam_camisa == "M") { $part_tam_camisa_look .= "M" ;} 
 if ($this->part_tam_camisa == "G") { $part_tam_camisa_look .= "G" ;} 
 if ($this->part_tam_camisa == "PP") { $part_tam_camisa_look .= "PP" ;} 
 if ($this->part_tam_camisa == "GG") { $part_tam_camisa_look .= "GG" ;} 
 if ($this->part_tam_camisa == "EG") { $part_tam_camisa_look .= "EG" ;} 
 if ($this->part_tam_camisa == "EGG") { $part_tam_camisa_look .= "EGG" ;} 
 if ($this->part_tam_camisa == "EX") { $part_tam_camisa_look .= "EX" ;} 
 if ($this->part_tam_camisa == "BLP BABY LOOK P") { $part_tam_camisa_look .= "BLP BABY LOOK P" ;} 
 if ($this->part_tam_camisa == "BLM BABY LOOK M") { $part_tam_camisa_look .= "BLM BABY LOOK M" ;} 
 if ($this->part_tam_camisa == "BLG BABY LOOK G") { $part_tam_camisa_look .= "BLG BABY LOOK G" ;} 
 if ($this->part_tam_camisa == "BLGG BABY LOOK GG") { $part_tam_camisa_look .= "BLGG BABY LOOK GG" ;} 
 if (empty($part_tam_camisa_look)) { $part_tam_camisa_look = $this->part_tam_camisa; }
?>
<span id="id_read_on_part_tam_camisa" class="css_part_tam_camisa_line"  style="<?php echo $sStyleReadLab_part_tam_camisa; ?>"><?php echo $this->form_format_readonly("part_tam_camisa", $this->form_encode_input($part_tam_camisa_look)); ?></span><span id="id_read_off_part_tam_camisa" class="css_read_off_part_tam_camisa<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_part_tam_camisa; ?>">
 <span id="idAjaxSelect_part_tam_camisa" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_part_tam_camisa_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_tam_camisa" name="part_tam_camisa" size="1" alt="{type: 'select', enterTab: true}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = ''; ?>
 <option value="">.:selecione.:.</option>
 <option  value="P" <?php  if ($this->part_tam_camisa == "P") { echo " selected" ;} ?>>P</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'P'; ?>
 <option  value="M" <?php  if ($this->part_tam_camisa == "M") { echo " selected" ;} ?>>M</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'M'; ?>
 <option  value="G" <?php  if ($this->part_tam_camisa == "G") { echo " selected" ;} ?>>G</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'G'; ?>
 <option  value="PP" <?php  if ($this->part_tam_camisa == "PP") { echo " selected" ;} ?>>PP</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'PP'; ?>
 <option  value="GG" <?php  if ($this->part_tam_camisa == "GG") { echo " selected" ;} ?>>GG</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'GG'; ?>
 <option  value="EG" <?php  if ($this->part_tam_camisa == "EG") { echo " selected" ;} ?>>EG</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'EG'; ?>
 <option  value="EGG" <?php  if ($this->part_tam_camisa == "EGG") { echo " selected" ;} ?>>EGG</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'EGG'; ?>
 <option  value="EX" <?php  if ($this->part_tam_camisa == "EX") { echo " selected" ;} ?>>EX</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'EX'; ?>
 <option  value="BLP BABY LOOK P" <?php  if ($this->part_tam_camisa == "BLP BABY LOOK P") { echo " selected" ;} ?>>BLP BABY LOOK P</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'BLP BABY LOOK P'; ?>
 <option  value="BLM BABY LOOK M" <?php  if ($this->part_tam_camisa == "BLM BABY LOOK M") { echo " selected" ;} ?>>BLM BABY LOOK M</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'BLM BABY LOOK M'; ?>
 <option  value="BLG BABY LOOK G" <?php  if ($this->part_tam_camisa == "BLG BABY LOOK G") { echo " selected" ;} ?>>BLG BABY LOOK G</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'BLG BABY LOOK G'; ?>
 <option  value="BLGG BABY LOOK GG" <?php  if ($this->part_tam_camisa == "BLGG BABY LOOK GG") { echo " selected" ;} ?>>BLGG BABY LOOK GG</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_tam_camisa'][] = 'BLGG BABY LOOK GG'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_tam_camisa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_tam_camisa_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_tam_calcado']))
    {
        $this->nm_new_label['part_tam_calcado'] = "Tamanho Calçado:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_tam_calcado = $this->part_tam_calcado;
   $sStyleHidden_part_tam_calcado = '';
   if (isset($this->nmgp_cmp_hidden['part_tam_calcado']) && $this->nmgp_cmp_hidden['part_tam_calcado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_tam_calcado']);
       $sStyleHidden_part_tam_calcado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_tam_calcado = 'display: none;';
   $sStyleReadInp_part_tam_calcado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_tam_calcado']) && $this->nmgp_cmp_readonly['part_tam_calcado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_tam_calcado']);
       $sStyleReadLab_part_tam_calcado = '';
       $sStyleReadInp_part_tam_calcado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_tam_calcado']) && $this->nmgp_cmp_hidden['part_tam_calcado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_tam_calcado" value="<?php echo $this->form_encode_input($part_tam_calcado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_tam_calcado_label" id="hidden_field_label_part_tam_calcado" style="<?php echo $sStyleHidden_part_tam_calcado; ?>"><span id="id_label_part_tam_calcado"><?php echo $this->nm_new_label['part_tam_calcado']; ?></span></TD>
    <TD class="scFormDataOdd css_part_tam_calcado_line" id="hidden_field_data_part_tam_calcado" style="<?php echo $sStyleHidden_part_tam_calcado; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_tam_calcado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_tam_calcado"]) &&  $this->nmgp_cmp_readonly["part_tam_calcado"] == "on") { 

 ?>
<input type="hidden" name="part_tam_calcado" value="<?php echo $this->form_encode_input($part_tam_calcado) . "\">" . $part_tam_calcado . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_tam_calcado" class="sc-ui-readonly-part_tam_calcado css_part_tam_calcado_line" style="<?php echo $sStyleReadLab_part_tam_calcado; ?>"><?php echo $this->form_format_readonly("part_tam_calcado", $this->form_encode_input($this->part_tam_calcado)); ?></span><span id="id_read_off_part_tam_calcado" class="css_read_off_part_tam_calcado<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_tam_calcado; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_tam_calcado_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_tam_calcado" type=text name="part_tam_calcado" value="<?php echo $this->form_encode_input($part_tam_calcado) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_tam_calcado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_tam_calcado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['part_idioma']))
   {
       $this->nm_new_label['part_idioma'] = "Idioma:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_idioma = $this->part_idioma;
   $sStyleHidden_part_idioma = '';
   if (isset($this->nmgp_cmp_hidden['part_idioma']) && $this->nmgp_cmp_hidden['part_idioma'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_idioma']);
       $sStyleHidden_part_idioma = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_idioma = 'display: none;';
   $sStyleReadInp_part_idioma = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_idioma']) && $this->nmgp_cmp_readonly['part_idioma'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_idioma']);
       $sStyleReadLab_part_idioma = '';
       $sStyleReadInp_part_idioma = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_idioma']) && $this->nmgp_cmp_hidden['part_idioma'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="part_idioma" value="<?php echo $this->form_encode_input($this->part_idioma) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_idioma_label" id="hidden_field_label_part_idioma" style="<?php echo $sStyleHidden_part_idioma; ?>"><span id="id_label_part_idioma"><?php echo $this->nm_new_label['part_idioma']; ?></span></TD>
    <TD class="scFormDataOdd css_part_idioma_line" id="hidden_field_data_part_idioma" style="<?php echo $sStyleHidden_part_idioma; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_idioma_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_idioma"]) &&  $this->nmgp_cmp_readonly["part_idioma"] == "on") { 

$part_idioma_look = "";
 if ($this->part_idioma == "PORTUGUES") { $part_idioma_look .= "Português" ;} 
 if ($this->part_idioma == "INGLES") { $part_idioma_look .= "Inglês" ;} 
 if ($this->part_idioma == "MANDARIM") { $part_idioma_look .= "Mandarim" ;} 
 if ($this->part_idioma == "HINDI") { $part_idioma_look .= "Hindi" ;} 
 if ($this->part_idioma == "ESPANHOL") { $part_idioma_look .= "Espanhol" ;} 
 if ($this->part_idioma == "FRANCES") { $part_idioma_look .= "Francês" ;} 
 if ($this->part_idioma == "ARABE") { $part_idioma_look .= "Árabe" ;} 
 if ($this->part_idioma == "BENGALI") { $part_idioma_look .= "Bengali" ;} 
 if ($this->part_idioma == "ALEMÃO") { $part_idioma_look .= "Alemão" ;} 
 if ($this->part_idioma == "RUSSO") { $part_idioma_look .= "Russo" ;} 
 if ($this->part_idioma == "TURCO") { $part_idioma_look .= "Turco" ;} 
 if ($this->part_idioma == "ITALIANO") { $part_idioma_look .= "Italiano" ;} 
 if ($this->part_idioma == "UCRANIANO") { $part_idioma_look .= "Ucraniano" ;} 
 if ($this->part_idioma == "POLONES") { $part_idioma_look .= "Polonês" ;} 
 if ($this->part_idioma == "HOLANDES") { $part_idioma_look .= "Holandês" ;} 
 if ($this->part_idioma == "JAPONES") { $part_idioma_look .= "Japonês" ;} 
 if (empty($part_idioma_look)) { $part_idioma_look = $this->part_idioma; }
?>
<input type="hidden" name="part_idioma" value="<?php echo $this->form_encode_input($part_idioma) . "\">" . $part_idioma_look . ""; ?>
<?php } else { ?>
<?php

$part_idioma_look = "";
 if ($this->part_idioma == "PORTUGUES") { $part_idioma_look .= "Português" ;} 
 if ($this->part_idioma == "INGLES") { $part_idioma_look .= "Inglês" ;} 
 if ($this->part_idioma == "MANDARIM") { $part_idioma_look .= "Mandarim" ;} 
 if ($this->part_idioma == "HINDI") { $part_idioma_look .= "Hindi" ;} 
 if ($this->part_idioma == "ESPANHOL") { $part_idioma_look .= "Espanhol" ;} 
 if ($this->part_idioma == "FRANCES") { $part_idioma_look .= "Francês" ;} 
 if ($this->part_idioma == "ARABE") { $part_idioma_look .= "Árabe" ;} 
 if ($this->part_idioma == "BENGALI") { $part_idioma_look .= "Bengali" ;} 
 if ($this->part_idioma == "ALEMÃO") { $part_idioma_look .= "Alemão" ;} 
 if ($this->part_idioma == "RUSSO") { $part_idioma_look .= "Russo" ;} 
 if ($this->part_idioma == "TURCO") { $part_idioma_look .= "Turco" ;} 
 if ($this->part_idioma == "ITALIANO") { $part_idioma_look .= "Italiano" ;} 
 if ($this->part_idioma == "UCRANIANO") { $part_idioma_look .= "Ucraniano" ;} 
 if ($this->part_idioma == "POLONES") { $part_idioma_look .= "Polonês" ;} 
 if ($this->part_idioma == "HOLANDES") { $part_idioma_look .= "Holandês" ;} 
 if ($this->part_idioma == "JAPONES") { $part_idioma_look .= "Japonês" ;} 
 if (empty($part_idioma_look)) { $part_idioma_look = $this->part_idioma; }
?>
<span id="id_read_on_part_idioma" class="css_part_idioma_line"  style="<?php echo $sStyleReadLab_part_idioma; ?>"><?php echo $this->form_format_readonly("part_idioma", $this->form_encode_input($part_idioma_look)); ?></span><span id="id_read_off_part_idioma" class="css_read_off_part_idioma<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_part_idioma; ?>">
 <span id="idAjaxSelect_part_idioma" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_part_idioma_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_idioma" name="part_idioma" size="1" alt="{type: 'select', enterTab: true}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = ''; ?>
 <option value="">.:selecione.:.</option>
 <option  value="PORTUGUES" <?php  if ($this->part_idioma == "PORTUGUES") { echo " selected" ;} ?><?php  if (empty($this->part_idioma)) { echo " selected" ;} ?>>Português</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'PORTUGUES'; ?>
 <option  value="INGLES" <?php  if ($this->part_idioma == "INGLES") { echo " selected" ;} ?>>Inglês</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'INGLES'; ?>
 <option  value="MANDARIM" <?php  if ($this->part_idioma == "MANDARIM") { echo " selected" ;} ?>>Mandarim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'MANDARIM'; ?>
 <option  value="HINDI" <?php  if ($this->part_idioma == "HINDI") { echo " selected" ;} ?>>Hindi</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'HINDI'; ?>
 <option  value="ESPANHOL" <?php  if ($this->part_idioma == "ESPANHOL") { echo " selected" ;} ?>>Espanhol</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'ESPANHOL'; ?>
 <option  value="FRANCES" <?php  if ($this->part_idioma == "FRANCES") { echo " selected" ;} ?>>Francês</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'FRANCES'; ?>
 <option  value="ARABE" <?php  if ($this->part_idioma == "ARABE") { echo " selected" ;} ?>>Árabe</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'ARABE'; ?>
 <option  value="BENGALI" <?php  if ($this->part_idioma == "BENGALI") { echo " selected" ;} ?>>Bengali</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'BENGALI'; ?>
 <option  value="ALEMÃO" <?php  if ($this->part_idioma == "ALEMÃO") { echo " selected" ;} ?>>Alemão</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'ALEMÃO'; ?>
 <option  value="RUSSO" <?php  if ($this->part_idioma == "RUSSO") { echo " selected" ;} ?>>Russo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'RUSSO'; ?>
 <option  value="TURCO" <?php  if ($this->part_idioma == "TURCO") { echo " selected" ;} ?>>Turco</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'TURCO'; ?>
 <option  value="ITALIANO" <?php  if ($this->part_idioma == "ITALIANO") { echo " selected" ;} ?>>Italiano</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'ITALIANO'; ?>
 <option  value="UCRANIANO" <?php  if ($this->part_idioma == "UCRANIANO") { echo " selected" ;} ?>>Ucraniano</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'UCRANIANO'; ?>
 <option  value="POLONES" <?php  if ($this->part_idioma == "POLONES") { echo " selected" ;} ?>>Polonês</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'POLONES'; ?>
 <option  value="HOLANDES" <?php  if ($this->part_idioma == "HOLANDES") { echo " selected" ;} ?>>Holandês</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'HOLANDES'; ?>
 <option  value="JAPONES" <?php  if ($this->part_idioma == "JAPONES") { echo " selected" ;} ?>>Japonês</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_idioma'][] = 'JAPONES'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_idioma_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_idioma_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['idioma_preferido']))
    {
        $this->nm_new_label['idioma_preferido'] = "Idioma Preferido(APP):";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $idioma_preferido = $this->idioma_preferido;
   $sStyleHidden_idioma_preferido = '';
   if (isset($this->nmgp_cmp_hidden['idioma_preferido']) && $this->nmgp_cmp_hidden['idioma_preferido'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['idioma_preferido']);
       $sStyleHidden_idioma_preferido = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_idioma_preferido = 'display: none;';
   $sStyleReadInp_idioma_preferido = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['idioma_preferido']) && $this->nmgp_cmp_readonly['idioma_preferido'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['idioma_preferido']);
       $sStyleReadLab_idioma_preferido = '';
       $sStyleReadInp_idioma_preferido = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['idioma_preferido']) && $this->nmgp_cmp_hidden['idioma_preferido'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="idioma_preferido" value="<?php echo $this->form_encode_input($idioma_preferido) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_idioma_preferido_label" id="hidden_field_label_idioma_preferido" style="<?php echo $sStyleHidden_idioma_preferido; ?>"><span id="id_label_idioma_preferido"><?php echo $this->nm_new_label['idioma_preferido']; ?></span></TD>
    <TD class="scFormDataOdd css_idioma_preferido_line" id="hidden_field_data_idioma_preferido" style="<?php echo $sStyleHidden_idioma_preferido; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_idioma_preferido_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["idioma_preferido"]) &&  $this->nmgp_cmp_readonly["idioma_preferido"] == "on") { 

 ?>
<input type="hidden" name="idioma_preferido" value="<?php echo $this->form_encode_input($idioma_preferido) . "\">" . $idioma_preferido . ""; ?>
<?php } else { ?>
<span id="id_read_on_idioma_preferido" class="sc-ui-readonly-idioma_preferido css_idioma_preferido_line" style="<?php echo $sStyleReadLab_idioma_preferido; ?>"><?php echo $this->form_format_readonly("idioma_preferido", $this->form_encode_input($this->idioma_preferido)); ?></span><span id="id_read_off_idioma_preferido" class="css_read_off_idioma_preferido<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_idioma_preferido; ?>">
 <input class="sc-js-input scFormObjectOdd css_idioma_preferido_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_idioma_preferido" type=text name="idioma_preferido" value="<?php echo $this->form_encode_input($idioma_preferido) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=5"; } ?> maxlength=5 alt="{datatype: 'text', maxLength: 5, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_idioma_preferido_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_idioma_preferido_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['part_pais']))
   {
       $this->nm_new_label['part_pais'] = "Pais:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_pais = $this->part_pais;
   $sStyleHidden_part_pais = '';
   if (isset($this->nmgp_cmp_hidden['part_pais']) && $this->nmgp_cmp_hidden['part_pais'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_pais']);
       $sStyleHidden_part_pais = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_pais = 'display: none;';
   $sStyleReadInp_part_pais = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_pais']) && $this->nmgp_cmp_readonly['part_pais'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_pais']);
       $sStyleReadLab_part_pais = '';
       $sStyleReadInp_part_pais = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_pais']) && $this->nmgp_cmp_hidden['part_pais'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="part_pais" value="<?php echo $this->form_encode_input($this->part_pais) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_pais_label" id="hidden_field_label_part_pais" style="<?php echo $sStyleHidden_part_pais; ?>"><span id="id_label_part_pais"><?php echo $this->nm_new_label['part_pais']; ?></span></TD>
    <TD class="scFormDataOdd css_part_pais_line" id="hidden_field_data_part_pais" style="<?php echo $sStyleHidden_part_pais; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_pais_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_pais"]) &&  $this->nmgp_cmp_readonly["part_pais"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais'] = array(); 
    }

   $old_value_participante_id = $this->participante_id;
   $old_value_part_dt_nasc = $this->part_dt_nasc;
   $old_value_part_cep = $this->part_cep;
   $old_value_part_fone_01 = $this->part_fone_01;
   $old_value_part_celeular_01 = $this->part_celeular_01;
   $old_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $old_value_emissao_passaporte = $this->emissao_passaporte;
   $old_value_part_validade_pass = $this->part_validade_pass;
   $old_value_part_cpf_informado = $this->part_cpf_informado;
   $old_value_part_vacina_fa = $this->part_vacina_fa;
   $old_value_validade_visto = $this->validade_visto;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_participante_id = $this->participante_id;
   $unformatted_value_part_dt_nasc = $this->part_dt_nasc;
   $unformatted_value_part_cep = $this->part_cep;
   $unformatted_value_part_fone_01 = $this->part_fone_01;
   $unformatted_value_part_celeular_01 = $this->part_celeular_01;
   $unformatted_value_codigo_telefone_internacional = $this->codigo_telefone_internacional;
   $unformatted_value_emissao_passaporte = $this->emissao_passaporte;
   $unformatted_value_part_validade_pass = $this->part_validade_pass;
   $unformatted_value_part_cpf_informado = $this->part_cpf_informado;
   $unformatted_value_part_vacina_fa = $this->part_vacina_fa;
   $unformatted_value_validade_visto = $this->validade_visto;

   $nm_comando = "SELECT pais_id, descricao  FROM tbl_paises  ORDER BY descricao";

   $this->participante_id = $old_value_participante_id;
   $this->part_dt_nasc = $old_value_part_dt_nasc;
   $this->part_cep = $old_value_part_cep;
   $this->part_fone_01 = $old_value_part_fone_01;
   $this->part_celeular_01 = $old_value_part_celeular_01;
   $this->codigo_telefone_internacional = $old_value_codigo_telefone_internacional;
   $this->emissao_passaporte = $old_value_emissao_passaporte;
   $this->part_validade_pass = $old_value_part_validade_pass;
   $this->part_cpf_informado = $old_value_part_cpf_informado;
   $this->part_vacina_fa = $old_value_part_vacina_fa;
   $this->validade_visto = $old_value_validade_visto;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $part_pais_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->part_pais_1))
          {
              foreach ($this->part_pais_1 as $tmp_part_pais)
              {
                  if (trim($tmp_part_pais) === trim($cadaselect[1])) {$part_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->part_pais) && trim($this->part_pais) === trim($cadaselect[1])) {$part_pais_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="part_pais" value="<?php echo $this->form_encode_input($part_pais) . "\">" . $part_pais_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_part_pais();
   $x = 0 ; 
   $part_pais_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->part_pais_1))
          {
              foreach ($this->part_pais_1 as $tmp_part_pais)
              {
                  if (trim($tmp_part_pais) === trim($cadaselect[1])) {$part_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->part_pais)) {
                 if (trim($this->part_pais) == trim($cadaselect[1])) { $part_pais_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->part_pais == $cadaselect[1]) { $part_pais_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($part_pais_look))
          {
              $part_pais_look = $this->part_pais;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_part_pais\" class=\"css_part_pais_line\" style=\"" .  $sStyleReadLab_part_pais . "\">" . $this->form_format_readonly("part_pais", $this->form_encode_input($part_pais_look)) . "</span><span id=\"id_read_off_part_pais\" class=\"css_read_off_part_pais" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_part_pais . "\">";
   echo " <span id=\"idAjaxSelect_part_pais\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_part_pais_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_part_pais\" name=\"part_pais\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_pais'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->part_pais) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->part_pais)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_pais_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_pais_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['pais']))
    {
        $this->nm_new_label['pais'] = "Pais (APP):";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $pais = $this->pais;
   $sStyleHidden_pais = '';
   if (isset($this->nmgp_cmp_hidden['pais']) && $this->nmgp_cmp_hidden['pais'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['pais']);
       $sStyleHidden_pais = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_pais = 'display: none;';
   $sStyleReadInp_pais = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['pais']) && $this->nmgp_cmp_readonly['pais'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['pais']);
       $sStyleReadLab_pais = '';
       $sStyleReadInp_pais = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['pais']) && $this->nmgp_cmp_hidden['pais'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="pais" value="<?php echo $this->form_encode_input($pais) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_pais_label" id="hidden_field_label_pais" style="<?php echo $sStyleHidden_pais; ?>"><span id="id_label_pais"><?php echo $this->nm_new_label['pais']; ?></span></TD>
    <TD class="scFormDataOdd css_pais_line" id="hidden_field_data_pais" style="<?php echo $sStyleHidden_pais; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_pais_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["pais"]) &&  $this->nmgp_cmp_readonly["pais"] == "on") { 

 ?>
<input type="hidden" name="pais" value="<?php echo $this->form_encode_input($pais) . "\">" . $pais . ""; ?>
<?php } else { ?>
<span id="id_read_on_pais" class="sc-ui-readonly-pais css_pais_line" style="<?php echo $sStyleReadLab_pais; ?>"><?php echo $this->form_format_readonly("pais", $this->form_encode_input($this->pais)); ?></span><span id="id_read_off_pais" class="css_read_off_pais<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_pais; ?>">
 <input class="sc-js-input scFormObjectOdd css_pais_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_pais" type=text name="pais" value="<?php echo $this->form_encode_input($pais) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_pais_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_pais_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_destaque_negrito']))
    {
        $this->nm_new_label['part_destaque_negrito'] = "Destaque Negrito:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_destaque_negrito = $this->part_destaque_negrito;
   $sStyleHidden_part_destaque_negrito = '';
   if (isset($this->nmgp_cmp_hidden['part_destaque_negrito']) && $this->nmgp_cmp_hidden['part_destaque_negrito'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_destaque_negrito']);
       $sStyleHidden_part_destaque_negrito = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_destaque_negrito = 'display: none;';
   $sStyleReadInp_part_destaque_negrito = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_destaque_negrito']) && $this->nmgp_cmp_readonly['part_destaque_negrito'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_destaque_negrito']);
       $sStyleReadLab_part_destaque_negrito = '';
       $sStyleReadInp_part_destaque_negrito = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_destaque_negrito']) && $this->nmgp_cmp_hidden['part_destaque_negrito'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_destaque_negrito" value="<?php echo $this->form_encode_input($part_destaque_negrito) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_destaque_negrito_label" id="hidden_field_label_part_destaque_negrito" style="<?php echo $sStyleHidden_part_destaque_negrito; ?>"><span id="id_label_part_destaque_negrito"><?php echo $this->nm_new_label['part_destaque_negrito']; ?></span></TD>
    <TD class="scFormDataOdd css_part_destaque_negrito_line" id="hidden_field_data_part_destaque_negrito" style="<?php echo $sStyleHidden_part_destaque_negrito; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_destaque_negrito_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_destaque_negrito"]) &&  $this->nmgp_cmp_readonly["part_destaque_negrito"] == "on") { 

 if ("N" == $this->part_destaque_negrito) { $part_destaque_negrito_look = "Não";} 
 if ("Y" == $this->part_destaque_negrito) { $part_destaque_negrito_look = "Sim";} 
?>
<input type="hidden" name="part_destaque_negrito" value="<?php echo $this->form_encode_input($part_destaque_negrito) . "\">" . $part_destaque_negrito_look . ""; ?>
<?php } else { ?>

<?php

 if ("N" == $this->part_destaque_negrito) { $part_destaque_negrito_look = "Não";} 
 if ("Y" == $this->part_destaque_negrito) { $part_destaque_negrito_look = "Sim";} 
?>
<span id="id_read_on_part_destaque_negrito"  class="css_part_destaque_negrito_line" style="<?php echo $sStyleReadLab_part_destaque_negrito; ?>"><?php echo $this->form_format_readonly("part_destaque_negrito", $this->form_encode_input($part_destaque_negrito_look)); ?></span><span id="id_read_off_part_destaque_negrito" class="css_read_off_part_destaque_negrito css_part_destaque_negrito_line" style="<?php echo $sStyleReadInp_part_destaque_negrito; ?>"><div id="idAjaxRadio_part_destaque_negrito" style="display: inline-block"  class="css_part_destaque_negrito_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_part_destaque_negrito_line"><?php $tempOptionId = "id-opt-part_destaque_negrito" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_destaque_negrito sc-ui-radio-part_destaque_negrito sc-js-input" type=radio name="part_destaque_negrito" value="N"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_destaque_negrito'][] = 'N'; ?>
<?php  if ("N" == $this->part_destaque_negrito)  { echo " checked" ;} ?><?php  if (empty($this->part_destaque_negrito)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_part_destaque_negrito_line"><?php $tempOptionId = "id-opt-part_destaque_negrito" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_destaque_negrito sc-ui-radio-part_destaque_negrito sc-js-input" type=radio name="part_destaque_negrito" value="Y"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_destaque_negrito'][] = 'Y'; ?>
<?php  if ("Y" == $this->part_destaque_negrito)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_destaque_negrito_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_destaque_negrito_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_fumante']))
    {
        $this->nm_new_label['part_fumante'] = "Fumante:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_fumante = $this->part_fumante;
   $sStyleHidden_part_fumante = '';
   if (isset($this->nmgp_cmp_hidden['part_fumante']) && $this->nmgp_cmp_hidden['part_fumante'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_fumante']);
       $sStyleHidden_part_fumante = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_fumante = 'display: none;';
   $sStyleReadInp_part_fumante = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_fumante']) && $this->nmgp_cmp_readonly['part_fumante'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_fumante']);
       $sStyleReadLab_part_fumante = '';
       $sStyleReadInp_part_fumante = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_fumante']) && $this->nmgp_cmp_hidden['part_fumante'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_fumante" value="<?php echo $this->form_encode_input($part_fumante) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_fumante_label" id="hidden_field_label_part_fumante" style="<?php echo $sStyleHidden_part_fumante; ?>"><span id="id_label_part_fumante"><?php echo $this->nm_new_label['part_fumante']; ?></span></TD>
    <TD class="scFormDataOdd css_part_fumante_line" id="hidden_field_data_part_fumante" style="<?php echo $sStyleHidden_part_fumante; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_fumante_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_fumante"]) &&  $this->nmgp_cmp_readonly["part_fumante"] == "on") { 

 if ("N" == $this->part_fumante) { $part_fumante_look = "Não";} 
 if ("Y" == $this->part_fumante) { $part_fumante_look = "Sim";} 
?>
<input type="hidden" name="part_fumante" value="<?php echo $this->form_encode_input($part_fumante) . "\">" . $part_fumante_look . ""; ?>
<?php } else { ?>

<?php

 if ("N" == $this->part_fumante) { $part_fumante_look = "Não";} 
 if ("Y" == $this->part_fumante) { $part_fumante_look = "Sim";} 
?>
<span id="id_read_on_part_fumante"  class="css_part_fumante_line" style="<?php echo $sStyleReadLab_part_fumante; ?>"><?php echo $this->form_format_readonly("part_fumante", $this->form_encode_input($part_fumante_look)); ?></span><span id="id_read_off_part_fumante" class="css_read_off_part_fumante css_part_fumante_line" style="<?php echo $sStyleReadInp_part_fumante; ?>"><div id="idAjaxRadio_part_fumante" style="display: inline-block"  class="css_part_fumante_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_part_fumante_line"><?php $tempOptionId = "id-opt-part_fumante" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_fumante sc-ui-radio-part_fumante sc-js-input" type=radio name="part_fumante" value="N"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_fumante'][] = 'N'; ?>
<?php  if ("N" == $this->part_fumante)  { echo " checked" ;} ?><?php  if (empty($this->part_fumante)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_part_fumante_line"><?php $tempOptionId = "id-opt-part_fumante" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-part_fumante sc-ui-radio-part_fumante sc-js-input" type=radio name="part_fumante" value="Y"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_part_fumante'][] = 'Y'; ?>
<?php  if ("Y" == $this->part_fumante)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_fumante_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_fumante_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_restricao_alimentar']))
    {
        $this->nm_new_label['part_restricao_alimentar'] = "Restrição Alimentar:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_restricao_alimentar = $this->part_restricao_alimentar;
   $sStyleHidden_part_restricao_alimentar = '';
   if (isset($this->nmgp_cmp_hidden['part_restricao_alimentar']) && $this->nmgp_cmp_hidden['part_restricao_alimentar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_restricao_alimentar']);
       $sStyleHidden_part_restricao_alimentar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_restricao_alimentar = 'display: none;';
   $sStyleReadInp_part_restricao_alimentar = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_restricao_alimentar']) && $this->nmgp_cmp_readonly['part_restricao_alimentar'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_restricao_alimentar']);
       $sStyleReadLab_part_restricao_alimentar = '';
       $sStyleReadInp_part_restricao_alimentar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_restricao_alimentar']) && $this->nmgp_cmp_hidden['part_restricao_alimentar'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_restricao_alimentar" value="<?php echo $this->form_encode_input($part_restricao_alimentar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_restricao_alimentar_label" id="hidden_field_label_part_restricao_alimentar" style="<?php echo $sStyleHidden_part_restricao_alimentar; ?>"><span id="id_label_part_restricao_alimentar"><?php echo $this->nm_new_label['part_restricao_alimentar']; ?></span></TD>
    <TD class="scFormDataOdd css_part_restricao_alimentar_line" id="hidden_field_data_part_restricao_alimentar" style="<?php echo $sStyleHidden_part_restricao_alimentar; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_restricao_alimentar_line" style="vertical-align: top;padding: 0px">
<?php
$part_restricao_alimentar_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($part_restricao_alimentar));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_restricao_alimentar"]) &&  $this->nmgp_cmp_readonly["part_restricao_alimentar"] == "on") { 

 ?>
<input type="hidden" name="part_restricao_alimentar" value="<?php echo $this->form_encode_input($part_restricao_alimentar) . "\">" . $part_restricao_alimentar_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_restricao_alimentar" class="sc-ui-readonly-part_restricao_alimentar css_part_restricao_alimentar_line" style="<?php echo $sStyleReadLab_part_restricao_alimentar; ?>"><?php echo $this->form_format_readonly("part_restricao_alimentar", $this->form_encode_input($part_restricao_alimentar_val)); ?></span><span id="id_read_off_part_restricao_alimentar" class="css_read_off_part_restricao_alimentar<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_restricao_alimentar; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_part_restricao_alimentar_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="part_restricao_alimentar" id="id_sc_field_part_restricao_alimentar" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $part_restricao_alimentar; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_restricao_alimentar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_restricao_alimentar_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['restricao_mobilidade']))
    {
        $this->nm_new_label['restricao_mobilidade'] = "Restrição Mobilidade:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $restricao_mobilidade = $this->restricao_mobilidade;
   $sStyleHidden_restricao_mobilidade = '';
   if (isset($this->nmgp_cmp_hidden['restricao_mobilidade']) && $this->nmgp_cmp_hidden['restricao_mobilidade'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['restricao_mobilidade']);
       $sStyleHidden_restricao_mobilidade = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_restricao_mobilidade = 'display: none;';
   $sStyleReadInp_restricao_mobilidade = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['restricao_mobilidade']) && $this->nmgp_cmp_readonly['restricao_mobilidade'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['restricao_mobilidade']);
       $sStyleReadLab_restricao_mobilidade = '';
       $sStyleReadInp_restricao_mobilidade = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['restricao_mobilidade']) && $this->nmgp_cmp_hidden['restricao_mobilidade'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="restricao_mobilidade" value="<?php echo $this->form_encode_input($restricao_mobilidade) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_restricao_mobilidade_label" id="hidden_field_label_restricao_mobilidade" style="<?php echo $sStyleHidden_restricao_mobilidade; ?>"><span id="id_label_restricao_mobilidade"><?php echo $this->nm_new_label['restricao_mobilidade']; ?></span></TD>
    <TD class="scFormDataOdd css_restricao_mobilidade_line" id="hidden_field_data_restricao_mobilidade" style="<?php echo $sStyleHidden_restricao_mobilidade; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_restricao_mobilidade_line" style="vertical-align: top;padding: 0px">
<?php
$restricao_mobilidade_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($restricao_mobilidade));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["restricao_mobilidade"]) &&  $this->nmgp_cmp_readonly["restricao_mobilidade"] == "on") { 

 ?>
<input type="hidden" name="restricao_mobilidade" value="<?php echo $this->form_encode_input($restricao_mobilidade) . "\">" . $restricao_mobilidade_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_restricao_mobilidade" class="sc-ui-readonly-restricao_mobilidade css_restricao_mobilidade_line" style="<?php echo $sStyleReadLab_restricao_mobilidade; ?>"><?php echo $this->form_format_readonly("restricao_mobilidade", $this->form_encode_input($restricao_mobilidade_val)); ?></span><span id="id_read_off_restricao_mobilidade" class="css_read_off_restricao_mobilidade<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_restricao_mobilidade; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_restricao_mobilidade_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="restricao_mobilidade" id="id_sc_field_restricao_mobilidade" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $restricao_mobilidade; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_restricao_mobilidade_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_restricao_mobilidade_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_cv_obs']))
    {
        $this->nm_new_label['part_cv_obs'] = "Observações Voucher:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_cv_obs = $this->part_cv_obs;
   $sStyleHidden_part_cv_obs = '';
   if (isset($this->nmgp_cmp_hidden['part_cv_obs']) && $this->nmgp_cmp_hidden['part_cv_obs'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_cv_obs']);
       $sStyleHidden_part_cv_obs = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_cv_obs = 'display: none;';
   $sStyleReadInp_part_cv_obs = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_cv_obs']) && $this->nmgp_cmp_readonly['part_cv_obs'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_cv_obs']);
       $sStyleReadLab_part_cv_obs = '';
       $sStyleReadInp_part_cv_obs = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_cv_obs']) && $this->nmgp_cmp_hidden['part_cv_obs'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_cv_obs" value="<?php echo $this->form_encode_input($part_cv_obs) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_cv_obs_label" id="hidden_field_label_part_cv_obs" style="<?php echo $sStyleHidden_part_cv_obs; ?>"><span id="id_label_part_cv_obs"><?php echo $this->nm_new_label['part_cv_obs']; ?></span></TD>
    <TD class="scFormDataOdd css_part_cv_obs_line" id="hidden_field_data_part_cv_obs" style="<?php echo $sStyleHidden_part_cv_obs; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_cv_obs_line" style="vertical-align: top;padding: 0px">
<?php
$part_cv_obs_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($part_cv_obs));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_cv_obs"]) &&  $this->nmgp_cmp_readonly["part_cv_obs"] == "on") { 

 ?>
<input type="hidden" name="part_cv_obs" value="<?php echo $this->form_encode_input($part_cv_obs) . "\">" . $part_cv_obs_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_cv_obs" class="sc-ui-readonly-part_cv_obs css_part_cv_obs_line" style="<?php echo $sStyleReadLab_part_cv_obs; ?>"><?php echo $this->form_format_readonly("part_cv_obs", $this->form_encode_input($part_cv_obs_val)); ?></span><span id="id_read_off_part_cv_obs" class="css_read_off_part_cv_obs<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_cv_obs; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_part_cv_obs_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="part_cv_obs" id="id_sc_field_part_cv_obs" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $part_cv_obs; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_cv_obs_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_cv_obs_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['uid_pulseira_nfc']))
    {
        $this->nm_new_label['uid_pulseira_nfc'] = "Cód. Pulseira NFC:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $uid_pulseira_nfc = $this->uid_pulseira_nfc;
   $sStyleHidden_uid_pulseira_nfc = '';
   if (isset($this->nmgp_cmp_hidden['uid_pulseira_nfc']) && $this->nmgp_cmp_hidden['uid_pulseira_nfc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['uid_pulseira_nfc']);
       $sStyleHidden_uid_pulseira_nfc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_uid_pulseira_nfc = 'display: none;';
   $sStyleReadInp_uid_pulseira_nfc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['uid_pulseira_nfc']) && $this->nmgp_cmp_readonly['uid_pulseira_nfc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['uid_pulseira_nfc']);
       $sStyleReadLab_uid_pulseira_nfc = '';
       $sStyleReadInp_uid_pulseira_nfc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['uid_pulseira_nfc']) && $this->nmgp_cmp_hidden['uid_pulseira_nfc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="uid_pulseira_nfc" value="<?php echo $this->form_encode_input($uid_pulseira_nfc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_uid_pulseira_nfc_label" id="hidden_field_label_uid_pulseira_nfc" style="<?php echo $sStyleHidden_uid_pulseira_nfc; ?>"><span id="id_label_uid_pulseira_nfc"><?php echo $this->nm_new_label['uid_pulseira_nfc']; ?></span></TD>
    <TD class="scFormDataOdd css_uid_pulseira_nfc_line" id="hidden_field_data_uid_pulseira_nfc" style="<?php echo $sStyleHidden_uid_pulseira_nfc; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_uid_pulseira_nfc_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["uid_pulseira_nfc"]) &&  $this->nmgp_cmp_readonly["uid_pulseira_nfc"] == "on") { 

 ?>
<input type="hidden" name="uid_pulseira_nfc" value="<?php echo $this->form_encode_input($uid_pulseira_nfc) . "\">" . $uid_pulseira_nfc . ""; ?>
<?php } else { ?>
<span id="id_read_on_uid_pulseira_nfc" class="sc-ui-readonly-uid_pulseira_nfc css_uid_pulseira_nfc_line" style="<?php echo $sStyleReadLab_uid_pulseira_nfc; ?>"><?php echo $this->form_format_readonly("uid_pulseira_nfc", $this->form_encode_input($this->uid_pulseira_nfc)); ?></span><span id="id_read_off_uid_pulseira_nfc" class="css_read_off_uid_pulseira_nfc<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_uid_pulseira_nfc; ?>">
 <input class="sc-js-input scFormObjectOdd css_uid_pulseira_nfc_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_uid_pulseira_nfc" type=text name="uid_pulseira_nfc" value="<?php echo $this->form_encode_input($uid_pulseira_nfc) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_uid_pulseira_nfc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_uid_pulseira_nfc_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['roles_app']))
   {
       $this->nm_new_label['roles_app'] = "Status no APP:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $roles_app = $this->roles_app;
   $sStyleHidden_roles_app = '';
   if (isset($this->nmgp_cmp_hidden['roles_app']) && $this->nmgp_cmp_hidden['roles_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['roles_app']);
       $sStyleHidden_roles_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_roles_app = 'display: none;';
   $sStyleReadInp_roles_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['roles_app']) && $this->nmgp_cmp_readonly['roles_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['roles_app']);
       $sStyleReadLab_roles_app = '';
       $sStyleReadInp_roles_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['roles_app']) && $this->nmgp_cmp_hidden['roles_app'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="roles_app" value="<?php echo $this->form_encode_input($this->roles_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_roles_app_label" id="hidden_field_label_roles_app" style="<?php echo $sStyleHidden_roles_app; ?>"><span id="id_label_roles_app"><?php echo $this->nm_new_label['roles_app']; ?></span></TD>
    <TD class="scFormDataOdd css_roles_app_line" id="hidden_field_data_roles_app" style="<?php echo $sStyleHidden_roles_app; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_roles_app_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["roles_app"]) &&  $this->nmgp_cmp_readonly["roles_app"] == "on") { 

$roles_app_look = "";
 if ($this->roles_app == "guest") { $roles_app_look .= "Guest (convidado)" ;} 
 if ($this->roles_app == "speaker") { $roles_app_look .= "Speaker (palestrante)" ;} 
 if ($this->roles_app == "buyer") { $roles_app_look .= "Buyer (comprador)" ;} 
 if ($this->roles_app == "organizer") { $roles_app_look .= "Organizer (organizador)" ;} 
 if ($this->roles_app == "admin") { $roles_app_look .= "Admin (administrador)" ;} 
 if (empty($roles_app_look)) { $roles_app_look = $this->roles_app; }
?>
<input type="hidden" name="roles_app" value="<?php echo $this->form_encode_input($roles_app) . "\">" . $roles_app_look . ""; ?>
<?php } else { ?>
<?php

$roles_app_look = "";
 if ($this->roles_app == "guest") { $roles_app_look .= "Guest (convidado)" ;} 
 if ($this->roles_app == "speaker") { $roles_app_look .= "Speaker (palestrante)" ;} 
 if ($this->roles_app == "buyer") { $roles_app_look .= "Buyer (comprador)" ;} 
 if ($this->roles_app == "organizer") { $roles_app_look .= "Organizer (organizador)" ;} 
 if ($this->roles_app == "admin") { $roles_app_look .= "Admin (administrador)" ;} 
 if (empty($roles_app_look)) { $roles_app_look = $this->roles_app; }
?>
<span id="id_read_on_roles_app" class="css_roles_app_line"  style="<?php echo $sStyleReadLab_roles_app; ?>"><?php echo $this->form_format_readonly("roles_app", $this->form_encode_input($roles_app_look)); ?></span><span id="id_read_off_roles_app" class="css_read_off_roles_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_roles_app; ?>">
 <span id="idAjaxSelect_roles_app" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_roles_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_roles_app" name="roles_app" size="1" alt="{type: 'select', enterTab: true}">
 <option  value="guest" <?php  if ($this->roles_app == "guest") { echo " selected" ;} ?><?php  if (empty($this->roles_app)) { echo " selected" ;} ?>>Guest (convidado)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_roles_app'][] = 'guest'; ?>
 <option  value="speaker" <?php  if ($this->roles_app == "speaker") { echo " selected" ;} ?>>Speaker (palestrante)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_roles_app'][] = 'speaker'; ?>
 <option  value="buyer" <?php  if ($this->roles_app == "buyer") { echo " selected" ;} ?>>Buyer (comprador)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_roles_app'][] = 'buyer'; ?>
 <option  value="organizer" <?php  if ($this->roles_app == "organizer") { echo " selected" ;} ?>>Organizer (organizador)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_roles_app'][] = 'organizer'; ?>
 <option  value="admin" <?php  if ($this->roles_app == "admin") { echo " selected" ;} ?>>Admin (administrador)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['Lookup_roles_app'][] = 'admin'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_roles_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_roles_app_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_evento_app']))
    {
        $this->nm_new_label['id_evento_app'] = "Id Evento APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_evento_app = $this->id_evento_app;
   $sStyleHidden_id_evento_app = '';
   if (isset($this->nmgp_cmp_hidden['id_evento_app']) && $this->nmgp_cmp_hidden['id_evento_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_evento_app']);
       $sStyleHidden_id_evento_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_evento_app = 'display: none;';
   $sStyleReadInp_id_evento_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_evento_app']) && $this->nmgp_cmp_readonly['id_evento_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_evento_app']);
       $sStyleReadLab_id_evento_app = '';
       $sStyleReadInp_id_evento_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_evento_app']) && $this->nmgp_cmp_hidden['id_evento_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_evento_app" value="<?php echo $this->form_encode_input($id_evento_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_evento_app_label" id="hidden_field_label_id_evento_app" style="<?php echo $sStyleHidden_id_evento_app; ?>"><span id="id_label_id_evento_app"><?php echo $this->nm_new_label['id_evento_app']; ?></span></TD>
    <TD class="scFormDataOdd css_id_evento_app_line" id="hidden_field_data_id_evento_app" style="<?php echo $sStyleHidden_id_evento_app; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_evento_app_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="id_evento_app" value="<?php echo $this->form_encode_input($id_evento_app); ?>"><span id="id_ajax_label_id_evento_app"><?php echo nl2br($id_evento_app); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_evento_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_evento_app_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['external_id']))
    {
        $this->nm_new_label['external_id'] = "External Id:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $external_id = $this->external_id;
   $sStyleHidden_external_id = '';
   if (isset($this->nmgp_cmp_hidden['external_id']) && $this->nmgp_cmp_hidden['external_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['external_id']);
       $sStyleHidden_external_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_external_id = 'display: none;';
   $sStyleReadInp_external_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['external_id']) && $this->nmgp_cmp_readonly['external_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['external_id']);
       $sStyleReadLab_external_id = '';
       $sStyleReadInp_external_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['external_id']) && $this->nmgp_cmp_hidden['external_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="external_id" value="<?php echo $this->form_encode_input($external_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_external_id_label" id="hidden_field_label_external_id" style="<?php echo $sStyleHidden_external_id; ?>"><span id="id_label_external_id"><?php echo $this->nm_new_label['external_id']; ?></span></TD>
    <TD class="scFormDataOdd css_external_id_line" id="hidden_field_data_external_id" style="<?php echo $sStyleHidden_external_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_external_id_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="external_id" value="<?php echo $this->form_encode_input($external_id); ?>"><span id="id_ajax_label_external_id"><?php echo nl2br($external_id); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_external_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_external_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_participante_app']))
    {
        $this->nm_new_label['id_participante_app'] = "Id Participante App";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_participante_app = $this->id_participante_app;
   $sStyleHidden_id_participante_app = '';
   if (isset($this->nmgp_cmp_hidden['id_participante_app']) && $this->nmgp_cmp_hidden['id_participante_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_participante_app']);
       $sStyleHidden_id_participante_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_participante_app = 'display: none;';
   $sStyleReadInp_id_participante_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_participante_app']) && $this->nmgp_cmp_readonly['id_participante_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_participante_app']);
       $sStyleReadLab_id_participante_app = '';
       $sStyleReadInp_id_participante_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_participante_app']) && $this->nmgp_cmp_hidden['id_participante_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_participante_app" value="<?php echo $this->form_encode_input($id_participante_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_participante_app_label" id="hidden_field_label_id_participante_app" style="<?php echo $sStyleHidden_id_participante_app; ?>"><span id="id_label_id_participante_app"><?php echo $this->nm_new_label['id_participante_app']; ?></span></TD>
    <TD class="scFormDataOdd css_id_participante_app_line" id="hidden_field_data_id_participante_app" style="<?php echo $sStyleHidden_id_participante_app; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_participante_app_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="id_participante_app" value="<?php echo $this->form_encode_input($id_participante_app); ?>"><span id="id_ajax_label_id_participante_app"><?php echo nl2br($id_participante_app); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_participante_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_participante_app_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['external_status']))
    {
        $this->nm_new_label['external_status'] = "External Status:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $external_status = $this->external_status;
   $sStyleHidden_external_status = '';
   if (isset($this->nmgp_cmp_hidden['external_status']) && $this->nmgp_cmp_hidden['external_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['external_status']);
       $sStyleHidden_external_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_external_status = 'display: none;';
   $sStyleReadInp_external_status = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['external_status']) && $this->nmgp_cmp_readonly['external_status'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['external_status']);
       $sStyleReadLab_external_status = '';
       $sStyleReadInp_external_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['external_status']) && $this->nmgp_cmp_hidden['external_status'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="external_status" value="<?php echo $this->form_encode_input($external_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_external_status_label" id="hidden_field_label_external_status" style="<?php echo $sStyleHidden_external_status; ?>"><span id="id_label_external_status"><?php echo $this->nm_new_label['external_status']; ?></span></TD>
    <TD class="scFormDataOdd css_external_status_line" id="hidden_field_data_external_status" style="<?php echo $sStyleHidden_external_status; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_external_status_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="external_status" value="<?php echo $this->form_encode_input($external_status); ?>"><span id="id_ajax_label_external_status"><?php echo nl2br($external_status); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_external_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_external_status_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   <a name="bloco_7"></a>
<div id="div_hidden_bloco_7" style="display: none; width: 1px; height: 0px; overflow: scroll" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_7" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_email']))
    {
        $this->nm_new_label['part_email'] = "Email:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_email = $this->part_email;
   $sStyleHidden_part_email = '';
   if (isset($this->nmgp_cmp_hidden['part_email']) && $this->nmgp_cmp_hidden['part_email'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_email']);
       $sStyleHidden_part_email = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_email = 'display: none;';
   $sStyleReadInp_part_email = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_email']) && $this->nmgp_cmp_readonly['part_email'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_email']);
       $sStyleReadLab_part_email = '';
       $sStyleReadInp_part_email = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_email']) && $this->nmgp_cmp_hidden['part_email'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_email" value="<?php echo $this->form_encode_input($part_email) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_email_label" id="hidden_field_label_part_email" style="<?php echo $sStyleHidden_part_email; ?>"><span id="id_label_part_email"><?php echo $this->nm_new_label['part_email']; ?></span></TD>
    <TD class="scFormDataOdd css_part_email_line" id="hidden_field_data_part_email" style="<?php echo $sStyleHidden_part_email; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_email_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_email"]) &&  $this->nmgp_cmp_readonly["part_email"] == "on") { 

 ?>
<input type="hidden" name="part_email" value="<?php echo $this->form_encode_input($part_email) . "\">" . $part_email . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_email" class="sc-ui-readonly-part_email css_part_email_line" style="<?php echo $sStyleReadLab_part_email; ?>"><?php echo $this->form_format_readonly("part_email", $this->form_encode_input($this->part_email)); ?></span><span id="id_read_off_part_email" class="css_read_off_part_email<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_email; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_email_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_email" type=text name="part_email" value="<?php echo $this->form_encode_input($part_email) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.part_email.value != '') {window.open('mailto:' + document.F1.part_email.value); }", "if (document.F1.part_email.value != '') {window.open('mailto:' + document.F1.part_email.value); }", "part_email_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_email_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_email_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_nome_secretaria']))
    {
        $this->nm_new_label['part_nome_secretaria'] = "Nome Secretaria:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_nome_secretaria = $this->part_nome_secretaria;
   $sStyleHidden_part_nome_secretaria = '';
   if (isset($this->nmgp_cmp_hidden['part_nome_secretaria']) && $this->nmgp_cmp_hidden['part_nome_secretaria'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_nome_secretaria']);
       $sStyleHidden_part_nome_secretaria = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_nome_secretaria = 'display: none;';
   $sStyleReadInp_part_nome_secretaria = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_nome_secretaria']) && $this->nmgp_cmp_readonly['part_nome_secretaria'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_nome_secretaria']);
       $sStyleReadLab_part_nome_secretaria = '';
       $sStyleReadInp_part_nome_secretaria = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_nome_secretaria']) && $this->nmgp_cmp_hidden['part_nome_secretaria'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_nome_secretaria" value="<?php echo $this->form_encode_input($part_nome_secretaria) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_nome_secretaria_label" id="hidden_field_label_part_nome_secretaria" style="<?php echo $sStyleHidden_part_nome_secretaria; ?>"><span id="id_label_part_nome_secretaria"><?php echo $this->nm_new_label['part_nome_secretaria']; ?></span></TD>
    <TD class="scFormDataOdd css_part_nome_secretaria_line" id="hidden_field_data_part_nome_secretaria" style="<?php echo $sStyleHidden_part_nome_secretaria; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_nome_secretaria_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_nome_secretaria"]) &&  $this->nmgp_cmp_readonly["part_nome_secretaria"] == "on") { 

 ?>
<input type="hidden" name="part_nome_secretaria" value="<?php echo $this->form_encode_input($part_nome_secretaria) . "\">" . $part_nome_secretaria . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_nome_secretaria" class="sc-ui-readonly-part_nome_secretaria css_part_nome_secretaria_line" style="<?php echo $sStyleReadLab_part_nome_secretaria; ?>"><?php echo $this->form_format_readonly("part_nome_secretaria", $this->form_encode_input($this->part_nome_secretaria)); ?></span><span id="id_read_off_part_nome_secretaria" class="css_read_off_part_nome_secretaria<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_nome_secretaria; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_nome_secretaria_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_nome_secretaria" type=text name="part_nome_secretaria" value="<?php echo $this->form_encode_input($part_nome_secretaria) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_nome_secretaria_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_nome_secretaria_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_email_secretaria']))
    {
        $this->nm_new_label['part_email_secretaria'] = "Email Secretaria:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_email_secretaria = $this->part_email_secretaria;
   $sStyleHidden_part_email_secretaria = '';
   if (isset($this->nmgp_cmp_hidden['part_email_secretaria']) && $this->nmgp_cmp_hidden['part_email_secretaria'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_email_secretaria']);
       $sStyleHidden_part_email_secretaria = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_email_secretaria = 'display: none;';
   $sStyleReadInp_part_email_secretaria = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_email_secretaria']) && $this->nmgp_cmp_readonly['part_email_secretaria'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_email_secretaria']);
       $sStyleReadLab_part_email_secretaria = '';
       $sStyleReadInp_part_email_secretaria = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_email_secretaria']) && $this->nmgp_cmp_hidden['part_email_secretaria'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_email_secretaria" value="<?php echo $this->form_encode_input($part_email_secretaria) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_email_secretaria_label" id="hidden_field_label_part_email_secretaria" style="<?php echo $sStyleHidden_part_email_secretaria; ?>"><span id="id_label_part_email_secretaria"><?php echo $this->nm_new_label['part_email_secretaria']; ?></span></TD>
    <TD class="scFormDataOdd css_part_email_secretaria_line" id="hidden_field_data_part_email_secretaria" style="<?php echo $sStyleHidden_part_email_secretaria; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_email_secretaria_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["part_email_secretaria"]) &&  $this->nmgp_cmp_readonly["part_email_secretaria"] == "on") { 

 ?>
<input type="hidden" name="part_email_secretaria" value="<?php echo $this->form_encode_input($part_email_secretaria) . "\">" . $part_email_secretaria . ""; ?>
<?php } else { ?>
<span id="id_read_on_part_email_secretaria" class="sc-ui-readonly-part_email_secretaria css_part_email_secretaria_line" style="<?php echo $sStyleReadLab_part_email_secretaria; ?>"><?php echo $this->form_format_readonly("part_email_secretaria", $this->form_encode_input($this->part_email_secretaria)); ?></span><span id="id_read_off_part_email_secretaria" class="css_read_off_part_email_secretaria<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_part_email_secretaria; ?>">
 <input class="sc-js-input scFormObjectOdd css_part_email_secretaria_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_part_email_secretaria" type=text name="part_email_secretaria" value="<?php echo $this->form_encode_input($part_email_secretaria) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.part_email_secretaria.value != '') {window.open('mailto:' + document.F1.part_email_secretaria.value); }", "if (document.F1.part_email_secretaria.value != '') {window.open('mailto:' + document.F1.part_email_secretaria.value); }", "part_email_secretaria_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_email_secretaria_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_email_secretaria_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_cod_substituido']))
    {
        $this->nm_new_label['part_cod_substituido'] = "Part Cod Substituido";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_cod_substituido = $this->part_cod_substituido;
   if (!isset($this->nmgp_cmp_hidden['part_cod_substituido']))
   {
       $this->nmgp_cmp_hidden['part_cod_substituido'] = 'off';
   }
   $sStyleHidden_part_cod_substituido = '';
   if (isset($this->nmgp_cmp_hidden['part_cod_substituido']) && $this->nmgp_cmp_hidden['part_cod_substituido'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_cod_substituido']);
       $sStyleHidden_part_cod_substituido = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_cod_substituido = 'display: none;';
   $sStyleReadInp_part_cod_substituido = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_cod_substituido']) && $this->nmgp_cmp_readonly['part_cod_substituido'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_cod_substituido']);
       $sStyleReadLab_part_cod_substituido = '';
       $sStyleReadInp_part_cod_substituido = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_cod_substituido']) && $this->nmgp_cmp_hidden['part_cod_substituido'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_cod_substituido" value="<?php echo $this->form_encode_input($part_cod_substituido) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_cod_substituido_label" id="hidden_field_label_part_cod_substituido" style="<?php echo $sStyleHidden_part_cod_substituido; ?>"><span id="id_label_part_cod_substituido"><?php echo $this->nm_new_label['part_cod_substituido']; ?></span></TD>
    <TD class="scFormDataOdd css_part_cod_substituido_line" id="hidden_field_data_part_cod_substituido" style="<?php echo $sStyleHidden_part_cod_substituido; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_cod_substituido_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="part_cod_substituido" value="<?php echo $this->form_encode_input($part_cod_substituido); ?>"><span id="id_ajax_label_part_cod_substituido"><?php echo nl2br($part_cod_substituido); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_cod_substituido_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_cod_substituido_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['part_nome_substituido']))
    {
        $this->nm_new_label['part_nome_substituido'] = "Part Nome Substituido";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $part_nome_substituido = $this->part_nome_substituido;
   if (!isset($this->nmgp_cmp_hidden['part_nome_substituido']))
   {
       $this->nmgp_cmp_hidden['part_nome_substituido'] = 'off';
   }
   $sStyleHidden_part_nome_substituido = '';
   if (isset($this->nmgp_cmp_hidden['part_nome_substituido']) && $this->nmgp_cmp_hidden['part_nome_substituido'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['part_nome_substituido']);
       $sStyleHidden_part_nome_substituido = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_part_nome_substituido = 'display: none;';
   $sStyleReadInp_part_nome_substituido = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['part_nome_substituido']) && $this->nmgp_cmp_readonly['part_nome_substituido'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['part_nome_substituido']);
       $sStyleReadLab_part_nome_substituido = '';
       $sStyleReadInp_part_nome_substituido = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['part_nome_substituido']) && $this->nmgp_cmp_hidden['part_nome_substituido'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="part_nome_substituido" value="<?php echo $this->form_encode_input($part_nome_substituido) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_part_nome_substituido_label" id="hidden_field_label_part_nome_substituido" style="<?php echo $sStyleHidden_part_nome_substituido; ?>"><span id="id_label_part_nome_substituido"><?php echo $this->nm_new_label['part_nome_substituido']; ?></span></TD>
    <TD class="scFormDataOdd css_part_nome_substituido_line" id="hidden_field_data_part_nome_substituido" style="<?php echo $sStyleHidden_part_nome_substituido; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_part_nome_substituido_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="part_nome_substituido" value="<?php echo $this->form_encode_input($part_nome_substituido); ?>"><span id="id_ajax_label_part_nome_substituido"><?php echo nl2br($part_nome_substituido); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_part_nome_substituido_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_part_nome_substituido_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cpf_del']))
    {
        $this->nm_new_label['cpf_del'] = "cpf_del";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cpf_del = $this->cpf_del;
   if (!isset($this->nmgp_cmp_hidden['cpf_del']))
   {
       $this->nmgp_cmp_hidden['cpf_del'] = 'off';
   }
   $sStyleHidden_cpf_del = '';
   if (isset($this->nmgp_cmp_hidden['cpf_del']) && $this->nmgp_cmp_hidden['cpf_del'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cpf_del']);
       $sStyleHidden_cpf_del = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cpf_del = 'display: none;';
   $sStyleReadInp_cpf_del = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cpf_del']) && $this->nmgp_cmp_readonly['cpf_del'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cpf_del']);
       $sStyleReadLab_cpf_del = '';
       $sStyleReadInp_cpf_del = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cpf_del']) && $this->nmgp_cmp_hidden['cpf_del'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cpf_del" value="<?php echo $this->form_encode_input($cpf_del) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cpf_del_label" id="hidden_field_label_cpf_del" style="<?php echo $sStyleHidden_cpf_del; ?>"><span id="id_label_cpf_del"><?php echo $this->nm_new_label['cpf_del']; ?></span></TD>
    <TD class="scFormDataOdd css_cpf_del_line" id="hidden_field_data_cpf_del" style="<?php echo $sStyleHidden_cpf_del; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cpf_del_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="cpf_del" value="<?php echo $this->form_encode_input($cpf_del); ?>"><span id="id_ajax_label_cpf_del"><?php echo nl2br($cpf_del); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cpf_del_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cpf_del_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['sql_log']))
    {
        $this->nm_new_label['sql_log'] = "sql_log";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $sql_log = $this->sql_log;
   if (!isset($this->nmgp_cmp_hidden['sql_log']))
   {
       $this->nmgp_cmp_hidden['sql_log'] = 'off';
   }
   $sStyleHidden_sql_log = '';
   if (isset($this->nmgp_cmp_hidden['sql_log']) && $this->nmgp_cmp_hidden['sql_log'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['sql_log']);
       $sStyleHidden_sql_log = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_sql_log = 'display: none;';
   $sStyleReadInp_sql_log = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['sql_log']) && $this->nmgp_cmp_readonly['sql_log'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['sql_log']);
       $sStyleReadLab_sql_log = '';
       $sStyleReadInp_sql_log = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['sql_log']) && $this->nmgp_cmp_hidden['sql_log'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sql_log" value="<?php echo $this->form_encode_input($sql_log) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_sql_log_label" id="hidden_field_label_sql_log" style="<?php echo $sStyleHidden_sql_log; ?>"><span id="id_label_sql_log"><?php echo $this->nm_new_label['sql_log']; ?></span></TD>
    <TD class="scFormDataOdd css_sql_log_line" id="hidden_field_data_sql_log" style="<?php echo $sStyleHidden_sql_log; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sql_log_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="sql_log" value="<?php echo $this->form_encode_input($sql_log); ?>"><span id="id_ajax_label_sql_log"><?php echo nl2br($sql_log); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sql_log_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sql_log_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


</TABLE></div><!-- bloco_f -->
</td></tr>
<tr id="sc-id-required-row"><td class="scFormPageText">
<?php
$requiredMessage = $this->Ini->Nm_lang['lang_othr_reqr'];
?>
<span class="scFormRequiredOddColor">* <?php echo $requiredMessage; ?></span>
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['birpara'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "birpara", "scBtnFn_sys_GridPermiteSeq('b')", "scBtnFn_sys_GridPermiteSeq('b')", "brec_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
?> 
   <input type="text" class="scFormToolbarInput" name="nmgp_rec_b" value="" style="width:25px;vertical-align: middle;"/> 
<?php 
      }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Shift + &#8592;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['back'];
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + &#8594;)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
</td></tr> 
<?php
$this->displayAppFooter();
?>
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

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1,2,3,4,5,6,7);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0,2 => 0,3 => 0,4 => 0,5 => 0,6 => 0,7 => 0);
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
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['masterValue']);
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
  if ("rodape" == sFldName)
  {
    document.getElementById("head_mark_rodape_0").innerHTML = sFldValue;
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_acompanhantes_rsvp");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_acompanhantes_rsvp");
 parent.scAjaxDetailHeight("form_acompanhantes_rsvp", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_acompanhantes_rsvp", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_acompanhantes_rsvp", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['sc_modal'])
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
        function scBtnFn_sys_format_inc() {
                if ($("#sc_b_new_t.sc-unique-btn-1").length && $("#sc_b_new_t.sc-unique-btn-1").is(":visible")) {
                    if ($("#sc_b_new_t.sc-unique-btn-1").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('novo');
                         return;
                }
                if ($("#sc_b_ins_t.sc-unique-btn-2").length && $("#sc_b_ins_t.sc-unique-btn-2").is(":visible")) {
                    if ($("#sc_b_ins_t.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('incluir');
                         return;
                }
        }
        function scBtnFn_sys_format_cnl() {
                if ($("#sc_b_sai_t.sc-unique-btn-3").length && $("#sc_b_sai_t.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        <?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
                         return;
                }
        }
        function scBtnFn_sys_format_alt() {
                if ($("#sc_b_upd_t.sc-unique-btn-4").length && $("#sc_b_upd_t.sc-unique-btn-4").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-4").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                         return;
                }
        }
        function scBtnFn_sys_format_exc() {
                if ($("#sc_b_del_t.sc-unique-btn-5").length && $("#sc_b_del_t.sc-unique-btn-5").is(":visible")) {
                    if ($("#sc_b_del_t.sc-unique-btn-5").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('excluir');
                         return;
                }
        }
        function scBtnFn_Pessoas() {
                if ($("#sc_Pessoas_top").length && $("#sc_Pessoas_top").is(":visible")) {
                    if ($("#sc_Pessoas_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_Pessoas()
                         return;
                }
                if ($("#sc_Pessoas_top").length && $("#sc_Pessoas_top").is(":visible")) {
                    if ($("#sc_Pessoas_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_Pessoas()
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
                if ($("#sc_b_sai_t.sc-unique-btn-6").length && $("#sc_b_sai_t.sc-unique-btn-6").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-6").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                         return;
                }
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
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
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
                if ($("#sc_b_ini_b.sc-unique-btn-11").length && $("#sc_b_ini_b.sc-unique-btn-11").is(":visible")) {
                    if ($("#sc_b_ini_b.sc-unique-btn-11").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('inicio');
                         return;
                }
        }
        function scBtnFn_sys_format_ret() {
                if ($("#sc_b_ret_b.sc-unique-btn-12").length && $("#sc_b_ret_b.sc-unique-btn-12").is(":visible")) {
                    if ($("#sc_b_ret_b.sc-unique-btn-12").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('retorna');
                         return;
                }
        }
        function scBtnFn_sys_format_ava() {
                if ($("#sc_b_avc_b.sc-unique-btn-13").length && $("#sc_b_avc_b.sc-unique-btn-13").is(":visible")) {
                    if ($("#sc_b_avc_b.sc-unique-btn-13").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('avanca');
                         return;
                }
        }
        function scBtnFn_sys_format_fim() {
                if ($("#sc_b_fim_b.sc-unique-btn-14").length && $("#sc_b_fim_b.sc-unique-btn-14").is(":visible")) {
                    if ($("#sc_b_fim_b.sc-unique-btn-14").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('final');
                         return;
                }
        }
</script>
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_acompanhantes_rsvp']['inside_nested_iframe']) {
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
