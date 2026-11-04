<?php

class grid_bloqueio_aereo_rsvp_rtf
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Texto_tag;
   var $Arquivo;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("pt_br");
      $this->Texto_tag = "";
   }


function actionBar_replaceQuotes($string)
{
    return str_replace("\"", "\\\"", $string);
}


function actionBar_isValidState($buttonName, $buttonState)
{
    switch ($buttonName) {
    }

    return false;
}


function actionBar_displayState($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateHint($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateConfirm($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateDisable($buttonName)
{
    if (isset($this->sc_actionbar_disabled[$buttonName]) && $this->sc_actionbar_disabled[$buttonName]) {
        return ' disabled';
    }

    return '';
}

function actionBar_getStateHide($buttonName)
{
    if (isset($this->sc_actionbar_hidden[$buttonName]) && $this->sc_actionbar_hidden[$buttonName]) {
        return ' sc-actionbar-button-hidden';
    }

    return '';
}

   //---- 
   function monta_rtf()
   {
      $this->inicializa_vars();
      $this->gera_texto_tag();
      $this->grava_arquivo_rtf();
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Rtf_f);
          $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
          $Temp = ob_get_clean();
          if ($Temp !== false && trim($Temp) != "")
          {
              $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
          }
          $oJson = new Services_JSON();
          echo $oJson->encode($this->Arr_result);
          exit;
      }
      else
      {
          $this->progress_bar_end();
      }
   }

   //----- 
   function inicializa_vars()
   {
      global $nm_lang;
      if (isset($GLOBALS['nmgp_parms']) && !empty($GLOBALS['nmgp_parms'])) 
      { 
          $GLOBALS['nmgp_parms'] = str_replace("@aspass@", "'", $GLOBALS['nmgp_parms']);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $GLOBALS["nmgp_parms"]);
          $todo  = explode("?@?", $todox);
          foreach ($todo as $param)
          {
               $cadapar = explode("?#?", $param);
               if (1 < sizeof($cadapar))
               {
                   if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                   {
                       $cadapar[0] = substr($cadapar[0], 11);
                       $cadapar[1] = $_SESSION[$cadapar[1]];
                   }
                   if (isset($GLOBALS['sc_conv_var'][$cadapar[0]]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][$cadapar[0]];
                   }
                   elseif (isset($GLOBALS['sc_conv_var'][strtolower($cadapar[0])]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][strtolower($cadapar[0])];
                   }
                   nm_limpa_str_grid_bloqueio_aereo_rsvp($cadapar[1]);
                   nm_protect_num_grid_bloqueio_aereo_rsvp($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_bloqueio_aereo_rsvp']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_bloqueio_aereo_rsvp($_SESSION["vg_evento_id"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_bloqueio_aereo_rsvp($_SESSION["rsvp_global"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_bloqueio_aereo_rsvp($_SESSION["vg_usuario_id"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_bloqueio_aereo_rsvp($_SESSION["vg_cpfseg"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_bloqueio_aereo_rsvp($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_bloqueio_aereo_rsvp($_SESSION["parm1"]);
      }
      if (isset($vg_bloqueio_id)) 
      {
          $_SESSION['vg_bloqueio_id'] = $vg_bloqueio_id;
          nm_limpa_str_grid_bloqueio_aereo_rsvp($_SESSION["vg_bloqueio_id"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_bloqueio_aereo_rsvp_total.class.php"); 
      $this->Tot      = new grid_bloqueio_aereo_rsvp_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_bloqueio_aereo_rsvp";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_bloqueio_aereo_rsvp.rtf";
   }
   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }


   //----- 
   function gera_texto_tag()
   {
     global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_bloqueio_aereo_rsvp']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_bloqueio_aereo_rsvp']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_bloqueio_aereo_rsvp']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->bloq_evento_id = (isset($Busca_temp['bloq_evento_id'])) ? $Busca_temp['bloq_evento_id'] : ""; 
          $tmp_pos = (is_string($this->bloq_evento_id)) ? strpos($this->bloq_evento_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_evento_id))
          {
              $this->bloq_evento_id = substr($this->bloq_evento_id, 0, $tmp_pos);
          }
          $this->bloq_descricao = (isset($Busca_temp['bloq_descricao'])) ? $Busca_temp['bloq_descricao'] : ""; 
          $tmp_pos = (is_string($this->bloq_descricao)) ? strpos($this->bloq_descricao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_descricao))
          {
              $this->bloq_descricao = substr($this->bloq_descricao, 0, $tmp_pos);
          }
          $this->bloqueio_id = (isset($Busca_temp['bloqueio_id'])) ? $Busca_temp['bloqueio_id'] : ""; 
          $tmp_pos = (is_string($this->bloqueio_id)) ? strpos($this->bloqueio_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloqueio_id))
          {
              $this->bloqueio_id = substr($this->bloqueio_id, 0, $tmp_pos);
          }
          $this->bloq_cia_aerea = (isset($Busca_temp['bloq_cia_aerea'])) ? $Busca_temp['bloq_cia_aerea'] : ""; 
          $tmp_pos = (is_string($this->bloq_cia_aerea)) ? strpos($this->bloq_cia_aerea, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_cia_aerea))
          {
              $this->bloq_cia_aerea = substr($this->bloq_cia_aerea, 0, $tmp_pos);
          }
          $this->bloq_origem = (isset($Busca_temp['bloq_origem'])) ? $Busca_temp['bloq_origem'] : ""; 
          $tmp_pos = (is_string($this->bloq_origem)) ? strpos($this->bloq_origem, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_origem))
          {
              $this->bloq_origem = substr($this->bloq_origem, 0, $tmp_pos);
          }
          $this->bloq_destino = (isset($Busca_temp['bloq_destino'])) ? $Busca_temp['bloq_destino'] : ""; 
          $tmp_pos = (is_string($this->bloq_destino)) ? strpos($this->bloq_destino, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_destino))
          {
              $this->bloq_destino = substr($this->bloq_destino, 0, $tmp_pos);
          }
          $this->bloq_direcao = (isset($Busca_temp['bloq_direcao'])) ? $Busca_temp['bloq_direcao'] : ""; 
          $tmp_pos = (is_string($this->bloq_direcao)) ? strpos($this->bloq_direcao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_direcao))
          {
              $this->bloq_direcao = substr($this->bloq_direcao, 0, $tmp_pos);
          }
          $this->bloq_dt_chegada = (isset($Busca_temp['bloq_dt_chegada'])) ? $Busca_temp['bloq_dt_chegada'] : ""; 
          $tmp_pos = (is_string($this->bloq_dt_chegada)) ? strpos($this->bloq_dt_chegada, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_dt_chegada))
          {
              $this->bloq_dt_chegada = substr($this->bloq_dt_chegada, 0, $tmp_pos);
          }
          $this->bloq_dt_chegada_2 = (isset($Busca_temp['bloq_dt_chegada_input_2'])) ? $Busca_temp['bloq_dt_chegada_input_2'] : ""; 
          $this->bloq_dt_saida = (isset($Busca_temp['bloq_dt_saida'])) ? $Busca_temp['bloq_dt_saida'] : ""; 
          $tmp_pos = (is_string($this->bloq_dt_saida)) ? strpos($this->bloq_dt_saida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_dt_saida))
          {
              $this->bloq_dt_saida = substr($this->bloq_dt_saida, 0, $tmp_pos);
          }
          $this->bloq_dt_saida_2 = (isset($Busca_temp['bloq_dt_saida_input_2'])) ? $Busca_temp['bloq_dt_saida_input_2'] : ""; 
          $this->bloq_num_pass_etkt = (isset($Busca_temp['bloq_num_pass_etkt'])) ? $Busca_temp['bloq_num_pass_etkt'] : ""; 
          $tmp_pos = (is_string($this->bloq_num_pass_etkt)) ? strpos($this->bloq_num_pass_etkt, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_num_pass_etkt))
          {
              $this->bloq_num_pass_etkt = substr($this->bloq_num_pass_etkt, 0, $tmp_pos);
          }
          $this->bloq_localizador = (isset($Busca_temp['bloq_localizador'])) ? $Busca_temp['bloq_localizador'] : ""; 
          $tmp_pos = (is_string($this->bloq_localizador)) ? strpos($this->bloq_localizador, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_localizador))
          {
              $this->bloq_localizador = substr($this->bloq_localizador, 0, $tmp_pos);
          }
          $this->bloq_num_voo = (isset($Busca_temp['bloq_num_voo'])) ? $Busca_temp['bloq_num_voo'] : ""; 
          $tmp_pos = (is_string($this->bloq_num_voo)) ? strpos($this->bloq_num_voo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloq_num_voo))
          {
              $this->bloq_num_voo = substr($this->bloq_num_voo, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
if (!isset($_SESSION['rsvp_global'])) {$_SESSION['rsvp_global'] = "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
if (!isset($_SESSION['vg_cpfseg'])) {$_SESSION['vg_cpfseg'] = "";}
if (!isset($this->sc_temp_vg_cpfseg)) {$this->sc_temp_vg_cpfseg = (isset($_SESSION['vg_cpfseg'])) ? $_SESSION['vg_cpfseg'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['parm1'])) {$_SESSION['parm1'] = "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($_SESSION['vg_menu_item'])) {$_SESSION['vg_menu_item'] = "";}
if (!isset($this->sc_temp_vg_menu_item)) {$this->sc_temp_vg_menu_item = (isset($_SESSION['vg_menu_item'])) ? $_SESSION['vg_menu_item'] : "";}
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$global_cpf = $this->sc_temp_rsvp_global['usuario_cpf'];
$sql = "
  	SELECT 
		usuario_id,		
		usuario_cpf
	FROM	
		usuarios_rsvp 
	WHERE
		usuario_cpf = ".$this->Db->qstr($global_cpf)." 
	ORDER BY
		usuario_cpf"
	;
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs[0][0])) {
	$this->sc_temp_vg_usuario_id = $this->rs[0][0];
}

$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
$this->RetNivel($usunivel);
$cpfseg = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'cpf');
if ($cpfseg <> $this->sc_temp_vg_cpfseg) {	
	 unset($_SESSION['vg_usuario_id']);
 unset($this->sc_temp_vg_usuario_id);
 unset($_SESSION['vg_menu_item']);
 unset($this->sc_temp_vg_menu_item);
 unset($_SESSION['parm1']);
 unset($this->sc_temp_parm1);
 unset($_SESSION['vg_evento_id']);
 unset($this->sc_temp_vg_evento_id);
 unset($_SESSION['vg_cpfseg']);
 unset($this->sc_temp_vg_cpfseg);
;
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Acesso Negado!";
;	
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
?><!DOCTYPE html>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
 if ($_SESSION['scriptcase']['proc_mobile'])
 {
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
 }
?>
<link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</head>
<body>
<?php
 $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('WWW-Authenticate: <type> realm=<realm>') . "/";
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_bloqueio_aereo_rsvp";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['sc_outra_jan'] = false;
 }
?>
<TABLE border="0" cellspacing="1" cellpadding="2" bgcolor="#406080" bordercolor="#406080" align="center">
 <TR bgcolor="#FF0000">
  <TD  align="left"><FONT face="Verdana, Arial, sans-serif" size="2" color="#FFFFFF"><B>ERRO</B></FONT></TD>
 </TR>
 <TR bgcolor="#E4E8F0">
   <TD  align="center"><FONT face="Tahoma, Arial, sans-serif" size="2" color="#404040"><?php echo $this->Campos_Mens_erro ?></FONT></TD>
 </TR>
</TABLE>
<table align="center"><tr><td>
  <form name="Fexit" method=post
        action="grid_bloqueio_aereo_rsvp_fim.php"
        target="_self">
    <input type=hidden name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page) ?>">
    <input type=submit value="OK">
  </form>
