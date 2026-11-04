<?php

class grid_participantes_rsvp_1_xml
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
   var $cnt_participante_id;

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
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida'])
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
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['opcao'] = "";
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
                   nm_limpa_str_grid_participantes_rsvp_1($cadapar[1]);
                   nm_protect_num_grid_participantes_rsvp_1($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_participantes_rsvp_1']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $vg_cpf;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["vg_cpf"]);
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["rsvp_global"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["vg_usuario_id"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["vg_cpfseg"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["parm1"]);
      }
      if (isset($vg_usunivel)) 
      {
          $_SESSION['vg_usunivel'] = $vg_usunivel;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["vg_usunivel"]);
      }
      if (isset($vg_tipo_pessoa)) 
      {
          $_SESSION['vg_tipo_pessoa'] = $vg_tipo_pessoa;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["vg_tipo_pessoa"]);
      }
      if (isset($vg_cpf_mestre)) 
      {
          $_SESSION['vg_cpf_mestre'] = $vg_cpf_mestre;
          nm_limpa_str_grid_participantes_rsvp_1($_SESSION["vg_cpf_mestre"]);
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
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['SC_Gb_Free_cmp']))
      {
          $this->Tem_xml_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_participantes_rsvp_1/grid_participantes_rsvp_1_res_xml.class.php"))
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_label']))
      {
          $this->Xml_tag_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_label'];
          $this->New_Format    = true;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_participantes_rsvp_1_total.class.php"); 
      $this->Tot      = new grid_participantes_rsvp_1_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['tot_geral'][1];
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['SC_Ind_Groupby'] == "sc_free_total")
          {
              $this->cnt_participante_id = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['tot_geral'][2];
          }
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_participantes_rsvp_1']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_return']);
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
      $this->Arq_zip      = $this->Arquivo . "_grid_participantes_rsvp_1.zip";
      $this->Arquivo     .= "_grid_participantes_rsvp_1";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "grid_participantes_rsvp_1.xml";
      $this->Tit_zip      = "grid_participantes_rsvp_1.zip";
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_participantes_rsvp_1']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_participantes_rsvp_1']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_participantes_rsvp_1']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->part_ativo = (isset($Busca_temp['part_ativo'])) ? $Busca_temp['part_ativo'] : ""; 
          $tmp_pos = (is_string($this->part_ativo)) ? strpos($this->part_ativo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_ativo))
          {
              $this->part_ativo = substr($this->part_ativo, 0, $tmp_pos);
          }
          $this->part_cpf = (isset($Busca_temp['part_cpf'])) ? $Busca_temp['part_cpf'] : ""; 
          $tmp_pos = (is_string($this->part_cpf)) ? strpos($this->part_cpf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cpf))
          {
              $this->part_cpf = substr($this->part_cpf, 0, $tmp_pos);
          }
          $this->nome_pessoa = (isset($Busca_temp['nome_pessoa'])) ? $Busca_temp['nome_pessoa'] : ""; 
          $tmp_pos = (is_string($this->nome_pessoa)) ? strpos($this->nome_pessoa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->nome_pessoa))
          {
              $this->nome_pessoa = substr($this->nome_pessoa, 0, $tmp_pos);
          }
          $this->part_sexo = (isset($Busca_temp['part_sexo'])) ? $Busca_temp['part_sexo'] : ""; 
          $tmp_pos = (is_string($this->part_sexo)) ? strpos($this->part_sexo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_sexo))
          {
              $this->part_sexo = substr($this->part_sexo, 0, $tmp_pos);
          }
          $this->part_acompanhado = (isset($Busca_temp['part_acompanhado'])) ? $Busca_temp['part_acompanhado'] : ""; 
          $tmp_pos = (is_string($this->part_acompanhado)) ? strpos($this->part_acompanhado, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_acompanhado))
          {
              $this->part_acompanhado = substr($this->part_acompanhado, 0, $tmp_pos);
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
          $this->part_contato_rsvp = (isset($Busca_temp['part_contato_rsvp'])) ? $Busca_temp['part_contato_rsvp'] : ""; 
          $tmp_pos = (is_string($this->part_contato_rsvp)) ? strpos($this->part_contato_rsvp, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_contato_rsvp))
          {
              $this->part_contato_rsvp = substr($this->part_contato_rsvp, 0, $tmp_pos);
          }
          $this->part_presenca = (isset($Busca_temp['part_presenca'])) ? $Busca_temp['part_presenca'] : ""; 
          $tmp_pos = (is_string($this->part_presenca)) ? strpos($this->part_presenca, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_presenca))
          {
              $this->part_presenca = substr($this->part_presenca, 0, $tmp_pos);
          }
          $this->part_aereo_ok = (isset($Busca_temp['part_aereo_ok'])) ? $Busca_temp['part_aereo_ok'] : ""; 
          $tmp_pos = (is_string($this->part_aereo_ok)) ? strpos($this->part_aereo_ok, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_aereo_ok))
          {
              $this->part_aereo_ok = substr($this->part_aereo_ok, 0, $tmp_pos);
          }
          $this->part_hotel = (isset($Busca_temp['part_hotel'])) ? $Busca_temp['part_hotel'] : ""; 
          $tmp_pos = (is_string($this->part_hotel)) ? strpos($this->part_hotel, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_hotel))
          {
              $this->part_hotel = substr($this->part_hotel, 0, $tmp_pos);
          }
          $this->part_transfer = (isset($Busca_temp['part_transfer'])) ? $Busca_temp['part_transfer'] : ""; 
          $tmp_pos = (is_string($this->part_transfer)) ? strpos($this->part_transfer, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_transfer))
          {
              $this->part_transfer = substr($this->part_transfer, 0, $tmp_pos);
          }
          $this->part_hospedagem = (isset($Busca_temp['part_hospedagem'])) ? $Busca_temp['part_hospedagem'] : ""; 
          $tmp_pos = (is_string($this->part_hospedagem)) ? strpos($this->part_hospedagem, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_hospedagem))
          {
              $this->part_hospedagem = substr($this->part_hospedagem, 0, $tmp_pos);
          }
          $this->part_programacao = (isset($Busca_temp['part_programacao'])) ? $Busca_temp['part_programacao'] : ""; 
          $tmp_pos = (is_string($this->part_programacao)) ? strpos($this->part_programacao, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_programacao))
          {
              $this->part_programacao = substr($this->part_programacao, 0, $tmp_pos);
          }
          $this->part_solicit_especial = (isset($Busca_temp['part_solicit_especial'])) ? $Busca_temp['part_solicit_especial'] : ""; 
          $tmp_pos = (is_string($this->part_solicit_especial)) ? strpos($this->part_solicit_especial, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_solicit_especial))
          {
              $this->part_solicit_especial = substr($this->part_solicit_especial, 0, $tmp_pos);
          }
          $this->part_confirm_viagem = (isset($Busca_temp['part_confirm_viagem'])) ? $Busca_temp['part_confirm_viagem'] : ""; 
          $tmp_pos = (is_string($this->part_confirm_viagem)) ? strpos($this->part_confirm_viagem, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_confirm_viagem))
          {
              $this->part_confirm_viagem = substr($this->part_confirm_viagem, 0, $tmp_pos);
          }
          $this->part_opcionais = (isset($Busca_temp['part_opcionais'])) ? $Busca_temp['part_opcionais'] : ""; 
          $tmp_pos = (is_string($this->part_opcionais)) ? strpos($this->part_opcionais, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_opcionais))
          {
              $this->part_opcionais = substr($this->part_opcionais, 0, $tmp_pos);
          }
          $this->part_substituido = (isset($Busca_temp['part_substituido'])) ? $Busca_temp['part_substituido'] : ""; 
          $tmp_pos = (is_string($this->part_substituido)) ? strpos($this->part_substituido, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_substituido))
          {
              $this->part_substituido = substr($this->part_substituido, 0, $tmp_pos);
          }
          $this->part_substituto = (isset($Busca_temp['part_substituto'])) ? $Busca_temp['part_substituto'] : ""; 
          $tmp_pos = (is_string($this->part_substituto)) ? strpos($this->part_substituto, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_substituto))
          {
              $this->part_substituto = substr($this->part_substituto, 0, $tmp_pos);
          }
          $this->part_grupo = (isset($Busca_temp['part_grupo'])) ? $Busca_temp['part_grupo'] : ""; 
          $tmp_pos = (is_string($this->part_grupo)) ? strpos($this->part_grupo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_grupo))
          {
              $this->part_grupo = substr($this->part_grupo, 0, $tmp_pos);
          }
          $this->part_clube = (isset($Busca_temp['part_clube'])) ? $Busca_temp['part_clube'] : ""; 
          $tmp_pos = (is_string($this->part_clube)) ? strpos($this->part_clube, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_clube))
          {
              $this->part_clube = substr($this->part_clube, 0, $tmp_pos);
          }
          $this->part_empresa = (isset($Busca_temp['part_empresa'])) ? $Busca_temp['part_empresa'] : ""; 
          $tmp_pos = (is_string($this->part_empresa)) ? strpos($this->part_empresa, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_empresa))
          {
              $this->part_empresa = substr($this->part_empresa, 0, $tmp_pos);
          }
          $this->part_departamento = (isset($Busca_temp['part_departamento'])) ? $Busca_temp['part_departamento'] : ""; 
          $tmp_pos = (is_string($this->part_departamento)) ? strpos($this->part_departamento, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_departamento))
          {
              $this->part_departamento = substr($this->part_departamento, 0, $tmp_pos);
          }
          $this->part_cargo = (isset($Busca_temp['part_cargo'])) ? $Busca_temp['part_cargo'] : ""; 
          $tmp_pos = (is_string($this->part_cargo)) ? strpos($this->part_cargo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cargo))
          {
              $this->part_cargo = substr($this->part_cargo, 0, $tmp_pos);
          }
          $this->part_cidade = (isset($Busca_temp['part_cidade'])) ? $Busca_temp['part_cidade'] : ""; 
          $tmp_pos = (is_string($this->part_cidade)) ? strpos($this->part_cidade, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cidade))
          {
              $this->part_cidade = substr($this->part_cidade, 0, $tmp_pos);
          }
          $this->part_uf = (isset($Busca_temp['part_uf'])) ? $Busca_temp['part_uf'] : ""; 
          $tmp_pos = (is_string($this->part_uf)) ? strpos($this->part_uf, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_uf))
          {
              $this->part_uf = substr($this->part_uf, 0, $tmp_pos);
          }
          $this->part_email = (isset($Busca_temp['part_email'])) ? $Busca_temp['part_email'] : ""; 
          $tmp_pos = (is_string($this->part_email)) ? strpos($this->part_email, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_email))
          {
              $this->part_email = substr($this->part_email, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_tipo_pessoa'])) {$_SESSION['vg_tipo_pessoa'] = "";}
if (!isset($this->sc_temp_vg_tipo_pessoa)) {$this->sc_temp_vg_tipo_pessoa = (isset($_SESSION['vg_tipo_pessoa'])) ? $_SESSION['vg_tipo_pessoa'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['vg_cpf_mestre'])) {$_SESSION['vg_cpf_mestre'] = "";}
if (!isset($this->sc_temp_vg_cpf_mestre)) {$this->sc_temp_vg_cpf_mestre = (isset($_SESSION['vg_cpf_mestre'])) ? $_SESSION['vg_cpf_mestre'] : "";}
if (!isset($_SESSION['vg_usunivel'])) {$_SESSION['vg_usunivel'] = "";}
if (!isset($this->sc_temp_vg_usunivel)) {$this->sc_temp_vg_usunivel = (isset($_SESSION['vg_usunivel'])) ? $_SESSION['vg_usunivel'] : "";}
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

$usunivel = $this->GetUsuarioNivel2($global_cpf,'nivel');
$this->RetNivel($usunivel);
$this->sc_temp_vg_usunivel = $usunivel;

$this->sc_temp_vg_cpf_mestre = $this->part_cpf ;


$valor_a = 'A';
$valor_null = '';

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
      
	$reg_inc = sizeof($this->rs );
	if ($reg_inc == 0) {
		
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= 'BRSVP - Usuário Não Cadastrado para o Evento!';
;
		if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_usunivel)) {$_SESSION['vg_usunivel'] = $this->sc_temp_vg_usunivel;}
 if (isset($this->sc_temp_vg_cpf_mestre)) {$_SESSION['vg_cpf_mestre'] = $this->sc_temp_vg_cpf_mestre;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
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
 $_SESSION['scriptcase']['sc_url_saida'][$this->Ini->sc_page] = $this->Ini->path_link . "" . SC_dir_app_name('grid_eventos_rsvp') . "/";
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_participantes_rsvp_1";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['sc_outra_jan'] = false;
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
        action="grid_participantes_rsvp_1_fim.php"
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
} else {
		$this->nmgp_botoes["Pessoas"] = 'off';;
		$this->nmgp_botoes["new"] = 'off';;			
	}	
}

