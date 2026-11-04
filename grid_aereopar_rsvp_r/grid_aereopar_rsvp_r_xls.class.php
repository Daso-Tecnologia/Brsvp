<?php

class grid_aereopar_rsvp_r_xls
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Xls_dados;
   var $Xls_workbook;
   var $Xls_col;
   var $Xls_row;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();
   var $NM_ctrl_style = array();
   var $array_eventorel = array();
   var $Arquivo;
   var $Tit_doc;
   var $count_ger;
   //---- 
   function __construct()
   {
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
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida']) {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xls_f);
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
      else { 
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['opcao'] = "";
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
                   nm_limpa_str_grid_aereopar_rsvp_r($cadapar[1]);
                   nm_protect_num_grid_aereopar_rsvp_r($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_aereopar_rsvp_r']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_aereopar_rsvp_r($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_aereopar_rsvp_r($_SESSION["vg_usuario_id"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_aereopar_rsvp_r($_SESSION["parm1"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_aereopar_rsvp_r($_SESSION["rsvp_global"]);
      }
      $this->Use_phpspreadsheet = (phpversion() >=  "7.3.9" && is_dir($this->Ini->path_third . '/phpspreadsheet')) ? true : false;
      $this->Xls_tot_col = 0;
      $this->Xls_row     = 0;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
      { 
          if ($this->Use_phpspreadsheet) {
              require_once $this->Ini->path_third . '/phpspreadsheet/vendor/autoload.php';
          } 
          else { 
              set_include_path(get_include_path() . PATH_SEPARATOR . $this->Ini->path_third . '/phpexcel/');
              require_once $this->Ini->path_third . '/phpexcel/PHPExcel.php';
              require_once $this->Ini->path_third . '/phpexcel/PHPExcel/IOFactory.php';
              require_once $this->Ini->path_third . '/phpexcel/PHPExcel/Cell/AdvancedValueBinder.php';
          } 
      } 
      $orig_form_dt = strtoupper($_SESSION['scriptcase']['reg_conf']['date_format']);
      $this->SC_date_conf_region = "";
      for ($i = 0; $i < 8; $i++)
      {
          if ($i > 0 && substr($orig_form_dt, $i, 1) != substr($this->SC_date_conf_region, -1, 1)) {
              $this->SC_date_conf_region .= $_SESSION['scriptcase']['reg_conf']['date_sep'];
          }
          $this->SC_date_conf_region .= substr($orig_form_dt, $i, 1);
      }
      $this->Xls_tp = ".xlsx";
      if (isset($_REQUEST['nmgp_tp_xls']) && !empty($_REQUEST['nmgp_tp_xls']))
      {
          $this->Xls_tp = "." . $_REQUEST['nmgp_tp_xls'];
      }
      $this->groupby_show = "S";
      if (isset($_REQUEST['nmgp_tot_xls']) && !empty($_REQUEST['nmgp_tot_xls']))
      {
          $this->groupby_show = $_REQUEST['nmgp_tot_xls'];
      }
      $this->Xls_col      = 0;
      $this->Tem_xls_res  = false;
      $this->Xls_password = "";
      $this->nm_data      = new nm_data("pt_br");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
      { 
          $this->Tem_xls_res  = true;
          if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
          { 
              $this->Tem_xls_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false || strpos(" " . $_REQUEST['SC_module_export'], "chart") !== false) ? true : false;
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['SC_Ind_Groupby'] == "sc_free_total")
          {
              $this->Tem_xls_res  = false;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['SC_Gb_Free_cmp']))
          {
              $this->Tem_xls_res  = false;
          }
          if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_aereopar_rsvp_r/grid_aereopar_rsvp_r_res_xls.class.php"))
          {
              $this->Tem_xls_res  = false;
          }
          if ($this->Tem_xls_res)
          { 
              require_once($this->Ini->path_aplicacao . "grid_aereopar_rsvp_r_res_xls.class.php");
              $this->Res_xls = new grid_aereopar_rsvp_r_res_xls();
              $this->prep_modulos("Res_xls");
          } 
          $this->Arquivo    = "sc_xls";
          $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
          $this->Arq_zip    = $this->Arquivo . "_grid_aereopar_rsvp_r.zip";
          $this->Arquivo   .= "_grid_aereopar_rsvp_r" . $this->Xls_tp;
          $this->Tit_doc    = "grid_aereopar_rsvp_r" . $this->Xls_tp;
          $this->Tit_zip    = "grid_aereopar_rsvp_r.zip";
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          if ($this->Use_phpspreadsheet) {
              $this->Xls_dados = new PhpOffice\PhpSpreadsheet\Spreadsheet();
              \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );
          }
          else {
              PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
              $this->Xls_dados = new PHPExcel();
          }
          $this->Xls_dados->setActiveSheetIndex(0);
          $this->Nm_ActiveSheet = $this->Xls_dados->getActiveSheet();
          $this->Nm_ActiveSheet->setTitle($this->Ini->Nm_lang['lang_othr_grid_titl']);
          if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
          {
              $this->Nm_ActiveSheet->setRightToLeft(true);
          }
      }
      require_once($this->Ini->path_aplicacao . "grid_aereopar_rsvp_r_total.class.php"); 
      $this->Tot = new grid_aereopar_rsvp_r_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['SC_Ind_Groupby'];
      $this->Tot->$Gb_geral();
      $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['tot_geral'][1];
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_aereopar_rsvp_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_return']);
          if ($this->Tem_xls_res) {
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
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_aereopar_rsvp_r']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['field_order'] as $Cada_cmp)
      {
          if (!isset($this->NM_cmp_hidden[$Cada_cmp]) || $this->NM_cmp_hidden[$Cada_cmp] != "off")
          {
              $this->Xls_tot_col++;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->participante_cpf = (isset($Busca_temp['participante_cpf'])) ? $Busca_temp['participante_cpf'] : ""; 
          $tmp_pos = (is_string($this->participante_cpf)) ? strpos($this->participante_cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->participante_cpf))
          {
              $this->participante_cpf = substr($this->participante_cpf, 0, $tmp_pos);
          }
          $this->participante_nome = (isset($Busca_temp['participante_nome'])) ? $Busca_temp['participante_nome'] : ""; 
          $tmp_pos = (is_string($this->participante_nome)) ? strpos($this->participante_nome, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->participante_nome))
          {
              $this->participante_nome = substr($this->participante_nome, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
          $this->cod_cia_aerea = (isset($Busca_temp['cod_cia_aerea'])) ? $Busca_temp['cod_cia_aerea'] : ""; 
          $tmp_pos = (is_string($this->cod_cia_aerea)) ? strpos($this->cod_cia_aerea, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_cia_aerea))
          {
              $this->cod_cia_aerea = substr($this->cod_cia_aerea, 0, $tmp_pos);
          }
          $this->cia_aerea = (isset($Busca_temp['cia_aerea'])) ? $Busca_temp['cia_aerea'] : ""; 
          $tmp_pos = (is_string($this->cia_aerea)) ? strpos($this->cia_aerea, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cia_aerea))
          {
              $this->cia_aerea = substr($this->cia_aerea, 0, $tmp_pos);
          }
          $this->voo = (isset($Busca_temp['voo'])) ? $Busca_temp['voo'] : ""; 
          $tmp_pos = (is_string($this->voo)) ? strpos($this->voo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->voo))
          {
              $this->voo = substr($this->voo, 0, $tmp_pos);
          }
          $this->direcao = (isset($Busca_temp['direcao'])) ? $Busca_temp['direcao'] : ""; 
          $tmp_pos = (is_string($this->direcao)) ? strpos($this->direcao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->direcao))
          {
              $this->direcao = substr($this->direcao, 0, $tmp_pos);
          }
          $this->origem = (isset($Busca_temp['origem'])) ? $Busca_temp['origem'] : ""; 
          $tmp_pos = (is_string($this->origem)) ? strpos($this->origem, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->origem))
          {
              $this->origem = substr($this->origem, 0, $tmp_pos);
          }
          $this->destino = (isset($Busca_temp['destino'])) ? $Busca_temp['destino'] : ""; 
          $tmp_pos = (is_string($this->destino)) ? strpos($this->destino, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->destino))
          {
              $this->destino = substr($this->destino, 0, $tmp_pos);
          }
          $this->localizador = (isset($Busca_temp['localizador'])) ? $Busca_temp['localizador'] : ""; 
          $tmp_pos = (is_string($this->localizador)) ? strpos($this->localizador, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->localizador))
          {
              $this->localizador = substr($this->localizador, 0, $tmp_pos);
          }
          $this->etkt = (isset($Busca_temp['etkt'])) ? $Busca_temp['etkt'] : ""; 
          $tmp_pos = (is_string($this->etkt)) ? strpos($this->etkt, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->etkt))
          {
              $this->etkt = substr($this->etkt, 0, $tmp_pos);
          }
          $this->emitida_bvt = (isset($Busca_temp['emitida_bvt'])) ? $Busca_temp['emitida_bvt'] : ""; 
          $tmp_pos = (is_string($this->emitida_bvt)) ? strpos($this->emitida_bvt, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->emitida_bvt))
          {
              $this->emitida_bvt = substr($this->emitida_bvt, 0, $tmp_pos);
          }
          $this->bloqueio_dsc = (isset($Busca_temp['bloqueio_dsc'])) ? $Busca_temp['bloqueio_dsc'] : ""; 
          $tmp_pos = (is_string($this->bloqueio_dsc)) ? strpos($this->bloqueio_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->bloqueio_dsc))
          {
              $this->bloqueio_dsc = substr($this->bloqueio_dsc, 0, $tmp_pos);
          }
          $this->data_saida = (isset($Busca_temp['data_saida'])) ? $Busca_temp['data_saida'] : ""; 
          $tmp_pos = (is_string($this->data_saida)) ? strpos($this->data_saida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_saida))
          {
              $this->data_saida = substr($this->data_saida, 0, $tmp_pos);
          }
          $this->data_saida_2 = (isset($Busca_temp['data_saida_input_2'])) ? $Busca_temp['data_saida_input_2'] : ""; 
          $this->hora_saida = (isset($Busca_temp['hora_saida'])) ? $Busca_temp['hora_saida'] : ""; 
          $tmp_pos = (is_string($this->hora_saida)) ? strpos($this->hora_saida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hora_saida))
          {
              $this->hora_saida = substr($this->hora_saida, 0, $tmp_pos);
          }
          $this->data_chegada = (isset($Busca_temp['data_chegada'])) ? $Busca_temp['data_chegada'] : ""; 
          $tmp_pos = (is_string($this->data_chegada)) ? strpos($this->data_chegada, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_chegada))
          {
              $this->data_chegada = substr($this->data_chegada, 0, $tmp_pos);
          }
          $this->data_chegada_2 = (isset($Busca_temp['data_chegada_input_2'])) ? $Busca_temp['data_chegada_input_2'] : ""; 
          $this->hora_chegada = (isset($Busca_temp['hora_chegada'])) ? $Busca_temp['hora_chegada'] : ""; 
          $tmp_pos = (is_string($this->hora_chegada)) ? strpos($this->hora_chegada, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hora_chegada))
          {
              $this->hora_chegada = substr($this->hora_chegada, 0, $tmp_pos);
          }
          $this->data_nota_gate = (isset($Busca_temp['data_nota_gate'])) ? $Busca_temp['data_nota_gate'] : ""; 
          $tmp_pos = (is_string($this->data_nota_gate)) ? strpos($this->data_nota_gate, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->data_nota_gate))
          {
              $this->data_nota_gate = substr($this->data_nota_gate, 0, $tmp_pos);
          }
          $this->data_nota_gate_2 = (isset($Busca_temp['data_nota_gate_input_2'])) ? $Busca_temp['data_nota_gate_input_2'] : ""; 
          $this->nota_gate = (isset($Busca_temp['nota_gate'])) ? $Busca_temp['nota_gate'] : ""; 
          $tmp_pos = (is_string($this->nota_gate)) ? strpos($this->nota_gate, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nota_gate))
          {
              $this->nota_gate = substr($this->nota_gate, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['rsvp_global'])) {$_SESSION['rsvp_global'] = "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
if (!isset($_SESSION['parm1'])) {$_SESSION['parm1'] = "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$resultado = 'ADICIONA OK';
$this->sc_temp_vg_evento_id = $this->sc_temp_parm1;

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

$this->usuario_nivel  = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
if ($this->usuario_nivel  <> 'ADMINISTRADOR') {
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
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_aereopar_rsvp_r";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['sc_outra_jan'] = false;
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
        action="grid_aereopar_rsvp_r_fim.php"
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

$resultado = $this->PrepRelAereo($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'P',$this->usuario_nivel );
$resultado2 = $this->PrepR2($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'A',$this->usuario_nivel );
	
if ($resultado == 'ADICIONA OK' && $resultado2 == 'ADICIONA OK2') {
	$this->usuario_nivel  = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
	$this->RetNivel($this->usuario_nivel );
	$this->rodape  = 'Logado: '.$this->sc_temp_vg_usuario_id.' - '.$this->usuario_nivel ;
	$this->id_evento  = $this->sc_temp_vg_evento_id;
	$this->id_usuario_relato  = $this->sc_temp_vg_usuario_id;
	
} else {
	$params = array(
	'title' => 'Atenção!',
	'type' => 'warning',
	'timer' => '5000',
	'showConfirmButton' => 'false',
	'position' => 'center',
	'toast' => 'true'
	);
	$this->nm_mens_alert[] = "Erro ao carregar o relatório RSVP!";$this->nm_params_alert[] = $params;}

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_name'] .= $this->Xls_tp;
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida_label']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida_label'])
      { 
          $this->count_span = 0;
          $this->Xls_row++;
          $this->proc_label();
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
          return;
      } 
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT participante_cpf, participante_nome, tipo_pessoa, satus, direcao, cia_aerea, voo, origem, destino, str_replace (convert(char(10),data_saida,102), '.', '-') + ' ' + convert(char(8),data_saida,20), str_replace (convert(char(10),hora_saida,102), '.', '-') + ' ' + convert(char(8),hora_saida,20), str_replace (convert(char(10),data_chegada,102), '.', '-') + ' ' + convert(char(8),data_chegada,20), str_replace (convert(char(10),hora_chegada,102), '.', '-') + ' ' + convert(char(8),hora_chegada,20), localizador, etkt, emitida_bvt, usuario_nome, modificado_em, bloqueio_dsc, usado_bloqueio, total_bloqueio, direcao_bloqueio, pax_gate, nota_gate, str_replace (convert(char(10),data_nota_gate,102), '.', '-') + ' ' + convert(char(8),data_nota_gate,20), ativo, publico, id_aereopar, id_evento, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT participante_cpf, participante_nome, tipo_pessoa, satus, direcao, cia_aerea, voo, origem, destino, data_saida, hora_saida, data_chegada, hora_chegada, localizador, etkt, emitida_bvt, usuario_nome, modificado_em, bloqueio_dsc, usado_bloqueio, total_bloqueio, direcao_bloqueio, pax_gate, nota_gate, data_nota_gate, ativo, publico, id_aereopar, id_evento, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT participante_cpf, participante_nome, tipo_pessoa, satus, direcao, cia_aerea, voo, origem, destino, convert(char(23),data_saida,121), convert(char(23),hora_saida,121), convert(char(23),data_chegada,121), convert(char(23),hora_chegada,121), localizador, etkt, emitida_bvt, usuario_nome, modificado_em, bloqueio_dsc, usado_bloqueio, total_bloqueio, direcao_bloqueio, pax_gate, nota_gate, convert(char(23),data_nota_gate,121), ativo, publico, id_aereopar, id_evento, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT participante_cpf, participante_nome, tipo_pessoa, satus, direcao, cia_aerea, voo, origem, destino, data_saida, hora_saida, data_chegada, hora_chegada, localizador, etkt, emitida_bvt, usuario_nome, TO_DATE(TO_CHAR(modificado_em, 'yyyy-mm-dd hh24:mi:ss'), 'yyyy-mm-dd hh24:mi:ss'), bloqueio_dsc, usado_bloqueio, total_bloqueio, direcao_bloqueio, pax_gate, nota_gate, data_nota_gate, ativo, publico, id_aereopar, id_evento, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT participante_cpf, participante_nome, tipo_pessoa, satus, direcao, cia_aerea, voo, origem, destino, EXTEND(data_saida, YEAR TO DAY), hora_saida, EXTEND(data_chegada, YEAR TO DAY), hora_chegada, localizador, etkt, emitida_bvt, usuario_nome, modificado_em, bloqueio_dsc, usado_bloqueio, total_bloqueio, direcao_bloqueio, pax_gate, nota_gate, EXTEND(data_nota_gate, YEAR TO DAY), ativo, publico, id_aereopar, id_evento, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT participante_cpf, participante_nome, tipo_pessoa, satus, direcao, cia_aerea, voo, origem, destino, data_saida, hora_saida, data_chegada, hora_chegada, localizador, etkt, emitida_bvt, usuario_nome, modificado_em, bloqueio_dsc, usado_bloqueio, total_bloqueio, direcao_bloqueio, pax_gate, nota_gate, data_nota_gate, ativo, publico, id_aereopar, id_evento, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $prim_reg = true;
      $prim_gb  = true;
      $nm_houve_quebra = "N";
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         $prim_reg = false;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->Xls_col = 0;
         $this->Xls_row++;
         $this->participante_cpf = $rs->fields[0] ;  
         $this->participante_nome = $rs->fields[1] ;  
         $this->tipo_pessoa = $rs->fields[2] ;  
         $this->satus = $rs->fields[3] ;  
         $this->direcao = $rs->fields[4] ;  
         $this->cia_aerea = $rs->fields[5] ;  
         $this->voo = $rs->fields[6] ;  
         $this->origem = $rs->fields[7] ;  
         $this->destino = $rs->fields[8] ;  
         $this->data_saida = $rs->fields[9] ;  
         $this->hora_saida = $rs->fields[10] ;  
         $this->data_chegada = $rs->fields[11] ;  
         $this->hora_chegada = $rs->fields[12] ;  
         $this->localizador = $rs->fields[13] ;  
         $this->etkt = $rs->fields[14] ;  
         $this->emitida_bvt = $rs->fields[15] ;  
         $this->usuario_nome = $rs->fields[16] ;  
         $this->modificado_em = $rs->fields[17] ;  
         $this->bloqueio_dsc = $rs->fields[18] ;  
         $this->usado_bloqueio = $rs->fields[19] ;  
         $this->usado_bloqueio = (string)$this->usado_bloqueio;
         $this->total_bloqueio = $rs->fields[20] ;  
         $this->total_bloqueio = (string)$this->total_bloqueio;
         $this->direcao_bloqueio = $rs->fields[21] ;  
         $this->pax_gate = $rs->fields[22] ;  
         $this->nota_gate = $rs->fields[23] ;  
         $this->data_nota_gate = $rs->fields[24] ;  
         $this->ativo = $rs->fields[25] ;  
         $this->publico = $rs->fields[26] ;  
         $this->id_aereopar = $rs->fields[27] ;  
         $this->id_aereopar = (string)$this->id_aereopar;
         $this->id_evento = $rs->fields[28] ;  
         $this->id_evento = (string)$this->id_evento;
         $this->id_usuario_relato = $rs->fields[29] ;  
         $this->id_usuario_relato = (string)$this->id_usuario_relato;
     if ($this->groupby_show == "S") {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
         { 
             if ($prim_gb) {
                 $this->count_span = 0;
                 $this->proc_label();
             }
             if ($prim_gb || $nm_houve_quebra == "S") {
                 $this->xls_sub_cons_copy_label($this->Xls_row);
                 $this->Xls_row++;
             }
         }
         elseif ($prim_gb || $nm_houve_quebra == "S")
         {
             $this->count_span = 0;
             $this->proc_label();
         }
     }
     else {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
         { 
             if ($prim_gb)
             {
                 $this->count_span = 0;
                 $this->proc_label();
                 $this->xls_sub_cons_copy_label($this->Xls_row);
                 $this->Xls_row++;
             }
         }
         elseif ($prim_gb)
         {
             $this->count_span = 0;
             $this->proc_label();
         }
     }
     $prim_gb = false;
     $nm_houve_quebra = "N";
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  date_default_timezone_set('America/Sao_Paulo');
$this->NM_field_style["participante_nome"] = "background-color:;font-size:bold;color:#0033ff;";
$this->NM_field_style["tipo_pessoa"] = "background-color:;font-size:bold;color:#0099ff;";
$this->NM_field_style["emitida_bvt"] = "background-color:;font-size:bold;color:#ff6600;";
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
                { 
                    $NM_func_exp = "NM_sub_cons_" . $Cada_col;
                    $this->$NM_func_exp();
                } 
                else 
                { 
                    $NM_func_exp = "NM_export_" . $Cada_col;
                    $this->$NM_func_exp();
                } 
            } 
         } 
         if (isset($this->NM_Row_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
         { 
             foreach ($this->NM_Row_din as $row => $height) 
             { 
                 $this->Nm_ActiveSheet->getRowDimension($row)->setRowHeight($height);
             } 
         } 
         $rs->MoveNext();
      }
      $this->xls_set_style();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'] && $prim_reg)
      { 
          $this->proc_label();
          $this->xls_sub_cons_copy_label($this->Xls_row);
          $nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
          $nm_grid_sem_reg  = NM_charset_to_utf8($nm_grid_sem_reg);
          $this->Xls_row++;
          $this->arr_export['lines'][$this->Xls_row][1]['data']   = $nm_grid_sem_reg;
          $this->arr_export['lines'][$this->Xls_row][1]['align']  = "right";
          $this->arr_export['lines'][$this->Xls_row][1]['type']   = "char";
          $this->arr_export['lines'][$this->Xls_row][1]['format'] = "";
      }
      if (isset($this->NM_Col_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      if ($this->groupby_show == "S") {
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
      { 
          if ($this->Tem_xls_res)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_res_grid'] = true;
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              $this->Res_xls->monta_xls();
              if ($this->Use_phpspreadsheet) {
                  $Xls_res = \PhpOffice\PhpSpreadsheet\IOFactory::load($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_res_sheet']);
              }
              else {
                  $Xls_res = PHPExcel_IOFactory::load($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_res_sheet']);
              }
              foreach($Xls_res->getAllSheets() as $sheet)
              {
                  $this->Xls_dados->addExternalSheet($sheet);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_res_grid']);
              unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_res_sheet']);
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Use_phpspreadsheet) {
              if ($this->Xls_tp == ".xlsx") {
                  $objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($this->Xls_dados);
              } 
              else {
                  $objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xls($this->Xls_dados);
              } 
          } 
          else {
              if ($this->Xls_tp == ".xlsx") {
                  $objWriter = new PHPExcel_Writer_Excel2007($this->Xls_dados);
              } 
              else {
                  $objWriter = new PHPExcel_Writer_Excel5($this->Xls_dados);
              } 
          } 
          $objWriter->save($this->Xls_f);
          if ($this->Xls_password != "")
          { 
              $str_zip   = "";
              $Zip_f     = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input = (FALSE !== strpos($this->Xls_f, ' ')) ? " \"" . $this->Xls_f . "\"" :  $this->Xls_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe -P -j " . $this->Xls_password . " " . $Zip_f . " " . $Arq_input;
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
                  $str_zip = "./7za -p" . $this->Xls_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za -p" . $this->Xls_password . " a " . $Zip_f . " " . $Arq_input;
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
              $this->Xls_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
          } 
      } 
      else 
      { 
          $_SESSION['scriptcase']['export_return'] = $this->arr_export;
      } 
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   function proc_label()
   { 
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['participante_cpf'])) ? $this->New_label['participante_cpf'] : "Participante Cód."; 
          if ($Cada_col == "participante_cpf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['participante_nome'])) ? $this->New_label['participante_nome'] : "Nome"; 
          if ($Cada_col == "participante_nome" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['tipo_pessoa'])) ? $this->New_label['tipo_pessoa'] : "Tipo"; 
          if ($Cada_col == "tipo_pessoa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['satus'])) ? $this->New_label['satus'] : "Satus"; 
          if ($Cada_col == "satus" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['direcao'])) ? $this->New_label['direcao'] : "Direção"; 
          if ($Cada_col == "direcao" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['cia_aerea'])) ? $this->New_label['cia_aerea'] : "Cia Aérea"; 
          if ($Cada_col == "cia_aerea" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['voo'])) ? $this->New_label['voo'] : "Voo"; 
          if ($Cada_col == "voo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['origem'])) ? $this->New_label['origem'] : "Origem"; 
          if ($Cada_col == "origem" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['destino'])) ? $this->New_label['destino'] : "Destino"; 
          if ($Cada_col == "destino" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['data_saida'])) ? $this->New_label['data_saida'] : "Data Saída"; 
          if ($Cada_col == "data_saida" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['hora_saida'])) ? $this->New_label['hora_saida'] : "Hora Saída"; 
          if ($Cada_col == "hora_saida" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['data_chegada'])) ? $this->New_label['data_chegada'] : "Data Chegada"; 
          if ($Cada_col == "data_chegada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['hora_chegada'])) ? $this->New_label['hora_chegada'] : "Hora Chegada"; 
          if ($Cada_col == "hora_chegada" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['localizador'])) ? $this->New_label['localizador'] : "Localizador"; 
          if ($Cada_col == "localizador" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['etkt'])) ? $this->New_label['etkt'] : "Etkt"; 
          if ($Cada_col == "etkt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['emitida_bvt'])) ? $this->New_label['emitida_bvt'] : "Emitida Bvt"; 
          if ($Cada_col == "emitida_bvt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['usuario_nome'])) ? $this->New_label['usuario_nome'] : "Atendente"; 
          if ($Cada_col == "usuario_nome" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['modificado_em'])) ? $this->New_label['modificado_em'] : "Modificado Em"; 
          if ($Cada_col == "modificado_em" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['bloqueio_dsc'])) ? $this->New_label['bloqueio_dsc'] : "Bloqueio"; 
          if ($Cada_col == "bloqueio_dsc" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['usado_bloqueio'])) ? $this->New_label['usado_bloqueio'] : "Usado Bloqueio"; 
          if ($Cada_col == "usado_bloqueio" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['total_bloqueio'])) ? $this->New_label['total_bloqueio'] : "Total Bloqueio"; 
          if ($Cada_col == "total_bloqueio" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['direcao_bloqueio'])) ? $this->New_label['direcao_bloqueio'] : "Direção do Bloqueio"; 
          if ($Cada_col == "direcao_bloqueio" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['pax_gate'])) ? $this->New_label['pax_gate'] : "Pax Gate"; 
          if ($Cada_col == "pax_gate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['nota_gate'])) ? $this->New_label['nota_gate'] : "Nota Gate"; 
          if ($Cada_col == "nota_gate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['data_nota_gate'])) ? $this->New_label['data_nota_gate'] : "Data Nota Gate"; 
          if ($Cada_col == "data_nota_gate" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "center";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['ativo'])) ? $this->New_label['ativo'] : "Ativo"; 
          if ($Cada_col == "ativo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['publico'])) ? $this->New_label['publico'] : "Público"; 
          if ($Cada_col == "publico" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "left";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['id_aereopar'])) ? $this->New_label['id_aereopar'] : "Id Aereopar"; 
          if ($Cada_col == "id_aereopar" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
          $SC_Label = (isset($this->New_label['id_evento'])) ? $this->New_label['id_evento'] : "Id Evento"; 
          if ($Cada_col == "id_evento" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['embutida'])
              { 
                  $this->arr_export['label'][$this->Xls_col]['data']     = $SC_Label;
                  $this->arr_export['label'][$this->Xls_col]['align']    = "right";
                  $this->arr_export['label'][$this->Xls_col]['autosize'] = "s";
                  $this->arr_export['label'][$this->Xls_col]['bold']     = "s";
              }
              else
              { 
                  if ($this->Use_phpspreadsheet) {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                  }
                  else {
                      $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                      $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $SC_Label, PHPExcel_Cell_DataType::TYPE_STRING);
                  }
                  $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getFont()->setBold(true);
                  $this->Nm_ActiveSheet->getColumnDimension($current_cell_ref)->setAutoSize(true);
              }
              $this->Xls_col++;
          }
      } 
      $this->Xls_col = 0;
      $this->Xls_row++;
   } 
   //----- participante_cpf
   function NM_export_participante_cpf()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->participante_cpf = html_entity_decode($this->participante_cpf, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_cpf = strip_tags($this->participante_cpf);
         $this->participante_cpf = NM_charset_to_utf8($this->participante_cpf);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_cpf, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_cpf, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_nome
   function NM_export_participante_nome()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->participante_nome = html_entity_decode($this->participante_nome, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_nome = NM_charset_to_utf8($this->participante_nome);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_nome, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_nome, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- tipo_pessoa
   function NM_export_tipo_pessoa()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->tipo_pessoa = html_entity_decode($this->tipo_pessoa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_pessoa = strip_tags($this->tipo_pessoa);
         $this->tipo_pessoa = NM_charset_to_utf8($this->tipo_pessoa);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->tipo_pessoa, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->tipo_pessoa, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- satus
   function NM_export_satus()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->satus = html_entity_decode($this->satus, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->satus = strip_tags($this->satus);
         $this->satus = NM_charset_to_utf8($this->satus);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->satus, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->satus, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- direcao
   function NM_export_direcao()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->direcao = html_entity_decode($this->direcao, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direcao = strip_tags($this->direcao);
         $this->direcao = NM_charset_to_utf8($this->direcao);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->direcao, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->direcao, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- cia_aerea
   function NM_export_cia_aerea()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->cia_aerea = html_entity_decode($this->cia_aerea, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cia_aerea = strip_tags($this->cia_aerea);
         $this->cia_aerea = NM_charset_to_utf8($this->cia_aerea);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->cia_aerea, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->cia_aerea, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo
   function NM_export_voo()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->voo = html_entity_decode($this->voo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo = strip_tags($this->voo);
         $this->voo = NM_charset_to_utf8($this->voo);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- origem
   function NM_export_origem()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
      if (!empty($this->origem))
      {
             if ($this->origem !== "&nbsp;") 
             { 
                 $this->origem = sc_strtoupper($this->origem); 
             } 
      }
         $this->origem = html_entity_decode($this->origem, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->origem = strip_tags($this->origem);
         $this->origem = NM_charset_to_utf8($this->origem);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->origem, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->origem, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- destino
   function NM_export_destino()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
      if (!empty($this->destino))
      {
             if ($this->destino !== "&nbsp;") 
             { 
                 $this->destino = sc_strtoupper($this->destino); 
             } 
      }
         $this->destino = html_entity_decode($this->destino, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->destino = strip_tags($this->destino);
         $this->destino = NM_charset_to_utf8($this->destino);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->destino, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->destino, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- data_saida
   function NM_export_data_saida()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "CENTER"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->data_saida = substr($this->data_saida, 0, 10);
         if (empty($this->data_saida) || $this->data_saida == "0000-00-00")
         {
             if ($this->Use_phpspreadsheet) {
                 $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->data_saida, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
             }
             else {
                 $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->data_saida, PHPExcel_Cell_DataType::TYPE_STRING);
             }
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->data_saida);
             $this->NM_ctrl_style[$current_cell_ref]['format'] = $this->SC_date_conf_region;
         }
         $this->Xls_col++;
   }
   //----- hora_saida
   function NM_export_hora_saida()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "CENTER"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
      if (!empty($this->hora_saida))
      {
             $conteudo_x =  $this->hora_saida;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hora_saida, "HH:II:SS  ");
                 $this->hora_saida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
      }
         $this->hora_saida = NM_charset_to_utf8($this->hora_saida);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hora_saida, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hora_saida, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- data_chegada
   function NM_export_data_chegada()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "CENTER"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->data_chegada = substr($this->data_chegada, 0, 10);
         if (empty($this->data_chegada) || $this->data_chegada == "0000-00-00")
         {
             if ($this->Use_phpspreadsheet) {
                 $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->data_chegada, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
             }
             else {
                 $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->data_chegada, PHPExcel_Cell_DataType::TYPE_STRING);
             }
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->data_chegada);
             $this->NM_ctrl_style[$current_cell_ref]['format'] = $this->SC_date_conf_region;
         }
         $this->Xls_col++;
   }
   //----- hora_chegada
   function NM_export_hora_chegada()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "CENTER"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
      if (!empty($this->hora_chegada))
      {
             $conteudo_x =  $this->hora_chegada;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hora_chegada, "HH:II:SS  ");
                 $this->hora_chegada = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
      }
         $this->hora_chegada = NM_charset_to_utf8($this->hora_chegada);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hora_chegada, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hora_chegada, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- localizador
   function NM_export_localizador()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->localizador = html_entity_decode($this->localizador, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->localizador = strip_tags($this->localizador);
         $this->localizador = NM_charset_to_utf8($this->localizador);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->localizador, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->localizador, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- etkt
   function NM_export_etkt()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->etkt = html_entity_decode($this->etkt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->etkt = strip_tags($this->etkt);
         $this->etkt = NM_charset_to_utf8($this->etkt);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->etkt, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->etkt, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- emitida_bvt
   function NM_export_emitida_bvt()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->emitida_bvt = html_entity_decode($this->emitida_bvt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->emitida_bvt = strip_tags($this->emitida_bvt);
         $this->emitida_bvt = NM_charset_to_utf8($this->emitida_bvt);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->emitida_bvt, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->emitida_bvt, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- usuario_nome
   function NM_export_usuario_nome()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->usuario_nome = html_entity_decode($this->usuario_nome, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->usuario_nome = strip_tags($this->usuario_nome);
         $this->usuario_nome = NM_charset_to_utf8($this->usuario_nome);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->usuario_nome, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->usuario_nome, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- modificado_em
   function NM_export_modificado_em()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "CENTER"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
      if (!empty($this->modificado_em))
      {
             if (substr($this->modificado_em, 10, 1) == "-") 
             { 
                 $this->modificado_em = substr($this->modificado_em, 0, 10) . " " . substr($this->modificado_em, 11);
             } 
             if (substr($this->modificado_em, 13, 1) == ".") 
             { 
                $this->modificado_em = substr($this->modificado_em, 0, 13) . ":" . substr($this->modificado_em, 14, 2) . ":" . substr($this->modificado_em, 17);
             } 
             $conteudo_x =  $this->modificado_em;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->modificado_em, "YYYY-MM-DD HH:II:SS  ");
                 $this->modificado_em = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
             } 
      }
         $this->modificado_em = NM_charset_to_utf8($this->modificado_em);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->modificado_em, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->modificado_em, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- bloqueio_dsc
   function NM_export_bloqueio_dsc()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
      if (!empty($this->bloqueio_dsc))
      {
             if ($this->bloqueio_dsc !== "&nbsp;") 
             { 
                 $this->bloqueio_dsc = sc_strtoupper($this->bloqueio_dsc); 
             } 
      }
         $this->bloqueio_dsc = html_entity_decode($this->bloqueio_dsc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->bloqueio_dsc = strip_tags($this->bloqueio_dsc);
         $this->bloqueio_dsc = NM_charset_to_utf8($this->bloqueio_dsc);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->bloqueio_dsc, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->bloqueio_dsc, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- usado_bloqueio
   function NM_export_usado_bloqueio()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->usado_bloqueio = NM_charset_to_utf8($this->usado_bloqueio);
         if (is_numeric($this->usado_bloqueio))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->usado_bloqueio);
         }
         elseif ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->usado_bloqueio, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->usado_bloqueio, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- total_bloqueio
   function NM_export_total_bloqueio()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->total_bloqueio = NM_charset_to_utf8($this->total_bloqueio);
         if (is_numeric($this->total_bloqueio))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->total_bloqueio);
         }
         elseif ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->total_bloqueio, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->total_bloqueio, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- direcao_bloqueio
   function NM_export_direcao_bloqueio()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->direcao_bloqueio = html_entity_decode($this->direcao_bloqueio, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direcao_bloqueio = strip_tags($this->direcao_bloqueio);
         $this->direcao_bloqueio = NM_charset_to_utf8($this->direcao_bloqueio);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->direcao_bloqueio, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->direcao_bloqueio, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- pax_gate
   function NM_export_pax_gate()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->pax_gate = html_entity_decode($this->pax_gate, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pax_gate = strip_tags($this->pax_gate);
         $this->pax_gate = NM_charset_to_utf8($this->pax_gate);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->pax_gate, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->pax_gate, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- nota_gate
   function NM_export_nota_gate()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->nota_gate = html_entity_decode($this->nota_gate, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nota_gate = strip_tags($this->nota_gate);
         $this->nota_gate = NM_charset_to_utf8($this->nota_gate);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->nota_gate, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->nota_gate, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- data_nota_gate
   function NM_export_data_nota_gate()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "CENTER"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->data_nota_gate = substr($this->data_nota_gate, 0, 10);
         if (empty($this->data_nota_gate) || $this->data_nota_gate == "0000-00-00")
         {
             if ($this->Use_phpspreadsheet) {
                 $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->data_nota_gate, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
             }
             else {
                 $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->data_nota_gate, PHPExcel_Cell_DataType::TYPE_STRING);
             }
         }
         else
         {
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->data_nota_gate);
             $this->NM_ctrl_style[$current_cell_ref]['format'] = $this->SC_date_conf_region;
         }
         $this->Xls_col++;
   }
   //----- ativo
   function NM_export_ativo()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->ativo = html_entity_decode($this->ativo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ativo = strip_tags($this->ativo);
         $this->ativo = NM_charset_to_utf8($this->ativo);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ativo, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->ativo, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- publico
   function NM_export_publico()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "LEFT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->publico = html_entity_decode($this->publico, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->publico = strip_tags($this->publico);
         $this->publico = NM_charset_to_utf8($this->publico);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->publico, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->publico, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- id_aereopar
   function NM_export_id_aereopar()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->id_aereopar = NM_charset_to_utf8($this->id_aereopar);
         if (is_numeric($this->id_aereopar))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->id_aereopar);
         }
         elseif ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->id_aereopar, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->id_aereopar, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- id_evento
   function NM_export_id_evento()
   {
         $current_cell_ref = $this->calc_cell($this->Xls_col);
         if (!isset($this->NM_ctrl_style[$current_cell_ref])) {
             $this->NM_ctrl_style[$current_cell_ref]['ini'] = $this->Xls_row;
             $this->NM_ctrl_style[$current_cell_ref]['align'] = "RIGHT"; 
         }
         $this->NM_ctrl_style[$current_cell_ref]['end'] = $this->Xls_row;
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
         }
         else {
             $this->Nm_ActiveSheet->getStyle($current_cell_ref . $this->Xls_row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
         }
         $this->id_evento = NM_charset_to_utf8($this->id_evento);
         if (is_numeric($this->id_evento))
         {
             $this->NM_ctrl_style[$current_cell_ref]['format'] = '#,##0';
             $this->Nm_ActiveSheet->setCellValue($current_cell_ref . $this->Xls_row, $this->id_evento);
         }
         elseif ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->id_evento, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->id_evento, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_cpf
   function NM_sub_cons_participante_cpf()
   {
         $this->participante_cpf = html_entity_decode($this->participante_cpf, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_cpf = strip_tags($this->participante_cpf);
         $this->participante_cpf = NM_charset_to_utf8($this->participante_cpf);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_cpf;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_nome
   function NM_sub_cons_participante_nome()
   {
         $this->participante_nome = html_entity_decode($this->participante_nome, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_nome = NM_charset_to_utf8($this->participante_nome);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_nome;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- tipo_pessoa
   function NM_sub_cons_tipo_pessoa()
   {
         $this->tipo_pessoa = html_entity_decode($this->tipo_pessoa, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->tipo_pessoa = strip_tags($this->tipo_pessoa);
         $this->tipo_pessoa = NM_charset_to_utf8($this->tipo_pessoa);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->tipo_pessoa;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- satus
   function NM_sub_cons_satus()
   {
         $this->satus = html_entity_decode($this->satus, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->satus = strip_tags($this->satus);
         $this->satus = NM_charset_to_utf8($this->satus);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->satus;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- direcao
   function NM_sub_cons_direcao()
   {
         $this->direcao = html_entity_decode($this->direcao, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direcao = strip_tags($this->direcao);
         $this->direcao = NM_charset_to_utf8($this->direcao);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->direcao;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- cia_aerea
   function NM_sub_cons_cia_aerea()
   {
         $this->cia_aerea = html_entity_decode($this->cia_aerea, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->cia_aerea = strip_tags($this->cia_aerea);
         $this->cia_aerea = NM_charset_to_utf8($this->cia_aerea);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->cia_aerea;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo
   function NM_sub_cons_voo()
   {
         $this->voo = html_entity_decode($this->voo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo = strip_tags($this->voo);
         $this->voo = NM_charset_to_utf8($this->voo);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- origem
   function NM_sub_cons_origem()
   {
      if (!empty($this->origem))
      {
         if ($this->origem !== "&nbsp;") 
         { 
             $this->origem = sc_strtoupper($this->origem); 
         } 
      }
         $this->origem = html_entity_decode($this->origem, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->origem = strip_tags($this->origem);
         $this->origem = NM_charset_to_utf8($this->origem);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->origem;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- destino
   function NM_sub_cons_destino()
   {
      if (!empty($this->destino))
      {
         if ($this->destino !== "&nbsp;") 
         { 
             $this->destino = sc_strtoupper($this->destino); 
         } 
      }
         $this->destino = html_entity_decode($this->destino, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->destino = strip_tags($this->destino);
         $this->destino = NM_charset_to_utf8($this->destino);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->destino;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- data_saida
   function NM_sub_cons_data_saida()
   {
         $this->data_saida = substr($this->data_saida, 0, 10);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->data_saida;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "data";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "center";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = $this->SC_date_conf_region;
         $this->Xls_col++;
   }
   //----- hora_saida
   function NM_sub_cons_hora_saida()
   {
      if (!empty($this->hora_saida))
      {
         $conteudo_x =  $this->hora_saida;
         nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->hora_saida, "HH:II:SS  ");
             $this->hora_saida = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
         } 
      }
         $this->hora_saida = NM_charset_to_utf8($this->hora_saida);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hora_saida;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "center";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- data_chegada
   function NM_sub_cons_data_chegada()
   {
         $this->data_chegada = substr($this->data_chegada, 0, 10);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->data_chegada;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "data";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "center";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = $this->SC_date_conf_region;
         $this->Xls_col++;
   }
   //----- hora_chegada
   function NM_sub_cons_hora_chegada()
   {
      if (!empty($this->hora_chegada))
      {
         $conteudo_x =  $this->hora_chegada;
         nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->hora_chegada, "HH:II:SS  ");
             $this->hora_chegada = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
         } 
      }
         $this->hora_chegada = NM_charset_to_utf8($this->hora_chegada);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hora_chegada;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "center";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- localizador
   function NM_sub_cons_localizador()
   {
         $this->localizador = html_entity_decode($this->localizador, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->localizador = strip_tags($this->localizador);
         $this->localizador = NM_charset_to_utf8($this->localizador);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->localizador;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- etkt
   function NM_sub_cons_etkt()
   {
         $this->etkt = html_entity_decode($this->etkt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->etkt = strip_tags($this->etkt);
         $this->etkt = NM_charset_to_utf8($this->etkt);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->etkt;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- emitida_bvt
   function NM_sub_cons_emitida_bvt()
   {
         $this->emitida_bvt = html_entity_decode($this->emitida_bvt, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->emitida_bvt = strip_tags($this->emitida_bvt);
         $this->emitida_bvt = NM_charset_to_utf8($this->emitida_bvt);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->emitida_bvt;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- usuario_nome
   function NM_sub_cons_usuario_nome()
   {
         $this->usuario_nome = html_entity_decode($this->usuario_nome, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->usuario_nome = strip_tags($this->usuario_nome);
         $this->usuario_nome = NM_charset_to_utf8($this->usuario_nome);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->usuario_nome;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- modificado_em
   function NM_sub_cons_modificado_em()
   {
      if (!empty($this->modificado_em))
      {
         if (substr($this->modificado_em, 10, 1) == "-") 
         { 
             $this->modificado_em = substr($this->modificado_em, 0, 10) . " " . substr($this->modificado_em, 11);
         } 
         if (substr($this->modificado_em, 13, 1) == ".") 
         { 
            $this->modificado_em = substr($this->modificado_em, 0, 13) . ":" . substr($this->modificado_em, 14, 2) . ":" . substr($this->modificado_em, 17);
         } 
         $conteudo_x =  $this->modificado_em;
         nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD HH:II:SS");
         if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
         { 
             $this->nm_data->SetaData($this->modificado_em, "YYYY-MM-DD HH:II:SS  ");
             $this->modificado_em = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DH", "ddmmaaaa;hhiiss"));
         } 
      }
         $this->modificado_em = NM_charset_to_utf8($this->modificado_em);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->modificado_em;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "center";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- bloqueio_dsc
   function NM_sub_cons_bloqueio_dsc()
   {
      if (!empty($this->bloqueio_dsc))
      {
         if ($this->bloqueio_dsc !== "&nbsp;") 
         { 
             $this->bloqueio_dsc = sc_strtoupper($this->bloqueio_dsc); 
         } 
      }
         $this->bloqueio_dsc = html_entity_decode($this->bloqueio_dsc, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->bloqueio_dsc = strip_tags($this->bloqueio_dsc);
         $this->bloqueio_dsc = NM_charset_to_utf8($this->bloqueio_dsc);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->bloqueio_dsc;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- usado_bloqueio
   function NM_sub_cons_usado_bloqueio()
   {
         $this->usado_bloqueio = NM_charset_to_utf8($this->usado_bloqueio);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->usado_bloqueio;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   //----- total_bloqueio
   function NM_sub_cons_total_bloqueio()
   {
         $this->total_bloqueio = NM_charset_to_utf8($this->total_bloqueio);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->total_bloqueio;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   //----- direcao_bloqueio
   function NM_sub_cons_direcao_bloqueio()
   {
         $this->direcao_bloqueio = html_entity_decode($this->direcao_bloqueio, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->direcao_bloqueio = strip_tags($this->direcao_bloqueio);
         $this->direcao_bloqueio = NM_charset_to_utf8($this->direcao_bloqueio);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->direcao_bloqueio;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- pax_gate
   function NM_sub_cons_pax_gate()
   {
         $this->pax_gate = html_entity_decode($this->pax_gate, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->pax_gate = strip_tags($this->pax_gate);
         $this->pax_gate = NM_charset_to_utf8($this->pax_gate);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->pax_gate;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- nota_gate
   function NM_sub_cons_nota_gate()
   {
         $this->nota_gate = html_entity_decode($this->nota_gate, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->nota_gate = strip_tags($this->nota_gate);
         $this->nota_gate = NM_charset_to_utf8($this->nota_gate);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->nota_gate;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- data_nota_gate
   function NM_sub_cons_data_nota_gate()
   {
         $this->data_nota_gate = substr($this->data_nota_gate, 0, 10);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->data_nota_gate;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "data";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "center";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = $this->SC_date_conf_region;
         $this->Xls_col++;
   }
   //----- ativo
   function NM_sub_cons_ativo()
   {
         $this->ativo = html_entity_decode($this->ativo, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->ativo = strip_tags($this->ativo);
         $this->ativo = NM_charset_to_utf8($this->ativo);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->ativo;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- publico
   function NM_sub_cons_publico()
   {
         $this->publico = html_entity_decode($this->publico, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->publico = strip_tags($this->publico);
         $this->publico = NM_charset_to_utf8($this->publico);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->publico;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- id_aereopar
   function NM_sub_cons_id_aereopar()
   {
         $this->id_aereopar = NM_charset_to_utf8($this->id_aereopar);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->id_aereopar;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   //----- id_evento
   function NM_sub_cons_id_evento()
   {
         $this->id_evento = NM_charset_to_utf8($this->id_evento);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->id_evento;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "right";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "num";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "#,##0";
         $this->Xls_col++;
   }
   function xls_sub_cons_copy_label($row)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['nolabel']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['nolabel'])
       {
           foreach ($this->arr_export['label'] as $col => $dados)
           {
               $this->arr_export['lines'][$row][$col] = $dados;
           }
       }
   }
   function xls_set_style()
   {
       if (!empty($this->NM_ctrl_style))
       {
           foreach ($this->NM_ctrl_style as $col => $dados)
           {
               $cell_ref = $col . $dados['ini'] . ":" . $col . $dados['end'];
               if ($this->Use_phpspreadsheet) {
                   if ($dados['align'] == "LEFT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                   }
                   elseif ($dados['align'] == "RIGHT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                   }
               }
               else {
                   if ($dados['align'] == "LEFT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   }
                   elseif ($dados['align'] == "RIGHT") {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                   }
                   else {
                       $this->Nm_ActiveSheet->getStyle($cell_ref)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                   }
               }
               if (isset($dados['format'])) {
                   $this->Nm_ActiveSheet->getStyle($cell_ref)->getNumberFormat()->setFormatCode($dados['format']);
               }
           }
           $this->NM_ctrl_style = array();
       }
   }
   function quebra_geral_sc_free_total_bot() 
   {
   }

   function calc_cell($col)
   {
       $arr_alfa = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
       $val_ret = "";
       $result = $col + 1;
       while ($result > 26)
       {
           $cel      = $result % 26;
           $result   = $result / 26;
           if ($cel == 0)
           {
               $cel    = 26;
               $result--;
           }
           $val_ret = $arr_alfa[$cel] . $val_ret;
       }
       $val_ret = $arr_alfa[$result] . $val_ret;
       return $val_ret;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>BRSVP - Aéreo Participantes :: Excel</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XLS</td>
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
<form name="Fdown" method="get" action="grid_aereopar_rsvp_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_aereopar_rsvp_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_aereopar_rsvp_r']['xls_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function PrepR2($evento,$vp_usuario,$vp_tipo,$vp_nivel) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$ret = 'ADICIONA OK2';
		$valor_y = 'Y';
		$nome_empresa = '';
	
		if($vp_nivel == 'CONVIDADO') {
			$sqlconv = "
				SELECT
					evento_id,
					usuario_id,
					nome_empresa
				FROM
					eventos_usuarios_rsvp			
				WHERE	
					evento_id = ".$this->Db->qstr($evento)."
				AND 
					usuario_id = ".$this->Db->qstr($vp_usuario)."	
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
		if($vp_nivel == 'CONVIDADO') {
			$sqlj = "
			SELECT 
				aereos_rsvp.aereo_id_evento AS a_evento,
				aereos_rsvp.aereo_id_usuario AS a_usuario,
				usuarios_rsvp.usuario_nome AS usuario_nome,
				aereos_rsvp.aereo_cpf_particip AS a_cpf,
				CASE aereos_rsvp.aereo_status 
					WHEN 'Y' THEN 'CONFIRMADO'
					WHEN 'A' THEN 'ABERTO'
					WHEN 'P' THEN 'PENDENTE'
					WHEN 'N' THEN 'NÃO CONFIRMADO'
				END
				AS a_status,
				aereos_rsvp.aereo_direcao AS a_direcao,
				aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
				tbl_cia_aereas.cia_nome AS cia_aerea,
				aereos_rsvp.aereo_num_voo AS a_voo,
				CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
				CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
				aereos_rsvp.aereo_dt_saida AS a_dt_saida,
				aereos_rsvp.aereo_hr_saida AS a_hr_saida,
				aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
				aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
				aereos_rsvp.aereo_localizador AS a_localizador,
				aereos_rsvp.aereo_eticket AS a_etkt,				
				IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
				aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
				bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
				aereos_rsvp.aereo_modificado_em AS a_modificado_em,
				aereos_rsvp.aereo_ativo AS a_ativo,
				aereos_rsvp.nome_pax_gate AS a_pax_gate,
				aereos_rsvp.nota_gate AS a_nota_gate,
				aereos_rsvp.data_nota_gate AS a_dt_nota_gate			
			FROM
				aereos_rsvp
			INNER JOIN 	
				usuarios_rsvp
			ON	
				usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
			INNER JOIN 	
				acompanhantes_rsvp
			ON
				acompanhantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
			INNER JOIN
				tbl_cia_aereas
			ON
				tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
			INNER JOIN
				aeroporto AS orig				
			ON
				aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
			INNER JOIN
				aeroporto AS dest		
			ON		 
				aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
			LEFT JOIN
				bloqueio_aereo_rsvp	
			ON 
				aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
			WHERE
				aereos_rsvp.aereo_ativo =  ".$this->Db->qstr($valor_y)."
			AND
				acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
			AND
				aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
			AND
				aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
			AND
				acompanhantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
			ORDER BY
				aereos_rsvp.aereo_cpf_particip,
				aereos_rsvp.aereo_dthr_saida,
				aereos_rsvp.aereo_direcao			
			";
		} else {
			$sqlj = "
			SELECT 
				aereos_rsvp.aereo_id_evento AS a_evento,
				aereos_rsvp.aereo_id_usuario AS a_usuario,
				usuarios_rsvp.usuario_nome AS usuario_nome,
				aereos_rsvp.aereo_cpf_particip AS a_cpf,
				CASE aereos_rsvp.aereo_status 
					WHEN 'Y' THEN 'CONFIRMADO'
					WHEN 'A' THEN 'ABERTO'
					WHEN 'P' THEN 'PENDENTE'
					WHEN 'N' THEN 'NÃO CONFIRMADO'
				END
				AS a_status,
				aereos_rsvp.aereo_direcao AS a_direcao,
				aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
				tbl_cia_aereas.cia_nome AS cia_aerea,
				aereos_rsvp.aereo_num_voo AS a_voo,
				CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
				CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
				aereos_rsvp.aereo_dt_saida AS a_dt_saida,
				aereos_rsvp.aereo_hr_saida AS a_hr_saida,
				aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
				aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
				aereos_rsvp.aereo_localizador AS a_localizador,
				aereos_rsvp.aereo_eticket AS a_etkt,				
				IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
				aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
				bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
				aereos_rsvp.aereo_modificado_em AS a_modificado_em,
				aereos_rsvp.aereo_ativo AS a_ativo,
				aereos_rsvp.nome_pax_gate AS a_pax_gate,
				aereos_rsvp.nota_gate AS a_nota_gate,
				aereos_rsvp.data_nota_gate AS a_dt_nota_gate			
			FROM
				aereos_rsvp
			INNER JOIN 	
				usuarios_rsvp
			ON	
				usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
			INNER JOIN 	
				acompanhantes_rsvp
			ON
				acompanhantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
			INNER JOIN
				tbl_cia_aereas
			ON
				tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
			INNER JOIN
				aeroporto AS orig				
			ON
				aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
			INNER JOIN
				aeroporto AS dest		
			ON		 
				aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
			LEFT JOIN
				bloqueio_aereo_rsvp	
			ON 
				aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
			WHERE
				aereos_rsvp.aereo_ativo =  ".$this->Db->qstr($valor_y)."
			AND
				acompanhantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
			AND
				aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
			AND
				aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
			ORDER BY
				aereos_rsvp.aereo_cpf_particip,
				aereos_rsvp.aereo_dthr_saida,
				aereos_rsvp.aereo_direcao			
			";
		}
		 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsj = false;
          $this->rsj_erro = $this->Db->ErrorMsg();
      } 
	
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

		$reg_part = sizeof($this->rsj );			
		if ($reg_part > 0) {				
			for ($i=0;$i<$reg_part;++$i) {												
				$v_evento				= $this->rsj[$i][0]; 	
				$v_usuario				= $this->rsj[$i][1];		
				$v_usuario_nome			= $this->rsj[$i][2]; 	
				$v_cpf					= $this->rsj[$i][3]; 	
				$v_status				= $this->rsj[$i][4]; 	
				$v_direcao				= $this->rsj[$i][5]; 	
				$v_cod_cia_aerea		= $this->rsj[$i][6]; 	
				$v_cia_aerea			= $this->rsj[$i][7]; 	
				$v_voo					= $this->rsj[$i][8];		
				$v_origem				= $this->rsj[$i][9]; 	
				$v_destino				= $this->rsj[$i][10];	
				$v_dt_saida				= $this->rsj[$i][11];	
				$v_hr_saida				= $this->rsj[$i][12];	
				$v_dt_chegada			= $this->rsj[$i][13];	
				$v_hr_chegada			= $this->rsj[$i][14];	
				$v_localizador			= $this->rsj[$i][15];	
				$v_etkt					= $this->rsj[$i][16];	
				$v_emitida_bvt			= $this->rsj[$i][17];	
				$v_bloqueio				= $this->rsj[$i][18];	
				$v_dbloqueio			= $this->rsj[$i][19];	
				$v_modificado_em		= $this->rsj[$i][20];	
				$v_ativo				= $this->rsj[$i][21];	
				$v_pax_gate				= $this->rsj[$i][22];	
				$v_nota_gate			= $this->rsj[$i][23];	
				$v_dt_nota_gate			= $this->rsj[$i][24];	
				$v_tipoPessoa			= "ACOMPANHANTE";
				$sqlPes = "								
				SELECT						
					pessoa_cpf,
					pessoa_nome				
				FROM
					pessoas_rsvp
				WHERE
					pessoa_cpf = ".$this->Db->qstr($v_cpf)."
				ORDER BY
					pessoa_cpf
				";		
				 
      $nm_select = $sqlPes; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspes = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspes[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspes = false;
          $this->rspes_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rspes[0][0])) {									
					$v_participante_nome = $this->rspes[0][1];
				} else {
					$v_participante_nome = "ERRO";				
				}													
				$reg_count = 1;	
				$sqlc = "						
				SELECT 
					aereopar_rsvp_r.id_evento, 
					aereopar_rsvp_r.participante_cpf,
					aereopar_rsvp_r.direcao,
					aereopar_rsvp_r.cod_cia_aerea,
					aereopar_rsvp_r.origem,
					aereopar_rsvp_r.voo,
					aereopar_rsvp_r.hora_saida,
					aereopar_rsvp_r.data_saida	
				FROM 
					aereopar_rsvp_r 
				WHERE 
					aereopar_rsvp_r.id_evento = ".$this->Db->qstr($v_evento)."
				AND 
					aereopar_rsvp_r.participante_cpf = ".$this->Db->qstr($v_cpf)."
				AND
					aereopar_rsvp_r.direcao = ".$this->Db->qstr($v_direcao)."
				AND
					aereopar_rsvp_r.cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)."
				AND
					aereopar_rsvp_r.origem = ".$this->Db->qstr($v_origem)."
				AND
					aereopar_rsvp_r.voo = ".$this->Db->qstr($v_voo)."
				AND	
					aereopar_rsvp_r.hora_saida = ".$this->Db->qstr($v_hr_saida)."
				AND	
					aereopar_rsvp_r.data_saida = ".$this->Db->qstr($v_dt_saida)."
				AND
					aereopar_rsvp_r.id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
				";	
				 
      $nm_select = $sqlc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsc = false;
          $this->rsc_erro = $this->Db->ErrorMsg();
      } 
	
				if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

				$reg_count = sizeof($this->rsc );	
				if ($reg_count == 0) {					
																	
					if($v_bloqueio <> '0') {
						
						$_usado_bloqueio = '1';
						$sqlbs="
						SELECT 
							bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
						FROM
							bloqueio_aereo_rsvp
						WHERE
							bloqueio_id = ".$this->Db->qstr($v_bloqueio)."
						AND
							bloq_evento_id = ".$this->Db->qstr($evento)."
						ORDER BY
							bloqueio_id,bloq_evento_id
						";							
						 
      $nm_select = $sqlbs; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsbs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsbs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsbs = false;
          $this->rsbs_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($this->rsbs[0][0])) {	
							$_sentido 	= $this->rsbs[0][2];									
							$_total_bloq = $this->rsbs[0][3];									
						}										
					} else {
						$_sentido	= '';															
						$_total_bloq = '0';								
						$_usado_bloqueio = '0';
					}					
					$sqlins = "
						SELECT 
							COUNT(p_cpf) as qtde
						FROM 
							aereopar_rsvp_r
						WHERE 
							participante_cpf = ".$this->Db->qstr($v_cpf)." 
						AND 
							id_evento = ".$this->Db->qstr($v_evento)."									
						AND
							direcao = ".$this->Db->qstr($v_direcao)."
						AND
							cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)."
						AND
							origem = ".$this->Db->qstr($v_origem)."
						AND
							voo = ".$this->Db->qstr($v_voo)."
						AND	
							hora_saida = ".$this->Db->qstr($v_hr_saida)."
						AND	
							data_saida = ".$this->Db->qstr($v_dt_saida)."	
						AND	
							id_usuario_relato = ".$this->Db->qstr($vp_usuario)."	
					";
					 
      $nm_select = $sqlins; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rslins = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rslins[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rslins = false;
          $this->rslins_erro = $this->Db->ErrorMsg();
      } 

					if (isset($this->rslins[0][0])) {
						$qtde = $this->rslins[0][0];
					} else {
						$qtde = 0;
					}
					if ($qtde == 0) {													
						$sqli2 = "					
						INSERT INTO
							aereopar_rsvp_r  
							(id_evento,
							id_usuario,
							usuario_nome,
							participante_cpf,
							participante_nome,
							satus,
							direcao,
							cod_cia_aerea,
							cia_aerea,
							voo,
							origem,
							destino,
							data_saida,
							hora_saida,
							data_chegada,
							hora_chegada,
							localizador,
							etkt,	
							emitida_bvt,
							bloqueio,
							bloqueio_dsc,
							modificado_em,
							ativo,
							pax_gate,
							nota_gate,
							data_nota_gate,							
							id_usuario_relato,
							tipo_pessoa,
							usado_bloqueio,
							total_bloqueio,
							direcao_bloqueio)							
						VALUES
							(".$this->Db->qstr($v_evento).", 				 
							".$this->Db->qstr($v_usuario).",               
							".$this->Db->qstr($v_usuario_nome).",         
							".$this->Db->qstr($v_cpf).",                
							".$this->Db->qstr($v_participante_nome).",     
							".$this->Db->qstr($v_status).",                       
							".$this->Db->qstr($v_direcao).",               
							".$this->Db->qstr($v_cod_cia_aerea).",         
							".$this->Db->qstr($v_cia_aerea).",             
							".$this->Db->qstr($v_voo).",                   
							".$this->Db->qstr($v_origem).",               
							".$this->Db->qstr($v_destino).",               
							".$this->Db->qstr($v_dt_saida).",              
							".$this->Db->qstr($v_hr_saida).",              
							".$this->Db->qstr($v_dt_chegada).",            
							".$this->Db->qstr($v_hr_chegada).",           
							".$this->Db->qstr($v_localizador).",           
							".$this->Db->qstr($v_etkt).",                  
							".$this->Db->qstr($v_emitida_bvt).",           
							".$this->Db->qstr($v_bloqueio).",              
							".$this->Db->qstr($v_dbloqueio).",             
							".$this->Db->qstr($v_modificado_em).",         
							".$this->Db->qstr($v_ativo).",                 
							".$this->Db->qstr($v_pax_gate).",              
							".$this->Db->qstr($v_nota_gate).",             
							".$this->Db->qstr($v_dt_nota_gate).",         
							".$this->Db->qstr($vp_usuario).",
							".$this->Db->qstr($v_tipoPessoa).",
							".$this->Db->qstr($_usado_bloqueio).",
							".$this->Db->qstr($_total_bloq).",
							".$this->Db->qstr($_sentido).")						
						";	
						
     $nm_select = $sqli2; 
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
		
					} else {
						
						
					}	
				}					
			}
			$ret = 'ADICIONA OK2';	
		} else {
			$ret = 'ADICIONA ERRO2';	
		}				
		return $ret;
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function PrepRelAereo($evento,$vp_usuario,$vp_tipo,$vp_nivel) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		
		$valor_y = 'Y';
		$nome_empresa = '';
	
		if($vp_nivel == 'CONVIDADO') {
			$sqlconv = "
				SELECT
					evento_id,
					usuario_id,
					nome_empresa
				FROM
					eventos_usuarios_rsvp			
				WHERE	
					evento_id = ".$this->Db->qstr($evento)."
				AND 
					usuario_id = ".$this->Db->qstr($vp_usuario)."	
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
	
		if ($vp_tipo == 'P') {
			$sqld="
			DELETE FROM 
				aereopar_rsvp_r 
			WHERE   
				id_evento = ".$this->Db->qstr($evento)."
			AND 
				id_usuario_relato = ".$this->Db->qstr($vp_usuario)." 
			";	
		}
		
		$sql="
		SELECT
    		id_evento,
  			id_usuario_relato
		FROM
   			aereopar_rsvp_r 
		WHERE   
			id_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($$vp_usuario)."
		ORDER BY 
			id_evento,
  			id_usuario_relato
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
	
		$reg_subs = sizeof($this->rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {						
			if($vp_nivel == 'CONVIDADO') {
				$sqlj = "
				SELECT 
					aereos_rsvp.aereo_id_evento AS a_evento,
					aereos_rsvp.aereo_id_usuario AS a_usuario,
					usuarios_rsvp.usuario_nome AS usuario_nome,
					aereos_rsvp.aereo_cpf_particip AS a_cpf,
					participantes_rsvp.nome_pessoa AS participante_nome, 
					CASE aereos_rsvp.aereo_status 
						WHEN 'Y' THEN 'CONFIRMADO'
						WHEN 'A' THEN 'ABERTO'
						WHEN 'P' THEN 'PENDENTE'
						WHEN 'N' THEN 'NÃO CONFIRMADO'
					END
					AS a_status,
					aereos_rsvp.aereo_direcao AS a_direcao,
					aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
					tbl_cia_aereas.cia_nome AS cia_aerea,
					aereos_rsvp.aereo_num_voo AS a_voo,
					CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
					CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
					aereos_rsvp.aereo_dt_saida AS a_dt_saida,
					aereos_rsvp.aereo_hr_saida AS a_hr_saida,
					aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
					aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
					aereos_rsvp.aereo_localizador AS a_localizador,
					aereos_rsvp.aereo_eticket AS a_etkt,				
					IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
					aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
					bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
					aereos_rsvp.aereo_modificado_em AS a_modificado_em,
					aereos_rsvp.aereo_ativo AS a_ativo,
					aereos_rsvp.nome_pax_gate AS a_pax_gate,
					aereos_rsvp.nota_gate AS a_nota_gate,
					aereos_rsvp.data_nota_gate AS a_dt_nota_gate,
					participantes_rsvp.part_id_evento_publico,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					aereos_rsvp
				INNER JOIN 	
					usuarios_rsvp
				ON	
					usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
				INNER JOIN 	
					participantes_rsvp
				ON
					participantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
				INNER JOIN
					tbl_cia_aereas
				ON
					tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
				INNER JOIN
					aeroporto AS orig				
				ON
					aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
				INNER JOIN
					aeroporto AS dest		
				ON		 
					aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
				LEFT JOIN
					bloqueio_aereo_rsvp	
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
				WHERE
					aereos_rsvp.aereo_ativo = ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
				AND
					aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
				AND
					aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
				AND			  
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.dsc_empresa_rsvp = ".$this->Db->qstr($nome_empresa)."
				ORDER BY
					aereos_rsvp.aereo_cpf_particip,
					aereos_rsvp.aereo_dthr_saida,
					aereos_rsvp.aereo_direcao				
				";
			} else {
				$sqlj = "
				SELECT 
					aereos_rsvp.aereo_id_evento AS a_evento,
					aereos_rsvp.aereo_id_usuario AS a_usuario,
					usuarios_rsvp.usuario_nome AS usuario_nome,
					aereos_rsvp.aereo_cpf_particip AS a_cpf,
					participantes_rsvp.nome_pessoa AS participante_nome, 
					CASE aereos_rsvp.aereo_status 
						WHEN 'Y' THEN 'CONFIRMADO'
						WHEN 'A' THEN 'ABERTO'
						WHEN 'P' THEN 'PENDENTE'
						WHEN 'N' THEN 'NÃO CONFIRMADO'
					END
					AS a_status,
					aereos_rsvp.aereo_direcao AS a_direcao,
					aereos_rsvp.aereo_cia_aerea AS a_cia_aerea,
					tbl_cia_aereas.cia_nome AS cia_aerea,
					aereos_rsvp.aereo_num_voo AS a_voo,
					CONCAT(orig.SIGLA,' - ',orig.NOM_AEROPORTO,' - ',orig.NOM_CIDADE) AS origem,
					CONCAT(dest.SIGLA,' - ',dest.NOM_AEROPORTO,' - ',dest.NOM_CIDADE) AS destino,					
					aereos_rsvp.aereo_dt_saida AS a_dt_saida,
					aereos_rsvp.aereo_hr_saida AS a_hr_saida,
					aereos_rsvp.aereo_dt_chegada AS a_dt_chegada,
					aereos_rsvp.aereo_hr_chegada AS a_hr_chegada,
					aereos_rsvp.aereo_localizador AS a_localizador,
					aereos_rsvp.aereo_eticket AS a_etkt,				
					IF(aereos_rsvp.aereo_emitida_bvt = 'Y', 'SIM','NÃO') AS a_emitida_bvt,
					aereos_rsvp.aereo_bloqueio_id AS a_bloqueio,
					bloqueio_aereo_rsvp.bloq_descricao AS d_bloqueio,
					aereos_rsvp.aereo_modificado_em AS a_modificado_em,
					aereos_rsvp.aereo_ativo AS a_ativo,
					aereos_rsvp.nome_pax_gate AS a_pax_gate,
					aereos_rsvp.nota_gate AS a_nota_gate,
					aereos_rsvp.data_nota_gate AS a_dt_nota_gate,
					participantes_rsvp.part_id_evento_publico,
					participantes_rsvp.dsc_empresa_rsvp
				FROM
					aereos_rsvp
				INNER JOIN 	
					usuarios_rsvp
				ON	
					usuarios_rsvp.usuario_id = aereos_rsvp.aereo_id_usuario
				INNER JOIN 	
					participantes_rsvp
				ON
					participantes_rsvp.part_cpf = aereos_rsvp.aereo_cpf_particip
				INNER JOIN
					tbl_cia_aereas
				ON
					tbl_cia_aereas.cia_id = aereos_rsvp.aereo_cia_aerea	
				INNER JOIN
					aeroporto AS orig				
				ON
					aereos_rsvp.aereo_origem = orig.COD_AEROPORTO	
				INNER JOIN
					aeroporto AS dest		
				ON		 
					aereos_rsvp.aereo_destino = dest.COD_AEROPORTO 
				LEFT JOIN
					bloqueio_aereo_rsvp	
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id 	
				WHERE
					aereos_rsvp.aereo_ativo = ".$this->Db->qstr($valor_y)."
				AND
					participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)."
				AND
					aereos_rsvp.aereo_id_evento = ".$this->Db->qstr($evento)."
				AND
					aereos_rsvp.aereo_status = ".$this->Db->qstr($valor_y)."
				AND			  
					participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)."
				ORDER BY
					aereos_rsvp.aereo_cpf_particip,
					aereos_rsvp.aereo_dthr_saida,
					aereos_rsvp.aereo_direcao				
				";
			}
				
			 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsj = false;
          $this->rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($this->rsj );			
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {						
					$v_evento				= $this->rsj[$i][0]; 	
					$v_usuario				= $this->rsj[$i][1];		
					$v_usuario_nome			= $this->rsj[$i][2]; 	
					$v_cpf					= $this->rsj[$i][3]; 	
					$v_participante_nome	= $this->rsj[$i][4]; 	
					$v_status				= $this->rsj[$i][5]; 	
					$v_direcao				= $this->rsj[$i][6]; 	
					$v_cod_cia_aerea		= $this->rsj[$i][7]; 	
					$v_cia_aerea			= $this->rsj[$i][8]; 	
					$v_voo					= $this->rsj[$i][9];		
					$v_origem				= $this->rsj[$i][10]; 	
					$v_destino				= $this->rsj[$i][11];	
					$v_dt_saida				= $this->rsj[$i][12];	
					$v_hr_saida				= $this->rsj[$i][13];	
					$v_dt_chegada			= $this->rsj[$i][14];	
					$v_hr_chegada			= $this->rsj[$i][15];	
					$v_localizador			= $this->rsj[$i][16];	
					$v_etkt					= $this->rsj[$i][17];	
					$v_emitida_bvt			= $this->rsj[$i][18];	
					$v_bloqueio				= $this->rsj[$i][19];	
					$v_dbloqueio			= $this->rsj[$i][20];	
					$v_modificado_em		= $this->rsj[$i][21];	
					$v_ativo				= $this->rsj[$i][22];	
					$v_pax_gate				= $this->rsj[$i][23];	
					$v_nota_gate			= $this->rsj[$i][24];	
					$v_dt_nota_gate			= $this->rsj[$i][25];	
					
					$v_publico_id			= $this->rsj[$i][26];							
					
					$v_tipoPessoa			= "PARTICIPANTE";
					$reg_count = 1;	
					$sqlc = "						
					SELECT 
						aereopar_rsvp_r.id_evento, 
						aereopar_rsvp_r.participante_cpf,
						aereopar_rsvp_r.direcao,
						aereopar_rsvp_r.cod_cia_aerea,
						aereopar_rsvp_r.origem,
						aereopar_rsvp_r.voo,
						aereopar_rsvp_r.hora_saida,
						aereopar_rsvp_r.data_saida	
					FROM 
						aereopar_rsvp_r 
					WHERE 
						aereopar_rsvp_r.id_evento = ".$this->Db->qstr($v_evento)." 
					AND 
						aereopar_rsvp_r.participante_cpf = ".$this->Db->qstr($v_cpf)." 
					AND
						aereopar_rsvp_r.direcao = ".$this->Db->qstr($v_direcao)." 
					AND
						aereopar_rsvp_r.cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)." 
					AND
						aereopar_rsvp_r.origem = ".$this->Db->qstr($v_origem)." 
					AND
						aereopar_rsvp_r.voo = ".$this->Db->qstr($v_voo)." 
					AND	
						aereopar_rsvp_r.hora_saida = ".$this->Db->qstr($v_hr_saida)." 
					AND	
						aereopar_rsvp_r.data_saida = ".$this->Db->qstr($v_dt_saida)." 
					AND
						aereopar_rsvp_r.id_usuario_relato = ".$this->Db->qstr($vp_usuario)." 
					";							
					 
      $nm_select = $sqlc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsc = false;
          $this->rsc_erro = $this->Db->ErrorMsg();
      } 
	
					if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

					$reg_count = sizeof($this->rsc );							
					if ($reg_count == 0) {
																		
						if($v_bloqueio <> '0') {
							
							$_usado_bloqueio = '1';
							$sqlbs="
							SELECT 
								bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
							FROM
								bloqueio_aereo_rsvp
							WHERE
								bloqueio_id = ".$this->Db->qstr($v_bloqueio)." 
							AND
								bloq_evento_id = ".$this->Db->qstr($evento)." 
							ORDER BY
								bloqueio_id,bloq_evento_id
							";							
							 
      $nm_select = $sqlbs; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsbs = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsbs[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsbs = false;
          $this->rsbs_erro = $this->Db->ErrorMsg();
      } 
	
							if (isset($this->rsbs[0][0])) {	
								$_sentido 	= $this->rsbs[0][2];									
								$_total_bloq = $this->rsbs[0][3];									
							}		
								
						} else {
							$_sentido	= '';															
							$_total_bloq = '0';								
							$_usado_bloqueio = '0';
						}		
						
						$sqlpa = "
							SELECT
								part_cpf,
								part_id_evento_publico
							FROM
								participantes_rsvp	
							WHERE
								part_cpf = ".$this->Db->qstr($v_cpf)."
							AND
								part_id_evento = ".$this->Db->qstr($v_evento)."
						";	
						 
      $nm_select = $sqlpa; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspa = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspa[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspa = false;
          $this->rspa_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($this->rspa[0][0])) {	
							$v_publico_id = $this->rspa[0][1];
						}	
						$sqlpub ="
							SELECT
								publico_id,
								publico_nome
							FROM 
								publico_rsvp
							WHERE
								publico_id = ".$this->Db->qstr($v_publico_id)."
						";
						 
      $nm_select = $sqlpub; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspb = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspb[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspb = false;
          $this->rspb_erro = $this->Db->ErrorMsg();
      } 
	
						if (isset($this->rspb[0][0])) {	
							$v_publico_dsc = $this->rspb[0][1];									
						} else {
							$v_publico_dsc = '';
						}	
						$sqlins = "
							SELECT 
								COUNT(p_cpf) as qtde
							FROM 
								aereopar_rsvp_r
							WHERE 
								participante_cpf = ".$this->Db->qstr($v_cpf)." 
							AND 
								id_evento = ".$this->Db->qstr($v_evento)."  
							AND
								aereopar_rsvp_r.direcao = ".$this->Db->qstr($v_direcao)." 
							AND
								aereopar_rsvp_r.cod_cia_aerea = ".$this->Db->qstr($v_cod_cia_aerea)."  
							AND
								aereopar_rsvp_r.origem = ".$this->Db->qstr($v_origem)."  
							AND
								aereopar_rsvp_r.voo = ".$this->Db->qstr($v_voo)." 
							AND	
								aereopar_rsvp_r.hora_saida = ".$this->Db->qstr($v_hr_saida)." 
							AND	
								aereopar_rsvp_r.data_saida = ".$this->Db->qstr($v_dt_saida)." 
							AND
								aereopar_rsvp_r.id_usuario_relato = ".$this->Db->qstr($vp_usuario)." 
						";
						 
      $nm_select = $sqlins; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rslins = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rslins[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rslins = false;
          $this->rslins_erro = $this->Db->ErrorMsg();
      } 

						if (isset($this->rslins[0][0])) {
							$qtde = $this->rslins[0][0];
						} else {
							$qtde = 0;
						}
						if ($qtde == 0) {	
							$sqli = "					
							INSERT INTO
								aereopar_rsvp_r  
								(id_evento,
								id_usuario,
								usuario_nome,
								participante_cpf,
								participante_nome,
								satus,
								direcao,
								cod_cia_aerea,
								cia_aerea,
								voo,
								origem,
								destino,
								data_saida,
								hora_saida,
								data_chegada,
								hora_chegada,
								localizador,
								etkt,	
								emitida_bvt,
								bloqueio,
								bloqueio_dsc,
								modificado_em,
								ativo,
								pax_gate,
								nota_gate,
								data_nota_gate,							
								id_usuario_relato,
								tipo_pessoa,
								usado_bloqueio,
								total_bloqueio,
								publico,
								direcao_bloqueio)	
							VALUES
								(".$this->Db->qstr($v_evento).", 				 
								".$this->Db->qstr($v_usuario).",               
								".$this->Db->qstr($v_usuario_nome).",         
								".$this->Db->qstr($v_cpf).",                
								".$this->Db->qstr($v_participante_nome).",     
								".$this->Db->qstr($v_status).",                       
								".$this->Db->qstr($v_direcao).",               
								".$this->Db->qstr($v_cod_cia_aerea).",         
								".$this->Db->qstr($v_cia_aerea).",             
								".$this->Db->qstr($v_voo).",                   
								".$this->Db->qstr($v_origem).",               
								".$this->Db->qstr($v_destino).",               
								".$this->Db->qstr($v_dt_saida).",              
								".$this->Db->qstr($v_hr_saida).",              
								".$this->Db->qstr($v_dt_chegada).",            
								".$this->Db->qstr($v_hr_chegada).",           
								".$this->Db->qstr($v_localizador).",           
								".$this->Db->qstr($v_etkt).",                  
								".$this->Db->qstr($v_emitida_bvt).",           
								".$this->Db->qstr($v_bloqueio).",              
								".$this->Db->qstr($v_dbloqueio).",             
								".$this->Db->qstr($v_modificado_em).",         
								".$this->Db->qstr($v_ativo).",                 
								".$this->Db->qstr($v_pax_gate).",              
								".$this->Db->qstr($v_nota_gate).",             
								".$this->Db->qstr($v_dt_nota_gate).",         
								".$this->Db->qstr($vp_usuario).",																
								".$this->Db->qstr($v_tipoPessoa).",
								".$this->Db->qstr($_usado_bloqueio).",
								".$this->Db->qstr($_total_bloq).",
								".$this->Db->qstr($v_publico_dsc).",
								".$this->Db->qstr($_sentido).")	       							
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
		
						} else {
							
							
						}
						}
					}
					$ret = 'ADICIONA OK';	
				} else {
					$ret = 'ADICIONA ERRO';	
				}			
		}
		return $ret;
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function PrepRelRsvp2($evento,$usuario) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
  
		date_default_timezone_set('America/Sao_Paulo');
		$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
		$ret = 'ADICIONA ERRO2';
		$valor_y = 'Y';
		
		
		$sqld="
		DELETE FROM 
			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
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

		
		
		$sql="
		SELECT
    		p_evento,
  			id_usuario_relato
		FROM
   			rsvp_part_r
		WHERE   
			p_evento = ".$this->Db->qstr($evento)."
		AND 
    		id_usuario_relato = ".$this->Db->qstr($usuario)."
		ORDER BY 
			p_evento,
  			id_usuario_relato
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

		$reg_subs = sizeof($this->rs );
		if ($reg_subs > 0) {
			$ret = 'ERRO AO APAGAR';
		} else {	
			$sqlj="	
			SELECT
				participantes_rsvp.part_id_evento_publico AS p_publico,
				participantes_rsvp.part_id_evento_regional AS p_regional, 
				participantes_rsvp.part_grupo AS p_grupo,
				participantes_rsvp.part_departamento AS p_departamento,	
				participantes_rsvp.part_cargo AS p_cargo,
				participantes_rsvp.part_tam_camisa AS p_tam_camisa,
				participantes_rsvp.part_idioma AS p_idioma,
				participantes_rsvp.part_empresa AS p_empresa,
				participantes_rsvp.part_uf AS p_uf,
				participantes_rsvp.part_pais AS p_pais,
				participantes_rsvp.part_email AS p_email,
				participantes_rsvp.part_email_secretaria AS p_email_secretaria,
				participantes_rsvp.part_ddd_celular_01 AS p_ddd_celular_01,	
				participantes_rsvp.part_celeular_01 AS p_celular_01,
				participantes_rsvp.part_ddd_01 AS p_ddd_01,         
				participantes_rsvp.part_fone_01 AS p_fone_01,       
				participantes_rsvp.nome_pessoa AS p_nome,           
				participantes_rsvp.part_cpf AS p_cpf,               
				participantes_rsvp.part_id_evento,                  
				contatos_rsvp.contato_cpf_participante AS contato_cpf,
				contatos_rsvp.contato_status AS contato_status,       
				contatos_rsvp.contato_data_hora AS contato_data,      
				contatos_rsvp.contato_motivo_frase AS contato_motivo, 
				contatos_rsvp.contato_obs AS contato_obs,             
				contatos_rsvp.contato_usuario_id,
				presencas_rsvp.presenca_tipo_part AS presenca_tipo_part,
				presencas_rsvp.presenca_status AS presenca_status,	
				presencas_rsvp.presenca_obs AS presenca_obs,
				presencas_rsvp.presenca__frase_resposta AS presenca_motivo,
				presencas_rsvp.presenca_data_hora, 
				presencas_rsvp.presenca_usuario_id,
				usuarios_rsvp.usuario_nome AS usuario_contato,
				usuarios_rsvp.usuario_nome AS usuario_presenca,
				publico_rsvp.publico_nome,
				tbl_regionais.regional_dsc
			FROM
				participantes_rsvp
			LEFT JOIN 
				contatos_rsvp 
			ON 
				participantes_rsvp.part_cpf  = contatos_rsvp.contato_cpf_participante
			LEFT JOIN 
				presencas_rsvp
			ON 
				participantes_rsvp.part_cpf = presencas_rsvp.presenca_cpf_participante
			LEFT JOIN
				publico_rsvp
			ON 
				publico_rsvp.publico_id = participantes_rsvp.part_id_evento_publico	
			LEFT JOIN
				tbl_regionais
			ON
				tbl_regionais.regional_id = participantes_rsvp.part_id_evento_regional
			LEFT JOIN
				usuarios_rsvp
			ON
				usuarios_rsvp.usuario_id = contatos_rsvp.contato_usuario_id	
			AND 	
				usuarios_rsvp.usuario_id = presencas_rsvp.presenca_usuario_id		
			WHERE
				participantes_rsvp.part_ativo = ".$this->Db->qstr($valor_y)." 
			AND	
				participantes_rsvp.part_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
			AND
				participantes_rsvp.part_substituido <> ".$this->Db->qstr($valor_y)." 
			GROUP by
				participantes_rsvp.part_cpf		
			ORDER BY				 
				participantes_rsvp.nome_pessoa,
				contatos_rsvp.contato_data_hora DESC,
				presencas_rsvp.presenca_data_hora DESC 		
			";		
			 
      $nm_select = $sqlj; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsj = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsj[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsj = false;
          $this->rsj_erro = $this->Db->ErrorMsg();
      } 
	
			if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

			$reg_part = sizeof($this->rsj );
			if ($reg_part > 0) {				
				for ($i=0;$i<$reg_part;++$i) {	
					$vppublico 					= $this->rsj[$i][0];   
					$vpregional					= $this->rsj[$i][1];   
					$vpgrupo 					= $this->rsj[$i][2];	  
					$vpdepartamento 			= $this->rsj[$i][3];	  
					$vpcargo 					= $this->rsj[$i][4];   
					$vptam_camisa           	= $this->rsj[$i][5];   
					$vpidioma               	= $this->rsj[$i][6];   
					$vpempresa              	= $this->rsj[$i][7];   
					$vpuf                   	= $this->rsj[$i][8];   
					$vppais                 	= $this->rsj[$i][9];   
					$vpemail                	= $this->rsj[$i][10];  
					$vpemail_secretaria     	= $this->rsj[$i][11];  
					$vpddd_celular_01       	= $this->rsj[$i][12];  
					$vpcelular_01           	= $this->rsj[$i][13];  
					$vpddd_01               	= $this->rsj[$i][14];  
					$vpfone_01              	= $this->rsj[$i][15];  
					$vpnome                 	= $this->rsj[$i][16];  
					$vpcpf                  	= $this->rsj[$i][17];  
					$vpevento               	= $this->rsj[$i][18];  
					$vcontato_cpf            	= $this->rsj[$i][19];  
					$vcontato_status         	= $this->rsj[$i][20];  
					$vcontato_data           	= $this->rsj[$i][21]; 
					$vcontato_motivo         	= $this->rsj[$i][22];
					$vcontato_obs            	= $this->rsj[$i][23];
					$vcontato_usuario_id        = $this->rsj[$i][24];
					$vpresenca_tipo_part        = $this->rsj[$i][25];
					$vpresenca_status        	= $this->rsj[$i][26];
					$vpresenca_obs           	= $this->rsj[$i][27];
					$vpresenca_motivo        	= $this->rsj[$i][28];  
					$vpresenca_data				= $this->rsj[$i][29];  
					$vpresenca_usuario_id       = $this->rsj[$i][30];  
					$vcontato_usuario_nome		= $this->rsj[$i][31];  
					$vpresenca_usuario_nome		= $this->rsj[$i][32];  
					$vpublico_nome				= $this->rsj[$i][33];  
					$vregional_nome				= $this->rsj[$i][34];  

					$vcontato_status_dsc        = ''; 
					$vpresenca_status_dsc		= ''; 
					$vusuario_relato_nome		= ''; 
					$vusuario_relato_dsc		= ''; 
					$vacompanhantes_nomes		= ''; 

					$vhospedagem_cpf           	= '';
					$vhospedagem_evento        	= '';
					$vhospedagem_id_hotel      	= '';
					$vhospedagem_dtchkin       	= '';
					$vhospedagem_hrchkin       	= '';
					$vhospedagem_dtchkout      	= '';
					$vhospedagem_hrchkout      	= '';
					$vhospedagem_acompanhante  	= '';
					$vhospedagem_tipo_pessoa   	= '';
					$vhotel_fantasia           	= '';
					$vid_usuario_relato_id		= $this->sc_temp_vg_usuario_id;
							
					switch($vcontato_status) {
						case 'Y':
							$vcontato_status_dsc = 'SIM';  		  
							break;
						case 'N':
							$vcontato_status_dsc = 'NÃO'; 
							break;
						case 'A':
							$vcontato_status_dsc = 'ABERTO'; 
							break;							
						case 'P':
							$vcontato_status_dsc = 'PENDENTE'; 
							break;	
						case ' ':
							$vcontato_status_dsc = 'ABERTO'; 							
							break;								
						case '':
							$vcontato_status_dsc = 'ABERTO'; 
							break;		
						case 'NULL':
							$vcontato_status_dsc = 'ABERTO'; 
							break;		
					}					
					switch($vpresenca_status) {
						case 'Y':
							$vpresenca_status_dsc  = 'SIM';  		  
							break;
						case 'N':
							$vpresenca_status_dsc = 'NÃO'; 
							break;
						case 'A':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;							
						case 'P':
							$vpresenca_status_dsc = 'PENDENTE'; 
							break;	
						case ' ':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;
						case '':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;		
						case 'NULL':
							$vpresenca_status_dsc = 'ABERTO'; 
							break;		
					}	
					if ($vcontato_cpf == '') {
						$vcontato_status_dsc = 'ABERTO'; 	
					}
					
					$sqli="					
					INSERT INTO   
						rsvp_part_r  
						(p_publico, 						
						p_regional,				    
						p_grupo, 				    
						p_departamento, 		    
						p_cargo, 				    
						p_tam_camisa,               
						p_idioma,                   
						p_empresa,                  
						p_uf,                       
						p_pais,                     
						p_email,                    
						p_email_secretaria,         
						p_ddd_celular_01,           
						p_celular_01,               
						p_ddd_01,                   
						p_fone_01,                  
						p_nome,                     
						p_cpf,                      
						p_evento,                   
						contato_cpf,                
						contato_status,             
						contato_data,               
						contato_motivo,             
						contato_obs,                
						presenca_tipo_part,         
						presenca_status,            
						presenca_obs,               
						presenca_motivo,            
						hospedagem_cpf,             
						hospedagem_evento,          
						hospedagem_id_hotel,        
						hospedagem_dtchkin,         
						hospedagem_hrchkin,         
						hospedagem_dtchkout,        
						hospedagem_hrchkout,        
						hospedagem_acompanhante,    
						hospedagem_tipo_pessoa,     
						hotel_fantasia,             
						publico_nome,               
						regional_nome,              
						id_usuario_relato, 		    
						contato_status_dsc,         
						presenca_status_dsc,        
						contato_usuario_id,         
						contato_usuario_nome,       
						presenca_data,
						presenca_usuario_id,
						presenca_usuario_dsc)	             
					VALUES
						(".$this->Db->qstr($vppublico).",	
						".$this->Db->qstr($vpregional).",	
						".$this->Db->qstr($vpgrupo).",	
						".$this->Db->qstr($vpdepartamento).",
						".$this->Db->qstr($vpcargo).",
						".$this->Db->qstr($vptam_camisa).",
						".$this->Db->qstr($vpidioma).",
						".$this->Db->qstr($vpempresa).",
						".$this->Db->qstr($vpuf).",
						".$this->Db->qstr($vppais).",
						".$this->Db->qstr($vpemail).",
						".$this->Db->qstr($vpemail_secretaria).",
						".$this->Db->qstr($vpddd_celular_01).",
						".$this->Db->qstr($vpcelular_01).",
						".$this->Db->qstr($vpddd_01).",
						".$this->Db->qstr($vpfone_01).",
						".$this->Db->qstr($vpnome).",
						".$this->Db->qstr($vpcpf).",
						".$this->Db->qstr($vpevento).",
						".$this->Db->qstr($vcontato_cpf).",
						".$this->Db->qstr($vcontato_status).",
						".$this->Db->qstr($vcontato_data).",
						".$this->Db->qstr($vcontato_motivo).",
						".$this->Db->qstr($vcontato_obs).",
						".$this->Db->qstr($vpresenca_tipo_part).",
						".$this->Db->qstr($vpresenca_status).",
						".$this->Db->qstr($vpresenca_obs).",
						".$this->Db->qstr($vpresenca_motivo).",
						".$this->Db->qstr($vhospedagem_cpf).",
						".$this->Db->qstr($vhospedagem_evento).",
						".$this->Db->qstr($vhospedagem_id_hotel).",
						".$this->Db->qstr($vhospedagem_dtchkin).",
						".$this->Db->qstr($vhospedagem_hrchkin).",
						".$this->Db->qstr($vhospedagem_dtchkout).",
						".$this->Db->qstr($vhospedagem_hrchkout).",
						".$this->Db->qstr($vhospedagem_acompanhante).",
						".$this->Db->qstr($vhospedagem_tipo_pessoa).",
						".$this->Db->qstr($vhotel_fantasia).",
						".$this->Db->qstr($vpublico_nome).",
						".$this->Db->qstr($vregional_nome).",
						".$this->Db->qstr($vid_usuario_relato_id).",
						".$this->Db->qstr($vcontato_status_dsc).",
						".$this->Db->qstr($vpresenca_status_dsc).",
						".$this->Db->qstr($vcontato_usuario_id).",
						".$this->Db->qstr($vcontato_usuario_nome).",
						".$this->Db->qstr($vpresenca_data).",
						".$this->Db->qstr($vpresenca_usuario_id).",
						".$this->Db->qstr($vpresenca_usuario_nome).")
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

				}
				$ret = 'ADICIONA OK2';		
			} else {
				$ret = 'ADICIONA ERRO2';
			}			
		}
		return $ret;
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_aereopar_rsvp_r']['contr_erro'] = 'off';
}

}

?>