</td></tr></table>
</body>
</html>
<?php
   exit;
}
}
$this->bloq_evento_id  = $this->sc_temp_vg_evento_id;
$this->bloq_usuario  = $this->sc_temp_vg_usuario_id;

echo '<h3>&emsp;BRSVP - Cadastro de Bloqueios dos Eventos</h3>';

if ($usunivel <> 'ADMINISTRADOR') {
	$this->sc_temp_vg_evento_id = $evento_id ;
	$sql="
		SELECT
			evento_id
			usuario_id
		FROM
			eventos_usuarios_rsvp
		WHERE   
			evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
		AND 
			usuario_id = ".$this->Db->qstr($this->sc_temp_vg_usuario_id)."
		ORDER BY 
			evento_id,usuario_id
		";	
	 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
	
	$reg_inc = sizeof($this->rs );
	if ($reg_inc == 0) {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'BRSVP - Usuário Não Cadastrado para o Evento!';
;
		if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
?><!DOCTYPE html>
<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<head>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
 if ($_SESSION['scriptcase']['proc_mobile'])
 {
?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
 }
?>
<link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
</head>
<body>
<?php
 $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('grid_eventos_rsvp') . "/";
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_bloqueio_aereo_rsvp";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['sc_outra_jan'] = false;
 }
?>
<TABLE border="0" cellspacing="1" cellpadding="2" bgcolor="#406080" bordercolor="#406080" align="center">
 <TR bgcolor="#FF0000">
  <TD  align="left"><FONT face="Verdana, Arial, sans-serif" size="2" color="#FFFFFF"><B>ERRO</B></FONT></TD>
 </TR>
 <TR bgcolor="#E4E8F0">
   <TD  align="center"><FONT face="Tahoma, Arial, sans-serif" size="2" color="#404040"><?php echo $this->Campos_Mens_erro ?></FONT></TD>
 </TR>
</TABLE>
<table align="center"><tr><td>
  <form name="Fexit" method=post
        action="grid_bloqueio_aereo_rsvp_fim.php"
        target="_self">
    <input type=hidden name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page) ?>">
    <input type=submit value="OK">
  </form>
