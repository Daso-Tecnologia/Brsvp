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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("BRSVP - Fornecedores Diversos - Inclusão"); } else { echo strip_tags("BRSVP - Fornecedores Diversos - Edição"); } ?></TITLE>
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

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['embutida_pdf']))
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
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_tbl_fornecedores/form_tbl_fornecedores_mob_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_tbl_fornecedores_mob_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_tbl_fornecedores_mob_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['recarga'];
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['link_info']['remove_border']) {
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

if (isset($_SESSION['scriptcase']['form_tbl_fornecedores']['error_buffer']) && '' != $_SESSION['scriptcase']['form_tbl_fornecedores']['error_buffer'])
{
    echo $_SESSION['scriptcase']['form_tbl_fornecedores']['error_buffer'];
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
 include_once("form_tbl_fornecedores_mob_js0.php");
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
               action="form_tbl_fornecedores_mob.php" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_tbl_fornecedores_mob'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_tbl_fornecedores_mob'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['fast_search'][2] : "";
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
          $SC_Label_atu['fornec_id'] = (isset($this->nm_new_label['fornec_id'])) ? $this->nm_new_label['fornec_id'] : 'Cód. Fornecedor'; 
          $SC_Label_atu['fornec_cnpj'] = (isset($this->nm_new_label['fornec_cnpj'])) ? $this->nm_new_label['fornec_cnpj'] : 'CNPJ:'; 
          $SC_Label_atu['fornec_razsoc'] = (isset($this->nm_new_label['fornec_razsoc'])) ? $this->nm_new_label['fornec_razsoc'] : 'Raz. Social:'; 
          $SC_Label_atu['fornec_fantasia'] = (isset($this->nm_new_label['fornec_fantasia'])) ? $this->nm_new_label['fornec_fantasia'] : 'Fantasia:'; 
          $SC_Label_atu['fornec_tipo'] = (isset($this->nm_new_label['fornec_tipo'])) ? $this->nm_new_label['fornec_tipo'] : 'Tipo:'; 
          $SC_Label_atu['fornec_tipo_estrangeiro'] = (isset($this->nm_new_label['fornec_tipo_estrangeiro'])) ? $this->nm_new_label['fornec_tipo_estrangeiro'] : 'Tipo Estrangeiro:'; 
          $SC_Label_atu['fornec_cep'] = (isset($this->nm_new_label['fornec_cep'])) ? $this->nm_new_label['fornec_cep'] : 'CEP:'; 
          $SC_Label_atu['fornec_pais'] = (isset($this->nm_new_label['fornec_pais'])) ? $this->nm_new_label['fornec_pais'] : 'País:'; 
          $SC_Label_atu['fornec_uf'] = (isset($this->nm_new_label['fornec_uf'])) ? $this->nm_new_label['fornec_uf'] : 'UF:'; 
          $SC_Label_atu['fornec_municipio'] = (isset($this->nm_new_label['fornec_municipio'])) ? $this->nm_new_label['fornec_municipio'] : 'Município:'; 
          $SC_Label_atu['fornec_bairro'] = (isset($this->nm_new_label['fornec_bairro'])) ? $this->nm_new_label['fornec_bairro'] : 'Bairro:'; 
          $SC_Label_atu['fornec_tipo_logradouro'] = (isset($this->nm_new_label['fornec_tipo_logradouro'])) ? $this->nm_new_label['fornec_tipo_logradouro'] : 'Fornec Tipo Logradouro'; 
          $SC_Label_atu['fornec_logradouro'] = (isset($this->nm_new_label['fornec_logradouro'])) ? $this->nm_new_label['fornec_logradouro'] : 'Logradouro:'; 
          $SC_Label_atu['fornec_numero'] = (isset($this->nm_new_label['fornec_numero'])) ? $this->nm_new_label['fornec_numero'] : 'Numero:'; 
          $SC_Label_atu['fornec_complemento'] = (isset($this->nm_new_label['fornec_complemento'])) ? $this->nm_new_label['fornec_complemento'] : 'Complemento:'; 
          $SC_Label_atu['fornec_email'] = (isset($this->nm_new_label['fornec_email'])) ? $this->nm_new_label['fornec_email'] : 'E-mail:'; 
          $SC_Label_atu['fornec_website'] = (isset($this->nm_new_label['fornec_website'])) ? $this->nm_new_label['fornec_website'] : 'Site:'; 
          $SC_Label_atu['fornec_celular'] = (isset($this->nm_new_label['fornec_celular'])) ? $this->nm_new_label['fornec_celular'] : 'Celular:'; 
          $SC_Label_atu['fornec_tel'] = (isset($this->nm_new_label['fornec_tel'])) ? $this->nm_new_label['fornec_tel'] : 'Fone:'; 
          $SC_Label_atu['fornec_contato'] = (isset($this->nm_new_label['fornec_contato'])) ? $this->nm_new_label['fornec_contato'] : 'Contato:'; 
          $SC_Label_atu['fornec_codfor_estrangeiro'] = (isset($this->nm_new_label['fornec_codfor_estrangeiro'])) ? $this->nm_new_label['fornec_codfor_estrangeiro'] : 'Cód. Estrangeiro:'; 
          $SC_Label_atu['fornec_ativo'] = (isset($this->nm_new_label['fornec_ativo'])) ? $this->nm_new_label['fornec_ativo'] : 'Ativo:'; 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-20';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-21';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-22';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-23';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-24';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0 class="scBlockRow scBlockRowFirst"><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable scFormDataOdd<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['fornec_id']))
           {
               $this->nmgp_cmp_readonly['fornec_id'] = 'on';
           }
?>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_id']))
    {
        $this->nm_new_label['fornec_id'] = "Cód. Fornecedor";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_id = $this->fornec_id;
   $sStyleHidden_fornec_id = '';
   if (isset($this->nmgp_cmp_hidden['fornec_id']) && $this->nmgp_cmp_hidden['fornec_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_id']);
       $sStyleHidden_fornec_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_id = 'display: none;';
   $sStyleReadInp_fornec_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["fornec_id"]) &&  $this->nmgp_cmp_readonly["fornec_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_id']);
       $sStyleReadLab_fornec_id = '';
       $sStyleReadInp_fornec_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_id']) && $this->nmgp_cmp_hidden['fornec_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_id" value="<?php echo $this->form_encode_input($fornec_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_id" style="<?php echo $sStyleHidden_fornec_id; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_id_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_id_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_id"><?php echo $this->nm_new_label['fornec_id']; ?></span></td></tr><tr><td class="css_fornec_id_line" style="padding: 0px; width: 100%;"><span id="id_read_on_fornec_id" class="css_fornec_id_line" style="<?php echo $sStyleReadLab_fornec_id; ?>"><?php echo $this->form_format_readonly("fornec_id", $this->form_encode_input($this->fornec_id)); ?></span><span id="id_read_off_fornec_id" class="css_read_off_fornec_id" style="<?php echo $sStyleReadInp_fornec_id; ?>"><input type="hidden" name="fornec_id" value="<?php echo $this->form_encode_input($fornec_id) . "\">"?><span id="id_ajax_label_fornec_id"><?php echo nl2br($fornec_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_id_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
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
    if (!isset($this->nm_new_label['fornec_cnpj']))
    {
        $this->nm_new_label['fornec_cnpj'] = "CNPJ:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_cnpj = $this->fornec_cnpj;
   $sStyleHidden_fornec_cnpj = '';
   if (isset($this->nmgp_cmp_hidden['fornec_cnpj']) && $this->nmgp_cmp_hidden['fornec_cnpj'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_cnpj']);
       $sStyleHidden_fornec_cnpj = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_cnpj = 'display: none;';
   $sStyleReadInp_fornec_cnpj = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_cnpj']) && $this->nmgp_cmp_readonly['fornec_cnpj'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_cnpj']);
       $sStyleReadLab_fornec_cnpj = '';
       $sStyleReadInp_fornec_cnpj = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_cnpj']) && $this->nmgp_cmp_hidden['fornec_cnpj'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_cnpj" value="<?php echo $this->form_encode_input($fornec_cnpj) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_cnpj" style="<?php echo $sStyleHidden_fornec_cnpj; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_cnpj_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_cnpj_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_cnpj"><?php echo $this->nm_new_label['fornec_cnpj']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['php_cmp_required']['fornec_cnpj']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['php_cmp_required']['fornec_cnpj'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_fornec_cnpj_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_cnpj"]) &&  $this->nmgp_cmp_readonly["fornec_cnpj"] == "on") { 

 ?>
<input type="hidden" name="fornec_cnpj" value="<?php echo $this->form_encode_input($fornec_cnpj) . "\">" . $fornec_cnpj . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_cnpj" class="sc-ui-readonly-fornec_cnpj css_fornec_cnpj_line" style="<?php echo $sStyleReadLab_fornec_cnpj; ?>"><?php echo $this->form_format_readonly("fornec_cnpj", $this->form_encode_input($this->fornec_cnpj)); ?></span><span id="id_read_off_fornec_cnpj" class="css_read_off_fornec_cnpj<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_cnpj; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_cnpj_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_cnpj" type=text name="fornec_cnpj" value="<?php echo $this->form_encode_input($fornec_cnpj) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=18"; } ?> alt="{datatype: 'cnpj', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_cnpj_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_cnpj_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_razsoc']))
    {
        $this->nm_new_label['fornec_razsoc'] = "Raz. Social:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_razsoc = $this->fornec_razsoc;
   $sStyleHidden_fornec_razsoc = '';
   if (isset($this->nmgp_cmp_hidden['fornec_razsoc']) && $this->nmgp_cmp_hidden['fornec_razsoc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_razsoc']);
       $sStyleHidden_fornec_razsoc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_razsoc = 'display: none;';
   $sStyleReadInp_fornec_razsoc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_razsoc']) && $this->nmgp_cmp_readonly['fornec_razsoc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_razsoc']);
       $sStyleReadLab_fornec_razsoc = '';
       $sStyleReadInp_fornec_razsoc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_razsoc']) && $this->nmgp_cmp_hidden['fornec_razsoc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_razsoc" value="<?php echo $this->form_encode_input($fornec_razsoc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_razsoc" style="<?php echo $sStyleHidden_fornec_razsoc; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_razsoc_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_razsoc_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_razsoc"><?php echo $this->nm_new_label['fornec_razsoc']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['php_cmp_required']['fornec_razsoc']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['php_cmp_required']['fornec_razsoc'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_fornec_razsoc_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_razsoc"]) &&  $this->nmgp_cmp_readonly["fornec_razsoc"] == "on") { 

 ?>
<input type="hidden" name="fornec_razsoc" value="<?php echo $this->form_encode_input($fornec_razsoc) . "\">" . $fornec_razsoc . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_razsoc" class="sc-ui-readonly-fornec_razsoc css_fornec_razsoc_line" style="<?php echo $sStyleReadLab_fornec_razsoc; ?>"><?php echo $this->form_format_readonly("fornec_razsoc", $this->form_encode_input($this->fornec_razsoc)); ?></span><span id="id_read_off_fornec_razsoc" class="css_read_off_fornec_razsoc<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_razsoc; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_razsoc_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_razsoc" type=text name="fornec_razsoc" value="<?php echo $this->form_encode_input($fornec_razsoc) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_razsoc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_razsoc_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_fantasia']))
    {
        $this->nm_new_label['fornec_fantasia'] = "Fantasia:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_fantasia = $this->fornec_fantasia;
   $sStyleHidden_fornec_fantasia = '';
   if (isset($this->nmgp_cmp_hidden['fornec_fantasia']) && $this->nmgp_cmp_hidden['fornec_fantasia'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_fantasia']);
       $sStyleHidden_fornec_fantasia = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_fantasia = 'display: none;';
   $sStyleReadInp_fornec_fantasia = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_fantasia']) && $this->nmgp_cmp_readonly['fornec_fantasia'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_fantasia']);
       $sStyleReadLab_fornec_fantasia = '';
       $sStyleReadInp_fornec_fantasia = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_fantasia']) && $this->nmgp_cmp_hidden['fornec_fantasia'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_fantasia" value="<?php echo $this->form_encode_input($fornec_fantasia) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_fantasia" style="<?php echo $sStyleHidden_fornec_fantasia; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_fantasia_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_fantasia_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_fantasia"><?php echo $this->nm_new_label['fornec_fantasia']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['php_cmp_required']['fornec_fantasia']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['php_cmp_required']['fornec_fantasia'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></td></tr><tr><td class="css_fornec_fantasia_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_fantasia"]) &&  $this->nmgp_cmp_readonly["fornec_fantasia"] == "on") { 

 ?>
<input type="hidden" name="fornec_fantasia" value="<?php echo $this->form_encode_input($fornec_fantasia) . "\">" . $fornec_fantasia . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_fantasia" class="sc-ui-readonly-fornec_fantasia css_fornec_fantasia_line" style="<?php echo $sStyleReadLab_fornec_fantasia; ?>"><?php echo $this->form_format_readonly("fornec_fantasia", $this->form_encode_input($this->fornec_fantasia)); ?></span><span id="id_read_off_fornec_fantasia" class="css_read_off_fornec_fantasia<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_fantasia; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_fantasia_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_fantasia" type=text name="fornec_fantasia" value="<?php echo $this->form_encode_input($fornec_fantasia) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_fantasia_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_fantasia_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['fornec_tipo']))
   {
       $this->nm_new_label['fornec_tipo'] = "Tipo:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_tipo = $this->fornec_tipo;
   $sStyleHidden_fornec_tipo = '';
   if (isset($this->nmgp_cmp_hidden['fornec_tipo']) && $this->nmgp_cmp_hidden['fornec_tipo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_tipo']);
       $sStyleHidden_fornec_tipo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_tipo = 'display: none;';
   $sStyleReadInp_fornec_tipo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_tipo']) && $this->nmgp_cmp_readonly['fornec_tipo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_tipo']);
       $sStyleReadLab_fornec_tipo = '';
       $sStyleReadInp_fornec_tipo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_tipo']) && $this->nmgp_cmp_hidden['fornec_tipo'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="fornec_tipo" value="<?php echo $this->form_encode_input($this->fornec_tipo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_tipo" style="<?php echo $sStyleHidden_fornec_tipo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_tipo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_tipo_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_tipo"><?php echo $this->nm_new_label['fornec_tipo']; ?></span></td></tr><tr><td class="css_fornec_tipo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_tipo"]) &&  $this->nmgp_cmp_readonly["fornec_tipo"] == "on") { 

$fornec_tipo_look = "";
 if ($this->fornec_tipo == "A") { $fornec_tipo_look .= "Agência de Turismo" ;} 
 if ($this->fornec_tipo == "C") { $fornec_tipo_look .= "Cruzeiros" ;} 
 if ($this->fornec_tipo == "D") { $fornec_tipo_look .= "Diversos" ;} 
 if ($this->fornec_tipo == "L") { $fornec_tipo_look .= "Locadora Veículos" ;} 
 if ($this->fornec_tipo == "O") { $fornec_tipo_look .= "Operadora de Turismo" ;} 
 if ($this->fornec_tipo == "T") { $fornec_tipo_look .= "Receptivo" ;} 
 if ($this->fornec_tipo == "S") { $fornec_tipo_look .= "Seguradora" ;} 
 if ($this->fornec_tipo == "T") { $fornec_tipo_look .= "Transfer" ;} 
 if ($this->fornec_tipo == "T") { $fornec_tipo_look .= "Turismo" ;} 
 if (empty($fornec_tipo_look)) { $fornec_tipo_look = $this->fornec_tipo; }
?>
<input type="hidden" name="fornec_tipo" value="<?php echo $this->form_encode_input($fornec_tipo) . "\">" . $fornec_tipo_look . ""; ?>
<?php } else { ?>
<?php

$fornec_tipo_look = "";
 if ($this->fornec_tipo == "A") { $fornec_tipo_look .= "Agência de Turismo" ;} 
 if ($this->fornec_tipo == "C") { $fornec_tipo_look .= "Cruzeiros" ;} 
 if ($this->fornec_tipo == "D") { $fornec_tipo_look .= "Diversos" ;} 
 if ($this->fornec_tipo == "L") { $fornec_tipo_look .= "Locadora Veículos" ;} 
 if ($this->fornec_tipo == "O") { $fornec_tipo_look .= "Operadora de Turismo" ;} 
 if ($this->fornec_tipo == "T") { $fornec_tipo_look .= "Receptivo" ;} 
 if ($this->fornec_tipo == "S") { $fornec_tipo_look .= "Seguradora" ;} 
 if ($this->fornec_tipo == "T") { $fornec_tipo_look .= "Transfer" ;} 
 if ($this->fornec_tipo == "T") { $fornec_tipo_look .= "Turismo" ;} 
 if (empty($fornec_tipo_look)) { $fornec_tipo_look = $this->fornec_tipo; }
?>
<span id="id_read_on_fornec_tipo" class="css_fornec_tipo_line"  style="<?php echo $sStyleReadLab_fornec_tipo; ?>"><?php echo $this->form_format_readonly("fornec_tipo", $this->form_encode_input($fornec_tipo_look)); ?></span><span id="id_read_off_fornec_tipo" class="css_read_off_fornec_tipo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap; <?php echo $sStyleReadInp_fornec_tipo; ?>">
 <span id="idAjaxSelect_fornec_tipo" class="<?php echo $this->classes_100perc_fields['span_select'] ?>"><select class="sc-js-input scFormObjectOdd css_fornec_tipo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_tipo" name="fornec_tipo" size="1" alt="{type: 'select', enterTab: false}">
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = ''; ?>
 <option value="">.:selecione:.</option>
 <option  value="A" <?php  if ($this->fornec_tipo == "A") { echo " selected" ;} ?>>Agência de Turismo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = 'A'; ?>
 <option  value="C" <?php  if ($this->fornec_tipo == "C") { echo " selected" ;} ?>>Cruzeiros</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = 'C'; ?>
 <option  value="D" <?php  if ($this->fornec_tipo == "D") { echo " selected" ;} ?>>Diversos</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = 'D'; ?>
 <option  value="L" <?php  if ($this->fornec_tipo == "L") { echo " selected" ;} ?>>Locadora Veículos</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = 'L'; ?>
 <option  value="O" <?php  if ($this->fornec_tipo == "O") { echo " selected" ;} ?>>Operadora de Turismo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = 'O'; ?>
 <option  value="T" <?php  if ($this->fornec_tipo == "T") { echo " selected" ;} ?>>Receptivo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = 'T'; ?>
 <option  value="S" <?php  if ($this->fornec_tipo == "S") { echo " selected" ;} ?>>Seguradora</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = 'S'; ?>
 <option  value="T" <?php  if ($this->fornec_tipo == "T") { echo " selected" ;} ?>>Transfer</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = 'T'; ?>
 <option  value="T" <?php  if ($this->fornec_tipo == "T") { echo " selected" ;} ?>>Turismo</option>
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_tipo'][] = 'T'; ?>
 </select></span>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_tipo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_tipo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_tipo_estrangeiro']))
    {
        $this->nm_new_label['fornec_tipo_estrangeiro'] = "Tipo Estrangeiro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_tipo_estrangeiro = $this->fornec_tipo_estrangeiro;
   $sStyleHidden_fornec_tipo_estrangeiro = '';
   if (isset($this->nmgp_cmp_hidden['fornec_tipo_estrangeiro']) && $this->nmgp_cmp_hidden['fornec_tipo_estrangeiro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_tipo_estrangeiro']);
       $sStyleHidden_fornec_tipo_estrangeiro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_tipo_estrangeiro = 'display: none;';
   $sStyleReadInp_fornec_tipo_estrangeiro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_tipo_estrangeiro']) && $this->nmgp_cmp_readonly['fornec_tipo_estrangeiro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_tipo_estrangeiro']);
       $sStyleReadLab_fornec_tipo_estrangeiro = '';
       $sStyleReadInp_fornec_tipo_estrangeiro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_tipo_estrangeiro']) && $this->nmgp_cmp_hidden['fornec_tipo_estrangeiro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_tipo_estrangeiro" value="<?php echo $this->form_encode_input($fornec_tipo_estrangeiro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_tipo_estrangeiro" style="<?php echo $sStyleHidden_fornec_tipo_estrangeiro; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_tipo_estrangeiro_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_tipo_estrangeiro_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_tipo_estrangeiro"><?php echo $this->nm_new_label['fornec_tipo_estrangeiro']; ?></span></td></tr><tr><td class="css_fornec_tipo_estrangeiro_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_tipo_estrangeiro"]) &&  $this->nmgp_cmp_readonly["fornec_tipo_estrangeiro"] == "on") { 

 ?>
<input type="hidden" name="fornec_tipo_estrangeiro" value="<?php echo $this->form_encode_input($fornec_tipo_estrangeiro) . "\">" . $fornec_tipo_estrangeiro . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_tipo_estrangeiro" class="sc-ui-readonly-fornec_tipo_estrangeiro css_fornec_tipo_estrangeiro_line" style="<?php echo $sStyleReadLab_fornec_tipo_estrangeiro; ?>"><?php echo $this->form_format_readonly("fornec_tipo_estrangeiro", $this->form_encode_input($this->fornec_tipo_estrangeiro)); ?></span><span id="id_read_off_fornec_tipo_estrangeiro" class="css_read_off_fornec_tipo_estrangeiro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_tipo_estrangeiro; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_tipo_estrangeiro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_tipo_estrangeiro" type=text name="fornec_tipo_estrangeiro" value="<?php echo $this->form_encode_input($fornec_tipo_estrangeiro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_tipo_estrangeiro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_tipo_estrangeiro_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_cep']))
    {
        $this->nm_new_label['fornec_cep'] = "CEP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_cep = $this->fornec_cep;
   $sStyleHidden_fornec_cep = '';
   if (isset($this->nmgp_cmp_hidden['fornec_cep']) && $this->nmgp_cmp_hidden['fornec_cep'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_cep']);
       $sStyleHidden_fornec_cep = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_cep = 'display: none;';
   $sStyleReadInp_fornec_cep = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_cep']) && $this->nmgp_cmp_readonly['fornec_cep'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_cep']);
       $sStyleReadLab_fornec_cep = '';
       $sStyleReadInp_fornec_cep = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_cep']) && $this->nmgp_cmp_hidden['fornec_cep'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_cep" value="<?php echo $this->form_encode_input($fornec_cep) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_cep" style="<?php echo $sStyleHidden_fornec_cep; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_cep_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_cep_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_cep"><?php echo $this->nm_new_label['fornec_cep']; ?></span></td></tr><tr><td class="css_fornec_cep_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_cep"]) &&  $this->nmgp_cmp_readonly["fornec_cep"] == "on") { 

 ?>
<input type="hidden" name="fornec_cep" value="<?php echo $this->form_encode_input($fornec_cep) . "\">" . $fornec_cep . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_cep" class="sc-ui-readonly-fornec_cep css_fornec_cep_line" style="<?php echo $sStyleReadLab_fornec_cep; ?>"><?php echo $this->form_format_readonly("fornec_cep", $this->form_encode_input($this->fornec_cep)); ?></span><span id="id_read_off_fornec_cep" class="css_read_off_fornec_cep<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_cep; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_cep_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_cep" type=text name="fornec_cep" value="<?php echo $this->form_encode_input($fornec_cep) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'cep', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "bzipcode", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_tbl_fornecedores'). "/form_tbl_fornecedores_mob_cep.php?cep=&form_origem=F1;CEP,fornec_cep;UF,fornec_uf;CIDADE,fornec_municipio;BAIRRO,fornec_bairro;RUA,fornec_logradouro;TIPOEXT,fornec_tipo_logradouro;LOGRAD,fornec_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_tbl_fornecedores'). "/form_tbl_fornecedores_mob_cep.php?cep=&form_origem=F1;CEP,fornec_cep;UF,fornec_uf;CIDADE,fornec_municipio;BAIRRO,fornec_bairro;RUA,fornec_logradouro;TIPOEXT,fornec_tipo_logradouro;LOGRAD,fornec_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "fornec_cep_cep", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_cep_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_cep_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['fornec_pais']))
   {
       $this->nm_new_label['fornec_pais'] = "País:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_pais = $this->fornec_pais;
   $sStyleHidden_fornec_pais = '';
   if (isset($this->nmgp_cmp_hidden['fornec_pais']) && $this->nmgp_cmp_hidden['fornec_pais'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_pais']);
       $sStyleHidden_fornec_pais = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_pais = 'display: none;';
   $sStyleReadInp_fornec_pais = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_pais']) && $this->nmgp_cmp_readonly['fornec_pais'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_pais']);
       $sStyleReadLab_fornec_pais = '';
       $sStyleReadInp_fornec_pais = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_pais']) && $this->nmgp_cmp_hidden['fornec_pais'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="fornec_pais" value="<?php echo $this->form_encode_input($this->fornec_pais) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_pais" style="<?php echo $sStyleHidden_fornec_pais; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_pais_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_pais_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_pais"><?php echo $this->nm_new_label['fornec_pais']; ?></span></td></tr><tr><td class="css_fornec_pais_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_pais"]) &&  $this->nmgp_cmp_readonly["fornec_pais"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais'] = array(); 
    }

   $old_value_fornec_id = $this->fornec_id;
   $old_value_fornec_cnpj = $this->fornec_cnpj;
   $old_value_fornec_cep = $this->fornec_cep;
   $old_value_fornec_celular = $this->fornec_celular;
   $old_value_fornec_tel = $this->fornec_tel;
   $this->nm_tira_formatacao();


   $unformatted_value_fornec_id = $this->fornec_id;
   $unformatted_value_fornec_cnpj = $this->fornec_cnpj;
   $unformatted_value_fornec_cep = $this->fornec_cep;
   $unformatted_value_fornec_celular = $this->fornec_celular;
   $unformatted_value_fornec_tel = $this->fornec_tel;

   $nm_comando = "SELECT pais_id, descricao  FROM tbl_paises  ORDER BY descricao";

   $this->fornec_id = $old_value_fornec_id;
   $this->fornec_cnpj = $old_value_fornec_cnpj;
   $this->fornec_cep = $old_value_fornec_cep;
   $this->fornec_celular = $old_value_fornec_celular;
   $this->fornec_tel = $old_value_fornec_tel;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais'][] = $rs->fields[0];
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
   $fornec_pais_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->fornec_pais_1))
          {
              foreach ($this->fornec_pais_1 as $tmp_fornec_pais)
              {
                  if (trim($tmp_fornec_pais) === trim($cadaselect[1])) {$fornec_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->fornec_pais) && trim($this->fornec_pais) === trim($cadaselect[1])) {$fornec_pais_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="fornec_pais" value="<?php echo $this->form_encode_input($fornec_pais) . "\">" . $fornec_pais_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_fornec_pais();
   $x = 0 ; 
   $fornec_pais_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->fornec_pais_1))
          {
              foreach ($this->fornec_pais_1 as $tmp_fornec_pais)
              {
                  if (trim($tmp_fornec_pais) === trim($cadaselect[1])) {$fornec_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->fornec_pais)) {
                 if (trim($this->fornec_pais) == trim($cadaselect[1])) { $fornec_pais_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->fornec_pais == $cadaselect[1]) { $fornec_pais_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($fornec_pais_look))
          {
              $fornec_pais_look = $this->fornec_pais;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_fornec_pais\" class=\"css_fornec_pais_line\" style=\"" .  $sStyleReadLab_fornec_pais . "\">" . $this->form_format_readonly("fornec_pais", $this->form_encode_input($fornec_pais_look)) . "</span><span id=\"id_read_off_fornec_pais\" class=\"css_read_off_fornec_pais" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_fornec_pais . "\">";
   echo " <span id=\"idAjaxSelect_fornec_pais\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_fornec_pais_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_fornec_pais\" name=\"fornec_pais\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_pais'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;","BRASIL") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->fornec_pais) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->fornec_pais)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_pais_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_pais_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_uf']))
    {
        $this->nm_new_label['fornec_uf'] = "UF:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_uf = $this->fornec_uf;
   $sStyleHidden_fornec_uf = '';
   if (isset($this->nmgp_cmp_hidden['fornec_uf']) && $this->nmgp_cmp_hidden['fornec_uf'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_uf']);
       $sStyleHidden_fornec_uf = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_uf = 'display: none;';
   $sStyleReadInp_fornec_uf = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_uf']) && $this->nmgp_cmp_readonly['fornec_uf'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_uf']);
       $sStyleReadLab_fornec_uf = '';
       $sStyleReadInp_fornec_uf = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_uf']) && $this->nmgp_cmp_hidden['fornec_uf'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_uf" value="<?php echo $this->form_encode_input($fornec_uf) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_uf" style="<?php echo $sStyleHidden_fornec_uf; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_uf_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_uf_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_uf"><?php echo $this->nm_new_label['fornec_uf']; ?></span></td></tr><tr><td class="css_fornec_uf_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_uf"]) &&  $this->nmgp_cmp_readonly["fornec_uf"] == "on") { 

 ?>
<input type="hidden" name="fornec_uf" value="<?php echo $this->form_encode_input($fornec_uf) . "\">" . $fornec_uf . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_uf" class="sc-ui-readonly-fornec_uf css_fornec_uf_line" style="<?php echo $sStyleReadLab_fornec_uf; ?>"><?php echo $this->form_format_readonly("fornec_uf", $this->form_encode_input($this->fornec_uf)); ?></span><span id="id_read_off_fornec_uf" class="css_read_off_fornec_uf<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_uf; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_uf_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_uf" type=text name="fornec_uf" value="<?php echo $this->form_encode_input($fornec_uf) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=2"; } ?> maxlength=2 alt="{datatype: 'text', maxLength: 2, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_uf_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_uf_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_municipio']))
    {
        $this->nm_new_label['fornec_municipio'] = "Município:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_municipio = $this->fornec_municipio;
   $sStyleHidden_fornec_municipio = '';
   if (isset($this->nmgp_cmp_hidden['fornec_municipio']) && $this->nmgp_cmp_hidden['fornec_municipio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_municipio']);
       $sStyleHidden_fornec_municipio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_municipio = 'display: none;';
   $sStyleReadInp_fornec_municipio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_municipio']) && $this->nmgp_cmp_readonly['fornec_municipio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_municipio']);
       $sStyleReadLab_fornec_municipio = '';
       $sStyleReadInp_fornec_municipio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_municipio']) && $this->nmgp_cmp_hidden['fornec_municipio'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_municipio" value="<?php echo $this->form_encode_input($fornec_municipio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_municipio" style="<?php echo $sStyleHidden_fornec_municipio; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_municipio_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_municipio_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_municipio"><?php echo $this->nm_new_label['fornec_municipio']; ?></span></td></tr><tr><td class="css_fornec_municipio_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_municipio"]) &&  $this->nmgp_cmp_readonly["fornec_municipio"] == "on") { 

 ?>
<input type="hidden" name="fornec_municipio" value="<?php echo $this->form_encode_input($fornec_municipio) . "\">" . $fornec_municipio . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_municipio" class="sc-ui-readonly-fornec_municipio css_fornec_municipio_line" style="<?php echo $sStyleReadLab_fornec_municipio; ?>"><?php echo $this->form_format_readonly("fornec_municipio", $this->form_encode_input($this->fornec_municipio)); ?></span><span id="id_read_off_fornec_municipio" class="css_read_off_fornec_municipio<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_municipio; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_municipio_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_municipio" type=text name="fornec_municipio" value="<?php echo $this->form_encode_input($fornec_municipio) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_municipio_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_municipio_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_bairro']))
    {
        $this->nm_new_label['fornec_bairro'] = "Bairro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_bairro = $this->fornec_bairro;
   $sStyleHidden_fornec_bairro = '';
   if (isset($this->nmgp_cmp_hidden['fornec_bairro']) && $this->nmgp_cmp_hidden['fornec_bairro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_bairro']);
       $sStyleHidden_fornec_bairro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_bairro = 'display: none;';
   $sStyleReadInp_fornec_bairro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_bairro']) && $this->nmgp_cmp_readonly['fornec_bairro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_bairro']);
       $sStyleReadLab_fornec_bairro = '';
       $sStyleReadInp_fornec_bairro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_bairro']) && $this->nmgp_cmp_hidden['fornec_bairro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_bairro" value="<?php echo $this->form_encode_input($fornec_bairro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_bairro" style="<?php echo $sStyleHidden_fornec_bairro; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_bairro_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_bairro_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_bairro"><?php echo $this->nm_new_label['fornec_bairro']; ?></span></td></tr><tr><td class="css_fornec_bairro_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_bairro"]) &&  $this->nmgp_cmp_readonly["fornec_bairro"] == "on") { 

 ?>
<input type="hidden" name="fornec_bairro" value="<?php echo $this->form_encode_input($fornec_bairro) . "\">" . $fornec_bairro . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_bairro" class="sc-ui-readonly-fornec_bairro css_fornec_bairro_line" style="<?php echo $sStyleReadLab_fornec_bairro; ?>"><?php echo $this->form_format_readonly("fornec_bairro", $this->form_encode_input($this->fornec_bairro)); ?></span><span id="id_read_off_fornec_bairro" class="css_read_off_fornec_bairro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_bairro; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_bairro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_bairro" type=text name="fornec_bairro" value="<?php echo $this->form_encode_input($fornec_bairro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_bairro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_bairro_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_tipo_logradouro']))
    {
        $this->nm_new_label['fornec_tipo_logradouro'] = "Fornec Tipo Logradouro";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_tipo_logradouro = $this->fornec_tipo_logradouro;
   $sStyleHidden_fornec_tipo_logradouro = '';
   if (isset($this->nmgp_cmp_hidden['fornec_tipo_logradouro']) && $this->nmgp_cmp_hidden['fornec_tipo_logradouro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_tipo_logradouro']);
       $sStyleHidden_fornec_tipo_logradouro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_tipo_logradouro = 'display: none;';
   $sStyleReadInp_fornec_tipo_logradouro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_tipo_logradouro']) && $this->nmgp_cmp_readonly['fornec_tipo_logradouro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_tipo_logradouro']);
       $sStyleReadLab_fornec_tipo_logradouro = '';
       $sStyleReadInp_fornec_tipo_logradouro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_tipo_logradouro']) && $this->nmgp_cmp_hidden['fornec_tipo_logradouro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_tipo_logradouro" value="<?php echo $this->form_encode_input($fornec_tipo_logradouro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_tipo_logradouro" style="<?php echo $sStyleHidden_fornec_tipo_logradouro; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_tipo_logradouro_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_tipo_logradouro_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_tipo_logradouro"><?php echo $this->nm_new_label['fornec_tipo_logradouro']; ?></span></td></tr><tr><td class="css_fornec_tipo_logradouro_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_tipo_logradouro"]) &&  $this->nmgp_cmp_readonly["fornec_tipo_logradouro"] == "on") { 

 ?>
<input type="hidden" name="fornec_tipo_logradouro" value="<?php echo $this->form_encode_input($fornec_tipo_logradouro) . "\">" . $fornec_tipo_logradouro . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_tipo_logradouro" class="sc-ui-readonly-fornec_tipo_logradouro css_fornec_tipo_logradouro_line" style="<?php echo $sStyleReadLab_fornec_tipo_logradouro; ?>"><?php echo $this->form_format_readonly("fornec_tipo_logradouro", $this->form_encode_input($this->fornec_tipo_logradouro)); ?></span><span id="id_read_off_fornec_tipo_logradouro" class="css_read_off_fornec_tipo_logradouro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_tipo_logradouro; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_tipo_logradouro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_tipo_logradouro" type=text name="fornec_tipo_logradouro" value="<?php echo $this->form_encode_input($fornec_tipo_logradouro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_tipo_logradouro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_tipo_logradouro_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_logradouro']))
    {
        $this->nm_new_label['fornec_logradouro'] = "Logradouro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_logradouro = $this->fornec_logradouro;
   $sStyleHidden_fornec_logradouro = '';
   if (isset($this->nmgp_cmp_hidden['fornec_logradouro']) && $this->nmgp_cmp_hidden['fornec_logradouro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_logradouro']);
       $sStyleHidden_fornec_logradouro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_logradouro = 'display: none;';
   $sStyleReadInp_fornec_logradouro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_logradouro']) && $this->nmgp_cmp_readonly['fornec_logradouro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_logradouro']);
       $sStyleReadLab_fornec_logradouro = '';
       $sStyleReadInp_fornec_logradouro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_logradouro']) && $this->nmgp_cmp_hidden['fornec_logradouro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_logradouro" value="<?php echo $this->form_encode_input($fornec_logradouro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_logradouro" style="<?php echo $sStyleHidden_fornec_logradouro; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_logradouro_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_logradouro_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_logradouro"><?php echo $this->nm_new_label['fornec_logradouro']; ?></span></td></tr><tr><td class="css_fornec_logradouro_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_logradouro"]) &&  $this->nmgp_cmp_readonly["fornec_logradouro"] == "on") { 

 ?>
<input type="hidden" name="fornec_logradouro" value="<?php echo $this->form_encode_input($fornec_logradouro) . "\">" . $fornec_logradouro . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_logradouro" class="sc-ui-readonly-fornec_logradouro css_fornec_logradouro_line" style="<?php echo $sStyleReadLab_fornec_logradouro; ?>"><?php echo $this->form_format_readonly("fornec_logradouro", $this->form_encode_input($this->fornec_logradouro)); ?></span><span id="id_read_off_fornec_logradouro" class="css_read_off_fornec_logradouro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_logradouro; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_logradouro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_logradouro" type=text name="fornec_logradouro" value="<?php echo $this->form_encode_input($fornec_logradouro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_logradouro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_logradouro_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_numero']))
    {
        $this->nm_new_label['fornec_numero'] = "Numero:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_numero = $this->fornec_numero;
   $sStyleHidden_fornec_numero = '';
   if (isset($this->nmgp_cmp_hidden['fornec_numero']) && $this->nmgp_cmp_hidden['fornec_numero'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_numero']);
       $sStyleHidden_fornec_numero = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_numero = 'display: none;';
   $sStyleReadInp_fornec_numero = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_numero']) && $this->nmgp_cmp_readonly['fornec_numero'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_numero']);
       $sStyleReadLab_fornec_numero = '';
       $sStyleReadInp_fornec_numero = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_numero']) && $this->nmgp_cmp_hidden['fornec_numero'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_numero" value="<?php echo $this->form_encode_input($fornec_numero) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_numero" style="<?php echo $sStyleHidden_fornec_numero; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_numero_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_numero_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_numero"><?php echo $this->nm_new_label['fornec_numero']; ?></span></td></tr><tr><td class="css_fornec_numero_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_numero"]) &&  $this->nmgp_cmp_readonly["fornec_numero"] == "on") { 

 ?>
<input type="hidden" name="fornec_numero" value="<?php echo $this->form_encode_input($fornec_numero) . "\">" . $fornec_numero . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_numero" class="sc-ui-readonly-fornec_numero css_fornec_numero_line" style="<?php echo $sStyleReadLab_fornec_numero; ?>"><?php echo $this->form_format_readonly("fornec_numero", $this->form_encode_input($this->fornec_numero)); ?></span><span id="id_read_off_fornec_numero" class="css_read_off_fornec_numero<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_numero; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_numero_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_numero" type=text name="fornec_numero" value="<?php echo $this->form_encode_input($fornec_numero) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_numero_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_numero_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_complemento']))
    {
        $this->nm_new_label['fornec_complemento'] = "Complemento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_complemento = $this->fornec_complemento;
   $sStyleHidden_fornec_complemento = '';
   if (isset($this->nmgp_cmp_hidden['fornec_complemento']) && $this->nmgp_cmp_hidden['fornec_complemento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_complemento']);
       $sStyleHidden_fornec_complemento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_complemento = 'display: none;';
   $sStyleReadInp_fornec_complemento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_complemento']) && $this->nmgp_cmp_readonly['fornec_complemento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_complemento']);
       $sStyleReadLab_fornec_complemento = '';
       $sStyleReadInp_fornec_complemento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_complemento']) && $this->nmgp_cmp_hidden['fornec_complemento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_complemento" value="<?php echo $this->form_encode_input($fornec_complemento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_complemento" style="<?php echo $sStyleHidden_fornec_complemento; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_complemento_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_complemento_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_complemento"><?php echo $this->nm_new_label['fornec_complemento']; ?></span></td></tr><tr><td class="css_fornec_complemento_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_complemento"]) &&  $this->nmgp_cmp_readonly["fornec_complemento"] == "on") { 

 ?>
<input type="hidden" name="fornec_complemento" value="<?php echo $this->form_encode_input($fornec_complemento) . "\">" . $fornec_complemento . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_complemento" class="sc-ui-readonly-fornec_complemento css_fornec_complemento_line" style="<?php echo $sStyleReadLab_fornec_complemento; ?>"><?php echo $this->form_format_readonly("fornec_complemento", $this->form_encode_input($this->fornec_complemento)); ?></span><span id="id_read_off_fornec_complemento" class="css_read_off_fornec_complemento<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_complemento; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_complemento_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_complemento" type=text name="fornec_complemento" value="<?php echo $this->form_encode_input($fornec_complemento) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_complemento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_complemento_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_email']))
    {
        $this->nm_new_label['fornec_email'] = "E-mail:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_email = $this->fornec_email;
   $sStyleHidden_fornec_email = '';
   if (isset($this->nmgp_cmp_hidden['fornec_email']) && $this->nmgp_cmp_hidden['fornec_email'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_email']);
       $sStyleHidden_fornec_email = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_email = 'display: none;';
   $sStyleReadInp_fornec_email = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_email']) && $this->nmgp_cmp_readonly['fornec_email'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_email']);
       $sStyleReadLab_fornec_email = '';
       $sStyleReadInp_fornec_email = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_email']) && $this->nmgp_cmp_hidden['fornec_email'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_email" value="<?php echo $this->form_encode_input($fornec_email) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_email" style="<?php echo $sStyleHidden_fornec_email; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_email_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_email_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_email"><?php echo $this->nm_new_label['fornec_email']; ?></span></td></tr><tr><td class="css_fornec_email_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_email"]) &&  $this->nmgp_cmp_readonly["fornec_email"] == "on") { 

 ?>
<input type="hidden" name="fornec_email" value="<?php echo $this->form_encode_input($fornec_email) . "\">" . $fornec_email . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_email" class="sc-ui-readonly-fornec_email css_fornec_email_line" style="<?php echo $sStyleReadLab_fornec_email; ?>"><?php echo $this->form_format_readonly("fornec_email", $this->form_encode_input($this->fornec_email)); ?></span><span id="id_read_off_fornec_email" class="css_read_off_fornec_email<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_email; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_email_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_email" type=text name="fornec_email" value="<?php echo $this->form_encode_input($fornec_email) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.fornec_email.value != '') {window.open('mailto:' + document.F1.fornec_email.value); }", "if (document.F1.fornec_email.value != '') {window.open('mailto:' + document.F1.fornec_email.value); }", "fornec_email_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_email_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_email_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_website']))
    {
        $this->nm_new_label['fornec_website'] = "Site:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_website = $this->fornec_website;
   $sStyleHidden_fornec_website = '';
   if (isset($this->nmgp_cmp_hidden['fornec_website']) && $this->nmgp_cmp_hidden['fornec_website'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_website']);
       $sStyleHidden_fornec_website = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_website = 'display: none;';
   $sStyleReadInp_fornec_website = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_website']) && $this->nmgp_cmp_readonly['fornec_website'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_website']);
       $sStyleReadLab_fornec_website = '';
       $sStyleReadInp_fornec_website = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_website']) && $this->nmgp_cmp_hidden['fornec_website'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_website" value="<?php echo $this->form_encode_input($fornec_website) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_website" style="<?php echo $sStyleHidden_fornec_website; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_website_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_website_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_website"><?php echo $this->nm_new_label['fornec_website']; ?></span></td></tr><tr><td class="css_fornec_website_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_website"]) &&  $this->nmgp_cmp_readonly["fornec_website"] == "on") { 

 ?>
<input type="hidden" name="fornec_website" value="<?php echo $this->form_encode_input($fornec_website) . "\">" . $fornec_website . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_website" class="sc-ui-readonly-fornec_website css_fornec_website_line" style="<?php echo $sStyleReadLab_fornec_website; ?>"><?php echo $this->form_format_readonly("fornec_website", $this->form_encode_input($this->fornec_website)); ?></span><span id="id_read_off_fornec_website" class="css_read_off_fornec_website<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_website; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_website_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_website" type=text name="fornec_website" value="<?php echo $this->form_encode_input($fornec_website) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "blink", "window.open(nm_link_url(document.F1.fornec_website.value), '_blank')", "window.open(nm_link_url(document.F1.fornec_website.value), '_blank')", "fornec_website_url", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_website_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_website_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_fornec_website_dumb = ('' == $sStyleHidden_fornec_website) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_fornec_website_dumb" style="<?php echo $sStyleHidden_fornec_website_dumb; ?>"></TD>
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
    if (!isset($this->nm_new_label['fornec_celular']))
    {
        $this->nm_new_label['fornec_celular'] = "Celular:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_celular = $this->fornec_celular;
   $sStyleHidden_fornec_celular = '';
   if (isset($this->nmgp_cmp_hidden['fornec_celular']) && $this->nmgp_cmp_hidden['fornec_celular'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_celular']);
       $sStyleHidden_fornec_celular = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_celular = 'display: none;';
   $sStyleReadInp_fornec_celular = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_celular']) && $this->nmgp_cmp_readonly['fornec_celular'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_celular']);
       $sStyleReadLab_fornec_celular = '';
       $sStyleReadInp_fornec_celular = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_celular']) && $this->nmgp_cmp_hidden['fornec_celular'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_celular" value="<?php echo $this->form_encode_input($fornec_celular) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_celular" style="<?php echo $sStyleHidden_fornec_celular; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_celular_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_celular_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_celular"><?php echo $this->nm_new_label['fornec_celular']; ?></span></td></tr><tr><td class="css_fornec_celular_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_celular"]) &&  $this->nmgp_cmp_readonly["fornec_celular"] == "on") { 

 ?>
<input type="hidden" name="fornec_celular" value="<?php echo $this->form_encode_input($fornec_celular) . "\">" . $fornec_celular . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_celular" class="sc-ui-readonly-fornec_celular css_fornec_celular_line" style="<?php echo $sStyleReadLab_fornec_celular; ?>"><?php echo $this->form_format_readonly("fornec_celular", $this->form_encode_input($this->fornec_celular)); ?></span><span id="id_read_off_fornec_celular" class="css_read_off_fornec_celular<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_celular; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_celular_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_celular" type=text name="fornec_celular" value="<?php echo $this->form_encode_input($fornec_celular) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=40 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 99999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_celular_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_celular_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_tel']))
    {
        $this->nm_new_label['fornec_tel'] = "Fone:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_tel = $this->fornec_tel;
   $sStyleHidden_fornec_tel = '';
   if (isset($this->nmgp_cmp_hidden['fornec_tel']) && $this->nmgp_cmp_hidden['fornec_tel'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_tel']);
       $sStyleHidden_fornec_tel = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_tel = 'display: none;';
   $sStyleReadInp_fornec_tel = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_tel']) && $this->nmgp_cmp_readonly['fornec_tel'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_tel']);
       $sStyleReadLab_fornec_tel = '';
       $sStyleReadInp_fornec_tel = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_tel']) && $this->nmgp_cmp_hidden['fornec_tel'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_tel" value="<?php echo $this->form_encode_input($fornec_tel) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_tel" style="<?php echo $sStyleHidden_fornec_tel; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_tel_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_tel_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_tel"><?php echo $this->nm_new_label['fornec_tel']; ?></span></td></tr><tr><td class="css_fornec_tel_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_tel"]) &&  $this->nmgp_cmp_readonly["fornec_tel"] == "on") { 

 ?>
<input type="hidden" name="fornec_tel" value="<?php echo $this->form_encode_input($fornec_tel) . "\">" . $fornec_tel . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_tel" class="sc-ui-readonly-fornec_tel css_fornec_tel_line" style="<?php echo $sStyleReadLab_fornec_tel; ?>"><?php echo $this->form_format_readonly("fornec_tel", $this->form_encode_input($this->fornec_tel)); ?></span><span id="id_read_off_fornec_tel" class="css_read_off_fornec_tel<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_tel; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_tel_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_tel" type=text name="fornec_tel" value="<?php echo $this->form_encode_input($fornec_tel) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=39 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 9999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_tel_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_tel_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_contato']))
    {
        $this->nm_new_label['fornec_contato'] = "Contato:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_contato = $this->fornec_contato;
   $sStyleHidden_fornec_contato = '';
   if (isset($this->nmgp_cmp_hidden['fornec_contato']) && $this->nmgp_cmp_hidden['fornec_contato'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_contato']);
       $sStyleHidden_fornec_contato = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_contato = 'display: none;';
   $sStyleReadInp_fornec_contato = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_contato']) && $this->nmgp_cmp_readonly['fornec_contato'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_contato']);
       $sStyleReadLab_fornec_contato = '';
       $sStyleReadInp_fornec_contato = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_contato']) && $this->nmgp_cmp_hidden['fornec_contato'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_contato" value="<?php echo $this->form_encode_input($fornec_contato) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_contato" style="<?php echo $sStyleHidden_fornec_contato; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_contato_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_contato_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_contato"><?php echo $this->nm_new_label['fornec_contato']; ?></span></td></tr><tr><td class="css_fornec_contato_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_contato"]) &&  $this->nmgp_cmp_readonly["fornec_contato"] == "on") { 

 ?>
<input type="hidden" name="fornec_contato" value="<?php echo $this->form_encode_input($fornec_contato) . "\">" . $fornec_contato . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_contato" class="sc-ui-readonly-fornec_contato css_fornec_contato_line" style="<?php echo $sStyleReadLab_fornec_contato; ?>"><?php echo $this->form_format_readonly("fornec_contato", $this->form_encode_input($this->fornec_contato)); ?></span><span id="id_read_off_fornec_contato" class="css_read_off_fornec_contato<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_contato; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_contato_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_contato" type=text name="fornec_contato" value="<?php echo $this->form_encode_input($fornec_contato) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_contato_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_contato_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_codfor_estrangeiro']))
    {
        $this->nm_new_label['fornec_codfor_estrangeiro'] = "Cód. Estrangeiro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_codfor_estrangeiro = $this->fornec_codfor_estrangeiro;
   $sStyleHidden_fornec_codfor_estrangeiro = '';
   if (isset($this->nmgp_cmp_hidden['fornec_codfor_estrangeiro']) && $this->nmgp_cmp_hidden['fornec_codfor_estrangeiro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_codfor_estrangeiro']);
       $sStyleHidden_fornec_codfor_estrangeiro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_codfor_estrangeiro = 'display: none;';
   $sStyleReadInp_fornec_codfor_estrangeiro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_codfor_estrangeiro']) && $this->nmgp_cmp_readonly['fornec_codfor_estrangeiro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_codfor_estrangeiro']);
       $sStyleReadLab_fornec_codfor_estrangeiro = '';
       $sStyleReadInp_fornec_codfor_estrangeiro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_codfor_estrangeiro']) && $this->nmgp_cmp_hidden['fornec_codfor_estrangeiro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_codfor_estrangeiro" value="<?php echo $this->form_encode_input($fornec_codfor_estrangeiro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_codfor_estrangeiro" style="<?php echo $sStyleHidden_fornec_codfor_estrangeiro; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_codfor_estrangeiro_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_codfor_estrangeiro_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_codfor_estrangeiro"><?php echo $this->nm_new_label['fornec_codfor_estrangeiro']; ?></span></td></tr><tr><td class="css_fornec_codfor_estrangeiro_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_codfor_estrangeiro"]) &&  $this->nmgp_cmp_readonly["fornec_codfor_estrangeiro"] == "on") { 

 ?>
<input type="hidden" name="fornec_codfor_estrangeiro" value="<?php echo $this->form_encode_input($fornec_codfor_estrangeiro) . "\">" . $fornec_codfor_estrangeiro . ""; ?>
<?php } else { ?>
<span id="id_read_on_fornec_codfor_estrangeiro" class="sc-ui-readonly-fornec_codfor_estrangeiro css_fornec_codfor_estrangeiro_line" style="<?php echo $sStyleReadLab_fornec_codfor_estrangeiro; ?>"><?php echo $this->form_format_readonly("fornec_codfor_estrangeiro", $this->form_encode_input($this->fornec_codfor_estrangeiro)); ?></span><span id="id_read_off_fornec_codfor_estrangeiro" class="css_read_off_fornec_codfor_estrangeiro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_fornec_codfor_estrangeiro; ?>">
 <input class="sc-js-input scFormObjectOdd css_fornec_codfor_estrangeiro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_fornec_codfor_estrangeiro" type=text name="fornec_codfor_estrangeiro" value="<?php echo $this->form_encode_input($fornec_codfor_estrangeiro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=30"; } ?> maxlength=30 alt="{datatype: 'text', maxLength: 30, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_codfor_estrangeiro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_codfor_estrangeiro_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['fornec_ativo']))
    {
        $this->nm_new_label['fornec_ativo'] = "Ativo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $fornec_ativo = $this->fornec_ativo;
   $sStyleHidden_fornec_ativo = '';
   if (isset($this->nmgp_cmp_hidden['fornec_ativo']) && $this->nmgp_cmp_hidden['fornec_ativo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['fornec_ativo']);
       $sStyleHidden_fornec_ativo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_fornec_ativo = 'display: none;';
   $sStyleReadInp_fornec_ativo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['fornec_ativo']) && $this->nmgp_cmp_readonly['fornec_ativo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['fornec_ativo']);
       $sStyleReadLab_fornec_ativo = '';
       $sStyleReadInp_fornec_ativo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['fornec_ativo']) && $this->nmgp_cmp_hidden['fornec_ativo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="fornec_ativo" value="<?php echo $this->form_encode_input($fornec_ativo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd" id="hidden_field_data_fornec_ativo" style="<?php echo $sStyleHidden_fornec_ativo; ?>"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_fornec_ativo_line" style="vertical-align: top;padding: 0px"><table style="border-spacing: 0px; border-width: 0px; border-collapse: collapse; width: 100%" cellspacing=0 cellpadding=0><tr><td class="scFormLabelOddFormat scFormLabelAboveOddFormat css_fornec_ativo_label" style=" padding: 0px; width: 100%;"><span id="id_label_fornec_ativo"><?php echo $this->nm_new_label['fornec_ativo']; ?></span></td></tr><tr><td class="css_fornec_ativo_line" style="padding: 0px; width: 100%;">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["fornec_ativo"]) &&  $this->nmgp_cmp_readonly["fornec_ativo"] == "on") { 

 if ("Y" == $this->fornec_ativo) { $fornec_ativo_look = "Ativo";} 
 if ("N" == $this->fornec_ativo) { $fornec_ativo_look = "Inativo";} 
?>
<input type="hidden" name="fornec_ativo" value="<?php echo $this->form_encode_input($fornec_ativo) . "\">" . $fornec_ativo_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->fornec_ativo) { $fornec_ativo_look = "Ativo";} 
 if ("N" == $this->fornec_ativo) { $fornec_ativo_look = "Inativo";} 
?>
<span id="id_read_on_fornec_ativo"  class="css_fornec_ativo_line" style="<?php echo $sStyleReadLab_fornec_ativo; ?>"><?php echo $this->form_format_readonly("fornec_ativo", $this->form_encode_input($fornec_ativo_look)); ?></span><span id="id_read_off_fornec_ativo" class="css_read_off_fornec_ativo css_fornec_ativo_line" style="<?php echo $sStyleReadInp_fornec_ativo; ?>"><div id="idAjaxRadio_fornec_ativo" style="display: inline-block"  class="css_fornec_ativo_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_fornec_ativo_line"><?php $tempOptionId = "id-opt-fornec_ativo" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-fornec_ativo sc-ui-radio-fornec_ativo" type=radio name="fornec_ativo" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_ativo'][] = 'Y'; ?>
<?php  if ("Y" == $this->fornec_ativo)  { echo " checked" ;} ?><?php  if (empty($this->fornec_ativo)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Ativo</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_fornec_ativo_line"><?php $tempOptionId = "id-opt-fornec_ativo" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-fornec_ativo sc-ui-radio-fornec_ativo" type=radio name="fornec_ativo" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['Lookup_fornec_ativo'][] = 'N'; ?>
<?php  if ("N" == $this->fornec_ativo)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Inativo</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_fornec_ativo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_fornec_ativo_text"></span></td></tr></table></td></tr></table></td></tr></table> </TD>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['birpara'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['first'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['back'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['forward'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_tbl_fornecedores_mob");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_tbl_fornecedores_mob");
 parent.scAjaxDetailHeight("form_tbl_fornecedores_mob", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_tbl_fornecedores_mob", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_tbl_fornecedores_mob", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['sc_modal'])
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_fornecedores_mob']['inside_nested_iframe']) {
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
