<?php

class grid_roomlist_rsvp_rm_rtf
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
                   nm_limpa_str_grid_roomlist_rsvp_rm($cadapar[1]);
                   nm_protect_num_grid_roomlist_rsvp_rm($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_roomlist_rsvp_rm']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_roomlist_rsvp_rm($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_roomlist_rsvp_rm($_SESSION["vg_usuario_id"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_roomlist_rsvp_rm($_SESSION["rsvp_global"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_roomlist_rsvp_rm($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_roomlist_rsvp_rm($_SESSION["parm1"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_roomlist_rsvp_rm($_SESSION["vg_cpfseg"]);
      }
      if (isset($parm2)) 
      {
          $_SESSION['parm2'] = $parm2;
          nm_limpa_str_grid_roomlist_rsvp_rm($_SESSION["parm2"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_roomlist_rsvp_rm_total.class.php"); 
      $this->Tot      = new grid_roomlist_rsvp_rm_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['tot_geral'][1];
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['SC_Ind_Groupby'] == "sc_free_total")
          {
              $this->cnt_cpf = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['tot_geral'][2];
          }
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_roomlist_rsvp_rm";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_roomlist_rsvp_rm.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_rm']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->hospede = (isset($Busca_temp['hospede'])) ? $Busca_temp['hospede'] : ""; 
          $tmp_pos = (is_string($this->hospede)) ? strpos($this->hospede, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospede))
          {
              $this->hospede = substr($this->hospede, 0, $tmp_pos);
          }
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
          $this->passaporte = (isset($Busca_temp['passaporte'])) ? $Busca_temp['passaporte'] : ""; 
          $tmp_pos = (is_string($this->passaporte)) ? strpos($this->passaporte, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->passaporte))
          {
              $this->passaporte = substr($this->passaporte, 0, $tmp_pos);
          }
          $this->cod_publico = (isset($Busca_temp['cod_publico'])) ? $Busca_temp['cod_publico'] : ""; 
          $tmp_pos = (is_string($this->cod_publico)) ? strpos($this->cod_publico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_publico))
          {
              $this->cod_publico = substr($this->cod_publico, 0, $tmp_pos);
          }
          $this->publico_dsc = (isset($Busca_temp['publico_dsc'])) ? $Busca_temp['publico_dsc'] : ""; 
          $tmp_pos = (is_string($this->publico_dsc)) ? strpos($this->publico_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico_dsc))
          {
              $this->publico_dsc = substr($this->publico_dsc, 0, $tmp_pos);
          }
          $this->cod_hotel = (isset($Busca_temp['cod_hotel'])) ? $Busca_temp['cod_hotel'] : ""; 
          $tmp_pos = (is_string($this->cod_hotel)) ? strpos($this->cod_hotel, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_hotel))
          {
              $this->cod_hotel = substr($this->cod_hotel, 0, $tmp_pos);
          }
          $this->hotel_dsc = (isset($Busca_temp['hotel_dsc'])) ? $Busca_temp['hotel_dsc'] : ""; 
          $tmp_pos = (is_string($this->hotel_dsc)) ? strpos($this->hotel_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_dsc))
          {
              $this->hotel_dsc = substr($this->hotel_dsc, 0, $tmp_pos);
          }
          $this->cod_acomodacao = (isset($Busca_temp['cod_acomodacao'])) ? $Busca_temp['cod_acomodacao'] : ""; 
          $tmp_pos = (is_string($this->cod_acomodacao)) ? strpos($this->cod_acomodacao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_acomodacao))
          {
              $this->cod_acomodacao = substr($this->cod_acomodacao, 0, $tmp_pos);
          }
          $this->acomodacao_dsc = (isset($Busca_temp['acomodacao_dsc'])) ? $Busca_temp['acomodacao_dsc'] : ""; 
          $tmp_pos = (is_string($this->acomodacao_dsc)) ? strpos($this->acomodacao_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->acomodacao_dsc))
          {
              $this->acomodacao_dsc = substr($this->acomodacao_dsc, 0, $tmp_pos);
          }
          $this->cod_categoria = (isset($Busca_temp['cod_categoria'])) ? $Busca_temp['cod_categoria'] : ""; 
          $tmp_pos = (is_string($this->cod_categoria)) ? strpos($this->cod_categoria, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_categoria))
          {
              $this->cod_categoria = substr($this->cod_categoria, 0, $tmp_pos);
          }
          $this->categoria_dsc = (isset($Busca_temp['categoria_dsc'])) ? $Busca_temp['categoria_dsc'] : ""; 
          $tmp_pos = (is_string($this->categoria_dsc)) ? strpos($this->categoria_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->categoria_dsc))
          {
              $this->categoria_dsc = substr($this->categoria_dsc, 0, $tmp_pos);
          }
          $this->voo_ida = (isset($Busca_temp['voo_ida'])) ? $Busca_temp['voo_ida'] : ""; 
          $tmp_pos = (is_string($this->voo_ida)) ? strpos($this->voo_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->voo_ida))
          {
              $this->voo_ida = substr($this->voo_ida, 0, $tmp_pos);
          }
          $this->cod_cia_ida = (isset($Busca_temp['cod_cia_ida'])) ? $Busca_temp['cod_cia_ida'] : ""; 
          $tmp_pos = (is_string($this->cod_cia_ida)) ? strpos($this->cod_cia_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_cia_ida))
          {
              $this->cod_cia_ida = substr($this->cod_cia_ida, 0, $tmp_pos);
          }
          $this->dt_checkin = (isset($Busca_temp['dt_checkin'])) ? $Busca_temp['dt_checkin'] : ""; 
          $tmp_pos = (is_string($this->dt_checkin)) ? strpos($this->dt_checkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->dt_checkin))
          {
              $this->dt_checkin = substr($this->dt_checkin, 0, $tmp_pos);
          }
          $this->dt_checkin_2 = (isset($Busca_temp['dt_checkin_input_2'])) ? $Busca_temp['dt_checkin_input_2'] : ""; 
          $this->hr_transferin = (isset($Busca_temp['hr_transferin'])) ? $Busca_temp['hr_transferin'] : ""; 
          $tmp_pos = (is_string($this->hr_transferin)) ? strpos($this->hr_transferin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hr_transferin))
          {
              $this->hr_transferin = substr($this->hr_transferin, 0, $tmp_pos);
          }
          $this->voo_volta = (isset($Busca_temp['voo_volta'])) ? $Busca_temp['voo_volta'] : ""; 
          $tmp_pos = (is_string($this->voo_volta)) ? strpos($this->voo_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->voo_volta))
          {
              $this->voo_volta = substr($this->voo_volta, 0, $tmp_pos);
          }
          $this->cod_cia_volta = (isset($Busca_temp['cod_cia_volta'])) ? $Busca_temp['cod_cia_volta'] : ""; 
          $tmp_pos = (is_string($this->cod_cia_volta)) ? strpos($this->cod_cia_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_cia_volta))
          {
              $this->cod_cia_volta = substr($this->cod_cia_volta, 0, $tmp_pos);
          }
          $this->forma_pgto = (isset($Busca_temp['forma_pgto'])) ? $Busca_temp['forma_pgto'] : ""; 
          $tmp_pos = (is_string($this->forma_pgto)) ? strpos($this->forma_pgto, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->forma_pgto))
          {
              $this->forma_pgto = substr($this->forma_pgto, 0, $tmp_pos);
          }
          $this->dt_checkout = (isset($Busca_temp['dt_checkout'])) ? $Busca_temp['dt_checkout'] : ""; 
          $tmp_pos = (is_string($this->dt_checkout)) ? strpos($this->dt_checkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->dt_checkout))
          {
              $this->dt_checkout = substr($this->dt_checkout, 0, $tmp_pos);
          }
          $this->dt_checkout_2 = (isset($Busca_temp['dt_checkout_input_2'])) ? $Busca_temp['dt_checkout_input_2'] : ""; 
          $this->intervalo_trout = (isset($Busca_temp['intervalo_trout'])) ? $Busca_temp['intervalo_trout'] : ""; 
          $tmp_pos = (is_string($this->intervalo_trout)) ? strpos($this->intervalo_trout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->intervalo_trout))
          {
              $this->intervalo_trout = substr($this->intervalo_trout, 0, $tmp_pos);
          }
          $this->hr_transferout = (isset($Busca_temp['hr_transferout'])) ? $Busca_temp['hr_transferout'] : ""; 
          $tmp_pos = (is_string($this->hr_transferout)) ? strpos($this->hr_transferout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hr_transferout))
          {
              $this->hr_transferout = substr($this->hr_transferout, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
          $this->tipo_transfer = (isset($Busca_temp['tipo_transfer'])) ? $Busca_temp['tipo_transfer'] : ""; 
          $tmp_pos = (is_string($this->tipo_transfer)) ? strpos($this->tipo_transfer, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_transfer))
          {
              $this->tipo_transfer = substr($this->tipo_transfer, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
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
$titulo  = 'Rooming List Participantes';

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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_roomlist_rsvp_rm";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['sc_outra_jan'] = false;
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
        action="grid_roomlist_rsvp_rm_fim.php"
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

$nome_empresa = '';
if($usunivel== 'CONVIDADO') {
	$sqlconv = "
		SELECT
			evento_id,
			usuario_id,
			nome_empresa
		FROM
			eventos_usuarios_rsvp			
		WHERE	
			evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
		AND 
			usuario_id = ".$this->Db->qstr($this->sc_temp_vg_usuario_id)."	
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


$resultado  = $this->PrepRoom2($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'P',$usunivel);
$resultado3 = $this->PrepRoom3($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'P',$usunivel);

if ($resultado == 'ADICIONA OK') {
	$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
	$this->RetNivel($usunivel);
	$id_evento  = $this->sc_temp_vg_evento_id;
	$this->id_usuario_relato  = $this->sc_temp_vg_usuario_id;	
	$sqld="
		SELECT 
			cpf, 
			hospede 
		FROM 
			roomlist_rsvp_r
		WHERE 
			cpf IN (SELECT DISTINCT amq_cpf_01 FROM roomlist_rsvp_r)
		OR 
			amq_cpf_01 IN (SELECT DISTINCT cpf FROM roomlist_rsvp_r)
		AND 
			tipo_pessoa = 'ACOMPANHANTE'
		AND 
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	";
	 
      $nm_select = $sqld; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

	if ($this->rs  !== false) {
		if (strpos(strtolower($this->Ini->nm_tpbanco), "access") === false && !$this->Ini->sc_tem_trans_banco)
{
    $this->Db->BeginTrans();
    $this->Ini->sc_tem_trans_banco = true;
}

		while (!$this->rs->EOF) {
			$apaga_reg = $this->rs->fields[0];
			$sqldint ="
				DELETE FROM 
					roomlist_rsvp_r
				WHERE   
					cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
				AND
					cpf = ".$this->Db->qstr($apaga_reg)."		
			";				
			
     $nm_select = $sqldint; 
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
      
			$this->rs->MoveNext();		
		}
		$this->rs->Close();
	}
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	$sqld="
		SELECT 
			cpf, 
			hospede 
		FROM 
			roomlist_rsvp_r
		WHERE 
			cpf IN (SELECT DISTINCT amq_cpf_02 FROM roomlist_rsvp_r)
		OR 
			amq_cpf_02 IN (SELECT DISTINCT cpf FROM roomlist_rsvp_r)
		AND 
			tipo_pessoa = 'ACOMPANHANTE'
		AND 
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	";
	 
      $nm_select = $sqld; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

	if ($this->rs  !== false) {
		if (strpos(strtolower($this->Ini->nm_tpbanco), "access") === false && !$this->Ini->sc_tem_trans_banco)
{
    $this->Db->BeginTrans();
    $this->Ini->sc_tem_trans_banco = true;
}

		while (!$this->rs->EOF) {
			$apaga_reg = $this->rs->fields[0];
			$sqldint ="
				DELETE FROM 
					roomlist_rsvp_r
				WHERE   
					cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
				AND
					cpf = ".$this->Db->qstr($apaga_reg)."		
			";				
			
     $nm_select = $sqldint; 
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
      
			$this->rs->MoveNext();		
		}
		$this->rs->Close();
	}
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	$sqld="
		SELECT 
			cpf, 
			hospede 
		FROM 
			roomlist_rsvp_r
		WHERE 
			cpf IN (SELECT DISTINCT amq_cpf_03 FROM roomlist_rsvp_r)
		OR 
			amq_cpf_03 IN (SELECT DISTINCT cpf FROM roomlist_rsvp_r)
		AND 
			tipo_pessoa = 'ACOMPANHANTE'
		AND 
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	";
	 
      $nm_select = $sqld; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

	if ($this->rs  !== false) {
		if (strpos(strtolower($this->Ini->nm_tpbanco), "access") === false && !$this->Ini->sc_tem_trans_banco)
{
    $this->Db->BeginTrans();
    $this->Ini->sc_tem_trans_banco = true;
}

		while (!$this->rs->EOF) {
			$apaga_reg = $this->rs->fields[0];
			$sqldint ="
				DELETE FROM 
					roomlist_rsvp_r
				WHERE   
					cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
				AND
					cpf = ".$this->Db->qstr($apaga_reg)."		
			";				
			
     $nm_select = $sqldint; 
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
      
			$this->rs->MoveNext();		
		}
		$this->rs->Close();
	}
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	$sqld="
		SELECT 
			cpf, 
			hospede 
		FROM 
			roomlist_rsvp_r
		WHERE 
			cpf IN (SELECT DISTINCT amq_cpf_04 FROM roomlist_rsvp_r)
		OR 
			amq_cpf_04 IN (SELECT DISTINCT cpf FROM roomlist_rsvp_r)
		AND 
			tipo_pessoa = 'ACOMPANHANTE'
		AND 
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	";
	 
      $nm_select = $sqld; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

	if ($this->rs  !== false) {
		if (strpos(strtolower($this->Ini->nm_tpbanco), "access") === false && !$this->Ini->sc_tem_trans_banco)
{
    $this->Db->BeginTrans();
    $this->Ini->sc_tem_trans_banco = true;
}

		while (!$this->rs->EOF) {
			$apaga_reg = $this->rs->fields[0];
			$sqldint ="
				DELETE FROM 
					roomlist_rsvp_r
				WHERE   
					cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
				AND
					cpf = ".$this->Db->qstr($apaga_reg)."		
			";				
			
     $nm_select = $sqldint; 
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
      
			$this->rs->MoveNext();		
		}
		$this->rs->Close();
	}
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
		
} else {
	$params = array(
	'title' => 'Atenção!',
	'type' => 'warning',
	'timer' => '5000',
	'showConfirmButton' => 'false',
	'position' => 'center',
	'toast' => 'true'
	);
	$this->nm_mens_alert[] = "Erro ao carregar o relatório de Rooming List!";$this->nm_params_alert[] = $params;}

if($usunivel == 'CONVIDADO') {	
	$sqld="
		DELETE FROM 
			roomlist_rsvp_r
		WHERE   
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
		AND
			dsc_empresa_rsvp <> ".$this->Db->qstr($nome_empresa)."		
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
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_parm2)) {$_SESSION['parm2'] = $this->sc_temp_parm2;}
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['hospede'])) ? $this->New_label['hospede'] : "Hóspede"; 
          if ($Cada_col == "hospede" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cpf'])) ? $this->New_label['cpf'] : "CPF"; 
          if ($Cada_col == "cpf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['passaporte'])) ? $this->New_label['passaporte'] : "Passaporte"; 
          if ($Cada_col == "passaporte" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rg'])) ? $this->New_label['rg'] : "RG"; 
          if ($Cada_col == "rg" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['data_nasc'])) ? $this->New_label['data_nasc'] : "Nascimento"; 
          if ($Cada_col == "data_nasc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ddd_clelular'])) ? $this->New_label['ddd_clelular'] : "DDD Celular"; 
          if ($Cada_col == "ddd_clelular" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['celular'])) ? $this->New_label['celular'] : "Celular"; 
          if ($Cada_col == "celular" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['telefone_internacional'])) ? $this->New_label['telefone_internacional'] : "Telefone Internacional"; 
          if ($Cada_col == "telefone_internacional" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['e_mail'])) ? $this->New_label['e_mail'] : "e-Mail"; 
          if ($Cada_col == "e_mail" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['publico_dsc'])) ? $this->New_label['publico_dsc'] : "Público"; 
          if ($Cada_col == "publico_dsc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['hotel_dsc'])) ? $this->New_label['hotel_dsc'] : "Hotel"; 
          if ($Cada_col == "hotel_dsc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['acomodacao_dsc'])) ? $this->New_label['acomodacao_dsc'] : "Acomodação"; 
          if ($Cada_col == "acomodacao_dsc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['categoria_dsc'])) ? $this->New_label['categoria_dsc'] : "Categoria"; 
          if ($Cada_col == "categoria_dsc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['dt_checkin'])) ? $this->New_label['dt_checkin'] : "CheckIn"; 
          if ($Cada_col == "dt_checkin" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['hr_transferin'])) ? $this->New_label['hr_transferin'] : "Transfer In"; 
          if ($Cada_col == "hr_transferin" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cia_dsc_volta'])) ? $this->New_label['cia_dsc_volta'] : "Cia, Aérea Volta"; 
          if ($Cada_col == "cia_dsc_volta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['dt_checkout'])) ? $this->New_label['dt_checkout'] : "CheckOut"; 
          if ($Cada_col == "dt_checkout" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['hr_transferout'])) ? $this->New_label['hr_transferout'] : "Tranfer Out"; 
          if ($Cada_col == "hr_transferout" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['intervalo_trout'])) ? $this->New_label['intervalo_trout'] : "Intervalo Transf. Out"; 
          if ($Cada_col == "intervalo_trout" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['early_checkin'])) ? $this->New_label['early_checkin'] : "Early Checkin"; 
          if ($Cada_col == "early_checkin" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['late_checkout'])) ? $this->New_label['late_checkout'] : "Late Checkout"; 
          if ($Cada_col == "late_checkout" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['forma_pgto'])) ? $this->New_label['forma_pgto'] : "Forma Pgto"; 
          if ($Cada_col == "forma_pgto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['observacoes'])) ? $this->New_label['observacoes'] : "Observaçôes"; 
          if ($Cada_col == "observacoes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pacote_dsc'])) ? $this->New_label['pacote_dsc'] : "Pacote"; 
          if ($Cada_col == "pacote_dsc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tipo_pessoa'])) ? $this->New_label['tipo_pessoa'] : "Tipo"; 
          if ($Cada_col == "tipo_pessoa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['amq_nome_01'])) ? $this->New_label['amq_nome_01'] : "Acompanhante 01 (mesmo quarto)"; 
          if ($Cada_col == "amq_nome_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['amq_cpf_01'])) ? $this->New_label['amq_cpf_01'] : "CPF Acompanhante 01"; 
          if ($Cada_col == "amq_cpf_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['amq_rg_01'])) ? $this->New_label['amq_rg_01'] : "RG Acompanhante 01"; 
          if ($Cada_col == "amq_rg_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['amq_docest_01'])) ? $this->New_label['amq_docest_01'] : "Doc. Estrang. Acompanhante 01"; 
          if ($Cada_col == "amq_docest_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['amq_dtnasc_01'])) ? $this->New_label['amq_dtnasc_01'] : "Dt. Nasc. Acompanhante 01"; 
          if ($Cada_col == "amq_dtnasc_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pmq_nome_01'])) ? $this->New_label['pmq_nome_01'] : "Participante 01 (mesmo quarto)"; 
          if ($Cada_col == "pmq_nome_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pmq_cpf_01'])) ? $this->New_label['pmq_cpf_01'] : "CPF Participante 01"; 
          if ($Cada_col == "pmq_cpf_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pmq_rg_01'])) ? $this->New_label['pmq_rg_01'] : "RG Participante 01"; 
          if ($Cada_col == "pmq_rg_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pmq_docest_01'])) ? $this->New_label['pmq_docest_01'] : "Doc. Estrang. Participante 01"; 
          if ($Cada_col == "pmq_docest_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pmq_dtnasc_01'])) ? $this->New_label['pmq_dtnasc_01'] : "Dt. Nasc. Participante 01"; 
          if ($Cada_col == "pmq_dtnasc_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['empresa'])) ? $this->New_label['empresa'] : "Empresa"; 
          if ($Cada_col == "empresa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['grupo'])) ? $this->New_label['grupo'] : "Grupo"; 
          if ($Cada_col == "grupo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cargo'])) ? $this->New_label['cargo'] : "Cargo"; 
          if ($Cada_col == "cargo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['anotacoes'])) ? $this->New_label['anotacoes'] : "Anotacoes"; 
          if ($Cada_col == "anotacoes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_dsc'])) ? $this->New_label['evento_dsc'] : "Evento"; 
          if ($Cada_col == "evento_dsc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['room_id'])) ? $this->New_label['room_id'] : "Room Id"; 
          if ($Cada_col == "room_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT hospede, cpf, passaporte, rg, str_replace (convert(char(10),data_nasc,102), '.', '-') + ' ' + convert(char(8),data_nasc,20), ddd_clelular, celular, telefone_internacional, e_mail, publico_dsc, hotel_dsc, acomodacao_dsc, categoria_dsc, str_replace (convert(char(10),dt_checkin,102), '.', '-') + ' ' + convert(char(8),dt_checkin,20), str_replace (convert(char(10),hr_transferin,102), '.', '-') + ' ' + convert(char(8),hr_transferin,20), cia_dsc_volta, str_replace (convert(char(10),dt_checkout,102), '.', '-') + ' ' + convert(char(8),dt_checkout,20), str_replace (convert(char(10),hr_transferout,102), '.', '-') + ' ' + convert(char(8),hr_transferout,20), str_replace (convert(char(10),intervalo_trout,102), '.', '-') + ' ' + convert(char(8),intervalo_trout,20), early_checkin, late_checkout, forma_pgto, observacoes, pacote_dsc, tipo_pessoa, amq_nome_01, amq_cpf_01, amq_rg_01, amq_docest_01, str_replace (convert(char(10),amq_dtnasc_01,102), '.', '-') + ' ' + convert(char(8),amq_dtnasc_01,20), pmq_nome_01, pmq_cpf_01, pmq_rg_01, pmq_docest_01, str_replace (convert(char(10),pmq_dtnasc_01,102), '.', '-') + ' ' + convert(char(8),pmq_dtnasc_01,20), empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT hospede, cpf, passaporte, rg, data_nasc, ddd_clelular, celular, telefone_internacional, e_mail, publico_dsc, hotel_dsc, acomodacao_dsc, categoria_dsc, dt_checkin, hr_transferin, cia_dsc_volta, dt_checkout, hr_transferout, intervalo_trout, early_checkin, late_checkout, forma_pgto, observacoes, pacote_dsc, tipo_pessoa, amq_nome_01, amq_cpf_01, amq_rg_01, amq_docest_01, amq_dtnasc_01, pmq_nome_01, pmq_cpf_01, pmq_rg_01, pmq_docest_01, pmq_dtnasc_01, empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT hospede, cpf, passaporte, rg, convert(char(23),data_nasc,121), ddd_clelular, celular, telefone_internacional, e_mail, publico_dsc, hotel_dsc, acomodacao_dsc, categoria_dsc, convert(char(23),dt_checkin,121), convert(char(23),hr_transferin,121), cia_dsc_volta, convert(char(23),dt_checkout,121), convert(char(23),hr_transferout,121), convert(char(23),intervalo_trout,121), early_checkin, late_checkout, forma_pgto, observacoes, pacote_dsc, tipo_pessoa, amq_nome_01, amq_cpf_01, amq_rg_01, amq_docest_01, convert(char(23),amq_dtnasc_01,121), pmq_nome_01, pmq_cpf_01, pmq_rg_01, pmq_docest_01, convert(char(23),pmq_dtnasc_01,121), empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT hospede, cpf, passaporte, rg, data_nasc, ddd_clelular, celular, telefone_internacional, e_mail, publico_dsc, hotel_dsc, acomodacao_dsc, categoria_dsc, dt_checkin, hr_transferin, cia_dsc_volta, dt_checkout, hr_transferout, intervalo_trout, early_checkin, late_checkout, forma_pgto, observacoes, pacote_dsc, tipo_pessoa, amq_nome_01, amq_cpf_01, amq_rg_01, amq_docest_01, amq_dtnasc_01, pmq_nome_01, pmq_cpf_01, pmq_rg_01, pmq_docest_01, pmq_dtnasc_01, empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT hospede, cpf, passaporte, rg, EXTEND(data_nasc, YEAR TO DAY), ddd_clelular, celular, telefone_internacional, e_mail, publico_dsc, hotel_dsc, acomodacao_dsc, categoria_dsc, EXTEND(dt_checkin, YEAR TO DAY), hr_transferin, cia_dsc_volta, EXTEND(dt_checkout, YEAR TO DAY), hr_transferout, intervalo_trout, early_checkin, late_checkout, forma_pgto, observacoes, pacote_dsc, tipo_pessoa, amq_nome_01, amq_cpf_01, amq_rg_01, amq_docest_01, EXTEND(amq_dtnasc_01, YEAR TO DAY), pmq_nome_01, pmq_cpf_01, pmq_rg_01, pmq_docest_01, EXTEND(pmq_dtnasc_01, YEAR TO DAY), empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT hospede, cpf, passaporte, rg, data_nasc, ddd_clelular, celular, telefone_internacional, e_mail, publico_dsc, hotel_dsc, acomodacao_dsc, categoria_dsc, dt_checkin, hr_transferin, cia_dsc_volta, dt_checkout, hr_transferout, intervalo_trout, early_checkin, late_checkout, forma_pgto, observacoes, pacote_dsc, tipo_pessoa, amq_nome_01, amq_cpf_01, amq_rg_01, amq_docest_01, amq_dtnasc_01, pmq_nome_01, pmq_cpf_01, pmq_rg_01, pmq_docest_01, pmq_dtnasc_01, empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['order_grid'];
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
         $this->hospede = $rs->fields[0] ;  
         $this->cpf = $rs->fields[1] ;  
         $this->passaporte = $rs->fields[2] ;  
         $this->rg = $rs->fields[3] ;  
         $this->data_nasc = $rs->fields[4] ;  
         $this->ddd_clelular = $rs->fields[5] ;  
         $this->celular = $rs->fields[6] ;  
         $this->telefone_internacional = $rs->fields[7] ;  
         $this->e_mail = $rs->fields[8] ;  
         $this->publico_dsc = $rs->fields[9] ;  
         $this->hotel_dsc = $rs->fields[10] ;  
         $this->acomodacao_dsc = $rs->fields[11] ;  
         $this->categoria_dsc = $rs->fields[12] ;  
         $this->dt_checkin = $rs->fields[13] ;  
         $this->hr_transferin = $rs->fields[14] ;  
         $this->cia_dsc_volta = $rs->fields[15] ;  
         $this->dt_checkout = $rs->fields[16] ;  
         $this->hr_transferout = $rs->fields[17] ;  
         $this->intervalo_trout = $rs->fields[18] ;  
         $this->early_checkin = $rs->fields[19] ;  
         $this->late_checkout = $rs->fields[20] ;  
         $this->forma_pgto = $rs->fields[21] ;  
         $this->observacoes = $rs->fields[22] ;  
         $this->pacote_dsc = $rs->fields[23] ;  
         $this->tipo_pessoa = $rs->fields[24] ;  
         $this->amq_nome_01 = $rs->fields[25] ;  
         $this->amq_cpf_01 = $rs->fields[26] ;  
         $this->amq_rg_01 = $rs->fields[27] ;  
         $this->amq_docest_01 = $rs->fields[28] ;  
         $this->amq_dtnasc_01 = $rs->fields[29] ;  
         $this->pmq_nome_01 = $rs->fields[30] ;  
         $this->pmq_cpf_01 = $rs->fields[31] ;  
         $this->pmq_rg_01 = $rs->fields[32] ;  
         $this->pmq_docest_01 = $rs->fields[33] ;  
         $this->pmq_dtnasc_01 = $rs->fields[34] ;  
         $this->empresa = $rs->fields[35] ;  
         $this->grupo = $rs->fields[36] ;  
         $this->cargo = $rs->fields[37] ;  
         $this->anotacoes = $rs->fields[38] ;  
         $this->evento_dsc = $rs->fields[39] ;  
         $this->room_id = $rs->fields[40] ;  
         $this->room_id = (string)$this->room_id;
         $this->id_usuario_relato = $rs->fields[41] ;  
         $this->id_usuario_relato = (string)$this->id_usuario_relato;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- hospede
   function NM_export_hospede()
   {
         $this->hospede = html_entity_decode($this->hospede, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hospede = strip_tags($this->hospede);
         $this->hospede = NM_charset_to_utf8($this->hospede);
         $this->hospede = str_replace('<', '&lt;', $this->hospede);
         $this->hospede = str_replace('>', '&gt;', $this->hospede);
         $this->Texto_tag .= "<td>" . $this->hospede . "</td>\r\n";
   }
   //----- cpf
   function NM_export_cpf()
   {
         $this->cpf = html_entity_decode($this->cpf, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cpf = strip_tags($this->cpf);
         $this->cpf = NM_charset_to_utf8($this->cpf);
         $this->cpf = str_replace('<', '&lt;', $this->cpf);
         $this->cpf = str_replace('>', '&gt;', $this->cpf);
         $this->Texto_tag .= "<td>" . $this->cpf . "</td>\r\n";
   }
   //----- passaporte
   function NM_export_passaporte()
   {
         $this->passaporte = html_entity_decode($this->passaporte, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->passaporte = strip_tags($this->passaporte);
         $this->passaporte = NM_charset_to_utf8($this->passaporte);
         $this->passaporte = str_replace('<', '&lt;', $this->passaporte);
         $this->passaporte = str_replace('>', '&gt;', $this->passaporte);
         $this->Texto_tag .= "<td>" . $this->passaporte . "</td>\r\n";
   }
   //----- rg
   function NM_export_rg()
   {
         $this->rg = html_entity_decode($this->rg, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->rg = strip_tags($this->rg);
         $this->rg = NM_charset_to_utf8($this->rg);
         $this->rg = str_replace('<', '&lt;', $this->rg);
         $this->rg = str_replace('>', '&gt;', $this->rg);
         $this->Texto_tag .= "<td>" . $this->rg . "</td>\r\n";
   }
   //----- data_nasc
   function NM_export_data_nasc()
   {
             $conteudo_x =  $this->data_nasc;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_nasc, "YYYY-MM-DD  ");
                 $this->data_nasc = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->data_nasc = NM_charset_to_utf8($this->data_nasc);
         $this->data_nasc = str_replace('<', '&lt;', $this->data_nasc);
         $this->data_nasc = str_replace('>', '&gt;', $this->data_nasc);
         $this->Texto_tag .= "<td>" . $this->data_nasc . "</td>\r\n";
   }
   //----- ddd_clelular
   function NM_export_ddd_clelular()
   {
         $this->ddd_clelular = html_entity_decode($this->ddd_clelular, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ddd_clelular = strip_tags($this->ddd_clelular);
         $this->ddd_clelular = NM_charset_to_utf8($this->ddd_clelular);
         $this->ddd_clelular = str_replace('<', '&lt;', $this->ddd_clelular);
         $this->ddd_clelular = str_replace('>', '&gt;', $this->ddd_clelular);
         $this->Texto_tag .= "<td>" . $this->ddd_clelular . "</td>\r\n";
   }
   //----- celular
   function NM_export_celular()
   {
             if ($this->celular !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->celular, "#####-####"); 
             } 
         $this->celular = html_entity_decode($this->celular, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->celular = strip_tags($this->celular);
         $this->celular = NM_charset_to_utf8($this->celular);
         $this->celular = str_replace('<', '&lt;', $this->celular);
         $this->celular = str_replace('>', '&gt;', $this->celular);
         $this->Texto_tag .= "<td>" . $this->celular . "</td>\r\n";
   }
   //----- telefone_internacional
   function NM_export_telefone_internacional()
   {
         $this->telefone_internacional = html_entity_decode($this->telefone_internacional, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->telefone_internacional = strip_tags($this->telefone_internacional);
         $this->telefone_internacional = NM_charset_to_utf8($this->telefone_internacional);
         $this->telefone_internacional = str_replace('<', '&lt;', $this->telefone_internacional);
         $this->telefone_internacional = str_replace('>', '&gt;', $this->telefone_internacional);
         $this->Texto_tag .= "<td>" . $this->telefone_internacional . "</td>\r\n";
   }
   //----- e_mail
   function NM_export_e_mail()
   {
         $this->e_mail = html_entity_decode($this->e_mail, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->e_mail = strip_tags($this->e_mail);
         $this->e_mail = NM_charset_to_utf8($this->e_mail);
         $this->e_mail = str_replace('<', '&lt;', $this->e_mail);
         $this->e_mail = str_replace('>', '&gt;', $this->e_mail);
         $this->Texto_tag .= "<td>" . $this->e_mail . "</td>\r\n";
   }
   //----- publico_dsc
   function NM_export_publico_dsc()
   {
         $this->publico_dsc = html_entity_decode($this->publico_dsc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->publico_dsc = strip_tags($this->publico_dsc);
         $this->publico_dsc = NM_charset_to_utf8($this->publico_dsc);
         $this->publico_dsc = str_replace('<', '&lt;', $this->publico_dsc);
         $this->publico_dsc = str_replace('>', '&gt;', $this->publico_dsc);
         $this->Texto_tag .= "<td>" . $this->publico_dsc . "</td>\r\n";
   }
   //----- hotel_dsc
   function NM_export_hotel_dsc()
   {
         $this->hotel_dsc = html_entity_decode($this->hotel_dsc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hotel_dsc = strip_tags($this->hotel_dsc);
         $this->hotel_dsc = NM_charset_to_utf8($this->hotel_dsc);
         $this->hotel_dsc = str_replace('<', '&lt;', $this->hotel_dsc);
         $this->hotel_dsc = str_replace('>', '&gt;', $this->hotel_dsc);
         $this->Texto_tag .= "<td>" . $this->hotel_dsc . "</td>\r\n";
   }
   //----- acomodacao_dsc
   function NM_export_acomodacao_dsc()
   {
         $this->acomodacao_dsc = html_entity_decode($this->acomodacao_dsc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acomodacao_dsc = strip_tags($this->acomodacao_dsc);
         $this->acomodacao_dsc = NM_charset_to_utf8($this->acomodacao_dsc);
         $this->acomodacao_dsc = str_replace('<', '&lt;', $this->acomodacao_dsc);
         $this->acomodacao_dsc = str_replace('>', '&gt;', $this->acomodacao_dsc);
         $this->Texto_tag .= "<td>" . $this->acomodacao_dsc . "</td>\r\n";
   }
   //----- categoria_dsc
   function NM_export_categoria_dsc()
   {
         $this->categoria_dsc = html_entity_decode($this->categoria_dsc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->categoria_dsc = strip_tags($this->categoria_dsc);
         $this->categoria_dsc = NM_charset_to_utf8($this->categoria_dsc);
         $this->categoria_dsc = str_replace('<', '&lt;', $this->categoria_dsc);
         $this->categoria_dsc = str_replace('>', '&gt;', $this->categoria_dsc);
         $this->Texto_tag .= "<td>" . $this->categoria_dsc . "</td>\r\n";
   }
   //----- dt_checkin
   function NM_export_dt_checkin()
   {
             $conteudo_x =  $this->dt_checkin;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->dt_checkin, "YYYY-MM-DD  ");
                 $this->dt_checkin = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->dt_checkin = NM_charset_to_utf8($this->dt_checkin);
         $this->dt_checkin = str_replace('<', '&lt;', $this->dt_checkin);
         $this->dt_checkin = str_replace('>', '&gt;', $this->dt_checkin);
         $this->Texto_tag .= "<td>" . $this->dt_checkin . "</td>\r\n";
   }
   //----- hr_transferin
   function NM_export_hr_transferin()
   {
             $conteudo_x =  $this->hr_transferin;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hr_transferin, "HH:II:SS  ");
                 $this->hr_transferin = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         $this->hr_transferin = NM_charset_to_utf8($this->hr_transferin);
         $this->hr_transferin = str_replace('<', '&lt;', $this->hr_transferin);
         $this->hr_transferin = str_replace('>', '&gt;', $this->hr_transferin);
         $this->Texto_tag .= "<td>" . $this->hr_transferin . "</td>\r\n";
   }
   //----- cia_dsc_volta
   function NM_export_cia_dsc_volta()
   {
         $this->cia_dsc_volta = html_entity_decode($this->cia_dsc_volta, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cia_dsc_volta = strip_tags($this->cia_dsc_volta);
         $this->cia_dsc_volta = NM_charset_to_utf8($this->cia_dsc_volta);
         $this->cia_dsc_volta = str_replace('<', '&lt;', $this->cia_dsc_volta);
         $this->cia_dsc_volta = str_replace('>', '&gt;', $this->cia_dsc_volta);
         $this->Texto_tag .= "<td>" . $this->cia_dsc_volta . "</td>\r\n";
   }
   //----- dt_checkout
   function NM_export_dt_checkout()
   {
             $conteudo_x =  $this->dt_checkout;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->dt_checkout, "YYYY-MM-DD  ");
                 $this->dt_checkout = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->dt_checkout = NM_charset_to_utf8($this->dt_checkout);
         $this->dt_checkout = str_replace('<', '&lt;', $this->dt_checkout);
         $this->dt_checkout = str_replace('>', '&gt;', $this->dt_checkout);
         $this->Texto_tag .= "<td>" . $this->dt_checkout . "</td>\r\n";
   }
   //----- hr_transferout
   function NM_export_hr_transferout()
   {
             $conteudo_x =  $this->hr_transferout;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hr_transferout, "HH:II:SS  ");
                 $this->hr_transferout = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         $this->hr_transferout = NM_charset_to_utf8($this->hr_transferout);
         $this->hr_transferout = str_replace('<', '&lt;', $this->hr_transferout);
         $this->hr_transferout = str_replace('>', '&gt;', $this->hr_transferout);
         $this->Texto_tag .= "<td>" . $this->hr_transferout . "</td>\r\n";
   }
   //----- intervalo_trout
   function NM_export_intervalo_trout()
   {
             $conteudo_x =  $this->intervalo_trout;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->intervalo_trout, "HH:II:SS  ");
                 $this->intervalo_trout = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         $this->intervalo_trout = NM_charset_to_utf8($this->intervalo_trout);
         $this->intervalo_trout = str_replace('<', '&lt;', $this->intervalo_trout);
         $this->intervalo_trout = str_replace('>', '&gt;', $this->intervalo_trout);
         $this->Texto_tag .= "<td>" . $this->intervalo_trout . "</td>\r\n";
   }
   //----- early_checkin
   function NM_export_early_checkin()
   {
         $this->early_checkin = html_entity_decode($this->early_checkin, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->early_checkin = strip_tags($this->early_checkin);
         $this->early_checkin = NM_charset_to_utf8($this->early_checkin);
         $this->early_checkin = str_replace('<', '&lt;', $this->early_checkin);
         $this->early_checkin = str_replace('>', '&gt;', $this->early_checkin);
         $this->Texto_tag .= "<td>" . $this->early_checkin . "</td>\r\n";
   }
   //----- late_checkout
   function NM_export_late_checkout()
   {
         $this->late_checkout = html_entity_decode($this->late_checkout, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->late_checkout = strip_tags($this->late_checkout);
         $this->late_checkout = NM_charset_to_utf8($this->late_checkout);
         $this->late_checkout = str_replace('<', '&lt;', $this->late_checkout);
         $this->late_checkout = str_replace('>', '&gt;', $this->late_checkout);
         $this->Texto_tag .= "<td>" . $this->late_checkout . "</td>\r\n";
   }
   //----- forma_pgto
   function NM_export_forma_pgto()
   {
         $this->forma_pgto = html_entity_decode($this->forma_pgto, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->forma_pgto = strip_tags($this->forma_pgto);
         $this->forma_pgto = NM_charset_to_utf8($this->forma_pgto);
         $this->forma_pgto = str_replace('<', '&lt;', $this->forma_pgto);
         $this->forma_pgto = str_replace('>', '&gt;', $this->forma_pgto);
         $this->Texto_tag .= "<td>" . $this->forma_pgto . "</td>\r\n";
   }
   //----- observacoes
   function NM_export_observacoes()
   {
         $this->observacoes = html_entity_decode($this->observacoes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->observacoes = strip_tags($this->observacoes);
         $this->observacoes = NM_charset_to_utf8($this->observacoes);
         $this->observacoes = str_replace('<', '&lt;', $this->observacoes);
         $this->observacoes = str_replace('>', '&gt;', $this->observacoes);
         $this->Texto_tag .= "<td>" . $this->observacoes . "</td>\r\n";
   }
   //----- pacote_dsc
   function NM_export_pacote_dsc()
   {
         $this->pacote_dsc = html_entity_decode($this->pacote_dsc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pacote_dsc = strip_tags($this->pacote_dsc);
         $this->pacote_dsc = NM_charset_to_utf8($this->pacote_dsc);
         $this->pacote_dsc = str_replace('<', '&lt;', $this->pacote_dsc);
         $this->pacote_dsc = str_replace('>', '&gt;', $this->pacote_dsc);
         $this->Texto_tag .= "<td>" . $this->pacote_dsc . "</td>\r\n";
   }
   //----- tipo_pessoa
   function NM_export_tipo_pessoa()
   {
         $this->tipo_pessoa = html_entity_decode($this->tipo_pessoa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_pessoa = strip_tags($this->tipo_pessoa);
         $this->tipo_pessoa = NM_charset_to_utf8($this->tipo_pessoa);
         $this->tipo_pessoa = str_replace('<', '&lt;', $this->tipo_pessoa);
         $this->tipo_pessoa = str_replace('>', '&gt;', $this->tipo_pessoa);
         $this->Texto_tag .= "<td>" . $this->tipo_pessoa . "</td>\r\n";
   }
   //----- amq_nome_01
   function NM_export_amq_nome_01()
   {
         $this->amq_nome_01 = html_entity_decode($this->amq_nome_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->amq_nome_01 = strip_tags($this->amq_nome_01);
         $this->amq_nome_01 = NM_charset_to_utf8($this->amq_nome_01);
         $this->amq_nome_01 = str_replace('<', '&lt;', $this->amq_nome_01);
         $this->amq_nome_01 = str_replace('>', '&gt;', $this->amq_nome_01);
         $this->Texto_tag .= "<td>" . $this->amq_nome_01 . "</td>\r\n";
   }
   //----- amq_cpf_01
   function NM_export_amq_cpf_01()
   {
         $this->amq_cpf_01 = html_entity_decode($this->amq_cpf_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->amq_cpf_01 = strip_tags($this->amq_cpf_01);
         $this->amq_cpf_01 = NM_charset_to_utf8($this->amq_cpf_01);
         $this->amq_cpf_01 = str_replace('<', '&lt;', $this->amq_cpf_01);
         $this->amq_cpf_01 = str_replace('>', '&gt;', $this->amq_cpf_01);
         $this->Texto_tag .= "<td>" . $this->amq_cpf_01 . "</td>\r\n";
   }
   //----- amq_rg_01
   function NM_export_amq_rg_01()
   {
         $this->amq_rg_01 = html_entity_decode($this->amq_rg_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->amq_rg_01 = strip_tags($this->amq_rg_01);
         $this->amq_rg_01 = NM_charset_to_utf8($this->amq_rg_01);
         $this->amq_rg_01 = str_replace('<', '&lt;', $this->amq_rg_01);
         $this->amq_rg_01 = str_replace('>', '&gt;', $this->amq_rg_01);
         $this->Texto_tag .= "<td>" . $this->amq_rg_01 . "</td>\r\n";
   }
   //----- amq_docest_01
   function NM_export_amq_docest_01()
   {
         $this->amq_docest_01 = html_entity_decode($this->amq_docest_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->amq_docest_01 = strip_tags($this->amq_docest_01);
         $this->amq_docest_01 = NM_charset_to_utf8($this->amq_docest_01);
         $this->amq_docest_01 = str_replace('<', '&lt;', $this->amq_docest_01);
         $this->amq_docest_01 = str_replace('>', '&gt;', $this->amq_docest_01);
         $this->Texto_tag .= "<td>" . $this->amq_docest_01 . "</td>\r\n";
   }
   //----- amq_dtnasc_01
   function NM_export_amq_dtnasc_01()
   {
             $conteudo_x =  $this->amq_dtnasc_01;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->amq_dtnasc_01, "YYYY-MM-DD  ");
                 $this->amq_dtnasc_01 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->amq_dtnasc_01 = NM_charset_to_utf8($this->amq_dtnasc_01);
         $this->amq_dtnasc_01 = str_replace('<', '&lt;', $this->amq_dtnasc_01);
         $this->amq_dtnasc_01 = str_replace('>', '&gt;', $this->amq_dtnasc_01);
         $this->Texto_tag .= "<td>" . $this->amq_dtnasc_01 . "</td>\r\n";
   }
   //----- pmq_nome_01
   function NM_export_pmq_nome_01()
   {
         $this->pmq_nome_01 = html_entity_decode($this->pmq_nome_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pmq_nome_01 = strip_tags($this->pmq_nome_01);
         $this->pmq_nome_01 = NM_charset_to_utf8($this->pmq_nome_01);
         $this->pmq_nome_01 = str_replace('<', '&lt;', $this->pmq_nome_01);
         $this->pmq_nome_01 = str_replace('>', '&gt;', $this->pmq_nome_01);
         $this->Texto_tag .= "<td>" . $this->pmq_nome_01 . "</td>\r\n";
   }
   //----- pmq_cpf_01
   function NM_export_pmq_cpf_01()
   {
         $this->pmq_cpf_01 = html_entity_decode($this->pmq_cpf_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pmq_cpf_01 = strip_tags($this->pmq_cpf_01);
         $this->pmq_cpf_01 = NM_charset_to_utf8($this->pmq_cpf_01);
         $this->pmq_cpf_01 = str_replace('<', '&lt;', $this->pmq_cpf_01);
         $this->pmq_cpf_01 = str_replace('>', '&gt;', $this->pmq_cpf_01);
         $this->Texto_tag .= "<td>" . $this->pmq_cpf_01 . "</td>\r\n";
   }
   //----- pmq_rg_01
   function NM_export_pmq_rg_01()
   {
         $this->pmq_rg_01 = html_entity_decode($this->pmq_rg_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pmq_rg_01 = strip_tags($this->pmq_rg_01);
         $this->pmq_rg_01 = NM_charset_to_utf8($this->pmq_rg_01);
         $this->pmq_rg_01 = str_replace('<', '&lt;', $this->pmq_rg_01);
         $this->pmq_rg_01 = str_replace('>', '&gt;', $this->pmq_rg_01);
         $this->Texto_tag .= "<td>" . $this->pmq_rg_01 . "</td>\r\n";
   }
   //----- pmq_docest_01
   function NM_export_pmq_docest_01()
   {
         $this->pmq_docest_01 = html_entity_decode($this->pmq_docest_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pmq_docest_01 = strip_tags($this->pmq_docest_01);
         $this->pmq_docest_01 = NM_charset_to_utf8($this->pmq_docest_01);
         $this->pmq_docest_01 = str_replace('<', '&lt;', $this->pmq_docest_01);
         $this->pmq_docest_01 = str_replace('>', '&gt;', $this->pmq_docest_01);
         $this->Texto_tag .= "<td>" . $this->pmq_docest_01 . "</td>\r\n";
   }
   //----- pmq_dtnasc_01
   function NM_export_pmq_dtnasc_01()
   {
             $conteudo_x =  $this->pmq_dtnasc_01;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pmq_dtnasc_01, "YYYY-MM-DD  ");
                 $this->pmq_dtnasc_01 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->pmq_dtnasc_01 = NM_charset_to_utf8($this->pmq_dtnasc_01);
         $this->pmq_dtnasc_01 = str_replace('<', '&lt;', $this->pmq_dtnasc_01);
         $this->pmq_dtnasc_01 = str_replace('>', '&gt;', $this->pmq_dtnasc_01);
         $this->Texto_tag .= "<td>" . $this->pmq_dtnasc_01 . "</td>\r\n";
   }
   //----- empresa
   function NM_export_empresa()
   {
         $this->empresa = html_entity_decode($this->empresa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->empresa = strip_tags($this->empresa);
         $this->empresa = NM_charset_to_utf8($this->empresa);
         $this->empresa = str_replace('<', '&lt;', $this->empresa);
         $this->empresa = str_replace('>', '&gt;', $this->empresa);
         $this->Texto_tag .= "<td>" . $this->empresa . "</td>\r\n";
   }
   //----- grupo
   function NM_export_grupo()
   {
         $this->grupo = html_entity_decode($this->grupo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->grupo = strip_tags($this->grupo);
         $this->grupo = NM_charset_to_utf8($this->grupo);
         $this->grupo = str_replace('<', '&lt;', $this->grupo);
         $this->grupo = str_replace('>', '&gt;', $this->grupo);
         $this->Texto_tag .= "<td>" . $this->grupo . "</td>\r\n";
   }
   //----- cargo
   function NM_export_cargo()
   {
         $this->cargo = html_entity_decode($this->cargo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cargo = strip_tags($this->cargo);
         $this->cargo = NM_charset_to_utf8($this->cargo);
         $this->cargo = str_replace('<', '&lt;', $this->cargo);
         $this->cargo = str_replace('>', '&gt;', $this->cargo);
         $this->Texto_tag .= "<td>" . $this->cargo . "</td>\r\n";
   }
   //----- anotacoes
   function NM_export_anotacoes()
   {
         $this->anotacoes = html_entity_decode($this->anotacoes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->anotacoes = strip_tags($this->anotacoes);
         $this->anotacoes = NM_charset_to_utf8($this->anotacoes);
         $this->anotacoes = str_replace('<', '&lt;', $this->anotacoes);
         $this->anotacoes = str_replace('>', '&gt;', $this->anotacoes);
         $this->Texto_tag .= "<td>" . $this->anotacoes . "</td>\r\n";
   }
   //----- evento_dsc
   function NM_export_evento_dsc()
   {
         $this->evento_dsc = html_entity_decode($this->evento_dsc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->evento_dsc = strip_tags($this->evento_dsc);
         $this->evento_dsc = NM_charset_to_utf8($this->evento_dsc);
         $this->evento_dsc = str_replace('<', '&lt;', $this->evento_dsc);
         $this->evento_dsc = str_replace('>', '&gt;', $this->evento_dsc);
         $this->Texto_tag .= "<td>" . $this->evento_dsc . "</td>\r\n";
   }
   //----- room_id
   function NM_export_room_id()
   {
             nmgp_Form_Num_Val($this->room_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->room_id = NM_charset_to_utf8($this->room_id);
         $this->room_id = str_replace('<', '&lt;', $this->room_id);
         $this->room_id = str_replace('>', '&gt;', $this->room_id);
         $this->Texto_tag .= "<td>" . $this->room_id . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_rm'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> roomlist_rsvp_r :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_roomlist_rsvp_rm_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_roomlist_rsvp_rm"> 
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

function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function PrepRoom2($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  		
		
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';	
		$valor_y = 'Y';
		$valor_s = 'SIM';
		$valor_n = 'N';		
		
		if ($vp_tipoPessoa == 'P') {                                                                                      
			$sqld="                                                                                                          
			DELETE FROM                                                                                                      
				roomlist_rsvp_r
			WHERE                                                                                                            
				cod_evento = ".$this->Db->qstr($vp_evento)."                                                                                    
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
		$sqlMestre = "		
		SELECT
			hospedagem_rsvp.hosp_cpf_participante,
			hospedagem_rsvp.hosp_id_evento,			        
			hospedagem_rsvp.hosp_acompanhante,		        
			hospedagem_rsvp.hosp_part_acomp,     	        
			hospedagem_rsvp.hosp_id_hotel,			        
			hospedagem_rsvp.hosp_acomodacao,			    
			hospedagem_rsvp.hosp_categoria,  		        
			hospedagem_rsvp.hosp_dt_checkin,			    
			hospedagem_rsvp.hosp_dt_checkout,   		    
			hospedagem_rsvp.hosp_early_chkin,  		        
			hospedagem_rsvp.hosp_late_chkout, 		        
			hospedagem_rsvp.hosp_pagamentos, 		        
			hospedagem_rsvp.hosp_observacoes,		        
			hospedagem_rsvp.hosp_dsc_pacote, 				               
			transfer_rsvp.tra_numvoo_ida,	                
			transfer_rsvp.tra_cia_ida,   		  
			transfer_rsvp.tra_hr_chegada_ida,
			transfer_rsvp.tra_numvoo_volta,                 
			transfer_rsvp.tra_cia_volta,		            
			transfer_rsvp.tra_hr_saida_volta, 	            
			transfer_rsvp.tra_hrtransout,		            
			transfer_rsvp.tra_tipo,	
			transfer_rsvp.tra_direcao,	
			transfer_rsvp.tra_id_hotel,
			hospedagem_rsvp.acmq_01,
			hospedagem_rsvp.acmq_02,
			hospedagem_rsvp.acmq_03,
			hospedagem_rsvp.acmq_04,
			hospedagem_rsvp.pamq_01,
			hospedagem_rsvp.pamq_02,
			hospedagem_rsvp.pamq_03,
			hospedagem_rsvp.pamq_04
		FROM
			hospedagem_rsvp
		RIGHT JOIN
			transfer_rsvp
		ON
			transfer_rsvp.tra_cpf_particip = hospedagem_rsvp.hosp_cpf_participante		
		WHERE
			hospedagem_rsvp.hosp_id_evento = ".$this->Db->qstr($vp_evento)."
		AND
			hospedagem_rsvp.hosp_ativo	= ".$this->Db->qstr($valor_y)." 
		AND 
			hospedagem_rsvp.hosp_status	= ".$this->Db->qstr($valor_y)." 	
		AND
			hospedagem_rsvp.conta_roomlist = ".$this->Db->qstr($valor_s)." 
		AND
			transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)." 
		AND
			transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."						
		ORDER BY
			hospedagem_rsvp.hosp_cpf_participante			
		";
		$_passa_part = true;			                                                                                          
		 
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
				$w_acmq_nome_01		= '';
				$w_acmq_cpf_01		= '';
				$w_acmq_dtnasc_01 	= '';
				$w_acmq_rg_01		= '';
				$w_acmq_docest_01	= '';
				$w_acmq_nome_02		= '';
				$w_acmq_cpf_02		= '';
				$w_acmq_rg_02		= '';
				$w_acmq_docest_02	= '';
				$w_acmq_dtnasc_02	= '';
				$w_acmq_nome_03		= '';
				$w_acmq_cpf_03		= '';
				$w_acmq_rg_03		= '';
				$w_acmq_docest_03	= '';
				$w_acmq_dtnasc_03	= '';
				$w_acmq_nome_04		= '';
				$w_acmq_cpf_04		= '';
				$w_acmq_rg_04		= '';
				$w_acmq_docest_04	= '';
				$w_acmq_dtnasc_04	= '';				
				
				$w_pamq_nome_01		= '';
				$w_pamq_cpf_01		= '';
				$w_pamq_dtnasc_01 	= '';
				$w_pamq_rg_01		= '';
				$w_pamq_docest_01	= '';
				$w_pamq_nome_02		= '';
				$w_pamq_cpf_02		= '';
				$w_pamq_rg_02		= '';
				$w_pamq_docest_02	= '';
				$w_pamq_dtnasc_02	= '';
				$w_pamq_nome_03		= '';
				$w_pamq_cpf_03		= '';
				$w_pamq_rg_03		= '';
				$w_pamq_docest_03	= '';
				$w_pamq_dtnasc_03	= '';
				$w_pamq_nome_04		= '';
				$w_pamq_cpf_04		= '';
				$w_pamq_rg_04		= '';
				$w_pamq_docest_04	= '';
				$w_pamq_dtnasc_04	= '';					
				
				$w_nome	= '';
				$w_part_passaporte = '';      	     				
				$w_part_rg = '';           
				$w_part_dt_nasc = '0000-00-00';   				       	
				$w_part_ddd_celular_01 = '';  	      				
				$w_part_celeular_01 = '';     	 
				$w_part_email = '';           					     
				$w_part_id_evento_publico = '';								
				$w_aqtd_mesquart = '0';   
				$w_pqtd_mesquart = '0';		            
				$w_publico = '';				                
				$w_hotel_dsc = '';			               
				$w_acomodacao = '';			              
				$w_categoria = '';			               
				$w_ciaida = '';			                 
				$w_ciavolta = '';				               
				$w_pagtoDsc = '';				               
				$w_eventoDsc = '';                  				
				$w_usurelDsc = '';                 
				$w_tipopess = '';                  
				$w_acompanhado = '';               
				
				$w_hosp_cpf_participante	= $this->rsm[$i][0];		
				$w_hosp_id_evento		    = $this->rsm[$i][1];     
				$w_hosp_acompanhante	    = $this->rsm[$i][2];     
				$w_hosp_part_acomp     	    = $this->rsm[$i][3];     
				$w_hosp_id_hotel		    = $this->rsm[$i][4];     
				$w_hosp_acomodacao		 	= $this->rsm[$i][5];     
				$w_hosp_categoria  		    = $this->rsm[$i][6];     
				$w_hosp_dt_checkin		 	= $this->rsm[$i][7];     
				$w_hosp_dt_checkout   	 	= $this->rsm[$i][8];     
				$w_hosp_early_chkin  	    = $this->rsm[$i][9];     
				$w_hosp_late_chkout 	    = $this->rsm[$i][10];    
				$w_hosp_pagamentos 		    = $this->rsm[$i][11];    
				$w_hosp_observacoes		    = $this->rsm[$i][12];    
				$w_hosp_dsc_pacote          = $this->rsm[$i][13];    
				$w_tra_numvoo_ida	        = $this->rsm[$i][14];	
				$w_tra_cia_ida   		    = $this->rsm[$i][15];	
				$w_tra_hr_saida_ida         = $this->rsm[$i][16];	
				$w_tra_numvoo_volta         = $this->rsm[$i][17];	
				$w_tra_cia_volta		    = $this->rsm[$i][18];	
				$w_tra_hr_saida_volta 	  	= $this->rsm[$i][19];    
				$w_tra_hrtransout		    = $this->rsm[$i][20];	
				$w_tra_tipotransfer			= $this->rsm[$i][21];    
				$f_tra_direcao				= $this->rsm[$i][22];	
				$f_tra_id_hotel				= $this->rsm[$i][23];    
				$w_hosp_acmq_01				= $this->rsm[$i][24];	
				$w_hosp_acmq_02				= $this->rsm[$i][25];    
				$w_hosp_acmq_03				= $this->rsm[$i][26];    
				$w_hosp_acmq_04				= $this->rsm[$i][27];    
				$w_hosp_pamq_01				= $this->rsm[$i][28];    
				$w_hosp_pamq_02				= $this->rsm[$i][29];    
				$w_hosp_pamq_03				= $this->rsm[$i][30];    
				$w_hosp_pamq_04				= $this->rsm[$i][31];	

				$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						nome_pessoa,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,						
						part_id_evento_publico,
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."
					ORDER BY                                                                                                        
						part_cpf
				";
				 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspart[0][0])) {											
					$w_nome				   		= $this->rspart[0][0];			  	             
					$w_part_passaporte     		= $this->rspart[0][1];    	     
					$w_part_rg             		= $this->rspart[0][2];    	
					$w_part_dt_nasc        		= $this->rspart[0][3];  	
					$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
					$w_part_celeular_01      	= $this->rspart[0][5]; 
					$w_part_email            	= $this->rspart[0][6];    
					$w_part_id_evento_publico	= $this->rspart[0][7];   
					$w_empresa					= $this->rspart[0][9];
					$w_grupo					= $this->rspart[0][10];
					$w_cargo					= $this->rspart[0][11];
					$w_tipopess 				= 'PARTICIPANTE';
					$w_foneinter				= $this->rspart[0][12];
					$w_dsc_emp_rsvp				= $this->rspart[0][13];					
				} else {
					$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						part_nome,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,	
						part_id_evento_publico					
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."			
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspart[0][0])) {											
						$w_nome				   		= $this->rspart[0][0];			  	             
						$w_part_passaporte     		= $this->rspart[0][1];    	     
						$w_part_rg             		= $this->rspart[0][2];    	
						$w_part_dt_nasc        		= $this->rspart[0][3];  	
						$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
						$w_part_celeular_01      	= $this->rspart[0][5]; 
						$w_part_email            	= $this->rspart[0][6];    
						$w_part_id_evento_publico	= $this->rspart[0][7];  
						$w_empresa					= $this->rspart[0][9];
						$w_grupo					= $this->rspart[0][10];
						$w_cargo					= $this->rspart[0][11];
						$w_tipopess 				= 'ACOMPANHANTE';
						$w_foneinter				= $this->rspart[0][12];
						$w_dsc_emp_rsvp				= $this->rspart[0][13];
					}					
				}		
				$foneok = is_null($w_foneinter);
				if ($foneok == true) {
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
				switch($w_tra_tipotransfer) {                                                                                      
					case 'A':                                                                                                      
						$w_tra_tipotransfer = 'AEREO';  		                                                                               
						break;                                                                                                        
					case 'L':                                                                                                      
						$w_tra_tipotransfer	= 'LOCAL';                                                                                   
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_tra_tipotransfer	= 'PROPRIO';                                                                                 
						break;	                                                                                                       
				}                                                                                                              
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)."                                                                                 
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
				$sqlPgt = "								                                                                                             
				SELECT                                                                                                          
					COD_PAGAMENTOS,
					DES_PAGAMENTOS
				FROM                                                                                                            
					pagamentos_rsvp
				WHERE                                                                                                           
					COD_PAGAMENTOS = ".$this->Db->qstr($w_hosp_pagamentos)."                                                                                 
				ORDER BY                                                                                                        
					COD_PAGAMENTOS
				";		                                                                                                            
				 
      $nm_select = $sqlPgt; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspgt = false;
          $this->rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $this->rspgt[0][1];                                                                                  
				} else {                                                                                                        
					$w_pagtoDsc = "";				                                                                                         
				}		
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = ".$this->Db->qstr($w_tra_cia_ida)."                                                                                 
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
					cia_id = ".$this->Db->qstr($w_tra_cia_volta)."                                                                                 
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
				$sqlAco = "								                                                                                             
				SELECT                                                                                                          
					acomodacao_id,
					acomodacao_desc
				FROM                                                                                                            
					tbl_acomodacoes
				WHERE                                                                                                           
					acomodacao_id = ".$this->Db->qstr($w_hosp_acomodacao)."                                                                                 
				ORDER BY                                                                                                        
					acomodacao_id
				";		                                                                                                            
				 
      $nm_select = $sqlAco; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaco = false;
          $this->rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsaco[0][0])) {									                                                                            
					$w_acomodacao = $this->rsaco[0][1];                                                                                  
				} else {                                                                                                        
					$w_acomodacao = "";				                                                                                         
				}					
				$sqlCat = "								                                                                                             
				SELECT                                                                                                          
					acomod_id,
					acomod_dsc
				FROM                                                                                                            
					tbl_categ_acomod
				WHERE                                                                                                           
					acomod_id = ".$this->Db->qstr($w_hosp_categoria)."                                                                                 
				ORDER BY                                                                                                        
					acomod_id
				";		                                                                                                            
				 
      $nm_select = $sqlCat; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscat = false;
          $this->rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscat[0][0])) {									                                                                            
					$w_categoria = $this->rscat[0][1];                                                                                  
				} else {                                                                                                        
					$w_categoria = "";				                                                                                         
				}					
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($w_part_id_evento_publico)."                                                                                 
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
					hotel_id = ".$this->Db->qstr($w_hosp_id_hotel)."                                                                                 
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
					
				if ($w_hosp_early_chkin == 'Y') {
					$w_hosp_early_chkin = 'SIM';
				} else {
					$w_hosp_early_chkin = 'ABERTO';
				}
				if ($w_hosp_late_chkout == 'Y') {
					$w_hosp_late_chkout = 'SIM';
				} else {	
					$w_hosp_late_chkout = 'ABERTO';
				}					
				$sqlanot = "
				SELECT
					ant_evento_id,
					ant_cpf_participante,
					ant_dsc
				FROM
					anotacoes_rsvp
				WHERE
					ant_evento_id = ".$this->Db->qstr($vp_evento)." 
				AND
					ant_cpf_participante = ".$this->Db->qstr($w_hosp_cpf_participante)." 
				ORDER BY
					ant_evento_id, ant_cpf_participante					
				";
				 
      $nm_select = $sqlanot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsanot = false;
          $this->rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsanot[0][0])) {
					$w_anotacao = $this->rsanot[0][2];
				} else {
					$w_anotacao = '';
				}	
				$w_acompanhado = "";
				if ($w_tipopess  == 'ACOMPANHANTE') {						
					$sqlAcm = "								                                                                                             
					SELECT                                                                                                          
					part_cpf,
					part_cpf_mestre,
					part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf,part_id_evento
					";		                                                                                                            
					 
      $nm_select = $sqlAcm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspacm = false;
          $this->rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $this->rspacm[0][1];                                                                                
						$sqlCPFm = "								                                                                                             
						SELECT                                                                                                          
							part_cpf,
							nome_pessoa,
							part_id_evento
						FROM                                                                                                            
							participantes_rsvp
						WHERE                                                                                                           
							part_cpf = ".$this->Db->qstr($w_cpf_mestre)."                                                                                 
						ORDER BY                                                                                                        
						part_cpf,part_id_evento
						";		                                                                                                            
						 
      $nm_select = $sqlCPFm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspcpf = false;
          $this->rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($this->rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $this->rspcpf[0][1]; 					
						} else {                                                                                                        
							$w_acompanhado = "";				                                                                                         
						}					
					}	
				}					
				     				
				if ($w_hosp_acmq_01 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_01		= $this->rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_acmq_rg_01		= $this->rsplhac[0][3];
						$w_acmq_docest_01	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_02 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_02		= $this->rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_acmq_rg_02		= $this->rsplhac[0][3];
						$w_acmq_docest_02	= $this->rsplhac[0][4];				
					}
				}
								
				if ($w_hosp_acmq_03 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_03		= $this->rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_acmq_rg_03		= $this->rsplhac[0][3];
						$w_acmq_docest_03	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_04 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_04		= $this->rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_acmq_rg_04		= $this->rsplhac[0][3];
						$w_acmq_docest_04	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_01	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_01		= $this->rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_pamq_rg_01		= $this->rsplhac[0][3];
						$w_pamq_docest_01	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_02	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_02		= $this->rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_02	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_03	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_03		= $this->rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_pamq_rg_03		= $this->rsplhac[0][3];
						$w_pamq_docest_03	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_04	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_04		= $this->rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_04	= $this->rsplhac[0][4];				
					}										
				}	
				
				$sqlnoinc = "								                                                                                             
				SELECT                                                                                                          
					cpf,						
					cod_evento
				FROM                                                                                                            
					roomlist_rsvp_r
				WHERE                                                                                                           
					cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
				AND 
					cod_evento = ".$this->Db->qstr($w_hosp_id_evento)."
				AND
					id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
				AND
					cod_hotel = ".$this->Db->qstr($w_hosp_id_hotel)."
				ORDER BY                                                                                                        
					cpf
				";
				 
      $nm_select = $sqlnoinc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsnoinc = false;
          $this->rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsnoinc[0][0])) {															
					$inclui = 'N';
				} else {
					$inclui = 'S';
				}
				
				
				if ($inclui == 'S' && $w_nome <> '') {					
					$sqli = "
					INSERT INTO                                                                                                     
						roomlist_rsvp_r		                                                                                                
						(hospede,					
						cpf,					
						passaporte,			    
						RG,					    
						data_nasc,			    
						ddd_clelular,			
						celular,				
						e_mail,				    
						acom_mesmo_quarto,      
						aqtd_mesmo_quarto,	    
						part_mesmo_quarto,	    
						pqtd_mesmo_quarto,	    
						cod_publico,			
						publico_dsc,			
						cod_hotel,			    
						hotel_dsc,			    
						cod_acomodacao,		    
						acomodacao_dsc,		    
						cod_categoria,		    
						categoria_dsc,		    
						voo_ida,				
						cod_cia_ida,			
						cia_dsc_ida,			
						dt_checkin, 			
						hr_transferin,		    
						voo_volta,			    
						cod_cia_volta,		    
						cia_dsc_volta,		    
						dt_checkout,			
						hr_transferout,		    
						intervalo_trout,		
						early_checkin,		    
						late_checkout,		    
						cod_forma_pgto,		    
						forma_pgto,			    
						observacoes,			
						pacote_dsc,			    
						cod_evento,			    
						evento_dsc,			    
						id_usuario_relato,	    
						usuario_relato_dsc,	    
						tipo_transfer,
						tipo_pessoa,
						acompanhado,
						amq_nome_01,
						amq_nome_02,
						amq_nome_03,
						amq_nome_04,
						amq_cpf_01,
						amq_cpf_02,
						amq_cpf_03,
						amq_cpf_04,
						amq_rg_01,
						amq_rg_02,
						amq_rg_03,
						amq_rg_04,
						amq_docest_01,
						amq_docest_02,
						amq_docest_03,
						amq_docest_04,
						amq_dtnasc_01,
						amq_dtnasc_02,
						amq_dtnasc_03,
						amq_dtnasc_04,
						pmq_nome_01,
						pmq_nome_02,
						pmq_nome_03,
						pmq_nome_04,
						pmq_cpf_01,
						pmq_cpf_02,
						pmq_cpf_03,
						pmq_cpf_04,
						pmq_rg_01,
						pmq_rg_02,
						pmq_rg_03,
						pmq_rg_04,
						pmq_docest_01,
						pmq_docest_02,
						pmq_docest_03,
						pmq_docest_04,
						pmq_dtnasc_01,
						pmq_dtnasc_02,
						pmq_dtnasc_03,
						pmq_dtnasc_04,
						empresa,
						grupo,
						cargo,
						telefone_internacional,	
						anotacoes,
						dsc_empresa_rsvp)	                                                                                                 
					VALUES 
						(".$this->Db->qstr($w_nome).",					              
						".$this->Db->qstr($w_hosp_cpf_participante).",  
						".$this->Db->qstr($w_part_passaporte).",        
						".$this->Db->qstr($w_part_rg).", 				           
						".$this->Db->qstr($w_part_dt_nasc).",		         
						".$this->Db->qstr($w_part_ddd_celular_01).",    
						".$this->Db->qstr($w_part_celeular_01).",		     
						".$this->Db->qstr($w_part_email).",			          
						".$this->Db->qstr($w_hosp_acompanhante).",	     
						".$this->Db->qstr($w_aqtd_mesquart).", 		       
						".$this->Db->qstr($w_hosp_part_acomp).",  	     
						".$this->Db->qstr($w_pqtd_mesquart).",		        
						".$this->Db->qstr($w_part_id_evento_publico).", 
						".$this->Db->qstr($w_publico).",				            
						".$this->Db->qstr($w_hosp_id_hotel).",		        
						".$this->Db->qstr($w_hotel_dsc).",			           
						".$this->Db->qstr($w_hosp_acomodacao).",        
						".$this->Db->qstr($w_acomodacao).",			          
						".$this->Db->qstr($w_hosp_categoria).",  		     
						".$this->Db->qstr($w_categoria).",			           
						".$this->Db->qstr($w_tra_numvoo_ida).",         
						".$this->Db->qstr($w_tra_cia_ida).",            
						".$this->Db->qstr($w_ciaida).",				             
						".$this->Db->qstr($w_hosp_dt_checkin).",		      					
						".$this->Db->qstr($w_tra_hr_saida_ida).",	      					
						".$this->Db->qstr($w_tra_numvoo_volta).",       
						".$this->Db->qstr($w_tra_cia_volta).",		        
						".$this->Db->qstr($w_ciavolta).",				           
						".$this->Db->qstr($w_hosp_dt_checkout).",   	   
						".$this->Db->qstr($w_tra_hr_saida_volta).",     
						".$this->Db->qstr($w_tra_hrtransout).",         
						".$this->Db->qstr($w_hosp_early_chkin).",       
						".$this->Db->qstr($w_hosp_late_chkout).",       
						".$this->Db->qstr($w_hosp_pagamentos).",        
						".$this->Db->qstr($w_pagtoDsc).",				           
						".$this->Db->qstr($w_hosp_observacoes).",		     
						".$this->Db->qstr($w_hosp_dsc_pacote).",        
						".$this->Db->qstr($w_hosp_id_evento).",         
						".$this->Db->qstr($w_eventoDsc).",           
						".$this->Db->qstr($vp_usuario).",				           
						".$this->Db->qstr($w_usurelDsc).",           
						".$this->Db->qstr($w_tra_tipotransfer).",
						".$this->Db->qstr($w_tipopess).",
						".$this->Db->qstr($w_acompanhado).",
						".$this->Db->qstr($w_acmq_nome_01).",
						".$this->Db->qstr($w_acmq_nome_02).",
						".$this->Db->qstr($w_acmq_nome_03).",
						".$this->Db->qstr($w_acmq_nome_04).",
						".$this->Db->qstr($w_acmq_cpf_01).",
						".$this->Db->qstr($w_acmq_cpf_02).",
						".$this->Db->qstr($w_acmq_cpf_03).",
						".$this->Db->qstr($w_acmq_cpf_04).",
						".$this->Db->qstr($w_acmq_rg_01).",
						".$this->Db->qstr($w_acmq_rg_02).",
						".$this->Db->qstr($w_acmq_rg_03).",
						".$this->Db->qstr($w_acmq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_acmq_dtnasc_01).",
						".$this->Db->qstr($w_acmq_dtnasc_02).",
						".$this->Db->qstr($w_acmq_dtnasc_03).",
						".$this->Db->qstr($w_acmq_dtnasc_04).",
						".$this->Db->qstr($w_pamq_nome_01).",	
						".$this->Db->qstr($w_pamq_nome_02).",	
						".$this->Db->qstr($w_pamq_nome_03).",	
						".$this->Db->qstr($w_pamq_nome_04).",
						".$this->Db->qstr($w_pamq_cpf_01).",
						".$this->Db->qstr($w_pamq_cpf_02).",
						".$this->Db->qstr($w_pamq_cpf_03).",
						".$this->Db->qstr($w_pamq_cpf_04).",
						".$this->Db->qstr($w_pamq_rg_01).",
						".$this->Db->qstr($w_pamq_rg_02).",
						".$this->Db->qstr($w_pamq_rg_03).",
						".$this->Db->qstr($w_pamq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_pamq_dtnasc_01).",
						".$this->Db->qstr($w_pamq_dtnasc_02).",
						".$this->Db->qstr($w_pamq_dtnasc_03).",
						".$this->Db->qstr($wW_pamq_dtnasc_04).",
						".$this->Db->qstr($w_empresa).",
						".$this->Db->qstr($w_grupo).",
						".$this->Db->qstr($w_cargo).",
						".$this->Db->qstr($w_foneinter).",
						".$this->Db->qstr($w_anotacao).",
						".$this->Db->qstr($w_dsc_emp_rsvp).")
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
						
					$ret = 'ADICIONA OK';                                                                                           
				}	
			}
			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}		                                                                                                               
		return $ret;
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function PrepRoom3($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  		
		
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';
		$valor_y = 'Y';			                                                                                        
		$valor_s = 'SIM';
		$valor_n = 'N';
		$valor_exclui = 'ANHANTE';
		
		$sqlMestre = "		
		SELECT
			hospedagem_rsvp.hosp_cpf_participante,
			hospedagem_rsvp.hosp_id_evento,			        
			hospedagem_rsvp.hosp_acompanhante,		        
			hospedagem_rsvp.hosp_part_acomp,     	        
			hospedagem_rsvp.hosp_id_hotel,			        
			hospedagem_rsvp.hosp_acomodacao,			    
			hospedagem_rsvp.hosp_categoria,  		        
			hospedagem_rsvp.hosp_dt_checkin,			    
			hospedagem_rsvp.hosp_dt_checkout,   		    
			hospedagem_rsvp.hosp_early_chkin,  		        
			hospedagem_rsvp.hosp_late_chkout, 		        
			hospedagem_rsvp.hosp_pagamentos, 		        
			hospedagem_rsvp.hosp_observacoes,		        
			hospedagem_rsvp.hosp_dsc_pacote, 				               
			hospedagem_rsvp.acmq_01,
			hospedagem_rsvp.acmq_02,
			hospedagem_rsvp.acmq_03,
			hospedagem_rsvp.acmq_04,
			hospedagem_rsvp.pamq_01,
			hospedagem_rsvp.pamq_02,
			hospedagem_rsvp.pamq_03,
			hospedagem_rsvp.pamq_04
		FROM
			hospedagem_rsvp
		WHERE
			hospedagem_rsvp.hosp_id_evento = ".$this->Db->qstr($vp_evento)."
		AND
			hospedagem_rsvp.hosp_ativo	= ".$this->Db->qstr($valor_y)." 
		AND 
			hospedagem_rsvp.hosp_status	= ".$this->Db->qstr($valor_y)."	
		AND
			hospedagem_rsvp.conta_roomlist= ".$this->Db->qstr($valor_s)."
		AND	
			hospedagem_rsvp.acmq_01 <> ".$this->Db->qstr($valor_exclui)."
		AND	
			hospedagem_rsvp.acmq_02 <> ".$this->Db->qstr($valor_exclui)."
		ORDER BY
			hospedagem_rsvp.hosp_cpf_participante			
		";
		$_passa_part = true;
		 
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
				$w_acmq_nome_01		= '';
				$w_acmq_cpf_01		= '';
				$w_acmq_dtnasc_01 	= '';
				$w_acmq_rg_01		= '';
				$w_acmq_docest_01	= '';
				$w_acmq_nome_02		= '';
				$w_acmq_cpf_02		= '';
				$w_acmq_rg_02		= '';
				$w_acmq_docest_02	= '';
				$w_acmq_dtnasc_02	= '';
				$w_acmq_nome_03		= '';
				$w_acmq_cpf_03		= '';
				$w_acmq_rg_03		= '';
				$w_acmq_docest_03	= '';
				$w_acmq_dtnasc_03	= '';
				$w_acmq_nome_04		= '';
				$w_acmq_cpf_04		= '';
				$w_acmq_rg_04		= '';
				$w_acmq_docest_04	= '';
				$w_acmq_dtnasc_04	= '';				
				
				$w_pamq_nome_01		= '';
				$w_pamq_cpf_01		= '';
				$w_pamq_dtnasc_01 	= '';
				$w_pamq_rg_01		= '';
				$w_pamq_docest_01	= '';
				$w_pamq_nome_02		= '';
				$w_pamq_cpf_02		= '';
				$w_pamq_rg_02		= '';
				$w_pamq_docest_02	= '';
				$w_pamq_dtnasc_02	= '';
				$w_pamq_nome_03		= '';
				$w_pamq_cpf_03		= '';
				$w_pamq_rg_03		= '';
				$w_pamq_docest_03	= '';
				$w_pamq_dtnasc_03	= '';
				$w_pamq_nome_04		= '';
				$w_pamq_cpf_04		= '';
				$w_pamq_rg_04		= '';
				$w_pamq_docest_04	= '';
				$w_pamq_dtnasc_04	= '';					
				
				$w_nome	= '';
				$w_part_passaporte = '';      	     				
				$w_part_rg = '';           
				$w_part_dt_nasc = '0000-00-00';   				       	
				$w_part_ddd_celular_01 = '';  	      				
				$w_part_celeular_01 = '';     	 
				$w_part_email = '';           					     
				$w_part_id_evento_publico = '';				
				$w_aqtd_mesquart = '0';   
				$w_pqtd_mesquart = '0';		            
				$w_publico = '';				                
				$w_hotel_dsc = '';			               
				$w_acomodacao = '';			              
				$w_categoria = '';			               
				$w_ciaida = '';			                 
				$w_ciavolta = '';				               
				$w_pagtoDsc = '';				               
				$w_eventoDsc = '';                  				
				$w_usurelDsc = '';                 
				$w_tipopess = '';                  
				$w_acompanhado = '';               
				 				
				$w_hosp_cpf_participante	= $this->rsm[$i][0];		     					                 
				$w_hosp_id_evento		    = $this->rsm[$i][1];               
				$w_hosp_acompanhante	    = $this->rsm[$i][2];            
				$w_hosp_part_acomp     	    = $this->rsm[$i][3];            
				$w_hosp_id_hotel		    = $this->rsm[$i][4];                  
				$w_hosp_acomodacao		 	= $this->rsm[$i][5];              
				$w_hosp_categoria  		    = $this->rsm[$i][6];              
				$w_hosp_dt_checkin		 	= $this->rsm[$i][7];            	   		
				$w_hosp_dt_checkout   	 	= $this->rsm[$i][8];           
				$w_hosp_early_chkin  	    = $this->rsm[$i][9];           
				$w_hosp_late_chkout 	    = $this->rsm[$i][10];           
				$w_hosp_pagamentos 		    = $this->rsm[$i][11];            
				$w_hosp_observacoes		    = $this->rsm[$i][12];             
				$w_hosp_dsc_pacote          = $this->rsm[$i][13];               
				$w_hosp_acmq_01				= $this->rsm[$i][14];	
				$w_hosp_acmq_02				= $this->rsm[$i][15];    
				$w_hosp_acmq_03				= $this->rsm[$i][16];    
				$w_hosp_acmq_04				= $this->rsm[$i][17];    
				$w_hosp_pamq_01				= $this->rsm[$i][18];    
				$w_hosp_pamq_02				= $this->rsm[$i][19];    
				$w_hosp_pamq_03				= $this->rsm[$i][20];    
				$w_hosp_pamq_04				= $this->rsm[$i][21];	  							
			
				$w_tra_numvoo_ida	        = '';	
				$w_tra_cia_ida   		    = '';	
				$w_tra_hr_saida_ida         = '';	
				$w_tra_numvoo_volta         = '';	
				$w_tra_cia_volta		    = '';	
				$w_tra_hr_saida_volta 	  	= '';   
				$w_tra_hrtransout		    = '';	
				$w_tra_tipotransfer			= '';   
				$f_tra_direcao				= '';	
				$f_tra_id_hotel				= '';   
				
				$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						nome_pessoa,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,						
						part_id_evento_publico,
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."	
					ORDER BY                                                                                                        
						part_cpf
				";
				 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspart[0][0])) {											
					$w_nome				   		= $this->rspart[0][0];			  	             
					$w_part_passaporte     		= $this->rspart[0][1];    	     
					$w_part_rg             		= $this->rspart[0][2];    	
					$w_part_dt_nasc        		= $this->rspart[0][3];  	
					$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
					$w_part_celeular_01      	= $this->rspart[0][5]; 
					$w_part_email            	= $this->rspart[0][6];    
					$w_part_id_evento_publico	= $this->rspart[0][7];   	
					$w_empresa					= $this->rspart[0][9]; 
					$w_grupo					= $this->rspart[0][10]; 
					$w_cargo					= $this->rspart[0][11]; 
					$w_tipopess = 'PARTICIPANTE';		
					$w_foneinter				= $this->rspart[0][12];
					$w_dsc_emp_rsvp				= $this->rspart[0][13];
				} else {
					$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						part_nome,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,	
						part_id_evento_publico					
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."		
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspart[0][0])) {											
						$w_nome				   		= $this->rspart[0][0];			  	             
						$w_part_passaporte     		= $this->rspart[0][1];    	     
						$w_part_rg             		= $this->rspart[0][2];    	
						$w_part_dt_nasc        		= $this->rspart[0][3];  	
						$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
						$w_part_celeular_01      	= $this->rspart[0][5]; 
						$w_part_email            	= $this->rspart[0][6];    
						$w_part_id_evento_publico	= $this->rspart[0][7]; 
						$w_empresa					= $this->rspart[0][9];
						$w_grupo					= $this->rspart[0][10]; 
						$w_cargo					= $this->rspart[0][11]; 
						$w_tipopess = 'ACOMPANHANTE';			
						$w_foneinter				= $this->rspart[0][12];
						$w_dsc_emp_rsvp				= $this->rspart[0][13];
					}	
				}	
				$foneok = is_null($w_foneinter);
				if ($foneok == true) {
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
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)."                                                                                 
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
				$sqlPgt = "								                                                                                             
				SELECT                                                                                                          
					COD_PAGAMENTOS,
					DES_PAGAMENTOS
				FROM                                                                                                            
					pagamentos_rsvp
				WHERE                                                                                                           
					COD_PAGAMENTOS = ".$this->Db->qstr($w_hosp_pagamentos)."                                                                                 
				ORDER BY                                                                                                        
					COD_PAGAMENTOS
				";		                                                                                                            
				 
      $nm_select = $sqlPgt; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspgt = false;
          $this->rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $this->rspgt[0][1];                                                                                  
				} else {                                                                                                        
					$w_pagtoDsc = "";				                                                                                         
				}		
				$sqlAco = "								                                                                                             
				SELECT                                                                                                          
					acomodacao_id,
					acomodacao_desc
				FROM                                                                                                            
					tbl_acomodacoes
				WHERE                                                                                                           
					acomodacao_id = ".$this->Db->qstr($w_hosp_acomodacao)."                                                                                 
				ORDER BY                                                                                                        
					acomodacao_id
				";		                                                                                                            
				 
      $nm_select = $sqlAco; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaco = false;
          $this->rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsaco[0][0])) {									                                                                            
					$w_acomodacao = $this->rsaco[0][1];                                                                                  
				} else {                                                                                                        
					$w_acomodacao = "";				                                                                                         
				}					
				$sqlCat = "								                                                                                             
				SELECT                                                                                                          
					acomod_id,
					acomod_dsc
				FROM                                                                                                            
					tbl_categ_acomod
				WHERE                                                                                                           
					acomod_id = ".$this->Db->qstr($w_hosp_categoria)."                                                                                 
				ORDER BY                                                                                                        
					acomod_id
				";		                                                                                                            
				 
      $nm_select = $sqlCat; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscat = false;
          $this->rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscat[0][0])) {									                                                                            
					$w_categoria = $this->rscat[0][1];                                                                                  
				} else {                                                                                                        
					$w_categoria = "";				                                                                                         
				}					
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($w_part_id_evento_publico)."                                                                                 
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
					hotel_id = ".$this->Db->qstr($w_hosp_id_hotel)."                                                                                 
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
					
				if ($w_hosp_early_chkin == 'Y') {
					$w_hosp_early_chkin = 'SIM';
				} else {
					$w_hosp_early_chkin = 'ABERTO';
				}
				if ($w_hosp_late_chkout == 'Y') {
					$w_hosp_late_chkout = 'SIM';
				} else {	
					$w_hosp_late_chkout = 'ABERTO';
				}					
				$sqlanot = "
				SELECT
					ant_evento_id,
					ant_cpf_participante,
					ant_dsc
				FROM
					anotacoes_rsvp
				WHERE
					ant_evento_id = ".$this->Db->qstr($vp_evento)." 
				AND
					ant_cpf_participante = ".$this->Db->qstr($w_hosp_cpf_participante)." 
				ORDER BY
					ant_evento_id, ant_cpf_participante					
				";
				 
      $nm_select = $sqlanot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsanot = false;
          $this->rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsanot[0][0])) {
					$w_anotacao = $this->rsanot[0][2];
				} else {
					$w_anotacao = '';
				}	
				
				$w_acompanhado = "";
				if ($w_tipopess == 'PARTICIPANTE') { 	 					
					$sqlAcm = "								                                                                                             
					SELECT                                                                                                          
					part_cpf,
					part_cpf_mestre,
					part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf,part_id_evento
					";		                                                                                                            
					 
      $nm_select = $sqlAcm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspacm = false;
          $this->rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $this->rspacm[0][1];                                                                                
						$sqlCPFm = "								                                                                                             
						SELECT                                                                                                          
							part_cpf,
							nome_pessoa,
							part_id_evento
						FROM                                                                                                            
							participantes_rsvp
						WHERE                                                                                                           
							part_cpf = ".$this->Db->qstr($w_cpf_mestre)."                                                                                 
						ORDER BY                                                                                                        
						part_cpf,part_id_evento
						";		                                                                                                            
						 
      $nm_select = $sqlCPFm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspcpf = false;
          $this->rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($this->rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $this->rspcpf[0][1]; 					
						} else {                                                                                                        
							$w_acompanhado = "";				                                                                                         
						}					
					}	
				}				
								
				if ($w_hosp_acmq_01 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_01		= $this->rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_acmq_rg_01		= $this->rsplhac[0][3];
						$w_acmq_docest_01	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_02 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_02		= $this->rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_acmq_rg_02		= $this->rsplhac[0][3];
						$w_acmq_docest_02	= $this->rsplhac[0][4];				
					}
				}
								
				if ($w_hosp_acmq_03 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_03		= $this->rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_acmq_rg_03		= $this->rsplhac[0][3];
						$w_acmq_docest_03	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_04 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_04		= $this->rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_acmq_rg_04		= $this->rsplhac[0][3];
						$w_acmq_docest_04	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_01	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_01		= $this->rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_pamq_rg_01		= $this->rsplhac[0][3];
						$w_pamq_docest_01	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_02	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_02		= $this->rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_02	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_03	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_03		= $this->rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_pamq_rg_03		= $this->rsplhac[0][3];
						$w_pamq_docest_03	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_04	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_04		= $this->rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_04	= $this->rsplhac[0][4];				
					}										
				}	
				$sqlnoinc = "								                                                                                             
				SELECT                                                                                                          
					cpf,						
					cod_evento
				FROM                                                                                                            
					roomlist_rsvp_r
				WHERE                                                                                                           
					cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
				AND 
					cod_evento = ".$this->Db->qstr($w_hosp_id_evento)."
				AND
					id_usuario_relato = ".$this->Db->qstr($vp_usuario)."	
				AND
					cod_hotel = ".$this->Db->qstr($w_hosp_id_hotel)."	
				ORDER BY                                                                                                        
					cpf
				";
				 
      $nm_select = $sqlnoinc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsnoinc = false;
          $this->rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsnoinc[0][0])) {															
					$inclui = 'N';
				} else {
					$inclui = 'S';
				}
				if ($inclui == 'S' && $w_nome <> '') {	
					$sqli = "
					INSERT INTO                                                                                                     
						roomlist_rsvp_r		                                                                                                
						(hospede,					
						cpf,					
						passaporte,			    
						RG,					    
						data_nasc,			    
						ddd_clelular,			
						celular,				
						e_mail,				    
						acom_mesmo_quarto,      
						aqtd_mesmo_quarto,	    
						part_mesmo_quarto,	    
						pqtd_mesmo_quarto,	    
						cod_publico,			
						publico_dsc,			
						cod_hotel,			    
						hotel_dsc,			    
						cod_acomodacao,		    
						acomodacao_dsc,		    
						cod_categoria,		    
						categoria_dsc,		    
						voo_ida,				
						cod_cia_ida,			
						cia_dsc_ida,			
						dt_checkin, 			
						hr_transferin,		    
						voo_volta,			    
						cod_cia_volta,		    
						cia_dsc_volta,		    
						dt_checkout,			
						hr_transferout,		    
						intervalo_trout,		
						early_checkin,		    
						late_checkout,		    
						cod_forma_pgto,		    
						forma_pgto,			    
						observacoes,			
						pacote_dsc,			    
						cod_evento,			    
						evento_dsc,			    
						id_usuario_relato,	    
						usuario_relato_dsc,	    
						tipo_transfer,
						tipo_pessoa,
						acompanhado,
						amq_nome_01,
						amq_nome_02,
						amq_nome_03,
						amq_nome_04,
						amq_cpf_01,
						amq_cpf_02,
						amq_cpf_03,
						amq_cpf_04,
						amq_rg_01,
						amq_rg_02,
						amq_rg_03,
						amq_rg_04,
						amq_docest_01,
						amq_docest_02,
						amq_docest_03,
						amq_docest_04,
						amq_dtnasc_01,
						amq_dtnasc_02,
						amq_dtnasc_03,
						amq_dtnasc_04,
						pmq_nome_01,
						pmq_nome_02,
						pmq_nome_03,
						pmq_nome_04,
						pmq_cpf_01,
						pmq_cpf_02,
						pmq_cpf_03,
						pmq_cpf_04,
						pmq_rg_01,
						pmq_rg_02,
						pmq_rg_03,
						pmq_rg_04,
						pmq_docest_01,
						pmq_docest_02,
						pmq_docest_03,
						pmq_docest_04,
						pmq_dtnasc_01,
						pmq_dtnasc_02,
						pmq_dtnasc_03,
						pmq_dtnasc_04,
						empresa,
						grupo,
						cargo,
						telefone_internacional,	
						anotacoes,
						dsc_empresa_rsvp)	                                                                                                 
					VALUES 
						(".$this->Db->qstr($w_nome).",					              
						".$this->Db->qstr($w_hosp_cpf_participante).",  
						".$this->Db->qstr($w_part_passaporte).",        
						".$this->Db->qstr($w_part_rg).", 				           
						".$this->Db->qstr($w_part_dt_nasc).",		         
						".$this->Db->qstr($w_part_ddd_celular_01).",    
						".$this->Db->qstr($w_part_celeular_01).",		     
						".$this->Db->qstr($w_part_email).",			          
						".$this->Db->qstr($w_hosp_acompanhante).",	     
						".$this->Db->qstr($w_aqtd_mesquart).", 		       
						".$this->Db->qstr($w_hosp_part_acomp).",  	     
						".$this->Db->qstr($w_pqtd_mesquart).",		        
						".$this->Db->qstr($w_part_id_evento_publico).", 
						".$this->Db->qstr($w_publico).",				            
						".$this->Db->qstr($w_hosp_id_hotel).",		        
						".$this->Db->qstr($w_hotel_dsc).",			           
						".$this->Db->qstr($w_hosp_acomodacao).",        
						".$this->Db->qstr($w_acomodacao).",			          
						".$this->Db->qstr($w_hosp_categoria).",  		     
						".$this->Db->qstr($w_categoria).",			           
						".$this->Db->qstr($w_tra_numvoo_ida).",         
						".$this->Db->qstr($w_tra_cia_ida).",            
						".$this->Db->qstr($w_ciaida).",				             
						".$this->Db->qstr($w_hosp_dt_checkin).",		      					
						".$this->Db->qstr($w_tra_hr_saida_ida).",	      					
						".$this->Db->qstr($w_tra_numvoo_volta).",       
						".$this->Db->qstr($w_tra_cia_volta).",		        
						".$this->Db->qstr($w_ciavolta).",				           
						".$this->Db->qstr($w_hosp_dt_checkout).",   	   
						".$this->Db->qstr($w_tra_hr_saida_volta).",     
						".$this->Db->qstr($w_tra_hrtransout).",         
						".$this->Db->qstr($w_hosp_early_chkin).",       
						".$this->Db->qstr($w_hosp_late_chkout).",       
						".$this->Db->qstr($w_hosp_pagamentos).",        
						".$this->Db->qstr($w_pagtoDsc).",				           
						".$this->Db->qstr($w_hosp_observacoes).",		     
						".$this->Db->qstr($w_hosp_dsc_pacote).",        
						".$this->Db->qstr($w_hosp_id_evento).",         
						".$this->Db->qstr($w_eventoDsc).",           
						".$this->Db->qstr($vp_usuario).",				           
						".$this->Db->qstr($w_usurelDsc).",           
						".$this->Db->qstr($w_tra_tipotransfer).",
						".$this->Db->qstr($w_tipopess).",
						".$this->Db->qstr($w_acompanhado).",
						".$this->Db->qstr($w_acmq_nome_01).",
						".$this->Db->qstr($w_acmq_nome_02).",
						".$this->Db->qstr($w_acmq_nome_03).",
						".$this->Db->qstr($w_acmq_nome_04).",
						".$this->Db->qstr($w_acmq_cpf_01).",
						".$this->Db->qstr($w_acmq_cpf_02).",
						".$this->Db->qstr($w_acmq_cpf_03).",
						".$this->Db->qstr($w_acmq_cpf_04).",
						".$this->Db->qstr($w_acmq_rg_01).",
						".$this->Db->qstr($w_acmq_rg_02).",
						".$this->Db->qstr($w_acmq_rg_03).",
						".$this->Db->qstr($w_acmq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_acmq_dtnasc_01).",
						".$this->Db->qstr($w_acmq_dtnasc_02).",
						".$this->Db->qstr($w_acmq_dtnasc_03).",
						".$this->Db->qstr($w_acmq_dtnasc_04).",
						".$this->Db->qstr($w_pamq_nome_01).",	
						".$this->Db->qstr($w_pamq_nome_02).",	
						".$this->Db->qstr($w_pamq_nome_03).",	
						".$this->Db->qstr($w_pamq_nome_04).",
						".$this->Db->qstr($w_pamq_cpf_01).",
						".$this->Db->qstr($w_pamq_cpf_02).",
						".$this->Db->qstr($w_pamq_cpf_03).",
						".$this->Db->qstr($w_pamq_cpf_04).",
						".$this->Db->qstr($w_pamq_rg_01).",
						".$this->Db->qstr($w_pamq_rg_02).",
						".$this->Db->qstr($w_pamq_rg_03).",
						".$this->Db->qstr($w_pamq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_pamq_dtnasc_01).",
						".$this->Db->qstr($w_pamq_dtnasc_02).",
						".$this->Db->qstr($w_pamq_dtnasc_03).",
						".$this->Db->qstr($w_pamq_dtnasc_04).",	
						".$this->Db->qstr($w_empresa).",
						".$this->Db->qstr($w_grupo).",
						".$this->Db->qstr($w_cargo).",
						".$this->Db->qstr($w_foneinter).",
						".$this->Db->qstr($w_anotacao).",
						".$this->Db->qstr($w_dsc_emp_rsvp).")
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
					
					$ret = 'ADICIONA OK';                                                                                           
				}	
			}
			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}		                                                                                                               
		return $ret;
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function RetNivelUpd($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_rm']['contr_erro'] = 'off';
}

}

?>
