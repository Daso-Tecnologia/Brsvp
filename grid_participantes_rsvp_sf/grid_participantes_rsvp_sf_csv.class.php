<?php

class grid_participantes_rsvp_sf_csv
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
                   nm_limpa_str_grid_participantes_rsvp_sf($cadapar[1]);
                   nm_protect_num_grid_participantes_rsvp_sf($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_participantes_rsvp_sf']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($rsvp_global)) 
      {
          $_SESSION['rsvp_global'] = $rsvp_global;
          nm_limpa_str_grid_participantes_rsvp_sf($_SESSION["rsvp_global"]);
      }
      if (isset($vg_usuario_id)) 
      {
          $_SESSION['vg_usuario_id'] = $vg_usuario_id;
          nm_limpa_str_grid_participantes_rsvp_sf($_SESSION["vg_usuario_id"]);
      }
      if (isset($vg_cpfseg)) 
      {
          $_SESSION['vg_cpfseg'] = $vg_cpfseg;
          nm_limpa_str_grid_participantes_rsvp_sf($_SESSION["vg_cpfseg"]);
      }
      if (isset($vg_menu_item)) 
      {
          $_SESSION['vg_menu_item'] = $vg_menu_item;
          nm_limpa_str_grid_participantes_rsvp_sf($_SESSION["vg_menu_item"]);
      }
      if (isset($parm1)) 
      {
          $_SESSION['parm1'] = $parm1;
          nm_limpa_str_grid_participantes_rsvp_sf($_SESSION["parm1"]);
      }
      if (isset($vg_evento_id)) 
      {
          $_SESSION['vg_evento_id'] = $vg_evento_id;
          nm_limpa_str_grid_participantes_rsvp_sf($_SESSION["vg_evento_id"]);
      }
      if (isset($vg_cpf)) 
      {
          $_SESSION['vg_cpf'] = $vg_cpf;
          nm_limpa_str_grid_participantes_rsvp_sf($_SESSION["vg_cpf"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "grid_participantes_rsvp_sf_total.class.php"); 
      $this->Tot      = new grid_participantes_rsvp_sf_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['tot_geral'][1];
      }
      $this->Csv_password = "";
      $this->Arquivo   = "sc_csv";
      $this->Arquivo  .= "_" . date("YmdHis") . "_" . bin2hex(random_bytes(8));
      $this->Arq_zip   = $this->Arquivo . "_grid_participantes_rsvp_sf.zip";
      $this->Arquivo  .= "_grid_participantes_rsvp_sf";
      $this->Arquivo  .= ".csv";
      $this->Tit_doc   = "grid_participantes_rsvp_sf.csv";
      $this->Tit_zip   = "grid_participantes_rsvp_sf.zip";
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
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['SC_Ind_Groupby'] == "sc_free_total")
          {
              $this->Tem_csv_res  = false;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['SC_Gb_Free_cmp']))
          {
              $this->Tem_csv_res  = false;
          }
      if (!$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_participantes_rsvp_sf']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_return']);
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
      if (isset($_SESSION['scriptcase']['sc_apl_conf']['grid_participantes_rsvp_sf']['field_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['grid_participantes_rsvp_sf']['field_display']))
      {
          foreach ($_SESSION['scriptcase']['sc_apl_conf']['grid_participantes_rsvp_sf']['field_display'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['usr_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['usr_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['usr_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']))
      {
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel'] as $NM_cada_field => $NM_cada_opc)
          {
              $this->NM_cmp_hidden[$NM_cada_field] = $NM_cada_opc;
          }
      }
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['campos_busca'];
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
          $this->part_aereo = (isset($Busca_temp['part_aereo'])) ? $Busca_temp['part_aereo'] : ""; 
          $tmp_pos = (is_string($this->part_aereo)) ? strpos($this->part_aereo, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_aereo))
          {
              $this->part_aereo = substr($this->part_aereo, 0, $tmp_pos);
          }
          $this->part_transfer = (isset($Busca_temp['part_transfer'])) ? $Busca_temp['part_transfer'] : ""; 
          $tmp_pos = (is_string($this->part_transfer)) ? strpos($this->part_transfer, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_transfer))
          {
              $this->part_transfer = substr($this->part_transfer, 0, $tmp_pos);
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
          $this->part_ddd_celular_01 = (isset($Busca_temp['part_ddd_celular_01'])) ? $Busca_temp['part_ddd_celular_01'] : ""; 
          $tmp_pos = (is_string($this->part_ddd_celular_01)) ? strpos($this->part_ddd_celular_01, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_ddd_celular_01))
          {
              $this->part_ddd_celular_01 = substr($this->part_ddd_celular_01, 0, $tmp_pos);
          }
          $this->part_ddd_celular_02 = (isset($Busca_temp['part_ddd_celular_02'])) ? $Busca_temp['part_ddd_celular_02'] : ""; 
          $tmp_pos = (is_string($this->part_ddd_celular_02)) ? strpos($this->part_ddd_celular_02, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_ddd_celular_02))
          {
              $this->part_ddd_celular_02 = substr($this->part_ddd_celular_02, 0, $tmp_pos);
          }
          $this->part_cod_usuario = (isset($Busca_temp['part_cod_usuario'])) ? $Busca_temp['part_cod_usuario'] : ""; 
          $tmp_pos = (is_string($this->part_cod_usuario)) ? strpos($this->part_cod_usuario, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->part_cod_usuario))
          {
              $this->part_cod_usuario = substr($this->part_cod_usuario, 0, $tmp_pos);
          }
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'on';
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

$valor_y = 'Y';
$usuario_nivel  = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'nivel');
$cpfseg = $this->GetUsuarioNivel($this->sc_temp_vg_usuario_id,'cpf');
$this->RetNivel($usuario_nivel );

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
 unset($_SESSION['rsvp_global']);
 unset($this->sc_temp_rsvp_global);
