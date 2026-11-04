<?php

class grid_aereos_rsvp_gate_view_rtf
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
                   nm_limpa_str_grid_aereos_rsvp_gate_view($cadapar[1]);
                   nm_protect_num_grid_aereos_rsvp_gate_view($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_aereos_rsvp_gate_view']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_aereos_rsvp_gate_view_total.class.php"); 
      $this->Tot      = new grid_aereos_rsvp_gate_view_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_aereos_rsvp_gate_view']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_aereos_rsvp_gate_view";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_aereos_rsvp_gate_view.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_aereos_rsvp_gate_view']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_aereos_rsvp_gate_view']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_aereos_rsvp_gate_view']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->aereo_id_evento = (isset($Busca_temp['aereo_id_evento'])) ? $Busca_temp['aereo_id_evento'] : ""; 
          $tmp_pos = (is_string($this->aereo_id_evento)) ? strpos($this->aereo_id_evento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_id_evento))
          {
              $this->aereo_id_evento = substr($this->aereo_id_evento, 0, $tmp_pos);
          }
          $this->aereo_id_usuario = (isset($Busca_temp['aereo_id_usuario'])) ? $Busca_temp['aereo_id_usuario'] : ""; 
          $tmp_pos = (is_string($this->aereo_id_usuario)) ? strpos($this->aereo_id_usuario, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_id_usuario))
          {
              $this->aereo_id_usuario = substr($this->aereo_id_usuario, 0, $tmp_pos);
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
          $this->aereo_direcao = (isset($Busca_temp['aereo_direcao'])) ? $Busca_temp['aereo_direcao'] : ""; 
          $tmp_pos = (is_string($this->aereo_direcao)) ? strpos($this->aereo_direcao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_direcao))
          {
              $this->aereo_direcao = substr($this->aereo_direcao, 0, $tmp_pos);
          }
          $this->aereo_num_voo = (isset($Busca_temp['aereo_num_voo'])) ? $Busca_temp['aereo_num_voo'] : ""; 
          $tmp_pos = (is_string($this->aereo_num_voo)) ? strpos($this->aereo_num_voo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aereo_num_voo))
          {
              $this->aereo_num_voo = substr($this->aereo_num_voo, 0, $tmp_pos);
          }
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
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_aereos_rsvp_gate_view']['contr_erro'] = 'on';
 $sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['grid_aereos_rsvp_gate_view']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['aereo_id_evento'])) ? $this->New_label['aereo_id_evento'] : "Cód Evento"; 
          if ($Cada_col == "aereo_id_evento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_id_usuario'])) ? $this->New_label['aereo_id_usuario'] : "Cod. Usuário"; 
          if ($Cada_col == "aereo_id_usuario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_modificado_em'])) ? $this->New_label['aereo_modificado_em'] : "Modificado Em"; 
          if ($Cada_col == "aereo_modificado_em" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_cpf_particip'])) ? $this->New_label['aereo_cpf_particip'] : "CPF/Nome Participante"; 
          if ($Cada_col == "aereo_cpf_particip" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_tipo_pessoa'])) ? $this->New_label['aereo_tipo_pessoa'] : "Tipo Pessoa"; 
          if ($Cada_col == "aereo_tipo_pessoa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nome_pax_gate'])) ? $this->New_label['nome_pax_gate'] : "Pax Gate"; 
          if ($Cada_col == "nome_pax_gate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_status'])) ? $this->New_label['aereo_status'] : "Status"; 
          if ($Cada_col == "aereo_status" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_localizador'])) ? $this->New_label['aereo_localizador'] : "Localizador"; 
          if ($Cada_col == "aereo_localizador" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_cia_aerea_gate'])) ? $this->New_label['aereo_cia_aerea_gate'] : "Cia. Aérea"; 
          if ($Cada_col == "aereo_cia_aerea_gate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_num_voo'])) ? $this->New_label['aereo_num_voo'] : "Voo"; 
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
          $SC_Label = (isset($this->New_label['aereo_dt_saida'])) ? $this->New_label['aereo_dt_saida'] : "Dt. Saída"; 
          if ($Cada_col == "aereo_dt_saida" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_hr_saida'])) ? $this->New_label['aereo_hr_saida'] : "Hr. Saída"; 
          if ($Cada_col == "aereo_hr_saida" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_dt_chegada'])) ? $this->New_label['aereo_dt_chegada'] : "Dt. Chegada"; 
          if ($Cada_col == "aereo_dt_chegada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_hr_chegada'])) ? $this->New_label['aereo_hr_chegada'] : "Hr Chegada"; 
          if ($Cada_col == "aereo_hr_chegada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_eticket'])) ? $this->New_label['aereo_eticket'] : "Eticket"; 
          if ($Cada_col == "aereo_eticket" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aereo_emitida_bvt'])) ? $this->New_label['aereo_emitida_bvt'] : "Emitida Bvt"; 
          if ($Cada_col == "aereo_emitida_bvt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_aereo'])) ? $this->New_label['id_aereo'] : "Id Aereo"; 
          if ($Cada_col == "id_aereo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT aereo_id_evento, aereo_id_usuario, aereo_modificado_em, aereo_cpf_particip, aereo_tipo_pessoa, nome_pax_gate, aereo_status, aereo_localizador, aereo_cia_aerea_gate, aereo_num_voo, aereo_origem, aereo_destino, str_replace (convert(char(10),aereo_dt_saida,102), '.', '-') + ' ' + convert(char(8),aereo_dt_saida,20), str_replace (convert(char(10),aereo_hr_saida,102), '.', '-') + ' ' + convert(char(8),aereo_hr_saida,20), str_replace (convert(char(10),aereo_dt_chegada,102), '.', '-') + ' ' + convert(char(8),aereo_dt_chegada,20), str_replace (convert(char(10),aereo_hr_chegada,102), '.', '-') + ' ' + convert(char(8),aereo_hr_chegada,20), aereo_eticket, aereo_emitida_bvt, id_aereo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT aereo_id_evento, aereo_id_usuario, aereo_modificado_em, aereo_cpf_particip, aereo_tipo_pessoa, nome_pax_gate, aereo_status, aereo_localizador, aereo_cia_aerea_gate, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_eticket, aereo_emitida_bvt, id_aereo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT aereo_id_evento, aereo_id_usuario, aereo_modificado_em, aereo_cpf_particip, aereo_tipo_pessoa, nome_pax_gate, aereo_status, aereo_localizador, aereo_cia_aerea_gate, aereo_num_voo, aereo_origem, aereo_destino, convert(char(23),aereo_dt_saida,121), convert(char(23),aereo_hr_saida,121), convert(char(23),aereo_dt_chegada,121), convert(char(23),aereo_hr_chegada,121), aereo_eticket, aereo_emitida_bvt, id_aereo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT aereo_id_evento, aereo_id_usuario, TO_DATE(TO_CHAR(aereo_modificado_em, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), aereo_cpf_particip, aereo_tipo_pessoa, nome_pax_gate, aereo_status, aereo_localizador, aereo_cia_aerea_gate, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_eticket, aereo_emitida_bvt, id_aereo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT aereo_id_evento, aereo_id_usuario, aereo_modificado_em, aereo_cpf_particip, aereo_tipo_pessoa, nome_pax_gate, aereo_status, aereo_localizador, aereo_cia_aerea_gate, aereo_num_voo, aereo_origem, aereo_destino, EXTEND(aereo_dt_saida, YEAR TO DAY), aereo_hr_saida, EXTEND(aereo_dt_chegada, YEAR TO DAY), aereo_hr_chegada, aereo_eticket, aereo_emitida_bvt, id_aereo from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT aereo_id_evento, aereo_id_usuario, aereo_modificado_em, aereo_cpf_particip, aereo_tipo_pessoa, nome_pax_gate, aereo_status, aereo_localizador, aereo_cia_aerea_gate, aereo_num_voo, aereo_origem, aereo_destino, aereo_dt_saida, aereo_hr_saida, aereo_dt_chegada, aereo_hr_chegada, aereo_eticket, aereo_emitida_bvt, id_aereo from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['order_grid'];
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
         $this->aereo_id_evento = $rs->fields[0] ;  
         $this->aereo_id_evento = (string)$this->aereo_id_evento;
         $this->aereo_id_usuario = $rs->fields[1] ;  
         $this->aereo_id_usuario = (string)$this->aereo_id_usuario;
         $this->aereo_modificado_em = $rs->fields[2] ;  
         $this->aereo_cpf_particip = $rs->fields[3] ;  
         $this->aereo_tipo_pessoa = $rs->fields[4] ;  
         $this->nome_pax_gate = $rs->fields[5] ;  
         $this->aereo_status = $rs->fields[6] ;  
         $this->aereo_localizador = $rs->fields[7] ;  
         $this->aereo_cia_aerea_gate = $rs->fields[8] ;  
         $this->aereo_num_voo = $rs->fields[9] ;  
         $this->aereo_origem = $rs->fields[10] ;  
         $this->aereo_destino = $rs->fields[11] ;  
         $this->aereo_dt_saida = $rs->fields[12] ;  
         $this->aereo_hr_saida = $rs->fields[13] ;  
         $this->aereo_dt_chegada = $rs->fields[14] ;  
         $this->aereo_hr_chegada = $rs->fields[15] ;  
         $this->aereo_eticket = $rs->fields[16] ;  
         $this->aereo_emitida_bvt = $rs->fields[17] ;  
         $this->id_aereo = $rs->fields[18] ;  
         $this->id_aereo = (string)$this->id_aereo;
         //----- lookup - aereo_id_evento
         $this->look_aereo_id_evento = $this->aereo_id_evento; 
         $this->Lookup->lookup_aereo_id_evento($this->look_aereo_id_evento, $this->aereo_id_evento) ; 
         $this->look_aereo_id_evento = ($this->look_aereo_id_evento == "&nbsp;") ? "" : $this->look_aereo_id_evento; 
         //----- lookup - aereo_id_usuario
         $this->look_aereo_id_usuario = $this->aereo_id_usuario; 
         $this->Lookup->lookup_aereo_id_usuario($this->look_aereo_id_usuario, $this->aereo_id_usuario) ; 
         $this->look_aereo_id_usuario = ($this->look_aereo_id_usuario == "&nbsp;") ? "" : $this->look_aereo_id_usuario; 
         //----- lookup - aereo_cpf_particip
         $this->look_aereo_cpf_particip = $this->aereo_cpf_particip; 
         $this->Lookup->lookup_aereo_cpf_particip($this->look_aereo_cpf_particip, $this->aereo_cpf_particip) ; 
         $this->look_aereo_cpf_particip = ($this->look_aereo_cpf_particip == "&nbsp;") ? "" : $this->look_aereo_cpf_particip; 
         //----- lookup - aereo_status
         $this->look_aereo_status = $this->aereo_status; 
         $this->Lookup->lookup_aereo_status($this->look_aereo_status); 
         $this->look_aereo_status = ($this->look_aereo_status == "&nbsp;") ? "" : $this->look_aereo_status; 
         //----- lookup - aereo_cia_aerea_gate
         $this->look_aereo_cia_aerea_gate = $this->aereo_cia_aerea_gate; 
         $this->Lookup->lookup_aereo_cia_aerea_gate($this->look_aereo_cia_aerea_gate, $this->aereo_cia_aerea_gate) ; 
         $this->look_aereo_cia_aerea_gate = ($this->look_aereo_cia_aerea_gate == "&nbsp;") ? "" : $this->look_aereo_cia_aerea_gate; 
         //----- lookup - aereo_origem
         $this->look_aereo_origem = $this->aereo_origem; 
         $this->Lookup->lookup_aereo_origem($this->look_aereo_origem, $this->aereo_origem) ; 
         $this->look_aereo_origem = ($this->look_aereo_origem == "&nbsp;") ? "" : $this->look_aereo_origem; 
         //----- lookup - aereo_destino
         $this->look_aereo_destino = $this->aereo_destino; 
         $this->Lookup->lookup_aereo_destino($this->look_aereo_destino, $this->aereo_destino) ; 
         $this->look_aereo_destino = ($this->look_aereo_destino == "&nbsp;") ? "" : $this->look_aereo_destino; 
         //----- lookup - aereo_emitida_bvt
         $this->look_aereo_emitida_bvt = $this->aereo_emitida_bvt; 
         $this->Lookup->lookup_aereo_emitida_bvt($this->look_aereo_emitida_bvt); 
         $this->look_aereo_emitida_bvt = ($this->look_aereo_emitida_bvt == "&nbsp;") ? "" : $this->look_aereo_emitida_bvt; 
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- aereo_id_evento
   function NM_export_aereo_id_evento()
   {
         nmgp_Form_Num_Val($this->look_aereo_id_evento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_aereo_id_evento = NM_charset_to_utf8($this->look_aereo_id_evento);
         $this->look_aereo_id_evento = str_replace('<', '&lt;', $this->look_aereo_id_evento);
         $this->look_aereo_id_evento = str_replace('>', '&gt;', $this->look_aereo_id_evento);
         $this->Texto_tag .= "<td>" . $this->look_aereo_id_evento . "</td>\r\n";
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
   //----- aereo_modificado_em
   function NM_export_aereo_modificado_em()
   {
             if (substr($this->aereo_modificado_em, 10, 1) == "-") 
             { 
                 $this->aereo_modificado_em = substr($this->aereo_modificado_em, 0, 10) . " " . substr($this->aereo_modificado_em, 11);
             } 
             if (substr($this->aereo_modificado_em, 13, 1) == ".") 
             { 
                $this->aereo_modificado_em = substr($this->aereo_modificado_em, 0, 13) . ":" . substr($this->aereo_modificado_em, 14, 2) . ":" . substr($this->aereo_modificado_em, 17);
             } 
             $conteudo_x =  $this->aereo_modificado_em;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->aereo_modificado_em, "YYYY-MM-DD HH:II:SS  ");
                 $this->aereo_modificado_em = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->aereo_modificado_em = NM_charset_to_utf8($this->aereo_modificado_em);
         $this->aereo_modificado_em = str_replace('<', '&lt;', $this->aereo_modificado_em);
         $this->aereo_modificado_em = str_replace('>', '&gt;', $this->aereo_modificado_em);
         $this->Texto_tag .= "<td>" . $this->aereo_modificado_em . "</td>\r\n";
   }
   //----- aereo_cpf_particip
   function NM_export_aereo_cpf_particip()
   {
         $this->look_aereo_cpf_particip = html_entity_decode($this->look_aereo_cpf_particip, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_aereo_cpf_particip = strip_tags($this->look_aereo_cpf_particip);
         $this->look_aereo_cpf_particip = NM_charset_to_utf8($this->look_aereo_cpf_particip);
         $this->look_aereo_cpf_particip = str_replace('<', '&lt;', $this->look_aereo_cpf_particip);
         $this->look_aereo_cpf_particip = str_replace('>', '&gt;', $this->look_aereo_cpf_particip);
         $this->Texto_tag .= "<td>" . $this->look_aereo_cpf_particip . "</td>\r\n";
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
   //----- nome_pax_gate
   function NM_export_nome_pax_gate()
   {
         $this->nome_pax_gate = html_entity_decode($this->nome_pax_gate, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nome_pax_gate = strip_tags($this->nome_pax_gate);
         $this->nome_pax_gate = NM_charset_to_utf8($this->nome_pax_gate);
         $this->nome_pax_gate = str_replace('<', '&lt;', $this->nome_pax_gate);
         $this->nome_pax_gate = str_replace('>', '&gt;', $this->nome_pax_gate);
         $this->Texto_tag .= "<td>" . $this->nome_pax_gate . "</td>\r\n";
   }
   //----- aereo_status
   function NM_export_aereo_status()
   {
         $this->look_aereo_status = html_entity_decode($this->look_aereo_status, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_aereo_status = strip_tags($this->look_aereo_status);
         $this->look_aereo_status = NM_charset_to_utf8($this->look_aereo_status);
         $this->look_aereo_status = str_replace('<', '&lt;', $this->look_aereo_status);
         $this->look_aereo_status = str_replace('>', '&gt;', $this->look_aereo_status);
         $this->Texto_tag .= "<td>" . $this->look_aereo_status . "</td>\r\n";
   }
   //----- aereo_localizador
   function NM_export_aereo_localizador()
   {
         $this->aereo_localizador = html_entity_decode($this->aereo_localizador, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->aereo_localizador = strip_tags($this->aereo_localizador);
         $this->aereo_localizador = NM_charset_to_utf8($this->aereo_localizador);
         $this->aereo_localizador = str_replace('<', '&lt;', $this->aereo_localizador);
         $this->aereo_localizador = str_replace('>', '&gt;', $this->aereo_localizador);
         $this->Texto_tag .= "<td>" . $this->aereo_localizador . "</td>\r\n";
   }
   //----- aereo_cia_aerea_gate
   function NM_export_aereo_cia_aerea_gate()
   {
         $this->look_aereo_cia_aerea_gate = html_entity_decode($this->look_aereo_cia_aerea_gate, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->look_aereo_cia_aerea_gate = strip_tags($this->look_aereo_cia_aerea_gate);
         $this->look_aereo_cia_aerea_gate = NM_charset_to_utf8($this->look_aereo_cia_aerea_gate);
         $this->look_aereo_cia_aerea_gate = str_replace('<', '&lt;', $this->look_aereo_cia_aerea_gate);
         $this->look_aereo_cia_aerea_gate = str_replace('>', '&gt;', $this->look_aereo_cia_aerea_gate);
         $this->Texto_tag .= "<td>" . $this->look_aereo_cia_aerea_gate . "</td>\r\n";
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
   //----- aereo_eticket
   function NM_export_aereo_eticket()
   {
         $this->aereo_eticket = html_entity_decode($this->aereo_eticket, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->aereo_eticket = strip_tags($this->aereo_eticket);
         $this->aereo_eticket = NM_charset_to_utf8($this->aereo_eticket);
         $this->aereo_eticket = str_replace('<', '&lt;', $this->aereo_eticket);
         $this->aereo_eticket = str_replace('>', '&gt;', $this->aereo_eticket);
         $this->Texto_tag .= "<td>" . $this->aereo_eticket . "</td>\r\n";
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
   //----- id_aereo
   function NM_export_id_aereo()
   {
             nmgp_Form_Num_Val($this->id_aereo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->id_aereo = NM_charset_to_utf8($this->id_aereo);
         $this->id_aereo = str_replace('<', '&lt;', $this->id_aereo);
         $this->id_aereo = str_replace('>', '&gt;', $this->id_aereo);
         $this->Texto_tag .= "<td>" . $this->id_aereo . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereos_rsvp_gate_view'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Localizadores Importados do GATE :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_aereos_rsvp_gate_view_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_aereos_rsvp_gate_view"> 
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
}

?>
