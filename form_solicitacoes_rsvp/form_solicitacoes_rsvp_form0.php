<?php
class form_solicitacoes_rsvp_form extends form_solicitacoes_rsvp_apl
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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags(""); } else { echo strip_tags(""); } ?></TITLE>
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
if ($this->Embutida_form && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['sc_modal'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['sc_redir_atualiz']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['sc_redir_atualiz'] == 'ok')
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
<?php
           $fixColNotFixedVisibility = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? 'visible' : 'hidden';
           $fixColNotFixedOpacity = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? '1' : '1';
?>
    <style type="text/css">
        .sc-col-actions {
            text-align: center !important;
        }
        .sc-op-fix-col {
            padding: 0 2px;
        }
        .sc-op-fix-col:hover {
            cursor: pointer;
        }
        .sc-op-fix-col-notfixed {
            visibility: <?php echo $fixColNotFixedVisibility ?>;
            opacity: 0.5;
        }
        .scFormLabelOddMult:hover .sc-op-fix-col-notfixed {
            visibility: visible;
            opacity: <?php echo $fixColNotFixedOpacity ?>;
        }
        #sc-fld-fix-col-0 {
            display: none;
        }
    </style>
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
.css_read_off_solicitacao_data_hora_ button {
        background-color: transparent;
        border: 0;
        padding: 0
}
</style>
<?php
}
?>
<?php

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_solicitacoes_rsvp/form_solicitacoes_rsvp_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_solicitacoes_rsvp_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_solicitacoes_rsvp_jquery.php');

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


  scJQGeneralAdd();

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['recarga'];
}
if ('novo' == $opcao_botoes && $this->Embutida_form)
{
    $opcao_botoes = 'inicio';
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['link_info']['remove_border']) {
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
 include_once("form_solicitacoes_rsvp_js0.php");
?>
<script type="text/javascript" src="<?php  echo $this->Ini->path_js . "/jsrsClient.js" ?>"> 
</script> 
<script type="text/javascript"> 
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
<form  name="F1" method="post" 
               action="./" 
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
$_SESSION['scriptcase']['error_span_title']['form_solicitacoes_rsvp'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_solicitacoes_rsvp'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  $this->Tab_width = " ";
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['fast_search'][2] : "";
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
          $SC_Label_atu['solicitacao_status_'] = (isset($this->nm_new_label['solicitacao_status_'])) ? $this->nm_new_label['solicitacao_status_'] : 'Status'; 
          $SC_Label_atu['solicitacao_tipo_'] = (isset($this->nm_new_label['solicitacao_tipo_'])) ? $this->nm_new_label['solicitacao_tipo_'] : 'Tipo'; 
          $SC_Label_atu['solicitacao_obs_'] = (isset($this->nm_new_label['solicitacao_obs_'])) ? $this->nm_new_label['solicitacao_obs_'] : 'Solicitação'; 
          $SC_Label_atu['solicitacao_de_'] = (isset($this->nm_new_label['solicitacao_de_'])) ? $this->nm_new_label['solicitacao_de_'] : 'De'; 
          $SC_Label_atu['solicitacao_para_email_'] = (isset($this->nm_new_label['solicitacao_para_email_'])) ? $this->nm_new_label['solicitacao_para_email_'] : 'Para Email'; 
          $SC_Label_atu['solicitacao_data_'] = (isset($this->nm_new_label['solicitacao_data_'])) ? $this->nm_new_label['solicitacao_data_'] : 'Data'; 
          $SC_Label_atu['solicitacao_hora_'] = (isset($this->nm_new_label['solicitacao_hora_'])) ? $this->nm_new_label['solicitacao_hora_'] : 'Hora'; 
          $SC_Label_atu['solicitacao_ativo_'] = (isset($this->nm_new_label['solicitacao_ativo_'])) ? $this->nm_new_label['solicitacao_ativo_'] : 'Ativo'; 
          $SC_Label_atu['solicitacao_id_evento_'] = (isset($this->nm_new_label['solicitacao_id_evento_'])) ? $this->nm_new_label['solicitacao_id_evento_'] : 'IDE'; 
          $SC_Label_atu['id_solicitacao_'] = (isset($this->nm_new_label['id_solicitacao_'])) ? $this->nm_new_label['id_solicitacao_'] : 'Id Solicitacao'; 
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
    if ($this->Embutida_form) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['new'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['new'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bnovo", "scBtnFn_sys_format_inc()", "scBtnFn_sys_format_inc()", "sc_b_new_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['insert'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['insert'];
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
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['bcancelar'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bcancelar", "scBtnFn_sys_format_cnl()", "scBtnFn_sys_format_cnl()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!isset($this->Grid_editavel) || !$this->Grid_editavel) && (!$this->Embutida_form) && (!$this->Embutida_call || $this->Embutida_multi)) {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-5';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ($opcao_botoes != "novo")) {
        $sCondStyle = ($this->nmgp_botoes['LOG'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['log'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['log']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['log']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['log']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['log']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['log'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R")
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
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['empty_filter'] = true;
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
   $this->form_fixed_column_no = 0;
?>
<?php
   if (!isset($this->nmgp_cmp_hidden['id_solicitacao_']))
   {
       $this->nmgp_cmp_hidden['id_solicitacao_'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['sql_log_']))
   {
       $this->nmgp_cmp_hidden['sql_log_'] = 'off';
   }
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
        $classColFld = "";
        $classColActions = "";
        if (!$this->Embutida_form) {
            $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
            $classColActions = " sc-col-actions";
        }
?>

    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" style="display: none;" <?php echo $Col_span ?>> <?php if (!$this->Embutida_form) { ?><span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span><?php } ?> </TD>
   <?php 
        if (!$this->Embutida_form) { $this->form_fixed_column_no++; }
 ?>
   <?php
        if (!$this->Embutida_form && ($this->nmgp_opcao == 'novo' || ($this->nmgp_botoes['delete'] == "on" || $this->nmgp_botoes['update'] == "on"))) {
            $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
            $classColActions = " sc-col-actions";
?>

    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" style="display: none;" > <?php if (!$this->Embutida_form) { ?><span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span><?php } ?> </TD>
   <?php
            $this->form_fixed_column_no++;
        }
?>

   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] == "on") {
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
        $classColActions = " sc-col-actions";
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>"  width="10"> <span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span> </TD>
   <?php 
        $this->form_fixed_column_no++;
}?>
   <?php if ($this->Embutida_form && $this->nmgp_botoes['insert'] != "on") {
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
        $classColActions = " sc-col-actions";
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>"  width="10"> <span class="sc-op-fix-col sc-op-fix-col-<?php echo $this->form_fixed_column_no ?> sc-op-fix-col-notfixed" data-fixcolid="<?php echo $this->form_fixed_column_no ?>" id="sc-fld-fix-col-<?php echo $this->form_fixed_column_no ?>"><i class="fas fa-thumbtack"></i></span> </TD>
   <?php 
        $this->form_fixed_column_no++;
}?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") { ?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" >  </TD>
   <?php }?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") { ?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult sc-col-title <?php echo $classColFld . $classColActions ?>" >  </TD>
   <?php }?>
   <?php
    $sStyleHidden_solicitacao_icon_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_icon_']) && $this->nmgp_cmp_hidden['solicitacao_icon_'] == 'off') {
        $sStyleHidden_solicitacao_icon_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_icon_']) || $this->nmgp_cmp_hidden['solicitacao_icon_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_icon_'])) {
            $this->nm_new_label['solicitacao_icon_'] = "S";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_icon_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_icon__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_icon_" style="<?php echo $sStyleHidden_solicitacao_icon_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_solicitacao_status_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_status_']) && $this->nmgp_cmp_hidden['solicitacao_status_'] == 'off') {
        $sStyleHidden_solicitacao_status_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_status_']) || $this->nmgp_cmp_hidden['solicitacao_status_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_status_'])) {
            $this->nm_new_label['solicitacao_status_'] = "Status";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_status_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("solicitacao_status", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("solicitacao_status", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_status__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_status__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_status__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_status__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_status__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_status__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'solicitacao_status')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_status__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_status_" style="<?php echo $sStyleHidden_solicitacao_status_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_solicitacao_tipo_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_tipo_']) && $this->nmgp_cmp_hidden['solicitacao_tipo_'] == 'off') {
        $sStyleHidden_solicitacao_tipo_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_tipo_']) || $this->nmgp_cmp_hidden['solicitacao_tipo_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_tipo_'])) {
            $this->nm_new_label['solicitacao_tipo_'] = "Tipo";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_tipo_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("solicitacao_tipo", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("solicitacao_tipo", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_tipo__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_tipo__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_tipo__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_tipo__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_tipo__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_tipo__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'solicitacao_tipo')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_tipo__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_tipo_" style="<?php echo $sStyleHidden_solicitacao_tipo_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_solicitacao_obs_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_obs_']) && $this->nmgp_cmp_hidden['solicitacao_obs_'] == 'off') {
        $sStyleHidden_solicitacao_obs_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_obs_']) || $this->nmgp_cmp_hidden['solicitacao_obs_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_obs_'])) {
            $this->nm_new_label['solicitacao_obs_'] = "Solicitação";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_obs_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("solicitacao_obs", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("solicitacao_obs", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_obs__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_obs__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_obs__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_obs__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_obs__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_obs__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'solicitacao_obs')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_obs__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_obs_" style="<?php echo $sStyleHidden_solicitacao_obs_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_solicitacao_de_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_de_']) && $this->nmgp_cmp_hidden['solicitacao_de_'] == 'off') {
        $sStyleHidden_solicitacao_de_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_de_']) || $this->nmgp_cmp_hidden['solicitacao_de_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_de_'])) {
            $this->nm_new_label['solicitacao_de_'] = "De";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_de_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("solicitacao_de", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("solicitacao_de", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_de__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_de__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_de__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_de__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_de__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_de__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'solicitacao_de')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_de__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_de_" style="<?php echo $sStyleHidden_solicitacao_de_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_solicitacao_para_email_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_para_email_']) && $this->nmgp_cmp_hidden['solicitacao_para_email_'] == 'off') {
        $sStyleHidden_solicitacao_para_email_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_para_email_']) || $this->nmgp_cmp_hidden['solicitacao_para_email_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_para_email_'])) {
            $this->nm_new_label['solicitacao_para_email_'] = "Para Email";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_para_email_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("solicitacao_para_email", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("solicitacao_para_email", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_para_email__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_para_email__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_para_email__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_para_email__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_para_email__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_para_email__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'solicitacao_para_email')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_para_email__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_para_email_" style="<?php echo $sStyleHidden_solicitacao_para_email_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_solicitacao_data_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_data_']) && $this->nmgp_cmp_hidden['solicitacao_data_'] == 'off') {
        $sStyleHidden_solicitacao_data_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_data_']) || $this->nmgp_cmp_hidden['solicitacao_data_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_data_'])) {
            $this->nm_new_label['solicitacao_data_'] = "Data";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_data_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("solicitacao_data", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("solicitacao_data", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_data__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_data__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_data__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_data__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_data__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_data__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'solicitacao_data')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_data__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_data_" style="<?php echo $sStyleHidden_solicitacao_data_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_solicitacao_hora_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_hora_']) && $this->nmgp_cmp_hidden['solicitacao_hora_'] == 'off') {
        $sStyleHidden_solicitacao_hora_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_hora_']) || $this->nmgp_cmp_hidden['solicitacao_hora_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_hora_'])) {
            $this->nm_new_label['solicitacao_hora_'] = "Hora";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_hora_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("solicitacao_hora", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("solicitacao_hora", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_hora__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_hora__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_hora__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_hora__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_hora__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_hora__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'solicitacao_hora')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_hora__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_hora_" style="<?php echo $sStyleHidden_solicitacao_hora_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_usuario_id_ = '';
    if (isset($this->nmgp_cmp_hidden['usuario_id_']) && $this->nmgp_cmp_hidden['usuario_id_'] == 'off') {
        $sStyleHidden_usuario_id_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['usuario_id_']) || $this->nmgp_cmp_hidden['usuario_id_'] == 'on') {
        if (!isset($this->nm_new_label['usuario_id_'])) {
            $this->nm_new_label['usuario_id_'] = "Atendente";
        }
        $SC_Label = "" . $this->nm_new_label['usuario_id_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_usuario_id__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_usuario_id_" style="<?php echo $sStyleHidden_usuario_id_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_solicitacao_ativo_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_ativo_']) && $this->nmgp_cmp_hidden['solicitacao_ativo_'] == 'off') {
        $sStyleHidden_solicitacao_ativo_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_ativo_']) || $this->nmgp_cmp_hidden['solicitacao_ativo_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_ativo_'])) {
            $this->nm_new_label['solicitacao_ativo_'] = "Ativo";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_ativo_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("solicitacao_ativo", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("solicitacao_ativo", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_ativo__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_ativo__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_ativo__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_ativo__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_ativo__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_ativo__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'solicitacao_ativo')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_ativo__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_ativo_" style="<?php echo $sStyleHidden_solicitacao_ativo_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_ativo_ = '';
    if (isset($this->nmgp_cmp_hidden['ativo_']) && $this->nmgp_cmp_hidden['ativo_'] == 'off') {
        $sStyleHidden_ativo_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['ativo_']) || $this->nmgp_cmp_hidden['ativo_'] == 'on') {
        if (!isset($this->nm_new_label['ativo_'])) {
            $this->nm_new_label['ativo_'] = "";
        }
        $SC_Label = "" . $this->nm_new_label['ativo_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_ativo__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_ativo_" style="<?php echo $sStyleHidden_ativo_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_solicitacao_id_evento_ = '';
    if (isset($this->nmgp_cmp_hidden['solicitacao_id_evento_']) && $this->nmgp_cmp_hidden['solicitacao_id_evento_'] == 'off') {
        $sStyleHidden_solicitacao_id_evento_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['solicitacao_id_evento_']) || $this->nmgp_cmp_hidden['solicitacao_id_evento_'] == 'on') {
        if (!isset($this->nm_new_label['solicitacao_id_evento_'])) {
            $this->nm_new_label['solicitacao_id_evento_'] = "IDE";
        }
        $SC_Label = "" . $this->nm_new_label['solicitacao_id_evento_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $fieldSortRule = $this->scGetColumnOrderRule("solicitacao_id_evento", $orderColName, $orderColOrient, $orderColRule);
        $fieldSortIcon = $this->scGetColumnOrderIcon("solicitacao_id_evento", $fieldSortRule);

        if (empty($this->Ini->Label_sort_pos)) {
            $this->Ini->Label_sort_pos = "right_field";
        }

        if (empty($fieldSortIcon)) {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_id_evento__label\">" . $label_fieldName . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\"><div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_id_evento__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_field') {
            $label_labelContent = "<div style=\"display: flex" . $divLabelStyle . "\">" . $fieldSortIcon . "\<div style=\"display: flex; white-space: nowrap\" class=\"css_solicitacao_id_evento__label\">" . $label_fieldName . "</div></div>";
        } elseif ($this->Ini->Label_sort_pos == 'right_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\"><div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_id_evento__label\">" . $label_fieldName . "</div>" . $fieldSortIcon . "</div>";
        } elseif ($this->Ini->Label_sort_pos == 'left_cell') {
            $label_labelContent = "<div style=\"display: flex; justify-content: space-between\">" . $fieldSortIcon . "<div style=\"display: flex; flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_id_evento__label\">" . $label_fieldName . "</div></div>";
        } else {
            $label_labelContent = "<div style=\"flex-grow: 1; white-space: nowrap" . $divLabelStyle . "\" class=\"css_solicitacao_id_evento__label\">" . $label_fieldName . "</div>";
        }
        $label_labelContent = "<a href=\"javascript:nm_move('ordem', 'solicitacao_id_evento')\" class=\"scFormLabelLink scFormLabelLinkOddMult\">" . $label_labelContent . "</a>";
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_solicitacao_id_evento__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_solicitacao_id_evento_" style="<?php echo $sStyleHidden_solicitacao_id_evento_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_cpf_del_ = '';
    if (isset($this->nmgp_cmp_hidden['cpf_del_']) && $this->nmgp_cmp_hidden['cpf_del_'] == 'off') {
        $sStyleHidden_cpf_del_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['cpf_del_']) || $this->nmgp_cmp_hidden['cpf_del_'] == 'on') {
        if (!isset($this->nm_new_label['cpf_del_'])) {
            $this->nm_new_label['cpf_del_'] = "cpf_del";
        }
        $SC_Label = "" . $this->nm_new_label['cpf_del_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_cpf_del__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_cpf_del_" style="<?php echo $sStyleHidden_cpf_del_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php
    $sStyleHidden_sql_log_ = '';
    if (isset($this->nmgp_cmp_hidden['sql_log_']) && $this->nmgp_cmp_hidden['sql_log_'] == 'off') {
        $sStyleHidden_sql_log_ = 'display: none';
    }
    if (1 || !isset($this->nmgp_cmp_hidden['sql_log_']) || $this->nmgp_cmp_hidden['sql_log_'] == 'on') {
        if (!isset($this->nm_new_label['sql_log_'])) {
            $this->nm_new_label['sql_log_'] = "sql_log";
        }
        $SC_Label = "" . $this->nm_new_label['sql_log_']  . "";
        $label_fieldName = nl2br($SC_Label);

        // label & order
        $divLabelStyle = '; justify-content: left';
        $label_labelContent = $label_fieldName;
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_chart . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_sql_log__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_sql_log_" style="<?php echo $sStyleHidden_sql_log_; ?>" > <?php echo $label_final ?> </TD>
   <?php
        $this->form_fixed_column_no++;
    }
?>

   <?php if ((!isset($this->nmgp_cmp_hidden['id_solicitacao_']) || $this->nmgp_cmp_hidden['id_solicitacao_'] == 'on') && ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir"))) { 
      if (!isset($this->nm_new_label['id_solicitacao_'])) {
          $this->nm_new_label['id_solicitacao_'] = "Id Solicitacao"; } ?>
<?php
        $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;

        // label
        $label_labelContent = $this->nm_new_label['id_solicitacao_'];
        $label_divLabel = "<div style=\"flex-grow: 1\">". $label_labelContent . "</div>";

        // controls
        $label_fixedColumn = "<span class=\"sc-op-fix-col sc-op-fix-col-" . $this->form_fixed_column_no . " sc-op-fix-col-notfixed\" data-fixcolid=\"" . $this->form_fixed_column_no . "\" id=\"sc-fld-fix-col-" . $this->form_fixed_column_no . "\"><i class=\"fas fa-thumbtack\"></i></span>";
        $label_divControl = '<div style="display: flex; flex-wrap: nowrap; align-items: baseline">' . $label_fixedColumn . '</div>';

        // final label
        $label_final = '<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: space-between; align-items: baseline">' . $label_divLabel . $label_divControl . '</div>';
?>

    <TD class="<?php echo $this->css_inherit_bg . ' ' ?>scFormLabelOddMult css_id_solicitacao__label sc-col-title <?php echo $classColFld ?>" id="hidden_field_label_id_solicitacao_" style="<?php echo $sStyleHidden_id_solicitacao_; ?>" > <?php echo $label_final ?> </TD>
   <?php $this->form_fixed_column_no++;}?>





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
       $iStart = sizeof($this->form_vert_form_solicitacoes_rsvp);
       $guarda_nmgp_opcao = $this->nmgp_opcao;
       $guarda_form_vert_form_solicitacoes_rsvp = $this->form_vert_form_solicitacoes_rsvp;
       $this->nmgp_opcao = 'novo';
   } 
   if ($this->Embutida_form && empty($this->form_vert_form_solicitacoes_rsvp))
   {
       $sc_seq_vert = 0;
   }
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['id_solicitacao_']))
           {
               $this->nmgp_cmp_readonly['id_solicitacao_'] = 'on';
           }
   foreach ($this->form_vert_form_solicitacoes_rsvp as $sc_seq_vert => $sc_lixo)
   {
       $this->form_fixed_column_no = 0;
       $this->loadRecordState($sc_seq_vert);
       $this->solicitacao_usuario_id_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_usuario_id_'];
       $this->solicitacao_cpf_participante_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_cpf_participante_'];
       $this->solicitacao_data_hora_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_data_hora_'];
       $this->solicitacao_tipo_part_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_tipo_part_'];
       $this->cabecalho_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['cabecalho_'];
       $this->rodape_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['rodape_'];
       $this->usuario_nivel_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['usuario_nivel_'];
       if (isset($this->Embutida_ronly) && $this->Embutida_ronly && !$Line_Add)
       {
           $this->nmgp_cmp_readonly['solicitacao_icon_'] = true;
           $this->nmgp_cmp_readonly['solicitacao_status_'] = true;
           $this->nmgp_cmp_readonly['solicitacao_tipo_'] = true;
           $this->nmgp_cmp_readonly['solicitacao_obs_'] = true;
           $this->nmgp_cmp_readonly['solicitacao_de_'] = true;
           $this->nmgp_cmp_readonly['solicitacao_para_email_'] = true;
           $this->nmgp_cmp_readonly['solicitacao_data_'] = true;
           $this->nmgp_cmp_readonly['solicitacao_hora_'] = true;
           $this->nmgp_cmp_readonly['usuario_id_'] = true;
           $this->nmgp_cmp_readonly['solicitacao_ativo_'] = true;
           $this->nmgp_cmp_readonly['ativo_'] = true;
           $this->nmgp_cmp_readonly['solicitacao_id_evento_'] = true;
           $this->nmgp_cmp_readonly['cpf_del_'] = true;
           $this->nmgp_cmp_readonly['sql_log_'] = true;
           $this->nmgp_cmp_readonly['id_solicitacao_'] = true;
       }
       elseif ($Line_Add)
       {
           if (!isset($this->nmgp_cmp_readonly['solicitacao_icon_']) || $this->nmgp_cmp_readonly['solicitacao_icon_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_icon_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['solicitacao_status_']) || $this->nmgp_cmp_readonly['solicitacao_status_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_status_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['solicitacao_tipo_']) || $this->nmgp_cmp_readonly['solicitacao_tipo_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_tipo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['solicitacao_obs_']) || $this->nmgp_cmp_readonly['solicitacao_obs_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_obs_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['solicitacao_de_']) || $this->nmgp_cmp_readonly['solicitacao_de_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_de_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['solicitacao_para_email_']) || $this->nmgp_cmp_readonly['solicitacao_para_email_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_para_email_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['solicitacao_data_']) || $this->nmgp_cmp_readonly['solicitacao_data_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_data_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['solicitacao_hora_']) || $this->nmgp_cmp_readonly['solicitacao_hora_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_hora_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['usuario_id_']) || $this->nmgp_cmp_readonly['usuario_id_'] != "on") {$this->nmgp_cmp_readonly['usuario_id_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['solicitacao_ativo_']) || $this->nmgp_cmp_readonly['solicitacao_ativo_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_ativo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['ativo_']) || $this->nmgp_cmp_readonly['ativo_'] != "on") {$this->nmgp_cmp_readonly['ativo_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['solicitacao_id_evento_']) || $this->nmgp_cmp_readonly['solicitacao_id_evento_'] != "on") {$this->nmgp_cmp_readonly['solicitacao_id_evento_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['cpf_del_']) || $this->nmgp_cmp_readonly['cpf_del_'] != "on") {$this->nmgp_cmp_readonly['cpf_del_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['sql_log_']) || $this->nmgp_cmp_readonly['sql_log_'] != "on") {$this->nmgp_cmp_readonly['sql_log_'] = false;}
           if (!isset($this->nmgp_cmp_readonly['id_solicitacao_']) || $this->nmgp_cmp_readonly['id_solicitacao_'] != "on") {$this->nmgp_cmp_readonly['id_solicitacao_'] = false;}
       }
            if (isset($this->form_vert_form_preenchimento[$sc_seq_vert])) {
              foreach ($this->form_vert_form_preenchimento[$sc_seq_vert] as $sCmpNome => $mCmpVal)
              {
                  eval("\$this->" . $sCmpNome . " = \$mCmpVal;");
              }
            }
        $this->solicitacao_icon_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_icon_']; 
       if (empty($this->solicitacao_icon_))
       {
           $this->solicitacao_icon_ = "";
       }
       $solicitacao_icon_ = $this->solicitacao_icon_; 
       $sStyleHidden_solicitacao_icon_ = '';
       if (isset($sCheckRead_solicitacao_icon_))
       {
           unset($sCheckRead_solicitacao_icon_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_icon_']))
       {
           $sCheckRead_solicitacao_icon_ = $this->nmgp_cmp_readonly['solicitacao_icon_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_icon_']) && $this->nmgp_cmp_hidden['solicitacao_icon_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_icon_']);
           $sStyleHidden_solicitacao_icon_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_icon_ = true;
       $sStyleReadLab_solicitacao_icon_ = 'display: none;';
       $sStyleReadInp_solicitacao_icon_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_icon_']) && $this->nmgp_cmp_readonly['solicitacao_icon_'] == 'on')
       {
           $bTestReadOnly_solicitacao_icon_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_icon_']);
           $sStyleReadLab_solicitacao_icon_ = '';
           $sStyleReadInp_solicitacao_icon_ = 'display: none;';
       }
       $this->solicitacao_status_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_status_']; 
       $solicitacao_status_ = $this->solicitacao_status_; 
       $sStyleHidden_solicitacao_status_ = '';
       if (isset($sCheckRead_solicitacao_status_))
       {
           unset($sCheckRead_solicitacao_status_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_status_']))
       {
           $sCheckRead_solicitacao_status_ = $this->nmgp_cmp_readonly['solicitacao_status_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_status_']) && $this->nmgp_cmp_hidden['solicitacao_status_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_status_']);
           $sStyleHidden_solicitacao_status_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_status_ = true;
       $sStyleReadLab_solicitacao_status_ = 'display: none;';
       $sStyleReadInp_solicitacao_status_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_status_']) && $this->nmgp_cmp_readonly['solicitacao_status_'] == 'on')
       {
           $bTestReadOnly_solicitacao_status_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_status_']);
           $sStyleReadLab_solicitacao_status_ = '';
           $sStyleReadInp_solicitacao_status_ = 'display: none;';
       }
       $this->solicitacao_tipo_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_tipo_']; 
       $solicitacao_tipo_ = $this->solicitacao_tipo_; 
       $sStyleHidden_solicitacao_tipo_ = '';
       if (isset($sCheckRead_solicitacao_tipo_))
       {
           unset($sCheckRead_solicitacao_tipo_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_tipo_']))
       {
           $sCheckRead_solicitacao_tipo_ = $this->nmgp_cmp_readonly['solicitacao_tipo_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_tipo_']) && $this->nmgp_cmp_hidden['solicitacao_tipo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_tipo_']);
           $sStyleHidden_solicitacao_tipo_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_tipo_ = true;
       $sStyleReadLab_solicitacao_tipo_ = 'display: none;';
       $sStyleReadInp_solicitacao_tipo_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_tipo_']) && $this->nmgp_cmp_readonly['solicitacao_tipo_'] == 'on')
       {
           $bTestReadOnly_solicitacao_tipo_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_tipo_']);
           $sStyleReadLab_solicitacao_tipo_ = '';
           $sStyleReadInp_solicitacao_tipo_ = 'display: none;';
       }
       $this->solicitacao_obs_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_obs_']; 
       $solicitacao_obs_ = $this->solicitacao_obs_; 
       $solicitacao_obs__tmp = str_replace(array('\r\n', '\n\r', '\n', '\r'), array("\r\n", "\n\r", "\n", "\r"), $solicitacao_obs_);
       $solicitacao_obs__val = $solicitacao_obs__tmp;
       $sStyleHidden_solicitacao_obs_ = '';
       if (isset($sCheckRead_solicitacao_obs_))
       {
           unset($sCheckRead_solicitacao_obs_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_obs_']))
       {
           $sCheckRead_solicitacao_obs_ = $this->nmgp_cmp_readonly['solicitacao_obs_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_obs_']) && $this->nmgp_cmp_hidden['solicitacao_obs_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_obs_']);
           $sStyleHidden_solicitacao_obs_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_obs_ = true;
       $sStyleReadLab_solicitacao_obs_ = 'display: none;';
       $sStyleReadInp_solicitacao_obs_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_obs_']) && $this->nmgp_cmp_readonly['solicitacao_obs_'] == 'on')
       {
           $bTestReadOnly_solicitacao_obs_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_obs_']);
           $sStyleReadLab_solicitacao_obs_ = '';
           $sStyleReadInp_solicitacao_obs_ = 'display: none;';
       }
       $this->solicitacao_de_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_de_']; 
       $solicitacao_de_ = $this->solicitacao_de_; 
       $sStyleHidden_solicitacao_de_ = '';
       if (isset($sCheckRead_solicitacao_de_))
       {
           unset($sCheckRead_solicitacao_de_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_de_']))
       {
           $sCheckRead_solicitacao_de_ = $this->nmgp_cmp_readonly['solicitacao_de_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_de_']) && $this->nmgp_cmp_hidden['solicitacao_de_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_de_']);
           $sStyleHidden_solicitacao_de_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_de_ = true;
       $sStyleReadLab_solicitacao_de_ = 'display: none;';
       $sStyleReadInp_solicitacao_de_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_de_']) && $this->nmgp_cmp_readonly['solicitacao_de_'] == 'on')
       {
           $bTestReadOnly_solicitacao_de_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_de_']);
           $sStyleReadLab_solicitacao_de_ = '';
           $sStyleReadInp_solicitacao_de_ = 'display: none;';
       }
       $this->solicitacao_para_email_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_para_email_']; 
       $solicitacao_para_email_ = $this->solicitacao_para_email_; 
       $sStyleHidden_solicitacao_para_email_ = '';
       if (isset($sCheckRead_solicitacao_para_email_))
       {
           unset($sCheckRead_solicitacao_para_email_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_para_email_']))
       {
           $sCheckRead_solicitacao_para_email_ = $this->nmgp_cmp_readonly['solicitacao_para_email_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_para_email_']) && $this->nmgp_cmp_hidden['solicitacao_para_email_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_para_email_']);
           $sStyleHidden_solicitacao_para_email_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_para_email_ = true;
       $sStyleReadLab_solicitacao_para_email_ = 'display: none;';
       $sStyleReadInp_solicitacao_para_email_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_para_email_']) && $this->nmgp_cmp_readonly['solicitacao_para_email_'] == 'on')
       {
           $bTestReadOnly_solicitacao_para_email_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_para_email_']);
           $sStyleReadLab_solicitacao_para_email_ = '';
           $sStyleReadInp_solicitacao_para_email_ = 'display: none;';
       }
       $this->solicitacao_data_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_data_']; 
       $solicitacao_data_ = $this->solicitacao_data_; 
       $sStyleHidden_solicitacao_data_ = '';
       if (isset($sCheckRead_solicitacao_data_))
       {
           unset($sCheckRead_solicitacao_data_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_data_']))
       {
           $sCheckRead_solicitacao_data_ = $this->nmgp_cmp_readonly['solicitacao_data_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_data_']) && $this->nmgp_cmp_hidden['solicitacao_data_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_data_']);
           $sStyleHidden_solicitacao_data_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_data_ = true;
       $sStyleReadLab_solicitacao_data_ = 'display: none;';
       $sStyleReadInp_solicitacao_data_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_data_']) && $this->nmgp_cmp_readonly['solicitacao_data_'] == 'on')
       {
           $bTestReadOnly_solicitacao_data_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_data_']);
           $sStyleReadLab_solicitacao_data_ = '';
           $sStyleReadInp_solicitacao_data_ = 'display: none;';
       }
       $this->solicitacao_hora_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_hora_']; 
       $solicitacao_hora_ = $this->solicitacao_hora_; 
       $sStyleHidden_solicitacao_hora_ = '';
       if (isset($sCheckRead_solicitacao_hora_))
       {
           unset($sCheckRead_solicitacao_hora_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_hora_']))
       {
           $sCheckRead_solicitacao_hora_ = $this->nmgp_cmp_readonly['solicitacao_hora_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_hora_']) && $this->nmgp_cmp_hidden['solicitacao_hora_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_hora_']);
           $sStyleHidden_solicitacao_hora_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_hora_ = true;
       $sStyleReadLab_solicitacao_hora_ = 'display: none;';
       $sStyleReadInp_solicitacao_hora_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_hora_']) && $this->nmgp_cmp_readonly['solicitacao_hora_'] == 'on')
       {
           $bTestReadOnly_solicitacao_hora_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_hora_']);
           $sStyleReadLab_solicitacao_hora_ = '';
           $sStyleReadInp_solicitacao_hora_ = 'display: none;';
       }
       $this->usuario_id_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['usuario_id_']; 
       $usuario_id_ = $this->usuario_id_; 
       $sStyleHidden_usuario_id_ = '';
       if (isset($sCheckRead_usuario_id_))
       {
           unset($sCheckRead_usuario_id_);
       }
       if (isset($this->nmgp_cmp_readonly['usuario_id_']))
       {
           $sCheckRead_usuario_id_ = $this->nmgp_cmp_readonly['usuario_id_'];
       }
       if (isset($this->nmgp_cmp_hidden['usuario_id_']) && $this->nmgp_cmp_hidden['usuario_id_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['usuario_id_']);
           $sStyleHidden_usuario_id_ = 'display: none;';
       }
       $bTestReadOnly_usuario_id_ = true;
       $sStyleReadLab_usuario_id_ = 'display: none;';
       $sStyleReadInp_usuario_id_ = '';
       if (isset($this->nmgp_cmp_readonly['usuario_id_']) && $this->nmgp_cmp_readonly['usuario_id_'] == 'on')
       {
           $bTestReadOnly_usuario_id_ = false;
           unset($this->nmgp_cmp_readonly['usuario_id_']);
           $sStyleReadLab_usuario_id_ = '';
           $sStyleReadInp_usuario_id_ = 'display: none;';
       }
       $this->solicitacao_ativo_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_ativo_']; 
       $solicitacao_ativo_ = $this->solicitacao_ativo_; 
       $sStyleHidden_solicitacao_ativo_ = '';
       if (isset($sCheckRead_solicitacao_ativo_))
       {
           unset($sCheckRead_solicitacao_ativo_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_ativo_']))
       {
           $sCheckRead_solicitacao_ativo_ = $this->nmgp_cmp_readonly['solicitacao_ativo_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_ativo_']) && $this->nmgp_cmp_hidden['solicitacao_ativo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_ativo_']);
           $sStyleHidden_solicitacao_ativo_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_ativo_ = true;
       $sStyleReadLab_solicitacao_ativo_ = 'display: none;';
       $sStyleReadInp_solicitacao_ativo_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_ativo_']) && $this->nmgp_cmp_readonly['solicitacao_ativo_'] == 'on')
       {
           $bTestReadOnly_solicitacao_ativo_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_ativo_']);
           $sStyleReadLab_solicitacao_ativo_ = '';
           $sStyleReadInp_solicitacao_ativo_ = 'display: none;';
       }
       $this->ativo_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['ativo_']; 
       if (empty($this->ativo_))
       {
           $this->ativo_ = "";
       }
       $ativo_ = $this->ativo_; 
       $sStyleHidden_ativo_ = '';
       if (isset($sCheckRead_ativo_))
       {
           unset($sCheckRead_ativo_);
       }
       if (isset($this->nmgp_cmp_readonly['ativo_']))
       {
           $sCheckRead_ativo_ = $this->nmgp_cmp_readonly['ativo_'];
       }
       if (isset($this->nmgp_cmp_hidden['ativo_']) && $this->nmgp_cmp_hidden['ativo_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['ativo_']);
           $sStyleHidden_ativo_ = 'display: none;';
       }
       $bTestReadOnly_ativo_ = true;
       $sStyleReadLab_ativo_ = 'display: none;';
       $sStyleReadInp_ativo_ = '';
       if (isset($this->nmgp_cmp_readonly['ativo_']) && $this->nmgp_cmp_readonly['ativo_'] == 'on')
       {
           $bTestReadOnly_ativo_ = false;
           unset($this->nmgp_cmp_readonly['ativo_']);
           $sStyleReadLab_ativo_ = '';
           $sStyleReadInp_ativo_ = 'display: none;';
       }
       $this->solicitacao_id_evento_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['solicitacao_id_evento_']; 
       $solicitacao_id_evento_ = $this->solicitacao_id_evento_; 
       $sStyleHidden_solicitacao_id_evento_ = '';
       if (isset($sCheckRead_solicitacao_id_evento_))
       {
           unset($sCheckRead_solicitacao_id_evento_);
       }
       if (isset($this->nmgp_cmp_readonly['solicitacao_id_evento_']))
       {
           $sCheckRead_solicitacao_id_evento_ = $this->nmgp_cmp_readonly['solicitacao_id_evento_'];
       }
       if (isset($this->nmgp_cmp_hidden['solicitacao_id_evento_']) && $this->nmgp_cmp_hidden['solicitacao_id_evento_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['solicitacao_id_evento_']);
           $sStyleHidden_solicitacao_id_evento_ = 'display: none;';
       }
       $bTestReadOnly_solicitacao_id_evento_ = true;
       $sStyleReadLab_solicitacao_id_evento_ = 'display: none;';
       $sStyleReadInp_solicitacao_id_evento_ = '';
       if (isset($this->nmgp_cmp_readonly['solicitacao_id_evento_']) && $this->nmgp_cmp_readonly['solicitacao_id_evento_'] == 'on')
       {
           $bTestReadOnly_solicitacao_id_evento_ = false;
           unset($this->nmgp_cmp_readonly['solicitacao_id_evento_']);
           $sStyleReadLab_solicitacao_id_evento_ = '';
           $sStyleReadInp_solicitacao_id_evento_ = 'display: none;';
       }
       $this->cpf_del_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['cpf_del_']; 
       $cpf_del_ = $this->cpf_del_; 
       $sStyleHidden_cpf_del_ = '';
       if (isset($sCheckRead_cpf_del_))
       {
           unset($sCheckRead_cpf_del_);
       }
       if (isset($this->nmgp_cmp_readonly['cpf_del_']))
       {
           $sCheckRead_cpf_del_ = $this->nmgp_cmp_readonly['cpf_del_'];
       }
       if (isset($this->nmgp_cmp_hidden['cpf_del_']) && $this->nmgp_cmp_hidden['cpf_del_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['cpf_del_']);
           $sStyleHidden_cpf_del_ = 'display: none;';
       }
       $bTestReadOnly_cpf_del_ = true;
       $sStyleReadLab_cpf_del_ = 'display: none;';
       $sStyleReadInp_cpf_del_ = '';
       if (isset($this->nmgp_cmp_readonly['cpf_del_']) && $this->nmgp_cmp_readonly['cpf_del_'] == 'on')
       {
           $bTestReadOnly_cpf_del_ = false;
           unset($this->nmgp_cmp_readonly['cpf_del_']);
           $sStyleReadLab_cpf_del_ = '';
           $sStyleReadInp_cpf_del_ = 'display: none;';
       }
       $this->sql_log_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['sql_log_']; 
       $sql_log_ = $this->sql_log_; 
       $sql_log__tmp = str_replace(array('\r\n', '\n\r', '\n', '\r'), array("\r\n", "\n\r", "\n", "\r"), $sql_log_);
       $sql_log__val = $sql_log__tmp;
       if (!isset($this->nmgp_cmp_hidden['sql_log_']))
       {
           $this->nmgp_cmp_hidden['sql_log_'] = 'off';
       }
       $sStyleHidden_sql_log_ = '';
       if (isset($sCheckRead_sql_log_))
       {
           unset($sCheckRead_sql_log_);
       }
       if (isset($this->nmgp_cmp_readonly['sql_log_']))
       {
           $sCheckRead_sql_log_ = $this->nmgp_cmp_readonly['sql_log_'];
       }
       if (isset($this->nmgp_cmp_hidden['sql_log_']) && $this->nmgp_cmp_hidden['sql_log_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['sql_log_']);
           $sStyleHidden_sql_log_ = 'display: none;';
       }
       $bTestReadOnly_sql_log_ = true;
       $sStyleReadLab_sql_log_ = 'display: none;';
       $sStyleReadInp_sql_log_ = '';
       if (isset($this->nmgp_cmp_readonly['sql_log_']) && $this->nmgp_cmp_readonly['sql_log_'] == 'on')
       {
           $bTestReadOnly_sql_log_ = false;
           unset($this->nmgp_cmp_readonly['sql_log_']);
           $sStyleReadLab_sql_log_ = '';
           $sStyleReadInp_sql_log_ = 'display: none;';
       }
       $this->id_solicitacao_ = $this->form_vert_form_solicitacoes_rsvp[$sc_seq_vert]['id_solicitacao_']; 
       $id_solicitacao_ = $this->id_solicitacao_; 
       if (!isset($this->nmgp_cmp_hidden['id_solicitacao_']))
       {
           $this->nmgp_cmp_hidden['id_solicitacao_'] = 'off';
       }
       $sStyleHidden_id_solicitacao_ = '';
       if (isset($sCheckRead_id_solicitacao_))
       {
           unset($sCheckRead_id_solicitacao_);
       }
       if (isset($this->nmgp_cmp_readonly['id_solicitacao_']))
       {
           $sCheckRead_id_solicitacao_ = $this->nmgp_cmp_readonly['id_solicitacao_'];
       }
       if (isset($this->nmgp_cmp_hidden['id_solicitacao_']) && $this->nmgp_cmp_hidden['id_solicitacao_'] == 'off')
       {
           unset($this->nmgp_cmp_hidden['id_solicitacao_']);
           $sStyleHidden_id_solicitacao_ = 'display: none;';
       }
       $bTestReadOnly_id_solicitacao_ = true;
       $sStyleReadLab_id_solicitacao_ = 'display: none;';
       $sStyleReadInp_id_solicitacao_ = '';
       if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["id_solicitacao_"]) &&  $this->nmgp_cmp_readonly["id_solicitacao_"] == "on"))
       {
           $bTestReadOnly_id_solicitacao_ = false;
           unset($this->nmgp_cmp_readonly['id_solicitacao_']);
           $sStyleReadLab_id_solicitacao_ = '';
           $sStyleReadInp_id_solicitacao_ = 'display: none;';
       }

       $this->lookup_usuario_id_($look_rpc_usuario_id_);
       $nm_cor_fun_vert = (isset($nm_cor_fun_vert) && $nm_cor_fun_vert == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
       $nm_img_fun_cel  = (isset($nm_img_fun_cel)  && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);

       $sHideNewLine = '';
?>   
   <tr id="idVertRow<?php echo $sc_seq_vert; ?>"<?php echo $sHideNewLine; ?> class="sc-row" data-sc-row-number="<?php echo $sc_seq_vert; ?>">


   <?php
        if (!$this->Embutida_form) {
            $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>"  id="hidden_field_data_sc_seq<?php echo $sc_seq_vert; ?>"  style="display: none;"> <?php echo $sc_seq_vert; ?> </TD>
   <?php
            $this->form_fixed_column_no++;
        }
?>

   <?php if (!$this->Embutida_form && $this->nmgp_opcao != "novo" && $this->nmgp_botoes['delete'] == "on") {
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\""; if (in_array($sc_seq_vert, $sc_check_excl)) { echo " checked";} ?> onclick="if (this.checked) {sc_quant_excl++; } else {sc_quant_excl--; }" class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php 
       $this->form_fixed_column_no++;
}?>
   <?php if (!$this->Embutida_form && $this->nmgp_opcao == "novo") {
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>" > 
<input type="checkbox" name="sc_check_vert[<?php echo $sc_seq_vert ?>]" value="<?php echo $sc_seq_vert . "\"" ; if (in_array($sc_seq_vert, $sc_check_incl) || !empty($this->nm_todas_criticas)) { echo " checked ";} ?> class="sc-js-input" alt="{type: 'checkbox', enterTab: false}"> </TD>
   <?php 
       $this->form_fixed_column_no++;
}?>
   <?php if ($this->Embutida_form) {
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
    <TD  class="<?php echo $this->css_inherit_bg . ' ' ?>scFormDataOddMult <?php echo $classColFld ?>"  id="hidden_field_data_sc_actions<?php echo $sc_seq_vert; ?>" NOWRAP> <?php if ($this->nmgp_opcao != "novo") {
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
<?php echo nmButtonOutput($this->arr_buttons, "bmd_novo", "do_ajax_form_solicitacoes_rsvp_add_new_line(" . $sc_seq_vert . ")", "do_ajax_form_solicitacoes_rsvp_add_new_line(" . $sc_seq_vert . ")", "sc_new_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php }?>
<?php
  $Style_add_line = (!$Line_Add) ? "display: none" : "";
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_solicitacoes_rsvp_cancel_insert(" . $sc_seq_vert . ")", "do_ajax_form_solicitacoes_rsvp_cancel_insert(" . $sc_seq_vert . ")", "sc_canceli_line_" . $sc_seq_vert . "", "", "", "" . $Style_add_line . "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php echo nmButtonOutput($this->arr_buttons, "bmd_cancelar", "do_ajax_form_solicitacoes_rsvp_cancel_update(" . $sc_seq_vert . ")", "do_ajax_form_solicitacoes_rsvp_cancel_update(" . $sc_seq_vert . ")", "sc_cancelu_line_" . $sc_seq_vert . "", "", "", "display: none", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
 </TD>
   <?php 
       $this->form_fixed_column_no++;
}?>
   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_icon_']) && $this->nmgp_cmp_hidden['solicitacao_icon_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="solicitacao_icon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_icon_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_icon__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_icon_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_icon_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_icon__line" style="vertical-align: top;padding: 0px"><span id="id_read_on_solicitacao_icon_<?php echo $sc_seq_vert ?> class="css_solicitacao_icon__line" style="<?php echo $sStyleReadLab_solicitacao_icon_; ?>"><?php echo $fieldContent; ?></span><span id="id_ajax_label_solicitacao_icon_<?php echo $sc_seq_vert ?>" class="css_read_off_solicitacao_icon_" ><span id="id_ajax_label_solicitacao_icon_<?php echo $sc_seq_vert; ?>"><?php echo $solicitacao_icon_?></span>
</span><input type="hidden" name="solicitacao_icon_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_icon_); ?>">
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_icon_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_icon_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_status_']) && $this->nmgp_cmp_hidden['solicitacao_status_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="solicitacao_status_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->solicitacao_status_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_status__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_status_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_status_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_status__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_solicitacao_status_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["solicitacao_status_"]) &&  $this->nmgp_cmp_readonly["solicitacao_status_"] == "on") { 

$solicitacao_status__look = "";
 if ($this->solicitacao_status_ == "A") { $solicitacao_status__look .= "Aberto" ;} 
 if ($this->solicitacao_status_ == "Y") { $solicitacao_status__look .= "Sim" ;} 
 if ($this->solicitacao_status_ == "N") { $solicitacao_status__look .= "Não" ;} 
 if ($this->solicitacao_status_ == "P") { $solicitacao_status__look .= "Pendente" ;} 
 if (empty($solicitacao_status__look)) { $solicitacao_status__look = $this->solicitacao_status_; }
?>
<input type="hidden" name="solicitacao_status_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_status_) . "\">" . $solicitacao_status__look . ""; ?>
<?php } else { ?>
<?php

$solicitacao_status__look = "";
 if ($this->solicitacao_status_ == "A") { $solicitacao_status__look .= "Aberto" ;} 
 if ($this->solicitacao_status_ == "Y") { $solicitacao_status__look .= "Sim" ;} 
 if ($this->solicitacao_status_ == "N") { $solicitacao_status__look .= "Não" ;} 
 if ($this->solicitacao_status_ == "P") { $solicitacao_status__look .= "Pendente" ;} 
 if (empty($solicitacao_status__look)) { $solicitacao_status__look = $this->solicitacao_status_; }
?>
<span id="id_read_on_solicitacao_status_<?php echo $sc_seq_vert ; ?>" class="css_solicitacao_status__line"  style="<?php echo $sStyleReadLab_solicitacao_status_; ?>"><?php echo $this->form_format_readonly("solicitacao_status_", $this->form_encode_input($solicitacao_status__look)); ?></span><span id="id_read_off_solicitacao_status_<?php echo $sc_seq_vert ; ?>" class="css_read_off_solicitacao_status_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_solicitacao_status_; ?>">
 <span id="idAjaxSelect_solicitacao_status_<?php echo $sc_seq_vert ?>" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOddMult css_solicitacao_status__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_solicitacao_status_<?php echo $sc_seq_vert ?>" name="solicitacao_status_<?php echo $sc_seq_vert ?>" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="A" <?php  if ($this->solicitacao_status_ == "A") { echo " selected" ;} ?><?php  if (empty($this->solicitacao_status_)) { echo " selected" ;} ?>>Aberto</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_status_'][] = 'A'; ?>
 <option  value="Y" <?php  if ($this->solicitacao_status_ == "Y") { echo " selected" ;} ?>>Sim</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_status_'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->solicitacao_status_ == "N") { echo " selected" ;} ?>>Não</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_status_'][] = 'N'; ?>
 <option  value="P" <?php  if ($this->solicitacao_status_ == "P") { echo " selected" ;} ?>>Pendente</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_status_'][] = 'P'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_status_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_status_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_tipo_']) && $this->nmgp_cmp_hidden['solicitacao_tipo_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="solicitacao_tipo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->solicitacao_tipo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_tipo__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_tipo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_tipo_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_tipo__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_solicitacao_tipo_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["solicitacao_tipo_"]) &&  $this->nmgp_cmp_readonly["solicitacao_tipo_"] == "on") { 

$solicitacao_tipo__look = "";
 if ($this->solicitacao_tipo_ == "ACOMPANHANTE EXTRA") { $solicitacao_tipo__look .= "ACOMPANHANTE EXTRA" ;} 
 if ($this->solicitacao_tipo_ == "AÉREO") { $solicitacao_tipo__look .= "AÉREO" ;} 
 if ($this->solicitacao_tipo_ == "HOSPEDAGEM") { $solicitacao_tipo__look .= "HOSPEDAGEM" ;} 
 if ($this->solicitacao_tipo_ == "OUTROS") { $solicitacao_tipo__look .= "OUTROS" ;} 
 if ($this->solicitacao_tipo_ == "SUBSTITUIÇÃO") { $solicitacao_tipo__look .= "SUBSTITUIÇÃO" ;} 
 if ($this->solicitacao_tipo_ == "TELEEVENTOS") { $solicitacao_tipo__look .= "TELEEVENTOS" ;} 
 if (empty($solicitacao_tipo__look)) { $solicitacao_tipo__look = $this->solicitacao_tipo_; }
?>
<input type="hidden" name="solicitacao_tipo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_tipo_) . "\">" . $solicitacao_tipo__look . ""; ?>
<?php } else { ?>
<?php

$solicitacao_tipo__look = "";
 if ($this->solicitacao_tipo_ == "ACOMPANHANTE EXTRA") { $solicitacao_tipo__look .= "ACOMPANHANTE EXTRA" ;} 
 if ($this->solicitacao_tipo_ == "AÉREO") { $solicitacao_tipo__look .= "AÉREO" ;} 
 if ($this->solicitacao_tipo_ == "HOSPEDAGEM") { $solicitacao_tipo__look .= "HOSPEDAGEM" ;} 
 if ($this->solicitacao_tipo_ == "OUTROS") { $solicitacao_tipo__look .= "OUTROS" ;} 
 if ($this->solicitacao_tipo_ == "SUBSTITUIÇÃO") { $solicitacao_tipo__look .= "SUBSTITUIÇÃO" ;} 
 if ($this->solicitacao_tipo_ == "TELEEVENTOS") { $solicitacao_tipo__look .= "TELEEVENTOS" ;} 
 if (empty($solicitacao_tipo__look)) { $solicitacao_tipo__look = $this->solicitacao_tipo_; }
?>
<span id="id_read_on_solicitacao_tipo_<?php echo $sc_seq_vert ; ?>" class="css_solicitacao_tipo__line"  style="<?php echo $sStyleReadLab_solicitacao_tipo_; ?>"><?php echo $this->form_format_readonly("solicitacao_tipo_", $this->form_encode_input($solicitacao_tipo__look)); ?></span><span id="id_read_off_solicitacao_tipo_<?php echo $sc_seq_vert ; ?>" class="css_read_off_solicitacao_tipo_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_solicitacao_tipo_; ?>">
 <span id="idAjaxSelect_solicitacao_tipo_<?php echo $sc_seq_vert ?>" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOddMult css_solicitacao_tipo__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_solicitacao_tipo_<?php echo $sc_seq_vert ?>" name="solicitacao_tipo_<?php echo $sc_seq_vert ?>" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_tipo_'][] = ''; ?>
 <option value="">.:selecione.:.</option>
 <option  value="ACOMPANHANTE EXTRA" <?php  if ($this->solicitacao_tipo_ == "ACOMPANHANTE EXTRA") { echo " selected" ;} ?>>ACOMPANHANTE EXTRA</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_tipo_'][] = 'ACOMPANHANTE EXTRA'; ?>
 <option  value="AÉREO" <?php  if ($this->solicitacao_tipo_ == "AÉREO") { echo " selected" ;} ?>>AÉREO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_tipo_'][] = 'AÉREO'; ?>
 <option  value="HOSPEDAGEM" <?php  if ($this->solicitacao_tipo_ == "HOSPEDAGEM") { echo " selected" ;} ?>>HOSPEDAGEM</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_tipo_'][] = 'HOSPEDAGEM'; ?>
 <option  value="OUTROS" <?php  if ($this->solicitacao_tipo_ == "OUTROS") { echo " selected" ;} ?>>OUTROS</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_tipo_'][] = 'OUTROS'; ?>
 <option  value="SUBSTITUIÇÃO" <?php  if ($this->solicitacao_tipo_ == "SUBSTITUIÇÃO") { echo " selected" ;} ?>>SUBSTITUIÇÃO</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_tipo_'][] = 'SUBSTITUIÇÃO'; ?>
 <option  value="TELEEVENTOS" <?php  if ($this->solicitacao_tipo_ == "TELEEVENTOS") { echo " selected" ;} ?>>TELEEVENTOS</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_tipo_'][] = 'TELEEVENTOS'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_tipo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_tipo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_obs_']) && $this->nmgp_cmp_hidden['solicitacao_obs_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="solicitacao_obs_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_obs_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_obs__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_obs_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_obs_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_obs__line" style="vertical-align: top;padding: 0px">
<?php
$solicitacao_obs__val = nl2br($solicitacao_obs_);

?>

<?php if ($bTestReadOnly_solicitacao_obs_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["solicitacao_obs_"]) &&  $this->nmgp_cmp_readonly["solicitacao_obs_"] == "on") { 

 ?>
<input type="hidden" name="solicitacao_obs_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_obs_) . "\">" . $solicitacao_obs__val . ""; ?>
<?php } else { ?>
<span id="id_read_on_solicitacao_obs_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-solicitacao_obs_<?php echo $sc_seq_vert ?> css_solicitacao_obs__line" style="<?php echo $sStyleReadLab_solicitacao_obs_; ?>"><?php echo $this->form_format_readonly("solicitacao_obs_", $this->form_encode_input($solicitacao_obs__val)); ?></span><span id="id_read_off_solicitacao_obs_<?php echo $sc_seq_vert ?>" class="css_read_off_solicitacao_obs_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_solicitacao_obs_; ?>">
 <textarea class="sc-js-input scFormObjectOddMult css_solicitacao_obs__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="solicitacao_obs_<?php echo $sc_seq_vert ?>" id="id_sc_field_solicitacao_obs_<?php echo $sc_seq_vert ?>" rows="2" cols="25"
 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $solicitacao_obs_; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_obs_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_obs_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_de_']) && $this->nmgp_cmp_hidden['solicitacao_de_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="solicitacao_de_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_de_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_de__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_de_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_de_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_de__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_solicitacao_de_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["solicitacao_de_"]) &&  $this->nmgp_cmp_readonly["solicitacao_de_"] == "on") { 

 ?>
<input type="hidden" name="solicitacao_de_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_de_) . "\">" . $solicitacao_de_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_solicitacao_de_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-solicitacao_de_<?php echo $sc_seq_vert ?> css_solicitacao_de__line" style="<?php echo $sStyleReadLab_solicitacao_de_; ?>"><?php echo $this->form_format_readonly("solicitacao_de_", $this->form_encode_input($this->solicitacao_de_)); ?></span><span id="id_read_off_solicitacao_de_<?php echo $sc_seq_vert ?>" class="css_read_off_solicitacao_de_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_solicitacao_de_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_solicitacao_de__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_solicitacao_de_<?php echo $sc_seq_vert ?>" type=text name="solicitacao_de_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_de_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.solicitacao_de_" . $sc_seq_vert . ".value != '') {window.open('mailto:' + document.F1.solicitacao_de_" . $sc_seq_vert . ".value); }", "if (document.F1.solicitacao_de_" . $sc_seq_vert . ".value != '') {window.open('mailto:' + document.F1.solicitacao_de_" . $sc_seq_vert . ".value); }", "solicitacao_de_" . $sc_seq_vert . "_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_de_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_de_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_para_email_']) && $this->nmgp_cmp_hidden['solicitacao_para_email_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="solicitacao_para_email_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_para_email_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_para_email__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_para_email_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_para_email_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_para_email__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_solicitacao_para_email_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["solicitacao_para_email_"]) &&  $this->nmgp_cmp_readonly["solicitacao_para_email_"] == "on") { 

 ?>
<input type="hidden" name="solicitacao_para_email_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_para_email_) . "\">" . $solicitacao_para_email_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_solicitacao_para_email_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-solicitacao_para_email_<?php echo $sc_seq_vert ?> css_solicitacao_para_email__line" style="<?php echo $sStyleReadLab_solicitacao_para_email_; ?>"><?php echo $this->form_format_readonly("solicitacao_para_email_", $this->form_encode_input($this->solicitacao_para_email_)); ?></span><span id="id_read_off_solicitacao_para_email_<?php echo $sc_seq_vert ?>" class="css_read_off_solicitacao_para_email_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_solicitacao_para_email_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_solicitacao_para_email__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_solicitacao_para_email_<?php echo $sc_seq_vert ?>" type=text name="solicitacao_para_email_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_para_email_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=50 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.solicitacao_para_email_" . $sc_seq_vert . ".value != '') {window.open('mailto:' + document.F1.solicitacao_para_email_" . $sc_seq_vert . ".value); }", "if (document.F1.solicitacao_para_email_" . $sc_seq_vert . ".value != '') {window.open('mailto:' + document.F1.solicitacao_para_email_" . $sc_seq_vert . ".value); }", "solicitacao_para_email_" . $sc_seq_vert . "_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_para_email_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_para_email_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_data_']) && $this->nmgp_cmp_hidden['solicitacao_data_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="solicitacao_data_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_data_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_data__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_data_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_data_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_data__line" style="vertical-align: top;padding: 0px"><input type="hidden" name="solicitacao_data_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_data_); ?>"><span id="id_ajax_label_solicitacao_data_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($solicitacao_data_); ?></span>
<?php
$tmp_form_data = $this->field_config['solicitacao_data_']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_data_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_data_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_hora_']) && $this->nmgp_cmp_hidden['solicitacao_hora_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="solicitacao_hora_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_hora_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_hora__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_hora_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_hora_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_hora__line" style="vertical-align: top;padding: 0px"><input type="hidden" name="solicitacao_hora_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_hora_); ?>"><span id="id_ajax_label_solicitacao_hora_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($solicitacao_hora_); ?></span>
<?php
$tmp_form_data = $this->field_config['solicitacao_hora_']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_hora_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_hora_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['usuario_id_']) && $this->nmgp_cmp_hidden['usuario_id_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="usuario_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($usuario_id_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_usuario_id__line <?php echo $classColFld ?>" id="hidden_field_data_usuario_id_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_usuario_id_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_usuario_id__line" style="vertical-align: top;padding: 0px"><input type="hidden" name="usuario_id_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($usuario_id_); ?>"><span id="id_ajax_label_usuario_id_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($usuario_id_); ?></span>
 <SPAN id="id_lookup_usuario_id_<?php echo $sc_seq_vert ?>" style="color: #3366FF"><?php echo $look_rpc_usuario_id_; ?></SPAN></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_usuario_id_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_usuario_id_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_ativo_']) && $this->nmgp_cmp_hidden['solicitacao_ativo_'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="solicitacao_ativo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($this->solicitacao_ativo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_ativo__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_ativo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_ativo_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_ativo__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_solicitacao_ativo_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["solicitacao_ativo_"]) &&  $this->nmgp_cmp_readonly["solicitacao_ativo_"] == "on") { 

$solicitacao_ativo__look = "";
 if ($this->solicitacao_ativo_ == "Y") { $solicitacao_ativo__look .= "Ativo" ;} 
 if ($this->solicitacao_ativo_ == "N") { $solicitacao_ativo__look .= "Inativo" ;} 
 if (empty($solicitacao_ativo__look)) { $solicitacao_ativo__look = $this->solicitacao_ativo_; }
?>
<input type="hidden" name="solicitacao_ativo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_ativo_) . "\">" . $solicitacao_ativo__look . ""; ?>
<?php } else { ?>
<?php

$solicitacao_ativo__look = "";
 if ($this->solicitacao_ativo_ == "Y") { $solicitacao_ativo__look .= "Ativo" ;} 
 if ($this->solicitacao_ativo_ == "N") { $solicitacao_ativo__look .= "Inativo" ;} 
 if (empty($solicitacao_ativo__look)) { $solicitacao_ativo__look = $this->solicitacao_ativo_; }
?>
<span id="id_read_on_solicitacao_ativo_<?php echo $sc_seq_vert ; ?>" class="css_solicitacao_ativo__line"  style="<?php echo $sStyleReadLab_solicitacao_ativo_; ?>"><?php echo $this->form_format_readonly("solicitacao_ativo_", $this->form_encode_input($solicitacao_ativo__look)); ?></span><span id="id_read_off_solicitacao_ativo_<?php echo $sc_seq_vert ; ?>" class="css_read_off_solicitacao_ativo_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_solicitacao_ativo_; ?>">
 <span id="idAjaxSelect_solicitacao_ativo_<?php echo $sc_seq_vert ?>" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOddMult css_solicitacao_ativo__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_solicitacao_ativo_<?php echo $sc_seq_vert ?>" name="solicitacao_ativo_<?php echo $sc_seq_vert ?>" size="1" alt="{type: 'select', enterTab: false}">
 <option  value="Y" <?php  if ($this->solicitacao_ativo_ == "Y") { echo " selected" ;} ?><?php  if (empty($this->solicitacao_ativo_)) { echo " selected" ;} ?>>Ativo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_ativo_'][] = 'Y'; ?>
 <option  value="N" <?php  if ($this->solicitacao_ativo_ == "N") { echo " selected" ;} ?>>Inativo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['Lookup_solicitacao_ativo_'][] = 'N'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_ativo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_ativo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['ativo_']) && $this->nmgp_cmp_hidden['ativo_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="ativo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($ativo_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_ativo__line <?php echo $classColFld ?>" id="hidden_field_data_ativo_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_ativo_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_ativo__line" style="vertical-align: top;padding: 0px"><span id="id_read_on_ativo_<?php echo $sc_seq_vert ?> class="css_ativo__line" style="<?php echo $sStyleReadLab_ativo_; ?>"><?php echo $fieldContent; ?></span><span id="id_ajax_label_ativo_<?php echo $sc_seq_vert ?>" class="css_read_off_ativo_" ><span id="id_ajax_label_ativo_<?php echo $sc_seq_vert; ?>"><?php echo $ativo_?></span>
</span><input type="hidden" name="ativo_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($ativo_); ?>">
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_ativo_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_ativo_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['solicitacao_id_evento_']) && $this->nmgp_cmp_hidden['solicitacao_id_evento_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="solicitacao_id_evento_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_id_evento_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_solicitacao_id_evento__line <?php echo $classColFld ?>" id="hidden_field_data_solicitacao_id_evento_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_solicitacao_id_evento_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_solicitacao_id_evento__line" style="vertical-align: top;padding: 0px"><input type="hidden" name="solicitacao_id_evento_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($solicitacao_id_evento_); ?>"><span id="id_ajax_label_solicitacao_id_evento_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($solicitacao_id_evento_); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_solicitacao_id_evento_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_solicitacao_id_evento_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['cpf_del_']) && $this->nmgp_cmp_hidden['cpf_del_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="cpf_del_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($cpf_del_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_cpf_del__line <?php echo $classColFld ?>" id="hidden_field_data_cpf_del_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_cpf_del_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_cpf_del__line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly_cpf_del_ && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["cpf_del_"]) &&  $this->nmgp_cmp_readonly["cpf_del_"] == "on") { 

 ?>
<input type="hidden" name="cpf_del_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($cpf_del_) . "\">" . $cpf_del_ . ""; ?>
<?php } else { ?>
<span id="id_read_on_cpf_del_<?php echo $sc_seq_vert ?>" class="sc-ui-readonly-cpf_del_<?php echo $sc_seq_vert ?> css_cpf_del__line" style="<?php echo $sStyleReadLab_cpf_del_; ?>"><?php echo $this->form_format_readonly("cpf_del_", $this->form_encode_input($this->cpf_del_)); ?></span><span id="id_read_off_cpf_del_<?php echo $sc_seq_vert ?>" class="css_read_off_cpf_del_<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_cpf_del_; ?>">
 <input class="sc-js-input scFormObjectOddMult css_cpf_del__obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_cpf_del_<?php echo $sc_seq_vert ?>" type=text name="cpf_del_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($cpf_del_) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddMultWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_cpf_del_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_cpf_del_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['sql_log_']) && $this->nmgp_cmp_hidden['sql_log_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="sql_log_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($sql_log_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>

    <TD class="scFormDataOddMult css_sql_log__line <?php echo $classColFld ?>" id="hidden_field_data_sql_log_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_sql_log_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_sql_log__line" style="vertical-align: top;padding: 0px"><input type="hidden" name="sql_log_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($sql_log_); ?>"><span id="id_ajax_label_sql_log_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($sql_log_); ?></span>

<?php
$sql_log__val = nl2br($sql_log_);

?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_sql_log_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_sql_log_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php $this->form_fixed_column_no++; ?>
<?php }?>

   <?php if (isset($this->nmgp_cmp_hidden['id_solicitacao_']) && $this->nmgp_cmp_hidden['id_solicitacao_'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="id_solicitacao_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($id_solicitacao_) . "\">"; ?>
<?php } else { $sc_hidden_no++; 
       $classColFld = " sc-col-fld sc-col-fld-" . $this->form_fixed_column_no;
?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOddMult css_id_solicitacao__line <?php echo $classColFld ?>" id="hidden_field_data_id_solicitacao_<?php echo $sc_seq_vert; ?>" style="<?php echo $sStyleHidden_id_solicitacao_; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOddMult css_id_solicitacao__line" style="vertical-align: top;padding: 0px"><span id="id_read_on_id_solicitacao_<?php echo $sc_seq_vert ?>" class="css_id_solicitacao__line" style="<?php echo $sStyleReadLab_id_solicitacao_; ?>"><?php echo $this->form_format_readonly("id_solicitacao_", $this->form_encode_input($this->id_solicitacao_)); ?></span><span id="id_read_off_id_solicitacao_<?php echo $sc_seq_vert ?>" class="css_read_off_id_solicitacao_" style="<?php echo $sStyleReadInp_id_solicitacao_; ?>"><input type="hidden" id="id_sc_field_id_solicitacao_<?php echo $sc_seq_vert ?>" name="id_solicitacao_<?php echo $sc_seq_vert ?>" value="<?php echo $this->form_encode_input($id_solicitacao_) . "\">"?>
<span id="id_ajax_label_id_solicitacao_<?php echo $sc_seq_vert; ?>"><?php echo nl2br($id_solicitacao_); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_id_solicitacao_<?php echo $sc_seq_vert; ?>_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_id_solicitacao_<?php echo $sc_seq_vert; ?>_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>
<?php $this->form_fixed_column_no++; ?>
<?php }?>





   </tr>
<?php   
        if (isset($sCheckRead_solicitacao_icon_))
       {
           $this->nmgp_cmp_readonly['solicitacao_icon_'] = $sCheckRead_solicitacao_icon_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_icon_)
       {
           $this->nmgp_cmp_hidden['solicitacao_icon_'] = 'off';
       }
       if (isset($sCheckRead_solicitacao_status_))
       {
           $this->nmgp_cmp_readonly['solicitacao_status_'] = $sCheckRead_solicitacao_status_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_status_)
       {
           $this->nmgp_cmp_hidden['solicitacao_status_'] = 'off';
       }
       if (isset($sCheckRead_solicitacao_tipo_))
       {
           $this->nmgp_cmp_readonly['solicitacao_tipo_'] = $sCheckRead_solicitacao_tipo_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_tipo_)
       {
           $this->nmgp_cmp_hidden['solicitacao_tipo_'] = 'off';
       }
       if (isset($sCheckRead_solicitacao_obs_))
       {
           $this->nmgp_cmp_readonly['solicitacao_obs_'] = $sCheckRead_solicitacao_obs_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_obs_)
       {
           $this->nmgp_cmp_hidden['solicitacao_obs_'] = 'off';
       }
       if (isset($sCheckRead_solicitacao_de_))
       {
           $this->nmgp_cmp_readonly['solicitacao_de_'] = $sCheckRead_solicitacao_de_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_de_)
       {
           $this->nmgp_cmp_hidden['solicitacao_de_'] = 'off';
       }
       if (isset($sCheckRead_solicitacao_para_email_))
       {
           $this->nmgp_cmp_readonly['solicitacao_para_email_'] = $sCheckRead_solicitacao_para_email_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_para_email_)
       {
           $this->nmgp_cmp_hidden['solicitacao_para_email_'] = 'off';
       }
       if (isset($sCheckRead_solicitacao_data_))
       {
           $this->nmgp_cmp_readonly['solicitacao_data_'] = $sCheckRead_solicitacao_data_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_data_)
       {
           $this->nmgp_cmp_hidden['solicitacao_data_'] = 'off';
       }
       if (isset($sCheckRead_solicitacao_hora_))
       {
           $this->nmgp_cmp_readonly['solicitacao_hora_'] = $sCheckRead_solicitacao_hora_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_hora_)
       {
           $this->nmgp_cmp_hidden['solicitacao_hora_'] = 'off';
       }
       if (isset($sCheckRead_usuario_id_))
       {
           $this->nmgp_cmp_readonly['usuario_id_'] = $sCheckRead_usuario_id_;
       }
       if ('display: none;' == $sStyleHidden_usuario_id_)
       {
           $this->nmgp_cmp_hidden['usuario_id_'] = 'off';
       }
       if (isset($sCheckRead_solicitacao_ativo_))
       {
           $this->nmgp_cmp_readonly['solicitacao_ativo_'] = $sCheckRead_solicitacao_ativo_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_ativo_)
       {
           $this->nmgp_cmp_hidden['solicitacao_ativo_'] = 'off';
       }
       if (isset($sCheckRead_ativo_))
       {
           $this->nmgp_cmp_readonly['ativo_'] = $sCheckRead_ativo_;
       }
       if ('display: none;' == $sStyleHidden_ativo_)
       {
           $this->nmgp_cmp_hidden['ativo_'] = 'off';
       }
       if (isset($sCheckRead_solicitacao_id_evento_))
       {
           $this->nmgp_cmp_readonly['solicitacao_id_evento_'] = $sCheckRead_solicitacao_id_evento_;
       }
       if ('display: none;' == $sStyleHidden_solicitacao_id_evento_)
       {
           $this->nmgp_cmp_hidden['solicitacao_id_evento_'] = 'off';
       }
       if (isset($sCheckRead_cpf_del_))
       {
           $this->nmgp_cmp_readonly['cpf_del_'] = $sCheckRead_cpf_del_;
       }
       if ('display: none;' == $sStyleHidden_cpf_del_)
       {
           $this->nmgp_cmp_hidden['cpf_del_'] = 'off';
       }
       if (isset($sCheckRead_sql_log_))
       {
           $this->nmgp_cmp_readonly['sql_log_'] = $sCheckRead_sql_log_;
       }
       if ('display: none;' == $sStyleHidden_sql_log_)
       {
           $this->nmgp_cmp_hidden['sql_log_'] = 'off';
       }
       if (isset($sCheckRead_id_solicitacao_))
       {
           $this->nmgp_cmp_readonly['id_solicitacao_'] = $sCheckRead_id_solicitacao_;
       }
       if ('display: none;' == $sStyleHidden_id_solicitacao_)
       {
           $this->nmgp_cmp_hidden['id_solicitacao_'] = 'off';
       }

   }
   if ($Line_Add) 
   { 
       $this->New_Line = ob_get_contents();
       ob_end_clean();
       $this->nmgp_opcao = $guarda_nmgp_opcao;
       $this->form_vert_form_solicitacoes_rsvp = $guarda_form_vert_form_solicitacoes_rsvp;
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['birpara'];
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
        $buttonMacroDisabled = 'sc-unique-btn-11';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['first'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "binicio", "scBtnFn_sys_format_ini()", "scBtnFn_sys_format_ini()", "sc_b_ini_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['back'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-12';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['back'];
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
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['forward'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-13';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['forward'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bavanca", "scBtnFn_sys_format_ava()", "scBtnFn_sys_format_ava()", "sc_b_avc_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && ('total' != $this->form_paginacao)) {
        $sCondStyle = ($this->nmgp_botoes['last'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-14';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
<script>
 var iAjaxNewLine = <?php echo $sc_seq_vert; ?>;
<?php
if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_modal']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['run_modal'])
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['masterValue']);
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
  if ("cabecalho_" == sFldName)
  {
    document.getElementById("head_mark_cabecalho__0").innerHTML = sFldValue;
  }
  if ("rodape_" == sFldName)
  {
    document.getElementById("head_mark_rodape__0").innerHTML = sFldValue;
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_solicitacoes_rsvp");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_solicitacoes_rsvp");
 parent.scAjaxDetailHeight("form_solicitacoes_rsvp", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_solicitacoes_rsvp", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_solicitacoes_rsvp", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['sc_modal'])
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
                        do_ajax_form_solicitacoes_rsvp_add_new_line(); return false;
                         return;
                }
                if ($("#sc_b_new_t.sc-unique-btn-2").length && $("#sc_b_new_t.sc-unique-btn-2").is(":visible")) {
                    if ($("#sc_b_new_t.sc-unique-btn-2").hasClass("disabled")) {
                        return;
                    }
                        nm_move ('novo');
                         return;
                }
                if ($("#sc_b_ins_t.sc-unique-btn-3").length && $("#sc_b_ins_t.sc-unique-btn-3").is(":visible")) {
                    if ($("#sc_b_ins_t.sc-unique-btn-3").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('incluir');
                         return;
                }
        }
        function scBtnFn_sys_format_cnl() {
                if ($("#sc_b_sai_t.sc-unique-btn-4").length && $("#sc_b_sai_t.sc-unique-btn-4").is(":visible")) {
                    if ($("#sc_b_sai_t.sc-unique-btn-4").hasClass("disabled")) {
                        return;
                    }
                        <?php echo $this->NM_cancel_insert_new ?> document.F5.submit();
                         return;
                }
        }
        function scBtnFn_sys_format_alt() {
                if ($("#sc_b_upd_t.sc-unique-btn-5").length && $("#sc_b_upd_t.sc-unique-btn-5").is(":visible")) {
                    if ($("#sc_b_upd_t.sc-unique-btn-5").hasClass("disabled")) {
                        return;
                    }
                        nm_atualiza ('alterar');
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
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_solicitacoes_rsvp']['inside_nested_iframe']) {
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
