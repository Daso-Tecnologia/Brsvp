<?php

class grid_rsvp_part_r_xml
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
   var $cnt_p_cpf;

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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida'])
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['opcao'] = "";
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
                   nm_limpa_str_grid_rsvp_part_r($cadapar[1]);
                   nm_protect_num_grid_rsvp_part_r($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_rsvp_part_r']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_rsvp_part_r($_SESSION["parm1"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_rsvp_part_r($_SESSION["vg_usuario_id"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_rsvp_part_r($_SESSION["rsvp_global"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_rsvp_part_r($_SESSION["vg_cpfseg"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_rsvp_part_r($_SESSION["vg_menu_item"]);
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_rsvp_part_r($_SESSION["vg_evento_id"]);
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['SC_Gb_Free_cmp']))
      {
          $this->Tem_xml_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_rsvp_part_r/grid_rsvp_part_r_res_xml.class.php"))
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_label']))
      {
          $this->Xml_tag_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_label'];
          $this->New_Format    = true;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_rsvp_part_r_total.class.php"); 
      $this->Tot      = new grid_rsvp_part_r_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['tot_geral'][1];
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['SC_Ind_Groupby'] == "sc_free_total")
          {
              $this->cnt_p_cpf = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['tot_geral'][2];
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_rsvp_part_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_return']);
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
      $this->Arq_zip      = $this->Arquivo . "_grid_rsvp_part_r.zip";
      $this->Arquivo     .= "_grid_rsvp_part_r";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "grid_rsvp_part_r.xml";
      $this->Tit_zip      = "grid_rsvp_part_r.zip";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_part_r']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->p_tam_camisa = (isset($Busca_temp['p_tam_camisa'])) ? $Busca_temp['p_tam_camisa'] : ""; 
          $tmp_pos = (is_string($this->p_tam_camisa)) ? strpos($this->p_tam_camisa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->p_tam_camisa))
          {
              $this->p_tam_camisa = substr($this->p_tam_camisa, 0, $tmp_pos);
          }
          $this->publico_nome = (isset($Busca_temp['publico_nome'])) ? $Busca_temp['publico_nome'] : ""; 
          $tmp_pos = (is_string($this->publico_nome)) ? strpos($this->publico_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico_nome))
          {
              $this->publico_nome = substr($this->publico_nome, 0, $tmp_pos);
          }
          $this->regional_nome = (isset($Busca_temp['regional_nome'])) ? $Busca_temp['regional_nome'] : ""; 
          $tmp_pos = (is_string($this->regional_nome)) ? strpos($this->regional_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->regional_nome))
          {
              $this->regional_nome = substr($this->regional_nome, 0, $tmp_pos);
          }
          $this->p_nome = (isset($Busca_temp['p_nome'])) ? $Busca_temp['p_nome'] : ""; 
          $tmp_pos = (is_string($this->p_nome)) ? strpos($this->p_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->p_nome))
          {
              $this->p_nome = substr($this->p_nome, 0, $tmp_pos);
          }
          $this->contato_status_dsc = (isset($Busca_temp['contato_status_dsc'])) ? $Busca_temp['contato_status_dsc'] : ""; 
          $tmp_pos = (is_string($this->contato_status_dsc)) ? strpos($this->contato_status_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->contato_status_dsc))
          {
              $this->contato_status_dsc = substr($this->contato_status_dsc, 0, $tmp_pos);
          }
          $this->presenca_status_dsc = (isset($Busca_temp['presenca_status_dsc'])) ? $Busca_temp['presenca_status_dsc'] : ""; 
          $tmp_pos = (is_string($this->presenca_status_dsc)) ? strpos($this->presenca_status_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->presenca_status_dsc))
          {
              $this->presenca_status_dsc = substr($this->presenca_status_dsc, 0, $tmp_pos);
          }
          $this->hotel_fantasia = (isset($Busca_temp['hotel_fantasia'])) ? $Busca_temp['hotel_fantasia'] : ""; 
          $tmp_pos = (is_string($this->hotel_fantasia)) ? strpos($this->hotel_fantasia, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_fantasia))
          {
              $this->hotel_fantasia = substr($this->hotel_fantasia, 0, $tmp_pos);
          }
          $this->contato_usuario_nome = (isset($Busca_temp['contato_usuario_nome'])) ? $Busca_temp['contato_usuario_nome'] : ""; 
          $tmp_pos = (is_string($this->contato_usuario_nome)) ? strpos($this->contato_usuario_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->contato_usuario_nome))
          {
              $this->contato_usuario_nome = substr($this->contato_usuario_nome, 0, $tmp_pos);
          }
          $this->presenca_usuario_dsc = (isset($Busca_temp['presenca_usuario_dsc'])) ? $Busca_temp['presenca_usuario_dsc'] : ""; 
          $tmp_pos = (is_string($this->presenca_usuario_dsc)) ? strpos($this->presenca_usuario_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->presenca_usuario_dsc))
          {
              $this->presenca_usuario_dsc = substr($this->presenca_usuario_dsc, 0, $tmp_pos);
          }
          $this->hospedagem_tipo_pessoa = (isset($Busca_temp['hospedagem_tipo_pessoa'])) ? $Busca_temp['hospedagem_tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_tipo_pessoa)) ? strpos($this->hospedagem_tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_tipo_pessoa))
          {
              $this->hospedagem_tipo_pessoa = substr($this->hospedagem_tipo_pessoa, 0, $tmp_pos);
          }
          $this->hospedagem_dtchkin = (isset($Busca_temp['hospedagem_dtchkin'])) ? $Busca_temp['hospedagem_dtchkin'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_dtchkin)) ? strpos($this->hospedagem_dtchkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_dtchkin))
          {
              $this->hospedagem_dtchkin = substr($this->hospedagem_dtchkin, 0, $tmp_pos);
          }
          $this->hospedagem_dtchkin_2 = (isset($Busca_temp['hospedagem_dtchkin_input_2'])) ? $Busca_temp['hospedagem_dtchkin_input_2'] : ""; 
          $this->hospedagem_hrchkin = (isset($Busca_temp['hospedagem_hrchkin'])) ? $Busca_temp['hospedagem_hrchkin'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_hrchkin)) ? strpos($this->hospedagem_hrchkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_hrchkin))
          {
              $this->hospedagem_hrchkin = substr($this->hospedagem_hrchkin, 0, $tmp_pos);
          }
          $this->hospedagem_dtchkout = (isset($Busca_temp['hospedagem_dtchkout'])) ? $Busca_temp['hospedagem_dtchkout'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_dtchkout)) ? strpos($this->hospedagem_dtchkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_dtchkout))
          {
              $this->hospedagem_dtchkout = substr($this->hospedagem_dtchkout, 0, $tmp_pos);
          }
          $this->hospedagem_dtchkout_2 = (isset($Busca_temp['hospedagem_dtchkout_input_2'])) ? $Busca_temp['hospedagem_dtchkout_input_2'] : ""; 
          $this->hospedagem_hrchkout = (isset($Busca_temp['hospedagem_hrchkout'])) ? $Busca_temp['hospedagem_hrchkout'] : ""; 
          $tmp_pos = (is_string($this->hospedagem_hrchkout)) ? strpos($this->hospedagem_hrchkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospedagem_hrchkout))
          {
              $this->hospedagem_hrchkout = substr($this->hospedagem_hrchkout, 0, $tmp_pos);
          }
          $this->presenca_status = (isset($Busca_temp['presenca_status'])) ? $Busca_temp['presenca_status'] : ""; 
          $tmp_pos = (is_string($this->presenca_status)) ? strpos($this->presenca_status, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->presenca_status))
          {
              $this->presenca_status = substr($this->presenca_status, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
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
$this->sc_temp_vg_evento_id = $this->sc_temp_parm1;
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

$this->usuario_nivel  = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
if ($this->usuario_nivel  <> 'ADMINISTRADOR') {	
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_rsvp_part_r";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['sc_outra_jan'] = false;
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
        action="grid_rsvp_part_r_fim.php"
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


$params = array(
	'title' => 'Atenção!',
	'type' => 'warning',
	'timer' => '5000',
	'showConfirmButton' => 'false',
	'position' => 'center',
	'toast' => 'true'
);

$sqlver="
	SELECT
   		p_evento,
		id_usuario_relato
	FROM
		rsvp_part_r
	WHERE   
		p_evento = ".$this->Db->qstr($this->sc_temp_parm1)."
	ORDER BY 
		p_evento,
		id_usuario_relato
	";	
 
      $nm_select = $sqlver; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsv = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsv[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsv = false;
          $this->rsv_erro = $this->Db->ErrorMsg();
      } 
	
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

$reg_ver = sizeof($this->rsv );
if ($reg_ver == 0) {
	$this->sc_temp_vg_evento_id = $this->sc_temp_parm1;
	$resultado = $this->PrepRelRsvp($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,$this->usuario_nivel );
	
}

if ($reg_ver == 0) {
	$_vacomp = $this->BuscaAcomp($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'RSVP');	
} else {
	
	$sqld="
	DELETE FROM 
		rsvp_part_r
	WHERE   
		p_evento = ".$this->Db->qstr($this->sc_temp_parm1)."
	AND 
   		id_usuario_relato = ".$this->Db->qstr($this->sc_temp_vg_usuario_id)."
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

	$this->sc_temp_vg_evento_id = $this->sc_temp_parm1;
	$resultado = $this->PrepRelRsvp($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,$this->usuario_nivel );
	$_vacomp = $this->BuscaAcomp($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'RSVP');	
}

if ($resultado == 'ADICIONA OK' && $resultado2 == 'ADICIONA OK2') {
	$this->usuario_nivel  = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
	$this->RetNivel($this->usuario_nivel );
	$rodape  = 'Logado: '.$this->sc_temp_vg_usuario_id.' - '.$this->usuario_nivel ;
	$id_evento  = $this->sc_temp_vg_evento_id;
	$this->id_usuario_relato  = $this->sc_temp_vg_usuario_id;	
} else {	
}

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida'])
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
          $nmgp_select = "SELECT p_cpf, p_nome, str_replace (convert(char(10),data_nascimento,102), '.', '-') + ' ' + convert(char(8),data_nascimento,20), rg, cpf_informado, acompanhantes_nomes, publico_nome, regional_nome, p_grupo, p_departamento, p_cargo, p_tam_camisa, p_idioma, p_empresa, p_uf, p_pais, p_email, p_email_secretaria, p_ddd_01, p_fone_01, p_ddd_celular_01, p_celular_01, telefone_internacional, contato_usuario_nome, contato_data, contato_status_dsc, contato_motivo, contato_obs, presenca_status_dsc, presenca_motivo, presenca_data, presenca_usuario_dsc, presenca_obs, anotacoes, id_rsvp_r, p_regional, p_publico, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT p_cpf, p_nome, data_nascimento, rg, cpf_informado, acompanhantes_nomes, publico_nome, regional_nome, p_grupo, p_departamento, p_cargo, p_tam_camisa, p_idioma, p_empresa, p_uf, p_pais, p_email, p_email_secretaria, p_ddd_01, p_fone_01, p_ddd_celular_01, p_celular_01, telefone_internacional, contato_usuario_nome, contato_data, contato_status_dsc, contato_motivo, contato_obs, presenca_status_dsc, presenca_motivo, presenca_data, presenca_usuario_dsc, presenca_obs, anotacoes, id_rsvp_r, p_regional, p_publico, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT p_cpf, p_nome, convert(char(23),data_nascimento,121), rg, cpf_informado, acompanhantes_nomes, publico_nome, regional_nome, p_grupo, p_departamento, p_cargo, p_tam_camisa, p_idioma, p_empresa, p_uf, p_pais, p_email, p_email_secretaria, p_ddd_01, p_fone_01, p_ddd_celular_01, p_celular_01, telefone_internacional, contato_usuario_nome, contato_data, contato_status_dsc, contato_motivo, contato_obs, presenca_status_dsc, presenca_motivo, presenca_data, presenca_usuario_dsc, presenca_obs, anotacoes, id_rsvp_r, p_regional, p_publico, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT p_cpf, p_nome, data_nascimento, rg, cpf_informado, acompanhantes_nomes, publico_nome, regional_nome, p_grupo, p_departamento, p_cargo, p_tam_camisa, p_idioma, p_empresa, p_uf, p_pais, p_email, p_email_secretaria, p_ddd_01, p_fone_01, p_ddd_celular_01, p_celular_01, telefone_internacional, contato_usuario_nome, TO_DATE(TO_CHAR(contato_data, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), contato_status_dsc, contato_motivo, contato_obs, presenca_status_dsc, presenca_motivo, TO_DATE(TO_CHAR(presenca_data, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), presenca_usuario_dsc, presenca_obs, anotacoes, id_rsvp_r, p_regional, p_publico, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT p_cpf, p_nome, EXTEND(data_nascimento, YEAR TO DAY), rg, cpf_informado, acompanhantes_nomes, publico_nome, regional_nome, p_grupo, p_departamento, p_cargo, p_tam_camisa, p_idioma, p_empresa, p_uf, p_pais, p_email, p_email_secretaria, p_ddd_01, p_fone_01, p_ddd_celular_01, p_celular_01, telefone_internacional, contato_usuario_nome, contato_data, contato_status_dsc, contato_motivo, contato_obs, presenca_status_dsc, presenca_motivo, presenca_data, presenca_usuario_dsc, presenca_obs, anotacoes, id_rsvp_r, p_regional, p_publico, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT p_cpf, p_nome, data_nascimento, rg, cpf_informado, acompanhantes_nomes, publico_nome, regional_nome, p_grupo, p_departamento, p_cargo, p_tam_camisa, p_idioma, p_empresa, p_uf, p_pais, p_email, p_email_secretaria, p_ddd_01, p_fone_01, p_ddd_celular_01, p_celular_01, telefone_internacional, contato_usuario_nome, contato_data, contato_status_dsc, contato_motivo, contato_obs, presenca_status_dsc, presenca_motivo, presenca_data, presenca_usuario_dsc, presenca_obs, anotacoes, id_rsvp_r, p_regional, p_publico, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['order_grid'];
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
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida'])
         { 
             $this->xml_registro .= "<" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro = "<grid_rsvp_part_r>\r\n";
         }
         else
         {
             $this->xml_registro = "<grid_rsvp_part_r";
         }
         $this->p_cpf = $rs->fields[0] ;  
         $this->p_nome = $rs->fields[1] ;  
         $this->data_nascimento = $rs->fields[2] ;  
         $this->rg = $rs->fields[3] ;  
         $this->cpf_informado = $rs->fields[4] ;  
         $this->acompanhantes_nomes = $rs->fields[5] ;  
         $this->publico_nome = $rs->fields[6] ;  
         $this->regional_nome = $rs->fields[7] ;  
         $this->p_grupo = $rs->fields[8] ;  
         $this->p_departamento = $rs->fields[9] ;  
         $this->p_cargo = $rs->fields[10] ;  
         $this->p_tam_camisa = $rs->fields[11] ;  
         $this->p_idioma = $rs->fields[12] ;  
         $this->p_empresa = $rs->fields[13] ;  
         $this->p_uf = $rs->fields[14] ;  
         $this->p_pais = $rs->fields[15] ;  
         $this->p_email = $rs->fields[16] ;  
         $this->p_email_secretaria = $rs->fields[17] ;  
         $this->p_ddd_01 = $rs->fields[18] ;  
         $this->p_fone_01 = $rs->fields[19] ;  
         $this->p_ddd_celular_01 = $rs->fields[20] ;  
         $this->p_celular_01 = $rs->fields[21] ;  
         $this->telefone_internacional = $rs->fields[22] ;  
         $this->contato_usuario_nome = $rs->fields[23] ;  
         $this->contato_data = $rs->fields[24] ;  
         $this->contato_status_dsc = $rs->fields[25] ;  
         $this->contato_motivo = $rs->fields[26] ;  
         $this->contato_obs = $rs->fields[27] ;  
         $this->presenca_status_dsc = $rs->fields[28] ;  
         $this->presenca_motivo = $rs->fields[29] ;  
         $this->presenca_data = $rs->fields[30] ;  
         $this->presenca_usuario_dsc = $rs->fields[31] ;  
         $this->presenca_obs = $rs->fields[32] ;  
         $this->anotacoes = $rs->fields[33] ;  
         $this->id_rsvp_r = $rs->fields[34] ;  
         $this->id_rsvp_r = (string)$this->id_rsvp_r;
         $this->p_regional = $rs->fields[35] ;  
         $this->p_regional = (string)$this->p_regional;
         $this->p_publico = $rs->fields[36] ;  
         $this->p_publico = (string)$this->p_publico;
         $this->id_usuario_relato = $rs->fields[37] ;  
         $this->id_usuario_relato = (string)$this->id_usuario_relato;
         //----- lookup - p_regional
         $this->look_p_regional = $this->p_regional; 
         $this->Lookup->lookup_p_regional($this->look_p_regional, $this->p_regional) ; 
         $this->look_p_regional = ($this->look_p_regional == "&nbsp;") ? "" : $this->look_p_regional; 
         //----- lookup - p_publico
         $this->look_p_publico = $this->p_publico; 
         $this->Lookup->lookup_p_publico($this->look_p_publico, $this->p_publico) ; 
         $this->look_p_publico = ($this->look_p_publico == "&nbsp;") ? "" : $this->look_p_publico; 
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida'])
         { 
             $this->xml_registro .= "</" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro .= "</grid_rsvp_part_r>\r\n";
         }
         else
         {
             $this->xml_registro .= " />\r\n";
         }
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida'])
         { 
             fwrite($xml_f, $this->xml_registro);
             if ($this->Grava_view)
             {
                fwrite($xml_v, $this->xml_registro);
             }
         }
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['embutida'])
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
              require_once($this->Ini->path_aplicacao . "grid_rsvp_part_r_res_xml.class.php");
              $this->Res = new grid_rsvp_part_r_res_xml();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_res_grid'] = true;
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
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_res_file']['xml'];
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_res_file']['xml']);
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
                      $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_res_file']['view'];
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
                      unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_res_file']['view']);
                  }
              } 
              else 
              {
                  $this->Arquivo_view = $this->Arq_zip;
              } 
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- p_cpf
   function NM_export_p_cpf()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_cpf))
         {
             $this->p_cpf = sc_convert_encoding($this->p_cpf, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_cpf'])) ? $this->New_label['p_cpf'] : "Cód. / CPF"; 
         }
         else
         {
             $SC_Label = "p_cpf"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_cpf) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_cpf) . "\"";
         }
   }
   //----- p_nome
   function NM_export_p_nome()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_nome))
         {
             $this->p_nome = sc_convert_encoding($this->p_nome, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_nome'])) ? $this->New_label['p_nome'] : "Participante"; 
         }
         else
         {
             $SC_Label = "p_nome"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_nome) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_nome) . "\"";
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
             $SC_Label = (isset($this->New_label['rg'])) ? $this->New_label['rg'] : "Rg"; 
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
   //----- cpf_informado
   function NM_export_cpf_informado()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cpf_informado))
         {
             $this->cpf_informado = sc_convert_encoding($this->cpf_informado, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cpf_informado'])) ? $this->New_label['cpf_informado'] : "CPF"; 
         }
         else
         {
             $SC_Label = "cpf_informado"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cpf_informado) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cpf_informado) . "\"";
         }
   }
   //----- acompanhantes_nomes
   function NM_export_acompanhantes_nomes()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->acompanhantes_nomes))
         {
             $this->acompanhantes_nomes = sc_convert_encoding($this->acompanhantes_nomes, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['acompanhantes_nomes'])) ? $this->New_label['acompanhantes_nomes'] : "Acompanhantes "; 
         }
         else
         {
             $SC_Label = "acompanhantes_nomes"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->acompanhantes_nomes) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->acompanhantes_nomes) . "\"";
         }
   }
   //----- publico_nome
   function NM_export_publico_nome()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->publico_nome))
         {
             $this->publico_nome = sc_convert_encoding($this->publico_nome, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['publico_nome'])) ? $this->New_label['publico_nome'] : "Público"; 
         }
         else
         {
             $SC_Label = "publico_nome"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->publico_nome) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->publico_nome) . "\"";
         }
   }
   //----- regional_nome
   function NM_export_regional_nome()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->regional_nome))
         {
             $this->regional_nome = sc_convert_encoding($this->regional_nome, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['regional_nome'])) ? $this->New_label['regional_nome'] : "Regional"; 
         }
         else
         {
             $SC_Label = "regional_nome"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->regional_nome) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->regional_nome) . "\"";
         }
   }
   //----- p_grupo
   function NM_export_p_grupo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_grupo))
         {
             $this->p_grupo = sc_convert_encoding($this->p_grupo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_grupo'])) ? $this->New_label['p_grupo'] : "Grupo"; 
         }
         else
         {
             $SC_Label = "p_grupo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_grupo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_grupo) . "\"";
         }
   }
   //----- p_departamento
   function NM_export_p_departamento()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_departamento))
         {
             $this->p_departamento = sc_convert_encoding($this->p_departamento, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_departamento'])) ? $this->New_label['p_departamento'] : "Depto."; 
         }
         else
         {
             $SC_Label = "p_departamento"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_departamento) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_departamento) . "\"";
         }
   }
   //----- p_cargo
   function NM_export_p_cargo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_cargo))
         {
             $this->p_cargo = sc_convert_encoding($this->p_cargo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_cargo'])) ? $this->New_label['p_cargo'] : "Cargo"; 
         }
         else
         {
             $SC_Label = "p_cargo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_cargo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_cargo) . "\"";
         }
   }
   //----- p_tam_camisa
   function NM_export_p_tam_camisa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_tam_camisa))
         {
             $this->p_tam_camisa = sc_convert_encoding($this->p_tam_camisa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_tam_camisa'])) ? $this->New_label['p_tam_camisa'] : "Camisa"; 
         }
         else
         {
             $SC_Label = "p_tam_camisa"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_tam_camisa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_tam_camisa) . "\"";
         }
   }
   //----- p_idioma
   function NM_export_p_idioma()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_idioma))
         {
             $this->p_idioma = sc_convert_encoding($this->p_idioma, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_idioma'])) ? $this->New_label['p_idioma'] : "Idioma"; 
         }
         else
         {
             $SC_Label = "p_idioma"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_idioma) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_idioma) . "\"";
         }
   }
   //----- p_empresa
   function NM_export_p_empresa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_empresa))
         {
             $this->p_empresa = sc_convert_encoding($this->p_empresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_empresa'])) ? $this->New_label['p_empresa'] : "Empresa"; 
         }
         else
         {
             $SC_Label = "p_empresa"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_empresa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_empresa) . "\"";
         }
   }
   //----- p_uf
   function NM_export_p_uf()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_uf))
         {
             $this->p_uf = sc_convert_encoding($this->p_uf, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_uf'])) ? $this->New_label['p_uf'] : "Uf"; 
         }
         else
         {
             $SC_Label = "p_uf"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_uf) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_uf) . "\"";
         }
   }
   //----- p_pais
   function NM_export_p_pais()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_pais))
         {
             $this->p_pais = sc_convert_encoding($this->p_pais, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_pais'])) ? $this->New_label['p_pais'] : "Pais"; 
         }
         else
         {
             $SC_Label = "p_pais"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_pais) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_pais) . "\"";
         }
   }
   //----- p_email
   function NM_export_p_email()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_email))
         {
             $this->p_email = sc_convert_encoding($this->p_email, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_email'])) ? $this->New_label['p_email'] : "Email"; 
         }
         else
         {
             $SC_Label = "p_email"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_email) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_email) . "\"";
         }
   }
   //----- p_email_secretaria
   function NM_export_p_email_secretaria()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_email_secretaria))
         {
             $this->p_email_secretaria = sc_convert_encoding($this->p_email_secretaria, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_email_secretaria'])) ? $this->New_label['p_email_secretaria'] : "Email Secretaria"; 
         }
         else
         {
             $SC_Label = "p_email_secretaria"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_email_secretaria) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_email_secretaria) . "\"";
         }
   }
   //----- p_ddd_01
   function NM_export_p_ddd_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_ddd_01))
         {
             $this->p_ddd_01 = sc_convert_encoding($this->p_ddd_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_ddd_01'])) ? $this->New_label['p_ddd_01'] : "DDD"; 
         }
         else
         {
             $SC_Label = "p_ddd_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_ddd_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_ddd_01) . "\"";
         }
   }
   //----- p_fone_01
   function NM_export_p_fone_01()
   {
             if ($this->p_fone_01 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->p_fone_01, "####-####"); 
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_fone_01))
         {
             $this->p_fone_01 = sc_convert_encoding($this->p_fone_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_fone_01'])) ? $this->New_label['p_fone_01'] : "Fone 01"; 
         }
         else
         {
             $SC_Label = "p_fone_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_fone_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_fone_01) . "\"";
         }
   }
   //----- p_ddd_celular_01
   function NM_export_p_ddd_celular_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_ddd_celular_01))
         {
             $this->p_ddd_celular_01 = sc_convert_encoding($this->p_ddd_celular_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_ddd_celular_01'])) ? $this->New_label['p_ddd_celular_01'] : "DDD Cel."; 
         }
         else
         {
             $SC_Label = "p_ddd_celular_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_ddd_celular_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_ddd_celular_01) . "\"";
         }
   }
   //----- p_celular_01
   function NM_export_p_celular_01()
   {
             if ($this->p_celular_01 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->p_celular_01, "#####-####"); 
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->p_celular_01))
         {
             $this->p_celular_01 = sc_convert_encoding($this->p_celular_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_celular_01'])) ? $this->New_label['p_celular_01'] : "Celular 01"; 
         }
         else
         {
             $SC_Label = "p_celular_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->p_celular_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->p_celular_01) . "\"";
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
   //----- contato_usuario_nome
   function NM_export_contato_usuario_nome()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_usuario_nome))
         {
             $this->contato_usuario_nome = sc_convert_encoding($this->contato_usuario_nome, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_usuario_nome'])) ? $this->New_label['contato_usuario_nome'] : "Contato Atendente"; 
         }
         else
         {
             $SC_Label = "contato_usuario_nome"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_usuario_nome) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_usuario_nome) . "\"";
         }
   }
   //----- contato_data
   function NM_export_contato_data()
   {
             if (substr($this->contato_data, 10, 1) == "-") 
             { 
                 $this->contato_data = substr($this->contato_data, 0, 10) . " " . substr($this->contato_data, 11);
             } 
             if (substr($this->contato_data, 13, 1) == ".") 
             { 
                $this->contato_data = substr($this->contato_data, 0, 13) . ":" . substr($this->contato_data, 14, 2) . ":" . substr($this->contato_data, 17);
             } 
             $conteudo_x =  $this->contato_data;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->contato_data, "YYYY-MM-DD HH:II:SS  ");
                 $this->contato_data = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_data))
         {
             $this->contato_data = sc_convert_encoding($this->contato_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_data'])) ? $this->New_label['contato_data'] : "Data do Contato"; 
         }
         else
         {
             $SC_Label = "contato_data"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_data) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_data) . "\"";
         }
   }
   //----- contato_status_dsc
   function NM_export_contato_status_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_status_dsc))
         {
             $this->contato_status_dsc = sc_convert_encoding($this->contato_status_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_status_dsc'])) ? $this->New_label['contato_status_dsc'] : "Contato Status"; 
         }
         else
         {
             $SC_Label = "contato_status_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_status_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_status_dsc) . "\"";
         }
   }
   //----- contato_motivo
   function NM_export_contato_motivo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_motivo))
         {
             $this->contato_motivo = sc_convert_encoding($this->contato_motivo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_motivo'])) ? $this->New_label['contato_motivo'] : "Motivo"; 
         }
         else
         {
             $SC_Label = "contato_motivo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_motivo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_motivo) . "\"";
         }
   }
   //----- contato_obs
   function NM_export_contato_obs()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_obs))
         {
             $this->contato_obs = sc_convert_encoding($this->contato_obs, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_obs'])) ? $this->New_label['contato_obs'] : "Contato Obs."; 
         }
         else
         {
             $SC_Label = "contato_obs"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_obs) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_obs) . "\"";
         }
   }
   //----- presenca_status_dsc
   function NM_export_presenca_status_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_status_dsc))
         {
             $this->presenca_status_dsc = sc_convert_encoding($this->presenca_status_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_status_dsc'])) ? $this->New_label['presenca_status_dsc'] : "Presença Status "; 
         }
         else
         {
             $SC_Label = "presenca_status_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_status_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_status_dsc) . "\"";
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
             $SC_Label = (isset($this->New_label['presenca_motivo'])) ? $this->New_label['presenca_motivo'] : "Presença Motivo"; 
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
   //----- presenca_data
   function NM_export_presenca_data()
   {
             if (substr($this->presenca_data, 10, 1) == "-") 
             { 
                 $this->presenca_data = substr($this->presenca_data, 0, 10) . " " . substr($this->presenca_data, 11);
             } 
             if (substr($this->presenca_data, 13, 1) == ".") 
             { 
                $this->presenca_data = substr($this->presenca_data, 0, 13) . ":" . substr($this->presenca_data, 14, 2) . ":" . substr($this->presenca_data, 17);
             } 
             $conteudo_x =  $this->presenca_data;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->presenca_data, "YYYY-MM-DD HH:II:SS  ");
                 $this->presenca_data = $this->nm_data->FormataSaida("d/m/Y H:i:s");
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_data))
         {
             $this->presenca_data = sc_convert_encoding($this->presenca_data, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_data'])) ? $this->New_label['presenca_data'] : "Confirmação da Presença"; 
         }
         else
         {
             $SC_Label = "presenca_data"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_data) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_data) . "\"";
         }
   }
   //----- presenca_usuario_dsc
   function NM_export_presenca_usuario_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_usuario_dsc))
         {
             $this->presenca_usuario_dsc = sc_convert_encoding($this->presenca_usuario_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_usuario_dsc'])) ? $this->New_label['presenca_usuario_dsc'] : "Presenca Atendente"; 
         }
         else
         {
             $SC_Label = "presenca_usuario_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_usuario_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_usuario_dsc) . "\"";
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
             $SC_Label = (isset($this->New_label['presenca_obs'])) ? $this->New_label['presenca_obs'] : "Presenca Obs"; 
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
   //----- anotacoes
   function NM_export_anotacoes()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->anotacoes))
         {
             $this->anotacoes = sc_convert_encoding($this->anotacoes, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['anotacoes'])) ? $this->New_label['anotacoes'] : "Anotações"; 
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
   //----- id_rsvp_r
   function NM_export_id_rsvp_r()
   {
             nmgp_Form_Num_Val($this->id_rsvp_r, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['id_rsvp_r'])) ? $this->New_label['id_rsvp_r'] : "Id Rsvp R"; 
         }
         else
         {
             $SC_Label = "id_rsvp_r"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->id_rsvp_r) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->id_rsvp_r) . "\"";
         }
   }
   //----- p_regional
   function NM_export_p_regional()
   {
         nmgp_Form_Num_Val($this->look_p_regional, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->look_p_regional))
         {
             $this->look_p_regional = sc_convert_encoding($this->look_p_regional, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_regional'])) ? $this->New_label['p_regional'] : "Regional"; 
         }
         else
         {
             $SC_Label = "p_regional"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->look_p_regional) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->look_p_regional) . "\"";
         }
   }
   //----- p_publico
   function NM_export_p_publico()
   {
         nmgp_Form_Num_Val($this->look_p_publico, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->look_p_publico))
         {
             $this->look_p_publico = sc_convert_encoding($this->look_p_publico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['p_publico'])) ? $this->New_label['p_publico'] : "Público"; 
         }
         else
         {
             $SC_Label = "p_publico"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->look_p_publico) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->look_p_publico) . "\"";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Relatório RSVP :: XML</TITLE>
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
<form name="Fdown" method="get" action="grid_rsvp_part_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_rsvp_part_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_part_r']['xml_return']); ?>"> 
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

