<?php

class grid_geral_rsvp_r_xml
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['opcao'] = "";
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
                   nm_limpa_str_grid_geral_rsvp_r($cadapar[1]);
                   nm_protect_num_grid_geral_rsvp_r($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_geral_rsvp_r']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_usuario_id"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_geral_rsvp_r($_SESSION["rsvp_global"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm1"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_geral_rsvp_r($_SESSION["vg_cpfseg"]);
      }
      if (isset($parm2)) 
      {
          $_SESSION['parm2'] = $parm2;
          nm_limpa_str_grid_geral_rsvp_r($_SESSION["parm2"]);
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Gb_Free_cmp']))
      {
          $this->Tem_xml_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_geral_rsvp_r/grid_geral_rsvp_r_res_xml.class.php"))
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_label']))
      {
          $this->Xml_tag_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_label'];
          $this->New_Format    = true;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_total.class.php"); 
      $this->Tot      = new grid_geral_rsvp_r_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['tot_geral'][1];
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_geral_rsvp_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_return']);
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
      $this->Arq_zip      = $this->Arquivo . "_grid_geral_rsvp_r.zip";
      $this->Arquivo     .= "_grid_geral_rsvp_r";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "grid_geral_rsvp_r.xml";
      $this->Tit_zip      = "grid_geral_rsvp_r.zip";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_geral_rsvp_r']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['campos_busca'];
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
          $this->evento_dsc = (isset($Busca_temp['evento_dsc'])) ? $Busca_temp['evento_dsc'] : ""; 
          $tmp_pos = (is_string($this->evento_dsc)) ? strpos($this->evento_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->evento_dsc))
          {
              $this->evento_dsc = substr($this->evento_dsc, 0, $tmp_pos);
          }
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
          $this->nome_participante = (isset($Busca_temp['nome_participante'])) ? $Busca_temp['nome_participante'] : ""; 
          $tmp_pos = (is_string($this->nome_participante)) ? strpos($this->nome_participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nome_participante))
          {
              $this->nome_participante = substr($this->nome_participante, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
          $this->checkin = (isset($Busca_temp['checkin'])) ? $Busca_temp['checkin'] : ""; 
          $tmp_pos = (is_string($this->checkin)) ? strpos($this->checkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->checkin))
          {
              $this->checkin = substr($this->checkin, 0, $tmp_pos);
          }
          $this->checkin_2 = (isset($Busca_temp['checkin_input_2'])) ? $Busca_temp['checkin_input_2'] : ""; 
          $this->checkout = (isset($Busca_temp['checkout'])) ? $Busca_temp['checkout'] : ""; 
          $tmp_pos = (is_string($this->checkout)) ? strpos($this->checkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->checkout))
          {
              $this->checkout = substr($this->checkout, 0, $tmp_pos);
          }
          $this->checkout_2 = (isset($Busca_temp['checkout_input_2'])) ? $Busca_temp['checkout_input_2'] : ""; 
          $this->hotel = (isset($Busca_temp['hotel'])) ? $Busca_temp['hotel'] : ""; 
          $tmp_pos = (is_string($this->hotel)) ? strpos($this->hotel, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel))
          {
              $this->hotel = substr($this->hotel, 0, $tmp_pos);
          }
          $this->hotel_dsc = (isset($Busca_temp['hotel_dsc'])) ? $Busca_temp['hotel_dsc'] : ""; 
          $tmp_pos = (is_string($this->hotel_dsc)) ? strpos($this->hotel_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_dsc))
          {
              $this->hotel_dsc = substr($this->hotel_dsc, 0, $tmp_pos);
          }
          $this->comprado_bvt = (isset($Busca_temp['comprado_bvt'])) ? $Busca_temp['comprado_bvt'] : ""; 
          $tmp_pos = (is_string($this->comprado_bvt)) ? strpos($this->comprado_bvt, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->comprado_bvt))
          {
              $this->comprado_bvt = substr($this->comprado_bvt, 0, $tmp_pos);
          }
          $this->publico = (isset($Busca_temp['publico'])) ? $Busca_temp['publico'] : ""; 
          $tmp_pos = (is_string($this->publico)) ? strpos($this->publico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico))
          {
              $this->publico = substr($this->publico, 0, $tmp_pos);
          }
          $this->publico_dsc = (isset($Busca_temp['publico_dsc'])) ? $Busca_temp['publico_dsc'] : ""; 
          $tmp_pos = (is_string($this->publico_dsc)) ? strpos($this->publico_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico_dsc))
          {
              $this->publico_dsc = substr($this->publico_dsc, 0, $tmp_pos);
          }
          $this->regional = (isset($Busca_temp['regional'])) ? $Busca_temp['regional'] : ""; 
          $tmp_pos = (is_string($this->regional)) ? strpos($this->regional, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->regional))
          {
              $this->regional = substr($this->regional, 0, $tmp_pos);
          }
          $this->regional_dsc = (isset($Busca_temp['regional_dsc'])) ? $Busca_temp['regional_dsc'] : ""; 
          $tmp_pos = (is_string($this->regional_dsc)) ? strpos($this->regional_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->regional_dsc))
          {
              $this->regional_dsc = substr($this->regional_dsc, 0, $tmp_pos);
          }
          $this->cidade = (isset($Busca_temp['cidade'])) ? $Busca_temp['cidade'] : ""; 
          $tmp_pos = (is_string($this->cidade)) ? strpos($this->cidade, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cidade))
          {
              $this->cidade = substr($this->cidade, 0, $tmp_pos);
          }
          $this->presenca = (isset($Busca_temp['presenca'])) ? $Busca_temp['presenca'] : ""; 
          $tmp_pos = (is_string($this->presenca)) ? strpos($this->presenca, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->presenca))
          {
              $this->presenca = substr($this->presenca, 0, $tmp_pos);
          }
          $this->contato = (isset($Busca_temp['contato'])) ? $Busca_temp['contato'] : ""; 
          $tmp_pos = (is_string($this->contato)) ? strpos($this->contato, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->contato))
          {
              $this->contato = substr($this->contato, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
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

$valor_null = '';
$resultado = 'ERRO';
$this->sc_temp_vg_evento_id = $this->sc_temp_parm1;
$_tipoPessoa = $this->sc_temp_parm2;
$titulo  = 'Relatório Geral';

$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');

$params = array(
	'title' => 'Atenção!',
	'type' => 'warning',
	'timer' => '5000',
	'showConfirmButton' => 'false',
	'position' => 'center',
	'toast' => 'true'
	);

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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_geral_rsvp_r";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['sc_outra_jan'] = false;
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
        action="grid_geral_rsvp_r_fim.php"
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

$this->nm_mens_alert[] = "Relatório em DESENVOLVIMENTO!";$this->nm_params_alert[] = $params;$resultado  = $this->PrepGeral($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'P',$usunivel);
$resultado2 = $this->PrepGeral($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'A',$usunivel);

if ($resultado == 'ADICIONA OK') {
	$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
	$this->RetNivel($usunivel);
	$id_evento  = $this->sc_temp_vg_evento_id;
	$this->id_usuario_relato  = $this->sc_temp_vg_usuario_id;
	$sqlacerto = "
		SELECT			
			cpf,
			nome_participante,
			convidado_original,
			nome_substituto
		FROM
			geral_rsvp_r
		WHERE
			nome_substituto <> ".$this->Db->qstr($valor_nul)." 
		ORDER BY
			nome_participante			
	";	
	 
      $nm_select = $sqlacerto; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsacerto = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsacerto[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsacerto = false;
          $this->rsacerto_erro = $this->Db->ErrorMsg();
      } 
	                                                                                      
	$reg_mestre = sizeof($this->rsacerto );		                                                                                    	
	if ($reg_mestre > 0) {				                                                                                        
		for ($i=0;$i<$reg_mestre;++$i) {
			$_substituto = $this->rsacerto[$i][3];						
			$_original = $this->rsacerto[$i][2];			
			$_cpf   = $this->rsacerto[$i][0];					
			$sqlsubs = "
				SELECT 
					part_ativo
				FROM
					participantes_rsvp
				WHERE
					nome_pessoa = ".$this->Db->qstr($_substituto)."
				ORDER BY
					part_id_evento, part_nome_substituto
			";							
			 
      $nm_select = $sqlsubs; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rssubs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rssubs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rssubs = false;
          $this->rssubs_erro = $this->Db->ErrorMsg();
      } 
										
			if (isset($this->rssubs[0][0])) {				
				$_ativo = $this->rssubs[0][0];					
				
				if ($_ativo == 'N') {						
					$sqlupd = "
						UPDATE 
							geral_rsvp_r
						SET 
							nome_participante = ".$this->Db->qstr($_original)."
						WHERE 
							evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
						AND
							cpf = ".$this->Db->qstr($_cpf)."
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
		}			
	}	
} else {	
	$this->nm_mens_alert[] = "Erro ao carregar o relatório Geral!";$this->nm_params_alert[] = $params;}	

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_parm2)) {$_SESSION['parm2'] = $this->sc_temp_parm2;}
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
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
          $nmgp_select = "SELECT evento_id, evento_dsc, nome_participante, tipo_pessoa, str_replace (convert(char(10),data_nascimento,102), '.', '-') + ' ' + convert(char(8),data_nascimento,20), rg, nome_cracha, convidado_original, nome_substituto, acomp_mesmoquarto, partici_mesmoquarto, hotel_dsc, str_replace (convert(char(10),checkin,102), '.', '-') + ' ' + convert(char(8),checkin,20), str_replace (convert(char(10),checkout,102), '.', '-') + ' ' + convert(char(8),checkout,20), early_checkin, late_checkout, tamanho_camisa, tamanho_calcado, empresa, cargo, departamento, grupo, publico_dsc, regional_dsc, data_cadastro, logradouro, complemento, cidade, bairro, cep, uf, pais_dsc, ddd_tel01, tel01, ddd_celular, celular, telefone_internacional, passaporte, str_replace (convert(char(10),validade_passporte,102), '.', '-') + ' ' + convert(char(8),validade_passporte,20), cpf, filiacao, fumante, restricao_alimentar, e_mail, atualizacao_presenca, presenca, str_replace (convert(char(10),dt_confirm_presenca,102), '.', '-') + ' ' + convert(char(8),dt_confirm_presenca,20), presenca_motivo, presenca_atendente, presenca_obs, contato_antendente, data_contato, motivo_contato, obs_contato, status_contato, str_replace (convert(char(10),hora_saida_ida,102), '.', '-') + ' ' + convert(char(8),hora_saida_ida,20), trecho, hotel_ida_dsc, comprada_bvt_ida, str_replace (convert(char(10),data_saida_ida,102), '.', '-') + ' ' + convert(char(8),data_saida_ida,20), origem_dsc_ida, destino_dsc_ida, voo_ida, cia_dsc_ida, localizador_ida, etkt_ida, str_replace (convert(char(10),data_chegada_ida,102), '.', '-') + ' ' + convert(char(8),data_chegada_ida,20), str_replace (convert(char(10),hora_chegada_ida,102), '.', '-') + ' ' + convert(char(8),hora_chegada_ida,20), status_aereo_ida, trecho_volta, hotel_volta_dsc, hr_transfer_volta, comprada_bvt_volta, str_replace (convert(char(10),data_saida_volta,102), '.', '-') + ' ' + convert(char(8),data_saida_volta,20), str_replace (convert(char(10),hora_saida_volta,102), '.', '-') + ' ' + convert(char(8),hora_saida_volta,20), str_replace (convert(char(10),data_chegada_volta,102), '.', '-') + ' ' + convert(char(8),data_chegada_volta,20), str_replace (convert(char(10),hora_chegada_volta,102), '.', '-') + ' ' + convert(char(8),hora_chegada_volta,20), origem_dsc_volta, destino_dsc_volta, cia_dsc_volta, voo_volta, localizador_volta, etkt_volta, status_aereo_volta, tipo_transfer, str_replace (convert(char(10),dt_chegada_proprio,102), '.', '-') + ' ' + convert(char(8),dt_chegada_proprio,20), str_replace (convert(char(10),hr_chegada_proprio,102), '.', '-') + ' ' + convert(char(8),hr_chegada_proprio,20), valor_diaria, valor_taxa, obs_transfer, anotacoes, id_geral, cpf_mestre, contato, id_usuario_relato, regional from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT evento_id, evento_dsc, nome_participante, tipo_pessoa, data_nascimento, rg, nome_cracha, convidado_original, nome_substituto, acomp_mesmoquarto, partici_mesmoquarto, hotel_dsc, checkin, checkout, early_checkin, late_checkout, tamanho_camisa, tamanho_calcado, empresa, cargo, departamento, grupo, publico_dsc, regional_dsc, data_cadastro, logradouro, complemento, cidade, bairro, cep, uf, pais_dsc, ddd_tel01, tel01, ddd_celular, celular, telefone_internacional, passaporte, validade_passporte, cpf, filiacao, fumante, restricao_alimentar, e_mail, atualizacao_presenca, presenca, dt_confirm_presenca, presenca_motivo, presenca_atendente, presenca_obs, contato_antendente, data_contato, motivo_contato, obs_contato, status_contato, hora_saida_ida, trecho, hotel_ida_dsc, comprada_bvt_ida, data_saida_ida, origem_dsc_ida, destino_dsc_ida, voo_ida, cia_dsc_ida, localizador_ida, etkt_ida, data_chegada_ida, hora_chegada_ida, status_aereo_ida, trecho_volta, hotel_volta_dsc, hr_transfer_volta, comprada_bvt_volta, data_saida_volta, hora_saida_volta, data_chegada_volta, hora_chegada_volta, origem_dsc_volta, destino_dsc_volta, cia_dsc_volta, voo_volta, localizador_volta, etkt_volta, status_aereo_volta, tipo_transfer, dt_chegada_proprio, hr_chegada_proprio, valor_diaria, valor_taxa, obs_transfer, anotacoes, id_geral, cpf_mestre, contato, id_usuario_relato, regional from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT evento_id, evento_dsc, nome_participante, tipo_pessoa, convert(char(23),data_nascimento,121), rg, nome_cracha, convidado_original, nome_substituto, acomp_mesmoquarto, partici_mesmoquarto, hotel_dsc, convert(char(23),checkin,121), convert(char(23),checkout,121), early_checkin, late_checkout, tamanho_camisa, tamanho_calcado, empresa, cargo, departamento, grupo, publico_dsc, regional_dsc, data_cadastro, logradouro, complemento, cidade, bairro, cep, uf, pais_dsc, ddd_tel01, tel01, ddd_celular, celular, telefone_internacional, passaporte, convert(char(23),validade_passporte,121), cpf, filiacao, fumante, restricao_alimentar, e_mail, atualizacao_presenca, presenca, convert(char(23),dt_confirm_presenca,121), presenca_motivo, presenca_atendente, presenca_obs, contato_antendente, data_contato, motivo_contato, obs_contato, status_contato, convert(char(23),hora_saida_ida,121), trecho, hotel_ida_dsc, comprada_bvt_ida, convert(char(23),data_saida_ida,121), origem_dsc_ida, destino_dsc_ida, voo_ida, cia_dsc_ida, localizador_ida, etkt_ida, convert(char(23),data_chegada_ida,121), convert(char(23),hora_chegada_ida,121), status_aereo_ida, trecho_volta, hotel_volta_dsc, hr_transfer_volta, comprada_bvt_volta, convert(char(23),data_saida_volta,121), convert(char(23),hora_saida_volta,121), convert(char(23),data_chegada_volta,121), convert(char(23),hora_chegada_volta,121), origem_dsc_volta, destino_dsc_volta, cia_dsc_volta, voo_volta, localizador_volta, etkt_volta, status_aereo_volta, tipo_transfer, convert(char(23),dt_chegada_proprio,121), convert(char(23),hr_chegada_proprio,121), valor_diaria, valor_taxa, obs_transfer, anotacoes, id_geral, cpf_mestre, contato, id_usuario_relato, regional from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT evento_id, evento_dsc, nome_participante, tipo_pessoa, data_nascimento, rg, nome_cracha, convidado_original, nome_substituto, acomp_mesmoquarto, partici_mesmoquarto, hotel_dsc, checkin, checkout, early_checkin, late_checkout, tamanho_camisa, tamanho_calcado, empresa, cargo, departamento, grupo, publico_dsc, regional_dsc, TO_DATE(TO_CHAR(data_cadastro, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), logradouro, complemento, cidade, bairro, cep, uf, pais_dsc, ddd_tel01, tel01, ddd_celular, celular, telefone_internacional, passaporte, validade_passporte, cpf, filiacao, fumante, restricao_alimentar, e_mail, TO_DATE(TO_CHAR(atualizacao_presenca, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), presenca, dt_confirm_presenca, presenca_motivo, presenca_atendente, presenca_obs, contato_antendente, TO_DATE(TO_CHAR(data_contato, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), motivo_contato, obs_contato, status_contato, hora_saida_ida, trecho, hotel_ida_dsc, comprada_bvt_ida, data_saida_ida, origem_dsc_ida, destino_dsc_ida, voo_ida, cia_dsc_ida, localizador_ida, etkt_ida, data_chegada_ida, hora_chegada_ida, status_aereo_ida, trecho_volta, hotel_volta_dsc, hr_transfer_volta, comprada_bvt_volta, data_saida_volta, hora_saida_volta, data_chegada_volta, hora_chegada_volta, origem_dsc_volta, destino_dsc_volta, cia_dsc_volta, voo_volta, localizador_volta, etkt_volta, status_aereo_volta, tipo_transfer, dt_chegada_proprio, hr_chegada_proprio, valor_diaria, valor_taxa, obs_transfer, anotacoes, id_geral, cpf_mestre, contato, id_usuario_relato, regional from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT evento_id, evento_dsc, nome_participante, tipo_pessoa, EXTEND(data_nascimento, YEAR TO DAY), rg, nome_cracha, convidado_original, nome_substituto, acomp_mesmoquarto, partici_mesmoquarto, hotel_dsc, EXTEND(checkin, YEAR TO DAY), EXTEND(checkout, YEAR TO DAY), early_checkin, late_checkout, tamanho_camisa, tamanho_calcado, empresa, cargo, departamento, grupo, publico_dsc, regional_dsc, data_cadastro, logradouro, complemento, cidade, bairro, cep, uf, pais_dsc, ddd_tel01, tel01, ddd_celular, celular, telefone_internacional, passaporte, EXTEND(validade_passporte, YEAR TO DAY), cpf, filiacao, fumante, restricao_alimentar, e_mail, atualizacao_presenca, presenca, EXTEND(dt_confirm_presenca, YEAR TO DAY), presenca_motivo, presenca_atendente, presenca_obs, contato_antendente, data_contato, motivo_contato, obs_contato, status_contato, hora_saida_ida, trecho, hotel_ida_dsc, comprada_bvt_ida, EXTEND(data_saida_ida, YEAR TO DAY), origem_dsc_ida, destino_dsc_ida, voo_ida, cia_dsc_ida, localizador_ida, etkt_ida, EXTEND(data_chegada_ida, YEAR TO DAY), hora_chegada_ida, status_aereo_ida, trecho_volta, hotel_volta_dsc, hr_transfer_volta, comprada_bvt_volta, EXTEND(data_saida_volta, YEAR TO DAY), hora_saida_volta, EXTEND(data_chegada_volta, YEAR TO DAY), hora_chegada_volta, origem_dsc_volta, destino_dsc_volta, cia_dsc_volta, voo_volta, localizador_volta, etkt_volta, status_aereo_volta, tipo_transfer, EXTEND(dt_chegada_proprio, YEAR TO DAY), hr_chegada_proprio, valor_diaria, valor_taxa, obs_transfer, anotacoes, id_geral, cpf_mestre, contato, id_usuario_relato, regional from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT evento_id, evento_dsc, nome_participante, tipo_pessoa, data_nascimento, rg, nome_cracha, convidado_original, nome_substituto, acomp_mesmoquarto, partici_mesmoquarto, hotel_dsc, checkin, checkout, early_checkin, late_checkout, tamanho_camisa, tamanho_calcado, empresa, cargo, departamento, grupo, publico_dsc, regional_dsc, data_cadastro, logradouro, complemento, cidade, bairro, cep, uf, pais_dsc, ddd_tel01, tel01, ddd_celular, celular, telefone_internacional, passaporte, validade_passporte, cpf, filiacao, fumante, restricao_alimentar, e_mail, atualizacao_presenca, presenca, dt_confirm_presenca, presenca_motivo, presenca_atendente, presenca_obs, contato_antendente, data_contato, motivo_contato, obs_contato, status_contato, hora_saida_ida, trecho, hotel_ida_dsc, comprada_bvt_ida, data_saida_ida, origem_dsc_ida, destino_dsc_ida, voo_ida, cia_dsc_ida, localizador_ida, etkt_ida, data_chegada_ida, hora_chegada_ida, status_aereo_ida, trecho_volta, hotel_volta_dsc, hr_transfer_volta, comprada_bvt_volta, data_saida_volta, hora_saida_volta, data_chegada_volta, hora_chegada_volta, origem_dsc_volta, destino_dsc_volta, cia_dsc_volta, voo_volta, localizador_volta, etkt_volta, status_aereo_volta, tipo_transfer, dt_chegada_proprio, hr_chegada_proprio, valor_diaria, valor_taxa, obs_transfer, anotacoes, id_geral, cpf_mestre, contato, id_usuario_relato, regional from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['order_grid'];
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
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
         { 
             $this->xml_registro .= "<" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro = "<grid_geral_rsvp_r>\r\n";
         }
         else
         {
             $this->xml_registro = "<grid_geral_rsvp_r";
         }
         $this->evento_id = $rs->fields[0] ;  
         $this->evento_id = (string)$this->evento_id;
         $this->evento_dsc = $rs->fields[1] ;  
         $this->nome_participante = $rs->fields[2] ;  
         $this->tipo_pessoa = $rs->fields[3] ;  
         $this->data_nascimento = $rs->fields[4] ;  
         $this->rg = $rs->fields[5] ;  
         $this->nome_cracha = $rs->fields[6] ;  
         $this->convidado_original = $rs->fields[7] ;  
         $this->nome_substituto = $rs->fields[8] ;  
         $this->acomp_mesmoquarto = $rs->fields[9] ;  
         $this->partici_mesmoquarto = $rs->fields[10] ;  
         $this->hotel_dsc = $rs->fields[11] ;  
         $this->checkin = $rs->fields[12] ;  
         $this->checkout = $rs->fields[13] ;  
         $this->early_checkin = $rs->fields[14] ;  
         $this->late_checkout = $rs->fields[15] ;  
         $this->tamanho_camisa = $rs->fields[16] ;  
         $this->tamanho_calcado = $rs->fields[17] ;  
         $this->empresa = $rs->fields[18] ;  
         $this->cargo = $rs->fields[19] ;  
         $this->departamento = $rs->fields[20] ;  
         $this->grupo = $rs->fields[21] ;  
         $this->publico_dsc = $rs->fields[22] ;  
         $this->regional_dsc = $rs->fields[23] ;  
         $this->data_cadastro = $rs->fields[24] ;  
         $this->logradouro = $rs->fields[25] ;  
         $this->complemento = $rs->fields[26] ;  
         $this->cidade = $rs->fields[27] ;  
         $this->bairro = $rs->fields[28] ;  
         $this->cep = $rs->fields[29] ;  
         $this->uf = $rs->fields[30] ;  
         $this->pais_dsc = $rs->fields[31] ;  
         $this->ddd_tel01 = $rs->fields[32] ;  
         $this->tel01 = $rs->fields[33] ;  
         $this->ddd_celular = $rs->fields[34] ;  
         $this->celular = $rs->fields[35] ;  
         $this->telefone_internacional = $rs->fields[36] ;  
         $this->passaporte = $rs->fields[37] ;  
         $this->validade_passporte = $rs->fields[38] ;  
         $this->cpf = $rs->fields[39] ;  
         $this->filiacao = $rs->fields[40] ;  
         $this->fumante = $rs->fields[41] ;  
         $this->restricao_alimentar = $rs->fields[42] ;  
         $this->e_mail = $rs->fields[43] ;  
         $this->atualizacao_presenca = $rs->fields[44] ;  
         $this->presenca = $rs->fields[45] ;  
         $this->dt_confirm_presenca = $rs->fields[46] ;  
         $this->presenca_motivo = $rs->fields[47] ;  
         $this->presenca_atendente = $rs->fields[48] ;  
         $this->presenca_obs = $rs->fields[49] ;  
         $this->contato_antendente = $rs->fields[50] ;  
         $this->data_contato = $rs->fields[51] ;  
         $this->motivo_contato = $rs->fields[52] ;  
         $this->obs_contato = $rs->fields[53] ;  
         $this->status_contato = $rs->fields[54] ;  
         $this->hora_saida_ida = $rs->fields[55] ;  
         $this->trecho = $rs->fields[56] ;  
         $this->hotel_ida_dsc = $rs->fields[57] ;  
         $this->comprada_bvt_ida = $rs->fields[58] ;  
         $this->data_saida_ida = $rs->fields[59] ;  
         $this->origem_dsc_ida = $rs->fields[60] ;  
         $this->destino_dsc_ida = $rs->fields[61] ;  
         $this->voo_ida = $rs->fields[62] ;  
         $this->cia_dsc_ida = $rs->fields[63] ;  
         $this->localizador_ida = $rs->fields[64] ;  
         $this->etkt_ida = $rs->fields[65] ;  
         $this->data_chegada_ida = $rs->fields[66] ;  
         $this->hora_chegada_ida = $rs->fields[67] ;  
         $this->status_aereo_ida = $rs->fields[68] ;  
         $this->trecho_volta = $rs->fields[69] ;  
         $this->hotel_volta_dsc = $rs->fields[70] ;  
         $this->hr_transfer_volta = $rs->fields[71] ;  
         $this->comprada_bvt_volta = $rs->fields[72] ;  
         $this->data_saida_volta = $rs->fields[73] ;  
         $this->hora_saida_volta = $rs->fields[74] ;  
         $this->data_chegada_volta = $rs->fields[75] ;  
         $this->hora_chegada_volta = $rs->fields[76] ;  
         $this->origem_dsc_volta = $rs->fields[77] ;  
         $this->destino_dsc_volta = $rs->fields[78] ;  
         $this->cia_dsc_volta = $rs->fields[79] ;  
         $this->voo_volta = $rs->fields[80] ;  
         $this->localizador_volta = $rs->fields[81] ;  
         $this->etkt_volta = $rs->fields[82] ;  
         $this->status_aereo_volta = $rs->fields[83] ;  
         $this->tipo_transfer = $rs->fields[84] ;  
         $this->dt_chegada_proprio = $rs->fields[85] ;  
         $this->hr_chegada_proprio = $rs->fields[86] ;  
         $this->valor_diaria = $rs->fields[87] ;  
         $this->valor_diaria =  str_replace(",", ".", $this->valor_diaria);
         $this->valor_diaria = (string)$this->valor_diaria;
         $this->valor_taxa = $rs->fields[88] ;  
         $this->valor_taxa =  str_replace(",", ".", $this->valor_taxa);
         $this->valor_taxa = (string)$this->valor_taxa;
         $this->obs_transfer = $rs->fields[89] ;  
         $this->anotacoes = $rs->fields[90] ;  
         $this->id_geral = $rs->fields[91] ;  
         $this->id_geral = (string)$this->id_geral;
         $this->cpf_mestre = $rs->fields[92] ;  
         $this->contato = $rs->fields[93] ;  
         $this->id_usuario_relato = $rs->fields[94] ;  
         $this->id_usuario_relato = (string)$this->id_usuario_relato;
         $this->regional = $rs->fields[95] ;  
         $this->regional = (string)$this->regional;
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$this->NM_field_style["nome_participante"] = "background-color:;font-size:bold;color:#0033ff;";
$this->NM_field_style["tipo_pessoa"] = "background-color:;font-size:bold;color:#9966ff;";
$this->NM_field_style["hotel_dsc"] = "background-color:;font-size:bold;color:#ff66cc;";
$this->NM_field_style["checkin"] = "background-color:;font-size:bold;color:#ff9900;";
$this->NM_field_style["checkout"] = "background-color:;font-size:bold;color:#ff9933;";
$this->NM_field_style["cpf"] = "background-color:;font-size:bold;color:#0099ff;";
$this->NM_field_style["atualizacao_presenca"] = "background-color:;font-size:bold;color:#339900;";
$this->NM_field_style["contato"] = "background-color:;font-size:bold;color:#33cc00;";
$this->NM_field_style["trecho"] = "background-color:;font-size:bold;color:#cc66cc;";
$this->NM_field_style["hotel_ida_dsc"] = "background-color:;font-size:bold;color:#ff6600;";
$this->NM_field_style["trecho_volta"] = "background-color:;font-size:bold;color:#9933cc;";
$this->NM_field_style["hotel_volta_dsc"] = "background-color:;font-size:bold;color:#cc66ff;";
$this->NM_field_style["hr_transfer_volta"] = "background-color:;font-size:bold;color:#6699ff;";
$this->NM_field_style["comprada_bvt_ida"] = "background-color:;font-size:bold;color:#ff9933;";
$this->NM_field_style["comprada_bvt_volta"] = "background-color:;font-size:bold;color:#ff9933;";
$this->NM_field_style["tipo_transfer"] = "background-color:;font-size:bold;color:#cc3399;";
$this->NM_field_style["presenca"] = "background-color:;font-size:bold;color:#339900;";
$this->NM_field_style["ddd_celular"] = "background-color:;font-size:bold;color:#0099cc;";
$this->NM_field_style["celular"] = "background-color:;font-size:bold;color:#9966ff;";
$this->NM_field_style["status_aereo_ida"] = "background-color:;font-size:bold;color:#9966ff;";
$this->NM_field_style["status_aereo_volta"] = "background-color:;font-size:bold;color:#9966ff;";
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
         { 
             $this->xml_registro .= "</" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro .= "</grid_geral_rsvp_r>\r\n";
         }
         else
         {
             $this->xml_registro .= " />\r\n";
         }
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
         { 
             fwrite($xml_f, $this->xml_registro);
             if ($this->Grava_view)
             {
                fwrite($xml_v, $this->xml_registro);
             }
         }
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['embutida'])
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
              require_once($this->Ini->path_aplicacao . "grid_geral_rsvp_r_res_xml.class.php");
              $this->Res = new grid_geral_rsvp_r_res_xml();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_res_grid'] = true;
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
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_res_file']['xml'];
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_res_file']['xml']);
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
                      $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_res_file']['view'];
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
                      unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_res_file']['view']);
                  }
              } 
              else 
              {
                  $this->Arquivo_view = $this->Arq_zip;
              } 
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- evento_id
   function NM_export_evento_id()
   {
             nmgp_Form_Num_Val($this->evento_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['evento_id'])) ? $this->New_label['evento_id'] : "Cod. Evento "; 
         }
         else
         {
             $SC_Label = "evento_id"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->evento_id) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->evento_id) . "\"";
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
   //----- nome_participante
   function NM_export_nome_participante()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nome_participante))
         {
             $this->nome_participante = sc_convert_encoding($this->nome_participante, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['nome_participante'])) ? $this->New_label['nome_participante'] : " Participante"; 
         }
         else
         {
             $SC_Label = "nome_participante"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nome_participante) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nome_participante) . "\"";
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
   //----- nome_cracha
   function NM_export_nome_cracha()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nome_cracha))
         {
             $this->nome_cracha = sc_convert_encoding($this->nome_cracha, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['nome_cracha'])) ? $this->New_label['nome_cracha'] : "Nome Crachá"; 
         }
         else
         {
             $SC_Label = "nome_cracha"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nome_cracha) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nome_cracha) . "\"";
         }
   }
   //----- convidado_original
   function NM_export_convidado_original()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->convidado_original))
         {
             $this->convidado_original = sc_convert_encoding($this->convidado_original, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['convidado_original'])) ? $this->New_label['convidado_original'] : "Convidado Original"; 
         }
         else
         {
             $SC_Label = "convidado_original"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->convidado_original) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->convidado_original) . "\"";
         }
   }
   //----- nome_substituto
   function NM_export_nome_substituto()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nome_substituto))
         {
             $this->nome_substituto = sc_convert_encoding($this->nome_substituto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['nome_substituto'])) ? $this->New_label['nome_substituto'] : "Nome Substituto"; 
         }
         else
         {
             $SC_Label = "nome_substituto"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nome_substituto) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nome_substituto) . "\"";
         }
   }
   //----- acomp_mesmoquarto
   function NM_export_acomp_mesmoquarto()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->acomp_mesmoquarto))
         {
             $this->acomp_mesmoquarto = sc_convert_encoding($this->acomp_mesmoquarto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['acomp_mesmoquarto'])) ? $this->New_label['acomp_mesmoquarto'] : "Acompanhante (mesmo quarto)"; 
         }
         else
         {
             $SC_Label = "acomp_mesmoquarto"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->acomp_mesmoquarto) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->acomp_mesmoquarto) . "\"";
         }
   }
   //----- partici_mesmoquarto
   function NM_export_partici_mesmoquarto()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->partici_mesmoquarto))
         {
             $this->partici_mesmoquarto = sc_convert_encoding($this->partici_mesmoquarto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['partici_mesmoquarto'])) ? $this->New_label['partici_mesmoquarto'] : "Participante (mesmo quarto)"; 
         }
         else
         {
             $SC_Label = "partici_mesmoquarto"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->partici_mesmoquarto) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->partici_mesmoquarto) . "\"";
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
   //----- checkin
   function NM_export_checkin()
   {
             $conteudo_x =  $this->checkin;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->checkin, "YYYY-MM-DD  ");
                 $this->checkin = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['checkin'])) ? $this->New_label['checkin'] : "Checkin"; 
         }
         else
         {
             $SC_Label = "checkin"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->checkin) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->checkin) . "\"";
         }
   }
   //----- checkout
   function NM_export_checkout()
   {
             $conteudo_x =  $this->checkout;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->checkout, "YYYY-MM-DD  ");
                 $this->checkout = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['checkout'])) ? $this->New_label['checkout'] : "Checkout"; 
         }
         else
         {
             $SC_Label = "checkout"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->checkout) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->checkout) . "\"";
         }
   }
   //----- early_checkin
   function NM_export_early_checkin()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->early_checkin))
         {
             $this->early_checkin = sc_convert_encoding($this->early_checkin, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['early_checkin'])) ? $this->New_label['early_checkin'] : "Early Checkin"; 
         }
         else
         {
             $SC_Label = "early_checkin"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->early_checkin) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->early_checkin) . "\"";
         }
   }
   //----- late_checkout
   function NM_export_late_checkout()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->late_checkout))
         {
             $this->late_checkout = sc_convert_encoding($this->late_checkout, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['late_checkout'])) ? $this->New_label['late_checkout'] : "Late Checkout"; 
         }
         else
         {
             $SC_Label = "late_checkout"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->late_checkout) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->late_checkout) . "\"";
         }
   }
   //----- tamanho_camisa
   function NM_export_tamanho_camisa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tamanho_camisa))
         {
             $this->tamanho_camisa = sc_convert_encoding($this->tamanho_camisa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tamanho_camisa'])) ? $this->New_label['tamanho_camisa'] : "Tamanho Camisa"; 
         }
         else
         {
             $SC_Label = "tamanho_camisa"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tamanho_camisa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tamanho_camisa) . "\"";
         }
   }
   //----- tamanho_calcado
   function NM_export_tamanho_calcado()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tamanho_calcado))
         {
             $this->tamanho_calcado = sc_convert_encoding($this->tamanho_calcado, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tamanho_calcado'])) ? $this->New_label['tamanho_calcado'] : "Tamanho Calçado"; 
         }
         else
         {
             $SC_Label = "tamanho_calcado"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tamanho_calcado) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tamanho_calcado) . "\"";
         }
   }
   //----- empresa
   function NM_export_empresa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->empresa))
         {
             $this->empresa = sc_convert_encoding($this->empresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['empresa'])) ? $this->New_label['empresa'] : "Empresa"; 
         }
         else
         {
             $SC_Label = "empresa"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->empresa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->empresa) . "\"";
         }
   }
   //----- cargo
   function NM_export_cargo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cargo))
         {
             $this->cargo = sc_convert_encoding($this->cargo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cargo'])) ? $this->New_label['cargo'] : "Cargo"; 
         }
         else
         {
             $SC_Label = "cargo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cargo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cargo) . "\"";
         }
   }
   //----- departamento
   function NM_export_departamento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->departamento))
         {
             $this->departamento = sc_convert_encoding($this->departamento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['departamento'])) ? $this->New_label['departamento'] : "Departamento"; 
         }
         else
         {
             $SC_Label = "departamento"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->departamento) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->departamento) . "\"";
         }
   }
   //----- grupo
   function NM_export_grupo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->grupo))
         {
             $this->grupo = sc_convert_encoding($this->grupo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['grupo'])) ? $this->New_label['grupo'] : "Grupo"; 
         }
         else
         {
             $SC_Label = "grupo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->grupo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->grupo) . "\"";
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
   //----- data_cadastro
   function NM_export_data_cadastro()
   {
             if (substr($this->data_cadastro, 10, 1) == "-") 
             { 
                 $this->data_cadastro = substr($this->data_cadastro, 0, 10) . " " . substr($this->data_cadastro, 11);
             } 
             if (substr($this->data_cadastro, 13, 1) == ".") 
             { 
                $this->data_cadastro = substr($this->data_cadastro, 0, 13) . ":" . substr($this->data_cadastro, 14, 2) . ":" . substr($this->data_cadastro, 17);
             } 
             $conteudo_x =  $this->data_cadastro;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_cadastro, "YYYY-MM-DD HH:II:SS  ");
                 $this->data_cadastro = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->data_cadastro))
         {
             $this->data_cadastro = sc_convert_encoding($this->data_cadastro, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_cadastro'])) ? $this->New_label['data_cadastro'] : "Data Cadastro"; 
         }
         else
         {
             $SC_Label = "data_cadastro"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_cadastro) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_cadastro) . "\"";
         }
   }
   //----- logradouro
   function NM_export_logradouro()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->logradouro))
         {
             $this->logradouro = sc_convert_encoding($this->logradouro, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['logradouro'])) ? $this->New_label['logradouro'] : "Endereço"; 
         }
         else
         {
             $SC_Label = "logradouro"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->logradouro) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->logradouro) . "\"";
         }
   }
   //----- complemento
   function NM_export_complemento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->complemento))
         {
             $this->complemento = sc_convert_encoding($this->complemento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['complemento'])) ? $this->New_label['complemento'] : "Complemento"; 
         }
         else
         {
             $SC_Label = "complemento"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->complemento) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->complemento) . "\"";
         }
   }
   //----- cidade
   function NM_export_cidade()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cidade))
         {
             $this->cidade = sc_convert_encoding($this->cidade, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cidade'])) ? $this->New_label['cidade'] : "Cidade"; 
         }
         else
         {
             $SC_Label = "cidade"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cidade) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cidade) . "\"";
         }
   }
   //----- bairro
   function NM_export_bairro()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->bairro))
         {
             $this->bairro = sc_convert_encoding($this->bairro, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['bairro'])) ? $this->New_label['bairro'] : "Bairro"; 
         }
         else
         {
             $SC_Label = "bairro"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->bairro) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->bairro) . "\"";
         }
   }
   //----- cep
   function NM_export_cep()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cep))
         {
             $this->cep = sc_convert_encoding($this->cep, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cep'])) ? $this->New_label['cep'] : "Cep"; 
         }
         else
         {
             $SC_Label = "cep"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cep) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cep) . "\"";
         }
   }
   //----- uf
   function NM_export_uf()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->uf))
         {
             $this->uf = sc_convert_encoding($this->uf, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['uf'])) ? $this->New_label['uf'] : "Uf"; 
         }
         else
         {
             $SC_Label = "uf"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->uf) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->uf) . "\"";
         }
   }
   //----- pais_dsc
   function NM_export_pais_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pais_dsc))
         {
             $this->pais_dsc = sc_convert_encoding($this->pais_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pais_dsc'])) ? $this->New_label['pais_dsc'] : "Pais"; 
         }
         else
         {
             $SC_Label = "pais_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pais_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pais_dsc) . "\"";
         }
   }
   //----- ddd_tel01
   function NM_export_ddd_tel01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ddd_tel01))
         {
             $this->ddd_tel01 = sc_convert_encoding($this->ddd_tel01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ddd_tel01'])) ? $this->New_label['ddd_tel01'] : "DDD"; 
         }
         else
         {
             $SC_Label = "ddd_tel01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ddd_tel01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ddd_tel01) . "\"";
         }
   }
   //----- tel01
   function NM_export_tel01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tel01))
         {
             $this->tel01 = sc_convert_encoding($this->tel01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tel01'])) ? $this->New_label['tel01'] : "Fone"; 
         }
         else
         {
             $SC_Label = "tel01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tel01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tel01) . "\"";
         }
   }
   //----- ddd_celular
   function NM_export_ddd_celular()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ddd_celular))
         {
             $this->ddd_celular = sc_convert_encoding($this->ddd_celular, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ddd_celular'])) ? $this->New_label['ddd_celular'] : "DDD Celular"; 
         }
         else
         {
             $SC_Label = "ddd_celular"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ddd_celular) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ddd_celular) . "\"";
         }
   }
   //----- celular
   function NM_export_celular()
   {
             if ($this->celular !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->celular, "#####-####"); 
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->celular))
         {
             $this->celular = sc_convert_encoding($this->celular, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['celular'])) ? $this->New_label['celular'] : "Celular"; 
         }
         else
         {
             $SC_Label = "celular"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->celular) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->celular) . "\"";
         }
   }
   //----- telefone_internacional
   function NM_export_telefone_internacional()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->telefone_internacional))
         {
             $this->telefone_internacional = sc_convert_encoding($this->telefone_internacional, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['telefone_internacional'])) ? $this->New_label['telefone_internacional'] : "Telefone Internacional"; 
         }
         else
         {
             $SC_Label = "telefone_internacional"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->telefone_internacional) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->telefone_internacional) . "\"";
         }
   }
   //----- passaporte
   function NM_export_passaporte()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->passaporte))
         {
             $this->passaporte = sc_convert_encoding($this->passaporte, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['passaporte'])) ? $this->New_label['passaporte'] : "Passaporte"; 
         }
         else
         {
             $SC_Label = "passaporte"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->passaporte) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->passaporte) . "\"";
         }
   }
   //----- validade_passporte
   function NM_export_validade_passporte()
   {
             $conteudo_x =  $this->validade_passporte;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->validade_passporte, "YYYY-MM-DD  ");
                 $this->validade_passporte = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['validade_passporte'])) ? $this->New_label['validade_passporte'] : "Validade Passporte"; 
         }
         else
         {
             $SC_Label = "validade_passporte"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->validade_passporte) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->validade_passporte) . "\"";
         }
   }
   //----- cpf
   function NM_export_cpf()
   {
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
   //----- filiacao
   function NM_export_filiacao()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->filiacao))
         {
             $this->filiacao = sc_convert_encoding($this->filiacao, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['filiacao'])) ? $this->New_label['filiacao'] : "Filiacao"; 
         }
         else
         {
             $SC_Label = "filiacao"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->filiacao) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->filiacao) . "\"";
         }
   }
   //----- fumante
   function NM_export_fumante()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->fumante))
         {
             $this->fumante = sc_convert_encoding($this->fumante, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['fumante'])) ? $this->New_label['fumante'] : "Fumante"; 
         }
         else
         {
             $SC_Label = "fumante"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->fumante) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->fumante) . "\"";
         }
   }
   //----- restricao_alimentar
   function NM_export_restricao_alimentar()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->restricao_alimentar))
         {
             $this->restricao_alimentar = sc_convert_encoding($this->restricao_alimentar, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['restricao_alimentar'])) ? $this->New_label['restricao_alimentar'] : "Restrição Alimentar"; 
         }
         else
         {
             $SC_Label = "restricao_alimentar"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->restricao_alimentar) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->restricao_alimentar) . "\"";
         }
   }
   //----- e_mail
   function NM_export_e_mail()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->e_mail))
         {
             $this->e_mail = sc_convert_encoding($this->e_mail, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['e_mail'])) ? $this->New_label['e_mail'] : "E Mail"; 
         }
         else
         {
             $SC_Label = "e_mail"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->e_mail) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->e_mail) . "\"";
         }
   }
   //----- atualizacao_presenca
   function NM_export_atualizacao_presenca()
   {
             if (substr($this->atualizacao_presenca, 10, 1) == "-") 
             { 
                 $this->atualizacao_presenca = substr($this->atualizacao_presenca, 0, 10) . " " . substr($this->atualizacao_presenca, 11);
             } 
             if (substr($this->atualizacao_presenca, 13, 1) == ".") 
             { 
                $this->atualizacao_presenca = substr($this->atualizacao_presenca, 0, 13) . ":" . substr($this->atualizacao_presenca, 14, 2) . ":" . substr($this->atualizacao_presenca, 17);
             } 
             $conteudo_x =  $this->atualizacao_presenca;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->atualizacao_presenca, "YYYY-MM-DD HH:II:SS  ");
                 $this->atualizacao_presenca = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->atualizacao_presenca))
         {
             $this->atualizacao_presenca = sc_convert_encoding($this->atualizacao_presenca, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['atualizacao_presenca'])) ? $this->New_label['atualizacao_presenca'] : "Atualizacao Presenca"; 
         }
         else
         {
             $SC_Label = "atualizacao_presenca"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->atualizacao_presenca) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->atualizacao_presenca) . "\"";
         }
   }
   //----- presenca
   function NM_export_presenca()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca))
         {
             $this->presenca = sc_convert_encoding($this->presenca, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca'])) ? $this->New_label['presenca'] : "Confirmação da Presença"; 
         }
         else
         {
             $SC_Label = "presenca"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca) . "\"";
         }
   }
   //----- dt_confirm_presenca
   function NM_export_dt_confirm_presenca()
   {
             $conteudo_x =  $this->dt_confirm_presenca;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->dt_confirm_presenca, "YYYY-MM-DD  ");
                 $this->dt_confirm_presenca = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['dt_confirm_presenca'])) ? $this->New_label['dt_confirm_presenca'] : "Dt. Confirm. Presença"; 
         }
         else
         {
             $SC_Label = "dt_confirm_presenca"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->dt_confirm_presenca) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->dt_confirm_presenca) . "\"";
         }
   }
   //----- presenca_motivo
   function NM_export_presenca_motivo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_motivo))
         {
             $this->presenca_motivo = sc_convert_encoding($this->presenca_motivo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_motivo'])) ? $this->New_label['presenca_motivo'] : "Presenca Motivo"; 
         }
         else
         {
             $SC_Label = "presenca_motivo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_motivo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_motivo) . "\"";
         }
   }
   //----- presenca_atendente
   function NM_export_presenca_atendente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_atendente))
         {
             $this->presenca_atendente = sc_convert_encoding($this->presenca_atendente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_atendente'])) ? $this->New_label['presenca_atendente'] : "Presença Atendente"; 
         }
         else
         {
             $SC_Label = "presenca_atendente"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_atendente) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_atendente) . "\"";
         }
   }
   //----- presenca_obs
   function NM_export_presenca_obs()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_obs))
         {
             $this->presenca_obs = sc_convert_encoding($this->presenca_obs, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_obs'])) ? $this->New_label['presenca_obs'] : "Presença Obs"; 
         }
         else
         {
             $SC_Label = "presenca_obs"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_obs) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_obs) . "\"";
         }
   }
   //----- contato_antendente
   function NM_export_contato_antendente()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_antendente))
         {
             $this->contato_antendente = sc_convert_encoding($this->contato_antendente, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_antendente'])) ? $this->New_label['contato_antendente'] : "Contato Antendente"; 
         }
         else
         {
             $SC_Label = "contato_antendente"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_antendente) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_antendente) . "\"";
         }
   }
   //----- data_contato
   function NM_export_data_contato()
   {
             if (substr($this->data_contato, 10, 1) == "-") 
             { 
                 $this->data_contato = substr($this->data_contato, 0, 10) . " " . substr($this->data_contato, 11);
             } 
             if (substr($this->data_contato, 13, 1) == ".") 
             { 
                $this->data_contato = substr($this->data_contato, 0, 13) . ":" . substr($this->data_contato, 14, 2) . ":" . substr($this->data_contato, 17);
             } 
             $conteudo_x =  $this->data_contato;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_contato, "YYYY-MM-DD HH:II:SS  ");
                 $this->data_contato = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->data_contato))
         {
             $this->data_contato = sc_convert_encoding($this->data_contato, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_contato'])) ? $this->New_label['data_contato'] : "Data do Contato"; 
         }
         else
         {
             $SC_Label = "data_contato"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_contato) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_contato) . "\"";
         }
   }
   //----- motivo_contato
   function NM_export_motivo_contato()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->motivo_contato))
         {
             $this->motivo_contato = sc_convert_encoding($this->motivo_contato, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['motivo_contato'])) ? $this->New_label['motivo_contato'] : "Motivo Contato"; 
         }
         else
         {
             $SC_Label = "motivo_contato"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->motivo_contato) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->motivo_contato) . "\"";
         }
   }
   //----- obs_contato
   function NM_export_obs_contato()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->obs_contato))
         {
             $this->obs_contato = sc_convert_encoding($this->obs_contato, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['obs_contato'])) ? $this->New_label['obs_contato'] : "Obs Contato"; 
         }
         else
         {
             $SC_Label = "obs_contato"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->obs_contato) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->obs_contato) . "\"";
         }
   }
   //----- status_contato
   function NM_export_status_contato()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->status_contato))
         {
             $this->status_contato = sc_convert_encoding($this->status_contato, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['status_contato'])) ? $this->New_label['status_contato'] : "Contato Status"; 
         }
         else
         {
             $SC_Label = "status_contato"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->status_contato) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->status_contato) . "\"";
         }
   }
   //----- hora_saida_ida
   function NM_export_hora_saida_ida()
   {
             $conteudo_x =  $this->hora_saida_ida;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hora_saida_ida, "HH:II:SS  ");
                 $this->hora_saida_ida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hora_saida_ida'])) ? $this->New_label['hora_saida_ida'] : "Hora Saida Ida"; 
         }
         else
         {
             $SC_Label = "hora_saida_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hora_saida_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hora_saida_ida) . "\"";
         }
   }
   //----- trecho
   function NM_export_trecho()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->trecho))
         {
             $this->trecho = sc_convert_encoding($this->trecho, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['trecho'])) ? $this->New_label['trecho'] : "Trecho"; 
         }
         else
         {
             $SC_Label = "trecho"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->trecho) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->trecho) . "\"";
         }
   }
   //----- hotel_ida_dsc
   function NM_export_hotel_ida_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_ida_dsc))
         {
             $this->hotel_ida_dsc = sc_convert_encoding($this->hotel_ida_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_ida_dsc'])) ? $this->New_label['hotel_ida_dsc'] : "Hotel Ida "; 
         }
         else
         {
             $SC_Label = "hotel_ida_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_ida_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_ida_dsc) . "\"";
         }
   }
   //----- comprada_bvt_ida
   function NM_export_comprada_bvt_ida()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->comprada_bvt_ida))
         {
             $this->comprada_bvt_ida = sc_convert_encoding($this->comprada_bvt_ida, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['comprada_bvt_ida'])) ? $this->New_label['comprada_bvt_ida'] : "Comprada Bvt Ida"; 
         }
         else
         {
             $SC_Label = "comprada_bvt_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->comprada_bvt_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->comprada_bvt_ida) . "\"";
         }
   }
   //----- data_saida_ida
   function NM_export_data_saida_ida()
   {
             $conteudo_x =  $this->data_saida_ida;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_saida_ida, "YYYY-MM-DD  ");
                 $this->data_saida_ida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_saida_ida'])) ? $this->New_label['data_saida_ida'] : "Data Saida Ida"; 
         }
         else
         {
             $SC_Label = "data_saida_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_saida_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_saida_ida) . "\"";
         }
   }
   //----- origem_dsc_ida
   function NM_export_origem_dsc_ida()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->origem_dsc_ida))
         {
             $this->origem_dsc_ida = sc_convert_encoding($this->origem_dsc_ida, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['origem_dsc_ida'])) ? $this->New_label['origem_dsc_ida'] : "Origem Ida"; 
         }
         else
         {
             $SC_Label = "origem_dsc_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->origem_dsc_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->origem_dsc_ida) . "\"";
         }
   }
   //----- destino_dsc_ida
   function NM_export_destino_dsc_ida()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->destino_dsc_ida))
         {
             $this->destino_dsc_ida = sc_convert_encoding($this->destino_dsc_ida, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['destino_dsc_ida'])) ? $this->New_label['destino_dsc_ida'] : "Destino Ida"; 
         }
         else
         {
             $SC_Label = "destino_dsc_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->destino_dsc_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->destino_dsc_ida) . "\"";
         }
   }
   //----- voo_ida
   function NM_export_voo_ida()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->voo_ida))
         {
             $this->voo_ida = sc_convert_encoding($this->voo_ida, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['voo_ida'])) ? $this->New_label['voo_ida'] : "Voo Ida"; 
         }
         else
         {
             $SC_Label = "voo_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->voo_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->voo_ida) . "\"";
         }
   }
   //----- cia_dsc_ida
   function NM_export_cia_dsc_ida()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cia_dsc_ida))
         {
             $this->cia_dsc_ida = sc_convert_encoding($this->cia_dsc_ida, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cia_dsc_ida'])) ? $this->New_label['cia_dsc_ida'] : "Cia. Ida"; 
         }
         else
         {
             $SC_Label = "cia_dsc_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cia_dsc_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cia_dsc_ida) . "\"";
         }
   }
   //----- localizador_ida
   function NM_export_localizador_ida()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->localizador_ida))
         {
             $this->localizador_ida = sc_convert_encoding($this->localizador_ida, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['localizador_ida'])) ? $this->New_label['localizador_ida'] : "Localizador Ida"; 
         }
         else
         {
             $SC_Label = "localizador_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->localizador_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->localizador_ida) . "\"";
         }
   }
   //----- etkt_ida
   function NM_export_etkt_ida()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->etkt_ida))
         {
             $this->etkt_ida = sc_convert_encoding($this->etkt_ida, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['etkt_ida'])) ? $this->New_label['etkt_ida'] : "TKT Ida"; 
         }
         else
         {
             $SC_Label = "etkt_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->etkt_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->etkt_ida) . "\"";
         }
   }
   //----- data_chegada_ida
   function NM_export_data_chegada_ida()
   {
             $conteudo_x =  $this->data_chegada_ida;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_chegada_ida, "YYYY-MM-DD  ");
                 $this->data_chegada_ida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_chegada_ida'])) ? $this->New_label['data_chegada_ida'] : "Data Chegada Ida"; 
         }
         else
         {
             $SC_Label = "data_chegada_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_chegada_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_chegada_ida) . "\"";
         }
   }
   //----- hora_chegada_ida
   function NM_export_hora_chegada_ida()
   {
             $conteudo_x =  $this->hora_chegada_ida;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hora_chegada_ida, "HH:II:SS  ");
                 $this->hora_chegada_ida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hora_chegada_ida'])) ? $this->New_label['hora_chegada_ida'] : "Hora Chegada Ida"; 
         }
         else
         {
             $SC_Label = "hora_chegada_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hora_chegada_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hora_chegada_ida) . "\"";
         }
   }
   //----- status_aereo_ida
   function NM_export_status_aereo_ida()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->status_aereo_ida))
         {
             $this->status_aereo_ida = sc_convert_encoding($this->status_aereo_ida, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['status_aereo_ida'])) ? $this->New_label['status_aereo_ida'] : "Status Aéreo Ida"; 
         }
         else
         {
             $SC_Label = "status_aereo_ida"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->status_aereo_ida) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->status_aereo_ida) . "\"";
         }
   }
   //----- trecho_volta
   function NM_export_trecho_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->trecho_volta))
         {
             $this->trecho_volta = sc_convert_encoding($this->trecho_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['trecho_volta'])) ? $this->New_label['trecho_volta'] : "Trecho"; 
         }
         else
         {
             $SC_Label = "trecho_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->trecho_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->trecho_volta) . "\"";
         }
   }
   //----- hotel_volta_dsc
   function NM_export_hotel_volta_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_volta_dsc))
         {
             $this->hotel_volta_dsc = sc_convert_encoding($this->hotel_volta_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_volta_dsc'])) ? $this->New_label['hotel_volta_dsc'] : "Hotel Volta"; 
         }
         else
         {
             $SC_Label = "hotel_volta_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_volta_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_volta_dsc) . "\"";
         }
   }
   //----- hr_transfer_volta
   function NM_export_hr_transfer_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hr_transfer_volta))
         {
             $this->hr_transfer_volta = sc_convert_encoding($this->hr_transfer_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hr_transfer_volta'])) ? $this->New_label['hr_transfer_volta'] : "Transfer Volta"; 
         }
         else
         {
             $SC_Label = "hr_transfer_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hr_transfer_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hr_transfer_volta) . "\"";
         }
   }
   //----- comprada_bvt_volta
   function NM_export_comprada_bvt_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->comprada_bvt_volta))
         {
             $this->comprada_bvt_volta = sc_convert_encoding($this->comprada_bvt_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['comprada_bvt_volta'])) ? $this->New_label['comprada_bvt_volta'] : "Comprada Bvt Volta"; 
         }
         else
         {
             $SC_Label = "comprada_bvt_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->comprada_bvt_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->comprada_bvt_volta) . "\"";
         }
   }
   //----- data_saida_volta
   function NM_export_data_saida_volta()
   {
             $conteudo_x =  $this->data_saida_volta;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_saida_volta, "YYYY-MM-DD  ");
                 $this->data_saida_volta = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_saida_volta'])) ? $this->New_label['data_saida_volta'] : "Data Saida Volta"; 
         }
         else
         {
             $SC_Label = "data_saida_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_saida_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_saida_volta) . "\"";
         }
   }
   //----- hora_saida_volta
   function NM_export_hora_saida_volta()
   {
             $conteudo_x =  $this->hora_saida_volta;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hora_saida_volta, "HH:II:SS  ");
                 $this->hora_saida_volta = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hora_saida_volta'])) ? $this->New_label['hora_saida_volta'] : "Hora Saida Volta"; 
         }
         else
         {
             $SC_Label = "hora_saida_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hora_saida_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hora_saida_volta) . "\"";
         }
   }
   //----- data_chegada_volta
   function NM_export_data_chegada_volta()
   {
             $conteudo_x =  $this->data_chegada_volta;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_chegada_volta, "YYYY-MM-DD  ");
                 $this->data_chegada_volta = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_chegada_volta'])) ? $this->New_label['data_chegada_volta'] : "Data Chegada Volta"; 
         }
         else
         {
             $SC_Label = "data_chegada_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_chegada_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_chegada_volta) . "\"";
         }
   }
   //----- hora_chegada_volta
   function NM_export_hora_chegada_volta()
   {
             $conteudo_x =  $this->hora_chegada_volta;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hora_chegada_volta, "HH:II:SS  ");
                 $this->hora_chegada_volta = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hora_chegada_volta'])) ? $this->New_label['hora_chegada_volta'] : "Hora Chegada Volta"; 
         }
         else
         {
             $SC_Label = "hora_chegada_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hora_chegada_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hora_chegada_volta) . "\"";
         }
   }
   //----- origem_dsc_volta
   function NM_export_origem_dsc_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->origem_dsc_volta))
         {
             $this->origem_dsc_volta = sc_convert_encoding($this->origem_dsc_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['origem_dsc_volta'])) ? $this->New_label['origem_dsc_volta'] : "Origem Volta"; 
         }
         else
         {
             $SC_Label = "origem_dsc_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->origem_dsc_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->origem_dsc_volta) . "\"";
         }
   }
   //----- destino_dsc_volta
   function NM_export_destino_dsc_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->destino_dsc_volta))
         {
             $this->destino_dsc_volta = sc_convert_encoding($this->destino_dsc_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['destino_dsc_volta'])) ? $this->New_label['destino_dsc_volta'] : "Destino Volta"; 
         }
         else
         {
             $SC_Label = "destino_dsc_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->destino_dsc_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->destino_dsc_volta) . "\"";
         }
   }
   //----- cia_dsc_volta
   function NM_export_cia_dsc_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cia_dsc_volta))
         {
             $this->cia_dsc_volta = sc_convert_encoding($this->cia_dsc_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cia_dsc_volta'])) ? $this->New_label['cia_dsc_volta'] : "Cia. Volta"; 
         }
         else
         {
             $SC_Label = "cia_dsc_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cia_dsc_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cia_dsc_volta) . "\"";
         }
   }
   //----- voo_volta
   function NM_export_voo_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->voo_volta))
         {
             $this->voo_volta = sc_convert_encoding($this->voo_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['voo_volta'])) ? $this->New_label['voo_volta'] : "Voo Volta"; 
         }
         else
         {
             $SC_Label = "voo_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->voo_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->voo_volta) . "\"";
         }
   }
   //----- localizador_volta
   function NM_export_localizador_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->localizador_volta))
         {
             $this->localizador_volta = sc_convert_encoding($this->localizador_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['localizador_volta'])) ? $this->New_label['localizador_volta'] : "Localizador Volta"; 
         }
         else
         {
             $SC_Label = "localizador_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->localizador_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->localizador_volta) . "\"";
         }
   }
   //----- etkt_volta
   function NM_export_etkt_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->etkt_volta))
         {
             $this->etkt_volta = sc_convert_encoding($this->etkt_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['etkt_volta'])) ? $this->New_label['etkt_volta'] : "TKT Volta"; 
         }
         else
         {
             $SC_Label = "etkt_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->etkt_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->etkt_volta) . "\"";
         }
   }
   //----- status_aereo_volta
   function NM_export_status_aereo_volta()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->status_aereo_volta))
         {
             $this->status_aereo_volta = sc_convert_encoding($this->status_aereo_volta, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['status_aereo_volta'])) ? $this->New_label['status_aereo_volta'] : "Status Aéreo Volta"; 
         }
         else
         {
             $SC_Label = "status_aereo_volta"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->status_aereo_volta) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->status_aereo_volta) . "\"";
         }
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
   //----- dt_chegada_proprio
   function NM_export_dt_chegada_proprio()
   {
             $conteudo_x =  $this->dt_chegada_proprio;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->dt_chegada_proprio, "YYYY-MM-DD  ");
                 $this->dt_chegada_proprio = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['dt_chegada_proprio'])) ? $this->New_label['dt_chegada_proprio'] : "Data Chegada Próprio"; 
         }
         else
         {
             $SC_Label = "dt_chegada_proprio"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->dt_chegada_proprio) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->dt_chegada_proprio) . "\"";
         }
   }
   //----- hr_chegada_proprio
   function NM_export_hr_chegada_proprio()
   {
             $conteudo_x =  $this->hr_chegada_proprio;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hr_chegada_proprio, "HH:II:SS  ");
                 $this->hr_chegada_proprio = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hr_chegada_proprio'])) ? $this->New_label['hr_chegada_proprio'] : "Hora Chegada Próprio"; 
         }
         else
         {
             $SC_Label = "hr_chegada_proprio"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hr_chegada_proprio) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hr_chegada_proprio) . "\"";
         }
   }
   //----- valor_diaria
   function NM_export_valor_diaria()
   {
             nmgp_Form_Num_Val($this->valor_diaria, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['valor_diaria'])) ? $this->New_label['valor_diaria'] : "Valor Diaria"; 
         }
         else
         {
             $SC_Label = "valor_diaria"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->valor_diaria) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->valor_diaria) . "\"";
         }
   }
   //----- valor_taxa
   function NM_export_valor_taxa()
   {
             nmgp_Form_Num_Val($this->valor_taxa, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['valor_taxa'])) ? $this->New_label['valor_taxa'] : "Valor Taxa"; 
         }
         else
         {
             $SC_Label = "valor_taxa"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->valor_taxa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->valor_taxa) . "\"";
         }
   }
   //----- obs_transfer
   function NM_export_obs_transfer()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->obs_transfer))
         {
             $this->obs_transfer = sc_convert_encoding($this->obs_transfer, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['obs_transfer'])) ? $this->New_label['obs_transfer'] : "Obs. Transfer"; 
         }
         else
         {
             $SC_Label = "obs_transfer"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->obs_transfer) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->obs_transfer) . "\"";
         }
   }
   //----- anotacoes
   function NM_export_anotacoes()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->anotacoes))
         {
             $this->anotacoes = sc_convert_encoding($this->anotacoes, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['anotacoes'])) ? $this->New_label['anotacoes'] : "Anotacoes"; 
         }
         else
         {
             $SC_Label = "anotacoes"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->anotacoes) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->anotacoes) . "\"";
         }
   }
   //----- id_geral
   function NM_export_id_geral()
   {
             nmgp_Form_Num_Val($this->id_geral, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['id_geral'])) ? $this->New_label['id_geral'] : "Id Geral"; 
         }
         else
         {
             $SC_Label = "id_geral"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->id_geral) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->id_geral) . "\"";
         }
   }
   //----- cpf_mestre
   function NM_export_cpf_mestre()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cpf_mestre))
         {
             $this->cpf_mestre = sc_convert_encoding($this->cpf_mestre, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cpf_mestre'])) ? $this->New_label['cpf_mestre'] : "Cpf Mestre"; 
         }
         else
         {
             $SC_Label = "cpf_mestre"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cpf_mestre) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cpf_mestre) . "\"";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> geral_rsvp_r :: XML</TITLE>
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
<form name="Fdown" method="get" action="grid_geral_rsvp_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_geral_rsvp_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_geral_rsvp_r']['xml_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function PrepGeral($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  	 
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';	
		$_trecho_ida = 'IDA';
		$_trecho_volta = 'VOLTA';		                                                                                        
		$w_aerstatus_volta	= '';
		$w_aerstatus_ida = '';
		$valor_y = 'Y';
	
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
			geral_rsvp_r
			WHERE                                                                                                            
				evento_id = ".$this->Db->qstr($vp_evento)."                                                                                     
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
                                                                                       
			
		}	
		if ($vp_tipoPessoa == 'P') {  
			if($vp_nivel <> 'CONVIDADO') {
				$sqlMestre = "
				SELECT
					participantes_rsvp.part_cpf, 				               	                            	       
					participantes_rsvp.nome_pessoa,                         
					participantes_rsvp.part_id_evento,	                         
					participantes_rsvp.part_nome_cracha,                            
					participantes_rsvp.part_tam_camisa,                  
					participantes_rsvp.part_tam_calcado,                 
					participantes_rsvp.part_cargo,                       
					participantes_rsvp.part_empresa,                     
					participantes_rsvp.part_departamento,                   
					participantes_rsvp.part_grupo,                          
					participantes_rsvp.part_id_evento_publico,              
					participantes_rsvp.part_id_evento_regional,             
					participantes_rsvp.part_dt_cadastro,                    
					participantes_rsvp.part_logradouro,                     
					participantes_rsvp.part_complemento,                    
					participantes_rsvp.part_bairro,                         
					participantes_rsvp.part_cidade,                         
					participantes_rsvp.part_cep,                            
					participantes_rsvp.part_uf,	                              
					participantes_rsvp.part_pais,                           
					participantes_rsvp.part_ddd_01,                         
					participantes_rsvp.part_fone_01,                        
					participantes_rsvp.part_ddd_celular_01,                 
					participantes_rsvp.part_celeular_01,                    
					participantes_rsvp.part_passaporte,                     
					participantes_rsvp.part_validade_pass,                  
					participantes_rsvp.part_rg,                             
					participantes_rsvp.part_filiacao,                       
					participantes_rsvp.part_dt_nasc,                        
					participantes_rsvp.part_fumante,                        
					participantes_rsvp.part_restricao_alimentar,            
					participantes_rsvp.part_email,                          
					participantes_rsvp.part_dt_alt_presenca,                
					participantes_rsvp.part_presenca,                       
					participantes_rsvp.part_contato_rsvp,                   
					participantes_rsvp.part_nome_substituto, 				 				
					hospedagem_rsvp.hosp_cpf_participante,                      
					hospedagem_rsvp.hosp_id_evento,                             
					hospedagem_rsvp.hosp_acompanhante,                          
					hospedagem_rsvp.hosp_part_acomp,                            
					hospedagem_rsvp.hosp_dt_checkin,                            
					hospedagem_rsvp.hosp_dt_checkout,                           
					hospedagem_rsvp.hosp_id_hotel,                              
					hospedagem_rsvp.hosp_reserva_bvt,                           				                          
					transfer_rsvp.tra_id_evento,                                   
					transfer_rsvp.tra_cpf_particip,                                
					transfer_rsvp.tra_dt_saida_ida,                                
					transfer_rsvp.tra_hr_saida_ida,                                
					transfer_rsvp.tra_dt_chegada_ida,                              
					transfer_rsvp.tra_hr_chegada_ida,                              
					transfer_rsvp.tra_cia_ida,                                     
					transfer_rsvp.tra_origem_ida,                                  
					transfer_rsvp.tra_destino_ida,                                 
					transfer_rsvp.tra_numvoo_ida,                                  
					transfer_rsvp.tra_localizador_ida,                             
					transfer_rsvp.tra_eticket_ida,                                 
					transfer_rsvp.tra_hrtransout,                                  
					transfer_rsvp.tra_dt_ida_local,                                
					transfer_rsvp.tra_hr_ida_local,                                
					transfer_rsvp.tra_dt_volta_local,                              
					transfer_rsvp.tra_hr_volta_local,                              
					transfer_rsvp.tra_cia_volta,                                
					transfer_rsvp.tra_origem_volta,                             
					transfer_rsvp.tra_destino_volta,                            
					transfer_rsvp.tra_numvoo_volta,                             
					transfer_rsvp.tra_localizador_volta,                        
					transfer_rsvp.tra_eticket_volta,                            
					transfer_rsvp.tra_observacao,               
					transfer_rsvp.tra_tipo,                            
					hospedagem_rsvp.hosp_early_chkin,  		           
					hospedagem_rsvp.hosp_late_chkout,                    
					transfer_rsvp.tra_status,  					 
					transfer_rsvp.tra_id_hotel_out,				
					transfer_rsvp.tra_dt_saida_volta,			
					transfer_rsvp.tra_hr_saida_volta, 					
					transfer_rsvp.tra_dt_chegada_volta,			
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					participantes_rsvp.part_cod_substituto,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional
				FROM                                            		             
					participantes_rsvp                                             
				LEFT JOIN
					hospedagem_rsvp
				ON
					participantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					participantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					participantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					participantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento					
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento		
				WHERE
					part_id_evento = ".$this->Db->qstr($vp_evento)."                
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."                   		
				AND 	
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 	
				GROUP BY
					participantes_rsvp.part_cpf		
				ORDER BY
					participantes_rsvp.nome_pessoa 	
				";	
			} else {
				$sqlMestre = "
				SELECT
					participantes_rsvp.part_cpf, 				               	                            	       
					participantes_rsvp.nome_pessoa,                         
					participantes_rsvp.part_id_evento,	                         
					participantes_rsvp.part_nome_cracha,                            
					participantes_rsvp.part_tam_camisa,                  
					participantes_rsvp.part_tam_calcado,                 
					participantes_rsvp.part_cargo,                       
					participantes_rsvp.part_empresa,                     
					participantes_rsvp.part_departamento,                   
					participantes_rsvp.part_grupo,                          
					participantes_rsvp.part_id_evento_publico,              
					participantes_rsvp.part_id_evento_regional,             
					participantes_rsvp.part_dt_cadastro,                    
					participantes_rsvp.part_logradouro,                     
					participantes_rsvp.part_complemento,                    
					participantes_rsvp.part_bairro,                         
					participantes_rsvp.part_cidade,                         
					participantes_rsvp.part_cep,                            
					participantes_rsvp.part_uf,	                              
					participantes_rsvp.part_pais,                           
					participantes_rsvp.part_ddd_01,                         
					participantes_rsvp.part_fone_01,                        
					participantes_rsvp.part_ddd_celular_01,                 
					participantes_rsvp.part_celeular_01,                    
					participantes_rsvp.part_passaporte,                     
					participantes_rsvp.part_validade_pass,                  
					participantes_rsvp.part_rg,                             
					participantes_rsvp.part_filiacao,                       
					participantes_rsvp.part_dt_nasc,                        
					participantes_rsvp.part_fumante,                        
					participantes_rsvp.part_restricao_alimentar,            
					participantes_rsvp.part_email,                          
					participantes_rsvp.part_dt_alt_presenca,                
					participantes_rsvp.part_presenca,                       
					participantes_rsvp.part_contato_rsvp,                   
					participantes_rsvp.part_nome_substituto, 				 				
					hospedagem_rsvp.hosp_cpf_participante,                      
					hospedagem_rsvp.hosp_id_evento,                             
					hospedagem_rsvp.hosp_acompanhante,                          
					hospedagem_rsvp.hosp_part_acomp,                            
					hospedagem_rsvp.hosp_dt_checkin,                            
					hospedagem_rsvp.hosp_dt_checkout,                           
					hospedagem_rsvp.hosp_id_hotel,                              
					hospedagem_rsvp.hosp_reserva_bvt,                           				                          
					transfer_rsvp.tra_id_evento,                                   
					transfer_rsvp.tra_cpf_particip,                                
					transfer_rsvp.tra_dt_saida_ida,                                
					transfer_rsvp.tra_hr_saida_ida,                                
					transfer_rsvp.tra_dt_chegada_ida,                              
					transfer_rsvp.tra_hr_chegada_ida,                              
					transfer_rsvp.tra_cia_ida,                                     
					transfer_rsvp.tra_origem_ida,                                  
					transfer_rsvp.tra_destino_ida,                                 
					transfer_rsvp.tra_numvoo_ida,                                  
					transfer_rsvp.tra_localizador_ida,                             
					transfer_rsvp.tra_eticket_ida,                                 
					transfer_rsvp.tra_hrtransout,                                  
					transfer_rsvp.tra_dt_ida_local,                                
					transfer_rsvp.tra_hr_ida_local,                                
					transfer_rsvp.tra_dt_volta_local,                              
					transfer_rsvp.tra_hr_volta_local,                              
					transfer_rsvp.tra_cia_volta,                                
					transfer_rsvp.tra_origem_volta,                             
					transfer_rsvp.tra_destino_volta,                            
					transfer_rsvp.tra_numvoo_volta,                             
					transfer_rsvp.tra_localizador_volta,                        
					transfer_rsvp.tra_eticket_volta,                            
					transfer_rsvp.tra_observacao,               
					transfer_rsvp.tra_tipo,                            
					hospedagem_rsvp.hosp_early_chkin,  		           
					hospedagem_rsvp.hosp_late_chkout,                    
					transfer_rsvp.tra_status,  					 
					transfer_rsvp.tra_id_hotel_out,				
					transfer_rsvp.tra_dt_saida_volta,			
					transfer_rsvp.tra_hr_saida_volta, 					
					transfer_rsvp.tra_dt_chegada_volta,			
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					participantes_rsvp.part_cod_substituto,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional,
					participantes_rsvp.dsc_empresa_rsvp
				FROM                                            		             
					participantes_rsvp                                             
				LEFT JOIN
					hospedagem_rsvp
				ON
					participantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					participantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					participantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					participantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento					
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento		
				WHERE
					part_id_evento =  ".$this->Db->qstr($vp_evento)."  
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 	
				AND 	
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)." 
				GROUP BY
					participantes_rsvp.part_cpf		
				ORDER BY
					participantes_rsvp.nome_pessoa 	
				";					
			}
			$_passa_part = true;	
			
			
			
		} else {
			if($vp_nivel <> 'CONVIDADO') {
				$sqlMestre = "
				SELECT
					acompanhantes_rsvp.part_cpf, 					
					acompanhantes_rsvp.part_nome, 
					acompanhantes_rsvp.part_id_evento,	
					acompanhantes_rsvp.part_nome_cracha, 	 
					acompanhantes_rsvp.part_tam_camisa, 
					acompanhantes_rsvp.part_tam_calcado,
					acompanhantes_rsvp.part_cargo,
					acompanhantes_rsvp.part_empresa,
					acompanhantes_rsvp.part_departamento,
					acompanhantes_rsvp.part_grupo,
					acompanhantes_rsvp.part_id_evento_publico, 
					acompanhantes_rsvp.part_id_evento_regional, 
					acompanhantes_rsvp.part_dt_cadastro, 
					acompanhantes_rsvp.part_logradouro,
					acompanhantes_rsvp.part_complemento, 
					acompanhantes_rsvp.part_bairro,
					acompanhantes_rsvp.part_cidade,
					acompanhantes_rsvp.part_cep,
					acompanhantes_rsvp.part_uf,	
					acompanhantes_rsvp.part_pais,
					acompanhantes_rsvp.part_ddd_01, 
					acompanhantes_rsvp.part_fone_01, 
					acompanhantes_rsvp.part_ddd_celular_01, 
					acompanhantes_rsvp.part_celeular_01, 
					acompanhantes_rsvp.part_passaporte,
					acompanhantes_rsvp.part_validade_pass,
					acompanhantes_rsvp.part_rg,
					acompanhantes_rsvp.part_filiacao,
					acompanhantes_rsvp.part_dt_nasc, 
					acompanhantes_rsvp.part_fumante,
					acompanhantes_rsvp.part_restricao_alimentar,
					acompanhantes_rsvp.part_email,
					acompanhantes_rsvp.part_dt_alt_presenca,
					acompanhantes_rsvp.part_presenca,
					acompanhantes_rsvp.part_contato_rsvp,
					acompanhantes_rsvp.part_cpf_mestre,				
					hospedagem_rsvp.hosp_cpf_participante,
					hospedagem_rsvp.hosp_id_evento,
					hospedagem_rsvp.hosp_acompanhante,
					hospedagem_rsvp.hosp_part_acomp,
					hospedagem_rsvp.hosp_dt_checkin, 
					hospedagem_rsvp.hosp_dt_checkout,
					hospedagem_rsvp.hosp_id_hotel, 
					hospedagem_rsvp.hosp_reserva_bvt,
					transfer_rsvp.tra_id_evento,
					transfer_rsvp.tra_cpf_particip,
					transfer_rsvp.tra_dt_saida_ida,
					transfer_rsvp.tra_hr_saida_ida,
					transfer_rsvp.tra_dt_chegada_ida,
					transfer_rsvp.tra_hr_chegada_ida,
					transfer_rsvp.tra_cia_ida, 
					transfer_rsvp.tra_origem_ida, 
					transfer_rsvp.tra_destino_ida, 
					transfer_rsvp.tra_numvoo_ida, 
					transfer_rsvp.tra_localizador_ida,
					transfer_rsvp.tra_eticket_ida, 
					transfer_rsvp.tra_hrtransout,
					transfer_rsvp.tra_dt_ida_local,
					transfer_rsvp.tra_hr_ida_local,
					transfer_rsvp.tra_dt_volta_local,
					transfer_rsvp.tra_hr_volta_local,
					transfer_rsvp.tra_cia_volta,
					transfer_rsvp.tra_origem_volta,
					transfer_rsvp.tra_destino_volta,
					transfer_rsvp.tra_numvoo_volta,
					transfer_rsvp.tra_localizador_volta,
					transfer_rsvp.tra_eticket_volta,
					transfer_rsvp.tra_observacao,
					transfer_rsvp.tra_tipo,
					hospedagem_rsvp.hosp_early_chkin,  		
					hospedagem_rsvp.hosp_late_chkout,
					transfer_rsvp.tra_status,
					transfer_rsvp.tra_id_hotel_out,
					transfer_rsvp.tra_dt_saida_volta,	
					transfer_rsvp.tra_hr_saida_volta, 	
					transfer_rsvp.tra_dt_chegada_volta,	
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					acompanhantes_rsvp.part_fone_internacional					
				FROM 
					acompanhantes_rsvp
				LEFT JOIN
					hospedagem_rsvp
				ON
					acompanhantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					acompanhantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					acompanhantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					acompanhantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento	
				WHERE
					part_id_evento = ".$this->Db->qstr($vp_evento)." 	
				AND
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."	
				
				GROUP BY
					acompanhantes_rsvp.part_cpf		
				ORDER BY
					acompanhantes_rsvp.part_nome
				";	
			} else {
				$sqlMestre = "
				SELECT
					acompanhantes_rsvp.part_cpf, 					
					acompanhantes_rsvp.part_nome, 
					acompanhantes_rsvp.part_id_evento,	
					acompanhantes_rsvp.part_nome_cracha, 	 
					acompanhantes_rsvp.part_tam_camisa, 
					acompanhantes_rsvp.part_tam_calcado,
					acompanhantes_rsvp.part_cargo,
					acompanhantes_rsvp.part_empresa,
					acompanhantes_rsvp.part_departamento,
					acompanhantes_rsvp.part_grupo,
					acompanhantes_rsvp.part_id_evento_publico, 
					acompanhantes_rsvp.part_id_evento_regional, 
					acompanhantes_rsvp.part_dt_cadastro, 
					acompanhantes_rsvp.part_logradouro,
					acompanhantes_rsvp.part_complemento, 
					acompanhantes_rsvp.part_bairro,
					acompanhantes_rsvp.part_cidade,
					acompanhantes_rsvp.part_cep,
					acompanhantes_rsvp.part_uf,	
					acompanhantes_rsvp.part_pais,
					acompanhantes_rsvp.part_ddd_01, 
					acompanhantes_rsvp.part_fone_01, 
					acompanhantes_rsvp.part_ddd_celular_01, 
					acompanhantes_rsvp.part_celeular_01, 
					acompanhantes_rsvp.part_passaporte,
					acompanhantes_rsvp.part_validade_pass,
					acompanhantes_rsvp.part_rg,
					acompanhantes_rsvp.part_filiacao,
					acompanhantes_rsvp.part_dt_nasc, 
					acompanhantes_rsvp.part_fumante,
					acompanhantes_rsvp.part_restricao_alimentar,
					acompanhantes_rsvp.part_email,
					acompanhantes_rsvp.part_dt_alt_presenca,
					acompanhantes_rsvp.part_presenca,
					acompanhantes_rsvp.part_contato_rsvp,
					acompanhantes_rsvp.part_cpf_mestre,				
					hospedagem_rsvp.hosp_cpf_participante,
					hospedagem_rsvp.hosp_id_evento,
					hospedagem_rsvp.hosp_acompanhante,
					hospedagem_rsvp.hosp_part_acomp,
					hospedagem_rsvp.hosp_dt_checkin, 
					hospedagem_rsvp.hosp_dt_checkout,
					hospedagem_rsvp.hosp_id_hotel, 
					hospedagem_rsvp.hosp_reserva_bvt,
					transfer_rsvp.tra_id_evento,
					transfer_rsvp.tra_cpf_particip,
					transfer_rsvp.tra_dt_saida_ida,
					transfer_rsvp.tra_hr_saida_ida,
					transfer_rsvp.tra_dt_chegada_ida,
					transfer_rsvp.tra_hr_chegada_ida,
					transfer_rsvp.tra_cia_ida, 
					transfer_rsvp.tra_origem_ida, 
					transfer_rsvp.tra_destino_ida, 
					transfer_rsvp.tra_numvoo_ida, 
					transfer_rsvp.tra_localizador_ida,
					transfer_rsvp.tra_eticket_ida, 
					transfer_rsvp.tra_hrtransout,
					transfer_rsvp.tra_dt_ida_local,
					transfer_rsvp.tra_hr_ida_local,
					transfer_rsvp.tra_dt_volta_local,
					transfer_rsvp.tra_hr_volta_local,
					transfer_rsvp.tra_cia_volta,
					transfer_rsvp.tra_origem_volta,
					transfer_rsvp.tra_destino_volta,
					transfer_rsvp.tra_numvoo_volta,
					transfer_rsvp.tra_localizador_volta,
					transfer_rsvp.tra_eticket_volta,
					transfer_rsvp.tra_observacao,
					transfer_rsvp.tra_tipo,
					hospedagem_rsvp.hosp_early_chkin,  		
					hospedagem_rsvp.hosp_late_chkout,
					transfer_rsvp.tra_status,
					transfer_rsvp.tra_id_hotel_out,
					transfer_rsvp.tra_dt_saida_volta,	
					transfer_rsvp.tra_hr_saida_volta, 	
					transfer_rsvp.tra_dt_chegada_volta,	
					transfer_rsvp.tra_hr_chegada_volta,
					transfer_rsvp.tra_dt_chegada_proprio,
					transfer_rsvp.tra_hr_chegada_proprio,
					hospedagem_rsvp.hosp_diarias,
					hospedagem_rsvp.hosp_taxas,
					acompanhantes_rsvp.part_fone_internacional,
					acompanhantes_rsvp.dsc_empresa_rsvp
				FROM 
					acompanhantes_rsvp
				LEFT JOIN
					hospedagem_rsvp
				ON
					acompanhantes_rsvp.part_cpf = hospedagem_rsvp.hosp_cpf_participante
				AND
					acompanhantes_rsvp.part_id_evento = hospedagem_rsvp.hosp_id_evento		
				LEFT JOIN
					transfer_rsvp
				ON
					acompanhantes_rsvp.part_cpf = transfer_rsvp.tra_cpf_particip		
				AND
					acompanhantes_rsvp.part_id_evento = transfer_rsvp.tra_id_evento	
				WHERE
					part_id_evento = ".$this->Db->qstr($vp_evento)."  	
				AND
					acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
				AND
					acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				GROUP BY
					acompanhantes_rsvp.part_cpf		
				ORDER BY
					acompanhantes_rsvp.part_nome
				";	
			}
			$_passa_part = true;	
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
					$_ap_cpf					= $this->rsm[$i][0]; 		 
					$_ap_nome               	= $this->rsm[$i][1];        
					$_ap_id_evento	       		= $this->rsm[$i][2];        
					$_ap_nome_cracha 	   		= $this->rsm[$i][3];        
					$_ap_tam_camisa             = $this->rsm[$i][4];        
					$_ap_tam_calcado            = $this->rsm[$i][5];        
					$_ap_cargo                  = $this->rsm[$i][6];        
					$_ap_empresa                = $this->rsm[$i][7];        
					$_ap_departamento       	= $this->rsm[$i][8];        
					$_ap_grupo              	= $this->rsm[$i][9];        
					$_ap_id_evento_publico  	= $this->rsm[$i][10];       
					$_ap_id_evento_regional 	= $this->rsm[$i][11];       
					$_ap_dt_cadastro        	= $this->rsm[$i][12];       
					$_ap_logradouro         	= $this->rsm[$i][13];       
					$_ap_complemento        	= $this->rsm[$i][14];       
					$_ap_bairro             	= $this->rsm[$i][15];       
					$_ap_cidade             	= $this->rsm[$i][16];       
					$_ap_cep                	= $this->rsm[$i][17];       
					$_ap_uf	                	= $this->rsm[$i][18];       
					$_ap_pais               	= $this->rsm[$i][19];       
					$_ap_ddd_01             	= $this->rsm[$i][20];       
					$_ap_fone_01            	= $this->rsm[$i][21];       
					$_ap_ddd_celular_01     	= $this->rsm[$i][22];       
					$_ap_celeular_01        	= $this->rsm[$i][23];       
					$_ap_passaporte         	= $this->rsm[$i][24];       
					$_ap_validade_pass      	= $this->rsm[$i][25];       
					$_ap_rg                 	= $this->rsm[$i][26];       
					$_ap_filiacao           	= $this->rsm[$i][27];       
					$_ap_dt_nasc            	= $this->rsm[$i][28];       
					$_ap_fumante            	= $this->rsm[$i][29];       
					$_ap_restricao_alimentar	= $this->rsm[$i][30];	    
					$_ap_email              	= $this->rsm[$i][31];       
					$_ap_dt_alt_presenca    	= $this->rsm[$i][32];       
					$_ap_presenca           	= $this->rsm[$i][33];       
					$_ap_contato_rsvp       	= $this->rsm[$i][34];			
					$_ap_nome_substituto 		= $this->rsm[$i][35];			
					$_ho_cpf_participante   	= $this->rsm[$i][36];       
					$_ho_id_evento          	= $this->rsm[$i][37];       
					$_ho_acompanhante       	= $this->rsm[$i][38];       
					$_ho_part_acomp         	= $this->rsm[$i][39];       
					$_ho_dt_checkin         	= $this->rsm[$i][40];       
					$_ho_dt_checkout        	= $this->rsm[$i][41];       
					$_ho_id_hotel           	= $this->rsm[$i][42];       
					$_ho_reserva_bvt        	= $this->rsm[$i][43];       
					$_tr_id_evento          	= $this->rsm[$i][44];       
					$_tr_cpf_particip       	= $this->rsm[$i][45];       
					$_tr_dt_saida_ida       	= $this->rsm[$i][46];       
					$_tr_hr_saida_ida       	= $this->rsm[$i][47];       
					$_tr_dt_chegada_ida     	= $this->rsm[$i][48];       
					$_tr_hr_chegada_ida     	= $this->rsm[$i][49];       
					$_tr_cia_ida            	= $this->rsm[$i][50];       
					$_tr_origem_ida         	= $this->rsm[$i][51];       
					$_tr_destino_ida        	= $this->rsm[$i][52];       
					$_tr_numvoo_ida         	= $this->rsm[$i][53];       
					$_tr_localizador_ida    	= $this->rsm[$i][54];       
					$_tr_eticket_ida        	= $this->rsm[$i][55];       
					$_tr_hrtransout         	= $this->rsm[$i][56];       
					$_tr_dt_ida_local       	= $this->rsm[$i][57];       
					$_tr_hr_ida_local       	= $this->rsm[$i][58];       
					$_tr_dt_volta_local     	= $this->rsm[$i][59];       
					$_tr_hr_volta_local     	= $this->rsm[$i][60];       
					$_tr_cia_volta              = $this->rsm[$i][61];       
					$_tr_origem_volta           = $this->rsm[$i][62];       
					$_tr_destino_volta          = $this->rsm[$i][63];       
					$_tr_numvoo_volta           = $this->rsm[$i][64];       
					$_tr_localizador_volta      = $this->rsm[$i][65];       
					$_tr_eticket_volta          = $this->rsm[$i][66];       
					$_tr_observacao	            = $this->rsm[$i][67];       
					$_tr_tipo_transfer			= $this->rsm[$i][68];    					   
					$_ho_early_chkin  			= $this->rsm[$i][69];    					   
					$_ho_late_chkout			= $this->rsm[$i][70]; 
					$_tr_status       			= $this->rsm[$i][71];
					$_tr_id_hotel_out			= $this->rsm[$i][72]; 
					$_tr_dt_saida_volta			= $this->rsm[$i][73];
					$_tr_hr_saida_volta			= $this->rsm[$i][74];
					$_tr_dt_chegada_volta		= $this->rsm[$i][75];
					$_tr_hr_chegada_volta		= $this->rsm[$i][76];
					$_tr_dt_chegada_prop		= $this->rsm[$i][77];
					$_tr_hr_chegada_prop		= $this->rsm[$i][78];	
					$_ap_cod_substituto			= $this->rsm[$i][79];
					$_ho_hosp_diarias			= $this->rsm[$i][80]; 
					$_ho_hosp_taxas     		= $this->rsm[$i][81]; 
					$_an_anota_dsc				= $this->rsm[$i][82]; 
					$_ap_nome_acompanhado 		= '';		   
					$_ap_cpf_mestre				= '';
					$w_foneinter				= $this->rsm[$i][83];
				} else {
					$_ap_cpf 					= $this->rsm[$i][0];       
					$_ap_nome               	= $this->rsm[$i][1];    
					$_ap_id_evento	        	= $this->rsm[$i][2];    
					$_ap_nome_cracha 	    	= $this->rsm[$i][3];    
					$_ap_tam_camisa         	= $this->rsm[$i][4];    
					$_ap_tam_calcado        	= $this->rsm[$i][5];    
					$_ap_cargo              	= $this->rsm[$i][6];    
					$_ap_empresa            	= $this->rsm[$i][7];    
					$_ap_departamento       	= $this->rsm[$i][8];    
					$_ap_grupo              	= $this->rsm[$i][9];    
					$_ap_id_evento_publico  	= $this->rsm[$i][10];    
					$_ap_id_evento_regional 	= $this->rsm[$i][11];    
					$_ap_dt_cadastro        	= $this->rsm[$i][12];    
					$_ap_logradouro         	= $this->rsm[$i][13];    
					$_ap_complemento        	= $this->rsm[$i][14];    
					$_ap_bairro             	= $this->rsm[$i][15];    
					$_ap_cidade             	= $this->rsm[$i][16];    
					$_ap_cep                	= $this->rsm[$i][17];    
					$_ap_uf	                	= $this->rsm[$i][18];    
					$_ap_pais               	= $this->rsm[$i][19];    
					$_ap_ddd_01             	= $this->rsm[$i][20];    
					$_ap_fone_01            	= $this->rsm[$i][21];    
					$_ap_ddd_celular_01     	= $this->rsm[$i][22];    
					$_ap_celeular_01        	= $this->rsm[$i][23];    
					$_ap_passaporte         	= $this->rsm[$i][24];    
					$_ap_validade_pass      	= $this->rsm[$i][25];    
					$_ap_rg                 	= $this->rsm[$i][26];    
					$_ap_filiacao           	= $this->rsm[$i][27];    
					$_ap_dt_nasc            	= $this->rsm[$i][28];    
					$_ap_fumante            	= $this->rsm[$i][29];    
					$_ap_restricao_alimentar	= $this->rsm[$i][30];    
					$_ap_email              	= $this->rsm[$i][31];    
					$_ap_dt_alt_presenca    	= $this->rsm[$i][32];    
					$_ap_presenca           	= $this->rsm[$i][33];    
					$_ap_contato_rsvp       	= $this->rsm[$i][34];    			
					$_ap_cpf_mestre				= $this->rsm[$i][35];    
					$_ho_cpf_participante    	= $this->rsm[$i][36];    
					$_ho_id_evento           	= $this->rsm[$i][37];    
					$_ho_acompanhante        	= $this->rsm[$i][38];    
					$_ho_part_acomp          	= $this->rsm[$i][39];    
					$_ho_dt_checkin          	= $this->rsm[$i][40];    
					$_ho_dt_checkout         	= $this->rsm[$i][41];    
					$_ho_id_hotel            	= $this->rsm[$i][42];    
					$_ho_reserva_bvt         	= $this->rsm[$i][43];    
					$_tr_id_evento           	= $this->rsm[$i][44];    
					$_tr_cpf_particip        	= $this->rsm[$i][45];    
					$_tr_dt_saida_ida        	= $this->rsm[$i][46];    
					$_tr_hr_saida_ida        	= $this->rsm[$i][47];    
					$_tr_dt_chegada_ida      	= $this->rsm[$i][48];    
					$_tr_hr_chegada_ida      	= $this->rsm[$i][49];    
					$_tr_cia_ida             	= $this->rsm[$i][50];    
					$_tr_origem_ida          	= $this->rsm[$i][51];    
					$_tr_destino_ida         	= $this->rsm[$i][52];    
					$_tr_numvoo_ida          	= $this->rsm[$i][53];    
					$_tr_localizador_ida     	= $this->rsm[$i][54];    
					$_tr_eticket_ida         	= $this->rsm[$i][55];    
					$_tr_hrtransout          	= $this->rsm[$i][56];    
					$_tr_dt_ida_local        	= $this->rsm[$i][57];    
					$_tr_hr_ida_local        	= $this->rsm[$i][58];    
					$_tr_dt_volta_local      	= $this->rsm[$i][59];    
					$_tr_hr_volta_local      	= $this->rsm[$i][60];    
					$_tr_cia_volta           	= $this->rsm[$i][61];    
					$_tr_origem_volta        	= $this->rsm[$i][62];    
					$_tr_destino_volta       	= $this->rsm[$i][63];    
					$_tr_numvoo_volta        	= $this->rsm[$i][64];    
					$_tr_localizador_volta      = $this->rsm[$i][65];    
					$_tr_eticket_volta          = $this->rsm[$i][66];    
					$_tr_observacao	       		= $this->rsm[$i][67];	  
					$_tr_tipo_transfer			= $this->rsm[$i][68];       
					$_ho_early_chkin  			= $this->rsm[$i][69];    					   
					$_ho_late_chkout			= $this->rsm[$i][70];    					   
					$_tr_status       			= $this->rsm[$i][71];
					$_tr_id_hotel_out			= $this->rsm[$i][72]; 
					$_tr_dt_saida_volta			= $this->rsm[$i][73];
					$_tr_hr_saida_volta			= $this->rsm[$i][74];
					$_tr_dt_chegada_volta		= $this->rsm[$i][75];
					$_tr_hr_chegada_volta		= $this->rsm[$i][76];		   
					$_tr_dt_chegada_prop		= $this->rsm[$i][77];
					$_tr_hr_chegada_prop		= $this->rsm[$i][78];			
					$_ho_hosp_diarias			= $this->rsm[$i][79]; 
					$_ho_hosp_taxas     		= $this->rsm[$i][80]; 
					$_ap_nome_substituto		= '';
					$_ap_nome_acompanhado 		= '';			
					$_ap_cod_substituto			= '';
					$w_foneinter				= $this->rsm[$i][83];
				}	
				
				$foneok = is_null($w_foneinter);
				if($foneok == true) {
					$w_foneinter = '';
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
				switch($_tr_tipo_transfer) {                                                                                      
					case 'A':                                                                                                      
						$_tr_tipo_transfer = 'AEREO';  		                                                                               
						break;                                                                                                        
					case 'L':                                                                                                      
						$_tr_tipo_transfer	= 'LOCAL';                                                                                   
						break;                                                                                                        
					case 'P':                                                                                                      
						$_tr_tipo_transfer	= 'PROPRIO';                                                                                 
						break;	                                                                                                       
				}     
				switch($_tr_status) {
				case 'A':
					$_tr_status = 'ABERTO';  		 
					break;
				case 'Y':
					$_tr_status = 'SIM'; 
					break;
				case 'N':
					$_tr_status = 'NAO'; 
					break;		
				case 'P':
					$_tr_status = 'PENDENTE'; 
					break;		
				}			    				
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)." '                                                                                 
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
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = ".$this->Db->qstr($_tr_cia_ida)."                                                                                 
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
					$w_ciaida = $this->rscia[0][1];                                                                                  
				} else {                                                                                                        
					$w_ciaida = "";			                                                                                         
				}						
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = '".$_tr_cia_volta."'                                                                                 
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
					$w_ciavolta = $this->rscia[0][1];                                                                                  
				} else {                                                                                                        
					$w_ciavolta = "";				                                                                                         
				}								
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($_ap_id_evento_publico)."                                                                                 
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
					$w_publico = $this->rspub[0][1];                                                                                  
				} else {                                                                                                        
					$w_publico = "";				                                                                                         
				}
				$sqlHot = "								                                                                                             
				SELECT                                                                                                          
					hotel_id,
					hotel_fantasia
				FROM                                                                                                            
					tbl_hoteis
				WHERE                                                                                                           
					hotel_id = ".$this->Db->qstr($_ho_id_hotel)."                                                                                 
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
					$w_hotel_dsc = $this->rshot[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc = "";				                                                                                         
				}										
				if ($_ho_early_chkin  == 'Y') {
					$_ho_early_chkin  = 'SIM';
				} else {
					$_ho_early_chkin  = 'ABERTO';
				}
				if ($_ho_late_chkout == 'Y') {
					$_ho_late_chkout = 'SIM';
				} else {	
					$_ho_late_chkout = 'ABERTO';
				}	
				$sqlHotout = "								                                                                                             
				SELECT                                                                                                          
					hotel_id,
					hotel_fantasia
				FROM                                                                                                            
					tbl_hoteis
				WHERE                                                                                                           
					hotel_id =  ".$this->Db->qstr($_tr_id_hotel_out)."                                                                                     
				ORDER BY                                                                                                        
					hotel_id
				";		                                                                                                            
				 
      $nm_select = $sqlHotout; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshotout = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshotout[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshotout = false;
          $this->rshotout_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshotout[0][0])) {									                                                                            
					$w_hotel_dsc_out = $this->rshotout[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc_out = "";				                                                                                         
				}											
				if ($vp_tipoPessoa == 'P') {
					$w_tipopess = 'PARTICIPANTE';
				} else {
					$w_tipopess = 'ACOMPANHANTE';
				}				
				$sqlReg = "								                                                                                             
				SELECT                                                                                                          
					regional_id,
					regional_dsc
				FROM                                                                                                            
					tbl_regionais
				WHERE                                                                                                           
					regional_id = ".$this->Db->qstr($_ap_id_evento_regional)."                                                                                  
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
					$w_regional = $this->rsreg[0][1];                                                                                  
				} else {                                                                                                        
					$w_regional = "";				                                                                                         
				}								
				$sqlPais = "								                                                                                             
				SELECT                                                                                                          
					pais_id,
					descricao
				FROM                                                                                                            
					tbl_paises
				WHERE                                                                                                           
					pais_id = ".$this->Db->qstr($_ap_pais)."                                                                                 
				ORDER BY                                                                                                        
					pais_id
				";		                                                                                                            
				 
      $nm_select = $sqlPais; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspais = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspais[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspais = false;
          $this->rspais_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspais[0][0])) {									                                                                            
					$w_pais = $this->rspais[0][1];                                                                                  
				} else {                                                                                                        
					$w_pais = "";				                                                                                         
				}				
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_origem_ida)." 
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
					$w_origemIda = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
				} else {
					$w_origemIda = "";				
				}				
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_destino_ida)."  
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
					$w_destinoIda = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
				} else {
					$w_destinoIda = "";				
				}													
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_origem_volta)."      
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
					$w_origemVolta = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
				} else {
					$w_origemVolta = "";				
				}													
				$sqlAerop = "			
				SELECT
					COD_AEROPORTO,
					SIGLA,
					NOM_AEROPORTO,
					NOM_CIDADE,
					COD_PAIS
				FROM
					aeroporto
				WHERE
					COD_AEROPORTO = ".$this->Db->qstr($_tr_destino_volta)."    
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
					$w_destinoVolta = $this->rsaerop[0][3].' - '.$this->rsaerop[0][1].' - '.$this->rsaerop[0][2].' - '.$this->rsaerop[0][4];
				} else {
					$w_destinoVolta = "";				
				}				
				
				if ($_ap_nome_substituto <> '') {
					$_guardaNome = $_ap_nome;
					$_ap_nome = $_ap_nome_substituto;
				} else {
					$_guardaNome = '';
					$_ap_nome_substituto = '';
				}						
				if ($vp_tipoPessoa == 'A') {
					$sqlAmestre = "			
					SELECT
						part_cpf,
						nome_pessoa,
						part_id_evento					
					FROM
						participantes_rsvp	
					WHERE
						part_cpf = ".$this->Db->qstr($_ap_cpf_mestre)."     
					AND
						part_id_evento = ".$this->Db->qstr($vp_evento)."   
					ORDER BY
						part_cpf,part_id_evento					
					";
					 
      $nm_select = $sqlAmestre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsamestre = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsamestre[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsamestre = false;
          $this->rsamestre_erro = $this->Db->ErrorMsg();
      } 
				
					if (isset($this->rsamestre[0][0])) {									
						$_ap_nome_acompanhado = $this->rsamestre[0][1];
					} else {
						$_ap_nome_acompanhado = '';
					}				
				}	
				$sqlHosp = "								                                                                                             
				SELECT            
					hosp_cpf_participante,                                                                                              
					hosp_id_evento,
					hosp_id_hotel,
					hosp_reserva_bvt
				FROM                                                                                                            
					hospedagem_rsvp
				WHERE
					hosp_cpf_participante = ".$this->Db->qstr($_ap_cpf)."  
				AND
					hosp_id_evento = ".$this->Db->qstr($_ap_id_evento)."    
				AND                                                                                                          
					hosp_id_hotel = ".$this->Db->qstr($_tr_id_hotel_out)."                                                                                   
				ORDER BY                                                                                                        
					hosp_cpf_participante,hosp_id_evento,hosp_id_hotel
				";		                                                                                                            
				 
      $nm_select = $sqlHosp; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshosp = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshosp[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshosp = false;
          $this->rshosp_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshosp[0][0])) {									                                                                            					
					if ($this->rshosp[0][3] == 'Y') {
						$w_comprada_bvt = 'SIM';
					} else{
						$w_comprada_bvt = 'NÃO';
					}	
				} else {                                                                                                        
					$w_comprada_bvt = "";				                                                                                         
				}											
				if ($vp_tipoPessoa == 'P') {
					$w_tipopess = 'PARTICIPANTE';
				} else {
					$w_tipopess = 'ACOMPANHANTE';
				}				
				if ($_ho_reserva_bvt == 'Y') {
					$_ho_reserva_bvt = 'SIM';	
				} else {
					$_ho_reserva_bvt = 'NÃO';	
				}
				if ($_ap_fumante == 'N') {
					$_ap_fumante = 'NÃO';
				} else {
					$_ap_fumante = 'SIM';
				}
				switch($_ap_presenca) {
				case 'A':
					$_ap_presenca = 'ABERTO';  		 
					break;
				case 'Y':
					$_ap_presenca = 'SIM'; 
					break;
				case 'N':
					$_ap_presenca = 'NAO'; 
					break;		
				case 'P':
					$_ap_presenca = 'PENDENTE'; 
					break;		
				}	
				switch($_ap_contato_rsvp) {
				case 'A':
					$_ap_contato_rsvp = 'ABERTO';  		 
					break;
				case 'Y':
					$_ap_contato_rsvp = 'SIM'; 
					break;
				case 'N':
					$_ap_contato_rsvp = 'NAO'; 
					break;		
				case 'P':
					$_ap_contato_rsvp = 'PENDENTE'; 
					break;		
				}
				if ($w_ciaida == "") {
					$w_aerstatus_ida = '';
					$sqltaer = "								                                                                                             
					SELECT                                                                                                          
						aereo_id_evento,
						aereo_cpf_particip,
						aereo_transfer_tipo,
						aereo_status,						
						aereo_dt_saida,
						aereo_hr_saida,
						aereo_dt_chegada,
						aereo_hr_chegada,
						aereo_cia_aerea,
						aereo_origem,
						aereo_destino,
						aereo_num_voo,
						aereo_localizador,
						aereo_eticket
					FROM                                                                                                            
						aereos_rsvp
					WHERE                                                                                                           
						aereo_id_evento = ".$this->Db->qstr($vp_evento)."    
					AND
						aereo_cpf_particip = ".$this->Db->qstr($_ap_cpf)."
					AND
						aereo_transfer_tipo = 'IN'
					ORDER BY                                                                                                        
						aereo_id_evento, aereo_cpf_particip, aereo_transfer_tipo
					";		                                                                                                            
					 
      $nm_select = $sqltaer; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rstaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rstaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rstaer = false;
          $this->rstaer_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rstaer[0][0])) {							
						$_tr_dt_saida_ida       	= $this->rstaer[0][4];       
						$_tr_hr_saida_ida       	= $this->rstaer[0][5];       
						$_tr_dt_chegada_ida     	= $this->rstaer[0][6];       
						$_tr_hr_chegada_ida     	= $this->rstaer[0][7];       
						$w_ciaida      		       	= $this->rstaer[0][8];       
						$w_origemIda        	 	= $this->rstaer[0][9];       
						$w_destinoIda        		= $this->rstaer[0][10];       
						$_tr_numvoo_ida         	= $this->rstaer[0][11];       
						$_tr_localizador_ida    	= $this->rstaer[0][12];       
						$_tr_eticket_ida       		= $this->rstaer[0][13];   
						$w_aerstatus_ida			= $this->rstaer[0][3];
					} else {                                                                                                        
						$w_ciaida = "NÃO ENCONTRADA";			                                                                                         
					}
				}
				if ($w_ciavolta == "") {
					$w_aerstatus_volta	= '';
					$sqltaer = "								                                                                                             
					SELECT                                                                                                          
						aereo_id_evento,
						aereo_cpf_particip,
						aereo_transfer_tipo,
						aereo_status,						
						aereo_dt_saida,
						aereo_hr_saida,
						aereo_dt_chegada,
						aereo_hr_chegada,
						aereo_cia_aerea,
						aereo_origem,
						aereo_destino,
						aereo_num_voo,
						aereo_localizador,
						aereo_eticket
					FROM                                                                                                            
						aereos_rsvp
					WHERE                                                                                                           
						aereo_id_evento = ".$this->Db->qstr($vp_evento)."    
					AND
						aereo_cpf_particip = ".$this->Db->qstr($_ap_cpf)."     
					AND
						aereo_transfer_tipo = 'OUT'
					ORDER BY                                                                                                        
						aereo_id_evento, aereo_cpf_particip, aereo_transfer_tipo
					";		                                                                                                            
					 
      $nm_select = $sqltaer; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rstaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rstaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rstaer = false;
          $this->rstaer_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rstaer[0][0])) {							
						$_tr_dt_saida_volta       	= $this->rstaer[0][4];       
						$_tr_hr_saida_volta       	= $this->rstaer[0][5];       
						$_tr_dt_chegada_volta     	= $this->rstaer[0][6];       
						$_tr_hr_chegada_volta     	= $this->rstaer[0][7];       
						$w_ciavolta    		       	= $this->rstaer[0][8];       
						$w_origemVolta        	 	= $this->rstaer[0][9];       
						$w_destinoVolta        		= $this->rstaer[0][10];       
						$_tr_numvoo_volta         	= $this->rstaer[0][11];       
						$_tr_localizador_volta    	= $this->rstaer[0][12];       
						$_tr_eticket_volta     		= $this->rstaer[0][13];  						
						$w_aerstatus_volta			= $this->rstaer[0][3];
					} else {                                                                                                        
						$w_ciavolta = "NÃO ENCONTRADA";			                                                                                         
					}
				}
				
				switch($w_aerstatus_ida) {                                                                                      
					case 'A':                                                                                                      
						$w_aerstatus_ida = 'ABERTO';  		                                                                               
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_aerstatus_ida	= 'PENDENTE';                                                                                   
						break;                                                                                                        
					case 'N':                                                                                                      
						$w_aerstatus_ida	= 'NÃO';                                                                                 
						break;	                                                                                                       
					case 'Y':                                                                                                      
						$w_aerstatus_ida	= 'CONFIRMADO';                                                                                 
						break;	        
					case '':
						$w_aerstatus_ida	= 'ABERTO';                                                                                 
						break;	        
				}     				
				switch($w_aerstatus_volta) {                                                                                      
					case 'A':                                                                                                      
						$w_aerstatus_volta = 'ABERTO';  		                                                                               
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_aerstatus_volta	= 'PENDENTE';                                                                                   
						break;                                                                                                        
					case 'N':                                                                                                      
						$w_aerstatus_volta	= 'NÃO';                                                                                 
						break;	                                                                                                       
					case 'Y':                                                                                                      
						$w_aerstatus_volta	= 'CONFIRMADO';                                                                                 
						break;	        
					case '':
						$w_aerstatus_volta	= 'ABERTO';                                                                                 
						break;	        
				}  
				
				$sqlpres = "
				SELECT                                                                                                          
					presencas_rsvp.presenca_cpf_participante,
					presencas_rsvp.presenca_id_evento,
					presencas_rsvp.presenca_status,
					presencas_rsvp.presenca_data_hora,
					presencas_rsvp.presenca__frase_resposta,
					presencas_rsvp.presenca_obs,
					presencas_rsvp.presenca_usuario_id,
					presencas_rsvp.presenca_tipo_part, 
					usuarios_rsvp.usuario_nome
				FROM                                                                                                            
					presencas_rsvp
				RIGHT JOIN 
					usuarios_rsvp
				ON 
					usuarios_rsvp.usuario_id = presencas_rsvp.presenca_usuario_id
				WHERE                                                                                                           
					presencas_rsvp.presenca_cpf_participante = ".$this->Db->qstr($_ap_cpf)."                                                                                 
				AND
					presencas_rsvp.presenca_id_evento = ".$this->Db->qstr($vp_evento)."
				ORDER BY                                                                                                        
					presencas_rsvp.presenca_data_hora DESC,
					presencas_rsvp.presenca_id_evento,
					presencas_rsvp.presenca_cpf_participante
				LIMIT 1											
				";
				 
      $nm_select = $sqlpres; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspres = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspres[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspres = false;
          $this->rspres_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspres[0][0])) {											
					$vpresenca_status       = $this->rspres[0][2];
					$vpresenca_data			= $this->rspres[0][3];  
					$vpresenca_motivo       = $this->rspres[0][4];  
					$vpresenca_obs          = $this->rspres[0][5];
					$vpresenca_usuario_id   = $this->rspres[0][6];  
					$vpresenca_tipo_part    = $this->rspres[0][7];
					$vpresenca_usuario_nome	= $this->rspres[0][8];								
					switch($vpresenca_status) {
						case 'Y':
							$vpresenca_status_dsc  = 'SIM';  		  
							break;
						case 'N':
							$vpresenca_status_dsc = 'NÃO'; 
							break;
						case 'A':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;							
						case 'P':
							$vpresenca_status_dsc = 'PENDENTE'; 
							break;	
						case ' ':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;
						case '':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;		
						case 'NULL':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;		
					}					
				} else {
					$vpresenca_status_dsc = 'ABERTO'; 
				}			
				
				
				$sqlcont = "								                                                                                             
				SELECT                                                                                                          
					contatos_rsvp.contato_cpf_participante,
					contatos_rsvp.contato_id_evento,
					contatos_rsvp.contato_status,
					contatos_rsvp.contato_data_hora,
					contatos_rsvp.contato_motivo_frase,
					contatos_rsvp.contato_obs,
					contatos_rsvp.contato_usuario_id,
					usuarios_rsvp.usuario_nome
				FROM                                                                                                            
					contatos_rsvp
				RIGHT JOIN 
					usuarios_rsvp
				ON 
					usuarios_rsvp.usuario_id = contatos_rsvp.contato_usuario_id 							
				WHERE                                                                                                           
					contatos_rsvp.contato_cpf_participante = ".$this->Db->qstr($_ap_cpf)."                                                                            
				AND
					contatos_rsvp.contato_id_evento = ".$this->Db->qstr($vp_evento)."   
				ORDER BY                                                                                                        
					contatos_rsvp.contato_data_hora DESC,
					contato_id_evento,
					contato_cpf_participante
				LIMIT 1						
				";
				 
      $nm_select = $sqlcont; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscont = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscont[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscont = false;
          $this->rscont_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscont[0][0])) {					
					$vcontato_cpf 			= $this->rscont[0][0];			
					$vcontato_status        = $this->rscont[0][2];   
					$vcontato_data          = $this->rscont[0][3];  
					$vcontato_motivo        = $this->rscont[0][4]; 
					$vcontato_obs           = $this->rscont[0][5]; 
					$vcontato_usuario_id    = $this->rscont[0][6];   
					$vcontato_usuario_nome	= $this->rscont[0][7];						
					switch($vcontato_status) {
						case 'Y':
							$vcontato_status_dsc = 'SIM';  		  
							break;
						case 'N':
							$vcontato_status_dsc = 'NÃO'; 
							break;
						case 'A':
							$vcontato_status_dsc = 'ABERTO'; 
							break;							
						case 'P':
							$vcontato_status_dsc = 'PENDENTE'; 
							break;	
						case ' ':
							$vcontato_status_dsc = 'ABERTO'; 							
							break;								
						case '':
							$vcontato_status_dsc = 'ABERTO'; 
							break;		
						case 'NULL':
							$vcontato_status_dsc = 'ABERTO'; 
							break;		
					}	
					$_ap_contato_rsvp = $vcontato_data;
				} else {
					$vcontato_status_dsc = 'ABERTO'; 	
				}	
				$sqlins = "
					SELECT 
						COUNT(cpf) as qtde
					FROM 
						geral_rsvp_r
					WHERE 
						cpf = ".$this->Db->qstr($_ap_cpf)."    
					AND 
						evento_id = ".$this->Db->qstr($vp_evento)."    
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
							geral_rsvp_r
							(evento_id,               	        
							evento_dsc,                 
							cpf,                                     
							nome_participante,             
							cpf_mestre,                  
							nome_acompanhado,                                       
							tipo_pessoa,                       
							nome_cracha,                       
							convidado_original,           
							nome_substituto,                
							acomp_mesmoquarto,             
							partici_mesmoquarto,         
							checkin,                              
							checkout,                             
							tamanho_camisa,                  
							tamanho_calcado,                
							hotel,                                  
							hotel_dsc,                   	                                
							comprado_bvt,                      
							cargo,                                  
							empresa,                              
							departamento,                      
							grupo,                                  
							publico,                              
							publico_dsc,                                               
							regional,                             
							regional_dsc,                                   
							data_cadastro,                    
							logradouro,                         
							complemento,                       
							bairro,                                
							cidade,                                
							cep,                                     
							uf,                                       
							pais_dsc,                                    
							ddd_tel01,                           
							tel01,                                  
							ddd_celular,                       
							celular,                              
							passaporte,                         
							validade_passporte,           
							rg,                                       
							filiacao,                             
							data_nascimento,                
							fumante,                          
							restricao_alimentar,         
							e_mail,                                
							atualizacao_presenca,        
							presenca,                             
							contato,                              
							trecho,                                            
							hotel_ida,                                           
							hotel_ida_dsc,                                   
							comprada_bvt_ida,                  
							data_saida_ida,        		
							hora_saida_ida,        		
							data_chegada_ida,            
							hora_chegada_ida,            
							cia_aerea_ida,         		
							cia_dsc_ida,           		
							origem_ida,            		
							origem_dsc_ida,        		
							destino_ida,           		
							destino_dsc_ida,       		
							voo_ida,               		
							localizador_ida,				  
							etkt_ida,              		
							hotel_volta,           		
							hotel_volta_dsc,       		
							comprada_bvt_volta,    		
							hr_transfer_volta,     		
							data_saida_volta,      		
							hora_saida_volta,            
							data_chegada_volta,          
							hora_chegada_volta,          
							cia_aerea_volta,       		
							cia_dsc_volta,         		
							origem_volta,				  
							origem_dsc_volta,      		
							destino_volta,         		
							destino_dsc_volta,     		
							voo_volta,             		
							localizador_volta,     		
							etkt_volta,            		
							obs_transfer,          		
							id_usuario_relato,     		
							usuario_relato_dsc,    		
							tipo_transfer,         		
							early_checkin,         		
							late_checkout,         		
							trecho_volta,
							dt_chegada_proprio,
							hr_chegada_proprio,
							status_aereo_ida,
							status_aereo_volta,
							valor_diaria,
							valor_taxa,
							dt_confirm_presenca,
							presenca_motivo,
							presenca_atendente,
							presenca_obs,
							contato_antendente,
							data_contato,
							motivo_contato,
							obs_contato,
							status_contato,
							anotacoes,
							telefone_internacional)		
						VALUES
							('".$_ap_id_evento."',          
							'".$w_eventoDsc."',         
							'".$_ap_cpf."',                
							'".$_ap_nome."',               
							'".$_ap_cpf_mestre."',      
							'".$_ap_nome_acompanhado."', 	
							'".$w_tipopess."',             
							'".$_ap_nome_cracha."',        
							'".$_guardaNome."',            
							'".$_ap_nome_substituto."',    
							'".$_ho_acompanhante."',       
							'".$_ho_part_acomp."',         
							'".$_ho_dt_checkin."',         
							'".$_ho_dt_checkout."',        
							'".$_ap_tam_camisa."',         
							'".$_ap_tam_calcado."',        
							'".$_ho_id_hotel."',           
							'".$w_hotel_dsc."',			
							'".$_ho_reserva_bvt."',        
							'".$_ap_cargo."',              
							'".$_ap_empresa."',            
							'".$_ap_departamento."',       
							'".$_ap_grupo."',              
							'".$_ap_id_evento_publico."',  
							'".$w_publico."',				
							'".$_ap_id_evento_regional."', 
							'".$w_regional."',             
							'".$_ap_dt_cadastro."',        
							'".$_ap_logradouro."',         
							'".$_ap_complemento."',        
							'".$_ap_bairro."',             
							'".$_ap_cidade."',             
							'".$_ap_cep."',                
							'".$_ap_uf."',	                
							'".$w_pais."',               
							'".$_ap_ddd_01."',             
							'".$_ap_fone_01."',            
							'".$_ap_ddd_celular_01."',     
							'".$_ap_celeular_01."',        
							'".$_ap_passaporte."',         
							'".$_ap_validade_pass."',      
							'".$_ap_rg."',                 
							'".$_ap_filiacao."',           
							'".$_ap_dt_nasc."',            
							'".$_ap_fumante."',            
							'".$_ap_restricao_alimentar."',
							'".$_ap_email."',              
							'".$_ap_dt_alt_presenca."',    
							'".$_ap_presenca."',           
							'".$_ap_contato_rsvp."',       
							'".$_trecho_ida."',            
							'".$_ho_id_hotel."',           
							'".$w_hotel_dsc."',            
							'".$_ho_reserva_bvt."',        
							'".$_tr_dt_saida_ida."', 
							'".$_tr_hr_saida_ida."',
							'".$_tr_dt_chegada_ida."',
							'".$_tr_hr_chegada_ida."',
							'".$_tr_cia_ida."', 
							'".$w_ciaida."',
							'".$_tr_origem_ida."',
							'".$w_origemIda."',
							'".$_tr_destino_ida."',
							'".$w_destinoIda."',
							'".$_tr_numvoo_ida."',
							'".$_tr_localizador_ida."',    
							'".$_tr_eticket_ida."',
							'".$_tr_id_hotel_out."',
							'".$w_hotel_dsc_out."',
							'".$w_comprada_bvt."',
							'".$_tr_hrtransout."',
							'".$_tr_dt_saida_volta."',
							'".$_tr_hr_saida_volta."',	 
							'".$_tr_dt_chegada_volta."',
							'".$_tr_hr_chegada_volta."',
							'".$_tr_cia_volta."',
							'".$w_ciavolta."',
							'".$_tr_origem_volta."',       
							'".$w_origemVolta."',
							'".$_tr_destino_volta."',
							'".$w_destinoVolta."',
							'".$_tr_numvoo_volta."',
							'".$_tr_localizador_volta."',
							'".$_tr_eticket_volta."',
							'".$_tr_observacao."',
							'".$vp_usuario."',
							'".$w_usurelDsc."',
							'".$_tr_tipo_transfer."',
							'".$_ho_early_chkin."',
							'".$_ho_late_chkout."',
							'".$_trecho_volta."',					
							'".$_tr_dt_chegada_prop."',		
							'".$_tr_hr_chegada_prop."',
							'".$w_aerstatus_ida."',
							'".$w_aerstatus_volta."',
							'".$_ho_hosp_diarias."',
							'".$_ho_hosp_taxas."',
							'".$vpresenca_data."',
							'".$vpresenca_motivo."',
							'".$vpresenca_usuario_nome."',
							'".$vpresenca_obs."',
							'".$vcontato_usuario_nome."',
							'".$vcontato_data."',
							'".$vcontato_motivo."',
							'".$vcontato_obs."',
							'".$vcontato_status_dsc."',
							'".$_an_anota_dsc."',
							'".$w_foneinter."')	
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
					
				} else {
					
					
				}	
			}
			$ret = 'ADICIONA OK'; 			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}			
		return $ret;
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function RetNivelUpd($nivel) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_geral_rsvp_r']['contr_erro'] = 'off';
}

}

?>
