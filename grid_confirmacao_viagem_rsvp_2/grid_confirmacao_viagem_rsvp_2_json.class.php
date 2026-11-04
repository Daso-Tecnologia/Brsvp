<?php

class grid_confirmacao_viagem_rsvp_2_json
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
    return false;
}

   function monta_json()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['embutida'])
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['opcao'] = "";
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
                   nm_limpa_str_grid_confirmacao_viagem_rsvp_2($cadapar[1]);
                   nm_protect_num_grid_confirmacao_viagem_rsvp_2($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_confirmacao_viagem_rsvp_2']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_2($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $vg_cpf;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_2($_SESSION["vg_cpf"]);
      }
      if (isset($vg_destinatario)) 
      {
          $_SESSION['vg_destinatario'] = $vg_destinatario;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_2($_SESSION["vg_destinatario"]);
      }
      if (isset($vg_comcopia)) 
      {
          $_SESSION['vg_comcopia'] = $vg_comcopia;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_2($_SESSION["vg_comcopia"]);
      }
      if (isset($vg_msg)) 
      {
          $_SESSION['vg_msg'] = $vg_msg;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_2($_SESSION["vg_msg"]);
      }
      if (isset($vg_nome_evt)) 
      {
          $_SESSION['vg_nome_evt'] = $vg_nome_evt;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_2($_SESSION["vg_nome_evt"]);
      }
      if (isset($vg_nome_pax)) 
      {
          $_SESSION['vg_nome_pax'] = $vg_nome_pax;
          nm_limpa_str_grid_confirmacao_viagem_rsvp_2($_SESSION["vg_nome_pax"]);
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['SC_Gb_Free_cmp']))
      {
          $this->Tem_json_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_confirmacao_viagem_rsvp_2/grid_confirmacao_viagem_rsvp_2_res_json.class.php"))
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_label']))
      {
          $this->Json_use_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_label'];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_format']))
      {
          $this->Json_format = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_format'];
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_confirmacao_viagem_rsvp_2_total.class.php"); 
      $this->Tot = new grid_confirmacao_viagem_rsvp_2_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp_2']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_return']);
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
      $this->Arq_zip      = $this->Arquivo . "_grid_confirmacao_viagem_rsvp_2.zip";
      $this->Arquivo     .= "_grid_confirmacao_viagem_rsvp_2";
      $this->Arquivo     .= ".json";
      $this->Tit_doc      = "grid_confirmacao_viagem_rsvp_2.json";
      $this->Tit_zip      = "grid_confirmacao_viagem_rsvp_2.zip";
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
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['campos_busca'];
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
      $_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp_2']['contr_erro'] = 'on';
 $sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp_2']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['embutida'])
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
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, participante_obs, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, acompanhante_021, participante_acomp_011, participante_acomp_021, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, logo_cliente, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, participante_obs, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, acompanhante_021, participante_acomp_011, participante_acomp_021, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, logo_cliente, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, participante_obs, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, acompanhante_021, participante_acomp_011, participante_acomp_021, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, logo_cliente, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, participante_obs, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, acompanhante_021, participante_acomp_011, participante_acomp_021, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, logo_cliente, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, participante_obs, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, acompanhante_021, participante_acomp_011, participante_acomp_021, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, logo_cliente, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT simples_mensagem, voo_origem_ida_01, voo_saida_origem_ida_01, voo_destino_ida_01, voo_chega_destino_ida_01, voo_cia_ida_01, voo_numvoo_ida_01, voo_localizador_ida_01, voo_etkt_ida_01, voo_assento_ida_01, voo_comprado_bvt_ida_01, voo_origem_ida_02, voo_saida_origem_ida_02, voo_destino_ida_02, voo_chega_destino_ida_02, voo_cia_ida_02, voo_numvoo_ida_02, voo_localizador_ida_02, voo_etkt_ida_02, voo_assento_ida_02, voo_comprado_bvt_ida_02, voo_origem_ida_03, voo_saida_origem_ida_03, voo_destino_ida_03, voo_chega_destino_ida_03, voo_cia_ida_03, voo_numvoo_ida_03, voo_localizador_ida_03, voo_etkt_ida_03, voo_assento_ida_03, voo_comprado_bvt_ida_03, voo_origem_ida_04, voo_saida_origem_ida_04, voo_destino_ida_04, voo_chega_destino_ida_04, voo_cia_ida_04, voo_numvoo_ida_04, voo_localizador_ida_04, voo_etkt_ida_04, voo_assento_ida_04, voo_comprado_bvt_ida_04, voo_origem_volta_01, voo_saida_origem_volta_01, voo_destino_volta_01, voo_chega_destino_volta_01, voo_cia_volta_01, voo_numvoo_volta_01, voo_localizador_volta_01, voo_etkt_volta_01, voo_assento_volta_01, voo_comprado_bvt_volta_01, voo_origem_volta_02, voo_saida_origem_volta_02, voo_destino_volta_02, voo_chega_destino_volta_02, voo_cia_volta_02, voo_numvoo_volta_02, voo_localizador_volta_02, voo_etkt_volta_02, voo_assento_volta_02, voo_comprado_bvt_volta_02, voo_origem_volta_03, voo_saida_origem_volta_03, voo_destino_volta_03, voo_chega_destino_volta_03, voo_cia_volta_03, voo_numvoo_volta_03, voo_localizador_volta_03, voo_etkt_volta_03, voo_assento_volta_03, voo_comprado_bvt_volta_03, voo_origem_volta_04, voo_saida_origem_volta_04, voo_destino_volta_04, voo_chega_destino_volta_04, voo_cia_volta_04, voo_numvoo_volta_04, voo_localizador_volta_04, voo_etkt_volta_04, voo_assento_volta_04, voo_comprado_bvt_volta_04, participante_obs, voo_observacoes_ida, hosp_fantasia_hotel_01, hosp_logradouro_hotel_01, hosp_numero_hotel_01, hosp_complemento_hotel_01, hosp_municipio_hotel_01, hosp_uf_hotel_01, hosp_cep_hotel_01, hosp_pais_hotel_01, hosp_acomodacao_hotel_01, hosp_categoria_hotel_01, hosp_checkin_hotel_01, hosp_hr_ckeckin_hotel_01, hosp_checkout_hotel_01, hosp_hr_ckeckout_hotel_01, hosp_fantasia_hotel_02, hosp_logradouro_hotel_02, hosp_numero_hotel_02, hosp_complemento_hotel_02, hosp_municipio_hotel_02, hosp_uf_hotel_02, hosp_cep_hotel_02, hosp_pais_hotel_02, hosp_acomodacao_hotel_02, hosp_categoria_hotel_02, hosp_checkin_hotel_02, hosp_hr_ckeckin_hotel_02, hosp_checkout_hotel_02, hosp_hr_ckeckout_hotel_02, hosp_fantasia_hotel_03, hosp_logradouro_hotel_03, hosp_numero_hotel_03, hosp_complemento_hotel_03, hosp_municipio_hotel_03, hosp_uf_hotel_03, hosp_cep_hotel_03, hosp_pais_hotel_03, hosp_acomodacao_hotel_03, hosp_categoria_hotel_03, hosp_checkin_hotel_03, hosp_hr_ckeckin_hotel_03, hosp_checkout_hotel_03, hosp_hr_ckeckout_hotel_03, hosp_fantasia_hotel_04, hosp_logradouro_hotel_04, hosp_numero_hotel_04, hosp_complemento_hotel_04, hosp_municipio_hotel_04, hosp_uf_hotel_04, hosp_cep_hotel_04, hosp_pais_hotel_04, hosp_acomodacao_hotel_04, hosp_categoria_hotel_04, hosp_checkin_hotel_04, hosp_hr_ckeckin_hotel_04, hosp_checkout_hotel_04, hosp_hr_ckeckout_hotel_04, hosp_observacoes, transfer_in_observacoes, transfer_out_observacoes, acompanhante_011, acompanhante_021, participante_acomp_011, participante_acomp_021, opcional_01, opcional_02, opcional_03, opcional_04, observacao_final, logo_cliente, id_voucher from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['order_grid'];
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
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
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
         $this->participante_obs = $rs->fields[81] ;  
         $this->voo_observacoes_ida = $rs->fields[82] ;  
         $this->hosp_fantasia_hotel_01 = $rs->fields[83] ;  
         $this->hosp_logradouro_hotel_01 = $rs->fields[84] ;  
         $this->hosp_numero_hotel_01 = $rs->fields[85] ;  
         $this->hosp_complemento_hotel_01 = $rs->fields[86] ;  
         $this->hosp_municipio_hotel_01 = $rs->fields[87] ;  
         $this->hosp_uf_hotel_01 = $rs->fields[88] ;  
         $this->hosp_cep_hotel_01 = $rs->fields[89] ;  
         $this->hosp_pais_hotel_01 = $rs->fields[90] ;  
         $this->hosp_acomodacao_hotel_01 = $rs->fields[91] ;  
         $this->hosp_categoria_hotel_01 = $rs->fields[92] ;  
         $this->hosp_checkin_hotel_01 = $rs->fields[93] ;  
         $this->hosp_hr_ckeckin_hotel_01 = $rs->fields[94] ;  
         $this->hosp_checkout_hotel_01 = $rs->fields[95] ;  
         $this->hosp_hr_ckeckout_hotel_01 = $rs->fields[96] ;  
         $this->hosp_fantasia_hotel_02 = $rs->fields[97] ;  
         $this->hosp_logradouro_hotel_02 = $rs->fields[98] ;  
         $this->hosp_numero_hotel_02 = $rs->fields[99] ;  
         $this->hosp_complemento_hotel_02 = $rs->fields[100] ;  
         $this->hosp_municipio_hotel_02 = $rs->fields[101] ;  
         $this->hosp_uf_hotel_02 = $rs->fields[102] ;  
         $this->hosp_cep_hotel_02 = $rs->fields[103] ;  
         $this->hosp_pais_hotel_02 = $rs->fields[104] ;  
         $this->hosp_acomodacao_hotel_02 = $rs->fields[105] ;  
         $this->hosp_categoria_hotel_02 = $rs->fields[106] ;  
         $this->hosp_checkin_hotel_02 = $rs->fields[107] ;  
         $this->hosp_hr_ckeckin_hotel_02 = $rs->fields[108] ;  
         $this->hosp_checkout_hotel_02 = $rs->fields[109] ;  
         $this->hosp_hr_ckeckout_hotel_02 = $rs->fields[110] ;  
         $this->hosp_fantasia_hotel_03 = $rs->fields[111] ;  
         $this->hosp_logradouro_hotel_03 = $rs->fields[112] ;  
         $this->hosp_numero_hotel_03 = $rs->fields[113] ;  
         $this->hosp_complemento_hotel_03 = $rs->fields[114] ;  
         $this->hosp_municipio_hotel_03 = $rs->fields[115] ;  
         $this->hosp_uf_hotel_03 = $rs->fields[116] ;  
         $this->hosp_cep_hotel_03 = $rs->fields[117] ;  
         $this->hosp_pais_hotel_03 = $rs->fields[118] ;  
         $this->hosp_acomodacao_hotel_03 = $rs->fields[119] ;  
         $this->hosp_categoria_hotel_03 = $rs->fields[120] ;  
         $this->hosp_checkin_hotel_03 = $rs->fields[121] ;  
         $this->hosp_hr_ckeckin_hotel_03 = $rs->fields[122] ;  
         $this->hosp_checkout_hotel_03 = $rs->fields[123] ;  
         $this->hosp_hr_ckeckout_hotel_03 = $rs->fields[124] ;  
         $this->hosp_fantasia_hotel_04 = $rs->fields[125] ;  
         $this->hosp_logradouro_hotel_04 = $rs->fields[126] ;  
         $this->hosp_numero_hotel_04 = $rs->fields[127] ;  
         $this->hosp_complemento_hotel_04 = $rs->fields[128] ;  
         $this->hosp_municipio_hotel_04 = $rs->fields[129] ;  
         $this->hosp_uf_hotel_04 = $rs->fields[130] ;  
         $this->hosp_cep_hotel_04 = $rs->fields[131] ;  
         $this->hosp_pais_hotel_04 = $rs->fields[132] ;  
         $this->hosp_acomodacao_hotel_04 = $rs->fields[133] ;  
         $this->hosp_categoria_hotel_04 = $rs->fields[134] ;  
         $this->hosp_checkin_hotel_04 = $rs->fields[135] ;  
         $this->hosp_hr_ckeckin_hotel_04 = $rs->fields[136] ;  
         $this->hosp_checkout_hotel_04 = $rs->fields[137] ;  
         $this->hosp_hr_ckeckout_hotel_04 = $rs->fields[138] ;  
         $this->hosp_observacoes = $rs->fields[139] ;  
         $this->transfer_in_observacoes = $rs->fields[140] ;  
         $this->transfer_out_observacoes = $rs->fields[141] ;  
         $this->acompanhante_011 = $rs->fields[142] ;  
         $this->acompanhante_021 = $rs->fields[143] ;  
         $this->participante_acomp_011 = $rs->fields[144] ;  
         $this->participante_acomp_021 = $rs->fields[145] ;  
         $this->opcional_01 = $rs->fields[146] ;  
         $this->opcional_02 = $rs->fields[147] ;  
         $this->opcional_03 = $rs->fields[148] ;  
         $this->opcional_04 = $rs->fields[149] ;  
         $this->observacao_final = $rs->fields[150] ;  
         $this->logo_cliente = $rs->fields[151] ;  
         $this->id_voucher = $rs->fields[152] ;  
         $this->id_voucher = (string)$this->id_voucher;
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp_2']['contr_erro'] = 'on';
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
$this->retornojavascript  = 'S';


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
   	<img align='left'><font size='6'><font color='#2a1f80'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	Confirmação de Viagem&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
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
	$this->Ini->nm_hidden_blocos[12] = 'off';
}

