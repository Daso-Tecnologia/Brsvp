<?php

class grid_trinaer_rsvp_r_xml
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
   var $count_ger;

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("pt_br");
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
   function monta_xml()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xml_f);
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
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['opcao'] = "";
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
                   nm_limpa_str_grid_trinaer_rsvp_r($cadapar[1]);
                   nm_protect_num_grid_trinaer_rsvp_r($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_trinaer_rsvp_r']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_trinaer_rsvp_r($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_trinaer_rsvp_r($_SESSION["vg_usuario_id"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_trinaer_rsvp_r($_SESSION["rsvp_global"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_trinaer_rsvp_r($_SESSION["vg_cpfseg"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_trinaer_rsvp_r($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_trinaer_rsvp_r($_SESSION["parm1"]);
      }
      if (isset($parm2)) 
      {
          $_SESSION['parm2'] = $parm2;
          nm_limpa_str_grid_trinaer_rsvp_r($_SESSION["parm2"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->New_Format  = true;
      $this->Xml_tag_label = true;
      $this->Tem_xml_res = false;
      $this->Xml_password = "";
      if (isset($_REQUEST['nm_xml_tag']) && !empty($_REQUEST['nm_xml_tag']))
      {
          $this->New_Format = ($_REQUEST['nm_xml_tag'] == "tag") ? true : false;
      }
      if (isset($_REQUEST['nm_xml_label']) && !empty($_REQUEST['nm_xml_label']))
      {
          $this->Xml_tag_label = ($_REQUEST['nm_xml_label'] == "S") ? true : false;
      }
      $this->Tem_xml_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_xml_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['SC_Gb_Free_cmp']))
      {
          $this->Tem_xml_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_trinaer_rsvp_r/grid_trinaer_rsvp_r_res_xml.class.php"))
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_label']))
      {
          $this->Xml_tag_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_label'];
          $this->New_Format    = true;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_trinaer_rsvp_r_total.class.php"); 
      $this->Tot      = new grid_trinaer_rsvp_r_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['tot_geral'][1];
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_trinaer_rsvp_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_return']);
          if ($this->Tem_xml_res) {
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
      $this->nm_data    = new nm_data("pt_br");
      $this->Arquivo      = "sc_xml";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_grid_trinaer_rsvp_r.zip";
      $this->Arquivo     .= "_grid_trinaer_rsvp_r";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "grid_trinaer_rsvp_r.xml";
      $this->Tit_zip      = "grid_trinaer_rsvp_r.zip";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
      }
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
   function grava_arquivo()
   {
      global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_trinaer_rsvp_r']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_trinaer_rsvp_r']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_trinaer_rsvp_r']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->cia_aerea_sigla = (isset($Busca_temp['cia_aerea_sigla'])) ? $Busca_temp['cia_aerea_sigla'] : ""; 
          $tmp_pos = (is_string($this->cia_aerea_sigla)) ? strpos($this->cia_aerea_sigla, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cia_aerea_sigla))
          {
              $this->cia_aerea_sigla = substr($this->cia_aerea_sigla, 0, $tmp_pos);
          }
          $this->num_voo = (isset($Busca_temp['num_voo'])) ? $Busca_temp['num_voo'] : ""; 
          $tmp_pos = (is_string($this->num_voo)) ? strpos($this->num_voo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->num_voo))
          {
              $this->num_voo = substr($this->num_voo, 0, $tmp_pos);
          }
          $this->origem_sigla = (isset($Busca_temp['origem_sigla'])) ? $Busca_temp['origem_sigla'] : ""; 
          $tmp_pos = (is_string($this->origem_sigla)) ? strpos($this->origem_sigla, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->origem_sigla))
          {
              $this->origem_sigla = substr($this->origem_sigla, 0, $tmp_pos);
          }
          $this->destino_sigla = (isset($Busca_temp['destino_sigla'])) ? $Busca_temp['destino_sigla'] : ""; 
          $tmp_pos = (is_string($this->destino_sigla)) ? strpos($this->destino_sigla, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->destino_sigla))
          {
              $this->destino_sigla = substr($this->destino_sigla, 0, $tmp_pos);
          }
          $this->participante = (isset($Busca_temp['participante'])) ? $Busca_temp['participante'] : ""; 
          $tmp_pos = (is_string($this->participante)) ? strpos($this->participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->participante))
          {
              $this->participante = substr($this->participante, 0, $tmp_pos);
          }
          $this->publico_dsc = (isset($Busca_temp['publico_dsc'])) ? $Busca_temp['publico_dsc'] : ""; 
          $tmp_pos = (is_string($this->publico_dsc)) ? strpos($this->publico_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico_dsc))
          {
              $this->publico_dsc = substr($this->publico_dsc, 0, $tmp_pos);
          }
          $this->regional_dsc = (isset($Busca_temp['regional_dsc'])) ? $Busca_temp['regional_dsc'] : ""; 
          $tmp_pos = (is_string($this->regional_dsc)) ? strpos($this->regional_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->regional_dsc))
          {
              $this->regional_dsc = substr($this->regional_dsc, 0, $tmp_pos);
          }
          $this->hotel_dsc = (isset($Busca_temp['hotel_dsc'])) ? $Busca_temp['hotel_dsc'] : ""; 
          $tmp_pos = (is_string($this->hotel_dsc)) ? strpos($this->hotel_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_dsc))
          {
              $this->hotel_dsc = substr($this->hotel_dsc, 0, $tmp_pos);
          }
          $this->comprado_belvitur = (isset($Busca_temp['comprado_belvitur'])) ? $Busca_temp['comprado_belvitur'] : ""; 
          $tmp_pos = (is_string($this->comprado_belvitur)) ? strpos($this->comprado_belvitur, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->comprado_belvitur))
          {
              $this->comprado_belvitur = substr($this->comprado_belvitur, 0, $tmp_pos);
          }
          $this->localizador = (isset($Busca_temp['localizador'])) ? $Busca_temp['localizador'] : ""; 
          $tmp_pos = (is_string($this->localizador)) ? strpos($this->localizador, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->localizador))
          {
              $this->localizador = substr($this->localizador, 0, $tmp_pos);
          }
          $this->eticket = (isset($Busca_temp['eticket'])) ? $Busca_temp['eticket'] : ""; 
          $tmp_pos = (is_string($this->eticket)) ? strpos($this->eticket, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->eticket))
          {
              $this->eticket = substr($this->eticket, 0, $tmp_pos);
          }
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
if (!isset($_SESSION['parm2'])) {$_SESSION['parm2'] = "";}
if (!isset($this->sc_temp_parm2)) {$this->sc_temp_parm2 = (isset($_SESSION['parm2'])) ? $_SESSION['parm2'] : "";}
if (!isset($_SESSION['parm1'])) {$_SESSION['parm1'] = "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['rsvp_global'])) {$_SESSION['rsvp_global'] = "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
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
$resultado = 'ERRO';
$this->sc_temp_vg_evento_id = $this->sc_temp_parm1;
$_tipoPessoa = $this->sc_temp_parm2;
$this->titulo  = 'Transfer IN Aéreo Participantes';

$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
if ($usunivel <> 'ADMINISTRADOR') {
	$sql="
		SELECT
			evento_id,
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
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_parm2)) {$_SESSION['parm2'] = $this->sc_temp_parm2;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_trinaer_rsvp_r";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['sc_outra_jan'] = false;
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
        action="grid_trinaer_rsvp_r_fim.php"
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

$resultado  = $this->PrepReltrin($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'P',$usunivel);
$resultado2 = $this->PrepReltrin($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'A',$usunivel);


if ($resultado == 'ADICIONA OK') {
	$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
	$this->RetNivel($usunivel);
	$this->id_evento  = $this->sc_temp_vg_evento_id;
	$this->id_usuario_relato  = $this->sc_temp_vg_usuario_id;
} else {
	$params = array(
	'title' => 'Atenção!',
	'type' => 'warning',
	'timer' => '5000',
	'showConfirmButton' => 'false',
	'position' => 'center',
	'toast' => 'true'
	);
	$this->nm_mens_alert[] = "Erro ao carregar o relatório Transfer In!";$this->nm_params_alert[] = $params;}

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_parm2)) {$_SESSION['parm2'] = $this->sc_temp_parm2;}
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida'])
      { 
          $xml_charset = $_SESSION['scriptcase']['charset'];
          $this->Xml_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $xml_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
          fwrite($xml_f, "<?xml version=\"1.0\" encoding=\"$xml_charset\" ?>\r\n");
          fwrite($xml_f, "<root>\r\n");
          if ($this->Grava_view)
          {
              $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
              $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view, "w");
              fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
              fwrite($xml_v, "<root>\r\n");
          }
      }
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT tipo_transfer, id_evento, evento_dsc, str_replace (convert(char(10),data_saida,102), '.', '-') + ' ' + convert(char(8),data_saida,20), str_replace (convert(char(10),hora_saida,102), '.', '-') + ' ' + convert(char(8),hora_saida,20), str_replace (convert(char(10),data_chegada,102), '.', '-') + ' ' + convert(char(8),data_chegada,20), str_replace (convert(char(10),hora_chegada,102), '.', '-') + ' ' + convert(char(8),hora_chegada,20), cia_aerea_sigla, num_voo, origem_sigla, destino_sigla, participante, tipo_pessoa, publico_dsc, regional_dsc, hotel_dsc, comprado_belvitur, localizador, eticket, rg, cpf, str_replace (convert(char(10),data_nascimento,102), '.', '-') + ' ' + convert(char(8),data_nascimento,20), nota_gate, str_replace (convert(char(10),data_nota_gate,102), '.', '-') + ' ' + convert(char(8),data_nota_gate,20), status, cod_bloqueio, observacoes, id_trinaer, direcao, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT tipo_transfer, id_evento, evento_dsc, data_saida, hora_saida, data_chegada, hora_chegada, cia_aerea_sigla, num_voo, origem_sigla, destino_sigla, participante, tipo_pessoa, publico_dsc, regional_dsc, hotel_dsc, comprado_belvitur, localizador, eticket, rg, cpf, data_nascimento, nota_gate, data_nota_gate, status, cod_bloqueio, observacoes, id_trinaer, direcao, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT tipo_transfer, id_evento, evento_dsc, convert(char(23),data_saida,121), convert(char(23),hora_saida,121), convert(char(23),data_chegada,121), convert(char(23),hora_chegada,121), cia_aerea_sigla, num_voo, origem_sigla, destino_sigla, participante, tipo_pessoa, publico_dsc, regional_dsc, hotel_dsc, comprado_belvitur, localizador, eticket, rg, cpf, convert(char(23),data_nascimento,121), nota_gate, convert(char(23),data_nota_gate,121), status, cod_bloqueio, observacoes, id_trinaer, direcao, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT tipo_transfer, id_evento, evento_dsc, data_saida, hora_saida, data_chegada, hora_chegada, cia_aerea_sigla, num_voo, origem_sigla, destino_sigla, participante, tipo_pessoa, publico_dsc, regional_dsc, hotel_dsc, comprado_belvitur, localizador, eticket, rg, cpf, data_nascimento, nota_gate, data_nota_gate, status, cod_bloqueio, observacoes, id_trinaer, direcao, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT tipo_transfer, id_evento, evento_dsc, EXTEND(data_saida, YEAR TO DAY), hora_saida, EXTEND(data_chegada, YEAR TO DAY), hora_chegada, cia_aerea_sigla, num_voo, origem_sigla, destino_sigla, participante, tipo_pessoa, publico_dsc, regional_dsc, hotel_dsc, comprado_belvitur, localizador, eticket, rg, cpf, EXTEND(data_nascimento, YEAR TO DAY), nota_gate, EXTEND(data_nota_gate, YEAR TO DAY), status, cod_bloqueio, observacoes, id_trinaer, direcao, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT tipo_transfer, id_evento, evento_dsc, data_saida, hora_saida, data_chegada, hora_chegada, cia_aerea_sigla, num_voo, origem_sigla, destino_sigla, participante, tipo_pessoa, publico_dsc, regional_dsc, hotel_dsc, comprado_belvitur, localizador, eticket, rg, cpf, data_nascimento, nota_gate, data_nota_gate, status, cod_bloqueio, observacoes, id_trinaer, direcao, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['order_grid'];
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
      $this->xml_registro = "";
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida'])
         { 
             $this->xml_registro .= "<" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro = "<grid_trinaer_rsvp_r>\r\n";
         }
         else
         {
             $this->xml_registro = "<grid_trinaer_rsvp_r";
         }
         $this->tipo_transfer = $rs->fields[0] ;  
         $this->id_evento = $rs->fields[1] ;  
         $this->id_evento = (string)$this->id_evento;
         $this->evento_dsc = $rs->fields[2] ;  
         $this->data_saida = $rs->fields[3] ;  
         $this->hora_saida = $rs->fields[4] ;  
         $this->data_chegada = $rs->fields[5] ;  
         $this->hora_chegada = $rs->fields[6] ;  
         $this->cia_aerea_sigla = $rs->fields[7] ;  
         $this->num_voo = $rs->fields[8] ;  
         $this->origem_sigla = $rs->fields[9] ;  
         $this->destino_sigla = $rs->fields[10] ;  
         $this->participante = $rs->fields[11] ;  
         $this->tipo_pessoa = $rs->fields[12] ;  
         $this->publico_dsc = $rs->fields[13] ;  
         $this->regional_dsc = $rs->fields[14] ;  
         $this->hotel_dsc = $rs->fields[15] ;  
         $this->comprado_belvitur = $rs->fields[16] ;  
         $this->localizador = $rs->fields[17] ;  
         $this->eticket = $rs->fields[18] ;  
         $this->rg = $rs->fields[19] ;  
         $this->cpf = $rs->fields[20] ;  
         $this->data_nascimento = $rs->fields[21] ;  
         $this->nota_gate = $rs->fields[22] ;  
         $this->data_nota_gate = $rs->fields[23] ;  
         $this->status = $rs->fields[24] ;  
         $this->cod_bloqueio = $rs->fields[25] ;  
         $this->cod_bloqueio = (string)$this->cod_bloqueio;
         $this->observacoes = $rs->fields[26] ;  
         $this->id_trinaer = $rs->fields[27] ;  
         $this->id_trinaer = (string)$this->id_trinaer;
         $this->direcao = $rs->fields[28] ;  
         $this->id_usuario_relato = $rs->fields[29] ;  
         $this->id_usuario_relato = (string)$this->id_usuario_relato;
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$this->NM_field_style["participante"] = "background-color:;font-size:bold;color:#0033ff;";
$this->NM_field_style["hotel_dsc"] = "background-color:;font-size:bold;color:#009966;";
$this->NM_field_style["cpf"] = "background-color:;font-size:bold;color:#0099ff;";
$this->NM_field_style["status"] = "background-color:;font-size:bold;color:#ff6600;";
$this->NM_field_style["tipo_pessoa"] = "background-color:;font-size:bold;color:#0099ff;";