$this->part_id_evento  = $this->sc_temp_vg_evento_id;
$this->sc_temp_vg_tipo_pessoa = 'P';
$this->part_cod_usuario  = $this->sc_temp_vg_usuario_id;

echo '<h2>BRSVP Participantes</h2>';	

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_usunivel)) {$_SESSION['vg_usunivel'] = $this->sc_temp_vg_usunivel;}
if (isset($this->sc_temp_vg_cpf_mestre)) {$_SESSION['vg_cpf_mestre'] = $this->sc_temp_vg_cpf_mestre;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_tipo_pessoa)) {$_SESSION['vg_tipo_pessoa'] = $this->sc_temp_vg_tipo_pessoa;}
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida'])
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
          $nmgp_select = "SELECT part_cpf, nome_pessoa, part_celeular_01, participante_id, part_ativo, part_sexo, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_confirm_viagem, part_destaque_negrito, part_acompanhado, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes, part_id_evento_publico from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT part_cpf, nome_pessoa, part_celeular_01, participante_id, part_ativo, part_sexo, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_confirm_viagem, part_destaque_negrito, part_acompanhado, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes, part_id_evento_publico from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT part_cpf, nome_pessoa, part_celeular_01, participante_id, part_ativo, part_sexo, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_confirm_viagem, part_destaque_negrito, part_acompanhado, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes, part_id_evento_publico from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT part_cpf, nome_pessoa, part_celeular_01, participante_id, part_ativo, part_sexo, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_confirm_viagem, part_destaque_negrito, part_acompanhado, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes, part_id_evento_publico from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT part_cpf, nome_pessoa, part_celeular_01, participante_id, part_ativo, part_sexo, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_confirm_viagem, part_destaque_negrito, part_acompanhado, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes, part_id_evento_publico from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT part_cpf, nome_pessoa, part_celeular_01, participante_id, part_ativo, part_sexo, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_confirm_viagem, part_destaque_negrito, part_acompanhado, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes, part_id_evento_publico from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['order_grid'];
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
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida'])
         { 
             $this->xml_registro .= "<" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro = "<grid_participantes_rsvp_1>\r\n";
         }
         else
         {
             $this->xml_registro = "<grid_participantes_rsvp_1";
         }
         $this->part_cpf = $rs->fields[0] ;  
         $this->nome_pessoa = $rs->fields[1] ;  
         $this->part_celeular_01 = $rs->fields[2] ;  
         $this->participante_id = $rs->fields[3] ;  
         $this->participante_id = (string)$this->participante_id;
         $this->part_ativo = $rs->fields[4] ;  
         $this->part_sexo = $rs->fields[5] ;  
         $this->part_crnm = $rs->fields[6] ;  
         $this->part_tipo = $rs->fields[7] ;  
         $this->part_id_evento = $rs->fields[8] ;  
         $this->part_id_evento = (string)$this->part_id_evento;
         $this->part_substituido = $rs->fields[9] ;  
         $this->part_ddd_01 = $rs->fields[10] ;  
         $this->part_fone_01 = $rs->fields[11] ;  
         $this->part_ddd_celular_01 = $rs->fields[12] ;  
         $this->part_cod_usuario = $rs->fields[13] ;  
         $this->part_cod_usuario = (string)$this->part_cod_usuario;
         $this->part_hospedagem = $rs->fields[14] ;  
         $this->part_transfer = $rs->fields[15] ;  
         $this->part_opcionais = $rs->fields[16] ;  
         $this->part_confirm_viagem = $rs->fields[17] ;  
         $this->part_destaque_negrito = $rs->fields[18] ;  
         $this->part_acompanhado = $rs->fields[19] ;  
         $this->part_aereo_ok = $rs->fields[20] ;  
         $this->part_hotel = $rs->fields[21] ;  
         $this->part_substituto = $rs->fields[22] ;  
         $this->part_acompanhado_hotel = $rs->fields[23] ;  
         $this->part_anotacoes = $rs->fields[24] ;  
         $this->part_id_evento_publico = $rs->fields[25] ;  
         $this->part_id_evento_publico = (string)$this->part_id_evento_publico;
         $this->sc_proc_grid = true; 
         //----- lookup - f_publico
         $this->Lookup->lookup_f_publico($this->f_publico, $this->part_id_evento_publico, $this->array_f_publico); 
         $this->f_publico = str_replace("<br>", " ", $this->f_publico); 
         $this->f_publico = ($this->f_publico == "&nbsp;") ? "" : $this->f_publico; 
         $_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_usunivel'])) {$_SESSION['vg_usunivel'] = "";}
