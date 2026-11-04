<?php

class grid_transfer_rsvp_csv
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;

   var $Arquivo;
   var $Tit_doc;
   var $Delim_dados;
   var $Delim_line;
   var $Delim_col;
   var $Csv_label;
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
   function monta_csv()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if ($this->Ini->sc_export_ajax)
      {
          $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Csv_f);
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
                   nm_limpa_str_grid_transfer_rsvp($cadapar[1]);
                   nm_protect_num_grid_transfer_rsvp($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_transfer_rsvp']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_transfer_rsvp($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $vg_cpf;
          nm_limpa_str_grid_transfer_rsvp($_SESSION["vg_cpf"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_transfer_rsvp($_SESSION["rsvp_global"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_transfer_rsvp($_SESSION["vg_usuario_id"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_transfer_rsvp($_SESSION["vg_cpfseg"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_transfer_rsvp($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_transfer_rsvp($_SESSION["parm1"]);
      }
      if (isset($vg_tipo_pessoa)) 
      {
          $_SESSION['vg_tipo_pessoa'] = $vg_tipo_pessoa;
          nm_limpa_str_grid_transfer_rsvp($_SESSION["vg_tipo_pessoa"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_transfer_rsvp_total.class.php"); 
      $this->Tot      = new grid_transfer_rsvp_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['tot_geral'][1];
      }
      $this->Csv_password = "";
      $this->Arquivo   = "sc_csv";
      $this->Arquivo  .= "_" . date("YmdHis") . "_" . bin2hex(random_bytes(8));
      $this->Arq_zip   = $this->Arquivo . "_grid_transfer_rsvp.zip";
      $this->Arquivo  .= "_grid_transfer_rsvp";
      $this->Arquivo  .= ".csv";
      $this->Tit_doc   = "grid_transfer_rsvp.csv";
      $this->Tit_zip   = "grid_transfer_rsvp.zip";
      $this->Label_CSV = "N";
      $this->Delim_dados = "\"";
      $this->Delim_col   = ";";
      $this->Delim_line  = "\r\n";
      $this->Tem_csv_res = false;
      if (isset($_REQUEST['nm_delim_line']) && !empty($_REQUEST['nm_delim_line']))
      {
          $this->Delim_line = str_replace(array(1,2,3), array("\r\n","\r","\n"), $_REQUEST['nm_delim_line']);
      }
      if (isset($_REQUEST['nm_delim_col']) && !empty($_REQUEST['nm_delim_col']))
      {
          $this->Delim_col = str_replace(array(1,2,3,4,5), array(";",",","\	","#",""), $_REQUEST['nm_delim_col']);
      }
      if (isset($_REQUEST['nm_delim_dados']) && !empty($_REQUEST['nm_delim_dados']))
      {
          $this->Delim_dados = str_replace(array(1,2,3,4), array('"',"'","","|"), $_REQUEST['nm_delim_dados']);
      }
      if (isset($_REQUEST['nm_label_csv']) && !empty($_REQUEST['nm_label_csv']))
      {
          $this->Label_CSV = $_REQUEST['nm_label_csv'];
      }
          $this->Tem_csv_res  = true;
          if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
          { 
              $this->Tem_csv_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['SC_Ind_Groupby'] == "sc_free_total")
          {
              $this->Tem_csv_res  = false;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['SC_Gb_Free_cmp']))
          {
              $this->Tem_csv_res  = false;
          }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_transfer_rsvp']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_return']);
          if ($this->Tem_csv_res) {
              $PB_plus = intval ($this->count_ger * 0.04);
              $PB_plus = ($PB_plus < 2) ? 2 : $PB_plus;
          }
          else {
              $PB_plus = intval ($this->count_ger * 0.02);
              $PB_plus = ($PB_plus < 1) ? 1 : $PB_plus;
          }
          $PB_tot = $this->count_ger + $PB_plus;
          $this->PB_dif = $PB_tot - $this->count_ger;
          $this->pb->setTotalSteps($PB_tot );
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_transfer_rsvp']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->tra_cpf_particip = (isset($Busca_temp['tra_cpf_particip'])) ? $Busca_temp['tra_cpf_particip'] : ""; 
          $tmp_pos = (is_string($this->tra_cpf_particip)) ? strpos($this->tra_cpf_particip, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_cpf_particip))
          {
              $this->tra_cpf_particip = substr($this->tra_cpf_particip, 0, $tmp_pos);
          }
          $this->tra_tipo_pessoa = (isset($Busca_temp['tra_tipo_pessoa'])) ? $Busca_temp['tra_tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tra_tipo_pessoa)) ? strpos($this->tra_tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_tipo_pessoa))
          {
              $this->tra_tipo_pessoa = substr($this->tra_tipo_pessoa, 0, $tmp_pos);
          }
          $this->tra_tipo = (isset($Busca_temp['tra_tipo'])) ? $Busca_temp['tra_tipo'] : ""; 
          $tmp_pos = (is_string($this->tra_tipo)) ? strpos($this->tra_tipo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_tipo))
          {
              $this->tra_tipo = substr($this->tra_tipo, 0, $tmp_pos);
          }
          $this->tra_status = (isset($Busca_temp['tra_status'])) ? $Busca_temp['tra_status'] : ""; 
          $tmp_pos = (is_string($this->tra_status)) ? strpos($this->tra_status, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_status))
          {
              $this->tra_status = substr($this->tra_status, 0, $tmp_pos);
          }
          $this->tra_direcao = (isset($Busca_temp['tra_direcao'])) ? $Busca_temp['tra_direcao'] : ""; 
          $tmp_pos = (is_string($this->tra_direcao)) ? strpos($this->tra_direcao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_direcao))
          {
              $this->tra_direcao = substr($this->tra_direcao, 0, $tmp_pos);
          }
          $this->tra_numvoo_ida = (isset($Busca_temp['tra_numvoo_ida'])) ? $Busca_temp['tra_numvoo_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_numvoo_ida)) ? strpos($this->tra_numvoo_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_numvoo_ida))
          {
              $this->tra_numvoo_ida = substr($this->tra_numvoo_ida, 0, $tmp_pos);
          }
          $this->tra_dt_saida_ida = (isset($Busca_temp['tra_dt_saida_ida'])) ? $Busca_temp['tra_dt_saida_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_saida_ida)) ? strpos($this->tra_dt_saida_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_saida_ida))
          {
              $this->tra_dt_saida_ida = substr($this->tra_dt_saida_ida, 0, $tmp_pos);
          }
          $this->tra_dt_saida_ida_2 = (isset($Busca_temp['tra_dt_saida_ida_input_2'])) ? $Busca_temp['tra_dt_saida_ida_input_2'] : ""; 
          $this->tra_dt_chegada_ida = (isset($Busca_temp['tra_dt_chegada_ida'])) ? $Busca_temp['tra_dt_chegada_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_chegada_ida)) ? strpos($this->tra_dt_chegada_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_chegada_ida))
          {
              $this->tra_dt_chegada_ida = substr($this->tra_dt_chegada_ida, 0, $tmp_pos);
          }
          $this->tra_dt_chegada_ida_2 = (isset($Busca_temp['tra_dt_chegada_ida_input_2'])) ? $Busca_temp['tra_dt_chegada_ida_input_2'] : ""; 
          $this->tra_localizador_ida = (isset($Busca_temp['tra_localizador_ida'])) ? $Busca_temp['tra_localizador_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_localizador_ida)) ? strpos($this->tra_localizador_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_localizador_ida))
          {
              $this->tra_localizador_ida = substr($this->tra_localizador_ida, 0, $tmp_pos);
          }
          $this->tra_eticket_ida = (isset($Busca_temp['tra_eticket_ida'])) ? $Busca_temp['tra_eticket_ida'] : ""; 
          $tmp_pos = (is_string($this->tra_eticket_ida)) ? strpos($this->tra_eticket_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_eticket_ida))
          {
              $this->tra_eticket_ida = substr($this->tra_eticket_ida, 0, $tmp_pos);
          }
          $this->tra_numvoo_volta = (isset($Busca_temp['tra_numvoo_volta'])) ? $Busca_temp['tra_numvoo_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_numvoo_volta)) ? strpos($this->tra_numvoo_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_numvoo_volta))
          {
              $this->tra_numvoo_volta = substr($this->tra_numvoo_volta, 0, $tmp_pos);
          }
          $this->tra_dt_saida_volta = (isset($Busca_temp['tra_dt_saida_volta'])) ? $Busca_temp['tra_dt_saida_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_saida_volta)) ? strpos($this->tra_dt_saida_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_saida_volta))
          {
              $this->tra_dt_saida_volta = substr($this->tra_dt_saida_volta, 0, $tmp_pos);
          }
          $this->tra_dt_saida_volta_2 = (isset($Busca_temp['tra_dt_saida_volta_input_2'])) ? $Busca_temp['tra_dt_saida_volta_input_2'] : ""; 
          $this->tra_dt_chegada_volta = (isset($Busca_temp['tra_dt_chegada_volta'])) ? $Busca_temp['tra_dt_chegada_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_chegada_volta)) ? strpos($this->tra_dt_chegada_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_chegada_volta))
          {
              $this->tra_dt_chegada_volta = substr($this->tra_dt_chegada_volta, 0, $tmp_pos);
          }
          $this->tra_dt_chegada_volta_2 = (isset($Busca_temp['tra_dt_chegada_volta_input_2'])) ? $Busca_temp['tra_dt_chegada_volta_input_2'] : ""; 
          $this->tra_localizador_volta = (isset($Busca_temp['tra_localizador_volta'])) ? $Busca_temp['tra_localizador_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_localizador_volta)) ? strpos($this->tra_localizador_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_localizador_volta))
          {
              $this->tra_localizador_volta = substr($this->tra_localizador_volta, 0, $tmp_pos);
          }
          $this->tra_eticket_volta = (isset($Busca_temp['tra_eticket_volta'])) ? $Busca_temp['tra_eticket_volta'] : ""; 
          $tmp_pos = (is_string($this->tra_eticket_volta)) ? strpos($this->tra_eticket_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_eticket_volta))
          {
              $this->tra_eticket_volta = substr($this->tra_eticket_volta, 0, $tmp_pos);
          }
          $this->tra_dt_chegada_proprio = (isset($Busca_temp['tra_dt_chegada_proprio'])) ? $Busca_temp['tra_dt_chegada_proprio'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_chegada_proprio)) ? strpos($this->tra_dt_chegada_proprio, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_chegada_proprio))
          {
              $this->tra_dt_chegada_proprio = substr($this->tra_dt_chegada_proprio, 0, $tmp_pos);
          }
          $this->tra_dt_chegada_proprio_2 = (isset($Busca_temp['tra_dt_chegada_proprio_input_2'])) ? $Busca_temp['tra_dt_chegada_proprio_input_2'] : ""; 
          $this->tra_hr_chegada_proprio = (isset($Busca_temp['tra_hr_chegada_proprio'])) ? $Busca_temp['tra_hr_chegada_proprio'] : ""; 
          $tmp_pos = (is_string($this->tra_hr_chegada_proprio)) ? strpos($this->tra_hr_chegada_proprio, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_hr_chegada_proprio))
          {
              $this->tra_hr_chegada_proprio = substr($this->tra_hr_chegada_proprio, 0, $tmp_pos);
          }
          $this->tra_hr_volta_local = (isset($Busca_temp['tra_hr_volta_local'])) ? $Busca_temp['tra_hr_volta_local'] : ""; 
          $tmp_pos = (is_string($this->tra_hr_volta_local)) ? strpos($this->tra_hr_volta_local, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_hr_volta_local))
          {
              $this->tra_hr_volta_local = substr($this->tra_hr_volta_local, 0, $tmp_pos);
          }
          $this->tra_dt_volta_local = (isset($Busca_temp['tra_dt_volta_local'])) ? $Busca_temp['tra_dt_volta_local'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_volta_local)) ? strpos($this->tra_dt_volta_local, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_volta_local))
          {
              $this->tra_dt_volta_local = substr($this->tra_dt_volta_local, 0, $tmp_pos);
          }
          $this->tra_dt_volta_local_2 = (isset($Busca_temp['tra_dt_volta_local_input_2'])) ? $Busca_temp['tra_dt_volta_local_input_2'] : ""; 
          $this->tra_hr_ida_local = (isset($Busca_temp['tra_hr_ida_local'])) ? $Busca_temp['tra_hr_ida_local'] : ""; 
          $tmp_pos = (is_string($this->tra_hr_ida_local)) ? strpos($this->tra_hr_ida_local, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_hr_ida_local))
          {
              $this->tra_hr_ida_local = substr($this->tra_hr_ida_local, 0, $tmp_pos);
          }
          $this->tra_dt_ida_local = (isset($Busca_temp['tra_dt_ida_local'])) ? $Busca_temp['tra_dt_ida_local'] : ""; 
          $tmp_pos = (is_string($this->tra_dt_ida_local)) ? strpos($this->tra_dt_ida_local, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_dt_ida_local))
          {
              $this->tra_dt_ida_local = substr($this->tra_dt_ida_local, 0, $tmp_pos);
          }
          $this->tra_dt_ida_local_2 = (isset($Busca_temp['tra_dt_ida_local_input_2'])) ? $Busca_temp['tra_dt_ida_local_input_2'] : ""; 
          $this->id_transfer = (isset($Busca_temp['id_transfer'])) ? $Busca_temp['id_transfer'] : ""; 
          $tmp_pos = (is_string($this->id_transfer)) ? strpos($this->id_transfer, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->id_transfer))
          {
              $this->id_transfer = substr($this->id_transfer, 0, $tmp_pos);
          }
          $this->tra_id_bloqueio = (isset($Busca_temp['tra_id_bloqueio'])) ? $Busca_temp['tra_id_bloqueio'] : ""; 
          $tmp_pos = (is_string($this->tra_id_bloqueio)) ? strpos($this->tra_id_bloqueio, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_id_bloqueio))
          {
              $this->tra_id_bloqueio = substr($this->tra_id_bloqueio, 0, $tmp_pos);
          }
          $this->tra_id_evento = (isset($Busca_temp['tra_id_evento'])) ? $Busca_temp['tra_id_evento'] : ""; 
          $tmp_pos = (is_string($this->tra_id_evento)) ? strpos($this->tra_id_evento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_id_evento))
          {
              $this->tra_id_evento = substr($this->tra_id_evento, 0, $tmp_pos);
          }
          $this->tra_id_aereo = (isset($Busca_temp['tra_id_aereo'])) ? $Busca_temp['tra_id_aereo'] : ""; 
          $tmp_pos = (is_string($this->tra_id_aereo)) ? strpos($this->tra_id_aereo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tra_id_aereo))
          {
              $this->tra_id_aereo = substr($this->tra_id_aereo, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_tipo_pessoa'])) {$_SESSION['vg_tipo_pessoa'] = "";}
if (!isset($this->sc_temp_vg_tipo_pessoa)) {$this->sc_temp_vg_tipo_pessoa = (isset($_SESSION['vg_tipo_pessoa'])) ? $_SESSION['vg_tipo_pessoa'] : "";}
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
 if (isset($this->sc_temp_vg_tipo_pessoa)) {$_SESSION['vg_tipo_pessoa'] = $this->sc_temp_vg_tipo_pessoa;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_transfer_rsvp";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['sc_outra_jan'] = false;
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
        action="grid_transfer_rsvp_fim.php"
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



$this->tra_id_evento  = $this->sc_temp_vg_evento_id;
$this->tra_cpf_particip  = $this->sc_temp_vg_cpf;
$this->tra_tipo_pessoa  = $this->sc_temp_vg_tipo_pessoa;
$status = $this->tra_status ;

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
	if ($this->tra_tipo_pessoa  == "P") {
		$this->cabecalho  = 'TRANSFER PARTICIPANTE: '.$this->rs[0][0].' - '.$this->rs[0][1].'  -  EVENTO: '.$this->sc_temp_vg_evento_id; 
		$tipo_pessoa  = 'PARTICIPANTE';
		echo '<h3>&emsp;RSVP - Transfer Participante</h3>';	
	} else {
		$this->cabecalho  = 'TRANSFER ACOMPANHANTE: '.$this->rs[0][0].' - '.$this->rs[0][1].'  -  EVENTO: '.$this->sc_temp_vg_evento_id; 
		$tipo_pessoa  = 'ACOMPANHANTE';
		echo '<h3>&emsp;RSVP - Transfer Acompanhante</h3>';	
	}
} else {
	$this->cabecalho  = '';	
}

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_tipo_pessoa)) {$_SESSION['vg_tipo_pessoa'] = $this->sc_temp_vg_tipo_pessoa;}
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_name'] .= ".csv";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      $this->Csv_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      $csv_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      if ($this->Label_CSV == "S")
      { 
          $this->NM_prim_col  = 0;
          $this->csv_registro = "";
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['field_order'] as $Cada_col)
          { 
              $SC_Label = (isset($this->New_label['id_transfer'])) ? $this->New_label['id_transfer'] : "Cód. Transfer"; 
              if ($Cada_col == "id_transfer" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tra_id_evento'])) ? $this->New_label['tra_id_evento'] : "Evento"; 
              if ($Cada_col == "tra_id_evento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tipo_transfer_dsc'])) ? $this->New_label['tipo_transfer_dsc'] : "Tipo Transfer"; 
              if ($Cada_col == "tipo_transfer_dsc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tra_id_usuario'])) ? $this->New_label['tra_id_usuario'] : "Atendente"; 
              if ($Cada_col == "tra_id_usuario" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tra_id_hotel'])) ? $this->New_label['tra_id_hotel'] : "Hotel"; 
              if ($Cada_col == "tra_id_hotel" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tra_ult_trecho_volta'])) ? $this->New_label['tra_ult_trecho_volta'] : "Ult. Trecho"; 
              if ($Cada_col == "tra_ult_trecho_volta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['transfer_gray'])) ? $this->New_label['transfer_gray'] : "Status"; 
              if ($Cada_col == "transfer_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['transfer_green'])) ? $this->New_label['transfer_green'] : "Status"; 
              if ($Cada_col == "transfer_green" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['transfer_yellow'])) ? $this->New_label['transfer_yellow'] : "Status"; 
              if ($Cada_col == "transfer_yellow" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['transfer_red'])) ? $this->New_label['transfer_red'] : "Status"; 
              if ($Cada_col == "transfer_red" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['transfer_roxo'])) ? $this->New_label['transfer_roxo'] : "Status"; 
              if ($Cada_col == "transfer_roxo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['grid_aereo'])) ? $this->New_label['grid_aereo'] : "Aéreo Ida"; 
              if ($Cada_col == "grid_aereo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['grid_aereo_volta'])) ? $this->New_label['grid_aereo_volta'] : "Aéreo Volta"; 
              if ($Cada_col == "grid_aereo_volta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['grid_bloqueio'])) ? $this->New_label['grid_bloqueio'] : "Bloqueio Ida"; 
              if ($Cada_col == "grid_bloqueio" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['grid_bloqueio_volta'])) ? $this->New_label['grid_bloqueio_volta'] : "Bloqueio Volta"; 
              if ($Cada_col == "grid_bloqueio_volta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['cancelado'])) ? $this->New_label['cancelado'] : "Aéreo Ida"; 
              if ($Cada_col == "cancelado" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['cancelado_volta'])) ? $this->New_label['cancelado_volta'] : "Aéreo Volta"; 
              if ($Cada_col == "cancelado_volta" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tra_dt_alteracao'])) ? $this->New_label['tra_dt_alteracao'] : "Alterado em"; 
              if ($Cada_col == "tra_dt_alteracao" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tra_id_aereo'])) ? $this->New_label['tra_id_aereo'] : "Aéreo Ida"; 
              if ($Cada_col == "tra_id_aereo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['tra_id_bloqueio'])) ? $this->New_label['tra_id_bloqueio'] : "Bloqueio Aéreo"; 
              if ($Cada_col == "tra_id_bloqueio" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
          } 
          $this->csv_registro .= $this->Delim_line;
          fwrite($csv_f, $this->csv_registro);
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT id_transfer, tra_id_evento, tra_id_usuario, tra_id_hotel, tra_ult_trecho_volta, tra_dt_alteracao, tra_id_aereo, tra_id_bloqueio, tra_cpf_particip, tra_tipo_pessoa, tra_tipo, tra_status, tra_id_aereo_volta, tra_ativo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT id_transfer, tra_id_evento, tra_id_usuario, tra_id_hotel, tra_ult_trecho_volta, tra_dt_alteracao, tra_id_aereo, tra_id_bloqueio, tra_cpf_particip, tra_tipo_pessoa, tra_tipo, tra_status, tra_id_aereo_volta, tra_ativo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT id_transfer, tra_id_evento, tra_id_usuario, tra_id_hotel, tra_ult_trecho_volta, tra_dt_alteracao, tra_id_aereo, tra_id_bloqueio, tra_cpf_particip, tra_tipo_pessoa, tra_tipo, tra_status, tra_id_aereo_volta, tra_ativo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT id_transfer, tra_id_evento, tra_id_usuario, tra_id_hotel, tra_ult_trecho_volta, TO_DATE(TO_CHAR(tra_dt_alteracao, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), tra_id_aereo, tra_id_bloqueio, tra_cpf_particip, tra_tipo_pessoa, tra_tipo, tra_status, tra_id_aereo_volta, tra_ativo from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT id_transfer, tra_id_evento, tra_id_usuario, tra_id_hotel, tra_ult_trecho_volta, tra_dt_alteracao, tra_id_aereo, tra_id_bloqueio, tra_cpf_particip, tra_tipo_pessoa, tra_tipo, tra_status, tra_id_aereo_volta, tra_ativo from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT id_transfer, tra_id_evento, tra_id_usuario, tra_id_hotel, tra_ult_trecho_volta, tra_dt_alteracao, tra_id_aereo, tra_id_bloqueio, tra_cpf_particip, tra_tipo_pessoa, tra_tipo, tra_status, tra_id_aereo_volta, tra_ativo from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['order_grid'];
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
         $this->csv_registro = "";
         $this->NM_prim_col  = 0;
         $this->id_transfer = $rs->fields[0] ;  
         $this->id_transfer = (string)$this->id_transfer;
         $this->tra_id_evento = $rs->fields[1] ;  
         $this->tra_id_evento = (string)$this->tra_id_evento;
         $this->tra_id_usuario = $rs->fields[2] ;  
         $this->tra_id_usuario = (string)$this->tra_id_usuario;
         $this->tra_id_hotel = $rs->fields[3] ;  
         $this->tra_id_hotel = (string)$this->tra_id_hotel;
         $this->tra_ult_trecho_volta = $rs->fields[4] ;  
         $this->tra_ult_trecho_volta = (string)$this->tra_ult_trecho_volta;
         $this->tra_dt_alteracao = $rs->fields[5] ;  
         $this->tra_id_aereo = $rs->fields[6] ;  
         $this->tra_id_aereo = (string)$this->tra_id_aereo;
         $this->tra_id_bloqueio = $rs->fields[7] ;  
         $this->tra_id_bloqueio = (string)$this->tra_id_bloqueio;
         $this->tra_cpf_particip = $rs->fields[8] ;  
         $this->tra_tipo_pessoa = $rs->fields[9] ;  
         $this->tra_tipo = $rs->fields[10] ;  
         $this->tra_status = $rs->fields[11] ;  
         $this->tra_id_aereo_volta = $rs->fields[12] ;  
         $this->tra_id_aereo_volta = (string)$this->tra_id_aereo_volta;
         $this->tra_ativo = $rs->fields[13] ;  
         //----- lookup - tra_id_evento
         $this->look_tra_id_evento = $this->tra_id_evento; 
         $this->Lookup->lookup_tra_id_evento($this->look_tra_id_evento, $this->tra_id_evento) ; 
         $this->look_tra_id_evento = ($this->look_tra_id_evento == "&nbsp;") ? "" : $this->look_tra_id_evento; 
         //----- lookup - tra_id_usuario
         $this->look_tra_id_usuario = $this->tra_id_usuario; 
         $this->Lookup->lookup_tra_id_usuario($this->look_tra_id_usuario, $this->tra_id_usuario) ; 
         $this->look_tra_id_usuario = ($this->look_tra_id_usuario == "&nbsp;") ? "" : $this->look_tra_id_usuario; 
         //----- lookup - tra_id_hotel
         $this->look_tra_id_hotel = $this->tra_id_hotel; 
         $this->Lookup->lookup_tra_id_hotel($this->look_tra_id_hotel, $this->tra_id_hotel) ; 
         $this->look_tra_id_hotel = ($this->look_tra_id_hotel == "&nbsp;") ? "" : $this->look_tra_id_hotel; 
         //----- lookup - tra_id_bloqueio
         $this->look_tra_id_bloqueio = $this->tra_id_bloqueio; 
         $this->Lookup->lookup_tra_id_bloqueio($this->look_tra_id_bloqueio, $this->tra_id_bloqueio) ; 
         $this->look_tra_id_bloqueio = ($this->look_tra_id_bloqueio == "&nbsp;") ? "" : $this->look_tra_id_bloqueio; 
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['vg_cpf'])) {$_SESSION['vg_cpf'] = "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$this->NM_field_color["tra_id_evento"] = "#1FB6FF";
$tipo_transfer = $this->tra_tipo ;

switch($tipo_transfer) {		
	case 'A':
		$this->tipo_transfer_dsc  = 'AÉREO';
		$this->NM_cmp_hidden["cancelado"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["cancelado"] = 'off'; }		
		$this->NM_cmp_hidden["cancelado_volta"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["cancelado_volta"] = 'off'; }		
		break;	
	case 'L':
		$this->tipo_transfer_dsc  = 'LOCAL';
		$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_gray"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_green"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_red"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_roxo"] = 'off'; }					
		break;			
	case 'P':
		$this->tipo_transfer_dsc  = 'PRÓPRIO';
		$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_gray"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_green"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_red"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_roxo"] = 'off'; }					
		break;					
}		

$astatus = $this->tra_status ;
switch($astatus) {
	case 'A':
		$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_gray"] = 'on'; }		
		$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_green"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_red"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_roxo"] = 'off'; }					
		break;
	case 'P':
		$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_gray"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_yellow"] = 'on'; }					
		$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_green"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_red"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_roxo"] = 'off'; }					
		break;		
	case 'Y':
		$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_gray"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_green"] = 'on'; }		
		$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_red"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_roxo"] = 'off'; }					
		break;								  
	case 'N':
		$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_gray"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
		$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_green"] = 'off'; }		
		$this->NM_cmp_hidden["transfer_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_red"] = 'on'; }					
		$this->NM_cmp_hidden["transfer_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["transfer_roxo"] = 'off'; }					
		break;			
}							  
						 
