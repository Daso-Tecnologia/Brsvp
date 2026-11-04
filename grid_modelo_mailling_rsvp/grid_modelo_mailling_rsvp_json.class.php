<?php

class grid_modelo_mailling_rsvp_json
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['embutida'])
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['opcao'] = "";
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['SC_Gb_Free_cmp']))
      {
          $this->Tem_json_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_modelo_mailling_rsvp/grid_modelo_mailling_rsvp_res_json.class.php"))
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_label']))
      {
          $this->Json_use_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_label'];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_format']))
      {
          $this->Json_format = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_format'];
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_modelo_mailling_rsvp_total.class.php"); 
      $this->Tot = new grid_modelo_mailling_rsvp_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_modelo_mailling_rsvp']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_return']);
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
      $this->Arq_zip      = $this->Arquivo . "_grid_modelo_mailling_rsvp.zip";
      $this->Arquivo     .= "_grid_modelo_mailling_rsvp";
      $this->Arquivo     .= ".json";
      $this->Tit_doc      = "grid_modelo_mailling_rsvp.json";
      $this->Tit_zip      = "grid_modelo_mailling_rsvp.zip";
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
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['embutida'])
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
      $this->json_registro = array();
      $this->SC_seq_json   = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
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
         $this->SC_seq_json++;
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['embutida'])
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
              require_once($this->Ini->path_aplicacao . "grid_modelo_mailling_rsvp_res_json.class.php");
              $this->Res = new grid_modelo_mailling_rsvp_res_json();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_res_grid'] = true;
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
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_res_file']['json'];
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_res_file']['json']);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_res_grid']);
          } 
      }
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
         $this->codigo_evento = NM_charset_to_utf8($this->codigo_evento);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['codigo_evento'])) ? $this->New_label['codigo_evento'] : "Codigo Evento"; 
         }
         else
         {
             $SC_Label = "codigo_evento"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->codigo_evento;
   }
   //----- rg
   function NM_export_rg()
   {
         $this->rg = NM_charset_to_utf8($this->rg);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rg'])) ? $this->New_label['rg'] : "RG"; 
         }
         else
         {
             $SC_Label = "rg"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rg;
   }
   //----- cpf
   function NM_export_cpf()
   {
         $this->cpf = NM_charset_to_utf8($this->cpf);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['cpf'])) ? $this->New_label['cpf'] : "CPF"; 
         }
         else
         {
             $SC_Label = "cpf"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->cpf;
   }
   //----- tipo_documento
   function NM_export_tipo_documento()
   {
         $this->tipo_documento = NM_charset_to_utf8($this->tipo_documento);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tipo_documento'])) ? $this->New_label['tipo_documento'] : "Tipo Documento"; 
         }
         else
         {
             $SC_Label = "tipo_documento"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tipo_documento;
   }
   //----- data_nascimento
   function NM_export_data_nascimento()
   {
         $this->data_nascimento = NM_charset_to_utf8($this->data_nascimento);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['data_nascimento'])) ? $this->New_label['data_nascimento'] : "Data Nascimento"; 
         }
         else
         {
             $SC_Label = "data_nascimento"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->data_nascimento;
   }
   //----- nome_participante
   function NM_export_nome_participante()
   {
         $this->nome_participante = NM_charset_to_utf8($this->nome_participante);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['nome_participante'])) ? $this->New_label['nome_participante'] : "Nome Participante"; 
         }
         else
         {
             $SC_Label = "nome_participante"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->nome_participante;
   }
   //----- email
   function NM_export_email()
   {
         $this->email = NM_charset_to_utf8($this->email);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['email'])) ? $this->New_label['email'] : "Email"; 
         }
         else
         {
             $SC_Label = "email"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->email;
   }
   //----- codigo_publico
   function NM_export_codigo_publico()
   {
         $this->codigo_publico = NM_charset_to_utf8($this->codigo_publico);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['codigo_publico'])) ? $this->New_label['codigo_publico'] : "Codigo Publico"; 
         }
         else
         {
             $SC_Label = "codigo_publico"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->codigo_publico;
   }
   //----- codigo_regional
   function NM_export_codigo_regional()
   {
         $this->codigo_regional = NM_charset_to_utf8($this->codigo_regional);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['codigo_regional'])) ? $this->New_label['codigo_regional'] : "Codigo Regional"; 
         }
         else
         {
             $SC_Label = "codigo_regional"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->codigo_regional;
   }
   //----- ddd_celular
   function NM_export_ddd_celular()
   {
         $this->ddd_celular = NM_charset_to_utf8($this->ddd_celular);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ddd_celular'])) ? $this->New_label['ddd_celular'] : "Ddd Celular"; 
         }
         else
         {
             $SC_Label = "ddd_celular"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ddd_celular;
   }
   //----- celular
   function NM_export_celular()
   {
         $this->celular = NM_charset_to_utf8($this->celular);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['celular'])) ? $this->New_label['celular'] : "Celular"; 
         }
         else
         {
             $SC_Label = "celular"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->celular;
   }
   //----- ddd_fixo
   function NM_export_ddd_fixo()
   {
         $this->ddd_fixo = NM_charset_to_utf8($this->ddd_fixo);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['ddd_fixo'])) ? $this->New_label['ddd_fixo'] : "Ddd Fixo"; 
         }
         else
         {
             $SC_Label = "ddd_fixo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->ddd_fixo;
   }
   //----- fone_fixo
   function NM_export_fone_fixo()
   {
         $this->fone_fixo = NM_charset_to_utf8($this->fone_fixo);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['fone_fixo'])) ? $this->New_label['fone_fixo'] : "Fone Fixo"; 
         }
         else
         {
             $SC_Label = "fone_fixo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->fone_fixo;
   }
   //----- empresa
   function NM_export_empresa()
   {
         $this->empresa = NM_charset_to_utf8($this->empresa);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['empresa'])) ? $this->New_label['empresa'] : "Empresa"; 
         }
         else
         {
             $SC_Label = "empresa"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->empresa;
   }
   //----- grupo
   function NM_export_grupo()
   {
         $this->grupo = NM_charset_to_utf8($this->grupo);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['grupo'])) ? $this->New_label['grupo'] : "Grupo"; 
         }
         else
         {
             $SC_Label = "grupo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->grupo;
   }
   //----- clube
   function NM_export_clube()
   {
         $this->clube = NM_charset_to_utf8($this->clube);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['clube'])) ? $this->New_label['clube'] : "Clube"; 
         }
         else
         {
             $SC_Label = "clube"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->clube;
   }
   //----- sexo
   function NM_export_sexo()
   {
         $this->sexo = NM_charset_to_utf8($this->sexo);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['sexo'])) ? $this->New_label['sexo'] : "Sexo"; 
         }
         else
         {
             $SC_Label = "sexo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->sexo;
   }
   //----- cod_empresa_evento
   function NM_export_cod_empresa_evento()
   {
         $this->cod_empresa_evento = NM_charset_to_utf8($this->cod_empresa_evento);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['cod_empresa_evento'])) ? $this->New_label['cod_empresa_evento'] : "Cód. Empresa Evento"; 
         }
         else
         {
             $SC_Label = "cod_empresa_evento"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->cod_empresa_evento;
   }
   //----- codigo_telefone_pais
   function NM_export_codigo_telefone_pais()
   {
         $this->codigo_telefone_pais = NM_charset_to_utf8($this->codigo_telefone_pais);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['codigo_telefone_pais'])) ? $this->New_label['codigo_telefone_pais'] : "Codigo Telefone Pais"; 
         }
         else
         {
             $SC_Label = "codigo_telefone_pais"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->codigo_telefone_pais;
   }
   //----- papel
   function NM_export_papel()
   {
         $this->papel = NM_charset_to_utf8($this->papel);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['papel'])) ? $this->New_label['papel'] : "Papel Status APP"; 
         }
         else
         {
             $SC_Label = "papel"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->papel;
   }
   //----- uid_pulseira_nfc
   function NM_export_uid_pulseira_nfc()
   {
         $this->uid_pulseira_nfc = NM_charset_to_utf8($this->uid_pulseira_nfc);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['uid_pulseira_nfc'])) ? $this->New_label['uid_pulseira_nfc'] : "Cód. Pulseira NFC"; 
         }
         else
         {
             $SC_Label = "uid_pulseira_nfc"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->uid_pulseira_nfc;
   }
   //----- passaporte
   function NM_export_passaporte()
   {
         $this->passaporte = NM_charset_to_utf8($this->passaporte);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['passaporte'])) ? $this->New_label['passaporte'] : "Passaporte"; 
         }
         else
         {
             $SC_Label = "passaporte"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->passaporte;
   }
   //----- emissao_passaporte
   function NM_export_emissao_passaporte()
   {
         $this->emissao_passaporte = NM_charset_to_utf8($this->emissao_passaporte);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['emissao_passaporte'])) ? $this->New_label['emissao_passaporte'] : "Emisão Passaporte"; 
         }
         else
         {
             $SC_Label = "emissao_passaporte"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->emissao_passaporte;
   }
   //----- validade_passaporte
   function NM_export_validade_passaporte()
   {
         $this->validade_passaporte = NM_charset_to_utf8($this->validade_passaporte);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['validade_passaporte'])) ? $this->New_label['validade_passaporte'] : "Validade Passaporte"; 
         }
         else
         {
             $SC_Label = "validade_passaporte"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->validade_passaporte;
   }
   //----- numero_do_visto
   function NM_export_numero_do_visto()
   {
         $this->numero_do_visto = NM_charset_to_utf8($this->numero_do_visto);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['numero_do_visto'])) ? $this->New_label['numero_do_visto'] : "Número do Visto"; 
         }
         else
         {
             $SC_Label = "numero_do_visto"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->numero_do_visto;
   }
   //----- validade_do_visto
   function NM_export_validade_do_visto()
   {
         $this->validade_do_visto = NM_charset_to_utf8($this->validade_do_visto);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['validade_do_visto'])) ? $this->New_label['validade_do_visto'] : "Validade do Visto"; 
         }
         else
         {
             $SC_Label = "validade_do_visto"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->validade_do_visto;
   }
   //----- vacina_febre_amarela
   function NM_export_vacina_febre_amarela()
   {
         $this->vacina_febre_amarela = NM_charset_to_utf8($this->vacina_febre_amarela);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['vacina_febre_amarela'])) ? $this->New_label['vacina_febre_amarela'] : "Vacina Febre Amarela"; 
         }
         else
         {
             $SC_Label = "vacina_febre_amarela"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->vacina_febre_amarela;
   }
   //----- estrangeiro
   function NM_export_estrangeiro()
   {
         $this->estrangeiro = NM_charset_to_utf8($this->estrangeiro);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['estrangeiro'])) ? $this->New_label['estrangeiro'] : "É Estrangeiro"; 
         }
         else
         {
             $SC_Label = "estrangeiro"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->estrangeiro;
   }
   //----- idioma_preferido
   function NM_export_idioma_preferido()
   {
         $this->idioma_preferido = NM_charset_to_utf8($this->idioma_preferido);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['idioma_preferido'])) ? $this->New_label['idioma_preferido'] : "Idioma Preferido"; 
         }
         else
         {
             $SC_Label = "idioma_preferido"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->idioma_preferido;
   }
   //----- restricoes_alimentares
   function NM_export_restricoes_alimentares()
   {
         $this->restricoes_alimentares = NM_charset_to_utf8($this->restricoes_alimentares);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['restricoes_alimentares'])) ? $this->New_label['restricoes_alimentares'] : "Restrições  Alimentares"; 
         }
         else
         {
             $SC_Label = "restricoes_alimentares"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->restricoes_alimentares;
   }
   //----- restricoes_mobilidade
   function NM_export_restricoes_mobilidade()
   {
         $this->restricoes_mobilidade = NM_charset_to_utf8($this->restricoes_mobilidade);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['restricoes_mobilidade'])) ? $this->New_label['restricoes_mobilidade'] : "Restrições Mobilidade"; 
         }
         else
         {
             $SC_Label = "restricoes_mobilidade"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->restricoes_mobilidade;
   }
   //----- cep
   function NM_export_cep()
   {
         $this->cep = NM_charset_to_utf8($this->cep);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['cep'])) ? $this->New_label['cep'] : "Cep"; 
         }
         else
         {
             $SC_Label = "cep"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->cep;
   }
   //----- rua
   function NM_export_rua()
   {
         $this->rua = NM_charset_to_utf8($this->rua);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['rua'])) ? $this->New_label['rua'] : "Rua"; 
         }
         else
         {
             $SC_Label = "rua"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->rua;
   }
   //----- numero
   function NM_export_numero()
   {
         $this->numero = NM_charset_to_utf8($this->numero);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['numero'])) ? $this->New_label['numero'] : "Número"; 
         }
         else
         {
             $SC_Label = "numero"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->numero;
   }
   //----- complemento
   function NM_export_complemento()
   {
         $this->complemento = NM_charset_to_utf8($this->complemento);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['complemento'])) ? $this->New_label['complemento'] : "Complemento"; 
         }
         else
         {
             $SC_Label = "complemento"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->complemento;
   }
   //----- bairro
   function NM_export_bairro()
   {
         $this->bairro = NM_charset_to_utf8($this->bairro);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['bairro'])) ? $this->New_label['bairro'] : "Bairro"; 
         }
         else
         {
             $SC_Label = "bairro"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->bairro;
   }
   //----- cidade
   function NM_export_cidade()
   {
         $this->cidade = NM_charset_to_utf8($this->cidade);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['cidade'])) ? $this->New_label['cidade'] : "Cidade"; 
         }
         else
         {
             $SC_Label = "cidade"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->cidade;
   }
   //----- estado
   function NM_export_estado()
   {
         $this->estado = NM_charset_to_utf8($this->estado);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['estado'])) ? $this->New_label['estado'] : "Estado"; 
         }
         else
         {
             $SC_Label = "estado"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->estado;
   }
   //----- pais
   function NM_export_pais()
   {
         $this->pais = NM_charset_to_utf8($this->pais);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['pais'])) ? $this->New_label['pais'] : "Pais"; 
         }
         else
         {
             $SC_Label = "pais"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->pais;
   }
   //----- nacionalidade
   function NM_export_nacionalidade()
   {
         $this->nacionalidade = NM_charset_to_utf8($this->nacionalidade);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['nacionalidade'])) ? $this->New_label['nacionalidade'] : "Nacionalidade"; 
         }
         else
         {
             $SC_Label = "nacionalidade"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->nacionalidade;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
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
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Modelo de Mailing :: JSON</TITLE>
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
<form name="Fdown" method="get" action="grid_modelo_mailling_rsvp_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_modelo_mailling_rsvp"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_modelo_mailling_rsvp']['json_return']); ?>"> 
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