</td></tr></table>
</body>
</html>
<?php
   exit;
}
}
}

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['bloqueio_id'])) ? $this->New_label['bloqueio_id'] : "Cód. Bloqueio"; 
          if ($Cada_col == "bloqueio_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['bloq_evento_id'])) ? $this->New_label['bloq_evento_id'] : "Cód. Evento"; 
          if ($Cada_col == "bloq_evento_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_nome'])) ? $this->New_label['evento_nome'] : "Evento"; 
          if ($Cada_col == "evento_nome" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['bloq_descricao'])) ? $this->New_label['bloq_descricao'] : "Descrição"; 
          if ($Cada_col == "bloq_descricao" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cia_nome'])) ? $this->New_label['cia_nome'] : "Cia. Aérea"; 
          if ($Cada_col == "cia_nome" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['bloq_direcao'])) ? $this->New_label['bloq_direcao'] : "Direção"; 
          if ($Cada_col == "bloq_direcao" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['bloq_qtd_lugares'])) ? $this->New_label['bloq_qtd_lugares'] : "Qtd. Lugares"; 
          if ($Cada_col == "bloq_qtd_lugares" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['bloq_saldo_lugares'])) ? $this->New_label['bloq_saldo_lugares'] : "Lugares Restantes"; 
          if ($Cada_col == "bloq_saldo_lugares" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['part_icon'])) ? $this->New_label['part_icon'] : "Participantes"; 
          if ($Cada_col == "part_icon" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['bloq_cia_aerea'])) ? $this->New_label['bloq_cia_aerea'] : "Cia. Aérea:"; 
          if ($Cada_col == "bloq_cia_aerea" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['bloq_origem'])) ? $this->New_label['bloq_origem'] : "Origem"; 
          if ($Cada_col == "bloq_origem" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
      } 
      $this->Texto_tag .= "</tr>\r\n";
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_direcao, bloq_qtd_lugares, bloq_saldo_lugares, bloq_cia_aerea, bloq_origem from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_direcao, bloq_qtd_lugares, bloq_saldo_lugares, bloq_cia_aerea, bloq_origem from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_direcao, bloq_qtd_lugares, bloq_saldo_lugares, bloq_cia_aerea, bloq_origem from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_direcao, bloq_qtd_lugares, bloq_saldo_lugares, bloq_cia_aerea, bloq_origem from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_direcao, bloq_qtd_lugares, bloq_saldo_lugares, bloq_cia_aerea, bloq_origem from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT bloqueio_id, bloq_evento_id, bloq_descricao, bloq_direcao, bloq_qtd_lugares, bloq_saldo_lugares, bloq_cia_aerea, bloq_origem from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select_count;
      $rt = $this->Db->Execute($nmgp_select_count);
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->count_ger = $rt->fields[0];
      $rt->Close();
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->Texto_tag .= "<tr>\r\n";
         $this->bloqueio_id = $rs->fields[0] ;  
         $this->bloqueio_id = (string)$this->bloqueio_id;
         $this->bloq_evento_id = $rs->fields[1] ;  
         $this->bloq_evento_id = (string)$this->bloq_evento_id;
         $this->bloq_descricao = $rs->fields[2] ;  
         $this->bloq_direcao = $rs->fields[3] ;  
         $this->bloq_qtd_lugares = $rs->fields[4] ;  
         $this->bloq_qtd_lugares = (string)$this->bloq_qtd_lugares;
         $this->bloq_saldo_lugares = $rs->fields[5] ;  
         $this->bloq_saldo_lugares = (string)$this->bloq_saldo_lugares;
         $this->bloq_cia_aerea = $rs->fields[6] ;  
         $this->bloq_cia_aerea = (string)$this->bloq_cia_aerea;
         $this->bloq_origem = $rs->fields[7] ;  
         $this->bloq_origem = (string)$this->bloq_origem;
         $this->sc_proc_grid = true; 
         //----- lookup - evento_nome
         $this->Lookup->lookup_evento_nome($this->evento_nome, $this->bloq_evento_id, $this->array_evento_nome); 
         $this->evento_nome = str_replace("<br>", " ", $this->evento_nome); 
         $this->evento_nome = ($this->evento_nome == "&nbsp;") ? "" : $this->evento_nome; 
         //----- lookup - cia_nome
         $this->Lookup->lookup_cia_nome($this->cia_nome, $this->bloq_cia_aerea, $this->array_cia_nome); 
         $this->cia_nome = str_replace("<br>", " ", $this->cia_nome); 
         $this->cia_nome = ($this->cia_nome == "&nbsp;") ? "" : $this->cia_nome; 
         $_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_bloqueio_id'])) {$_SESSION['vg_bloqueio_id'] = "";}