;
	
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "Acesso Negado! grd_participantes_rsvp_sf 2";
;	
	if (isset($this->Campos_Mens_erro) && !empty($this->Campos_Mens_erro))
{
 if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
 if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
 if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
 if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
 if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
 if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
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
 if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['sc_outra_jan']) && $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['sc_outra_jan'])
 {
     $_SESSION['scriptcase']['sc_outra_jan'] = "grid_participantes_rsvp_sf";
     $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['sc_outra_jan'] = false;
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
        action="grid_participantes_rsvp_sf_fim.php"
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
	$sqlupd = "
		UPDATE
			rsvpses_log	
		SET
			logado = ".$this->Db->qstr($valor_y)."
		WHERE
		id_usuario = ".$this->Db->qstr($this->sc_temp_vg_usuario_id)."			
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

$this->part_cod_usuario  = $this->sc_temp_vg_usuario_id;

echo '<h2>BRSVP Participantes</h2>';	

$sCaminhoCSS = sc_url_library('prj', 'rsvp_modern', 'grid_clean.css');
echo '<link rel="stylesheet" href="' . $sCaminhoCSS . '">';
if (isset($this->sc_temp_vg_usuario_id)) {$_SESSION['vg_usuario_id'] = $this->sc_temp_vg_usuario_id;}
if (isset($this->sc_temp_vg_menu_item)) {$_SESSION['vg_menu_item'] = $this->sc_temp_vg_menu_item;}
if (isset($this->sc_temp_parm1)) {$_SESSION['parm1'] = $this->sc_temp_parm1;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
if (isset($this->sc_temp_vg_cpfseg)) {$_SESSION['vg_cpfseg'] = $this->sc_temp_vg_cpfseg;}
if (isset($this->sc_temp_rsvp_global)) {$_SESSION['rsvp_global'] = $this->sc_temp_rsvp_global;}
$_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_name'] .= ".csv";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_name']);
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
          foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['field_order'] as $Cada_col)
          { 
              $SC_Label = (isset($this->New_label['participante_id'])) ? $this->New_label['participante_id'] : "CÓD"; 
              if ($Cada_col == "participante_id" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['acomp_gray'])) ? $this->New_label['acomp_gray'] : "A"; 
              if ($Cada_col == "acomp_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['acompanhante'])) ? $this->New_label['acompanhante'] : "A"; 
              if ($Cada_col == "acompanhante" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['acomp_red'])) ? $this->New_label['acomp_red'] : "A"; 
              if ($Cada_col == "acomp_red" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['substituido'])) ? $this->New_label['substituido'] : "S"; 
              if ($Cada_col == "substituido" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['subst_gray'])) ? $this->New_label['subst_gray'] : "SUBS"; 
              if ($Cada_col == "subst_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['subst_laranja'])) ? $this->New_label['subst_laranja'] : "S"; 
              if ($Cada_col == "subst_laranja" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['nome_pessoa'])) ? $this->New_label['nome_pessoa'] : "Participante"; 
              if ($Cada_col == "nome_pessoa" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['part_celeular_01'])) ? $this->New_label['part_celeular_01'] : "Cel. 01"; 
              if ($Cada_col == "part_celeular_01" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['contato_gray'])) ? $this->New_label['contato_gray'] : "C"; 
              if ($Cada_col == "contato_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['contato_yellow'])) ? $this->New_label['contato_yellow'] : "C"; 
              if ($Cada_col == "contato_yellow" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['contato_red'])) ? $this->New_label['contato_red'] : "C"; 
              if ($Cada_col == "contato_red" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['contato_green'])) ? $this->New_label['contato_green'] : "C"; 
              if ($Cada_col == "contato_green" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['presenca_gray'])) ? $this->New_label['presenca_gray'] : "P"; 
              if ($Cada_col == "presenca_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['presenca_yellow'])) ? $this->New_label['presenca_yellow'] : "P"; 
              if ($Cada_col == "presenca_yellow" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['presenca_red'])) ? $this->New_label['presenca_red'] : "P"; 
              if ($Cada_col == "presenca_red" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['presenca_green'])) ? $this->New_label['presenca_green'] : "P"; 
              if ($Cada_col == "presenca_green" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['solic_gray'])) ? $this->New_label['solic_gray'] : "S"; 
              if ($Cada_col == "solic_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['solic_green'])) ? $this->New_label['solic_green'] : "S"; 
              if ($Cada_col == "solic_green" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['solic_red'])) ? $this->New_label['solic_red'] : "S"; 
              if ($Cada_col == "solic_red" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['solic_amarela'])) ? $this->New_label['solic_amarela'] : "S"; 
              if ($Cada_col == "solic_amarela" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['prog_gray'])) ? $this->New_label['prog_gray'] : "PG"; 
              if ($Cada_col == "prog_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['prog_ok'])) ? $this->New_label['prog_ok'] : "PG"; 
              if ($Cada_col == "prog_ok" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['aereo_gray'])) ? $this->New_label['aereo_gray'] : "AE"; 
              if ($Cada_col == "aereo_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['aereo_green'])) ? $this->New_label['aereo_green'] : "AE"; 
              if ($Cada_col == "aereo_green" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['aereo_yellow'])) ? $this->New_label['aereo_yellow'] : "AE"; 
              if ($Cada_col == "aereo_yellow" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['aereo_red'])) ? $this->New_label['aereo_red'] : "AE"; 
              if ($Cada_col == "aereo_red" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['aereo_roxo'])) ? $this->New_label['aereo_roxo'] : "AE"; 
              if ($Cada_col == "aereo_roxo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['hotel_gray'])) ? $this->New_label['hotel_gray'] : "H"; 
              if ($Cada_col == "hotel_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['hotel_yellow'])) ? $this->New_label['hotel_yellow'] : "H"; 
              if ($Cada_col == "hotel_yellow" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['hotel_yellow_a'])) ? $this->New_label['hotel_yellow_a'] : "H"; 
              if ($Cada_col == "hotel_yellow_a" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['hotel_gray_a'])) ? $this->New_label['hotel_gray_a'] : "H"; 
              if ($Cada_col == "hotel_gray_a" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['hotel_red'])) ? $this->New_label['hotel_red'] : "H"; 
              if ($Cada_col == "hotel_red" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['hotel_red_a'])) ? $this->New_label['hotel_red_a'] : "H"; 
              if ($Cada_col == "hotel_red_a" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['hotel_green'])) ? $this->New_label['hotel_green'] : "H"; 
              if ($Cada_col == "hotel_green" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['hotel_green_a'])) ? $this->New_label['hotel_green_a'] : "H"; 
              if ($Cada_col == "hotel_green_a" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['transfer_gray'])) ? $this->New_label['transfer_gray'] : "T"; 
              if ($Cada_col == "transfer_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['transfer_green'])) ? $this->New_label['transfer_green'] : "T"; 
              if ($Cada_col == "transfer_green" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['transfer_red'])) ? $this->New_label['transfer_red'] : "T"; 
              if ($Cada_col == "transfer_red" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['transfer_yellow'])) ? $this->New_label['transfer_yellow'] : "T"; 
              if ($Cada_col == "transfer_yellow" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['opcionais_gray'])) ? $this->New_label['opcionais_gray'] : "O"; 
              if ($Cada_col == "opcionais_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['opcionais_green'])) ? $this->New_label['opcionais_green'] : "O"; 
              if ($Cada_col == "opcionais_green" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['anotacoes'])) ? $this->New_label['anotacoes'] : "A"; 
              if ($Cada_col == "anotacoes" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['anotacoes_gray'])) ? $this->New_label['anotacoes_gray'] : "A"; 
              if ($Cada_col == "anotacoes_gray" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['part_ativo'])) ? $this->New_label['part_ativo'] : "Ativo"; 
              if ($Cada_col == "part_ativo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['part_sexo'])) ? $this->New_label['part_sexo'] : "Sexo"; 
              if ($Cada_col == "part_sexo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['part_cpf'])) ? $this->New_label['part_cpf'] : "ID Part."; 
              if ($Cada_col == "part_cpf" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['part_crnm'])) ? $this->New_label['part_crnm'] : "Part Crnm"; 
              if ($Cada_col == "part_crnm" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
              {
                  $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
                  $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $SC_Label);
                  $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
                  $this->NM_prim_col++;
              }
              $SC_Label = (isset($this->New_label['part_tipo'])) ? $this->New_label['part_tipo'] : "Tipo"; 
              if ($Cada_col == "part_tipo" && (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off"))
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
          $nmgp_select = "SELECT participante_id, nome_pessoa, part_celeular_01, part_ativo, part_sexo, part_cpf, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_acompanhado, part_incompleto, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT participante_id, nome_pessoa, part_celeular_01, part_ativo, part_sexo, part_cpf, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_acompanhado, part_incompleto, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT participante_id, nome_pessoa, part_celeular_01, part_ativo, part_sexo, part_cpf, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_acompanhado, part_incompleto, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT participante_id, nome_pessoa, part_celeular_01, part_ativo, part_sexo, part_cpf, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_acompanhado, part_incompleto, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT participante_id, nome_pessoa, part_celeular_01, part_ativo, part_sexo, part_cpf, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_acompanhado, part_incompleto, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT participante_id, nome_pessoa, part_celeular_01, part_ativo, part_sexo, part_cpf, part_crnm, part_tipo, part_id_evento, part_substituido, part_ddd_01, part_fone_01, part_ddd_celular_01, part_cod_usuario, part_hospedagem, part_transfer, part_opcionais, part_acompanhado, part_incompleto, part_aereo_ok, part_hotel, part_substituto, part_acompanhado_hotel, part_anotacoes from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['order_grid'];
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
         $this->participante_id = $rs->fields[0] ;  
         $this->participante_id = (string)$this->participante_id;
         $this->nome_pessoa = $rs->fields[1] ;  
         $this->part_celeular_01 = $rs->fields[2] ;  
         $this->part_ativo = $rs->fields[3] ;  
         $this->part_sexo = $rs->fields[4] ;  
         $this->part_cpf = $rs->fields[5] ;  
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
         $this->part_acompanhado = $rs->fields[17] ;  
         $this->part_incompleto = $rs->fields[18] ;  
         $this->part_aereo_ok = $rs->fields[19] ;  
         $this->part_hotel = $rs->fields[20] ;  
         $this->part_substituto = $rs->fields[21] ;  
         $this->part_acompanhado_hotel = $rs->fields[22] ;  
         $this->part_anotacoes = $rs->fields[23] ;  
         $this->sc_proc_grid = true; 
         $_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'on';
if (!isset($_SESSION['vg_evento_id'])) {$_SESSION['vg_evento_id'] = "";}
if (!isset($this->sc_temp_vg_evento_id)) {$this->sc_temp_vg_evento_id = (isset($_SESSION['vg_evento_id'])) ? $_SESSION['vg_evento_id'] : "";}
if (!isset($_SESSION['vg_cpf'])) {$_SESSION['vg_cpf'] = "";}
if (!isset($this->sc_temp_vg_cpf)) {$this->sc_temp_vg_cpf = (isset($_SESSION['vg_cpf'])) ? $_SESSION['vg_cpf'] : "";}
  date_default_timezone_set('America/Sao_Paulo');

$this->sc_temp_vg_cpf = $this->part_cpf ;
$cpf = $this->sc_temp_vg_cpf;
$vstatus = "Y";
$valor_y = 'Y',

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
	$this->NM_cmp_hidden["substituido"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["substituido"] = 'off'; }		
	$this->NM_cmp_hidden["subst_laranja"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["subst_laranja"] = 'off'; }		
	$this->NM_cmp_hidden["subst_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["subst_gray"] = 'on'; }		
} else {
	if($this->part_substituido  == 'Y' && $this->part_substituto  == 'N') {
		$this->NM_cmp_hidden["substituido"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["substituido"] = 'on'; }		
		$this->NM_cmp_hidden["subst_laranja"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["subst_laranja"] = 'off'; }		
		$this->NM_cmp_hidden["subst_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["subst_gray"] = 'off'; }						
	} else {
		if($this->part_substituido  == 'N' && $this->part_substituto  == 'Y') {
			$this->NM_cmp_hidden["substituido"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["substituido"] = 'off'; }		
			$this->NM_cmp_hidden["subst_laranja"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["subst_laranja"] = 'on'; }		
			$this->NM_cmp_hidden["subst_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["subst_gray"] = 'off'; }					
		} else {
			if($this->part_substituido  == 'N' && $this->part_substituto  == '') {
				$this->NM_cmp_hidden["substituido"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["substituido"] = 'off'; }		
				$this->NM_cmp_hidden["subst_laranja"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["subst_laranja"] = 'off'; }		
				$this->NM_cmp_hidden["subst_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["subst_gray"] = 'on'; }													
			}	
		}	
	}	
}	

if($this->part_acompanhado  == 'N') {
	$this->NM_cmp_hidden["acompanhante"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["acompanhante"] = 'off'; }		
	$this->NM_cmp_hidden["acomp_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["acomp_gray"] = 'on'; }		
	$this->NM_cmp_hidden["acomp_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["acomp_red"] = 'off'; }					
} else {	
	$this->NM_cmp_hidden["acompanhante"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["acompanhante"] = 'on'; }		
	$this->NM_cmp_hidden["acomp_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["acomp_gray"] = 'off'; }		
	$this->NM_cmp_hidden["acomp_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["acomp_red"] = 'off'; }		
	
}

$sql="
SELECT
	contato_data_hora, contato_status, contato_ativo
FROM
	contatos_rsvp 
WHERE
	contato_id_evento = ".$this->Db->qstr($evento)."	
AND 
	contato_ativo = 'Y'	
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
			$this->NM_cmp_hidden["contato_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_gray"] = 'on'; }		
			$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_green"] = 'off'; }		
			$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_red"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["contato_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_green"] = 'off'; }		
			$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_red"] = 'off'; }		
			$this->NM_cmp_hidden["contato_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_gray"] = 'off'; }		
			break;		
		case 'Y':
			$this->NM_cmp_hidden["contato_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_green"] = 'on'; }		
			$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_red"] = 'off'; }		
			$this->NM_cmp_hidden["contato_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_gray"] = 'off'; }		
			$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_yellow"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["contato_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_red"] = 'on'; }		
			$this->NM_cmp_hidden["contato_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_gray"] = 'off'; }		
			$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_green"] = 'off'; }		
			$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_yellow"] = 'off'; }					
			break;				
	}	
} else {
	$this->NM_cmp_hidden["contato_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_gray"] = 'on'; }		
	$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_green"] = 'off'; }		
	$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_red"] = 'off'; }						
}

$sql="
SELECT
	presenca_data_hora, presenca_status, presenca_ativo
FROM
	presencas_rsvp 
WHERE
	presenca_id_evento = ".$this->Db->qstr($evento)."	 
AND  
	presenca_ativo = 'Y'	
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
			$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_gray"] = 'on'; }		
			$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_green"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_red"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["presenca_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_green"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_red"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_gray"] = 'off'; }		
			break;		
		case 'Y':
			$this->NM_cmp_hidden["presenca_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_green"] = 'on'; }		
			$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_red"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_gray"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["presenca_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_red"] = 'on'; }		
			$this->NM_cmp_hidden["presenca_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_gray"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_green"] = 'off'; }		
			$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
			break;				
	}	
} else {
	$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_gray"] = 'on'; }		
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_red"] = 'off'; }						
}

