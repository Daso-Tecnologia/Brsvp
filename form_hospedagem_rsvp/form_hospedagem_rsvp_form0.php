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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " hospedagem_rsvp"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " hospedagem_rsvp"); } ?></TITLE>
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
            <meta name="viewport" content="minimal-ui, width=300, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
            <meta name="mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="apple-touch-icon"   sizes="57x57" href="">
            <link rel="apple-touch-icon"   sizes="60x60" href="">
            <link rel="apple-touch-icon"   sizes="72x72" href="">
            <link rel="apple-touch-icon"   sizes="76x76" href="">
            <link rel="apple-touch-icon" sizes="114x114" href="">
            <link rel="apple-touch-icon" sizes="120x120" href="">
            <link rel="apple-touch-icon" sizes="144x144" href="">
            <link rel="apple-touch-icon" sizes="152x152" href="">
            <link rel="apple-touch-icon" sizes="180x180" href="">
            <link rel="icon" type="image/png" sizes="192x192" href="">
            <link rel="icon" type="image/png"   sizes="32x32" href="">
            <link rel="icon" type="image/png"   sizes="96x96" href="">
            <link rel="icon" type="image/png"   sizes="16x16" href="">
            <meta name="msapplication-TileColor" content="___">
            <meta name="msapplication-TileImage" content="">
            <meta name="theme-color" content="___">
            <meta name="apple-mobile-web-app-status-bar-style" content="___">
            <link rel="shortcut icon" href=""> <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
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
            <?php
               if ($_SESSION['scriptcase']['display_mobile'] && $_SESSION['scriptcase']['device_mobile']) {
                   $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
                   $sc_app_data   = json_encode([
                       'forceMobile' => $forced_mobile,
                       'appType' => 'form',
                       'improvements' => true,
                       'displayOptionsButton' => false,
                       'displayScrollUp' => true,
                       'scrollUpPosition' => 'A',
                       'toolbarOrientation' => 'H',
                       'mobilePanes' => 'true',
                       'navigationBarButtons' => unserialize('a:0:{}'),
                       'mobileSimpleToolbar' => true,
                       'bottomToolbarFixed' => true,
                       'langs' => [
                           'lang_double_select_move_all' => html_entity_decode($this->Ini->Nm_lang['lang_double_select_move_all'], ENT_COMPAT, $_SESSION['scriptcase']['charset']),
                           'lang_double_select_move' => html_entity_decode($this->Ini->Nm_lang['lang_double_select_move'], ENT_COMPAT, $_SESSION['scriptcase']['charset']),
                       ],
                   ]); ?>
            <input type="hidden" id="sc-mobile-app-data" value='<?php echo $sc_app_data; ?>' />
            <script type="text/javascript" src="../_lib/lib/js/nm_modal_panes.jquery.js"></script>
            <script type="text/javascript" src="../_lib/lib/js/nm_form_mobile.js"></script>
            <link rel='stylesheet' href='../_lib/lib/css/nm_form_mobile.css' type='text/css'/>
            <script>
                $(document).ready(function(){

                    bootstrapMobile();

                });
            </script>
            <?php } ?> <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
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
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/calculator/jquery.calculator.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/calculator/jquery.plugin.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/calculator/jquery.calculator.js"></SCRIPT>
<?php
switch ($_SESSION['scriptcase']['str_lang']) {
        case 'ca':
        case 'da':
        case 'de':
        case 'es':
        case 'fr':
        case 'hr':
        case 'it':
        case 'nl':
        case 'no':
        case 'pl':
        case 'ru':
//        case 'sr':
        case 'sl':
        case 'uk':
                $tmpCalcLocale = $_SESSION['scriptcase']['str_lang'];
                break;
        case 'pt_br':
                $tmpCalcLocale = 'pt-BR';
                break;
        case 'tr':
                $tmpCalcLocale = 'ar';
                break;
        case 'zh_cn':
                $tmpCalcLocale = 'zh-CN';
                break;
//        case 'zh_hk':
//                $tmpCalcLocale = 'zh-TW';
//                break;
        default:
                $tmpCalcLocale = '';
                break;
}
if ('' != $tmpCalcLocale) {
        echo " <SCRIPT type=\"text/javascript\" src=\"{$this->Ini->path_prod}/third/jquery_plugin/calculator/jquery.calculator-$tmpCalcLocale.js\"></SCRIPT>\r\n";
}
?>
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
.css_read_off_hosp_dt_checkin button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_hosp_dt_checkout button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php
$miniCalculatorFA = $this->jqueryFAFile('calculator');
if ('' != $miniCalculatorFA) {
?>
<style type="text/css">
.css_read_off_hosp_total button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_hospedagem_rsvp/form_hospedagem_rsvp_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_hospedagem_rsvp_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_hospedagem_rsvp_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['recarga'];
}
if ('' != $this->hosp_id_evento)
{
    $this->lookup_hosp_id_evento($look_rpc_hosp_id_evento);
}
if ('' != $this->hosp_id_usuario)
{
    $this->lookup_hosp_id_usuario($look_rpc_hosp_id_usuario);
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['link_info']['remove_border']) {
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
 include_once("form_hospedagem_rsvp_js0.php");
?>
<script type="text/javascript" src="<?php  echo $this->Ini->path_js . "/jsrsClient.js" ?>"> 
</script> 
<script type="text/javascript"> 
 // Adiciona um elemento
 //----------------------
 function nm_add_sel(event, sOrig, sDest, fCBack, sRow)
 {
  scMarkFormAsChanged();
  // Recupera objetos
  oOrig = document.F1.elements[ sOrig];
  oDest = document.F1.elements[ sDest];
  // Varre itens da origem
  for (i = 0; i < oOrig.length; i++)
  {
   // Item na origem selecionado e valido
   if ((event == 'Click' && oOrig.options[ i].selected && !oOrig.options[ i].disabled) || (event != 'Click' && oOrig.options[ i] == event.target && !oOrig.options[ i].disabled))
   {
    // Recupera valores da origem
    sText  = oOrig.options[ i].text;
    sValue = oOrig.options[ i].value;
    // Cria item no destino
    oDest.options[oDest.length] = new Option(sText, sValue);
    // Desabilita item na origem
    oOrig.options[ i].style.color = "#A0A0A0";
    oOrig.options[ i].disabled    = true;
    oOrig.options[ i].selected    = false;
   }
  }
  if (fCBack)
  {
   fCBack(sRow);
  }
 }
 // Adiciona todos os elementos
 //-----------------------------
 function nm_add_all(sOrig, sDest, fCBack, sRow)
 {
  scMarkFormAsChanged();
  // Recupera objetos
  oOrig = document.F1.elements[ sOrig];
  oDest = document.F1.elements[ sDest];
  // Varre itens da origem
  for (i = 0; i < oOrig.length; i++)
  {
   // Item na origem valido
   if (!oOrig.options[ i].disabled)
   {
    // Recupera valores da origem
    sText  = oOrig.options[ i].text;
    sValue = oOrig.options[ i].value;
    // Cria item no destino
    oDest.options[oDest.length] = new Option(sText, sValue);
    // Desabilita item na origem
    oOrig.options[ i].style.color = "#A0A0A0";
    oOrig.options[ i].disabled    = true;
    oOrig.options[ i].selected    = false;
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (fCBack)
  {
   fCBack(sRow);
  }
 }
 // Remove um elemento
 //--------------------
 function nm_del_sel(event, sOrig, sDest, fCBack, sRow)
 {
  scMarkFormAsChanged();
  // Recupera objetos
  oOrig = document.F1.elements[ sOrig];
  oDest = document.F1.elements[ sDest];
  aSel  = new Array();
  atxt  = new Array();
  solt  = new Array();
  j     = 0;
  z     = 0;
  // Remove itens selecionados na origem
  for (i = oOrig.length - 1; i >= 0; i--)
  {
   // Item na origem selecionado
   if ((event == 'Click' && oOrig.options[ i].selected) || (event != 'Click' && oOrig.options[ i] == event.target))
   {
    aSel[ j] = oOrig.options[ i].value;
    atxt[ j] = oOrig.options[ i].text;
    j++;
    oOrig.options[ i] = null;
   }
  }
  // Habilita itens no destino
  for (i = 0; i < oDest.length; i++)
  {
   if (oDest.options[ i].disabled && in_array(aSel, oDest.options[ i].value))
   {
    oDest.options[ i].disabled    = false;
    oDest.options[ i].style.color = "";
    solt[ z] = oDest.options[ i].value;
    z++;
   }
  }
  for (i = 0; i < aSel.length; i++)
  {
   if (!in_array(solt, aSel[ i]))
   {
    oDest.options[oDest.length] = new Option(atxt[ i], aSel[ i]);
   }
  }
  if (fCBack)
  {
   fCBack(sRow);
  }
 }
 // Remove todos os elementos
 //---------------------------
 function nm_del_all(sOrig, sDest, fCBack, sRow)
 {
  scMarkFormAsChanged();
  // Recupera objetos
  oOrig = document.F1.elements[ sOrig];
  oDest = document.F1.elements[ sDest];
  aSel  = new Array();
  atxt  = new Array();
  solt  = new Array();
  j     = 0;
  z     = 0;
  // Remove todos os itens na origem
  while (0 < oOrig.length)
  {
   i       = oOrig.length - 1;
   aSel[ j] = oOrig.options[ i].value;
   atxt[ j] = oOrig.options[ i].text;
   j++;
   oOrig.options[ i] = null;
  }
  // Habilita itens no destino
  for (i = 0; i < oDest.length; i++)
  {
   if (oDest.options[ i].disabled && in_array(aSel, oDest.options[ i].value))
   {
    oDest.options[ i].disabled    = false;
    oDest.options [ i].style.color = "";
    solt[ z] = oDest.options[ i].value;
    z++;
   }
  }
  for (i = 0; i < aSel.length; i++)
  {
   if (!in_array(solt, aSel[ i]))
   {
    oDest.options[oDest.length] = new Option(atxt[ i], aSel[ i]);
   }
  }
  // Reset combos
  oOrig.selectedIndex = -1;
  oDest.selectedIndex = -1;
  if (fCBack)
  {
   fCBack(sRow);
  }
 }
 function nm_sincroniza(sOrig, sDest)
 {
  // Recupera objetos
  oOrig = document.F1.elements[ sOrig];
  oDest = document.F1.elements[ sDest];
  // Varre itens do destino
  for (i = 0; i < oDest.length; i++)
  {
     dValue = oDest.options[ i].value;
     bFound = false;
     for (x = 0; x < oOrig.length && !bFound; x++)
     {
         oValue = oOrig.options[ x].value;
         if (dValue == oValue)
         {
             // Desabilita item na origem
             oOrig.options[ x].style.color = "#A0A0A0";
             oOrig.options[ x].disabled    = true;
             oOrig.options[ x].selected    = false;
             bFound = true;
         }
     }
  }
 }
 var nm_quant_pack;
 function nm_pack(sOrig, sDest)
 {
    if (!document.F1.elements[ sOrig] || !document.F1.elements[ sDest]) return;
    obj_sel = document.F1.elements[ sOrig];
    str_val = "";
    nm_quant_pack = 0;
    for (i = 0; i < obj_sel.length; i++)
    {
         if ("" != str_val)
         {
             str_val += "@?@";
             nm_quant_pack++;
         }
         str_val += obj_sel.options[ i].value;
    }
    document.F1.elements[ sDest].value = str_val;
 }
 function nm_pack_sel(sOrig, sDest)
 {
    if (!document.F1.elements[ sOrig] || !document.F1.elements[ sDest]) return;
    obj_sel = document.F1.elements[ sOrig];
    str_val = "";
    nm_quant_pack = 0;
    for (i = 0; i < obj_sel.length; i++)
    {
         if (obj_sel.options[ i].selected)
         {
             if ("" != str_val)
             {
                 str_val += "@?@";
                 nm_quant_pack++;
             }
             str_val += obj_sel.options[ i].value;
         }
    }
    document.F1.elements[ sDest].value = str_val;
 }
 function nm_del_combo(sOcombo)
 {
  // Recupera objetos
  oOrig = document.F1.elements[ sOcombo];
  aSel  = new Array();
  j     = 0;
  // Remove todos os itens na origem
  while (0 < oOrig.length)
  {
   i       = oOrig.length - 1;
   aSel[ j] = oOrig.options[ i].value;
   j++;
   oOrig.options[ i] = null;
  }
 }
 function nm_add_item(sDest, sText, sValue, sSelected)
 {
  oDest = document.F1.elements[ sDest];
  oDest.options[oDest.length] = new Option(sText, sValue);
  if (sSelected == 'selected')
  {
      oDest.options[oDest.length -1].selected = true;
  }
 }
 function in_array(aArray, sElem)
 {
  for (iCount = 0; iCount < aArray.length; iCount++)
  {
   if (sElem == aArray[ iCount])
   {
    return true;
   }
  }
  return false;
 }
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_hospedagem_rsvp'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_hospedagem_rsvp'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  $this->Tab_width = "  width=\"55%\"";
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['fast_search'][2] : "";
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
          $SC_Label_atu['hosp_dt_checkin'] = (isset($this->nm_new_label['hosp_dt_checkin'])) ? $this->nm_new_label['hosp_dt_checkin'] : 'Dt. CheckIn:'; 
          $SC_Label_atu['hosp_dt_checkout'] = (isset($this->nm_new_label['hosp_dt_checkout'])) ? $this->nm_new_label['hosp_dt_checkout'] : 'Dt. CheckOut:'; 
          $SC_Label_atu['hosp_hr_checkin'] = (isset($this->nm_new_label['hosp_hr_checkin'])) ? $this->nm_new_label['hosp_hr_checkin'] : 'Hr. CheckIn:'; 
          $SC_Label_atu['hosp_hr_checkout'] = (isset($this->nm_new_label['hosp_hr_checkout'])) ? $this->nm_new_label['hosp_hr_checkout'] : 'Hr. CheckOut:'; 
          $SC_Label_atu['hosp_early_chkin'] = (isset($this->nm_new_label['hosp_early_chkin'])) ? $this->nm_new_label['hosp_early_chkin'] : 'Early CheckIn:'; 
          $SC_Label_atu['hosp_late_chkout'] = (isset($this->nm_new_label['hosp_late_chkout'])) ? $this->nm_new_label['hosp_late_chkout'] : 'Late CheckOut:'; 
          $SC_Label_atu['hospedagem_id'] = (isset($this->nm_new_label['hospedagem_id'])) ? $this->nm_new_label['hospedagem_id'] : 'Hospedagem Id'; 
          $SC_Label_atu['hosp_id_evento'] = (isset($this->nm_new_label['hosp_id_evento'])) ? $this->nm_new_label['hosp_id_evento'] : 'Evento:'; 
          $SC_Label_atu['hosp_cpf_participante'] = (isset($this->nm_new_label['hosp_cpf_participante'])) ? $this->nm_new_label['hosp_cpf_participante'] : 'CPF Participante:'; 
          $SC_Label_atu['enviar_app'] = (isset($this->nm_new_label['enviar_app'])) ? $this->nm_new_label['enviar_app'] : 'Gravar no APP:'; 
          $SC_Label_atu['hosp_id_hotel'] = (isset($this->nm_new_label['hosp_id_hotel'])) ? $this->nm_new_label['hosp_id_hotel'] : 'Hotel:'; 
          $SC_Label_atu['hosp_acomodacao'] = (isset($this->nm_new_label['hosp_acomodacao'])) ? $this->nm_new_label['hosp_acomodacao'] : 'Acomodação:'; 
          $SC_Label_atu['hosp_categoria'] = (isset($this->nm_new_label['hosp_categoria'])) ? $this->nm_new_label['hosp_categoria'] : 'Categoria:'; 
          $SC_Label_atu['hosp_status'] = (isset($this->nm_new_label['hosp_status'])) ? $this->nm_new_label['hosp_status'] : 'Status:'; 
          $SC_Label_atu['hosp_part_acomp'] = (isset($this->nm_new_label['hosp_part_acomp'])) ? $this->nm_new_label['hosp_part_acomp'] : 'Outro(s) Participante(s) acompanhando (Mesmo Quarto):'; 
          $SC_Label_atu['hosp_qtd_acompanhante'] = (isset($this->nm_new_label['hosp_qtd_acompanhante'])) ? $this->nm_new_label['hosp_qtd_acompanhante'] : 'Qtd. Acompanhante:'; 
          $SC_Label_atu['hosp_acompanhante'] = (isset($this->nm_new_label['hosp_acompanhante'])) ? $this->nm_new_label['hosp_acompanhante'] : 'Acompanhante(s):'; 
          $SC_Label_atu['hosp_reserva_bvt'] = (isset($this->nm_new_label['hosp_reserva_bvt'])) ? $this->nm_new_label['hosp_reserva_bvt'] : 'Comprado c/Belvitur:'; 
          $SC_Label_atu['conta_roomlist'] = (isset($this->nm_new_label['conta_roomlist'])) ? $this->nm_new_label['conta_roomlist'] : 'Conta Rooming List:'; 
          $SC_Label_atu['titulo_api'] = (isset($this->nm_new_label['titulo_api'])) ? $this->nm_new_label['titulo_api'] : 'Título API:'; 
          $SC_Label_atu['descricao_api'] = (isset($this->nm_new_label['descricao_api'])) ? $this->nm_new_label['descricao_api'] : 'Descrição API:'; 
          $SC_Label_atu['codigo_api'] = (isset($this->nm_new_label['codigo_api'])) ? $this->nm_new_label['codigo_api'] : 'Código API:'; 
          $SC_Label_atu['valido_de_api'] = (isset($this->nm_new_label['valido_de_api'])) ? $this->nm_new_label['valido_de_api'] : 'Válido API de:'; 
          $SC_Label_atu['valido_ate_api'] = (isset($this->nm_new_label['valido_ate_api'])) ? $this->nm_new_label['valido_ate_api'] : 'Válido API até:'; 
          $SC_Label_atu['nome_hotel_api'] = (isset($this->nm_new_label['nome_hotel_api'])) ? $this->nm_new_label['nome_hotel_api'] : 'Hotel API:'; 
          $SC_Label_atu['checkin_api'] = (isset($this->nm_new_label['checkin_api'])) ? $this->nm_new_label['checkin_api'] : 'Check In API:'; 
          $SC_Label_atu['checkout_api'] = (isset($this->nm_new_label['checkout_api'])) ? $this->nm_new_label['checkout_api'] : 'Check Out API\\;'; 
          $SC_Label_atu['acomodacao_api'] = (isset($this->nm_new_label['acomodacao_api'])) ? $this->nm_new_label['acomodacao_api'] : 'Acomodação API:'; 
          $SC_Label_atu['endereco_hotel_api'] = (isset($this->nm_new_label['endereco_hotel_api'])) ? $this->nm_new_label['endereco_hotel_api'] : 'Endereço API:'; 
          $SC_Label_atu['qtd_hospedes_api'] = (isset($this->nm_new_label['qtd_hospedes_api'])) ? $this->nm_new_label['qtd_hospedes_api'] : 'Qtd. Hóspedes API:'; 
          $SC_Label_atu['qtd_noites_api'] = (isset($this->nm_new_label['qtd_noites_api'])) ? $this->nm_new_label['qtd_noites_api'] : 'Qtd. Noites API:'; 
          $SC_Label_atu['cafe_manha_api'] = (isset($this->nm_new_label['cafe_manha_api'])) ? $this->nm_new_label['cafe_manha_api'] : 'Café da Manhã API:'; 
          $SC_Label_atu['comodidades_api'] = (isset($this->nm_new_label['comodidades_api'])) ? $this->nm_new_label['comodidades_api'] : 'Comodidades API:'; 
          $SC_Label_atu['codigo_reserva_api'] = (isset($this->nm_new_label['codigo_reserva_api'])) ? $this->nm_new_label['codigo_reserva_api'] : 'Código Reserva API:'; 
          $SC_Label_atu['telefone_hotel_api'] = (isset($this->nm_new_label['telefone_hotel_api'])) ? $this->nm_new_label['telefone_hotel_api'] : 'Telefone Hotel API'; 
          $SC_Label_atu['andar_hotel_api'] = (isset($this->nm_new_label['andar_hotel_api'])) ? $this->nm_new_label['andar_hotel_api'] : 'Andar Acomodação API:'; 
          $SC_Label_atu['late_checkout_api'] = (isset($this->nm_new_label['late_checkout_api'])) ? $this->nm_new_label['late_checkout_api'] : 'Late Check Out API:'; 
          $SC_Label_atu['minibar_api'] = (isset($this->nm_new_label['minibar_api'])) ? $this->nm_new_label['minibar_api'] : 'Minibar API:'; 
          $SC_Label_atu['estacionamento_api'] = (isset($this->nm_new_label['estacionamento_api'])) ? $this->nm_new_label['estacionamento_api'] : 'Estacionamento API:'; 
          $SC_Label_atu['chackin_online_api'] = (isset($this->nm_new_label['chackin_online_api'])) ? $this->nm_new_label['chackin_online_api'] : 'Check In Online API:'; 
          $SC_Label_atu['senha_wifi_api'] = (isset($this->nm_new_label['senha_wifi_api'])) ? $this->nm_new_label['senha_wifi_api'] : 'Senha Wifi API:'; 
          $SC_Label_atu['id_evento_app'] = (isset($this->nm_new_label['id_evento_app'])) ? $this->nm_new_label['id_evento_app'] : 'Id Evento App'; 
          $SC_Label_atu['id_participante_app'] = (isset($this->nm_new_label['id_participante_app'])) ? $this->nm_new_label['id_participante_app'] : 'Id Participante App'; 
          $SC_Label_atu['id_voucher_app'] = (isset($this->nm_new_label['id_voucher_app'])) ? $this->nm_new_label['id_voucher_app'] : 'Id Voucher App'; 
          $SC_Label_atu['hosp_pagamentos'] = (isset($this->nm_new_label['hosp_pagamentos'])) ? $this->nm_new_label['hosp_pagamentos'] : 'Forma de Pagamento:'; 
          $SC_Label_atu['hosp_diarias'] = (isset($this->nm_new_label['hosp_diarias'])) ? $this->nm_new_label['hosp_diarias'] : 'Diárias:'; 
          $SC_Label_atu['hosp_taxas'] = (isset($this->nm_new_label['hosp_taxas'])) ? $this->nm_new_label['hosp_taxas'] : 'Taxas:'; 
          $SC_Label_atu['hosp_total'] = (isset($this->nm_new_label['hosp_total'])) ? $this->nm_new_label['hosp_total'] : 'Total:'; 
          $SC_Label_atu['hosp_dsc_pacote'] = (isset($this->nm_new_label['hosp_dsc_pacote'])) ? $this->nm_new_label['hosp_dsc_pacote'] : 'Pacote:'; 
          $SC_Label_atu['hosp_id_usuario'] = (isset($this->nm_new_label['hosp_id_usuario'])) ? $this->nm_new_label['hosp_id_usuario'] : 'Último Atendente:'; 
          $SC_Label_atu['hosp_alteracao'] = (isset($this->nm_new_label['hosp_alteracao'])) ? $this->nm_new_label['hosp_alteracao'] : 'Alterado em:'; 
          $SC_Label_atu['hosp_observacoes'] = (isset($this->nm_new_label['hosp_observacoes'])) ? $this->nm_new_label['hosp_observacoes'] : 'Observações:'; 
          $SC_Label_atu['hosp_ativo'] = (isset($this->nm_new_label['hosp_ativo'])) ? $this->nm_new_label['hosp_ativo'] : 'Registro Ativo:'; 
          $SC_Label_atu['acmq_01'] = (isset($this->nm_new_label['acmq_01'])) ? $this->nm_new_label['acmq_01'] : 'Acompanhante 01'; 
          $SC_Label_atu['acmq_02'] = (isset($this->nm_new_label['acmq_02'])) ? $this->nm_new_label['acmq_02'] : 'Acompanhante 02'; 
          $SC_Label_atu['acmq_03'] = (isset($this->nm_new_label['acmq_03'])) ? $this->nm_new_label['acmq_03'] : 'Acompanhante 03'; 
          $SC_Label_atu['acmq_04'] = (isset($this->nm_new_label['acmq_04'])) ? $this->nm_new_label['acmq_04'] : 'Acompanhante 04'; 
          $SC_Label_atu['pamq_01'] = (isset($this->nm_new_label['pamq_01'])) ? $this->nm_new_label['pamq_01'] : 'Participante 01'; 
          $SC_Label_atu['pamq_02'] = (isset($this->nm_new_label['pamq_02'])) ? $this->nm_new_label['pamq_02'] : 'Participante 02'; 
          $SC_Label_atu['pamq_03'] = (isset($this->nm_new_label['pamq_03'])) ? $this->nm_new_label['pamq_03'] : 'Participante 03'; 
          $SC_Label_atu['pamq_04'] = (isset($this->nm_new_label['pamq_04'])) ? $this->nm_new_label['pamq_04'] : 'Participante 04'; 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['sc_btn_0'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['sc_btn_0'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_0", "scBtnFn_sc_btn_0()", "scBtnFn_sc_btn_0()", "sc_sc_btn_0_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
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
<li id="id_tabs_0_0" class="scTabActive" style="background-color: #99CCCC"><a href="javascript: sc_control_tabs_0(0)">CheckIn & CheckOut</a></li>
<li id="id_tabs_0_1" class="scTabInactive" style="background-color: #99CCCC"><a href="javascript: sc_control_tabs_0(1)">Hospedagem </a></li>
<li id="id_tabs_0_2" class="scTabInactive" style="background-color: #cef593"><a href="javascript: sc_control_tabs_0(2)">Be Invited - API</a></li>
<li id="id_tabs_0_3" class="scTabInactive" style="background-color: #99CCCC"><a href="javascript: sc_control_tabs_0(3)">Pagamento</a></li>
<li id="id_tabs_0_4" class="scTabInactive" style="background-color: #99CCCC"><a href="javascript: sc_control_tabs_0(4)">Observações</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_dt_checkin']))
    {
        $this->nm_new_label['hosp_dt_checkin'] = "Dt. CheckIn:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_dt_checkin = $this->hosp_dt_checkin;
   $sStyleHidden_hosp_dt_checkin = '';
   if (isset($this->nmgp_cmp_hidden['hosp_dt_checkin']) && $this->nmgp_cmp_hidden['hosp_dt_checkin'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_dt_checkin']);
       $sStyleHidden_hosp_dt_checkin = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_dt_checkin = 'display: none;';
   $sStyleReadInp_hosp_dt_checkin = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_dt_checkin']) && $this->nmgp_cmp_readonly['hosp_dt_checkin'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_dt_checkin']);
       $sStyleReadLab_hosp_dt_checkin = '';
       $sStyleReadInp_hosp_dt_checkin = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_dt_checkin']) && $this->nmgp_cmp_hidden['hosp_dt_checkin'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_dt_checkin" value="<?php echo $this->form_encode_input($hosp_dt_checkin) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_dt_checkin_label" id="hidden_field_label_hosp_dt_checkin" style="<?php echo $sStyleHidden_hosp_dt_checkin; ?>"><span id="id_label_hosp_dt_checkin"><?php echo $this->nm_new_label['hosp_dt_checkin']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_dt_checkin_line" id="hidden_field_data_hosp_dt_checkin" style="<?php echo $sStyleHidden_hosp_dt_checkin; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_dt_checkin_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_dt_checkin"]) &&  $this->nmgp_cmp_readonly["hosp_dt_checkin"] == "on") { 

 ?>
<input type="hidden" name="hosp_dt_checkin" value="<?php echo $this->form_encode_input($hosp_dt_checkin) . "\">" . $hosp_dt_checkin . ""; ?>
<?php } else { ?>
<span id="id_read_on_hosp_dt_checkin" class="sc-ui-readonly-hosp_dt_checkin css_hosp_dt_checkin_line" style="<?php echo $sStyleReadLab_hosp_dt_checkin; ?>"><?php echo $this->form_format_readonly("hosp_dt_checkin", $this->form_encode_input($hosp_dt_checkin)); ?></span><span id="id_read_off_hosp_dt_checkin" class="css_read_off_hosp_dt_checkin<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hosp_dt_checkin; ?>"><?php
$tmp_form_data = $this->field_config['hosp_dt_checkin']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_hosp_dt_checkin_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_dt_checkin" type=text name="hosp_dt_checkin" value="<?php echo $this->form_encode_input($hosp_dt_checkin) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['hosp_dt_checkin']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['hosp_dt_checkin']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_dt_checkin_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_dt_checkin_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_dt_checkout']))
    {
        $this->nm_new_label['hosp_dt_checkout'] = "Dt. CheckOut:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_dt_checkout = $this->hosp_dt_checkout;
   $sStyleHidden_hosp_dt_checkout = '';
   if (isset($this->nmgp_cmp_hidden['hosp_dt_checkout']) && $this->nmgp_cmp_hidden['hosp_dt_checkout'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_dt_checkout']);
       $sStyleHidden_hosp_dt_checkout = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_dt_checkout = 'display: none;';
   $sStyleReadInp_hosp_dt_checkout = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_dt_checkout']) && $this->nmgp_cmp_readonly['hosp_dt_checkout'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_dt_checkout']);
       $sStyleReadLab_hosp_dt_checkout = '';
       $sStyleReadInp_hosp_dt_checkout = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_dt_checkout']) && $this->nmgp_cmp_hidden['hosp_dt_checkout'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_dt_checkout" value="<?php echo $this->form_encode_input($hosp_dt_checkout) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_dt_checkout_label" id="hidden_field_label_hosp_dt_checkout" style="<?php echo $sStyleHidden_hosp_dt_checkout; ?>"><span id="id_label_hosp_dt_checkout"><?php echo $this->nm_new_label['hosp_dt_checkout']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_dt_checkout_line" id="hidden_field_data_hosp_dt_checkout" style="<?php echo $sStyleHidden_hosp_dt_checkout; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_dt_checkout_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_dt_checkout"]) &&  $this->nmgp_cmp_readonly["hosp_dt_checkout"] == "on") { 

 ?>
<input type="hidden" name="hosp_dt_checkout" value="<?php echo $this->form_encode_input($hosp_dt_checkout) . "\">" . $hosp_dt_checkout . ""; ?>
<?php } else { ?>
<span id="id_read_on_hosp_dt_checkout" class="sc-ui-readonly-hosp_dt_checkout css_hosp_dt_checkout_line" style="<?php echo $sStyleReadLab_hosp_dt_checkout; ?>"><?php echo $this->form_format_readonly("hosp_dt_checkout", $this->form_encode_input($hosp_dt_checkout)); ?></span><span id="id_read_off_hosp_dt_checkout" class="css_read_off_hosp_dt_checkout<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hosp_dt_checkout; ?>"><?php
$tmp_form_data = $this->field_config['hosp_dt_checkout']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_hosp_dt_checkout_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_dt_checkout" type=text name="hosp_dt_checkout" value="<?php echo $this->form_encode_input($hosp_dt_checkout) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['hosp_dt_checkout']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['hosp_dt_checkout']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_dt_checkout_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_dt_checkout_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_hr_checkin']))
    {
        $this->nm_new_label['hosp_hr_checkin'] = "Hr. CheckIn:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_hr_checkin = $this->hosp_hr_checkin;
   $sStyleHidden_hosp_hr_checkin = '';
   if (isset($this->nmgp_cmp_hidden['hosp_hr_checkin']) && $this->nmgp_cmp_hidden['hosp_hr_checkin'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_hr_checkin']);
       $sStyleHidden_hosp_hr_checkin = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_hr_checkin = 'display: none;';
   $sStyleReadInp_hosp_hr_checkin = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_hr_checkin']) && $this->nmgp_cmp_readonly['hosp_hr_checkin'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_hr_checkin']);
       $sStyleReadLab_hosp_hr_checkin = '';
       $sStyleReadInp_hosp_hr_checkin = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_hr_checkin']) && $this->nmgp_cmp_hidden['hosp_hr_checkin'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_hr_checkin" value="<?php echo $this->form_encode_input($hosp_hr_checkin) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_hr_checkin_label" id="hidden_field_label_hosp_hr_checkin" style="<?php echo $sStyleHidden_hosp_hr_checkin; ?>"><span id="id_label_hosp_hr_checkin"><?php echo $this->nm_new_label['hosp_hr_checkin']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_hr_checkin_line" id="hidden_field_data_hosp_hr_checkin" style="<?php echo $sStyleHidden_hosp_hr_checkin; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_hr_checkin_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_hr_checkin"]) &&  $this->nmgp_cmp_readonly["hosp_hr_checkin"] == "on") { 

 ?>
<input type="hidden" name="hosp_hr_checkin" value="<?php echo $this->form_encode_input($hosp_hr_checkin) . "\">" . $hosp_hr_checkin . ""; ?>
<?php } else { ?>
<span id="id_read_on_hosp_hr_checkin" class="sc-ui-readonly-hosp_hr_checkin css_hosp_hr_checkin_line" style="<?php echo $sStyleReadLab_hosp_hr_checkin; ?>"><?php echo $this->form_format_readonly("hosp_hr_checkin", $this->form_encode_input($hosp_hr_checkin)); ?></span><span id="id_read_off_hosp_hr_checkin" class="css_read_off_hosp_hr_checkin<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hosp_hr_checkin; ?>"><?php
$tmp_form_data = $this->field_config['hosp_hr_checkin']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_hosp_hr_checkin_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_hr_checkin" type=text name="hosp_hr_checkin" value="<?php echo $this->form_encode_input($hosp_hr_checkin) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['hosp_hr_checkin']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['hosp_hr_checkin']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_hr_checkin_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_hr_checkin_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_hr_checkout']))
    {
        $this->nm_new_label['hosp_hr_checkout'] = "Hr. CheckOut:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_hr_checkout = $this->hosp_hr_checkout;
   $sStyleHidden_hosp_hr_checkout = '';
   if (isset($this->nmgp_cmp_hidden['hosp_hr_checkout']) && $this->nmgp_cmp_hidden['hosp_hr_checkout'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_hr_checkout']);
       $sStyleHidden_hosp_hr_checkout = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_hr_checkout = 'display: none;';
   $sStyleReadInp_hosp_hr_checkout = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_hr_checkout']) && $this->nmgp_cmp_readonly['hosp_hr_checkout'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_hr_checkout']);
       $sStyleReadLab_hosp_hr_checkout = '';
       $sStyleReadInp_hosp_hr_checkout = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_hr_checkout']) && $this->nmgp_cmp_hidden['hosp_hr_checkout'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_hr_checkout" value="<?php echo $this->form_encode_input($hosp_hr_checkout) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_hr_checkout_label" id="hidden_field_label_hosp_hr_checkout" style="<?php echo $sStyleHidden_hosp_hr_checkout; ?>"><span id="id_label_hosp_hr_checkout"><?php echo $this->nm_new_label['hosp_hr_checkout']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_hr_checkout_line" id="hidden_field_data_hosp_hr_checkout" style="<?php echo $sStyleHidden_hosp_hr_checkout; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_hr_checkout_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_hr_checkout"]) &&  $this->nmgp_cmp_readonly["hosp_hr_checkout"] == "on") { 

 ?>
<input type="hidden" name="hosp_hr_checkout" value="<?php echo $this->form_encode_input($hosp_hr_checkout) . "\">" . $hosp_hr_checkout . ""; ?>
<?php } else { ?>
<span id="id_read_on_hosp_hr_checkout" class="sc-ui-readonly-hosp_hr_checkout css_hosp_hr_checkout_line" style="<?php echo $sStyleReadLab_hosp_hr_checkout; ?>"><?php echo $this->form_format_readonly("hosp_hr_checkout", $this->form_encode_input($hosp_hr_checkout)); ?></span><span id="id_read_off_hosp_hr_checkout" class="css_read_off_hosp_hr_checkout<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hosp_hr_checkout; ?>"><?php
$tmp_form_data = $this->field_config['hosp_hr_checkout']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_hosp_hr_checkout_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_hr_checkout" type=text name="hosp_hr_checkout" value="<?php echo $this->form_encode_input($hosp_hr_checkout) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['hosp_hr_checkout']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['hosp_hr_checkout']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_hr_checkout_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_hr_checkout_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_early_chkin']))
    {
        $this->nm_new_label['hosp_early_chkin'] = "Early CheckIn:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_early_chkin = $this->hosp_early_chkin;
   $sStyleHidden_hosp_early_chkin = '';
   if (isset($this->nmgp_cmp_hidden['hosp_early_chkin']) && $this->nmgp_cmp_hidden['hosp_early_chkin'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_early_chkin']);
       $sStyleHidden_hosp_early_chkin = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_early_chkin = 'display: none;';
   $sStyleReadInp_hosp_early_chkin = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_early_chkin']) && $this->nmgp_cmp_readonly['hosp_early_chkin'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_early_chkin']);
       $sStyleReadLab_hosp_early_chkin = '';
       $sStyleReadInp_hosp_early_chkin = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_early_chkin']) && $this->nmgp_cmp_hidden['hosp_early_chkin'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_early_chkin" value="<?php echo $this->form_encode_input($hosp_early_chkin) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_early_chkin_label" id="hidden_field_label_hosp_early_chkin" style="<?php echo $sStyleHidden_hosp_early_chkin; ?>"><span id="id_label_hosp_early_chkin"><?php echo $this->nm_new_label['hosp_early_chkin']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_early_chkin_line" id="hidden_field_data_hosp_early_chkin" style="<?php echo $sStyleHidden_hosp_early_chkin; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_early_chkin_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_early_chkin"]) &&  $this->nmgp_cmp_readonly["hosp_early_chkin"] == "on") { 

 if ("N" == $this->hosp_early_chkin) { $hosp_early_chkin_look = "Não";} 
 if ("Y" == $this->hosp_early_chkin) { $hosp_early_chkin_look = "Sim";} 
?>
<input type="hidden" name="hosp_early_chkin" value="<?php echo $this->form_encode_input($hosp_early_chkin) . "\">" . $hosp_early_chkin_look . ""; ?>
<?php } else { ?>

<?php

 if ("N" == $this->hosp_early_chkin) { $hosp_early_chkin_look = "Não";} 
 if ("Y" == $this->hosp_early_chkin) { $hosp_early_chkin_look = "Sim";} 
?>
<span id="id_read_on_hosp_early_chkin"  class="css_hosp_early_chkin_line" style="<?php echo $sStyleReadLab_hosp_early_chkin; ?>"><?php echo $this->form_format_readonly("hosp_early_chkin", $this->form_encode_input($hosp_early_chkin_look)); ?></span><span id="id_read_off_hosp_early_chkin" class="css_read_off_hosp_early_chkin css_hosp_early_chkin_line" style="<?php echo $sStyleReadInp_hosp_early_chkin; ?>"><div id="idAjaxRadio_hosp_early_chkin" style="display: inline-block"  class="css_hosp_early_chkin_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hosp_early_chkin_line"><?php $tempOptionId = "id-opt-hosp_early_chkin" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hosp_early_chkin sc-ui-radio-hosp_early_chkin" type=radio name="hosp_early_chkin" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_early_chkin'][] = 'N'; ?>
<?php  if ("N" == $this->hosp_early_chkin)  { echo " checked" ;} ?><?php  if (empty($this->hosp_early_chkin)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_hosp_early_chkin_line"><?php $tempOptionId = "id-opt-hosp_early_chkin" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hosp_early_chkin sc-ui-radio-hosp_early_chkin" type=radio name="hosp_early_chkin" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_early_chkin'][] = 'Y'; ?>
<?php  if ("Y" == $this->hosp_early_chkin)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_early_chkin_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_early_chkin_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['hospedagem_id']))
           {
               $this->nmgp_cmp_readonly['hospedagem_id'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['hosp_late_chkout']))
    {
        $this->nm_new_label['hosp_late_chkout'] = "Late CheckOut:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_late_chkout = $this->hosp_late_chkout;
   $sStyleHidden_hosp_late_chkout = '';
   if (isset($this->nmgp_cmp_hidden['hosp_late_chkout']) && $this->nmgp_cmp_hidden['hosp_late_chkout'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_late_chkout']);
       $sStyleHidden_hosp_late_chkout = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_late_chkout = 'display: none;';
   $sStyleReadInp_hosp_late_chkout = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_late_chkout']) && $this->nmgp_cmp_readonly['hosp_late_chkout'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_late_chkout']);
       $sStyleReadLab_hosp_late_chkout = '';
       $sStyleReadInp_hosp_late_chkout = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_late_chkout']) && $this->nmgp_cmp_hidden['hosp_late_chkout'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_late_chkout" value="<?php echo $this->form_encode_input($hosp_late_chkout) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_late_chkout_label" id="hidden_field_label_hosp_late_chkout" style="<?php echo $sStyleHidden_hosp_late_chkout; ?>"><span id="id_label_hosp_late_chkout"><?php echo $this->nm_new_label['hosp_late_chkout']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_late_chkout_line" id="hidden_field_data_hosp_late_chkout" style="<?php echo $sStyleHidden_hosp_late_chkout; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_late_chkout_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_late_chkout"]) &&  $this->nmgp_cmp_readonly["hosp_late_chkout"] == "on") { 

 if ("N" == $this->hosp_late_chkout) { $hosp_late_chkout_look = "Não";} 
 if ("Y" == $this->hosp_late_chkout) { $hosp_late_chkout_look = "Sim";} 
?>
<input type="hidden" name="hosp_late_chkout" value="<?php echo $this->form_encode_input($hosp_late_chkout) . "\">" . $hosp_late_chkout_look . ""; ?>
<?php } else { ?>

<?php

 if ("N" == $this->hosp_late_chkout) { $hosp_late_chkout_look = "Não";} 
 if ("Y" == $this->hosp_late_chkout) { $hosp_late_chkout_look = "Sim";} 
?>
<span id="id_read_on_hosp_late_chkout"  class="css_hosp_late_chkout_line" style="<?php echo $sStyleReadLab_hosp_late_chkout; ?>"><?php echo $this->form_format_readonly("hosp_late_chkout", $this->form_encode_input($hosp_late_chkout_look)); ?></span><span id="id_read_off_hosp_late_chkout" class="css_read_off_hosp_late_chkout css_hosp_late_chkout_line" style="<?php echo $sStyleReadInp_hosp_late_chkout; ?>"><div id="idAjaxRadio_hosp_late_chkout" style="display: inline-block"  class="css_hosp_late_chkout_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hosp_late_chkout_line"><?php $tempOptionId = "id-opt-hosp_late_chkout" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hosp_late_chkout sc-ui-radio-hosp_late_chkout" type=radio name="hosp_late_chkout" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_late_chkout'][] = 'N'; ?>
<?php  if ("N" == $this->hosp_late_chkout)  { echo " checked" ;} ?><?php  if (empty($this->hosp_late_chkout)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_hosp_late_chkout_line"><?php $tempOptionId = "id-opt-hosp_late_chkout" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hosp_late_chkout sc-ui-radio-hosp_late_chkout" type=radio name="hosp_late_chkout" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_late_chkout'][] = 'Y'; ?>
<?php  if ("Y" == $this->hosp_late_chkout)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_late_chkout_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_late_chkout_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['hospedagem_id']))
    {
        $this->nm_new_label['hospedagem_id'] = "Hospedagem Id";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hospedagem_id = $this->hospedagem_id;
   $sStyleHidden_hospedagem_id = '';
   if (isset($this->nmgp_cmp_hidden['hospedagem_id']) && $this->nmgp_cmp_hidden['hospedagem_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hospedagem_id']);
       $sStyleHidden_hospedagem_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hospedagem_id = 'display: none;';
   $sStyleReadInp_hospedagem_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["hospedagem_id"]) &&  $this->nmgp_cmp_readonly["hospedagem_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hospedagem_id']);
       $sStyleReadLab_hospedagem_id = '';
       $sStyleReadInp_hospedagem_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hospedagem_id']) && $this->nmgp_cmp_hidden['hospedagem_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hospedagem_id" value="<?php echo $this->form_encode_input($hospedagem_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hospedagem_id_label" id="hidden_field_label_hospedagem_id" style="<?php echo $sStyleHidden_hospedagem_id; ?>"><span id="id_label_hospedagem_id"><?php echo $this->nm_new_label['hospedagem_id']; ?></span></TD>
    <TD class="scFormDataOdd css_hospedagem_id_line" id="hidden_field_data_hospedagem_id" style="<?php echo $sStyleHidden_hospedagem_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hospedagem_id_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_hospedagem_id" class="css_hospedagem_id_line" style="<?php echo $sStyleReadLab_hospedagem_id; ?>"><?php echo $this->form_format_readonly("hospedagem_id", $this->form_encode_input($this->hospedagem_id)); ?></span><span id="id_read_off_hospedagem_id" class="css_read_off_hospedagem_id" style="<?php echo $sStyleReadInp_hospedagem_id; ?>"><input type="hidden" name="hospedagem_id" value="<?php echo $this->form_encode_input($hospedagem_id) . "\">"?><span id="id_ajax_label_hospedagem_id"><?php echo nl2br($hospedagem_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hospedagem_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hospedagem_id_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['hosp_id_evento']))
    {
        $this->nm_new_label['hosp_id_evento'] = "Evento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_id_evento = $this->hosp_id_evento;
   $sStyleHidden_hosp_id_evento = '';
   if (isset($this->nmgp_cmp_hidden['hosp_id_evento']) && $this->nmgp_cmp_hidden['hosp_id_evento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_id_evento']);
       $sStyleHidden_hosp_id_evento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_id_evento = 'display: none;';
   $sStyleReadInp_hosp_id_evento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_id_evento']) && $this->nmgp_cmp_readonly['hosp_id_evento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_id_evento']);
       $sStyleReadLab_hosp_id_evento = '';
       $sStyleReadInp_hosp_id_evento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_id_evento']) && $this->nmgp_cmp_hidden['hosp_id_evento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_id_evento" value="<?php echo $this->form_encode_input($hosp_id_evento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_id_evento_label" id="hidden_field_label_hosp_id_evento" style="<?php echo $sStyleHidden_hosp_id_evento; ?>"><span id="id_label_hosp_id_evento"><?php echo $this->nm_new_label['hosp_id_evento']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_id_evento_line" id="hidden_field_data_hosp_id_evento" style="<?php echo $sStyleHidden_hosp_id_evento; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_id_evento_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="hosp_id_evento" value="<?php echo $this->form_encode_input($hosp_id_evento); ?>"><span id="id_ajax_label_hosp_id_evento"><?php echo nl2br($hosp_id_evento); ?></span>
 <SPAN id="id_lookup_hosp_id_evento"><?php echo $look_rpc_hosp_id_evento; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_id_evento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_id_evento_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_cpf_participante']))
    {
        $this->nm_new_label['hosp_cpf_participante'] = "CPF Participante:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_cpf_participante = $this->hosp_cpf_participante;
   $sStyleHidden_hosp_cpf_participante = '';
   if (isset($this->nmgp_cmp_hidden['hosp_cpf_participante']) && $this->nmgp_cmp_hidden['hosp_cpf_participante'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_cpf_participante']);
       $sStyleHidden_hosp_cpf_participante = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_cpf_participante = 'display: none;';
   $sStyleReadInp_hosp_cpf_participante = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_cpf_participante']) && $this->nmgp_cmp_readonly['hosp_cpf_participante'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_cpf_participante']);
       $sStyleReadLab_hosp_cpf_participante = '';
       $sStyleReadInp_hosp_cpf_participante = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_cpf_participante']) && $this->nmgp_cmp_hidden['hosp_cpf_participante'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_cpf_participante" value="<?php echo $this->form_encode_input($hosp_cpf_participante) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_cpf_participante_label" id="hidden_field_label_hosp_cpf_participante" style="<?php echo $sStyleHidden_hosp_cpf_participante; ?>"><span id="id_label_hosp_cpf_participante"><?php echo $this->nm_new_label['hosp_cpf_participante']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_cpf_participante_line" id="hidden_field_data_hosp_cpf_participante" style="<?php echo $sStyleHidden_hosp_cpf_participante; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_cpf_participante_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="hosp_cpf_participante" value="<?php echo $this->form_encode_input($hosp_cpf_participante); ?>"><span id="id_ajax_label_hosp_cpf_participante"><?php echo nl2br($hosp_cpf_participante); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_cpf_participante_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_cpf_participante_text"></span></td></tr></table></td></tr></table></TD>
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
        $this->nm_new_label['tipo_pessoa'] = "Tipo Pessoa:";
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
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enviar_app sc-ui-radio-enviar_app" type=radio name="enviar_app" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_enviar_app'][] = 'Y'; ?>
<?php  if ("Y" == $this->enviar_app)  { echo " checked" ;} ?><?php  if (empty($this->enviar_app)) { echo " checked" ;} ?>  onClick="do_ajax_form_hospedagem_rsvp_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_enviar_app_line"><?php $tempOptionId = "id-opt-enviar_app" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enviar_app sc-ui-radio-enviar_app" type=radio name="enviar_app" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_enviar_app'][] = 'N'; ?>
<?php  if ("N" == $this->enviar_app)  { echo " checked" ;} ?>  onClick="do_ajax_form_hospedagem_rsvp_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
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
   if (!isset($this->nm_new_label['hosp_id_hotel']))
   {
       $this->nm_new_label['hosp_id_hotel'] = "Hotel:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_id_hotel = $this->hosp_id_hotel;
   $sStyleHidden_hosp_id_hotel = '';
   if (isset($this->nmgp_cmp_hidden['hosp_id_hotel']) && $this->nmgp_cmp_hidden['hosp_id_hotel'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_id_hotel']);
       $sStyleHidden_hosp_id_hotel = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_id_hotel = 'display: none;';
   $sStyleReadInp_hosp_id_hotel = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_id_hotel']) && $this->nmgp_cmp_readonly['hosp_id_hotel'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_id_hotel']);
       $sStyleReadLab_hosp_id_hotel = '';
       $sStyleReadInp_hosp_id_hotel = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_id_hotel']) && $this->nmgp_cmp_hidden['hosp_id_hotel'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_id_hotel" value="<?php echo $this->form_encode_input($this->hosp_id_hotel) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_id_hotel_label" id="hidden_field_label_hosp_id_hotel" style="<?php echo $sStyleHidden_hosp_id_hotel; ?>"><span id="id_label_hosp_id_hotel"><?php echo $this->nm_new_label['hosp_id_hotel']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['php_cmp_required']['hosp_id_hotel']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['php_cmp_required']['hosp_id_hotel'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_hosp_id_hotel_line" id="hidden_field_data_hosp_id_hotel" style="<?php echo $sStyleHidden_hosp_id_hotel; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_id_hotel_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_id_hotel"]) &&  $this->nmgp_cmp_readonly["hosp_id_hotel"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel'] = array(); 
    }

   $old_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $old_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $old_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $old_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $old_value_hospedagem_id = $this->hospedagem_id;
   $old_value_hosp_id_evento = $this->hosp_id_evento;
   $old_value_hosp_diarias = $this->hosp_diarias;
   $old_value_hosp_taxas = $this->hosp_taxas;
   $old_value_hosp_total = $this->hosp_total;
   $old_value_hosp_id_usuario = $this->hosp_id_usuario;
   $old_value_hosp_alteracao = $this->hosp_alteracao;
   $old_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $unformatted_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $unformatted_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $unformatted_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $unformatted_value_hospedagem_id = $this->hospedagem_id;
   $unformatted_value_hosp_id_evento = $this->hosp_id_evento;
   $unformatted_value_hosp_diarias = $this->hosp_diarias;
   $unformatted_value_hosp_taxas = $this->hosp_taxas;
   $unformatted_value_hosp_total = $this->hosp_total;
   $unformatted_value_hosp_id_usuario = $this->hosp_id_usuario;
   $unformatted_value_hosp_alteracao = $this->hosp_alteracao;
   $unformatted_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;

   $nm_comando = "SELECT 	tbl_hoteis.hotel_id, tbl_hoteis.hotel_fantasia  FROM 	tbl_hoteis LEFT JOIN	 	eventos_hoteis_rsvp ON  	tbl_hoteis.hotel_id = eventos_hoteis_rsvp.hotel_id WHERE 	eventos_hoteis_rsvp.evento_id = '" . $_SESSION['vg_evento_id'] . "'	 ORDER BY	 	eventos_hoteis_rsvp.evento_id, eventos_hoteis_rsvp.hotel_id";

   $this->hosp_dt_checkin = $old_value_hosp_dt_checkin;
   $this->hosp_dt_checkout = $old_value_hosp_dt_checkout;
   $this->hosp_hr_checkin = $old_value_hosp_hr_checkin;
   $this->hosp_hr_checkout = $old_value_hosp_hr_checkout;
   $this->hospedagem_id = $old_value_hospedagem_id;
   $this->hosp_id_evento = $old_value_hosp_id_evento;
   $this->hosp_diarias = $old_value_hosp_diarias;
   $this->hosp_taxas = $old_value_hosp_taxas;
   $this->hosp_total = $old_value_hosp_total;
   $this->hosp_id_usuario = $old_value_hosp_id_usuario;
   $this->hosp_alteracao = $old_value_hosp_alteracao;
   $this->hosp_alteracao_hora = $old_value_hosp_alteracao_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel'][] = $rs->fields[0];
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
   $hosp_id_hotel_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_id_hotel_1))
          {
              foreach ($this->hosp_id_hotel_1 as $tmp_hosp_id_hotel)
              {
                  if (trim($tmp_hosp_id_hotel) === trim($cadaselect[1])) {$hosp_id_hotel_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_id_hotel) && trim($this->hosp_id_hotel) === trim($cadaselect[1])) {$hosp_id_hotel_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="hosp_id_hotel" value="<?php echo $this->form_encode_input($hosp_id_hotel) . "\">" . $hosp_id_hotel_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hosp_id_hotel();
   $x = 0 ; 
   $hosp_id_hotel_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_id_hotel_1))
          {
              foreach ($this->hosp_id_hotel_1 as $tmp_hosp_id_hotel)
              {
                  if (trim($tmp_hosp_id_hotel) === trim($cadaselect[1])) {$hosp_id_hotel_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_id_hotel)) {
                 if (trim($this->hosp_id_hotel) == trim($cadaselect[1])) { $hosp_id_hotel_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->hosp_id_hotel == $cadaselect[1]) { $hosp_id_hotel_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($hosp_id_hotel_look))
          {
              $hosp_id_hotel_look = $this->hosp_id_hotel;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hosp_id_hotel\" class=\"css_hosp_id_hotel_line\" style=\"" .  $sStyleReadLab_hosp_id_hotel . "\">" . $this->form_format_readonly("hosp_id_hotel", $this->form_encode_input($hosp_id_hotel_look)) . "</span><span id=\"id_read_off_hosp_id_hotel\" class=\"css_read_off_hosp_id_hotel" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hosp_id_hotel . "\">";
   echo " <span id=\"idAjaxSelect_hosp_id_hotel\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hosp_id_hotel_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hosp_id_hotel\" name=\"hosp_id_hotel\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_id_hotel'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->hosp_id_hotel) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->hosp_id_hotel)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_id_hotel_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_id_hotel_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hosp_acomodacao']))
   {
       $this->nm_new_label['hosp_acomodacao'] = "Acomodação:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_acomodacao = $this->hosp_acomodacao;
   $sStyleHidden_hosp_acomodacao = '';
   if (isset($this->nmgp_cmp_hidden['hosp_acomodacao']) && $this->nmgp_cmp_hidden['hosp_acomodacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_acomodacao']);
       $sStyleHidden_hosp_acomodacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_acomodacao = 'display: none;';
   $sStyleReadInp_hosp_acomodacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_acomodacao']) && $this->nmgp_cmp_readonly['hosp_acomodacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_acomodacao']);
       $sStyleReadLab_hosp_acomodacao = '';
       $sStyleReadInp_hosp_acomodacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_acomodacao']) && $this->nmgp_cmp_hidden['hosp_acomodacao'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_acomodacao" value="<?php echo $this->form_encode_input($this->hosp_acomodacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_acomodacao_label" id="hidden_field_label_hosp_acomodacao" style="<?php echo $sStyleHidden_hosp_acomodacao; ?>"><span id="id_label_hosp_acomodacao"><?php echo $this->nm_new_label['hosp_acomodacao']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['php_cmp_required']['hosp_acomodacao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['php_cmp_required']['hosp_acomodacao'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_hosp_acomodacao_line" id="hidden_field_data_hosp_acomodacao" style="<?php echo $sStyleHidden_hosp_acomodacao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_acomodacao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_acomodacao"]) &&  $this->nmgp_cmp_readonly["hosp_acomodacao"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao'] = array(); 
    }

   $old_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $old_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $old_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $old_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $old_value_hospedagem_id = $this->hospedagem_id;
   $old_value_hosp_id_evento = $this->hosp_id_evento;
   $old_value_hosp_diarias = $this->hosp_diarias;
   $old_value_hosp_taxas = $this->hosp_taxas;
   $old_value_hosp_total = $this->hosp_total;
   $old_value_hosp_id_usuario = $this->hosp_id_usuario;
   $old_value_hosp_alteracao = $this->hosp_alteracao;
   $old_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $unformatted_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $unformatted_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $unformatted_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $unformatted_value_hospedagem_id = $this->hospedagem_id;
   $unformatted_value_hosp_id_evento = $this->hosp_id_evento;
   $unformatted_value_hosp_diarias = $this->hosp_diarias;
   $unformatted_value_hosp_taxas = $this->hosp_taxas;
   $unformatted_value_hosp_total = $this->hosp_total;
   $unformatted_value_hosp_id_usuario = $this->hosp_id_usuario;
   $unformatted_value_hosp_alteracao = $this->hosp_alteracao;
   $unformatted_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;

   $hosp_acompanhante_val_str = "''";
   if (!empty($this->hosp_acompanhante))
   {
       if (is_array($this->hosp_acompanhante))
       {
           $Tmp_array = $this->hosp_acompanhante;
       }
       else
       {
           $Tmp_array = explode(";", $this->hosp_acompanhante);
       }
       $hosp_acompanhante_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $hosp_acompanhante_val_str)
          {
             $hosp_acompanhante_val_str .= ", ";
          }
          $hosp_acompanhante_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $hosp_part_acomp_val_str = "''";
   if (!empty($this->hosp_part_acomp))
   {
       if (is_array($this->hosp_part_acomp))
       {
           $Tmp_array = $this->hosp_part_acomp;
       }
       else
       {
           $Tmp_array = explode(";", $this->hosp_part_acomp);
       }
       $hosp_part_acomp_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $hosp_part_acomp_val_str)
          {
             $hosp_part_acomp_val_str .= ", ";
          }
          $hosp_part_acomp_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT acomodacao_id, acomodacao_desc  FROM tbl_acomodacoes  ORDER BY acomodacao_desc";

   $this->hosp_dt_checkin = $old_value_hosp_dt_checkin;
   $this->hosp_dt_checkout = $old_value_hosp_dt_checkout;
   $this->hosp_hr_checkin = $old_value_hosp_hr_checkin;
   $this->hosp_hr_checkout = $old_value_hosp_hr_checkout;
   $this->hospedagem_id = $old_value_hospedagem_id;
   $this->hosp_id_evento = $old_value_hosp_id_evento;
   $this->hosp_diarias = $old_value_hosp_diarias;
   $this->hosp_taxas = $old_value_hosp_taxas;
   $this->hosp_total = $old_value_hosp_total;
   $this->hosp_id_usuario = $old_value_hosp_id_usuario;
   $this->hosp_alteracao = $old_value_hosp_alteracao;
   $this->hosp_alteracao_hora = $old_value_hosp_alteracao_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao'][] = $rs->fields[0];
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
   $hosp_acomodacao_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_acomodacao_1))
          {
              foreach ($this->hosp_acomodacao_1 as $tmp_hosp_acomodacao)
              {
                  if (trim($tmp_hosp_acomodacao) === trim($cadaselect[1])) {$hosp_acomodacao_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_acomodacao) && trim($this->hosp_acomodacao) === trim($cadaselect[1])) {$hosp_acomodacao_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="hosp_acomodacao" value="<?php echo $this->form_encode_input($hosp_acomodacao) . "\">" . $hosp_acomodacao_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hosp_acomodacao();
   $x = 0 ; 
   $hosp_acomodacao_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_acomodacao_1))
          {
              foreach ($this->hosp_acomodacao_1 as $tmp_hosp_acomodacao)
              {
                  if (trim($tmp_hosp_acomodacao) === trim($cadaselect[1])) {$hosp_acomodacao_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_acomodacao)) {
                 if (trim($this->hosp_acomodacao) == trim($cadaselect[1])) { $hosp_acomodacao_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->hosp_acomodacao == $cadaselect[1]) { $hosp_acomodacao_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($hosp_acomodacao_look))
          {
              $hosp_acomodacao_look = $this->hosp_acomodacao;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hosp_acomodacao\" class=\"css_hosp_acomodacao_line\" style=\"" .  $sStyleReadLab_hosp_acomodacao . "\">" . $this->form_format_readonly("hosp_acomodacao", $this->form_encode_input($hosp_acomodacao_look)) . "</span><span id=\"id_read_off_hosp_acomodacao\" class=\"css_read_off_hosp_acomodacao" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hosp_acomodacao . "\">";
   echo " <span id=\"idAjaxSelect_hosp_acomodacao\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hosp_acomodacao_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hosp_acomodacao\" name=\"hosp_acomodacao\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acomodacao'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->hosp_acomodacao) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->hosp_acomodacao)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_acomodacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_acomodacao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hosp_categoria']))
   {
       $this->nm_new_label['hosp_categoria'] = "Categoria:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_categoria = $this->hosp_categoria;
   $sStyleHidden_hosp_categoria = '';
   if (isset($this->nmgp_cmp_hidden['hosp_categoria']) && $this->nmgp_cmp_hidden['hosp_categoria'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_categoria']);
       $sStyleHidden_hosp_categoria = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_categoria = 'display: none;';
   $sStyleReadInp_hosp_categoria = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_categoria']) && $this->nmgp_cmp_readonly['hosp_categoria'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_categoria']);
       $sStyleReadLab_hosp_categoria = '';
       $sStyleReadInp_hosp_categoria = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_categoria']) && $this->nmgp_cmp_hidden['hosp_categoria'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_categoria" value="<?php echo $this->form_encode_input($this->hosp_categoria) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_categoria_label" id="hidden_field_label_hosp_categoria" style="<?php echo $sStyleHidden_hosp_categoria; ?>"><span id="id_label_hosp_categoria"><?php echo $this->nm_new_label['hosp_categoria']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['php_cmp_required']['hosp_categoria']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['php_cmp_required']['hosp_categoria'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_hosp_categoria_line" id="hidden_field_data_hosp_categoria" style="<?php echo $sStyleHidden_hosp_categoria; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_categoria_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_categoria"]) &&  $this->nmgp_cmp_readonly["hosp_categoria"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria'] = array(); 
    }

   $old_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $old_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $old_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $old_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $old_value_hospedagem_id = $this->hospedagem_id;
   $old_value_hosp_id_evento = $this->hosp_id_evento;
   $old_value_hosp_diarias = $this->hosp_diarias;
   $old_value_hosp_taxas = $this->hosp_taxas;
   $old_value_hosp_total = $this->hosp_total;
   $old_value_hosp_id_usuario = $this->hosp_id_usuario;
   $old_value_hosp_alteracao = $this->hosp_alteracao;
   $old_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $unformatted_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $unformatted_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $unformatted_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $unformatted_value_hospedagem_id = $this->hospedagem_id;
   $unformatted_value_hosp_id_evento = $this->hosp_id_evento;
   $unformatted_value_hosp_diarias = $this->hosp_diarias;
   $unformatted_value_hosp_taxas = $this->hosp_taxas;
   $unformatted_value_hosp_total = $this->hosp_total;
   $unformatted_value_hosp_id_usuario = $this->hosp_id_usuario;
   $unformatted_value_hosp_alteracao = $this->hosp_alteracao;
   $unformatted_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;

   $hosp_acompanhante_val_str = "''";
   if (!empty($this->hosp_acompanhante))
   {
       if (is_array($this->hosp_acompanhante))
       {
           $Tmp_array = $this->hosp_acompanhante;
       }
       else
       {
           $Tmp_array = explode(";", $this->hosp_acompanhante);
       }
       $hosp_acompanhante_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $hosp_acompanhante_val_str)
          {
             $hosp_acompanhante_val_str .= ", ";
          }
          $hosp_acompanhante_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $hosp_part_acomp_val_str = "''";
   if (!empty($this->hosp_part_acomp))
   {
       if (is_array($this->hosp_part_acomp))
       {
           $Tmp_array = $this->hosp_part_acomp;
       }
       else
       {
           $Tmp_array = explode(";", $this->hosp_part_acomp);
       }
       $hosp_part_acomp_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $hosp_part_acomp_val_str)
          {
             $hosp_part_acomp_val_str .= ", ";
          }
          $hosp_part_acomp_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT acomod_id, acomod_dsc  FROM tbl_categ_acomod  ORDER BY acomod_dsc";

   $this->hosp_dt_checkin = $old_value_hosp_dt_checkin;
   $this->hosp_dt_checkout = $old_value_hosp_dt_checkout;
   $this->hosp_hr_checkin = $old_value_hosp_hr_checkin;
   $this->hosp_hr_checkout = $old_value_hosp_hr_checkout;
   $this->hospedagem_id = $old_value_hospedagem_id;
   $this->hosp_id_evento = $old_value_hosp_id_evento;
   $this->hosp_diarias = $old_value_hosp_diarias;
   $this->hosp_taxas = $old_value_hosp_taxas;
   $this->hosp_total = $old_value_hosp_total;
   $this->hosp_id_usuario = $old_value_hosp_id_usuario;
   $this->hosp_alteracao = $old_value_hosp_alteracao;
   $this->hosp_alteracao_hora = $old_value_hosp_alteracao_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria'][] = $rs->fields[0];
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
   $hosp_categoria_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_categoria_1))
          {
              foreach ($this->hosp_categoria_1 as $tmp_hosp_categoria)
              {
                  if (trim($tmp_hosp_categoria) === trim($cadaselect[1])) {$hosp_categoria_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_categoria) && trim($this->hosp_categoria) === trim($cadaselect[1])) {$hosp_categoria_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="hosp_categoria" value="<?php echo $this->form_encode_input($hosp_categoria) . "\">" . $hosp_categoria_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hosp_categoria();
   $x = 0 ; 
   $hosp_categoria_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_categoria_1))
          {
              foreach ($this->hosp_categoria_1 as $tmp_hosp_categoria)
              {
                  if (trim($tmp_hosp_categoria) === trim($cadaselect[1])) {$hosp_categoria_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_categoria)) {
                 if (trim($this->hosp_categoria) == trim($cadaselect[1])) { $hosp_categoria_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->hosp_categoria == $cadaselect[1]) { $hosp_categoria_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($hosp_categoria_look))
          {
              $hosp_categoria_look = $this->hosp_categoria;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hosp_categoria\" class=\"css_hosp_categoria_line\" style=\"" .  $sStyleReadLab_hosp_categoria . "\">" . $this->form_format_readonly("hosp_categoria", $this->form_encode_input($hosp_categoria_look)) . "</span><span id=\"id_read_off_hosp_categoria\" class=\"css_read_off_hosp_categoria" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hosp_categoria . "\">";
   echo " <span id=\"idAjaxSelect_hosp_categoria\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hosp_categoria_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hosp_categoria\" name=\"hosp_categoria\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_categoria'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->hosp_categoria) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->hosp_categoria)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_categoria_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_categoria_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hosp_status']))
   {
       $this->nm_new_label['hosp_status'] = "Status:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_status = $this->hosp_status;
   $sStyleHidden_hosp_status = '';
   if (isset($this->nmgp_cmp_hidden['hosp_status']) && $this->nmgp_cmp_hidden['hosp_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_status']);
       $sStyleHidden_hosp_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_status = 'display: none;';
   $sStyleReadInp_hosp_status = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_status']) && $this->nmgp_cmp_readonly['hosp_status'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_status']);
       $sStyleReadLab_hosp_status = '';
       $sStyleReadInp_hosp_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_status']) && $this->nmgp_cmp_hidden['hosp_status'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_status" value="<?php echo $this->form_encode_input($this->hosp_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_status_label" id="hidden_field_label_hosp_status" style="<?php echo $sStyleHidden_hosp_status; ?>"><span id="id_label_hosp_status"><?php echo $this->nm_new_label['hosp_status']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_status_line" id="hidden_field_data_hosp_status" style="<?php echo $sStyleHidden_hosp_status; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_status_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_status"]) &&  $this->nmgp_cmp_readonly["hosp_status"] == "on") { 

$hosp_status_look = "";
 if ($this->hosp_status == "A") { $hosp_status_look .= "Aberto" ;} 
 if ($this->hosp_status == "Y") { $hosp_status_look .= "Sim" ;} 
 if ($this->hosp_status == "N") { $hosp_status_look .= "Não" ;} 
 if ($this->hosp_status == "P") { $hosp_status_look .= "Pendente" ;} 
 if (empty($hosp_status_look)) { $hosp_status_look = $this->hosp_status; }
?>
<input type="hidden" name="hosp_status" value="<?php echo $this->form_encode_input($hosp_status) . "\">" . $hosp_status_look . ""; ?>
<?php } else { ?>
<?php

$hosp_status_look = "";
 if ($this->hosp_status == "A") { $hosp_status_look .= "Aberto" ;} 
 if ($this->hosp_status == "Y") { $hosp_status_look .= "Sim" ;} 
 if ($this->hosp_status == "N") { $hosp_status_look .= "Não" ;} 
 if ($this->hosp_status == "P") { $hosp_status_look .= "Pendente" ;} 
 if (empty($hosp_status_look)) { $hosp_status_look = $this->hosp_status; }
?>
<span id="id_read_on_hosp_status" class="css_hosp_status_line"  style="<?php echo $sStyleReadLab_hosp_status; ?>"><?php echo $this->form_format_readonly("hosp_status", $this->form_encode_input($hosp_status_look)); ?></span><span id="id_read_off_hosp_status" class="css_read_off_hosp_status<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_hosp_status; ?>">
 <span id="idAjaxSelect_hosp_status" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_hosp_status_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_status" name="hosp_status" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="A" <?php  if ($this->hosp_status == "A") { echo " selected" ;} ?><?php  if (empty($this->hosp_status)) { echo " selected" ;} ?>>Aberto</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_status'][] = 'A'; ?>
 <option  value="Y" <?php  if ($this->hosp_status == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_status'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->hosp_status == "N") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_status'][] = 'N'; ?>
 <option  value="P" <?php  if ($this->hosp_status == "P") { echo " selected" ;} ?>>Pendente</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_status'][] = 'P'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_status_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hosp_part_acomp']))
   {
       $this->nm_new_label['hosp_part_acomp'] = "Outro(s) Participante(s) acompanhando (Mesmo Quarto):";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_part_acomp = $this->hosp_part_acomp;
   $sStyleHidden_hosp_part_acomp = '';
   if (isset($this->nmgp_cmp_hidden['hosp_part_acomp']) && $this->nmgp_cmp_hidden['hosp_part_acomp'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_part_acomp']);
       $sStyleHidden_hosp_part_acomp = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_part_acomp = 'display: none;';
   $sStyleReadInp_hosp_part_acomp = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_part_acomp']) && $this->nmgp_cmp_readonly['hosp_part_acomp'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_part_acomp']);
       $sStyleReadLab_hosp_part_acomp = '';
       $sStyleReadInp_hosp_part_acomp = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_part_acomp']) && $this->nmgp_cmp_hidden['hosp_part_acomp'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_part_acomp" value="<?php echo $this->form_encode_input($this->hosp_part_acomp) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php  $this->hosp_part_acomp_1 = explode(";", trim($this->hosp_part_acomp)) ; ?>
    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_part_acomp_label" id="hidden_field_label_hosp_part_acomp" style="<?php echo $sStyleHidden_hosp_part_acomp; ?>"><span id="id_label_hosp_part_acomp"><?php echo $this->nm_new_label['hosp_part_acomp']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_part_acomp_line" id="hidden_field_data_hosp_part_acomp" style="<?php echo $sStyleHidden_hosp_part_acomp; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_part_acomp_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_part_acomp"]) &&  $this->nmgp_cmp_readonly["hosp_part_acomp"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_part_acomp']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_part_acomp'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_part_acomp']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_part_acomp'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_part_acomp']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_part_acomp'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_part_acomp']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_part_acomp'] = array(); 
    }

   $old_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $old_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $old_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $old_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $old_value_hospedagem_id = $this->hospedagem_id;
   $old_value_hosp_id_evento = $this->hosp_id_evento;
   $old_value_hosp_diarias = $this->hosp_diarias;
   $old_value_hosp_taxas = $this->hosp_taxas;
   $old_value_hosp_total = $this->hosp_total;
   $old_value_hosp_id_usuario = $this->hosp_id_usuario;
   $old_value_hosp_alteracao = $this->hosp_alteracao;
   $old_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $unformatted_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $unformatted_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $unformatted_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $unformatted_value_hospedagem_id = $this->hospedagem_id;
   $unformatted_value_hosp_id_evento = $this->hosp_id_evento;
   $unformatted_value_hosp_diarias = $this->hosp_diarias;
   $unformatted_value_hosp_taxas = $this->hosp_taxas;
   $unformatted_value_hosp_total = $this->hosp_total;
   $unformatted_value_hosp_id_usuario = $this->hosp_id_usuario;
   $unformatted_value_hosp_alteracao = $this->hosp_alteracao;
   $unformatted_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;

   $nm_comando = "SELECT CONCAT(nome_pessoa, SPACE(2), 'CPF:', SPACE(2), part_cpf, SPACE(2), 'RG:', SPACE(2), CASE WHEN TRIM(COALESCE(part_rg,'')) = '' THEN '* NC *' ELSE part_rg END, SPACE(2), 'Passaporte:', SPACE(2), CASE WHEN TRIM(COALESCE(part_passaporte,'')) = '' THEN '* NC *' ELSE part_passaporte END), nome_pessoa FROM participantes_rsvp WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY nome_pessoa";

   $this->hosp_dt_checkin = $old_value_hosp_dt_checkin;
   $this->hosp_dt_checkout = $old_value_hosp_dt_checkout;
   $this->hosp_hr_checkin = $old_value_hosp_hr_checkin;
   $this->hosp_hr_checkout = $old_value_hosp_hr_checkout;
   $this->hospedagem_id = $old_value_hospedagem_id;
   $this->hosp_id_evento = $old_value_hosp_id_evento;
   $this->hosp_diarias = $old_value_hosp_diarias;
   $this->hosp_taxas = $old_value_hosp_taxas;
   $this->hosp_total = $old_value_hosp_total;
   $this->hosp_id_usuario = $old_value_hosp_id_usuario;
   $this->hosp_alteracao = $old_value_hosp_alteracao;
   $this->hosp_alteracao_hora = $old_value_hosp_alteracao_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_part_acomp'][] = $rs->fields[0];
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
   $hosp_part_acomp_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_part_acomp_1))
          {
              foreach ($this->hosp_part_acomp_1 as $tmp_hosp_part_acomp)
              {
                  if (trim($tmp_hosp_part_acomp) === trim($cadaselect[1])) {$hosp_part_acomp_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_part_acomp) && trim($this->hosp_part_acomp) === trim($cadaselect[1])) {$hosp_part_acomp_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="hosp_part_acomp" value="<?php echo $this->form_encode_input($hosp_part_acomp) . "\">" . $hosp_part_acomp_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hosp_part_acomp();
   $x = 0 ; 
   $hosp_part_acomp_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_part_acomp_1))
          {
              foreach ($this->hosp_part_acomp_1 as $tmp_hosp_part_acomp)
              {
                  if (trim($tmp_hosp_part_acomp) === trim($cadaselect[1])) {$hosp_part_acomp_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_part_acomp)) {
                 if (trim($this->hosp_part_acomp) == trim($cadaselect[1])) { $hosp_part_acomp_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->hosp_part_acomp == $cadaselect[1]) { $hosp_part_acomp_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($hosp_part_acomp_look))
          {
              $hosp_part_acomp_look = $this->hosp_part_acomp;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hosp_part_acomp\" class=\"css_hosp_part_acomp_line\" style=\"" .  $sStyleReadLab_hosp_part_acomp . "\">" . $this->form_format_readonly("hosp_part_acomp", $this->form_encode_input($hosp_part_acomp_look)) . "</span><span id=\"id_read_off_hosp_part_acomp\" class=\"css_read_off_hosp_part_acomp" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hosp_part_acomp . "\">";
   echo "<table class=\"scDoubleSelect\" style=\"display: inline-block\"><tr><td>" ; 
   echo " <span id=\"idAjaxSelect_hosp_part_acomp\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hosp_part_acomp_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hosp_part_acomp\" name=\"hosp_part_acomp_orig\" size=\"7\" multiple onDblClick=\"nm_add_sel(event, 'hosp_part_acomp_orig', 'hosp_part_acomp_dest', null); do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange(); \" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          foreach ($this->hosp_part_acomp_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  echo " disabled=\"disabled\" style=\"color: #A0A0A0\"";
                  break;
              }
          }
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "</td>";
   echo "<td align=\"center\">";
   echo "<div class='scBtnPassField' id='hosp_part_acomp_all_right'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_rightall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_rightall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_rightall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_rightall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_rightall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_rightall", "nm_add_all('hosp_part_acomp_orig', 'hosp_part_acomp_dest', null);  do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange();  return false;", "nm_add_all('hosp_part_acomp_orig', 'hosp_part_acomp_dest', null);  do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange();  return false;", "Bbpassfld_rightall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_right']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_right']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_right']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_right']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_right'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_right", "nm_add_sel('Click', 'hosp_part_acomp_orig', 'hosp_part_acomp_dest', null);  do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange();  return false;", "nm_add_sel('Click', 'hosp_part_acomp_orig', 'hosp_part_acomp_dest', null);  do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange();  return false;", "Bbpassfld_righ", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_left']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_left']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_left']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_left']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_left'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_left", "nm_del_sel('Click',  'hosp_part_acomp_dest', 'hosp_part_acomp_orig', null);  do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange();  return false;", "nm_del_sel('Click',  'hosp_part_acomp_dest', 'hosp_part_acomp_orig', null);  do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange();  return false;", "Bbpassfld_left", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField' id='hosp_part_acomp_all_left'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_leftall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_leftall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_leftall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_leftall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_leftall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_leftall", "nm_del_all('hosp_part_acomp_dest', 'hosp_part_acomp_orig', null);  do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange();  return false;", "nm_del_all('hosp_part_acomp_dest', 'hosp_part_acomp_orig', null);  do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange();  return false;", "Bbpassfld_leftall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
;
   echo "</div>";
   echo "</td>";
   echo "<td>";
   echo " <select class=\"sc-js-input scFormObjectOdd css_hosp_part_acomp_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" name=\"hosp_part_acomp_dest\"  onBlur=\"scCssBlur(this);\"  onFocus=\"scCssFocus(this);\"  size=7 multiple onDblClick=\"nm_del_sel(event, 'hosp_part_acomp_dest', 'hosp_part_acomp_orig', null); do_ajax_form_hospedagem_rsvp_event_hosp_part_acomp_onchange(); \" alt=\"{type: 'select', enterTab: false}\">";
   $x = 0 ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->hosp_part_acomp_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  echo "  <option value=\"$cadaselect[1]\" selected>" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>"; 
                  break;
              }
          }
          $x++ ; 
   }  ; 
   echo " </select>" ; 
   echo " <input type=\"hidden\" name=\"hosp_part_acomp\" value=\"\">" ; 
   echo "</td></tr></table>";
   echo " <script>document.F1.hosp_part_acomp_dest.selectedIndex = -1;</script>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_part_acomp_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_part_acomp_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hosp_qtd_acompanhante']))
   {
       $this->nm_new_label['hosp_qtd_acompanhante'] = "Qtd. Acompanhante:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_qtd_acompanhante = $this->hosp_qtd_acompanhante;
   $sStyleHidden_hosp_qtd_acompanhante = '';
   if (isset($this->nmgp_cmp_hidden['hosp_qtd_acompanhante']) && $this->nmgp_cmp_hidden['hosp_qtd_acompanhante'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_qtd_acompanhante']);
       $sStyleHidden_hosp_qtd_acompanhante = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_qtd_acompanhante = 'display: none;';
   $sStyleReadInp_hosp_qtd_acompanhante = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_qtd_acompanhante']) && $this->nmgp_cmp_readonly['hosp_qtd_acompanhante'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_qtd_acompanhante']);
       $sStyleReadLab_hosp_qtd_acompanhante = '';
       $sStyleReadInp_hosp_qtd_acompanhante = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_qtd_acompanhante']) && $this->nmgp_cmp_hidden['hosp_qtd_acompanhante'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_qtd_acompanhante" value="<?php echo $this->form_encode_input($this->hosp_qtd_acompanhante) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_qtd_acompanhante_label" id="hidden_field_label_hosp_qtd_acompanhante" style="<?php echo $sStyleHidden_hosp_qtd_acompanhante; ?>"><span id="id_label_hosp_qtd_acompanhante"><?php echo $this->nm_new_label['hosp_qtd_acompanhante']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['php_cmp_required']['hosp_qtd_acompanhante']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['php_cmp_required']['hosp_qtd_acompanhante'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_hosp_qtd_acompanhante_line" id="hidden_field_data_hosp_qtd_acompanhante" style="<?php echo $sStyleHidden_hosp_qtd_acompanhante; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_qtd_acompanhante_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_qtd_acompanhante"]) &&  $this->nmgp_cmp_readonly["hosp_qtd_acompanhante"] == "on") { 

$hosp_qtd_acompanhante_look = "";
 if ($this->hosp_qtd_acompanhante == "SEM ACOMPANHANTE") { $hosp_qtd_acompanhante_look .= "SEM ACOMPANHANTE" ;} 
 if ($this->hosp_qtd_acompanhante == "UM ACOMPANHANTE MESMO QUARTO") { $hosp_qtd_acompanhante_look .= "UM ACOMPANHANTE MESMO QUARTO" ;} 
 if ($this->hosp_qtd_acompanhante == "MAIS  DE UM ACOMPANHANTE MESMO QUARTO") { $hosp_qtd_acompanhante_look .= "MAIS  DE UM ACOMPANHANTE MESMO QUARTO" ;} 
 if (empty($hosp_qtd_acompanhante_look)) { $hosp_qtd_acompanhante_look = $this->hosp_qtd_acompanhante; }
?>
<input type="hidden" name="hosp_qtd_acompanhante" value="<?php echo $this->form_encode_input($hosp_qtd_acompanhante) . "\">" . $hosp_qtd_acompanhante_look . ""; ?>
<?php } else { ?>
<?php

$hosp_qtd_acompanhante_look = "";
 if ($this->hosp_qtd_acompanhante == "SEM ACOMPANHANTE") { $hosp_qtd_acompanhante_look .= "SEM ACOMPANHANTE" ;} 
 if ($this->hosp_qtd_acompanhante == "UM ACOMPANHANTE MESMO QUARTO") { $hosp_qtd_acompanhante_look .= "UM ACOMPANHANTE MESMO QUARTO" ;} 
 if ($this->hosp_qtd_acompanhante == "MAIS  DE UM ACOMPANHANTE MESMO QUARTO") { $hosp_qtd_acompanhante_look .= "MAIS  DE UM ACOMPANHANTE MESMO QUARTO" ;} 
 if (empty($hosp_qtd_acompanhante_look)) { $hosp_qtd_acompanhante_look = $this->hosp_qtd_acompanhante; }
?>
<span id="id_read_on_hosp_qtd_acompanhante" class="css_hosp_qtd_acompanhante_line"  style="<?php echo $sStyleReadLab_hosp_qtd_acompanhante; ?>"><?php echo $this->form_format_readonly("hosp_qtd_acompanhante", $this->form_encode_input($hosp_qtd_acompanhante_look)); ?></span><span id="id_read_off_hosp_qtd_acompanhante" class="css_read_off_hosp_qtd_acompanhante<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_hosp_qtd_acompanhante; ?>">
 <span id="idAjaxSelect_hosp_qtd_acompanhante" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_hosp_qtd_acompanhante_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_qtd_acompanhante" name="hosp_qtd_acompanhante" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="SEM ACOMPANHANTE" <?php  if ($this->hosp_qtd_acompanhante == "SEM ACOMPANHANTE") { echo " selected" ;} ?><?php  if (empty($this->hosp_qtd_acompanhante)) { echo " selected" ;} ?>>SEM ACOMPANHANTE</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_qtd_acompanhante'][] = 'SEM ACOMPANHANTE'; ?>
 <option  value="UM ACOMPANHANTE MESMO QUARTO" <?php  if ($this->hosp_qtd_acompanhante == "UM ACOMPANHANTE MESMO QUARTO") { echo " selected" ;} ?>>UM ACOMPANHANTE MESMO QUARTO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_qtd_acompanhante'][] = 'UM ACOMPANHANTE MESMO QUARTO'; ?>
 <option  value="MAIS  DE UM ACOMPANHANTE MESMO QUARTO" <?php  if ($this->hosp_qtd_acompanhante == "MAIS  DE UM ACOMPANHANTE MESMO QUARTO") { echo " selected" ;} ?>>MAIS  DE UM ACOMPANHANTE MESMO QUARTO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_qtd_acompanhante'][] = 'MAIS  DE UM ACOMPANHANTE MESMO QUARTO'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_qtd_acompanhante_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_qtd_acompanhante_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hosp_acompanhante']))
   {
       $this->nm_new_label['hosp_acompanhante'] = "Acompanhante(s):";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_acompanhante = $this->hosp_acompanhante;
   $sStyleHidden_hosp_acompanhante = '';
   if (isset($this->nmgp_cmp_hidden['hosp_acompanhante']) && $this->nmgp_cmp_hidden['hosp_acompanhante'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_acompanhante']);
       $sStyleHidden_hosp_acompanhante = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_acompanhante = 'display: none;';
   $sStyleReadInp_hosp_acompanhante = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_acompanhante']) && $this->nmgp_cmp_readonly['hosp_acompanhante'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_acompanhante']);
       $sStyleReadLab_hosp_acompanhante = '';
       $sStyleReadInp_hosp_acompanhante = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_acompanhante']) && $this->nmgp_cmp_hidden['hosp_acompanhante'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_acompanhante" value="<?php echo $this->form_encode_input($this->hosp_acompanhante) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php  $this->hosp_acompanhante_1 = explode(";", trim($this->hosp_acompanhante)) ; ?>
    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_acompanhante_label" id="hidden_field_label_hosp_acompanhante" style="<?php echo $sStyleHidden_hosp_acompanhante; ?>"><span id="id_label_hosp_acompanhante"><?php echo $this->nm_new_label['hosp_acompanhante']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_acompanhante_line" id="hidden_field_data_hosp_acompanhante" style="<?php echo $sStyleHidden_hosp_acompanhante; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_acompanhante_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_acompanhante"]) &&  $this->nmgp_cmp_readonly["hosp_acompanhante"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acompanhante']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acompanhante'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acompanhante']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acompanhante'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acompanhante']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acompanhante'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acompanhante']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acompanhante'] = array(); 
    }

   $old_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $old_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $old_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $old_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $old_value_hospedagem_id = $this->hospedagem_id;
   $old_value_hosp_id_evento = $this->hosp_id_evento;
   $old_value_hosp_diarias = $this->hosp_diarias;
   $old_value_hosp_taxas = $this->hosp_taxas;
   $old_value_hosp_total = $this->hosp_total;
   $old_value_hosp_id_usuario = $this->hosp_id_usuario;
   $old_value_hosp_alteracao = $this->hosp_alteracao;
   $old_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $unformatted_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $unformatted_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $unformatted_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $unformatted_value_hospedagem_id = $this->hospedagem_id;
   $unformatted_value_hosp_id_evento = $this->hosp_id_evento;
   $unformatted_value_hosp_diarias = $this->hosp_diarias;
   $unformatted_value_hosp_taxas = $this->hosp_taxas;
   $unformatted_value_hosp_total = $this->hosp_total;
   $unformatted_value_hosp_id_usuario = $this->hosp_id_usuario;
   $unformatted_value_hosp_alteracao = $this->hosp_alteracao;
   $unformatted_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;

   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   {
       $nm_comando = "SELECT part_nome + '  CPF:  ' + part_cpf + '  RG:  ' + part_rg + '   Passaporte:   ' + part_passaporte,part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome, part_id_evento";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   {
       $nm_comando = "SELECT concat(part_nome,'  CPF:  ',part_cpf,'  RG:  ',part_rg,'   Passaporte:   ',part_passaporte),part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome, part_id_evento";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
   {
       $nm_comando = "SELECT part_nome&'  CPF:  '&part_cpf&'  RG:  '&part_rg&'   Passaporte:   '&part_passaporte,part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome, part_id_evento";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
   {
       $nm_comando = "SELECT part_nome||'  CPF:  '||part_cpf||'  RG:  '||part_rg||'   Passaporte:   '||part_passaporte,part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome, part_id_evento";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   {
       $nm_comando = "SELECT part_nome + '  CPF:  ' + part_cpf + '  RG:  ' + part_rg + '   Passaporte:   ' + part_passaporte,part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome, part_id_evento";
   }
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
   {
       $nm_comando = "SELECT part_nome||'  CPF:  '||part_cpf||'  RG:  '||part_rg||'   Passaporte:   '||part_passaporte,part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome, part_id_evento";
   }
   else
   {
       $nm_comando = "SELECT part_nome||'  CPF:  '||part_cpf||'  RG:  '||part_rg||'   Passaporte:   '||part_passaporte,part_nome FROM acompanhantes_rsvp  WHERE part_id_evento = '" . $_SESSION['vg_evento_id'] . "' AND part_ativo = 'Y' AND part_substituido = 'N' AND part_cpf <> '" . $_SESSION['vg_cpf'] . "' ORDER BY part_nome, part_id_evento";
   }

   $this->hosp_dt_checkin = $old_value_hosp_dt_checkin;
   $this->hosp_dt_checkout = $old_value_hosp_dt_checkout;
   $this->hosp_hr_checkin = $old_value_hosp_hr_checkin;
   $this->hosp_hr_checkout = $old_value_hosp_hr_checkout;
   $this->hospedagem_id = $old_value_hospedagem_id;
   $this->hosp_id_evento = $old_value_hosp_id_evento;
   $this->hosp_diarias = $old_value_hosp_diarias;
   $this->hosp_taxas = $old_value_hosp_taxas;
   $this->hosp_total = $old_value_hosp_total;
   $this->hosp_id_usuario = $old_value_hosp_id_usuario;
   $this->hosp_alteracao = $old_value_hosp_alteracao;
   $this->hosp_alteracao_hora = $old_value_hosp_alteracao_hora;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_acompanhante'][] = $rs->fields[0];
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
   $hosp_acompanhante_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->hosp_acompanhante_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  $hosp_acompanhante_look .= $cadaselect[0] . "&nbsp;";
                  break;
              }
          }
          $x++; 
   }

?>
<input type="hidden" name="hosp_acompanhante" value="<?php echo $this->form_encode_input($hosp_acompanhante) . "\">" . $hosp_acompanhante_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hosp_acompanhante();
   $x = 0 ; 
   $hosp_acompanhante_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->hosp_acompanhante_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  $hosp_acompanhante_look .= $cadaselect[0] . "<br>";
                  break;
              }
          }
          $x++; 
   }
          if (empty($hosp_acompanhante_look))
          {
              $hosp_acompanhante_look = $this->hosp_acompanhante;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hosp_acompanhante\" class=\"css_hosp_acompanhante_line\" style=\"" .  $sStyleReadLab_hosp_acompanhante . "\">" . $this->form_format_readonly("hosp_acompanhante", $this->form_encode_input($hosp_acompanhante_look)) . "</span><span id=\"id_read_off_hosp_acompanhante\" class=\"css_read_off_hosp_acompanhante" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hosp_acompanhante . "\">";
   echo "<table class=\"scDoubleSelect\" style=\"display: inline-block\"><tr><td>" ; 
   echo " <span id=\"idAjaxSelect_hosp_acompanhante\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hosp_acompanhante_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hosp_acompanhante\" name=\"hosp_acompanhante_orig\" size=\"7\" multiple onDblClick=\"nm_add_sel(event, 'hosp_acompanhante_orig', 'hosp_acompanhante_dest', null); do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange(); \" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          foreach ($this->hosp_acompanhante_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  echo " disabled=\"disabled\" style=\"color: #A0A0A0\"";
                  break;
              }
          }
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "</td>";
   echo "<td align=\"center\">";
   echo "<div class='scBtnPassField' id='hosp_acompanhante_all_right'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_rightall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_rightall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_rightall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_rightall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_rightall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_rightall", "nm_add_all('hosp_acompanhante_orig', 'hosp_acompanhante_dest', null);  do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange();  return false;", "nm_add_all('hosp_acompanhante_orig', 'hosp_acompanhante_dest', null);  do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange();  return false;", "Bbpassfld_rightall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_right']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_right']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_right']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_right']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_right'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_right", "nm_add_sel('Click', 'hosp_acompanhante_orig', 'hosp_acompanhante_dest', null);  do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange();  return false;", "nm_add_sel('Click', 'hosp_acompanhante_orig', 'hosp_acompanhante_dest', null);  do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange();  return false;", "Bbpassfld_righ", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_left']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_left']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_left']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_left']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_left'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_left", "nm_del_sel('Click',  'hosp_acompanhante_dest', 'hosp_acompanhante_orig', null);  do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange();  return false;", "nm_del_sel('Click',  'hosp_acompanhante_dest', 'hosp_acompanhante_orig', null);  do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange();  return false;", "Bbpassfld_left", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