function BuscaAcomp($evento,$usuario,$ptipo) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		
		$valor_y = 'Y';
		$sqlj="
			SELECT
				participantes_rsvp.part_cpf AS p_cpf,
				participantes_rsvp.part_id_evento AS p_evento,
				acompanhantes_rsvp.part_id_evento AS ac_evento,
				acompanhantes_rsvp.part_cpf_mestre AS ac_cpf_mestre ,
				acompanhantes_rsvp.part_cpf AS ac_cpf,
				pessoas_rsvp.pessoa_cpf AS pe_cpf,
				pessoas_rsvp.pessoa_nome AS pe_nome
			FROM
				participantes_rsvp
			LEFT JOIN 
				acompanhantes_rsvp
			ON 
				acompanhantes_rsvp.part_cpf_mestre = participantes_rsvp.part_cpf  
			LEFT JOIN 
				pessoas_rsvp
			ON 
				pessoas_rsvp.pessoa_cpf = acompanhantes_rsvp.part_cpf		
			WHERE
				participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
			AND	
				participantes_rsvp.part_id_evento = ".$this->Db->qstr($evento)."
			AND 
				acompanhantes_rsvp.part_id_evento = ".$this->Db->qstr($evento)."			
			AND 
				acompanhantes_rsvp.part_cpf_mestre IS NOT NULL	
			ORDER BY
				participantes_rsvp.part_cpf			
		";	
		 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsj = false;
          $this->rsj_erro = $this->Db->ErrorMsg();
      } 
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_part = sizeof($this->rsj );
		$v_nome_acompanhante = '';
		$_contador = 1;
		$_atucpf = '';
		if ($reg_part > 0) {
			for ($i=0;$i<$reg_part;++$i) {
				$_antcpf = $this->rsj[$i][0];
				if($_antcpf <> $_atucpf) {
					$v_nome_acompanhante = '';	
					$_contador = 1;
				}	
				$v_cpf_participante = $this->rsj[$i][0];
				
				if ($_contador == 1) {
					$v_nome_acompanhante = $this->rsj[$i][6];
					switch($ptipo) {
						case 'RSVP':		
							$sqlu="
							UPDATE
								rsvp_part_r
							SET	
								acompanhantes_nomes = ".$this->Db->qstr($v_nome_acompanhante)."
							WHERE	
							rsvp_part_r.p_cpf = ".$this->Db->qstr($v_cpf_participante)."
							";
							break;	
						case 'INAER':
							break;
					}	
				} else {
					$v_nome_acompanhante = $v_nome_acompanhante.';'.$this->rsj[$i][6];
					switch($ptipo) {
						case 'RSVP':		
							$sqlu="
							UPDATE
								rsvp_part_r
							SET	
								acompanhantes_nomes = ".$this->Db->qstr($v_nome_acompanhante)."
							WHERE	
								rsvp_part_r.p_cpf = ".$this->Db->qstr($v_cpf_participante)."
							";
							break;	
						case 'INAER':
							break;		
					}
				}
				
     $nm_select = $sqlu; 
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

				$_atucpf = $this->rsj[$i][0];
				$_contador = $_contador + 1;
			}			
		}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function PrepRelRsvp($evento,$usuario,$nivel) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  		
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
		$ret = 'ADICIONA ERRO2';
		$valor_y = 'Y';
		$nome_empresa = '';
	
		if($nivel == 'CONVIDADO') {
			$sqlconv = "
				SELECT
					evento_id,
					usuario_id,
					nome_empresa
				FROM
					eventos_usuarios_rsvp			
				WHERE	
					evento_id = ".$this->Db->qstr($evento)."
				AND 
					usuario_id = ".$this->Db->qstr($usuario)."	
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
	
		
		$sqld="
		DELETE FROM 
			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
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

		
		$sql="
		SELECT
    		p_evento,
  			id_usuario_relato
		FROM
   			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
		ORDER BY 
			p_evento,
  			id_usuario_relato
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
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_subs = sizeof($this->rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {
			if($nome_empresa == '') {
				$sqlj="				
				SELECT
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional, 
					participantes_rsvp.part_grupo AS p_grupo,
					participantes_rsvp.part_departamento AS p_departamento,	
					participantes_rsvp.part_cargo AS p_cargo,
					participantes_rsvp.part_tam_camisa AS p_tam_camisa,
					participantes_rsvp.part_idioma AS p_idioma,
					participantes_rsvp.part_empresa AS p_empresa,
					participantes_rsvp.part_uf AS p_uf,
					participantes_rsvp.part_pais AS p_pais,
					participantes_rsvp.part_email AS p_email,
					participantes_rsvp.part_email_secretaria AS p_email_secretaria,
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
					participantes_rsvp.part_celeular_01 AS p_celular_01,
					participantes_rsvp.part_ddd_01 AS p_ddd_01,         
					participantes_rsvp.part_fone_01 AS p_fone_01,       
					participantes_rsvp.nome_pessoa AS p_nome,           
					participantes_rsvp.part_cpf AS p_cpf,               
					participantes_rsvp.part_id_evento,                  
					publico_rsvp.publico_nome,
					tbl_regionais.regional_dsc,
					participantes_rsvp.part_dt_nasc,
					participantes_rsvp.part_rg,
					participantes_rsvp.part_cpf_informado,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional					
				FROM
					participantes_rsvp
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional			 
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento	
				WHERE
					participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
				AND	
					participantes_rsvp.part_id_evento = '".$this->sc_temp_vg_evento_id."'
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				GROUP by
					participantes_rsvp.part_cpf		
				ORDER BY				 
					participantes_rsvp.nome_pessoa
				";
							
			} else {
				$sqlj="				
				SELECT
					participantes_rsvp.part_id_evento_publico AS p_publico,
					participantes_rsvp.part_id_evento_regional AS p_regional, 
					participantes_rsvp.part_grupo AS p_grupo,
					participantes_rsvp.part_departamento AS p_departamento,	
					participantes_rsvp.part_cargo AS p_cargo,
					participantes_rsvp.part_tam_camisa AS p_tam_camisa,
					participantes_rsvp.part_idioma AS p_idioma,
					participantes_rsvp.part_empresa AS p_empresa,
					participantes_rsvp.part_uf AS p_uf,
					participantes_rsvp.part_pais AS p_pais,
					participantes_rsvp.part_email AS p_email,
					participantes_rsvp.part_email_secretaria AS p_email_secretaria,
					participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
					participantes_rsvp.part_celeular_01 AS p_celular_01,
					participantes_rsvp.part_ddd_01 AS p_ddd_01,         
					participantes_rsvp.part_fone_01 AS p_fone_01,       
					participantes_rsvp.nome_pessoa AS p_nome,           
					participantes_rsvp.part_cpf AS p_cpf,               
					participantes_rsvp.part_id_evento,                  
					publico_rsvp.publico_nome,
					tbl_regionais.regional_dsc,
					participantes_rsvp.part_dt_nasc,
					participantes_rsvp.part_rg,
					participantes_rsvp.part_cpf_informado,
					anotacoes_rsvp.ant_dsc,
					participantes_rsvp.part_fone_internacional,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					participantes_rsvp
				LEFT JOIN
					publico_rsvp
				ON 
					publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
				LEFT JOIN
					tbl_regionais
				ON
					tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional			 
				LEFT JOIN 
					anotacoes_rsvp 
				ON 
					anotacoes_rsvp.ant_cpf_participante = participantes_rsvp.part_cpf AND anotacoes_rsvp.ant_evento_id = participantes_rsvp.part_id_evento	
				WHERE
					participantes_rsvp.part_ativo	= ".$this->Db->qstr($valor_y)."
				AND	
					participantes_rsvp.part_id_evento = '".$this->sc_temp_vg_evento_id."'
				AND
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."	
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				GROUP by
					participantes_rsvp.part_cpf		
				ORDER BY				 
					participantes_rsvp.nome_pessoa
				";
			}
			 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsj = false;
          $this->rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($this->rsj );
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {	
					$vppublico 					= $this->rsj[$i][0];   
					$vpregional					= $this->rsj[$i][1];   
					$vpgrupo 					= $this->rsj[$i][2];	  
					$vpdepartamento 			= $this->rsj[$i][3];	    
					$vpcargo 					= $this->rsj[$i][4];   
					$vptam_camisa           	= $this->rsj[$i][5];   
					$vpidioma               	= $this->rsj[$i][6];   
					$vpempresa              	= $this->rsj[$i][7];   
					$vpuf                   	= $this->rsj[$i][8];   
					$vppais                 	= $this->rsj[$i][9];   
					$vpemail                	= $this->rsj[$i][10];  
					$vpemail_secretaria     	= $this->rsj[$i][11];  
					$vpddd_celular_01       	= $this->rsj[$i][12];    
					$vpcelular_01           	= $this->rsj[$i][13];  
					$vpddd_01               	= $this->rsj[$i][14];  
					$vpfone_01              	= $this->rsj[$i][15];  
					$vpnome                 	= $this->rsj[$i][16];  
					$vpcpf                  	= $this->rsj[$i][17];  
					$vpevento               	= $this->rsj[$i][18];  
					$vpublico_nome				= $this->rsj[$i][19];
					$vregional_nome				= $this->rsj[$i][20];  
					
					$vdtnasc					= $this->rsj[$i][21];  
					$vrg						= $this->rsj[$i][22]; 
					$vpartcpf					= $this->rsj[$i][23]; 
					$vanotacoes					= $this->rsj[$i][24]; 
					$vfoneinter					= $this->rsj[$i][25]; 	
										
					$vcontato_cpf            	= '';  
					$vcontato_status         	= '';  
					$vcontato_data           	= ''; 
					$vcontato_motivo         	= '';
					$vcontato_obs            	= '';
					$vcontato_usuario_id        = '';
					$vcontato_status_dsc        = ''; 

					$vpresenca_tipo_part        = '';
					$vpresenca_status        	= '';
					$vpresenca_obs           	= '';
					$vpresenca_motivo        	= '';  
					$vpresenca_data				= '';  
					$vpresenca_usuario_id       = '';  
					$vcontato_usuario_nome		= '';  
					$vpresenca_usuario_nome		= '';  			
					$vpresenca_cpf				= '';
					$vpresenca_status_dsc		= ''; 
					
					$vusuario_relato_nome		= ''; 
					$vusuario_relato_dsc		= ''; 
					$vacompanhantes_nomes		= ''; 

					$vhospedagem_cpf           	= '';
					$vhospedagem_evento        	= '';
					$vhospedagem_id_hotel      	= '';
					$vhospedagem_dtchkin       	= '';
					$vhospedagem_hrchkin       	= '';
					$vhospedagem_dtchkout      	= '';
					$vhospedagem_hrchkout      	= '';
					$vhospedagem_acompanhante  	= '';
					$vhospedagem_tipo_pessoa   	= '';
					$vhotel_fantasia           	= '';
					$vid_usuario_relato_id		= $this->sc_temp_vg_usuario_id;
					
					if($vpartcpf == '') {
						$vpartcpf = $vpcpf;
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
						contatos_rsvp.contato_cpf_participante = '".$vpcpf."'                                                                                 
					AND
						contatos_rsvp.contato_id_evento = '".$vpevento."'
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
					} else {
						$vcontato_status_dsc = 'ABERTO'; 	
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
						presencas_rsvp.presenca_cpf_participante = ".$this->Db->qstr($vpcpf)."                                                                                 
					AND
						presencas_rsvp.presenca_id_evento = ".$this->Db->qstr($vpevento)."
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
					$sqlins = "
						SELECT 
							COUNT(p_cpf) as qtde
						FROM 
							rsvp_part_r
						WHERE 
							p_cpf = ".$this->Db->qstr($vpcpf)." 
						AND 
							p_evento = ".$this->Db->qstr($vpevento)."		
						AND 
    						id_usuario_relato = ".$this->Db->qstr($usuario)."	
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
						$sqli="					
						INSERT INTO   
							rsvp_part_r  
							(p_publico, 						
							p_regional,				    
							p_grupo, 				    
							p_departamento, 		    
							p_cargo, 				    
							p_tam_camisa,               
							p_idioma,                   
							p_empresa,                  
							p_uf,                       
							p_pais,                     
							p_email,                    
							p_email_secretaria,         
							p_ddd_celular_01,           
							p_celular_01,               
							p_ddd_01,                   
							p_fone_01,                  
							p_nome,                     
							p_cpf,                      
							p_evento,                   
							contato_cpf,                
							contato_status,             
							contato_data,               
							contato_motivo,             
							contato_obs,                
							presenca_tipo_part,         
							presenca_status,            
							presenca_obs,               
							presenca_motivo,            
							hospedagem_cpf,             
							hospedagem_evento,          
							hospedagem_id_hotel,        
							hospedagem_dtchkin,         
							hospedagem_hrchkin,         
							hospedagem_dtchkout,        
							hospedagem_hrchkout,        
							hospedagem_acompanhante,    
							hospedagem_tipo_pessoa,     
							hotel_fantasia,             
							publico_nome,               
							regional_nome,              
							id_usuario_relato, 		    
							contato_status_dsc,         
							presenca_status_dsc,        
							contato_usuario_id,         
							contato_usuario_nome,       
							presenca_data,
							presenca_usuario_id,
							presenca_usuario_dsc,
							data_nascimento,
							rg,
							cpf_informado,
							anotacoes,
							telefone_internacional)	             
						VALUES
							(".$this->Db->qstr($vppublico).",	
							".$this->Db->qstr($vpregional).",	
							".$this->Db->qstr($vpgrupo).",	
							".$this->Db->qstr($vpdepartamento).",
							".$this->Db->qstr($vpcargo).",
							".$this->Db->qstr($vptam_camisa).",
							".$this->Db->qstr($vpidioma).",
							".$this->Db->qstr($vpempresa).",
							".$this->Db->qstr($vpuf).",
							".$this->Db->qstr($vppais).",
							".$this->Db->qstr($vpemail).",
							".$this->Db->qstr($vpemail_secretaria).",
							".$this->Db->qstr($vpddd_celular_01).",
							".$this->Db->qstr($vpcelular_01).",
							".$this->Db->qstr($vpddd_01).",
							".$this->Db->qstr($vpfone_01).",
							".$this->Db->qstr($vpnome).",
							".$this->Db->qstr($vpcpf).",
							".$this->Db->qstr($vpevento).",
							".$this->Db->qstr($vcontato_cpf).",
							".$this->Db->qstr($vcontato_status).",
							".$this->Db->qstr($vcontato_data).",
							".$this->Db->qstr($vcontato_motivo).",
							".$this->Db->qstr($vcontato_obs).",
							".$this->Db->qstr($vpresenca_tipo_part).",
							".$this->Db->qstr($vpresenca_status).",
							".$this->Db->qstr($vpresenca_obs).",
							".$this->Db->qstr($vpresenca_motivo).",
							".$this->Db->qstr($vhospedagem_cpf).",
							".$this->Db->qstr($vhospedagem_evento).",
							".$this->Db->qstr($vhospedagem_id_hotel).",
							".$this->Db->qstr($vhospedagem_dtchkin).",
							".$this->Db->qstr($vhospedagem_hrchkin).",
							".$this->Db->qstr($vhospedagem_dtchkout).",
							".$this->Db->qstr($vhospedagem_hrchkout).",
							".$this->Db->qstr($vhospedagem_acompanhante).",
							".$this->Db->qstr($vhospedagem_tipo_pessoa).",
							".$this->Db->qstr($vhotel_fantasia).",
							".$this->Db->qstr($vpublico_nome).",
							".$this->Db->qstr($vregional_nome).",
							".$this->Db->qstr($vid_usuario_relato_id).",
							".$this->Db->qstr($vcontato_status_dsc).",
							".$this->Db->qstr($vpresenca_status_dsc).",
							".$this->Db->qstr($vcontato_usuario_id).",
							".$this->Db->qstr($vcontato_usuario_nome).",															
							".$this->Db->qstr($vpresenca_data).",
							".$this->Db->qstr($vpresenca_usuario_id).",
							".$this->Db->qstr($vpresenca_usuario_nome).",
							".$this->Db->qstr($vdtnasc).",
							".$this->Db->qstr($vrg).",
							".$this->Db->qstr($vpartcpf).",							
							".$this->Db->qstr($vanotacoes).",
							".$this->Db->qstr($vfoneinter).")
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
				$ret = 'ADICIONA OK2';		
			} else {
				$ret = 'ADICIONA ERRO2';
			}			
		}
		return $ret;
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function PrepRelRsvp2($evento,$usuario) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
		$ret = 'ADICIONA ERRO2';
		$valor_y = 'Y';
		
		
		$sqld="
		DELETE FROM 
			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
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

		
		
		$sql="
		SELECT
    		p_evento,
  			id_usuario_relato
		FROM
   			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
		ORDER BY 
			p_evento,
  			id_usuario_relato
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
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_subs = sizeof($this->rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {	
			$sqlj="	
			SELECT
				participantes_rsvp.part_id_evento_publico AS p_publico,
				participantes_rsvp.part_id_evento_regional AS p_regional, 
				participantes_rsvp.part_grupo AS p_grupo,
				participantes_rsvp.part_departamento AS p_departamento,	
				participantes_rsvp.part_cargo AS p_cargo,
				participantes_rsvp.part_tam_camisa AS p_tam_camisa,
				participantes_rsvp.part_idioma AS p_idioma,
				participantes_rsvp.part_empresa AS p_empresa,
				participantes_rsvp.part_uf AS p_uf,
				participantes_rsvp.part_pais AS p_pais,
				participantes_rsvp.part_email AS p_email,
				participantes_rsvp.part_email_secretaria AS p_email_secretaria,
				participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
				participantes_rsvp.part_celeular_01 AS p_celular_01,
				participantes_rsvp.part_ddd_01 AS p_ddd_01,         
				participantes_rsvp.part_fone_01 AS p_fone_01,       
				participantes_rsvp.nome_pessoa AS p_nome,           
				participantes_rsvp.part_cpf AS p_cpf,               
				participantes_rsvp.part_id_evento,                  
				contatos_rsvp.contato_cpf_participante AS contato_cpf,
				contatos_rsvp.contato_status AS contato_status,       
				contatos_rsvp.contato_data_hora AS contato_data,      
				contatos_rsvp.contato_motivo_frase AS contato_motivo, 
				contatos_rsvp.contato_obs AS contato_obs,             
				contatos_rsvp.contato_usuario_id,
				presencas_rsvp.presenca_tipo_part AS presenca_tipo_part,
				presencas_rsvp.presenca_status AS presenca_status,	
				presencas_rsvp.presenca_obs AS presenca_obs,
				presencas_rsvp.presenca__frase_resposta AS presenca_motivo,
				presencas_rsvp.presenca_data_hora, 
				presencas_rsvp.presenca_usuario_id,
				usuarios_rsvp.usuario_nome AS usuario_contato,
				usuarios_rsvp.usuario_nome AS usuario_presenca,
				publico_rsvp.publico_nome,
				tbl_regionais.regional_dsc
			FROM
				participantes_rsvp
			LEFT JOIN 
				contatos_rsvp 
			ON 
				participantes_rsvp.part_cpf  = contatos_rsvp.contato_cpf_participante
			LEFT JOIN 
				presencas_rsvp
			ON 
				participantes_rsvp.part_cpf = presencas_rsvp.presenca_cpf_participante
			LEFT JOIN
				publico_rsvp
			ON 
				publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
			LEFT JOIN
				tbl_regionais
			ON
				tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional
			LEFT JOIN
				usuarios_rsvp
			ON
				usuarios_rsvp.usuario_id = contatos_rsvp.contato_usuario_id	
			AND 	
				usuarios_rsvp.usuario_id = presencas_rsvp.presenca_usuario_id		
			WHERE
				participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
			AND	
				participantes_rsvp.part_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
			AND
				participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 
			GROUP by
				participantes_rsvp.part_cpf		
			ORDER BY				 
				participantes_rsvp.nome_pessoa,
				contatos_rsvp.contato_data_hora DESC,
				presencas_rsvp.presenca_data_hora DESC 		
			";		
			 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsj = false;
          $this->rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($this->rsj );
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {	
					$vppublico 					= $this->rsj[$i][0];   
					$vpregional					= $this->rsj[$i][1];   
					$vpgrupo 					= $this->rsj[$i][2];	  
					$vpdepartamento 			= $this->rsj[$i][3];	  
					$vpcargo 					= $this->rsj[$i][4];   
					$vptam_camisa           	= $this->rsj[$i][5];   
					$vpidioma               	= $this->rsj[$i][6];   
					$vpempresa              	= $this->rsj[$i][7];   
					$vpuf                   	= $this->rsj[$i][8];   
					$vppais                 	= $this->rsj[$i][9];   
					$vpemail                	= $this->rsj[$i][10];  
					$vpemail_secretaria     	= $this->rsj[$i][11];  
					$vpddd_celular_01       	= $this->rsj[$i][12];  
					$vpcelular_01           	= $this->rsj[$i][13];  
					$vpddd_01               	= $this->rsj[$i][14];  
					$vpfone_01              	= $this->rsj[$i][15];  
					$vpnome                 	= $this->rsj[$i][16];  
					$vpcpf                  	= $this->rsj[$i][17];  
					$vpevento               	= $this->rsj[$i][18];  
					$vcontato_cpf            	= $this->rsj[$i][19];  
					$vcontato_status         	= $this->rsj[$i][20];  
					$vcontato_data           	= $this->rsj[$i][21]; 
					$vcontato_motivo         	= $this->rsj[$i][22];
					$vcontato_obs            	= $this->rsj[$i][23];
					$vcontato_usuario_id        = $this->rsj[$i][24];
					$vpresenca_tipo_part        = $this->rsj[$i][25];
					$vpresenca_status        	= $this->rsj[$i][26];
					$vpresenca_obs           	= $this->rsj[$i][27];
					$vpresenca_motivo        	= $this->rsj[$i][28];  
					$vpresenca_data				= $this->rsj[$i][29];  
					$vpresenca_usuario_id       = $this->rsj[$i][30];  
					$vcontato_usuario_nome		= $this->rsj[$i][31];  
					$vpresenca_usuario_nome		= $this->rsj[$i][32];  
					$vpublico_nome				= $this->rsj[$i][33];  
					$vregional_nome				= $this->rsj[$i][34];  

					$vcontato_status_dsc        = ''; 
					$vpresenca_status_dsc		= ''; 
					$vusuario_relato_nome		= ''; 
					$vusuario_relato_dsc		= ''; 
					$vacompanhantes_nomes		= ''; 

					$vhospedagem_cpf           	= '';
					$vhospedagem_evento        	= '';
					$vhospedagem_id_hotel      	= '';
					$vhospedagem_dtchkin       	= '';
					$vhospedagem_hrchkin       	= '';
					$vhospedagem_dtchkout      	= '';
					$vhospedagem_hrchkout      	= '';
					$vhospedagem_acompanhante  	= '';
					$vhospedagem_tipo_pessoa   	= '';
					$vhotel_fantasia           	= '';
					$vid_usuario_relato_id		= $this->sc_temp_vg_usuario_id;
							
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
					if ($vcontato_cpf == '') {
						$vcontato_status_dsc = 'ABERTO'; 	
					}
					
					$sqli="					
					INSERT INTO   
						rsvp_part_r  
						(p_publico, 						
						p_regional,				    
						p_grupo, 				    
						p_departamento, 		    
						p_cargo, 				    
						p_tam_camisa,               
						p_idioma,                   
						p_empresa,                  
						p_uf,                       
						p_pais,                     
						p_email,                    
						p_email_secretaria,         
						p_ddd_celular_01,           
						p_celular_01,               
						p_ddd_01,                   
						p_fone_01,                  
						p_nome,                     
						p_cpf,                      
						p_evento,                   
						contato_cpf,                
						contato_status,             
						contato_data,               
						contato_motivo,             
						contato_obs,                
						presenca_tipo_part,         
						presenca_status,            
						presenca_obs,               
						presenca_motivo,            
						hospedagem_cpf,             
						hospedagem_evento,          
						hospedagem_id_hotel,        
						hospedagem_dtchkin,         
						hospedagem_hrchkin,         
						hospedagem_dtchkout,        
						hospedagem_hrchkout,        
						hospedagem_acompanhante,    
						hospedagem_tipo_pessoa,     
						hotel_fantasia,             
						publico_nome,               
						regional_nome,              
						id_usuario_relato, 		    
						contato_status_dsc,         
						presenca_status_dsc,        
						contato_usuario_id,         
						contato_usuario_nome,       
						presenca_data,
						presenca_usuario_id,
						presenca_usuario_dsc)	             
					VALUES
						(".$this->Db->qstr($vppublico).",	
						".$this->Db->qstr($vpregional).",	
						".$this->Db->qstr($vpgrupo).",	
						".$this->Db->qstr($vpdepartamento).",
						".$this->Db->qstr($vpcargo).",
						".$this->Db->qstr($vptam_camisa).",
						".$this->Db->qstr($vpidioma).",
						".$this->Db->qstr($vpempresa).",
						".$this->Db->qstr($vpuf).",
						".$this->Db->qstr($vppais).",
						".$this->Db->qstr($vpemail).",
						".$this->Db->qstr($vpemail_secretaria).",
						".$this->Db->qstr($vpddd_celular_01).",
						".$this->Db->qstr($vpcelular_01).",
						".$this->Db->qstr($vpddd_01).",
						".$this->Db->qstr($vpfone_01).",
						".$this->Db->qstr($vpnome).",
						".$this->Db->qstr($vpcpf).",
						".$this->Db->qstr($vpevento).",
						".$this->Db->qstr($vcontato_cpf).",
						".$this->Db->qstr($vcontato_status).",
						".$this->Db->qstr($vcontato_data).",
						".$this->Db->qstr($vcontato_motivo).",
						".$this->Db->qstr($vcontato_obs).",
						".$this->Db->qstr($vpresenca_tipo_part).",
						".$this->Db->qstr($vpresenca_status).",
						".$this->Db->qstr($vpresenca_obs).",
						".$this->Db->qstr($vpresenca_motivo).",
						".$this->Db->qstr($vhospedagem_cpf).",
						".$this->Db->qstr($vhospedagem_evento).",
						".$this->Db->qstr($vhospedagem_id_hotel).",
						".$this->Db->qstr($vhospedagem_dtchkin).",
						".$this->Db->qstr($vhospedagem_hrchkin).",
						".$this->Db->qstr($vhospedagem_dtchkout).",
						".$this->Db->qstr($vhospedagem_hrchkout).",
						".$this->Db->qstr($vhospedagem_acompanhante).",
						".$this->Db->qstr($vhospedagem_tipo_pessoa).",
						".$this->Db->qstr($vhotel_fantasia).",
						".$this->Db->qstr($vpublico_nome).",
						".$this->Db->qstr($vregional_nome).",
						".$this->Db->qstr($vid_usuario_relato_id).",
						".$this->Db->qstr($vcontato_status_dsc).",
						".$this->Db->qstr($vpresenca_status_dsc).",
						".$this->Db->qstr($vcontato_usuario_id).",
						".$this->Db->qstr($vcontato_usuario_nome).",
						".$this->Db->qstr($vpresenca_data).",
						".$this->Db->qstr($vpresenca_usuario_id).",
						".$this->Db->qstr($vpresenca_usuario_nome).")
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

				}
				$ret = 'ADICIONA OK2';		
			} else {
				$ret = 'ADICIONA ERRO2';
			}			
		}
		return $ret;
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_rsvp_part_r']['contr_erro'] = 'off';
}

}

?>