$sql="
SELECT
	solicitacao_data_hora, solicitacao_status, solicitacao_ativo
FROM
	solicitacoes_rsvp 
WHERE
	solicitacao_id_evento = ".$this->Db->qstr($evento)."	 
AND  
	solicitacao_ativo = 'Y'	
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
			$this->NM_cmp_hidden["solic_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_gray"] = 'on'; }		
			$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_amarela"] = 'off'; }					
			$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_green"] = 'off'; }		
			$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_red"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["solic_amarela"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_amarela"] = 'on'; }					
			$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_green"] = 'off'; }		
			$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_red"] = 'off'; }		
			$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_gray"] = 'off'; }		
			break;		
		case 'Y':
			$this->NM_cmp_hidden["solic_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_green"] = 'on'; }		
			$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_red"] = 'off'; }		
			$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_gray"] = 'off'; }		
			$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_amarela"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["solic_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_red"] = 'on'; }		
			$this->NM_cmp_hidden["solic_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_gray"] = 'off'; }		
			$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_green"] = 'off'; }		
			$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_amarela"] = 'off'; }					
			break;				
	}	
} else {
	$this->NM_cmp_hidden["solic_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_gray"] = 'on'; }		
	$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_amarela"] = 'off'; }					
	$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_green"] = 'off'; }		
	$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_red"] = 'off'; }						
}

