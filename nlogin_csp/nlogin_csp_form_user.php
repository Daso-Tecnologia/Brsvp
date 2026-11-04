<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Security-Policy" content=" 
        script-src 'self' https://seudominio.exemplo.com.br/nrsvp/nlogin/;                                                
        object-src 'none';
        frame-ancestors 'none';                                                          
		frame-src 'self';        
		img-src 'self';
		form-action 'self';
		connect-src 'self';
		base-uri 'self';
		child-src 'self';
		object-src 'none';
		prefetch-src 'self';               
	">  
</head>
<html lang="en" class=" svg localstorage sessionstorage no-websqldatabase svgfilters bgpositionshorthand multiplebgs preserve3d inlinesvg csscalc supports svgclippaths svgforeignobject smil no-touchevents fontface svgasimg no-forcetouch matchmedia cssanimations bgpositionxy bgrepeatround bgrepeatspace bgsizecover borderradius no-flexboxtweener csstransforms csstransforms3d csstransitions">
<head>
	<META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
	 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
        <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_third; ?>jquery/js/jquery.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/viewerjs/viewer.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/viewerjs/viewer.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/6/css/all.min.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("nlogin_csp_sajax_js.php");
?>
<script type="text/javascript">
var Nm_Proc_Atualiz = false;
</script>
<script type="text/javascript">
<?php

include_once('nlogin_csp_jquery.php');

?>
</script>
<script type="text/javascript">
 $(function() {
  scJQElementsAdd('');
  scJQGeneralAdd();
 });

</script>
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
 include_once("nlogin_csp_js0.php");
?>
<script type="text/javascript"> function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
</script><?php
$msgDefClose = isset($this->arr_buttons['bmessageclose']) ? $this->arr_buttons['bmessageclose']['value'] : 'Ok';
?>
<script type="text/javascript">
var scMsgDefTitle = "<?php if (isset($this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'])) {echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'];} ?>";
var scMsgDefButton = "Ok";
var scMsgDefClose = "<?php echo $msgDefClose; ?>";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->sc_page; ?>";
</script>
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['nlogin_csp']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['nlogin_csp']['sc_modal'])
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
$sIconTitle = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
$sErrorIcon = (isset($_SESSION['scriptcase']['error_icon']['app_Login']) && '' != $_SESSION['scriptcase']['error_icon']['app_Login']) ? $_SESSION['scriptcase']['error_icon']['app_Login']  : "";
$sCloseIcon = (isset($_SESSION['scriptcase']['error_close']['app_Login']) && '' != trim($_SESSION['scriptcase']['error_close']['app_Login'])) ? $_SESSION['scriptcase']['error_close']['app_Login'] : "<td><input class=\"scButton_default\" type=\"button\" onClick=\"document.getElementById('id_error_display_fixed').style.display = 'none'; document.getElementById('id_error_message_fixed').innerHTML = ''; return false\" value=\"X\" /></td>";
if ('' != $sIconTitle && '' != $sErrorIcon) {
    $sErrorIcon = '';
}
?>
<script type="text/javascript">
$(function() {
    $(document.F1).on("submit", function (e) {
        e.preventDefault();
    });
});

if (typeof scDisplayUserError === "undefined") {
    function scDisplayUserError(errorMessage) {
        scJs_alert("ERROR:\r\n" + errorMessage.replace(/<br \/>/gi, "<!--SC_NL-->"), function() {}, {type: "error"});
    }
}
if (typeof scDisplayUserDebug === "undefined") {
    function scDisplayUserDebug(debugMessage) {
        scJs_alert("DEBUG:\r\n" + debugMessage.replace(/<br \/>/gi, "<!--SC_NL-->"), function() {}, {type: "warning"});
    }
}
if (typeof scDisplayUserMessage === "undefined") {
    function scDisplayUserMessage(userMessage) {
        scJs_alert("MESSAGE:\r\n" + userMessage.replace(/<br \/>/gi, "<!--SC_NL-->"), function() {}, {type: "info"});
    }
}
</script>

<script>
$(function() {
<?php
if (isset($this->nmgp_cmp_hidden) && !empty($this->nmgp_cmp_hidden)) {
    foreach($this->nmgp_cmp_hidden as $fieldDisplayFieldName => $fieldDisplayFieldStatus) {
        if ('on' == $fieldDisplayFieldStatus) {
?>
if (typeof scShowUserField === "function") {
    scShowUserField("<?php echo $fieldDisplayFieldName ?>");
}
<?php
        }
        if ('off' == $fieldDisplayFieldStatus) {
?>
if (typeof scHideUserField === "function") {
    scHideUserField("<?php echo $fieldDisplayFieldName ?>");
}
<?php
        }
    }
}
?>
});
</script>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title><?php echo "RSVP - Login"; ?></title>	
		<link href="../_lib/libraries/grp/QuantumPro/assets/css" rel="stylesheet">	
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/bootstrap.css"> 
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/bootstrap.css">
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/metisMenu.css">
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/index.css">
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/jquery.mCustomScrollbar.css">	
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/line-awesome.min.css">	
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/dripicons.min.css">	
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/material-design-iconic-font.min.css">	
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/main.bundle.css">
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/main.css">
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/default.css">
		<link rel="stylesheet" href="../_lib/libraries/grp/QuantumPro/assets/theme-a.css">
		<link rel="stylesheet" type="text/css" href="nlogin_html.css" />
		<script type="text/javascript" src="nlogin_html.js"></script>