if (!isset($this->sc_temp_vg_usunivel)) {$this->sc_temp_vg_usunivel = (isset($_SESSION['vg_usunivel'])) ? $_SESSION['vg_usunivel'] : "";}
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['vg_cpf'])) {$_SESSION['vg_cpf'] = "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
  date_default_timezone_set('America/Sao_Paulo');


$this->sc_temp_vg_cpf = $this->part_cpf ;
$evento = $this->sc_temp_vg_evento_id;
$cpf = $this->sc_temp_vg_cpf;
$vstatus = 'Y';
$valor_n = 'N';
$valor_y = 'Y';
$valor_a = 'A';
$valor_null = '';
$x1 = true;
               
$this->NM_cmp_hidden["teste_nv"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["teste_nv"] = 'off'; }		

$dddt01 = '('.$this->part_ddd_01 .')';
$p01t01 = substr ($this->part_fone_01 , 0, 4);
$p02t02 = substr ($this->part_fone_01 , 4, 4);
$t01 = $dddt01.' '.$p01t01.'-'.$p02t02;
if ($t01 <> '() -') {
	$this->part_fone_01  = $t01;		
} else {	
	$this->part_fone_01  = '';			
}
$dddt02 = '('.$this->part_ddd_celular_01 .')';
$p02t01 = substr ($this->part_celeular_01 , 0, 5);
$p02t02 = substr ($this->part_celeular_01 , 5, 4);
$t02 = $dddt02.' '.$p02t01.'-'.$p02t02;
if ($t02 <> '() -') {
	$this->part_celeular_01  = $t02;	
} else {	
	$this->part_celeular_01  = '';		
}

if($this->part_substituido  == 'N' && $this->part_substituto  == 'N') {
	$this->NM_cmp_hidden["substituido"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["substituido"] = 'off'; }		
	$this->NM_cmp_hidden["subst_laranja"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["subst_laranja"] = 'off'; }		
	$this->NM_cmp_hidden["subst_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["subst_gray"] = 'on'; }		
} else {
	if($this->part_substituido  == 'Y' && $this->part_substituto  == 'N') {
		$this->NM_cmp_hidden["substituido"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["substituido"] = 'off'; }		
		$this->NM_cmp_hidden["subst_laranja"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["subst_laranja"] = 'on'; }		
		$this->NM_cmp_hidden["subst_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["subst_gray"] = 'off'; }						
	} else {
		if($this->part_substituido  == 'N' && $this->part_substituto  == 'Y') {
			$this->NM_cmp_hidden["substituido"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["substituido"] = 'on'; }		
			$this->NM_cmp_hidden["subst_laranja"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["subst_laranja"] = 'off'; }		
			$this->NM_cmp_hidden["subst_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["subst_gray"] = 'off'; }					
		} else {
			if($this->part_substituido  == 'N' && $this->part_substituto  == '') {
				$this->NM_cmp_hidden["substituido"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["substituido"] = 'off'; }		
				$this->NM_cmp_hidden["subst_laranja"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["subst_laranja"] = 'off'; }		
				$this->NM_cmp_hidden["subst_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["subst_gray"] = 'on'; }													
			}	
		}	
	}	
}	

$qtde = 0;
$sqlac="
	SELECT    
		COUNT(part_cpf_mestre) as qtde
	FROM
		acompanhantes_rsvp		
	WHERE 
		part_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		part_cpf_mestre = ".$this->Db->qstr($this->sc_temp_vg_cpf)."	
";	
 
      $nm_select = $sqlac; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsac = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsac[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsac = false;
          $this->rsac_erro = $this->Db->ErrorMsg();
      } 


if (isset($this->rsac[0][0])) {
	$qtde = $this->rsac[0][0];	
}

if($qtde == 0) {
	$this->part_acompanhado  = 'N';
} else {
	$this->part_acompanhado  = 'Y';
}

if($this->part_acompanhado  == 'N') {
	$this->NM_cmp_hidden["acompanhante"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["acompanhante"] = 'off'; }		
	$this->NM_cmp_hidden["acomp_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["acomp_gray"] = 'on'; }		
	$this->NM_cmp_hidden["acomp_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["acomp_red"] = 'off'; }					
} else {	
	$this->NM_cmp_hidden["acompanhante"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["acompanhante"] = 'on'; }		
	$this->NM_cmp_hidden["acomp_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["acomp_gray"] = 'off'; }		
	$this->NM_cmp_hidden["acomp_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["acomp_red"] = 'off'; }			
}



$sql="
SELECT
	contato_data_hora, contato_status, contato_ativo
FROM
	contatos_rsvp 
WHERE
	contato_id_evento = ".$this->Db->qstr($evento)."	
AND 
	contato_ativo = ".$this->Db->qstr($valor_y)." 	
AND 
	contato_cpf_participante = ".$this->Db->qstr($cpf)."	
ORDER BY 
	contato_data_hora DESC
LIMIT 1"
;	
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->retorno = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->retorno[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->retorno = false;
          $this->retorno_erro = $this->Db->ErrorMsg();
      } 
	
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->retorno[0][0])) {
	$cstatus = $this->retorno[0][1];	
	switch($cstatus) {
		case 'A':
			$this->NM_cmp_hidden["contato_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_gray"] = 'on'; }		
			$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_green"] = 'off'; }		
			$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_red"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["contato_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_green"] = 'off'; }		
			$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_red"] = 'off'; }		
			$this->NM_cmp_hidden["contato_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_gray"] = 'off'; }		
			break;		
		case 'Y':
			$this->NM_cmp_hidden["contato_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_green"] = 'on'; }		
			$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_red"] = 'off'; }		
			$this->NM_cmp_hidden["contato_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_gray"] = 'off'; }		
			$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_yellow"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["contato_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_red"] = 'on'; }		
			$this->NM_cmp_hidden["contato_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_gray"] = 'off'; }		
			$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_green"] = 'off'; }		
			$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_yellow"] = 'off'; }					
			break;				
	}	
} else {
	$this->NM_cmp_hidden["contato_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_gray"] = 'on'; }		
	$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_green"] = 'off'; }		
	$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_red"] = 'off'; }						
}

$sql="
SELECT
	presenca_data_hora, presenca_status, presenca_ativo
FROM
	presencas_rsvp 
WHERE
	presenca_id_evento = ".$this->Db->qstr($evento)."	 
AND  
	presenca_ativo = ".$this->Db->qstr($valor_y)." 	
AND 
	presenca_cpf_participante = ".$this->Db->qstr($cpf)."	
ORDER BY 
	presenca_data_hora DESC
LIMIT 1"
;	
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->retornop = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->retornop[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->retornop = false;
          $this->retornop_erro = $this->Db->ErrorMsg();
      } 

if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->retornop[0][0])) {
	$cstatusp = $this->retornop[0][1];	
	switch($cstatusp) {
		case 'A':
			$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_gray"] = 'on'; }		
			$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_green"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_red"] = 'off'; }					
			$x1 = true;
			break;
		case 'P':
			$this->NM_cmp_hidden["presenca_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_green"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_red"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_gray"] = 'off'; }		
			$x1 = true;
			break;		
		case 'Y':
			$this->NM_cmp_hidden["presenca_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_green"] = 'on'; }		
			$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_red"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_gray"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
			$x1 = true;
			break;				
		case 'N':
			$this->NM_cmp_hidden["presenca_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_red"] = 'on'; }		
			$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_gray"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_green"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_yellow"] = 'off'; }			
			$x1 = false;
			$sqlx1 = "
				SELECT
					opc_evento_id,
					opc_cpf_participante					
				FROM
					eventos_opcionais_rsvp
				WHERE
					opc_evento_id  = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
				AND
					opc_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."									
			";
			 
      $nm_select = $sqlx1; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsx1 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsx1[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsx1 = false;
          $this->rsx1_erro = $this->Db->ErrorMsg();
      } 

			if (isset($this->rsx1[0][0])) {
				$this->NM_cmp_hidden["opcionais_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_gray"] = 'off'; }		
				$this->NM_cmp_hidden["opcionais_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_green"] = 'on'; }						
			} else {
				$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
				$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_green"] = 'off'; }						
			}	
			$sqlx2 = "
				SELECT
					ant_evento_id,
					ant_cpf_participante
				FROM
					anotacoes_rsvp
				WHERE
					ant_evento_id = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
				AND
					ant_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."									
			";
			 
      $nm_select = $sqlx2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsx2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsx2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsx2 = false;
          $this->rsx2_erro = $this->Db->ErrorMsg();
      } 

			if (isset($this->rsx2[0][0])) {
				$this->NM_cmp_hidden["anotacoes"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes"] = 'on'; }		
				$this->NM_cmp_hidden["anotacoes_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes_gray"] = 'off'; }	
			} else {
				$this->NM_cmp_hidden["anotacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes"] = 'off'; }		
				$this->NM_cmp_hidden["anotacoes_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes_gray"] = 'on'; }	
			}			
			break;				
	}	
} else {
	$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_gray"] = 'on'; }		
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_red"] = 'off'; }								
	$x1 = true;
}

$sql="
SELECT
	solicitacao_data_hora, solicitacao_status, solicitacao_ativo
FROM
	solicitacoes_rsvp 
WHERE
	solicitacao_id_evento = ".$this->Db->qstr($evento)."	 
AND  
	solicitacao_ativo = ".$this->Db->qstr($valor_y)." 	
AND 
	solicitacao_cpf_participante = ".$this->Db->qstr($cpf)."	
ORDER BY 
	solicitacao_data_hora DESC
LIMIT 1"
;	
 
      $nm_select = $sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->retornos = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->retornos[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->retornos = false;
          $this->retornos_erro = $this->Db->ErrorMsg();
      } 
	
if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->retornos[0][0])) {
	$cstatuss = $this->retornos[0][1];	
	switch($cstatuss) {
		case 'A':
			$this->NM_cmp_hidden["solic_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_gray"] = 'on'; }		
			$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_amarela"] = 'off'; }					
			$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_green"] = 'off'; }		
			$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_red"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["solic_amarela"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_amarela"] = 'on'; }					
			$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_green"] = 'off'; }		
			$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_red"] = 'off'; }		
			$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_gray"] = 'off'; }		
			break;		
		case 'Y':
			$this->NM_cmp_hidden["solic_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_green"] = 'on'; }		
			$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_red"] = 'off'; }		
			$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_gray"] = 'off'; }		
			$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_amarela"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["solic_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_red"] = 'on'; }		
			$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_gray"] = 'off'; }		
			$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_green"] = 'off'; }		
			$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_amarela"] = 'off'; }					
			break;				
	}	
} else {
	$this->NM_cmp_hidden["solic_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_gray"] = 'on'; }		
	$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_amarela"] = 'off'; }					
	$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_green"] = 'off'; }		
	$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_red"] = 'off'; }						
}

$sql3="
SELECT 
	programac_cpf_participante, programac_id_evento, programac_ativo
FROM 
	programac_rsvp
WHERE 
	programac_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)." 
AND 
	programac_ativo = ".$this->Db->qstr($valor_y)." 	
AND  
	programac_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
ORDER BY 	
	programac_data_hora DESC, programac_ativo DESC, programac_cpf_participante ASC, programac_id_evento ASC
LIMIT 1	
";
 
      $nm_select = $sql3; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs3 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs3[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs3 = false;
          $this->rs3_erro = $this->Db->ErrorMsg();
      } 

if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->rs3[0][0])) {
	$ativo = $this->rs3[0][2];
	if ($ativo == 'Y') { 	
		$this->NM_cmp_hidden["prog_ok"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["prog_ok"] = 'on'; }				
		$this->NM_cmp_hidden["prog_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["prog_gray"] = 'off'; }	
	} else {
		$this->NM_cmp_hidden["prog_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["prog_gray"] = 'on'; }			
		$this->NM_cmp_hidden["prog_ok"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["prog_ok"] = 'off'; }		
	}		
} else {	
	$this->NM_cmp_hidden["prog_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["prog_gray"] = 'on'; }			
	$this->NM_cmp_hidden["prog_ok"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["prog_ok"] = 'off'; }				
}

$sql4="
	SELECT    
	COUNT(id_aereo) as qtde
	FROM
		aereos_rsvp		
	WHERE 
		aereo_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND
		aereo_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND 
		aereo_ativo = ".$this->Db->qstr($valor_y)." 
";	
 
      $nm_select = $sql4; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs4 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs4[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs4 = false;
          $this->rs4_erro = $this->Db->ErrorMsg();
      } 

if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->rs4[0][0])) {
	$qtde = $this->rs4[0][0];
} else {
	$qtde = 0;
}
if ($qtde > 0) {
	$astatus = $this->part_aereo_ok ;
	switch($astatus) {
		case 'A':
			$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'on'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;		
		case 'Y':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_green"] = 'on'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_red"] = 'on'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;				
		case 'R':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_roxo"] = 'on'; }					
			break;		
		case '':
			$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'on'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;						  
	}	
} else {
	$this->part_aereo_ok  = 'A';
	$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'on'; }		
	$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_roxo"] = 'off'; }
}