if ($this->voo_observacoes_ida  == '') {
	$this->Ini->nm_hidden_blocos[13] = 'off';
}

if ($this->voo_origem_ida_01  == '' && $this->voo_origem_volta_01  == '') {
	$this->Ini->nm_hidden_blocos[13] = 'off';
	if ($this->participante_obs  == '') {
		$this->Ini->nm_hidden_blocos[12] = 'off';	
	}		
	$this->Ini->nm_hidden_blocos[3] = 'off';
}


if ($this->hosp_fantasia_hotel_01  == '') {
	$this->Ini->nm_hidden_blocos[14] = 'off';
	$this->Ini->nm_hidden_blocos[15] = 'off';	
	$this->Ini->nm_hidden_blocos[16] = 'off';
	$this->Ini->nm_hidden_blocos[17] = 'off';
	$this->Ini->nm_hidden_blocos[18] = 'off';
	$this->Ini->nm_hidden_blocos[19] = 'off';
}

if ($this->hosp_fantasia_hotel_02  == '') {
	$this->Ini->nm_hidden_blocos[16] = 'off';
}

if ($this->hosp_fantasia_hotel_03  == '') {
	$this->Ini->nm_hidden_blocos[17] = 'off';
}

if ($this->hosp_fantasia_hotel_04  == '') {
	$this->Ini->nm_hidden_blocos[18] = 'off';
}

if ($this->hosp_observacoes  == '') {
	$this->Ini->nm_hidden_blocos[19] = 'off';
}


