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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("BRSVP - Cadastro de Empresas Inclusão"); } else { echo strip_tags("BRSVP - Cadastro de Empresas Edição"); } ?></TITLE>
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

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_progressbar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_empresas_rsvp/form_empresas_rsvp_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_empresas_rsvp_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_empresas_rsvp_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['recarga'];
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['link_info']['remove_border']) {
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
 include_once("form_empresas_rsvp_js0.php");
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
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_empresas_rsvp'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_empresas_rsvp'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['fast_search'][2] : "";
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
          $SC_Label_atu['empresa_id'] = (isset($this->nm_new_label['empresa_id'])) ? $this->nm_new_label['empresa_id'] : 'Empresa Id'; 
          $SC_Label_atu['empresa_cnpj'] = (isset($this->nm_new_label['empresa_cnpj'])) ? $this->nm_new_label['empresa_cnpj'] : 'CNPJ:'; 
          $SC_Label_atu['empresa_fantasia'] = (isset($this->nm_new_label['empresa_fantasia'])) ? $this->nm_new_label['empresa_fantasia'] : 'Fantasia:'; 
          $SC_Label_atu['empresa_razsoc'] = (isset($this->nm_new_label['empresa_razsoc'])) ? $this->nm_new_label['empresa_razsoc'] : 'Razão Social:'; 
          $SC_Label_atu['empresa_inscestad'] = (isset($this->nm_new_label['empresa_inscestad'])) ? $this->nm_new_label['empresa_inscestad'] : 'Insc. Estadual:'; 
          $SC_Label_atu['empresa_facebook'] = (isset($this->nm_new_label['empresa_facebook'])) ? $this->nm_new_label['empresa_facebook'] : ' Facebook:'; 
          $SC_Label_atu['empresa_google'] = (isset($this->nm_new_label['empresa_google'])) ? $this->nm_new_label['empresa_google'] : 'Google:'; 
          $SC_Label_atu['empresa_twitter'] = (isset($this->nm_new_label['empresa_twitter'])) ? $this->nm_new_label['empresa_twitter'] : 'Twitter:'; 
          $SC_Label_atu['empresa_skype'] = (isset($this->nm_new_label['empresa_skype'])) ? $this->nm_new_label['empresa_skype'] : 'Skype:'; 
          $SC_Label_atu['empresa_website'] = (isset($this->nm_new_label['empresa_website'])) ? $this->nm_new_label['empresa_website'] : 'Website'; 
          $SC_Label_atu['empresa_status'] = (isset($this->nm_new_label['empresa_status'])) ? $this->nm_new_label['empresa_status'] : 'Status:'; 
          $SC_Label_atu['empresa_logo'] = (isset($this->nm_new_label['empresa_logo'])) ? $this->nm_new_label['empresa_logo'] : 'Logotipo:'; 
          $SC_Label_atu['empresa_cep'] = (isset($this->nm_new_label['empresa_cep'])) ? $this->nm_new_label['empresa_cep'] : 'CEP:'; 
          $SC_Label_atu['empresa_pais'] = (isset($this->nm_new_label['empresa_pais'])) ? $this->nm_new_label['empresa_pais'] : 'Pais:'; 
          $SC_Label_atu['empresa_uf'] = (isset($this->nm_new_label['empresa_uf'])) ? $this->nm_new_label['empresa_uf'] : 'Uf:'; 
          $SC_Label_atu['empresa_municipio'] = (isset($this->nm_new_label['empresa_municipio'])) ? $this->nm_new_label['empresa_municipio'] : 'Município:'; 
          $SC_Label_atu['empresa_bairro'] = (isset($this->nm_new_label['empresa_bairro'])) ? $this->nm_new_label['empresa_bairro'] : 'Bairro:'; 
          $SC_Label_atu['empresa_logradouro'] = (isset($this->nm_new_label['empresa_logradouro'])) ? $this->nm_new_label['empresa_logradouro'] : 'Logradouro:'; 
          $SC_Label_atu['empresa_numero'] = (isset($this->nm_new_label['empresa_numero'])) ? $this->nm_new_label['empresa_numero'] : 'Número:'; 
          $SC_Label_atu['empresa_complem'] = (isset($this->nm_new_label['empresa_complem'])) ? $this->nm_new_label['empresa_complem'] : 'Complemento:'; 
          $SC_Label_atu['empresa_email'] = (isset($this->nm_new_label['empresa_email'])) ? $this->nm_new_label['empresa_email'] : 'E-Mail:'; 
          $SC_Label_atu['empresa_telefone'] = (isset($this->nm_new_label['empresa_telefone'])) ? $this->nm_new_label['empresa_telefone'] : 'Telefone:'; 
          $SC_Label_atu['empresa_fax'] = (isset($this->nm_new_label['empresa_fax'])) ? $this->nm_new_label['empresa_fax'] : 'Fax:'; 
          $SC_Label_atu['empresa_celular'] = (isset($this->nm_new_label['empresa_celular'])) ? $this->nm_new_label['empresa_celular'] : 'Celular:'; 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
   if (!isset($this->nmgp_cmp_hidden['empresa_id']))
   {
       $this->nmgp_cmp_hidden['empresa_id'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['empresa_facebook']))
   {
       $this->nmgp_cmp_hidden['empresa_facebook'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['empresa_google']))
   {
       $this->nmgp_cmp_hidden['empresa_google'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['empresa_twitter']))
   {
       $this->nmgp_cmp_hidden['empresa_twitter'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['empresa_skype']))
   {
       $this->nmgp_cmp_hidden['empresa_skype'] = 'off';
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
<input type="hidden" name="empresa_logo_ul_name" id="id_sc_field_empresa_logo_ul_name" value="<?php echo $this->form_encode_input($this->empresa_logo_ul_name);?>">
<input type="hidden" name="empresa_logo_ul_type" id="id_sc_field_empresa_logo_ul_type" value="<?php echo $this->form_encode_input($this->empresa_logo_ul_type);?>">
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['empresa_id']))
           {
               $this->nmgp_cmp_readonly['empresa_id'] = 'on';
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
}
</script>
<ul class="scTabLine">
<li id="id_tabs_0_0" class="scTabActive" style="font-size: 14; background-color: #FFCC99"><a href="javascript: sc_control_tabs_0(0)">EMPRESAS - Informações Básicas</a></li>
<li id="id_tabs_0_1" class="scTabInactive" style="font-size: 14; background-color: #FFCC99"><a href="javascript: sc_control_tabs_0(1)">EMPRESAS - Endereço</a></li>
<li id="id_tabs_0_2" class="scTabInactive" style="font-size: 14; background-color: #FFCC99"><a href="javascript: sc_control_tabs_0(2)">EMPRESAS - Contato</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_id']))
    {
        $this->nm_new_label['empresa_id'] = "Empresa Id";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_id = $this->empresa_id;
   if (!isset($this->nmgp_cmp_hidden['empresa_id']))
   {
       $this->nmgp_cmp_hidden['empresa_id'] = 'off';
   }
   $sStyleHidden_empresa_id = '';
   if (isset($this->nmgp_cmp_hidden['empresa_id']) && $this->nmgp_cmp_hidden['empresa_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_id']);
       $sStyleHidden_empresa_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_id = 'display: none;';
   $sStyleReadInp_empresa_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["empresa_id"]) &&  $this->nmgp_cmp_readonly["empresa_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_id']);
       $sStyleReadLab_empresa_id = '';
       $sStyleReadInp_empresa_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_id']) && $this->nmgp_cmp_hidden['empresa_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_id" value="<?php echo $this->form_encode_input($empresa_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_id_label" id="hidden_field_label_empresa_id" style="<?php echo $sStyleHidden_empresa_id; ?>"><span id="id_label_empresa_id"><?php echo $this->nm_new_label['empresa_id']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_id_line" id="hidden_field_data_empresa_id" style="<?php echo $sStyleHidden_empresa_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_id_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_empresa_id" class="css_empresa_id_line" style="<?php echo $sStyleReadLab_empresa_id; ?>"><?php echo $this->form_format_readonly("empresa_id", $this->form_encode_input($this->empresa_id)); ?></span><span id="id_read_off_empresa_id" class="css_read_off_empresa_id" style="<?php echo $sStyleReadInp_empresa_id; ?>"><input type="hidden" name="empresa_id" value="<?php echo $this->form_encode_input($empresa_id) . "\">"?><span id="id_ajax_label_empresa_id"><?php echo nl2br($empresa_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_id_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['empresa_cnpj']))
    {
        $this->nm_new_label['empresa_cnpj'] = "CNPJ:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_cnpj = $this->empresa_cnpj;
   $sStyleHidden_empresa_cnpj = '';
   if (isset($this->nmgp_cmp_hidden['empresa_cnpj']) && $this->nmgp_cmp_hidden['empresa_cnpj'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_cnpj']);
       $sStyleHidden_empresa_cnpj = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_cnpj = 'display: none;';
   $sStyleReadInp_empresa_cnpj = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_cnpj']) && $this->nmgp_cmp_readonly['empresa_cnpj'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_cnpj']);
       $sStyleReadLab_empresa_cnpj = '';
       $sStyleReadInp_empresa_cnpj = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_cnpj']) && $this->nmgp_cmp_hidden['empresa_cnpj'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_cnpj" value="<?php echo $this->form_encode_input($empresa_cnpj) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_cnpj_label" id="hidden_field_label_empresa_cnpj" style="<?php echo $sStyleHidden_empresa_cnpj; ?>"><span id="id_label_empresa_cnpj"><?php echo $this->nm_new_label['empresa_cnpj']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['php_cmp_required']['empresa_cnpj']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['php_cmp_required']['empresa_cnpj'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_empresa_cnpj_line" id="hidden_field_data_empresa_cnpj" style="<?php echo $sStyleHidden_empresa_cnpj; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_cnpj_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_cnpj"]) &&  $this->nmgp_cmp_readonly["empresa_cnpj"] == "on") { 

 ?>
<input type="hidden" name="empresa_cnpj" value="<?php echo $this->form_encode_input($empresa_cnpj) . "\">" . $empresa_cnpj . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_cnpj" class="sc-ui-readonly-empresa_cnpj css_empresa_cnpj_line" style="<?php echo $sStyleReadLab_empresa_cnpj; ?>"><?php echo $this->form_format_readonly("empresa_cnpj", $this->form_encode_input($this->empresa_cnpj)); ?></span><span id="id_read_off_empresa_cnpj" class="css_read_off_empresa_cnpj<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_cnpj; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_cnpj_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_cnpj" type=text name="empresa_cnpj" value="<?php echo $this->form_encode_input($empresa_cnpj) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=16"; } ?> alt="{datatype: 'cnpj', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_cnpj_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_cnpj_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_fantasia']))
    {
        $this->nm_new_label['empresa_fantasia'] = "Fantasia:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_fantasia = $this->empresa_fantasia;
   $sStyleHidden_empresa_fantasia = '';
   if (isset($this->nmgp_cmp_hidden['empresa_fantasia']) && $this->nmgp_cmp_hidden['empresa_fantasia'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_fantasia']);
       $sStyleHidden_empresa_fantasia = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_fantasia = 'display: none;';
   $sStyleReadInp_empresa_fantasia = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_fantasia']) && $this->nmgp_cmp_readonly['empresa_fantasia'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_fantasia']);
       $sStyleReadLab_empresa_fantasia = '';
       $sStyleReadInp_empresa_fantasia = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_fantasia']) && $this->nmgp_cmp_hidden['empresa_fantasia'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_fantasia" value="<?php echo $this->form_encode_input($empresa_fantasia) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_fantasia_label" id="hidden_field_label_empresa_fantasia" style="<?php echo $sStyleHidden_empresa_fantasia; ?>"><span id="id_label_empresa_fantasia"><?php echo $this->nm_new_label['empresa_fantasia']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['php_cmp_required']['empresa_fantasia']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['php_cmp_required']['empresa_fantasia'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_empresa_fantasia_line" id="hidden_field_data_empresa_fantasia" style="<?php echo $sStyleHidden_empresa_fantasia; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_fantasia_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_fantasia"]) &&  $this->nmgp_cmp_readonly["empresa_fantasia"] == "on") { 

 ?>
<input type="hidden" name="empresa_fantasia" value="<?php echo $this->form_encode_input($empresa_fantasia) . "\">" . $empresa_fantasia . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_fantasia" class="sc-ui-readonly-empresa_fantasia css_empresa_fantasia_line" style="<?php echo $sStyleReadLab_empresa_fantasia; ?>"><?php echo $this->form_format_readonly("empresa_fantasia", $this->form_encode_input($this->empresa_fantasia)); ?></span><span id="id_read_off_empresa_fantasia" class="css_read_off_empresa_fantasia<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_fantasia; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_fantasia_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_fantasia" type=text name="empresa_fantasia" value="<?php echo $this->form_encode_input($empresa_fantasia) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_fantasia_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_fantasia_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_razsoc']))
    {
        $this->nm_new_label['empresa_razsoc'] = "Razão Social:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_razsoc = $this->empresa_razsoc;
   $sStyleHidden_empresa_razsoc = '';
   if (isset($this->nmgp_cmp_hidden['empresa_razsoc']) && $this->nmgp_cmp_hidden['empresa_razsoc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_razsoc']);
       $sStyleHidden_empresa_razsoc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_razsoc = 'display: none;';
   $sStyleReadInp_empresa_razsoc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_razsoc']) && $this->nmgp_cmp_readonly['empresa_razsoc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_razsoc']);
       $sStyleReadLab_empresa_razsoc = '';
       $sStyleReadInp_empresa_razsoc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_razsoc']) && $this->nmgp_cmp_hidden['empresa_razsoc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_razsoc" value="<?php echo $this->form_encode_input($empresa_razsoc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_razsoc_label" id="hidden_field_label_empresa_razsoc" style="<?php echo $sStyleHidden_empresa_razsoc; ?>"><span id="id_label_empresa_razsoc"><?php echo $this->nm_new_label['empresa_razsoc']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_razsoc_line" id="hidden_field_data_empresa_razsoc" style="<?php echo $sStyleHidden_empresa_razsoc; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_razsoc_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_razsoc"]) &&  $this->nmgp_cmp_readonly["empresa_razsoc"] == "on") { 

 ?>
<input type="hidden" name="empresa_razsoc" value="<?php echo $this->form_encode_input($empresa_razsoc) . "\">" . $empresa_razsoc . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_razsoc" class="sc-ui-readonly-empresa_razsoc css_empresa_razsoc_line" style="<?php echo $sStyleReadLab_empresa_razsoc; ?>"><?php echo $this->form_format_readonly("empresa_razsoc", $this->form_encode_input($this->empresa_razsoc)); ?></span><span id="id_read_off_empresa_razsoc" class="css_read_off_empresa_razsoc<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_razsoc; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_razsoc_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_razsoc" type=text name="empresa_razsoc" value="<?php echo $this->form_encode_input($empresa_razsoc) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_razsoc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_razsoc_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_inscestad']))
    {
        $this->nm_new_label['empresa_inscestad'] = "Insc. Estadual:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_inscestad = $this->empresa_inscestad;
   $sStyleHidden_empresa_inscestad = '';
   if (isset($this->nmgp_cmp_hidden['empresa_inscestad']) && $this->nmgp_cmp_hidden['empresa_inscestad'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_inscestad']);
       $sStyleHidden_empresa_inscestad = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_inscestad = 'display: none;';
   $sStyleReadInp_empresa_inscestad = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_inscestad']) && $this->nmgp_cmp_readonly['empresa_inscestad'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_inscestad']);
       $sStyleReadLab_empresa_inscestad = '';
       $sStyleReadInp_empresa_inscestad = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_inscestad']) && $this->nmgp_cmp_hidden['empresa_inscestad'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_inscestad" value="<?php echo $this->form_encode_input($empresa_inscestad) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_inscestad_label" id="hidden_field_label_empresa_inscestad" style="<?php echo $sStyleHidden_empresa_inscestad; ?>"><span id="id_label_empresa_inscestad"><?php echo $this->nm_new_label['empresa_inscestad']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_inscestad_line" id="hidden_field_data_empresa_inscestad" style="<?php echo $sStyleHidden_empresa_inscestad; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_inscestad_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_inscestad"]) &&  $this->nmgp_cmp_readonly["empresa_inscestad"] == "on") { 

 ?>
<input type="hidden" name="empresa_inscestad" value="<?php echo $this->form_encode_input($empresa_inscestad) . "\">" . $empresa_inscestad . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_inscestad" class="sc-ui-readonly-empresa_inscestad css_empresa_inscestad_line" style="<?php echo $sStyleReadLab_empresa_inscestad; ?>"><?php echo $this->form_format_readonly("empresa_inscestad", $this->form_encode_input($this->empresa_inscestad)); ?></span><span id="id_read_off_empresa_inscestad" class="css_read_off_empresa_inscestad<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_inscestad; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_inscestad_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_inscestad" type=text name="empresa_inscestad" value="<?php echo $this->form_encode_input($empresa_inscestad) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=14"; } ?> maxlength=14 alt="{datatype: 'text', maxLength: 14, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_inscestad_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_inscestad_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_facebook']))
    {
        $this->nm_new_label['empresa_facebook'] = " Facebook:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_facebook = $this->empresa_facebook;
   if (!isset($this->nmgp_cmp_hidden['empresa_facebook']))
   {
       $this->nmgp_cmp_hidden['empresa_facebook'] = 'off';
   }
   $sStyleHidden_empresa_facebook = '';
   if (isset($this->nmgp_cmp_hidden['empresa_facebook']) && $this->nmgp_cmp_hidden['empresa_facebook'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_facebook']);
       $sStyleHidden_empresa_facebook = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_facebook = 'display: none;';
   $sStyleReadInp_empresa_facebook = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_facebook']) && $this->nmgp_cmp_readonly['empresa_facebook'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_facebook']);
       $sStyleReadLab_empresa_facebook = '';
       $sStyleReadInp_empresa_facebook = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_facebook']) && $this->nmgp_cmp_hidden['empresa_facebook'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_facebook" value="<?php echo $this->form_encode_input($empresa_facebook) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_facebook_label" id="hidden_field_label_empresa_facebook" style="<?php echo $sStyleHidden_empresa_facebook; ?>"><span id="id_label_empresa_facebook"><?php echo $this->nm_new_label['empresa_facebook']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_facebook_line" id="hidden_field_data_empresa_facebook" style="<?php echo $sStyleHidden_empresa_facebook; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_facebook_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_facebook"]) &&  $this->nmgp_cmp_readonly["empresa_facebook"] == "on") { 

 ?>
<input type="hidden" name="empresa_facebook" value="<?php echo $this->form_encode_input($empresa_facebook) . "\">" . $empresa_facebook . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_facebook" class="sc-ui-readonly-empresa_facebook css_empresa_facebook_line" style="<?php echo $sStyleReadLab_empresa_facebook; ?>"><?php echo $this->form_format_readonly("empresa_facebook", $this->form_encode_input($this->empresa_facebook)); ?></span><span id="id_read_off_empresa_facebook" class="css_read_off_empresa_facebook<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_facebook; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_facebook_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_facebook" type=text name="empresa_facebook" value="<?php echo $this->form_encode_input($empresa_facebook) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_facebook_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_facebook_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_google']))
    {
        $this->nm_new_label['empresa_google'] = "Google:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_google = $this->empresa_google;
   if (!isset($this->nmgp_cmp_hidden['empresa_google']))
   {
       $this->nmgp_cmp_hidden['empresa_google'] = 'off';
   }
   $sStyleHidden_empresa_google = '';
   if (isset($this->nmgp_cmp_hidden['empresa_google']) && $this->nmgp_cmp_hidden['empresa_google'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_google']);
       $sStyleHidden_empresa_google = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_google = 'display: none;';
   $sStyleReadInp_empresa_google = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_google']) && $this->nmgp_cmp_readonly['empresa_google'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_google']);
       $sStyleReadLab_empresa_google = '';
       $sStyleReadInp_empresa_google = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_google']) && $this->nmgp_cmp_hidden['empresa_google'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_google" value="<?php echo $this->form_encode_input($empresa_google) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_google_label" id="hidden_field_label_empresa_google" style="<?php echo $sStyleHidden_empresa_google; ?>"><span id="id_label_empresa_google"><?php echo $this->nm_new_label['empresa_google']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_google_line" id="hidden_field_data_empresa_google" style="<?php echo $sStyleHidden_empresa_google; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_google_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_google"]) &&  $this->nmgp_cmp_readonly["empresa_google"] == "on") { 

 ?>
<input type="hidden" name="empresa_google" value="<?php echo $this->form_encode_input($empresa_google) . "\">" . $empresa_google . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_google" class="sc-ui-readonly-empresa_google css_empresa_google_line" style="<?php echo $sStyleReadLab_empresa_google; ?>"><?php echo $this->form_format_readonly("empresa_google", $this->form_encode_input($this->empresa_google)); ?></span><span id="id_read_off_empresa_google" class="css_read_off_empresa_google<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_google; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_google_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_google" type=text name="empresa_google" value="<?php echo $this->form_encode_input($empresa_google) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_google_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_google_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_twitter']))
    {
        $this->nm_new_label['empresa_twitter'] = "Twitter:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_twitter = $this->empresa_twitter;
   if (!isset($this->nmgp_cmp_hidden['empresa_twitter']))
   {
       $this->nmgp_cmp_hidden['empresa_twitter'] = 'off';
   }
   $sStyleHidden_empresa_twitter = '';
   if (isset($this->nmgp_cmp_hidden['empresa_twitter']) && $this->nmgp_cmp_hidden['empresa_twitter'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_twitter']);
       $sStyleHidden_empresa_twitter = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_twitter = 'display: none;';
   $sStyleReadInp_empresa_twitter = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_twitter']) && $this->nmgp_cmp_readonly['empresa_twitter'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_twitter']);
       $sStyleReadLab_empresa_twitter = '';
       $sStyleReadInp_empresa_twitter = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_twitter']) && $this->nmgp_cmp_hidden['empresa_twitter'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_twitter" value="<?php echo $this->form_encode_input($empresa_twitter) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_twitter_label" id="hidden_field_label_empresa_twitter" style="<?php echo $sStyleHidden_empresa_twitter; ?>"><span id="id_label_empresa_twitter"><?php echo $this->nm_new_label['empresa_twitter']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_twitter_line" id="hidden_field_data_empresa_twitter" style="<?php echo $sStyleHidden_empresa_twitter; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_twitter_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_twitter"]) &&  $this->nmgp_cmp_readonly["empresa_twitter"] == "on") { 

 ?>
<input type="hidden" name="empresa_twitter" value="<?php echo $this->form_encode_input($empresa_twitter) . "\">" . $empresa_twitter . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_twitter" class="sc-ui-readonly-empresa_twitter css_empresa_twitter_line" style="<?php echo $sStyleReadLab_empresa_twitter; ?>"><?php echo $this->form_format_readonly("empresa_twitter", $this->form_encode_input($this->empresa_twitter)); ?></span><span id="id_read_off_empresa_twitter" class="css_read_off_empresa_twitter<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_twitter; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_twitter_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_twitter" type=text name="empresa_twitter" value="<?php echo $this->form_encode_input($empresa_twitter) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_twitter_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_twitter_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_skype']))
    {
        $this->nm_new_label['empresa_skype'] = "Skype:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_skype = $this->empresa_skype;
   if (!isset($this->nmgp_cmp_hidden['empresa_skype']))
   {
       $this->nmgp_cmp_hidden['empresa_skype'] = 'off';
   }
   $sStyleHidden_empresa_skype = '';
   if (isset($this->nmgp_cmp_hidden['empresa_skype']) && $this->nmgp_cmp_hidden['empresa_skype'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_skype']);
       $sStyleHidden_empresa_skype = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_skype = 'display: none;';
   $sStyleReadInp_empresa_skype = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_skype']) && $this->nmgp_cmp_readonly['empresa_skype'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_skype']);
       $sStyleReadLab_empresa_skype = '';
       $sStyleReadInp_empresa_skype = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_skype']) && $this->nmgp_cmp_hidden['empresa_skype'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_skype" value="<?php echo $this->form_encode_input($empresa_skype) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_skype_label" id="hidden_field_label_empresa_skype" style="<?php echo $sStyleHidden_empresa_skype; ?>"><span id="id_label_empresa_skype"><?php echo $this->nm_new_label['empresa_skype']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_skype_line" id="hidden_field_data_empresa_skype" style="<?php echo $sStyleHidden_empresa_skype; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_skype_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_skype"]) &&  $this->nmgp_cmp_readonly["empresa_skype"] == "on") { 

 ?>
<input type="hidden" name="empresa_skype" value="<?php echo $this->form_encode_input($empresa_skype) . "\">" . $empresa_skype . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_skype" class="sc-ui-readonly-empresa_skype css_empresa_skype_line" style="<?php echo $sStyleReadLab_empresa_skype; ?>"><?php echo $this->form_format_readonly("empresa_skype", $this->form_encode_input($this->empresa_skype)); ?></span><span id="id_read_off_empresa_skype" class="css_read_off_empresa_skype<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_skype; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_skype_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_skype" type=text name="empresa_skype" value="<?php echo $this->form_encode_input($empresa_skype) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=40"; } ?> maxlength=40 alt="{datatype: 'text', maxLength: 40, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_skype_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_skype_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_website']))
    {
        $this->nm_new_label['empresa_website'] = "Website";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_website = $this->empresa_website;
   $sStyleHidden_empresa_website = '';
   if (isset($this->nmgp_cmp_hidden['empresa_website']) && $this->nmgp_cmp_hidden['empresa_website'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_website']);
       $sStyleHidden_empresa_website = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_website = 'display: none;';
   $sStyleReadInp_empresa_website = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_website']) && $this->nmgp_cmp_readonly['empresa_website'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_website']);
       $sStyleReadLab_empresa_website = '';
       $sStyleReadInp_empresa_website = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_website']) && $this->nmgp_cmp_hidden['empresa_website'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_website" value="<?php echo $this->form_encode_input($empresa_website) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_website_label" id="hidden_field_label_empresa_website" style="<?php echo $sStyleHidden_empresa_website; ?>"><span id="id_label_empresa_website"><?php echo $this->nm_new_label['empresa_website']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_website_line" id="hidden_field_data_empresa_website" style="<?php echo $sStyleHidden_empresa_website; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_website_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_website"]) &&  $this->nmgp_cmp_readonly["empresa_website"] == "on") { 

 ?>
<input type="hidden" name="empresa_website" value="<?php echo $this->form_encode_input($empresa_website) . "\">" . $empresa_website . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_website" class="sc-ui-readonly-empresa_website css_empresa_website_line" style="<?php echo $sStyleReadLab_empresa_website; ?>"><?php echo $this->form_format_readonly("empresa_website", $this->form_encode_input($this->empresa_website)); ?></span><span id="id_read_off_empresa_website" class="css_read_off_empresa_website<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_website; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_website_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_website" type=text name="empresa_website" value="<?php echo $this->form_encode_input($empresa_website) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "blink", "window.open(nm_link_url(document.F1.empresa_website.value), '')", "window.open(nm_link_url(document.F1.empresa_website.value), '')", "empresa_website_url", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_website_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_website_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_status']))
    {
        $this->nm_new_label['empresa_status'] = "Status:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_status = $this->empresa_status;
   $sStyleHidden_empresa_status = '';
   if (isset($this->nmgp_cmp_hidden['empresa_status']) && $this->nmgp_cmp_hidden['empresa_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_status']);
       $sStyleHidden_empresa_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_status = 'display: none;';
   $sStyleReadInp_empresa_status = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_status']) && $this->nmgp_cmp_readonly['empresa_status'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_status']);
       $sStyleReadLab_empresa_status = '';
       $sStyleReadInp_empresa_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_status']) && $this->nmgp_cmp_hidden['empresa_status'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_status" value="<?php echo $this->form_encode_input($empresa_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_status_label" id="hidden_field_label_empresa_status" style="<?php echo $sStyleHidden_empresa_status; ?>"><span id="id_label_empresa_status"><?php echo $this->nm_new_label['empresa_status']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_status_line" id="hidden_field_data_empresa_status" style="<?php echo $sStyleHidden_empresa_status; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_status_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_status"]) &&  $this->nmgp_cmp_readonly["empresa_status"] == "on") { 

 if ("A" == $this->empresa_status) { $empresa_status_look = "Ativa";} 
 if ("I" == $this->empresa_status) { $empresa_status_look = "Inativa";} 
?>
<input type="hidden" name="empresa_status" value="<?php echo $this->form_encode_input($empresa_status) . "\">" . $empresa_status_look . ""; ?>
<?php } else { ?>

<?php

 if ("A" == $this->empresa_status) { $empresa_status_look = "Ativa";} 
 if ("I" == $this->empresa_status) { $empresa_status_look = "Inativa";} 
?>
<span id="id_read_on_empresa_status"  class="css_empresa_status_line" style="<?php echo $sStyleReadLab_empresa_status; ?>"><?php echo $this->form_format_readonly("empresa_status", $this->form_encode_input($empresa_status_look)); ?></span><span id="id_read_off_empresa_status" class="css_read_off_empresa_status css_empresa_status_line" style="<?php echo $sStyleReadInp_empresa_status; ?>"><div id="idAjaxRadio_empresa_status" style="display: inline-block"  class="css_empresa_status_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_empresa_status_line"><?php $tempOptionId = "id-opt-empresa_status" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-empresa_status sc-ui-radio-empresa_status" type=radio name="empresa_status" value="A"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_status'][] = 'A'; ?>
<?php  if ("A" == $this->empresa_status)  { echo " checked" ;} ?><?php  if (empty($this->empresa_status)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Ativa</label></TD>
</TR>
<TR>
  <TD class="scFormDataFontOdd css_empresa_status_line"><?php $tempOptionId = "id-opt-empresa_status" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-empresa_status sc-ui-radio-empresa_status" type=radio name="empresa_status" value="I"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_status'][] = 'I'; ?>
<?php  if ("I" == $this->empresa_status)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Inativa</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_status_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_logo']))
    {
        $this->nm_new_label['empresa_logo'] = "Logotipo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_logo = $this->empresa_logo;
   $sStyleHidden_empresa_logo = '';
   if (isset($this->nmgp_cmp_hidden['empresa_logo']) && $this->nmgp_cmp_hidden['empresa_logo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_logo']);
       $sStyleHidden_empresa_logo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_logo = 'display: none;';
   $sStyleReadInp_empresa_logo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_logo']) && $this->nmgp_cmp_readonly['empresa_logo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_logo']);
       $sStyleReadLab_empresa_logo = '';
       $sStyleReadInp_empresa_logo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_logo']) && $this->nmgp_cmp_hidden['empresa_logo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_logo" value="<?php echo $this->form_encode_input($empresa_logo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_logo_label" id="hidden_field_label_empresa_logo" style="<?php echo $sStyleHidden_empresa_logo; ?>"><span id="id_label_empresa_logo"><?php echo $this->nm_new_label['empresa_logo']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_logo_line" id="hidden_field_data_empresa_logo" style="<?php echo $sStyleHidden_empresa_logo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_logo_line" style="vertical-align: top;padding: 0px">
 <?php $this->NM_ajax_info['varList'][] = array("var_ajax_img_empresa_logo" => $out1_empresa_logo); ?><script>var var_ajax_img_empresa_logo = '<?php echo $out1_empresa_logo; ?>';</script><input type="hidden" name="temp_out_empresa_logo" value="<?php echo $this->form_encode_input($out_empresa_logo); ?>" /><input type="hidden" name="temp_out1_empresa_logo" value="<?php echo $this->form_encode_input($out1_empresa_logo); ?>" /><?php if (!empty($out_empresa_logo)) {  echo "<a  href=\"javascript:nm_mostra_img(var_ajax_img_empresa_logo, '" . $this->nmgp_return_img['empresa_logo'][0] . "', '" . $this->nmgp_return_img['empresa_logo'][1] . "')\"><img id=\"id_ajax_img_empresa_logo\"  border=\"0\" src=\"$out_empresa_logo\"></a>"; } else {  echo "<img id=\"id_ajax_img_empresa_logo\" border=\"0\" style=\"display: none\">"; } ?><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_logo"]) &&  $this->nmgp_cmp_readonly["empresa_logo"] == "on") { 

 ?>
<img id=\"empresa_logo_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><input type="hidden" name="empresa_logo" value="<?php echo $this->form_encode_input($empresa_logo) . "\">" . $empresa_logo . ""; ?>
<?php } else { ?>
<span id="id_read_off_empresa_logo" class="css_read_off_empresa_logo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_logo; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-empresa_logo" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_empresa_logo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="empresa_logo[]" id="id_sc_field_empresa_logo" onchange="<?php if ($this->nmgp_opcao == "novo") {echo "if (document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]']) { document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]'].checked = true }"; }?>"></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_empresa_logo"<?php if ($this->nmgp_opcao == "novo" || empty($empresa_logo)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="empresa_logo_limpa" value="<?php echo $empresa_logo_limpa . '" '; if ($empresa_logo_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="empresa_logo_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><div id="id_img_loader_empresa_logo" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_empresa_logo" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
<div id="id_sc_dragdrop_empresa_logo" class="scFormDataDragNDrop"  style="<?php echo $sStyleReadInp_empresa_logo ?>"><i class='fas fa-cloud-upload-alt'></i><br/>
<?php echo $this->Ini->Nm_lang['lang_errm_mu_dragimg'] ?></div>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_logo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_logo_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['empresa_cep']))
    {
        $this->nm_new_label['empresa_cep'] = "CEP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_cep = $this->empresa_cep;
   $sStyleHidden_empresa_cep = '';
   if (isset($this->nmgp_cmp_hidden['empresa_cep']) && $this->nmgp_cmp_hidden['empresa_cep'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_cep']);
       $sStyleHidden_empresa_cep = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_cep = 'display: none;';
   $sStyleReadInp_empresa_cep = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_cep']) && $this->nmgp_cmp_readonly['empresa_cep'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_cep']);
       $sStyleReadLab_empresa_cep = '';
       $sStyleReadInp_empresa_cep = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_cep']) && $this->nmgp_cmp_hidden['empresa_cep'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_cep" value="<?php echo $this->form_encode_input($empresa_cep) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_cep_label" id="hidden_field_label_empresa_cep" style="<?php echo $sStyleHidden_empresa_cep; ?>"><span id="id_label_empresa_cep"><?php echo $this->nm_new_label['empresa_cep']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_cep_line" id="hidden_field_data_empresa_cep" style="<?php echo $sStyleHidden_empresa_cep; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_cep_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_cep"]) &&  $this->nmgp_cmp_readonly["empresa_cep"] == "on") { 

 ?>
<input type="hidden" name="empresa_cep" value="<?php echo $this->form_encode_input($empresa_cep) . "\">" . $empresa_cep . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_cep" class="sc-ui-readonly-empresa_cep css_empresa_cep_line" style="<?php echo $sStyleReadLab_empresa_cep; ?>"><?php echo $this->form_format_readonly("empresa_cep", $this->form_encode_input($this->empresa_cep)); ?></span><span id="id_read_off_empresa_cep" class="css_read_off_empresa_cep<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_cep; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_cep_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_cep" type=text name="empresa_cep" value="<?php echo $this->form_encode_input($empresa_cep) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'cep', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "bzipcode", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_empresas_rsvp'). "/form_empresas_rsvp_cep.php?cep=&form_origem=F1;CEP,empresa_cep;UF,empresa_uf;CIDADE,empresa_municipio;BAIRRO,empresa_bairro;RUA,empresa_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_empresas_rsvp'). "/form_empresas_rsvp_cep.php?cep=&form_origem=F1;CEP,empresa_cep;UF,empresa_uf;CIDADE,empresa_municipio;BAIRRO,empresa_bairro;RUA,empresa_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "empresa_cep_cep", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_cep_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_cep_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['empresa_pais']))
   {
       $this->nm_new_label['empresa_pais'] = "Pais:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_pais = $this->empresa_pais;
   $sStyleHidden_empresa_pais = '';
   if (isset($this->nmgp_cmp_hidden['empresa_pais']) && $this->nmgp_cmp_hidden['empresa_pais'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_pais']);
       $sStyleHidden_empresa_pais = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_pais = 'display: none;';
   $sStyleReadInp_empresa_pais = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_pais']) && $this->nmgp_cmp_readonly['empresa_pais'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_pais']);
       $sStyleReadLab_empresa_pais = '';
       $sStyleReadInp_empresa_pais = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_pais']) && $this->nmgp_cmp_hidden['empresa_pais'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="empresa_pais" value="<?php echo $this->form_encode_input($this->empresa_pais) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_pais_label" id="hidden_field_label_empresa_pais" style="<?php echo $sStyleHidden_empresa_pais; ?>"><span id="id_label_empresa_pais"><?php echo $this->nm_new_label['empresa_pais']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_pais_line" id="hidden_field_data_empresa_pais" style="<?php echo $sStyleHidden_empresa_pais; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_pais_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_pais"]) &&  $this->nmgp_cmp_readonly["empresa_pais"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais'] = array(); 
    }

   $old_value_empresa_id = $this->empresa_id;
   $old_value_empresa_cnpj = $this->empresa_cnpj;
   $old_value_empresa_cep = $this->empresa_cep;
   $old_value_empresa_telefone = $this->empresa_telefone;
   $old_value_empresa_fax = $this->empresa_fax;
   $old_value_empresa_celular = $this->empresa_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_empresa_id = $this->empresa_id;
   $unformatted_value_empresa_cnpj = $this->empresa_cnpj;
   $unformatted_value_empresa_cep = $this->empresa_cep;
   $unformatted_value_empresa_telefone = $this->empresa_telefone;
   $unformatted_value_empresa_fax = $this->empresa_fax;
   $unformatted_value_empresa_celular = $this->empresa_celular;

   $nm_comando = "SELECT pais_id, descricao  FROM tbl_paises  ORDER BY descricao";

   $this->empresa_id = $old_value_empresa_id;
   $this->empresa_cnpj = $old_value_empresa_cnpj;
   $this->empresa_cep = $old_value_empresa_cep;
   $this->empresa_telefone = $old_value_empresa_telefone;
   $this->empresa_fax = $old_value_empresa_fax;
   $this->empresa_celular = $old_value_empresa_celular;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais'][] = $rs->fields[0];
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
   $empresa_pais_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->empresa_pais_1))
          {
              foreach ($this->empresa_pais_1 as $tmp_empresa_pais)
              {
                  if (trim($tmp_empresa_pais) === trim($cadaselect[1])) {$empresa_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->empresa_pais) && trim($this->empresa_pais) === trim($cadaselect[1])) {$empresa_pais_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="empresa_pais" value="<?php echo $this->form_encode_input($empresa_pais) . "\">" . $empresa_pais_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_empresa_pais();
   $x = 0 ; 
   $empresa_pais_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->empresa_pais_1))
          {
              foreach ($this->empresa_pais_1 as $tmp_empresa_pais)
              {
                  if (trim($tmp_empresa_pais) === trim($cadaselect[1])) {$empresa_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->empresa_pais)) {
                 if (trim($this->empresa_pais) == trim($cadaselect[1])) { $empresa_pais_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->empresa_pais == $cadaselect[1]) { $empresa_pais_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($empresa_pais_look))
          {
              $empresa_pais_look = $this->empresa_pais;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_empresa_pais\" class=\"css_empresa_pais_line\" style=\"" .  $sStyleReadLab_empresa_pais . "\">" . $this->form_format_readonly("empresa_pais", $this->form_encode_input($empresa_pais_look)) . "</span><span id=\"id_read_off_empresa_pais\" class=\"css_read_off_empresa_pais" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_empresa_pais . "\">";
   echo " <span id=\"idAjaxSelect_empresa_pais\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_empresa_pais_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_empresa_pais\" name=\"empresa_pais\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['Lookup_empresa_pais'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->empresa_pais) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->empresa_pais)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_pais_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_pais_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_uf']))
    {
        $this->nm_new_label['empresa_uf'] = "Uf:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_uf = $this->empresa_uf;
   $sStyleHidden_empresa_uf = '';
   if (isset($this->nmgp_cmp_hidden['empresa_uf']) && $this->nmgp_cmp_hidden['empresa_uf'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_uf']);
       $sStyleHidden_empresa_uf = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_uf = 'display: none;';
   $sStyleReadInp_empresa_uf = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_uf']) && $this->nmgp_cmp_readonly['empresa_uf'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_uf']);
       $sStyleReadLab_empresa_uf = '';
       $sStyleReadInp_empresa_uf = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_uf']) && $this->nmgp_cmp_hidden['empresa_uf'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_uf" value="<?php echo $this->form_encode_input($empresa_uf) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_uf_label" id="hidden_field_label_empresa_uf" style="<?php echo $sStyleHidden_empresa_uf; ?>"><span id="id_label_empresa_uf"><?php echo $this->nm_new_label['empresa_uf']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_uf_line" id="hidden_field_data_empresa_uf" style="<?php echo $sStyleHidden_empresa_uf; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_uf_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_uf"]) &&  $this->nmgp_cmp_readonly["empresa_uf"] == "on") { 

 ?>
<input type="hidden" name="empresa_uf" value="<?php echo $this->form_encode_input($empresa_uf) . "\">" . $empresa_uf . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_uf" class="sc-ui-readonly-empresa_uf css_empresa_uf_line" style="<?php echo $sStyleReadLab_empresa_uf; ?>"><?php echo $this->form_format_readonly("empresa_uf", $this->form_encode_input($this->empresa_uf)); ?></span><span id="id_read_off_empresa_uf" class="css_read_off_empresa_uf<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_uf; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_uf_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_uf" type=text name="empresa_uf" value="<?php echo $this->form_encode_input($empresa_uf) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_uf_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_uf_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_municipio']))
    {
        $this->nm_new_label['empresa_municipio'] = "Município:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_municipio = $this->empresa_municipio;
   $sStyleHidden_empresa_municipio = '';
   if (isset($this->nmgp_cmp_hidden['empresa_municipio']) && $this->nmgp_cmp_hidden['empresa_municipio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_municipio']);
       $sStyleHidden_empresa_municipio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_municipio = 'display: none;';
   $sStyleReadInp_empresa_municipio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_municipio']) && $this->nmgp_cmp_readonly['empresa_municipio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_municipio']);
       $sStyleReadLab_empresa_municipio = '';
       $sStyleReadInp_empresa_municipio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_municipio']) && $this->nmgp_cmp_hidden['empresa_municipio'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_municipio" value="<?php echo $this->form_encode_input($empresa_municipio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_municipio_label" id="hidden_field_label_empresa_municipio" style="<?php echo $sStyleHidden_empresa_municipio; ?>"><span id="id_label_empresa_municipio"><?php echo $this->nm_new_label['empresa_municipio']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_municipio_line" id="hidden_field_data_empresa_municipio" style="<?php echo $sStyleHidden_empresa_municipio; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_municipio_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_municipio"]) &&  $this->nmgp_cmp_readonly["empresa_municipio"] == "on") { 

 ?>
<input type="hidden" name="empresa_municipio" value="<?php echo $this->form_encode_input($empresa_municipio) . "\">" . $empresa_municipio . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_municipio" class="sc-ui-readonly-empresa_municipio css_empresa_municipio_line" style="<?php echo $sStyleReadLab_empresa_municipio; ?>"><?php echo $this->form_format_readonly("empresa_municipio", $this->form_encode_input($this->empresa_municipio)); ?></span><span id="id_read_off_empresa_municipio" class="css_read_off_empresa_municipio<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_municipio; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_municipio_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_municipio" type=text name="empresa_municipio" value="<?php echo $this->form_encode_input($empresa_municipio) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_municipio_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_municipio_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_bairro']))
    {
        $this->nm_new_label['empresa_bairro'] = "Bairro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_bairro = $this->empresa_bairro;
   $sStyleHidden_empresa_bairro = '';
   if (isset($this->nmgp_cmp_hidden['empresa_bairro']) && $this->nmgp_cmp_hidden['empresa_bairro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_bairro']);
       $sStyleHidden_empresa_bairro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_bairro = 'display: none;';
   $sStyleReadInp_empresa_bairro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_bairro']) && $this->nmgp_cmp_readonly['empresa_bairro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_bairro']);
       $sStyleReadLab_empresa_bairro = '';
       $sStyleReadInp_empresa_bairro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_bairro']) && $this->nmgp_cmp_hidden['empresa_bairro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_bairro" value="<?php echo $this->form_encode_input($empresa_bairro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_bairro_label" id="hidden_field_label_empresa_bairro" style="<?php echo $sStyleHidden_empresa_bairro; ?>"><span id="id_label_empresa_bairro"><?php echo $this->nm_new_label['empresa_bairro']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_bairro_line" id="hidden_field_data_empresa_bairro" style="<?php echo $sStyleHidden_empresa_bairro; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_bairro_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_bairro"]) &&  $this->nmgp_cmp_readonly["empresa_bairro"] == "on") { 

 ?>
<input type="hidden" name="empresa_bairro" value="<?php echo $this->form_encode_input($empresa_bairro) . "\">" . $empresa_bairro . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_bairro" class="sc-ui-readonly-empresa_bairro css_empresa_bairro_line" style="<?php echo $sStyleReadLab_empresa_bairro; ?>"><?php echo $this->form_format_readonly("empresa_bairro", $this->form_encode_input($this->empresa_bairro)); ?></span><span id="id_read_off_empresa_bairro" class="css_read_off_empresa_bairro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_bairro; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_bairro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_bairro" type=text name="empresa_bairro" value="<?php echo $this->form_encode_input($empresa_bairro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_bairro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_bairro_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_logradouro']))
    {
        $this->nm_new_label['empresa_logradouro'] = "Logradouro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_logradouro = $this->empresa_logradouro;
   $sStyleHidden_empresa_logradouro = '';
   if (isset($this->nmgp_cmp_hidden['empresa_logradouro']) && $this->nmgp_cmp_hidden['empresa_logradouro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_logradouro']);
       $sStyleHidden_empresa_logradouro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_logradouro = 'display: none;';
   $sStyleReadInp_empresa_logradouro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_logradouro']) && $this->nmgp_cmp_readonly['empresa_logradouro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_logradouro']);
       $sStyleReadLab_empresa_logradouro = '';
       $sStyleReadInp_empresa_logradouro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_logradouro']) && $this->nmgp_cmp_hidden['empresa_logradouro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_logradouro" value="<?php echo $this->form_encode_input($empresa_logradouro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_logradouro_label" id="hidden_field_label_empresa_logradouro" style="<?php echo $sStyleHidden_empresa_logradouro; ?>"><span id="id_label_empresa_logradouro"><?php echo $this->nm_new_label['empresa_logradouro']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_logradouro_line" id="hidden_field_data_empresa_logradouro" style="<?php echo $sStyleHidden_empresa_logradouro; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_logradouro_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_logradouro"]) &&  $this->nmgp_cmp_readonly["empresa_logradouro"] == "on") { 

 ?>
<input type="hidden" name="empresa_logradouro" value="<?php echo $this->form_encode_input($empresa_logradouro) . "\">" . $empresa_logradouro . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_logradouro" class="sc-ui-readonly-empresa_logradouro css_empresa_logradouro_line" style="<?php echo $sStyleReadLab_empresa_logradouro; ?>"><?php echo $this->form_format_readonly("empresa_logradouro", $this->form_encode_input($this->empresa_logradouro)); ?></span><span id="id_read_off_empresa_logradouro" class="css_read_off_empresa_logradouro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_logradouro; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_logradouro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_logradouro" type=text name="empresa_logradouro" value="<?php echo $this->form_encode_input($empresa_logradouro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_logradouro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_logradouro_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_numero']))
    {
        $this->nm_new_label['empresa_numero'] = "Número:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_numero = $this->empresa_numero;
   $sStyleHidden_empresa_numero = '';
   if (isset($this->nmgp_cmp_hidden['empresa_numero']) && $this->nmgp_cmp_hidden['empresa_numero'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_numero']);
       $sStyleHidden_empresa_numero = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_numero = 'display: none;';
   $sStyleReadInp_empresa_numero = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_numero']) && $this->nmgp_cmp_readonly['empresa_numero'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_numero']);
       $sStyleReadLab_empresa_numero = '';
       $sStyleReadInp_empresa_numero = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_numero']) && $this->nmgp_cmp_hidden['empresa_numero'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_numero" value="<?php echo $this->form_encode_input($empresa_numero) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_numero_label" id="hidden_field_label_empresa_numero" style="<?php echo $sStyleHidden_empresa_numero; ?>"><span id="id_label_empresa_numero"><?php echo $this->nm_new_label['empresa_numero']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_numero_line" id="hidden_field_data_empresa_numero" style="<?php echo $sStyleHidden_empresa_numero; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_numero_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_numero"]) &&  $this->nmgp_cmp_readonly["empresa_numero"] == "on") { 

 ?>
<input type="hidden" name="empresa_numero" value="<?php echo $this->form_encode_input($empresa_numero) . "\">" . $empresa_numero . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_numero" class="sc-ui-readonly-empresa_numero css_empresa_numero_line" style="<?php echo $sStyleReadLab_empresa_numero; ?>"><?php echo $this->form_format_readonly("empresa_numero", $this->form_encode_input($this->empresa_numero)); ?></span><span id="id_read_off_empresa_numero" class="css_read_off_empresa_numero<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_numero; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_numero_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_numero" type=text name="empresa_numero" value="<?php echo $this->form_encode_input($empresa_numero) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_numero_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_numero_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_complem']))
    {
        $this->nm_new_label['empresa_complem'] = "Complemento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_complem = $this->empresa_complem;
   $sStyleHidden_empresa_complem = '';
   if (isset($this->nmgp_cmp_hidden['empresa_complem']) && $this->nmgp_cmp_hidden['empresa_complem'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_complem']);
       $sStyleHidden_empresa_complem = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_complem = 'display: none;';
   $sStyleReadInp_empresa_complem = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_complem']) && $this->nmgp_cmp_readonly['empresa_complem'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_complem']);
       $sStyleReadLab_empresa_complem = '';
       $sStyleReadInp_empresa_complem = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_complem']) && $this->nmgp_cmp_hidden['empresa_complem'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_complem" value="<?php echo $this->form_encode_input($empresa_complem) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_complem_label" id="hidden_field_label_empresa_complem" style="<?php echo $sStyleHidden_empresa_complem; ?>"><span id="id_label_empresa_complem"><?php echo $this->nm_new_label['empresa_complem']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_complem_line" id="hidden_field_data_empresa_complem" style="<?php echo $sStyleHidden_empresa_complem; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_complem_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_complem"]) &&  $this->nmgp_cmp_readonly["empresa_complem"] == "on") { 

 ?>
<input type="hidden" name="empresa_complem" value="<?php echo $this->form_encode_input($empresa_complem) . "\">" . $empresa_complem . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_complem" class="sc-ui-readonly-empresa_complem css_empresa_complem_line" style="<?php echo $sStyleReadLab_empresa_complem; ?>"><?php echo $this->form_format_readonly("empresa_complem", $this->form_encode_input($this->empresa_complem)); ?></span><span id="id_read_off_empresa_complem" class="css_read_off_empresa_complem<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_complem; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_complem_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_complem" type=text name="empresa_complem" value="<?php echo $this->form_encode_input($empresa_complem) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_complem_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_complem_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_localizacao_label" id="hidden_field_label_localizacao" style="<?php echo $sStyleHidden_localizacao; ?>"><span id="id_label_localizacao"><?php echo $this->nm_new_label['localizacao']; ?></span></TD>
    <TD class="scFormDataOdd css_localizacao_line" id="hidden_field_data_localizacao" style="<?php echo $sStyleHidden_localizacao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_localizacao_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="localizacao" value="<?php echo $this->form_encode_input($localizacao); ?>"><span id="id_ajax_label_localizacao"><?php echo nl2br($localizacao); ?></span>
&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "blink", "window.open(nm_link_url(document.F1.localizacao.value), '')", "window.open(nm_link_url(document.F1.localizacao.value), '')", "localizacao_url", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_localizacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_localizacao_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['empresa_email']))
    {
        $this->nm_new_label['empresa_email'] = "E-Mail:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_email = $this->empresa_email;
   $sStyleHidden_empresa_email = '';
   if (isset($this->nmgp_cmp_hidden['empresa_email']) && $this->nmgp_cmp_hidden['empresa_email'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_email']);
       $sStyleHidden_empresa_email = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_email = 'display: none;';
   $sStyleReadInp_empresa_email = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_email']) && $this->nmgp_cmp_readonly['empresa_email'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_email']);
       $sStyleReadLab_empresa_email = '';
       $sStyleReadInp_empresa_email = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_email']) && $this->nmgp_cmp_hidden['empresa_email'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_email" value="<?php echo $this->form_encode_input($empresa_email) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_email_label" id="hidden_field_label_empresa_email" style="<?php echo $sStyleHidden_empresa_email; ?>"><span id="id_label_empresa_email"><?php echo $this->nm_new_label['empresa_email']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_email_line" id="hidden_field_data_empresa_email" style="<?php echo $sStyleHidden_empresa_email; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_email_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_email"]) &&  $this->nmgp_cmp_readonly["empresa_email"] == "on") { 

 ?>
<input type="hidden" name="empresa_email" value="<?php echo $this->form_encode_input($empresa_email) . "\">" . $empresa_email . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_email" class="sc-ui-readonly-empresa_email css_empresa_email_line" style="<?php echo $sStyleReadLab_empresa_email; ?>"><?php echo $this->form_format_readonly("empresa_email", $this->form_encode_input($this->empresa_email)); ?></span><span id="id_read_off_empresa_email" class="css_read_off_empresa_email<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_email; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_email_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_email" type=text name="empresa_email" value="<?php echo $this->form_encode_input($empresa_email) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.empresa_email.value != '') {window.open('mailto:' + document.F1.empresa_email.value); }", "if (document.F1.empresa_email.value != '') {window.open('mailto:' + document.F1.empresa_email.value); }", "empresa_email_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_email_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_email_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_telefone']))
    {
        $this->nm_new_label['empresa_telefone'] = "Telefone:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_telefone = $this->empresa_telefone;
   $sStyleHidden_empresa_telefone = '';
   if (isset($this->nmgp_cmp_hidden['empresa_telefone']) && $this->nmgp_cmp_hidden['empresa_telefone'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_telefone']);
       $sStyleHidden_empresa_telefone = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_telefone = 'display: none;';
   $sStyleReadInp_empresa_telefone = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_telefone']) && $this->nmgp_cmp_readonly['empresa_telefone'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_telefone']);
       $sStyleReadLab_empresa_telefone = '';
       $sStyleReadInp_empresa_telefone = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_telefone']) && $this->nmgp_cmp_hidden['empresa_telefone'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_telefone" value="<?php echo $this->form_encode_input($empresa_telefone) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_telefone_label" id="hidden_field_label_empresa_telefone" style="<?php echo $sStyleHidden_empresa_telefone; ?>"><span id="id_label_empresa_telefone"><?php echo $this->nm_new_label['empresa_telefone']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_telefone_line" id="hidden_field_data_empresa_telefone" style="<?php echo $sStyleHidden_empresa_telefone; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_telefone_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_telefone"]) &&  $this->nmgp_cmp_readonly["empresa_telefone"] == "on") { 

 ?>
<input type="hidden" name="empresa_telefone" value="<?php echo $this->form_encode_input($empresa_telefone) . "\">" . $empresa_telefone . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_telefone" class="sc-ui-readonly-empresa_telefone css_empresa_telefone_line" style="<?php echo $sStyleReadLab_empresa_telefone; ?>"><?php echo $this->form_format_readonly("empresa_telefone", $this->form_encode_input($this->empresa_telefone)); ?></span><span id="id_read_off_empresa_telefone" class="css_read_off_empresa_telefone<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_telefone; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_telefone_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_telefone" type=text name="empresa_telefone" value="<?php echo $this->form_encode_input($empresa_telefone) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=39 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 9999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_telefone_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_telefone_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_fax']))
    {
        $this->nm_new_label['empresa_fax'] = "Fax:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_fax = $this->empresa_fax;
   $sStyleHidden_empresa_fax = '';
   if (isset($this->nmgp_cmp_hidden['empresa_fax']) && $this->nmgp_cmp_hidden['empresa_fax'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_fax']);
       $sStyleHidden_empresa_fax = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_fax = 'display: none;';
   $sStyleReadInp_empresa_fax = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_fax']) && $this->nmgp_cmp_readonly['empresa_fax'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_fax']);
       $sStyleReadLab_empresa_fax = '';
       $sStyleReadInp_empresa_fax = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_fax']) && $this->nmgp_cmp_hidden['empresa_fax'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_fax" value="<?php echo $this->form_encode_input($empresa_fax) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_fax_label" id="hidden_field_label_empresa_fax" style="<?php echo $sStyleHidden_empresa_fax; ?>"><span id="id_label_empresa_fax"><?php echo $this->nm_new_label['empresa_fax']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_fax_line" id="hidden_field_data_empresa_fax" style="<?php echo $sStyleHidden_empresa_fax; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_fax_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_fax"]) &&  $this->nmgp_cmp_readonly["empresa_fax"] == "on") { 

 ?>
<input type="hidden" name="empresa_fax" value="<?php echo $this->form_encode_input($empresa_fax) . "\">" . $empresa_fax . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_fax" class="sc-ui-readonly-empresa_fax css_empresa_fax_line" style="<?php echo $sStyleReadLab_empresa_fax; ?>"><?php echo $this->form_format_readonly("empresa_fax", $this->form_encode_input($this->empresa_fax)); ?></span><span id="id_read_off_empresa_fax" class="css_read_off_empresa_fax<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_fax; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_fax_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_fax" type=text name="empresa_fax" value="<?php echo $this->form_encode_input($empresa_fax) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=39 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 9999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_fax_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_fax_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['empresa_celular']))
    {
        $this->nm_new_label['empresa_celular'] = "Celular:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $empresa_celular = $this->empresa_celular;
   $sStyleHidden_empresa_celular = '';
   if (isset($this->nmgp_cmp_hidden['empresa_celular']) && $this->nmgp_cmp_hidden['empresa_celular'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['empresa_celular']);
       $sStyleHidden_empresa_celular = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_empresa_celular = 'display: none;';
   $sStyleReadInp_empresa_celular = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['empresa_celular']) && $this->nmgp_cmp_readonly['empresa_celular'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['empresa_celular']);
       $sStyleReadLab_empresa_celular = '';
       $sStyleReadInp_empresa_celular = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['empresa_celular']) && $this->nmgp_cmp_hidden['empresa_celular'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="empresa_celular" value="<?php echo $this->form_encode_input($empresa_celular) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_empresa_celular_label" id="hidden_field_label_empresa_celular" style="<?php echo $sStyleHidden_empresa_celular; ?>"><span id="id_label_empresa_celular"><?php echo $this->nm_new_label['empresa_celular']; ?></span></TD>
    <TD class="scFormDataOdd css_empresa_celular_line" id="hidden_field_data_empresa_celular" style="<?php echo $sStyleHidden_empresa_celular; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_empresa_celular_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["empresa_celular"]) &&  $this->nmgp_cmp_readonly["empresa_celular"] == "on") { 

 ?>
<input type="hidden" name="empresa_celular" value="<?php echo $this->form_encode_input($empresa_celular) . "\">" . $empresa_celular . ""; ?>
<?php } else { ?>
<span id="id_read_on_empresa_celular" class="sc-ui-readonly-empresa_celular css_empresa_celular_line" style="<?php echo $sStyleReadLab_empresa_celular; ?>"><?php echo $this->form_format_readonly("empresa_celular", $this->form_encode_input($this->empresa_celular)); ?></span><span id="id_read_off_empresa_celular" class="css_read_off_empresa_celular<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_empresa_celular; ?>">
 <input class="sc-js-input scFormObjectOdd css_empresa_celular_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_empresa_celular" type=text name="empresa_celular" value="<?php echo $this->form_encode_input($empresa_celular) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=40 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 99999-9999', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_empresa_celular_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_empresa_celular_text"></span></td></tr></table></td></tr></table></TD>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['birpara'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['first'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['back'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['forward'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
  $nm_sc_blocos_da_pag = array(0,1,2);
  $nm_sc_blocos_aba    = array(0 => 0,1 => 0,2 => 0);
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_empresas_rsvp");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_empresas_rsvp");
 parent.scAjaxDetailHeight("form_empresas_rsvp", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_empresas_rsvp", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_empresas_rsvp", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['sc_modal'])
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_empresas_rsvp']['inside_nested_iframe']) {
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
