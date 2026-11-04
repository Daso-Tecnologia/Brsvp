<?php

class grid_eventos_rsvp_json
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Arquivo;
   var $Arquivo_view;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   function __construct()
   {
      $this->nm_data = new nm_data("pt_br");
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

   function monta_json()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Json_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $result_json = json_encode($this->Arr_result, JSON_UNESCAPED_UNICODE);
              if ($result_json == false)
              {
                  $oJson = new Services_JSON();
                  $result_json = $oJson->encode($this->Arr_result);
              }
              echo $result_json;
              exit;
          }
          else
          {
              $this->progress_bar_end();
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['opcao'] = "";
      }
   }

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
                   nm_limpa_str_grid_eventos_rsvp($cadapar[1]);
                   nm_protect_num_grid_eventos_rsvp($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_eventos_rsvp']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_eventos_rsvp($_SESSION["rsvp_global"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_eventos_rsvp($_SESSION["vg_usuario_id"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_eventos_rsvp($_SESSION["vg_cpfseg"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_eventos_rsvp($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_eventos_rsvp($_SESSION["parm1"]);
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_eventos_rsvp($_SESSION["vg_evento_id"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Json_use_label = true;
      $this->Json_format = false;
      $this->Tem_json_res = false;
      $this->Json_password = "";
      if (isset($_REQUEST['nm_json_label']) && !empty($_REQUEST['nm_json_label']))
      {
          $this->Json_use_label = ($_REQUEST['nm_json_label'] == "S") ? true : false;
      }
      if (isset($_REQUEST['nm_json_format']) && !empty($_REQUEST['nm_json_format']))
      {
          $this->Json_format = ($_REQUEST['nm_json_format'] == "S") ? true : false;
      }
      $this->Tem_json_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_json_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['SC_Gb_Free_cmp']))
      {
          $this->Tem_json_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_eventos_rsvp/grid_eventos_rsvp_res_json.class.php"))
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_label']))
      {
          $this->Json_use_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_label'];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_format']))
      {
          $this->Json_format = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_format'];
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_eventos_rsvp_total.class.php"); 
      $this->Tot = new grid_eventos_rsvp_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_eventos_rsvp']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_return']);
          if ($this->Tem_json_res) {
              $PB_plus = intval ($this->count_ger * 0.04);
              $PB_plus = ($PB_plus < 2) ? 2 : $PB_plus;
          }
          else {
              $PB_plus = intval ($this->count_ger * 0.02);
              $PB_plus = ($PB_plus < 1) ? 1 : $PB_plus;
          }
          $PB_tot = $this->count_ger + $PB_plus;
          $this->PB_dif = $PB_tot - $this->count_ger;
          $this->pb->setTotalSteps($PB_tot);
      }
      $this->nm_data = new nm_data("pt_br");
      $this->Arquivo      = "sc_json";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_grid_eventos_rsvp.zip";
      $this->Arquivo     .= "_grid_eventos_rsvp";
      $this->Arquivo     .= ".json";
      $this->Tit_doc      = "grid_eventos_rsvp.json";
      $this->Tit_zip      = "grid_eventos_rsvp.zip";
   }

   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   function grava_arquivo()
   {
      global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_eventos_rsvp']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_eventos_rsvp']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_eventos_rsvp']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->evento_id = (isset($Busca_temp['evento_id'])) ? $Busca_temp['evento_id'] : ""; 
          $tmp_pos = (is_string($this->evento_id)) ? strpos($this->evento_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->evento_id))
          {
              $this->evento_id = substr($this->evento_id, 0, $tmp_pos);
          }
          $this->evento_nome = (isset($Busca_temp['evento_nome'])) ? $Busca_temp['evento_nome'] : ""; 
          $tmp_pos = (is_string($this->evento_nome)) ? strpos($this->evento_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->evento_nome))
          {
              $this->evento_nome = substr($this->evento_nome, 0, $tmp_pos);
          }
          $this->evento_dt_realizacao = (isset($Busca_temp['evento_dt_realizacao'])) ? $Busca_temp['evento_dt_realizacao'] : ""; 
          $tmp_pos = (is_string($this->evento_dt_realizacao)) ? strpos($this->evento_dt_realizacao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->evento_dt_realizacao))
          {
              $this->evento_dt_realizacao = substr($this->evento_dt_realizacao, 0, $tmp_pos);
          }
          $this->evento_dt_realizacao_2 = (isset($Busca_temp['evento_dt_realizacao_input_2'])) ? $Busca_temp['evento_dt_realizacao_input_2'] : ""; 
          $this->evento_dt_conclusao = (isset($Busca_temp['evento_dt_conclusao'])) ? $Busca_temp['evento_dt_conclusao'] : ""; 
          $tmp_pos = (is_string($this->evento_dt_conclusao)) ? strpos($this->evento_dt_conclusao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->evento_dt_conclusao))
          {
              $this->evento_dt_conclusao = substr($this->evento_dt_conclusao, 0, $tmp_pos);
          }
          $this->evento_dt_conclusao_2 = (isset($Busca_temp['evento_dt_conclusao_input_2'])) ? $Busca_temp['evento_dt_conclusao_input_2'] : ""; 
          $this->evento_status = (isset($Busca_temp['evento_status'])) ? $Busca_temp['evento_status'] : ""; 
          $tmp_pos = (is_string($this->evento_status)) ? strpos($this->evento_status, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->evento_status))
          {
              $this->evento_status = substr($this->evento_status, 0, $tmp_pos);
          }
          $this->evento_municipio = (isset($Busca_temp['evento_municipio'])) ? $Busca_temp['evento_municipio'] : ""; 
          $tmp_pos = (is_string($this->evento_municipio)) ? strpos($this->evento_municipio, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->evento_municipio))
          {
              $this->evento_municipio = substr($this->evento_municipio, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_cpfseg'])) {$_SESSION['vg_cpfseg'] = "";}
if (!isset($this->sc_temp_vg_cpfseg)) {$this->sc_temp_vg_cpfseg = (isset($_SESSION['vg_cpfseg'])) ? $_SESSION['vg_cpfseg'] : "";}
if (!isset($_SESSION['rsvp_global'])) {$_SESSION['rsvp_global'] = "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['parm1'])) {$_SESSION['parm1'] = "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($_SESSION['vg_menu_item'])) {$_SESSION['vg_menu_item'] = "";}
if (!isset($this->sc_temp_vg_menu_item)) {$this->sc_temp_vg_menu_item = (isset($_SESSION['vg_menu_item'])) ? $_SESSION['vg_menu_item'] : "";}
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';

echo '<h2>&nbsp;&nbsp;BRSVP - Eventos</h2>';

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

$valor_y = 'Y';
$id = $this->sc_temp_vg_usuario_id;
$this->sc_temp_vg_cpfseg = '';
$sql = "
  	SELECT 
		usuario_id,		
		usuario_cpf
	FROM	
		usuarios_rsvp 
	WHERE
		usuario_id = ".$this->Db->qstr($id)." 
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
	$this->sc_temp_vg_cpfseg = $this->rs[0][1];
	$continua = $this->CheckLog($this->sc_temp_vg_usuario_id);		
	if ($continua == 'sair') {
		 unset($_SESSION['vg_usuario_id']);
 unset($this->sc_temp_vg_usuario_id);
 unset($_SESSION['vg_menu_item']);
 unset($this->sc_temp_vg_menu_item);
 unset($_SESSION['parm1']);
 unset($this->sc_temp_parm1);
 unset($_SESSION['vg_evento_id']);
 unset($this->sc_temp_vg_evento_id);
 unset($_SESSION['rsvp_global']);
 unset($this->sc_temp_rsvp_global);
;
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Acesso Negado!grd_eventos_rsvp 11";
;	
		if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
 if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_eventos_rsvp";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['sc_outra_jan'] = false;
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
        action="grid_eventos_rsvp_fim.php"
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
} else {
		$sqlupd = "
			UPDATE
				rsvpses_log	
			SET
				logado = ".$this->Db->qstr($valor_y)."
			WHERE
				id_usuario = ".$this->Db->qstr($this->sc_temp_vg_usuario_id)."		
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
	
} else {
	 unset($_SESSION['vg_usuario_id']);
 unset($this->sc_temp_vg_usuario_id);
 unset($_SESSION['vg_evento_id']);
 unset($this->sc_temp_vg_evento_id);
 unset($_SESSION['vg_cpfseg']);
 unset($this->sc_temp_vg_cpfseg);
 unset($_SESSION['rsvp_global']);
 unset($this->sc_temp_rsvp_global);
;
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Acesso Negado! grd_eventos_rsvp 12";
;	
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
 if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_eventos_rsvp";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['sc_outra_jan'] = false;
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
        action="grid_eventos_rsvp_fim.php"
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




$this->usuario_login  = $this->sc_temp_vg_usuario_id;
$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
$this->RetNivel($usunivel);

$this->delCpfDup();

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['embutida'])
      { 
          $this->Json_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $json_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      }
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT evento_nome, str_replace (convert(char(10),evento_dt_realizacao,102), '.', '-') + ' ' + convert(char(8),evento_dt_realizacao,20), str_replace (convert(char(10),evento_dt_conclusao,102), '.', '-') + ' ' + convert(char(8),evento_dt_conclusao,20), evento_status, evento_logo, evento_id, evento_id_interno, evento_id_complementar, evento_idioma, hotel_ok, grupo_usr_ok, empresa_ok, usuario_ok, ciaerea_ok, tour_ok, programacao_ok, regional_ok, participante_ok, id_app from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT evento_nome, evento_dt_realizacao, evento_dt_conclusao, evento_status, evento_logo, evento_id, evento_id_interno, evento_id_complementar, evento_idioma, hotel_ok, grupo_usr_ok, empresa_ok, usuario_ok, ciaerea_ok, tour_ok, programacao_ok, regional_ok, participante_ok, id_app from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT evento_nome, convert(char(23),evento_dt_realizacao,121), convert(char(23),evento_dt_conclusao,121), evento_status, evento_logo, evento_id, evento_id_interno, evento_id_complementar, evento_idioma, hotel_ok, grupo_usr_ok, empresa_ok, usuario_ok, ciaerea_ok, tour_ok, programacao_ok, regional_ok, participante_ok, id_app from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT evento_nome, evento_dt_realizacao, evento_dt_conclusao, evento_status, evento_logo, evento_id, evento_id_interno, evento_id_complementar, evento_idioma, hotel_ok, grupo_usr_ok, empresa_ok, usuario_ok, ciaerea_ok, tour_ok, programacao_ok, regional_ok, participante_ok, id_app from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT evento_nome, EXTEND(evento_dt_realizacao, YEAR TO DAY), EXTEND(evento_dt_conclusao, YEAR TO DAY), evento_status, evento_logo, evento_id, evento_id_interno, evento_id_complementar, evento_idioma, hotel_ok, grupo_usr_ok, empresa_ok, usuario_ok, ciaerea_ok, tour_ok, programacao_ok, regional_ok, participante_ok, id_app from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT evento_nome, evento_dt_realizacao, evento_dt_conclusao, evento_status, evento_logo, evento_id, evento_id_interno, evento_id_complementar, evento_idioma, hotel_ok, grupo_usr_ok, empresa_ok, usuario_ok, ciaerea_ok, tour_ok, programacao_ok, regional_ok, participante_ok, id_app from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['order_grid'];
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
      $this->json_registro = array();
      $this->SC_seq_json   = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->evento_nome = $rs->fields[0] ;  
         $this->evento_dt_realizacao = $rs->fields[1] ;  
         $this->evento_dt_conclusao = $rs->fields[2] ;  
         $this->evento_status = $rs->fields[3] ;  
         $this->evento_logo = $rs->fields[4] ;  
         $this->evento_id = $rs->fields[5] ;  
         $this->evento_id = (string)$this->evento_id;
         $this->evento_id_interno = $rs->fields[6] ;  
         $this->evento_id_complementar = $rs->fields[7] ;  
         $this->evento_idioma = $rs->fields[8] ;  
         $this->hotel_ok = $rs->fields[9] ;  
         $this->grupo_usr_ok = $rs->fields[10] ;  
         $this->empresa_ok = $rs->fields[11] ;  
         $this->usuario_ok = $rs->fields[12] ;  
         $this->ciaerea_ok = $rs->fields[13] ;  
         $this->tour_ok = $rs->fields[14] ;  
         $this->programacao_ok = $rs->fields[15] ;  
         $this->regional_ok = $rs->fields[16] ;  
         $this->participante_ok = $rs->fields[17] ;  
         $this->id_app = $rs->fields[18] ;  
         $this->evento_logo = "";
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$this->sc_temp_vg_evento_id = $this->evento_id ;
$this->evento_id_disp  = $this->evento_id ;


if($this->participante_ok  === '') {		
	$this->NM_cmp_hidden["participante_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["participante_id"] = 'off'; }		
	$this->NM_cmp_hidden["participante_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["participante_gray"] = 'on'; }		
} else {
	$this->NM_cmp_hidden["participante_id"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["participante_id"] = 'on'; }		
	$this->NM_cmp_hidden["participante_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["participante_gray"] = 'off'; }		
}	

if($this->hotel_ok  === '') {
	$this->NM_cmp_hidden["hotel_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["hotel_id"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["hotel_gray"] = 'on'; }		
} else {
	$this->NM_cmp_hidden["hotel_id"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["hotel_id"] = 'on'; }		
	$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["hotel_gray"] = 'off'; }		
}	
if($this->grupo_usr_ok  === '') {
	$this->NM_cmp_hidden["publico_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["publico_id"] = 'off'; }		
	$this->NM_cmp_hidden["publico_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["publico_gray"] = 'on'; }		
} else {
	$this->NM_cmp_hidden["publico_id"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["publico_id"] = 'on'; }		
	$this->NM_cmp_hidden["publico_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["publico_gray"] = 'off'; }		
}	
if($this->empresa_ok  === '') {
	$this->NM_cmp_hidden["empresa_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["empresa_id"] = 'off'; }		
	$this->NM_cmp_hidden["empresa_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["empresa_gray"] = 'on'; }		
} else {
	$this->NM_cmp_hidden["empresa_id"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["empresa_id"] = 'on'; }		
	$this->NM_cmp_hidden["empresa_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["empresa_gray"] = 'off'; }		
}	
if($this->usuario_ok  === '') {
	$this->NM_cmp_hidden["usuario_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["usuario_id"] = 'off'; }		
	$this->NM_cmp_hidden["usuario_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["usuario_gray"] = 'on'; }		
} else {
	$this->NM_cmp_hidden["usuario_id"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["usuario_id"] = 'on'; }		
	$this->NM_cmp_hidden["usuario_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["usuario_gray"] = 'off'; }		
}	
if($this->ciaerea_ok  === '') {
	$this->NM_cmp_hidden["ciaerea_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["ciaerea_id"] = 'off'; }		
	$this->NM_cmp_hidden["ciaerea_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["ciaerea_gray"] = 'on'; }		
} else {
	$this->NM_cmp_hidden["ciaerea_id"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["ciaerea_id"] = 'on'; }		
	$this->NM_cmp_hidden["ciaerea_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["ciaerea_gray"] = 'off'; }		
}
if($this->tour_ok  == '') {
	$this->NM_cmp_hidden["tour_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["tour_id"] = 'off'; }		
	$this->NM_cmp_hidden["tour_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["tour_gray"] = 'on'; }		
} else {
	$this->NM_cmp_hidden["tour_id"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["tour_id"] = 'on'; }		
	$this->NM_cmp_hidden["tour_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["tour_gray"] = 'off'; }		
}	
if($this->regional_ok  === '') {
	$this->NM_cmp_hidden["regional_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["regional_id"] = 'off'; }		
	$this->NM_cmp_hidden["regional_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["regional_gray"] = 'on'; }		
} else {
	$this->NM_cmp_hidden["regional_id"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["regional_id"] = 'on'; }		
	$this->NM_cmp_hidden["regional_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["regional_gray"] = 'off'; }		
}	
if($this->programacao_ok  === '') {
	$this->NM_cmp_hidden["prog_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["prog_id"] = 'off'; }		
	$this->NM_cmp_hidden["prog_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["prog_gray"] = 'on'; }		
} else {
	$this->NM_cmp_hidden["prog_id"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["prog_id"] = 'on'; }		
	$this->NM_cmp_hidden["prog_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['php_cmp_sel']["prog_gray"] = 'off'; }		
}


switch($this->evento_status ) {
	case 'ATIVO':
    	$this->NM_field_style["evento_status"] = "background-color:;color:#81ddc2;font-weight:bold;";
		
		break;
	case 'CONCLUIDO':
		$this->NM_field_style["evento_status"] = "background-color:;color:#f1d327;font-weight:bold;";
		break;		
	case 'ENCERRADO':
		$this->NM_field_style["evento_status"] = "background-color:;color:#f57f2e;";
		break;				
	case 'SUSPENSO':
		$this->NM_field_style["evento_status"] = "background-color:;color:#f72b2b;";
		break;				
}	

if($this->id_app  <> '') {
	if($status_app  == 'ongoing') {
		$token = getTokenApp();
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.beinvited.com.br/backoffice-api/events/'.$this->id_app ,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
			'Authorization: Bearer '.$token
		  ),
		));
		$response = curl_exec($curl);
		$dataResponse = json_decode($response);
		$array = json_decode(json_encode($dataResponse), true);
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);	
		if ($httpCode >= 200 && $httpCode < 300) {
			$retorno = $array['event']['status'];
			if($retorno <> 'ongoing') {
				if($retorno == 'past') {
					$retorno = 'completed';
				}								
				if($retorno == 'completed') {
					$v_evento_status = 'CONCLUIDO';	
				} else {
					$v_evento_status = 'ENCERRADO';
				}					
				$sqlupdate = "
					UPDATE 
						eventos_rsvp
					SET 
						status_app = ".$this->Db->qstr($retorno).",
						evento_status = ".$this->Db->qstr($v_evento_status)."
					WHERE 
						evento_id = ".$this->Db->qstr($this->evento_id )."
				";
				
     $nm_select = $sqlupdate; 
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
	}	
}


$this->GetSaldoBloq($this->sc_temp_vg_evento_id,'IDA');
$this->GetSaldoBloq($this->sc_temp_vg_evento_id,'VOLTA');
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->SC_seq_json++;
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['embutida'])
      { 
          $_SESSION['scriptcase']['export_return'] = $this->json_registro;
      }
      else
      { 
          $result_json = json_encode($this->json_registro, JSON_UNESCAPED_UNICODE);
          if ($result_json == false)
          {
              $oJson = new Services_JSON();
              $result_json = $oJson->encode($this->json_registro);
          }
          fwrite($json_f, $result_json);
          fclose($json_f);
          if ($this->Tem_json_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "grid_eventos_rsvp_res_json.class.php");
              $this->Res = new grid_eventos_rsvp_res_json();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_res_grid'] = true;
              $this->Res->monta_json();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Json_password != "" || $this->Tem_json_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Json_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Json_f, ' ')) ? " \"" . $this->Json_f . "\"" :  $this->Json_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                  {
                      chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                  }
                  else
                  {
                      chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                  }
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
              }
              if (!empty($str_zip)) {
                  exec($str_zip);
              }
              // ----- ZIP log
              $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
              if ($fp)
              {
                  @fwrite($fp, $str_zip . "\r\n\r\n");
                  @fclose($fp);
              }
              unlink($Arq_input);
              $this->Arquivo = $this->Arq_zip;
              $this->Json_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_json_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_res_file']['json'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  if (!empty($str_zip)) {
                      exec($str_zip);
                  }
                  // ----- ZIP log
                  $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
                  if ($fp)
                  {
                      @fwrite($fp, $str_zip . "\r\n\r\n");
                      @fclose($fp);
                  }
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_res_file']['json']);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- evento_id_disp
   function NM_export_evento_id_disp()
   {
         $this->evento_id_disp = NM_charset_to_utf8($this->evento_id_disp);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_id_disp'])) ? $this->New_label['evento_id_disp'] : "Cód. EVT"; 
         }
         else
         {
             $SC_Label = "evento_id_disp"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_id_disp;
   }
   //----- evento_nome
   function NM_export_evento_nome()
   {
         $this->evento_nome = NM_charset_to_utf8($this->evento_nome);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_nome'])) ? $this->New_label['evento_nome'] : "Evento"; 
         }
         else
         {
             $SC_Label = "evento_nome"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_nome;
   }
   //----- evento_dt_realizacao
   function NM_export_evento_dt_realizacao()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->evento_dt_realizacao;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->evento_dt_realizacao, "YYYY-MM-DD  ");
                 $this->evento_dt_realizacao = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_dt_realizacao'])) ? $this->New_label['evento_dt_realizacao'] : "Realização"; 
         }
         else
         {
             $SC_Label = "evento_dt_realizacao"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_dt_realizacao;
   }
   //----- evento_dt_conclusao
   function NM_export_evento_dt_conclusao()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->evento_dt_conclusao;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->evento_dt_conclusao, "YYYY-MM-DD  ");
                 $this->evento_dt_conclusao = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_dt_conclusao'])) ? $this->New_label['evento_dt_conclusao'] : "Conclusão"; 
         }
         else
         {
             $SC_Label = "evento_dt_conclusao"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_dt_conclusao;
   }
   //----- evento_status
   function NM_export_evento_status()
   {
         $this->evento_status = NM_charset_to_utf8($this->evento_status);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_status'])) ? $this->New_label['evento_status'] : "Status"; 
         }
         else
         {
             $SC_Label = "evento_status"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_status;
   }
   //----- evento_logo
   function NM_export_evento_logo()
   {
         $this->evento_logo = NM_charset_to_utf8($this->evento_logo);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_logo'])) ? $this->New_label['evento_logo'] : "Logo"; 
         }
         else
         {
             $SC_Label = "evento_logo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_logo;
   }
   //----- participante_id
   function NM_export_participante_id()
   {
         $this->participante_id = NM_charset_to_utf8($this->participante_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['participante_id'])) ? $this->New_label['participante_id'] : "Particip."; 
         }
         else
         {
             $SC_Label = "participante_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->participante_id;
   }
   //----- participante_gray
   function NM_export_participante_gray()
   {
         $this->participante_gray = NM_charset_to_utf8($this->participante_gray);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['participante_gray'])) ? $this->New_label['participante_gray'] : "Particip."; 
         }
         else
         {
             $SC_Label = "participante_gray"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->participante_gray;
   }
   //----- empresa_id
   function NM_export_empresa_id()
   {
         $this->empresa_id = NM_charset_to_utf8($this->empresa_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['empresa_id'])) ? $this->New_label['empresa_id'] : "Empresas"; 
         }
         else
         {
             $SC_Label = "empresa_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->empresa_id;
   }
   //----- empresa_gray
   function NM_export_empresa_gray()
   {
         $this->empresa_gray = NM_charset_to_utf8($this->empresa_gray);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['empresa_gray'])) ? $this->New_label['empresa_gray'] : "Empresas"; 
         }
         else
         {
             $SC_Label = "empresa_gray"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->empresa_gray;
   }
   //----- usuario_id
   function NM_export_usuario_id()
   {
         $this->usuario_id = NM_charset_to_utf8($this->usuario_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['usuario_id'])) ? $this->New_label['usuario_id'] : "Usuários"; 
         }
         else
         {
             $SC_Label = "usuario_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->usuario_id;
   }
   //----- usuario_gray
   function NM_export_usuario_gray()
   {
         $this->usuario_gray = NM_charset_to_utf8($this->usuario_gray);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['usuario_gray'])) ? $this->New_label['usuario_gray'] : "Usuários"; 
         }
         else
         {
             $SC_Label = "usuario_gray"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->usuario_gray;
   }
   //----- publico_id
   function NM_export_publico_id()
   {
         $this->publico_id = NM_charset_to_utf8($this->publico_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['publico_id'])) ? $this->New_label['publico_id'] : "Públicos"; 
         }
         else
         {
             $SC_Label = "publico_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->publico_id;
   }
   //----- publico_gray
   function NM_export_publico_gray()
   {
         $this->publico_gray = NM_charset_to_utf8($this->publico_gray);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['publico_gray'])) ? $this->New_label['publico_gray'] : "Públicos"; 
         }
         else
         {
             $SC_Label = "publico_gray"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->publico_gray;
   }
   //----- hotel_id
   function NM_export_hotel_id()
   {
         $this->hotel_id = NM_charset_to_utf8($this->hotel_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hotel_id'])) ? $this->New_label['hotel_id'] : "Hotéis"; 
         }
         else
         {
             $SC_Label = "hotel_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hotel_id;
   }
   //----- hotel_gray
   function NM_export_hotel_gray()
   {
         $this->hotel_gray = NM_charset_to_utf8($this->hotel_gray);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hotel_gray'])) ? $this->New_label['hotel_gray'] : "Hotéis"; 
         }
         else
         {
             $SC_Label = "hotel_gray"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hotel_gray;
   }
   //----- ciaerea_id
   function NM_export_ciaerea_id()
   {
         $this->ciaerea_id = NM_charset_to_utf8($this->ciaerea_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ciaerea_id'])) ? $this->New_label['ciaerea_id'] : "Bloqueio"; 
         }
         else
         {
             $SC_Label = "ciaerea_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ciaerea_id;
   }
   //----- ciaerea_gray
   function NM_export_ciaerea_gray()
   {
         $this->ciaerea_gray = NM_charset_to_utf8($this->ciaerea_gray);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ciaerea_gray'])) ? $this->New_label['ciaerea_gray'] : "Bloqueio"; 
         }
         else
         {
             $SC_Label = "ciaerea_gray"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ciaerea_gray;
   }
   //----- tour_id
   function NM_export_tour_id()
   {
         $this->tour_id = NM_charset_to_utf8($this->tour_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tour_id'])) ? $this->New_label['tour_id'] : "Tours"; 
         }
         else
         {
             $SC_Label = "tour_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tour_id;
   }
   //----- tour_gray
   function NM_export_tour_gray()
   {
         $this->tour_gray = NM_charset_to_utf8($this->tour_gray);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tour_gray'])) ? $this->New_label['tour_gray'] : "Tours"; 
         }
         else
         {
             $SC_Label = "tour_gray"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tour_gray;
   }
   //----- prog_id
   function NM_export_prog_id()
   {
         $this->prog_id = NM_charset_to_utf8($this->prog_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['prog_id'])) ? $this->New_label['prog_id'] : "Prog."; 
         }
         else
         {
             $SC_Label = "prog_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->prog_id;
   }
   //----- prog_gray
   function NM_export_prog_gray()
   {
         $this->prog_gray = NM_charset_to_utf8($this->prog_gray);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['prog_gray'])) ? $this->New_label['prog_gray'] : "Prog."; 
         }
         else
         {
             $SC_Label = "prog_gray"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->prog_gray;
   }
   //----- regional_id
   function NM_export_regional_id()
   {
         $this->regional_id = NM_charset_to_utf8($this->regional_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['regional_id'])) ? $this->New_label['regional_id'] : "Regionais"; 
         }
         else
         {
             $SC_Label = "regional_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->regional_id;
   }
   //----- regional_gray
   function NM_export_regional_gray()
   {
         $this->regional_gray = NM_charset_to_utf8($this->regional_gray);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['regional_gray'])) ? $this->New_label['regional_gray'] : "Regionais"; 
         }
         else
         {
             $SC_Label = "regional_gray"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->regional_gray;
   }
   //----- substituido
   function NM_export_substituido()
   {
         $this->substituido = NM_charset_to_utf8($this->substituido);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['substituido'])) ? $this->New_label['substituido'] : "Substituições"; 
         }
         else
         {
             $SC_Label = "substituido"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->substituido;
   }
   //----- evento_id
   function NM_export_evento_id()
   {
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_id'])) ? $this->New_label['evento_id'] : "Cód. Evento"; 
         }
         else
         {
             $SC_Label = "evento_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_id;
   }
   //----- evento_id_interno
   function NM_export_evento_id_interno()
   {
         $this->evento_id_interno = NM_charset_to_utf8($this->evento_id_interno);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_id_interno'])) ? $this->New_label['evento_id_interno'] : "Código Interno"; 
         }
         else
         {
             $SC_Label = "evento_id_interno"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_id_interno;
   }
   //----- evento_id_complementar
   function NM_export_evento_id_complementar()
   {
         $this->evento_id_complementar = NM_charset_to_utf8($this->evento_id_complementar);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_id_complementar'])) ? $this->New_label['evento_id_complementar'] : "Evento Id Complementar"; 
         }
         else
         {
             $SC_Label = "evento_id_complementar"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_id_complementar;
   }
   //----- evento_idioma
   function NM_export_evento_idioma()
   {
         $this->evento_idioma = NM_charset_to_utf8($this->evento_idioma);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_idioma'])) ? $this->New_label['evento_idioma'] : "Idioma"; 
         }
         else
         {
             $SC_Label = "evento_idioma"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_idioma;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>BRSVP - Cadastro de Eventos :: JSON</TITLE>
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
   <td class="scExportTitle" style="height: 25px">JSON</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_eventos_rsvp_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_eventos_rsvp"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_eventos_rsvp']['json_return']); ?>"> 
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

function redimen()
{
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  





$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}


function CheckLog($chave) {
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  		
		date_default_timezone_set('America/Sao_Paulo');
		$ret = 'ok';
		$tipo = strlen($chave);
		if ($tipo >= 11) {
			$sql = "
				SELECT
					cod_usuario
				FROM
					rsvpses_log
				WHERE
					cod_usuario = ".$this->Db->qstr($chave)."
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
	
			if (isset($this->rs[0][0])) {	
				$ret = 'ok';	
			} else {
				$ret = 'sair';	
			}					
		} else {	
			$sql = "
				SELECT
					id_usuario
				FROM
					rsvpses_log
				WHERE
					id_usuario = ".$this->Db->qstr($chave)."
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
	
			if (isset($this->rs[0][0])) {	
				$ret = 'ok';	
			} else {
				$ret = 'sair';	
			}					
		}	
		return $ret;
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}


function delCpfDup() {
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  
	$sql = "
		DELETE t1
			FROM pessoas_rsvp t1
			INNER JOIN pessoas_rsvp t2 
			WHERE 
				t1.pessoa_id < t2.pessoa_id
			AND t1.pessoa_cpf = t2.pessoa_cpf
			AND t1.pessoa_nome = t2.pessoa_nome
	";
	
     $nm_select = $sql; 
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
                                                                                      				
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	return true;
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}


function GetSaldoBloq($evento_id, $direcao) {
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  	
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
			aereo_id_evento = ".$this->Db->qstr($this->evento_id)."	
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
						bloqueio_id = ".$this->Db->qstr($bloqueio_id)." 
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
				bloq_evento_id = ".$this->Db->qstr($this->evento_id)."	
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
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}


function GetSaldoHotel($evento_id,$id_hotel) {
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  	
	date_default_timezone_set('America/Sao_Paulo');
	$valor_y = 'Y';		
	$valor_zero = '0';
	$ret = 0;
	$valor_room = 'SIM';
		
	$sql = "
	SELECT
		bh_id_evento,		
		bh_id_hotel,			
		bh_acomodacao,		
		bh_categoria,		
		bh_qtd_quartos,		
		bh_saldo_quartos,
		id_bh_hotel
	FROM	
		bloqueio_hoteis_rsvp
	WHERE	
		bh_id_evento = ".$this->Db->qstr($this->evento_id)."	
	AND 
	    bh_id_hotel = ".$this->Db->qstr($id_hotel)."	
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
	             
	$reg_mestre = sizeof($this->rs );
	
	if ($reg_mestre > 0) {			
		for ($i=0;$i<$reg_mestre;++$i) {	
			$evento 	= $this->rs[$i][0];
			$hotel		= $this->rs[$i][1];
			$acomoda	= $this->rs[$i][2];
			$categor	= $this->rs[$i][3];
			$qtdquar	= $this->rs[$i][4];
			$salquar	= $this->rs[$i][5];
			$codbloq    = $this->rs[$i][6];
			
			$sqlbh = "
			SELECT    
				COUNT(hospedagem_id) as qtde,
				conta_roomlist
			FROM
				hospedagem_rsvp		
			WHERE 
				hosp_id_evento = ".$this->Db->qstr($evento)." 
			AND 
				hosp_id_hotel = ".$this->Db->qstr($hotel)."
			AND  
				hosp_acomodacao = ".$this->Db->qstr($acomoda)." 
			AND  
				hosp_categoria = ".$this->Db->qstr($categor)." 
			AND
				hosp_status = ".$this->Db->qstr($valor_y)."		
			AND 	
				conta_roomlist = ".$this->Db->qstr($valor_room)."	
			AND
				id_bloqueio_hotel = ".$this->Db->qstr($codbloq)."	
			";	
			 
      $nm_select = $sqlbh; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs2 = false;
          $this->rs2_erro = $this->Db->ErrorMsg();
      } 
	
			if (isset($this->rs2[0][0])) {
				$qtdeachou = $this->rs2[0][0];				
				$saldo = $qtdquar - $qtdeachou;
				$ret = $saldo; 				
			} else {
				$qtdeachou = 0;
				$ret = 0;
			}	
			
			if ($qtdeachou > 0) {						
				$sqlbh2 = "
				UPDATE
					bloqueio_hoteis_rsvp 
				SET
					bh_saldo_quartos = ".$this->Db->qstr($saldo)."				
				WHERE
					bh_id_evento = ".$this->Db->qstr($evento)."		
				AND
					bh_id_hotel = ".$this->Db->qstr($hotel)."
				AND
					bh_acomodacao = ".$this->Db->qstr($acomoda)."
				AND
					bh_categoria = ".$this->Db->qstr($categor)."	
				AND
					id_bh_hotel = ".$this->Db->qstr($codbloq)."	
				";
				
     $nm_select = $sqlbh2; 
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
	}	
	return $ret;
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}


function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  		
		date_default_timezone_set('America/Sao_Paulo');
		$ret = false;
		$sqli = "					
		INSERT INTO
			rsvp_log
			(data_hora,
			ip,
			id_usuario,
			cod_usuario,
			modulo,
			aplicacao,
			acao,
			campo_id,	
			valor_campo_id,	
			campo_cpf,     	
			valor_campo_cpf,	
			campo_evt,
			valor_campo_evt,
			tabela,
			obs,
			csql)							
		VALUES
			(".$this->Db->qstr($v_hora_now).", 				 
			".$this->Db->qstr($v_ip_usuario).",               
			".$this->Db->qstr($v_id_usuario).",         	
			".$this->Db->qstr($v_global_cpf).",              
			".$this->Db->qstr($v_modulo).",     	
			".$this->Db->qstr($v_aplicacao).",  	                     
			".$this->Db->qstr($v_acao).",    
			".$this->Db->qstr($v_campo_id).",         	
			".$this->Db->qstr($v_vl_campo_id).",	             
			".$this->Db->qstr($v_campo_cpf).",                   	
			".$this->Db->qstr($v_vl_campo_cpf).",               	
			".$this->Db->qstr($v_campo_evt).",               
			".$this->Db->qstr($v_vl_campo_evt).",						
			".$this->Db->qstr($v_tabela).",
			".$this->Db->qstr($v_obs).",
			".$this->Db->qstr($v_sql).")									
		";		
		
     $nm_select = $sqli; 
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
      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
		
		$ret = true;
		return $ret;
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$fip_usuario = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$fip_usuario = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$fip_usuario = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$fip_usuario = $_SERVER['REMOTE_ADDR'];
		}		
		return $fip_usuario;
	
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_eventos_rsvp']['contr_erro'] = 'off';
}

}

?>