$sql3="
SELECT 
	programac_cpf_participante, programac_id_evento, programac_ativo
FROM 
	programac_rsvp
WHERE 
	programac_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)." 
AND 
	programac_ativo = 'Y'	
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
		$this->NM_cmp_hidden["prog_ok"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["prog_ok"] = 'on'; }				
		$this->NM_cmp_hidden["prog_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["prog_gray"] = 'off'; }	
	} else {
		$this->NM_cmp_hidden["prog_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["prog_gray"] = 'on'; }			
		$this->NM_cmp_hidden["prog_ok"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["prog_ok"] = 'off'; }		
	}		
} else {	
	$this->NM_cmp_hidden["prog_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["prog_gray"] = 'on'; }			
	$this->NM_cmp_hidden["prog_ok"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["prog_ok"] = 'off'; }				
}

$sql4="
	SELECT    
	COUNT(id_aereo) as qtde
	FROM
		aereos_rsvp		
	WHERE 
		aereo_id_evento = ".$this->Db->qstr($this->part_id_evento )." AND  aereo_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)." AND aereo_ativo = ".$this->Db->qstr($valor_y)."
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
			$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_gray"] = 'on'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;
		case 'P':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;		
		case 'Y':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_green"] = 'on'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;				
		case 'N':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_red"] = 'on'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;				
		case 'R':
			$this->NM_cmp_hidden["aereo_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_gray"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_roxo"] = 'on'; }					
			break;		
		case '':
			$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_gray"] = 'on'; }		
			$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_green"] = 'off'; }		
			$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_red"] = 'off'; }					
			$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_roxo"] = 'off'; }					
			break;						  
	}	
} else {
	$this->part_aereo_ok  = 'A';
	$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_gray"] = 'on'; }		
	$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_green"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_red"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_roxo"] = 'off'; }		
}
				 