$sql5="
	SELECT    
	COUNT(hospedagem_id) as qtdeh
	FROM
		hospedagem_rsvp		
	WHERE 
		hosp_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND  
		hosp_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND 
		hosp_ativo = ".$this->Db->qstr($valor_y)." 
";	
 
      $nm_select = $sql5; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs5 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs5[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs5 = false;
          $this->rs5_erro = $this->Db->ErrorMsg();
      } 

if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
					 
if (isset($this->rs5[0][0])) {
	$qtdeh = $this->rs5[0][0];
} else {
	$qtdeh = 0;
}
if ($qtdeh > 0) {				 
	if ($this->part_acompanhado_hotel  == 'Y') {
		$status = $this->part_hotel ;
		switch($status) {
			case 'A':			
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;
			case 'P':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'on'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;
			case 'Y':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;					
			case 'N':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'on'; }					
				break;							
			case '':			
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;			
		}
	} else {
		$status = $this->part_hotel ;
		switch($status) {
			case 'A':
				$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;
			case 'P':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'on'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;		
			case 'Y':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;				
			case 'N':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'on'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;				
			case '':
				$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;
		}
	}				 
} else {
	$this->part_hospedagem  = 'A';
	$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'on'; }		
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }	
	$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }						
}
					 
$sql6="
	SELECT    
	COUNT(id_transfer) as qtdet
	FROM
		transfer_rsvp		
	WHERE 
		tra_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
	AND  
		tra_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
	AND 
		tra_ativo = ".$this->Db->qstr($valor_y)." 
";	
 
      $nm_select = $sql6; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs6 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs6[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs6 = false;
          $this->rs6_erro = $this->Db->ErrorMsg();
      } 

if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}
					 
if (isset($this->rs6[0][0])) {
	$qtdet = $this->rs6[0][0];
	$sql6a = "
		SELECT
			tra_status
		FROM
			transfer_rsvp
		WHERE 
			tra_id_evento = ".$this->Db->qstr($this->sc_temp_vg_evento_id)."
		AND  
			tra_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)."
		AND 
			tra_ativo = ".$this->Db->qstr($valor_y)." 			
	";
	 
      $nm_select = $sql6a; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs6a = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs6a[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs6a = false;
          $this->rs6a_erro = $this->Db->ErrorMsg();
      } 

	if (isset($this->rs6a[0][0])) {
		$this->part_transfer  = $this->rs6a[0][0];
	}	
} else {
	$qtdet = 0;
}
if ($qtdet > 0) {					 
	$status_trans =  $this->part_transfer ;
	switch($status_trans) {
		case 'A':
			$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_gray"] = 'on'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_red"] = 'off'; }					
								
			break;
		case 'P':
			$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_gray"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_red"] = 'off'; }					
								
			break;		
		case 'Y':
			$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_gray"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_green"] = 'on'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_red"] = 'off'; }					
								
			break;								  
		case 'N':
			$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_gray"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_red"] = 'on'; }					
				
			break;			
		
	}
} else {
	$this->part_transfer  = 'A';
	$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_gray"] = 'on'; }		
	$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_green"] = 'off'; }		
	$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_red"] = 'off'; }					
			
}	



if($x1 == true) {
	switch($this->part_opcionais ) {
		case 'N':
			$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
			$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_green"] = 'off'; }		
			break;
		case 'Y':
			$this->NM_cmp_hidden["opcionais_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_gray"] = 'off'; }		
			$this->NM_cmp_hidden["opcionais_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_green"] = 'on'; }		
			break;		
		case '':
			$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
			$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_green"] = 'off'; }		
			break;						  
	}						 
}

if($x1 == true) {
	if ($this->part_anotacoes  == 'Y') {
		$this->NM_cmp_hidden["anotacoes"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes"] = 'on'; }		
		$this->NM_cmp_hidden["anotacoes_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes_gray"] = 'off'; }	
	} else {
		$this->NM_cmp_hidden["anotacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes"] = 'off'; }		
		$this->NM_cmp_hidden["anotacoes_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes_gray"] = 'on'; }	
	}
}				
	
if ($this->part_ativo  == 'Y') {
	$this->NM_field_style["participante_id"] = "background-color:#cde4cd;font-size:bold;"; 	
} else {
	$this->NM_field_style["participante_id"] = "background-color:#ffbbba;font-size:bold;";
	$this->NM_cmp_hidden["contato_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_gray"] = 'on'; }		
	$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_green"] = 'off'; }		
	$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["contato_red"] = 'off'; }	
	
	$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_gray"] = 'on'; }		
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_red"] = 'off'; }	
	
	$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_gray"] = 'on'; }	
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_red"] = 'off'; }		
	
	$this->NM_cmp_hidden["solic_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_gray"] = 'on'; }		
	$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_amarela"] = 'off'; }					
	$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_green"] = 'off'; }		
	$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_red"] = 'off'; }
	
	$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'on'; }		
	$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_red"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_roxo"] = 'off'; }
					  
	$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'on'; }		
	$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }
					  
	$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_gray"] = 'on'; }		
	$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_green"] = 'off'; }		
	$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_red"] = 'off'; }					
	
	
	$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
	$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["opcionais_green"] = 'off'; }	
					  
	$this->NM_cmp_hidden["anotacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes"] = 'off'; }		
	$this->NM_cmp_hidden["anotacoes_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["anotacoes_gray"] = 'on'; }						  
}	