if (!isset($this->sc_temp_vg_bloqueio_id)) {$this->sc_temp_vg_bloqueio_id = (isset($_SESSION['vg_bloqueio_id'])) ? $_SESSION['vg_bloqueio_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$saldo_ok = $this->GetSaldoBloq($this->sc_temp_vg_evento_id,$this->bloq_direcao );
$this->sc_temp_vg_bloqueio_id = $this->bloqueio_id ;
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_bloqueio_id)) {$_SESSION['vg_bloqueio_id'] = $this->sc_temp_vg_bloqueio_id;}
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->Texto_tag .= "</tr>\r\n";
         $rs->MoveNext();
      }
      $this->Texto_tag .= "</table>\r\n";
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- bloqueio_id
   function NM_export_bloqueio_id()
   {
             nmgp_Form_Num_Val($this->bloqueio_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->bloqueio_id = NM_charset_to_utf8($this->bloqueio_id);
         $this->bloqueio_id = str_replace('<', '&lt;', $this->bloqueio_id);
         $this->bloqueio_id = str_replace('>', '&gt;', $this->bloqueio_id);
         $this->Texto_tag .= "<td>" . $this->bloqueio_id . "</td>\r\n";
   }
   //----- bloq_evento_id
   function NM_export_bloq_evento_id()
   {
             nmgp_Form_Num_Val($this->bloq_evento_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->bloq_evento_id = NM_charset_to_utf8($this->bloq_evento_id);
         $this->bloq_evento_id = str_replace('<', '&lt;', $this->bloq_evento_id);
         $this->bloq_evento_id = str_replace('>', '&gt;', $this->bloq_evento_id);
         $this->Texto_tag .= "<td>" . $this->bloq_evento_id . "</td>\r\n";
   }
   //----- evento_nome
   function NM_export_evento_nome()
   {
         $this->evento_nome = NM_charset_to_utf8($this->evento_nome);
         $this->evento_nome = str_replace('<', '&lt;', $this->evento_nome);
         $this->evento_nome = str_replace('>', '&gt;', $this->evento_nome);
         $this->Texto_tag .= "<td>" . $this->evento_nome . "</td>\r\n";
   }
   //----- bloq_descricao
   function NM_export_bloq_descricao()
   {
         $this->bloq_descricao = html_entity_decode($this->bloq_descricao, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->bloq_descricao = strip_tags($this->bloq_descricao);
         $this->bloq_descricao = NM_charset_to_utf8($this->bloq_descricao);
         $this->bloq_descricao = str_replace('<', '&lt;', $this->bloq_descricao);
         $this->bloq_descricao = str_replace('>', '&gt;', $this->bloq_descricao);
         $this->Texto_tag .= "<td>" . $this->bloq_descricao . "</td>\r\n";
   }
   //----- cia_nome
   function NM_export_cia_nome()
   {
         $this->cia_nome = NM_charset_to_utf8($this->cia_nome);
         $this->cia_nome = str_replace('<', '&lt;', $this->cia_nome);
         $this->cia_nome = str_replace('>', '&gt;', $this->cia_nome);
         $this->Texto_tag .= "<td>" . $this->cia_nome . "</td>\r\n";
   }
   //----- bloq_direcao
   function NM_export_bloq_direcao()
   {
         $this->bloq_direcao = html_entity_decode($this->bloq_direcao, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->bloq_direcao = strip_tags($this->bloq_direcao);
         $this->bloq_direcao = NM_charset_to_utf8($this->bloq_direcao);
         $this->bloq_direcao = str_replace('<', '&lt;', $this->bloq_direcao);
         $this->bloq_direcao = str_replace('>', '&gt;', $this->bloq_direcao);
         $this->Texto_tag .= "<td>" . $this->bloq_direcao . "</td>\r\n";
   }
   //----- bloq_qtd_lugares
   function NM_export_bloq_qtd_lugares()
   {
             nmgp_Form_Num_Val($this->bloq_qtd_lugares, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->bloq_qtd_lugares = NM_charset_to_utf8($this->bloq_qtd_lugares);
         $this->bloq_qtd_lugares = str_replace('<', '&lt;', $this->bloq_qtd_lugares);
         $this->bloq_qtd_lugares = str_replace('>', '&gt;', $this->bloq_qtd_lugares);
         $this->Texto_tag .= "<td>" . $this->bloq_qtd_lugares . "</td>\r\n";
   }
   //----- bloq_saldo_lugares
   function NM_export_bloq_saldo_lugares()
   {
             nmgp_Form_Num_Val($this->bloq_saldo_lugares, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->bloq_saldo_lugares = NM_charset_to_utf8($this->bloq_saldo_lugares);
         $this->bloq_saldo_lugares = str_replace('<', '&lt;', $this->bloq_saldo_lugares);
         $this->bloq_saldo_lugares = str_replace('>', '&gt;', $this->bloq_saldo_lugares);
         $this->Texto_tag .= "<td>" . $this->bloq_saldo_lugares . "</td>\r\n";
   }
   //----- part_icon
   function NM_export_part_icon()
   {
         $this->part_icon = NM_charset_to_utf8($this->part_icon);
         $this->part_icon = str_replace('<', '&lt;', $this->part_icon);
         $this->part_icon = str_replace('>', '&gt;', $this->part_icon);
         $this->Texto_tag .= "<td>" . $this->part_icon . "</td>\r\n";
   }
   //----- bloq_cia_aerea
   function NM_export_bloq_cia_aerea()
   {
             nmgp_Form_Num_Val($this->bloq_cia_aerea, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->bloq_cia_aerea = NM_charset_to_utf8($this->bloq_cia_aerea);
         $this->bloq_cia_aerea = str_replace('<', '&lt;', $this->bloq_cia_aerea);
         $this->bloq_cia_aerea = str_replace('>', '&gt;', $this->bloq_cia_aerea);
         $this->Texto_tag .= "<td>" . $this->bloq_cia_aerea . "</td>\r\n";
   }
   //----- bloq_origem
   function NM_export_bloq_origem()
   {
             nmgp_Form_Num_Val($this->bloq_origem, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->bloq_origem = NM_charset_to_utf8($this->bloq_origem);
         $this->bloq_origem = str_replace('<', '&lt;', $this->bloq_origem);
         $this->bloq_origem = str_replace('>', '&gt;', $this->bloq_origem);
         $this->Texto_tag .= "<td>" . $this->bloq_origem . "</td>\r\n";
   }

   //----- 
   function grava_arquivo_rtf()
   {
      global $nm_lang, $doc_wrap;
      $this->Rtf_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $rtf_f       = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      require_once($this->Ini->path_third      . "/rtf_new/document_generator/cl_xml2driver.php"); 
      $text_ok  =  "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\r\n"; 
      $text_ok .=  "<DOC config_file=\"" . $this->Ini->path_third . "/rtf_new/doc_config.inc\" >\r\n"; 
      $text_ok .=  $this->Texto_tag; 
      $text_ok .=  "</DOC>\r\n"; 
      $xml = new nDOCGEN($text_ok,"RTF"); 
      fwrite($rtf_f, $xml->get_result_file());
      fclose($rtf_f);
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_bloqueio_aereo_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>BRSVP - Cadastro de Bloqueio Aéreo :: RTF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
  <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
  <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
  <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
  <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">RTF</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_bloqueio_aereo_rsvp_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_bloqueio_aereo_rsvp"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="volta_grid"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 

function GetSaldoBloq($evento_id, $direcao) {
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		$ret = TRUE;
		$valor_y = 'Y';
		$valor_n = 'N';
		$valor_0 = '0';
	
		$sqlx="
		SELECT 
			aereo_id_evento,aereo_bloqueio_id 
		FROM 
			aereos_rsvp
		WHERE 
			aereo_id_evento = ".$this->Db->qstr($evento_id)."	
		AND 
			aereo_bloqueio_id <> ".$this->Db->qstr($valor_0)."
		AND 
			aereo_status <>  ".$this->Db->qstr($valor_n)."
		AND 
			aereo_direcao =  ".$this->Db->qstr($direcao)."
		AND
			aereo_ativo  = ".$this->Db->qstr($valor_y)."		
		ORDER BY 
			aereo_cpf_particip, aereo_id_evento"
		;	
		 
      $nm_select = $sqlx; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsl = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsl[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsl = false;
          $this->rsl_erro = $this->Db->ErrorMsg();
      } 
	
		if (isset($this->rsl[0][0])) {	
				$bloqueio = $this->rsl[0][1];
				$sqljoin="
				SELECT 
					aereos_rsvp.aereo_bloqueio_id,aereos_rsvp.aereo_id_evento,bloqueio_aereo_rsvp.bloq_qtd_lugares,COUNT(aereos_rsvp.aereo_bloqueio_id) AS qtd_aereo, 
					aereos_rsvp.aereo_direcao,aereos_rsvp.aereo_status
				FROM
					aereos_rsvp
				INNER JOIN 
					bloqueio_aereo_rsvp
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id
				WHERE
					aereos_rsvp.aereo_bloqueio_id =  ".$this->Db->qstr($bloqueio)."
				AND 
					aereos_rsvp.aereo_status <> ".$this->Db->qstr($valor_n)." AND aereos_rsvp.aereo_direcao = ".$this->Db->qstr($direcao)."
				GROUP BY 
					aereos_rsvp.aereo_bloqueio_id"
				;	
				 
      $nm_select = $sqljoin; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsjoin = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsjoin[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsjoin = false;
          $this->rsjoin_erro = $this->Db->ErrorMsg();
      } 
		
				if (isset($this->rsjoin[0][0])) {
					$bloqueio_id	= $this->rsjoin[0][0];
					$qtd_lugares	= $this->rsjoin[0][2];
					$qtd_bloqueio	= $this->rsjoin[0][3];
					$saldo			= $qtd_lugares - $qtd_bloqueio;
					$sqlupd="	
					UPDATE 
						bloqueio_aereo_rsvp
					SET 
						bloq_saldo_lugares = ".$this->Db->qstr($saldo)."
					WHERE 
						bloqueio_id = ".$this->Db->qstr($this->bloqueio_id)." 
					";
					 
      $nm_select = $sqlupd; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsupd = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsupd[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsupd = false;
          $this->rsupd_erro = $this->Db->ErrorMsg();
      } 
	
					$ret = $saldo;
				} else {
					$ret = FALSE;	
				}	
		} else {
			$sqls="
			SELECT 
				bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
			FROM
				bloqueio_aereo_rsvp
			WHERE
				bloq_evento_id = ".$this->Db->qstr($evento_id)."	
			AND
				bloq_direcao = ".$this->Db->qstr($direcao)."
			ORDER BY
				bloq_evento_id,bloq_direcao
			";
			 
      $nm_select = $sqls; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rss = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rss[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rss = false;
          $this->rss_erro = $this->Db->ErrorMsg();
      } 
	
			if (isset($this->rss[0][0])) {	
				$bloq_id = $this->rss[0][0];	
				$qtd_lugares = $this->rss[0][3];			
				$sqlupd="	
				UPDATE 
					bloqueio_aereo_rsvp
				SET 
					bloq_saldo_lugares = ".$this->Db->qstr($qtd_lugares)." 
				WHERE 
					bloqueio_id =  ".$this->Db->qstr($bloq_id)."  		
				";
				
     $nm_select = $sqlupd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      
			}	
		}	
		return $ret;
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  	
	date_default_timezone_set('America/Sao_Paulo');
	$sql = "
  	SELECT 
		usuario_id,
		usuario_nivel,
		usuario_email,		
		usuario_nome,
		usuario_cpf
	FROM	
		usuarios_rsvp 
	WHERE
		usuario_id = ".$this->Db->qstr($idu)." 
	ORDER BY
		usuario_id"
	;
	 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs[0][0])) {			
		switch($tipo) {
			case 'nivel':
				$ret = $this->rs[0][1];
				break;
			case 'nome':
				$ret = $this->rs[0][3];
				break;
			case 'cpf':
				$ret = $this->rs[0][4];
				break;
		}	 
	
	} else {
		$ret = 'ERRO';
	}	
	return $ret;
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		switch($nivel) {
		case 'ADMINISTRADOR':
			break;
		case 'CONVIDADO':
			$this->nmgp_botoes["delete"] = 'off';;	
			break;		
		case 'EXECUTIVO':
			$this->nmgp_botoes["delete"] = 'off';;	
			break;				
		case 'OPERACIONAL':
			$this->nmgp_botoes["delete"] = 'off';;	
			break;				
		case 'SUPERVISOR':
			$this->nmgp_botoes["delete"] = 'on';;	
			break;						
	}
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'on';
  
	date_default_timezone_set('America/Sao_Paulo');
	$sqlusok = "
		SELECT
			usuario_id,
			usuario_cpf
		FROM
			usuarios_rsvp
		WHERE
			usuario_id = ".$this->Db->qstr($pusuario)."		
		ORDER BY
			usuario_id		
	";
	 
      $nm_select = $sqlusok; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs[0][0]))
		$ret = $this->rs[0][0];
$_SESSION['scriptcase']['grid_bloqueio_aereo_rsvp']['contr_erro'] = 'off';
}

}

?>
