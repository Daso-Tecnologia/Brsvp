<?php

class grid_participantes_rsvp_d_json
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['embutida'])
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['opcao'] = "";
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
                   nm_limpa_str_grid_participantes_rsvp_d($cadapar[1]);
                   nm_protect_num_grid_participantes_rsvp_d($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_participantes_rsvp_d']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_nome_part)) 
      {
          $_SESSION['vg_nome_part'] = $vg_nome_part;
          nm_limpa_str_grid_participantes_rsvp_d($_SESSION["vg_nome_part"]);
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['SC_Gb_Free_cmp']))
      {
          $this->Tem_json_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_participantes_rsvp_d/grid_participantes_rsvp_d_res_json.class.php"))
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_label']))
      {
          $this->Json_use_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_label'];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_format']))
      {
          $this->Json_format = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_format'];
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_participantes_rsvp_d_total.class.php"); 
      $this->Tot = new grid_participantes_rsvp_d_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_participantes_rsvp_d']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_return']);
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
      $this->Arq_zip      = $this->Arquivo . "_grid_participantes_rsvp_d.zip";
      $this->Arquivo     .= "_grid_participantes_rsvp_d";
      $this->Arquivo     .= ".json";
      $this->Tit_doc      = "grid_participantes_rsvp_d.json";
      $this->Tit_zip      = "grid_participantes_rsvp_d.zip";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_participantes_rsvp_d']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_participantes_rsvp_d']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_participantes_rsvp_d']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->nome_pessoa = (isset($Busca_temp['nome_pessoa'])) ? $Busca_temp['nome_pessoa'] : ""; 
          $tmp_pos = (is_string($this->nome_pessoa)) ? strpos($this->nome_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nome_pessoa))
          {
              $this->nome_pessoa = substr($this->nome_pessoa, 0, $tmp_pos);
          }
          $this->part_cpf = (isset($Busca_temp['part_cpf'])) ? $Busca_temp['part_cpf'] : ""; 
          $tmp_pos = (is_string($this->part_cpf)) ? strpos($this->part_cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cpf))
          {
              $this->part_cpf = substr($this->part_cpf, 0, $tmp_pos);
          }
          $this->part_sexo = (isset($Busca_temp['part_sexo'])) ? $Busca_temp['part_sexo'] : ""; 
          $tmp_pos = (is_string($this->part_sexo)) ? strpos($this->part_sexo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_sexo))
          {
              $this->part_sexo = substr($this->part_sexo, 0, $tmp_pos);
          }
          $this->part_id_evento = (isset($Busca_temp['part_id_evento'])) ? $Busca_temp['part_id_evento'] : ""; 
          $tmp_pos = (is_string($this->part_id_evento)) ? strpos($this->part_id_evento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_id_evento))
          {
              $this->part_id_evento = substr($this->part_id_evento, 0, $tmp_pos);
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
          $this->part_ativo = (isset($Busca_temp['part_ativo'])) ? $Busca_temp['part_ativo'] : ""; 
          $tmp_pos = (is_string($this->part_ativo)) ? strpos($this->part_ativo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_ativo))
          {
              $this->part_ativo = substr($this->part_ativo, 0, $tmp_pos);
          }
          $this->dttrans = (isset($Busca_temp['dttrans'])) ? $Busca_temp['dttrans'] : ""; 
          $tmp_pos = (is_string($this->dttrans)) ? strpos($this->dttrans, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->dttrans))
          {
              $this->dttrans = substr($this->dttrans, 0, $tmp_pos);
          }
          $this->tipochave = (isset($Busca_temp['tipochave'])) ? $Busca_temp['tipochave'] : ""; 
          $tmp_pos = (is_string($this->tipochave)) ? strpos($this->tipochave, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipochave))
          {
              $this->tipochave = substr($this->tipochave, 0, $tmp_pos);
          }
          $this->part_cpf_informado = (isset($Busca_temp['part_cpf_informado'])) ? $Busca_temp['part_cpf_informado'] : ""; 
          $tmp_pos = (is_string($this->part_cpf_informado)) ? strpos($this->part_cpf_informado, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cpf_informado))
          {
              $this->part_cpf_informado = substr($this->part_cpf_informado, 0, $tmp_pos);
          }
          $this->part_ddd_celular_01 = (isset($Busca_temp['part_ddd_celular_01'])) ? $Busca_temp['part_ddd_celular_01'] : ""; 
          $tmp_pos = (is_string($this->part_ddd_celular_01)) ? strpos($this->part_ddd_celular_01, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_ddd_celular_01))
          {
              $this->part_ddd_celular_01 = substr($this->part_ddd_celular_01, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_participantes_rsvp_d']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$this->nmgp_botoes["new"] = 'off';;

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['grid_participantes_rsvp_d']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['embutida'])
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
          $nmgp_select = "SELECT part_cpf, part_cpf_informado, nome_pessoa, part_sexo, part_ddd_celular_01, part_celeular_01, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_contato_rsvp, part_presenca, part_substituido, str_replace (convert(char(10),part_dt_nasc,102), '.', '-') + ' ' + convert(char(8),part_dt_nasc,20), part_ativo, participante_id, part_cpf_substituto, part_nome_substituto from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT part_cpf, part_cpf_informado, nome_pessoa, part_sexo, part_ddd_celular_01, part_celeular_01, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_contato_rsvp, part_presenca, part_substituido, part_dt_nasc, part_ativo, participante_id, part_cpf_substituto, part_nome_substituto from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT part_cpf, part_cpf_informado, nome_pessoa, part_sexo, part_ddd_celular_01, part_celeular_01, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_contato_rsvp, part_presenca, part_substituido, convert(char(23),part_dt_nasc,121), part_ativo, participante_id, part_cpf_substituto, part_nome_substituto from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT part_cpf, part_cpf_informado, nome_pessoa, part_sexo, part_ddd_celular_01, part_celeular_01, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_contato_rsvp, part_presenca, part_substituido, part_dt_nasc, part_ativo, participante_id, part_cpf_substituto, part_nome_substituto from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT part_cpf, part_cpf_informado, nome_pessoa, part_sexo, part_ddd_celular_01, part_celeular_01, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_contato_rsvp, part_presenca, part_substituido, EXTEND(part_dt_nasc, YEAR TO DAY), part_ativo, participante_id, part_cpf_substituto, part_nome_substituto from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT part_cpf, part_cpf_informado, nome_pessoa, part_sexo, part_ddd_celular_01, part_celeular_01, part_id_evento, part_id_evento_publico, part_id_evento_regional, part_contato_rsvp, part_presenca, part_substituido, part_dt_nasc, part_ativo, participante_id, part_cpf_substituto, part_nome_substituto from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['order_grid'];
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
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->part_cpf = $rs->fields[0] ;  
         $this->part_cpf_informado = $rs->fields[1] ;  
         $this->nome_pessoa = $rs->fields[2] ;  
         $this->part_sexo = $rs->fields[3] ;  
         $this->part_ddd_celular_01 = $rs->fields[4] ;  
         $this->part_celeular_01 = $rs->fields[5] ;  
         $this->part_id_evento = $rs->fields[6] ;  
         $this->part_id_evento = (string)$this->part_id_evento;
         $this->part_id_evento_publico = $rs->fields[7] ;  
         $this->part_id_evento_publico = (string)$this->part_id_evento_publico;
         $this->part_id_evento_regional = $rs->fields[8] ;  
         $this->part_id_evento_regional = (string)$this->part_id_evento_regional;
         $this->part_contato_rsvp = $rs->fields[9] ;  
         $this->part_presenca = $rs->fields[10] ;  
         $this->part_substituido = $rs->fields[11] ;  
         $this->part_dt_nasc = $rs->fields[12] ;  
         $this->part_ativo = $rs->fields[13] ;  
         $this->participante_id = $rs->fields[14] ;  
         $this->participante_id = (string)$this->participante_id;
         $this->part_cpf_substituto = $rs->fields[15] ;  
         $this->part_nome_substituto = $rs->fields[16] ;  
         $this->sc_proc_grid = true; 
         //----- lookup - tipochave
         $this->Lookup->lookup_tipochave($this->tipochave, $this->part_cpf, $this->array_tipochave); 
         $this->tipochave = str_replace("<br>", " ", $this->tipochave); 
         $this->tipochave = ($this->tipochave == "&nbsp;") ? "" : $this->tipochave; 
         //----- lookup - nome_evento
         $this->Lookup->lookup_nome_evento($this->nome_evento, $this->part_id_evento, $this->array_nome_evento); 
         $this->nome_evento = str_replace("<br>", " ", $this->nome_evento); 
         $this->nome_evento = ($this->nome_evento == "&nbsp;") ? "" : $this->nome_evento; 
         //----- lookup - evento_status
         $this->Lookup->lookup_evento_status($this->evento_status, $this->part_id_evento, $this->array_evento_status); 
         $this->evento_status = str_replace("<br>", " ", $this->evento_status); 
         $this->evento_status = ($this->evento_status == "&nbsp;") ? "" : $this->evento_status; 
         //----- lookup - publico
         $this->Lookup->lookup_publico($this->publico, $this->part_id_evento_publico, $this->array_publico); 
         $this->publico = str_replace("<br>", " ", $this->publico); 
         $this->publico = ($this->publico == "&nbsp;") ? "" : $this->publico; 
         //----- lookup - regional
         $this->Lookup->lookup_regional($this->regional, $this->part_id_evento_regional, $this->array_regional); 
         $this->regional = str_replace("<br>", " ", $this->regional); 
         $this->regional = ($this->regional == "&nbsp;") ? "" : $this->regional; 
         //----- lookup - dtevento
         $this->Lookup->lookup_dtevento($this->dtevento, $this->part_id_evento, $this->array_dtevento); 
         $this->dtevento = str_replace("<br>", " ", $this->dtevento); 
         $this->dtevento = ($this->dtevento == "&nbsp;") ? "" : $this->dtevento; 
         $_SESSION['scriptcase']['grid_participantes_rsvp_d']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_nome_part'])) {$_SESSION['vg_nome_part'] = "";}
if (!isset($this->sc_temp_vg_nome_part)) {$this->sc_temp_vg_nome_part = (isset($_SESSION['vg_nome_part'])) ? $_SESSION['vg_nome_part'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$this->nome_pessoa  = $this->sc_temp_vg_nome_part;

if ($this->part_substituido  == 'Y') {
	$this->part_substituido  = 'S';
} else {
	$this->part_cpf_substituto  = '';
	$this->part_nome_substituto  = '';
}

if ($this->part_dt_nasc  == '0000-00-00') {
	$this->part_dt_nasc   = '';
}

switch($this->part_contato_rsvp ) {
	case 'Y':
		$this->part_contato_rsvp 	= 'CONFIRMADO';
		break;
	case 'N':
		$this->part_contato_rsvp 	= 'DECLINADO';
		break;
	case 'A':
		$this->part_contato_rsvp 	= 'ABERTO';
		break;							
	case 'P':
		$this->part_contato_rsvp 	= 'PENDENTE';
		break;	
}				

switch($this->part_presenca ) {
	case 'Y':
		$this->part_presenca 	= 'CONFIRMADA';
		break;
	case 'N':
		$this->part_presenca 	= 'DECLINADA';
		break;
	case 'A':
		$this->part_presenca 	= 'ABERTA';
		break;							
	case 'P':
		$this->part_presenca 	= 'PENDENTE';
		break;	
}

if ($this->part_ativo  == 'Y') {
	$this->part_ativo  = 'S';
}	

$sql = "
	SELECT
		part_cpf_mestre
	FROM
		acompanhantes_rsvp	
	WHERE
		part_cpf_mestre = ".$this->Db->qstr($this->part_cpf )."
	AND
		part_id_evento = ".$this->Db->qstr($this->part_id_evento )."
	ORDER BY
		part_cpf_mestre
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
                                                                                    
$qtde = sizeof($this->rs );		                                                                                    
if ($qtde == 0) {
		
		
	
} else {
		
		
}
	
$this->dttrans  = $this->nm_conv_data_db($this->dtevento ,"aaaammdd","dd/mm/aaaa");
if (isset($this->sc_temp_vg_nome_part)) {$_SESSION['vg_nome_part'] = $this->sc_temp_vg_nome_part;}
$_SESSION['scriptcase']['grid_participantes_rsvp_d']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['field_order'] as $Cada_col)
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['embutida'])
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
              require_once($this->Ini->path_aplicacao . "grid_participantes_rsvp_d_res_json.class.php");
              $this->Res = new grid_participantes_rsvp_d_res_json();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_res_grid'] = true;
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
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_res_file']['json'];
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_res_file']['json']);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- part_cpf
   function NM_export_part_cpf()
   {
         $this->part_cpf = NM_charset_to_utf8($this->part_cpf);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_cpf'])) ? $this->New_label['part_cpf'] : "Código"; 
         }
         else
         {
             $SC_Label = "part_cpf"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_cpf;
   }
   //----- part_cpf_informado
   function NM_export_part_cpf_informado()
   {
         if ($this->Json_format)
         {
             if ($this->part_cpf_informado !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->part_cpf_informado, "###.###.###-##"); 
             } 
         }
         $this->part_cpf_informado = NM_charset_to_utf8($this->part_cpf_informado);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_cpf_informado'])) ? $this->New_label['part_cpf_informado'] : "CPF Informado"; 
         }
         else
         {
             $SC_Label = "part_cpf_informado"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_cpf_informado;
   }
   //----- tipochave
   function NM_export_tipochave()
   {
         $this->tipochave = NM_charset_to_utf8($this->tipochave);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['tipochave'])) ? $this->New_label['tipochave'] : "Tipo Cód."; 
         }
         else
         {
             $SC_Label = "tipochave"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->tipochave;
   }
   //----- nome_pessoa
   function NM_export_nome_pessoa()
   {
         $this->nome_pessoa = NM_charset_to_utf8($this->nome_pessoa);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['nome_pessoa'])) ? $this->New_label['nome_pessoa'] : "Nome"; 
         }
         else
         {
             $SC_Label = "nome_pessoa"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->nome_pessoa;
   }
   //----- part_sexo
   function NM_export_part_sexo()
   {
         $this->part_sexo = NM_charset_to_utf8($this->part_sexo);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_sexo'])) ? $this->New_label['part_sexo'] : "Sexo"; 
         }
         else
         {
             $SC_Label = "part_sexo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_sexo;
   }
   //----- part_ddd_celular_01
   function NM_export_part_ddd_celular_01()
   {
         $this->part_ddd_celular_01 = NM_charset_to_utf8($this->part_ddd_celular_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_ddd_celular_01'])) ? $this->New_label['part_ddd_celular_01'] : "DDD Celular "; 
         }
         else
         {
             $SC_Label = "part_ddd_celular_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_ddd_celular_01;
   }
   //----- part_celeular_01
   function NM_export_part_celeular_01()
   {
         if ($this->Json_format)
         {
             if ($this->part_celeular_01 !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->part_celeular_01, "#####-####"); 
             } 
         }
         $this->part_celeular_01 = NM_charset_to_utf8($this->part_celeular_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_celeular_01'])) ? $this->New_label['part_celeular_01'] : "Celular"; 
         }
         else
         {
             $SC_Label = "part_celeular_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_celeular_01;
   }
   //----- part_id_evento
   function NM_export_part_id_evento()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->part_id_evento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_id_evento'])) ? $this->New_label['part_id_evento'] : "Cód. Evento"; 
         }
         else
         {
             $SC_Label = "part_id_evento"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_id_evento;
   }
   //----- nome_evento
   function NM_export_nome_evento()
   {
         $this->nome_evento = NM_charset_to_utf8($this->nome_evento);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['nome_evento'])) ? $this->New_label['nome_evento'] : "Evento"; 
         }
         else
         {
             $SC_Label = "nome_evento"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->nome_evento;
   }
   //----- dttrans
   function NM_export_dttrans()
   {
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['dttrans'])) ? $this->New_label['dttrans'] : "Dt. Evento"; 
         }
         else
         {
             $SC_Label = "dttrans"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->dttrans;
   }
   //----- evento_status
   function NM_export_evento_status()
   {
         $this->evento_status = NM_charset_to_utf8($this->evento_status);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['evento_status'])) ? $this->New_label['evento_status'] : "Status"; 
         }
         else
         {
             $SC_Label = "evento_status"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->evento_status;
   }
   //----- part_id_evento_publico
   function NM_export_part_id_evento_publico()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->part_id_evento_publico, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_id_evento_publico'])) ? $this->New_label['part_id_evento_publico'] : "Cód. Público"; 
         }
         else
         {
             $SC_Label = "part_id_evento_publico"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_id_evento_publico;
   }
   //----- publico
   function NM_export_publico()
   {
         $this->publico = NM_charset_to_utf8($this->publico);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['publico'])) ? $this->New_label['publico'] : "Público"; 
         }
         else
         {
             $SC_Label = "publico"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->publico;
   }
   //----- part_id_evento_regional
   function NM_export_part_id_evento_regional()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->part_id_evento_regional, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_id_evento_regional'])) ? $this->New_label['part_id_evento_regional'] : "Cód. Regional"; 
         }
         else
         {
             $SC_Label = "part_id_evento_regional"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_id_evento_regional;
   }
   //----- regional
   function NM_export_regional()
   {
         $this->regional = NM_charset_to_utf8($this->regional);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['regional'])) ? $this->New_label['regional'] : "Regional"; 
         }
         else
         {
             $SC_Label = "regional"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->regional;
   }
   //----- part_contato_rsvp
   function NM_export_part_contato_rsvp()
   {
         $this->part_contato_rsvp = NM_charset_to_utf8($this->part_contato_rsvp);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_contato_rsvp'])) ? $this->New_label['part_contato_rsvp'] : "Contato"; 
         }
         else
         {
             $SC_Label = "part_contato_rsvp"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_contato_rsvp;
   }
   //----- part_presenca
   function NM_export_part_presenca()
   {
         $this->part_presenca = NM_charset_to_utf8($this->part_presenca);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_presenca'])) ? $this->New_label['part_presenca'] : "Presença"; 
         }
         else
         {
             $SC_Label = "part_presenca"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_presenca;
   }
   //----- part_substituido
   function NM_export_part_substituido()
   {
         $this->part_substituido = NM_charset_to_utf8($this->part_substituido);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_substituido'])) ? $this->New_label['part_substituido'] : "Substituído"; 
         }
         else
         {
             $SC_Label = "part_substituido"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_substituido;
   }
   //----- part_dt_nasc
   function NM_export_part_dt_nasc()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->part_dt_nasc;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->part_dt_nasc, "YYYY-MM-DD  ");
                 $this->part_dt_nasc = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_dt_nasc'])) ? $this->New_label['part_dt_nasc'] : "Dt. Nasc."; 
         }
         else
         {
             $SC_Label = "part_dt_nasc"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_dt_nasc;
   }
   //----- part_ativo
   function NM_export_part_ativo()
   {
         $this->part_ativo = NM_charset_to_utf8($this->part_ativo);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_ativo'])) ? $this->New_label['part_ativo'] : "Ativo"; 
         }
         else
         {
             $SC_Label = "part_ativo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_ativo;
   }
   //----- dtevento
   function NM_export_dtevento()
   {
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['dtevento'])) ? $this->New_label['dtevento'] : "Dt. evt excel"; 
         }
         else
         {
             $SC_Label = "dtevento"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->dtevento;
   }
   //----- participante_id
   function NM_export_participante_id()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->participante_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['participante_id'])) ? $this->New_label['participante_id'] : "Participante Id"; 
         }
         else
         {
             $SC_Label = "participante_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->participante_id;
   }
   //----- part_cpf_substituto
   function NM_export_part_cpf_substituto()
   {
         $this->part_cpf_substituto = NM_charset_to_utf8($this->part_cpf_substituto);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['part_cpf_substituto'])) ? $this->New_label['part_cpf_substituto'] : "Cód. Substituto"; 
         }
         else
         {
             $SC_Label = "part_cpf_substituto"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->part_cpf_substituto;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Histórico de Participações :: JSON</TITLE>
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
<form name="Fdown" method="get" action="grid_participantes_rsvp_d_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_participantes_rsvp_d"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_d']['json_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_participantes_rsvp_d']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_participantes_rsvp_d']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_participantes_rsvp_d']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_participantes_rsvp_d']['contr_erro'] = 'off';
}

}

?>
