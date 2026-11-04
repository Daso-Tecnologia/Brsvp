<?php

class grid_rsvp_log_id_rtf
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
                   nm_limpa_str_grid_rsvp_log_id($cadapar[1]);
                   nm_protect_num_grid_rsvp_log_id($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_rsvp_log_id']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_campo_id)) 
      {
          $_SESSION['vg_campo_id'] = $vg_campo_id;
          nm_limpa_str_grid_rsvp_log_id($_SESSION["vg_campo_id"]);
      }
      if (isset($vg_campo_evt)) 
      {
          $_SESSION['vg_campo_evt'] = $vg_campo_evt;
          nm_limpa_str_grid_rsvp_log_id($_SESSION["vg_campo_evt"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_rsvp_log_id_total.class.php"); 
      $this->Tot      = new grid_rsvp_log_id_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_rsvp_log_id']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_rsvp_log_id";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_rsvp_log_id.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_log_id']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_log_id']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_rsvp_log_id']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->acao = (isset($Busca_temp['acao'])) ? $Busca_temp['acao'] : ""; 
          $tmp_pos = (is_string($this->acao)) ? strpos($this->acao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->acao))
          {
              $this->acao = substr($this->acao, 0, $tmp_pos);
          }
          $this->aplicacao = (isset($Busca_temp['aplicacao'])) ? $Busca_temp['aplicacao'] : ""; 
          $tmp_pos = (is_string($this->aplicacao)) ? strpos($this->aplicacao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->aplicacao))
          {
              $this->aplicacao = substr($this->aplicacao, 0, $tmp_pos);
          }
          $this->cod_usuario = (isset($Busca_temp['cod_usuario'])) ? $Busca_temp['cod_usuario'] : ""; 
          $tmp_pos = (is_string($this->cod_usuario)) ? strpos($this->cod_usuario, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_usuario))
          {
              $this->cod_usuario = substr($this->cod_usuario, 0, $tmp_pos);
          }
          $this->id_usuario = (isset($Busca_temp['id_usuario'])) ? $Busca_temp['id_usuario'] : ""; 
          $tmp_pos = (is_string($this->id_usuario)) ? strpos($this->id_usuario, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->id_usuario))
          {
              $this->id_usuario = substr($this->id_usuario, 0, $tmp_pos);
          }
          $this->modulo = (isset($Busca_temp['modulo'])) ? $Busca_temp['modulo'] : ""; 
          $tmp_pos = (is_string($this->modulo)) ? strpos($this->modulo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->modulo))
          {
              $this->modulo = substr($this->modulo, 0, $tmp_pos);
          }
          $this->data_hora = (isset($Busca_temp['data_hora'])) ? $Busca_temp['data_hora'] : ""; 
          $tmp_pos = (is_string($this->data_hora)) ? strpos($this->data_hora, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_hora))
          {
              $this->data_hora = substr($this->data_hora, 0, $tmp_pos);
          }
          $this->data_hora_2 = (isset($Busca_temp['data_hora_input_2'])) ? $Busca_temp['data_hora_input_2'] : ""; 
          $this->ip = (isset($Busca_temp['ip'])) ? $Busca_temp['ip'] : ""; 
          $tmp_pos = (is_string($this->ip)) ? strpos($this->ip, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->ip))
          {
              $this->ip = substr($this->ip, 0, $tmp_pos);
          }
          $this->valor_campo_id = (isset($Busca_temp['valor_campo_id'])) ? $Busca_temp['valor_campo_id'] : ""; 
          $tmp_pos = (is_string($this->valor_campo_id)) ? strpos($this->valor_campo_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->valor_campo_id))
          {
              $this->valor_campo_id = substr($this->valor_campo_id, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_rsvp_log_id']['contr_erro'] = 'on';
 $sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['grid_rsvp_log_id']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_log'])) ? $this->New_label['id_log'] : "Id Log"; 
          if ($Cada_col == "id_log" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['data_hora'])) ? $this->New_label['data_hora'] : "Data Hora"; 
          if ($Cada_col == "data_hora" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ip'])) ? $this->New_label['ip'] : "IP"; 
          if ($Cada_col == "ip" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['id_usuario'])) ? $this->New_label['id_usuario'] : "Id Usuário"; 
          if ($Cada_col == "id_usuario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cod_usuario'])) ? $this->New_label['cod_usuario'] : "Cód.Usuário"; 
          if ($Cada_col == "cod_usuario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['usuario_nome'])) ? $this->New_label['usuario_nome'] : "Nome"; 
          if ($Cada_col == "usuario_nome" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['modulo'])) ? $this->New_label['modulo'] : "Módulo"; 
          if ($Cada_col == "modulo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['aplicacao'])) ? $this->New_label['aplicacao'] : "Aplicação"; 
          if ($Cada_col == "aplicacao" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tabela'])) ? $this->New_label['tabela'] : "Tabela"; 
          if ($Cada_col == "tabela" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['acao'])) ? $this->New_label['acao'] : "Ação"; 
          if ($Cada_col == "acao" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['campo_id'])) ? $this->New_label['campo_id'] : "ID do Campo"; 
          if ($Cada_col == "campo_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valor_campo_id'])) ? $this->New_label['valor_campo_id'] : "Valor do Campo Id"; 
          if ($Cada_col == "valor_campo_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['campo_cpf'])) ? $this->New_label['campo_cpf'] : "Campo Cpf"; 
          if ($Cada_col == "campo_cpf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valor_campo_cpf'])) ? $this->New_label['valor_campo_cpf'] : "Valor Campo Cpf"; 
          if ($Cada_col == "valor_campo_cpf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['participante_nome'])) ? $this->New_label['participante_nome'] : "Participante"; 
          if ($Cada_col == "participante_nome" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['campo_evt'])) ? $this->New_label['campo_evt'] : "Campo Evento"; 
          if ($Cada_col == "campo_evt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['valor_campo_evt'])) ? $this->New_label['valor_campo_evt'] : "Valor Campo Evento"; 
          if ($Cada_col == "valor_campo_evt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['evento_dsc'])) ? $this->New_label['evento_dsc'] : "Evento Nome"; 
          if ($Cada_col == "evento_dsc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['obs'])) ? $this->New_label['obs'] : "Obs"; 
          if ($Cada_col == "obs" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT id_log, data_hora, ip, id_usuario, cod_usuario, modulo, aplicacao, tabela, acao, campo_id, valor_campo_id, campo_cpf, valor_campo_cpf, campo_evt, valor_campo_evt, obs from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT id_log, data_hora, ip, id_usuario, cod_usuario, modulo, aplicacao, tabela, acao, campo_id, valor_campo_id, campo_cpf, valor_campo_cpf, campo_evt, valor_campo_evt, obs from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT id_log, data_hora, ip, id_usuario, cod_usuario, modulo, aplicacao, tabela, acao, campo_id, valor_campo_id, campo_cpf, valor_campo_cpf, campo_evt, valor_campo_evt, obs from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT id_log, TO_DATE(TO_CHAR(data_hora, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), ip, id_usuario, cod_usuario, modulo, aplicacao, tabela, acao, campo_id, valor_campo_id, campo_cpf, valor_campo_cpf, campo_evt, valor_campo_evt, obs from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT id_log, data_hora, ip, id_usuario, cod_usuario, modulo, aplicacao, tabela, acao, campo_id, valor_campo_id, campo_cpf, valor_campo_cpf, campo_evt, valor_campo_evt, obs from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_log, data_hora, ip, id_usuario, cod_usuario, modulo, aplicacao, tabela, acao, campo_id, valor_campo_id, campo_cpf, valor_campo_cpf, campo_evt, valor_campo_evt, obs from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['order_grid'];
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
         $this->id_log = $rs->fields[0] ;  
         $this->id_log = (string)$this->id_log;
         $this->data_hora = $rs->fields[1] ;  
         $this->ip = $rs->fields[2] ;  
         $this->id_usuario = $rs->fields[3] ;  
         $this->id_usuario = (string)$this->id_usuario;
         $this->cod_usuario = $rs->fields[4] ;  
         $this->modulo = $rs->fields[5] ;  
         $this->aplicacao = $rs->fields[6] ;  
         $this->tabela = $rs->fields[7] ;  
         $this->acao = $rs->fields[8] ;  
         $this->campo_id = $rs->fields[9] ;  
         $this->valor_campo_id = $rs->fields[10] ;  
         $this->campo_cpf = $rs->fields[11] ;  
         $this->valor_campo_cpf = $rs->fields[12] ;  
         $this->campo_evt = $rs->fields[13] ;  
         $this->valor_campo_evt = $rs->fields[14] ;  
         $this->obs = $rs->fields[15] ;  
         $this->sc_proc_grid = true; 
         //----- lookup - usuario_nome
         $this->Lookup->lookup_usuario_nome($this->usuario_nome, $this->id_usuario, $this->array_usuario_nome); 
         $this->usuario_nome = str_replace("<br>", " ", $this->usuario_nome); 
         $this->usuario_nome = ($this->usuario_nome == "&nbsp;") ? "" : $this->usuario_nome; 
         //----- lookup - participante_nome
         $this->Lookup->lookup_participante_nome($this->participante_nome, $this->valor_campo_cpf, $this->array_participante_nome); 
         $this->participante_nome = str_replace("<br>", " ", $this->participante_nome); 
         $this->participante_nome = ($this->participante_nome == "&nbsp;") ? "" : $this->participante_nome; 
         //----- lookup - evento_dsc
         $this->Lookup->lookup_evento_dsc($this->evento_dsc, $this->valor_campo_evt, $this->array_evento_dsc); 
         $this->evento_dsc = str_replace("<br>", " ", $this->evento_dsc); 
         $this->evento_dsc = ($this->evento_dsc == "&nbsp;") ? "" : $this->evento_dsc; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- id_log
   function NM_export_id_log()
   {
             nmgp_Form_Num_Val($this->id_log, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->id_log = NM_charset_to_utf8($this->id_log);
         $this->id_log = str_replace('<', '&lt;', $this->id_log);
         $this->id_log = str_replace('>', '&gt;', $this->id_log);
         $this->Texto_tag .= "<td>" . $this->id_log . "</td>\r\n";
   }
   //----- data_hora
   function NM_export_data_hora()
   {
             if (substr($this->data_hora, 10, 1) == "-") 
             { 
                 $this->data_hora = substr($this->data_hora, 0, 10) . " " . substr($this->data_hora, 11);
             } 
             if (substr($this->data_hora, 13, 1) == ".") 
             { 
                $this->data_hora = substr($this->data_hora, 0, 13) . ":" . substr($this->data_hora, 14, 2) . ":" . substr($this->data_hora, 17);
             } 
             $conteudo_x =  $this->data_hora;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_hora, "YYYY-MM-DD HH:II:SS  ");
                 $this->data_hora = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->data_hora = NM_charset_to_utf8($this->data_hora);
         $this->data_hora = str_replace('<', '&lt;', $this->data_hora);
         $this->data_hora = str_replace('>', '&gt;', $this->data_hora);
         $this->Texto_tag .= "<td>" . $this->data_hora . "</td>\r\n";
   }
   //----- ip
   function NM_export_ip()
   {
         $this->ip = html_entity_decode($this->ip, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ip = strip_tags($this->ip);
         $this->ip = NM_charset_to_utf8($this->ip);
         $this->ip = str_replace('<', '&lt;', $this->ip);
         $this->ip = str_replace('>', '&gt;', $this->ip);
         $this->Texto_tag .= "<td>" . $this->ip . "</td>\r\n";
   }
   //----- id_usuario
   function NM_export_id_usuario()
   {
             nmgp_Form_Num_Val($this->id_usuario, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->id_usuario = NM_charset_to_utf8($this->id_usuario);
         $this->id_usuario = str_replace('<', '&lt;', $this->id_usuario);
         $this->id_usuario = str_replace('>', '&gt;', $this->id_usuario);
         $this->Texto_tag .= "<td>" . $this->id_usuario . "</td>\r\n";
   }
   //----- cod_usuario
   function NM_export_cod_usuario()
   {
         $this->cod_usuario = html_entity_decode($this->cod_usuario, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cod_usuario = strip_tags($this->cod_usuario);
         $this->cod_usuario = NM_charset_to_utf8($this->cod_usuario);
         $this->cod_usuario = str_replace('<', '&lt;', $this->cod_usuario);
         $this->cod_usuario = str_replace('>', '&gt;', $this->cod_usuario);
         $this->Texto_tag .= "<td>" . $this->cod_usuario . "</td>\r\n";
   }
   //----- usuario_nome
   function NM_export_usuario_nome()
   {
         $this->usuario_nome = NM_charset_to_utf8($this->usuario_nome);
         $this->usuario_nome = str_replace('<', '&lt;', $this->usuario_nome);
         $this->usuario_nome = str_replace('>', '&gt;', $this->usuario_nome);
         $this->Texto_tag .= "<td>" . $this->usuario_nome . "</td>\r\n";
   }
   //----- modulo
   function NM_export_modulo()
   {
         $this->modulo = html_entity_decode($this->modulo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->modulo = strip_tags($this->modulo);
         $this->modulo = NM_charset_to_utf8($this->modulo);
         $this->modulo = str_replace('<', '&lt;', $this->modulo);
         $this->modulo = str_replace('>', '&gt;', $this->modulo);
         $this->Texto_tag .= "<td>" . $this->modulo . "</td>\r\n";
   }
   //----- aplicacao
   function NM_export_aplicacao()
   {
         $this->aplicacao = html_entity_decode($this->aplicacao, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->aplicacao = strip_tags($this->aplicacao);
         $this->aplicacao = NM_charset_to_utf8($this->aplicacao);
         $this->aplicacao = str_replace('<', '&lt;', $this->aplicacao);
         $this->aplicacao = str_replace('>', '&gt;', $this->aplicacao);
         $this->Texto_tag .= "<td>" . $this->aplicacao . "</td>\r\n";
   }
   //----- tabela
   function NM_export_tabela()
   {
         $this->tabela = html_entity_decode($this->tabela, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tabela = strip_tags($this->tabela);
         $this->tabela = NM_charset_to_utf8($this->tabela);
         $this->tabela = str_replace('<', '&lt;', $this->tabela);
         $this->tabela = str_replace('>', '&gt;', $this->tabela);
         $this->Texto_tag .= "<td>" . $this->tabela . "</td>\r\n";
   }
   //----- acao
   function NM_export_acao()
   {
         $this->acao = html_entity_decode($this->acao, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acao = strip_tags($this->acao);
         $this->acao = NM_charset_to_utf8($this->acao);
         $this->acao = str_replace('<', '&lt;', $this->acao);
         $this->acao = str_replace('>', '&gt;', $this->acao);
         $this->Texto_tag .= "<td>" . $this->acao . "</td>\r\n";
   }
   //----- campo_id
   function NM_export_campo_id()
   {
         $this->campo_id = html_entity_decode($this->campo_id, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->campo_id = strip_tags($this->campo_id);
         $this->campo_id = NM_charset_to_utf8($this->campo_id);
         $this->campo_id = str_replace('<', '&lt;', $this->campo_id);
         $this->campo_id = str_replace('>', '&gt;', $this->campo_id);
         $this->Texto_tag .= "<td>" . $this->campo_id . "</td>\r\n";
   }
   //----- valor_campo_id
   function NM_export_valor_campo_id()
   {
         $this->valor_campo_id = html_entity_decode($this->valor_campo_id, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->valor_campo_id = strip_tags($this->valor_campo_id);
         $this->valor_campo_id = NM_charset_to_utf8($this->valor_campo_id);
         $this->valor_campo_id = str_replace('<', '&lt;', $this->valor_campo_id);
         $this->valor_campo_id = str_replace('>', '&gt;', $this->valor_campo_id);
         $this->Texto_tag .= "<td>" . $this->valor_campo_id . "</td>\r\n";
   }
   //----- campo_cpf
   function NM_export_campo_cpf()
   {
         $this->campo_cpf = html_entity_decode($this->campo_cpf, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->campo_cpf = strip_tags($this->campo_cpf);
         $this->campo_cpf = NM_charset_to_utf8($this->campo_cpf);
         $this->campo_cpf = str_replace('<', '&lt;', $this->campo_cpf);
         $this->campo_cpf = str_replace('>', '&gt;', $this->campo_cpf);
         $this->Texto_tag .= "<td>" . $this->campo_cpf . "</td>\r\n";
   }
   //----- valor_campo_cpf
   function NM_export_valor_campo_cpf()
   {
         $this->valor_campo_cpf = html_entity_decode($this->valor_campo_cpf, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->valor_campo_cpf = strip_tags($this->valor_campo_cpf);
         $this->valor_campo_cpf = NM_charset_to_utf8($this->valor_campo_cpf);
         $this->valor_campo_cpf = str_replace('<', '&lt;', $this->valor_campo_cpf);
         $this->valor_campo_cpf = str_replace('>', '&gt;', $this->valor_campo_cpf);
         $this->Texto_tag .= "<td>" . $this->valor_campo_cpf . "</td>\r\n";
   }
   //----- participante_nome
   function NM_export_participante_nome()
   {
         $this->participante_nome = NM_charset_to_utf8($this->participante_nome);
         $this->participante_nome = str_replace('<', '&lt;', $this->participante_nome);
         $this->participante_nome = str_replace('>', '&gt;', $this->participante_nome);
         $this->Texto_tag .= "<td>" . $this->participante_nome . "</td>\r\n";
   }
   //----- campo_evt
   function NM_export_campo_evt()
   {
         $this->campo_evt = html_entity_decode($this->campo_evt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->campo_evt = strip_tags($this->campo_evt);
         $this->campo_evt = NM_charset_to_utf8($this->campo_evt);
         $this->campo_evt = str_replace('<', '&lt;', $this->campo_evt);
         $this->campo_evt = str_replace('>', '&gt;', $this->campo_evt);
         $this->Texto_tag .= "<td>" . $this->campo_evt . "</td>\r\n";
   }
   //----- valor_campo_evt
   function NM_export_valor_campo_evt()
   {
         $this->valor_campo_evt = html_entity_decode($this->valor_campo_evt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->valor_campo_evt = strip_tags($this->valor_campo_evt);
         $this->valor_campo_evt = NM_charset_to_utf8($this->valor_campo_evt);
         $this->valor_campo_evt = str_replace('<', '&lt;', $this->valor_campo_evt);
         $this->valor_campo_evt = str_replace('>', '&gt;', $this->valor_campo_evt);
         $this->Texto_tag .= "<td>" . $this->valor_campo_evt . "</td>\r\n";
   }
   //----- evento_dsc
   function NM_export_evento_dsc()
   {
         $this->evento_dsc = NM_charset_to_utf8($this->evento_dsc);
         $this->evento_dsc = str_replace('<', '&lt;', $this->evento_dsc);
         $this->evento_dsc = str_replace('>', '&gt;', $this->evento_dsc);
         $this->Texto_tag .= "<td>" . $this->evento_dsc . "</td>\r\n";
   }
   //----- obs
   function NM_export_obs()
   {
         $this->obs = html_entity_decode($this->obs, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->obs = strip_tags($this->obs);
         $this->obs = NM_charset_to_utf8($this->obs);
         $this->obs = str_replace('<', '&lt;', $this->obs);
         $this->obs = str_replace('>', '&gt;', $this->obs);
         $this->Texto_tag .= "<td>" . $this->obs . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_rsvp_log_id'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>RSVP LOG de Atividades :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_rsvp_log_id_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_rsvp_log_id"> 
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