if ($tipo_transfer == 'A') {
	$sql="
		SELECT 
			id_aereo,aereo_bloqueio_id
		FROM
			aereos_rsvp
		WHERE 
			id_aereo = ".$this->Db->qstr($this->tra_id_aereo )."			
		ORDER BY 
			id_aereo"
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
		$bloqueio_ida = $this->rs[0][1];
		if ($bloqueio_ida == 0) {
			$this->NM_cmp_hidden["grid_bloqueio"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_bloqueio"] = 'off'; }		
			$this->NM_cmp_hidden["grid_aereo"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_aereo"] = 'on'; }			
		} else {
			$this->NM_cmp_hidden["grid_bloqueio"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_bloqueio"] = 'on'; }		
			$this->NM_cmp_hidden["grid_aereo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_aereo"] = 'off'; }			
		}	
	} else {
		$this->NM_cmp_hidden["grid_bloqueio"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_bloqueio"] = 'off'; }		
		$this->NM_cmp_hidden["grid_aereo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_aereo"] = 'off'; }	
	}	

	$sql2="
		SELECT 
			id_aereo,aereo_bloqueio_id
		FROM
			aereos_rsvp
		WHERE 
			id_aereo = ".$this->Db->qstr($this->tra_id_aereo_volta )." 			
		ORDER BY 
			id_aereo"
	;				
	 
      $nm_select = $sql2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs2 = false;
          $this->rs2_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rs2[0][0])) {						 
		$bloqueio_volta = $this->rs2[0][1];
		if ($bloqueio_volta == 0) {
			$this->NM_cmp_hidden["grid_bloqueio_volta"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_bloqueio_volta"] = 'off'; }		
			$this->NM_cmp_hidden["grid_aereo_volta"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_aereo_volta"] = 'on'; }			
		} else {
			$this->NM_cmp_hidden["grid_bloqueio_volta"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_bloqueio_volta"] = 'on'; }		
			$this->NM_cmp_hidden["grid_aereo_volta"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_aereo_volta"] = 'off'; }					
		}	
	} else {
		$this->NM_cmp_hidden["grid_bloqueio_volta"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_bloqueio_volta"] = 'off'; }		
		$this->NM_cmp_hidden["grid_aereo_volta"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_aereo_volta"] = 'off'; }	
	}	
} else {
	$this->NM_cmp_hidden["grid_bloqueio"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_bloqueio"] = 'off'; }		
	$this->NM_cmp_hidden["grid_aereo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_aereo"] = 'off'; }	
	$this->NM_cmp_hidden["grid_bloqueio_volta"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_bloqueio_volta"] = 'off'; }		
	$this->NM_cmp_hidden["grid_aereo_volta"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["grid_aereo_volta"] = 'off'; }	
	$this->NM_cmp_hidden["cancelado"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["cancelado"] = 'on'; }	
	$this->NM_cmp_hidden["cancelado_volta"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['php_cmp_sel']["cancelado_volta"] = 'on'; }	
}	

$campo_1 = 'part_cpf';
$campo_2 = 'part_id_evento';
$campo_3 = 'part_ativo';
if($this->tra_tipo_pessoa  == 'A') {
	$tabela = 'acompanhantes_rsvp';
} else {
	$tabela = 'participantes_rsvp';
}	
$cpf = $this->sc_temp_vg_cpf;
$evt = $this->sc_temp_vg_evento_id;
$order = 'part_cpf, part_id_evento';
$this->tra_ativo  = $this->GetPresAtiva($campo_1,$campo_2,$campo_3,$tabela,$cpf,$evt,$order);		 
if ($this->tra_ativo  == 'Y') {
	$this->NM_field_style["id_transfer"] = "background-color:#cde4cd;font-size:bold;"; 	
} else {
	$this->NM_field_style["id_transfer"] = "background-color:#ffbbba;font-size:bold;";
}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->csv_registro .= $this->Delim_line;
         fwrite($csv_f, $this->csv_registro);
         $rs->MoveNext();
      }
      fclose($csv_f);
      if ($this->Tem_csv_res)
      { 
          if (!$this->Ini->sc_export_ajax) {
              $this->PB_dif = intval ($this->PB_dif / 2);
              $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
              $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
              $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
              $this->pb->addSteps($this->PB_dif);
          }
          require_once($this->Ini->path_aplicacao . "grid_transfer_rsvp_res_csv.class.php");
          $this->Res = new grid_transfer_rsvp_res_csv();
          $this->prep_modulos("Res");
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_res_grid'] = true;
          $this->Res->monta_csv();
      } 
      if (!$this->Ini->sc_export_ajax) {
          $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
          $this->pb->setProgressbarMessage($Mens_bar);
          $this->pb->addSteps($this->PB_dif);
      }
      if ($this->Csv_password != "" || $this->Tem_csv_res)
      { 
          $str_zip    = "";
          $Parm_pass  = ($this->Csv_password != "") ? " -p" : "";
          $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
          $Arq_input  = (FALSE !== strpos($this->Csv_f, ' ')) ? " \"" . $this->Csv_f . "\"" :  $this->Csv_f;
          if (is_file($Zip_f)) {
              unlink($Zip_f);
          }
          if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
          {
              chdir($this->Ini->path_third . "/zip/windows");
              $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Csv_password . " " . $Zip_f . " " . $Arq_input;
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
                $str_zip = "./7za " . $Parm_pass . $this->Csv_password . " a " . $Zip_f . " " . $Arq_input;
          }
          elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
          {
              chdir($this->Ini->path_third . "/zip/mac/bin");
              $str_zip = "./7za " . $Parm_pass . $this->Csv_password . " a " . $Zip_f . " " . $Arq_input;
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
          if ($this->Tem_csv_res)
          { 
              $str_zip    = "";
              $Arq_res    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_res_file'];
              $Arq_input  = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Csv_password . " " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  $str_zip = "./7za " . $Parm_pass . $this->Csv_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  $str_zip = "./7za " . $Parm_pass . $this->Csv_password . " a " . $Zip_f . " " . $Arq_input;
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
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_res_grid']);
              unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_res_file']);
          }
          unlink($Arq_input);
          $this->Arquivo = $this->Arq_zip;
          $this->Csv_f   = $this->Zip_f;
          $this->Tit_doc = $this->Tit_zip;
      } 
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- id_transfer
   function NM_export_id_transfer()
   {
             nmgp_Form_Num_Val($this->id_transfer, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->id_transfer);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tra_id_evento
   function NM_export_tra_id_evento()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_tra_id_evento);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tipo_transfer_dsc
   function NM_export_tipo_transfer_dsc()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->tipo_transfer_dsc);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tra_id_usuario
   function NM_export_tra_id_usuario()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_tra_id_usuario);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tra_id_hotel
   function NM_export_tra_id_hotel()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_tra_id_hotel);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tra_ult_trecho_volta
   function NM_export_tra_ult_trecho_volta()
   {
             nmgp_Form_Num_Val($this->tra_ult_trecho_volta, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->tra_ult_trecho_volta);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- transfer_gray
   function NM_export_transfer_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->transfer_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- transfer_green
   function NM_export_transfer_green()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->transfer_green);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- transfer_yellow
   function NM_export_transfer_yellow()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->transfer_yellow);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- transfer_red
   function NM_export_transfer_red()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->transfer_red);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- transfer_roxo
   function NM_export_transfer_roxo()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->transfer_roxo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- grid_aereo
   function NM_export_grid_aereo()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->grid_aereo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- grid_aereo_volta
   function NM_export_grid_aereo_volta()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->grid_aereo_volta);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- grid_bloqueio
   function NM_export_grid_bloqueio()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->grid_bloqueio);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- grid_bloqueio_volta
   function NM_export_grid_bloqueio_volta()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->grid_bloqueio_volta);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- cancelado
   function NM_export_cancelado()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->cancelado);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- cancelado_volta
   function NM_export_cancelado_volta()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->cancelado_volta);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tra_dt_alteracao
   function NM_export_tra_dt_alteracao()
   {
             if (substr($this->tra_dt_alteracao, 10, 1) == "-") 
             { 
                 $this->tra_dt_alteracao = substr($this->tra_dt_alteracao, 0, 10) . " " . substr($this->tra_dt_alteracao, 11);
             } 
             if (substr($this->tra_dt_alteracao, 13, 1) == ".") 
             { 
                $this->tra_dt_alteracao = substr($this->tra_dt_alteracao, 0, 13) . ":" . substr($this->tra_dt_alteracao, 14, 2) . ":" . substr($this->tra_dt_alteracao, 17);
             } 
             $conteudo_x =  $this->tra_dt_alteracao;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->tra_dt_alteracao, "YYYY-MM-DD HH:II:SS  ");
                 $this->tra_dt_alteracao = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->tra_dt_alteracao);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tra_id_aereo
   function NM_export_tra_id_aereo()
   {
             nmgp_Form_Num_Val($this->tra_id_aereo, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->tra_id_aereo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- tra_id_bloqueio
   function NM_export_tra_id_bloqueio()
   {
         nmgp_Form_Num_Val($this->look_tra_id_bloqueio, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->look_tra_id_bloqueio);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>BRSVP - Transfer :: CSV</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Pragma" content="no-cache">
 <link rel="shortcut icon" href="../_lib/img/scriptcase__NM__ico__NM__favicon.ico">
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
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
   <td class="scExportTitle" style="height: 25px">CSV</td>
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
<form name="Fdown" method="get" action="grid_transfer_rsvp_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_transfer_rsvp"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_transfer_rsvp']['csv_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_transfer_rsvp']['contr_erro'] = 'off';
}

}

?>
