<?php

class grid_acompanhantes_rsvp_rec_rtf
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
                   nm_limpa_str_grid_acompanhantes_rsvp_rec($cadapar[1]);
                   nm_protect_num_grid_acompanhantes_rsvp_rec($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_acompanhantes_rsvp_rec']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_acompanhantes_rsvp_rec($_SESSION["vg_evento_id"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_acompanhantes_rsvp_rec_total.class.php"); 
      $this->Tot      = new grid_acompanhantes_rsvp_rec_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_acompanhantes_rsvp_rec']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_acompanhantes_rsvp_rec";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_acompanhantes_rsvp_rec.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_acompanhantes_rsvp_rec']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_acompanhantes_rsvp_rec']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_acompanhantes_rsvp_rec']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->participante_id = (isset($Busca_temp['participante_id'])) ? $Busca_temp['participante_id'] : ""; 
          $tmp_pos = (is_string($this->participante_id)) ? strpos($this->participante_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->participante_id))
          {
              $this->participante_id = substr($this->participante_id, 0, $tmp_pos);
          }
          $this->part_ativo = (isset($Busca_temp['part_ativo'])) ? $Busca_temp['part_ativo'] : ""; 
          $tmp_pos = (is_string($this->part_ativo)) ? strpos($this->part_ativo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_ativo))
          {
              $this->part_ativo = substr($this->part_ativo, 0, $tmp_pos);
          }
          $this->part_sexo = (isset($Busca_temp['part_sexo'])) ? $Busca_temp['part_sexo'] : ""; 
          $tmp_pos = (is_string($this->part_sexo)) ? strpos($this->part_sexo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_sexo))
          {
              $this->part_sexo = substr($this->part_sexo, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_acompanhantes_rsvp_rec']['contr_erro'] = 'on';
 $sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['grid_acompanhantes_rsvp_rec']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['part_cpf'])) ? $this->New_label['part_cpf'] : "Part Cpf"; 
          if ($Cada_col == "part_cpf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['part_id_evento'])) ? $this->New_label['part_id_evento'] : "Part Id Evento"; 
          if ($Cada_col == "part_id_evento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['part_id_evento_publico'])) ? $this->New_label['part_id_evento_publico'] : "Part Id Evento Publico"; 
          if ($Cada_col == "part_id_evento_publico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['dsc_publico'])) ? $this->New_label['dsc_publico'] : "Público"; 
          if ($Cada_col == "dsc_publico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['part_celeular_01'])) ? $this->New_label['part_celeular_01'] : "Part Celeular 01"; 
          if ($Cada_col == "part_celeular_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['part_email'])) ? $this->New_label['part_email'] : "Part Email"; 
          if ($Cada_col == "part_email" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['codigo_telefone_internacional'])) ? $this->New_label['codigo_telefone_internacional'] : "Codigo Telefone Internacional"; 
          if ($Cada_col == "codigo_telefone_internacional" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['part_ddd_celular_01'])) ? $this->New_label['part_ddd_celular_01'] : "Part Ddd Celular 01"; 
          if ($Cada_col == "part_ddd_celular_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['dsc_empresa_rsvp'])) ? $this->New_label['dsc_empresa_rsvp'] : "Dsc Empresa Rsvp"; 
          if ($Cada_col == "dsc_empresa_rsvp" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['roles_app'])) ? $this->New_label['roles_app'] : "Roles App"; 
          if ($Cada_col == "roles_app" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['external_status'])) ? $this->New_label['external_status'] : "External Status"; 
          if ($Cada_col == "external_status" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['retorno_api'])) ? $this->New_label['retorno_api'] : "Retorno Api"; 
          if ($Cada_col == "retorno_api" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['participante_id'])) ? $this->New_label['participante_id'] : "Participante Id"; 
          if ($Cada_col == "participante_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['part_ativo'])) ? $this->New_label['part_ativo'] : "Part Ativo"; 
          if ($Cada_col == "part_ativo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['part_sexo'])) ? $this->New_label['part_sexo'] : "Part Sexo"; 
          if ($Cada_col == "part_sexo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT part_cpf, part_id_evento, part_id_evento_publico, part_celeular_01, part_email, codigo_telefone_internacional, part_ddd_celular_01, dsc_empresa_rsvp, roles_app, external_status, retorno_api, participante_id, part_ativo, part_sexo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT part_cpf, part_id_evento, part_id_evento_publico, part_celeular_01, part_email, codigo_telefone_internacional, part_ddd_celular_01, dsc_empresa_rsvp, roles_app, external_status, retorno_api, participante_id, part_ativo, part_sexo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT part_cpf, part_id_evento, part_id_evento_publico, part_celeular_01, part_email, codigo_telefone_internacional, part_ddd_celular_01, dsc_empresa_rsvp, roles_app, external_status, retorno_api, participante_id, part_ativo, part_sexo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT part_cpf, part_id_evento, part_id_evento_publico, part_celeular_01, part_email, codigo_telefone_internacional, part_ddd_celular_01, dsc_empresa_rsvp, roles_app, external_status, retorno_api, participante_id, part_ativo, part_sexo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT part_cpf, part_id_evento, part_id_evento_publico, part_celeular_01, part_email, codigo_telefone_internacional, part_ddd_celular_01, dsc_empresa_rsvp, roles_app, external_status, retorno_api, participante_id, part_ativo, part_sexo from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT part_cpf, part_id_evento, part_id_evento_publico, part_celeular_01, part_email, codigo_telefone_internacional, part_ddd_celular_01, dsc_empresa_rsvp, roles_app, external_status, retorno_api, participante_id, part_ativo, part_sexo from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['order_grid'];
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
         $this->part_cpf = $rs->fields[0] ;  
         $this->part_id_evento = $rs->fields[1] ;  
         $this->part_id_evento = (string)$this->part_id_evento;
         $this->part_id_evento_publico = $rs->fields[2] ;  
         $this->part_id_evento_publico = (string)$this->part_id_evento_publico;
         $this->part_celeular_01 = $rs->fields[3] ;  
         $this->part_email = $rs->fields[4] ;  
         $this->codigo_telefone_internacional = $rs->fields[5] ;  
         $this->part_ddd_celular_01 = $rs->fields[6] ;  
         $this->dsc_empresa_rsvp = $rs->fields[7] ;  
         $this->roles_app = $rs->fields[8] ;  
         $this->external_status = $rs->fields[9] ;  
         $this->retorno_api = $rs->fields[10] ;  
         $this->participante_id = $rs->fields[11] ;  
         $this->participante_id = (string)$this->participante_id;
         $this->part_ativo = $rs->fields[12] ;  
         $this->part_sexo = $rs->fields[13] ;  
         $this->sc_proc_grid = true; 
         //----- lookup - dsc_publico
         $this->Lookup->lookup_dsc_publico($this->dsc_publico, $this->part_id_evento_publico, $this->array_dsc_publico); 
         $this->dsc_publico = str_replace("<br>", " ", $this->dsc_publico); 
         $this->dsc_publico = ($this->dsc_publico == "&nbsp;") ? "" : $this->dsc_publico; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- part_cpf
   function NM_export_part_cpf()
   {
         $this->part_cpf = html_entity_decode($this->part_cpf, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->part_cpf = strip_tags($this->part_cpf);
         $this->part_cpf = NM_charset_to_utf8($this->part_cpf);
         $this->part_cpf = str_replace('<', '&lt;', $this->part_cpf);
         $this->part_cpf = str_replace('>', '&gt;', $this->part_cpf);
         $this->Texto_tag .= "<td>" . $this->part_cpf . "</td>\r\n";
   }
   //----- part_id_evento
   function NM_export_part_id_evento()
   {
             nmgp_Form_Num_Val($this->part_id_evento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->part_id_evento = NM_charset_to_utf8($this->part_id_evento);
         $this->part_id_evento = str_replace('<', '&lt;', $this->part_id_evento);
         $this->part_id_evento = str_replace('>', '&gt;', $this->part_id_evento);
         $this->Texto_tag .= "<td>" . $this->part_id_evento . "</td>\r\n";
   }
   //----- part_id_evento_publico
   function NM_export_part_id_evento_publico()
   {
             nmgp_Form_Num_Val($this->part_id_evento_publico, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->part_id_evento_publico = NM_charset_to_utf8($this->part_id_evento_publico);
         $this->part_id_evento_publico = str_replace('<', '&lt;', $this->part_id_evento_publico);
         $this->part_id_evento_publico = str_replace('>', '&gt;', $this->part_id_evento_publico);
         $this->Texto_tag .= "<td>" . $this->part_id_evento_publico . "</td>\r\n";
   }
   //----- dsc_publico
   function NM_export_dsc_publico()
   {
         $this->dsc_publico = NM_charset_to_utf8($this->dsc_publico);
         $this->dsc_publico = str_replace('<', '&lt;', $this->dsc_publico);
         $this->dsc_publico = str_replace('>', '&gt;', $this->dsc_publico);
         $this->Texto_tag .= "<td>" . $this->dsc_publico . "</td>\r\n";
   }
   //----- part_celeular_01
   function NM_export_part_celeular_01()
   {
         $this->part_celeular_01 = html_entity_decode($this->part_celeular_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->part_celeular_01 = strip_tags($this->part_celeular_01);
         $this->part_celeular_01 = NM_charset_to_utf8($this->part_celeular_01);
         $this->part_celeular_01 = str_replace('<', '&lt;', $this->part_celeular_01);
         $this->part_celeular_01 = str_replace('>', '&gt;', $this->part_celeular_01);
         $this->Texto_tag .= "<td>" . $this->part_celeular_01 . "</td>\r\n";
   }
   //----- part_email
   function NM_export_part_email()
   {
         $this->part_email = html_entity_decode($this->part_email, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->part_email = strip_tags($this->part_email);
         $this->part_email = NM_charset_to_utf8($this->part_email);
         $this->part_email = str_replace('<', '&lt;', $this->part_email);
         $this->part_email = str_replace('>', '&gt;', $this->part_email);
         $this->Texto_tag .= "<td>" . $this->part_email . "</td>\r\n";
   }
   //----- codigo_telefone_internacional
   function NM_export_codigo_telefone_internacional()
   {
         $this->codigo_telefone_internacional = html_entity_decode($this->codigo_telefone_internacional, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->codigo_telefone_internacional = strip_tags($this->codigo_telefone_internacional);
         $this->codigo_telefone_internacional = NM_charset_to_utf8($this->codigo_telefone_internacional);
         $this->codigo_telefone_internacional = str_replace('<', '&lt;', $this->codigo_telefone_internacional);
         $this->codigo_telefone_internacional = str_replace('>', '&gt;', $this->codigo_telefone_internacional);
         $this->Texto_tag .= "<td>" . $this->codigo_telefone_internacional . "</td>\r\n";
   }
   //----- part_ddd_celular_01
   function NM_export_part_ddd_celular_01()
   {
         $this->part_ddd_celular_01 = html_entity_decode($this->part_ddd_celular_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->part_ddd_celular_01 = strip_tags($this->part_ddd_celular_01);
         $this->part_ddd_celular_01 = NM_charset_to_utf8($this->part_ddd_celular_01);
         $this->part_ddd_celular_01 = str_replace('<', '&lt;', $this->part_ddd_celular_01);
         $this->part_ddd_celular_01 = str_replace('>', '&gt;', $this->part_ddd_celular_01);
         $this->Texto_tag .= "<td>" . $this->part_ddd_celular_01 . "</td>\r\n";
   }
   //----- dsc_empresa_rsvp
   function NM_export_dsc_empresa_rsvp()
   {
         $this->dsc_empresa_rsvp = html_entity_decode($this->dsc_empresa_rsvp, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->dsc_empresa_rsvp = strip_tags($this->dsc_empresa_rsvp);
         $this->dsc_empresa_rsvp = NM_charset_to_utf8($this->dsc_empresa_rsvp);
         $this->dsc_empresa_rsvp = str_replace('<', '&lt;', $this->dsc_empresa_rsvp);
         $this->dsc_empresa_rsvp = str_replace('>', '&gt;', $this->dsc_empresa_rsvp);
         $this->Texto_tag .= "<td>" . $this->dsc_empresa_rsvp . "</td>\r\n";
   }
   //----- roles_app
   function NM_export_roles_app()
   {
         $this->roles_app = html_entity_decode($this->roles_app, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->roles_app = strip_tags($this->roles_app);
         $this->roles_app = NM_charset_to_utf8($this->roles_app);
         $this->roles_app = str_replace('<', '&lt;', $this->roles_app);
         $this->roles_app = str_replace('>', '&gt;', $this->roles_app);
         $this->Texto_tag .= "<td>" . $this->roles_app . "</td>\r\n";
   }
   //----- external_status
   function NM_export_external_status()
   {
         $this->external_status = html_entity_decode($this->external_status, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->external_status = strip_tags($this->external_status);
         $this->external_status = NM_charset_to_utf8($this->external_status);
         $this->external_status = str_replace('<', '&lt;', $this->external_status);
         $this->external_status = str_replace('>', '&gt;', $this->external_status);
         $this->Texto_tag .= "<td>" . $this->external_status . "</td>\r\n";
   }
   //----- retorno_api
   function NM_export_retorno_api()
   {
         $this->retorno_api = html_entity_decode($this->retorno_api, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->retorno_api = strip_tags($this->retorno_api);
         $this->retorno_api = NM_charset_to_utf8($this->retorno_api);
         $this->retorno_api = str_replace('<', '&lt;', $this->retorno_api);
         $this->retorno_api = str_replace('>', '&gt;', $this->retorno_api);
         $this->Texto_tag .= "<td>" . $this->retorno_api . "</td>\r\n";
   }
   //----- participante_id
   function NM_export_participante_id()
   {
             nmgp_Form_Num_Val($this->participante_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->participante_id = NM_charset_to_utf8($this->participante_id);
         $this->participante_id = str_replace('<', '&lt;', $this->participante_id);
         $this->participante_id = str_replace('>', '&gt;', $this->participante_id);
         $this->Texto_tag .= "<td>" . $this->participante_id . "</td>\r\n";
   }
   //----- part_ativo
   function NM_export_part_ativo()
   {
         $this->part_ativo = html_entity_decode($this->part_ativo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->part_ativo = strip_tags($this->part_ativo);
         $this->part_ativo = NM_charset_to_utf8($this->part_ativo);
         $this->part_ativo = str_replace('<', '&lt;', $this->part_ativo);
         $this->part_ativo = str_replace('>', '&gt;', $this->part_ativo);
         $this->Texto_tag .= "<td>" . $this->part_ativo . "</td>\r\n";
   }
   //----- part_sexo
   function NM_export_part_sexo()
   {
         $this->part_sexo = html_entity_decode($this->part_sexo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->part_sexo = strip_tags($this->part_sexo);
         $this->part_sexo = NM_charset_to_utf8($this->part_sexo);
         $this->part_sexo = str_replace('<', '&lt;', $this->part_sexo);
         $this->part_sexo = str_replace('>', '&gt;', $this->part_sexo);
         $this->Texto_tag .= "<td>" . $this->part_sexo . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_acompanhantes_rsvp_rec'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> acompanhantes_rsvp :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_acompanhantes_rsvp_rec_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_acompanhantes_rsvp_rec"> 
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
