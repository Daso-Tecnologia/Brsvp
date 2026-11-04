<?php

class grid_acompanhantes_bnt_xml
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida'])
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['opcao'] = "";
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
                   nm_limpa_str_grid_acompanhantes_bnt($cadapar[1]);
                   nm_protect_num_grid_acompanhantes_bnt($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_acompanhantes_bnt']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["vg_evento_id"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["rsvp_global"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["vg_usuario_id"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["vg_cpfseg"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["parm1"]);
      }
      if (isset($vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $vg_cpf;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["vg_cpf"]);
      }
      if (isset($vg_cpf_mestre)) 
      {
          $_SESSION['vg_cpf_mestre'] = $vg_cpf_mestre;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["vg_cpf_mestre"]);
      }
      if (isset($vg_tipo_pessoa)) 
      {
          $_SESSION['vg_tipo_pessoa'] = $vg_tipo_pessoa;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["vg_tipo_pessoa"]);
      }
      if (isset($vg_cabecalho)) 
      {
          $_SESSION['vg_cabecalho'] = $vg_cabecalho;
          nm_limpa_str_grid_acompanhantes_bnt($_SESSION["vg_cabecalho"]);
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['SC_Gb_Free_cmp']))
      {
          $this->Tem_xml_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_acompanhantes_bnt/grid_acompanhantes_bnt_res_xml.class.php"))
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_label']))
      {
          $this->Xml_tag_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_label'];
          $this->New_Format    = true;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_acompanhantes_bnt_total.class.php"); 
      $this->Tot      = new grid_acompanhantes_bnt_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['tot_geral'][1];
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_acompanhantes_bnt']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_return']);
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
      $this->Arq_zip      = $this->Arquivo . "_grid_acompanhantes_bnt.zip";
      $this->Arquivo     .= "_grid_acompanhantes_bnt";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "grid_acompanhantes_bnt.xml";
      $this->Tit_zip      = "grid_acompanhantes_bnt.zip";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_acompanhantes_bnt']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_acompanhantes_bnt']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_acompanhantes_bnt']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->part_nome = (isset($Busca_temp['part_nome'])) ? $Busca_temp['part_nome'] : ""; 
          $tmp_pos = (is_string($this->part_nome)) ? strpos($this->part_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_nome))
          {
              $this->part_nome = substr($this->part_nome, 0, $tmp_pos);
          }
          $this->part_ativo = (isset($Busca_temp['part_ativo'])) ? $Busca_temp['part_ativo'] : ""; 
          $tmp_pos = (is_string($this->part_ativo)) ? strpos($this->part_ativo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_ativo))
          {
              $this->part_ativo = substr($this->part_ativo, 0, $tmp_pos);
          }
          $this->part_cpf = (isset($Busca_temp['part_cpf'])) ? $Busca_temp['part_cpf'] : ""; 
          $tmp_pos = (is_string($this->part_cpf)) ? strpos($this->part_cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cpf))
          {
              $this->part_cpf = substr($this->part_cpf, 0, $tmp_pos);
          }
          $this->part_cpf_mestre = (isset($Busca_temp['part_cpf_mestre'])) ? $Busca_temp['part_cpf_mestre'] : ""; 
          $tmp_pos = (is_string($this->part_cpf_mestre)) ? strpos($this->part_cpf_mestre, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cpf_mestre))
          {
              $this->part_cpf_mestre = substr($this->part_cpf_mestre, 0, $tmp_pos);
          }
          $this->part_id_evento_publico = (isset($Busca_temp['part_id_evento_publico'])) ? $Busca_temp['part_id_evento_publico'] : ""; 
          $tmp_pos = (is_string($this->part_id_evento_publico)) ? strpos($this->part_id_evento_publico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_id_evento_publico))
          {
              $this->part_id_evento_publico = substr($this->part_id_evento_publico, 0, $tmp_pos);
          }
          $this->part_id_evento_regional = (isset($Busca_temp['part_id_evento_regional'])) ? $Busca_temp['part_id_evento_regional'] : ""; 
          $tmp_pos = (is_string($this->part_id_evento_regional)) ? strpos($this->part_id_evento_regional, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_id_evento_regional))
          {
              $this->part_id_evento_regional = substr($this->part_id_evento_regional, 0, $tmp_pos);
          }
          $this->part_empresa = (isset($Busca_temp['part_empresa'])) ? $Busca_temp['part_empresa'] : ""; 
          $tmp_pos = (is_string($this->part_empresa)) ? strpos($this->part_empresa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_empresa))
          {
              $this->part_empresa = substr($this->part_empresa, 0, $tmp_pos);
          }
          $this->part_aereo = (isset($Busca_temp['part_aereo'])) ? $Busca_temp['part_aereo'] : ""; 
          $tmp_pos = (is_string($this->part_aereo)) ? strpos($this->part_aereo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_aereo))
          {
              $this->part_aereo = substr($this->part_aereo, 0, $tmp_pos);
          }
          $this->part_hospedagem = (isset($Busca_temp['part_hospedagem'])) ? $Busca_temp['part_hospedagem'] : ""; 
          $tmp_pos = (is_string($this->part_hospedagem)) ? strpos($this->part_hospedagem, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_hospedagem))
          {
              $this->part_hospedagem = substr($this->part_hospedagem, 0, $tmp_pos);
          }
          $this->part_transfer = (isset($Busca_temp['part_transfer'])) ? $Busca_temp['part_transfer'] : ""; 
          $tmp_pos = (is_string($this->part_transfer)) ? strpos($this->part_transfer, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_transfer))
          {
              $this->part_transfer = substr($this->part_transfer, 0, $tmp_pos);
          }
          $this->part_opcionais = (isset($Busca_temp['part_opcionais'])) ? $Busca_temp['part_opcionais'] : ""; 
          $tmp_pos = (is_string($this->part_opcionais)) ? strpos($this->part_opcionais, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_opcionais))
          {
              $this->part_opcionais = substr($this->part_opcionais, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_cabecalho'])) {$_SESSION['vg_cabecalho'] = "";}
if (!isset($this->sc_temp_vg_cabecalho)) {$this->sc_temp_vg_cabecalho = (isset($_SESSION['vg_cabecalho'])) ? $_SESSION['vg_cabecalho'] : "";}
if (!isset($_SESSION['vg_tipo_pessoa'])) {$_SESSION['vg_tipo_pessoa'] = "";}
if (!isset($this->sc_temp_vg_tipo_pessoa)) {$this->sc_temp_vg_tipo_pessoa = (isset($_SESSION['vg_tipo_pessoa'])) ? $_SESSION['vg_tipo_pessoa'] : "";}
if (!isset($_SESSION['vg_cpf_mestre'])) {$_SESSION['vg_cpf_mestre'] = "";}
if (!isset($this->sc_temp_vg_cpf_mestre)) {$this->sc_temp_vg_cpf_mestre = (isset($_SESSION['vg_cpf_mestre'])) ? $_SESSION['vg_cpf_mestre'] : "";}
if (!isset($_SESSION['vg_cpf'])) {$_SESSION['vg_cpf'] = "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
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
 if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
 if (isset($this->sc_temp_vg_cpf_mestre)) {$_SESSION['vg_cpf_mestre'] = $this->sc_temp_vg_cpf_mestre;}
 if (isset($this->sc_temp_vg_tipo_pessoa)) {$_SESSION['vg_tipo_pessoa'] = $this->sc_temp_vg_tipo_pessoa;}
 if (isset($this->sc_temp_vg_cabecalho)) {$_SESSION['vg_cabecalho'] = $this->sc_temp_vg_cabecalho;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_acompanhantes_bnt";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['sc_outra_jan'] = false;
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
        action="grid_acompanhantes_bnt_fim.php"
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

if ( $usunivel <> 'ADMINISTRADOR') {
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
 if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
 if (isset($this->sc_temp_vg_cpf_mestre)) {$_SESSION['vg_cpf_mestre'] = $this->sc_temp_vg_cpf_mestre;}
 if (isset($this->sc_temp_vg_tipo_pessoa)) {$_SESSION['vg_tipo_pessoa'] = $this->sc_temp_vg_tipo_pessoa;}
 if (isset($this->sc_temp_vg_cabecalho)) {$_SESSION['vg_cabecalho'] = $this->sc_temp_vg_cabecalho;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_acompanhantes_bnt";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['sc_outra_jan'] = false;
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
        action="grid_acompanhantes_bnt_fim.php"
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
$this->part_id_evento  = $this->sc_temp_vg_evento_id;
$this->sc_temp_vg_cpf = $this->sc_temp_vg_cpf_mestre;
$this->part_cod_usuario  = $this->sc_temp_vg_usuario_id;
$this->sc_temp_vg_tipo_pessoa = 'A';

$sql="
SELECT 
	pessoa_cpf,pessoa_nome 
FROM 
	pessoas_rsvp 
WHERE 
	pessoa_cpf = ".$this->Db->qstr($this->sc_temp_vg_cpf_mestre)."
ORDER BY 
	pessoa_cpf"
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
	$this->sc_temp_vg_cabecalho = $this->rs[0][1];
}

echo '<h3>&emsp;BRSVP - Acompanhantes</h3>';

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_cpf_mestre)) {$_SESSION['vg_cpf_mestre'] = $this->sc_temp_vg_cpf_mestre;}
if (isset($this->sc_temp_vg_tipo_pessoa)) {$_SESSION['vg_tipo_pessoa'] = $this->sc_temp_vg_tipo_pessoa;}
if (isset($this->sc_temp_vg_cabecalho)) {$_SESSION['vg_cabecalho'] = $this->sc_temp_vg_cabecalho;}
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida'])
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
          $nmgp_select = "SELECT participante_id, part_ddd_celular_01, part_celeular_01, participante_id_mestre, part_ativo, part_sexo, part_cpf, part_cpf_mestre, part_id_evento, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_incompleto, part_aereo_ok, part_anotacoes, part_tipo, part_confirm_viagem from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT participante_id, part_ddd_celular_01, part_celeular_01, participante_id_mestre, part_ativo, part_sexo, part_cpf, part_cpf_mestre, part_id_evento, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_incompleto, part_aereo_ok, part_anotacoes, part_tipo, part_confirm_viagem from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT participante_id, part_ddd_celular_01, part_celeular_01, participante_id_mestre, part_ativo, part_sexo, part_cpf, part_cpf_mestre, part_id_evento, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_incompleto, part_aereo_ok, part_anotacoes, part_tipo, part_confirm_viagem from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT participante_id, part_ddd_celular_01, part_celeular_01, participante_id_mestre, part_ativo, part_sexo, part_cpf, part_cpf_mestre, part_id_evento, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_incompleto, part_aereo_ok, part_anotacoes, part_tipo, part_confirm_viagem from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT participante_id, part_ddd_celular_01, part_celeular_01, participante_id_mestre, part_ativo, part_sexo, part_cpf, part_cpf_mestre, part_id_evento, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_incompleto, part_aereo_ok, part_anotacoes, part_tipo, part_confirm_viagem from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT participante_id, part_ddd_celular_01, part_celeular_01, participante_id_mestre, part_ativo, part_sexo, part_cpf, part_cpf_mestre, part_id_evento, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_incompleto, part_aereo_ok, part_anotacoes, part_tipo, part_confirm_viagem from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['order_grid'];
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
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida'])
         { 
             $this->xml_registro .= "<" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro = "<grid_acompanhantes_bnt>\r\n";
         }
         else
         {
             $this->xml_registro = "<grid_acompanhantes_bnt";
         }
         $this->participante_id = $rs->fields[0] ;  
         $this->participante_id = (string)$this->participante_id;
         $this->part_ddd_celular_01 = $rs->fields[1] ;  
         $this->part_celeular_01 = $rs->fields[2] ;  
         $this->participante_id_mestre = $rs->fields[3] ;  
         $this->participante_id_mestre = (string)$this->participante_id_mestre;
         $this->part_ativo = $rs->fields[4] ;  
         $this->part_sexo = $rs->fields[5] ;  
         $this->part_cpf = $rs->fields[6] ;  
         $this->part_cpf_mestre = $rs->fields[7] ;  
         $this->part_id_evento = $rs->fields[8] ;  
         $this->part_id_evento = (string)$this->part_id_evento;
         $this->part_cod_usuario = $rs->fields[9] ;  
         $this->part_cod_usuario = (string)$this->part_cod_usuario;
         $this->part_hospedagem = $rs->fields[10] ;  
         $this->part_transfer = $rs->fields[11] ;  
         $this->part_opcionais = $rs->fields[12] ;  
         $this->part_incompleto = $rs->fields[13] ;  
         $this->part_aereo_ok = $rs->fields[14] ;  
         $this->part_anotacoes = $rs->fields[15] ;  
         $this->part_tipo = $rs->fields[16] ;  
         $this->part_confirm_viagem = $rs->fields[17] ;  
         $this->sc_proc_grid = true; 
         //----- lookup - nome_acomp
         $this->Lookup->lookup_nome_acomp($this->nome_acomp, $this->part_cpf, $this->array_nome_acomp); 
         $this->nome_acomp = str_replace("<br>", " ", $this->nome_acomp); 
         $this->nome_acomp = ($this->nome_acomp == "&nbsp;") ? "" : $this->nome_acomp; 
         $_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['vg_cpf'])) {$_SESSION['vg_cpf'] = "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$valor_y = 'Y';
$valor_n = 'N';
$this->sc_temp_vg_cpf = $this->part_cpf ;
$evento = $this->sc_temp_vg_evento_id;
$cpf = $this->sc_temp_vg_cpf;

$sql="
SELECT
	contato_data_hora, contato_status, contato_ativo
FROM
	contatos_ac_rsvp
WHERE
	contato_id_evento = ".$this->Db->qstr($evento)." 
AND 
	contato_ativo = ".$this->Db->qstr($valor_y)." 
AND 
	contato_cpf_participante = ".$this->Db->qstr($cpf)."	
ORDER BY 
	contato_data_hora DESC
LIMIT 1"
;	
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->retorno = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->retorno[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->retorno = false;
          $this->retorno_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->retorno[0][0])) {
	$cstatus = $this->retorno[0][1];	
	switch($cstatus) {
		case 'A':
			$this->NM_cmp_hidden["contato_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_gray"] = 'on'; }		
			$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_green"] = 'off'; }		
			$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_red"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["contato_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_green"] = 'off'; }		
			$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_red"] = 'off'; }		
			$this->NM_cmp_hidden["contato_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_gray"] = 'off'; }		
			break;		
		case 'Y':
			$this->NM_cmp_hidden["contato_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_green"] = 'on'; }		
			$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_red"] = 'off'; }		
			$this->NM_cmp_hidden["contato_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_gray"] = 'off'; }		
			$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_yellow"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["contato_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_red"] = 'on'; }		
			$this->NM_cmp_hidden["contato_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_gray"] = 'off'; }		
			$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_green"] = 'off'; }		
			$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_yellow"] = 'off'; }					
			break;				
	}	
} else {
	$this->NM_cmp_hidden["contato_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_gray"] = 'on'; }		
	$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_green"] = 'off'; }		
	$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_red"] = 'off'; }						
}