$this->NM_cmp_hidden["id_evento"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['php_cmp_sel']["id_evento"] = 'off'; }	
$this->NM_cmp_hidden["tipo_transfer"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['php_cmp_sel']["tipo_transfer"] = 'off'; }	
$this->NM_cmp_hidden["cpf"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['php_cmp_sel']["cpf"] = 'off'; }	
$this->NM_cmp_hidden["data_nota_gate"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['php_cmp_sel']["data_nota_gate"] = 'off'; }	
$this->NM_cmp_hidden["nota_gate"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['php_cmp_sel']["nota_gate"] = 'off'; }
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida'])
         { 
             $this->xml_registro .= "</" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro .= "</grid_trinaer_rsvp_r>\r\n";
         }
         else
         {
             $this->xml_registro .= " />\r\n";
         }
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida'])
         { 
             fwrite($xml_f, $this->xml_registro);
             if ($this->Grava_view)
             {
                fwrite($xml_v, $this->xml_registro);
             }
         }
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['embutida'])
      { 
          if (!$this->New_Format)
          {
              $this->xml_registro = "";
          }
          $_SESSION['scriptcase']['export_return'] = $this->xml_registro;
      }
      else
      { 
          fwrite($xml_f, "</root>");
          fclose($xml_f);
          if ($this->Grava_view)
          {
             fwrite($xml_v, "</root>");
             fclose($xml_v);
          }
          if ($this->Tem_xml_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "grid_trinaer_rsvp_r_res_xml.class.php");
              $this->Res = new grid_trinaer_rsvp_r_res_xml();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_res_grid'] = true;
              $this->Res->monta_xml();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Xml_password != "" || $this->Tem_xml_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Xml_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Xml_f, ' ')) ? " \"" . $this->Xml_f . "\"" :  $this->Xml_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
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
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
              $this->Xml_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_xml_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_res_file']['xml'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_res_file']['xml']);
              }
              if ($this->Grava_view)
              {
                  $str_zip    = "";
                  $xml_view_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view;
                  $zip_view_f = str_replace(".zip", "_view.zip", $this->Zip_f);
                  $zip_arq_v  = str_replace(".zip", "_view.zip", $this->Arq_zip);
                  $Zip_f      = (FALSE !== strpos($zip_view_f, ' ')) ? " \"" . $zip_view_f . "\"" :  $zip_view_f;
                  $Arq_input  = (FALSE !== strpos($xml_view_ff, ' ')) ? " \"" . $xml_view_f . "\"" :  $xml_view_f;
                  if (is_file($Zip_f)) {
                      unlink($Zip_f);
                  }
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      chdir($this->Ini->path_third . "/zip/windows");
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
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
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      chdir($this->Ini->path_third . "/zip/mac/bin");
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
                  unlink($Arq_input);
                  $this->Arquivo_view = $zip_arq_v;
                  if ($this->Tem_xml_res)
                  { 
                      $str_zip   = "";
                      $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_res_file']['view'];
                      $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                      if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                      {
                          $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
                      unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_res_file']['view']);
                  }
              } 
              else 
              {
                  $this->Arquivo_view = $this->Arq_zip;
              } 
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- tipo_transfer
   function NM_export_tipo_transfer()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tipo_transfer))
         {
             $this->tipo_transfer = sc_convert_encoding($this->tipo_transfer, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tipo_transfer'])) ? $this->New_label['tipo_transfer'] : "Tipo Transfer"; 
         }
         else
         {
             $SC_Label = "tipo_transfer"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tipo_transfer) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tipo_transfer) . "\"";
         }
   }
   //----- id_evento
   function NM_export_id_evento()
   {
             nmgp_Form_Num_Val($this->id_evento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['id_evento'])) ? $this->New_label['id_evento'] : "Cód Evento"; 
         }
         else
         {
             $SC_Label = "id_evento"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->id_evento) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->id_evento) . "\"";
         }
   }
   //----- evento_dsc
   function NM_export_evento_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->evento_dsc))
         {
             $this->evento_dsc = sc_convert_encoding($this->evento_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['evento_dsc'])) ? $this->New_label['evento_dsc'] : "Evento"; 
         }
         else
         {
             $SC_Label = "evento_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->evento_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->evento_dsc) . "\"";
         }
   }
   //----- data_saida
   function NM_export_data_saida()
   {
             $conteudo_x =  $this->data_saida;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_saida, "YYYY-MM-DD  ");
                 $this->data_saida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_saida'])) ? $this->New_label['data_saida'] : "Data Saida"; 
         }
         else
         {
             $SC_Label = "data_saida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_saida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_saida) . "\"";
         }
   }
   //----- hora_saida
   function NM_export_hora_saida()
   {
             $conteudo_x =  $this->hora_saida;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hora_saida, "HH:II:SS  ");
                 $this->hora_saida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hora_saida'])) ? $this->New_label['hora_saida'] : "Hora Saída"; 
         }
         else
         {
             $SC_Label = "hora_saida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hora_saida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hora_saida) . "\"";
         }
   }
   //----- data_chegada
   function NM_export_data_chegada()
   {
             $conteudo_x =  $this->data_chegada;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_chegada, "YYYY-MM-DD  ");
                 $this->data_chegada = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_chegada'])) ? $this->New_label['data_chegada'] : "Data Chegada"; 
         }
         else
         {
             $SC_Label = "data_chegada"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_chegada) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_chegada) . "\"";
         }
   }
   //----- hora_chegada
   function NM_export_hora_chegada()
   {
             $conteudo_x =  $this->hora_chegada;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hora_chegada, "HH:II:SS  ");
                 $this->hora_chegada = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hora_chegada'])) ? $this->New_label['hora_chegada'] : "Hora Chegada"; 
         }
         else
         {
             $SC_Label = "hora_chegada"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hora_chegada) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hora_chegada) . "\"";
         }
   }
   //----- cia_aerea_sigla
   function NM_export_cia_aerea_sigla()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cia_aerea_sigla))
         {
             $this->cia_aerea_sigla = sc_convert_encoding($this->cia_aerea_sigla, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cia_aerea_sigla'])) ? $this->New_label['cia_aerea_sigla'] : "Cia. Aérea"; 
         }
         else
         {
             $SC_Label = "cia_aerea_sigla"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cia_aerea_sigla) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cia_aerea_sigla) . "\"";
         }
   }
   //----- num_voo
   function NM_export_num_voo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->num_voo))
         {
             $this->num_voo = sc_convert_encoding($this->num_voo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['num_voo'])) ? $this->New_label['num_voo'] : "Voo"; 
         }
         else
         {
             $SC_Label = "num_voo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->num_voo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->num_voo) . "\"";
         }
   }
   //----- origem_sigla
   function NM_export_origem_sigla()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->origem_sigla))
         {
             $this->origem_sigla = sc_convert_encoding($this->origem_sigla, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['origem_sigla'])) ? $this->New_label['origem_sigla'] : "Origem"; 
         }
         else
         {
             $SC_Label = "origem_sigla"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->origem_sigla) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->origem_sigla) . "\"";
         }
   }
   //----- destino_sigla
   function NM_export_destino_sigla()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->destino_sigla))
         {
             $this->destino_sigla = sc_convert_encoding($this->destino_sigla, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['destino_sigla'])) ? $this->New_label['destino_sigla'] : "Destino"; 
         }
         else
         {
             $SC_Label = "destino_sigla"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->destino_sigla) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->destino_sigla) . "\"";
         }
   }
   //----- participante
   function NM_export_participante()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->participante))
         {
             $this->participante = sc_convert_encoding($this->participante, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['participante'])) ? $this->New_label['participante'] : "Participante"; 
         }
         else
         {
             $SC_Label = "participante"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->participante) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->participante) . "\"";
         }
   }
   //----- tipo_pessoa
   function NM_export_tipo_pessoa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tipo_pessoa))
         {
             $this->tipo_pessoa = sc_convert_encoding($this->tipo_pessoa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tipo_pessoa'])) ? $this->New_label['tipo_pessoa'] : "Tipo"; 
         }
         else
         {
             $SC_Label = "tipo_pessoa"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tipo_pessoa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tipo_pessoa) . "\"";
         }
   }
   //----- publico_dsc
   function NM_export_publico_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->publico_dsc))
         {
             $this->publico_dsc = sc_convert_encoding($this->publico_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['publico_dsc'])) ? $this->New_label['publico_dsc'] : "Público"; 
         }
         else
         {
             $SC_Label = "publico_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->publico_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->publico_dsc) . "\"";
         }
   }
   //----- regional_dsc
   function NM_export_regional_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->regional_dsc))
         {
             $this->regional_dsc = sc_convert_encoding($this->regional_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['regional_dsc'])) ? $this->New_label['regional_dsc'] : "Regional"; 
         }
         else
         {
             $SC_Label = "regional_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->regional_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->regional_dsc) . "\"";
         }
   }
   //----- hotel_dsc
   function NM_export_hotel_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_dsc))
         {
             $this->hotel_dsc = sc_convert_encoding($this->hotel_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_dsc'])) ? $this->New_label['hotel_dsc'] : "Hotel"; 
         }
         else
         {
             $SC_Label = "hotel_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_dsc) . "\"";
         }
   }
   //----- comprado_belvitur
   function NM_export_comprado_belvitur()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->comprado_belvitur))
         {
             $this->comprado_belvitur = sc_convert_encoding($this->comprado_belvitur, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['comprado_belvitur'])) ? $this->New_label['comprado_belvitur'] : "Comprado Belvitur"; 
         }
         else
         {
             $SC_Label = "comprado_belvitur"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->comprado_belvitur) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->comprado_belvitur) . "\"";
         }
   }
   //----- localizador
   function NM_export_localizador()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->localizador))
         {
             $this->localizador = sc_convert_encoding($this->localizador, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['localizador'])) ? $this->New_label['localizador'] : "Localizador"; 
         }
         else
         {
             $SC_Label = "localizador"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->localizador) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->localizador) . "\"";
         }
   }
   //----- eticket
   function NM_export_eticket()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->eticket))
         {
             $this->eticket = sc_convert_encoding($this->eticket, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['eticket'])) ? $this->New_label['eticket'] : "E-ticket"; 
         }
         else
         {
             $SC_Label = "eticket"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->eticket) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->eticket) . "\"";
         }
   }
   //----- rg
   function NM_export_rg()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->rg))
         {
             $this->rg = sc_convert_encoding($this->rg, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rg'])) ? $this->New_label['rg'] : "RG"; 
         }
         else
         {
             $SC_Label = "rg"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rg) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rg) . "\"";
         }
   }
   //----- cpf
   function NM_export_cpf()
   {
             if ($this->cpf !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->cpf, "###.###.###-##"); 
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cpf))
         {
             $this->cpf = sc_convert_encoding($this->cpf, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cpf'])) ? $this->New_label['cpf'] : "CPF"; 
         }
         else
         {
             $SC_Label = "cpf"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cpf) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cpf) . "\"";
         }
   }
   //----- data_nascimento
   function NM_export_data_nascimento()
   {
             $conteudo_x =  $this->data_nascimento;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_nascimento, "YYYY-MM-DD  ");
                 $this->data_nascimento = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_nascimento'])) ? $this->New_label['data_nascimento'] : "Data Nascimento"; 
         }
         else
         {
             $SC_Label = "data_nascimento"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_nascimento) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_nascimento) . "\"";
         }
   }
   //----- nota_gate
   function NM_export_nota_gate()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nota_gate))
         {
             $this->nota_gate = sc_convert_encoding($this->nota_gate, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['nota_gate'])) ? $this->New_label['nota_gate'] : "Nota Gate"; 
         }
         else
         {
             $SC_Label = "nota_gate"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nota_gate) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nota_gate) . "\"";
         }
   }
   //----- data_nota_gate
   function NM_export_data_nota_gate()
   {
             $conteudo_x =  $this->data_nota_gate;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_nota_gate, "YYYY-MM-DD  ");
                 $this->data_nota_gate = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_nota_gate'])) ? $this->New_label['data_nota_gate'] : "Data Nota Gate"; 
         }
         else
         {
             $SC_Label = "data_nota_gate"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_nota_gate) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_nota_gate) . "\"";
         }
   }
   //----- status
   function NM_export_status()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->status))
         {
             $this->status = sc_convert_encoding($this->status, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['status'])) ? $this->New_label['status'] : "Confirmação"; 
         }
         else
         {
             $SC_Label = "status"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->status) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->status) . "\"";
         }
   }
   //----- cod_bloqueio
   function NM_export_cod_bloqueio()
   {
             nmgp_Form_Num_Val($this->cod_bloqueio, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cod_bloqueio'])) ? $this->New_label['cod_bloqueio'] : "Cod Bloqueio"; 
         }
         else
         {
             $SC_Label = "cod_bloqueio"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cod_bloqueio) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cod_bloqueio) . "\"";
         }
   }
   //----- observacoes
   function NM_export_observacoes()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->observacoes))
         {
             $this->observacoes = sc_convert_encoding($this->observacoes, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['observacoes'])) ? $this->New_label['observacoes'] : "Observacoes"; 
         }
         else
         {
             $SC_Label = "observacoes"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->observacoes) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->observacoes) . "\"";
         }
   }
   //----- id_trinaer
   function NM_export_id_trinaer()
   {
             nmgp_Form_Num_Val($this->id_trinaer, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['id_trinaer'])) ? $this->New_label['id_trinaer'] : "Id Trinaer"; 
         }
         else
         {
             $SC_Label = "id_trinaer"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->id_trinaer) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->id_trinaer) . "\"";
         }
   }
   //----- direcao
   function NM_export_direcao()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->direcao))
         {
             $this->direcao = sc_convert_encoding($this->direcao, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['direcao'])) ? $this->New_label['direcao'] : "Direcao"; 
         }
         else
         {
             $SC_Label = "direcao"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->direcao) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->direcao) . "\"";
         }
   }

   //----- 
   function trata_dados($conteudo)
   {
      $str_temp =  $conteudo;
      $str_temp =  str_replace("<br />", "",  $str_temp);
      $str_temp =  str_replace("&", "&amp;",  $str_temp);
      $str_temp =  str_replace("<", "&lt;",   $str_temp);
      $str_temp =  str_replace(">", "&gt;",   $str_temp);
      $str_temp =  str_replace("'", "&apos;", $str_temp);
      $str_temp =  str_replace('"', "&quot;",  $str_temp);
      $str_temp =  str_replace('(', "_",  $str_temp);
      $str_temp =  str_replace(')', "",  $str_temp);
      return ($str_temp);
   }

   function clear_tag(&$conteudo)
   {
      $out = (is_numeric(substr($conteudo, 0, 1)) || substr($conteudo, 0, 1) == "") ? "_" : "";
      $str_temp = "abcdefghijklmnopqrstuvwxyz0123456789";
      for ($i = 0; $i < strlen($conteudo); $i++)
      {
          $char = substr($conteudo, $i, 1);
          $ok = false;
          for ($z = 0; $z < strlen($str_temp); $z++)
          {
              if (strtolower($char) == substr($str_temp, $z, 1))
              {
                  $ok = true;
                  break;
              }
          }
          $out .= ($ok) ? $char : "_";
      }
      $conteudo = $out;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Substituir o título :: XML</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XML</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_trinaer_rsvp_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_trinaer_rsvp_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_trinaer_rsvp_r']['xml_return']); ?>"> 
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

function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off';
}


