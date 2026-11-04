<?php

class grid_confirmacao_viagem_rsvp_1_rtf
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
                   nm_limpa_str_grid_confirmacao_viagem_rsvp_1($cadapar[1]);
                   nm_protect_num_grid_confirmacao_viagem_rsvp_1($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_confirmacao_viagem_rsvp_1']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_destinatario)) 
      {
          $_SESSION['vg_destinatario'] = $vg_destinatario;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_1($_SESSION["vg_destinatario"]);
      }
      if (isset($vg_comcopia)) 
      {
          $_SESSION['vg_comcopia'] = $vg_comcopia;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_1($_SESSION["vg_comcopia"]);
      }
      if (isset($vg_msg)) 
      {
          $_SESSION['vg_msg'] = $vg_msg;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_1($_SESSION["vg_msg"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_confirmacao_viagem_rsvp_1_total.class.php"); 
      $this->Tot      = new grid_confirmacao_viagem_rsvp_1_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['tot_geral'][1];
      }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp_1']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption('volta_grid');
          $this->pb->setTotalSteps($this->count_ger);
      }
      $this->Arquivo    = "sc_rtf";
      $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arquivo   .= "_grid_confirmacao_viagem_rsvp_1";
      $this->Arquivo   .= ".rtf";
      $this->Tit_doc    = "grid_confirmacao_viagem_rsvp_1.rtf";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_confirmacao_viagem_rsvp_1']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_confirmacao_viagem_rsvp_1']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_confirmacao_viagem_rsvp_1']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->enviado_em = (isset($Busca_temp['enviado_em'])) ? $Busca_temp['enviado_em'] : ""; 
          $tmp_pos = (is_string($this->enviado_em)) ? strpos($this->enviado_em, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->enviado_em))
          {
              $this->enviado_em = substr($this->enviado_em, 0, $tmp_pos);
          }
          $this->enviado_em_2 = (isset($Busca_temp['enviado_em_input_2'])) ? $Busca_temp['enviado_em_input_2'] : ""; 
          $this->cod_evento = (isset($Busca_temp['cod_evento'])) ? $Busca_temp['cod_evento'] : ""; 
          $tmp_pos = (is_string($this->cod_evento)) ? strpos($this->cod_evento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_evento))
          {
              $this->cod_evento = substr($this->cod_evento, 0, $tmp_pos);
          }
          $this->nome_evento = (isset($Busca_temp['nome_evento'])) ? $Busca_temp['nome_evento'] : ""; 
          $tmp_pos = (is_string($this->nome_evento)) ? strpos($this->nome_evento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nome_evento))
          {
              $this->nome_evento = substr($this->nome_evento, 0, $tmp_pos);
          }
          $this->cod_participante = (isset($Busca_temp['cod_participante'])) ? $Busca_temp['cod_participante'] : ""; 
          $tmp_pos = (is_string($this->cod_participante)) ? strpos($this->cod_participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_participante))
          {
              $this->cod_participante = substr($this->cod_participante, 0, $tmp_pos);
          }
          $this->nome_participante = (isset($Busca_temp['nome_participante'])) ? $Busca_temp['nome_participante'] : ""; 
          $tmp_pos = (is_string($this->nome_participante)) ? strpos($this->nome_participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nome_participante))
          {
              $this->nome_participante = substr($this->nome_participante, 0, $tmp_pos);
          }
          $this->tipo_participante = (isset($Busca_temp['tipo_participante'])) ? $Busca_temp['tipo_participante'] : ""; 
          $tmp_pos = (is_string($this->tipo_participante)) ? strpos($this->tipo_participante, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_participante))
          {
              $this->tipo_participante = substr($this->tipo_participante, 0, $tmp_pos);
          }
          $this->status = (isset($Busca_temp['status'])) ? $Busca_temp['status'] : ""; 
          $tmp_pos = (is_string($this->status)) ? strpos($this->status, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->status))
          {
              $this->status = substr($this->status, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp_1']['contr_erro'] = 'on';
 $sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp_1']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_name'] .= ".rtf";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_name'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Texto_tag .= "<table>\r\n";
      $this->Texto_tag .= "<tr>\r\n";
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['id_voucher'])) ? $this->New_label['id_voucher'] : "Cód. Voucher"; 
          if ($Cada_col == "id_voucher" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['criado_em'])) ? $this->New_label['criado_em'] : "Criado em"; 
          if ($Cada_col == "criado_em" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['enviado_em'])) ? $this->New_label['enviado_em'] : "Enviado em"; 
          if ($Cada_col == "enviado_em" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cod_evento'])) ? $this->New_label['cod_evento'] : "Cód. Evento"; 
          if ($Cada_col == "cod_evento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['nome_evento'])) ? $this->New_label['nome_evento'] : "Nome Evento"; 
          if ($Cada_col == "nome_evento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['cod_participante'])) ? $this->New_label['cod_participante'] : "Cód.  Participante"; 
          if ($Cada_col == "cod_participante" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $SC_Label = (isset($this->New_label['tipo_participante'])) ? $this->New_label['tipo_participante'] : "Tipo Participante"; 
          if ($Cada_col == "tipo_participante" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['email_destinatario'])) ? $this->New_label['email_destinatario'] : "Email Destinatario"; 
          if ($Cada_col == "email_destinatario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['status'])) ? $this->New_label['status'] : "Status"; 
          if ($Cada_col == "status" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $SC_Label = NM_charset_to_utf8($SC_Label);
              $SC_Label = str_replace('<', '&lt;', $SC_Label);
              $SC_Label = str_replace('>', '&gt;', $SC_Label);
              $this->Texto_tag .= "<td>" . $SC_Label . "</td>\r\n";
          }
          $SC_Label = (isset($this->New_label['enviar'])) ? $this->New_label['enviar'] : "Enviar"; 
          if ($Cada_col == "enviar" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT id_voucher, criado_em, enviado_em, cod_evento, nome_evento, cod_participante, nome_participante, tipo_participante, email_destinatario, status, enviar, cod_usuario from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT id_voucher, criado_em, enviado_em, cod_evento, nome_evento, cod_participante, nome_participante, tipo_participante, email_destinatario, status, enviar, cod_usuario from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT id_voucher, criado_em, enviado_em, cod_evento, nome_evento, cod_participante, nome_participante, tipo_participante, email_destinatario, status, enviar, cod_usuario from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT id_voucher, TO_DATE(TO_CHAR(criado_em, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), TO_DATE(TO_CHAR(enviado_em, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), cod_evento, nome_evento, cod_participante, nome_participante, tipo_participante, email_destinatario, status, enviar, cod_usuario from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT id_voucher, criado_em, enviado_em, cod_evento, nome_evento, cod_participante, nome_participante, tipo_participante, email_destinatario, status, enviar, cod_usuario from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_voucher, criado_em, enviado_em, cod_evento, nome_evento, cod_participante, nome_participante, tipo_participante, email_destinatario, status, enviar, cod_usuario from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['order_grid'];
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
         $this->id_voucher = $rs->fields[0] ;  
         $this->id_voucher = (string)$this->id_voucher;
         $this->criado_em = $rs->fields[1] ;  
         $this->enviado_em = $rs->fields[2] ;  
         $this->cod_evento = $rs->fields[3] ;  
         $this->cod_evento = (string)$this->cod_evento;
         $this->nome_evento = $rs->fields[4] ;  
         $this->cod_participante = $rs->fields[5] ;  
         $this->nome_participante = $rs->fields[6] ;  
         $this->tipo_participante = $rs->fields[7] ;  
         $this->email_destinatario = $rs->fields[8] ;  
         $this->status = $rs->fields[9] ;  
         $this->enviar = $rs->fields[10] ;  
         $this->cod_usuario = $rs->fields[11] ;  
         $this->cod_usuario = (string)$this->cod_usuario;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['field_order'] as $Cada_col)
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- id_voucher
   function NM_export_id_voucher()
   {
             nmgp_Form_Num_Val($this->id_voucher, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->id_voucher = NM_charset_to_utf8($this->id_voucher);
         $this->id_voucher = str_replace('<', '&lt;', $this->id_voucher);
         $this->id_voucher = str_replace('>', '&gt;', $this->id_voucher);
         $this->Texto_tag .= "<td>" . $this->id_voucher . "</td>\r\n";
   }
   //----- criado_em
   function NM_export_criado_em()
   {
             if (substr($this->criado_em, 10, 1) == "-") 
             { 
                 $this->criado_em = substr($this->criado_em, 0, 10) . " " . substr($this->criado_em, 11);
             } 
             if (substr($this->criado_em, 13, 1) == ".") 
             { 
                $this->criado_em = substr($this->criado_em, 0, 13) . ":" . substr($this->criado_em, 14, 2) . ":" . substr($this->criado_em, 17);
             } 
             $conteudo_x =  $this->criado_em;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->criado_em, "YYYY-MM-DD HH:II:SS  ");
                 $this->criado_em = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->criado_em = NM_charset_to_utf8($this->criado_em);
         $this->criado_em = str_replace('<', '&lt;', $this->criado_em);
         $this->criado_em = str_replace('>', '&gt;', $this->criado_em);
         $this->Texto_tag .= "<td>" . $this->criado_em . "</td>\r\n";
   }
   //----- enviado_em
   function NM_export_enviado_em()
   {
             if (substr($this->enviado_em, 10, 1) == "-") 
             { 
                 $this->enviado_em = substr($this->enviado_em, 0, 10) . " " . substr($this->enviado_em, 11);
             } 
             if (substr($this->enviado_em, 13, 1) == ".") 
             { 
                $this->enviado_em = substr($this->enviado_em, 0, 13) . ":" . substr($this->enviado_em, 14, 2) . ":" . substr($this->enviado_em, 17);
             } 
             $conteudo_x =  $this->enviado_em;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->enviado_em, "YYYY-MM-DD HH:II:SS  ");
                 $this->enviado_em = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
         $this->enviado_em = NM_charset_to_utf8($this->enviado_em);
         $this->enviado_em = str_replace('<', '&lt;', $this->enviado_em);
         $this->enviado_em = str_replace('>', '&gt;', $this->enviado_em);
         $this->Texto_tag .= "<td>" . $this->enviado_em . "</td>\r\n";
   }
   //----- cod_evento
   function NM_export_cod_evento()
   {
             nmgp_Form_Num_Val($this->cod_evento, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->cod_evento = NM_charset_to_utf8($this->cod_evento);
         $this->cod_evento = str_replace('<', '&lt;', $this->cod_evento);
         $this->cod_evento = str_replace('>', '&gt;', $this->cod_evento);
         $this->Texto_tag .= "<td>" . $this->cod_evento . "</td>\r\n";
   }
   //----- nome_evento
   function NM_export_nome_evento()
   {
         $this->nome_evento = html_entity_decode($this->nome_evento, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nome_evento = strip_tags($this->nome_evento);
         $this->nome_evento = NM_charset_to_utf8($this->nome_evento);
         $this->nome_evento = str_replace('<', '&lt;', $this->nome_evento);
         $this->nome_evento = str_replace('>', '&gt;', $this->nome_evento);
         $this->Texto_tag .= "<td>" . $this->nome_evento . "</td>\r\n";
   }
   //----- cod_participante
   function NM_export_cod_participante()
   {
         $this->cod_participante = html_entity_decode($this->cod_participante, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cod_participante = strip_tags($this->cod_participante);
         $this->cod_participante = NM_charset_to_utf8($this->cod_participante);
         $this->cod_participante = str_replace('<', '&lt;', $this->cod_participante);
         $this->cod_participante = str_replace('>', '&gt;', $this->cod_participante);
         $this->Texto_tag .= "<td>" . $this->cod_participante . "</td>\r\n";
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
   //----- tipo_participante
   function NM_export_tipo_participante()
   {
         $this->tipo_participante = html_entity_decode($this->tipo_participante, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_participante = strip_tags($this->tipo_participante);
         $this->tipo_participante = NM_charset_to_utf8($this->tipo_participante);
         $this->tipo_participante = str_replace('<', '&lt;', $this->tipo_participante);
         $this->tipo_participante = str_replace('>', '&gt;', $this->tipo_participante);
         $this->Texto_tag .= "<td>" . $this->tipo_participante . "</td>\r\n";
   }
   //----- email_destinatario
   function NM_export_email_destinatario()
   {
         $this->email_destinatario = html_entity_decode($this->email_destinatario, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->email_destinatario = strip_tags($this->email_destinatario);
         $this->email_destinatario = NM_charset_to_utf8($this->email_destinatario);
         $this->email_destinatario = str_replace('<', '&lt;', $this->email_destinatario);
         $this->email_destinatario = str_replace('>', '&gt;', $this->email_destinatario);
         $this->Texto_tag .= "<td>" . $this->email_destinatario . "</td>\r\n";
   }
   //----- status
   function NM_export_status()
   {
         $this->status = html_entity_decode($this->status, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->status = strip_tags($this->status);
         $this->status = NM_charset_to_utf8($this->status);
         $this->status = str_replace('<', '&lt;', $this->status);
         $this->status = str_replace('>', '&gt;', $this->status);
         $this->Texto_tag .= "<td>" . $this->status . "</td>\r\n";
   }
   //----- enviar
   function NM_export_enviar()
   {
         $this->enviar = html_entity_decode($this->enviar, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->enviar = strip_tags($this->enviar);
         $this->enviar = NM_charset_to_utf8($this->enviar);
         $this->enviar = str_replace('<', '&lt;', $this->enviar);
         $this->enviar = str_replace('>', '&gt;', $this->enviar);
         $this->Texto_tag .= "<td>" . $this->enviar . "</td>\r\n";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1']['rtf_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_1'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Conferência de envio de Confirmação de Viagem :: RTF</TITLE>
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
<form name="Fdown" method="get" action="grid_confirmacao_viagem_rsvp_1_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_confirmacao_viagem_rsvp_1"> 
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
