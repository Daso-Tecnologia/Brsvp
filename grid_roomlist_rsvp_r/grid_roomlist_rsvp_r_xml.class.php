<?php

class grid_roomlist_rsvp_r_xml
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
   var $count_ger;
   var $cnt_cpf;

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
   function monta_xml()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xml_f);
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
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['opcao'] = "";
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
                   nm_limpa_str_grid_roomlist_rsvp_r($cadapar[1]);
                   nm_protect_num_grid_roomlist_rsvp_r($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_roomlist_rsvp_r']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_roomlist_rsvp_r($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_roomlist_rsvp_r($_SESSION["vg_usuario_id"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_roomlist_rsvp_r($_SESSION["rsvp_global"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_roomlist_rsvp_r($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_roomlist_rsvp_r($_SESSION["parm1"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_roomlist_rsvp_r($_SESSION["vg_cpfseg"]);
      }
      if (isset($parm2)) 
      {
          $_SESSION['parm2'] = $parm2;
          nm_limpa_str_grid_roomlist_rsvp_r($_SESSION["parm2"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->New_Format  = true;
      $this->Xml_tag_label = true;
      $this->Tem_xml_res = false;
      $this->Xml_password = "";
      if (isset($_REQUEST['nm_xml_tag']) && !empty($_REQUEST['nm_xml_tag']))
      {
          $this->New_Format = ($_REQUEST['nm_xml_tag'] == "tag") ? true : false;
      }
      if (isset($_REQUEST['nm_xml_label']) && !empty($_REQUEST['nm_xml_label']))
      {
          $this->Xml_tag_label = ($_REQUEST['nm_xml_label'] == "S") ? true : false;
      }
      $this->Tem_xml_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_xml_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['SC_Gb_Free_cmp']))
      {
          $this->Tem_xml_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_roomlist_rsvp_r/grid_roomlist_rsvp_r_res_xml.class.php"))
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_label']))
      {
          $this->Xml_tag_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_label'];
          $this->New_Format    = true;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_roomlist_rsvp_r_total.class.php"); 
      $this->Tot      = new grid_roomlist_rsvp_r_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['tot_geral'][1];
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['SC_Ind_Groupby'] == "sc_free_total")
          {
              $this->cnt_cpf = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['tot_geral'][2];
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_roomlist_rsvp_r']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_return']);
          if ($this->Tem_xml_res) {
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
      $this->nm_data    = new nm_data("pt_br");
      $this->Arquivo      = "sc_xml";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_grid_roomlist_rsvp_r.zip";
      $this->Arquivo     .= "_grid_roomlist_rsvp_r";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "grid_roomlist_rsvp_r.xml";
      $this->Tit_zip      = "grid_roomlist_rsvp_r.zip";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_r']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_r']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_roomlist_rsvp_r']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->hospede = (isset($Busca_temp['hospede'])) ? $Busca_temp['hospede'] : ""; 
          $tmp_pos = (is_string($this->hospede)) ? strpos($this->hospede, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hospede))
          {
              $this->hospede = substr($this->hospede, 0, $tmp_pos);
          }
          $this->cpf = (isset($Busca_temp['cpf'])) ? $Busca_temp['cpf'] : ""; 
          $tmp_pos = (is_string($this->cpf)) ? strpos($this->cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cpf))
          {
              $this->cpf = substr($this->cpf, 0, $tmp_pos);
          }
          $this->passaporte = (isset($Busca_temp['passaporte'])) ? $Busca_temp['passaporte'] : ""; 
          $tmp_pos = (is_string($this->passaporte)) ? strpos($this->passaporte, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->passaporte))
          {
              $this->passaporte = substr($this->passaporte, 0, $tmp_pos);
          }
          $this->cod_publico = (isset($Busca_temp['cod_publico'])) ? $Busca_temp['cod_publico'] : ""; 
          $tmp_pos = (is_string($this->cod_publico)) ? strpos($this->cod_publico, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_publico))
          {
              $this->cod_publico = substr($this->cod_publico, 0, $tmp_pos);
          }
          $this->publico_dsc = (isset($Busca_temp['publico_dsc'])) ? $Busca_temp['publico_dsc'] : ""; 
          $tmp_pos = (is_string($this->publico_dsc)) ? strpos($this->publico_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->publico_dsc))
          {
              $this->publico_dsc = substr($this->publico_dsc, 0, $tmp_pos);
          }
          $this->cod_hotel = (isset($Busca_temp['cod_hotel'])) ? $Busca_temp['cod_hotel'] : ""; 
          $tmp_pos = (is_string($this->cod_hotel)) ? strpos($this->cod_hotel, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_hotel))
          {
              $this->cod_hotel = substr($this->cod_hotel, 0, $tmp_pos);
          }
          $this->hotel_dsc = (isset($Busca_temp['hotel_dsc'])) ? $Busca_temp['hotel_dsc'] : ""; 
          $tmp_pos = (is_string($this->hotel_dsc)) ? strpos($this->hotel_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hotel_dsc))
          {
              $this->hotel_dsc = substr($this->hotel_dsc, 0, $tmp_pos);
          }
          $this->cod_acomodacao = (isset($Busca_temp['cod_acomodacao'])) ? $Busca_temp['cod_acomodacao'] : ""; 
          $tmp_pos = (is_string($this->cod_acomodacao)) ? strpos($this->cod_acomodacao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_acomodacao))
          {
              $this->cod_acomodacao = substr($this->cod_acomodacao, 0, $tmp_pos);
          }
          $this->acomodacao_dsc = (isset($Busca_temp['acomodacao_dsc'])) ? $Busca_temp['acomodacao_dsc'] : ""; 
          $tmp_pos = (is_string($this->acomodacao_dsc)) ? strpos($this->acomodacao_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->acomodacao_dsc))
          {
              $this->acomodacao_dsc = substr($this->acomodacao_dsc, 0, $tmp_pos);
          }
          $this->cod_categoria = (isset($Busca_temp['cod_categoria'])) ? $Busca_temp['cod_categoria'] : ""; 
          $tmp_pos = (is_string($this->cod_categoria)) ? strpos($this->cod_categoria, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_categoria))
          {
              $this->cod_categoria = substr($this->cod_categoria, 0, $tmp_pos);
          }
          $this->categoria_dsc = (isset($Busca_temp['categoria_dsc'])) ? $Busca_temp['categoria_dsc'] : ""; 
          $tmp_pos = (is_string($this->categoria_dsc)) ? strpos($this->categoria_dsc, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->categoria_dsc))
          {
              $this->categoria_dsc = substr($this->categoria_dsc, 0, $tmp_pos);
          }
          $this->voo_ida = (isset($Busca_temp['voo_ida'])) ? $Busca_temp['voo_ida'] : ""; 
          $tmp_pos = (is_string($this->voo_ida)) ? strpos($this->voo_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->voo_ida))
          {
              $this->voo_ida = substr($this->voo_ida, 0, $tmp_pos);
          }
          $this->cod_cia_ida = (isset($Busca_temp['cod_cia_ida'])) ? $Busca_temp['cod_cia_ida'] : ""; 
          $tmp_pos = (is_string($this->cod_cia_ida)) ? strpos($this->cod_cia_ida, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_cia_ida))
          {
              $this->cod_cia_ida = substr($this->cod_cia_ida, 0, $tmp_pos);
          }
          $this->dt_checkin = (isset($Busca_temp['dt_checkin'])) ? $Busca_temp['dt_checkin'] : ""; 
          $tmp_pos = (is_string($this->dt_checkin)) ? strpos($this->dt_checkin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->dt_checkin))
          {
              $this->dt_checkin = substr($this->dt_checkin, 0, $tmp_pos);
          }
          $this->dt_checkin_2 = (isset($Busca_temp['dt_checkin_input_2'])) ? $Busca_temp['dt_checkin_input_2'] : ""; 
          $this->hr_transferin = (isset($Busca_temp['hr_transferin'])) ? $Busca_temp['hr_transferin'] : ""; 
          $tmp_pos = (is_string($this->hr_transferin)) ? strpos($this->hr_transferin, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hr_transferin))
          {
              $this->hr_transferin = substr($this->hr_transferin, 0, $tmp_pos);
          }
          $this->voo_volta = (isset($Busca_temp['voo_volta'])) ? $Busca_temp['voo_volta'] : ""; 
          $tmp_pos = (is_string($this->voo_volta)) ? strpos($this->voo_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->voo_volta))
          {
              $this->voo_volta = substr($this->voo_volta, 0, $tmp_pos);
          }
          $this->cod_cia_volta = (isset($Busca_temp['cod_cia_volta'])) ? $Busca_temp['cod_cia_volta'] : ""; 
          $tmp_pos = (is_string($this->cod_cia_volta)) ? strpos($this->cod_cia_volta, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->cod_cia_volta))
          {
              $this->cod_cia_volta = substr($this->cod_cia_volta, 0, $tmp_pos);
          }
          $this->forma_pgto = (isset($Busca_temp['forma_pgto'])) ? $Busca_temp['forma_pgto'] : ""; 
          $tmp_pos = (is_string($this->forma_pgto)) ? strpos($this->forma_pgto, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->forma_pgto))
          {
              $this->forma_pgto = substr($this->forma_pgto, 0, $tmp_pos);
          }
          $this->dt_checkout = (isset($Busca_temp['dt_checkout'])) ? $Busca_temp['dt_checkout'] : ""; 
          $tmp_pos = (is_string($this->dt_checkout)) ? strpos($this->dt_checkout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->dt_checkout))
          {
              $this->dt_checkout = substr($this->dt_checkout, 0, $tmp_pos);
          }
          $this->dt_checkout_2 = (isset($Busca_temp['dt_checkout_input_2'])) ? $Busca_temp['dt_checkout_input_2'] : ""; 
          $this->intervalo_trout = (isset($Busca_temp['intervalo_trout'])) ? $Busca_temp['intervalo_trout'] : ""; 
          $tmp_pos = (is_string($this->intervalo_trout)) ? strpos($this->intervalo_trout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->intervalo_trout))
          {
              $this->intervalo_trout = substr($this->intervalo_trout, 0, $tmp_pos);
          }
          $this->hr_transferout = (isset($Busca_temp['hr_transferout'])) ? $Busca_temp['hr_transferout'] : ""; 
          $tmp_pos = (is_string($this->hr_transferout)) ? strpos($this->hr_transferout, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->hr_transferout))
          {
              $this->hr_transferout = substr($this->hr_transferout, 0, $tmp_pos);
          }
          $this->tipo_pessoa = (isset($Busca_temp['tipo_pessoa'])) ? $Busca_temp['tipo_pessoa'] : ""; 
          $tmp_pos = (is_string($this->tipo_pessoa)) ? strpos($this->tipo_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_pessoa))
          {
              $this->tipo_pessoa = substr($this->tipo_pessoa, 0, $tmp_pos);
          }
          $this->tipo_transfer = (isset($Busca_temp['tipo_transfer'])) ? $Busca_temp['tipo_transfer'] : ""; 
          $tmp_pos = (is_string($this->tipo_transfer)) ? strpos($this->tipo_transfer, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->tipo_transfer))
          {
              $this->tipo_transfer = substr($this->tipo_transfer, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
if (!isset($_SESSION['parm2'])) {$_SESSION['parm2'] = "";}
if (!isset($this->sc_temp_parm2)) {$this->sc_temp_parm2 = (isset($_SESSION['parm2'])) ? $_SESSION['parm2'] : "";}
if (!isset($_SESSION['parm1'])) {$_SESSION['parm1'] = "";}
if (!isset($this->sc_temp_parm1)) {$this->sc_temp_parm1 = (isset($_SESSION['parm1'])) ? $_SESSION['parm1'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['vg_usuario_id'])) {$_SESSION['vg_usuario_id'] = "";}
if (!isset($this->sc_temp_vg_usuario_id)) {$this->sc_temp_vg_usuario_id = (isset($_SESSION['vg_usuario_id'])) ? $_SESSION['vg_usuario_id'] : "";}
if (!isset($_SESSION['rsvp_global'])) {$_SESSION['rsvp_global'] = "";}
if (!isset($this->sc_temp_rsvp_global)) {$this->sc_temp_rsvp_global = (isset($_SESSION['rsvp_global'])) ? $_SESSION['rsvp_global'] : "";}
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
$resultado = 'ERRO';
$this->sc_temp_vg_evento_id = $this->sc_temp_parm1;
$_tipoPessoa = $this->sc_temp_parm2;
$titulo  = 'Rooming List Participantes';

$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
if ($usunivel <> 'ADMINISTRADOR') {
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
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_parm2)) {$_SESSION['parm2'] = $this->sc_temp_parm2;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_roomlist_rsvp_r";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['sc_outra_jan'] = false;
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
        action="grid_roomlist_rsvp_r_fim.php"
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

$nome_empresa = '';
if($usunivel== 'CONVIDADO') {
	$sqlconv = "
		SELECT
			evento_id,
			usuario_id,
			nome_empresa
		FROM
			eventos_usuarios_rsvp			
		WHERE	
			evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
		AND 
			usuario_id = ".$this->Db->qstr($this->sc_temp_vg_usuario_id)."	
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
	

$resultado  = $this->PrepRoom2($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'P',$usunivel);
$resultado3 = $this->PrepRoom3($this->sc_temp_vg_evento_id,$this->sc_temp_vg_usuario_id,'P',$usunivel);

if ($resultado == 'ADICIONA OK') {
	$usunivel = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
	$this->RetNivel($usunivel);
	$id_evento  = $this->sc_temp_vg_evento_id;
	$this->id_usuario_relato  = $this->sc_temp_vg_usuario_id;
	
	$sqld="
		SELECT 
			cpf, 
			hospede 
		FROM 
			roomlist_rsvp_r
		WHERE 
			cpf IN (SELECT DISTINCT amq_cpf_01 FROM roomlist_rsvp_r)
		OR 
			amq_cpf_01 IN (SELECT DISTINCT cpf FROM roomlist_rsvp_r)
		AND 
			tipo_pessoa = 'ACOMPANHANTE'
		AND 
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	";
	 
      $nm_select = $sqld; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

	if ($this->rs  !== false) {
		if (strpos(strtolower($this->Ini->nm_tpbanco), "access") === false && !$this->Ini->sc_tem_trans_banco)
{
    $this->Db->BeginTrans();
    $this->Ini->sc_tem_trans_banco = true;
}

		while (!$this->rs->EOF) {
			$apaga_reg = $this->rs->fields[0];
			$sqldint ="
				DELETE FROM 
					roomlist_rsvp_r
				WHERE   
					cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
				AND
					cpf = ".$this->Db->qstr($apaga_reg)."		
			";				
			
     $nm_select = $sqldint; 
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
      
			$this->rs->MoveNext();		
		}
		$this->rs->Close();
	}
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	$sqld="
		SELECT 
			cpf, 
			hospede 
		FROM 
			roomlist_rsvp_r
		WHERE 
			cpf IN (SELECT DISTINCT amq_cpf_02 FROM roomlist_rsvp_r)
		OR 
			amq_cpf_02 IN (SELECT DISTINCT cpf FROM roomlist_rsvp_r)
		AND 
			tipo_pessoa = 'ACOMPANHANTE'
		AND 
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	";
	 
      $nm_select = $sqld; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

	if ($this->rs  !== false) {
		if (strpos(strtolower($this->Ini->nm_tpbanco), "access") === false && !$this->Ini->sc_tem_trans_banco)
{
    $this->Db->BeginTrans();
    $this->Ini->sc_tem_trans_banco = true;
}

		while (!$this->rs->EOF) {
			$apaga_reg = $this->rs->fields[0];
			$sqldint ="
				DELETE FROM 
					roomlist_rsvp_r
				WHERE   
					cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
				AND
					cpf = ".$this->Db->qstr($apaga_reg)."		
			";				
			
     $nm_select = $sqldint; 
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
      
			$this->rs->MoveNext();		
		}
		$this->rs->Close();
	}
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	$sqld="
		SELECT 
			cpf, 
			hospede 
		FROM 
			roomlist_rsvp_r
		WHERE 
			cpf IN (SELECT DISTINCT amq_cpf_03 FROM roomlist_rsvp_r)
		OR 
			amq_cpf_03 IN (SELECT DISTINCT cpf FROM roomlist_rsvp_r)
		AND 
			tipo_pessoa = 'ACOMPANHANTE'
		AND 
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	";
	 
      $nm_select = $sqld; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

	if ($this->rs  !== false) {
		if (strpos(strtolower($this->Ini->nm_tpbanco), "access") === false && !$this->Ini->sc_tem_trans_banco)
{
    $this->Db->BeginTrans();
    $this->Ini->sc_tem_trans_banco = true;
}

		while (!$this->rs->EOF) {
			$apaga_reg = $this->rs->fields[0];
			$sqldint ="
				DELETE FROM 
					roomlist_rsvp_r
				WHERE   
					cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
				AND
					cpf = ".$this->Db->qstr($apaga_reg)."		
			";				
			
     $nm_select = $sqldint; 
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
      
			$this->rs->MoveNext();		
		}
		$this->rs->Close();
	}
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

	$sqld="
		SELECT 
			cpf, 
			hospede 
		FROM 
			roomlist_rsvp_r
		WHERE 
			cpf IN (SELECT DISTINCT amq_cpf_04 FROM roomlist_rsvp_r)
		OR 
			amq_cpf_04 IN (SELECT DISTINCT cpf FROM roomlist_rsvp_r)
		AND 
			tipo_pessoa = 'ACOMPANHANTE'
		AND 
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	";
	 
      $nm_select = $sqld; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      if ($this->rs = $this->Db->Execute($nm_select)) 
      { }
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs = false;
          $this->rs_erro = $this->Db->ErrorMsg();
      } 

	if ($this->rs  !== false) {
		if (strpos(strtolower($this->Ini->nm_tpbanco), "access") === false && !$this->Ini->sc_tem_trans_banco)
{
    $this->Db->BeginTrans();
    $this->Ini->sc_tem_trans_banco = true;
}

		while (!$this->rs->EOF) {
			$apaga_reg = $this->rs->fields[0];
			$sqldint ="
				DELETE FROM 
					roomlist_rsvp_r
				WHERE   
					cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
				AND
					cpf = ".$this->Db->qstr($apaga_reg)."		
			";				
			
     $nm_select = $sqldint; 
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
      
			$this->rs->MoveNext();		
		}
		$this->rs->Close();
	}
	if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

} else {
	$params = array(
	'title' => 'Atenção!',
	'type' => 'warning',
	'timer' => '5000',
	'showConfirmButton' => 'false',
	'position' => 'center',
	'toast' => 'true'
	);
	$this->nm_mens_alert[] = "Erro ao carregar o relatório de Rooming List!";$this->nm_params_alert[] = $params;}

if($usunivel == 'CONVIDADO') {	
	$sqld="
		DELETE FROM 
			roomlist_rsvp_r
		WHERE   
			cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."				
		AND
			dsc_empresa_rsvp <> ".$this->Db->qstr($nome_empresa)."		
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
      						
}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_parm2)) {$_SESSION['parm2'] = $this->sc_temp_parm2;}
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida'])
      { 
          $xml_charset = $_SESSION['scriptcase']['charset'];
          $this->Xml_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $xml_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
          fwrite($xml_f, "<?xml version=\"1.0\" encoding=\"$xml_charset\" ?>\r\n");
          fwrite($xml_f, "<root>\r\n");
          if ($this->Grava_view)
          {
              $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
              $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view, "w");
              fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
              fwrite($xml_v, "<root>\r\n");
          }
      }
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT hospede, passaporte, rg, cpf, str_replace (convert(char(10),data_nasc,102), '.', '-') + ' ' + convert(char(8),data_nasc,20), ddd_clelular, celular, telefone_internacional, e_mail, tipo_pessoa, amq_nome_01, amq_nome_02, amq_nome_03, amq_nome_04, amq_cpf_01, amq_cpf_02, amq_cpf_03, amq_cpf_04, amq_rg_01, amq_rg_02, amq_rg_03, amq_rg_04, str_replace (convert(char(10),amq_dtnasc_01,102), '.', '-') + ' ' + convert(char(8),amq_dtnasc_01,20), str_replace (convert(char(10),amq_dtnasc_02,102), '.', '-') + ' ' + convert(char(8),amq_dtnasc_02,20), str_replace (convert(char(10),amq_dtnasc_03,102), '.', '-') + ' ' + convert(char(8),amq_dtnasc_03,20), str_replace (convert(char(10),amq_dtnasc_04,102), '.', '-') + ' ' + convert(char(8),amq_dtnasc_04,20), amq_docest_01, amq_docest_02, amq_docest_03, amq_docest_04, pmq_nome_01, pmq_nome_02, pmq_nome_03, pmq_nome_04, pmq_cpf_01, pmq_cpf_02, pmq_cpf_03, pmq_cpf_04, pmq_rg_01, pmq_rg_02, pmq_rg_03, pmq_rg_04, str_replace (convert(char(10),pmq_dtnasc_01,102), '.', '-') + ' ' + convert(char(8),pmq_dtnasc_01,20), str_replace (convert(char(10),pmq_dtnasc_02,102), '.', '-') + ' ' + convert(char(8),pmq_dtnasc_02,20), str_replace (convert(char(10),pmq_dtnasc_03,102), '.', '-') + ' ' + convert(char(8),pmq_dtnasc_03,20), str_replace (convert(char(10),pmq_dtnasc_04,102), '.', '-') + ' ' + convert(char(8),pmq_dtnasc_04,20), pmq_docest_01, pmq_docest_02, pmq_docest_03, pmq_docest_04, publico_dsc, hotel_dsc, early_checkin, late_checkout, acomodacao_dsc, categoria_dsc, str_replace (convert(char(10),dt_checkin,102), '.', '-') + ' ' + convert(char(8),dt_checkin,20), str_replace (convert(char(10),hr_transferin,102), '.', '-') + ' ' + convert(char(8),hr_transferin,20), str_replace (convert(char(10),dt_checkout,102), '.', '-') + ' ' + convert(char(8),dt_checkout,20), str_replace (convert(char(10),hr_transferout,102), '.', '-') + ' ' + convert(char(8),hr_transferout,20), str_replace (convert(char(10),intervalo_trout,102), '.', '-') + ' ' + convert(char(8),intervalo_trout,20), forma_pgto, observacoes, pacote_dsc, empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT hospede, passaporte, rg, cpf, data_nasc, ddd_clelular, celular, telefone_internacional, e_mail, tipo_pessoa, amq_nome_01, amq_nome_02, amq_nome_03, amq_nome_04, amq_cpf_01, amq_cpf_02, amq_cpf_03, amq_cpf_04, amq_rg_01, amq_rg_02, amq_rg_03, amq_rg_04, amq_dtnasc_01, amq_dtnasc_02, amq_dtnasc_03, amq_dtnasc_04, amq_docest_01, amq_docest_02, amq_docest_03, amq_docest_04, pmq_nome_01, pmq_nome_02, pmq_nome_03, pmq_nome_04, pmq_cpf_01, pmq_cpf_02, pmq_cpf_03, pmq_cpf_04, pmq_rg_01, pmq_rg_02, pmq_rg_03, pmq_rg_04, pmq_dtnasc_01, pmq_dtnasc_02, pmq_dtnasc_03, pmq_dtnasc_04, pmq_docest_01, pmq_docest_02, pmq_docest_03, pmq_docest_04, publico_dsc, hotel_dsc, early_checkin, late_checkout, acomodacao_dsc, categoria_dsc, dt_checkin, hr_transferin, dt_checkout, hr_transferout, intervalo_trout, forma_pgto, observacoes, pacote_dsc, empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT hospede, passaporte, rg, cpf, convert(char(23),data_nasc,121), ddd_clelular, celular, telefone_internacional, e_mail, tipo_pessoa, amq_nome_01, amq_nome_02, amq_nome_03, amq_nome_04, amq_cpf_01, amq_cpf_02, amq_cpf_03, amq_cpf_04, amq_rg_01, amq_rg_02, amq_rg_03, amq_rg_04, convert(char(23),amq_dtnasc_01,121), convert(char(23),amq_dtnasc_02,121), convert(char(23),amq_dtnasc_03,121), convert(char(23),amq_dtnasc_04,121), amq_docest_01, amq_docest_02, amq_docest_03, amq_docest_04, pmq_nome_01, pmq_nome_02, pmq_nome_03, pmq_nome_04, pmq_cpf_01, pmq_cpf_02, pmq_cpf_03, pmq_cpf_04, pmq_rg_01, pmq_rg_02, pmq_rg_03, pmq_rg_04, convert(char(23),pmq_dtnasc_01,121), convert(char(23),pmq_dtnasc_02,121), convert(char(23),pmq_dtnasc_03,121), convert(char(23),pmq_dtnasc_04,121), pmq_docest_01, pmq_docest_02, pmq_docest_03, pmq_docest_04, publico_dsc, hotel_dsc, early_checkin, late_checkout, acomodacao_dsc, categoria_dsc, convert(char(23),dt_checkin,121), convert(char(23),hr_transferin,121), convert(char(23),dt_checkout,121), convert(char(23),hr_transferout,121), convert(char(23),intervalo_trout,121), forma_pgto, observacoes, pacote_dsc, empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT hospede, passaporte, rg, cpf, data_nasc, ddd_clelular, celular, telefone_internacional, e_mail, tipo_pessoa, amq_nome_01, amq_nome_02, amq_nome_03, amq_nome_04, amq_cpf_01, amq_cpf_02, amq_cpf_03, amq_cpf_04, amq_rg_01, amq_rg_02, amq_rg_03, amq_rg_04, amq_dtnasc_01, amq_dtnasc_02, amq_dtnasc_03, amq_dtnasc_04, amq_docest_01, amq_docest_02, amq_docest_03, amq_docest_04, pmq_nome_01, pmq_nome_02, pmq_nome_03, pmq_nome_04, pmq_cpf_01, pmq_cpf_02, pmq_cpf_03, pmq_cpf_04, pmq_rg_01, pmq_rg_02, pmq_rg_03, pmq_rg_04, pmq_dtnasc_01, pmq_dtnasc_02, pmq_dtnasc_03, pmq_dtnasc_04, pmq_docest_01, pmq_docest_02, pmq_docest_03, pmq_docest_04, publico_dsc, hotel_dsc, early_checkin, late_checkout, acomodacao_dsc, categoria_dsc, dt_checkin, hr_transferin, dt_checkout, hr_transferout, intervalo_trout, forma_pgto, observacoes, pacote_dsc, empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT hospede, passaporte, rg, cpf, EXTEND(data_nasc, YEAR TO DAY), ddd_clelular, celular, telefone_internacional, e_mail, tipo_pessoa, amq_nome_01, amq_nome_02, amq_nome_03, amq_nome_04, amq_cpf_01, amq_cpf_02, amq_cpf_03, amq_cpf_04, amq_rg_01, amq_rg_02, amq_rg_03, amq_rg_04, EXTEND(amq_dtnasc_01, YEAR TO DAY), EXTEND(amq_dtnasc_02, YEAR TO DAY), EXTEND(amq_dtnasc_03, YEAR TO DAY), EXTEND(amq_dtnasc_04, YEAR TO DAY), amq_docest_01, amq_docest_02, amq_docest_03, amq_docest_04, pmq_nome_01, pmq_nome_02, pmq_nome_03, pmq_nome_04, pmq_cpf_01, pmq_cpf_02, pmq_cpf_03, pmq_cpf_04, pmq_rg_01, pmq_rg_02, pmq_rg_03, pmq_rg_04, EXTEND(pmq_dtnasc_01, YEAR TO DAY), EXTEND(pmq_dtnasc_02, YEAR TO DAY), EXTEND(pmq_dtnasc_03, YEAR TO DAY), EXTEND(pmq_dtnasc_04, YEAR TO DAY), pmq_docest_01, pmq_docest_02, pmq_docest_03, pmq_docest_04, publico_dsc, hotel_dsc, early_checkin, late_checkout, acomodacao_dsc, categoria_dsc, EXTEND(dt_checkin, YEAR TO DAY), hr_transferin, EXTEND(dt_checkout, YEAR TO DAY), hr_transferout, intervalo_trout, forma_pgto, observacoes, pacote_dsc, empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT hospede, passaporte, rg, cpf, data_nasc, ddd_clelular, celular, telefone_internacional, e_mail, tipo_pessoa, amq_nome_01, amq_nome_02, amq_nome_03, amq_nome_04, amq_cpf_01, amq_cpf_02, amq_cpf_03, amq_cpf_04, amq_rg_01, amq_rg_02, amq_rg_03, amq_rg_04, amq_dtnasc_01, amq_dtnasc_02, amq_dtnasc_03, amq_dtnasc_04, amq_docest_01, amq_docest_02, amq_docest_03, amq_docest_04, pmq_nome_01, pmq_nome_02, pmq_nome_03, pmq_nome_04, pmq_cpf_01, pmq_cpf_02, pmq_cpf_03, pmq_cpf_04, pmq_rg_01, pmq_rg_02, pmq_rg_03, pmq_rg_04, pmq_dtnasc_01, pmq_dtnasc_02, pmq_dtnasc_03, pmq_dtnasc_04, pmq_docest_01, pmq_docest_02, pmq_docest_03, pmq_docest_04, publico_dsc, hotel_dsc, early_checkin, late_checkout, acomodacao_dsc, categoria_dsc, dt_checkin, hr_transferin, dt_checkout, hr_transferout, intervalo_trout, forma_pgto, observacoes, pacote_dsc, empresa, grupo, cargo, anotacoes, evento_dsc, room_id, id_usuario_relato from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['order_grid'];
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
      $this->xml_registro = "";
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida'])
         { 
             $this->xml_registro .= "<" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro = "<grid_roomlist_rsvp_r>\r\n";
         }
         else
         {
             $this->xml_registro = "<grid_roomlist_rsvp_r";
         }
         $this->hospede = $rs->fields[0] ;  
         $this->passaporte = $rs->fields[1] ;  
         $this->rg = $rs->fields[2] ;  
         $this->cpf = $rs->fields[3] ;  
         $this->data_nasc = $rs->fields[4] ;  
         $this->ddd_clelular = $rs->fields[5] ;  
         $this->celular = $rs->fields[6] ;  
         $this->telefone_internacional = $rs->fields[7] ;  
         $this->e_mail = $rs->fields[8] ;  
         $this->tipo_pessoa = $rs->fields[9] ;  
         $this->amq_nome_01 = $rs->fields[10] ;  
         $this->amq_nome_02 = $rs->fields[11] ;  
         $this->amq_nome_03 = $rs->fields[12] ;  
         $this->amq_nome_04 = $rs->fields[13] ;  
         $this->amq_cpf_01 = $rs->fields[14] ;  
         $this->amq_cpf_02 = $rs->fields[15] ;  
         $this->amq_cpf_03 = $rs->fields[16] ;  
         $this->amq_cpf_04 = $rs->fields[17] ;  
         $this->amq_rg_01 = $rs->fields[18] ;  
         $this->amq_rg_02 = $rs->fields[19] ;  
         $this->amq_rg_03 = $rs->fields[20] ;  
         $this->amq_rg_04 = $rs->fields[21] ;  
         $this->amq_dtnasc_01 = $rs->fields[22] ;  
         $this->amq_dtnasc_02 = $rs->fields[23] ;  
         $this->amq_dtnasc_03 = $rs->fields[24] ;  
         $this->amq_dtnasc_04 = $rs->fields[25] ;  
         $this->amq_docest_01 = $rs->fields[26] ;  
         $this->amq_docest_02 = $rs->fields[27] ;  
         $this->amq_docest_03 = $rs->fields[28] ;  
         $this->amq_docest_04 = $rs->fields[29] ;  
         $this->pmq_nome_01 = $rs->fields[30] ;  
         $this->pmq_nome_02 = $rs->fields[31] ;  
         $this->pmq_nome_03 = $rs->fields[32] ;  
         $this->pmq_nome_04 = $rs->fields[33] ;  
         $this->pmq_cpf_01 = $rs->fields[34] ;  
         $this->pmq_cpf_02 = $rs->fields[35] ;  
         $this->pmq_cpf_03 = $rs->fields[36] ;  
         $this->pmq_cpf_04 = $rs->fields[37] ;  
         $this->pmq_rg_01 = $rs->fields[38] ;  
         $this->pmq_rg_02 = $rs->fields[39] ;  
         $this->pmq_rg_03 = $rs->fields[40] ;  
         $this->pmq_rg_04 = $rs->fields[41] ;  
         $this->pmq_dtnasc_01 = $rs->fields[42] ;  
         $this->pmq_dtnasc_02 = $rs->fields[43] ;  
         $this->pmq_dtnasc_03 = $rs->fields[44] ;  
         $this->pmq_dtnasc_04 = $rs->fields[45] ;  
         $this->pmq_docest_01 = $rs->fields[46] ;  
         $this->pmq_docest_02 = $rs->fields[47] ;  
         $this->pmq_docest_03 = $rs->fields[48] ;  
         $this->pmq_docest_04 = $rs->fields[49] ;  
         $this->publico_dsc = $rs->fields[50] ;  
         $this->hotel_dsc = $rs->fields[51] ;  
         $this->early_checkin = $rs->fields[52] ;  
         $this->late_checkout = $rs->fields[53] ;  
         $this->acomodacao_dsc = $rs->fields[54] ;  
         $this->categoria_dsc = $rs->fields[55] ;  
         $this->dt_checkin = $rs->fields[56] ;  
         $this->hr_transferin = $rs->fields[57] ;  
         $this->dt_checkout = $rs->fields[58] ;  
         $this->hr_transferout = $rs->fields[59] ;  
         $this->intervalo_trout = $rs->fields[60] ;  
         $this->forma_pgto = $rs->fields[61] ;  
         $this->observacoes = $rs->fields[62] ;  
         $this->pacote_dsc = $rs->fields[63] ;  
         $this->empresa = $rs->fields[64] ;  
         $this->grupo = $rs->fields[65] ;  
         $this->cargo = $rs->fields[66] ;  
         $this->anotacoes = $rs->fields[67] ;  
         $this->evento_dsc = $rs->fields[68] ;  
         $this->room_id = $rs->fields[69] ;  
         $this->room_id = (string)$this->room_id;
         $this->id_usuario_relato = $rs->fields[70] ;  
         $this->id_usuario_relato = (string)$this->id_usuario_relato;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida'])
         { 
             $this->xml_registro .= "</" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro .= "</grid_roomlist_rsvp_r>\r\n";
         }
         else
         {
             $this->xml_registro .= " />\r\n";
         }
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida'])
         { 
             fwrite($xml_f, $this->xml_registro);
             if ($this->Grava_view)
             {
                fwrite($xml_v, $this->xml_registro);
             }
         }
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['embutida'])
      { 
          if (!$this->New_Format)
          {
              $this->xml_registro = "";
          }
          $_SESSION['scriptcase']['export_return'] = $this->xml_registro;
      }
      else
      { 
          fwrite($xml_f, "</root>");
          fclose($xml_f);
          if ($this->Grava_view)
          {
             fwrite($xml_v, "</root>");
             fclose($xml_v);
          }
          if ($this->Tem_xml_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "grid_roomlist_rsvp_r_res_xml.class.php");
              $this->Res = new grid_roomlist_rsvp_r_res_xml();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_res_grid'] = true;
              $this->Res->monta_xml();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Xml_password != "" || $this->Tem_xml_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Xml_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Xml_f, ' ')) ? " \"" . $this->Xml_f . "\"" :  $this->Xml_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
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
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
              $this->Xml_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_xml_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_res_file']['xml'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_res_file']['xml']);
              }
              if ($this->Grava_view)
              {
                  $str_zip    = "";
                  $xml_view_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view;
                  $zip_view_f = str_replace(".zip", "_view.zip", $this->Zip_f);
                  $zip_arq_v  = str_replace(".zip", "_view.zip", $this->Arq_zip);
                  $Zip_f      = (FALSE !== strpos($zip_view_f, ' ')) ? " \"" . $zip_view_f . "\"" :  $zip_view_f;
                  $Arq_input  = (FALSE !== strpos($xml_view_ff, ' ')) ? " \"" . $xml_view_f . "\"" :  $xml_view_f;
                  if (is_file($Zip_f)) {
                      unlink($Zip_f);
                  }
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      chdir($this->Ini->path_third . "/zip/windows");
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
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
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      chdir($this->Ini->path_third . "/zip/mac/bin");
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
                  unlink($Arq_input);
                  $this->Arquivo_view = $zip_arq_v;
                  if ($this->Tem_xml_res)
                  { 
                      $str_zip   = "";
                      $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_res_file']['view'];
                      $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                      if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                      {
                          $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
                      unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_res_file']['view']);
                  }
              } 
              else 
              {
                  $this->Arquivo_view = $this->Arq_zip;
              } 
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- hospede
   function NM_export_hospede()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hospede))
         {
             $this->hospede = sc_convert_encoding($this->hospede, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hospede'])) ? $this->New_label['hospede'] : "Hóspede"; 
         }
         else
         {
             $SC_Label = "hospede"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hospede) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hospede) . "\"";
         }
   }
   //----- passaporte
   function NM_export_passaporte()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->passaporte))
         {
             $this->passaporte = sc_convert_encoding($this->passaporte, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['passaporte'])) ? $this->New_label['passaporte'] : "Passaporte"; 
         }
         else
         {
             $SC_Label = "passaporte"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->passaporte) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->passaporte) . "\"";
         }
   }
   //----- rg
   function NM_export_rg()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->rg))
         {
             $this->rg = sc_convert_encoding($this->rg, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['rg'])) ? $this->New_label['rg'] : "RG"; 
         }
         else
         {
             $SC_Label = "rg"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->rg) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->rg) . "\"";
         }
   }
   //----- cpf
   function NM_export_cpf()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cpf))
         {
             $this->cpf = sc_convert_encoding($this->cpf, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cpf'])) ? $this->New_label['cpf'] : "CPF"; 
         }
         else
         {
             $SC_Label = "cpf"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cpf) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cpf) . "\"";
         }
   }
   //----- data_nasc
   function NM_export_data_nasc()
   {
             $conteudo_x =  $this->data_nasc;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->data_nasc, "YYYY-MM-DD  ");
                 $this->data_nasc = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['data_nasc'])) ? $this->New_label['data_nasc'] : "Nascimento"; 
         }
         else
         {
             $SC_Label = "data_nasc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->data_nasc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->data_nasc) . "\"";
         }
   }
   //----- ddd_clelular
   function NM_export_ddd_clelular()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->ddd_clelular))
         {
             $this->ddd_clelular = sc_convert_encoding($this->ddd_clelular, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['ddd_clelular'])) ? $this->New_label['ddd_clelular'] : "DDD Celular"; 
         }
         else
         {
             $SC_Label = "ddd_clelular"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->ddd_clelular) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->ddd_clelular) . "\"";
         }
   }
   //----- celular
   function NM_export_celular()
   {
             if ($this->celular !== "&nbsp;") 
             { 
                 $this->nm_gera_mask($this->celular, "#####-####"); 
             } 
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->celular))
         {
             $this->celular = sc_convert_encoding($this->celular, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['celular'])) ? $this->New_label['celular'] : "Celular"; 
         }
         else
         {
             $SC_Label = "celular"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->celular) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->celular) . "\"";
         }
   }
   //----- telefone_internacional
   function NM_export_telefone_internacional()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->telefone_internacional))
         {
             $this->telefone_internacional = sc_convert_encoding($this->telefone_internacional, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['telefone_internacional'])) ? $this->New_label['telefone_internacional'] : "Telefone Internacional"; 
         }
         else
         {
             $SC_Label = "telefone_internacional"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->telefone_internacional) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->telefone_internacional) . "\"";
         }
   }
   //----- e_mail
   function NM_export_e_mail()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->e_mail))
         {
             $this->e_mail = sc_convert_encoding($this->e_mail, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['e_mail'])) ? $this->New_label['e_mail'] : "e-Mail"; 
         }
         else
         {
             $SC_Label = "e_mail"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->e_mail) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->e_mail) . "\"";
         }
   }
   //----- tipo_pessoa
   function NM_export_tipo_pessoa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->tipo_pessoa))
         {
             $this->tipo_pessoa = sc_convert_encoding($this->tipo_pessoa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['tipo_pessoa'])) ? $this->New_label['tipo_pessoa'] : "Tipo"; 
         }
         else
         {
             $SC_Label = "tipo_pessoa"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->tipo_pessoa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->tipo_pessoa) . "\"";
         }
   }
   //----- amq_nome_01
   function NM_export_amq_nome_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_nome_01))
         {
             $this->amq_nome_01 = sc_convert_encoding($this->amq_nome_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_nome_01'])) ? $this->New_label['amq_nome_01'] : "Acompanhante 01 (mesmo quarto)"; 
         }
         else
         {
             $SC_Label = "amq_nome_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_nome_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_nome_01) . "\"";
         }
   }
   //----- amq_nome_02
   function NM_export_amq_nome_02()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_nome_02))
         {
             $this->amq_nome_02 = sc_convert_encoding($this->amq_nome_02, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_nome_02'])) ? $this->New_label['amq_nome_02'] : "Acompanhante 02"; 
         }
         else
         {
             $SC_Label = "amq_nome_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_nome_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_nome_02) . "\"";
         }
   }
   //----- amq_nome_03
   function NM_export_amq_nome_03()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_nome_03))
         {
             $this->amq_nome_03 = sc_convert_encoding($this->amq_nome_03, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_nome_03'])) ? $this->New_label['amq_nome_03'] : "Acompanhante 03"; 
         }
         else
         {
             $SC_Label = "amq_nome_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_nome_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_nome_03) . "\"";
         }
   }
   //----- amq_nome_04
   function NM_export_amq_nome_04()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_nome_04))
         {
             $this->amq_nome_04 = sc_convert_encoding($this->amq_nome_04, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_nome_04'])) ? $this->New_label['amq_nome_04'] : "Acompanhante 04"; 
         }
         else
         {
             $SC_Label = "amq_nome_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_nome_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_nome_04) . "\"";
         }
   }
   //----- amq_cpf_01
   function NM_export_amq_cpf_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_cpf_01))
         {
             $this->amq_cpf_01 = sc_convert_encoding($this->amq_cpf_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_cpf_01'])) ? $this->New_label['amq_cpf_01'] : "CPF Acompanhante 01"; 
         }
         else
         {
             $SC_Label = "amq_cpf_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_cpf_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_cpf_01) . "\"";
         }
   }
   //----- amq_cpf_02
   function NM_export_amq_cpf_02()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_cpf_02))
         {
             $this->amq_cpf_02 = sc_convert_encoding($this->amq_cpf_02, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_cpf_02'])) ? $this->New_label['amq_cpf_02'] : "CPF Acompanhante 02"; 
         }
         else
         {
             $SC_Label = "amq_cpf_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_cpf_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_cpf_02) . "\"";
         }
   }
   //----- amq_cpf_03
   function NM_export_amq_cpf_03()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_cpf_03))
         {
             $this->amq_cpf_03 = sc_convert_encoding($this->amq_cpf_03, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_cpf_03'])) ? $this->New_label['amq_cpf_03'] : "CPF Acompanhante 03"; 
         }
         else
         {
             $SC_Label = "amq_cpf_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_cpf_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_cpf_03) . "\"";
         }
   }
   //----- amq_cpf_04
   function NM_export_amq_cpf_04()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_cpf_04))
         {
             $this->amq_cpf_04 = sc_convert_encoding($this->amq_cpf_04, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_cpf_04'])) ? $this->New_label['amq_cpf_04'] : "CPF Acompanhante 04"; 
         }
         else
         {
             $SC_Label = "amq_cpf_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_cpf_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_cpf_04) . "\"";
         }
   }
   //----- amq_rg_01
   function NM_export_amq_rg_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_rg_01))
         {
             $this->amq_rg_01 = sc_convert_encoding($this->amq_rg_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_rg_01'])) ? $this->New_label['amq_rg_01'] : "RG Acompanhante 01"; 
         }
         else
         {
             $SC_Label = "amq_rg_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_rg_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_rg_01) . "\"";
         }
   }
   //----- amq_rg_02
   function NM_export_amq_rg_02()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_rg_02))
         {
             $this->amq_rg_02 = sc_convert_encoding($this->amq_rg_02, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_rg_02'])) ? $this->New_label['amq_rg_02'] : "RG Acompanhante 02"; 
         }
         else
         {
             $SC_Label = "amq_rg_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_rg_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_rg_02) . "\"";
         }
   }
   //----- amq_rg_03
   function NM_export_amq_rg_03()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_rg_03))
         {
             $this->amq_rg_03 = sc_convert_encoding($this->amq_rg_03, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_rg_03'])) ? $this->New_label['amq_rg_03'] : "RG Acompanhante 03"; 
         }
         else
         {
             $SC_Label = "amq_rg_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_rg_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_rg_03) . "\"";
         }
   }
   //----- amq_rg_04
   function NM_export_amq_rg_04()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_rg_04))
         {
             $this->amq_rg_04 = sc_convert_encoding($this->amq_rg_04, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_rg_04'])) ? $this->New_label['amq_rg_04'] : "RG Acompanhante 04"; 
         }
         else
         {
             $SC_Label = "amq_rg_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_rg_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_rg_04) . "\"";
         }
   }
   //----- amq_dtnasc_01
   function NM_export_amq_dtnasc_01()
   {
             $conteudo_x =  $this->amq_dtnasc_01;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->amq_dtnasc_01, "YYYY-MM-DD  ");
                 $this->amq_dtnasc_01 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_dtnasc_01'])) ? $this->New_label['amq_dtnasc_01'] : "Dt. Nasc. Acompanhante 01"; 
         }
         else
         {
             $SC_Label = "amq_dtnasc_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_dtnasc_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_dtnasc_01) . "\"";
         }
   }
   //----- amq_dtnasc_02
   function NM_export_amq_dtnasc_02()
   {
             $conteudo_x =  $this->amq_dtnasc_02;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->amq_dtnasc_02, "YYYY-MM-DD  ");
                 $this->amq_dtnasc_02 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_dtnasc_02'])) ? $this->New_label['amq_dtnasc_02'] : "Dt. Nasc. Acompanhante 02"; 
         }
         else
         {
             $SC_Label = "amq_dtnasc_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_dtnasc_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_dtnasc_02) . "\"";
         }
   }
   //----- amq_dtnasc_03
   function NM_export_amq_dtnasc_03()
   {
             $conteudo_x =  $this->amq_dtnasc_03;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->amq_dtnasc_03, "YYYY-MM-DD  ");
                 $this->amq_dtnasc_03 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_dtnasc_03'])) ? $this->New_label['amq_dtnasc_03'] : "Dt. Nasc. Acompanhante 03"; 
         }
         else
         {
             $SC_Label = "amq_dtnasc_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_dtnasc_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_dtnasc_03) . "\"";
         }
   }
   //----- amq_dtnasc_04
   function NM_export_amq_dtnasc_04()
   {
             $conteudo_x =  $this->amq_dtnasc_04;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->amq_dtnasc_04, "YYYY-MM-DD  ");
                 $this->amq_dtnasc_04 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_dtnasc_04'])) ? $this->New_label['amq_dtnasc_04'] : "Dt. Nasc. Acompanhante 04"; 
         }
         else
         {
             $SC_Label = "amq_dtnasc_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_dtnasc_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_dtnasc_04) . "\"";
         }
   }
   //----- amq_docest_01
   function NM_export_amq_docest_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_docest_01))
         {
             $this->amq_docest_01 = sc_convert_encoding($this->amq_docest_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_docest_01'])) ? $this->New_label['amq_docest_01'] : "Doc. Estrang. Acompanhante 01"; 
         }
         else
         {
             $SC_Label = "amq_docest_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_docest_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_docest_01) . "\"";
         }
   }
   //----- amq_docest_02
   function NM_export_amq_docest_02()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_docest_02))
         {
             $this->amq_docest_02 = sc_convert_encoding($this->amq_docest_02, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_docest_02'])) ? $this->New_label['amq_docest_02'] : "Doc. Estrang. Acompanhante 02"; 
         }
         else
         {
             $SC_Label = "amq_docest_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_docest_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_docest_02) . "\"";
         }
   }
   //----- amq_docest_03
   function NM_export_amq_docest_03()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_docest_03))
         {
             $this->amq_docest_03 = sc_convert_encoding($this->amq_docest_03, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_docest_03'])) ? $this->New_label['amq_docest_03'] : "Doc. Estrang. Acompanhante 03"; 
         }
         else
         {
             $SC_Label = "amq_docest_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_docest_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_docest_03) . "\"";
         }
   }
   //----- amq_docest_04
   function NM_export_amq_docest_04()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->amq_docest_04))
         {
             $this->amq_docest_04 = sc_convert_encoding($this->amq_docest_04, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['amq_docest_04'])) ? $this->New_label['amq_docest_04'] : "Doc. Estrang. Acompanhante 04"; 
         }
         else
         {
             $SC_Label = "amq_docest_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->amq_docest_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->amq_docest_04) . "\"";
         }
   }
   //----- pmq_nome_01
   function NM_export_pmq_nome_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_nome_01))
         {
             $this->pmq_nome_01 = sc_convert_encoding($this->pmq_nome_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_nome_01'])) ? $this->New_label['pmq_nome_01'] : "Participante 01 (mesmo quarto)"; 
         }
         else
         {
             $SC_Label = "pmq_nome_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_nome_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_nome_01) . "\"";
         }
   }
   //----- pmq_nome_02
   function NM_export_pmq_nome_02()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_nome_02))
         {
             $this->pmq_nome_02 = sc_convert_encoding($this->pmq_nome_02, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_nome_02'])) ? $this->New_label['pmq_nome_02'] : "Participante 02 "; 
         }
         else
         {
             $SC_Label = "pmq_nome_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_nome_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_nome_02) . "\"";
         }
   }
   //----- pmq_nome_03
   function NM_export_pmq_nome_03()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_nome_03))
         {
             $this->pmq_nome_03 = sc_convert_encoding($this->pmq_nome_03, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_nome_03'])) ? $this->New_label['pmq_nome_03'] : "Participante 03 "; 
         }
         else
         {
             $SC_Label = "pmq_nome_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_nome_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_nome_03) . "\"";
         }
   }
   //----- pmq_nome_04
   function NM_export_pmq_nome_04()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_nome_04))
         {
             $this->pmq_nome_04 = sc_convert_encoding($this->pmq_nome_04, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_nome_04'])) ? $this->New_label['pmq_nome_04'] : "Participante 04 "; 
         }
         else
         {
             $SC_Label = "pmq_nome_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_nome_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_nome_04) . "\"";
         }
   }
   //----- pmq_cpf_01
   function NM_export_pmq_cpf_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_cpf_01))
         {
             $this->pmq_cpf_01 = sc_convert_encoding($this->pmq_cpf_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_cpf_01'])) ? $this->New_label['pmq_cpf_01'] : "CPF Participante 01"; 
         }
         else
         {
             $SC_Label = "pmq_cpf_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_cpf_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_cpf_01) . "\"";
         }
   }
   //----- pmq_cpf_02
   function NM_export_pmq_cpf_02()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_cpf_02))
         {
             $this->pmq_cpf_02 = sc_convert_encoding($this->pmq_cpf_02, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_cpf_02'])) ? $this->New_label['pmq_cpf_02'] : "CPF Participante 02"; 
         }
         else
         {
             $SC_Label = "pmq_cpf_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_cpf_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_cpf_02) . "\"";
         }
   }
   //----- pmq_cpf_03
   function NM_export_pmq_cpf_03()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_cpf_03))
         {
             $this->pmq_cpf_03 = sc_convert_encoding($this->pmq_cpf_03, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_cpf_03'])) ? $this->New_label['pmq_cpf_03'] : "CPF Participante 03"; 
         }
         else
         {
             $SC_Label = "pmq_cpf_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_cpf_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_cpf_03) . "\"";
         }
   }
   //----- pmq_cpf_04
   function NM_export_pmq_cpf_04()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_cpf_04))
         {
             $this->pmq_cpf_04 = sc_convert_encoding($this->pmq_cpf_04, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_cpf_04'])) ? $this->New_label['pmq_cpf_04'] : "CPF Participante 04"; 
         }
         else
         {
             $SC_Label = "pmq_cpf_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_cpf_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_cpf_04) . "\"";
         }
   }
   //----- pmq_rg_01
   function NM_export_pmq_rg_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_rg_01))
         {
             $this->pmq_rg_01 = sc_convert_encoding($this->pmq_rg_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_rg_01'])) ? $this->New_label['pmq_rg_01'] : "RG Participante 01"; 
         }
         else
         {
             $SC_Label = "pmq_rg_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_rg_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_rg_01) . "\"";
         }
   }
   //----- pmq_rg_02
   function NM_export_pmq_rg_02()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_rg_02))
         {
             $this->pmq_rg_02 = sc_convert_encoding($this->pmq_rg_02, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_rg_02'])) ? $this->New_label['pmq_rg_02'] : "RG Participante 02"; 
         }
         else
         {
             $SC_Label = "pmq_rg_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_rg_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_rg_02) . "\"";
         }
   }
   //----- pmq_rg_03
   function NM_export_pmq_rg_03()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_rg_03))
         {
             $this->pmq_rg_03 = sc_convert_encoding($this->pmq_rg_03, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_rg_03'])) ? $this->New_label['pmq_rg_03'] : "RG Participante 03"; 
         }
         else
         {
             $SC_Label = "pmq_rg_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_rg_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_rg_03) . "\"";
         }
   }
   //----- pmq_rg_04
   function NM_export_pmq_rg_04()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_rg_04))
         {
             $this->pmq_rg_04 = sc_convert_encoding($this->pmq_rg_04, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_rg_04'])) ? $this->New_label['pmq_rg_04'] : "RG Participante 04"; 
         }
         else
         {
             $SC_Label = "pmq_rg_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_rg_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_rg_04) . "\"";
         }
   }
   //----- pmq_dtnasc_01
   function NM_export_pmq_dtnasc_01()
   {
             $conteudo_x =  $this->pmq_dtnasc_01;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pmq_dtnasc_01, "YYYY-MM-DD  ");
                 $this->pmq_dtnasc_01 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_dtnasc_01'])) ? $this->New_label['pmq_dtnasc_01'] : "Dt. Nasc. Participante 01"; 
         }
         else
         {
             $SC_Label = "pmq_dtnasc_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_dtnasc_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_dtnasc_01) . "\"";
         }
   }
   //----- pmq_dtnasc_02
   function NM_export_pmq_dtnasc_02()
   {
             $conteudo_x =  $this->pmq_dtnasc_02;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pmq_dtnasc_02, "YYYY-MM-DD  ");
                 $this->pmq_dtnasc_02 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_dtnasc_02'])) ? $this->New_label['pmq_dtnasc_02'] : "Dt. Nasc. Participante 02"; 
         }
         else
         {
             $SC_Label = "pmq_dtnasc_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_dtnasc_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_dtnasc_02) . "\"";
         }
   }
   //----- pmq_dtnasc_03
   function NM_export_pmq_dtnasc_03()
   {
             $conteudo_x =  $this->pmq_dtnasc_03;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pmq_dtnasc_03, "YYYY-MM-DD  ");
                 $this->pmq_dtnasc_03 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_dtnasc_03'])) ? $this->New_label['pmq_dtnasc_03'] : "Dt. Nasc. Participante 03"; 
         }
         else
         {
             $SC_Label = "pmq_dtnasc_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_dtnasc_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_dtnasc_03) . "\"";
         }
   }
   //----- pmq_dtnasc_04
   function NM_export_pmq_dtnasc_04()
   {
             $conteudo_x =  $this->pmq_dtnasc_04;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->pmq_dtnasc_04, "YYYY-MM-DD  ");
                 $this->pmq_dtnasc_04 = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_dtnasc_04'])) ? $this->New_label['pmq_dtnasc_04'] : "Dt. Nasc. Participante 04"; 
         }
         else
         {
             $SC_Label = "pmq_dtnasc_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_dtnasc_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_dtnasc_04) . "\"";
         }
   }
   //----- pmq_docest_01
   function NM_export_pmq_docest_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_docest_01))
         {
             $this->pmq_docest_01 = sc_convert_encoding($this->pmq_docest_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_docest_01'])) ? $this->New_label['pmq_docest_01'] : "Doc. Estrang. Participante 01"; 
         }
         else
         {
             $SC_Label = "pmq_docest_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_docest_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_docest_01) . "\"";
         }
   }
   //----- pmq_docest_02
   function NM_export_pmq_docest_02()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_docest_02))
         {
             $this->pmq_docest_02 = sc_convert_encoding($this->pmq_docest_02, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_docest_02'])) ? $this->New_label['pmq_docest_02'] : "Doc. Estrang. Participante 02"; 
         }
         else
         {
             $SC_Label = "pmq_docest_02"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_docest_02) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_docest_02) . "\"";
         }
   }
   //----- pmq_docest_03
   function NM_export_pmq_docest_03()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_docest_03))
         {
             $this->pmq_docest_03 = sc_convert_encoding($this->pmq_docest_03, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_docest_03'])) ? $this->New_label['pmq_docest_03'] : "Doc. Estrang. Participante 03"; 
         }
         else
         {
             $SC_Label = "pmq_docest_03"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_docest_03) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_docest_03) . "\"";
         }
   }
   //----- pmq_docest_04
   function NM_export_pmq_docest_04()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pmq_docest_04))
         {
             $this->pmq_docest_04 = sc_convert_encoding($this->pmq_docest_04, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pmq_docest_04'])) ? $this->New_label['pmq_docest_04'] : "Doc. Estrang. Participante 04"; 
         }
         else
         {
             $SC_Label = "pmq_docest_04"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pmq_docest_04) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pmq_docest_04) . "\"";
         }
   }
   //----- publico_dsc
   function NM_export_publico_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->publico_dsc))
         {
             $this->publico_dsc = sc_convert_encoding($this->publico_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['publico_dsc'])) ? $this->New_label['publico_dsc'] : "Público"; 
         }
         else
         {
             $SC_Label = "publico_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->publico_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->publico_dsc) . "\"";
         }
   }
   //----- hotel_dsc
   function NM_export_hotel_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_dsc))
         {
             $this->hotel_dsc = sc_convert_encoding($this->hotel_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_dsc'])) ? $this->New_label['hotel_dsc'] : "Hotel"; 
         }
         else
         {
             $SC_Label = "hotel_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_dsc) . "\"";
         }
   }
   //----- early_checkin
   function NM_export_early_checkin()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->early_checkin))
         {
             $this->early_checkin = sc_convert_encoding($this->early_checkin, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['early_checkin'])) ? $this->New_label['early_checkin'] : "Early Checkin"; 
         }
         else
         {
             $SC_Label = "early_checkin"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->early_checkin) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->early_checkin) . "\"";
         }
   }
   //----- late_checkout
   function NM_export_late_checkout()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->late_checkout))
         {
             $this->late_checkout = sc_convert_encoding($this->late_checkout, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['late_checkout'])) ? $this->New_label['late_checkout'] : "Late Checkout"; 
         }
         else
         {
             $SC_Label = "late_checkout"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->late_checkout) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->late_checkout) . "\"";
         }
   }
   //----- acomodacao_dsc
   function NM_export_acomodacao_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->acomodacao_dsc))
         {
             $this->acomodacao_dsc = sc_convert_encoding($this->acomodacao_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['acomodacao_dsc'])) ? $this->New_label['acomodacao_dsc'] : "Acomodação"; 
         }
         else
         {
             $SC_Label = "acomodacao_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->acomodacao_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->acomodacao_dsc) . "\"";
         }
   }
   //----- categoria_dsc
   function NM_export_categoria_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->categoria_dsc))
         {
             $this->categoria_dsc = sc_convert_encoding($this->categoria_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['categoria_dsc'])) ? $this->New_label['categoria_dsc'] : "Categoria"; 
         }
         else
         {
             $SC_Label = "categoria_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->categoria_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->categoria_dsc) . "\"";
         }
   }
   //----- dt_checkin
   function NM_export_dt_checkin()
   {
             $conteudo_x =  $this->dt_checkin;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->dt_checkin, "YYYY-MM-DD  ");
                 $this->dt_checkin = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['dt_checkin'])) ? $this->New_label['dt_checkin'] : "CheckIn"; 
         }
         else
         {
             $SC_Label = "dt_checkin"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->dt_checkin) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->dt_checkin) . "\"";
         }
   }
   //----- hr_transferin
   function NM_export_hr_transferin()
   {
             $conteudo_x =  $this->hr_transferin;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hr_transferin, "HH:II:SS  ");
                 $this->hr_transferin = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hr_transferin'])) ? $this->New_label['hr_transferin'] : "Transfer In"; 
         }
         else
         {
             $SC_Label = "hr_transferin"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hr_transferin) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hr_transferin) . "\"";
         }
   }
   //----- dt_checkout
   function NM_export_dt_checkout()
   {
             $conteudo_x =  $this->dt_checkout;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->dt_checkout, "YYYY-MM-DD  ");
                 $this->dt_checkout = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['dt_checkout'])) ? $this->New_label['dt_checkout'] : "CheckOut"; 
         }
         else
         {
             $SC_Label = "dt_checkout"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->dt_checkout) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->dt_checkout) . "\"";
         }
   }
   //----- hr_transferout
   function NM_export_hr_transferout()
   {
             $conteudo_x =  $this->hr_transferout;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->hr_transferout, "HH:II:SS  ");
                 $this->hr_transferout = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hr_transferout'])) ? $this->New_label['hr_transferout'] : "Tranfer Out"; 
         }
         else
         {
             $SC_Label = "hr_transferout"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hr_transferout) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hr_transferout) . "\"";
         }
   }
   //----- intervalo_trout
   function NM_export_intervalo_trout()
   {
             $conteudo_x =  $this->intervalo_trout;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->intervalo_trout, "HH:II:SS  ");
                 $this->intervalo_trout = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['intervalo_trout'])) ? $this->New_label['intervalo_trout'] : "Intervalo Transf. Out"; 
         }
         else
         {
             $SC_Label = "intervalo_trout"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->intervalo_trout) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->intervalo_trout) . "\"";
         }
   }
   //----- forma_pgto
   function NM_export_forma_pgto()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->forma_pgto))
         {
             $this->forma_pgto = sc_convert_encoding($this->forma_pgto, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['forma_pgto'])) ? $this->New_label['forma_pgto'] : "Forma Pgto"; 
         }
         else
         {
             $SC_Label = "forma_pgto"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->forma_pgto) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->forma_pgto) . "\"";
         }
   }
   //----- observacoes
   function NM_export_observacoes()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->observacoes))
         {
             $this->observacoes = sc_convert_encoding($this->observacoes, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['observacoes'])) ? $this->New_label['observacoes'] : "Observaçôes"; 
         }
         else
         {
             $SC_Label = "observacoes"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->observacoes) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->observacoes) . "\"";
         }
   }
   //----- pacote_dsc
   function NM_export_pacote_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->pacote_dsc))
         {
             $this->pacote_dsc = sc_convert_encoding($this->pacote_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['pacote_dsc'])) ? $this->New_label['pacote_dsc'] : "Pacote"; 
         }
         else
         {
             $SC_Label = "pacote_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->pacote_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->pacote_dsc) . "\"";
         }
   }
   //----- empresa
   function NM_export_empresa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->empresa))
         {
             $this->empresa = sc_convert_encoding($this->empresa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['empresa'])) ? $this->New_label['empresa'] : "Empresa"; 
         }
         else
         {
             $SC_Label = "empresa"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->empresa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->empresa) . "\"";
         }
   }
   //----- grupo
   function NM_export_grupo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->grupo))
         {
             $this->grupo = sc_convert_encoding($this->grupo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['grupo'])) ? $this->New_label['grupo'] : "Grupo"; 
         }
         else
         {
             $SC_Label = "grupo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->grupo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->grupo) . "\"";
         }
   }
   //----- cargo
   function NM_export_cargo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cargo))
         {
             $this->cargo = sc_convert_encoding($this->cargo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cargo'])) ? $this->New_label['cargo'] : "Cargo"; 
         }
         else
         {
             $SC_Label = "cargo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cargo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cargo) . "\"";
         }
   }
   //----- anotacoes
   function NM_export_anotacoes()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->anotacoes))
         {
             $this->anotacoes = sc_convert_encoding($this->anotacoes, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['anotacoes'])) ? $this->New_label['anotacoes'] : "Anotacoes"; 
         }
         else
         {
             $SC_Label = "anotacoes"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->anotacoes) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->anotacoes) . "\"";
         }
   }
   //----- evento_dsc
   function NM_export_evento_dsc()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->evento_dsc))
         {
             $this->evento_dsc = sc_convert_encoding($this->evento_dsc, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['evento_dsc'])) ? $this->New_label['evento_dsc'] : "Evento"; 
         }
         else
         {
             $SC_Label = "evento_dsc"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->evento_dsc) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->evento_dsc) . "\"";
         }
   }
   //----- room_id
   function NM_export_room_id()
   {
             nmgp_Form_Num_Val($this->room_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['room_id'])) ? $this->New_label['room_id'] : "Room Id"; 
         }
         else
         {
             $SC_Label = "room_id"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->room_id) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->room_id) . "\"";
         }
   }

   //----- 
   function trata_dados($conteudo)
   {
      $str_temp =  $conteudo;
      $str_temp =  str_replace("<br />", "",  $str_temp);
      $str_temp =  str_replace("&", "&amp;",  $str_temp);
      $str_temp =  str_replace("<", "&lt;",   $str_temp);
      $str_temp =  str_replace(">", "&gt;",   $str_temp);
      $str_temp =  str_replace("'", "&apos;", $str_temp);
      $str_temp =  str_replace('"', "&quot;",  $str_temp);
      $str_temp =  str_replace('(', "_",  $str_temp);
      $str_temp =  str_replace(')', "",  $str_temp);
      return ($str_temp);
   }

   function clear_tag(&$conteudo)
   {
      $out = (is_numeric(substr($conteudo, 0, 1)) || substr($conteudo, 0, 1) == "") ? "_" : "";
      $str_temp = "abcdefghijklmnopqrstuvwxyz0123456789";
      for ($i = 0; $i < strlen($conteudo); $i++)
      {
          $char = substr($conteudo, $i, 1);
          $ok = false;
          for ($z = 0; $z < strlen($str_temp); $z++)
          {
              if (strtolower($char) == substr($str_temp, $z, 1))
              {
                  $ok = true;
                  break;
              }
          }
          $out .= ($ok) ? $char : "_";
      }
      $conteudo = $out;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_title'] ?> roomlist_rsvp_r :: XML</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XML</td>
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
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_roomlist_rsvp_r_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_roomlist_rsvp_r"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_roomlist_rsvp_r']['xml_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function PrepRoom2($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  		
		
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';	
		$valor_y = 'Y';
		$valor_s = 'SIM';
		$valor_n = 'N';		
		
		if ($vp_tipoPessoa == 'P') {                                                                                      
			$sqld="                                                                                                          
			DELETE FROM                                                                                                      
				roomlist_rsvp_r
			WHERE                                                                                                            
				cod_evento = ".$this->Db->qstr($vp_evento)."                                                                                    
			AND                                                                                                              
				id_usuario_relato = ".$this->Db->qstr($vp_usuario)."                                                                           
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
		                                                                                 
		}	
		$sqlMestre = "		
		SELECT
			hospedagem_rsvp.hosp_cpf_participante,
			hospedagem_rsvp.hosp_id_evento,			        
			hospedagem_rsvp.hosp_acompanhante,		        
			hospedagem_rsvp.hosp_part_acomp,     	        
			hospedagem_rsvp.hosp_id_hotel,			        
			hospedagem_rsvp.hosp_acomodacao,			    
			hospedagem_rsvp.hosp_categoria,  		        
			hospedagem_rsvp.hosp_dt_checkin,			    
			hospedagem_rsvp.hosp_dt_checkout,   		    
			hospedagem_rsvp.hosp_early_chkin,  		        
			hospedagem_rsvp.hosp_late_chkout, 		        
			hospedagem_rsvp.hosp_pagamentos, 		        
			hospedagem_rsvp.hosp_observacoes,		        
			hospedagem_rsvp.hosp_dsc_pacote, 				               
			transfer_rsvp.tra_numvoo_ida,	                
			transfer_rsvp.tra_cia_ida,   		  
			transfer_rsvp.tra_hr_chegada_ida,
			transfer_rsvp.tra_numvoo_volta,                 
			transfer_rsvp.tra_cia_volta,		            
			transfer_rsvp.tra_hr_saida_volta, 	            
			transfer_rsvp.tra_hrtransout,		            
			transfer_rsvp.tra_tipo,	
			transfer_rsvp.tra_direcao,	
			transfer_rsvp.tra_id_hotel,
			hospedagem_rsvp.acmq_01,
			hospedagem_rsvp.acmq_02,
			hospedagem_rsvp.acmq_03,
			hospedagem_rsvp.acmq_04,
			hospedagem_rsvp.pamq_01,
			hospedagem_rsvp.pamq_02,
			hospedagem_rsvp.pamq_03,
			hospedagem_rsvp.pamq_04
		FROM
			hospedagem_rsvp
		RIGHT JOIN
			transfer_rsvp
		ON
			transfer_rsvp.tra_cpf_particip = hospedagem_rsvp.hosp_cpf_participante		
		WHERE
			hospedagem_rsvp.hosp_id_evento = ".$this->Db->qstr($vp_evento)."
		AND
			hospedagem_rsvp.hosp_ativo	= ".$this->Db->qstr($valor_y)." 
		AND 
			hospedagem_rsvp.hosp_status	= ".$this->Db->qstr($valor_y)." 	
		AND
			hospedagem_rsvp.conta_roomlist = ".$this->Db->qstr($valor_s)." 
		AND
			transfer_rsvp.tra_status = ".$this->Db->qstr($valor_y)." 
		AND
			transfer_rsvp.tra_id_evento = ".$this->Db->qstr($vp_evento)."						
		ORDER BY
			hospedagem_rsvp.hosp_cpf_participante			
		";
		$_passa_part = true;			                                                                                          
		 
      $nm_select = $sqlMestre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsm = false;
          $this->rsm_erro = $this->Db->ErrorMsg();
      } 
	                                                                                      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
                                                                                    
		$reg_mestre = sizeof($this->rsm );		                                                                                    
		if ($reg_mestre > 0) {					
			for ($i=0;$i<$reg_mestre;++$i) {				
				$w_acmq_nome_01		= '';
				$w_acmq_cpf_01		= '';
				$w_acmq_dtnasc_01 	= '';
				$w_acmq_rg_01		= '';
				$w_acmq_docest_01	= '';
				$w_acmq_nome_02		= '';
				$w_acmq_cpf_02		= '';
				$w_acmq_rg_02		= '';
				$w_acmq_docest_02	= '';
				$w_acmq_dtnasc_02	= '';
				$w_acmq_nome_03		= '';
				$w_acmq_cpf_03		= '';
				$w_acmq_rg_03		= '';
				$w_acmq_docest_03	= '';
				$w_acmq_dtnasc_03	= '';
				$w_acmq_nome_04		= '';
				$w_acmq_cpf_04		= '';
				$w_acmq_rg_04		= '';
				$w_acmq_docest_04	= '';
				$w_acmq_dtnasc_04	= '';				
				
				$w_pamq_nome_01		= '';
				$w_pamq_cpf_01		= '';
				$w_pamq_dtnasc_01 	= '';
				$w_pamq_rg_01		= '';
				$w_pamq_docest_01	= '';
				$w_pamq_nome_02		= '';
				$w_pamq_cpf_02		= '';
				$w_pamq_rg_02		= '';
				$w_pamq_docest_02	= '';
				$w_pamq_dtnasc_02	= '';
				$w_pamq_nome_03		= '';
				$w_pamq_cpf_03		= '';
				$w_pamq_rg_03		= '';
				$w_pamq_docest_03	= '';
				$w_pamq_dtnasc_03	= '';
				$w_pamq_nome_04		= '';
				$w_pamq_cpf_04		= '';
				$w_pamq_rg_04		= '';
				$w_pamq_docest_04	= '';
				$w_pamq_dtnasc_04	= '';					
				
				$w_nome	= '';
				$w_part_passaporte = '';      	     				
				$w_part_rg = '';           
				$w_part_dt_nasc = '0000-00-00';   				       	
				$w_part_ddd_celular_01 = '';  	      				
				$w_part_celeular_01 = '';     	 
				$w_part_email = '';           					     
				$w_part_id_evento_publico = '';								
				$w_aqtd_mesquart = '0';   
				$w_pqtd_mesquart = '0';		            
				$w_publico = '';				                
				$w_hotel_dsc = '';			               
				$w_acomodacao = '';			              
				$w_categoria = '';			               
				$w_ciaida = '';			                 
				$w_ciavolta = '';				               
				$w_pagtoDsc = '';				               
				$w_eventoDsc = '';                  				
				$w_usurelDsc = '';                 
				$w_tipopess = '';                  
				$w_acompanhado = '';               
				
				$w_hosp_cpf_participante	= $this->rsm[$i][0];		
				$w_hosp_id_evento		    = $this->rsm[$i][1];     
				$w_hosp_acompanhante	    = $this->rsm[$i][2];     
				$w_hosp_part_acomp     	    = $this->rsm[$i][3];     
				$w_hosp_id_hotel		    = $this->rsm[$i][4];     
				$w_hosp_acomodacao		 	= $this->rsm[$i][5];     
				$w_hosp_categoria  		    = $this->rsm[$i][6];     
				$w_hosp_dt_checkin		 	= $this->rsm[$i][7];     
				$w_hosp_dt_checkout   	 	= $this->rsm[$i][8];     
				$w_hosp_early_chkin  	    = $this->rsm[$i][9];     
				$w_hosp_late_chkout 	    = $this->rsm[$i][10];    
				$w_hosp_pagamentos 		    = $this->rsm[$i][11];    
				$w_hosp_observacoes		    = $this->rsm[$i][12];    
				$w_hosp_dsc_pacote          = $this->rsm[$i][13];    
				$w_tra_numvoo_ida	        = $this->rsm[$i][14];	
				$w_tra_cia_ida   		    = $this->rsm[$i][15];	
				$w_tra_hr_saida_ida         = $this->rsm[$i][16];	
				$w_tra_numvoo_volta         = $this->rsm[$i][17];	
				$w_tra_cia_volta		    = $this->rsm[$i][18];	
				$w_tra_hr_saida_volta 	  	= $this->rsm[$i][19];    
				$w_tra_hrtransout		    = $this->rsm[$i][20];	
				$w_tra_tipotransfer			= $this->rsm[$i][21];    
				$f_tra_direcao				= $this->rsm[$i][22];	
				$f_tra_id_hotel				= $this->rsm[$i][23];    
				$w_hosp_acmq_01				= $this->rsm[$i][24];	
				$w_hosp_acmq_02				= $this->rsm[$i][25];    
				$w_hosp_acmq_03				= $this->rsm[$i][26];    
				$w_hosp_acmq_04				= $this->rsm[$i][27];    
				$w_hosp_pamq_01				= $this->rsm[$i][28];    
				$w_hosp_pamq_02				= $this->rsm[$i][29];    
				$w_hosp_pamq_03				= $this->rsm[$i][30];    
				$w_hosp_pamq_04				= $this->rsm[$i][31];	

				$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						nome_pessoa,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,						
						part_id_evento_publico,
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."
					ORDER BY                                                                                                        
						part_cpf
				";
				 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspart[0][0])) {											
					$w_nome				   		= $this->rspart[0][0];			  	             
					$w_part_passaporte     		= $this->rspart[0][1];    	     
					$w_part_rg             		= $this->rspart[0][2];    	
					$w_part_dt_nasc        		= $this->rspart[0][3];  	
					$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
					$w_part_celeular_01      	= $this->rspart[0][5]; 
					$w_part_email            	= $this->rspart[0][6];    
					$w_part_id_evento_publico	= $this->rspart[0][7];   
					$w_empresa					= $this->rspart[0][9];
					$w_grupo					= $this->rspart[0][10];
					$w_cargo					= $this->rspart[0][11];
					$w_tipopess 				= 'PARTICIPANTE';
					$w_foneinter				= $this->rspart[0][12];
					$w_dsc_emp_rsvp				= $this->rspart[0][13];					
				} else {
					$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						part_nome,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,	
						part_id_evento_publico					
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."			
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspart[0][0])) {											
						$w_nome				   		= $this->rspart[0][0];			  	             
						$w_part_passaporte     		= $this->rspart[0][1];    	     
						$w_part_rg             		= $this->rspart[0][2];    	
						$w_part_dt_nasc        		= $this->rspart[0][3];  	
						$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
						$w_part_celeular_01      	= $this->rspart[0][5]; 
						$w_part_email            	= $this->rspart[0][6];    
						$w_part_id_evento_publico	= $this->rspart[0][7];  
						$w_empresa					= $this->rspart[0][9];
						$w_grupo					= $this->rspart[0][10];
						$w_cargo					= $this->rspart[0][11];
						$w_tipopess 				= 'ACOMPANHANTE';
						$w_foneinter				= $this->rspart[0][12];
						$w_dsc_emp_rsvp				= $this->rspart[0][13];
					}					
				}		
				$foneok = is_null($w_foneinter);
				if ($foneok == true) {
					$w_foneinter = '';
				}	
				$sqlUsu = "								                                                                                             
				SELECT                                                                                                          
					usuario_id,                                                                                                    
					usuario_nome                                                                                                   
				FROM                                                                                                            
					usuarios_rsvp                                                                                                  
					WHERE                                                                                                          
					usuario_id = ".$this->Db->qstr($vp_usuario)."                                                                                 
				ORDER BY                                                                                                        
					usuario_id                                                                                                     
				";		                                                                                                            
				 
      $nm_select = $sqlUsu; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsusu = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsusu[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsusu = false;
          $this->rsusu_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsusu[0][0])) {									                                                                            
					$w_usurelDsc = $this->rsusu[0][1];                                                                                  
				} else {                                                                                                        
					$w_usurelDsc = "";				                                                                                         
				}		                                                                                                             
				switch($w_tra_tipotransfer) {                                                                                      
					case 'A':                                                                                                      
						$w_tra_tipotransfer = 'AEREO';  		                                                                               
						break;                                                                                                        
					case 'L':                                                                                                      
						$w_tra_tipotransfer	= 'LOCAL';                                                                                   
						break;                                                                                                        
					case 'P':                                                                                                      
						$w_tra_tipotransfer	= 'PROPRIO';                                                                                 
						break;	                                                                                                       
				}                                                                                                              
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)."                                                                                 
				ORDER BY                                                                                                        
					evento_id         					
				";		                                                                                                            
				 
      $nm_select = $sqlEve; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rseve = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rseve[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rseve = false;
          $this->rseve_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rseve[0][0])) {									                                                                            
					$w_eventoDsc = $this->rseve[0][1];                                                                                  
				} else {                                                                                                        
					$w_eventoDsc = "";				                                                                                         
				}		                                                                                                           
				$sqlPgt = "								                                                                                             
				SELECT                                                                                                          
					COD_PAGAMENTOS,
					DES_PAGAMENTOS
				FROM                                                                                                            
					pagamentos_rsvp
				WHERE                                                                                                           
					COD_PAGAMENTOS = ".$this->Db->qstr($w_hosp_pagamentos)."                                                                                 
				ORDER BY                                                                                                        
					COD_PAGAMENTOS
				";		                                                                                                            
				 
      $nm_select = $sqlPgt; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspgt = false;
          $this->rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $this->rspgt[0][1];                                                                                  
				} else {                                                                                                        
					$w_pagtoDsc = "";				                                                                                         
				}		
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = ".$this->Db->qstr($w_tra_cia_ida)."                                                                                 
				ORDER BY                                                                                                        
					cia_id
				";		                                                                                                            
				 
      $nm_select = $sqlCia; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscia = false;
          $this->rscia_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscia[0][0])) {									                                                                            
					$w_ciaida = $this->rscia[0][1];                                                                                  
				} else {                                                                                                        
					$w_ciaida = "";				                                                                                         
				}		
				$sqlCia = "								                                                                                             
				SELECT                                                                                                          
					cia_id,
					cia_nome
				FROM                                                                                                            
					tbl_cia_aereas
				WHERE                                                                                                           
					cia_id = ".$this->Db->qstr($w_tra_cia_volta)."                                                                                 
				ORDER BY                                                                                                        
					cia_id
				";		                                                                                                            
				 
      $nm_select = $sqlCia; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscia = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscia[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscia = false;
          $this->rscia_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscia[0][0])) {									                                                                            
					$w_ciavolta = $this->rscia[0][1];                                                                                  
				} else {                                                                                                        
					$w_ciavolta = "";				                                                                                         
				}					
				$sqlAco = "								                                                                                             
				SELECT                                                                                                          
					acomodacao_id,
					acomodacao_desc
				FROM                                                                                                            
					tbl_acomodacoes
				WHERE                                                                                                           
					acomodacao_id = ".$this->Db->qstr($w_hosp_acomodacao)."                                                                                 
				ORDER BY                                                                                                        
					acomodacao_id
				";		                                                                                                            
				 
      $nm_select = $sqlAco; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaco = false;
          $this->rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsaco[0][0])) {									                                                                            
					$w_acomodacao = $this->rsaco[0][1];                                                                                  
				} else {                                                                                                        
					$w_acomodacao = "";				                                                                                         
				}					
				$sqlCat = "								                                                                                             
				SELECT                                                                                                          
					acomod_id,
					acomod_dsc
				FROM                                                                                                            
					tbl_categ_acomod
				WHERE                                                                                                           
					acomod_id = ".$this->Db->qstr($w_hosp_categoria)."                                                                                 
				ORDER BY                                                                                                        
					acomod_id
				";		                                                                                                            
				 
      $nm_select = $sqlCat; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscat = false;
          $this->rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscat[0][0])) {									                                                                            
					$w_categoria = $this->rscat[0][1];                                                                                  
				} else {                                                                                                        
					$w_categoria = "";				                                                                                         
				}					
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($w_part_id_evento_publico)."                                                                                 
				ORDER BY                                                                                                        
					publico_id
				";		                                                                                                            
				 
      $nm_select = $sqlPub; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspub = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspub[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspub = false;
          $this->rspub_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspub[0][0])) {									                                                                            
					$w_publico = $this->rspub[0][1];                                                                                  
				} else {                                                                                                        
					$w_publico = "";				                                                                                         
				}
				$sqlHot = "								                                                                                             
				SELECT                                                                                                          
					hotel_id,
					hotel_fantasia
				FROM                                                                                                            
					tbl_hoteis
				WHERE                                                                                                           
					hotel_id = ".$this->Db->qstr($w_hosp_id_hotel)."                                                                                 
				ORDER BY                                                                                                        
					hotel_id
				";		                                                                                                            
				 
      $nm_select = $sqlHot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshot = false;
          $this->rshot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshot[0][0])) {									                                                                            
					$w_hotel_dsc = $this->rshot[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc = "";				                                                                                         
				}					
					
				if ($w_hosp_early_chkin == 'Y') {
					$w_hosp_early_chkin = 'SIM';
				} else {
					$w_hosp_early_chkin = 'ABERTO';
				}
				if ($w_hosp_late_chkout == 'Y') {
					$w_hosp_late_chkout = 'SIM';
				} else {	
					$w_hosp_late_chkout = 'ABERTO';
				}					
				$sqlanot = "
				SELECT
					ant_evento_id,
					ant_cpf_participante,
					ant_dsc
				FROM
					anotacoes_rsvp
				WHERE
					ant_evento_id = ".$this->Db->qstr($vp_evento)." 
				AND
					ant_cpf_participante = ".$this->Db->qstr($w_hosp_cpf_participante)." 
				ORDER BY
					ant_evento_id, ant_cpf_participante					
				";
				 
      $nm_select = $sqlanot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsanot = false;
          $this->rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsanot[0][0])) {
					$w_anotacao = $this->rsanot[0][2];
				} else {
					$w_anotacao = '';
				}	
				$w_acompanhado = "";
				if ($w_tipopess  == 'ACOMPANHANTE') {						
					$sqlAcm = "								                                                                                             
					SELECT                                                                                                          
					part_cpf,
					part_cpf_mestre,
					part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf,part_id_evento
					";		                                                                                                            
					 
      $nm_select = $sqlAcm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspacm = false;
          $this->rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $this->rspacm[0][1];                                                                                
						$sqlCPFm = "								                                                                                             
						SELECT                                                                                                          
							part_cpf,
							nome_pessoa,
							part_id_evento
						FROM                                                                                                            
							participantes_rsvp
						WHERE                                                                                                           
							part_cpf = ".$this->Db->qstr($w_cpf_mestre)."                                                                                 
						ORDER BY                                                                                                        
						part_cpf,part_id_evento
						";		                                                                                                            
						 
      $nm_select = $sqlCPFm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspcpf = false;
          $this->rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($this->rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $this->rspcpf[0][1]; 					
						} else {                                                                                                        
							$w_acompanhado = "";				                                                                                         
						}					
					}	
				}					
				     				
				if ($w_hosp_acmq_01 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_01		= $this->rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_acmq_rg_01		= $this->rsplhac[0][3];
						$w_acmq_docest_01	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_02 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_02		= $this->rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_acmq_rg_02		= $this->rsplhac[0][3];
						$w_acmq_docest_02	= $this->rsplhac[0][4];				
					}
				}
								
				if ($w_hosp_acmq_03 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_03		= $this->rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_acmq_rg_03		= $this->rsplhac[0][3];
						$w_acmq_docest_03	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_04 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_04		= $this->rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_acmq_rg_04		= $this->rsplhac[0][3];
						$w_acmq_docest_04	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_01	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_01		= $this->rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_pamq_rg_01		= $this->rsplhac[0][3];
						$w_pamq_docest_01	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_02	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_02		= $this->rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_02	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_03	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_03		= $this->rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_pamq_rg_03		= $this->rsplhac[0][3];
						$w_pamq_docest_03	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_04	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_04		= $this->rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_04	= $this->rsplhac[0][4];				
					}										
				}	
				
				$sqlnoinc = "								                                                                                             
				SELECT                                                                                                          
					cpf,						
					cod_evento
				FROM                                                                                                            
					roomlist_rsvp_r
				WHERE                                                                                                           
					cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
				AND 
					cod_evento = ".$this->Db->qstr($w_hosp_id_evento)."
				AND
					id_usuario_relato = ".$this->Db->qstr($vp_usuario)."
				AND
					cod_hotel = ".$this->Db->qstr($w_hosp_id_hotel)."
				ORDER BY                                                                                                        
					cpf
				";
				 
      $nm_select = $sqlnoinc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsnoinc = false;
          $this->rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsnoinc[0][0])) {															
					$inclui = 'N';
				} else {
					$inclui = 'S';
				}
				
				
				if ($inclui == 'S' && $w_nome <> '') {					
					$sqli = "
					INSERT INTO                                                                                                     
						roomlist_rsvp_r		                                                                                                
						(hospede,					
						cpf,					
						passaporte,			    
						RG,					    
						data_nasc,			    
						ddd_clelular,			
						celular,				
						e_mail,				    
						acom_mesmo_quarto,      
						aqtd_mesmo_quarto,	    
						part_mesmo_quarto,	    
						pqtd_mesmo_quarto,	    
						cod_publico,			
						publico_dsc,			
						cod_hotel,			    
						hotel_dsc,			    
						cod_acomodacao,		    
						acomodacao_dsc,		    
						cod_categoria,		    
						categoria_dsc,		    
						voo_ida,				
						cod_cia_ida,			
						cia_dsc_ida,			
						dt_checkin, 			
						hr_transferin,		    
						voo_volta,			    
						cod_cia_volta,		    
						cia_dsc_volta,		    
						dt_checkout,			
						hr_transferout,		    
						intervalo_trout,		
						early_checkin,		    
						late_checkout,		    
						cod_forma_pgto,		    
						forma_pgto,			    
						observacoes,			
						pacote_dsc,			    
						cod_evento,			    
						evento_dsc,			    
						id_usuario_relato,	    
						usuario_relato_dsc,	    
						tipo_transfer,
						tipo_pessoa,
						acompanhado,
						amq_nome_01,
						amq_nome_02,
						amq_nome_03,
						amq_nome_04,
						amq_cpf_01,
						amq_cpf_02,
						amq_cpf_03,
						amq_cpf_04,
						amq_rg_01,
						amq_rg_02,
						amq_rg_03,
						amq_rg_04,
						amq_docest_01,
						amq_docest_02,
						amq_docest_03,
						amq_docest_04,
						amq_dtnasc_01,
						amq_dtnasc_02,
						amq_dtnasc_03,
						amq_dtnasc_04,
						pmq_nome_01,
						pmq_nome_02,
						pmq_nome_03,
						pmq_nome_04,
						pmq_cpf_01,
						pmq_cpf_02,
						pmq_cpf_03,
						pmq_cpf_04,
						pmq_rg_01,
						pmq_rg_02,
						pmq_rg_03,
						pmq_rg_04,
						pmq_docest_01,
						pmq_docest_02,
						pmq_docest_03,
						pmq_docest_04,
						pmq_dtnasc_01,
						pmq_dtnasc_02,
						pmq_dtnasc_03,
						pmq_dtnasc_04,
						empresa,
						grupo,
						cargo,
						telefone_internacional,	
						anotacoes,
						dsc_empresa_rsvp)	                                                                                                 
					VALUES 
						(".$this->Db->qstr($w_nome).",					              
						".$this->Db->qstr($w_hosp_cpf_participante).",  
						".$this->Db->qstr($w_part_passaporte).",        
						".$this->Db->qstr($w_part_rg).", 				           
						".$this->Db->qstr($w_part_dt_nasc).",		         
						".$this->Db->qstr($w_part_ddd_celular_01).",    
						".$this->Db->qstr($w_part_celeular_01).",		     
						".$this->Db->qstr($w_part_email).",			          
						".$this->Db->qstr($w_hosp_acompanhante).",	     
						".$this->Db->qstr($w_aqtd_mesquart).", 		       
						".$this->Db->qstr($w_hosp_part_acomp).",  	     
						".$this->Db->qstr($w_pqtd_mesquart).",		        
						".$this->Db->qstr($w_part_id_evento_publico).", 
						".$this->Db->qstr($w_publico).",				            
						".$this->Db->qstr($w_hosp_id_hotel).",		        
						".$this->Db->qstr($w_hotel_dsc).",			           
						".$this->Db->qstr($w_hosp_acomodacao).",        
						".$this->Db->qstr($w_acomodacao).",			          
						".$this->Db->qstr($w_hosp_categoria).",  		     
						".$this->Db->qstr($w_categoria).",			           
						".$this->Db->qstr($w_tra_numvoo_ida).",         
						".$this->Db->qstr($w_tra_cia_ida).",            
						".$this->Db->qstr($w_ciaida).",				             
						".$this->Db->qstr($w_hosp_dt_checkin).",		      					
						".$this->Db->qstr($w_tra_hr_saida_ida).",	      					
						".$this->Db->qstr($w_tra_numvoo_volta).",       
						".$this->Db->qstr($w_tra_cia_volta).",		        
						".$this->Db->qstr($w_ciavolta).",				           
						".$this->Db->qstr($w_hosp_dt_checkout).",   	   
						".$this->Db->qstr($w_tra_hr_saida_volta).",     
						".$this->Db->qstr($w_tra_hrtransout).",         
						".$this->Db->qstr($w_hosp_early_chkin).",       
						".$this->Db->qstr($w_hosp_late_chkout).",       
						".$this->Db->qstr($w_hosp_pagamentos).",        
						".$this->Db->qstr($w_pagtoDsc).",				           
						".$this->Db->qstr($w_hosp_observacoes).",		     
						".$this->Db->qstr($w_hosp_dsc_pacote).",        
						".$this->Db->qstr($w_hosp_id_evento).",         
						".$this->Db->qstr($w_eventoDsc).",           
						".$this->Db->qstr($vp_usuario).",				           
						".$this->Db->qstr($w_usurelDsc).",           
						".$this->Db->qstr($w_tra_tipotransfer).",
						".$this->Db->qstr($w_tipopess).",
						".$this->Db->qstr($w_acompanhado).",
						".$this->Db->qstr($w_acmq_nome_01).",
						".$this->Db->qstr($w_acmq_nome_02).",
						".$this->Db->qstr($w_acmq_nome_03).",
						".$this->Db->qstr($w_acmq_nome_04).",
						".$this->Db->qstr($w_acmq_cpf_01).",
						".$this->Db->qstr($w_acmq_cpf_02).",
						".$this->Db->qstr($w_acmq_cpf_03).",
						".$this->Db->qstr($w_acmq_cpf_04).",
						".$this->Db->qstr($w_acmq_rg_01).",
						".$this->Db->qstr($w_acmq_rg_02).",
						".$this->Db->qstr($w_acmq_rg_03).",
						".$this->Db->qstr($w_acmq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_acmq_dtnasc_01).",
						".$this->Db->qstr($w_acmq_dtnasc_02).",
						".$this->Db->qstr($w_acmq_dtnasc_03).",
						".$this->Db->qstr($w_acmq_dtnasc_04).",
						".$this->Db->qstr($w_pamq_nome_01).",	
						".$this->Db->qstr($w_pamq_nome_02).",	
						".$this->Db->qstr($w_pamq_nome_03).",	
						".$this->Db->qstr($w_pamq_nome_04).",
						".$this->Db->qstr($w_pamq_cpf_01).",
						".$this->Db->qstr($w_pamq_cpf_02).",
						".$this->Db->qstr($w_pamq_cpf_03).",
						".$this->Db->qstr($w_pamq_cpf_04).",
						".$this->Db->qstr($w_pamq_rg_01).",
						".$this->Db->qstr($w_pamq_rg_02).",
						".$this->Db->qstr($w_pamq_rg_03).",
						".$this->Db->qstr($w_pamq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_pamq_dtnasc_01).",
						".$this->Db->qstr($w_pamq_dtnasc_02).",
						".$this->Db->qstr($w_pamq_dtnasc_03).",
						".$this->Db->qstr($wW_pamq_dtnasc_04).",
						".$this->Db->qstr($w_empresa).",
						".$this->Db->qstr($w_grupo).",
						".$this->Db->qstr($w_cargo).",
						".$this->Db->qstr($w_foneinter).",
						".$this->Db->qstr($w_anotacao).",
						".$this->Db->qstr($w_dsc_emp_rsvp).")
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
						
					$ret = 'ADICIONA OK';                                                                                           
				}	
			}
			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}		                                                                                                               
		return $ret;
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function PrepRoom3($vp_evento,$vp_usuario,$vp_tipoPessoa,$vp_nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  		
		
		date_default_timezone_set('America/Sao_Paulo');
		$_passa_part = false;                                                                                             
		$ret = 'ADICIONA ERRO';
		$valor_y = 'Y';			                                                                                        
		$valor_s = 'SIM';
		$valor_n = 'N';
		$valor_exclui = 'ANHANTE';
		
		$sqlMestre = "		
		SELECT
			hospedagem_rsvp.hosp_cpf_participante,
			hospedagem_rsvp.hosp_id_evento,			        
			hospedagem_rsvp.hosp_acompanhante,		        
			hospedagem_rsvp.hosp_part_acomp,     	        
			hospedagem_rsvp.hosp_id_hotel,			        
			hospedagem_rsvp.hosp_acomodacao,			    
			hospedagem_rsvp.hosp_categoria,  		        
			hospedagem_rsvp.hosp_dt_checkin,			    
			hospedagem_rsvp.hosp_dt_checkout,   		    
			hospedagem_rsvp.hosp_early_chkin,  		        
			hospedagem_rsvp.hosp_late_chkout, 		        
			hospedagem_rsvp.hosp_pagamentos, 		        
			hospedagem_rsvp.hosp_observacoes,		        
			hospedagem_rsvp.hosp_dsc_pacote, 				               
			hospedagem_rsvp.acmq_01,
			hospedagem_rsvp.acmq_02,
			hospedagem_rsvp.acmq_03,
			hospedagem_rsvp.acmq_04,
			hospedagem_rsvp.pamq_01,
			hospedagem_rsvp.pamq_02,
			hospedagem_rsvp.pamq_03,
			hospedagem_rsvp.pamq_04
		FROM
			hospedagem_rsvp
		WHERE
			hospedagem_rsvp.hosp_id_evento = ".$this->Db->qstr($vp_evento)."
		AND
			hospedagem_rsvp.hosp_ativo	= ".$this->Db->qstr($valor_y)." 
		AND 
			hospedagem_rsvp.hosp_status	= ".$this->Db->qstr($valor_y)."	
		AND
			hospedagem_rsvp.conta_roomlist= ".$this->Db->qstr($valor_s)."
		AND	
			hospedagem_rsvp.acmq_01 <> ".$this->Db->qstr($valor_exclui)."
		AND	
			hospedagem_rsvp.acmq_02 <> ".$this->Db->qstr($valor_exclui)."
		ORDER BY
			hospedagem_rsvp.hosp_cpf_participante			
		";
		$_passa_part = true;
		 
      $nm_select = $sqlMestre; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsm = false;
          $this->rsm_erro = $this->Db->ErrorMsg();
      } 
	                                                                                      
		if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
                                                                                    
		$reg_mestre = sizeof($this->rsm );		                                                                                    
		if ($reg_mestre > 0) {				                                                                                        
			for ($i=0;$i<$reg_mestre;++$i) {				
				$w_acmq_nome_01		= '';
				$w_acmq_cpf_01		= '';
				$w_acmq_dtnasc_01 	= '';
				$w_acmq_rg_01		= '';
				$w_acmq_docest_01	= '';
				$w_acmq_nome_02		= '';
				$w_acmq_cpf_02		= '';
				$w_acmq_rg_02		= '';
				$w_acmq_docest_02	= '';
				$w_acmq_dtnasc_02	= '';
				$w_acmq_nome_03		= '';
				$w_acmq_cpf_03		= '';
				$w_acmq_rg_03		= '';
				$w_acmq_docest_03	= '';
				$w_acmq_dtnasc_03	= '';
				$w_acmq_nome_04		= '';
				$w_acmq_cpf_04		= '';
				$w_acmq_rg_04		= '';
				$w_acmq_docest_04	= '';
				$w_acmq_dtnasc_04	= '';				
				
				$w_pamq_nome_01		= '';
				$w_pamq_cpf_01		= '';
				$w_pamq_dtnasc_01 	= '';
				$w_pamq_rg_01		= '';
				$w_pamq_docest_01	= '';
				$w_pamq_nome_02		= '';
				$w_pamq_cpf_02		= '';
				$w_pamq_rg_02		= '';
				$w_pamq_docest_02	= '';
				$w_pamq_dtnasc_02	= '';
				$w_pamq_nome_03		= '';
				$w_pamq_cpf_03		= '';
				$w_pamq_rg_03		= '';
				$w_pamq_docest_03	= '';
				$w_pamq_dtnasc_03	= '';
				$w_pamq_nome_04		= '';
				$w_pamq_cpf_04		= '';
				$w_pamq_rg_04		= '';
				$w_pamq_docest_04	= '';
				$w_pamq_dtnasc_04	= '';					
				
				$w_nome	= '';
				$w_part_passaporte = '';      	     				
				$w_part_rg = '';           
				$w_part_dt_nasc = '0000-00-00';   				       	
				$w_part_ddd_celular_01 = '';  	      				
				$w_part_celeular_01 = '';     	 
				$w_part_email = '';           					     
				$w_part_id_evento_publico = '';				
				$w_aqtd_mesquart = '0';   
				$w_pqtd_mesquart = '0';		            
				$w_publico = '';				                
				$w_hotel_dsc = '';			               
				$w_acomodacao = '';			              
				$w_categoria = '';			               
				$w_ciaida = '';			                 
				$w_ciavolta = '';				               
				$w_pagtoDsc = '';				               
				$w_eventoDsc = '';                  				
				$w_usurelDsc = '';                 
				$w_tipopess = '';                  
				$w_acompanhado = '';               
				 				
				$w_hosp_cpf_participante	= $this->rsm[$i][0];		     					                 
				$w_hosp_id_evento		    = $this->rsm[$i][1];               
				$w_hosp_acompanhante	    = $this->rsm[$i][2];            
				$w_hosp_part_acomp     	    = $this->rsm[$i][3];            
				$w_hosp_id_hotel		    = $this->rsm[$i][4];                  
				$w_hosp_acomodacao		 	= $this->rsm[$i][5];              
				$w_hosp_categoria  		    = $this->rsm[$i][6];              
				$w_hosp_dt_checkin		 	= $this->rsm[$i][7];            	   		
				$w_hosp_dt_checkout   	 	= $this->rsm[$i][8];           
				$w_hosp_early_chkin  	    = $this->rsm[$i][9];           
				$w_hosp_late_chkout 	    = $this->rsm[$i][10];           
				$w_hosp_pagamentos 		    = $this->rsm[$i][11];            
				$w_hosp_observacoes		    = $this->rsm[$i][12];             
				$w_hosp_dsc_pacote          = $this->rsm[$i][13];               
				$w_hosp_acmq_01				= $this->rsm[$i][14];	
				$w_hosp_acmq_02				= $this->rsm[$i][15];    
				$w_hosp_acmq_03				= $this->rsm[$i][16];    
				$w_hosp_acmq_04				= $this->rsm[$i][17];    
				$w_hosp_pamq_01				= $this->rsm[$i][18];    
				$w_hosp_pamq_02				= $this->rsm[$i][19];    
				$w_hosp_pamq_03				= $this->rsm[$i][20];    
				$w_hosp_pamq_04				= $this->rsm[$i][21];	  							
			
				$w_tra_numvoo_ida	        = '';	
				$w_tra_cia_ida   		    = '';	
				$w_tra_hr_saida_ida         = '';	
				$w_tra_numvoo_volta         = '';	
				$w_tra_cia_volta		    = '';	
				$w_tra_hr_saida_volta 	  	= '';   
				$w_tra_hrtransout		    = '';	
				$w_tra_tipotransfer			= '';   
				$f_tra_direcao				= '';	
				$f_tra_id_hotel				= '';   
				
				$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						nome_pessoa,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,						
						part_id_evento_publico,
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."	
					ORDER BY                                                                                                        
						part_cpf
				";
				 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspart[0][0])) {											
					$w_nome				   		= $this->rspart[0][0];			  	             
					$w_part_passaporte     		= $this->rspart[0][1];    	     
					$w_part_rg             		= $this->rspart[0][2];    	
					$w_part_dt_nasc        		= $this->rspart[0][3];  	
					$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
					$w_part_celeular_01      	= $this->rspart[0][5]; 
					$w_part_email            	= $this->rspart[0][6];    
					$w_part_id_evento_publico	= $this->rspart[0][7];   	
					$w_empresa					= $this->rspart[0][9]; 
					$w_grupo					= $this->rspart[0][10]; 
					$w_cargo					= $this->rspart[0][11]; 
					$w_tipopess = 'PARTICIPANTE';		
					$w_foneinter				= $this->rspart[0][12];
					$w_dsc_emp_rsvp				= $this->rspart[0][13];
				} else {
					$sqlpart = "								                                                                                             
					SELECT                                                                                                          
						part_nome,
						part_passaporte,
						part_rg,
						part_dt_nasc,
						part_ddd_celular_01,
						part_celeular_01,
						part_email,	
						part_id_evento_publico					
						part_validade_pass,
						part_empresa,
						part_grupo,
						part_cargo,
						part_fone_internacional,
						dsc_empresa_rsvp
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					AND
						part_id_evento = ".$this->Db->qstr($w_hosp_id_evento)."
					AND
						part_substituido = ".$this->Db->qstr($valor_n)."		
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlpart; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspart = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspart[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspart = false;
          $this->rspart_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspart[0][0])) {											
						$w_nome				   		= $this->rspart[0][0];			  	             
						$w_part_passaporte     		= $this->rspart[0][1];    	     
						$w_part_rg             		= $this->rspart[0][2];    	
						$w_part_dt_nasc        		= $this->rspart[0][3];  	
						$w_part_ddd_celular_01 		= $this->rspart[0][4];  	      
						$w_part_celeular_01      	= $this->rspart[0][5]; 
						$w_part_email            	= $this->rspart[0][6];    
						$w_part_id_evento_publico	= $this->rspart[0][7]; 
						$w_empresa					= $this->rspart[0][9];
						$w_grupo					= $this->rspart[0][10]; 
						$w_cargo					= $this->rspart[0][11]; 
						$w_tipopess = 'ACOMPANHANTE';			
						$w_foneinter				= $this->rspart[0][12];
						$w_dsc_emp_rsvp				= $this->rspart[0][13];
					}	
				}	
				$foneok = is_null($w_foneinter);
				if ($foneok == true) {
					$w_foneinter = '';
				}	
				$sqlUsu = "								                                                                                             
				SELECT                                                                                                          
					usuario_id,                                                                                                    
					usuario_nome                                                                                                   
				FROM                                                                                                            
					usuarios_rsvp                                                                                                  
					WHERE                                                                                                          
					usuario_id = ".$this->Db->qstr($vp_usuario)."                                                                                 
				ORDER BY                                                                                                        
					usuario_id                                                                                                     
				";		                                                                                                            
				 
      $nm_select = $sqlUsu; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsusu = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsusu[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsusu = false;
          $this->rsusu_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsusu[0][0])) {									                                                                            
					$w_usurelDsc = $this->rsusu[0][1];                                                                                  
				} else {                                                                                                        
					$w_usurelDsc = "";				                                                                                         
				}		                                                                                                             
				$sqlEve = "								                                                                                             
				SELECT                                                                                                          
					evento_id,                                                                                                     
					evento_nome				                                                                                                
				FROM                                                                                                            
					eventos_rsvp                                                                                                   
				WHERE                                                                                                           
					evento_id = ".$this->Db->qstr($vp_evento)."                                                                                 
				ORDER BY                                                                                                        
					evento_id         					
				";		                                                                                                            
				 
      $nm_select = $sqlEve; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rseve = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rseve[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rseve = false;
          $this->rseve_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rseve[0][0])) {									                                                                            
					$w_eventoDsc = $this->rseve[0][1];                                                                                  
				} else {                                                                                                        
					$w_eventoDsc = "";				                                                                                         
				}		                                                                                                           
				$sqlPgt = "								                                                                                             
				SELECT                                                                                                          
					COD_PAGAMENTOS,
					DES_PAGAMENTOS
				FROM                                                                                                            
					pagamentos_rsvp
				WHERE                                                                                                           
					COD_PAGAMENTOS = ".$this->Db->qstr($w_hosp_pagamentos)."                                                                                 
				ORDER BY                                                                                                        
					COD_PAGAMENTOS
				";		                                                                                                            
				 
      $nm_select = $sqlPgt; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspgt = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspgt[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspgt = false;
          $this->rspgt_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspgt[0][0])) {									                                                                            
					$w_pagtoDsc = $this->rspgt[0][1];                                                                                  
				} else {                                                                                                        
					$w_pagtoDsc = "";				                                                                                         
				}		
				$sqlAco = "								                                                                                             
				SELECT                                                                                                          
					acomodacao_id,
					acomodacao_desc
				FROM                                                                                                            
					tbl_acomodacoes
				WHERE                                                                                                           
					acomodacao_id = ".$this->Db->qstr($w_hosp_acomodacao)."                                                                                 
				ORDER BY                                                                                                        
					acomodacao_id
				";		                                                                                                            
				 
      $nm_select = $sqlAco; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaco = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaco[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaco = false;
          $this->rsaco_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsaco[0][0])) {									                                                                            
					$w_acomodacao = $this->rsaco[0][1];                                                                                  
				} else {                                                                                                        
					$w_acomodacao = "";				                                                                                         
				}					
				$sqlCat = "								                                                                                             
				SELECT                                                                                                          
					acomod_id,
					acomod_dsc
				FROM                                                                                                            
					tbl_categ_acomod
				WHERE                                                                                                           
					acomod_id = ".$this->Db->qstr($w_hosp_categoria)."                                                                                 
				ORDER BY                                                                                                        
					acomod_id
				";		                                                                                                            
				 
      $nm_select = $sqlCat; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscat = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscat[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscat = false;
          $this->rscat_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rscat[0][0])) {									                                                                            
					$w_categoria = $this->rscat[0][1];                                                                                  
				} else {                                                                                                        
					$w_categoria = "";				                                                                                         
				}					
				$sqlPub = "								                                                                                             
				SELECT                                                                                                          
					publico_id,
					publico_nome
				FROM                                                                                                            
					publico_rsvp
				WHERE                                                                                                           
					publico_id = ".$this->Db->qstr($w_part_id_evento_publico)."                                                                                 
				ORDER BY                                                                                                        
					publico_id
				";		                                                                                                            
				 
      $nm_select = $sqlPub; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspub = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspub[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspub = false;
          $this->rspub_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rspub[0][0])) {									                                                                            
					$w_publico = $this->rspub[0][1];                                                                                  
				} else {                                                                                                        
					$w_publico = "";				                                                                                         
				}
				$sqlHot = "								                                                                                             
				SELECT                                                                                                          
					hotel_id,
					hotel_fantasia
				FROM                                                                                                            
					tbl_hoteis
				WHERE                                                                                                           
					hotel_id = ".$this->Db->qstr($w_hosp_id_hotel)."                                                                                 
				ORDER BY                                                                                                        
					hotel_id
				";		                                                                                                            
				 
      $nm_select = $sqlHot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshot = false;
          $this->rshot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rshot[0][0])) {									                                                                            
					$w_hotel_dsc = $this->rshot[0][1];                                                                                  
				} else {                                                                                                        
					$w_hotel_dsc = "";				                                                                                         
				}					
					
				if ($w_hosp_early_chkin == 'Y') {
					$w_hosp_early_chkin = 'SIM';
				} else {
					$w_hosp_early_chkin = 'ABERTO';
				}
				if ($w_hosp_late_chkout == 'Y') {
					$w_hosp_late_chkout = 'SIM';
				} else {	
					$w_hosp_late_chkout = 'ABERTO';
				}					
				$sqlanot = "
				SELECT
					ant_evento_id,
					ant_cpf_participante,
					ant_dsc
				FROM
					anotacoes_rsvp
				WHERE
					ant_evento_id = ".$this->Db->qstr($vp_evento)." 
				AND
					ant_cpf_participante = ".$this->Db->qstr($w_hosp_cpf_participante)." 
				ORDER BY
					ant_evento_id, ant_cpf_participante					
				";
				 
      $nm_select = $sqlanot; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsanot = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsanot[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsanot = false;
          $this->rsanot_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsanot[0][0])) {
					$w_anotacao = $this->rsanot[0][2];
				} else {
					$w_anotacao = '';
				}	
				
				$w_acompanhado = "";
				if ($w_tipopess == 'PARTICIPANTE') { 	 					
					$sqlAcm = "								                                                                                             
					SELECT                                                                                                          
					part_cpf,
					part_cpf_mestre,
					part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf,part_id_evento
					";		                                                                                                            
					 
      $nm_select = $sqlAcm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspacm = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspacm[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspacm = false;
          $this->rspacm_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rspacm[0][0])) {									                                                                            
						$w_cpf_mestre = $this->rspacm[0][1];                                                                                
						$sqlCPFm = "								                                                                                             
						SELECT                                                                                                          
							part_cpf,
							nome_pessoa,
							part_id_evento
						FROM                                                                                                            
							participantes_rsvp
						WHERE                                                                                                           
							part_cpf = ".$this->Db->qstr($w_cpf_mestre)."                                                                                 
						ORDER BY                                                                                                        
						part_cpf,part_id_evento
						";		                                                                                                            
						 
      $nm_select = $sqlCPFm; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspcpf = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspcpf[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspcpf = false;
          $this->rspcpf_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
						if (isset($this->rspcpf[0][0])) {									                                                                            										
							$w_acompanhado = $this->rspcpf[0][1]; 					
						} else {                                                                                                        
							$w_acompanhado = "";				                                                                                         
						}					
					}	
				}				
								
				if ($w_hosp_acmq_01 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_01		= $this->rsplhac[0][1];	
						$w_acmq_cpf_01		= $w_hosp_acmq_01;
						$w_acmq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_acmq_rg_01		= $this->rsplhac[0][3];
						$w_acmq_docest_01	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_02 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_02		= $this->rsplhac[0][1];	
						$w_acmq_cpf_02		= $w_hosp_acmq_02;
						$w_acmq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_acmq_rg_02		= $this->rsplhac[0][3];
						$w_acmq_docest_02	= $this->rsplhac[0][4];				
					}
				}
								
				if ($w_hosp_acmq_03 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_03		= $this->rsplhac[0][1];	
						$w_acmq_cpf_03		= $w_hosp_acmq_03;
						$w_acmq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_acmq_rg_03		= $this->rsplhac[0][3];
						$w_acmq_docest_03	= $this->rsplhac[0][4];				
					}
				}
				
				if ($w_hosp_acmq_04 <> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						part_nome,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						acompanhantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_acmq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_acmq_nome_04		= $this->rsplhac[0][1];	
						$w_acmq_cpf_04		= $w_hosp_acmq_04;
						$w_acmq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_acmq_rg_04		= $this->rsplhac[0][3];
						$w_acmq_docest_04	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_01	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_01)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_01		= $this->rsplhac[0][1];	
						$w_pamq_cpf_01		= $w_hosp_pamq_01;
						$w_pamq_dtnasc_01 	= $this->rsplhac[0][2];
						$w_pamq_rg_01		= $this->rsplhac[0][3];
						$w_pamq_docest_01	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_02	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_02)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_02		= $this->rsplhac[0][1];	
						$w_pamq_cpf_02		= $w_hosp_pamq_02;
						$w_pamq_dtnasc_02 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_02	= $this->rsplhac[0][4];				
					}										
				}
				
				if ($w_hosp_pamq_03	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_03)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_03		= $this->rsplhac[0][1];	
						$w_pamq_cpf_03		= $w_hosp_pamq_03;
						$w_pamq_dtnasc_03 	= $this->rsplhac[0][2];
						$w_pamq_rg_03		= $this->rsplhac[0][3];
						$w_pamq_docest_03	= $this->rsplhac[0][4];				
					}					
				}
				
				if ($w_hosp_pamq_04	<> '') {
					$sqlhac = "								                                                                                             
					SELECT                                                                                                          
						part_cpf,						
						nome_pessoa,
						part_dt_nasc,
						part_rg,
						part_passaporte,
						part_validade_pass,
						part_id_evento
					FROM                                                                                                            
						participantes_rsvp
					WHERE                                                                                                           
						part_cpf = ".$this->Db->qstr($w_hosp_pamq_04)."                                                                                 
					ORDER BY                                                                                                        
						part_cpf
					";
					 
      $nm_select = $sqlhac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsplhac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsplhac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsplhac = false;
          $this->rsplhac_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
					if (isset($this->rsplhac[0][0])) {											
						$w_pamq_nome_04		= $this->rsplhac[0][1];	
						$w_pamq_cpf_04		= $w_hosp_pamq_04;
						$w_pamq_dtnasc_04 	= $this->rsplhac[0][2];
						$w_pamq_rg_04		= $this->rsplhac[0][3];
						$w_pamq_docest_04	= $this->rsplhac[0][4];				
					}										
				}	
				$sqlnoinc = "								                                                                                             
				SELECT                                                                                                          
					cpf,						
					cod_evento
				FROM                                                                                                            
					roomlist_rsvp_r
				WHERE                                                                                                           
					cpf = ".$this->Db->qstr($w_hosp_cpf_participante)."                                                                                 
				AND 
					cod_evento = ".$this->Db->qstr($w_hosp_id_evento)."
				AND
					id_usuario_relato = ".$this->Db->qstr($vp_usuario)."	
				AND
					cod_hotel = ".$this->Db->qstr($w_hosp_id_hotel)."	
				ORDER BY                                                                                                        
					cpf
				";
				 
      $nm_select = $sqlnoinc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsnoinc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsnoinc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsnoinc = false;
          $this->rsnoinc_erro = $this->Db->ErrorMsg();
      } 
				                                                                                   
				if (isset($this->rsnoinc[0][0])) {															
					$inclui = 'N';
				} else {
					$inclui = 'S';
				}
				if ($inclui == 'S' && $w_nome <> '') {	
					$sqli = "
					INSERT INTO                                                                                                     
						roomlist_rsvp_r		                                                                                                
						(hospede,					
						cpf,					
						passaporte,			    
						RG,					    
						data_nasc,			    
						ddd_clelular,			
						celular,				
						e_mail,				    
						acom_mesmo_quarto,      
						aqtd_mesmo_quarto,	    
						part_mesmo_quarto,	    
						pqtd_mesmo_quarto,	    
						cod_publico,			
						publico_dsc,			
						cod_hotel,			    
						hotel_dsc,			    
						cod_acomodacao,		    
						acomodacao_dsc,		    
						cod_categoria,		    
						categoria_dsc,		    
						voo_ida,				
						cod_cia_ida,			
						cia_dsc_ida,			
						dt_checkin, 			
						hr_transferin,		    
						voo_volta,			    
						cod_cia_volta,		    
						cia_dsc_volta,		    
						dt_checkout,			
						hr_transferout,		    
						intervalo_trout,		
						early_checkin,		    
						late_checkout,		    
						cod_forma_pgto,		    
						forma_pgto,			    
						observacoes,			
						pacote_dsc,			    
						cod_evento,			    
						evento_dsc,			    
						id_usuario_relato,	    
						usuario_relato_dsc,	    
						tipo_transfer,
						tipo_pessoa,
						acompanhado,
						amq_nome_01,
						amq_nome_02,
						amq_nome_03,
						amq_nome_04,
						amq_cpf_01,
						amq_cpf_02,
						amq_cpf_03,
						amq_cpf_04,
						amq_rg_01,
						amq_rg_02,
						amq_rg_03,
						amq_rg_04,
						amq_docest_01,
						amq_docest_02,
						amq_docest_03,
						amq_docest_04,
						amq_dtnasc_01,
						amq_dtnasc_02,
						amq_dtnasc_03,
						amq_dtnasc_04,
						pmq_nome_01,
						pmq_nome_02,
						pmq_nome_03,
						pmq_nome_04,
						pmq_cpf_01,
						pmq_cpf_02,
						pmq_cpf_03,
						pmq_cpf_04,
						pmq_rg_01,
						pmq_rg_02,
						pmq_rg_03,
						pmq_rg_04,
						pmq_docest_01,
						pmq_docest_02,
						pmq_docest_03,
						pmq_docest_04,
						pmq_dtnasc_01,
						pmq_dtnasc_02,
						pmq_dtnasc_03,
						pmq_dtnasc_04,
						empresa,
						grupo,
						cargo,
						telefone_internacional,	
						anotacoes,
						dsc_empresa_rsvp)	                                                                                                 
					VALUES 
						(".$this->Db->qstr($w_nome).",					              
						".$this->Db->qstr($w_hosp_cpf_participante).",  
						".$this->Db->qstr($w_part_passaporte).",        
						".$this->Db->qstr($w_part_rg).", 				           
						".$this->Db->qstr($w_part_dt_nasc).",		         
						".$this->Db->qstr($w_part_ddd_celular_01).",    
						".$this->Db->qstr($w_part_celeular_01).",		     
						".$this->Db->qstr($w_part_email).",			          
						".$this->Db->qstr($w_hosp_acompanhante).",	     
						".$this->Db->qstr($w_aqtd_mesquart).", 		       
						".$this->Db->qstr($w_hosp_part_acomp).",  	     
						".$this->Db->qstr($w_pqtd_mesquart).",		        
						".$this->Db->qstr($w_part_id_evento_publico).", 
						".$this->Db->qstr($w_publico).",				            
						".$this->Db->qstr($w_hosp_id_hotel).",		        
						".$this->Db->qstr($w_hotel_dsc).",			           
						".$this->Db->qstr($w_hosp_acomodacao).",        
						".$this->Db->qstr($w_acomodacao).",			          
						".$this->Db->qstr($w_hosp_categoria).",  		     
						".$this->Db->qstr($w_categoria).",			           
						".$this->Db->qstr($w_tra_numvoo_ida).",         
						".$this->Db->qstr($w_tra_cia_ida).",            
						".$this->Db->qstr($w_ciaida).",				             
						".$this->Db->qstr($w_hosp_dt_checkin).",		      					
						".$this->Db->qstr($w_tra_hr_saida_ida).",	      					
						".$this->Db->qstr($w_tra_numvoo_volta).",       
						".$this->Db->qstr($w_tra_cia_volta).",		        
						".$this->Db->qstr($w_ciavolta).",				           
						".$this->Db->qstr($w_hosp_dt_checkout).",   	   
						".$this->Db->qstr($w_tra_hr_saida_volta).",     
						".$this->Db->qstr($w_tra_hrtransout).",         
						".$this->Db->qstr($w_hosp_early_chkin).",       
						".$this->Db->qstr($w_hosp_late_chkout).",       
						".$this->Db->qstr($w_hosp_pagamentos).",        
						".$this->Db->qstr($w_pagtoDsc).",				           
						".$this->Db->qstr($w_hosp_observacoes).",		     
						".$this->Db->qstr($w_hosp_dsc_pacote).",        
						".$this->Db->qstr($w_hosp_id_evento).",         
						".$this->Db->qstr($w_eventoDsc).",           
						".$this->Db->qstr($vp_usuario).",				           
						".$this->Db->qstr($w_usurelDsc).",           
						".$this->Db->qstr($w_tra_tipotransfer).",
						".$this->Db->qstr($w_tipopess).",
						".$this->Db->qstr($w_acompanhado).",
						".$this->Db->qstr($w_acmq_nome_01).",
						".$this->Db->qstr($w_acmq_nome_02).",
						".$this->Db->qstr($w_acmq_nome_03).",
						".$this->Db->qstr($w_acmq_nome_04).",
						".$this->Db->qstr($w_acmq_cpf_01).",
						".$this->Db->qstr($w_acmq_cpf_02).",
						".$this->Db->qstr($w_acmq_cpf_03).",
						".$this->Db->qstr($w_acmq_cpf_04).",
						".$this->Db->qstr($w_acmq_rg_01).",
						".$this->Db->qstr($w_acmq_rg_02).",
						".$this->Db->qstr($w_acmq_rg_03).",
						".$this->Db->qstr($w_acmq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_acmq_dtnasc_01).",
						".$this->Db->qstr($w_acmq_dtnasc_02).",
						".$this->Db->qstr($w_acmq_dtnasc_03).",
						".$this->Db->qstr($w_acmq_dtnasc_04).",
						".$this->Db->qstr($w_pamq_nome_01).",	
						".$this->Db->qstr($w_pamq_nome_02).",	
						".$this->Db->qstr($w_pamq_nome_03).",	
						".$this->Db->qstr($w_pamq_nome_04).",
						".$this->Db->qstr($w_pamq_cpf_01).",
						".$this->Db->qstr($w_pamq_cpf_02).",
						".$this->Db->qstr($w_pamq_cpf_03).",
						".$this->Db->qstr($w_pamq_cpf_04).",
						".$this->Db->qstr($w_pamq_rg_01).",
						".$this->Db->qstr($w_pamq_rg_02).",
						".$this->Db->qstr($w_pamq_rg_03).",
						".$this->Db->qstr($w_pamq_rg_04).",
						".$this->Db->qstr($w_pamq_docest_01).",
						".$this->Db->qstr($w_pamq_docest_02).",
						".$this->Db->qstr($w_pamq_docest_03).",
						".$this->Db->qstr($w_pamq_docest_04).",
						".$this->Db->qstr($w_pamq_dtnasc_01).",
						".$this->Db->qstr($w_pamq_dtnasc_02).",
						".$this->Db->qstr($w_pamq_dtnasc_03).",
						".$this->Db->qstr($w_pamq_dtnasc_04).",	
						".$this->Db->qstr($w_empresa).",
						".$this->Db->qstr($w_grupo).",
						".$this->Db->qstr($w_cargo).",
						".$this->Db->qstr($w_foneinter).",
						".$this->Db->qstr($w_anotacao).",
						".$this->Db->qstr($w_dsc_emp_rsvp).")
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
					
					$ret = 'ADICIONA OK';                                                                                           
				}	
			}
			
		} else {			                                                                                                       
			if ($_passa_part == false) {	                                                                                    
				$ret = 'ADICIONA ERRO';				                                                                                     
			} else {                                                                                                         
				$ret = 'ADICIONA OK';                                                                                           
			}	                                                                                                               
		}		                                                                                                               
		return $ret;
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function RetNivelUpd($nivel) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_roomlist_rsvp_r']['contr_erro'] = 'off';
}

}

?>