if($this->part_incompleto  == 'Y') {
	$this->NM_field_color["part_cpf"] = "#E84133";
} else {
	$this->NM_field_color["part_cpf"] = "#000000";
}

$sql="
SELECT
	presenca_data_hora, presenca_status, presenca_ativo
FROM
	presencas_rsvp 
WHERE
	presenca_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)." 
AND  
	presenca_ativo = ".$this->Db->qstr($valor_y)." 
AND 
	presenca_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."	
ORDER BY 
	presenca_data_hora DESC
LIMIT 1"
;	
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->retornop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->retornop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->retornop = false;
          $this->retornop_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->retornop[0][0])) {
	$cstatusp = $this->retornop[0][1];
	switch($cstatusp) {
		case 'A':
			$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_gray"] = 'on'; }		
			$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_green"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_red"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["presenca_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_green"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_red"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_gray"] = 'off'; }		
			break;		
		case 'Y':
			$this->NM_cmp_hidden["presenca_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_green"] = 'on'; }		
			$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_red"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_gray"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["presenca_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_red"] = 'on'; }		
			$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_gray"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_green"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
			break;				
	}
} else {
	$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_gray"] = 'on'; }		
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_red"] = 'off'; }						
}

$sql="
SELECT
	solicitacao_data_hora, solicitacao_status, solicitacao_ativo
