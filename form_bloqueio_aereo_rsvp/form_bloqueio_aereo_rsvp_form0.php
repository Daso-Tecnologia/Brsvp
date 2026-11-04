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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("BRSVP - Cadastro de Bloqueio Aéreo - Inclusão"); } else { echo strip_tags("BRSVP - Cadastro de Bloqueio Aéreo - Alteração"); } ?></TITLE>
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
.css_read_off_bloq_dt_saida button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_bloq_dt_chegada button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_bloqueio_aereo_rsvp/form_bloqueio_aereo_rsvp_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_bloqueio_aereo_rsvp_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_bloqueio_aereo_rsvp_jquery.php');

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
  scFocusField('bloq_descricao');

<?php
}
?>
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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['recarga'];
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['link_info']['remove_border']) {
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
 include_once("form_bloqueio_aereo_rsvp_js0.php");
?>
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_bloqueio_aereo_rsvp'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_bloqueio_aereo_rsvp'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  $this->Tab_width = "  width=\"50%\"";
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['fast_search'][2] : "";
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
          $SC_Label_atu['bloqueio_id'] = (isset($this->nm_new_label['bloqueio_id'])) ? $this->nm_new_label['bloqueio_id'] : 'Cód. Bloqueio:'; 
          $SC_Label_atu['bloq_evento_id'] = (isset($this->nm_new_label['bloq_evento_id'])) ? $this->nm_new_label['bloq_evento_id'] : 'Evento:'; 
          $SC_Label_atu['bloq_descricao'] = (isset($this->nm_new_label['bloq_descricao'])) ? $this->nm_new_label['bloq_descricao'] : 'Descrição:'; 
          $SC_Label_atu['bloq_direcao'] = (isset($this->nm_new_label['bloq_direcao'])) ? $this->nm_new_label['bloq_direcao'] : 'Direção:'; 
          $SC_Label_atu['bloq_cia_aerea'] = (isset($this->nm_new_label['bloq_cia_aerea'])) ? $this->nm_new_label['bloq_cia_aerea'] : 'Cia. Aérea:'; 
          $SC_Label_atu['bloq_origem'] = (isset($this->nm_new_label['bloq_origem'])) ? $this->nm_new_label['bloq_origem'] : 'Origem:'; 
          $SC_Label_atu['bloq_destino'] = (isset($this->nm_new_label['bloq_destino'])) ? $this->nm_new_label['bloq_destino'] : 'Destino:'; 
          $SC_Label_atu['bloq_dt_saida'] = (isset($this->nm_new_label['bloq_dt_saida'])) ? $this->nm_new_label['bloq_dt_saida'] : 'Data Sáida:'; 
          $SC_Label_atu['bloq_hr_saida'] = (isset($this->nm_new_label['bloq_hr_saida'])) ? $this->nm_new_label['bloq_hr_saida'] : 'Hora Saída:'; 
          $SC_Label_atu['bloq_dt_chegada'] = (isset($this->nm_new_label['bloq_dt_chegada'])) ? $this->nm_new_label['bloq_dt_chegada'] : 'Data Chegada:'; 
          $SC_Label_atu['bloq_hr_chegada'] = (isset($this->nm_new_label['bloq_hr_chegada'])) ? $this->nm_new_label['bloq_hr_chegada'] : 'Hora Chegada:'; 
          $SC_Label_atu['bloq_num_voo'] = (isset($this->nm_new_label['bloq_num_voo'])) ? $this->nm_new_label['bloq_num_voo'] : 'Número Voo:'; 
          $SC_Label_atu['bloq_num_pass_etkt'] = (isset($this->nm_new_label['bloq_num_pass_etkt'])) ? $this->nm_new_label['bloq_num_pass_etkt'] : 'Num. Passagem (ETKT):'; 
          $SC_Label_atu['bloq_localizador'] = (isset($this->nm_new_label['bloq_localizador'])) ? $this->nm_new_label['bloq_localizador'] : ' Localizador:'; 
          $SC_Label_atu['bloq_qtd_lugares'] = (isset($this->nm_new_label['bloq_qtd_lugares'])) ? $this->nm_new_label['bloq_qtd_lugares'] : 'Qtd. Lugares'; 
          $SC_Label_atu['bloq_saldo_lugares'] = (isset($this->nm_new_label['bloq_saldo_lugares'])) ? $this->nm_new_label['bloq_saldo_lugares'] : 'Lugares Restantes:'; 
          $SC_Label_atu['bloq_nota_gate'] = (isset($this->nm_new_label['bloq_nota_gate'])) ? $this->nm_new_label['bloq_nota_gate'] : 'Núm. Nota Gate:'; 
          $SC_Label_atu['bloq_dt_nota_gate'] = (isset($this->nm_new_label['bloq_dt_nota_gate'])) ? $this->nm_new_label['bloq_dt_nota_gate'] : 'Data Nota Gate:'; 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['delete'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bexcluir", "scBtnFn_sys_format_exc()", "scBtnFn_sys_format_exc()", "sc_b_del_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['LOG'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['log'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['log'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
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
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['bloqueio_id']))
           {
               $this->nmgp_cmp_readonly['bloqueio_id'] = 'on';
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
<li id="id_tabs_0_0" class="scTabActive" style="background-color: #99FFFF"><a href="javascript: sc_control_tabs_0(0)">Origem / Destino</a></li>
<li id="id_tabs_0_1" class="scTabInactive" style="background-color: #99FFFF"><a href="javascript: sc_control_tabs_0(1)">Qtd. Lugares / GATE</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloqueio_id']))
    {
        $this->nm_new_label['bloqueio_id'] = "Cód. Bloqueio:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloqueio_id = $this->bloqueio_id;
   $sStyleHidden_bloqueio_id = '';
   if (isset($this->nmgp_cmp_hidden['bloqueio_id']) && $this->nmgp_cmp_hidden['bloqueio_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloqueio_id']);
       $sStyleHidden_bloqueio_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloqueio_id = 'display: none;';
   $sStyleReadInp_bloqueio_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["bloqueio_id"]) &&  $this->nmgp_cmp_readonly["bloqueio_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloqueio_id']);
       $sStyleReadLab_bloqueio_id = '';
       $sStyleReadInp_bloqueio_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloqueio_id']) && $this->nmgp_cmp_hidden['bloqueio_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloqueio_id" value="<?php echo $this->form_encode_input($bloqueio_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloqueio_id_label" id="hidden_field_label_bloqueio_id" style="<?php echo $sStyleHidden_bloqueio_id; ?>"><span id="id_label_bloqueio_id"><?php echo $this->nm_new_label['bloqueio_id']; ?></span></TD>
    <TD class="scFormDataOdd css_bloqueio_id_line" id="hidden_field_data_bloqueio_id" style="<?php echo $sStyleHidden_bloqueio_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloqueio_id_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_bloqueio_id" class="css_bloqueio_id_line" style="<?php echo $sStyleReadLab_bloqueio_id; ?>"><?php echo $this->form_format_readonly("bloqueio_id", $this->form_encode_input($this->bloqueio_id)); ?></span><span id="id_read_off_bloqueio_id" class="css_read_off_bloqueio_id" style="<?php echo $sStyleReadInp_bloqueio_id; ?>"><input type="hidden" name="bloqueio_id" value="<?php echo $this->form_encode_input($bloqueio_id) . "\">"?><span id="id_ajax_label_bloqueio_id"><?php echo nl2br($bloqueio_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloqueio_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloqueio_id_text"></span></td></tr></table></td></tr></table></TD>
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
   if (!isset($this->nm_new_label['bloq_evento_id']))
   {
       $this->nm_new_label['bloq_evento_id'] = "Evento:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_evento_id = $this->bloq_evento_id;
   $sStyleHidden_bloq_evento_id = '';
   if (isset($this->nmgp_cmp_hidden['bloq_evento_id']) && $this->nmgp_cmp_hidden['bloq_evento_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_evento_id']);
       $sStyleHidden_bloq_evento_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_evento_id = 'display: none;';
   $sStyleReadInp_bloq_evento_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_evento_id']) && $this->nmgp_cmp_readonly['bloq_evento_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_evento_id']);
       $sStyleReadLab_bloq_evento_id = '';
       $sStyleReadInp_bloq_evento_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_evento_id']) && $this->nmgp_cmp_hidden['bloq_evento_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="bloq_evento_id" value="<?php echo $this->form_encode_input($this->bloq_evento_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_evento_id_label" id="hidden_field_label_bloq_evento_id" style="<?php echo $sStyleHidden_bloq_evento_id; ?>"><span id="id_label_bloq_evento_id"><?php echo $this->nm_new_label['bloq_evento_id']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_evento_id']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_evento_id'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_evento_id_line" id="hidden_field_data_bloq_evento_id" style="<?php echo $sStyleHidden_bloq_evento_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_evento_id_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_evento_id"]) &&  $this->nmgp_cmp_readonly["bloq_evento_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'] = array(); 
    }

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT evento_id, evento_nome + ' - Cod.: ' + evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT evento_id, concat(evento_nome,' - Cod.: ',evento_id)  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT evento_id, evento_nome&' - Cod.: '&evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT evento_id, evento_nome||' - Cod.: '||evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT evento_id, evento_nome + ' - Cod.: ' + convert(char,evento_id)  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT evento_id, evento_nome||' - Cod.: '||char(evento_id)  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }
   else
   {
       $nm_comando = "SELECT evento_id, evento_nome||' - Cod.: '||evento_id  FROM eventos_rsvp WHERE evento_id = " . $_SESSION['vg_evento_id'] . " ORDER BY evento_nome, evento_id";
   }

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_evento_id'][] = $rs->fields[0];
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
   $bloq_evento_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->bloq_evento_id_1))
          {
              foreach ($this->bloq_evento_id_1 as $tmp_bloq_evento_id)
              {
                  if (trim($tmp_bloq_evento_id) === trim($cadaselect[1])) {$bloq_evento_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->bloq_evento_id) && trim($this->bloq_evento_id) === trim($cadaselect[1])) {$bloq_evento_id_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="bloq_evento_id" value="<?php echo $this->form_encode_input($bloq_evento_id) . "\">" . $bloq_evento_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_bloq_evento_id();
   $x = 0 ; 
   $bloq_evento_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->bloq_evento_id_1))
          {
              foreach ($this->bloq_evento_id_1 as $tmp_bloq_evento_id)
              {
                  if (trim($tmp_bloq_evento_id) === trim($cadaselect[1])) {$bloq_evento_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->bloq_evento_id)) {
                 if (trim($this->bloq_evento_id) == trim($cadaselect[1])) { $bloq_evento_id_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->bloq_evento_id == $cadaselect[1]) { $bloq_evento_id_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($bloq_evento_id_look))
          {
              $bloq_evento_id_look = $this->bloq_evento_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_bloq_evento_id\" class=\"css_bloq_evento_id_line\" style=\"" .  $sStyleReadLab_bloq_evento_id . "\">" . $this->form_format_readonly("bloq_evento_id", $this->form_encode_input($bloq_evento_id_look)) . "</span><span id=\"id_read_off_bloq_evento_id\" class=\"css_read_off_bloq_evento_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_bloq_evento_id . "\">";
   echo " <span id=\"idAjaxSelect_bloq_evento_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_bloq_evento_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_bloq_evento_id\" name=\"bloq_evento_id\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->bloq_evento_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->bloq_evento_id)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_evento_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_evento_id_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_descricao']))
    {
        $this->nm_new_label['bloq_descricao'] = "Descrição:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_descricao = $this->bloq_descricao;
   $sStyleHidden_bloq_descricao = '';
   if (isset($this->nmgp_cmp_hidden['bloq_descricao']) && $this->nmgp_cmp_hidden['bloq_descricao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_descricao']);
       $sStyleHidden_bloq_descricao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_descricao = 'display: none;';
   $sStyleReadInp_bloq_descricao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_descricao']) && $this->nmgp_cmp_readonly['bloq_descricao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_descricao']);
       $sStyleReadLab_bloq_descricao = '';
       $sStyleReadInp_bloq_descricao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_descricao']) && $this->nmgp_cmp_hidden['bloq_descricao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_descricao" value="<?php echo $this->form_encode_input($bloq_descricao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_descricao_label" id="hidden_field_label_bloq_descricao" style="<?php echo $sStyleHidden_bloq_descricao; ?>"><span id="id_label_bloq_descricao"><?php echo $this->nm_new_label['bloq_descricao']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_descricao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_descricao'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_descricao_line" id="hidden_field_data_bloq_descricao" style="<?php echo $sStyleHidden_bloq_descricao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_descricao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_descricao"]) &&  $this->nmgp_cmp_readonly["bloq_descricao"] == "on") { 

 ?>
<input type="hidden" name="bloq_descricao" value="<?php echo $this->form_encode_input($bloq_descricao) . "\">" . $bloq_descricao . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_descricao" class="sc-ui-readonly-bloq_descricao css_bloq_descricao_line" style="<?php echo $sStyleReadLab_bloq_descricao; ?>"><?php echo $this->form_format_readonly("bloq_descricao", $this->form_encode_input($this->bloq_descricao)); ?></span><span id="id_read_off_bloq_descricao" class="css_read_off_bloq_descricao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_descricao; ?>">
 <input class="sc-js-input scFormObjectOdd css_bloq_descricao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_descricao" type=text name="bloq_descricao" value="<?php echo $this->form_encode_input($bloq_descricao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=80"; } ?> maxlength=80 alt="{datatype: 'text', maxLength: 80, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_descricao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_descricao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_direcao']))
    {
        $this->nm_new_label['bloq_direcao'] = "Direção:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_direcao = $this->bloq_direcao;
   $sStyleHidden_bloq_direcao = '';
   if (isset($this->nmgp_cmp_hidden['bloq_direcao']) && $this->nmgp_cmp_hidden['bloq_direcao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_direcao']);
       $sStyleHidden_bloq_direcao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_direcao = 'display: none;';
   $sStyleReadInp_bloq_direcao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_direcao']) && $this->nmgp_cmp_readonly['bloq_direcao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_direcao']);
       $sStyleReadLab_bloq_direcao = '';
       $sStyleReadInp_bloq_direcao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_direcao']) && $this->nmgp_cmp_hidden['bloq_direcao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_direcao" value="<?php echo $this->form_encode_input($bloq_direcao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_direcao_label" id="hidden_field_label_bloq_direcao" style="<?php echo $sStyleHidden_bloq_direcao; ?>"><span id="id_label_bloq_direcao"><?php echo $this->nm_new_label['bloq_direcao']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_direcao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_direcao'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_direcao_line" id="hidden_field_data_bloq_direcao" style="<?php echo $sStyleHidden_bloq_direcao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_direcao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_direcao"]) &&  $this->nmgp_cmp_readonly["bloq_direcao"] == "on") { 

 if ("IDA" == $this->bloq_direcao) { $bloq_direcao_look = "Ida";} 
 if ("VOLTA" == $this->bloq_direcao) { $bloq_direcao_look = "Volta";} 
?>
<input type="hidden" name="bloq_direcao" value="<?php echo $this->form_encode_input($bloq_direcao) . "\">" . $bloq_direcao_look . ""; ?>
<?php } else { ?>

<?php

 if ("IDA" == $this->bloq_direcao) { $bloq_direcao_look = "Ida";} 
 if ("VOLTA" == $this->bloq_direcao) { $bloq_direcao_look = "Volta";} 
?>
<span id="id_read_on_bloq_direcao"  class="css_bloq_direcao_line" style="<?php echo $sStyleReadLab_bloq_direcao; ?>"><?php echo $this->form_format_readonly("bloq_direcao", $this->form_encode_input($bloq_direcao_look)); ?></span><span id="id_read_off_bloq_direcao" class="css_read_off_bloq_direcao css_bloq_direcao_line" style="<?php echo $sStyleReadInp_bloq_direcao; ?>"><div id="idAjaxRadio_bloq_direcao" style="display: inline-block"  class="css_bloq_direcao_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_bloq_direcao_line"><?php $tempOptionId = "id-opt-bloq_direcao" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-bloq_direcao sc-ui-radio-bloq_direcao sc-js-input" type=radio name="bloq_direcao" value="IDA"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_direcao'][] = 'IDA'; ?>
<?php  if ("IDA" == $this->bloq_direcao)  { echo " checked" ;} ?><?php  if (empty($this->bloq_direcao)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Ida</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_bloq_direcao_line"><?php $tempOptionId = "id-opt-bloq_direcao" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-bloq_direcao sc-ui-radio-bloq_direcao sc-js-input" type=radio name="bloq_direcao" value="VOLTA"
 alt="{type: 'radio', enterTab: true}"<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_direcao'][] = 'VOLTA'; ?>
<?php  if ("VOLTA" == $this->bloq_direcao)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Volta</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_direcao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_direcao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['bloq_cia_aerea']))
   {
       $this->nm_new_label['bloq_cia_aerea'] = "Cia. Aérea:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_cia_aerea = $this->bloq_cia_aerea;
   $sStyleHidden_bloq_cia_aerea = '';
   if (isset($this->nmgp_cmp_hidden['bloq_cia_aerea']) && $this->nmgp_cmp_hidden['bloq_cia_aerea'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_cia_aerea']);
       $sStyleHidden_bloq_cia_aerea = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_cia_aerea = 'display: none;';
   $sStyleReadInp_bloq_cia_aerea = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_cia_aerea']) && $this->nmgp_cmp_readonly['bloq_cia_aerea'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_cia_aerea']);
       $sStyleReadLab_bloq_cia_aerea = '';
       $sStyleReadInp_bloq_cia_aerea = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_cia_aerea']) && $this->nmgp_cmp_hidden['bloq_cia_aerea'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="bloq_cia_aerea" value="<?php echo $this->form_encode_input($this->bloq_cia_aerea) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_cia_aerea_label" id="hidden_field_label_bloq_cia_aerea" style="<?php echo $sStyleHidden_bloq_cia_aerea; ?>"><span id="id_label_bloq_cia_aerea"><?php echo $this->nm_new_label['bloq_cia_aerea']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_cia_aerea']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_cia_aerea'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_cia_aerea_line" id="hidden_field_data_bloq_cia_aerea" style="<?php echo $sStyleHidden_bloq_cia_aerea; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_cia_aerea_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_cia_aerea"]) &&  $this->nmgp_cmp_readonly["bloq_cia_aerea"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'] = array(); 
    }

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

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

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'][] = $rs->fields[0];
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
   $bloq_cia_aerea_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->bloq_cia_aerea_1))
          {
              foreach ($this->bloq_cia_aerea_1 as $tmp_bloq_cia_aerea)
              {
                  if (trim($tmp_bloq_cia_aerea) === trim($cadaselect[1])) {$bloq_cia_aerea_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->bloq_cia_aerea) && trim($this->bloq_cia_aerea) === trim($cadaselect[1])) {$bloq_cia_aerea_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="bloq_cia_aerea" value="<?php echo $this->form_encode_input($bloq_cia_aerea) . "\">" . $bloq_cia_aerea_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_bloq_cia_aerea();
   $x = 0 ; 
   $bloq_cia_aerea_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->bloq_cia_aerea_1))
          {
              foreach ($this->bloq_cia_aerea_1 as $tmp_bloq_cia_aerea)
              {
                  if (trim($tmp_bloq_cia_aerea) === trim($cadaselect[1])) {$bloq_cia_aerea_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->bloq_cia_aerea)) {
                 if (trim($this->bloq_cia_aerea) == trim($cadaselect[1])) { $bloq_cia_aerea_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->bloq_cia_aerea == $cadaselect[1]) { $bloq_cia_aerea_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($bloq_cia_aerea_look))
          {
              $bloq_cia_aerea_look = $this->bloq_cia_aerea;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_bloq_cia_aerea\" class=\"css_bloq_cia_aerea_line\" style=\"" .  $sStyleReadLab_bloq_cia_aerea . "\">" . $this->form_format_readonly("bloq_cia_aerea", $this->form_encode_input($bloq_cia_aerea_look)) . "</span><span id=\"id_read_off_bloq_cia_aerea\" class=\"css_read_off_bloq_cia_aerea" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_bloq_cia_aerea . "\">";
   echo " <span id=\"idAjaxSelect_bloq_cia_aerea\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_bloq_cia_aerea_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_bloq_cia_aerea\" name=\"bloq_cia_aerea\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_cia_aerea'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->bloq_cia_aerea) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->bloq_cia_aerea)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_cia_aerea_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_cia_aerea_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['bloq_origem']))
   {
       $this->nm_new_label['bloq_origem'] = "Origem:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_origem = $this->bloq_origem;
   $sStyleHidden_bloq_origem = '';
   if (isset($this->nmgp_cmp_hidden['bloq_origem']) && $this->nmgp_cmp_hidden['bloq_origem'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_origem']);
       $sStyleHidden_bloq_origem = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_origem = 'display: none;';
   $sStyleReadInp_bloq_origem = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_origem']) && $this->nmgp_cmp_readonly['bloq_origem'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_origem']);
       $sStyleReadLab_bloq_origem = '';
       $sStyleReadInp_bloq_origem = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_origem']) && $this->nmgp_cmp_hidden['bloq_origem'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="bloq_origem" value="<?php echo $this->form_encode_input($this->bloq_origem) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_origem_label" id="hidden_field_label_bloq_origem" style="<?php echo $sStyleHidden_bloq_origem; ?>"><span id="id_label_bloq_origem"><?php echo $this->nm_new_label['bloq_origem']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_origem']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_origem'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_origem_line" id="hidden_field_data_bloq_origem" style="<?php echo $sStyleHidden_bloq_origem; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_origem_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_origem"]) &&  $this->nmgp_cmp_readonly["bloq_origem"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'] = array(); 
    }

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

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

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'][] = $rs->fields[0];
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
   $bloq_origem_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->bloq_origem_1))
          {
              foreach ($this->bloq_origem_1 as $tmp_bloq_origem)
              {
                  if (trim($tmp_bloq_origem) === trim($cadaselect[1])) {$bloq_origem_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->bloq_origem) && trim($this->bloq_origem) === trim($cadaselect[1])) {$bloq_origem_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="bloq_origem" value="<?php echo $this->form_encode_input($bloq_origem) . "\">" . $bloq_origem_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_bloq_origem();
   $x = 0 ; 
   $bloq_origem_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->bloq_origem_1))
          {
              foreach ($this->bloq_origem_1 as $tmp_bloq_origem)
              {
                  if (trim($tmp_bloq_origem) === trim($cadaselect[1])) {$bloq_origem_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->bloq_origem)) {
                 if (trim($this->bloq_origem) == trim($cadaselect[1])) { $bloq_origem_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->bloq_origem == $cadaselect[1]) { $bloq_origem_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($bloq_origem_look))
          {
              $bloq_origem_look = $this->bloq_origem;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_bloq_origem\" class=\"css_bloq_origem_line\" style=\"" .  $sStyleReadLab_bloq_origem . "\">" . $this->form_format_readonly("bloq_origem", $this->form_encode_input($bloq_origem_look)) . "</span><span id=\"id_read_off_bloq_origem\" class=\"css_read_off_bloq_origem" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_bloq_origem . "\">";
   echo " <span id=\"idAjaxSelect_bloq_origem\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_bloq_origem_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_bloq_origem\" name=\"bloq_origem\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_origem'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->bloq_origem) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->bloq_origem)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_origem_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_origem_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['bloq_destino']))
   {
       $this->nm_new_label['bloq_destino'] = "Destino:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_destino = $this->bloq_destino;
   $sStyleHidden_bloq_destino = '';
   if (isset($this->nmgp_cmp_hidden['bloq_destino']) && $this->nmgp_cmp_hidden['bloq_destino'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_destino']);
       $sStyleHidden_bloq_destino = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_destino = 'display: none;';
   $sStyleReadInp_bloq_destino = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_destino']) && $this->nmgp_cmp_readonly['bloq_destino'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_destino']);
       $sStyleReadLab_bloq_destino = '';
       $sStyleReadInp_bloq_destino = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_destino']) && $this->nmgp_cmp_hidden['bloq_destino'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="bloq_destino" value="<?php echo $this->form_encode_input($this->bloq_destino) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_destino_label" id="hidden_field_label_bloq_destino" style="<?php echo $sStyleHidden_bloq_destino; ?>"><span id="id_label_bloq_destino"><?php echo $this->nm_new_label['bloq_destino']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_destino']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_destino'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_destino_line" id="hidden_field_data_bloq_destino" style="<?php echo $sStyleHidden_bloq_destino; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_destino_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_destino"]) &&  $this->nmgp_cmp_readonly["bloq_destino"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'] = array(); 
    }

   $old_value_bloqueio_id = $this->bloqueio_id;
   $old_value_bloq_dt_saida = $this->bloq_dt_saida;
   $old_value_bloq_hr_saida = $this->bloq_hr_saida;
   $old_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $old_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $old_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $old_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $old_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_bloqueio_id = $this->bloqueio_id;
   $unformatted_value_bloq_dt_saida = $this->bloq_dt_saida;
   $unformatted_value_bloq_hr_saida = $this->bloq_hr_saida;
   $unformatted_value_bloq_dt_chegada = $this->bloq_dt_chegada;
   $unformatted_value_bloq_hr_chegada = $this->bloq_hr_chegada;
   $unformatted_value_bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $unformatted_value_bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $unformatted_value_bloq_dt_nota_gate = $this->bloq_dt_nota_gate;

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

   $this->bloqueio_id = $old_value_bloqueio_id;
   $this->bloq_dt_saida = $old_value_bloq_dt_saida;
   $this->bloq_hr_saida = $old_value_bloq_hr_saida;
   $this->bloq_dt_chegada = $old_value_bloq_dt_chegada;
   $this->bloq_hr_chegada = $old_value_bloq_hr_chegada;
   $this->bloq_qtd_lugares = $old_value_bloq_qtd_lugares;
   $this->bloq_saldo_lugares = $old_value_bloq_saldo_lugares;
   $this->bloq_dt_nota_gate = $old_value_bloq_dt_nota_gate;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'][] = $rs->fields[0];
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
   $bloq_destino_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->bloq_destino_1))
          {
              foreach ($this->bloq_destino_1 as $tmp_bloq_destino)
              {
                  if (trim($tmp_bloq_destino) === trim($cadaselect[1])) {$bloq_destino_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->bloq_destino) && trim($this->bloq_destino) === trim($cadaselect[1])) {$bloq_destino_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="bloq_destino" value="<?php echo $this->form_encode_input($bloq_destino) . "\">" . $bloq_destino_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_bloq_destino();
   $x = 0 ; 
   $bloq_destino_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->bloq_destino_1))
          {
              foreach ($this->bloq_destino_1 as $tmp_bloq_destino)
              {
                  if (trim($tmp_bloq_destino) === trim($cadaselect[1])) {$bloq_destino_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->bloq_destino)) {
                 if (trim($this->bloq_destino) == trim($cadaselect[1])) { $bloq_destino_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->bloq_destino == $cadaselect[1]) { $bloq_destino_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($bloq_destino_look))
          {
              $bloq_destino_look = $this->bloq_destino;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_bloq_destino\" class=\"css_bloq_destino_line\" style=\"" .  $sStyleReadLab_bloq_destino . "\">" . $this->form_format_readonly("bloq_destino", $this->form_encode_input($bloq_destino_look)) . "</span><span id=\"id_read_off_bloq_destino\" class=\"css_read_off_bloq_destino" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_bloq_destino . "\">";
   echo " <span id=\"idAjaxSelect_bloq_destino\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_bloq_destino_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_bloq_destino\" name=\"bloq_destino\" size=\"1\" alt=\"{type: 'select', enterTab: true}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['Lookup_bloq_destino'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->bloq_destino) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->bloq_destino)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_destino_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_destino_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_dt_saida']))
    {
        $this->nm_new_label['bloq_dt_saida'] = "Data Sáida:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_dt_saida = $this->bloq_dt_saida;
   $sStyleHidden_bloq_dt_saida = '';
   if (isset($this->nmgp_cmp_hidden['bloq_dt_saida']) && $this->nmgp_cmp_hidden['bloq_dt_saida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_dt_saida']);
       $sStyleHidden_bloq_dt_saida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_dt_saida = 'display: none;';
   $sStyleReadInp_bloq_dt_saida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_dt_saida']) && $this->nmgp_cmp_readonly['bloq_dt_saida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_dt_saida']);
       $sStyleReadLab_bloq_dt_saida = '';
       $sStyleReadInp_bloq_dt_saida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_dt_saida']) && $this->nmgp_cmp_hidden['bloq_dt_saida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_dt_saida" value="<?php echo $this->form_encode_input($bloq_dt_saida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_dt_saida_label" id="hidden_field_label_bloq_dt_saida" style="<?php echo $sStyleHidden_bloq_dt_saida; ?>"><span id="id_label_bloq_dt_saida"><?php echo $this->nm_new_label['bloq_dt_saida']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_dt_saida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_dt_saida'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_dt_saida_line" id="hidden_field_data_bloq_dt_saida" style="<?php echo $sStyleHidden_bloq_dt_saida; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_dt_saida_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_dt_saida"]) &&  $this->nmgp_cmp_readonly["bloq_dt_saida"] == "on") { 

 ?>
<input type="hidden" name="bloq_dt_saida" value="<?php echo $this->form_encode_input($bloq_dt_saida) . "\">" . $bloq_dt_saida . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_dt_saida" class="sc-ui-readonly-bloq_dt_saida css_bloq_dt_saida_line" style="<?php echo $sStyleReadLab_bloq_dt_saida; ?>"><?php echo $this->form_format_readonly("bloq_dt_saida", $this->form_encode_input($bloq_dt_saida)); ?></span><span id="id_read_off_bloq_dt_saida" class="css_read_off_bloq_dt_saida<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_dt_saida; ?>"><?php
$tmp_form_data = $this->field_config['bloq_dt_saida']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_bloq_dt_saida_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_dt_saida" type=text name="bloq_dt_saida" value="<?php echo $this->form_encode_input($bloq_dt_saida) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['bloq_dt_saida']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['bloq_dt_saida']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_dt_saida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_dt_saida_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_hr_saida']))
    {
        $this->nm_new_label['bloq_hr_saida'] = "Hora Saída:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_hr_saida = $this->bloq_hr_saida;
   $sStyleHidden_bloq_hr_saida = '';
   if (isset($this->nmgp_cmp_hidden['bloq_hr_saida']) && $this->nmgp_cmp_hidden['bloq_hr_saida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_hr_saida']);
       $sStyleHidden_bloq_hr_saida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_hr_saida = 'display: none;';
   $sStyleReadInp_bloq_hr_saida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_hr_saida']) && $this->nmgp_cmp_readonly['bloq_hr_saida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_hr_saida']);
       $sStyleReadLab_bloq_hr_saida = '';
       $sStyleReadInp_bloq_hr_saida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_hr_saida']) && $this->nmgp_cmp_hidden['bloq_hr_saida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_hr_saida" value="<?php echo $this->form_encode_input($bloq_hr_saida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_hr_saida_label" id="hidden_field_label_bloq_hr_saida" style="<?php echo $sStyleHidden_bloq_hr_saida; ?>"><span id="id_label_bloq_hr_saida"><?php echo $this->nm_new_label['bloq_hr_saida']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_hr_saida']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_hr_saida'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_hr_saida_line" id="hidden_field_data_bloq_hr_saida" style="<?php echo $sStyleHidden_bloq_hr_saida; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_hr_saida_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_hr_saida"]) &&  $this->nmgp_cmp_readonly["bloq_hr_saida"] == "on") { 

 ?>
<input type="hidden" name="bloq_hr_saida" value="<?php echo $this->form_encode_input($bloq_hr_saida) . "\">" . $bloq_hr_saida . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_hr_saida" class="sc-ui-readonly-bloq_hr_saida css_bloq_hr_saida_line" style="<?php echo $sStyleReadLab_bloq_hr_saida; ?>"><?php echo $this->form_format_readonly("bloq_hr_saida", $this->form_encode_input($bloq_hr_saida)); ?></span><span id="id_read_off_bloq_hr_saida" class="css_read_off_bloq_hr_saida<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_hr_saida; ?>"><?php
$tmp_form_data = $this->field_config['bloq_hr_saida']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_bloq_hr_saida_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_hr_saida" type=text name="bloq_hr_saida" value="<?php echo $this->form_encode_input($bloq_hr_saida) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['bloq_hr_saida']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['bloq_hr_saida']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_hr_saida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_hr_saida_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_dt_chegada']))
    {
        $this->nm_new_label['bloq_dt_chegada'] = "Data Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_dt_chegada = $this->bloq_dt_chegada;
   $sStyleHidden_bloq_dt_chegada = '';
   if (isset($this->nmgp_cmp_hidden['bloq_dt_chegada']) && $this->nmgp_cmp_hidden['bloq_dt_chegada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_dt_chegada']);
       $sStyleHidden_bloq_dt_chegada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_dt_chegada = 'display: none;';
   $sStyleReadInp_bloq_dt_chegada = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_dt_chegada']) && $this->nmgp_cmp_readonly['bloq_dt_chegada'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_dt_chegada']);
       $sStyleReadLab_bloq_dt_chegada = '';
       $sStyleReadInp_bloq_dt_chegada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_dt_chegada']) && $this->nmgp_cmp_hidden['bloq_dt_chegada'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_dt_chegada" value="<?php echo $this->form_encode_input($bloq_dt_chegada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_dt_chegada_label" id="hidden_field_label_bloq_dt_chegada" style="<?php echo $sStyleHidden_bloq_dt_chegada; ?>"><span id="id_label_bloq_dt_chegada"><?php echo $this->nm_new_label['bloq_dt_chegada']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_dt_chegada']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_dt_chegada'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_dt_chegada_line" id="hidden_field_data_bloq_dt_chegada" style="<?php echo $sStyleHidden_bloq_dt_chegada; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_dt_chegada_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_dt_chegada"]) &&  $this->nmgp_cmp_readonly["bloq_dt_chegada"] == "on") { 

 ?>
<input type="hidden" name="bloq_dt_chegada" value="<?php echo $this->form_encode_input($bloq_dt_chegada) . "\">" . $bloq_dt_chegada . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_dt_chegada" class="sc-ui-readonly-bloq_dt_chegada css_bloq_dt_chegada_line" style="<?php echo $sStyleReadLab_bloq_dt_chegada; ?>"><?php echo $this->form_format_readonly("bloq_dt_chegada", $this->form_encode_input($bloq_dt_chegada)); ?></span><span id="id_read_off_bloq_dt_chegada" class="css_read_off_bloq_dt_chegada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_dt_chegada; ?>"><?php
$tmp_form_data = $this->field_config['bloq_dt_chegada']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_bloq_dt_chegada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_dt_chegada" type=text name="bloq_dt_chegada" value="<?php echo $this->form_encode_input($bloq_dt_chegada) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['bloq_dt_chegada']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['bloq_dt_chegada']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_dt_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_dt_chegada_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_hr_chegada']))
    {
        $this->nm_new_label['bloq_hr_chegada'] = "Hora Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_hr_chegada = $this->bloq_hr_chegada;
   $sStyleHidden_bloq_hr_chegada = '';
   if (isset($this->nmgp_cmp_hidden['bloq_hr_chegada']) && $this->nmgp_cmp_hidden['bloq_hr_chegada'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_hr_chegada']);
       $sStyleHidden_bloq_hr_chegada = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_hr_chegada = 'display: none;';
   $sStyleReadInp_bloq_hr_chegada = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_hr_chegada']) && $this->nmgp_cmp_readonly['bloq_hr_chegada'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_hr_chegada']);
       $sStyleReadLab_bloq_hr_chegada = '';
       $sStyleReadInp_bloq_hr_chegada = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_hr_chegada']) && $this->nmgp_cmp_hidden['bloq_hr_chegada'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_hr_chegada" value="<?php echo $this->form_encode_input($bloq_hr_chegada) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_hr_chegada_label" id="hidden_field_label_bloq_hr_chegada" style="<?php echo $sStyleHidden_bloq_hr_chegada; ?>"><span id="id_label_bloq_hr_chegada"><?php echo $this->nm_new_label['bloq_hr_chegada']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_hr_chegada']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_hr_chegada'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_hr_chegada_line" id="hidden_field_data_bloq_hr_chegada" style="<?php echo $sStyleHidden_bloq_hr_chegada; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_hr_chegada_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_hr_chegada"]) &&  $this->nmgp_cmp_readonly["bloq_hr_chegada"] == "on") { 

 ?>
<input type="hidden" name="bloq_hr_chegada" value="<?php echo $this->form_encode_input($bloq_hr_chegada) . "\">" . $bloq_hr_chegada . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_hr_chegada" class="sc-ui-readonly-bloq_hr_chegada css_bloq_hr_chegada_line" style="<?php echo $sStyleReadLab_bloq_hr_chegada; ?>"><?php echo $this->form_format_readonly("bloq_hr_chegada", $this->form_encode_input($bloq_hr_chegada)); ?></span><span id="id_read_off_bloq_hr_chegada" class="css_read_off_bloq_hr_chegada<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_hr_chegada; ?>"><?php
$tmp_form_data = $this->field_config['bloq_hr_chegada']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_bloq_hr_chegada_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_hr_chegada" type=text name="bloq_hr_chegada" value="<?php echo $this->form_encode_input($bloq_hr_chegada) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['bloq_hr_chegada']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['bloq_hr_chegada']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_hr_chegada_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_hr_chegada_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_num_voo']))
    {
        $this->nm_new_label['bloq_num_voo'] = "Número Voo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_num_voo = $this->bloq_num_voo;
   $sStyleHidden_bloq_num_voo = '';
   if (isset($this->nmgp_cmp_hidden['bloq_num_voo']) && $this->nmgp_cmp_hidden['bloq_num_voo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_num_voo']);
       $sStyleHidden_bloq_num_voo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_num_voo = 'display: none;';
   $sStyleReadInp_bloq_num_voo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_num_voo']) && $this->nmgp_cmp_readonly['bloq_num_voo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_num_voo']);
       $sStyleReadLab_bloq_num_voo = '';
       $sStyleReadInp_bloq_num_voo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_num_voo']) && $this->nmgp_cmp_hidden['bloq_num_voo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_num_voo" value="<?php echo $this->form_encode_input($bloq_num_voo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_num_voo_label" id="hidden_field_label_bloq_num_voo" style="<?php echo $sStyleHidden_bloq_num_voo; ?>"><span id="id_label_bloq_num_voo"><?php echo $this->nm_new_label['bloq_num_voo']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_num_voo']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_num_voo'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_num_voo_line" id="hidden_field_data_bloq_num_voo" style="<?php echo $sStyleHidden_bloq_num_voo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_num_voo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_num_voo"]) &&  $this->nmgp_cmp_readonly["bloq_num_voo"] == "on") { 

 ?>
<input type="hidden" name="bloq_num_voo" value="<?php echo $this->form_encode_input($bloq_num_voo) . "\">" . $bloq_num_voo . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_num_voo" class="sc-ui-readonly-bloq_num_voo css_bloq_num_voo_line" style="<?php echo $sStyleReadLab_bloq_num_voo; ?>"><?php echo $this->form_format_readonly("bloq_num_voo", $this->form_encode_input($this->bloq_num_voo)); ?></span><span id="id_read_off_bloq_num_voo" class="css_read_off_bloq_num_voo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_num_voo; ?>">
 <input class="sc-js-input scFormObjectOdd css_bloq_num_voo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_num_voo" type=text name="bloq_num_voo" value="<?php echo $this->form_encode_input($bloq_num_voo) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_num_voo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_num_voo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_num_pass_etkt']))
    {
        $this->nm_new_label['bloq_num_pass_etkt'] = "Num. Passagem (ETKT):";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_num_pass_etkt = $this->bloq_num_pass_etkt;
   $sStyleHidden_bloq_num_pass_etkt = '';
   if (isset($this->nmgp_cmp_hidden['bloq_num_pass_etkt']) && $this->nmgp_cmp_hidden['bloq_num_pass_etkt'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_num_pass_etkt']);
       $sStyleHidden_bloq_num_pass_etkt = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_num_pass_etkt = 'display: none;';
   $sStyleReadInp_bloq_num_pass_etkt = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_num_pass_etkt']) && $this->nmgp_cmp_readonly['bloq_num_pass_etkt'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_num_pass_etkt']);
       $sStyleReadLab_bloq_num_pass_etkt = '';
       $sStyleReadInp_bloq_num_pass_etkt = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_num_pass_etkt']) && $this->nmgp_cmp_hidden['bloq_num_pass_etkt'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_num_pass_etkt" value="<?php echo $this->form_encode_input($bloq_num_pass_etkt) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_num_pass_etkt_label" id="hidden_field_label_bloq_num_pass_etkt" style="<?php echo $sStyleHidden_bloq_num_pass_etkt; ?>"><span id="id_label_bloq_num_pass_etkt"><?php echo $this->nm_new_label['bloq_num_pass_etkt']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_num_pass_etkt']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['php_cmp_required']['bloq_num_pass_etkt'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_bloq_num_pass_etkt_line" id="hidden_field_data_bloq_num_pass_etkt" style="<?php echo $sStyleHidden_bloq_num_pass_etkt; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_num_pass_etkt_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_num_pass_etkt"]) &&  $this->nmgp_cmp_readonly["bloq_num_pass_etkt"] == "on") { 

 ?>
<input type="hidden" name="bloq_num_pass_etkt" value="<?php echo $this->form_encode_input($bloq_num_pass_etkt) . "\">" . $bloq_num_pass_etkt . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_num_pass_etkt" class="sc-ui-readonly-bloq_num_pass_etkt css_bloq_num_pass_etkt_line" style="<?php echo $sStyleReadLab_bloq_num_pass_etkt; ?>"><?php echo $this->form_format_readonly("bloq_num_pass_etkt", $this->form_encode_input($this->bloq_num_pass_etkt)); ?></span><span id="id_read_off_bloq_num_pass_etkt" class="css_read_off_bloq_num_pass_etkt<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_num_pass_etkt; ?>">
 <input class="sc-js-input scFormObjectOdd css_bloq_num_pass_etkt_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_num_pass_etkt" type=text name="bloq_num_pass_etkt" value="<?php echo $this->form_encode_input($bloq_num_pass_etkt) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_num_pass_etkt_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_num_pass_etkt_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_localizador']))
    {
        $this->nm_new_label['bloq_localizador'] = " Localizador:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_localizador = $this->bloq_localizador;
   $sStyleHidden_bloq_localizador = '';
   if (isset($this->nmgp_cmp_hidden['bloq_localizador']) && $this->nmgp_cmp_hidden['bloq_localizador'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_localizador']);
       $sStyleHidden_bloq_localizador = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_localizador = 'display: none;';
   $sStyleReadInp_bloq_localizador = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_localizador']) && $this->nmgp_cmp_readonly['bloq_localizador'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_localizador']);
       $sStyleReadLab_bloq_localizador = '';
       $sStyleReadInp_bloq_localizador = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_localizador']) && $this->nmgp_cmp_hidden['bloq_localizador'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_localizador" value="<?php echo $this->form_encode_input($bloq_localizador) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_localizador_label" id="hidden_field_label_bloq_localizador" style="<?php echo $sStyleHidden_bloq_localizador; ?>"><span id="id_label_bloq_localizador"><?php echo $this->nm_new_label['bloq_localizador']; ?></span></TD>
    <TD class="scFormDataOdd css_bloq_localizador_line" id="hidden_field_data_bloq_localizador" style="<?php echo $sStyleHidden_bloq_localizador; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_localizador_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_localizador"]) &&  $this->nmgp_cmp_readonly["bloq_localizador"] == "on") { 

 ?>
<input type="hidden" name="bloq_localizador" value="<?php echo $this->form_encode_input($bloq_localizador) . "\">" . $bloq_localizador . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_localizador" class="sc-ui-readonly-bloq_localizador css_bloq_localizador_line" style="<?php echo $sStyleReadLab_bloq_localizador; ?>"><?php echo $this->form_format_readonly("bloq_localizador", $this->form_encode_input($this->bloq_localizador)); ?></span><span id="id_read_off_bloq_localizador" class="css_read_off_bloq_localizador<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_localizador; ?>">
 <input class="sc-js-input scFormObjectOdd css_bloq_localizador_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_localizador" type=text name="bloq_localizador" value="<?php echo $this->form_encode_input($bloq_localizador) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_localizador_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_localizador_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['bloq_qtd_lugares']))
    {
        $this->nm_new_label['bloq_qtd_lugares'] = "Qtd. Lugares";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_qtd_lugares = $this->bloq_qtd_lugares;
   $sStyleHidden_bloq_qtd_lugares = '';
   if (isset($this->nmgp_cmp_hidden['bloq_qtd_lugares']) && $this->nmgp_cmp_hidden['bloq_qtd_lugares'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_qtd_lugares']);
       $sStyleHidden_bloq_qtd_lugares = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_qtd_lugares = 'display: none;';
   $sStyleReadInp_bloq_qtd_lugares = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_qtd_lugares']) && $this->nmgp_cmp_readonly['bloq_qtd_lugares'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_qtd_lugares']);
       $sStyleReadLab_bloq_qtd_lugares = '';
       $sStyleReadInp_bloq_qtd_lugares = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_qtd_lugares']) && $this->nmgp_cmp_hidden['bloq_qtd_lugares'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_qtd_lugares" value="<?php echo $this->form_encode_input($bloq_qtd_lugares) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_qtd_lugares_label" id="hidden_field_label_bloq_qtd_lugares" style="<?php echo $sStyleHidden_bloq_qtd_lugares; ?>"><span id="id_label_bloq_qtd_lugares"><?php echo $this->nm_new_label['bloq_qtd_lugares']; ?></span></TD>
    <TD class="scFormDataOdd css_bloq_qtd_lugares_line" id="hidden_field_data_bloq_qtd_lugares" style="<?php echo $sStyleHidden_bloq_qtd_lugares; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_qtd_lugares_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_qtd_lugares"]) &&  $this->nmgp_cmp_readonly["bloq_qtd_lugares"] == "on") { 

 ?>
<input type="hidden" name="bloq_qtd_lugares" value="<?php echo $this->form_encode_input($bloq_qtd_lugares) . "\">" . $bloq_qtd_lugares . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_qtd_lugares" class="sc-ui-readonly-bloq_qtd_lugares css_bloq_qtd_lugares_line" style="<?php echo $sStyleReadLab_bloq_qtd_lugares; ?>"><?php echo $this->form_format_readonly("bloq_qtd_lugares", $this->form_encode_input($this->bloq_qtd_lugares)); ?></span><span id="id_read_off_bloq_qtd_lugares" class="css_read_off_bloq_qtd_lugares<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_qtd_lugares; ?>">
 <input class="sc-js-input scFormObjectOdd css_bloq_qtd_lugares_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_qtd_lugares" type=text name="bloq_qtd_lugares" value="<?php echo $this->form_encode_input($bloq_qtd_lugares) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['bloq_qtd_lugares']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['bloq_qtd_lugares']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['bloq_qtd_lugares']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_qtd_lugares_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_qtd_lugares_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_saldo_lugares']))
    {
        $this->nm_new_label['bloq_saldo_lugares'] = "Lugares Restantes:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_saldo_lugares = $this->bloq_saldo_lugares;
   $sStyleHidden_bloq_saldo_lugares = '';
   if (isset($this->nmgp_cmp_hidden['bloq_saldo_lugares']) && $this->nmgp_cmp_hidden['bloq_saldo_lugares'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_saldo_lugares']);
       $sStyleHidden_bloq_saldo_lugares = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_saldo_lugares = 'display: none;';
   $sStyleReadInp_bloq_saldo_lugares = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_saldo_lugares']) && $this->nmgp_cmp_readonly['bloq_saldo_lugares'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_saldo_lugares']);
       $sStyleReadLab_bloq_saldo_lugares = '';
       $sStyleReadInp_bloq_saldo_lugares = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_saldo_lugares']) && $this->nmgp_cmp_hidden['bloq_saldo_lugares'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_saldo_lugares" value="<?php echo $this->form_encode_input($bloq_saldo_lugares) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_saldo_lugares_label" id="hidden_field_label_bloq_saldo_lugares" style="<?php echo $sStyleHidden_bloq_saldo_lugares; ?>"><span id="id_label_bloq_saldo_lugares"><?php echo $this->nm_new_label['bloq_saldo_lugares']; ?></span></TD>
    <TD class="scFormDataOdd css_bloq_saldo_lugares_line" id="hidden_field_data_bloq_saldo_lugares" style="<?php echo $sStyleHidden_bloq_saldo_lugares; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_saldo_lugares_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_saldo_lugares"]) &&  $this->nmgp_cmp_readonly["bloq_saldo_lugares"] == "on") { 

 ?>
<input type="hidden" name="bloq_saldo_lugares" value="<?php echo $this->form_encode_input($bloq_saldo_lugares) . "\">" . $bloq_saldo_lugares . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_saldo_lugares" class="sc-ui-readonly-bloq_saldo_lugares css_bloq_saldo_lugares_line" style="<?php echo $sStyleReadLab_bloq_saldo_lugares; ?>"><?php echo $this->form_format_readonly("bloq_saldo_lugares", $this->form_encode_input($this->bloq_saldo_lugares)); ?></span><span id="id_read_off_bloq_saldo_lugares" class="css_read_off_bloq_saldo_lugares<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_saldo_lugares; ?>">
 <input class="sc-js-input scFormObjectOdd css_bloq_saldo_lugares_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_saldo_lugares" type=text name="bloq_saldo_lugares" value="<?php echo $this->form_encode_input($bloq_saldo_lugares) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=4"; } ?> alt="{datatype: 'integer', maxLength: 4, thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['bloq_saldo_lugares']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['bloq_saldo_lugares']['symbol_fmt']; ?>, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['bloq_saldo_lugares']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_saldo_lugares_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_saldo_lugares_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_nota_gate']))
    {
        $this->nm_new_label['bloq_nota_gate'] = "Núm. Nota Gate:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_nota_gate = $this->bloq_nota_gate;
   $sStyleHidden_bloq_nota_gate = '';
   if (isset($this->nmgp_cmp_hidden['bloq_nota_gate']) && $this->nmgp_cmp_hidden['bloq_nota_gate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_nota_gate']);
       $sStyleHidden_bloq_nota_gate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_nota_gate = 'display: none;';
   $sStyleReadInp_bloq_nota_gate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_nota_gate']) && $this->nmgp_cmp_readonly['bloq_nota_gate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_nota_gate']);
       $sStyleReadLab_bloq_nota_gate = '';
       $sStyleReadInp_bloq_nota_gate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_nota_gate']) && $this->nmgp_cmp_hidden['bloq_nota_gate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_nota_gate" value="<?php echo $this->form_encode_input($bloq_nota_gate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_nota_gate_label" id="hidden_field_label_bloq_nota_gate" style="<?php echo $sStyleHidden_bloq_nota_gate; ?>"><span id="id_label_bloq_nota_gate"><?php echo $this->nm_new_label['bloq_nota_gate']; ?></span></TD>
    <TD class="scFormDataOdd css_bloq_nota_gate_line" id="hidden_field_data_bloq_nota_gate" style="<?php echo $sStyleHidden_bloq_nota_gate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_nota_gate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_nota_gate"]) &&  $this->nmgp_cmp_readonly["bloq_nota_gate"] == "on") { 

 ?>
<input type="hidden" name="bloq_nota_gate" value="<?php echo $this->form_encode_input($bloq_nota_gate) . "\">" . $bloq_nota_gate . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_nota_gate" class="sc-ui-readonly-bloq_nota_gate css_bloq_nota_gate_line" style="<?php echo $sStyleReadLab_bloq_nota_gate; ?>"><?php echo $this->form_format_readonly("bloq_nota_gate", $this->form_encode_input($this->bloq_nota_gate)); ?></span><span id="id_read_off_bloq_nota_gate" class="css_read_off_bloq_nota_gate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_nota_gate; ?>">
 <input class="sc-js-input scFormObjectOdd css_bloq_nota_gate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_nota_gate" type=text name="bloq_nota_gate" value="<?php echo $this->form_encode_input($bloq_nota_gate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_nota_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_nota_gate_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['bloq_dt_nota_gate']))
    {
        $this->nm_new_label['bloq_dt_nota_gate'] = "Data Nota Gate:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $bloq_dt_nota_gate = $this->bloq_dt_nota_gate;
   $sStyleHidden_bloq_dt_nota_gate = '';
   if (isset($this->nmgp_cmp_hidden['bloq_dt_nota_gate']) && $this->nmgp_cmp_hidden['bloq_dt_nota_gate'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['bloq_dt_nota_gate']);
       $sStyleHidden_bloq_dt_nota_gate = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_bloq_dt_nota_gate = 'display: none;';
   $sStyleReadInp_bloq_dt_nota_gate = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['bloq_dt_nota_gate']) && $this->nmgp_cmp_readonly['bloq_dt_nota_gate'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['bloq_dt_nota_gate']);
       $sStyleReadLab_bloq_dt_nota_gate = '';
       $sStyleReadInp_bloq_dt_nota_gate = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['bloq_dt_nota_gate']) && $this->nmgp_cmp_hidden['bloq_dt_nota_gate'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="bloq_dt_nota_gate" value="<?php echo $this->form_encode_input($bloq_dt_nota_gate) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_bloq_dt_nota_gate_label" id="hidden_field_label_bloq_dt_nota_gate" style="<?php echo $sStyleHidden_bloq_dt_nota_gate; ?>"><span id="id_label_bloq_dt_nota_gate"><?php echo $this->nm_new_label['bloq_dt_nota_gate']; ?></span></TD>
    <TD class="scFormDataOdd css_bloq_dt_nota_gate_line" id="hidden_field_data_bloq_dt_nota_gate" style="<?php echo $sStyleHidden_bloq_dt_nota_gate; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_bloq_dt_nota_gate_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["bloq_dt_nota_gate"]) &&  $this->nmgp_cmp_readonly["bloq_dt_nota_gate"] == "on") { 

 ?>
<input type="hidden" name="bloq_dt_nota_gate" value="<?php echo $this->form_encode_input($bloq_dt_nota_gate) . "\">" . $bloq_dt_nota_gate . ""; ?>
<?php } else { ?>
<span id="id_read_on_bloq_dt_nota_gate" class="sc-ui-readonly-bloq_dt_nota_gate css_bloq_dt_nota_gate_line" style="<?php echo $sStyleReadLab_bloq_dt_nota_gate; ?>"><?php echo $this->form_format_readonly("bloq_dt_nota_gate", $this->form_encode_input($bloq_dt_nota_gate)); ?></span><span id="id_read_off_bloq_dt_nota_gate" class="css_read_off_bloq_dt_nota_gate<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_bloq_dt_nota_gate; ?>"><?php
$tmp_form_data = $this->field_config['bloq_dt_nota_gate']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_bloq_dt_nota_gate_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_bloq_dt_nota_gate" type=text name="bloq_dt_nota_gate" value="<?php echo $this->form_encode_input($bloq_dt_nota_gate) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['bloq_dt_nota_gate']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['bloq_dt_nota_gate']['date_format']; ?>', enterTab: true, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_bloq_dt_nota_gate_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_bloq_dt_nota_gate_text"></span></td></tr></table></td></tr></table></TD>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['birpara'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['first'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['back'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['forward'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_bloqueio_aereo_rsvp");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_bloqueio_aereo_rsvp");
 parent.scAjaxDetailHeight("form_bloqueio_aereo_rsvp", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_bloqueio_aereo_rsvp", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_bloqueio_aereo_rsvp", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['sc_modal'])
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_bloqueio_aereo_rsvp']['inside_nested_iframe']) {
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