$sql5="
	SELECT    
	COUNT(hospedagem_id) as qtdeh
	FROM
		hospedagem_rsvp		
	WHERE 
		hosp_id_evento = ".$this->Db->qstr($this->part_id_evento )." AND  hosp_cpf_participante = ".$this->Db->qstr($this->sc_temp_vg_cpf)." AND hosp_ativo = ".$this->Db->qstr($valor_y)."
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
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;
			case 'P':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'on'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;
			case 'Y':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;					
			case 'N':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'on'; }					
				break;							
			case '':			
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;			
		}
	} else {
		$status = $this->part_hotel ;
		switch($status) {
			case 'A':
				$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;
			case 'P':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'on'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;		
			case 'Y':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;				
			case 'N':
				$this->NM_cmp_hidden["hotel_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'on'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;				
			case '':
				$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'on'; }		
				$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
				$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
				$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }					
				break;
		}
	}				 
} else {
	$this->part_hospedagem  = 'A';
	$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'on'; }		
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }	
	$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }						
}
					 
$sql6="
	SELECT    
	COUNT(id_transfer) as qtdet
	FROM
		transfer_rsvp		
	WHERE 
		tra_id_evento = ".$this->Db->qstr($this->part_id_evento )." AND  tra_cpf_particip = ".$this->Db->qstr($this->sc_temp_vg_cpf)." AND tra_ativo = ".$this->Db->qstr($valor_y)."
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
} else {
	$qtdet = 0;
}
if ($qtdet > 0) {					 
	$status_trans =  $this->part_transfer ;
	switch($status_trans) {
		case 'A':
			$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_gray"] = 'on'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_red"] = 'off'; }					
								
			break;
		case 'P':
			$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_gray"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_yellow"] = 'on'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_red"] = 'off'; }					
								
			break;		
		case 'Y':
			$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_gray"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_green"] = 'on'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_red"] = 'off'; }					
								
			break;								  
		case 'N':
			$this->NM_cmp_hidden["transfer_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_gray"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_red"] = 'on'; }					
				
			break;			
		case '':
			$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_gray"] = 'on'; }		
			$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
			$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_green"] = 'off'; }		
			$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_red"] = 'off'; }					
				
			break;
	}
} else {
	$this->part_transfer  = 'A';
	$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_gray"] = 'on'; }		
	$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_green"] = 'off'; }		
	$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_red"] = 'off'; }					
			
}	
					 