FROM
	solicitacoes_rsvp 
WHERE
	solicitacao_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)." 
AND  
	solicitacao_ativo = ".$this->Db->qstr($valor_y)." 
AND 
	solicitacao_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."	
ORDER BY 
	solicitacao_data_hora DESC
LIMIT 1"
;	
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->retornos = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->retornos[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->retornos = false;
          $this->retornos_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->retornos[0][0])) {
	$cstatuss = $this->retornos[0][1];	
	switch($cstatuss) {
		case 'A':
			$this->NM_cmp_hidden["solic_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_gray"] = 'on'; }		
			$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_amarela"] = 'off'; }					
			$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_green"] = 'off'; }		
			$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_red"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["solic_amarela"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_amarela"] = 'on'; }					
			$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_green"] = 'off'; }		
			$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_red"] = 'off'; }		
			$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_gray"] = 'off'; }		
			break;		
		case 'Y':
			$this->NM_cmp_hidden["solic_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_green"] = 'on'; }		
			$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_red"] = 'off'; }		
			$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_gray"] = 'off'; }		
			$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_amarela"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["solic_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_red"] = 'on'; }		
			$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_gray"] = 'off'; }		
			$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_green"] = 'off'; }		
			$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_amarela"] = 'off'; }					
			break;				
	}
} else {
	$this->NM_cmp_hidden["solic_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_gray"] = 'on'; }		
	$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_amarela"] = 'off'; }					
	$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_green"] = 'off'; }		
	$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_red"] = 'off'; }						
}



