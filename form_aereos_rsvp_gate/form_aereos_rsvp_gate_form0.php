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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("Aéreos GATE"); } else { echo strip_tags("Aéreos GATE"); } ?></TITLE>
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
.css_read_off_aereo_modificado_em button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['embutida_pdf']))
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
 <style type="text/css">
  .scTabActive { font-size: 12px }
  .scTabInactive { font-size: 12px }
 </style>
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_aereos_rsvp_gate/form_aereos_rsvp_gate_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_aereos_rsvp_gate_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_aereos_rsvp_gate_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['recarga'];
}
if ('' != $this->aereo_cia_aerea_gate)
{
    $this->lookup_aereo_cia_aerea_gate($look_rpc_aereo_cia_aerea_gate);
}
if ('' != $this->aereo_origem)
{
    $this->lookup_aereo_origem($look_rpc_aereo_origem);
}
if ('' != $this->aereo_destino)
{
    $this->lookup_aereo_destino($look_rpc_aereo_destino);
}
if ('' != $this->aereo_cia_aerea)
{
    $this->lookup_aereo_cia_aerea($look_rpc_aereo_cia_aerea);
}
if ('' != $this->aereo_origem_rsvp)
{
    $this->lookup_aereo_origem_rsvp($look_rpc_aereo_origem_rsvp);
}
if ('' != $this->aereo_destino_rsvp)
{
    $this->lookup_aereo_destino_rsvp($look_rpc_aereo_destino_rsvp);
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['link_info']['remove_border']) {
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
 include_once("form_aereos_rsvp_gate_js0.php");
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_aereos_rsvp_gate'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_aereos_rsvp_gate'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  $this->Tab_width = "  width=\"45%\"";
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['fast_search'][2] : "";
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
          $SC_Label_atu['id_aereo'] = (isset($this->nm_new_label['id_aereo'])) ? $this->nm_new_label['id_aereo'] : 'Cód.:'; 
          $SC_Label_atu['aereo_cpf_particip'] = (isset($this->nm_new_label['aereo_cpf_particip'])) ? $this->nm_new_label['aereo_cpf_particip'] : 'ID Participante:'; 
          $SC_Label_atu['aereo_status'] = (isset($this->nm_new_label['aereo_status'])) ? $this->nm_new_label['aereo_status'] : 'Status:'; 
          $SC_Label_atu['aereo_direcao'] = (isset($this->nm_new_label['aereo_direcao'])) ? $this->nm_new_label['aereo_direcao'] : 'Direção:'; 
          $SC_Label_atu['aereo_localizador'] = (isset($this->nm_new_label['aereo_localizador'])) ? $this->nm_new_label['aereo_localizador'] : 'Localizador ou Bilhete GATE:'; 
          $SC_Label_atu['aereo_eticket'] = (isset($this->nm_new_label['aereo_eticket'])) ? $this->nm_new_label['aereo_eticket'] : 'Bilhete GATE:'; 
          $SC_Label_atu['aereo_cia_aerea_gate'] = (isset($this->nm_new_label['aereo_cia_aerea_gate'])) ? $this->nm_new_label['aereo_cia_aerea_gate'] : 'Cia. Aérea:'; 
          $SC_Label_atu['aereo_origem'] = (isset($this->nm_new_label['aereo_origem'])) ? $this->nm_new_label['aereo_origem'] : 'Origem:'; 
          $SC_Label_atu['aereo_destino'] = (isset($this->nm_new_label['aereo_destino'])) ? $this->nm_new_label['aereo_destino'] : 'Destino:'; 
          $SC_Label_atu['aereo_num_voo'] = (isset($this->nm_new_label['aereo_num_voo'])) ? $this->nm_new_label['aereo_num_voo'] : 'Voo:'; 
          $SC_Label_atu['aereo_dt_saida'] = (isset($this->nm_new_label['aereo_dt_saida'])) ? $this->nm_new_label['aereo_dt_saida'] : 'Saída:'; 
          $SC_Label_atu['aereo_hr_saida'] = (isset($this->nm_new_label['aereo_hr_saida'])) ? $this->nm_new_label['aereo_hr_saida'] : 'Hr. Saída:'; 
          $SC_Label_atu['aereo_dt_chegada'] = (isset($this->nm_new_label['aereo_dt_chegada'])) ? $this->nm_new_label['aereo_dt_chegada'] : 'Chegada:'; 
          $SC_Label_atu['aereo_hr_chegada'] = (isset($this->nm_new_label['aereo_hr_chegada'])) ? $this->nm_new_label['aereo_hr_chegada'] : 'Hr. Chegada:'; 
          $SC_Label_atu['aereo_trecho'] = (isset($this->nm_new_label['aereo_trecho'])) ? $this->nm_new_label['aereo_trecho'] : 'Trecho:'; 
          $SC_Label_atu['nome_pax_gate'] = (isset($this->nm_new_label['nome_pax_gate'])) ? $this->nm_new_label['nome_pax_gate'] : 'Pax:'; 
          $SC_Label_atu['nota_gate'] = (isset($this->nm_new_label['nota_gate'])) ? $this->nm_new_label['nota_gate'] : 'Nota Gate:'; 
          $SC_Label_atu['data_nota_gate'] = (isset($this->nm_new_label['data_nota_gate'])) ? $this->nm_new_label['data_nota_gate'] : 'Data Nota Gate:'; 
          $SC_Label_atu['aereo_valor'] = (isset($this->nm_new_label['aereo_valor'])) ? $this->nm_new_label['aereo_valor'] : 'Valor:'; 
          $SC_Label_atu['aereo_id_usuario'] = (isset($this->nm_new_label['aereo_id_usuario'])) ? $this->nm_new_label['aereo_id_usuario'] : 'Cód. Atendente:'; 
          $SC_Label_atu['aereo_ativo'] = (isset($this->nm_new_label['aereo_ativo'])) ? $this->nm_new_label['aereo_ativo'] : 'Registro Ativo:'; 
          $SC_Label_atu['aereo_cia_aerea'] = (isset($this->nm_new_label['aereo_cia_aerea'])) ? $this->nm_new_label['aereo_cia_aerea'] : 'Cia. Aérea RSVP:'; 
          $SC_Label_atu['aereo_dthr_saida'] = (isset($this->nm_new_label['aereo_dthr_saida'])) ? $this->nm_new_label['aereo_dthr_saida'] : 'Data/Hora Saída'; 
          $SC_Label_atu['aereo_dthr_chegada'] = (isset($this->nm_new_label['aereo_dthr_chegada'])) ? $this->nm_new_label['aereo_dthr_chegada'] : 'Data/Hora Chegada'; 
          $SC_Label_atu['aereo_origem_rsvp'] = (isset($this->nm_new_label['aereo_origem_rsvp'])) ? $this->nm_new_label['aereo_origem_rsvp'] : 'Origem RSVP:'; 
          $SC_Label_atu['aereo_destino_rsvp'] = (isset($this->nm_new_label['aereo_destino_rsvp'])) ? $this->nm_new_label['aereo_destino_rsvp'] : 'Destino RSVP:'; 
          $SC_Label_atu['fil_agt_gate'] = (isset($this->nm_new_label['fil_agt_gate'])) ? $this->nm_new_label['fil_agt_gate'] : 'Fil agt Gate:'; 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['new'];
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
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['insert'];
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
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['bcancelar'];
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
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['update'];
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
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['empty_filter'] = true;
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
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_aereo']))
           {
               $this->nmgp_cmp_readonly['id_aereo'] = 'on';
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
}
</script>
<ul class="scTabLine">
<li id="id_tabs_0_0" class="scTabActive" style="font-size: 12"><a href="javascript: sc_control_tabs_0(0)">Aéreo</a></li>
<li id="id_tabs_0_1" class="scTabInactive"><a href="javascript: sc_control_tabs_0(1)">Status Registro / Atendente</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_aereo']))
    {
        $this->nm_new_label['id_aereo'] = "Cód.:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_aereo = $this->id_aereo;
   $sStyleHidden_id_aereo = '';
   if (isset($this->nmgp_cmp_hidden['id_aereo']) && $this->nmgp_cmp_hidden['id_aereo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_aereo']);
       $sStyleHidden_id_aereo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_aereo = 'display: none;';
   $sStyleReadInp_id_aereo = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_aereo"]) &&  $this->nmgp_cmp_readonly["id_aereo"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_aereo']);
       $sStyleReadLab_id_aereo = '';
       $sStyleReadInp_id_aereo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_aereo']) && $this->nmgp_cmp_hidden['id_aereo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_aereo" value="<?php echo $this->form_encode_input($id_aereo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_aereo_label" id="hidden_field_label_id_aereo" style="<?php echo $sStyleHidden_id_aereo; ?>"><span id="id_label_id_aereo"><?php echo $this->nm_new_label['id_aereo']; ?></span></TD>
    <TD class="scFormDataOdd css_id_aereo_line" id="hidden_field_data_id_aereo" style="<?php echo $sStyleHidden_id_aereo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_aereo_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_id_aereo" class="css_id_aereo_line" style="<?php echo $sStyleReadLab_id_aereo; ?>"><?php echo $this->form_format_readonly("id_aereo", $this->form_encode_input($this->id_aereo)); ?></span><span id="id_read_off_id_aereo" class="css_read_off_id_aereo" style="<?php echo $sStyleReadInp_id_aereo; ?>"><input type="hidden" name="id_aereo" value="<?php echo $this->form_encode_input($id_aereo) . "\">"?><span id="id_ajax_label_id_aereo"><?php echo nl2br($id_aereo); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_aereo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_aereo_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['aereo_cpf_particip']))
    {
        $this->nm_new_label['aereo_cpf_particip'] = "ID Participante:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_cpf_particip_label" id="hidden_field_label_aereo_cpf_particip" style="<?php echo $sStyleHidden_aereo_cpf_particip; ?>"><span id="id_label_aereo_cpf_particip"><?php echo $this->nm_new_label['aereo_cpf_particip']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_cpf_particip_line" id="hidden_field_data_aereo_cpf_particip" style="<?php echo $sStyleHidden_aereo_cpf_particip; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_cpf_particip_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_cpf_particip" value="<?php echo $this->form_encode_input($aereo_cpf_particip); ?>"><span id="id_ajax_label_aereo_cpf_particip"><?php echo nl2br($aereo_cpf_particip); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_cpf_particip_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_cpf_particip_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_tipo_pessoa_label" id="hidden_field_label_tipo_pessoa" style="<?php echo $sStyleHidden_tipo_pessoa; ?>"><span id="id_label_tipo_pessoa"><?php echo $this->nm_new_label['tipo_pessoa']; ?></span></TD>
    <TD class="scFormDataOdd css_tipo_pessoa_line" id="hidden_field_data_tipo_pessoa" style="<?php echo $sStyleHidden_tipo_pessoa; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tipo_pessoa_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="tipo_pessoa" value="<?php echo $this->form_encode_input($tipo_pessoa); ?>"><span id="id_ajax_label_tipo_pessoa"><?php echo nl2br($tipo_pessoa); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_pessoa_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_pessoa_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_status_label" id="hidden_field_label_aereo_status" style="<?php echo $sStyleHidden_aereo_status; ?>"><span id="id_label_aereo_status"><?php echo $this->nm_new_label['aereo_status']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_status_line" id="hidden_field_data_aereo_status" style="<?php echo $sStyleHidden_aereo_status; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_status_line" style="vertical-align: top;padding: 0px">
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
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['Lookup_aereo_status'][] = 'A'; ?>
 <option  value="Y" <?php  if ($this->aereo_status == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['Lookup_aereo_status'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->aereo_status == "N") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['Lookup_aereo_status'][] = 'N'; ?>
 <option  value="P" <?php  if ($this->aereo_status == "P") { echo " selected" ;} ?>>Pendente</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['Lookup_aereo_status'][] = 'P'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_status_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['aereo_direcao']))
   {
       $this->nm_new_label['aereo_direcao'] = "Direção:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_direcao_label" id="hidden_field_label_aereo_direcao" style="<?php echo $sStyleHidden_aereo_direcao; ?>"><span id="id_label_aereo_direcao"><?php echo $this->nm_new_label['aereo_direcao']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_direcao_line" id="hidden_field_data_aereo_direcao" style="<?php echo $sStyleHidden_aereo_direcao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_direcao_line" style="vertical-align: top;padding: 0px">
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
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['Lookup_aereo_direcao'][] = ''; ?>
 <option value="">.:Selecione:.</option>
 <option  value="IDA" <?php  if ($this->aereo_direcao == "IDA") { echo " selected" ;} ?>>IDA</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['Lookup_aereo_direcao'][] = 'IDA'; ?>
 <option  value="VOLTA" <?php  if ($this->aereo_direcao == "VOLTA") { echo " selected" ;} ?>>VOLTA</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['Lookup_aereo_direcao'][] = 'VOLTA'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_direcao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_direcao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_localizador']))
    {
        $this->nm_new_label['aereo_localizador'] = "Localizador ou Bilhete GATE:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_localizador_label" id="hidden_field_label_aereo_localizador" style="<?php echo $sStyleHidden_aereo_localizador; ?>"><span id="id_label_aereo_localizador"><?php echo $this->nm_new_label['aereo_localizador']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_localizador_line" id="hidden_field_data_aereo_localizador" style="<?php echo $sStyleHidden_aereo_localizador; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_localizador_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["aereo_localizador"]) &&  $this->nmgp_cmp_readonly["aereo_localizador"] == "on") { 

 ?>
<input type="hidden" name="aereo_localizador" value="<?php echo $this->form_encode_input($aereo_localizador) . "\">" . $aereo_localizador . ""; ?>
<?php } else { ?>
<span id="id_read_on_aereo_localizador" class="sc-ui-readonly-aereo_localizador css_aereo_localizador_line" style="<?php echo $sStyleReadLab_aereo_localizador; ?>"><?php echo $this->form_format_readonly("aereo_localizador", $this->form_encode_input($this->aereo_localizador)); ?></span><span id="id_read_off_aereo_localizador" class="css_read_off_aereo_localizador<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_aereo_localizador; ?>">
 <input class="sc-js-input scFormObjectOdd css_aereo_localizador_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_aereo_localizador" type=text name="aereo_localizador" value="<?php echo $this->form_encode_input($aereo_localizador) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_localizador_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_localizador_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_eticket']))
    {
        $this->nm_new_label['aereo_eticket'] = "Bilhete GATE:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_eticket_label" id="hidden_field_label_aereo_eticket" style="<?php echo $sStyleHidden_aereo_eticket; ?>"><span id="id_label_aereo_eticket"><?php echo $this->nm_new_label['aereo_eticket']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_eticket_line" id="hidden_field_data_aereo_eticket" style="<?php echo $sStyleHidden_aereo_eticket; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_eticket_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_eticket" value="<?php echo $this->form_encode_input($aereo_eticket); ?>"><span id="id_ajax_label_aereo_eticket"><?php echo nl2br($aereo_eticket); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_eticket_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_eticket_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_cia_aerea_gate']))
    {
        $this->nm_new_label['aereo_cia_aerea_gate'] = "Cia. Aérea:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_cia_aerea_gate_label" id="hidden_field_label_aereo_cia_aerea_gate" style="<?php echo $sStyleHidden_aereo_cia_aerea_gate; ?>"><span id="id_label_aereo_cia_aerea_gate"><?php echo $this->nm_new_label['aereo_cia_aerea_gate']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_cia_aerea_gate_line" id="hidden_field_data_aereo_cia_aerea_gate" style="<?php echo $sStyleHidden_aereo_cia_aerea_gate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_cia_aerea_gate_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_cia_aerea_gate" value="<?php echo $this->form_encode_input($aereo_cia_aerea_gate); ?>"><span id="id_ajax_label_aereo_cia_aerea_gate"><?php echo nl2br($aereo_cia_aerea_gate); ?></span>
 <SPAN id="id_lookup_aereo_cia_aerea_gate"><?php echo $look_rpc_aereo_cia_aerea_gate; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_cia_aerea_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_cia_aerea_gate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_origem']))
    {
        $this->nm_new_label['aereo_origem'] = "Origem:";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['aereo_origem']) && $this->nmgp_cmp_hidden['aereo_origem'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_origem" value="<?php echo $this->form_encode_input($aereo_origem) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_origem_label" id="hidden_field_label_aereo_origem" style="<?php echo $sStyleHidden_aereo_origem; ?>"><span id="id_label_aereo_origem"><?php echo $this->nm_new_label['aereo_origem']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_origem_line" id="hidden_field_data_aereo_origem" style="<?php echo $sStyleHidden_aereo_origem; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_origem_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_origem" value="<?php echo $this->form_encode_input($aereo_origem); ?>"><span id="id_ajax_label_aereo_origem"><?php echo nl2br($aereo_origem); ?></span>
 <SPAN id="id_lookup_aereo_origem"><?php echo $look_rpc_aereo_origem; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_origem_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_origem_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_destino']))
    {
        $this->nm_new_label['aereo_destino'] = "Destino:";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['aereo_destino']) && $this->nmgp_cmp_hidden['aereo_destino'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_destino" value="<?php echo $this->form_encode_input($aereo_destino) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_destino_label" id="hidden_field_label_aereo_destino" style="<?php echo $sStyleHidden_aereo_destino; ?>"><span id="id_label_aereo_destino"><?php echo $this->nm_new_label['aereo_destino']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_destino_line" id="hidden_field_data_aereo_destino" style="<?php echo $sStyleHidden_aereo_destino; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_destino_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_destino" value="<?php echo $this->form_encode_input($aereo_destino); ?>"><span id="id_ajax_label_aereo_destino"><?php echo nl2br($aereo_destino); ?></span>
 <SPAN id="id_lookup_aereo_destino"><?php echo $look_rpc_aereo_destino; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_destino_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_destino_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_num_voo']))
    {
        $this->nm_new_label['aereo_num_voo'] = "Voo:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_num_voo_label" id="hidden_field_label_aereo_num_voo" style="<?php echo $sStyleHidden_aereo_num_voo; ?>"><span id="id_label_aereo_num_voo"><?php echo $this->nm_new_label['aereo_num_voo']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_num_voo_line" id="hidden_field_data_aereo_num_voo" style="<?php echo $sStyleHidden_aereo_num_voo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_num_voo_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_num_voo" value="<?php echo $this->form_encode_input($aereo_num_voo); ?>"><span id="id_ajax_label_aereo_num_voo"><?php echo nl2br($aereo_num_voo); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_num_voo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_num_voo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_dt_saida']))
    {
        $this->nm_new_label['aereo_dt_saida'] = "Saída:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_dt_saida_label" id="hidden_field_label_aereo_dt_saida" style="<?php echo $sStyleHidden_aereo_dt_saida; ?>"><span id="id_label_aereo_dt_saida"><?php echo $this->nm_new_label['aereo_dt_saida']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_dt_saida_line" id="hidden_field_data_aereo_dt_saida" style="<?php echo $sStyleHidden_aereo_dt_saida; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_dt_saida_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_dt_saida" value="<?php echo $this->form_encode_input($aereo_dt_saida); ?>"><span id="id_ajax_label_aereo_dt_saida"><?php echo nl2br($aereo_dt_saida); ?></span>
<?php
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
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_dt_saida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_dt_saida_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_hr_saida']))
    {
        $this->nm_new_label['aereo_hr_saida'] = "Hr. Saída:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_hr_saida_label" id="hidden_field_label_aereo_hr_saida" style="<?php echo $sStyleHidden_aereo_hr_saida; ?>"><span id="id_label_aereo_hr_saida"><?php echo $this->nm_new_label['aereo_hr_saida']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_hr_saida_line" id="hidden_field_data_aereo_hr_saida" style="<?php echo $sStyleHidden_aereo_hr_saida; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_hr_saida_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_hr_saida" value="<?php echo $this->form_encode_input($aereo_hr_saida); ?>"><span id="id_ajax_label_aereo_hr_saida"><?php echo nl2br($aereo_hr_saida); ?></span>
<?php
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
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_hr_saida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_hr_saida_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_dt_chegada']))
    {
        $this->nm_new_label['aereo_dt_chegada'] = "Chegada:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_dt_chegada_label" id="hidden_field_label_aereo_dt_chegada" style="<?php echo $sStyleHidden_aereo_dt_chegada; ?>"><span id="id_label_aereo_dt_chegada"><?php echo $this->nm_new_label['aereo_dt_chegada']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_dt_chegada_line" id="hidden_field_data_aereo_dt_chegada" style="<?php echo $sStyleHidden_aereo_dt_chegada; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_dt_chegada_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_dt_chegada" value="<?php echo $this->form_encode_input($aereo_dt_chegada); ?>"><span id="id_ajax_label_aereo_dt_chegada"><?php echo nl2br($aereo_dt_chegada); ?></span>
<?php
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
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_dt_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_dt_chegada_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_hr_chegada']))
    {
        $this->nm_new_label['aereo_hr_chegada'] = "Hr. Chegada:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_hr_chegada_label" id="hidden_field_label_aereo_hr_chegada" style="<?php echo $sStyleHidden_aereo_hr_chegada; ?>"><span id="id_label_aereo_hr_chegada"><?php echo $this->nm_new_label['aereo_hr_chegada']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_hr_chegada_line" id="hidden_field_data_aereo_hr_chegada" style="<?php echo $sStyleHidden_aereo_hr_chegada; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_hr_chegada_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_hr_chegada" value="<?php echo $this->form_encode_input($aereo_hr_chegada); ?>"><span id="id_ajax_label_aereo_hr_chegada"><?php echo nl2br($aereo_hr_chegada); ?></span>
<?php
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
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_hr_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_hr_chegada_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_trecho']))
    {
        $this->nm_new_label['aereo_trecho'] = "Trecho:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_trecho_label" id="hidden_field_label_aereo_trecho" style="<?php echo $sStyleHidden_aereo_trecho; ?>"><span id="id_label_aereo_trecho"><?php echo $this->nm_new_label['aereo_trecho']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_trecho_line" id="hidden_field_data_aereo_trecho" style="<?php echo $sStyleHidden_aereo_trecho; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_trecho_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_trecho" value="<?php echo $this->form_encode_input($aereo_trecho); ?>"><span id="id_ajax_label_aereo_trecho"><?php echo nl2br($aereo_trecho); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_trecho_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_trecho_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nome_pax_gate']))
    {
        $this->nm_new_label['nome_pax_gate'] = "Pax:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_nome_pax_gate_label" id="hidden_field_label_nome_pax_gate" style="<?php echo $sStyleHidden_nome_pax_gate; ?>"><span id="id_label_nome_pax_gate"><?php echo $this->nm_new_label['nome_pax_gate']; ?></span></TD>
    <TD class="scFormDataOdd css_nome_pax_gate_line" id="hidden_field_data_nome_pax_gate" style="<?php echo $sStyleHidden_nome_pax_gate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nome_pax_gate_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="nome_pax_gate" value="<?php echo $this->form_encode_input($nome_pax_gate); ?>"><span id="id_ajax_label_nome_pax_gate"><?php echo nl2br($nome_pax_gate); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_pax_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_pax_gate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_nota_gate_label" id="hidden_field_label_nota_gate" style="<?php echo $sStyleHidden_nota_gate; ?>"><span id="id_label_nota_gate"><?php echo $this->nm_new_label['nota_gate']; ?></span></TD>
    <TD class="scFormDataOdd css_nota_gate_line" id="hidden_field_data_nota_gate" style="<?php echo $sStyleHidden_nota_gate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nota_gate_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="nota_gate" value="<?php echo $this->form_encode_input($nota_gate); ?>"><span id="id_ajax_label_nota_gate"><?php echo nl2br($nota_gate); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nota_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nota_gate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_data_nota_gate_label" id="hidden_field_label_data_nota_gate" style="<?php echo $sStyleHidden_data_nota_gate; ?>"><span id="id_label_data_nota_gate"><?php echo $this->nm_new_label['data_nota_gate']; ?></span></TD>
    <TD class="scFormDataOdd css_data_nota_gate_line" id="hidden_field_data_data_nota_gate" style="<?php echo $sStyleHidden_data_nota_gate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_data_nota_gate_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="data_nota_gate" value="<?php echo $this->form_encode_input($data_nota_gate); ?>"><span id="id_ajax_label_data_nota_gate"><?php echo nl2br($data_nota_gate); ?></span>
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
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_data_nota_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_data_nota_gate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_valor_label" id="hidden_field_label_aereo_valor" style="<?php echo $sStyleHidden_aereo_valor; ?>"><span id="id_label_aereo_valor"><?php echo $this->nm_new_label['aereo_valor']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_valor_line" id="hidden_field_data_aereo_valor" style="<?php echo $sStyleHidden_aereo_valor; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_valor_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_valor" value="<?php echo $this->form_encode_input($aereo_valor); ?>"><span id="id_ajax_label_aereo_valor"><?php echo nl2br($aereo_valor); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_valor_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_valor_text"></span></td></tr></table></td></tr></table></TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_atendente_label" id="hidden_field_label_atendente" style="<?php echo $sStyleHidden_atendente; ?>"><span id="id_label_atendente"><?php echo $this->nm_new_label['atendente']; ?></span></TD>
    <TD class="scFormDataOdd css_atendente_line" id="hidden_field_data_atendente" style="<?php echo $sStyleHidden_atendente; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_atendente_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="atendente" value="<?php echo $this->form_encode_input($atendente); ?>"><span id="id_ajax_label_atendente"><?php echo nl2br($atendente); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_atendente_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_atendente_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_id_usuario_label" id="hidden_field_label_aereo_id_usuario" style="<?php echo $sStyleHidden_aereo_id_usuario; ?>"><span id="id_label_aereo_id_usuario"><?php echo $this->nm_new_label['aereo_id_usuario']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_id_usuario_line" id="hidden_field_data_aereo_id_usuario" style="<?php echo $sStyleHidden_aereo_id_usuario; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_id_usuario_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_id_usuario" value="<?php echo $this->form_encode_input($aereo_id_usuario); ?>"><span id="id_ajax_label_aereo_id_usuario"><?php echo nl2br($aereo_id_usuario); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_id_usuario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_id_usuario_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_ativo_label" id="hidden_field_label_aereo_ativo" style="<?php echo $sStyleHidden_aereo_ativo; ?>"><span id="id_label_aereo_ativo"><?php echo $this->nm_new_label['aereo_ativo']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_ativo_line" id="hidden_field_data_aereo_ativo" style="<?php echo $sStyleHidden_aereo_ativo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_ativo_line" style="vertical-align: top;padding: 0px">
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
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['Lookup_aereo_ativo'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->aereo_ativo == "N") { echo " selected" ;} ?>>Inativo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['Lookup_aereo_ativo'][] = 'N'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_ativo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_ativo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_cia_aerea']))
    {
        $this->nm_new_label['aereo_cia_aerea'] = "Cia. Aérea RSVP:";
    }
?>
<?php
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
<?php if (isset($this->nmgp_cmp_hidden['aereo_cia_aerea']) && $this->nmgp_cmp_hidden['aereo_cia_aerea'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_cia_aerea" value="<?php echo $this->form_encode_input($aereo_cia_aerea) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_cia_aerea_label" id="hidden_field_label_aereo_cia_aerea" style="<?php echo $sStyleHidden_aereo_cia_aerea; ?>"><span id="id_label_aereo_cia_aerea"><?php echo $this->nm_new_label['aereo_cia_aerea']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_cia_aerea_line" id="hidden_field_data_aereo_cia_aerea" style="<?php echo $sStyleHidden_aereo_cia_aerea; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_cia_aerea_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_cia_aerea" value="<?php echo $this->form_encode_input($aereo_cia_aerea); ?>"><span id="id_ajax_label_aereo_cia_aerea"><?php echo nl2br($aereo_cia_aerea); ?></span>
 <SPAN id="id_lookup_aereo_cia_aerea"><?php echo $look_rpc_aereo_cia_aerea; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_cia_aerea_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_cia_aerea_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_dthr_saida']))
    {
        $this->nm_new_label['aereo_dthr_saida'] = "Data/Hora Saída";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_dthr_saida_label" id="hidden_field_label_aereo_dthr_saida" style="<?php echo $sStyleHidden_aereo_dthr_saida; ?>"><span id="id_label_aereo_dthr_saida"><?php echo $this->nm_new_label['aereo_dthr_saida']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_dthr_saida_line" id="hidden_field_data_aereo_dthr_saida" style="<?php echo $sStyleHidden_aereo_dthr_saida; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_dthr_saida_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_dthr_saida" value="<?php echo $this->form_encode_input($aereo_dthr_saida); ?>"><span id="id_ajax_label_aereo_dthr_saida"><?php echo nl2br($aereo_dthr_saida); ?></span>
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_dthr_saida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_dthr_saida_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->aereo_dthr_saida = $old_dt_aereo_dthr_saida;
?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_dthr_chegada']))
    {
        $this->nm_new_label['aereo_dthr_chegada'] = "Data/Hora Chegada";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_dthr_chegada_label" id="hidden_field_label_aereo_dthr_chegada" style="<?php echo $sStyleHidden_aereo_dthr_chegada; ?>"><span id="id_label_aereo_dthr_chegada"><?php echo $this->nm_new_label['aereo_dthr_chegada']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_dthr_chegada_line" id="hidden_field_data_aereo_dthr_chegada" style="<?php echo $sStyleHidden_aereo_dthr_chegada; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_dthr_chegada_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_dthr_chegada" value="<?php echo $this->form_encode_input($aereo_dthr_chegada); ?>"><span id="id_ajax_label_aereo_dthr_chegada"><?php echo nl2br($aereo_dthr_chegada); ?></span>
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
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_dthr_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_dthr_chegada_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->aereo_dthr_chegada = $old_dt_aereo_dthr_chegada;
?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_origem_rsvp']))
    {
        $this->nm_new_label['aereo_origem_rsvp'] = "Origem RSVP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_origem_rsvp = $this->aereo_origem_rsvp;
   $sStyleHidden_aereo_origem_rsvp = '';
   if (isset($this->nmgp_cmp_hidden['aereo_origem_rsvp']) && $this->nmgp_cmp_hidden['aereo_origem_rsvp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_origem_rsvp']);
       $sStyleHidden_aereo_origem_rsvp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_origem_rsvp = 'display: none;';
   $sStyleReadInp_aereo_origem_rsvp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_origem_rsvp']) && $this->nmgp_cmp_readonly['aereo_origem_rsvp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_origem_rsvp']);
       $sStyleReadLab_aereo_origem_rsvp = '';
       $sStyleReadInp_aereo_origem_rsvp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_origem_rsvp']) && $this->nmgp_cmp_hidden['aereo_origem_rsvp'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_origem_rsvp" value="<?php echo $this->form_encode_input($aereo_origem_rsvp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_origem_rsvp_label" id="hidden_field_label_aereo_origem_rsvp" style="<?php echo $sStyleHidden_aereo_origem_rsvp; ?>"><span id="id_label_aereo_origem_rsvp"><?php echo $this->nm_new_label['aereo_origem_rsvp']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_origem_rsvp_line" id="hidden_field_data_aereo_origem_rsvp" style="<?php echo $sStyleHidden_aereo_origem_rsvp; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_origem_rsvp_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_origem_rsvp" value="<?php echo $this->form_encode_input($aereo_origem_rsvp); ?>"><span id="id_ajax_label_aereo_origem_rsvp"><?php echo nl2br($aereo_origem_rsvp); ?></span>
 <SPAN id="id_lookup_aereo_origem_rsvp"><?php echo $look_rpc_aereo_origem_rsvp; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_origem_rsvp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_origem_rsvp_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['aereo_destino_rsvp']))
    {
        $this->nm_new_label['aereo_destino_rsvp'] = "Destino RSVP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $aereo_destino_rsvp = $this->aereo_destino_rsvp;
   $sStyleHidden_aereo_destino_rsvp = '';
   if (isset($this->nmgp_cmp_hidden['aereo_destino_rsvp']) && $this->nmgp_cmp_hidden['aereo_destino_rsvp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['aereo_destino_rsvp']);
       $sStyleHidden_aereo_destino_rsvp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_aereo_destino_rsvp = 'display: none;';
   $sStyleReadInp_aereo_destino_rsvp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['aereo_destino_rsvp']) && $this->nmgp_cmp_readonly['aereo_destino_rsvp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['aereo_destino_rsvp']);
       $sStyleReadLab_aereo_destino_rsvp = '';
       $sStyleReadInp_aereo_destino_rsvp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['aereo_destino_rsvp']) && $this->nmgp_cmp_hidden['aereo_destino_rsvp'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="aereo_destino_rsvp" value="<?php echo $this->form_encode_input($aereo_destino_rsvp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_aereo_destino_rsvp_label" id="hidden_field_label_aereo_destino_rsvp" style="<?php echo $sStyleHidden_aereo_destino_rsvp; ?>"><span id="id_label_aereo_destino_rsvp"><?php echo $this->nm_new_label['aereo_destino_rsvp']; ?></span></TD>
    <TD class="scFormDataOdd css_aereo_destino_rsvp_line" id="hidden_field_data_aereo_destino_rsvp" style="<?php echo $sStyleHidden_aereo_destino_rsvp; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_aereo_destino_rsvp_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="aereo_destino_rsvp" value="<?php echo $this->form_encode_input($aereo_destino_rsvp); ?>"><span id="id_ajax_label_aereo_destino_rsvp"><?php echo nl2br($aereo_destino_rsvp); ?></span>
 <SPAN id="id_lookup_aereo_destino_rsvp"><?php echo $look_rpc_aereo_destino_rsvp; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_aereo_destino_rsvp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_aereo_destino_rsvp_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fil_agt_gate']))
    {
        $this->nm_new_label['fil_agt_gate'] = "Fil agt Gate:";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_fil_agt_gate_label" id="hidden_field_label_fil_agt_gate" style="<?php echo $sStyleHidden_fil_agt_gate; ?>"><span id="id_label_fil_agt_gate"><?php echo $this->nm_new_label['fil_agt_gate']; ?></span></TD>
    <TD class="scFormDataOdd css_fil_agt_gate_line" id="hidden_field_data_fil_agt_gate" style="<?php echo $sStyleHidden_fil_agt_gate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fil_agt_gate_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="fil_agt_gate" value="<?php echo $this->form_encode_input($fil_agt_gate); ?>"><span id="id_ajax_label_fil_agt_gate"><?php echo nl2br($fil_agt_gate); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fil_agt_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fil_agt_gate_text"></span></td></tr></table></td></tr></table></TD>
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
    <TD class="scFormDataOdd css_cpf_del_line" id="hidden_field_data_cpf_del" style="<?php echo $sStyleHidden_cpf_del; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cpf_del_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cpf_del"]) &&  $this->nmgp_cmp_readonly["cpf_del"] == "on") { 

 ?>
<input type="hidden" name="cpf_del" value="<?php echo $this->form_encode_input($cpf_del) . "\">" . $cpf_del . ""; ?>
<?php } else { ?>
<span id="id_read_on_cpf_del" class="sc-ui-readonly-cpf_del css_cpf_del_line" style="<?php echo $sStyleReadLab_cpf_del; ?>"><?php echo $this->form_format_readonly("cpf_del", $this->form_encode_input($this->cpf_del)); ?></span><span id="id_read_off_cpf_del" class="css_read_off_cpf_del<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cpf_del; ?>">
 <input class="sc-js-input scFormObjectOdd css_cpf_del_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cpf_del" type=text name="cpf_del" value="<?php echo $this->form_encode_input($cpf_del) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
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
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['birpara'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['first'];
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
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['back'];
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
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['forward'];
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
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
  $nm_sc_blocos_da_pag = array(0,1);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0);
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_aereos_rsvp_gate");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_aereos_rsvp_gate");
 parent.scAjaxDetailHeight("form_aereos_rsvp_gate", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_aereos_rsvp_gate", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_aereos_rsvp_gate", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['sc_modal'])
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_aereos_rsvp_gate']['inside_nested_iframe']) {
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