if ($this->part_substituido  == 'Y' and $this->part_incompleto  == 'Y') {
	$this->NM_field_color["nome_pessoa"] = "#FF9997";
	$this->NM_field_color["part_ddd_01"] = "#FF9997";	
	$this->NM_field_color["part_fone_01"] = "#FF9997";	
	$this->NM_field_color["part_ddd_celular_01"] = "#FF9997";	
	$this->NM_field_color["part_celeular_01"] = "#FF9997";		
	$this->NM_field_color["part_celeular_01"] = "#FF9997";		
} else {
	if ($this->part_substituido  == 'Y' and $this->part_incompleto  == 'N') {
		$this->NM_field_color["nome_pessoa"] = "#BCBEC0";	
		$this->NM_field_color["part_ddd_01"] = "#BCBEC0";	
		$this->NM_field_color["part_fone_01"] = "#BCBEC0";				
		$this->NM_field_color["part_ddd_celular_01"] = "#BCBEC0";	
		$this->NM_field_color["part_celeular_01"] = "#BCBEC0";		
		$this->NM_field_color["part_celeular_01"] = "#BCBEC0";		
	} else {
		if ($this->part_substituido  == 'N' and $this->part_incompleto  == 'Y') {
			$this->NM_field_color["nome_pessoa"] = "#FE0000";	
			$this->NM_field_color["part_ddd_01"] = "#FE0000";	
			$this->NM_field_color["part_fone_01"] = "#FE0000";	
			$this->NM_field_color["part_ddd_celular_01"] = "#FE0000";	
			$this->NM_field_color["part_celeular_01"] = "#FE0000";		
			$this->NM_field_color["part_celeular_01"] = "#FE0000";		
		} else {
			if ($this->part_substituido  == 'N' and $this->part_incompleto  == 'N') {	
				$this->NM_field_color["nome_pessoa"] = "#000000";	
				$this->NM_field_color["part_ddd_01"] = "#000000";	
				$this->NM_field_color["part_fone_01"] = "#000000";	
				$this->NM_field_color["part_ddd_celular_01"] = "#000000";	
				$this->NM_field_color["part_celeular_01"] = "#000000";		
				$this->NM_field_color["part_celeular_01"] = "#000000";
			}
		}
	}	
}	