$sql3="
SELECT 
	programac_cpf_participante, programac_id_evento, programac_ativo
FROM 
	programac_rsvp
WHERE 
	programac_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)." 
AND  
	programac_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
AND 
	programac_ativo = ".$this->Db->qstr($valor_y)." 
ORDER BY 	
	programac_data_hora DESC, programac_ativo DESC, programac_cpf_participante ASC, programac_id_evento ASC
LIMIT 1	
";
 
      $nm_select = $sql3; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs3 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs3[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs3 = false;
          $this->rs3_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rs3[0][0])) {
	$this->ativo = $this->rs3[0][2];
	if ($this->ativo == 'Y') { 
		$this->NM_cmp_hidden["prog_ok"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["prog_ok"] = 'on'; }				
		$this->NM_cmp_hidden["prog_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["prog_gray"] = 'off'; }			
	} else {
		$this->NM_cmp_hidden["prog_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["prog_gray"] = 'on'; }			
		$this->NM_cmp_hidden["prog_ok"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["prog_ok"] = 'off'; }		
	}	
} else {	
	$this->NM_cmp_hidden["prog_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["prog_gray"] = 'on'; }			
	$this->NM_cmp_hidden["prog_ok"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["prog_ok"] = 'off'; }				
}

$sql4="
	SELECT    
	COUNT(id_aereo) as qtde
	FROM
		aereos_rsvp		
	WHERE 
		aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND  
		aereo_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND 
		aereo_ativo = ".$this->Db->qstr($valor_y)."
";	
 
      $nm_select = $sql4; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs4 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs4[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs4 = false;
          $this->rs4_erro = $this->Db->ErrorMsg();
      } 

if (isset($this->rs4[0][0])) {
	$qtde = $this->rs4[0][0];
} else {
	$qtde = 0;
}
if ($qtde > 0) {
	$astatus = $this->part_aereo_ok ;
	switch($astatus) {
		case 'A':
			$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_gray"] = 'on'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;		
		case 'Y':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_green"] = 'on'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_red"] = 'on'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;				
		case 'R':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_roxo"] = 'on'; }					
			break;				
		case '':
			$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_gray"] = 'on'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;
	}	
} else {
	$this->part_aereo_ok  = 'A';
	$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_gray"] = 'on'; }		
	$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_green"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_red"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
}	
					 
$sql5="
	SELECT    
	COUNT(hospedagem_id) as qtdeh
	FROM
		hospedagem_rsvp		
	WHERE 
		hosp_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		hosp_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND 
		hosp_ativo = ".$this->Db->qstr($valor_y)."
";	
 
      $nm_select = $sql5; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs5 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs5[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs5 = false;
          $this->rs5_erro = $this->Db->ErrorMsg();
      } 

if (isset($this->rs5[0][0])) {
	$qtdeh = $this->rs5[0][0];
} else {
	$qtdeh = 0;
}
if ($qtdeh > 0) {					 
	$hstatus = $this->part_hospedagem ;
	switch($hstatus) {
		case 'A':			
			$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_gray"] = 'on'; }		
			$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_green"] = 'off'; }		
			$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_red"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_gray"] = 'off'; }		
			$this->NM_cmp_hidden["hotel_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_green"] = 'off'; }		
			$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_red"] = 'off'; }					
			break;
		case 'Y':
			$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_gray"] = 'off'; }		
			$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["hotel_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_green"] = 'on'; }		
			$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_red"] = 'off'; }					
			break;					
		case 'N':
			$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_gray"] = 'off'; }		
			$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_green"] = 'off'; }		
			$this->NM_cmp_hidden["hotel_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_red"] = 'on'; }					
			break;							
		case '':
			$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_gray"] = 'on'; }		
			$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_green"] = 'off'; }		
			$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_red"] = 'off'; }					
			break;							
	}	
} else {
	$this->part_hospedagem  = 'A';
$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_gray"] = 'on'; }		
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_green"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_red"] = 'off'; }	
			
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
						
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_green"] = 'off'; }		
			
	$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_red"] = 'off'; }					
					
}

$sql6="
	SELECT    
	COUNT(id_transfer) as qtdet
	FROM
		transfer_rsvp		
	WHERE 
		tra_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND  
		tra_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND 
		tra_ativo = ".$this->Db->qstr($valor_y)." 
