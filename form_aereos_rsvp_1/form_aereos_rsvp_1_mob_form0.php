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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " aereos_rsvp"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " aereos_rsvp"); } ?></TITLE>
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
.css_read_off_aereo_dt_saida button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_aereo_dt_chegada button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_aereo_dthr_saida button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_aereo_dthr_chegada button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_aereos_rsvp_1/form_aereos_rsvp_1_mob_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_aereos_rsvp_1_mob_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_aereos_rsvp_1_mob_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['recarga'];
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['link_info']['remove_border']) {
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

if (isset($_SESSION['scriptcase']['form_aereos_rsvp_1']['error_buffer']) && '' != $_SESSION['scriptcase']['form_aereos_rsvp_1']['error_buffer'])
{
    echo $_SESSION['scriptcase']['form_aereos_rsvp_1']['error_buffer'];
}
elseif (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
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
 include_once("form_aereos_rsvp_1_mob_js0.php");
?>
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
               action="form_aereos_rsvp_1_mob.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['insert_validation']; ?>">
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
<input type="hidden" name="id_aereo" value="<?php  echo $this->form_encode_input($this->id_aereo) ?>">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_aereos_rsvp_1_mob'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_aereos_rsvp_1_mob'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['fast_search'][2] : "";
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
          $SC_Label_atu['aereo_cpf_particip'] = (isset($this->nm_new_label['aereo_cpf_particip'])) ? $this->nm_new_label['aereo_cpf_particip'] : 'ID Part.:'; 
          $SC_Label_atu['enviar_app'] = (isset($this->nm_new_label['enviar_app'])) ? $this->nm_new_label['enviar_app'] : 'Gravar no APP:'; 
          $SC_Label_atu['aereo_status'] = (isset($this->nm_new_label['aereo_status'])) ? $this->nm_new_label['aereo_status'] : 'Status:'; 
          $SC_Label_atu['aereo_direcao'] = (isset($this->nm_new_label['aereo_direcao'])) ? $this->nm_new_label['aereo_direcao'] : 'Direção'; 
          $SC_Label_atu['aereo_bloqueio_id'] = (isset($this->nm_new_label['aereo_bloqueio_id'])) ? $this->nm_new_label['aereo_bloqueio_id'] : 'Bloqueio:'; 
          $SC_Label_atu['aereo_cia_aerea'] = (isset($this->nm_new_label['aereo_cia_aerea'])) ? $this->nm_new_label['aereo_cia_aerea'] : 'Cia Aérea:'; 
          $SC_Label_atu['aereo_origem'] = (isset($this->nm_new_label['aereo_origem'])) ? $this->nm_new_label['aereo_origem'] : 'Origem:'; 
          $SC_Label_atu['aereo_destino'] = (isset($this->nm_new_label['aereo_destino'])) ? $this->nm_new_label['aereo_destino'] : 'Destino:'; 
          $SC_Label_atu['aereo_dt_saida'] = (isset($this->nm_new_label['aereo_dt_saida'])) ? $this->nm_new_label['aereo_dt_saida'] : ' Data Saída:'; 
          $SC_Label_atu['aereo_hr_saida'] = (isset($this->nm_new_label['aereo_hr_saida'])) ? $this->nm_new_label['aereo_hr_saida'] : 'Hora Saída:'; 
          $SC_Label_atu['aereo_dt_chegada'] = (isset($this->nm_new_label['aereo_dt_chegada'])) ? $this->nm_new_label['aereo_dt_chegada'] : 'Data Chegada:'; 
          $SC_Label_atu['aereo_hr_chegada'] = (isset($this->nm_new_label['aereo_hr_chegada'])) ? $this->nm_new_label['aereo_hr_chegada'] : 'Hora Chegada:'; 
          $SC_Label_atu['aereo_num_voo'] = (isset($this->nm_new_label['aereo_num_voo'])) ? $this->nm_new_label['aereo_num_voo'] : 'Num. Voo:'; 
          $SC_Label_atu['aereo_localizador'] = (isset($this->nm_new_label['aereo_localizador'])) ? $this->nm_new_label['aereo_localizador'] : 'Localizador:'; 
          $SC_Label_atu['aereo_eticket'] = (isset($this->nm_new_label['aereo_eticket'])) ? $this->nm_new_label['aereo_eticket'] : 'E-Ticket:'; 
          $SC_Label_atu['aereo_assento'] = (isset($this->nm_new_label['aereo_assento'])) ? $this->nm_new_label['aereo_assento'] : 'Assento:'; 
          $SC_Label_atu['aereo_emitida_bvt'] = (isset($this->nm_new_label['aereo_emitida_bvt'])) ? $this->nm_new_label['aereo_emitida_bvt'] : 'Emissão BVT:'; 
          $SC_Label_atu['aereo_valor'] = (isset($this->nm_new_label['aereo_valor'])) ? $this->nm_new_label['aereo_valor'] : 'Valor:'; 
          $SC_Label_atu['aereo_transfer_tipo'] = (isset($this->nm_new_label['aereo_transfer_tipo'])) ? $this->nm_new_label['aereo_transfer_tipo'] : 'Aereo Transfer Tipo'; 
          $SC_Label_atu['titulo_api'] = (isset($this->nm_new_label['titulo_api'])) ? $this->nm_new_label['titulo_api'] : 'Título API:'; 
          $SC_Label_atu['descricao_api'] = (isset($this->nm_new_label['descricao_api'])) ? $this->nm_new_label['descricao_api'] : 'Descrição API:'; 
          $SC_Label_atu['cod_rota_api'] = (isset($this->nm_new_label['cod_rota_api'])) ? $this->nm_new_label['cod_rota_api'] : 'Cód. Rota API:'; 
          $SC_Label_atu['tipo_api'] = (isset($this->nm_new_label['tipo_api'])) ? $this->nm_new_label['tipo_api'] : 'Tipo API:'; 
          $SC_Label_atu['valido_de_api'] = (isset($this->nm_new_label['valido_de_api'])) ? $this->nm_new_label['valido_de_api'] : 'Válido API de:'; 
          $SC_Label_atu['valido_ate_api'] = (isset($this->nm_new_label['valido_ate_api'])) ? $this->nm_new_label['valido_ate_api'] : 'Válido API até:'; 
          $SC_Label_atu['duracao_voo_api'] = (isset($this->nm_new_label['duracao_voo_api'])) ? $this->nm_new_label['duracao_voo_api'] : 'Duração do voo API:'; 
          $SC_Label_atu['aeronave_api'] = (isset($this->nm_new_label['aeronave_api'])) ? $this->nm_new_label['aeronave_api'] : 'Aeronave API:'; 
          $SC_Label_atu['terminal_api'] = (isset($this->nm_new_label['terminal_api'])) ? $this->nm_new_label['terminal_api'] : 'Terminal API:'; 
          $SC_Label_atu['gate_api'] = (isset($this->nm_new_label['gate_api'])) ? $this->nm_new_label['gate_api'] : 'Gate(portão) API:'; 
          $SC_Label_atu['refeicao_api'] = (isset($this->nm_new_label['refeicao_api'])) ? $this->nm_new_label['refeicao_api'] : 'Refeição API:'; 
          $SC_Label_atu['milhagem_api'] = (isset($this->nm_new_label['milhagem_api'])) ? $this->nm_new_label['milhagem_api'] : 'Milhagem API:'; 
          $SC_Label_atu['web_ckeckin_api'] = (isset($this->nm_new_label['web_ckeckin_api'])) ? $this->nm_new_label['web_ckeckin_api'] : 'Web Ckeckin API:'; 
          $SC_Label_atu['duracao_escala'] = (isset($this->nm_new_label['duracao_escala'])) ? $this->nm_new_label['duracao_escala'] : 'Duracão Escala API:'; 
          $SC_Label_atu['aeroporto_escala'] = (isset($this->nm_new_label['aeroporto_escala'])) ? $this->nm_new_label['aeroporto_escala'] : 'Aeroporto Escala API:'; 
          $SC_Label_atu['numero_voo_escala'] = (isset($this->nm_new_label['numero_voo_escala'])) ? $this->nm_new_label['numero_voo_escala'] : 'Número Voo Escala API:'; 
          $SC_Label_atu['hora_saida_escala'] = (isset($this->nm_new_label['hora_saida_escala'])) ? $this->nm_new_label['hora_saida_escala'] : 'Hora Saída Escala API:'; 
          $SC_Label_atu['hora_chegada_escala'] = (isset($this->nm_new_label['hora_chegada_escala'])) ? $this->nm_new_label['hora_chegada_escala'] : 'Hora Chegada Escala API:'; 
          $SC_Label_atu['classe_api'] = (isset($this->nm_new_label['classe_api'])) ? $this->nm_new_label['classe_api'] : 'Classe API:'; 
          $SC_Label_atu['passageiro_api'] = (isset($this->nm_new_label['passageiro_api'])) ? $this->nm_new_label['passageiro_api'] : 'Passageiro API:'; 
          $SC_Label_atu['bagagem_api'] = (isset($this->nm_new_label['bagagem_api'])) ? $this->nm_new_label['bagagem_api'] : 'Bagagem API:'; 
          $SC_Label_atu['id_evento_app'] = (isset($this->nm_new_label['id_evento_app'])) ? $this->nm_new_label['id_evento_app'] : 'Id Evento APP:'; 
          $SC_Label_atu['id_participante_app'] = (isset($this->nm_new_label['id_participante_app'])) ? $this->nm_new_label['id_participante_app'] : 'Id Participante APP:'; 
          $SC_Label_atu['id_voucher_app'] = (isset($this->nm_new_label['id_voucher_app'])) ? $this->nm_new_label['id_voucher_app'] : 'Id Voucher APP:'; 
          $SC_Label_atu['aereo_id_usuario'] = (isset($this->nm_new_label['aereo_id_usuario'])) ? $this->nm_new_label['aereo_id_usuario'] : 'Cód. Atendente:'; 
          $SC_Label_atu['aereo_ativo'] = (isset($this->nm_new_label['aereo_ativo'])) ? $this->nm_new_label['aereo_ativo'] : 'Registro Ativo:'; 
          $SC_Label_atu['aereo_dthr_saida'] = (isset($this->nm_new_label['aereo_dthr_saida'])) ? $this->nm_new_label['aereo_dthr_saida'] : 'Dt. Hr. Saída:'; 
          $SC_Label_atu['aereo_dthr_chegada'] = (isset($this->nm_new_label['aereo_dthr_chegada'])) ? $this->nm_new_label['aereo_dthr_chegada'] : 'Dtt. Hr. Chegada:'; 
          $SC_Label_atu['id_origem_gate'] = (isset($this->nm_new_label['id_origem_gate'])) ? $this->nm_new_label['id_origem_gate'] : 'Origem Gate:'; 
          $SC_Label_atu['aereo_trecho'] = (isset($this->nm_new_label['aereo_trecho'])) ? $this->nm_new_label['aereo_trecho'] : 'Núm Trecho:'; 
          $SC_Label_atu['aereo_modificado_em'] = (isset($this->nm_new_label['aereo_modificado_em'])) ? $this->nm_new_label['aereo_modificado_em'] : 'Aereo Modificado Em'; 
          $SC_Label_atu['nome_pax_gate'] = (isset($this->nm_new_label['nome_pax_gate'])) ? $this->nm_new_label['nome_pax_gate'] : 'Pax Gate:'; 
          $SC_Label_atu['nota_gate'] = (isset($this->nm_new_label['nota_gate'])) ? $this->nm_new_label['nota_gate'] : 'Nota Gate:'; 
          $SC_Label_atu['data_nota_gate'] = (isset($this->nm_new_label['data_nota_gate'])) ? $this->nm_new_label['data_nota_gate'] : 'Data Nota Gate:'; 
          $SC_Label_atu['fil_agt_gate'] = (isset($this->nm_new_label['fil_agt_gate'])) ? $this->nm_new_label['fil_agt_gate'] : 'Fil Agt Gate:'; 
          $SC_Label_atu['aereo_cia_aerea_gate'] = (isset($this->nm_new_label['aereo_cia_aerea_gate'])) ? $this->nm_new_label['aereo_cia_aerea_gate'] : 'Cia Aerea Gate:'; 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['new'];
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
        $buttonMacroDisabled = 'sc-unique-btn-16';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['insert'];
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
        $buttonMacroDisabled = 'sc-unique-btn-17';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['bcancelar'];
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
        $buttonMacroDisabled = 'sc-unique-btn-18';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['update'];
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
        $buttonMacroDisabled = 'sc-unique-btn-19';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Ctrl + Delete)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['sc_btn_0'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['sc_btn_0'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_0", "scBtnFn_sc_btn_0()", "scBtnFn_sc_btn_0()", "sc_sc_btn_0_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['sc_btn_0'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['sc_btn_0'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_0", "scBtnFn_sc_btn_0()", "scBtnFn_sc_btn_0()", "sc_sc_btn_0_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['LOG'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['log'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "log", "scBtnFn_LOG()", "scBtnFn_LOG()", "sc_LOG_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['LOG'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['log'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "log", "scBtnFn_LOG()", "scBtnFn_LOG()", "sc_LOG_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-20';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-21';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-22';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-23';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-24';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<?php
   if (!isset($this->nmgp_cmp_hidden['sql_log']))
   {
       $this->nmgp_cmp_hidden['sql_log'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_cpf_particip']))
    {
        $this->nm_new_label['aereo_cpf_particip'] = "ID Part.:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_cpf_particip = $this->aereo_cpf_particip;
   $sStyleHidden_aereo_cpf_particip = '';
   if (isset($this->nmgp_cmp_hidden['aereo_cpf_particip']) && $this->nmgp_cmp_hidden['aereo_cpf_particip'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_cpf_particip']);
       $sStyleHidden_aereo_cpf_particip = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_cpf_particip = 'display: none;';
   $sStyleReadInp_aereo_cpf_particip = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_cpf_particip']) && $this->nmgp_cmp_readonly['aereo_cpf_particip'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_cpf_particip']);
       $sStyleReadLab_aereo_cpf_particip = '';
       $sStyleReadInp_aereo_cpf_particip = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_cpf_particip']) && $this->nmgp_cmp_hidden['aereo_cpf_particip'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_cpf_particip" value="<?php echo $this->form_encode_input($aereo_cpf_particip) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_cpf_particip" style="<?php echo $sStyleHidden_aereo_cpf_particip; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_cpf_particip_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_cpf_particip_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_cpf_particip"><?php echo $this->nm_new_label['aereo_cpf_particip']; ?></span></td></tr><tr><td class="css_aereo_cpf_particip_line" style="padding: 0px; width: 100%;"><input type="hidden" name="aereo_cpf_particip" value="<?php echo $this->form_encode_input($aereo_cpf_particip); ?>"><span id="id_ajax_label_aereo_cpf_particip"><?php echo nl2br($aereo_cpf_particip); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_cpf_particip_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_cpf_particip_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tipo_pessoa']))
    {
        $this->nm_new_label['tipo_pessoa'] = "Tipo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tipo_pessoa = $this->tipo_pessoa;
   $sStyleHidden_tipo_pessoa = '';
   if (isset($this->nmgp_cmp_hidden['tipo_pessoa']) && $this->nmgp_cmp_hidden['tipo_pessoa'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tipo_pessoa']);
       $sStyleHidden_tipo_pessoa = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tipo_pessoa = 'display: none;';
   $sStyleReadInp_tipo_pessoa = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tipo_pessoa']) && $this->nmgp_cmp_readonly['tipo_pessoa'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tipo_pessoa']);
       $sStyleReadLab_tipo_pessoa = '';
       $sStyleReadInp_tipo_pessoa = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tipo_pessoa']) && $this->nmgp_cmp_hidden['tipo_pessoa'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tipo_pessoa" value="<?php echo $this->form_encode_input($tipo_pessoa) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tipo_pessoa" style="<?php echo $sStyleHidden_tipo_pessoa; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tipo_pessoa_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tipo_pessoa_label" style=" padding: 0px; width: 100%;"><span id="id_label_tipo_pessoa"><?php echo $this->nm_new_label['tipo_pessoa']; ?></span></td></tr><tr><td class="css_tipo_pessoa_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tipo_pessoa" value="<?php echo $this->form_encode_input($tipo_pessoa); ?>"><span id="id_ajax_label_tipo_pessoa"><?php echo nl2br($tipo_pessoa); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_pessoa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_pessoa_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
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
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_enviar_app'][] = 'Y'; ?>
<?php  if ("Y" == $this->enviar_app)  { echo " checked" ;} ?><?php  if (empty($this->enviar_app)) { echo " checked" ;} ?>  onClick="do_ajax_form_aereos_rsvp_1_mob_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_enviar_app_line"><?php $tempOptionId = "id-opt-enviar_app" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enviar_app sc-ui-radio-enviar_app" type=radio name="enviar_app" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_enviar_app'][] = 'N'; ?>
<?php  if ("N" == $this->enviar_app)  { echo " checked" ;} ?>  onClick="do_ajax_form_aereos_rsvp_1_mob_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_enviar_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_enviar_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_status']))
   {
       $this->nm_new_label['aereo_status'] = "Status:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_status = $this->aereo_status;
   $sStyleHidden_aereo_status = '';
   if (isset($this->nmgp_cmp_hidden['aereo_status']) && $this->nmgp_cmp_hidden['aereo_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_status']);
       $sStyleHidden_aereo_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_status = 'display: none;';
   $sStyleReadInp_aereo_status = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_status']) && $this->nmgp_cmp_readonly['aereo_status'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_status']);
       $sStyleReadLab_aereo_status = '';
       $sStyleReadInp_aereo_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_status']) && $this->nmgp_cmp_hidden['aereo_status'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aereo_status" value="<?php echo $this->form_encode_input($this->aereo_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_status" style="<?php echo $sStyleHidden_aereo_status; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_status_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_status_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_status"><?php echo $this->nm_new_label['aereo_status']; ?></span></td></tr><tr><td class="css_aereo_status_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_status"]) &&  $this->nmgp_cmp_readonly["aereo_status"] == "on") { 

$aereo_status_look = "";
 if ($this->aereo_status == "A") { $aereo_status_look .= "Aberto" ;} 
 if ($this->aereo_status == "Y") { $aereo_status_look .= "Sim" ;} 
 if ($this->aereo_status == "N") { $aereo_status_look .= "Não" ;} 
 if ($this->aereo_status == "P") { $aereo_status_look .= "Pendente" ;} 
 if (empty($aereo_status_look)) { $aereo_status_look = $this->aereo_status; }
?>
<input type="hidden" name="aereo_status" value="<?php echo $this->form_encode_input($aereo_status) . "\">" . $aereo_status_look . ""; ?>
<?php } else { ?>
<?php

$aereo_status_look = "";
 if ($this->aereo_status == "A") { $aereo_status_look .= "Aberto" ;} 
 if ($this->aereo_status == "Y") { $aereo_status_look .= "Sim" ;} 
 if ($this->aereo_status == "N") { $aereo_status_look .= "Não" ;} 
 if ($this->aereo_status == "P") { $aereo_status_look .= "Pendente" ;} 
 if (empty($aereo_status_look)) { $aereo_status_look = $this->aereo_status; }
?>
<span id="id_read_on_aereo_status" class="css_aereo_status_line"  style="<?php echo $sStyleReadLab_aereo_status; ?>"><?php echo $this->form_format_readonly("aereo_status", $this->form_encode_input($aereo_status_look)); ?></span><span id="id_read_off_aereo_status" class="css_read_off_aereo_status<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_aereo_status; ?>">
 <span id="idAjaxSelect_aereo_status" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_aereo_status_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_status" name="aereo_status" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="A" <?php  if ($this->aereo_status == "A") { echo " selected" ;} ?><?php  if (empty($this->aereo_status)) { echo " selected" ;} ?>>Aberto</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_status'][] = 'A'; ?>
 <option  value="Y" <?php  if ($this->aereo_status == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_status'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->aereo_status == "N") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_status'][] = 'N'; ?>
 <option  value="P" <?php  if ($this->aereo_status == "P") { echo " selected" ;} ?>>Pendente</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_status'][] = 'P'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_status_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_direcao']))
   {
       $this->nm_new_label['aereo_direcao'] = "Direção";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_direcao = $this->aereo_direcao;
   $sStyleHidden_aereo_direcao = '';
   if (isset($this->nmgp_cmp_hidden['aereo_direcao']) && $this->nmgp_cmp_hidden['aereo_direcao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_direcao']);
       $sStyleHidden_aereo_direcao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_direcao = 'display: none;';
   $sStyleReadInp_aereo_direcao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_direcao']) && $this->nmgp_cmp_readonly['aereo_direcao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_direcao']);
       $sStyleReadLab_aereo_direcao = '';
       $sStyleReadInp_aereo_direcao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_direcao']) && $this->nmgp_cmp_hidden['aereo_direcao'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aereo_direcao" value="<?php echo $this->form_encode_input($this->aereo_direcao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_direcao" style="<?php echo $sStyleHidden_aereo_direcao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_direcao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_direcao_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_direcao"><?php echo $this->nm_new_label['aereo_direcao']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_direcao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_direcao'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_aereo_direcao_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_direcao"]) &&  $this->nmgp_cmp_readonly["aereo_direcao"] == "on") { 

$aereo_direcao_look = "";
 if ($this->aereo_direcao == "IDA") { $aereo_direcao_look .= "IDA" ;} 
 if ($this->aereo_direcao == "VOLTA") { $aereo_direcao_look .= "VOLTA" ;} 
 if (empty($aereo_direcao_look)) { $aereo_direcao_look = $this->aereo_direcao; }
?>
<input type="hidden" name="aereo_direcao" value="<?php echo $this->form_encode_input($aereo_direcao) . "\">" . $aereo_direcao_look . ""; ?>
<?php } else { ?>
<?php

$aereo_direcao_look = "";
 if ($this->aereo_direcao == "IDA") { $aereo_direcao_look .= "IDA" ;} 
 if ($this->aereo_direcao == "VOLTA") { $aereo_direcao_look .= "VOLTA" ;} 
 if (empty($aereo_direcao_look)) { $aereo_direcao_look = $this->aereo_direcao; }
?>
<span id="id_read_on_aereo_direcao" class="css_aereo_direcao_line"  style="<?php echo $sStyleReadLab_aereo_direcao; ?>"><?php echo $this->form_format_readonly("aereo_direcao", $this->form_encode_input($aereo_direcao_look)); ?></span><span id="id_read_off_aereo_direcao" class="css_read_off_aereo_direcao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_aereo_direcao; ?>">
 <span id="idAjaxSelect_aereo_direcao" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_aereo_direcao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_direcao" name="aereo_direcao" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_direcao'][] = ''; ?>
 <option value="">.:Selecione:.</option>
 <option  value="IDA" <?php  if ($this->aereo_direcao == "IDA") { echo " selected" ;} ?>>IDA</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_direcao'][] = 'IDA'; ?>
 <option  value="VOLTA" <?php  if ($this->aereo_direcao == "VOLTA") { echo " selected" ;} ?>>VOLTA</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_direcao'][] = 'VOLTA'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_direcao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_direcao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_bloqueio_id']))
   {
       $this->nm_new_label['aereo_bloqueio_id'] = "Bloqueio:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_bloqueio_id = $this->aereo_bloqueio_id;
   $sStyleHidden_aereo_bloqueio_id = '';
   if (isset($this->nmgp_cmp_hidden['aereo_bloqueio_id']) && $this->nmgp_cmp_hidden['aereo_bloqueio_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_bloqueio_id']);
       $sStyleHidden_aereo_bloqueio_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_bloqueio_id = 'display: none;';
   $sStyleReadInp_aereo_bloqueio_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_bloqueio_id']) && $this->nmgp_cmp_readonly['aereo_bloqueio_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_bloqueio_id']);
       $sStyleReadLab_aereo_bloqueio_id = '';
       $sStyleReadInp_aereo_bloqueio_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_bloqueio_id']) && $this->nmgp_cmp_hidden['aereo_bloqueio_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aereo_bloqueio_id" value="<?php echo $this->form_encode_input($this->aereo_bloqueio_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_bloqueio_id" style="<?php echo $sStyleHidden_aereo_bloqueio_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_bloqueio_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_bloqueio_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_bloqueio_id"><?php echo $this->nm_new_label['aereo_bloqueio_id']; ?></span></td></tr><tr><td class="css_aereo_bloqueio_id_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_bloqueio_id"]) &&  $this->nmgp_cmp_readonly["aereo_bloqueio_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id'] = array(); 
    }

   $old_value_aereo_dt_saida = $this->aereo_dt_saida;
   $old_value_aereo_hr_saida = $this->aereo_hr_saida;
   $old_value_aereo_dt_chegada = $this->aereo_dt_chegada;
   $old_value_aereo_hr_chegada = $this->aereo_hr_chegada;
   $old_value_aereo_valor = $this->aereo_valor;
   $old_value_duracao_voo_api = $this->duracao_voo_api;
   $old_value_duracao_escala = $this->duracao_escala;
   $old_value_hora_saida_escala = $this->hora_saida_escala;
   $old_value_hora_chegada_escala = $this->hora_chegada_escala;
   $old_value_aereo_id_usuario = $this->aereo_id_usuario;
   $old_value_aereo_dthr_saida = $this->aereo_dthr_saida;
   $old_value_aereo_dthr_saida_hora = $this->aereo_dthr_saida_hora;
   $old_value_aereo_dthr_chegada = $this->aereo_dthr_chegada;
   $old_value_aereo_dthr_chegada_hora = $this->aereo_dthr_chegada_hora;
   $old_value_id_origem_gate = $this->id_origem_gate;
   $old_value_aereo_trecho = $this->aereo_trecho;
   $old_value_aereo_modificado_em = $this->aereo_modificado_em;
   $old_value_aereo_modificado_em_hora = $this->aereo_modificado_em_hora;
   $old_value_data_nota_gate = $this->data_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_aereo_dt_saida = $this->aereo_dt_saida;
   $unformatted_value_aereo_hr_saida = $this->aereo_hr_saida;
   $unformatted_value_aereo_dt_chegada = $this->aereo_dt_chegada;
   $unformatted_value_aereo_hr_chegada = $this->aereo_hr_chegada;
   $unformatted_value_aereo_valor = $this->aereo_valor;
   $unformatted_value_duracao_voo_api = $this->duracao_voo_api;
   $unformatted_value_duracao_escala = $this->duracao_escala;
   $unformatted_value_hora_saida_escala = $this->hora_saida_escala;
   $unformatted_value_hora_chegada_escala = $this->hora_chegada_escala;
   $unformatted_value_aereo_id_usuario = $this->aereo_id_usuario;
   $unformatted_value_aereo_dthr_saida = $this->aereo_dthr_saida;
   $unformatted_value_aereo_dthr_saida_hora = $this->aereo_dthr_saida_hora;
   $unformatted_value_aereo_dthr_chegada = $this->aereo_dthr_chegada;
   $unformatted_value_aereo_dthr_chegada_hora = $this->aereo_dthr_chegada_hora;
   $unformatted_value_id_origem_gate = $this->id_origem_gate;
   $unformatted_value_aereo_trecho = $this->aereo_trecho;
   $unformatted_value_aereo_modificado_em = $this->aereo_modificado_em;
   $unformatted_value_aereo_modificado_em_hora = $this->aereo_modificado_em_hora;
   $unformatted_value_data_nota_gate = $this->data_nota_gate;

   $nm_comando = "SELECT bloqueio_id,bloq_descricao  FROM bloqueio_aereo_rsvp  WHERE  bloq_evento_id = '" . $_SESSION['vg_evento_id'] . "'	 ORDER BY bloqueio_id, bloq_evento_id, bloq_descricao, bloq_direcao";

   $this->aereo_dt_saida = $old_value_aereo_dt_saida;
   $this->aereo_hr_saida = $old_value_aereo_hr_saida;
   $this->aereo_dt_chegada = $old_value_aereo_dt_chegada;
   $this->aereo_hr_chegada = $old_value_aereo_hr_chegada;
   $this->aereo_valor = $old_value_aereo_valor;
   $this->duracao_voo_api = $old_value_duracao_voo_api;
   $this->duracao_escala = $old_value_duracao_escala;
   $this->hora_saida_escala = $old_value_hora_saida_escala;
   $this->hora_chegada_escala = $old_value_hora_chegada_escala;
   $this->aereo_id_usuario = $old_value_aereo_id_usuario;
   $this->aereo_dthr_saida = $old_value_aereo_dthr_saida;
   $this->aereo_dthr_saida_hora = $old_value_aereo_dthr_saida_hora;
   $this->aereo_dthr_chegada = $old_value_aereo_dthr_chegada;
   $this->aereo_dthr_chegada_hora = $old_value_aereo_dthr_chegada_hora;
   $this->id_origem_gate = $old_value_id_origem_gate;
   $this->aereo_trecho = $old_value_aereo_trecho;
   $this->aereo_modificado_em = $old_value_aereo_modificado_em;
   $this->aereo_modificado_em_hora = $old_value_aereo_modificado_em_hora;
   $this->data_nota_gate = $old_value_data_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id'][] = $rs->fields[0];
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
   $aereo_bloqueio_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aereo_bloqueio_id_1))
          {
              foreach ($this->aereo_bloqueio_id_1 as $tmp_aereo_bloqueio_id)
              {
                  if (trim($tmp_aereo_bloqueio_id) === trim($cadaselect[1])) {$aereo_bloqueio_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->aereo_bloqueio_id) && trim($this->aereo_bloqueio_id) === trim($cadaselect[1])) {$aereo_bloqueio_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="aereo_bloqueio_id" value="<?php echo $this->form_encode_input($aereo_bloqueio_id) . "\">" . $aereo_bloqueio_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_aereo_bloqueio_id();
   $x = 0 ; 
   $aereo_bloqueio_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aereo_bloqueio_id_1))
          {
              foreach ($this->aereo_bloqueio_id_1 as $tmp_aereo_bloqueio_id)
              {
                  if (trim($tmp_aereo_bloqueio_id) === trim($cadaselect[1])) {$aereo_bloqueio_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->aereo_bloqueio_id)) {
                 if (trim($this->aereo_bloqueio_id) == trim($cadaselect[1])) { $aereo_bloqueio_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->aereo_bloqueio_id == $cadaselect[1]) { $aereo_bloqueio_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($aereo_bloqueio_id_look))
          {
              $aereo_bloqueio_id_look = $this->aereo_bloqueio_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_aereo_bloqueio_id\" class=\"css_aereo_bloqueio_id_line\" style=\"" .  $sStyleReadLab_aereo_bloqueio_id . "\">" . $this->form_format_readonly("aereo_bloqueio_id", $this->form_encode_input($aereo_bloqueio_id_look)) . "</span><span id=\"id_read_off_aereo_bloqueio_id\" class=\"css_read_off_aereo_bloqueio_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_aereo_bloqueio_id . "\">";
   echo " <span id=\"idAjaxSelect_aereo_bloqueio_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_aereo_bloqueio_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_aereo_bloqueio_id\" name=\"aereo_bloqueio_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_bloqueio_id'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;","SEM BLOQUEIO") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->aereo_bloqueio_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->aereo_bloqueio_id)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_bloqueio_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_bloqueio_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_cia_aerea']))
   {
       $this->nm_new_label['aereo_cia_aerea'] = "Cia Aérea:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_cia_aerea = $this->aereo_cia_aerea;
   $sStyleHidden_aereo_cia_aerea = '';
   if (isset($this->nmgp_cmp_hidden['aereo_cia_aerea']) && $this->nmgp_cmp_hidden['aereo_cia_aerea'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_cia_aerea']);
       $sStyleHidden_aereo_cia_aerea = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_cia_aerea = 'display: none;';
   $sStyleReadInp_aereo_cia_aerea = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_cia_aerea']) && $this->nmgp_cmp_readonly['aereo_cia_aerea'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_cia_aerea']);
       $sStyleReadLab_aereo_cia_aerea = '';
       $sStyleReadInp_aereo_cia_aerea = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_cia_aerea']) && $this->nmgp_cmp_hidden['aereo_cia_aerea'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aereo_cia_aerea" value="<?php echo $this->form_encode_input($this->aereo_cia_aerea) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_cia_aerea" style="<?php echo $sStyleHidden_aereo_cia_aerea; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_cia_aerea_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_cia_aerea_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_cia_aerea"><?php echo $this->nm_new_label['aereo_cia_aerea']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_cia_aerea']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_cia_aerea'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_aereo_cia_aerea_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_cia_aerea"]) &&  $this->nmgp_cmp_readonly["aereo_cia_aerea"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea'] = array(); 
    }

   $old_value_aereo_dt_saida = $this->aereo_dt_saida;
   $old_value_aereo_hr_saida = $this->aereo_hr_saida;
   $old_value_aereo_dt_chegada = $this->aereo_dt_chegada;
   $old_value_aereo_hr_chegada = $this->aereo_hr_chegada;
   $old_value_aereo_valor = $this->aereo_valor;
   $old_value_duracao_voo_api = $this->duracao_voo_api;
   $old_value_duracao_escala = $this->duracao_escala;
   $old_value_hora_saida_escala = $this->hora_saida_escala;
   $old_value_hora_chegada_escala = $this->hora_chegada_escala;
   $old_value_aereo_id_usuario = $this->aereo_id_usuario;
   $old_value_aereo_dthr_saida = $this->aereo_dthr_saida;
   $old_value_aereo_dthr_saida_hora = $this->aereo_dthr_saida_hora;
   $old_value_aereo_dthr_chegada = $this->aereo_dthr_chegada;
   $old_value_aereo_dthr_chegada_hora = $this->aereo_dthr_chegada_hora;
   $old_value_id_origem_gate = $this->id_origem_gate;
   $old_value_aereo_trecho = $this->aereo_trecho;
   $old_value_aereo_modificado_em = $this->aereo_modificado_em;
   $old_value_aereo_modificado_em_hora = $this->aereo_modificado_em_hora;
   $old_value_data_nota_gate = $this->data_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_aereo_dt_saida = $this->aereo_dt_saida;
   $unformatted_value_aereo_hr_saida = $this->aereo_hr_saida;
   $unformatted_value_aereo_dt_chegada = $this->aereo_dt_chegada;
   $unformatted_value_aereo_hr_chegada = $this->aereo_hr_chegada;
   $unformatted_value_aereo_valor = $this->aereo_valor;
   $unformatted_value_duracao_voo_api = $this->duracao_voo_api;
   $unformatted_value_duracao_escala = $this->duracao_escala;
   $unformatted_value_hora_saida_escala = $this->hora_saida_escala;
   $unformatted_value_hora_chegada_escala = $this->hora_chegada_escala;
   $unformatted_value_aereo_id_usuario = $this->aereo_id_usuario;
   $unformatted_value_aereo_dthr_saida = $this->aereo_dthr_saida;
   $unformatted_value_aereo_dthr_saida_hora = $this->aereo_dthr_saida_hora;
   $unformatted_value_aereo_dthr_chegada = $this->aereo_dthr_chegada;
   $unformatted_value_aereo_dthr_chegada_hora = $this->aereo_dthr_chegada_hora;
   $unformatted_value_id_origem_gate = $this->id_origem_gate;
   $unformatted_value_aereo_trecho = $this->aereo_trecho;
   $unformatted_value_aereo_modificado_em = $this->aereo_modificado_em;
   $unformatted_value_aereo_modificado_em_hora = $this->aereo_modificado_em_hora;
   $unformatted_value_data_nota_gate = $this->data_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT cia_id, cia_nome + ' - ' + cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT cia_id, concat(cia_nome,' - ', cia_sigla)  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT cia_id, cia_nome&' - '&cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT cia_id, cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT cia_id, cia_nome + ' - ' + cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT cia_id, cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }
   else
   {
       $nm_comando = "SELECT cia_id, cia_nome||' - '||cia_sigla  FROM tbl_cia_aereas  WHERE cia_ativo = 'Y' ORDER BY cia_nome, cia_sigla";
   }

   $this->aereo_dt_saida = $old_value_aereo_dt_saida;
   $this->aereo_hr_saida = $old_value_aereo_hr_saida;
   $this->aereo_dt_chegada = $old_value_aereo_dt_chegada;
   $this->aereo_hr_chegada = $old_value_aereo_hr_chegada;
   $this->aereo_valor = $old_value_aereo_valor;
   $this->duracao_voo_api = $old_value_duracao_voo_api;
   $this->duracao_escala = $old_value_duracao_escala;
   $this->hora_saida_escala = $old_value_hora_saida_escala;
   $this->hora_chegada_escala = $old_value_hora_chegada_escala;
   $this->aereo_id_usuario = $old_value_aereo_id_usuario;
   $this->aereo_dthr_saida = $old_value_aereo_dthr_saida;
   $this->aereo_dthr_saida_hora = $old_value_aereo_dthr_saida_hora;
   $this->aereo_dthr_chegada = $old_value_aereo_dthr_chegada;
   $this->aereo_dthr_chegada_hora = $old_value_aereo_dthr_chegada_hora;
   $this->id_origem_gate = $old_value_id_origem_gate;
   $this->aereo_trecho = $old_value_aereo_trecho;
   $this->aereo_modificado_em = $old_value_aereo_modificado_em;
   $this->aereo_modificado_em_hora = $old_value_aereo_modificado_em_hora;
   $this->data_nota_gate = $old_value_data_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea'][] = $rs->fields[0];
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
   $aereo_cia_aerea_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aereo_cia_aerea_1))
          {
              foreach ($this->aereo_cia_aerea_1 as $tmp_aereo_cia_aerea)
              {
                  if (trim($tmp_aereo_cia_aerea) === trim($cadaselect[1])) {$aereo_cia_aerea_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->aereo_cia_aerea) && trim($this->aereo_cia_aerea) === trim($cadaselect[1])) {$aereo_cia_aerea_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="aereo_cia_aerea" value="<?php echo $this->form_encode_input($aereo_cia_aerea) . "\">" . $aereo_cia_aerea_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_aereo_cia_aerea();
   $x = 0 ; 
   $aereo_cia_aerea_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aereo_cia_aerea_1))
          {
              foreach ($this->aereo_cia_aerea_1 as $tmp_aereo_cia_aerea)
              {
                  if (trim($tmp_aereo_cia_aerea) === trim($cadaselect[1])) {$aereo_cia_aerea_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->aereo_cia_aerea)) {
                 if (trim($this->aereo_cia_aerea) == trim($cadaselect[1])) { $aereo_cia_aerea_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->aereo_cia_aerea == $cadaselect[1]) { $aereo_cia_aerea_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($aereo_cia_aerea_look))
          {
              $aereo_cia_aerea_look = $this->aereo_cia_aerea;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_aereo_cia_aerea\" class=\"css_aereo_cia_aerea_line\" style=\"" .  $sStyleReadLab_aereo_cia_aerea . "\">" . $this->form_format_readonly("aereo_cia_aerea", $this->form_encode_input($aereo_cia_aerea_look)) . "</span><span id=\"id_read_off_aereo_cia_aerea\" class=\"css_read_off_aereo_cia_aerea" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_aereo_cia_aerea . "\">";
   echo " <span id=\"idAjaxSelect_aereo_cia_aerea\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_aereo_cia_aerea_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_aereo_cia_aerea\" name=\"aereo_cia_aerea\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_cia_aerea'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->aereo_cia_aerea) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->aereo_cia_aerea)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_cia_aerea_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_cia_aerea_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_origem']))
   {
       $this->nm_new_label['aereo_origem'] = "Origem:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_origem = $this->aereo_origem;
   $sStyleHidden_aereo_origem = '';
   if (isset($this->nmgp_cmp_hidden['aereo_origem']) && $this->nmgp_cmp_hidden['aereo_origem'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_origem']);
       $sStyleHidden_aereo_origem = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_origem = 'display: none;';
   $sStyleReadInp_aereo_origem = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_origem']) && $this->nmgp_cmp_readonly['aereo_origem'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_origem']);
       $sStyleReadLab_aereo_origem = '';
       $sStyleReadInp_aereo_origem = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_origem']) && $this->nmgp_cmp_hidden['aereo_origem'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aereo_origem" value="<?php echo $this->form_encode_input($this->aereo_origem) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_origem" style="<?php echo $sStyleHidden_aereo_origem; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_origem_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_origem_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_origem"><?php echo $this->nm_new_label['aereo_origem']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_origem']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_origem'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_aereo_origem_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_origem"]) &&  $this->nmgp_cmp_readonly["aereo_origem"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem'] = array(); 
    }

   $old_value_aereo_dt_saida = $this->aereo_dt_saida;
   $old_value_aereo_hr_saida = $this->aereo_hr_saida;
   $old_value_aereo_dt_chegada = $this->aereo_dt_chegada;
   $old_value_aereo_hr_chegada = $this->aereo_hr_chegada;
   $old_value_aereo_valor = $this->aereo_valor;
   $old_value_duracao_voo_api = $this->duracao_voo_api;
   $old_value_duracao_escala = $this->duracao_escala;
   $old_value_hora_saida_escala = $this->hora_saida_escala;
   $old_value_hora_chegada_escala = $this->hora_chegada_escala;
   $old_value_aereo_id_usuario = $this->aereo_id_usuario;
   $old_value_aereo_dthr_saida = $this->aereo_dthr_saida;
   $old_value_aereo_dthr_saida_hora = $this->aereo_dthr_saida_hora;
   $old_value_aereo_dthr_chegada = $this->aereo_dthr_chegada;
   $old_value_aereo_dthr_chegada_hora = $this->aereo_dthr_chegada_hora;
   $old_value_id_origem_gate = $this->id_origem_gate;
   $old_value_aereo_trecho = $this->aereo_trecho;
   $old_value_aereo_modificado_em = $this->aereo_modificado_em;
   $old_value_aereo_modificado_em_hora = $this->aereo_modificado_em_hora;
   $old_value_data_nota_gate = $this->data_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_aereo_dt_saida = $this->aereo_dt_saida;
   $unformatted_value_aereo_hr_saida = $this->aereo_hr_saida;
   $unformatted_value_aereo_dt_chegada = $this->aereo_dt_chegada;
   $unformatted_value_aereo_hr_chegada = $this->aereo_hr_chegada;
   $unformatted_value_aereo_valor = $this->aereo_valor;
   $unformatted_value_duracao_voo_api = $this->duracao_voo_api;
   $unformatted_value_duracao_escala = $this->duracao_escala;
   $unformatted_value_hora_saida_escala = $this->hora_saida_escala;
   $unformatted_value_hora_chegada_escala = $this->hora_chegada_escala;
   $unformatted_value_aereo_id_usuario = $this->aereo_id_usuario;
   $unformatted_value_aereo_dthr_saida = $this->aereo_dthr_saida;
   $unformatted_value_aereo_dthr_saida_hora = $this->aereo_dthr_saida_hora;
   $unformatted_value_aereo_dthr_chegada = $this->aereo_dthr_chegada;
   $unformatted_value_aereo_dthr_chegada_hora = $this->aereo_dthr_chegada_hora;
   $unformatted_value_id_origem_gate = $this->id_origem_gate;
   $unformatted_value_aereo_trecho = $this->aereo_trecho;
   $unformatted_value_aereo_modificado_em = $this->aereo_modificado_em;
   $unformatted_value_aereo_modificado_em_hora = $this->aereo_modificado_em_hora;
   $unformatted_value_data_nota_gate = $this->data_nota_gate;

   $desab_inout_val_str = "''";
   if (!empty($this->desab_inout))
   {
       if (is_array($this->desab_inout))
       {
           $Tmp_array = $this->desab_inout;
       }
       else
       {
           $Tmp_array = explode(";", $this->desab_inout);
       }
       $desab_inout_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $desab_inout_val_str)
          {
             $desab_inout_val_str .= ", ";
          }
          $desab_inout_val_str .= "'$Tmp_val_cmp'";
       }
   }
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, concat(NOM_AEROPORTO,' - ', SIGLA,' - ', NOM_CIDADE)  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   else
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }

   $this->aereo_dt_saida = $old_value_aereo_dt_saida;
   $this->aereo_hr_saida = $old_value_aereo_hr_saida;
   $this->aereo_dt_chegada = $old_value_aereo_dt_chegada;
   $this->aereo_hr_chegada = $old_value_aereo_hr_chegada;
   $this->aereo_valor = $old_value_aereo_valor;
   $this->duracao_voo_api = $old_value_duracao_voo_api;
   $this->duracao_escala = $old_value_duracao_escala;
   $this->hora_saida_escala = $old_value_hora_saida_escala;
   $this->hora_chegada_escala = $old_value_hora_chegada_escala;
   $this->aereo_id_usuario = $old_value_aereo_id_usuario;
   $this->aereo_dthr_saida = $old_value_aereo_dthr_saida;
   $this->aereo_dthr_saida_hora = $old_value_aereo_dthr_saida_hora;
   $this->aereo_dthr_chegada = $old_value_aereo_dthr_chegada;
   $this->aereo_dthr_chegada_hora = $old_value_aereo_dthr_chegada_hora;
   $this->id_origem_gate = $old_value_id_origem_gate;
   $this->aereo_trecho = $old_value_aereo_trecho;
   $this->aereo_modificado_em = $old_value_aereo_modificado_em;
   $this->aereo_modificado_em_hora = $old_value_aereo_modificado_em_hora;
   $this->data_nota_gate = $old_value_data_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem'][] = $rs->fields[0];
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
   $aereo_origem_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aereo_origem_1))
          {
              foreach ($this->aereo_origem_1 as $tmp_aereo_origem)
              {
                  if (trim($tmp_aereo_origem) === trim($cadaselect[1])) {$aereo_origem_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->aereo_origem) && trim($this->aereo_origem) === trim($cadaselect[1])) {$aereo_origem_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="aereo_origem" value="<?php echo $this->form_encode_input($aereo_origem) . "\">" . $aereo_origem_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_aereo_origem();
   $x = 0 ; 
   $aereo_origem_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aereo_origem_1))
          {
              foreach ($this->aereo_origem_1 as $tmp_aereo_origem)
              {
                  if (trim($tmp_aereo_origem) === trim($cadaselect[1])) {$aereo_origem_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->aereo_origem)) {
                 if (trim($this->aereo_origem) == trim($cadaselect[1])) { $aereo_origem_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->aereo_origem == $cadaselect[1]) { $aereo_origem_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($aereo_origem_look))
          {
              $aereo_origem_look = $this->aereo_origem;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_aereo_origem\" class=\"css_aereo_origem_line\" style=\"" .  $sStyleReadLab_aereo_origem . "\">" . $this->form_format_readonly("aereo_origem", $this->form_encode_input($aereo_origem_look)) . "</span><span id=\"id_read_off_aereo_origem\" class=\"css_read_off_aereo_origem" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_aereo_origem . "\">";
   echo " <span id=\"idAjaxSelect_aereo_origem\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_aereo_origem_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_aereo_origem\" name=\"aereo_origem\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_origem'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->aereo_origem) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->aereo_origem)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_origem_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_origem_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_destino']))
   {
       $this->nm_new_label['aereo_destino'] = "Destino:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_destino = $this->aereo_destino;
   $sStyleHidden_aereo_destino = '';
   if (isset($this->nmgp_cmp_hidden['aereo_destino']) && $this->nmgp_cmp_hidden['aereo_destino'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_destino']);
       $sStyleHidden_aereo_destino = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_destino = 'display: none;';
   $sStyleReadInp_aereo_destino = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_destino']) && $this->nmgp_cmp_readonly['aereo_destino'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_destino']);
       $sStyleReadLab_aereo_destino = '';
       $sStyleReadInp_aereo_destino = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_destino']) && $this->nmgp_cmp_hidden['aereo_destino'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aereo_destino" value="<?php echo $this->form_encode_input($this->aereo_destino) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_destino" style="<?php echo $sStyleHidden_aereo_destino; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_destino_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_destino_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_destino"><?php echo $this->nm_new_label['aereo_destino']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_destino']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_destino'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_aereo_destino_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_destino"]) &&  $this->nmgp_cmp_readonly["aereo_destino"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino'] = array(); 
    }

   $old_value_aereo_dt_saida = $this->aereo_dt_saida;
   $old_value_aereo_hr_saida = $this->aereo_hr_saida;
   $old_value_aereo_dt_chegada = $this->aereo_dt_chegada;
   $old_value_aereo_hr_chegada = $this->aereo_hr_chegada;
   $old_value_aereo_valor = $this->aereo_valor;
   $old_value_duracao_voo_api = $this->duracao_voo_api;
   $old_value_duracao_escala = $this->duracao_escala;
   $old_value_hora_saida_escala = $this->hora_saida_escala;
   $old_value_hora_chegada_escala = $this->hora_chegada_escala;
   $old_value_aereo_id_usuario = $this->aereo_id_usuario;
   $old_value_aereo_dthr_saida = $this->aereo_dthr_saida;
   $old_value_aereo_dthr_saida_hora = $this->aereo_dthr_saida_hora;
   $old_value_aereo_dthr_chegada = $this->aereo_dthr_chegada;
   $old_value_aereo_dthr_chegada_hora = $this->aereo_dthr_chegada_hora;
   $old_value_id_origem_gate = $this->id_origem_gate;
   $old_value_aereo_trecho = $this->aereo_trecho;
   $old_value_aereo_modificado_em = $this->aereo_modificado_em;
   $old_value_aereo_modificado_em_hora = $this->aereo_modificado_em_hora;
   $old_value_data_nota_gate = $this->data_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_aereo_dt_saida = $this->aereo_dt_saida;
   $unformatted_value_aereo_hr_saida = $this->aereo_hr_saida;
   $unformatted_value_aereo_dt_chegada = $this->aereo_dt_chegada;
   $unformatted_value_aereo_hr_chegada = $this->aereo_hr_chegada;
   $unformatted_value_aereo_valor = $this->aereo_valor;
   $unformatted_value_duracao_voo_api = $this->duracao_voo_api;
   $unformatted_value_duracao_escala = $this->duracao_escala;
   $unformatted_value_hora_saida_escala = $this->hora_saida_escala;
   $unformatted_value_hora_chegada_escala = $this->hora_chegada_escala;
   $unformatted_value_aereo_id_usuario = $this->aereo_id_usuario;
   $unformatted_value_aereo_dthr_saida = $this->aereo_dthr_saida;
   $unformatted_value_aereo_dthr_saida_hora = $this->aereo_dthr_saida_hora;
   $unformatted_value_aereo_dthr_chegada = $this->aereo_dthr_chegada;
   $unformatted_value_aereo_dthr_chegada_hora = $this->aereo_dthr_chegada_hora;
   $unformatted_value_id_origem_gate = $this->id_origem_gate;
   $unformatted_value_aereo_trecho = $this->aereo_trecho;
   $unformatted_value_aereo_modificado_em = $this->aereo_modificado_em;
   $unformatted_value_aereo_modificado_em_hora = $this->aereo_modificado_em_hora;
   $unformatted_value_data_nota_gate = $this->data_nota_gate;

   $desab_inout_val_str = "''";
   if (!empty($this->desab_inout))
   {
       if (is_array($this->desab_inout))
       {
           $Tmp_array = $this->desab_inout;
       }
       else
       {
           $Tmp_array = explode(";", $this->desab_inout);
       }
       $desab_inout_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $desab_inout_val_str)
          {
             $desab_inout_val_str .= ", ";
          }
          $desab_inout_val_str .= "'$Tmp_val_cmp'";
       }
   }
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, concat(NOM_AEROPORTO,' - ', SIGLA,' - ', NOM_CIDADE)  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO&' - '&SIGLA&' - '&NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO + ' - ' + SIGLA + ' - ' + NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }
   else
   {
       $nm_comando = "SELECT COD_AEROPORTO, NOM_AEROPORTO||' - '||SIGLA||' - '||NOM_CIDADE  FROM aeroporto  ORDER BY NOM_AEROPORTO, SIGLA, NOM_CIDADE";
   }

   $this->aereo_dt_saida = $old_value_aereo_dt_saida;
   $this->aereo_hr_saida = $old_value_aereo_hr_saida;
   $this->aereo_dt_chegada = $old_value_aereo_dt_chegada;
   $this->aereo_hr_chegada = $old_value_aereo_hr_chegada;
   $this->aereo_valor = $old_value_aereo_valor;
   $this->duracao_voo_api = $old_value_duracao_voo_api;
   $this->duracao_escala = $old_value_duracao_escala;
   $this->hora_saida_escala = $old_value_hora_saida_escala;
   $this->hora_chegada_escala = $old_value_hora_chegada_escala;
   $this->aereo_id_usuario = $old_value_aereo_id_usuario;
   $this->aereo_dthr_saida = $old_value_aereo_dthr_saida;
   $this->aereo_dthr_saida_hora = $old_value_aereo_dthr_saida_hora;
   $this->aereo_dthr_chegada = $old_value_aereo_dthr_chegada;
   $this->aereo_dthr_chegada_hora = $old_value_aereo_dthr_chegada_hora;
   $this->id_origem_gate = $old_value_id_origem_gate;
   $this->aereo_trecho = $old_value_aereo_trecho;
   $this->aereo_modificado_em = $old_value_aereo_modificado_em;
   $this->aereo_modificado_em_hora = $old_value_aereo_modificado_em_hora;
   $this->data_nota_gate = $old_value_data_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino'][] = $rs->fields[0];
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
   $aereo_destino_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aereo_destino_1))
          {
              foreach ($this->aereo_destino_1 as $tmp_aereo_destino)
              {
                  if (trim($tmp_aereo_destino) === trim($cadaselect[1])) {$aereo_destino_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->aereo_destino) && trim($this->aereo_destino) === trim($cadaselect[1])) {$aereo_destino_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="aereo_destino" value="<?php echo $this->form_encode_input($aereo_destino) . "\">" . $aereo_destino_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_aereo_destino();
   $x = 0 ; 
   $aereo_destino_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->aereo_destino_1))
          {
              foreach ($this->aereo_destino_1 as $tmp_aereo_destino)
              {
                  if (trim($tmp_aereo_destino) === trim($cadaselect[1])) {$aereo_destino_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->aereo_destino)) {
                 if (trim($this->aereo_destino) == trim($cadaselect[1])) { $aereo_destino_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->aereo_destino == $cadaselect[1]) { $aereo_destino_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($aereo_destino_look))
          {
              $aereo_destino_look = $this->aereo_destino;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_aereo_destino\" class=\"css_aereo_destino_line\" style=\"" .  $sStyleReadLab_aereo_destino . "\">" . $this->form_format_readonly("aereo_destino", $this->form_encode_input($aereo_destino_look)) . "</span><span id=\"id_read_off_aereo_destino\" class=\"css_read_off_aereo_destino" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_aereo_destino . "\">";
   echo " <span id=\"idAjaxSelect_aereo_destino\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_aereo_destino_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_aereo_destino\" name=\"aereo_destino\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_destino'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->aereo_destino) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->aereo_destino)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_destino_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_destino_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_dt_saida']))
    {
        $this->nm_new_label['aereo_dt_saida'] = " Data Saída:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_dt_saida = $this->aereo_dt_saida;
   $sStyleHidden_aereo_dt_saida = '';
   if (isset($this->nmgp_cmp_hidden['aereo_dt_saida']) && $this->nmgp_cmp_hidden['aereo_dt_saida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_dt_saida']);
       $sStyleHidden_aereo_dt_saida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_dt_saida = 'display: none;';
   $sStyleReadInp_aereo_dt_saida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_dt_saida']) && $this->nmgp_cmp_readonly['aereo_dt_saida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_dt_saida']);
       $sStyleReadLab_aereo_dt_saida = '';
       $sStyleReadInp_aereo_dt_saida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_dt_saida']) && $this->nmgp_cmp_hidden['aereo_dt_saida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_dt_saida" value="<?php echo $this->form_encode_input($aereo_dt_saida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_dt_saida" style="<?php echo $sStyleHidden_aereo_dt_saida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_dt_saida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_dt_saida_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_dt_saida"><?php echo $this->nm_new_label['aereo_dt_saida']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_dt_saida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_dt_saida'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_aereo_dt_saida_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_dt_saida"]) &&  $this->nmgp_cmp_readonly["aereo_dt_saida"] == "on") { 

 ?>
<input type="hidden" name="aereo_dt_saida" value="<?php echo $this->form_encode_input($aereo_dt_saida) . "\">" . $aereo_dt_saida . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_dt_saida" class="sc-ui-readonly-aereo_dt_saida css_aereo_dt_saida_line" style="<?php echo $sStyleReadLab_aereo_dt_saida; ?>"><?php echo $this->form_format_readonly("aereo_dt_saida", $this->form_encode_input($aereo_dt_saida)); ?></span><span id="id_read_off_aereo_dt_saida" class="css_read_off_aereo_dt_saida<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_dt_saida; ?>"><?php
$tmp_form_data = $this->field_config['aereo_dt_saida']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_aereo_dt_saida_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_dt_saida" type=text name="aereo_dt_saida" value="<?php echo $this->form_encode_input($aereo_dt_saida) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['aereo_dt_saida']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['aereo_dt_saida']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_dt_saida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_dt_saida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_hr_saida']))
    {
        $this->nm_new_label['aereo_hr_saida'] = "Hora Saída:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_hr_saida = $this->aereo_hr_saida;
   $sStyleHidden_aereo_hr_saida = '';
   if (isset($this->nmgp_cmp_hidden['aereo_hr_saida']) && $this->nmgp_cmp_hidden['aereo_hr_saida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_hr_saida']);
       $sStyleHidden_aereo_hr_saida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_hr_saida = 'display: none;';
   $sStyleReadInp_aereo_hr_saida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_hr_saida']) && $this->nmgp_cmp_readonly['aereo_hr_saida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_hr_saida']);
       $sStyleReadLab_aereo_hr_saida = '';
       $sStyleReadInp_aereo_hr_saida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_hr_saida']) && $this->nmgp_cmp_hidden['aereo_hr_saida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_hr_saida" value="<?php echo $this->form_encode_input($aereo_hr_saida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_hr_saida" style="<?php echo $sStyleHidden_aereo_hr_saida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_hr_saida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_hr_saida_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_hr_saida"><?php echo $this->nm_new_label['aereo_hr_saida']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_hr_saida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_hr_saida'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_aereo_hr_saida_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_hr_saida"]) &&  $this->nmgp_cmp_readonly["aereo_hr_saida"] == "on") { 

 ?>
<input type="hidden" name="aereo_hr_saida" value="<?php echo $this->form_encode_input($aereo_hr_saida) . "\">" . $aereo_hr_saida . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_hr_saida" class="sc-ui-readonly-aereo_hr_saida css_aereo_hr_saida_line" style="<?php echo $sStyleReadLab_aereo_hr_saida; ?>"><?php echo $this->form_format_readonly("aereo_hr_saida", $this->form_encode_input($aereo_hr_saida)); ?></span><span id="id_read_off_aereo_hr_saida" class="css_read_off_aereo_hr_saida<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_hr_saida; ?>"><?php
$tmp_form_data = $this->field_config['aereo_hr_saida']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_aereo_hr_saida_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_hr_saida" type=text name="aereo_hr_saida" value="<?php echo $this->form_encode_input($aereo_hr_saida) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['aereo_hr_saida']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['aereo_hr_saida']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_hr_saida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_hr_saida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_dt_chegada']))
    {
        $this->nm_new_label['aereo_dt_chegada'] = "Data Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_dt_chegada = $this->aereo_dt_chegada;
   $sStyleHidden_aereo_dt_chegada = '';
   if (isset($this->nmgp_cmp_hidden['aereo_dt_chegada']) && $this->nmgp_cmp_hidden['aereo_dt_chegada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_dt_chegada']);
       $sStyleHidden_aereo_dt_chegada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_dt_chegada = 'display: none;';
   $sStyleReadInp_aereo_dt_chegada = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_dt_chegada']) && $this->nmgp_cmp_readonly['aereo_dt_chegada'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_dt_chegada']);
       $sStyleReadLab_aereo_dt_chegada = '';
       $sStyleReadInp_aereo_dt_chegada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_dt_chegada']) && $this->nmgp_cmp_hidden['aereo_dt_chegada'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_dt_chegada" value="<?php echo $this->form_encode_input($aereo_dt_chegada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_dt_chegada" style="<?php echo $sStyleHidden_aereo_dt_chegada; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_dt_chegada_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_dt_chegada_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_dt_chegada"><?php echo $this->nm_new_label['aereo_dt_chegada']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_dt_chegada']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_dt_chegada'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_aereo_dt_chegada_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_dt_chegada"]) &&  $this->nmgp_cmp_readonly["aereo_dt_chegada"] == "on") { 

 ?>
<input type="hidden" name="aereo_dt_chegada" value="<?php echo $this->form_encode_input($aereo_dt_chegada) . "\">" . $aereo_dt_chegada . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_dt_chegada" class="sc-ui-readonly-aereo_dt_chegada css_aereo_dt_chegada_line" style="<?php echo $sStyleReadLab_aereo_dt_chegada; ?>"><?php echo $this->form_format_readonly("aereo_dt_chegada", $this->form_encode_input($aereo_dt_chegada)); ?></span><span id="id_read_off_aereo_dt_chegada" class="css_read_off_aereo_dt_chegada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_dt_chegada; ?>"><?php
$tmp_form_data = $this->field_config['aereo_dt_chegada']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_aereo_dt_chegada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_dt_chegada" type=text name="aereo_dt_chegada" value="<?php echo $this->form_encode_input($aereo_dt_chegada) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['aereo_dt_chegada']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['aereo_dt_chegada']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_dt_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_dt_chegada_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_hr_chegada']))
    {
        $this->nm_new_label['aereo_hr_chegada'] = "Hora Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_hr_chegada = $this->aereo_hr_chegada;
   $sStyleHidden_aereo_hr_chegada = '';
   if (isset($this->nmgp_cmp_hidden['aereo_hr_chegada']) && $this->nmgp_cmp_hidden['aereo_hr_chegada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_hr_chegada']);
       $sStyleHidden_aereo_hr_chegada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_hr_chegada = 'display: none;';
   $sStyleReadInp_aereo_hr_chegada = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_hr_chegada']) && $this->nmgp_cmp_readonly['aereo_hr_chegada'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_hr_chegada']);
       $sStyleReadLab_aereo_hr_chegada = '';
       $sStyleReadInp_aereo_hr_chegada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_hr_chegada']) && $this->nmgp_cmp_hidden['aereo_hr_chegada'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_hr_chegada" value="<?php echo $this->form_encode_input($aereo_hr_chegada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_hr_chegada" style="<?php echo $sStyleHidden_aereo_hr_chegada; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_hr_chegada_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_hr_chegada_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_hr_chegada"><?php echo $this->nm_new_label['aereo_hr_chegada']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_hr_chegada']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_hr_chegada'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_aereo_hr_chegada_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_hr_chegada"]) &&  $this->nmgp_cmp_readonly["aereo_hr_chegada"] == "on") { 

 ?>
