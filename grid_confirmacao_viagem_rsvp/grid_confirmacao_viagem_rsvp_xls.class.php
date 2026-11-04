<?php

class grid_confirmacao_viagem_rsvp_xls
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
    return false;
}

   //---- 
   function monta_xls()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida']) {
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['opcao'] = "";
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
                   nm_limpa_str_grid_confirmacao_viagem_rsvp($cadapar[1]);
                   nm_protect_num_grid_confirmacao_viagem_rsvp($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_confirmacao_viagem_rsvp']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_confirmacao_viagem_rsvp($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $vg_cpf;
          nm_limpa_str_grid_confirmacao_viagem_rsvp($_SESSION["vg_cpf"]);
      }
      if (isset($vg_destinatario)) 
      {
          $_SESSION['vg_destinatario'] = $vg_destinatario;
          nm_limpa_str_grid_confirmacao_viagem_rsvp($_SESSION["vg_destinatario"]);
      }
      if (isset($vg_comcopia)) 
      {
          $_SESSION['vg_comcopia'] = $vg_comcopia;
          nm_limpa_str_grid_confirmacao_viagem_rsvp($_SESSION["vg_comcopia"]);
      }
      if (isset($vg_msg)) 
      {
          $_SESSION['vg_msg'] = $vg_msg;
          nm_limpa_str_grid_confirmacao_viagem_rsvp($_SESSION["vg_msg"]);
      }
      if (isset($vg_nome_evt)) 
      {
          $_SESSION['vg_nome_evt'] = $vg_nome_evt;
          nm_limpa_str_grid_confirmacao_viagem_rsvp($_SESSION["vg_nome_evt"]);
      }
      if (isset($vg_nome_pax)) 
      {
          $_SESSION['vg_nome_pax'] = $vg_nome_pax;
          nm_limpa_str_grid_confirmacao_viagem_rsvp($_SESSION["vg_nome_pax"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_confirmacao_viagem_rsvp($_SESSION["rsvp_global"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_confirmacao_viagem_rsvp($_SESSION["vg_usuario_id"]);
      }
      $this->Use_phpspreadsheet = (phpversion() >=  "7.3.9" && is_dir($this->Ini->path_third . '/phpspreadsheet')) ? true : false;
      $this->Xls_tot_col = 0;
      $this->Xls_row     = 0;
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
      { 
          $this->Tem_xls_res  = true;
          if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
          { 
              $this->Tem_xls_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false || strpos(" " . $_REQUEST['SC_module_export'], "chart") !== false) ? true : false;
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['SC_Ind_Groupby'] == "sc_free_total")
          {
              $this->Tem_xls_res  = false;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['SC_Gb_Free_cmp']))
          {
              $this->Tem_xls_res  = false;
          }
          if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_confirmacao_viagem_rsvp/grid_confirmacao_viagem_rsvp_res_xls.class.php"))
          {
              $this->Tem_xls_res  = false;
          }
          if ($this->Tem_xls_res)
          { 
              require_once($this->Ini->path_aplicacao . "grid_confirmacao_viagem_rsvp_res_xls.class.php");
              $this->Res_xls = new grid_confirmacao_viagem_rsvp_res_xls();
              $this->prep_modulos("Res_xls");
          } 
          $this->Arquivo    = "sc_xls";
          $this->Arquivo   .= "_" . date("YmdHis") . "_" . rand(0, 1000);
          $this->Arq_zip    = $this->Arquivo . "_grid_confirmacao_viagem_rsvp.zip";
          $this->Arquivo   .= "_grid_confirmacao_viagem_rsvp" . $this->Xls_tp;
          $this->Tit_doc    = "grid_confirmacao_viagem_rsvp" . $this->Xls_tp;
          $this->Tit_zip    = "grid_confirmacao_viagem_rsvp.zip";
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
      require_once($this->Ini->path_aplicacao . "grid_confirmacao_viagem_rsvp_total.class.php"); 
      $this->Tot = new grid_confirmacao_viagem_rsvp_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['SC_Ind_Groupby'];
      $this->Tot->$Gb_geral();
      $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['tot_geral'][1];
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_return']);
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
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['field_order'] as $Cada_cmp)
      {
          if (!isset($this->NM_cmp_hidden[$Cada_cmp]) || $this->NM_cmp_hidden[$Cada_cmp] != "off")
          {
              $this->Xls_tot_col++;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->criado_em = (isset($Busca_temp['criado_em'])) ? $Busca_temp['criado_em'] : ""; 
          $tmp_pos = (is_string($this->criado_em)) ? strpos($this->criado_em, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->criado_em))
          {
              $this->criado_em = substr($this->criado_em, 0, $tmp_pos);
          }
          $this->criado_em_2 = (isset($Busca_temp['criado_em_input_2'])) ? $Busca_temp['criado_em_input_2'] : ""; 
          $this->enviado_em = (isset($Busca_temp['enviado_em'])) ? $Busca_temp['enviado_em'] : ""; 
          $tmp_pos = (is_string($this->enviado_em)) ? strpos($this->enviado_em, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->enviado_em))
          {
              $this->enviado_em = substr($this->enviado_em, 0, $tmp_pos);
          }
          $this->enviado_em_2 = (isset($Busca_temp['enviado_em_input_2'])) ? $Busca_temp['enviado_em_input_2'] : ""; 
          $this->voo_cia_ida_01 = (isset($Busca_temp['voo_cia_ida_01'])) ? $Busca_temp['voo_cia_ida_01'] : ""; 
          $tmp_pos = (is_string($this->voo_cia_ida_01)) ? strpos($this->voo_cia_ida_01, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->voo_cia_ida_01))
          {
              $this->voo_cia_ida_01 = substr($this->voo_cia_ida_01, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['contr_erro'] = 'on';
  $sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_name'] .= $this->Xls_tp;
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_name']);
          $this->Xls_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida_label']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida_label'])
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
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, participante_acomp_011, acompanhante_012, participante_acomp_012, acompanhante_013, participante_acomp_013, acompanhante_021, participante_acomp_021, acompanhante_022, participante_acomp_022, acompanhante_023, participante_acomp_023, acompanhante_031, participante_acomp_031, acompanhante_032, participante_acomp_032, acompanhante_033, participante_acomp_033, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, participante_obs, logo_cliente, acompanhante_041, participante_acomp_041, acompanhante_042, participante_acomp_042, acompanhante_043, participante_acomp_043, acompanhante_014, acompanhante_024, acompanhante_034, acompanhante_044, participante_acomp_014, participante_acomp_024, participante_acomp_034, participante_acomp_044, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, participante_acomp_011, acompanhante_012, participante_acomp_012, acompanhante_013, participante_acomp_013, acompanhante_021, participante_acomp_021, acompanhante_022, participante_acomp_022, acompanhante_023, participante_acomp_023, acompanhante_031, participante_acomp_031, acompanhante_032, participante_acomp_032, acompanhante_033, participante_acomp_033, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, participante_obs, logo_cliente, acompanhante_041, participante_acomp_041, acompanhante_042, participante_acomp_042, acompanhante_043, participante_acomp_043, acompanhante_014, acompanhante_024, acompanhante_034, acompanhante_044, participante_acomp_014, participante_acomp_024, participante_acomp_034, participante_acomp_044, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, participante_acomp_011, acompanhante_012, participante_acomp_012, acompanhante_013, participante_acomp_013, acompanhante_021, participante_acomp_021, acompanhante_022, participante_acomp_022, acompanhante_023, participante_acomp_023, acompanhante_031, participante_acomp_031, acompanhante_032, participante_acomp_032, acompanhante_033, participante_acomp_033, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, participante_obs, logo_cliente, acompanhante_041, participante_acomp_041, acompanhante_042, participante_acomp_042, acompanhante_043, participante_acomp_043, acompanhante_014, acompanhante_024, acompanhante_034, acompanhante_044, participante_acomp_014, participante_acomp_024, participante_acomp_034, participante_acomp_044, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, participante_acomp_011, acompanhante_012, participante_acomp_012, acompanhante_013, participante_acomp_013, acompanhante_021, participante_acomp_021, acompanhante_022, participante_acomp_022, acompanhante_023, participante_acomp_023, acompanhante_031, participante_acomp_031, acompanhante_032, participante_acomp_032, acompanhante_033, participante_acomp_033, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, participante_obs, logo_cliente, acompanhante_041, participante_acomp_041, acompanhante_042, participante_acomp_042, acompanhante_043, participante_acomp_043, acompanhante_014, acompanhante_024, acompanhante_034, acompanhante_044, participante_acomp_014, participante_acomp_024, participante_acomp_034, participante_acomp_044, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, participante_acomp_011, acompanhante_012, participante_acomp_012, acompanhante_013, participante_acomp_013, acompanhante_021, participante_acomp_021, acompanhante_022, participante_acomp_022, acompanhante_023, participante_acomp_023, acompanhante_031, participante_acomp_031, acompanhante_032, participante_acomp_032, acompanhante_033, participante_acomp_033, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, participante_obs, logo_cliente, acompanhante_041, participante_acomp_041, acompanhante_042, participante_acomp_042, acompanhante_043, participante_acomp_043, acompanhante_014, acompanhante_024, acompanhante_034, acompanhante_044, participante_acomp_014, participante_acomp_024, participante_acomp_034, participante_acomp_044, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, participante_acomp_011, acompanhante_012, participante_acomp_012, acompanhante_013, participante_acomp_013, acompanhante_021, participante_acomp_021, acompanhante_022, participante_acomp_022, acompanhante_023, participante_acomp_023, acompanhante_031, participante_acomp_031, acompanhante_032, participante_acomp_032, acompanhante_033, participante_acomp_033, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, participante_obs, logo_cliente, acompanhante_041, participante_acomp_041, acompanhante_042, participante_acomp_042, acompanhante_043, participante_acomp_043, acompanhante_014, acompanhante_024, acompanhante_034, acompanhante_044, participante_acomp_014, participante_acomp_024, participante_acomp_034, participante_acomp_044, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['order_grid'];
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
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->Xls_col = 0;
         $this->Xls_row++;
         $this->simples_mensagem = $rs->fields[0] ;  
         $this->voo_origem_ida_01 = $rs->fields[1] ;  
         $this->voo_saida_origem_ida_01 = $rs->fields[2] ;  
         $this->voo_destino_ida_01 = $rs->fields[3] ;  
         $this->voo_chega_destino_ida_01 = $rs->fields[4] ;  
         $this->voo_cia_ida_01 = $rs->fields[5] ;  
         $this->voo_numvoo_ida_01 = $rs->fields[6] ;  
         $this->voo_localizador_ida_01 = $rs->fields[7] ;  
         $this->voo_etkt_ida_01 = $rs->fields[8] ;  
         $this->voo_assento_ida_01 = $rs->fields[9] ;  
         $this->voo_comprado_bvt_ida_01 = $rs->fields[10] ;  
         $this->voo_origem_ida_02 = $rs->fields[11] ;  
         $this->voo_saida_origem_ida_02 = $rs->fields[12] ;  
         $this->voo_destino_ida_02 = $rs->fields[13] ;  
         $this->voo_chega_destino_ida_02 = $rs->fields[14] ;  
         $this->voo_cia_ida_02 = $rs->fields[15] ;  
         $this->voo_numvoo_ida_02 = $rs->fields[16] ;  
         $this->voo_localizador_ida_02 = $rs->fields[17] ;  
         $this->voo_etkt_ida_02 = $rs->fields[18] ;  
         $this->voo_assento_ida_02 = $rs->fields[19] ;  
         $this->voo_comprado_bvt_ida_02 = $rs->fields[20] ;  
         $this->voo_origem_ida_03 = $rs->fields[21] ;  
         $this->voo_saida_origem_ida_03 = $rs->fields[22] ;  
         $this->voo_destino_ida_03 = $rs->fields[23] ;  
         $this->voo_chega_destino_ida_03 = $rs->fields[24] ;  
         $this->voo_cia_ida_03 = $rs->fields[25] ;  
         $this->voo_numvoo_ida_03 = $rs->fields[26] ;  
         $this->voo_localizador_ida_03 = $rs->fields[27] ;  
         $this->voo_etkt_ida_03 = $rs->fields[28] ;  
         $this->voo_assento_ida_03 = $rs->fields[29] ;  
         $this->voo_comprado_bvt_ida_03 = $rs->fields[30] ;  
         $this->voo_origem_ida_04 = $rs->fields[31] ;  
         $this->voo_saida_origem_ida_04 = $rs->fields[32] ;  
         $this->voo_destino_ida_04 = $rs->fields[33] ;  
         $this->voo_chega_destino_ida_04 = $rs->fields[34] ;  
         $this->voo_cia_ida_04 = $rs->fields[35] ;  
         $this->voo_numvoo_ida_04 = $rs->fields[36] ;  
         $this->voo_localizador_ida_04 = $rs->fields[37] ;  
         $this->voo_etkt_ida_04 = $rs->fields[38] ;  
         $this->voo_assento_ida_04 = $rs->fields[39] ;  
         $this->voo_comprado_bvt_ida_04 = $rs->fields[40] ;  
         $this->voo_origem_volta_01 = $rs->fields[41] ;  
         $this->voo_saida_origem_volta_01 = $rs->fields[42] ;  
         $this->voo_destino_volta_01 = $rs->fields[43] ;  
         $this->voo_chega_destino_volta_01 = $rs->fields[44] ;  
         $this->voo_cia_volta_01 = $rs->fields[45] ;  
         $this->voo_numvoo_volta_01 = $rs->fields[46] ;  
         $this->voo_localizador_volta_01 = $rs->fields[47] ;  
         $this->voo_etkt_volta_01 = $rs->fields[48] ;  
         $this->voo_assento_volta_01 = $rs->fields[49] ;  
         $this->voo_comprado_bvt_volta_01 = $rs->fields[50] ;  
         $this->voo_origem_volta_02 = $rs->fields[51] ;  
         $this->voo_saida_origem_volta_02 = $rs->fields[52] ;  
         $this->voo_destino_volta_02 = $rs->fields[53] ;  
         $this->voo_chega_destino_volta_02 = $rs->fields[54] ;  
         $this->voo_cia_volta_02 = $rs->fields[55] ;  
         $this->voo_numvoo_volta_02 = $rs->fields[56] ;  
         $this->voo_localizador_volta_02 = $rs->fields[57] ;  
         $this->voo_etkt_volta_02 = $rs->fields[58] ;  
         $this->voo_assento_volta_02 = $rs->fields[59] ;  
         $this->voo_comprado_bvt_volta_02 = $rs->fields[60] ;  
         $this->voo_origem_volta_03 = $rs->fields[61] ;  
         $this->voo_saida_origem_volta_03 = $rs->fields[62] ;  
         $this->voo_destino_volta_03 = $rs->fields[63] ;  
         $this->voo_chega_destino_volta_03 = $rs->fields[64] ;  
         $this->voo_cia_volta_03 = $rs->fields[65] ;  
         $this->voo_numvoo_volta_03 = $rs->fields[66] ;  
         $this->voo_localizador_volta_03 = $rs->fields[67] ;  
         $this->voo_etkt_volta_03 = $rs->fields[68] ;  
         $this->voo_assento_volta_03 = $rs->fields[69] ;  
         $this->voo_comprado_bvt_volta_03 = $rs->fields[70] ;  
         $this->voo_origem_volta_04 = $rs->fields[71] ;  
         $this->voo_saida_origem_volta_04 = $rs->fields[72] ;  
         $this->voo_destino_volta_04 = $rs->fields[73] ;  
         $this->voo_chega_destino_volta_04 = $rs->fields[74] ;  
         $this->voo_cia_volta_04 = $rs->fields[75] ;  
         $this->voo_numvoo_volta_04 = $rs->fields[76] ;  
         $this->voo_localizador_volta_04 = $rs->fields[77] ;  
         $this->voo_etkt_volta_04 = $rs->fields[78] ;  
         $this->voo_assento_volta_04 = $rs->fields[79] ;  
         $this->voo_comprado_bvt_volta_04 = $rs->fields[80] ;  
         $this->voo_observacoes_ida = $rs->fields[81] ;  
         $this->hosp_fantasia_hotel_01 = $rs->fields[82] ;  
         $this->hosp_logradouro_hotel_01 = $rs->fields[83] ;  
         $this->hosp_numero_hotel_01 = $rs->fields[84] ;  
         $this->hosp_complemento_hotel_01 = $rs->fields[85] ;  
         $this->hosp_municipio_hotel_01 = $rs->fields[86] ;  
         $this->hosp_uf_hotel_01 = $rs->fields[87] ;  
         $this->hosp_cep_hotel_01 = $rs->fields[88] ;  
         $this->hosp_pais_hotel_01 = $rs->fields[89] ;  
         $this->hosp_acomodacao_hotel_01 = $rs->fields[90] ;  
         $this->hosp_categoria_hotel_01 = $rs->fields[91] ;  
         $this->hosp_checkin_hotel_01 = $rs->fields[92] ;  
         $this->hosp_hr_ckeckin_hotel_01 = $rs->fields[93] ;  
         $this->hosp_checkout_hotel_01 = $rs->fields[94] ;  
         $this->hosp_hr_ckeckout_hotel_01 = $rs->fields[95] ;  
         $this->hosp_fantasia_hotel_02 = $rs->fields[96] ;  
         $this->hosp_logradouro_hotel_02 = $rs->fields[97] ;  
         $this->hosp_numero_hotel_02 = $rs->fields[98] ;  
         $this->hosp_complemento_hotel_02 = $rs->fields[99] ;  
         $this->hosp_municipio_hotel_02 = $rs->fields[100] ;  
         $this->hosp_uf_hotel_02 = $rs->fields[101] ;  
         $this->hosp_cep_hotel_02 = $rs->fields[102] ;  
         $this->hosp_pais_hotel_02 = $rs->fields[103] ;  
         $this->hosp_acomodacao_hotel_02 = $rs->fields[104] ;  
         $this->hosp_categoria_hotel_02 = $rs->fields[105] ;  
         $this->hosp_checkin_hotel_02 = $rs->fields[106] ;  
         $this->hosp_hr_ckeckin_hotel_02 = $rs->fields[107] ;  
         $this->hosp_checkout_hotel_02 = $rs->fields[108] ;  
         $this->hosp_hr_ckeckout_hotel_02 = $rs->fields[109] ;  
         $this->hosp_fantasia_hotel_03 = $rs->fields[110] ;  
         $this->hosp_logradouro_hotel_03 = $rs->fields[111] ;  
         $this->hosp_numero_hotel_03 = $rs->fields[112] ;  
         $this->hosp_complemento_hotel_03 = $rs->fields[113] ;  
         $this->hosp_municipio_hotel_03 = $rs->fields[114] ;  
         $this->hosp_uf_hotel_03 = $rs->fields[115] ;  
         $this->hosp_cep_hotel_03 = $rs->fields[116] ;  
         $this->hosp_pais_hotel_03 = $rs->fields[117] ;  
         $this->hosp_acomodacao_hotel_03 = $rs->fields[118] ;  
         $this->hosp_categoria_hotel_03 = $rs->fields[119] ;  
         $this->hosp_checkin_hotel_03 = $rs->fields[120] ;  
         $this->hosp_hr_ckeckin_hotel_03 = $rs->fields[121] ;  
         $this->hosp_checkout_hotel_03 = $rs->fields[122] ;  
         $this->hosp_hr_ckeckout_hotel_03 = $rs->fields[123] ;  
         $this->hosp_fantasia_hotel_04 = $rs->fields[124] ;  
         $this->hosp_logradouro_hotel_04 = $rs->fields[125] ;  
         $this->hosp_numero_hotel_04 = $rs->fields[126] ;  
         $this->hosp_complemento_hotel_04 = $rs->fields[127] ;  
         $this->hosp_municipio_hotel_04 = $rs->fields[128] ;  
         $this->hosp_uf_hotel_04 = $rs->fields[129] ;  
         $this->hosp_cep_hotel_04 = $rs->fields[130] ;  
         $this->hosp_pais_hotel_04 = $rs->fields[131] ;  
         $this->hosp_acomodacao_hotel_04 = $rs->fields[132] ;  
         $this->hosp_categoria_hotel_04 = $rs->fields[133] ;  
         $this->hosp_checkin_hotel_04 = $rs->fields[134] ;  
         $this->hosp_hr_ckeckin_hotel_04 = $rs->fields[135] ;  
         $this->hosp_checkout_hotel_04 = $rs->fields[136] ;  
         $this->hosp_hr_ckeckout_hotel_04 = $rs->fields[137] ;  
         $this->hosp_observacoes = $rs->fields[138] ;  
         $this->transfer_in_observacoes = $rs->fields[139] ;  
         $this->transfer_out_observacoes = $rs->fields[140] ;  
         $this->acompanhante_011 = $rs->fields[141] ;  
         $this->participante_acomp_011 = $rs->fields[142] ;  
         $this->acompanhante_012 = $rs->fields[143] ;  
         $this->participante_acomp_012 = $rs->fields[144] ;  
         $this->acompanhante_013 = $rs->fields[145] ;  
         $this->participante_acomp_013 = $rs->fields[146] ;  
         $this->acompanhante_021 = $rs->fields[147] ;  
         $this->participante_acomp_021 = $rs->fields[148] ;  
         $this->acompanhante_022 = $rs->fields[149] ;  
         $this->participante_acomp_022 = $rs->fields[150] ;  
         $this->acompanhante_023 = $rs->fields[151] ;  
         $this->participante_acomp_023 = $rs->fields[152] ;  
         $this->acompanhante_031 = $rs->fields[153] ;  
         $this->participante_acomp_031 = $rs->fields[154] ;  
         $this->acompanhante_032 = $rs->fields[155] ;  
         $this->participante_acomp_032 = $rs->fields[156] ;  
         $this->acompanhante_033 = $rs->fields[157] ;  
         $this->participante_acomp_033 = $rs->fields[158] ;  
         $this->opcional_01 = $rs->fields[159] ;  
         $this->opcional_02 = $rs->fields[160] ;  
         $this->opcional_03 = $rs->fields[161] ;  
         $this->opcional_04 = $rs->fields[162] ;  
         $this->observacao_final = $rs->fields[163] ;  
         $this->participante_obs = $rs->fields[164] ;  
         $this->logo_cliente = $rs->fields[165] ;  
         $this->acompanhante_041 = $rs->fields[166] ;  
         $this->participante_acomp_041 = $rs->fields[167] ;  
         $this->acompanhante_042 = $rs->fields[168] ;  
         $this->participante_acomp_042 = $rs->fields[169] ;  
         $this->acompanhante_043 = $rs->fields[170] ;  
         $this->participante_acomp_043 = $rs->fields[171] ;  
         $this->acompanhante_014 = $rs->fields[172] ;  
         $this->acompanhante_024 = $rs->fields[173] ;  
         $this->acompanhante_034 = $rs->fields[174] ;  
         $this->acompanhante_044 = $rs->fields[175] ;  
         $this->participante_acomp_014 = $rs->fields[176] ;  
         $this->participante_acomp_024 = $rs->fields[177] ;  
         $this->participante_acomp_034 = $rs->fields[178] ;  
         $this->participante_acomp_044 = $rs->fields[179] ;  
         $this->id_voucher = $rs->fields[180] ;  
         $this->id_voucher = (string)$this->id_voucher;
     if ($this->groupby_show == "S") {
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
         $_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_msg'])) {$_SESSION['vg_msg'] = "";}
if (!isset($this->sc_temp_vg_msg)) {$this->sc_temp_vg_msg = (isset($_SESSION['vg_msg'])) ? $_SESSION['vg_msg'] : "";}
if (!isset($_SESSION['vg_comcopia'])) {$_SESSION['vg_comcopia'] = "";}
if (!isset($this->sc_temp_vg_comcopia)) {$this->sc_temp_vg_comcopia = (isset($_SESSION['vg_comcopia'])) ? $_SESSION['vg_comcopia'] : "";}
if (!isset($_SESSION['vg_destinatario'])) {$_SESSION['vg_destinatario'] = "";}
if (!isset($this->sc_temp_vg_destinatario)) {$this->sc_temp_vg_destinatario = (isset($_SESSION['vg_destinatario'])) ? $_SESSION['vg_destinatario'] : "";}
if (!isset($_SESSION['vg_nome_pax'])) {$_SESSION['vg_nome_pax'] = "";}
if (!isset($this->sc_temp_vg_nome_pax)) {$this->sc_temp_vg_nome_pax = (isset($_SESSION['vg_nome_pax'])) ? $_SESSION['vg_nome_pax'] : "";}
if (!isset($_SESSION['vg_nome_evt'])) {$_SESSION['vg_nome_evt'] = "";}
if (!isset($this->sc_temp_vg_nome_evt)) {$this->sc_temp_vg_nome_evt = (isset($_SESSION['vg_nome_evt'])) ? $_SESSION['vg_nome_evt'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['vg_cpf'])) {$_SESSION['vg_cpf'] = "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
  date_default_timezone_set('America/Sao_Paulo');
$sql = "
	SELECT
		nome_evento,
		nome_participante,	
		email_destinatario,
		email_comcopia,
		email_mensagem
	FROM
		confirmacao_viagem_rsvp
	WHERE
		cod_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND
		cod_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	ORDER BY
		cod_evento, cod_participante 
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
	$this->sc_temp_vg_nome_evt = $this->rs[0][0];		
	$this->sc_temp_vg_nome_pax = $this->rs[0][1];	
	$this->sc_temp_vg_destinatario = $this->rs[0][2];
	$this->sc_temp_vg_comcopia = $this->rs[0][3];
	$this->sc_temp_vg_msg = $this->rs[0][4];
} else {
	$this->sc_temp_vg_nome_evt = '';		
	$this->sc_temp_vg_nome_pax = '';	
	$this->sc_temp_vg_destinatario = '';
	$this->sc_temp_vg_comcopia = '';
	$this->sc_temp_vg_msg = '';
}	

$varImg = base64_encode($this->logo_cliente );
$this->texto  = 'Confirmação de Viagem';

$this->teste  =" 
<div>		
   	<img align='left'><font size='6'><font color='#2a1f80'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	Confirmação de Viagem&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
	<img border=0 height='50px' src='data:image/jpg;base64,$varImg'/>
</div>";




if ($this->voo_origem_ida_01  == '') {
	$this->Ini->nm_hidden_blocos[3] = 'off';
	$this->Ini->nm_hidden_blocos[4] = 'off';	
}

if ($this->voo_origem_ida_02  == '') {
	$this->Ini->nm_hidden_blocos[5] = 'off';
}

if ($this->voo_origem_ida_03  == '') {
	$this->Ini->nm_hidden_blocos[6] = 'off';
}

if ($this->voo_origem_ida_04  == '') {
	$this->Ini->nm_hidden_blocos[7] = 'off';
}


if ($this->voo_origem_volta_01  == '') {
	$this->Ini->nm_hidden_blocos[8] = 'off';	
}

if ($this->voo_origem_volta_02  == '') {
	$this->Ini->nm_hidden_blocos[9] = 'off';
}

if ($this->voo_origem_volta_03  == '') {
	$this->Ini->nm_hidden_blocos[10] = 'off';
}

if ($this->voo_origem_volta_04  == '') {
	$this->Ini->nm_hidden_blocos[11] = 'off';
}

if ($this->participante_obs  == '') {
	$this->Ini->nm_hidden_blocos[23] = 'off';
}

if ($this->voo_observacoes_ida  == '') {
	$this->Ini->nm_hidden_blocos[12] = 'off';
}

if ($this->voo_origem_ida_01  == '' && $this->voo_origem_volta_01  == '') {
	$this->Ini->nm_hidden_blocos[12] = 'off';
	if ($this->participante_obs  == '') {
		$this->Ini->nm_hidden_blocos[23] = 'off';	
	}	
	$this->Ini->nm_hidden_blocos[3] = 'off';
}


if ($this->hosp_fantasia_hotel_01  == '') {
	$this->Ini->nm_hidden_blocos[13] = 'off';
	$this->Ini->nm_hidden_blocos[14] = 'off';	
	$this->Ini->nm_hidden_blocos[15] = 'off';
	$this->Ini->nm_hidden_blocos[16] = 'off';
	$this->Ini->nm_hidden_blocos[17] = 'off';
	$this->Ini->nm_hidden_blocos[18] = 'off';
}

if ($this->hosp_fantasia_hotel_02  == '') {
	$this->Ini->nm_hidden_blocos[15] = 'off';
}

if ($this->hosp_fantasia_hotel_03  == '') {
	$this->Ini->nm_hidden_blocos[16] = 'off';
}

if ($this->hosp_fantasia_hotel_04  == '') {
	$this->Ini->nm_hidden_blocos[17] = 'off';
}

if ($this->hosp_observacoes  == '') {
	$this->Ini->nm_hidden_blocos[18] = 'off';
}


if ($this->transfer_in_observacoes  == '' && $this->transfer_out_observacoes  == '') {
	$this->Ini->nm_hidden_blocos[19] = 'off';
	$this->NM_cmp_hidden["transfer_in_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["transfer_in_observacoes"] = 'off'; }
	$this->NM_cmp_hidden["transfer_out_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["transfer_out_observacoes"] = 'off'; }	
	;
}	

if ($this->transfer_in_observacoes  == '') {
	$this->NM_cmp_hidden["transfer_in_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["transfer_in_observacoes"] = 'off'; }
}

if ($this->transfer_out_observacoes  == '') {
	$this->NM_cmp_hidden["transfer_out_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["transfer_out_observacoes"] = 'off'; }
}




if($this->acompanhante_011  == 'ANHANTE') {
	$this->acompanhante_011  = '';
}	

$desliga_bloco = false;
if($this->acompanhante_011  == '') {                                 	
	if($this->acompanhante_021  == '') {                                   
		if($this->acompanhante_031  == '') {                                   
			if($this->acompanhante_041  == '') {                                   
				if($this->acompanhante_012  == '') {                                 
					if($this->acompanhante_022  == '') {                                   
						if($this->acompanhante_032  == '') {                                   
							if($this->acompanhante_042  == '') {                                   
								if($this->acompanhante_013  == '') {                                 
									if($this->acompanhante_023  == '') {                                   
										if($this->acompanhante_033  == '') {                                   
											if($this->acompanhante_043  == '') {                                   
												if($this->acompanhante_014  == '') {                                 
													if($this->acompanhante_024  == '') {                                   
														if($this->acompanhante_034  == '') {                                   
															if($this->acompanhante_044  == '') {                                   
																if($this->participante_acomp_011  == '') {                                   
																	if($this->participante_acomp_021  == '') {                                  
																		if($this->participante_acomp_031  == '') {                                  
																			if($this->participante_acomp_041  == '') {                                  
																				if($this->participante_acomp_012  == '') {                  
																					if($this->participante_acomp_022  == '') {                                  
																						if($this->participante_acomp_032  == '') {                                  
																							if($this->participante_acomp_042  == '') {                                  
																								if($this->participante_acomp_013  == '') {                                   
																									if($this->participante_acomp_023  == '') {                                  
																										if($this->participante_acomp_033  == '') {                                  
																											if($this->participante_acomp_043  == '') {                                  
																												if($this->participante_acomp_014  == '') {                                   
																													if($this->participante_acomp_024  == '') {                                  
																														if($this->participante_acomp_034  == '') {                                 
																															if($this->participante_acomp_044  == '') {
																																$desliga_bloco = true;															
																															}	                                                                                                                        																						}
																													}
																												}
																											}
																										}
																									}
																								}
																							}
																						}
																					}
																				}
																			}
																		}
																	}
																}
															}
														}	
													}
												}	
											}
										}
									}
								}
							}
						}
					}
				}		
			}
		 }
	}
}

if($this->acompanhante_011   == '') {                                
	$this->NM_cmp_hidden["acompanhante_011"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["acompanhante_011"] = 'off'; }
}	
if($this->acompanhante_021   == '') {                                  
	$this->NM_cmp_hidden["acompanhante_021"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["acompanhante_021"] = 'off'; }
}
if($this->acompanhante_031   == '') {                                  
	$this->NM_cmp_hidden["acompanhante_031"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["acompanhante_031"] = 'off'; }
}	
if($this->acompanhante_041   == '') {                                  
	
}	

if($this->acompanhante_012   == '') {                                
	$this->NM_cmp_hidden["acompanhante_012"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["acompanhante_012"] = 'off'; }
}	
if($this->acompanhante_022   == '') {                                  
	$this->NM_cmp_hidden["acompanhante_022"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["acompanhante_022"] = 'off'; }
}	
if($this->acompanhante_032   == '') {                                  
	$this->NM_cmp_hidden["acompanhante_032"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["acompanhante_032"] = 'off'; }
}	
if($this->acompanhante_042   == '') {                                  
	
}	

if($this->acompanhante_013   == '') {                                
	$this->NM_cmp_hidden["acompanhante_013"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["acompanhante_013"] = 'off'; }
}	
if($this->acompanhante_023   == '') {                                  
	$this->NM_cmp_hidden["acompanhante_023"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["acompanhante_023"] = 'off'; }
}	
if($this->acompanhante_033   == '') {                                  
	$this->NM_cmp_hidden["acompanhante_033"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["acompanhante_033"] = 'off'; }
}	
if($this->acompanhante_043   == '') {                                  
	
}	
if($this->acompanhante_014   == '') {                                
	
}	
if($this->acompanhante_024   == '') {                                  
	
}	
if($this->acompanhante_034   == '') {                                  
	
}	
if($this->acompanhante_044   == '') {                                  
	
}	

if($this->participante_acomp_011  == '') {                                  
	$this->NM_cmp_hidden["participante_acomp_011"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["participante_acomp_011"] = 'off'; }
}	
if($this->participante_acomp_021  == '') {                                 
	$this->NM_cmp_hidden["participante_acomp_021"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["participante_acomp_021"] = 'off'; }
}	
if($this->participante_acomp_031  == '') {                                 
	$this->NM_cmp_hidden["participante_acomp_031"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["participante_acomp_031"] = 'off'; }
}	
if($this->participante_acomp_041  == '') {                                 
	
}	

if($this->participante_acomp_012  == '') {                 
	$this->NM_cmp_hidden["participante_acomp_012"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["participante_acomp_012"] = 'off'; }
}	
if($this->participante_acomp_022  == '') {                                 
	$this->NM_cmp_hidden["participante_acomp_022"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["participante_acomp_022"] = 'off'; }
}	
if($this->participante_acomp_032  == '') {                                 
	$this->NM_cmp_hidden["participante_acomp_032"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["participante_acomp_032"] = 'off'; }
}	
if($this->participante_acomp_042  == '') {                                 
	
}	

if($this->participante_acomp_013  == '') {                                  
	$this->NM_cmp_hidden["participante_acomp_013"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["participante_acomp_013"] = 'off'; }
}	
if($this->participante_acomp_023  == '') {                                 
	$this->NM_cmp_hidden["participante_acomp_023"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["participante_acomp_023"] = 'off'; }
}	
if($this->participante_acomp_033  == '') {                                 
	$this->NM_cmp_hidden["participante_acomp_033"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["participante_acomp_033"] = 'off'; }
}	
if($this->participante_acomp_043  == '') {                                 
	
}	

if($this->participante_acomp_014  == '') {                                  
	
}	
if($this->participante_acomp_024  == '') {                                 
	
}	
if($this->participante_acomp_034  == '') {                                 
	
}	
if($this->participante_acomp_044  == '') {                                 
	
}	

if ($desliga_bloco == true) {
	$this->Ini->nm_hidden_blocos[20] = 'off';	
}	

	
if($this->opcional_01  == '' && $this->opcional_02   == '' && $this->opcional_03   == '' && $this->opcional_04  == '') {
	$this->Ini->nm_hidden_blocos[21] = 'off';
}


if($this->opcional_01  == '') {                                 
	$this->NM_cmp_hidden["opcional_01"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["opcional_01"] = 'off'; }
}

if($this->opcional_02  == '') {                                 
	$this->NM_cmp_hidden["opcional_02"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["opcional_02"] = 'off'; }
}

if($this->opcional_03  == '') {                                 
	$this->NM_cmp_hidden["opcional_03"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["opcional_03"] = 'off'; }
}

if($this->opcional_04  == '') {                                 
	$this->NM_cmp_hidden["opcional_04"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["opcional_04"] = 'off'; }
}


if ($this->observacao_final  == '') {
	$this->Ini->nm_hidden_blocos[22] = 'off';
}

$_wtipo = 'AEREO';
$_status = 'LIGADO';

$sqlobs1 = "
	SELECT
		obs_ativa
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($_wtipo)."
	ORDER BY
		obs_evento_id, obs_ativa
";
 
      $nm_select = $sqlobs1; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsobs1 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsobs1[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsobs1 = false;
          $this->rsobs1_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rsobs1[0][0])) {
	$_status = $this->rsobs1[0][0];
}
if ($_status <> 'LIGADO') {
	$this->Ini->nm_hidden_blocos[12] = 'off';	
}	

$_wtipo = 'HOTEL';
$_status = 'LIGADO';

$sqlobs2 = "
	SELECT
		obs_ativa
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($_wtipo)."
	ORDER BY
		obs_evento_id, obs_ativa
";
 
      $nm_select = $sqlobs2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsobs2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsobs2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsobs2 = false;
          $this->rsobs2_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rsobs2[0][0])) {
	$_status = $this->rsobs2[0][0];
}
if ($_status <> 'LIGADO') {
	$this->Ini->nm_hidden_blocos[18] = 'off';			
}	

$_wtipo = 'TRANSFER IN';
$_status_in = 'LIGADO';

$sqlobs3 = "
	SELECT
		obs_ativa
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($_wtipo)."
	ORDER BY
		obs_evento_id, obs_ativa
";
 
      $nm_select = $sqlobs3; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsobs3 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsobs3[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsobs3 = false;
          $this->rsobs3_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rsobs3[0][0])) {
	$_status_in = $this->rsobs3[0][0];
}
if ($_status_in <> 'LIGADO') {
	$this->NM_cmp_hidden["transfer_in_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["transfer_in_observacoes"] = 'off'; }	
}	

$_wtipo = 'TRANSFER OUT';
$_status_out = 'LIGADO';

$sqlobs4 = "
	SELECT
		obs_ativa
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($_wtipo)."
	ORDER BY
		obs_evento_id, obs_ativa
";
 
      $nm_select = $sqlobs4; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsobs4 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsobs4[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsobs4 = false;
          $this->rsobs4_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rsobs4[0][0])) {
	$_status_out = $this->rsobs4[0][0];
}
if ($_status_out <> 'LIGADO') {
	$this->NM_cmp_hidden["transfer_out_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['php_cmp_sel']["transfer_out_observacoes"] = 'off'; }
}	

if ($_status_in <> 'LIGADO' && $_status_out <> 'LIGADO') {
	$this->Ini->nm_hidden_blocos[19] = 'off';
}	

$_wtipo = 'LIVRE RODAPE';
$_status_out = 'LIGADO';

$sqlobs5 = "
	SELECT
		obs_ativa
	FROM
		tbl_obs_confirmacao
	WHERE
		obs_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		obs_tipo = ".$this->Db->qstr($_wtipo)."
	ORDER BY
		obs_evento_id, obs_ativa
";
 
      $nm_select = $sqlobs5; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsobs5 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsobs5[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsobs5 = false;
          $this->rsobs5_erro = $this->Db->ErrorMsg();
      } 
	
if (isset($this->rsobs5[0][0])) {
	$_status_out = $this->rsobs5[0][0];
}
if ($_status <> 'LIGADO') {
	$this->Ini->nm_hidden_blocos[22] = 'off';	
}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_nome_evt)) {$_SESSION['vg_nome_evt'] = $this->sc_temp_vg_nome_evt;}
if (isset($this->sc_temp_vg_nome_pax)) {$_SESSION['vg_nome_pax'] = $this->sc_temp_vg_nome_pax;}
if (isset($this->sc_temp_vg_destinatario)) {$_SESSION['vg_destinatario'] = $this->sc_temp_vg_destinatario;}
if (isset($this->sc_temp_vg_comcopia)) {$_SESSION['vg_comcopia'] = $this->sc_temp_vg_comcopia;}
if (isset($this->sc_temp_vg_msg)) {$_SESSION['vg_msg'] = $this->sc_temp_vg_msg;}
$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
         if (isset($this->NM_Row_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
         { 
             foreach ($this->NM_Row_din as $row => $height) 
             { 
                 $this->Nm_ActiveSheet->getRowDimension($row)->setRowHeight($height);
             } 
         } 
         $rs->MoveNext();
      }
      $this->xls_set_style();
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'] && $prim_reg)
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
      if (isset($this->NM_Col_din) && !$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
      { 
          foreach ($this->NM_Col_din as $col => $width)
          { 
              $this->Nm_ActiveSheet->getColumnDimension($col)->setWidth($width / 5);
          } 
      } 
      if ($this->groupby_show == "S") {
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
      { 
          if ($this->Tem_xls_res)
          { 
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_res_grid'] = true;
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              $this->Res_xls->monta_xls();
              if ($this->Use_phpspreadsheet) {
                  $Xls_res = \PhpOffice\PhpSpreadsheet\IOFactory::load($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_res_sheet']);
              }
              else {
                  $Xls_res = PHPExcel_IOFactory::load($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_res_sheet']);
              }
              foreach($Xls_res->getAllSheets() as $sheet)
              {
                  $this->Xls_dados->addExternalSheet($sheet);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_res_grid']);
              unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_res_sheet']);
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
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   function proc_label()
   { 
      foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['field_order'] as $Cada_col)
      { 
          $SC_Label = (isset($this->New_label['logo_bvt'])) ? $this->New_label['logo_bvt'] : ""; 
          if ($Cada_col == "logo_bvt" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['teste'])) ? $this->New_label['teste'] : ""; 
          if ($Cada_col == "teste" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['simples_mensagem'])) ? $this->New_label['simples_mensagem'] : ""; 
          if ($Cada_col == "simples_mensagem" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['logo_aereo'])) ? $this->New_label['logo_aereo'] : ""; 
          if ($Cada_col == "logo_aereo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_origem_ida_01'])) ? $this->New_label['voo_origem_ida_01'] : "Origem"; 
          if ($Cada_col == "voo_origem_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_saida_origem_ida_01'])) ? $this->New_label['voo_saida_origem_ida_01'] : "Saída"; 
          if ($Cada_col == "voo_saida_origem_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_destino_ida_01'])) ? $this->New_label['voo_destino_ida_01'] : "Destino"; 
          if ($Cada_col == "voo_destino_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_chega_destino_ida_01'])) ? $this->New_label['voo_chega_destino_ida_01'] : "Chegada"; 
          if ($Cada_col == "voo_chega_destino_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_cia_ida_01'])) ? $this->New_label['voo_cia_ida_01'] : "Cia."; 
          if ($Cada_col == "voo_cia_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_numvoo_ida_01'])) ? $this->New_label['voo_numvoo_ida_01'] : "Num. Voo"; 
          if ($Cada_col == "voo_numvoo_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_localizador_ida_01'])) ? $this->New_label['voo_localizador_ida_01'] : "Localizador"; 
          if ($Cada_col == "voo_localizador_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_etkt_ida_01'])) ? $this->New_label['voo_etkt_ida_01'] : "E-ticket"; 
          if ($Cada_col == "voo_etkt_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_assento_ida_01'])) ? $this->New_label['voo_assento_ida_01'] : "Assento"; 
          if ($Cada_col == "voo_assento_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_comprado_bvt_ida_01'])) ? $this->New_label['voo_comprado_bvt_ida_01'] : "Comprado com Belvitur"; 
          if ($Cada_col == "voo_comprado_bvt_ida_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_origem_ida_02'])) ? $this->New_label['voo_origem_ida_02'] : "Origem"; 
          if ($Cada_col == "voo_origem_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_saida_origem_ida_02'])) ? $this->New_label['voo_saida_origem_ida_02'] : "Saída"; 
          if ($Cada_col == "voo_saida_origem_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_destino_ida_02'])) ? $this->New_label['voo_destino_ida_02'] : "Destino"; 
          if ($Cada_col == "voo_destino_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_chega_destino_ida_02'])) ? $this->New_label['voo_chega_destino_ida_02'] : "Chegada"; 
          if ($Cada_col == "voo_chega_destino_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_cia_ida_02'])) ? $this->New_label['voo_cia_ida_02'] : "Cia."; 
          if ($Cada_col == "voo_cia_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_numvoo_ida_02'])) ? $this->New_label['voo_numvoo_ida_02'] : "Num. Voo"; 
          if ($Cada_col == "voo_numvoo_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_localizador_ida_02'])) ? $this->New_label['voo_localizador_ida_02'] : "Localizador"; 
          if ($Cada_col == "voo_localizador_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_etkt_ida_02'])) ? $this->New_label['voo_etkt_ida_02'] : "E-ticket"; 
          if ($Cada_col == "voo_etkt_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_assento_ida_02'])) ? $this->New_label['voo_assento_ida_02'] : "Assento"; 
          if ($Cada_col == "voo_assento_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_comprado_bvt_ida_02'])) ? $this->New_label['voo_comprado_bvt_ida_02'] : "Comprado com Belvitur"; 
          if ($Cada_col == "voo_comprado_bvt_ida_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_origem_ida_03'])) ? $this->New_label['voo_origem_ida_03'] : "Origem"; 
          if ($Cada_col == "voo_origem_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_saida_origem_ida_03'])) ? $this->New_label['voo_saida_origem_ida_03'] : "Saída"; 
          if ($Cada_col == "voo_saida_origem_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_destino_ida_03'])) ? $this->New_label['voo_destino_ida_03'] : "Destino"; 
          if ($Cada_col == "voo_destino_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_chega_destino_ida_03'])) ? $this->New_label['voo_chega_destino_ida_03'] : "Chegada"; 
          if ($Cada_col == "voo_chega_destino_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_cia_ida_03'])) ? $this->New_label['voo_cia_ida_03'] : "Cia."; 
          if ($Cada_col == "voo_cia_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_numvoo_ida_03'])) ? $this->New_label['voo_numvoo_ida_03'] : "Num. Voo"; 
          if ($Cada_col == "voo_numvoo_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_localizador_ida_03'])) ? $this->New_label['voo_localizador_ida_03'] : "Localizador"; 
          if ($Cada_col == "voo_localizador_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_etkt_ida_03'])) ? $this->New_label['voo_etkt_ida_03'] : "Voo"; 
          if ($Cada_col == "voo_etkt_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_assento_ida_03'])) ? $this->New_label['voo_assento_ida_03'] : "Assento"; 
          if ($Cada_col == "voo_assento_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_comprado_bvt_ida_03'])) ? $this->New_label['voo_comprado_bvt_ida_03'] : "Comprado com Belvitur"; 
          if ($Cada_col == "voo_comprado_bvt_ida_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_origem_ida_04'])) ? $this->New_label['voo_origem_ida_04'] : "Origem"; 
          if ($Cada_col == "voo_origem_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_saida_origem_ida_04'])) ? $this->New_label['voo_saida_origem_ida_04'] : "Saída"; 
          if ($Cada_col == "voo_saida_origem_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_destino_ida_04'])) ? $this->New_label['voo_destino_ida_04'] : "Destino"; 
          if ($Cada_col == "voo_destino_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_chega_destino_ida_04'])) ? $this->New_label['voo_chega_destino_ida_04'] : "Chegada"; 
          if ($Cada_col == "voo_chega_destino_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_cia_ida_04'])) ? $this->New_label['voo_cia_ida_04'] : "Cia."; 
          if ($Cada_col == "voo_cia_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_numvoo_ida_04'])) ? $this->New_label['voo_numvoo_ida_04'] : "Num. Voo"; 
          if ($Cada_col == "voo_numvoo_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_localizador_ida_04'])) ? $this->New_label['voo_localizador_ida_04'] : "Localizador"; 
          if ($Cada_col == "voo_localizador_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_etkt_ida_04'])) ? $this->New_label['voo_etkt_ida_04'] : "E-Ticket:"; 
          if ($Cada_col == "voo_etkt_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_assento_ida_04'])) ? $this->New_label['voo_assento_ida_04'] : "Assento"; 
          if ($Cada_col == "voo_assento_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_comprado_bvt_ida_04'])) ? $this->New_label['voo_comprado_bvt_ida_04'] : "Comprado com Belvitur"; 
          if ($Cada_col == "voo_comprado_bvt_ida_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_origem_volta_01'])) ? $this->New_label['voo_origem_volta_01'] : "Origem"; 
          if ($Cada_col == "voo_origem_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_saida_origem_volta_01'])) ? $this->New_label['voo_saida_origem_volta_01'] : "Saída "; 
          if ($Cada_col == "voo_saida_origem_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_destino_volta_01'])) ? $this->New_label['voo_destino_volta_01'] : "Destino"; 
          if ($Cada_col == "voo_destino_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_chega_destino_volta_01'])) ? $this->New_label['voo_chega_destino_volta_01'] : "Chegada"; 
          if ($Cada_col == "voo_chega_destino_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_cia_volta_01'])) ? $this->New_label['voo_cia_volta_01'] : "Cia."; 
          if ($Cada_col == "voo_cia_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_numvoo_volta_01'])) ? $this->New_label['voo_numvoo_volta_01'] : "Num. Voo"; 
          if ($Cada_col == "voo_numvoo_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_localizador_volta_01'])) ? $this->New_label['voo_localizador_volta_01'] : "Localizador"; 
          if ($Cada_col == "voo_localizador_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_etkt_volta_01'])) ? $this->New_label['voo_etkt_volta_01'] : "E-ticket"; 
          if ($Cada_col == "voo_etkt_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_assento_volta_01'])) ? $this->New_label['voo_assento_volta_01'] : "Assento"; 
          if ($Cada_col == "voo_assento_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_comprado_bvt_volta_01'])) ? $this->New_label['voo_comprado_bvt_volta_01'] : "Comprado com Belvitur"; 
          if ($Cada_col == "voo_comprado_bvt_volta_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_origem_volta_02'])) ? $this->New_label['voo_origem_volta_02'] : "Origem"; 
          if ($Cada_col == "voo_origem_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_saida_origem_volta_02'])) ? $this->New_label['voo_saida_origem_volta_02'] : "Saída:"; 
          if ($Cada_col == "voo_saida_origem_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_destino_volta_02'])) ? $this->New_label['voo_destino_volta_02'] : "Destino"; 
          if ($Cada_col == "voo_destino_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_chega_destino_volta_02'])) ? $this->New_label['voo_chega_destino_volta_02'] : "Chegada"; 
          if ($Cada_col == "voo_chega_destino_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_cia_volta_02'])) ? $this->New_label['voo_cia_volta_02'] : "Cia."; 
          if ($Cada_col == "voo_cia_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_numvoo_volta_02'])) ? $this->New_label['voo_numvoo_volta_02'] : "Num. Voo:"; 
          if ($Cada_col == "voo_numvoo_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_localizador_volta_02'])) ? $this->New_label['voo_localizador_volta_02'] : "Localiador"; 
          if ($Cada_col == "voo_localizador_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_etkt_volta_02'])) ? $this->New_label['voo_etkt_volta_02'] : "E-ticket"; 
          if ($Cada_col == "voo_etkt_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_assento_volta_02'])) ? $this->New_label['voo_assento_volta_02'] : "Assento"; 
          if ($Cada_col == "voo_assento_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_comprado_bvt_volta_02'])) ? $this->New_label['voo_comprado_bvt_volta_02'] : "Comprado com Belvitur"; 
          if ($Cada_col == "voo_comprado_bvt_volta_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_origem_volta_03'])) ? $this->New_label['voo_origem_volta_03'] : "Origem"; 
          if ($Cada_col == "voo_origem_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_saida_origem_volta_03'])) ? $this->New_label['voo_saida_origem_volta_03'] : "Saída"; 
          if ($Cada_col == "voo_saida_origem_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_destino_volta_03'])) ? $this->New_label['voo_destino_volta_03'] : "Destino"; 
          if ($Cada_col == "voo_destino_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_chega_destino_volta_03'])) ? $this->New_label['voo_chega_destino_volta_03'] : "Chegada"; 
          if ($Cada_col == "voo_chega_destino_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_cia_volta_03'])) ? $this->New_label['voo_cia_volta_03'] : "Cia."; 
          if ($Cada_col == "voo_cia_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_numvoo_volta_03'])) ? $this->New_label['voo_numvoo_volta_03'] : "Num. Voo:"; 
          if ($Cada_col == "voo_numvoo_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_localizador_volta_03'])) ? $this->New_label['voo_localizador_volta_03'] : "Localizador"; 
          if ($Cada_col == "voo_localizador_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_etkt_volta_03'])) ? $this->New_label['voo_etkt_volta_03'] : "E-ticket"; 
          if ($Cada_col == "voo_etkt_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_assento_volta_03'])) ? $this->New_label['voo_assento_volta_03'] : "Assento"; 
          if ($Cada_col == "voo_assento_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_comprado_bvt_volta_03'])) ? $this->New_label['voo_comprado_bvt_volta_03'] : "Comprado com Belvitur"; 
          if ($Cada_col == "voo_comprado_bvt_volta_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_origem_volta_04'])) ? $this->New_label['voo_origem_volta_04'] : "Origem"; 
          if ($Cada_col == "voo_origem_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_saida_origem_volta_04'])) ? $this->New_label['voo_saida_origem_volta_04'] : "Saída"; 
          if ($Cada_col == "voo_saida_origem_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_destino_volta_04'])) ? $this->New_label['voo_destino_volta_04'] : "Destino"; 
          if ($Cada_col == "voo_destino_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_chega_destino_volta_04'])) ? $this->New_label['voo_chega_destino_volta_04'] : "Chegada"; 
          if ($Cada_col == "voo_chega_destino_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_cia_volta_04'])) ? $this->New_label['voo_cia_volta_04'] : "Cia."; 
          if ($Cada_col == "voo_cia_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_numvoo_volta_04'])) ? $this->New_label['voo_numvoo_volta_04'] : "Num. Voo"; 
          if ($Cada_col == "voo_numvoo_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_localizador_volta_04'])) ? $this->New_label['voo_localizador_volta_04'] : "Localizador"; 
          if ($Cada_col == "voo_localizador_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_etkt_volta_04'])) ? $this->New_label['voo_etkt_volta_04'] : "E-ticket"; 
          if ($Cada_col == "voo_etkt_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_assento_volta_04'])) ? $this->New_label['voo_assento_volta_04'] : "Assento"; 
          if ($Cada_col == "voo_assento_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_comprado_bvt_volta_04'])) ? $this->New_label['voo_comprado_bvt_volta_04'] : "Comprado com Belvitur"; 
          if ($Cada_col == "voo_comprado_bvt_volta_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['voo_observacoes_ida'])) ? $this->New_label['voo_observacoes_ida'] : ""; 
          if ($Cada_col == "voo_observacoes_ida" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['logo_hospedagem'])) ? $this->New_label['logo_hospedagem'] : ""; 
          if ($Cada_col == "logo_hospedagem" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_fantasia_hotel_01'])) ? $this->New_label['hosp_fantasia_hotel_01'] : "Hotel"; 
          if ($Cada_col == "hosp_fantasia_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_logradouro_hotel_01'])) ? $this->New_label['hosp_logradouro_hotel_01'] : "Logradouro"; 
          if ($Cada_col == "hosp_logradouro_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_numero_hotel_01'])) ? $this->New_label['hosp_numero_hotel_01'] : "Número"; 
          if ($Cada_col == "hosp_numero_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_complemento_hotel_01'])) ? $this->New_label['hosp_complemento_hotel_01'] : "Complemento"; 
          if ($Cada_col == "hosp_complemento_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_municipio_hotel_01'])) ? $this->New_label['hosp_municipio_hotel_01'] : "Município"; 
          if ($Cada_col == "hosp_municipio_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_uf_hotel_01'])) ? $this->New_label['hosp_uf_hotel_01'] : "UF"; 
          if ($Cada_col == "hosp_uf_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_cep_hotel_01'])) ? $this->New_label['hosp_cep_hotel_01'] : "CEP"; 
          if ($Cada_col == "hosp_cep_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_pais_hotel_01'])) ? $this->New_label['hosp_pais_hotel_01'] : "Pais"; 
          if ($Cada_col == "hosp_pais_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_acomodacao_hotel_01'])) ? $this->New_label['hosp_acomodacao_hotel_01'] : "Acomodação"; 
          if ($Cada_col == "hosp_acomodacao_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_categoria_hotel_01'])) ? $this->New_label['hosp_categoria_hotel_01'] : "Categoria"; 
          if ($Cada_col == "hosp_categoria_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_checkin_hotel_01'])) ? $this->New_label['hosp_checkin_hotel_01'] : "Data CheckIn"; 
          if ($Cada_col == "hosp_checkin_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_hr_ckeckin_hotel_01'])) ? $this->New_label['hosp_hr_ckeckin_hotel_01'] : "Hora CheckIn"; 
          if ($Cada_col == "hosp_hr_ckeckin_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_checkout_hotel_01'])) ? $this->New_label['hosp_checkout_hotel_01'] : "Data CheckOut"; 
          if ($Cada_col == "hosp_checkout_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_hr_ckeckout_hotel_01'])) ? $this->New_label['hosp_hr_ckeckout_hotel_01'] : "Hora CheckOut"; 
          if ($Cada_col == "hosp_hr_ckeckout_hotel_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_fantasia_hotel_02'])) ? $this->New_label['hosp_fantasia_hotel_02'] : "Hotel"; 
          if ($Cada_col == "hosp_fantasia_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_logradouro_hotel_02'])) ? $this->New_label['hosp_logradouro_hotel_02'] : "Logradouro"; 
          if ($Cada_col == "hosp_logradouro_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_numero_hotel_02'])) ? $this->New_label['hosp_numero_hotel_02'] : "Número"; 
          if ($Cada_col == "hosp_numero_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_complemento_hotel_02'])) ? $this->New_label['hosp_complemento_hotel_02'] : "Complemento"; 
          if ($Cada_col == "hosp_complemento_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_municipio_hotel_02'])) ? $this->New_label['hosp_municipio_hotel_02'] : "Município"; 
          if ($Cada_col == "hosp_municipio_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_uf_hotel_02'])) ? $this->New_label['hosp_uf_hotel_02'] : "UF"; 
          if ($Cada_col == "hosp_uf_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_cep_hotel_02'])) ? $this->New_label['hosp_cep_hotel_02'] : "CEP"; 
          if ($Cada_col == "hosp_cep_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_pais_hotel_02'])) ? $this->New_label['hosp_pais_hotel_02'] : "País"; 
          if ($Cada_col == "hosp_pais_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_acomodacao_hotel_02'])) ? $this->New_label['hosp_acomodacao_hotel_02'] : "Acomodação"; 
          if ($Cada_col == "hosp_acomodacao_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_categoria_hotel_02'])) ? $this->New_label['hosp_categoria_hotel_02'] : "Categoria"; 
          if ($Cada_col == "hosp_categoria_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_checkin_hotel_02'])) ? $this->New_label['hosp_checkin_hotel_02'] : "Data CheckIn"; 
          if ($Cada_col == "hosp_checkin_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_hr_ckeckin_hotel_02'])) ? $this->New_label['hosp_hr_ckeckin_hotel_02'] : "Hora CheckIn"; 
          if ($Cada_col == "hosp_hr_ckeckin_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_checkout_hotel_02'])) ? $this->New_label['hosp_checkout_hotel_02'] : "Data CheckOut"; 
          if ($Cada_col == "hosp_checkout_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_hr_ckeckout_hotel_02'])) ? $this->New_label['hosp_hr_ckeckout_hotel_02'] : "Data CheckOut"; 
          if ($Cada_col == "hosp_hr_ckeckout_hotel_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_fantasia_hotel_03'])) ? $this->New_label['hosp_fantasia_hotel_03'] : "Hotel"; 
          if ($Cada_col == "hosp_fantasia_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_logradouro_hotel_03'])) ? $this->New_label['hosp_logradouro_hotel_03'] : "Logradouro"; 
          if ($Cada_col == "hosp_logradouro_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_numero_hotel_03'])) ? $this->New_label['hosp_numero_hotel_03'] : "Número"; 
          if ($Cada_col == "hosp_numero_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_complemento_hotel_03'])) ? $this->New_label['hosp_complemento_hotel_03'] : "Complemento"; 
          if ($Cada_col == "hosp_complemento_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_municipio_hotel_03'])) ? $this->New_label['hosp_municipio_hotel_03'] : "Município"; 
          if ($Cada_col == "hosp_municipio_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_uf_hotel_03'])) ? $this->New_label['hosp_uf_hotel_03'] : "UF"; 
          if ($Cada_col == "hosp_uf_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_cep_hotel_03'])) ? $this->New_label['hosp_cep_hotel_03'] : "CEP"; 
          if ($Cada_col == "hosp_cep_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_pais_hotel_03'])) ? $this->New_label['hosp_pais_hotel_03'] : "País"; 
          if ($Cada_col == "hosp_pais_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_acomodacao_hotel_03'])) ? $this->New_label['hosp_acomodacao_hotel_03'] : "Acomodação"; 
          if ($Cada_col == "hosp_acomodacao_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_categoria_hotel_03'])) ? $this->New_label['hosp_categoria_hotel_03'] : "Categoria"; 
          if ($Cada_col == "hosp_categoria_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_checkin_hotel_03'])) ? $this->New_label['hosp_checkin_hotel_03'] : "Data CheckIn"; 
          if ($Cada_col == "hosp_checkin_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_hr_ckeckin_hotel_03'])) ? $this->New_label['hosp_hr_ckeckin_hotel_03'] : "Hora CheckIn"; 
          if ($Cada_col == "hosp_hr_ckeckin_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_checkout_hotel_03'])) ? $this->New_label['hosp_checkout_hotel_03'] : "Data CheckOut"; 
          if ($Cada_col == "hosp_checkout_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_hr_ckeckout_hotel_03'])) ? $this->New_label['hosp_hr_ckeckout_hotel_03'] : "Data CheckOut"; 
          if ($Cada_col == "hosp_hr_ckeckout_hotel_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_fantasia_hotel_04'])) ? $this->New_label['hosp_fantasia_hotel_04'] : "Hotel"; 
          if ($Cada_col == "hosp_fantasia_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_logradouro_hotel_04'])) ? $this->New_label['hosp_logradouro_hotel_04'] : "Logradouro"; 
          if ($Cada_col == "hosp_logradouro_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_numero_hotel_04'])) ? $this->New_label['hosp_numero_hotel_04'] : "Número"; 
          if ($Cada_col == "hosp_numero_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_complemento_hotel_04'])) ? $this->New_label['hosp_complemento_hotel_04'] : "Complemento"; 
          if ($Cada_col == "hosp_complemento_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_municipio_hotel_04'])) ? $this->New_label['hosp_municipio_hotel_04'] : "Município"; 
          if ($Cada_col == "hosp_municipio_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_uf_hotel_04'])) ? $this->New_label['hosp_uf_hotel_04'] : "UF"; 
          if ($Cada_col == "hosp_uf_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_cep_hotel_04'])) ? $this->New_label['hosp_cep_hotel_04'] : "CEP"; 
          if ($Cada_col == "hosp_cep_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_pais_hotel_04'])) ? $this->New_label['hosp_pais_hotel_04'] : "País"; 
          if ($Cada_col == "hosp_pais_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_acomodacao_hotel_04'])) ? $this->New_label['hosp_acomodacao_hotel_04'] : "Acomodação"; 
          if ($Cada_col == "hosp_acomodacao_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_categoria_hotel_04'])) ? $this->New_label['hosp_categoria_hotel_04'] : "Categoria"; 
          if ($Cada_col == "hosp_categoria_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_checkin_hotel_04'])) ? $this->New_label['hosp_checkin_hotel_04'] : "Data CheckIn"; 
          if ($Cada_col == "hosp_checkin_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_hr_ckeckin_hotel_04'])) ? $this->New_label['hosp_hr_ckeckin_hotel_04'] : "Hora CheckIn"; 
          if ($Cada_col == "hosp_hr_ckeckin_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_checkout_hotel_04'])) ? $this->New_label['hosp_checkout_hotel_04'] : "Data CheckOut"; 
          if ($Cada_col == "hosp_checkout_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_hr_ckeckout_hotel_04'])) ? $this->New_label['hosp_hr_ckeckout_hotel_04'] : "Hora CheckOut"; 
          if ($Cada_col == "hosp_hr_ckeckout_hotel_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['hosp_observacoes'])) ? $this->New_label['hosp_observacoes'] : ""; 
          if ($Cada_col == "hosp_observacoes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['logo_transfer'])) ? $this->New_label['logo_transfer'] : ""; 
          if ($Cada_col == "logo_transfer" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['transfer_in_observacoes'])) ? $this->New_label['transfer_in_observacoes'] : ""; 
          if ($Cada_col == "transfer_in_observacoes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['transfer_out_observacoes'])) ? $this->New_label['transfer_out_observacoes'] : ""; 
          if ($Cada_col == "transfer_out_observacoes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['acompanhante_011'])) ? $this->New_label['acompanhante_011'] : "Acompanhante 011"; 
          if ($Cada_col == "acompanhante_011" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_acomp_011'])) ? $this->New_label['participante_acomp_011'] : "Participante e Acompanhante 011"; 
          if ($Cada_col == "participante_acomp_011" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['acompanhante_012'])) ? $this->New_label['acompanhante_012'] : "Acompanhante 012"; 
          if ($Cada_col == "acompanhante_012" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_acomp_012'])) ? $this->New_label['participante_acomp_012'] : "Participante e Acompanhante 012"; 
          if ($Cada_col == "participante_acomp_012" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['acompanhante_013'])) ? $this->New_label['acompanhante_013'] : "Acompanhante 013"; 
          if ($Cada_col == "acompanhante_013" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_acomp_013'])) ? $this->New_label['participante_acomp_013'] : "Participante e Acompanhante 013"; 
          if ($Cada_col == "participante_acomp_013" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['acompanhante_021'])) ? $this->New_label['acompanhante_021'] : "Acompanhante 021"; 
          if ($Cada_col == "acompanhante_021" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_acomp_021'])) ? $this->New_label['participante_acomp_021'] : "Participante e Acompanhante 021"; 
          if ($Cada_col == "participante_acomp_021" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['acompanhante_022'])) ? $this->New_label['acompanhante_022'] : "Acompanhante 022"; 
          if ($Cada_col == "acompanhante_022" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_acomp_022'])) ? $this->New_label['participante_acomp_022'] : "Participante e  Acompanhante 022"; 
          if ($Cada_col == "participante_acomp_022" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['acompanhante_023'])) ? $this->New_label['acompanhante_023'] : "Acompanhante 023"; 
          if ($Cada_col == "acompanhante_023" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_acomp_023'])) ? $this->New_label['participante_acomp_023'] : "Participante e  Acompanhante 023"; 
          if ($Cada_col == "participante_acomp_023" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['acompanhante_031'])) ? $this->New_label['acompanhante_031'] : "Acompanhante 031"; 
          if ($Cada_col == "acompanhante_031" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_acomp_031'])) ? $this->New_label['participante_acomp_031'] : "Participante e  Acompanhante 031"; 
          if ($Cada_col == "participante_acomp_031" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['acompanhante_032'])) ? $this->New_label['acompanhante_032'] : "Acompanhante 032"; 
          if ($Cada_col == "acompanhante_032" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_acomp_032'])) ? $this->New_label['participante_acomp_032'] : "Participante e  Acompanhante 032"; 
          if ($Cada_col == "participante_acomp_032" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['acompanhante_033'])) ? $this->New_label['acompanhante_033'] : "Acompanhante 033"; 
          if ($Cada_col == "acompanhante_033" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_acomp_033'])) ? $this->New_label['participante_acomp_033'] : "Participante e  Acompanhante 033"; 
          if ($Cada_col == "participante_acomp_033" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['opcional_01'])) ? $this->New_label['opcional_01'] : " 01"; 
          if ($Cada_col == "opcional_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['opcional_02'])) ? $this->New_label['opcional_02'] : " 02"; 
          if ($Cada_col == "opcional_02" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['opcional_03'])) ? $this->New_label['opcional_03'] : " 03"; 
          if ($Cada_col == "opcional_03" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['opcional_04'])) ? $this->New_label['opcional_04'] : " 04"; 
          if ($Cada_col == "opcional_04" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['observacao_final'])) ? $this->New_label['observacao_final'] : ""; 
          if ($Cada_col == "observacao_final" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
          $SC_Label = (isset($this->New_label['participante_obs'])) ? $this->New_label['participante_obs'] : ""; 
          if ($Cada_col == "participante_obs" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
          {
              $this->count_span++;
              $current_cell_ref = $this->calc_cell($this->Xls_col);
              $SC_Label = NM_charset_to_utf8($SC_Label);
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['embutida'])
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
      } 
      $this->Xls_col = 0;
      $this->Xls_row++;
   } 
   //----- logo_bvt
   function NM_export_logo_bvt()
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
         $this->logo_bvt = NM_charset_to_utf8($this->logo_bvt);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->logo_bvt, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->logo_bvt, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- teste
   function NM_export_teste()
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
         $this->teste = html_entity_decode($this->teste, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->teste = strip_tags($this->teste);
         $this->teste = NM_charset_to_utf8($this->teste);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->teste, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->teste, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- simples_mensagem
   function NM_export_simples_mensagem()
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
         $this->simples_mensagem = html_entity_decode($this->simples_mensagem, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->simples_mensagem = strip_tags($this->simples_mensagem);
         $this->simples_mensagem = NM_charset_to_utf8($this->simples_mensagem);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->simples_mensagem, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->simples_mensagem, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- logo_aereo
   function NM_export_logo_aereo()
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
         $this->logo_aereo = NM_charset_to_utf8($this->logo_aereo);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->logo_aereo, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->logo_aereo, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_origem_ida_01
   function NM_export_voo_origem_ida_01()
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
         $this->voo_origem_ida_01 = html_entity_decode($this->voo_origem_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_ida_01 = strip_tags($this->voo_origem_ida_01);
         $this->voo_origem_ida_01 = NM_charset_to_utf8($this->voo_origem_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_saida_origem_ida_01
   function NM_export_voo_saida_origem_ida_01()
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
         $this->voo_saida_origem_ida_01 = html_entity_decode($this->voo_saida_origem_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_ida_01 = strip_tags($this->voo_saida_origem_ida_01);
         $this->voo_saida_origem_ida_01 = NM_charset_to_utf8($this->voo_saida_origem_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_destino_ida_01
   function NM_export_voo_destino_ida_01()
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
         $this->voo_destino_ida_01 = html_entity_decode($this->voo_destino_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_ida_01 = strip_tags($this->voo_destino_ida_01);
         $this->voo_destino_ida_01 = NM_charset_to_utf8($this->voo_destino_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_chega_destino_ida_01
   function NM_export_voo_chega_destino_ida_01()
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
         $this->voo_chega_destino_ida_01 = html_entity_decode($this->voo_chega_destino_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_ida_01 = strip_tags($this->voo_chega_destino_ida_01);
         $this->voo_chega_destino_ida_01 = NM_charset_to_utf8($this->voo_chega_destino_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_cia_ida_01
   function NM_export_voo_cia_ida_01()
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
         $this->voo_cia_ida_01 = html_entity_decode($this->voo_cia_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_ida_01 = NM_charset_to_utf8($this->voo_cia_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_numvoo_ida_01
   function NM_export_voo_numvoo_ida_01()
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
         $this->voo_numvoo_ida_01 = html_entity_decode($this->voo_numvoo_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_ida_01 = strip_tags($this->voo_numvoo_ida_01);
         $this->voo_numvoo_ida_01 = NM_charset_to_utf8($this->voo_numvoo_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_localizador_ida_01
   function NM_export_voo_localizador_ida_01()
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
         $this->voo_localizador_ida_01 = html_entity_decode($this->voo_localizador_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_ida_01 = strip_tags($this->voo_localizador_ida_01);
         $this->voo_localizador_ida_01 = NM_charset_to_utf8($this->voo_localizador_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_etkt_ida_01
   function NM_export_voo_etkt_ida_01()
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
         $this->voo_etkt_ida_01 = html_entity_decode($this->voo_etkt_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_ida_01 = strip_tags($this->voo_etkt_ida_01);
         $this->voo_etkt_ida_01 = NM_charset_to_utf8($this->voo_etkt_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_assento_ida_01
   function NM_export_voo_assento_ida_01()
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
         $this->voo_assento_ida_01 = html_entity_decode($this->voo_assento_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_ida_01 = strip_tags($this->voo_assento_ida_01);
         $this->voo_assento_ida_01 = NM_charset_to_utf8($this->voo_assento_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_ida_01
   function NM_export_voo_comprado_bvt_ida_01()
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
         $this->voo_comprado_bvt_ida_01 = html_entity_decode($this->voo_comprado_bvt_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_ida_01 = strip_tags($this->voo_comprado_bvt_ida_01);
         $this->voo_comprado_bvt_ida_01 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_ida_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_ida_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_origem_ida_02
   function NM_export_voo_origem_ida_02()
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
         $this->voo_origem_ida_02 = html_entity_decode($this->voo_origem_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_ida_02 = strip_tags($this->voo_origem_ida_02);
         $this->voo_origem_ida_02 = NM_charset_to_utf8($this->voo_origem_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_saida_origem_ida_02
   function NM_export_voo_saida_origem_ida_02()
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
         $this->voo_saida_origem_ida_02 = html_entity_decode($this->voo_saida_origem_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_ida_02 = strip_tags($this->voo_saida_origem_ida_02);
         $this->voo_saida_origem_ida_02 = NM_charset_to_utf8($this->voo_saida_origem_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_destino_ida_02
   function NM_export_voo_destino_ida_02()
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
         $this->voo_destino_ida_02 = html_entity_decode($this->voo_destino_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_ida_02 = strip_tags($this->voo_destino_ida_02);
         $this->voo_destino_ida_02 = NM_charset_to_utf8($this->voo_destino_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_chega_destino_ida_02
   function NM_export_voo_chega_destino_ida_02()
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
         $this->voo_chega_destino_ida_02 = html_entity_decode($this->voo_chega_destino_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_ida_02 = strip_tags($this->voo_chega_destino_ida_02);
         $this->voo_chega_destino_ida_02 = NM_charset_to_utf8($this->voo_chega_destino_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_cia_ida_02
   function NM_export_voo_cia_ida_02()
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
         $this->voo_cia_ida_02 = html_entity_decode($this->voo_cia_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_ida_02 = strip_tags($this->voo_cia_ida_02);
         $this->voo_cia_ida_02 = NM_charset_to_utf8($this->voo_cia_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_numvoo_ida_02
   function NM_export_voo_numvoo_ida_02()
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
         $this->voo_numvoo_ida_02 = html_entity_decode($this->voo_numvoo_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_ida_02 = strip_tags($this->voo_numvoo_ida_02);
         $this->voo_numvoo_ida_02 = NM_charset_to_utf8($this->voo_numvoo_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_localizador_ida_02
   function NM_export_voo_localizador_ida_02()
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
         $this->voo_localizador_ida_02 = html_entity_decode($this->voo_localizador_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_ida_02 = strip_tags($this->voo_localizador_ida_02);
         $this->voo_localizador_ida_02 = NM_charset_to_utf8($this->voo_localizador_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_etkt_ida_02
   function NM_export_voo_etkt_ida_02()
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
         $this->voo_etkt_ida_02 = html_entity_decode($this->voo_etkt_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_ida_02 = strip_tags($this->voo_etkt_ida_02);
         $this->voo_etkt_ida_02 = NM_charset_to_utf8($this->voo_etkt_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_assento_ida_02
   function NM_export_voo_assento_ida_02()
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
         $this->voo_assento_ida_02 = html_entity_decode($this->voo_assento_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_ida_02 = strip_tags($this->voo_assento_ida_02);
         $this->voo_assento_ida_02 = NM_charset_to_utf8($this->voo_assento_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_ida_02
   function NM_export_voo_comprado_bvt_ida_02()
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
         $this->voo_comprado_bvt_ida_02 = html_entity_decode($this->voo_comprado_bvt_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_ida_02 = strip_tags($this->voo_comprado_bvt_ida_02);
         $this->voo_comprado_bvt_ida_02 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_ida_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_ida_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_origem_ida_03
   function NM_export_voo_origem_ida_03()
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
         $this->voo_origem_ida_03 = html_entity_decode($this->voo_origem_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_ida_03 = strip_tags($this->voo_origem_ida_03);
         $this->voo_origem_ida_03 = NM_charset_to_utf8($this->voo_origem_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_saida_origem_ida_03
   function NM_export_voo_saida_origem_ida_03()
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
         $this->voo_saida_origem_ida_03 = html_entity_decode($this->voo_saida_origem_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_ida_03 = strip_tags($this->voo_saida_origem_ida_03);
         $this->voo_saida_origem_ida_03 = NM_charset_to_utf8($this->voo_saida_origem_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_destino_ida_03
   function NM_export_voo_destino_ida_03()
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
         $this->voo_destino_ida_03 = html_entity_decode($this->voo_destino_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_ida_03 = strip_tags($this->voo_destino_ida_03);
         $this->voo_destino_ida_03 = NM_charset_to_utf8($this->voo_destino_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_chega_destino_ida_03
   function NM_export_voo_chega_destino_ida_03()
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
         $this->voo_chega_destino_ida_03 = html_entity_decode($this->voo_chega_destino_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_ida_03 = strip_tags($this->voo_chega_destino_ida_03);
         $this->voo_chega_destino_ida_03 = NM_charset_to_utf8($this->voo_chega_destino_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_cia_ida_03
   function NM_export_voo_cia_ida_03()
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
         $this->voo_cia_ida_03 = html_entity_decode($this->voo_cia_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_ida_03 = strip_tags($this->voo_cia_ida_03);
         $this->voo_cia_ida_03 = NM_charset_to_utf8($this->voo_cia_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_numvoo_ida_03
   function NM_export_voo_numvoo_ida_03()
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
         $this->voo_numvoo_ida_03 = html_entity_decode($this->voo_numvoo_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_ida_03 = strip_tags($this->voo_numvoo_ida_03);
         $this->voo_numvoo_ida_03 = NM_charset_to_utf8($this->voo_numvoo_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_localizador_ida_03
   function NM_export_voo_localizador_ida_03()
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
         $this->voo_localizador_ida_03 = html_entity_decode($this->voo_localizador_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_ida_03 = strip_tags($this->voo_localizador_ida_03);
         $this->voo_localizador_ida_03 = NM_charset_to_utf8($this->voo_localizador_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_etkt_ida_03
   function NM_export_voo_etkt_ida_03()
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
         $this->voo_etkt_ida_03 = html_entity_decode($this->voo_etkt_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_ida_03 = strip_tags($this->voo_etkt_ida_03);
         $this->voo_etkt_ida_03 = NM_charset_to_utf8($this->voo_etkt_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_assento_ida_03
   function NM_export_voo_assento_ida_03()
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
         $this->voo_assento_ida_03 = html_entity_decode($this->voo_assento_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_ida_03 = strip_tags($this->voo_assento_ida_03);
         $this->voo_assento_ida_03 = NM_charset_to_utf8($this->voo_assento_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_ida_03
   function NM_export_voo_comprado_bvt_ida_03()
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
         $this->voo_comprado_bvt_ida_03 = html_entity_decode($this->voo_comprado_bvt_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_ida_03 = strip_tags($this->voo_comprado_bvt_ida_03);
         $this->voo_comprado_bvt_ida_03 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_ida_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_ida_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_origem_ida_04
   function NM_export_voo_origem_ida_04()
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
         $this->voo_origem_ida_04 = html_entity_decode($this->voo_origem_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_ida_04 = strip_tags($this->voo_origem_ida_04);
         $this->voo_origem_ida_04 = NM_charset_to_utf8($this->voo_origem_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_saida_origem_ida_04
   function NM_export_voo_saida_origem_ida_04()
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
         $this->voo_saida_origem_ida_04 = html_entity_decode($this->voo_saida_origem_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_ida_04 = strip_tags($this->voo_saida_origem_ida_04);
         $this->voo_saida_origem_ida_04 = NM_charset_to_utf8($this->voo_saida_origem_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_destino_ida_04
   function NM_export_voo_destino_ida_04()
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
         $this->voo_destino_ida_04 = html_entity_decode($this->voo_destino_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_ida_04 = strip_tags($this->voo_destino_ida_04);
         $this->voo_destino_ida_04 = NM_charset_to_utf8($this->voo_destino_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_chega_destino_ida_04
   function NM_export_voo_chega_destino_ida_04()
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
         $this->voo_chega_destino_ida_04 = html_entity_decode($this->voo_chega_destino_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_ida_04 = strip_tags($this->voo_chega_destino_ida_04);
         $this->voo_chega_destino_ida_04 = NM_charset_to_utf8($this->voo_chega_destino_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_cia_ida_04
   function NM_export_voo_cia_ida_04()
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
         $this->voo_cia_ida_04 = html_entity_decode($this->voo_cia_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_ida_04 = strip_tags($this->voo_cia_ida_04);
         $this->voo_cia_ida_04 = NM_charset_to_utf8($this->voo_cia_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_numvoo_ida_04
   function NM_export_voo_numvoo_ida_04()
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
         $this->voo_numvoo_ida_04 = html_entity_decode($this->voo_numvoo_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_ida_04 = strip_tags($this->voo_numvoo_ida_04);
         $this->voo_numvoo_ida_04 = NM_charset_to_utf8($this->voo_numvoo_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_localizador_ida_04
   function NM_export_voo_localizador_ida_04()
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
         $this->voo_localizador_ida_04 = html_entity_decode($this->voo_localizador_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_ida_04 = strip_tags($this->voo_localizador_ida_04);
         $this->voo_localizador_ida_04 = NM_charset_to_utf8($this->voo_localizador_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_etkt_ida_04
   function NM_export_voo_etkt_ida_04()
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
         $this->voo_etkt_ida_04 = html_entity_decode($this->voo_etkt_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_ida_04 = strip_tags($this->voo_etkt_ida_04);
         $this->voo_etkt_ida_04 = NM_charset_to_utf8($this->voo_etkt_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_assento_ida_04
   function NM_export_voo_assento_ida_04()
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
         $this->voo_assento_ida_04 = html_entity_decode($this->voo_assento_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_ida_04 = strip_tags($this->voo_assento_ida_04);
         $this->voo_assento_ida_04 = NM_charset_to_utf8($this->voo_assento_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_ida_04
   function NM_export_voo_comprado_bvt_ida_04()
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
         $this->voo_comprado_bvt_ida_04 = html_entity_decode($this->voo_comprado_bvt_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_ida_04 = strip_tags($this->voo_comprado_bvt_ida_04);
         $this->voo_comprado_bvt_ida_04 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_ida_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_ida_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_origem_volta_01
   function NM_export_voo_origem_volta_01()
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
         $this->voo_origem_volta_01 = html_entity_decode($this->voo_origem_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_volta_01 = strip_tags($this->voo_origem_volta_01);
         $this->voo_origem_volta_01 = NM_charset_to_utf8($this->voo_origem_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_saida_origem_volta_01
   function NM_export_voo_saida_origem_volta_01()
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
         $this->voo_saida_origem_volta_01 = html_entity_decode($this->voo_saida_origem_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_volta_01 = strip_tags($this->voo_saida_origem_volta_01);
         $this->voo_saida_origem_volta_01 = NM_charset_to_utf8($this->voo_saida_origem_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_destino_volta_01
   function NM_export_voo_destino_volta_01()
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
         $this->voo_destino_volta_01 = html_entity_decode($this->voo_destino_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_volta_01 = strip_tags($this->voo_destino_volta_01);
         $this->voo_destino_volta_01 = NM_charset_to_utf8($this->voo_destino_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_chega_destino_volta_01
   function NM_export_voo_chega_destino_volta_01()
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
         $this->voo_chega_destino_volta_01 = html_entity_decode($this->voo_chega_destino_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_volta_01 = strip_tags($this->voo_chega_destino_volta_01);
         $this->voo_chega_destino_volta_01 = NM_charset_to_utf8($this->voo_chega_destino_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_cia_volta_01
   function NM_export_voo_cia_volta_01()
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
         $this->voo_cia_volta_01 = html_entity_decode($this->voo_cia_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_volta_01 = strip_tags($this->voo_cia_volta_01);
         $this->voo_cia_volta_01 = NM_charset_to_utf8($this->voo_cia_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_numvoo_volta_01
   function NM_export_voo_numvoo_volta_01()
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
         $this->voo_numvoo_volta_01 = html_entity_decode($this->voo_numvoo_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_volta_01 = strip_tags($this->voo_numvoo_volta_01);
         $this->voo_numvoo_volta_01 = NM_charset_to_utf8($this->voo_numvoo_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_localizador_volta_01
   function NM_export_voo_localizador_volta_01()
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
         $this->voo_localizador_volta_01 = html_entity_decode($this->voo_localizador_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_volta_01 = strip_tags($this->voo_localizador_volta_01);
         $this->voo_localizador_volta_01 = NM_charset_to_utf8($this->voo_localizador_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_etkt_volta_01
   function NM_export_voo_etkt_volta_01()
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
         $this->voo_etkt_volta_01 = html_entity_decode($this->voo_etkt_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_volta_01 = strip_tags($this->voo_etkt_volta_01);
         $this->voo_etkt_volta_01 = NM_charset_to_utf8($this->voo_etkt_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_assento_volta_01
   function NM_export_voo_assento_volta_01()
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
         $this->voo_assento_volta_01 = html_entity_decode($this->voo_assento_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_volta_01 = strip_tags($this->voo_assento_volta_01);
         $this->voo_assento_volta_01 = NM_charset_to_utf8($this->voo_assento_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_volta_01
   function NM_export_voo_comprado_bvt_volta_01()
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
         $this->voo_comprado_bvt_volta_01 = html_entity_decode($this->voo_comprado_bvt_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_volta_01 = strip_tags($this->voo_comprado_bvt_volta_01);
         $this->voo_comprado_bvt_volta_01 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_volta_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_volta_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_origem_volta_02
   function NM_export_voo_origem_volta_02()
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
         $this->voo_origem_volta_02 = html_entity_decode($this->voo_origem_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_volta_02 = strip_tags($this->voo_origem_volta_02);
         $this->voo_origem_volta_02 = NM_charset_to_utf8($this->voo_origem_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_saida_origem_volta_02
   function NM_export_voo_saida_origem_volta_02()
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
         $this->voo_saida_origem_volta_02 = html_entity_decode($this->voo_saida_origem_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_volta_02 = strip_tags($this->voo_saida_origem_volta_02);
         $this->voo_saida_origem_volta_02 = NM_charset_to_utf8($this->voo_saida_origem_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_destino_volta_02
   function NM_export_voo_destino_volta_02()
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
         $this->voo_destino_volta_02 = html_entity_decode($this->voo_destino_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_volta_02 = strip_tags($this->voo_destino_volta_02);
         $this->voo_destino_volta_02 = NM_charset_to_utf8($this->voo_destino_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_chega_destino_volta_02
   function NM_export_voo_chega_destino_volta_02()
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
         $this->voo_chega_destino_volta_02 = html_entity_decode($this->voo_chega_destino_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_volta_02 = strip_tags($this->voo_chega_destino_volta_02);
         $this->voo_chega_destino_volta_02 = NM_charset_to_utf8($this->voo_chega_destino_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_cia_volta_02
   function NM_export_voo_cia_volta_02()
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
         $this->voo_cia_volta_02 = html_entity_decode($this->voo_cia_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_volta_02 = strip_tags($this->voo_cia_volta_02);
         $this->voo_cia_volta_02 = NM_charset_to_utf8($this->voo_cia_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_numvoo_volta_02
   function NM_export_voo_numvoo_volta_02()
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
         $this->voo_numvoo_volta_02 = html_entity_decode($this->voo_numvoo_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_volta_02 = strip_tags($this->voo_numvoo_volta_02);
         $this->voo_numvoo_volta_02 = NM_charset_to_utf8($this->voo_numvoo_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_localizador_volta_02
   function NM_export_voo_localizador_volta_02()
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
         $this->voo_localizador_volta_02 = html_entity_decode($this->voo_localizador_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_volta_02 = strip_tags($this->voo_localizador_volta_02);
         $this->voo_localizador_volta_02 = NM_charset_to_utf8($this->voo_localizador_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_etkt_volta_02
   function NM_export_voo_etkt_volta_02()
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
         $this->voo_etkt_volta_02 = html_entity_decode($this->voo_etkt_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_volta_02 = strip_tags($this->voo_etkt_volta_02);
         $this->voo_etkt_volta_02 = NM_charset_to_utf8($this->voo_etkt_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_assento_volta_02
   function NM_export_voo_assento_volta_02()
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
         $this->voo_assento_volta_02 = html_entity_decode($this->voo_assento_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_volta_02 = strip_tags($this->voo_assento_volta_02);
         $this->voo_assento_volta_02 = NM_charset_to_utf8($this->voo_assento_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_volta_02
   function NM_export_voo_comprado_bvt_volta_02()
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
         $this->voo_comprado_bvt_volta_02 = html_entity_decode($this->voo_comprado_bvt_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_volta_02 = strip_tags($this->voo_comprado_bvt_volta_02);
         $this->voo_comprado_bvt_volta_02 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_volta_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_volta_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_origem_volta_03
   function NM_export_voo_origem_volta_03()
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
         $this->voo_origem_volta_03 = html_entity_decode($this->voo_origem_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_volta_03 = strip_tags($this->voo_origem_volta_03);
         $this->voo_origem_volta_03 = NM_charset_to_utf8($this->voo_origem_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_saida_origem_volta_03
   function NM_export_voo_saida_origem_volta_03()
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
         $this->voo_saida_origem_volta_03 = html_entity_decode($this->voo_saida_origem_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_volta_03 = strip_tags($this->voo_saida_origem_volta_03);
         $this->voo_saida_origem_volta_03 = NM_charset_to_utf8($this->voo_saida_origem_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_destino_volta_03
   function NM_export_voo_destino_volta_03()
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
         $this->voo_destino_volta_03 = html_entity_decode($this->voo_destino_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_volta_03 = strip_tags($this->voo_destino_volta_03);
         $this->voo_destino_volta_03 = NM_charset_to_utf8($this->voo_destino_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_chega_destino_volta_03
   function NM_export_voo_chega_destino_volta_03()
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
         $this->voo_chega_destino_volta_03 = html_entity_decode($this->voo_chega_destino_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_volta_03 = strip_tags($this->voo_chega_destino_volta_03);
         $this->voo_chega_destino_volta_03 = NM_charset_to_utf8($this->voo_chega_destino_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_cia_volta_03
   function NM_export_voo_cia_volta_03()
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
         $this->voo_cia_volta_03 = html_entity_decode($this->voo_cia_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_volta_03 = strip_tags($this->voo_cia_volta_03);
         $this->voo_cia_volta_03 = NM_charset_to_utf8($this->voo_cia_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_numvoo_volta_03
   function NM_export_voo_numvoo_volta_03()
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
         $this->voo_numvoo_volta_03 = html_entity_decode($this->voo_numvoo_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_volta_03 = strip_tags($this->voo_numvoo_volta_03);
         $this->voo_numvoo_volta_03 = NM_charset_to_utf8($this->voo_numvoo_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_localizador_volta_03
   function NM_export_voo_localizador_volta_03()
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
         $this->voo_localizador_volta_03 = html_entity_decode($this->voo_localizador_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_volta_03 = strip_tags($this->voo_localizador_volta_03);
         $this->voo_localizador_volta_03 = NM_charset_to_utf8($this->voo_localizador_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_etkt_volta_03
   function NM_export_voo_etkt_volta_03()
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
         $this->voo_etkt_volta_03 = html_entity_decode($this->voo_etkt_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_volta_03 = strip_tags($this->voo_etkt_volta_03);
         $this->voo_etkt_volta_03 = NM_charset_to_utf8($this->voo_etkt_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_assento_volta_03
   function NM_export_voo_assento_volta_03()
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
         $this->voo_assento_volta_03 = html_entity_decode($this->voo_assento_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_volta_03 = strip_tags($this->voo_assento_volta_03);
         $this->voo_assento_volta_03 = NM_charset_to_utf8($this->voo_assento_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_volta_03
   function NM_export_voo_comprado_bvt_volta_03()
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
         $this->voo_comprado_bvt_volta_03 = html_entity_decode($this->voo_comprado_bvt_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_volta_03 = strip_tags($this->voo_comprado_bvt_volta_03);
         $this->voo_comprado_bvt_volta_03 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_volta_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_volta_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_origem_volta_04
   function NM_export_voo_origem_volta_04()
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
         $this->voo_origem_volta_04 = html_entity_decode($this->voo_origem_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_volta_04 = strip_tags($this->voo_origem_volta_04);
         $this->voo_origem_volta_04 = NM_charset_to_utf8($this->voo_origem_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_origem_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_saida_origem_volta_04
   function NM_export_voo_saida_origem_volta_04()
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
         $this->voo_saida_origem_volta_04 = html_entity_decode($this->voo_saida_origem_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_volta_04 = strip_tags($this->voo_saida_origem_volta_04);
         $this->voo_saida_origem_volta_04 = NM_charset_to_utf8($this->voo_saida_origem_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_saida_origem_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_destino_volta_04
   function NM_export_voo_destino_volta_04()
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
         $this->voo_destino_volta_04 = html_entity_decode($this->voo_destino_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_volta_04 = strip_tags($this->voo_destino_volta_04);
         $this->voo_destino_volta_04 = NM_charset_to_utf8($this->voo_destino_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_destino_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_chega_destino_volta_04
   function NM_export_voo_chega_destino_volta_04()
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
         $this->voo_chega_destino_volta_04 = html_entity_decode($this->voo_chega_destino_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_volta_04 = strip_tags($this->voo_chega_destino_volta_04);
         $this->voo_chega_destino_volta_04 = NM_charset_to_utf8($this->voo_chega_destino_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_chega_destino_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_cia_volta_04
   function NM_export_voo_cia_volta_04()
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
         $this->voo_cia_volta_04 = html_entity_decode($this->voo_cia_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_volta_04 = strip_tags($this->voo_cia_volta_04);
         $this->voo_cia_volta_04 = NM_charset_to_utf8($this->voo_cia_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_cia_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_numvoo_volta_04
   function NM_export_voo_numvoo_volta_04()
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
         $this->voo_numvoo_volta_04 = html_entity_decode($this->voo_numvoo_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_volta_04 = strip_tags($this->voo_numvoo_volta_04);
         $this->voo_numvoo_volta_04 = NM_charset_to_utf8($this->voo_numvoo_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_numvoo_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_localizador_volta_04
   function NM_export_voo_localizador_volta_04()
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
         $this->voo_localizador_volta_04 = html_entity_decode($this->voo_localizador_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_volta_04 = strip_tags($this->voo_localizador_volta_04);
         $this->voo_localizador_volta_04 = NM_charset_to_utf8($this->voo_localizador_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_localizador_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_etkt_volta_04
   function NM_export_voo_etkt_volta_04()
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
         $this->voo_etkt_volta_04 = html_entity_decode($this->voo_etkt_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_volta_04 = strip_tags($this->voo_etkt_volta_04);
         $this->voo_etkt_volta_04 = NM_charset_to_utf8($this->voo_etkt_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_etkt_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_assento_volta_04
   function NM_export_voo_assento_volta_04()
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
         $this->voo_assento_volta_04 = html_entity_decode($this->voo_assento_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_volta_04 = strip_tags($this->voo_assento_volta_04);
         $this->voo_assento_volta_04 = NM_charset_to_utf8($this->voo_assento_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_assento_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_volta_04
   function NM_export_voo_comprado_bvt_volta_04()
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
         $this->voo_comprado_bvt_volta_04 = html_entity_decode($this->voo_comprado_bvt_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_volta_04 = strip_tags($this->voo_comprado_bvt_volta_04);
         $this->voo_comprado_bvt_volta_04 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_volta_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_comprado_bvt_volta_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- voo_observacoes_ida
   function NM_export_voo_observacoes_ida()
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
         $this->voo_observacoes_ida = html_entity_decode($this->voo_observacoes_ida, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_observacoes_ida = strip_tags($this->voo_observacoes_ida);
         $this->voo_observacoes_ida = NM_charset_to_utf8($this->voo_observacoes_ida);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_observacoes_ida, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->voo_observacoes_ida, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- logo_hospedagem
   function NM_export_logo_hospedagem()
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
         $this->logo_hospedagem = NM_charset_to_utf8($this->logo_hospedagem);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->logo_hospedagem, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->logo_hospedagem, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_fantasia_hotel_01
   function NM_export_hosp_fantasia_hotel_01()
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
         $this->hosp_fantasia_hotel_01 = html_entity_decode($this->hosp_fantasia_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_fantasia_hotel_01 = strip_tags($this->hosp_fantasia_hotel_01);
         $this->hosp_fantasia_hotel_01 = NM_charset_to_utf8($this->hosp_fantasia_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_fantasia_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_fantasia_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_logradouro_hotel_01
   function NM_export_hosp_logradouro_hotel_01()
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
         $this->hosp_logradouro_hotel_01 = html_entity_decode($this->hosp_logradouro_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_logradouro_hotel_01 = strip_tags($this->hosp_logradouro_hotel_01);
         $this->hosp_logradouro_hotel_01 = NM_charset_to_utf8($this->hosp_logradouro_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_logradouro_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_logradouro_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_numero_hotel_01
   function NM_export_hosp_numero_hotel_01()
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
         $this->hosp_numero_hotel_01 = html_entity_decode($this->hosp_numero_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_numero_hotel_01 = strip_tags($this->hosp_numero_hotel_01);
         $this->hosp_numero_hotel_01 = NM_charset_to_utf8($this->hosp_numero_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_numero_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_numero_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_complemento_hotel_01
   function NM_export_hosp_complemento_hotel_01()
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
         $this->hosp_complemento_hotel_01 = html_entity_decode($this->hosp_complemento_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_complemento_hotel_01 = strip_tags($this->hosp_complemento_hotel_01);
         $this->hosp_complemento_hotel_01 = NM_charset_to_utf8($this->hosp_complemento_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_complemento_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_complemento_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_municipio_hotel_01
   function NM_export_hosp_municipio_hotel_01()
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
         $this->hosp_municipio_hotel_01 = html_entity_decode($this->hosp_municipio_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_municipio_hotel_01 = strip_tags($this->hosp_municipio_hotel_01);
         $this->hosp_municipio_hotel_01 = NM_charset_to_utf8($this->hosp_municipio_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_municipio_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_municipio_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_uf_hotel_01
   function NM_export_hosp_uf_hotel_01()
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
         $this->hosp_uf_hotel_01 = html_entity_decode($this->hosp_uf_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_uf_hotel_01 = strip_tags($this->hosp_uf_hotel_01);
         $this->hosp_uf_hotel_01 = NM_charset_to_utf8($this->hosp_uf_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_uf_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_uf_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_cep_hotel_01
   function NM_export_hosp_cep_hotel_01()
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
         $this->hosp_cep_hotel_01 = html_entity_decode($this->hosp_cep_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_cep_hotel_01 = strip_tags($this->hosp_cep_hotel_01);
         $this->hosp_cep_hotel_01 = NM_charset_to_utf8($this->hosp_cep_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_cep_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_cep_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_pais_hotel_01
   function NM_export_hosp_pais_hotel_01()
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
         $this->hosp_pais_hotel_01 = html_entity_decode($this->hosp_pais_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_pais_hotel_01 = strip_tags($this->hosp_pais_hotel_01);
         $this->hosp_pais_hotel_01 = NM_charset_to_utf8($this->hosp_pais_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_pais_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_pais_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_acomodacao_hotel_01
   function NM_export_hosp_acomodacao_hotel_01()
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
         $this->hosp_acomodacao_hotel_01 = html_entity_decode($this->hosp_acomodacao_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_acomodacao_hotel_01 = strip_tags($this->hosp_acomodacao_hotel_01);
         $this->hosp_acomodacao_hotel_01 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_acomodacao_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_acomodacao_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_categoria_hotel_01
   function NM_export_hosp_categoria_hotel_01()
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
         $this->hosp_categoria_hotel_01 = html_entity_decode($this->hosp_categoria_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_categoria_hotel_01 = strip_tags($this->hosp_categoria_hotel_01);
         $this->hosp_categoria_hotel_01 = NM_charset_to_utf8($this->hosp_categoria_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_categoria_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_categoria_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_checkin_hotel_01
   function NM_export_hosp_checkin_hotel_01()
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
         $this->hosp_checkin_hotel_01 = html_entity_decode($this->hosp_checkin_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkin_hotel_01 = strip_tags($this->hosp_checkin_hotel_01);
         $this->hosp_checkin_hotel_01 = NM_charset_to_utf8($this->hosp_checkin_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkin_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkin_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckin_hotel_01
   function NM_export_hosp_hr_ckeckin_hotel_01()
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
         $this->hosp_hr_ckeckin_hotel_01 = html_entity_decode($this->hosp_hr_ckeckin_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckin_hotel_01 = strip_tags($this->hosp_hr_ckeckin_hotel_01);
         $this->hosp_hr_ckeckin_hotel_01 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckin_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckin_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_checkout_hotel_01
   function NM_export_hosp_checkout_hotel_01()
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
         $this->hosp_checkout_hotel_01 = html_entity_decode($this->hosp_checkout_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkout_hotel_01 = strip_tags($this->hosp_checkout_hotel_01);
         $this->hosp_checkout_hotel_01 = NM_charset_to_utf8($this->hosp_checkout_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkout_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkout_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckout_hotel_01
   function NM_export_hosp_hr_ckeckout_hotel_01()
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
         $this->hosp_hr_ckeckout_hotel_01 = html_entity_decode($this->hosp_hr_ckeckout_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckout_hotel_01 = strip_tags($this->hosp_hr_ckeckout_hotel_01);
         $this->hosp_hr_ckeckout_hotel_01 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckout_hotel_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckout_hotel_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_fantasia_hotel_02
   function NM_export_hosp_fantasia_hotel_02()
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
         $this->hosp_fantasia_hotel_02 = html_entity_decode($this->hosp_fantasia_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_fantasia_hotel_02 = strip_tags($this->hosp_fantasia_hotel_02);
         $this->hosp_fantasia_hotel_02 = NM_charset_to_utf8($this->hosp_fantasia_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_fantasia_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_fantasia_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_logradouro_hotel_02
   function NM_export_hosp_logradouro_hotel_02()
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
         $this->hosp_logradouro_hotel_02 = html_entity_decode($this->hosp_logradouro_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_logradouro_hotel_02 = strip_tags($this->hosp_logradouro_hotel_02);
         $this->hosp_logradouro_hotel_02 = NM_charset_to_utf8($this->hosp_logradouro_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_logradouro_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_logradouro_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_numero_hotel_02
   function NM_export_hosp_numero_hotel_02()
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
         $this->hosp_numero_hotel_02 = html_entity_decode($this->hosp_numero_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_numero_hotel_02 = strip_tags($this->hosp_numero_hotel_02);
         $this->hosp_numero_hotel_02 = NM_charset_to_utf8($this->hosp_numero_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_numero_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_numero_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_complemento_hotel_02
   function NM_export_hosp_complemento_hotel_02()
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
         $this->hosp_complemento_hotel_02 = html_entity_decode($this->hosp_complemento_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_complemento_hotel_02 = strip_tags($this->hosp_complemento_hotel_02);
         $this->hosp_complemento_hotel_02 = NM_charset_to_utf8($this->hosp_complemento_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_complemento_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_complemento_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_municipio_hotel_02
   function NM_export_hosp_municipio_hotel_02()
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
         $this->hosp_municipio_hotel_02 = html_entity_decode($this->hosp_municipio_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_municipio_hotel_02 = strip_tags($this->hosp_municipio_hotel_02);
         $this->hosp_municipio_hotel_02 = NM_charset_to_utf8($this->hosp_municipio_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_municipio_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_municipio_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_uf_hotel_02
   function NM_export_hosp_uf_hotel_02()
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
         $this->hosp_uf_hotel_02 = html_entity_decode($this->hosp_uf_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_uf_hotel_02 = strip_tags($this->hosp_uf_hotel_02);
         $this->hosp_uf_hotel_02 = NM_charset_to_utf8($this->hosp_uf_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_uf_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_uf_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_cep_hotel_02
   function NM_export_hosp_cep_hotel_02()
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
         $this->hosp_cep_hotel_02 = html_entity_decode($this->hosp_cep_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_cep_hotel_02 = strip_tags($this->hosp_cep_hotel_02);
         $this->hosp_cep_hotel_02 = NM_charset_to_utf8($this->hosp_cep_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_cep_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_cep_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_pais_hotel_02
   function NM_export_hosp_pais_hotel_02()
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
         $this->hosp_pais_hotel_02 = html_entity_decode($this->hosp_pais_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_pais_hotel_02 = strip_tags($this->hosp_pais_hotel_02);
         $this->hosp_pais_hotel_02 = NM_charset_to_utf8($this->hosp_pais_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_pais_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_pais_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_acomodacao_hotel_02
   function NM_export_hosp_acomodacao_hotel_02()
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
         $this->hosp_acomodacao_hotel_02 = html_entity_decode($this->hosp_acomodacao_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_acomodacao_hotel_02 = strip_tags($this->hosp_acomodacao_hotel_02);
         $this->hosp_acomodacao_hotel_02 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_acomodacao_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_acomodacao_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_categoria_hotel_02
   function NM_export_hosp_categoria_hotel_02()
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
         $this->hosp_categoria_hotel_02 = html_entity_decode($this->hosp_categoria_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_categoria_hotel_02 = strip_tags($this->hosp_categoria_hotel_02);
         $this->hosp_categoria_hotel_02 = NM_charset_to_utf8($this->hosp_categoria_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_categoria_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_categoria_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_checkin_hotel_02
   function NM_export_hosp_checkin_hotel_02()
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
         $this->hosp_checkin_hotel_02 = html_entity_decode($this->hosp_checkin_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkin_hotel_02 = strip_tags($this->hosp_checkin_hotel_02);
         $this->hosp_checkin_hotel_02 = NM_charset_to_utf8($this->hosp_checkin_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkin_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkin_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckin_hotel_02
   function NM_export_hosp_hr_ckeckin_hotel_02()
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
         $this->hosp_hr_ckeckin_hotel_02 = html_entity_decode($this->hosp_hr_ckeckin_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckin_hotel_02 = strip_tags($this->hosp_hr_ckeckin_hotel_02);
         $this->hosp_hr_ckeckin_hotel_02 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckin_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckin_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_checkout_hotel_02
   function NM_export_hosp_checkout_hotel_02()
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
         $this->hosp_checkout_hotel_02 = html_entity_decode($this->hosp_checkout_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkout_hotel_02 = strip_tags($this->hosp_checkout_hotel_02);
         $this->hosp_checkout_hotel_02 = NM_charset_to_utf8($this->hosp_checkout_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkout_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkout_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckout_hotel_02
   function NM_export_hosp_hr_ckeckout_hotel_02()
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
         $this->hosp_hr_ckeckout_hotel_02 = html_entity_decode($this->hosp_hr_ckeckout_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckout_hotel_02 = strip_tags($this->hosp_hr_ckeckout_hotel_02);
         $this->hosp_hr_ckeckout_hotel_02 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckout_hotel_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckout_hotel_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_fantasia_hotel_03
   function NM_export_hosp_fantasia_hotel_03()
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
         $this->hosp_fantasia_hotel_03 = html_entity_decode($this->hosp_fantasia_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_fantasia_hotel_03 = strip_tags($this->hosp_fantasia_hotel_03);
         $this->hosp_fantasia_hotel_03 = NM_charset_to_utf8($this->hosp_fantasia_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_fantasia_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_fantasia_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_logradouro_hotel_03
   function NM_export_hosp_logradouro_hotel_03()
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
         $this->hosp_logradouro_hotel_03 = html_entity_decode($this->hosp_logradouro_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_logradouro_hotel_03 = strip_tags($this->hosp_logradouro_hotel_03);
         $this->hosp_logradouro_hotel_03 = NM_charset_to_utf8($this->hosp_logradouro_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_logradouro_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_logradouro_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_numero_hotel_03
   function NM_export_hosp_numero_hotel_03()
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
         $this->hosp_numero_hotel_03 = html_entity_decode($this->hosp_numero_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_numero_hotel_03 = strip_tags($this->hosp_numero_hotel_03);
         $this->hosp_numero_hotel_03 = NM_charset_to_utf8($this->hosp_numero_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_numero_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_numero_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_complemento_hotel_03
   function NM_export_hosp_complemento_hotel_03()
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
         $this->hosp_complemento_hotel_03 = html_entity_decode($this->hosp_complemento_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_complemento_hotel_03 = strip_tags($this->hosp_complemento_hotel_03);
         $this->hosp_complemento_hotel_03 = NM_charset_to_utf8($this->hosp_complemento_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_complemento_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_complemento_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_municipio_hotel_03
   function NM_export_hosp_municipio_hotel_03()
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
         $this->hosp_municipio_hotel_03 = html_entity_decode($this->hosp_municipio_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_municipio_hotel_03 = strip_tags($this->hosp_municipio_hotel_03);
         $this->hosp_municipio_hotel_03 = NM_charset_to_utf8($this->hosp_municipio_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_municipio_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_municipio_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_uf_hotel_03
   function NM_export_hosp_uf_hotel_03()
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
         $this->hosp_uf_hotel_03 = html_entity_decode($this->hosp_uf_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_uf_hotel_03 = strip_tags($this->hosp_uf_hotel_03);
         $this->hosp_uf_hotel_03 = NM_charset_to_utf8($this->hosp_uf_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_uf_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_uf_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_cep_hotel_03
   function NM_export_hosp_cep_hotel_03()
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
         $this->hosp_cep_hotel_03 = html_entity_decode($this->hosp_cep_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_cep_hotel_03 = strip_tags($this->hosp_cep_hotel_03);
         $this->hosp_cep_hotel_03 = NM_charset_to_utf8($this->hosp_cep_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_cep_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_cep_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_pais_hotel_03
   function NM_export_hosp_pais_hotel_03()
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
         $this->hosp_pais_hotel_03 = html_entity_decode($this->hosp_pais_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_pais_hotel_03 = strip_tags($this->hosp_pais_hotel_03);
         $this->hosp_pais_hotel_03 = NM_charset_to_utf8($this->hosp_pais_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_pais_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_pais_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_acomodacao_hotel_03
   function NM_export_hosp_acomodacao_hotel_03()
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
         $this->hosp_acomodacao_hotel_03 = html_entity_decode($this->hosp_acomodacao_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_acomodacao_hotel_03 = strip_tags($this->hosp_acomodacao_hotel_03);
         $this->hosp_acomodacao_hotel_03 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_acomodacao_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_acomodacao_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_categoria_hotel_03
   function NM_export_hosp_categoria_hotel_03()
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
         $this->hosp_categoria_hotel_03 = html_entity_decode($this->hosp_categoria_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_categoria_hotel_03 = strip_tags($this->hosp_categoria_hotel_03);
         $this->hosp_categoria_hotel_03 = NM_charset_to_utf8($this->hosp_categoria_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_categoria_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_categoria_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_checkin_hotel_03
   function NM_export_hosp_checkin_hotel_03()
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
         $this->hosp_checkin_hotel_03 = html_entity_decode($this->hosp_checkin_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkin_hotel_03 = strip_tags($this->hosp_checkin_hotel_03);
         $this->hosp_checkin_hotel_03 = NM_charset_to_utf8($this->hosp_checkin_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkin_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkin_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckin_hotel_03
   function NM_export_hosp_hr_ckeckin_hotel_03()
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
         $this->hosp_hr_ckeckin_hotel_03 = html_entity_decode($this->hosp_hr_ckeckin_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckin_hotel_03 = strip_tags($this->hosp_hr_ckeckin_hotel_03);
         $this->hosp_hr_ckeckin_hotel_03 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckin_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckin_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_checkout_hotel_03
   function NM_export_hosp_checkout_hotel_03()
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
         $this->hosp_checkout_hotel_03 = html_entity_decode($this->hosp_checkout_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkout_hotel_03 = strip_tags($this->hosp_checkout_hotel_03);
         $this->hosp_checkout_hotel_03 = NM_charset_to_utf8($this->hosp_checkout_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkout_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkout_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckout_hotel_03
   function NM_export_hosp_hr_ckeckout_hotel_03()
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
         $this->hosp_hr_ckeckout_hotel_03 = html_entity_decode($this->hosp_hr_ckeckout_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckout_hotel_03 = strip_tags($this->hosp_hr_ckeckout_hotel_03);
         $this->hosp_hr_ckeckout_hotel_03 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckout_hotel_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckout_hotel_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_fantasia_hotel_04
   function NM_export_hosp_fantasia_hotel_04()
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
         $this->hosp_fantasia_hotel_04 = html_entity_decode($this->hosp_fantasia_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_fantasia_hotel_04 = strip_tags($this->hosp_fantasia_hotel_04);
         $this->hosp_fantasia_hotel_04 = NM_charset_to_utf8($this->hosp_fantasia_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_fantasia_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_fantasia_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_logradouro_hotel_04
   function NM_export_hosp_logradouro_hotel_04()
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
         $this->hosp_logradouro_hotel_04 = html_entity_decode($this->hosp_logradouro_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_logradouro_hotel_04 = strip_tags($this->hosp_logradouro_hotel_04);
         $this->hosp_logradouro_hotel_04 = NM_charset_to_utf8($this->hosp_logradouro_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_logradouro_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_logradouro_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_numero_hotel_04
   function NM_export_hosp_numero_hotel_04()
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
         $this->hosp_numero_hotel_04 = html_entity_decode($this->hosp_numero_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_numero_hotel_04 = strip_tags($this->hosp_numero_hotel_04);
         $this->hosp_numero_hotel_04 = NM_charset_to_utf8($this->hosp_numero_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_numero_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_numero_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_complemento_hotel_04
   function NM_export_hosp_complemento_hotel_04()
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
         $this->hosp_complemento_hotel_04 = html_entity_decode($this->hosp_complemento_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_complemento_hotel_04 = strip_tags($this->hosp_complemento_hotel_04);
         $this->hosp_complemento_hotel_04 = NM_charset_to_utf8($this->hosp_complemento_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_complemento_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_complemento_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_municipio_hotel_04
   function NM_export_hosp_municipio_hotel_04()
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
         $this->hosp_municipio_hotel_04 = html_entity_decode($this->hosp_municipio_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_municipio_hotel_04 = strip_tags($this->hosp_municipio_hotel_04);
         $this->hosp_municipio_hotel_04 = NM_charset_to_utf8($this->hosp_municipio_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_municipio_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_municipio_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_uf_hotel_04
   function NM_export_hosp_uf_hotel_04()
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
         $this->hosp_uf_hotel_04 = html_entity_decode($this->hosp_uf_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_uf_hotel_04 = strip_tags($this->hosp_uf_hotel_04);
         $this->hosp_uf_hotel_04 = NM_charset_to_utf8($this->hosp_uf_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_uf_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_uf_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_cep_hotel_04
   function NM_export_hosp_cep_hotel_04()
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
         $this->hosp_cep_hotel_04 = html_entity_decode($this->hosp_cep_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_cep_hotel_04 = strip_tags($this->hosp_cep_hotel_04);
         $this->hosp_cep_hotel_04 = NM_charset_to_utf8($this->hosp_cep_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_cep_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_cep_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_pais_hotel_04
   function NM_export_hosp_pais_hotel_04()
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
         $this->hosp_pais_hotel_04 = html_entity_decode($this->hosp_pais_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_pais_hotel_04 = strip_tags($this->hosp_pais_hotel_04);
         $this->hosp_pais_hotel_04 = NM_charset_to_utf8($this->hosp_pais_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_pais_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_pais_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_acomodacao_hotel_04
   function NM_export_hosp_acomodacao_hotel_04()
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
         $this->hosp_acomodacao_hotel_04 = html_entity_decode($this->hosp_acomodacao_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_acomodacao_hotel_04 = strip_tags($this->hosp_acomodacao_hotel_04);
         $this->hosp_acomodacao_hotel_04 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_acomodacao_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_acomodacao_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_categoria_hotel_04
   function NM_export_hosp_categoria_hotel_04()
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
         $this->hosp_categoria_hotel_04 = html_entity_decode($this->hosp_categoria_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_categoria_hotel_04 = strip_tags($this->hosp_categoria_hotel_04);
         $this->hosp_categoria_hotel_04 = NM_charset_to_utf8($this->hosp_categoria_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_categoria_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_categoria_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_checkin_hotel_04
   function NM_export_hosp_checkin_hotel_04()
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
         $this->hosp_checkin_hotel_04 = html_entity_decode($this->hosp_checkin_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkin_hotel_04 = strip_tags($this->hosp_checkin_hotel_04);
         $this->hosp_checkin_hotel_04 = NM_charset_to_utf8($this->hosp_checkin_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkin_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkin_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckin_hotel_04
   function NM_export_hosp_hr_ckeckin_hotel_04()
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
         $this->hosp_hr_ckeckin_hotel_04 = html_entity_decode($this->hosp_hr_ckeckin_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckin_hotel_04 = strip_tags($this->hosp_hr_ckeckin_hotel_04);
         $this->hosp_hr_ckeckin_hotel_04 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckin_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckin_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_checkout_hotel_04
   function NM_export_hosp_checkout_hotel_04()
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
         $this->hosp_checkout_hotel_04 = html_entity_decode($this->hosp_checkout_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkout_hotel_04 = strip_tags($this->hosp_checkout_hotel_04);
         $this->hosp_checkout_hotel_04 = NM_charset_to_utf8($this->hosp_checkout_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkout_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_checkout_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckout_hotel_04
   function NM_export_hosp_hr_ckeckout_hotel_04()
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
         $this->hosp_hr_ckeckout_hotel_04 = html_entity_decode($this->hosp_hr_ckeckout_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckout_hotel_04 = strip_tags($this->hosp_hr_ckeckout_hotel_04);
         $this->hosp_hr_ckeckout_hotel_04 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckout_hotel_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_hr_ckeckout_hotel_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- hosp_observacoes
   function NM_export_hosp_observacoes()
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
         $this->hosp_observacoes = html_entity_decode($this->hosp_observacoes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_observacoes = strip_tags($this->hosp_observacoes);
         $this->hosp_observacoes = NM_charset_to_utf8($this->hosp_observacoes);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_observacoes, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->hosp_observacoes, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- logo_transfer
   function NM_export_logo_transfer()
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
         $this->logo_transfer = NM_charset_to_utf8($this->logo_transfer);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->logo_transfer, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->logo_transfer, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- transfer_in_observacoes
   function NM_export_transfer_in_observacoes()
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
         $this->transfer_in_observacoes = html_entity_decode($this->transfer_in_observacoes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->transfer_in_observacoes = strip_tags($this->transfer_in_observacoes);
         $this->transfer_in_observacoes = NM_charset_to_utf8($this->transfer_in_observacoes);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->transfer_in_observacoes, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->transfer_in_observacoes, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- transfer_out_observacoes
   function NM_export_transfer_out_observacoes()
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
         $this->transfer_out_observacoes = html_entity_decode($this->transfer_out_observacoes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->transfer_out_observacoes = strip_tags($this->transfer_out_observacoes);
         $this->transfer_out_observacoes = NM_charset_to_utf8($this->transfer_out_observacoes);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->transfer_out_observacoes, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->transfer_out_observacoes, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- acompanhante_011
   function NM_export_acompanhante_011()
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
         $this->acompanhante_011 = html_entity_decode($this->acompanhante_011, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_011 = strip_tags($this->acompanhante_011);
         $this->acompanhante_011 = NM_charset_to_utf8($this->acompanhante_011);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_011, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_011, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_acomp_011
   function NM_export_participante_acomp_011()
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
         $this->participante_acomp_011 = html_entity_decode($this->participante_acomp_011, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_011 = strip_tags($this->participante_acomp_011);
         $this->participante_acomp_011 = NM_charset_to_utf8($this->participante_acomp_011);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_011, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_011, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- acompanhante_012
   function NM_export_acompanhante_012()
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
         $this->acompanhante_012 = html_entity_decode($this->acompanhante_012, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_012 = strip_tags($this->acompanhante_012);
         $this->acompanhante_012 = NM_charset_to_utf8($this->acompanhante_012);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_012, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_012, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_acomp_012
   function NM_export_participante_acomp_012()
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
         $this->participante_acomp_012 = html_entity_decode($this->participante_acomp_012, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_012 = strip_tags($this->participante_acomp_012);
         $this->participante_acomp_012 = NM_charset_to_utf8($this->participante_acomp_012);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_012, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_012, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- acompanhante_013
   function NM_export_acompanhante_013()
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
         $this->acompanhante_013 = html_entity_decode($this->acompanhante_013, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_013 = strip_tags($this->acompanhante_013);
         $this->acompanhante_013 = NM_charset_to_utf8($this->acompanhante_013);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_013, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_013, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_acomp_013
   function NM_export_participante_acomp_013()
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
         $this->participante_acomp_013 = html_entity_decode($this->participante_acomp_013, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_013 = strip_tags($this->participante_acomp_013);
         $this->participante_acomp_013 = NM_charset_to_utf8($this->participante_acomp_013);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_013, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_013, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- acompanhante_021
   function NM_export_acompanhante_021()
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
         $this->acompanhante_021 = html_entity_decode($this->acompanhante_021, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_021 = strip_tags($this->acompanhante_021);
         $this->acompanhante_021 = NM_charset_to_utf8($this->acompanhante_021);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_021, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_021, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_acomp_021
   function NM_export_participante_acomp_021()
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
         $this->participante_acomp_021 = html_entity_decode($this->participante_acomp_021, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_021 = strip_tags($this->participante_acomp_021);
         $this->participante_acomp_021 = NM_charset_to_utf8($this->participante_acomp_021);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_021, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_021, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- acompanhante_022
   function NM_export_acompanhante_022()
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
         $this->acompanhante_022 = html_entity_decode($this->acompanhante_022, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_022 = strip_tags($this->acompanhante_022);
         $this->acompanhante_022 = NM_charset_to_utf8($this->acompanhante_022);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_022, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_022, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_acomp_022
   function NM_export_participante_acomp_022()
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
         $this->participante_acomp_022 = html_entity_decode($this->participante_acomp_022, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_022 = strip_tags($this->participante_acomp_022);
         $this->participante_acomp_022 = NM_charset_to_utf8($this->participante_acomp_022);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_022, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_022, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- acompanhante_023
   function NM_export_acompanhante_023()
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
         $this->acompanhante_023 = html_entity_decode($this->acompanhante_023, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_023 = strip_tags($this->acompanhante_023);
         $this->acompanhante_023 = NM_charset_to_utf8($this->acompanhante_023);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_023, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_023, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_acomp_023
   function NM_export_participante_acomp_023()
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
         $this->participante_acomp_023 = html_entity_decode($this->participante_acomp_023, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_023 = strip_tags($this->participante_acomp_023);
         $this->participante_acomp_023 = NM_charset_to_utf8($this->participante_acomp_023);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_023, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_023, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- acompanhante_031
   function NM_export_acompanhante_031()
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
         $this->acompanhante_031 = html_entity_decode($this->acompanhante_031, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_031 = strip_tags($this->acompanhante_031);
         $this->acompanhante_031 = NM_charset_to_utf8($this->acompanhante_031);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_031, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_031, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_acomp_031
   function NM_export_participante_acomp_031()
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
         $this->participante_acomp_031 = html_entity_decode($this->participante_acomp_031, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_031 = strip_tags($this->participante_acomp_031);
         $this->participante_acomp_031 = NM_charset_to_utf8($this->participante_acomp_031);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_031, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_031, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- acompanhante_032
   function NM_export_acompanhante_032()
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
         $this->acompanhante_032 = html_entity_decode($this->acompanhante_032, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_032 = strip_tags($this->acompanhante_032);
         $this->acompanhante_032 = NM_charset_to_utf8($this->acompanhante_032);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_032, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_032, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_acomp_032
   function NM_export_participante_acomp_032()
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
         $this->participante_acomp_032 = html_entity_decode($this->participante_acomp_032, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_032 = strip_tags($this->participante_acomp_032);
         $this->participante_acomp_032 = NM_charset_to_utf8($this->participante_acomp_032);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_032, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_032, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- acompanhante_033
   function NM_export_acompanhante_033()
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
         $this->acompanhante_033 = html_entity_decode($this->acompanhante_033, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_033 = strip_tags($this->acompanhante_033);
         $this->acompanhante_033 = NM_charset_to_utf8($this->acompanhante_033);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_033, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->acompanhante_033, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_acomp_033
   function NM_export_participante_acomp_033()
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
         $this->participante_acomp_033 = html_entity_decode($this->participante_acomp_033, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_033 = strip_tags($this->participante_acomp_033);
         $this->participante_acomp_033 = NM_charset_to_utf8($this->participante_acomp_033);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_033, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_acomp_033, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- opcional_01
   function NM_export_opcional_01()
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
         $this->opcional_01 = html_entity_decode($this->opcional_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->opcional_01 = strip_tags($this->opcional_01);
         $this->opcional_01 = NM_charset_to_utf8($this->opcional_01);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->opcional_01, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->opcional_01, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- opcional_02
   function NM_export_opcional_02()
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
         $this->opcional_02 = html_entity_decode($this->opcional_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->opcional_02 = strip_tags($this->opcional_02);
         $this->opcional_02 = NM_charset_to_utf8($this->opcional_02);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->opcional_02, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->opcional_02, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- opcional_03
   function NM_export_opcional_03()
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
         $this->opcional_03 = html_entity_decode($this->opcional_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->opcional_03 = strip_tags($this->opcional_03);
         $this->opcional_03 = NM_charset_to_utf8($this->opcional_03);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->opcional_03, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->opcional_03, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- opcional_04
   function NM_export_opcional_04()
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
         $this->opcional_04 = html_entity_decode($this->opcional_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->opcional_04 = strip_tags($this->opcional_04);
         $this->opcional_04 = NM_charset_to_utf8($this->opcional_04);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->opcional_04, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->opcional_04, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- observacao_final
   function NM_export_observacao_final()
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
         $this->observacao_final = html_entity_decode($this->observacao_final, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->observacao_final = strip_tags($this->observacao_final);
         $this->observacao_final = NM_charset_to_utf8($this->observacao_final);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->observacao_final, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->observacao_final, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- participante_obs
   function NM_export_participante_obs()
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
         $this->participante_obs = html_entity_decode($this->participante_obs, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_obs = strip_tags($this->participante_obs);
         $this->participante_obs = NM_charset_to_utf8($this->participante_obs);
         if ($this->Use_phpspreadsheet) {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_obs, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
         }
         else {
             $this->Nm_ActiveSheet->setCellValueExplicit($current_cell_ref . $this->Xls_row, $this->participante_obs, PHPExcel_Cell_DataType::TYPE_STRING);
         }
         $this->Xls_col++;
   }
   //----- logo_bvt
   function NM_sub_cons_logo_bvt()
   {
         $this->logo_bvt = NM_charset_to_utf8($this->logo_bvt);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->logo_bvt;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- teste
   function NM_sub_cons_teste()
   {
         $this->teste = html_entity_decode($this->teste, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->teste = strip_tags($this->teste);
         $this->teste = NM_charset_to_utf8($this->teste);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->teste;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- simples_mensagem
   function NM_sub_cons_simples_mensagem()
   {
         $this->simples_mensagem = html_entity_decode($this->simples_mensagem, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->simples_mensagem = strip_tags($this->simples_mensagem);
         $this->simples_mensagem = NM_charset_to_utf8($this->simples_mensagem);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->simples_mensagem;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- logo_aereo
   function NM_sub_cons_logo_aereo()
   {
         $this->logo_aereo = NM_charset_to_utf8($this->logo_aereo);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->logo_aereo;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_origem_ida_01
   function NM_sub_cons_voo_origem_ida_01()
   {
         $this->voo_origem_ida_01 = html_entity_decode($this->voo_origem_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_ida_01 = strip_tags($this->voo_origem_ida_01);
         $this->voo_origem_ida_01 = NM_charset_to_utf8($this->voo_origem_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_origem_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_saida_origem_ida_01
   function NM_sub_cons_voo_saida_origem_ida_01()
   {
         $this->voo_saida_origem_ida_01 = html_entity_decode($this->voo_saida_origem_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_ida_01 = strip_tags($this->voo_saida_origem_ida_01);
         $this->voo_saida_origem_ida_01 = NM_charset_to_utf8($this->voo_saida_origem_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_saida_origem_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_destino_ida_01
   function NM_sub_cons_voo_destino_ida_01()
   {
         $this->voo_destino_ida_01 = html_entity_decode($this->voo_destino_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_ida_01 = strip_tags($this->voo_destino_ida_01);
         $this->voo_destino_ida_01 = NM_charset_to_utf8($this->voo_destino_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_destino_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_chega_destino_ida_01
   function NM_sub_cons_voo_chega_destino_ida_01()
   {
         $this->voo_chega_destino_ida_01 = html_entity_decode($this->voo_chega_destino_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_ida_01 = strip_tags($this->voo_chega_destino_ida_01);
         $this->voo_chega_destino_ida_01 = NM_charset_to_utf8($this->voo_chega_destino_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_chega_destino_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_cia_ida_01
   function NM_sub_cons_voo_cia_ida_01()
   {
         $this->voo_cia_ida_01 = html_entity_decode($this->voo_cia_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_ida_01 = NM_charset_to_utf8($this->voo_cia_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_cia_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_numvoo_ida_01
   function NM_sub_cons_voo_numvoo_ida_01()
   {
         $this->voo_numvoo_ida_01 = html_entity_decode($this->voo_numvoo_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_ida_01 = strip_tags($this->voo_numvoo_ida_01);
         $this->voo_numvoo_ida_01 = NM_charset_to_utf8($this->voo_numvoo_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_numvoo_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_localizador_ida_01
   function NM_sub_cons_voo_localizador_ida_01()
   {
         $this->voo_localizador_ida_01 = html_entity_decode($this->voo_localizador_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_ida_01 = strip_tags($this->voo_localizador_ida_01);
         $this->voo_localizador_ida_01 = NM_charset_to_utf8($this->voo_localizador_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_localizador_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_etkt_ida_01
   function NM_sub_cons_voo_etkt_ida_01()
   {
         $this->voo_etkt_ida_01 = html_entity_decode($this->voo_etkt_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_ida_01 = strip_tags($this->voo_etkt_ida_01);
         $this->voo_etkt_ida_01 = NM_charset_to_utf8($this->voo_etkt_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_etkt_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_assento_ida_01
   function NM_sub_cons_voo_assento_ida_01()
   {
         $this->voo_assento_ida_01 = html_entity_decode($this->voo_assento_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_ida_01 = strip_tags($this->voo_assento_ida_01);
         $this->voo_assento_ida_01 = NM_charset_to_utf8($this->voo_assento_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_assento_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_ida_01
   function NM_sub_cons_voo_comprado_bvt_ida_01()
   {
         $this->voo_comprado_bvt_ida_01 = html_entity_decode($this->voo_comprado_bvt_ida_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_ida_01 = strip_tags($this->voo_comprado_bvt_ida_01);
         $this->voo_comprado_bvt_ida_01 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_comprado_bvt_ida_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_origem_ida_02
   function NM_sub_cons_voo_origem_ida_02()
   {
         $this->voo_origem_ida_02 = html_entity_decode($this->voo_origem_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_ida_02 = strip_tags($this->voo_origem_ida_02);
         $this->voo_origem_ida_02 = NM_charset_to_utf8($this->voo_origem_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_origem_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_saida_origem_ida_02
   function NM_sub_cons_voo_saida_origem_ida_02()
   {
         $this->voo_saida_origem_ida_02 = html_entity_decode($this->voo_saida_origem_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_ida_02 = strip_tags($this->voo_saida_origem_ida_02);
         $this->voo_saida_origem_ida_02 = NM_charset_to_utf8($this->voo_saida_origem_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_saida_origem_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_destino_ida_02
   function NM_sub_cons_voo_destino_ida_02()
   {
         $this->voo_destino_ida_02 = html_entity_decode($this->voo_destino_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_ida_02 = strip_tags($this->voo_destino_ida_02);
         $this->voo_destino_ida_02 = NM_charset_to_utf8($this->voo_destino_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_destino_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_chega_destino_ida_02
   function NM_sub_cons_voo_chega_destino_ida_02()
   {
         $this->voo_chega_destino_ida_02 = html_entity_decode($this->voo_chega_destino_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_ida_02 = strip_tags($this->voo_chega_destino_ida_02);
         $this->voo_chega_destino_ida_02 = NM_charset_to_utf8($this->voo_chega_destino_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_chega_destino_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_cia_ida_02
   function NM_sub_cons_voo_cia_ida_02()
   {
         $this->voo_cia_ida_02 = html_entity_decode($this->voo_cia_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_ida_02 = strip_tags($this->voo_cia_ida_02);
         $this->voo_cia_ida_02 = NM_charset_to_utf8($this->voo_cia_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_cia_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_numvoo_ida_02
   function NM_sub_cons_voo_numvoo_ida_02()
   {
         $this->voo_numvoo_ida_02 = html_entity_decode($this->voo_numvoo_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_ida_02 = strip_tags($this->voo_numvoo_ida_02);
         $this->voo_numvoo_ida_02 = NM_charset_to_utf8($this->voo_numvoo_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_numvoo_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_localizador_ida_02
   function NM_sub_cons_voo_localizador_ida_02()
   {
         $this->voo_localizador_ida_02 = html_entity_decode($this->voo_localizador_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_ida_02 = strip_tags($this->voo_localizador_ida_02);
         $this->voo_localizador_ida_02 = NM_charset_to_utf8($this->voo_localizador_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_localizador_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_etkt_ida_02
   function NM_sub_cons_voo_etkt_ida_02()
   {
         $this->voo_etkt_ida_02 = html_entity_decode($this->voo_etkt_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_ida_02 = strip_tags($this->voo_etkt_ida_02);
         $this->voo_etkt_ida_02 = NM_charset_to_utf8($this->voo_etkt_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_etkt_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_assento_ida_02
   function NM_sub_cons_voo_assento_ida_02()
   {
         $this->voo_assento_ida_02 = html_entity_decode($this->voo_assento_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_ida_02 = strip_tags($this->voo_assento_ida_02);
         $this->voo_assento_ida_02 = NM_charset_to_utf8($this->voo_assento_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_assento_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_ida_02
   function NM_sub_cons_voo_comprado_bvt_ida_02()
   {
         $this->voo_comprado_bvt_ida_02 = html_entity_decode($this->voo_comprado_bvt_ida_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_ida_02 = strip_tags($this->voo_comprado_bvt_ida_02);
         $this->voo_comprado_bvt_ida_02 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_comprado_bvt_ida_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_origem_ida_03
   function NM_sub_cons_voo_origem_ida_03()
   {
         $this->voo_origem_ida_03 = html_entity_decode($this->voo_origem_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_ida_03 = strip_tags($this->voo_origem_ida_03);
         $this->voo_origem_ida_03 = NM_charset_to_utf8($this->voo_origem_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_origem_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_saida_origem_ida_03
   function NM_sub_cons_voo_saida_origem_ida_03()
   {
         $this->voo_saida_origem_ida_03 = html_entity_decode($this->voo_saida_origem_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_ida_03 = strip_tags($this->voo_saida_origem_ida_03);
         $this->voo_saida_origem_ida_03 = NM_charset_to_utf8($this->voo_saida_origem_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_saida_origem_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_destino_ida_03
   function NM_sub_cons_voo_destino_ida_03()
   {
         $this->voo_destino_ida_03 = html_entity_decode($this->voo_destino_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_ida_03 = strip_tags($this->voo_destino_ida_03);
         $this->voo_destino_ida_03 = NM_charset_to_utf8($this->voo_destino_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_destino_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_chega_destino_ida_03
   function NM_sub_cons_voo_chega_destino_ida_03()
   {
         $this->voo_chega_destino_ida_03 = html_entity_decode($this->voo_chega_destino_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_ida_03 = strip_tags($this->voo_chega_destino_ida_03);
         $this->voo_chega_destino_ida_03 = NM_charset_to_utf8($this->voo_chega_destino_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_chega_destino_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_cia_ida_03
   function NM_sub_cons_voo_cia_ida_03()
   {
         $this->voo_cia_ida_03 = html_entity_decode($this->voo_cia_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_ida_03 = strip_tags($this->voo_cia_ida_03);
         $this->voo_cia_ida_03 = NM_charset_to_utf8($this->voo_cia_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_cia_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_numvoo_ida_03
   function NM_sub_cons_voo_numvoo_ida_03()
   {
         $this->voo_numvoo_ida_03 = html_entity_decode($this->voo_numvoo_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_ida_03 = strip_tags($this->voo_numvoo_ida_03);
         $this->voo_numvoo_ida_03 = NM_charset_to_utf8($this->voo_numvoo_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_numvoo_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_localizador_ida_03
   function NM_sub_cons_voo_localizador_ida_03()
   {
         $this->voo_localizador_ida_03 = html_entity_decode($this->voo_localizador_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_ida_03 = strip_tags($this->voo_localizador_ida_03);
         $this->voo_localizador_ida_03 = NM_charset_to_utf8($this->voo_localizador_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_localizador_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_etkt_ida_03
   function NM_sub_cons_voo_etkt_ida_03()
   {
         $this->voo_etkt_ida_03 = html_entity_decode($this->voo_etkt_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_ida_03 = strip_tags($this->voo_etkt_ida_03);
         $this->voo_etkt_ida_03 = NM_charset_to_utf8($this->voo_etkt_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_etkt_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_assento_ida_03
   function NM_sub_cons_voo_assento_ida_03()
   {
         $this->voo_assento_ida_03 = html_entity_decode($this->voo_assento_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_ida_03 = strip_tags($this->voo_assento_ida_03);
         $this->voo_assento_ida_03 = NM_charset_to_utf8($this->voo_assento_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_assento_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_ida_03
   function NM_sub_cons_voo_comprado_bvt_ida_03()
   {
         $this->voo_comprado_bvt_ida_03 = html_entity_decode($this->voo_comprado_bvt_ida_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_ida_03 = strip_tags($this->voo_comprado_bvt_ida_03);
         $this->voo_comprado_bvt_ida_03 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_comprado_bvt_ida_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_origem_ida_04
   function NM_sub_cons_voo_origem_ida_04()
   {
         $this->voo_origem_ida_04 = html_entity_decode($this->voo_origem_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_ida_04 = strip_tags($this->voo_origem_ida_04);
         $this->voo_origem_ida_04 = NM_charset_to_utf8($this->voo_origem_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_origem_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_saida_origem_ida_04
   function NM_sub_cons_voo_saida_origem_ida_04()
   {
         $this->voo_saida_origem_ida_04 = html_entity_decode($this->voo_saida_origem_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_ida_04 = strip_tags($this->voo_saida_origem_ida_04);
         $this->voo_saida_origem_ida_04 = NM_charset_to_utf8($this->voo_saida_origem_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_saida_origem_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_destino_ida_04
   function NM_sub_cons_voo_destino_ida_04()
   {
         $this->voo_destino_ida_04 = html_entity_decode($this->voo_destino_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_ida_04 = strip_tags($this->voo_destino_ida_04);
         $this->voo_destino_ida_04 = NM_charset_to_utf8($this->voo_destino_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_destino_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_chega_destino_ida_04
   function NM_sub_cons_voo_chega_destino_ida_04()
   {
         $this->voo_chega_destino_ida_04 = html_entity_decode($this->voo_chega_destino_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_ida_04 = strip_tags($this->voo_chega_destino_ida_04);
         $this->voo_chega_destino_ida_04 = NM_charset_to_utf8($this->voo_chega_destino_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_chega_destino_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_cia_ida_04
   function NM_sub_cons_voo_cia_ida_04()
   {
         $this->voo_cia_ida_04 = html_entity_decode($this->voo_cia_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_ida_04 = strip_tags($this->voo_cia_ida_04);
         $this->voo_cia_ida_04 = NM_charset_to_utf8($this->voo_cia_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_cia_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_numvoo_ida_04
   function NM_sub_cons_voo_numvoo_ida_04()
   {
         $this->voo_numvoo_ida_04 = html_entity_decode($this->voo_numvoo_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_ida_04 = strip_tags($this->voo_numvoo_ida_04);
         $this->voo_numvoo_ida_04 = NM_charset_to_utf8($this->voo_numvoo_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_numvoo_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_localizador_ida_04
   function NM_sub_cons_voo_localizador_ida_04()
   {
         $this->voo_localizador_ida_04 = html_entity_decode($this->voo_localizador_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_ida_04 = strip_tags($this->voo_localizador_ida_04);
         $this->voo_localizador_ida_04 = NM_charset_to_utf8($this->voo_localizador_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_localizador_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_etkt_ida_04
   function NM_sub_cons_voo_etkt_ida_04()
   {
         $this->voo_etkt_ida_04 = html_entity_decode($this->voo_etkt_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_ida_04 = strip_tags($this->voo_etkt_ida_04);
         $this->voo_etkt_ida_04 = NM_charset_to_utf8($this->voo_etkt_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_etkt_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_assento_ida_04
   function NM_sub_cons_voo_assento_ida_04()
   {
         $this->voo_assento_ida_04 = html_entity_decode($this->voo_assento_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_ida_04 = strip_tags($this->voo_assento_ida_04);
         $this->voo_assento_ida_04 = NM_charset_to_utf8($this->voo_assento_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_assento_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_ida_04
   function NM_sub_cons_voo_comprado_bvt_ida_04()
   {
         $this->voo_comprado_bvt_ida_04 = html_entity_decode($this->voo_comprado_bvt_ida_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_ida_04 = strip_tags($this->voo_comprado_bvt_ida_04);
         $this->voo_comprado_bvt_ida_04 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_comprado_bvt_ida_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_origem_volta_01
   function NM_sub_cons_voo_origem_volta_01()
   {
         $this->voo_origem_volta_01 = html_entity_decode($this->voo_origem_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_volta_01 = strip_tags($this->voo_origem_volta_01);
         $this->voo_origem_volta_01 = NM_charset_to_utf8($this->voo_origem_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_origem_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_saida_origem_volta_01
   function NM_sub_cons_voo_saida_origem_volta_01()
   {
         $this->voo_saida_origem_volta_01 = html_entity_decode($this->voo_saida_origem_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_volta_01 = strip_tags($this->voo_saida_origem_volta_01);
         $this->voo_saida_origem_volta_01 = NM_charset_to_utf8($this->voo_saida_origem_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_saida_origem_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_destino_volta_01
   function NM_sub_cons_voo_destino_volta_01()
   {
         $this->voo_destino_volta_01 = html_entity_decode($this->voo_destino_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_volta_01 = strip_tags($this->voo_destino_volta_01);
         $this->voo_destino_volta_01 = NM_charset_to_utf8($this->voo_destino_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_destino_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_chega_destino_volta_01
   function NM_sub_cons_voo_chega_destino_volta_01()
   {
         $this->voo_chega_destino_volta_01 = html_entity_decode($this->voo_chega_destino_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_volta_01 = strip_tags($this->voo_chega_destino_volta_01);
         $this->voo_chega_destino_volta_01 = NM_charset_to_utf8($this->voo_chega_destino_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_chega_destino_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_cia_volta_01
   function NM_sub_cons_voo_cia_volta_01()
   {
         $this->voo_cia_volta_01 = html_entity_decode($this->voo_cia_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_volta_01 = strip_tags($this->voo_cia_volta_01);
         $this->voo_cia_volta_01 = NM_charset_to_utf8($this->voo_cia_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_cia_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_numvoo_volta_01
   function NM_sub_cons_voo_numvoo_volta_01()
   {
         $this->voo_numvoo_volta_01 = html_entity_decode($this->voo_numvoo_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_volta_01 = strip_tags($this->voo_numvoo_volta_01);
         $this->voo_numvoo_volta_01 = NM_charset_to_utf8($this->voo_numvoo_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_numvoo_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_localizador_volta_01
   function NM_sub_cons_voo_localizador_volta_01()
   {
         $this->voo_localizador_volta_01 = html_entity_decode($this->voo_localizador_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_volta_01 = strip_tags($this->voo_localizador_volta_01);
         $this->voo_localizador_volta_01 = NM_charset_to_utf8($this->voo_localizador_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_localizador_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_etkt_volta_01
   function NM_sub_cons_voo_etkt_volta_01()
   {
         $this->voo_etkt_volta_01 = html_entity_decode($this->voo_etkt_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_volta_01 = strip_tags($this->voo_etkt_volta_01);
         $this->voo_etkt_volta_01 = NM_charset_to_utf8($this->voo_etkt_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_etkt_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_assento_volta_01
   function NM_sub_cons_voo_assento_volta_01()
   {
         $this->voo_assento_volta_01 = html_entity_decode($this->voo_assento_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_volta_01 = strip_tags($this->voo_assento_volta_01);
         $this->voo_assento_volta_01 = NM_charset_to_utf8($this->voo_assento_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_assento_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_volta_01
   function NM_sub_cons_voo_comprado_bvt_volta_01()
   {
         $this->voo_comprado_bvt_volta_01 = html_entity_decode($this->voo_comprado_bvt_volta_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_volta_01 = strip_tags($this->voo_comprado_bvt_volta_01);
         $this->voo_comprado_bvt_volta_01 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_comprado_bvt_volta_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_origem_volta_02
   function NM_sub_cons_voo_origem_volta_02()
   {
         $this->voo_origem_volta_02 = html_entity_decode($this->voo_origem_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_volta_02 = strip_tags($this->voo_origem_volta_02);
         $this->voo_origem_volta_02 = NM_charset_to_utf8($this->voo_origem_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_origem_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_saida_origem_volta_02
   function NM_sub_cons_voo_saida_origem_volta_02()
   {
         $this->voo_saida_origem_volta_02 = html_entity_decode($this->voo_saida_origem_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_volta_02 = strip_tags($this->voo_saida_origem_volta_02);
         $this->voo_saida_origem_volta_02 = NM_charset_to_utf8($this->voo_saida_origem_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_saida_origem_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_destino_volta_02
   function NM_sub_cons_voo_destino_volta_02()
   {
         $this->voo_destino_volta_02 = html_entity_decode($this->voo_destino_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_volta_02 = strip_tags($this->voo_destino_volta_02);
         $this->voo_destino_volta_02 = NM_charset_to_utf8($this->voo_destino_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_destino_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_chega_destino_volta_02
   function NM_sub_cons_voo_chega_destino_volta_02()
   {
         $this->voo_chega_destino_volta_02 = html_entity_decode($this->voo_chega_destino_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_volta_02 = strip_tags($this->voo_chega_destino_volta_02);
         $this->voo_chega_destino_volta_02 = NM_charset_to_utf8($this->voo_chega_destino_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_chega_destino_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_cia_volta_02
   function NM_sub_cons_voo_cia_volta_02()
   {
         $this->voo_cia_volta_02 = html_entity_decode($this->voo_cia_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_volta_02 = strip_tags($this->voo_cia_volta_02);
         $this->voo_cia_volta_02 = NM_charset_to_utf8($this->voo_cia_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_cia_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_numvoo_volta_02
   function NM_sub_cons_voo_numvoo_volta_02()
   {
         $this->voo_numvoo_volta_02 = html_entity_decode($this->voo_numvoo_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_volta_02 = strip_tags($this->voo_numvoo_volta_02);
         $this->voo_numvoo_volta_02 = NM_charset_to_utf8($this->voo_numvoo_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_numvoo_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_localizador_volta_02
   function NM_sub_cons_voo_localizador_volta_02()
   {
         $this->voo_localizador_volta_02 = html_entity_decode($this->voo_localizador_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_volta_02 = strip_tags($this->voo_localizador_volta_02);
         $this->voo_localizador_volta_02 = NM_charset_to_utf8($this->voo_localizador_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_localizador_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_etkt_volta_02
   function NM_sub_cons_voo_etkt_volta_02()
   {
         $this->voo_etkt_volta_02 = html_entity_decode($this->voo_etkt_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_volta_02 = strip_tags($this->voo_etkt_volta_02);
         $this->voo_etkt_volta_02 = NM_charset_to_utf8($this->voo_etkt_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_etkt_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_assento_volta_02
   function NM_sub_cons_voo_assento_volta_02()
   {
         $this->voo_assento_volta_02 = html_entity_decode($this->voo_assento_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_volta_02 = strip_tags($this->voo_assento_volta_02);
         $this->voo_assento_volta_02 = NM_charset_to_utf8($this->voo_assento_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_assento_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_volta_02
   function NM_sub_cons_voo_comprado_bvt_volta_02()
   {
         $this->voo_comprado_bvt_volta_02 = html_entity_decode($this->voo_comprado_bvt_volta_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_volta_02 = strip_tags($this->voo_comprado_bvt_volta_02);
         $this->voo_comprado_bvt_volta_02 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_comprado_bvt_volta_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_origem_volta_03
   function NM_sub_cons_voo_origem_volta_03()
   {
         $this->voo_origem_volta_03 = html_entity_decode($this->voo_origem_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_volta_03 = strip_tags($this->voo_origem_volta_03);
         $this->voo_origem_volta_03 = NM_charset_to_utf8($this->voo_origem_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_origem_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_saida_origem_volta_03
   function NM_sub_cons_voo_saida_origem_volta_03()
   {
         $this->voo_saida_origem_volta_03 = html_entity_decode($this->voo_saida_origem_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_volta_03 = strip_tags($this->voo_saida_origem_volta_03);
         $this->voo_saida_origem_volta_03 = NM_charset_to_utf8($this->voo_saida_origem_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_saida_origem_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_destino_volta_03
   function NM_sub_cons_voo_destino_volta_03()
   {
         $this->voo_destino_volta_03 = html_entity_decode($this->voo_destino_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_volta_03 = strip_tags($this->voo_destino_volta_03);
         $this->voo_destino_volta_03 = NM_charset_to_utf8($this->voo_destino_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_destino_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_chega_destino_volta_03
   function NM_sub_cons_voo_chega_destino_volta_03()
   {
         $this->voo_chega_destino_volta_03 = html_entity_decode($this->voo_chega_destino_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_volta_03 = strip_tags($this->voo_chega_destino_volta_03);
         $this->voo_chega_destino_volta_03 = NM_charset_to_utf8($this->voo_chega_destino_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_chega_destino_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_cia_volta_03
   function NM_sub_cons_voo_cia_volta_03()
   {
         $this->voo_cia_volta_03 = html_entity_decode($this->voo_cia_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_volta_03 = strip_tags($this->voo_cia_volta_03);
         $this->voo_cia_volta_03 = NM_charset_to_utf8($this->voo_cia_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_cia_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_numvoo_volta_03
   function NM_sub_cons_voo_numvoo_volta_03()
   {
         $this->voo_numvoo_volta_03 = html_entity_decode($this->voo_numvoo_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_volta_03 = strip_tags($this->voo_numvoo_volta_03);
         $this->voo_numvoo_volta_03 = NM_charset_to_utf8($this->voo_numvoo_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_numvoo_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_localizador_volta_03
   function NM_sub_cons_voo_localizador_volta_03()
   {
         $this->voo_localizador_volta_03 = html_entity_decode($this->voo_localizador_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_volta_03 = strip_tags($this->voo_localizador_volta_03);
         $this->voo_localizador_volta_03 = NM_charset_to_utf8($this->voo_localizador_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_localizador_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_etkt_volta_03
   function NM_sub_cons_voo_etkt_volta_03()
   {
         $this->voo_etkt_volta_03 = html_entity_decode($this->voo_etkt_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_volta_03 = strip_tags($this->voo_etkt_volta_03);
         $this->voo_etkt_volta_03 = NM_charset_to_utf8($this->voo_etkt_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_etkt_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_assento_volta_03
   function NM_sub_cons_voo_assento_volta_03()
   {
         $this->voo_assento_volta_03 = html_entity_decode($this->voo_assento_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_volta_03 = strip_tags($this->voo_assento_volta_03);
         $this->voo_assento_volta_03 = NM_charset_to_utf8($this->voo_assento_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_assento_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_volta_03
   function NM_sub_cons_voo_comprado_bvt_volta_03()
   {
         $this->voo_comprado_bvt_volta_03 = html_entity_decode($this->voo_comprado_bvt_volta_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_volta_03 = strip_tags($this->voo_comprado_bvt_volta_03);
         $this->voo_comprado_bvt_volta_03 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_comprado_bvt_volta_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_origem_volta_04
   function NM_sub_cons_voo_origem_volta_04()
   {
         $this->voo_origem_volta_04 = html_entity_decode($this->voo_origem_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_origem_volta_04 = strip_tags($this->voo_origem_volta_04);
         $this->voo_origem_volta_04 = NM_charset_to_utf8($this->voo_origem_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_origem_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_saida_origem_volta_04
   function NM_sub_cons_voo_saida_origem_volta_04()
   {
         $this->voo_saida_origem_volta_04 = html_entity_decode($this->voo_saida_origem_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_saida_origem_volta_04 = strip_tags($this->voo_saida_origem_volta_04);
         $this->voo_saida_origem_volta_04 = NM_charset_to_utf8($this->voo_saida_origem_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_saida_origem_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_destino_volta_04
   function NM_sub_cons_voo_destino_volta_04()
   {
         $this->voo_destino_volta_04 = html_entity_decode($this->voo_destino_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_destino_volta_04 = strip_tags($this->voo_destino_volta_04);
         $this->voo_destino_volta_04 = NM_charset_to_utf8($this->voo_destino_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_destino_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_chega_destino_volta_04
   function NM_sub_cons_voo_chega_destino_volta_04()
   {
         $this->voo_chega_destino_volta_04 = html_entity_decode($this->voo_chega_destino_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_chega_destino_volta_04 = strip_tags($this->voo_chega_destino_volta_04);
         $this->voo_chega_destino_volta_04 = NM_charset_to_utf8($this->voo_chega_destino_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_chega_destino_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_cia_volta_04
   function NM_sub_cons_voo_cia_volta_04()
   {
         $this->voo_cia_volta_04 = html_entity_decode($this->voo_cia_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_cia_volta_04 = strip_tags($this->voo_cia_volta_04);
         $this->voo_cia_volta_04 = NM_charset_to_utf8($this->voo_cia_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_cia_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_numvoo_volta_04
   function NM_sub_cons_voo_numvoo_volta_04()
   {
         $this->voo_numvoo_volta_04 = html_entity_decode($this->voo_numvoo_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_numvoo_volta_04 = strip_tags($this->voo_numvoo_volta_04);
         $this->voo_numvoo_volta_04 = NM_charset_to_utf8($this->voo_numvoo_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_numvoo_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_localizador_volta_04
   function NM_sub_cons_voo_localizador_volta_04()
   {
         $this->voo_localizador_volta_04 = html_entity_decode($this->voo_localizador_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_localizador_volta_04 = strip_tags($this->voo_localizador_volta_04);
         $this->voo_localizador_volta_04 = NM_charset_to_utf8($this->voo_localizador_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_localizador_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_etkt_volta_04
   function NM_sub_cons_voo_etkt_volta_04()
   {
         $this->voo_etkt_volta_04 = html_entity_decode($this->voo_etkt_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_etkt_volta_04 = strip_tags($this->voo_etkt_volta_04);
         $this->voo_etkt_volta_04 = NM_charset_to_utf8($this->voo_etkt_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_etkt_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_assento_volta_04
   function NM_sub_cons_voo_assento_volta_04()
   {
         $this->voo_assento_volta_04 = html_entity_decode($this->voo_assento_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_assento_volta_04 = strip_tags($this->voo_assento_volta_04);
         $this->voo_assento_volta_04 = NM_charset_to_utf8($this->voo_assento_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_assento_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_comprado_bvt_volta_04
   function NM_sub_cons_voo_comprado_bvt_volta_04()
   {
         $this->voo_comprado_bvt_volta_04 = html_entity_decode($this->voo_comprado_bvt_volta_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_comprado_bvt_volta_04 = strip_tags($this->voo_comprado_bvt_volta_04);
         $this->voo_comprado_bvt_volta_04 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_comprado_bvt_volta_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- voo_observacoes_ida
   function NM_sub_cons_voo_observacoes_ida()
   {
         $this->voo_observacoes_ida = html_entity_decode($this->voo_observacoes_ida, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->voo_observacoes_ida = strip_tags($this->voo_observacoes_ida);
         $this->voo_observacoes_ida = NM_charset_to_utf8($this->voo_observacoes_ida);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->voo_observacoes_ida;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- logo_hospedagem
   function NM_sub_cons_logo_hospedagem()
   {
         $this->logo_hospedagem = NM_charset_to_utf8($this->logo_hospedagem);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->logo_hospedagem;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_fantasia_hotel_01
   function NM_sub_cons_hosp_fantasia_hotel_01()
   {
         $this->hosp_fantasia_hotel_01 = html_entity_decode($this->hosp_fantasia_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_fantasia_hotel_01 = strip_tags($this->hosp_fantasia_hotel_01);
         $this->hosp_fantasia_hotel_01 = NM_charset_to_utf8($this->hosp_fantasia_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_fantasia_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_logradouro_hotel_01
   function NM_sub_cons_hosp_logradouro_hotel_01()
   {
         $this->hosp_logradouro_hotel_01 = html_entity_decode($this->hosp_logradouro_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_logradouro_hotel_01 = strip_tags($this->hosp_logradouro_hotel_01);
         $this->hosp_logradouro_hotel_01 = NM_charset_to_utf8($this->hosp_logradouro_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_logradouro_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_numero_hotel_01
   function NM_sub_cons_hosp_numero_hotel_01()
   {
         $this->hosp_numero_hotel_01 = html_entity_decode($this->hosp_numero_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_numero_hotel_01 = strip_tags($this->hosp_numero_hotel_01);
         $this->hosp_numero_hotel_01 = NM_charset_to_utf8($this->hosp_numero_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_numero_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_complemento_hotel_01
   function NM_sub_cons_hosp_complemento_hotel_01()
   {
         $this->hosp_complemento_hotel_01 = html_entity_decode($this->hosp_complemento_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_complemento_hotel_01 = strip_tags($this->hosp_complemento_hotel_01);
         $this->hosp_complemento_hotel_01 = NM_charset_to_utf8($this->hosp_complemento_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_complemento_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_municipio_hotel_01
   function NM_sub_cons_hosp_municipio_hotel_01()
   {
         $this->hosp_municipio_hotel_01 = html_entity_decode($this->hosp_municipio_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_municipio_hotel_01 = strip_tags($this->hosp_municipio_hotel_01);
         $this->hosp_municipio_hotel_01 = NM_charset_to_utf8($this->hosp_municipio_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_municipio_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_uf_hotel_01
   function NM_sub_cons_hosp_uf_hotel_01()
   {
         $this->hosp_uf_hotel_01 = html_entity_decode($this->hosp_uf_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_uf_hotel_01 = strip_tags($this->hosp_uf_hotel_01);
         $this->hosp_uf_hotel_01 = NM_charset_to_utf8($this->hosp_uf_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_uf_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_cep_hotel_01
   function NM_sub_cons_hosp_cep_hotel_01()
   {
         $this->hosp_cep_hotel_01 = html_entity_decode($this->hosp_cep_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_cep_hotel_01 = strip_tags($this->hosp_cep_hotel_01);
         $this->hosp_cep_hotel_01 = NM_charset_to_utf8($this->hosp_cep_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_cep_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_pais_hotel_01
   function NM_sub_cons_hosp_pais_hotel_01()
   {
         $this->hosp_pais_hotel_01 = html_entity_decode($this->hosp_pais_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_pais_hotel_01 = strip_tags($this->hosp_pais_hotel_01);
         $this->hosp_pais_hotel_01 = NM_charset_to_utf8($this->hosp_pais_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_pais_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_acomodacao_hotel_01
   function NM_sub_cons_hosp_acomodacao_hotel_01()
   {
         $this->hosp_acomodacao_hotel_01 = html_entity_decode($this->hosp_acomodacao_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_acomodacao_hotel_01 = strip_tags($this->hosp_acomodacao_hotel_01);
         $this->hosp_acomodacao_hotel_01 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_acomodacao_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_categoria_hotel_01
   function NM_sub_cons_hosp_categoria_hotel_01()
   {
         $this->hosp_categoria_hotel_01 = html_entity_decode($this->hosp_categoria_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_categoria_hotel_01 = strip_tags($this->hosp_categoria_hotel_01);
         $this->hosp_categoria_hotel_01 = NM_charset_to_utf8($this->hosp_categoria_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_categoria_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_checkin_hotel_01
   function NM_sub_cons_hosp_checkin_hotel_01()
   {
         $this->hosp_checkin_hotel_01 = html_entity_decode($this->hosp_checkin_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkin_hotel_01 = strip_tags($this->hosp_checkin_hotel_01);
         $this->hosp_checkin_hotel_01 = NM_charset_to_utf8($this->hosp_checkin_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_checkin_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckin_hotel_01
   function NM_sub_cons_hosp_hr_ckeckin_hotel_01()
   {
         $this->hosp_hr_ckeckin_hotel_01 = html_entity_decode($this->hosp_hr_ckeckin_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckin_hotel_01 = strip_tags($this->hosp_hr_ckeckin_hotel_01);
         $this->hosp_hr_ckeckin_hotel_01 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_hr_ckeckin_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_checkout_hotel_01
   function NM_sub_cons_hosp_checkout_hotel_01()
   {
         $this->hosp_checkout_hotel_01 = html_entity_decode($this->hosp_checkout_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkout_hotel_01 = strip_tags($this->hosp_checkout_hotel_01);
         $this->hosp_checkout_hotel_01 = NM_charset_to_utf8($this->hosp_checkout_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_checkout_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckout_hotel_01
   function NM_sub_cons_hosp_hr_ckeckout_hotel_01()
   {
         $this->hosp_hr_ckeckout_hotel_01 = html_entity_decode($this->hosp_hr_ckeckout_hotel_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckout_hotel_01 = strip_tags($this->hosp_hr_ckeckout_hotel_01);
         $this->hosp_hr_ckeckout_hotel_01 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_hr_ckeckout_hotel_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_fantasia_hotel_02
   function NM_sub_cons_hosp_fantasia_hotel_02()
   {
         $this->hosp_fantasia_hotel_02 = html_entity_decode($this->hosp_fantasia_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_fantasia_hotel_02 = strip_tags($this->hosp_fantasia_hotel_02);
         $this->hosp_fantasia_hotel_02 = NM_charset_to_utf8($this->hosp_fantasia_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_fantasia_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_logradouro_hotel_02
   function NM_sub_cons_hosp_logradouro_hotel_02()
   {
         $this->hosp_logradouro_hotel_02 = html_entity_decode($this->hosp_logradouro_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_logradouro_hotel_02 = strip_tags($this->hosp_logradouro_hotel_02);
         $this->hosp_logradouro_hotel_02 = NM_charset_to_utf8($this->hosp_logradouro_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_logradouro_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_numero_hotel_02
   function NM_sub_cons_hosp_numero_hotel_02()
   {
         $this->hosp_numero_hotel_02 = html_entity_decode($this->hosp_numero_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_numero_hotel_02 = strip_tags($this->hosp_numero_hotel_02);
         $this->hosp_numero_hotel_02 = NM_charset_to_utf8($this->hosp_numero_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_numero_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_complemento_hotel_02
   function NM_sub_cons_hosp_complemento_hotel_02()
   {
         $this->hosp_complemento_hotel_02 = html_entity_decode($this->hosp_complemento_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_complemento_hotel_02 = strip_tags($this->hosp_complemento_hotel_02);
         $this->hosp_complemento_hotel_02 = NM_charset_to_utf8($this->hosp_complemento_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_complemento_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_municipio_hotel_02
   function NM_sub_cons_hosp_municipio_hotel_02()
   {
         $this->hosp_municipio_hotel_02 = html_entity_decode($this->hosp_municipio_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_municipio_hotel_02 = strip_tags($this->hosp_municipio_hotel_02);
         $this->hosp_municipio_hotel_02 = NM_charset_to_utf8($this->hosp_municipio_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_municipio_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_uf_hotel_02
   function NM_sub_cons_hosp_uf_hotel_02()
   {
         $this->hosp_uf_hotel_02 = html_entity_decode($this->hosp_uf_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_uf_hotel_02 = strip_tags($this->hosp_uf_hotel_02);
         $this->hosp_uf_hotel_02 = NM_charset_to_utf8($this->hosp_uf_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_uf_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_cep_hotel_02
   function NM_sub_cons_hosp_cep_hotel_02()
   {
         $this->hosp_cep_hotel_02 = html_entity_decode($this->hosp_cep_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_cep_hotel_02 = strip_tags($this->hosp_cep_hotel_02);
         $this->hosp_cep_hotel_02 = NM_charset_to_utf8($this->hosp_cep_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_cep_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_pais_hotel_02
   function NM_sub_cons_hosp_pais_hotel_02()
   {
         $this->hosp_pais_hotel_02 = html_entity_decode($this->hosp_pais_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_pais_hotel_02 = strip_tags($this->hosp_pais_hotel_02);
         $this->hosp_pais_hotel_02 = NM_charset_to_utf8($this->hosp_pais_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_pais_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_acomodacao_hotel_02
   function NM_sub_cons_hosp_acomodacao_hotel_02()
   {
         $this->hosp_acomodacao_hotel_02 = html_entity_decode($this->hosp_acomodacao_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_acomodacao_hotel_02 = strip_tags($this->hosp_acomodacao_hotel_02);
         $this->hosp_acomodacao_hotel_02 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_acomodacao_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_categoria_hotel_02
   function NM_sub_cons_hosp_categoria_hotel_02()
   {
         $this->hosp_categoria_hotel_02 = html_entity_decode($this->hosp_categoria_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_categoria_hotel_02 = strip_tags($this->hosp_categoria_hotel_02);
         $this->hosp_categoria_hotel_02 = NM_charset_to_utf8($this->hosp_categoria_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_categoria_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_checkin_hotel_02
   function NM_sub_cons_hosp_checkin_hotel_02()
   {
         $this->hosp_checkin_hotel_02 = html_entity_decode($this->hosp_checkin_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkin_hotel_02 = strip_tags($this->hosp_checkin_hotel_02);
         $this->hosp_checkin_hotel_02 = NM_charset_to_utf8($this->hosp_checkin_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_checkin_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckin_hotel_02
   function NM_sub_cons_hosp_hr_ckeckin_hotel_02()
   {
         $this->hosp_hr_ckeckin_hotel_02 = html_entity_decode($this->hosp_hr_ckeckin_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckin_hotel_02 = strip_tags($this->hosp_hr_ckeckin_hotel_02);
         $this->hosp_hr_ckeckin_hotel_02 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_hr_ckeckin_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_checkout_hotel_02
   function NM_sub_cons_hosp_checkout_hotel_02()
   {
         $this->hosp_checkout_hotel_02 = html_entity_decode($this->hosp_checkout_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkout_hotel_02 = strip_tags($this->hosp_checkout_hotel_02);
         $this->hosp_checkout_hotel_02 = NM_charset_to_utf8($this->hosp_checkout_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_checkout_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckout_hotel_02
   function NM_sub_cons_hosp_hr_ckeckout_hotel_02()
   {
         $this->hosp_hr_ckeckout_hotel_02 = html_entity_decode($this->hosp_hr_ckeckout_hotel_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckout_hotel_02 = strip_tags($this->hosp_hr_ckeckout_hotel_02);
         $this->hosp_hr_ckeckout_hotel_02 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_hr_ckeckout_hotel_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_fantasia_hotel_03
   function NM_sub_cons_hosp_fantasia_hotel_03()
   {
         $this->hosp_fantasia_hotel_03 = html_entity_decode($this->hosp_fantasia_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_fantasia_hotel_03 = strip_tags($this->hosp_fantasia_hotel_03);
         $this->hosp_fantasia_hotel_03 = NM_charset_to_utf8($this->hosp_fantasia_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_fantasia_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_logradouro_hotel_03
   function NM_sub_cons_hosp_logradouro_hotel_03()
   {
         $this->hosp_logradouro_hotel_03 = html_entity_decode($this->hosp_logradouro_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_logradouro_hotel_03 = strip_tags($this->hosp_logradouro_hotel_03);
         $this->hosp_logradouro_hotel_03 = NM_charset_to_utf8($this->hosp_logradouro_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_logradouro_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_numero_hotel_03
   function NM_sub_cons_hosp_numero_hotel_03()
   {
         $this->hosp_numero_hotel_03 = html_entity_decode($this->hosp_numero_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_numero_hotel_03 = strip_tags($this->hosp_numero_hotel_03);
         $this->hosp_numero_hotel_03 = NM_charset_to_utf8($this->hosp_numero_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_numero_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_complemento_hotel_03
   function NM_sub_cons_hosp_complemento_hotel_03()
   {
         $this->hosp_complemento_hotel_03 = html_entity_decode($this->hosp_complemento_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_complemento_hotel_03 = strip_tags($this->hosp_complemento_hotel_03);
         $this->hosp_complemento_hotel_03 = NM_charset_to_utf8($this->hosp_complemento_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_complemento_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_municipio_hotel_03
   function NM_sub_cons_hosp_municipio_hotel_03()
   {
         $this->hosp_municipio_hotel_03 = html_entity_decode($this->hosp_municipio_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_municipio_hotel_03 = strip_tags($this->hosp_municipio_hotel_03);
         $this->hosp_municipio_hotel_03 = NM_charset_to_utf8($this->hosp_municipio_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_municipio_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_uf_hotel_03
   function NM_sub_cons_hosp_uf_hotel_03()
   {
         $this->hosp_uf_hotel_03 = html_entity_decode($this->hosp_uf_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_uf_hotel_03 = strip_tags($this->hosp_uf_hotel_03);
         $this->hosp_uf_hotel_03 = NM_charset_to_utf8($this->hosp_uf_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_uf_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_cep_hotel_03
   function NM_sub_cons_hosp_cep_hotel_03()
   {
         $this->hosp_cep_hotel_03 = html_entity_decode($this->hosp_cep_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_cep_hotel_03 = strip_tags($this->hosp_cep_hotel_03);
         $this->hosp_cep_hotel_03 = NM_charset_to_utf8($this->hosp_cep_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_cep_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_pais_hotel_03
   function NM_sub_cons_hosp_pais_hotel_03()
   {
         $this->hosp_pais_hotel_03 = html_entity_decode($this->hosp_pais_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_pais_hotel_03 = strip_tags($this->hosp_pais_hotel_03);
         $this->hosp_pais_hotel_03 = NM_charset_to_utf8($this->hosp_pais_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_pais_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_acomodacao_hotel_03
   function NM_sub_cons_hosp_acomodacao_hotel_03()
   {
         $this->hosp_acomodacao_hotel_03 = html_entity_decode($this->hosp_acomodacao_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_acomodacao_hotel_03 = strip_tags($this->hosp_acomodacao_hotel_03);
         $this->hosp_acomodacao_hotel_03 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_acomodacao_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_categoria_hotel_03
   function NM_sub_cons_hosp_categoria_hotel_03()
   {
         $this->hosp_categoria_hotel_03 = html_entity_decode($this->hosp_categoria_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_categoria_hotel_03 = strip_tags($this->hosp_categoria_hotel_03);
         $this->hosp_categoria_hotel_03 = NM_charset_to_utf8($this->hosp_categoria_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_categoria_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_checkin_hotel_03
   function NM_sub_cons_hosp_checkin_hotel_03()
   {
         $this->hosp_checkin_hotel_03 = html_entity_decode($this->hosp_checkin_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkin_hotel_03 = strip_tags($this->hosp_checkin_hotel_03);
         $this->hosp_checkin_hotel_03 = NM_charset_to_utf8($this->hosp_checkin_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_checkin_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckin_hotel_03
   function NM_sub_cons_hosp_hr_ckeckin_hotel_03()
   {
         $this->hosp_hr_ckeckin_hotel_03 = html_entity_decode($this->hosp_hr_ckeckin_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckin_hotel_03 = strip_tags($this->hosp_hr_ckeckin_hotel_03);
         $this->hosp_hr_ckeckin_hotel_03 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_hr_ckeckin_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_checkout_hotel_03
   function NM_sub_cons_hosp_checkout_hotel_03()
   {
         $this->hosp_checkout_hotel_03 = html_entity_decode($this->hosp_checkout_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkout_hotel_03 = strip_tags($this->hosp_checkout_hotel_03);
         $this->hosp_checkout_hotel_03 = NM_charset_to_utf8($this->hosp_checkout_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_checkout_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckout_hotel_03
   function NM_sub_cons_hosp_hr_ckeckout_hotel_03()
   {
         $this->hosp_hr_ckeckout_hotel_03 = html_entity_decode($this->hosp_hr_ckeckout_hotel_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckout_hotel_03 = strip_tags($this->hosp_hr_ckeckout_hotel_03);
         $this->hosp_hr_ckeckout_hotel_03 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_hr_ckeckout_hotel_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_fantasia_hotel_04
   function NM_sub_cons_hosp_fantasia_hotel_04()
   {
         $this->hosp_fantasia_hotel_04 = html_entity_decode($this->hosp_fantasia_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_fantasia_hotel_04 = strip_tags($this->hosp_fantasia_hotel_04);
         $this->hosp_fantasia_hotel_04 = NM_charset_to_utf8($this->hosp_fantasia_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_fantasia_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_logradouro_hotel_04
   function NM_sub_cons_hosp_logradouro_hotel_04()
   {
         $this->hosp_logradouro_hotel_04 = html_entity_decode($this->hosp_logradouro_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_logradouro_hotel_04 = strip_tags($this->hosp_logradouro_hotel_04);
         $this->hosp_logradouro_hotel_04 = NM_charset_to_utf8($this->hosp_logradouro_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_logradouro_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_numero_hotel_04
   function NM_sub_cons_hosp_numero_hotel_04()
   {
         $this->hosp_numero_hotel_04 = html_entity_decode($this->hosp_numero_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_numero_hotel_04 = strip_tags($this->hosp_numero_hotel_04);
         $this->hosp_numero_hotel_04 = NM_charset_to_utf8($this->hosp_numero_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_numero_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_complemento_hotel_04
   function NM_sub_cons_hosp_complemento_hotel_04()
   {
         $this->hosp_complemento_hotel_04 = html_entity_decode($this->hosp_complemento_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_complemento_hotel_04 = strip_tags($this->hosp_complemento_hotel_04);
         $this->hosp_complemento_hotel_04 = NM_charset_to_utf8($this->hosp_complemento_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_complemento_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_municipio_hotel_04
   function NM_sub_cons_hosp_municipio_hotel_04()
   {
         $this->hosp_municipio_hotel_04 = html_entity_decode($this->hosp_municipio_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_municipio_hotel_04 = strip_tags($this->hosp_municipio_hotel_04);
         $this->hosp_municipio_hotel_04 = NM_charset_to_utf8($this->hosp_municipio_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_municipio_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_uf_hotel_04
   function NM_sub_cons_hosp_uf_hotel_04()
   {
         $this->hosp_uf_hotel_04 = html_entity_decode($this->hosp_uf_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_uf_hotel_04 = strip_tags($this->hosp_uf_hotel_04);
         $this->hosp_uf_hotel_04 = NM_charset_to_utf8($this->hosp_uf_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_uf_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_cep_hotel_04
   function NM_sub_cons_hosp_cep_hotel_04()
   {
         $this->hosp_cep_hotel_04 = html_entity_decode($this->hosp_cep_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_cep_hotel_04 = strip_tags($this->hosp_cep_hotel_04);
         $this->hosp_cep_hotel_04 = NM_charset_to_utf8($this->hosp_cep_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_cep_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_pais_hotel_04
   function NM_sub_cons_hosp_pais_hotel_04()
   {
         $this->hosp_pais_hotel_04 = html_entity_decode($this->hosp_pais_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_pais_hotel_04 = strip_tags($this->hosp_pais_hotel_04);
         $this->hosp_pais_hotel_04 = NM_charset_to_utf8($this->hosp_pais_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_pais_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_acomodacao_hotel_04
   function NM_sub_cons_hosp_acomodacao_hotel_04()
   {
         $this->hosp_acomodacao_hotel_04 = html_entity_decode($this->hosp_acomodacao_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_acomodacao_hotel_04 = strip_tags($this->hosp_acomodacao_hotel_04);
         $this->hosp_acomodacao_hotel_04 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_acomodacao_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_categoria_hotel_04
   function NM_sub_cons_hosp_categoria_hotel_04()
   {
         $this->hosp_categoria_hotel_04 = html_entity_decode($this->hosp_categoria_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_categoria_hotel_04 = strip_tags($this->hosp_categoria_hotel_04);
         $this->hosp_categoria_hotel_04 = NM_charset_to_utf8($this->hosp_categoria_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_categoria_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_checkin_hotel_04
   function NM_sub_cons_hosp_checkin_hotel_04()
   {
         $this->hosp_checkin_hotel_04 = html_entity_decode($this->hosp_checkin_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkin_hotel_04 = strip_tags($this->hosp_checkin_hotel_04);
         $this->hosp_checkin_hotel_04 = NM_charset_to_utf8($this->hosp_checkin_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_checkin_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckin_hotel_04
   function NM_sub_cons_hosp_hr_ckeckin_hotel_04()
   {
         $this->hosp_hr_ckeckin_hotel_04 = html_entity_decode($this->hosp_hr_ckeckin_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckin_hotel_04 = strip_tags($this->hosp_hr_ckeckin_hotel_04);
         $this->hosp_hr_ckeckin_hotel_04 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_hr_ckeckin_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_checkout_hotel_04
   function NM_sub_cons_hosp_checkout_hotel_04()
   {
         $this->hosp_checkout_hotel_04 = html_entity_decode($this->hosp_checkout_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_checkout_hotel_04 = strip_tags($this->hosp_checkout_hotel_04);
         $this->hosp_checkout_hotel_04 = NM_charset_to_utf8($this->hosp_checkout_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_checkout_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_hr_ckeckout_hotel_04
   function NM_sub_cons_hosp_hr_ckeckout_hotel_04()
   {
         $this->hosp_hr_ckeckout_hotel_04 = html_entity_decode($this->hosp_hr_ckeckout_hotel_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_hr_ckeckout_hotel_04 = strip_tags($this->hosp_hr_ckeckout_hotel_04);
         $this->hosp_hr_ckeckout_hotel_04 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_hr_ckeckout_hotel_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- hosp_observacoes
   function NM_sub_cons_hosp_observacoes()
   {
         $this->hosp_observacoes = html_entity_decode($this->hosp_observacoes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->hosp_observacoes = strip_tags($this->hosp_observacoes);
         $this->hosp_observacoes = NM_charset_to_utf8($this->hosp_observacoes);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->hosp_observacoes;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- logo_transfer
   function NM_sub_cons_logo_transfer()
   {
         $this->logo_transfer = NM_charset_to_utf8($this->logo_transfer);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->logo_transfer;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- transfer_in_observacoes
   function NM_sub_cons_transfer_in_observacoes()
   {
         $this->transfer_in_observacoes = html_entity_decode($this->transfer_in_observacoes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->transfer_in_observacoes = strip_tags($this->transfer_in_observacoes);
         $this->transfer_in_observacoes = NM_charset_to_utf8($this->transfer_in_observacoes);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->transfer_in_observacoes;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- transfer_out_observacoes
   function NM_sub_cons_transfer_out_observacoes()
   {
         $this->transfer_out_observacoes = html_entity_decode($this->transfer_out_observacoes, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->transfer_out_observacoes = strip_tags($this->transfer_out_observacoes);
         $this->transfer_out_observacoes = NM_charset_to_utf8($this->transfer_out_observacoes);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->transfer_out_observacoes;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- acompanhante_011
   function NM_sub_cons_acompanhante_011()
   {
         $this->acompanhante_011 = html_entity_decode($this->acompanhante_011, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_011 = strip_tags($this->acompanhante_011);
         $this->acompanhante_011 = NM_charset_to_utf8($this->acompanhante_011);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->acompanhante_011;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_acomp_011
   function NM_sub_cons_participante_acomp_011()
   {
         $this->participante_acomp_011 = html_entity_decode($this->participante_acomp_011, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_011 = strip_tags($this->participante_acomp_011);
         $this->participante_acomp_011 = NM_charset_to_utf8($this->participante_acomp_011);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_acomp_011;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- acompanhante_012
   function NM_sub_cons_acompanhante_012()
   {
         $this->acompanhante_012 = html_entity_decode($this->acompanhante_012, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_012 = strip_tags($this->acompanhante_012);
         $this->acompanhante_012 = NM_charset_to_utf8($this->acompanhante_012);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->acompanhante_012;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_acomp_012
   function NM_sub_cons_participante_acomp_012()
   {
         $this->participante_acomp_012 = html_entity_decode($this->participante_acomp_012, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_012 = strip_tags($this->participante_acomp_012);
         $this->participante_acomp_012 = NM_charset_to_utf8($this->participante_acomp_012);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_acomp_012;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- acompanhante_013
   function NM_sub_cons_acompanhante_013()
   {
         $this->acompanhante_013 = html_entity_decode($this->acompanhante_013, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_013 = strip_tags($this->acompanhante_013);
         $this->acompanhante_013 = NM_charset_to_utf8($this->acompanhante_013);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->acompanhante_013;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_acomp_013
   function NM_sub_cons_participante_acomp_013()
   {
         $this->participante_acomp_013 = html_entity_decode($this->participante_acomp_013, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_013 = strip_tags($this->participante_acomp_013);
         $this->participante_acomp_013 = NM_charset_to_utf8($this->participante_acomp_013);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_acomp_013;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- acompanhante_021
   function NM_sub_cons_acompanhante_021()
   {
         $this->acompanhante_021 = html_entity_decode($this->acompanhante_021, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_021 = strip_tags($this->acompanhante_021);
         $this->acompanhante_021 = NM_charset_to_utf8($this->acompanhante_021);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->acompanhante_021;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_acomp_021
   function NM_sub_cons_participante_acomp_021()
   {
         $this->participante_acomp_021 = html_entity_decode($this->participante_acomp_021, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_021 = strip_tags($this->participante_acomp_021);
         $this->participante_acomp_021 = NM_charset_to_utf8($this->participante_acomp_021);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_acomp_021;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- acompanhante_022
   function NM_sub_cons_acompanhante_022()
   {
         $this->acompanhante_022 = html_entity_decode($this->acompanhante_022, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_022 = strip_tags($this->acompanhante_022);
         $this->acompanhante_022 = NM_charset_to_utf8($this->acompanhante_022);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->acompanhante_022;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_acomp_022
   function NM_sub_cons_participante_acomp_022()
   {
         $this->participante_acomp_022 = html_entity_decode($this->participante_acomp_022, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_022 = strip_tags($this->participante_acomp_022);
         $this->participante_acomp_022 = NM_charset_to_utf8($this->participante_acomp_022);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_acomp_022;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- acompanhante_023
   function NM_sub_cons_acompanhante_023()
   {
         $this->acompanhante_023 = html_entity_decode($this->acompanhante_023, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_023 = strip_tags($this->acompanhante_023);
         $this->acompanhante_023 = NM_charset_to_utf8($this->acompanhante_023);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->acompanhante_023;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_acomp_023
   function NM_sub_cons_participante_acomp_023()
   {
         $this->participante_acomp_023 = html_entity_decode($this->participante_acomp_023, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_023 = strip_tags($this->participante_acomp_023);
         $this->participante_acomp_023 = NM_charset_to_utf8($this->participante_acomp_023);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_acomp_023;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- acompanhante_031
   function NM_sub_cons_acompanhante_031()
   {
         $this->acompanhante_031 = html_entity_decode($this->acompanhante_031, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_031 = strip_tags($this->acompanhante_031);
         $this->acompanhante_031 = NM_charset_to_utf8($this->acompanhante_031);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->acompanhante_031;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_acomp_031
   function NM_sub_cons_participante_acomp_031()
   {
         $this->participante_acomp_031 = html_entity_decode($this->participante_acomp_031, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_031 = strip_tags($this->participante_acomp_031);
         $this->participante_acomp_031 = NM_charset_to_utf8($this->participante_acomp_031);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_acomp_031;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- acompanhante_032
   function NM_sub_cons_acompanhante_032()
   {
         $this->acompanhante_032 = html_entity_decode($this->acompanhante_032, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_032 = strip_tags($this->acompanhante_032);
         $this->acompanhante_032 = NM_charset_to_utf8($this->acompanhante_032);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->acompanhante_032;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_acomp_032
   function NM_sub_cons_participante_acomp_032()
   {
         $this->participante_acomp_032 = html_entity_decode($this->participante_acomp_032, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_032 = strip_tags($this->participante_acomp_032);
         $this->participante_acomp_032 = NM_charset_to_utf8($this->participante_acomp_032);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_acomp_032;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- acompanhante_033
   function NM_sub_cons_acompanhante_033()
   {
         $this->acompanhante_033 = html_entity_decode($this->acompanhante_033, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->acompanhante_033 = strip_tags($this->acompanhante_033);
         $this->acompanhante_033 = NM_charset_to_utf8($this->acompanhante_033);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->acompanhante_033;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_acomp_033
   function NM_sub_cons_participante_acomp_033()
   {
         $this->participante_acomp_033 = html_entity_decode($this->participante_acomp_033, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_acomp_033 = strip_tags($this->participante_acomp_033);
         $this->participante_acomp_033 = NM_charset_to_utf8($this->participante_acomp_033);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_acomp_033;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- opcional_01
   function NM_sub_cons_opcional_01()
   {
         $this->opcional_01 = html_entity_decode($this->opcional_01, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->opcional_01 = strip_tags($this->opcional_01);
         $this->opcional_01 = NM_charset_to_utf8($this->opcional_01);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->opcional_01;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- opcional_02
   function NM_sub_cons_opcional_02()
   {
         $this->opcional_02 = html_entity_decode($this->opcional_02, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->opcional_02 = strip_tags($this->opcional_02);
         $this->opcional_02 = NM_charset_to_utf8($this->opcional_02);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->opcional_02;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- opcional_03
   function NM_sub_cons_opcional_03()
   {
         $this->opcional_03 = html_entity_decode($this->opcional_03, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->opcional_03 = strip_tags($this->opcional_03);
         $this->opcional_03 = NM_charset_to_utf8($this->opcional_03);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->opcional_03;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- opcional_04
   function NM_sub_cons_opcional_04()
   {
         $this->opcional_04 = html_entity_decode($this->opcional_04, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->opcional_04 = strip_tags($this->opcional_04);
         $this->opcional_04 = NM_charset_to_utf8($this->opcional_04);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->opcional_04;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- observacao_final
   function NM_sub_cons_observacao_final()
   {
         $this->observacao_final = html_entity_decode($this->observacao_final, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->observacao_final = strip_tags($this->observacao_final);
         $this->observacao_final = NM_charset_to_utf8($this->observacao_final);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->observacao_final;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   //----- participante_obs
   function NM_sub_cons_participante_obs()
   {
         $this->participante_obs = html_entity_decode($this->participante_obs, ENT_COMPAT, $_SESSION['scriptcase']['charset']);
         $this->participante_obs = strip_tags($this->participante_obs);
         $this->participante_obs = NM_charset_to_utf8($this->participante_obs);
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['data']   = $this->participante_obs;
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['align']  = "left";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['type']   = "char";
         $this->arr_export['lines'][$this->Xls_row][$this->Xls_col]['format'] = "";
         $this->Xls_col++;
   }
   function xls_sub_cons_copy_label($row)
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['nolabel']) || $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['nolabel'])
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_file']);
      if (is_file($this->Xls_f))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_file'] = $this->Xls_f;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Belvitur Eventos - Confirmação de Viagem :: Excel</TITLE>
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
<form name="Fdown" method="get" action="grid_confirmacao_viagem_rsvp_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_confirmacao_viagem_rsvp"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp']['xls_return']); ?>"> 
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

function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['contr_erro'] = 'on';
  		
		date_default_timezone_set('America/Sao_Paulo');
		$ret = false;
		$sqli = "					
		INSERT INTO
			rsvp_log
			(data_hora,
			ip,
			id_usuario,
			cod_usuario,
			modulo,
			aplicacao,
			acao,
			campo_id,	
			valor_campo_id,	
			campo_cpf,     	
			valor_campo_cpf,	
			campo_evt,
			valor_campo_evt,
			tabela,
			obs,
			csql)							
		VALUES
			(".$this->Db->qstr($v_hora_now).", 				 
			".$this->Db->qstr($v_ip_usuario).",               
			".$this->Db->qstr($v_id_usuario).",         	
			".$this->Db->qstr($v_global_cpf).",              
			".$this->Db->qstr($v_modulo).",     	
			".$this->Db->qstr($v_aplicacao).",  	                     
			".$this->Db->qstr($v_acao).",    
			".$this->Db->qstr($v_campo_id).",         	
			".$this->Db->qstr($v_vl_campo_id).",	             
			".$this->Db->qstr($v_campo_cpf).",                   	
			".$this->Db->qstr($v_vl_campo_cpf).",               	
			".$this->Db->qstr($v_campo_evt).",               
			".$this->Db->qstr($v_vl_campo_evt).",						
			".$this->Db->qstr($v_tabela).",
			".$this->Db->qstr($v_obs).",
			".$this->Db->qstr($v_sql).")									
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
		
		$ret = true;
		return $ret;
$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$fip_usuario = '';
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$fip_usuario = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$fip_usuario = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$fip_usuario = $_SERVER['REMOTE_ADDR'];
		}		
		return $fip_usuario;
	
$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp']['contr_erro'] = 'off';
}

}

?>