";	
 
      $nm_select = $sql6; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs6 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs6[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs6 = false;
          $this->rs6_erro = $this->Db->ErrorMsg();
      } 

if (isset($this->rs6[0][0])) {
	$qtdet = $this->rs6[0][0];
} else {
	$qtdet = 0;
}
if ($qtdet > 0) {
	$tstatus = $this->part_transfer ;
	switch($tstatus) {
		case 'A':
			$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_gray"] = 'on'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_red"] = 'off'; }					
								
			break;
		case 'P':
			$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_gray"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_red"] = 'off'; }					
								
			break;		
		case 'Y':
			$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_gray"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_green"] = 'on'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_red"] = 'off'; }					
								
			break;								  
		case 'N':
			$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_gray"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_red"] = 'on'; }					
				
			break;			
		case '':
			$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_gray"] = 'on'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_red"] = 'off'; }					
				
			break;
	}	
} else {
	$this->part_transfer  = 'A';
	$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_gray"] = 'on'; }		
	$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_green"] = 'off'; }		
	$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_red"] = 'off'; }					
			
}	
		
switch($this->part_opcionais ) {
	case 'N':
		$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
		$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["opcionais_green"] = 'off'; }		
		break;
	case 'Y':
		$this->NM_cmp_hidden["opcionais_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["opcionais_gray"] = 'off'; }		
		$this->NM_cmp_hidden["opcionais_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["opcionais_green"] = 'on'; }		
		break;		
	case '':
		$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
		$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["opcionais_green"] = 'off'; }		
		break;						  
}						
		
