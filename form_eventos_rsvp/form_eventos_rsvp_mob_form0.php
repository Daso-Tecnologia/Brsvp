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

?>
<!DOCTYPE html>

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("BRSVP - Cadastro de Eventos Inclusão"); } else { echo strip_tags("BRSVP - Cadastro de Eventos  Edição"); } ?></TITLE>
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
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/colorpicker/css/colorpicker.css" type="text/css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/colorpicker/js/colorpicker.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/colorpicker/js/eye.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/colorpicker/js/utils.js"></SCRIPT>
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
.css_read_off_evento_dt_realizacao button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_evento_dt_conclusao button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_data_conclusao_app button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_data_chegada_destino_app button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_data_partida_destino_app button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_eventos_rsvp/form_eventos_rsvp_mob_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_eventos_rsvp_mob_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_eventos_rsvp_mob_jquery.php');

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

  $('#SC_fast_search_t').keyup(function(e) {
   scQuickSearchKeyUp('t', e);
  });

  $("#hidden_bloco_0,#hidden_bloco_1,#hidden_bloco_2,#hidden_bloco_3").each(function() {
   $(this.rows[0]).bind("click", {block: this}, toggleBlock)
                  .mouseover(function() { $(this).css("cursor", "pointer"); })
                  .mouseout(function() { $(this).css("cursor", ""); });
  });

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
    "hidden_bloco_0": true,
    "hidden_bloco_1": true,
    "hidden_bloco_2": true,
    "hidden_bloco_3": true
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['recarga'];
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['link_info']['remove_border']) {
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

if (isset($_SESSION['scriptcase']['form_eventos_rsvp']['error_buffer']) && '' != $_SESSION['scriptcase']['form_eventos_rsvp']['error_buffer'])
{
    echo $_SESSION['scriptcase']['form_eventos_rsvp']['error_buffer'];
}
elseif (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
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
 include_once("form_eventos_rsvp_mob_js0.php");
?>
<script type="text/javascript" src="<?php  echo $this->Ini->path_js . "/jsrsClient.js" ?>"> 
</script> 
<script type="text/javascript"> 
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
<form  name="F1" method="post" enctype="multipart/form-data" 
               action="form_eventos_rsvp_mob.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['insert_validation']; ?>">
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
<input type="hidden" name="upload_file_flag" value="">
<input type="hidden" name="upload_file_check" value="">
<input type="hidden" name="upload_file_name" value="">
<input type="hidden" name="upload_file_temp" value="">
<input type="hidden" name="upload_file_libs" value="">
<input type="hidden" name="upload_file_height" value="">
<input type="hidden" name="upload_file_width" value="">
<input type="hidden" name="upload_file_aspect" value="">
<input type="hidden" name="upload_file_type" value="">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_eventos_rsvp_mob'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_eventos_rsvp_mob'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['fast_search'][2] : "";
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
          $SC_Label_atu['evento_id'] = (isset($this->nm_new_label['evento_id'])) ? $this->nm_new_label['evento_id'] : 'Cód. Evento:'; 
          $SC_Label_atu['evento_id_interno'] = (isset($this->nm_new_label['evento_id_interno'])) ? $this->nm_new_label['evento_id_interno'] : 'Código Interno:'; 
          $SC_Label_atu['evento_id_complementar'] = (isset($this->nm_new_label['evento_id_complementar'])) ? $this->nm_new_label['evento_id_complementar'] : 'Código Complementar:'; 
          $SC_Label_atu['evento_nome'] = (isset($this->nm_new_label['evento_nome'])) ? $this->nm_new_label['evento_nome'] : 'Nome:'; 
          $SC_Label_atu['evento_idioma'] = (isset($this->nm_new_label['evento_idioma'])) ? $this->nm_new_label['evento_idioma'] : 'Idioma:'; 
          $SC_Label_atu['evento_dt_realizacao'] = (isset($this->nm_new_label['evento_dt_realizacao'])) ? $this->nm_new_label['evento_dt_realizacao'] : 'Data da Realização:'; 
          $SC_Label_atu['evento_dt_conclusao'] = (isset($this->nm_new_label['evento_dt_conclusao'])) ? $this->nm_new_label['evento_dt_conclusao'] : 'Data da Conclusão:'; 
          $SC_Label_atu['evento_status'] = (isset($this->nm_new_label['evento_status'])) ? $this->nm_new_label['evento_status'] : 'Status:'; 
          $SC_Label_atu['evento_logo'] = (isset($this->nm_new_label['evento_logo'])) ? $this->nm_new_label['evento_logo'] : ' Logo do Evento:'; 
          $SC_Label_atu['evento_website'] = (isset($this->nm_new_label['evento_website'])) ? $this->nm_new_label['evento_website'] : 'Website:'; 
          $SC_Label_atu['cover_image'] = (isset($this->nm_new_label['cover_image'])) ? $this->nm_new_label['cover_image'] : 'Logo do Cliente'; 
          $SC_Label_atu['evento_email'] = (isset($this->nm_new_label['evento_email'])) ? $this->nm_new_label['evento_email'] : 'E-Mail:'; 
          $SC_Label_atu['evento_tipo'] = (isset($this->nm_new_label['evento_tipo'])) ? $this->nm_new_label['evento_tipo'] : 'Tipo:'; 
          $SC_Label_atu['enviar_app'] = (isset($this->nm_new_label['enviar_app'])) ? $this->nm_new_label['enviar_app'] : 'Gravar no APP:'; 
          $SC_Label_atu['evento_cep'] = (isset($this->nm_new_label['evento_cep'])) ? $this->nm_new_label['evento_cep'] : 'CEP:'; 
          $SC_Label_atu['evento_pais'] = (isset($this->nm_new_label['evento_pais'])) ? $this->nm_new_label['evento_pais'] : 'País:'; 
          $SC_Label_atu['evento_uf'] = (isset($this->nm_new_label['evento_uf'])) ? $this->nm_new_label['evento_uf'] : 'UF:'; 
          $SC_Label_atu['evento_municipio'] = (isset($this->nm_new_label['evento_municipio'])) ? $this->nm_new_label['evento_municipio'] : 'Município:'; 
          $SC_Label_atu['evento_bairro'] = (isset($this->nm_new_label['evento_bairro'])) ? $this->nm_new_label['evento_bairro'] : 'Bairro:'; 
          $SC_Label_atu['evento_logradouro'] = (isset($this->nm_new_label['evento_logradouro'])) ? $this->nm_new_label['evento_logradouro'] : 'Logradouro:'; 
          $SC_Label_atu['evento_numero'] = (isset($this->nm_new_label['evento_numero'])) ? $this->nm_new_label['evento_numero'] : 'Numero:'; 
          $SC_Label_atu['evento_complemento'] = (isset($this->nm_new_label['evento_complemento'])) ? $this->nm_new_label['evento_complemento'] : 'Complemento:'; 
          $SC_Label_atu['evento_observacao'] = (isset($this->nm_new_label['evento_observacao'])) ? $this->nm_new_label['evento_observacao'] : 'Observação:'; 
          $SC_Label_atu['latitude_app'] = (isset($this->nm_new_label['latitude_app'])) ? $this->nm_new_label['latitude_app'] : 'Latitude APP:'; 
          $SC_Label_atu['longitude_app'] = (isset($this->nm_new_label['longitude_app'])) ? $this->nm_new_label['longitude_app'] : 'Longitude APP:'; 
          $SC_Label_atu['evento_id_responsavel'] = (isset($this->nm_new_label['evento_id_responsavel'])) ? $this->nm_new_label['evento_id_responsavel'] : 'Responsável'; 
          $SC_Label_atu['evento_telefone'] = (isset($this->nm_new_label['evento_telefone'])) ? $this->nm_new_label['evento_telefone'] : ' Telefone:'; 
          $SC_Label_atu['evento_celular'] = (isset($this->nm_new_label['evento_celular'])) ? $this->nm_new_label['evento_celular'] : 'Celular:'; 
          $SC_Label_atu['dsc_app'] = (isset($this->nm_new_label['dsc_app'])) ? $this->nm_new_label['dsc_app'] : 'Descrição APP:'; 
          $SC_Label_atu['data_conclusao_app'] = (isset($this->nm_new_label['data_conclusao_app'])) ? $this->nm_new_label['data_conclusao_app'] : 'Data Conclusão APP:'; 
          $SC_Label_atu['localizacao_app'] = (isset($this->nm_new_label['localizacao_app'])) ? $this->nm_new_label['localizacao_app'] : 'Localização APP:'; 
          $SC_Label_atu['status_app'] = (isset($this->nm_new_label['status_app'])) ? $this->nm_new_label['status_app'] : 'Status APP:'; 
          $SC_Label_atu['status_da_publicidade'] = (isset($this->nm_new_label['status_da_publicidade'])) ? $this->nm_new_label['status_da_publicidade'] : 'Status da Publicidade:'; 
          $SC_Label_atu['timezone'] = (isset($this->nm_new_label['timezone'])) ? $this->nm_new_label['timezone'] : 'Timezone:'; 
          $SC_Label_atu['caminho_logo_cli'] = (isset($this->nm_new_label['caminho_logo_cli'])) ? $this->nm_new_label['caminho_logo_cli'] : 'Logo Evento APP:'; 
          $SC_Label_atu['caminho_cover_image'] = (isset($this->nm_new_label['caminho_cover_image'])) ? $this->nm_new_label['caminho_cover_image'] : 'Logo Cliente APP:'; 
          $SC_Label_atu['cor_principal_app'] = (isset($this->nm_new_label['cor_principal_app'])) ? $this->nm_new_label['cor_principal_app'] : 'Cor Principal APP:'; 
          $SC_Label_atu['cor_secundaria_app'] = (isset($this->nm_new_label['cor_secundaria_app'])) ? $this->nm_new_label['cor_secundaria_app'] : 'Cor Secundária APP:'; 
          $SC_Label_atu['cor_fundo_app'] = (isset($this->nm_new_label['cor_fundo_app'])) ? $this->nm_new_label['cor_fundo_app'] : 'Cor Fundo APP:'; 
          $SC_Label_atu['nome_organizador_app'] = (isset($this->nm_new_label['nome_organizador_app'])) ? $this->nm_new_label['nome_organizador_app'] : 'Nome Organizador APP:'; 
          $SC_Label_atu['email_organizador_app'] = (isset($this->nm_new_label['email_organizador_app'])) ? $this->nm_new_label['email_organizador_app'] : 'Email Organizador APP:'; 
          $SC_Label_atu['nome_comprador_app'] = (isset($this->nm_new_label['nome_comprador_app'])) ? $this->nm_new_label['nome_comprador_app'] : 'Nome Comprador APP:'; 
          $SC_Label_atu['wz_suporte_app'] = (isset($this->nm_new_label['wz_suporte_app'])) ? $this->nm_new_label['wz_suporte_app'] : 'Suporte Watsapp APP:'; 
          $SC_Label_atu['gamificacao_ativada_app'] = (isset($this->nm_new_label['gamificacao_ativada_app'])) ? $this->nm_new_label['gamificacao_ativada_app'] : 'Gamificacao Ativada APP:'; 
          $SC_Label_atu['galeria_fotos_ativada_app'] = (isset($this->nm_new_label['galeria_fotos_ativada_app'])) ? $this->nm_new_label['galeria_fotos_ativada_app'] : 'Galeria Fotos Ativada APP:'; 
          $SC_Label_atu['galeria_fotos_publicas_ativada_app'] = (isset($this->nm_new_label['galeria_fotos_publicas_ativada_app'])) ? $this->nm_new_label['galeria_fotos_publicas_ativada_app'] : 'Galeria Fotos Públicas Ativada APP:'; 
          $SC_Label_atu['chat_evento_ativado_app'] = (isset($this->nm_new_label['chat_evento_ativado_app'])) ? $this->nm_new_label['chat_evento_ativado_app'] : 'Chat Evento Ativado APP:'; 
          $SC_Label_atu['cidade_destino_app'] = (isset($this->nm_new_label['cidade_destino_app'])) ? $this->nm_new_label['cidade_destino_app'] : 'Cidade Destino APP:'; 
          $SC_Label_atu['pais_destino_app'] = (isset($this->nm_new_label['pais_destino_app'])) ? $this->nm_new_label['pais_destino_app'] : 'Pais Destino APP:'; 
          $SC_Label_atu['data_chegada_destino_app'] = (isset($this->nm_new_label['data_chegada_destino_app'])) ? $this->nm_new_label['data_chegada_destino_app'] : 'Data Chegada Destino APP:'; 
          $SC_Label_atu['data_partida_destino_app'] = (isset($this->nm_new_label['data_partida_destino_app'])) ? $this->nm_new_label['data_partida_destino_app'] : 'Data Partida Destino APP:'; 
          $SC_Label_atu['texto_email_convite_app'] = (isset($this->nm_new_label['texto_email_convite_app'])) ? $this->nm_new_label['texto_email_convite_app'] : 'Texto Email Convite APP:'; 
          $SC_Label_atu['texto_whatsapp_convite_app'] = (isset($this->nm_new_label['texto_whatsapp_convite_app'])) ? $this->nm_new_label['texto_whatsapp_convite_app'] : 'Texto Whatsapp Convite APP:'; 
          $SC_Label_atu['termos_condicoes_app'] = (isset($this->nm_new_label['termos_condicoes_app'])) ? $this->nm_new_label['termos_condicoes_app'] : 'Termos e Condições APP:'; 
          $SC_Label_atu['canal_preferencial_convite_app'] = (isset($this->nm_new_label['canal_preferencial_convite_app'])) ? $this->nm_new_label['canal_preferencial_convite_app'] : 'Canal Preferencial Convite APP:'; 
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
        $buttonMacroDisabled = 'sc-unique-btn-15';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-16';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['insert'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bincluir", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_ins_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!$this->Embutida_call || $this->sc_evento == "novo" || $this->sc_evento == "insert" || $this->sc_evento == "incluir")) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on" && $this->nmgp_botoes['cancel'] == "on") && ($this->nm_flag_saida_novo != "S" || $this->nmgp_botoes['exit'] != "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-17';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-18';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['delete'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-19';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-20';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-21';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-22';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-23';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-24';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<?php
   if (!isset($this->nmgp_cmp_hidden['evento_id_interno']))
   {
       $this->nmgp_cmp_hidden['evento_id_interno'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['evento_id_complementar']))
   {
       $this->nmgp_cmp_hidden['evento_id_complementar'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['evento_tipo']))
   {
       $this->nmgp_cmp_hidden['evento_tipo'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['sql_log']))
   {
       $this->nmgp_cmp_hidden['sql_log'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%; border-style: none;"><input type="hidden" name="evento_logo_ul_name" id="id_sc_field_evento_logo_ul_name" value="<?php echo $this->form_encode_input($this->evento_logo_ul_name);?>">
<input type="hidden" name="evento_logo_ul_type" id="id_sc_field_evento_logo_ul_type" value="<?php echo $this->form_encode_input($this->evento_logo_ul_type);?>">
<input type="hidden" name="cover_image_ul_name" id="id_sc_field_cover_image_ul_name" value="<?php echo $this->form_encode_input($this->cover_image_ul_name);?>">
<input type="hidden" name="cover_image_ul_type" id="id_sc_field_cover_image_ul_type" value="<?php echo $this->form_encode_input($this->cover_image_ul_type);?>">
   <tr>


    <TD colspan="1" height="20" class="scFormBlock" style="background-color: #c7c7b9">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont" style="font-size: 14px"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf0\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;background-color: #c7c7b9; font-size: 14px; \" class=\"scFormBlockAlign\">"; } ?>CADASTROS<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['particip_link']))
    {
        $this->nm_new_label['particip_link'] = "Participantes";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $particip_link = $this->particip_link;
   $sStyleHidden_particip_link = '';
   if (isset($this->nmgp_cmp_hidden['particip_link']) && $this->nmgp_cmp_hidden['particip_link'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['particip_link']);
       $sStyleHidden_particip_link = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_particip_link = 'display: none;';
   $sStyleReadInp_particip_link = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['particip_link']) && $this->nmgp_cmp_readonly['particip_link'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['particip_link']);
       $sStyleReadLab_particip_link = '';
       $sStyleReadInp_particip_link = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['particip_link']) && $this->nmgp_cmp_hidden['particip_link'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="particip_link" value="<?php echo $this->form_encode_input($particip_link) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_particip_link" style="<?php echo $sStyleHidden_particip_link; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_particip_link_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_particip_link_label" style=" padding: 0px; width: 100%;"><span id="id_label_particip_link"><?php echo $this->nm_new_label['particip_link']; ?></span></td></tr><tr><td class="css_particip_link_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__participantes2.png"))
          { 
              $particip_link = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $particip_link = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_particip_link = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__participantes2.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__participantes2.png"); 
              $out_particip_link = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_particip_link = "sc_" . $out_particip_link . "_particip_link_4040_" . $img_time . "_grp__NM__img__NM__participantes2.png";
              $out_particip_link = $this->Ini->path_imag_temp . "/sc_" . $out_particip_link . "_particip_link_4040_" . $img_time . "_grp__NM__img__NM__participantes2.png";
              if (!is_file($this->Ini->root . $out_particip_link)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_particip_link, true);
                  $sc_obj_img->setWidth(40);
                  $sc_obj_img->setHeight(40);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_particip_link);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_particip_link;
                  $particip_link = "<img  border=\"0\" src=\"" . $prt_particip_link . "\"/>" ; 
              }
              else {
                  $particip_link = "<img  border=\"0\" src=\"" . $out_particip_link . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_particip_link"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_grid_participantes_rsvp_1_cons . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout', 'inicio', '_self', '0', '0', 'grid_participantes_rsvp_1')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $particip_link ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["particip_link"]) &&  $this->nmgp_cmp_readonly["particip_link"] == "on") { 

 ?>
<input type="hidden" name="particip_link" value="<?php echo $this->form_encode_input($particip_link) . "\">" . $particip_link . ""; ?>
<?php } else { ?>
<span id="id_read_on_particip_link" class="sc-ui-readonly-particip_link css_particip_link_line" style="<?php echo $sStyleReadLab_particip_link; ?>"><?php echo $this->form_format_readonly("particip_link", $this->form_encode_input($this->particip_link)); ?></span><span id="id_read_off_particip_link" class="css_read_off_particip_link<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_particip_link; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_particip_link_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_particip_link_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_link']))
    {
        $this->nm_new_label['empresa_link'] = "Empresas";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_link = $this->empresa_link;
   $sStyleHidden_empresa_link = '';
   if (isset($this->nmgp_cmp_hidden['empresa_link']) && $this->nmgp_cmp_hidden['empresa_link'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_link']);
       $sStyleHidden_empresa_link = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_link = 'display: none;';
   $sStyleReadInp_empresa_link = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_link']) && $this->nmgp_cmp_readonly['empresa_link'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_link']);
       $sStyleReadLab_empresa_link = '';
       $sStyleReadInp_empresa_link = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_link']) && $this->nmgp_cmp_hidden['empresa_link'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_link" value="<?php echo $this->form_encode_input($empresa_link) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_empresa_link" style="<?php echo $sStyleHidden_empresa_link; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_link_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_empresa_link_label" style=" padding: 0px; width: 100%;"><span id="id_label_empresa_link"><?php echo $this->nm_new_label['empresa_link']; ?></span></td></tr><tr><td class="css_empresa_link_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__companhia.png"))
          { 
              $empresa_link = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $empresa_link = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_empresa_link = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__companhia.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__companhia.png"); 
              $out_empresa_link = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_empresa_link = "sc_" . $out_empresa_link . "_empresa_link_5050_" . $img_time . "_grp__NM__img__NM__companhia.png";
              $out_empresa_link = $this->Ini->path_imag_temp . "/sc_" . $out_empresa_link . "_empresa_link_5050_" . $img_time . "_grp__NM__img__NM__companhia.png";
              if (!is_file($this->Ini->root . $out_empresa_link)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_empresa_link, true);
                  $sc_obj_img->setWidth(50);
                  $sc_obj_img->setHeight(50);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_empresa_link);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_empresa_link;
                  $empresa_link = "<img  border=\"0\" src=\"" . $prt_empresa_link . "\"/>" ; 
              }
              else {
                  $empresa_link = "<img  border=\"0\" src=\"" . $out_empresa_link . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_empresa_link"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_form_eventos_empresas_rsvp_edit . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutNMSC_modal*scinok*scout', '', 'modal', '900', '1500', 'form_eventos_empresas_rsvp')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $empresa_link ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_link"]) &&  $this->nmgp_cmp_readonly["empresa_link"] == "on") { 

 ?>
<input type="hidden" name="empresa_link" value="<?php echo $this->form_encode_input($empresa_link) . "\">" . $empresa_link . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_link" class="sc-ui-readonly-empresa_link css_empresa_link_line" style="<?php echo $sStyleReadLab_empresa_link; ?>"><?php echo $this->form_format_readonly("empresa_link", $this->form_encode_input($this->empresa_link)); ?></span><span id="id_read_off_empresa_link" class="css_read_off_empresa_link<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_link; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_link_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_link_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['usuarios_link']))
    {
        $this->nm_new_label['usuarios_link'] = "Usuários";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $usuarios_link = $this->usuarios_link;
   $sStyleHidden_usuarios_link = '';
   if (isset($this->nmgp_cmp_hidden['usuarios_link']) && $this->nmgp_cmp_hidden['usuarios_link'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['usuarios_link']);
       $sStyleHidden_usuarios_link = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_usuarios_link = 'display: none;';
   $sStyleReadInp_usuarios_link = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['usuarios_link']) && $this->nmgp_cmp_readonly['usuarios_link'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['usuarios_link']);
       $sStyleReadLab_usuarios_link = '';
       $sStyleReadInp_usuarios_link = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['usuarios_link']) && $this->nmgp_cmp_hidden['usuarios_link'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="usuarios_link" value="<?php echo $this->form_encode_input($usuarios_link) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_usuarios_link" style="<?php echo $sStyleHidden_usuarios_link; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_usuarios_link_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_usuarios_link_label" style=" padding: 0px; width: 100%;"><span id="id_label_usuarios_link"><?php echo $this->nm_new_label['usuarios_link']; ?></span></td></tr><tr><td class="css_usuarios_link_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__do-utilizador.png"))
          { 
              $usuarios_link = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $usuarios_link = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_usuarios_link = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__do-utilizador.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__do-utilizador.png"); 
              $out_usuarios_link = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_usuarios_link = "sc_" . $out_usuarios_link . "_usuarios_link_4040_" . $img_time . "_grp__NM__img__NM__do-utilizador.png";
              $out_usuarios_link = $this->Ini->path_imag_temp . "/sc_" . $out_usuarios_link . "_usuarios_link_4040_" . $img_time . "_grp__NM__img__NM__do-utilizador.png";
              if (!is_file($this->Ini->root . $out_usuarios_link)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_usuarios_link, true);
                  $sc_obj_img->setWidth(40);
                  $sc_obj_img->setHeight(40);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_usuarios_link);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_usuarios_link;
                  $usuarios_link = "<img  border=\"0\" src=\"" . $prt_usuarios_link . "\"/>" ; 
              }
              else {
                  $usuarios_link = "<img  border=\"0\" src=\"" . $out_usuarios_link . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_usuarios_link"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_form_eventos_usuarios_rsvp_edit . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutNMSC_modal*scinok*scout', '', 'modal', '700', '1400', 'form_eventos_usuarios_rsvp')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $usuarios_link ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["usuarios_link"]) &&  $this->nmgp_cmp_readonly["usuarios_link"] == "on") { 

 ?>
<input type="hidden" name="usuarios_link" value="<?php echo $this->form_encode_input($usuarios_link) . "\">" . $usuarios_link . ""; ?>
<?php } else { ?>
<span id="id_read_on_usuarios_link" class="sc-ui-readonly-usuarios_link css_usuarios_link_line" style="<?php echo $sStyleReadLab_usuarios_link; ?>"><?php echo $this->form_format_readonly("usuarios_link", $this->form_encode_input($this->usuarios_link)); ?></span><span id="id_read_off_usuarios_link" class="css_read_off_usuarios_link<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_usuarios_link; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_usuarios_link_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_usuarios_link_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['publicos_link']))
    {
        $this->nm_new_label['publicos_link'] = "Públicos";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $publicos_link = $this->publicos_link;
   $sStyleHidden_publicos_link = '';
   if (isset($this->nmgp_cmp_hidden['publicos_link']) && $this->nmgp_cmp_hidden['publicos_link'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['publicos_link']);
       $sStyleHidden_publicos_link = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_publicos_link = 'display: none;';
   $sStyleReadInp_publicos_link = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['publicos_link']) && $this->nmgp_cmp_readonly['publicos_link'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['publicos_link']);
       $sStyleReadLab_publicos_link = '';
       $sStyleReadInp_publicos_link = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['publicos_link']) && $this->nmgp_cmp_hidden['publicos_link'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="publicos_link" value="<?php echo $this->form_encode_input($publicos_link) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_publicos_link" style="<?php echo $sStyleHidden_publicos_link; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_publicos_link_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_publicos_link_label" style=" padding: 0px; width: 100%;"><span id="id_label_publicos_link"><?php echo $this->nm_new_label['publicos_link']; ?></span></td></tr><tr><td class="css_publicos_link_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__grupo-de-usuarios (1).png"))
          { 
              $publicos_link = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $publicos_link = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_publicos_link = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__grupo-de-usuarios (1).png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__grupo-de-usuarios (1).png"); 
              $out_publicos_link = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_publicos_link = "sc_" . $out_publicos_link . "_publicos_link_4040_" . $img_time . "_grp__NM__img__NM__grupo-de-usuarios (1).png";
              $out_publicos_link = $this->Ini->path_imag_temp . "/sc_" . $out_publicos_link . "_publicos_link_4040_" . $img_time . "_grp__NM__img__NM__grupo-de-usuarios (1).png";
              if (!is_file($this->Ini->root . $out_publicos_link)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_publicos_link, true);
                  $sc_obj_img->setWidth(40);
                  $sc_obj_img->setHeight(40);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_publicos_link);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_publicos_link;
                  $publicos_link = "<img  border=\"0\" src=\"" . $prt_publicos_link . "\"/>" ; 
              }
              else {
                  $publicos_link = "<img  border=\"0\" src=\"" . $out_publicos_link . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_publicos_link"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_form_eventos_publicos_rsvp_edit . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutNMSC_modal*scinok*scout', '', 'modal', '700', '1400', 'form_eventos_publicos_rsvp')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $publicos_link ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["publicos_link"]) &&  $this->nmgp_cmp_readonly["publicos_link"] == "on") { 

 ?>
<input type="hidden" name="publicos_link" value="<?php echo $this->form_encode_input($publicos_link) . "\">" . $publicos_link . ""; ?>
<?php } else { ?>
<span id="id_read_on_publicos_link" class="sc-ui-readonly-publicos_link css_publicos_link_line" style="<?php echo $sStyleReadLab_publicos_link; ?>"><?php echo $this->form_format_readonly("publicos_link", $this->form_encode_input($this->publicos_link)); ?></span><span id="id_read_off_publicos_link" class="css_read_off_publicos_link<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_publicos_link; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_publicos_link_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_publicos_link_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hoteis_link']))
    {
        $this->nm_new_label['hoteis_link'] = "Hotéis";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hoteis_link = $this->hoteis_link;
   $sStyleHidden_hoteis_link = '';
   if (isset($this->nmgp_cmp_hidden['hoteis_link']) && $this->nmgp_cmp_hidden['hoteis_link'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hoteis_link']);
       $sStyleHidden_hoteis_link = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hoteis_link = 'display: none;';
   $sStyleReadInp_hoteis_link = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hoteis_link']) && $this->nmgp_cmp_readonly['hoteis_link'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hoteis_link']);
       $sStyleReadLab_hoteis_link = '';
       $sStyleReadInp_hoteis_link = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hoteis_link']) && $this->nmgp_cmp_hidden['hoteis_link'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hoteis_link" value="<?php echo $this->form_encode_input($hoteis_link) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_hoteis_link" style="<?php echo $sStyleHidden_hoteis_link; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hoteis_link_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_hoteis_link_label" style=" padding: 0px; width: 100%;"><span id="id_label_hoteis_link"><?php echo $this->nm_new_label['hoteis_link']; ?></span></td></tr><tr><td class="css_hoteis_link_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__hotel.png"))
          { 
              $hoteis_link = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $hoteis_link = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_hoteis_link = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__hotel.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__hotel.png"); 
              $out_hoteis_link = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_hoteis_link = "sc_" . $out_hoteis_link . "_hoteis_link_4040_" . $img_time . "_grp__NM__img__NM__hotel.png";
              $out_hoteis_link = $this->Ini->path_imag_temp . "/sc_" . $out_hoteis_link . "_hoteis_link_4040_" . $img_time . "_grp__NM__img__NM__hotel.png";
              if (!is_file($this->Ini->root . $out_hoteis_link)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_hoteis_link, true);
                  $sc_obj_img->setWidth(40);
                  $sc_obj_img->setHeight(40);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_hoteis_link);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_hoteis_link;
                  $hoteis_link = "<img  border=\"0\" src=\"" . $prt_hoteis_link . "\"/>" ; 
              }
              else {
                  $hoteis_link = "<img  border=\"0\" src=\"" . $out_hoteis_link . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_hoteis_link"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_form_eventos_hoteis_rsvp_edit . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutNMSC_modal*scinok*scout', '', 'modal', '700', '1400', 'form_eventos_hoteis_rsvp')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $hoteis_link ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hoteis_link"]) &&  $this->nmgp_cmp_readonly["hoteis_link"] == "on") { 

 ?>
<input type="hidden" name="hoteis_link" value="<?php echo $this->form_encode_input($hoteis_link) . "\">" . $hoteis_link . ""; ?>
<?php } else { ?>
<span id="id_read_on_hoteis_link" class="sc-ui-readonly-hoteis_link css_hoteis_link_line" style="<?php echo $sStyleReadLab_hoteis_link; ?>"><?php echo $this->form_format_readonly("hoteis_link", $this->form_encode_input($this->hoteis_link)); ?></span><span id="id_read_off_hoteis_link" class="css_read_off_hoteis_link<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hoteis_link; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hoteis_link_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hoteis_link_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cias_link']))
    {
        $this->nm_new_label['cias_link'] = "Bloqueio Aéreo";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cias_link = $this->cias_link;
   $sStyleHidden_cias_link = '';
   if (isset($this->nmgp_cmp_hidden['cias_link']) && $this->nmgp_cmp_hidden['cias_link'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cias_link']);
       $sStyleHidden_cias_link = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cias_link = 'display: none;';
   $sStyleReadInp_cias_link = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cias_link']) && $this->nmgp_cmp_readonly['cias_link'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cias_link']);
       $sStyleReadLab_cias_link = '';
       $sStyleReadInp_cias_link = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cias_link']) && $this->nmgp_cmp_hidden['cias_link'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cias_link" value="<?php echo $this->form_encode_input($cias_link) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cias_link" style="<?php echo $sStyleHidden_cias_link; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cias_link_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cias_link_label" style=" padding: 0px; width: 100%;"><span id="id_label_cias_link"><?php echo $this->nm_new_label['cias_link']; ?></span></td></tr><tr><td class="css_cias_link_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__modo-aviao.png"))
          { 
              $cias_link = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $cias_link = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_cias_link = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__modo-aviao.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__modo-aviao.png"); 
              $out_cias_link = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_cias_link = "sc_" . $out_cias_link . "_cias_link_4040_" . $img_time . "_grp__NM__img__NM__modo-aviao.png";
              $out_cias_link = $this->Ini->path_imag_temp . "/sc_" . $out_cias_link . "_cias_link_4040_" . $img_time . "_grp__NM__img__NM__modo-aviao.png";
              if (!is_file($this->Ini->root . $out_cias_link)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_cias_link, true);
                  $sc_obj_img->setWidth(40);
                  $sc_obj_img->setHeight(40);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_cias_link);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_cias_link;
                  $cias_link = "<img  border=\"0\" src=\"" . $prt_cias_link . "\"/>" ; 
              }
              else {
                  $cias_link = "<img  border=\"0\" src=\"" . $out_cias_link . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_cias_link"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_grid_bloqueio_aereo_rsvp_cons . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutlink_remove_margin*scinno*scoutlink_remove_border*scinno*scoutlink_remove_background*scinno*scout', 'inicio', '_self', '0', '0', 'grid_bloqueio_aereo_rsvp')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $cias_link ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cias_link"]) &&  $this->nmgp_cmp_readonly["cias_link"] == "on") { 

 ?>
<input type="hidden" name="cias_link" value="<?php echo $this->form_encode_input($cias_link) . "\">" . $cias_link . ""; ?>
<?php } else { ?>
<span id="id_read_on_cias_link" class="sc-ui-readonly-cias_link css_cias_link_line" style="<?php echo $sStyleReadLab_cias_link; ?>"><?php echo $this->form_format_readonly("cias_link", $this->form_encode_input($this->cias_link)); ?></span><span id="id_read_off_cias_link" class="css_read_off_cias_link<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cias_link; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cias_link_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cias_link_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tours_lnk']))
    {
        $this->nm_new_label['tours_lnk'] = "Tours";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tours_lnk = $this->tours_lnk;
   $sStyleHidden_tours_lnk = '';
   if (isset($this->nmgp_cmp_hidden['tours_lnk']) && $this->nmgp_cmp_hidden['tours_lnk'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tours_lnk']);
       $sStyleHidden_tours_lnk = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tours_lnk = 'display: none;';
   $sStyleReadInp_tours_lnk = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tours_lnk']) && $this->nmgp_cmp_readonly['tours_lnk'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tours_lnk']);
       $sStyleReadLab_tours_lnk = '';
       $sStyleReadInp_tours_lnk = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tours_lnk']) && $this->nmgp_cmp_hidden['tours_lnk'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tours_lnk" value="<?php echo $this->form_encode_input($tours_lnk) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tours_lnk" style="<?php echo $sStyleHidden_tours_lnk; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tours_lnk_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tours_lnk_label" style=" padding: 0px; width: 100%;"><span id="id_label_tours_lnk"><?php echo $this->nm_new_label['tours_lnk']; ?></span></td></tr><tr><td class="css_tours_lnk_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__tour.png"))
          { 
              $tours_lnk = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $tours_lnk = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_tours_lnk = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__tour.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__tour.png"); 
              $out_tours_lnk = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_tours_lnk = "sc_" . $out_tours_lnk . "_tours_lnk_4040_" . $img_time . "_grp__NM__img__NM__tour.png";
              $out_tours_lnk = $this->Ini->path_imag_temp . "/sc_" . $out_tours_lnk . "_tours_lnk_4040_" . $img_time . "_grp__NM__img__NM__tour.png";
              if (!is_file($this->Ini->root . $out_tours_lnk)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_tours_lnk, true);
                  $sc_obj_img->setWidth(40);
                  $sc_obj_img->setHeight(40);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_tours_lnk);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_tours_lnk;
                  $tours_lnk = "<img  border=\"0\" src=\"" . $prt_tours_lnk . "\"/>" ; 
              }
              else {
                  $tours_lnk = "<img  border=\"0\" src=\"" . $out_tours_lnk . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_tours_lnk"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_form_eventos_tours_rsvp_edit . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutNMSC_modal*scinok*scout', '', 'modal', '700', '1400', 'form_eventos_tours_rsvp')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $tours_lnk ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tours_lnk"]) &&  $this->nmgp_cmp_readonly["tours_lnk"] == "on") { 

 ?>
<input type="hidden" name="tours_lnk" value="<?php echo $this->form_encode_input($tours_lnk) . "\">" . $tours_lnk . ""; ?>
<?php } else { ?>
<span id="id_read_on_tours_lnk" class="sc-ui-readonly-tours_lnk css_tours_lnk_line" style="<?php echo $sStyleReadLab_tours_lnk; ?>"><?php echo $this->form_format_readonly("tours_lnk", $this->form_encode_input($this->tours_lnk)); ?></span><span id="id_read_off_tours_lnk" class="css_read_off_tours_lnk<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tours_lnk; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tours_lnk_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tours_lnk_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['regionais_link']))
    {
        $this->nm_new_label['regionais_link'] = "Regionais";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $regionais_link = $this->regionais_link;
   $sStyleHidden_regionais_link = '';
   if (isset($this->nmgp_cmp_hidden['regionais_link']) && $this->nmgp_cmp_hidden['regionais_link'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['regionais_link']);
       $sStyleHidden_regionais_link = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_regionais_link = 'display: none;';
   $sStyleReadInp_regionais_link = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['regionais_link']) && $this->nmgp_cmp_readonly['regionais_link'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['regionais_link']);
       $sStyleReadLab_regionais_link = '';
       $sStyleReadInp_regionais_link = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['regionais_link']) && $this->nmgp_cmp_hidden['regionais_link'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="regionais_link" value="<?php echo $this->form_encode_input($regionais_link) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_regionais_link" style="<?php echo $sStyleHidden_regionais_link; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_regionais_link_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_regionais_link_label" style=" padding: 0px; width: 100%;"><span id="id_label_regionais_link"><?php echo $this->nm_new_label['regionais_link']; ?></span></td></tr><tr><td class="css_regionais_link_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__regionais2.png"))
          { 
              $regionais_link = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $regionais_link = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_regionais_link = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__regionais2.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__regionais2.png"); 
              $out_regionais_link = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_regionais_link = "sc_" . $out_regionais_link . "_regionais_link_4040_" . $img_time . "_grp__NM__img__NM__regionais2.png";
              $out_regionais_link = $this->Ini->path_imag_temp . "/sc_" . $out_regionais_link . "_regionais_link_4040_" . $img_time . "_grp__NM__img__NM__regionais2.png";
              if (!is_file($this->Ini->root . $out_regionais_link)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_regionais_link, true);
                  $sc_obj_img->setWidth(40);
                  $sc_obj_img->setHeight(40);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_regionais_link);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_regionais_link;
                  $regionais_link = "<img  border=\"0\" src=\"" . $prt_regionais_link . "\"/>" ; 
              }
              else {
                  $regionais_link = "<img  border=\"0\" src=\"" . $out_regionais_link . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_regionais_link"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_form_eventos_regionais_rsvp_edit . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scoutNMSC_modal*scinok*scout', '', 'modal', '700', '1400', 'form_eventos_regionais_rsvp')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $regionais_link ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["regionais_link"]) &&  $this->nmgp_cmp_readonly["regionais_link"] == "on") { 

 ?>
<input type="hidden" name="regionais_link" value="<?php echo $this->form_encode_input($regionais_link) . "\">" . $regionais_link . ""; ?>
<?php } else { ?>
<span id="id_read_on_regionais_link" class="sc-ui-readonly-regionais_link css_regionais_link_line" style="<?php echo $sStyleReadLab_regionais_link; ?>"><?php echo $this->form_format_readonly("regionais_link", $this->form_encode_input($this->regionais_link)); ?></span><span id="id_read_off_regionais_link" class="css_read_off_regionais_link<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_regionais_link; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_regionais_link_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_regionais_link_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['programacao_link']))
    {
        $this->nm_new_label['programacao_link'] = "Programações";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $programacao_link = $this->programacao_link;
   $sStyleHidden_programacao_link = '';
   if (isset($this->nmgp_cmp_hidden['programacao_link']) && $this->nmgp_cmp_hidden['programacao_link'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['programacao_link']);
       $sStyleHidden_programacao_link = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_programacao_link = 'display: none;';
   $sStyleReadInp_programacao_link = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['programacao_link']) && $this->nmgp_cmp_readonly['programacao_link'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['programacao_link']);
       $sStyleReadLab_programacao_link = '';
       $sStyleReadInp_programacao_link = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['programacao_link']) && $this->nmgp_cmp_hidden['programacao_link'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="programacao_link" value="<?php echo $this->form_encode_input($programacao_link) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_programacao_link" style="<?php echo $sStyleHidden_programacao_link; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_programacao_link_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_programacao_link_label" style=" padding: 0px; width: 100%;"><span id="id_label_programacao_link"><?php echo $this->nm_new_label['programacao_link']; ?></span></td></tr><tr><td class="css_programacao_link_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__evento.png"))
          { 
              $programacao_link = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $programacao_link = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_programacao_link = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__evento.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__evento.png"); 
              $out_programacao_link = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_programacao_link = "sc_" . $out_programacao_link . "_programacao_link_3838_" . $img_time . "_grp__NM__img__NM__evento.png";
              $out_programacao_link = $this->Ini->path_imag_temp . "/sc_" . $out_programacao_link . "_programacao_link_3838_" . $img_time . "_grp__NM__img__NM__evento.png";
              if (!is_file($this->Ini->root . $out_programacao_link)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_programacao_link, true);
                  $sc_obj_img->setWidth(38);
                  $sc_obj_img->setHeight(38);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_programacao_link);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_programacao_link;
                  $programacao_link = "<img  border=\"0\" src=\"" . $prt_programacao_link . "\"/>" ; 
              }
              else {
                  $programacao_link = "<img  border=\"0\" src=\"" . $out_programacao_link . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_programacao_link"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_form_eventos_programa_rsvp_edit . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scoutNMSC_modal*scinok*scout', '', 'modal', '700', '1400', 'form_eventos_programa_rsvp')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $programacao_link ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["programacao_link"]) &&  $this->nmgp_cmp_readonly["programacao_link"] == "on") { 

 ?>
<input type="hidden" name="programacao_link" value="<?php echo $this->form_encode_input($programacao_link) . "\">" . $programacao_link . ""; ?>
<?php } else { ?>
<span id="id_read_on_programacao_link" class="sc-ui-readonly-programacao_link css_programacao_link_line" style="<?php echo $sStyleReadLab_programacao_link; ?>"><?php echo $this->form_format_readonly("programacao_link", $this->form_encode_input($this->programacao_link)); ?></span><span id="id_read_off_programacao_link" class="css_read_off_programacao_link<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_programacao_link; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_programacao_link_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_programacao_link_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['mailling_link']))
    {
        $this->nm_new_label['mailling_link'] = "Mailling";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $mailling_link = $this->mailling_link;
   $sStyleHidden_mailling_link = '';
   if (isset($this->nmgp_cmp_hidden['mailling_link']) && $this->nmgp_cmp_hidden['mailling_link'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['mailling_link']);
       $sStyleHidden_mailling_link = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_mailling_link = 'display: none;';
   $sStyleReadInp_mailling_link = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['mailling_link']) && $this->nmgp_cmp_readonly['mailling_link'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['mailling_link']);
       $sStyleReadLab_mailling_link = '';
       $sStyleReadInp_mailling_link = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['mailling_link']) && $this->nmgp_cmp_hidden['mailling_link'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="mailling_link" value="<?php echo $this->form_encode_input($mailling_link) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_mailling_link" style="<?php echo $sStyleHidden_mailling_link; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_mailling_link_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_mailling_link_label" style=" padding: 0px; width: 100%;"><span id="id_label_mailling_link"><?php echo $this->nm_new_label['mailling_link']; ?></span></td></tr><tr><td class="css_mailling_link_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__xlsx.png"))
          { 
              $mailling_link = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $mailling_link = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_mailling_link = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__xlsx.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__xlsx.png"); 
              $out_mailling_link = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_mailling_link = "sc_" . $out_mailling_link . "_mailling_link_4242_" . $img_time . "_grp__NM__img__NM__xlsx.png";
              $out_mailling_link = $this->Ini->path_imag_temp . "/sc_" . $out_mailling_link . "_mailling_link_4242_" . $img_time . "_grp__NM__img__NM__xlsx.png";
              if (!is_file($this->Ini->root . $out_mailling_link)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_mailling_link, true);
                  $sc_obj_img->setWidth(42);
                  $sc_obj_img->setHeight(42);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_mailling_link);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_mailling_link;
                  $mailling_link = "<img  border=\"0\" src=\"" . $prt_mailling_link . "\"/>" ; 
              }
              else {
                  $mailling_link = "<img  border=\"0\" src=\"" . $out_mailling_link . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_mailling_link"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_control_rel_01_edit . "', '$this->nm_location', 'SC_glo_par_vg_usuario_id*scinvg_usuario_id*scoutSC_glo_par_vg_evento_id*scinvg_evento_id*scoutNM_btn_insert*scinN*scoutNM_btn_update*scinN*scoutNM_btn_delete*scinN*scoutNM_btn_navega*scinN*scout', '', '_self', '0', '0', 'control_rel_01')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $mailling_link ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["mailling_link"]) &&  $this->nmgp_cmp_readonly["mailling_link"] == "on") { 

 ?>
<input type="hidden" name="mailling_link" value="<?php echo $this->form_encode_input($mailling_link) . "\">" . $mailling_link . ""; ?>
<?php } else { ?>
<span id="id_read_on_mailling_link" class="sc-ui-readonly-mailling_link css_mailling_link_line" style="<?php echo $sStyleReadLab_mailling_link; ?>"><?php echo $this->form_format_readonly("mailling_link", $this->form_encode_input($this->mailling_link)); ?></span><span id="id_read_off_mailling_link" class="css_read_off_mailling_link<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_mailling_link; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_mailling_link_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_mailling_link_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['observacoes']))
    {
        $this->nm_new_label['observacoes'] = "Obs. Confirmação";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $observacoes = $this->observacoes;
   $sStyleHidden_observacoes = '';
   if (isset($this->nmgp_cmp_hidden['observacoes']) && $this->nmgp_cmp_hidden['observacoes'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['observacoes']);
       $sStyleHidden_observacoes = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_observacoes = 'display: none;';
   $sStyleReadInp_observacoes = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['observacoes']) && $this->nmgp_cmp_readonly['observacoes'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['observacoes']);
       $sStyleReadLab_observacoes = '';
       $sStyleReadInp_observacoes = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['observacoes']) && $this->nmgp_cmp_hidden['observacoes'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="observacoes" value="<?php echo $this->form_encode_input($observacoes) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_observacoes" style="<?php echo $sStyleHidden_observacoes; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_observacoes_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_observacoes_label" style=" padding: 0px; width: 100%;"><span id="id_label_observacoes"><?php echo $this->nm_new_label['observacoes']; ?></span></td></tr><tr><td class="css_observacoes_line" style="padding: 0px; width: 100%;"><?php
          if (!is_file($this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__anot_green.png"))
          { 
              $observacoes = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing) 
          { 
              $observacoes = "<span class=\"scFormErrorMessage scFormToastMessage\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>"; 
          } 
          else 
          { 
              $in_observacoes = $this->Ini->root  . $this->Ini->path_imag_cab . "/grp__NM__img__NM__anot_green.png"; 
              $img_time = filemtime($this->Ini->root . $this->Ini->path_imag_cab . "/grp__NM__img__NM__anot_green.png"); 
              $out_observacoes = str_replace("/", "_", $this->Ini->path_imag_cab); 
              $prt_observacoes = "sc_" . $out_observacoes . "_observacoes_4040_" . $img_time . "_grp__NM__img__NM__anot_green.png";
              $out_observacoes = $this->Ini->path_imag_temp . "/sc_" . $out_observacoes . "_observacoes_4040_" . $img_time . "_grp__NM__img__NM__anot_green.png";
              if (!is_file($this->Ini->root . $out_observacoes)) 
              {  
                  $sc_obj_img = new nm_trata_img($in_observacoes, true);
                  $sc_obj_img->setWidth(40);
                  $sc_obj_img->setHeight(40);
                  $sc_obj_img->setManterAspecto(true);
                  $sc_obj_img->createImg($this->Ini->root . $out_observacoes);
              } 
              if ($this->Ini->Export_img_zip) {
                  $this->Ini->Img_export_zip[] = $this->Ini->root . $out_observacoes;
                  $observacoes = "<img  border=\"0\" src=\"" . $prt_observacoes . "\"/>" ; 
              }
              else {
                  $observacoes = "<img  border=\"0\" src=\"" . $out_observacoes . "\"/>" ; 
              }
          } 
?>
<span id="id_imghtml_observacoes"><a href="javascript:nm_gp_submit('<?php echo $this->Ini->link_form_tbl_obs_confirmacao_edit . "', '$this->nm_location', 'vg_evento_id*scin" . $this->nmgp_dados_form['evento_id'] . "*scoutNM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinS*scout', '', '_self', '0', '0', 'form_tbl_obs_confirmacao')\"><font color=\"" . $this->Ini->cor_link_dados . "\">" . $observacoes ; ?></font></a></span>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["observacoes"]) &&  $this->nmgp_cmp_readonly["observacoes"] == "on") { 

 ?>
<input type="hidden" name="observacoes" value="<?php echo $this->form_encode_input($observacoes) . "\">" . $observacoes . ""; ?>
<?php } else { ?>
<span id="id_read_on_observacoes" class="sc-ui-readonly-observacoes css_observacoes_line" style="<?php echo $sStyleReadLab_observacoes; ?>"><?php echo $this->form_format_readonly("observacoes", $this->form_encode_input($this->observacoes)); ?></span><span id="id_read_off_observacoes" class="css_read_off_observacoes<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observacoes; ?>"></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_observacoes_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_observacoes_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['evento_id']))
           {
               $this->nmgp_cmp_readonly['evento_id'] = 'on';
           }
?>


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

    <TD class="scFormDataOdd" id="hidden_field_data_sql_log" style="<?php echo $sStyleHidden_sql_log; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_sql_log_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_sql_log_label" style=" padding: 0px; width: 100%;"><span id="id_label_sql_log"><?php echo $this->nm_new_label['sql_log']; ?></span></td></tr><tr><td class="css_sql_log_line" style="padding: 0px; width: 100%;"><input type="hidden" name="sql_log" value="<?php echo $this->form_encode_input($sql_log); ?>"><span id="id_ajax_label_sql_log"><?php echo nl2br($sql_log); ?></span>

<?php
$sql_log_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($sql_log));

?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sql_log_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sql_log_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_sql_log_dumb = ('' == $sStyleHidden_sql_log) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_sql_log_dumb" style="<?php echo $sStyleHidden_sql_log_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%; border-style: none;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock" style="background-color: #c7c7b9">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont" style="font-size: 14px"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf1\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;background-color: #c7c7b9; font-size: 14px; \" class=\"scFormBlockAlign\">"; } ?>EVENTOS - Informações Básicas<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_id']))
    {
        $this->nm_new_label['evento_id'] = "Cód. Evento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_id = $this->evento_id;
   $sStyleHidden_evento_id = '';
   if (isset($this->nmgp_cmp_hidden['evento_id']) && $this->nmgp_cmp_hidden['evento_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_id']);
       $sStyleHidden_evento_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_id = 'display: none;';
   $sStyleReadInp_evento_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["evento_id"]) &&  $this->nmgp_cmp_readonly["evento_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_id']);
       $sStyleReadLab_evento_id = '';
       $sStyleReadInp_evento_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_id']) && $this->nmgp_cmp_hidden['evento_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_id" value="<?php echo $this->form_encode_input($evento_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_id" style="<?php echo $sStyleHidden_evento_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_id"><?php echo $this->nm_new_label['evento_id']; ?></span></td></tr><tr><td class="css_evento_id_line" style="padding: 0px; width: 100%;"><span id="id_read_on_evento_id" class="css_evento_id_line" style="<?php echo $sStyleReadLab_evento_id; ?>"><?php echo $this->form_format_readonly("evento_id", $this->form_encode_input($this->evento_id)); ?></span><span id="id_read_off_evento_id" class="css_read_off_evento_id" style="<?php echo $sStyleReadInp_evento_id; ?>"><input type="hidden" name="evento_id" value="<?php echo $this->form_encode_input($evento_id) . "\">"?><span id="id_ajax_label_evento_id"><?php echo nl2br($evento_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }
      else
      {
         $sc_hidden_no--;
      }
?>
<?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['evento_id_complementar']))
           {
               $this->nmgp_cmp_readonly['evento_id_complementar'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['evento_id_interno']))
    {
        $this->nm_new_label['evento_id_interno'] = "Código Interno:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_id_interno = $this->evento_id_interno;
   if (!isset($this->nmgp_cmp_hidden['evento_id_interno']))
   {
       $this->nmgp_cmp_hidden['evento_id_interno'] = 'off';
   }
   $sStyleHidden_evento_id_interno = '';
   if (isset($this->nmgp_cmp_hidden['evento_id_interno']) && $this->nmgp_cmp_hidden['evento_id_interno'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_id_interno']);
       $sStyleHidden_evento_id_interno = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_id_interno = 'display: none;';
   $sStyleReadInp_evento_id_interno = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_id_interno']) && $this->nmgp_cmp_readonly['evento_id_interno'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_id_interno']);
       $sStyleReadLab_evento_id_interno = '';
       $sStyleReadInp_evento_id_interno = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_id_interno']) && $this->nmgp_cmp_hidden['evento_id_interno'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_id_interno" value="<?php echo $this->form_encode_input($evento_id_interno) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_id_interno" style="<?php echo $sStyleHidden_evento_id_interno; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_id_interno_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_id_interno_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_id_interno"><?php echo $this->nm_new_label['evento_id_interno']; ?></span></td></tr><tr><td class="css_evento_id_interno_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_id_interno"]) &&  $this->nmgp_cmp_readonly["evento_id_interno"] == "on") { 

 ?>
<input type="hidden" name="evento_id_interno" value="<?php echo $this->form_encode_input($evento_id_interno) . "\">" . $evento_id_interno . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_id_interno" class="sc-ui-readonly-evento_id_interno css_evento_id_interno_line" style="<?php echo $sStyleReadLab_evento_id_interno; ?>"><?php echo $this->form_format_readonly("evento_id_interno", $this->form_encode_input($this->evento_id_interno)); ?></span><span id="id_read_off_evento_id_interno" class="css_read_off_evento_id_interno<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_id_interno; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_id_interno_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_id_interno" type=text name="evento_id_interno" value="<?php echo $this->form_encode_input($evento_id_interno) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_id_interno_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_id_interno_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['evento_id_complementar']))
   {
       $this->nm_new_label['evento_id_complementar'] = "Código Complementar:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_id_complementar = $this->evento_id_complementar;
   if (!isset($this->nmgp_cmp_hidden['evento_id_complementar']))
   {
       $this->nmgp_cmp_hidden['evento_id_complementar'] = 'off';
   }
   $sStyleHidden_evento_id_complementar = '';
   if (isset($this->nmgp_cmp_hidden['evento_id_complementar']) && $this->nmgp_cmp_hidden['evento_id_complementar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_id_complementar']);
       $sStyleHidden_evento_id_complementar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_id_complementar = 'display: none;';
   $sStyleReadInp_evento_id_complementar = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["evento_id_complementar"]) &&  $this->nmgp_cmp_readonly["evento_id_complementar"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_id_complementar']);
       $sStyleReadLab_evento_id_complementar = '';
       $sStyleReadInp_evento_id_complementar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_id_complementar']) && $this->nmgp_cmp_hidden['evento_id_complementar'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="evento_id_complementar" value="<?php echo $this->form_encode_input($this->evento_id_complementar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_id_complementar" style="<?php echo $sStyleHidden_evento_id_complementar; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_id_complementar_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_id_complementar_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_id_complementar"><?php echo $this->nm_new_label['evento_id_complementar']; ?></span></td></tr><tr><td class="css_evento_id_complementar_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["evento_id_complementar"]) &&  $this->nmgp_cmp_readonly["evento_id_complementar"] == "on")) { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar'] = array(); 
    }

   $old_value_evento_id = $this->evento_id;
   $old_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $old_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $old_value_evento_cep = $this->evento_cep;
   $old_value_evento_telefone = $this->evento_telefone;
   $old_value_evento_celular = $this->evento_celular;
   $old_value_data_conclusao_app = $this->data_conclusao_app;
   $old_value_wz_suporte_app = $this->wz_suporte_app;
   $old_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $old_value_data_partida_destino_app = $this->data_partida_destino_app;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_evento_id = $this->evento_id;
   $unformatted_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $unformatted_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $unformatted_value_evento_cep = $this->evento_cep;
   $unformatted_value_evento_telefone = $this->evento_telefone;
   $unformatted_value_evento_celular = $this->evento_celular;
   $unformatted_value_data_conclusao_app = $this->data_conclusao_app;
   $unformatted_value_wz_suporte_app = $this->wz_suporte_app;
   $unformatted_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $unformatted_value_data_partida_destino_app = $this->data_partida_destino_app;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT evento_id, evento_id_interno + ' - ' + evento_nome  FROM eventos_rsvp  ORDER BY evento_id_interno, evento_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT evento_id, concat(evento_id_interno, ' - ',evento_nome)  FROM eventos_rsvp  ORDER BY evento_id_interno, evento_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT evento_id, evento_id_interno&' - '&evento_nome  FROM eventos_rsvp  ORDER BY evento_id_interno, evento_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT evento_id, evento_id_interno||' - '||evento_nome  FROM eventos_rsvp  ORDER BY evento_id_interno, evento_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT evento_id, evento_id_interno + ' - ' + evento_nome  FROM eventos_rsvp  ORDER BY evento_id_interno, evento_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT evento_id, evento_id_interno||' - '||evento_nome  FROM eventos_rsvp  ORDER BY evento_id_interno, evento_nome";
   }
   else
   {
       $nm_comando = "SELECT evento_id, evento_id_interno||' - '||evento_nome  FROM eventos_rsvp  ORDER BY evento_id_interno, evento_nome";
   }

   $this->evento_id = $old_value_evento_id;
   $this->evento_dt_realizacao = $old_value_evento_dt_realizacao;
   $this->evento_dt_conclusao = $old_value_evento_dt_conclusao;
   $this->evento_cep = $old_value_evento_cep;
   $this->evento_telefone = $old_value_evento_telefone;
   $this->evento_celular = $old_value_evento_celular;
   $this->data_conclusao_app = $old_value_data_conclusao_app;
   $this->wz_suporte_app = $old_value_wz_suporte_app;
   $this->data_chegada_destino_app = $old_value_data_chegada_destino_app;
   $this->data_partida_destino_app = $old_value_data_partida_destino_app;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar'][] = $rs->fields[0];
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
   $evento_id_complementar_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->evento_id_complementar_1))
          {
              foreach ($this->evento_id_complementar_1 as $tmp_evento_id_complementar)
              {
                  if (trim($tmp_evento_id_complementar) === trim($cadaselect[1])) {$evento_id_complementar_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->evento_id_complementar) && trim($this->evento_id_complementar) === trim($cadaselect[1])) {$evento_id_complementar_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="evento_id_complementar" value="<?php echo $this->form_encode_input($evento_id_complementar) . "\"><span id=\"id_ajax_label_evento_id_complementar\">" . $evento_id_complementar_look . "</span>"; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_evento_id_complementar();
   $x = 0 ; 
   $evento_id_complementar_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->evento_id_complementar_1))
          {
              foreach ($this->evento_id_complementar_1 as $tmp_evento_id_complementar)
              {
                  if (trim($tmp_evento_id_complementar) === trim($cadaselect[1])) {$evento_id_complementar_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->evento_id_complementar)) {
                 if (trim($this->evento_id_complementar) == trim($cadaselect[1])) { $evento_id_complementar_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->evento_id_complementar == $cadaselect[1]) { $evento_id_complementar_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($evento_id_complementar_look))
          {
              $evento_id_complementar_look = $this->evento_id_complementar;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_evento_id_complementar\" class=\"css_evento_id_complementar_line\" style=\"" .  $sStyleReadLab_evento_id_complementar . "\">" . $this->form_format_readonly("evento_id_complementar", $this->form_encode_input($evento_id_complementar_look)) . "</span><span id=\"id_read_off_evento_id_complementar\" class=\"css_read_off_evento_id_complementar" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_evento_id_complementar . "\">";
   echo " <span id=\"idAjaxSelect_evento_id_complementar\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_evento_id_complementar_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_evento_id_complementar\" name=\"evento_id_complementar\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_complementar'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->evento_id_complementar) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->evento_id_complementar)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_id_complementar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_id_complementar_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_nome']))
    {
        $this->nm_new_label['evento_nome'] = "Nome:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_nome = $this->evento_nome;
   $sStyleHidden_evento_nome = '';
   if (isset($this->nmgp_cmp_hidden['evento_nome']) && $this->nmgp_cmp_hidden['evento_nome'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_nome']);
       $sStyleHidden_evento_nome = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_nome = 'display: none;';
   $sStyleReadInp_evento_nome = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_nome']) && $this->nmgp_cmp_readonly['evento_nome'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_nome']);
       $sStyleReadLab_evento_nome = '';
       $sStyleReadInp_evento_nome = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_nome']) && $this->nmgp_cmp_hidden['evento_nome'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_nome" value="<?php echo $this->form_encode_input($evento_nome) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_nome" style="<?php echo $sStyleHidden_evento_nome; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_nome_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_nome_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_nome"><?php echo $this->nm_new_label['evento_nome']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['php_cmp_required']['evento_nome']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['php_cmp_required']['evento_nome'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_evento_nome_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_nome"]) &&  $this->nmgp_cmp_readonly["evento_nome"] == "on") { 

 ?>
<input type="hidden" name="evento_nome" value="<?php echo $this->form_encode_input($evento_nome) . "\">" . $evento_nome . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_nome" class="sc-ui-readonly-evento_nome css_evento_nome_line" style="<?php echo $sStyleReadLab_evento_nome; ?>"><?php echo $this->form_format_readonly("evento_nome", $this->form_encode_input($this->evento_nome)); ?></span><span id="id_read_off_evento_nome" class="css_read_off_evento_nome<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_nome; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_nome_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_nome" type=text name="evento_nome" value="<?php echo $this->form_encode_input($evento_nome) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_nome_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_nome_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_idioma']))
    {
        $this->nm_new_label['evento_idioma'] = "Idioma:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_idioma = $this->evento_idioma;
   $sStyleHidden_evento_idioma = '';
   if (isset($this->nmgp_cmp_hidden['evento_idioma']) && $this->nmgp_cmp_hidden['evento_idioma'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_idioma']);
       $sStyleHidden_evento_idioma = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_idioma = 'display: none;';
   $sStyleReadInp_evento_idioma = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_idioma']) && $this->nmgp_cmp_readonly['evento_idioma'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_idioma']);
       $sStyleReadLab_evento_idioma = '';
       $sStyleReadInp_evento_idioma = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_idioma']) && $this->nmgp_cmp_hidden['evento_idioma'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_idioma" value="<?php echo $this->form_encode_input($evento_idioma) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_idioma" style="<?php echo $sStyleHidden_evento_idioma; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_idioma_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_idioma_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_idioma"><?php echo $this->nm_new_label['evento_idioma']; ?></span></td></tr><tr><td class="css_evento_idioma_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_idioma"]) &&  $this->nmgp_cmp_readonly["evento_idioma"] == "on") { 

 if ("PORTUGUES" == $this->evento_idioma) { $evento_idioma_look = "Português";} 
 if ("INGLES" == $this->evento_idioma) { $evento_idioma_look = "Inglês";} 
 if ("ESPANHOL" == $this->evento_idioma) { $evento_idioma_look = "Espanhol";} 
 if ("FRANCES" == $this->evento_idioma) { $evento_idioma_look = "Francês";} 
 if ("ALEMAO" == $this->evento_idioma) { $evento_idioma_look = "Alemão";} 
 if ("VARIOS" == $this->evento_idioma) { $evento_idioma_look = "Vários";} 
?>
<input type="hidden" name="evento_idioma" value="<?php echo $this->form_encode_input($evento_idioma) . "\">" . $evento_idioma_look . ""; ?>
<?php } else { ?>

<?php

 if ("PORTUGUES" == $this->evento_idioma) { $evento_idioma_look = "Português";} 
 if ("INGLES" == $this->evento_idioma) { $evento_idioma_look = "Inglês";} 
 if ("ESPANHOL" == $this->evento_idioma) { $evento_idioma_look = "Espanhol";} 
 if ("FRANCES" == $this->evento_idioma) { $evento_idioma_look = "Francês";} 
 if ("ALEMAO" == $this->evento_idioma) { $evento_idioma_look = "Alemão";} 
 if ("VARIOS" == $this->evento_idioma) { $evento_idioma_look = "Vários";} 
?>
<span id="id_read_on_evento_idioma"  class="css_evento_idioma_line" style="<?php echo $sStyleReadLab_evento_idioma; ?>"><?php echo $this->form_format_readonly("evento_idioma", $this->form_encode_input($evento_idioma_look)); ?></span><span id="id_read_off_evento_idioma" class="css_read_off_evento_idioma css_evento_idioma_line" style="<?php echo $sStyleReadInp_evento_idioma; ?>"><div id="idAjaxRadio_evento_idioma" style="display: inline-block"  class="css_evento_idioma_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_evento_idioma_line"><?php $tempOptionId = "id-opt-evento_idioma" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_idioma sc-ui-radio-evento_idioma" type=radio name="evento_idioma" value="PORTUGUES"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_idioma'][] = 'PORTUGUES'; ?>
<?php  if ("PORTUGUES" == $this->evento_idioma)  { echo " checked" ;} ?><?php  if (empty($this->evento_idioma)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Português</label></TD>
  <TD class="scFormDataFontOdd css_evento_idioma_line"><?php $tempOptionId = "id-opt-evento_idioma" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_idioma sc-ui-radio-evento_idioma" type=radio name="evento_idioma" value="INGLES"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_idioma'][] = 'INGLES'; ?>
<?php  if ("INGLES" == $this->evento_idioma)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Inglês</label></TD>
  <TD class="scFormDataFontOdd css_evento_idioma_line"><?php $tempOptionId = "id-opt-evento_idioma" . $sc_seq_vert . "-3"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_idioma sc-ui-radio-evento_idioma" type=radio name="evento_idioma" value="ESPANHOL"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_idioma'][] = 'ESPANHOL'; ?>
<?php  if ("ESPANHOL" == $this->evento_idioma)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Espanhol</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_evento_idioma_line"><?php $tempOptionId = "id-opt-evento_idioma" . $sc_seq_vert . "-4"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_idioma sc-ui-radio-evento_idioma" type=radio name="evento_idioma" value="FRANCES"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_idioma'][] = 'FRANCES'; ?>
<?php  if ("FRANCES" == $this->evento_idioma)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Francês</label></TD>
  <TD class="scFormDataFontOdd css_evento_idioma_line"><?php $tempOptionId = "id-opt-evento_idioma" . $sc_seq_vert . "-5"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_idioma sc-ui-radio-evento_idioma" type=radio name="evento_idioma" value="ALEMAO"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_idioma'][] = 'ALEMAO'; ?>
<?php  if ("ALEMAO" == $this->evento_idioma)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Alemão</label></TD>
  <TD class="scFormDataFontOdd css_evento_idioma_line"><?php $tempOptionId = "id-opt-evento_idioma" . $sc_seq_vert . "-6"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_idioma sc-ui-radio-evento_idioma" type=radio name="evento_idioma" value="VARIOS"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_idioma'][] = 'VARIOS'; ?>
<?php  if ("VARIOS" == $this->evento_idioma)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Vários</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_idioma_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_idioma_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_dt_realizacao']))
    {
        $this->nm_new_label['evento_dt_realizacao'] = "Data da Realização:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_dt_realizacao = $this->evento_dt_realizacao;
   $sStyleHidden_evento_dt_realizacao = '';
   if (isset($this->nmgp_cmp_hidden['evento_dt_realizacao']) && $this->nmgp_cmp_hidden['evento_dt_realizacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_dt_realizacao']);
       $sStyleHidden_evento_dt_realizacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_dt_realizacao = 'display: none;';
   $sStyleReadInp_evento_dt_realizacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_dt_realizacao']) && $this->nmgp_cmp_readonly['evento_dt_realizacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_dt_realizacao']);
       $sStyleReadLab_evento_dt_realizacao = '';
       $sStyleReadInp_evento_dt_realizacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_dt_realizacao']) && $this->nmgp_cmp_hidden['evento_dt_realizacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_dt_realizacao" value="<?php echo $this->form_encode_input($evento_dt_realizacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_dt_realizacao" style="<?php echo $sStyleHidden_evento_dt_realizacao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_dt_realizacao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_dt_realizacao_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_dt_realizacao"><?php echo $this->nm_new_label['evento_dt_realizacao']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['php_cmp_required']['evento_dt_realizacao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['php_cmp_required']['evento_dt_realizacao'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_evento_dt_realizacao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_dt_realizacao"]) &&  $this->nmgp_cmp_readonly["evento_dt_realizacao"] == "on") { 

 ?>
<input type="hidden" name="evento_dt_realizacao" value="<?php echo $this->form_encode_input($evento_dt_realizacao) . "\">" . $evento_dt_realizacao . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_dt_realizacao" class="sc-ui-readonly-evento_dt_realizacao css_evento_dt_realizacao_line" style="<?php echo $sStyleReadLab_evento_dt_realizacao; ?>"><?php echo $this->form_format_readonly("evento_dt_realizacao", $this->form_encode_input($evento_dt_realizacao)); ?></span><span id="id_read_off_evento_dt_realizacao" class="css_read_off_evento_dt_realizacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_dt_realizacao; ?>"><?php
$tmp_form_data = $this->field_config['evento_dt_realizacao']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_evento_dt_realizacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_dt_realizacao" type=text name="evento_dt_realizacao" value="<?php echo $this->form_encode_input($evento_dt_realizacao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['evento_dt_realizacao']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['evento_dt_realizacao']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_dt_realizacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_dt_realizacao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_dt_conclusao']))
    {
        $this->nm_new_label['evento_dt_conclusao'] = "Data da Conclusão:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_dt_conclusao = $this->evento_dt_conclusao;
   $sStyleHidden_evento_dt_conclusao = '';
   if (isset($this->nmgp_cmp_hidden['evento_dt_conclusao']) && $this->nmgp_cmp_hidden['evento_dt_conclusao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_dt_conclusao']);
       $sStyleHidden_evento_dt_conclusao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_dt_conclusao = 'display: none;';
   $sStyleReadInp_evento_dt_conclusao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_dt_conclusao']) && $this->nmgp_cmp_readonly['evento_dt_conclusao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_dt_conclusao']);
       $sStyleReadLab_evento_dt_conclusao = '';
       $sStyleReadInp_evento_dt_conclusao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_dt_conclusao']) && $this->nmgp_cmp_hidden['evento_dt_conclusao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_dt_conclusao" value="<?php echo $this->form_encode_input($evento_dt_conclusao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_dt_conclusao" style="<?php echo $sStyleHidden_evento_dt_conclusao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_dt_conclusao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_dt_conclusao_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_dt_conclusao"><?php echo $this->nm_new_label['evento_dt_conclusao']; ?></span></td></tr><tr><td class="css_evento_dt_conclusao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_dt_conclusao"]) &&  $this->nmgp_cmp_readonly["evento_dt_conclusao"] == "on") { 

 ?>
<input type="hidden" name="evento_dt_conclusao" value="<?php echo $this->form_encode_input($evento_dt_conclusao) . "\">" . $evento_dt_conclusao . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_dt_conclusao" class="sc-ui-readonly-evento_dt_conclusao css_evento_dt_conclusao_line" style="<?php echo $sStyleReadLab_evento_dt_conclusao; ?>"><?php echo $this->form_format_readonly("evento_dt_conclusao", $this->form_encode_input($evento_dt_conclusao)); ?></span><span id="id_read_off_evento_dt_conclusao" class="css_read_off_evento_dt_conclusao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_dt_conclusao; ?>"><?php
$tmp_form_data = $this->field_config['evento_dt_conclusao']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_evento_dt_conclusao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_dt_conclusao" type=text name="evento_dt_conclusao" value="<?php echo $this->form_encode_input($evento_dt_conclusao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['evento_dt_conclusao']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['evento_dt_conclusao']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_dt_conclusao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_dt_conclusao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_status']))
    {
        $this->nm_new_label['evento_status'] = "Status:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_status = $this->evento_status;
   $sStyleHidden_evento_status = '';
   if (isset($this->nmgp_cmp_hidden['evento_status']) && $this->nmgp_cmp_hidden['evento_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_status']);
       $sStyleHidden_evento_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_status = 'display: none;';
   $sStyleReadInp_evento_status = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_status']) && $this->nmgp_cmp_readonly['evento_status'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_status']);
       $sStyleReadLab_evento_status = '';
       $sStyleReadInp_evento_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_status']) && $this->nmgp_cmp_hidden['evento_status'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_status" value="<?php echo $this->form_encode_input($evento_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_status" style="<?php echo $sStyleHidden_evento_status; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_status_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_status_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_status"><?php echo $this->nm_new_label['evento_status']; ?></span></td></tr><tr><td class="css_evento_status_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_status"]) &&  $this->nmgp_cmp_readonly["evento_status"] == "on") { 

 if ("ATIVO" == $this->evento_status) { $evento_status_look = "Ativo";} 
 if ("CONCLUIDO" == $this->evento_status) { $evento_status_look = "Concluído";} 
 if ("ENCERRADO" == $this->evento_status) { $evento_status_look = "Encerrado";} 
 if ("SUSPENSO" == $this->evento_status) { $evento_status_look = "Suspenso";} 
?>
<input type="hidden" name="evento_status" value="<?php echo $this->form_encode_input($evento_status) . "\">" . $evento_status_look . ""; ?>
<?php } else { ?>

<?php

 if ("ATIVO" == $this->evento_status) { $evento_status_look = "Ativo";} 
 if ("CONCLUIDO" == $this->evento_status) { $evento_status_look = "Concluído";} 
 if ("ENCERRADO" == $this->evento_status) { $evento_status_look = "Encerrado";} 
 if ("SUSPENSO" == $this->evento_status) { $evento_status_look = "Suspenso";} 
?>
<span id="id_read_on_evento_status"  class="css_evento_status_line" style="<?php echo $sStyleReadLab_evento_status; ?>"><?php echo $this->form_format_readonly("evento_status", $this->form_encode_input($evento_status_look)); ?></span><span id="id_read_off_evento_status" class="css_read_off_evento_status css_evento_status_line" style="<?php echo $sStyleReadInp_evento_status; ?>"><div id="idAjaxRadio_evento_status" style="display: inline-block"  class="css_evento_status_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_evento_status_line"><?php $tempOptionId = "id-opt-evento_status" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_status sc-ui-radio-evento_status" type=radio name="evento_status" value="ATIVO"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_status'][] = 'ATIVO'; ?>
<?php  if ("ATIVO" == $this->evento_status)  { echo " checked" ;} ?><?php  if (empty($this->evento_status)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Ativo</label></TD>
  <TD class="scFormDataFontOdd css_evento_status_line"><?php $tempOptionId = "id-opt-evento_status" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_status sc-ui-radio-evento_status" type=radio name="evento_status" value="CONCLUIDO"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_status'][] = 'CONCLUIDO'; ?>
<?php  if ("CONCLUIDO" == $this->evento_status)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Concluído</label></TD>
  <TD class="scFormDataFontOdd css_evento_status_line"><?php $tempOptionId = "id-opt-evento_status" . $sc_seq_vert . "-3"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_status sc-ui-radio-evento_status" type=radio name="evento_status" value="ENCERRADO"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_status'][] = 'ENCERRADO'; ?>
<?php  if ("ENCERRADO" == $this->evento_status)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Encerrado</label></TD>
  <TD class="scFormDataFontOdd css_evento_status_line"><?php $tempOptionId = "id-opt-evento_status" . $sc_seq_vert . "-4"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-evento_status sc-ui-radio-evento_status" type=radio name="evento_status" value="SUSPENSO"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_status'][] = 'SUSPENSO'; ?>
<?php  if ("SUSPENSO" == $this->evento_status)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Suspenso</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_status_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_logo']))
    {
        $this->nm_new_label['evento_logo'] = " Logo do Evento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_logo = $this->evento_logo;
   $sStyleHidden_evento_logo = '';
   if (isset($this->nmgp_cmp_hidden['evento_logo']) && $this->nmgp_cmp_hidden['evento_logo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_logo']);
       $sStyleHidden_evento_logo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_logo = 'display: none;';
   $sStyleReadInp_evento_logo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_logo']) && $this->nmgp_cmp_readonly['evento_logo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_logo']);
       $sStyleReadLab_evento_logo = '';
       $sStyleReadInp_evento_logo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_logo']) && $this->nmgp_cmp_hidden['evento_logo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_logo" value="<?php echo $this->form_encode_input($evento_logo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_logo" style="<?php echo $sStyleHidden_evento_logo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_logo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_logo_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_logo"><?php echo $this->nm_new_label['evento_logo']; ?></span></td></tr><tr><td class="css_evento_logo_line" style="padding: 0px; width: 100%;">
 <?php $this->NM_ajax_info['varList'][] = array("var_ajax_img_evento_logo" => $out1_evento_logo); ?><script>var var_ajax_img_evento_logo = '<?php echo $out1_evento_logo; ?>';</script><input type="hidden" name="temp_out_evento_logo" value="<?php echo $this->form_encode_input($out_evento_logo); ?>" /><input type="hidden" name="temp_out1_evento_logo" value="<?php echo $this->form_encode_input($out1_evento_logo); ?>" /><?php if (!empty($out_evento_logo)) {  echo "<a  href=\"javascript:nm_mostra_img(var_ajax_img_evento_logo, '" . $this->nmgp_return_img['evento_logo'][0] . "', '" . $this->nmgp_return_img['evento_logo'][1] . "')\"><img id=\"id_ajax_img_evento_logo\"  border=\"0\" src=\"$out_evento_logo\"></a>"; } else {  echo "<img id=\"id_ajax_img_evento_logo\" border=\"0\" style=\"display: none\">"; } ?><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_logo"]) &&  $this->nmgp_cmp_readonly["evento_logo"] == "on") { 

 ?>
<img id=\"evento_logo_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><input type="hidden" name="evento_logo" value="<?php echo $this->form_encode_input($evento_logo) . "\">" . $evento_logo . ""; ?>
<?php } else { ?>
<span id="id_read_off_evento_logo" class="css_read_off_evento_logo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_logo; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-evento_logo" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_evento_logo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="evento_logo[]" id="id_sc_field_evento_logo" onchange="<?php if ($this->nmgp_opcao == "novo") {echo "if (document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]']) { document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]'].checked = true }"; }?>"></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_evento_logo"<?php if ($this->nmgp_opcao == "novo" || empty($evento_logo)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="evento_logo_limpa" value="<?php echo $evento_logo_limpa . '" '; if ($evento_logo_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="evento_logo_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><div id="id_img_loader_evento_logo" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_evento_logo" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_logo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_logo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_website']))
    {
        $this->nm_new_label['evento_website'] = "Website:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_website = $this->evento_website;
   $sStyleHidden_evento_website = '';
   if (isset($this->nmgp_cmp_hidden['evento_website']) && $this->nmgp_cmp_hidden['evento_website'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_website']);
       $sStyleHidden_evento_website = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_website = 'display: none;';
   $sStyleReadInp_evento_website = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_website']) && $this->nmgp_cmp_readonly['evento_website'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_website']);
       $sStyleReadLab_evento_website = '';
       $sStyleReadInp_evento_website = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_website']) && $this->nmgp_cmp_hidden['evento_website'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_website" value="<?php echo $this->form_encode_input($evento_website) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_website" style="<?php echo $sStyleHidden_evento_website; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_website_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_website_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_website"><?php echo $this->nm_new_label['evento_website']; ?></span></td></tr><tr><td class="css_evento_website_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_website"]) &&  $this->nmgp_cmp_readonly["evento_website"] == "on") { 

 ?>
<input type="hidden" name="evento_website" value="<?php echo $this->form_encode_input($evento_website) . "\">" . $evento_website . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_website" class="sc-ui-readonly-evento_website css_evento_website_line" style="<?php echo $sStyleReadLab_evento_website; ?>"><?php echo $this->form_format_readonly("evento_website", $this->form_encode_input($this->evento_website)); ?></span><span id="id_read_off_evento_website" class="css_read_off_evento_website<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_website; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_website_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_website" type=text name="evento_website" value="<?php echo $this->form_encode_input($evento_website) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "blink", "window.open(nm_link_url(document.F1.evento_website.value), '')", "window.open(nm_link_url(document.F1.evento_website.value), '')", "evento_website_url", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_website_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_website_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cover_image']))
    {
        $this->nm_new_label['cover_image'] = "Logo do Cliente";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cover_image = $this->cover_image;
   $sStyleHidden_cover_image = '';
   if (isset($this->nmgp_cmp_hidden['cover_image']) && $this->nmgp_cmp_hidden['cover_image'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cover_image']);
       $sStyleHidden_cover_image = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cover_image = 'display: none;';
   $sStyleReadInp_cover_image = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cover_image']) && $this->nmgp_cmp_readonly['cover_image'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cover_image']);
       $sStyleReadLab_cover_image = '';
       $sStyleReadInp_cover_image = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cover_image']) && $this->nmgp_cmp_hidden['cover_image'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cover_image" value="<?php echo $this->form_encode_input($cover_image) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cover_image" style="<?php echo $sStyleHidden_cover_image; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cover_image_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cover_image_label" style=" padding: 0px; width: 100%;"><span id="id_label_cover_image"><?php echo $this->nm_new_label['cover_image']; ?></span></td></tr><tr><td class="css_cover_image_line" style="padding: 0px; width: 100%;">
 <?php $this->NM_ajax_info['varList'][] = array("var_ajax_img_cover_image" => $out1_cover_image); ?><script>var var_ajax_img_cover_image = '<?php echo $out1_cover_image; ?>';</script><input type="hidden" name="temp_out_cover_image" value="<?php echo $this->form_encode_input($out_cover_image); ?>" /><input type="hidden" name="temp_out1_cover_image" value="<?php echo $this->form_encode_input($out1_cover_image); ?>" /><?php if (!empty($out_cover_image)) {  echo "<a  href=\"javascript:nm_mostra_img(var_ajax_img_cover_image, '" . $this->nmgp_return_img['cover_image'][0] . "', '" . $this->nmgp_return_img['cover_image'][1] . "')\"><img id=\"id_ajax_img_cover_image\"  border=\"0\" src=\"$out_cover_image\"></a>"; } else {  echo "<img id=\"id_ajax_img_cover_image\" border=\"0\" style=\"display: none\">"; } ?><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cover_image"]) &&  $this->nmgp_cmp_readonly["cover_image"] == "on") { 

 ?>
<img id=\"cover_image_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><input type="hidden" name="cover_image" value="<?php echo $this->form_encode_input($cover_image) . "\">" . $cover_image . ""; ?>
<?php } else { ?>
<span id="id_read_off_cover_image" class="css_read_off_cover_image<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cover_image; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-cover_image" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_cover_image_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="cover_image[]" id="id_sc_field_cover_image" onchange="<?php if ($this->nmgp_opcao == "novo") {echo "if (document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]']) { document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]'].checked = true }"; }?>"></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_cover_image"<?php if ($this->nmgp_opcao == "novo" || empty($cover_image)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="cover_image_limpa" value="<?php echo $cover_image_limpa . '" '; if ($cover_image_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="cover_image_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><div id="id_img_loader_cover_image" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_cover_image" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cover_image_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cover_image_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_email']))
    {
        $this->nm_new_label['evento_email'] = "E-Mail:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_email = $this->evento_email;
   $sStyleHidden_evento_email = '';
   if (isset($this->nmgp_cmp_hidden['evento_email']) && $this->nmgp_cmp_hidden['evento_email'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_email']);
       $sStyleHidden_evento_email = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_email = 'display: none;';
   $sStyleReadInp_evento_email = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_email']) && $this->nmgp_cmp_readonly['evento_email'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_email']);
       $sStyleReadLab_evento_email = '';
       $sStyleReadInp_evento_email = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_email']) && $this->nmgp_cmp_hidden['evento_email'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_email" value="<?php echo $this->form_encode_input($evento_email) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_email" style="<?php echo $sStyleHidden_evento_email; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_email_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_email_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_email"><?php echo $this->nm_new_label['evento_email']; ?></span></td></tr><tr><td class="css_evento_email_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_email"]) &&  $this->nmgp_cmp_readonly["evento_email"] == "on") { 

 ?>
<input type="hidden" name="evento_email" value="<?php echo $this->form_encode_input($evento_email) . "\">" . $evento_email . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_email" class="sc-ui-readonly-evento_email css_evento_email_line" style="<?php echo $sStyleReadLab_evento_email; ?>"><?php echo $this->form_format_readonly("evento_email", $this->form_encode_input($this->evento_email)); ?></span><span id="id_read_off_evento_email" class="css_read_off_evento_email<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_email; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_email_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_email" type=text name="evento_email" value="<?php echo $this->form_encode_input($evento_email) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.evento_email.value != '') {window.open('mailto:' + document.F1.evento_email.value); }", "if (document.F1.evento_email.value != '') {window.open('mailto:' + document.F1.evento_email.value); }", "evento_email_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_email_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_email_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_tipo']))
    {
        $this->nm_new_label['evento_tipo'] = "Tipo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_tipo = $this->evento_tipo;
   if (!isset($this->nmgp_cmp_hidden['evento_tipo']))
   {
       $this->nmgp_cmp_hidden['evento_tipo'] = 'off';
   }
   $sStyleHidden_evento_tipo = '';
   if (isset($this->nmgp_cmp_hidden['evento_tipo']) && $this->nmgp_cmp_hidden['evento_tipo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_tipo']);
       $sStyleHidden_evento_tipo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_tipo = 'display: none;';
   $sStyleReadInp_evento_tipo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_tipo']) && $this->nmgp_cmp_readonly['evento_tipo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_tipo']);
       $sStyleReadLab_evento_tipo = '';
       $sStyleReadInp_evento_tipo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_tipo']) && $this->nmgp_cmp_hidden['evento_tipo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_tipo" value="<?php echo $this->form_encode_input($evento_tipo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_tipo" style="<?php echo $sStyleHidden_evento_tipo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_tipo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_tipo_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_tipo"><?php echo $this->nm_new_label['evento_tipo']; ?></span></td></tr><tr><td class="css_evento_tipo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_tipo"]) &&  $this->nmgp_cmp_readonly["evento_tipo"] == "on") { 

 ?>
<input type="hidden" name="evento_tipo" value="<?php echo $this->form_encode_input($evento_tipo) . "\">" . $evento_tipo . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_tipo" class="sc-ui-readonly-evento_tipo css_evento_tipo_line" style="<?php echo $sStyleReadLab_evento_tipo; ?>"><?php echo $this->form_format_readonly("evento_tipo", $this->form_encode_input($this->evento_tipo)); ?></span><span id="id_read_off_evento_tipo" class="css_read_off_evento_tipo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_tipo; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_tipo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_tipo" type=text name="evento_tipo" value="<?php echo $this->form_encode_input($evento_tipo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_tipo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_tipo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




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

    <TD class="scFormDataOdd" id="hidden_field_data_enviar_app" style="<?php echo $sStyleHidden_enviar_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_enviar_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_enviar_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_enviar_app"><?php echo $this->nm_new_label['enviar_app']; ?></span></td></tr><tr><td class="css_enviar_app_line" style="padding: 0px; width: 100%;">
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
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enviar_app sc-ui-radio-enviar_app" type=radio name="enviar_app" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_enviar_app'][] = 'Y'; ?>
<?php  if ("Y" == $this->enviar_app)  { echo " checked" ;} ?><?php  if (empty($this->enviar_app)) { echo " checked" ;} ?>  onClick="do_ajax_form_eventos_rsvp_mob_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_enviar_app_line"><?php $tempOptionId = "id-opt-enviar_app" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enviar_app sc-ui-radio-enviar_app" type=radio name="enviar_app" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_enviar_app'][] = 'N'; ?>
<?php  if ("N" == $this->enviar_app)  { echo " checked" ;} ?>  onClick="do_ajax_form_eventos_rsvp_mob_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_enviar_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_enviar_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_enviar_app_dumb = ('' == $sStyleHidden_enviar_app) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_enviar_app_dumb" style="<?php echo $sStyleHidden_enviar_app_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_2"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_2" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%; border-style: none;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock" style="background-color: #c7c7b9">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont" style="font-size: 14px"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf2\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;background-color: #c7c7b9; font-size: 14px; \" class=\"scFormBlockAlign\">"; } ?>EVENTOS - Endereço / Observações<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_cep']))
    {
        $this->nm_new_label['evento_cep'] = "CEP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_cep = $this->evento_cep;
   $sStyleHidden_evento_cep = '';
   if (isset($this->nmgp_cmp_hidden['evento_cep']) && $this->nmgp_cmp_hidden['evento_cep'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_cep']);
       $sStyleHidden_evento_cep = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_cep = 'display: none;';
   $sStyleReadInp_evento_cep = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_cep']) && $this->nmgp_cmp_readonly['evento_cep'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_cep']);
       $sStyleReadLab_evento_cep = '';
       $sStyleReadInp_evento_cep = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_cep']) && $this->nmgp_cmp_hidden['evento_cep'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_cep" value="<?php echo $this->form_encode_input($evento_cep) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_cep" style="<?php echo $sStyleHidden_evento_cep; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_cep_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_cep_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_cep"><?php echo $this->nm_new_label['evento_cep']; ?></span></td></tr><tr><td class="css_evento_cep_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_cep"]) &&  $this->nmgp_cmp_readonly["evento_cep"] == "on") { 

 ?>
<input type="hidden" name="evento_cep" value="<?php echo $this->form_encode_input($evento_cep) . "\">" . $evento_cep . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_cep" class="sc-ui-readonly-evento_cep css_evento_cep_line" style="<?php echo $sStyleReadLab_evento_cep; ?>"><?php echo $this->form_format_readonly("evento_cep", $this->form_encode_input($this->evento_cep)); ?></span><span id="id_read_off_evento_cep" class="css_read_off_evento_cep<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_cep; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_cep_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_cep" type=text name="evento_cep" value="<?php echo $this->form_encode_input($evento_cep) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'cep', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "bzipcode", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_eventos_rsvp'). "/form_eventos_rsvp_mob_cep.php?cep=&form_origem=F1;CEP,evento_cep;UF,evento_uf;CIDADE,evento_municipio;BAIRRO,evento_bairro;RUA,evento_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_eventos_rsvp'). "/form_eventos_rsvp_mob_cep.php?cep=&form_origem=F1;CEP,evento_cep;UF,evento_uf;CIDADE,evento_municipio;BAIRRO,evento_bairro;RUA,evento_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "evento_cep_cep", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_cep_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_cep_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['evento_pais']))
   {
       $this->nm_new_label['evento_pais'] = "País:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_pais = $this->evento_pais;
   $sStyleHidden_evento_pais = '';
   if (isset($this->nmgp_cmp_hidden['evento_pais']) && $this->nmgp_cmp_hidden['evento_pais'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_pais']);
       $sStyleHidden_evento_pais = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_pais = 'display: none;';
   $sStyleReadInp_evento_pais = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_pais']) && $this->nmgp_cmp_readonly['evento_pais'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_pais']);
       $sStyleReadLab_evento_pais = '';
       $sStyleReadInp_evento_pais = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_pais']) && $this->nmgp_cmp_hidden['evento_pais'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="evento_pais" value="<?php echo $this->form_encode_input($this->evento_pais) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_pais" style="<?php echo $sStyleHidden_evento_pais; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_pais_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_pais_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_pais"><?php echo $this->nm_new_label['evento_pais']; ?></span></td></tr><tr><td class="css_evento_pais_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_pais"]) &&  $this->nmgp_cmp_readonly["evento_pais"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais'] = array(); 
    }

   $old_value_evento_id = $this->evento_id;
   $old_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $old_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $old_value_evento_cep = $this->evento_cep;
   $old_value_evento_telefone = $this->evento_telefone;
   $old_value_evento_celular = $this->evento_celular;
   $old_value_data_conclusao_app = $this->data_conclusao_app;
   $old_value_wz_suporte_app = $this->wz_suporte_app;
   $old_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $old_value_data_partida_destino_app = $this->data_partida_destino_app;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_evento_id = $this->evento_id;
   $unformatted_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $unformatted_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $unformatted_value_evento_cep = $this->evento_cep;
   $unformatted_value_evento_telefone = $this->evento_telefone;
   $unformatted_value_evento_celular = $this->evento_celular;
   $unformatted_value_data_conclusao_app = $this->data_conclusao_app;
   $unformatted_value_wz_suporte_app = $this->wz_suporte_app;
   $unformatted_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $unformatted_value_data_partida_destino_app = $this->data_partida_destino_app;

   $nm_comando = "SELECT pais_id, descricao  FROM tbl_paises  ORDER BY descricao";

   $this->evento_id = $old_value_evento_id;
   $this->evento_dt_realizacao = $old_value_evento_dt_realizacao;
   $this->evento_dt_conclusao = $old_value_evento_dt_conclusao;
   $this->evento_cep = $old_value_evento_cep;
   $this->evento_telefone = $old_value_evento_telefone;
   $this->evento_celular = $old_value_evento_celular;
   $this->data_conclusao_app = $old_value_data_conclusao_app;
   $this->wz_suporte_app = $old_value_wz_suporte_app;
   $this->data_chegada_destino_app = $old_value_data_chegada_destino_app;
   $this->data_partida_destino_app = $old_value_data_partida_destino_app;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais'][] = $rs->fields[0];
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
   $evento_pais_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->evento_pais_1))
          {
              foreach ($this->evento_pais_1 as $tmp_evento_pais)
              {
                  if (trim($tmp_evento_pais) === trim($cadaselect[1])) {$evento_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->evento_pais) && trim($this->evento_pais) === trim($cadaselect[1])) {$evento_pais_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="evento_pais" value="<?php echo $this->form_encode_input($evento_pais) . "\">" . $evento_pais_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_evento_pais();
   $x = 0 ; 
   $evento_pais_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->evento_pais_1))
          {
              foreach ($this->evento_pais_1 as $tmp_evento_pais)
              {
                  if (trim($tmp_evento_pais) === trim($cadaselect[1])) {$evento_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->evento_pais)) {
                 if (trim($this->evento_pais) == trim($cadaselect[1])) { $evento_pais_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->evento_pais == $cadaselect[1]) { $evento_pais_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($evento_pais_look))
          {
              $evento_pais_look = $this->evento_pais;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_evento_pais\" class=\"css_evento_pais_line\" style=\"" .  $sStyleReadLab_evento_pais . "\">" . $this->form_format_readonly("evento_pais", $this->form_encode_input($evento_pais_look)) . "</span><span id=\"id_read_off_evento_pais\" class=\"css_read_off_evento_pais" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_evento_pais . "\">";
   echo " <span id=\"idAjaxSelect_evento_pais\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_evento_pais_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_evento_pais\" name=\"evento_pais\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_pais'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->evento_pais) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->evento_pais)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_pais_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_pais_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_uf']))
    {
        $this->nm_new_label['evento_uf'] = "UF:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_uf = $this->evento_uf;
   $sStyleHidden_evento_uf = '';
   if (isset($this->nmgp_cmp_hidden['evento_uf']) && $this->nmgp_cmp_hidden['evento_uf'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_uf']);
       $sStyleHidden_evento_uf = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_uf = 'display: none;';
   $sStyleReadInp_evento_uf = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_uf']) && $this->nmgp_cmp_readonly['evento_uf'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_uf']);
       $sStyleReadLab_evento_uf = '';
       $sStyleReadInp_evento_uf = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_uf']) && $this->nmgp_cmp_hidden['evento_uf'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_uf" value="<?php echo $this->form_encode_input($evento_uf) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_uf" style="<?php echo $sStyleHidden_evento_uf; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_uf_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_uf_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_uf"><?php echo $this->nm_new_label['evento_uf']; ?></span></td></tr><tr><td class="css_evento_uf_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_uf"]) &&  $this->nmgp_cmp_readonly["evento_uf"] == "on") { 

 ?>
<input type="hidden" name="evento_uf" value="<?php echo $this->form_encode_input($evento_uf) . "\">" . $evento_uf . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_uf" class="sc-ui-readonly-evento_uf css_evento_uf_line" style="<?php echo $sStyleReadLab_evento_uf; ?>"><?php echo $this->form_format_readonly("evento_uf", $this->form_encode_input($this->evento_uf)); ?></span><span id="id_read_off_evento_uf" class="css_read_off_evento_uf<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_uf; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_uf_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_uf" type=text name="evento_uf" value="<?php echo $this->form_encode_input($evento_uf) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_uf_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_uf_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_municipio']))
    {
        $this->nm_new_label['evento_municipio'] = "Município:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_municipio = $this->evento_municipio;
   $sStyleHidden_evento_municipio = '';
   if (isset($this->nmgp_cmp_hidden['evento_municipio']) && $this->nmgp_cmp_hidden['evento_municipio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_municipio']);
       $sStyleHidden_evento_municipio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_municipio = 'display: none;';
   $sStyleReadInp_evento_municipio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_municipio']) && $this->nmgp_cmp_readonly['evento_municipio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_municipio']);
       $sStyleReadLab_evento_municipio = '';
       $sStyleReadInp_evento_municipio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_municipio']) && $this->nmgp_cmp_hidden['evento_municipio'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_municipio" value="<?php echo $this->form_encode_input($evento_municipio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_municipio" style="<?php echo $sStyleHidden_evento_municipio; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_municipio_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_municipio_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_municipio"><?php echo $this->nm_new_label['evento_municipio']; ?></span></td></tr><tr><td class="css_evento_municipio_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_municipio"]) &&  $this->nmgp_cmp_readonly["evento_municipio"] == "on") { 

 ?>
<input type="hidden" name="evento_municipio" value="<?php echo $this->form_encode_input($evento_municipio) . "\">" . $evento_municipio . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_municipio" class="sc-ui-readonly-evento_municipio css_evento_municipio_line" style="<?php echo $sStyleReadLab_evento_municipio; ?>"><?php echo $this->form_format_readonly("evento_municipio", $this->form_encode_input($this->evento_municipio)); ?></span><span id="id_read_off_evento_municipio" class="css_read_off_evento_municipio<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_municipio; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_municipio_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_municipio" type=text name="evento_municipio" value="<?php echo $this->form_encode_input($evento_municipio) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_municipio_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_municipio_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_bairro']))
    {
        $this->nm_new_label['evento_bairro'] = "Bairro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_bairro = $this->evento_bairro;
   $sStyleHidden_evento_bairro = '';
   if (isset($this->nmgp_cmp_hidden['evento_bairro']) && $this->nmgp_cmp_hidden['evento_bairro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_bairro']);
       $sStyleHidden_evento_bairro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_bairro = 'display: none;';
   $sStyleReadInp_evento_bairro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_bairro']) && $this->nmgp_cmp_readonly['evento_bairro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_bairro']);
       $sStyleReadLab_evento_bairro = '';
       $sStyleReadInp_evento_bairro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_bairro']) && $this->nmgp_cmp_hidden['evento_bairro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_bairro" value="<?php echo $this->form_encode_input($evento_bairro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_bairro" style="<?php echo $sStyleHidden_evento_bairro; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_bairro_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_bairro_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_bairro"><?php echo $this->nm_new_label['evento_bairro']; ?></span></td></tr><tr><td class="css_evento_bairro_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_bairro"]) &&  $this->nmgp_cmp_readonly["evento_bairro"] == "on") { 

 ?>
<input type="hidden" name="evento_bairro" value="<?php echo $this->form_encode_input($evento_bairro) . "\">" . $evento_bairro . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_bairro" class="sc-ui-readonly-evento_bairro css_evento_bairro_line" style="<?php echo $sStyleReadLab_evento_bairro; ?>"><?php echo $this->form_format_readonly("evento_bairro", $this->form_encode_input($this->evento_bairro)); ?></span><span id="id_read_off_evento_bairro" class="css_read_off_evento_bairro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_bairro; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_bairro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_bairro" type=text name="evento_bairro" value="<?php echo $this->form_encode_input($evento_bairro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_bairro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_bairro_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_logradouro']))
    {
        $this->nm_new_label['evento_logradouro'] = "Logradouro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_logradouro = $this->evento_logradouro;
   $sStyleHidden_evento_logradouro = '';
   if (isset($this->nmgp_cmp_hidden['evento_logradouro']) && $this->nmgp_cmp_hidden['evento_logradouro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_logradouro']);
       $sStyleHidden_evento_logradouro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_logradouro = 'display: none;';
   $sStyleReadInp_evento_logradouro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_logradouro']) && $this->nmgp_cmp_readonly['evento_logradouro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_logradouro']);
       $sStyleReadLab_evento_logradouro = '';
       $sStyleReadInp_evento_logradouro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_logradouro']) && $this->nmgp_cmp_hidden['evento_logradouro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_logradouro" value="<?php echo $this->form_encode_input($evento_logradouro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_logradouro" style="<?php echo $sStyleHidden_evento_logradouro; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_logradouro_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_logradouro_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_logradouro"><?php echo $this->nm_new_label['evento_logradouro']; ?></span></td></tr><tr><td class="css_evento_logradouro_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_logradouro"]) &&  $this->nmgp_cmp_readonly["evento_logradouro"] == "on") { 

 ?>
<input type="hidden" name="evento_logradouro" value="<?php echo $this->form_encode_input($evento_logradouro) . "\">" . $evento_logradouro . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_logradouro" class="sc-ui-readonly-evento_logradouro css_evento_logradouro_line" style="<?php echo $sStyleReadLab_evento_logradouro; ?>"><?php echo $this->form_format_readonly("evento_logradouro", $this->form_encode_input($this->evento_logradouro)); ?></span><span id="id_read_off_evento_logradouro" class="css_read_off_evento_logradouro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_logradouro; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_logradouro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_logradouro" type=text name="evento_logradouro" value="<?php echo $this->form_encode_input($evento_logradouro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_logradouro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_logradouro_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_numero']))
    {
        $this->nm_new_label['evento_numero'] = "Numero:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_numero = $this->evento_numero;
   $sStyleHidden_evento_numero = '';
   if (isset($this->nmgp_cmp_hidden['evento_numero']) && $this->nmgp_cmp_hidden['evento_numero'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_numero']);
       $sStyleHidden_evento_numero = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_numero = 'display: none;';
   $sStyleReadInp_evento_numero = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_numero']) && $this->nmgp_cmp_readonly['evento_numero'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_numero']);
       $sStyleReadLab_evento_numero = '';
       $sStyleReadInp_evento_numero = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_numero']) && $this->nmgp_cmp_hidden['evento_numero'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_numero" value="<?php echo $this->form_encode_input($evento_numero) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_numero" style="<?php echo $sStyleHidden_evento_numero; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_numero_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_numero_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_numero"><?php echo $this->nm_new_label['evento_numero']; ?></span></td></tr><tr><td class="css_evento_numero_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_numero"]) &&  $this->nmgp_cmp_readonly["evento_numero"] == "on") { 

 ?>
<input type="hidden" name="evento_numero" value="<?php echo $this->form_encode_input($evento_numero) . "\">" . $evento_numero . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_numero" class="sc-ui-readonly-evento_numero css_evento_numero_line" style="<?php echo $sStyleReadLab_evento_numero; ?>"><?php echo $this->form_format_readonly("evento_numero", $this->form_encode_input($this->evento_numero)); ?></span><span id="id_read_off_evento_numero" class="css_read_off_evento_numero<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_numero; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_numero_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_numero" type=text name="evento_numero" value="<?php echo $this->form_encode_input($evento_numero) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_numero_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_numero_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_complemento']))
    {
        $this->nm_new_label['evento_complemento'] = "Complemento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_complemento = $this->evento_complemento;
   $sStyleHidden_evento_complemento = '';
   if (isset($this->nmgp_cmp_hidden['evento_complemento']) && $this->nmgp_cmp_hidden['evento_complemento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_complemento']);
       $sStyleHidden_evento_complemento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_complemento = 'display: none;';
   $sStyleReadInp_evento_complemento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_complemento']) && $this->nmgp_cmp_readonly['evento_complemento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_complemento']);
       $sStyleReadLab_evento_complemento = '';
       $sStyleReadInp_evento_complemento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_complemento']) && $this->nmgp_cmp_hidden['evento_complemento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_complemento" value="<?php echo $this->form_encode_input($evento_complemento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_complemento" style="<?php echo $sStyleHidden_evento_complemento; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_complemento_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_complemento_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_complemento"><?php echo $this->nm_new_label['evento_complemento']; ?></span></td></tr><tr><td class="css_evento_complemento_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_complemento"]) &&  $this->nmgp_cmp_readonly["evento_complemento"] == "on") { 

 ?>
<input type="hidden" name="evento_complemento" value="<?php echo $this->form_encode_input($evento_complemento) . "\">" . $evento_complemento . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_complemento" class="sc-ui-readonly-evento_complemento css_evento_complemento_line" style="<?php echo $sStyleReadLab_evento_complemento; ?>"><?php echo $this->form_format_readonly("evento_complemento", $this->form_encode_input($this->evento_complemento)); ?></span><span id="id_read_off_evento_complemento" class="css_read_off_evento_complemento<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_complemento; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_complemento_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_complemento" type=text name="evento_complemento" value="<?php echo $this->form_encode_input($evento_complemento) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_complemento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_complemento_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_observacao']))
    {
        $this->nm_new_label['evento_observacao'] = "Observação:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_observacao = $this->evento_observacao;
   $sStyleHidden_evento_observacao = '';
   if (isset($this->nmgp_cmp_hidden['evento_observacao']) && $this->nmgp_cmp_hidden['evento_observacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_observacao']);
       $sStyleHidden_evento_observacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_observacao = 'display: none;';
   $sStyleReadInp_evento_observacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_observacao']) && $this->nmgp_cmp_readonly['evento_observacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_observacao']);
       $sStyleReadLab_evento_observacao = '';
       $sStyleReadInp_evento_observacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_observacao']) && $this->nmgp_cmp_hidden['evento_observacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_observacao" value="<?php echo $this->form_encode_input($evento_observacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_observacao" style="<?php echo $sStyleHidden_evento_observacao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_observacao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_observacao_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_observacao"><?php echo $this->nm_new_label['evento_observacao']; ?></span></td></tr><tr><td class="css_evento_observacao_line" style="padding: 0px; width: 100%;">
<?php
$evento_observacao_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($evento_observacao));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_observacao"]) &&  $this->nmgp_cmp_readonly["evento_observacao"] == "on") { 

 ?>
<input type="hidden" name="evento_observacao" value="<?php echo $this->form_encode_input($evento_observacao) . "\">" . $evento_observacao_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_observacao" class="sc-ui-readonly-evento_observacao css_evento_observacao_line" style="<?php echo $sStyleReadLab_evento_observacao; ?>"><?php echo $this->form_format_readonly("evento_observacao", $this->form_encode_input($evento_observacao_val)); ?></span><span id="id_read_off_evento_observacao" class="css_read_off_evento_observacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_observacao; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_evento_observacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="evento_observacao" id="id_sc_field_evento_observacao" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $evento_observacao; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_observacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_observacao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['localizacao']))
    {
        $this->nm_new_label['localizacao'] = "Google Maps:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $localizacao = $this->localizacao;
   $sStyleHidden_localizacao = '';
   if (isset($this->nmgp_cmp_hidden['localizacao']) && $this->nmgp_cmp_hidden['localizacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['localizacao']);
       $sStyleHidden_localizacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_localizacao = 'display: none;';
   $sStyleReadInp_localizacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['localizacao']) && $this->nmgp_cmp_readonly['localizacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['localizacao']);
       $sStyleReadLab_localizacao = '';
       $sStyleReadInp_localizacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['localizacao']) && $this->nmgp_cmp_hidden['localizacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="localizacao" value="<?php echo $this->form_encode_input($localizacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_localizacao" style="<?php echo $sStyleHidden_localizacao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_localizacao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_localizacao_label" style=" padding: 0px; width: 100%;"><span id="id_label_localizacao"><?php echo $this->nm_new_label['localizacao']; ?></span></td></tr><tr><td class="css_localizacao_line" style="padding: 0px; width: 100%;"><input type="hidden" name="localizacao" value="<?php echo $this->form_encode_input($localizacao); ?>"><span id="id_ajax_label_localizacao"><?php echo nl2br($localizacao); ?></span>
&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "blink", "window.open(nm_link_url(document.F1.localizacao.value), '')", "window.open(nm_link_url(document.F1.localizacao.value), '')", "localizacao_url", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_localizacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_localizacao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['latitude_app']))
    {
        $this->nm_new_label['latitude_app'] = "Latitude APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $latitude_app = $this->latitude_app;
   $sStyleHidden_latitude_app = '';
   if (isset($this->nmgp_cmp_hidden['latitude_app']) && $this->nmgp_cmp_hidden['latitude_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['latitude_app']);
       $sStyleHidden_latitude_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_latitude_app = 'display: none;';
   $sStyleReadInp_latitude_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['latitude_app']) && $this->nmgp_cmp_readonly['latitude_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['latitude_app']);
       $sStyleReadLab_latitude_app = '';
       $sStyleReadInp_latitude_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['latitude_app']) && $this->nmgp_cmp_hidden['latitude_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="latitude_app" value="<?php echo $this->form_encode_input($latitude_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_latitude_app" style="<?php echo $sStyleHidden_latitude_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_latitude_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_latitude_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_latitude_app"><?php echo $this->nm_new_label['latitude_app']; ?></span></td></tr><tr><td class="css_latitude_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["latitude_app"]) &&  $this->nmgp_cmp_readonly["latitude_app"] == "on") { 

 ?>
<input type="hidden" name="latitude_app" value="<?php echo $this->form_encode_input($latitude_app) . "\">" . $latitude_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_latitude_app" class="sc-ui-readonly-latitude_app css_latitude_app_line" style="<?php echo $sStyleReadLab_latitude_app; ?>"><?php echo $this->form_format_readonly("latitude_app", $this->form_encode_input($this->latitude_app)); ?></span><span id="id_read_off_latitude_app" class="css_read_off_latitude_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_latitude_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_latitude_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_latitude_app" type=text name="latitude_app" value="<?php echo $this->form_encode_input($latitude_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_latitude_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_latitude_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['longitude_app']))
    {
        $this->nm_new_label['longitude_app'] = "Longitude APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $longitude_app = $this->longitude_app;
   $sStyleHidden_longitude_app = '';
   if (isset($this->nmgp_cmp_hidden['longitude_app']) && $this->nmgp_cmp_hidden['longitude_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['longitude_app']);
       $sStyleHidden_longitude_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_longitude_app = 'display: none;';
   $sStyleReadInp_longitude_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['longitude_app']) && $this->nmgp_cmp_readonly['longitude_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['longitude_app']);
       $sStyleReadLab_longitude_app = '';
       $sStyleReadInp_longitude_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['longitude_app']) && $this->nmgp_cmp_hidden['longitude_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="longitude_app" value="<?php echo $this->form_encode_input($longitude_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_longitude_app" style="<?php echo $sStyleHidden_longitude_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_longitude_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_longitude_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_longitude_app"><?php echo $this->nm_new_label['longitude_app']; ?></span></td></tr><tr><td class="css_longitude_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["longitude_app"]) &&  $this->nmgp_cmp_readonly["longitude_app"] == "on") { 

 ?>
<input type="hidden" name="longitude_app" value="<?php echo $this->form_encode_input($longitude_app) . "\">" . $longitude_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_longitude_app" class="sc-ui-readonly-longitude_app css_longitude_app_line" style="<?php echo $sStyleReadLab_longitude_app; ?>"><?php echo $this->form_format_readonly("longitude_app", $this->form_encode_input($this->longitude_app)); ?></span><span id="id_read_off_longitude_app" class="css_read_off_longitude_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_longitude_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_longitude_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_longitude_app" type=text name="longitude_app" value="<?php echo $this->form_encode_input($longitude_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_longitude_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_longitude_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['evento_id_responsavel']))
   {
       $this->nm_new_label['evento_id_responsavel'] = "Responsável";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_id_responsavel = $this->evento_id_responsavel;
   $sStyleHidden_evento_id_responsavel = '';
   if (isset($this->nmgp_cmp_hidden['evento_id_responsavel']) && $this->nmgp_cmp_hidden['evento_id_responsavel'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_id_responsavel']);
       $sStyleHidden_evento_id_responsavel = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_id_responsavel = 'display: none;';
   $sStyleReadInp_evento_id_responsavel = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_id_responsavel']) && $this->nmgp_cmp_readonly['evento_id_responsavel'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_id_responsavel']);
       $sStyleReadLab_evento_id_responsavel = '';
       $sStyleReadInp_evento_id_responsavel = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_id_responsavel']) && $this->nmgp_cmp_hidden['evento_id_responsavel'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="evento_id_responsavel" value="<?php echo $this->form_encode_input($this->evento_id_responsavel) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_id_responsavel" style="<?php echo $sStyleHidden_evento_id_responsavel; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_id_responsavel_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_id_responsavel_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_id_responsavel"><?php echo $this->nm_new_label['evento_id_responsavel']; ?></span></td></tr><tr><td class="css_evento_id_responsavel_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_id_responsavel"]) &&  $this->nmgp_cmp_readonly["evento_id_responsavel"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel'] = array(); 
    }

   $old_value_evento_id = $this->evento_id;
   $old_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $old_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $old_value_evento_cep = $this->evento_cep;
   $old_value_evento_telefone = $this->evento_telefone;
   $old_value_evento_celular = $this->evento_celular;
   $old_value_data_conclusao_app = $this->data_conclusao_app;
   $old_value_wz_suporte_app = $this->wz_suporte_app;
   $old_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $old_value_data_partida_destino_app = $this->data_partida_destino_app;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_evento_id = $this->evento_id;
   $unformatted_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $unformatted_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $unformatted_value_evento_cep = $this->evento_cep;
   $unformatted_value_evento_telefone = $this->evento_telefone;
   $unformatted_value_evento_celular = $this->evento_celular;
   $unformatted_value_data_conclusao_app = $this->data_conclusao_app;
   $unformatted_value_wz_suporte_app = $this->wz_suporte_app;
   $unformatted_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $unformatted_value_data_partida_destino_app = $this->data_partida_destino_app;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT usuario_id, usuario_cpf + ' - ' + usuario_nome  FROM usuarios_rsvp  ORDER BY usuario_cpf, usuario_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT usuario_id, concat(usuario_cpf, ' - ',usuario_nome)  FROM usuarios_rsvp  ORDER BY usuario_cpf, usuario_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT usuario_id, usuario_cpf&' - '&usuario_nome  FROM usuarios_rsvp  ORDER BY usuario_cpf, usuario_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT usuario_id, usuario_cpf||' - '||usuario_nome  FROM usuarios_rsvp  ORDER BY usuario_cpf, usuario_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT usuario_id, usuario_cpf + ' - ' + usuario_nome  FROM usuarios_rsvp  ORDER BY usuario_cpf, usuario_nome";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT usuario_id, usuario_cpf||' - '||usuario_nome  FROM usuarios_rsvp  ORDER BY usuario_cpf, usuario_nome";
   }
   else
   {
       $nm_comando = "SELECT usuario_id, usuario_cpf||' - '||usuario_nome  FROM usuarios_rsvp  ORDER BY usuario_cpf, usuario_nome";
   }

   $this->evento_id = $old_value_evento_id;
   $this->evento_dt_realizacao = $old_value_evento_dt_realizacao;
   $this->evento_dt_conclusao = $old_value_evento_dt_conclusao;
   $this->evento_cep = $old_value_evento_cep;
   $this->evento_telefone = $old_value_evento_telefone;
   $this->evento_celular = $old_value_evento_celular;
   $this->data_conclusao_app = $old_value_data_conclusao_app;
   $this->wz_suporte_app = $old_value_wz_suporte_app;
   $this->data_chegada_destino_app = $old_value_data_chegada_destino_app;
   $this->data_partida_destino_app = $old_value_data_partida_destino_app;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel'][] = $rs->fields[0];
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
   $evento_id_responsavel_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->evento_id_responsavel_1))
          {
              foreach ($this->evento_id_responsavel_1 as $tmp_evento_id_responsavel)
              {
                  if (trim($tmp_evento_id_responsavel) === trim($cadaselect[1])) {$evento_id_responsavel_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->evento_id_responsavel) && trim($this->evento_id_responsavel) === trim($cadaselect[1])) {$evento_id_responsavel_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="evento_id_responsavel" value="<?php echo $this->form_encode_input($evento_id_responsavel) . "\">" . $evento_id_responsavel_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_evento_id_responsavel();
   $x = 0 ; 
   $evento_id_responsavel_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->evento_id_responsavel_1))
          {
              foreach ($this->evento_id_responsavel_1 as $tmp_evento_id_responsavel)
              {
                  if (trim($tmp_evento_id_responsavel) === trim($cadaselect[1])) {$evento_id_responsavel_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->evento_id_responsavel)) {
                 if (trim($this->evento_id_responsavel) == trim($cadaselect[1])) { $evento_id_responsavel_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->evento_id_responsavel == $cadaselect[1]) { $evento_id_responsavel_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($evento_id_responsavel_look))
          {
              $evento_id_responsavel_look = $this->evento_id_responsavel;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_evento_id_responsavel\" class=\"css_evento_id_responsavel_line\" style=\"" .  $sStyleReadLab_evento_id_responsavel . "\">" . $this->form_format_readonly("evento_id_responsavel", $this->form_encode_input($evento_id_responsavel_look)) . "</span><span id=\"id_read_off_evento_id_responsavel\" class=\"css_read_off_evento_id_responsavel" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_evento_id_responsavel . "\">";
   echo " <span id=\"idAjaxSelect_evento_id_responsavel\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_evento_id_responsavel_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_evento_id_responsavel\" name=\"evento_id_responsavel\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_evento_id_responsavel'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->evento_id_responsavel) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->evento_id_responsavel)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_id_responsavel_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_id_responsavel_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_telefone']))
    {
        $this->nm_new_label['evento_telefone'] = " Telefone:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_telefone = $this->evento_telefone;
   $sStyleHidden_evento_telefone = '';
   if (isset($this->nmgp_cmp_hidden['evento_telefone']) && $this->nmgp_cmp_hidden['evento_telefone'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_telefone']);
       $sStyleHidden_evento_telefone = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_telefone = 'display: none;';
   $sStyleReadInp_evento_telefone = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_telefone']) && $this->nmgp_cmp_readonly['evento_telefone'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_telefone']);
       $sStyleReadLab_evento_telefone = '';
       $sStyleReadInp_evento_telefone = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_telefone']) && $this->nmgp_cmp_hidden['evento_telefone'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_telefone" value="<?php echo $this->form_encode_input($evento_telefone) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_telefone" style="<?php echo $sStyleHidden_evento_telefone; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_telefone_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_telefone_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_telefone"><?php echo $this->nm_new_label['evento_telefone']; ?></span></td></tr><tr><td class="css_evento_telefone_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_telefone"]) &&  $this->nmgp_cmp_readonly["evento_telefone"] == "on") { 

 ?>
<input type="hidden" name="evento_telefone" value="<?php echo $this->form_encode_input($evento_telefone) . "\">" . $evento_telefone . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_telefone" class="sc-ui-readonly-evento_telefone css_evento_telefone_line" style="<?php echo $sStyleReadLab_evento_telefone; ?>"><?php echo $this->form_format_readonly("evento_telefone", $this->form_encode_input($this->evento_telefone)); ?></span><span id="id_read_off_evento_telefone" class="css_read_off_evento_telefone<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_telefone; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_telefone_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_telefone" type=text name="evento_telefone" value="<?php echo $this->form_encode_input($evento_telefone) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=39 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 9999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_telefone_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_telefone_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_celular']))
    {
        $this->nm_new_label['evento_celular'] = "Celular:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_celular = $this->evento_celular;
   $sStyleHidden_evento_celular = '';
   if (isset($this->nmgp_cmp_hidden['evento_celular']) && $this->nmgp_cmp_hidden['evento_celular'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_celular']);
       $sStyleHidden_evento_celular = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_celular = 'display: none;';
   $sStyleReadInp_evento_celular = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_celular']) && $this->nmgp_cmp_readonly['evento_celular'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_celular']);
       $sStyleReadLab_evento_celular = '';
       $sStyleReadInp_evento_celular = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_celular']) && $this->nmgp_cmp_hidden['evento_celular'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_celular" value="<?php echo $this->form_encode_input($evento_celular) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_celular" style="<?php echo $sStyleHidden_evento_celular; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_celular_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_celular_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_celular"><?php echo $this->nm_new_label['evento_celular']; ?></span></td></tr><tr><td class="css_evento_celular_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["evento_celular"]) &&  $this->nmgp_cmp_readonly["evento_celular"] == "on") { 

 ?>
<input type="hidden" name="evento_celular" value="<?php echo $this->form_encode_input($evento_celular) . "\">" . $evento_celular . ""; ?>
<?php } else { ?>
<span id="id_read_on_evento_celular" class="sc-ui-readonly-evento_celular css_evento_celular_line" style="<?php echo $sStyleReadLab_evento_celular; ?>"><?php echo $this->form_format_readonly("evento_celular", $this->form_encode_input($this->evento_celular)); ?></span><span id="id_read_off_evento_celular" class="css_read_off_evento_celular<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_evento_celular; ?>">
 <input class="sc-js-input scFormObjectOdd css_evento_celular_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_evento_celular" type=text name="evento_celular" value="<?php echo $this->form_encode_input($evento_celular) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=40 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 99999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_celular_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_celular_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_evento_celular_dumb = ('' == $sStyleHidden_evento_celular) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_evento_celular_dumb" style="<?php echo $sStyleHidden_evento_celular_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_3"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_3" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%; border-style: none;">   <tr>


    <TD colspan="1" height="0" class="scFormBlock" style="background-color: #c7c7b9; text-align: left">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="left" valign="" class="scFormBlockFont" style="font-size: 14px; color: #1539d9"><?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "<table style=\"border-collapse: collapse; height: 100%; width: 100%\"><tr><td style=\"vertical-align: middle; border-width: 0px; padding: 0px 2px 0px 0px\"><img id=\"SC_blk_pdf3\" src=\"" . $this->Ini->path_icones . "/" . $this->Ini->Block_img_col . "\" style=\"border: 0px; float: left\" class=\"sc-ui-block-control\"></td><td style=\"border-width: 0px; padding: 0px; width: 100%;background-color: #c7c7b9; text-align: left; font-size: 14px; color: #1539d9; \" class=\"scFormBlockAlign\" align=\"left\">"; } ?>Be Invited - API<?php if ('' != $this->Ini->Block_img_exp && '' != $this->Ini->Block_img_col && !$this->Ini->Export_img_zip) { echo "</td></tr></table>"; } ?></TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['dsc_app']))
    {
        $this->nm_new_label['dsc_app'] = "Descrição APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $dsc_app = $this->dsc_app;
   $sStyleHidden_dsc_app = '';
   if (isset($this->nmgp_cmp_hidden['dsc_app']) && $this->nmgp_cmp_hidden['dsc_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['dsc_app']);
       $sStyleHidden_dsc_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_dsc_app = 'display: none;';
   $sStyleReadInp_dsc_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['dsc_app']) && $this->nmgp_cmp_readonly['dsc_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['dsc_app']);
       $sStyleReadLab_dsc_app = '';
       $sStyleReadInp_dsc_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['dsc_app']) && $this->nmgp_cmp_hidden['dsc_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="dsc_app" value="<?php echo $this->form_encode_input($dsc_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_dsc_app" style="<?php echo $sStyleHidden_dsc_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_dsc_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_dsc_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_dsc_app"><?php echo $this->nm_new_label['dsc_app']; ?></span></td></tr><tr><td class="css_dsc_app_line" style="padding: 0px; width: 100%;">
<?php
$dsc_app_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($dsc_app));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["dsc_app"]) &&  $this->nmgp_cmp_readonly["dsc_app"] == "on") { 

 ?>
<input type="hidden" name="dsc_app" value="<?php echo $this->form_encode_input($dsc_app) . "\">" . $dsc_app_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_dsc_app" class="sc-ui-readonly-dsc_app css_dsc_app_line" style="<?php echo $sStyleReadLab_dsc_app; ?>"><?php echo $this->form_format_readonly("dsc_app", $this->form_encode_input($dsc_app_val)); ?></span><span id="id_read_off_dsc_app" class="css_read_off_dsc_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_dsc_app; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_dsc_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="dsc_app" id="id_sc_field_dsc_app" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $dsc_app; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_dsc_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_dsc_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['data_conclusao_app']))
    {
        $this->nm_new_label['data_conclusao_app'] = "Data Conclusão APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $data_conclusao_app = $this->data_conclusao_app;
   $sStyleHidden_data_conclusao_app = '';
   if (isset($this->nmgp_cmp_hidden['data_conclusao_app']) && $this->nmgp_cmp_hidden['data_conclusao_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['data_conclusao_app']);
       $sStyleHidden_data_conclusao_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_data_conclusao_app = 'display: none;';
   $sStyleReadInp_data_conclusao_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['data_conclusao_app']) && $this->nmgp_cmp_readonly['data_conclusao_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['data_conclusao_app']);
       $sStyleReadLab_data_conclusao_app = '';
       $sStyleReadInp_data_conclusao_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['data_conclusao_app']) && $this->nmgp_cmp_hidden['data_conclusao_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="data_conclusao_app" value="<?php echo $this->form_encode_input($data_conclusao_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_data_conclusao_app" style="<?php echo $sStyleHidden_data_conclusao_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_data_conclusao_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_data_conclusao_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_data_conclusao_app"><?php echo $this->nm_new_label['data_conclusao_app']; ?></span></td></tr><tr><td class="css_data_conclusao_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["data_conclusao_app"]) &&  $this->nmgp_cmp_readonly["data_conclusao_app"] == "on") { 

 ?>
<input type="hidden" name="data_conclusao_app" value="<?php echo $this->form_encode_input($data_conclusao_app) . "\">" . $data_conclusao_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_data_conclusao_app" class="sc-ui-readonly-data_conclusao_app css_data_conclusao_app_line" style="<?php echo $sStyleReadLab_data_conclusao_app; ?>"><?php echo $this->form_format_readonly("data_conclusao_app", $this->form_encode_input($data_conclusao_app)); ?></span><span id="id_read_off_data_conclusao_app" class="css_read_off_data_conclusao_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_data_conclusao_app; ?>"><?php
$tmp_form_data = $this->field_config['data_conclusao_app']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_data_conclusao_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_data_conclusao_app" type=text name="data_conclusao_app" value="<?php echo $this->form_encode_input($data_conclusao_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['data_conclusao_app']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['data_conclusao_app']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_data_conclusao_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_data_conclusao_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['localizacao_app']))
    {
        $this->nm_new_label['localizacao_app'] = "Localização APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $localizacao_app = $this->localizacao_app;
   $sStyleHidden_localizacao_app = '';
   if (isset($this->nmgp_cmp_hidden['localizacao_app']) && $this->nmgp_cmp_hidden['localizacao_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['localizacao_app']);
       $sStyleHidden_localizacao_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_localizacao_app = 'display: none;';
   $sStyleReadInp_localizacao_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['localizacao_app']) && $this->nmgp_cmp_readonly['localizacao_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['localizacao_app']);
       $sStyleReadLab_localizacao_app = '';
       $sStyleReadInp_localizacao_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['localizacao_app']) && $this->nmgp_cmp_hidden['localizacao_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="localizacao_app" value="<?php echo $this->form_encode_input($localizacao_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_localizacao_app" style="<?php echo $sStyleHidden_localizacao_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_localizacao_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_localizacao_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_localizacao_app"><?php echo $this->nm_new_label['localizacao_app']; ?></span></td></tr><tr><td class="css_localizacao_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["localizacao_app"]) &&  $this->nmgp_cmp_readonly["localizacao_app"] == "on") { 

 ?>
<input type="hidden" name="localizacao_app" value="<?php echo $this->form_encode_input($localizacao_app) . "\">" . $localizacao_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_localizacao_app" class="sc-ui-readonly-localizacao_app css_localizacao_app_line" style="<?php echo $sStyleReadLab_localizacao_app; ?>"><?php echo $this->form_format_readonly("localizacao_app", $this->form_encode_input($this->localizacao_app)); ?></span><span id="id_read_off_localizacao_app" class="css_read_off_localizacao_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_localizacao_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_localizacao_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_localizacao_app" type=text name="localizacao_app" value="<?php echo $this->form_encode_input($localizacao_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_localizacao_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_localizacao_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['status_app']))
   {
       $this->nm_new_label['status_app'] = "Status APP:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $status_app = $this->status_app;
   $sStyleHidden_status_app = '';
   if (isset($this->nmgp_cmp_hidden['status_app']) && $this->nmgp_cmp_hidden['status_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['status_app']);
       $sStyleHidden_status_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_status_app = 'display: none;';
   $sStyleReadInp_status_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['status_app']) && $this->nmgp_cmp_readonly['status_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['status_app']);
       $sStyleReadLab_status_app = '';
       $sStyleReadInp_status_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['status_app']) && $this->nmgp_cmp_hidden['status_app'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="status_app" value="<?php echo $this->form_encode_input($this->status_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_status_app" style="<?php echo $sStyleHidden_status_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_status_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_status_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_status_app"><?php echo $this->nm_new_label['status_app']; ?></span></td></tr><tr><td class="css_status_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["status_app"]) &&  $this->nmgp_cmp_readonly["status_app"] == "on") { 

$status_app_look = "";
 if ($this->status_app == "upcoming") { $status_app_look .= "upcoming (por vir)" ;} 
 if ($this->status_app == "ongoing") { $status_app_look .= "ongoing (em andamento)" ;} 
 if ($this->status_app == "completed") { $status_app_look .= "completed (completado)" ;} 
 if ($this->status_app == "cancelled") { $status_app_look .= "cancelled (cancelado)" ;} 
 if (empty($status_app_look)) { $status_app_look = $this->status_app; }
?>
<input type="hidden" name="status_app" value="<?php echo $this->form_encode_input($status_app) . "\">" . $status_app_look . ""; ?>
<?php } else { ?>
<?php

$status_app_look = "";
 if ($this->status_app == "upcoming") { $status_app_look .= "upcoming (por vir)" ;} 
 if ($this->status_app == "ongoing") { $status_app_look .= "ongoing (em andamento)" ;} 
 if ($this->status_app == "completed") { $status_app_look .= "completed (completado)" ;} 
 if ($this->status_app == "cancelled") { $status_app_look .= "cancelled (cancelado)" ;} 
 if (empty($status_app_look)) { $status_app_look = $this->status_app; }
?>
<span id="id_read_on_status_app" class="css_status_app_line"  style="<?php echo $sStyleReadLab_status_app; ?>"><?php echo $this->form_format_readonly("status_app", $this->form_encode_input($status_app_look)); ?></span><span id="id_read_off_status_app" class="css_read_off_status_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_status_app; ?>">
 <span id="idAjaxSelect_status_app" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_status_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_status_app" name="status_app" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_status_app'][] = ''; ?>
 <option value=""></option>
 <option  value="upcoming" <?php  if ($this->status_app == "upcoming") { echo " selected" ;} ?><?php  if (empty($this->status_app)) { echo " selected" ;} ?>>upcoming (por vir)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_status_app'][] = 'upcoming'; ?>
 <option  value="ongoing" <?php  if ($this->status_app == "ongoing") { echo " selected" ;} ?>>ongoing (em andamento)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_status_app'][] = 'ongoing'; ?>
 <option  value="completed" <?php  if ($this->status_app == "completed") { echo " selected" ;} ?>>completed (completado)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_status_app'][] = 'completed'; ?>
 <option  value="cancelled" <?php  if ($this->status_app == "cancelled") { echo " selected" ;} ?>>cancelled (cancelado)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_status_app'][] = 'cancelled'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_status_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_status_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['status_da_publicidade']))
   {
       $this->nm_new_label['status_da_publicidade'] = "Status da Publicidade:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $status_da_publicidade = $this->status_da_publicidade;
   $sStyleHidden_status_da_publicidade = '';
   if (isset($this->nmgp_cmp_hidden['status_da_publicidade']) && $this->nmgp_cmp_hidden['status_da_publicidade'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['status_da_publicidade']);
       $sStyleHidden_status_da_publicidade = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_status_da_publicidade = 'display: none;';
   $sStyleReadInp_status_da_publicidade = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['status_da_publicidade']) && $this->nmgp_cmp_readonly['status_da_publicidade'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['status_da_publicidade']);
       $sStyleReadLab_status_da_publicidade = '';
       $sStyleReadInp_status_da_publicidade = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['status_da_publicidade']) && $this->nmgp_cmp_hidden['status_da_publicidade'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="status_da_publicidade" value="<?php echo $this->form_encode_input($this->status_da_publicidade) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_status_da_publicidade" style="<?php echo $sStyleHidden_status_da_publicidade; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_status_da_publicidade_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_status_da_publicidade_label" style=" padding: 0px; width: 100%;"><span id="id_label_status_da_publicidade"><?php echo $this->nm_new_label['status_da_publicidade']; ?></span></td></tr><tr><td class="css_status_da_publicidade_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["status_da_publicidade"]) &&  $this->nmgp_cmp_readonly["status_da_publicidade"] == "on") { 

$status_da_publicidade_look = "";
 if ($this->status_da_publicidade == "draft") { $status_da_publicidade_look .= "draft (rascunho)" ;} 
 if ($this->status_da_publicidade == "published") { $status_da_publicidade_look .= "published (publicado)" ;} 
 if (empty($status_da_publicidade_look)) { $status_da_publicidade_look = $this->status_da_publicidade; }
?>
<input type="hidden" name="status_da_publicidade" value="<?php echo $this->form_encode_input($status_da_publicidade) . "\">" . $status_da_publicidade_look . ""; ?>
<?php } else { ?>
<?php

$status_da_publicidade_look = "";
 if ($this->status_da_publicidade == "draft") { $status_da_publicidade_look .= "draft (rascunho)" ;} 
 if ($this->status_da_publicidade == "published") { $status_da_publicidade_look .= "published (publicado)" ;} 
 if (empty($status_da_publicidade_look)) { $status_da_publicidade_look = $this->status_da_publicidade; }
?>
<span id="id_read_on_status_da_publicidade" class="css_status_da_publicidade_line"  style="<?php echo $sStyleReadLab_status_da_publicidade; ?>"><?php echo $this->form_format_readonly("status_da_publicidade", $this->form_encode_input($status_da_publicidade_look)); ?></span><span id="id_read_off_status_da_publicidade" class="css_read_off_status_da_publicidade<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_status_da_publicidade; ?>">
 <span id="idAjaxSelect_status_da_publicidade" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_status_da_publicidade_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_status_da_publicidade" name="status_da_publicidade" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="draft" <?php  if ($this->status_da_publicidade == "draft") { echo " selected" ;} ?><?php  if (empty($this->status_da_publicidade)) { echo " selected" ;} ?>>draft (rascunho)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_status_da_publicidade'][] = 'draft'; ?>
 <option  value="published" <?php  if ($this->status_da_publicidade == "published") { echo " selected" ;} ?>>published (publicado)</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_status_da_publicidade'][] = 'published'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_status_da_publicidade_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_status_da_publicidade_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['timezone']))
   {
       $this->nm_new_label['timezone'] = "Timezone:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $timezone = $this->timezone;
   $sStyleHidden_timezone = '';
   if (isset($this->nmgp_cmp_hidden['timezone']) && $this->nmgp_cmp_hidden['timezone'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['timezone']);
       $sStyleHidden_timezone = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_timezone = 'display: none;';
   $sStyleReadInp_timezone = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['timezone']) && $this->nmgp_cmp_readonly['timezone'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['timezone']);
       $sStyleReadLab_timezone = '';
       $sStyleReadInp_timezone = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['timezone']) && $this->nmgp_cmp_hidden['timezone'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="timezone" value="<?php echo $this->form_encode_input($this->timezone) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_timezone" style="<?php echo $sStyleHidden_timezone; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_timezone_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_timezone_label" style=" padding: 0px; width: 100%;"><span id="id_label_timezone"><?php echo $this->nm_new_label['timezone']; ?></span></td></tr><tr><td class="css_timezone_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["timezone"]) &&  $this->nmgp_cmp_readonly["timezone"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone'] = array(); 
    }

   $old_value_evento_id = $this->evento_id;
   $old_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $old_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $old_value_evento_cep = $this->evento_cep;
   $old_value_evento_telefone = $this->evento_telefone;
   $old_value_evento_celular = $this->evento_celular;
   $old_value_data_conclusao_app = $this->data_conclusao_app;
   $old_value_wz_suporte_app = $this->wz_suporte_app;
   $old_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $old_value_data_partida_destino_app = $this->data_partida_destino_app;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_evento_id = $this->evento_id;
   $unformatted_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $unformatted_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $unformatted_value_evento_cep = $this->evento_cep;
   $unformatted_value_evento_telefone = $this->evento_telefone;
   $unformatted_value_evento_celular = $this->evento_celular;
   $unformatted_value_data_conclusao_app = $this->data_conclusao_app;
   $unformatted_value_wz_suporte_app = $this->wz_suporte_app;
   $unformatted_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $unformatted_value_data_partida_destino_app = $this->data_partida_destino_app;

   $nm_comando = "SELECT zone_name, zone_name  FROM time_zone  ORDER BY zone_name";

   $this->evento_id = $old_value_evento_id;
   $this->evento_dt_realizacao = $old_value_evento_dt_realizacao;
   $this->evento_dt_conclusao = $old_value_evento_dt_conclusao;
   $this->evento_cep = $old_value_evento_cep;
   $this->evento_telefone = $old_value_evento_telefone;
   $this->evento_celular = $old_value_evento_celular;
   $this->data_conclusao_app = $old_value_data_conclusao_app;
   $this->wz_suporte_app = $old_value_wz_suporte_app;
   $this->data_chegada_destino_app = $old_value_data_chegada_destino_app;
   $this->data_partida_destino_app = $old_value_data_partida_destino_app;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone'][] = $rs->fields[0];
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
   $timezone_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->timezone_1))
          {
              foreach ($this->timezone_1 as $tmp_timezone)
              {
                  if (trim($tmp_timezone) === trim($cadaselect[1])) {$timezone_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->timezone) && trim($this->timezone) === trim($cadaselect[1])) {$timezone_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="timezone" value="<?php echo $this->form_encode_input($timezone) . "\">" . $timezone_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_timezone();
   $x = 0 ; 
   $timezone_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->timezone_1))
          {
              foreach ($this->timezone_1 as $tmp_timezone)
              {
                  if (trim($tmp_timezone) === trim($cadaselect[1])) {$timezone_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->timezone)) {
                 if (trim($this->timezone) == trim($cadaselect[1])) { $timezone_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->timezone == $cadaselect[1]) { $timezone_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($timezone_look))
          {
              $timezone_look = $this->timezone;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_timezone\" class=\"css_timezone_line\" style=\"" .  $sStyleReadLab_timezone . "\">" . $this->form_format_readonly("timezone", $this->form_encode_input($timezone_look)) . "</span><span id=\"id_read_off_timezone\" class=\"css_read_off_timezone" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_timezone . "\">";
   echo " <span id=\"idAjaxSelect_timezone\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_timezone_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_timezone\" name=\"timezone\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_timezone'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;","&nbsp;") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->timezone) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->timezone)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_timezone_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_timezone_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['caminho_logo_cli']))
    {
        $this->nm_new_label['caminho_logo_cli'] = "Logo Evento APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $caminho_logo_cli = $this->caminho_logo_cli;
   $sStyleHidden_caminho_logo_cli = '';
   if (isset($this->nmgp_cmp_hidden['caminho_logo_cli']) && $this->nmgp_cmp_hidden['caminho_logo_cli'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['caminho_logo_cli']);
       $sStyleHidden_caminho_logo_cli = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_caminho_logo_cli = 'display: none;';
   $sStyleReadInp_caminho_logo_cli = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['caminho_logo_cli']) && $this->nmgp_cmp_readonly['caminho_logo_cli'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['caminho_logo_cli']);
       $sStyleReadLab_caminho_logo_cli = '';
       $sStyleReadInp_caminho_logo_cli = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['caminho_logo_cli']) && $this->nmgp_cmp_hidden['caminho_logo_cli'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="caminho_logo_cli" value="<?php echo $this->form_encode_input($caminho_logo_cli) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_caminho_logo_cli" style="<?php echo $sStyleHidden_caminho_logo_cli; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_caminho_logo_cli_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_caminho_logo_cli_label" style=" padding: 0px; width: 100%;"><span id="id_label_caminho_logo_cli"><?php echo $this->nm_new_label['caminho_logo_cli']; ?></span></td></tr><tr><td class="css_caminho_logo_cli_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["caminho_logo_cli"]) &&  $this->nmgp_cmp_readonly["caminho_logo_cli"] == "on") { 

 ?>
<input type="hidden" name="caminho_logo_cli" value="<?php echo $this->form_encode_input($caminho_logo_cli) . "\">" . $caminho_logo_cli . ""; ?>
<?php } else { ?>
<span id="id_read_on_caminho_logo_cli" class="sc-ui-readonly-caminho_logo_cli css_caminho_logo_cli_line" style="<?php echo $sStyleReadLab_caminho_logo_cli; ?>"><?php echo $this->form_format_readonly("caminho_logo_cli", $this->form_encode_input($this->caminho_logo_cli)); ?></span><span id="id_read_off_caminho_logo_cli" class="css_read_off_caminho_logo_cli<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_caminho_logo_cli; ?>">
 <input class="sc-js-input scFormObjectOdd css_caminho_logo_cli_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_caminho_logo_cli" type=text name="caminho_logo_cli" value="<?php echo $this->form_encode_input($caminho_logo_cli) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=70"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_caminho_logo_cli_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_caminho_logo_cli_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['caminho_cover_image']))
    {
        $this->nm_new_label['caminho_cover_image'] = "Logo Cliente APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $caminho_cover_image = $this->caminho_cover_image;
   $sStyleHidden_caminho_cover_image = '';
   if (isset($this->nmgp_cmp_hidden['caminho_cover_image']) && $this->nmgp_cmp_hidden['caminho_cover_image'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['caminho_cover_image']);
       $sStyleHidden_caminho_cover_image = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_caminho_cover_image = 'display: none;';
   $sStyleReadInp_caminho_cover_image = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['caminho_cover_image']) && $this->nmgp_cmp_readonly['caminho_cover_image'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['caminho_cover_image']);
       $sStyleReadLab_caminho_cover_image = '';
       $sStyleReadInp_caminho_cover_image = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['caminho_cover_image']) && $this->nmgp_cmp_hidden['caminho_cover_image'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="caminho_cover_image" value="<?php echo $this->form_encode_input($caminho_cover_image) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_caminho_cover_image" style="<?php echo $sStyleHidden_caminho_cover_image; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_caminho_cover_image_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_caminho_cover_image_label" style=" padding: 0px; width: 100%;"><span id="id_label_caminho_cover_image"><?php echo $this->nm_new_label['caminho_cover_image']; ?></span></td></tr><tr><td class="css_caminho_cover_image_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["caminho_cover_image"]) &&  $this->nmgp_cmp_readonly["caminho_cover_image"] == "on") { 

 ?>
<input type="hidden" name="caminho_cover_image" value="<?php echo $this->form_encode_input($caminho_cover_image) . "\">" . $caminho_cover_image . ""; ?>
<?php } else { ?>
<span id="id_read_on_caminho_cover_image" class="sc-ui-readonly-caminho_cover_image css_caminho_cover_image_line" style="<?php echo $sStyleReadLab_caminho_cover_image; ?>"><?php echo $this->form_format_readonly("caminho_cover_image", $this->form_encode_input($this->caminho_cover_image)); ?></span><span id="id_read_off_caminho_cover_image" class="css_read_off_caminho_cover_image<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_caminho_cover_image; ?>">
 <input class="sc-js-input scFormObjectOdd css_caminho_cover_image_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_caminho_cover_image" type=text name="caminho_cover_image" value="<?php echo $this->form_encode_input($caminho_cover_image) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=70"; } ?> maxlength=255 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_caminho_cover_image_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_caminho_cover_image_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cor_principal_app']))
    {
        $this->nm_new_label['cor_principal_app'] = "Cor Principal APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cor_principal_app = $this->cor_principal_app;
   $sStyleHidden_cor_principal_app = '';
   if (isset($this->nmgp_cmp_hidden['cor_principal_app']) && $this->nmgp_cmp_hidden['cor_principal_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cor_principal_app']);
       $sStyleHidden_cor_principal_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cor_principal_app = 'display: none;';
   $sStyleReadInp_cor_principal_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cor_principal_app']) && $this->nmgp_cmp_readonly['cor_principal_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cor_principal_app']);
       $sStyleReadLab_cor_principal_app = '';
       $sStyleReadInp_cor_principal_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cor_principal_app']) && $this->nmgp_cmp_hidden['cor_principal_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cor_principal_app" value="<?php echo $this->form_encode_input($cor_principal_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cor_principal_app" style="<?php echo $sStyleHidden_cor_principal_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cor_principal_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cor_principal_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_cor_principal_app"><?php echo $this->nm_new_label['cor_principal_app']; ?></span></td></tr><tr><td class="css_cor_principal_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cor_principal_app"]) &&  $this->nmgp_cmp_readonly["cor_principal_app"] == "on") { 

 ?>
<input type="hidden" name="cor_principal_app" value="<?php echo $this->form_encode_input($cor_principal_app) . "\">" . $cor_principal_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_cor_principal_app" class="sc-ui-readonly-cor_principal_app css_cor_principal_app_line" style="<?php echo $sStyleReadLab_cor_principal_app; ?>"><?php echo $this->form_format_readonly("cor_principal_app", $this->form_encode_input($this->cor_principal_app)); ?></span><span id="id_read_off_cor_principal_app" class="css_read_off_cor_principal_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cor_principal_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_cor_principal_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cor_principal_app" type=text name="cor_principal_app" value="<?php echo $this->form_encode_input($cor_principal_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "bsrgb", "", "", "cor_principal_app_cor", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cor_principal_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cor_principal_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cor_secundaria_app']))
    {
        $this->nm_new_label['cor_secundaria_app'] = "Cor Secundária APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cor_secundaria_app = $this->cor_secundaria_app;
   $sStyleHidden_cor_secundaria_app = '';
   if (isset($this->nmgp_cmp_hidden['cor_secundaria_app']) && $this->nmgp_cmp_hidden['cor_secundaria_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cor_secundaria_app']);
       $sStyleHidden_cor_secundaria_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cor_secundaria_app = 'display: none;';
   $sStyleReadInp_cor_secundaria_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cor_secundaria_app']) && $this->nmgp_cmp_readonly['cor_secundaria_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cor_secundaria_app']);
       $sStyleReadLab_cor_secundaria_app = '';
       $sStyleReadInp_cor_secundaria_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cor_secundaria_app']) && $this->nmgp_cmp_hidden['cor_secundaria_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cor_secundaria_app" value="<?php echo $this->form_encode_input($cor_secundaria_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cor_secundaria_app" style="<?php echo $sStyleHidden_cor_secundaria_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cor_secundaria_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cor_secundaria_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_cor_secundaria_app"><?php echo $this->nm_new_label['cor_secundaria_app']; ?></span></td></tr><tr><td class="css_cor_secundaria_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cor_secundaria_app"]) &&  $this->nmgp_cmp_readonly["cor_secundaria_app"] == "on") { 

 ?>
<input type="hidden" name="cor_secundaria_app" value="<?php echo $this->form_encode_input($cor_secundaria_app) . "\">" . $cor_secundaria_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_cor_secundaria_app" class="sc-ui-readonly-cor_secundaria_app css_cor_secundaria_app_line" style="<?php echo $sStyleReadLab_cor_secundaria_app; ?>"><?php echo $this->form_format_readonly("cor_secundaria_app", $this->form_encode_input($this->cor_secundaria_app)); ?></span><span id="id_read_off_cor_secundaria_app" class="css_read_off_cor_secundaria_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cor_secundaria_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_cor_secundaria_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cor_secundaria_app" type=text name="cor_secundaria_app" value="<?php echo $this->form_encode_input($cor_secundaria_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "bsrgb", "", "", "cor_secundaria_app_cor", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cor_secundaria_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cor_secundaria_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cor_fundo_app']))
    {
        $this->nm_new_label['cor_fundo_app'] = "Cor Fundo APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cor_fundo_app = $this->cor_fundo_app;
   $sStyleHidden_cor_fundo_app = '';
   if (isset($this->nmgp_cmp_hidden['cor_fundo_app']) && $this->nmgp_cmp_hidden['cor_fundo_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cor_fundo_app']);
       $sStyleHidden_cor_fundo_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cor_fundo_app = 'display: none;';
   $sStyleReadInp_cor_fundo_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cor_fundo_app']) && $this->nmgp_cmp_readonly['cor_fundo_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cor_fundo_app']);
       $sStyleReadLab_cor_fundo_app = '';
       $sStyleReadInp_cor_fundo_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cor_fundo_app']) && $this->nmgp_cmp_hidden['cor_fundo_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cor_fundo_app" value="<?php echo $this->form_encode_input($cor_fundo_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cor_fundo_app" style="<?php echo $sStyleHidden_cor_fundo_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cor_fundo_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cor_fundo_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_cor_fundo_app"><?php echo $this->nm_new_label['cor_fundo_app']; ?></span></td></tr><tr><td class="css_cor_fundo_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cor_fundo_app"]) &&  $this->nmgp_cmp_readonly["cor_fundo_app"] == "on") { 

 ?>
<input type="hidden" name="cor_fundo_app" value="<?php echo $this->form_encode_input($cor_fundo_app) . "\">" . $cor_fundo_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_cor_fundo_app" class="sc-ui-readonly-cor_fundo_app css_cor_fundo_app_line" style="<?php echo $sStyleReadLab_cor_fundo_app; ?>"><?php echo $this->form_format_readonly("cor_fundo_app", $this->form_encode_input($this->cor_fundo_app)); ?></span><span id="id_read_off_cor_fundo_app" class="css_read_off_cor_fundo_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cor_fundo_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_cor_fundo_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cor_fundo_app" type=text name="cor_fundo_app" value="<?php echo $this->form_encode_input($cor_fundo_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "bsrgb", "", "", "cor_fundo_app_cor", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cor_fundo_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cor_fundo_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nome_organizador_app']))
    {
        $this->nm_new_label['nome_organizador_app'] = "Nome Organizador APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nome_organizador_app = $this->nome_organizador_app;
   $sStyleHidden_nome_organizador_app = '';
   if (isset($this->nmgp_cmp_hidden['nome_organizador_app']) && $this->nmgp_cmp_hidden['nome_organizador_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nome_organizador_app']);
       $sStyleHidden_nome_organizador_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nome_organizador_app = 'display: none;';
   $sStyleReadInp_nome_organizador_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nome_organizador_app']) && $this->nmgp_cmp_readonly['nome_organizador_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nome_organizador_app']);
       $sStyleReadLab_nome_organizador_app = '';
       $sStyleReadInp_nome_organizador_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nome_organizador_app']) && $this->nmgp_cmp_hidden['nome_organizador_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nome_organizador_app" value="<?php echo $this->form_encode_input($nome_organizador_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_nome_organizador_app" style="<?php echo $sStyleHidden_nome_organizador_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nome_organizador_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_nome_organizador_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_nome_organizador_app"><?php echo $this->nm_new_label['nome_organizador_app']; ?></span></td></tr><tr><td class="css_nome_organizador_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nome_organizador_app"]) &&  $this->nmgp_cmp_readonly["nome_organizador_app"] == "on") { 

 ?>
<input type="hidden" name="nome_organizador_app" value="<?php echo $this->form_encode_input($nome_organizador_app) . "\">" . $nome_organizador_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_nome_organizador_app" class="sc-ui-readonly-nome_organizador_app css_nome_organizador_app_line" style="<?php echo $sStyleReadLab_nome_organizador_app; ?>"><?php echo $this->form_format_readonly("nome_organizador_app", $this->form_encode_input($this->nome_organizador_app)); ?></span><span id="id_read_off_nome_organizador_app" class="css_read_off_nome_organizador_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nome_organizador_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_nome_organizador_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nome_organizador_app" type=text name="nome_organizador_app" value="<?php echo $this->form_encode_input($nome_organizador_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_organizador_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_organizador_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['email_organizador_app']))
    {
        $this->nm_new_label['email_organizador_app'] = "Email Organizador APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $email_organizador_app = $this->email_organizador_app;
   $sStyleHidden_email_organizador_app = '';
   if (isset($this->nmgp_cmp_hidden['email_organizador_app']) && $this->nmgp_cmp_hidden['email_organizador_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['email_organizador_app']);
       $sStyleHidden_email_organizador_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_email_organizador_app = 'display: none;';
   $sStyleReadInp_email_organizador_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['email_organizador_app']) && $this->nmgp_cmp_readonly['email_organizador_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['email_organizador_app']);
       $sStyleReadLab_email_organizador_app = '';
       $sStyleReadInp_email_organizador_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['email_organizador_app']) && $this->nmgp_cmp_hidden['email_organizador_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="email_organizador_app" value="<?php echo $this->form_encode_input($email_organizador_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_email_organizador_app" style="<?php echo $sStyleHidden_email_organizador_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_email_organizador_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_email_organizador_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_email_organizador_app"><?php echo $this->nm_new_label['email_organizador_app']; ?></span></td></tr><tr><td class="css_email_organizador_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["email_organizador_app"]) &&  $this->nmgp_cmp_readonly["email_organizador_app"] == "on") { 

 ?>
<input type="hidden" name="email_organizador_app" value="<?php echo $this->form_encode_input($email_organizador_app) . "\">" . $email_organizador_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_email_organizador_app" class="sc-ui-readonly-email_organizador_app css_email_organizador_app_line" style="<?php echo $sStyleReadLab_email_organizador_app; ?>"><?php echo $this->form_format_readonly("email_organizador_app", $this->form_encode_input($this->email_organizador_app)); ?></span><span id="id_read_off_email_organizador_app" class="css_read_off_email_organizador_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_email_organizador_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_email_organizador_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_email_organizador_app" type=text name="email_organizador_app" value="<?php echo $this->form_encode_input($email_organizador_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=70"; } ?> maxlength=100 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.email_organizador_app.value != '') {window.open('mailto:' + document.F1.email_organizador_app.value); }", "if (document.F1.email_organizador_app.value != '') {window.open('mailto:' + document.F1.email_organizador_app.value); }", "email_organizador_app_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_email_organizador_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_email_organizador_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nome_comprador_app']))
    {
        $this->nm_new_label['nome_comprador_app'] = "Nome Comprador APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nome_comprador_app = $this->nome_comprador_app;
   $sStyleHidden_nome_comprador_app = '';
   if (isset($this->nmgp_cmp_hidden['nome_comprador_app']) && $this->nmgp_cmp_hidden['nome_comprador_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nome_comprador_app']);
       $sStyleHidden_nome_comprador_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nome_comprador_app = 'display: none;';
   $sStyleReadInp_nome_comprador_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nome_comprador_app']) && $this->nmgp_cmp_readonly['nome_comprador_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nome_comprador_app']);
       $sStyleReadLab_nome_comprador_app = '';
       $sStyleReadInp_nome_comprador_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nome_comprador_app']) && $this->nmgp_cmp_hidden['nome_comprador_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nome_comprador_app" value="<?php echo $this->form_encode_input($nome_comprador_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_nome_comprador_app" style="<?php echo $sStyleHidden_nome_comprador_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nome_comprador_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_nome_comprador_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_nome_comprador_app"><?php echo $this->nm_new_label['nome_comprador_app']; ?></span></td></tr><tr><td class="css_nome_comprador_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nome_comprador_app"]) &&  $this->nmgp_cmp_readonly["nome_comprador_app"] == "on") { 

 ?>
<input type="hidden" name="nome_comprador_app" value="<?php echo $this->form_encode_input($nome_comprador_app) . "\">" . $nome_comprador_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_nome_comprador_app" class="sc-ui-readonly-nome_comprador_app css_nome_comprador_app_line" style="<?php echo $sStyleReadLab_nome_comprador_app; ?>"><?php echo $this->form_format_readonly("nome_comprador_app", $this->form_encode_input($this->nome_comprador_app)); ?></span><span id="id_read_off_nome_comprador_app" class="css_read_off_nome_comprador_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nome_comprador_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_nome_comprador_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nome_comprador_app" type=text name="nome_comprador_app" value="<?php echo $this->form_encode_input($nome_comprador_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_comprador_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_comprador_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['wz_suporte_app']))
    {
        $this->nm_new_label['wz_suporte_app'] = "Suporte Watsapp APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $wz_suporte_app = $this->wz_suporte_app;
   $sStyleHidden_wz_suporte_app = '';
   if (isset($this->nmgp_cmp_hidden['wz_suporte_app']) && $this->nmgp_cmp_hidden['wz_suporte_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['wz_suporte_app']);
       $sStyleHidden_wz_suporte_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_wz_suporte_app = 'display: none;';
   $sStyleReadInp_wz_suporte_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['wz_suporte_app']) && $this->nmgp_cmp_readonly['wz_suporte_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['wz_suporte_app']);
       $sStyleReadLab_wz_suporte_app = '';
       $sStyleReadInp_wz_suporte_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['wz_suporte_app']) && $this->nmgp_cmp_hidden['wz_suporte_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="wz_suporte_app" value="<?php echo $this->form_encode_input($wz_suporte_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_wz_suporte_app" style="<?php echo $sStyleHidden_wz_suporte_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_wz_suporte_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_wz_suporte_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_wz_suporte_app"><?php echo $this->nm_new_label['wz_suporte_app']; ?></span></td></tr><tr><td class="css_wz_suporte_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["wz_suporte_app"]) &&  $this->nmgp_cmp_readonly["wz_suporte_app"] == "on") { 

 ?>
<input type="hidden" name="wz_suporte_app" value="<?php echo $this->form_encode_input($wz_suporte_app) . "\">" . $wz_suporte_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_wz_suporte_app" class="sc-ui-readonly-wz_suporte_app css_wz_suporte_app_line" style="<?php echo $sStyleReadLab_wz_suporte_app; ?>"><?php echo $this->form_format_readonly("wz_suporte_app", $this->form_encode_input($this->wz_suporte_app)); ?></span><span id="id_read_off_wz_suporte_app" class="css_read_off_wz_suporte_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_wz_suporte_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_wz_suporte_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_wz_suporte_app" type=text name="wz_suporte_app" value="<?php echo $this->form_encode_input($wz_suporte_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=38 alt="{datatype: 'mask', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '+99 (99)99999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_wz_suporte_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_wz_suporte_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['gamificacao_ativada_app']))
   {
       $this->nm_new_label['gamificacao_ativada_app'] = "Gamificacao Ativada APP:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $gamificacao_ativada_app = $this->gamificacao_ativada_app;
   $sStyleHidden_gamificacao_ativada_app = '';
   if (isset($this->nmgp_cmp_hidden['gamificacao_ativada_app']) && $this->nmgp_cmp_hidden['gamificacao_ativada_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['gamificacao_ativada_app']);
       $sStyleHidden_gamificacao_ativada_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_gamificacao_ativada_app = 'display: none;';
   $sStyleReadInp_gamificacao_ativada_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['gamificacao_ativada_app']) && $this->nmgp_cmp_readonly['gamificacao_ativada_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['gamificacao_ativada_app']);
       $sStyleReadLab_gamificacao_ativada_app = '';
       $sStyleReadInp_gamificacao_ativada_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['gamificacao_ativada_app']) && $this->nmgp_cmp_hidden['gamificacao_ativada_app'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="gamificacao_ativada_app" value="<?php echo $this->form_encode_input($this->gamificacao_ativada_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_gamificacao_ativada_app" style="<?php echo $sStyleHidden_gamificacao_ativada_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_gamificacao_ativada_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_gamificacao_ativada_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_gamificacao_ativada_app"><?php echo $this->nm_new_label['gamificacao_ativada_app']; ?></span></td></tr><tr><td class="css_gamificacao_ativada_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["gamificacao_ativada_app"]) &&  $this->nmgp_cmp_readonly["gamificacao_ativada_app"] == "on") { 

$gamificacao_ativada_app_look = "";
 if ($this->gamificacao_ativada_app == "N") { $gamificacao_ativada_app_look .= "Não" ;} 
 if ($this->gamificacao_ativada_app == "Y") { $gamificacao_ativada_app_look .= "Sim" ;} 
 if (empty($gamificacao_ativada_app_look)) { $gamificacao_ativada_app_look = $this->gamificacao_ativada_app; }
?>
<input type="hidden" name="gamificacao_ativada_app" value="<?php echo $this->form_encode_input($gamificacao_ativada_app) . "\">" . $gamificacao_ativada_app_look . ""; ?>
<?php } else { ?>
<?php

$gamificacao_ativada_app_look = "";
 if ($this->gamificacao_ativada_app == "N") { $gamificacao_ativada_app_look .= "Não" ;} 
 if ($this->gamificacao_ativada_app == "Y") { $gamificacao_ativada_app_look .= "Sim" ;} 
 if (empty($gamificacao_ativada_app_look)) { $gamificacao_ativada_app_look = $this->gamificacao_ativada_app; }
?>
<span id="id_read_on_gamificacao_ativada_app" class="css_gamificacao_ativada_app_line"  style="<?php echo $sStyleReadLab_gamificacao_ativada_app; ?>"><?php echo $this->form_format_readonly("gamificacao_ativada_app", $this->form_encode_input($gamificacao_ativada_app_look)); ?></span><span id="id_read_off_gamificacao_ativada_app" class="css_read_off_gamificacao_ativada_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_gamificacao_ativada_app; ?>">
 <span id="idAjaxSelect_gamificacao_ativada_app" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_gamificacao_ativada_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_gamificacao_ativada_app" name="gamificacao_ativada_app" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->gamificacao_ativada_app == "N") { echo " selected" ;} ?><?php  if (empty($this->gamificacao_ativada_app)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_gamificacao_ativada_app'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->gamificacao_ativada_app == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_gamificacao_ativada_app'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_gamificacao_ativada_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_gamificacao_ativada_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['galeria_fotos_ativada_app']))
   {
       $this->nm_new_label['galeria_fotos_ativada_app'] = "Galeria Fotos Ativada APP:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $galeria_fotos_ativada_app = $this->galeria_fotos_ativada_app;
   $sStyleHidden_galeria_fotos_ativada_app = '';
   if (isset($this->nmgp_cmp_hidden['galeria_fotos_ativada_app']) && $this->nmgp_cmp_hidden['galeria_fotos_ativada_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['galeria_fotos_ativada_app']);
       $sStyleHidden_galeria_fotos_ativada_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_galeria_fotos_ativada_app = 'display: none;';
   $sStyleReadInp_galeria_fotos_ativada_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['galeria_fotos_ativada_app']) && $this->nmgp_cmp_readonly['galeria_fotos_ativada_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['galeria_fotos_ativada_app']);
       $sStyleReadLab_galeria_fotos_ativada_app = '';
       $sStyleReadInp_galeria_fotos_ativada_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['galeria_fotos_ativada_app']) && $this->nmgp_cmp_hidden['galeria_fotos_ativada_app'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="galeria_fotos_ativada_app" value="<?php echo $this->form_encode_input($this->galeria_fotos_ativada_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_galeria_fotos_ativada_app" style="<?php echo $sStyleHidden_galeria_fotos_ativada_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_galeria_fotos_ativada_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_galeria_fotos_ativada_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_galeria_fotos_ativada_app"><?php echo $this->nm_new_label['galeria_fotos_ativada_app']; ?></span></td></tr><tr><td class="css_galeria_fotos_ativada_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["galeria_fotos_ativada_app"]) &&  $this->nmgp_cmp_readonly["galeria_fotos_ativada_app"] == "on") { 

$galeria_fotos_ativada_app_look = "";
 if ($this->galeria_fotos_ativada_app == "Y") { $galeria_fotos_ativada_app_look .= "Sim" ;} 
 if ($this->galeria_fotos_ativada_app == "N") { $galeria_fotos_ativada_app_look .= "Não" ;} 
 if (empty($galeria_fotos_ativada_app_look)) { $galeria_fotos_ativada_app_look = $this->galeria_fotos_ativada_app; }
?>
<input type="hidden" name="galeria_fotos_ativada_app" value="<?php echo $this->form_encode_input($galeria_fotos_ativada_app) . "\">" . $galeria_fotos_ativada_app_look . ""; ?>
<?php } else { ?>
<?php

$galeria_fotos_ativada_app_look = "";
 if ($this->galeria_fotos_ativada_app == "Y") { $galeria_fotos_ativada_app_look .= "Sim" ;} 
 if ($this->galeria_fotos_ativada_app == "N") { $galeria_fotos_ativada_app_look .= "Não" ;} 
 if (empty($galeria_fotos_ativada_app_look)) { $galeria_fotos_ativada_app_look = $this->galeria_fotos_ativada_app; }
?>
<span id="id_read_on_galeria_fotos_ativada_app" class="css_galeria_fotos_ativada_app_line"  style="<?php echo $sStyleReadLab_galeria_fotos_ativada_app; ?>"><?php echo $this->form_format_readonly("galeria_fotos_ativada_app", $this->form_encode_input($galeria_fotos_ativada_app_look)); ?></span><span id="id_read_off_galeria_fotos_ativada_app" class="css_read_off_galeria_fotos_ativada_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_galeria_fotos_ativada_app; ?>">
 <span id="idAjaxSelect_galeria_fotos_ativada_app" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_galeria_fotos_ativada_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_galeria_fotos_ativada_app" name="galeria_fotos_ativada_app" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="Y" <?php  if ($this->galeria_fotos_ativada_app == "Y") { echo " selected" ;} ?><?php  if (empty($this->galeria_fotos_ativada_app)) { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_galeria_fotos_ativada_app'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->galeria_fotos_ativada_app == "N") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_galeria_fotos_ativada_app'][] = 'N'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_galeria_fotos_ativada_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_galeria_fotos_ativada_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['galeria_fotos_publicas_ativada_app']))
   {
       $this->nm_new_label['galeria_fotos_publicas_ativada_app'] = "Galeria Fotos Públicas Ativada APP:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $galeria_fotos_publicas_ativada_app = $this->galeria_fotos_publicas_ativada_app;
   $sStyleHidden_galeria_fotos_publicas_ativada_app = '';
   if (isset($this->nmgp_cmp_hidden['galeria_fotos_publicas_ativada_app']) && $this->nmgp_cmp_hidden['galeria_fotos_publicas_ativada_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['galeria_fotos_publicas_ativada_app']);
       $sStyleHidden_galeria_fotos_publicas_ativada_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_galeria_fotos_publicas_ativada_app = 'display: none;';
   $sStyleReadInp_galeria_fotos_publicas_ativada_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['galeria_fotos_publicas_ativada_app']) && $this->nmgp_cmp_readonly['galeria_fotos_publicas_ativada_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['galeria_fotos_publicas_ativada_app']);
       $sStyleReadLab_galeria_fotos_publicas_ativada_app = '';
       $sStyleReadInp_galeria_fotos_publicas_ativada_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['galeria_fotos_publicas_ativada_app']) && $this->nmgp_cmp_hidden['galeria_fotos_publicas_ativada_app'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="galeria_fotos_publicas_ativada_app" value="<?php echo $this->form_encode_input($this->galeria_fotos_publicas_ativada_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_galeria_fotos_publicas_ativada_app" style="<?php echo $sStyleHidden_galeria_fotos_publicas_ativada_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_galeria_fotos_publicas_ativada_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_galeria_fotos_publicas_ativada_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_galeria_fotos_publicas_ativada_app"><?php echo $this->nm_new_label['galeria_fotos_publicas_ativada_app']; ?></span></td></tr><tr><td class="css_galeria_fotos_publicas_ativada_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["galeria_fotos_publicas_ativada_app"]) &&  $this->nmgp_cmp_readonly["galeria_fotos_publicas_ativada_app"] == "on") { 

$galeria_fotos_publicas_ativada_app_look = "";
 if ($this->galeria_fotos_publicas_ativada_app == "N") { $galeria_fotos_publicas_ativada_app_look .= "Não" ;} 
 if ($this->galeria_fotos_publicas_ativada_app == "Y") { $galeria_fotos_publicas_ativada_app_look .= "Sim" ;} 
 if (empty($galeria_fotos_publicas_ativada_app_look)) { $galeria_fotos_publicas_ativada_app_look = $this->galeria_fotos_publicas_ativada_app; }
?>
<input type="hidden" name="galeria_fotos_publicas_ativada_app" value="<?php echo $this->form_encode_input($galeria_fotos_publicas_ativada_app) . "\">" . $galeria_fotos_publicas_ativada_app_look . ""; ?>
<?php } else { ?>
<?php

$galeria_fotos_publicas_ativada_app_look = "";
 if ($this->galeria_fotos_publicas_ativada_app == "N") { $galeria_fotos_publicas_ativada_app_look .= "Não" ;} 
 if ($this->galeria_fotos_publicas_ativada_app == "Y") { $galeria_fotos_publicas_ativada_app_look .= "Sim" ;} 
 if (empty($galeria_fotos_publicas_ativada_app_look)) { $galeria_fotos_publicas_ativada_app_look = $this->galeria_fotos_publicas_ativada_app; }
?>
<span id="id_read_on_galeria_fotos_publicas_ativada_app" class="css_galeria_fotos_publicas_ativada_app_line"  style="<?php echo $sStyleReadLab_galeria_fotos_publicas_ativada_app; ?>"><?php echo $this->form_format_readonly("galeria_fotos_publicas_ativada_app", $this->form_encode_input($galeria_fotos_publicas_ativada_app_look)); ?></span><span id="id_read_off_galeria_fotos_publicas_ativada_app" class="css_read_off_galeria_fotos_publicas_ativada_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_galeria_fotos_publicas_ativada_app; ?>">
 <span id="idAjaxSelect_galeria_fotos_publicas_ativada_app" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_galeria_fotos_publicas_ativada_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_galeria_fotos_publicas_ativada_app" name="galeria_fotos_publicas_ativada_app" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->galeria_fotos_publicas_ativada_app == "N") { echo " selected" ;} ?><?php  if (empty($this->galeria_fotos_publicas_ativada_app)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_galeria_fotos_publicas_ativada_app'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->galeria_fotos_publicas_ativada_app == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_galeria_fotos_publicas_ativada_app'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_galeria_fotos_publicas_ativada_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_galeria_fotos_publicas_ativada_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['chat_evento_ativado_app']))
   {
       $this->nm_new_label['chat_evento_ativado_app'] = "Chat Evento Ativado APP:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $chat_evento_ativado_app = $this->chat_evento_ativado_app;
   $sStyleHidden_chat_evento_ativado_app = '';
   if (isset($this->nmgp_cmp_hidden['chat_evento_ativado_app']) && $this->nmgp_cmp_hidden['chat_evento_ativado_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['chat_evento_ativado_app']);
       $sStyleHidden_chat_evento_ativado_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_chat_evento_ativado_app = 'display: none;';
   $sStyleReadInp_chat_evento_ativado_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['chat_evento_ativado_app']) && $this->nmgp_cmp_readonly['chat_evento_ativado_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['chat_evento_ativado_app']);
       $sStyleReadLab_chat_evento_ativado_app = '';
       $sStyleReadInp_chat_evento_ativado_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['chat_evento_ativado_app']) && $this->nmgp_cmp_hidden['chat_evento_ativado_app'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="chat_evento_ativado_app" value="<?php echo $this->form_encode_input($this->chat_evento_ativado_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_chat_evento_ativado_app" style="<?php echo $sStyleHidden_chat_evento_ativado_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_chat_evento_ativado_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_chat_evento_ativado_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_chat_evento_ativado_app"><?php echo $this->nm_new_label['chat_evento_ativado_app']; ?></span></td></tr><tr><td class="css_chat_evento_ativado_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["chat_evento_ativado_app"]) &&  $this->nmgp_cmp_readonly["chat_evento_ativado_app"] == "on") { 

$chat_evento_ativado_app_look = "";
 if ($this->chat_evento_ativado_app == "N") { $chat_evento_ativado_app_look .= "Não" ;} 
 if ($this->chat_evento_ativado_app == "Y") { $chat_evento_ativado_app_look .= "Sim" ;} 
 if (empty($chat_evento_ativado_app_look)) { $chat_evento_ativado_app_look = $this->chat_evento_ativado_app; }
?>
<input type="hidden" name="chat_evento_ativado_app" value="<?php echo $this->form_encode_input($chat_evento_ativado_app) . "\">" . $chat_evento_ativado_app_look . ""; ?>
<?php } else { ?>
<?php

$chat_evento_ativado_app_look = "";
 if ($this->chat_evento_ativado_app == "N") { $chat_evento_ativado_app_look .= "Não" ;} 
 if ($this->chat_evento_ativado_app == "Y") { $chat_evento_ativado_app_look .= "Sim" ;} 
 if (empty($chat_evento_ativado_app_look)) { $chat_evento_ativado_app_look = $this->chat_evento_ativado_app; }
?>
<span id="id_read_on_chat_evento_ativado_app" class="css_chat_evento_ativado_app_line"  style="<?php echo $sStyleReadLab_chat_evento_ativado_app; ?>"><?php echo $this->form_format_readonly("chat_evento_ativado_app", $this->form_encode_input($chat_evento_ativado_app_look)); ?></span><span id="id_read_off_chat_evento_ativado_app" class="css_read_off_chat_evento_ativado_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_chat_evento_ativado_app; ?>">
 <span id="idAjaxSelect_chat_evento_ativado_app" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_chat_evento_ativado_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_chat_evento_ativado_app" name="chat_evento_ativado_app" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->chat_evento_ativado_app == "N") { echo " selected" ;} ?><?php  if (empty($this->chat_evento_ativado_app)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_chat_evento_ativado_app'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->chat_evento_ativado_app == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_chat_evento_ativado_app'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_chat_evento_ativado_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_chat_evento_ativado_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cidade_destino_app']))
    {
        $this->nm_new_label['cidade_destino_app'] = "Cidade Destino APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cidade_destino_app = $this->cidade_destino_app;
   $sStyleHidden_cidade_destino_app = '';
   if (isset($this->nmgp_cmp_hidden['cidade_destino_app']) && $this->nmgp_cmp_hidden['cidade_destino_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cidade_destino_app']);
       $sStyleHidden_cidade_destino_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cidade_destino_app = 'display: none;';
   $sStyleReadInp_cidade_destino_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cidade_destino_app']) && $this->nmgp_cmp_readonly['cidade_destino_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cidade_destino_app']);
       $sStyleReadLab_cidade_destino_app = '';
       $sStyleReadInp_cidade_destino_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cidade_destino_app']) && $this->nmgp_cmp_hidden['cidade_destino_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cidade_destino_app" value="<?php echo $this->form_encode_input($cidade_destino_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cidade_destino_app" style="<?php echo $sStyleHidden_cidade_destino_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cidade_destino_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cidade_destino_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_cidade_destino_app"><?php echo $this->nm_new_label['cidade_destino_app']; ?></span></td></tr><tr><td class="css_cidade_destino_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cidade_destino_app"]) &&  $this->nmgp_cmp_readonly["cidade_destino_app"] == "on") { 

 ?>
<input type="hidden" name="cidade_destino_app" value="<?php echo $this->form_encode_input($cidade_destino_app) . "\">" . $cidade_destino_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_cidade_destino_app" class="sc-ui-readonly-cidade_destino_app css_cidade_destino_app_line" style="<?php echo $sStyleReadLab_cidade_destino_app; ?>"><?php echo $this->form_format_readonly("cidade_destino_app", $this->form_encode_input($this->cidade_destino_app)); ?></span><span id="id_read_off_cidade_destino_app" class="css_read_off_cidade_destino_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cidade_destino_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_cidade_destino_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cidade_destino_app" type=text name="cidade_destino_app" value="<?php echo $this->form_encode_input($cidade_destino_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cidade_destino_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cidade_destino_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['pais_destino_app']))
   {
       $this->nm_new_label['pais_destino_app'] = "Pais Destino APP:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $pais_destino_app = $this->pais_destino_app;
   $sStyleHidden_pais_destino_app = '';
   if (isset($this->nmgp_cmp_hidden['pais_destino_app']) && $this->nmgp_cmp_hidden['pais_destino_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['pais_destino_app']);
       $sStyleHidden_pais_destino_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_pais_destino_app = 'display: none;';
   $sStyleReadInp_pais_destino_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['pais_destino_app']) && $this->nmgp_cmp_readonly['pais_destino_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['pais_destino_app']);
       $sStyleReadLab_pais_destino_app = '';
       $sStyleReadInp_pais_destino_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['pais_destino_app']) && $this->nmgp_cmp_hidden['pais_destino_app'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="pais_destino_app" value="<?php echo $this->form_encode_input($this->pais_destino_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_pais_destino_app" style="<?php echo $sStyleHidden_pais_destino_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_pais_destino_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_pais_destino_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_pais_destino_app"><?php echo $this->nm_new_label['pais_destino_app']; ?></span></td></tr><tr><td class="css_pais_destino_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["pais_destino_app"]) &&  $this->nmgp_cmp_readonly["pais_destino_app"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app'] = array(); 
    }

   $old_value_evento_id = $this->evento_id;
   $old_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $old_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $old_value_evento_cep = $this->evento_cep;
   $old_value_evento_telefone = $this->evento_telefone;
   $old_value_evento_celular = $this->evento_celular;
   $old_value_data_conclusao_app = $this->data_conclusao_app;
   $old_value_wz_suporte_app = $this->wz_suporte_app;
   $old_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $old_value_data_partida_destino_app = $this->data_partida_destino_app;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_evento_id = $this->evento_id;
   $unformatted_value_evento_dt_realizacao = $this->evento_dt_realizacao;
   $unformatted_value_evento_dt_conclusao = $this->evento_dt_conclusao;
   $unformatted_value_evento_cep = $this->evento_cep;
   $unformatted_value_evento_telefone = $this->evento_telefone;
   $unformatted_value_evento_celular = $this->evento_celular;
   $unformatted_value_data_conclusao_app = $this->data_conclusao_app;
   $unformatted_value_wz_suporte_app = $this->wz_suporte_app;
   $unformatted_value_data_chegada_destino_app = $this->data_chegada_destino_app;
   $unformatted_value_data_partida_destino_app = $this->data_partida_destino_app;

   $nm_comando = "SELECT pais_id, descricao  FROM tbl_paises  ORDER BY descricao";

   $this->evento_id = $old_value_evento_id;
   $this->evento_dt_realizacao = $old_value_evento_dt_realizacao;
   $this->evento_dt_conclusao = $old_value_evento_dt_conclusao;
   $this->evento_cep = $old_value_evento_cep;
   $this->evento_telefone = $old_value_evento_telefone;
   $this->evento_celular = $old_value_evento_celular;
   $this->data_conclusao_app = $old_value_data_conclusao_app;
   $this->wz_suporte_app = $old_value_wz_suporte_app;
   $this->data_chegada_destino_app = $old_value_data_chegada_destino_app;
   $this->data_partida_destino_app = $old_value_data_partida_destino_app;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app'][] = $rs->fields[0];
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
   $pais_destino_app_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->pais_destino_app_1))
          {
              foreach ($this->pais_destino_app_1 as $tmp_pais_destino_app)
              {
                  if (trim($tmp_pais_destino_app) === trim($cadaselect[1])) {$pais_destino_app_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->pais_destino_app) && trim($this->pais_destino_app) === trim($cadaselect[1])) {$pais_destino_app_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="pais_destino_app" value="<?php echo $this->form_encode_input($pais_destino_app) . "\">" . $pais_destino_app_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_pais_destino_app();
   $x = 0 ; 
   $pais_destino_app_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->pais_destino_app_1))
          {
              foreach ($this->pais_destino_app_1 as $tmp_pais_destino_app)
              {
                  if (trim($tmp_pais_destino_app) === trim($cadaselect[1])) {$pais_destino_app_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->pais_destino_app)) {
                 if (trim($this->pais_destino_app) == trim($cadaselect[1])) { $pais_destino_app_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->pais_destino_app == $cadaselect[1]) { $pais_destino_app_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($pais_destino_app_look))
          {
              $pais_destino_app_look = $this->pais_destino_app;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_pais_destino_app\" class=\"css_pais_destino_app_line\" style=\"" .  $sStyleReadLab_pais_destino_app . "\">" . $this->form_format_readonly("pais_destino_app", $this->form_encode_input($pais_destino_app_look)) . "</span><span id=\"id_read_off_pais_destino_app\" class=\"css_read_off_pais_destino_app" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_pais_destino_app . "\">";
   echo " <span id=\"idAjaxSelect_pais_destino_app\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_pais_destino_app_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_pais_destino_app\" name=\"pais_destino_app\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_pais_destino_app'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;"," ") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->pais_destino_app) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->pais_destino_app)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_pais_destino_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_pais_destino_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['data_chegada_destino_app']))
    {
        $this->nm_new_label['data_chegada_destino_app'] = "Data Chegada Destino APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $data_chegada_destino_app = $this->data_chegada_destino_app;
   $sStyleHidden_data_chegada_destino_app = '';
   if (isset($this->nmgp_cmp_hidden['data_chegada_destino_app']) && $this->nmgp_cmp_hidden['data_chegada_destino_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['data_chegada_destino_app']);
       $sStyleHidden_data_chegada_destino_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_data_chegada_destino_app = 'display: none;';
   $sStyleReadInp_data_chegada_destino_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['data_chegada_destino_app']) && $this->nmgp_cmp_readonly['data_chegada_destino_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['data_chegada_destino_app']);
       $sStyleReadLab_data_chegada_destino_app = '';
       $sStyleReadInp_data_chegada_destino_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['data_chegada_destino_app']) && $this->nmgp_cmp_hidden['data_chegada_destino_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="data_chegada_destino_app" value="<?php echo $this->form_encode_input($data_chegada_destino_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_data_chegada_destino_app" style="<?php echo $sStyleHidden_data_chegada_destino_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_data_chegada_destino_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_data_chegada_destino_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_data_chegada_destino_app"><?php echo $this->nm_new_label['data_chegada_destino_app']; ?></span></td></tr><tr><td class="css_data_chegada_destino_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["data_chegada_destino_app"]) &&  $this->nmgp_cmp_readonly["data_chegada_destino_app"] == "on") { 

 ?>
<input type="hidden" name="data_chegada_destino_app" value="<?php echo $this->form_encode_input($data_chegada_destino_app) . "\">" . $data_chegada_destino_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_data_chegada_destino_app" class="sc-ui-readonly-data_chegada_destino_app css_data_chegada_destino_app_line" style="<?php echo $sStyleReadLab_data_chegada_destino_app; ?>"><?php echo $this->form_format_readonly("data_chegada_destino_app", $this->form_encode_input($data_chegada_destino_app)); ?></span><span id="id_read_off_data_chegada_destino_app" class="css_read_off_data_chegada_destino_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_data_chegada_destino_app; ?>"><?php
$tmp_form_data = $this->field_config['data_chegada_destino_app']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_data_chegada_destino_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_data_chegada_destino_app" type=text name="data_chegada_destino_app" value="<?php echo $this->form_encode_input($data_chegada_destino_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['data_chegada_destino_app']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['data_chegada_destino_app']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_data_chegada_destino_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_data_chegada_destino_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['data_partida_destino_app']))
    {
        $this->nm_new_label['data_partida_destino_app'] = "Data Partida Destino APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $data_partida_destino_app = $this->data_partida_destino_app;
   $sStyleHidden_data_partida_destino_app = '';
   if (isset($this->nmgp_cmp_hidden['data_partida_destino_app']) && $this->nmgp_cmp_hidden['data_partida_destino_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['data_partida_destino_app']);
       $sStyleHidden_data_partida_destino_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_data_partida_destino_app = 'display: none;';
   $sStyleReadInp_data_partida_destino_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['data_partida_destino_app']) && $this->nmgp_cmp_readonly['data_partida_destino_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['data_partida_destino_app']);
       $sStyleReadLab_data_partida_destino_app = '';
       $sStyleReadInp_data_partida_destino_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['data_partida_destino_app']) && $this->nmgp_cmp_hidden['data_partida_destino_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="data_partida_destino_app" value="<?php echo $this->form_encode_input($data_partida_destino_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_data_partida_destino_app" style="<?php echo $sStyleHidden_data_partida_destino_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_data_partida_destino_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_data_partida_destino_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_data_partida_destino_app"><?php echo $this->nm_new_label['data_partida_destino_app']; ?></span></td></tr><tr><td class="css_data_partida_destino_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["data_partida_destino_app"]) &&  $this->nmgp_cmp_readonly["data_partida_destino_app"] == "on") { 

 ?>
<input type="hidden" name="data_partida_destino_app" value="<?php echo $this->form_encode_input($data_partida_destino_app) . "\">" . $data_partida_destino_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_data_partida_destino_app" class="sc-ui-readonly-data_partida_destino_app css_data_partida_destino_app_line" style="<?php echo $sStyleReadLab_data_partida_destino_app; ?>"><?php echo $this->form_format_readonly("data_partida_destino_app", $this->form_encode_input($data_partida_destino_app)); ?></span><span id="id_read_off_data_partida_destino_app" class="css_read_off_data_partida_destino_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_data_partida_destino_app; ?>"><?php
$tmp_form_data = $this->field_config['data_partida_destino_app']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_data_partida_destino_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_data_partida_destino_app" type=text name="data_partida_destino_app" value="<?php echo $this->form_encode_input($data_partida_destino_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['data_partida_destino_app']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['data_partida_destino_app']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_data_partida_destino_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_data_partida_destino_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['texto_email_convite_app']))
    {
        $this->nm_new_label['texto_email_convite_app'] = "Texto Email Convite APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $texto_email_convite_app = $this->texto_email_convite_app;
   $sStyleHidden_texto_email_convite_app = '';
   if (isset($this->nmgp_cmp_hidden['texto_email_convite_app']) && $this->nmgp_cmp_hidden['texto_email_convite_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['texto_email_convite_app']);
       $sStyleHidden_texto_email_convite_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_texto_email_convite_app = 'display: none;';
   $sStyleReadInp_texto_email_convite_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['texto_email_convite_app']) && $this->nmgp_cmp_readonly['texto_email_convite_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['texto_email_convite_app']);
       $sStyleReadLab_texto_email_convite_app = '';
       $sStyleReadInp_texto_email_convite_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['texto_email_convite_app']) && $this->nmgp_cmp_hidden['texto_email_convite_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="texto_email_convite_app" value="<?php echo $this->form_encode_input($texto_email_convite_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_texto_email_convite_app" style="<?php echo $sStyleHidden_texto_email_convite_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_texto_email_convite_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_texto_email_convite_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_texto_email_convite_app"><?php echo $this->nm_new_label['texto_email_convite_app']; ?></span></td></tr><tr><td class="css_texto_email_convite_app_line" style="padding: 0px; width: 100%;">
<?php
$texto_email_convite_app_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($texto_email_convite_app));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["texto_email_convite_app"]) &&  $this->nmgp_cmp_readonly["texto_email_convite_app"] == "on") { 

 ?>
<input type="hidden" name="texto_email_convite_app" value="<?php echo $this->form_encode_input($texto_email_convite_app) . "\">" . $texto_email_convite_app_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_texto_email_convite_app" class="sc-ui-readonly-texto_email_convite_app css_texto_email_convite_app_line" style="<?php echo $sStyleReadLab_texto_email_convite_app; ?>"><?php echo $this->form_format_readonly("texto_email_convite_app", $this->form_encode_input($texto_email_convite_app_val)); ?></span><span id="id_read_off_texto_email_convite_app" class="css_read_off_texto_email_convite_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_texto_email_convite_app; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_texto_email_convite_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="texto_email_convite_app" id="id_sc_field_texto_email_convite_app" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $texto_email_convite_app; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_texto_email_convite_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_texto_email_convite_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['texto_whatsapp_convite_app']))
    {
        $this->nm_new_label['texto_whatsapp_convite_app'] = "Texto Whatsapp Convite APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $texto_whatsapp_convite_app = $this->texto_whatsapp_convite_app;
   $sStyleHidden_texto_whatsapp_convite_app = '';
   if (isset($this->nmgp_cmp_hidden['texto_whatsapp_convite_app']) && $this->nmgp_cmp_hidden['texto_whatsapp_convite_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['texto_whatsapp_convite_app']);
       $sStyleHidden_texto_whatsapp_convite_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_texto_whatsapp_convite_app = 'display: none;';
   $sStyleReadInp_texto_whatsapp_convite_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['texto_whatsapp_convite_app']) && $this->nmgp_cmp_readonly['texto_whatsapp_convite_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['texto_whatsapp_convite_app']);
       $sStyleReadLab_texto_whatsapp_convite_app = '';
       $sStyleReadInp_texto_whatsapp_convite_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['texto_whatsapp_convite_app']) && $this->nmgp_cmp_hidden['texto_whatsapp_convite_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="texto_whatsapp_convite_app" value="<?php echo $this->form_encode_input($texto_whatsapp_convite_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_texto_whatsapp_convite_app" style="<?php echo $sStyleHidden_texto_whatsapp_convite_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_texto_whatsapp_convite_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_texto_whatsapp_convite_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_texto_whatsapp_convite_app"><?php echo $this->nm_new_label['texto_whatsapp_convite_app']; ?></span></td></tr><tr><td class="css_texto_whatsapp_convite_app_line" style="padding: 0px; width: 100%;">
<?php
$texto_whatsapp_convite_app_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($texto_whatsapp_convite_app));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["texto_whatsapp_convite_app"]) &&  $this->nmgp_cmp_readonly["texto_whatsapp_convite_app"] == "on") { 

 ?>
<input type="hidden" name="texto_whatsapp_convite_app" value="<?php echo $this->form_encode_input($texto_whatsapp_convite_app) . "\">" . $texto_whatsapp_convite_app_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_texto_whatsapp_convite_app" class="sc-ui-readonly-texto_whatsapp_convite_app css_texto_whatsapp_convite_app_line" style="<?php echo $sStyleReadLab_texto_whatsapp_convite_app; ?>"><?php echo $this->form_format_readonly("texto_whatsapp_convite_app", $this->form_encode_input($texto_whatsapp_convite_app_val)); ?></span><span id="id_read_off_texto_whatsapp_convite_app" class="css_read_off_texto_whatsapp_convite_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_texto_whatsapp_convite_app; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_texto_whatsapp_convite_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="texto_whatsapp_convite_app" id="id_sc_field_texto_whatsapp_convite_app" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $texto_whatsapp_convite_app; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_texto_whatsapp_convite_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_texto_whatsapp_convite_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['termos_condicoes_app']))
    {
        $this->nm_new_label['termos_condicoes_app'] = "Termos e Condições APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $termos_condicoes_app = $this->termos_condicoes_app;
   $sStyleHidden_termos_condicoes_app = '';
   if (isset($this->nmgp_cmp_hidden['termos_condicoes_app']) && $this->nmgp_cmp_hidden['termos_condicoes_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['termos_condicoes_app']);
       $sStyleHidden_termos_condicoes_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_termos_condicoes_app = 'display: none;';
   $sStyleReadInp_termos_condicoes_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['termos_condicoes_app']) && $this->nmgp_cmp_readonly['termos_condicoes_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['termos_condicoes_app']);
       $sStyleReadLab_termos_condicoes_app = '';
       $sStyleReadInp_termos_condicoes_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['termos_condicoes_app']) && $this->nmgp_cmp_hidden['termos_condicoes_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="termos_condicoes_app" value="<?php echo $this->form_encode_input($termos_condicoes_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_termos_condicoes_app" style="<?php echo $sStyleHidden_termos_condicoes_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_termos_condicoes_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_termos_condicoes_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_termos_condicoes_app"><?php echo $this->nm_new_label['termos_condicoes_app']; ?></span></td></tr><tr><td class="css_termos_condicoes_app_line" style="padding: 0px; width: 100%;">
<?php
$termos_condicoes_app_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($termos_condicoes_app));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["termos_condicoes_app"]) &&  $this->nmgp_cmp_readonly["termos_condicoes_app"] == "on") { 

 ?>
<input type="hidden" name="termos_condicoes_app" value="<?php echo $this->form_encode_input($termos_condicoes_app) . "\">" . $termos_condicoes_app_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_termos_condicoes_app" class="sc-ui-readonly-termos_condicoes_app css_termos_condicoes_app_line" style="<?php echo $sStyleReadLab_termos_condicoes_app; ?>"><?php echo $this->form_format_readonly("termos_condicoes_app", $this->form_encode_input($termos_condicoes_app_val)); ?></span><span id="id_read_off_termos_condicoes_app" class="css_read_off_termos_condicoes_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_termos_condicoes_app; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_termos_condicoes_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="termos_condicoes_app" id="id_sc_field_termos_condicoes_app" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $termos_condicoes_app; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_termos_condicoes_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_termos_condicoes_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['canal_preferencial_convite_app']))
   {
       $this->nm_new_label['canal_preferencial_convite_app'] = "Canal Preferencial Convite APP:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $canal_preferencial_convite_app = $this->canal_preferencial_convite_app;
   $sStyleHidden_canal_preferencial_convite_app = '';
   if (isset($this->nmgp_cmp_hidden['canal_preferencial_convite_app']) && $this->nmgp_cmp_hidden['canal_preferencial_convite_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['canal_preferencial_convite_app']);
       $sStyleHidden_canal_preferencial_convite_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_canal_preferencial_convite_app = 'display: none;';
   $sStyleReadInp_canal_preferencial_convite_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['canal_preferencial_convite_app']) && $this->nmgp_cmp_readonly['canal_preferencial_convite_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['canal_preferencial_convite_app']);
       $sStyleReadLab_canal_preferencial_convite_app = '';
       $sStyleReadInp_canal_preferencial_convite_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['canal_preferencial_convite_app']) && $this->nmgp_cmp_hidden['canal_preferencial_convite_app'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="canal_preferencial_convite_app" value="<?php echo $this->form_encode_input($this->canal_preferencial_convite_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_canal_preferencial_convite_app" style="<?php echo $sStyleHidden_canal_preferencial_convite_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_canal_preferencial_convite_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_canal_preferencial_convite_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_canal_preferencial_convite_app"><?php echo $this->nm_new_label['canal_preferencial_convite_app']; ?></span></td></tr><tr><td class="css_canal_preferencial_convite_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["canal_preferencial_convite_app"]) &&  $this->nmgp_cmp_readonly["canal_preferencial_convite_app"] == "on") { 

$canal_preferencial_convite_app_look = "";
 if ($this->canal_preferencial_convite_app == "Y") { $canal_preferencial_convite_app_look .= "whatsapp" ;} 
 if ($this->canal_preferencial_convite_app == "N") { $canal_preferencial_convite_app_look .= "E-mail" ;} 
 if (empty($canal_preferencial_convite_app_look)) { $canal_preferencial_convite_app_look = $this->canal_preferencial_convite_app; }
?>
<input type="hidden" name="canal_preferencial_convite_app" value="<?php echo $this->form_encode_input($canal_preferencial_convite_app) . "\">" . $canal_preferencial_convite_app_look . ""; ?>
<?php } else { ?>
<?php

$canal_preferencial_convite_app_look = "";
 if ($this->canal_preferencial_convite_app == "Y") { $canal_preferencial_convite_app_look .= "whatsapp" ;} 
 if ($this->canal_preferencial_convite_app == "N") { $canal_preferencial_convite_app_look .= "E-mail" ;} 
 if (empty($canal_preferencial_convite_app_look)) { $canal_preferencial_convite_app_look = $this->canal_preferencial_convite_app; }
?>
<span id="id_read_on_canal_preferencial_convite_app" class="css_canal_preferencial_convite_app_line"  style="<?php echo $sStyleReadLab_canal_preferencial_convite_app; ?>"><?php echo $this->form_format_readonly("canal_preferencial_convite_app", $this->form_encode_input($canal_preferencial_convite_app_look)); ?></span><span id="id_read_off_canal_preferencial_convite_app" class="css_read_off_canal_preferencial_convite_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_canal_preferencial_convite_app; ?>">
 <span id="idAjaxSelect_canal_preferencial_convite_app" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_canal_preferencial_convite_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_canal_preferencial_convite_app" name="canal_preferencial_convite_app" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="Y" <?php  if ($this->canal_preferencial_convite_app == "Y") { echo " selected" ;} ?><?php  if (empty($this->canal_preferencial_convite_app)) { echo " selected" ;} ?>>whatsapp</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_canal_preferencial_convite_app'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->canal_preferencial_convite_app == "N") { echo " selected" ;} ?>>E-mail</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['Lookup_canal_preferencial_convite_app'][] = 'N'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_canal_preferencial_convite_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_canal_preferencial_convite_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </td></tr></table>
   </tr>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['birpara'];
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
              $obj_sel = ($this->sc_max_reg == '1') ? " selected" : "";
?> 
           <option value="1" <?php echo $obj_sel ?>>1</option>
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['first'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-25';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-26';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['back'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bretorna", "scBtnFn_sys_format_ret()", "scBtnFn_sys_format_ret()", "sc_b_ret_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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
        $buttonMacroDisabled = 'sc-unique-btn-27';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-28';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['btn_label']['last'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bfinal", "scBtnFn_sys_format_fim()", "scBtnFn_sys_format_fim()", "sc_b_fim_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
<?php
      $Tzone = ini_get('date.timezone');
      if (empty($Tzone))
      {
?>
<script> 
  _scAjaxShowMessage({title: '', message: "<?php echo $this->Ini->Nm_lang['lang_errm_tz']; ?>", isModal: false, timeout: 0, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: true, showBodyIcon: false, isToast: false, toastPos: ""});
</script> 
<?php
      }
?>
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0,1,2,3);

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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_eventos_rsvp_mob");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_eventos_rsvp_mob");
 parent.scAjaxDetailHeight("form_eventos_rsvp_mob", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_eventos_rsvp_mob", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_eventos_rsvp_mob", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['sc_modal'])
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
                if ($("#sc_b_new_t.sc-unique-btn-15").length && $("#sc_b_new_t.sc-unique-btn-15").is(":visible")) {
                    if ($("#sc_b_new_t.sc-unique-btn-15").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('novo');
                         return;
                }
                if ($("#sc_b_ins_t.sc-unique-btn-16").length && $("#sc_b_ins_t.sc-unique-btn-16").is(":visible")) {
                    if ($("#sc_b_ins_t.sc-unique-btn-16").hasClass("disabled")) {
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
                if ($("#sc_b_sai_t.sc-unique-btn-17").length && $("#sc_b_sai_t.sc-unique-btn-17").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-17").hasClass("disabled")) {
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
                if ($("#sc_b_upd_t.sc-unique-btn-18").length && $("#sc_b_upd_t.sc-unique-btn-18").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-18").hasClass("disabled")) {
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
                if ($("#sc_b_del_t.sc-unique-btn-19").length && $("#sc_b_del_t.sc-unique-btn-19").is(":visible")) {
                    if ($("#sc_b_del_t.sc-unique-btn-19").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('excluir');
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
                if ($("#sc_b_sai_t.sc-unique-btn-20").length && $("#sc_b_sai_t.sc-unique-btn-20").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-20").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-21").length && $("#sc_b_sai_t.sc-unique-btn-21").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-21").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-22").length && $("#sc_b_sai_t.sc-unique-btn-22").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-22").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-23").length && $("#sc_b_sai_t.sc-unique-btn-23").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-23").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                         return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-24").length && $("#sc_b_sai_t.sc-unique-btn-24").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-24").hasClass("disabled")) {
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
                if ($("#sc_b_ini_b.sc-unique-btn-25").length && $("#sc_b_ini_b.sc-unique-btn-25").is(":visible")) {
                    if ($("#sc_b_ini_b.sc-unique-btn-25").hasClass("disabled")) {
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
                if ($("#sc_b_ret_b.sc-unique-btn-26").length && $("#sc_b_ret_b.sc-unique-btn-26").is(":visible")) {
                    if ($("#sc_b_ret_b.sc-unique-btn-26").hasClass("disabled")) {
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
                if ($("#sc_b_avc_b.sc-unique-btn-27").length && $("#sc_b_avc_b.sc-unique-btn-27").is(":visible")) {
                    if ($("#sc_b_avc_b.sc-unique-btn-27").hasClass("disabled")) {
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
                if ($("#sc_b_fim_b.sc-unique-btn-28").length && $("#sc_b_fim_b.sc-unique-btn-28").is(":visible")) {
                    if ($("#sc_b_fim_b.sc-unique-btn-28").hasClass("disabled")) {
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
<span id="sc-id-mobile-out"><?php echo $this->Ini->Nm_lang['lang_version_web']; ?></span>
<?php
       }
?>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_rsvp_mob']['inside_nested_iframe']) {
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
