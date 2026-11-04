<?php

class grid_modelo_mailling_rsvp_rtf
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
                   nm_limpa_str_grid_modelo_mailling_rsvp($cadapar[1]);
                   nm_protect_num_grid_modelo_mailling_rsvp($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_modelo_mailling_rsvp']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_modelo_mailling_rsvp_total.class.php"); 
      $this->Tot      = new grid_modelo_mailling_rsvp_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_modelo_mailling_rsvp']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_modelo_mailling_rsvp";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_modelo_mailling_rsvp.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_modelo_mailling_rsvp']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_modelo_mailling_rsvp']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_modelo_mailling_rsvp']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->rg = (isset($Busca_temp['rg'])) ? $Busca_temp['rg'] : ""; 
          $tmp_pos = (is_string($this->rg)) ? strpos($this->rg, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->rg))
          {
              $this->rg = substr($this->rg, 0, $tmp_pos);
          }
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_modelo_mailling_rsvp']['contr_erro'] = 'on';
 $sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['grid_modelo_mailling_rsvp']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['codigo_evento'])) ? $this->New_label['codigo_evento'] : "Codigo Evento"; 
          if ($Cada_col == "codigo_evento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['cpf'])) ? $this->New_label['cpf'] : "CPF"; 
          if ($Cada_col == "cpf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['tipo_documento'])) ? $this->New_label['tipo_documento'] : "Tipo Documento"; 
          if ($Cada_col == "tipo_documento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['data_nascimento'])) ? $this->New_label['data_nascimento'] : "Data Nascimento"; 
          if ($Cada_col == "data_nascimento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nome_participante'])) ? $this->New_label['nome_participante'] : "Nome Participante"; 
          if ($Cada_col == "nome_participante" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['email'])) ? $this->New_label['email'] : "Email"; 
          if ($Cada_col == "email" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['codigo_publico'])) ? $this->New_label['codigo_publico'] : "Codigo Publico"; 
          if ($Cada_col == "codigo_publico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['codigo_regional'])) ? $this->New_label['codigo_regional'] : "Codigo Regional"; 
          if ($Cada_col == "codigo_regional" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['ddd_celular'])) ? $this->New_label['ddd_celular'] : "Ddd Celular"; 
          if ($Cada_col == "ddd_celular" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['ddd_fixo'])) ? $this->New_label['ddd_fixo'] : "Ddd Fixo"; 
          if ($Cada_col == "ddd_fixo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['fone_fixo'])) ? $this->New_label['fone_fixo'] : "Fone Fixo"; 
          if ($Cada_col == "fone_fixo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['clube'])) ? $this->New_label['clube'] : "Clube"; 
          if ($Cada_col == "clube" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['sexo'])) ? $this->New_label['sexo'] : "Sexo"; 
          if ($Cada_col == "sexo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cod_empresa_evento'])) ? $this->New_label['cod_empresa_evento'] : "Cód. Empresa Evento"; 
          if ($Cada_col == "cod_empresa_evento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['codigo_telefone_pais'])) ? $this->New_label['codigo_telefone_pais'] : "Codigo Telefone Pais"; 
          if ($Cada_col == "codigo_telefone_pais" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['papel'])) ? $this->New_label['papel'] : "Papel Status APP"; 
          if ($Cada_col == "papel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['uid_pulseira_nfc'])) ? $this->New_label['uid_pulseira_nfc'] : "Cód. Pulseira NFC"; 
          if ($Cada_col == "uid_pulseira_nfc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['emissao_passaporte'])) ? $this->New_label['emissao_passaporte'] : "Emisão Passaporte"; 
          if ($Cada_col == "emissao_passaporte" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['validade_passaporte'])) ? $this->New_label['validade_passaporte'] : "Validade Passaporte"; 
          if ($Cada_col == "validade_passaporte" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['numero_do_visto'])) ? $this->New_label['numero_do_visto'] : "Número do Visto"; 
          if ($Cada_col == "numero_do_visto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['validade_do_visto'])) ? $this->New_label['validade_do_visto'] : "Validade do Visto"; 
          if ($Cada_col == "validade_do_visto" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['vacina_febre_amarela'])) ? $this->New_label['vacina_febre_amarela'] : "Vacina Febre Amarela"; 
          if ($Cada_col == "vacina_febre_amarela" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['estrangeiro'])) ? $this->New_label['estrangeiro'] : "É Estrangeiro"; 
          if ($Cada_col == "estrangeiro" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['idioma_preferido'])) ? $this->New_label['idioma_preferido'] : "Idioma Preferido"; 
          if ($Cada_col == "idioma_preferido" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['restricoes_alimentares'])) ? $this->New_label['restricoes_alimentares'] : "Restrições  Alimentares"; 
          if ($Cada_col == "restricoes_alimentares" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['restricoes_mobilidade'])) ? $this->New_label['restricoes_mobilidade'] : "Restrições Mobilidade"; 
          if ($Cada_col == "restricoes_mobilidade" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cep'])) ? $this->New_label['cep'] : "Cep"; 
          if ($Cada_col == "cep" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['rua'])) ? $this->New_label['rua'] : "Rua"; 
          if ($Cada_col == "rua" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['numero'])) ? $this->New_label['numero'] : "Número"; 
          if ($Cada_col == "numero" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['complemento'])) ? $this->New_label['complemento'] : "Complemento"; 
          if ($Cada_col == "complemento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['bairro'])) ? $this->New_label['bairro'] : "Bairro"; 
          if ($Cada_col == "bairro" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cidade'])) ? $this->New_label['cidade'] : "Cidade"; 
          if ($Cada_col == "cidade" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['estado'])) ? $this->New_label['estado'] : "Estado"; 
          if ($Cada_col == "estado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['pais'])) ? $this->New_label['pais'] : "Pais"; 
          if ($Cada_col == "pais" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nacionalidade'])) ? $this->New_label['nacionalidade'] : "Nacionalidade"; 
          if ($Cada_col == "nacionalidade" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT codigo_evento, rg, cpf, tipo_documento, data_nascimento, nome_participante, email, codigo_publico, codigo_regional, ddd_celular, celular, ddd_fixo, fone_fixo, empresa, grupo, clube, sexo, cod_empresa_evento, codigo_telefone_pais, papel, uid_pulseira_nfc, passaporte, emissao_passaporte, validade_passaporte, numero_do_visto, validade_do_visto, vacina_febre_amarela, estrangeiro, idioma_preferido, restricoes_alimentares, restricoes_mobilidade, cep, rua, numero, complemento, bairro, cidade, estado, pais, nacionalidade from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT codigo_evento, rg, cpf, tipo_documento, data_nascimento, nome_participante, email, codigo_publico, codigo_regional, ddd_celular, celular, ddd_fixo, fone_fixo, empresa, grupo, clube, sexo, cod_empresa_evento, codigo_telefone_pais, papel, uid_pulseira_nfc, passaporte, emissao_passaporte, validade_passaporte, numero_do_visto, validade_do_visto, vacina_febre_amarela, estrangeiro, idioma_preferido, restricoes_alimentares, restricoes_mobilidade, cep, rua, numero, complemento, bairro, cidade, estado, pais, nacionalidade from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT codigo_evento, rg, cpf, tipo_documento, data_nascimento, nome_participante, email, codigo_publico, codigo_regional, ddd_celular, celular, ddd_fixo, fone_fixo, empresa, grupo, clube, sexo, cod_empresa_evento, codigo_telefone_pais, papel, uid_pulseira_nfc, passaporte, emissao_passaporte, validade_passaporte, numero_do_visto, validade_do_visto, vacina_febre_amarela, estrangeiro, idioma_preferido, restricoes_alimentares, restricoes_mobilidade, cep, rua, numero, complemento, bairro, cidade, estado, pais, nacionalidade from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT codigo_evento, rg, cpf, tipo_documento, data_nascimento, nome_participante, email, codigo_publico, codigo_regional, ddd_celular, celular, ddd_fixo, fone_fixo, empresa, grupo, clube, sexo, cod_empresa_evento, codigo_telefone_pais, papel, uid_pulseira_nfc, passaporte, emissao_passaporte, validade_passaporte, numero_do_visto, validade_do_visto, vacina_febre_amarela, estrangeiro, idioma_preferido, restricoes_alimentares, restricoes_mobilidade, cep, rua, numero, complemento, bairro, cidade, estado, pais, nacionalidade from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT codigo_evento, rg, cpf, tipo_documento, data_nascimento, nome_participante, email, codigo_publico, codigo_regional, ddd_celular, celular, ddd_fixo, fone_fixo, empresa, grupo, clube, sexo, cod_empresa_evento, codigo_telefone_pais, papel, uid_pulseira_nfc, passaporte, emissao_passaporte, validade_passaporte, numero_do_visto, validade_do_visto, vacina_febre_amarela, estrangeiro, idioma_preferido, restricoes_alimentares, restricoes_mobilidade, cep, rua, numero, complemento, bairro, cidade, estado, pais, nacionalidade from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT codigo_evento, rg, cpf, tipo_documento, data_nascimento, nome_participante, email, codigo_publico, codigo_regional, ddd_celular, celular, ddd_fixo, fone_fixo, empresa, grupo, clube, sexo, cod_empresa_evento, codigo_telefone_pais, papel, uid_pulseira_nfc, passaporte, emissao_passaporte, validade_passaporte, numero_do_visto, validade_do_visto, vacina_febre_amarela, estrangeiro, idioma_preferido, restricoes_alimentares, restricoes_mobilidade, cep, rua, numero, complemento, bairro, cidade, estado, pais, nacionalidade from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['order_grid'];
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
         $this->codigo_evento = $rs->fields[0] ;  
         $this->rg = $rs->fields[1] ;  
         $this->cpf = $rs->fields[2] ;  
         $this->tipo_documento = $rs->fields[3] ;  
         $this->data_nascimento = $rs->fields[4] ;  
         $this->nome_participante = $rs->fields[5] ;  
         $this->email = $rs->fields[6] ;  
         $this->codigo_publico = $rs->fields[7] ;  
         $this->codigo_regional = $rs->fields[8] ;  
         $this->ddd_celular = $rs->fields[9] ;  
         $this->celular = $rs->fields[10] ;  
         $this->ddd_fixo = $rs->fields[11] ;  
         $this->fone_fixo = $rs->fields[12] ;  
         $this->empresa = $rs->fields[13] ;  
         $this->grupo = $rs->fields[14] ;  
         $this->clube = $rs->fields[15] ;  
         $this->sexo = $rs->fields[16] ;  
         $this->cod_empresa_evento = $rs->fields[17] ;  
         $this->codigo_telefone_pais = $rs->fields[18] ;  
         $this->papel = $rs->fields[19] ;  
         $this->uid_pulseira_nfc = $rs->fields[20] ;  
         $this->passaporte = $rs->fields[21] ;  
         $this->emissao_passaporte = $rs->fields[22] ;  
         $this->validade_passaporte = $rs->fields[23] ;  
         $this->numero_do_visto = $rs->fields[24] ;  
         $this->validade_do_visto = $rs->fields[25] ;  
         $this->vacina_febre_amarela = $rs->fields[26] ;  
         $this->estrangeiro = $rs->fields[27] ;  
         $this->idioma_preferido = $rs->fields[28] ;  
         $this->restricoes_alimentares = $rs->fields[29] ;  
         $this->restricoes_mobilidade = $rs->fields[30] ;  
         $this->cep = $rs->fields[31] ;  
         $this->rua = $rs->fields[32] ;  
         $this->numero = $rs->fields[33] ;  
         $this->complemento = $rs->fields[34] ;  
         $this->bairro = $rs->fields[35] ;  
         $this->cidade = $rs->fields[36] ;  
         $this->estado = $rs->fields[37] ;  
         $this->pais = $rs->fields[38] ;  
         $this->nacionalidade = $rs->fields[39] ;  
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- codigo_evento
   function NM_export_codigo_evento()
   {
         $this->codigo_evento = html_entity_decode($this->codigo_evento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->codigo_evento = strip_tags($this->codigo_evento);
         $this->codigo_evento = NM_charset_to_utf8($this->codigo_evento);
         $this->codigo_evento = str_replace('<', '&lt;', $this->codigo_evento);
         $this->codigo_evento = str_replace('>', '&gt;', $this->codigo_evento);
         $this->Texto_tag .= "<td>" . $this->codigo_evento . "</td>\r\n";
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
   //----- tipo_documento
   function NM_export_tipo_documento()
   {
         $this->tipo_documento = html_entity_decode($this->tipo_documento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_documento = strip_tags($this->tipo_documento);
         $this->tipo_documento = NM_charset_to_utf8($this->tipo_documento);
         $this->tipo_documento = str_replace('<', '&lt;', $this->tipo_documento);
         $this->tipo_documento = str_replace('>', '&gt;', $this->tipo_documento);
         $this->Texto_tag .= "<td>" . $this->tipo_documento . "</td>\r\n";
   }
   //----- data_nascimento
   function NM_export_data_nascimento()
   {
         $this->data_nascimento = html_entity_decode($this->data_nascimento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->data_nascimento = strip_tags($this->data_nascimento);
         $this->data_nascimento = NM_charset_to_utf8($this->data_nascimento);
         $this->data_nascimento = str_replace('<', '&lt;', $this->data_nascimento);
         $this->data_nascimento = str_replace('>', '&gt;', $this->data_nascimento);
         $this->Texto_tag .= "<td>" . $this->data_nascimento . "</td>\r\n";
   }
   //----- nome_participante
   function NM_export_nome_participante()
   {
         $this->nome_participante = html_entity_decode($this->nome_participante, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nome_participante = strip_tags($this->nome_participante);
         $this->nome_participante = NM_charset_to_utf8($this->nome_participante);
         $this->nome_participante = str_replace('<', '&lt;', $this->nome_participante);
         $this->nome_participante = str_replace('>', '&gt;', $this->nome_participante);
         $this->Texto_tag .= "<td>" . $this->nome_participante . "</td>\r\n";
   }
   //----- email
   function NM_export_email()
   {
         $this->email = html_entity_decode($this->email, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->email = strip_tags($this->email);
         $this->email = NM_charset_to_utf8($this->email);
         $this->email = str_replace('<', '&lt;', $this->email);
         $this->email = str_replace('>', '&gt;', $this->email);
         $this->Texto_tag .= "<td>" . $this->email . "</td>\r\n";
   }
   //----- codigo_publico
   function NM_export_codigo_publico()
   {
         $this->codigo_publico = html_entity_decode($this->codigo_publico, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->codigo_publico = strip_tags($this->codigo_publico);
         $this->codigo_publico = NM_charset_to_utf8($this->codigo_publico);
         $this->codigo_publico = str_replace('<', '&lt;', $this->codigo_publico);
         $this->codigo_publico = str_replace('>', '&gt;', $this->codigo_publico);
         $this->Texto_tag .= "<td>" . $this->codigo_publico . "</td>\r\n";
   }
   //----- codigo_regional
   function NM_export_codigo_regional()
   {
         $this->codigo_regional = html_entity_decode($this->codigo_regional, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->codigo_regional = strip_tags($this->codigo_regional);
         $this->codigo_regional = NM_charset_to_utf8($this->codigo_regional);
         $this->codigo_regional = str_replace('<', '&lt;', $this->codigo_regional);
         $this->codigo_regional = str_replace('>', '&gt;', $this->codigo_regional);
         $this->Texto_tag .= "<td>" . $this->codigo_regional . "</td>\r\n";
   }
   //----- ddd_celular
   function NM_export_ddd_celular()
   {
         $this->ddd_celular = html_entity_decode($this->ddd_celular, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ddd_celular = strip_tags($this->ddd_celular);
         $this->ddd_celular = NM_charset_to_utf8($this->ddd_celular);
         $this->ddd_celular = str_replace('<', '&lt;', $this->ddd_celular);
         $this->ddd_celular = str_replace('>', '&gt;', $this->ddd_celular);
         $this->Texto_tag .= "<td>" . $this->ddd_celular . "</td>\r\n";
   }
   //----- celular
   function NM_export_celular()
   {
         $this->celular = html_entity_decode($this->celular, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->celular = strip_tags($this->celular);
         $this->celular = NM_charset_to_utf8($this->celular);
         $this->celular = str_replace('<', '&lt;', $this->celular);
         $this->celular = str_replace('>', '&gt;', $this->celular);
         $this->Texto_tag .= "<td>" . $this->celular . "</td>\r\n";
   }
   //----- ddd_fixo
   function NM_export_ddd_fixo()
   {
         $this->ddd_fixo = html_entity_decode($this->ddd_fixo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ddd_fixo = strip_tags($this->ddd_fixo);
         $this->ddd_fixo = NM_charset_to_utf8($this->ddd_fixo);
         $this->ddd_fixo = str_replace('<', '&lt;', $this->ddd_fixo);
         $this->ddd_fixo = str_replace('>', '&gt;', $this->ddd_fixo);
         $this->Texto_tag .= "<td>" . $this->ddd_fixo . "</td>\r\n";
   }
   //----- fone_fixo
   function NM_export_fone_fixo()
   {
         $this->fone_fixo = html_entity_decode($this->fone_fixo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->fone_fixo = strip_tags($this->fone_fixo);
         $this->fone_fixo = NM_charset_to_utf8($this->fone_fixo);
         $this->fone_fixo = str_replace('<', '&lt;', $this->fone_fixo);
         $this->fone_fixo = str_replace('>', '&gt;', $this->fone_fixo);
         $this->Texto_tag .= "<td>" . $this->fone_fixo . "</td>\r\n";
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
   //----- clube
   function NM_export_clube()
   {
         $this->clube = html_entity_decode($this->clube, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->clube = strip_tags($this->clube);
         $this->clube = NM_charset_to_utf8($this->clube);
         $this->clube = str_replace('<', '&lt;', $this->clube);
         $this->clube = str_replace('>', '&gt;', $this->clube);
         $this->Texto_tag .= "<td>" . $this->clube . "</td>\r\n";
   }
   //----- sexo
   function NM_export_sexo()
   {
         $this->sexo = html_entity_decode($this->sexo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->sexo = strip_tags($this->sexo);
         $this->sexo = NM_charset_to_utf8($this->sexo);
         $this->sexo = str_replace('<', '&lt;', $this->sexo);
         $this->sexo = str_replace('>', '&gt;', $this->sexo);
         $this->Texto_tag .= "<td>" . $this->sexo . "</td>\r\n";
   }
   //----- cod_empresa_evento
   function NM_export_cod_empresa_evento()
   {
         $this->cod_empresa_evento = html_entity_decode($this->cod_empresa_evento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cod_empresa_evento = strip_tags($this->cod_empresa_evento);
         $this->cod_empresa_evento = NM_charset_to_utf8($this->cod_empresa_evento);
         $this->cod_empresa_evento = str_replace('<', '&lt;', $this->cod_empresa_evento);
         $this->cod_empresa_evento = str_replace('>', '&gt;', $this->cod_empresa_evento);
         $this->Texto_tag .= "<td>" . $this->cod_empresa_evento . "</td>\r\n";
   }
   //----- codigo_telefone_pais
   function NM_export_codigo_telefone_pais()
   {
         $this->codigo_telefone_pais = html_entity_decode($this->codigo_telefone_pais, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->codigo_telefone_pais = strip_tags($this->codigo_telefone_pais);
         $this->codigo_telefone_pais = NM_charset_to_utf8($this->codigo_telefone_pais);
         $this->codigo_telefone_pais = str_replace('<', '&lt;', $this->codigo_telefone_pais);
         $this->codigo_telefone_pais = str_replace('>', '&gt;', $this->codigo_telefone_pais);
         $this->Texto_tag .= "<td>" . $this->codigo_telefone_pais . "</td>\r\n";
   }
   //----- papel
   function NM_export_papel()
   {
         $this->papel = html_entity_decode($this->papel, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->papel = strip_tags($this->papel);
         $this->papel = NM_charset_to_utf8($this->papel);
         $this->papel = str_replace('<', '&lt;', $this->papel);
         $this->papel = str_replace('>', '&gt;', $this->papel);
         $this->Texto_tag .= "<td>" . $this->papel . "</td>\r\n";
   }
   //----- uid_pulseira_nfc
   function NM_export_uid_pulseira_nfc()
   {
         $this->uid_pulseira_nfc = html_entity_decode($this->uid_pulseira_nfc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->uid_pulseira_nfc = strip_tags($this->uid_pulseira_nfc);
         $this->uid_pulseira_nfc = NM_charset_to_utf8($this->uid_pulseira_nfc);
         $this->uid_pulseira_nfc = str_replace('<', '&lt;', $this->uid_pulseira_nfc);
         $this->uid_pulseira_nfc = str_replace('>', '&gt;', $this->uid_pulseira_nfc);
         $this->Texto_tag .= "<td>" . $this->uid_pulseira_nfc . "</td>\r\n";
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
   //----- emissao_passaporte
   function NM_export_emissao_passaporte()
   {
         $this->emissao_passaporte = html_entity_decode($this->emissao_passaporte, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->emissao_passaporte = strip_tags($this->emissao_passaporte);
         $this->emissao_passaporte = NM_charset_to_utf8($this->emissao_passaporte);
         $this->emissao_passaporte = str_replace('<', '&lt;', $this->emissao_passaporte);
         $this->emissao_passaporte = str_replace('>', '&gt;', $this->emissao_passaporte);
         $this->Texto_tag .= "<td>" . $this->emissao_passaporte . "</td>\r\n";
   }
   //----- validade_passaporte
   function NM_export_validade_passaporte()
   {
         $this->validade_passaporte = html_entity_decode($this->validade_passaporte, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->validade_passaporte = strip_tags($this->validade_passaporte);
         $this->validade_passaporte = NM_charset_to_utf8($this->validade_passaporte);
         $this->validade_passaporte = str_replace('<', '&lt;', $this->validade_passaporte);
         $this->validade_passaporte = str_replace('>', '&gt;', $this->validade_passaporte);
         $this->Texto_tag .= "<td>" . $this->validade_passaporte . "</td>\r\n";
   }
   //----- numero_do_visto
   function NM_export_numero_do_visto()
   {
         $this->numero_do_visto = html_entity_decode($this->numero_do_visto, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->numero_do_visto = strip_tags($this->numero_do_visto);
         $this->numero_do_visto = NM_charset_to_utf8($this->numero_do_visto);
         $this->numero_do_visto = str_replace('<', '&lt;', $this->numero_do_visto);
         $this->numero_do_visto = str_replace('>', '&gt;', $this->numero_do_visto);
         $this->Texto_tag .= "<td>" . $this->numero_do_visto . "</td>\r\n";
   }
   //----- validade_do_visto
   function NM_export_validade_do_visto()
   {
         $this->validade_do_visto = html_entity_decode($this->validade_do_visto, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->validade_do_visto = strip_tags($this->validade_do_visto);
         $this->validade_do_visto = NM_charset_to_utf8($this->validade_do_visto);
         $this->validade_do_visto = str_replace('<', '&lt;', $this->validade_do_visto);
         $this->validade_do_visto = str_replace('>', '&gt;', $this->validade_do_visto);
         $this->Texto_tag .= "<td>" . $this->validade_do_visto . "</td>\r\n";
   }
   //----- vacina_febre_amarela
   function NM_export_vacina_febre_amarela()
   {
         $this->vacina_febre_amarela = html_entity_decode($this->vacina_febre_amarela, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->vacina_febre_amarela = strip_tags($this->vacina_febre_amarela);
         $this->vacina_febre_amarela = NM_charset_to_utf8($this->vacina_febre_amarela);
         $this->vacina_febre_amarela = str_replace('<', '&lt;', $this->vacina_febre_amarela);
         $this->vacina_febre_amarela = str_replace('>', '&gt;', $this->vacina_febre_amarela);
         $this->Texto_tag .= "<td>" . $this->vacina_febre_amarela . "</td>\r\n";
   }
   //----- estrangeiro
   function NM_export_estrangeiro()
   {
         $this->estrangeiro = html_entity_decode($this->estrangeiro, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->estrangeiro = strip_tags($this->estrangeiro);
         $this->estrangeiro = NM_charset_to_utf8($this->estrangeiro);
         $this->estrangeiro = str_replace('<', '&lt;', $this->estrangeiro);
         $this->estrangeiro = str_replace('>', '&gt;', $this->estrangeiro);
         $this->Texto_tag .= "<td>" . $this->estrangeiro . "</td>\r\n";
   }
   //----- idioma_preferido
   function NM_export_idioma_preferido()
   {
         $this->idioma_preferido = html_entity_decode($this->idioma_preferido, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->idioma_preferido = strip_tags($this->idioma_preferido);
         $this->idioma_preferido = NM_charset_to_utf8($this->idioma_preferido);
         $this->idioma_preferido = str_replace('<', '&lt;', $this->idioma_preferido);
         $this->idioma_preferido = str_replace('>', '&gt;', $this->idioma_preferido);
         $this->Texto_tag .= "<td>" . $this->idioma_preferido . "</td>\r\n";
   }
   //----- restricoes_alimentares
   function NM_export_restricoes_alimentares()
   {
         $this->restricoes_alimentares = html_entity_decode($this->restricoes_alimentares, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->restricoes_alimentares = strip_tags($this->restricoes_alimentares);
         $this->restricoes_alimentares = NM_charset_to_utf8($this->restricoes_alimentares);
         $this->restricoes_alimentares = str_replace('<', '&lt;', $this->restricoes_alimentares);
         $this->restricoes_alimentares = str_replace('>', '&gt;', $this->restricoes_alimentares);
         $this->Texto_tag .= "<td>" . $this->restricoes_alimentares . "</td>\r\n";
   }
   //----- restricoes_mobilidade
   function NM_export_restricoes_mobilidade()
   {
         $this->restricoes_mobilidade = html_entity_decode($this->restricoes_mobilidade, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->restricoes_mobilidade = strip_tags($this->restricoes_mobilidade);
         $this->restricoes_mobilidade = NM_charset_to_utf8($this->restricoes_mobilidade);
         $this->restricoes_mobilidade = str_replace('<', '&lt;', $this->restricoes_mobilidade);
         $this->restricoes_mobilidade = str_replace('>', '&gt;', $this->restricoes_mobilidade);
         $this->Texto_tag .= "<td>" . $this->restricoes_mobilidade . "</td>\r\n";
   }
   //----- cep
   function NM_export_cep()
   {
         $this->cep = html_entity_decode($this->cep, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cep = strip_tags($this->cep);
         $this->cep = NM_charset_to_utf8($this->cep);
         $this->cep = str_replace('<', '&lt;', $this->cep);
         $this->cep = str_replace('>', '&gt;', $this->cep);
         $this->Texto_tag .= "<td>" . $this->cep . "</td>\r\n";
   }
   //----- rua
   function NM_export_rua()
   {
         $this->rua = html_entity_decode($this->rua, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->rua = strip_tags($this->rua);
         $this->rua = NM_charset_to_utf8($this->rua);
         $this->rua = str_replace('<', '&lt;', $this->rua);
         $this->rua = str_replace('>', '&gt;', $this->rua);
         $this->Texto_tag .= "<td>" . $this->rua . "</td>\r\n";
   }
   //----- numero
   function NM_export_numero()
   {
         $this->numero = html_entity_decode($this->numero, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->numero = strip_tags($this->numero);
         $this->numero = NM_charset_to_utf8($this->numero);
         $this->numero = str_replace('<', '&lt;', $this->numero);
         $this->numero = str_replace('>', '&gt;', $this->numero);
         $this->Texto_tag .= "<td>" . $this->numero . "</td>\r\n";
   }
   //----- complemento
   function NM_export_complemento()
   {
         $this->complemento = html_entity_decode($this->complemento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->complemento = strip_tags($this->complemento);
         $this->complemento = NM_charset_to_utf8($this->complemento);
         $this->complemento = str_replace('<', '&lt;', $this->complemento);
         $this->complemento = str_replace('>', '&gt;', $this->complemento);
         $this->Texto_tag .= "<td>" . $this->complemento . "</td>\r\n";
   }
   //----- bairro
   function NM_export_bairro()
   {
         $this->bairro = html_entity_decode($this->bairro, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->bairro = strip_tags($this->bairro);
         $this->bairro = NM_charset_to_utf8($this->bairro);
         $this->bairro = str_replace('<', '&lt;', $this->bairro);
         $this->bairro = str_replace('>', '&gt;', $this->bairro);
         $this->Texto_tag .= "<td>" . $this->bairro . "</td>\r\n";
   }
   //----- cidade
   function NM_export_cidade()
   {
         $this->cidade = html_entity_decode($this->cidade, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cidade = strip_tags($this->cidade);
         $this->cidade = NM_charset_to_utf8($this->cidade);
         $this->cidade = str_replace('<', '&lt;', $this->cidade);
         $this->cidade = str_replace('>', '&gt;', $this->cidade);
         $this->Texto_tag .= "<td>" . $this->cidade . "</td>\r\n";
   }
   //----- estado
   function NM_export_estado()
   {
         $this->estado = html_entity_decode($this->estado, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->estado = strip_tags($this->estado);
         $this->estado = NM_charset_to_utf8($this->estado);
         $this->estado = str_replace('<', '&lt;', $this->estado);
         $this->estado = str_replace('>', '&gt;', $this->estado);
         $this->Texto_tag .= "<td>" . $this->estado . "</td>\r\n";
   }
   //----- pais
   function NM_export_pais()
   {
         $this->pais = html_entity_decode($this->pais, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pais = strip_tags($this->pais);
         $this->pais = NM_charset_to_utf8($this->pais);
         $this->pais = str_replace('<', '&lt;', $this->pais);
         $this->pais = str_replace('>', '&gt;', $this->pais);
         $this->Texto_tag .= "<td>" . $this->pais . "</td>\r\n";
   }
   //----- nacionalidade
   function NM_export_nacionalidade()
   {
         $this->nacionalidade = html_entity_decode($this->nacionalidade, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nacionalidade = strip_tags($this->nacionalidade);
         $this->nacionalidade = NM_charset_to_utf8($this->nacionalidade);
         $this->nacionalidade = str_replace('<', '&lt;', $this->nacionalidade);
         $this->nacionalidade = str_replace('>', '&gt;', $this->nacionalidade);
         $this->Texto_tag .= "<td>" . $this->nacionalidade . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Modelo de Mailing :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_modelo_mailling_rsvp_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_modelo_mailling_rsvp"> 
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