</head>

<body class="  pace-done">
	<div class="pace  pace-inactive">
		<div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  		<div class="pace-progress-inner"></div>
	</div>
	<div class="pace-activity"></div>
	</div>
	<div class="container">
		<form class="sign-in-form"  name="F1" method="post" 
               action="./" 
               target="_self">
			<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_url_saida" value="<?php echo $this->form_encode_input($nmgp_url_saida); ?>">
<input type="hidden" name="bok" value="OK">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />

			<div class="card">
				<div class="card-body">
					<a href="https://https://seudominio.exemplo.com.br/nrsvp/nlogin/" class="brand text-center d-block m-b-20">
						<img src="../_lib/libraries/grp/QuantumPro/assets/logo_belvitur.png" alt="RSVP">
					</a>
					<h5 class="sign-in-heading text-center m-b-20">RSVP Acesso do Usuário</h5>
					<div class="form-group">
						<label for="CPF" class="sr-only"><?php
if (!isset($this->nm_new_label['cpf'])) {
    $this->nm_new_label['cpf'] = "CPF";
}
?>
<span id="id_label_cpf"><?php echo $this->nm_new_label['cpf']; ?></span></label>
						<input type="text" class="form-control  sc-js-input " placeholder="Usuário"  name="cpf" id="id_sc_field_cpf" value="<?php echo $this->form_encode_input($cpf) ?>"  alt="{datatype: 'mask', maxLength: 14, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', maskList: '999.999.999-99', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"  required="">
					</div>

					<div class="form-group">
						<label for="senha" class="sr-only"><?php
if (!isset($this->nm_new_label['senha'])) {
    $this->nm_new_label['senha'] = "Senha";
}
?>
<span id="id_label_senha"><?php echo $this->nm_new_label['senha']; ?></span></label>
						<input type="password" class="form-control  sc-js-input " placeholder="senha"  name="senha" id="id_sc_field_senha" value="<?php echo $this->form_encode_input($senha) ?>"  alt="{datatype: 'text', maxLength: 20, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"  required="">
					</div>

					<div class="form-group">
						<label for="googlecode" class="sr-only"><?php
if (!isset($this->nm_new_label['googlecode'])) {
    $this->nm_new_label['googlecode'] = "Código Google";
}
?>
<span id="id_label_googlecode"><?php echo $this->nm_new_label['googlecode']; ?></span></label>
						<input type="text" class="form-control  sc-js-input " placeholder="Código Google"  name="googlecode" id="id_sc_field_googlecode" value="<?php echo $this->form_encode_input($googlecode) ?>"  alt="{datatype: 'text', maxLength: 16, allowedChars: '<?php echo $this->allowedCharsCharset("") ?>', lettersCase: '', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}"  required="">
					</div>
				<!--
					<div class="checkbox m-b-10 m-t-20">
						<div class="custom-control custom-checkbox checkbox-primary form-check">
							<input type="checkbox" class="custom-control-input" id="stateCheck1" checked="">
							<label class="custom-control-label" for="stateCheck1">	Lembrar-me</label>
						</div>
						<a href="https://www.authenticgoods.co/themes/quantum-pro/demos/demo1/auth.forgot-password.html" class="float-right">Esqueceu sua senha?</a>
					</div>
				-->
				<!--
					<button class="btn btn-primary btn-rounded btn-floating btn-lg btn-block" type="submit">Acessar</button>
				-->	
					<input type="button"  onclick="nm_atualiza('alterar');"  class="btn btn-primary btn-rounded btn-floating btn-lg btn-block" value="Acessar" />
				<!--
				 <p class="text-muted m-t-25 m-b-0 p-0">Não possui conta?<a href="https://www.authenticgoods.co/themes/quantum-pro/demos/demo1/auth.register.html"> Crie uma conta</a></p>
				-->
					<p><h3 class="sign-in-heading text-center m-t-25">BeFly - Belvitur</h3></p>
				</div>

			</div>
		</form>
	</div>
	
	<script src="../_lib/libraries/grp/QuantumPro/assets/modernizr.custom.js.download"></script>
	<script src="../_lib/libraries/grp/QuantumPro/assets/jquery.min.js.download"></script>
	<script src="../_lib/libraries/grp/QuantumPro/assets/bootstrap.bundle.min.js.download"></script>
	<script src="../_lib/libraries/grp/QuantumPro/assets/assets/js.storage.js.download"></script>
	<script src="../_lib/libraries/grp/QuantumPro/assets/assets/js.cookie.js.download"></script>
	<script src="../_lib/libraries/grp/QuantumPro/assets/assets/pace.js.download"></script>
	<script src="../_lib/libraries/grp/QuantumPro/assets/assets/metisMenu.js.download"></script>
	<script src="../_lib/libraries/grp/QuantumPro/assets/assets/index.js.download"></script>
	<script src="../_lib/libraries/grp/QuantumPro/assets/assets/jquery.mCustomScrollbar.concat.min.js.download"></script>	
	<script src="../_lib/libraries/grp/QuantumPro/assets/assets/app.js.download"></script>
</body>
</html>