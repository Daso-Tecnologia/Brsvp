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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("BRSVP - Cadastro de Hotéis Inclusão"); } else { echo strip_tags("BRSVP - Cadastro de Hotéis Edição"); } ?></TITLE>
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

if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['margin_top']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['margin_top']) {
?>
<style>
.scFormBorder {
    padding-top: 0 !important;
}
.scBlockRowFirst .scFormTable {
    margin-top: <?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['margin_top'] ?>;
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_tbl_hoteis/form_tbl_hoteis_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_tbl_hoteis_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['last'] : 'off'); ?>";
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

include_once('form_tbl_hoteis_jquery.php');

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['recarga'];
}
    $width_100 = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['width_100'] ? 'width: 100%; ' : '';
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    $remove_background = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['remove_background'] ? 'background-color: transparent; background-image: none; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['width_100']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['width_100']) {
        $width_100 = 'width: 100%; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['remove_background']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['remove_background']) {
        $remove_background = 'background-color: transparent; background-image: none; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['link_info']['remove_border']) {
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
 include_once("form_tbl_hoteis_js0.php");
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['form_tbl_hoteis'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_tbl_hoteis'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
  if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sub_cons_iframe_align'])) {
      $this->Tab_align = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sub_cons_iframe_align'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R")
{
      if ($this->nmgp_botoes['qsearch'] == "on" && $opcao_botoes != "novo")
      {
          $OPC_cmp = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search'][0] : "";
          $OPC_arg = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search'][1] : "";
          $OPC_dat = (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search'])) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['fast_search'][2] : "";
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
          $SC_Label_atu['hotel_id'] = (isset($this->nm_new_label['hotel_id'])) ? $this->nm_new_label['hotel_id'] : 'Hotel Id:'; 
          $SC_Label_atu['hotel_cnpj'] = (isset($this->nm_new_label['hotel_cnpj'])) ? $this->nm_new_label['hotel_cnpj'] : 'CNPJ:'; 
          $SC_Label_atu['hotel_fantasia'] = (isset($this->nm_new_label['hotel_fantasia'])) ? $this->nm_new_label['hotel_fantasia'] : 'Fantasia'; 
          $SC_Label_atu['hotel_razsoc'] = (isset($this->nm_new_label['hotel_razsoc'])) ? $this->nm_new_label['hotel_razsoc'] : 'Razão Social:'; 
          $SC_Label_atu['hotel_descricao'] = (isset($this->nm_new_label['hotel_descricao'])) ? $this->nm_new_label['hotel_descricao'] : 'Descrição:'; 
          $SC_Label_atu['hotel_rede'] = (isset($this->nm_new_label['hotel_rede'])) ? $this->nm_new_label['hotel_rede'] : 'Rede:'; 
          $SC_Label_atu['hotel_classificacao'] = (isset($this->nm_new_label['hotel_classificacao'])) ? $this->nm_new_label['hotel_classificacao'] : 'Classificação (tipo):'; 
          $SC_Label_atu['hotel_categoria'] = (isset($this->nm_new_label['hotel_categoria'])) ? $this->nm_new_label['hotel_categoria'] : 'Categoria:'; 
          $SC_Label_atu['hotel_logo'] = (isset($this->nm_new_label['hotel_logo'])) ? $this->nm_new_label['hotel_logo'] : 'Logo:'; 
          $SC_Label_atu['hotel_cep'] = (isset($this->nm_new_label['hotel_cep'])) ? $this->nm_new_label['hotel_cep'] : 'CEP:'; 
          $SC_Label_atu['hotel_pais'] = (isset($this->nm_new_label['hotel_pais'])) ? $this->nm_new_label['hotel_pais'] : 'País:'; 
          $SC_Label_atu['hotel_uf'] = (isset($this->nm_new_label['hotel_uf'])) ? $this->nm_new_label['hotel_uf'] : 'UF:'; 
          $SC_Label_atu['hotel_municipio'] = (isset($this->nm_new_label['hotel_municipio'])) ? $this->nm_new_label['hotel_municipio'] : 'Município:'; 
          $SC_Label_atu['hotel_bairro'] = (isset($this->nm_new_label['hotel_bairro'])) ? $this->nm_new_label['hotel_bairro'] : 'Bairro:'; 
          $SC_Label_atu['hotel_logradouro'] = (isset($this->nm_new_label['hotel_logradouro'])) ? $this->nm_new_label['hotel_logradouro'] : 'Logradouro:'; 
          $SC_Label_atu['hotel_numero'] = (isset($this->nm_new_label['hotel_numero'])) ? $this->nm_new_label['hotel_numero'] : 'Número:'; 
          $SC_Label_atu['hotel_complemento'] = (isset($this->nm_new_label['hotel_complemento'])) ? $this->nm_new_label['hotel_complemento'] : 'Complemento:'; 
          $SC_Label_atu['hotel_observacoes'] = (isset($this->nm_new_label['hotel_observacoes'])) ? $this->nm_new_label['hotel_observacoes'] : 'Observações:'; 
          $SC_Label_atu['hotel_email'] = (isset($this->nm_new_label['hotel_email'])) ? $this->nm_new_label['hotel_email'] : 'Email:'; 
          $SC_Label_atu['hotel_website'] = (isset($this->nm_new_label['hotel_website'])) ? $this->nm_new_label['hotel_website'] : 'Website:'; 
          $SC_Label_atu['hotel_telefone'] = (isset($this->nm_new_label['hotel_telefone'])) ? $this->nm_new_label['hotel_telefone'] : 'Telefone'; 
          $SC_Label_atu['hotel_fax'] = (isset($this->nm_new_label['hotel_fax'])) ? $this->nm_new_label['hotel_fax'] : 'Fax:'; 
          $SC_Label_atu['hotel_celular'] = (isset($this->nm_new_label['hotel_celular'])) ? $this->nm_new_label['hotel_celular'] : 'Celular:'; 
          $SC_Label_atu['hotel_status'] = (isset($this->nm_new_label['hotel_status'])) ? $this->nm_new_label['hotel_status'] : 'Status:'; 
          $SC_Label_atu['hotel_facebook'] = (isset($this->nm_new_label['hotel_facebook'])) ? $this->nm_new_label['hotel_facebook'] : 'Hotel Facebook:'; 
          $SC_Label_atu['hotel_twitter'] = (isset($this->nm_new_label['hotel_twitter'])) ? $this->nm_new_label['hotel_twitter'] : 'Hotel Twitter:'; 
          $SC_Label_atu['hotel_skype'] = (isset($this->nm_new_label['hotel_skype'])) ? $this->nm_new_label['hotel_skype'] : 'Hotel Skype:'; 
          $SC_Label_atu['hotel_ar_condicionado'] = (isset($this->nm_new_label['hotel_ar_condicionado'])) ? $this->nm_new_label['hotel_ar_condicionado'] : 'Ar Condicionado:'; 
          $SC_Label_atu['hotel_frigobar'] = (isset($this->nm_new_label['hotel_frigobar'])) ? $this->nm_new_label['hotel_frigobar'] : 'Frigobar:'; 
          $SC_Label_atu['hotel_lavanderia'] = (isset($this->nm_new_label['hotel_lavanderia'])) ? $this->nm_new_label['hotel_lavanderia'] : 'Lavanderia:'; 
          $SC_Label_atu['hotel_telefone_quarto'] = (isset($this->nm_new_label['hotel_telefone_quarto'])) ? $this->nm_new_label['hotel_telefone_quarto'] : 'Telefone Quarto:'; 
          $SC_Label_atu['hotel_tv'] = (isset($this->nm_new_label['hotel_tv'])) ? $this->nm_new_label['hotel_tv'] : 'TV:'; 
          $SC_Label_atu['hotel_ginastica'] = (isset($this->nm_new_label['hotel_ginastica'])) ? $this->nm_new_label['hotel_ginastica'] : 'Sala Ginática:'; 
          $SC_Label_atu['hotel_restaurante'] = (isset($this->nm_new_label['hotel_restaurante'])) ? $this->nm_new_label['hotel_restaurante'] : 'Restaurante:'; 
          $SC_Label_atu['hotel_bar'] = (isset($this->nm_new_label['hotel_bar'])) ? $this->nm_new_label['hotel_bar'] : 'Bar:'; 
          $SC_Label_atu['hotel_estacionamento'] = (isset($this->nm_new_label['hotel_estacionamento'])) ? $this->nm_new_label['hotel_estacionamento'] : 'Estacionamento:'; 
          $SC_Label_atu['hotel_sauna'] = (isset($this->nm_new_label['hotel_sauna'])) ? $this->nm_new_label['hotel_sauna'] : 'Sauna:'; 
          $SC_Label_atu['hotel_piscina'] = (isset($this->nm_new_label['hotel_piscina'])) ? $this->nm_new_label['hotel_piscina'] : 'Piscina:'; 
          $SC_Label_atu['hotel_wifi'] = (isset($this->nm_new_label['hotel_wifi'])) ? $this->nm_new_label['hotel_wifi'] : 'Wifi:'; 
          $SC_Label_atu['hotel_computador'] = (isset($this->nm_new_label['hotel_computador'])) ? $this->nm_new_label['hotel_computador'] : 'Computadores:'; 
          $SC_Label_atu['hotel_convencoes'] = (isset($this->nm_new_label['hotel_convencoes'])) ? $this->nm_new_label['hotel_convencoes'] : 'Sala Convenções:'; 
          $SC_Label_atu['hotel_cod_estrangeiro'] = (isset($this->nm_new_label['hotel_cod_estrangeiro'])) ? $this->nm_new_label['hotel_cod_estrangeiro'] : 'Cód. Estrangeiro:'; 
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['new']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['new']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['new']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['new']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['new'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['insert']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['insert']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['insert']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['insert']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['insert'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['bcancelar']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['bcancelar']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['bcancelar']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['bcancelar']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['bcancelar'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['update'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['delete']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['delete']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['delete']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['delete']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['delete'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && ($nm_apl_dependente != 1 || $this->nm_Start_new) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = (($this->nm_flag_saida_novo == "S" || ($this->nm_Start_new && !$this->aba_iframe)) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-6';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes == "novo") && (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "R") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']))) {
        $sCondStyle = ($this->nm_flag_saida_novo == "S" && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-7';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-8';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-9';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
    if (($opcao_botoes != "novo") && (!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-10';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_t", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "", '', '', '', '', '', '', '', '', "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R")
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
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
<?php
   if (!isset($this->nmgp_cmp_hidden['hotel_id']))
   {
       $this->nmgp_cmp_hidden['hotel_id'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['hotel_facebook']))
   {
       $this->nmgp_cmp_hidden['hotel_facebook'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['hotel_twitter']))
   {
       $this->nmgp_cmp_hidden['hotel_twitter'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['hotel_skype']))
   {
       $this->nmgp_cmp_hidden['hotel_skype'] = 'off';
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
<input type="hidden" name="hotel_logo_ul_name" id="id_sc_field_hotel_logo_ul_name" value="<?php echo $this->form_encode_input($this->hotel_logo_ul_name);?>">
<input type="hidden" name="hotel_logo_ul_type" id="id_sc_field_hotel_logo_ul_type" value="<?php echo $this->form_encode_input($this->hotel_logo_ul_type);?>">
<?php
           if ('novo' != $this->nmgp_opcao && !isset($this->nmgp_cmp_readonly['hotel_id']))
           {
               $this->nmgp_cmp_readonly['hotel_id'] = 'on';
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
<li id="id_tabs_0_0" class="scTabActive" style="font-size: 14; background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(0)">HOTÉIS - Informações Básicas</a></li>
<li id="id_tabs_0_1" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(1)">HOTÉIS - Endereço</a></li>
<li id="id_tabs_0_2" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(2)">HOTÉIS - Contato</a></li>
<li id="id_tabs_0_3" class="scTabInactive" style="background-color: #CCFFFF"><a href="javascript: sc_control_tabs_0(3)">HOTÉIS - Comodidades</a></li>
<li id="id_tabs_0_4" class="scTabInactive" style="background-color: #CCFFFF; color: #3300FF"><a href="javascript: sc_control_tabs_0(4)">Vínculo ERP</a></li>
</ul>
<div style='clear:both'></div>
<div id="div_hidden_bloco_0" class="scBlockFrame"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" cellpadding="0" cellspacing="0" border="0" width="100%" style="height: 100%">
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_id']))
    {
        $this->nm_new_label['hotel_id'] = "Hotel Id:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_id = $this->hotel_id;
   if (!isset($this->nmgp_cmp_hidden['hotel_id']))
   {
       $this->nmgp_cmp_hidden['hotel_id'] = 'off';
   }
   $sStyleHidden_hotel_id = '';
   if (isset($this->nmgp_cmp_hidden['hotel_id']) && $this->nmgp_cmp_hidden['hotel_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_id']);
       $sStyleHidden_hotel_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_id = 'display: none;';
   $sStyleReadInp_hotel_id = '';
   if (/*($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir") || */(isset($this->nmgp_cmp_readonly["hotel_id"]) &&  $this->nmgp_cmp_readonly["hotel_id"] == "on"))
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_id']);
       $sStyleReadLab_hotel_id = '';
       $sStyleReadInp_hotel_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_id']) && $this->nmgp_cmp_hidden['hotel_id'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_id" value="<?php echo $this->form_encode_input($hotel_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>
<?php if ((isset($this->Embutida_form) && $this->Embutida_form) || ($this->nmgp_opcao != "novo" && $this->nmgp_opc_ant != "incluir")) { ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_id_label" id="hidden_field_label_hotel_id" style="<?php echo $sStyleHidden_hotel_id; ?>"><span id="id_label_hotel_id"><?php echo $this->nm_new_label['hotel_id']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_id_line" id="hidden_field_data_hotel_id" style="<?php echo $sStyleHidden_hotel_id; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_id_line" style="vertical-align: top;padding: 0px"><span id="id_read_on_hotel_id" class="css_hotel_id_line" style="<?php echo $sStyleReadLab_hotel_id; ?>"><?php echo $this->form_format_readonly("hotel_id", $this->form_encode_input($this->hotel_id)); ?></span><span id="id_read_off_hotel_id" class="css_read_off_hotel_id" style="<?php echo $sStyleReadInp_hotel_id; ?>"><input type="hidden" name="hotel_id" value="<?php echo $this->form_encode_input($hotel_id) . "\">"?><span id="id_ajax_label_hotel_id"><?php echo nl2br($hotel_id); ?></span>
</span></span></td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_id_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['hotel_cnpj']))
    {
        $this->nm_new_label['hotel_cnpj'] = "CNPJ:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_cnpj = $this->hotel_cnpj;
   $sStyleHidden_hotel_cnpj = '';
   if (isset($this->nmgp_cmp_hidden['hotel_cnpj']) && $this->nmgp_cmp_hidden['hotel_cnpj'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_cnpj']);
       $sStyleHidden_hotel_cnpj = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_cnpj = 'display: none;';
   $sStyleReadInp_hotel_cnpj = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_cnpj']) && $this->nmgp_cmp_readonly['hotel_cnpj'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_cnpj']);
       $sStyleReadLab_hotel_cnpj = '';
       $sStyleReadInp_hotel_cnpj = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_cnpj']) && $this->nmgp_cmp_hidden['hotel_cnpj'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_cnpj" value="<?php echo $this->form_encode_input($hotel_cnpj) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_cnpj_label" id="hidden_field_label_hotel_cnpj" style="<?php echo $sStyleHidden_hotel_cnpj; ?>"><span id="id_label_hotel_cnpj"><?php echo $this->nm_new_label['hotel_cnpj']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_cnpj_line" id="hidden_field_data_hotel_cnpj" style="<?php echo $sStyleHidden_hotel_cnpj; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_cnpj_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_cnpj"]) &&  $this->nmgp_cmp_readonly["hotel_cnpj"] == "on") { 

 ?>
<input type="hidden" name="hotel_cnpj" value="<?php echo $this->form_encode_input($hotel_cnpj) . "\">" . $hotel_cnpj . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_cnpj" class="sc-ui-readonly-hotel_cnpj css_hotel_cnpj_line" style="<?php echo $sStyleReadLab_hotel_cnpj; ?>"><?php echo $this->form_format_readonly("hotel_cnpj", $this->form_encode_input($this->hotel_cnpj)); ?></span><span id="id_read_off_hotel_cnpj" class="css_read_off_hotel_cnpj<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_cnpj; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_cnpj_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_cnpj" type=text name="hotel_cnpj" value="<?php echo $this->form_encode_input($hotel_cnpj) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=16"; } ?> maxlength=14 alt="{datatype: 'text', maxLength: 14, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_cnpj_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_cnpj_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_fantasia']))
    {
        $this->nm_new_label['hotel_fantasia'] = "Fantasia";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_fantasia = $this->hotel_fantasia;
   $sStyleHidden_hotel_fantasia = '';
   if (isset($this->nmgp_cmp_hidden['hotel_fantasia']) && $this->nmgp_cmp_hidden['hotel_fantasia'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_fantasia']);
       $sStyleHidden_hotel_fantasia = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_fantasia = 'display: none;';
   $sStyleReadInp_hotel_fantasia = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_fantasia']) && $this->nmgp_cmp_readonly['hotel_fantasia'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_fantasia']);
       $sStyleReadLab_hotel_fantasia = '';
       $sStyleReadInp_hotel_fantasia = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_fantasia']) && $this->nmgp_cmp_hidden['hotel_fantasia'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_fantasia" value="<?php echo $this->form_encode_input($hotel_fantasia) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_fantasia_label" id="hidden_field_label_hotel_fantasia" style="<?php echo $sStyleHidden_hotel_fantasia; ?>"><span id="id_label_hotel_fantasia"><?php echo $this->nm_new_label['hotel_fantasia']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_fantasia_line" id="hidden_field_data_hotel_fantasia" style="<?php echo $sStyleHidden_hotel_fantasia; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_fantasia_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_fantasia"]) &&  $this->nmgp_cmp_readonly["hotel_fantasia"] == "on") { 

 ?>
<input type="hidden" name="hotel_fantasia" value="<?php echo $this->form_encode_input($hotel_fantasia) . "\">" . $hotel_fantasia . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_fantasia" class="sc-ui-readonly-hotel_fantasia css_hotel_fantasia_line" style="<?php echo $sStyleReadLab_hotel_fantasia; ?>"><?php echo $this->form_format_readonly("hotel_fantasia", $this->form_encode_input($this->hotel_fantasia)); ?></span><span id="id_read_off_hotel_fantasia" class="css_read_off_hotel_fantasia<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_fantasia; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_fantasia_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_fantasia" type=text name="hotel_fantasia" value="<?php echo $this->form_encode_input($hotel_fantasia) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_fantasia_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_fantasia_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_razsoc']))
    {
        $this->nm_new_label['hotel_razsoc'] = "Razão Social:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_razsoc = $this->hotel_razsoc;
   $sStyleHidden_hotel_razsoc = '';
   if (isset($this->nmgp_cmp_hidden['hotel_razsoc']) && $this->nmgp_cmp_hidden['hotel_razsoc'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_razsoc']);
       $sStyleHidden_hotel_razsoc = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_razsoc = 'display: none;';
   $sStyleReadInp_hotel_razsoc = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_razsoc']) && $this->nmgp_cmp_readonly['hotel_razsoc'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_razsoc']);
       $sStyleReadLab_hotel_razsoc = '';
       $sStyleReadInp_hotel_razsoc = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_razsoc']) && $this->nmgp_cmp_hidden['hotel_razsoc'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_razsoc" value="<?php echo $this->form_encode_input($hotel_razsoc) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_razsoc_label" id="hidden_field_label_hotel_razsoc" style="<?php echo $sStyleHidden_hotel_razsoc; ?>"><span id="id_label_hotel_razsoc"><?php echo $this->nm_new_label['hotel_razsoc']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_razsoc']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_razsoc'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_hotel_razsoc_line" id="hidden_field_data_hotel_razsoc" style="<?php echo $sStyleHidden_hotel_razsoc; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_razsoc_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_razsoc"]) &&  $this->nmgp_cmp_readonly["hotel_razsoc"] == "on") { 

 ?>
<input type="hidden" name="hotel_razsoc" value="<?php echo $this->form_encode_input($hotel_razsoc) . "\">" . $hotel_razsoc . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_razsoc" class="sc-ui-readonly-hotel_razsoc css_hotel_razsoc_line" style="<?php echo $sStyleReadLab_hotel_razsoc; ?>"><?php echo $this->form_format_readonly("hotel_razsoc", $this->form_encode_input($this->hotel_razsoc)); ?></span><span id="id_read_off_hotel_razsoc" class="css_read_off_hotel_razsoc<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_razsoc; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_razsoc_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_razsoc" type=text name="hotel_razsoc" value="<?php echo $this->form_encode_input($hotel_razsoc) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_razsoc_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_razsoc_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_descricao']))
    {
        $this->nm_new_label['hotel_descricao'] = "Descrição:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_descricao = $this->hotel_descricao;
   $sStyleHidden_hotel_descricao = '';
   if (isset($this->nmgp_cmp_hidden['hotel_descricao']) && $this->nmgp_cmp_hidden['hotel_descricao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_descricao']);
       $sStyleHidden_hotel_descricao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_descricao = 'display: none;';
   $sStyleReadInp_hotel_descricao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_descricao']) && $this->nmgp_cmp_readonly['hotel_descricao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_descricao']);
       $sStyleReadLab_hotel_descricao = '';
       $sStyleReadInp_hotel_descricao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_descricao']) && $this->nmgp_cmp_hidden['hotel_descricao'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_descricao" value="<?php echo $this->form_encode_input($hotel_descricao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_descricao_label" id="hidden_field_label_hotel_descricao" style="<?php echo $sStyleHidden_hotel_descricao; ?>"><span id="id_label_hotel_descricao"><?php echo $this->nm_new_label['hotel_descricao']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_descricao_line" id="hidden_field_data_hotel_descricao" style="<?php echo $sStyleHidden_hotel_descricao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_descricao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_descricao"]) &&  $this->nmgp_cmp_readonly["hotel_descricao"] == "on") { 

 ?>
<input type="hidden" name="hotel_descricao" value="<?php echo $this->form_encode_input($hotel_descricao) . "\">" . $hotel_descricao . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_descricao" class="sc-ui-readonly-hotel_descricao css_hotel_descricao_line" style="<?php echo $sStyleReadLab_hotel_descricao; ?>"><?php echo $this->form_format_readonly("hotel_descricao", $this->form_encode_input($this->hotel_descricao)); ?></span><span id="id_read_off_hotel_descricao" class="css_read_off_hotel_descricao<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_descricao; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_descricao_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_descricao" type=text name="hotel_descricao" value="<?php echo $this->form_encode_input($hotel_descricao) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{datatype: 'text', maxLength: 100, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_descricao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_descricao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hotel_rede']))
   {
       $this->nm_new_label['hotel_rede'] = "Rede:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_rede = $this->hotel_rede;
   $sStyleHidden_hotel_rede = '';
   if (isset($this->nmgp_cmp_hidden['hotel_rede']) && $this->nmgp_cmp_hidden['hotel_rede'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_rede']);
       $sStyleHidden_hotel_rede = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_rede = 'display: none;';
   $sStyleReadInp_hotel_rede = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_rede']) && $this->nmgp_cmp_readonly['hotel_rede'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_rede']);
       $sStyleReadLab_hotel_rede = '';
       $sStyleReadInp_hotel_rede = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_rede']) && $this->nmgp_cmp_hidden['hotel_rede'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hotel_rede" value="<?php echo $this->form_encode_input($this->hotel_rede) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_rede_label" id="hidden_field_label_hotel_rede" style="<?php echo $sStyleHidden_hotel_rede; ?>"><span id="id_label_hotel_rede"><?php echo $this->nm_new_label['hotel_rede']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_rede']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_rede'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_hotel_rede_line" id="hidden_field_data_hotel_rede" style="<?php echo $sStyleHidden_hotel_rede; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_rede_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_rede"]) &&  $this->nmgp_cmp_readonly["hotel_rede"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'] = array(); 
    }

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT rede_hoteis_descricao  FROM tbl_rede_hoteis  ORDER BY rede_hoteis_descricao";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'][] = $rs->fields[0];
              $nmgp_def_dados .= $rs->fields[0] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
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
   $hotel_rede_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hotel_rede_1))
          {
              foreach ($this->hotel_rede_1 as $tmp_hotel_rede)
              {
                  if (trim($tmp_hotel_rede) === trim($cadaselect[1])) {$hotel_rede_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hotel_rede) && trim($this->hotel_rede) === trim($cadaselect[1])) {$hotel_rede_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="hotel_rede" value="<?php echo $this->form_encode_input($hotel_rede) . "\">" . $hotel_rede_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hotel_rede();
   $x = 0 ; 
   $hotel_rede_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hotel_rede_1))
          {
              foreach ($this->hotel_rede_1 as $tmp_hotel_rede)
              {
                  if (trim($tmp_hotel_rede) === trim($cadaselect[1])) {$hotel_rede_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hotel_rede)) {
                 if (trim($this->hotel_rede) == trim($cadaselect[1])) { $hotel_rede_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->hotel_rede == $cadaselect[1]) { $hotel_rede_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($hotel_rede_look))
          {
              $hotel_rede_look = $this->hotel_rede;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hotel_rede\" class=\"css_hotel_rede_line\" style=\"" .  $sStyleReadLab_hotel_rede . "\">" . $this->form_format_readonly("hotel_rede", $this->form_encode_input($hotel_rede_look)) . "</span><span id=\"id_read_off_hotel_rede\" class=\"css_read_off_hotel_rede" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hotel_rede . "\">";
   echo " <span id=\"idAjaxSelect_hotel_rede\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hotel_rede_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hotel_rede\" name=\"hotel_rede\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_rede'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->hotel_rede) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->hotel_rede)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_rede_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_rede_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hotel_classificacao']))
   {
       $this->nm_new_label['hotel_classificacao'] = "Classificação (tipo):";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_classificacao = $this->hotel_classificacao;
   $sStyleHidden_hotel_classificacao = '';
   if (isset($this->nmgp_cmp_hidden['hotel_classificacao']) && $this->nmgp_cmp_hidden['hotel_classificacao'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_classificacao']);
       $sStyleHidden_hotel_classificacao = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_classificacao = 'display: none;';
   $sStyleReadInp_hotel_classificacao = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_classificacao']) && $this->nmgp_cmp_readonly['hotel_classificacao'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_classificacao']);
       $sStyleReadLab_hotel_classificacao = '';
       $sStyleReadInp_hotel_classificacao = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_classificacao']) && $this->nmgp_cmp_hidden['hotel_classificacao'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hotel_classificacao" value="<?php echo $this->form_encode_input($this->hotel_classificacao) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_classificacao_label" id="hidden_field_label_hotel_classificacao" style="<?php echo $sStyleHidden_hotel_classificacao; ?>"><span id="id_label_hotel_classificacao"><?php echo $this->nm_new_label['hotel_classificacao']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_classificacao']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['php_cmp_required']['hotel_classificacao'] == "on") { ?> <span class="scFormRequiredMarkOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_hotel_classificacao_line" id="hidden_field_data_hotel_classificacao" style="<?php echo $sStyleHidden_hotel_classificacao; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_classificacao_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_classificacao"]) &&  $this->nmgp_cmp_readonly["hotel_classificacao"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'] = array(); 
    }

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT hotel_class_id, hotel_tipo  FROM tbl_hoteis_class  ORDER BY hotel_tipo";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'][] = $rs->fields[0];
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
   $hotel_classificacao_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hotel_classificacao_1))
          {
              foreach ($this->hotel_classificacao_1 as $tmp_hotel_classificacao)
              {
                  if (trim($tmp_hotel_classificacao) === trim($cadaselect[1])) {$hotel_classificacao_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hotel_classificacao) && trim($this->hotel_classificacao) === trim($cadaselect[1])) {$hotel_classificacao_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="hotel_classificacao" value="<?php echo $this->form_encode_input($hotel_classificacao) . "\">" . $hotel_classificacao_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hotel_classificacao();
   $x = 0 ; 
   $hotel_classificacao_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hotel_classificacao_1))
          {
              foreach ($this->hotel_classificacao_1 as $tmp_hotel_classificacao)
              {
                  if (trim($tmp_hotel_classificacao) === trim($cadaselect[1])) {$hotel_classificacao_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hotel_classificacao)) {
                 if (trim($this->hotel_classificacao) == trim($cadaselect[1])) { $hotel_classificacao_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->hotel_classificacao == $cadaselect[1]) { $hotel_classificacao_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($hotel_classificacao_look))
          {
              $hotel_classificacao_look = $this->hotel_classificacao;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hotel_classificacao\" class=\"css_hotel_classificacao_line\" style=\"" .  $sStyleReadLab_hotel_classificacao . "\">" . $this->form_format_readonly("hotel_classificacao", $this->form_encode_input($hotel_classificacao_look)) . "</span><span id=\"id_read_off_hotel_classificacao\" class=\"css_read_off_hotel_classificacao" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hotel_classificacao . "\">";
   echo " <span id=\"idAjaxSelect_hotel_classificacao\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hotel_classificacao_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hotel_classificacao\" name=\"hotel_classificacao\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_classificacao'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->hotel_classificacao) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->hotel_classificacao)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_classificacao_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_classificacao_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hotel_categoria']))
   {
       $this->nm_new_label['hotel_categoria'] = "Categoria:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_categoria = $this->hotel_categoria;
   $sStyleHidden_hotel_categoria = '';
   if (isset($this->nmgp_cmp_hidden['hotel_categoria']) && $this->nmgp_cmp_hidden['hotel_categoria'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_categoria']);
       $sStyleHidden_hotel_categoria = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_categoria = 'display: none;';
   $sStyleReadInp_hotel_categoria = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_categoria']) && $this->nmgp_cmp_readonly['hotel_categoria'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_categoria']);
       $sStyleReadLab_hotel_categoria = '';
       $sStyleReadInp_hotel_categoria = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_categoria']) && $this->nmgp_cmp_hidden['hotel_categoria'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hotel_categoria" value="<?php echo $this->form_encode_input($this->hotel_categoria) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_categoria_label" id="hidden_field_label_hotel_categoria" style="<?php echo $sStyleHidden_hotel_categoria; ?>"><span id="id_label_hotel_categoria"><?php echo $this->nm_new_label['hotel_categoria']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_categoria_line" id="hidden_field_data_hotel_categoria" style="<?php echo $sStyleHidden_hotel_categoria; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_categoria_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_categoria"]) &&  $this->nmgp_cmp_readonly["hotel_categoria"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'] = array(); 
    }

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT categ_hotel_id, classificacao  FROM tbl_categ_hoteis  ORDER BY classificacao";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'][] = $rs->fields[0];
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
   $hotel_categoria_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hotel_categoria_1))
          {
              foreach ($this->hotel_categoria_1 as $tmp_hotel_categoria)
              {
                  if (trim($tmp_hotel_categoria) === trim($cadaselect[1])) {$hotel_categoria_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hotel_categoria) && trim($this->hotel_categoria) === trim($cadaselect[1])) {$hotel_categoria_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="hotel_categoria" value="<?php echo $this->form_encode_input($hotel_categoria) . "\">" . $hotel_categoria_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hotel_categoria();
   $x = 0 ; 
   $hotel_categoria_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hotel_categoria_1))
          {
              foreach ($this->hotel_categoria_1 as $tmp_hotel_categoria)
              {
                  if (trim($tmp_hotel_categoria) === trim($cadaselect[1])) {$hotel_categoria_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hotel_categoria)) {
                 if (trim($this->hotel_categoria) == trim($cadaselect[1])) { $hotel_categoria_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->hotel_categoria == $cadaselect[1]) { $hotel_categoria_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($hotel_categoria_look))
          {
              $hotel_categoria_look = $this->hotel_categoria;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hotel_categoria\" class=\"css_hotel_categoria_line\" style=\"" .  $sStyleReadLab_hotel_categoria . "\">" . $this->form_format_readonly("hotel_categoria", $this->form_encode_input($hotel_categoria_look)) . "</span><span id=\"id_read_off_hotel_categoria\" class=\"css_read_off_hotel_categoria" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hotel_categoria . "\">";
   echo " <span id=\"idAjaxSelect_hotel_categoria\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hotel_categoria_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hotel_categoria\" name=\"hotel_categoria\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_categoria'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;",".:selecione.:.") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->hotel_categoria) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->hotel_categoria)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_categoria_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_categoria_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_logo']))
    {
        $this->nm_new_label['hotel_logo'] = "Logo:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_logo = $this->hotel_logo;
   $sStyleHidden_hotel_logo = '';
   if (isset($this->nmgp_cmp_hidden['hotel_logo']) && $this->nmgp_cmp_hidden['hotel_logo'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_logo']);
       $sStyleHidden_hotel_logo = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_logo = 'display: none;';
   $sStyleReadInp_hotel_logo = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_logo']) && $this->nmgp_cmp_readonly['hotel_logo'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_logo']);
       $sStyleReadLab_hotel_logo = '';
       $sStyleReadInp_hotel_logo = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_logo']) && $this->nmgp_cmp_hidden['hotel_logo'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_logo" value="<?php echo $this->form_encode_input($hotel_logo) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_logo_label" id="hidden_field_label_hotel_logo" style="<?php echo $sStyleHidden_hotel_logo; ?>"><span id="id_label_hotel_logo"><?php echo $this->nm_new_label['hotel_logo']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_logo_line" id="hidden_field_data_hotel_logo" style="<?php echo $sStyleHidden_hotel_logo; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_logo_line" style="vertical-align: top;padding: 0px">
 <?php $this->NM_ajax_info['varList'][] = array("var_ajax_img_hotel_logo" => $out_hotel_logo); ?><script>var var_ajax_img_hotel_logo = '<?php echo $out_hotel_logo; ?>';</script><input type="hidden" name="temp_out_hotel_logo" value="<?php echo $this->form_encode_input($out_hotel_logo); ?>" /><?php if (!empty($out_hotel_logo)) {  echo "<a  href=\"javascript:nm_mostra_img(var_ajax_img_hotel_logo, '" . $this->nmgp_return_img['hotel_logo'][0] . "', '" . $this->nmgp_return_img['hotel_logo'][1] . "')\"><img id=\"id_ajax_img_hotel_logo\"  border=\"0\" src=\"$out_hotel_logo\"></a>"; } else {  echo "<img id=\"id_ajax_img_hotel_logo\" border=\"0\" style=\"display: none\">"; } ?><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_logo"]) &&  $this->nmgp_cmp_readonly["hotel_logo"] == "on") { 

 ?>
<img id=\"hotel_logo_img_uploading\" style=\"display: none\" border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" /><input type="hidden" name="hotel_logo" value="<?php echo $this->form_encode_input($hotel_logo) . "\">" . $hotel_logo . ""; ?>
<?php } else { ?>
<span id="id_read_off_hotel_logo" class="css_read_off_hotel_logo<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_logo; ?>"><span style="display:inline-block"><span id="sc-id-upload-select-hotel_logo" class="fileinput-button fileinput-button-padding scButton_default">
 <span><?php echo $this->Ini->Nm_lang['lang_select_file'] ?></span>

 <input class="sc-js-input scFormObjectOdd css_hotel_logo_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" title="<?php echo $this->Ini->Nm_lang['lang_select_file'] ?>" type="file" name="hotel_logo[]" id="id_sc_field_hotel_logo" onchange="<?php if ($this->nmgp_opcao == "novo") {echo "if (document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]']) { document.F1.elements['sc_check_vert[" . $sc_seq_vert . "]'].checked = true }"; }?>"></span></span>
<?php
   $sCheckInsert = "";
?>
<span id="chk_ajax_img_hotel_logo"<?php if ($this->nmgp_opcao == "novo" || empty($hotel_logo)) { echo " style=\"display: none\""; } ?>> <input type=checkbox name="hotel_logo_limpa" value="<?php echo $hotel_logo_limpa . '" '; if ($hotel_logo_limpa == "S"){echo "checked ";} ?> onclick="this.value = ''; if (this.checked){ this.value = 'S'};<?php echo $sCheckInsert ?>"><?php echo $this->Ini->Nm_lang['lang_btns_dele_hint']; ?> &nbsp;</span><img id="hotel_logo_img_uploading" style="display: none" border="0" src="<?php echo $this->Ini->path_icones; ?>/scriptcase__NM__ajax_load.gif" align="absmiddle" /><div id="id_img_loader_hotel_logo" class="progress progress-success progress-striped active scProgressBarStart" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="display: none"><div class="bar scProgressBarLoading">&nbsp;</div></div><img id="id_ajax_loader_hotel_logo" src="<?php echo $this->Ini->path_icones ?>/scriptcase__NM__ajax_load.gif" style="display: none" /></span><?php } ?>
<div id="id_sc_dragdrop_hotel_logo" class="scFormDataDragNDrop"  style="<?php echo $sStyleReadInp_hotel_logo ?>"><i class='fas fa-cloud-upload-alt'></i><br/>
<?php echo $this->Ini->Nm_lang['lang_errm_mu_dragimg'] ?></div>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_logo_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_logo_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['hotel_cep']))
    {
        $this->nm_new_label['hotel_cep'] = "CEP:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_cep = $this->hotel_cep;
   $sStyleHidden_hotel_cep = '';
   if (isset($this->nmgp_cmp_hidden['hotel_cep']) && $this->nmgp_cmp_hidden['hotel_cep'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_cep']);
       $sStyleHidden_hotel_cep = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_cep = 'display: none;';
   $sStyleReadInp_hotel_cep = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_cep']) && $this->nmgp_cmp_readonly['hotel_cep'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_cep']);
       $sStyleReadLab_hotel_cep = '';
       $sStyleReadInp_hotel_cep = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_cep']) && $this->nmgp_cmp_hidden['hotel_cep'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_cep" value="<?php echo $this->form_encode_input($hotel_cep) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_cep_label" id="hidden_field_label_hotel_cep" style="<?php echo $sStyleHidden_hotel_cep; ?>"><span id="id_label_hotel_cep"><?php echo $this->nm_new_label['hotel_cep']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_cep_line" id="hidden_field_data_hotel_cep" style="<?php echo $sStyleHidden_hotel_cep; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_cep_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_cep"]) &&  $this->nmgp_cmp_readonly["hotel_cep"] == "on") { 

 ?>
<input type="hidden" name="hotel_cep" value="<?php echo $this->form_encode_input($hotel_cep) . "\">" . $hotel_cep . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_cep" class="sc-ui-readonly-hotel_cep css_hotel_cep_line" style="<?php echo $sStyleReadLab_hotel_cep; ?>"><?php echo $this->form_format_readonly("hotel_cep", $this->form_encode_input($this->hotel_cep)); ?></span><span id="id_read_off_hotel_cep" class="css_read_off_hotel_cep<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_cep; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_cep_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_cep" type=text name="hotel_cep" value="<?php echo $this->form_encode_input($hotel_cep) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'cep', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "bzipcode", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_tbl_hoteis'). "/form_tbl_hoteis_cep.php?cep=&form_origem=F1;CEP,hotel_cep;UF,hotel_uf;CIDADE,hotel_municipio;BAIRRO,hotel_bairro;RUA,hotel_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "tb_show('', '" . $this->Ini->sc_protocolo . $this->Ini->server . $this->Ini->path_link . SC_dir_app_name('form_tbl_hoteis'). "/form_tbl_hoteis_cep.php?cep=&form_origem=F1;CEP,hotel_cep;UF,hotel_uf;CIDADE,hotel_municipio;BAIRRO,hotel_bairro;RUA,hotel_logradouro&TB_iframe=true&height=370&width=420&modal=true', '')", "hotel_cep_cep", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_cep_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_cep_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['hotel_pais']))
   {
       $this->nm_new_label['hotel_pais'] = "País:";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_pais = $this->hotel_pais;
   $sStyleHidden_hotel_pais = '';
   if (isset($this->nmgp_cmp_hidden['hotel_pais']) && $this->nmgp_cmp_hidden['hotel_pais'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_pais']);
       $sStyleHidden_hotel_pais = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_pais = 'display: none;';
   $sStyleReadInp_hotel_pais = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_pais']) && $this->nmgp_cmp_readonly['hotel_pais'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_pais']);
       $sStyleReadLab_hotel_pais = '';
       $sStyleReadInp_hotel_pais = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_pais']) && $this->nmgp_cmp_hidden['hotel_pais'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="hotel_pais" value="<?php echo $this->form_encode_input($this->hotel_pais) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_pais_label" id="hidden_field_label_hotel_pais" style="<?php echo $sStyleHidden_hotel_pais; ?>"><span id="id_label_hotel_pais"><?php echo $this->nm_new_label['hotel_pais']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_pais_line" id="hidden_field_data_hotel_pais" style="<?php echo $sStyleHidden_hotel_pais; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_pais_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_pais"]) &&  $this->nmgp_cmp_readonly["hotel_pais"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'] = array(); 
    }

   $old_value_hotel_id = $this->hotel_id;
   $old_value_hotel_cep = $this->hotel_cep;
   $old_value_hotel_telefone = $this->hotel_telefone;
   $old_value_hotel_fax = $this->hotel_fax;
   $old_value_hotel_celular = $this->hotel_celular;
   $this->nm_tira_formatacao();


   $unformatted_value_hotel_id = $this->hotel_id;
   $unformatted_value_hotel_cep = $this->hotel_cep;
   $unformatted_value_hotel_telefone = $this->hotel_telefone;
   $unformatted_value_hotel_fax = $this->hotel_fax;
   $unformatted_value_hotel_celular = $this->hotel_celular;

   $nm_comando = "SELECT pais_id, descricao  FROM tbl_paises  ORDER BY descricao";

   $this->hotel_id = $old_value_hotel_id;
   $this->hotel_cep = $old_value_hotel_cep;
   $this->hotel_telefone = $old_value_hotel_telefone;
   $this->hotel_fax = $old_value_hotel_fax;
   $this->hotel_celular = $old_value_hotel_celular;

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
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'][] = $rs->fields[0];
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
   $hotel_pais_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hotel_pais_1))
          {
              foreach ($this->hotel_pais_1 as $tmp_hotel_pais)
              {
                  if (trim($tmp_hotel_pais) === trim($cadaselect[1])) {$hotel_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hotel_pais) && trim($this->hotel_pais) === trim($cadaselect[1])) {$hotel_pais_look .= $cadaselect[0];} 
          $x++; 
   }

?>
<input type="hidden" name="hotel_pais" value="<?php echo $this->form_encode_input($hotel_pais) . "\">" . $hotel_pais_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_hotel_pais();
   $x = 0 ; 
   $hotel_pais_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->hotel_pais_1))
          {
              foreach ($this->hotel_pais_1 as $tmp_hotel_pais)
              {
                  if (trim($tmp_hotel_pais) === trim($cadaselect[1])) {$hotel_pais_look .= $cadaselect[0] . '__SC_BREAK_LINE__';}
              }
          }
          elseif (isset($cadaselect[1]) && is_string($this->hotel_pais)) {
                 if (trim($this->hotel_pais) == trim($cadaselect[1])) { $hotel_pais_look .= $cadaselect[0]; } 
          }
          elseif (isset($cadaselect[1]) && $this->hotel_pais == $cadaselect[1]) { $hotel_pais_look .= $cadaselect[0]; 
          }
          $x++; 
   }
          if (empty($hotel_pais_look))
          {
              $hotel_pais_look = $this->hotel_pais;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_hotel_pais\" class=\"css_hotel_pais_line\" style=\"" .  $sStyleReadLab_hotel_pais . "\">" . $this->form_format_readonly("hotel_pais", $this->form_encode_input($hotel_pais_look)) . "</span><span id=\"id_read_off_hotel_pais\" class=\"css_read_off_hotel_pais" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_hotel_pais . "\">";
   echo " <span id=\"idAjaxSelect_hotel_pais\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_hotel_pais_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_hotel_pais\" name=\"hotel_pais\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_pais'][] = ''; 
   echo "  <option value=\"\">" . str_replace("<", "&lt;","BRASIL") . "</option>" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->hotel_pais) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->hotel_pais)) 
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
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_pais_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_pais_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_uf']))
    {
        $this->nm_new_label['hotel_uf'] = "UF:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_uf = $this->hotel_uf;
   $sStyleHidden_hotel_uf = '';
   if (isset($this->nmgp_cmp_hidden['hotel_uf']) && $this->nmgp_cmp_hidden['hotel_uf'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_uf']);
       $sStyleHidden_hotel_uf = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_uf = 'display: none;';
   $sStyleReadInp_hotel_uf = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_uf']) && $this->nmgp_cmp_readonly['hotel_uf'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_uf']);
       $sStyleReadLab_hotel_uf = '';
       $sStyleReadInp_hotel_uf = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_uf']) && $this->nmgp_cmp_hidden['hotel_uf'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_uf" value="<?php echo $this->form_encode_input($hotel_uf) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_uf_label" id="hidden_field_label_hotel_uf" style="<?php echo $sStyleHidden_hotel_uf; ?>"><span id="id_label_hotel_uf"><?php echo $this->nm_new_label['hotel_uf']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_uf_line" id="hidden_field_data_hotel_uf" style="<?php echo $sStyleHidden_hotel_uf; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_uf_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_uf"]) &&  $this->nmgp_cmp_readonly["hotel_uf"] == "on") { 

 ?>
<input type="hidden" name="hotel_uf" value="<?php echo $this->form_encode_input($hotel_uf) . "\">" . $hotel_uf . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_uf" class="sc-ui-readonly-hotel_uf css_hotel_uf_line" style="<?php echo $sStyleReadLab_hotel_uf; ?>"><?php echo $this->form_format_readonly("hotel_uf", $this->form_encode_input($this->hotel_uf)); ?></span><span id="id_read_off_hotel_uf" class="css_read_off_hotel_uf<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_uf; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_uf_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_uf" type=text name="hotel_uf" value="<?php echo $this->form_encode_input($hotel_uf) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=11 alt="{datatype: 'text', maxLength: 11, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_uf_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_uf_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_municipio']))
    {
        $this->nm_new_label['hotel_municipio'] = "Município:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_municipio = $this->hotel_municipio;
   $sStyleHidden_hotel_municipio = '';
   if (isset($this->nmgp_cmp_hidden['hotel_municipio']) && $this->nmgp_cmp_hidden['hotel_municipio'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_municipio']);
       $sStyleHidden_hotel_municipio = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_municipio = 'display: none;';
   $sStyleReadInp_hotel_municipio = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_municipio']) && $this->nmgp_cmp_readonly['hotel_municipio'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_municipio']);
       $sStyleReadLab_hotel_municipio = '';
       $sStyleReadInp_hotel_municipio = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_municipio']) && $this->nmgp_cmp_hidden['hotel_municipio'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_municipio" value="<?php echo $this->form_encode_input($hotel_municipio) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_municipio_label" id="hidden_field_label_hotel_municipio" style="<?php echo $sStyleHidden_hotel_municipio; ?>"><span id="id_label_hotel_municipio"><?php echo $this->nm_new_label['hotel_municipio']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_municipio_line" id="hidden_field_data_hotel_municipio" style="<?php echo $sStyleHidden_hotel_municipio; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_municipio_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_municipio"]) &&  $this->nmgp_cmp_readonly["hotel_municipio"] == "on") { 

 ?>
<input type="hidden" name="hotel_municipio" value="<?php echo $this->form_encode_input($hotel_municipio) . "\">" . $hotel_municipio . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_municipio" class="sc-ui-readonly-hotel_municipio css_hotel_municipio_line" style="<?php echo $sStyleReadLab_hotel_municipio; ?>"><?php echo $this->form_format_readonly("hotel_municipio", $this->form_encode_input($this->hotel_municipio)); ?></span><span id="id_read_off_hotel_municipio" class="css_read_off_hotel_municipio<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_municipio; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_municipio_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_municipio" type=text name="hotel_municipio" value="<?php echo $this->form_encode_input($hotel_municipio) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_municipio_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_municipio_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_bairro']))
    {
        $this->nm_new_label['hotel_bairro'] = "Bairro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_bairro = $this->hotel_bairro;
   $sStyleHidden_hotel_bairro = '';
   if (isset($this->nmgp_cmp_hidden['hotel_bairro']) && $this->nmgp_cmp_hidden['hotel_bairro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_bairro']);
       $sStyleHidden_hotel_bairro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_bairro = 'display: none;';
   $sStyleReadInp_hotel_bairro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_bairro']) && $this->nmgp_cmp_readonly['hotel_bairro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_bairro']);
       $sStyleReadLab_hotel_bairro = '';
       $sStyleReadInp_hotel_bairro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_bairro']) && $this->nmgp_cmp_hidden['hotel_bairro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_bairro" value="<?php echo $this->form_encode_input($hotel_bairro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_bairro_label" id="hidden_field_label_hotel_bairro" style="<?php echo $sStyleHidden_hotel_bairro; ?>"><span id="id_label_hotel_bairro"><?php echo $this->nm_new_label['hotel_bairro']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_bairro_line" id="hidden_field_data_hotel_bairro" style="<?php echo $sStyleHidden_hotel_bairro; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_bairro_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_bairro"]) &&  $this->nmgp_cmp_readonly["hotel_bairro"] == "on") { 

 ?>
<input type="hidden" name="hotel_bairro" value="<?php echo $this->form_encode_input($hotel_bairro) . "\">" . $hotel_bairro . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_bairro" class="sc-ui-readonly-hotel_bairro css_hotel_bairro_line" style="<?php echo $sStyleReadLab_hotel_bairro; ?>"><?php echo $this->form_format_readonly("hotel_bairro", $this->form_encode_input($this->hotel_bairro)); ?></span><span id="id_read_off_hotel_bairro" class="css_read_off_hotel_bairro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_bairro; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_bairro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_bairro" type=text name="hotel_bairro" value="<?php echo $this->form_encode_input($hotel_bairro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_bairro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_bairro_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_logradouro']))
    {
        $this->nm_new_label['hotel_logradouro'] = "Logradouro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_logradouro = $this->hotel_logradouro;
   $sStyleHidden_hotel_logradouro = '';
   if (isset($this->nmgp_cmp_hidden['hotel_logradouro']) && $this->nmgp_cmp_hidden['hotel_logradouro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_logradouro']);
       $sStyleHidden_hotel_logradouro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_logradouro = 'display: none;';
   $sStyleReadInp_hotel_logradouro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_logradouro']) && $this->nmgp_cmp_readonly['hotel_logradouro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_logradouro']);
       $sStyleReadLab_hotel_logradouro = '';
       $sStyleReadInp_hotel_logradouro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_logradouro']) && $this->nmgp_cmp_hidden['hotel_logradouro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_logradouro" value="<?php echo $this->form_encode_input($hotel_logradouro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_logradouro_label" id="hidden_field_label_hotel_logradouro" style="<?php echo $sStyleHidden_hotel_logradouro; ?>"><span id="id_label_hotel_logradouro"><?php echo $this->nm_new_label['hotel_logradouro']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_logradouro_line" id="hidden_field_data_hotel_logradouro" style="<?php echo $sStyleHidden_hotel_logradouro; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_logradouro_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_logradouro"]) &&  $this->nmgp_cmp_readonly["hotel_logradouro"] == "on") { 

 ?>
<input type="hidden" name="hotel_logradouro" value="<?php echo $this->form_encode_input($hotel_logradouro) . "\">" . $hotel_logradouro . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_logradouro" class="sc-ui-readonly-hotel_logradouro css_hotel_logradouro_line" style="<?php echo $sStyleReadLab_hotel_logradouro; ?>"><?php echo $this->form_format_readonly("hotel_logradouro", $this->form_encode_input($this->hotel_logradouro)); ?></span><span id="id_read_off_hotel_logradouro" class="css_read_off_hotel_logradouro<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_logradouro; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_logradouro_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_logradouro" type=text name="hotel_logradouro" value="<?php echo $this->form_encode_input($hotel_logradouro) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=60 alt="{datatype: 'text', maxLength: 60, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: 'upper', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_logradouro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_logradouro_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_numero']))
    {
        $this->nm_new_label['hotel_numero'] = "Número:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_numero = $this->hotel_numero;
   $sStyleHidden_hotel_numero = '';
   if (isset($this->nmgp_cmp_hidden['hotel_numero']) && $this->nmgp_cmp_hidden['hotel_numero'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_numero']);
       $sStyleHidden_hotel_numero = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_numero = 'display: none;';
   $sStyleReadInp_hotel_numero = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_numero']) && $this->nmgp_cmp_readonly['hotel_numero'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_numero']);
       $sStyleReadLab_hotel_numero = '';
       $sStyleReadInp_hotel_numero = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_numero']) && $this->nmgp_cmp_hidden['hotel_numero'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_numero" value="<?php echo $this->form_encode_input($hotel_numero) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_numero_label" id="hidden_field_label_hotel_numero" style="<?php echo $sStyleHidden_hotel_numero; ?>"><span id="id_label_hotel_numero"><?php echo $this->nm_new_label['hotel_numero']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_numero_line" id="hidden_field_data_hotel_numero" style="<?php echo $sStyleHidden_hotel_numero; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_numero_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_numero"]) &&  $this->nmgp_cmp_readonly["hotel_numero"] == "on") { 

 ?>
<input type="hidden" name="hotel_numero" value="<?php echo $this->form_encode_input($hotel_numero) . "\">" . $hotel_numero . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_numero" class="sc-ui-readonly-hotel_numero css_hotel_numero_line" style="<?php echo $sStyleReadLab_hotel_numero; ?>"><?php echo $this->form_format_readonly("hotel_numero", $this->form_encode_input($this->hotel_numero)); ?></span><span id="id_read_off_hotel_numero" class="css_read_off_hotel_numero<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_numero; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_numero_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_numero" type=text name="hotel_numero" value="<?php echo $this->form_encode_input($hotel_numero) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> maxlength=10 alt="{datatype: 'text', maxLength: 10, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_numero_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_numero_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_complemento']))
    {
        $this->nm_new_label['hotel_complemento'] = "Complemento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_complemento = $this->hotel_complemento;
   $sStyleHidden_hotel_complemento = '';
   if (isset($this->nmgp_cmp_hidden['hotel_complemento']) && $this->nmgp_cmp_hidden['hotel_complemento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_complemento']);
       $sStyleHidden_hotel_complemento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_complemento = 'display: none;';
   $sStyleReadInp_hotel_complemento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_complemento']) && $this->nmgp_cmp_readonly['hotel_complemento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_complemento']);
       $sStyleReadLab_hotel_complemento = '';
       $sStyleReadInp_hotel_complemento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_complemento']) && $this->nmgp_cmp_hidden['hotel_complemento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_complemento" value="<?php echo $this->form_encode_input($hotel_complemento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_complemento_label" id="hidden_field_label_hotel_complemento" style="<?php echo $sStyleHidden_hotel_complemento; ?>"><span id="id_label_hotel_complemento"><?php echo $this->nm_new_label['hotel_complemento']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_complemento_line" id="hidden_field_data_hotel_complemento" style="<?php echo $sStyleHidden_hotel_complemento; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_complemento_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_complemento"]) &&  $this->nmgp_cmp_readonly["hotel_complemento"] == "on") { 

 ?>
<input type="hidden" name="hotel_complemento" value="<?php echo $this->form_encode_input($hotel_complemento) . "\">" . $hotel_complemento . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_complemento" class="sc-ui-readonly-hotel_complemento css_hotel_complemento_line" style="<?php echo $sStyleReadLab_hotel_complemento; ?>"><?php echo $this->form_format_readonly("hotel_complemento", $this->form_encode_input($this->hotel_complemento)); ?></span><span id="id_read_off_hotel_complemento" class="css_read_off_hotel_complemento<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_complemento; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_complemento_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_complemento" type=text name="hotel_complemento" value="<?php echo $this->form_encode_input($hotel_complemento) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=20"; } ?> maxlength=20 alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_complemento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_complemento_text"></span></td></tr></table></td></tr></table></TD>
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
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_observacoes']))
    {
        $this->nm_new_label['hotel_observacoes'] = "Observações:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_observacoes = $this->hotel_observacoes;
   $sStyleHidden_hotel_observacoes = '';
   if (isset($this->nmgp_cmp_hidden['hotel_observacoes']) && $this->nmgp_cmp_hidden['hotel_observacoes'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_observacoes']);
       $sStyleHidden_hotel_observacoes = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_observacoes = 'display: none;';
   $sStyleReadInp_hotel_observacoes = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_observacoes']) && $this->nmgp_cmp_readonly['hotel_observacoes'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_observacoes']);
       $sStyleReadLab_hotel_observacoes = '';
       $sStyleReadInp_hotel_observacoes = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_observacoes']) && $this->nmgp_cmp_hidden['hotel_observacoes'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_observacoes" value="<?php echo $this->form_encode_input($hotel_observacoes) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_observacoes_label" id="hidden_field_label_hotel_observacoes" style="<?php echo $sStyleHidden_hotel_observacoes; ?>"><span id="id_label_hotel_observacoes"><?php echo $this->nm_new_label['hotel_observacoes']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_observacoes_line" id="hidden_field_data_hotel_observacoes" style="<?php echo $sStyleHidden_hotel_observacoes; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_observacoes_line" style="vertical-align: top;padding: 0px">
<?php
$hotel_observacoes_val = str_replace('<br />', '__SC_BREAK_LINE__', nl2br($hotel_observacoes));

?>

<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_observacoes"]) &&  $this->nmgp_cmp_readonly["hotel_observacoes"] == "on") { 

 ?>
<input type="hidden" name="hotel_observacoes" value="<?php echo $this->form_encode_input($hotel_observacoes) . "\">" . $hotel_observacoes_val . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_observacoes" class="sc-ui-readonly-hotel_observacoes css_hotel_observacoes_line" style="<?php echo $sStyleReadLab_hotel_observacoes; ?>"><?php echo $this->form_format_readonly("hotel_observacoes", $this->form_encode_input($hotel_observacoes_val)); ?></span><span id="id_read_off_hotel_observacoes" class="css_read_off_hotel_observacoes<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_observacoes; ?>">
 <textarea class="sc-js-input scFormObjectOdd css_hotel_observacoes_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="white-space: pre-wrap;" name="hotel_observacoes" id="id_sc_field_hotel_observacoes" rows="2" cols="50"
 alt="{datatype: 'text', maxLength: 255, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >
<?php echo $hotel_observacoes; ?>
</textarea>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_observacoes_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_observacoes_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['hotel_email']))
    {
        $this->nm_new_label['hotel_email'] = "Email:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_email = $this->hotel_email;
   $sStyleHidden_hotel_email = '';
   if (isset($this->nmgp_cmp_hidden['hotel_email']) && $this->nmgp_cmp_hidden['hotel_email'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_email']);
       $sStyleHidden_hotel_email = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_email = 'display: none;';
   $sStyleReadInp_hotel_email = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_email']) && $this->nmgp_cmp_readonly['hotel_email'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_email']);
       $sStyleReadLab_hotel_email = '';
       $sStyleReadInp_hotel_email = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_email']) && $this->nmgp_cmp_hidden['hotel_email'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_email" value="<?php echo $this->form_encode_input($hotel_email) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_email_label" id="hidden_field_label_hotel_email" style="<?php echo $sStyleHidden_hotel_email; ?>"><span id="id_label_hotel_email"><?php echo $this->nm_new_label['hotel_email']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_email_line" id="hidden_field_data_hotel_email" style="<?php echo $sStyleHidden_hotel_email; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_email_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_email"]) &&  $this->nmgp_cmp_readonly["hotel_email"] == "on") { 

 ?>
<input type="hidden" name="hotel_email" value="<?php echo $this->form_encode_input($hotel_email) . "\">" . $hotel_email . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_email" class="sc-ui-readonly-hotel_email css_hotel_email_line" style="<?php echo $sStyleReadLab_hotel_email; ?>"><?php echo $this->form_format_readonly("hotel_email", $this->form_encode_input($this->hotel_email)); ?></span><span id="id_read_off_hotel_email" class="css_read_off_hotel_email<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_email; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_email_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_email" type=text name="hotel_email" value="<?php echo $this->form_encode_input($hotel_email) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php if ($this->nmgp_opcao != "novo"){ ?><?php echo nmButtonOutput($this->arr_buttons, "bemail", "if (document.F1.hotel_email.value != '') {window.open('mailto:' + document.F1.hotel_email.value); }", "if (document.F1.hotel_email.value != '') {window.open('mailto:' + document.F1.hotel_email.value); }", "hotel_email_mail", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>
<?php } ?>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_email_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_email_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_website']))
    {
        $this->nm_new_label['hotel_website'] = "Website:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_website = $this->hotel_website;
   $sStyleHidden_hotel_website = '';
   if (isset($this->nmgp_cmp_hidden['hotel_website']) && $this->nmgp_cmp_hidden['hotel_website'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_website']);
       $sStyleHidden_hotel_website = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_website = 'display: none;';
   $sStyleReadInp_hotel_website = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_website']) && $this->nmgp_cmp_readonly['hotel_website'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_website']);
       $sStyleReadLab_hotel_website = '';
       $sStyleReadInp_hotel_website = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_website']) && $this->nmgp_cmp_hidden['hotel_website'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_website" value="<?php echo $this->form_encode_input($hotel_website) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_website_label" id="hidden_field_label_hotel_website" style="<?php echo $sStyleHidden_hotel_website; ?>"><span id="id_label_hotel_website"><?php echo $this->nm_new_label['hotel_website']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_website_line" id="hidden_field_data_hotel_website" style="<?php echo $sStyleHidden_hotel_website; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_website_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_website"]) &&  $this->nmgp_cmp_readonly["hotel_website"] == "on") { 

 ?>
<input type="hidden" name="hotel_website" value="<?php echo $this->form_encode_input($hotel_website) . "\">" . $hotel_website . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_website" class="sc-ui-readonly-hotel_website css_hotel_website_line" style="<?php echo $sStyleReadLab_hotel_website; ?>"><?php echo $this->form_format_readonly("hotel_website", $this->form_encode_input($this->hotel_website)); ?></span><span id="id_read_off_hotel_website" class="css_read_off_hotel_website<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_website; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_website_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_website" type=text name="hotel_website" value="<?php echo $this->form_encode_input($hotel_website) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=100 alt="{enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<?php echo nmButtonOutput($this->arr_buttons, "blink", "window.open(nm_link_url(document.F1.hotel_website.value), '_blank')", "window.open(nm_link_url(document.F1.hotel_website.value), '_blank')", "hotel_website_url", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", '', '', '', '', '', '', '', '', "");?>

</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_website_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_website_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_telefone']))
    {
        $this->nm_new_label['hotel_telefone'] = "Telefone";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_telefone = $this->hotel_telefone;
   $sStyleHidden_hotel_telefone = '';
   if (isset($this->nmgp_cmp_hidden['hotel_telefone']) && $this->nmgp_cmp_hidden['hotel_telefone'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_telefone']);
       $sStyleHidden_hotel_telefone = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_telefone = 'display: none;';
   $sStyleReadInp_hotel_telefone = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_telefone']) && $this->nmgp_cmp_readonly['hotel_telefone'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_telefone']);
       $sStyleReadLab_hotel_telefone = '';
       $sStyleReadInp_hotel_telefone = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_telefone']) && $this->nmgp_cmp_hidden['hotel_telefone'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_telefone" value="<?php echo $this->form_encode_input($hotel_telefone) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_telefone_label" id="hidden_field_label_hotel_telefone" style="<?php echo $sStyleHidden_hotel_telefone; ?>"><span id="id_label_hotel_telefone"><?php echo $this->nm_new_label['hotel_telefone']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_telefone_line" id="hidden_field_data_hotel_telefone" style="<?php echo $sStyleHidden_hotel_telefone; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_telefone_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_telefone"]) &&  $this->nmgp_cmp_readonly["hotel_telefone"] == "on") { 

 ?>
<input type="hidden" name="hotel_telefone" value="<?php echo $this->form_encode_input($hotel_telefone) . "\">" . $hotel_telefone . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_telefone" class="sc-ui-readonly-hotel_telefone css_hotel_telefone_line" style="<?php echo $sStyleReadLab_hotel_telefone; ?>"><?php echo $this->form_format_readonly("hotel_telefone", $this->form_encode_input($this->hotel_telefone)); ?></span><span id="id_read_off_hotel_telefone" class="css_read_off_hotel_telefone<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_telefone; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_telefone_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_telefone" type=text name="hotel_telefone" value="<?php echo $this->form_encode_input($hotel_telefone) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=39 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 9999-9999', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_telefone_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_telefone_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_fax']))
    {
        $this->nm_new_label['hotel_fax'] = "Fax:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_fax = $this->hotel_fax;
   $sStyleHidden_hotel_fax = '';
   if (isset($this->nmgp_cmp_hidden['hotel_fax']) && $this->nmgp_cmp_hidden['hotel_fax'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_fax']);
       $sStyleHidden_hotel_fax = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_fax = 'display: none;';
   $sStyleReadInp_hotel_fax = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_fax']) && $this->nmgp_cmp_readonly['hotel_fax'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_fax']);
       $sStyleReadLab_hotel_fax = '';
       $sStyleReadInp_hotel_fax = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_fax']) && $this->nmgp_cmp_hidden['hotel_fax'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_fax" value="<?php echo $this->form_encode_input($hotel_fax) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_fax_label" id="hidden_field_label_hotel_fax" style="<?php echo $sStyleHidden_hotel_fax; ?>"><span id="id_label_hotel_fax"><?php echo $this->nm_new_label['hotel_fax']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_fax_line" id="hidden_field_data_hotel_fax" style="<?php echo $sStyleHidden_hotel_fax; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_fax_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_fax"]) &&  $this->nmgp_cmp_readonly["hotel_fax"] == "on") { 

 ?>
<input type="hidden" name="hotel_fax" value="<?php echo $this->form_encode_input($hotel_fax) . "\">" . $hotel_fax . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_fax" class="sc-ui-readonly-hotel_fax css_hotel_fax_line" style="<?php echo $sStyleReadLab_hotel_fax; ?>"><?php echo $this->form_format_readonly("hotel_fax", $this->form_encode_input($this->hotel_fax)); ?></span><span id="id_read_off_hotel_fax" class="css_read_off_hotel_fax<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_fax; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_fax_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_fax" type=text name="hotel_fax" value="<?php echo $this->form_encode_input($hotel_fax) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=39 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 9999-9999', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_fax_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_fax_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_celular']))
    {
        $this->nm_new_label['hotel_celular'] = "Celular:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_celular = $this->hotel_celular;
   $sStyleHidden_hotel_celular = '';
   if (isset($this->nmgp_cmp_hidden['hotel_celular']) && $this->nmgp_cmp_hidden['hotel_celular'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_celular']);
       $sStyleHidden_hotel_celular = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_celular = 'display: none;';
   $sStyleReadInp_hotel_celular = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_celular']) && $this->nmgp_cmp_readonly['hotel_celular'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_celular']);
       $sStyleReadLab_hotel_celular = '';
       $sStyleReadInp_hotel_celular = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_celular']) && $this->nmgp_cmp_hidden['hotel_celular'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_celular" value="<?php echo $this->form_encode_input($hotel_celular) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_celular_label" id="hidden_field_label_hotel_celular" style="<?php echo $sStyleHidden_hotel_celular; ?>"><span id="id_label_hotel_celular"><?php echo $this->nm_new_label['hotel_celular']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_celular_line" id="hidden_field_data_hotel_celular" style="<?php echo $sStyleHidden_hotel_celular; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_celular_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_celular"]) &&  $this->nmgp_cmp_readonly["hotel_celular"] == "on") { 

 ?>
<input type="hidden" name="hotel_celular" value="<?php echo $this->form_encode_input($hotel_celular) . "\">" . $hotel_celular . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_celular" class="sc-ui-readonly-hotel_celular css_hotel_celular_line" style="<?php echo $sStyleReadLab_hotel_celular; ?>"><?php echo $this->form_format_readonly("hotel_celular", $this->form_encode_input($this->hotel_celular)); ?></span><span id="id_read_off_hotel_celular" class="css_read_off_hotel_celular<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_celular; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_celular_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_celular" type=text name="hotel_celular" value="<?php echo $this->form_encode_input($hotel_celular) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=25"; } ?> maxlength=40 alt="{datatype: 'mask', maxLength: 25, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '(99) 99999-9999', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_celular_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_celular_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_status']))
    {
        $this->nm_new_label['hotel_status'] = "Status:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_status = $this->hotel_status;
   $sStyleHidden_hotel_status = '';
   if (isset($this->nmgp_cmp_hidden['hotel_status']) && $this->nmgp_cmp_hidden['hotel_status'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_status']);
       $sStyleHidden_hotel_status = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_status = 'display: none;';
   $sStyleReadInp_hotel_status = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_status']) && $this->nmgp_cmp_readonly['hotel_status'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_status']);
       $sStyleReadLab_hotel_status = '';
       $sStyleReadInp_hotel_status = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_status']) && $this->nmgp_cmp_hidden['hotel_status'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_status" value="<?php echo $this->form_encode_input($hotel_status) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_status_label" id="hidden_field_label_hotel_status" style="<?php echo $sStyleHidden_hotel_status; ?>"><span id="id_label_hotel_status"><?php echo $this->nm_new_label['hotel_status']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_status_line" id="hidden_field_data_hotel_status" style="<?php echo $sStyleHidden_hotel_status; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_status_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_status"]) &&  $this->nmgp_cmp_readonly["hotel_status"] == "on") { 

 if ("Y" == $this->hotel_status) { $hotel_status_look = "Ativo";} 
 if ("N" == $this->hotel_status) { $hotel_status_look = "Inativo";} 
?>
<input type="hidden" name="hotel_status" value="<?php echo $this->form_encode_input($hotel_status) . "\">" . $hotel_status_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_status) { $hotel_status_look = "Ativo";} 
 if ("N" == $this->hotel_status) { $hotel_status_look = "Inativo";} 
?>
<span id="id_read_on_hotel_status"  class="css_hotel_status_line" style="<?php echo $sStyleReadLab_hotel_status; ?>"><?php echo $this->form_format_readonly("hotel_status", $this->form_encode_input($hotel_status_look)); ?></span><span id="id_read_off_hotel_status" class="css_read_off_hotel_status css_hotel_status_line" style="<?php echo $sStyleReadInp_hotel_status; ?>"><div id="idAjaxRadio_hotel_status" style="display: inline-block"  class="css_hotel_status_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_status_line"><?php $tempOptionId = "id-opt-hotel_status" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_status sc-ui-radio-hotel_status" type=radio name="hotel_status" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_status'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_status)  { echo " checked" ;} ?><?php  if (empty($this->hotel_status)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Ativo</label></TD>
  <TD class="scFormDataFontOdd css_hotel_status_line"><?php $tempOptionId = "id-opt-hotel_status" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_status sc-ui-radio-hotel_status" type=radio name="hotel_status" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_status'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_status)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Inativo</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_status_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_status_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_facebook']))
    {
        $this->nm_new_label['hotel_facebook'] = "Hotel Facebook:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_facebook = $this->hotel_facebook;
   if (!isset($this->nmgp_cmp_hidden['hotel_facebook']))
   {
       $this->nmgp_cmp_hidden['hotel_facebook'] = 'off';
   }
   $sStyleHidden_hotel_facebook = '';
   if (isset($this->nmgp_cmp_hidden['hotel_facebook']) && $this->nmgp_cmp_hidden['hotel_facebook'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_facebook']);
       $sStyleHidden_hotel_facebook = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_facebook = 'display: none;';
   $sStyleReadInp_hotel_facebook = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_facebook']) && $this->nmgp_cmp_readonly['hotel_facebook'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_facebook']);
       $sStyleReadLab_hotel_facebook = '';
       $sStyleReadInp_hotel_facebook = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_facebook']) && $this->nmgp_cmp_hidden['hotel_facebook'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_facebook" value="<?php echo $this->form_encode_input($hotel_facebook) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_facebook_label" id="hidden_field_label_hotel_facebook" style="<?php echo $sStyleHidden_hotel_facebook; ?>"><span id="id_label_hotel_facebook"><?php echo $this->nm_new_label['hotel_facebook']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_facebook_line" id="hidden_field_data_hotel_facebook" style="<?php echo $sStyleHidden_hotel_facebook; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_facebook_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_facebook"]) &&  $this->nmgp_cmp_readonly["hotel_facebook"] == "on") { 

 ?>
<input type="hidden" name="hotel_facebook" value="<?php echo $this->form_encode_input($hotel_facebook) . "\">" . $hotel_facebook . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_facebook" class="sc-ui-readonly-hotel_facebook css_hotel_facebook_line" style="<?php echo $sStyleReadLab_hotel_facebook; ?>"><?php echo $this->form_format_readonly("hotel_facebook", $this->form_encode_input($this->hotel_facebook)); ?></span><span id="id_read_off_hotel_facebook" class="css_read_off_hotel_facebook<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_facebook; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_facebook_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_facebook" type=text name="hotel_facebook" value="<?php echo $this->form_encode_input($hotel_facebook) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_facebook_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_facebook_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_twitter']))
    {
        $this->nm_new_label['hotel_twitter'] = "Hotel Twitter:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_twitter = $this->hotel_twitter;
   if (!isset($this->nmgp_cmp_hidden['hotel_twitter']))
   {
       $this->nmgp_cmp_hidden['hotel_twitter'] = 'off';
   }
   $sStyleHidden_hotel_twitter = '';
   if (isset($this->nmgp_cmp_hidden['hotel_twitter']) && $this->nmgp_cmp_hidden['hotel_twitter'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_twitter']);
       $sStyleHidden_hotel_twitter = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_twitter = 'display: none;';
   $sStyleReadInp_hotel_twitter = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_twitter']) && $this->nmgp_cmp_readonly['hotel_twitter'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_twitter']);
       $sStyleReadLab_hotel_twitter = '';
       $sStyleReadInp_hotel_twitter = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_twitter']) && $this->nmgp_cmp_hidden['hotel_twitter'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_twitter" value="<?php echo $this->form_encode_input($hotel_twitter) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_twitter_label" id="hidden_field_label_hotel_twitter" style="<?php echo $sStyleHidden_hotel_twitter; ?>"><span id="id_label_hotel_twitter"><?php echo $this->nm_new_label['hotel_twitter']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_twitter_line" id="hidden_field_data_hotel_twitter" style="<?php echo $sStyleHidden_hotel_twitter; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_twitter_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_twitter"]) &&  $this->nmgp_cmp_readonly["hotel_twitter"] == "on") { 

 ?>
<input type="hidden" name="hotel_twitter" value="<?php echo $this->form_encode_input($hotel_twitter) . "\">" . $hotel_twitter . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_twitter" class="sc-ui-readonly-hotel_twitter css_hotel_twitter_line" style="<?php echo $sStyleReadLab_hotel_twitter; ?>"><?php echo $this->form_format_readonly("hotel_twitter", $this->form_encode_input($this->hotel_twitter)); ?></span><span id="id_read_off_hotel_twitter" class="css_read_off_hotel_twitter<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_twitter; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_twitter_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_twitter" type=text name="hotel_twitter" value="<?php echo $this->form_encode_input($hotel_twitter) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_twitter_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_twitter_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_skype']))
    {
        $this->nm_new_label['hotel_skype'] = "Hotel Skype:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_skype = $this->hotel_skype;
   if (!isset($this->nmgp_cmp_hidden['hotel_skype']))
   {
       $this->nmgp_cmp_hidden['hotel_skype'] = 'off';
   }
   $sStyleHidden_hotel_skype = '';
   if (isset($this->nmgp_cmp_hidden['hotel_skype']) && $this->nmgp_cmp_hidden['hotel_skype'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_skype']);
       $sStyleHidden_hotel_skype = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_skype = 'display: none;';
   $sStyleReadInp_hotel_skype = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_skype']) && $this->nmgp_cmp_readonly['hotel_skype'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_skype']);
       $sStyleReadLab_hotel_skype = '';
       $sStyleReadInp_hotel_skype = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_skype']) && $this->nmgp_cmp_hidden['hotel_skype'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_skype" value="<?php echo $this->form_encode_input($hotel_skype) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_skype_label" id="hidden_field_label_hotel_skype" style="<?php echo $sStyleHidden_hotel_skype; ?>"><span id="id_label_hotel_skype"><?php echo $this->nm_new_label['hotel_skype']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_skype_line" id="hidden_field_data_hotel_skype" style="<?php echo $sStyleHidden_hotel_skype; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_skype_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_skype"]) &&  $this->nmgp_cmp_readonly["hotel_skype"] == "on") { 

 ?>
<input type="hidden" name="hotel_skype" value="<?php echo $this->form_encode_input($hotel_skype) . "\">" . $hotel_skype . ""; ?>
<?php } else { ?>
<span id="id_read_on_hotel_skype" class="sc-ui-readonly-hotel_skype css_hotel_skype_line" style="<?php echo $sStyleReadLab_hotel_skype; ?>"><?php echo $this->form_format_readonly("hotel_skype", $this->form_encode_input($this->hotel_skype)); ?></span><span id="id_read_off_hotel_skype" class="css_read_off_hotel_skype<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_hotel_skype; ?>">
 <input class="sc-js-input scFormObjectOdd css_hotel_skype_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_hotel_skype" type=text name="hotel_skype" value="<?php echo $this->form_encode_input($hotel_skype) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=50"; } ?> maxlength=50 alt="{datatype: 'text', maxLength: 50, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: true, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_skype_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_skype_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['hotel_ar_condicionado']))
    {
        $this->nm_new_label['hotel_ar_condicionado'] = "Ar Condicionado:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_ar_condicionado = $this->hotel_ar_condicionado;
   $sStyleHidden_hotel_ar_condicionado = '';
   if (isset($this->nmgp_cmp_hidden['hotel_ar_condicionado']) && $this->nmgp_cmp_hidden['hotel_ar_condicionado'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_ar_condicionado']);
       $sStyleHidden_hotel_ar_condicionado = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_ar_condicionado = 'display: none;';
   $sStyleReadInp_hotel_ar_condicionado = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_ar_condicionado']) && $this->nmgp_cmp_readonly['hotel_ar_condicionado'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_ar_condicionado']);
       $sStyleReadLab_hotel_ar_condicionado = '';
       $sStyleReadInp_hotel_ar_condicionado = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_ar_condicionado']) && $this->nmgp_cmp_hidden['hotel_ar_condicionado'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_ar_condicionado" value="<?php echo $this->form_encode_input($hotel_ar_condicionado) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_ar_condicionado_label" id="hidden_field_label_hotel_ar_condicionado" style="<?php echo $sStyleHidden_hotel_ar_condicionado; ?>"><span id="id_label_hotel_ar_condicionado"><?php echo $this->nm_new_label['hotel_ar_condicionado']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_ar_condicionado_line" id="hidden_field_data_hotel_ar_condicionado" style="<?php echo $sStyleHidden_hotel_ar_condicionado; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_ar_condicionado_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_ar_condicionado"]) &&  $this->nmgp_cmp_readonly["hotel_ar_condicionado"] == "on") { 

 if ("Y" == $this->hotel_ar_condicionado) { $hotel_ar_condicionado_look = "Sim";} 
 if ("N" == $this->hotel_ar_condicionado) { $hotel_ar_condicionado_look = "Não";} 
?>
<input type="hidden" name="hotel_ar_condicionado" value="<?php echo $this->form_encode_input($hotel_ar_condicionado) . "\">" . $hotel_ar_condicionado_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_ar_condicionado) { $hotel_ar_condicionado_look = "Sim";} 
 if ("N" == $this->hotel_ar_condicionado) { $hotel_ar_condicionado_look = "Não";} 
?>
<span id="id_read_on_hotel_ar_condicionado"  class="css_hotel_ar_condicionado_line" style="<?php echo $sStyleReadLab_hotel_ar_condicionado; ?>"><?php echo $this->form_format_readonly("hotel_ar_condicionado", $this->form_encode_input($hotel_ar_condicionado_look)); ?></span><span id="id_read_off_hotel_ar_condicionado" class="css_read_off_hotel_ar_condicionado css_hotel_ar_condicionado_line" style="<?php echo $sStyleReadInp_hotel_ar_condicionado; ?>"><div id="idAjaxRadio_hotel_ar_condicionado" style="display: inline-block"  class="css_hotel_ar_condicionado_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_ar_condicionado_line"><?php $tempOptionId = "id-opt-hotel_ar_condicionado" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_ar_condicionado sc-ui-radio-hotel_ar_condicionado" type=radio name="hotel_ar_condicionado" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ar_condicionado'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_ar_condicionado)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_ar_condicionado_line"><?php $tempOptionId = "id-opt-hotel_ar_condicionado" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_ar_condicionado sc-ui-radio-hotel_ar_condicionado" type=radio name="hotel_ar_condicionado" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ar_condicionado'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_ar_condicionado)  { echo " checked" ;} ?><?php  if (empty($this->hotel_ar_condicionado)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_ar_condicionado_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_ar_condicionado_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['hotel_frigobar']))
    {
        $this->nm_new_label['hotel_frigobar'] = "Frigobar:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_frigobar = $this->hotel_frigobar;
   $sStyleHidden_hotel_frigobar = '';
   if (isset($this->nmgp_cmp_hidden['hotel_frigobar']) && $this->nmgp_cmp_hidden['hotel_frigobar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_frigobar']);
       $sStyleHidden_hotel_frigobar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_frigobar = 'display: none;';
   $sStyleReadInp_hotel_frigobar = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_frigobar']) && $this->nmgp_cmp_readonly['hotel_frigobar'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_frigobar']);
       $sStyleReadLab_hotel_frigobar = '';
       $sStyleReadInp_hotel_frigobar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_frigobar']) && $this->nmgp_cmp_hidden['hotel_frigobar'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_frigobar" value="<?php echo $this->form_encode_input($hotel_frigobar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_frigobar_label" id="hidden_field_label_hotel_frigobar" style="<?php echo $sStyleHidden_hotel_frigobar; ?>"><span id="id_label_hotel_frigobar"><?php echo $this->nm_new_label['hotel_frigobar']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_frigobar_line" id="hidden_field_data_hotel_frigobar" style="<?php echo $sStyleHidden_hotel_frigobar; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_frigobar_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_frigobar"]) &&  $this->nmgp_cmp_readonly["hotel_frigobar"] == "on") { 

 if ("Y" == $this->hotel_frigobar) { $hotel_frigobar_look = "Sim";} 
 if ("N" == $this->hotel_frigobar) { $hotel_frigobar_look = "Não";} 
?>
<input type="hidden" name="hotel_frigobar" value="<?php echo $this->form_encode_input($hotel_frigobar) . "\">" . $hotel_frigobar_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_frigobar) { $hotel_frigobar_look = "Sim";} 
 if ("N" == $this->hotel_frigobar) { $hotel_frigobar_look = "Não";} 
?>
<span id="id_read_on_hotel_frigobar"  class="css_hotel_frigobar_line" style="<?php echo $sStyleReadLab_hotel_frigobar; ?>"><?php echo $this->form_format_readonly("hotel_frigobar", $this->form_encode_input($hotel_frigobar_look)); ?></span><span id="id_read_off_hotel_frigobar" class="css_read_off_hotel_frigobar css_hotel_frigobar_line" style="<?php echo $sStyleReadInp_hotel_frigobar; ?>"><div id="idAjaxRadio_hotel_frigobar" style="display: inline-block"  class="css_hotel_frigobar_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_frigobar_line"><?php $tempOptionId = "id-opt-hotel_frigobar" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_frigobar sc-ui-radio-hotel_frigobar" type=radio name="hotel_frigobar" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_frigobar'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_frigobar)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_frigobar_line"><?php $tempOptionId = "id-opt-hotel_frigobar" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_frigobar sc-ui-radio-hotel_frigobar" type=radio name="hotel_frigobar" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_frigobar'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_frigobar)  { echo " checked" ;} ?><?php  if (empty($this->hotel_frigobar)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_frigobar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_frigobar_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_lavanderia']))
    {
        $this->nm_new_label['hotel_lavanderia'] = "Lavanderia:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_lavanderia = $this->hotel_lavanderia;
   $sStyleHidden_hotel_lavanderia = '';
   if (isset($this->nmgp_cmp_hidden['hotel_lavanderia']) && $this->nmgp_cmp_hidden['hotel_lavanderia'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_lavanderia']);
       $sStyleHidden_hotel_lavanderia = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_lavanderia = 'display: none;';
   $sStyleReadInp_hotel_lavanderia = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_lavanderia']) && $this->nmgp_cmp_readonly['hotel_lavanderia'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_lavanderia']);
       $sStyleReadLab_hotel_lavanderia = '';
       $sStyleReadInp_hotel_lavanderia = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_lavanderia']) && $this->nmgp_cmp_hidden['hotel_lavanderia'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_lavanderia" value="<?php echo $this->form_encode_input($hotel_lavanderia) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_lavanderia_label" id="hidden_field_label_hotel_lavanderia" style="<?php echo $sStyleHidden_hotel_lavanderia; ?>"><span id="id_label_hotel_lavanderia"><?php echo $this->nm_new_label['hotel_lavanderia']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_lavanderia_line" id="hidden_field_data_hotel_lavanderia" style="<?php echo $sStyleHidden_hotel_lavanderia; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_lavanderia_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_lavanderia"]) &&  $this->nmgp_cmp_readonly["hotel_lavanderia"] == "on") { 

 if ("Y" == $this->hotel_lavanderia) { $hotel_lavanderia_look = "Sim";} 
 if ("N" == $this->hotel_lavanderia) { $hotel_lavanderia_look = "Não";} 
?>
<input type="hidden" name="hotel_lavanderia" value="<?php echo $this->form_encode_input($hotel_lavanderia) . "\">" . $hotel_lavanderia_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_lavanderia) { $hotel_lavanderia_look = "Sim";} 
 if ("N" == $this->hotel_lavanderia) { $hotel_lavanderia_look = "Não";} 
?>
<span id="id_read_on_hotel_lavanderia"  class="css_hotel_lavanderia_line" style="<?php echo $sStyleReadLab_hotel_lavanderia; ?>"><?php echo $this->form_format_readonly("hotel_lavanderia", $this->form_encode_input($hotel_lavanderia_look)); ?></span><span id="id_read_off_hotel_lavanderia" class="css_read_off_hotel_lavanderia css_hotel_lavanderia_line" style="<?php echo $sStyleReadInp_hotel_lavanderia; ?>"><div id="idAjaxRadio_hotel_lavanderia" style="display: inline-block"  class="css_hotel_lavanderia_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_lavanderia_line"><?php $tempOptionId = "id-opt-hotel_lavanderia" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_lavanderia sc-ui-radio-hotel_lavanderia" type=radio name="hotel_lavanderia" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_lavanderia'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_lavanderia)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_lavanderia_line"><?php $tempOptionId = "id-opt-hotel_lavanderia" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_lavanderia sc-ui-radio-hotel_lavanderia" type=radio name="hotel_lavanderia" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_lavanderia'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_lavanderia)  { echo " checked" ;} ?><?php  if (empty($this->hotel_lavanderia)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_lavanderia_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_lavanderia_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['hotel_telefone_quarto']))
    {
        $this->nm_new_label['hotel_telefone_quarto'] = "Telefone Quarto:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_telefone_quarto = $this->hotel_telefone_quarto;
   $sStyleHidden_hotel_telefone_quarto = '';
   if (isset($this->nmgp_cmp_hidden['hotel_telefone_quarto']) && $this->nmgp_cmp_hidden['hotel_telefone_quarto'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_telefone_quarto']);
       $sStyleHidden_hotel_telefone_quarto = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_telefone_quarto = 'display: none;';
   $sStyleReadInp_hotel_telefone_quarto = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_telefone_quarto']) && $this->nmgp_cmp_readonly['hotel_telefone_quarto'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_telefone_quarto']);
       $sStyleReadLab_hotel_telefone_quarto = '';
       $sStyleReadInp_hotel_telefone_quarto = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_telefone_quarto']) && $this->nmgp_cmp_hidden['hotel_telefone_quarto'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_telefone_quarto" value="<?php echo $this->form_encode_input($hotel_telefone_quarto) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_telefone_quarto_label" id="hidden_field_label_hotel_telefone_quarto" style="<?php echo $sStyleHidden_hotel_telefone_quarto; ?>"><span id="id_label_hotel_telefone_quarto"><?php echo $this->nm_new_label['hotel_telefone_quarto']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_telefone_quarto_line" id="hidden_field_data_hotel_telefone_quarto" style="<?php echo $sStyleHidden_hotel_telefone_quarto; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_telefone_quarto_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_telefone_quarto"]) &&  $this->nmgp_cmp_readonly["hotel_telefone_quarto"] == "on") { 

 if ("Y" == $this->hotel_telefone_quarto) { $hotel_telefone_quarto_look = "Sim";} 
 if ("N" == $this->hotel_telefone_quarto) { $hotel_telefone_quarto_look = "Não";} 
?>
<input type="hidden" name="hotel_telefone_quarto" value="<?php echo $this->form_encode_input($hotel_telefone_quarto) . "\">" . $hotel_telefone_quarto_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_telefone_quarto) { $hotel_telefone_quarto_look = "Sim";} 
 if ("N" == $this->hotel_telefone_quarto) { $hotel_telefone_quarto_look = "Não";} 
?>
<span id="id_read_on_hotel_telefone_quarto"  class="css_hotel_telefone_quarto_line" style="<?php echo $sStyleReadLab_hotel_telefone_quarto; ?>"><?php echo $this->form_format_readonly("hotel_telefone_quarto", $this->form_encode_input($hotel_telefone_quarto_look)); ?></span><span id="id_read_off_hotel_telefone_quarto" class="css_read_off_hotel_telefone_quarto css_hotel_telefone_quarto_line" style="<?php echo $sStyleReadInp_hotel_telefone_quarto; ?>"><div id="idAjaxRadio_hotel_telefone_quarto" style="display: inline-block"  class="css_hotel_telefone_quarto_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_telefone_quarto_line"><?php $tempOptionId = "id-opt-hotel_telefone_quarto" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_telefone_quarto sc-ui-radio-hotel_telefone_quarto" type=radio name="hotel_telefone_quarto" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_telefone_quarto'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_telefone_quarto)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_telefone_quarto_line"><?php $tempOptionId = "id-opt-hotel_telefone_quarto" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_telefone_quarto sc-ui-radio-hotel_telefone_quarto" type=radio name="hotel_telefone_quarto" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_telefone_quarto'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_telefone_quarto)  { echo " checked" ;} ?><?php  if (empty($this->hotel_telefone_quarto)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_telefone_quarto_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_telefone_quarto_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_tv']))
    {
        $this->nm_new_label['hotel_tv'] = "TV:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_tv = $this->hotel_tv;
   $sStyleHidden_hotel_tv = '';
   if (isset($this->nmgp_cmp_hidden['hotel_tv']) && $this->nmgp_cmp_hidden['hotel_tv'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_tv']);
       $sStyleHidden_hotel_tv = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_tv = 'display: none;';
   $sStyleReadInp_hotel_tv = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_tv']) && $this->nmgp_cmp_readonly['hotel_tv'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_tv']);
       $sStyleReadLab_hotel_tv = '';
       $sStyleReadInp_hotel_tv = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_tv']) && $this->nmgp_cmp_hidden['hotel_tv'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_tv" value="<?php echo $this->form_encode_input($hotel_tv) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_tv_label" id="hidden_field_label_hotel_tv" style="<?php echo $sStyleHidden_hotel_tv; ?>"><span id="id_label_hotel_tv"><?php echo $this->nm_new_label['hotel_tv']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_tv_line" id="hidden_field_data_hotel_tv" style="<?php echo $sStyleHidden_hotel_tv; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_tv_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_tv"]) &&  $this->nmgp_cmp_readonly["hotel_tv"] == "on") { 

 if ("Y" == $this->hotel_tv) { $hotel_tv_look = "Sim";} 
 if ("N" == $this->hotel_tv) { $hotel_tv_look = "Não";} 
?>
<input type="hidden" name="hotel_tv" value="<?php echo $this->form_encode_input($hotel_tv) . "\">" . $hotel_tv_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_tv) { $hotel_tv_look = "Sim";} 
 if ("N" == $this->hotel_tv) { $hotel_tv_look = "Não";} 
?>
<span id="id_read_on_hotel_tv"  class="css_hotel_tv_line" style="<?php echo $sStyleReadLab_hotel_tv; ?>"><?php echo $this->form_format_readonly("hotel_tv", $this->form_encode_input($hotel_tv_look)); ?></span><span id="id_read_off_hotel_tv" class="css_read_off_hotel_tv css_hotel_tv_line" style="<?php echo $sStyleReadInp_hotel_tv; ?>"><div id="idAjaxRadio_hotel_tv" style="display: inline-block"  class="css_hotel_tv_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_tv_line"><?php $tempOptionId = "id-opt-hotel_tv" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_tv sc-ui-radio-hotel_tv" type=radio name="hotel_tv" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_tv'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_tv)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_tv_line"><?php $tempOptionId = "id-opt-hotel_tv" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_tv sc-ui-radio-hotel_tv" type=radio name="hotel_tv" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_tv'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_tv)  { echo " checked" ;} ?><?php  if (empty($this->hotel_tv)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_tv_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_tv_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['hotel_ginastica']))
    {
        $this->nm_new_label['hotel_ginastica'] = "Sala Ginática:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_ginastica = $this->hotel_ginastica;
   $sStyleHidden_hotel_ginastica = '';
   if (isset($this->nmgp_cmp_hidden['hotel_ginastica']) && $this->nmgp_cmp_hidden['hotel_ginastica'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_ginastica']);
       $sStyleHidden_hotel_ginastica = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_ginastica = 'display: none;';
   $sStyleReadInp_hotel_ginastica = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_ginastica']) && $this->nmgp_cmp_readonly['hotel_ginastica'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_ginastica']);
       $sStyleReadLab_hotel_ginastica = '';
       $sStyleReadInp_hotel_ginastica = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_ginastica']) && $this->nmgp_cmp_hidden['hotel_ginastica'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_ginastica" value="<?php echo $this->form_encode_input($hotel_ginastica) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_ginastica_label" id="hidden_field_label_hotel_ginastica" style="<?php echo $sStyleHidden_hotel_ginastica; ?>"><span id="id_label_hotel_ginastica"><?php echo $this->nm_new_label['hotel_ginastica']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_ginastica_line" id="hidden_field_data_hotel_ginastica" style="<?php echo $sStyleHidden_hotel_ginastica; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_ginastica_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_ginastica"]) &&  $this->nmgp_cmp_readonly["hotel_ginastica"] == "on") { 

 if ("Y" == $this->hotel_ginastica) { $hotel_ginastica_look = "Sim";} 
 if ("N" == $this->hotel_ginastica) { $hotel_ginastica_look = "Não";} 
?>
<input type="hidden" name="hotel_ginastica" value="<?php echo $this->form_encode_input($hotel_ginastica) . "\">" . $hotel_ginastica_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_ginastica) { $hotel_ginastica_look = "Sim";} 
 if ("N" == $this->hotel_ginastica) { $hotel_ginastica_look = "Não";} 
?>
<span id="id_read_on_hotel_ginastica"  class="css_hotel_ginastica_line" style="<?php echo $sStyleReadLab_hotel_ginastica; ?>"><?php echo $this->form_format_readonly("hotel_ginastica", $this->form_encode_input($hotel_ginastica_look)); ?></span><span id="id_read_off_hotel_ginastica" class="css_read_off_hotel_ginastica css_hotel_ginastica_line" style="<?php echo $sStyleReadInp_hotel_ginastica; ?>"><div id="idAjaxRadio_hotel_ginastica" style="display: inline-block"  class="css_hotel_ginastica_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_ginastica_line"><?php $tempOptionId = "id-opt-hotel_ginastica" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_ginastica sc-ui-radio-hotel_ginastica" type=radio name="hotel_ginastica" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ginastica'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_ginastica)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_ginastica_line"><?php $tempOptionId = "id-opt-hotel_ginastica" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_ginastica sc-ui-radio-hotel_ginastica" type=radio name="hotel_ginastica" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_ginastica'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_ginastica)  { echo " checked" ;} ?><?php  if (empty($this->hotel_ginastica)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_ginastica_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_ginastica_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_restaurante']))
    {
        $this->nm_new_label['hotel_restaurante'] = "Restaurante:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_restaurante = $this->hotel_restaurante;
   $sStyleHidden_hotel_restaurante = '';
   if (isset($this->nmgp_cmp_hidden['hotel_restaurante']) && $this->nmgp_cmp_hidden['hotel_restaurante'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_restaurante']);
       $sStyleHidden_hotel_restaurante = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_restaurante = 'display: none;';
   $sStyleReadInp_hotel_restaurante = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_restaurante']) && $this->nmgp_cmp_readonly['hotel_restaurante'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_restaurante']);
       $sStyleReadLab_hotel_restaurante = '';
       $sStyleReadInp_hotel_restaurante = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_restaurante']) && $this->nmgp_cmp_hidden['hotel_restaurante'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_restaurante" value="<?php echo $this->form_encode_input($hotel_restaurante) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_restaurante_label" id="hidden_field_label_hotel_restaurante" style="<?php echo $sStyleHidden_hotel_restaurante; ?>"><span id="id_label_hotel_restaurante"><?php echo $this->nm_new_label['hotel_restaurante']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_restaurante_line" id="hidden_field_data_hotel_restaurante" style="<?php echo $sStyleHidden_hotel_restaurante; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_restaurante_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_restaurante"]) &&  $this->nmgp_cmp_readonly["hotel_restaurante"] == "on") { 

 if ("Y" == $this->hotel_restaurante) { $hotel_restaurante_look = "Sim";} 
 if ("N" == $this->hotel_restaurante) { $hotel_restaurante_look = "Não";} 
?>
<input type="hidden" name="hotel_restaurante" value="<?php echo $this->form_encode_input($hotel_restaurante) . "\">" . $hotel_restaurante_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_restaurante) { $hotel_restaurante_look = "Sim";} 
 if ("N" == $this->hotel_restaurante) { $hotel_restaurante_look = "Não";} 
?>
<span id="id_read_on_hotel_restaurante"  class="css_hotel_restaurante_line" style="<?php echo $sStyleReadLab_hotel_restaurante; ?>"><?php echo $this->form_format_readonly("hotel_restaurante", $this->form_encode_input($hotel_restaurante_look)); ?></span><span id="id_read_off_hotel_restaurante" class="css_read_off_hotel_restaurante css_hotel_restaurante_line" style="<?php echo $sStyleReadInp_hotel_restaurante; ?>"><div id="idAjaxRadio_hotel_restaurante" style="display: inline-block"  class="css_hotel_restaurante_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_restaurante_line"><?php $tempOptionId = "id-opt-hotel_restaurante" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_restaurante sc-ui-radio-hotel_restaurante" type=radio name="hotel_restaurante" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_restaurante'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_restaurante)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_restaurante_line"><?php $tempOptionId = "id-opt-hotel_restaurante" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_restaurante sc-ui-radio-hotel_restaurante" type=radio name="hotel_restaurante" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_restaurante'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_restaurante)  { echo " checked" ;} ?><?php  if (empty($this->hotel_restaurante)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_restaurante_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_restaurante_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['hotel_bar']))
    {
        $this->nm_new_label['hotel_bar'] = "Bar:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_bar = $this->hotel_bar;
   $sStyleHidden_hotel_bar = '';
   if (isset($this->nmgp_cmp_hidden['hotel_bar']) && $this->nmgp_cmp_hidden['hotel_bar'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_bar']);
       $sStyleHidden_hotel_bar = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_bar = 'display: none;';
   $sStyleReadInp_hotel_bar = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_bar']) && $this->nmgp_cmp_readonly['hotel_bar'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_bar']);
       $sStyleReadLab_hotel_bar = '';
       $sStyleReadInp_hotel_bar = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_bar']) && $this->nmgp_cmp_hidden['hotel_bar'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_bar" value="<?php echo $this->form_encode_input($hotel_bar) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_bar_label" id="hidden_field_label_hotel_bar" style="<?php echo $sStyleHidden_hotel_bar; ?>"><span id="id_label_hotel_bar"><?php echo $this->nm_new_label['hotel_bar']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_bar_line" id="hidden_field_data_hotel_bar" style="<?php echo $sStyleHidden_hotel_bar; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_bar_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_bar"]) &&  $this->nmgp_cmp_readonly["hotel_bar"] == "on") { 

 if ("Y" == $this->hotel_bar) { $hotel_bar_look = "Sim";} 
 if ("N" == $this->hotel_bar) { $hotel_bar_look = "Não";} 
?>
<input type="hidden" name="hotel_bar" value="<?php echo $this->form_encode_input($hotel_bar) . "\">" . $hotel_bar_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_bar) { $hotel_bar_look = "Sim";} 
 if ("N" == $this->hotel_bar) { $hotel_bar_look = "Não";} 
?>
<span id="id_read_on_hotel_bar"  class="css_hotel_bar_line" style="<?php echo $sStyleReadLab_hotel_bar; ?>"><?php echo $this->form_format_readonly("hotel_bar", $this->form_encode_input($hotel_bar_look)); ?></span><span id="id_read_off_hotel_bar" class="css_read_off_hotel_bar css_hotel_bar_line" style="<?php echo $sStyleReadInp_hotel_bar; ?>"><div id="idAjaxRadio_hotel_bar" style="display: inline-block"  class="css_hotel_bar_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_bar_line"><?php $tempOptionId = "id-opt-hotel_bar" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_bar sc-ui-radio-hotel_bar" type=radio name="hotel_bar" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_bar'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_bar)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_bar_line"><?php $tempOptionId = "id-opt-hotel_bar" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_bar sc-ui-radio-hotel_bar" type=radio name="hotel_bar" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_bar'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_bar)  { echo " checked" ;} ?><?php  if (empty($this->hotel_bar)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_bar_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_bar_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_estacionamento']))
    {
        $this->nm_new_label['hotel_estacionamento'] = "Estacionamento:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_estacionamento = $this->hotel_estacionamento;
   $sStyleHidden_hotel_estacionamento = '';
   if (isset($this->nmgp_cmp_hidden['hotel_estacionamento']) && $this->nmgp_cmp_hidden['hotel_estacionamento'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_estacionamento']);
       $sStyleHidden_hotel_estacionamento = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_estacionamento = 'display: none;';
   $sStyleReadInp_hotel_estacionamento = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_estacionamento']) && $this->nmgp_cmp_readonly['hotel_estacionamento'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_estacionamento']);
       $sStyleReadLab_hotel_estacionamento = '';
       $sStyleReadInp_hotel_estacionamento = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_estacionamento']) && $this->nmgp_cmp_hidden['hotel_estacionamento'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_estacionamento" value="<?php echo $this->form_encode_input($hotel_estacionamento) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_estacionamento_label" id="hidden_field_label_hotel_estacionamento" style="<?php echo $sStyleHidden_hotel_estacionamento; ?>"><span id="id_label_hotel_estacionamento"><?php echo $this->nm_new_label['hotel_estacionamento']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_estacionamento_line" id="hidden_field_data_hotel_estacionamento" style="<?php echo $sStyleHidden_hotel_estacionamento; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_estacionamento_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_estacionamento"]) &&  $this->nmgp_cmp_readonly["hotel_estacionamento"] == "on") { 

 if ("Y" == $this->hotel_estacionamento) { $hotel_estacionamento_look = "Sim";} 
 if ("N" == $this->hotel_estacionamento) { $hotel_estacionamento_look = "Não";} 
?>
<input type="hidden" name="hotel_estacionamento" value="<?php echo $this->form_encode_input($hotel_estacionamento) . "\">" . $hotel_estacionamento_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_estacionamento) { $hotel_estacionamento_look = "Sim";} 
 if ("N" == $this->hotel_estacionamento) { $hotel_estacionamento_look = "Não";} 
?>
<span id="id_read_on_hotel_estacionamento"  class="css_hotel_estacionamento_line" style="<?php echo $sStyleReadLab_hotel_estacionamento; ?>"><?php echo $this->form_format_readonly("hotel_estacionamento", $this->form_encode_input($hotel_estacionamento_look)); ?></span><span id="id_read_off_hotel_estacionamento" class="css_read_off_hotel_estacionamento css_hotel_estacionamento_line" style="<?php echo $sStyleReadInp_hotel_estacionamento; ?>"><div id="idAjaxRadio_hotel_estacionamento" style="display: inline-block"  class="css_hotel_estacionamento_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_estacionamento_line"><?php $tempOptionId = "id-opt-hotel_estacionamento" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_estacionamento sc-ui-radio-hotel_estacionamento" type=radio name="hotel_estacionamento" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_estacionamento'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_estacionamento)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_estacionamento_line"><?php $tempOptionId = "id-opt-hotel_estacionamento" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_estacionamento sc-ui-radio-hotel_estacionamento" type=radio name="hotel_estacionamento" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_estacionamento'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_estacionamento)  { echo " checked" ;} ?><?php  if (empty($this->hotel_estacionamento)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_estacionamento_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_estacionamento_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['hotel_sauna']))
    {
        $this->nm_new_label['hotel_sauna'] = "Sauna:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_sauna = $this->hotel_sauna;
   $sStyleHidden_hotel_sauna = '';
   if (isset($this->nmgp_cmp_hidden['hotel_sauna']) && $this->nmgp_cmp_hidden['hotel_sauna'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_sauna']);
       $sStyleHidden_hotel_sauna = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_sauna = 'display: none;';
   $sStyleReadInp_hotel_sauna = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_sauna']) && $this->nmgp_cmp_readonly['hotel_sauna'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_sauna']);
       $sStyleReadLab_hotel_sauna = '';
       $sStyleReadInp_hotel_sauna = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_sauna']) && $this->nmgp_cmp_hidden['hotel_sauna'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_sauna" value="<?php echo $this->form_encode_input($hotel_sauna) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_sauna_label" id="hidden_field_label_hotel_sauna" style="<?php echo $sStyleHidden_hotel_sauna; ?>"><span id="id_label_hotel_sauna"><?php echo $this->nm_new_label['hotel_sauna']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_sauna_line" id="hidden_field_data_hotel_sauna" style="<?php echo $sStyleHidden_hotel_sauna; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_sauna_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_sauna"]) &&  $this->nmgp_cmp_readonly["hotel_sauna"] == "on") { 

 if ("Y" == $this->hotel_sauna) { $hotel_sauna_look = "Sim";} 
 if ("N" == $this->hotel_sauna) { $hotel_sauna_look = "Não";} 
?>
<input type="hidden" name="hotel_sauna" value="<?php echo $this->form_encode_input($hotel_sauna) . "\">" . $hotel_sauna_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_sauna) { $hotel_sauna_look = "Sim";} 
 if ("N" == $this->hotel_sauna) { $hotel_sauna_look = "Não";} 
?>
<span id="id_read_on_hotel_sauna"  class="css_hotel_sauna_line" style="<?php echo $sStyleReadLab_hotel_sauna; ?>"><?php echo $this->form_format_readonly("hotel_sauna", $this->form_encode_input($hotel_sauna_look)); ?></span><span id="id_read_off_hotel_sauna" class="css_read_off_hotel_sauna css_hotel_sauna_line" style="<?php echo $sStyleReadInp_hotel_sauna; ?>"><div id="idAjaxRadio_hotel_sauna" style="display: inline-block"  class="css_hotel_sauna_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_sauna_line"><?php $tempOptionId = "id-opt-hotel_sauna" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_sauna sc-ui-radio-hotel_sauna" type=radio name="hotel_sauna" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_sauna'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_sauna)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_sauna_line"><?php $tempOptionId = "id-opt-hotel_sauna" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_sauna sc-ui-radio-hotel_sauna" type=radio name="hotel_sauna" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_sauna'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_sauna)  { echo " checked" ;} ?><?php  if (empty($this->hotel_sauna)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_sauna_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_sauna_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_piscina']))
    {
        $this->nm_new_label['hotel_piscina'] = "Piscina:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_piscina = $this->hotel_piscina;
   $sStyleHidden_hotel_piscina = '';
   if (isset($this->nmgp_cmp_hidden['hotel_piscina']) && $this->nmgp_cmp_hidden['hotel_piscina'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_piscina']);
       $sStyleHidden_hotel_piscina = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_piscina = 'display: none;';
   $sStyleReadInp_hotel_piscina = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_piscina']) && $this->nmgp_cmp_readonly['hotel_piscina'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_piscina']);
       $sStyleReadLab_hotel_piscina = '';
       $sStyleReadInp_hotel_piscina = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_piscina']) && $this->nmgp_cmp_hidden['hotel_piscina'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_piscina" value="<?php echo $this->form_encode_input($hotel_piscina) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_piscina_label" id="hidden_field_label_hotel_piscina" style="<?php echo $sStyleHidden_hotel_piscina; ?>"><span id="id_label_hotel_piscina"><?php echo $this->nm_new_label['hotel_piscina']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_piscina_line" id="hidden_field_data_hotel_piscina" style="<?php echo $sStyleHidden_hotel_piscina; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_piscina_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_piscina"]) &&  $this->nmgp_cmp_readonly["hotel_piscina"] == "on") { 

 if ("Y" == $this->hotel_piscina) { $hotel_piscina_look = "Sim";} 
 if ("N" == $this->hotel_piscina) { $hotel_piscina_look = "Não";} 
?>
<input type="hidden" name="hotel_piscina" value="<?php echo $this->form_encode_input($hotel_piscina) . "\">" . $hotel_piscina_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_piscina) { $hotel_piscina_look = "Sim";} 
 if ("N" == $this->hotel_piscina) { $hotel_piscina_look = "Não";} 
?>
<span id="id_read_on_hotel_piscina"  class="css_hotel_piscina_line" style="<?php echo $sStyleReadLab_hotel_piscina; ?>"><?php echo $this->form_format_readonly("hotel_piscina", $this->form_encode_input($hotel_piscina_look)); ?></span><span id="id_read_off_hotel_piscina" class="css_read_off_hotel_piscina css_hotel_piscina_line" style="<?php echo $sStyleReadInp_hotel_piscina; ?>"><div id="idAjaxRadio_hotel_piscina" style="display: inline-block"  class="css_hotel_piscina_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_piscina_line"><?php $tempOptionId = "id-opt-hotel_piscina" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_piscina sc-ui-radio-hotel_piscina" type=radio name="hotel_piscina" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_piscina'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_piscina)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_piscina_line"><?php $tempOptionId = "id-opt-hotel_piscina" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_piscina sc-ui-radio-hotel_piscina" type=radio name="hotel_piscina" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_piscina'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_piscina)  { echo " checked" ;} ?><?php  if (empty($this->hotel_piscina)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_piscina_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_piscina_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['hotel_wifi']))
    {
        $this->nm_new_label['hotel_wifi'] = "Wifi:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_wifi = $this->hotel_wifi;
   $sStyleHidden_hotel_wifi = '';
   if (isset($this->nmgp_cmp_hidden['hotel_wifi']) && $this->nmgp_cmp_hidden['hotel_wifi'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_wifi']);
       $sStyleHidden_hotel_wifi = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_wifi = 'display: none;';
   $sStyleReadInp_hotel_wifi = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_wifi']) && $this->nmgp_cmp_readonly['hotel_wifi'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_wifi']);
       $sStyleReadLab_hotel_wifi = '';
       $sStyleReadInp_hotel_wifi = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_wifi']) && $this->nmgp_cmp_hidden['hotel_wifi'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_wifi" value="<?php echo $this->form_encode_input($hotel_wifi) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_wifi_label" id="hidden_field_label_hotel_wifi" style="<?php echo $sStyleHidden_hotel_wifi; ?>"><span id="id_label_hotel_wifi"><?php echo $this->nm_new_label['hotel_wifi']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_wifi_line" id="hidden_field_data_hotel_wifi" style="<?php echo $sStyleHidden_hotel_wifi; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_wifi_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_wifi"]) &&  $this->nmgp_cmp_readonly["hotel_wifi"] == "on") { 

 if ("Y" == $this->hotel_wifi) { $hotel_wifi_look = "Sim";} 
 if ("N" == $this->hotel_wifi) { $hotel_wifi_look = "Não";} 
?>
<input type="hidden" name="hotel_wifi" value="<?php echo $this->form_encode_input($hotel_wifi) . "\">" . $hotel_wifi_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_wifi) { $hotel_wifi_look = "Sim";} 
 if ("N" == $this->hotel_wifi) { $hotel_wifi_look = "Não";} 
?>
<span id="id_read_on_hotel_wifi"  class="css_hotel_wifi_line" style="<?php echo $sStyleReadLab_hotel_wifi; ?>"><?php echo $this->form_format_readonly("hotel_wifi", $this->form_encode_input($hotel_wifi_look)); ?></span><span id="id_read_off_hotel_wifi" class="css_read_off_hotel_wifi css_hotel_wifi_line" style="<?php echo $sStyleReadInp_hotel_wifi; ?>"><div id="idAjaxRadio_hotel_wifi" style="display: inline-block"  class="css_hotel_wifi_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_wifi_line"><?php $tempOptionId = "id-opt-hotel_wifi" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_wifi sc-ui-radio-hotel_wifi" type=radio name="hotel_wifi" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_wifi'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_wifi)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_wifi_line"><?php $tempOptionId = "id-opt-hotel_wifi" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_wifi sc-ui-radio-hotel_wifi" type=radio name="hotel_wifi" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_wifi'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_wifi)  { echo " checked" ;} ?><?php  if (empty($this->hotel_wifi)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_wifi_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_wifi_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['hotel_computador']))
    {
        $this->nm_new_label['hotel_computador'] = "Computadores:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_computador = $this->hotel_computador;
   $sStyleHidden_hotel_computador = '';
   if (isset($this->nmgp_cmp_hidden['hotel_computador']) && $this->nmgp_cmp_hidden['hotel_computador'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_computador']);
       $sStyleHidden_hotel_computador = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_computador = 'display: none;';
   $sStyleReadInp_hotel_computador = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_computador']) && $this->nmgp_cmp_readonly['hotel_computador'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_computador']);
       $sStyleReadLab_hotel_computador = '';
       $sStyleReadInp_hotel_computador = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_computador']) && $this->nmgp_cmp_hidden['hotel_computador'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_computador" value="<?php echo $this->form_encode_input($hotel_computador) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_computador_label" id="hidden_field_label_hotel_computador" style="<?php echo $sStyleHidden_hotel_computador; ?>"><span id="id_label_hotel_computador"><?php echo $this->nm_new_label['hotel_computador']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_computador_line" id="hidden_field_data_hotel_computador" style="<?php echo $sStyleHidden_hotel_computador; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_computador_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_computador"]) &&  $this->nmgp_cmp_readonly["hotel_computador"] == "on") { 

 if ("Y" == $this->hotel_computador) { $hotel_computador_look = "Sim";} 
 if ("N" == $this->hotel_computador) { $hotel_computador_look = "Não";} 
?>
<input type="hidden" name="hotel_computador" value="<?php echo $this->form_encode_input($hotel_computador) . "\">" . $hotel_computador_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_computador) { $hotel_computador_look = "Sim";} 
 if ("N" == $this->hotel_computador) { $hotel_computador_look = "Não";} 
?>
<span id="id_read_on_hotel_computador"  class="css_hotel_computador_line" style="<?php echo $sStyleReadLab_hotel_computador; ?>"><?php echo $this->form_format_readonly("hotel_computador", $this->form_encode_input($hotel_computador_look)); ?></span><span id="id_read_off_hotel_computador" class="css_read_off_hotel_computador css_hotel_computador_line" style="<?php echo $sStyleReadInp_hotel_computador; ?>"><div id="idAjaxRadio_hotel_computador" style="display: inline-block"  class="css_hotel_computador_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_computador_line"><?php $tempOptionId = "id-opt-hotel_computador" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_computador sc-ui-radio-hotel_computador" type=radio name="hotel_computador" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_computador'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_computador)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_computador_line"><?php $tempOptionId = "id-opt-hotel_computador" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_computador sc-ui-radio-hotel_computador" type=radio name="hotel_computador" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_computador'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_computador)  { echo " checked" ;} ?><?php  if (empty($this->hotel_computador)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_computador_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_computador_text"></span></td></tr></table></td></tr></table></TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['hotel_convencoes']))
    {
        $this->nm_new_label['hotel_convencoes'] = "Sala Convenções:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_convencoes = $this->hotel_convencoes;
   $sStyleHidden_hotel_convencoes = '';
   if (isset($this->nmgp_cmp_hidden['hotel_convencoes']) && $this->nmgp_cmp_hidden['hotel_convencoes'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_convencoes']);
       $sStyleHidden_hotel_convencoes = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_convencoes = 'display: none;';
   $sStyleReadInp_hotel_convencoes = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_convencoes']) && $this->nmgp_cmp_readonly['hotel_convencoes'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_convencoes']);
       $sStyleReadLab_hotel_convencoes = '';
       $sStyleReadInp_hotel_convencoes = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_convencoes']) && $this->nmgp_cmp_hidden['hotel_convencoes'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_convencoes" value="<?php echo $this->form_encode_input($hotel_convencoes) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_convencoes_label" id="hidden_field_label_hotel_convencoes" style="<?php echo $sStyleHidden_hotel_convencoes; ?>"><span id="id_label_hotel_convencoes"><?php echo $this->nm_new_label['hotel_convencoes']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_convencoes_line" id="hidden_field_data_hotel_convencoes" style="<?php echo $sStyleHidden_hotel_convencoes; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_convencoes_line" style="vertical-align: top;padding: 0px">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["hotel_convencoes"]) &&  $this->nmgp_cmp_readonly["hotel_convencoes"] == "on") { 

 if ("Y" == $this->hotel_convencoes) { $hotel_convencoes_look = "Sim";} 
 if ("N" == $this->hotel_convencoes) { $hotel_convencoes_look = "Não";} 
?>
<input type="hidden" name="hotel_convencoes" value="<?php echo $this->form_encode_input($hotel_convencoes) . "\">" . $hotel_convencoes_look . ""; ?>
<?php } else { ?>

<?php

 if ("Y" == $this->hotel_convencoes) { $hotel_convencoes_look = "Sim";} 
 if ("N" == $this->hotel_convencoes) { $hotel_convencoes_look = "Não";} 
?>
<span id="id_read_on_hotel_convencoes"  class="css_hotel_convencoes_line" style="<?php echo $sStyleReadLab_hotel_convencoes; ?>"><?php echo $this->form_format_readonly("hotel_convencoes", $this->form_encode_input($hotel_convencoes_look)); ?></span><span id="id_read_off_hotel_convencoes" class="css_read_off_hotel_convencoes css_hotel_convencoes_line" style="<?php echo $sStyleReadInp_hotel_convencoes; ?>"><div id="idAjaxRadio_hotel_convencoes" style="display: inline-block"  class="css_hotel_convencoes_line">
<TABLE cellspacing=0 cellpadding=0 border=0><TR>
  <TD class="scFormDataFontOdd css_hotel_convencoes_line"><?php $tempOptionId = "id-opt-hotel_convencoes" . $sc_seq_vert . "-1"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_convencoes sc-ui-radio-hotel_convencoes" type=radio name="hotel_convencoes" value="Y"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_convencoes'][] = 'Y'; ?>
<?php  if ("Y" == $this->hotel_convencoes)  { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Sim</label></TD>
  <TD class="scFormDataFontOdd css_hotel_convencoes_line"><?php $tempOptionId = "id-opt-hotel_convencoes" . $sc_seq_vert . "-2"; ?>
    <input id="<?php echo $tempOptionId ?>"  class="sc-ui-radio-hotel_convencoes sc-ui-radio-hotel_convencoes" type=radio name="hotel_convencoes" value="N"
<?php $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['Lookup_hotel_convencoes'][] = 'N'; ?>
<?php  if ("N" == $this->hotel_convencoes)  { echo " checked" ;} ?><?php  if (empty($this->hotel_convencoes)) { echo " checked" ;} ?>  onClick="" ><label for="<?php echo $tempOptionId ?>">Não</label></TD>
</TR></TABLE>
</div>
</span><?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_convencoes_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_convencoes_text"></span></td></tr></table></td></tr></table></TD>
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
    if (!isset($this->nm_new_label['hotel_cod_estrangeiro']))
    {
        $this->nm_new_label['hotel_cod_estrangeiro'] = "Cód. Estrangeiro:";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $hotel_cod_estrangeiro = $this->hotel_cod_estrangeiro;
   $sStyleHidden_hotel_cod_estrangeiro = '';
   if (isset($this->nmgp_cmp_hidden['hotel_cod_estrangeiro']) && $this->nmgp_cmp_hidden['hotel_cod_estrangeiro'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['hotel_cod_estrangeiro']);
       $sStyleHidden_hotel_cod_estrangeiro = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_hotel_cod_estrangeiro = 'display: none;';
   $sStyleReadInp_hotel_cod_estrangeiro = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['hotel_cod_estrangeiro']) && $this->nmgp_cmp_readonly['hotel_cod_estrangeiro'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['hotel_cod_estrangeiro']);
       $sStyleReadLab_hotel_cod_estrangeiro = '';
       $sStyleReadInp_hotel_cod_estrangeiro = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['hotel_cod_estrangeiro']) && $this->nmgp_cmp_hidden['hotel_cod_estrangeiro'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="hotel_cod_estrangeiro" value="<?php echo $this->form_encode_input($hotel_cod_estrangeiro) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormLabelOdd scUiLabelWidthFix css_hotel_cod_estrangeiro_label" id="hidden_field_label_hotel_cod_estrangeiro" style="<?php echo $sStyleHidden_hotel_cod_estrangeiro; ?>"><span id="id_label_hotel_cod_estrangeiro"><?php echo $this->nm_new_label['hotel_cod_estrangeiro']; ?></span></TD>
    <TD class="scFormDataOdd css_hotel_cod_estrangeiro_line" id="hidden_field_data_hotel_cod_estrangeiro" style="<?php echo $sStyleHidden_hotel_cod_estrangeiro; ?>"><table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_hotel_cod_estrangeiro_line" style="vertical-align: top;padding: 0px"><input type="hidden" name="hotel_cod_estrangeiro" value="<?php echo $this->form_encode_input($hotel_cod_estrangeiro); ?>"><span id="id_ajax_label_hotel_cod_estrangeiro"><?php echo nl2br($hotel_cod_estrangeiro); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_hotel_cod_estrangeiro_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_hotel_cod_estrangeiro_text"></span></td></tr></table></td></tr></table></TD>
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R")
{
      if ($opcao_botoes != "novo" && $this->nmgp_botoes['goto'] == "on")
      {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['birpara']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['birpara']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['birpara']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['birpara']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['birpara'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['first']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['first']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['first']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['first']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['first'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['back']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['back']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['back']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['back']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['back'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['forward']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['forward']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['forward']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['forward']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['forward'];
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

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['last']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_disabled']['last']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['last']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['last']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['btn_label']['last'];
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
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R")
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
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F") { if ('parcial' == $this->form_paginacao) {?><script>summary_atualiza(<?php echo ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_start'] + 1). ", " . $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['reg_qtd'] . ", " . ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['total'] + 1)?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F") { if ('total' == $this->form_paginacao) {?><script>summary_atualiza(1, <?php echo $this->sc_max_reg . ", " . $this->sc_max_reg?>);</script><?php }} ?>
<?php if (('novo' != $this->nmgp_opcao || $this->Embutida_form) && !$this->nmgp_form_empty && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['run_iframe'] != "F") { ?><script>navpage_atualiza('<?php echo $this->SC_nav_page ?>');</script><?php } ?>
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
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['masterValue']);
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
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("form_tbl_hoteis");
</script>
<?php
    }
    else {
        $sTamanhoIframe = (isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] && '0' != $_POST['sc_ifr_height'] && 0 != $_POST['sc_ifr_height']) ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("form_tbl_hoteis");
 parent.scAjaxDetailHeight("form_tbl_hoteis", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("form_tbl_hoteis", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("form_tbl_hoteis", <?php echo $sTamanhoIframe; ?>);
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
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['sc_modal'])
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
$_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['buttonStatus'] = $this->nmgp_botoes;
?>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['inside_nested_iframe']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_tbl_hoteis']['inside_nested_iframe']) {
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