function PrepReltrin($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;
		$ret = 'ADICIONA ERRO';			
		$valor_y = 'Y';
		$valor_p = 'P';
		$valor_a = 'A';
		$valor_n = 'N';
		$valor_nu = '';
		$valor_direcao = 'IDA';
		$valor_tipo = 'IN';
	
		$nome_empresa = '';	
		if($vp_nivel == 'CONVIDADO') {
			$sqlconv = "
				SELECT
					evento_id,
					usuario_id,
					nome_empresa
				FROM
					eventos_usuarios_rsvp			
				WHERE	
					evento_id = ".$this->Db->qstr($vp_evento)."
				AND 
					usuario_id = ".$this->Db->qstr($vp_usuario)."	
			";
			 
      $nm_select = $sqlconv; 
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
				$nome_empresa = $this->rs[0][2];
			}
		}		
		
		if ($vp_tipoPessoa == 'P') {
			$sqld="
			DELETE FROM 
				trinaer_rsvp_r
			WHERE   
				id_evento = ".$this->Db->qstr($vp_evento)."
			AND 
				id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
			";	
			
     $nm_select = $sqld; 
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
		
		}	
		if ($vp_tipoPessoa == 'P') {			
			if($vp_nivel == 'CONVIDADO') {
				$sqlMestre = "				
				SELECT
					participantes_rsvp.part_id_evento, 
					transfer_rsvp.tra_dt_saida_ida AS Dt_Saida,
					transfer_rsvp.tra_hr_saida_ida AS Hora_Saída,
					transfer_rsvp.tra_dt_chegada_ida AS Dt_Chegada,   
					transfer_rsvp.tra_hr_chegada_ida AS Hora_Chegada,
					transfer_rsvp.tra_cia_ida AS Cia_Aerea,
					transfer_rsvp.tra_numvoo_ida AS Voo,     
					transfer_rsvp.tra_origem_ida AS Origem,  
					transfer_rsvp.tra_destino_ida AS Destino, 
					participantes_rsvp.nome_pessoa AS p_nome,
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional,
					transfer_rsvp.tra_id_hotel AS Hotel,   
					participantes_rsvp.part_grupo AS p_grupo,  
					participantes_rsvp.part_departamento AS p_departamento,
					participantes_rsvp.part_cargo AS p_cargo,	
					participantes_rsvp.part_empresa AS p_empresa, 
					participantes_rsvp.part_email AS p_email,	
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					participantes_rsvp.part_celeular_01 AS p_celular_01, 
					participantes_rsvp.part_ddd_01 AS p_ddd_01,  
					participantes_rsvp.part_fone_01 AS p_fone_01, 
					transfer_rsvp.tra_localizador_ida AS loc_ida,
					transfer_rsvp.tra_eticket_ida AS tkt_ida, 
					participantes_rsvp.part_rg, 
					participantes_rsvp.part_cpf AS p_cpf, 
					participantes_rsvp.part_dt_nasc,
					transfer_rsvp.tra_observacao AS obs, 
					transfer_rsvp.tra_tipo AS tipo_transfer,			
					transfer_rsvp.tra_status AS t_status, 
					transfer_rsvp.tra_bloqueio_ida AS bloqueio,
					transfer_rsvp.tra_ativo AS ativo,				
					aereos_rsvp.aereo_id_evento AS aereo_evento,
					aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
					aereos_rsvp.aereo_num_voo AS aereo_voo,
					aereos_rsvp.aereo_direcao AS aereo_direcao,
					aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans,
					participantes_rsvp.dsc_empresa_rsvp
					FROM 
						transfer_rsvp 
					RIGHT JOIN 
						participantes_rsvp 
					ON 
						transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf 						
					RIGHT JOIN 
						aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
					AND 
						aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento
					WHERE 	
						transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)." 	  	
					AND
					   participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."  
					AND 
						transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	 
					AND	
						transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)."	 
					AND 
						transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."	 
					AND 
						transfer_rsvp.tra_cia_ida <> ".$this->Db->qstr($valor_nu)." 	
					AND 
						participantes_rsvp.part_substituido = ".$this->Db->qstr($valor_n)."	
					AND 
						transfer_rsvp.tra_flag_ida = ".$this->Db->qstr($valor_y)."	
					AND                                                                	
						participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 											
					AND
						aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
					AND
						aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."		
					AND
						participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
					ORDER BY 
						participantes_rsvp.nome_pessoa							
				";	
			} else {
				$sqlMestre = "				
				SELECT
					participantes_rsvp.part_id_evento, 
					transfer_rsvp.tra_dt_saida_ida AS Dt_Saida,
					transfer_rsvp.tra_hr_saida_ida AS Hora_Saída,
					transfer_rsvp.tra_dt_chegada_ida AS Dt_Chegada,   
					transfer_rsvp.tra_hr_chegada_ida AS Hora_Chegada,
					transfer_rsvp.tra_cia_ida AS Cia_Aerea,
					transfer_rsvp.tra_numvoo_ida AS Voo,     
					transfer_rsvp.tra_origem_ida AS Origem,  
					transfer_rsvp.tra_destino_ida AS Destino, 
					participantes_rsvp.nome_pessoa AS p_nome,
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional,
					transfer_rsvp.tra_id_hotel AS Hotel,   
					participantes_rsvp.part_grupo AS p_grupo,  
					participantes_rsvp.part_departamento AS p_departamento,
					participantes_rsvp.part_cargo AS p_cargo,	
					participantes_rsvp.part_empresa AS p_empresa, 
					participantes_rsvp.part_email AS p_email,	
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					participantes_rsvp.part_celeular_01 AS p_celular_01, 
					participantes_rsvp.part_ddd_01 AS p_ddd_01,  
					participantes_rsvp.part_fone_01 AS p_fone_01, 
					transfer_rsvp.tra_localizador_ida AS loc_ida,
					transfer_rsvp.tra_eticket_ida AS tkt_ida, 
					participantes_rsvp.part_rg, 
					participantes_rsvp.part_cpf AS p_cpf, 
					participantes_rsvp.part_dt_nasc,
					transfer_rsvp.tra_observacao AS obs, 
					transfer_rsvp.tra_tipo AS tipo_transfer,			
					transfer_rsvp.tra_status AS t_status, 
					transfer_rsvp.tra_bloqueio_ida AS bloqueio,
					transfer_rsvp.tra_ativo AS ativo,				
					aereos_rsvp.aereo_id_evento AS aereo_evento,
					aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
					aereos_rsvp.aereo_num_voo AS aereo_voo,
					aereos_rsvp.aereo_direcao AS aereo_direcao,
					aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans					
					FROM 
						transfer_rsvp 
					RIGHT JOIN 
						participantes_rsvp 
					ON 
						transfer_rsvp.tra_cpf_particip = participantes_rsvp.part_cpf 						
					RIGHT JOIN 
						aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
					AND 
						aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento
					WHERE 	
						transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)." 	  	
					AND
					   participantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)."  
					AND 
						transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	 
					AND	
						transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_p)."	 
					AND 
						transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."	 
					AND 
						transfer_rsvp.tra_cia_ida <> ".$this->Db->qstr($valor_nu)." 	
					AND 
						participantes_rsvp.part_substituido = ".$this->Db->qstr($valor_n)."	
					AND 
						transfer_rsvp.tra_flag_ida = ".$this->Db->qstr($valor_y)."	
					AND                                                                	
						participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 											
					AND
						aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
					AND
						aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."		
					ORDER BY 
						participantes_rsvp.nome_pessoa							
				";	
			}
			$_passa_part = true;
		} else {			
			if($vp_nivel == 'CONVIDADO') {
				$sqlMestre = "		                                                                   
				SELECT                                                                              
					acompanhantes_rsvp.part_id_evento, 
					transfer_rsvp.tra_dt_saida_ida AS Dt_Saida,
					transfer_rsvp.tra_hr_saida_ida AS Hora_Saída,
					transfer_rsvp.tra_dt_chegada_ida AS Dt_Chegada,   
					transfer_rsvp.tra_hr_chegada_ida AS Hora_Chegada,
					transfer_rsvp.tra_cia_ida AS Cia_Aerea,
					transfer_rsvp.tra_numvoo_ida AS Voo,     
					transfer_rsvp.tra_origem_ida AS Origem,  
					transfer_rsvp.tra_destino_ida AS Destino, 
					acompanhantes_rsvp.part_nome AS p_nome,
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,
					transfer_rsvp.tra_id_hotel AS Hotel,   
					acompanhantes_rsvp.part_grupo AS p_grupo,  
					acompanhantes_rsvp.part_departamento AS p_departamento,
					acompanhantes_rsvp.part_cargo AS p_cargo,	
					acompanhantes_rsvp.part_empresa AS p_empresa, 
					acompanhantes_rsvp.part_email AS p_email,	
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01, 
					acompanhantes_rsvp.part_ddd_01 AS p_ddd_01,  
					acompanhantes_rsvp.part_fone_01 AS p_fone_01, 
					transfer_rsvp.tra_localizador_ida AS loc_ida,
					transfer_rsvp.tra_eticket_ida AS tkt_ida, 
					acompanhantes_rsvp.part_rg, 
					acompanhantes_rsvp.part_cpf AS p_cpf, 
					acompanhantes_rsvp.part_dt_nasc,
					transfer_rsvp.tra_observacao AS obs, 
					transfer_rsvp.tra_tipo AS tipo_transfer, 				
					transfer_rsvp.tra_status AS t_status, 
					transfer_rsvp.tra_bloqueio_ida AS bloqueio,
					transfer_rsvp.tra_ativo AS ativo,
					aereos_rsvp.aereo_id_evento AS aereo_evento,
					aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
					aereos_rsvp.aereo_num_voo AS aereo_voo,
					aereos_rsvp.aereo_direcao AS aereo_direcao,
					aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans,
					acompanhantes_rsvp.dsc_empresa_rsvp
				FROM
					transfer_rsvp
				RIGHT JOIN 
					acompanhantes_rsvp	
				ON 	
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf			
				RIGHT JOIN 
					aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
				AND 
					aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento
				WHERE
					transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)." 
				AND
				   acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)." 
				AND 
					transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	
				AND
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)."	
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."				
				AND
					transfer_rsvp.tra_cia_ida <> ".$this->Db->qstr($valor_nu)." 
				AND                                                                     	
					acompanhantes_rsvp.part_substituido = ".$this->Db->qstr($valor_n)."
				AND
					transfer_rsvp.tra_flag_ida = ".$this->Db->qstr($valor_y)." 	
				AND                                                               				
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 				
				AND
					aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
				AND
					aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."	
				AND
					acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				ORDER BY				 
					acompanhantes_rsvp.part_nome			
				";	
			} else {
				$sqlMestre = "		                                                                   
				SELECT                                                                              
					acompanhantes_rsvp.part_id_evento, 
					transfer_rsvp.tra_dt_saida_ida AS Dt_Saida,
					transfer_rsvp.tra_hr_saida_ida AS Hora_Saída,
					transfer_rsvp.tra_dt_chegada_ida AS Dt_Chegada,   
					transfer_rsvp.tra_hr_chegada_ida AS Hora_Chegada,
					transfer_rsvp.tra_cia_ida AS Cia_Aerea,
					transfer_rsvp.tra_numvoo_ida AS Voo,     
					transfer_rsvp.tra_origem_ida AS Origem,  
					transfer_rsvp.tra_destino_ida AS Destino, 
					acompanhantes_rsvp.part_nome AS p_nome,
					acompanhantes_rsvp.part_id_evento_publico AS p_publico,
					acompanhantes_rsvp.part_id_evento_regional AS p_regional,
					transfer_rsvp.tra_id_hotel AS Hotel,   
					acompanhantes_rsvp.part_grupo AS p_grupo,  
					acompanhantes_rsvp.part_departamento AS p_departamento,
					acompanhantes_rsvp.part_cargo AS p_cargo,	
					acompanhantes_rsvp.part_empresa AS p_empresa, 
					acompanhantes_rsvp.part_email AS p_email,	
					acompanhantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,
					acompanhantes_rsvp.part_celeular_01 AS p_celular_01, 
					acompanhantes_rsvp.part_ddd_01 AS p_ddd_01,  
					acompanhantes_rsvp.part_fone_01 AS p_fone_01, 
					transfer_rsvp.tra_localizador_ida AS loc_ida,
					transfer_rsvp.tra_eticket_ida AS tkt_ida, 
					acompanhantes_rsvp.part_rg, 
					acompanhantes_rsvp.part_cpf AS p_cpf, 
					acompanhantes_rsvp.part_dt_nasc,
					transfer_rsvp.tra_observacao AS obs, 
					transfer_rsvp.tra_tipo AS tipo_transfer, 				
					transfer_rsvp.tra_status AS t_status, 
					transfer_rsvp.tra_bloqueio_ida AS bloqueio,
					transfer_rsvp.tra_ativo AS ativo,
					aereos_rsvp.aereo_id_evento AS aereo_evento,
					aereos_rsvp.aereo_cpf_particip AS aereo_cpf,
					aereos_rsvp.aereo_num_voo AS aereo_voo,
					aereos_rsvp.aereo_direcao AS aereo_direcao,
					aereos_rsvp.aereo_transfer_tipo AS aereo_tipo_trans					
				FROM
					transfer_rsvp
				RIGHT JOIN 
					acompanhantes_rsvp	
				ON 	
					transfer_rsvp.tra_cpf_particip = acompanhantes_rsvp.part_cpf			
				RIGHT JOIN 
					aereos_rsvp ON transfer_rsvp.tra_cpf_particip = aereos_rsvp.aereo_cpf_particip 
				AND 
					aereos_rsvp.aereo_id_evento = transfer_rsvp.tra_id_evento
				WHERE
					transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)." 
				AND
				   acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($vp_evento)." 
				AND 
					transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)."	
				AND
					transfer_rsvp.tra_tipo_pessoa = ".$this->Db->qstr($valor_a)."	
				AND
					transfer_rsvp.tra_tipo = ".$this->Db->qstr($valor_a)."				
				AND
					transfer_rsvp.tra_cia_ida <> ".$this->Db->qstr($valor_nu)." 
				AND                                                                     	
					acompanhantes_rsvp.part_substituido = ".$this->Db->qstr($valor_n)."
				AND
					transfer_rsvp.tra_flag_ida = ".$this->Db->qstr($valor_y)." 	
				AND                                                               				
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 				
				AND
					aereos_rsvp.aereo_direcao = ".$this->Db->qstr($valor_direcao)."
				AND
					aereos_rsvp.aereo_transfer_tipo = ".$this->Db->qstr($valor_tipo)."	
				ORDER BY				 
					acompanhantes_rsvp.part_nome			
				";
			}
			$_passa_part == true;	
		}	
		 
      $nm_select = $sqlMestre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsm = false;
          $this->rsm_erro = $this->Db->ErrorMsg();
      } 
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_mestre = sizeof($this->rsm );		
		if ($reg_mestre > 0) {					
			
			
			for ($i=0;$i<$reg_mestre;++$i) {	
				if ($vp_tipoPessoa == 'P') {
					$w_id_evento      	= $this->rsm[$i][0];
					$w_data_saida     	= $this->rsm[$i][1]; 
					$w_hora_saida     	= $this->rsm[$i][2]; 
					$w_data_chegada   	= $this->rsm[$i][3]; 
					$w_hora_chegada   	= $this->rsm[$i][4]; 
					$w_cia_aerea 	  	= $this->rsm[$i][5];
					$w_num_voo        	= $this->rsm[$i][34]; 
					$w_origem 		  	= $this->rsm[$i][7];
					$w_destino		  	= $this->rsm[$i][8]; 				
					$w_participante		= $this->rsm[$i][9];
					$w_publico		  	= $this->rsm[$i][10];
					$w_regional	      	= $this->rsm[$i][11];
					$w_hotel			= $this->rsm[$i][12];
					$w_grupo_dsc        = $this->rsm[$i][13];
					$w_depto_dsc        = $this->rsm[$i][14];
					$w_cargo_dsc        = $this->rsm[$i][15];
					$w_empresa_dsc      = $this->rsm[$i][16];
					$w_e_mail           = $this->rsm[$i][17];				
					$w_ddd_celular      = $this->rsm[$i][18];
					$w_celular          = $this->rsm[$i][19];
					$w_ddd_01           = $this->rsm[$i][20];
					$w_fone_01          = $this->rsm[$i][21];
					$w_localizador      = $this->rsm[$i][22];
					$w_eticket          = $this->rsm[$i][23];
					$w_rg               = $this->rsm[$i][24];
					$w_cpf              = $this->rsm[$i][25];
					$w_dtnasc           = $this->rsm[$i][26];
					$w_observacoes      = $this->rsm[$i][27];
					$w_tipo_transfer    = $this->rsm[$i][28];
					$w_status           = $this->rsm[$i][29];
					$w_cod_bloqueio     = $this->rsm[$i][30];
					$w_ativo            = $this->rsm[$i][31];					
					$w_tipo_pessoa  	= "PARTICIPANTE";					
				} else {
					$w_id_evento      	= $this->rsm[$i][0];
					$w_data_saida     	= $this->rsm[$i][1]; 
					$w_hora_saida     	= $this->rsm[$i][2]; 
					$w_data_chegada   	= $this->rsm[$i][3]; 
					$w_hora_chegada   	= $this->rsm[$i][4]; 
					$w_cia_aerea 	  	= $this->rsm[$i][5];
					$w_num_voo        	= $this->rsm[$i][34]; 
					$w_origem 		  	= $this->rsm[$i][7];
					$w_destino		  	= $this->rsm[$i][8]; 				
					$w_participante		= $this->rsm[$i][9];
					$w_publico		  	= $this->rsm[$i][10];
					$w_regional	      	= $this->rsm[$i][11];
					$w_hotel			= $this->rsm[$i][12];
					$w_grupo_dsc        = $this->rsm[$i][13];
					$w_depto_dsc        = $this->rsm[$i][14];
					$w_cargo_dsc        = $this->rsm[$i][15];
					$w_empresa_dsc      = $this->rsm[$i][16];
					$w_e_mail           = $this->rsm[$i][17];				
					$w_ddd_celular      = $this->rsm[$i][18];
					$w_celular          = $this->rsm[$i][19];
					$w_ddd_01           = $this->rsm[$i][20];
					$w_fone_01          = $this->rsm[$i][21];
					$w_localizador      = $this->rsm[$i][22];
					$w_eticket          = $this->rsm[$i][23];
					$w_rg               = $this->rsm[$i][24];
					$w_cpf              = $this->rsm[$i][25];
					$w_dtnasc           = $this->rsm[$i][26];
					$w_observacoes      = $this->rsm[$i][27];
					$w_tipo_transfer    = $this->rsm[$i][28];
					$w_status           = $this->rsm[$i][29];
					$w_cod_bloqueio     = $this->rsm[$i][30];
					$w_ativo            = $this->rsm[$i][31];					
					$w_tipo_pessoa  	= "ACOMPANHANTE";					
				}	
				$sqlAereo = "			
				SELECT
					aereo_id_evento,
					aereo_cpf_particip,
					aereo_emitida_bvt,
					aereo_bloqueio_id,
					aereo_localizador,
					aereo_num_voo,
					nota_gate,
					data_nota_gate,
					aereo_direcao					
				FROM
					aereos_rsvp
				WHERE
					aereo_id_evento = ".$this->Db->qstr($vp_evento)."
				AND
					aereo_cpf_particip = ".$this->Db->qstr($w_cpf)."
				AND
					aereo_localizador = ".$this->Db->qstr($w_localizador)."
				AND
					aereo_num_voo = ".$this->Db->qstr($w_num_voo)."
				ORDER BY
					aereo_id_evento,aereo_cpf_particip,aereo_localizador
				";
				 
      $nm_select = $sqlAereo; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaer = false;
          $this->rsaer_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsaer[0][0])) {					
					if ($this->rsaer[0][2] == 'Y') {
						$w_emitidaBvt = "SIM";
					} else {
						$w_emitidaBvt = "NAO";
					}
					$w_notaGate = $this->rsaer[0][6];
					$w_dtNotagate = $this->rsaer[0][7];
					$w_direcao = $this->rsaer[0][8];					
				} else {
					$w_emitidaBvt = "ERR";				
				}				
				$sqlCia = "			
				SELECT
					cia_id,
					cia_sigla,
					cia_nome
				FROM
					tbl_cia_aereas
				WHERE
					cia_id = ".$this->Db->qstr($w_cia_aerea)."
				ORDER BY
					cia_id
				";
				 
      $nm_select = $sqlCia; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscia = false;
          $this->rscia_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rscia[0][0])) {									
					$w_ciaAereaSigla = $this->rscia[0][2];
				} else {
					$w_ciaAereaSigla = "ERR";				
				}						
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($w_origem)."
				ORDER BY
					COD_AEROPORTO					
				";
				 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaerop = false;
          $this->rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsaerop[0][0])) {									
					$w_origemSigla = $this->rsaerop[0][1]; 
				} else {
					$w_origemSigla = "ERR";				
				}	
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($w_destino)."
				ORDER BY
					COD_AEROPORTO					
				";
				 
      $nm_select = $sqlAerop; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaerop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaerop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaerop = false;
          $this->rsaerop_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsaerop[0][0])) {									
					$w_destinoSigla = $this->rsaerop[0][1]; 
				} else {
					$w_destinoSigla = "ERR";				
				}	
				if ($w_publico <> '0') {
					$sqlPub = "			
					SELECT
						publico_id,
						publico_nome
					FROM
						publico_rsvp
					WHERE
						publico_id = ".$this->Db->qstr($w_publico)."
					ORDER BY
						publico_id
					";
					 
      $nm_select = $sqlPub; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspub = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspub[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspub = false;
          $this->rspub_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rspub[0][0])) {									
						$w_publicoDsc = $this->rspub[0][1];
					} else {
						$w_publicoDsc = "";				
					}
				} else {
					$w_publicoDsc = "";		
				}
				if ($w_regional <> '0') {
					$sqlReg = "								
					SELECT
						regional_id,
						regional_dsc
					FROM
						tbl_regionais
					WHERE
						regional_id = ".$this->Db->qstr($w_regional)."
					ORDER BY
						regional_id
					";
					 
      $nm_select = $sqlReg; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsreg = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsreg[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsreg = false;
          $this->rsreg_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rsreg[0][0])) {									
						$w_regionalDsc = $this->rsreg[0][1];
					} else {
						$w_regionalDsc = "";				
					}
				} else {
					$w_regionalDsc = "";
				}
				if ($w_hotel <> '0') {
					$sqlHot = "								
					SELECT
						hotel_id,
						hotel_fantasia
					FROM
						tbl_hoteis
					WHERE
						hotel_id = ".$this->Db->qstr($w_hotel)."
					ORDER BY
						hotel_id
					";
					 
      $nm_select = $sqlHot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshot = false;
          $this->rshot_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rshot[0][0])) {									
						$w_hotelDsc = $this->rshot[0][1];
					} else {
						$w_hotelDsc = "";				
					}	
				} else {
					$w_hotelDsc = "";	
				}
				$sqlUsu = "								
				SELECT
					usuario_id,
					usuario_nome
				FROM
					usuarios_rsvp
					WHERE
					usuario_id = ".$this->Db->qstr($vp_usuario)."
				ORDER BY
					usuario_id
				";		
				 
      $nm_select = $sqlUsu; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsusu = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsusu[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsusu = false;
          $this->rsusu_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rsusu[0][0])) {									
					$w_usurelDsc = $this->rsusu[0][1];
				} else {
					$w_usurelDsc = "";				
				}		
				switch($w_tipo_transfer) {
					case 'A':
						$w_tipo_transfer = 'AEREO';  		  
						break;
					case 'L':
						$w_tipo_transfer = 'LOCAL'; 
						break;
					case 'P':
						$w_tipo_transfer = 'PROPRIO'; 
						break;									
				}
				switch($w_status) {
					case 'A':
						$w_status = 'ABERTO';  		 
						break;
					case 'Y':
						$w_status = 'SIM'; 
						break;
					case 'N':
						$w_status = 'NAO'; 
						break;		
					case 'P':
						$w_status = 'PENDENTE'; 
						break;		
				}
				$sqlEve = "								
				SELECT
					evento_id,
					evento_nome				
				FROM
					eventos_rsvp
				WHERE
					evento_id = ".$this->Db->qstr($w_id_evento)."
				ORDER BY
					evento_id
				";		
				 
      $nm_select = $sqlEve; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rseve = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rseve[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rseve = false;
          $this->rseve_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rseve[0][0])) {									
					$w_eventoDsc = $this->rseve[0][1];
				} else {
					$w_eventoDsc = "";				
				}		
				if ($vp_tipoPessoa == 'A') {										  
					$sqlPes = "								
					SELECT						
						pessoa_cpf,
						pessoa_nome				
					FROM
						pessoas_rsvp
					WHERE
						pessoa_cpf = ".$this->Db->qstr($w_cpf)."
					ORDER BY
						pessoa_cpf
					";		
					 
      $nm_select = $sqlPes; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspes = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspes[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspes = false;
          $this->rspes_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rspes[0][0])) {									
						$w_participante = $this->rspes[0][1];
					} else {
						$w_participante = "ERRO";				
					}							
				}	
				$sqlins = "
					SELECT 
						COUNT(cpf) as qtde
					FROM 
						trinaer_rsvp_r
					WHERE 
						cpf = ".$this->Db->qstr($w_cpf)." 
					AND 
						id_evento = ".$this->Db->qstr($w_id_evento)."									
					AND
						localizador = ".$this->Db->qstr($w_localizador)." 
					AND
						num_voo	= ".$this->Db->qstr($w_num_voo)." 
					AND
						id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
				";
				 
      $nm_select = $sqlins; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rslins = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rslins[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rslins = false;
          $this->rslins_erro = $this->Db->ErrorMsg();
      } 

				if (isset($this->rslins[0][0])) {
					$qtde = $this->rslins[0][0];
				} else {
					$qtde = 0;
				}
				if ($qtde == 0) {									
					$sqli = "	
					INSERT INTO   
						trinaer_rsvp_r
						(id_evento,		      
						data_saida,		     
						hora_saida,		     
						data_chegada,	     
						hora_chegada,	     
						cia_aerea,		       
						num_voo,			       
						origem,			           
						destino,			          
						participante,	     	
						publico,			          
						regional,		          
						hotel,			              
						grupo_dsc,		      
						departamento_dsc,    
						cargo_dsc,		      
						empresa_dsc,		    
						e_mail,			        
						ddd_celular,		    
						celular,			       
						ddd_01,			        
						fone_01,			       
						localizador,		    
						eticket,			       
						rg,				           
						cpf,				          
						data_nascimento,     
						observacoes,		    
						tipo_transfer,	     
						tipo_pessoa,		    
						status,			        
						cod_bloqueio,	     
						ativo,			         
						id_usuario_relato,
						comprado_belvitur,
						nota_gate,
						data_nota_gate,
						cia_aerea_sigla,
						direcao,
						origem_sigla,
						destino_sigla,
						publico_dsc,
						regional_dsc,
						hotel_dsc,
						usuario_relato_dsc,
						evento_dsc)
					VALUES
						(".$this->Db->qstr($w_id_evento).",    
						".$this->Db->qstr($w_data_saida).",   
						".$this->Db->qstr($w_hora_saida).",   
						".$this->Db->qstr($w_data_chegada).", 
						".$this->Db->qstr($w_hora_chegada).", 
						".$this->Db->qstr($w_cia_aerea).", 	 
						".$this->Db->qstr($w_num_voo).",      
						".$this->Db->qstr($w_origem).", 		 
						".$this->Db->qstr($w_destino).",		 
						".$this->Db->qstr($w_participante).",
						".$this->Db->qstr($w_publico).",		 
						".$this->Db->qstr($w_regional).",	 
						".$this->Db->qstr($w_hotel).",		 
						".$this->Db->qstr($w_grupo_dsc).",    
						".$this->Db->qstr($w_depto_dsc).",    
						".$this->Db->qstr($w_cargo_dsc).",    
						".$this->Db->qstr($w_empresa_dsc).",  
						".$this->Db->qstr($w_e_mail).",       
						".$this->Db->qstr($w_ddd_celular).",  
						".$this->Db->qstr($w_celular).",      
						".$this->Db->qstr($w_ddd_01).",       
						".$this->Db->qstr($w_fone_01).",      
						".$this->Db->qstr($w_localizador).",  
						".$this->Db->qstr($w_eticket).",      
						".$this->Db->qstr($w_rg).",           
						".$this->Db->qstr($w_cpf).",          
						".$this->Db->qstr($w_dtnasc).",       
						".$this->Db->qstr($w_observacoes).",  
						".$this->Db->qstr($w_tipo_transfer).",
						".$this->Db->qstr($w_tipo_pessoa).",  
						".$this->Db->qstr($w_status).",       
						".$this->Db->qstr($w_cod_bloqueio).", 
						".$this->Db->qstr($w_ativo).",
						".$this->Db->qstr($vp_usuario).",
						".$this->Db->qstr($w_emitidaBvt).",
						".$this->Db->qstr($w_notaGate).",
						".$this->Db->qstr($w_dtNotagate).",
						".$this->Db->qstr($w_ciaAereaSigla).",
						".$this->Db->qstr($w_direcao).",
						".$this->Db->qstr($w_origemSigla).",
						".$this->Db->qstr($w_destinoSigla).",
						".$this->Db->qstr($w_publicoDsc).", 
						".$this->Db->qstr($w_regionalDsc).", 
						".$this->Db->qstr($w_hotelDsc).", 
						".$this->Db->qstr($w_usurelDsc).",
						".$this->Db->qstr($w_eventoDsc).") 
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
      
				}	
				$ret = 'ADICIONA OK';
			}
		} else {
			if ($_passa_part == false) {
				$ret = 'ADICIONA ERRO';
			} else {
				$ret = 'ADICIONA OK';
			}	
		}		
		return $ret;
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_trinaer_rsvp_r']['contr_erro'] = 'off';
}

}

?>