if ($this->part_anotacoes  == 'Y') {
	$this->NM_cmp_hidden["anotacoes_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["anotacoes_green"] = 'on'; }		
	$this->NM_cmp_hidden["anotacoes_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["anotacoes_gray"] = 'off'; }	
} else {
	$this->NM_cmp_hidden["anotacoes_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["anotacoes_green"] = 'off'; }		
	$this->NM_cmp_hidden["anotacoes_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["anotacoes_gray"] = 'on'; }	
}
						 
if ($this->part_ativo  == 'Y') {
	$this->NM_cmp_hidden["ativo"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["ativo"] = 'on'; }		
	$this->NM_cmp_hidden["inativo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["inativo"] = 'off'; }				
} else {
	$this->NM_cmp_hidden["ativo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["ativo"] = 'off'; }		
	$this->NM_cmp_hidden["inativo"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["inativo"] = 'on'; }	
	
	$this->NM_cmp_hidden["contato_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_gray"] = 'on'; }		
	$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_green"] = 'off'; }		
	$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["contato_red"] = 'off'; }		
	
	$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_gray"] = 'on'; }		
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_red"] = 'off'; }		
	
	$this->NM_cmp_hidden["solic_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_gray"] = 'on'; }		
	$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_amarela"] = 'off'; }					
	$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_green"] = 'off'; }		
	$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_red"] = 'off'; }					
	
	$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_gray"] = 'on'; }		
	$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_green"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_red"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_roxo"] = 'off'; }							
					  
	$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_gray"] = 'on'; }		
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_green"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_red"] = 'off'; }						
					  
	$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_gray"] = 'on'; }		
	$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_green"] = 'off'; }		
	$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_red"] = 'off'; }					
		
					  
	$this->NM_cmp_hidden["prog_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["prog_gray"] = 'on'; }			
	$this->NM_cmp_hidden["prog_ok"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["prog_ok"] = 'off'; }		
					  
	$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
	$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["opcionais_green"] = 'off'; }		
					  
	$this->NM_cmp_hidden["anotacoes_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["anotacoes_green"] = 'off'; }		
	$this->NM_cmp_hidden["anotacoes_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["anotacoes_gray"] = 'on'; }					  
}
						 
if ($this->part_ativo  == 'Y') {
	$this->NM_field_style["participante_id"] = "background-color:#cde4cd;font-size:bold;"; 	
} else {
	$this->NM_field_style["participante_id"] = "background-color:#ffbbba;font-size:bold;";
}
			

					 
$this->NM_cmp_hidden["cv_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["cv_gray"] = 'off'; }		
$this->NM_cmp_hidden["cv_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["cv_green"] = 'off'; }	
					 
$sqlv2="
	SELECT
		presenca_data_hora, presenca_status, presenca_ativo
	FROM
		presencas_rsvp 
	WHERE
		presenca_id_evento = ".$this->Db->qstr($evento)."	 
	AND  
		presenca_status = ".$this->Db->qstr($valor_n)." 
	AND 
		presenca_cpf_participante = ".$this->Db->qstr($cpf)."	
	ORDER BY 
		presenca_data_hora DESC
	LIMIT 1"
	;	
 
      $nm_select = $sqlv2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->retornop2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->retornop2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->retornop2 = false;
          $this->retornop2_erro = $this->Db->ErrorMsg();
      } 

if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->retornop2[0][0])) {
	$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_gray"] = 'off'; }			
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["presenca_red"] = 'on'; }	
	$this->NM_cmp_hidden["solic_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_red"] = 'on'; }					
	$this->NM_cmp_hidden["prog_ok"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["prog_ok"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_red"] = 'on'; }					
	$this->NM_cmp_hidden["hotel_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_red"] = 'on'; }					
	$this->NM_cmp_hidden["transfer_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_red"] = 'on'; }	
	
	$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_gray"] = 'off'; }		
			
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
						
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["hotel_green"] = 'off'; }		
			
 						
	
	$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_gray"] = 'off'; }		
	$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["transfer_green"] = 'off'; }		
	

	$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_gray"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_green"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["aereo_roxo"] = 'off'; }
					  
	$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_gray"] = 'off'; }		
	$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_amarela"] = 'off'; }					
	$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["solic_green"] = 'off'; }		
				  
	$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
	$this->NM_cmp_hidden["anotacoes_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['php_cmp_sel']["anotacoes_gray"] = 'on'; }	
}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida'])
         { 
             $this->xml_registro .= "</" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro .= "</grid_acompanhantes_bnt>\r\n";
         }
         else
         {
             $this->xml_registro .= " />\r\n";
         }
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida'])
         { 
             fwrite($xml_f, $this->xml_registro);
             if ($this->Grava_view)
             {
                fwrite($xml_v, $this->xml_registro);
             }
         }
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['embutida'])
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
              require_once($this->Ini->path_aplicacao . "grid_acompanhantes_bnt_res_xml.class.php");
              $this->Res = new grid_acompanhantes_bnt_res_xml();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_res_grid'] = true;
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
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_res_file']['xml'];
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_res_file']['xml']);
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
                      $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_res_file']['view'];
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
                      unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_res_file']['view']);
                  }
              } 
              else 
              {
                  $this->Arquivo_view = $this->Arq_zip;
              } 
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- participante_id
   function NM_export_participante_id()
   {
             nmgp_Form_Num_Val($this->participante_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['participante_id'])) ? $this->New_label['participante_id'] : "Cód. Acomp."; 
         }
         else
         {
             $SC_Label = "participante_id"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->participante_id) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->participante_id) . "\"";
         }
   }
   //----- nome_acomp
   function NM_export_nome_acomp()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nome_acomp))
         {
             $this->nome_acomp = sc_convert_encoding($this->nome_acomp, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['nome_acomp'])) ? $this->New_label['nome_acomp'] : "Acompanhante"; 
         }
         else
         {
             $SC_Label = "nome_acomp"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nome_acomp) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nome_acomp) . "\"";
         }
   }
   //----- part_ddd_celular_01
   function NM_export_part_ddd_celular_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_ddd_celular_01))
         {
             $this->part_ddd_celular_01 = sc_convert_encoding($this->part_ddd_celular_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_ddd_celular_01'])) ? $this->New_label['part_ddd_celular_01'] : "DDD Cel."; 
         }
         else
         {
             $SC_Label = "part_ddd_celular_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_ddd_celular_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_ddd_celular_01) . "\"";
         }
   }
   //----- part_celeular_01
   function NM_export_part_celeular_01()
   {
             if ($this->part_celeular_01 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->part_celeular_01, "#####-####"); 
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_celeular_01))
         {
             $this->part_celeular_01 = sc_convert_encoding($this->part_celeular_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_celeular_01'])) ? $this->New_label['part_celeular_01'] : "Celular"; 
         }
         else
         {
             $SC_Label = "part_celeular_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_celeular_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_celeular_01) . "\"";
         }
   }
   //----- contato_gray
   function NM_export_contato_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_gray))
         {
             $this->contato_gray = sc_convert_encoding($this->contato_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_gray'])) ? $this->New_label['contato_gray'] : "C"; 
         }
         else
         {
             $SC_Label = "contato_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_gray) . "\"";
         }
   }
   //----- contato_yellow
   function NM_export_contato_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_yellow))
         {
             $this->contato_yellow = sc_convert_encoding($this->contato_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_yellow'])) ? $this->New_label['contato_yellow'] : "C"; 
         }
         else
         {
             $SC_Label = "contato_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_yellow) . "\"";
         }
   }
   //----- contato_green
   function NM_export_contato_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_green))
         {
             $this->contato_green = sc_convert_encoding($this->contato_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_green'])) ? $this->New_label['contato_green'] : "C"; 
         }
         else
         {
             $SC_Label = "contato_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_green) . "\"";
         }
   }
   //----- contato_red
   function NM_export_contato_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_red))
         {
             $this->contato_red = sc_convert_encoding($this->contato_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_red'])) ? $this->New_label['contato_red'] : "C"; 
         }
         else
         {
             $SC_Label = "contato_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_red) . "\"";
         }
   }
   //----- presenca_gray
   function NM_export_presenca_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_gray))
         {
             $this->presenca_gray = sc_convert_encoding($this->presenca_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_gray'])) ? $this->New_label['presenca_gray'] : "P"; 
         }
         else
         {
             $SC_Label = "presenca_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_gray) . "\"";
         }
   }
   //----- presenca_yellow
   function NM_export_presenca_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_yellow))
         {
             $this->presenca_yellow = sc_convert_encoding($this->presenca_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_yellow'])) ? $this->New_label['presenca_yellow'] : "P"; 
         }
         else
         {
             $SC_Label = "presenca_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_yellow) . "\"";
         }
   }
   //----- presenca_red
   function NM_export_presenca_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_red))
         {
             $this->presenca_red = sc_convert_encoding($this->presenca_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_red'])) ? $this->New_label['presenca_red'] : "P"; 
         }
         else
         {
             $SC_Label = "presenca_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_red) . "\"";
         }
   }
   //----- presenca_green
   function NM_export_presenca_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_green))
         {
             $this->presenca_green = sc_convert_encoding($this->presenca_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_green'])) ? $this->New_label['presenca_green'] : "P"; 
         }
         else
         {
             $SC_Label = "presenca_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_green) . "\"";
         }
   }
   //----- solic_gray
   function NM_export_solic_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->solic_gray))
         {
             $this->solic_gray = sc_convert_encoding($this->solic_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['solic_gray'])) ? $this->New_label['solic_gray'] : "S"; 
         }
         else
         {
             $SC_Label = "solic_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->solic_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->solic_gray) . "\"";
         }
   }
   //----- solic_amarela
   function NM_export_solic_amarela()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->solic_amarela))
         {
             $this->solic_amarela = sc_convert_encoding($this->solic_amarela, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['solic_amarela'])) ? $this->New_label['solic_amarela'] : "S"; 
         }
         else
         {
             $SC_Label = "solic_amarela"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->solic_amarela) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->solic_amarela) . "\"";
         }
   }
   //----- solic_green
   function NM_export_solic_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->solic_green))
         {
             $this->solic_green = sc_convert_encoding($this->solic_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['solic_green'])) ? $this->New_label['solic_green'] : "S"; 
         }
         else
         {
             $SC_Label = "solic_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->solic_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->solic_green) . "\"";
         }
   }
   //----- solic_red
   function NM_export_solic_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->solic_red))
         {
             $this->solic_red = sc_convert_encoding($this->solic_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['solic_red'])) ? $this->New_label['solic_red'] : "S"; 
         }
         else
         {
             $SC_Label = "solic_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->solic_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->solic_red) . "\"";
         }
   }
   //----- prog_gray
   function NM_export_prog_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->prog_gray))
         {
             $this->prog_gray = sc_convert_encoding($this->prog_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['prog_gray'])) ? $this->New_label['prog_gray'] : "PG"; 
         }
         else
         {
             $SC_Label = "prog_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->prog_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->prog_gray) . "\"";
         }
   }
   //----- prog_ok
   function NM_export_prog_ok()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->prog_ok))
         {
             $this->prog_ok = sc_convert_encoding($this->prog_ok, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['prog_ok'])) ? $this->New_label['prog_ok'] : "PG"; 
         }
         else
         {
             $SC_Label = "prog_ok"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->prog_ok) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->prog_ok) . "\"";
         }
   }
   //----- aereo_gray
   function NM_export_aereo_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_gray))
         {
             $this->aereo_gray = sc_convert_encoding($this->aereo_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_gray'])) ? $this->New_label['aereo_gray'] : "A"; 
         }
         else
         {
             $SC_Label = "aereo_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_gray) . "\"";
         }
   }
   //----- aereo_green
   function NM_export_aereo_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_green))
         {
             $this->aereo_green = sc_convert_encoding($this->aereo_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_green'])) ? $this->New_label['aereo_green'] : "A"; 
         }
         else
         {
             $SC_Label = "aereo_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_green) . "\"";
         }
   }
   //----- aereo_yellow
   function NM_export_aereo_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_yellow))
         {
             $this->aereo_yellow = sc_convert_encoding($this->aereo_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_yellow'])) ? $this->New_label['aereo_yellow'] : "A"; 
         }
         else
         {
             $SC_Label = "aereo_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_yellow) . "\"";
         }
   }
   //----- aereo_red
   function NM_export_aereo_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_red))
         {
             $this->aereo_red = sc_convert_encoding($this->aereo_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_red'])) ? $this->New_label['aereo_red'] : "A"; 
         }
         else
         {
             $SC_Label = "aereo_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_red) . "\"";
         }
   }
   //----- aereo_roxo
   function NM_export_aereo_roxo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_roxo))
         {
             $this->aereo_roxo = sc_convert_encoding($this->aereo_roxo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_roxo'])) ? $this->New_label['aereo_roxo'] : "A"; 
         }
         else
         {
             $SC_Label = "aereo_roxo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_roxo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_roxo) . "\"";
         }
   }
   //----- hotel_gray
   function NM_export_hotel_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_gray))
         {
             $this->hotel_gray = sc_convert_encoding($this->hotel_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_gray'])) ? $this->New_label['hotel_gray'] : "H"; 
         }
         else
         {
             $SC_Label = "hotel_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_gray) . "\"";
         }
   }
   //----- hotel_yellow
   function NM_export_hotel_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_yellow))
         {
             $this->hotel_yellow = sc_convert_encoding($this->hotel_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_yellow'])) ? $this->New_label['hotel_yellow'] : "H"; 
         }
         else
         {
             $SC_Label = "hotel_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_yellow) . "\"";
         }
   }
   //----- hotel_red
   function NM_export_hotel_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_red))
         {
             $this->hotel_red = sc_convert_encoding($this->hotel_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_red'])) ? $this->New_label['hotel_red'] : "H"; 
         }
         else
         {
             $SC_Label = "hotel_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_red) . "\"";
         }
   }
   //----- hotel_green
   function NM_export_hotel_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_green))
         {
             $this->hotel_green = sc_convert_encoding($this->hotel_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_green'])) ? $this->New_label['hotel_green'] : "H"; 
         }
         else
         {
             $SC_Label = "hotel_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_green) . "\"";
         }
   }
   //----- transfer_gray
   function NM_export_transfer_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->transfer_gray))
         {
             $this->transfer_gray = sc_convert_encoding($this->transfer_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['transfer_gray'])) ? $this->New_label['transfer_gray'] : "T"; 
         }
         else
         {
             $SC_Label = "transfer_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->transfer_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->transfer_gray) . "\"";
         }
   }
   //----- transfer_green
   function NM_export_transfer_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->transfer_green))
         {
             $this->transfer_green = sc_convert_encoding($this->transfer_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['transfer_green'])) ? $this->New_label['transfer_green'] : "T"; 
         }
         else
         {
             $SC_Label = "transfer_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->transfer_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->transfer_green) . "\"";
         }
   }
   //----- transfer_red
   function NM_export_transfer_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->transfer_red))
         {
             $this->transfer_red = sc_convert_encoding($this->transfer_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['transfer_red'])) ? $this->New_label['transfer_red'] : "T"; 
         }
         else
         {
             $SC_Label = "transfer_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->transfer_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->transfer_red) . "\"";
         }
   }
   //----- transfer_yellow
   function NM_export_transfer_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->transfer_yellow))
         {
             $this->transfer_yellow = sc_convert_encoding($this->transfer_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['transfer_yellow'])) ? $this->New_label['transfer_yellow'] : "T"; 
         }
         else
         {
             $SC_Label = "transfer_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->transfer_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->transfer_yellow) . "\"";
         }
   }
   //----- opcionais_gray
   function NM_export_opcionais_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->opcionais_gray))
         {
             $this->opcionais_gray = sc_convert_encoding($this->opcionais_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['opcionais_gray'])) ? $this->New_label['opcionais_gray'] : "O"; 
         }
         else
         {
             $SC_Label = "opcionais_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->opcionais_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->opcionais_gray) . "\"";
         }
   }
   //----- opcionais_green
   function NM_export_opcionais_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->opcionais_green))
         {
             $this->opcionais_green = sc_convert_encoding($this->opcionais_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['opcionais_green'])) ? $this->New_label['opcionais_green'] : "O"; 
         }
         else
         {
             $SC_Label = "opcionais_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->opcionais_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->opcionais_green) . "\"";
         }
   }
   //----- anotacoes_green
   function NM_export_anotacoes_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->anotacoes_green))
         {
             $this->anotacoes_green = sc_convert_encoding($this->anotacoes_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['anotacoes_green'])) ? $this->New_label['anotacoes_green'] : "AN"; 
         }
         else
         {
             $SC_Label = "anotacoes_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->anotacoes_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->anotacoes_green) . "\"";
         }
   }
   //----- anotacoes_gray
   function NM_export_anotacoes_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->anotacoes_gray))
         {
             $this->anotacoes_gray = sc_convert_encoding($this->anotacoes_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['anotacoes_gray'])) ? $this->New_label['anotacoes_gray'] : "AN"; 
         }
         else
         {
             $SC_Label = "anotacoes_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->anotacoes_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->anotacoes_gray) . "\"";
         }
   }
   //----- inativo
   function NM_export_inativo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->inativo))
         {
             $this->inativo = sc_convert_encoding($this->inativo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['inativo'])) ? $this->New_label['inativo'] : "Inativo"; 
         }
         else
         {
             $SC_Label = "inativo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->inativo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->inativo) . "\"";
         }
   }
   //----- cv_gray
   function NM_export_cv_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cv_gray))
         {
             $this->cv_gray = sc_convert_encoding($this->cv_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cv_gray'])) ? $this->New_label['cv_gray'] : "CV"; 
         }
         else
         {
             $SC_Label = "cv_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cv_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cv_gray) . "\"";
         }
   }
   //----- cv_green
   function NM_export_cv_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cv_green))
         {
             $this->cv_green = sc_convert_encoding($this->cv_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cv_green'])) ? $this->New_label['cv_green'] : "CV"; 
         }
         else
         {
             $SC_Label = "cv_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cv_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cv_green) . "\"";
         }
   }
   //----- ativo
   function NM_export_ativo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ativo))
         {
             $this->ativo = sc_convert_encoding($this->ativo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ativo'])) ? $this->New_label['ativo'] : "Ativo"; 
         }
         else
         {
             $SC_Label = "ativo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ativo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ativo) . "\"";
         }
   }
   //----- participante_id_mestre
   function NM_export_participante_id_mestre()
   {
             nmgp_Form_Num_Val($this->participante_id_mestre, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['participante_id_mestre'])) ? $this->New_label['participante_id_mestre'] : "Participante Id Mestre"; 
         }
         else
         {
             $SC_Label = "participante_id_mestre"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->participante_id_mestre) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->participante_id_mestre) . "\"";
         }
   }
   //----- part_ativo
   function NM_export_part_ativo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_ativo))
         {
             $this->part_ativo = sc_convert_encoding($this->part_ativo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_ativo'])) ? $this->New_label['part_ativo'] : "Ativo"; 
         }
         else
         {
             $SC_Label = "part_ativo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_ativo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_ativo) . "\"";
         }
   }
   //----- part_sexo
   function NM_export_part_sexo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_sexo))
         {
             $this->part_sexo = sc_convert_encoding($this->part_sexo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_sexo'])) ? $this->New_label['part_sexo'] : "Part Sexo"; 
         }
         else
         {
             $SC_Label = "part_sexo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_sexo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_sexo) . "\"";
         }
   }
   //----- part_cpf
   function NM_export_part_cpf()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_cpf))
         {
             $this->part_cpf = sc_convert_encoding($this->part_cpf, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_cpf'])) ? $this->New_label['part_cpf'] : "Cód. Acomp."; 
         }
         else
         {
             $SC_Label = "part_cpf"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_cpf) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_cpf) . "\"";
         }
   }
   //----- part_cpf_mestre
   function NM_export_part_cpf_mestre()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_cpf_mestre))
         {
             $this->part_cpf_mestre = sc_convert_encoding($this->part_cpf_mestre, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_cpf_mestre'])) ? $this->New_label['part_cpf_mestre'] : "CPF Partic."; 
         }
         else
         {
             $SC_Label = "part_cpf_mestre"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_cpf_mestre) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_cpf_mestre) . "\"";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Acompanhantes  :: XML</TITLE>
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
<form name="Fdown" method="get" action="grid_acompanhantes_bnt_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_acompanhantes_bnt"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_bnt']['xml_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'off';
}


function MakeColora($vp_evento,$vp_cpf,$tipo) {
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		
	
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_acompanhantes_bnt']['contr_erro'] = 'off';
}

}

?>