if ($this->transfer_in_observacoes  == '' && $this->transfer_out_observacoes  == '') {
	$this->Ini->nm_hidden_blocos[20] = 'off';
	$this->NM_cmp_hidden["transfer_in_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["transfer_in_observacoes"] = 'off'; }
	$this->NM_cmp_hidden["transfer_out_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["transfer_out_observacoes"] = 'off'; }	
	;
}	

if ($this->transfer_in_observacoes  == '') {
	$this->NM_cmp_hidden["transfer_in_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["transfer_in_observacoes"] = 'off'; }
}

if ($this->transfer_out_observacoes  == '') {
	$this->NM_cmp_hidden["transfer_out_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["transfer_out_observacoes"] = 'off'; }
}


if($this->acompanhante_011  == 'ANHANTE') {
	$this->acompanhante_011  = '';
}

if($this->acompanhante_011  == '' && $this->acompanhante_021   == '' && $this->participante_acomp_011   == '' && $this->participante_acomp_021  == '') {
	$this->Ini->nm_hidden_blocos[21] = 'off';
}


if($this->acompanhante_011   == '') {                                
	$this->NM_cmp_hidden["acompanhante_011"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["acompanhante_011"] = 'off'; }
}

if($this->acompanhante_021   == '') {                                  
	$this->NM_cmp_hidden["acompanhante_021"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["acompanhante_021"] = 'off'; }
}


if($this->participante_acomp_011  == '') {                                  
	$this->NM_cmp_hidden["participante_acomp_011"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["participante_acomp_011"] = 'off'; }
}

if($this->participante_acomp_021  == '') {                                 
	$this->NM_cmp_hidden["participante_acomp_021"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["participante_acomp_021"] = 'off'; }
}


	
if($this->opcional_01  == '' && $this->opcional_02   == '' && $this->opcional_03   == '' && $this->opcional_04  == '') {
	$this->Ini->nm_hidden_blocos[22] = 'off';
}


if($this->opcional_01  == '') {                                 
	$this->NM_cmp_hidden["opcional_01"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["opcional_01"] = 'off'; }
}

if($this->opcional_02  == '') {                                 
	$this->NM_cmp_hidden["opcional_02"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["opcional_02"] = 'off'; }
}

if($this->opcional_03  == '') {                                 
	$this->NM_cmp_hidden["opcional_03"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["opcional_03"] = 'off'; }
}

if($this->opcional_04  == '') {                                 
	$this->NM_cmp_hidden["opcional_04"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["opcional_04"] = 'off'; }
}


if ($this->observacao_final  == '') {
	$this->Ini->nm_hidden_blocos[23] = 'off';
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
	$this->Ini->nm_hidden_blocos[13] = 'off';	
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
	$this->Ini->nm_hidden_blocos[19] = 'off';			
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
	$this->NM_cmp_hidden["transfer_in_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["transfer_in_observacoes"] = 'off'; }	
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
	$this->NM_cmp_hidden["transfer_out_observacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['php_cmp_sel']["transfer_out_observacoes"] = 'off'; }
}	

if ($_status_in <> 'LIGADO' && $_status_out <> 'LIGADO') {
	$this->Ini->nm_hidden_blocos[20] = 'off';
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
	$this->Ini->nm_hidden_blocos[23] = 'off';	
}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_nome_evt)) {$_SESSION['vg_nome_evt'] = $this->sc_temp_vg_nome_evt;}
if (isset($this->sc_temp_vg_nome_pax)) {$_SESSION['vg_nome_pax'] = $this->sc_temp_vg_nome_pax;}
if (isset($this->sc_temp_vg_destinatario)) {$_SESSION['vg_destinatario'] = $this->sc_temp_vg_destinatario;}
if (isset($this->sc_temp_vg_comcopia)) {$_SESSION['vg_comcopia'] = $this->sc_temp_vg_comcopia;}
if (isset($this->sc_temp_vg_msg)) {$_SESSION['vg_msg'] = $this->sc_temp_vg_msg;}
$_SESSION['scriptcase']['grid_confirmacao_viagem_rsvp_2']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['field_order'] as $Cada_col)
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['embutida'])
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
              require_once($this->Ini->path_aplicacao . "grid_confirmacao_viagem_rsvp_2_res_json.class.php");
              $this->Res = new grid_confirmacao_viagem_rsvp_2_res_json();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_res_grid'] = true;
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
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_res_file']['json'];
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_res_file']['json']);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- logo_bvt
   function NM_export_logo_bvt()
   {
         $this->logo_bvt = NM_charset_to_utf8($this->logo_bvt);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['logo_bvt'])) ? $this->New_label['logo_bvt'] : ""; 
         }
         else
         {
             $SC_Label = "logo_bvt"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->logo_bvt;
   }
   //----- teste
   function NM_export_teste()
   {
         $this->teste = NM_charset_to_utf8($this->teste);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['teste'])) ? $this->New_label['teste'] : ""; 
         }
         else
         {
             $SC_Label = "teste"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->teste;
   }
   //----- simples_mensagem
   function NM_export_simples_mensagem()
   {
         $this->simples_mensagem = NM_charset_to_utf8($this->simples_mensagem);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['simples_mensagem'])) ? $this->New_label['simples_mensagem'] : ""; 
         }
         else
         {
             $SC_Label = "simples_mensagem"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->simples_mensagem;
   }
   //----- logo_aereo
   function NM_export_logo_aereo()
   {
         $this->logo_aereo = NM_charset_to_utf8($this->logo_aereo);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['logo_aereo'])) ? $this->New_label['logo_aereo'] : ""; 
         }
         else
         {
             $SC_Label = "logo_aereo"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->logo_aereo;
   }
   //----- voo_origem_ida_01
   function NM_export_voo_origem_ida_01()
   {
         $this->voo_origem_ida_01 = NM_charset_to_utf8($this->voo_origem_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_origem_ida_01'])) ? $this->New_label['voo_origem_ida_01'] : "Origem"; 
         }
         else
         {
             $SC_Label = "voo_origem_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_origem_ida_01;
   }
   //----- voo_saida_origem_ida_01
   function NM_export_voo_saida_origem_ida_01()
   {
         $this->voo_saida_origem_ida_01 = NM_charset_to_utf8($this->voo_saida_origem_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_saida_origem_ida_01'])) ? $this->New_label['voo_saida_origem_ida_01'] : "Saída"; 
         }
         else
         {
             $SC_Label = "voo_saida_origem_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_saida_origem_ida_01;
   }
   //----- voo_destino_ida_01
   function NM_export_voo_destino_ida_01()
   {
         $this->voo_destino_ida_01 = NM_charset_to_utf8($this->voo_destino_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_destino_ida_01'])) ? $this->New_label['voo_destino_ida_01'] : "Destino"; 
         }
         else
         {
             $SC_Label = "voo_destino_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_destino_ida_01;
   }
   //----- voo_chega_destino_ida_01
   function NM_export_voo_chega_destino_ida_01()
   {
         $this->voo_chega_destino_ida_01 = NM_charset_to_utf8($this->voo_chega_destino_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_chega_destino_ida_01'])) ? $this->New_label['voo_chega_destino_ida_01'] : "Chegada"; 
         }
         else
         {
             $SC_Label = "voo_chega_destino_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_chega_destino_ida_01;
   }
   //----- voo_cia_ida_01
   function NM_export_voo_cia_ida_01()
   {
         $this->voo_cia_ida_01 = NM_charset_to_utf8($this->voo_cia_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_cia_ida_01'])) ? $this->New_label['voo_cia_ida_01'] : "Cia."; 
         }
         else
         {
             $SC_Label = "voo_cia_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_cia_ida_01;
   }
   //----- voo_numvoo_ida_01
   function NM_export_voo_numvoo_ida_01()
   {
         $this->voo_numvoo_ida_01 = NM_charset_to_utf8($this->voo_numvoo_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_numvoo_ida_01'])) ? $this->New_label['voo_numvoo_ida_01'] : "Num. Voo"; 
         }
         else
         {
             $SC_Label = "voo_numvoo_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_numvoo_ida_01;
   }
   //----- voo_localizador_ida_01
   function NM_export_voo_localizador_ida_01()
   {
         $this->voo_localizador_ida_01 = NM_charset_to_utf8($this->voo_localizador_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_localizador_ida_01'])) ? $this->New_label['voo_localizador_ida_01'] : "Localizador"; 
         }
         else
         {
             $SC_Label = "voo_localizador_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_localizador_ida_01;
   }
   //----- voo_etkt_ida_01
   function NM_export_voo_etkt_ida_01()
   {
         $this->voo_etkt_ida_01 = NM_charset_to_utf8($this->voo_etkt_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_etkt_ida_01'])) ? $this->New_label['voo_etkt_ida_01'] : "E-ticket"; 
         }
         else
         {
             $SC_Label = "voo_etkt_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_etkt_ida_01;
   }
   //----- voo_assento_ida_01
   function NM_export_voo_assento_ida_01()
   {
         $this->voo_assento_ida_01 = NM_charset_to_utf8($this->voo_assento_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_assento_ida_01'])) ? $this->New_label['voo_assento_ida_01'] : "Assento"; 
         }
         else
         {
             $SC_Label = "voo_assento_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_assento_ida_01;
   }
   //----- voo_comprado_bvt_ida_01
   function NM_export_voo_comprado_bvt_ida_01()
   {
         $this->voo_comprado_bvt_ida_01 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_comprado_bvt_ida_01'])) ? $this->New_label['voo_comprado_bvt_ida_01'] : "Comprado com Belvitur"; 
         }
         else
         {
             $SC_Label = "voo_comprado_bvt_ida_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_comprado_bvt_ida_01;
   }
   //----- voo_origem_ida_02
   function NM_export_voo_origem_ida_02()
   {
         $this->voo_origem_ida_02 = NM_charset_to_utf8($this->voo_origem_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_origem_ida_02'])) ? $this->New_label['voo_origem_ida_02'] : "Origem"; 
         }
         else
         {
             $SC_Label = "voo_origem_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_origem_ida_02;
   }
   //----- voo_saida_origem_ida_02
   function NM_export_voo_saida_origem_ida_02()
   {
         $this->voo_saida_origem_ida_02 = NM_charset_to_utf8($this->voo_saida_origem_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_saida_origem_ida_02'])) ? $this->New_label['voo_saida_origem_ida_02'] : "Saída"; 
         }
         else
         {
             $SC_Label = "voo_saida_origem_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_saida_origem_ida_02;
   }
   //----- voo_destino_ida_02
   function NM_export_voo_destino_ida_02()
   {
         $this->voo_destino_ida_02 = NM_charset_to_utf8($this->voo_destino_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_destino_ida_02'])) ? $this->New_label['voo_destino_ida_02'] : "Destino"; 
         }
         else
         {
             $SC_Label = "voo_destino_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_destino_ida_02;
   }
   //----- voo_chega_destino_ida_02
   function NM_export_voo_chega_destino_ida_02()
   {
         $this->voo_chega_destino_ida_02 = NM_charset_to_utf8($this->voo_chega_destino_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_chega_destino_ida_02'])) ? $this->New_label['voo_chega_destino_ida_02'] : "Chegada"; 
         }
         else
         {
             $SC_Label = "voo_chega_destino_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_chega_destino_ida_02;
   }
   //----- voo_cia_ida_02
   function NM_export_voo_cia_ida_02()
   {
         $this->voo_cia_ida_02 = NM_charset_to_utf8($this->voo_cia_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_cia_ida_02'])) ? $this->New_label['voo_cia_ida_02'] : "Cia."; 
         }
         else
         {
             $SC_Label = "voo_cia_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_cia_ida_02;
   }
   //----- voo_numvoo_ida_02
   function NM_export_voo_numvoo_ida_02()
   {
         $this->voo_numvoo_ida_02 = NM_charset_to_utf8($this->voo_numvoo_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_numvoo_ida_02'])) ? $this->New_label['voo_numvoo_ida_02'] : "Num. Voo"; 
         }
         else
         {
             $SC_Label = "voo_numvoo_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_numvoo_ida_02;
   }
   //----- voo_localizador_ida_02
   function NM_export_voo_localizador_ida_02()
   {
         $this->voo_localizador_ida_02 = NM_charset_to_utf8($this->voo_localizador_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_localizador_ida_02'])) ? $this->New_label['voo_localizador_ida_02'] : "Localizador"; 
         }
         else
         {
             $SC_Label = "voo_localizador_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_localizador_ida_02;
   }
   //----- voo_etkt_ida_02
   function NM_export_voo_etkt_ida_02()
   {
         $this->voo_etkt_ida_02 = NM_charset_to_utf8($this->voo_etkt_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_etkt_ida_02'])) ? $this->New_label['voo_etkt_ida_02'] : "E-ticket"; 
         }
         else
         {
             $SC_Label = "voo_etkt_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_etkt_ida_02;
   }
   //----- voo_assento_ida_02
   function NM_export_voo_assento_ida_02()
   {
         $this->voo_assento_ida_02 = NM_charset_to_utf8($this->voo_assento_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_assento_ida_02'])) ? $this->New_label['voo_assento_ida_02'] : "Assento"; 
         }
         else
         {
             $SC_Label = "voo_assento_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_assento_ida_02;
   }
   //----- voo_comprado_bvt_ida_02
   function NM_export_voo_comprado_bvt_ida_02()
   {
         $this->voo_comprado_bvt_ida_02 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_comprado_bvt_ida_02'])) ? $this->New_label['voo_comprado_bvt_ida_02'] : "Comprado com Belvitur"; 
         }
         else
         {
             $SC_Label = "voo_comprado_bvt_ida_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_comprado_bvt_ida_02;
   }
   //----- voo_origem_ida_03
   function NM_export_voo_origem_ida_03()
   {
         $this->voo_origem_ida_03 = NM_charset_to_utf8($this->voo_origem_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_origem_ida_03'])) ? $this->New_label['voo_origem_ida_03'] : "Origem"; 
         }
         else
         {
             $SC_Label = "voo_origem_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_origem_ida_03;
   }
   //----- voo_saida_origem_ida_03
   function NM_export_voo_saida_origem_ida_03()
   {
         $this->voo_saida_origem_ida_03 = NM_charset_to_utf8($this->voo_saida_origem_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_saida_origem_ida_03'])) ? $this->New_label['voo_saida_origem_ida_03'] : "Saída"; 
         }
         else
         {
             $SC_Label = "voo_saida_origem_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_saida_origem_ida_03;
   }
   //----- voo_destino_ida_03
   function NM_export_voo_destino_ida_03()
   {
         $this->voo_destino_ida_03 = NM_charset_to_utf8($this->voo_destino_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_destino_ida_03'])) ? $this->New_label['voo_destino_ida_03'] : "Destino"; 
         }
         else
         {
             $SC_Label = "voo_destino_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_destino_ida_03;
   }
   //----- voo_chega_destino_ida_03
   function NM_export_voo_chega_destino_ida_03()
   {
         $this->voo_chega_destino_ida_03 = NM_charset_to_utf8($this->voo_chega_destino_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_chega_destino_ida_03'])) ? $this->New_label['voo_chega_destino_ida_03'] : "Chegada"; 
         }
         else
         {
             $SC_Label = "voo_chega_destino_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_chega_destino_ida_03;
   }
   //----- voo_cia_ida_03
   function NM_export_voo_cia_ida_03()
   {
         $this->voo_cia_ida_03 = NM_charset_to_utf8($this->voo_cia_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_cia_ida_03'])) ? $this->New_label['voo_cia_ida_03'] : "Cia."; 
         }
         else
         {
             $SC_Label = "voo_cia_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_cia_ida_03;
   }
   //----- voo_numvoo_ida_03
   function NM_export_voo_numvoo_ida_03()
   {
         $this->voo_numvoo_ida_03 = NM_charset_to_utf8($this->voo_numvoo_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_numvoo_ida_03'])) ? $this->New_label['voo_numvoo_ida_03'] : "Num. Voo"; 
         }
         else
         {
             $SC_Label = "voo_numvoo_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_numvoo_ida_03;
   }
   //----- voo_localizador_ida_03
   function NM_export_voo_localizador_ida_03()
   {
         $this->voo_localizador_ida_03 = NM_charset_to_utf8($this->voo_localizador_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_localizador_ida_03'])) ? $this->New_label['voo_localizador_ida_03'] : "Localizador"; 
         }
         else
         {
             $SC_Label = "voo_localizador_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_localizador_ida_03;
   }
   //----- voo_etkt_ida_03
   function NM_export_voo_etkt_ida_03()
   {
         $this->voo_etkt_ida_03 = NM_charset_to_utf8($this->voo_etkt_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_etkt_ida_03'])) ? $this->New_label['voo_etkt_ida_03'] : "Voo"; 
         }
         else
         {
             $SC_Label = "voo_etkt_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_etkt_ida_03;
   }
   //----- voo_assento_ida_03
   function NM_export_voo_assento_ida_03()
   {
         $this->voo_assento_ida_03 = NM_charset_to_utf8($this->voo_assento_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_assento_ida_03'])) ? $this->New_label['voo_assento_ida_03'] : "Assento"; 
         }
         else
         {
             $SC_Label = "voo_assento_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_assento_ida_03;
   }
   //----- voo_comprado_bvt_ida_03
   function NM_export_voo_comprado_bvt_ida_03()
   {
         $this->voo_comprado_bvt_ida_03 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_comprado_bvt_ida_03'])) ? $this->New_label['voo_comprado_bvt_ida_03'] : "Comprado com Belvitur"; 
         }
         else
         {
             $SC_Label = "voo_comprado_bvt_ida_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_comprado_bvt_ida_03;
   }
   //----- voo_origem_ida_04
   function NM_export_voo_origem_ida_04()
   {
         $this->voo_origem_ida_04 = NM_charset_to_utf8($this->voo_origem_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_origem_ida_04'])) ? $this->New_label['voo_origem_ida_04'] : "Origem"; 
         }
         else
         {
             $SC_Label = "voo_origem_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_origem_ida_04;
   }
   //----- voo_saida_origem_ida_04
   function NM_export_voo_saida_origem_ida_04()
   {
         $this->voo_saida_origem_ida_04 = NM_charset_to_utf8($this->voo_saida_origem_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_saida_origem_ida_04'])) ? $this->New_label['voo_saida_origem_ida_04'] : "Saída"; 
         }
         else
         {
             $SC_Label = "voo_saida_origem_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_saida_origem_ida_04;
   }
   //----- voo_destino_ida_04
   function NM_export_voo_destino_ida_04()
   {
         $this->voo_destino_ida_04 = NM_charset_to_utf8($this->voo_destino_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_destino_ida_04'])) ? $this->New_label['voo_destino_ida_04'] : "Destino"; 
         }
         else
         {
             $SC_Label = "voo_destino_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_destino_ida_04;
   }
   //----- voo_chega_destino_ida_04
   function NM_export_voo_chega_destino_ida_04()
   {
         $this->voo_chega_destino_ida_04 = NM_charset_to_utf8($this->voo_chega_destino_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_chega_destino_ida_04'])) ? $this->New_label['voo_chega_destino_ida_04'] : "Chegada"; 
         }
         else
         {
             $SC_Label = "voo_chega_destino_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_chega_destino_ida_04;
   }
   //----- voo_cia_ida_04
   function NM_export_voo_cia_ida_04()
   {
         $this->voo_cia_ida_04 = NM_charset_to_utf8($this->voo_cia_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_cia_ida_04'])) ? $this->New_label['voo_cia_ida_04'] : "Cia."; 
         }
         else
         {
             $SC_Label = "voo_cia_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_cia_ida_04;
   }
   //----- voo_numvoo_ida_04
   function NM_export_voo_numvoo_ida_04()
   {
         $this->voo_numvoo_ida_04 = NM_charset_to_utf8($this->voo_numvoo_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_numvoo_ida_04'])) ? $this->New_label['voo_numvoo_ida_04'] : "Num. Voo"; 
         }
         else
         {
             $SC_Label = "voo_numvoo_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_numvoo_ida_04;
   }
   //----- voo_localizador_ida_04
   function NM_export_voo_localizador_ida_04()
   {
         $this->voo_localizador_ida_04 = NM_charset_to_utf8($this->voo_localizador_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_localizador_ida_04'])) ? $this->New_label['voo_localizador_ida_04'] : "Localizador"; 
         }
         else
         {
             $SC_Label = "voo_localizador_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_localizador_ida_04;
   }
   //----- voo_etkt_ida_04
   function NM_export_voo_etkt_ida_04()
   {
         $this->voo_etkt_ida_04 = NM_charset_to_utf8($this->voo_etkt_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_etkt_ida_04'])) ? $this->New_label['voo_etkt_ida_04'] : "E-Ticket:"; 
         }
         else
         {
             $SC_Label = "voo_etkt_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_etkt_ida_04;
   }
   //----- voo_assento_ida_04
   function NM_export_voo_assento_ida_04()
   {
         $this->voo_assento_ida_04 = NM_charset_to_utf8($this->voo_assento_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_assento_ida_04'])) ? $this->New_label['voo_assento_ida_04'] : "Assento"; 
         }
         else
         {
             $SC_Label = "voo_assento_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_assento_ida_04;
   }
   //----- voo_comprado_bvt_ida_04
   function NM_export_voo_comprado_bvt_ida_04()
   {
         $this->voo_comprado_bvt_ida_04 = NM_charset_to_utf8($this->voo_comprado_bvt_ida_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_comprado_bvt_ida_04'])) ? $this->New_label['voo_comprado_bvt_ida_04'] : "Comprado com Belvitur"; 
         }
         else
         {
             $SC_Label = "voo_comprado_bvt_ida_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_comprado_bvt_ida_04;
   }
   //----- voo_origem_volta_01
   function NM_export_voo_origem_volta_01()
   {
         $this->voo_origem_volta_01 = NM_charset_to_utf8($this->voo_origem_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_origem_volta_01'])) ? $this->New_label['voo_origem_volta_01'] : "Origem"; 
         }
         else
         {
             $SC_Label = "voo_origem_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_origem_volta_01;
   }
   //----- voo_saida_origem_volta_01
   function NM_export_voo_saida_origem_volta_01()
   {
         $this->voo_saida_origem_volta_01 = NM_charset_to_utf8($this->voo_saida_origem_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_saida_origem_volta_01'])) ? $this->New_label['voo_saida_origem_volta_01'] : "Saída "; 
         }
         else
         {
             $SC_Label = "voo_saida_origem_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_saida_origem_volta_01;
   }
   //----- voo_destino_volta_01
   function NM_export_voo_destino_volta_01()
   {
         $this->voo_destino_volta_01 = NM_charset_to_utf8($this->voo_destino_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_destino_volta_01'])) ? $this->New_label['voo_destino_volta_01'] : "Destino"; 
         }
         else
         {
             $SC_Label = "voo_destino_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_destino_volta_01;
   }
   //----- voo_chega_destino_volta_01
   function NM_export_voo_chega_destino_volta_01()
   {
         $this->voo_chega_destino_volta_01 = NM_charset_to_utf8($this->voo_chega_destino_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_chega_destino_volta_01'])) ? $this->New_label['voo_chega_destino_volta_01'] : "Chegada"; 
         }
         else
         {
             $SC_Label = "voo_chega_destino_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_chega_destino_volta_01;
   }
   //----- voo_cia_volta_01
   function NM_export_voo_cia_volta_01()
   {
         $this->voo_cia_volta_01 = NM_charset_to_utf8($this->voo_cia_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_cia_volta_01'])) ? $this->New_label['voo_cia_volta_01'] : "Cia."; 
         }
         else
         {
             $SC_Label = "voo_cia_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_cia_volta_01;
   }
   //----- voo_numvoo_volta_01
   function NM_export_voo_numvoo_volta_01()
   {
         $this->voo_numvoo_volta_01 = NM_charset_to_utf8($this->voo_numvoo_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_numvoo_volta_01'])) ? $this->New_label['voo_numvoo_volta_01'] : "Num. Voo"; 
         }
         else
         {
             $SC_Label = "voo_numvoo_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_numvoo_volta_01;
   }
   //----- voo_localizador_volta_01
   function NM_export_voo_localizador_volta_01()
   {
         $this->voo_localizador_volta_01 = NM_charset_to_utf8($this->voo_localizador_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_localizador_volta_01'])) ? $this->New_label['voo_localizador_volta_01'] : "Localizador"; 
         }
         else
         {
             $SC_Label = "voo_localizador_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_localizador_volta_01;
   }
   //----- voo_etkt_volta_01
   function NM_export_voo_etkt_volta_01()
   {
         $this->voo_etkt_volta_01 = NM_charset_to_utf8($this->voo_etkt_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_etkt_volta_01'])) ? $this->New_label['voo_etkt_volta_01'] : "E-ticket"; 
         }
         else
         {
             $SC_Label = "voo_etkt_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_etkt_volta_01;
   }
   //----- voo_assento_volta_01
   function NM_export_voo_assento_volta_01()
   {
         $this->voo_assento_volta_01 = NM_charset_to_utf8($this->voo_assento_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_assento_volta_01'])) ? $this->New_label['voo_assento_volta_01'] : "Assento"; 
         }
         else
         {
             $SC_Label = "voo_assento_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_assento_volta_01;
   }
   //----- voo_comprado_bvt_volta_01
   function NM_export_voo_comprado_bvt_volta_01()
   {
         $this->voo_comprado_bvt_volta_01 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_comprado_bvt_volta_01'])) ? $this->New_label['voo_comprado_bvt_volta_01'] : "Comprado com Belvitur"; 
         }
         else
         {
             $SC_Label = "voo_comprado_bvt_volta_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_comprado_bvt_volta_01;
   }
   //----- voo_origem_volta_02
   function NM_export_voo_origem_volta_02()
   {
         $this->voo_origem_volta_02 = NM_charset_to_utf8($this->voo_origem_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_origem_volta_02'])) ? $this->New_label['voo_origem_volta_02'] : "Origem"; 
         }
         else
         {
             $SC_Label = "voo_origem_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_origem_volta_02;
   }
   //----- voo_saida_origem_volta_02
   function NM_export_voo_saida_origem_volta_02()
   {
         $this->voo_saida_origem_volta_02 = NM_charset_to_utf8($this->voo_saida_origem_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_saida_origem_volta_02'])) ? $this->New_label['voo_saida_origem_volta_02'] : "Saída:"; 
         }
         else
         {
             $SC_Label = "voo_saida_origem_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_saida_origem_volta_02;
   }
   //----- voo_destino_volta_02
   function NM_export_voo_destino_volta_02()
   {
         $this->voo_destino_volta_02 = NM_charset_to_utf8($this->voo_destino_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_destino_volta_02'])) ? $this->New_label['voo_destino_volta_02'] : "Destino"; 
         }
         else
         {
             $SC_Label = "voo_destino_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_destino_volta_02;
   }
   //----- voo_chega_destino_volta_02
   function NM_export_voo_chega_destino_volta_02()
   {
         $this->voo_chega_destino_volta_02 = NM_charset_to_utf8($this->voo_chega_destino_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_chega_destino_volta_02'])) ? $this->New_label['voo_chega_destino_volta_02'] : "Chegada"; 
         }
         else
         {
             $SC_Label = "voo_chega_destino_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_chega_destino_volta_02;
   }
   //----- voo_cia_volta_02
   function NM_export_voo_cia_volta_02()
   {
         $this->voo_cia_volta_02 = NM_charset_to_utf8($this->voo_cia_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_cia_volta_02'])) ? $this->New_label['voo_cia_volta_02'] : "Cia."; 
         }
         else
         {
             $SC_Label = "voo_cia_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_cia_volta_02;
   }
   //----- voo_numvoo_volta_02
   function NM_export_voo_numvoo_volta_02()
   {
         $this->voo_numvoo_volta_02 = NM_charset_to_utf8($this->voo_numvoo_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_numvoo_volta_02'])) ? $this->New_label['voo_numvoo_volta_02'] : "Num. Voo:"; 
         }
         else
         {
             $SC_Label = "voo_numvoo_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_numvoo_volta_02;
   }
   //----- voo_localizador_volta_02
   function NM_export_voo_localizador_volta_02()
   {
         $this->voo_localizador_volta_02 = NM_charset_to_utf8($this->voo_localizador_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_localizador_volta_02'])) ? $this->New_label['voo_localizador_volta_02'] : "Localiador"; 
         }
         else
         {
             $SC_Label = "voo_localizador_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_localizador_volta_02;
   }
   //----- voo_etkt_volta_02
   function NM_export_voo_etkt_volta_02()
   {
         $this->voo_etkt_volta_02 = NM_charset_to_utf8($this->voo_etkt_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_etkt_volta_02'])) ? $this->New_label['voo_etkt_volta_02'] : "E-ticket"; 
         }
         else
         {
             $SC_Label = "voo_etkt_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_etkt_volta_02;
   }
   //----- voo_assento_volta_02
   function NM_export_voo_assento_volta_02()
   {
         $this->voo_assento_volta_02 = NM_charset_to_utf8($this->voo_assento_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_assento_volta_02'])) ? $this->New_label['voo_assento_volta_02'] : "Assento"; 
         }
         else
         {
             $SC_Label = "voo_assento_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_assento_volta_02;
   }
   //----- voo_comprado_bvt_volta_02
   function NM_export_voo_comprado_bvt_volta_02()
   {
         $this->voo_comprado_bvt_volta_02 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_comprado_bvt_volta_02'])) ? $this->New_label['voo_comprado_bvt_volta_02'] : "Comprado com Belvitur"; 
         }
         else
         {
             $SC_Label = "voo_comprado_bvt_volta_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_comprado_bvt_volta_02;
   }
   //----- voo_origem_volta_03
   function NM_export_voo_origem_volta_03()
   {
         $this->voo_origem_volta_03 = NM_charset_to_utf8($this->voo_origem_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_origem_volta_03'])) ? $this->New_label['voo_origem_volta_03'] : "Origem"; 
         }
         else
         {
             $SC_Label = "voo_origem_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_origem_volta_03;
   }
   //----- voo_saida_origem_volta_03
   function NM_export_voo_saida_origem_volta_03()
   {
         $this->voo_saida_origem_volta_03 = NM_charset_to_utf8($this->voo_saida_origem_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_saida_origem_volta_03'])) ? $this->New_label['voo_saida_origem_volta_03'] : "Saída"; 
         }
         else
         {
             $SC_Label = "voo_saida_origem_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_saida_origem_volta_03;
   }
   //----- voo_destino_volta_03
   function NM_export_voo_destino_volta_03()
   {
         $this->voo_destino_volta_03 = NM_charset_to_utf8($this->voo_destino_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_destino_volta_03'])) ? $this->New_label['voo_destino_volta_03'] : "Destino"; 
         }
         else
         {
             $SC_Label = "voo_destino_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_destino_volta_03;
   }
   //----- voo_chega_destino_volta_03
   function NM_export_voo_chega_destino_volta_03()
   {
         $this->voo_chega_destino_volta_03 = NM_charset_to_utf8($this->voo_chega_destino_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_chega_destino_volta_03'])) ? $this->New_label['voo_chega_destino_volta_03'] : "Chegada"; 
         }
         else
         {
             $SC_Label = "voo_chega_destino_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_chega_destino_volta_03;
   }
   //----- voo_cia_volta_03
   function NM_export_voo_cia_volta_03()
   {
         $this->voo_cia_volta_03 = NM_charset_to_utf8($this->voo_cia_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_cia_volta_03'])) ? $this->New_label['voo_cia_volta_03'] : "Cia."; 
         }
         else
         {
             $SC_Label = "voo_cia_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_cia_volta_03;
   }
   //----- voo_numvoo_volta_03
   function NM_export_voo_numvoo_volta_03()
   {
         $this->voo_numvoo_volta_03 = NM_charset_to_utf8($this->voo_numvoo_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_numvoo_volta_03'])) ? $this->New_label['voo_numvoo_volta_03'] : "Num. Voo:"; 
         }
         else
         {
             $SC_Label = "voo_numvoo_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_numvoo_volta_03;
   }
   //----- voo_localizador_volta_03
   function NM_export_voo_localizador_volta_03()
   {
         $this->voo_localizador_volta_03 = NM_charset_to_utf8($this->voo_localizador_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_localizador_volta_03'])) ? $this->New_label['voo_localizador_volta_03'] : "Localizador"; 
         }
         else
         {
             $SC_Label = "voo_localizador_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_localizador_volta_03;
   }
   //----- voo_etkt_volta_03
   function NM_export_voo_etkt_volta_03()
   {
         $this->voo_etkt_volta_03 = NM_charset_to_utf8($this->voo_etkt_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_etkt_volta_03'])) ? $this->New_label['voo_etkt_volta_03'] : "E-ticket"; 
         }
         else
         {
             $SC_Label = "voo_etkt_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_etkt_volta_03;
   }
   //----- voo_assento_volta_03
   function NM_export_voo_assento_volta_03()
   {
         $this->voo_assento_volta_03 = NM_charset_to_utf8($this->voo_assento_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_assento_volta_03'])) ? $this->New_label['voo_assento_volta_03'] : "Assento"; 
         }
         else
         {
             $SC_Label = "voo_assento_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_assento_volta_03;
   }
   //----- voo_comprado_bvt_volta_03
   function NM_export_voo_comprado_bvt_volta_03()
   {
         $this->voo_comprado_bvt_volta_03 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_comprado_bvt_volta_03'])) ? $this->New_label['voo_comprado_bvt_volta_03'] : "Comprado com Belvitur"; 
         }
         else
         {
             $SC_Label = "voo_comprado_bvt_volta_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_comprado_bvt_volta_03;
   }
   //----- voo_origem_volta_04
   function NM_export_voo_origem_volta_04()
   {
         $this->voo_origem_volta_04 = NM_charset_to_utf8($this->voo_origem_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_origem_volta_04'])) ? $this->New_label['voo_origem_volta_04'] : "Origem"; 
         }
         else
         {
             $SC_Label = "voo_origem_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_origem_volta_04;
   }
   //----- voo_saida_origem_volta_04
   function NM_export_voo_saida_origem_volta_04()
   {
         $this->voo_saida_origem_volta_04 = NM_charset_to_utf8($this->voo_saida_origem_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_saida_origem_volta_04'])) ? $this->New_label['voo_saida_origem_volta_04'] : "Saída"; 
         }
         else
         {
             $SC_Label = "voo_saida_origem_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_saida_origem_volta_04;
   }
   //----- voo_destino_volta_04
   function NM_export_voo_destino_volta_04()
   {
         $this->voo_destino_volta_04 = NM_charset_to_utf8($this->voo_destino_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_destino_volta_04'])) ? $this->New_label['voo_destino_volta_04'] : "Destino"; 
         }
         else
         {
             $SC_Label = "voo_destino_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_destino_volta_04;
   }
   //----- voo_chega_destino_volta_04
   function NM_export_voo_chega_destino_volta_04()
   {
         $this->voo_chega_destino_volta_04 = NM_charset_to_utf8($this->voo_chega_destino_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_chega_destino_volta_04'])) ? $this->New_label['voo_chega_destino_volta_04'] : "Chegada"; 
         }
         else
         {
             $SC_Label = "voo_chega_destino_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_chega_destino_volta_04;
   }
   //----- voo_cia_volta_04
   function NM_export_voo_cia_volta_04()
   {
         $this->voo_cia_volta_04 = NM_charset_to_utf8($this->voo_cia_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_cia_volta_04'])) ? $this->New_label['voo_cia_volta_04'] : "Cia."; 
         }
         else
         {
             $SC_Label = "voo_cia_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_cia_volta_04;
   }
   //----- voo_numvoo_volta_04
   function NM_export_voo_numvoo_volta_04()
   {
         $this->voo_numvoo_volta_04 = NM_charset_to_utf8($this->voo_numvoo_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_numvoo_volta_04'])) ? $this->New_label['voo_numvoo_volta_04'] : "Num. Voo"; 
         }
         else
         {
             $SC_Label = "voo_numvoo_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_numvoo_volta_04;
   }
   //----- voo_localizador_volta_04
   function NM_export_voo_localizador_volta_04()
   {
         $this->voo_localizador_volta_04 = NM_charset_to_utf8($this->voo_localizador_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_localizador_volta_04'])) ? $this->New_label['voo_localizador_volta_04'] : "Localizador"; 
         }
         else
         {
             $SC_Label = "voo_localizador_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_localizador_volta_04;
   }
   //----- voo_etkt_volta_04
   function NM_export_voo_etkt_volta_04()
   {
         $this->voo_etkt_volta_04 = NM_charset_to_utf8($this->voo_etkt_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_etkt_volta_04'])) ? $this->New_label['voo_etkt_volta_04'] : "E-ticket"; 
         }
         else
         {
             $SC_Label = "voo_etkt_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_etkt_volta_04;
   }
   //----- voo_assento_volta_04
   function NM_export_voo_assento_volta_04()
   {
         $this->voo_assento_volta_04 = NM_charset_to_utf8($this->voo_assento_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_assento_volta_04'])) ? $this->New_label['voo_assento_volta_04'] : "Assento"; 
         }
         else
         {
             $SC_Label = "voo_assento_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_assento_volta_04;
   }
   //----- voo_comprado_bvt_volta_04
   function NM_export_voo_comprado_bvt_volta_04()
   {
         $this->voo_comprado_bvt_volta_04 = NM_charset_to_utf8($this->voo_comprado_bvt_volta_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_comprado_bvt_volta_04'])) ? $this->New_label['voo_comprado_bvt_volta_04'] : "Comprado com Belvitur"; 
         }
         else
         {
             $SC_Label = "voo_comprado_bvt_volta_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_comprado_bvt_volta_04;
   }
   //----- participante_obs
   function NM_export_participante_obs()
   {
         $this->participante_obs = NM_charset_to_utf8($this->participante_obs);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['participante_obs'])) ? $this->New_label['participante_obs'] : ""; 
         }
         else
         {
             $SC_Label = "participante_obs"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->participante_obs;
   }
   //----- voo_observacoes_ida
   function NM_export_voo_observacoes_ida()
   {
         $this->voo_observacoes_ida = NM_charset_to_utf8($this->voo_observacoes_ida);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['voo_observacoes_ida'])) ? $this->New_label['voo_observacoes_ida'] : ""; 
         }
         else
         {
             $SC_Label = "voo_observacoes_ida"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->voo_observacoes_ida;
   }
   //----- logo_hospedagem
   function NM_export_logo_hospedagem()
   {
         $this->logo_hospedagem = NM_charset_to_utf8($this->logo_hospedagem);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['logo_hospedagem'])) ? $this->New_label['logo_hospedagem'] : ""; 
         }
         else
         {
             $SC_Label = "logo_hospedagem"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->logo_hospedagem;
   }
   //----- hosp_fantasia_hotel_01
   function NM_export_hosp_fantasia_hotel_01()
   {
         $this->hosp_fantasia_hotel_01 = NM_charset_to_utf8($this->hosp_fantasia_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_fantasia_hotel_01'])) ? $this->New_label['hosp_fantasia_hotel_01'] : "Hotel"; 
         }
         else
         {
             $SC_Label = "hosp_fantasia_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_fantasia_hotel_01;
   }
   //----- hosp_logradouro_hotel_01
   function NM_export_hosp_logradouro_hotel_01()
   {
         $this->hosp_logradouro_hotel_01 = NM_charset_to_utf8($this->hosp_logradouro_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_logradouro_hotel_01'])) ? $this->New_label['hosp_logradouro_hotel_01'] : "Logradouro"; 
         }
         else
         {
             $SC_Label = "hosp_logradouro_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_logradouro_hotel_01;
   }
   //----- hosp_numero_hotel_01
   function NM_export_hosp_numero_hotel_01()
   {
         $this->hosp_numero_hotel_01 = NM_charset_to_utf8($this->hosp_numero_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_numero_hotel_01'])) ? $this->New_label['hosp_numero_hotel_01'] : "Número"; 
         }
         else
         {
             $SC_Label = "hosp_numero_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_numero_hotel_01;
   }
   //----- hosp_complemento_hotel_01
   function NM_export_hosp_complemento_hotel_01()
   {
         $this->hosp_complemento_hotel_01 = NM_charset_to_utf8($this->hosp_complemento_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_complemento_hotel_01'])) ? $this->New_label['hosp_complemento_hotel_01'] : "Complemento"; 
         }
         else
         {
             $SC_Label = "hosp_complemento_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_complemento_hotel_01;
   }
   //----- hosp_municipio_hotel_01
   function NM_export_hosp_municipio_hotel_01()
   {
         $this->hosp_municipio_hotel_01 = NM_charset_to_utf8($this->hosp_municipio_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_municipio_hotel_01'])) ? $this->New_label['hosp_municipio_hotel_01'] : "Município"; 
         }
         else
         {
             $SC_Label = "hosp_municipio_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_municipio_hotel_01;
   }
   //----- hosp_uf_hotel_01
   function NM_export_hosp_uf_hotel_01()
   {
         $this->hosp_uf_hotel_01 = NM_charset_to_utf8($this->hosp_uf_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_uf_hotel_01'])) ? $this->New_label['hosp_uf_hotel_01'] : "UF"; 
         }
         else
         {
             $SC_Label = "hosp_uf_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_uf_hotel_01;
   }
   //----- hosp_cep_hotel_01
   function NM_export_hosp_cep_hotel_01()
   {
         $this->hosp_cep_hotel_01 = NM_charset_to_utf8($this->hosp_cep_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_cep_hotel_01'])) ? $this->New_label['hosp_cep_hotel_01'] : "CEP"; 
         }
         else
         {
             $SC_Label = "hosp_cep_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_cep_hotel_01;
   }
   //----- hosp_pais_hotel_01
   function NM_export_hosp_pais_hotel_01()
   {
         $this->hosp_pais_hotel_01 = NM_charset_to_utf8($this->hosp_pais_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_pais_hotel_01'])) ? $this->New_label['hosp_pais_hotel_01'] : "Pais"; 
         }
         else
         {
             $SC_Label = "hosp_pais_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_pais_hotel_01;
   }
   //----- hosp_acomodacao_hotel_01
   function NM_export_hosp_acomodacao_hotel_01()
   {
         $this->hosp_acomodacao_hotel_01 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_acomodacao_hotel_01'])) ? $this->New_label['hosp_acomodacao_hotel_01'] : "Acomodação"; 
         }
         else
         {
             $SC_Label = "hosp_acomodacao_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_acomodacao_hotel_01;
   }
   //----- hosp_categoria_hotel_01
   function NM_export_hosp_categoria_hotel_01()
   {
         $this->hosp_categoria_hotel_01 = NM_charset_to_utf8($this->hosp_categoria_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_categoria_hotel_01'])) ? $this->New_label['hosp_categoria_hotel_01'] : "Categoria"; 
         }
         else
         {
             $SC_Label = "hosp_categoria_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_categoria_hotel_01;
   }
   //----- hosp_checkin_hotel_01
   function NM_export_hosp_checkin_hotel_01()
   {
         $this->hosp_checkin_hotel_01 = NM_charset_to_utf8($this->hosp_checkin_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_checkin_hotel_01'])) ? $this->New_label['hosp_checkin_hotel_01'] : "Data CheckIn"; 
         }
         else
         {
             $SC_Label = "hosp_checkin_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_checkin_hotel_01;
   }
   //----- hosp_hr_ckeckin_hotel_01
   function NM_export_hosp_hr_ckeckin_hotel_01()
   {
         $this->hosp_hr_ckeckin_hotel_01 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_hr_ckeckin_hotel_01'])) ? $this->New_label['hosp_hr_ckeckin_hotel_01'] : "Hora CheckIn"; 
         }
         else
         {
             $SC_Label = "hosp_hr_ckeckin_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_hr_ckeckin_hotel_01;
   }
   //----- hosp_checkout_hotel_01
   function NM_export_hosp_checkout_hotel_01()
   {
         $this->hosp_checkout_hotel_01 = NM_charset_to_utf8($this->hosp_checkout_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_checkout_hotel_01'])) ? $this->New_label['hosp_checkout_hotel_01'] : "Data CheckOut"; 
         }
         else
         {
             $SC_Label = "hosp_checkout_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_checkout_hotel_01;
   }
   //----- hosp_hr_ckeckout_hotel_01
   function NM_export_hosp_hr_ckeckout_hotel_01()
   {
         $this->hosp_hr_ckeckout_hotel_01 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_hr_ckeckout_hotel_01'])) ? $this->New_label['hosp_hr_ckeckout_hotel_01'] : "Hora CheckOut"; 
         }
         else
         {
             $SC_Label = "hosp_hr_ckeckout_hotel_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_hr_ckeckout_hotel_01;
   }
   //----- hosp_fantasia_hotel_02
   function NM_export_hosp_fantasia_hotel_02()
   {
         $this->hosp_fantasia_hotel_02 = NM_charset_to_utf8($this->hosp_fantasia_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_fantasia_hotel_02'])) ? $this->New_label['hosp_fantasia_hotel_02'] : "Hotel"; 
         }
         else
         {
             $SC_Label = "hosp_fantasia_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_fantasia_hotel_02;
   }
   //----- hosp_logradouro_hotel_02
   function NM_export_hosp_logradouro_hotel_02()
   {
         $this->hosp_logradouro_hotel_02 = NM_charset_to_utf8($this->hosp_logradouro_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_logradouro_hotel_02'])) ? $this->New_label['hosp_logradouro_hotel_02'] : "Logradouro"; 
         }
         else
         {
             $SC_Label = "hosp_logradouro_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_logradouro_hotel_02;
   }
   //----- hosp_numero_hotel_02
   function NM_export_hosp_numero_hotel_02()
   {
         $this->hosp_numero_hotel_02 = NM_charset_to_utf8($this->hosp_numero_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_numero_hotel_02'])) ? $this->New_label['hosp_numero_hotel_02'] : "Número"; 
         }
         else
         {
             $SC_Label = "hosp_numero_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_numero_hotel_02;
   }
   //----- hosp_complemento_hotel_02
   function NM_export_hosp_complemento_hotel_02()
   {
         $this->hosp_complemento_hotel_02 = NM_charset_to_utf8($this->hosp_complemento_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_complemento_hotel_02'])) ? $this->New_label['hosp_complemento_hotel_02'] : "Complemento"; 
         }
         else
         {
             $SC_Label = "hosp_complemento_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_complemento_hotel_02;
   }
   //----- hosp_municipio_hotel_02
   function NM_export_hosp_municipio_hotel_02()
   {
         $this->hosp_municipio_hotel_02 = NM_charset_to_utf8($this->hosp_municipio_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_municipio_hotel_02'])) ? $this->New_label['hosp_municipio_hotel_02'] : "Município"; 
         }
         else
         {
             $SC_Label = "hosp_municipio_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_municipio_hotel_02;
   }
   //----- hosp_uf_hotel_02
   function NM_export_hosp_uf_hotel_02()
   {
         $this->hosp_uf_hotel_02 = NM_charset_to_utf8($this->hosp_uf_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_uf_hotel_02'])) ? $this->New_label['hosp_uf_hotel_02'] : "UF"; 
         }
         else
         {
             $SC_Label = "hosp_uf_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_uf_hotel_02;
   }
   //----- hosp_cep_hotel_02
   function NM_export_hosp_cep_hotel_02()
   {
         $this->hosp_cep_hotel_02 = NM_charset_to_utf8($this->hosp_cep_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_cep_hotel_02'])) ? $this->New_label['hosp_cep_hotel_02'] : "CEP"; 
         }
         else
         {
             $SC_Label = "hosp_cep_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_cep_hotel_02;
   }
   //----- hosp_pais_hotel_02
   function NM_export_hosp_pais_hotel_02()
   {
         $this->hosp_pais_hotel_02 = NM_charset_to_utf8($this->hosp_pais_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_pais_hotel_02'])) ? $this->New_label['hosp_pais_hotel_02'] : "País"; 
         }
         else
         {
             $SC_Label = "hosp_pais_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_pais_hotel_02;
   }
   //----- hosp_acomodacao_hotel_02
   function NM_export_hosp_acomodacao_hotel_02()
   {
         $this->hosp_acomodacao_hotel_02 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_acomodacao_hotel_02'])) ? $this->New_label['hosp_acomodacao_hotel_02'] : "Acomodação"; 
         }
         else
         {
             $SC_Label = "hosp_acomodacao_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_acomodacao_hotel_02;
   }
   //----- hosp_categoria_hotel_02
   function NM_export_hosp_categoria_hotel_02()
   {
         $this->hosp_categoria_hotel_02 = NM_charset_to_utf8($this->hosp_categoria_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_categoria_hotel_02'])) ? $this->New_label['hosp_categoria_hotel_02'] : "Categoria"; 
         }
         else
         {
             $SC_Label = "hosp_categoria_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_categoria_hotel_02;
   }
   //----- hosp_checkin_hotel_02
   function NM_export_hosp_checkin_hotel_02()
   {
         $this->hosp_checkin_hotel_02 = NM_charset_to_utf8($this->hosp_checkin_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_checkin_hotel_02'])) ? $this->New_label['hosp_checkin_hotel_02'] : "Data CheckIn"; 
         }
         else
         {
             $SC_Label = "hosp_checkin_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_checkin_hotel_02;
   }
   //----- hosp_hr_ckeckin_hotel_02
   function NM_export_hosp_hr_ckeckin_hotel_02()
   {
         $this->hosp_hr_ckeckin_hotel_02 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_hr_ckeckin_hotel_02'])) ? $this->New_label['hosp_hr_ckeckin_hotel_02'] : "Hora CheckIn"; 
         }
         else
         {
             $SC_Label = "hosp_hr_ckeckin_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_hr_ckeckin_hotel_02;
   }
   //----- hosp_checkout_hotel_02
   function NM_export_hosp_checkout_hotel_02()
   {
         $this->hosp_checkout_hotel_02 = NM_charset_to_utf8($this->hosp_checkout_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_checkout_hotel_02'])) ? $this->New_label['hosp_checkout_hotel_02'] : "Data CheckOut"; 
         }
         else
         {
             $SC_Label = "hosp_checkout_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_checkout_hotel_02;
   }
   //----- hosp_hr_ckeckout_hotel_02
   function NM_export_hosp_hr_ckeckout_hotel_02()
   {
         $this->hosp_hr_ckeckout_hotel_02 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_hr_ckeckout_hotel_02'])) ? $this->New_label['hosp_hr_ckeckout_hotel_02'] : "Data CheckOut"; 
         }
         else
         {
             $SC_Label = "hosp_hr_ckeckout_hotel_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_hr_ckeckout_hotel_02;
   }
   //----- hosp_fantasia_hotel_03
   function NM_export_hosp_fantasia_hotel_03()
   {
         $this->hosp_fantasia_hotel_03 = NM_charset_to_utf8($this->hosp_fantasia_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_fantasia_hotel_03'])) ? $this->New_label['hosp_fantasia_hotel_03'] : "Hotel"; 
         }
         else
         {
             $SC_Label = "hosp_fantasia_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_fantasia_hotel_03;
   }
   //----- hosp_logradouro_hotel_03
   function NM_export_hosp_logradouro_hotel_03()
   {
         $this->hosp_logradouro_hotel_03 = NM_charset_to_utf8($this->hosp_logradouro_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_logradouro_hotel_03'])) ? $this->New_label['hosp_logradouro_hotel_03'] : "Logradouro"; 
         }
         else
         {
             $SC_Label = "hosp_logradouro_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_logradouro_hotel_03;
   }
   //----- hosp_numero_hotel_03
   function NM_export_hosp_numero_hotel_03()
   {
         $this->hosp_numero_hotel_03 = NM_charset_to_utf8($this->hosp_numero_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_numero_hotel_03'])) ? $this->New_label['hosp_numero_hotel_03'] : "Número"; 
         }
         else
         {
             $SC_Label = "hosp_numero_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_numero_hotel_03;
   }
   //----- hosp_complemento_hotel_03
   function NM_export_hosp_complemento_hotel_03()
   {
         $this->hosp_complemento_hotel_03 = NM_charset_to_utf8($this->hosp_complemento_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_complemento_hotel_03'])) ? $this->New_label['hosp_complemento_hotel_03'] : "Complemento"; 
         }
         else
         {
             $SC_Label = "hosp_complemento_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_complemento_hotel_03;
   }
   //----- hosp_municipio_hotel_03
   function NM_export_hosp_municipio_hotel_03()
   {
         $this->hosp_municipio_hotel_03 = NM_charset_to_utf8($this->hosp_municipio_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_municipio_hotel_03'])) ? $this->New_label['hosp_municipio_hotel_03'] : "Município"; 
         }
         else
         {
             $SC_Label = "hosp_municipio_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_municipio_hotel_03;
   }
   //----- hosp_uf_hotel_03
   function NM_export_hosp_uf_hotel_03()
   {
         $this->hosp_uf_hotel_03 = NM_charset_to_utf8($this->hosp_uf_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_uf_hotel_03'])) ? $this->New_label['hosp_uf_hotel_03'] : "UF"; 
         }
         else
         {
             $SC_Label = "hosp_uf_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_uf_hotel_03;
   }
   //----- hosp_cep_hotel_03
   function NM_export_hosp_cep_hotel_03()
   {
         $this->hosp_cep_hotel_03 = NM_charset_to_utf8($this->hosp_cep_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_cep_hotel_03'])) ? $this->New_label['hosp_cep_hotel_03'] : "CEP"; 
         }
         else
         {
             $SC_Label = "hosp_cep_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_cep_hotel_03;
   }
   //----- hosp_pais_hotel_03
   function NM_export_hosp_pais_hotel_03()
   {
         $this->hosp_pais_hotel_03 = NM_charset_to_utf8($this->hosp_pais_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_pais_hotel_03'])) ? $this->New_label['hosp_pais_hotel_03'] : "País"; 
         }
         else
         {
             $SC_Label = "hosp_pais_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_pais_hotel_03;
   }
   //----- hosp_acomodacao_hotel_03
   function NM_export_hosp_acomodacao_hotel_03()
   {
         $this->hosp_acomodacao_hotel_03 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_acomodacao_hotel_03'])) ? $this->New_label['hosp_acomodacao_hotel_03'] : "Acomodação"; 
         }
         else
         {
             $SC_Label = "hosp_acomodacao_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_acomodacao_hotel_03;
   }
   //----- hosp_categoria_hotel_03
   function NM_export_hosp_categoria_hotel_03()
   {
         $this->hosp_categoria_hotel_03 = NM_charset_to_utf8($this->hosp_categoria_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_categoria_hotel_03'])) ? $this->New_label['hosp_categoria_hotel_03'] : "Categoria"; 
         }
         else
         {
             $SC_Label = "hosp_categoria_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_categoria_hotel_03;
   }
   //----- hosp_checkin_hotel_03
   function NM_export_hosp_checkin_hotel_03()
   {
         $this->hosp_checkin_hotel_03 = NM_charset_to_utf8($this->hosp_checkin_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_checkin_hotel_03'])) ? $this->New_label['hosp_checkin_hotel_03'] : "Data CheckIn"; 
         }
         else
         {
             $SC_Label = "hosp_checkin_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_checkin_hotel_03;
   }
   //----- hosp_hr_ckeckin_hotel_03
   function NM_export_hosp_hr_ckeckin_hotel_03()
   {
         $this->hosp_hr_ckeckin_hotel_03 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_hr_ckeckin_hotel_03'])) ? $this->New_label['hosp_hr_ckeckin_hotel_03'] : "Hora CheckIn"; 
         }
         else
         {
             $SC_Label = "hosp_hr_ckeckin_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_hr_ckeckin_hotel_03;
   }
   //----- hosp_checkout_hotel_03
   function NM_export_hosp_checkout_hotel_03()
   {
         $this->hosp_checkout_hotel_03 = NM_charset_to_utf8($this->hosp_checkout_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_checkout_hotel_03'])) ? $this->New_label['hosp_checkout_hotel_03'] : "Data CheckOut"; 
         }
         else
         {
             $SC_Label = "hosp_checkout_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_checkout_hotel_03;
   }
   //----- hosp_hr_ckeckout_hotel_03
   function NM_export_hosp_hr_ckeckout_hotel_03()
   {
         $this->hosp_hr_ckeckout_hotel_03 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_hr_ckeckout_hotel_03'])) ? $this->New_label['hosp_hr_ckeckout_hotel_03'] : "Data CheckOut"; 
         }
         else
         {
             $SC_Label = "hosp_hr_ckeckout_hotel_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_hr_ckeckout_hotel_03;
   }
   //----- hosp_fantasia_hotel_04
   function NM_export_hosp_fantasia_hotel_04()
   {
         $this->hosp_fantasia_hotel_04 = NM_charset_to_utf8($this->hosp_fantasia_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_fantasia_hotel_04'])) ? $this->New_label['hosp_fantasia_hotel_04'] : "Hotel"; 
         }
         else
         {
             $SC_Label = "hosp_fantasia_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_fantasia_hotel_04;
   }
   //----- hosp_logradouro_hotel_04
   function NM_export_hosp_logradouro_hotel_04()
   {
         $this->hosp_logradouro_hotel_04 = NM_charset_to_utf8($this->hosp_logradouro_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_logradouro_hotel_04'])) ? $this->New_label['hosp_logradouro_hotel_04'] : "Logradouro"; 
         }
         else
         {
             $SC_Label = "hosp_logradouro_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_logradouro_hotel_04;
   }
   //----- hosp_numero_hotel_04
   function NM_export_hosp_numero_hotel_04()
   {
         $this->hosp_numero_hotel_04 = NM_charset_to_utf8($this->hosp_numero_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_numero_hotel_04'])) ? $this->New_label['hosp_numero_hotel_04'] : "Número"; 
         }
         else
         {
             $SC_Label = "hosp_numero_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_numero_hotel_04;
   }
   //----- hosp_complemento_hotel_04
   function NM_export_hosp_complemento_hotel_04()
   {
         $this->hosp_complemento_hotel_04 = NM_charset_to_utf8($this->hosp_complemento_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_complemento_hotel_04'])) ? $this->New_label['hosp_complemento_hotel_04'] : "Complemento"; 
         }
         else
         {
             $SC_Label = "hosp_complemento_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_complemento_hotel_04;
   }
   //----- hosp_municipio_hotel_04
   function NM_export_hosp_municipio_hotel_04()
   {
         $this->hosp_municipio_hotel_04 = NM_charset_to_utf8($this->hosp_municipio_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_municipio_hotel_04'])) ? $this->New_label['hosp_municipio_hotel_04'] : "Município"; 
         }
         else
         {
             $SC_Label = "hosp_municipio_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_municipio_hotel_04;
   }
   //----- hosp_uf_hotel_04
   function NM_export_hosp_uf_hotel_04()
   {
         $this->hosp_uf_hotel_04 = NM_charset_to_utf8($this->hosp_uf_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_uf_hotel_04'])) ? $this->New_label['hosp_uf_hotel_04'] : "UF"; 
         }
         else
         {
             $SC_Label = "hosp_uf_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_uf_hotel_04;
   }
   //----- hosp_cep_hotel_04
   function NM_export_hosp_cep_hotel_04()
   {
         $this->hosp_cep_hotel_04 = NM_charset_to_utf8($this->hosp_cep_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_cep_hotel_04'])) ? $this->New_label['hosp_cep_hotel_04'] : "CEP"; 
         }
         else
         {
             $SC_Label = "hosp_cep_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_cep_hotel_04;
   }
   //----- hosp_pais_hotel_04
   function NM_export_hosp_pais_hotel_04()
   {
         $this->hosp_pais_hotel_04 = NM_charset_to_utf8($this->hosp_pais_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_pais_hotel_04'])) ? $this->New_label['hosp_pais_hotel_04'] : "País"; 
         }
         else
         {
             $SC_Label = "hosp_pais_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_pais_hotel_04;
   }
   //----- hosp_acomodacao_hotel_04
   function NM_export_hosp_acomodacao_hotel_04()
   {
         $this->hosp_acomodacao_hotel_04 = NM_charset_to_utf8($this->hosp_acomodacao_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_acomodacao_hotel_04'])) ? $this->New_label['hosp_acomodacao_hotel_04'] : "Acomodação"; 
         }
         else
         {
             $SC_Label = "hosp_acomodacao_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_acomodacao_hotel_04;
   }
   //----- hosp_categoria_hotel_04
   function NM_export_hosp_categoria_hotel_04()
   {
         $this->hosp_categoria_hotel_04 = NM_charset_to_utf8($this->hosp_categoria_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_categoria_hotel_04'])) ? $this->New_label['hosp_categoria_hotel_04'] : "Categoria"; 
         }
         else
         {
             $SC_Label = "hosp_categoria_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_categoria_hotel_04;
   }
   //----- hosp_checkin_hotel_04
   function NM_export_hosp_checkin_hotel_04()
   {
         $this->hosp_checkin_hotel_04 = NM_charset_to_utf8($this->hosp_checkin_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_checkin_hotel_04'])) ? $this->New_label['hosp_checkin_hotel_04'] : "Data CheckIn"; 
         }
         else
         {
             $SC_Label = "hosp_checkin_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_checkin_hotel_04;
   }
   //----- hosp_hr_ckeckin_hotel_04
   function NM_export_hosp_hr_ckeckin_hotel_04()
   {
         $this->hosp_hr_ckeckin_hotel_04 = NM_charset_to_utf8($this->hosp_hr_ckeckin_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_hr_ckeckin_hotel_04'])) ? $this->New_label['hosp_hr_ckeckin_hotel_04'] : "Hora CheckIn"; 
         }
         else
         {
             $SC_Label = "hosp_hr_ckeckin_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_hr_ckeckin_hotel_04;
   }
   //----- hosp_checkout_hotel_04
   function NM_export_hosp_checkout_hotel_04()
   {
         $this->hosp_checkout_hotel_04 = NM_charset_to_utf8($this->hosp_checkout_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_checkout_hotel_04'])) ? $this->New_label['hosp_checkout_hotel_04'] : "Data CheckOut"; 
         }
         else
         {
             $SC_Label = "hosp_checkout_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_checkout_hotel_04;
   }
   //----- hosp_hr_ckeckout_hotel_04
   function NM_export_hosp_hr_ckeckout_hotel_04()
   {
         $this->hosp_hr_ckeckout_hotel_04 = NM_charset_to_utf8($this->hosp_hr_ckeckout_hotel_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_hr_ckeckout_hotel_04'])) ? $this->New_label['hosp_hr_ckeckout_hotel_04'] : "Hora CheckOut"; 
         }
         else
         {
             $SC_Label = "hosp_hr_ckeckout_hotel_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_hr_ckeckout_hotel_04;
   }
   //----- hosp_observacoes
   function NM_export_hosp_observacoes()
   {
         $this->hosp_observacoes = NM_charset_to_utf8($this->hosp_observacoes);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['hosp_observacoes'])) ? $this->New_label['hosp_observacoes'] : ""; 
         }
         else
         {
             $SC_Label = "hosp_observacoes"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->hosp_observacoes;
   }
   //----- logo_transfer
   function NM_export_logo_transfer()
   {
         $this->logo_transfer = NM_charset_to_utf8($this->logo_transfer);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['logo_transfer'])) ? $this->New_label['logo_transfer'] : ""; 
         }
         else
         {
             $SC_Label = "logo_transfer"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->logo_transfer;
   }
   //----- transfer_in_observacoes
   function NM_export_transfer_in_observacoes()
   {
         $this->transfer_in_observacoes = NM_charset_to_utf8($this->transfer_in_observacoes);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['transfer_in_observacoes'])) ? $this->New_label['transfer_in_observacoes'] : ""; 
         }
         else
         {
             $SC_Label = "transfer_in_observacoes"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->transfer_in_observacoes;
   }
   //----- transfer_out_observacoes
   function NM_export_transfer_out_observacoes()
   {
         $this->transfer_out_observacoes = NM_charset_to_utf8($this->transfer_out_observacoes);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['transfer_out_observacoes'])) ? $this->New_label['transfer_out_observacoes'] : ""; 
         }
         else
         {
             $SC_Label = "transfer_out_observacoes"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->transfer_out_observacoes;
   }
   //----- acompanhante_011
   function NM_export_acompanhante_011()
   {
         $this->acompanhante_011 = NM_charset_to_utf8($this->acompanhante_011);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['acompanhante_011'])) ? $this->New_label['acompanhante_011'] : "Acompanhante"; 
         }
         else
         {
             $SC_Label = "acompanhante_011"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->acompanhante_011;
   }
   //----- acompanhante_021
   function NM_export_acompanhante_021()
   {
         $this->acompanhante_021 = NM_charset_to_utf8($this->acompanhante_021);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['acompanhante_021'])) ? $this->New_label['acompanhante_021'] : "Acompanhante"; 
         }
         else
         {
             $SC_Label = "acompanhante_021"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->acompanhante_021;
   }
   //----- participante_acomp_011
   function NM_export_participante_acomp_011()
   {
         $this->participante_acomp_011 = NM_charset_to_utf8($this->participante_acomp_011);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['participante_acomp_011'])) ? $this->New_label['participante_acomp_011'] : "Acompanhante e Participante"; 
         }
         else
         {
             $SC_Label = "participante_acomp_011"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->participante_acomp_011;
   }
   //----- participante_acomp_021
   function NM_export_participante_acomp_021()
   {
         $this->participante_acomp_021 = NM_charset_to_utf8($this->participante_acomp_021);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['participante_acomp_021'])) ? $this->New_label['participante_acomp_021'] : "Acompanhante e Participante"; 
         }
         else
         {
             $SC_Label = "participante_acomp_021"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->participante_acomp_021;
   }
   //----- opcional_01
   function NM_export_opcional_01()
   {
         $this->opcional_01 = NM_charset_to_utf8($this->opcional_01);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['opcional_01'])) ? $this->New_label['opcional_01'] : " 01"; 
         }
         else
         {
             $SC_Label = "opcional_01"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->opcional_01;
   }
   //----- opcional_02
   function NM_export_opcional_02()
   {
         $this->opcional_02 = NM_charset_to_utf8($this->opcional_02);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['opcional_02'])) ? $this->New_label['opcional_02'] : " 02"; 
         }
         else
         {
             $SC_Label = "opcional_02"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->opcional_02;
   }
   //----- opcional_03
   function NM_export_opcional_03()
   {
         $this->opcional_03 = NM_charset_to_utf8($this->opcional_03);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['opcional_03'])) ? $this->New_label['opcional_03'] : " 03"; 
         }
         else
         {
             $SC_Label = "opcional_03"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->opcional_03;
   }
   //----- opcional_04
   function NM_export_opcional_04()
   {
         $this->opcional_04 = NM_charset_to_utf8($this->opcional_04);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['opcional_04'])) ? $this->New_label['opcional_04'] : " 04"; 
         }
         else
         {
             $SC_Label = "opcional_04"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->opcional_04;
   }
   //----- retornojavascript
   function NM_export_retornojavascript()
   {
         $this->retornojavascript = NM_charset_to_utf8($this->retornojavascript);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['retornojavascript'])) ? $this->New_label['retornojavascript'] : "RetornoJavaScript"; 
         }
         else
         {
             $SC_Label = "retornojavascript"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->retornojavascript;
   }
   //----- observacao_final
   function NM_export_observacao_final()
   {
         $this->observacao_final = NM_charset_to_utf8($this->observacao_final);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['observacao_final'])) ? $this->New_label['observacao_final'] : ""; 
         }
         else
         {
             $SC_Label = "observacao_final"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->observacao_final;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Belvitur Eventos - Confirmação de Viagem :: JSON</TITLE>
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
<form name="Fdown" method="get" action="grid_confirmacao_viagem_rsvp_2_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_confirmacao_viagem_rsvp_2"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_confirmacao_viagem_rsvp_2']['json_return']); ?>"> 
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