;
   echo "</div>";
   echo "<div class='scBtnPassField' id='hosp_acompanhante_all_left'>";
   echo         $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_leftall']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['bpassfld_leftall']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_leftall']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_leftall']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['bpassfld_leftall'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bpassfld_leftall", "nm_del_all('hosp_acompanhante_dest', 'hosp_acompanhante_orig', null);  do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange();  return false;", "nm_del_all('hosp_acompanhante_dest', 'hosp_acompanhante_orig', null);  do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange();  return false;", "Bbpassfld_leftall", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
;
   echo "</div>";
   echo "</td>";
   echo "<td>";
   echo " <select class=\"sc-js-input scFormObjectOdd css_hosp_acompanhante_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" name=\"hosp_acompanhante_dest\"  onBlur=\"scCssBlur(this);\"  onFocus=\"scCssFocus(this);\"  size=7 multiple onDblClick=\"nm_del_sel(event, 'hosp_acompanhante_dest', 'hosp_acompanhante_orig', null); do_ajax_form_hospedagem_rsvp_event_hosp_acompanhante_onchange(); \" alt=\"{type: 'select', enterTab: false}\">";
   $x = 0 ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          foreach ($this->hosp_acompanhante_1 as $Dados)
          {
              if ($Dados === $cadaselect[1])
              {
                  echo "  <option value=\"$cadaselect[1]\" selected>" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>"; 
                  break;
              }
          }
          $x++ ; 
   }  ; 
   echo " </select>" ; 
   echo " <input type=\"hidden\" name=\"hosp_acompanhante\" value=\"\">" ; 
   echo "</td></tr></table>";
   echo " <script>document.F1.hosp_acompanhante_dest.selectedIndex = -1;</script>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_acompanhante_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_acompanhante_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hosp_reserva_bvt']))
   {
       $this->nm_new_label['hosp_reserva_bvt'] = "Comprado c/Belvitur:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_reserva_bvt = $this->hosp_reserva_bvt;
   $sStyleHidden_hosp_reserva_bvt = '';
   if (isset($this->nmgp_cmp_hidden['hosp_reserva_bvt']) && $this->nmgp_cmp_hidden['hosp_reserva_bvt'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_reserva_bvt']);
       $sStyleHidden_hosp_reserva_bvt = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_reserva_bvt = 'display: none;';
   $sStyleReadInp_hosp_reserva_bvt = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_reserva_bvt']) && $this->nmgp_cmp_readonly['hosp_reserva_bvt'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_reserva_bvt']);
       $sStyleReadLab_hosp_reserva_bvt = '';
       $sStyleReadInp_hosp_reserva_bvt = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_reserva_bvt']) && $this->nmgp_cmp_hidden['hosp_reserva_bvt'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_reserva_bvt" value="<?php echo $this->form_encode_input($this->hosp_reserva_bvt) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_reserva_bvt_label" id="hidden_field_label_hosp_reserva_bvt" style="<?php echo $sStyleHidden_hosp_reserva_bvt; ?>"><span id="id_label_hosp_reserva_bvt"><?php echo $this->nm_new_label['hosp_reserva_bvt']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_reserva_bvt_line" id="hidden_field_data_hosp_reserva_bvt" style="<?php echo $sStyleHidden_hosp_reserva_bvt; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_reserva_bvt_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_reserva_bvt"]) &&  $this->nmgp_cmp_readonly["hosp_reserva_bvt"] == "on") { 

$hosp_reserva_bvt_look = "";
 if ($this->hosp_reserva_bvt == "Y") { $hosp_reserva_bvt_look .= "Sim" ;} 
 if ($this->hosp_reserva_bvt == "N") { $hosp_reserva_bvt_look .= "Não" ;} 
 if (empty($hosp_reserva_bvt_look)) { $hosp_reserva_bvt_look = $this->hosp_reserva_bvt; }
?>
<input type="hidden" name="hosp_reserva_bvt" value="<?php echo $this->form_encode_input($hosp_reserva_bvt) . "\">" . $hosp_reserva_bvt_look . ""; ?>
<?php } else { ?>
<?php

$hosp_reserva_bvt_look = "";
 if ($this->hosp_reserva_bvt == "Y") { $hosp_reserva_bvt_look .= "Sim" ;} 
 if ($this->hosp_reserva_bvt == "N") { $hosp_reserva_bvt_look .= "Não" ;} 
 if (empty($hosp_reserva_bvt_look)) { $hosp_reserva_bvt_look = $this->hosp_reserva_bvt; }
?>
<span id="id_read_on_hosp_reserva_bvt" class="css_hosp_reserva_bvt_line"  style="<?php echo $sStyleReadLab_hosp_reserva_bvt; ?>"><?php echo $this->form_format_readonly("hosp_reserva_bvt", $this->form_encode_input($hosp_reserva_bvt_look)); ?></span><span id="id_read_off_hosp_reserva_bvt" class="css_read_off_hosp_reserva_bvt<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_hosp_reserva_bvt; ?>">
 <span id="idAjaxSelect_hosp_reserva_bvt" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_hosp_reserva_bvt_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_reserva_bvt" name="hosp_reserva_bvt" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="Y" <?php  if ($this->hosp_reserva_bvt == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_reserva_bvt'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->hosp_reserva_bvt == "N") { echo " selected" ;} ?><?php  if (empty($this->hosp_reserva_bvt)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_reserva_bvt'][] = 'N'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_reserva_bvt_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_reserva_bvt_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['conta_roomlist']))
   {
       $this->nm_new_label['conta_roomlist'] = "Conta Rooming List:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $conta_roomlist = $this->conta_roomlist;
   $sStyleHidden_conta_roomlist = '';
   if (isset($this->nmgp_cmp_hidden['conta_roomlist']) && $this->nmgp_cmp_hidden['conta_roomlist'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['conta_roomlist']);
       $sStyleHidden_conta_roomlist = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_conta_roomlist = 'display: none;';
   $sStyleReadInp_conta_roomlist = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['conta_roomlist']) && $this->nmgp_cmp_readonly['conta_roomlist'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['conta_roomlist']);
       $sStyleReadLab_conta_roomlist = '';
       $sStyleReadInp_conta_roomlist = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['conta_roomlist']) && $this->nmgp_cmp_hidden['conta_roomlist'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="conta_roomlist" value="<?php echo $this->form_encode_input($this->conta_roomlist) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_conta_roomlist_label" id="hidden_field_label_conta_roomlist" style="<?php echo $sStyleHidden_conta_roomlist; ?>"><span id="id_label_conta_roomlist"><?php echo $this->nm_new_label['conta_roomlist']; ?></span></TD>
    <TD class="scFormDataOdd css_conta_roomlist_line" id="hidden_field_data_conta_roomlist" style="<?php echo $sStyleHidden_conta_roomlist; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_conta_roomlist_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["conta_roomlist"]) &&  $this->nmgp_cmp_readonly["conta_roomlist"] == "on") { 

$conta_roomlist_look = "";
 if ($this->conta_roomlist == "NAO") { $conta_roomlist_look .= "Não" ;} 
 if ($this->conta_roomlist == "SIM") { $conta_roomlist_look .= "Sim" ;} 
 if (empty($conta_roomlist_look)) { $conta_roomlist_look = $this->conta_roomlist; }
?>
<input type="hidden" name="conta_roomlist" value="<?php echo $this->form_encode_input($conta_roomlist) . "\">" . $conta_roomlist_look . ""; ?>
<?php } else { ?>
<?php

$conta_roomlist_look = "";
 if ($this->conta_roomlist == "NAO") { $conta_roomlist_look .= "Não" ;} 
 if ($this->conta_roomlist == "SIM") { $conta_roomlist_look .= "Sim" ;} 
 if (empty($conta_roomlist_look)) { $conta_roomlist_look = $this->conta_roomlist; }
?>
<span id="id_read_on_conta_roomlist" class="css_conta_roomlist_line"  style="<?php echo $sStyleReadLab_conta_roomlist; ?>"><?php echo $this->form_format_readonly("conta_roomlist", $this->form_encode_input($conta_roomlist_look)); ?></span><span id="id_read_off_conta_roomlist" class="css_read_off_conta_roomlist<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_conta_roomlist; ?>">
 <span id="idAjaxSelect_conta_roomlist" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_conta_roomlist_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_conta_roomlist" name="conta_roomlist" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="NAO" <?php  if ($this->conta_roomlist == "NAO") { echo " selected" ;} ?><?php  if (empty($this->conta_roomlist)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_conta_roomlist'][] = 'NAO'; ?>
 <option  value="SIM" <?php  if ($this->conta_roomlist == "SIM") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_conta_roomlist'][] = 'SIM'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_conta_roomlist_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_conta_roomlist_text"></span></td></tr></table></td></tr></table></TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_titulo_api_label" id="hidden_field_label_titulo_api" style="<?php echo $sStyleHidden_titulo_api; ?>"><span id="id_label_titulo_api"><?php echo $this->nm_new_label['titulo_api']; ?></span></TD>
    <TD class="scFormDataOdd css_titulo_api_line" id="hidden_field_data_titulo_api" style="<?php echo $sStyleHidden_titulo_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_titulo_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["titulo_api"]) &&  $this->nmgp_cmp_readonly["titulo_api"] == "on") { 

 ?>
<input type="hidden" name="titulo_api" value="<?php echo $this->form_encode_input($titulo_api) . "\">" . $titulo_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_titulo_api" class="sc-ui-readonly-titulo_api css_titulo_api_line" style="<?php echo $sStyleReadLab_titulo_api; ?>"><?php echo $this->form_format_readonly("titulo_api", $this->form_encode_input($this->titulo_api)); ?></span><span id="id_read_off_titulo_api" class="css_read_off_titulo_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_titulo_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_titulo_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_titulo_api" type=text name="titulo_api" value="<?php echo $this->form_encode_input($titulo_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=120 alt="{datatype: 'text', maxLength: 120, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_titulo_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_titulo_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_descricao_api_label" id="hidden_field_label_descricao_api" style="<?php echo $sStyleHidden_descricao_api; ?>"><span id="id_label_descricao_api"><?php echo $this->nm_new_label['descricao_api']; ?></span></TD>
    <TD class="scFormDataOdd css_descricao_api_line" id="hidden_field_data_descricao_api" style="<?php echo $sStyleHidden_descricao_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_descricao_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["descricao_api"]) &&  $this->nmgp_cmp_readonly["descricao_api"] == "on") { 

 ?>
<input type="hidden" name="descricao_api" value="<?php echo $this->form_encode_input($descricao_api) . "\">" . $descricao_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_descricao_api" class="sc-ui-readonly-descricao_api css_descricao_api_line" style="<?php echo $sStyleReadLab_descricao_api; ?>"><?php echo $this->form_format_readonly("descricao_api", $this->form_encode_input($this->descricao_api)); ?></span><span id="id_read_off_descricao_api" class="css_read_off_descricao_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_descricao_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_descricao_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_descricao_api" type=text name="descricao_api" value="<?php echo $this->form_encode_input($descricao_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=120 alt="{datatype: 'text', maxLength: 120, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descricao_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descricao_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['codigo_api']))
    {
        $this->nm_new_label['codigo_api'] = "Código API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $codigo_api = $this->codigo_api;
   $sStyleHidden_codigo_api = '';
   if (isset($this->nmgp_cmp_hidden['codigo_api']) && $this->nmgp_cmp_hidden['codigo_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['codigo_api']);
       $sStyleHidden_codigo_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_codigo_api = 'display: none;';
   $sStyleReadInp_codigo_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['codigo_api']) && $this->nmgp_cmp_readonly['codigo_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['codigo_api']);
       $sStyleReadLab_codigo_api = '';
       $sStyleReadInp_codigo_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['codigo_api']) && $this->nmgp_cmp_hidden['codigo_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="codigo_api" value="<?php echo $this->form_encode_input($codigo_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_codigo_api_label" id="hidden_field_label_codigo_api" style="<?php echo $sStyleHidden_codigo_api; ?>"><span id="id_label_codigo_api"><?php echo $this->nm_new_label['codigo_api']; ?></span></TD>
    <TD class="scFormDataOdd css_codigo_api_line" id="hidden_field_data_codigo_api" style="<?php echo $sStyleHidden_codigo_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_codigo_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["codigo_api"]) &&  $this->nmgp_cmp_readonly["codigo_api"] == "on") { 

 ?>
<input type="hidden" name="codigo_api" value="<?php echo $this->form_encode_input($codigo_api) . "\">" . $codigo_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_codigo_api" class="sc-ui-readonly-codigo_api css_codigo_api_line" style="<?php echo $sStyleReadLab_codigo_api; ?>"><?php echo $this->form_format_readonly("codigo_api", $this->form_encode_input($this->codigo_api)); ?></span><span id="id_read_off_codigo_api" class="css_read_off_codigo_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_codigo_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_codigo_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_codigo_api" type=text name="codigo_api" value="<?php echo $this->form_encode_input($codigo_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codigo_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codigo_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_valido_de_api_label" id="hidden_field_label_valido_de_api" style="<?php echo $sStyleHidden_valido_de_api; ?>"><span id="id_label_valido_de_api"><?php echo $this->nm_new_label['valido_de_api']; ?></span></TD>
    <TD class="scFormDataOdd css_valido_de_api_line" id="hidden_field_data_valido_de_api" style="<?php echo $sStyleHidden_valido_de_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_valido_de_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["valido_de_api"]) &&  $this->nmgp_cmp_readonly["valido_de_api"] == "on") { 

 ?>
<input type="hidden" name="valido_de_api" value="<?php echo $this->form_encode_input($valido_de_api) . "\">" . $valido_de_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_valido_de_api" class="sc-ui-readonly-valido_de_api css_valido_de_api_line" style="<?php echo $sStyleReadLab_valido_de_api; ?>"><?php echo $this->form_format_readonly("valido_de_api", $this->form_encode_input($this->valido_de_api)); ?></span><span id="id_read_off_valido_de_api" class="css_read_off_valido_de_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_valido_de_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_valido_de_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_valido_de_api" type=text name="valido_de_api" value="<?php echo $this->form_encode_input($valido_de_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_valido_de_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_valido_de_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_valido_ate_api_label" id="hidden_field_label_valido_ate_api" style="<?php echo $sStyleHidden_valido_ate_api; ?>"><span id="id_label_valido_ate_api"><?php echo $this->nm_new_label['valido_ate_api']; ?></span></TD>
    <TD class="scFormDataOdd css_valido_ate_api_line" id="hidden_field_data_valido_ate_api" style="<?php echo $sStyleHidden_valido_ate_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_valido_ate_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["valido_ate_api"]) &&  $this->nmgp_cmp_readonly["valido_ate_api"] == "on") { 

 ?>
<input type="hidden" name="valido_ate_api" value="<?php echo $this->form_encode_input($valido_ate_api) . "\">" . $valido_ate_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_valido_ate_api" class="sc-ui-readonly-valido_ate_api css_valido_ate_api_line" style="<?php echo $sStyleReadLab_valido_ate_api; ?>"><?php echo $this->form_format_readonly("valido_ate_api", $this->form_encode_input($this->valido_ate_api)); ?></span><span id="id_read_off_valido_ate_api" class="css_read_off_valido_ate_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_valido_ate_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_valido_ate_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_valido_ate_api" type=text name="valido_ate_api" value="<?php echo $this->form_encode_input($valido_ate_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_valido_ate_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_valido_ate_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nome_hotel_api']))
    {
        $this->nm_new_label['nome_hotel_api'] = "Hotel API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nome_hotel_api = $this->nome_hotel_api;
   $sStyleHidden_nome_hotel_api = '';
   if (isset($this->nmgp_cmp_hidden['nome_hotel_api']) && $this->nmgp_cmp_hidden['nome_hotel_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nome_hotel_api']);
       $sStyleHidden_nome_hotel_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nome_hotel_api = 'display: none;';
   $sStyleReadInp_nome_hotel_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nome_hotel_api']) && $this->nmgp_cmp_readonly['nome_hotel_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nome_hotel_api']);
       $sStyleReadLab_nome_hotel_api = '';
       $sStyleReadInp_nome_hotel_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nome_hotel_api']) && $this->nmgp_cmp_hidden['nome_hotel_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nome_hotel_api" value="<?php echo $this->form_encode_input($nome_hotel_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_nome_hotel_api_label" id="hidden_field_label_nome_hotel_api" style="<?php echo $sStyleHidden_nome_hotel_api; ?>"><span id="id_label_nome_hotel_api"><?php echo $this->nm_new_label['nome_hotel_api']; ?></span></TD>
    <TD class="scFormDataOdd css_nome_hotel_api_line" id="hidden_field_data_nome_hotel_api" style="<?php echo $sStyleHidden_nome_hotel_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nome_hotel_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nome_hotel_api"]) &&  $this->nmgp_cmp_readonly["nome_hotel_api"] == "on") { 

 ?>
<input type="hidden" name="nome_hotel_api" value="<?php echo $this->form_encode_input($nome_hotel_api) . "\">" . $nome_hotel_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_nome_hotel_api" class="sc-ui-readonly-nome_hotel_api css_nome_hotel_api_line" style="<?php echo $sStyleReadLab_nome_hotel_api; ?>"><?php echo $this->form_format_readonly("nome_hotel_api", $this->form_encode_input($this->nome_hotel_api)); ?></span><span id="id_read_off_nome_hotel_api" class="css_read_off_nome_hotel_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nome_hotel_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_nome_hotel_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nome_hotel_api" type=text name="nome_hotel_api" value="<?php echo $this->form_encode_input($nome_hotel_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_hotel_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_hotel_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['checkin_api']))
    {
        $this->nm_new_label['checkin_api'] = "Check In API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $checkin_api = $this->checkin_api;
   $sStyleHidden_checkin_api = '';
   if (isset($this->nmgp_cmp_hidden['checkin_api']) && $this->nmgp_cmp_hidden['checkin_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['checkin_api']);
       $sStyleHidden_checkin_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_checkin_api = 'display: none;';
   $sStyleReadInp_checkin_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['checkin_api']) && $this->nmgp_cmp_readonly['checkin_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['checkin_api']);
       $sStyleReadLab_checkin_api = '';
       $sStyleReadInp_checkin_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['checkin_api']) && $this->nmgp_cmp_hidden['checkin_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="checkin_api" value="<?php echo $this->form_encode_input($checkin_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_checkin_api_label" id="hidden_field_label_checkin_api" style="<?php echo $sStyleHidden_checkin_api; ?>"><span id="id_label_checkin_api"><?php echo $this->nm_new_label['checkin_api']; ?></span></TD>
    <TD class="scFormDataOdd css_checkin_api_line" id="hidden_field_data_checkin_api" style="<?php echo $sStyleHidden_checkin_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_checkin_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["checkin_api"]) &&  $this->nmgp_cmp_readonly["checkin_api"] == "on") { 

 ?>
<input type="hidden" name="checkin_api" value="<?php echo $this->form_encode_input($checkin_api) . "\">" . $checkin_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_checkin_api" class="sc-ui-readonly-checkin_api css_checkin_api_line" style="<?php echo $sStyleReadLab_checkin_api; ?>"><?php echo $this->form_format_readonly("checkin_api", $this->form_encode_input($this->checkin_api)); ?></span><span id="id_read_off_checkin_api" class="css_read_off_checkin_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_checkin_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_checkin_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_checkin_api" type=text name="checkin_api" value="<?php echo $this->form_encode_input($checkin_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_checkin_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_checkin_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['checkout_api']))
    {
        $this->nm_new_label['checkout_api'] = "Check Out API\;";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $checkout_api = $this->checkout_api;
   $sStyleHidden_checkout_api = '';
   if (isset($this->nmgp_cmp_hidden['checkout_api']) && $this->nmgp_cmp_hidden['checkout_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['checkout_api']);
       $sStyleHidden_checkout_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_checkout_api = 'display: none;';
   $sStyleReadInp_checkout_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['checkout_api']) && $this->nmgp_cmp_readonly['checkout_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['checkout_api']);
       $sStyleReadLab_checkout_api = '';
       $sStyleReadInp_checkout_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['checkout_api']) && $this->nmgp_cmp_hidden['checkout_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="checkout_api" value="<?php echo $this->form_encode_input($checkout_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_checkout_api_label" id="hidden_field_label_checkout_api" style="<?php echo $sStyleHidden_checkout_api; ?>"><span id="id_label_checkout_api"><?php echo $this->nm_new_label['checkout_api']; ?></span></TD>
    <TD class="scFormDataOdd css_checkout_api_line" id="hidden_field_data_checkout_api" style="<?php echo $sStyleHidden_checkout_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_checkout_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["checkout_api"]) &&  $this->nmgp_cmp_readonly["checkout_api"] == "on") { 

 ?>
<input type="hidden" name="checkout_api" value="<?php echo $this->form_encode_input($checkout_api) . "\">" . $checkout_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_checkout_api" class="sc-ui-readonly-checkout_api css_checkout_api_line" style="<?php echo $sStyleReadLab_checkout_api; ?>"><?php echo $this->form_format_readonly("checkout_api", $this->form_encode_input($this->checkout_api)); ?></span><span id="id_read_off_checkout_api" class="css_read_off_checkout_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_checkout_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_checkout_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_checkout_api" type=text name="checkout_api" value="<?php echo $this->form_encode_input($checkout_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_checkout_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_checkout_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['acomodacao_api']))
    {
        $this->nm_new_label['acomodacao_api'] = "Acomodação API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $acomodacao_api = $this->acomodacao_api;
   $sStyleHidden_acomodacao_api = '';
   if (isset($this->nmgp_cmp_hidden['acomodacao_api']) && $this->nmgp_cmp_hidden['acomodacao_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['acomodacao_api']);
       $sStyleHidden_acomodacao_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_acomodacao_api = 'display: none;';
   $sStyleReadInp_acomodacao_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['acomodacao_api']) && $this->nmgp_cmp_readonly['acomodacao_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['acomodacao_api']);
       $sStyleReadLab_acomodacao_api = '';
       $sStyleReadInp_acomodacao_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['acomodacao_api']) && $this->nmgp_cmp_hidden['acomodacao_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="acomodacao_api" value="<?php echo $this->form_encode_input($acomodacao_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_acomodacao_api_label" id="hidden_field_label_acomodacao_api" style="<?php echo $sStyleHidden_acomodacao_api; ?>"><span id="id_label_acomodacao_api"><?php echo $this->nm_new_label['acomodacao_api']; ?></span></TD>
    <TD class="scFormDataOdd css_acomodacao_api_line" id="hidden_field_data_acomodacao_api" style="<?php echo $sStyleHidden_acomodacao_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_acomodacao_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["acomodacao_api"]) &&  $this->nmgp_cmp_readonly["acomodacao_api"] == "on") { 

 ?>
<input type="hidden" name="acomodacao_api" value="<?php echo $this->form_encode_input($acomodacao_api) . "\">" . $acomodacao_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_acomodacao_api" class="sc-ui-readonly-acomodacao_api css_acomodacao_api_line" style="<?php echo $sStyleReadLab_acomodacao_api; ?>"><?php echo $this->form_format_readonly("acomodacao_api", $this->form_encode_input($this->acomodacao_api)); ?></span><span id="id_read_off_acomodacao_api" class="css_read_off_acomodacao_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_acomodacao_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_acomodacao_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_acomodacao_api" type=text name="acomodacao_api" value="<?php echo $this->form_encode_input($acomodacao_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_acomodacao_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_acomodacao_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['endereco_hotel_api']))
    {
        $this->nm_new_label['endereco_hotel_api'] = "Endereço API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $endereco_hotel_api = $this->endereco_hotel_api;
   $sStyleHidden_endereco_hotel_api = '';
   if (isset($this->nmgp_cmp_hidden['endereco_hotel_api']) && $this->nmgp_cmp_hidden['endereco_hotel_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['endereco_hotel_api']);
       $sStyleHidden_endereco_hotel_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_endereco_hotel_api = 'display: none;';
   $sStyleReadInp_endereco_hotel_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['endereco_hotel_api']) && $this->nmgp_cmp_readonly['endereco_hotel_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['endereco_hotel_api']);
       $sStyleReadLab_endereco_hotel_api = '';
       $sStyleReadInp_endereco_hotel_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['endereco_hotel_api']) && $this->nmgp_cmp_hidden['endereco_hotel_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="endereco_hotel_api" value="<?php echo $this->form_encode_input($endereco_hotel_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_endereco_hotel_api_label" id="hidden_field_label_endereco_hotel_api" style="<?php echo $sStyleHidden_endereco_hotel_api; ?>"><span id="id_label_endereco_hotel_api"><?php echo $this->nm_new_label['endereco_hotel_api']; ?></span></TD>
    <TD class="scFormDataOdd css_endereco_hotel_api_line" id="hidden_field_data_endereco_hotel_api" style="<?php echo $sStyleHidden_endereco_hotel_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_endereco_hotel_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["endereco_hotel_api"]) &&  $this->nmgp_cmp_readonly["endereco_hotel_api"] == "on") { 

 ?>
<input type="hidden" name="endereco_hotel_api" value="<?php echo $this->form_encode_input($endereco_hotel_api) . "\">" . $endereco_hotel_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_endereco_hotel_api" class="sc-ui-readonly-endereco_hotel_api css_endereco_hotel_api_line" style="<?php echo $sStyleReadLab_endereco_hotel_api; ?>"><?php echo $this->form_format_readonly("endereco_hotel_api", $this->form_encode_input($this->endereco_hotel_api)); ?></span><span id="id_read_off_endereco_hotel_api" class="css_read_off_endereco_hotel_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_endereco_hotel_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_endereco_hotel_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_endereco_hotel_api" type=text name="endereco_hotel_api" value="<?php echo $this->form_encode_input($endereco_hotel_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_endereco_hotel_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_endereco_hotel_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qtd_hospedes_api']))
    {
        $this->nm_new_label['qtd_hospedes_api'] = "Qtd. Hóspedes API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qtd_hospedes_api = $this->qtd_hospedes_api;
   $sStyleHidden_qtd_hospedes_api = '';
   if (isset($this->nmgp_cmp_hidden['qtd_hospedes_api']) && $this->nmgp_cmp_hidden['qtd_hospedes_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qtd_hospedes_api']);
       $sStyleHidden_qtd_hospedes_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qtd_hospedes_api = 'display: none;';
   $sStyleReadInp_qtd_hospedes_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qtd_hospedes_api']) && $this->nmgp_cmp_readonly['qtd_hospedes_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qtd_hospedes_api']);
       $sStyleReadLab_qtd_hospedes_api = '';
       $sStyleReadInp_qtd_hospedes_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qtd_hospedes_api']) && $this->nmgp_cmp_hidden['qtd_hospedes_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qtd_hospedes_api" value="<?php echo $this->form_encode_input($qtd_hospedes_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qtd_hospedes_api_label" id="hidden_field_label_qtd_hospedes_api" style="<?php echo $sStyleHidden_qtd_hospedes_api; ?>"><span id="id_label_qtd_hospedes_api"><?php echo $this->nm_new_label['qtd_hospedes_api']; ?></span></TD>
    <TD class="scFormDataOdd css_qtd_hospedes_api_line" id="hidden_field_data_qtd_hospedes_api" style="<?php echo $sStyleHidden_qtd_hospedes_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qtd_hospedes_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qtd_hospedes_api"]) &&  $this->nmgp_cmp_readonly["qtd_hospedes_api"] == "on") { 

 ?>
<input type="hidden" name="qtd_hospedes_api" value="<?php echo $this->form_encode_input($qtd_hospedes_api) . "\">" . $qtd_hospedes_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_qtd_hospedes_api" class="sc-ui-readonly-qtd_hospedes_api css_qtd_hospedes_api_line" style="<?php echo $sStyleReadLab_qtd_hospedes_api; ?>"><?php echo $this->form_format_readonly("qtd_hospedes_api", $this->form_encode_input($this->qtd_hospedes_api)); ?></span><span id="id_read_off_qtd_hospedes_api" class="css_read_off_qtd_hospedes_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qtd_hospedes_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_qtd_hospedes_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qtd_hospedes_api" type=text name="qtd_hospedes_api" value="<?php echo $this->form_encode_input($qtd_hospedes_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qtd_hospedes_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qtd_hospedes_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['qtd_noites_api']))
    {
        $this->nm_new_label['qtd_noites_api'] = "Qtd. Noites API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $qtd_noites_api = $this->qtd_noites_api;
   $sStyleHidden_qtd_noites_api = '';
   if (isset($this->nmgp_cmp_hidden['qtd_noites_api']) && $this->nmgp_cmp_hidden['qtd_noites_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['qtd_noites_api']);
       $sStyleHidden_qtd_noites_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_qtd_noites_api = 'display: none;';
   $sStyleReadInp_qtd_noites_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['qtd_noites_api']) && $this->nmgp_cmp_readonly['qtd_noites_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['qtd_noites_api']);
       $sStyleReadLab_qtd_noites_api = '';
       $sStyleReadInp_qtd_noites_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['qtd_noites_api']) && $this->nmgp_cmp_hidden['qtd_noites_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="qtd_noites_api" value="<?php echo $this->form_encode_input($qtd_noites_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_qtd_noites_api_label" id="hidden_field_label_qtd_noites_api" style="<?php echo $sStyleHidden_qtd_noites_api; ?>"><span id="id_label_qtd_noites_api"><?php echo $this->nm_new_label['qtd_noites_api']; ?></span></TD>
    <TD class="scFormDataOdd css_qtd_noites_api_line" id="hidden_field_data_qtd_noites_api" style="<?php echo $sStyleHidden_qtd_noites_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_qtd_noites_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["qtd_noites_api"]) &&  $this->nmgp_cmp_readonly["qtd_noites_api"] == "on") { 

 ?>
<input type="hidden" name="qtd_noites_api" value="<?php echo $this->form_encode_input($qtd_noites_api) . "\">" . $qtd_noites_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_qtd_noites_api" class="sc-ui-readonly-qtd_noites_api css_qtd_noites_api_line" style="<?php echo $sStyleReadLab_qtd_noites_api; ?>"><?php echo $this->form_format_readonly("qtd_noites_api", $this->form_encode_input($this->qtd_noites_api)); ?></span><span id="id_read_off_qtd_noites_api" class="css_read_off_qtd_noites_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_qtd_noites_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_qtd_noites_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_qtd_noites_api" type=text name="qtd_noites_api" value="<?php echo $this->form_encode_input($qtd_noites_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_qtd_noites_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_qtd_noites_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cafe_manha_api']))
    {
        $this->nm_new_label['cafe_manha_api'] = "Café da Manhã API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cafe_manha_api = $this->cafe_manha_api;
   $sStyleHidden_cafe_manha_api = '';
   if (isset($this->nmgp_cmp_hidden['cafe_manha_api']) && $this->nmgp_cmp_hidden['cafe_manha_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cafe_manha_api']);
       $sStyleHidden_cafe_manha_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cafe_manha_api = 'display: none;';
   $sStyleReadInp_cafe_manha_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cafe_manha_api']) && $this->nmgp_cmp_readonly['cafe_manha_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cafe_manha_api']);
       $sStyleReadLab_cafe_manha_api = '';
       $sStyleReadInp_cafe_manha_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cafe_manha_api']) && $this->nmgp_cmp_hidden['cafe_manha_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cafe_manha_api" value="<?php echo $this->form_encode_input($cafe_manha_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_cafe_manha_api_label" id="hidden_field_label_cafe_manha_api" style="<?php echo $sStyleHidden_cafe_manha_api; ?>"><span id="id_label_cafe_manha_api"><?php echo $this->nm_new_label['cafe_manha_api']; ?></span></TD>
    <TD class="scFormDataOdd css_cafe_manha_api_line" id="hidden_field_data_cafe_manha_api" style="<?php echo $sStyleHidden_cafe_manha_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cafe_manha_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cafe_manha_api"]) &&  $this->nmgp_cmp_readonly["cafe_manha_api"] == "on") { 

 ?>
<input type="hidden" name="cafe_manha_api" value="<?php echo $this->form_encode_input($cafe_manha_api) . "\">" . $cafe_manha_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_cafe_manha_api" class="sc-ui-readonly-cafe_manha_api css_cafe_manha_api_line" style="<?php echo $sStyleReadLab_cafe_manha_api; ?>"><?php echo $this->form_format_readonly("cafe_manha_api", $this->form_encode_input($this->cafe_manha_api)); ?></span><span id="id_read_off_cafe_manha_api" class="css_read_off_cafe_manha_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cafe_manha_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_cafe_manha_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cafe_manha_api" type=text name="cafe_manha_api" value="<?php echo $this->form_encode_input($cafe_manha_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cafe_manha_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cafe_manha_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['comodidades_api']))
    {
        $this->nm_new_label['comodidades_api'] = "Comodidades API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $comodidades_api = $this->comodidades_api;
   $sStyleHidden_comodidades_api = '';
   if (isset($this->nmgp_cmp_hidden['comodidades_api']) && $this->nmgp_cmp_hidden['comodidades_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['comodidades_api']);
       $sStyleHidden_comodidades_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_comodidades_api = 'display: none;';
   $sStyleReadInp_comodidades_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['comodidades_api']) && $this->nmgp_cmp_readonly['comodidades_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['comodidades_api']);
       $sStyleReadLab_comodidades_api = '';
       $sStyleReadInp_comodidades_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['comodidades_api']) && $this->nmgp_cmp_hidden['comodidades_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="comodidades_api" value="<?php echo $this->form_encode_input($comodidades_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_comodidades_api_label" id="hidden_field_label_comodidades_api" style="<?php echo $sStyleHidden_comodidades_api; ?>"><span id="id_label_comodidades_api"><?php echo $this->nm_new_label['comodidades_api']; ?></span></TD>
    <TD class="scFormDataOdd css_comodidades_api_line" id="hidden_field_data_comodidades_api" style="<?php echo $sStyleHidden_comodidades_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_comodidades_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["comodidades_api"]) &&  $this->nmgp_cmp_readonly["comodidades_api"] == "on") { 

 ?>
<input type="hidden" name="comodidades_api" value="<?php echo $this->form_encode_input($comodidades_api) . "\">" . $comodidades_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_comodidades_api" class="sc-ui-readonly-comodidades_api css_comodidades_api_line" style="<?php echo $sStyleReadLab_comodidades_api; ?>"><?php echo $this->form_format_readonly("comodidades_api", $this->form_encode_input($this->comodidades_api)); ?></span><span id="id_read_off_comodidades_api" class="css_read_off_comodidades_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_comodidades_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_comodidades_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_comodidades_api" type=text name="comodidades_api" value="<?php echo $this->form_encode_input($comodidades_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=150"; } ?> maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_comodidades_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_comodidades_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['codigo_reserva_api']))
    {
        $this->nm_new_label['codigo_reserva_api'] = "Código Reserva API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $codigo_reserva_api = $this->codigo_reserva_api;
   $sStyleHidden_codigo_reserva_api = '';
   if (isset($this->nmgp_cmp_hidden['codigo_reserva_api']) && $this->nmgp_cmp_hidden['codigo_reserva_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['codigo_reserva_api']);
       $sStyleHidden_codigo_reserva_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_codigo_reserva_api = 'display: none;';
   $sStyleReadInp_codigo_reserva_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['codigo_reserva_api']) && $this->nmgp_cmp_readonly['codigo_reserva_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['codigo_reserva_api']);
       $sStyleReadLab_codigo_reserva_api = '';
       $sStyleReadInp_codigo_reserva_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['codigo_reserva_api']) && $this->nmgp_cmp_hidden['codigo_reserva_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="codigo_reserva_api" value="<?php echo $this->form_encode_input($codigo_reserva_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_codigo_reserva_api_label" id="hidden_field_label_codigo_reserva_api" style="<?php echo $sStyleHidden_codigo_reserva_api; ?>"><span id="id_label_codigo_reserva_api"><?php echo $this->nm_new_label['codigo_reserva_api']; ?></span></TD>
    <TD class="scFormDataOdd css_codigo_reserva_api_line" id="hidden_field_data_codigo_reserva_api" style="<?php echo $sStyleHidden_codigo_reserva_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_codigo_reserva_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["codigo_reserva_api"]) &&  $this->nmgp_cmp_readonly["codigo_reserva_api"] == "on") { 

 ?>
<input type="hidden" name="codigo_reserva_api" value="<?php echo $this->form_encode_input($codigo_reserva_api) . "\">" . $codigo_reserva_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_codigo_reserva_api" class="sc-ui-readonly-codigo_reserva_api css_codigo_reserva_api_line" style="<?php echo $sStyleReadLab_codigo_reserva_api; ?>"><?php echo $this->form_format_readonly("codigo_reserva_api", $this->form_encode_input($this->codigo_reserva_api)); ?></span><span id="id_read_off_codigo_reserva_api" class="css_read_off_codigo_reserva_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_codigo_reserva_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_codigo_reserva_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_codigo_reserva_api" type=text name="codigo_reserva_api" value="<?php echo $this->form_encode_input($codigo_reserva_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codigo_reserva_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codigo_reserva_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['telefone_hotel_api']))
    {
        $this->nm_new_label['telefone_hotel_api'] = "Telefone Hotel API";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $telefone_hotel_api = $this->telefone_hotel_api;
   $sStyleHidden_telefone_hotel_api = '';
   if (isset($this->nmgp_cmp_hidden['telefone_hotel_api']) && $this->nmgp_cmp_hidden['telefone_hotel_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['telefone_hotel_api']);
       $sStyleHidden_telefone_hotel_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_telefone_hotel_api = 'display: none;';
   $sStyleReadInp_telefone_hotel_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['telefone_hotel_api']) && $this->nmgp_cmp_readonly['telefone_hotel_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['telefone_hotel_api']);
       $sStyleReadLab_telefone_hotel_api = '';
       $sStyleReadInp_telefone_hotel_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['telefone_hotel_api']) && $this->nmgp_cmp_hidden['telefone_hotel_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="telefone_hotel_api" value="<?php echo $this->form_encode_input($telefone_hotel_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_telefone_hotel_api_label" id="hidden_field_label_telefone_hotel_api" style="<?php echo $sStyleHidden_telefone_hotel_api; ?>"><span id="id_label_telefone_hotel_api"><?php echo $this->nm_new_label['telefone_hotel_api']; ?></span></TD>
    <TD class="scFormDataOdd css_telefone_hotel_api_line" id="hidden_field_data_telefone_hotel_api" style="<?php echo $sStyleHidden_telefone_hotel_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_telefone_hotel_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["telefone_hotel_api"]) &&  $this->nmgp_cmp_readonly["telefone_hotel_api"] == "on") { 

 ?>
<input type="hidden" name="telefone_hotel_api" value="<?php echo $this->form_encode_input($telefone_hotel_api) . "\">" . $telefone_hotel_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_telefone_hotel_api" class="sc-ui-readonly-telefone_hotel_api css_telefone_hotel_api_line" style="<?php echo $sStyleReadLab_telefone_hotel_api; ?>"><?php echo $this->form_format_readonly("telefone_hotel_api", $this->form_encode_input($this->telefone_hotel_api)); ?></span><span id="id_read_off_telefone_hotel_api" class="css_read_off_telefone_hotel_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_telefone_hotel_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_telefone_hotel_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_telefone_hotel_api" type=text name="telefone_hotel_api" value="<?php echo $this->form_encode_input($telefone_hotel_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_telefone_hotel_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_telefone_hotel_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['andar_hotel_api']))
    {
        $this->nm_new_label['andar_hotel_api'] = "Andar Acomodação API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $andar_hotel_api = $this->andar_hotel_api;
   $sStyleHidden_andar_hotel_api = '';
   if (isset($this->nmgp_cmp_hidden['andar_hotel_api']) && $this->nmgp_cmp_hidden['andar_hotel_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['andar_hotel_api']);
       $sStyleHidden_andar_hotel_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_andar_hotel_api = 'display: none;';
   $sStyleReadInp_andar_hotel_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['andar_hotel_api']) && $this->nmgp_cmp_readonly['andar_hotel_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['andar_hotel_api']);
       $sStyleReadLab_andar_hotel_api = '';
       $sStyleReadInp_andar_hotel_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['andar_hotel_api']) && $this->nmgp_cmp_hidden['andar_hotel_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="andar_hotel_api" value="<?php echo $this->form_encode_input($andar_hotel_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_andar_hotel_api_label" id="hidden_field_label_andar_hotel_api" style="<?php echo $sStyleHidden_andar_hotel_api; ?>"><span id="id_label_andar_hotel_api"><?php echo $this->nm_new_label['andar_hotel_api']; ?></span></TD>
    <TD class="scFormDataOdd css_andar_hotel_api_line" id="hidden_field_data_andar_hotel_api" style="<?php echo $sStyleHidden_andar_hotel_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_andar_hotel_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["andar_hotel_api"]) &&  $this->nmgp_cmp_readonly["andar_hotel_api"] == "on") { 

 ?>
<input type="hidden" name="andar_hotel_api" value="<?php echo $this->form_encode_input($andar_hotel_api) . "\">" . $andar_hotel_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_andar_hotel_api" class="sc-ui-readonly-andar_hotel_api css_andar_hotel_api_line" style="<?php echo $sStyleReadLab_andar_hotel_api; ?>"><?php echo $this->form_format_readonly("andar_hotel_api", $this->form_encode_input($this->andar_hotel_api)); ?></span><span id="id_read_off_andar_hotel_api" class="css_read_off_andar_hotel_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_andar_hotel_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_andar_hotel_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_andar_hotel_api" type=text name="andar_hotel_api" value="<?php echo $this->form_encode_input($andar_hotel_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_andar_hotel_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_andar_hotel_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['late_checkout_api']))
    {
        $this->nm_new_label['late_checkout_api'] = "Late Check Out API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $late_checkout_api = $this->late_checkout_api;
   $sStyleHidden_late_checkout_api = '';
   if (isset($this->nmgp_cmp_hidden['late_checkout_api']) && $this->nmgp_cmp_hidden['late_checkout_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['late_checkout_api']);
       $sStyleHidden_late_checkout_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_late_checkout_api = 'display: none;';
   $sStyleReadInp_late_checkout_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['late_checkout_api']) && $this->nmgp_cmp_readonly['late_checkout_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['late_checkout_api']);
       $sStyleReadLab_late_checkout_api = '';
       $sStyleReadInp_late_checkout_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['late_checkout_api']) && $this->nmgp_cmp_hidden['late_checkout_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="late_checkout_api" value="<?php echo $this->form_encode_input($late_checkout_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_late_checkout_api_label" id="hidden_field_label_late_checkout_api" style="<?php echo $sStyleHidden_late_checkout_api; ?>"><span id="id_label_late_checkout_api"><?php echo $this->nm_new_label['late_checkout_api']; ?></span></TD>
    <TD class="scFormDataOdd css_late_checkout_api_line" id="hidden_field_data_late_checkout_api" style="<?php echo $sStyleHidden_late_checkout_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_late_checkout_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["late_checkout_api"]) &&  $this->nmgp_cmp_readonly["late_checkout_api"] == "on") { 

 ?>
<input type="hidden" name="late_checkout_api" value="<?php echo $this->form_encode_input($late_checkout_api) . "\">" . $late_checkout_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_late_checkout_api" class="sc-ui-readonly-late_checkout_api css_late_checkout_api_line" style="<?php echo $sStyleReadLab_late_checkout_api; ?>"><?php echo $this->form_format_readonly("late_checkout_api", $this->form_encode_input($this->late_checkout_api)); ?></span><span id="id_read_off_late_checkout_api" class="css_read_off_late_checkout_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_late_checkout_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_late_checkout_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_late_checkout_api" type=text name="late_checkout_api" value="<?php echo $this->form_encode_input($late_checkout_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_late_checkout_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_late_checkout_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['minibar_api']))
    {
        $this->nm_new_label['minibar_api'] = "Minibar API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $minibar_api = $this->minibar_api;
   $sStyleHidden_minibar_api = '';
   if (isset($this->nmgp_cmp_hidden['minibar_api']) && $this->nmgp_cmp_hidden['minibar_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['minibar_api']);
       $sStyleHidden_minibar_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_minibar_api = 'display: none;';
   $sStyleReadInp_minibar_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['minibar_api']) && $this->nmgp_cmp_readonly['minibar_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['minibar_api']);
       $sStyleReadLab_minibar_api = '';
       $sStyleReadInp_minibar_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['minibar_api']) && $this->nmgp_cmp_hidden['minibar_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="minibar_api" value="<?php echo $this->form_encode_input($minibar_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_minibar_api_label" id="hidden_field_label_minibar_api" style="<?php echo $sStyleHidden_minibar_api; ?>"><span id="id_label_minibar_api"><?php echo $this->nm_new_label['minibar_api']; ?></span></TD>
    <TD class="scFormDataOdd css_minibar_api_line" id="hidden_field_data_minibar_api" style="<?php echo $sStyleHidden_minibar_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_minibar_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["minibar_api"]) &&  $this->nmgp_cmp_readonly["minibar_api"] == "on") { 

 ?>
<input type="hidden" name="minibar_api" value="<?php echo $this->form_encode_input($minibar_api) . "\">" . $minibar_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_minibar_api" class="sc-ui-readonly-minibar_api css_minibar_api_line" style="<?php echo $sStyleReadLab_minibar_api; ?>"><?php echo $this->form_format_readonly("minibar_api", $this->form_encode_input($this->minibar_api)); ?></span><span id="id_read_off_minibar_api" class="css_read_off_minibar_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_minibar_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_minibar_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_minibar_api" type=text name="minibar_api" value="<?php echo $this->form_encode_input($minibar_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_minibar_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_minibar_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['estacionamento_api']))
    {
        $this->nm_new_label['estacionamento_api'] = "Estacionamento API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $estacionamento_api = $this->estacionamento_api;
   $sStyleHidden_estacionamento_api = '';
   if (isset($this->nmgp_cmp_hidden['estacionamento_api']) && $this->nmgp_cmp_hidden['estacionamento_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['estacionamento_api']);
       $sStyleHidden_estacionamento_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_estacionamento_api = 'display: none;';
   $sStyleReadInp_estacionamento_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['estacionamento_api']) && $this->nmgp_cmp_readonly['estacionamento_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['estacionamento_api']);
       $sStyleReadLab_estacionamento_api = '';
       $sStyleReadInp_estacionamento_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['estacionamento_api']) && $this->nmgp_cmp_hidden['estacionamento_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="estacionamento_api" value="<?php echo $this->form_encode_input($estacionamento_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_estacionamento_api_label" id="hidden_field_label_estacionamento_api" style="<?php echo $sStyleHidden_estacionamento_api; ?>"><span id="id_label_estacionamento_api"><?php echo $this->nm_new_label['estacionamento_api']; ?></span></TD>
    <TD class="scFormDataOdd css_estacionamento_api_line" id="hidden_field_data_estacionamento_api" style="<?php echo $sStyleHidden_estacionamento_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_estacionamento_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["estacionamento_api"]) &&  $this->nmgp_cmp_readonly["estacionamento_api"] == "on") { 

 ?>
<input type="hidden" name="estacionamento_api" value="<?php echo $this->form_encode_input($estacionamento_api) . "\">" . $estacionamento_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_estacionamento_api" class="sc-ui-readonly-estacionamento_api css_estacionamento_api_line" style="<?php echo $sStyleReadLab_estacionamento_api; ?>"><?php echo $this->form_format_readonly("estacionamento_api", $this->form_encode_input($this->estacionamento_api)); ?></span><span id="id_read_off_estacionamento_api" class="css_read_off_estacionamento_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_estacionamento_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_estacionamento_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_estacionamento_api" type=text name="estacionamento_api" value="<?php echo $this->form_encode_input($estacionamento_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_estacionamento_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_estacionamento_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['chackin_online_api']))
    {
        $this->nm_new_label['chackin_online_api'] = "Check In Online API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $chackin_online_api = $this->chackin_online_api;
   $sStyleHidden_chackin_online_api = '';
   if (isset($this->nmgp_cmp_hidden['chackin_online_api']) && $this->nmgp_cmp_hidden['chackin_online_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['chackin_online_api']);
       $sStyleHidden_chackin_online_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_chackin_online_api = 'display: none;';
   $sStyleReadInp_chackin_online_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['chackin_online_api']) && $this->nmgp_cmp_readonly['chackin_online_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['chackin_online_api']);
       $sStyleReadLab_chackin_online_api = '';
       $sStyleReadInp_chackin_online_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['chackin_online_api']) && $this->nmgp_cmp_hidden['chackin_online_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="chackin_online_api" value="<?php echo $this->form_encode_input($chackin_online_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_chackin_online_api_label" id="hidden_field_label_chackin_online_api" style="<?php echo $sStyleHidden_chackin_online_api; ?>"><span id="id_label_chackin_online_api"><?php echo $this->nm_new_label['chackin_online_api']; ?></span></TD>
    <TD class="scFormDataOdd css_chackin_online_api_line" id="hidden_field_data_chackin_online_api" style="<?php echo $sStyleHidden_chackin_online_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_chackin_online_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["chackin_online_api"]) &&  $this->nmgp_cmp_readonly["chackin_online_api"] == "on") { 

 ?>
<input type="hidden" name="chackin_online_api" value="<?php echo $this->form_encode_input($chackin_online_api) . "\">" . $chackin_online_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_chackin_online_api" class="sc-ui-readonly-chackin_online_api css_chackin_online_api_line" style="<?php echo $sStyleReadLab_chackin_online_api; ?>"><?php echo $this->form_format_readonly("chackin_online_api", $this->form_encode_input($this->chackin_online_api)); ?></span><span id="id_read_off_chackin_online_api" class="css_read_off_chackin_online_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_chackin_online_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_chackin_online_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_chackin_online_api" type=text name="chackin_online_api" value="<?php echo $this->form_encode_input($chackin_online_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=200 alt="{datatype: 'text', maxLength: 200, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_chackin_online_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_chackin_online_api_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['senha_wifi_api']))
    {
        $this->nm_new_label['senha_wifi_api'] = "Senha Wifi API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $senha_wifi_api = $this->senha_wifi_api;
   $sStyleHidden_senha_wifi_api = '';
   if (isset($this->nmgp_cmp_hidden['senha_wifi_api']) && $this->nmgp_cmp_hidden['senha_wifi_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['senha_wifi_api']);
       $sStyleHidden_senha_wifi_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_senha_wifi_api = 'display: none;';
   $sStyleReadInp_senha_wifi_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['senha_wifi_api']) && $this->nmgp_cmp_readonly['senha_wifi_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['senha_wifi_api']);
       $sStyleReadLab_senha_wifi_api = '';
       $sStyleReadInp_senha_wifi_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['senha_wifi_api']) && $this->nmgp_cmp_hidden['senha_wifi_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="senha_wifi_api" value="<?php echo $this->form_encode_input($senha_wifi_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_senha_wifi_api_label" id="hidden_field_label_senha_wifi_api" style="<?php echo $sStyleHidden_senha_wifi_api; ?>"><span id="id_label_senha_wifi_api"><?php echo $this->nm_new_label['senha_wifi_api']; ?></span></TD>
    <TD class="scFormDataOdd css_senha_wifi_api_line" id="hidden_field_data_senha_wifi_api" style="<?php echo $sStyleHidden_senha_wifi_api; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_senha_wifi_api_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["senha_wifi_api"]) &&  $this->nmgp_cmp_readonly["senha_wifi_api"] == "on") { 

 ?>
<input type="hidden" name="senha_wifi_api" value="<?php echo $this->form_encode_input($senha_wifi_api) . "\">" . $senha_wifi_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_senha_wifi_api" class="sc-ui-readonly-senha_wifi_api css_senha_wifi_api_line" style="<?php echo $sStyleReadLab_senha_wifi_api; ?>"><?php echo $this->form_format_readonly("senha_wifi_api", $this->form_encode_input($this->senha_wifi_api)); ?></span><span id="id_read_off_senha_wifi_api" class="css_read_off_senha_wifi_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_senha_wifi_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_senha_wifi_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_senha_wifi_api" type=text name="senha_wifi_api" value="<?php echo $this->form_encode_input($senha_wifi_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_senha_wifi_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_senha_wifi_api_text"></span></td></tr></table></td></tr></table></TD>
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
        $this->nm_new_label['id_evento_app'] = "Id Evento App";
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
    <TD class="scFormDataOdd css_id_evento_app_line" id="hidden_field_data_id_evento_app" style="<?php echo $sStyleHidden_id_evento_app; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_evento_app_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_evento_app"]) &&  $this->nmgp_cmp_readonly["id_evento_app"] == "on") { 

 ?>
<input type="hidden" name="id_evento_app" value="<?php echo $this->form_encode_input($id_evento_app) . "\">" . $id_evento_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_evento_app" class="sc-ui-readonly-id_evento_app css_id_evento_app_line" style="<?php echo $sStyleReadLab_id_evento_app; ?>"><?php echo $this->form_format_readonly("id_evento_app", $this->form_encode_input($this->id_evento_app)); ?></span><span id="id_read_off_id_evento_app" class="css_read_off_id_evento_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_evento_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_evento_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_evento_app" type=text name="id_evento_app" value="<?php echo $this->form_encode_input($id_evento_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_evento_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_evento_app_text"></span></td></tr></table></td></tr></table></TD>
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
    <TD class="scFormDataOdd css_id_participante_app_line" id="hidden_field_data_id_participante_app" style="<?php echo $sStyleHidden_id_participante_app; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_participante_app_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_participante_app"]) &&  $this->nmgp_cmp_readonly["id_participante_app"] == "on") { 

 ?>
<input type="hidden" name="id_participante_app" value="<?php echo $this->form_encode_input($id_participante_app) . "\">" . $id_participante_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_participante_app" class="sc-ui-readonly-id_participante_app css_id_participante_app_line" style="<?php echo $sStyleReadLab_id_participante_app; ?>"><?php echo $this->form_format_readonly("id_participante_app", $this->form_encode_input($this->id_participante_app)); ?></span><span id="id_read_off_id_participante_app" class="css_read_off_id_participante_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_participante_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_participante_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_participante_app" type=text name="id_participante_app" value="<?php echo $this->form_encode_input($id_participante_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_participante_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_participante_app_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_voucher_app']))
    {
        $this->nm_new_label['id_voucher_app'] = "Id Voucher App";
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_id_voucher_app_label" id="hidden_field_label_id_voucher_app" style="<?php echo $sStyleHidden_id_voucher_app; ?>"><span id="id_label_id_voucher_app"><?php echo $this->nm_new_label['id_voucher_app']; ?></span></TD>
    <TD class="scFormDataOdd css_id_voucher_app_line" id="hidden_field_data_id_voucher_app" style="<?php echo $sStyleHidden_id_voucher_app; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_voucher_app_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_voucher_app"]) &&  $this->nmgp_cmp_readonly["id_voucher_app"] == "on") { 

 ?>
<input type="hidden" name="id_voucher_app" value="<?php echo $this->form_encode_input($id_voucher_app) . "\">" . $id_voucher_app . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_voucher_app" class="sc-ui-readonly-id_voucher_app css_id_voucher_app_line" style="<?php echo $sStyleReadLab_id_voucher_app; ?>"><?php echo $this->form_format_readonly("id_voucher_app", $this->form_encode_input($this->id_voucher_app)); ?></span><span id="id_read_off_id_voucher_app" class="css_read_off_id_voucher_app<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_voucher_app; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_voucher_app_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_voucher_app" type=text name="id_voucher_app" value="<?php echo $this->form_encode_input($id_voucher_app) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_voucher_app_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_voucher_app_text"></span></td></tr></table></td></tr></table></TD>
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
   if (!isset($this->nm_new_label['hosp_pagamentos']))
   {
       $this->nm_new_label['hosp_pagamentos'] = "Forma de Pagamento:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_pagamentos = $this->hosp_pagamentos;
   $sStyleHidden_hosp_pagamentos = '';
   if (isset($this->nmgp_cmp_hidden['hosp_pagamentos']) && $this->nmgp_cmp_hidden['hosp_pagamentos'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_pagamentos']);
       $sStyleHidden_hosp_pagamentos = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_pagamentos = 'display: none;';
   $sStyleReadInp_hosp_pagamentos = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_pagamentos']) && $this->nmgp_cmp_readonly['hosp_pagamentos'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_pagamentos']);
       $sStyleReadLab_hosp_pagamentos = '';
       $sStyleReadInp_hosp_pagamentos = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_pagamentos']) && $this->nmgp_cmp_hidden['hosp_pagamentos'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_pagamentos" value="<?php echo $this->form_encode_input($this->hosp_pagamentos) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_pagamentos_label" id="hidden_field_label_hosp_pagamentos" style="<?php echo $sStyleHidden_hosp_pagamentos; ?>"><span id="id_label_hosp_pagamentos"><?php echo $this->nm_new_label['hosp_pagamentos']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_pagamentos_line" id="hidden_field_data_hosp_pagamentos" style="<?php echo $sStyleHidden_hosp_pagamentos; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_pagamentos_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_pagamentos"]) &&  $this->nmgp_cmp_readonly["hosp_pagamentos"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos'] = array(); 
    }

   $old_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $old_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $old_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $old_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $old_value_hospedagem_id = $this->hospedagem_id;
   $old_value_hosp_id_evento = $this->hosp_id_evento;
   $old_value_hosp_diarias = $this->hosp_diarias;
   $old_value_hosp_taxas = $this->hosp_taxas;
   $old_value_hosp_total = $this->hosp_total;
   $old_value_hosp_id_usuario = $this->hosp_id_usuario;
   $old_value_hosp_alteracao = $this->hosp_alteracao;
   $old_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_hosp_dt_checkin = $this->hosp_dt_checkin;
   $unformatted_value_hosp_dt_checkout = $this->hosp_dt_checkout;
   $unformatted_value_hosp_hr_checkin = $this->hosp_hr_checkin;
   $unformatted_value_hosp_hr_checkout = $this->hosp_hr_checkout;
   $unformatted_value_hospedagem_id = $this->hospedagem_id;
   $unformatted_value_hosp_id_evento = $this->hosp_id_evento;
   $unformatted_value_hosp_diarias = $this->hosp_diarias;
   $unformatted_value_hosp_taxas = $this->hosp_taxas;
   $unformatted_value_hosp_total = $this->hosp_total;
   $unformatted_value_hosp_id_usuario = $this->hosp_id_usuario;
   $unformatted_value_hosp_alteracao = $this->hosp_alteracao;
   $unformatted_value_hosp_alteracao_hora = $this->hosp_alteracao_hora;

   $hosp_acompanhante_val_str = "''";
   if (!empty($this->hosp_acompanhante))
   {
       if (is_array($this->hosp_acompanhante))
       {
           $Tmp_array = $this->hosp_acompanhante;
       }
       else
       {
           $Tmp_array = explode(";", $this->hosp_acompanhante);
       }
       $hosp_acompanhante_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $hosp_acompanhante_val_str)
          {
             $hosp_acompanhante_val_str .= ", ";
          }
          $hosp_acompanhante_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $hosp_part_acomp_val_str = "''";
   if (!empty($this->hosp_part_acomp))
   {
       if (is_array($this->hosp_part_acomp))
       {
           $Tmp_array = $this->hosp_part_acomp;
       }
       else
       {
           $Tmp_array = explode(";", $this->hosp_part_acomp);
       }
       $hosp_part_acomp_val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $hosp_part_acomp_val_str)
          {
             $hosp_part_acomp_val_str .= ", ";
          }
          $hosp_part_acomp_val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT COD_PAGAMENTOS, DES_PAGAMENTOS  FROM pagamentos_rsvp  ORDER BY DES_PAGAMENTOS";

   $this->hosp_dt_checkin = $old_value_hosp_dt_checkin;
   $this->hosp_dt_checkout = $old_value_hosp_dt_checkout;
   $this->hosp_hr_checkin = $old_value_hosp_hr_checkin;
   $this->hosp_hr_checkout = $old_value_hosp_hr_checkout;
   $this->hospedagem_id = $old_value_hospedagem_id;
   $this->hosp_id_evento = $old_value_hosp_id_evento;
   $this->hosp_diarias = $old_value_hosp_diarias;
   $this->hosp_taxas = $old_value_hosp_taxas;
   $this->hosp_total = $old_value_hosp_total;
   $this->hosp_id_usuario = $old_value_hosp_id_usuario;
   $this->hosp_alteracao = $old_value_hosp_alteracao;
   $this->hosp_alteracao_hora = $old_value_hosp_alteracao_hora;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos'][] = $rs->fields[0];
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
   $hosp_pagamentos_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_pagamentos_1))
          {
              foreach ($this->hosp_pagamentos_1 as $tmp_hosp_pagamentos)
              {
                  if (trim($tmp_hosp_pagamentos) === trim($cadaselect[1])) {$hosp_pagamentos_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_pagamentos) && trim($this->hosp_pagamentos) === trim($cadaselect[1])) {$hosp_pagamentos_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="hosp_pagamentos" value="<?php echo $this->form_encode_input($hosp_pagamentos) . "\">" . $hosp_pagamentos_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hosp_pagamentos();
   $x = 0 ; 
   $hosp_pagamentos_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hosp_pagamentos_1))
          {
              foreach ($this->hosp_pagamentos_1 as $tmp_hosp_pagamentos)
              {
                  if (trim($tmp_hosp_pagamentos) === trim($cadaselect[1])) {$hosp_pagamentos_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hosp_pagamentos)) {
                 if (trim($this->hosp_pagamentos) == trim($cadaselect[1])) { $hosp_pagamentos_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->hosp_pagamentos == $cadaselect[1]) { $hosp_pagamentos_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($hosp_pagamentos_look))
          {
              $hosp_pagamentos_look = $this->hosp_pagamentos;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hosp_pagamentos\" class=\"css_hosp_pagamentos_line\" style=\"" .  $sStyleReadLab_hosp_pagamentos . "\">" . $this->form_format_readonly("hosp_pagamentos", $this->form_encode_input($hosp_pagamentos_look)) . "</span><span id=\"id_read_off_hosp_pagamentos\" class=\"css_read_off_hosp_pagamentos" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hosp_pagamentos . "\">";
   echo " <span id=\"idAjaxSelect_hosp_pagamentos\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hosp_pagamentos_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hosp_pagamentos\" name=\"hosp_pagamentos\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_pagamentos'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->hosp_pagamentos) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->hosp_pagamentos)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_pagamentos_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_pagamentos_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_diarias']))
    {
        $this->nm_new_label['hosp_diarias'] = "Diárias:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_diarias = $this->hosp_diarias;
   $sStyleHidden_hosp_diarias = '';
   if (isset($this->nmgp_cmp_hidden['hosp_diarias']) && $this->nmgp_cmp_hidden['hosp_diarias'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_diarias']);
       $sStyleHidden_hosp_diarias = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_diarias = 'display: none;';
   $sStyleReadInp_hosp_diarias = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_diarias']) && $this->nmgp_cmp_readonly['hosp_diarias'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_diarias']);
       $sStyleReadLab_hosp_diarias = '';
       $sStyleReadInp_hosp_diarias = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_diarias']) && $this->nmgp_cmp_hidden['hosp_diarias'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_diarias" value="<?php echo $this->form_encode_input($hosp_diarias) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_diarias_label" id="hidden_field_label_hosp_diarias" style="<?php echo $sStyleHidden_hosp_diarias; ?>"><span id="id_label_hosp_diarias"><?php echo $this->nm_new_label['hosp_diarias']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_diarias_line" id="hidden_field_data_hosp_diarias" style="<?php echo $sStyleHidden_hosp_diarias; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_diarias_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_diarias"]) &&  $this->nmgp_cmp_readonly["hosp_diarias"] == "on") { 

 ?>
<input type="hidden" name="hosp_diarias" value="<?php echo $this->form_encode_input($hosp_diarias) . "\">" . $hosp_diarias . ""; ?>
<?php } else { ?>
<span id="id_read_on_hosp_diarias" class="sc-ui-readonly-hosp_diarias css_hosp_diarias_line" style="<?php echo $sStyleReadLab_hosp_diarias; ?>"><?php echo $this->form_format_readonly("hosp_diarias", $this->form_encode_input($this->hosp_diarias)); ?></span><span id="id_read_off_hosp_diarias" class="css_read_off_hosp_diarias<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hosp_diarias; ?>">
 <input class="sc-js-input scFormObjectOdd css_hosp_diarias_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_diarias" type=text name="hosp_diarias" value="<?php echo $this->form_encode_input($hosp_diarias) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=12"; } ?> alt="{datatype: 'decimal', maxLength: 12, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['hosp_diarias']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['hosp_diarias']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['hosp_diarias']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['hosp_diarias']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_diarias_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_diarias_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_taxas']))
    {
        $this->nm_new_label['hosp_taxas'] = "Taxas:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_taxas = $this->hosp_taxas;
   $sStyleHidden_hosp_taxas = '';
   if (isset($this->nmgp_cmp_hidden['hosp_taxas']) && $this->nmgp_cmp_hidden['hosp_taxas'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_taxas']);
       $sStyleHidden_hosp_taxas = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_taxas = 'display: none;';
   $sStyleReadInp_hosp_taxas = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_taxas']) && $this->nmgp_cmp_readonly['hosp_taxas'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_taxas']);
       $sStyleReadLab_hosp_taxas = '';
       $sStyleReadInp_hosp_taxas = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_taxas']) && $this->nmgp_cmp_hidden['hosp_taxas'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_taxas" value="<?php echo $this->form_encode_input($hosp_taxas) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_taxas_label" id="hidden_field_label_hosp_taxas" style="<?php echo $sStyleHidden_hosp_taxas; ?>"><span id="id_label_hosp_taxas"><?php echo $this->nm_new_label['hosp_taxas']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_taxas_line" id="hidden_field_data_hosp_taxas" style="<?php echo $sStyleHidden_hosp_taxas; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_taxas_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_taxas"]) &&  $this->nmgp_cmp_readonly["hosp_taxas"] == "on") { 

 ?>
<input type="hidden" name="hosp_taxas" value="<?php echo $this->form_encode_input($hosp_taxas) . "\">" . $hosp_taxas . ""; ?>
<?php } else { ?>
<span id="id_read_on_hosp_taxas" class="sc-ui-readonly-hosp_taxas css_hosp_taxas_line" style="<?php echo $sStyleReadLab_hosp_taxas; ?>"><?php echo $this->form_format_readonly("hosp_taxas", $this->form_encode_input($this->hosp_taxas)); ?></span><span id="id_read_off_hosp_taxas" class="css_read_off_hosp_taxas<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hosp_taxas; ?>">
 <input class="sc-js-input scFormObjectOdd css_hosp_taxas_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_taxas" type=text name="hosp_taxas" value="<?php echo $this->form_encode_input($hosp_taxas) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=12"; } ?> alt="{datatype: 'decimal', maxLength: 12, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['hosp_taxas']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['hosp_taxas']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['hosp_taxas']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['hosp_taxas']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_taxas_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_taxas_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_total']))
    {
        $this->nm_new_label['hosp_total'] = "Total:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_total = $this->hosp_total;
   $sStyleHidden_hosp_total = '';
   if (isset($this->nmgp_cmp_hidden['hosp_total']) && $this->nmgp_cmp_hidden['hosp_total'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_total']);
       $sStyleHidden_hosp_total = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_total = 'display: none;';
   $sStyleReadInp_hosp_total = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_total']) && $this->nmgp_cmp_readonly['hosp_total'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_total']);
       $sStyleReadLab_hosp_total = '';
       $sStyleReadInp_hosp_total = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_total']) && $this->nmgp_cmp_hidden['hosp_total'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_total" value="<?php echo $this->form_encode_input($hosp_total) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_total_label" id="hidden_field_label_hosp_total" style="<?php echo $sStyleHidden_hosp_total; ?>"><span id="id_label_hosp_total"><?php echo $this->nm_new_label['hosp_total']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_total_line" id="hidden_field_data_hosp_total" style="<?php echo $sStyleHidden_hosp_total; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_total_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="hosp_total" value="<?php echo $this->form_encode_input($hosp_total); ?>"><span id="id_ajax_label_hosp_total"><?php echo nl2br($hosp_total); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_total_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_total_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['hosp_dsc_pacote']))
    {
        $this->nm_new_label['hosp_dsc_pacote'] = "Pacote:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_dsc_pacote = $this->hosp_dsc_pacote;
   $sStyleHidden_hosp_dsc_pacote = '';
   if (isset($this->nmgp_cmp_hidden['hosp_dsc_pacote']) && $this->nmgp_cmp_hidden['hosp_dsc_pacote'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_dsc_pacote']);
       $sStyleHidden_hosp_dsc_pacote = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_dsc_pacote = 'display: none;';
   $sStyleReadInp_hosp_dsc_pacote = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_dsc_pacote']) && $this->nmgp_cmp_readonly['hosp_dsc_pacote'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_dsc_pacote']);
       $sStyleReadLab_hosp_dsc_pacote = '';
       $sStyleReadInp_hosp_dsc_pacote = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_dsc_pacote']) && $this->nmgp_cmp_hidden['hosp_dsc_pacote'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_dsc_pacote" value="<?php echo $this->form_encode_input($hosp_dsc_pacote) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_dsc_pacote_label" id="hidden_field_label_hosp_dsc_pacote" style="<?php echo $sStyleHidden_hosp_dsc_pacote; ?>"><span id="id_label_hosp_dsc_pacote"><?php echo $this->nm_new_label['hosp_dsc_pacote']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_dsc_pacote_line" id="hidden_field_data_hosp_dsc_pacote" style="<?php echo $sStyleHidden_hosp_dsc_pacote; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_dsc_pacote_line" style="vertical-align: top;padding: 0px">
<?php
$hosp_dsc_pacote_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($hosp_dsc_pacote));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_dsc_pacote"]) &&  $this->nmgp_cmp_readonly["hosp_dsc_pacote"] == "on") { 

 ?>
<input type="hidden" name="hosp_dsc_pacote" value="<?php echo $this->form_encode_input($hosp_dsc_pacote) . "\">" . $hosp_dsc_pacote_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_hosp_dsc_pacote" class="sc-ui-readonly-hosp_dsc_pacote css_hosp_dsc_pacote_line" style="<?php echo $sStyleReadLab_hosp_dsc_pacote; ?>"><?php echo $this->form_format_readonly("hosp_dsc_pacote", $this->form_encode_input($hosp_dsc_pacote_val)); ?></span><span id="id_read_off_hosp_dsc_pacote" class="css_read_off_hosp_dsc_pacote<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hosp_dsc_pacote; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_hosp_dsc_pacote_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="hosp_dsc_pacote" id="id_sc_field_hosp_dsc_pacote" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $hosp_dsc_pacote; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_dsc_pacote_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_dsc_pacote_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_id_usuario']))
    {
        $this->nm_new_label['hosp_id_usuario'] = "Último Atendente:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_id_usuario = $this->hosp_id_usuario;
   $sStyleHidden_hosp_id_usuario = '';
   if (isset($this->nmgp_cmp_hidden['hosp_id_usuario']) && $this->nmgp_cmp_hidden['hosp_id_usuario'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_id_usuario']);
       $sStyleHidden_hosp_id_usuario = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_id_usuario = 'display: none;';
   $sStyleReadInp_hosp_id_usuario = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_id_usuario']) && $this->nmgp_cmp_readonly['hosp_id_usuario'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_id_usuario']);
       $sStyleReadLab_hosp_id_usuario = '';
       $sStyleReadInp_hosp_id_usuario = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_id_usuario']) && $this->nmgp_cmp_hidden['hosp_id_usuario'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_id_usuario" value="<?php echo $this->form_encode_input($hosp_id_usuario) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_id_usuario_label" id="hidden_field_label_hosp_id_usuario" style="<?php echo $sStyleHidden_hosp_id_usuario; ?>"><span id="id_label_hosp_id_usuario"><?php echo $this->nm_new_label['hosp_id_usuario']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_id_usuario_line" id="hidden_field_data_hosp_id_usuario" style="<?php echo $sStyleHidden_hosp_id_usuario; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_id_usuario_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="hosp_id_usuario" value="<?php echo $this->form_encode_input($hosp_id_usuario); ?>"><span id="id_ajax_label_hosp_id_usuario"><?php echo nl2br($hosp_id_usuario); ?></span>
 <SPAN id="id_lookup_hosp_id_usuario" style="font-size: 14px; color: #33CCFF"><?php echo $look_rpc_hosp_id_usuario; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_id_usuario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_id_usuario_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_alteracao']))
    {
        $this->nm_new_label['hosp_alteracao'] = "Alterado em:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_hosp_alteracao = $this->hosp_alteracao;
   if (strlen($this->hosp_alteracao_hora) > 8 ) {$this->hosp_alteracao_hora = substr($this->hosp_alteracao_hora, 0, 8);}
   $this->hosp_alteracao .= ' ' . $this->hosp_alteracao_hora;
   $this->hosp_alteracao  = trim($this->hosp_alteracao);
   $hosp_alteracao = $this->hosp_alteracao;
   $sStyleHidden_hosp_alteracao = '';
   if (isset($this->nmgp_cmp_hidden['hosp_alteracao']) && $this->nmgp_cmp_hidden['hosp_alteracao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_alteracao']);
       $sStyleHidden_hosp_alteracao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_alteracao = 'display: none;';
   $sStyleReadInp_hosp_alteracao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_alteracao']) && $this->nmgp_cmp_readonly['hosp_alteracao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_alteracao']);
       $sStyleReadLab_hosp_alteracao = '';
       $sStyleReadInp_hosp_alteracao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_alteracao']) && $this->nmgp_cmp_hidden['hosp_alteracao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_alteracao" value="<?php echo $this->form_encode_input($hosp_alteracao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_alteracao_label" id="hidden_field_label_hosp_alteracao" style="<?php echo $sStyleHidden_hosp_alteracao; ?>"><span id="id_label_hosp_alteracao"><?php echo $this->nm_new_label['hosp_alteracao']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_alteracao_line" id="hidden_field_data_hosp_alteracao" style="<?php echo $sStyleHidden_hosp_alteracao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_alteracao_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="hosp_alteracao" value="<?php echo $this->form_encode_input($hosp_alteracao); ?>"><span id="id_ajax_label_hosp_alteracao"><?php echo nl2br($hosp_alteracao); ?></span>
<?php
$tmp_form_data = $this->field_config['hosp_alteracao']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_alteracao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_alteracao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>
<?php
   $this->hosp_alteracao = $old_dt_hosp_alteracao;
?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hosp_observacoes']))
    {
        $this->nm_new_label['hosp_observacoes'] = "Observações:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_observacoes = $this->hosp_observacoes;
   $sStyleHidden_hosp_observacoes = '';
   if (isset($this->nmgp_cmp_hidden['hosp_observacoes']) && $this->nmgp_cmp_hidden['hosp_observacoes'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_observacoes']);
       $sStyleHidden_hosp_observacoes = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_observacoes = 'display: none;';
   $sStyleReadInp_hosp_observacoes = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_observacoes']) && $this->nmgp_cmp_readonly['hosp_observacoes'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_observacoes']);
       $sStyleReadLab_hosp_observacoes = '';
       $sStyleReadInp_hosp_observacoes = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_observacoes']) && $this->nmgp_cmp_hidden['hosp_observacoes'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hosp_observacoes" value="<?php echo $this->form_encode_input($hosp_observacoes) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_observacoes_label" id="hidden_field_label_hosp_observacoes" style="<?php echo $sStyleHidden_hosp_observacoes; ?>"><span id="id_label_hosp_observacoes"><?php echo $this->nm_new_label['hosp_observacoes']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_observacoes_line" id="hidden_field_data_hosp_observacoes" style="<?php echo $sStyleHidden_hosp_observacoes; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_observacoes_line" style="vertical-align: top;padding: 0px">
<?php
$hosp_observacoes_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($hosp_observacoes));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_observacoes"]) &&  $this->nmgp_cmp_readonly["hosp_observacoes"] == "on") { 

 ?>
<input type="hidden" name="hosp_observacoes" value="<?php echo $this->form_encode_input($hosp_observacoes) . "\">" . $hosp_observacoes_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_hosp_observacoes" class="sc-ui-readonly-hosp_observacoes css_hosp_observacoes_line" style="<?php echo $sStyleReadLab_hosp_observacoes; ?>"><?php echo $this->form_format_readonly("hosp_observacoes", $this->form_encode_input($hosp_observacoes_val)); ?></span><span id="id_read_off_hosp_observacoes" class="css_read_off_hosp_observacoes<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hosp_observacoes; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_hosp_observacoes_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="hosp_observacoes" id="id_sc_field_hosp_observacoes" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $hosp_observacoes; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_observacoes_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_observacoes_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['acmq_01']))
           {
               $this->nmgp_cmp_readonly['acmq_01'] = 'on';
           }
?>


   <?php
   if (!isset($this->nm_new_label['hosp_ativo']))
   {
       $this->nm_new_label['hosp_ativo'] = "Registro Ativo:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hosp_ativo = $this->hosp_ativo;
   $sStyleHidden_hosp_ativo = '';
   if (isset($this->nmgp_cmp_hidden['hosp_ativo']) && $this->nmgp_cmp_hidden['hosp_ativo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hosp_ativo']);
       $sStyleHidden_hosp_ativo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hosp_ativo = 'display: none;';
   $sStyleReadInp_hosp_ativo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hosp_ativo']) && $this->nmgp_cmp_readonly['hosp_ativo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hosp_ativo']);
       $sStyleReadLab_hosp_ativo = '';
       $sStyleReadInp_hosp_ativo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hosp_ativo']) && $this->nmgp_cmp_hidden['hosp_ativo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hosp_ativo" value="<?php echo $this->form_encode_input($this->hosp_ativo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hosp_ativo_label" id="hidden_field_label_hosp_ativo" style="<?php echo $sStyleHidden_hosp_ativo; ?>"><span id="id_label_hosp_ativo"><?php echo $this->nm_new_label['hosp_ativo']; ?></span></TD>
    <TD class="scFormDataOdd css_hosp_ativo_line" id="hidden_field_data_hosp_ativo" style="<?php echo $sStyleHidden_hosp_ativo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hosp_ativo_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hosp_ativo"]) &&  $this->nmgp_cmp_readonly["hosp_ativo"] == "on") { 

$hosp_ativo_look = "";
 if ($this->hosp_ativo == "Y") { $hosp_ativo_look .= "Ativo" ;} 
 if ($this->hosp_ativo == "N") { $hosp_ativo_look .= "Inativo" ;} 
 if (empty($hosp_ativo_look)) { $hosp_ativo_look = $this->hosp_ativo; }
?>
<input type="hidden" name="hosp_ativo" value="<?php echo $this->form_encode_input($hosp_ativo) . "\">" . $hosp_ativo_look . ""; ?>
<?php } else { ?>
<?php

$hosp_ativo_look = "";
 if ($this->hosp_ativo == "Y") { $hosp_ativo_look .= "Ativo" ;} 
 if ($this->hosp_ativo == "N") { $hosp_ativo_look .= "Inativo" ;} 
 if (empty($hosp_ativo_look)) { $hosp_ativo_look = $this->hosp_ativo; }
?>
<span id="id_read_on_hosp_ativo" class="css_hosp_ativo_line"  style="<?php echo $sStyleReadLab_hosp_ativo; ?>"><?php echo $this->form_format_readonly("hosp_ativo", $this->form_encode_input($hosp_ativo_look)); ?></span><span id="id_read_off_hosp_ativo" class="css_read_off_hosp_ativo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_hosp_ativo; ?>">
 <span id="idAjaxSelect_hosp_ativo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_hosp_ativo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hosp_ativo" name="hosp_ativo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="Y" <?php  if ($this->hosp_ativo == "Y") { echo " selected" ;} ?><?php  if (empty($this->hosp_ativo)) { echo " selected" ;} ?>>Ativo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_ativo'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->hosp_ativo == "N") { echo " selected" ;} ?>>Inativo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['Lookup_hosp_ativo'][] = 'N'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hosp_ativo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hosp_ativo_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['acmq_02']))
           {
               $this->nmgp_cmp_readonly['acmq_02'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['acmq_01']))
    {
        $this->nm_new_label['acmq_01'] = "Acompanhante 01";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $acmq_01 = $this->acmq_01;
   $sStyleHidden_acmq_01 = '';
   if (isset($this->nmgp_cmp_hidden['acmq_01']) && $this->nmgp_cmp_hidden['acmq_01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['acmq_01']);
       $sStyleHidden_acmq_01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_acmq_01 = 'display: none;';
   $sStyleReadInp_acmq_01 = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["acmq_01"]) &&  $this->nmgp_cmp_readonly["acmq_01"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['acmq_01']);
       $sStyleReadLab_acmq_01 = '';
       $sStyleReadInp_acmq_01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['acmq_01']) && $this->nmgp_cmp_hidden['acmq_01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="acmq_01" value="<?php echo $this->form_encode_input($acmq_01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_acmq_01_label" id="hidden_field_label_acmq_01" style="<?php echo $sStyleHidden_acmq_01; ?>"><span id="id_label_acmq_01"><?php echo $this->nm_new_label['acmq_01']; ?></span></TD>
    <TD class="scFormDataOdd css_acmq_01_line" id="hidden_field_data_acmq_01" style="<?php echo $sStyleHidden_acmq_01; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_acmq_01_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["acmq_01"]) &&  $this->nmgp_cmp_readonly["acmq_01"] == "on")) { 

 ?>
<input type="hidden" name="acmq_01" value="<?php echo $this->form_encode_input($acmq_01) . "\"><span id=\"id_ajax_label_acmq_01\">" . $acmq_01 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_acmq_01" class="sc-ui-readonly-acmq_01 css_acmq_01_line" style="<?php echo $sStyleReadLab_acmq_01; ?>"><?php echo $this->form_format_readonly("acmq_01", $this->form_encode_input($this->acmq_01)); ?></span><span id="id_read_off_acmq_01" class="css_read_off_acmq_01<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_acmq_01; ?>">
 <input class="sc-js-input scFormObjectOdd css_acmq_01_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_acmq_01" type=text name="acmq_01" value="<?php echo $this->form_encode_input($acmq_01) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> maxlength=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_acmq_01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_acmq_01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['acmq_03']))
           {
               $this->nmgp_cmp_readonly['acmq_03'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['acmq_02']))
    {
        $this->nm_new_label['acmq_02'] = "Acompanhante 02";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $acmq_02 = $this->acmq_02;
   $sStyleHidden_acmq_02 = '';
   if (isset($this->nmgp_cmp_hidden['acmq_02']) && $this->nmgp_cmp_hidden['acmq_02'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['acmq_02']);
       $sStyleHidden_acmq_02 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_acmq_02 = 'display: none;';
   $sStyleReadInp_acmq_02 = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["acmq_02"]) &&  $this->nmgp_cmp_readonly["acmq_02"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['acmq_02']);
       $sStyleReadLab_acmq_02 = '';
       $sStyleReadInp_acmq_02 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['acmq_02']) && $this->nmgp_cmp_hidden['acmq_02'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="acmq_02" value="<?php echo $this->form_encode_input($acmq_02) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_acmq_02_label" id="hidden_field_label_acmq_02" style="<?php echo $sStyleHidden_acmq_02; ?>"><span id="id_label_acmq_02"><?php echo $this->nm_new_label['acmq_02']; ?></span></TD>
    <TD class="scFormDataOdd css_acmq_02_line" id="hidden_field_data_acmq_02" style="<?php echo $sStyleHidden_acmq_02; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_acmq_02_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["acmq_02"]) &&  $this->nmgp_cmp_readonly["acmq_02"] == "on")) { 

 ?>
<input type="hidden" name="acmq_02" value="<?php echo $this->form_encode_input($acmq_02) . "\"><span id=\"id_ajax_label_acmq_02\">" . $acmq_02 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_acmq_02" class="sc-ui-readonly-acmq_02 css_acmq_02_line" style="<?php echo $sStyleReadLab_acmq_02; ?>"><?php echo $this->form_format_readonly("acmq_02", $this->form_encode_input($this->acmq_02)); ?></span><span id="id_read_off_acmq_02" class="css_read_off_acmq_02<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_acmq_02; ?>">
 <input class="sc-js-input scFormObjectOdd css_acmq_02_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_acmq_02" type=text name="acmq_02" value="<?php echo $this->form_encode_input($acmq_02) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> maxlength=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_acmq_02_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_acmq_02_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['acmq_04']))
           {
               $this->nmgp_cmp_readonly['acmq_04'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['acmq_03']))
    {
        $this->nm_new_label['acmq_03'] = "Acompanhante 03";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $acmq_03 = $this->acmq_03;
   $sStyleHidden_acmq_03 = '';
   if (isset($this->nmgp_cmp_hidden['acmq_03']) && $this->nmgp_cmp_hidden['acmq_03'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['acmq_03']);
       $sStyleHidden_acmq_03 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_acmq_03 = 'display: none;';
   $sStyleReadInp_acmq_03 = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["acmq_03"]) &&  $this->nmgp_cmp_readonly["acmq_03"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['acmq_03']);
       $sStyleReadLab_acmq_03 = '';
       $sStyleReadInp_acmq_03 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['acmq_03']) && $this->nmgp_cmp_hidden['acmq_03'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="acmq_03" value="<?php echo $this->form_encode_input($acmq_03) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_acmq_03_label" id="hidden_field_label_acmq_03" style="<?php echo $sStyleHidden_acmq_03; ?>"><span id="id_label_acmq_03"><?php echo $this->nm_new_label['acmq_03']; ?></span></TD>
    <TD class="scFormDataOdd css_acmq_03_line" id="hidden_field_data_acmq_03" style="<?php echo $sStyleHidden_acmq_03; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_acmq_03_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["acmq_03"]) &&  $this->nmgp_cmp_readonly["acmq_03"] == "on")) { 

 ?>
<input type="hidden" name="acmq_03" value="<?php echo $this->form_encode_input($acmq_03) . "\"><span id=\"id_ajax_label_acmq_03\">" . $acmq_03 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_acmq_03" class="sc-ui-readonly-acmq_03 css_acmq_03_line" style="<?php echo $sStyleReadLab_acmq_03; ?>"><?php echo $this->form_format_readonly("acmq_03", $this->form_encode_input($this->acmq_03)); ?></span><span id="id_read_off_acmq_03" class="css_read_off_acmq_03<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_acmq_03; ?>">
 <input class="sc-js-input scFormObjectOdd css_acmq_03_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_acmq_03" type=text name="acmq_03" value="<?php echo $this->form_encode_input($acmq_03) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> maxlength=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_acmq_03_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_acmq_03_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['pamq_01']))
           {
               $this->nmgp_cmp_readonly['pamq_01'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['acmq_04']))
    {
        $this->nm_new_label['acmq_04'] = "Acompanhante 04";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $acmq_04 = $this->acmq_04;
   $sStyleHidden_acmq_04 = '';
   if (isset($this->nmgp_cmp_hidden['acmq_04']) && $this->nmgp_cmp_hidden['acmq_04'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['acmq_04']);
       $sStyleHidden_acmq_04 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_acmq_04 = 'display: none;';
   $sStyleReadInp_acmq_04 = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["acmq_04"]) &&  $this->nmgp_cmp_readonly["acmq_04"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['acmq_04']);
       $sStyleReadLab_acmq_04 = '';
       $sStyleReadInp_acmq_04 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['acmq_04']) && $this->nmgp_cmp_hidden['acmq_04'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="acmq_04" value="<?php echo $this->form_encode_input($acmq_04) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_acmq_04_label" id="hidden_field_label_acmq_04" style="<?php echo $sStyleHidden_acmq_04; ?>"><span id="id_label_acmq_04"><?php echo $this->nm_new_label['acmq_04']; ?></span></TD>
    <TD class="scFormDataOdd css_acmq_04_line" id="hidden_field_data_acmq_04" style="<?php echo $sStyleHidden_acmq_04; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_acmq_04_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["acmq_04"]) &&  $this->nmgp_cmp_readonly["acmq_04"] == "on")) { 

 ?>
<input type="hidden" name="acmq_04" value="<?php echo $this->form_encode_input($acmq_04) . "\"><span id=\"id_ajax_label_acmq_04\">" . $acmq_04 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_acmq_04" class="sc-ui-readonly-acmq_04 css_acmq_04_line" style="<?php echo $sStyleReadLab_acmq_04; ?>"><?php echo $this->form_format_readonly("acmq_04", $this->form_encode_input($this->acmq_04)); ?></span><span id="id_read_off_acmq_04" class="css_read_off_acmq_04<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_acmq_04; ?>">
 <input class="sc-js-input scFormObjectOdd css_acmq_04_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_acmq_04" type=text name="acmq_04" value="<?php echo $this->form_encode_input($acmq_04) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> maxlength=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_acmq_04_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_acmq_04_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['pamq_02']))
           {
               $this->nmgp_cmp_readonly['pamq_02'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['pamq_01']))
    {
        $this->nm_new_label['pamq_01'] = "Participante 01";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $pamq_01 = $this->pamq_01;
   $sStyleHidden_pamq_01 = '';
   if (isset($this->nmgp_cmp_hidden['pamq_01']) && $this->nmgp_cmp_hidden['pamq_01'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['pamq_01']);
       $sStyleHidden_pamq_01 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_pamq_01 = 'display: none;';
   $sStyleReadInp_pamq_01 = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["pamq_01"]) &&  $this->nmgp_cmp_readonly["pamq_01"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['pamq_01']);
       $sStyleReadLab_pamq_01 = '';
       $sStyleReadInp_pamq_01 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['pamq_01']) && $this->nmgp_cmp_hidden['pamq_01'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="pamq_01" value="<?php echo $this->form_encode_input($pamq_01) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_pamq_01_label" id="hidden_field_label_pamq_01" style="<?php echo $sStyleHidden_pamq_01; ?>"><span id="id_label_pamq_01"><?php echo $this->nm_new_label['pamq_01']; ?></span></TD>
    <TD class="scFormDataOdd css_pamq_01_line" id="hidden_field_data_pamq_01" style="<?php echo $sStyleHidden_pamq_01; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_pamq_01_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["pamq_01"]) &&  $this->nmgp_cmp_readonly["pamq_01"] == "on")) { 

 ?>
<input type="hidden" name="pamq_01" value="<?php echo $this->form_encode_input($pamq_01) . "\"><span id=\"id_ajax_label_pamq_01\">" . $pamq_01 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_pamq_01" class="sc-ui-readonly-pamq_01 css_pamq_01_line" style="<?php echo $sStyleReadLab_pamq_01; ?>"><?php echo $this->form_format_readonly("pamq_01", $this->form_encode_input($this->pamq_01)); ?></span><span id="id_read_off_pamq_01" class="css_read_off_pamq_01<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_pamq_01; ?>">
 <input class="sc-js-input scFormObjectOdd css_pamq_01_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_pamq_01" type=text name="pamq_01" value="<?php echo $this->form_encode_input($pamq_01) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> maxlength=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_pamq_01_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_pamq_01_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['pamq_03']))
           {
               $this->nmgp_cmp_readonly['pamq_03'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['pamq_02']))
    {
        $this->nm_new_label['pamq_02'] = "Participante 02";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $pamq_02 = $this->pamq_02;
   $sStyleHidden_pamq_02 = '';
   if (isset($this->nmgp_cmp_hidden['pamq_02']) && $this->nmgp_cmp_hidden['pamq_02'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['pamq_02']);
       $sStyleHidden_pamq_02 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_pamq_02 = 'display: none;';
   $sStyleReadInp_pamq_02 = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["pamq_02"]) &&  $this->nmgp_cmp_readonly["pamq_02"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['pamq_02']);
       $sStyleReadLab_pamq_02 = '';
       $sStyleReadInp_pamq_02 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['pamq_02']) && $this->nmgp_cmp_hidden['pamq_02'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="pamq_02" value="<?php echo $this->form_encode_input($pamq_02) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_pamq_02_label" id="hidden_field_label_pamq_02" style="<?php echo $sStyleHidden_pamq_02; ?>"><span id="id_label_pamq_02"><?php echo $this->nm_new_label['pamq_02']; ?></span></TD>
    <TD class="scFormDataOdd css_pamq_02_line" id="hidden_field_data_pamq_02" style="<?php echo $sStyleHidden_pamq_02; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_pamq_02_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["pamq_02"]) &&  $this->nmgp_cmp_readonly["pamq_02"] == "on")) { 

 ?>
<input type="hidden" name="pamq_02" value="<?php echo $this->form_encode_input($pamq_02) . "\"><span id=\"id_ajax_label_pamq_02\">" . $pamq_02 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_pamq_02" class="sc-ui-readonly-pamq_02 css_pamq_02_line" style="<?php echo $sStyleReadLab_pamq_02; ?>"><?php echo $this->form_format_readonly("pamq_02", $this->form_encode_input($this->pamq_02)); ?></span><span id="id_read_off_pamq_02" class="css_read_off_pamq_02<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_pamq_02; ?>">
 <input class="sc-js-input scFormObjectOdd css_pamq_02_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_pamq_02" type=text name="pamq_02" value="<?php echo $this->form_encode_input($pamq_02) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> maxlength=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_pamq_02_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_pamq_02_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['pamq_04']))
           {
               $this->nmgp_cmp_readonly['pamq_04'] = 'on';
           }
?>


   <?php
    if (!isset($this->nm_new_label['pamq_03']))
    {
        $this->nm_new_label['pamq_03'] = "Participante 03";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $pamq_03 = $this->pamq_03;
   $sStyleHidden_pamq_03 = '';
   if (isset($this->nmgp_cmp_hidden['pamq_03']) && $this->nmgp_cmp_hidden['pamq_03'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['pamq_03']);
       $sStyleHidden_pamq_03 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_pamq_03 = 'display: none;';
   $sStyleReadInp_pamq_03 = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["pamq_03"]) &&  $this->nmgp_cmp_readonly["pamq_03"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['pamq_03']);
       $sStyleReadLab_pamq_03 = '';
       $sStyleReadInp_pamq_03 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['pamq_03']) && $this->nmgp_cmp_hidden['pamq_03'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="pamq_03" value="<?php echo $this->form_encode_input($pamq_03) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_pamq_03_label" id="hidden_field_label_pamq_03" style="<?php echo $sStyleHidden_pamq_03; ?>"><span id="id_label_pamq_03"><?php echo $this->nm_new_label['pamq_03']; ?></span></TD>
    <TD class="scFormDataOdd css_pamq_03_line" id="hidden_field_data_pamq_03" style="<?php echo $sStyleHidden_pamq_03; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_pamq_03_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["pamq_03"]) &&  $this->nmgp_cmp_readonly["pamq_03"] == "on")) { 

 ?>
<input type="hidden" name="pamq_03" value="<?php echo $this->form_encode_input($pamq_03) . "\"><span id=\"id_ajax_label_pamq_03\">" . $pamq_03 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_pamq_03" class="sc-ui-readonly-pamq_03 css_pamq_03_line" style="<?php echo $sStyleReadLab_pamq_03; ?>"><?php echo $this->form_format_readonly("pamq_03", $this->form_encode_input($this->pamq_03)); ?></span><span id="id_read_off_pamq_03" class="css_read_off_pamq_03<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_pamq_03; ?>">
 <input class="sc-js-input scFormObjectOdd css_pamq_03_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_pamq_03" type=text name="pamq_03" value="<?php echo $this->form_encode_input($pamq_03) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> maxlength=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_pamq_03_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_pamq_03_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['pamq_04']))
    {
        $this->nm_new_label['pamq_04'] = "Participante 04";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $pamq_04 = $this->pamq_04;
   $sStyleHidden_pamq_04 = '';
   if (isset($this->nmgp_cmp_hidden['pamq_04']) && $this->nmgp_cmp_hidden['pamq_04'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['pamq_04']);
       $sStyleHidden_pamq_04 = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_pamq_04 = 'display: none;';
   $sStyleReadInp_pamq_04 = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["pamq_04"]) &&  $this->nmgp_cmp_readonly["pamq_04"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['pamq_04']);
       $sStyleReadLab_pamq_04 = '';
       $sStyleReadInp_pamq_04 = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['pamq_04']) && $this->nmgp_cmp_hidden['pamq_04'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="pamq_04" value="<?php echo $this->form_encode_input($pamq_04) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_pamq_04_label" id="hidden_field_label_pamq_04" style="<?php echo $sStyleHidden_pamq_04; ?>"><span id="id_label_pamq_04"><?php echo $this->nm_new_label['pamq_04']; ?></span></TD>
    <TD class="scFormDataOdd css_pamq_04_line" id="hidden_field_data_pamq_04" style="<?php echo $sStyleHidden_pamq_04; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_pamq_04_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || (isset($this->nmgp_cmp_readonly["pamq_04"]) &&  $this->nmgp_cmp_readonly["pamq_04"] == "on")) { 

 ?>
<input type="hidden" name="pamq_04" value="<?php echo $this->form_encode_input($pamq_04) . "\"><span id=\"id_ajax_label_pamq_04\">" . $pamq_04 . "</span>"; ?>
<?php } else { ?>
<span id="id_read_on_pamq_04" class="sc-ui-readonly-pamq_04 css_pamq_04_line" style="<?php echo $sStyleReadLab_pamq_04; ?>"><?php echo $this->form_format_readonly("pamq_04", $this->form_encode_input($this->pamq_04)); ?></span><span id="id_read_off_pamq_04" class="css_read_off_pamq_04<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_pamq_04; ?>">
 <input class="sc-js-input scFormObjectOdd css_pamq_04_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_pamq_04" type=text name="pamq_04" value="<?php echo $this->form_encode_input($pamq_04) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=13"; } ?> maxlength=13 alt="{datatype: 'text', maxLength: 13, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_pamq_04_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_pamq_04_text"></span></td></tr></table></td></tr></table></TD>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['birpara'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['first'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['back'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['forward'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['masterValue']);
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
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_hospedagem_rsvp");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_hospedagem_rsvp");
 parent.scAjaxDetailHeight("form_hospedagem_rsvp", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_hospedagem_rsvp", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_hospedagem_rsvp", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['sc_modal'])
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_hospedagem_rsvp']['inside_nested_iframe']) {
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
