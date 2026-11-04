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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("RSVP - Opcionais Inclusão"); } else { echo strip_tags("RSVP - Opcionais Alteração"); } ?></TITLE>
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/viewerjs/viewer.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/viewerjs/viewer.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
    <style type="text/css">
        .sc-form-order-icon {
            padding: 0 2px;
        }
    </style>
<?php
           $formOrderUnusedVisivility = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? 'visible' : 'hidden';
           $formOrderUnusedOpacity = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? '0.5' : '1';
?>
    <style>
        .sc-form-order-icon-unused {
            visibility: <?php echo $formOrderUnusedVisivility ?>;
            opacity: 0.5;
        }
        .scFormLabelOddMult:hover .sc-form-order-icon-unused {
            visibility: visible;
            opacity: <?php echo $formOrderUnusedOpacity ?>;
        }
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
.css_read_off_opc_modificado_em button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_opc_hotel_dt01 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_opc_hotel_dt02 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_opc_seguro_dt01 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_opc_seguro_dt02 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_opc_city_data button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_opc_locacao_dt01 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_opc_locacao_dt02 button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_eventos_opcionais_rsvp/form_eventos_opcionais_rsvp_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_eventos_opcionais_rsvp_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_eventos_opcionais_rsvp_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['recarga'];
}
if ('' != $this->participante_nome)
{
    $this->lookup_participante_nome($look_rpc_participante_nome);
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['link_info']['remove_border']) {
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
 include_once("form_eventos_opcionais_rsvp_js0.php");
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
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_eventos_opcionais_rsvp'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_eventos_opcionais_rsvp'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  $this->Tab_width = "  width=\"40%\"";
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['fast_search'][2] : "";
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
          $SC_Label_atu['opc_id'] = (isset($this->nm_new_label['opc_id'])) ? $this->nm_new_label['opc_id'] : 'Cód. Opcional:'; 
          $SC_Label_atu['opc_tipo_id'] = (isset($this->nm_new_label['opc_tipo_id'])) ? $this->nm_new_label['opc_tipo_id'] : 'Tipo:'; 
          $SC_Label_atu['opc_fornecedor_id'] = (isset($this->nm_new_label['opc_fornecedor_id'])) ? $this->nm_new_label['opc_fornecedor_id'] : 'Fornecedor (outros):'; 
          $SC_Label_atu['opc_cpf_participante'] = (isset($this->nm_new_label['opc_cpf_participante'])) ? $this->nm_new_label['opc_cpf_participante'] : 'Cód. Participante:'; 
          $SC_Label_atu['opc_status'] = (isset($this->nm_new_label['opc_status'])) ? $this->nm_new_label['opc_status'] : 'Status:'; 
          $SC_Label_atu['opc_modificado_em'] = (isset($this->nm_new_label['opc_modificado_em'])) ? $this->nm_new_label['opc_modificado_em'] : 'Modificado Em:'; 
          $SC_Label_atu['opc_hotel_dt01'] = (isset($this->nm_new_label['opc_hotel_dt01'])) ? $this->nm_new_label['opc_hotel_dt01'] : 'Data Incial:'; 
          $SC_Label_atu['opc_hotel_dt02'] = (isset($this->nm_new_label['opc_hotel_dt02'])) ? $this->nm_new_label['opc_hotel_dt02'] : 'Data Final:'; 
          $SC_Label_atu['opc_hotel_obs'] = (isset($this->nm_new_label['opc_hotel_obs'])) ? $this->nm_new_label['opc_hotel_obs'] : 'Observações:'; 
          $SC_Label_atu['opc_seguro_dt01'] = (isset($this->nm_new_label['opc_seguro_dt01'])) ? $this->nm_new_label['opc_seguro_dt01'] : 'Data Inicial:'; 
          $SC_Label_atu['opc_seguro_dt02'] = (isset($this->nm_new_label['opc_seguro_dt02'])) ? $this->nm_new_label['opc_seguro_dt02'] : 'Data Final:'; 
          $SC_Label_atu['opc_seguro_voucher'] = (isset($this->nm_new_label['opc_seguro_voucher'])) ? $this->nm_new_label['opc_seguro_voucher'] : 'Voucher:'; 
          $SC_Label_atu['opc_seguro_obs'] = (isset($this->nm_new_label['opc_seguro_obs'])) ? $this->nm_new_label['opc_seguro_obs'] : 'Observações:'; 
          $SC_Label_atu['opc_city_data'] = (isset($this->nm_new_label['opc_city_data'])) ? $this->nm_new_label['opc_city_data'] : 'Data:'; 
          $SC_Label_atu['opc_city_obs'] = (isset($this->nm_new_label['opc_city_obs'])) ? $this->nm_new_label['opc_city_obs'] : 'Observações:'; 
          $SC_Label_atu['opc_locacao_tipo'] = (isset($this->nm_new_label['opc_locacao_tipo'])) ? $this->nm_new_label['opc_locacao_tipo'] : 'Locação Tipo:'; 
          $SC_Label_atu['opc_locacao_dt01'] = (isset($this->nm_new_label['opc_locacao_dt01'])) ? $this->nm_new_label['opc_locacao_dt01'] : 'Data Incial:'; 
          $SC_Label_atu['opc_locacao_dt02'] = (isset($this->nm_new_label['opc_locacao_dt02'])) ? $this->nm_new_label['opc_locacao_dt02'] : 'Data Final:'; 
          $SC_Label_atu['opc_locacao_obs'] = (isset($this->nm_new_label['opc_locacao_obs'])) ? $this->nm_new_label['opc_locacao_obs'] : 'Observações:'; 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Delete)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
   if (!isset($this->nmgp_cmp_hidden['cpf_del']))
   {
       $this->nmgp_cmp_hidden['cpf_del'] = 'off';
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
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['opc_id']))
           {
               $this->nmgp_cmp_readonly['opc_id'] = 'on';
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
}
</script>
<ul class="scTabLine">
<li id="id_tabs_0_0" class="scTabActive"><a href="javascript: sc_control_tabs_0(0)">Opcionais</a></li>
<li id="id_tabs_0_1" class="scTabInactive"><a href="javascript: sc_control_tabs_0(1)">Hotel</a></li>
<li id="id_tabs_0_2" class="scTabInactive"><a href="javascript: sc_control_tabs_0(2)">Seguro</a></li>
<li id="id_tabs_0_3" class="scTabInactive"><a href="javascript: sc_control_tabs_0(3)">City Tour</a></li>
<li id="id_tabs_0_4" class="scTabInactive"><a href="javascript: sc_control_tabs_0(4)">Locação</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_id']))
    {
        $this->nm_new_label['opc_id'] = "Cód. Opcional:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_id = $this->opc_id;
   $sStyleHidden_opc_id = '';
   if (isset($this->nmgp_cmp_hidden['opc_id']) && $this->nmgp_cmp_hidden['opc_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_id']);
       $sStyleHidden_opc_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_id = 'display: none;';
   $sStyleReadInp_opc_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["opc_id"]) &&  $this->nmgp_cmp_readonly["opc_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_id']);
       $sStyleReadLab_opc_id = '';
       $sStyleReadInp_opc_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_id']) && $this->nmgp_cmp_hidden['opc_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_id" value="<?php echo $this->form_encode_input($opc_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_id_label" id="hidden_field_label_opc_id" style="<?php echo $sStyleHidden_opc_id; ?>"><span id="id_label_opc_id"><?php echo $this->nm_new_label['opc_id']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_id_line" id="hidden_field_data_opc_id" style="<?php echo $sStyleHidden_opc_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_id_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_opc_id" class="css_opc_id_line" style="<?php echo $sStyleReadLab_opc_id; ?>"><?php echo $this->form_format_readonly("opc_id", $this->form_encode_input($this->opc_id)); ?></span><span id="id_read_off_opc_id" class="css_read_off_opc_id" style="<?php echo $sStyleReadInp_opc_id; ?>"><input type="hidden" name="opc_id" value="<?php echo $this->form_encode_input($opc_id) . "\">"?><span id="id_ajax_label_opc_id"><?php echo nl2br($opc_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_id_text"></span></td></tr></table></td></tr></table></TD>
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
   if (!isset($this->nm_new_label['opc_tipo_id']))
   {
       $this->nm_new_label['opc_tipo_id'] = "Tipo:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_tipo_id = $this->opc_tipo_id;
   $sStyleHidden_opc_tipo_id = '';
   if (isset($this->nmgp_cmp_hidden['opc_tipo_id']) && $this->nmgp_cmp_hidden['opc_tipo_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_tipo_id']);
       $sStyleHidden_opc_tipo_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_tipo_id = 'display: none;';
   $sStyleReadInp_opc_tipo_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_tipo_id']) && $this->nmgp_cmp_readonly['opc_tipo_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_tipo_id']);
       $sStyleReadLab_opc_tipo_id = '';
       $sStyleReadInp_opc_tipo_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_tipo_id']) && $this->nmgp_cmp_hidden['opc_tipo_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="opc_tipo_id" value="<?php echo $this->form_encode_input($this->opc_tipo_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_tipo_id_label" id="hidden_field_label_opc_tipo_id" style="<?php echo $sStyleHidden_opc_tipo_id; ?>"><span id="id_label_opc_tipo_id"><?php echo $this->nm_new_label['opc_tipo_id']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['php_cmp_required']['opc_tipo_id']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['php_cmp_required']['opc_tipo_id'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_opc_tipo_id_line" id="hidden_field_data_opc_tipo_id" style="<?php echo $sStyleHidden_opc_tipo_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_tipo_id_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_tipo_id"]) &&  $this->nmgp_cmp_readonly["opc_tipo_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id'] = array(); 
    }

   $old_value_opc_id = $this->opc_id;
   $old_value_opc_modificado_em = $this->opc_modificado_em;
   $old_value_opc_modificado_em_hora = $this->opc_modificado_em_hora;
   $old_value_opc_hotel_dt01 = $this->opc_hotel_dt01;
   $old_value_opc_hotel_dt02 = $this->opc_hotel_dt02;
   $old_value_opc_seguro_dt01 = $this->opc_seguro_dt01;
   $old_value_opc_seguro_dt02 = $this->opc_seguro_dt02;
   $old_value_opc_city_data = $this->opc_city_data;
   $old_value_opc_locacao_dt01 = $this->opc_locacao_dt01;
   $old_value_opc_locacao_dt02 = $this->opc_locacao_dt02;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_opc_id = $this->opc_id;
   $unformatted_value_opc_modificado_em = $this->opc_modificado_em;
   $unformatted_value_opc_modificado_em_hora = $this->opc_modificado_em_hora;
   $unformatted_value_opc_hotel_dt01 = $this->opc_hotel_dt01;
   $unformatted_value_opc_hotel_dt02 = $this->opc_hotel_dt02;
   $unformatted_value_opc_seguro_dt01 = $this->opc_seguro_dt01;
   $unformatted_value_opc_seguro_dt02 = $this->opc_seguro_dt02;
   $unformatted_value_opc_city_data = $this->opc_city_data;
   $unformatted_value_opc_locacao_dt01 = $this->opc_locacao_dt01;
   $unformatted_value_opc_locacao_dt02 = $this->opc_locacao_dt02;

   $nm_comando = "SELECT opcionais_id, opcionais_descricao  FROM tbl_opcionais  ORDER BY opcionais_descricao";

   $this->opc_id = $old_value_opc_id;
   $this->opc_modificado_em = $old_value_opc_modificado_em;
   $this->opc_modificado_em_hora = $old_value_opc_modificado_em_hora;
   $this->opc_hotel_dt01 = $old_value_opc_hotel_dt01;
   $this->opc_hotel_dt02 = $old_value_opc_hotel_dt02;
   $this->opc_seguro_dt01 = $old_value_opc_seguro_dt01;
   $this->opc_seguro_dt02 = $old_value_opc_seguro_dt02;
   $this->opc_city_data = $old_value_opc_city_data;
   $this->opc_locacao_dt01 = $old_value_opc_locacao_dt01;
   $this->opc_locacao_dt02 = $old_value_opc_locacao_dt02;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id'][] = $rs->fields[0];
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
   $opc_tipo_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->opc_tipo_id_1))
          {
              foreach ($this->opc_tipo_id_1 as $tmp_opc_tipo_id)
              {
                  if (trim($tmp_opc_tipo_id) === trim($cadaselect[1])) {$opc_tipo_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->opc_tipo_id) && trim($this->opc_tipo_id) === trim($cadaselect[1])) {$opc_tipo_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="opc_tipo_id" value="<?php echo $this->form_encode_input($opc_tipo_id) . "\">" . $opc_tipo_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_opc_tipo_id();
   $x = 0 ; 
   $opc_tipo_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->opc_tipo_id_1))
          {
              foreach ($this->opc_tipo_id_1 as $tmp_opc_tipo_id)
              {
                  if (trim($tmp_opc_tipo_id) === trim($cadaselect[1])) {$opc_tipo_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->opc_tipo_id)) {
                 if (trim($this->opc_tipo_id) == trim($cadaselect[1])) { $opc_tipo_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->opc_tipo_id == $cadaselect[1]) { $opc_tipo_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($opc_tipo_id_look))
          {
              $opc_tipo_id_look = $this->opc_tipo_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_opc_tipo_id\" class=\"css_opc_tipo_id_line\" style=\"" .  $sStyleReadLab_opc_tipo_id . "\">" . $this->form_format_readonly("opc_tipo_id", $this->form_encode_input($opc_tipo_id_look)) . "</span><span id=\"id_read_off_opc_tipo_id\" class=\"css_read_off_opc_tipo_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_opc_tipo_id . "\">";
   echo " <span id=\"idAjaxSelect_opc_tipo_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_opc_tipo_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_opc_tipo_id\" name=\"opc_tipo_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_tipo_id'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->opc_tipo_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->opc_tipo_id)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_tipo_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_tipo_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['opc_fornecedor_id']))
   {
       $this->nm_new_label['opc_fornecedor_id'] = "Fornecedor (outros):";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_fornecedor_id = $this->opc_fornecedor_id;
   $sStyleHidden_opc_fornecedor_id = '';
   if (isset($this->nmgp_cmp_hidden['opc_fornecedor_id']) && $this->nmgp_cmp_hidden['opc_fornecedor_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_fornecedor_id']);
       $sStyleHidden_opc_fornecedor_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_fornecedor_id = 'display: none;';
   $sStyleReadInp_opc_fornecedor_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_fornecedor_id']) && $this->nmgp_cmp_readonly['opc_fornecedor_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_fornecedor_id']);
       $sStyleReadLab_opc_fornecedor_id = '';
       $sStyleReadInp_opc_fornecedor_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_fornecedor_id']) && $this->nmgp_cmp_hidden['opc_fornecedor_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="opc_fornecedor_id" value="<?php echo $this->form_encode_input($this->opc_fornecedor_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_fornecedor_id_label" id="hidden_field_label_opc_fornecedor_id" style="<?php echo $sStyleHidden_opc_fornecedor_id; ?>"><span id="id_label_opc_fornecedor_id"><?php echo $this->nm_new_label['opc_fornecedor_id']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_fornecedor_id_line" id="hidden_field_data_opc_fornecedor_id" style="<?php echo $sStyleHidden_opc_fornecedor_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_fornecedor_id_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_fornecedor_id"]) &&  $this->nmgp_cmp_readonly["opc_fornecedor_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id'] = array(); 
    }

   $old_value_opc_id = $this->opc_id;
   $old_value_opc_modificado_em = $this->opc_modificado_em;
   $old_value_opc_modificado_em_hora = $this->opc_modificado_em_hora;
   $old_value_opc_hotel_dt01 = $this->opc_hotel_dt01;
   $old_value_opc_hotel_dt02 = $this->opc_hotel_dt02;
   $old_value_opc_seguro_dt01 = $this->opc_seguro_dt01;
   $old_value_opc_seguro_dt02 = $this->opc_seguro_dt02;
   $old_value_opc_city_data = $this->opc_city_data;
   $old_value_opc_locacao_dt01 = $this->opc_locacao_dt01;
   $old_value_opc_locacao_dt02 = $this->opc_locacao_dt02;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_opc_id = $this->opc_id;
   $unformatted_value_opc_modificado_em = $this->opc_modificado_em;
   $unformatted_value_opc_modificado_em_hora = $this->opc_modificado_em_hora;
   $unformatted_value_opc_hotel_dt01 = $this->opc_hotel_dt01;
   $unformatted_value_opc_hotel_dt02 = $this->opc_hotel_dt02;
   $unformatted_value_opc_seguro_dt01 = $this->opc_seguro_dt01;
   $unformatted_value_opc_seguro_dt02 = $this->opc_seguro_dt02;
   $unformatted_value_opc_city_data = $this->opc_city_data;
   $unformatted_value_opc_locacao_dt01 = $this->opc_locacao_dt01;
   $unformatted_value_opc_locacao_dt02 = $this->opc_locacao_dt02;

   $nm_comando = "SELECT fornec_id, fornec_fantasia  FROM tbl_fornecedores  ORDER BY fornec_fantasia";

   $this->opc_id = $old_value_opc_id;
   $this->opc_modificado_em = $old_value_opc_modificado_em;
   $this->opc_modificado_em_hora = $old_value_opc_modificado_em_hora;
   $this->opc_hotel_dt01 = $old_value_opc_hotel_dt01;
   $this->opc_hotel_dt02 = $old_value_opc_hotel_dt02;
   $this->opc_seguro_dt01 = $old_value_opc_seguro_dt01;
   $this->opc_seguro_dt02 = $old_value_opc_seguro_dt02;
   $this->opc_city_data = $old_value_opc_city_data;
   $this->opc_locacao_dt01 = $old_value_opc_locacao_dt01;
   $this->opc_locacao_dt02 = $old_value_opc_locacao_dt02;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id'][] = $rs->fields[0];
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
   $opc_fornecedor_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->opc_fornecedor_id_1))
          {
              foreach ($this->opc_fornecedor_id_1 as $tmp_opc_fornecedor_id)
              {
                  if (trim($tmp_opc_fornecedor_id) === trim($cadaselect[1])) {$opc_fornecedor_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->opc_fornecedor_id) && trim($this->opc_fornecedor_id) === trim($cadaselect[1])) {$opc_fornecedor_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="opc_fornecedor_id" value="<?php echo $this->form_encode_input($opc_fornecedor_id) . "\">" . $opc_fornecedor_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_opc_fornecedor_id();
   $x = 0 ; 
   $opc_fornecedor_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->opc_fornecedor_id_1))
          {
              foreach ($this->opc_fornecedor_id_1 as $tmp_opc_fornecedor_id)
              {
                  if (trim($tmp_opc_fornecedor_id) === trim($cadaselect[1])) {$opc_fornecedor_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->opc_fornecedor_id)) {
                 if (trim($this->opc_fornecedor_id) == trim($cadaselect[1])) { $opc_fornecedor_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->opc_fornecedor_id == $cadaselect[1]) { $opc_fornecedor_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($opc_fornecedor_id_look))
          {
              $opc_fornecedor_id_look = $this->opc_fornecedor_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_opc_fornecedor_id\" class=\"css_opc_fornecedor_id_line\" style=\"" .  $sStyleReadLab_opc_fornecedor_id . "\">" . $this->form_format_readonly("opc_fornecedor_id", $this->form_encode_input($opc_fornecedor_id_look)) . "</span><span id=\"id_read_off_opc_fornecedor_id\" class=\"css_read_off_opc_fornecedor_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_opc_fornecedor_id . "\">";
   echo " <span id=\"idAjaxSelect_opc_fornecedor_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_opc_fornecedor_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_opc_fornecedor_id\" name=\"opc_fornecedor_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_fornecedor_id'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->opc_fornecedor_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->opc_fornecedor_id)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_fornecedor_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_fornecedor_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['fornecedor_hotel']))
   {
       $this->nm_new_label['fornecedor_hotel'] = "Hotel:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornecedor_hotel = $this->fornecedor_hotel;
   $sStyleHidden_fornecedor_hotel = '';
   if (isset($this->nmgp_cmp_hidden['fornecedor_hotel']) && $this->nmgp_cmp_hidden['fornecedor_hotel'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornecedor_hotel']);
       $sStyleHidden_fornecedor_hotel = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornecedor_hotel = 'display: none;';
   $sStyleReadInp_fornecedor_hotel = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornecedor_hotel']) && $this->nmgp_cmp_readonly['fornecedor_hotel'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornecedor_hotel']);
       $sStyleReadLab_fornecedor_hotel = '';
       $sStyleReadInp_fornecedor_hotel = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornecedor_hotel']) && $this->nmgp_cmp_hidden['fornecedor_hotel'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="fornecedor_hotel" value="<?php echo $this->form_encode_input($this->fornecedor_hotel) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_fornecedor_hotel_label" id="hidden_field_label_fornecedor_hotel" style="<?php echo $sStyleHidden_fornecedor_hotel; ?>"><span id="id_label_fornecedor_hotel"><?php echo $this->nm_new_label['fornecedor_hotel']; ?></span></TD>
    <TD class="scFormDataOdd css_fornecedor_hotel_line" id="hidden_field_data_fornecedor_hotel" style="<?php echo $sStyleHidden_fornecedor_hotel; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornecedor_hotel_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornecedor_hotel"]) &&  $this->nmgp_cmp_readonly["fornecedor_hotel"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel'] = array(); 
    }

   $old_value_opc_id = $this->opc_id;
   $old_value_opc_modificado_em = $this->opc_modificado_em;
   $old_value_opc_modificado_em_hora = $this->opc_modificado_em_hora;
   $old_value_opc_hotel_dt01 = $this->opc_hotel_dt01;
   $old_value_opc_hotel_dt02 = $this->opc_hotel_dt02;
   $old_value_opc_seguro_dt01 = $this->opc_seguro_dt01;
   $old_value_opc_seguro_dt02 = $this->opc_seguro_dt02;
   $old_value_opc_city_data = $this->opc_city_data;
   $old_value_opc_locacao_dt01 = $this->opc_locacao_dt01;
   $old_value_opc_locacao_dt02 = $this->opc_locacao_dt02;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_opc_id = $this->opc_id;
   $unformatted_value_opc_modificado_em = $this->opc_modificado_em;
   $unformatted_value_opc_modificado_em_hora = $this->opc_modificado_em_hora;
   $unformatted_value_opc_hotel_dt01 = $this->opc_hotel_dt01;
   $unformatted_value_opc_hotel_dt02 = $this->opc_hotel_dt02;
   $unformatted_value_opc_seguro_dt01 = $this->opc_seguro_dt01;
   $unformatted_value_opc_seguro_dt02 = $this->opc_seguro_dt02;
   $unformatted_value_opc_city_data = $this->opc_city_data;
   $unformatted_value_opc_locacao_dt01 = $this->opc_locacao_dt01;
   $unformatted_value_opc_locacao_dt02 = $this->opc_locacao_dt02;

   $nm_comando = "SELECT hotel_id, hotel_fantasia  FROM tbl_hoteis  ORDER BY hotel_fantasia";

   $this->opc_id = $old_value_opc_id;
   $this->opc_modificado_em = $old_value_opc_modificado_em;
   $this->opc_modificado_em_hora = $old_value_opc_modificado_em_hora;
   $this->opc_hotel_dt01 = $old_value_opc_hotel_dt01;
   $this->opc_hotel_dt02 = $old_value_opc_hotel_dt02;
   $this->opc_seguro_dt01 = $old_value_opc_seguro_dt01;
   $this->opc_seguro_dt02 = $old_value_opc_seguro_dt02;
   $this->opc_city_data = $old_value_opc_city_data;
   $this->opc_locacao_dt01 = $old_value_opc_locacao_dt01;
   $this->opc_locacao_dt02 = $old_value_opc_locacao_dt02;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel'][] = $rs->fields[0];
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
   $fornecedor_hotel_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->fornecedor_hotel_1))
          {
              foreach ($this->fornecedor_hotel_1 as $tmp_fornecedor_hotel)
              {
                  if (trim($tmp_fornecedor_hotel) === trim($cadaselect[1])) {$fornecedor_hotel_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->fornecedor_hotel) && trim($this->fornecedor_hotel) === trim($cadaselect[1])) {$fornecedor_hotel_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="fornecedor_hotel" value="<?php echo $this->form_encode_input($fornecedor_hotel) . "\">" . $fornecedor_hotel_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_fornecedor_hotel();
   $x = 0 ; 
   $fornecedor_hotel_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->fornecedor_hotel_1))
          {
              foreach ($this->fornecedor_hotel_1 as $tmp_fornecedor_hotel)
              {
                  if (trim($tmp_fornecedor_hotel) === trim($cadaselect[1])) {$fornecedor_hotel_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->fornecedor_hotel)) {
                 if (trim($this->fornecedor_hotel) == trim($cadaselect[1])) { $fornecedor_hotel_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->fornecedor_hotel == $cadaselect[1]) { $fornecedor_hotel_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($fornecedor_hotel_look))
          {
              $fornecedor_hotel_look = $this->fornecedor_hotel;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_fornecedor_hotel\" class=\"css_fornecedor_hotel_line\" style=\"" .  $sStyleReadLab_fornecedor_hotel . "\">" . $this->form_format_readonly("fornecedor_hotel", $this->form_encode_input($fornecedor_hotel_look)) . "</span><span id=\"id_read_off_fornecedor_hotel\" class=\"css_read_off_fornecedor_hotel" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_fornecedor_hotel . "\">";
   echo " <span id=\"idAjaxSelect_fornecedor_hotel\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_fornecedor_hotel_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_fornecedor_hotel\" name=\"fornecedor_hotel\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_fornecedor_hotel'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->fornecedor_hotel) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->fornecedor_hotel)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornecedor_hotel_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornecedor_hotel_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['usuario_nome']))
    {
        $this->nm_new_label['usuario_nome'] = "Atendente";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $usuario_nome = $this->usuario_nome;
   $sStyleHidden_usuario_nome = '';
   if (isset($this->nmgp_cmp_hidden['usuario_nome']) && $this->nmgp_cmp_hidden['usuario_nome'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['usuario_nome']);
       $sStyleHidden_usuario_nome = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_usuario_nome = 'display: none;';
   $sStyleReadInp_usuario_nome = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['usuario_nome']) && $this->nmgp_cmp_readonly['usuario_nome'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['usuario_nome']);
       $sStyleReadLab_usuario_nome = '';
       $sStyleReadInp_usuario_nome = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['usuario_nome']) && $this->nmgp_cmp_hidden['usuario_nome'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="usuario_nome" value="<?php echo $this->form_encode_input($usuario_nome) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_usuario_nome_label" id="hidden_field_label_usuario_nome" style="<?php echo $sStyleHidden_usuario_nome; ?>"><span id="id_label_usuario_nome"><?php echo $this->nm_new_label['usuario_nome']; ?></span></TD>
    <TD class="scFormDataOdd css_usuario_nome_line" id="hidden_field_data_usuario_nome" style="<?php echo $sStyleHidden_usuario_nome; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_usuario_nome_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="usuario_nome" value="<?php echo $this->form_encode_input($usuario_nome); ?>"><span id="id_ajax_label_usuario_nome"><?php echo nl2br($usuario_nome); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_usuario_nome_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_usuario_nome_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_cpf_participante']))
    {
        $this->nm_new_label['opc_cpf_participante'] = "Cód. Participante:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_cpf_participante = $this->opc_cpf_participante;
   $sStyleHidden_opc_cpf_participante = '';
   if (isset($this->nmgp_cmp_hidden['opc_cpf_participante']) && $this->nmgp_cmp_hidden['opc_cpf_participante'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_cpf_participante']);
       $sStyleHidden_opc_cpf_participante = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_cpf_participante = 'display: none;';
   $sStyleReadInp_opc_cpf_participante = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_cpf_participante']) && $this->nmgp_cmp_readonly['opc_cpf_participante'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_cpf_participante']);
       $sStyleReadLab_opc_cpf_participante = '';
       $sStyleReadInp_opc_cpf_participante = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_cpf_participante']) && $this->nmgp_cmp_hidden['opc_cpf_participante'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_cpf_participante" value="<?php echo $this->form_encode_input($opc_cpf_participante) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_cpf_participante_label" id="hidden_field_label_opc_cpf_participante" style="<?php echo $sStyleHidden_opc_cpf_participante; ?>"><span id="id_label_opc_cpf_participante"><?php echo $this->nm_new_label['opc_cpf_participante']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_cpf_participante_line" id="hidden_field_data_opc_cpf_participante" style="<?php echo $sStyleHidden_opc_cpf_participante; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_cpf_participante_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="opc_cpf_participante" value="<?php echo $this->form_encode_input($opc_cpf_participante); ?>"><span id="id_ajax_label_opc_cpf_participante"><?php echo nl2br($opc_cpf_participante); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_cpf_participante_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_cpf_participante_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['participante_nome']))
    {
        $this->nm_new_label['participante_nome'] = "Participante:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $participante_nome = $this->participante_nome;
   $sStyleHidden_participante_nome = '';
   if (isset($this->nmgp_cmp_hidden['participante_nome']) && $this->nmgp_cmp_hidden['participante_nome'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['participante_nome']);
       $sStyleHidden_participante_nome = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_participante_nome = 'display: none;';
   $sStyleReadInp_participante_nome = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['participante_nome']) && $this->nmgp_cmp_readonly['participante_nome'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['participante_nome']);
       $sStyleReadLab_participante_nome = '';
       $sStyleReadInp_participante_nome = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['participante_nome']) && $this->nmgp_cmp_hidden['participante_nome'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="participante_nome" value="<?php echo $this->form_encode_input($participante_nome) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_participante_nome_label" id="hidden_field_label_participante_nome" style="<?php echo $sStyleHidden_participante_nome; ?>"><span id="id_label_participante_nome"><?php echo $this->nm_new_label['participante_nome']; ?></span></TD>
    <TD class="scFormDataOdd css_participante_nome_line" id="hidden_field_data_participante_nome" style="<?php echo $sStyleHidden_participante_nome; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_participante_nome_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="participante_nome" value="<?php echo $this->form_encode_input($participante_nome); ?>"><span id="id_ajax_label_participante_nome"><?php echo nl2br($participante_nome); ?></span>
 <SPAN id="id_lookup_participante_nome"><?php echo $look_rpc_participante_nome; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_participante_nome_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_participante_nome_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_status']))
    {
        $this->nm_new_label['opc_status'] = "Status:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_status = $this->opc_status;
   $sStyleHidden_opc_status = '';
   if (isset($this->nmgp_cmp_hidden['opc_status']) && $this->nmgp_cmp_hidden['opc_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_status']);
       $sStyleHidden_opc_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_status = 'display: none;';
   $sStyleReadInp_opc_status = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_status']) && $this->nmgp_cmp_readonly['opc_status'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_status']);
       $sStyleReadLab_opc_status = '';
       $sStyleReadInp_opc_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_status']) && $this->nmgp_cmp_hidden['opc_status'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_status" value="<?php echo $this->form_encode_input($opc_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_status_label" id="hidden_field_label_opc_status" style="<?php echo $sStyleHidden_opc_status; ?>"><span id="id_label_opc_status"><?php echo $this->nm_new_label['opc_status']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_status_line" id="hidden_field_data_opc_status" style="<?php echo $sStyleHidden_opc_status; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_status_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_status"]) &&  $this->nmgp_cmp_readonly["opc_status"] == "on") { 

 if ("Y" == $this->opc_status) { $opc_status_look = "Ativo";} 
 if ("N" == $this->opc_status) { $opc_status_look = "Inativo";} 
?>
<input type="hidden" name="opc_status" value="<?php echo $this->form_encode_input($opc_status) . "\">" . $opc_status_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->opc_status) { $opc_status_look = "Ativo";} 
 if ("N" == $this->opc_status) { $opc_status_look = "Inativo";} 
?>
<span id="id_read_on_opc_status"  class="css_opc_status_line" style="<?php echo $sStyleReadLab_opc_status; ?>"><?php echo $this->form_format_readonly("opc_status", $this->form_encode_input($opc_status_look)); ?></span><span id="id_read_off_opc_status" class="css_read_off_opc_status css_opc_status_line" style="<?php echo $sStyleReadInp_opc_status; ?>"><div id="idAjaxRadio_opc_status" style="display: inline-block"  class="css_opc_status_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_opc_status_line"><?php $tempOptionId = "id-opt-opc_status" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-opc_status sc-ui-radio-opc_status" type=radio name="opc_status" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_status'][] = 'Y'; ?>
<?php  if ("Y" == $this->opc_status)  { echo " checked" ;} ?><?php  if (empty($this->opc_status)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Ativo</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_opc_status_line"><?php $tempOptionId = "id-opt-opc_status" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-opc_status sc-ui-radio-opc_status" type=radio name="opc_status" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_status'][] = 'N'; ?>
<?php  if ("N" == $this->opc_status)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Inativo</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_status_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_modificado_em']))
    {
        $this->nm_new_label['opc_modificado_em'] = "Modificado Em:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_opc_modificado_em = $this->opc_modificado_em;
   if (strlen($this->opc_modificado_em_hora) > 8 ) {$this->opc_modificado_em_hora = substr($this->opc_modificado_em_hora, 0, 8);}
   $this->opc_modificado_em .= ' ' . $this->opc_modificado_em_hora;
   $this->opc_modificado_em  = trim($this->opc_modificado_em);
   $opc_modificado_em = $this->opc_modificado_em;
   $sStyleHidden_opc_modificado_em = '';
   if (isset($this->nmgp_cmp_hidden['opc_modificado_em']) && $this->nmgp_cmp_hidden['opc_modificado_em'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_modificado_em']);
       $sStyleHidden_opc_modificado_em = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_modificado_em = 'display: none;';
   $sStyleReadInp_opc_modificado_em = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_modificado_em']) && $this->nmgp_cmp_readonly['opc_modificado_em'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_modificado_em']);
       $sStyleReadLab_opc_modificado_em = '';
       $sStyleReadInp_opc_modificado_em = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_modificado_em']) && $this->nmgp_cmp_hidden['opc_modificado_em'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_modificado_em" value="<?php echo $this->form_encode_input($opc_modificado_em) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_modificado_em_label" id="hidden_field_label_opc_modificado_em" style="<?php echo $sStyleHidden_opc_modificado_em; ?>"><span id="id_label_opc_modificado_em"><?php echo $this->nm_new_label['opc_modificado_em']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_modificado_em_line" id="hidden_field_data_opc_modificado_em" style="<?php echo $sStyleHidden_opc_modificado_em; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_modificado_em_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="opc_modificado_em" value="<?php echo $this->form_encode_input($opc_modificado_em); ?>"><span id="id_ajax_label_opc_modificado_em"><?php echo nl2br($opc_modificado_em); ?></span>
<?php
$tmp_form_data = $this->field_config['opc_modificado_em']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_modificado_em_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_modificado_em_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->opc_modificado_em = $old_dt_opc_modificado_em;
?>

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
    if (!isset($this->nm_new_label['opc_hotel_dt01']))
    {
        $this->nm_new_label['opc_hotel_dt01'] = "Data Incial:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_hotel_dt01 = $this->opc_hotel_dt01;
   $sStyleHidden_opc_hotel_dt01 = '';
   if (isset($this->nmgp_cmp_hidden['opc_hotel_dt01']) && $this->nmgp_cmp_hidden['opc_hotel_dt01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_hotel_dt01']);
       $sStyleHidden_opc_hotel_dt01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_hotel_dt01 = 'display: none;';
   $sStyleReadInp_opc_hotel_dt01 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_hotel_dt01']) && $this->nmgp_cmp_readonly['opc_hotel_dt01'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_hotel_dt01']);
       $sStyleReadLab_opc_hotel_dt01 = '';
       $sStyleReadInp_opc_hotel_dt01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_hotel_dt01']) && $this->nmgp_cmp_hidden['opc_hotel_dt01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_hotel_dt01" value="<?php echo $this->form_encode_input($opc_hotel_dt01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_hotel_dt01_label" id="hidden_field_label_opc_hotel_dt01" style="<?php echo $sStyleHidden_opc_hotel_dt01; ?>"><span id="id_label_opc_hotel_dt01"><?php echo $this->nm_new_label['opc_hotel_dt01']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_hotel_dt01_line" id="hidden_field_data_opc_hotel_dt01" style="<?php echo $sStyleHidden_opc_hotel_dt01; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_hotel_dt01_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_hotel_dt01"]) &&  $this->nmgp_cmp_readonly["opc_hotel_dt01"] == "on") { 

 ?>
<input type="hidden" name="opc_hotel_dt01" value="<?php echo $this->form_encode_input($opc_hotel_dt01) . "\">" . $opc_hotel_dt01 . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_hotel_dt01" class="sc-ui-readonly-opc_hotel_dt01 css_opc_hotel_dt01_line" style="<?php echo $sStyleReadLab_opc_hotel_dt01; ?>"><?php echo $this->form_format_readonly("opc_hotel_dt01", $this->form_encode_input($opc_hotel_dt01)); ?></span><span id="id_read_off_opc_hotel_dt01" class="css_read_off_opc_hotel_dt01<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_hotel_dt01; ?>"><?php
$tmp_form_data = $this->field_config['opc_hotel_dt01']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_opc_hotel_dt01_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_opc_hotel_dt01" type=text name="opc_hotel_dt01" value="<?php echo $this->form_encode_input($opc_hotel_dt01) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['opc_hotel_dt01']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['opc_hotel_dt01']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_hotel_dt01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_hotel_dt01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_hotel_dt02']))
    {
        $this->nm_new_label['opc_hotel_dt02'] = "Data Final:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_hotel_dt02 = $this->opc_hotel_dt02;
   $sStyleHidden_opc_hotel_dt02 = '';
   if (isset($this->nmgp_cmp_hidden['opc_hotel_dt02']) && $this->nmgp_cmp_hidden['opc_hotel_dt02'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_hotel_dt02']);
       $sStyleHidden_opc_hotel_dt02 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_hotel_dt02 = 'display: none;';
   $sStyleReadInp_opc_hotel_dt02 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_hotel_dt02']) && $this->nmgp_cmp_readonly['opc_hotel_dt02'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_hotel_dt02']);
       $sStyleReadLab_opc_hotel_dt02 = '';
       $sStyleReadInp_opc_hotel_dt02 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_hotel_dt02']) && $this->nmgp_cmp_hidden['opc_hotel_dt02'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_hotel_dt02" value="<?php echo $this->form_encode_input($opc_hotel_dt02) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_hotel_dt02_label" id="hidden_field_label_opc_hotel_dt02" style="<?php echo $sStyleHidden_opc_hotel_dt02; ?>"><span id="id_label_opc_hotel_dt02"><?php echo $this->nm_new_label['opc_hotel_dt02']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_hotel_dt02_line" id="hidden_field_data_opc_hotel_dt02" style="<?php echo $sStyleHidden_opc_hotel_dt02; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_hotel_dt02_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_hotel_dt02"]) &&  $this->nmgp_cmp_readonly["opc_hotel_dt02"] == "on") { 

 ?>
<input type="hidden" name="opc_hotel_dt02" value="<?php echo $this->form_encode_input($opc_hotel_dt02) . "\">" . $opc_hotel_dt02 . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_hotel_dt02" class="sc-ui-readonly-opc_hotel_dt02 css_opc_hotel_dt02_line" style="<?php echo $sStyleReadLab_opc_hotel_dt02; ?>"><?php echo $this->form_format_readonly("opc_hotel_dt02", $this->form_encode_input($opc_hotel_dt02)); ?></span><span id="id_read_off_opc_hotel_dt02" class="css_read_off_opc_hotel_dt02<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_hotel_dt02; ?>"><?php
$tmp_form_data = $this->field_config['opc_hotel_dt02']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_opc_hotel_dt02_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_opc_hotel_dt02" type=text name="opc_hotel_dt02" value="<?php echo $this->form_encode_input($opc_hotel_dt02) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['opc_hotel_dt02']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['opc_hotel_dt02']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_hotel_dt02_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_hotel_dt02_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_hotel_obs']))
    {
        $this->nm_new_label['opc_hotel_obs'] = "Observações:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_hotel_obs = $this->opc_hotel_obs;
   $sStyleHidden_opc_hotel_obs = '';
   if (isset($this->nmgp_cmp_hidden['opc_hotel_obs']) && $this->nmgp_cmp_hidden['opc_hotel_obs'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_hotel_obs']);
       $sStyleHidden_opc_hotel_obs = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_hotel_obs = 'display: none;';
   $sStyleReadInp_opc_hotel_obs = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_hotel_obs']) && $this->nmgp_cmp_readonly['opc_hotel_obs'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_hotel_obs']);
       $sStyleReadLab_opc_hotel_obs = '';
       $sStyleReadInp_opc_hotel_obs = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_hotel_obs']) && $this->nmgp_cmp_hidden['opc_hotel_obs'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_hotel_obs" value="<?php echo $this->form_encode_input($opc_hotel_obs) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_hotel_obs_label" id="hidden_field_label_opc_hotel_obs" style="<?php echo $sStyleHidden_opc_hotel_obs; ?>"><span id="id_label_opc_hotel_obs"><?php echo $this->nm_new_label['opc_hotel_obs']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_hotel_obs_line" id="hidden_field_data_opc_hotel_obs" style="<?php echo $sStyleHidden_opc_hotel_obs; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_hotel_obs_line" style="vertical-align: top;padding: 0px">
<?php
$opc_hotel_obs_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($opc_hotel_obs));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_hotel_obs"]) &&  $this->nmgp_cmp_readonly["opc_hotel_obs"] == "on") { 

 ?>
<input type="hidden" name="opc_hotel_obs" value="<?php echo $this->form_encode_input($opc_hotel_obs) . "\">" . $opc_hotel_obs_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_hotel_obs" class="sc-ui-readonly-opc_hotel_obs css_opc_hotel_obs_line" style="<?php echo $sStyleReadLab_opc_hotel_obs; ?>"><?php echo $this->form_format_readonly("opc_hotel_obs", $this->form_encode_input($opc_hotel_obs_val)); ?></span><span id="id_read_off_opc_hotel_obs" class="css_read_off_opc_hotel_obs<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_hotel_obs; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_opc_hotel_obs_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="opc_hotel_obs" id="id_sc_field_opc_hotel_obs" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $opc_hotel_obs; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_hotel_obs_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_hotel_obs_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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
    if (!isset($this->nm_new_label['opc_seguro_dt01']))
    {
        $this->nm_new_label['opc_seguro_dt01'] = "Data Inicial:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_seguro_dt01 = $this->opc_seguro_dt01;
   $sStyleHidden_opc_seguro_dt01 = '';
   if (isset($this->nmgp_cmp_hidden['opc_seguro_dt01']) && $this->nmgp_cmp_hidden['opc_seguro_dt01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_seguro_dt01']);
       $sStyleHidden_opc_seguro_dt01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_seguro_dt01 = 'display: none;';
   $sStyleReadInp_opc_seguro_dt01 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_seguro_dt01']) && $this->nmgp_cmp_readonly['opc_seguro_dt01'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_seguro_dt01']);
       $sStyleReadLab_opc_seguro_dt01 = '';
       $sStyleReadInp_opc_seguro_dt01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_seguro_dt01']) && $this->nmgp_cmp_hidden['opc_seguro_dt01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_seguro_dt01" value="<?php echo $this->form_encode_input($opc_seguro_dt01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_seguro_dt01_label" id="hidden_field_label_opc_seguro_dt01" style="<?php echo $sStyleHidden_opc_seguro_dt01; ?>"><span id="id_label_opc_seguro_dt01"><?php echo $this->nm_new_label['opc_seguro_dt01']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_seguro_dt01_line" id="hidden_field_data_opc_seguro_dt01" style="<?php echo $sStyleHidden_opc_seguro_dt01; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_seguro_dt01_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_seguro_dt01"]) &&  $this->nmgp_cmp_readonly["opc_seguro_dt01"] == "on") { 

 ?>
<input type="hidden" name="opc_seguro_dt01" value="<?php echo $this->form_encode_input($opc_seguro_dt01) . "\">" . $opc_seguro_dt01 . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_seguro_dt01" class="sc-ui-readonly-opc_seguro_dt01 css_opc_seguro_dt01_line" style="<?php echo $sStyleReadLab_opc_seguro_dt01; ?>"><?php echo $this->form_format_readonly("opc_seguro_dt01", $this->form_encode_input($opc_seguro_dt01)); ?></span><span id="id_read_off_opc_seguro_dt01" class="css_read_off_opc_seguro_dt01<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_seguro_dt01; ?>"><?php
$tmp_form_data = $this->field_config['opc_seguro_dt01']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_opc_seguro_dt01_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_opc_seguro_dt01" type=text name="opc_seguro_dt01" value="<?php echo $this->form_encode_input($opc_seguro_dt01) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['opc_seguro_dt01']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['opc_seguro_dt01']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_seguro_dt01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_seguro_dt01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_seguro_dt02']))
    {
        $this->nm_new_label['opc_seguro_dt02'] = "Data Final:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_seguro_dt02 = $this->opc_seguro_dt02;
   $sStyleHidden_opc_seguro_dt02 = '';
   if (isset($this->nmgp_cmp_hidden['opc_seguro_dt02']) && $this->nmgp_cmp_hidden['opc_seguro_dt02'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_seguro_dt02']);
       $sStyleHidden_opc_seguro_dt02 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_seguro_dt02 = 'display: none;';
   $sStyleReadInp_opc_seguro_dt02 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_seguro_dt02']) && $this->nmgp_cmp_readonly['opc_seguro_dt02'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_seguro_dt02']);
       $sStyleReadLab_opc_seguro_dt02 = '';
       $sStyleReadInp_opc_seguro_dt02 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_seguro_dt02']) && $this->nmgp_cmp_hidden['opc_seguro_dt02'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_seguro_dt02" value="<?php echo $this->form_encode_input($opc_seguro_dt02) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_seguro_dt02_label" id="hidden_field_label_opc_seguro_dt02" style="<?php echo $sStyleHidden_opc_seguro_dt02; ?>"><span id="id_label_opc_seguro_dt02"><?php echo $this->nm_new_label['opc_seguro_dt02']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_seguro_dt02_line" id="hidden_field_data_opc_seguro_dt02" style="<?php echo $sStyleHidden_opc_seguro_dt02; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_seguro_dt02_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_seguro_dt02"]) &&  $this->nmgp_cmp_readonly["opc_seguro_dt02"] == "on") { 

 ?>
<input type="hidden" name="opc_seguro_dt02" value="<?php echo $this->form_encode_input($opc_seguro_dt02) . "\">" . $opc_seguro_dt02 . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_seguro_dt02" class="sc-ui-readonly-opc_seguro_dt02 css_opc_seguro_dt02_line" style="<?php echo $sStyleReadLab_opc_seguro_dt02; ?>"><?php echo $this->form_format_readonly("opc_seguro_dt02", $this->form_encode_input($opc_seguro_dt02)); ?></span><span id="id_read_off_opc_seguro_dt02" class="css_read_off_opc_seguro_dt02<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_seguro_dt02; ?>"><?php
$tmp_form_data = $this->field_config['opc_seguro_dt02']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_opc_seguro_dt02_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_opc_seguro_dt02" type=text name="opc_seguro_dt02" value="<?php echo $this->form_encode_input($opc_seguro_dt02) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['opc_seguro_dt02']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['opc_seguro_dt02']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_seguro_dt02_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_seguro_dt02_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_seguro_voucher']))
    {
        $this->nm_new_label['opc_seguro_voucher'] = "Voucher:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_seguro_voucher = $this->opc_seguro_voucher;
   $sStyleHidden_opc_seguro_voucher = '';
   if (isset($this->nmgp_cmp_hidden['opc_seguro_voucher']) && $this->nmgp_cmp_hidden['opc_seguro_voucher'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_seguro_voucher']);
       $sStyleHidden_opc_seguro_voucher = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_seguro_voucher = 'display: none;';
   $sStyleReadInp_opc_seguro_voucher = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_seguro_voucher']) && $this->nmgp_cmp_readonly['opc_seguro_voucher'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_seguro_voucher']);
       $sStyleReadLab_opc_seguro_voucher = '';
       $sStyleReadInp_opc_seguro_voucher = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_seguro_voucher']) && $this->nmgp_cmp_hidden['opc_seguro_voucher'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_seguro_voucher" value="<?php echo $this->form_encode_input($opc_seguro_voucher) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_seguro_voucher_label" id="hidden_field_label_opc_seguro_voucher" style="<?php echo $sStyleHidden_opc_seguro_voucher; ?>"><span id="id_label_opc_seguro_voucher"><?php echo $this->nm_new_label['opc_seguro_voucher']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_seguro_voucher_line" id="hidden_field_data_opc_seguro_voucher" style="<?php echo $sStyleHidden_opc_seguro_voucher; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_seguro_voucher_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_seguro_voucher"]) &&  $this->nmgp_cmp_readonly["opc_seguro_voucher"] == "on") { 

 ?>
<input type="hidden" name="opc_seguro_voucher" value="<?php echo $this->form_encode_input($opc_seguro_voucher) . "\">" . $opc_seguro_voucher . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_seguro_voucher" class="sc-ui-readonly-opc_seguro_voucher css_opc_seguro_voucher_line" style="<?php echo $sStyleReadLab_opc_seguro_voucher; ?>"><?php echo $this->form_format_readonly("opc_seguro_voucher", $this->form_encode_input($this->opc_seguro_voucher)); ?></span><span id="id_read_off_opc_seguro_voucher" class="css_read_off_opc_seguro_voucher<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_seguro_voucher; ?>">
 <input class="sc-js-input scFormObjectOdd css_opc_seguro_voucher_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_opc_seguro_voucher" type=text name="opc_seguro_voucher" value="<?php echo $this->form_encode_input($opc_seguro_voucher) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_seguro_voucher_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_seguro_voucher_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_seguro_obs']))
    {
        $this->nm_new_label['opc_seguro_obs'] = "Observações:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_seguro_obs = $this->opc_seguro_obs;
   $sStyleHidden_opc_seguro_obs = '';
   if (isset($this->nmgp_cmp_hidden['opc_seguro_obs']) && $this->nmgp_cmp_hidden['opc_seguro_obs'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_seguro_obs']);
       $sStyleHidden_opc_seguro_obs = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_seguro_obs = 'display: none;';
   $sStyleReadInp_opc_seguro_obs = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_seguro_obs']) && $this->nmgp_cmp_readonly['opc_seguro_obs'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_seguro_obs']);
       $sStyleReadLab_opc_seguro_obs = '';
       $sStyleReadInp_opc_seguro_obs = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_seguro_obs']) && $this->nmgp_cmp_hidden['opc_seguro_obs'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_seguro_obs" value="<?php echo $this->form_encode_input($opc_seguro_obs) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_seguro_obs_label" id="hidden_field_label_opc_seguro_obs" style="<?php echo $sStyleHidden_opc_seguro_obs; ?>"><span id="id_label_opc_seguro_obs"><?php echo $this->nm_new_label['opc_seguro_obs']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_seguro_obs_line" id="hidden_field_data_opc_seguro_obs" style="<?php echo $sStyleHidden_opc_seguro_obs; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_seguro_obs_line" style="vertical-align: top;padding: 0px">
<?php
$opc_seguro_obs_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($opc_seguro_obs));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_seguro_obs"]) &&  $this->nmgp_cmp_readonly["opc_seguro_obs"] == "on") { 

 ?>
<input type="hidden" name="opc_seguro_obs" value="<?php echo $this->form_encode_input($opc_seguro_obs) . "\">" . $opc_seguro_obs_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_seguro_obs" class="sc-ui-readonly-opc_seguro_obs css_opc_seguro_obs_line" style="<?php echo $sStyleReadLab_opc_seguro_obs; ?>"><?php echo $this->form_format_readonly("opc_seguro_obs", $this->form_encode_input($opc_seguro_obs_val)); ?></span><span id="id_read_off_opc_seguro_obs" class="css_read_off_opc_seguro_obs<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_seguro_obs; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_opc_seguro_obs_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="opc_seguro_obs" id="id_sc_field_opc_seguro_obs" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $opc_seguro_obs; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_seguro_obs_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_seguro_obs_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['opc_city_data']))
    {
        $this->nm_new_label['opc_city_data'] = "Data:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_city_data = $this->opc_city_data;
   $sStyleHidden_opc_city_data = '';
   if (isset($this->nmgp_cmp_hidden['opc_city_data']) && $this->nmgp_cmp_hidden['opc_city_data'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_city_data']);
       $sStyleHidden_opc_city_data = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_city_data = 'display: none;';
   $sStyleReadInp_opc_city_data = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_city_data']) && $this->nmgp_cmp_readonly['opc_city_data'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_city_data']);
       $sStyleReadLab_opc_city_data = '';
       $sStyleReadInp_opc_city_data = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_city_data']) && $this->nmgp_cmp_hidden['opc_city_data'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_city_data" value="<?php echo $this->form_encode_input($opc_city_data) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_city_data_label" id="hidden_field_label_opc_city_data" style="<?php echo $sStyleHidden_opc_city_data; ?>"><span id="id_label_opc_city_data"><?php echo $this->nm_new_label['opc_city_data']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_city_data_line" id="hidden_field_data_opc_city_data" style="<?php echo $sStyleHidden_opc_city_data; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_city_data_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_city_data"]) &&  $this->nmgp_cmp_readonly["opc_city_data"] == "on") { 

 ?>
<input type="hidden" name="opc_city_data" value="<?php echo $this->form_encode_input($opc_city_data) . "\">" . $opc_city_data . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_city_data" class="sc-ui-readonly-opc_city_data css_opc_city_data_line" style="<?php echo $sStyleReadLab_opc_city_data; ?>"><?php echo $this->form_format_readonly("opc_city_data", $this->form_encode_input($opc_city_data)); ?></span><span id="id_read_off_opc_city_data" class="css_read_off_opc_city_data<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_city_data; ?>"><?php
$tmp_form_data = $this->field_config['opc_city_data']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_opc_city_data_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_opc_city_data" type=text name="opc_city_data" value="<?php echo $this->form_encode_input($opc_city_data) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['opc_city_data']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['opc_city_data']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_city_data_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_city_data_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_city_obs']))
    {
        $this->nm_new_label['opc_city_obs'] = "Observações:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_city_obs = $this->opc_city_obs;
   $sStyleHidden_opc_city_obs = '';
   if (isset($this->nmgp_cmp_hidden['opc_city_obs']) && $this->nmgp_cmp_hidden['opc_city_obs'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_city_obs']);
       $sStyleHidden_opc_city_obs = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_city_obs = 'display: none;';
   $sStyleReadInp_opc_city_obs = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_city_obs']) && $this->nmgp_cmp_readonly['opc_city_obs'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_city_obs']);
       $sStyleReadLab_opc_city_obs = '';
       $sStyleReadInp_opc_city_obs = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_city_obs']) && $this->nmgp_cmp_hidden['opc_city_obs'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_city_obs" value="<?php echo $this->form_encode_input($opc_city_obs) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_city_obs_label" id="hidden_field_label_opc_city_obs" style="<?php echo $sStyleHidden_opc_city_obs; ?>"><span id="id_label_opc_city_obs"><?php echo $this->nm_new_label['opc_city_obs']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_city_obs_line" id="hidden_field_data_opc_city_obs" style="<?php echo $sStyleHidden_opc_city_obs; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_city_obs_line" style="vertical-align: top;padding: 0px">
<?php
$opc_city_obs_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($opc_city_obs));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_city_obs"]) &&  $this->nmgp_cmp_readonly["opc_city_obs"] == "on") { 

 ?>
<input type="hidden" name="opc_city_obs" value="<?php echo $this->form_encode_input($opc_city_obs) . "\">" . $opc_city_obs_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_city_obs" class="sc-ui-readonly-opc_city_obs css_opc_city_obs_line" style="<?php echo $sStyleReadLab_opc_city_obs; ?>"><?php echo $this->form_format_readonly("opc_city_obs", $this->form_encode_input($opc_city_obs_val)); ?></span><span id="id_read_off_opc_city_obs" class="css_read_off_opc_city_obs<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_city_obs; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_opc_city_obs_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="opc_city_obs" id="id_sc_field_opc_city_obs" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $opc_city_obs; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_city_obs_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_city_obs_text"></span></td></tr></table></td></tr></table></TD>
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
   if (!isset($this->nm_new_label['opc_locacao_tipo']))
   {
       $this->nm_new_label['opc_locacao_tipo'] = "Locação Tipo:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_locacao_tipo = $this->opc_locacao_tipo;
   $sStyleHidden_opc_locacao_tipo = '';
   if (isset($this->nmgp_cmp_hidden['opc_locacao_tipo']) && $this->nmgp_cmp_hidden['opc_locacao_tipo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_locacao_tipo']);
       $sStyleHidden_opc_locacao_tipo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_locacao_tipo = 'display: none;';
   $sStyleReadInp_opc_locacao_tipo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_locacao_tipo']) && $this->nmgp_cmp_readonly['opc_locacao_tipo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_locacao_tipo']);
       $sStyleReadLab_opc_locacao_tipo = '';
       $sStyleReadInp_opc_locacao_tipo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_locacao_tipo']) && $this->nmgp_cmp_hidden['opc_locacao_tipo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="opc_locacao_tipo" value="<?php echo $this->form_encode_input($this->opc_locacao_tipo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_locacao_tipo_label" id="hidden_field_label_opc_locacao_tipo" style="<?php echo $sStyleHidden_opc_locacao_tipo; ?>"><span id="id_label_opc_locacao_tipo"><?php echo $this->nm_new_label['opc_locacao_tipo']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_locacao_tipo_line" id="hidden_field_data_opc_locacao_tipo" style="<?php echo $sStyleHidden_opc_locacao_tipo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_locacao_tipo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_locacao_tipo"]) &&  $this->nmgp_cmp_readonly["opc_locacao_tipo"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo'] = array(); 
    }

   $old_value_opc_id = $this->opc_id;
   $old_value_opc_modificado_em = $this->opc_modificado_em;
   $old_value_opc_modificado_em_hora = $this->opc_modificado_em_hora;
   $old_value_opc_hotel_dt01 = $this->opc_hotel_dt01;
   $old_value_opc_hotel_dt02 = $this->opc_hotel_dt02;
   $old_value_opc_seguro_dt01 = $this->opc_seguro_dt01;
   $old_value_opc_seguro_dt02 = $this->opc_seguro_dt02;
   $old_value_opc_city_data = $this->opc_city_data;
   $old_value_opc_locacao_dt01 = $this->opc_locacao_dt01;
   $old_value_opc_locacao_dt02 = $this->opc_locacao_dt02;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_opc_id = $this->opc_id;
   $unformatted_value_opc_modificado_em = $this->opc_modificado_em;
   $unformatted_value_opc_modificado_em_hora = $this->opc_modificado_em_hora;
   $unformatted_value_opc_hotel_dt01 = $this->opc_hotel_dt01;
   $unformatted_value_opc_hotel_dt02 = $this->opc_hotel_dt02;
   $unformatted_value_opc_seguro_dt01 = $this->opc_seguro_dt01;
   $unformatted_value_opc_seguro_dt02 = $this->opc_seguro_dt02;
   $unformatted_value_opc_city_data = $this->opc_city_data;
   $unformatted_value_opc_locacao_dt01 = $this->opc_locacao_dt01;
   $unformatted_value_opc_locacao_dt02 = $this->opc_locacao_dt02;

   $nm_comando = "SELECT locacao_id, locacao_descricao  FROM tbl_locacoes  ORDER BY locacao_descricao";

   $this->opc_id = $old_value_opc_id;
   $this->opc_modificado_em = $old_value_opc_modificado_em;
   $this->opc_modificado_em_hora = $old_value_opc_modificado_em_hora;
   $this->opc_hotel_dt01 = $old_value_opc_hotel_dt01;
   $this->opc_hotel_dt02 = $old_value_opc_hotel_dt02;
   $this->opc_seguro_dt01 = $old_value_opc_seguro_dt01;
   $this->opc_seguro_dt02 = $old_value_opc_seguro_dt02;
   $this->opc_city_data = $old_value_opc_city_data;
   $this->opc_locacao_dt01 = $old_value_opc_locacao_dt01;
   $this->opc_locacao_dt02 = $old_value_opc_locacao_dt02;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo'][] = $rs->fields[0];
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
   $opc_locacao_tipo_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->opc_locacao_tipo_1))
          {
              foreach ($this->opc_locacao_tipo_1 as $tmp_opc_locacao_tipo)
              {
                  if (trim($tmp_opc_locacao_tipo) === trim($cadaselect[1])) {$opc_locacao_tipo_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->opc_locacao_tipo) && trim($this->opc_locacao_tipo) === trim($cadaselect[1])) {$opc_locacao_tipo_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="opc_locacao_tipo" value="<?php echo $this->form_encode_input($opc_locacao_tipo) . "\">" . $opc_locacao_tipo_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_opc_locacao_tipo();
   $x = 0 ; 
   $opc_locacao_tipo_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->opc_locacao_tipo_1))
          {
              foreach ($this->opc_locacao_tipo_1 as $tmp_opc_locacao_tipo)
              {
                  if (trim($tmp_opc_locacao_tipo) === trim($cadaselect[1])) {$opc_locacao_tipo_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->opc_locacao_tipo)) {
                 if (trim($this->opc_locacao_tipo) == trim($cadaselect[1])) { $opc_locacao_tipo_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->opc_locacao_tipo == $cadaselect[1]) { $opc_locacao_tipo_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($opc_locacao_tipo_look))
          {
              $opc_locacao_tipo_look = $this->opc_locacao_tipo;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_opc_locacao_tipo\" class=\"css_opc_locacao_tipo_line\" style=\"" .  $sStyleReadLab_opc_locacao_tipo . "\">" . $this->form_format_readonly("opc_locacao_tipo", $this->form_encode_input($opc_locacao_tipo_look)) . "</span><span id=\"id_read_off_opc_locacao_tipo\" class=\"css_read_off_opc_locacao_tipo" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_opc_locacao_tipo . "\">";
   echo " <span id=\"idAjaxSelect_opc_locacao_tipo\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_opc_locacao_tipo_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_opc_locacao_tipo\" name=\"opc_locacao_tipo\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['Lookup_opc_locacao_tipo'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->opc_locacao_tipo) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->opc_locacao_tipo)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_locacao_tipo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_locacao_tipo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_locacao_dt01']))
    {
        $this->nm_new_label['opc_locacao_dt01'] = "Data Incial:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_locacao_dt01 = $this->opc_locacao_dt01;
   $sStyleHidden_opc_locacao_dt01 = '';
   if (isset($this->nmgp_cmp_hidden['opc_locacao_dt01']) && $this->nmgp_cmp_hidden['opc_locacao_dt01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_locacao_dt01']);
       $sStyleHidden_opc_locacao_dt01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_locacao_dt01 = 'display: none;';
   $sStyleReadInp_opc_locacao_dt01 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_locacao_dt01']) && $this->nmgp_cmp_readonly['opc_locacao_dt01'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_locacao_dt01']);
       $sStyleReadLab_opc_locacao_dt01 = '';
       $sStyleReadInp_opc_locacao_dt01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_locacao_dt01']) && $this->nmgp_cmp_hidden['opc_locacao_dt01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_locacao_dt01" value="<?php echo $this->form_encode_input($opc_locacao_dt01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_locacao_dt01_label" id="hidden_field_label_opc_locacao_dt01" style="<?php echo $sStyleHidden_opc_locacao_dt01; ?>"><span id="id_label_opc_locacao_dt01"><?php echo $this->nm_new_label['opc_locacao_dt01']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_locacao_dt01_line" id="hidden_field_data_opc_locacao_dt01" style="<?php echo $sStyleHidden_opc_locacao_dt01; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_locacao_dt01_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_locacao_dt01"]) &&  $this->nmgp_cmp_readonly["opc_locacao_dt01"] == "on") { 

 ?>
<input type="hidden" name="opc_locacao_dt01" value="<?php echo $this->form_encode_input($opc_locacao_dt01) . "\">" . $opc_locacao_dt01 . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_locacao_dt01" class="sc-ui-readonly-opc_locacao_dt01 css_opc_locacao_dt01_line" style="<?php echo $sStyleReadLab_opc_locacao_dt01; ?>"><?php echo $this->form_format_readonly("opc_locacao_dt01", $this->form_encode_input($opc_locacao_dt01)); ?></span><span id="id_read_off_opc_locacao_dt01" class="css_read_off_opc_locacao_dt01<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_locacao_dt01; ?>"><?php
$tmp_form_data = $this->field_config['opc_locacao_dt01']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_opc_locacao_dt01_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_opc_locacao_dt01" type=text name="opc_locacao_dt01" value="<?php echo $this->form_encode_input($opc_locacao_dt01) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['opc_locacao_dt01']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['opc_locacao_dt01']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_locacao_dt01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_locacao_dt01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_locacao_dt02']))
    {
        $this->nm_new_label['opc_locacao_dt02'] = "Data Final:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_locacao_dt02 = $this->opc_locacao_dt02;
   $sStyleHidden_opc_locacao_dt02 = '';
   if (isset($this->nmgp_cmp_hidden['opc_locacao_dt02']) && $this->nmgp_cmp_hidden['opc_locacao_dt02'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_locacao_dt02']);
       $sStyleHidden_opc_locacao_dt02 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_locacao_dt02 = 'display: none;';
   $sStyleReadInp_opc_locacao_dt02 = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_locacao_dt02']) && $this->nmgp_cmp_readonly['opc_locacao_dt02'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_locacao_dt02']);
       $sStyleReadLab_opc_locacao_dt02 = '';
       $sStyleReadInp_opc_locacao_dt02 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_locacao_dt02']) && $this->nmgp_cmp_hidden['opc_locacao_dt02'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_locacao_dt02" value="<?php echo $this->form_encode_input($opc_locacao_dt02) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_locacao_dt02_label" id="hidden_field_label_opc_locacao_dt02" style="<?php echo $sStyleHidden_opc_locacao_dt02; ?>"><span id="id_label_opc_locacao_dt02"><?php echo $this->nm_new_label['opc_locacao_dt02']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_locacao_dt02_line" id="hidden_field_data_opc_locacao_dt02" style="<?php echo $sStyleHidden_opc_locacao_dt02; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_locacao_dt02_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_locacao_dt02"]) &&  $this->nmgp_cmp_readonly["opc_locacao_dt02"] == "on") { 

 ?>
<input type="hidden" name="opc_locacao_dt02" value="<?php echo $this->form_encode_input($opc_locacao_dt02) . "\">" . $opc_locacao_dt02 . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_locacao_dt02" class="sc-ui-readonly-opc_locacao_dt02 css_opc_locacao_dt02_line" style="<?php echo $sStyleReadLab_opc_locacao_dt02; ?>"><?php echo $this->form_format_readonly("opc_locacao_dt02", $this->form_encode_input($opc_locacao_dt02)); ?></span><span id="id_read_off_opc_locacao_dt02" class="css_read_off_opc_locacao_dt02<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_locacao_dt02; ?>"><?php
$tmp_form_data = $this->field_config['opc_locacao_dt02']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_opc_locacao_dt02_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_opc_locacao_dt02" type=text name="opc_locacao_dt02" value="<?php echo $this->form_encode_input($opc_locacao_dt02) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['opc_locacao_dt02']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['opc_locacao_dt02']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_locacao_dt02_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_locacao_dt02_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['opc_locacao_obs']))
    {
        $this->nm_new_label['opc_locacao_obs'] = "Observações:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $opc_locacao_obs = $this->opc_locacao_obs;
   $sStyleHidden_opc_locacao_obs = '';
   if (isset($this->nmgp_cmp_hidden['opc_locacao_obs']) && $this->nmgp_cmp_hidden['opc_locacao_obs'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['opc_locacao_obs']);
       $sStyleHidden_opc_locacao_obs = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_opc_locacao_obs = 'display: none;';
   $sStyleReadInp_opc_locacao_obs = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['opc_locacao_obs']) && $this->nmgp_cmp_readonly['opc_locacao_obs'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['opc_locacao_obs']);
       $sStyleReadLab_opc_locacao_obs = '';
       $sStyleReadInp_opc_locacao_obs = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['opc_locacao_obs']) && $this->nmgp_cmp_hidden['opc_locacao_obs'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="opc_locacao_obs" value="<?php echo $this->form_encode_input($opc_locacao_obs) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_opc_locacao_obs_label" id="hidden_field_label_opc_locacao_obs" style="<?php echo $sStyleHidden_opc_locacao_obs; ?>"><span id="id_label_opc_locacao_obs"><?php echo $this->nm_new_label['opc_locacao_obs']; ?></span></TD>
    <TD class="scFormDataOdd css_opc_locacao_obs_line" id="hidden_field_data_opc_locacao_obs" style="<?php echo $sStyleHidden_opc_locacao_obs; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_opc_locacao_obs_line" style="vertical-align: top;padding: 0px">
<?php
$opc_locacao_obs_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($opc_locacao_obs));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["opc_locacao_obs"]) &&  $this->nmgp_cmp_readonly["opc_locacao_obs"] == "on") { 

 ?>
<input type="hidden" name="opc_locacao_obs" value="<?php echo $this->form_encode_input($opc_locacao_obs) . "\">" . $opc_locacao_obs_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_opc_locacao_obs" class="sc-ui-readonly-opc_locacao_obs css_opc_locacao_obs_line" style="<?php echo $sStyleReadLab_opc_locacao_obs; ?>"><?php echo $this->form_format_readonly("opc_locacao_obs", $this->form_encode_input($opc_locacao_obs_val)); ?></span><span id="id_read_off_opc_locacao_obs" class="css_read_off_opc_locacao_obs<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_opc_locacao_obs; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_opc_locacao_obs_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="opc_locacao_obs" id="id_sc_field_opc_locacao_obs" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $opc_locacao_obs; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_opc_locacao_obs_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_opc_locacao_obs_text"></span></td></tr></table></td></tr></table></TD>
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

<?php
$sql_log_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($sql_log));

?>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['birpara'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['first'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['back'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['forward'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
  $nm_sc_blocos_da_pag = array(0,1,2,3,4);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0,2 => 0,3 => 0,4 => 0);
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_eventos_opcionais_rsvp");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_eventos_opcionais_rsvp");
 parent.scAjaxDetailHeight("form_eventos_opcionais_rsvp", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_eventos_opcionais_rsvp", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_eventos_opcionais_rsvp", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['sc_modal'])
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_eventos_opcionais_rsvp']['inside_nested_iframe']) {
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
