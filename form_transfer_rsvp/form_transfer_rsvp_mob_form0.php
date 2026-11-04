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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_title'] . " transfer_rsvp"); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_title'] . " transfer_rsvp"); } ?></TITLE>
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
.css_read_off_tra_dt_chegada_proprio button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_tra_dt_ida_local button {
        background-color: transparent;
        border: 0;
        padding: 0
}
.css_read_off_tra_dt_volta_local button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_transfer_rsvp/form_transfer_rsvp_mob_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_transfer_rsvp_mob_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['last'] : 'off'); ?>";
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
<?php

include_once('form_transfer_rsvp_mob_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['recarga'];
}
if ('' != $this->tra_cpf_particip)
{
    $this->lookup_tra_cpf_particip($look_rpc_tra_cpf_particip);
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['link_info']['remove_border']) {
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

if (isset($_SESSION['scriptcase']['form_transfer_rsvp']['error_buffer']) && '' != $_SESSION['scriptcase']['form_transfer_rsvp']['error_buffer'])
{
    echo $_SESSION['scriptcase']['form_transfer_rsvp']['error_buffer'];
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
 include_once("form_transfer_rsvp_mob_js0.php");
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
               action="form_transfer_rsvp_mob.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['insert_validation']; ?>">
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
<input type="hidden" name="id_transfer" value="<?php  echo $this->form_encode_input($this->id_transfer) ?>">
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_transfer_rsvp_mob'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_transfer_rsvp_mob'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['fast_search'][2] : "";
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
          $SC_Label_atu['tra_id_evento'] = (isset($this->nm_new_label['tra_id_evento'])) ? $this->nm_new_label['tra_id_evento'] : 'Cód. Evento:'; 
          $SC_Label_atu['tra_cpf_particip'] = (isset($this->nm_new_label['tra_cpf_particip'])) ? $this->nm_new_label['tra_cpf_particip'] : 'ID Participante:'; 
          $SC_Label_atu['tra_id_usuario'] = (isset($this->nm_new_label['tra_id_usuario'])) ? $this->nm_new_label['tra_id_usuario'] : 'Cód. Atendente:'; 
          $SC_Label_atu['tra_tipo'] = (isset($this->nm_new_label['tra_tipo'])) ? $this->nm_new_label['tra_tipo'] : 'Tipo Transfer:'; 
          $SC_Label_atu['tra_id_hotel'] = (isset($this->nm_new_label['tra_id_hotel'])) ? $this->nm_new_label['tra_id_hotel'] : 'Cód. Hotel In:'; 
          $SC_Label_atu['tra_id_hotel_out'] = (isset($this->nm_new_label['tra_id_hotel_out'])) ? $this->nm_new_label['tra_id_hotel_out'] : 'Cód. Hotel Out:'; 
          $SC_Label_atu['enviar_app'] = (isset($this->nm_new_label['enviar_app'])) ? $this->nm_new_label['enviar_app'] : 'Gravar no APP:'; 
          $SC_Label_atu['tra_status'] = (isset($this->nm_new_label['tra_status'])) ? $this->nm_new_label['tra_status'] : 'Status Transfer:'; 
          $SC_Label_atu['tra_cia_ida'] = (isset($this->nm_new_label['tra_cia_ida'])) ? $this->nm_new_label['tra_cia_ida'] : 'Cód. Cia Aérea:'; 
          $SC_Label_atu['tra_numvoo_ida'] = (isset($this->nm_new_label['tra_numvoo_ida'])) ? $this->nm_new_label['tra_numvoo_ida'] : 'Num. Voo:'; 
          $SC_Label_atu['tra_origem_ida'] = (isset($this->nm_new_label['tra_origem_ida'])) ? $this->nm_new_label['tra_origem_ida'] : 'Cód. Origerm:'; 
          $SC_Label_atu['tra_destino_ida'] = (isset($this->nm_new_label['tra_destino_ida'])) ? $this->nm_new_label['tra_destino_ida'] : 'Cód. Destino:'; 
          $SC_Label_atu['tra_dt_saida_ida'] = (isset($this->nm_new_label['tra_dt_saida_ida'])) ? $this->nm_new_label['tra_dt_saida_ida'] : 'Data Saída:'; 
          $SC_Label_atu['tra_hr_saida_ida'] = (isset($this->nm_new_label['tra_hr_saida_ida'])) ? $this->nm_new_label['tra_hr_saida_ida'] : 'Hora Saída:'; 
          $SC_Label_atu['tra_dt_chegada_ida'] = (isset($this->nm_new_label['tra_dt_chegada_ida'])) ? $this->nm_new_label['tra_dt_chegada_ida'] : 'Data Chegada:'; 
          $SC_Label_atu['tra_hr_chegada_ida'] = (isset($this->nm_new_label['tra_hr_chegada_ida'])) ? $this->nm_new_label['tra_hr_chegada_ida'] : 'Hora Chegada:'; 
          $SC_Label_atu['tra_localizador_ida'] = (isset($this->nm_new_label['tra_localizador_ida'])) ? $this->nm_new_label['tra_localizador_ida'] : 'Localizador: '; 
          $SC_Label_atu['tra_eticket_ida'] = (isset($this->nm_new_label['tra_eticket_ida'])) ? $this->nm_new_label['tra_eticket_ida'] : 'E-Ticket:'; 
          $SC_Label_atu['tra_flag_ida'] = (isset($this->nm_new_label['tra_flag_ida'])) ? $this->nm_new_label['tra_flag_ida'] : 'IDA:'; 
          $SC_Label_atu['tra_cia_volta'] = (isset($this->nm_new_label['tra_cia_volta'])) ? $this->nm_new_label['tra_cia_volta'] : 'Cód. Cia Aérea:'; 
          $SC_Label_atu['tra_numvoo_volta'] = (isset($this->nm_new_label['tra_numvoo_volta'])) ? $this->nm_new_label['tra_numvoo_volta'] : 'Cód. Voo:'; 
          $SC_Label_atu['tra_origem_volta'] = (isset($this->nm_new_label['tra_origem_volta'])) ? $this->nm_new_label['tra_origem_volta'] : 'Cód. Origem:'; 
          $SC_Label_atu['tra_destino_volta'] = (isset($this->nm_new_label['tra_destino_volta'])) ? $this->nm_new_label['tra_destino_volta'] : 'Cód. Destino:'; 
          $SC_Label_atu['tra_dt_saida_volta'] = (isset($this->nm_new_label['tra_dt_saida_volta'])) ? $this->nm_new_label['tra_dt_saida_volta'] : 'Data Saída:'; 
          $SC_Label_atu['tra_hr_saida_volta'] = (isset($this->nm_new_label['tra_hr_saida_volta'])) ? $this->nm_new_label['tra_hr_saida_volta'] : 'Hora Saída:'; 
          $SC_Label_atu['tra_dt_chegada_volta'] = (isset($this->nm_new_label['tra_dt_chegada_volta'])) ? $this->nm_new_label['tra_dt_chegada_volta'] : 'Data Chegada:'; 
          $SC_Label_atu['tra_hr_chegada_volta'] = (isset($this->nm_new_label['tra_hr_chegada_volta'])) ? $this->nm_new_label['tra_hr_chegada_volta'] : 'Hora Chegada:'; 
          $SC_Label_atu['tra_localizador_volta'] = (isset($this->nm_new_label['tra_localizador_volta'])) ? $this->nm_new_label['tra_localizador_volta'] : 'Localizador:'; 
          $SC_Label_atu['tra_eticket_volta'] = (isset($this->nm_new_label['tra_eticket_volta'])) ? $this->nm_new_label['tra_eticket_volta'] : 'E-Ticket:'; 
          $SC_Label_atu['tra_intervalo'] = (isset($this->nm_new_label['tra_intervalo'])) ? $this->nm_new_label['tra_intervalo'] : 'Intervalo Tr. Out:'; 
          $SC_Label_atu['tra_hrtransout'] = (isset($this->nm_new_label['tra_hrtransout'])) ? $this->nm_new_label['tra_hrtransout'] : 'Hr. Transfer Out:'; 
          $SC_Label_atu['tra_flag_volta'] = (isset($this->nm_new_label['tra_flag_volta'])) ? $this->nm_new_label['tra_flag_volta'] : 'VOLTA:'; 
          $SC_Label_atu['tra_dt_chegada_proprio'] = (isset($this->nm_new_label['tra_dt_chegada_proprio'])) ? $this->nm_new_label['tra_dt_chegada_proprio'] : 'Data Chegada:'; 
          $SC_Label_atu['tra_hr_chegada_proprio'] = (isset($this->nm_new_label['tra_hr_chegada_proprio'])) ? $this->nm_new_label['tra_hr_chegada_proprio'] : 'Hora Chegada:'; 
          $SC_Label_atu['tra_flag_proprio'] = (isset($this->nm_new_label['tra_flag_proprio'])) ? $this->nm_new_label['tra_flag_proprio'] : 'Próprio'; 
          $SC_Label_atu['tra_dt_ida_local'] = (isset($this->nm_new_label['tra_dt_ida_local'])) ? $this->nm_new_label['tra_dt_ida_local'] : 'Data Ida:'; 
          $SC_Label_atu['tra_hr_ida_local'] = (isset($this->nm_new_label['tra_hr_ida_local'])) ? $this->nm_new_label['tra_hr_ida_local'] : 'Hora Ida:'; 
          $SC_Label_atu['tra_origem_ida_local'] = (isset($this->nm_new_label['tra_origem_ida_local'])) ? $this->nm_new_label['tra_origem_ida_local'] : 'Origem Ida: '; 
          $SC_Label_atu['tra_destino_ida_local'] = (isset($this->nm_new_label['tra_destino_ida_local'])) ? $this->nm_new_label['tra_destino_ida_local'] : 'Destino Ida:'; 
          $SC_Label_atu['tra_flag_ida_local'] = (isset($this->nm_new_label['tra_flag_ida_local'])) ? $this->nm_new_label['tra_flag_ida_local'] : 'IDA:'; 
          $SC_Label_atu['tra_dt_volta_local'] = (isset($this->nm_new_label['tra_dt_volta_local'])) ? $this->nm_new_label['tra_dt_volta_local'] : 'Data Volta:'; 
          $SC_Label_atu['tra_hr_volta_local'] = (isset($this->nm_new_label['tra_hr_volta_local'])) ? $this->nm_new_label['tra_hr_volta_local'] : 'Hora Volta:'; 
          $SC_Label_atu['tra_origem_volta_local'] = (isset($this->nm_new_label['tra_origem_volta_local'])) ? $this->nm_new_label['tra_origem_volta_local'] : 'Origem Volta:'; 
          $SC_Label_atu['tra_destino_volta_local'] = (isset($this->nm_new_label['tra_destino_volta_local'])) ? $this->nm_new_label['tra_destino_volta_local'] : 'Destino Volta: '; 
          $SC_Label_atu['tra_flag_volta_local'] = (isset($this->nm_new_label['tra_flag_volta_local'])) ? $this->nm_new_label['tra_flag_volta_local'] : 'VOLTA:'; 
          $SC_Label_atu['tra_observacao'] = (isset($this->nm_new_label['tra_observacao'])) ? $this->nm_new_label['tra_observacao'] : 'Observações:'; 
          $SC_Label_atu['tra_ativo'] = (isset($this->nm_new_label['tra_ativo'])) ? $this->nm_new_label['tra_ativo'] : 'Registro Ativo:'; 
          $SC_Label_atu['tra_dt_alteracao'] = (isset($this->nm_new_label['tra_dt_alteracao'])) ? $this->nm_new_label['tra_dt_alteracao'] : 'Alterado em:'; 
          $SC_Label_atu['titulo_api'] = (isset($this->nm_new_label['titulo_api'])) ? $this->nm_new_label['titulo_api'] : 'Título API:'; 
          $SC_Label_atu['descricao_api'] = (isset($this->nm_new_label['descricao_api'])) ? $this->nm_new_label['descricao_api'] : 'Descrição API:'; 
          $SC_Label_atu['codigo_api'] = (isset($this->nm_new_label['codigo_api'])) ? $this->nm_new_label['codigo_api'] : 'Código API:'; 
          $SC_Label_atu['tipo_api'] = (isset($this->nm_new_label['tipo_api'])) ? $this->nm_new_label['tipo_api'] : 'Tipo API:'; 
          $SC_Label_atu['status_api'] = (isset($this->nm_new_label['status_api'])) ? $this->nm_new_label['status_api'] : 'Status API:'; 
          $SC_Label_atu['valido_de_api'] = (isset($this->nm_new_label['valido_de_api'])) ? $this->nm_new_label['valido_de_api'] : 'Válido de API:'; 
          $SC_Label_atu['valido_ate_api'] = (isset($this->nm_new_label['valido_ate_api'])) ? $this->nm_new_label['valido_ate_api'] : 'Válido até API:'; 
          $SC_Label_atu['local_de_origem_api'] = (isset($this->nm_new_label['local_de_origem_api'])) ? $this->nm_new_label['local_de_origem_api'] : 'Local De Origem API:'; 
          $SC_Label_atu['latitude_origem_api'] = (isset($this->nm_new_label['latitude_origem_api'])) ? $this->nm_new_label['latitude_origem_api'] : 'Latitude Origem API:'; 
          $SC_Label_atu['longitude_origem_api'] = (isset($this->nm_new_label['longitude_origem_api'])) ? $this->nm_new_label['longitude_origem_api'] : 'Longitude Origem API:'; 
          $SC_Label_atu['hr_saida_origem_api'] = (isset($this->nm_new_label['hr_saida_origem_api'])) ? $this->nm_new_label['hr_saida_origem_api'] : 'Hr. Saída Origem API:'; 
          $SC_Label_atu['local_destino_api'] = (isset($this->nm_new_label['local_destino_api'])) ? $this->nm_new_label['local_destino_api'] : 'Local Destino API:'; 
          $SC_Label_atu['latitude_destino_api'] = (isset($this->nm_new_label['latitude_destino_api'])) ? $this->nm_new_label['latitude_destino_api'] : 'Latitude Destino API:'; 
          $SC_Label_atu['longitude_destino_api'] = (isset($this->nm_new_label['longitude_destino_api'])) ? $this->nm_new_label['longitude_destino_api'] : 'Longitude Destino API:'; 
          $SC_Label_atu['veiculo_api'] = (isset($this->nm_new_label['veiculo_api'])) ? $this->nm_new_label['veiculo_api'] : 'Veículo API:'; 
          $SC_Label_atu['companhia_api'] = (isset($this->nm_new_label['companhia_api'])) ? $this->nm_new_label['companhia_api'] : 'Companhia API:'; 
          $SC_Label_atu['nome_motorista_api'] = (isset($this->nm_new_label['nome_motorista_api'])) ? $this->nm_new_label['nome_motorista_api'] : 'Nome Motorista API:'; 
          $SC_Label_atu['contato_motorista_api'] = (isset($this->nm_new_label['contato_motorista_api'])) ? $this->nm_new_label['contato_motorista_api'] : 'Contato Motorista APP:'; 
          $SC_Label_atu['matricula_api'] = (isset($this->nm_new_label['matricula_api'])) ? $this->nm_new_label['matricula_api'] : 'Matrícula API:'; 
          $SC_Label_atu['duracao_percurso_api'] = (isset($this->nm_new_label['duracao_percurso_api'])) ? $this->nm_new_label['duracao_percurso_api'] : 'Duração do Percurso API:'; 
          $SC_Label_atu['comodidades_api'] = (isset($this->nm_new_label['comodidades_api'])) ? $this->nm_new_label['comodidades_api'] : 'Comodidades API:'; 
          $SC_Label_atu['observacao_api'] = (isset($this->nm_new_label['observacao_api'])) ? $this->nm_new_label['observacao_api'] : 'Observação API:'; 
          $SC_Label_atu['placa_veiculo_api'] = (isset($this->nm_new_label['placa_veiculo_api'])) ? $this->nm_new_label['placa_veiculo_api'] : 'Placa Veículo API:'; 
          $SC_Label_atu['id_evento_app'] = (isset($this->nm_new_label['id_evento_app'])) ? $this->nm_new_label['id_evento_app'] : 'Id Evento App:'; 
          $SC_Label_atu['id_participante_app'] = (isset($this->nm_new_label['id_participante_app'])) ? $this->nm_new_label['id_participante_app'] : 'Id Participante App:'; 
          $SC_Label_atu['id_voucher_app'] = (isset($this->nm_new_label['id_voucher_app'])) ? $this->nm_new_label['id_voucher_app'] : 'Id Voucher App:'; 
          $SC_Label_atu['titulo_api_out'] = (isset($this->nm_new_label['titulo_api_out'])) ? $this->nm_new_label['titulo_api_out'] : 'Título API OUT:'; 
          $SC_Label_atu['descricao_api_out'] = (isset($this->nm_new_label['descricao_api_out'])) ? $this->nm_new_label['descricao_api_out'] : 'Descrição API OUT:'; 
          $SC_Label_atu['codigo_api_out'] = (isset($this->nm_new_label['codigo_api_out'])) ? $this->nm_new_label['codigo_api_out'] : 'Código API OUT:'; 
          $SC_Label_atu['tipo_api_out'] = (isset($this->nm_new_label['tipo_api_out'])) ? $this->nm_new_label['tipo_api_out'] : 'Tipo API OUT:'; 
          $SC_Label_atu['status_api_out'] = (isset($this->nm_new_label['status_api_out'])) ? $this->nm_new_label['status_api_out'] : 'Status API OUT:'; 
          $SC_Label_atu['valido_de_api_out'] = (isset($this->nm_new_label['valido_de_api_out'])) ? $this->nm_new_label['valido_de_api_out'] : 'Válido de API OUT:'; 
          $SC_Label_atu['valido_ate_api_out'] = (isset($this->nm_new_label['valido_ate_api_out'])) ? $this->nm_new_label['valido_ate_api_out'] : 'Válido Até API OUT:'; 
          $SC_Label_atu['local_de_origem_api_out'] = (isset($this->nm_new_label['local_de_origem_api_out'])) ? $this->nm_new_label['local_de_origem_api_out'] : 'Local De Origem API OUT:'; 
          $SC_Label_atu['latitude_origem_api_out'] = (isset($this->nm_new_label['latitude_origem_api_out'])) ? $this->nm_new_label['latitude_origem_api_out'] : 'Latitude Origem API OUT:'; 
          $SC_Label_atu['longitude_origem_api_out'] = (isset($this->nm_new_label['longitude_origem_api_out'])) ? $this->nm_new_label['longitude_origem_api_out'] : 'Longitude Origem API OUT:'; 
          $SC_Label_atu['hr_saida_origem_api_out'] = (isset($this->nm_new_label['hr_saida_origem_api_out'])) ? $this->nm_new_label['hr_saida_origem_api_out'] : 'Hr Saída Origem API OUT:'; 
          $SC_Label_atu['local_de_destino_api_out'] = (isset($this->nm_new_label['local_de_destino_api_out'])) ? $this->nm_new_label['local_de_destino_api_out'] : 'Local Destino API OUT:'; 
          $SC_Label_atu['latitude_destino_api_out'] = (isset($this->nm_new_label['latitude_destino_api_out'])) ? $this->nm_new_label['latitude_destino_api_out'] : 'Latitude Destino API OUT:'; 
          $SC_Label_atu['longitude_destino_api_out'] = (isset($this->nm_new_label['longitude_destino_api_out'])) ? $this->nm_new_label['longitude_destino_api_out'] : 'Longitude Destino API OUT:'; 
          $SC_Label_atu['veiculo_api_out'] = (isset($this->nm_new_label['veiculo_api_out'])) ? $this->nm_new_label['veiculo_api_out'] : 'Veículo API OUT:'; 
          $SC_Label_atu['companhia_api_out'] = (isset($this->nm_new_label['companhia_api_out'])) ? $this->nm_new_label['companhia_api_out'] : 'Companhia API OUT:'; 
          $SC_Label_atu['nome_motorista_api_out'] = (isset($this->nm_new_label['nome_motorista_api_out'])) ? $this->nm_new_label['nome_motorista_api_out'] : 'Nome Motorista API OUT:'; 
          $SC_Label_atu['contato_motorista_api_out'] = (isset($this->nm_new_label['contato_motorista_api_out'])) ? $this->nm_new_label['contato_motorista_api_out'] : 'Contato Motorista API OUT:'; 
          $SC_Label_atu['matricula_api_out'] = (isset($this->nm_new_label['matricula_api_out'])) ? $this->nm_new_label['matricula_api_out'] : 'Matricula API OUT:'; 
          $SC_Label_atu['duracao_percurso_api_out'] = (isset($this->nm_new_label['duracao_percurso_api_out'])) ? $this->nm_new_label['duracao_percurso_api_out'] : 'Duração Percurso API OUT:'; 
          $SC_Label_atu['comodidades_api_out'] = (isset($this->nm_new_label['comodidades_api_out'])) ? $this->nm_new_label['comodidades_api_out'] : 'Comodidades API OUT:'; 
          $SC_Label_atu['observacao_api_out'] = (isset($this->nm_new_label['observacao_api_out'])) ? $this->nm_new_label['observacao_api_out'] : 'Observação API OUT:'; 
          $SC_Label_atu['placa_veiculo_api_out'] = (isset($this->nm_new_label['placa_veiculo_api_out'])) ? $this->nm_new_label['placa_veiculo_api_out'] : 'Placa Veículo API OUT:'; 
          $SC_Label_atu['id_evento_app_out'] = (isset($this->nm_new_label['id_evento_app_out'])) ? $this->nm_new_label['id_evento_app_out'] : 'Id Evento App Out:'; 
          $SC_Label_atu['id_participante_app_out'] = (isset($this->nm_new_label['id_participante_app_out'])) ? $this->nm_new_label['id_participante_app_out'] : 'Id Participante App Out:'; 
          $SC_Label_atu['id_voucher_app_out'] = (isset($this->nm_new_label['id_voucher_app_out'])) ? $this->nm_new_label['id_voucher_app_out'] : 'Id Voucher App Out:'; 
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
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-15';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['sc_btn_0'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['sc_btn_0']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['sc_btn_0']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['sc_btn_0']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['sc_btn_0']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['sc_btn_0'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "sc_btn_0", "scBtnFn_sc_btn_0()", "scBtnFn_sc_btn_0()", "sc_sc_btn_0_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (F1)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-20';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-21';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-22';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-23';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-24';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "__NM_HINT__ (Alt + Q)", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
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
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock" style="background-color: #CCCC99">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Tipo / Status</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_id_evento']))
    {
        $this->nm_new_label['tra_id_evento'] = "Cód. Evento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_id_evento = $this->tra_id_evento;
   $sStyleHidden_tra_id_evento = '';
   if (isset($this->nmgp_cmp_hidden['tra_id_evento']) && $this->nmgp_cmp_hidden['tra_id_evento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_id_evento']);
       $sStyleHidden_tra_id_evento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_id_evento = 'display: none;';
   $sStyleReadInp_tra_id_evento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_id_evento']) && $this->nmgp_cmp_readonly['tra_id_evento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_id_evento']);
       $sStyleReadLab_tra_id_evento = '';
       $sStyleReadInp_tra_id_evento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_id_evento']) && $this->nmgp_cmp_hidden['tra_id_evento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_id_evento" value="<?php echo $this->form_encode_input($tra_id_evento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_id_evento" style="<?php echo $sStyleHidden_tra_id_evento; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_id_evento_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_id_evento_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_id_evento"><?php echo $this->nm_new_label['tra_id_evento']; ?></span></td></tr><tr><td class="css_tra_id_evento_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_id_evento" value="<?php echo $this->form_encode_input($tra_id_evento); ?>"><span id="id_ajax_label_tra_id_evento"><?php echo nl2br($tra_id_evento); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_id_evento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_id_evento_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['evento_dsc']))
    {
        $this->nm_new_label['evento_dsc'] = "Evento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $evento_dsc = $this->evento_dsc;
   $sStyleHidden_evento_dsc = '';
   if (isset($this->nmgp_cmp_hidden['evento_dsc']) && $this->nmgp_cmp_hidden['evento_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['evento_dsc']);
       $sStyleHidden_evento_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_evento_dsc = 'display: none;';
   $sStyleReadInp_evento_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['evento_dsc']) && $this->nmgp_cmp_readonly['evento_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['evento_dsc']);
       $sStyleReadLab_evento_dsc = '';
       $sStyleReadInp_evento_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['evento_dsc']) && $this->nmgp_cmp_hidden['evento_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="evento_dsc" value="<?php echo $this->form_encode_input($evento_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_evento_dsc" style="<?php echo $sStyleHidden_evento_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_evento_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_evento_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_evento_dsc"><?php echo $this->nm_new_label['evento_dsc']; ?></span></td></tr><tr><td class="css_evento_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="evento_dsc" value="<?php echo $this->form_encode_input($evento_dsc); ?>"><span id="id_ajax_label_evento_dsc"><?php echo nl2br($evento_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_evento_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_evento_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_cpf_particip']))
    {
        $this->nm_new_label['tra_cpf_particip'] = "ID Participante:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_cpf_particip = $this->tra_cpf_particip;
   $sStyleHidden_tra_cpf_particip = '';
   if (isset($this->nmgp_cmp_hidden['tra_cpf_particip']) && $this->nmgp_cmp_hidden['tra_cpf_particip'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_cpf_particip']);
       $sStyleHidden_tra_cpf_particip = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_cpf_particip = 'display: none;';
   $sStyleReadInp_tra_cpf_particip = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_cpf_particip']) && $this->nmgp_cmp_readonly['tra_cpf_particip'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_cpf_particip']);
       $sStyleReadLab_tra_cpf_particip = '';
       $sStyleReadInp_tra_cpf_particip = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_cpf_particip']) && $this->nmgp_cmp_hidden['tra_cpf_particip'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_cpf_particip" value="<?php echo $this->form_encode_input($tra_cpf_particip) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_cpf_particip" style="<?php echo $sStyleHidden_tra_cpf_particip; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_cpf_particip_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_cpf_particip_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_cpf_particip"><?php echo $this->nm_new_label['tra_cpf_particip']; ?></span></td></tr><tr><td class="css_tra_cpf_particip_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_cpf_particip" value="<?php echo $this->form_encode_input($tra_cpf_particip); ?>"><span id="id_ajax_label_tra_cpf_particip"><?php echo nl2br($tra_cpf_particip); ?></span>
 <SPAN id="id_lookup_tra_cpf_particip" style="color: #33CCCC"><?php echo $look_rpc_tra_cpf_particip; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_cpf_particip_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_cpf_particip_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tipo_dsc']))
    {
        $this->nm_new_label['tipo_dsc'] = "Tipo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tipo_dsc = $this->tipo_dsc;
   $sStyleHidden_tipo_dsc = '';
   if (isset($this->nmgp_cmp_hidden['tipo_dsc']) && $this->nmgp_cmp_hidden['tipo_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tipo_dsc']);
       $sStyleHidden_tipo_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tipo_dsc = 'display: none;';
   $sStyleReadInp_tipo_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tipo_dsc']) && $this->nmgp_cmp_readonly['tipo_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tipo_dsc']);
       $sStyleReadLab_tipo_dsc = '';
       $sStyleReadInp_tipo_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tipo_dsc']) && $this->nmgp_cmp_hidden['tipo_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tipo_dsc" value="<?php echo $this->form_encode_input($tipo_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tipo_dsc" style="<?php echo $sStyleHidden_tipo_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tipo_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tipo_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_tipo_dsc"><?php echo $this->nm_new_label['tipo_dsc']; ?></span></td></tr><tr><td class="css_tipo_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tipo_dsc" value="<?php echo $this->form_encode_input($tipo_dsc); ?>"><span id="id_ajax_label_tipo_dsc"><?php echo nl2br($tipo_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_id_usuario']))
    {
        $this->nm_new_label['tra_id_usuario'] = "Cód. Atendente:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_id_usuario = $this->tra_id_usuario;
   $sStyleHidden_tra_id_usuario = '';
   if (isset($this->nmgp_cmp_hidden['tra_id_usuario']) && $this->nmgp_cmp_hidden['tra_id_usuario'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_id_usuario']);
       $sStyleHidden_tra_id_usuario = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_id_usuario = 'display: none;';
   $sStyleReadInp_tra_id_usuario = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_id_usuario']) && $this->nmgp_cmp_readonly['tra_id_usuario'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_id_usuario']);
       $sStyleReadLab_tra_id_usuario = '';
       $sStyleReadInp_tra_id_usuario = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_id_usuario']) && $this->nmgp_cmp_hidden['tra_id_usuario'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_id_usuario" value="<?php echo $this->form_encode_input($tra_id_usuario) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_id_usuario" style="<?php echo $sStyleHidden_tra_id_usuario; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_id_usuario_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_id_usuario_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_id_usuario"><?php echo $this->nm_new_label['tra_id_usuario']; ?></span></td></tr><tr><td class="css_tra_id_usuario_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_id_usuario" value="<?php echo $this->form_encode_input($tra_id_usuario); ?>"><span id="id_ajax_label_tra_id_usuario"><?php echo nl2br($tra_id_usuario); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_id_usuario_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_id_usuario_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['atendente_dsc']))
    {
        $this->nm_new_label['atendente_dsc'] = "Atendente:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $atendente_dsc = $this->atendente_dsc;
   $sStyleHidden_atendente_dsc = '';
   if (isset($this->nmgp_cmp_hidden['atendente_dsc']) && $this->nmgp_cmp_hidden['atendente_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['atendente_dsc']);
       $sStyleHidden_atendente_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_atendente_dsc = 'display: none;';
   $sStyleReadInp_atendente_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['atendente_dsc']) && $this->nmgp_cmp_readonly['atendente_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['atendente_dsc']);
       $sStyleReadLab_atendente_dsc = '';
       $sStyleReadInp_atendente_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['atendente_dsc']) && $this->nmgp_cmp_hidden['atendente_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="atendente_dsc" value="<?php echo $this->form_encode_input($atendente_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_atendente_dsc" style="<?php echo $sStyleHidden_atendente_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_atendente_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_atendente_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_atendente_dsc"><?php echo $this->nm_new_label['atendente_dsc']; ?></span></td></tr><tr><td class="css_atendente_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="atendente_dsc" value="<?php echo $this->form_encode_input($atendente_dsc); ?>"><span id="id_ajax_label_atendente_dsc"><?php echo nl2br($atendente_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_atendente_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_atendente_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_tipo']))
   {
       $this->nm_new_label['tra_tipo'] = "Tipo Transfer:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_tipo = $this->tra_tipo;
   $sStyleHidden_tra_tipo = '';
   if (isset($this->nmgp_cmp_hidden['tra_tipo']) && $this->nmgp_cmp_hidden['tra_tipo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_tipo']);
       $sStyleHidden_tra_tipo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_tipo = 'display: none;';
   $sStyleReadInp_tra_tipo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_tipo']) && $this->nmgp_cmp_readonly['tra_tipo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_tipo']);
       $sStyleReadLab_tra_tipo = '';
       $sStyleReadInp_tra_tipo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_tipo']) && $this->nmgp_cmp_hidden['tra_tipo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_tipo" value="<?php echo $this->form_encode_input($this->tra_tipo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_tipo" style="<?php echo $sStyleHidden_tra_tipo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_tipo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_tipo_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_tipo"><?php echo $this->nm_new_label['tra_tipo']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['php_cmp_required']['tra_tipo']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['php_cmp_required']['tra_tipo'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_tra_tipo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_tipo"]) &&  $this->nmgp_cmp_readonly["tra_tipo"] == "on") { 

$tra_tipo_look = "";
 if ($this->tra_tipo == "A") { $tra_tipo_look .= "Aéreo" ;} 
 if ($this->tra_tipo == "L") { $tra_tipo_look .= "Local" ;} 
 if ($this->tra_tipo == "P") { $tra_tipo_look .= "Próprio" ;} 
 if ($this->tra_tipo == "AM") { $tra_tipo_look .= "Aéreo Manual" ;} 
 if (empty($tra_tipo_look)) { $tra_tipo_look = $this->tra_tipo; }
?>
<input type="hidden" name="tra_tipo" value="<?php echo $this->form_encode_input($tra_tipo) . "\">" . $tra_tipo_look . ""; ?>
<?php } else { ?>
<?php

$tra_tipo_look = "";
 if ($this->tra_tipo == "A") { $tra_tipo_look .= "Aéreo" ;} 
 if ($this->tra_tipo == "L") { $tra_tipo_look .= "Local" ;} 
 if ($this->tra_tipo == "P") { $tra_tipo_look .= "Próprio" ;} 
 if ($this->tra_tipo == "AM") { $tra_tipo_look .= "Aéreo Manual" ;} 
 if (empty($tra_tipo_look)) { $tra_tipo_look = $this->tra_tipo; }
?>
<span id="id_read_on_tra_tipo" class="css_tra_tipo_line"  style="<?php echo $sStyleReadLab_tra_tipo; ?>"><?php echo $this->form_format_readonly("tra_tipo", $this->form_encode_input($tra_tipo_look)); ?></span><span id="id_read_off_tra_tipo" class="css_read_off_tra_tipo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tra_tipo; ?>">
 <span id="idAjaxSelect_tra_tipo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tra_tipo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_tipo" name="tra_tipo" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_tipo'][] = ''; ?>
 <option value="">.:selecione.:.</option>
 <option  value="A" <?php  if ($this->tra_tipo == "A") { echo " selected" ;} ?>>Aéreo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_tipo'][] = 'A'; ?>
 <option  value="L" <?php  if ($this->tra_tipo == "L") { echo " selected" ;} ?>>Local</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_tipo'][] = 'L'; ?>
 <option  value="P" <?php  if ($this->tra_tipo == "P") { echo " selected" ;} ?>>Próprio</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_tipo'][] = 'P'; ?>
 <option  value="AM" <?php  if ($this->tra_tipo == "AM") { echo " selected" ;} ?>>Aéreo Manual</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_tipo'][] = 'AM'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_tipo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_tipo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_id_hotel']))
   {
       $this->nm_new_label['tra_id_hotel'] = "Cód. Hotel In:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_id_hotel = $this->tra_id_hotel;
   $sStyleHidden_tra_id_hotel = '';
   if (isset($this->nmgp_cmp_hidden['tra_id_hotel']) && $this->nmgp_cmp_hidden['tra_id_hotel'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_id_hotel']);
       $sStyleHidden_tra_id_hotel = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_id_hotel = 'display: none;';
   $sStyleReadInp_tra_id_hotel = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_id_hotel']) && $this->nmgp_cmp_readonly['tra_id_hotel'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_id_hotel']);
       $sStyleReadLab_tra_id_hotel = '';
       $sStyleReadInp_tra_id_hotel = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_id_hotel']) && $this->nmgp_cmp_hidden['tra_id_hotel'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_id_hotel" value="<?php echo $this->form_encode_input($this->tra_id_hotel) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_id_hotel" style="<?php echo $sStyleHidden_tra_id_hotel; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_id_hotel_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_id_hotel_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_id_hotel"><?php echo $this->nm_new_label['tra_id_hotel']; ?></span></td></tr><tr><td class="css_tra_id_hotel_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_id_hotel"]) &&  $this->nmgp_cmp_readonly["tra_id_hotel"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel'] = array(); 
    }

   $old_value_tra_cia_ida = $this->tra_cia_ida;
   $old_value_tra_dt_saida_ida = $this->tra_dt_saida_ida;
   $old_value_tra_hr_saida_ida = $this->tra_hr_saida_ida;
   $old_value_tra_dt_chegada_ida = $this->tra_dt_chegada_ida;
   $old_value_tra_hr_chegada_ida = $this->tra_hr_chegada_ida;
   $old_value_tra_cia_volta = $this->tra_cia_volta;
   $old_value_tra_dt_saida_volta = $this->tra_dt_saida_volta;
   $old_value_tra_hr_saida_volta = $this->tra_hr_saida_volta;
   $old_value_tra_dt_chegada_volta = $this->tra_dt_chegada_volta;
   $old_value_tra_hr_chegada_volta = $this->tra_hr_chegada_volta;
   $old_value_tra_hrtransout = $this->tra_hrtransout;
   $old_value_tra_dt_chegada_proprio = $this->tra_dt_chegada_proprio;
   $old_value_tra_hr_chegada_proprio = $this->tra_hr_chegada_proprio;
   $old_value_tra_dt_ida_local = $this->tra_dt_ida_local;
   $old_value_tra_hr_ida_local = $this->tra_hr_ida_local;
   $old_value_tra_dt_volta_local = $this->tra_dt_volta_local;
   $old_value_tra_hr_volta_local = $this->tra_hr_volta_local;
   $old_value_tra_dt_alteracao = $this->tra_dt_alteracao;
   $old_value_tra_dt_alteracao_hora = $this->tra_dt_alteracao_hora;
   $old_value_contato_motorista_api = $this->contato_motorista_api;
   $old_value_contato_motorista_api_out = $this->contato_motorista_api_out;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_tra_cia_ida = $this->tra_cia_ida;
   $unformatted_value_tra_dt_saida_ida = $this->tra_dt_saida_ida;
   $unformatted_value_tra_hr_saida_ida = $this->tra_hr_saida_ida;
   $unformatted_value_tra_dt_chegada_ida = $this->tra_dt_chegada_ida;
   $unformatted_value_tra_hr_chegada_ida = $this->tra_hr_chegada_ida;
   $unformatted_value_tra_cia_volta = $this->tra_cia_volta;
   $unformatted_value_tra_dt_saida_volta = $this->tra_dt_saida_volta;
   $unformatted_value_tra_hr_saida_volta = $this->tra_hr_saida_volta;
   $unformatted_value_tra_dt_chegada_volta = $this->tra_dt_chegada_volta;
   $unformatted_value_tra_hr_chegada_volta = $this->tra_hr_chegada_volta;
   $unformatted_value_tra_hrtransout = $this->tra_hrtransout;
   $unformatted_value_tra_dt_chegada_proprio = $this->tra_dt_chegada_proprio;
   $unformatted_value_tra_hr_chegada_proprio = $this->tra_hr_chegada_proprio;
   $unformatted_value_tra_dt_ida_local = $this->tra_dt_ida_local;
   $unformatted_value_tra_hr_ida_local = $this->tra_hr_ida_local;
   $unformatted_value_tra_dt_volta_local = $this->tra_dt_volta_local;
   $unformatted_value_tra_hr_volta_local = $this->tra_hr_volta_local;
   $unformatted_value_tra_dt_alteracao = $this->tra_dt_alteracao;
   $unformatted_value_tra_dt_alteracao_hora = $this->tra_dt_alteracao_hora;
   $unformatted_value_contato_motorista_api = $this->contato_motorista_api;
   $unformatted_value_contato_motorista_api_out = $this->contato_motorista_api_out;

   $nm_comando = "SELECT hospedagem_rsvp.hosp_id_hotel, 	tbl_hoteis.hotel_fantasia, 	hospedagem_rsvp.hosp_id_evento, 	hospedagem_rsvp.hosp_cpf_participante FROM  	hospedagem_rsvp  INNER JOIN 	tbl_hoteis ON 	tbl_hoteis.hotel_id = hospedagem_rsvp.hosp_id_hotel WHERE  	hospedagem_rsvp.hosp_cpf_participante = '" . $_SESSION['vg_cpf'] . "' AND  	hospedagem_rsvp.hosp_id_evento = '" . $_SESSION['vg_evento_id'] . "' ORDER BY  	hospedagem_rsvp.hosp_id_hotel, hospedagem_rsvp.hosp_id_evento, hospedagem_rsvp.hosp_cpf_participante";

   $this->tra_cia_ida = $old_value_tra_cia_ida;
   $this->tra_dt_saida_ida = $old_value_tra_dt_saida_ida;
   $this->tra_hr_saida_ida = $old_value_tra_hr_saida_ida;
   $this->tra_dt_chegada_ida = $old_value_tra_dt_chegada_ida;
   $this->tra_hr_chegada_ida = $old_value_tra_hr_chegada_ida;
   $this->tra_cia_volta = $old_value_tra_cia_volta;
   $this->tra_dt_saida_volta = $old_value_tra_dt_saida_volta;
   $this->tra_hr_saida_volta = $old_value_tra_hr_saida_volta;
   $this->tra_dt_chegada_volta = $old_value_tra_dt_chegada_volta;
   $this->tra_hr_chegada_volta = $old_value_tra_hr_chegada_volta;
   $this->tra_hrtransout = $old_value_tra_hrtransout;
   $this->tra_dt_chegada_proprio = $old_value_tra_dt_chegada_proprio;
   $this->tra_hr_chegada_proprio = $old_value_tra_hr_chegada_proprio;
   $this->tra_dt_ida_local = $old_value_tra_dt_ida_local;
   $this->tra_hr_ida_local = $old_value_tra_hr_ida_local;
   $this->tra_dt_volta_local = $old_value_tra_dt_volta_local;
   $this->tra_hr_volta_local = $old_value_tra_hr_volta_local;
   $this->tra_dt_alteracao = $old_value_tra_dt_alteracao;
   $this->tra_dt_alteracao_hora = $old_value_tra_dt_alteracao_hora;
   $this->contato_motorista_api = $old_value_contato_motorista_api;
   $this->contato_motorista_api_out = $old_value_contato_motorista_api_out;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[2] = str_replace(',', '.', $rs->fields[2]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $rs->fields[2] = (strpos(strtolower($rs->fields[2]), "e")) ? (float)$rs->fields[2] : $rs->fields[2];
              $rs->fields[2] = (string)$rs->fields[2];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel'][] = $rs->fields[0];
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
   $tra_id_hotel_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tra_id_hotel_1))
          {
              foreach ($this->tra_id_hotel_1 as $tmp_tra_id_hotel)
              {
                  if (trim($tmp_tra_id_hotel) === trim($cadaselect[1])) {$tra_id_hotel_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->tra_id_hotel) && trim($this->tra_id_hotel) === trim($cadaselect[1])) {$tra_id_hotel_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="tra_id_hotel" value="<?php echo $this->form_encode_input($tra_id_hotel) . "\">" . $tra_id_hotel_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tra_id_hotel();
   $x = 0 ; 
   $tra_id_hotel_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tra_id_hotel_1))
          {
              foreach ($this->tra_id_hotel_1 as $tmp_tra_id_hotel)
              {
                  if (trim($tmp_tra_id_hotel) === trim($cadaselect[1])) {$tra_id_hotel_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->tra_id_hotel)) {
                 if (trim($this->tra_id_hotel) == trim($cadaselect[1])) { $tra_id_hotel_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->tra_id_hotel == $cadaselect[1]) { $tra_id_hotel_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($tra_id_hotel_look))
          {
              $tra_id_hotel_look = $this->tra_id_hotel;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tra_id_hotel\" class=\"css_tra_id_hotel_line\" style=\"" .  $sStyleReadLab_tra_id_hotel . "\">" . $this->form_format_readonly("tra_id_hotel", $this->form_encode_input($tra_id_hotel_look)) . "</span><span id=\"id_read_off_tra_id_hotel\" class=\"css_read_off_tra_id_hotel" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_tra_id_hotel . "\">";
   echo " <span id=\"idAjaxSelect_tra_id_hotel\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_tra_id_hotel_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_tra_id_hotel\" name=\"tra_id_hotel\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tra_id_hotel) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tra_id_hotel)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_id_hotel_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_id_hotel_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_dsc']))
    {
        $this->nm_new_label['hotel_dsc'] = "Hotel In:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_dsc = $this->hotel_dsc;
   $sStyleHidden_hotel_dsc = '';
   if (isset($this->nmgp_cmp_hidden['hotel_dsc']) && $this->nmgp_cmp_hidden['hotel_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_dsc']);
       $sStyleHidden_hotel_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_dsc = 'display: none;';
   $sStyleReadInp_hotel_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_dsc']) && $this->nmgp_cmp_readonly['hotel_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_dsc']);
       $sStyleReadLab_hotel_dsc = '';
       $sStyleReadInp_hotel_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_dsc']) && $this->nmgp_cmp_hidden['hotel_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_dsc" value="<?php echo $this->form_encode_input($hotel_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_hotel_dsc" style="<?php echo $sStyleHidden_hotel_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_hotel_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_hotel_dsc"><?php echo $this->nm_new_label['hotel_dsc']; ?></span></td></tr><tr><td class="css_hotel_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="hotel_dsc" value="<?php echo $this->form_encode_input($hotel_dsc); ?>"><span id="id_ajax_label_hotel_dsc"><?php echo nl2br($hotel_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_id_hotel_out']))
   {
       $this->nm_new_label['tra_id_hotel_out'] = "Cód. Hotel Out:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_id_hotel_out = $this->tra_id_hotel_out;
   $sStyleHidden_tra_id_hotel_out = '';
   if (isset($this->nmgp_cmp_hidden['tra_id_hotel_out']) && $this->nmgp_cmp_hidden['tra_id_hotel_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_id_hotel_out']);
       $sStyleHidden_tra_id_hotel_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_id_hotel_out = 'display: none;';
   $sStyleReadInp_tra_id_hotel_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_id_hotel_out']) && $this->nmgp_cmp_readonly['tra_id_hotel_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_id_hotel_out']);
       $sStyleReadLab_tra_id_hotel_out = '';
       $sStyleReadInp_tra_id_hotel_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_id_hotel_out']) && $this->nmgp_cmp_hidden['tra_id_hotel_out'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_id_hotel_out" value="<?php echo $this->form_encode_input($this->tra_id_hotel_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_id_hotel_out" style="<?php echo $sStyleHidden_tra_id_hotel_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_id_hotel_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_id_hotel_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_id_hotel_out"><?php echo $this->nm_new_label['tra_id_hotel_out']; ?></span></td></tr><tr><td class="css_tra_id_hotel_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_id_hotel_out"]) &&  $this->nmgp_cmp_readonly["tra_id_hotel_out"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel_out']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel_out'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel_out']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel_out'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel_out']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel_out'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel_out']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel_out'] = array(); 
    }

   $old_value_tra_cia_ida = $this->tra_cia_ida;
   $old_value_tra_dt_saida_ida = $this->tra_dt_saida_ida;
   $old_value_tra_hr_saida_ida = $this->tra_hr_saida_ida;
   $old_value_tra_dt_chegada_ida = $this->tra_dt_chegada_ida;
   $old_value_tra_hr_chegada_ida = $this->tra_hr_chegada_ida;
   $old_value_tra_cia_volta = $this->tra_cia_volta;
   $old_value_tra_dt_saida_volta = $this->tra_dt_saida_volta;
   $old_value_tra_hr_saida_volta = $this->tra_hr_saida_volta;
   $old_value_tra_dt_chegada_volta = $this->tra_dt_chegada_volta;
   $old_value_tra_hr_chegada_volta = $this->tra_hr_chegada_volta;
   $old_value_tra_hrtransout = $this->tra_hrtransout;
   $old_value_tra_dt_chegada_proprio = $this->tra_dt_chegada_proprio;
   $old_value_tra_hr_chegada_proprio = $this->tra_hr_chegada_proprio;
   $old_value_tra_dt_ida_local = $this->tra_dt_ida_local;
   $old_value_tra_hr_ida_local = $this->tra_hr_ida_local;
   $old_value_tra_dt_volta_local = $this->tra_dt_volta_local;
   $old_value_tra_hr_volta_local = $this->tra_hr_volta_local;
   $old_value_tra_dt_alteracao = $this->tra_dt_alteracao;
   $old_value_tra_dt_alteracao_hora = $this->tra_dt_alteracao_hora;
   $old_value_contato_motorista_api = $this->contato_motorista_api;
   $old_value_contato_motorista_api_out = $this->contato_motorista_api_out;
   $this->nm_tira_formatacao();
   if ($this->nmgp_opcao != "nada") {
       $this->nm_converte_datas(false);
   }


   $unformatted_value_tra_cia_ida = $this->tra_cia_ida;
   $unformatted_value_tra_dt_saida_ida = $this->tra_dt_saida_ida;
   $unformatted_value_tra_hr_saida_ida = $this->tra_hr_saida_ida;
   $unformatted_value_tra_dt_chegada_ida = $this->tra_dt_chegada_ida;
   $unformatted_value_tra_hr_chegada_ida = $this->tra_hr_chegada_ida;
   $unformatted_value_tra_cia_volta = $this->tra_cia_volta;
   $unformatted_value_tra_dt_saida_volta = $this->tra_dt_saida_volta;
   $unformatted_value_tra_hr_saida_volta = $this->tra_hr_saida_volta;
   $unformatted_value_tra_dt_chegada_volta = $this->tra_dt_chegada_volta;
   $unformatted_value_tra_hr_chegada_volta = $this->tra_hr_chegada_volta;
   $unformatted_value_tra_hrtransout = $this->tra_hrtransout;
   $unformatted_value_tra_dt_chegada_proprio = $this->tra_dt_chegada_proprio;
   $unformatted_value_tra_hr_chegada_proprio = $this->tra_hr_chegada_proprio;
   $unformatted_value_tra_dt_ida_local = $this->tra_dt_ida_local;
   $unformatted_value_tra_hr_ida_local = $this->tra_hr_ida_local;
   $unformatted_value_tra_dt_volta_local = $this->tra_dt_volta_local;
   $unformatted_value_tra_hr_volta_local = $this->tra_hr_volta_local;
   $unformatted_value_tra_dt_alteracao = $this->tra_dt_alteracao;
   $unformatted_value_tra_dt_alteracao_hora = $this->tra_dt_alteracao_hora;
   $unformatted_value_contato_motorista_api = $this->contato_motorista_api;
   $unformatted_value_contato_motorista_api_out = $this->contato_motorista_api_out;

   $nm_comando = "SELECT hospedagem_rsvp.hosp_id_hotel, 	tbl_hoteis.hotel_fantasia, 	hospedagem_rsvp.hosp_id_evento, 	hospedagem_rsvp.hosp_cpf_participante FROM  	hospedagem_rsvp  INNER JOIN 	tbl_hoteis ON 	tbl_hoteis.hotel_id = hospedagem_rsvp.hosp_id_hotel WHERE  	hospedagem_rsvp.hosp_cpf_participante = '" . $_SESSION['vg_cpf'] . "' AND  	hospedagem_rsvp.hosp_id_evento = '" . $_SESSION['vg_evento_id'] . "' ORDER BY  	hospedagem_rsvp.hosp_id_hotel, hospedagem_rsvp.hosp_id_evento, hospedagem_rsvp.hosp_cpf_participante";

   $this->tra_cia_ida = $old_value_tra_cia_ida;
   $this->tra_dt_saida_ida = $old_value_tra_dt_saida_ida;
   $this->tra_hr_saida_ida = $old_value_tra_hr_saida_ida;
   $this->tra_dt_chegada_ida = $old_value_tra_dt_chegada_ida;
   $this->tra_hr_chegada_ida = $old_value_tra_hr_chegada_ida;
   $this->tra_cia_volta = $old_value_tra_cia_volta;
   $this->tra_dt_saida_volta = $old_value_tra_dt_saida_volta;
   $this->tra_hr_saida_volta = $old_value_tra_hr_saida_volta;
   $this->tra_dt_chegada_volta = $old_value_tra_dt_chegada_volta;
   $this->tra_hr_chegada_volta = $old_value_tra_hr_chegada_volta;
   $this->tra_hrtransout = $old_value_tra_hrtransout;
   $this->tra_dt_chegada_proprio = $old_value_tra_dt_chegada_proprio;
   $this->tra_hr_chegada_proprio = $old_value_tra_hr_chegada_proprio;
   $this->tra_dt_ida_local = $old_value_tra_dt_ida_local;
   $this->tra_hr_ida_local = $old_value_tra_hr_ida_local;
   $this->tra_dt_volta_local = $old_value_tra_dt_volta_local;
   $this->tra_hr_volta_local = $old_value_tra_hr_volta_local;
   $this->tra_dt_alteracao = $old_value_tra_dt_alteracao;
   $this->tra_dt_alteracao_hora = $old_value_tra_dt_alteracao_hora;
   $this->contato_motorista_api = $old_value_contato_motorista_api;
   $this->contato_motorista_api_out = $old_value_contato_motorista_api_out;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[2] = str_replace(',', '.', $rs->fields[2]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $rs->fields[2] = (strpos(strtolower($rs->fields[2]), "e")) ? (float)$rs->fields[2] : $rs->fields[2];
              $rs->fields[2] = (string)$rs->fields[2];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_id_hotel_out'][] = $rs->fields[0];
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
   $tra_id_hotel_out_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tra_id_hotel_out_1))
          {
              foreach ($this->tra_id_hotel_out_1 as $tmp_tra_id_hotel_out)
              {
                  if (trim($tmp_tra_id_hotel_out) === trim($cadaselect[1])) {$tra_id_hotel_out_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->tra_id_hotel_out) && trim($this->tra_id_hotel_out) === trim($cadaselect[1])) {$tra_id_hotel_out_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="tra_id_hotel_out" value="<?php echo $this->form_encode_input($tra_id_hotel_out) . "\">" . $tra_id_hotel_out_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_tra_id_hotel_out();
   $x = 0 ; 
   $tra_id_hotel_out_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->tra_id_hotel_out_1))
          {
              foreach ($this->tra_id_hotel_out_1 as $tmp_tra_id_hotel_out)
              {
                  if (trim($tmp_tra_id_hotel_out) === trim($cadaselect[1])) {$tra_id_hotel_out_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->tra_id_hotel_out)) {
                 if (trim($this->tra_id_hotel_out) == trim($cadaselect[1])) { $tra_id_hotel_out_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->tra_id_hotel_out == $cadaselect[1]) { $tra_id_hotel_out_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($tra_id_hotel_out_look))
          {
              $tra_id_hotel_out_look = $this->tra_id_hotel_out;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_tra_id_hotel_out\" class=\"css_tra_id_hotel_out_line\" style=\"" .  $sStyleReadLab_tra_id_hotel_out . "\">" . $this->form_format_readonly("tra_id_hotel_out", $this->form_encode_input($tra_id_hotel_out_look)) . "</span><span id=\"id_read_off_tra_id_hotel_out\" class=\"css_read_off_tra_id_hotel_out" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_tra_id_hotel_out . "\">";
   echo " <span id=\"idAjaxSelect_tra_id_hotel_out\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_tra_id_hotel_out_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_tra_id_hotel_out\" name=\"tra_id_hotel_out\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->tra_id_hotel_out) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->tra_id_hotel_out)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_id_hotel_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_id_hotel_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_dsc_out']))
    {
        $this->nm_new_label['hotel_dsc_out'] = "Hotel Out:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_dsc_out = $this->hotel_dsc_out;
   $sStyleHidden_hotel_dsc_out = '';
   if (isset($this->nmgp_cmp_hidden['hotel_dsc_out']) && $this->nmgp_cmp_hidden['hotel_dsc_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_dsc_out']);
       $sStyleHidden_hotel_dsc_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_dsc_out = 'display: none;';
   $sStyleReadInp_hotel_dsc_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_dsc_out']) && $this->nmgp_cmp_readonly['hotel_dsc_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_dsc_out']);
       $sStyleReadLab_hotel_dsc_out = '';
       $sStyleReadInp_hotel_dsc_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_dsc_out']) && $this->nmgp_cmp_hidden['hotel_dsc_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_dsc_out" value="<?php echo $this->form_encode_input($hotel_dsc_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_hotel_dsc_out" style="<?php echo $sStyleHidden_hotel_dsc_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_dsc_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_hotel_dsc_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_hotel_dsc_out"><?php echo $this->nm_new_label['hotel_dsc_out']; ?></span></td></tr><tr><td class="css_hotel_dsc_out_line" style="padding: 0px; width: 100%;"><input type="hidden" name="hotel_dsc_out" value="<?php echo $this->form_encode_input($hotel_dsc_out); ?>"><span id="id_ajax_label_hotel_dsc_out"><?php echo nl2br($hotel_dsc_out); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_dsc_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_dsc_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
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

 if ("N" == $this->enviar_app) { $enviar_app_look = "Não";} 
 if ("Y" == $this->enviar_app) { $enviar_app_look = "Sim";} 
?>
<input type="hidden" name="enviar_app" value="<?php echo $this->form_encode_input($enviar_app) . "\">" . $enviar_app_look . ""; ?>
<?php } else { ?>

<?php

 if ("N" == $this->enviar_app) { $enviar_app_look = "Não";} 
 if ("Y" == $this->enviar_app) { $enviar_app_look = "Sim";} 
?>
<span id="id_read_on_enviar_app"  class="css_enviar_app_line" style="<?php echo $sStyleReadLab_enviar_app; ?>"><?php echo $this->form_format_readonly("enviar_app", $this->form_encode_input($enviar_app_look)); ?></span><span id="id_read_off_enviar_app" class="css_read_off_enviar_app css_enviar_app_line" style="<?php echo $sStyleReadInp_enviar_app; ?>"><div id="idAjaxRadio_enviar_app" style="display: inline-block"  class="css_enviar_app_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_enviar_app_line"><?php $tempOptionId = "id-opt-enviar_app" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enviar_app sc-ui-radio-enviar_app" type=radio name="enviar_app" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_enviar_app'][] = 'N'; ?>
<?php  if ("N" == $this->enviar_app)  { echo " checked" ;} ?><?php  if (empty($this->enviar_app)) { echo " checked" ;} ?>  onClick="do_ajax_form_transfer_rsvp_mob_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_enviar_app_line"><?php $tempOptionId = "id-opt-enviar_app" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-enviar_app sc-ui-radio-enviar_app" type=radio name="enviar_app" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_enviar_app'][] = 'Y'; ?>
<?php  if ("Y" == $this->enviar_app)  { echo " checked" ;} ?>  onClick="do_ajax_form_transfer_rsvp_mob_event_enviar_app_onclick();" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
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
   if (!isset($this->nm_new_label['tra_status']))
   {
       $this->nm_new_label['tra_status'] = "Status Transfer:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_status = $this->tra_status;
   $sStyleHidden_tra_status = '';
   if (isset($this->nmgp_cmp_hidden['tra_status']) && $this->nmgp_cmp_hidden['tra_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_status']);
       $sStyleHidden_tra_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_status = 'display: none;';
   $sStyleReadInp_tra_status = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_status']) && $this->nmgp_cmp_readonly['tra_status'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_status']);
       $sStyleReadLab_tra_status = '';
       $sStyleReadInp_tra_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_status']) && $this->nmgp_cmp_hidden['tra_status'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_status" value="<?php echo $this->form_encode_input($this->tra_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_status" style="<?php echo $sStyleHidden_tra_status; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_status_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_status_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_status"><?php echo $this->nm_new_label['tra_status']; ?></span></td></tr><tr><td class="css_tra_status_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_status"]) &&  $this->nmgp_cmp_readonly["tra_status"] == "on") { 

$tra_status_look = "";
 if ($this->tra_status == "A") { $tra_status_look .= "Aberto" ;} 
 if ($this->tra_status == "P") { $tra_status_look .= "Pendente" ;} 
 if ($this->tra_status == "N") { $tra_status_look .= "Não" ;} 
 if ($this->tra_status == "Y") { $tra_status_look .= "Sim" ;} 
 if (empty($tra_status_look)) { $tra_status_look = $this->tra_status; }
?>
<input type="hidden" name="tra_status" value="<?php echo $this->form_encode_input($tra_status) . "\">" . $tra_status_look . ""; ?>
<?php } else { ?>
<?php

$tra_status_look = "";
 if ($this->tra_status == "A") { $tra_status_look .= "Aberto" ;} 
 if ($this->tra_status == "P") { $tra_status_look .= "Pendente" ;} 
 if ($this->tra_status == "N") { $tra_status_look .= "Não" ;} 
 if ($this->tra_status == "Y") { $tra_status_look .= "Sim" ;} 
 if (empty($tra_status_look)) { $tra_status_look = $this->tra_status; }
?>
<span id="id_read_on_tra_status" class="css_tra_status_line"  style="<?php echo $sStyleReadLab_tra_status; ?>"><?php echo $this->form_format_readonly("tra_status", $this->form_encode_input($tra_status_look)); ?></span><span id="id_read_off_tra_status" class="css_read_off_tra_status<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tra_status; ?>">
 <span id="idAjaxSelect_tra_status" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tra_status_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_status" name="tra_status" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="A" <?php  if ($this->tra_status == "A") { echo " selected" ;} ?><?php  if (empty($this->tra_status)) { echo " selected" ;} ?>>Aberto</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_status'][] = 'A'; ?>
 <option  value="P" <?php  if ($this->tra_status == "P") { echo " selected" ;} ?>>Pendente</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_status'][] = 'P'; ?>
 <option  value="N" <?php  if ($this->tra_status == "N") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_status'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->tra_status == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_status'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_status_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['ult_trecho']))
    {
        $this->nm_new_label['ult_trecho'] = "Nùm. Ult. Trecho Aéreo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $ult_trecho = $this->ult_trecho;
   $sStyleHidden_ult_trecho = '';
   if (isset($this->nmgp_cmp_hidden['ult_trecho']) && $this->nmgp_cmp_hidden['ult_trecho'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['ult_trecho']);
       $sStyleHidden_ult_trecho = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_ult_trecho = 'display: none;';
   $sStyleReadInp_ult_trecho = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['ult_trecho']) && $this->nmgp_cmp_readonly['ult_trecho'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['ult_trecho']);
       $sStyleReadLab_ult_trecho = '';
       $sStyleReadInp_ult_trecho = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['ult_trecho']) && $this->nmgp_cmp_hidden['ult_trecho'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ult_trecho" value="<?php echo $this->form_encode_input($ult_trecho) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_ult_trecho" style="<?php echo $sStyleHidden_ult_trecho; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_ult_trecho_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_ult_trecho_label" style=" padding: 0px; width: 100%;"><span id="id_label_ult_trecho"><?php echo $this->nm_new_label['ult_trecho']; ?></span></td></tr><tr><td class="css_ult_trecho_line" style="padding: 0px; width: 100%;"><input type="hidden" name="ult_trecho" value="<?php echo $this->form_encode_input($ult_trecho); ?>"><span id="id_ajax_label_ult_trecho"><?php echo nl2br($ult_trecho); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ult_trecho_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ult_trecho_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_ult_trecho_dumb = ('' == $sStyleHidden_ult_trecho) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_ult_trecho_dumb" style="<?php echo $sStyleHidden_ult_trecho_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock" style="background-color: #CCCC99">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Aéreo Ida</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_cia_ida']))
    {
        $this->nm_new_label['tra_cia_ida'] = "Cód. Cia Aérea:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_cia_ida = $this->tra_cia_ida;
   $sStyleHidden_tra_cia_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_cia_ida']) && $this->nmgp_cmp_hidden['tra_cia_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_cia_ida']);
       $sStyleHidden_tra_cia_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_cia_ida = 'display: none;';
   $sStyleReadInp_tra_cia_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_cia_ida']) && $this->nmgp_cmp_readonly['tra_cia_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_cia_ida']);
       $sStyleReadLab_tra_cia_ida = '';
       $sStyleReadInp_tra_cia_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_cia_ida']) && $this->nmgp_cmp_hidden['tra_cia_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_cia_ida" value="<?php echo $this->form_encode_input($tra_cia_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_cia_ida" style="<?php echo $sStyleHidden_tra_cia_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_cia_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_cia_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_cia_ida"><?php echo $this->nm_new_label['tra_cia_ida']; ?></span></td></tr><tr><td class="css_tra_cia_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_cia_ida" value="<?php echo $this->form_encode_input($tra_cia_ida); ?>"><span id="id_ajax_label_tra_cia_ida"><?php echo nl2br($tra_cia_ida); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_cia_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_cia_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cia_ida_dsc']))
    {
        $this->nm_new_label['cia_ida_dsc'] = "Cia. Aérea:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cia_ida_dsc = $this->cia_ida_dsc;
   $sStyleHidden_cia_ida_dsc = '';
   if (isset($this->nmgp_cmp_hidden['cia_ida_dsc']) && $this->nmgp_cmp_hidden['cia_ida_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cia_ida_dsc']);
       $sStyleHidden_cia_ida_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cia_ida_dsc = 'display: none;';
   $sStyleReadInp_cia_ida_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cia_ida_dsc']) && $this->nmgp_cmp_readonly['cia_ida_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cia_ida_dsc']);
       $sStyleReadLab_cia_ida_dsc = '';
       $sStyleReadInp_cia_ida_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cia_ida_dsc']) && $this->nmgp_cmp_hidden['cia_ida_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cia_ida_dsc" value="<?php echo $this->form_encode_input($cia_ida_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cia_ida_dsc" style="<?php echo $sStyleHidden_cia_ida_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cia_ida_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cia_ida_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_cia_ida_dsc"><?php echo $this->nm_new_label['cia_ida_dsc']; ?></span></td></tr><tr><td class="css_cia_ida_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="cia_ida_dsc" value="<?php echo $this->form_encode_input($cia_ida_dsc); ?>"><span id="id_ajax_label_cia_ida_dsc"><?php echo nl2br($cia_ida_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cia_ida_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cia_ida_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_numvoo_ida']))
    {
        $this->nm_new_label['tra_numvoo_ida'] = "Num. Voo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_numvoo_ida = $this->tra_numvoo_ida;
   $sStyleHidden_tra_numvoo_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_numvoo_ida']) && $this->nmgp_cmp_hidden['tra_numvoo_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_numvoo_ida']);
       $sStyleHidden_tra_numvoo_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_numvoo_ida = 'display: none;';
   $sStyleReadInp_tra_numvoo_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_numvoo_ida']) && $this->nmgp_cmp_readonly['tra_numvoo_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_numvoo_ida']);
       $sStyleReadLab_tra_numvoo_ida = '';
       $sStyleReadInp_tra_numvoo_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_numvoo_ida']) && $this->nmgp_cmp_hidden['tra_numvoo_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_numvoo_ida" value="<?php echo $this->form_encode_input($tra_numvoo_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_numvoo_ida" style="<?php echo $sStyleHidden_tra_numvoo_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_numvoo_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_numvoo_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_numvoo_ida"><?php echo $this->nm_new_label['tra_numvoo_ida']; ?></span></td></tr><tr><td class="css_tra_numvoo_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_numvoo_ida" value="<?php echo $this->form_encode_input($tra_numvoo_ida); ?>"><span id="id_ajax_label_tra_numvoo_ida"><?php echo nl2br($tra_numvoo_ida); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_numvoo_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_numvoo_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_origem_ida']))
    {
        $this->nm_new_label['tra_origem_ida'] = "Cód. Origerm:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_origem_ida = $this->tra_origem_ida;
   $sStyleHidden_tra_origem_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_origem_ida']) && $this->nmgp_cmp_hidden['tra_origem_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_origem_ida']);
       $sStyleHidden_tra_origem_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_origem_ida = 'display: none;';
   $sStyleReadInp_tra_origem_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_origem_ida']) && $this->nmgp_cmp_readonly['tra_origem_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_origem_ida']);
       $sStyleReadLab_tra_origem_ida = '';
       $sStyleReadInp_tra_origem_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_origem_ida']) && $this->nmgp_cmp_hidden['tra_origem_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_origem_ida" value="<?php echo $this->form_encode_input($tra_origem_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_origem_ida" style="<?php echo $sStyleHidden_tra_origem_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_origem_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_origem_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_origem_ida"><?php echo $this->nm_new_label['tra_origem_ida']; ?></span></td></tr><tr><td class="css_tra_origem_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_origem_ida" value="<?php echo $this->form_encode_input($tra_origem_ida); ?>"><span id="id_ajax_label_tra_origem_ida"><?php echo nl2br($tra_origem_ida); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_origem_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_origem_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['origem_ida_dsc']))
    {
        $this->nm_new_label['origem_ida_dsc'] = "Origem:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $origem_ida_dsc = $this->origem_ida_dsc;
   $sStyleHidden_origem_ida_dsc = '';
   if (isset($this->nmgp_cmp_hidden['origem_ida_dsc']) && $this->nmgp_cmp_hidden['origem_ida_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['origem_ida_dsc']);
       $sStyleHidden_origem_ida_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_origem_ida_dsc = 'display: none;';
   $sStyleReadInp_origem_ida_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['origem_ida_dsc']) && $this->nmgp_cmp_readonly['origem_ida_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['origem_ida_dsc']);
       $sStyleReadLab_origem_ida_dsc = '';
       $sStyleReadInp_origem_ida_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['origem_ida_dsc']) && $this->nmgp_cmp_hidden['origem_ida_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="origem_ida_dsc" value="<?php echo $this->form_encode_input($origem_ida_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_origem_ida_dsc" style="<?php echo $sStyleHidden_origem_ida_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_origem_ida_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_origem_ida_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_origem_ida_dsc"><?php echo $this->nm_new_label['origem_ida_dsc']; ?></span></td></tr><tr><td class="css_origem_ida_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="origem_ida_dsc" value="<?php echo $this->form_encode_input($origem_ida_dsc); ?>"><span id="id_ajax_label_origem_ida_dsc"><?php echo nl2br($origem_ida_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_origem_ida_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_origem_ida_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_destino_ida']))
    {
        $this->nm_new_label['tra_destino_ida'] = "Cód. Destino:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_destino_ida = $this->tra_destino_ida;
   $sStyleHidden_tra_destino_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_destino_ida']) && $this->nmgp_cmp_hidden['tra_destino_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_destino_ida']);
       $sStyleHidden_tra_destino_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_destino_ida = 'display: none;';
   $sStyleReadInp_tra_destino_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_destino_ida']) && $this->nmgp_cmp_readonly['tra_destino_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_destino_ida']);
       $sStyleReadLab_tra_destino_ida = '';
       $sStyleReadInp_tra_destino_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_destino_ida']) && $this->nmgp_cmp_hidden['tra_destino_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_destino_ida" value="<?php echo $this->form_encode_input($tra_destino_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_destino_ida" style="<?php echo $sStyleHidden_tra_destino_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_destino_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_destino_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_destino_ida"><?php echo $this->nm_new_label['tra_destino_ida']; ?></span></td></tr><tr><td class="css_tra_destino_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_destino_ida" value="<?php echo $this->form_encode_input($tra_destino_ida); ?>"><span id="id_ajax_label_tra_destino_ida"><?php echo nl2br($tra_destino_ida); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_destino_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_destino_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['destino_ida_dsc']))
    {
        $this->nm_new_label['destino_ida_dsc'] = "Destino:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $destino_ida_dsc = $this->destino_ida_dsc;
   $sStyleHidden_destino_ida_dsc = '';
   if (isset($this->nmgp_cmp_hidden['destino_ida_dsc']) && $this->nmgp_cmp_hidden['destino_ida_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['destino_ida_dsc']);
       $sStyleHidden_destino_ida_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_destino_ida_dsc = 'display: none;';
   $sStyleReadInp_destino_ida_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['destino_ida_dsc']) && $this->nmgp_cmp_readonly['destino_ida_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['destino_ida_dsc']);
       $sStyleReadLab_destino_ida_dsc = '';
       $sStyleReadInp_destino_ida_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['destino_ida_dsc']) && $this->nmgp_cmp_hidden['destino_ida_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="destino_ida_dsc" value="<?php echo $this->form_encode_input($destino_ida_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_destino_ida_dsc" style="<?php echo $sStyleHidden_destino_ida_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_destino_ida_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_destino_ida_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_destino_ida_dsc"><?php echo $this->nm_new_label['destino_ida_dsc']; ?></span></td></tr><tr><td class="css_destino_ida_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="destino_ida_dsc" value="<?php echo $this->form_encode_input($destino_ida_dsc); ?>"><span id="id_ajax_label_destino_ida_dsc"><?php echo nl2br($destino_ida_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_destino_ida_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_destino_ida_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_dt_saida_ida']))
    {
        $this->nm_new_label['tra_dt_saida_ida'] = "Data Saída:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_dt_saida_ida = $this->tra_dt_saida_ida;
   $sStyleHidden_tra_dt_saida_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_dt_saida_ida']) && $this->nmgp_cmp_hidden['tra_dt_saida_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_dt_saida_ida']);
       $sStyleHidden_tra_dt_saida_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_dt_saida_ida = 'display: none;';
   $sStyleReadInp_tra_dt_saida_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_dt_saida_ida']) && $this->nmgp_cmp_readonly['tra_dt_saida_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_dt_saida_ida']);
       $sStyleReadLab_tra_dt_saida_ida = '';
       $sStyleReadInp_tra_dt_saida_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_dt_saida_ida']) && $this->nmgp_cmp_hidden['tra_dt_saida_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_dt_saida_ida" value="<?php echo $this->form_encode_input($tra_dt_saida_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_dt_saida_ida" style="<?php echo $sStyleHidden_tra_dt_saida_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_dt_saida_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_dt_saida_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_dt_saida_ida"><?php echo $this->nm_new_label['tra_dt_saida_ida']; ?></span></td></tr><tr><td class="css_tra_dt_saida_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_dt_saida_ida" value="<?php echo $this->form_encode_input($tra_dt_saida_ida); ?>"><span id="id_ajax_label_tra_dt_saida_ida"><?php echo nl2br($tra_dt_saida_ida); ?></span>
<?php
$tmp_form_data = $this->field_config['tra_dt_saida_ida']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_dt_saida_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_dt_saida_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_hr_saida_ida']))
    {
        $this->nm_new_label['tra_hr_saida_ida'] = "Hora Saída:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_hr_saida_ida = $this->tra_hr_saida_ida;
   $sStyleHidden_tra_hr_saida_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_hr_saida_ida']) && $this->nmgp_cmp_hidden['tra_hr_saida_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_hr_saida_ida']);
       $sStyleHidden_tra_hr_saida_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_hr_saida_ida = 'display: none;';
   $sStyleReadInp_tra_hr_saida_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_hr_saida_ida']) && $this->nmgp_cmp_readonly['tra_hr_saida_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_hr_saida_ida']);
       $sStyleReadLab_tra_hr_saida_ida = '';
       $sStyleReadInp_tra_hr_saida_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_hr_saida_ida']) && $this->nmgp_cmp_hidden['tra_hr_saida_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_hr_saida_ida" value="<?php echo $this->form_encode_input($tra_hr_saida_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_hr_saida_ida" style="<?php echo $sStyleHidden_tra_hr_saida_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_hr_saida_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_hr_saida_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_hr_saida_ida"><?php echo $this->nm_new_label['tra_hr_saida_ida']; ?></span></td></tr><tr><td class="css_tra_hr_saida_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_hr_saida_ida" value="<?php echo $this->form_encode_input($tra_hr_saida_ida); ?>"><span id="id_ajax_label_tra_hr_saida_ida"><?php echo nl2br($tra_hr_saida_ida); ?></span>
<?php
$tmp_form_data = $this->field_config['tra_hr_saida_ida']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_hr_saida_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_hr_saida_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_dt_chegada_ida']))
    {
        $this->nm_new_label['tra_dt_chegada_ida'] = "Data Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_dt_chegada_ida = $this->tra_dt_chegada_ida;
   $sStyleHidden_tra_dt_chegada_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_dt_chegada_ida']) && $this->nmgp_cmp_hidden['tra_dt_chegada_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_dt_chegada_ida']);
       $sStyleHidden_tra_dt_chegada_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_dt_chegada_ida = 'display: none;';
   $sStyleReadInp_tra_dt_chegada_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_dt_chegada_ida']) && $this->nmgp_cmp_readonly['tra_dt_chegada_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_dt_chegada_ida']);
       $sStyleReadLab_tra_dt_chegada_ida = '';
       $sStyleReadInp_tra_dt_chegada_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_dt_chegada_ida']) && $this->nmgp_cmp_hidden['tra_dt_chegada_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_dt_chegada_ida" value="<?php echo $this->form_encode_input($tra_dt_chegada_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_dt_chegada_ida" style="<?php echo $sStyleHidden_tra_dt_chegada_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_dt_chegada_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_dt_chegada_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_dt_chegada_ida"><?php echo $this->nm_new_label['tra_dt_chegada_ida']; ?></span></td></tr><tr><td class="css_tra_dt_chegada_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_dt_chegada_ida" value="<?php echo $this->form_encode_input($tra_dt_chegada_ida); ?>"><span id="id_ajax_label_tra_dt_chegada_ida"><?php echo nl2br($tra_dt_chegada_ida); ?></span>
<?php
$tmp_form_data = $this->field_config['tra_dt_chegada_ida']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_dt_chegada_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_dt_chegada_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_hr_chegada_ida']))
    {
        $this->nm_new_label['tra_hr_chegada_ida'] = "Hora Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_hr_chegada_ida = $this->tra_hr_chegada_ida;
   $sStyleHidden_tra_hr_chegada_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_hr_chegada_ida']) && $this->nmgp_cmp_hidden['tra_hr_chegada_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_hr_chegada_ida']);
       $sStyleHidden_tra_hr_chegada_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_hr_chegada_ida = 'display: none;';
   $sStyleReadInp_tra_hr_chegada_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_hr_chegada_ida']) && $this->nmgp_cmp_readonly['tra_hr_chegada_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_hr_chegada_ida']);
       $sStyleReadLab_tra_hr_chegada_ida = '';
       $sStyleReadInp_tra_hr_chegada_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_hr_chegada_ida']) && $this->nmgp_cmp_hidden['tra_hr_chegada_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_hr_chegada_ida" value="<?php echo $this->form_encode_input($tra_hr_chegada_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_hr_chegada_ida" style="<?php echo $sStyleHidden_tra_hr_chegada_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_hr_chegada_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_hr_chegada_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_hr_chegada_ida"><?php echo $this->nm_new_label['tra_hr_chegada_ida']; ?></span></td></tr><tr><td class="css_tra_hr_chegada_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_hr_chegada_ida" value="<?php echo $this->form_encode_input($tra_hr_chegada_ida); ?>"><span id="id_ajax_label_tra_hr_chegada_ida"><?php echo nl2br($tra_hr_chegada_ida); ?></span>
<?php
$tmp_form_data = $this->field_config['tra_hr_chegada_ida']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_hr_chegada_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_hr_chegada_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_localizador_ida']))
    {
        $this->nm_new_label['tra_localizador_ida'] = "Localizador: ";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_localizador_ida = $this->tra_localizador_ida;
   $sStyleHidden_tra_localizador_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_localizador_ida']) && $this->nmgp_cmp_hidden['tra_localizador_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_localizador_ida']);
       $sStyleHidden_tra_localizador_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_localizador_ida = 'display: none;';
   $sStyleReadInp_tra_localizador_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_localizador_ida']) && $this->nmgp_cmp_readonly['tra_localizador_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_localizador_ida']);
       $sStyleReadLab_tra_localizador_ida = '';
       $sStyleReadInp_tra_localizador_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_localizador_ida']) && $this->nmgp_cmp_hidden['tra_localizador_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_localizador_ida" value="<?php echo $this->form_encode_input($tra_localizador_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_localizador_ida" style="<?php echo $sStyleHidden_tra_localizador_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_localizador_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_localizador_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_localizador_ida"><?php echo $this->nm_new_label['tra_localizador_ida']; ?></span></td></tr><tr><td class="css_tra_localizador_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_localizador_ida" value="<?php echo $this->form_encode_input($tra_localizador_ida); ?>"><span id="id_ajax_label_tra_localizador_ida"><?php echo nl2br($tra_localizador_ida); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_localizador_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_localizador_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_eticket_ida']))
    {
        $this->nm_new_label['tra_eticket_ida'] = "E-Ticket:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_eticket_ida = $this->tra_eticket_ida;
   $sStyleHidden_tra_eticket_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_eticket_ida']) && $this->nmgp_cmp_hidden['tra_eticket_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_eticket_ida']);
       $sStyleHidden_tra_eticket_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_eticket_ida = 'display: none;';
   $sStyleReadInp_tra_eticket_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_eticket_ida']) && $this->nmgp_cmp_readonly['tra_eticket_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_eticket_ida']);
       $sStyleReadLab_tra_eticket_ida = '';
       $sStyleReadInp_tra_eticket_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_eticket_ida']) && $this->nmgp_cmp_hidden['tra_eticket_ida'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_eticket_ida" value="<?php echo $this->form_encode_input($tra_eticket_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_eticket_ida" style="<?php echo $sStyleHidden_tra_eticket_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_eticket_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_eticket_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_eticket_ida"><?php echo $this->nm_new_label['tra_eticket_ida']; ?></span></td></tr><tr><td class="css_tra_eticket_ida_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_eticket_ida" value="<?php echo $this->form_encode_input($tra_eticket_ida); ?>"><span id="id_ajax_label_tra_eticket_ida"><?php echo nl2br($tra_eticket_ida); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_eticket_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_eticket_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_flag_ida']))
   {
       $this->nm_new_label['tra_flag_ida'] = "IDA:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_flag_ida = $this->tra_flag_ida;
   $sStyleHidden_tra_flag_ida = '';
   if (isset($this->nmgp_cmp_hidden['tra_flag_ida']) && $this->nmgp_cmp_hidden['tra_flag_ida'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_flag_ida']);
       $sStyleHidden_tra_flag_ida = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_flag_ida = 'display: none;';
   $sStyleReadInp_tra_flag_ida = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_flag_ida']) && $this->nmgp_cmp_readonly['tra_flag_ida'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_flag_ida']);
       $sStyleReadLab_tra_flag_ida = '';
       $sStyleReadInp_tra_flag_ida = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_flag_ida']) && $this->nmgp_cmp_hidden['tra_flag_ida'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_flag_ida" value="<?php echo $this->form_encode_input($this->tra_flag_ida) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_flag_ida" style="<?php echo $sStyleHidden_tra_flag_ida; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_flag_ida_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_flag_ida_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_flag_ida"><?php echo $this->nm_new_label['tra_flag_ida']; ?></span></td></tr><tr><td class="css_tra_flag_ida_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_flag_ida"]) &&  $this->nmgp_cmp_readonly["tra_flag_ida"] == "on") { 

$tra_flag_ida_look = "";
 if ($this->tra_flag_ida == "N") { $tra_flag_ida_look .= "Não" ;} 
 if ($this->tra_flag_ida == "Y") { $tra_flag_ida_look .= "Sim" ;} 
 if (empty($tra_flag_ida_look)) { $tra_flag_ida_look = $this->tra_flag_ida; }
?>
<input type="hidden" name="tra_flag_ida" value="<?php echo $this->form_encode_input($tra_flag_ida) . "\">" . $tra_flag_ida_look . ""; ?>
<?php } else { ?>
<?php

$tra_flag_ida_look = "";
 if ($this->tra_flag_ida == "N") { $tra_flag_ida_look .= "Não" ;} 
 if ($this->tra_flag_ida == "Y") { $tra_flag_ida_look .= "Sim" ;} 
 if (empty($tra_flag_ida_look)) { $tra_flag_ida_look = $this->tra_flag_ida; }
?>
<span id="id_read_on_tra_flag_ida" class="css_tra_flag_ida_line"  style="<?php echo $sStyleReadLab_tra_flag_ida; ?>"><?php echo $this->form_format_readonly("tra_flag_ida", $this->form_encode_input($tra_flag_ida_look)); ?></span><span id="id_read_off_tra_flag_ida" class="css_read_off_tra_flag_ida<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tra_flag_ida; ?>">
 <span id="idAjaxSelect_tra_flag_ida" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tra_flag_ida_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_flag_ida" name="tra_flag_ida" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->tra_flag_ida == "N") { echo " selected" ;} ?><?php  if (empty($this->tra_flag_ida)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_ida'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->tra_flag_ida == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_ida'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_flag_ida_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_flag_ida_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_tra_flag_ida_dumb = ('' == $sStyleHidden_tra_flag_ida) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_tra_flag_ida_dumb" style="<?php echo $sStyleHidden_tra_flag_ida_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_2"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_2" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock" style="background-color: #CCCC99">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Aéreo Volta</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_cia_volta']))
    {
        $this->nm_new_label['tra_cia_volta'] = "Cód. Cia Aérea:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_cia_volta = $this->tra_cia_volta;
   $sStyleHidden_tra_cia_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_cia_volta']) && $this->nmgp_cmp_hidden['tra_cia_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_cia_volta']);
       $sStyleHidden_tra_cia_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_cia_volta = 'display: none;';
   $sStyleReadInp_tra_cia_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_cia_volta']) && $this->nmgp_cmp_readonly['tra_cia_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_cia_volta']);
       $sStyleReadLab_tra_cia_volta = '';
       $sStyleReadInp_tra_cia_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_cia_volta']) && $this->nmgp_cmp_hidden['tra_cia_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_cia_volta" value="<?php echo $this->form_encode_input($tra_cia_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_cia_volta" style="<?php echo $sStyleHidden_tra_cia_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_cia_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_cia_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_cia_volta"><?php echo $this->nm_new_label['tra_cia_volta']; ?></span></td></tr><tr><td class="css_tra_cia_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_cia_volta" value="<?php echo $this->form_encode_input($tra_cia_volta); ?>"><span id="id_ajax_label_tra_cia_volta"><?php echo nl2br($tra_cia_volta); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_cia_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_cia_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['cia_volta_dsc']))
    {
        $this->nm_new_label['cia_volta_dsc'] = "Cia Aérea:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $cia_volta_dsc = $this->cia_volta_dsc;
   $sStyleHidden_cia_volta_dsc = '';
   if (isset($this->nmgp_cmp_hidden['cia_volta_dsc']) && $this->nmgp_cmp_hidden['cia_volta_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['cia_volta_dsc']);
       $sStyleHidden_cia_volta_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_cia_volta_dsc = 'display: none;';
   $sStyleReadInp_cia_volta_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['cia_volta_dsc']) && $this->nmgp_cmp_readonly['cia_volta_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['cia_volta_dsc']);
       $sStyleReadLab_cia_volta_dsc = '';
       $sStyleReadInp_cia_volta_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['cia_volta_dsc']) && $this->nmgp_cmp_hidden['cia_volta_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cia_volta_dsc" value="<?php echo $this->form_encode_input($cia_volta_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_cia_volta_dsc" style="<?php echo $sStyleHidden_cia_volta_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cia_volta_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cia_volta_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_cia_volta_dsc"><?php echo $this->nm_new_label['cia_volta_dsc']; ?></span></td></tr><tr><td class="css_cia_volta_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="cia_volta_dsc" value="<?php echo $this->form_encode_input($cia_volta_dsc); ?>"><span id="id_ajax_label_cia_volta_dsc"><?php echo nl2br($cia_volta_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cia_volta_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cia_volta_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_numvoo_volta']))
    {
        $this->nm_new_label['tra_numvoo_volta'] = "Cód. Voo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_numvoo_volta = $this->tra_numvoo_volta;
   $sStyleHidden_tra_numvoo_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_numvoo_volta']) && $this->nmgp_cmp_hidden['tra_numvoo_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_numvoo_volta']);
       $sStyleHidden_tra_numvoo_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_numvoo_volta = 'display: none;';
   $sStyleReadInp_tra_numvoo_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_numvoo_volta']) && $this->nmgp_cmp_readonly['tra_numvoo_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_numvoo_volta']);
       $sStyleReadLab_tra_numvoo_volta = '';
       $sStyleReadInp_tra_numvoo_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_numvoo_volta']) && $this->nmgp_cmp_hidden['tra_numvoo_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_numvoo_volta" value="<?php echo $this->form_encode_input($tra_numvoo_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_numvoo_volta" style="<?php echo $sStyleHidden_tra_numvoo_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_numvoo_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_numvoo_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_numvoo_volta"><?php echo $this->nm_new_label['tra_numvoo_volta']; ?></span></td></tr><tr><td class="css_tra_numvoo_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_numvoo_volta" value="<?php echo $this->form_encode_input($tra_numvoo_volta); ?>"><span id="id_ajax_label_tra_numvoo_volta"><?php echo nl2br($tra_numvoo_volta); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_numvoo_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_numvoo_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_origem_volta']))
    {
        $this->nm_new_label['tra_origem_volta'] = "Cód. Origem:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_origem_volta = $this->tra_origem_volta;
   $sStyleHidden_tra_origem_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_origem_volta']) && $this->nmgp_cmp_hidden['tra_origem_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_origem_volta']);
       $sStyleHidden_tra_origem_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_origem_volta = 'display: none;';
   $sStyleReadInp_tra_origem_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_origem_volta']) && $this->nmgp_cmp_readonly['tra_origem_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_origem_volta']);
       $sStyleReadLab_tra_origem_volta = '';
       $sStyleReadInp_tra_origem_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_origem_volta']) && $this->nmgp_cmp_hidden['tra_origem_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_origem_volta" value="<?php echo $this->form_encode_input($tra_origem_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_origem_volta" style="<?php echo $sStyleHidden_tra_origem_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_origem_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_origem_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_origem_volta"><?php echo $this->nm_new_label['tra_origem_volta']; ?></span></td></tr><tr><td class="css_tra_origem_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_origem_volta" value="<?php echo $this->form_encode_input($tra_origem_volta); ?>"><span id="id_ajax_label_tra_origem_volta"><?php echo nl2br($tra_origem_volta); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_origem_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_origem_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['origem_volta_dsc']))
    {
        $this->nm_new_label['origem_volta_dsc'] = "Origem:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $origem_volta_dsc = $this->origem_volta_dsc;
   $sStyleHidden_origem_volta_dsc = '';
   if (isset($this->nmgp_cmp_hidden['origem_volta_dsc']) && $this->nmgp_cmp_hidden['origem_volta_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['origem_volta_dsc']);
       $sStyleHidden_origem_volta_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_origem_volta_dsc = 'display: none;';
   $sStyleReadInp_origem_volta_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['origem_volta_dsc']) && $this->nmgp_cmp_readonly['origem_volta_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['origem_volta_dsc']);
       $sStyleReadLab_origem_volta_dsc = '';
       $sStyleReadInp_origem_volta_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['origem_volta_dsc']) && $this->nmgp_cmp_hidden['origem_volta_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="origem_volta_dsc" value="<?php echo $this->form_encode_input($origem_volta_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_origem_volta_dsc" style="<?php echo $sStyleHidden_origem_volta_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_origem_volta_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_origem_volta_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_origem_volta_dsc"><?php echo $this->nm_new_label['origem_volta_dsc']; ?></span></td></tr><tr><td class="css_origem_volta_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="origem_volta_dsc" value="<?php echo $this->form_encode_input($origem_volta_dsc); ?>"><span id="id_ajax_label_origem_volta_dsc"><?php echo nl2br($origem_volta_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_origem_volta_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_origem_volta_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_destino_volta']))
    {
        $this->nm_new_label['tra_destino_volta'] = "Cód. Destino:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_destino_volta = $this->tra_destino_volta;
   $sStyleHidden_tra_destino_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_destino_volta']) && $this->nmgp_cmp_hidden['tra_destino_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_destino_volta']);
       $sStyleHidden_tra_destino_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_destino_volta = 'display: none;';
   $sStyleReadInp_tra_destino_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_destino_volta']) && $this->nmgp_cmp_readonly['tra_destino_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_destino_volta']);
       $sStyleReadLab_tra_destino_volta = '';
       $sStyleReadInp_tra_destino_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_destino_volta']) && $this->nmgp_cmp_hidden['tra_destino_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_destino_volta" value="<?php echo $this->form_encode_input($tra_destino_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_destino_volta" style="<?php echo $sStyleHidden_tra_destino_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_destino_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_destino_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_destino_volta"><?php echo $this->nm_new_label['tra_destino_volta']; ?></span></td></tr><tr><td class="css_tra_destino_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_destino_volta" value="<?php echo $this->form_encode_input($tra_destino_volta); ?>"><span id="id_ajax_label_tra_destino_volta"><?php echo nl2br($tra_destino_volta); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_destino_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_destino_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['destino_volta_dsc']))
    {
        $this->nm_new_label['destino_volta_dsc'] = "Destino:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $destino_volta_dsc = $this->destino_volta_dsc;
   $sStyleHidden_destino_volta_dsc = '';
   if (isset($this->nmgp_cmp_hidden['destino_volta_dsc']) && $this->nmgp_cmp_hidden['destino_volta_dsc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['destino_volta_dsc']);
       $sStyleHidden_destino_volta_dsc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_destino_volta_dsc = 'display: none;';
   $sStyleReadInp_destino_volta_dsc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['destino_volta_dsc']) && $this->nmgp_cmp_readonly['destino_volta_dsc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['destino_volta_dsc']);
       $sStyleReadLab_destino_volta_dsc = '';
       $sStyleReadInp_destino_volta_dsc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['destino_volta_dsc']) && $this->nmgp_cmp_hidden['destino_volta_dsc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="destino_volta_dsc" value="<?php echo $this->form_encode_input($destino_volta_dsc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_destino_volta_dsc" style="<?php echo $sStyleHidden_destino_volta_dsc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_destino_volta_dsc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_destino_volta_dsc_label" style=" padding: 0px; width: 100%;"><span id="id_label_destino_volta_dsc"><?php echo $this->nm_new_label['destino_volta_dsc']; ?></span></td></tr><tr><td class="css_destino_volta_dsc_line" style="padding: 0px; width: 100%;"><input type="hidden" name="destino_volta_dsc" value="<?php echo $this->form_encode_input($destino_volta_dsc); ?>"><span id="id_ajax_label_destino_volta_dsc"><?php echo nl2br($destino_volta_dsc); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_destino_volta_dsc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_destino_volta_dsc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_dt_saida_volta']))
    {
        $this->nm_new_label['tra_dt_saida_volta'] = "Data Saída:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_dt_saida_volta = $this->tra_dt_saida_volta;
   $sStyleHidden_tra_dt_saida_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_dt_saida_volta']) && $this->nmgp_cmp_hidden['tra_dt_saida_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_dt_saida_volta']);
       $sStyleHidden_tra_dt_saida_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_dt_saida_volta = 'display: none;';
   $sStyleReadInp_tra_dt_saida_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_dt_saida_volta']) && $this->nmgp_cmp_readonly['tra_dt_saida_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_dt_saida_volta']);
       $sStyleReadLab_tra_dt_saida_volta = '';
       $sStyleReadInp_tra_dt_saida_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_dt_saida_volta']) && $this->nmgp_cmp_hidden['tra_dt_saida_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_dt_saida_volta" value="<?php echo $this->form_encode_input($tra_dt_saida_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_dt_saida_volta" style="<?php echo $sStyleHidden_tra_dt_saida_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_dt_saida_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_dt_saida_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_dt_saida_volta"><?php echo $this->nm_new_label['tra_dt_saida_volta']; ?></span></td></tr><tr><td class="css_tra_dt_saida_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_dt_saida_volta" value="<?php echo $this->form_encode_input($tra_dt_saida_volta); ?>"><span id="id_ajax_label_tra_dt_saida_volta"><?php echo nl2br($tra_dt_saida_volta); ?></span>
<?php
$tmp_form_data = $this->field_config['tra_dt_saida_volta']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_dt_saida_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_dt_saida_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_hr_saida_volta']))
    {
        $this->nm_new_label['tra_hr_saida_volta'] = "Hora Saída:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_hr_saida_volta = $this->tra_hr_saida_volta;
   $sStyleHidden_tra_hr_saida_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_hr_saida_volta']) && $this->nmgp_cmp_hidden['tra_hr_saida_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_hr_saida_volta']);
       $sStyleHidden_tra_hr_saida_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_hr_saida_volta = 'display: none;';
   $sStyleReadInp_tra_hr_saida_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_hr_saida_volta']) && $this->nmgp_cmp_readonly['tra_hr_saida_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_hr_saida_volta']);
       $sStyleReadLab_tra_hr_saida_volta = '';
       $sStyleReadInp_tra_hr_saida_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_hr_saida_volta']) && $this->nmgp_cmp_hidden['tra_hr_saida_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_hr_saida_volta" value="<?php echo $this->form_encode_input($tra_hr_saida_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_hr_saida_volta" style="<?php echo $sStyleHidden_tra_hr_saida_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_hr_saida_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_hr_saida_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_hr_saida_volta"><?php echo $this->nm_new_label['tra_hr_saida_volta']; ?></span></td></tr><tr><td class="css_tra_hr_saida_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_hr_saida_volta" value="<?php echo $this->form_encode_input($tra_hr_saida_volta); ?>"><span id="id_ajax_label_tra_hr_saida_volta"><?php echo nl2br($tra_hr_saida_volta); ?></span>
<?php
$tmp_form_data = $this->field_config['tra_hr_saida_volta']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_hr_saida_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_hr_saida_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_dt_chegada_volta']))
    {
        $this->nm_new_label['tra_dt_chegada_volta'] = "Data Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_dt_chegada_volta = $this->tra_dt_chegada_volta;
   $sStyleHidden_tra_dt_chegada_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_dt_chegada_volta']) && $this->nmgp_cmp_hidden['tra_dt_chegada_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_dt_chegada_volta']);
       $sStyleHidden_tra_dt_chegada_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_dt_chegada_volta = 'display: none;';
   $sStyleReadInp_tra_dt_chegada_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_dt_chegada_volta']) && $this->nmgp_cmp_readonly['tra_dt_chegada_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_dt_chegada_volta']);
       $sStyleReadLab_tra_dt_chegada_volta = '';
       $sStyleReadInp_tra_dt_chegada_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_dt_chegada_volta']) && $this->nmgp_cmp_hidden['tra_dt_chegada_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_dt_chegada_volta" value="<?php echo $this->form_encode_input($tra_dt_chegada_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_dt_chegada_volta" style="<?php echo $sStyleHidden_tra_dt_chegada_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_dt_chegada_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_dt_chegada_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_dt_chegada_volta"><?php echo $this->nm_new_label['tra_dt_chegada_volta']; ?></span></td></tr><tr><td class="css_tra_dt_chegada_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_dt_chegada_volta" value="<?php echo $this->form_encode_input($tra_dt_chegada_volta); ?>"><span id="id_ajax_label_tra_dt_chegada_volta"><?php echo nl2br($tra_dt_chegada_volta); ?></span>
<?php
$tmp_form_data = $this->field_config['tra_dt_chegada_volta']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_dt_chegada_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_dt_chegada_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_hr_chegada_volta']))
    {
        $this->nm_new_label['tra_hr_chegada_volta'] = "Hora Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_hr_chegada_volta = $this->tra_hr_chegada_volta;
   $sStyleHidden_tra_hr_chegada_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_hr_chegada_volta']) && $this->nmgp_cmp_hidden['tra_hr_chegada_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_hr_chegada_volta']);
       $sStyleHidden_tra_hr_chegada_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_hr_chegada_volta = 'display: none;';
   $sStyleReadInp_tra_hr_chegada_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_hr_chegada_volta']) && $this->nmgp_cmp_readonly['tra_hr_chegada_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_hr_chegada_volta']);
       $sStyleReadLab_tra_hr_chegada_volta = '';
       $sStyleReadInp_tra_hr_chegada_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_hr_chegada_volta']) && $this->nmgp_cmp_hidden['tra_hr_chegada_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_hr_chegada_volta" value="<?php echo $this->form_encode_input($tra_hr_chegada_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_hr_chegada_volta" style="<?php echo $sStyleHidden_tra_hr_chegada_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_hr_chegada_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_hr_chegada_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_hr_chegada_volta"><?php echo $this->nm_new_label['tra_hr_chegada_volta']; ?></span></td></tr><tr><td class="css_tra_hr_chegada_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_hr_chegada_volta" value="<?php echo $this->form_encode_input($tra_hr_chegada_volta); ?>"><span id="id_ajax_label_tra_hr_chegada_volta"><?php echo nl2br($tra_hr_chegada_volta); ?></span>
<?php
$tmp_form_data = $this->field_config['tra_hr_chegada_volta']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_hr_chegada_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_hr_chegada_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_localizador_volta']))
    {
        $this->nm_new_label['tra_localizador_volta'] = "Localizador:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_localizador_volta = $this->tra_localizador_volta;
   $sStyleHidden_tra_localizador_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_localizador_volta']) && $this->nmgp_cmp_hidden['tra_localizador_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_localizador_volta']);
       $sStyleHidden_tra_localizador_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_localizador_volta = 'display: none;';
   $sStyleReadInp_tra_localizador_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_localizador_volta']) && $this->nmgp_cmp_readonly['tra_localizador_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_localizador_volta']);
       $sStyleReadLab_tra_localizador_volta = '';
       $sStyleReadInp_tra_localizador_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_localizador_volta']) && $this->nmgp_cmp_hidden['tra_localizador_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_localizador_volta" value="<?php echo $this->form_encode_input($tra_localizador_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_localizador_volta" style="<?php echo $sStyleHidden_tra_localizador_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_localizador_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_localizador_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_localizador_volta"><?php echo $this->nm_new_label['tra_localizador_volta']; ?></span></td></tr><tr><td class="css_tra_localizador_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_localizador_volta" value="<?php echo $this->form_encode_input($tra_localizador_volta); ?>"><span id="id_ajax_label_tra_localizador_volta"><?php echo nl2br($tra_localizador_volta); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_localizador_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_localizador_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_eticket_volta']))
    {
        $this->nm_new_label['tra_eticket_volta'] = "E-Ticket:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_eticket_volta = $this->tra_eticket_volta;
   $sStyleHidden_tra_eticket_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_eticket_volta']) && $this->nmgp_cmp_hidden['tra_eticket_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_eticket_volta']);
       $sStyleHidden_tra_eticket_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_eticket_volta = 'display: none;';
   $sStyleReadInp_tra_eticket_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_eticket_volta']) && $this->nmgp_cmp_readonly['tra_eticket_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_eticket_volta']);
       $sStyleReadLab_tra_eticket_volta = '';
       $sStyleReadInp_tra_eticket_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_eticket_volta']) && $this->nmgp_cmp_hidden['tra_eticket_volta'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_eticket_volta" value="<?php echo $this->form_encode_input($tra_eticket_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_eticket_volta" style="<?php echo $sStyleHidden_tra_eticket_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_eticket_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_eticket_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_eticket_volta"><?php echo $this->nm_new_label['tra_eticket_volta']; ?></span></td></tr><tr><td class="css_tra_eticket_volta_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_eticket_volta" value="<?php echo $this->form_encode_input($tra_eticket_volta); ?>"><span id="id_ajax_label_tra_eticket_volta"><?php echo nl2br($tra_eticket_volta); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_eticket_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_eticket_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_intervalo']))
   {
       $this->nm_new_label['tra_intervalo'] = "Intervalo Tr. Out:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_intervalo = $this->tra_intervalo;
   $sStyleHidden_tra_intervalo = '';
   if (isset($this->nmgp_cmp_hidden['tra_intervalo']) && $this->nmgp_cmp_hidden['tra_intervalo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_intervalo']);
       $sStyleHidden_tra_intervalo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_intervalo = 'display: none;';
   $sStyleReadInp_tra_intervalo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_intervalo']) && $this->nmgp_cmp_readonly['tra_intervalo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_intervalo']);
       $sStyleReadLab_tra_intervalo = '';
       $sStyleReadInp_tra_intervalo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_intervalo']) && $this->nmgp_cmp_hidden['tra_intervalo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_intervalo" value="<?php echo $this->form_encode_input($this->tra_intervalo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_intervalo" style="<?php echo $sStyleHidden_tra_intervalo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_intervalo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_intervalo_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_intervalo"><?php echo $this->nm_new_label['tra_intervalo']; ?></span></td></tr><tr><td class="css_tra_intervalo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_intervalo"]) &&  $this->nmgp_cmp_readonly["tra_intervalo"] == "on") { 

$tra_intervalo_look = "";
 if ($this->tra_intervalo == "00:30") { $tra_intervalo_look .= "00:30" ;} 
 if ($this->tra_intervalo == "01:00") { $tra_intervalo_look .= "01:00" ;} 
 if ($this->tra_intervalo == "01:30") { $tra_intervalo_look .= "01:30" ;} 
 if ($this->tra_intervalo == "02:00") { $tra_intervalo_look .= "02:00" ;} 
 if ($this->tra_intervalo == "02:30") { $tra_intervalo_look .= "02:30" ;} 
 if ($this->tra_intervalo == "03:00") { $tra_intervalo_look .= "03:00" ;} 
 if ($this->tra_intervalo == "03:30") { $tra_intervalo_look .= "03:30" ;} 
 if ($this->tra_intervalo == "04:00") { $tra_intervalo_look .= "04:00" ;} 
 if ($this->tra_intervalo == "04:30") { $tra_intervalo_look .= "04:30" ;} 
 if ($this->tra_intervalo == "05:00") { $tra_intervalo_look .= "05:00" ;} 
 if ($this->tra_intervalo == "05:30") { $tra_intervalo_look .= "05:30" ;} 
 if ($this->tra_intervalo == "06:00") { $tra_intervalo_look .= "06:00" ;} 
 if ($this->tra_intervalo == "06:30") { $tra_intervalo_look .= "06:30" ;} 
 if (empty($tra_intervalo_look)) { $tra_intervalo_look = $this->tra_intervalo; }
?>
<input type="hidden" name="tra_intervalo" value="<?php echo $this->form_encode_input($tra_intervalo) . "\">" . $tra_intervalo_look . ""; ?>
<?php } else { ?>
<?php

$tra_intervalo_look = "";
 if ($this->tra_intervalo == "00:30") { $tra_intervalo_look .= "00:30" ;} 
 if ($this->tra_intervalo == "01:00") { $tra_intervalo_look .= "01:00" ;} 
 if ($this->tra_intervalo == "01:30") { $tra_intervalo_look .= "01:30" ;} 
 if ($this->tra_intervalo == "02:00") { $tra_intervalo_look .= "02:00" ;} 
 if ($this->tra_intervalo == "02:30") { $tra_intervalo_look .= "02:30" ;} 
 if ($this->tra_intervalo == "03:00") { $tra_intervalo_look .= "03:00" ;} 
 if ($this->tra_intervalo == "03:30") { $tra_intervalo_look .= "03:30" ;} 
 if ($this->tra_intervalo == "04:00") { $tra_intervalo_look .= "04:00" ;} 
 if ($this->tra_intervalo == "04:30") { $tra_intervalo_look .= "04:30" ;} 
 if ($this->tra_intervalo == "05:00") { $tra_intervalo_look .= "05:00" ;} 
 if ($this->tra_intervalo == "05:30") { $tra_intervalo_look .= "05:30" ;} 
 if ($this->tra_intervalo == "06:00") { $tra_intervalo_look .= "06:00" ;} 
 if ($this->tra_intervalo == "06:30") { $tra_intervalo_look .= "06:30" ;} 
 if (empty($tra_intervalo_look)) { $tra_intervalo_look = $this->tra_intervalo; }
?>
<span id="id_read_on_tra_intervalo" class="css_tra_intervalo_line"  style="<?php echo $sStyleReadLab_tra_intervalo; ?>"><?php echo $this->form_format_readonly("tra_intervalo", $this->form_encode_input($tra_intervalo_look)); ?></span><span id="id_read_off_tra_intervalo" class="css_read_off_tra_intervalo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tra_intervalo; ?>">
 <span id="idAjaxSelect_tra_intervalo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tra_intervalo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_intervalo" name="tra_intervalo" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = ''; ?>
 <option value="">.:selecione:.</option>
 <option  value="00:30" <?php  if ($this->tra_intervalo == "00:30") { echo " selected" ;} ?>>00:30</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '00:30'; ?>
 <option  value="01:00" <?php  if ($this->tra_intervalo == "01:00") { echo " selected" ;} ?>>01:00</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '01:00'; ?>
 <option  value="01:30" <?php  if ($this->tra_intervalo == "01:30") { echo " selected" ;} ?>>01:30</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '01:30'; ?>
 <option  value="02:00" <?php  if ($this->tra_intervalo == "02:00") { echo " selected" ;} ?>>02:00</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '02:00'; ?>
 <option  value="02:30" <?php  if ($this->tra_intervalo == "02:30") { echo " selected" ;} ?>>02:30</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '02:30'; ?>
 <option  value="03:00" <?php  if ($this->tra_intervalo == "03:00") { echo " selected" ;} ?>>03:00</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '03:00'; ?>
 <option  value="03:30" <?php  if ($this->tra_intervalo == "03:30") { echo " selected" ;} ?>>03:30</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '03:30'; ?>
 <option  value="04:00" <?php  if ($this->tra_intervalo == "04:00") { echo " selected" ;} ?>>04:00</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '04:00'; ?>
 <option  value="04:30" <?php  if ($this->tra_intervalo == "04:30") { echo " selected" ;} ?>>04:30</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '04:30'; ?>
 <option  value="05:00" <?php  if ($this->tra_intervalo == "05:00") { echo " selected" ;} ?>>05:00</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '05:00'; ?>
 <option  value="05:30" <?php  if ($this->tra_intervalo == "05:30") { echo " selected" ;} ?>>05:30</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '05:30'; ?>
 <option  value="06:00" <?php  if ($this->tra_intervalo == "06:00") { echo " selected" ;} ?>>06:00</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '06:00'; ?>
 <option  value="06:30" <?php  if ($this->tra_intervalo == "06:30") { echo " selected" ;} ?>>06:30</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_intervalo'][] = '06:30'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_intervalo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_intervalo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_hrtransout']))
    {
        $this->nm_new_label['tra_hrtransout'] = "Hr. Transfer Out:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_hrtransout = $this->tra_hrtransout;
   $sStyleHidden_tra_hrtransout = '';
   if (isset($this->nmgp_cmp_hidden['tra_hrtransout']) && $this->nmgp_cmp_hidden['tra_hrtransout'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_hrtransout']);
       $sStyleHidden_tra_hrtransout = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_hrtransout = 'display: none;';
   $sStyleReadInp_tra_hrtransout = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_hrtransout']) && $this->nmgp_cmp_readonly['tra_hrtransout'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_hrtransout']);
       $sStyleReadLab_tra_hrtransout = '';
       $sStyleReadInp_tra_hrtransout = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_hrtransout']) && $this->nmgp_cmp_hidden['tra_hrtransout'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_hrtransout" value="<?php echo $this->form_encode_input($tra_hrtransout) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_hrtransout" style="<?php echo $sStyleHidden_tra_hrtransout; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_hrtransout_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_hrtransout_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_hrtransout"><?php echo $this->nm_new_label['tra_hrtransout']; ?></span></td></tr><tr><td class="css_tra_hrtransout_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_hrtransout"]) &&  $this->nmgp_cmp_readonly["tra_hrtransout"] == "on") { 

 ?>
<input type="hidden" name="tra_hrtransout" value="<?php echo $this->form_encode_input($tra_hrtransout) . "\">" . $tra_hrtransout . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_hrtransout" class="sc-ui-readonly-tra_hrtransout css_tra_hrtransout_line" style="<?php echo $sStyleReadLab_tra_hrtransout; ?>"><?php echo $this->form_format_readonly("tra_hrtransout", $this->form_encode_input($tra_hrtransout)); ?></span><span id="id_read_off_tra_hrtransout" class="css_read_off_tra_hrtransout<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_hrtransout; ?>"><?php
$tmp_form_data = $this->field_config['tra_hrtransout']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_tra_hrtransout_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_hrtransout" type=text name="tra_hrtransout" value="<?php echo $this->form_encode_input($tra_hrtransout) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=5"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['tra_hrtransout']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['tra_hrtransout']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_hrtransout_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_hrtransout_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_flag_volta']))
   {
       $this->nm_new_label['tra_flag_volta'] = "VOLTA:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_flag_volta = $this->tra_flag_volta;
   $sStyleHidden_tra_flag_volta = '';
   if (isset($this->nmgp_cmp_hidden['tra_flag_volta']) && $this->nmgp_cmp_hidden['tra_flag_volta'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_flag_volta']);
       $sStyleHidden_tra_flag_volta = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_flag_volta = 'display: none;';
   $sStyleReadInp_tra_flag_volta = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_flag_volta']) && $this->nmgp_cmp_readonly['tra_flag_volta'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_flag_volta']);
       $sStyleReadLab_tra_flag_volta = '';
       $sStyleReadInp_tra_flag_volta = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_flag_volta']) && $this->nmgp_cmp_hidden['tra_flag_volta'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_flag_volta" value="<?php echo $this->form_encode_input($this->tra_flag_volta) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_flag_volta" style="<?php echo $sStyleHidden_tra_flag_volta; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_flag_volta_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_flag_volta_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_flag_volta"><?php echo $this->nm_new_label['tra_flag_volta']; ?></span></td></tr><tr><td class="css_tra_flag_volta_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_flag_volta"]) &&  $this->nmgp_cmp_readonly["tra_flag_volta"] == "on") { 

$tra_flag_volta_look = "";
 if ($this->tra_flag_volta == "N") { $tra_flag_volta_look .= "Não" ;} 
 if ($this->tra_flag_volta == "Y") { $tra_flag_volta_look .= "Sim" ;} 
 if (empty($tra_flag_volta_look)) { $tra_flag_volta_look = $this->tra_flag_volta; }
?>
<input type="hidden" name="tra_flag_volta" value="<?php echo $this->form_encode_input($tra_flag_volta) . "\">" . $tra_flag_volta_look . ""; ?>
<?php } else { ?>
<?php

$tra_flag_volta_look = "";
 if ($this->tra_flag_volta == "N") { $tra_flag_volta_look .= "Não" ;} 
 if ($this->tra_flag_volta == "Y") { $tra_flag_volta_look .= "Sim" ;} 
 if (empty($tra_flag_volta_look)) { $tra_flag_volta_look = $this->tra_flag_volta; }
?>
<span id="id_read_on_tra_flag_volta" class="css_tra_flag_volta_line"  style="<?php echo $sStyleReadLab_tra_flag_volta; ?>"><?php echo $this->form_format_readonly("tra_flag_volta", $this->form_encode_input($tra_flag_volta_look)); ?></span><span id="id_read_off_tra_flag_volta" class="css_read_off_tra_flag_volta<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tra_flag_volta; ?>">
 <span id="idAjaxSelect_tra_flag_volta" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tra_flag_volta_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_flag_volta" name="tra_flag_volta" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->tra_flag_volta == "N") { echo " selected" ;} ?><?php  if (empty($this->tra_flag_volta)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_volta'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->tra_flag_volta == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_volta'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_flag_volta_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_flag_volta_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_tra_flag_volta_dumb = ('' == $sStyleHidden_tra_flag_volta) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_tra_flag_volta_dumb" style="<?php echo $sStyleHidden_tra_flag_volta_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_3"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_3" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_3" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock" style="background-color: #CCCC99">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Próprio</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_dt_chegada_proprio']))
    {
        $this->nm_new_label['tra_dt_chegada_proprio'] = "Data Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_dt_chegada_proprio = $this->tra_dt_chegada_proprio;
   $sStyleHidden_tra_dt_chegada_proprio = '';
   if (isset($this->nmgp_cmp_hidden['tra_dt_chegada_proprio']) && $this->nmgp_cmp_hidden['tra_dt_chegada_proprio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_dt_chegada_proprio']);
       $sStyleHidden_tra_dt_chegada_proprio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_dt_chegada_proprio = 'display: none;';
   $sStyleReadInp_tra_dt_chegada_proprio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_dt_chegada_proprio']) && $this->nmgp_cmp_readonly['tra_dt_chegada_proprio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_dt_chegada_proprio']);
       $sStyleReadLab_tra_dt_chegada_proprio = '';
       $sStyleReadInp_tra_dt_chegada_proprio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_dt_chegada_proprio']) && $this->nmgp_cmp_hidden['tra_dt_chegada_proprio'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_dt_chegada_proprio" value="<?php echo $this->form_encode_input($tra_dt_chegada_proprio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_dt_chegada_proprio" style="<?php echo $sStyleHidden_tra_dt_chegada_proprio; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_dt_chegada_proprio_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_dt_chegada_proprio_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_dt_chegada_proprio"><?php echo $this->nm_new_label['tra_dt_chegada_proprio']; ?></span></td></tr><tr><td class="css_tra_dt_chegada_proprio_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_dt_chegada_proprio"]) &&  $this->nmgp_cmp_readonly["tra_dt_chegada_proprio"] == "on") { 

 ?>
<input type="hidden" name="tra_dt_chegada_proprio" value="<?php echo $this->form_encode_input($tra_dt_chegada_proprio) . "\">" . $tra_dt_chegada_proprio . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_dt_chegada_proprio" class="sc-ui-readonly-tra_dt_chegada_proprio css_tra_dt_chegada_proprio_line" style="<?php echo $sStyleReadLab_tra_dt_chegada_proprio; ?>"><?php echo $this->form_format_readonly("tra_dt_chegada_proprio", $this->form_encode_input($tra_dt_chegada_proprio)); ?></span><span id="id_read_off_tra_dt_chegada_proprio" class="css_read_off_tra_dt_chegada_proprio<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_dt_chegada_proprio; ?>"><?php
$tmp_form_data = $this->field_config['tra_dt_chegada_proprio']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_tra_dt_chegada_proprio_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_dt_chegada_proprio" type=text name="tra_dt_chegada_proprio" value="<?php echo $this->form_encode_input($tra_dt_chegada_proprio) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['tra_dt_chegada_proprio']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['tra_dt_chegada_proprio']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_dt_chegada_proprio_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_dt_chegada_proprio_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_hr_chegada_proprio']))
    {
        $this->nm_new_label['tra_hr_chegada_proprio'] = "Hora Chegada:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_hr_chegada_proprio = $this->tra_hr_chegada_proprio;
   $sStyleHidden_tra_hr_chegada_proprio = '';
   if (isset($this->nmgp_cmp_hidden['tra_hr_chegada_proprio']) && $this->nmgp_cmp_hidden['tra_hr_chegada_proprio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_hr_chegada_proprio']);
       $sStyleHidden_tra_hr_chegada_proprio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_hr_chegada_proprio = 'display: none;';
   $sStyleReadInp_tra_hr_chegada_proprio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_hr_chegada_proprio']) && $this->nmgp_cmp_readonly['tra_hr_chegada_proprio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_hr_chegada_proprio']);
       $sStyleReadLab_tra_hr_chegada_proprio = '';
       $sStyleReadInp_tra_hr_chegada_proprio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_hr_chegada_proprio']) && $this->nmgp_cmp_hidden['tra_hr_chegada_proprio'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_hr_chegada_proprio" value="<?php echo $this->form_encode_input($tra_hr_chegada_proprio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_hr_chegada_proprio" style="<?php echo $sStyleHidden_tra_hr_chegada_proprio; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_hr_chegada_proprio_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_hr_chegada_proprio_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_hr_chegada_proprio"><?php echo $this->nm_new_label['tra_hr_chegada_proprio']; ?></span></td></tr><tr><td class="css_tra_hr_chegada_proprio_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_hr_chegada_proprio"]) &&  $this->nmgp_cmp_readonly["tra_hr_chegada_proprio"] == "on") { 

 ?>
<input type="hidden" name="tra_hr_chegada_proprio" value="<?php echo $this->form_encode_input($tra_hr_chegada_proprio) . "\">" . $tra_hr_chegada_proprio . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_hr_chegada_proprio" class="sc-ui-readonly-tra_hr_chegada_proprio css_tra_hr_chegada_proprio_line" style="<?php echo $sStyleReadLab_tra_hr_chegada_proprio; ?>"><?php echo $this->form_format_readonly("tra_hr_chegada_proprio", $this->form_encode_input($tra_hr_chegada_proprio)); ?></span><span id="id_read_off_tra_hr_chegada_proprio" class="css_read_off_tra_hr_chegada_proprio<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_hr_chegada_proprio; ?>"><?php
$tmp_form_data = $this->field_config['tra_hr_chegada_proprio']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_tra_hr_chegada_proprio_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_hr_chegada_proprio" type=text name="tra_hr_chegada_proprio" value="<?php echo $this->form_encode_input($tra_hr_chegada_proprio) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['tra_hr_chegada_proprio']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['tra_hr_chegada_proprio']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_hr_chegada_proprio_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_hr_chegada_proprio_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_flag_proprio']))
   {
       $this->nm_new_label['tra_flag_proprio'] = "Próprio";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_flag_proprio = $this->tra_flag_proprio;
   $sStyleHidden_tra_flag_proprio = '';
   if (isset($this->nmgp_cmp_hidden['tra_flag_proprio']) && $this->nmgp_cmp_hidden['tra_flag_proprio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_flag_proprio']);
       $sStyleHidden_tra_flag_proprio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_flag_proprio = 'display: none;';
   $sStyleReadInp_tra_flag_proprio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_flag_proprio']) && $this->nmgp_cmp_readonly['tra_flag_proprio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_flag_proprio']);
       $sStyleReadLab_tra_flag_proprio = '';
       $sStyleReadInp_tra_flag_proprio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_flag_proprio']) && $this->nmgp_cmp_hidden['tra_flag_proprio'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_flag_proprio" value="<?php echo $this->form_encode_input($this->tra_flag_proprio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_flag_proprio" style="<?php echo $sStyleHidden_tra_flag_proprio; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_flag_proprio_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_flag_proprio_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_flag_proprio"><?php echo $this->nm_new_label['tra_flag_proprio']; ?></span></td></tr><tr><td class="css_tra_flag_proprio_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_flag_proprio"]) &&  $this->nmgp_cmp_readonly["tra_flag_proprio"] == "on") { 

$tra_flag_proprio_look = "";
 if ($this->tra_flag_proprio == "N") { $tra_flag_proprio_look .= "Não" ;} 
 if ($this->tra_flag_proprio == "Y") { $tra_flag_proprio_look .= "Sim" ;} 
 if (empty($tra_flag_proprio_look)) { $tra_flag_proprio_look = $this->tra_flag_proprio; }
?>
<input type="hidden" name="tra_flag_proprio" value="<?php echo $this->form_encode_input($tra_flag_proprio) . "\">" . $tra_flag_proprio_look . ""; ?>
<?php } else { ?>
<?php

$tra_flag_proprio_look = "";
 if ($this->tra_flag_proprio == "N") { $tra_flag_proprio_look .= "Não" ;} 
 if ($this->tra_flag_proprio == "Y") { $tra_flag_proprio_look .= "Sim" ;} 
 if (empty($tra_flag_proprio_look)) { $tra_flag_proprio_look = $this->tra_flag_proprio; }
?>
<span id="id_read_on_tra_flag_proprio" class="css_tra_flag_proprio_line"  style="<?php echo $sStyleReadLab_tra_flag_proprio; ?>"><?php echo $this->form_format_readonly("tra_flag_proprio", $this->form_encode_input($tra_flag_proprio_look)); ?></span><span id="id_read_off_tra_flag_proprio" class="css_read_off_tra_flag_proprio<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tra_flag_proprio; ?>">
 <span id="idAjaxSelect_tra_flag_proprio" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tra_flag_proprio_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_flag_proprio" name="tra_flag_proprio" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->tra_flag_proprio == "N") { echo " selected" ;} ?><?php  if (empty($this->tra_flag_proprio)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_proprio'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->tra_flag_proprio == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_proprio'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_flag_proprio_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_flag_proprio_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_tra_flag_proprio_dumb = ('' == $sStyleHidden_tra_flag_proprio) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_tra_flag_proprio_dumb" style="<?php echo $sStyleHidden_tra_flag_proprio_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_4"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_4" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_4" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock" style="background-color: #CCCC99">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Local</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_dt_ida_local']))
    {
        $this->nm_new_label['tra_dt_ida_local'] = "Data Ida:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_dt_ida_local = $this->tra_dt_ida_local;
   $sStyleHidden_tra_dt_ida_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_dt_ida_local']) && $this->nmgp_cmp_hidden['tra_dt_ida_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_dt_ida_local']);
       $sStyleHidden_tra_dt_ida_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_dt_ida_local = 'display: none;';
   $sStyleReadInp_tra_dt_ida_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_dt_ida_local']) && $this->nmgp_cmp_readonly['tra_dt_ida_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_dt_ida_local']);
       $sStyleReadLab_tra_dt_ida_local = '';
       $sStyleReadInp_tra_dt_ida_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_dt_ida_local']) && $this->nmgp_cmp_hidden['tra_dt_ida_local'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_dt_ida_local" value="<?php echo $this->form_encode_input($tra_dt_ida_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_dt_ida_local" style="<?php echo $sStyleHidden_tra_dt_ida_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_dt_ida_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_dt_ida_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_dt_ida_local"><?php echo $this->nm_new_label['tra_dt_ida_local']; ?></span></td></tr><tr><td class="css_tra_dt_ida_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_dt_ida_local"]) &&  $this->nmgp_cmp_readonly["tra_dt_ida_local"] == "on") { 

 ?>
<input type="hidden" name="tra_dt_ida_local" value="<?php echo $this->form_encode_input($tra_dt_ida_local) . "\">" . $tra_dt_ida_local . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_dt_ida_local" class="sc-ui-readonly-tra_dt_ida_local css_tra_dt_ida_local_line" style="<?php echo $sStyleReadLab_tra_dt_ida_local; ?>"><?php echo $this->form_format_readonly("tra_dt_ida_local", $this->form_encode_input($tra_dt_ida_local)); ?></span><span id="id_read_off_tra_dt_ida_local" class="css_read_off_tra_dt_ida_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_dt_ida_local; ?>"><?php
$tmp_form_data = $this->field_config['tra_dt_ida_local']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_tra_dt_ida_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_dt_ida_local" type=text name="tra_dt_ida_local" value="<?php echo $this->form_encode_input($tra_dt_ida_local) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['tra_dt_ida_local']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['tra_dt_ida_local']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_dt_ida_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_dt_ida_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_hr_ida_local']))
    {
        $this->nm_new_label['tra_hr_ida_local'] = "Hora Ida:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_hr_ida_local = $this->tra_hr_ida_local;
   $sStyleHidden_tra_hr_ida_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_hr_ida_local']) && $this->nmgp_cmp_hidden['tra_hr_ida_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_hr_ida_local']);
       $sStyleHidden_tra_hr_ida_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_hr_ida_local = 'display: none;';
   $sStyleReadInp_tra_hr_ida_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_hr_ida_local']) && $this->nmgp_cmp_readonly['tra_hr_ida_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_hr_ida_local']);
       $sStyleReadLab_tra_hr_ida_local = '';
       $sStyleReadInp_tra_hr_ida_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_hr_ida_local']) && $this->nmgp_cmp_hidden['tra_hr_ida_local'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_hr_ida_local" value="<?php echo $this->form_encode_input($tra_hr_ida_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_hr_ida_local" style="<?php echo $sStyleHidden_tra_hr_ida_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_hr_ida_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_hr_ida_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_hr_ida_local"><?php echo $this->nm_new_label['tra_hr_ida_local']; ?></span></td></tr><tr><td class="css_tra_hr_ida_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_hr_ida_local"]) &&  $this->nmgp_cmp_readonly["tra_hr_ida_local"] == "on") { 

 ?>
<input type="hidden" name="tra_hr_ida_local" value="<?php echo $this->form_encode_input($tra_hr_ida_local) . "\">" . $tra_hr_ida_local . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_hr_ida_local" class="sc-ui-readonly-tra_hr_ida_local css_tra_hr_ida_local_line" style="<?php echo $sStyleReadLab_tra_hr_ida_local; ?>"><?php echo $this->form_format_readonly("tra_hr_ida_local", $this->form_encode_input($tra_hr_ida_local)); ?></span><span id="id_read_off_tra_hr_ida_local" class="css_read_off_tra_hr_ida_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_hr_ida_local; ?>"><?php
$tmp_form_data = $this->field_config['tra_hr_ida_local']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_tra_hr_ida_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_hr_ida_local" type=text name="tra_hr_ida_local" value="<?php echo $this->form_encode_input($tra_hr_ida_local) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['tra_hr_ida_local']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['tra_hr_ida_local']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_hr_ida_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_hr_ida_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_origem_ida_local']))
    {
        $this->nm_new_label['tra_origem_ida_local'] = "Origem Ida: ";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_origem_ida_local = $this->tra_origem_ida_local;
   $sStyleHidden_tra_origem_ida_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_origem_ida_local']) && $this->nmgp_cmp_hidden['tra_origem_ida_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_origem_ida_local']);
       $sStyleHidden_tra_origem_ida_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_origem_ida_local = 'display: none;';
   $sStyleReadInp_tra_origem_ida_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_origem_ida_local']) && $this->nmgp_cmp_readonly['tra_origem_ida_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_origem_ida_local']);
       $sStyleReadLab_tra_origem_ida_local = '';
       $sStyleReadInp_tra_origem_ida_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_origem_ida_local']) && $this->nmgp_cmp_hidden['tra_origem_ida_local'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_origem_ida_local" value="<?php echo $this->form_encode_input($tra_origem_ida_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_origem_ida_local" style="<?php echo $sStyleHidden_tra_origem_ida_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_origem_ida_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_origem_ida_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_origem_ida_local"><?php echo $this->nm_new_label['tra_origem_ida_local']; ?></span></td></tr><tr><td class="css_tra_origem_ida_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_origem_ida_local"]) &&  $this->nmgp_cmp_readonly["tra_origem_ida_local"] == "on") { 

 ?>
<input type="hidden" name="tra_origem_ida_local" value="<?php echo $this->form_encode_input($tra_origem_ida_local) . "\">" . $tra_origem_ida_local . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_origem_ida_local" class="sc-ui-readonly-tra_origem_ida_local css_tra_origem_ida_local_line" style="<?php echo $sStyleReadLab_tra_origem_ida_local; ?>"><?php echo $this->form_format_readonly("tra_origem_ida_local", $this->form_encode_input($this->tra_origem_ida_local)); ?></span><span id="id_read_off_tra_origem_ida_local" class="css_read_off_tra_origem_ida_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_origem_ida_local; ?>">
 <input class="sc-js-input scFormObjectOdd css_tra_origem_ida_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_origem_ida_local" type=text name="tra_origem_ida_local" value="<?php echo $this->form_encode_input($tra_origem_ida_local) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_origem_ida_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_origem_ida_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_destino_ida_local']))
    {
        $this->nm_new_label['tra_destino_ida_local'] = "Destino Ida:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_destino_ida_local = $this->tra_destino_ida_local;
   $sStyleHidden_tra_destino_ida_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_destino_ida_local']) && $this->nmgp_cmp_hidden['tra_destino_ida_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_destino_ida_local']);
       $sStyleHidden_tra_destino_ida_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_destino_ida_local = 'display: none;';
   $sStyleReadInp_tra_destino_ida_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_destino_ida_local']) && $this->nmgp_cmp_readonly['tra_destino_ida_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_destino_ida_local']);
       $sStyleReadLab_tra_destino_ida_local = '';
       $sStyleReadInp_tra_destino_ida_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_destino_ida_local']) && $this->nmgp_cmp_hidden['tra_destino_ida_local'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_destino_ida_local" value="<?php echo $this->form_encode_input($tra_destino_ida_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_destino_ida_local" style="<?php echo $sStyleHidden_tra_destino_ida_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_destino_ida_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_destino_ida_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_destino_ida_local"><?php echo $this->nm_new_label['tra_destino_ida_local']; ?></span></td></tr><tr><td class="css_tra_destino_ida_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_destino_ida_local"]) &&  $this->nmgp_cmp_readonly["tra_destino_ida_local"] == "on") { 

 ?>
<input type="hidden" name="tra_destino_ida_local" value="<?php echo $this->form_encode_input($tra_destino_ida_local) . "\">" . $tra_destino_ida_local . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_destino_ida_local" class="sc-ui-readonly-tra_destino_ida_local css_tra_destino_ida_local_line" style="<?php echo $sStyleReadLab_tra_destino_ida_local; ?>"><?php echo $this->form_format_readonly("tra_destino_ida_local", $this->form_encode_input($this->tra_destino_ida_local)); ?></span><span id="id_read_off_tra_destino_ida_local" class="css_read_off_tra_destino_ida_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_destino_ida_local; ?>">
 <input class="sc-js-input scFormObjectOdd css_tra_destino_ida_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_destino_ida_local" type=text name="tra_destino_ida_local" value="<?php echo $this->form_encode_input($tra_destino_ida_local) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_destino_ida_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_destino_ida_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_flag_ida_local']))
   {
       $this->nm_new_label['tra_flag_ida_local'] = "IDA:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_flag_ida_local = $this->tra_flag_ida_local;
   $sStyleHidden_tra_flag_ida_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_flag_ida_local']) && $this->nmgp_cmp_hidden['tra_flag_ida_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_flag_ida_local']);
       $sStyleHidden_tra_flag_ida_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_flag_ida_local = 'display: none;';
   $sStyleReadInp_tra_flag_ida_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_flag_ida_local']) && $this->nmgp_cmp_readonly['tra_flag_ida_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_flag_ida_local']);
       $sStyleReadLab_tra_flag_ida_local = '';
       $sStyleReadInp_tra_flag_ida_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_flag_ida_local']) && $this->nmgp_cmp_hidden['tra_flag_ida_local'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_flag_ida_local" value="<?php echo $this->form_encode_input($this->tra_flag_ida_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_flag_ida_local" style="<?php echo $sStyleHidden_tra_flag_ida_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_flag_ida_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_flag_ida_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_flag_ida_local"><?php echo $this->nm_new_label['tra_flag_ida_local']; ?></span></td></tr><tr><td class="css_tra_flag_ida_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_flag_ida_local"]) &&  $this->nmgp_cmp_readonly["tra_flag_ida_local"] == "on") { 

$tra_flag_ida_local_look = "";
 if ($this->tra_flag_ida_local == "N") { $tra_flag_ida_local_look .= "Não" ;} 
 if ($this->tra_flag_ida_local == "Y") { $tra_flag_ida_local_look .= "Sim" ;} 
 if (empty($tra_flag_ida_local_look)) { $tra_flag_ida_local_look = $this->tra_flag_ida_local; }
?>
<input type="hidden" name="tra_flag_ida_local" value="<?php echo $this->form_encode_input($tra_flag_ida_local) . "\">" . $tra_flag_ida_local_look . ""; ?>
<?php } else { ?>
<?php

$tra_flag_ida_local_look = "";
 if ($this->tra_flag_ida_local == "N") { $tra_flag_ida_local_look .= "Não" ;} 
 if ($this->tra_flag_ida_local == "Y") { $tra_flag_ida_local_look .= "Sim" ;} 
 if (empty($tra_flag_ida_local_look)) { $tra_flag_ida_local_look = $this->tra_flag_ida_local; }
?>
<span id="id_read_on_tra_flag_ida_local" class="css_tra_flag_ida_local_line"  style="<?php echo $sStyleReadLab_tra_flag_ida_local; ?>"><?php echo $this->form_format_readonly("tra_flag_ida_local", $this->form_encode_input($tra_flag_ida_local_look)); ?></span><span id="id_read_off_tra_flag_ida_local" class="css_read_off_tra_flag_ida_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tra_flag_ida_local; ?>">
 <span id="idAjaxSelect_tra_flag_ida_local" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tra_flag_ida_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_flag_ida_local" name="tra_flag_ida_local" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->tra_flag_ida_local == "N") { echo " selected" ;} ?><?php  if (empty($this->tra_flag_ida_local)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_ida_local'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->tra_flag_ida_local == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_ida_local'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_flag_ida_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_flag_ida_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_dt_volta_local']))
    {
        $this->nm_new_label['tra_dt_volta_local'] = "Data Volta:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_dt_volta_local = $this->tra_dt_volta_local;
   $sStyleHidden_tra_dt_volta_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_dt_volta_local']) && $this->nmgp_cmp_hidden['tra_dt_volta_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_dt_volta_local']);
       $sStyleHidden_tra_dt_volta_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_dt_volta_local = 'display: none;';
   $sStyleReadInp_tra_dt_volta_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_dt_volta_local']) && $this->nmgp_cmp_readonly['tra_dt_volta_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_dt_volta_local']);
       $sStyleReadLab_tra_dt_volta_local = '';
       $sStyleReadInp_tra_dt_volta_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_dt_volta_local']) && $this->nmgp_cmp_hidden['tra_dt_volta_local'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_dt_volta_local" value="<?php echo $this->form_encode_input($tra_dt_volta_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_dt_volta_local" style="<?php echo $sStyleHidden_tra_dt_volta_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_dt_volta_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_dt_volta_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_dt_volta_local"><?php echo $this->nm_new_label['tra_dt_volta_local']; ?></span></td></tr><tr><td class="css_tra_dt_volta_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_dt_volta_local"]) &&  $this->nmgp_cmp_readonly["tra_dt_volta_local"] == "on") { 

 ?>
<input type="hidden" name="tra_dt_volta_local" value="<?php echo $this->form_encode_input($tra_dt_volta_local) . "\">" . $tra_dt_volta_local . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_dt_volta_local" class="sc-ui-readonly-tra_dt_volta_local css_tra_dt_volta_local_line" style="<?php echo $sStyleReadLab_tra_dt_volta_local; ?>"><?php echo $this->form_format_readonly("tra_dt_volta_local", $this->form_encode_input($tra_dt_volta_local)); ?></span><span id="id_read_off_tra_dt_volta_local" class="css_read_off_tra_dt_volta_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_dt_volta_local; ?>"><?php
$tmp_form_data = $this->field_config['tra_dt_volta_local']['date_format'];
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

 <input class="sc-js-input scFormObjectOdd css_tra_dt_volta_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_dt_volta_local" type=text name="tra_dt_volta_local" value="<?php echo $this->form_encode_input($tra_dt_volta_local) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['tra_dt_volta_local']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['tra_dt_volta_local']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_dt_volta_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_dt_volta_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_hr_volta_local']))
    {
        $this->nm_new_label['tra_hr_volta_local'] = "Hora Volta:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_hr_volta_local = $this->tra_hr_volta_local;
   $sStyleHidden_tra_hr_volta_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_hr_volta_local']) && $this->nmgp_cmp_hidden['tra_hr_volta_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_hr_volta_local']);
       $sStyleHidden_tra_hr_volta_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_hr_volta_local = 'display: none;';
   $sStyleReadInp_tra_hr_volta_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_hr_volta_local']) && $this->nmgp_cmp_readonly['tra_hr_volta_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_hr_volta_local']);
       $sStyleReadLab_tra_hr_volta_local = '';
       $sStyleReadInp_tra_hr_volta_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_hr_volta_local']) && $this->nmgp_cmp_hidden['tra_hr_volta_local'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_hr_volta_local" value="<?php echo $this->form_encode_input($tra_hr_volta_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_hr_volta_local" style="<?php echo $sStyleHidden_tra_hr_volta_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_hr_volta_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_hr_volta_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_hr_volta_local"><?php echo $this->nm_new_label['tra_hr_volta_local']; ?></span></td></tr><tr><td class="css_tra_hr_volta_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_hr_volta_local"]) &&  $this->nmgp_cmp_readonly["tra_hr_volta_local"] == "on") { 

 ?>
<input type="hidden" name="tra_hr_volta_local" value="<?php echo $this->form_encode_input($tra_hr_volta_local) . "\">" . $tra_hr_volta_local . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_hr_volta_local" class="sc-ui-readonly-tra_hr_volta_local css_tra_hr_volta_local_line" style="<?php echo $sStyleReadLab_tra_hr_volta_local; ?>"><?php echo $this->form_format_readonly("tra_hr_volta_local", $this->form_encode_input($tra_hr_volta_local)); ?></span><span id="id_read_off_tra_hr_volta_local" class="css_read_off_tra_hr_volta_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_hr_volta_local; ?>"><?php
$tmp_form_data = $this->field_config['tra_hr_volta_local']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_tra_hr_volta_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_hr_volta_local" type=text name="tra_hr_volta_local" value="<?php echo $this->form_encode_input($tra_hr_volta_local) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['tra_hr_volta_local']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['tra_hr_volta_local']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_hr_volta_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_hr_volta_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_origem_volta_local']))
    {
        $this->nm_new_label['tra_origem_volta_local'] = "Origem Volta:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_origem_volta_local = $this->tra_origem_volta_local;
   $sStyleHidden_tra_origem_volta_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_origem_volta_local']) && $this->nmgp_cmp_hidden['tra_origem_volta_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_origem_volta_local']);
       $sStyleHidden_tra_origem_volta_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_origem_volta_local = 'display: none;';
   $sStyleReadInp_tra_origem_volta_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_origem_volta_local']) && $this->nmgp_cmp_readonly['tra_origem_volta_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_origem_volta_local']);
       $sStyleReadLab_tra_origem_volta_local = '';
       $sStyleReadInp_tra_origem_volta_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_origem_volta_local']) && $this->nmgp_cmp_hidden['tra_origem_volta_local'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_origem_volta_local" value="<?php echo $this->form_encode_input($tra_origem_volta_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_origem_volta_local" style="<?php echo $sStyleHidden_tra_origem_volta_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_origem_volta_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_origem_volta_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_origem_volta_local"><?php echo $this->nm_new_label['tra_origem_volta_local']; ?></span></td></tr><tr><td class="css_tra_origem_volta_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_origem_volta_local"]) &&  $this->nmgp_cmp_readonly["tra_origem_volta_local"] == "on") { 

 ?>
<input type="hidden" name="tra_origem_volta_local" value="<?php echo $this->form_encode_input($tra_origem_volta_local) . "\">" . $tra_origem_volta_local . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_origem_volta_local" class="sc-ui-readonly-tra_origem_volta_local css_tra_origem_volta_local_line" style="<?php echo $sStyleReadLab_tra_origem_volta_local; ?>"><?php echo $this->form_format_readonly("tra_origem_volta_local", $this->form_encode_input($this->tra_origem_volta_local)); ?></span><span id="id_read_off_tra_origem_volta_local" class="css_read_off_tra_origem_volta_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_origem_volta_local; ?>">
 <input class="sc-js-input scFormObjectOdd css_tra_origem_volta_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_origem_volta_local" type=text name="tra_origem_volta_local" value="<?php echo $this->form_encode_input($tra_origem_volta_local) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_origem_volta_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_origem_volta_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_destino_volta_local']))
    {
        $this->nm_new_label['tra_destino_volta_local'] = "Destino Volta: ";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_destino_volta_local = $this->tra_destino_volta_local;
   $sStyleHidden_tra_destino_volta_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_destino_volta_local']) && $this->nmgp_cmp_hidden['tra_destino_volta_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_destino_volta_local']);
       $sStyleHidden_tra_destino_volta_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_destino_volta_local = 'display: none;';
   $sStyleReadInp_tra_destino_volta_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_destino_volta_local']) && $this->nmgp_cmp_readonly['tra_destino_volta_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_destino_volta_local']);
       $sStyleReadLab_tra_destino_volta_local = '';
       $sStyleReadInp_tra_destino_volta_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_destino_volta_local']) && $this->nmgp_cmp_hidden['tra_destino_volta_local'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_destino_volta_local" value="<?php echo $this->form_encode_input($tra_destino_volta_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_destino_volta_local" style="<?php echo $sStyleHidden_tra_destino_volta_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_destino_volta_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_destino_volta_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_destino_volta_local"><?php echo $this->nm_new_label['tra_destino_volta_local']; ?></span></td></tr><tr><td class="css_tra_destino_volta_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_destino_volta_local"]) &&  $this->nmgp_cmp_readonly["tra_destino_volta_local"] == "on") { 

 ?>
<input type="hidden" name="tra_destino_volta_local" value="<?php echo $this->form_encode_input($tra_destino_volta_local) . "\">" . $tra_destino_volta_local . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_destino_volta_local" class="sc-ui-readonly-tra_destino_volta_local css_tra_destino_volta_local_line" style="<?php echo $sStyleReadLab_tra_destino_volta_local; ?>"><?php echo $this->form_format_readonly("tra_destino_volta_local", $this->form_encode_input($this->tra_destino_volta_local)); ?></span><span id="id_read_off_tra_destino_volta_local" class="css_read_off_tra_destino_volta_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_destino_volta_local; ?>">
 <input class="sc-js-input scFormObjectOdd css_tra_destino_volta_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_destino_volta_local" type=text name="tra_destino_volta_local" value="<?php echo $this->form_encode_input($tra_destino_volta_local) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_destino_volta_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_destino_volta_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_flag_volta_local']))
   {
       $this->nm_new_label['tra_flag_volta_local'] = "VOLTA:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_flag_volta_local = $this->tra_flag_volta_local;
   $sStyleHidden_tra_flag_volta_local = '';
   if (isset($this->nmgp_cmp_hidden['tra_flag_volta_local']) && $this->nmgp_cmp_hidden['tra_flag_volta_local'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_flag_volta_local']);
       $sStyleHidden_tra_flag_volta_local = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_flag_volta_local = 'display: none;';
   $sStyleReadInp_tra_flag_volta_local = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_flag_volta_local']) && $this->nmgp_cmp_readonly['tra_flag_volta_local'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_flag_volta_local']);
       $sStyleReadLab_tra_flag_volta_local = '';
       $sStyleReadInp_tra_flag_volta_local = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_flag_volta_local']) && $this->nmgp_cmp_hidden['tra_flag_volta_local'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_flag_volta_local" value="<?php echo $this->form_encode_input($this->tra_flag_volta_local) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_flag_volta_local" style="<?php echo $sStyleHidden_tra_flag_volta_local; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_flag_volta_local_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_flag_volta_local_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_flag_volta_local"><?php echo $this->nm_new_label['tra_flag_volta_local']; ?></span></td></tr><tr><td class="css_tra_flag_volta_local_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_flag_volta_local"]) &&  $this->nmgp_cmp_readonly["tra_flag_volta_local"] == "on") { 

$tra_flag_volta_local_look = "";
 if ($this->tra_flag_volta_local == "N") { $tra_flag_volta_local_look .= "Não" ;} 
 if ($this->tra_flag_volta_local == "Y") { $tra_flag_volta_local_look .= "Sim" ;} 
 if (empty($tra_flag_volta_local_look)) { $tra_flag_volta_local_look = $this->tra_flag_volta_local; }
?>
<input type="hidden" name="tra_flag_volta_local" value="<?php echo $this->form_encode_input($tra_flag_volta_local) . "\">" . $tra_flag_volta_local_look . ""; ?>
<?php } else { ?>
<?php

$tra_flag_volta_local_look = "";
 if ($this->tra_flag_volta_local == "N") { $tra_flag_volta_local_look .= "Não" ;} 
 if ($this->tra_flag_volta_local == "Y") { $tra_flag_volta_local_look .= "Sim" ;} 
 if (empty($tra_flag_volta_local_look)) { $tra_flag_volta_local_look = $this->tra_flag_volta_local; }
?>
<span id="id_read_on_tra_flag_volta_local" class="css_tra_flag_volta_local_line"  style="<?php echo $sStyleReadLab_tra_flag_volta_local; ?>"><?php echo $this->form_format_readonly("tra_flag_volta_local", $this->form_encode_input($tra_flag_volta_local_look)); ?></span><span id="id_read_off_tra_flag_volta_local" class="css_read_off_tra_flag_volta_local<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tra_flag_volta_local; ?>">
 <span id="idAjaxSelect_tra_flag_volta_local" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tra_flag_volta_local_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_flag_volta_local" name="tra_flag_volta_local" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="N" <?php  if ($this->tra_flag_volta_local == "N") { echo " selected" ;} ?><?php  if (empty($this->tra_flag_volta_local)) { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_volta_local'][] = 'N'; ?>
 <option  value="Y" <?php  if ($this->tra_flag_volta_local == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_flag_volta_local'][] = 'Y'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_flag_volta_local_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_flag_volta_local_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_tra_flag_volta_local_dumb = ('' == $sStyleHidden_tra_flag_volta_local) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_tra_flag_volta_local_dumb" style="<?php echo $sStyleHidden_tra_flag_volta_local_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_5"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_5" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_5" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="20" class="scFormBlock" style="background-color: #CCCC99">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont">Status Registro / Obs-Aéreo</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_observacao']))
    {
        $this->nm_new_label['tra_observacao'] = "Observações:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_observacao = $this->tra_observacao;
   $sStyleHidden_tra_observacao = '';
   if (isset($this->nmgp_cmp_hidden['tra_observacao']) && $this->nmgp_cmp_hidden['tra_observacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_observacao']);
       $sStyleHidden_tra_observacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_observacao = 'display: none;';
   $sStyleReadInp_tra_observacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_observacao']) && $this->nmgp_cmp_readonly['tra_observacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_observacao']);
       $sStyleReadLab_tra_observacao = '';
       $sStyleReadInp_tra_observacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_observacao']) && $this->nmgp_cmp_hidden['tra_observacao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_observacao" value="<?php echo $this->form_encode_input($tra_observacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_observacao" style="<?php echo $sStyleHidden_tra_observacao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_observacao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_observacao_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_observacao"><?php echo $this->nm_new_label['tra_observacao']; ?></span></td></tr><tr><td class="css_tra_observacao_line" style="padding: 0px; width: 100%;">
<?php
$tra_observacao_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($tra_observacao));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_observacao"]) &&  $this->nmgp_cmp_readonly["tra_observacao"] == "on") { 

 ?>
<input type="hidden" name="tra_observacao" value="<?php echo $this->form_encode_input($tra_observacao) . "\">" . $tra_observacao_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_tra_observacao" class="sc-ui-readonly-tra_observacao css_tra_observacao_line" style="<?php echo $sStyleReadLab_tra_observacao; ?>"><?php echo $this->form_format_readonly("tra_observacao", $this->form_encode_input($tra_observacao_val)); ?></span><span id="id_read_off_tra_observacao" class="css_read_off_tra_observacao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_tra_observacao; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_tra_observacao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="tra_observacao" id="id_sc_field_tra_observacao" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $tra_observacao; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_observacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_observacao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['tra_ativo']))
   {
       $this->nm_new_label['tra_ativo'] = "Registro Ativo:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tra_ativo = $this->tra_ativo;
   $sStyleHidden_tra_ativo = '';
   if (isset($this->nmgp_cmp_hidden['tra_ativo']) && $this->nmgp_cmp_hidden['tra_ativo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_ativo']);
       $sStyleHidden_tra_ativo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_ativo = 'display: none;';
   $sStyleReadInp_tra_ativo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_ativo']) && $this->nmgp_cmp_readonly['tra_ativo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_ativo']);
       $sStyleReadLab_tra_ativo = '';
       $sStyleReadInp_tra_ativo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_ativo']) && $this->nmgp_cmp_hidden['tra_ativo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="tra_ativo" value="<?php echo $this->form_encode_input($this->tra_ativo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_ativo" style="<?php echo $sStyleHidden_tra_ativo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_ativo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_ativo_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_ativo"><?php echo $this->nm_new_label['tra_ativo']; ?></span></td></tr><tr><td class="css_tra_ativo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["tra_ativo"]) &&  $this->nmgp_cmp_readonly["tra_ativo"] == "on") { 

$tra_ativo_look = "";
 if ($this->tra_ativo == "Y") { $tra_ativo_look .= "Ativo" ;} 
 if ($this->tra_ativo == "N") { $tra_ativo_look .= "Inativo" ;} 
 if (empty($tra_ativo_look)) { $tra_ativo_look = $this->tra_ativo; }
?>
<input type="hidden" name="tra_ativo" value="<?php echo $this->form_encode_input($tra_ativo) . "\">" . $tra_ativo_look . ""; ?>
<?php } else { ?>
<?php

$tra_ativo_look = "";
 if ($this->tra_ativo == "Y") { $tra_ativo_look .= "Ativo" ;} 
 if ($this->tra_ativo == "N") { $tra_ativo_look .= "Inativo" ;} 
 if (empty($tra_ativo_look)) { $tra_ativo_look = $this->tra_ativo; }
?>
<span id="id_read_on_tra_ativo" class="css_tra_ativo_line"  style="<?php echo $sStyleReadLab_tra_ativo; ?>"><?php echo $this->form_format_readonly("tra_ativo", $this->form_encode_input($tra_ativo_look)); ?></span><span id="id_read_off_tra_ativo" class="css_read_off_tra_ativo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_tra_ativo; ?>">
 <span id="idAjaxSelect_tra_ativo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_tra_ativo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_tra_ativo" name="tra_ativo" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="Y" <?php  if ($this->tra_ativo == "Y") { echo " selected" ;} ?><?php  if (empty($this->tra_ativo)) { echo " selected" ;} ?>>Ativo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_ativo'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->tra_ativo == "N") { echo " selected" ;} ?>>Inativo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['Lookup_tra_ativo'][] = 'N'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_ativo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_ativo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tra_dt_alteracao']))
    {
        $this->nm_new_label['tra_dt_alteracao'] = "Alterado em:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $old_dt_tra_dt_alteracao = $this->tra_dt_alteracao;
   if (strlen($this->tra_dt_alteracao_hora) > 8 ) {$this->tra_dt_alteracao_hora = substr($this->tra_dt_alteracao_hora, 0, 8);}
   $this->tra_dt_alteracao .= ' ' . $this->tra_dt_alteracao_hora;
   $this->tra_dt_alteracao  = trim($this->tra_dt_alteracao);
   $tra_dt_alteracao = $this->tra_dt_alteracao;
   $sStyleHidden_tra_dt_alteracao = '';
   if (isset($this->nmgp_cmp_hidden['tra_dt_alteracao']) && $this->nmgp_cmp_hidden['tra_dt_alteracao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tra_dt_alteracao']);
       $sStyleHidden_tra_dt_alteracao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tra_dt_alteracao = 'display: none;';
   $sStyleReadInp_tra_dt_alteracao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tra_dt_alteracao']) && $this->nmgp_cmp_readonly['tra_dt_alteracao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tra_dt_alteracao']);
       $sStyleReadLab_tra_dt_alteracao = '';
       $sStyleReadInp_tra_dt_alteracao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tra_dt_alteracao']) && $this->nmgp_cmp_hidden['tra_dt_alteracao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tra_dt_alteracao" value="<?php echo $this->form_encode_input($tra_dt_alteracao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tra_dt_alteracao" style="<?php echo $sStyleHidden_tra_dt_alteracao; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tra_dt_alteracao_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tra_dt_alteracao_label" style=" padding: 0px; width: 100%;"><span id="id_label_tra_dt_alteracao"><?php echo $this->nm_new_label['tra_dt_alteracao']; ?></span></td></tr><tr><td class="css_tra_dt_alteracao_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tra_dt_alteracao" value="<?php echo $this->form_encode_input($tra_dt_alteracao); ?>"><span id="id_ajax_label_tra_dt_alteracao"><?php echo nl2br($tra_dt_alteracao); ?></span>
<?php
$tmp_form_data = $this->field_config['tra_dt_alteracao']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
&nbsp;<span class="scFormHelpOdd"><?php echo $tmp_form_data; ?></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tra_dt_alteracao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tra_dt_alteracao_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php
   $this->tra_dt_alteracao = $old_dt_tra_dt_alteracao;
?>





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

    <TD class="scFormDataOdd" id="hidden_field_data_cpf_del" style="<?php echo $sStyleHidden_cpf_del; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_cpf_del_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_cpf_del_label" style=" padding: 0px; width: 100%;"><span id="id_label_cpf_del"><?php echo $this->nm_new_label['cpf_del']; ?></span></td></tr><tr><td class="css_cpf_del_line" style="padding: 0px; width: 100%;"><input type="hidden" name="cpf_del" value="<?php echo $this->form_encode_input($cpf_del); ?>"><span id="id_ajax_label_cpf_del"><?php echo nl2br($cpf_del); ?></span>
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






<?php $sStyleHidden_sql_log_dumb = ('' == $sStyleHidden_sql_log) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_sql_log_dumb" style="<?php echo $sStyleHidden_sql_log_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_6"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_6" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_6" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="0" class="scFormBlock" style="background-color: #cef593">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont" style="color: #372dfa">Be Invited - API IN</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
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
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
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
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descricao_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descricao_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




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

    <TD class="scFormDataOdd" id="hidden_field_data_codigo_api" style="<?php echo $sStyleHidden_codigo_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_codigo_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_codigo_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_codigo_api"><?php echo $this->nm_new_label['codigo_api']; ?></span></td></tr><tr><td class="css_codigo_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["codigo_api"]) &&  $this->nmgp_cmp_readonly["codigo_api"] == "on") { 

 ?>
<input type="hidden" name="codigo_api" value="<?php echo $this->form_encode_input($codigo_api) . "\">" . $codigo_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_codigo_api" class="sc-ui-readonly-codigo_api css_codigo_api_line" style="<?php echo $sStyleReadLab_codigo_api; ?>"><?php echo $this->form_format_readonly("codigo_api", $this->form_encode_input($this->codigo_api)); ?></span><span id="id_read_off_codigo_api" class="css_read_off_codigo_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_codigo_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_codigo_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_codigo_api" type=text name="codigo_api" value="<?php echo $this->form_encode_input($codigo_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codigo_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codigo_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
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

    <TD class="scFormDataOdd" id="hidden_field_data_tipo_api" style="<?php echo $sStyleHidden_tipo_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tipo_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tipo_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_tipo_api"><?php echo $this->nm_new_label['tipo_api']; ?></span></td></tr><tr><td class="css_tipo_api_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tipo_api" value="<?php echo $this->form_encode_input($tipo_api); ?>"><span id="id_ajax_label_tipo_api"><?php echo nl2br($tipo_api); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['status_api']))
    {
        $this->nm_new_label['status_api'] = "Status API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $status_api = $this->status_api;
   $sStyleHidden_status_api = '';
   if (isset($this->nmgp_cmp_hidden['status_api']) && $this->nmgp_cmp_hidden['status_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['status_api']);
       $sStyleHidden_status_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_status_api = 'display: none;';
   $sStyleReadInp_status_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['status_api']) && $this->nmgp_cmp_readonly['status_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['status_api']);
       $sStyleReadLab_status_api = '';
       $sStyleReadInp_status_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['status_api']) && $this->nmgp_cmp_hidden['status_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="status_api" value="<?php echo $this->form_encode_input($status_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_status_api" style="<?php echo $sStyleHidden_status_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_status_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_status_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_status_api"><?php echo $this->nm_new_label['status_api']; ?></span></td></tr><tr><td class="css_status_api_line" style="padding: 0px; width: 100%;"><input type="hidden" name="status_api" value="<?php echo $this->form_encode_input($status_api); ?>"><span id="id_ajax_label_status_api"><?php echo nl2br($status_api); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_status_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_status_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
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
        $this->nm_new_label['valido_de_api'] = "Válido de API:";
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
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
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
        $this->nm_new_label['valido_ate_api'] = "Válido até API:";
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
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_valido_ate_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_valido_ate_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['local_de_origem_api']))
    {
        $this->nm_new_label['local_de_origem_api'] = "Local De Origem API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $local_de_origem_api = $this->local_de_origem_api;
   $sStyleHidden_local_de_origem_api = '';
   if (isset($this->nmgp_cmp_hidden['local_de_origem_api']) && $this->nmgp_cmp_hidden['local_de_origem_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['local_de_origem_api']);
       $sStyleHidden_local_de_origem_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_local_de_origem_api = 'display: none;';
   $sStyleReadInp_local_de_origem_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['local_de_origem_api']) && $this->nmgp_cmp_readonly['local_de_origem_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['local_de_origem_api']);
       $sStyleReadLab_local_de_origem_api = '';
       $sStyleReadInp_local_de_origem_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['local_de_origem_api']) && $this->nmgp_cmp_hidden['local_de_origem_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="local_de_origem_api" value="<?php echo $this->form_encode_input($local_de_origem_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_local_de_origem_api" style="<?php echo $sStyleHidden_local_de_origem_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_local_de_origem_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_local_de_origem_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_local_de_origem_api"><?php echo $this->nm_new_label['local_de_origem_api']; ?></span></td></tr><tr><td class="css_local_de_origem_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["local_de_origem_api"]) &&  $this->nmgp_cmp_readonly["local_de_origem_api"] == "on") { 

 ?>
<input type="hidden" name="local_de_origem_api" value="<?php echo $this->form_encode_input($local_de_origem_api) . "\">" . $local_de_origem_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_local_de_origem_api" class="sc-ui-readonly-local_de_origem_api css_local_de_origem_api_line" style="<?php echo $sStyleReadLab_local_de_origem_api; ?>"><?php echo $this->form_format_readonly("local_de_origem_api", $this->form_encode_input($this->local_de_origem_api)); ?></span><span id="id_read_off_local_de_origem_api" class="css_read_off_local_de_origem_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_local_de_origem_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_local_de_origem_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_local_de_origem_api" type=text name="local_de_origem_api" value="<?php echo $this->form_encode_input($local_de_origem_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=110"; } ?> maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_local_de_origem_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_local_de_origem_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['latitude_origem_api']))
    {
        $this->nm_new_label['latitude_origem_api'] = "Latitude Origem API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $latitude_origem_api = $this->latitude_origem_api;
   $sStyleHidden_latitude_origem_api = '';
   if (isset($this->nmgp_cmp_hidden['latitude_origem_api']) && $this->nmgp_cmp_hidden['latitude_origem_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['latitude_origem_api']);
       $sStyleHidden_latitude_origem_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_latitude_origem_api = 'display: none;';
   $sStyleReadInp_latitude_origem_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['latitude_origem_api']) && $this->nmgp_cmp_readonly['latitude_origem_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['latitude_origem_api']);
       $sStyleReadLab_latitude_origem_api = '';
       $sStyleReadInp_latitude_origem_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['latitude_origem_api']) && $this->nmgp_cmp_hidden['latitude_origem_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="latitude_origem_api" value="<?php echo $this->form_encode_input($latitude_origem_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_latitude_origem_api" style="<?php echo $sStyleHidden_latitude_origem_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_latitude_origem_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_latitude_origem_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_latitude_origem_api"><?php echo $this->nm_new_label['latitude_origem_api']; ?></span></td></tr><tr><td class="css_latitude_origem_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["latitude_origem_api"]) &&  $this->nmgp_cmp_readonly["latitude_origem_api"] == "on") { 

 ?>
<input type="hidden" name="latitude_origem_api" value="<?php echo $this->form_encode_input($latitude_origem_api) . "\">" . $latitude_origem_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_latitude_origem_api" class="sc-ui-readonly-latitude_origem_api css_latitude_origem_api_line" style="<?php echo $sStyleReadLab_latitude_origem_api; ?>"><?php echo $this->form_format_readonly("latitude_origem_api", $this->form_encode_input($this->latitude_origem_api)); ?></span><span id="id_read_off_latitude_origem_api" class="css_read_off_latitude_origem_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_latitude_origem_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_latitude_origem_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_latitude_origem_api" type=text name="latitude_origem_api" value="<?php echo $this->form_encode_input($latitude_origem_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_latitude_origem_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_latitude_origem_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['longitude_origem_api']))
    {
        $this->nm_new_label['longitude_origem_api'] = "Longitude Origem API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $longitude_origem_api = $this->longitude_origem_api;
   $sStyleHidden_longitude_origem_api = '';
   if (isset($this->nmgp_cmp_hidden['longitude_origem_api']) && $this->nmgp_cmp_hidden['longitude_origem_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['longitude_origem_api']);
       $sStyleHidden_longitude_origem_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_longitude_origem_api = 'display: none;';
   $sStyleReadInp_longitude_origem_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['longitude_origem_api']) && $this->nmgp_cmp_readonly['longitude_origem_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['longitude_origem_api']);
       $sStyleReadLab_longitude_origem_api = '';
       $sStyleReadInp_longitude_origem_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['longitude_origem_api']) && $this->nmgp_cmp_hidden['longitude_origem_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="longitude_origem_api" value="<?php echo $this->form_encode_input($longitude_origem_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_longitude_origem_api" style="<?php echo $sStyleHidden_longitude_origem_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_longitude_origem_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_longitude_origem_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_longitude_origem_api"><?php echo $this->nm_new_label['longitude_origem_api']; ?></span></td></tr><tr><td class="css_longitude_origem_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["longitude_origem_api"]) &&  $this->nmgp_cmp_readonly["longitude_origem_api"] == "on") { 

 ?>
<input type="hidden" name="longitude_origem_api" value="<?php echo $this->form_encode_input($longitude_origem_api) . "\">" . $longitude_origem_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_longitude_origem_api" class="sc-ui-readonly-longitude_origem_api css_longitude_origem_api_line" style="<?php echo $sStyleReadLab_longitude_origem_api; ?>"><?php echo $this->form_format_readonly("longitude_origem_api", $this->form_encode_input($this->longitude_origem_api)); ?></span><span id="id_read_off_longitude_origem_api" class="css_read_off_longitude_origem_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_longitude_origem_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_longitude_origem_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_longitude_origem_api" type=text name="longitude_origem_api" value="<?php echo $this->form_encode_input($longitude_origem_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_longitude_origem_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_longitude_origem_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hr_saida_origem_api']))
    {
        $this->nm_new_label['hr_saida_origem_api'] = "Hr. Saída Origem API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hr_saida_origem_api = $this->hr_saida_origem_api;
   $sStyleHidden_hr_saida_origem_api = '';
   if (isset($this->nmgp_cmp_hidden['hr_saida_origem_api']) && $this->nmgp_cmp_hidden['hr_saida_origem_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hr_saida_origem_api']);
       $sStyleHidden_hr_saida_origem_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hr_saida_origem_api = 'display: none;';
   $sStyleReadInp_hr_saida_origem_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hr_saida_origem_api']) && $this->nmgp_cmp_readonly['hr_saida_origem_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hr_saida_origem_api']);
       $sStyleReadLab_hr_saida_origem_api = '';
       $sStyleReadInp_hr_saida_origem_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hr_saida_origem_api']) && $this->nmgp_cmp_hidden['hr_saida_origem_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hr_saida_origem_api" value="<?php echo $this->form_encode_input($hr_saida_origem_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_hr_saida_origem_api" style="<?php echo $sStyleHidden_hr_saida_origem_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hr_saida_origem_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_hr_saida_origem_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_hr_saida_origem_api"><?php echo $this->nm_new_label['hr_saida_origem_api']; ?></span></td></tr><tr><td class="css_hr_saida_origem_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hr_saida_origem_api"]) &&  $this->nmgp_cmp_readonly["hr_saida_origem_api"] == "on") { 

 ?>
<input type="hidden" name="hr_saida_origem_api" value="<?php echo $this->form_encode_input($hr_saida_origem_api) . "\">" . $hr_saida_origem_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_hr_saida_origem_api" class="sc-ui-readonly-hr_saida_origem_api css_hr_saida_origem_api_line" style="<?php echo $sStyleReadLab_hr_saida_origem_api; ?>"><?php echo $this->form_format_readonly("hr_saida_origem_api", $this->form_encode_input($this->hr_saida_origem_api)); ?></span><span id="id_read_off_hr_saida_origem_api" class="css_read_off_hr_saida_origem_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hr_saida_origem_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_hr_saida_origem_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hr_saida_origem_api" type=text name="hr_saida_origem_api" value="<?php echo $this->form_encode_input($hr_saida_origem_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=5 alt="{datatype: 'text', maxLength: 5, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hr_saida_origem_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hr_saida_origem_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['local_destino_api']))
    {
        $this->nm_new_label['local_destino_api'] = "Local Destino API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $local_destino_api = $this->local_destino_api;
   $sStyleHidden_local_destino_api = '';
   if (isset($this->nmgp_cmp_hidden['local_destino_api']) && $this->nmgp_cmp_hidden['local_destino_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['local_destino_api']);
       $sStyleHidden_local_destino_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_local_destino_api = 'display: none;';
   $sStyleReadInp_local_destino_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['local_destino_api']) && $this->nmgp_cmp_readonly['local_destino_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['local_destino_api']);
       $sStyleReadLab_local_destino_api = '';
       $sStyleReadInp_local_destino_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['local_destino_api']) && $this->nmgp_cmp_hidden['local_destino_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="local_destino_api" value="<?php echo $this->form_encode_input($local_destino_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_local_destino_api" style="<?php echo $sStyleHidden_local_destino_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_local_destino_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_local_destino_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_local_destino_api"><?php echo $this->nm_new_label['local_destino_api']; ?></span></td></tr><tr><td class="css_local_destino_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["local_destino_api"]) &&  $this->nmgp_cmp_readonly["local_destino_api"] == "on") { 

 ?>
<input type="hidden" name="local_destino_api" value="<?php echo $this->form_encode_input($local_destino_api) . "\">" . $local_destino_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_local_destino_api" class="sc-ui-readonly-local_destino_api css_local_destino_api_line" style="<?php echo $sStyleReadLab_local_destino_api; ?>"><?php echo $this->form_format_readonly("local_destino_api", $this->form_encode_input($this->local_destino_api)); ?></span><span id="id_read_off_local_destino_api" class="css_read_off_local_destino_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_local_destino_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_local_destino_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_local_destino_api" type=text name="local_destino_api" value="<?php echo $this->form_encode_input($local_destino_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=110"; } ?> maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_local_destino_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_local_destino_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['latitude_destino_api']))
    {
        $this->nm_new_label['latitude_destino_api'] = "Latitude Destino API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $latitude_destino_api = $this->latitude_destino_api;
   $sStyleHidden_latitude_destino_api = '';
   if (isset($this->nmgp_cmp_hidden['latitude_destino_api']) && $this->nmgp_cmp_hidden['latitude_destino_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['latitude_destino_api']);
       $sStyleHidden_latitude_destino_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_latitude_destino_api = 'display: none;';
   $sStyleReadInp_latitude_destino_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['latitude_destino_api']) && $this->nmgp_cmp_readonly['latitude_destino_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['latitude_destino_api']);
       $sStyleReadLab_latitude_destino_api = '';
       $sStyleReadInp_latitude_destino_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['latitude_destino_api']) && $this->nmgp_cmp_hidden['latitude_destino_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="latitude_destino_api" value="<?php echo $this->form_encode_input($latitude_destino_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_latitude_destino_api" style="<?php echo $sStyleHidden_latitude_destino_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_latitude_destino_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_latitude_destino_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_latitude_destino_api"><?php echo $this->nm_new_label['latitude_destino_api']; ?></span></td></tr><tr><td class="css_latitude_destino_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["latitude_destino_api"]) &&  $this->nmgp_cmp_readonly["latitude_destino_api"] == "on") { 

 ?>
<input type="hidden" name="latitude_destino_api" value="<?php echo $this->form_encode_input($latitude_destino_api) . "\">" . $latitude_destino_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_latitude_destino_api" class="sc-ui-readonly-latitude_destino_api css_latitude_destino_api_line" style="<?php echo $sStyleReadLab_latitude_destino_api; ?>"><?php echo $this->form_format_readonly("latitude_destino_api", $this->form_encode_input($this->latitude_destino_api)); ?></span><span id="id_read_off_latitude_destino_api" class="css_read_off_latitude_destino_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_latitude_destino_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_latitude_destino_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_latitude_destino_api" type=text name="latitude_destino_api" value="<?php echo $this->form_encode_input($latitude_destino_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_latitude_destino_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_latitude_destino_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['longitude_destino_api']))
    {
        $this->nm_new_label['longitude_destino_api'] = "Longitude Destino API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $longitude_destino_api = $this->longitude_destino_api;
   $sStyleHidden_longitude_destino_api = '';
   if (isset($this->nmgp_cmp_hidden['longitude_destino_api']) && $this->nmgp_cmp_hidden['longitude_destino_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['longitude_destino_api']);
       $sStyleHidden_longitude_destino_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_longitude_destino_api = 'display: none;';
   $sStyleReadInp_longitude_destino_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['longitude_destino_api']) && $this->nmgp_cmp_readonly['longitude_destino_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['longitude_destino_api']);
       $sStyleReadLab_longitude_destino_api = '';
       $sStyleReadInp_longitude_destino_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['longitude_destino_api']) && $this->nmgp_cmp_hidden['longitude_destino_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="longitude_destino_api" value="<?php echo $this->form_encode_input($longitude_destino_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_longitude_destino_api" style="<?php echo $sStyleHidden_longitude_destino_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_longitude_destino_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_longitude_destino_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_longitude_destino_api"><?php echo $this->nm_new_label['longitude_destino_api']; ?></span></td></tr><tr><td class="css_longitude_destino_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["longitude_destino_api"]) &&  $this->nmgp_cmp_readonly["longitude_destino_api"] == "on") { 

 ?>
<input type="hidden" name="longitude_destino_api" value="<?php echo $this->form_encode_input($longitude_destino_api) . "\">" . $longitude_destino_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_longitude_destino_api" class="sc-ui-readonly-longitude_destino_api css_longitude_destino_api_line" style="<?php echo $sStyleReadLab_longitude_destino_api; ?>"><?php echo $this->form_format_readonly("longitude_destino_api", $this->form_encode_input($this->longitude_destino_api)); ?></span><span id="id_read_off_longitude_destino_api" class="css_read_off_longitude_destino_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_longitude_destino_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_longitude_destino_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_longitude_destino_api" type=text name="longitude_destino_api" value="<?php echo $this->form_encode_input($longitude_destino_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_longitude_destino_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_longitude_destino_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['veiculo_api']))
    {
        $this->nm_new_label['veiculo_api'] = "Veículo API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $veiculo_api = $this->veiculo_api;
   $sStyleHidden_veiculo_api = '';
   if (isset($this->nmgp_cmp_hidden['veiculo_api']) && $this->nmgp_cmp_hidden['veiculo_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['veiculo_api']);
       $sStyleHidden_veiculo_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_veiculo_api = 'display: none;';
   $sStyleReadInp_veiculo_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['veiculo_api']) && $this->nmgp_cmp_readonly['veiculo_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['veiculo_api']);
       $sStyleReadLab_veiculo_api = '';
       $sStyleReadInp_veiculo_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['veiculo_api']) && $this->nmgp_cmp_hidden['veiculo_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="veiculo_api" value="<?php echo $this->form_encode_input($veiculo_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_veiculo_api" style="<?php echo $sStyleHidden_veiculo_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_veiculo_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_veiculo_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_veiculo_api"><?php echo $this->nm_new_label['veiculo_api']; ?></span></td></tr><tr><td class="css_veiculo_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["veiculo_api"]) &&  $this->nmgp_cmp_readonly["veiculo_api"] == "on") { 

 ?>
<input type="hidden" name="veiculo_api" value="<?php echo $this->form_encode_input($veiculo_api) . "\">" . $veiculo_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_veiculo_api" class="sc-ui-readonly-veiculo_api css_veiculo_api_line" style="<?php echo $sStyleReadLab_veiculo_api; ?>"><?php echo $this->form_format_readonly("veiculo_api", $this->form_encode_input($this->veiculo_api)); ?></span><span id="id_read_off_veiculo_api" class="css_read_off_veiculo_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_veiculo_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_veiculo_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_veiculo_api" type=text name="veiculo_api" value="<?php echo $this->form_encode_input($veiculo_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=35"; } ?> maxlength=35 alt="{datatype: 'text', maxLength: 35, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_veiculo_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_veiculo_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['companhia_api']))
    {
        $this->nm_new_label['companhia_api'] = "Companhia API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $companhia_api = $this->companhia_api;
   $sStyleHidden_companhia_api = '';
   if (isset($this->nmgp_cmp_hidden['companhia_api']) && $this->nmgp_cmp_hidden['companhia_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['companhia_api']);
       $sStyleHidden_companhia_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_companhia_api = 'display: none;';
   $sStyleReadInp_companhia_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['companhia_api']) && $this->nmgp_cmp_readonly['companhia_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['companhia_api']);
       $sStyleReadLab_companhia_api = '';
       $sStyleReadInp_companhia_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['companhia_api']) && $this->nmgp_cmp_hidden['companhia_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="companhia_api" value="<?php echo $this->form_encode_input($companhia_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_companhia_api" style="<?php echo $sStyleHidden_companhia_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_companhia_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_companhia_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_companhia_api"><?php echo $this->nm_new_label['companhia_api']; ?></span></td></tr><tr><td class="css_companhia_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["companhia_api"]) &&  $this->nmgp_cmp_readonly["companhia_api"] == "on") { 

 ?>
<input type="hidden" name="companhia_api" value="<?php echo $this->form_encode_input($companhia_api) . "\">" . $companhia_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_companhia_api" class="sc-ui-readonly-companhia_api css_companhia_api_line" style="<?php echo $sStyleReadLab_companhia_api; ?>"><?php echo $this->form_format_readonly("companhia_api", $this->form_encode_input($this->companhia_api)); ?></span><span id="id_read_off_companhia_api" class="css_read_off_companhia_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_companhia_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_companhia_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_companhia_api" type=text name="companhia_api" value="<?php echo $this->form_encode_input($companhia_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=35"; } ?> maxlength=35 alt="{datatype: 'text', maxLength: 35, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_companhia_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_companhia_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nome_motorista_api']))
    {
        $this->nm_new_label['nome_motorista_api'] = "Nome Motorista API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nome_motorista_api = $this->nome_motorista_api;
   $sStyleHidden_nome_motorista_api = '';
   if (isset($this->nmgp_cmp_hidden['nome_motorista_api']) && $this->nmgp_cmp_hidden['nome_motorista_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nome_motorista_api']);
       $sStyleHidden_nome_motorista_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nome_motorista_api = 'display: none;';
   $sStyleReadInp_nome_motorista_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nome_motorista_api']) && $this->nmgp_cmp_readonly['nome_motorista_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nome_motorista_api']);
       $sStyleReadLab_nome_motorista_api = '';
       $sStyleReadInp_nome_motorista_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nome_motorista_api']) && $this->nmgp_cmp_hidden['nome_motorista_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nome_motorista_api" value="<?php echo $this->form_encode_input($nome_motorista_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_nome_motorista_api" style="<?php echo $sStyleHidden_nome_motorista_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nome_motorista_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_nome_motorista_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_nome_motorista_api"><?php echo $this->nm_new_label['nome_motorista_api']; ?></span></td></tr><tr><td class="css_nome_motorista_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nome_motorista_api"]) &&  $this->nmgp_cmp_readonly["nome_motorista_api"] == "on") { 

 ?>
<input type="hidden" name="nome_motorista_api" value="<?php echo $this->form_encode_input($nome_motorista_api) . "\">" . $nome_motorista_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_nome_motorista_api" class="sc-ui-readonly-nome_motorista_api css_nome_motorista_api_line" style="<?php echo $sStyleReadLab_nome_motorista_api; ?>"><?php echo $this->form_format_readonly("nome_motorista_api", $this->form_encode_input($this->nome_motorista_api)); ?></span><span id="id_read_off_nome_motorista_api" class="css_read_off_nome_motorista_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nome_motorista_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_nome_motorista_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nome_motorista_api" type=text name="nome_motorista_api" value="<?php echo $this->form_encode_input($nome_motorista_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=35"; } ?> maxlength=35 alt="{datatype: 'text', maxLength: 35, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_motorista_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_motorista_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['contato_motorista_api']))
    {
        $this->nm_new_label['contato_motorista_api'] = "Contato Motorista APP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $contato_motorista_api = $this->contato_motorista_api;
   $sStyleHidden_contato_motorista_api = '';
   if (isset($this->nmgp_cmp_hidden['contato_motorista_api']) && $this->nmgp_cmp_hidden['contato_motorista_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['contato_motorista_api']);
       $sStyleHidden_contato_motorista_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_contato_motorista_api = 'display: none;';
   $sStyleReadInp_contato_motorista_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['contato_motorista_api']) && $this->nmgp_cmp_readonly['contato_motorista_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['contato_motorista_api']);
       $sStyleReadLab_contato_motorista_api = '';
       $sStyleReadInp_contato_motorista_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['contato_motorista_api']) && $this->nmgp_cmp_hidden['contato_motorista_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="contato_motorista_api" value="<?php echo $this->form_encode_input($contato_motorista_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_contato_motorista_api" style="<?php echo $sStyleHidden_contato_motorista_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_contato_motorista_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_contato_motorista_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_contato_motorista_api"><?php echo $this->nm_new_label['contato_motorista_api']; ?></span></td></tr><tr><td class="css_contato_motorista_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["contato_motorista_api"]) &&  $this->nmgp_cmp_readonly["contato_motorista_api"] == "on") { 

 ?>
<input type="hidden" name="contato_motorista_api" value="<?php echo $this->form_encode_input($contato_motorista_api) . "\">" . $contato_motorista_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_contato_motorista_api" class="sc-ui-readonly-contato_motorista_api css_contato_motorista_api_line" style="<?php echo $sStyleReadLab_contato_motorista_api; ?>"><?php echo $this->form_format_readonly("contato_motorista_api", $this->form_encode_input($this->contato_motorista_api)); ?></span><span id="id_read_off_contato_motorista_api" class="css_read_off_contato_motorista_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_contato_motorista_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_contato_motorista_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_contato_motorista_api" type=text name="contato_motorista_api" value="<?php echo $this->form_encode_input($contato_motorista_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=38 alt="{datatype: 'mask', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '+99 (99)99999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_contato_motorista_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_contato_motorista_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['matricula_api']))
    {
        $this->nm_new_label['matricula_api'] = "Matrícula API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $matricula_api = $this->matricula_api;
   $sStyleHidden_matricula_api = '';
   if (isset($this->nmgp_cmp_hidden['matricula_api']) && $this->nmgp_cmp_hidden['matricula_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['matricula_api']);
       $sStyleHidden_matricula_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_matricula_api = 'display: none;';
   $sStyleReadInp_matricula_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['matricula_api']) && $this->nmgp_cmp_readonly['matricula_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['matricula_api']);
       $sStyleReadLab_matricula_api = '';
       $sStyleReadInp_matricula_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['matricula_api']) && $this->nmgp_cmp_hidden['matricula_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="matricula_api" value="<?php echo $this->form_encode_input($matricula_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_matricula_api" style="<?php echo $sStyleHidden_matricula_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_matricula_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_matricula_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_matricula_api"><?php echo $this->nm_new_label['matricula_api']; ?></span></td></tr><tr><td class="css_matricula_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["matricula_api"]) &&  $this->nmgp_cmp_readonly["matricula_api"] == "on") { 

 ?>
<input type="hidden" name="matricula_api" value="<?php echo $this->form_encode_input($matricula_api) . "\">" . $matricula_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_matricula_api" class="sc-ui-readonly-matricula_api css_matricula_api_line" style="<?php echo $sStyleReadLab_matricula_api; ?>"><?php echo $this->form_format_readonly("matricula_api", $this->form_encode_input($this->matricula_api)); ?></span><span id="id_read_off_matricula_api" class="css_read_off_matricula_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_matricula_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_matricula_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_matricula_api" type=text name="matricula_api" value="<?php echo $this->form_encode_input($matricula_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_matricula_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_matricula_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['duracao_percurso_api']))
    {
        $this->nm_new_label['duracao_percurso_api'] = "Duração do Percurso API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $duracao_percurso_api = $this->duracao_percurso_api;
   $sStyleHidden_duracao_percurso_api = '';
   if (isset($this->nmgp_cmp_hidden['duracao_percurso_api']) && $this->nmgp_cmp_hidden['duracao_percurso_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['duracao_percurso_api']);
       $sStyleHidden_duracao_percurso_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_duracao_percurso_api = 'display: none;';
   $sStyleReadInp_duracao_percurso_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['duracao_percurso_api']) && $this->nmgp_cmp_readonly['duracao_percurso_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['duracao_percurso_api']);
       $sStyleReadLab_duracao_percurso_api = '';
       $sStyleReadInp_duracao_percurso_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['duracao_percurso_api']) && $this->nmgp_cmp_hidden['duracao_percurso_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="duracao_percurso_api" value="<?php echo $this->form_encode_input($duracao_percurso_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_duracao_percurso_api" style="<?php echo $sStyleHidden_duracao_percurso_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_duracao_percurso_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_duracao_percurso_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_duracao_percurso_api"><?php echo $this->nm_new_label['duracao_percurso_api']; ?></span></td></tr><tr><td class="css_duracao_percurso_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["duracao_percurso_api"]) &&  $this->nmgp_cmp_readonly["duracao_percurso_api"] == "on") { 

 ?>
<input type="hidden" name="duracao_percurso_api" value="<?php echo $this->form_encode_input($duracao_percurso_api) . "\">" . $duracao_percurso_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_duracao_percurso_api" class="sc-ui-readonly-duracao_percurso_api css_duracao_percurso_api_line" style="<?php echo $sStyleReadLab_duracao_percurso_api; ?>"><?php echo $this->form_format_readonly("duracao_percurso_api", $this->form_encode_input($this->duracao_percurso_api)); ?></span><span id="id_read_off_duracao_percurso_api" class="css_read_off_duracao_percurso_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_duracao_percurso_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_duracao_percurso_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_duracao_percurso_api" type=text name="duracao_percurso_api" value="<?php echo $this->form_encode_input($duracao_percurso_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_duracao_percurso_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_duracao_percurso_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




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

    <TD class="scFormDataOdd" id="hidden_field_data_comodidades_api" style="<?php echo $sStyleHidden_comodidades_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_comodidades_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_comodidades_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_comodidades_api"><?php echo $this->nm_new_label['comodidades_api']; ?></span></td></tr><tr><td class="css_comodidades_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["comodidades_api"]) &&  $this->nmgp_cmp_readonly["comodidades_api"] == "on") { 

 ?>
<input type="hidden" name="comodidades_api" value="<?php echo $this->form_encode_input($comodidades_api) . "\">" . $comodidades_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_comodidades_api" class="sc-ui-readonly-comodidades_api css_comodidades_api_line" style="<?php echo $sStyleReadLab_comodidades_api; ?>"><?php echo $this->form_format_readonly("comodidades_api", $this->form_encode_input($this->comodidades_api)); ?></span><span id="id_read_off_comodidades_api" class="css_read_off_comodidades_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_comodidades_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_comodidades_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_comodidades_api" type=text name="comodidades_api" value="<?php echo $this->form_encode_input($comodidades_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_comodidades_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_comodidades_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['observacao_api']))
    {
        $this->nm_new_label['observacao_api'] = "Observação API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $observacao_api = $this->observacao_api;
   $sStyleHidden_observacao_api = '';
   if (isset($this->nmgp_cmp_hidden['observacao_api']) && $this->nmgp_cmp_hidden['observacao_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['observacao_api']);
       $sStyleHidden_observacao_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_observacao_api = 'display: none;';
   $sStyleReadInp_observacao_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['observacao_api']) && $this->nmgp_cmp_readonly['observacao_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['observacao_api']);
       $sStyleReadLab_observacao_api = '';
       $sStyleReadInp_observacao_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['observacao_api']) && $this->nmgp_cmp_hidden['observacao_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="observacao_api" value="<?php echo $this->form_encode_input($observacao_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_observacao_api" style="<?php echo $sStyleHidden_observacao_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_observacao_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_observacao_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_observacao_api"><?php echo $this->nm_new_label['observacao_api']; ?></span></td></tr><tr><td class="css_observacao_api_line" style="padding: 0px; width: 100%;">
<?php
$observacao_api_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($observacao_api));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["observacao_api"]) &&  $this->nmgp_cmp_readonly["observacao_api"] == "on") { 

 ?>
<input type="hidden" name="observacao_api" value="<?php echo $this->form_encode_input($observacao_api) . "\">" . $observacao_api_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_observacao_api" class="sc-ui-readonly-observacao_api css_observacao_api_line" style="<?php echo $sStyleReadLab_observacao_api; ?>"><?php echo $this->form_format_readonly("observacao_api", $this->form_encode_input($observacao_api_val)); ?></span><span id="id_read_off_observacao_api" class="css_read_off_observacao_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observacao_api; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_observacao_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="observacao_api" id="id_sc_field_observacao_api" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $observacao_api; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_observacao_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_observacao_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['placa_veiculo_api']))
    {
        $this->nm_new_label['placa_veiculo_api'] = "Placa Veículo API:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $placa_veiculo_api = $this->placa_veiculo_api;
   $sStyleHidden_placa_veiculo_api = '';
   if (isset($this->nmgp_cmp_hidden['placa_veiculo_api']) && $this->nmgp_cmp_hidden['placa_veiculo_api'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['placa_veiculo_api']);
       $sStyleHidden_placa_veiculo_api = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_placa_veiculo_api = 'display: none;';
   $sStyleReadInp_placa_veiculo_api = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['placa_veiculo_api']) && $this->nmgp_cmp_readonly['placa_veiculo_api'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['placa_veiculo_api']);
       $sStyleReadLab_placa_veiculo_api = '';
       $sStyleReadInp_placa_veiculo_api = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['placa_veiculo_api']) && $this->nmgp_cmp_hidden['placa_veiculo_api'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="placa_veiculo_api" value="<?php echo $this->form_encode_input($placa_veiculo_api) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_placa_veiculo_api" style="<?php echo $sStyleHidden_placa_veiculo_api; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_placa_veiculo_api_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_placa_veiculo_api_label" style=" padding: 0px; width: 100%;"><span id="id_label_placa_veiculo_api"><?php echo $this->nm_new_label['placa_veiculo_api']; ?></span></td></tr><tr><td class="css_placa_veiculo_api_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["placa_veiculo_api"]) &&  $this->nmgp_cmp_readonly["placa_veiculo_api"] == "on") { 

 ?>
<input type="hidden" name="placa_veiculo_api" value="<?php echo $this->form_encode_input($placa_veiculo_api) . "\">" . $placa_veiculo_api . ""; ?>
<?php } else { ?>
<span id="id_read_on_placa_veiculo_api" class="sc-ui-readonly-placa_veiculo_api css_placa_veiculo_api_line" style="<?php echo $sStyleReadLab_placa_veiculo_api; ?>"><?php echo $this->form_format_readonly("placa_veiculo_api", $this->form_encode_input($this->placa_veiculo_api)); ?></span><span id="id_read_off_placa_veiculo_api" class="css_read_off_placa_veiculo_api<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_placa_veiculo_api; ?>">
 <input class="sc-js-input scFormObjectOdd css_placa_veiculo_api_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_placa_veiculo_api" type=text name="placa_veiculo_api" value="<?php echo $this->form_encode_input($placa_veiculo_api) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_placa_veiculo_api_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_placa_veiculo_api_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
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
        $this->nm_new_label['id_evento_app'] = "Id Evento App:";
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
        $this->nm_new_label['id_participante_app'] = "Id Participante App:";
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
        $this->nm_new_label['id_voucher_app'] = "Id Voucher App:";
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
   <a name="bloco_7"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_7" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_7" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;">   <tr>


    <TD colspan="1" height="0" class="scFormBlock" style="background-color: #4be3e3">
     <TABLE style="padding: 0px; spacing: 0px; border-width: 0px;" width="100%" height="100%">
      <TR>
       <TD align="" valign="" class="scFormBlockFont" style="color: #372dfa">Be Invited - API OUT</TD>
       
      </TR>
     </TABLE>
    </TD>




   </tr>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['titulo_api_out']))
    {
        $this->nm_new_label['titulo_api_out'] = "Título API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $titulo_api_out = $this->titulo_api_out;
   $sStyleHidden_titulo_api_out = '';
   if (isset($this->nmgp_cmp_hidden['titulo_api_out']) && $this->nmgp_cmp_hidden['titulo_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['titulo_api_out']);
       $sStyleHidden_titulo_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_titulo_api_out = 'display: none;';
   $sStyleReadInp_titulo_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['titulo_api_out']) && $this->nmgp_cmp_readonly['titulo_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['titulo_api_out']);
       $sStyleReadLab_titulo_api_out = '';
       $sStyleReadInp_titulo_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['titulo_api_out']) && $this->nmgp_cmp_hidden['titulo_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="titulo_api_out" value="<?php echo $this->form_encode_input($titulo_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_titulo_api_out" style="<?php echo $sStyleHidden_titulo_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_titulo_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_titulo_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_titulo_api_out"><?php echo $this->nm_new_label['titulo_api_out']; ?></span></td></tr><tr><td class="css_titulo_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["titulo_api_out"]) &&  $this->nmgp_cmp_readonly["titulo_api_out"] == "on") { 

 ?>
<input type="hidden" name="titulo_api_out" value="<?php echo $this->form_encode_input($titulo_api_out) . "\">" . $titulo_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_titulo_api_out" class="sc-ui-readonly-titulo_api_out css_titulo_api_out_line" style="<?php echo $sStyleReadLab_titulo_api_out; ?>"><?php echo $this->form_format_readonly("titulo_api_out", $this->form_encode_input($this->titulo_api_out)); ?></span><span id="id_read_off_titulo_api_out" class="css_read_off_titulo_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_titulo_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_titulo_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_titulo_api_out" type=text name="titulo_api_out" value="<?php echo $this->form_encode_input($titulo_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_titulo_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_titulo_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['descricao_api_out']))
    {
        $this->nm_new_label['descricao_api_out'] = "Descrição API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $descricao_api_out = $this->descricao_api_out;
   $sStyleHidden_descricao_api_out = '';
   if (isset($this->nmgp_cmp_hidden['descricao_api_out']) && $this->nmgp_cmp_hidden['descricao_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['descricao_api_out']);
       $sStyleHidden_descricao_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_descricao_api_out = 'display: none;';
   $sStyleReadInp_descricao_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['descricao_api_out']) && $this->nmgp_cmp_readonly['descricao_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['descricao_api_out']);
       $sStyleReadLab_descricao_api_out = '';
       $sStyleReadInp_descricao_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['descricao_api_out']) && $this->nmgp_cmp_hidden['descricao_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="descricao_api_out" value="<?php echo $this->form_encode_input($descricao_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_descricao_api_out" style="<?php echo $sStyleHidden_descricao_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_descricao_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_descricao_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_descricao_api_out"><?php echo $this->nm_new_label['descricao_api_out']; ?></span></td></tr><tr><td class="css_descricao_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["descricao_api_out"]) &&  $this->nmgp_cmp_readonly["descricao_api_out"] == "on") { 

 ?>
<input type="hidden" name="descricao_api_out" value="<?php echo $this->form_encode_input($descricao_api_out) . "\">" . $descricao_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_descricao_api_out" class="sc-ui-readonly-descricao_api_out css_descricao_api_out_line" style="<?php echo $sStyleReadLab_descricao_api_out; ?>"><?php echo $this->form_format_readonly("descricao_api_out", $this->form_encode_input($this->descricao_api_out)); ?></span><span id="id_read_off_descricao_api_out" class="css_read_off_descricao_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_descricao_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_descricao_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_descricao_api_out" type=text name="descricao_api_out" value="<?php echo $this->form_encode_input($descricao_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_descricao_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_descricao_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['codigo_api_out']))
    {
        $this->nm_new_label['codigo_api_out'] = "Código API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $codigo_api_out = $this->codigo_api_out;
   $sStyleHidden_codigo_api_out = '';
   if (isset($this->nmgp_cmp_hidden['codigo_api_out']) && $this->nmgp_cmp_hidden['codigo_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['codigo_api_out']);
       $sStyleHidden_codigo_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_codigo_api_out = 'display: none;';
   $sStyleReadInp_codigo_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['codigo_api_out']) && $this->nmgp_cmp_readonly['codigo_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['codigo_api_out']);
       $sStyleReadLab_codigo_api_out = '';
       $sStyleReadInp_codigo_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['codigo_api_out']) && $this->nmgp_cmp_hidden['codigo_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="codigo_api_out" value="<?php echo $this->form_encode_input($codigo_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_codigo_api_out" style="<?php echo $sStyleHidden_codigo_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_codigo_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_codigo_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_codigo_api_out"><?php echo $this->nm_new_label['codigo_api_out']; ?></span></td></tr><tr><td class="css_codigo_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["codigo_api_out"]) &&  $this->nmgp_cmp_readonly["codigo_api_out"] == "on") { 

 ?>
<input type="hidden" name="codigo_api_out" value="<?php echo $this->form_encode_input($codigo_api_out) . "\">" . $codigo_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_codigo_api_out" class="sc-ui-readonly-codigo_api_out css_codigo_api_out_line" style="<?php echo $sStyleReadLab_codigo_api_out; ?>"><?php echo $this->form_format_readonly("codigo_api_out", $this->form_encode_input($this->codigo_api_out)); ?></span><span id="id_read_off_codigo_api_out" class="css_read_off_codigo_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_codigo_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_codigo_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_codigo_api_out" type=text name="codigo_api_out" value="<?php echo $this->form_encode_input($codigo_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_codigo_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_codigo_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['tipo_api_out']))
    {
        $this->nm_new_label['tipo_api_out'] = "Tipo API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $tipo_api_out = $this->tipo_api_out;
   $sStyleHidden_tipo_api_out = '';
   if (isset($this->nmgp_cmp_hidden['tipo_api_out']) && $this->nmgp_cmp_hidden['tipo_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['tipo_api_out']);
       $sStyleHidden_tipo_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_tipo_api_out = 'display: none;';
   $sStyleReadInp_tipo_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['tipo_api_out']) && $this->nmgp_cmp_readonly['tipo_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['tipo_api_out']);
       $sStyleReadLab_tipo_api_out = '';
       $sStyleReadInp_tipo_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['tipo_api_out']) && $this->nmgp_cmp_hidden['tipo_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="tipo_api_out" value="<?php echo $this->form_encode_input($tipo_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_tipo_api_out" style="<?php echo $sStyleHidden_tipo_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_tipo_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_tipo_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_tipo_api_out"><?php echo $this->nm_new_label['tipo_api_out']; ?></span></td></tr><tr><td class="css_tipo_api_out_line" style="padding: 0px; width: 100%;"><input type="hidden" name="tipo_api_out" value="<?php echo $this->form_encode_input($tipo_api_out); ?>"><span id="id_ajax_label_tipo_api_out"><?php echo nl2br($tipo_api_out); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_tipo_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_tipo_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['status_api_out']))
    {
        $this->nm_new_label['status_api_out'] = "Status API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $status_api_out = $this->status_api_out;
   $sStyleHidden_status_api_out = '';
   if (isset($this->nmgp_cmp_hidden['status_api_out']) && $this->nmgp_cmp_hidden['status_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['status_api_out']);
       $sStyleHidden_status_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_status_api_out = 'display: none;';
   $sStyleReadInp_status_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['status_api_out']) && $this->nmgp_cmp_readonly['status_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['status_api_out']);
       $sStyleReadLab_status_api_out = '';
       $sStyleReadInp_status_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['status_api_out']) && $this->nmgp_cmp_hidden['status_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="status_api_out" value="<?php echo $this->form_encode_input($status_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_status_api_out" style="<?php echo $sStyleHidden_status_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_status_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_status_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_status_api_out"><?php echo $this->nm_new_label['status_api_out']; ?></span></td></tr><tr><td class="css_status_api_out_line" style="padding: 0px; width: 100%;"><input type="hidden" name="status_api_out" value="<?php echo $this->form_encode_input($status_api_out); ?>"><span id="id_ajax_label_status_api_out"><?php echo nl2br($status_api_out); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_status_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_status_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['valido_de_api_out']))
    {
        $this->nm_new_label['valido_de_api_out'] = "Válido de API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $valido_de_api_out = $this->valido_de_api_out;
   $sStyleHidden_valido_de_api_out = '';
   if (isset($this->nmgp_cmp_hidden['valido_de_api_out']) && $this->nmgp_cmp_hidden['valido_de_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['valido_de_api_out']);
       $sStyleHidden_valido_de_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_valido_de_api_out = 'display: none;';
   $sStyleReadInp_valido_de_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['valido_de_api_out']) && $this->nmgp_cmp_readonly['valido_de_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['valido_de_api_out']);
       $sStyleReadLab_valido_de_api_out = '';
       $sStyleReadInp_valido_de_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['valido_de_api_out']) && $this->nmgp_cmp_hidden['valido_de_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="valido_de_api_out" value="<?php echo $this->form_encode_input($valido_de_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_valido_de_api_out" style="<?php echo $sStyleHidden_valido_de_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_valido_de_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_valido_de_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_valido_de_api_out"><?php echo $this->nm_new_label['valido_de_api_out']; ?></span></td></tr><tr><td class="css_valido_de_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["valido_de_api_out"]) &&  $this->nmgp_cmp_readonly["valido_de_api_out"] == "on") { 

 ?>
<input type="hidden" name="valido_de_api_out" value="<?php echo $this->form_encode_input($valido_de_api_out) . "\">" . $valido_de_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_valido_de_api_out" class="sc-ui-readonly-valido_de_api_out css_valido_de_api_out_line" style="<?php echo $sStyleReadLab_valido_de_api_out; ?>"><?php echo $this->form_format_readonly("valido_de_api_out", $this->form_encode_input($this->valido_de_api_out)); ?></span><span id="id_read_off_valido_de_api_out" class="css_read_off_valido_de_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_valido_de_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_valido_de_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_valido_de_api_out" type=text name="valido_de_api_out" value="<?php echo $this->form_encode_input($valido_de_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_valido_de_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_valido_de_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['valido_ate_api_out']))
    {
        $this->nm_new_label['valido_ate_api_out'] = "Válido Até API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $valido_ate_api_out = $this->valido_ate_api_out;
   $sStyleHidden_valido_ate_api_out = '';
   if (isset($this->nmgp_cmp_hidden['valido_ate_api_out']) && $this->nmgp_cmp_hidden['valido_ate_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['valido_ate_api_out']);
       $sStyleHidden_valido_ate_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_valido_ate_api_out = 'display: none;';
   $sStyleReadInp_valido_ate_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['valido_ate_api_out']) && $this->nmgp_cmp_readonly['valido_ate_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['valido_ate_api_out']);
       $sStyleReadLab_valido_ate_api_out = '';
       $sStyleReadInp_valido_ate_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['valido_ate_api_out']) && $this->nmgp_cmp_hidden['valido_ate_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="valido_ate_api_out" value="<?php echo $this->form_encode_input($valido_ate_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_valido_ate_api_out" style="<?php echo $sStyleHidden_valido_ate_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_valido_ate_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_valido_ate_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_valido_ate_api_out"><?php echo $this->nm_new_label['valido_ate_api_out']; ?></span></td></tr><tr><td class="css_valido_ate_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["valido_ate_api_out"]) &&  $this->nmgp_cmp_readonly["valido_ate_api_out"] == "on") { 

 ?>
<input type="hidden" name="valido_ate_api_out" value="<?php echo $this->form_encode_input($valido_ate_api_out) . "\">" . $valido_ate_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_valido_ate_api_out" class="sc-ui-readonly-valido_ate_api_out css_valido_ate_api_out_line" style="<?php echo $sStyleReadLab_valido_ate_api_out; ?>"><?php echo $this->form_format_readonly("valido_ate_api_out", $this->form_encode_input($this->valido_ate_api_out)); ?></span><span id="id_read_off_valido_ate_api_out" class="css_read_off_valido_ate_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_valido_ate_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_valido_ate_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_valido_ate_api_out" type=text name="valido_ate_api_out" value="<?php echo $this->form_encode_input($valido_ate_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_valido_ate_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_valido_ate_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['local_de_origem_api_out']))
    {
        $this->nm_new_label['local_de_origem_api_out'] = "Local De Origem API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $local_de_origem_api_out = $this->local_de_origem_api_out;
   $sStyleHidden_local_de_origem_api_out = '';
   if (isset($this->nmgp_cmp_hidden['local_de_origem_api_out']) && $this->nmgp_cmp_hidden['local_de_origem_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['local_de_origem_api_out']);
       $sStyleHidden_local_de_origem_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_local_de_origem_api_out = 'display: none;';
   $sStyleReadInp_local_de_origem_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['local_de_origem_api_out']) && $this->nmgp_cmp_readonly['local_de_origem_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['local_de_origem_api_out']);
       $sStyleReadLab_local_de_origem_api_out = '';
       $sStyleReadInp_local_de_origem_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['local_de_origem_api_out']) && $this->nmgp_cmp_hidden['local_de_origem_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="local_de_origem_api_out" value="<?php echo $this->form_encode_input($local_de_origem_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_local_de_origem_api_out" style="<?php echo $sStyleHidden_local_de_origem_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_local_de_origem_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_local_de_origem_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_local_de_origem_api_out"><?php echo $this->nm_new_label['local_de_origem_api_out']; ?></span></td></tr><tr><td class="css_local_de_origem_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["local_de_origem_api_out"]) &&  $this->nmgp_cmp_readonly["local_de_origem_api_out"] == "on") { 

 ?>
<input type="hidden" name="local_de_origem_api_out" value="<?php echo $this->form_encode_input($local_de_origem_api_out) . "\">" . $local_de_origem_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_local_de_origem_api_out" class="sc-ui-readonly-local_de_origem_api_out css_local_de_origem_api_out_line" style="<?php echo $sStyleReadLab_local_de_origem_api_out; ?>"><?php echo $this->form_format_readonly("local_de_origem_api_out", $this->form_encode_input($this->local_de_origem_api_out)); ?></span><span id="id_read_off_local_de_origem_api_out" class="css_read_off_local_de_origem_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_local_de_origem_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_local_de_origem_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_local_de_origem_api_out" type=text name="local_de_origem_api_out" value="<?php echo $this->form_encode_input($local_de_origem_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=110"; } ?> maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_local_de_origem_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_local_de_origem_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['latitude_origem_api_out']))
    {
        $this->nm_new_label['latitude_origem_api_out'] = "Latitude Origem API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $latitude_origem_api_out = $this->latitude_origem_api_out;
   $sStyleHidden_latitude_origem_api_out = '';
   if (isset($this->nmgp_cmp_hidden['latitude_origem_api_out']) && $this->nmgp_cmp_hidden['latitude_origem_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['latitude_origem_api_out']);
       $sStyleHidden_latitude_origem_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_latitude_origem_api_out = 'display: none;';
   $sStyleReadInp_latitude_origem_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['latitude_origem_api_out']) && $this->nmgp_cmp_readonly['latitude_origem_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['latitude_origem_api_out']);
       $sStyleReadLab_latitude_origem_api_out = '';
       $sStyleReadInp_latitude_origem_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['latitude_origem_api_out']) && $this->nmgp_cmp_hidden['latitude_origem_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="latitude_origem_api_out" value="<?php echo $this->form_encode_input($latitude_origem_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_latitude_origem_api_out" style="<?php echo $sStyleHidden_latitude_origem_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_latitude_origem_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_latitude_origem_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_latitude_origem_api_out"><?php echo $this->nm_new_label['latitude_origem_api_out']; ?></span></td></tr><tr><td class="css_latitude_origem_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["latitude_origem_api_out"]) &&  $this->nmgp_cmp_readonly["latitude_origem_api_out"] == "on") { 

 ?>
<input type="hidden" name="latitude_origem_api_out" value="<?php echo $this->form_encode_input($latitude_origem_api_out) . "\">" . $latitude_origem_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_latitude_origem_api_out" class="sc-ui-readonly-latitude_origem_api_out css_latitude_origem_api_out_line" style="<?php echo $sStyleReadLab_latitude_origem_api_out; ?>"><?php echo $this->form_format_readonly("latitude_origem_api_out", $this->form_encode_input($this->latitude_origem_api_out)); ?></span><span id="id_read_off_latitude_origem_api_out" class="css_read_off_latitude_origem_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_latitude_origem_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_latitude_origem_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_latitude_origem_api_out" type=text name="latitude_origem_api_out" value="<?php echo $this->form_encode_input($latitude_origem_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_latitude_origem_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_latitude_origem_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['longitude_origem_api_out']))
    {
        $this->nm_new_label['longitude_origem_api_out'] = "Longitude Origem API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $longitude_origem_api_out = $this->longitude_origem_api_out;
   $sStyleHidden_longitude_origem_api_out = '';
   if (isset($this->nmgp_cmp_hidden['longitude_origem_api_out']) && $this->nmgp_cmp_hidden['longitude_origem_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['longitude_origem_api_out']);
       $sStyleHidden_longitude_origem_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_longitude_origem_api_out = 'display: none;';
   $sStyleReadInp_longitude_origem_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['longitude_origem_api_out']) && $this->nmgp_cmp_readonly['longitude_origem_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['longitude_origem_api_out']);
       $sStyleReadLab_longitude_origem_api_out = '';
       $sStyleReadInp_longitude_origem_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['longitude_origem_api_out']) && $this->nmgp_cmp_hidden['longitude_origem_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="longitude_origem_api_out" value="<?php echo $this->form_encode_input($longitude_origem_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_longitude_origem_api_out" style="<?php echo $sStyleHidden_longitude_origem_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_longitude_origem_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_longitude_origem_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_longitude_origem_api_out"><?php echo $this->nm_new_label['longitude_origem_api_out']; ?></span></td></tr><tr><td class="css_longitude_origem_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["longitude_origem_api_out"]) &&  $this->nmgp_cmp_readonly["longitude_origem_api_out"] == "on") { 

 ?>
<input type="hidden" name="longitude_origem_api_out" value="<?php echo $this->form_encode_input($longitude_origem_api_out) . "\">" . $longitude_origem_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_longitude_origem_api_out" class="sc-ui-readonly-longitude_origem_api_out css_longitude_origem_api_out_line" style="<?php echo $sStyleReadLab_longitude_origem_api_out; ?>"><?php echo $this->form_format_readonly("longitude_origem_api_out", $this->form_encode_input($this->longitude_origem_api_out)); ?></span><span id="id_read_off_longitude_origem_api_out" class="css_read_off_longitude_origem_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_longitude_origem_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_longitude_origem_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_longitude_origem_api_out" type=text name="longitude_origem_api_out" value="<?php echo $this->form_encode_input($longitude_origem_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_longitude_origem_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_longitude_origem_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hr_saida_origem_api_out']))
    {
        $this->nm_new_label['hr_saida_origem_api_out'] = "Hr Saída Origem API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hr_saida_origem_api_out = $this->hr_saida_origem_api_out;
   $sStyleHidden_hr_saida_origem_api_out = '';
   if (isset($this->nmgp_cmp_hidden['hr_saida_origem_api_out']) && $this->nmgp_cmp_hidden['hr_saida_origem_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hr_saida_origem_api_out']);
       $sStyleHidden_hr_saida_origem_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hr_saida_origem_api_out = 'display: none;';
   $sStyleReadInp_hr_saida_origem_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hr_saida_origem_api_out']) && $this->nmgp_cmp_readonly['hr_saida_origem_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hr_saida_origem_api_out']);
       $sStyleReadLab_hr_saida_origem_api_out = '';
       $sStyleReadInp_hr_saida_origem_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hr_saida_origem_api_out']) && $this->nmgp_cmp_hidden['hr_saida_origem_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hr_saida_origem_api_out" value="<?php echo $this->form_encode_input($hr_saida_origem_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_hr_saida_origem_api_out" style="<?php echo $sStyleHidden_hr_saida_origem_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hr_saida_origem_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_hr_saida_origem_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_hr_saida_origem_api_out"><?php echo $this->nm_new_label['hr_saida_origem_api_out']; ?></span></td></tr><tr><td class="css_hr_saida_origem_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hr_saida_origem_api_out"]) &&  $this->nmgp_cmp_readonly["hr_saida_origem_api_out"] == "on") { 

 ?>
<input type="hidden" name="hr_saida_origem_api_out" value="<?php echo $this->form_encode_input($hr_saida_origem_api_out) . "\">" . $hr_saida_origem_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_hr_saida_origem_api_out" class="sc-ui-readonly-hr_saida_origem_api_out css_hr_saida_origem_api_out_line" style="<?php echo $sStyleReadLab_hr_saida_origem_api_out; ?>"><?php echo $this->form_format_readonly("hr_saida_origem_api_out", $this->form_encode_input($this->hr_saida_origem_api_out)); ?></span><span id="id_read_off_hr_saida_origem_api_out" class="css_read_off_hr_saida_origem_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hr_saida_origem_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_hr_saida_origem_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hr_saida_origem_api_out" type=text name="hr_saida_origem_api_out" value="<?php echo $this->form_encode_input($hr_saida_origem_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=5 alt="{datatype: 'text', maxLength: 5, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hr_saida_origem_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hr_saida_origem_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['local_de_destino_api_out']))
    {
        $this->nm_new_label['local_de_destino_api_out'] = "Local Destino API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $local_de_destino_api_out = $this->local_de_destino_api_out;
   $sStyleHidden_local_de_destino_api_out = '';
   if (isset($this->nmgp_cmp_hidden['local_de_destino_api_out']) && $this->nmgp_cmp_hidden['local_de_destino_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['local_de_destino_api_out']);
       $sStyleHidden_local_de_destino_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_local_de_destino_api_out = 'display: none;';
   $sStyleReadInp_local_de_destino_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['local_de_destino_api_out']) && $this->nmgp_cmp_readonly['local_de_destino_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['local_de_destino_api_out']);
       $sStyleReadLab_local_de_destino_api_out = '';
       $sStyleReadInp_local_de_destino_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['local_de_destino_api_out']) && $this->nmgp_cmp_hidden['local_de_destino_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="local_de_destino_api_out" value="<?php echo $this->form_encode_input($local_de_destino_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_local_de_destino_api_out" style="<?php echo $sStyleHidden_local_de_destino_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_local_de_destino_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_local_de_destino_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_local_de_destino_api_out"><?php echo $this->nm_new_label['local_de_destino_api_out']; ?></span></td></tr><tr><td class="css_local_de_destino_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["local_de_destino_api_out"]) &&  $this->nmgp_cmp_readonly["local_de_destino_api_out"] == "on") { 

 ?>
<input type="hidden" name="local_de_destino_api_out" value="<?php echo $this->form_encode_input($local_de_destino_api_out) . "\">" . $local_de_destino_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_local_de_destino_api_out" class="sc-ui-readonly-local_de_destino_api_out css_local_de_destino_api_out_line" style="<?php echo $sStyleReadLab_local_de_destino_api_out; ?>"><?php echo $this->form_format_readonly("local_de_destino_api_out", $this->form_encode_input($this->local_de_destino_api_out)); ?></span><span id="id_read_off_local_de_destino_api_out" class="css_read_off_local_de_destino_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_local_de_destino_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_local_de_destino_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_local_de_destino_api_out" type=text name="local_de_destino_api_out" value="<?php echo $this->form_encode_input($local_de_destino_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=110"; } ?> maxlength=150 alt="{datatype: 'text', maxLength: 150, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_local_de_destino_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_local_de_destino_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['latitude_destino_api_out']))
    {
        $this->nm_new_label['latitude_destino_api_out'] = "Latitude Destino API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $latitude_destino_api_out = $this->latitude_destino_api_out;
   $sStyleHidden_latitude_destino_api_out = '';
   if (isset($this->nmgp_cmp_hidden['latitude_destino_api_out']) && $this->nmgp_cmp_hidden['latitude_destino_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['latitude_destino_api_out']);
       $sStyleHidden_latitude_destino_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_latitude_destino_api_out = 'display: none;';
   $sStyleReadInp_latitude_destino_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['latitude_destino_api_out']) && $this->nmgp_cmp_readonly['latitude_destino_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['latitude_destino_api_out']);
       $sStyleReadLab_latitude_destino_api_out = '';
       $sStyleReadInp_latitude_destino_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['latitude_destino_api_out']) && $this->nmgp_cmp_hidden['latitude_destino_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="latitude_destino_api_out" value="<?php echo $this->form_encode_input($latitude_destino_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_latitude_destino_api_out" style="<?php echo $sStyleHidden_latitude_destino_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_latitude_destino_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_latitude_destino_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_latitude_destino_api_out"><?php echo $this->nm_new_label['latitude_destino_api_out']; ?></span></td></tr><tr><td class="css_latitude_destino_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["latitude_destino_api_out"]) &&  $this->nmgp_cmp_readonly["latitude_destino_api_out"] == "on") { 

 ?>
<input type="hidden" name="latitude_destino_api_out" value="<?php echo $this->form_encode_input($latitude_destino_api_out) . "\">" . $latitude_destino_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_latitude_destino_api_out" class="sc-ui-readonly-latitude_destino_api_out css_latitude_destino_api_out_line" style="<?php echo $sStyleReadLab_latitude_destino_api_out; ?>"><?php echo $this->form_format_readonly("latitude_destino_api_out", $this->form_encode_input($this->latitude_destino_api_out)); ?></span><span id="id_read_off_latitude_destino_api_out" class="css_read_off_latitude_destino_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_latitude_destino_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_latitude_destino_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_latitude_destino_api_out" type=text name="latitude_destino_api_out" value="<?php echo $this->form_encode_input($latitude_destino_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_latitude_destino_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_latitude_destino_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['longitude_destino_api_out']))
    {
        $this->nm_new_label['longitude_destino_api_out'] = "Longitude Destino API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $longitude_destino_api_out = $this->longitude_destino_api_out;
   $sStyleHidden_longitude_destino_api_out = '';
   if (isset($this->nmgp_cmp_hidden['longitude_destino_api_out']) && $this->nmgp_cmp_hidden['longitude_destino_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['longitude_destino_api_out']);
       $sStyleHidden_longitude_destino_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_longitude_destino_api_out = 'display: none;';
   $sStyleReadInp_longitude_destino_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['longitude_destino_api_out']) && $this->nmgp_cmp_readonly['longitude_destino_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['longitude_destino_api_out']);
       $sStyleReadLab_longitude_destino_api_out = '';
       $sStyleReadInp_longitude_destino_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['longitude_destino_api_out']) && $this->nmgp_cmp_hidden['longitude_destino_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="longitude_destino_api_out" value="<?php echo $this->form_encode_input($longitude_destino_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_longitude_destino_api_out" style="<?php echo $sStyleHidden_longitude_destino_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_longitude_destino_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_longitude_destino_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_longitude_destino_api_out"><?php echo $this->nm_new_label['longitude_destino_api_out']; ?></span></td></tr><tr><td class="css_longitude_destino_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["longitude_destino_api_out"]) &&  $this->nmgp_cmp_readonly["longitude_destino_api_out"] == "on") { 

 ?>
<input type="hidden" name="longitude_destino_api_out" value="<?php echo $this->form_encode_input($longitude_destino_api_out) . "\">" . $longitude_destino_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_longitude_destino_api_out" class="sc-ui-readonly-longitude_destino_api_out css_longitude_destino_api_out_line" style="<?php echo $sStyleReadLab_longitude_destino_api_out; ?>"><?php echo $this->form_format_readonly("longitude_destino_api_out", $this->form_encode_input($this->longitude_destino_api_out)); ?></span><span id="id_read_off_longitude_destino_api_out" class="css_read_off_longitude_destino_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_longitude_destino_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_longitude_destino_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_longitude_destino_api_out" type=text name="longitude_destino_api_out" value="<?php echo $this->form_encode_input($longitude_destino_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_longitude_destino_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_longitude_destino_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['veiculo_api_out']))
    {
        $this->nm_new_label['veiculo_api_out'] = "Veículo API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $veiculo_api_out = $this->veiculo_api_out;
   $sStyleHidden_veiculo_api_out = '';
   if (isset($this->nmgp_cmp_hidden['veiculo_api_out']) && $this->nmgp_cmp_hidden['veiculo_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['veiculo_api_out']);
       $sStyleHidden_veiculo_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_veiculo_api_out = 'display: none;';
   $sStyleReadInp_veiculo_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['veiculo_api_out']) && $this->nmgp_cmp_readonly['veiculo_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['veiculo_api_out']);
       $sStyleReadLab_veiculo_api_out = '';
       $sStyleReadInp_veiculo_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['veiculo_api_out']) && $this->nmgp_cmp_hidden['veiculo_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="veiculo_api_out" value="<?php echo $this->form_encode_input($veiculo_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_veiculo_api_out" style="<?php echo $sStyleHidden_veiculo_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_veiculo_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_veiculo_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_veiculo_api_out"><?php echo $this->nm_new_label['veiculo_api_out']; ?></span></td></tr><tr><td class="css_veiculo_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["veiculo_api_out"]) &&  $this->nmgp_cmp_readonly["veiculo_api_out"] == "on") { 

 ?>
<input type="hidden" name="veiculo_api_out" value="<?php echo $this->form_encode_input($veiculo_api_out) . "\">" . $veiculo_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_veiculo_api_out" class="sc-ui-readonly-veiculo_api_out css_veiculo_api_out_line" style="<?php echo $sStyleReadLab_veiculo_api_out; ?>"><?php echo $this->form_format_readonly("veiculo_api_out", $this->form_encode_input($this->veiculo_api_out)); ?></span><span id="id_read_off_veiculo_api_out" class="css_read_off_veiculo_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_veiculo_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_veiculo_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_veiculo_api_out" type=text name="veiculo_api_out" value="<?php echo $this->form_encode_input($veiculo_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=35"; } ?> maxlength=35 alt="{datatype: 'text', maxLength: 35, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_veiculo_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_veiculo_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['companhia_api_out']))
    {
        $this->nm_new_label['companhia_api_out'] = "Companhia API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $companhia_api_out = $this->companhia_api_out;
   $sStyleHidden_companhia_api_out = '';
   if (isset($this->nmgp_cmp_hidden['companhia_api_out']) && $this->nmgp_cmp_hidden['companhia_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['companhia_api_out']);
       $sStyleHidden_companhia_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_companhia_api_out = 'display: none;';
   $sStyleReadInp_companhia_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['companhia_api_out']) && $this->nmgp_cmp_readonly['companhia_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['companhia_api_out']);
       $sStyleReadLab_companhia_api_out = '';
       $sStyleReadInp_companhia_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['companhia_api_out']) && $this->nmgp_cmp_hidden['companhia_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="companhia_api_out" value="<?php echo $this->form_encode_input($companhia_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_companhia_api_out" style="<?php echo $sStyleHidden_companhia_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_companhia_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_companhia_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_companhia_api_out"><?php echo $this->nm_new_label['companhia_api_out']; ?></span></td></tr><tr><td class="css_companhia_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["companhia_api_out"]) &&  $this->nmgp_cmp_readonly["companhia_api_out"] == "on") { 

 ?>
<input type="hidden" name="companhia_api_out" value="<?php echo $this->form_encode_input($companhia_api_out) . "\">" . $companhia_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_companhia_api_out" class="sc-ui-readonly-companhia_api_out css_companhia_api_out_line" style="<?php echo $sStyleReadLab_companhia_api_out; ?>"><?php echo $this->form_format_readonly("companhia_api_out", $this->form_encode_input($this->companhia_api_out)); ?></span><span id="id_read_off_companhia_api_out" class="css_read_off_companhia_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_companhia_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_companhia_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_companhia_api_out" type=text name="companhia_api_out" value="<?php echo $this->form_encode_input($companhia_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=35"; } ?> maxlength=35 alt="{datatype: 'text', maxLength: 35, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_companhia_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_companhia_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['nome_motorista_api_out']))
    {
        $this->nm_new_label['nome_motorista_api_out'] = "Nome Motorista API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $nome_motorista_api_out = $this->nome_motorista_api_out;
   $sStyleHidden_nome_motorista_api_out = '';
   if (isset($this->nmgp_cmp_hidden['nome_motorista_api_out']) && $this->nmgp_cmp_hidden['nome_motorista_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['nome_motorista_api_out']);
       $sStyleHidden_nome_motorista_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_nome_motorista_api_out = 'display: none;';
   $sStyleReadInp_nome_motorista_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['nome_motorista_api_out']) && $this->nmgp_cmp_readonly['nome_motorista_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['nome_motorista_api_out']);
       $sStyleReadLab_nome_motorista_api_out = '';
       $sStyleReadInp_nome_motorista_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['nome_motorista_api_out']) && $this->nmgp_cmp_hidden['nome_motorista_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="nome_motorista_api_out" value="<?php echo $this->form_encode_input($nome_motorista_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_nome_motorista_api_out" style="<?php echo $sStyleHidden_nome_motorista_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_nome_motorista_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_nome_motorista_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_nome_motorista_api_out"><?php echo $this->nm_new_label['nome_motorista_api_out']; ?></span></td></tr><tr><td class="css_nome_motorista_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["nome_motorista_api_out"]) &&  $this->nmgp_cmp_readonly["nome_motorista_api_out"] == "on") { 

 ?>
<input type="hidden" name="nome_motorista_api_out" value="<?php echo $this->form_encode_input($nome_motorista_api_out) . "\">" . $nome_motorista_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_nome_motorista_api_out" class="sc-ui-readonly-nome_motorista_api_out css_nome_motorista_api_out_line" style="<?php echo $sStyleReadLab_nome_motorista_api_out; ?>"><?php echo $this->form_format_readonly("nome_motorista_api_out", $this->form_encode_input($this->nome_motorista_api_out)); ?></span><span id="id_read_off_nome_motorista_api_out" class="css_read_off_nome_motorista_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_nome_motorista_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_nome_motorista_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_nome_motorista_api_out" type=text name="nome_motorista_api_out" value="<?php echo $this->form_encode_input($nome_motorista_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=35"; } ?> maxlength=35 alt="{datatype: 'text', maxLength: 35, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_nome_motorista_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_nome_motorista_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['contato_motorista_api_out']))
    {
        $this->nm_new_label['contato_motorista_api_out'] = "Contato Motorista API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $contato_motorista_api_out = $this->contato_motorista_api_out;
   $sStyleHidden_contato_motorista_api_out = '';
   if (isset($this->nmgp_cmp_hidden['contato_motorista_api_out']) && $this->nmgp_cmp_hidden['contato_motorista_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['contato_motorista_api_out']);
       $sStyleHidden_contato_motorista_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_contato_motorista_api_out = 'display: none;';
   $sStyleReadInp_contato_motorista_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['contato_motorista_api_out']) && $this->nmgp_cmp_readonly['contato_motorista_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['contato_motorista_api_out']);
       $sStyleReadLab_contato_motorista_api_out = '';
       $sStyleReadInp_contato_motorista_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['contato_motorista_api_out']) && $this->nmgp_cmp_hidden['contato_motorista_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="contato_motorista_api_out" value="<?php echo $this->form_encode_input($contato_motorista_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_contato_motorista_api_out" style="<?php echo $sStyleHidden_contato_motorista_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_contato_motorista_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_contato_motorista_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_contato_motorista_api_out"><?php echo $this->nm_new_label['contato_motorista_api_out']; ?></span></td></tr><tr><td class="css_contato_motorista_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["contato_motorista_api_out"]) &&  $this->nmgp_cmp_readonly["contato_motorista_api_out"] == "on") { 

 ?>
<input type="hidden" name="contato_motorista_api_out" value="<?php echo $this->form_encode_input($contato_motorista_api_out) . "\">" . $contato_motorista_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_contato_motorista_api_out" class="sc-ui-readonly-contato_motorista_api_out css_contato_motorista_api_out_line" style="<?php echo $sStyleReadLab_contato_motorista_api_out; ?>"><?php echo $this->form_format_readonly("contato_motorista_api_out", $this->form_encode_input($this->contato_motorista_api_out)); ?></span><span id="id_read_off_contato_motorista_api_out" class="css_read_off_contato_motorista_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_contato_motorista_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_contato_motorista_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_contato_motorista_api_out" type=text name="contato_motorista_api_out" value="<?php echo $this->form_encode_input($contato_motorista_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=38 alt="{datatype: 'mask', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '+99 (99)99999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_contato_motorista_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_contato_motorista_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['matricula_api_out']))
    {
        $this->nm_new_label['matricula_api_out'] = "Matricula API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $matricula_api_out = $this->matricula_api_out;
   $sStyleHidden_matricula_api_out = '';
   if (isset($this->nmgp_cmp_hidden['matricula_api_out']) && $this->nmgp_cmp_hidden['matricula_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['matricula_api_out']);
       $sStyleHidden_matricula_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_matricula_api_out = 'display: none;';
   $sStyleReadInp_matricula_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['matricula_api_out']) && $this->nmgp_cmp_readonly['matricula_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['matricula_api_out']);
       $sStyleReadLab_matricula_api_out = '';
       $sStyleReadInp_matricula_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['matricula_api_out']) && $this->nmgp_cmp_hidden['matricula_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="matricula_api_out" value="<?php echo $this->form_encode_input($matricula_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_matricula_api_out" style="<?php echo $sStyleHidden_matricula_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_matricula_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_matricula_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_matricula_api_out"><?php echo $this->nm_new_label['matricula_api_out']; ?></span></td></tr><tr><td class="css_matricula_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["matricula_api_out"]) &&  $this->nmgp_cmp_readonly["matricula_api_out"] == "on") { 

 ?>
<input type="hidden" name="matricula_api_out" value="<?php echo $this->form_encode_input($matricula_api_out) . "\">" . $matricula_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_matricula_api_out" class="sc-ui-readonly-matricula_api_out css_matricula_api_out_line" style="<?php echo $sStyleReadLab_matricula_api_out; ?>"><?php echo $this->form_format_readonly("matricula_api_out", $this->form_encode_input($this->matricula_api_out)); ?></span><span id="id_read_off_matricula_api_out" class="css_read_off_matricula_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_matricula_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_matricula_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_matricula_api_out" type=text name="matricula_api_out" value="<?php echo $this->form_encode_input($matricula_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_matricula_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_matricula_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['duracao_percurso_api_out']))
    {
        $this->nm_new_label['duracao_percurso_api_out'] = "Duração Percurso API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $duracao_percurso_api_out = $this->duracao_percurso_api_out;
   $sStyleHidden_duracao_percurso_api_out = '';
   if (isset($this->nmgp_cmp_hidden['duracao_percurso_api_out']) && $this->nmgp_cmp_hidden['duracao_percurso_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['duracao_percurso_api_out']);
       $sStyleHidden_duracao_percurso_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_duracao_percurso_api_out = 'display: none;';
   $sStyleReadInp_duracao_percurso_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['duracao_percurso_api_out']) && $this->nmgp_cmp_readonly['duracao_percurso_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['duracao_percurso_api_out']);
       $sStyleReadLab_duracao_percurso_api_out = '';
       $sStyleReadInp_duracao_percurso_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['duracao_percurso_api_out']) && $this->nmgp_cmp_hidden['duracao_percurso_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="duracao_percurso_api_out" value="<?php echo $this->form_encode_input($duracao_percurso_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_duracao_percurso_api_out" style="<?php echo $sStyleHidden_duracao_percurso_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_duracao_percurso_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_duracao_percurso_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_duracao_percurso_api_out"><?php echo $this->nm_new_label['duracao_percurso_api_out']; ?></span></td></tr><tr><td class="css_duracao_percurso_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["duracao_percurso_api_out"]) &&  $this->nmgp_cmp_readonly["duracao_percurso_api_out"] == "on") { 

 ?>
<input type="hidden" name="duracao_percurso_api_out" value="<?php echo $this->form_encode_input($duracao_percurso_api_out) . "\">" . $duracao_percurso_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_duracao_percurso_api_out" class="sc-ui-readonly-duracao_percurso_api_out css_duracao_percurso_api_out_line" style="<?php echo $sStyleReadLab_duracao_percurso_api_out; ?>"><?php echo $this->form_format_readonly("duracao_percurso_api_out", $this->form_encode_input($this->duracao_percurso_api_out)); ?></span><span id="id_read_off_duracao_percurso_api_out" class="css_read_off_duracao_percurso_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_duracao_percurso_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_duracao_percurso_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_duracao_percurso_api_out" type=text name="duracao_percurso_api_out" value="<?php echo $this->form_encode_input($duracao_percurso_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=25 alt="{datatype: 'text', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_duracao_percurso_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_duracao_percurso_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['comodidades_api_out']))
    {
        $this->nm_new_label['comodidades_api_out'] = "Comodidades API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $comodidades_api_out = $this->comodidades_api_out;
   $sStyleHidden_comodidades_api_out = '';
   if (isset($this->nmgp_cmp_hidden['comodidades_api_out']) && $this->nmgp_cmp_hidden['comodidades_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['comodidades_api_out']);
       $sStyleHidden_comodidades_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_comodidades_api_out = 'display: none;';
   $sStyleReadInp_comodidades_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['comodidades_api_out']) && $this->nmgp_cmp_readonly['comodidades_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['comodidades_api_out']);
       $sStyleReadLab_comodidades_api_out = '';
       $sStyleReadInp_comodidades_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['comodidades_api_out']) && $this->nmgp_cmp_hidden['comodidades_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="comodidades_api_out" value="<?php echo $this->form_encode_input($comodidades_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_comodidades_api_out" style="<?php echo $sStyleHidden_comodidades_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_comodidades_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_comodidades_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_comodidades_api_out"><?php echo $this->nm_new_label['comodidades_api_out']; ?></span></td></tr><tr><td class="css_comodidades_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["comodidades_api_out"]) &&  $this->nmgp_cmp_readonly["comodidades_api_out"] == "on") { 

 ?>
<input type="hidden" name="comodidades_api_out" value="<?php echo $this->form_encode_input($comodidades_api_out) . "\">" . $comodidades_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_comodidades_api_out" class="sc-ui-readonly-comodidades_api_out css_comodidades_api_out_line" style="<?php echo $sStyleReadLab_comodidades_api_out; ?>"><?php echo $this->form_format_readonly("comodidades_api_out", $this->form_encode_input($this->comodidades_api_out)); ?></span><span id="id_read_off_comodidades_api_out" class="css_read_off_comodidades_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_comodidades_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_comodidades_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_comodidades_api_out" type=text name="comodidades_api_out" value="<?php echo $this->form_encode_input($comodidades_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=100"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_comodidades_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_comodidades_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['observacao_api_out']))
    {
        $this->nm_new_label['observacao_api_out'] = "Observação API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $observacao_api_out = $this->observacao_api_out;
   $sStyleHidden_observacao_api_out = '';
   if (isset($this->nmgp_cmp_hidden['observacao_api_out']) && $this->nmgp_cmp_hidden['observacao_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['observacao_api_out']);
       $sStyleHidden_observacao_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_observacao_api_out = 'display: none;';
   $sStyleReadInp_observacao_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['observacao_api_out']) && $this->nmgp_cmp_readonly['observacao_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['observacao_api_out']);
       $sStyleReadLab_observacao_api_out = '';
       $sStyleReadInp_observacao_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['observacao_api_out']) && $this->nmgp_cmp_hidden['observacao_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="observacao_api_out" value="<?php echo $this->form_encode_input($observacao_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_observacao_api_out" style="<?php echo $sStyleHidden_observacao_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_observacao_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_observacao_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_observacao_api_out"><?php echo $this->nm_new_label['observacao_api_out']; ?></span></td></tr><tr><td class="css_observacao_api_out_line" style="padding: 0px; width: 100%;">
<?php
$observacao_api_out_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($observacao_api_out));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["observacao_api_out"]) &&  $this->nmgp_cmp_readonly["observacao_api_out"] == "on") { 

 ?>
<input type="hidden" name="observacao_api_out" value="<?php echo $this->form_encode_input($observacao_api_out) . "\">" . $observacao_api_out_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_observacao_api_out" class="sc-ui-readonly-observacao_api_out css_observacao_api_out_line" style="<?php echo $sStyleReadLab_observacao_api_out; ?>"><?php echo $this->form_format_readonly("observacao_api_out", $this->form_encode_input($observacao_api_out_val)); ?></span><span id="id_read_off_observacao_api_out" class="css_read_off_observacao_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_observacao_api_out; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_observacao_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="observacao_api_out" id="id_sc_field_observacao_api_out" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 32767, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $observacao_api_out; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_observacao_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_observacao_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['placa_veiculo_api_out']))
    {
        $this->nm_new_label['placa_veiculo_api_out'] = "Placa Veículo API OUT:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $placa_veiculo_api_out = $this->placa_veiculo_api_out;
   $sStyleHidden_placa_veiculo_api_out = '';
   if (isset($this->nmgp_cmp_hidden['placa_veiculo_api_out']) && $this->nmgp_cmp_hidden['placa_veiculo_api_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['placa_veiculo_api_out']);
       $sStyleHidden_placa_veiculo_api_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_placa_veiculo_api_out = 'display: none;';
   $sStyleReadInp_placa_veiculo_api_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['placa_veiculo_api_out']) && $this->nmgp_cmp_readonly['placa_veiculo_api_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['placa_veiculo_api_out']);
       $sStyleReadLab_placa_veiculo_api_out = '';
       $sStyleReadInp_placa_veiculo_api_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['placa_veiculo_api_out']) && $this->nmgp_cmp_hidden['placa_veiculo_api_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="placa_veiculo_api_out" value="<?php echo $this->form_encode_input($placa_veiculo_api_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_placa_veiculo_api_out" style="<?php echo $sStyleHidden_placa_veiculo_api_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_placa_veiculo_api_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_placa_veiculo_api_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_placa_veiculo_api_out"><?php echo $this->nm_new_label['placa_veiculo_api_out']; ?></span></td></tr><tr><td class="css_placa_veiculo_api_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["placa_veiculo_api_out"]) &&  $this->nmgp_cmp_readonly["placa_veiculo_api_out"] == "on") { 

 ?>
<input type="hidden" name="placa_veiculo_api_out" value="<?php echo $this->form_encode_input($placa_veiculo_api_out) . "\">" . $placa_veiculo_api_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_placa_veiculo_api_out" class="sc-ui-readonly-placa_veiculo_api_out css_placa_veiculo_api_out_line" style="<?php echo $sStyleReadLab_placa_veiculo_api_out; ?>"><?php echo $this->form_format_readonly("placa_veiculo_api_out", $this->form_encode_input($this->placa_veiculo_api_out)); ?></span><span id="id_read_off_placa_veiculo_api_out" class="css_read_off_placa_veiculo_api_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_placa_veiculo_api_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_placa_veiculo_api_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_placa_veiculo_api_out" type=text name="placa_veiculo_api_out" value="<?php echo $this->form_encode_input($placa_veiculo_api_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_placa_veiculo_api_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_placa_veiculo_api_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_evento_app_out']))
    {
        $this->nm_new_label['id_evento_app_out'] = "Id Evento App Out:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_evento_app_out = $this->id_evento_app_out;
   $sStyleHidden_id_evento_app_out = '';
   if (isset($this->nmgp_cmp_hidden['id_evento_app_out']) && $this->nmgp_cmp_hidden['id_evento_app_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_evento_app_out']);
       $sStyleHidden_id_evento_app_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_evento_app_out = 'display: none;';
   $sStyleReadInp_id_evento_app_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_evento_app_out']) && $this->nmgp_cmp_readonly['id_evento_app_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_evento_app_out']);
       $sStyleReadLab_id_evento_app_out = '';
       $sStyleReadInp_id_evento_app_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_evento_app_out']) && $this->nmgp_cmp_hidden['id_evento_app_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_evento_app_out" value="<?php echo $this->form_encode_input($id_evento_app_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_id_evento_app_out" style="<?php echo $sStyleHidden_id_evento_app_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_evento_app_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_id_evento_app_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_id_evento_app_out"><?php echo $this->nm_new_label['id_evento_app_out']; ?></span></td></tr><tr><td class="css_id_evento_app_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_evento_app_out"]) &&  $this->nmgp_cmp_readonly["id_evento_app_out"] == "on") { 

 ?>
<input type="hidden" name="id_evento_app_out" value="<?php echo $this->form_encode_input($id_evento_app_out) . "\">" . $id_evento_app_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_evento_app_out" class="sc-ui-readonly-id_evento_app_out css_id_evento_app_out_line" style="<?php echo $sStyleReadLab_id_evento_app_out; ?>"><?php echo $this->form_format_readonly("id_evento_app_out", $this->form_encode_input($this->id_evento_app_out)); ?></span><span id="id_read_off_id_evento_app_out" class="css_read_off_id_evento_app_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_evento_app_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_evento_app_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_evento_app_out" type=text name="id_evento_app_out" value="<?php echo $this->form_encode_input($id_evento_app_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_evento_app_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_evento_app_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_participante_app_out']))
    {
        $this->nm_new_label['id_participante_app_out'] = "Id Participante App Out:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_participante_app_out = $this->id_participante_app_out;
   $sStyleHidden_id_participante_app_out = '';
   if (isset($this->nmgp_cmp_hidden['id_participante_app_out']) && $this->nmgp_cmp_hidden['id_participante_app_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_participante_app_out']);
       $sStyleHidden_id_participante_app_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_participante_app_out = 'display: none;';
   $sStyleReadInp_id_participante_app_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_participante_app_out']) && $this->nmgp_cmp_readonly['id_participante_app_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_participante_app_out']);
       $sStyleReadLab_id_participante_app_out = '';
       $sStyleReadInp_id_participante_app_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_participante_app_out']) && $this->nmgp_cmp_hidden['id_participante_app_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_participante_app_out" value="<?php echo $this->form_encode_input($id_participante_app_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_id_participante_app_out" style="<?php echo $sStyleHidden_id_participante_app_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_participante_app_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_id_participante_app_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_id_participante_app_out"><?php echo $this->nm_new_label['id_participante_app_out']; ?></span></td></tr><tr><td class="css_id_participante_app_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_participante_app_out"]) &&  $this->nmgp_cmp_readonly["id_participante_app_out"] == "on") { 

 ?>
<input type="hidden" name="id_participante_app_out" value="<?php echo $this->form_encode_input($id_participante_app_out) . "\">" . $id_participante_app_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_participante_app_out" class="sc-ui-readonly-id_participante_app_out css_id_participante_app_out_line" style="<?php echo $sStyleReadLab_id_participante_app_out; ?>"><?php echo $this->form_format_readonly("id_participante_app_out", $this->form_encode_input($this->id_participante_app_out)); ?></span><span id="id_read_off_id_participante_app_out" class="css_read_off_id_participante_app_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_participante_app_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_participante_app_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_participante_app_out" type=text name="id_participante_app_out" value="<?php echo $this->form_encode_input($id_participante_app_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_participante_app_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_participante_app_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['id_voucher_app_out']))
    {
        $this->nm_new_label['id_voucher_app_out'] = "Id Voucher App Out:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $id_voucher_app_out = $this->id_voucher_app_out;
   $sStyleHidden_id_voucher_app_out = '';
   if (isset($this->nmgp_cmp_hidden['id_voucher_app_out']) && $this->nmgp_cmp_hidden['id_voucher_app_out'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['id_voucher_app_out']);
       $sStyleHidden_id_voucher_app_out = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_id_voucher_app_out = 'display: none;';
   $sStyleReadInp_id_voucher_app_out = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['id_voucher_app_out']) && $this->nmgp_cmp_readonly['id_voucher_app_out'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['id_voucher_app_out']);
       $sStyleReadLab_id_voucher_app_out = '';
       $sStyleReadInp_id_voucher_app_out = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['id_voucher_app_out']) && $this->nmgp_cmp_hidden['id_voucher_app_out'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_voucher_app_out" value="<?php echo $this->form_encode_input($id_voucher_app_out) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_id_voucher_app_out" style="<?php echo $sStyleHidden_id_voucher_app_out; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_id_voucher_app_out_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_id_voucher_app_out_label" style=" padding: 0px; width: 100%;"><span id="id_label_id_voucher_app_out"><?php echo $this->nm_new_label['id_voucher_app_out']; ?></span></td></tr><tr><td class="css_id_voucher_app_out_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["id_voucher_app_out"]) &&  $this->nmgp_cmp_readonly["id_voucher_app_out"] == "on") { 

 ?>
<input type="hidden" name="id_voucher_app_out" value="<?php echo $this->form_encode_input($id_voucher_app_out) . "\">" . $id_voucher_app_out . ""; ?>
<?php } else { ?>
<span id="id_read_on_id_voucher_app_out" class="sc-ui-readonly-id_voucher_app_out css_id_voucher_app_out_line" style="<?php echo $sStyleReadLab_id_voucher_app_out; ?>"><?php echo $this->form_format_readonly("id_voucher_app_out", $this->form_encode_input($this->id_voucher_app_out)); ?></span><span id="id_read_off_id_voucher_app_out" class="css_read_off_id_voucher_app_out<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_id_voucher_app_out; ?>">
 <input class="sc-js-input scFormObjectOdd css_id_voucher_app_out_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_id_voucher_app_out" type=text name="id_voucher_app_out" value="<?php echo $this->form_encode_input($id_voucher_app_out) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_voucher_app_out_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_voucher_app_out_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
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
if (isset($this->NM_ajax_info['focus']) && '' != $this->NM_ajax_info['focus'])
{
?>
scFocusField('<?php echo $this->NM_ajax_info['focus']; ?>');
<?php
}
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_transfer_rsvp_mob");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_transfer_rsvp_mob");
 parent.scAjaxDetailHeight("form_transfer_rsvp_mob", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_transfer_rsvp_mob", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_transfer_rsvp_mob", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['sc_modal'])
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
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_ins_t.sc-unique-btn-2").length && $("#sc_b_ins_t.sc-unique-btn-2").is(":visible")) {
                    if ($("#sc_b_ins_t.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('incluir');
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_new_t.sc-unique-btn-15").length && $("#sc_b_new_t.sc-unique-btn-15").is(":visible")) {
                    if ($("#sc_b_new_t.sc-unique-btn-15").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('novo');
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_ins_t.sc-unique-btn-16").length && $("#sc_b_ins_t.sc-unique-btn-16").is(":visible")) {
                    if ($("#sc_b_ins_t.sc-unique-btn-16").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('incluir');
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_format_cnl() {
                if ($("#sc_b_sai_t.sc-unique-btn-3").length && $("#sc_b_sai_t.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        <?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-17").length && $("#sc_b_sai_t.sc-unique-btn-17").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-17").hasClass("disabled")) {
                        return;
                    }
                        <?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_format_alt() {
                if ($("#sc_b_upd_t.sc-unique-btn-4").length && $("#sc_b_upd_t.sc-unique-btn-4").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-4").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_upd_t.sc-unique-btn-18").length && $("#sc_b_upd_t.sc-unique-btn-18").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-18").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_format_exc() {
                if ($("#sc_b_del_t.sc-unique-btn-5").length && $("#sc_b_del_t.sc-unique-btn-5").is(":visible")) {
                    if ($("#sc_b_del_t.sc-unique-btn-5").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('excluir');
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_del_t.sc-unique-btn-19").length && $("#sc_b_del_t.sc-unique-btn-19").is(":visible")) {
                    if ($("#sc_b_del_t.sc-unique-btn-19").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('excluir');
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sc_btn_0() {
                if ($("#sc_sc_btn_0_top").length && $("#sc_sc_btn_0_top").is(":visible")) {
                    if ($("#sc_sc_btn_0_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_sc_btn_0_top").length && $("#sc_sc_btn_0_top").is(":visible")) {
                    if ($("#sc_sc_btn_0_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_sc_btn_0_top").length && $("#sc_sc_btn_0_top").is(":visible")) {
                    if ($("#sc_sc_btn_0_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_sc_btn_0_top").length && $("#sc_sc_btn_0_top").is(":visible")) {
                    if ($("#sc_sc_btn_0_top").hasClass("disabled")) {
                        return;
                    }
                        sc_btn_sc_btn_0()
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_format_hlp() {
                if ($("#sc_b_hlp_t").length && $("#sc_b_hlp_t").is(":visible")) {
                    if ($("#sc_b_hlp_t").hasClass("disabled")) {
                        return;
                    }
                        window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_format_sai() {
                if ($("#sc_b_sai_t.sc-unique-btn-6").length && $("#sc_b_sai_t.sc-unique-btn-6").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-6").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-7").length && $("#sc_b_sai_t.sc-unique-btn-7").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-7").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-8").length && $("#sc_b_sai_t.sc-unique-btn-8").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-8").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-9").length && $("#sc_b_sai_t.sc-unique-btn-9").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-9").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-10").length && $("#sc_b_sai_t.sc-unique-btn-10").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-10").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-20").length && $("#sc_b_sai_t.sc-unique-btn-20").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-20").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-21").length && $("#sc_b_sai_t.sc-unique-btn-21").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-21").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F5('<?php echo $nm_url_saida; ?>');
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-22").length && $("#sc_b_sai_t.sc-unique-btn-22").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-22").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-23").length && $("#sc_b_sai_t.sc-unique-btn-23").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-23").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                        toggleToolbar(event, true); return;
                }
                if ($("#sc_b_sai_t.sc-unique-btn-24").length && $("#sc_b_sai_t.sc-unique-btn-24").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-24").hasClass("disabled")) {
                        return;
                    }
                        scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_GridPermiteSeq(btnPos) {
                if ($("#brec_b").length && $("#brec_b").is(":visible")) {
                    if ($("#brec_b").hasClass("disabled")) {
                        return;
                    }
                        if (document.F1['nmgp_rec_' + btnPos].value != '') {nm_navpage(document.F1['nmgp_rec_' + btnPos].value, 'P');} document.F1['nmgp_rec_' + btnPos].value = '';
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_format_ini() {
                if ($("#sc_b_ini_b.sc-unique-btn-11").length && $("#sc_b_ini_b.sc-unique-btn-11").is(":visible")) {
                    if ($("#sc_b_ini_b.sc-unique-btn-11").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('inicio');
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_format_ret() {
                if ($("#sc_b_ret_b.sc-unique-btn-12").length && $("#sc_b_ret_b.sc-unique-btn-12").is(":visible")) {
                    if ($("#sc_b_ret_b.sc-unique-btn-12").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('retorna');
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_format_ava() {
                if ($("#sc_b_avc_b.sc-unique-btn-13").length && $("#sc_b_avc_b.sc-unique-btn-13").is(":visible")) {
                    if ($("#sc_b_avc_b.sc-unique-btn-13").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('avanca');
                        toggleToolbar(event, true); return;
                }
        }
        function scBtnFn_sys_format_fim() {
                if ($("#sc_b_fim_b.sc-unique-btn-14").length && $("#sc_b_fim_b.sc-unique-btn-14").is(":visible")) {
                    if ($("#sc_b_fim_b.sc-unique-btn-14").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('final');
                        toggleToolbar(event, true); return;
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_transfer_rsvp_mob']['inside_nested_iframe']) {
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