if ($this->sc_temp_vg_usunivel <> 'CONVIDADO') {
	if ($this->part_confirm_viagem  == 'Y') {
		$this->NM_cmp_hidden["cv_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["cv_gray"] = 'off'; }		
		$this->NM_cmp_hidden["cv_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["cv_green"] = 'on'; }	
	} else {
		$this->NM_cmp_hidden["cv_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["cv_gray"] = 'on'; }		
		$this->NM_cmp_hidden["cv_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["cv_green"] = 'off'; }	
	}
} else {
	$this->NM_cmp_hidden["cv_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["cv_gray"] = 'off'; }		
	$this->NM_cmp_hidden["cv_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["cv_green"] = 'off'; }		
}	
$sqlv2="
	SELECT
		presenca_data_hora, presenca_status, presenca_ativo
	FROM
		presencas_rsvp 
	WHERE
		presenca_id_evento = ".$this->Db->qstr($evento)."	 
	AND  
		presenca_status = ".$this->Db->qstr($valor_n)." 	
	AND 
		presenca_cpf_participante = ".$this->Db->qstr($cpf)."	
	ORDER BY 
		presenca_data_hora DESC
	LIMIT 1"
	;	
 
      $nm_select = $sqlv2; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->retornop2 = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->retornop2[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->retornop2 = false;
          $this->retornop2_erro = $this->Db->ErrorMsg();
      } 

if ($this->Ini->sc_tem_trans_banco)
{
    $this->Db->CommitTrans();
    $this->Ini->sc_tem_trans_banco = false;
}

if (isset($this->retornop2[0][0])) {
	$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_gray"] = 'off'; }			
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["presenca_red"] = 'on'; }	
	$this->NM_cmp_hidden["solic_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_red"] = 'on'; }					
	$this->NM_cmp_hidden["prog_ok"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["prog_ok"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_red"] = 'on'; }					
	$this->NM_cmp_hidden["hotel_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red"] = 'on'; }					
	$this->NM_cmp_hidden["transfer_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_red"] = 'on'; }	
	
	$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
 	$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
	
	$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_gray"] = 'off'; }		
	$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["transfer_green"] = 'off'; }		
	

	$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_gray"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_green"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["aereo_roxo"] = 'off'; }
					  
	$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_gray"] = 'off'; }		
	$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_amarela"] = 'off'; }					
	$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['php_cmp_sel']["solic_green"] = 'off'; }		
	
	
}

if ($this->nome_pessoa  == '') {
	$sqla="
		SELECT 
			pessoa_cpf,
			pessoa_nome			
		FROM 
			pessoas_rsvp
		WHERE 
			pessoa_cpf = ".$this->Db->qstr($this->part_cpf )." 
	";	
	 
      $nm_select = $sqla; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsa = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsa[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsa = false;
          $this->rsa_erro = $this->Db->ErrorMsg();
      } 
	
	if (isset($this->rsa[0][0])) {
		$this->nome_pessoa  = $this->rsa[0][1];
	} else {
		$this->nome_pessoa  = 'Erro, entre em contato com o suporte';
	}
}	

if($this->part_destaque_negrito  == 'Y') {	
	$this->NM_field_style["nome_pessoa"] = "background-color:;font-size:bold;color:#f63500;";
}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_usunivel)) {$_SESSION['vg_usunivel'] = $this->sc_temp_vg_usunivel;}
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida'])
         { 
             $this->xml_registro .= "</" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro .= "</grid_participantes_rsvp_1>\r\n";
         }
         else
         {
             $this->xml_registro .= " />\r\n";
         }
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida'])
         { 
             fwrite($xml_f, $this->xml_registro);
             if ($this->Grava_view)
             {
                fwrite($xml_v, $this->xml_registro);
             }
         }
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['embutida'])
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
              require_once($this->Ini->path_aplicacao . "grid_participantes_rsvp_1_res_xml.class.php");
              $this->Res = new grid_participantes_rsvp_1_res_xml();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_res_grid'] = true;
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
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_res_file']['xml'];
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_res_file']['xml']);
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
                      $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_res_file']['view'];
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
                      unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_res_file']['view']);
                  }
              } 
              else 
              {
                  $this->Arquivo_view = $this->Arq_zip;
              } 
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- part_cpf
   function NM_export_part_cpf()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_cpf))
         {
             $this->part_cpf = sc_convert_encoding($this->part_cpf, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_cpf'])) ? $this->New_label['part_cpf'] : "Cód."; 
         }
         else
         {
             $SC_Label = "part_cpf"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_cpf) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_cpf) . "\"";
         }
   }
   //----- acomp_gray
   function NM_export_acomp_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->acomp_gray))
         {
             $this->acomp_gray = sc_convert_encoding($this->acomp_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['acomp_gray'])) ? $this->New_label['acomp_gray'] : "Acomp."; 
         }
         else
         {
             $SC_Label = "acomp_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->acomp_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->acomp_gray) . "\"";
         }
   }
   //----- acompanhante
   function NM_export_acompanhante()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->acompanhante))
         {
             $this->acompanhante = sc_convert_encoding($this->acompanhante, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['acompanhante'])) ? $this->New_label['acompanhante'] : "Acomp."; 
         }
         else
         {
             $SC_Label = "acompanhante"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->acompanhante) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->acompanhante) . "\"";
         }
   }
   //----- acomp_red
   function NM_export_acomp_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->acomp_red))
         {
             $this->acomp_red = sc_convert_encoding($this->acomp_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['acomp_red'])) ? $this->New_label['acomp_red'] : "Acomp."; 
         }
         else
         {
             $SC_Label = "acomp_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->acomp_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->acomp_red) . "\"";
         }
   }
   //----- substituido
   function NM_export_substituido()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->substituido))
         {
             $this->substituido = sc_convert_encoding($this->substituido, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['substituido'])) ? $this->New_label['substituido'] : "Subst."; 
         }
         else
         {
             $SC_Label = "substituido"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->substituido) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->substituido) . "\"";
         }
   }
   //----- subst_gray
   function NM_export_subst_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->subst_gray))
         {
             $this->subst_gray = sc_convert_encoding($this->subst_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['subst_gray'])) ? $this->New_label['subst_gray'] : "Subst."; 
         }
         else
         {
             $SC_Label = "subst_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->subst_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->subst_gray) . "\"";
         }
   }
   //----- subst_laranja
   function NM_export_subst_laranja()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->subst_laranja))
         {
             $this->subst_laranja = sc_convert_encoding($this->subst_laranja, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['subst_laranja'])) ? $this->New_label['subst_laranja'] : "Subst."; 
         }
         else
         {
             $SC_Label = "subst_laranja"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->subst_laranja) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->subst_laranja) . "\"";
         }
   }
   //----- nome_pessoa
   function NM_export_nome_pessoa()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->nome_pessoa))
         {
             $this->nome_pessoa = sc_convert_encoding($this->nome_pessoa, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['nome_pessoa'])) ? $this->New_label['nome_pessoa'] : "Participante"; 
         }
         else
         {
             $SC_Label = "nome_pessoa"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->nome_pessoa) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->nome_pessoa) . "\"";
         }
   }
   //----- part_celeular_01
   function NM_export_part_celeular_01()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_celeular_01))
         {
             $this->part_celeular_01 = sc_convert_encoding($this->part_celeular_01, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_celeular_01'])) ? $this->New_label['part_celeular_01'] : "Celular"; 
         }
         else
         {
             $SC_Label = "part_celeular_01"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_celeular_01) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_celeular_01) . "\"";
         }
   }
   //----- contato_gray
   function NM_export_contato_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_gray))
         {
             $this->contato_gray = sc_convert_encoding($this->contato_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_gray'])) ? $this->New_label['contato_gray'] : "Contato"; 
         }
         else
         {
             $SC_Label = "contato_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_gray) . "\"";
         }
   }
   //----- contato_yellow
   function NM_export_contato_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_yellow))
         {
             $this->contato_yellow = sc_convert_encoding($this->contato_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_yellow'])) ? $this->New_label['contato_yellow'] : "Contato"; 
         }
         else
         {
             $SC_Label = "contato_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_yellow) . "\"";
         }
   }
   //----- contato_red
   function NM_export_contato_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_red))
         {
             $this->contato_red = sc_convert_encoding($this->contato_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_red'])) ? $this->New_label['contato_red'] : "Contato"; 
         }
         else
         {
             $SC_Label = "contato_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_red) . "\"";
         }
   }
   //----- contato_green
   function NM_export_contato_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->contato_green))
         {
             $this->contato_green = sc_convert_encoding($this->contato_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['contato_green'])) ? $this->New_label['contato_green'] : "Contato"; 
         }
         else
         {
             $SC_Label = "contato_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->contato_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->contato_green) . "\"";
         }
   }
   //----- presenca_gray
   function NM_export_presenca_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_gray))
         {
             $this->presenca_gray = sc_convert_encoding($this->presenca_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_gray'])) ? $this->New_label['presenca_gray'] : "Presença"; 
         }
         else
         {
             $SC_Label = "presenca_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_gray) . "\"";
         }
   }
   //----- presenca_yellow
   function NM_export_presenca_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_yellow))
         {
             $this->presenca_yellow = sc_convert_encoding($this->presenca_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_yellow'])) ? $this->New_label['presenca_yellow'] : "Presença"; 
         }
         else
         {
             $SC_Label = "presenca_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_yellow) . "\"";
         }
   }
   //----- presenca_red
   function NM_export_presenca_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_red))
         {
             $this->presenca_red = sc_convert_encoding($this->presenca_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_red'])) ? $this->New_label['presenca_red'] : "Presença"; 
         }
         else
         {
             $SC_Label = "presenca_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_red) . "\"";
         }
   }
   //----- presenca_green
   function NM_export_presenca_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->presenca_green))
         {
             $this->presenca_green = sc_convert_encoding($this->presenca_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['presenca_green'])) ? $this->New_label['presenca_green'] : "Presença"; 
         }
         else
         {
             $SC_Label = "presenca_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->presenca_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->presenca_green) . "\"";
         }
   }
   //----- solic_gray
   function NM_export_solic_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->solic_gray))
         {
             $this->solic_gray = sc_convert_encoding($this->solic_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['solic_gray'])) ? $this->New_label['solic_gray'] : "Solicit."; 
         }
         else
         {
             $SC_Label = "solic_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->solic_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->solic_gray) . "\"";
         }
   }
   //----- solic_green
   function NM_export_solic_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->solic_green))
         {
             $this->solic_green = sc_convert_encoding($this->solic_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['solic_green'])) ? $this->New_label['solic_green'] : "Solicit."; 
         }
         else
         {
             $SC_Label = "solic_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->solic_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->solic_green) . "\"";
         }
   }
   //----- solic_red
   function NM_export_solic_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->solic_red))
         {
             $this->solic_red = sc_convert_encoding($this->solic_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['solic_red'])) ? $this->New_label['solic_red'] : "Solicit"; 
         }
         else
         {
             $SC_Label = "solic_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->solic_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->solic_red) . "\"";
         }
   }
   //----- solic_amarela
   function NM_export_solic_amarela()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->solic_amarela))
         {
             $this->solic_amarela = sc_convert_encoding($this->solic_amarela, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['solic_amarela'])) ? $this->New_label['solic_amarela'] : "Solicit."; 
         }
         else
         {
             $SC_Label = "solic_amarela"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->solic_amarela) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->solic_amarela) . "\"";
         }
   }
   //----- prog_gray
   function NM_export_prog_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->prog_gray))
         {
             $this->prog_gray = sc_convert_encoding($this->prog_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['prog_gray'])) ? $this->New_label['prog_gray'] : "Prog."; 
         }
         else
         {
             $SC_Label = "prog_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->prog_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->prog_gray) . "\"";
         }
   }
   //----- prog_ok
   function NM_export_prog_ok()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->prog_ok))
         {
             $this->prog_ok = sc_convert_encoding($this->prog_ok, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['prog_ok'])) ? $this->New_label['prog_ok'] : "Prog."; 
         }
         else
         {
             $SC_Label = "prog_ok"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->prog_ok) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->prog_ok) . "\"";
         }
   }
   //----- aereo_gray
   function NM_export_aereo_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_gray))
         {
             $this->aereo_gray = sc_convert_encoding($this->aereo_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_gray'])) ? $this->New_label['aereo_gray'] : "Aéreo"; 
         }
         else
         {
             $SC_Label = "aereo_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_gray) . "\"";
         }
   }
   //----- aereo_green
   function NM_export_aereo_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_green))
         {
             $this->aereo_green = sc_convert_encoding($this->aereo_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_green'])) ? $this->New_label['aereo_green'] : "Aéreo"; 
         }
         else
         {
             $SC_Label = "aereo_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_green) . "\"";
         }
   }
   //----- aereo_yellow
   function NM_export_aereo_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_yellow))
         {
             $this->aereo_yellow = sc_convert_encoding($this->aereo_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_yellow'])) ? $this->New_label['aereo_yellow'] : "Aéreo"; 
         }
         else
         {
             $SC_Label = "aereo_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_yellow) . "\"";
         }
   }
   //----- aereo_red
   function NM_export_aereo_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_red))
         {
             $this->aereo_red = sc_convert_encoding($this->aereo_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_red'])) ? $this->New_label['aereo_red'] : "Aéreo"; 
         }
         else
         {
             $SC_Label = "aereo_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_red) . "\"";
         }
   }
   //----- aereo_roxo
   function NM_export_aereo_roxo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->aereo_roxo))
         {
             $this->aereo_roxo = sc_convert_encoding($this->aereo_roxo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['aereo_roxo'])) ? $this->New_label['aereo_roxo'] : "Aéreo"; 
         }
         else
         {
             $SC_Label = "aereo_roxo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->aereo_roxo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->aereo_roxo) . "\"";
         }
   }
   //----- hotel_gray
   function NM_export_hotel_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_gray))
         {
             $this->hotel_gray = sc_convert_encoding($this->hotel_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_gray'])) ? $this->New_label['hotel_gray'] : "Hosp."; 
         }
         else
         {
             $SC_Label = "hotel_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_gray) . "\"";
         }
   }
   //----- hotel_yellow
   function NM_export_hotel_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_yellow))
         {
             $this->hotel_yellow = sc_convert_encoding($this->hotel_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_yellow'])) ? $this->New_label['hotel_yellow'] : "Hosp."; 
         }
         else
         {
             $SC_Label = "hotel_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_yellow) . "\"";
         }
   }
   //----- hotel_yellow_a
   function NM_export_hotel_yellow_a()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_yellow_a))
         {
             $this->hotel_yellow_a = sc_convert_encoding($this->hotel_yellow_a, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_yellow_a'])) ? $this->New_label['hotel_yellow_a'] : "Hosp."; 
         }
         else
         {
             $SC_Label = "hotel_yellow_a"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_yellow_a) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_yellow_a) . "\"";
         }
   }
   //----- hotel_gray_a
   function NM_export_hotel_gray_a()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_gray_a))
         {
             $this->hotel_gray_a = sc_convert_encoding($this->hotel_gray_a, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_gray_a'])) ? $this->New_label['hotel_gray_a'] : "Hosp."; 
         }
         else
         {
             $SC_Label = "hotel_gray_a"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_gray_a) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_gray_a) . "\"";
         }
   }
   //----- hotel_red
   function NM_export_hotel_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_red))
         {
             $this->hotel_red = sc_convert_encoding($this->hotel_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_red'])) ? $this->New_label['hotel_red'] : "Hosp."; 
         }
         else
         {
             $SC_Label = "hotel_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_red) . "\"";
         }
   }
   //----- hotel_red_a
   function NM_export_hotel_red_a()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_red_a))
         {
             $this->hotel_red_a = sc_convert_encoding($this->hotel_red_a, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_red_a'])) ? $this->New_label['hotel_red_a'] : "Hosp."; 
         }
         else
         {
             $SC_Label = "hotel_red_a"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_red_a) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_red_a) . "\"";
         }
   }
   //----- hotel_green
   function NM_export_hotel_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_green))
         {
             $this->hotel_green = sc_convert_encoding($this->hotel_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_green'])) ? $this->New_label['hotel_green'] : "Hosp."; 
         }
         else
         {
             $SC_Label = "hotel_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_green) . "\"";
         }
   }
   //----- hotel_green_a
   function NM_export_hotel_green_a()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->hotel_green_a))
         {
             $this->hotel_green_a = sc_convert_encoding($this->hotel_green_a, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['hotel_green_a'])) ? $this->New_label['hotel_green_a'] : "Hosp."; 
         }
         else
         {
             $SC_Label = "hotel_green_a"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->hotel_green_a) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->hotel_green_a) . "\"";
         }
   }
   //----- transfer_gray
   function NM_export_transfer_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->transfer_gray))
         {
             $this->transfer_gray = sc_convert_encoding($this->transfer_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['transfer_gray'])) ? $this->New_label['transfer_gray'] : "Transfer"; 
         }
         else
         {
             $SC_Label = "transfer_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->transfer_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->transfer_gray) . "\"";
         }
   }
   //----- transfer_green
   function NM_export_transfer_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->transfer_green))
         {
             $this->transfer_green = sc_convert_encoding($this->transfer_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['transfer_green'])) ? $this->New_label['transfer_green'] : "Transfer"; 
         }
         else
         {
             $SC_Label = "transfer_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->transfer_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->transfer_green) . "\"";
         }
   }
   //----- transfer_red
   function NM_export_transfer_red()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->transfer_red))
         {
             $this->transfer_red = sc_convert_encoding($this->transfer_red, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['transfer_red'])) ? $this->New_label['transfer_red'] : "Transfer"; 
         }
         else
         {
             $SC_Label = "transfer_red"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->transfer_red) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->transfer_red) . "\"";
         }
   }
   //----- transfer_yellow
   function NM_export_transfer_yellow()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->transfer_yellow))
         {
             $this->transfer_yellow = sc_convert_encoding($this->transfer_yellow, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['transfer_yellow'])) ? $this->New_label['transfer_yellow'] : "Transfer"; 
         }
         else
         {
             $SC_Label = "transfer_yellow"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->transfer_yellow) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->transfer_yellow) . "\"";
         }
   }
   //----- opcionais_gray
   function NM_export_opcionais_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->opcionais_gray))
         {
             $this->opcionais_gray = sc_convert_encoding($this->opcionais_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['opcionais_gray'])) ? $this->New_label['opcionais_gray'] : "Opcionais"; 
         }
         else
         {
             $SC_Label = "opcionais_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->opcionais_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->opcionais_gray) . "\"";
         }
   }
   //----- opcionais_green
   function NM_export_opcionais_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->opcionais_green))
         {
             $this->opcionais_green = sc_convert_encoding($this->opcionais_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['opcionais_green'])) ? $this->New_label['opcionais_green'] : "Opcionais"; 
         }
         else
         {
             $SC_Label = "opcionais_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->opcionais_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->opcionais_green) . "\"";
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
             $SC_Label = (isset($this->New_label['anotacoes'])) ? $this->New_label['anotacoes'] : "Anotações"; 
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
   //----- anotacoes_gray
   function NM_export_anotacoes_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->anotacoes_gray))
         {
             $this->anotacoes_gray = sc_convert_encoding($this->anotacoes_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['anotacoes_gray'])) ? $this->New_label['anotacoes_gray'] : "Anotações"; 
         }
         else
         {
             $SC_Label = "anotacoes_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->anotacoes_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->anotacoes_gray) . "\"";
         }
   }
   //----- cv_gray
   function NM_export_cv_gray()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cv_gray))
         {
             $this->cv_gray = sc_convert_encoding($this->cv_gray, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cv_gray'])) ? $this->New_label['cv_gray'] : "Conf. Viagem"; 
         }
         else
         {
             $SC_Label = "cv_gray"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cv_gray) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cv_gray) . "\"";
         }
   }
   //----- cv_green
   function NM_export_cv_green()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->cv_green))
         {
             $this->cv_green = sc_convert_encoding($this->cv_green, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['cv_green'])) ? $this->New_label['cv_green'] : "Conf. Viagem"; 
         }
         else
         {
             $SC_Label = "cv_green"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->cv_green) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->cv_green) . "\"";
         }
   }
   //----- f_publico
   function NM_export_f_publico()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->f_publico))
         {
             $this->f_publico = sc_convert_encoding($this->f_publico, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['f_publico'])) ? $this->New_label['f_publico'] : "Público"; 
         }
         else
         {
             $SC_Label = "f_publico"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->f_publico) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->f_publico) . "\"";
         }
   }
   //----- participante_id
   function NM_export_participante_id()
   {
             nmgp_Form_Num_Val($this->participante_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['participante_id'])) ? $this->New_label['participante_id'] : "CR."; 
         }
         else
         {
             $SC_Label = "participante_id"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->participante_id) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->participante_id) . "\"";
         }
   }
   //----- teste_nv
   function NM_export_teste_nv()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->teste_nv))
         {
             $this->teste_nv = sc_convert_encoding($this->teste_nv, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['teste_nv'])) ? $this->New_label['teste_nv'] : "N. Voucher"; 
         }
         else
         {
             $SC_Label = "teste_nv"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->teste_nv) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->teste_nv) . "\"";
         }
   }
   //----- part_ativo
   function NM_export_part_ativo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_ativo))
         {
             $this->part_ativo = sc_convert_encoding($this->part_ativo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_ativo'])) ? $this->New_label['part_ativo'] : "Ativo"; 
         }
         else
         {
             $SC_Label = "part_ativo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_ativo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_ativo) . "\"";
         }
   }
   //----- part_sexo
   function NM_export_part_sexo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_sexo))
         {
             $this->part_sexo = sc_convert_encoding($this->part_sexo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_sexo'])) ? $this->New_label['part_sexo'] : "Sexo"; 
         }
         else
         {
             $SC_Label = "part_sexo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_sexo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_sexo) . "\"";
         }
   }
   //----- part_crnm
   function NM_export_part_crnm()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_crnm))
         {
             $this->part_crnm = sc_convert_encoding($this->part_crnm, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_crnm'])) ? $this->New_label['part_crnm'] : "Part Crnm"; 
         }
         else
         {
             $SC_Label = "part_crnm"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_crnm) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_crnm) . "\"";
         }
   }
   //----- part_tipo
   function NM_export_part_tipo()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->part_tipo))
         {
             $this->part_tipo = sc_convert_encoding($this->part_tipo, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['part_tipo'])) ? $this->New_label['part_tipo'] : "Tipo"; 
         }
         else
         {
             $SC_Label = "part_tipo"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->part_tipo) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->part_tipo) . "\"";
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Participantes do Evento: :: XML</TITLE>
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
<form name="Fdown" method="get" action="grid_participantes_rsvp_1_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_participantes_rsvp_1"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_1']['xml_return']); ?>"> 
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