<input type="hidden" name="aereo_hr_chegada" value="<?php echo $this->form_encode_input($aereo_hr_chegada) . "\">" . $aereo_hr_chegada . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_hr_chegada" class="sc-ui-readonly-aereo_hr_chegada css_aereo_hr_chegada_line" style="<?php echo $sStyleReadLab_aereo_hr_chegada; ?>"><?php echo $this->form_format_readonly("aereo_hr_chegada", $this->form_encode_input($aereo_hr_chegada)); ?></span><span id="id_read_off_aereo_hr_chegada" class="css_read_off_aereo_hr_chegada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_hr_chegada; ?>"><?php
$tmp_form_data = $this->field_config['aereo_hr_chegada']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_aereo_hr_chegada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_hr_chegada" type=text name="aereo_hr_chegada" value="<?php echo $this->form_encode_input($aereo_hr_chegada) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['aereo_hr_chegada']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['aereo_hr_chegada']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_hr_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_hr_chegada_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_num_voo']))
    {
        $this->nm_new_label['aereo_num_voo'] = "Num. Voo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_num_voo = $this->aereo_num_voo;
   $sStyleHidden_aereo_num_voo = '';
   if (isset($this->nmgp_cmp_hidden['aereo_num_voo']) && $this->nmgp_cmp_hidden['aereo_num_voo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_num_voo']);
       $sStyleHidden_aereo_num_voo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_num_voo = 'display: none;';
   $sStyleReadInp_aereo_num_voo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_num_voo']) && $this->nmgp_cmp_readonly['aereo_num_voo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_num_voo']);
       $sStyleReadLab_aereo_num_voo = '';
       $sStyleReadInp_aereo_num_voo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_num_voo']) && $this->nmgp_cmp_hidden['aereo_num_voo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_num_voo" value="<?php echo $this->form_encode_input($aereo_num_voo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_num_voo" style="<?php echo $sStyleHidden_aereo_num_voo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_num_voo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_num_voo_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_num_voo"><?php echo $this->nm_new_label['aereo_num_voo']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_num_voo']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['php_cmp_required']['aereo_num_voo'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_aereo_num_voo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_num_voo"]) &&  $this->nmgp_cmp_readonly["aereo_num_voo"] == "on") { 

 ?>
<input type="hidden" name="aereo_num_voo" value="<?php echo $this->form_encode_input($aereo_num_voo) . "\">" . $aereo_num_voo . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_num_voo" class="sc-ui-readonly-aereo_num_voo css_aereo_num_voo_line" style="<?php echo $sStyleReadLab_aereo_num_voo; ?>"><?php echo $this->form_format_readonly("aereo_num_voo", $this->form_encode_input($this->aereo_num_voo)); ?></span><span id="id_read_off_aereo_num_voo" class="css_read_off_aereo_num_voo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_num_voo; ?>">
 <input class="sc-js-input scFormObjectOdd css_aereo_num_voo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_num_voo" type=text name="aereo_num_voo" value="<?php echo $this->form_encode_input($aereo_num_voo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_num_voo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_num_voo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_localizador']))
    {
        $this->nm_new_label['aereo_localizador'] = "Localizador:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_localizador = $this->aereo_localizador;
   $sStyleHidden_aereo_localizador = '';
   if (isset($this->nmgp_cmp_hidden['aereo_localizador']) && $this->nmgp_cmp_hidden['aereo_localizador'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_localizador']);
       $sStyleHidden_aereo_localizador = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_localizador = 'display: none;';
   $sStyleReadInp_aereo_localizador = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_localizador']) && $this->nmgp_cmp_readonly['aereo_localizador'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_localizador']);
       $sStyleReadLab_aereo_localizador = '';
       $sStyleReadInp_aereo_localizador = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_localizador']) && $this->nmgp_cmp_hidden['aereo_localizador'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_localizador" value="<?php echo $this->form_encode_input($aereo_localizador) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_localizador" style="<?php echo $sStyleHidden_aereo_localizador; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_localizador_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_localizador_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_localizador"><?php echo $this->nm_new_label['aereo_localizador']; ?></span></td></tr><tr><td class="css_aereo_localizador_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_localizador"]) &&  $this->nmgp_cmp_readonly["aereo_localizador"] == "on") { 

 ?>
<input type="hidden" name="aereo_localizador" value="<?php echo $this->form_encode_input($aereo_localizador) . "\">" . $aereo_localizador . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_localizador" class="sc-ui-readonly-aereo_localizador css_aereo_localizador_line" style="<?php echo $sStyleReadLab_aereo_localizador; ?>"><?php echo $this->form_format_readonly("aereo_localizador", $this->form_encode_input($this->aereo_localizador)); ?></span><span id="id_read_off_aereo_localizador" class="css_read_off_aereo_localizador<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_localizador; ?>">
 <input class="sc-js-input scFormObjectOdd css_aereo_localizador_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_localizador" type=text name="aereo_localizador" value="<?php echo $this->form_encode_input($aereo_localizador) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_localizador_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_localizador_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_eticket']))
    {
        $this->nm_new_label['aereo_eticket'] = "E-Ticket:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_eticket = $this->aereo_eticket;
   $sStyleHidden_aereo_eticket = '';
   if (isset($this->nmgp_cmp_hidden['aereo_eticket']) && $this->nmgp_cmp_hidden['aereo_eticket'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_eticket']);
       $sStyleHidden_aereo_eticket = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_eticket = 'display: none;';
   $sStyleReadInp_aereo_eticket = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_eticket']) && $this->nmgp_cmp_readonly['aereo_eticket'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_eticket']);
       $sStyleReadLab_aereo_eticket = '';
       $sStyleReadInp_aereo_eticket = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_eticket']) && $this->nmgp_cmp_hidden['aereo_eticket'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_eticket" value="<?php echo $this->form_encode_input($aereo_eticket) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_eticket" style="<?php echo $sStyleHidden_aereo_eticket; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_eticket_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_eticket_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_eticket"><?php echo $this->nm_new_label['aereo_eticket']; ?></span></td></tr><tr><td class="css_aereo_eticket_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_eticket"]) &&  $this->nmgp_cmp_readonly["aereo_eticket"] == "on") { 

 ?>
<input type="hidden" name="aereo_eticket" value="<?php echo $this->form_encode_input($aereo_eticket) . "\">" . $aereo_eticket . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_eticket" class="sc-ui-readonly-aereo_eticket css_aereo_eticket_line" style="<?php echo $sStyleReadLab_aereo_eticket; ?>"><?php echo $this->form_format_readonly("aereo_eticket", $this->form_encode_input($this->aereo_eticket)); ?></span><span id="id_read_off_aereo_eticket" class="css_read_off_aereo_eticket<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_eticket; ?>">
 <input class="sc-js-input scFormObjectOdd css_aereo_eticket_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_eticket" type=text name="aereo_eticket" value="<?php echo $this->form_encode_input($aereo_eticket) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_eticket_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_eticket_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_assento']))
    {
        $this->nm_new_label['aereo_assento'] = "Assento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_assento = $this->aereo_assento;
   $sStyleHidden_aereo_assento = '';
   if (isset($this->nmgp_cmp_hidden['aereo_assento']) && $this->nmgp_cmp_hidden['aereo_assento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_assento']);
       $sStyleHidden_aereo_assento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_assento = 'display: none;';
   $sStyleReadInp_aereo_assento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_assento']) && $this->nmgp_cmp_readonly['aereo_assento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_assento']);
       $sStyleReadLab_aereo_assento = '';
       $sStyleReadInp_aereo_assento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_assento']) && $this->nmgp_cmp_hidden['aereo_assento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_assento" value="<?php echo $this->form_encode_input($aereo_assento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_assento" style="<?php echo $sStyleHidden_aereo_assento; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_assento_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_assento_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_assento"><?php echo $this->nm_new_label['aereo_assento']; ?></span></td></tr><tr><td class="css_aereo_assento_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_assento"]) &&  $this->nmgp_cmp_readonly["aereo_assento"] == "on") { 

 ?>
<input type="hidden" name="aereo_assento" value="<?php echo $this->form_encode_input($aereo_assento) . "\">" . $aereo_assento . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_assento" class="sc-ui-readonly-aereo_assento css_aereo_assento_line" style="<?php echo $sStyleReadLab_aereo_assento; ?>"><?php echo $this->form_format_readonly("aereo_assento", $this->form_encode_input($this->aereo_assento)); ?></span><span id="id_read_off_aereo_assento" class="css_read_off_aereo_assento<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_assento; ?>">
 <input class="sc-js-input scFormObjectOdd css_aereo_assento_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_assento" type=text name="aereo_assento" value="<?php echo $this->form_encode_input($aereo_assento) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=5"; } ?> maxlength=5 alt="{datatype: 'text', maxLength: 5, allowedChars: '<?php echo $this->allowedCharsCharset("abcdefghijklmnopqrstuvwxyz0123456789 .") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_assento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_assento_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_emitida_bvt']))
   {
       $this->nm_new_label['aereo_emitida_bvt'] = "Emissão BVT:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_emitida_bvt = $this->aereo_emitida_bvt;
   $sStyleHidden_aereo_emitida_bvt = '';
   if (isset($this->nmgp_cmp_hidden['aereo_emitida_bvt']) && $this->nmgp_cmp_hidden['aereo_emitida_bvt'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_emitida_bvt']);
       $sStyleHidden_aereo_emitida_bvt = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_emitida_bvt = 'display: none;';
   $sStyleReadInp_aereo_emitida_bvt = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_emitida_bvt']) && $this->nmgp_cmp_readonly['aereo_emitida_bvt'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_emitida_bvt']);
       $sStyleReadLab_aereo_emitida_bvt = '';
       $sStyleReadInp_aereo_emitida_bvt = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_emitida_bvt']) && $this->nmgp_cmp_hidden['aereo_emitida_bvt'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aereo_emitida_bvt" value="<?php echo $this->form_encode_input($this->aereo_emitida_bvt) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_emitida_bvt" style="<?php echo $sStyleHidden_aereo_emitida_bvt; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_emitida_bvt_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_emitida_bvt_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_emitida_bvt"><?php echo $this->nm_new_label['aereo_emitida_bvt']; ?></span></td></tr><tr><td class="css_aereo_emitida_bvt_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_emitida_bvt"]) &&  $this->nmgp_cmp_readonly["aereo_emitida_bvt"] == "on") { 

$aereo_emitida_bvt_look = "";
 if ($this->aereo_emitida_bvt == "N") { $aereo_emitida_bvt_look .= "NÃO" ;} 
 if ($this->aereo_emitida_bvt == "Y") { $aereo_emitida_bvt_look .= "SIM" ;} 
 if (empty($aereo_emitida_bvt_look)) { $aereo_emitida_bvt_look = $this->aereo_emitida_bvt; }
?>
<input type="hidden" name="aereo_emitida_bvt" value="<?php echo $this->form_encode_input($aereo_emitida_bvt) . "\">" . $aereo_emitida_bvt_look . ""; ?>
<?php } else { ?>
<?php

$aereo_emitida_bvt_look = "";
 if ($this->aereo_emitida_bvt == "N") { $aereo_emitida_bvt_look .= "NÃO" ;} 
 if ($this->aereo_emitida_bvt == "Y") { $aereo_emitida_bvt_look .= "SIM" ;} 
 if (empty($aereo_emitida_bvt_look)) { $aereo_emitida_bvt_look = $this->aereo_emitida_bvt; }
?>
<span id="id_read_on_aereo_emitida_bvt" class="css_aereo_emitida_bvt_line"  style="<?php echo $sStyleReadLab_aereo_emitida_bvt; ?>"><?php echo $this->form_format_readonly("aereo_emitida_bvt", $this->form_encode_input($aereo_emitida_bvt_look)); ?></span><span id="id_read_off_aereo_emitida_bvt" class="css_read_off_aereo_emitida_bvt<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_aereo_emitida_bvt; ?>">
 <span id="idAjaxSelect_aereo_emitida_bvt" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_aereo_emitida_bvt_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_emitida_bvt" name="aereo_emitida_bvt" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->aereo_emitida_bvt == "N") { echo " selected" ;} ?><?php  if (empty($this->aereo_emitida_bvt)) { echo " selected" ;} ?>>NÃO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_emitida_bvt'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->aereo_emitida_bvt == "Y") { echo " selected" ;} ?>>SIM</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_emitida_bvt'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_emitida_bvt_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_emitida_bvt_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_valor']))
    {
        $this->nm_new_label['aereo_valor'] = "Valor:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_valor = $this->aereo_valor;
   $sStyleHidden_aereo_valor = '';
   if (isset($this->nmgp_cmp_hidden['aereo_valor']) && $this->nmgp_cmp_hidden['aereo_valor'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_valor']);
       $sStyleHidden_aereo_valor = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_valor = 'display: none;';
   $sStyleReadInp_aereo_valor = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_valor']) && $this->nmgp_cmp_readonly['aereo_valor'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_valor']);
       $sStyleReadLab_aereo_valor = '';
       $sStyleReadInp_aereo_valor = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_valor']) && $this->nmgp_cmp_hidden['aereo_valor'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_valor" value="<?php echo $this->form_encode_input($aereo_valor) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_valor" style="<?php echo $sStyleHidden_aereo_valor; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_valor_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_valor_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_valor"><?php echo $this->nm_new_label['aereo_valor']; ?></span></td></tr><tr><td class="css_aereo_valor_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_valor"]) &&  $this->nmgp_cmp_readonly["aereo_valor"] == "on") { 

 ?>
<input type="hidden" name="aereo_valor" value="<?php echo $this->form_encode_input($aereo_valor) . "\">" . $aereo_valor . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_valor" class="sc-ui-readonly-aereo_valor css_aereo_valor_line" style="<?php echo $sStyleReadLab_aereo_valor; ?>"><?php echo $this->form_format_readonly("aereo_valor", $this->form_encode_input($this->aereo_valor)); ?></span><span id="id_read_off_aereo_valor" class="css_read_off_aereo_valor<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_valor; ?>">
 <input class="sc-js-input scFormObjectOdd css_aereo_valor_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_valor" type=text name="aereo_valor" value="<?php echo $this->form_encode_input($aereo_valor) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=12"; } ?> alt="{datatype: 'decimal', maxLength: 12, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['aereo_valor']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['aereo_valor']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['aereo_valor']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['aereo_valor']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_valor_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_valor_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_transfer_tipo']))
   {
       $this->nm_new_label['aereo_transfer_tipo'] = "Aereo Transfer Tipo";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_transfer_tipo = $this->aereo_transfer_tipo;
   $sStyleHidden_aereo_transfer_tipo = '';
   if (isset($this->nmgp_cmp_hidden['aereo_transfer_tipo']) && $this->nmgp_cmp_hidden['aereo_transfer_tipo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_transfer_tipo']);
       $sStyleHidden_aereo_transfer_tipo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_transfer_tipo = 'display: none;';
   $sStyleReadInp_aereo_transfer_tipo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_transfer_tipo']) && $this->nmgp_cmp_readonly['aereo_transfer_tipo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_transfer_tipo']);
       $sStyleReadLab_aereo_transfer_tipo = '';
       $sStyleReadInp_aereo_transfer_tipo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_transfer_tipo']) && $this->nmgp_cmp_hidden['aereo_transfer_tipo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aereo_transfer_tipo" value="<?php echo $this->form_encode_input($this->aereo_transfer_tipo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_transfer_tipo" style="<?php echo $sStyleHidden_aereo_transfer_tipo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_transfer_tipo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_transfer_tipo_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_transfer_tipo"><?php echo $this->nm_new_label['aereo_transfer_tipo']; ?></span></td></tr><tr><td class="css_aereo_transfer_tipo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_transfer_tipo"]) &&  $this->nmgp_cmp_readonly["aereo_transfer_tipo"] == "on") { 

$aereo_transfer_tipo_look = "";
 if ($this->aereo_transfer_tipo == "NAO") { $aereo_transfer_tipo_look .= "NÃO" ;} 
 if ($this->aereo_transfer_tipo == "IN") { $aereo_transfer_tipo_look .= "IN" ;} 
 if ($this->aereo_transfer_tipo == "OUT") { $aereo_transfer_tipo_look .= "OUT" ;} 
 if (empty($aereo_transfer_tipo_look)) { $aereo_transfer_tipo_look = $this->aereo_transfer_tipo; }
?>
<input type="hidden" name="aereo_transfer_tipo" value="<?php echo $this->form_encode_input($aereo_transfer_tipo) . "\">" . $aereo_transfer_tipo_look . ""; ?>
<?php } else { ?>
<?php

$aereo_transfer_tipo_look = "";
 if ($this->aereo_transfer_tipo == "NAO") { $aereo_transfer_tipo_look .= "NÃO" ;} 
 if ($this->aereo_transfer_tipo == "IN") { $aereo_transfer_tipo_look .= "IN" ;} 
 if ($this->aereo_transfer_tipo == "OUT") { $aereo_transfer_tipo_look .= "OUT" ;} 
 if (empty($aereo_transfer_tipo_look)) { $aereo_transfer_tipo_look = $this->aereo_transfer_tipo; }
?>
<span id="id_read_on_aereo_transfer_tipo" class="css_aereo_transfer_tipo_line"  style="<?php echo $sStyleReadLab_aereo_transfer_tipo; ?>"><?php echo $this->form_format_readonly("aereo_transfer_tipo", $this->form_encode_input($aereo_transfer_tipo_look)); ?></span><span id="id_read_off_aereo_transfer_tipo" class="css_read_off_aereo_transfer_tipo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_aereo_transfer_tipo; ?>">
 <span id="idAjaxSelect_aereo_transfer_tipo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_aereo_transfer_tipo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_transfer_tipo" name="aereo_transfer_tipo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="NAO" <?php  if ($this->aereo_transfer_tipo == "NAO") { echo " selected" ;} ?><?php  if (empty($this->aereo_transfer_tipo)) { echo " selected" ;} ?>>NÃO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_transfer_tipo'][] = 'NAO'; ?>
 <option  value="IN" <?php  if ($this->aereo_transfer_tipo == "IN") { echo " selected" ;} ?>>IN</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_transfer_tipo'][] = 'IN'; ?>
 <option  value="OUT" <?php  if ($this->aereo_transfer_tipo == "OUT") { echo " selected" ;} ?>>OUT</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_transfer_tipo'][] = 'OUT'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_transfer_tipo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_transfer_tipo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_aereo_transfer_tipo_dumb = ('' == $sStyleHidden_aereo_transfer_tipo) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_aereo_transfer_tipo_dumb" style="<?php echo $sStyleHidden_aereo_transfer_tipo_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['titulo_api']))
    {
        $this->nm_new_label['titulo_api'] = "Título API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $titulo_api = $this->titulo_api;
   $sStyleHidden_titulo_api = '';
   if (isset($this->nmgp_cmp_hidden['titulo_api']) && $this->nmgp_cmp_hidden['titulo_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['titulo_api']);
       $sStyleHidden_titulo_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_titulo_api = 'display: none;';
   $sStyleReadInp_titulo_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['titulo_api']) && $this->nmgp_cmp_readonly['titulo_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['titulo_api']);
       $sStyleReadLab_titulo_api = '';
       $sStyleReadInp_titulo_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['titulo_api']) && $this->nmgp_cmp_hidden['titulo_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="titulo_api" value="<?php echo $this->form_encode_input($titulo_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_titulo_api" style="<?php echo $sStyleHidden_titulo_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_titulo_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_titulo_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_titulo_api"><?php echo $this->nm_new_label['titulo_api']; ?></span></td></tr><tr><td class="css_titulo_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["titulo_api"]) &&  $this->nmgp_cmp_readonly["titulo_api"] == "on") { 

 ?>
<input type="hidden" name="titulo_api" value="<?php echo $this->form_encode_input($titulo_api) . "\">" . $titulo_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_titulo_api" class="sc-ui-readonly-titulo_api css_titulo_api_line" style="<?php echo $sStyleReadLab_titulo_api; ?>"><?php echo $this->form_format_readonly("titulo_api", $this->form_encode_input($this->titulo_api)); ?></span><span id="id_read_off_titulo_api" class="css_read_off_titulo_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_titulo_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_titulo_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_titulo_api" type=text name="titulo_api" value="<?php echo $this->form_encode_input($titulo_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=120"; } ?> maxlength=120 alt="{datatype: 'text', maxLength: 120, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_titulo_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_titulo_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['descricao_api']))
    {
        $this->nm_new_label['descricao_api'] = "Descrição API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $descricao_api = $this->descricao_api;
   $sStyleHidden_descricao_api = '';
   if (isset($this->nmgp_cmp_hidden['descricao_api']) && $this->nmgp_cmp_hidden['descricao_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['descricao_api']);
       $sStyleHidden_descricao_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_descricao_api = 'display: none;';
   $sStyleReadInp_descricao_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['descricao_api']) && $this->nmgp_cmp_readonly['descricao_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['descricao_api']);
       $sStyleReadLab_descricao_api = '';
       $sStyleReadInp_descricao_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['descricao_api']) && $this->nmgp_cmp_hidden['descricao_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="descricao_api" value="<?php echo $this->form_encode_input($descricao_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_descricao_api" style="<?php echo $sStyleHidden_descricao_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_descricao_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_descricao_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_descricao_api"><?php echo $this->nm_new_label['descricao_api']; ?></span></td></tr><tr><td class="css_descricao_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["descricao_api"]) &&  $this->nmgp_cmp_readonly["descricao_api"] == "on") { 

 ?>
<input type="hidden" name="descricao_api" value="<?php echo $this->form_encode_input($descricao_api) . "\">" . $descricao_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_descricao_api" class="sc-ui-readonly-descricao_api css_descricao_api_line" style="<?php echo $sStyleReadLab_descricao_api; ?>"><?php echo $this->form_format_readonly("descricao_api", $this->form_encode_input($this->descricao_api)); ?></span><span id="id_read_off_descricao_api" class="css_read_off_descricao_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_descricao_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_descricao_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_descricao_api" type=text name="descricao_api" value="<?php echo $this->form_encode_input($descricao_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=150"; } ?> maxlength=200 alt="{datatype: 'text', maxLength: 200, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descricao_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descricao_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cod_rota_api']))
    {
        $this->nm_new_label['cod_rota_api'] = "Cód. Rota API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cod_rota_api = $this->cod_rota_api;
   $sStyleHidden_cod_rota_api = '';
   if (isset($this->nmgp_cmp_hidden['cod_rota_api']) && $this->nmgp_cmp_hidden['cod_rota_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cod_rota_api']);
       $sStyleHidden_cod_rota_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cod_rota_api = 'display: none;';
   $sStyleReadInp_cod_rota_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cod_rota_api']) && $this->nmgp_cmp_readonly['cod_rota_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cod_rota_api']);
       $sStyleReadLab_cod_rota_api = '';
       $sStyleReadInp_cod_rota_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cod_rota_api']) && $this->nmgp_cmp_hidden['cod_rota_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cod_rota_api" value="<?php echo $this->form_encode_input($cod_rota_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cod_rota_api" style="<?php echo $sStyleHidden_cod_rota_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cod_rota_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cod_rota_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_cod_rota_api"><?php echo $this->nm_new_label['cod_rota_api']; ?></span></td></tr><tr><td class="css_cod_rota_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cod_rota_api"]) &&  $this->nmgp_cmp_readonly["cod_rota_api"] == "on") { 

 ?>
<input type="hidden" name="cod_rota_api" value="<?php echo $this->form_encode_input($cod_rota_api) . "\">" . $cod_rota_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_cod_rota_api" class="sc-ui-readonly-cod_rota_api css_cod_rota_api_line" style="<?php echo $sStyleReadLab_cod_rota_api; ?>"><?php echo $this->form_format_readonly("cod_rota_api", $this->form_encode_input($this->cod_rota_api)); ?></span><span id="id_read_off_cod_rota_api" class="css_read_off_cod_rota_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cod_rota_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_cod_rota_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cod_rota_api" type=text name="cod_rota_api" value="<?php echo $this->form_encode_input($cod_rota_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cod_rota_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cod_rota_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tipo_api']))
    {
        $this->nm_new_label['tipo_api'] = "Tipo API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tipo_api = $this->tipo_api;
   $sStyleHidden_tipo_api = '';
   if (isset($this->nmgp_cmp_hidden['tipo_api']) && $this->nmgp_cmp_hidden['tipo_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tipo_api']);
       $sStyleHidden_tipo_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tipo_api = 'display: none;';
   $sStyleReadInp_tipo_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tipo_api']) && $this->nmgp_cmp_readonly['tipo_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tipo_api']);
       $sStyleReadLab_tipo_api = '';
       $sStyleReadInp_tipo_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tipo_api']) && $this->nmgp_cmp_hidden['tipo_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tipo_api" value="<?php echo $this->form_encode_input($tipo_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tipo_api" style="<?php echo $sStyleHidden_tipo_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tipo_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tipo_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_tipo_api"><?php echo $this->nm_new_label['tipo_api']; ?></span></td></tr><tr><td class="css_tipo_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tipo_api"]) &&  $this->nmgp_cmp_readonly["tipo_api"] == "on") { 

 ?>
<input type="hidden" name="tipo_api" value="<?php echo $this->form_encode_input($tipo_api) . "\">" . $tipo_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_tipo_api" class="sc-ui-readonly-tipo_api css_tipo_api_line" style="<?php echo $sStyleReadLab_tipo_api; ?>"><?php echo $this->form_format_readonly("tipo_api", $this->form_encode_input($this->tipo_api)); ?></span><span id="id_read_off_tipo_api" class="css_read_off_tipo_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tipo_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_tipo_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tipo_api" type=text name="tipo_api" value="<?php echo $this->form_encode_input($tipo_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['valido_de_api']))
    {
        $this->nm_new_label['valido_de_api'] = "Válido API de:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $valido_de_api = $this->valido_de_api;
   $sStyleHidden_valido_de_api = '';
   if (isset($this->nmgp_cmp_hidden['valido_de_api']) && $this->nmgp_cmp_hidden['valido_de_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['valido_de_api']);
       $sStyleHidden_valido_de_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_valido_de_api = 'display: none;';
   $sStyleReadInp_valido_de_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['valido_de_api']) && $this->nmgp_cmp_readonly['valido_de_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['valido_de_api']);
       $sStyleReadLab_valido_de_api = '';
       $sStyleReadInp_valido_de_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['valido_de_api']) && $this->nmgp_cmp_hidden['valido_de_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="valido_de_api" value="<?php echo $this->form_encode_input($valido_de_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_valido_de_api" style="<?php echo $sStyleHidden_valido_de_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_valido_de_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_valido_de_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_valido_de_api"><?php echo $this->nm_new_label['valido_de_api']; ?></span></td></tr><tr><td class="css_valido_de_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["valido_de_api"]) &&  $this->nmgp_cmp_readonly["valido_de_api"] == "on") { 

 ?>
<input type="hidden" name="valido_de_api" value="<?php echo $this->form_encode_input($valido_de_api) . "\">" . $valido_de_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_valido_de_api" class="sc-ui-readonly-valido_de_api css_valido_de_api_line" style="<?php echo $sStyleReadLab_valido_de_api; ?>"><?php echo $this->form_format_readonly("valido_de_api", $this->form_encode_input($this->valido_de_api)); ?></span><span id="id_read_off_valido_de_api" class="css_read_off_valido_de_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_valido_de_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_valido_de_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_valido_de_api" type=text name="valido_de_api" value="<?php echo $this->form_encode_input($valido_de_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_valido_de_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_valido_de_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['valido_ate_api']))
    {
        $this->nm_new_label['valido_ate_api'] = "Válido API até:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $valido_ate_api = $this->valido_ate_api;
   $sStyleHidden_valido_ate_api = '';
   if (isset($this->nmgp_cmp_hidden['valido_ate_api']) && $this->nmgp_cmp_hidden['valido_ate_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['valido_ate_api']);
       $sStyleHidden_valido_ate_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_valido_ate_api = 'display: none;';
   $sStyleReadInp_valido_ate_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['valido_ate_api']) && $this->nmgp_cmp_readonly['valido_ate_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['valido_ate_api']);
       $sStyleReadLab_valido_ate_api = '';
       $sStyleReadInp_valido_ate_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['valido_ate_api']) && $this->nmgp_cmp_hidden['valido_ate_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="valido_ate_api" value="<?php echo $this->form_encode_input($valido_ate_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_valido_ate_api" style="<?php echo $sStyleHidden_valido_ate_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_valido_ate_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_valido_ate_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_valido_ate_api"><?php echo $this->nm_new_label['valido_ate_api']; ?></span></td></tr><tr><td class="css_valido_ate_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["valido_ate_api"]) &&  $this->nmgp_cmp_readonly["valido_ate_api"] == "on") { 

 ?>
<input type="hidden" name="valido_ate_api" value="<?php echo $this->form_encode_input($valido_ate_api) . "\">" . $valido_ate_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_valido_ate_api" class="sc-ui-readonly-valido_ate_api css_valido_ate_api_line" style="<?php echo $sStyleReadLab_valido_ate_api; ?>"><?php echo $this->form_format_readonly("valido_ate_api", $this->form_encode_input($this->valido_ate_api)); ?></span><span id="id_read_off_valido_ate_api" class="css_read_off_valido_ate_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_valido_ate_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_valido_ate_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_valido_ate_api" type=text name="valido_ate_api" value="<?php echo $this->form_encode_input($valido_ate_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_valido_ate_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_valido_ate_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['duracao_voo_api']))
    {
        $this->nm_new_label['duracao_voo_api'] = "Duração do voo API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $duracao_voo_api = $this->duracao_voo_api;
   $sStyleHidden_duracao_voo_api = '';
   if (isset($this->nmgp_cmp_hidden['duracao_voo_api']) && $this->nmgp_cmp_hidden['duracao_voo_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['duracao_voo_api']);
       $sStyleHidden_duracao_voo_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_duracao_voo_api = 'display: none;';
   $sStyleReadInp_duracao_voo_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['duracao_voo_api']) && $this->nmgp_cmp_readonly['duracao_voo_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['duracao_voo_api']);
       $sStyleReadLab_duracao_voo_api = '';
       $sStyleReadInp_duracao_voo_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['duracao_voo_api']) && $this->nmgp_cmp_hidden['duracao_voo_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="duracao_voo_api" value="<?php echo $this->form_encode_input($duracao_voo_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_duracao_voo_api" style="<?php echo $sStyleHidden_duracao_voo_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_duracao_voo_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_duracao_voo_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_duracao_voo_api"><?php echo $this->nm_new_label['duracao_voo_api']; ?></span></td></tr><tr><td class="css_duracao_voo_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["duracao_voo_api"]) &&  $this->nmgp_cmp_readonly["duracao_voo_api"] == "on") { 

 ?>
<input type="hidden" name="duracao_voo_api" value="<?php echo $this->form_encode_input($duracao_voo_api) . "\">" . $duracao_voo_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_duracao_voo_api" class="sc-ui-readonly-duracao_voo_api css_duracao_voo_api_line" style="<?php echo $sStyleReadLab_duracao_voo_api; ?>"><?php echo $this->form_format_readonly("duracao_voo_api", $this->form_encode_input($this->duracao_voo_api)); ?></span><span id="id_read_off_duracao_voo_api" class="css_read_off_duracao_voo_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_duracao_voo_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_duracao_voo_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_duracao_voo_api" type=text name="duracao_voo_api" value="<?php echo $this->form_encode_input($duracao_voo_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=5"; } ?> maxlength=10 alt="{datatype: 'mask', maxLength: 5, allowedChars: '<?php echo $this->allowedCharsCharset("abcdefghijklmnopqrstuvwxyz0123456789") ?>', lettersCase: 'lower', maskList: '99a99', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><img src="../_lib/img/scriptcase__NM__nm_transparent.gif" style="vertical-align: middle; display: none" class="sc-js-ui-statusimg" id="id_sc_status_duracao_voo_api" /></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_duracao_voo_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_duracao_voo_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aeronave_api']))
    {
        $this->nm_new_label['aeronave_api'] = "Aeronave API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aeronave_api = $this->aeronave_api;
   $sStyleHidden_aeronave_api = '';
   if (isset($this->nmgp_cmp_hidden['aeronave_api']) && $this->nmgp_cmp_hidden['aeronave_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aeronave_api']);
       $sStyleHidden_aeronave_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aeronave_api = 'display: none;';
   $sStyleReadInp_aeronave_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aeronave_api']) && $this->nmgp_cmp_readonly['aeronave_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aeronave_api']);
       $sStyleReadLab_aeronave_api = '';
       $sStyleReadInp_aeronave_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aeronave_api']) && $this->nmgp_cmp_hidden['aeronave_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aeronave_api" value="<?php echo $this->form_encode_input($aeronave_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aeronave_api" style="<?php echo $sStyleHidden_aeronave_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aeronave_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aeronave_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_aeronave_api"><?php echo $this->nm_new_label['aeronave_api']; ?></span></td></tr><tr><td class="css_aeronave_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aeronave_api"]) &&  $this->nmgp_cmp_readonly["aeronave_api"] == "on") { 

 ?>
<input type="hidden" name="aeronave_api" value="<?php echo $this->form_encode_input($aeronave_api) . "\">" . $aeronave_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_aeronave_api" class="sc-ui-readonly-aeronave_api css_aeronave_api_line" style="<?php echo $sStyleReadLab_aeronave_api; ?>"><?php echo $this->form_format_readonly("aeronave_api", $this->form_encode_input($this->aeronave_api)); ?></span><span id="id_read_off_aeronave_api" class="css_read_off_aeronave_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aeronave_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_aeronave_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aeronave_api" type=text name="aeronave_api" value="<?php echo $this->form_encode_input($aeronave_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aeronave_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aeronave_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['terminal_api']))
    {
        $this->nm_new_label['terminal_api'] = "Terminal API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $terminal_api = $this->terminal_api;
   $sStyleHidden_terminal_api = '';
   if (isset($this->nmgp_cmp_hidden['terminal_api']) && $this->nmgp_cmp_hidden['terminal_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['terminal_api']);
       $sStyleHidden_terminal_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_terminal_api = 'display: none;';
   $sStyleReadInp_terminal_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['terminal_api']) && $this->nmgp_cmp_readonly['terminal_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['terminal_api']);
       $sStyleReadLab_terminal_api = '';
       $sStyleReadInp_terminal_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['terminal_api']) && $this->nmgp_cmp_hidden['terminal_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="terminal_api" value="<?php echo $this->form_encode_input($terminal_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_terminal_api" style="<?php echo $sStyleHidden_terminal_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_terminal_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_terminal_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_terminal_api"><?php echo $this->nm_new_label['terminal_api']; ?></span></td></tr><tr><td class="css_terminal_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["terminal_api"]) &&  $this->nmgp_cmp_readonly["terminal_api"] == "on") { 

 ?>
<input type="hidden" name="terminal_api" value="<?php echo $this->form_encode_input($terminal_api) . "\">" . $terminal_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_terminal_api" class="sc-ui-readonly-terminal_api css_terminal_api_line" style="<?php echo $sStyleReadLab_terminal_api; ?>"><?php echo $this->form_format_readonly("terminal_api", $this->form_encode_input($this->terminal_api)); ?></span><span id="id_read_off_terminal_api" class="css_read_off_terminal_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_terminal_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_terminal_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_terminal_api" type=text name="terminal_api" value="<?php echo $this->form_encode_input($terminal_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_terminal_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_terminal_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['gate_api']))
    {
        $this->nm_new_label['gate_api'] = "Gate(portão) API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $gate_api = $this->gate_api;
   $sStyleHidden_gate_api = '';
   if (isset($this->nmgp_cmp_hidden['gate_api']) && $this->nmgp_cmp_hidden['gate_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['gate_api']);
       $sStyleHidden_gate_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_gate_api = 'display: none;';
   $sStyleReadInp_gate_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['gate_api']) && $this->nmgp_cmp_readonly['gate_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['gate_api']);
       $sStyleReadLab_gate_api = '';
       $sStyleReadInp_gate_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['gate_api']) && $this->nmgp_cmp_hidden['gate_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="gate_api" value="<?php echo $this->form_encode_input($gate_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_gate_api" style="<?php echo $sStyleHidden_gate_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_gate_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_gate_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_gate_api"><?php echo $this->nm_new_label['gate_api']; ?></span></td></tr><tr><td class="css_gate_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["gate_api"]) &&  $this->nmgp_cmp_readonly["gate_api"] == "on") { 

 ?>
<input type="hidden" name="gate_api" value="<?php echo $this->form_encode_input($gate_api) . "\">" . $gate_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_gate_api" class="sc-ui-readonly-gate_api css_gate_api_line" style="<?php echo $sStyleReadLab_gate_api; ?>"><?php echo $this->form_format_readonly("gate_api", $this->form_encode_input($this->gate_api)); ?></span><span id="id_read_off_gate_api" class="css_read_off_gate_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_gate_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_gate_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_gate_api" type=text name="gate_api" value="<?php echo $this->form_encode_input($gate_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_gate_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_gate_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['refeicao_api']))
    {
        $this->nm_new_label['refeicao_api'] = "Refeição API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $refeicao_api = $this->refeicao_api;
   $sStyleHidden_refeicao_api = '';
   if (isset($this->nmgp_cmp_hidden['refeicao_api']) && $this->nmgp_cmp_hidden['refeicao_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['refeicao_api']);
       $sStyleHidden_refeicao_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_refeicao_api = 'display: none;';
   $sStyleReadInp_refeicao_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['refeicao_api']) && $this->nmgp_cmp_readonly['refeicao_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['refeicao_api']);
       $sStyleReadLab_refeicao_api = '';
       $sStyleReadInp_refeicao_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['refeicao_api']) && $this->nmgp_cmp_hidden['refeicao_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="refeicao_api" value="<?php echo $this->form_encode_input($refeicao_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_refeicao_api" style="<?php echo $sStyleHidden_refeicao_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_refeicao_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_refeicao_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_refeicao_api"><?php echo $this->nm_new_label['refeicao_api']; ?></span></td></tr><tr><td class="css_refeicao_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["refeicao_api"]) &&  $this->nmgp_cmp_readonly["refeicao_api"] == "on") { 

 ?>
<input type="hidden" name="refeicao_api" value="<?php echo $this->form_encode_input($refeicao_api) . "\">" . $refeicao_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_refeicao_api" class="sc-ui-readonly-refeicao_api css_refeicao_api_line" style="<?php echo $sStyleReadLab_refeicao_api; ?>"><?php echo $this->form_format_readonly("refeicao_api", $this->form_encode_input($this->refeicao_api)); ?></span><span id="id_read_off_refeicao_api" class="css_read_off_refeicao_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_refeicao_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_refeicao_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_refeicao_api" type=text name="refeicao_api" value="<?php echo $this->form_encode_input($refeicao_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_refeicao_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_refeicao_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['milhagem_api']))
    {
        $this->nm_new_label['milhagem_api'] = "Milhagem API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $milhagem_api = $this->milhagem_api;
   $sStyleHidden_milhagem_api = '';
   if (isset($this->nmgp_cmp_hidden['milhagem_api']) && $this->nmgp_cmp_hidden['milhagem_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['milhagem_api']);
       $sStyleHidden_milhagem_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_milhagem_api = 'display: none;';
   $sStyleReadInp_milhagem_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['milhagem_api']) && $this->nmgp_cmp_readonly['milhagem_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['milhagem_api']);
       $sStyleReadLab_milhagem_api = '';
       $sStyleReadInp_milhagem_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['milhagem_api']) && $this->nmgp_cmp_hidden['milhagem_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="milhagem_api" value="<?php echo $this->form_encode_input($milhagem_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_milhagem_api" style="<?php echo $sStyleHidden_milhagem_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_milhagem_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_milhagem_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_milhagem_api"><?php echo $this->nm_new_label['milhagem_api']; ?></span></td></tr><tr><td class="css_milhagem_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["milhagem_api"]) &&  $this->nmgp_cmp_readonly["milhagem_api"] == "on") { 

 ?>
<input type="hidden" name="milhagem_api" value="<?php echo $this->form_encode_input($milhagem_api) . "\">" . $milhagem_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_milhagem_api" class="sc-ui-readonly-milhagem_api css_milhagem_api_line" style="<?php echo $sStyleReadLab_milhagem_api; ?>"><?php echo $this->form_format_readonly("milhagem_api", $this->form_encode_input($this->milhagem_api)); ?></span><span id="id_read_off_milhagem_api" class="css_read_off_milhagem_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_milhagem_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_milhagem_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_milhagem_api" type=text name="milhagem_api" value="<?php echo $this->form_encode_input($milhagem_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_milhagem_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_milhagem_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['web_ckeckin_api']))
    {
        $this->nm_new_label['web_ckeckin_api'] = "Web Ckeckin API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $web_ckeckin_api = $this->web_ckeckin_api;
   $sStyleHidden_web_ckeckin_api = '';
   if (isset($this->nmgp_cmp_hidden['web_ckeckin_api']) && $this->nmgp_cmp_hidden['web_ckeckin_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['web_ckeckin_api']);
       $sStyleHidden_web_ckeckin_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_web_ckeckin_api = 'display: none;';
   $sStyleReadInp_web_ckeckin_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['web_ckeckin_api']) && $this->nmgp_cmp_readonly['web_ckeckin_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['web_ckeckin_api']);
       $sStyleReadLab_web_ckeckin_api = '';
       $sStyleReadInp_web_ckeckin_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['web_ckeckin_api']) && $this->nmgp_cmp_hidden['web_ckeckin_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="web_ckeckin_api" value="<?php echo $this->form_encode_input($web_ckeckin_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_web_ckeckin_api" style="<?php echo $sStyleHidden_web_ckeckin_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_web_ckeckin_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_web_ckeckin_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_web_ckeckin_api"><?php echo $this->nm_new_label['web_ckeckin_api']; ?></span></td></tr><tr><td class="css_web_ckeckin_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["web_ckeckin_api"]) &&  $this->nmgp_cmp_readonly["web_ckeckin_api"] == "on") { 

 ?>
<input type="hidden" name="web_ckeckin_api" value="<?php echo $this->form_encode_input($web_ckeckin_api) . "\">" . $web_ckeckin_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_web_ckeckin_api" class="sc-ui-readonly-web_ckeckin_api css_web_ckeckin_api_line" style="<?php echo $sStyleReadLab_web_ckeckin_api; ?>"><?php echo $this->form_format_readonly("web_ckeckin_api", $this->form_encode_input($this->web_ckeckin_api)); ?></span><span id="id_read_off_web_ckeckin_api" class="css_read_off_web_ckeckin_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_web_ckeckin_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_web_ckeckin_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_web_ckeckin_api" type=text name="web_ckeckin_api" value="<?php echo $this->form_encode_input($web_ckeckin_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=150"; } ?> maxlength=200 alt="{datatype: 'text', maxLength: 200, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'lower', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_web_ckeckin_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_web_ckeckin_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['duracao_escala']))
    {
        $this->nm_new_label['duracao_escala'] = "Duracão Escala API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $duracao_escala = $this->duracao_escala;
   $sStyleHidden_duracao_escala = '';
   if (isset($this->nmgp_cmp_hidden['duracao_escala']) && $this->nmgp_cmp_hidden['duracao_escala'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['duracao_escala']);
       $sStyleHidden_duracao_escala = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_duracao_escala = 'display: none;';
   $sStyleReadInp_duracao_escala = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['duracao_escala']) && $this->nmgp_cmp_readonly['duracao_escala'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['duracao_escala']);
       $sStyleReadLab_duracao_escala = '';
       $sStyleReadInp_duracao_escala = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['duracao_escala']) && $this->nmgp_cmp_hidden['duracao_escala'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="duracao_escala" value="<?php echo $this->form_encode_input($duracao_escala) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_duracao_escala" style="<?php echo $sStyleHidden_duracao_escala; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_duracao_escala_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_duracao_escala_label" style=" padding: 0px; width: 100%;"><span id="id_label_duracao_escala"><?php echo $this->nm_new_label['duracao_escala']; ?></span></td></tr><tr><td class="css_duracao_escala_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["duracao_escala"]) &&  $this->nmgp_cmp_readonly["duracao_escala"] == "on") { 

 ?>
<input type="hidden" name="duracao_escala" value="<?php echo $this->form_encode_input($duracao_escala) . "\">" . $duracao_escala . ""; ?>
<?php } else { ?>
<span id="id_read_on_duracao_escala" class="sc-ui-readonly-duracao_escala css_duracao_escala_line" style="<?php echo $sStyleReadLab_duracao_escala; ?>"><?php echo $this->form_format_readonly("duracao_escala", $this->form_encode_input($this->duracao_escala)); ?></span><span id="id_read_off_duracao_escala" class="css_read_off_duracao_escala<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_duracao_escala; ?>">
 <input class="sc-js-input scFormObjectOdd css_duracao_escala_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_duracao_escala" type=text name="duracao_escala" value="<?php echo $this->form_encode_input($duracao_escala) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=5"; } ?> maxlength=10 alt="{datatype: 'mask', maxLength: 5, allowedChars: '<?php echo $this->allowedCharsCharset("abcdefghijklmnopqrstuvwxyz0123456789") ?>', lettersCase: 'lower', maskList: '99a99', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><img src="../_lib/img/scriptcase__NM__nm_transparent.gif" style="vertical-align: middle; display: none" class="sc-js-ui-statusimg" id="id_sc_status_duracao_escala" /></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_duracao_escala_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_duracao_escala_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aeroporto_escala']))
    {
        $this->nm_new_label['aeroporto_escala'] = "Aeroporto Escala API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aeroporto_escala = $this->aeroporto_escala;
   $sStyleHidden_aeroporto_escala = '';
   if (isset($this->nmgp_cmp_hidden['aeroporto_escala']) && $this->nmgp_cmp_hidden['aeroporto_escala'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aeroporto_escala']);
       $sStyleHidden_aeroporto_escala = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aeroporto_escala = 'display: none;';
   $sStyleReadInp_aeroporto_escala = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aeroporto_escala']) && $this->nmgp_cmp_readonly['aeroporto_escala'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aeroporto_escala']);
       $sStyleReadLab_aeroporto_escala = '';
       $sStyleReadInp_aeroporto_escala = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aeroporto_escala']) && $this->nmgp_cmp_hidden['aeroporto_escala'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aeroporto_escala" value="<?php echo $this->form_encode_input($aeroporto_escala) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aeroporto_escala" style="<?php echo $sStyleHidden_aeroporto_escala; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aeroporto_escala_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aeroporto_escala_label" style=" padding: 0px; width: 100%;"><span id="id_label_aeroporto_escala"><?php echo $this->nm_new_label['aeroporto_escala']; ?></span></td></tr><tr><td class="css_aeroporto_escala_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aeroporto_escala"]) &&  $this->nmgp_cmp_readonly["aeroporto_escala"] == "on") { 

 ?>
<input type="hidden" name="aeroporto_escala" value="<?php echo $this->form_encode_input($aeroporto_escala) . "\">" . $aeroporto_escala . ""; ?>
<?php } else { ?>
<span id="id_read_on_aeroporto_escala" class="sc-ui-readonly-aeroporto_escala css_aeroporto_escala_line" style="<?php echo $sStyleReadLab_aeroporto_escala; ?>"><?php echo $this->form_format_readonly("aeroporto_escala", $this->form_encode_input($this->aeroporto_escala)); ?></span><span id="id_read_off_aeroporto_escala" class="css_read_off_aeroporto_escala<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aeroporto_escala; ?>">
 <input class="sc-js-input scFormObjectOdd css_aeroporto_escala_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aeroporto_escala" type=text name="aeroporto_escala" value="<?php echo $this->form_encode_input($aeroporto_escala) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aeroporto_escala_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aeroporto_escala_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['numero_voo_escala']))
    {
        $this->nm_new_label['numero_voo_escala'] = "Número Voo Escala API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $numero_voo_escala = $this->numero_voo_escala;
   $sStyleHidden_numero_voo_escala = '';
   if (isset($this->nmgp_cmp_hidden['numero_voo_escala']) && $this->nmgp_cmp_hidden['numero_voo_escala'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['numero_voo_escala']);
       $sStyleHidden_numero_voo_escala = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_numero_voo_escala = 'display: none;';
   $sStyleReadInp_numero_voo_escala = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['numero_voo_escala']) && $this->nmgp_cmp_readonly['numero_voo_escala'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['numero_voo_escala']);
       $sStyleReadLab_numero_voo_escala = '';
       $sStyleReadInp_numero_voo_escala = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['numero_voo_escala']) && $this->nmgp_cmp_hidden['numero_voo_escala'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="numero_voo_escala" value="<?php echo $this->form_encode_input($numero_voo_escala) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_numero_voo_escala" style="<?php echo $sStyleHidden_numero_voo_escala; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_numero_voo_escala_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_numero_voo_escala_label" style=" padding: 0px; width: 100%;"><span id="id_label_numero_voo_escala"><?php echo $this->nm_new_label['numero_voo_escala']; ?></span></td></tr><tr><td class="css_numero_voo_escala_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["numero_voo_escala"]) &&  $this->nmgp_cmp_readonly["numero_voo_escala"] == "on") { 

 ?>
<input type="hidden" name="numero_voo_escala" value="<?php echo $this->form_encode_input($numero_voo_escala) . "\">" . $numero_voo_escala . ""; ?>
<?php } else { ?>
<span id="id_read_on_numero_voo_escala" class="sc-ui-readonly-numero_voo_escala css_numero_voo_escala_line" style="<?php echo $sStyleReadLab_numero_voo_escala; ?>"><?php echo $this->form_format_readonly("numero_voo_escala", $this->form_encode_input($this->numero_voo_escala)); ?></span><span id="id_read_off_numero_voo_escala" class="css_read_off_numero_voo_escala<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_numero_voo_escala; ?>">
 <input class="sc-js-input scFormObjectOdd css_numero_voo_escala_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_numero_voo_escala" type=text name="numero_voo_escala" value="<?php echo $this->form_encode_input($numero_voo_escala) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_numero_voo_escala_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_numero_voo_escala_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hora_saida_escala']))
    {
        $this->nm_new_label['hora_saida_escala'] = "Hora Saída Escala API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hora_saida_escala = $this->hora_saida_escala;
   $sStyleHidden_hora_saida_escala = '';
   if (isset($this->nmgp_cmp_hidden['hora_saida_escala']) && $this->nmgp_cmp_hidden['hora_saida_escala'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hora_saida_escala']);
       $sStyleHidden_hora_saida_escala = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hora_saida_escala = 'display: none;';
   $sStyleReadInp_hora_saida_escala = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hora_saida_escala']) && $this->nmgp_cmp_readonly['hora_saida_escala'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hora_saida_escala']);
       $sStyleReadLab_hora_saida_escala = '';
       $sStyleReadInp_hora_saida_escala = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hora_saida_escala']) && $this->nmgp_cmp_hidden['hora_saida_escala'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hora_saida_escala" value="<?php echo $this->form_encode_input($hora_saida_escala) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_hora_saida_escala" style="<?php echo $sStyleHidden_hora_saida_escala; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hora_saida_escala_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_hora_saida_escala_label" style=" padding: 0px; width: 100%;"><span id="id_label_hora_saida_escala"><?php echo $this->nm_new_label['hora_saida_escala']; ?></span></td></tr><tr><td class="css_hora_saida_escala_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hora_saida_escala"]) &&  $this->nmgp_cmp_readonly["hora_saida_escala"] == "on") { 

 ?>
<input type="hidden" name="hora_saida_escala" value="<?php echo $this->form_encode_input($hora_saida_escala) . "\">" . $hora_saida_escala . ""; ?>
<?php } else { ?>
<span id="id_read_on_hora_saida_escala" class="sc-ui-readonly-hora_saida_escala css_hora_saida_escala_line" style="<?php echo $sStyleReadLab_hora_saida_escala; ?>"><?php echo $this->form_format_readonly("hora_saida_escala", $this->form_encode_input($hora_saida_escala)); ?></span><span id="id_read_off_hora_saida_escala" class="css_read_off_hora_saida_escala<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hora_saida_escala; ?>"><?php
$tmp_form_data = $this->field_config['hora_saida_escala']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_hora_saida_escala_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hora_saida_escala" type=text name="hora_saida_escala" value="<?php echo $this->form_encode_input($hora_saida_escala) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['hora_saida_escala']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['hora_saida_escala']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><img src="../_lib/img/scriptcase__NM__nm_transparent.gif" style="vertical-align: middle; display: none" class="sc-js-ui-statusimg" id="id_sc_status_hora_saida_escala" />&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hora_saida_escala_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hora_saida_escala_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hora_chegada_escala']))
    {
        $this->nm_new_label['hora_chegada_escala'] = "Hora Chegada Escala API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hora_chegada_escala = $this->hora_chegada_escala;
   $sStyleHidden_hora_chegada_escala = '';
   if (isset($this->nmgp_cmp_hidden['hora_chegada_escala']) && $this->nmgp_cmp_hidden['hora_chegada_escala'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hora_chegada_escala']);
       $sStyleHidden_hora_chegada_escala = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hora_chegada_escala = 'display: none;';
   $sStyleReadInp_hora_chegada_escala = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hora_chegada_escala']) && $this->nmgp_cmp_readonly['hora_chegada_escala'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hora_chegada_escala']);
       $sStyleReadLab_hora_chegada_escala = '';
       $sStyleReadInp_hora_chegada_escala = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hora_chegada_escala']) && $this->nmgp_cmp_hidden['hora_chegada_escala'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hora_chegada_escala" value="<?php echo $this->form_encode_input($hora_chegada_escala) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_hora_chegada_escala" style="<?php echo $sStyleHidden_hora_chegada_escala; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hora_chegada_escala_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_hora_chegada_escala_label" style=" padding: 0px; width: 100%;"><span id="id_label_hora_chegada_escala"><?php echo $this->nm_new_label['hora_chegada_escala']; ?></span></td></tr><tr><td class="css_hora_chegada_escala_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hora_chegada_escala"]) &&  $this->nmgp_cmp_readonly["hora_chegada_escala"] == "on") { 

 ?>
<input type="hidden" name="hora_chegada_escala" value="<?php echo $this->form_encode_input($hora_chegada_escala) . "\">" . $hora_chegada_escala . ""; ?>
<?php } else { ?>
<span id="id_read_on_hora_chegada_escala" class="sc-ui-readonly-hora_chegada_escala css_hora_chegada_escala_line" style="<?php echo $sStyleReadLab_hora_chegada_escala; ?>"><?php echo $this->form_format_readonly("hora_chegada_escala", $this->form_encode_input($hora_chegada_escala)); ?></span><span id="id_read_off_hora_chegada_escala" class="css_read_off_hora_chegada_escala<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hora_chegada_escala; ?>"><?php
$tmp_form_data = $this->field_config['hora_chegada_escala']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_hora_chegada_escala_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hora_chegada_escala" type=text name="hora_chegada_escala" value="<?php echo $this->form_encode_input($hora_chegada_escala) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['hora_chegada_escala']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['hora_chegada_escala']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ><img src="../_lib/img/scriptcase__NM__nm_transparent.gif" style="vertical-align: middle; display: none" class="sc-js-ui-statusimg" id="id_sc_status_hora_chegada_escala" />&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hora_chegada_escala_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hora_chegada_escala_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['classe_api']))
    {
        $this->nm_new_label['classe_api'] = "Classe API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $classe_api = $this->classe_api;
   $sStyleHidden_classe_api = '';
   if (isset($this->nmgp_cmp_hidden['classe_api']) && $this->nmgp_cmp_hidden['classe_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['classe_api']);
       $sStyleHidden_classe_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_classe_api = 'display: none;';
   $sStyleReadInp_classe_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['classe_api']) && $this->nmgp_cmp_readonly['classe_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['classe_api']);
       $sStyleReadLab_classe_api = '';
       $sStyleReadInp_classe_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['classe_api']) && $this->nmgp_cmp_hidden['classe_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="classe_api" value="<?php echo $this->form_encode_input($classe_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_classe_api" style="<?php echo $sStyleHidden_classe_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_classe_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_classe_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_classe_api"><?php echo $this->nm_new_label['classe_api']; ?></span></td></tr><tr><td class="css_classe_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["classe_api"]) &&  $this->nmgp_cmp_readonly["classe_api"] == "on") { 

 ?>
<input type="hidden" name="classe_api" value="<?php echo $this->form_encode_input($classe_api) . "\">" . $classe_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_classe_api" class="sc-ui-readonly-classe_api css_classe_api_line" style="<?php echo $sStyleReadLab_classe_api; ?>"><?php echo $this->form_format_readonly("classe_api", $this->form_encode_input($this->classe_api)); ?></span><span id="id_read_off_classe_api" class="css_read_off_classe_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_classe_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_classe_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_classe_api" type=text name="classe_api" value="<?php echo $this->form_encode_input($classe_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_classe_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_classe_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['passageiro_api']))
    {
        $this->nm_new_label['passageiro_api'] = "Passageiro API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $passageiro_api = $this->passageiro_api;
   $sStyleHidden_passageiro_api = '';
   if (isset($this->nmgp_cmp_hidden['passageiro_api']) && $this->nmgp_cmp_hidden['passageiro_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['passageiro_api']);
       $sStyleHidden_passageiro_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_passageiro_api = 'display: none;';
   $sStyleReadInp_passageiro_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['passageiro_api']) && $this->nmgp_cmp_readonly['passageiro_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['passageiro_api']);
       $sStyleReadLab_passageiro_api = '';
       $sStyleReadInp_passageiro_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['passageiro_api']) && $this->nmgp_cmp_hidden['passageiro_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="passageiro_api" value="<?php echo $this->form_encode_input($passageiro_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_passageiro_api" style="<?php echo $sStyleHidden_passageiro_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_passageiro_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_passageiro_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_passageiro_api"><?php echo $this->nm_new_label['passageiro_api']; ?></span></td></tr><tr><td class="css_passageiro_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["passageiro_api"]) &&  $this->nmgp_cmp_readonly["passageiro_api"] == "on") { 

 ?>
<input type="hidden" name="passageiro_api" value="<?php echo $this->form_encode_input($passageiro_api) . "\">" . $passageiro_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_passageiro_api" class="sc-ui-readonly-passageiro_api css_passageiro_api_line" style="<?php echo $sStyleReadLab_passageiro_api; ?>"><?php echo $this->form_format_readonly("passageiro_api", $this->form_encode_input($this->passageiro_api)); ?></span><span id="id_read_off_passageiro_api" class="css_read_off_passageiro_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_passageiro_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_passageiro_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_passageiro_api" type=text name="passageiro_api" value="<?php echo $this->form_encode_input($passageiro_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_passageiro_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_passageiro_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bagagem_api']))
    {
        $this->nm_new_label['bagagem_api'] = "Bagagem API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bagagem_api = $this->bagagem_api;
   $sStyleHidden_bagagem_api = '';
   if (isset($this->nmgp_cmp_hidden['bagagem_api']) && $this->nmgp_cmp_hidden['bagagem_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bagagem_api']);
       $sStyleHidden_bagagem_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bagagem_api = 'display: none;';
   $sStyleReadInp_bagagem_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bagagem_api']) && $this->nmgp_cmp_readonly['bagagem_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bagagem_api']);
       $sStyleReadLab_bagagem_api = '';
       $sStyleReadInp_bagagem_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bagagem_api']) && $this->nmgp_cmp_hidden['bagagem_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bagagem_api" value="<?php echo $this->form_encode_input($bagagem_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_bagagem_api" style="<?php echo $sStyleHidden_bagagem_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bagagem_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_bagagem_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_bagagem_api"><?php echo $this->nm_new_label['bagagem_api']; ?></span></td></tr><tr><td class="css_bagagem_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bagagem_api"]) &&  $this->nmgp_cmp_readonly["bagagem_api"] == "on") { 

 ?>
<input type="hidden" name="bagagem_api" value="<?php echo $this->form_encode_input($bagagem_api) . "\">" . $bagagem_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_bagagem_api" class="sc-ui-readonly-bagagem_api css_bagagem_api_line" style="<?php echo $sStyleReadLab_bagagem_api; ?>"><?php echo $this->form_format_readonly("bagagem_api", $this->form_encode_input($this->bagagem_api)); ?></span><span id="id_read_off_bagagem_api" class="css_read_off_bagagem_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bagagem_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_bagagem_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bagagem_api" type=text name="bagagem_api" value="<?php echo $this->form_encode_input($bagagem_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bagagem_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bagagem_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




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

    <TD class="scFormDataOdd" id="hidden_field_data_id_evento_app" style="<?php echo $sStyleHidden_id_evento_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_evento_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_id_evento_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_id_evento_app"><?php echo $this->nm_new_label['id_evento_app']; ?></span></td></tr><tr><td class="css_id_evento_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_evento_app"]) &&  $this->nmgp_cmp_readonly["id_evento_app"] == "on") { 

 ?>
<input type="hidden" name="id_evento_app" value="<?php echo $this->form_encode_input($id_evento_app) . "\">" . $id_evento_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_evento_app" class="sc-ui-readonly-id_evento_app css_id_evento_app_line" style="<?php echo $sStyleReadLab_id_evento_app; ?>"><?php echo $this->form_format_readonly("id_evento_app", $this->form_encode_input($this->id_evento_app)); ?></span><span id="id_read_off_id_evento_app" class="css_read_off_id_evento_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_evento_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_evento_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_evento_app" type=text name="id_evento_app" value="<?php echo $this->form_encode_input($id_evento_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_evento_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_evento_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_participante_app']))
    {
        $this->nm_new_label['id_participante_app'] = "Id Participante APP:";
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

    <TD class="scFormDataOdd" id="hidden_field_data_id_participante_app" style="<?php echo $sStyleHidden_id_participante_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_participante_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_id_participante_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_id_participante_app"><?php echo $this->nm_new_label['id_participante_app']; ?></span></td></tr><tr><td class="css_id_participante_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_participante_app"]) &&  $this->nmgp_cmp_readonly["id_participante_app"] == "on") { 

 ?>
<input type="hidden" name="id_participante_app" value="<?php echo $this->form_encode_input($id_participante_app) . "\">" . $id_participante_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_participante_app" class="sc-ui-readonly-id_participante_app css_id_participante_app_line" style="<?php echo $sStyleReadLab_id_participante_app; ?>"><?php echo $this->form_format_readonly("id_participante_app", $this->form_encode_input($this->id_participante_app)); ?></span><span id="id_read_off_id_participante_app" class="css_read_off_id_participante_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_participante_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_participante_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_participante_app" type=text name="id_participante_app" value="<?php echo $this->form_encode_input($id_participante_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_participante_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_participante_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_voucher_app']))
    {
        $this->nm_new_label['id_voucher_app'] = "Id Voucher APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_voucher_app = $this->id_voucher_app;
   $sStyleHidden_id_voucher_app = '';
   if (isset($this->nmgp_cmp_hidden['id_voucher_app']) && $this->nmgp_cmp_hidden['id_voucher_app'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_voucher_app']);
       $sStyleHidden_id_voucher_app = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_voucher_app = 'display: none;';
   $sStyleReadInp_id_voucher_app = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_voucher_app']) && $this->nmgp_cmp_readonly['id_voucher_app'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_voucher_app']);
       $sStyleReadLab_id_voucher_app = '';
       $sStyleReadInp_id_voucher_app = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_voucher_app']) && $this->nmgp_cmp_hidden['id_voucher_app'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_voucher_app" value="<?php echo $this->form_encode_input($id_voucher_app) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_id_voucher_app" style="<?php echo $sStyleHidden_id_voucher_app; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_voucher_app_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_id_voucher_app_label" style=" padding: 0px; width: 100%;"><span id="id_label_id_voucher_app"><?php echo $this->nm_new_label['id_voucher_app']; ?></span></td></tr><tr><td class="css_id_voucher_app_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_voucher_app"]) &&  $this->nmgp_cmp_readonly["id_voucher_app"] == "on") { 

 ?>
<input type="hidden" name="id_voucher_app" value="<?php echo $this->form_encode_input($id_voucher_app) . "\">" . $id_voucher_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_voucher_app" class="sc-ui-readonly-id_voucher_app css_id_voucher_app_line" style="<?php echo $sStyleReadLab_id_voucher_app; ?>"><?php echo $this->form_format_readonly("id_voucher_app", $this->form_encode_input($this->id_voucher_app)); ?></span><span id="id_read_off_id_voucher_app" class="css_read_off_id_voucher_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_voucher_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_voucher_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_voucher_app" type=text name="id_voucher_app" value="<?php echo $this->form_encode_input($id_voucher_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_voucher_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_voucher_app_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_id_voucher_app_dumb = ('' == $sStyleHidden_id_voucher_app) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_id_voucher_app_dumb" style="<?php echo $sStyleHidden_id_voucher_app_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_2"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_2" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['atendente']))
    {
        $this->nm_new_label['atendente'] = "Atendente:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $atendente = $this->atendente;
   $sStyleHidden_atendente = '';
   if (isset($this->nmgp_cmp_hidden['atendente']) && $this->nmgp_cmp_hidden['atendente'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['atendente']);
       $sStyleHidden_atendente = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_atendente = 'display: none;';
   $sStyleReadInp_atendente = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['atendente']) && $this->nmgp_cmp_readonly['atendente'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['atendente']);
       $sStyleReadLab_atendente = '';
       $sStyleReadInp_atendente = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['atendente']) && $this->nmgp_cmp_hidden['atendente'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="atendente" value="<?php echo $this->form_encode_input($atendente) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_atendente" style="<?php echo $sStyleHidden_atendente; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_atendente_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_atendente_label" style=" padding: 0px; width: 100%;"><span id="id_label_atendente"><?php echo $this->nm_new_label['atendente']; ?></span></td></tr><tr><td class="css_atendente_line" style="padding: 0px; width: 100%;"><input type="hidden" name="atendente" value="<?php echo $this->form_encode_input($atendente); ?>"><span id="id_ajax_label_atendente"><?php echo nl2br($atendente); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_atendente_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_atendente_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_id_usuario']))
    {
        $this->nm_new_label['aereo_id_usuario'] = "Cód. Atendente:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_id_usuario = $this->aereo_id_usuario;
   $sStyleHidden_aereo_id_usuario = '';
   if (isset($this->nmgp_cmp_hidden['aereo_id_usuario']) && $this->nmgp_cmp_hidden['aereo_id_usuario'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_id_usuario']);
       $sStyleHidden_aereo_id_usuario = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_id_usuario = 'display: none;';
   $sStyleReadInp_aereo_id_usuario = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_id_usuario']) && $this->nmgp_cmp_readonly['aereo_id_usuario'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_id_usuario']);
       $sStyleReadLab_aereo_id_usuario = '';
       $sStyleReadInp_aereo_id_usuario = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_id_usuario']) && $this->nmgp_cmp_hidden['aereo_id_usuario'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_id_usuario" value="<?php echo $this->form_encode_input($aereo_id_usuario) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_id_usuario" style="<?php echo $sStyleHidden_aereo_id_usuario; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_id_usuario_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_id_usuario_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_id_usuario"><?php echo $this->nm_new_label['aereo_id_usuario']; ?></span></td></tr><tr><td class="css_aereo_id_usuario_line" style="padding: 0px; width: 100%;"><input type="hidden" name="aereo_id_usuario" value="<?php echo $this->form_encode_input($aereo_id_usuario); ?>"><span id="id_ajax_label_aereo_id_usuario"><?php echo nl2br($aereo_id_usuario); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_id_usuario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_id_usuario_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_ativo']))
   {
       $this->nm_new_label['aereo_ativo'] = "Registro Ativo:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_ativo = $this->aereo_ativo;
   $sStyleHidden_aereo_ativo = '';
   if (isset($this->nmgp_cmp_hidden['aereo_ativo']) && $this->nmgp_cmp_hidden['aereo_ativo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_ativo']);
       $sStyleHidden_aereo_ativo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_ativo = 'display: none;';
   $sStyleReadInp_aereo_ativo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_ativo']) && $this->nmgp_cmp_readonly['aereo_ativo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_ativo']);
       $sStyleReadLab_aereo_ativo = '';
       $sStyleReadInp_aereo_ativo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_ativo']) && $this->nmgp_cmp_hidden['aereo_ativo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="aereo_ativo" value="<?php echo $this->form_encode_input($this->aereo_ativo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_ativo" style="<?php echo $sStyleHidden_aereo_ativo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_ativo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_ativo_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_ativo"><?php echo $this->nm_new_label['aereo_ativo']; ?></span></td></tr><tr><td class="css_aereo_ativo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_ativo"]) &&  $this->nmgp_cmp_readonly["aereo_ativo"] == "on") { 

$aereo_ativo_look = "";
 if ($this->aereo_ativo == "Y") { $aereo_ativo_look .= "Ativo" ;} 
 if ($this->aereo_ativo == "N") { $aereo_ativo_look .= "Inativo" ;} 
 if (empty($aereo_ativo_look)) { $aereo_ativo_look = $this->aereo_ativo; }
?>
<input type="hidden" name="aereo_ativo" value="<?php echo $this->form_encode_input($aereo_ativo) . "\">" . $aereo_ativo_look . ""; ?>
<?php } else { ?>
<?php

$aereo_ativo_look = "";
 if ($this->aereo_ativo == "Y") { $aereo_ativo_look .= "Ativo" ;} 
 if ($this->aereo_ativo == "N") { $aereo_ativo_look .= "Inativo" ;} 
 if (empty($aereo_ativo_look)) { $aereo_ativo_look = $this->aereo_ativo; }
?>
<span id="id_read_on_aereo_ativo" class="css_aereo_ativo_line"  style="<?php echo $sStyleReadLab_aereo_ativo; ?>"><?php echo $this->form_format_readonly("aereo_ativo", $this->form_encode_input($aereo_ativo_look)); ?></span><span id="id_read_off_aereo_ativo" class="css_read_off_aereo_ativo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_aereo_ativo; ?>">
 <span id="idAjaxSelect_aereo_ativo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_aereo_ativo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_ativo" name="aereo_ativo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="Y" <?php  if ($this->aereo_ativo == "Y") { echo " selected" ;} ?><?php  if (empty($this->aereo_ativo)) { echo " selected" ;} ?>>Ativo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_ativo'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->aereo_ativo == "N") { echo " selected" ;} ?>>Inativo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['Lookup_aereo_ativo'][] = 'N'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_ativo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_ativo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_dthr_saida']))
    {
        $this->nm_new_label['aereo_dthr_saida'] = "Dt. Hr. Saída:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_aereo_dthr_saida = $this->aereo_dthr_saida;
   if (strlen($this->aereo_dthr_saida_hora) > 8 ) {$this->aereo_dthr_saida_hora = substr($this->aereo_dthr_saida_hora, 0, 8);}
   $this->aereo_dthr_saida .= ' ' . $this->aereo_dthr_saida_hora;
   $this->aereo_dthr_saida  = trim($this->aereo_dthr_saida);
   $aereo_dthr_saida = $this->aereo_dthr_saida;
   $sStyleHidden_aereo_dthr_saida = '';
   if (isset($this->nmgp_cmp_hidden['aereo_dthr_saida']) && $this->nmgp_cmp_hidden['aereo_dthr_saida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_dthr_saida']);
       $sStyleHidden_aereo_dthr_saida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_dthr_saida = 'display: none;';
   $sStyleReadInp_aereo_dthr_saida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_dthr_saida']) && $this->nmgp_cmp_readonly['aereo_dthr_saida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_dthr_saida']);
       $sStyleReadLab_aereo_dthr_saida = '';
       $sStyleReadInp_aereo_dthr_saida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_dthr_saida']) && $this->nmgp_cmp_hidden['aereo_dthr_saida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_dthr_saida" value="<?php echo $this->form_encode_input($aereo_dthr_saida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_dthr_saida" style="<?php echo $sStyleHidden_aereo_dthr_saida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_dthr_saida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_dthr_saida_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_dthr_saida"><?php echo $this->nm_new_label['aereo_dthr_saida']; ?></span></td></tr><tr><td class="css_aereo_dthr_saida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="aereo_dthr_saida" value="<?php echo $this->form_encode_input($aereo_dthr_saida); ?>"><span id="id_ajax_label_aereo_dthr_saida"><?php echo nl2br($aereo_dthr_saida); ?></span>
<?php
$tmp_form_data = $this->field_config['aereo_dthr_saida']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_dthr_saida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_dthr_saida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php
   $this->aereo_dthr_saida = $old_dt_aereo_dthr_saida;
?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_dthr_chegada']))
    {
        $this->nm_new_label['aereo_dthr_chegada'] = "Dtt. Hr. Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_aereo_dthr_chegada = $this->aereo_dthr_chegada;
   if (strlen($this->aereo_dthr_chegada_hora) > 8 ) {$this->aereo_dthr_chegada_hora = substr($this->aereo_dthr_chegada_hora, 0, 8);}
   $this->aereo_dthr_chegada .= ' ' . $this->aereo_dthr_chegada_hora;
   $this->aereo_dthr_chegada  = trim($this->aereo_dthr_chegada);
   $aereo_dthr_chegada = $this->aereo_dthr_chegada;
   $sStyleHidden_aereo_dthr_chegada = '';
   if (isset($this->nmgp_cmp_hidden['aereo_dthr_chegada']) && $this->nmgp_cmp_hidden['aereo_dthr_chegada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_dthr_chegada']);
       $sStyleHidden_aereo_dthr_chegada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_dthr_chegada = 'display: none;';
   $sStyleReadInp_aereo_dthr_chegada = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_dthr_chegada']) && $this->nmgp_cmp_readonly['aereo_dthr_chegada'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_dthr_chegada']);
       $sStyleReadLab_aereo_dthr_chegada = '';
       $sStyleReadInp_aereo_dthr_chegada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_dthr_chegada']) && $this->nmgp_cmp_hidden['aereo_dthr_chegada'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_dthr_chegada" value="<?php echo $this->form_encode_input($aereo_dthr_chegada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_dthr_chegada" style="<?php echo $sStyleHidden_aereo_dthr_chegada; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_dthr_chegada_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_dthr_chegada_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_dthr_chegada"><?php echo $this->nm_new_label['aereo_dthr_chegada']; ?></span></td></tr><tr><td class="css_aereo_dthr_chegada_line" style="padding: 0px; width: 100%;"><input type="hidden" name="aereo_dthr_chegada" value="<?php echo $this->form_encode_input($aereo_dthr_chegada); ?>"><span id="id_ajax_label_aereo_dthr_chegada"><?php echo nl2br($aereo_dthr_chegada); ?></span>
<?php
$tmp_form_data = $this->field_config['aereo_dthr_chegada']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_dthr_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_dthr_chegada_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php
   $this->aereo_dthr_chegada = $old_dt_aereo_dthr_chegada;
?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_origem_gate']))
    {
        $this->nm_new_label['id_origem_gate'] = "Origem Gate:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_origem_gate = $this->id_origem_gate;
   $sStyleHidden_id_origem_gate = '';
   if (isset($this->nmgp_cmp_hidden['id_origem_gate']) && $this->nmgp_cmp_hidden['id_origem_gate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_origem_gate']);
       $sStyleHidden_id_origem_gate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_origem_gate = 'display: none;';
   $sStyleReadInp_id_origem_gate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_origem_gate']) && $this->nmgp_cmp_readonly['id_origem_gate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_origem_gate']);
       $sStyleReadLab_id_origem_gate = '';
       $sStyleReadInp_id_origem_gate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_origem_gate']) && $this->nmgp_cmp_hidden['id_origem_gate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_origem_gate" value="<?php echo $this->form_encode_input($id_origem_gate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_id_origem_gate" style="<?php echo $sStyleHidden_id_origem_gate; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_origem_gate_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_id_origem_gate_label" style=" padding: 0px; width: 100%;"><span id="id_label_id_origem_gate"><?php echo $this->nm_new_label['id_origem_gate']; ?></span></td></tr><tr><td class="css_id_origem_gate_line" style="padding: 0px; width: 100%;"><input type="hidden" name="id_origem_gate" value="<?php echo $this->form_encode_input($id_origem_gate); ?>"><span id="id_ajax_label_id_origem_gate"><?php echo nl2br($id_origem_gate); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_origem_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_origem_gate_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_trecho']))
    {
        $this->nm_new_label['aereo_trecho'] = "Núm Trecho:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_trecho = $this->aereo_trecho;
   $sStyleHidden_aereo_trecho = '';
   if (isset($this->nmgp_cmp_hidden['aereo_trecho']) && $this->nmgp_cmp_hidden['aereo_trecho'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_trecho']);
       $sStyleHidden_aereo_trecho = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_trecho = 'display: none;';
   $sStyleReadInp_aereo_trecho = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_trecho']) && $this->nmgp_cmp_readonly['aereo_trecho'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_trecho']);
       $sStyleReadLab_aereo_trecho = '';
       $sStyleReadInp_aereo_trecho = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_trecho']) && $this->nmgp_cmp_hidden['aereo_trecho'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_trecho" value="<?php echo $this->form_encode_input($aereo_trecho) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_trecho" style="<?php echo $sStyleHidden_aereo_trecho; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_trecho_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_trecho_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_trecho"><?php echo $this->nm_new_label['aereo_trecho']; ?></span></td></tr><tr><td class="css_aereo_trecho_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_trecho"]) &&  $this->nmgp_cmp_readonly["aereo_trecho"] == "on") { 

 ?>
<input type="hidden" name="aereo_trecho" value="<?php echo $this->form_encode_input($aereo_trecho) . "\">" . $aereo_trecho . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_trecho" class="sc-ui-readonly-aereo_trecho css_aereo_trecho_line" style="<?php echo $sStyleReadLab_aereo_trecho; ?>"><?php echo $this->form_format_readonly("aereo_trecho", $this->form_encode_input($this->aereo_trecho)); ?></span><span id="id_read_off_aereo_trecho" class="css_read_off_aereo_trecho<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_trecho; ?>">
 <input class="sc-js-input scFormObjectOdd css_aereo_trecho_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_trecho" type=text name="aereo_trecho" value="<?php echo $this->form_encode_input($aereo_trecho) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=2"; } ?> alt="{datatype: 'integer', maxLength: 2, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['aereo_trecho']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['aereo_trecho']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['aereo_trecho']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_trecho_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_trecho_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_modificado_em']))
    {
        $this->nm_new_label['aereo_modificado_em'] = "Aereo Modificado Em";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_aereo_modificado_em = $this->aereo_modificado_em;
   if (strlen($this->aereo_modificado_em_hora) > 8 ) {$this->aereo_modificado_em_hora = substr($this->aereo_modificado_em_hora, 0, 8);}
   $this->aereo_modificado_em .= ' ' . $this->aereo_modificado_em_hora;
   $this->aereo_modificado_em  = trim($this->aereo_modificado_em);
   $aereo_modificado_em = $this->aereo_modificado_em;
   $sStyleHidden_aereo_modificado_em = '';
   if (isset($this->nmgp_cmp_hidden['aereo_modificado_em']) && $this->nmgp_cmp_hidden['aereo_modificado_em'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_modificado_em']);
       $sStyleHidden_aereo_modificado_em = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_modificado_em = 'display: none;';
   $sStyleReadInp_aereo_modificado_em = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_modificado_em']) && $this->nmgp_cmp_readonly['aereo_modificado_em'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_modificado_em']);
       $sStyleReadLab_aereo_modificado_em = '';
       $sStyleReadInp_aereo_modificado_em = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_modificado_em']) && $this->nmgp_cmp_hidden['aereo_modificado_em'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_modificado_em" value="<?php echo $this->form_encode_input($aereo_modificado_em) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_modificado_em" style="<?php echo $sStyleHidden_aereo_modificado_em; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_modificado_em_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_modificado_em_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_modificado_em"><?php echo $this->nm_new_label['aereo_modificado_em']; ?></span></td></tr><tr><td class="css_aereo_modificado_em_line" style="padding: 0px; width: 100%;"><input type="hidden" name="aereo_modificado_em" value="<?php echo $this->form_encode_input($aereo_modificado_em); ?>"><span id="id_ajax_label_aereo_modificado_em"><?php echo nl2br($aereo_modificado_em); ?></span>
<?php
$tmp_form_data = $this->field_config['aereo_modificado_em']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_modificado_em_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_modificado_em_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php
   $this->aereo_modificado_em = $old_dt_aereo_modificado_em;
?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nome_pax_gate']))
    {
        $this->nm_new_label['nome_pax_gate'] = "Pax Gate:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nome_pax_gate = $this->nome_pax_gate;
   $sStyleHidden_nome_pax_gate = '';
   if (isset($this->nmgp_cmp_hidden['nome_pax_gate']) && $this->nmgp_cmp_hidden['nome_pax_gate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nome_pax_gate']);
       $sStyleHidden_nome_pax_gate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nome_pax_gate = 'display: none;';
   $sStyleReadInp_nome_pax_gate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nome_pax_gate']) && $this->nmgp_cmp_readonly['nome_pax_gate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nome_pax_gate']);
       $sStyleReadLab_nome_pax_gate = '';
       $sStyleReadInp_nome_pax_gate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nome_pax_gate']) && $this->nmgp_cmp_hidden['nome_pax_gate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nome_pax_gate" value="<?php echo $this->form_encode_input($nome_pax_gate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_nome_pax_gate" style="<?php echo $sStyleHidden_nome_pax_gate; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nome_pax_gate_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_nome_pax_gate_label" style=" padding: 0px; width: 100%;"><span id="id_label_nome_pax_gate"><?php echo $this->nm_new_label['nome_pax_gate']; ?></span></td></tr><tr><td class="css_nome_pax_gate_line" style="padding: 0px; width: 100%;"><input type="hidden" name="nome_pax_gate" value="<?php echo $this->form_encode_input($nome_pax_gate); ?>"><span id="id_ajax_label_nome_pax_gate"><?php echo nl2br($nome_pax_gate); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_pax_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_pax_gate_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nota_gate']))
    {
        $this->nm_new_label['nota_gate'] = "Nota Gate:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nota_gate = $this->nota_gate;
   $sStyleHidden_nota_gate = '';
   if (isset($this->nmgp_cmp_hidden['nota_gate']) && $this->nmgp_cmp_hidden['nota_gate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nota_gate']);
       $sStyleHidden_nota_gate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nota_gate = 'display: none;';
   $sStyleReadInp_nota_gate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nota_gate']) && $this->nmgp_cmp_readonly['nota_gate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nota_gate']);
       $sStyleReadLab_nota_gate = '';
       $sStyleReadInp_nota_gate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nota_gate']) && $this->nmgp_cmp_hidden['nota_gate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nota_gate" value="<?php echo $this->form_encode_input($nota_gate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_nota_gate" style="<?php echo $sStyleHidden_nota_gate; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nota_gate_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_nota_gate_label" style=" padding: 0px; width: 100%;"><span id="id_label_nota_gate"><?php echo $this->nm_new_label['nota_gate']; ?></span></td></tr><tr><td class="css_nota_gate_line" style="padding: 0px; width: 100%;"><input type="hidden" name="nota_gate" value="<?php echo $this->form_encode_input($nota_gate); ?>"><span id="id_ajax_label_nota_gate"><?php echo nl2br($nota_gate); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nota_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nota_gate_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['data_nota_gate']))
    {
        $this->nm_new_label['data_nota_gate'] = "Data Nota Gate:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $data_nota_gate = $this->data_nota_gate;
   $sStyleHidden_data_nota_gate = '';
   if (isset($this->nmgp_cmp_hidden['data_nota_gate']) && $this->nmgp_cmp_hidden['data_nota_gate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['data_nota_gate']);
       $sStyleHidden_data_nota_gate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_data_nota_gate = 'display: none;';
   $sStyleReadInp_data_nota_gate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['data_nota_gate']) && $this->nmgp_cmp_readonly['data_nota_gate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['data_nota_gate']);
       $sStyleReadLab_data_nota_gate = '';
       $sStyleReadInp_data_nota_gate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['data_nota_gate']) && $this->nmgp_cmp_hidden['data_nota_gate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="data_nota_gate" value="<?php echo $this->form_encode_input($data_nota_gate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_data_nota_gate" style="<?php echo $sStyleHidden_data_nota_gate; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_data_nota_gate_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_data_nota_gate_label" style=" padding: 0px; width: 100%;"><span id="id_label_data_nota_gate"><?php echo $this->nm_new_label['data_nota_gate']; ?></span></td></tr><tr><td class="css_data_nota_gate_line" style="padding: 0px; width: 100%;"><input type="hidden" name="data_nota_gate" value="<?php echo $this->form_encode_input($data_nota_gate); ?>"><span id="id_ajax_label_data_nota_gate"><?php echo nl2br($data_nota_gate); ?></span>
<?php
$tmp_form_data = $this->field_config['data_nota_gate']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_data_nota_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_data_nota_gate_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fil_agt_gate']))
    {
        $this->nm_new_label['fil_agt_gate'] = "Fil Agt Gate:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fil_agt_gate = $this->fil_agt_gate;
   $sStyleHidden_fil_agt_gate = '';
   if (isset($this->nmgp_cmp_hidden['fil_agt_gate']) && $this->nmgp_cmp_hidden['fil_agt_gate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fil_agt_gate']);
       $sStyleHidden_fil_agt_gate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fil_agt_gate = 'display: none;';
   $sStyleReadInp_fil_agt_gate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fil_agt_gate']) && $this->nmgp_cmp_readonly['fil_agt_gate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fil_agt_gate']);
       $sStyleReadLab_fil_agt_gate = '';
       $sStyleReadInp_fil_agt_gate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fil_agt_gate']) && $this->nmgp_cmp_hidden['fil_agt_gate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fil_agt_gate" value="<?php echo $this->form_encode_input($fil_agt_gate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fil_agt_gate" style="<?php echo $sStyleHidden_fil_agt_gate; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fil_agt_gate_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fil_agt_gate_label" style=" padding: 0px; width: 100%;"><span id="id_label_fil_agt_gate"><?php echo $this->nm_new_label['fil_agt_gate']; ?></span></td></tr><tr><td class="css_fil_agt_gate_line" style="padding: 0px; width: 100%;"><input type="hidden" name="fil_agt_gate" value="<?php echo $this->form_encode_input($fil_agt_gate); ?>"><span id="id_ajax_label_fil_agt_gate"><?php echo nl2br($fil_agt_gate); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fil_agt_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fil_agt_gate_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_cia_aerea_gate']))
    {
        $this->nm_new_label['aereo_cia_aerea_gate'] = "Cia Aerea Gate:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_cia_aerea_gate = $this->aereo_cia_aerea_gate;
   $sStyleHidden_aereo_cia_aerea_gate = '';
   if (isset($this->nmgp_cmp_hidden['aereo_cia_aerea_gate']) && $this->nmgp_cmp_hidden['aereo_cia_aerea_gate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_cia_aerea_gate']);
       $sStyleHidden_aereo_cia_aerea_gate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_cia_aerea_gate = 'display: none;';
   $sStyleReadInp_aereo_cia_aerea_gate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_cia_aerea_gate']) && $this->nmgp_cmp_readonly['aereo_cia_aerea_gate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_cia_aerea_gate']);
       $sStyleReadLab_aereo_cia_aerea_gate = '';
       $sStyleReadInp_aereo_cia_aerea_gate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_cia_aerea_gate']) && $this->nmgp_cmp_hidden['aereo_cia_aerea_gate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_cia_aerea_gate" value="<?php echo $this->form_encode_input($aereo_cia_aerea_gate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_aereo_cia_aerea_gate" style="<?php echo $sStyleHidden_aereo_cia_aerea_gate; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_cia_aerea_gate_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_aereo_cia_aerea_gate_label" style=" padding: 0px; width: 100%;"><span id="id_label_aereo_cia_aerea_gate"><?php echo $this->nm_new_label['aereo_cia_aerea_gate']; ?></span></td></tr><tr><td class="css_aereo_cia_aerea_gate_line" style="padding: 0px; width: 100%;"><input type="hidden" name="aereo_cia_aerea_gate" value="<?php echo $this->form_encode_input($aereo_cia_aerea_gate); ?>"><span id="id_ajax_label_aereo_cia_aerea_gate"><?php echo nl2br($aereo_cia_aerea_gate); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_cia_aerea_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_cia_aerea_gate_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




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

    <TD class="scFormDataOdd" id="hidden_field_data_cpf_del" style="<?php echo $sStyleHidden_cpf_del; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cpf_del_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cpf_del_label" style=" padding: 0px; width: 100%;"><span id="id_label_cpf_del"><?php echo $this->nm_new_label['cpf_del']; ?></span></td></tr><tr><td class="css_cpf_del_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cpf_del"]) &&  $this->nmgp_cmp_readonly["cpf_del"] == "on") { 

 ?>
<input type="hidden" name="cpf_del" value="<?php echo $this->form_encode_input($cpf_del) . "\">" . $cpf_del . ""; ?>
<?php } else { ?>
<span id="id_read_on_cpf_del" class="sc-ui-readonly-cpf_del css_cpf_del_line" style="<?php echo $sStyleReadLab_cpf_del; ?>"><?php echo $this->form_format_readonly("cpf_del", $this->form_encode_input($this->cpf_del)); ?></span><span id="id_read_off_cpf_del" class="css_read_off_cpf_del<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cpf_del; ?>">
 <input class="sc-js-input scFormObjectOdd css_cpf_del_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cpf_del" type=text name="cpf_del" value="<?php echo $this->form_encode_input($cpf_del) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cpf_del_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cpf_del_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['birpara'];
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
        $buttonMacroDisabled = 'sc-unique-btn-25';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['first'];
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
        $buttonMacroDisabled = 'sc-unique-btn-26';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['back'];
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
        $buttonMacroDisabled = 'sc-unique-btn-27';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['forward'];
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
        $buttonMacroDisabled = 'sc-unique-btn-28';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
  $nm_sc_blocos_da_pag = array(0,1,2);

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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['masterValue']);
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
  if ("cabecalho" == sFldName)
  {
    document.getElementById("head_mark_cabecalho_0").innerHTML = sFldValue;
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_aereos_rsvp_1_mob");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_aereos_rsvp_1_mob");
 parent.scAjaxDetailHeight("form_aereos_rsvp_1_mob", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_aereos_rsvp_1_mob", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_aereos_rsvp_1_mob", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['sc_modal'])
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
        function scBtnFn_sc_btn_0() {
                if ($("#sc_sc_btn_0_top").length && $("#sc_sc_btn_0_top").is(":visible")) {
                    if ($("#sc_sc_btn_0_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                         return;
                }
                if ($("#sc_sc_btn_0_top").length && $("#sc_sc_btn_0_top").is(":visible")) {
                    if ($("#sc_sc_btn_0_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                         return;
                }
                if ($("#sc_sc_btn_0_top").length && $("#sc_sc_btn_0_top").is(":visible")) {
                    if ($("#sc_sc_btn_0_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                         return;
                }
                if ($("#sc_sc_btn_0_top").length && $("#sc_sc_btn_0_top").is(":visible")) {
                    if ($("#sc_sc_btn_0_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                         return;
                }
        }
        function scBtnFn_LOG() {
                if ($("#sc_LOG_top").length && $("#sc_LOG_top").is(":visible")) {
                    if ($("#sc_LOG_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_LOG()
                         return;
                }
                if ($("#sc_LOG_top").length && $("#sc_LOG_top").is(":visible")) {
                    if ($("#sc_LOG_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_LOG()
                         return;
                }
                if ($("#sc_LOG_top").length && $("#sc_LOG_top").is(":visible")) {
                    if ($("#sc_LOG_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_LOG()
                         return;
                }
                if ($("#sc_LOG_top").length && $("#sc_LOG_top").is(":visible")) {
                    if ($("#sc_LOG_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_LOG()
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_1_mob']['inside_nested_iframe']) {
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
