<?php

class grid_aereos_rsvp_1_rtf
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
                   nm_limpa_str_grid_aereos_rsvp_1($cadapar[1]);
                   nm_protect_num_grid_aereos_rsvp_1($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_aereos_rsvp_1']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $vg_cpf;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_cpf"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["rsvp_global"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_usuario_id"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_cpfseg"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["parm1"]);
      }
      if (isset($vg_usunivel)) 
      {
          $_SESSION['vg_usunivel'] = $vg_usunivel;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_usunivel"]);
      }
      if (isset($vg_usuario_nivel)) 
      {
          $_SESSION['vg_usuario_nivel'] = $vg_usuario_nivel;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_usuario_nivel"]);
      }
      if (isset($vg_tipo_pessoa)) 
      {
          $_SESSION['vg_tipo_pessoa'] = $vg_tipo_pessoa;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_tipo_pessoa"]);
      }
      if (isset($vg_matriz_trechos)) 
      {
          $_SESSION['vg_matriz_trechos'] = $vg_matriz_trechos;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_matriz_trechos"]);
      }
      if (isset($vg_sebloqueio)) 
      {
          $_SESSION['vg_sebloqueio'] = $vg_sebloqueio;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_sebloqueio"]);
      }
      if (isset($vg_bloqueio_id)) 
      {
          $_SESSION['vg_bloqueio_id'] = $vg_bloqueio_id;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_bloqueio_id"]);
      }
      if (isset($vg_matriz_trunico)) 
      {
          $_SESSION['vg_matriz_trunico'] = $vg_matriz_trunico;
          nm_limpa_str_grid_aereos_rsvp_1($_SESSION["vg_matriz_trunico"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_aereos_rsvp_1_total.class.php"); 
      $this->Tot      = new grid_aereos_rsvp_1_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_aereos_rsvp_1']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_aereos_rsvp_1";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_aereos_rsvp_1.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_aereos_rsvp_1']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_aereos_rsvp_1']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_aereos_rsvp_1']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->id_aereo = (isset($Busca_temp['id_aereo'])) ? $Busca_temp['id_aereo'] : ""; 
          $tmp_pos = (is_string($this->id_aereo)) ? strpos($this->id_aereo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->id_aereo))
          {
              $this->id_aereo = substr($this->id_aereo, 0, $tmp_pos);
          }
          $this->aereo_id_evento = (isset($Busca_temp['aereo_id_evento'])) ? $Busca_temp['aereo_id_evento'] : ""; 
          $tmp_pos = (is_string($this->aereo_id_evento)) ? strpos($this->aereo_id_evento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_id_evento))
          {
              $this->aereo_id_evento = substr($this->aereo_id_evento, 0, $tmp_pos);
          }
          $this->aereo_cpf_particip = (isset($Busca_temp['aereo_cpf_particip'])) ? $Busca_temp['aereo_cpf_particip'] : ""; 
          $tmp_pos = (is_string($this->aereo_cpf_particip)) ? strpos($this->aereo_cpf_particip, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_cpf_particip))
          {
              $this->aereo_cpf_particip = substr($this->aereo_cpf_particip, 0, $tmp_pos);
          }
          $this->aereo_status = (isset($Busca_temp['aereo_status'])) ? $Busca_temp['aereo_status'] : ""; 
          $tmp_pos = (is_string($this->aereo_status)) ? strpos($this->aereo_status, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_status))
          {
              $this->aereo_status = substr($this->aereo_status, 0, $tmp_pos);
          }
          $this->aereo_cia_aerea = (isset($Busca_temp['aereo_cia_aerea'])) ? $Busca_temp['aereo_cia_aerea'] : ""; 
          $tmp_pos = (is_string($this->aereo_cia_aerea)) ? strpos($this->aereo_cia_aerea, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_cia_aerea))
          {
              $this->aereo_cia_aerea = substr($this->aereo_cia_aerea, 0, $tmp_pos);
          }
          $this->aereo_num_voo = (isset($Busca_temp['aereo_num_voo'])) ? $Busca_temp['aereo_num_voo'] : ""; 
          $tmp_pos = (is_string($this->aereo_num_voo)) ? strpos($this->aereo_num_voo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_num_voo))
          {
              $this->aereo_num_voo = substr($this->aereo_num_voo, 0, $tmp_pos);
          }
          $this->aereo_origem = (isset($Busca_temp['aereo_origem'])) ? $Busca_temp['aereo_origem'] : ""; 
          $tmp_pos = (is_string($this->aereo_origem)) ? strpos($this->aereo_origem, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_origem))
          {
              $this->aereo_origem = substr($this->aereo_origem, 0, $tmp_pos);
          }
          $this->aereo_destino = (isset($Busca_temp['aereo_destino'])) ? $Busca_temp['aereo_destino'] : ""; 
          $tmp_pos = (is_string($this->aereo_destino)) ? strpos($this->aereo_destino, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_destino))
          {
              $this->aereo_destino = substr($this->aereo_destino, 0, $tmp_pos);
          }
          $this->aereo_direcao = (isset($Busca_temp['aereo_direcao'])) ? $Busca_temp['aereo_direcao'] : ""; 
          $tmp_pos = (is_string($this->aereo_direcao)) ? strpos($this->aereo_direcao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_direcao))
          {
              $this->aereo_direcao = substr($this->aereo_direcao, 0, $tmp_pos);
          }
          $this->aereo_dt_saida = (isset($Busca_temp['aereo_dt_saida'])) ? $Busca_temp['aereo_dt_saida'] : ""; 
          $tmp_pos = (is_string($this->aereo_dt_saida)) ? strpos($this->aereo_dt_saida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_dt_saida))
          {
              $this->aereo_dt_saida = substr($this->aereo_dt_saida, 0, $tmp_pos);
          }
          $this->aereo_dt_saida_2 = (isset($Busca_temp['aereo_dt_saida_input_2'])) ? $Busca_temp['aereo_dt_saida_input_2'] : ""; 
          $this->aereo_dt_chegada = (isset($Busca_temp['aereo_dt_chegada'])) ? $Busca_temp['aereo_dt_chegada'] : ""; 
          $tmp_pos = (is_string($this->aereo_dt_chegada)) ? strpos($this->aereo_dt_chegada, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_dt_chegada))
          {
              $this->aereo_dt_chegada = substr($this->aereo_dt_chegada, 0, $tmp_pos);
          }
          $this->aereo_dt_chegada_2 = (isset($Busca_temp['aereo_dt_chegada_input_2'])) ? $Busca_temp['aereo_dt_chegada_input_2'] : ""; 
          $this->aereo_localizador = (isset($Busca_temp['aereo_localizador'])) ? $Busca_temp['aereo_localizador'] : ""; 
          $tmp_pos = (is_string($this->aereo_localizador)) ? strpos($this->aereo_localizador, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_localizador))
          {
              $this->aereo_localizador = substr($this->aereo_localizador, 0, $tmp_pos);
          }
          $this->aereo_eticket = (isset($Busca_temp['aereo_eticket'])) ? $Busca_temp['aereo_eticket'] : ""; 
          $tmp_pos = (is_string($this->aereo_eticket)) ? strpos($this->aereo_eticket, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_eticket))
          {
              $this->aereo_eticket = substr($this->aereo_eticket, 0, $tmp_pos);
          }
          $this->aereo_bloqueio_id = (isset($Busca_temp['aereo_bloqueio_id'])) ? $Busca_temp['aereo_bloqueio_id'] : ""; 
          $tmp_pos = (is_string($this->aereo_bloqueio_id)) ? strpos($this->aereo_bloqueio_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_bloqueio_id))
          {
              $this->aereo_bloqueio_id = substr($this->aereo_bloqueio_id, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_matriz_trechos'])) {$_SESSION['vg_matriz_trechos'] = "";}
if (!isset($this->sc_temp_vg_matriz_trechos)) {$this->sc_temp_vg_matriz_trechos = (isset($_SESSION['vg_matriz_trechos'])) ? $_SESSION['vg_matriz_trechos'] : "";}
if (!isset($_SESSION['vg_tipo_pessoa'])) {$_SESSION['vg_tipo_pessoa'] = "";}
if (!isset($this->sc_temp_vg_tipo_pessoa)) {$this->sc_temp_vg_tipo_pessoa = (isset($_SESSION['vg_tipo_pessoa'])) ? $_SESSION['vg_tipo_pessoa'] : "";}
if (!isset($_SESSION['vg_cpf'])) {$_SESSION['vg_cpf'] = "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
if (!isset($_SESSION['vg_usuario_nivel'])) {$_SESSION['vg_usuario_nivel'] = "";}
if (!isset($this->sc_temp_vg_usuario_nivel)) {$this->sc_temp_vg_usuario_nivel = (isset($_SESSION['vg_usuario_nivel'])) ? $_SESSION['vg_usuario_nivel'] : "";}
if (!isset($_SESSION['vg_usunivel'])) {$_SESSION['vg_usunivel'] = "";}
if (!isset($this->sc_temp_vg_usunivel)) {$this->sc_temp_vg_usunivel = (isset($_SESSION['vg_usunivel'])) ? $_SESSION['vg_usunivel'] : "";}
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

$valor_y = 'Y';
$this->usuario_nivel  = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
$this->RetNivel($this->usuario_nivel );
$this->sc_temp_vg_usunivel = $usunivel;

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
 if (isset($this->sc_temp_vg_usunivel)) {$_SESSION['vg_usunivel'] = $this->sc_temp_vg_usunivel;}
 if (isset($this->sc_temp_vg_usuario_nivel)) {$_SESSION['vg_usuario_nivel'] = $this->sc_temp_vg_usuario_nivel;}
 if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
 if (isset($this->sc_temp_vg_tipo_pessoa)) {$_SESSION['vg_tipo_pessoa'] = $this->sc_temp_vg_tipo_pessoa;}
 if (isset($this->sc_temp_vg_matriz_trechos)) {$_SESSION['vg_matriz_trechos'] = $this->sc_temp_vg_matriz_trechos;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_aereos_rsvp_1";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['sc_outra_jan'] = false;
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
        action="grid_aereos_rsvp_1_fim.php"
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
$this->sc_temp_vg_usuario_nivel = $this->usuario_nivel ;

$bloqueio = 0;
$this->aereo_id_evento  = $this->sc_temp_vg_evento_id;
$this->aereo_cpf_particip  = $this->sc_temp_vg_cpf;
$this->aereo_tipo_pessoa  = $this->sc_temp_vg_tipo_pessoa;

$sql="
SELECT 
	pessoa_cpf,pessoa_nome 
FROM 
	pessoas_rsvp 
WHERE 
	pessoa_cpf = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
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
	if ($this->aereo_tipo_pessoa  == "P") {
		$this->cabecalho  = 'AÉREO PARTICIPANTE: '.$this->rs[0][0].' - '.$this->rs[0][1].'  -  EVENTO: '.$this->sc_temp_vg_evento_id; 
		$tipo_pessoa  = 'PARTICIPANTE';
		echo '<h3>&emsp;RSVP - Aéreo Participante</h3>';	
	} else {
		$this->cabecalho  = 'AÉREO ACOMPANHANTE: '.$this->rs[0][0].' - '.$this->rs[0][1].'  -  EVENTO: '.$this->sc_temp_vg_evento_id; 
		$tipo_pessoa  = 'ACOMPANHANTE';
		echo '<h3>&emsp;RSVP - Aéreo Acompanhante</h3>';	
	}
} else {
	$this->cabecalho  = '';		
}




$sql = "
	SELECT
		id_aereo
	FROM
		aereos_rsvp
	WHERE
		aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		aereo_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND
		aereo_ativo = ".$this->Db->qstr($valor_y)."	
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
	                                                                                      
$tam_matriz = sizeof($this->rs );	
$this->sc_temp_vg_matriz_trechos = array();
if ($tam_matriz > 0) {	
	for ($i=0;$i<$tam_matriz;++$i) {
		$this->sc_temp_vg_matriz_trechos[] = $this->rs[$i][0];
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
if (isset($this->sc_temp_vg_usunivel)) {$_SESSION['vg_usunivel'] = $this->sc_temp_vg_usunivel;}
if (isset($this->sc_temp_vg_usuario_nivel)) {$_SESSION['vg_usuario_nivel'] = $this->sc_temp_vg_usuario_nivel;}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_tipo_pessoa)) {$_SESSION['vg_tipo_pessoa'] = $this->sc_temp_vg_tipo_pessoa;}
if (isset($this->sc_temp_vg_matriz_trechos)) {$_SESSION['vg_matriz_trechos'] = $this->sc_temp_vg_matriz_trechos;}
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_aereo'])) ? $this->New_label['id_aereo'] : "Cód."; 
          if ($Cada_col == "id_aereo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_direcao'])) ? $this->New_label['aereo_direcao'] : "Direção"; 
          if ($Cada_col == "aereo_direcao" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ida'])) ? $this->New_label['ida'] : "D"; 
          if ($Cada_col == "ida" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['volta'])) ? $this->New_label['volta'] : "D"; 
          if ($Cada_col == "volta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_cia_aerea'])) ? $this->New_label['aereo_cia_aerea'] : "Cia. Aérea"; 
          if ($Cada_col == "aereo_cia_aerea" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_dt_saida'])) ? $this->New_label['aereo_dt_saida'] : "Saída"; 
          if ($Cada_col == "aereo_dt_saida" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_hr_saida'])) ? $this->New_label['aereo_hr_saida'] : "Hr."; 
          if ($Cada_col == "aereo_hr_saida" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_dt_chegada'])) ? $this->New_label['aereo_dt_chegada'] : "Chegada"; 
          if ($Cada_col == "aereo_dt_chegada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_hr_chegada'])) ? $this->New_label['aereo_hr_chegada'] : "Hr. "; 
          if ($Cada_col == "aereo_hr_chegada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_num_voo'])) ? $this->New_label['aereo_num_voo'] : " Voo"; 
          if ($Cada_col == "aereo_num_voo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_origem'])) ? $this->New_label['aereo_origem'] : "Origem"; 
          if ($Cada_col == "aereo_origem" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_destino'])) ? $this->New_label['aereo_destino'] : "Destino"; 
          if ($Cada_col == "aereo_destino" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_gray'])) ? $this->New_label['aereo_gray'] : "Status"; 
          if ($Cada_col == "aereo_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_yellow'])) ? $this->New_label['aereo_yellow'] : "Status"; 
          if ($Cada_col == "aereo_yellow" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_green'])) ? $this->New_label['aereo_green'] : "Status"; 
          if ($Cada_col == "aereo_green" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_red'])) ? $this->New_label['aereo_red'] : "Status"; 
          if ($Cada_col == "aereo_red" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_id_usuario'])) ? $this->New_label['aereo_id_usuario'] : "Atendente"; 
          if ($Cada_col == "aereo_id_usuario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_bloqueio_id'])) ? $this->New_label['aereo_bloqueio_id'] : "Cód. Bloq."; 
          if ($Cada_col == "aereo_bloqueio_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nome_bloqueio'])) ? $this->New_label['nome_bloqueio'] : "Bloqueio"; 
          if ($Cada_col == "nome_bloqueio" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['lugares_restantes'])) ? $this->New_label['lugares_restantes'] : "Lugares Restantes"; 
          if ($Cada_col == "lugares_restantes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_transfer_tipo'])) ? $this->New_label['aereo_transfer_tipo'] : "Transfer Tipo"; 
          if ($Cada_col == "aereo_transfer_tipo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_emitida_bvt'])) ? $this->New_label['aereo_emitida_bvt'] : " Emitida Bvt"; 
          if ($Cada_col == "aereo_emitida_bvt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_id_evento'])) ? $this->New_label['aereo_id_evento'] : "Aereo Id Evento"; 
          if ($Cada_col == "aereo_id_evento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_trecho'])) ? $this->New_label['aereo_trecho'] : "Trecho"; 
          if ($Cada_col == "aereo_trecho" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['copia_aereo'])) ? $this->New_label['copia_aereo'] : "Copiar Para"; 
          if ($Cada_col == "copia_aereo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_cpf_particip'])) ? $this->New_label['aereo_cpf_particip'] : "ID Part."; 
          if ($Cada_col == "aereo_cpf_particip" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_tipo_pessoa'])) ? $this->New_label['aereo_tipo_pessoa'] : "Aereo Tipo Pessoa"; 
          if ($Cada_col == "aereo_tipo_pessoa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_status'])) ? $this->New_label['aereo_status'] : "Aereo Status"; 
          if ($Cada_col == "aereo_status" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT id_aereo, aereo_direcao, aereo_cia_aerea, str_replace (convert(char(10),aereo_dt_saida,102), '.', '-') + ' ' + convert(char(8),aereo_dt_saida,20), str_replace (convert(char(10),aereo_hr_saida,102), '.', '-') + ' ' + convert(char(8),aereo_hr_saida,20), str_replace (convert(char(10),aereo_dt_chegada,102), '.', '-') + ' ' + convert(char(8),aereo_dt_chegada,20), str_replace (convert(char(10),aereo_hr_chegada,102), '.', '-') + ' ' + convert(char(8),aereo_hr_chegada,20), aereo_num_voo, aereo_origem, aereo_destino, aereo_id_usuario, aereo_bloqueio_id, aereo_transfer_tipo, aereo_emitida_bvt, aereo_id_evento, aereo_trecho, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_ativo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT id_aereo, aereo_direcao, aereo_cia_aerea, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_num_voo, aereo_origem, aereo_destino, aereo_id_usuario, aereo_bloqueio_id, aereo_transfer_tipo, aereo_emitida_bvt, aereo_id_evento, aereo_trecho, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_ativo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT id_aereo, aereo_direcao, aereo_cia_aerea, convert(char(23),aereo_dt_saida,121), convert(char(23),aereo_hr_saida,121), convert(char(23),aereo_dt_chegada,121), convert(char(23),aereo_hr_chegada,121), aereo_num_voo, aereo_origem, aereo_destino, aereo_id_usuario, aereo_bloqueio_id, aereo_transfer_tipo, aereo_emitida_bvt, aereo_id_evento, aereo_trecho, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_ativo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT id_aereo, aereo_direcao, aereo_cia_aerea, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_num_voo, aereo_origem, aereo_destino, aereo_id_usuario, aereo_bloqueio_id, aereo_transfer_tipo, aereo_emitida_bvt, aereo_id_evento, aereo_trecho, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_ativo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT id_aereo, aereo_direcao, aereo_cia_aerea, EXTEND(aereo_dt_saida, YEAR TO DAY), aereo_hr_saida, EXTEND(aereo_dt_chegada, YEAR TO DAY), aereo_hr_chegada, aereo_num_voo, aereo_origem, aereo_destino, aereo_id_usuario, aereo_bloqueio_id, aereo_transfer_tipo, aereo_emitida_bvt, aereo_id_evento, aereo_trecho, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_ativo from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_aereo, aereo_direcao, aereo_cia_aerea, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_num_voo, aereo_origem, aereo_destino, aereo_id_usuario, aereo_bloqueio_id, aereo_transfer_tipo, aereo_emitida_bvt, aereo_id_evento, aereo_trecho, aereo_cpf_particip, aereo_tipo_pessoa, aereo_status, aereo_ativo from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['order_grid'];
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
         $this->id_aereo = $rs->fields[0] ;  
         $this->id_aereo = (string)$this->id_aereo;
         $this->aereo_direcao = $rs->fields[1] ;  
         $this->aereo_cia_aerea = $rs->fields[2] ;  
         $this->aereo_cia_aerea = (string)$this->aereo_cia_aerea;
         $this->aereo_dt_saida = $rs->fields[3] ;  
         $this->aereo_hr_saida = $rs->fields[4] ;  
         $this->aereo_dt_chegada = $rs->fields[5] ;  
         $this->aereo_hr_chegada = $rs->fields[6] ;  
         $this->aereo_num_voo = $rs->fields[7] ;  
         $this->aereo_origem = $rs->fields[8] ;  
         $this->aereo_destino = $rs->fields[9] ;  
         $this->aereo_id_usuario = $rs->fields[10] ;  
         $this->aereo_id_usuario = (string)$this->aereo_id_usuario;
         $this->aereo_bloqueio_id = $rs->fields[11] ;  
         $this->aereo_bloqueio_id = (string)$this->aereo_bloqueio_id;
         $this->aereo_transfer_tipo = $rs->fields[12] ;  
         $this->aereo_emitida_bvt = $rs->fields[13] ;  
         $this->aereo_id_evento = $rs->fields[14] ;  
         $this->aereo_id_evento = (string)$this->aereo_id_evento;
         $this->aereo_trecho = $rs->fields[15] ;  
         $this->aereo_trecho = (string)$this->aereo_trecho;
         $this->aereo_cpf_particip = $rs->fields[16] ;  
         $this->aereo_tipo_pessoa = $rs->fields[17] ;  
         $this->aereo_status = $rs->fields[18] ;  
         $this->aereo_ativo = $rs->fields[19] ;  
         //----- lookup - aereo_cia_aerea
         $this->look_aereo_cia_aerea = $this->aereo_cia_aerea; 
         $this->Lookup->lookup_aereo_cia_aerea($this->look_aereo_cia_aerea, $this->aereo_cia_aerea) ; 
         $this->look_aereo_cia_aerea = ($this->look_aereo_cia_aerea == "&nbsp;") ? "" : $this->look_aereo_cia_aerea; 
         //----- lookup - aereo_origem
         $this->look_aereo_origem = $this->aereo_origem; 
         $this->Lookup->lookup_aereo_origem($this->look_aereo_origem, $this->aereo_origem) ; 
         $this->look_aereo_origem = ($this->look_aereo_origem == "&nbsp;") ? "" : $this->look_aereo_origem; 
         //----- lookup - aereo_destino
         $this->look_aereo_destino = $this->aereo_destino; 
         $this->Lookup->lookup_aereo_destino($this->look_aereo_destino, $this->aereo_destino) ; 
         $this->look_aereo_destino = ($this->look_aereo_destino == "&nbsp;") ? "" : $this->look_aereo_destino; 
         //----- lookup - aereo_id_usuario
         $this->look_aereo_id_usuario = $this->aereo_id_usuario; 
         $this->Lookup->lookup_aereo_id_usuario($this->look_aereo_id_usuario, $this->aereo_id_usuario) ; 
         $this->look_aereo_id_usuario = ($this->look_aereo_id_usuario == "&nbsp;") ? "" : $this->look_aereo_id_usuario; 
         //----- lookup - aereo_emitida_bvt
         $this->look_aereo_emitida_bvt = $this->aereo_emitida_bvt; 
         $this->Lookup->lookup_aereo_emitida_bvt($this->look_aereo_emitida_bvt); 
         $this->look_aereo_emitida_bvt = ($this->look_aereo_emitida_bvt == "&nbsp;") ? "" : $this->look_aereo_emitida_bvt; 
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['vg_cpf'])) {$_SESSION['vg_cpf'] = "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
if (!isset($_SESSION['vg_usuario_nivel'])) {$_SESSION['vg_usuario_nivel'] = "";}
if (!isset($this->sc_temp_vg_usuario_nivel)) {$this->sc_temp_vg_usuario_nivel = (isset($_SESSION['vg_usuario_nivel'])) ? $_SESSION['vg_usuario_nivel'] : "";}
if (!isset($_SESSION['vg_matriz_trunico'])) {$_SESSION['vg_matriz_trunico'] = "";}
if (!isset($this->sc_temp_vg_matriz_trunico)) {$this->sc_temp_vg_matriz_trunico = (isset($_SESSION['vg_matriz_trunico'])) ? $_SESSION['vg_matriz_trunico'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$this->MakeColor($this->aereo_id_evento ,$this->aereo_cpf_particip ,'I');

$valor_zero = '0';
$this->sc_temp_vg_matriz_trunico = array();


$this->NM_cmp_hidden["aereo_trecho"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_trecho"] = 'off'; }
$this->NM_cmp_hidden["aereo_bloqueio_id"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_bloqueio_id"] = 'off'; }
$this->NM_cmp_hidden["aereo_id_evento"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_id_evento"] = 'off'; }
if ($this->aereo_bloqueio_id  == '0') {
}

$direcao = $this->aereo_direcao ;
$status = $this->aereo_status ;

if ($this->sc_temp_vg_usuario_nivel    == 'CONVIDADO') {
	$this->NM_cmp_hidden["copia_aereo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["copia_aereo"] = 'off'; }		
	$this->nmgp_botoes["copiar_trechos"] = 'off';;
	$_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_copy']['update'] = 'off';
	$_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_copy']['insert'] = 'off';
	$_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho']['update'] = 'off';
	$_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_ctrecho']['insert'] = 'off';		
}	


if ($this->aereo_bloqueio_id  <> '0') {
	$this->NM_cmp_hidden["copia_aereo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["copia_aereo"] = 'off'; }		
	$_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_copy']['update'] = 'off';
	$_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_copy']['insert'] = 'off';
} else {
	$this->NM_cmp_hidden["copia_aereo"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["copia_aereo"] = 'on'; }		
	$_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_copy']['update'] = 'on';
	$_SESSION['scriptcase']['sc_apl_conf']['form_aereos_rsvp_copy']['insert'] = 'on';
}	


if ($direcao == 'IDA') {
	$this->NM_cmp_hidden["volta"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["volta"] = 'off'; }	
	$this->NM_cmp_hidden["ida"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["ida"] = 'on'; }	
} else {
	$this->NM_cmp_hidden["volta"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["volta"] = 'on'; }	
	$this->NM_cmp_hidden["ida"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["ida"] = 'off'; }	
}

switch($status) {
	case 'A':
		$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'on'; }		
		$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
		$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
		$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
		break;
	case 'P':
		$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'off'; }		
		$this->NM_cmp_hidden["aereo_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'on'; }					
		$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
		$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
		break;		
	case 'Y':
		$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'off'; }		
		$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
		$this->NM_cmp_hidden["aereo_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_green"] = 'on'; }		
		$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
		break;				
	case 'N':
		$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'off'; }		
		$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
		$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
		$this->NM_cmp_hidden["aereo_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['php_cmp_sel']["aereo_red"] = 'on'; }					
		break;				
}	

$salta_ativo = $this->aereo_ativo  ;
if ($salta_ativo <> 'Y') {
	$campo_1 = 'part_cpf';
	$campo_2 = 'part_id_evento';
	$campo_3 = 'part_ativo';
	if ($this->aereo_tipo_pessoa  == 'A') {
		$tabela = 'acompanhantes_rsvp';
	} else {
		$tabela = 'participantes_rsvp';
	}	
	$cpf = $this->sc_temp_vg_cpf;
	$evt = $this->sc_temp_vg_evento_id;
	$order = 'part_cpf, part_id_evento';
	$this->aereo_ativo  = $this->GetPresAtiva($campo_1,$campo_2,$campo_3,$tabela,$cpf,$evt,$order);
	if ($this->aereo_ativo  == 'Y') {
		$this->NM_field_style["id_aereo"] = "background-color:#cde4cd;font-size:bold;"; 	
	} else {
		$this->NM_field_style["id_aereo"] = "background-color:#ffbbba;font-size:bold;";
	}
} else {
	$this->NM_field_style["id_aereo"] = "background-color:#cde4cd;font-size:bold;";
}	

if ($this->aereo_bloqueio_id  <> '0') {
	$this->GetSaldoBloq($this->sc_temp_vg_evento_id,$this->aereo_direcao );
	$sqlk = "
	SELECT 
		bloqueio_id,
		bloq_saldo_lugares,
		bloq_descricao,
		bloq_evento_id
	FROM 
		bloqueio_aereo_rsvp 
	WHERE 
		bloqueio_id = ".$this->Db->qstr($this->aereo_bloqueio_id )."	
	AND
		bloq_evento_id  = ".$this->Db->qstr($this->aereo_id_evento )."	
	ORDER BY 
		bloqueio_id
	";	
	 
      $nm_select = $sqlk; 
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
		$this->lugares_restantes  = $this->rs[0][1];
		$this->nome_bloqueio  = $this->rs[0][2];
	} else {
		$this->lugares_restantes  = 'ERRO';
		$this->nome_bloqueio  = 'ERRO';
	}	
} else {
	$this->lugares_restantes  = 'Sem Bloqueio';
	$this->nome_bloqueio  = 'Sem Bloqueio';
}	

date_default_timezone_set('America/Sao_Paulo');

$_novadata_saida = $this->aereo_dt_saida .' '.$this->aereo_hr_saida ;
$_novadata_chegada = $this->aereo_dt_chegada .' '.$this->aereo_hr_chegada ;

$sqlac = "
UPDATE
	aereos_rsvp
SET
	aereo_dthr_saida = '".$_novadata_saida."',
	aereo_dthr_chegada = '".$_novadata_chegada."'
WHERE
	aereo_id_evento = ".$this->Db->qstr($this->aereo_id_evento )."
AND
	id_origem_gate <> ".$this->Db->qstr($valor_zero)."
AND
	id_aereo = ".$this->Db->qstr($this->id_aereo )."
";

     $nm_select = $sqlac; 
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


if ($this->aereo_bloqueio_id  <> '0') {
}
if (isset($this->sc_temp_vg_matriz_trunico)) {$_SESSION['vg_matriz_trunico'] = $this->sc_temp_vg_matriz_trunico;}
if (isset($this->sc_temp_vg_usuario_nivel)) {$_SESSION['vg_usuario_nivel'] = $this->sc_temp_vg_usuario_nivel;}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- id_aereo
   function NM_export_id_aereo()
   {
             nmgp_Form_Num_Val($this->id_aereo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->id_aereo = NM_charset_to_utf8($this->id_aereo);
         $this->id_aereo = str_replace('<', '&lt;', $this->id_aereo);
         $this->id_aereo = str_replace('>', '&gt;', $this->id_aereo);
         $this->Texto_tag .= "<td>" . $this->id_aereo . "</td>\r\n";
   }
   //----- aereo_direcao
   function NM_export_aereo_direcao()
   {
         $this->aereo_direcao = html_entity_decode($this->aereo_direcao, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->aereo_direcao = strip_tags($this->aereo_direcao);
         $this->aereo_direcao = NM_charset_to_utf8($this->aereo_direcao);
         $this->aereo_direcao = str_replace('<', '&lt;', $this->aereo_direcao);
         $this->aereo_direcao = str_replace('>', '&gt;', $this->aereo_direcao);
         $this->Texto_tag .= "<td>" . $this->aereo_direcao . "</td>\r\n";
   }
   //----- ida
   function NM_export_ida()
   {
         $this->ida = NM_charset_to_utf8($this->ida);
         $this->ida = str_replace('<', '&lt;', $this->ida);
         $this->ida = str_replace('>', '&gt;', $this->ida);
         $this->Texto_tag .= "<td>" . $this->ida . "</td>\r\n";
   }
   //----- volta
   function NM_export_volta()
   {
         $this->volta = NM_charset_to_utf8($this->volta);
         $this->volta = str_replace('<', '&lt;', $this->volta);
         $this->volta = str_replace('>', '&gt;', $this->volta);
         $this->Texto_tag .= "<td>" . $this->volta . "</td>\r\n";
   }
   //----- aereo_cia_aerea
   function NM_export_aereo_cia_aerea()
   {
         nmgp_Form_Num_Val($this->look_aereo_cia_aerea, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_aereo_cia_aerea = NM_charset_to_utf8($this->look_aereo_cia_aerea);
         $this->look_aereo_cia_aerea = str_replace('<', '&lt;', $this->look_aereo_cia_aerea);
         $this->look_aereo_cia_aerea = str_replace('>', '&gt;', $this->look_aereo_cia_aerea);
         $this->Texto_tag .= "<td>" . $this->look_aereo_cia_aerea . "</td>\r\n";
   }
   //----- aereo_dt_saida
   function NM_export_aereo_dt_saida()
   {
             $conteudo_x =  $this->aereo_dt_saida;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->aereo_dt_saida, "YYYY-MM-DD  ");
                 $this->aereo_dt_saida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->aereo_dt_saida = NM_charset_to_utf8($this->aereo_dt_saida);
         $this->aereo_dt_saida = str_replace('<', '&lt;', $this->aereo_dt_saida);
         $this->aereo_dt_saida = str_replace('>', '&gt;', $this->aereo_dt_saida);
         $this->Texto_tag .= "<td>" . $this->aereo_dt_saida . "</td>\r\n";
   }
   //----- aereo_hr_saida
   function NM_export_aereo_hr_saida()
   {
             $conteudo_x =  $this->aereo_hr_saida;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->aereo_hr_saida, "HH:II:SS  ");
                 $this->aereo_hr_saida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         $this->aereo_hr_saida = NM_charset_to_utf8($this->aereo_hr_saida);
         $this->aereo_hr_saida = str_replace('<', '&lt;', $this->aereo_hr_saida);
         $this->aereo_hr_saida = str_replace('>', '&gt;', $this->aereo_hr_saida);
         $this->Texto_tag .= "<td>" . $this->aereo_hr_saida . "</td>\r\n";
   }
   //----- aereo_dt_chegada
   function NM_export_aereo_dt_chegada()
   {
             $conteudo_x =  $this->aereo_dt_chegada;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->aereo_dt_chegada, "YYYY-MM-DD  ");
                 $this->aereo_dt_chegada = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         $this->aereo_dt_chegada = NM_charset_to_utf8($this->aereo_dt_chegada);
         $this->aereo_dt_chegada = str_replace('<', '&lt;', $this->aereo_dt_chegada);
         $this->aereo_dt_chegada = str_replace('>', '&gt;', $this->aereo_dt_chegada);
         $this->Texto_tag .= "<td>" . $this->aereo_dt_chegada . "</td>\r\n";
   }
   //----- aereo_hr_chegada
   function NM_export_aereo_hr_chegada()
   {
             $conteudo_x =  $this->aereo_hr_chegada;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->aereo_hr_chegada, "HH:II:SS  ");
                 $this->aereo_hr_chegada = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         $this->aereo_hr_chegada = NM_charset_to_utf8($this->aereo_hr_chegada);
         $this->aereo_hr_chegada = str_replace('<', '&lt;', $this->aereo_hr_chegada);
         $this->aereo_hr_chegada = str_replace('>', '&gt;', $this->aereo_hr_chegada);
         $this->Texto_tag .= "<td>" . $this->aereo_hr_chegada . "</td>\r\n";
   }
   //----- aereo_num_voo
   function NM_export_aereo_num_voo()
   {
         $this->aereo_num_voo = html_entity_decode($this->aereo_num_voo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->aereo_num_voo = strip_tags($this->aereo_num_voo);
         $this->aereo_num_voo = NM_charset_to_utf8($this->aereo_num_voo);
         $this->aereo_num_voo = str_replace('<', '&lt;', $this->aereo_num_voo);
         $this->aereo_num_voo = str_replace('>', '&gt;', $this->aereo_num_voo);
         $this->Texto_tag .= "<td>" . $this->aereo_num_voo . "</td>\r\n";
   }
   //----- aereo_origem
   function NM_export_aereo_origem()
   {
         $this->look_aereo_origem = html_entity_decode($this->look_aereo_origem, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_aereo_origem = strip_tags($this->look_aereo_origem);
         $this->look_aereo_origem = NM_charset_to_utf8($this->look_aereo_origem);
         $this->look_aereo_origem = str_replace('<', '&lt;', $this->look_aereo_origem);
         $this->look_aereo_origem = str_replace('>', '&gt;', $this->look_aereo_origem);
         $this->Texto_tag .= "<td>" . $this->look_aereo_origem . "</td>\r\n";
   }
   //----- aereo_destino
   function NM_export_aereo_destino()
   {
         $this->look_aereo_destino = html_entity_decode($this->look_aereo_destino, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_aereo_destino = strip_tags($this->look_aereo_destino);
         $this->look_aereo_destino = NM_charset_to_utf8($this->look_aereo_destino);
         $this->look_aereo_destino = str_replace('<', '&lt;', $this->look_aereo_destino);
         $this->look_aereo_destino = str_replace('>', '&gt;', $this->look_aereo_destino);
         $this->Texto_tag .= "<td>" . $this->look_aereo_destino . "</td>\r\n";
   }
   //----- aereo_gray
   function NM_export_aereo_gray()
   {
         $this->aereo_gray = NM_charset_to_utf8($this->aereo_gray);
         $this->aereo_gray = str_replace('<', '&lt;', $this->aereo_gray);
         $this->aereo_gray = str_replace('>', '&gt;', $this->aereo_gray);
         $this->Texto_tag .= "<td>" . $this->aereo_gray . "</td>\r\n";
   }
   //----- aereo_yellow
   function NM_export_aereo_yellow()
   {
         $this->aereo_yellow = NM_charset_to_utf8($this->aereo_yellow);
         $this->aereo_yellow = str_replace('<', '&lt;', $this->aereo_yellow);
         $this->aereo_yellow = str_replace('>', '&gt;', $this->aereo_yellow);
         $this->Texto_tag .= "<td>" . $this->aereo_yellow . "</td>\r\n";
   }
   //----- aereo_green
   function NM_export_aereo_green()
   {
         $this->aereo_green = NM_charset_to_utf8($this->aereo_green);
         $this->aereo_green = str_replace('<', '&lt;', $this->aereo_green);
         $this->aereo_green = str_replace('>', '&gt;', $this->aereo_green);
         $this->Texto_tag .= "<td>" . $this->aereo_green . "</td>\r\n";
   }
   //----- aereo_red
   function NM_export_aereo_red()
   {
         $this->aereo_red = NM_charset_to_utf8($this->aereo_red);
         $this->aereo_red = str_replace('<', '&lt;', $this->aereo_red);
         $this->aereo_red = str_replace('>', '&gt;', $this->aereo_red);
         $this->Texto_tag .= "<td>" . $this->aereo_red . "</td>\r\n";
   }
   //----- aereo_id_usuario
   function NM_export_aereo_id_usuario()
   {
         nmgp_Form_Num_Val($this->look_aereo_id_usuario, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_aereo_id_usuario = NM_charset_to_utf8($this->look_aereo_id_usuario);
         $this->look_aereo_id_usuario = str_replace('<', '&lt;', $this->look_aereo_id_usuario);
         $this->look_aereo_id_usuario = str_replace('>', '&gt;', $this->look_aereo_id_usuario);
         $this->Texto_tag .= "<td>" . $this->look_aereo_id_usuario . "</td>\r\n";
   }
   //----- aereo_bloqueio_id
   function NM_export_aereo_bloqueio_id()
   {
             nmgp_Form_Num_Val($this->aereo_bloqueio_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->aereo_bloqueio_id = NM_charset_to_utf8($this->aereo_bloqueio_id);
         $this->aereo_bloqueio_id = str_replace('<', '&lt;', $this->aereo_bloqueio_id);
         $this->aereo_bloqueio_id = str_replace('>', '&gt;', $this->aereo_bloqueio_id);
         $this->Texto_tag .= "<td>" . $this->aereo_bloqueio_id . "</td>\r\n";
   }
   //----- nome_bloqueio
   function NM_export_nome_bloqueio()
   {
         $this->nome_bloqueio = html_entity_decode($this->nome_bloqueio, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nome_bloqueio = strip_tags($this->nome_bloqueio);
         $this->nome_bloqueio = NM_charset_to_utf8($this->nome_bloqueio);
         $this->nome_bloqueio = str_replace('<', '&lt;', $this->nome_bloqueio);
         $this->nome_bloqueio = str_replace('>', '&gt;', $this->nome_bloqueio);
         $this->Texto_tag .= "<td>" . $this->nome_bloqueio . "</td>\r\n";
   }
   //----- lugares_restantes
   function NM_export_lugares_restantes()
   {
         $this->lugares_restantes = html_entity_decode($this->lugares_restantes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->lugares_restantes = strip_tags($this->lugares_restantes);
         $this->lugares_restantes = NM_charset_to_utf8($this->lugares_restantes);
         $this->lugares_restantes = str_replace('<', '&lt;', $this->lugares_restantes);
         $this->lugares_restantes = str_replace('>', '&gt;', $this->lugares_restantes);
         $this->Texto_tag .= "<td>" . $this->lugares_restantes . "</td>\r\n";
   }
   //----- aereo_transfer_tipo
   function NM_export_aereo_transfer_tipo()
   {
         $this->aereo_transfer_tipo = html_entity_decode($this->aereo_transfer_tipo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->aereo_transfer_tipo = strip_tags($this->aereo_transfer_tipo);
         $this->aereo_transfer_tipo = NM_charset_to_utf8($this->aereo_transfer_tipo);
         $this->aereo_transfer_tipo = str_replace('<', '&lt;', $this->aereo_transfer_tipo);
         $this->aereo_transfer_tipo = str_replace('>', '&gt;', $this->aereo_transfer_tipo);
         $this->Texto_tag .= "<td>" . $this->aereo_transfer_tipo . "</td>\r\n";
   }
   //----- aereo_emitida_bvt
   function NM_export_aereo_emitida_bvt()
   {
         $this->look_aereo_emitida_bvt = html_entity_decode($this->look_aereo_emitida_bvt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_aereo_emitida_bvt = strip_tags($this->look_aereo_emitida_bvt);
         $this->look_aereo_emitida_bvt = NM_charset_to_utf8($this->look_aereo_emitida_bvt);
         $this->look_aereo_emitida_bvt = str_replace('<', '&lt;', $this->look_aereo_emitida_bvt);
         $this->look_aereo_emitida_bvt = str_replace('>', '&gt;', $this->look_aereo_emitida_bvt);
         $this->Texto_tag .= "<td>" . $this->look_aereo_emitida_bvt . "</td>\r\n";
   }
   //----- aereo_id_evento
   function NM_export_aereo_id_evento()
   {
             nmgp_Form_Num_Val($this->aereo_id_evento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->aereo_id_evento = NM_charset_to_utf8($this->aereo_id_evento);
         $this->aereo_id_evento = str_replace('<', '&lt;', $this->aereo_id_evento);
         $this->aereo_id_evento = str_replace('>', '&gt;', $this->aereo_id_evento);
         $this->Texto_tag .= "<td>" . $this->aereo_id_evento . "</td>\r\n";
   }
   //----- aereo_trecho
   function NM_export_aereo_trecho()
   {
             nmgp_Form_Num_Val($this->aereo_trecho, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->aereo_trecho = NM_charset_to_utf8($this->aereo_trecho);
         $this->aereo_trecho = str_replace('<', '&lt;', $this->aereo_trecho);
         $this->aereo_trecho = str_replace('>', '&gt;', $this->aereo_trecho);
         $this->Texto_tag .= "<td>" . $this->aereo_trecho . "</td>\r\n";
   }
   //----- copia_aereo
   function NM_export_copia_aereo()
   {
         $this->copia_aereo = NM_charset_to_utf8($this->copia_aereo);
         $this->copia_aereo = str_replace('<', '&lt;', $this->copia_aereo);
         $this->copia_aereo = str_replace('>', '&gt;', $this->copia_aereo);
         $this->Texto_tag .= "<td>" . $this->copia_aereo . "</td>\r\n";
   }
   //----- aereo_cpf_particip
   function NM_export_aereo_cpf_particip()
   {
         $this->aereo_cpf_particip = html_entity_decode($this->aereo_cpf_particip, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->aereo_cpf_particip = strip_tags($this->aereo_cpf_particip);
         $this->aereo_cpf_particip = NM_charset_to_utf8($this->aereo_cpf_particip);
         $this->aereo_cpf_particip = str_replace('<', '&lt;', $this->aereo_cpf_particip);
         $this->aereo_cpf_particip = str_replace('>', '&gt;', $this->aereo_cpf_particip);
         $this->Texto_tag .= "<td>" . $this->aereo_cpf_particip . "</td>\r\n";
   }
   //----- aereo_tipo_pessoa
   function NM_export_aereo_tipo_pessoa()
   {
         $this->aereo_tipo_pessoa = html_entity_decode($this->aereo_tipo_pessoa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->aereo_tipo_pessoa = strip_tags($this->aereo_tipo_pessoa);
         $this->aereo_tipo_pessoa = NM_charset_to_utf8($this->aereo_tipo_pessoa);
         $this->aereo_tipo_pessoa = str_replace('<', '&lt;', $this->aereo_tipo_pessoa);
         $this->aereo_tipo_pessoa = str_replace('>', '&gt;', $this->aereo_tipo_pessoa);
         $this->Texto_tag .= "<td>" . $this->aereo_tipo_pessoa . "</td>\r\n";
   }
   //----- aereo_status
   function NM_export_aereo_status()
   {
         $this->aereo_status = html_entity_decode($this->aereo_status, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->aereo_status = strip_tags($this->aereo_status);
         $this->aereo_status = NM_charset_to_utf8($this->aereo_status);
         $this->aereo_status = str_replace('<', '&lt;', $this->aereo_status);
         $this->aereo_status = str_replace('>', '&gt;', $this->aereo_status);
         $this->Texto_tag .= "<td>" . $this->aereo_status . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_1'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>BRSVP - Aéreos :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_aereos_rsvp_1_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_aereos_rsvp_1"> 
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

function GetPresAtiva($pcampo_1,$pcampo_2,$pcampo_3,$ptabela,$pcpf,$pevt,$porder) {
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
  		$ret = 'ERRO';
		$sql = "
 			SELECT 
				$pcampo_1, $pcampo_2, $pcampo_3
			FROM 
				$ptabela
			WHERE 
				$pcampo_1 = ".$this->Db->qstr($pcpf)." 
			AND 
				$pcampo_2 = ".$this->Db->qstr($pevt)."
			ORDER BY 
				$porder 
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
			$ret = $this->rs[0][2];
		}
		return $ret;
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'off';
}


function GetSaldoBloq($evento_id, $direcao) {
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'off';
}


function MakeColor($vp_evento,$vp_cpf,$tipo) {
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');

	
		$valor_y = 'Y';
		$valor_a = 'A';
		$valor_n = 'N';
		
		if ($tipo == 'I') {
			$sqlmestre = "
				SELECT
					part_id_evento,
					part_cpf,
					part_contato_rsvp,
					part_presenca,
					part_solicit_especial,
					part_programacao,
					part_aereo,
					part_hospedagem,
					part_transfer,
					part_opcionais
				FROM
					participantes_rsvp
				WHERE   
					part_id_evento = ".$this->Db->qstr($vp_evento)."
				AND 
					part_cpf = ".$this->Db->qstr($vp_cpf)."
				ORDER BY 
					part_id_evento,part_cpf
			";		
		} else {
			$sqlmestre = "
				SELECT
					part_id_evento,
					part_cpf,
					part_contato_rsvp,
					part_presenca,
					part_solicit_especial,
					part_programacao,
					part_aereo,
					part_hospedagem,
					part_transfer,
					part_opcionais
				FROM
					participantes_rsvp
				WHERE   
					part_id_evento = ".$this->Db->qstr($vp_evento)."
				ORDER BY 
					part_id_evento,part_cpf
			";		
		}			
		 
      $nm_select = $sqlmestre; 
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
		if ($reg_inc > 0) {
			for ($i=0;$i<$reg_inc;++$i) {	
				$evento_id			= $this->rs[$i][0];   
				$cpf_mestre			= $this->rs[$i][1];   
				$contato_mestre		= $this->rs[$i][2];  
				$presenca_mestre	= $this->rs[$i][3];  
				$solicitacao		= $this->rs[$i][4];  
				$programacao		= $this->rs[$i][5];  
				$aereo				= $this->rs[$i][6];  
				$hospedagem			= $this->rs[$i][7];  
				$transfer			= $this->rs[$i][8];  
				$opcionais			= $this->rs[$i][9];			

				$sqlcon = "
					SELECT
						contato_status
					FROM	
						contatos_rsvp	
					WHERE
						contato_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						contato_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						contato_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlcon; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscon = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscon[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscon = false;
          $this->rscon_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rscon[0][0])) {
					$_atu_contato = $this->rscon[0][0];			
					$sqlucon = "
						UPDATE 
							participantes_rsvp
						SET 
							part_contato_rsvp = ".$this->Db->qstr($_atu_contato)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlucon; 
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
      
				} else {
					$sqlucon = "
						UPDATE 
							participantes_rsvp
						SET 
							part_contato_rsvp = ".$this->Db->qstr($valor_a)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";
					
     $nm_select = $sqlucon; 
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

				$sqlpres = "
					SELECT
						presenca_status
					FROM
						presencas_rsvp	
					WHERE
						presenca_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						presenca_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						presenca_data_hora DESC
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
					$_atu_pres = $this->rspres[0][0];
					$sqlupres = "
						UPDATE 
							participantes_rsvp
						SET 
							part_presenca = ".$this->Db->qstr($_atu_pres)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";
					
     $nm_select = $sqlupres; 
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
      
				} else {
					$sqlupres = "
						UPDATE 
							participantes_rsvp
						SET 
							part_presenca = ".$this->Db->qstr($valor_a)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";			
					
     $nm_select = $sqlupres; 
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

				$sqlsol = "
					SELECT
						solicitacao_status
					FROM
						solicitacoes_rsvp	
					WHERE
						solicitacao_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						solicitacao_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						solicitacao_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlsol; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rssol = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rssol[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rssol = false;
          $this->rssol_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rssol[0][0])) {
					$_atu_sol = $this->rssol[0][0];
					$sqlusol = "
						UPDATE 
							participantes_rsvp
						SET 
							part_solicit_especial = ".$this->Db->qstr($_atu_sol)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlusol; 
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
      
				} else {
					$sqlusol = "
						UPDATE 
							participantes_rsvp
						SET 
							part_solicit_especial = ".$this->Db->qstr($valor_a)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";			
					
     $nm_select = $sqlusol; 
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

				$sqlpro = "
					SELECT
						programac_ativo
					FROM
						programac_rsvp
					WHERE
						programac_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						programac_id_evento = ".$this->Db->qstr($evento_id)."
					AND 
						programac_ativo = ".$this->Db->qstr($valor_y)."
					ORDER BY
						programac_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlpro; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspro = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspro[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspro = false;
          $this->rspro_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rspro[0][0])) {
					$_atu_pro = $this->rspro[0][0];
					$sqlupro = "
					UPDATE 
						participantes_rsvp
					SET 
						part_programacao = ".$this->Db->qstr($_atu_pro)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlupro; 
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
      
				} else {
					$sqlupro = "
					UPDATE 
						participantes_rsvp
					SET 
						part_programacao = ".$this->Db->qstr($valor_n)." 
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlupro; 
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

				$contverde = '0';  		  
				$contaberto = '0'; 
				$contamarelo = '0'; 
				$controxo = '0'; 
				$contvermelho = '0';		
				$contot = 0;
				$vpart_aereo = 'A';
				$sqlaer = "
				SELECT
						aereo_status,
						aereo_direcao,
						aereo_cpf_particip
					FROM
						aereos_rsvp
					WHERE
						aereo_id_evento = ".$this->Db->qstr($evento_id)."
					AND	
						aereo_cpf_particip = ".$this->Db->qstr($cpf_mestre)."
					AND	
						aereo_ativo = ".$this->Db->qstr($valor_y)." 
					ORDER BY
						aereo_id_evento,aereo_cpf_particip,aereo_direcao
				";
				 
      $nm_select = $sqlaer; 
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
	
				$reg_aer = sizeof($this->rsaer );
				if ($reg_aer > 0) {
					for ($i2=0;$i2<$reg_aer;++$i2) {									
						$vaereo_status = $this->rsaer[$i2][0];				
						switch($vaereo_status) {
							case 'Y':
								$contverde = '1';  		  
								break;
							case 'A':
								$contaberto = '2'; 
								break;							
							case 'P':
								$contamarelo = '3'; 
								break;							
							case 'N':
								$contvermelho = '4'; 
								break;							
						}												
						$resultado = $contverde.$contaberto.$contamarelo.$contvermelho;		
						switch($resultado) {
							case '1000':
								if ($reg_aer == 1) {
									$vpart_aereo = 'R';
								} else {
									$vpart_aereo = 'Y';
								}	
								break;						
							case '0200':
								$vpart_aereo = 'A';
								break;						
							case '0030':
								$vpart_aereo = 'P';
								break;
							case '0004':
								$vpart_aereo = 'N';
								break;
							default:	
								$vpart_aereo = 'R';
								break;							
						}												
					}					
					$sqluaer = "
						UPDATE 
							participantes_rsvp
						SET 
							part_aereo = ".$this->Db->qstr($vpart_aereo).",
							part_aereo_ok = ".$this->Db->qstr($vpart_aereo)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqluaer; 
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
      
				} else {
					$sqluaer = "
					UPDATE 
						participantes_rsvp
					SET 
						part_aereo = ".$this->Db->qstr($valor_a).",
						part_aereo_ok = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqluaer; 
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

				$sqlhos = "
					SELECT
						hosp_id_evento,
						hosp_cpf_participante,
						hosp_id_hotel,
						hosp_status
					FROM
						hospedagem_rsvp
					WHERE
						hosp_id_evento = ".$this->Db->qstr($evento_id)."
					AND	
						hosp_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						hosp_ativo = ".$this->Db->qstr($valor_y)."
					ORDER BY
						hosp_dt_checkin DESC, hosp_hr_checkin DESC, hosp_id_hotel
					LIMIT 1						
				";
				 
      $nm_select = $sqlhos; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshos = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshos[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshos = false;
          $this->rshos_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rshos[0][0])) {
					$status_hos = $this->rshos[0][3];
					$sqluhos = "
					UPDATE 
						participantes_rsvp
					SET 
						part_hospedagem = ".$this->Db->qstr($status_hos).",
						part_hotel = ".$this->Db->qstr($status_hos)."						
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluhos; 
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
      
				} else {
					$sqluhos = "
					UPDATE 
						participantes_rsvp
					SET 
						part_hospedagem = ".$this->Db->qstr($valor_a).",
						part_hotel = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluhos; 
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
				
				$sqltra = "
					SELECT
						tra_id_evento,
						tra_cpf_particip,
						tra_status
					FROM
						transfer_rsvp
					WHERE
						tra_cpf_particip = ".$this->Db->qstr($cpf_mestre)."
					AND
						tra_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						tra_id_evento,tra_cpf_particip,tra_status
					LIMIT 1
				";
				 
      $nm_select = $sqltra; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rstra = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rstra[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rstra = false;
          $this->rstra_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rstra[0][0])) {
					$status_tra = $this->rstra[0][2];
					$sqlutra = "
					UPDATE 
						participantes_rsvp
					SET 
						part_transfer = ".$this->Db->qstr($status_tra)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqlutra; 
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
      
				} else {
					$sqlutra = "
					UPDATE 
						participantes_rsvp
					SET 
						part_transfer = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqlutra; 
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
								
				$sqlopc = "
					SELECT
						opc_evento_id,
						opc_cpf_participante,
						opc_status
					FROM
						eventos_opcionais_rsvp
					WHERE
						opc_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						opc_evento_id = ".$this->Db->qstr($evento_id)."
					AND
						opc_status = ".$this->Db->qstr($valor_y)."
					ORDER BY
						opc_evento_id,opc_cpf_participante	
					LIMIT 1	
				";
				 
      $nm_select = $sqlopc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsopc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsopc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsopc = false;
          $this->rsopc_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rsopc[0][0])) {
					$sqluopc = "
					UPDATE 
						participantes_rsvp
					SET 
						part_opcionais =  ".$this->Db->qstr($valor_y)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluopc; 
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
      
				} else {
					$sqluopc = "
					UPDATE 
						participantes_rsvp
					SET 
						part_opcionais =  ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluopc; 
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
								
				$sqlant = "
					SELECT
						ant_evento_id,
						ant_cpf_participante,
						ant_status
					FROM
						anotacoes_rsvp	
					WHERE
						ant_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						ant_evento_id = ".$this->Db->qstr($evento_id)."		
					ORDER BY
						ant_evento_id,ant_cpf_participante		
					LIMIT 1	
				";
				 
      $nm_select = $sqlant; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsant = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsant[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsant = false;
          $this->rsant_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rsant[0][0])) {
					$sqluant = "
					UPDATE 
						participantes_rsvp
					SET 
						part_anotacoes = ".$this->Db->qstr($valor_y)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluant; 
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
      
				} else {
					$sqluant = "
					UPDATE 
						participantes_rsvp
					SET 
						part_anotacoes = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluant; 
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
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_aereos_rsvp_1']['contr_erro'] = 'off';
}

}

?>