function additens_menuhorizontal () {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  

	?>

	<link rel="stylesheet" type="text/css" href="<?php echo sc_url_library('sys', 'bootstrap', 'bootstrap.min.css'); ?>" />
	<script type="text/javascript" src="<?php echo sc_url_library('sys', 'bootstrap', 'bootstrap.min.js'); ?>">
	<script type="text/javascript" src="<?php echo sc_url_library('sys', 'bootstrap', 'jquery.min.js'); ?>">
		
	<ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Cadastrar </a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Logar </a></li>
    </ul>

	<?php
	

$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function CheckLog($chave) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  		
		date_default_timezone_set('America/Sao_Paulo');
		$ret = 'ok';
		$tipo = strlen($chave);
		if ($tipo >= 11) {
			$sql = "
				SELECT
					cod_usuario
				FROM
					rsvpses_log
				WHERE
					cod_usuario = ".$this->Db->qstr($chave)."
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
				$ret = 'ok';	
			} else {
				$ret = 'sair';	
			}					
		} else {	
			$sql = "
				SELECT
					id_usuario
				FROM
					rsvpses_log
				WHERE
					id_usuario = ".$this->Db->qstr($chave)."
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
				$ret = 'ok';	
			} else {
				$ret = 'sair';	
			}					
		}	
		return $ret;
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function GetSaldoBloq($evento_id, $direcao) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  	
		date_default_timezone_set('America/Sao_Paulo');
		$ret = TRUE;
		$valor_y = 'Y';
		$valor_n = 'N';
		$valor_0 = '0';
	
		$sqlx="
		SELECT 
			aereo_id_evento,aereo_bloqueio_id 
		FROM 
			aereos_rsvp
		WHERE 
			aereo_id_evento = ".$this->Db->qstr($evento_id)."	
		AND 
			aereo_bloqueio_id <> ".$this->Db->qstr($valor_0)."
		AND 
			aereo_status <>  ".$this->Db->qstr($valor_n)."
		AND 
			aereo_direcao =  ".$this->Db->qstr($direcao)."
		AND
			aereo_ativo  = ".$this->Db->qstr($valor_y)."		
		ORDER BY 
			aereo_cpf_particip, aereo_id_evento"
		;	
		 
      $nm_select = $sqlx; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsl = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsl[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsl = false;
          $this->rsl_erro = $this->Db->ErrorMsg();
      } 
	
		if (isset($this->rsl[0][0])) {	
				$bloqueio = $this->rsl[0][1];
				$sqljoin="
				SELECT 
					aereos_rsvp.aereo_bloqueio_id,aereos_rsvp.aereo_id_evento,bloqueio_aereo_rsvp.bloq_qtd_lugares,COUNT(aereos_rsvp.aereo_bloqueio_id) AS qtd_aereo, 
					aereos_rsvp.aereo_direcao,aereos_rsvp.aereo_status
				FROM
					aereos_rsvp
				INNER JOIN 
					bloqueio_aereo_rsvp
				ON 
					aereos_rsvp.aereo_bloqueio_id = bloqueio_aereo_rsvp.bloqueio_id
				WHERE
					aereos_rsvp.aereo_bloqueio_id =  ".$this->Db->qstr($bloqueio)."
				AND 
					aereos_rsvp.aereo_status <> ".$this->Db->qstr($valor_n)." AND aereos_rsvp.aereo_direcao = ".$this->Db->qstr($direcao)."
				GROUP BY 
					aereos_rsvp.aereo_bloqueio_id"
				;	
				 
      $nm_select = $sqljoin; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsjoin = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsjoin[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsjoin = false;
          $this->rsjoin_erro = $this->Db->ErrorMsg();
      } 
		
				if (isset($this->rsjoin[0][0])) {
					$bloqueio_id	= $this->rsjoin[0][0];
					$qtd_lugares	= $this->rsjoin[0][2];
					$qtd_bloqueio	= $this->rsjoin[0][3];
					$saldo			= $qtd_lugares - $qtd_bloqueio;
					$sqlupd="	
					UPDATE 
						bloqueio_aereo_rsvp
					SET 
						bloq_saldo_lugares = ".$this->Db->qstr($saldo)."
					WHERE 
						bloqueio_id = ".$this->Db->qstr($bloqueio_id)." 
					";
					 
      $nm_select = $sqlupd; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsupd = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsupd[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsupd = false;
          $this->rsupd_erro = $this->Db->ErrorMsg();
      } 
	
					$ret = $saldo;
				} else {
					$ret = FALSE;	
				}	
		} else {
			$sqls="
			SELECT 
				bloqueio_id,bloq_evento_id,bloq_direcao,bloq_qtd_lugares,bloq_saldo_lugares
			FROM
				bloqueio_aereo_rsvp
			WHERE
				bloq_evento_id = ".$this->Db->qstr($evento_id)."	
			AND
				bloq_direcao = ".$this->Db->qstr($direcao)."
			ORDER BY
				bloq_evento_id,bloq_direcao
			";
			 
      $nm_select = $sqls; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rss = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rss[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rss = false;
          $this->rss_erro = $this->Db->ErrorMsg();
      } 
	
			if (isset($this->rss[0][0])) {	
				$bloq_id = $this->rss[0][0];	
				$qtd_lugares = $this->rss[0][3];			
				$sqlupd="	
				UPDATE 
					bloqueio_aereo_rsvp
				SET 
					bloq_saldo_lugares = ".$this->Db->qstr($qtd_lugares)." 
				WHERE 
					bloqueio_id =  ".$this->Db->qstr($bloq_id)."  		
				";
				
     $nm_select = $sqlupd; 
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
		}	
		return $ret;
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function getTokenApp(){
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  	
	date_default_timezone_set('America/Sao_Paulo');
	$curl = curl_init();
	
	
	curl_setopt_array($curl, array(
  	CURLOPT_URL => 'https://api.beinvited.com.br/oauth-token',
	CURLOPT_RETURNTRANSFER => true,
  	CURLOPT_ENCODING => '',
  	CURLOPT_MAXREDIRS => 10,
  	CURLOPT_TIMEOUT => 0,
  	CURLOPT_FOLLOWLOCATION => true,
  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  	CURLOPT_CUSTOMREQUEST => 'POST',
  	CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=SEU_CLIENT_ID&client_secret=SEU_CLIENT_SECRET',
  	CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  	),
	));
	
	$resp = curl_exec($curl);
	curl_close($curl);	
	$response = json_decode($resp, true);
	$token = $response['access_token'];
	$tokenType = $response['token_type'];
	$expiresIn = $response['expires_in'];
	$scope = $response['scope'];
	
	return $token;

$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function GetUsuarioNivel($idu,$tipo) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function GetUsuarioNivel2($idu,$tipo) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
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
			usuario_cpf = ".$this->Db->qstr($idu)." 
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
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function GravaLog($v_hora_now,$v_ip_usuario,$v_id_usuario,$v_global_cpf,$v_modulo,$v_aplicacao,$v_acao,$v_campo_id,$v_vl_campo_id,$v_campo_cpf,$v_vl_campo_cpf,$v_campo_evt,$v_vl_campo_evt,$v_tabela,$v_obs,$v_sql) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  		
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
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function MakeColor($vp_evento,$vp_cpf,$tipo) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');

	
		$valor_y = 'Y';
		$valor_a = 'A';
		$valor_n = 'N';
		
		if ($tipo == 'I') {
			$sqlmestre = "
				SELECT
					part_id_evento,
					part_cpf,
					part_contato_rsvp,
					part_presenca,
					part_solicit_especial,
					part_programacao,
					part_aereo,
					part_hospedagem,
					part_transfer,
					part_opcionais
				FROM
					participantes_rsvp
				WHERE   
					part_id_evento = ".$this->Db->qstr($vp_evento)."
				AND 
					part_cpf = ".$this->Db->qstr($vp_cpf)."
				ORDER BY 
					part_id_evento,part_cpf
			";		
		} else {
			$sqlmestre = "
				SELECT
					part_id_evento,
					part_cpf,
					part_contato_rsvp,
					part_presenca,
					part_solicit_especial,
					part_programacao,
					part_aereo,
					part_hospedagem,
					part_transfer,
					part_opcionais
				FROM
					participantes_rsvp
				WHERE   
					part_id_evento = ".$this->Db->qstr($vp_evento)."
				ORDER BY 
					part_id_evento,part_cpf
			";		
		}			
		 
      $nm_select = $sqlmestre; 
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
		if ($reg_inc > 0) {
			for ($i=0;$i<$reg_inc;++$i) {	
				$evento_id			= $this->rs[$i][0];   
				$cpf_mestre			= $this->rs[$i][1];   
				$contato_mestre		= $this->rs[$i][2];  
				$presenca_mestre	= $this->rs[$i][3];  
				$solicitacao		= $this->rs[$i][4];  
				$programacao		= $this->rs[$i][5];  
				$aereo				= $this->rs[$i][6];  
				$hospedagem			= $this->rs[$i][7];  
				$transfer			= $this->rs[$i][8];  
				$opcionais			= $this->rs[$i][9];			

				$sqlcon = "
					SELECT
						contato_status
					FROM	
						contatos_rsvp	
					WHERE
						contato_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						contato_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						contato_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlcon; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rscon = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rscon[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rscon = false;
          $this->rscon_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rscon[0][0])) {
					$_atu_contato = $this->rscon[0][0];			
					$sqlucon = "
						UPDATE 
							participantes_rsvp
						SET 
							part_contato_rsvp = ".$this->Db->qstr($_atu_contato)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlucon; 
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
      
				} else {
					$sqlucon = "
						UPDATE 
							participantes_rsvp
						SET 
							part_contato_rsvp = ".$this->Db->qstr($valor_a)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";
					
     $nm_select = $sqlucon; 
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

				$sqlpres = "
					SELECT
						presenca_status
					FROM
						presencas_rsvp	
					WHERE
						presenca_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						presenca_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						presenca_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlpres; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspres = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspres[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspres = false;
          $this->rspres_erro = $this->Db->ErrorMsg();
      } 
			
				if (isset($this->rspres[0][0])) {
					$_atu_pres = $this->rspres[0][0];
					$sqlupres = "
						UPDATE 
							participantes_rsvp
						SET 
							part_presenca = ".$this->Db->qstr($_atu_pres)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";
					
     $nm_select = $sqlupres; 
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
      
				} else {
					$sqlupres = "
						UPDATE 
							participantes_rsvp
						SET 
							part_presenca = ".$this->Db->qstr($valor_a)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";			
					
     $nm_select = $sqlupres; 
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

				$sqlsol = "
					SELECT
						solicitacao_status
					FROM
						solicitacoes_rsvp	
					WHERE
						solicitacao_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						solicitacao_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						solicitacao_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlsol; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rssol = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rssol[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rssol = false;
          $this->rssol_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rssol[0][0])) {
					$_atu_sol = $this->rssol[0][0];
					$sqlusol = "
						UPDATE 
							participantes_rsvp
						SET 
							part_solicit_especial = ".$this->Db->qstr($_atu_sol)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlusol; 
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
      
				} else {
					$sqlusol = "
						UPDATE 
							participantes_rsvp
						SET 
							part_solicit_especial = ".$this->Db->qstr($valor_a)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";			
					
     $nm_select = $sqlusol; 
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

				$sqlpro = "
					SELECT
						programac_ativo
					FROM
						programac_rsvp
					WHERE
						programac_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						programac_id_evento = ".$this->Db->qstr($evento_id)."
					AND 
						programac_ativo = ".$this->Db->qstr($valor_y)."
					ORDER BY
						programac_data_hora DESC
					LIMIT 1	
				";
				 
      $nm_select = $sqlpro; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rspro = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rspro[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rspro = false;
          $this->rspro_erro = $this->Db->ErrorMsg();
      } 
				
				if (isset($this->rspro[0][0])) {
					$_atu_pro = $this->rspro[0][0];
					$sqlupro = "
					UPDATE 
						participantes_rsvp
					SET 
						part_programacao = ".$this->Db->qstr($_atu_pro)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlupro; 
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
      
				} else {
					$sqlupro = "
					UPDATE 
						participantes_rsvp
					SET 
						part_programacao = ".$this->Db->qstr($valor_n)." 
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqlupro; 
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

				$contverde = '0';  		  
				$contaberto = '0'; 
				$contamarelo = '0'; 
				$controxo = '0'; 
				$contvermelho = '0';		
				$contot = 0;
				$vpart_aereo = 'A';
				$sqlaer = "
				SELECT
						aereo_status,
						aereo_direcao,
						aereo_cpf_particip
					FROM
						aereos_rsvp
					WHERE
						aereo_id_evento = ".$this->Db->qstr($evento_id)."
					AND	
						aereo_cpf_particip = ".$this->Db->qstr($cpf_mestre)."
					AND	
						aereo_ativo = ".$this->Db->qstr($valor_y)." 
					ORDER BY
						aereo_id_evento,aereo_cpf_particip,aereo_direcao
				";
				 
      $nm_select = $sqlaer; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsaer = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsaer[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsaer = false;
          $this->rsaer_erro = $this->Db->ErrorMsg();
      } 
	
				$reg_aer = sizeof($this->rsaer );
				if ($reg_aer > 0) {
					for ($i2=0;$i2<$reg_aer;++$i2) {									
						$vaereo_status = $this->rsaer[$i2][0];				
						switch($vaereo_status) {
							case 'Y':
								$contverde = '1';  		  
								break;
							case 'A':
								$contaberto = '2'; 
								break;							
							case 'P':
								$contamarelo = '3'; 
								break;							
							case 'N':
								$contvermelho = '4'; 
								break;							
						}												
						$resultado = $contverde.$contaberto.$contamarelo.$contvermelho;		
						switch($resultado) {
							case '1000':
								if ($reg_aer == 1) {
									$vpart_aereo = 'R';
								} else {
									$vpart_aereo = 'Y';
								}	
								break;						
							case '0200':
								$vpart_aereo = 'A';
								break;						
							case '0030':
								$vpart_aereo = 'P';
								break;
							case '0004':
								$vpart_aereo = 'N';
								break;
							default:	
								$vpart_aereo = 'R';
								break;							
						}												
					}					
					$sqluaer = "
						UPDATE 
							participantes_rsvp
						SET 
							part_aereo = ".$this->Db->qstr($vpart_aereo).",
							part_aereo_ok = ".$this->Db->qstr($vpart_aereo)."
						WHERE 
							part_cpf = ".$this->Db->qstr($cpf_mestre)."
						AND
							part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqluaer; 
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
      
				} else {
					$sqluaer = "
					UPDATE 
						participantes_rsvp
					SET 
						part_aereo = ".$this->Db->qstr($valor_a).",
						part_aereo_ok = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";					
					
     $nm_select = $sqluaer; 
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

				$sqlhos = "
					SELECT
						hosp_id_evento,
						hosp_cpf_participante,
						hosp_id_hotel,
						hosp_status
					FROM
						hospedagem_rsvp
					WHERE
						hosp_id_evento = ".$this->Db->qstr($evento_id)."
					AND	
						hosp_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						hosp_ativo = ".$this->Db->qstr($valor_y)."
					ORDER BY
						hosp_dt_checkin DESC, hosp_hr_checkin DESC, hosp_id_hotel
					LIMIT 1						
				";
				 
      $nm_select = $sqlhos; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rshos = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rshos[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rshos = false;
          $this->rshos_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rshos[0][0])) {
					$status_hos = $this->rshos[0][3];
					$sqluhos = "
					UPDATE 
						participantes_rsvp
					SET 
						part_hospedagem = ".$this->Db->qstr($status_hos).",
						part_hotel = ".$this->Db->qstr($status_hos)."						
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluhos; 
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
      
				} else {
					$sqluhos = "
					UPDATE 
						participantes_rsvp
					SET 
						part_hospedagem = ".$this->Db->qstr($valor_a).",
						part_hotel = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluhos; 
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
				
				$sqltra = "
					SELECT
						tra_id_evento,
						tra_cpf_particip,
						tra_status
					FROM
						transfer_rsvp
					WHERE
						tra_cpf_particip = ".$this->Db->qstr($cpf_mestre)."
					AND
						tra_id_evento = ".$this->Db->qstr($evento_id)."
					ORDER BY
						tra_id_evento,tra_cpf_particip,tra_status
					LIMIT 1
				";
				 
      $nm_select = $sqltra; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rstra = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rstra[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rstra = false;
          $this->rstra_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rstra[0][0])) {
					$status_tra = $this->rstra[0][2];
					$sqlutra = "
					UPDATE 
						participantes_rsvp
					SET 
						part_transfer = ".$this->Db->qstr($status_tra)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqlutra; 
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
      
				} else {
					$sqlutra = "
					UPDATE 
						participantes_rsvp
					SET 
						part_transfer = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqlutra; 
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
								
				$sqlopc = "
					SELECT
						opc_evento_id,
						opc_cpf_participante,
						opc_status
					FROM
						eventos_opcionais_rsvp
					WHERE
						opc_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						opc_evento_id = ".$this->Db->qstr($evento_id)."
					AND
						opc_status = ".$this->Db->qstr($valor_y)."
					ORDER BY
						opc_evento_id,opc_cpf_participante	
					LIMIT 1	
				";
				 
      $nm_select = $sqlopc; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsopc = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsopc[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsopc = false;
          $this->rsopc_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rsopc[0][0])) {
					$sqluopc = "
					UPDATE 
						participantes_rsvp
					SET 
						part_opcionais =  ".$this->Db->qstr($valor_y)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluopc; 
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
      
				} else {
					$sqluopc = "
					UPDATE 
						participantes_rsvp
					SET 
						part_opcionais =  ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluopc; 
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
								
				$sqlant = "
					SELECT
						ant_evento_id,
						ant_cpf_participante,
						ant_status
					FROM
						anotacoes_rsvp	
					WHERE
						ant_cpf_participante = ".$this->Db->qstr($cpf_mestre)."
					AND
						ant_evento_id = ".$this->Db->qstr($evento_id)."		
					ORDER BY
						ant_evento_id,ant_cpf_participante		
					LIMIT 1	
				";
				 
      $nm_select = $sqlant; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rsant = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rsant[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rsant = false;
          $this->rsant_erro = $this->Db->ErrorMsg();
      } 
	
				if (isset($this->rsant[0][0])) {
					$sqluant = "
					UPDATE 
						participantes_rsvp
					SET 
						part_anotacoes = ".$this->Db->qstr($valor_y)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluant; 
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
      
				} else {
					$sqluant = "
					UPDATE 
						participantes_rsvp
					SET 
						part_anotacoes = ".$this->Db->qstr($valor_a)."
					WHERE 
						part_cpf = ".$this->Db->qstr($cpf_mestre)."
					AND
						part_id_evento = ".$this->Db->qstr($evento_id)."		
					";										
					
     $nm_select = $sqluant; 
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
			}	
		}
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function Mkprest($evento) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
		date_default_timezone_set('America/Sao_Paulo');
		$valor_nao = 'N';
		$sqlu = "
		UPDATE
			participantes_rsvp
		SET
			part_anotacoes = ".$this->Db->qstr($valor_nao).",
			part_contato_rsvp = ".$this->Db->qstr($valor_nao).",
			part_solicit_especial = ".$this->Db->qstr($valor_nao).",
			part_programacao = ".$this->Db->qstr($valor_nao).",
			part_aereo = ".$this->Db->qstr($valor_nao).",
			part_hospedagem = ".$this->Db->qstr($valor_nao).",
			part_opcionais = ".$this->Db->qstr($valor_nao).",
			part_transfer = ".$this->Db->qstr($valor_nao).",
			part_atendimento = ".$this->Db->qstr($valor_nao).",
			part_aereo_ok = ".$this->Db->qstr($valor_nao).",
			part_hotel = ".$this->Db->qstr($valor_nao).",
			part_anotacoes = ".$this->Db->qstr($valor_nao)."
		WHERE
			part_id_evento = ".$this->Db->qstr($evento)."
		AND 	
			part_presenca = ".$this->Db->qstr($valor_nao)."	
		";
		
     $nm_select = $sqlu; 
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
      
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function PegaIP() {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
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
	
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_participantes_rsvp_1']['contr_erro'] = 'off';
}

}

?>