switch($this->part_opcionais ) {
	case 'N':
		$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
		$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["opcionais_green"] = 'off'; }		
		break;
	case 'Y':
		$this->NM_cmp_hidden["opcionais_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["opcionais_gray"] = 'off'; }		
		$this->NM_cmp_hidden["opcionais_green"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["opcionais_green"] = 'on'; }		
		break;		
	case '':
		$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
		$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["opcionais_green"] = 'off'; }		
		break;						  
}						 
			
if ($this->part_anotacoes  == 'Y') {
	$this->NM_cmp_hidden["anotacoes"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["anotacoes"] = 'on'; }		
	$this->NM_cmp_hidden["anotacoes_gray"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["anotacoes_gray"] = 'off'; }	
} else {
	$this->NM_cmp_hidden["anotacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["anotacoes"] = 'off'; }		
	$this->NM_cmp_hidden["anotacoes_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["anotacoes_gray"] = 'on'; }	
}
					 
if ($this->part_ativo  == 'Y') {
	$this->NM_field_style["participante_id"] = "background-color:#cde4cd;font-size:bold;"; 	
} else {
	$this->NM_field_style["participante_id"] = "background-color:#ffbbba;font-size:bold;";
	$this->NM_cmp_hidden["contato_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_gray"] = 'on'; }		
	$this->NM_cmp_hidden["contato_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["contato_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_green"] = 'off'; }		
	$this->NM_cmp_hidden["contato_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["contato_red"] = 'off'; }	
	
	$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_gray"] = 'on'; }		
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_red"] = 'off'; }	
	
	$this->NM_cmp_hidden["presenca_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_gray"] = 'on'; }	
	$this->NM_cmp_hidden["presenca_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["presenca_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_green"] = 'off'; }		
	$this->NM_cmp_hidden["presenca_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["presenca_red"] = 'off'; }		
	
	$this->NM_cmp_hidden["solic_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_gray"] = 'on'; }		
	$this->NM_cmp_hidden["solic_amarela"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_amarela"] = 'off'; }					
	$this->NM_cmp_hidden["solic_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_green"] = 'off'; }		
	$this->NM_cmp_hidden["solic_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["solic_red"] = 'off'; }
	
	$this->NM_cmp_hidden["aereo_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_gray"] = 'on'; }		
	$this->NM_cmp_hidden["aereo_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_green"] = 'off'; }		
	$this->NM_cmp_hidden["aereo_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_red"] = 'off'; }					
	$this->NM_cmp_hidden["aereo_roxo"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["aereo_roxo"] = 'off'; }
					  
	$this->NM_cmp_hidden["hotel_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray"] = 'on'; }		
	$this->NM_cmp_hidden["hotel_gray_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_gray_a"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_yellow_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_yellow_a"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_green_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_green_a"] = 'off'; }		
	$this->NM_cmp_hidden["hotel_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red"] = 'off'; }					
	$this->NM_cmp_hidden["hotel_red_a"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["hotel_red_a"] = 'off'; }
					  
	$this->NM_cmp_hidden["transfer_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_gray"] = 'on'; }		
	$this->NM_cmp_hidden["transfer_yellow"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_yellow"] = 'off'; }					
	$this->NM_cmp_hidden["transfer_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_green"] = 'off'; }		
	$this->NM_cmp_hidden["transfer_red"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["transfer_red"] = 'off'; }					
	
	
	$this->NM_cmp_hidden["opcionais_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["opcionais_gray"] = 'on'; }		
	$this->NM_cmp_hidden["opcionais_green"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["opcionais_green"] = 'off'; }	
					  
	$this->NM_cmp_hidden["anotacoes"] = 'off';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["anotacoes"] = 'off'; }		
	$this->NM_cmp_hidden["anotacoes_gray"] = 'on';if (!isset($this->NM_ajax_event) || !$this->NM_ajax_event) {$_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['php_cmp_sel']["anotacoes_gray"] = 'on'; }						  
}
if (isset($this->sc_temp_vg_cpf)) {$_SESSION['vg_cpf'] = $this->sc_temp_vg_cpf;}
if (isset($this->sc_temp_vg_evento_id)) {$_SESSION['vg_evento_id'] = $this->sc_temp_vg_evento_id;}
$_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'off'; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['field_order'] as $Cada_col)
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
          require_once($this->Ini->path_aplicacao . "grid_participantes_rsvp_sf_res_csv.class.php");
          $this->Res = new grid_participantes_rsvp_sf_res_csv();
          $this->prep_modulos("Res");
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_res_grid'] = true;
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
              $Arq_res    = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_res_file'];
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
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_res_grid']);
              unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_res_file']);
          }
          unlink($Arq_input);
          $this->Arquivo = $this->Arq_zip;
          $this->Csv_f   = $this->Zip_f;
          $this->Tit_doc = $this->Tit_zip;
      } 
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- participante_id
   function NM_export_participante_id()
   {
             nmgp_Form_Num_Val($this->participante_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->participante_id);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- acomp_gray
   function NM_export_acomp_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->acomp_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- acompanhante
   function NM_export_acompanhante()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->acompanhante);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- acomp_red
   function NM_export_acomp_red()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->acomp_red);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- substituido
   function NM_export_substituido()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->substituido);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- subst_gray
   function NM_export_subst_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->subst_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- subst_laranja
   function NM_export_subst_laranja()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->subst_laranja);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- nome_pessoa
   function NM_export_nome_pessoa()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->nome_pessoa);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- part_celeular_01
   function NM_export_part_celeular_01()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->part_celeular_01);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- contato_gray
   function NM_export_contato_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->contato_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- contato_yellow
   function NM_export_contato_yellow()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->contato_yellow);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- contato_red
   function NM_export_contato_red()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->contato_red);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- contato_green
   function NM_export_contato_green()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->contato_green);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- presenca_gray
   function NM_export_presenca_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->presenca_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- presenca_yellow
   function NM_export_presenca_yellow()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->presenca_yellow);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- presenca_red
   function NM_export_presenca_red()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->presenca_red);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- presenca_green
   function NM_export_presenca_green()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->presenca_green);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- solic_gray
   function NM_export_solic_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->solic_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- solic_green
   function NM_export_solic_green()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->solic_green);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- solic_red
   function NM_export_solic_red()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->solic_red);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- solic_amarela
   function NM_export_solic_amarela()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->solic_amarela);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- prog_gray
   function NM_export_prog_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->prog_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- prog_ok
   function NM_export_prog_ok()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->prog_ok);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- aereo_gray
   function NM_export_aereo_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->aereo_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- aereo_green
   function NM_export_aereo_green()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->aereo_green);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- aereo_yellow
   function NM_export_aereo_yellow()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->aereo_yellow);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- aereo_red
   function NM_export_aereo_red()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->aereo_red);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- aereo_roxo
   function NM_export_aereo_roxo()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->aereo_roxo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- hotel_gray
   function NM_export_hotel_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->hotel_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- hotel_yellow
   function NM_export_hotel_yellow()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->hotel_yellow);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- hotel_yellow_a
   function NM_export_hotel_yellow_a()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->hotel_yellow_a);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- hotel_gray_a
   function NM_export_hotel_gray_a()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->hotel_gray_a);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- hotel_red
   function NM_export_hotel_red()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->hotel_red);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- hotel_red_a
   function NM_export_hotel_red_a()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->hotel_red_a);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- hotel_green
   function NM_export_hotel_green()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->hotel_green);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- hotel_green_a
   function NM_export_hotel_green_a()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->hotel_green_a);
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
   //----- transfer_red
   function NM_export_transfer_red()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->transfer_red);
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
   //----- opcionais_gray
   function NM_export_opcionais_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->opcionais_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- opcionais_green
   function NM_export_opcionais_green()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->opcionais_green);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- anotacoes
   function NM_export_anotacoes()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->anotacoes);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- anotacoes_gray
   function NM_export_anotacoes_gray()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->anotacoes_gray);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- part_ativo
   function NM_export_part_ativo()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->part_ativo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- part_sexo
   function NM_export_part_sexo()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->part_sexo);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- part_cpf
   function NM_export_part_cpf()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->part_cpf);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- part_crnm
   function NM_export_part_crnm()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->part_crnm);
      $this->csv_registro .= $col_sep . $this->Delim_dados . $conteudo . $this->Delim_dados;
      $this->NM_prim_col++;
   }
   //----- part_tipo
   function NM_export_part_tipo()
   {
      $col_sep = ($this->NM_prim_col > 0) ? $this->Delim_col : "";
      $conteudo = str_replace($this->Delim_dados, $this->Delim_dados . $this->Delim_dados, $this->part_tipo);
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf'][$path_doc_md5][1] = $this->Tit_doc;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE html>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE>Participantes do Evento: :: CSV</TITLE>
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
<form name="Fdown" method="get" action="grid_participantes_rsvp_sf_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_participantes_rsvp_sf"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_participantes_rsvp_sf']['csv_return']); ?>"> 
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
$_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'on';
  	
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
$_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'off';
}


function RetNivel($nivel) {
$_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'off';
}


function usulog($pusuario) {
$_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'on';
  
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
$_SESSION['scriptcase']['grid_participantes_rsvp_sf']['contr_erro'] = 'off';
}

}

?>
